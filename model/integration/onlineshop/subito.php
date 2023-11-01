<?php
namespace Opencart\Catalog\Model\Integration\Onlineshop;
class subito extends \Opencart\System\Engine\Model {
    private $api_url = 'https://www.autovit.ro/api/open/';

    public function getStorage($user_id) {
        $this->load->model('integration/onlineshop/onlineshop');

        return $this->model_integration_onlineshop_onlineshop->getStorage($user_id, 'autovit');
    }

    public function editStorage($user_id, $storage) {
        $this->load->model('integration/onlineshop/onlineshop');

        $this->model_integration_onlineshop_onlineshop->editStorage($user_id, 'autovit', $storage);
    }

    public function connect($user_id, $rewrite = false) {
        if (isset($this->session->data['autovit']['connected']) and isset($this->session->data['autovit']['access_token']) and $this->session->data['autovit']['expires_in'] > time() and !$rewrite) {
            return $this->session->data['autovit']['connected'];
        }

        $storage = $this->getStorage($user_id);

        if (empty($storage['grant_type']) or empty($storage['client_id']) or empty($storage['client_secret'])) {
            return 0;
        }

        if ($storage['grant_type'] === 'password' and (empty($storage['email']) or empty($storage['password']))) {
            return 0;
        }

        if ($storage['grant_type'] === 'partner' and (empty($storage['partner_code']) or empty($storage['partner_secret']))) {
            return 0;
        }

        if (!isset($storage['access_token']) or $storage['expires_in'] < time()) {
            if ($storage['grant_type'] === 'password') {
                $post = array(
                    'grant_type' => 'password',
                    'username' => $storage['email'],
                    'password' => $storage['password'],
                );
            } else {
                $post = array(
                    'grant_type' => 'partner',
                    'partner_code' => $storage['partner_code'],
                    'partner_secret' => $storage['partner_secret'],
                );
            }

            $token_response = $this->oauthToken($storage['client_id'], $storage['client_secret'], $post);

            if (isset($token_response['access_token'])) {
                $storage['access_token'] = $token_response['access_token'];
                $storage['expires_in'] = $token_response['expires_in'] + time();
                $storage['refresh_token'] = $token_response['refresh_token'];
                $storage['token_type'] = $token_response['token_type'];

                $this->editStorage($user_id, $storage);
            }
        }

        $this->session->data['autovit'] = $storage;

        $this->session->data['autovit']['connected'] = 0;

        if (!$this->categories()) {
            return 0;
        }

        $this->session->data['autovit']['connected'] = 1;

        return 1;
    }

