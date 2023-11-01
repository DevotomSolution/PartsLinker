<?php
namespace Opencart\Catalog\Model\Catalog;
class Import extends \Opencart\System\Engine\Model {
	public function addImportHistory($user_id, $data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "user_import_history SET user_id = '" . (int) $user_id . "', filename = '" . $this->db->escape($data['filename']) . "', csv_separator = '" . $this->db->escape($data['csv_separator']) . "', date = NOW()");
	}
	
	public function updateImportHistory($user_import_history_id, $uploaded, $updated, $ignored) {
		$this->db->query("UPDATE " . DB_PREFIX . "user_import_history uih SET uploaded = (uploaded + " . (int) $uploaded . "), updated = (updated + " . (int) $updated . "), ignored = (ignored + " . (int) $ignored . ") WHERE uih.user_import_history_id = '" . (int) $user_import_history_id . "'");
	}
	
	public function getImportHistory($user_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user_import_history uih WHERE user_id = '" . (int) $user_id . "' ORDER BY uih.user_import_history_id DESC LIMIT 0, 30");
		
		return $query->rows;
	}
	
	public function getLastImport($user_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user_import_history uih WHERE user_id = '" . (int) $user_id . "' ORDER BY uih.user_import_history_id DESC LIMIT 0, 1");
		
		return $query->row;
	}
}