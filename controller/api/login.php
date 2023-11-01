<?php
namespace Opencart\Catalog\Controller\Api;
class Login extends \Opencart\System\Engine\Controller {
	private $error = array();

	public function index() {
		$json = array();
		
		$this->load->language('account/login');
		
		if ($this->validate()) {
			$this->load->model('user/api');

			$api_id = oc_token(32);

			$this->model_user_api->addSession($api_id, $this->session->getId(), $this->request->server['REMOTE_ADDR']);
		
			$this->session->data['api_id'] = $api_id;
			
			$json['success'] = $this->language->get('text_success');
			
			$json['user_token'] = $this->session->getId();
		}
		
		if (isset($this->error['warning'])) {
			$json['error'] = $this->error['warning'];
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	protected function validate() {
		if (empty($this->request->post['email']) || empty($this->request->post['password'])) {
			$this->error['warning'] = $this->language->get('error_login');
		} else {
			$this->load->model('user/user');

			// Check how many login attempts have been made.
			$login_info = $this->model_user_user->getLoginAttempts($this->request->post['email']);

			if ($login_info && ($login_info['total'] >= $this->config->get('config_login_attempts')) && strtotime('-1 hour') < strtotime($login_info['date_modified'])) {
				$this->error['warning'] = $this->language->get('error_attempts');
			}
		}

		if (!$this->error) {
			if (!$this->user->login($this->request->post['email'], html_entity_decode($this->request->post['password'], ENT_QUOTES, 'UTF-8'))) {
				$this->error['warning'] = $this->language->get('error_login');

				$this->model_user_user->addLoginAttempt($this->request->post['email']);
			} else {
				$this->model_user_user->deleteLoginAttempts($this->request->post['email']);
			}
		}

		return !$this->error;
	}
}
