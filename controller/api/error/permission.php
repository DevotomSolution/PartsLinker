<?php
namespace Opencart\Catalog\Controller\Api\Error;
class Permission extends \Opencart\System\Engine\Controller {
	private $error = array();

	public function index() {
		$data = array();
		
		$data['error'] = 'You do not have permission to access this page, please refer to your system administrator.';
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($data));
	}
}
