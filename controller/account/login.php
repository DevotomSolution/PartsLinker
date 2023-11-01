<?php
namespace Opencart\Catalog\Controller\Account;
class Login extends \Opencart\System\Engine\Controller {
	private $error = array();

	public function index() {
		$this->load->language('account/login');

		$this->document->setTitle($this->language->get('heading_title'));

		if ($this->user->isLogged() && isset($this->request->get['user_token']) && ($this->request->get['user_token'] == $this->session->data['user_token'])) {
			$this->response->redirect($this->url->link('catalog/product', 'user_token=' . $this->session->data['user_token'], true));
		}
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->session->data['user_token'] = oc_token(32);

			if (isset($this->request->post['redirect']) && (strpos($this->request->post['redirect'], HTTP_SERVER) === 0 || strpos($this->request->post['redirect'], HTTP_SERVER) === 0)) {
				$this->response->redirect($this->request->post['redirect'] . '&user_token=' . $this->session->data['user_token']);
			} else {
				$this->response->redirect($this->url->link('catalog/product', 'user_token=' . $this->session->data['user_token'], true));
			}
		}

		/*if ((isset($this->session->data['user_token']) && !isset($this->request->get['user_token'])) || ((isset($this->request->get['user_token']) && (isset($this->session->data['user_token']) && ($this->request->get['user_token'] != $this->session->data['user_token']))))) {
			$this->error['warning'] = $this->language->get('error_token');
		}*/
		
		if (isset($this->session->data['error'])) {
			$data['error_warning'] = $this->session->data['error'];

			unset($this->session->data['error']);
		} elseif (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		$data['action'] = $this->url->link('account/login', '', true);

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

		if (isset($this->request->get['_route_'])) {
			$route = $this->request->get['_route_'];

			unset($this->request->get['_route_']);
			unset($this->request->get['user_token']);

			$url = '';

			if ($this->request->get) {
				$url .= http_build_query($this->request->get);
			}

			$data['redirect'] = $this->url->link($route, $url, true);
		} else {
			$data['redirect'] = '';
		}
		
		$data['register'] = $this->url->link('account/register', '', true);
		$data['forgotten'] = $this->url->link('account/forgotten', '', true);
		
		$data['language_selector'] = $this->load->controller('common/language');

		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('account/login', $data));
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

				unset($this->session->data['user_token']);
			} else {
				$this->model_user_user->deleteLoginAttempts($this->request->post['email']);
			}
		}

		return !$this->error;
	}
}
