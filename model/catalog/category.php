<?php
namespace Opencart\Catalog\Model\Catalog;
class Category extends \Opencart\System\Engine\Model {
	public function getCategory($category_id, $language_id = false) {
		if(!$language_id) {
			$language_id = $this->config->get('config_language_id');
		}
		
		$category_data = $this->cache->get('category.' . (int) $category_id . '.' . (int) $language_id);
		
		if (!$category_data) {
			$sql = "SELECT cp.category_id AS category_id, GROUP_CONCAT(cd1.name ORDER BY cp.level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') AS path, c1.parent_id, c1.sort_order, cd2.name, c1.image, c1.default_weight FROM " . DB_PREFIX . "category_path cp LEFT JOIN " . DB_PREFIX . "category c1 ON (cp.category_id = c1.category_id) LEFT JOIN " . DB_PREFIX . "category c2 ON (cp.path_id = c2.category_id) LEFT JOIN " . DB_PREFIX . "category_description cd1 ON (cp.path_id = cd1.category_id) LEFT JOIN " . DB_PREFIX . "category_description cd2 ON (cp.category_id = cd2.category_id) WHERE cd1.language_id = '" . (int) $language_id . "' AND cd2.language_id = '" . (int) $language_id . "' AND cp.category_id = '" . (int) $category_id . "'";
			
			$query = $this->db->query($sql);
			
			$category_data = $query->row;
			
			if(isset($category_data['category_id'])) {
				$translates_query = $this->db->query("SELECT language_id, name FROM " . DB_PREFIX . "category_description cd WHERE cd.category_id = '" . (int) $category_id . "'");
				
				if($translates_query->rows) {
					$category_data['translates'] = array_column($translates_query->rows, 'name', 'language_id');
				} else {
					$category_data['translates'] = array();
				}
			} else {
				return false;
			}
			
			$category_data['name'] = html_entity_decode($category_data['name']);
			
			$category_data['path'] = html_entity_decode($category_data['path']);
			
			foreach ($category_data['translates'] as $key => $translate) {
				$category_data['translates'][$key] = html_entity_decode($translate);
			}

			$this->cache->set('category.' . (int) $category_id . '.' . (int) $language_id, $category_data);
		}
		
		return $category_data;
	}

	public function getCategories($user_id = false, $data = array(), $language_id = false) {
		if (!$language_id) {
			$language_id = $this->config->get('config_language_id');
		}
		
		$sql = "SELECT cp.category_id AS category_id, GROUP_CONCAT(cd1.name ORDER BY cp.level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') AS path FROM " . DB_PREFIX . "category_path cp LEFT JOIN " . DB_PREFIX . "category c1 ON (cp.category_id = c1.category_id) LEFT JOIN " . DB_PREFIX . "category_description cd1 ON (cp.path_id = cd1.category_id) LEFT JOIN " . DB_PREFIX . "category_description cd2 ON (c1.category_id = cd2.category_id)";
	
		if ($user_id) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "user_to_disabled_category utdc ON cp.category_id = utdc.category_id AND utdc.user_id = '" . (int) $user_id . "'";
		}
		
		$sql .= " WHERE cd1.language_id = '" . (int) $language_id . "' AND cd2.language_id = '" . (int) $language_id . "'";
		
		if ($user_id) {
			$sql .= " AND utdc.category_id IS NULL";
		}
		