    public function syncProduct($user_id, $sku, $product = false) {
        $response = array(
            'success' => 0,
            'message' => '',
        );

        if (!$this->connect($user_id)) {
            return false;
        }

        $this->load->language('integration/autovit');
        $this->load->language('integration/onlineshop');

        $this->load->model('catalog/product');

        if ($product === false) {
            $product = $this->model_catalog_product->getProduct($user_id, $sku);
        }

        if ($product and !isset($product['onlineshops']['autovit'])) {
            return $response;
        }

        if (isset($product['onlineshops']['autovit']['data']['id']) and (!$product['onlineshops']['autovit']['status'] or !$product['quantity'] or !$product['status'])) {
            if ($product['onlineshops']['autovit']['data']['activate'] == 0) {
                return $response;
            }

            $post_deativate = array(
                'reason' => array(
                    'id' => 1,
                    'description' => 'The product is out of stock',
                )
            );

            $deactivate_result = $this->accountAdvertDeactivate($product['onlineshops']['autovit']['data']['id'], $post_deativate);

            if (isset($deactivate_result['error'])) {
                $response['message'] = $deactivate_result['error']['message'];
                return $response;
            }

            $product['onlineshops']['autovit']['data']['activate'] = 0;

            $this->model_catalog_product->setProduct2OnlineshopData($user_id, $product['sku'], 'autovit', $product['onlineshops']['autovit']['data']);

            $response['success'] = 1;
            $response['message'] = $this->language->get('text_disabled');

            return $response;
        }

        if (!$product) {
            $onlineshop_data = $this->model_catalog_product->getProduct2OnlineshopData($user_id, $sku, 'autovit');

            if (isset($onlineshop_data['id'])) {
                $delete_result = $this->deleteAdvert($onlineshop_data['id']);

                $this->model_catalog_product->deleteProduct2Onlineshop($user_id, $sku, 'autovit');

                $response['success'] = 1;
                $response['message'] = $this->language->get('text_deleted');
            }

            return $response;
        }

        if (!$product['onlineshops']['autovit']['status']) {
            return false;
        }

        if (!$product['quantity'] or !$product['status']) {
            $response['success'] = 1;
            $response['message'] = $this->language->get('text_ignored');

            return $response;
        }

        // add product

        $this->load->model('catalog/vehicle');
        $this->load->model('catalog/brand');

        $product_vehicles = $this->model_catalog_product->getProductVehicles($user_id, $sku);
        $product_vehicles4parts = $this->model_catalog_product->getProductVehicles4Parts($user_id, $sku);
        $product_categories = $this->model_catalog_product->getProductCategories($user_id, $sku);
        $product_images = $this->model_catalog_product->getProductImages($user_id, $product['sku']);

        if ($product['vehicle_position_id']) {
            $position = $this->model_catalog_vehicle->getPosition($product['vehicle_position_id'], 1);
            $position_name = oc_strtolower($position['text']);
        } else {
            $position_name = false;
        }

        $title = $product['name_product'];

        if ($position_name) {
            $title .= ' ' . $position_name;
        }

        if ($product_vehicles) {
            foreach ($product_vehicles as $product_vehicle) {
                $vehicle_brand = $this->model_catalog_vehicle->getBrandByVehicleId($product_vehicle['vehicle_id']);

                $title .= ' ' . $vehicle_brand['name'];

                $vehicle_model = $this->model_catalog_vehicle->getModelByVehicleId($product_vehicle['vehicle_id']);

                $title .= ' ' . $vehicle_model['model'];
            }
        }

        $title .= ' ' . $product['oe'];

        $description = html_entity_decode($product['description']);

        if (isset($this->session->data['autovit']['general_description'])) {
            $description .= html_entity_decode($this->session->data['autovit']['general_description']);
        }

        $post = array(
            'title'			=> oc_substr($title, 0, 100),
            'description'	=> $description,
            'category_id'	=> 69,
        );

        //$post['params']['title_parts'] = $product['name_product'];
        $post['params']['title_parts'] = $title;

        $autovit_type_code = '';

        $product_category_to_autovit_type = $this->getProductCategoryToAutovitType();

        foreach ($product_categories as $product_category) {
            if (isset($product_category_to_autovit_type[$product_category['category_id']])) {
                $autovit_type_code = $product_category_to_autovit_type[$product_category['category_id']];
                break;
            }
        }

        if ($autovit_type_code) {
            $post['params']['type'] = $autovit_type_code;
        } else {
            $post['params']['type'] = 'altele';
        }

        if ($position_name) {
            if (oc_strpos($position_name, 'front') !== false) {
                $post['params']['position'][] = 'front';
            }

            if (oc_strpos($position_name, 'rear') !== false) {
                $post['params']['position'][] = 'rear';
            }

            if (oc_strpos($position_name, 'left') !== false) {
                $post['params']['position'][] = 'left';
            }

            if (oc_strpos($position_name, 'right') !== false) {
                $post['params']['position'][] = 'right';
            }
        }

        if ($product_vehicles) {
            $post['params']['matching_vehicles'] = '';

            foreach ($product_vehicles as $product_vehicle) {
                if ($post['params']['matching_vehicles']) {
                    $post['params']['matching_vehicles'] .= ', ';
                }

                $post['params']['matching_vehicles'] .= $product_vehicle['title'];

                if ($product_vehicle['engine']) {
                    $post['params']['matching_vehicles'] .= ' ' . $product_vehicle['engine']['name'];
                }
            }
        }

        if ($product_vehicles4parts) {
            foreach ($product_vehicles4parts as $product_vehicle4parts) {
                if ($product_vehicle4parts['color_id']) {
                    $color = $this->model_catalog_vehicle->getColor($product_vehicle4parts['color_id'], 1);
                    $color_name = oc_strtolower($color['text']);

                    switch($color_name) {
                        case 'primer':
                        case 'white':
                        case 'blue':
                        case 'silver':
                        case 'brown':
                        case 'yellow-gold':
                        case 'grey':
                        case 'black':
                        case 'red':
                        case 'green':
                        case 'beige':
                            $post['params']['color'] = $color_name;
                            break;
                        default:
                            $post['params']['color'] = 'other';
                    }

                    if ($post['params']['color'] !== 'other') {
                        break;
                    }
                }
            }
        }

        if ($product['brand']) {
            $post['params']['manufacturer'] = $product['brand'];
        } else {
            $post['params']['manufacturer'] = 'Unbranded';
        }

        if ($product['mpn']) {
            $post['params']['manufacturer_code'] = $product['mpn'];
        } else {
            $post['params']['manufacturer_code'] = $product['sku'];
        }

        if ($product['oe']) {
            $post['params']['oem_reference'] = $product['oe'];
        }

        $makes = $this->categoryMakes(69);

        if ($makes) {
            foreach ($product_vehicles as $product_vehicle) {
                $vahicle_brand = $this->model_catalog_vehicle->getBrandByVehicleId($product_vehicle['vehicle_id']);

                foreach ($makes as $code => $make) {
                    if (oc_strtolower($vahicle_brand['name']) === oc_strtolower($make['en'])) {
                        $post['params']['make'] = $code;
                        break 2;
                    }
                }
            }
        }

        if (!isset($post['params']['make'])) {
            $response['message'] = $this->language->get('error_make');
            return $response;
        }

        $post['params']['price'] = array(
            0 => 'arranged',
            1 => round($this->currency->convert($product['price'], '0', 'RON'), 2),
            'currency' => 'RON',
            'gross_net' => 'gross',
        );


        if ($product['used'] == 1) {
            $post['new_used'] = 'used';
        } else {
            $post['new_used'] = 'new';
        }

        if (!isset($product['onlineshops']['autovit']['data']['image_collection_id'])) {
            $post_image_collection = array();

            if ($product['image']) {
                $post_image_collection[1] = HTTP_SERVER . DIR_IMAGE_RELATIVE . $product['image'];
            }

            $i = 2;

            foreach ($product_images as $product_image) {
                $post_image_collection[$i] = HTTP_SERVER . DIR_IMAGE_RELATIVE . $product_image['image'];

                $i++;
            }

            if ($post_image_collection) {
                $image_collection_result = $this->imageCollections($post_image_collection);

                if (isset($image_collection_result['id'])) {
                    $post['image_collection_id'] = $image_collection_result['id'];
                }
            }
        } else {
            $post['image_collection_id'] = $product['onlineshops']['autovit']['data']['image_collection_id'];
        }

        if (!isset($product['onlineshops']['autovit']['data']['id'])) {
            $advert_result = $this->createAccountAdvert($post);

            if (isset($advert_result['id'])) {
                $product['onlineshops']['autovit']['data']['id'] = $advert_result['id'];
                $product['onlineshops']['autovit']['data']['activate'] = 0;
                $product['onlineshops']['autovit']['data']['image_collection_id'] = $post['image_collection_id'];

                $this->model_catalog_product->setProduct2OnlineshopData($user_id, $product['sku'], 'autovit', $product['onlineshops']['autovit']['data']);

                $this->model_catalog_product->setOnlineshopProductId($user_id, $product['sku'], 'autovit', $product['onlineshops']['autovit']['data']['id']);

                $activate_result = $this->accountAdvertActivate($product['onlineshops']['autovit']['data']['id']);

                if (isset($activate_result['error'])) {
                    $response['message'] = $activate_result['error']['message'];
                    return $response;
                } else {
                    $product['onlineshops']['autovit']['data']['activate'] = 1;
                    $this->model_catalog_product->setProduct2OnlineshopData($user_id, $product['sku'], 'autovit', $product['onlineshops']['autovit']['data']);
                }

                $response['success'] = 1;
                $response['message'] = $this->language->get('text_uploaded');
            } elseif (isset($advert_result['error'])) {
                $response['message'] = $advert_result['error']['message'];
            }
        } else {
            $advert_result = $this->updateAccountAdvert($product['onlineshops']['autovit']['data']['id'], $post);

            if (isset($advert_result['id'])) {
                if ($product['onlineshops']['autovit']['data']['activate'] == 0) {
                    $activate_result = $this->accountAdvertActivate($product['onlineshops']['autovit']['data']['id']);

                    if (isset($activate_result['error'])) {
                        $response['message'] = $activate_result['error']['message'];
                        return $response;
                    } else {
                        $product['onlineshops']['autovit']['data']['activate'] = 1;
                        $this->model_catalog_product->setProduct2OnlineshopData($user_id, $product['sku'], 'autovit', $product['onlineshops']['autovit']['data']);
                    }
                }

                $response['success'] = 1;
                $response['message'] = $this->language->get('text_updated');
            } elseif (isset($advert_result['error'])) {
                $response['message'] = $advert_result['error']['message'];
            }
        }

        return $response;
    }

