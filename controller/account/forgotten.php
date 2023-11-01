<?php
namespace Opencart\Catalog\Controller\Account;
class Forgotten extends \Opencart\System\Engine\Controller {
	private $error = array();

	public function index() {
		$this->load->model('user/user');
		
		$this->load->language('account/forgotten');

		$this->document->setTitle($this->language->get('heading_title'));
		
		if ($this->user->isLogged() && isset($this->request->get['user_token']) && ($this->request->get['user_token'] == $this->session->data['user_token'])) {
			$this->response->redirect($this->url->link('catalog/product', '', true));
		} else {
			$this->user->logout();
		}

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$token = oc_token(40);
			
			$this->model_user_user->editCode($this->request->post['email'], $token);

			$store_name = html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8');
			
			$subject_email = $this->request->post['email'];

			$subject = sprintf($this->language->get('text_subject'), $store_name);

			$data['text_greeting'] = sprintf($this->language->get('text_greeting'), $store_name);

			$data['reset'] = $this->url->link('account/reset', '&code=' . $token, true);
			$data['ip'] = $this->request->server['REMOTE_ADDR'];

			$data['store'] = $store_name;
			$data['store_url'] = $this->config->get('config_url');

			if ($this->config->get('config_mail_engine')) {
				$mail_option = [
					'parameter'     => $this->config->get('config_mail_parameter'),
					'smtp_hostname' => $this->config->get('config_mail_smtp_hostname'),
					'smtp_username' => $this->config->get('config_mail_smtp_username'),
					'smtp_password' => html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8'),
					'smtp_port'     => $this->config->get('config_mail_smtp_port'),
					'smtp_timeout'  => $this->config->get('config_mail_smtp_timeout')
				];

				$mail = new \Opencart\System\Library\Mail($this->config->get('config_mail_engine'), $mail_option);
				$mail->setTo($this->request->post['email']);
				$mail->setFrom($this->config->get('config_mail_from'));
				$mail->setSender($store_name);
				$mail->setSubject($subject);
				$mail->setHtml($this->load->view('mail/forgotten', $data));
				$mail->send();
			}
			
			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('account/login', '', true));
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['action'] = $this->url->link('account/forgotten', '', true);

		$data['cancel'] = $this->url->link('account/login', '', true);

		if (isset($this->request->post['email'])) {
			$data['email'] = $this->request->post['email'];
		} else {
			$data['email'] = '';
		}
		
		$data['language_selector'] = $this->load->controller('common/language');
		
		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('account/forgotten', $data));
	}

	protected function validate() {
		if (empty($this->request->post['email']) || (oc_strlen($this->request->post['email']) > 96) || !filter_var($this->request->post['email'], FILTER_VALIDATE_EMAIL)) {
			$this->error['warning'] = $this->language->get('error_email');
		} elseif (!$this->model_user_user->getTotalUsersByEmail($this->request->post['email'])) {
			$this->error['warning'] = $this->language->get('error_email');
		}

		return !$this->error;
	}
}
