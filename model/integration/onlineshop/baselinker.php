<?php
namespace Opencart\Catalog\Model\Integration\Onlineshop;
class Baselinker extends \Opencart\System\Engine\Model {
	private $inventory_categories = false;
	private $inventory_manufacturers = false;
	
	public function getStorage($user_id) {
		$this->load->model('integration/onlineshop/onlineshop');
		
		return $this->model_integration_onlineshop_onlineshop->getStorage($user_id, 'baselinker');
	}
	
	public function editStorage($user_id, $storage) {
		$this->load->model('integration/onlineshop/onlineshop');
		
		$this->model_integration_onlineshop_onlineshop->editStorage($user_id, 'baselinker', $storage);
	}
	
	public function setStorageValue($user_id, $key, $value) {
		$this->load->model('integration/onlineshop/onlineshop');
		
		return $this->model_integration_onlineshop_onlineshop->setStorageValue($user_id, 'baselinker', $key, $value);
	}
	
	public function connect($user_id, $rewrite = false) {
		if (isset($this->session->data['baselinker']['connected']) and !$rewrite) {
			return $this->session->data['baselinker']['connected'];
		}
		
		$this->session->data['baselinker'] = array();
		
		$this->session->data['baselinker']['connected'] = 0;
		
		$storage = $this->getStorage($user_id);
		
		if (!isset($storage['token'])) {
			return 0;
		}
		
		$this->session->data['baselinker']['token'] = $storage['token'];
		
		if (!$this->getInventories()) {
			return 0;
		}
		
		if (!isset($storage['inventory_id'])) {
			$storage['inventory_id'] = 0;
		}
		
		if (!isset($storage['warehouse_id'])) {
			$storage['warehouse_id'] = 0;
		}
		
		if (!isset($storage['price_group_id'])) {
			$storage['price_group_id'] = 0;
		}
		
		if (!isset($storage['currency'])) {
			$storage['currency'] = 0;
		}
		
		if (!isset($storage['date_confirmed_from'])) {
			$storage['date_confirmed_from'] = $this->setStorageValue($user_id, 'date_confirmed_from', time());
		}
		
		$this->session->data['baselinker'] = $storage;
		
		$this->session->data['baselinker']['connected'] = 1;
		
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
		
		$this->load->language('integration/onlineshop');
		
		$this->load->model('catalog/product');
		$this->load->model('catalog/category');
	
		if ($product === false) {
			$product = $this->model_catalog_product->getProduct($user_id, $sku);
		}
		
		if (isset($product['onlineshops']['baselinker']['data']['product_id']) and (!$product['onlineshops']['baselinker']['status'] or !$product['quantity'] or !$product['status'])) {
			$this->deleteInventoryProduct($product['onlineshops']['baselinker']['data']['product_id']);
			
			$this->model_catalog_product->setProduct2OnlineshopData($user_id, $sku, 'baselinker', array());
			
			$response['success'] = 1;
			$response['message'] = $this->language->get('text_deleted');
			
			return $response;
		} 
		
		if (!$product) {
			$onlineshop_data = $this->model_catalog_product->getProduct2OnlineshopData($user_id, $sku, 'baselinker');
			
			if (isset($onlineshop_data['product_id'])) {
				$this->deleteInventoryProduct($onlineshop_data['product_id']);
				
				$this->model_catalog_product->deleteProduct2Onlineshop($user_id, $sku, 'baselinker');
				
				$response['success'] = 1;
				$response['message'] = $this->language->get('text_deleted');
			} else {
				return $response;
			}
		}
		
		if (!$product['onlineshops']['baselinker']['status']) {
			return false;
		}
		
		if (!$product['quantity'] or !$product['status']) {
			$response['success'] = 1;
			$response['message'] = $this->language->get('text_ignored');
			
			return $response;
		}
		
		// add product
		
		$images = array();
	
		if ($product['image']) {
			$images[] = HTTP_SERVER . DIR_IMAGE_RELATIVE . $product['image'];
		}
		
		$product_images = $this->model_catalog_product->getProductImages($user_id, $sku);
		
		foreach ($product_images as $product_image) {
			$images[] = HTTP_SERVER . DIR_IMAGE_RELATIVE . $product_image['image'];
		}
		
		if (isset($product['onlineshops']['baselinker']['data']['product_id'])) {
			$baselinker_product_id = $product['onlineshops']['baselinker']['data']['product_id'];
		} else {
			$baselinker_product_id = '';
		}
		
		$description = html_entity_decode($product['description']);
		
		if (isset($this->session->data['baselinker']['general_description'])) {
			$description .= html_entity_decode($this->session->data['baselinker']['general_description']);
		}
		
		$data = array(
			'name'			=> $product['name'],
			'description'	=> $description,
			'images'		=> $images,
			'sku'			=> $product['sku'],
			'product_id'	=> $baselinker_product_id,
			'ean'			=> $product['ean'],
			'price'			=> $this->currency->convert($product['price'], 1, $this->session->data['baselinker']['currency']),
			'quantity'		=> $product['quantity'],
			'weight'		=> $product['weight'],
			'location'		=> $product['location'],
		);
		

		$product_categories = $this->model_catalog_product->getProductCategories($user_id, $sku);
		
		if ($product_categories) {
			$baselinker_categories = $this->getInventoryCategories();
			
			foreach ($product_categories as $product_category) {
				$category_data = $this->model_catalog_category->getCategory($product_category['category_id']);
				
				foreach ($category_data['translates'] as $language_id => $name) {
					
					foreach ($baselinker_categories as $baselinker_category) {
						if (strtolower(str_replace(array(' ', '-'), '', $name)) === strtolower(str_replace(array(' ', '-'), '', $baselinker_category['name']))) {
							$data['category_id'] = $baselinker_category['category_id'];
							break 3;
						}
					}
				}
			}
		}
		
		if ($product['brand']) {
			$baselinker_manufacturers = $this->getInventoryManufacturers();
			
			foreach ($baselinker_manufacturers as $baselinker_manufacturer) {
				if (strtolower(str_replace(array(' ', '-'), '', $product['brand'])) === strtolower(str_replace(array(' ', '-'), '', $baselinker_manufacturer['name']))) {
					$data['manufacturer_id'] = $baselinker_manufacturer['manufacturer_id'];
					break;
				}
			}
		}
		
		
		
		$add_response = $this->addInventoryProduct($data);
		
		if ($add_response['status'] === 'SUCCESS') {
			if ($baselinker_product_id === '') {
				$product['onlineshops']['baselinker']['data']['product_id'] = $add_response['product_id'];
				
				$this->model_catalog_product->setProduct2OnlineshopData($user_id, $product['sku'], 'baselinker', $product['onlineshops']['baselinker']['data']);
				
				$this->model_catalog_product->setOnlineshopProductId($user_id, $product['sku'], 'baselinker', $product['onlineshops']['baselinker']['data']['product_id']);
				
				$response['message'] = $this->language->get('text_uploaded');
			} else {
				$response['message'] = $this->language->get('text_updated');
			}
			
			$response['success'] = 1;
		} else if ($add_response['status'] === 'ERROR') {
			if (mb_strpos($add_response['error_message'], 'No product with ID') !== false) {
				unset($product['onlineshops']['baselinker']['data']['product_id']);
				
				$this->model_catalog_product->setProduct2OnlineshopData($user_id, $product['sku'], 'baselinker', $product['onlineshops']['baselinker']['data']);
				
				$this->model_catalog_product->setOnlineshopProductId($user_id, $product['sku'], 'baselinker', 0);
				
				return $this->syncProduct($user_id, $sku, $product);
			}
			
			$response['message'] = $add_response['error_message'];
		}
		
		return $response;
	}
	
