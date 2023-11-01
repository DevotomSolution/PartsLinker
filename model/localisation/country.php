<?php
namespace Opencart\Catalog\Model\Localisation;
class Country extends \Opencart\System\Engine\Model {
	public function getCountry($country_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "country WHERE country_id = '" . (int)$country_id . "' AND status = '1'");

		return $query->row;
	}
	
	public function getCountryByCode($code) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "country WHERE iso_code_2 = '" . $this->db->escape($code) . "' AND status = '1'");

		return $query->row;
	}

	public function getCountries() {
		$country_data = $this->cache->get('country');

		if (!$country_data) {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "country WHERE status = '1' ORDER BY name ASC");

			$country_data = $query->rows;

			$this->cache->set('country', $country_data);
		}

		return $country_data;
	}
}