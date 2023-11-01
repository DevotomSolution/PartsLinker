<?php
namespace Opencart\Catalog\Model\Catalog;
class Vehicle4parts extends \Opencart\System\Engine\Model {
	public function getTotalVehicles4Parts($user_id, $data = array()) {
		$sql = "SELECT COUNT(vp.vehicle4parts_id) AS total FROM " . DB_PREFIX . "vehicle4parts vp LEFT JOIN " . DB_PREFIX . "vehicle4parts_description vpd ON (vp.vehicle4parts_id = vpd.vehicle4parts_id) LEFT JOIN " . DB_PREFIX . "vehicle4parts_to_user vptu ON (vp.vehicle4parts_id = vptu.vehicle4parts_id) LEFT JOIN " . DB_PREFIX . "vehicle4parts_to_warehouse vptw ON (vp.vehicle4parts_id = vptw.vehicle4parts_id) WHERE vptu.user_id = '" . (int) $user_id . "' AND vpd.language_id = '" . (int) $this->config->get('config_language_id') . "'";
		
		if (!empty($data['search'])) {
			$sql .= " AND (vpd.title LIKE '%" . $this->db->escape($data['search']) . "%' OR vptu.sku = '" . $this->db->escape($data['search']) . "')";
		}
		
		if (!empty($data['filter_vehicle_id'])) {
			$sql .= " AND vp.vehicle_id = '" . (int) $data['filter_vehicle_id'] . "'";
		}
		
		if (!empty($data['filter_engine_id'])) {
			$sql .= " AND vp.engine_id = '" . (int) $data['filter_engine_id'] . "'";
		}
		
		if (!empty($data['filter_warehouse_id'])) {
			$sql .= " AND vptw.warehouse_id = '" . (int) $data['filter_warehouse_id'] . "'";
		}

		$query = $this->db->query($sql);
		
		return $query->row['total'];
	}
	
	public function getVehicle4Parts($user_id, $sku) {
		$query = $this->db->query("SELECT *, vp.vehicle4parts_id FROM " . DB_PREFIX . "vehicle4parts vp LEFT JOIN " . DB_PREFIX . "vehicle4parts_description vpd ON (vp.vehicle4parts_id = vpd.vehicle4parts_id) LEFT JOIN " . DB_PREFIX . "vehicle4parts_to_user vptu ON (vp.vehicle4parts_id = vptu.vehicle4parts_id) LEFT JOIN " . DB_PREFIX . "vehicle4parts_to_warehouse vptw ON (vp.vehicle4parts_id = vptw.vehicle4parts_id) WHERE vptu.sku = '" . $this->db->escape($sku) . "' AND vptu.user_id = '" . (int) $user_id . "' AND vpd.language_id = '" . (int) $this->config->get('config_language_id') . "'");

		if (isset($query->row['vehicle4parts_id'])) {
			$query->row['link'] = '';
		}

		return $query->row;
	}
	
	public function getVehicles4Parts($user_id, $data = array()) {
		$sql = "SELECT *, vp.vehicle4parts_id FROM " . DB_PREFIX . "vehicle4parts vp LEFT JOIN " . DB_PREFIX . "vehicle4parts_description vpd ON (vp.vehicle4parts_id = vpd.vehicle4parts_id) LEFT JOIN " . DB_PREFIX . "vehicle4parts_to_user vptu ON (vp.vehicle4parts_id = vptu.vehicle4parts_id) LEFT JOIN " . DB_PREFIX . "vehicle4parts_to_warehouse vptw ON (vp.vehicle4parts_id = vptw.vehicle4parts_id) WHERE vptu.user_id = '" . (int) $user_id . "' AND vpd.language_id = '" . (int) $this->config->get('config_language_id') . "'";
		
		if (!empty($data['search'])) {
			$sql .= " AND (vpd.title LIKE '%" . $this->db->escape($data['search']) . "%' OR vptu.sku = '" . $this->db->escape($data['search']) . "')";
		}
		
		if (!empty($data['filter_vehicle_id'])) {
			$sql .= " AND vp.vehicle_id = '" . (int) $data['filter_vehicle_id'] . "'";
		}
		
		if (!empty($data['filter_engine_id'])) {
			$sql .= " AND vp.engine_id = '" . (int) $data['filter_engine_id'] . "'";
		}
		
		if (!empty($data['filter_warehouse_id'])) {
			$sql .= " AND vptw.warehouse_id = '" . (int) $data['filter_warehouse_id'] . "'";
		}
		
		$sql .= " ORDER BY vp.vehicle4parts_id DESC";

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
		
		foreach($query->rows as $key => $vehicle4parts) {
			$query->rows[$key]['link'] = '';
		}

		return $query->rows;
	}
	