	public function syncOrder($user_id, $order_data) {
		return true;
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
		
		$orders = $this->getOrdersPrivate();
		
		if ($orders['status'] !== 'SUCCESS') {
			return $response;
		}
		
		foreach ($orders['orders'] as $order) {
			$order_data['onlineshop_order_id'] = $order['order_id'];
			
			$order_data['date_added'] = date("Y-m-d H:i:s", $order['date_confirmed']);
			$order_data['date_modified'] = date("Y-m-d H:i:s", $order['date_in_status']);
			
			$order_id = $this->model_sale_order->getOrderIdByOnlineshopOrderId($user_id, $order_data['onlineshop_order_id']);
			
			if ($order['order_status_id'] == '1471' && $order_id) {
				$order_data['order_status'] = $this->config->get('config_complete_status')[0];
			}
			
			if ($order_id) {
				$order_data['order_id'] = $order_id;
				
				$response[] = $order_data;
				continue;
			}
			
			$order_data['invoice_prefix'] = $this->config->get('config_invoice_prefix');
			
			$order_data['store_name'] = $this->user->get('company');
			$order_data['store_url'] = $this->user->get('website');
			$order_data['onlineshop_code'] = 'baselinker';
			
			$order_data['fullname'] = $order['delivery_fullname'];
			$order_data['email'] = $order['email'];
			$order_data['telephone'] = $order['phone'];
			
			$order_data['shipping_company'] = $order['delivery_company'];
			$order_data['shipping_address_1'] = $order['delivery_address'];
			$order_data['shipping_address_2'] = '';
			$order_data['shipping_city'] = $order['delivery_city'];
			$order_data['shipping_postcode'] = $order['delivery_postcode'];
			
			$order_data['comment'] = $order['user_comments'];

			$country = $this->model_localisation_country->getCountryByCode($order['delivery_country_code']);
			
			if ($country) {
				$order_data['shipping_country_id'] = $country['country_id'];
				$order_data['shipping_country'] = $country['name'];
			} else {
				$order_data['shipping_country_id'] = '';
				$order_data['shipping_country'] = '';
			}
			
			$order_data['shipping_zone'] = '';
			$order_data['shipping_zone_id'] = '';
			
			$order_data['shipping_method'] = $order['delivery_method'];
			$order_data['shipping_code'] = '';
			
			$order_data['order_product'] = array();
			
			$sub_total = 0;
			
			foreach ($order['products'] as $order_product) {
				$product = $this->model_catalog_product->getProductByOnlineshopProductId($user_id, 'baselinker', $order_product['order_product_id']);
				
				if ($product) {
					$product_id = $product['product_id'];
					$sku = $product['sku'];
				} else {
					$product_id = '';
					$sku = '';
				}
				
				$order_data['order_product'][] = array(
					'product_id'	=> $product_id,
					'sku'			=> $sku,
					'name'			=> $order_product['name'],
					'quantity'		=> $order_product['quantity'],
					'price'			=> $order_product['price_brutto'],
					'total'			=> $order_product['price_brutto'] * $order_product['quantity'],
					'weight'		=> $order_product['weight'],
				);
				
				$sub_total += $order_product['price_brutto'] * $order_product['quantity'];
			}
			
			$total_data = array();
			$total = 0;
			
			$total_data['sub_total'] = array(
				'code' => 'sub_total',
				'title' => $this->language->get('text_sub_total'),
				'value' => $sub_total,
				'sort_order' => '1',
			);
			
			$total += $sub_total;
			
			$total_data['shipping'] = array(
				'code' => 'shipping',
				'title' => $this->language->get('text_shipping'),
				'value' => $order['delivery_price'],
				'sort_order' => '2',
			);
			
			$total += (float) $order['delivery_price'];
			
			$total_data['total'] = array(
				'code' => 'total',
				'title' => $this->language->get('text_total'),
				'value' => $total,
				'sort_order' => '9',
			);
			
			$order_data['order_totals'] = $total_data;
			$order_data['total'] = $total;
			
			$order_data['currency_code'] = $order['currency'];
			$order_data['currency_id'] = $this->currency->getId($order_data['currency_code']);
			$order_data['currency_value'] = $this->currency->getValue($order_data['currency_code']);
			
			$response[] = $order_data;
			
			$date_confirmed_from = $order['date_confirmed'] + 1;
		}
		
		if (isset($date_confirmed_from)) {
			$this->session->data['baselinker']['date_confirmed_from'] = $this->setStorageValue($user_id, 'date_confirmed_from', $date_confirmed_from);
		}
		
		return $response;
	}
	
