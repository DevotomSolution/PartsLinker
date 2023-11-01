<?php
namespace Opencart\Catalog\Model\Setting;
class Setting extends \Opencart\System\Engine\Model {
	public function getSettings(int $store_id = 0): array {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "setting`");

		return $query->rows;
	}
}