	public function getNewSku($user_id) {
		$query = $this->db->query("SELECT sku FROM " . DB_PREFIX . "vehicle4parts_to_user WHERE user_id = '" . (int) $user_id . "' ORDER BY date_added DESC LIMIT 1");
		
		if(isset($query->row['sku'])) {
			$sku = $query->row['sku'];
		} else {
			$sku = '';
		}
		
		for($i = mb_strlen($sku) - 1; $i >= 0; $i -= 1) {
			if(is_numeric($sku[$i]) && (int) $sku[$i] < 9) {
				$sku[$i] = (int) $sku[$i] + 1;
				break;
			} elseif(is_numeric($sku[$i]) && (int) $sku[$i] == 9) {
				$sku[$i] = 0;
			}
		}
		
		if($sku === '') {
			$sku = VEHICLE4PARTS_SKU_PREFIX . '0001';	
		}

		if(!$this->getVehicle4PartsIdBySku($user_id, $sku)) {
			return (string) $sku;
		} else {
			return '';
		}
	}
	
	public function getVehicle4PartsIdBySku($user_id, $sku) {
		$query = $this->db->query("SELECT vehicle4parts_id FROM " . DB_PREFIX . "vehicle4parts_to_user WHERE user_id = '" . (int) $user_id . "' AND sku = '" . $this->db->escape($sku) . "'");
		
		if(isset($query->row['vehicle4parts_id'])) {
			return $query->row['vehicle4parts_id'];
		} else {
			return false;
		}
	}
	
