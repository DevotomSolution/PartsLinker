<?php
namespace Opencart\Catalog\Model\Integration\Onlineshop;
class Onlineshop extends \Opencart\System\Engine\Model {
	public function getOnlineshops() {
		$onlineshops = array(
			'ebayit' => array(
				'code' => 'ebayit',
				'title' => 'ebay.it',
				'image' => 'view/img/integration/ebay.png',
				'country' => 'IT',
				'type' => 'marketplace',
			),
			'pieseauto' => array(
				'code' => 'pieseauto',
				'title' => 'pieseauto.ro',
				'image' => 'view/img/integration/pieseauto.png',
				'country' => 'RO',
				'type' => 'marketplace',
			),
			'autovit' => array(
				'code' => 'autovit',
				'title' => 'autovit.ro',
				'image' => 'view/img/integration/autovitolx.png',
				'country' => 'RO',
				'type' => 'marketplace',
			),
            'subito' => array(
                'code' => 'subito',
                'title' => 'subito.it',
                'image' => 'https://assets.subito.it/static/logos/corporate.svg',
                'contry' => 'IT',
                'type' => 'marketplace',
            ),
			'opencart' => array(
				'code' => 'opencart',
				'title' => 'You opencart',
				'image' => 'view/img/integration/opencart.png',
				'country' => '',
				'type' => 'onlineshop',
			),
            'shopify' => array(
                'code' => 'shopify',
                'title' => 'Shopify',
                'image' => 'view/img/integration/shopify.png',
                'country' => '',
                'type' => 'onlineshop',
            ),
			'baselinker' => array(
				'code' => 'baselinker',
				'title' => 'baselinker.com',
				'image' => 'view/img/integration/baselinker.png',
				'country' => '',
				'type' => 'other',
			),
		);
		
		return $onlineshops;
	}
	
	public function getStorage($user_id, $onlineshop_code) {
		$query = $this->db->query("SELECT storage FROM " . DB_PREFIX . "user_onlineshop WHERE user_id = '" . (int) $user_id . "' AND code = '" . $this->db->escape($onlineshop_code) . "'");

		if(isset($query->row['storage'])) {
			return json_decode($query->row['storage'], true);
		} else {
			return array();
		}
	}
	
	public function editStorage($user_id, $onlineshop_code, $data) {
		$storage = json_encode($data);
		$this->db->query("REPLACE INTO " . DB_PREFIX . "user_onlineshop SET user_id = '" . (int) $user_id . "', code = '" . $this->db->escape($onlineshop_code) . "', storage = '" . $this->db->escape($storage) . "'");
	}
	
	public function setStorageValue($user_id, $onlineshop_code, $name, $value) {
		$storage = $this->getStorage($user_id, $onlineshop_code);
		
		$storage[$name] = $value;
		
		$this->editStorage($user_id, $onlineshop_code, $storage);
		
		return $value;
	}
	
	public function getActiveOnlineshops($user_id) {
		$onlineshops = $this->getOnlineshops();
		
		$active_onlineshops = array();
		
		foreach($onlineshops as $onlineshop) {
			$this->load->model('integration/onlineshop/' . $onlineshop['code']);

			$connect = $this->{'model_integration_onlineshop_' . $onlineshop['code']}->connect($user_id);
		
			if($connect) {
				$active_onlineshops[$onlineshop['code']] = $onlineshop;
			}
		}
		
		return $active_onlineshops;
	}
	
	public function syncProduct($user_id, $sku) {
		$response = array();
		
		$onlineshops = $this->model_integration_onlineshop_onlineshop->getActiveOnlineshops($user_id);
		
		$this->load->language('integration/onlineshop/onlineshop');
		$this->load->model('catalog/product');
		
		$product = $this->model_catalog_product->getProduct($user_id, $sku);
		
		foreach($onlineshops as $code => $onlineshop) {
			$onlineshop_response = $this->{'model_integration_onlineshop_' . $code}->syncProduct($user_id, $sku, $product);
			
			if(is_array($onlineshop_response) and isset($onlineshop_response['success']) and !empty($onlineshop_response['message'])) {
				$response[$code] = $onlineshop_response;
				$response[$code]['title'] = $onlineshop['title'];
			}
		}
		
		return $response;
	}
	
	public function getOrders($user_id) {
		$orders = array();
		
		$onlineshops = $this->getActiveOnlineshops($user_id);
		
		foreach($onlineshops as $code => $onlineshop) {
			$response = $this->{'model_integration_onlineshop_' . $code}->getOrders($user_id);
			
			if($response) {
				$orders = array_merge($orders, $response);
			}
			
			if (count($orders) >= 50) {
				break;
			}
		}

		return $orders;
	}
	
	public function syncVehicle4Parts($user_id, $sku) {
		$response = array();
		
		return $response;
	}
}