<?php
namespace Opencart\Catalog\Model\User;
class User extends \Opencart\System\Engine\Model {
	public function addUser($data) {
		$this->db->query("INSERT INTO `" . DB_PREFIX . "user` SET login = '" . $this->db->escape($data['email']) . "', email = '" . $this->db->escape($data['email']) . "', user_group_id = '1', salt = '" . $this->db->escape($salt = oc_token(9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "', currency = '" . $this->db->escape($data['currency']) . "', language_id = '" . (int) $data['language_id'] . "', status = '1', date_added = NOW()");
	
		return $this->db->getLastId();
	}

	public function editUser($user_id, $data) {
		$this->db->query("UPDATE `" . DB_PREFIX . "user` SET company = '" . $this->db->escape($data['company']) . "', website = '" . $this->db->escape($data['website']) . "', currency = '" . $this->db->escape($data['currency']) . "', language_id = '" . (int) $data['language_id'] . "', catalog = '" . $this->db->escape($data['catalog']) . "', label = '" . (int) $data['label'] . "', default_product_used = '" . (int) $data['default_product_used'] . "', default_product_delivery = '" . (int) $data['default_product_delivery'] . "', default_brand = '" . $this->db->escape($data['default_brand']) . "', address_1 = '" . $this->db->escape($data['address_1']) . "', address_2 = '" . $this->db->escape($data['address_2']) . "', city = '" . $this->db->escape($data['city']) . "', postcode = '" . $this->db->escape($data['postcode']) . "', country_id = '" . (int) $data['country_id'] . "', country = '" . $this->db->escape($data['country']) . "', zone_id = '" . (int) $data['zone_id'] . "', zone = '" . $this->db->escape($data['zone']) . "', phone = '" .  $this->db->escape($data['phone']) . "', vat = '" . $this->db->escape($data['vat']) . "' WHERE user_id = '" . (int) $user_id . "'");
		
		if (!empty($data['logo'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "user SET logo = '" . $this->db->escape($data['logo']) . "' WHERE user_id = '" . (int) $user_id . "'");
		} else {
			$query = $this->db->query("SELECT logo FROM " . DB_PREFIX . "user WHERE user_id = '" . (int) $user_id . "'");
			
			if($query->row['logo']) {
				unlink(DIR_IMAGE . $query->row['logo']);
			}
		}
	}

	public function editPassword($user_id, $password) {
		$this->db->query("UPDATE `" . DB_PREFIX . "user` SET salt = '" . $this->db->escape($salt = oc_token(9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($password)))) . "', code = '' WHERE user_id = '" . (int)$user_id . "'");
	}
	
	public function editTax($user_id, $tax) {
		$this->db->query("UPDATE `" . DB_PREFIX . "user` SET tax = '" . (int) $tax . "' WHERE user_id = '" . (int)$user_id . "'");
	}
	
	public function editUserLanguage($user_id, $language_id) {
		$this->db->query("UPDATE " . DB_PREFIX . "user SET language_id = '" . (int) $language_id . "' WHERE user_id = '" . (int) $user_id . "'");
	}
	
	public function editCode($email, $code) {
		$this->db->query("UPDATE `" . DB_PREFIX . "user` SET code = '" . $this->db->escape($code) . "' WHERE LCASE(email) = '" . $this->db->escape(oc_strtolower($email)) . "'");
	}
	
	public function getUserByCode($code) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "user` WHERE code = '" . $this->db->escape($code) . "' AND code != ''");

		return $query->row;
	}
	
	public function getUserByEmail($email) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "user` WHERE LCASE(email) = '" . $this->db->escape(oc_strtolower($email)) . "'");

		return $query->row;
	}

	public function getUser($user_id) {
		$query = $this->db->query("SELECT *, (SELECT ug.name FROM `" . DB_PREFIX . "user_group` ug WHERE ug.user_group_id = u.user_group_id) AS user_group FROM `" . DB_PREFIX . "user` u WHERE u.user_id = '" . (int)$user_id . "'");

		return $query->row;
	}

	public function getUsers($data = array()) {
		$sql = "SELECT * FROM `" . DB_PREFIX . "user`";

		$sort_data = array(
			'login',
			'status',
			'date_added'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY login";
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

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getTotalUsers() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "user`");

		return $query->row['total'];
	}

	public function getTotalUsersByGroupId($user_group_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "user` WHERE user_group_id = '" . (int)$user_group_id . "'");

		return $query->row['total'];
	}
	
	public function getTotalUsersByLogin($login) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "user` WHERE LCASE(login) = '" . $this->db->escape(oc_strtolower($login)) . "'");

		return $query->row['total'];
	}
	
	public function getTotalUsersByEmail($email) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "user` WHERE LCASE(email) = '" . $this->db->escape(oc_strtolower($email)) . "'");

		return $query->row['total'];
	}

	public function addLoginAttempt($login) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user_login WHERE LCASE(login) = '" . $this->db->escape(oc_strtolower((string)$login)) . "'");

		if (!$query->num_rows) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "user_login SET login = '" . $this->db->escape(oc_strtolower((string)$login)) . "', ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "', total = 1, date_added = '" . $this->db->escape(date('Y-m-d H:i:s')) . "', date_modified = '" . $this->db->escape(date('Y-m-d H:i:s')) . "'");
		} else {
			$this->db->query("UPDATE " . DB_PREFIX . "user_login SET total = (total + 1), date_modified = '" . $this->db->escape(date('Y-m-d H:i:s')) . "' WHERE user_login_id = '" . (int)$query->row['user_login_id'] . "'");
		}
	}

	public function getLoginAttempts($login) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "user_login` WHERE LCASE(login) = '" . $this->db->escape(oc_strtolower($login)) . "'");

		return $query->row;
	}

	public function deleteLoginAttempts($login) {
		$this->db->query("DELETE FROM `" . DB_PREFIX . "user_login` WHERE LCASE(login) = '" . $this->db->escape(oc_strtolower($login)) . "'");
	}
	
	public function checkLoginAndPassword($login, $password) {
		$user_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user WHERE LCASE(login) = '" . $this->db->escape(oc_strtolower($login)) . "' AND (password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('" . $this->db->escape($password) . "'))))) OR password = '" . $this->db->escape(md5($password)) . "') AND status = '1'");

		if ($user_query->num_rows) {
			return true;
		} else {
			return false;
		}
	}
}