	public function addVehicle4Parts($user_id, $data) {
		$sku = $data['sku'];

		$this->db->query("INSERT INTO " . DB_PREFIX . "vehicle4parts SET vehicle_id = '" . (int) $data['vehicle_id'] . "', win = '" . $this->db->escape($data['win']) . "', color_id = '" . $this->db->escape($data['color_id']) . "', color_code = '" . $this->db->escape($data['color_code']) . "', engine_id = '" . (int) $data['engine_id'] . "', engine_code = '" . $this->db->escape($data['engine_code']) . "', year = '" . (int) $data['year'] . "', transmission_id = '" . (int) $data['transmission_id'] . "', gb_code = '" . $this->db->escape($data['gb_code']) . "', gb_speed_level = '" . (int) $data['gb_speed_level'] . "', drive_id = '" . $this->db->escape($data['drive_id']) . "', km = '" . (float) $data['km'] . "', price = '" . (float) $data['price'] . "'");
		
		$vehicle4parts_id = $this->db->getLastId();
		
		foreach ($data['vehicle4parts_description'] as $language_id => $description) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "vehicle4parts_description SET vehicle4parts_id = '" . (int) $vehicle4parts_id . "', language_id = '" . (int) $language_id . "', title = '" . $this->db->escape($description['title']) . "', note = '" . $this->db->escape($description['note']) . "', specifications = '" . $this->db->escape($description['specifications']) . "'");
		}
		
		$this->db->query("INSERT INTO " . DB_PREFIX . "vehicle4parts_to_user SET vehicle4parts_id = '" . (int) $vehicle4parts_id ."', user_id = '" . (int) $user_id . "', sku = '" . $this->db->escape($sku) . "'");
		
		$this->db->query("INSERT INTO " . DB_PREFIX . "vehicle4parts_to_warehouse SET vehicle4parts_id = '" . (int) $vehicle4parts_id ."', warehouse_id = '" . (int) $this->db->escape($data['warehouse_id']) . "'");
		
		if (isset($data['vehicle4parts_image']) and count($data['vehicle4parts_image'])) {
			$first_key = array_key_first($data['vehicle4parts_image']);
			
			$this->db->query("UPDATE " . DB_PREFIX . "vehicle4parts SET image = '" . $this->db->escape($data['vehicle4parts_image'][0]) . "' WHERE vehicle4parts_id = '" . (int) $vehicle4parts_id . "'");
			
			unset($data['vehicle4parts_image'][$first_key]);
			
			foreach($data['vehicle4parts_image'] as $image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "vehicle4parts_image SET vehicle4parts_id = '" . (int) $vehicle4parts_id . "', image = '" . $this->db->escape($image) . "'");
			}
		}
		
		if (isset($data['vehicle4parts_video'])) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "vehicle4parts_video SET vehicle4parts_id = '" . (int) $vehicle4parts_id . "', video = '" . $this->db->escape($data['vehicle4parts_video']['video']) . "', mime = '" . $this->db->escape($data['vehicle4parts_video']['mime']) . "'");
		}

		return $sku;
	}

	public function editVehicle4Parts($user_id, $sku, $data) {
		$vehicle4parts_id = $this->getVehicle4PartsIdBySku($user_id, $sku);
		
		if (!$vehicle4parts_id) {
			return false;
		}
		
		$this->db->query("UPDATE " . DB_PREFIX . "vehicle4parts SET vehicle_id = '" . (int) $data['vehicle_id'] . "', win = '" . $this->db->escape($data['win']) . "', color_id = '" . $this->db->escape($data['color_id']) . "', color_code = '" . $this->db->escape($data['color_code']) . "', engine_id = '" . (int) $data['engine_id'] . "', engine_code = '" . $this->db->escape($data['engine_code']) . "', year = '" . (int) $data['year'] . "', transmission_id = '" . (int) $data['transmission_id'] . "', gb_code = '" . $this->db->escape($data['gb_code']) . "', gb_speed_level = '" . (int) $data['gb_speed_level'] . "', drive_id = '" . $this->db->escape($data['drive_id']) . "', km = '" . (float) $data['km'] . "', price = '" . (float) $data['price'] . "' WHERE vehicle4parts_id = '" . (int) $vehicle4parts_id . "'");
		
		foreach ($data['vehicle4parts_description'] as $language_id => $description) {
			$this->db->query("UPDATE " . DB_PREFIX . "vehicle4parts_description SET title = '" . $this->db->escape($description['title']) . "', note = '" . $this->db->escape($description['note']) . "', specifications = '" . $this->db->escape($description['specifications']) . "' WHERE vehicle4parts_id = '" . (int) $vehicle4parts_id . "' AND language_id = '" . (int) $language_id . "'");
		}
		
		if (isset($data['vehicle4parts_image']) and count($data['vehicle4parts_image'])) {
			$first_key = array_key_first($data['vehicle4parts_image']);
			
			$this->db->query("UPDATE " . DB_PREFIX . "vehicle4parts SET image = '" . $this->db->escape($data['vehicle4parts_image'][$first_key]) . "' WHERE vehicle4parts_id = '" . (int) $vehicle4parts_id . "'");
			
			unset($data['vehicle4parts_image'][$first_key]);
			
			$this->db->query("DELETE FROM " . DB_PREFIX . "vehicle4parts_image WHERE vehicle4parts_id = '" . (int) $vehicle4parts_id . "'");
			
			foreach($data['vehicle4parts_image'] as $image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "vehicle4parts_image SET vehicle4parts_id = '" . (int) $vehicle4parts_id . "', image = '" . $this->db->escape($image) . "'");
			}
		} else {
			$query = $this->db->query("SELECT image FROM " . DB_PREFIX . "vehicle4parts WHERE vehicle4parts_id = '" . (int) $vehicle4parts_id . "'");
		
			if($query->row['image']) {
				unlink(DIR_IMAGE . $query->row['image']);
			}
			
			$this->db->query("UPDATE " . DB_PREFIX . "vehicle4parts SET image = '' WHERE vehicle4parts_id = '" . (int) $vehicle4parts_id . "'");
			
			$query = $this->db->query("SELECT image FROM " . DB_PREFIX . "vehicle4parts_image WHERE vehicle4parts_id = '" . (int) $vehicle4parts_id . "'");

			foreach($query->rows as $image) {
				unlink(DIR_IMAGE . $image['image']);
			}
			
			$this->db->query("DELETE FROM " . DB_PREFIX . "vehicle4parts_image WHERE vehicle4parts_id = '" . (int) $vehicle4parts_id . "'");
		}
		
		if (!isset($data['vehicle4parts_video'])) {
			$query = $this->db->query("SELECT video FROM " . DB_PREFIX . "vehicle4parts_video WHERE vehicle4parts_id = '" . (int) $vehicle4parts_id . "'");
		
			if(isset($query->row['video'])) {
				unlink(DIR_IMAGE . $query->row['video']);
			}
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "vehicle4parts_video WHERE vehicle4parts_id = '" . (int) $vehicle4parts_id . "'");
		
		if (isset($data['vehicle4parts_video'])) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "vehicle4parts_video SET vehicle4parts_id = '" . (int) $vehicle4parts_id . "', video = '" . $this->db->escape($data['vehicle4parts_video']['video']) . "', mime = '" . $this->db->escape($data['vehicle4parts_video']['mime']) . "'");
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "vehicle4parts_to_warehouse WHERE vehicle4parts_id = '" . (int) $vehicle4parts_id . "'");
		
		if (isset($data['warehouse_id'])) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "vehicle4parts_to_warehouse SET vehicle4parts_id = '" . (int) $vehicle4parts_id ."', warehouse_id = '" . (int) $this->db->escape($data['warehouse_id']) . "'");
		}
		
		return $sku;
	}

	public function deleteVehicle4Parts($user_id, $sku) {
		$vehicle4parts_id = $this->getVehicle4PartsIdBySku($user_id, $sku);
	
		if (!$vehicle4parts_id) {
			return false;
		}
		
		$query = $this->db->query("SELECT image FROM " . DB_PREFIX . "vehicle4parts WHERE vehicle4parts_id = '" . (int) $vehicle4parts_id . "'");
		
		if ($query->row['image']) {
			unlink(DIR_IMAGE . $query->row['image']);
		}
		
		$query = $this->db->query("SELECT image FROM " . DB_PREFIX . "vehicle4parts_image WHERE vehicle4parts_id = '" . (int) $vehicle4parts_id . "'");

		foreach ($query->rows as $image) {
			unlink(DIR_IMAGE . $image['image']);
		}

		$query = $this->db->query("SELECT video FROM " . DB_PREFIX . "vehicle4parts_video WHERE vehicle4parts_id = '" . (int) $vehicle4parts_id . "'");

		if (!empty($query->row['video'])) {
			unlink(DIR_IMAGE . $query->row['video']);
		}
		
		$query = $this->db->query("SELECT file FROM " . DB_PREFIX . "vehicle4parts_file WHERE vehicle4parts_id = '" . (int) $vehicle4parts_id . "'");

		foreach ($query->rows as $file) {
			unlink(DIR_UPLOAD . $file['file']);
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "vehicle4parts WHERE vehicle4parts_id = '" . (int) $vehicle4parts_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "vehicle4parts_image WHERE vehicle4parts_id = '" . (int) $vehicle4parts_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_vehicle4parts WHERE vehicle4parts_id = '" . (int) $vehicle4parts_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "vehicle4parts_to_warehouse WHERE vehicle4parts_id = '" . (int) $vehicle4parts_id . "'");
		//$this->db->query("DELETE FROM " . DB_PREFIX . "vehicle4parts_to_user WHERE vehicle4parts_id = '" . (int) $vehicle4parts_id . "'");
	}
	
	public function getVehicle4PartsImages($user_id, $sku) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "vehicle4parts_image vpi LEFT JOIN " . DB_PREFIX . "vehicle4parts_to_user vptu ON (vptu.vehicle4parts_id = vpi.vehicle4parts_id) WHERE vptu.user_id = '" . (int) $user_id . "' AND vptu.sku = '" . $this->db->escape($sku) . "' ORDER BY sort_order ASC");

		return $query->rows;
	}
	
	public function getVehicle4PartsVideo($user_id, $sku) {
		$query = $this->db->query("SELECT video, mime FROM " . DB_PREFIX . "vehicle4parts_video vpv LEFT JOIN " . DB_PREFIX . "vehicle4parts_to_user vptu ON (vptu.vehicle4parts_id = vpv.vehicle4parts_id) WHERE vptu.user_id = '" . (int) $user_id . "' AND vptu.sku = '" . $this->db->escape($sku) . "'");

		return $query->row;
	}
	
	public function getVehicle4PartsFiles($user_id, $sku) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "vehicle4parts_file vpd LEFT JOIN " . DB_PREFIX . "vehicle4parts_to_user vptu ON (vptu.vehicle4parts_id = vpd.vehicle4parts_id) WHERE vptu.user_id = '" . (int) $user_id . "' AND vptu.sku = '" . $this->db->escape($sku) . "' ORDER BY sort_order ASC");

		return $query->rows;
	}
	
	public function getVehicle4PartsFile($user_id, $sku, $file_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "vehicle4parts_file vpd LEFT JOIN " . DB_PREFIX . "vehicle4parts_to_user vptu ON (vptu.vehicle4parts_id = vpd.vehicle4parts_id) WHERE vptu.user_id = '" . (int) $user_id . "' AND vptu.sku = '" . $this->db->escape($sku) . "' AND vehicle4parts_file_id = '" . (int) $file_id . "'");

		return $query->row;
	}
	
	public function addVehicle4PartsFile($user_id, $sku, $file) {
		$vehicle4parts_id = $this->getVehicle4PartsIdBySku($user_id, $sku);
		
		if (!$vehicle4parts_id) {
			return false;
		}
		
		$this->db->query("INSERT INTO " . DB_PREFIX . "vehicle4parts_file SET vehicle4parts_id = '" . (int) $vehicle4parts_id . "', file = '" . $this->db->escape($file['file']) . "', title = '" . $this->db->escape($file['title']) . "'");
		
		return $this->db->getLastId();
	}
	
	public function deleteVehicle4PartsFile($user_id, $sku, $file_id) {
		$file = $this->getVehicle4PartsFile($user_id, $sku, $file_id);
		
		if (!$file) {
			return false;
		}
		
		unlink(DIR_UPLOAD . $file['file']);
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "vehicle4parts_file WHERE vehicle4parts_file_id = '" . (int) $file_id . "'");
	}
	
	public function getVehicle4PartsDescription($user_id, $sku) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "vehicle4parts_description vpd LEFT JOIN " . DB_PREFIX . "vehicle4parts_to_user vptu ON (vpd.vehicle4parts_id = vptu.vehicle4parts_id) WHERE vptu.sku = '" . $this->db->escape($sku) . "' AND vptu.user_id = '" . (int) $user_id . "'");
		
		return array_column($query->rows, null, 'language_id');
	}
	
	public function getProductList($user_id, $sku) {
		$this->load->model('catalog/product');
		
		$products = $this->model_catalog_product->getProducts($user_id, array('filter_vehicle4parts' => $sku));
		
		$product_list = array();
	
		foreach($products as $product) {
			$product_list[] = array(
				'name'	=> $product['name'],
				'price'	=> $product['price'],
				'sku'	=> $product['sku'],
			);
		}
		
		return $product_list;
	}
	
	public function getEngine($engine_id) {
		$sql = "SELECT CONCAT(ve.typ_name, ' (', ve.engine_code, ') ', ve.KW, 'KW|', ve.HP, 'HP') as name, ve.vehicle_engine_id as id FROM " . DB_PREFIX . "vehicle_engine ve WHERE vehicle_engine_id = '" . (int) $engine_id . "'";
		
		$query = $this->db->query($sql);
		
		if(isset($query->row['name'])) {
			return str_replace('() ', '', $query->row['name']);
		} else {
			return '';
		}
	}
	
	public function getColor($color_id, $language_id = false) {
		if ($language_id === false) {
			$language_id = $this->config->get('config_language_id');
		}
		
		$query = $this->db->query("SELECT text FROM " . DB_PREFIX . "vehicle_color WHERE vehicle_color_id = '" . (int) $color_id . "' AND language_id = '" . (int) $language_id . "'");

		if(isset($query->row['text'])) {
			return $query->row['text'];
		} else {
			return '';
		}
	}
	
	public function getDrive($drive_id, $language_id = false) {
		if ($language_id === false) {
			$language_id = $this->config->get('config_language_id');
		}
		
		$query = $this->db->query("SELECT text FROM " . DB_PREFIX . "vehicle_drive WHERE vehicle_drive_id = '" . (int) $drive_id . "' AND language_id = '" . (int) $language_id . "'");

		if(isset($query->row['text'])) {
			return $query->row['text'];
		} else {
			return '';
		}
	}
	
	public function getTransmission($transmission_id, $language_id = false) {
		if ($language_id === false) {
			$language_id = $this->config->get('config_language_id');
		}
		
		$query = $this->db->query("SELECT text FROM " . DB_PREFIX . "vehicle_transmission WHERE vehicle_transmission_id = '" . (int) $transmission_id . "' AND language_id = '" . (int) $language_id . "'");

		if(isset($query->row['text'])) {
			return $query->row['text'];
		} else {
			return '';
		}
	}
	
	public function getUserYears($user_id) {
		$query = $this->db->query("SELECT DISTINCT year FROM " . DB_PREFIX . "vehicle4parts vp LEFT JOIN " . DB_PREFIX . "vehicle4parts_to_user vptu ON (vp.vehicle4parts_id = vptu.vehicle4parts_id) WHERE vptu.user_id = '" . (int) $user_id . "'");
		
		return $query->rows;
	}
}