    public function getOrders($user_id) {
        $response = array();


        return $response;
    }

    private function createAccountAdvert($post) {
        if (!isset($this->session->data['autovit']['client_id']) or !isset($this->session->data['autovit']['client_secret']) or !isset($this->session->data['autovit']['access_token']) or !isset($this->session->data['autovit']['email'])) {
            return array();
        }

        $response = $this->request('account/adverts', $this->session->data['autovit']['client_id'], $this->session->data['autovit']['client_secret'], $this->session->data['autovit']['access_token'], $this->session->data['autovit']['email'], $post);

        return $response;
    }

    private function updateAccountAdvert($id, $put) {
        if (!isset($this->session->data['autovit']['client_id']) or !isset($this->session->data['autovit']['client_secret']) or !isset($this->session->data['autovit']['access_token']) or !isset($this->session->data['autovit']['email'])) {
            return array();
        }

        $response = $this->request('account/adverts/' . $id, $this->session->data['autovit']['client_id'], $this->session->data['autovit']['client_secret'], $this->session->data['autovit']['access_token'], $this->session->data['autovit']['email'], $put, 'put');

        return $response;
    }

    private function accountAdvertActivate($id) {
        if (!isset($this->session->data['autovit']['client_id']) or !isset($this->session->data['autovit']['client_secret']) or !isset($this->session->data['autovit']['access_token']) or !isset($this->session->data['autovit']['email'])) {
            return array();
        }

        $response = $this->request('account/adverts/' . $id . '/activate', $this->session->data['autovit']['client_id'], $this->session->data['autovit']['client_secret'], $this->session->data['autovit']['access_token'], $this->session->data['autovit']['email'], array());

        return $response;
    }

