<?php
namespace Opencart\Catalog\Model\Integration\Onlineshop;
class wordpress extends \Opencart\System\Engine\Model {
    private $oc_categories = false;
    private $oc_manufacturers = false;
    private $oc_filters = false;
    private $oc_filter_groups = false;

    public function getStorage($user_id) {
        $this->load->model('integration/onlineshop/onlineshop');

        return $this->model_integration_onlineshop_onlineshop->getStorage($user_id, 'opencart');
    }

    public function editStorage($user_id, $storage) {
        $this->load->model('integration/onlineshop/onlineshop');

        $this->model_integration_onlineshop_onlineshop->editStorage($user_id, 'opencart', $storage);
    }

    public function setStorageValue($user_id, $key, $value) {
        $this->load->model('integration/onlineshop/onlineshop');

        return $this->model_integration_onlineshop_onlineshop->setStorageValue($user_id, 'opencart', $key, $value);
    }

    public function connect($user_id, $rewrite = false) {
        if (isset($this->session->data['opencart']['connected']) and !$rewrite) {
            return $this->session->data['opencart']['connected'];
        }

        $this->session->data['opencart'] = array();
        $this->session->data['opencart']['connected'] = 0;

        $storage = $this->getStorage($user_id);

        if (empty($storage['username']) or empty($storage['key']) or empty($storage['website'])) {
            return 0;
        }

        $this->session->data['opencart'] = $storage;
        $this->session->data['opencart']['connected'] = 0;

        if (!$this->request('test')) {
            $this->session->data['opencart']['error'] = $this->language->get('error_connect');
            return 0;
        }

        if (!isset($this->session->data['opencart']['order_date_modified'])) {
            $this->session->data['opencart']['order_date_modified'] = $this->setStorageValue($user_id, 'order_date_modified', date("Y-m-d H:i:s"));
        }

        $this->session->data['opencart']['connected'] = 1;

        return 1;
    }

