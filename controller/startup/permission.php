<?php
namespace Opencart\Catalog\Controller\Startup;
class Permission extends \Opencart\System\Engine\Controller {
	public function index(): object|null {
		if (isset($this->request->get['route'])) {
			$pos = strrpos($this->request->get['route'], '.');

			if ($pos !== false) {
				$route = substr($this->request->get['route'], 0, $pos);
			} else {
				$route = $this->request->get['route'];
			}

			$part = explode('/', $route);
			
			$route = '';

			if (isset($part[0])) {
				$route .= $part[0];
			}

			if (isset($part[1])) {
				$route .= '/' . $part[1];
			}
			
			if (substr($route, 0, 4) == 'api/') {
				return null;
			}

			// We want to ignore some pages from having its permission checked.
			$ignore = array(
				'account/login',
				'account/register',
				'account/logout',
				'account/forgotten',
				'account/reset',
				'account/setting',
				'error/not_found',
				'error/permission',
				'info/label',
				'tool/translate',
				'common/language',
				'common/presentation',
				'catalog/cart',
				'catalog/product',
				'catalog/warehouse',
				'catalog/vehicle4parts',
				'catalog/category',
				'catalog/vehicle_brand',
				'catalog/import_export',
				'sale/order',
				'integration/integration',
				'integration/delivery',
				'integration/onlineshop',
			);

			if (!in_array($route, $ignore) && !$this->user->hasPermission('access', $route)) {
				return new \Opencart\System\Engine\Action('error/permission');
			}
		}

		return null;
	}
}
