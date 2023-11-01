<?php
namespace Opencart\Catalog\Controller\Account;
class Logout extends \Opencart\System\Engine\Controller {
	public function index() {
		$this->user->logout();
		
		$this->session->data = [];
		
		$this->response->redirect($this->url->link('account/login', '', true));
	}
}