    public function syncProduct($user_id, $sku, $product = false) {
        $response = array(
            'success' => 0,
            'message' => '',
        );

        if (!$this->connect($user_id)) {
            return $response;
        }

        $this->load->language('integration/onlineshop');

        $this->load->model('catalog/product');

        if ($product === false) {
            $product = $this->model_catalog_product->getProduct($user_id, $sku);
        }

        if (isset($product['onlineshops']['opencart']['data']['product_id']) and (!$product['onlineshops']['opencart']['status'] or !$product['quantity'] or !$product['status'])) {
            $onlineshop_data = $this->model_catalog_product->getProduct2OnlineshopData($user_id, $sku, 'opencart');

            if ($onlineshop_data['status'] == 0) {
                return false;
            } else {
                $onlineshop_data['status'] = 0;

                $this->model_catalog_product->setProduct2OnlineshopData($user_id, $sku, 'opencart', $onlineshop_data);
            }

            $data = array(
                'product_id' => $onlineshop_data['product_id'],
                'status' => 0,
            );

            $status_response = $this->editStatus($data);

            if (isset($status_response['success'])) {
                $response['success'] = 1;
                $response['message'] = $this->language->get('text_disabled');

                return $response;
            } else {
                $response['success'] = 1;
                $response['message'] = $this->language->get('text_ignored');

                return $response;
            }
        }

        if (!$product) {
            $onlineshop_data = $this->model_catalog_product->getProduct2OnlineshopData($user_id, $sku, 'opencart');

            $this->model_catalog_product->deleteProduct2Onlineshop($user_id, $sku, 'opencart');

            if (isset($onlineshop_data['product_id'])) {
                $data = array(
                    'product_id' => $onlineshop_data['product_id'],
                );

                $delete_response = $this->deleteProduct($data);

                if (isset($delete_response['success'])) {
                    $response['success'] = 1;
                    $response['message'] = $this->language->get('text_deleted');
                } else {
                    $response['message'] = $this->language->get('error_warning');
                }

                return $response;
            } else {
                return false;
            }
        }

        if (!$product['onlineshops']['opencart']['status']) {
            return false;
        }

        if (!$product['quantity'] or !$product['status']) {
            $response['success'] = 1;
            $response['message'] = $this->language->get('text_ignored');

            return $response;
        }

        $this->load->model('catalog/category');
        $this->load->model('catalog/vehicle');
        $this->load->model('catalog/vehicle4parts');
        $this->load->model('localisation/language');

        $languages = $this->model_localisation_language->getLanguages();
        $languages = array_column($languages, null, 'language_id');

        $product_images = $this->model_catalog_product->getProductImages($user_id, $sku);

        $product_categories = $this->model_catalog_product->getProductCategories($user_id, $sku);

        $product_description = $this->model_catalog_product->getProductDescription($user_id, $sku);

        $product_vehicles = $this->model_catalog_product->getProductVehicles($user_id, $sku);

        $product_vehicles4parts = $this->model_catalog_product->getProductVehicles4Parts($user_id, $sku);


        $data = array(
            'model' => $product['sku'],
            'mpn' => $product['mpn'],
            'ean' => $product['ean'],
            'quantity' => $product['quantity'],
            'price' => $product['price'],
            'location' => $product['location'],
            'weight' => $product['weight'],
            'status' => $product['status'],
        );

        foreach ($product_description as $description_data) {
            $description = html_entity_decode($description_data['description']);

            if (isset($this->session->data['opencart']['general_description'])) {
                $description .= html_entity_decode($this->session->data['opencart']['general_description']);
            }

            $data['product_description'][$languages[$description_data['language_id']]['code']] = array(
                'name' => $description_data['name'],
                'description' => $description,
            );
        }

        if ($product['image']) {
            $data['image'] = HTTP_SERVER . DIR_IMAGE_RELATIVE . $product['image'];
        }

        $data['product_image'] = array();

        if ($product_images) {
            foreach($product_images as $image) {
                $data['product_image'][] = HTTP_SERVER . DIR_IMAGE_RELATIVE . $image['image'];
            }
        }

        // Manufacturer

        if ($product['brand']) {
            $oc_manufacturers = $this->getManufacturers();

            foreach ($oc_manufacturers as $oc_manufacturer) {
                if (strtolower(str_replace(array(' ', '-'), '', $product['brand'])) === strtolower(str_replace(array(' ', '-'), '', $oc_manufacturer['name']))) {
                    $data['manufacturer_id'] = $oc_manufacturer['manufacturer_id'];
                }
            }
        }

        // Categories

        if ($product_categories) {
            $oc_categories = $this->getCategories();

            foreach ($product_categories as $product_category) {
                $product_category_data = $this->model_catalog_category->getCategory($product_category['category_id']);
                $parent_product_category_data = $this->model_catalog_category->getCategory($product_category_data['parent_id']);


                foreach ($oc_categories as $oc_category) {
                    foreach ($product_category_data['translates'] as $product_category_name) {
                        if (str_replace(array(' ', '-'), '', strtolower($oc_category['name'])) === str_replace(array(' ', '-'), '', strtolower($product_category_name))) {
                            $oc_parent_id = 0;

                            if ($product_category_data['parent_id'] != 0) {
                                foreach ($parent_product_category_data['translates'] as $parent_product_category_name) {
                                    if (str_replace(array(' ', '-'), '', strtolower($oc_categories[$oc_category['parent_id']]['name'])) === str_replace(array(' ', '-'), '', strtolower($parent_product_category_name))) {
                                        $oc_parent_id = $oc_category['parent_id'];
                                        break;
                                    }
                                }
                            }

                            if ($oc_parent_id == $oc_category['parent_id']) {
                                $data['product_category'][$oc_category['category_id']] = $oc_category['category_id'];
                                break 2;
                            }
                        }
                    }
                }
            }
        }

        // Filtres

        $oc_filter_groups = $this->getFilterGroups();

        if ($product_vehicles) {
            foreach ($product_vehicles as $product_vehicle) {
                $vehicle_brand = $this->model_catalog_vehicle->getBrandByVehicleId($product_vehicle['vehicle_id']);
                $vehicle_model = $this->model_catalog_vehicle->getModelByVehicleId($product_vehicle['vehicle_id']);

                foreach ($oc_filter_groups as $oc_filter_group) {
                    if (str_replace(array(' ', '-'), '', strtolower($oc_filter_group['name'])) === str_replace(array(' ', '-'), '', strtolower($vehicle_brand['name']))) {
                        $oc_filters = $this->getFilters($oc_filter_group['filter_group_id']);

                        foreach ($oc_filters as $oc_filter) {
                            if (str_replace(array(' ', '-'), '', strtolower($oc_filter['name'])) === str_replace(array(' ', '-'), '', strtolower($vehicle_model['name']))) {
                                $data['product_filter'][$oc_filter['filter_id']] = $oc_filter['filter_id'];
                                break 2;
                            }
                        }
                    }
                }
            }
        }

        $gb_speed_levels = $this->model_catalog_vehicle->getGBSpeedLevels();

        $years = $this->model_catalog_vehicle4parts->getUserYears($this->user->getId());

        foreach ($languages as $language) {
            $ln = new \Opencart\System\Library\Language($language['code']);
            $ln->addPath(DIR_LANGUAGE);

            $ln->load('catalog/filter');

            foreach ($oc_filter_groups as $oc_filter_group) {
                if (str_replace(array(' ', '-'), '', strtolower($oc_filter_group['name'])) === str_replace(array(' ', '-'), '', strtolower($ln->get('text_filter_quality')))) {
                    $oc_filters = $this->getFilters($oc_filter_group['filter_group_id']);

                    foreach ($oc_filters as $oc_filter) {
                        if ($product['used'] == 0 and $oc_filter['name'] === $ln->get('text_quality_new')) {
                            $data['product_filter'][$oc_filter['filter_id']] = $oc_filter['filter_id'];
                        } else if ($product['used'] == 0 and $oc_filter['name'] === $ln->get('text_quality_used')) {
                            $data['product_filter'][$oc_filter['filter_id']] = $oc_filter['filter_id'];
                        }
                    }
                }

                foreach ($product_vehicles4parts as $vehicle4parts) {
                    if (!empty($vehicle4parts['color_id']) and str_replace(array(' ', '-'), '', strtolower($oc_filter_group['name'])) === str_replace(array(' ', '-'), '', strtolower($ln->get('text_filter_color')))) {
                        $oc_filters = $this->getFilters($oc_filter_group['filter_group_id']);

                        $color = $this->model_catalog_vehicle->getColor($vehicle4parts['color_id']);

                        foreach ($oc_filters as $oc_filter) {
                            if ($oc_filter['name'] === $color['text']) {
                                $data['product_filter'][$oc_filter['filter_id']] = $oc_filter['filter_id'];
                            }
                        }
                    }

                    if (!empty($vehicle4parts['transmission_id']) and str_replace(array(' ', '-'), '', strtolower($oc_filter_group['name'])) === str_replace(array(' ', '-'), '', strtolower($ln->get('text_filter_transmission')))) {
                        $oc_filters = $this->getFilters($oc_filter_group['filter_group_id']);

                        $transmission = $this->model_catalog_vehicle->getTransmission($vehicle4parts['transmission_id']);

                        foreach ($oc_filters as $oc_filter) {
                            if ($oc_filter['name'] === $transmission['text']) {
                                $data['product_filter'][$oc_filter['filter_id']] = $oc_filter['filter_id'];
                            }
                        }
                    }

                    if (!empty($vehicle4parts['drive_id']) and str_replace(array(' ', '-'), '', strtolower($oc_filter_group['name'])) === str_replace(array(' ', '-'), '', strtolower($ln->get('text_filter_drive')))) {
                        $oc_filters = $this->getFilters($oc_filter_group['filter_group_id']);

                        $drive = $this->model_catalog_vehicle->getDrive($vehicle4parts['drive_id']);

                        foreach ($oc_filters as $oc_filter) {
                            if ($oc_filter['name'] === $drive['text']) {
                                $data['product_filter'][$oc_filter['filter_id']] = $oc_filter['filter_id'];
                            }
                        }
                    }

                    if (!empty($vehicle4parts['year']) and str_replace(array(' ', '-'), '', strtolower($oc_filter_group['name'])) === str_replace(array(' ', '-'), '', strtolower($ln->get('text_filter_year')))) {
                        $oc_filters = $this->getFilters($oc_filter_group['filter_group_id']);

                        foreach ($oc_filters as $oc_filter) {
                            if ($oc_filter['name'] === $vehicle4parts['year']) {
                                $data['product_filter'][$oc_filter['filter_id']] = $oc_filter['filter_id'];
                            }
                        }
                    }

                    if (!empty($vehicle4parts['gb_speed_level']) and str_replace(array(' ', '-'), '', strtolower($oc_filter_group['name'])) === str_replace(array(' ', '-'), '', strtolower($ln->get('text_filter_gb_speed_level')))) {
                        $oc_filters = $this->getFilters($oc_filter_group['filter_group_id']);

                        foreach ($oc_filters as $oc_filter) {
                            if ($oc_filter['name'] === $vehicle4parts['gb_speed_level']) {
                                $data['product_filter'][$oc_filter['filter_id']] = $oc_filter['filter_id'];
                            }
                        }
                    }
                }
            }
        }

        if (isset($product['onlineshops']['opencart']['data']['product_id'])) {
            if ($product['onlineshops']['opencart']['data']['status'] == 0) {
                $this->editStatus(array('product_id' => $product['onlineshops']['opencart']['data']['product_id'], 'status' => 1));

                $product['onlineshops']['opencart']['data']['status'] = 1;

                $this->model_catalog_product->setProduct2OnlineshopData($user_id, $product['sku'], 'opencart', $product['onlineshops']['opencart']['data']);
            }

            $data['product_id'] = $product['onlineshops']['opencart']['data']['product_id'];

            $edit_response = $this->editProduct($data);

            if (isset($edit_response['success'])) {
                $response['success'] = 1;
                $response['message'] = $this->language->get('text_updated');
            } else {
                $response['message'] = $this->language->get('error_warning');
            }

            return $response;
        }

        $add_response = $this->addProduct($data);

        if (isset($add_response['product_id'])) {
            $product['onlineshops']['opencart']['data']['product_id'] = $add_response['product_id'];
            $product['onlineshops']['opencart']['data']['status'] = 1;

            $this->model_catalog_product->setProduct2OnlineshopData($user_id, $product['sku'], 'opencart', $product['onlineshops']['opencart']['data']);

            $this->model_catalog_product->setOnlineshopProductId($user_id, $product['sku'], 'opencart', $product['onlineshops']['opencart']['data']['product_id']);

            $response['success'] = 1;
            $response['message'] = $this->language->get('text_uploaded');
        } elseif (isset($add_response['error'])) {
            if (mb_strpos($add_response['error'], 'Product not found') !== false) {
                unset($product['onlineshops']['opencart']['data']['product_id']);

                $this->model_catalog_product->setProduct2OnlineshopData($user_id, $product['sku'], 'opencart', $product['onlineshops']['opencart']['data']);

                $this->model_catalog_product->setOnlineshopProductId($user_id, $product['sku'], 'opencart', 0);

                return $this->syncProduct($user_id, $sku, $product);
            }

            $response['message'] = $add_response['error'];
        } else {
            $response['message'] = $this->language->get('error_warning');
        }

        return $response;
    }

