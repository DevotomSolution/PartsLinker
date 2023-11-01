<?php
namespace Opencart\Catalog\Controller\Api\Error;
class Session extends \Opencart\System\Engine\Controller {
	private $error = array();

	public function index() {
		$data = array();
		
		$data['error'] = 'Session expired';
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($data));
	}
}
