<?php
namespace Opencart\Catalog\Controller\Event;
class Theme extends \Opencart\System\Engine\Controller {
	public function index(string &$route, array &$args, string &$code): void {
		$args['server'] = HTTP_SERVER;
	}
}
