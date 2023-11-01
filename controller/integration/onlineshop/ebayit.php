<?php
namespace Opencart\Catalog\Controller\Integration\Onlineshop;
class Ebayit extends \Opencart\System\Engine\Controller {
	private $error = array();
	
	public function index() {
		$this->load->model('integration/onlineshop/ebayit');
		
		$this->load->language('integration/ebay');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		if (!$this->model_integration_onlineshop_ebayit->connect($this->user->getId())) {
			$this->session->data['error'] = $this->language->get('error_connect');
			$this->response->redirect($this->url->link('integration/onlineshop/ebayit.authorize', 'user_token=' . $this->session->data['user_token'], true));
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
			'filter_onlineshop' => 'ebayit',
		);
		
		$data['total'] = $this->model_catalog_product->getTotalProducts($this->user->getId(), $filter_data);
		
		$data['user_token'] = $this->session->data['user_token'];
		
		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['navigation'] = $this->load->controller('common/navigation');
		
		$data['authorize'] = $this->url->link('integration/onlineshop/ebayit.authorize', 'user_token=' . $this->session->data['user_token'], true);
		$data['setting'] = $this->url->link('integration/onlineshop/ebayit.setting', 'user_token=' . $this->session->data['user_token'], true);
		
		$this->response->setOutput($this->load->view('integration/ebay_index', $data));
	}
	