    private function accountAdvertDeactivate($id, $post) {
        if (!isset($this->session->data['autovit']['client_id']) or !isset($this->session->data['autovit']['client_secret']) or !isset($this->session->data['autovit']['access_token']) or !isset($this->session->data['autovit']['email'])) {
            return array();
        }

        $response = $this->request('account/adverts/' . $id . '/deactivate', $this->session->data['autovit']['client_id'], $this->session->data['autovit']['client_secret'], $this->session->data['autovit']['access_token'], $this->session->data['autovit']['email'], $post);

        return $response;
    }

    private function deleteAdvert($id, $post = array()) {
        if (!isset($this->session->data['autovit']['client_id']) or !isset($this->session->data['autovit']['client_secret']) or !isset($this->session->data['autovit']['access_token']) or !isset($this->session->data['autovit']['email'])) {
            return array();
        }

        $response = $this->request('/adverts/' . $id, $this->session->data['autovit']['client_id'], $this->session->data['autovit']['client_secret'], $this->session->data['autovit']['access_token'], $this->session->data['autovit']['email'], $post, 'delete');

        return $response;
    }

    private function imageCollections($post) {
        if (!isset($this->session->data['autovit']['client_id']) or !isset($this->session->data['autovit']['client_secret']) or !isset($this->session->data['autovit']['access_token']) or !isset($this->session->data['autovit']['email'])) {
            return array();
        }

        $response = $this->request('imageCollections', $this->session->data['autovit']['client_id'], $this->session->data['autovit']['client_secret'], $this->session->data['autovit']['access_token'], $this->session->data['autovit']['email'], $post);

        return $response;
    }

