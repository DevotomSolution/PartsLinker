<?php
namespace Opencart\Catalog\Controller\Startup;
class SeoUrl extends \Opencart\System\Engine\Controller {
	public function index(): void {
		$this->url->addRewrite($this);

		if (isset($this->request->get['_route_'])) {
			switch ($this->request->get['_route_']) {
				case 'integration':
					$route = 'integration/integration';
					break;
				default:
					$route = $this->request->get['_route_'];
			}
			
			$this->request->get['route'] = $route;
		}
	}

	public function rewrite(string $link): string {
		$url_info = parse_url(str_replace('&amp;', '&', $link));
		
		$url = '';

		$get = array();

		parse_str($url_info['query'], $get);

		if (isset($get['route'])) {
			switch ($get['route']) {
				case 'integration/integration':
					$route = 'integration';
					break;
				default:
					$route = $get['route'];
			}
			
			$url .= '/' . $route;
			
			unset($get['route']);
		}

		if ($url) {
			unset($get['route']);

			$query = '';

			if ($get) {
				foreach ($get as $key => $value) {
					$query .= '&' . rawurlencode((string)$key) . '=' . rawurlencode((is_array($value) ? http_build_query($value) : (string)$value));
				}

				if ($query) {
					$query = '?' . str_replace('&', '&amp;', trim($query, '&'));
				}
			}

			return $url_info['scheme'] . '://' . $url_info['host'] . (isset($url_info['port']) ? ':' . $url_info['port'] : '') . str_replace('/index.php', '', $url_info['path']) . $url . $query;
		} else {
			return $link;
		}
	}
}