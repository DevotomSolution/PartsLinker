<?php
namespace Opencart\Catalog\Model\User;
class Api extends \Opencart\System\Engine\Model {
	public function addSession(string $api_id, string $session_id, string $ip): int {
		$this->db->query("INSERT INTO `" . DB_PREFIX . "api_session` SET `api_id` = '" . $this->db->escape($api_id) . "',`session_id` = '" . $this->db->escape($session_id) . "', `ip` = '" . $this->db->escape($ip) . "', `date_added` = NOW(), `date_modified` = NOW()");

		return $this->db->getLastId();
	}
	
	public function getApiByToken(string $token): array {
		//$query = $this->db->query("SELECT DISTINCT * FROM `" . DB_PREFIX . "api_session` `as` WHERE `as`.`session_id` = '" . $this->db->escape((string)$token) . "' AND ai.`ip` = '" . $this->db->escape((string)$this->request->server['REMOTE_ADDR']) . "'");
		$query = $this->db->query("SELECT DISTINCT * FROM `" . DB_PREFIX . "api_session` `as` WHERE `as`.`session_id` = '" . $this->db->escape((string)$token) . "'");

		return $query->row;
	}

	public function updateSession(string $api_session_id): void {
		// keep the session alive
		$this->db->query("UPDATE `" . DB_PREFIX . "api_session` SET `date_modified` = NOW() WHERE `api_session_id` = '" . (int)$api_session_id . "'");
	}

	public function cleanSessions(): void {
		$this->db->query("DELETE FROM `" . DB_PREFIX . "api_session` WHERE TIMESTAMPADD(HOUR, 1, `date_modified`) < NOW()");
	}
}
