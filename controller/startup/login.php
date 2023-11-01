<?php
namespace Opencart\Catalog\Controller\Startup;
class Login extends \Opencart\System\Engine\Controller {
	public function index(): object|null {
		if (isset($this->request->get['route'])) {
			$route = (string)$this->request->get['route'];
		} else {
			$route = '';
		}
		
		$full_route = $route;
		
		// Remove any method call for checking ignore pages.
		$pos = strrpos($route, '.');

		if ($pos !== false) {
			$route = substr($route, 0, $pos);
		}
		
		// User
		$this->registry->set('user', new \Opencart\System\Library\Cart\User($this->registry));
		
		// Language
		if ($this->user->isLogged()) {
			$language_id = $this->user->get('language_id');
		} elseif (isset($this->request->cookie['language_id'])) {
			$language_id = (int) $this->request->cookie['language_id'];
		} else {
			$language_id = 1;
		}

		$this->load->model('localisation/language');

		$language_info = $this->model_localisation_language->getLanguage($language_id);

		// Set the config language_id key
		$this->config->set('config_language_id', $language_info['language_id']);
		$this->config->set('config_language_code', $language_info['code']);
		
		$language = new \Opencart\System\Library\Language($language_info['code']);
		$this->registry->set('language', $language);
		$this->language->addPath(DIR_LANGUAGE);

		$this->language->load('default');
		
		if (substr($route, 0, 4) == 'api/') {
			return null;
		}

		$ignore = array(
			'account/login',
			'account/forgotten',
			'account/reset',
			'account/register',
			'common/language.setLanguage',
			'integration/onlineshop/ebayit.authorize',
		);

		if (!$this->user->isLogged() && !in_array($route, $ignore) && !in_array($full_route, $ignore)) {
			return new \Opencart\System\Engine\Action('account/login');
		}

		$ignore = array(
			'account/login',
			'account/logout',
			'account/forgotten',
			'account/reset',
			'account/register',
			'common/language.setLanguage',
			'error/not_found',
			'integration/onlineshop/ebayit.authorize',
		);

		if (!in_array($route, $ignore) && !in_array($full_route, $ignore) && (!isset($this->request->get['user_token']) || !isset($this->session->data['user_token']) || ($this->request->get['user_token'] != $this->session->data['user_token']))) {
			return new \Opencart\System\Engine\Action('account/login');
		}
		
		return null;
	}
}
