<?php
namespace Opencart\Catalog\Model\Catalog;
class Vehicle extends \Opencart\System\Engine\Model {
	public function getVehicle($vehicle_id) {
		$sql = "SELECT * FROM " . DB_PREFIX . "vehicle WHERE vehicle_id = '" . (int) $vehicle_id . "'";
		
		$query = $this->db->query($sql);

		return $query->row;
	}
	
	public function getVehicleByModel($model_id) {
		$sql = "SELECT * FROM " . DB_PREFIX . "vehicle WHERE vehicle_model_id = '" . (int) $model_id . "'";

		$query = $this->db->query($sql);

		return $query->row;
	}
	
	public function getVehicles($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "vehicle v WHERE 1=1";

		/*if (!empty($data['filter_name'])) {
			$sql .= " AND v.title LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}*/
		
		if (!empty($data['filter_name'])) {
			$sql .= " AND (";
			
			$words = explode(' ', trim($data['filter_name']));
			
			if (count($words) > 4) {
				$sql .= "v.title LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
			} else {
				foreach($words as $key => $word) {
					if ($key) {
						$sql .= " AND ";
					}
					
					$sql .= "(v.title LIKE '%" . $this->db->escape($word) . "%')";
				}
			}

			$sql .= ")";
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
	}
	
	public function getVehiclesByText($text) {
		return false;
		
		$text = oc_strtolower($text);
		$text = preg_replace("/[^a-z\\ 0-9]/", '', $text);
		$text = preg_replace("/[\\ ]+/", ' ', $text);
		
		$sql = "SELECT * FROM " . DB_PREFIX . "vehicle v WHERE v.meta_keyword LIKE '%" . $this->db->escape($text) . "%'";
		
		$query = $this->db->query($sql);
		
		return $query->rows;
	}
	
	/*
	public function getCategoryByText($user_id, $text, $language_id = false) {
		if (!$language_id) {
			$language_id = $this->config->get('config_language_id');
		}
		
		$text = oc_strtolower($text);
		$text = preg_replace("/[^a-z\\ 0-9]/", '', $text);
		$text = preg_replace("/\b[a-z]{1,2}\b/", '', $text);
		$text = preg_replace("/[\\ ]+/", ' ', $text);
		
		$sql = "SELECT cd1.category_id, cd1.name FROM " . DB_PREFIX . "category_description cd1 LEFT JOIN " . DB_PREFIX . "user_to_disabled_category utdc ON cd1.category_id = utdc.category_id AND utdc.user_id = '" . (int) $user_id . "' WHERE MATCH (cd1.meta_keyword) AGAINST ('" . $this->db->escape($text) . "') AND cd1.language_id = '" . (int) $language_id . "' AND utdc.category_id IS NULL";
		
		$query = $this->db->query($sql);
		
		$results = array();
		
		foreach ($query->rows as $row) {
			if (oc_strpos($text, oc_strtolower($row['name'])) !== false) {
				$results[] = $row['category_id'];
			}
		}
		
		if (count($results) == 0) {
			return false;
		} elseif (count($results) == 1) {
			return $results[0];
		} else {
			return $results[count($results) - 1];
		}
	}
	*/
	
	public function getBrandByVehicleId($vehicle_id) {
		$sql = "SELECT vb.vehicle_brand_id as id, vb.name FROM " . DB_PREFIX . "vehicle_brand vb LEFT JOIN " . DB_PREFIX . "vehicle v ON vb.vehicle_brand_id = v.vehicle_brand_id WHERE v.vehicle_id = '" . (int) $vehicle_id . "'";

		$query = $this->db->query($sql);

		return $query->row;
	}
	
	public function getBrands($user_id = false, $data = array()) {
		$sql = "SELECT vb.vehicle_brand_id as id, vb.name FROM " . DB_PREFIX . "vehicle_brand vb";

		if ($user_id) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "user_to_disabled_vehicle_brand utdvb ON vb.vehicle_brand_id = utdvb.vehicle_brand_id AND utdvb.user_id = '" . (int) $user_id . "' WHERE utdvb.vehicle_brand_id IS NULL AND vb.status = '1'";
		} else {
			$sql .= " WHERE vb.status = '1'";
		}
		
		$sql .= " ORDER BY vb.name ASC";
		
		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int) $data['start'] . "," . (int) $data['limit'];
		}
		
		if (!$data and !$user_id) {
			$brands_data = $this->cache->get('vehicle_brand.all');
		
			if (!$brands_data) {
				$query = $this->db->query($sql);
				
				$brands_data = $query->rows;

				$this->cache->set('vehicle_brand.all', $brands_data);
			}

			return $brands_data;
		}
		
		if (isset($data['start']) and isset($data['limit']) and count($data) == 2 and !$user_id) {
			$brands_data = $this->cache->get('vehicle_brand.' . (int) $data['start'] . '-' . (int) $data['limit']);
			
			if (!$brands_data) {
				$query = $this->db->query($sql);
				
				$brands_data = $query->rows;

				$this->cache->set('vehicle_brand.' . (int) $data['start'] . '-' . (int) $data['limit'], $brands_data);
			}
			
			return $brands_data;
		}
		
		if (!$data and $user_id) {
			$brands_data = $this->cache->get('user.' . (int) $user_id . '.vehicle_brand');
			
			if (!$brands_data) {
				$query = $this->db->query($sql);
				
				$brands_data = $query->rows;

				$this->cache->set('user.' . (int) $user_id . '.vehicle_brand', $brands_data);
			}
			
			return $brands_data;
		}
		
		$query = $this->db->query($sql);
		
		return $query->rows;
	}
	
	public function getTotalBrands($user_id = false, $data = array()) {
		$sql = "SELECT COUNT(vb.vehicle_brand_id) as total FROM " . DB_PREFIX . "vehicle_brand vb";
		
		if($user_id) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "user_to_disabled_vehicle_brand utdvb ON vb.vehicle_brand_id = utdvb.vehicle_brand_id AND utdvb.user_id = '" . (int) $user_id . "' WHERE utdvb.vehicle_brand_id IS NULL AND vb.status = '1'";
		} else {
			$sql .= " WHERE vb.status = '1'";
		}
		
		if(!$user_id and !$data) {
			$total_data = $this->cache->get('total.vehicle_brand');
			
			if (!$total_data) {
				$query = $this->db->query($sql);

				$total_data = $query->row;

				$this->cache->set('total.vehicle_brand', $total_data);
			}
			
			return $total_data['total'];
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}
	
	public function enableVehicleBrandForUser($user_id, $vehicle_brand_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "user_to_disabled_vehicle_brand WHERE user_id = '" . (int) $user_id . "' AND vehicle_brand_id = '" . (int) $vehicle_brand_id . "'");
		
		$this->cache->delete('user.' . (int) $user_id . '.vehicle_brand');
		
	}
	
	public function disableVehicleBrandForUser($user_id, $vehicle_brand_id) {
		$this->db->query("REPLACE INTO " . DB_PREFIX . "user_to_disabled_vehicle_brand SET user_id = '" . (int) $user_id . "', vehicle_brand_id = '" . (int) $vehicle_brand_id . "'");
		
		$this->cache->delete('user.' . (int) $user_id . '.vehicle_brand');
	}
	
	public function getModelByVehicleId($vehicle_id) {
		$sql = "SELECT CONCAT(vm.name, ' [ ', vm.year_start, ' - ', vm.year_end, ' ]') as name, vm.vehicle_model_id as id, vm.name as model FROM " . DB_PREFIX . "vehicle_model vm LEFT JOIN " . DB_PREFIX . "vehicle v ON (v.vehicle_model_id = vm.vehicle_model_id) WHERE v.vehicle_id = '" . (int) $vehicle_id . "'";
		
		$query = $this->db->query($sql);
		
		return $query->row;
	}
	
	public function getModels($data = array()) {
		$sql = "SELECT CONCAT(vm.name, ' [ ', vm.year_start, ' - ', vm.year_end, ' ]') as name, vm.vehicle_model_id as id, vm.vehicle_brand_id as brand_id FROM " . DB_PREFIX . "vehicle_model vm";
		
		if(!empty($data['filter_brand_id'])) {
			$sql .= " WHERE vm.vehicle_brand_id = '" . (int) $data['filter_brand_id'] . "'";
		}
		
		$sql .= " ORDER BY vm.name ASC";

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}
		
		if(!empty($data['filter_brand_id']) and count($data) == 1) {
			$models_data = $this->cache->get('vehicle_model.' . (int) $data['filter_brand_id']. '.model');
			
			if (!$models_data) {
				$query = $this->db->query($sql);
				
				$models_data = $query->rows;
				
				$this->cache->set('vehicle_model.' . (int) $data['filter_brand_id'], $models_data);
			}
			
			return $models_data;
		}
		
		$query = $this->db->query($sql);
		
		return $query->rows;
	}
	
	public function getTotalModels($data = array()) {
		$sql = "SELECT COUNT(vm.vehicle_model_id) as total FROM " . DB_PREFIX . "vehicle_model vm";
		
		if(!empty($data['filter_brand_id'])) {
			$sql .= " WHERE vm.vehicle_brand_id = '" . (int) $data['filter_brand_id'] . "'";
		}
		
		$query = $this->db->query($sql);

		return $query->row['total'];
	}
	
	public function getUserModels($user_id, $brand_id) {
		$sql = "SELECT CONCAT(vm.name, ' [ ', vm.year_start, ' - ', vm.year_end, ' ]') as name, vm.vehicle_model_id as id FROM " . DB_PREFIX . "vehicle_model vm LEFT JOIN " . DB_PREFIX . "vehicle v ON vm.vehicle_model_id = v.vehicle_model_id LEFT JOIN " . DB_PREFIX . "product_to_vehicle ptv ON v.vehicle_id = ptv.vehicle_id LEFT JOIN " . DB_PREFIX . "product_to_user ptu ON ptv.product_id = ptu.product_id WHERE ptu.user_id = '" . (int) $user_id . "' AND vm.vehicle_brand_id = '" . (int) $brand_id . "' GROUP BY vm.vehicle_model_id ORDER BY vm.name ASC";
		
		$query = $this->db->query($sql);

		return $query->rows;
	}
	
	public function getEngine($engine_id) {
		$sql = "SELECT CONCAT(ve.typ_name, ' (', ve.engine_code, ') ', ve.KW, 'KW|', ve.HP, 'HP') as name, ve.vehicle_engine_id as id FROM " . DB_PREFIX . "vehicle_engine ve WHERE ve.vehicle_engine_id = '" . (int) $engine_id . "' ORDER BY ve.typ_name ASC";

		$query = $this->db->query($sql);
		
		if (isset($query->row['name'])) {
			$query->row['name'] = str_replace('() ', '', $query->row['name']);
		}
		
		return $query->row;
	}
	
	public function getEngines($data = array()) {
		$sql = "SELECT CONCAT(ve.typ_name, ' (', ve.engine_code, ') ', ve.KW, 'KW|', ve.HP, 'HP') as name, ve.vehicle_engine_id as id FROM " . DB_PREFIX . "vehicle_engine ve";
		
		if(!empty($data['filter_model_id'])) {
			$sql .= " WHERE ve.vehicle_model_id = '" . (int) $data['filter_model_id'] . "'";
		}
		
		$sql .= " ORDER BY ve.typ_name ASC";

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}
		
		if(!empty($data['filter_model_id']) and count($data) == 1) {
			$engines_data = $this->cache->get('vehicle_engine.' . (int) $data['filter_model_id']);
			
			if (!$engines_data) {
				$query = $this->db->query($sql);
				
				if ($query->rows) {
					foreach ($query->rows as $key => $row) {
						$query->rows[$key]['name'] = str_replace('() ', '', $row['name']);
					}
				}
				
				$engines_data = $query->rows;
				
				$this->cache->set('vehicle_engine.' . (int) $data['filter_model_id'], $engines_data);
			}
			
			return $engines_data;
		}
		
		$query = $this->db->query($sql);
		
		if ($query->rows) {
			foreach ($query->rows as $key => $row) {
				$query->rows[$key]['name'] = str_replace('() ', '', $row['name']);
			}
		}

		return $query->rows;
	}
	
	public function getPosition($position_id, $language_id = false) {
		if ($language_id === false) {
			$language_id = $this->config->get('config_language_id');
		}
		
		$position_data = $this->cache->get('vehicle_position.' . (int) $position_id . '.' . (int) $language_id);
		
		if (!$position_data) {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "vehicle_position WHERE vehicle_position_id = '" . (int) $position_id . "' AND language_id = '" . (int) $language_id . "'");
			
			$position_data = $query->row;
			
			$this->cache->set('vehicle_position.' . (int) $position_id . '.' . (int) $language_id, $position_data);
		}
		
		return $position_data;
	}
	
	public function getPositions($language_id = false) {
		if ($language_id === false) {
			$language_id = $this->config->get('config_language_id');
		}
		
		$positions_data = $this->cache->get('vehicle_position.all.' . (int) $language_id);
		
		if (!$positions_data) {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "vehicle_position WHERE language_id = '" . (int) $language_id . "'");
			
			$positions_data = $query->rows;
			
			$this->cache->set('vehicle_position.all.' . (int) $language_id, $positions_data);
		}
		
		return $positions_data;
	}
	
	public function addPosition($data) {
		$position_id = false;
		
		foreach($data as $language_id => $position) {
			$sql = "INSERT INTO " . DB_PREFIX . "vehicle_position SET language_id = '" . (int) $language_id . "', text = '" . $this->db->escape($position) . "'";
			
			if($position_id) {
				$sql .= ", vehicle_position_id = '" . (int) $position_id . "'";
			}
			
			$this->db->query($sql);
			
			if(!$position_id) {
				$position_id = $this->db->getLastId();
			}
		}
		
		$this->cache->delete('vehicle_position');
		
		return $position_id;
	}
	
	public function deletePosition($position_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "vehicle_position WHERE vehicle_position_id = '" . (int) $position_id . "'");
		
		$this->cache->delete('vehicle_position');
	}
	
	public function getColor($color_id, $language_id = false) {
		if ($language_id === false) {
			$language_id = $this->config->get('config_language_id');
		}
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "vehicle_color WHERE vehicle_color_id = '" . (int) $color_id . "' AND language_id = '" . (int) $language_id . "'");
		
		return $query->row;
	}
	
	public function getColors($language_id = false) {
		if ($language_id === false) {
			$language_id = $this->config->get('config_language_id');
		}
		
		$colors_data = $this->cache->get('vehicle_color.all.' . (int) $language_id);
		
		if (!$colors_data) {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "vehicle_color WHERE language_id = '" . (int) $language_id . "'");
			
			$colors_data = $query->rows;
			
			$this->cache->set('vehicle_color.all.' . (int) $language_id, $colors_data);
		}
		
		return $colors_data;
	}
	
	public function addColor($data) {
		$color_id = false;
		
		foreach($data as $language_id => $color) {
			$sql = "INSERT INTO " . DB_PREFIX . "vehicle_color SET language_id = '" . (int) $language_id . "', text = '" . $this->db->escape($color) . "'";
			
			if($color_id) {
				$sql .= ", vehicle_color_id = '" . (int) $color_id . "'";
			}
			
			$this->db->query($sql);
			
			if(!$color_id) {
				$color_id = $this->db->getLastId();
			}
		}
		
		$this->cache->delete('vehicle_color');
		
		return $color_id;
	}
	
	public function deleteColor($color_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "vehicle_color WHERE vehicle_color_id = '" . (int) $color_id . "'");
		
		$this->cache->delete('vehicle_color');
	}
	
	public function getTransmission($transmission_id, $language_id = false) {
		if ($language_id === false) {
			$language_id = $this->config->get('config_language_id');
		}
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "vehicle_transmission WHERE vehicle_transmission_id = '" . (int) $transmission_id . "' AND language_id = '" . (int) $language_id . "'");
		
		return $query->row;
	}
	
	public function getTransmissions($language_id = false) {
		if ($language_id === false) {
			$language_id = $this->config->get('config_language_id');
		}
		
		$transmissions_data = $this->cache->get('vehicle_transmission.all.' . (int) $language_id);
		
		if (!$transmissions_data) {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "vehicle_transmission WHERE language_id = '" . (int) $language_id . "'");
			
			$transmissions_data = $query->rows;
			
			$this->cache->set('vehicle_transmission.all.' . (int) $language_id, $transmissions_data);
		}
		
		return $transmissions_data;
	}
	
	public function addTransmission($data) {
		$transmission_id = false;
		
		foreach($data as $language_id => $transmission) {
			$sql = "INSERT INTO " . DB_PREFIX . "vehicle_transmission SET language_id = '" . (int) $language_id . "', text = '" . $this->db->escape($transmission) . "'";
			
			if($transmission_id) {
				$sql .= ", vehicle_transmission_id = '" . (int) $transmission_id . "'";
			}
			
			$this->db->query($sql);
			
			if(!$transmission_id) {
				$transmission_id = $this->db->getLastId();
			}
		}
		
		$this->cache->delete('vehicle_transmission');
		
		return $transmission_id;
	}
	
	public function deleteTransmission($transmission_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "vehicle_transmission WHERE vehicle_transmission_id = '" . (int) $transmission_id . "'");
		
		$this->cache->delete('vehicle_transmission');
	}
	
	public function getDrive($drive_id, $language_id = false) {
		if ($language_id === false) {
			$language_id = $this->config->get('config_language_id');
		}
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "vehicle_drive WHERE vehicle_drive_id = '" . (int) $drive_id . "' AND language_id = '" . (int) $language_id . "'");
		
		return $query->row;
	}
	
	public function getDrives($language_id = false) {
		if ($language_id === false) {
			$language_id = $this->config->get('config_language_id');
		}
		
		$drives_data = $this->cache->get('vehicle_drive.all.' . (int) $language_id);
		
		if (!$drives_data) {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "vehicle_drive WHERE language_id = '" . (int) $language_id . "'");
			
			$drives_data = $query->rows;
			
			$this->cache->set('vehicle_drive.all.' . (int) $language_id, $drives_data);
		}
		
		return $drives_data;
	}
	
	public function addDrive($data) {
		$drive_id = false;
		
		foreach($data as $language_id => $drive) {
			$sql = "INSERT INTO " . DB_PREFIX . "vehicle_drive SET language_id = '" . (int) $language_id . "', text = '" . $this->db->escape($drive) . "'";
			
			if($drive_id) {
				$sql .= ", vehicle_drive_id = '" . (int) $drive_id . "'";
			}
			
			$this->db->query($sql);
			
			if(!$drive_id) {
				$drive_id = $this->db->getLastId();
			}
		}
		
		$this->cache->delete('vehicle_drive');
		
		return $drive_id;
	}
	
	public function deleteDrive($drive_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "vehicle_drive WHERE vehicle_drive_id = '" . (int) $drive_id . "'");
		
		$this->cache->delete('vehicle_drive');
	}
	
	public function getGBSpeedLevel($gb_speed_level) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "vehicle_gb_speed_level WHERE text = '" . $this->db->escape($gb_speed_level) . "'");
		
		return $query->row;
	}
	
	public function getGBSpeedLevels() {
		$speed_levels_data = $this->cache->get('vehicle_speed_level.all');
		
		if (!$speed_levels_data) {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "vehicle_gb_speed_level");
			
			$speed_levels_data = $query->rows;
			
			$this->cache->set('vehicle_speed_level.all', $speed_levels_data);
		}
		
		return $speed_levels_data;
	}
	
	public function addGBSpeedLevel($text) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "vehicle_gb_speed_level SET text = '" . $this->db->escape($text) . "'");
		
		$this->cache->delete('vehicle_speed_level');
		
		return $this->db->getLastId();
	}
	
	public function deleteGBSpeedLevel($gb_speed_level_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "vehicle_gb_speed_level WHERE vehicle_gb_speed_level_id = '" . (int) $gb_speed_level_id . "'");
		
		$this->cache->delete('vehicle_speed_level');
	}
	
}