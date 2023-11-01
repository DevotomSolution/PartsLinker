<?php
namespace Opencart\Catalog\Controller\Startup;
class Api extends \Opencart\System\Engine\Controller {
	public function index(): object|null {
		if (isset($this->request->get['route'])) {
			$pos = strrpos($this->request->get['route'], '.');

			if ($pos === false) {
				$route = $this->request->get['route'];
			} else {
				$route = substr($this->request->get['route'], 0, $pos);
			}
		} else {
			$route = '';
		}
		
		if (substr($route, 0, 4) !== 'api/') {
			return null;
		}
		
		$ignore = array(
			'api/login',
			'api/register',
			'api/pieseauto',
			'api/carmod',
		);
		
		if (substr($route, 0, 4) == 'api/' && !in_array($route, $ignore) && !isset($this->session->data['api_id'])) {
			return new \Opencart\System\Engine\Action('api/error/session');
		}
		
		// We want to ignore some pages from having its permission checked.
		$ignore = array(
			'api/pieseauto',
			'api/carmod',
			'api/login',
			'api/warehouse',
			'api/languages',
			'api/register',
			'api/vehicle',
			'api/product',
		);

		if (substr($route, 0, 4) == 'api/' && !in_array($route, $ignore) && !$this->user->hasPermission('access', $route)) {
			return new \Opencart\System\Engine\Action('api/error/permission');
		}
		
		return null;
	}
}
