<?php
namespace Opencart\Catalog\Controller\Integration\Onlineshop;
class Pieseauto extends \Opencart\System\Engine\Controller {
	private $error = array();
	
	public function index() {
		$this->load->language('integration/pieseauto');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('integration/onlineshop/pieseauto');
		
		if ($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validateForm()) {
			$this->request->post['transport_price_fixed'] = $this->currency->convert((float) $this->request->post['transport_price_fixed'], $this->user->get('currency'), '0');
			
			if (is_array($this->request->post['transport_price_by_weight'])) {
				foreach ($this->request->post['transport_price_by_weight'] as $key => $price) {
					$this->request->post['transport_price_by_weight'][$key]['price'] = $this->currency->convert((float) $price['price'], $this->user->get('currency'), '0');
				}
			}

			$this->model_integration_onlineshop_pieseauto->editStorage($this->user->getId(), $this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$connected = $this->model_integration_onlineshop_pieseauto->connect($this->user->getId(), true);
			
			if (!$connected and isset($this->session->data['pieseauto']['error'])) {
				$this->error['warning'] = $this->session->data['pieseauto']['error'];
				unset($this->session->data['pieseauto']['error']);
			}
		}
		
		$this->getForm();
	}
	
	protected function getForm() {
		$storage = $this->model_integration_onlineshop_pieseauto->getStorage($this->user->getId());

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
		
		if (isset($this->request->post['secret'])) {
			$data['secret'] = $this->request->post['secret'];
		} elseif (isset($storage['secret'])) {
			$data['secret'] = $storage['secret'];
		} else {
			$data['secret'] = rand(10000000000, 99999999999);
		}
		
		if (isset($this->request->post['auth_code'])) {
			$data['auth_code'] = $this->request->post['auth_code'];
		} elseif (isset($storage['auth_code'])) {
			$data['auth_code'] = $storage['auth_code'];
		} else {
			$data['auth_code'] = '';
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
				$storage['transport_price_by_weight'][$key]['price'] = round($this->currency->convert($price['price'], '0', $this->user->get('currency')), 2);
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
		
		$data['url'] = $this->url->link('api/pieseauto', '&u=' . $this->user->getId() . '&s=' . $data['secret'], true);
		
		$data['currency'] = array(
			'symbol_left' => $this->currency->getSymbolLeft($this->user->get('currency')),
			'symbol_right' => $this->currency->getSymbolRight($this->user->get('currency')),
		);
		
		$data['action'] = $this->url->link('integration/onlineshop/pieseauto', 'user_token=' . $this->session->data['user_token'], true);
		
		$this->document->addScript('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js', 'footer');
		$this->document->addStyle('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css', 'stylesheet', 'screen', 'footer');
		
		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['navigation'] = $this->load->controller('common/navigation');
		
		$this->response->setOutput($this->load->view('integration/pieseauto', $data));
	}
	
	
	protected function validateForm() {
		if (!isset($this->request->post['secret'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}
		
		if (isset($this->request->post['transport_price_by_weight'])) {
			foreach ($this->request->post['transport_price_by_weight'] as $price) {
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
	
}
