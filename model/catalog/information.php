<?php
namespace Opencart\Catalog\Model\Catalog;
class Information extends \Opencart\System\Engine\Model {
	public function getInformation($information_id) {
		$language_id = 1;
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "information i LEFT JOIN " . DB_PREFIX . "information_description id ON (i.information_id = id.information_id) WHERE i.information_id = '" . (int)$information_id . "' AND id.language_id = '" . (int)$language_id . "' AND i.status = '1'");

		return $query->row;
	}

	public function getInformations() {
		$language_id = 1;
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "information i LEFT JOIN " . DB_PREFIX . "information_description id ON (i.information_id = id.information_id) WHERE id.language_id = '" . (int)$language_id . "' AND i.status = '1' ORDER BY i.sort_order, LCASE(id.title) ASC");

		return $query->rows;
	}
}