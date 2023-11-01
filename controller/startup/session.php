<?php
namespace Opencart\Catalog\Controller\Startup;
class Session extends \Opencart\System\Engine\Controller {
	public function index(): void {
		$session = new \Opencart\System\Library\Session($this->config->get('session_engine'), $this->registry);
		$this->registry->set('session', $session);
		
		if (isset($this->request->get['route']) && substr((string) $this->request->get['route'], 0, 4) == 'api/') {
			$this->load->model('user/api');

			$this->model_user_api->cleanSessions();
			
			if (!empty($this->request->get['user_token'])) {
				// Make sure the IP is allowed
				$api_info = $this->model_user_api->getApiByToken($this->request->get['user_token']);

				if ($api_info) {
					$this->session->start($this->request->get['user_token']);

					$this->model_user_api->updateSession($api_info['api_session_id']);
				} else {
					$this->session->start();
				}
			} else {
				$this->session->start();
			}

			return;
		}

		// Update the session lifetime
		if ($this->config->get('config_session_expire')) {
			$this->config->set('session_expire', $this->config->get('config_session_expire'));
		}

		if (isset($this->request->cookie[$this->config->get('session_name')])) {
			$session_id = $this->request->cookie[$this->config->get('session_name')];
		} else {
			$session_id = '';
		}

		$session->start($session_id);

		$option = [
			'expires'  => time() + (int)$this->config->get('config_session_expire'),
			'path'     => $this->config->get('session_path'),
			'secure'   => $this->request->server['HTTPS'],
			'httponly' => false,
			'SameSite' => $this->config->get('config_session_samesite')
		];

		$this->response->addHeader('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');

		setcookie($this->config->get('session_name'), $session->getId(), $option);
	}
}