	private function getOrdersPrivate() {
		$methodParams = array(
			'date_confirmed_from' => $this->session->data['baselinker']['date_confirmed_from'],
			'get_unconfirmed_orders' => false,
		);
		
		$apiParams = [
			"method" => "getOrders",
			"parameters" => json_encode($methodParams)
		];
		
		return $this->request($this->session->data['baselinker']['token'], $apiParams);
	}
	
	private function addInventoryProduct($data) {
		$methodParams = array(
			'inventory_id' => $this->session->data['baselinker']['inventory_id'],
			'ean' => $data['ean'],
			'sku' => $data['sku'],
			//'is_bundle' => false,
			'prices' => array(
				$this->session->data['baselinker']['price_group_id'] => $data['price'],
			),
			'stock' => array(
				$this->session->data['baselinker']['warehouse_id'] => $data['quantity'],
			),
			'text_fields' => array(
				'name' => $data['name'],
				'description' => $data['description'],
			),
		);
		
		if (isset($data['product_id']) and $data['product_id']) {
			$methodParams['product_id'] = $data['product_id'];
		}
		
		if (isset($data['weight']) and (float) $data['weight']) {
			$methodParams['weight'] = $data['weight'];
		}
		
		if (isset($data['location']) and $data['location']) {
			$methodParams['locations'] = array(
				$this->session->data['baselinker']['warehouse_id'] => $data['location'],
			);
		}
		
		if (isset($data['category_id'])) {
			$methodParams['category_id'] = $data['category_id'];
		}
		
		if (isset($data['manufacturer_id'])) {
			$methodParams['manufacturer_id'] = $data['manufacturer_id'];
		}
		
		if ($data['images']) {
			foreach ($data['images'] as $image) {
				$methodParams['images'][] = 'url:' . $image;
			}
		}
		
		$apiParams = [
			"method" => "addInventoryProduct",
			"parameters" => json_encode($methodParams)
		];
		
		return $this->request($this->session->data['baselinker']['token'], $apiParams);
	}
	
