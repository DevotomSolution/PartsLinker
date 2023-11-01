<?php
namespace Opencart\Catalog\Controller\Api;
class Register extends \Opencart\System\Engine\Controller {
	private $error = array();

	public function index() {
		$data = array();

		$this->load->language('account/register');

		$this->load->model('user/user');
		
		if ($this->validate() && ($this->request->server['REQUEST_METHOD'] == 'POST')) {
			$user_id = $this->model_user_user->addUser($this->request->post);
			
			if ($user_id) {
				$data['success'] = $this->language->get('text_success');
			} else {
				$data['success'] = '';
			}
		} else {
			$data['success'] = '';
		}

		if (isset($this->error['warning'])) {
			$data['error'] = $this->error['warning'];
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($data));
	}

	private function validate() {
		//$this->error['warning'] = 'Registration is not yet available';
		
		if (empty($this->request->post['email']) || (oc_strlen($this->request->post['email']) > 96) || !filter_var($this->request->post['email'], FILTER_VALIDATE_EMAIL)) {
			$this->error['warning'] = $this->language->get('error_email');
		} else if ($this->model_user_user->getTotalUsersByLogin($this->request->post['email']) && $this->model_user_user->getTotalUsersByEmail($this->request->post['email'])) {
			$this->error['warning'] = $this->language->get('error_duplicate');
		}

		if (empty($this->request->post['password']) || (oc_strlen(html_entity_decode($this->request->post['password'], ENT_QUOTES, 'UTF-8')) < 4) || (oc_strlen(html_entity_decode($this->request->post['password'], ENT_QUOTES, 'UTF-8')) > 40)) {
			$this->error['warning'] = $this->language->get('error_password');
		}

		if (empty($this->request->post['password']) || empty($this->request->post['confirm']) || $this->request->post['confirm'] !== $this->request->post['password']) {
			$this->error['warning'] = $this->language->get('error_confirm');
		}
		
		if (empty($this->request->post['currency'])) {
			$this->error['warning'] = $this->language->get('error_currency');
		} else {
			$this->load->model('localisation/currency');
			
			if (!$this->model_localisation_currency->getCurrencyByCode($this->request->post['currency'])) {
				$this->error['warning'] = $this->language->get('error_currency');
			}
		}
		
		if (empty($this->request->post['language_id'])) {
			$this->error['warning'] = $this->language->get('error_language_id');
		} else {
			$this->load->model('localisation/language');
			
			if (!$this->model_localisation_language->getLanguage($this->request->post['language_id'])) {
				$this->error['warning'] = $this->language->get('error_language_id');
			}
		}
		
		if (empty($this->request->post['agree'])) {
			$this->error['warning'] = $this->language->get('error_agree');
		}
		
		return !$this->error;
	}
}