<?php
namespace Opencart\Catalog\Model\Integration\Delivery;
class Delivery extends \Opencart\System\Engine\Model {
	public function getDeliveryMethods() {
		$methods = array(
			'dpdro' => array(
				'code' => 'dpdro',
				'title' => 'DPD',
				'image' => 'view/img/integration/dpd.png',
				'country' => 'RO',
			),
		);
		
		return $methods;
	}
	
	public function getActiveDeliveryMethods($user_id) {
		$delivery_methods = $this->getDeliveryMethods();
		
		$active_methods = array();
		
		foreach($delivery_methods as $delivery_method) {
			$this->load->model('integration/delivery/' . $delivery_method['code']);

			$connect = $this->{'model_integration_delivery_' . $delivery_method['code']}->connect($user_id);
		
			if($connect) {
				$active_methods[$delivery_method['code']] = $delivery_method;
			}
		}
		
		return $active_methods;
	}
	
	public function getStorage($user_id, $delivery_code) {
		$query = $this->db->query("SELECT storage FROM " . DB_PREFIX . "user_delivery WHERE user_id = '" . (int) $user_id . "' AND code = '" . $this->db->escape($delivery_code) . "'");

		if(isset($query->row['storage'])) {
			return json_decode($query->row['storage'], true);
		} else {
			return array();
		}
	}
	
	public function editStorage($user_id, $delivery_code, $data) {
		$storage = json_encode($data);
		
		$this->db->query("REPLACE INTO " . DB_PREFIX . "user_delivery SET user_id = '" . (int) $user_id . "', code = '" . $this->db->escape($delivery_code) . "', storage = '" . $this->db->escape($storage) . "'");
	}
}