    public function getOrders($user_id) {
        $response = array();

        if (!$this->connect($user_id)) {
            return $response;
        }

        $this->load->model('integration/onlineshop/onlineshop');
        $this->load->model('catalog/product');
        $this->load->model('sale/order');
        $this->load->model('localisation/country');

        $this->load->language('sale/order');

        $max = 50;

        $orders = $this->getOrdersPrivate(array('limit' => $max));

        if (!isset($orders['orders'])) {
            return $response;
        }

        foreach ($orders['orders'] as $order) {
            $order_data['onlineshop_order_id'] = $order['order_id'];

            $order_data['date_added'] = $order['date_added'];
            $order_data['date_modified'] = $order['date_modified'];

            $order_id = $this->model_sale_order->getOrderIdByOnlineshopOrderId($user_id, $order_data['onlineshop_order_id']);

            if ($order['status'] == 'complete') {
                $order_data['order_status'] = $this->config->get('config_complete_status')[0];
            }

            if ($order['status'] == 'fraud') {
                $order_data['order_status'] = $this->config->get('order_status_id');
            }

            if ($order_id) {
                $order_data['order_id'] = $order_id;

                $response[] = $order_data;
                continue;
            }

            $order_data['invoice_prefix'] = $this->config->get('config_invoice_prefix');

            $order_data['store_name'] = $this->user->get('company');
            $order_data['store_url'] = $this->user->get('website');
            $order_data['onlineshop_code'] = 'opencart';

            $order_data['fullname'] = $order['firstname'] . ' ' . $order['lastname'];
            $order_data['email'] = $order['email'];
            $order_data['telephone'] = $order['telephone'];

            $order_data['shipping_company'] = $order['shipping_company'];
            $order_data['shipping_address_1'] = $order['shipping_address_1'];
            $order_data['shipping_address_2'] = $order['shipping_address_2'];
            $order_data['shipping_city'] = $order['shipping_city'];
            $order_data['shipping_postcode'] = $order['shipping_postcode'];

            $order_data['comment'] = $order['comment'];

            $country = $this->model_localisation_country->getCountryByCode($order['shipping_country_code']);

            if ($country) {
                $order_data['shipping_country_id'] = $country['country_id'];
                $order_data['shipping_country'] = $country['name'];
            } else {
                $order_data['shipping_country_id'] = '';
                $order_data['shipping_country'] = $order['shipping_country'];
            }

            $order_data['shipping_zone_id'] = '';
            $order_data['shipping_zone'] = $order['shipping_zone'];

            $order_data['shipping_method'] = $order['shipping_method'];
            $order_data['shipping_code'] = '';

            $order_data['order_product'] = array();

            foreach ($order['products'] as $order_product) {
                $product = $this->model_catalog_product->getProductByOnlineshopProductId($user_id, 'opencart', $order_product['product_id']);

                if ($product) {
                    $product_id = $product['product_id'];
                    $sku = $product['sku'];
                    $weight = $product['weight'];
                } else {
                    $product_id = '';
                    $sku = '';
                    $weight = 0;
                }

                $order_data['order_product'][] = array(
                    'product_id'	=> $product_id,
                    'sku'			=> $sku,
                    'name'			=> $order_product['name'],
                    'quantity'		=> $order_product['quantity'],
                    'price'			=> $order_product['price'],
                    'total'			=> $order_product['total'],
                    'weight'		=> $weight,
                );
            }

            $total_data = array();
            $total = 0;

            foreach ($order['totals'] as $order_total) {
                if ($order_total['code'] === 'total') {
                    break;
                }

                $total_data[$order_total['code']] = array(
                    'code' => $order_total['code'],
                    'title' => $order_total['title'],
                    'value' => $order_total['value'],
                    'sort_order' => count($total_data) + 1,
                );

                $total += (float) $order_total['value'];
            }

            $total_data['total'] = array(
                'code' => 'total',
                'title' => $this->language->get('text_total'),
                'value' => $total,
                'sort_order' => '9',
            );

            $order_data['order_totals'] = $total_data;
            $order_data['total'] = $total;

            $order_data['currency_code'] = $order['currency_code'];
            $order_data['currency_id'] = $this->currency->getId($order_data['currency_code']);
            $order_data['currency_value'] = $this->currency->getValue($order_data['currency_code']);

            $response[] = $order_data;
        }

        if (isset($order['date_modified'])) {
            $this->session->data['opencart']['order_date_modified'] = $this->setStorageValue($user_id, 'order_date_modified', $order['date_modified']);
        }

        return $response;
    }

