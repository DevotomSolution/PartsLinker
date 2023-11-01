<?php
namespace Opencart\Catalog\Controller\Api;
class Languages extends \Opencart\System\Engine\Controller {
	public function index() {
		$data = array();
		
		$this->load->model('localisation/language');
		
		$data['languages'] = $this->model_localisation_language->getLanguages();
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($data));
	}
}