		if (!empty($data['filter_name'])) {
			$sql .= " AND cd2.name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		} 
		
		if (!empty($data['filter_name_fulltext'])) {
			$sql .= " AND MATCH (cd2.name) AGAINST ('" . $this->db->escape($data['filter_name_fulltext']) . "')";
		}

		$sql .= " GROUP BY cp.category_id";

		$sort_data = array(
			'name',
			'sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY path";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}
		
		
		if(!$data and !$user_id) {
			$category_data = $this->cache->get('category.all.' . (int) $language_id);
		
			if (!$category_data) {
				$category_data = array();

				$query = $this->db->query($sql);
				
				foreach($query->rows as $category) {
					$category_data[] = $this->getCategory($category['category_id']);
				}

				$this->cache->set('category.all.' . (int) $language_id, $category_data);
			}

			return $category_data;
		}
		
		if((isset($data['start']) and isset($data['limit']) and count($data) == 2) and !$user_id) {
			$category_data = $this->cache->get('category.' . (int) $language_id . '.' . (int) $data['start'] . '-' . (int) $data['limit']);
			
			if (!$category_data) {
				$category_data = array();

				$query = $this->db->query($sql);
				
				foreach($query->rows as $category) {
					$category_data[] = $this->getCategory($category['category_id']);
				}

				$this->cache->set('category.' . (int) $language_id . '.' . (int) $data['start'] . '-' . (int) $data['limit'], $category_data);
			}
			
			return $category_data;
		}
		
		if(!$data and $user_id) {
			$category_data = $this->cache->get('user.' . (int) $user_id . '.category.' . (int) $language_id);
			
			if (!$category_data) {
				$category_data = array();

				$query = $this->db->query($sql);
				
				foreach($query->rows as $category) {
					$category_data[] = $this->getCategory($category['category_id']);
				}

				$this->cache->set('user.' . (int) $user_id . '.category.' . (int) $language_id, $category_data);
			}
			
			return $category_data;
		}
		
		$category_data = array();

		$query = $this->db->query($sql);
		
		foreach($query->rows as $category) {
			$category_data[] = $this->getCategory($category['category_id']);
		}
		
		return $category_data;
	}
	
	public function getCategoryByText($user_id, $text, $language_id = false) {
		if (!$language_id) {
			$language_id = $this->config->get('config_language_id');
		}
		
		$text = oc_strtolower($text);
		$text = preg_replace("/[^a-z\\ 0-9]/", '', $text);
		//$text = preg_replace("/\b[a-z]{1,2}\b/", '', $text);
		$text = preg_replace("/[\\ ]+/", ' ', $text);
		
		$sql = "SELECT cd1.category_id, cd1.meta_keyword FROM " . DB_PREFIX . "category_description cd1 LEFT JOIN " . DB_PREFIX . "user_to_disabled_category utdc ON cd1.category_id = utdc.category_id AND utdc.user_id = '" . (int) $user_id . "' WHERE MATCH (cd1.meta_keyword) AGAINST ('" . $this->db->escape($text) . "') AND cd1.language_id = '" . (int) $language_id . "' AND utdc.category_id IS NULL";
		
		$query = $this->db->query($sql);
		
		$result = 0;
		
		foreach ($query->rows as $row) {
			if (oc_strpos($text, $row['meta_keyword']) !== false) {
				$result = $row['category_id'];
			}
			
			if ($text === $row['meta_keyword']) {
				$result = $row['category_id'];
				break;
			}
		}
		
		return $result;
	}
	
	public function getTotalCategories($user_id = false, $data = array(), $language_id = false) {
		if(!$language_id) {
			$language_id = $this->config->get('config_language_id');
		}
		
		$sql = "SELECT COUNT(c.category_id) AS total FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (cd.category_id = c.category_id)";
		
		if($user_id) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "user_to_disabled_category utdc ON cp.category_id = utdc.category_id AND utdc.user_id = '" . (int) $user_id . "'";
		}
		
		$sql .= " WHERE cd.language_id = '" . (int) $language_id . "'";
		
		if($user_id) {
			$sql .= " AND utdc.category_id IS NULL";
		}
		
		if (!empty($data['filter_name'])) {
			$sql .= " AND cd.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		} 
		
		if (!empty($data['filter_name_fulltext'])) {
			$sql .= " AND MATCH (cd.name) AGAINST ('" . $this->db->escape($data['filter_name_fulltext']) . "')";
		}
		
		if(!$user_id and !$data) {
			$total_data = $this->cache->get('total.category');
			
			if (!$total_data) {
				$query = $this->db->query($sql);

				$total_data = $query->row;

				$this->cache->set('total.category', $total_data);
			}
			
			return $total_data['total'];
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}
	
	public function getInvolvedCategories($user_id, $data = array(), $language_id = false) {
		if(!$language_id) {
			$language_id = $this->config->get('config_language_id');
		}
		
		$sql = "SELECT DISTINCT c.category_id as category_id FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) LEFT JOIN " . DB_PREFIX . "product_to_category ptcat ON (c.category_id = ptcat.category_id) LEFT JOIN " . DB_PREFIX . "product_to_user ptu ON (ptcat.product_id = ptu.product_id)";
		
		if (!empty($data['filter_vehicle_brand']) or !empty($data['filter_vehicle_model']) or !empty($data['filter_vehicle_engine'])) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "product_to_vehicle ptv ON (ptu.product_id = ptv.product_id) LEFT JOIN " . DB_PREFIX . "vehicle v ON (ptv.vehicle_id = v.vehicle_id)";
		}
		
		/*if (!empty($data['filter_vehicle_engine'])) {
			$sql .= " LEFT JOIN vehicle_engine ve ON (v.vehicle_model_id = ve.vehicle_model_id)";
		}*/
		
		if (!empty($data['search'])) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "product_description pd ON (ptu.product_id = pd.product_id)";
		}
		
		$sql .= " WHERE cd.language_id = '" . (int) $language_id . "' AND ptu.user_id = '" . (int) $user_id . "'";
		
		if (!empty($data['filter_vehicle_brand'])) {
			$sql .= " AND v.vehicle_brand_id ='" . (int) $data['filter_vehicle_brand'] . "'";
		}
		
		if (!empty($data['filter_vehicle_model'])) {
			$sql .= " AND v.vehicle_model_id ='" . (int) $data['filter_vehicle_model'] . "'";
		}
		
		/*if (!empty($data['filter_vehicle_engine'])) {
			$sql .= " AND ve.vehicle_engine_id ='" . (int) $data['filter_vehicle_engine'] . "'";
		}*/
		
		if (!empty($data['search'])) {
			$sql .= " AND (pd.name LIKE '%" . $this->db->escape($data['search']) . "%' OR pd.description LIKE '%" . $this->db->escape($data['search']) . "%' OR ptu.sku = '" . $this->db->escape($data['search']) . "') AND pd.language_id = '" . (int) $this->config->get('config_language_id') . "'";
		}
		
		$sql .= " AND cd.language_id = '" . (int) $language_id . "'";
		
		if (empty($data['filter_vehicle_brand']) and empty($data['filter_vehicle_model']) and empty($data['filter_vehicle_engine']) and empty($data['search'])) {
			$category_data = $this->cache->get('user.' . (int) $user_id . '.involved_category.' . (int) $language_id);
		
			if(!$category_data) {
				$category_data = array();

				$query = $this->db->query($sql);
				
				foreach($query->rows as $category) {
					$category_data[] = $this->getCategory($category['category_id']);
				}

				$this->cache->set('user.' . (int) $user_id . '.involved_category.' . (int) $language_id, $category_data);
			}

			return $category_data;
		}
		
		$category_data = array();

		$query = $this->db->query($sql);
		
		foreach($query->rows as $category) {
			$category_data[] = $this->getCategory($category['category_id']);
		}

		return $category_data;
	}
	