    //
    // FUNCTIONS
    //

    private function getOrdersPrivate($data = array()) {
        $data['date_modified'] = $this->session->data['opencart']['order_date_modified'];

        $response = $this->request('orders/get', $data);

        return $response;
    }

    private function addProduct($data) {
        $response = $this->request('product/add',$data);

        return $response;
    }

    private function editProduct($data) {
        $response = $this->request('product/edit', $data);

        return $response;
    }

    private function editStatus($data) {
        $response = $this->request('product/status', $data);

        return $response;
    }

    private function deleteProduct($data) {
        $response = $this->request('product/delete', $data);

        return $response;
    }

    public function addManufacturer($data) {
        $response = $this->request('manufacturer/add', $data);

        $this->oc_manufacturers = false;

        return $response;
    }

    public function getManufacturers() {
        if ($this->oc_manufacturers !== false) {
            return $this->oc_manufacturers;
        }

        $response = $this->request('manufacturer/list');

        if (isset($response['manufacturers'])) {
            $this->oc_manufacturers = $response['manufacturers'];
        } else {
            $this->oc_manufacturers = false;
        }

        return $this->oc_manufacturers;
    }

    public function addCategory($data) {
        $response = $this->request('category/add', $data);

        $this->oc_categories = false;

        return $response;
    }

