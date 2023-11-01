<?php
namespace Opencart\Catalog\Controller\Integration\Onlineshop;
class Autovit extends \Opencart\System\Engine\Controller {
	private $error = array();
	
	public function index() {
		$this->load->model('integration/onlineshop/autovit');
		
		$this->load->language('integration/onlineshop');
		$this->load->language('integration/autovit');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$connected = $this->model_integration_onlineshop_autovit->connect($this->user->getId());
		
		if (!$connected) {
			$this->session->data['error'] = $this->language->get('error_warning');
			$this->response->redirect($this->url->link('integration/onlineshop/autovit.authorization', 'user_token=' . $this->session->data['user_token'], true));
		}
		
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
		
		$this->load->model('catalog/product');
		
		$filter_data = array(
			'filter_onlineshop' => 'autovit',
		);
		
		$data['total'] = $this->model_catalog_product->getTotalProducts($this->user->getId(), $filter_data);
		
		$data['user_token'] = $this->session->data['user_token'];
		
		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['navigation'] = $this->load->controller('common/navigation');
		
		$data['url_authorization'] = $this->url->link('integration/onlineshop/autovit.authorization', 'user_token=' . $this->session->data['user_token'], true);
		$data['url_setting'] = $this->url->link('integration/onlineshop/autovit.setting', 'user_token=' . $this->session->data['user_token'], true);
		
		$this->response->setOutput($this->load->view('integration/autovit_index', $data));
	}
	
	//authorization
	public function authorization() {
		$this->load->model('integration/onlineshop/autovit');
		
		$this->load->language('integration/autovit');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$storage = $this->model_integration_onlineshop_autovit->getStorage($this->user->getId());
		
		if ($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validateAuthorizationForm()) {
			$this->model_integration_onlineshop_autovit->editStorage($this->user->getId(), $this->request->post);
			
			$connected = $this->model_integration_onlineshop_autovit->connect($this->user->getId(), true);
			
			if ($connected) {
				$this->session->data['success'] = $this->language->get('text_success');
				$this->response->redirect($this->url->link('integration/onlineshop/autovit.setting', 'user_token=' . $this->session->data['user_token'], true));
			} else {
				$this->session->data['error'] = $this->language->get('error_warning');
			}
		}
		
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

		if (isset($this->request->post['client_id'])) {
			$data['client_id'] = $this->request->post['client_id'];
		} elseif (isset($storage['client_id'])) {
			$data['client_id'] = $storage['client_id'];
		} else {
			$data['client_id'] = '';
		}
		
		if (isset($this->request->post['client_secret'])) {
			$data['client_secret'] = $this->request->post['client_secret'];
		} elseif (isset($storage['client_secret'])) {
			$data['client_secret'] = $storage['client_secret'];
		} else {
			$data['client_secret'] = '';
		}
		
		if (isset($this->request->post['grant_type'])) {
			$data['grant_type'] = $this->request->post['grant_type'];
		} elseif (isset($storage['grant_type'])) {
			$data['grant_type'] = $storage['grant_type'];
		} else {
			$data['grant_type'] = 'password';
		}
		
		if (isset($this->request->post['email'])) {
			$data['email'] = $this->request->post['email'];
		} elseif (isset($storage['email'])) {
			$data['email'] = $storage['email'];
		} else {
			$data['email'] = '';
		}
		
		if (isset($this->request->post['password'])) {
			$data['password'] = $this->request->post['password'];
		} elseif (isset($storage['password'])) {
			$data['password'] = $storage['password'];
		} else {
			$data['password'] = '';
		}
		
		if (isset($this->request->post['partner_code'])) {
			$data['partner_code'] = $this->request->post['partner_code'];
		} elseif (isset($storage['partner_code'])) {
			$data['partner_code'] = $storage['partner_code'];
		} else {
			$data['partner_code'] = '';
		}
		
		if (isset($this->request->post['partner_secret'])) {
			$data['partner_secret'] = $this->request->post['partner_secret'];
		} elseif (isset($storage['partner_secret'])) {
			$data['partner_secret'] = $storage['partner_secret'];
		} else {
			$data['partner_secret'] = '';
		}

		$data['url_authorization'] = $this->url->link('integration/onlineshop/autovit.authorization', 'user_token=' . $this->session->data['user_token'], true);
		$data['url_setting'] = $this->url->link('integration/onlineshop/autovit.setting', 'user_token=' . $this->session->data['user_token'], true);
		$data['url_home'] = $this->url->link('integration/onlineshop/autovit', 'user_token=' . $this->session->data['user_token'], true);
		
		$data['user_token'] = $this->session->data['user_token'];
		
		$this->document->addScript('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js', 'footer');
		$this->document->addStyle('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css', 'stylesheet', 'screen', 'footer');
		
		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['navigation'] = $this->load->controller('common/navigation');
		
		$this->response->setOutput($this->load->view('integration/autovit_authorization', $data));
	}
	
