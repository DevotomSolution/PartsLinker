<?php
namespace Opencart\System\Library\Cart;
class User {
	private object $db;
	private object $request;
	private object $session;
	private int $user_id = 0;
	private string $login = '';
	private int $user_group_id = 0;
	private string $email = '';
	private array $permission = [];

	/**
	 * Constructor
	 *
	 * @param    object  $registry
	 */
	public function __construct(\Opencart\System\Engine\Registry $registry) {
		$this->db = $registry->get('db');
		$this->request = $registry->get('request');
		$this->session = $registry->get('session');

		if (isset($this->session->data['user_id'])) {
			$user_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "user` WHERE `user_id` = '" . (int)$this->session->data['user_id'] . "' AND `status` = '1'");
			
			if ($user_query->num_rows) {
				$this->user_id = $user_query->row['user_id'];
				$this->login = $user_query->row['login'];
				$this->user_group_id = $user_query->row['user_group_id'];
				$this->email = $user_query->row['email'];
				
				$this->session->data['user_data'] = $user_query->row;

				$this->db->query("UPDATE `" . DB_PREFIX . "user` SET `ip` = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "' WHERE `user_id` = '" . (int)$this->session->data['user_id'] . "'");

				$user_group_query = $this->db->query("SELECT `permission` FROM `" . DB_PREFIX . "user_group` WHERE `user_group_id` = '" . (int)$user_query->row['user_group_id'] . "'");

				$permissions = json_decode($user_group_query->row['permission'], true);

				if (is_array($permissions)) {
					foreach ($permissions as $key => $value) {
						$this->permission[$key] = $value;
					}
				}
			} else {
				$this->logout();
			}
		}
	}
	
	/**
	 * Login
	 *
	 * @param    string  $login
	 * @param    string  $password
	 *
	 * @return   bool
	 */
	public function login(string $login, string $password): bool {
		$user_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user WHERE LCASE(login) = '" . $this->db->escape(oc_strtolower($login)) . "' AND (password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('" . $this->db->escape($password) . "'))))) OR password = '" . $this->db->escape(md5($password)) . "') AND status = '1'");

		if ($user_query->num_rows) {
			$this->session->data = [];
			
			$this->session->data['user_id'] = $user_query->row['user_id'];

			$this->user_id = $user_query->row['user_id'];
			$this->login = $user_query->row['login'];
			$this->user_group_id = $user_query->row['user_group_id'];
			$this->email = $user_query->row['email'];

			$user_group_query = $this->db->query("SELECT `permission` FROM `" . DB_PREFIX . "user_group` WHERE `user_group_id` = '" . (int)$user_query->row['user_group_id'] . "'");

			$permissions = json_decode($user_group_query->row['permission'], true);

			if (is_array($permissions)) {
				foreach ($permissions as $key => $value) {
					$this->permission[$key] = $value;
				}
			}
			
			$this->session->data['user_data'] = $user_query->row;

			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * Logout
	 *
	  * @return   void
	 */
	public function logout(): void {
		$this->user_id = 0;
		$this->login = '';
		$this->user_group_id = 0;
		$this->email = '';
	}
	
	/**
	 * hasPermission
	 *
	 * @param    string  $key
	 * @param    mixed  $value
	 *
	 * @return   bool
	 */
	public function hasPermission(string $key, mixed $value): bool {
		if (isset($this->permission[$key])) {
			return in_array($value, $this->permission[$key]);
		} else {
			return false;
		}
	}
	
	/**
	 * isLogged
	 *
	 * @return   bool
	 */
	public function isLogged(): bool {
		return $this->user_id ? true : false;
	}
	
	/**
	 * getId
	 *
	 * @return   int
	 */
	public function getId(): int {
		return $this->user_id;
	}

	/**
	 * getLogin
	 *
	 * @return   string
	 */
	public function getLogin(): string {
		return $this->login;
	}
	
	/**
	 * getGroupId
	 *
	 * @return   int
	 */
	public function getGroupId(): int {
		return $this->user_group_id;
	}
	
	/**
	 * getEmail
	 *
	 * @return   string
	 */
	public function getEmail(): string {
		return $this->email;
	}
	
	public function get($key) {
		if(isset($this->session->data['user_data'][$key])) {
			return $this->session->data['user_data'][$key];
		} elseif($key === 'all') {
			return $this->session->data['user_data'];
		} else {
			return false;
		}
	}
}
