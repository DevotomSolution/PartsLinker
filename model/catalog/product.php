<?php
namespace Opencart\Catalog\Model\Catalog;
class Product extends \Opencart\System\Engine\Model {
	public function getTotalProducts($user_id, $data = array(), $language_id = false) {
		if (!$language_id) {
			$language_id = $this->config->get('config_language_id');
		}
		
		$sql = "SELECT COUNT(DISTINCT p.product_id) AS total FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_user ptu ON (p.product_id = ptu.product_id)";
		
		if (!empty($data['filter_vehicle_brand']) or !empty($data['filter_vehicle_model']) or !empty($data['filter_vehicle_engine'])) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "product_to_vehicle ptv ON (p.product_id = ptv.product_id) LEFT JOIN " . DB_PREFIX . "vehicle v ON (ptv.vehicle_id = v.vehicle_id)";
		}
		
		if (!empty($data['filter_vehicle_engine'])) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "product_vehicle_to_engine pvte ON (ptv.vehicle_id = pvte.vehicle_id)";
		}
		
		if (!empty($data['filter_category'])) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "product_to_category ptcat ON (p.product_id = ptcat.product_id)";
		}
		
		if (!empty($data['filter_vehicle4parts'])) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "product_to_vehicle4parts ptvp ON (p.product_id = ptvp.product_id) LEFT JOIN " . DB_PREFIX . "vehicle4parts_to_user vptu ON (ptvp.vehicle4parts_id = vptu.vehicle4parts_id)";
		}
		
		if (!empty($data['filter_onlineshop'])) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "product_to_onlineshop ptm ON (p.product_id = ptm.product_id)";
		}
		
		if (!empty($data['filter_warehouse'])) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "product_to_warehouse ptw ON (p.product_id = ptw.product_id)";
		}
		
		$sql .= " WHERE ptu.user_id = '" . (int) $user_id . "' AND (pd.language_id = '" . (int) $language_id . "' OR pd.language_id IS NULL)";
		
		if (!empty($data['search'])) {
			$sql .= " AND ((";
			
			$words = explode(' ', trim($data['search']));
			
			if (count($words) > 5) {
				$sql .= "pd.name LIKE '%" . $this->db->escape($data['search']) . "%' OR pd.description LIKE '%" . $this->db->escape($data['search']) . "%'";
			} else {
				foreach($words as $key => $word) {
					if ($key) {
						$sql .= " AND ";
					}
					
					$sql .= "(pd.name LIKE '%" . $this->db->escape($word) . "%' OR pd.description LIKE '%" . $this->db->escape($word) . "%')";
				}
			}

			$sql .= ") OR ptu.sku = '" . $this->db->escape($data['search']) . "' OR p.brand = '" . $this->db->escape($data['search']) . "')";
		}
		
		if (!empty($data['filter_vehicle_brand'])) {
			$sql .= " AND v.vehicle_brand_id ='" . (int) $data['filter_vehicle_brand'] . "'";
		}
		
		if (!empty($data['filter_vehicle_model'])) {
			$sql .= " AND v.vehicle_model_id ='" . (int) $data['filter_vehicle_model'] . "'";
		}
		
		if (!empty($data['filter_vehicle_engine'])) {
			$sql .= " AND (pvte.vehicle_engine_id ='" . (int) $data['filter_vehicle_engine'] . "' OR pvte.vehicle_engine_id IS NULL)";
		}

		if (!empty($data['filter_category'])) {
			$sql .= ' AND (';
			
			foreach (explode(',', $data['filter_category']) as $key => $category_id) {
				if ($key) {
					$sql .= ' OR ';
				}
				
				$sql .= "ptcat.category_id = '" . (int) $category_id . "'";
			}
			
			$sql .= ')';
		}
		
		if (!empty($data['filter_vehicle4parts'])) {
			$sql .= " AND vptu.sku = '" . $this->db->escape($data['filter_vehicle4parts']) . "'";
		}

		if (!empty($data['filter_onlineshop'])) {
			$sql .= " AND ptm.onlineshop_code = '" . $this->db->escape($data['filter_onlineshop']) . "' AND ptm.status = '1'";
		}
		
		if (!empty($data['filter_warehouse'])) {
			$sql .= " AND ptw.warehouse_id = '" . (int) $data['filter_warehouse'] . "'";
		}
		
		if (!empty($data['search_warehouse'])) {
			$sql .= " AND (pd.name LIKE '%" . $this->db->escape($data['search_warehouse']) . "%' OR ptu.sku = '" . $this->db->escape($data['search_warehouse']) . "' OR p.ean = '" . $this->db->escape($data['search_warehouse']) . "' OR p.location = '" . $this->db->escape($data['search_warehouse']) . "')";
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}
	
	public function getNewSku($user_id, $warehouse_id = false) {
		if ($warehouse_id) {
			$this->load->model('catalog/warehouse');
			
			$warehouse = $this->model_catalog_warehouse->getWarehouse($user_id, $warehouse_id);
			
			if (!$warehouse) {
				return '';
			}
		}
		
		$sql = "SELECT ptu.sku FROM " . DB_PREFIX . "product_to_user ptu LEFT JOIN " . DB_PREFIX . "product_to_warehouse ptw ON ptu.product_id = ptw.product_id WHERE ptu.user_id = '" . (int) $user_id . "'";
		
		if ($warehouse_id) {
			$sql .= " AND ptu.sku LIKE '" . $warehouse['sku_prefix'] . "%' AND (ptw.warehouse_id = '" . (int) $warehouse_id . "' OR ptw.warehouse_id IS NULL)";
		}
		
		$sql .= " ORDER BY ptu.date_added DESC, ptu.product_id DESC LIMIT 1";
		
		$query = $this->db->query($sql);
		
		$sku = '';
		
		if (isset($query->row['sku'])) {
			$sku = $query->row['sku'];
		}
		
		for($i = mb_strlen($sku) - 1; $i >= 0; $i -= 1) {
			if (is_numeric($sku[$i]) && (int) $sku[$i] < 9) {
				$sku[$i] = (int) $sku[$i] + 1;
				break;
			} elseif (is_numeric($sku[$i]) && (int) $sku[$i] == 9) {
				$sku[$i] = 0;
			}
		}
		
		if ($sku !== '') {
			if (!$this->getProductIdBySku($user_id, $sku)) {
				return (string) $sku;
			}
		}
		
		$sql = "SELECT ptu.sku FROM " . DB_PREFIX . "product_to_user ptu WHERE ptu.user_id = '" . (int) $user_id . "'";
		
		if ($warehouse_id) {
			$sql .= " AND ptu.sku LIKE '" . $warehouse['sku_prefix'] . "%'";
		}
		
		$sql .= " ORDER BY ptu.date_added DESC, ptu.product_id DESC LIMIT 1";
		
		$query = $this->db->query($sql);
		
		$sku = '';
		
		if (isset($query->row['sku'])) {
			$sku = $query->row['sku'];
		}
		
		for($i = mb_strlen($sku) - 1; $i >= 0; $i -= 1) {
			if (is_numeric($sku[$i]) && (int) $sku[$i] < 9) {
				$sku[$i] = (int) $sku[$i] + 1;
				break;
			} elseif (is_numeric($sku[$i]) && (int) $sku[$i] == 9) {
				$sku[$i] = 0;
			}
		}
		
		if ($sku === '') {
			if ($warehouse_id) {
				$sku = $warehouse['sku_prefix'] . '00001';
			} else {
				$sku = '00001';
			}
		}
		
		if (!$this->getProductIdBySku($user_id, $sku)) {
			return (string) $sku;
		} else {
			return '';
		}
	}
	
	public function getProductIdBySku($user_id, $sku) {
		$query = $this->db->query("SELECT product_id, sku FROM " . DB_PREFIX . "product_to_user WHERE user_id = '" . (int) $user_id . "' AND sku = '" . $this->db->escape($sku) . "'");

		if (isset($query->row['product_id'])) {
			return $query->row['product_id'];
		} else {
			return false;
		}
	}
	
	public function getSkuByProductId($user_id, $product_id) {
		$query = $this->db->query("SELECT sku FROM " . DB_PREFIX . "product_to_user WHERE user_id = '" . (int) $user_id . "' AND product_id = '" . (int) $product_id . "'");
		
		if (isset($query->row['sku'])) {
			return $query->row['sku'];
		} else {
			return false;
		}
	}
	
	public function getProductIdBySkuOrEan($user_id, $code) {
		$query = $this->db->query("SELECT ptu.product_id FROM " . DB_PREFIX . "product_to_user ptu LEFT JOIN " . DB_PREFIX . "product p ON ptu.product_id = p.product_id WHERE ptu.user_id = '" . (int) $user_id . "' AND (ptu.sku = '" . $this->db->escape($code) . "' OR p.ean = '" . $this->db->escape($code) . "')");
		
		if (isset($query->row['product_id'])) {
			return $query->row['product_id'];
		} else {
			return false;
		}
	}
	
	public function getProduct($user_id, $sku, $language_id = false) {
		if (!$language_id) {
			$language_id = $this->config->get('config_language_id');
		}
		
		$query = $this->db->query("SELECT *, p.product_id FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_user ptu ON (p.product_id = ptu.product_id) LEFT JOIN " . DB_PREFIX . "product_to_warehouse ptw ON (p.product_id = ptw.product_id) WHERE ptu.sku = '" . $this->db->escape($sku) . "' AND ptu.user_id = '" . (int) $user_id . "' AND (pd.language_id = '" . (int) $language_id . "' OR pd.language_id IS NULL)");
		
		if (isset($query->row['product_id'])) {
			$query->row['onlineshops'] = $this->getProductOnlineshops($query->row['product_id']);
			$query->row['link'] = '';
		}
		
		return $query->row;
	}
	
	public function getProducts($user_id, $data = array(), $language_id = false, $get_onlineshops = true) {
		if (!$language_id) {
			$language_id = $this->config->get('config_language_id');
		}
		
		$sql = "SELECT *, p.product_id, ptu.sku as sku, p.status FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_user ptu ON (p.product_id = ptu.product_id)";

		if (!empty($data['filter_vehicle_brand']) or !empty($data['filter_vehicle_model']) or !empty($data['filter_vehicle_engine'])) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "product_to_vehicle ptv ON (p.product_id = ptv.product_id) LEFT JOIN " . DB_PREFIX . "vehicle v ON (ptv.vehicle_id = v.vehicle_id)";
		}
		
		if (!empty($data['filter_vehicle_engine'])) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "product_vehicle_to_engine pvte ON (ptv.vehicle_id = pvte.vehicle_id)";
		}
		
		if (!empty($data['filter_category'])) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "product_to_category ptcat ON (p.product_id = ptcat.product_id)";
		}
		
		if (!empty($data['filter_vehicle4parts'])) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "product_to_vehicle4parts ptvp ON (p.product_id = ptvp.product_id) LEFT JOIN " . DB_PREFIX . "vehicle4parts_to_user vptu ON (ptvp.vehicle4parts_id = vptu.vehicle4parts_id)";
		}
		
		if (!empty($data['filter_onlineshop'])) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "product_to_onlineshop ptm ON (p.product_id = ptm.product_id)";
		}
		
		$sql .= " LEFT JOIN " . DB_PREFIX . "product_to_warehouse ptw ON (p.product_id = ptw.product_id)";
		
		$sql .= " WHERE ptu.user_id = '" . (int) $user_id . "' AND (pd.language_id = '" . (int) $language_id . "' OR pd.language_id IS NULL)";
		
		if (!empty($data['search'])) {
			$sql .= " AND ((";
			
			$words = explode(' ', trim($data['search']));
			
			if (count($words) > 5) {
				$sql .= "pd.name LIKE '%" . $this->db->escape($data['search']) . "%' OR pd.description LIKE '%" . $this->db->escape($data['search']) . "%'";
			} else {
				foreach($words as $key => $word) {
					if ($key) {
						$sql .= " AND ";
					}
					
					$sql .= "(pd.name LIKE '%" . $this->db->escape($word) . "%' OR pd.description LIKE '%" . $this->db->escape($word) . "%')";
				}
			}

			$sql .= ") OR ptu.sku = '" . $this->db->escape($data['search']) . "' OR p.brand = '" . $this->db->escape($data['search']) . "')";
		}
		
		if (!empty($data['filter_vehicle_brand'])) {
			$sql .= " AND v.vehicle_brand_id ='" . (int) $data['filter_vehicle_brand'] . "'";
		}
		
		if (!empty($data['filter_vehicle_model'])) {
			$sql .= " AND v.vehicle_model_id ='" . (int) $data['filter_vehicle_model'] . "'";
		}
		
		if (!empty($data['filter_vehicle_engine'])) {
			$sql .= " AND (pvte.vehicle_engine_id ='" . (int) $data['filter_vehicle_engine'] . "' OR pvte.vehicle_engine_id IS NULL)";
		}

		if (!empty($data['filter_category'])) {
			$sql .= ' AND (';
			
			foreach (explode(',', $data['filter_category']) as $key => $category_id) {
				if ($key) {
					$sql .= ' OR ';
				}
				
				$sql .= "ptcat.category_id = '" . (int) $category_id . "'";
			}
			
			$sql .= ')';
		}
		
		if (!empty($data['filter_vehicle4parts'])) {
			$sql .= " AND vptu.sku = '" . $this->db->escape($data['filter_vehicle4parts']) . "'";
		}
		
		if (!empty($data['filter_onlineshop'])) {
			$sql .= " AND ptm.onlineshop_code = '" . $this->db->escape($data['filter_onlineshop']) . "' AND ptm.status = '1'";
		}
		
		if (!empty($data['filter_warehouse'])) {
			$sql .= " AND ptw.warehouse_id = '" . (int) $data['filter_warehouse'] . "'";
		}
		
		if (!empty($data['search_warehouse'])) {
			$sql .= " AND (pd.name LIKE '%" . $this->db->escape($data['search_warehouse']) . "%' OR ptu.sku = '" . $this->db->escape($data['search_warehouse']) . "' OR p.ean = '" . $this->db->escape($data['search_warehouse']) . "' OR p.location = '" . $this->db->escape($data['search_warehouse']) . "')";
		}
		
		if (isset($data['name_required'])) {
			$sql .= " AND pd.name != ''";
		}
		
		$sql .= " GROUP BY p.product_id";
		
		$sort_data = array(
			'p.brand',
			'ptu.sku',
			'p.date_added',
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY p.date_added";
		}

		if (isset($data['order']) && ($data['order'] == 'ASC')) {
			$sql .= " ASC";
		} else {
			$sql .= " DESC";
		}
		
		$sql .= ", p.product_id";
		
		if (isset($data['order']) && ($data['order'] == 'ASC')) {
			$sql .= " ASC";
		} else {
			$sql .= " DESC";
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
		
		foreach($query->rows as $key => $product) {
			if ($get_onlineshops) {
				$query->rows[$key]['onlineshops'] = $this->getProductOnlineshops($product['product_id']);
			}
			
			$query->rows[$key]['link'] = '';
			
			if ($query->rows[$key]['catalog'] !== 'market') {
				$query->rows[$key]['name'] = $query->rows[$key]['mpn'] . ' ' . $query->rows[$key]['brand'];
			}
		}

		return $query->rows;
	}
	
	public function autocompleate($user_id, $search) {
		$sql = "SELECT pd.name, ptu.sku, p.price, p.weight FROM " . DB_PREFIX . "product_description pd LEFT JOIN " . DB_PREFIX . "product_to_user ptu ON (pd.product_id = ptu.product_id) LEFT JOIN " . DB_PREFIX . "product p ON (pd.product_id = p.product_id) WHERE ptu.user_id = '" . (int) $user_id . "' AND (pd.language_id = '" . (int) $this->config->get('config_language_id') . "' OR pd.language_id IS NULL) AND pd.name LIKE '" . $this->db->escape($search) . "%'";
		
		$query = $this->db->query($sql);

		return $query->rows;
	}
	
	public function addProduct($user_id, $data, $catalog = 'market') {
		$sku = $data['sku'];
		
		if (!isset($data['delivery'])) {
			$data['delivery'] = 0;
		}
		
		if (!isset($data['ean'])) {
			$data['ean'] = '';
		}
		
		if (!isset($data['oe'])) {
			$data['oe'] = '';
		}
		
		if (!isset($data['others'])) {
			$data['others'] = '';
		}
		
		if (!isset($data['location'])) {
			$data['location'] = '';
		}
		
		if (!isset($data['weight'])) {
			$data['weight'] = 0;
		}
		
		if (!isset($data['date_added'])) {
			$data['date_added'] = date("Y-m-d H:i:s");
		}

		$this->db->query("INSERT INTO " . DB_PREFIX . "product SET brand = '" . $this->db->escape($data['brand']) . "', vehicle_position_id = '" . (int) $data['vehicle_position_id'] . "', mpn = '" . $this->db->escape($data['mpn']) . "', used = '" . (int) $data['used'] . "', ean = '" . $this->db->escape($data['ean']) . "', oe = '" . $this->db->escape($data['oe']) . "', others = '" . $this->db->escape($data['others']) . "', quantity = '" . (int) $data['quantity'] . "', location = '" . $this->db->escape($data['location']) . "', weight = '" . (float) $data['weight'] . "', delivery = '" . (int) $data['delivery'] . "', price = '" . (float) $data['price'] . "', status = '1', catalog = '" . $this->db->escape($catalog) . "', date_added = '" . $this->db->escape($data['date_added']) . "', date_modified = NOW()");
		
		$product_id = $this->db->getLastId();
		
		$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_user SET product_id = '" . (int) $product_id . "', user_id = '" . (int) $user_id . "', sku = '" . $this->db->escape($sku) . "'");
		
		if ($catalog !== 'market') {
			return $sku;
		}
		
		foreach ($data['product_description'] as $language_id => $description) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "product_description SET product_id = '" . (int) $product_id . "', language_id = '" . (int) $language_id . "', name = '" . $this->db->escape($description['name']) . "', name_product = '" . $this->db->escape($description['name_product']) . "', description = '" . $this->db->escape($description['description']) . "', note = '" . $this->db->escape($description['note']) . "'");
		}
		
		if (!empty($data['product_category'])) {
			$this->db->query("INSERT IGNORE INTO " . DB_PREFIX . "product_to_category SET product_id = '" . (int) $product_id . "', category_id = '" . (int) $data['product_category'] . "'");
		}

		if (isset($data['product_vehicle'])) {
			foreach($data['product_vehicle'] as $vehicle_id) {
				$this->db->query("INSERT IGNORE INTO " . DB_PREFIX . "product_to_vehicle SET product_id = '" . (int) $product_id . "', vehicle_id = '" . (int) $vehicle_id . "'");
			}
		}
		
		if (isset($data['product_vehicle_engine'])) {
			foreach($data['product_vehicle_engine'] as $vehicle_id => $vehicle_engine_id) {
				$this->db->query("INSERT IGNORE INTO " . DB_PREFIX . "product_vehicle_to_engine SET product_id = '" . (int) $product_id . "', vehicle_id = '" . (int) $vehicle_id . "', vehicle_engine_id = '" . (int) $vehicle_engine_id . "'");
			}
		}
		
		if (isset($data['product_vehicle4parts'])) {
			$this->load->model('catalog/vehicle4parts');
			
			foreach($data['product_vehicle4parts'] as $vehicle4parts_sku) {
				$vehicle4parts = $this->model_catalog_vehicle4parts->getVehicle4PartsIdBySku($user_id, $vehicle4parts_sku);
				
				if ($vehicle4parts) {
					$this->db->query("INSERT IGNORE INTO " . DB_PREFIX . "product_to_vehicle4parts SET product_id = '" . (int) $product_id . "', vehicle4parts_id = '" . (int) $vehicle4parts . "'");
				}
			}
		}
		
		if (isset($data['product_image']) and count($data['product_image'])) {
			$first_key = array_key_first($data['product_image']);
			$this->db->query("UPDATE " . DB_PREFIX . "product SET image = '" . $this->db->escape($data['product_image'][$first_key]) . "' WHERE product_id = '" . (int) $product_id . "'");
			unset($data['product_image'][$first_key]);
			
			foreach($data['product_image'] as $image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_image SET product_id = '" . (int) $product_id . "', image = '" . $this->db->escape($image) . "'");
			}
		}
		
		$this->load->model('integration/onlineshop/onlineshop');
		$onlineshops = $this->model_integration_onlineshop_onlineshop->getOnlineshops();
		
		foreach($onlineshops as $onlineshop) {
			if (isset($data[$onlineshop['code']])) {
				$this->db->query("INSERT IGNORE INTO " . DB_PREFIX . "product_to_onlineshop SET product_id = '" . (int) $product_id . "', onlineshop_code = '" . $this->db->escape($onlineshop['code']) . "', status = '1'");
			}
		}
		
		if (isset($data['warehouse_id'])) {
			$this->db->query("INSERT IGNORE INTO " . DB_PREFIX . "product_to_warehouse SET product_id = '" . (int) $product_id . "', warehouse_id = '" . (int) $data['warehouse_id'] . "'");
		}
		
		$this->cache->delete('user.' . (int) $user_id . '.involved_category');
		
		return $sku;
	}

	public function editProduct($user_id, $sku, $data, $catalog = 'market') {
		$product_id = $this->getProductIdBySku($user_id, $sku);
		
		if (!$product_id) {
			return false;
		}
		
		if (!isset($data['delivery'])) {
			$data['delivery'] = 0;
		}
		
		if (!isset($data['ean'])) {
			$data['ean'] = '';
		}
		
		if (!isset($data['oe'])) {
			$data['oe'] = '';
		}
		
		if (!isset($data['others'])) {
			$data['others'] = '';
		}
		
		if (!isset($data['location'])) {
			$data['location'] = '';
		}
		
		if (!isset($data['weight'])) {
			$data['weight'] = 0;
		}

		$this->db->query("UPDATE " . DB_PREFIX . "product SET brand = '" . $this->db->escape($data['brand']) . "', vehicle_position_id = '" . (int) $data['vehicle_position_id'] . "', mpn = '" . $this->db->escape($data['mpn']) . "', used = '" . (int) $data['used'] . "', ean = '" . $this->db->escape($data['ean']) . "', oe = '" . $this->db->escape($data['oe']) . "', others = '" . $this->db->escape($data['others']) . "', quantity = '" . (int) $data['quantity'] . "', location = '" . $this->db->escape($data['location']) . "', weight = '" . (float) $data['weight'] . "', delivery = '" . (int) $data['delivery'] . "', price = '" . (float) $data['price'] . "', date_modified = NOW() WHERE product_id = '" . (int) $product_id . "'");

		if ($catalog !== 'market') {
			return $sku;
		}
		
		foreach ($data['product_description'] as $language_id => $description) {
			$this->db->query("UPDATE " . DB_PREFIX . "product_description SET product_id = '" . (int) $product_id . "', language_id = '" . (int) $language_id . "', name = '" . $this->db->escape($description['name']) . "', name_product = '" . $this->db->escape($description['name_product']) . "', description = '" . $this->db->escape($description['description']) . "', note = '" . $this->db->escape($description['note']) . "' WHERE product_id = '" . (int) $product_id . "' AND language_id = '" . (int) $language_id . "'");
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int) $product_id . "'");
		
		if (!empty($data['product_category'])) {
			$this->db->query("INSERT IGNORE INTO " . DB_PREFIX . "product_to_category SET product_id = '" . (int) $product_id . "', category_id = '" . (int) $data['product_category'] . "'");
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_vehicle WHERE product_id = '" . (int) $product_id . "'");

		if (isset($data['product_vehicle'])) {
			foreach ($data['product_vehicle'] as $vehicle_id) {
				$this->db->query("INSERT IGNORE INTO " . DB_PREFIX . "product_to_vehicle SET product_id = '" . (int) $product_id . "', vehicle_id = '" . (int) $vehicle_id . "'");
			}
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_vehicle_to_engine WHERE product_id = '" . (int) $product_id . "'");
		
		if (isset($data['product_vehicle_engine'])) {
			foreach($data['product_vehicle_engine'] as $vehicle_id => $vehicle_engine_id) {
				$this->db->query("INSERT IGNORE INTO " . DB_PREFIX . "product_vehicle_to_engine SET product_id = '" . (int) $product_id . "', vehicle_id = '" . (int) $vehicle_id . "', vehicle_engine_id = '" . (int) $vehicle_engine_id . "'");
			}
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_vehicle4parts WHERE product_id = '" . (int) $product_id . "'");
		
		if (isset($data['product_vehicle4parts'])) {
			$this->load->model('catalog/vehicle4parts');
			
			foreach ($data['product_vehicle4parts'] as $vehicle4parts_sku) {
				$vehicle4parts = $this->model_catalog_vehicle4parts->getVehicle4Parts($this->user->getId(), $vehicle4parts_sku);
				
				if (isset($vehicle4parts['vehicle4parts_id'])) {
					$this->db->query("INSERT IGNORE INTO " . DB_PREFIX . "product_to_vehicle4parts SET product_id = '" . (int) $product_id . "', vehicle4parts_id = '" . (int) $vehicle4parts['vehicle4parts_id'] . "'");
				}
			}
		}
		
		if (isset($data['product_image']) and count($data['product_image'])) {
			$first_key = array_key_first($data['product_image']);
			
			$this->db->query("UPDATE " . DB_PREFIX . "product SET image = '" . $this->db->escape($data['product_image'][$first_key]) . "' WHERE product_id = '" . (int) $product_id . "'");
			
			unset($data['product_image'][$first_key]);
			
			$this->db->query("DELETE FROM " . DB_PREFIX . "product_image WHERE product_id = '" . (int) $product_id . "'");
			
			foreach($data['product_image'] as $image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_image SET product_id = '" . (int) $product_id . "', image = '" . $this->db->escape($image) . "'");
			}
		} else {
			$query = $this->db->query("SELECT image FROM " . DB_PREFIX . "product WHERE product_id = '" . (int) $product_id . "'");
		
			if ($query->row['image']) {
				unlink(DIR_IMAGE . $query->row['image']);
			}
			
			$this->db->query("UPDATE " . DB_PREFIX . "product SET image = '' WHERE product_id = '" . (int) $product_id . "'");
		
			$query = $this->db->query("SELECT image FROM " . DB_PREFIX . "product_image WHERE product_id = '" . (int) $product_id . "'");
		
			foreach($query->rows as $image) {
				unlink(DIR_IMAGE . $image['image']);
			}
			
			$this->db->query("DELETE FROM " . DB_PREFIX . "product_image WHERE product_id = '" . (int) $product_id . "'");
		}
		
		$this->load->model('integration/onlineshop/onlineshop');
		
		$onlineshops = $this->model_integration_onlineshop_onlineshop->getOnlineshops();
		
		foreach($onlineshops as $onlineshop) {
			if (isset($data[$onlineshop['code']])) {
				$query = $this->db->query("SELECT onlineshop_code FROM " . DB_PREFIX . "product_to_onlineshop WHERE product_id = '" . (int) $product_id . "' AND onlineshop_code = '" . $this->db->escape($onlineshop['code']) . "' LIMIT 1");
		
				if (!isset($query->row['onlineshop_code'])) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_onlineshop SET product_id = '" . (int) $product_id . "', onlineshop_code = '" . $this->db->escape($onlineshop['code']) . "', status = '1'");
				} else {
					$this->db->query("UPDATE " . DB_PREFIX . "product_to_onlineshop SET status = '1' WHERE product_id = '" . (int) $product_id . "' AND onlineshop_code = '" . $this->db->escape($onlineshop['code']) . "'");
				}
			} else {
				$this->db->query("UPDATE " . DB_PREFIX . "product_to_onlineshop SET status = '0' WHERE product_id = '" . (int) $product_id . "' AND onlineshop_code = '" . $this->db->escape($onlineshop['code']) . "'");
			}
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_warehouse WHERE product_id = '" . (int) $product_id . "'");
		
		if (isset($data['warehouse_id'])) {
			$this->db->query("INSERT IGNORE INTO " . DB_PREFIX . "product_to_warehouse SET product_id = '" . (int) $product_id . "', warehouse_id = '" . (int) $data['warehouse_id'] . "'");
		}
		
		$this->cache->delete('user.' . (int) $user_id . '.involved_category');
		
		return $sku;
	}
	
	public function editProductLocation($product_id, $location) {
		$this->db->query("UPDATE " . DB_PREFIX . "product SET location = '" . $this->db->escape($location) . "' WHERE product_id = '" . (int) $product_id . "'");
	}
	
	public function editProductStatus($product_id, $status) {
		$this->db->query("UPDATE " . DB_PREFIX . "product SET status = '" . (int) $status . "' WHERE product_id = '" . (int) $product_id . "'");
	}
	
	public function editProductStock($product_id, $quantity) {
		$this->db->query("UPDATE " . DB_PREFIX . "product SET quantity = '" . (int) $quantity . "', date_modified = NOW() WHERE product_id = '" . (int) $product_id . "'");
		
		return date('Y-m-d H:i:s');
	}

	public function deleteProduct($user_id, $sku) {
		$product_id = $this->getProductIdBySku($user_id, $sku);
		
		if (!$product_id) {
			return false;
		}
		
		$query = $this->db->query("SELECT image FROM " . DB_PREFIX . "product WHERE product_id = '" . (int) $product_id . "'");
		
		if ($query->row['image']) {
			if (file_exists(DIR_IMAGE . $query->row['image'])) {
				unlink(DIR_IMAGE . $query->row['image']);
			}
		}
		
		$query = $this->db->query("SELECT image FROM " . DB_PREFIX . "product_image WHERE product_id = '" . (int) $product_id . "'");
		
		foreach($query->rows as $image) {
			if (file_exists(DIR_IMAGE . $image['image'])) {
				unlink(DIR_IMAGE . $image['image']);
			}
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "product WHERE product_id = '" . (int) $product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_description WHERE product_id = '" . (int) $product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_image WHERE product_id = '" . (int) $product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int) $product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_vehicle WHERE product_id = '" . (int) $product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_vehicle_to_engine WHERE product_id = '" . (int) $product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_vehicle4parts WHERE product_id = '" . (int) $product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_warehouse WHERE product_id = '" . (int) $product_id . "'");
		//$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_onlineshop WHERE product_id = '" . (int) $product_id . "'");
		//$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_user WHERE product_id = '" . (int) $product_id . "'");
		
		$this->cache->delete('user.' . (int) $user_id . '.involved_category');
	}
	
	public function getProductCategories($user_id, $sku) {
		$query = $this->db->query("SELECT ptсat.category_id FROM " . DB_PREFIX . "product_to_category ptсat LEFT JOIN " . DB_PREFIX . "product_to_user ptu ON (ptсat.product_id = ptu.product_id) WHERE ptu.sku = '" . $this->db->escape($sku) . "' AND ptu.user_id = '" . (int) $user_id . "'");
		
		return $query->rows;
	}
	
	public function getProductVehicles($user_id, $sku) {
		$query = $this->db->query("SELECT v.vehicle_id, v.title FROM " . DB_PREFIX . "vehicle v LEFT JOIN " . DB_PREFIX . "product_to_vehicle ptv ON v.vehicle_id = ptv.vehicle_id LEFT JOIN " . DB_PREFIX . "product_to_user ptu ON (ptv.product_id = ptu.product_id) WHERE ptu.sku = '" . $this->db->escape($sku) . "' AND ptu.user_id = '" . (int) $user_id . "'");
		
		if ($query->rows) {
			foreach ($query->rows as $key => $row) {
				$query->rows[$key]['engine'] = $this->getProductVehicleEngine($user_id, $sku, $row['vehicle_id']);
			}
		}
		
		return $query->rows;
	}
	
	public function getProductVehicleEngine($user_id, $sku, $vehicle_id) {
		$query = $this->db->query("SELECT pvte.vehicle_engine_id FROM " . DB_PREFIX . "product_vehicle_to_engine pvte LEFT JOIN " . DB_PREFIX . "product_to_user ptu ON (pvte.product_id = ptu.product_id) WHERE ptu.sku = '" . $this->db->escape($sku) . "' AND ptu.user_id = '" . (int) $user_id . "' AND pvte.vehicle_id = '" . (int) $vehicle_id . "'");
		
		if ($query->row) {
			$this->load->model('catalog/vehicle');
			
			return $this->model_catalog_vehicle->getEngine($query->row['vehicle_engine_id']);
		} else {
			return false;
		}
	}

	public function getProductVehicles4Parts($user_id, $sku) {
		$query = $this->db->query("SELECT *, vptu.sku FROM " . DB_PREFIX . "vehicle4parts vp LEFT JOIN " . DB_PREFIX . "vehicle4parts_description vpd ON (vp.vehicle4parts_id = vpd.vehicle4parts_id)  LEFT JOIN " . DB_PREFIX . "product_to_vehicle4parts ptvp ON (vp.vehicle4parts_id = ptvp.vehicle4parts_id) LEFT JOIN " . DB_PREFIX . "product_to_user ptu ON (ptvp.product_id = ptu.product_id) LEFT JOIN " . DB_PREFIX . "vehicle4parts_to_user vptu ON (ptvp.vehicle4parts_id = vptu.vehicle4parts_id) WHERE ptu.sku = '" . $this->db->escape($sku) . "' AND ptu.user_id = '" . (int) $user_id . "' AND language_id = '" . (int) $this->config->get('config_language_id') . "'");
		
		return $query->rows;
	}
	
	public function getProductImages($user_id, $sku) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_image pi LEFT JOIN " . DB_PREFIX . "product_to_user ptu ON (pi.product_id = ptu.product_id) WHERE ptu.sku = '" . $this->db->escape($sku) . "' AND ptu.user_id = '" . (int) $user_id . "' ORDER BY sort_order ASC");

		return $query->rows;
	}
	
	public function getProductDescription($user_id, $sku) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_description pd LEFT JOIN " . DB_PREFIX . "product_to_user ptu ON (pd.product_id = ptu.product_id) WHERE ptu.sku = '" . $this->db->escape($sku) . "' AND ptu.user_id = '" . (int) $user_id . "'");

		return array_column($query->rows, null, 'language_id');
	}
	
	public function getProductOnlineshops($user_id_or_product_id, $sku = false) {
		if ($sku) {
			$product_id = $this->getProductIdBySku($user_id_or_product_id, $sku);
		} else {
			$product_id = $user_id_or_product_id;
		}
		
		if (!$product_id) {
			return array();
		}
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_onlineshop WHERE product_id = '" . (int) $product_id . "'");
		
		if ($query->rows) {
			$onlineshops_data = array_column($query->rows, null, 'onlineshop_code');
			
			foreach($onlineshops_data as $key => $data) {
				$onlineshops_data[$key]['data'] = json_decode($data['data'], true);
			}
			
			return $onlineshops_data;
		} else {
			return array();
		}
	}
	
	public function getProduct2OnlineshopData($user_id_or_product_id, $sku, $onlineshop_code) {
		if ($sku) {
			$product_id = $this->getProductIdBySku($user_id_or_product_id, $sku);
		} else {
			$product_id = $user_id_or_product_id;
		}
		
		if (!$product_id) {
			return array();
		}
		
		$query = $this->db->query("SELECT data FROM " . DB_PREFIX . "product_to_onlineshop WHERE product_id = '" . (int) $product_id . "' AND onlineshop_code = '" . $this->db->escape($onlineshop_code) . "'");
		
		if (isset($query->row['data'])) {
			return json_decode($query->row['data'], true);
		} else {
			return array();
		}
	}
	
	public function setProduct2OnlineshopData($user_id, $sku, $onlineshop_code, $data) {
		$product_id = $this->getProductIdBySku($user_id, $sku);
		
		if (!$product_id) {
			return false;
		}
		
		$data = json_encode($data);
		
		$this->db->query("UPDATE " . DB_PREFIX . "product_to_onlineshop SET data = '" . $this->db->escape($data) . "' WHERE product_id = '" . (int) $product_id . "' AND onlineshop_code = '" . $this->db->escape($onlineshop_code) . "'");
	}
	
	public function setProduct2OnlineshopStatus($user_id, $sku, $onlineshop_code, $status) {
		$product_id = $this->getProductIdBySku($user_id, $sku);
		
		if (!$product_id) {
			return false;
		}

		$this->db->query("UPDATE " . DB_PREFIX . "product_to_onlineshop SET status = '" . (int) $status . "' WHERE product_id = '" . (int) $product_id . "' AND onlineshop_code = '" . $this->db->escape($onlineshop_code) . "'");
	}
	
	public function setOnlineshopProductId($user_id, $sku, $onlineshop_code, $onlineshop_product_id) {
		$product_id = $this->getProductIdBySku($user_id, $sku);
		
		if (!$product_id) {
			return false;
		}

		$this->db->query("UPDATE " . DB_PREFIX . "product_to_onlineshop SET onlineshop_product_id = '" . $this->db->escape($onlineshop_product_id) . "' WHERE product_id = '" . (int) $product_id . "' AND onlineshop_code = '" . $this->db->escape($onlineshop_code) . "'");
	}

	public function getProductByOnlineshopProductId($user_id, $onlineshop_code, $onlineshop_product_id) {
		if (!$onlineshop_product_id) {
			return false;
		}
		
		$query = $this->db->query("SELECT pto.product_id, ptu.sku FROM " . DB_PREFIX . "product_to_onlineshop pto LEFT JOIN " . DB_PREFIX . "product_to_user ptu ON ptu.product_id = pto.product_id WHERE ptu.user_id = '" . (int) $user_id . "' AND pto.onlineshop_code = '" . $this->db->escape($onlineshop_code) . "' AND pto.onlineshop_product_id = '" . $this->db->escape($onlineshop_product_id) . "'");

		if (isset($query->row['sku'])) {
			return $this->getProduct($user_id, $query->row['sku']);
		} else {
			return false;
		}
	}
	
	public function deleteProduct2Onlineshop($user_id, $sku, $onlineshop_code) {
		$product_id = $this->getProductIdBySku($user_id, $sku);
		
		if (!$product_id) {
			return false;
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_onlineshop WHERE product_id = '" . (int) $product_id . "' AND onlineshop_code = '" . $this->db->escape($onlineshop_code) . "'");
	}
	
	public function getProductMaxPrice($user_id) {
		$query = $this->db->query("SELECT MAX(p.price) as max_price FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_to_user ptu ON (p.product_id = ptu.product_id) WHERE ptu.user_id = '" . (int) $user_id . "'");
		
		if (isset($query->row['max_price'])) {
			return $query->row['max_price'];
		} else {
			return false;
		}
	}
}