    public function getCategories() {
        if ($this->oc_categories !== false) {
            return $this->oc_categories;
        }

        $response = $this->request('category/list');

        if (isset($response['categories'])) {
            $this->oc_categories = array_column($response['categories'], null, 'category_id');
        } else {
            $this->oc_categories = false;
        }

        return $this->oc_categories;
    }

    public function addFilterGroup($data) {
        $response = $this->request('filter/addGroup', $data);

        $this->oc_filter_groups = false;

        return $response;
    }

    public function getFilterGroups() {
        if ($this->oc_filter_groups !== false) {
            return $this->oc_filter_groups;
        }

        $response = $this->request('filter/listGroups');

        if (isset($response['filter_groups'])) {
            $this->oc_filter_groups = array_column($response['filter_groups'], null, 'filter_group_id');
        } else {
            $this->oc_filter_groups = false;
        }

        return $this->oc_filter_groups;
    }

    public function addFilter($data) {
        $response = $this->request('filter/addFilter', $data);

        $this->oc_filters = false;

        return $response;
    }

    public function getFilters($filter_group_id) {
        if ($this->oc_filters !== false) {
            return $this->oc_filters;
        }

        $response = $this->request('filter/listFilters', array('filter_group_id' => $filter_group_id));

        if (isset($response['filters'])) {
            $this->oc_filters = array_column($response['filters'], null, 'filter_id');
        } else {
            $this->oc_filters = false;
        }

        return $this->oc_filters;
    }