	//setting
	public function setting() {
		$this->load->model('integration/onlineshop/autovit');
		
		$this->load->language('integration/autovit');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$connected = $this->model_integration_onlineshop_autovit->connect($this->user->getId());
		
		if (!$connected) {
			$this->session->data['error'] = $this->language->get('error_warning');
			$this->response->redirect($this->url->link('integration/onlineshop/autovit/authorization', 'user_token=' . $this->session->data['user_token'], true));
		}
		
		$storage = $this->model_integration_onlineshop_autovit->getStorage($this->user->getId());
		
		if ($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validateSettingForm()) {
			$storage['transport_price_fixed'] = $this->currency->convert((float) $this->request->post['transport_price_fixed'], $this->user->get('currency'), '0');
			
			$storage['transport_price_by_weight'] = array();
			
			foreach($this->request->post['transport_price_by_weight'] as $key => $price) {
				$price['price'] = $this->currency->convert((float) $price['price'], $this->user->get('currency'), '0');
				
				$storage['transport_price_by_weight'][$key] = $price;
			}
			
			$storage['price_percent'] = $this->request->post['price_percent'];

			$this->model_integration_onlineshop_autovit->editStorage($this->user->getId(), $storage);
			
			$this->response->redirect($this->url->link('integration/onlineshop/autovit', 'user_token=' . $this->session->data['user_token'], true));
		}
		
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
		
		if (isset($this->request->post['price_percent'])) {
			$data['price_percent'] = $this->request->post['price_percent'];
		} elseif (isset($storage['price_percent'])) {
			$data['price_percent'] = $storage['price_percent'];
		} else {
			$data['price_percent'] = 0;
		}
		
		if (isset($this->request->post['transport_price_fixed'])) {
			$data['transport_price_fixed'] = $this->request->post['transport_price_fixed'];
		} elseif (isset($storage['transport_price_fixed'])) {
			$data['transport_price_fixed'] = round($this->currency->convert($storage['transport_price_fixed'], '0', $this->user->get('currency')), 2);
		} else {
			$data['transport_price_fixed'] = 0;
		}
		
		if (isset($this->request->post['transport_price_by_weight'])) {
			$data['transport_price_by_weight'] = $this->request->post['transport_price_by_weight'];
		} elseif (isset($storage['transport_price_by_weight'])) {
			foreach ($storage['transport_price_by_weight'] as $key => $price) {
				$price['price'] = round($this->currency->convert($price['price'], '0', $this->user->get('currency')), 2);
				$data['transport_price_by_weight'][$key] = $price;
			}
		} else {
			$data['transport_price_by_weight'] = false;
		}
		
		if(isset($this->request->post['general_description'])) {
			$data['general_description'] = $this->request->post['general_description'];
		} elseif(isset($storage['general_description'])) {
			$data['general_description'] = $storage['general_description'];
		} else {
			$data['general_description'] = '';
		}
		
		$data['currency'] = array(
			'symbol_left' => $this->currency->getSymbolLeft($this->user->get('currency')),
			'symbol_right' => $this->currency->getSymbolRight($this->user->get('currency')),
		);
		
		$data['url_authorization'] = $this->url->link('integration/onlineshop/autovit.authorization', 'user_token=' . $this->session->data['user_token'], true);
		$data['url_setting'] = $this->url->link('integration/onlineshop/autovit.setting', 'user_token=' . $this->session->data['user_token'], true);
		$data['url_home'] = $this->url->link('integration/onlineshop/autovit', 'user_token=' . $this->session->data['user_token'], true);
		
		$data['user_token'] = $this->session->data['user_token'];
		
		$this->document->addScript('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js', 'footer');
		$this->document->addStyle('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css', 'stylesheet', 'screen', 'footer');
		
		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['navigation'] = $this->load->controller('common/navigation');
		
		$this->response->setOutput($this->load->view('integration/autovit_setting', $data));
	}
	
	protected function validateAuthorizationForm() {
		if (empty($this->request->post['client_id'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}
		
		if (empty($this->request->post['client_secret'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}
		
		if (empty($this->request->post['email'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}
		
		if (empty($this->request->post['grant_type']) or ($this->request->post['grant_type'] !== 'password' and $this->request->post['grant_type'] !== 'partner')) {
			$this->error['warning'] = $this->language->get('error_warning');
		} else {
			if ($this->request->post['grant_type'] === 'password' and empty($this->request->post['password'])) {
				$this->error['warning'] = $this->language->get('error_warning');
			}
			
			if ($this->request->post['grant_type'] === 'partner' and (empty($this->request->post['partner_code']) or empty($this->request->post['partner_secret']))) {
				$this->error['warning'] = $this->language->get('error_warning');
			}
		}

		return !$this->error;
	}
	
	protected function validateSettingForm() {
		if (!isset($this->request->post['price_percent'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}
		
		if (!isset($this->request->post['transport_price_fixed'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}
		
		if (isset($this->request->post['transport_price_by_weight'])) {
			foreach($this->request->post['transport_price_by_weight'] as $price) {
				if (!isset($price['weight_from']) or !isset($price['weight_to']) or !isset($price['price'])) {
					$this->error['warning'] = $this->language->get('error_warning');
				}
			}
		}
		
		$allowed_tags = array('<p', '</p>', '<ul', '</ul>', '<li', '</li>', '<br', '<b', '</b>', '<i', '</i>', '<span', '</span>', '<div', '</div>');
		
		if (preg_match('/\<(.*?)\>/', str_replace($allowed_tags, '', html_entity_decode($this->request->post['general_description'])))) {
			$this->error['warning'] = $this->language->get('error_tags');
		}

		return !$this->error;
	}
	
	public function uploadProducts() {
		$json = array();
		
		$this->load->model('integration/onlineshop/autovit');
		
		if (isset($this->request->get['start'])) {
			$start = (int) $this->request->get['start'];
		} else {
			$start = false;
		}
		
		$this->load->model('catalog/product');
		
		$products = array();

		if ($start !== false) {
			$filter_data = array(
				'start' => (int) $start,
				'limit' => 20,
				'filter_onlineshop' => 'autovit',
			);
			
			$products = $this->model_catalog_product->getProducts($this->user->getId(), $filter_data, 3);
		}
		
		foreach($products as $product) {
			$json[$product['sku']] = $this->model_integration_onlineshop_autovit->syncProduct($this->user->getId(), $product['sku'], $product);
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