	public function checkCategory($category_id) {
		$query = $this->db->query("SELECT COUNT(category_id) as count FROM " . DB_PREFIX . "category WHERE category_id = '" . (int) $category_id . "'");
		
		return $query->row['count'] > 0;
	}
	
	public function enableCategoryForUser($user_id, $category_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "user_to_disabled_category WHERE user_id = '" . (int) $user_id . "' AND category_id = '" . (int) $category_id . "'");
		$this->cache->delete('user.' . (int) $user_id . '.category');
	}
	
	public function disableCategoryForUser($user_id, $category_id) {
		$this->db->query("REPLACE INTO " . DB_PREFIX . "user_to_disabled_category SET user_id = '" . (int) $user_id . "', category_id = '" . (int) $category_id . "'");
		$this->cache->delete('user.' . (int) $user_id . '.category');
	}
	
	public function addCategory($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "category SET parent_id = '" . (int)$data['parent_id'] . "', default_weight = '" . (float)$data['default_weight'] . "', status = '1', date_modified = NOW(), date_added = NOW()");

		$category_id = $this->db->getLastId();

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "category SET image = '" . $this->db->escape($data['image']) . "' WHERE category_id = '" . (int)$category_id . "'");
		}

		foreach ($data['category_description'] as $language_id => $value) {
			$meta_keyword = oc_strtolower($value['name']);
			$meta_keyword = preg_replace("/[^a-z\\ 0-9]/", '', $meta_keyword);
			$meta_keyword = preg_replace("/\b[a-z]{1,2}\b/", '', $meta_keyword);
			$meta_keyword = preg_replace("/[\\ ]+/", ' ', $meta_keyword);
			
			$this->db->query("INSERT INTO " . DB_PREFIX . "category_description SET category_id = '" . (int)$category_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', meta_keyword = '" . $this->db->escape($meta_keyword) . "'");
		}

		// MySQL Hierarchical Data Closure Table Pattern
		$level = 0;

		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "category_path` WHERE category_id = '" . (int)$data['parent_id'] . "' ORDER BY `level` ASC");

		foreach ($query->rows as $result) {
			$this->db->query("INSERT INTO `" . DB_PREFIX . "category_path` SET `category_id` = '" . (int)$category_id . "', `path_id` = '" . (int)$result['path_id'] . "', `level` = '" . (int)$level . "'");

			$level++;
		}

		$this->db->query("INSERT INTO `" . DB_PREFIX . "category_path` SET `category_id` = '" . (int)$category_id . "', `path_id` = '" . (int)$category_id . "', `level` = '" . (int)$level . "'");

		$this->cache->clear();

		return $category_id;
	}
	
	public function editCategory($category_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "category SET parent_id = '" . (int)$data['parent_id'] . "',  default_weight = '" . (float)$data['default_weight'] . "', date_modified = NOW() WHERE category_id = '" . (int)$category_id . "'");

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "category SET image = '" . $this->db->escape($data['image']) . "' WHERE category_id = '" . (int)$category_id . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "category_description WHERE category_id = '" . (int)$category_id . "'");

		foreach ($data['category_description'] as $language_id => $value) {
			$meta_keyword = oc_strtolower($value['name']);
			$meta_keyword = preg_replace("/[^a-z\\ 0-9]/", '', $meta_keyword);
			$meta_keyword = preg_replace("/\b[a-z]{1,2}\b/", '', $meta_keyword);
			$meta_keyword = preg_replace("/[\\ ]+/", ' ', $meta_keyword);
			
			$this->db->query("INSERT INTO " . DB_PREFIX . "category_description SET category_id = '" . (int)$category_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', meta_keyword = '" . $this->db->escape($meta_keyword) . "'");
		}

		// MySQL Hierarchical Data Closure Table Pattern
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "category_path` WHERE path_id = '" . (int)$category_id . "' ORDER BY level ASC");

		if ($query->rows) {
			foreach ($query->rows as $category_path) {
				// Delete the path below the current one
				$this->db->query("DELETE FROM `" . DB_PREFIX . "category_path` WHERE category_id = '" . (int)$category_path['category_id'] . "' AND level < '" . (int)$category_path['level'] . "'");

				$path = array();

				// Get the nodes new parents
				$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "category_path` WHERE category_id = '" . (int)$data['parent_id'] . "' ORDER BY level ASC");

				foreach ($query->rows as $result) {
					$path[] = $result['path_id'];
				}

				// Get whats left of the nodes current path
				$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "category_path` WHERE category_id = '" . (int)$category_path['category_id'] . "' ORDER BY level ASC");

				foreach ($query->rows as $result) {
					$path[] = $result['path_id'];
				}

				// Combine the paths with a new level
				$level = 0;

				foreach ($path as $path_id) {
					$this->db->query("REPLACE INTO `" . DB_PREFIX . "category_path` SET category_id = '" . (int)$category_path['category_id'] . "', `path_id` = '" . (int)$path_id . "', level = '" . (int)$level . "'");

					$level++;
				}
			}
		} else {
			// Delete the path below the current one
			$this->db->query("DELETE FROM `" . DB_PREFIX . "category_path` WHERE category_id = '" . (int)$category_id . "'");

			// Fix for records with no paths
			$level = 0;

			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "category_path` WHERE category_id = '" . (int)$data['parent_id'] . "' ORDER BY level ASC");

			foreach ($query->rows as $result) {
				$this->db->query("INSERT INTO `" . DB_PREFIX . "category_path` SET category_id = '" . (int)$category_id . "', `path_id` = '" . (int)$result['path_id'] . "', level = '" . (int)$level . "'");

				$level++;
			}

			$this->db->query("REPLACE INTO `" . DB_PREFIX . "category_path` SET category_id = '" . (int)$category_id . "', `path_id` = '" . (int)$category_id . "', level = '" . (int)$level . "'");
		}

		$this->cache->clear();
	}
	
	public function deleteCategory($category_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "category_path WHERE category_id = '" . (int)$category_id . "'");

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category_path WHERE path_id = '" . (int)$category_id . "'");

		foreach ($query->rows as $result) {
			$this->deleteCategory($result['category_id']);
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "category WHERE category_id = '" . (int)$category_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "category_description WHERE category_id = '" . (int)$category_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_category WHERE category_id = '" . (int)$category_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "user_to_disabled_category WHERE category_id = '" . (int)$category_id . "'");

		$this->cache->clear();
	}
}