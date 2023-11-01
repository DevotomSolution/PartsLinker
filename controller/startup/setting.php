<?php
namespace Opencart\Catalog\Controller\Startup;
class Setting extends \Opencart\System\Engine\Controller {
	public function index(): void {
		// Settings
		$results = $this->cache->get('setting');
		
		if (!$results) {
			$this->load->model('setting/setting');
			
			$results = $this->model_setting_setting->getSettings();
			
			$this->cache->set('setting', $results);
		}

		foreach ($results as $result) {
			if (!$result['serialized']) {
				$this->config->set($result['key'], $result['value']);
			} else {
				$this->config->set($result['key'], json_decode($result['value'], true));
			}
		}
	}
}