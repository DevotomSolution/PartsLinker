<?php
namespace Opencart\Catalog\Controller\Account;
class Register extends \Opencart\System\Engine\Controller {
	private $error = array();

	public function index() {
		if ($this->user->isLogged() && isset($this->request->get['user_token']) && ($this->request->get['user_token'] == $this->session->data['user_token'])) {
			$this->response->redirect($this->url->link('catalog/product', 'user_token=' . $this->session->data['user_token'], true));
		} else {
			$this->user->logout();
		}

		$this->load->language('account/register');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('user/user');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$user_id = $this->model_user_user->addUser($this->request->post);
			
			// Clear any previous login attempts for unregistered accounts.
			$this->model_user_user->deleteLoginAttempts($this->request->post['email']);

			if ($this->user->login($this->request->post['email'], $this->request->post['password'])) {
				$this->session->data['user_token'] = oc_token(32);

				if (isset($this->request->post['redirect']) && (strpos($this->request->post['redirect'], HTTP_SERVER) === 0 || strpos($this->request->post['redirect'], HTTP_SERVER) === 0)) {
					$this->response->redirect($this->request->post['redirect'] . '&user_token=' . $this->session->data['user_token']);
				} else {
					$this->response->redirect($this->url->link('account/setting', 'user_token=' . $this->session->data['user_token'], true));
				}
			}
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['action'] = $this->url->link('account/register', '', true);
		
		$data['text_register'] = sprintf($this->language->get('text_register'), $this->url->link('account/login', '', true));
		
		if (isset($this->request->post['email'])) {
			$data['email'] = $this->request->post['email'];
		} else {
			$data['email'] = '';
		}
		
		if (isset($this->request->post['password'])) {
			$data['password'] = $this->request->post['password'];
		} else {
			$data['password'] = '';
		}

		if (isset($this->request->post['confirm'])) {
			$data['confirm'] = $this->request->post['confirm'];
		} else {
			$data['confirm'] = '';
		}
		
		$this->load->model('localisation/currency');
		
		$data['currencies'] = $this->model_localisation_currency->getCurrencies();

		if (isset($this->request->post['currency'])) {
			$data['currency'] = $this->request->post['currency'];
		} else {
			$data['currency'] = '';
		}
		
		$this->load->model('localisation/language');
		
		$data['languages'] = $this->model_localisation_language->getLanguages();
		
		if (isset($this->request->post['language_id'])) {
			$data['language_id'] = $this->request->post['language_id'];
		} elseif (isset($this->request->cookie['language_id'])) {
			$data['language_id'] = $this->request->cookie['language_id'];
		} else {
			$data['language_id'] = '';
		}

		if (isset($this->request->post['agree'])) {
			$data['agree'] = $this->request->post['agree'];
		} else {
			$data['agree'] = false;
		}
		
		$this->load->model('catalog/information');
		
		$information_info = $this->model_catalog_information->getInformation(5);
		
		$data['text_agree'] = sprintf($this->language->get('text_agree'), $information_info['title']);
		
		$data['title_agree'] = $information_info['title'];
		$data['description_agree'] = html_entity_decode($information_info['description']);
		
		$data['language_selector'] = $this->load->controller('common/language');

		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('account/register', $data));
	}

	private function validate() {
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
			$this->error['warning'] = $this->language->get('error_warning');
		} else {
			$this->load->model('localisation/currency');
			
			if (!$this->model_localisation_currency->getCurrencyByCode($this->request->post['currency'])) {
				$this->error['warning'] = $this->language->get('error_warning');
			}
		}
		
		if (empty($this->request->post['language_id'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		} else {
			$this->load->model('localisation/language');
			
			if (!$this->model_localisation_language->getLanguage($this->request->post['language_id'])) {
				$this->error['warning'] = $this->language->get('error_warning');
			}
		}
		
		if (empty($this->request->post['agree'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}
		
		return !$this->error;
	}
}