	//setting
	public function setting() {
		$this->load->model('integration/onlineshop/ebayit');
		
		$this->load->language('integration/ebay');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		if (!$this->model_integration_onlineshop_ebayit->connect($this->user->getId())) {
			$this->session->data['error'] = $this->language->get('error_connect');
			$this->response->redirect($this->url->link('integration/onlineshop/ebayit.authorize', 'user_token=' . $this->session->data['user_token'], true));
		}
		
		$storage = $this->model_integration_onlineshop_ebayit->getStorage($this->user->getId());
		
		if ($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validateSettingForm()) {
			$storage['filter_max_price'] = $this->currency->convert((float) $this->request->post['filter_max_price'], $this->user->get('currency'), '0');
			$storage['filter_min_price'] = $this->currency->convert((float) $this->request->post['filter_min_price'], $this->user->get('currency'), '0');
			
			$storage['transport_price_fixed'] = $this->currency->convert((float) $this->request->post['transport_price_fixed'], $this->user->get('currency'), '0');
			
			$storage['transport_price_by_weight'] = array();
			
			if (isset($this->request->post['transport_price_by_weight'])) {
				foreach($this->request->post['transport_price_by_weight'] as $key => $price) {
					$price['price'] = $this->currency->convert((float) $price['price'], $this->user->get('currency'), '0');
					
					$storage['transport_price_by_weight'][$key] = $price;
				}
			}
			
			$storage['price_percent'] = $this->request->post['price_percent'];
			
			$storage['fulfillment_policy_id'] = $this->request->post['fulfillment_policy_id'];
			$storage['payment_policy_id'] = $this->request->post['payment_policy_id'];
			$storage['return_policy_id'] = $this->request->post['return_policy_id'];
			$storage['location_key'] = $this->request->post['location_key'];
			
			$storage['max_quantity_value'] = (int) $this->request->post['max_quantity_value'];

			$storage['general_description'] = $this->request->post['general_description'];

			$this->model_integration_onlineshop_ebayit->editStorage($this->user->getId(), $storage);
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->response->redirect($this->url->link('integration/onlineshop/ebayit', 'user_token=' . $this->session->data['user_token'], true));
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
		
		
		$fulfillment_policies = $this->model_integration_onlineshop_ebayit->getFulfillmentPolicies();
		
		if ($fulfillment_policies['success'] && count($fulfillment_policies['policies'])) {
			$data['fulfillment_policies'] = $fulfillment_policies['policies'];
		} else {
			$data['fulfillment_policies'] = array();
		}
		
		
		$payment_policies = $this->model_integration_onlineshop_ebayit->getPaymentPolicies();
		
		if ($payment_policies['success'] && count($payment_policies['policies'])) {
			$data['payment_policies'] = $payment_policies['policies'];
		} else {
			$data['payment_policies'] = array();
		}
		
		
		$return_policies = $this->model_integration_onlineshop_ebayit->getReturnPolicies();
		
		if ($return_policies['success'] && count($return_policies['policies'])) {
			$data['return_policies'] = $return_policies['policies'];
		}
		
		
		$locations = $this->model_integration_onlineshop_ebayit->getInventoryLocations();

		if ($locations['success'] && count($locations['locations'])) {
			$data['locations'] = $locations['locations'];
		}
		
		
		if (isset($this->request->post['fulfillment_policy_id'])) {
			$data['fulfillment_policy_id'] = $this->request->post['fulfillment_policy_id'];
		} elseif (isset($storage['fulfillment_policy_id'])) {
			$data['fulfillment_policy_id'] = $storage['fulfillment_policy_id'];
		} else {
			$data['fulfillment_policy_id'] = '';
		}
		
		if (isset($this->request->post['payment_policy_id'])) {
			$data['payment_policy_id'] = $this->request->post['payment_policy_id'];
		} elseif (isset($storage['payment_policy_id'])) {
			$data['payment_policy_id'] = $storage['payment_policy_id'];
		} else {
			$data['payment_policy_id'] = '';
		}
		
		if (isset($this->request->post['return_policy_id'])) {
			$data['return_policy_id'] = $this->request->post['return_policy_id'];
		} elseif (isset($storage['return_policy_id'])) {
			$data['return_policy_id'] = $storage['return_policy_id'];
		} else {
			$data['return_policy_id'] = '';
		}
		
		if (isset($this->request->post['location_key'])) {
			$data['location_key'] = $this->request->post['location_key'];
		} elseif (isset($storage['location_key'])) {
			$data['location_key'] = $storage['location_key'];
		} else {
			$data['location_key'] = '';
		}
		
		if (isset($this->request->post['max_quantity_value'])) {
			$data['max_quantity_value'] = $this->request->post['max_quantity_value'];
		} elseif (isset($storage['max_quantity_value'])) {
			$data['max_quantity_value'] = $storage['max_quantity_value'];
		} else {
			$data['max_quantity_value'] = 0;
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
		
		$this->load->model('catalog/product');
		
		$data['max_price'] = (int) $this->model_catalog_product->getProductMaxPrice($this->user->getId()) + 1;
		
		if(isset($this->request->post['filter_min_price'])) {
			$data['filter_min_price'] = $this->request->post['filter_min_price'];
		} elseif(isset($storage['filter_min_price'])) {
			$data['filter_min_price'] = round($this->currency->convert($storage['filter_min_price'], '0', $this->user->get('currency')), 2);
		} else {
			$data['filter_min_price'] = 0;
		}
		
		if(isset($this->request->post['filter_max_price'])) {
			$data['filter_max_price'] = $this->request->post['filter_max_price'];
		} elseif(isset($storage['filter_max_price'])) {
			$data['filter_max_price'] = round($this->currency->convert($storage['filter_max_price'], '0', $this->user->get('currency')), 2);
		} else {
			$data['filter_max_price'] = $data['max_price'];
		}
		
		$data['action'] = $this->url->link('integration/onlineshop/ebayit.setting', 'user_token=' . $this->session->data['user_token'], true);
		
		$data['authorize'] = $this->url->link('integration/onlineshop/ebayit.authorize', 'user_token=' . $this->session->data['user_token'], true);
		$data['home'] = $this->url->link('integration/onlineshop/ebayit', 'user_token=' . $this->session->data['user_token'], true);
		
		$data['user_token'] = $this->session->data['user_token'];
		
		$this->document->addScript('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js', 'footer');
		$this->document->addStyle('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css', 'stylesheet', 'screen', 'footer');
		
		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['navigation'] = $this->load->controller('common/navigation');
		
		$this->response->setOutput($this->load->view('integration/ebay_setting', $data));
	}
	
	protected function validateSettingForm() {
		if (empty($this->request->post['fulfillment_policy_id'])) {
			$this->error['warning'] = $this->language->get('error_fulfillment_policy');
		}
		
		if (empty($this->request->post['payment_policy_id'])) {
			$this->error['warning'] = $this->language->get('error_payment_policy');
		}
		
		if (empty($this->request->post['return_policy_id'])) {
			$this->error['warning'] = $this->language->get('error_return_policy');
		}
		
		if (empty($this->request->post['location_key'])) {
			$this->error['warning'] = $this->language->get('error_location_key');
		}
		
		if (!isset($this->request->post['max_quantity_value'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}
		
		if (!isset($this->request->post['filter_max_price'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}
		
		if (!isset($this->request->post['filter_min_price'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}
		
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
		
		if (isset($this->request->post['general_description'])) {
			$allowed_tags = array('<p', '</p>', '<ul', '</ul>', '<li', '</li>', '<br', '<b', '</b>', '<i', '</i>', '<span', '</span>', '<div', '</div>');
		
			if (preg_match('/\<(.*?)\>/', str_replace($allowed_tags, '', html_entity_decode($this->request->post['general_description'])))) {
				$this->error['warning'] = $this->language->get('error_description_tags');
			}
		} else {
			$this->error['warning'] = $this->language->get('error_warning');
		}

		return !$this->error;
	}
	
	//authorize
	public function authorize() {
		$this->load->model('integration/onlineshop/ebay');
		$this->load->model('integration/onlineshop/ebayit');
		
		$this->load->language('integration/ebay');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$storage = $this->model_integration_onlineshop_ebayit->getStorage($this->user->getId());

		if ($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validateAuthorizeForm()) {
			$storage['app_id'] = $this->request->post['app_id'];
			$storage['cert_id'] = $this->request->post['cert_id'];
			$storage['ru_name'] = $this->request->post['ru_name'];
			$storage['sandbox'] = $this->request->post['sandbox'];
			
			/*unset($storage['access_token']);
			unset($storage['expires_in']);
			unset($storage['refresh_token']);
			unset($storage['refresh_token_expires_in']);*/
			
			$this->model_integration_onlineshop_ebayit->editStorage($this->user->getId(), $storage);
			
			$this->model_integration_onlineshop_ebayit->connect($this->user->getId(), true);
			
			$this->model_integration_onlineshop_ebay->getUserConsent($this->request->post['app_id'], $this->request->post['ru_name'], $this->request->post['sandbox']);
			die();
		}
		
		if (isset($_GET['code']) && isset($storage['app_id']) && isset($storage['cert_id']) && isset($storage['ru_name']) && isset($storage['sandbox'])) {
			$token_response = $this->model_integration_onlineshop_ebay->getTokenByCode(urldecode($_GET['code']), $storage['app_id'], $storage['cert_id'], $storage['ru_name'], $storage['sandbox']);
			
			if (isset($token_response['access_token'])) {
				$token_response['expires_in'] += time();
				$token_response['refresh_token_expires_in'] += time();
				
				$storage['access_token'] = $token_response['access_token'];
				$storage['expires_in'] = $token_response['expires_in'];
				$storage['refresh_token'] = $token_response['refresh_token'];
				$storage['refresh_token_expires_in'] = $token_response['refresh_token_expires_in'];
				
				$this->model_integration_onlineshop_ebayit->editStorage($this->user->getId(), $storage);

				if ($this->model_integration_onlineshop_ebayit->connect($this->user->getId(), true)) {
					$this->model_integration_onlineshop_ebayit->optInToProgram();
					
					$this->session->data['success'] = $this->language->get('text_success');
					
					$this->response->redirect($this->url->link('integration/onlineshop/ebayit.setting', 'user_token=' . $this->session->data['user_token'], true));
				} else {
					$this->error['warning'] = $this->language->get('error_warning');
				}
			} else {
				$this->error['warning'] = $this->language->get('error_warning');
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
		
		if (isset($this->request->post['app_id'])) {
			$data['app_id'] = $this->request->post['app_id'];
		} elseif (isset($storage['app_id'])) {
			$data['app_id'] = $storage['app_id'];
		} else {
			$data['app_id'] = '';
		}
		
		if (isset($this->request->post['cert_id'])) {
			$data['cert_id'] = $this->request->post['cert_id'];
		} elseif (isset($storage['cert_id'])) {
			$data['cert_id'] = $storage['cert_id'];
		} else {
			$data['cert_id'] = '';
		}
		
		if (isset($this->request->post['ru_name'])) {
			$data['ru_name'] = $this->request->post['ru_name'];
		} elseif (isset($storage['ru_name'])) {
			$data['ru_name'] = $storage['ru_name'];
		} else {
			$data['ru_name'] = '';
		}
		
		if (isset($this->request->post['sandbox'])) {
			$data['sandbox'] = $this->request->post['sandbox'];
		} elseif (isset($storage['sandbox'])) {
			$data['sandbox'] = $storage['sandbox'];
		} else {
			$data['sandbox'] = 0;
		}
		
		if (!isset($this->session->data['user_token'])) {
			$this->session->data['user_token'] = '';
		}
		
		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['navigation'] = $this->load->controller('common/navigation');
		
		$data['action'] = $this->url->link('integration/onlineshop/ebayit.authorize', 'user_token=' . $this->session->data['user_token'], true);
		
		$data['ru_name_url'] = $this->url->link('integration/onlineshop/ebayit.authorize', '', true);
		
		$data['setting'] = $this->url->link('integration/onlineshop/ebayit.setting', 'user_token=' . $this->session->data['user_token'], true);
		$data['home'] = $this->url->link('integration/onlineshop/ebayit', 'user_token=' . $this->session->data['user_token'], true);
		
		$this->response->setOutput($this->load->view('integration/ebay_authorize', $data));
	}
	
	private function validateAuthorizeForm() {
		if (empty($this->request->post['app_id'])) {
			$this->error['warning'] = $this->language->get('error_authorize_form');
		}
		
		if (empty($this->request->post['cert_id'])) {
			$this->error['warning'] = $this->language->get('error_authorize_form');
		}
		
		if (empty($this->request->post['ru_name'])) {
			$this->error['warning'] = $this->language->get('error_authorize_form');
		}
		
		if (!isset($this->request->post['sandbox'])) {
			$this->error['warning'] = $this->language->get('error_authorize_form');
		}

		return !$this->error;
	}
	
	public function uploadProducts() {
		$json = array();
		
		$this->load->model('integration/onlineshop/ebayit');
		
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
				'filter_onlineshop' => 'ebayit',
			);
			
			$products = $this->model_catalog_product->getProducts($this->user->getId(), $filter_data, 3);
		}
		
		foreach($products as $product) {
			$json[$product['sku']] = $this->model_integration_onlineshop_ebayit->syncProduct($this->user->getId(), $product['sku'], $product);
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
