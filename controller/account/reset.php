<?php
namespace Opencart\Catalog\Controller\Account;
class Reset extends \Opencart\System\Engine\Controller {
	private $error = array();

	public function index() {
		if ($this->user->isLogged() && isset($this->request->get['user_token']) && ($this->request->get['user_token'] == $this->session->data['user_token'])) {
			$this->response->redirect($this->url->link('catalog/product', '', true));
		} else {
			$this->user->logout();
		}

		if (isset($this->request->get['code'])) {
			$code = $this->request->get['code'];
		} else {
			$code = '';
		}
		
		$this->load->language('account/reset');
		
		$this->load->model('user/user');

		$user_info = $this->model_user_user->getUserByCode($code);
		
		if(!$user_info) {
			$this->session->data['error'] = $this->language->get('error_code');
			$this->response->redirect($this->url->link('account/login', '', true));
		}

		$this->document->setTitle($this->language->get('heading_title'));

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_user_user->editPassword($user_info['user_id'], $this->request->post['password']);

			$this->model_user_user->deleteLoginAttempts($user_info['email']);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('account/login', '', true));
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		}

		$data['action'] = $this->url->link('account/reset', 'code=' . $code, true);

		$data['cancel'] = $this->url->link('account/login', '', true);

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
		
		$data['text_password'] = sprintf($this->language->get('text_password'), $user_info['login']);
		
		$data['language_selector'] = $this->load->controller('common/language');

		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('account/reset', $data));
	}

	protected function validate() {
		if (empty($this->request->post['password']) || (oc_strlen(html_entity_decode($this->request->post['password'], ENT_QUOTES, 'UTF-8')) < 4) || (oc_strlen(html_entity_decode($this->request->post['password'], ENT_QUOTES, 'UTF-8')) > 40)) {
			$this->error['warning'] = $this->language->get('error_password');
		}

		if (empty($this->request->post['password']) || empty($this->request->post['confirm']) || $this->request->post['confirm'] !== $this->request->post['password']) {
			$this->error['warning'] = $this->language->get('error_confirm');
		}

		return !$this->error;
	}
}