    private function categories() {
        if (!isset($this->session->data['autovit']['client_id']) or !isset($this->session->data['autovit']['client_secret']) or !isset($this->session->data['autovit']['access_token']) or !isset($this->session->data['autovit']['email'])) {
            return array();
        }

        $response = $this->request('categories', $this->session->data['autovit']['client_id'], $this->session->data['autovit']['client_secret'], $this->session->data['autovit']['access_token'], $this->session->data['autovit']['email']);

        if (isset($response['results'])) {
            return array_column($response['results'], null, 'id');
        }

        return array();
    }

    private function categoryMakes($category_id) {
        if (!isset($this->session->data['autovit']['client_id']) or !isset($this->session->data['autovit']['client_secret']) or !isset($this->session->data['autovit']['access_token']) or !isset($this->session->data['autovit']['email'])) {
            return array();
        }

        $response = $this->request('categories/' . (int) $category_id . '/makes', $this->session->data['autovit']['client_id'], $this->session->data['autovit']['client_secret'], $this->session->data['autovit']['access_token'], $this->session->data['autovit']['email']);

        if (isset($response['options'])) {
            return $response['options'];
        }

        return false;
    }

    private function category($category_id) {
        if (!isset($this->session->data['autovit']['client_id']) or !isset($this->session->data['autovit']['client_secret']) or !isset($this->session->data['autovit']['access_token']) or !isset($this->session->data['autovit']['email'])) {
            return array();
        }

        $response = $this->request('categories/' . (int) $category_id, $this->session->data['autovit']['client_id'], $this->session->data['autovit']['client_secret'], $this->session->data['autovit']['access_token'], $this->session->data['autovit']['email']);

        echo '<pre>'; print_r($response); echo '</pre><br><br>'; die();

        if (isset($response['results'])) {
            return array_column($response['results'], null, 'id');
        }

        return array();
    }

    private function oauthToken($client_id, $client_secret, $post_array) {
        $post = '';

        foreach ($post_array as $key => $value) {
            if ($post !== '') {
                $post .= '&';
            }

            $post .= $key . '=' . $value;
        }

        $ch = curl_init($this->api_url . 'oauth/token');

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        curl_setopt($ch, CURLOPT_USERPWD, $client_id . ':' . $client_secret);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $res = curl_exec($ch);

        curl_close($ch);

        return json_decode($res, true);
    }

    private function request($action, $client_id, $client_secret, $access_token, $email, $body = false, $type = 'post') {
        $ch = curl_init($this->api_url . $action);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

        $headers = array (
            'User-Agent: ' . $email,
            'Content-Type: application/json',
            'Authorization: Bearer ' . $access_token,
        );

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        if ($body !== false) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
        }

        if ($type === 'put') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        } elseif ($type === 'delete') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        }

        curl_setopt($ch, CURLOPT_USERPWD, $client_id . ':' . $client_secret);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $res = curl_exec($ch);

        curl_close($ch);

        return json_decode($res, true);
    }

    private function getProductCategoryToAutovitType() {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category_to_autovit_type");

        return array_column($query->rows, 'autovit_type_code', 'category_id');
    }
}