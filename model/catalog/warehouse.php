<?php
namespace Opencart\Catalog\Model\Catalog;
class Warehouse extends \Opencart\System\Engine\Model {
	public function getWarehouse($user_id, $warehouse_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "warehouse w LEFT JOIN " . DB_PREFIX . "user_to_warehouse utw ON utw.warehouse_id = w.warehouse_id WHERE w.warehouse_id  = '" . (int) $warehouse_id . "' AND utw.user_id = '" . (int) $user_id . "'");
		
		return $query->row;
	}

	public function getWarehouses($user_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "warehouse w LEFT JOIN " . DB_PREFIX . "user_to_warehouse utw ON utw.warehouse_id = w.warehouse_id WHERE utw.user_id  = '" . (int) $user_id . "'");
		
		return array_column($query->rows, null, 'warehouse_id');
	}
	
	public function addWarehouse($user_id, $data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "warehouse SET name = '" . $this->db->escape($data['name']) . "', sku_prefix = '" . $this->db->escape($data['sku_prefix']) . "', address_1 = '" . $this->db->escape($data['address_1']) . "', address_2 = '" . $this->db->escape($data['address_2']) . "', city = '" . $this->db->escape($data['city']) . "', postcode = '" . $this->db->escape($data['postcode']) . "', country_id = '" . (int) $data['country_id'] . "', zone_id = '" . (int) $data['zone_id'] . "', email = '" . $this->db->escape($data['email']) . "', phone = '" . $this->db->escape($data['phone']) . "'");

		$warehouse_id = $this->db->getLastId();
		
		$this->db->query("INSERT INTO " . DB_PREFIX . "user_to_warehouse SET warehouse_id = '" . (int) $warehouse_id . "', user_id = '" . (int) $user_id . "'");
		
		return $warehouse_id;
	}
	
	public function editWarehouse($user_id, $warehouse_id, $data) {
		$query = $this->db->query("SELECT w.warehouse_id FROM " . DB_PREFIX . "warehouse w LEFT JOIN " . DB_PREFIX . "user_to_warehouse utw ON utw.warehouse_id = w.warehouse_id WHERE w.warehouse_id  = '" . (int) $warehouse_id . "' AND utw.user_id = '" . (int) $user_id . "'");
		
		if ($query->row) {
			$this->db->query("UPDATE " . DB_PREFIX . "warehouse SET name = '" . $this->db->escape($data['name']) . "', sku_prefix = '" . $this->db->escape($data['sku_prefix']) . "', address_1 = '" . $this->db->escape($data['address_1']) . "', address_2 = '" . $this->db->escape($data['address_2']) . "', city = '" . $this->db->escape($data['city']) . "', postcode = '" . $this->db->escape($data['postcode']) . "', country_id = '" . (int) $data['country_id'] . "', zone_id = '" . (int) $data['zone_id'] . "', email = '" . $this->db->escape($data['email']) . "', phone = '" . $this->db->escape($data['phone']) . "' WHERE warehouse_id  = '" . (int) $warehouse_id . "'");
		}
	}
	
	public function deleteWarehouse($user_id, $warehouse_id) {
		$query = $this->db->query("SELECT w.warehouse_id FROM " . DB_PREFIX . "warehouse w LEFT JOIN " . DB_PREFIX . "user_to_warehouse utw ON utw.warehouse_id = w.warehouse_id WHERE w.warehouse_id  = '" . (int) $warehouse_id . "' AND utw.user_id = '" . (int) $user_id . "'");
		
		if ($query->row) {
			$this->db->query("DELETE FROM " . DB_PREFIX . "warehouse WHERE warehouse_id = '" . (int) $warehouse_id . "'");
			$this->db->query("DELETE FROM " . DB_PREFIX . "user_to_warehouse WHERE warehouse_id = '" . (int) $warehouse_id . "'");
			$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_warehouse WHERE warehouse_id = '" . (int) $warehouse_id . "'");
			
			return true;
		}
		
		return false;
	}
}