    private function login() {
        if (isset($this->session->data['opencart']['api_token']) and isset($this->session->data['opencart']['api_token_expired']) and ($this->session->data['opencart']['api_token_expired'] > time())) {
            $this->session->data['opencart']['api_token_expired'] = time()+60*15;

            return true;
        }

        if (!isset($this->session->data['opencart']['username']) or !isset($this->session->data['opencart']['key'])) {
            return false;
        }

        $url = trim($this->session->data['opencart']['website'], '/') . '/index.php?route=api/login';

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array('username' => $this->session->data['opencart']['username'], 'key' => $this->session->data['opencart']['key']));

        $response = curl_exec($ch);

        curl_close($ch);

        $response = json_decode($response, true);

        if (isset($response['api_token'])) {
            $this->session->data['opencart']['api_token'] = $response['api_token'];
            $this->session->data['opencart']['api_token_expired'] = time()+60*15;

            return true;
        }

        return false;
    }

    private function request($action, $post = array()) {
        if (!isset($this->session->data['opencart']['website'])) {
            return false;
        }

        $login = $this->login();

        if ($login == false) {
            return false;
        }

        if ($action === 'test') {
            return true;
        }

        $url = trim($this->session->data['opencart']['website'], '/') . '/index.php?route=api/' . $action;

        if (!empty($this->session->data['opencart']['api_token'])) {
            $url .= '&api_token=' . $this->session->data['opencart']['api_token'];
        }

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json;charset=utf-8',
            'Accept: application/json'
        ));

        if ($post) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
        }


        $response = curl_exec($ch);

        curl_close($ch);

        return json_decode($response, true);
    }
}