	private function deleteInventoryProduct($baselinker_product_id) {
		$methodParams = array(
			'product_id' => $baselinker_product_id,
		);
		
		$apiParams = [
			"method" => "deleteInventoryProduct",
			"parameters" => json_encode($methodParams)
		];
		
		return $this->request($this->session->data['baselinker']['token'], $apiParams);
	}

	public function getInventoryManufacturers() {
		if ($this->inventory_manufacturers !== false) {
			return $this->inventory_manufacturers;
		}
		
		$methodParams = array();
		
		$apiParams = [
			"method" => "getInventoryManufacturers",
			"parameters" => json_encode($methodParams)
		];
		
		$response = $this->request($this->session->data['baselinker']['token'], $apiParams);
		
		if ($response['status'] === 'SUCCESS') {
			$this->inventory_manufacturers = $response['manufacturers'];
		} else {
			$this->inventory_manufacturers = false;
		}
		
		
		return $this->inventory_manufacturers;
	}
	
	public function addInventoryManufacturer($data) {
		$methodParams = array(
			'name' => $data['name'],
		);
		
		$apiParams = [
			"method" => "addInventoryManufacturer",
			"parameters" => json_encode($methodParams)
		];
		
		$this->inventory_manufacturers = false;
		
		return $this->request($this->session->data['baselinker']['token'], $apiParams);
	}	
	
	public function getInventoryCategories() {
		if ($this->inventory_categories !== false) {
			return $this->inventory_categories;
		}
		
		$methodParams = array();
		
		$apiParams = [
			"method" => "getInventoryCategories",
			"parameters" => json_encode($methodParams)
		];
		
		$response = $this->request($this->session->data['baselinker']['token'], $apiParams);
		
		if ($response['status'] === 'SUCCESS') {
			$this->inventory_categories = $response['categories'];
		} else {
			$this->inventory_categories = false;
		}
		
		return $this->inventory_categories;
	}
	
	public function addInventoryCategory($data) {
		$methodParams = array(
			'name' => $data['name'],
			'parent_id' => $data['parent_id'],
		);
		
		$apiParams = [
			"method" => "addInventoryCategory",
			"parameters" => json_encode($methodParams)
		];
		
		$this->inventory_categories = false;
		
		return $this->request($this->session->data['baselinker']['token'], $apiParams);
	}
	
	public function getInventories() {
		$methodParams = '{}';
		
		$apiParams = [
			"method" => "getInventories",
			"parameters" => $methodParams
		];
		
		$response = $this->request($this->session->data['baselinker']['token'], $apiParams);
		
		if (isset($response['inventories'])) {
			return $response['inventories'];
		} else {
			return false;
		}
	}
	
	public function getInventoryWarehouses() {
		$methodParams = '{}';
		
		$apiParams = [
			"method" => "getInventoryWarehouses",
			"parameters" => $methodParams
		];
		
		$response = $this->request($this->session->data['baselinker']['token'], $apiParams);
		
		if (isset($response['warehouses'])) {
			return $response['warehouses'];
		} else {
			return false;
		}
	}
	
	public function getInventoryPriceGroups() {
		$methodParams = '{}';
		
		$apiParams = [
			"method" => "getInventoryPriceGroups",
			"parameters" => $methodParams
		];
		
		$response = $this->request($this->session->data['baselinker']['token'], $apiParams);
		
		if (isset($response['price_groups'])) {
			return $response['price_groups'];
		} else {
			return false;
		}
	}
	
	private function request($token, $apiParams) {
		$curl = curl_init("https://api.baselinker.com/connector.php");
		
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_HTTPHEADER, ["X-BLToken: " . $token]);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($apiParams));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		
		$response = curl_exec($curl);
		curl_close($curl);
		
		return json_decode($response, true);
	}
}