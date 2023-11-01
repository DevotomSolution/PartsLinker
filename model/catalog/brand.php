<?php
namespace Opencart\Catalog\Model\Catalog;
class Brand extends \Opencart\System\Engine\Model {
	public function getBrands($data = array()) {
		if($data) {
			$sql = "SELECT name, code FROM " . DB_PREFIX . "brands";

			if (!empty($data['filter_name'])) {
				$sql .= " WHERE name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
			}

			if (isset($data['start']) || isset($data['limit'])) {
				if ($data['start'] < 0) {
					$data['start'] = 0;
				}

				if ($data['limit'] < 1) {
					$data['limit'] = 20;
				}

				$sql .= " LIMIT " . (int) $data['start'] . "," . (int) $data['limit'];
			}

			$query = $this->db->query($sql);

			return $query->rows;
		} else {
			$brand_data = $this->cache->get('brand');

			if (!$brand_data) {
				$query = $this->db->query("SELECT name, code FROM " . DB_PREFIX . "brands");
				$brand_data = $query->rows;

				$this->cache->set('brand', $brand_data);
			}

			return $brand_data;
		}
	}
	
	public function getUserBrands($user_id) {
		$query = $this->db->query("SELECT DISTINCT brand as name FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_to_user ptu ON p.product_id = ptu.product_id WHERE ptu.user_id = '" . (int) $user_id . "' AND p.brand != ''");
		
		return $query->rows;
	}
	
	public function getBrandCodeByName($brand_name) {
		$query = $this->db->query("SELECT code FROM " . DB_PREFIX . "brands WHERE name = '" . $this->db->escape($brand_name) . "'");
		
		if(isset($query->row['code'])) {
			return $query->row['code'];
		} else {
			return false;
		}
	}
	
}