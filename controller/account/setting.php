<?php
namespace Opencart\Catalog\Controller\Account;
class Setting extends \Opencart\System\Engine\Controller {
	private $error = array();
	
	public function index() {
		$this->load->model('user/user');
		$this->load->model('localisation/country');
		$this->load->model('localisation/zone');
		
		$this->load->language('account/setting');

		$this->document->setTitle($this->language->get('heading_title'));
		
		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}
		
		$user_data = $this->user->get('all');
		
		if (isset($this->request->post['company'])) {
			$data['company'] = $this->request->post['company'];
		} else {
			$data['company'] = $user_data['company'];
		}
		
		if (isset($this->request->post['website'])) {
			$data['website'] = $this->request->post['website'];
		} else {
			$data['website'] = $user_data['website'];
		}
		
		$this->load->model('localisation/currency');
		
		$data['currencies'] = $this->model_localisation_currency->getCurrencies();

		if (isset($this->request->post['currency'])) {
			$data['currency'] = $this->request->post['currency'];
		} else {
			$data['currency'] = $user_data['currency'];
		}
		
		$this->load->model('localisation/language');
		
		$data['languages'] = $this->model_localisation_language->getLanguages();
		
		if (isset($this->request->post['language_id'])) {
			$data['language_id'] = $this->request->post['language_id'];
		} else {
			$data['language_id'] = $user_data['language_id'];
		}
		
		if (isset($this->request->post['catalog'])) {
			$data['catalog'] = $this->request->post['catalog'];
		} else {
			$data['catalog'] = $user_data['catalog'];
		}
		
		if (isset($this->request->post['label'])) {
			$data['label'] = $this->request->post['label'];
		} else {
			$data['label'] = $user_data['label'];
		}
		
		if (isset($this->request->post['default_product_used'])) {
			$data['default_product_used'] = $this->request->post['default_product_used'];
		} else {
			$data['default_product_used'] = $user_data['default_product_used'];
		}
		
		if (isset($this->request->post['default_product_delivery'])) {
			$data['default_product_delivery'] = $this->request->post['default_product_delivery'];
		} else {
			$data['default_product_delivery'] = $user_data['default_product_delivery'];
		}
		
		$this->load->model('catalog/brand');
		
		$data['brands'] = $this->model_catalog_brand->getBrands();
		
		if (isset($this->request->post['default_brand'])) {
			$data['default_brand'] = $this->request->post['default_brand'];
		} else {
			$data['default_brand'] = $user_data['default_brand'];
		}
		
		if (isset($this->request->post['address_1'])) {
			$data['address_1'] = $this->request->post['address_1'];
		} else {
			$data['address_1'] = $user_data['address_1'];
		}
		
		if (isset($this->request->post['address_2'])) {
			$data['address_2'] = $this->request->post['address_2'];
		} else {
			$data['address_2'] = $user_data['address_2'];
		}
		
		if (isset($this->request->post['city'])) {
			$data['city'] = $this->request->post['city'];
		} else {
			$data['city'] = $user_data['city'];
		}
		
		if (isset($this->request->post['postcode'])) {
			$data['postcode'] = $this->request->post['postcode'];
		} else {
			$data['postcode'] = $user_data['postcode'];
		}
		
		$data['countries'] = $this->model_localisation_country->getCountries();
		
		if (isset($this->request->post['country_id'])) {
			$data['country_id'] = $this->request->post['country_id'];
		} else {
			$data['country_id'] = $user_data['country_id'];
		}
		
		if (isset($user_data['country_id']) && $user_data['country_id']) {
			$data['zones'] = $this->model_localisation_zone->getZonesByCountryId($user_data['country_id']);
		} else {
			$data['zones'] = array();
		}
		
		if (isset($this->request->post['zone_id'])) {
			$data['zone_id'] = $this->request->post['zone_id'];
		} else {
			$data['zone_id'] = $user_data['zone_id'];
		}
		
		if (isset($this->request->post['phone'])) {
			$data['phone'] = $this->request->post['phone'];
		} else {
			$data['phone'] = $user_data['phone'];
		}
		
		if (isset($this->request->post['vat'])) {
			$data['vat'] = $this->request->post['vat'];
		} else {
			$data['vat'] = $user_data['vat'];
		}
		
		if (isset($this->request->post['logo'])) {
			$data['logo'] = $this->request->post['logo'];
		} else {
			$data['logo'] = $user_data['logo'];
		}
		
		if (!empty($data['logo'])) {
			$data['logo_preview'] = HTTP_SERVER . DIR_IMAGE_RELATIVE . $data['logo'];
		} else {
			$data['logo_preview'] = HTTP_SERVER . DIR_IMAGE_RELATIVE . 'no_image.png';
		}
		
		$this->load->model('info/label');
		
		$data['labels'] = $this->model_info_label->getLabels();
		
		$data['user_token'] = $this->session->data['user_token'];
		
		$data['action'] = $this->url->link('account/setting', 'user_token=' . $this->session->data['user_token'], true);
		
		$data['password'] = $this->url->link('account/setting.password', 'user_token=' . $this->session->data['user_token'], true);
		$data['warehouse'] = $this->url->link('account/setting.warehouse', 'user_token=' . $this->session->data['user_token'], true);
		$data['invoice'] = $this->url->link('account/setting.invoice', 'user_token=' . $this->session->data['user_token'], true);
		
		if ($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validateForm()) {
			$zone = $this->model_localisation_zone->getZone($this->request->post['zone_id']);
			
			if (isset($zone['name'])) {
				$this->request->post['zone'] = $zone['name'];
			} else {
				$this->request->post['zone'] = '';
			}
			
			$country = $this->model_localisation_country->getCountry($this->request->post['country_id']);
			
			if (isset($country['name'])) {
				$this->request->post['country'] = $country['name'];
			} else {
				$this->request->post['country'] = '';
			}
			
			$this->model_user_user->editUser($this->user->getId(), $this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->response->redirect($this->url->link('account/setting', 'user_token=' . $this->session->data['user_token'], true));
		}
		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		$data['MAX_IMAGE_WIDTH'] = MAX_IMAGE_WIDTH;
		$data['MAX_IMAGE_HEIGHT'] = MAX_IMAGE_HEIGHT;
		
		$data['header'] = $this->load->controller('common/header');
		$data['navigation'] = $this->load->controller('common/navigation');
		$data['footer'] = $this->load->controller('common/footer');
		
		$this->response->setOutput($this->load->view('account/setting', $data));
	}
	
	protected function validateForm() {
		if (!isset($this->request->post['company']) || (oc_strlen($this->request->post['company']) > 40)) {
			$this->error['warning'] = $this->language->get('error_company');
		}
		
		if (!isset($this->request->post['vat']) || (oc_strlen($this->request->post['vat']) > 32)) {
			$this->error['warning'] = $this->language->get('error_vat');
		}
		
		if (!isset($this->request->post['website']) || (oc_strlen($this->request->post['website']) > 40)) {
			$this->error['warning'] = $this->language->get('error_website');
		}
		
		if (!empty($this->request->post['website']) and !preg_match("/^http(s)?:\\/\\/.+$/", $this->request->post['website'])) {
			$this->error['warning'] = $this->language->get('error_website');
		}
		
		if (!isset($this->request->post['currency'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		} else {
			$this->load->model('localisation/currency');
			
			if (!$this->model_localisation_currency->getCurrencyByCode($this->request->post['currency'])) {
				$this->error['warning'] = $this->language->get('error_warning');
			}
		}
		
		if (!isset($this->request->post['language_id'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		} else {
			$this->load->model('localisation/language');
			
			if (!$this->model_localisation_language->getLanguage($this->request->post['language_id'])) {
				$this->error['warning'] = $this->language->get('error_warning');
			}
		}
		
		if (!isset($this->request->post['catalog'])) {
			$this->error['warning'] = $this->language->get('error_catalog');
		} else {
			if ($this->request->post['catalog'] !== 'market' and $this->request->post['catalog'] !== 'carparts') {
				$this->error['warning'] = $this->language->get('error_warning');
			}
		}
		
		if (!isset($this->request->post['label'])) {
			$this->error['warning'] = $this->language->get('error_label');
		} else {
			$this->load->model('info/label');
			
			if (!$this->model_info_label->getLabel($this->request->post['label'])) {
				$this->error['warning'] = $this->language->get('error_warning');
			}
		}
		
		if (!isset($this->request->post['default_product_used'])) {
			$this->error['warning'] = $this->language->get('error_product_used');
		} else {
			if ($this->request->post['default_product_used'] != 0 and $this->request->post['default_product_used'] != 1) {
				$this->error['warning'] = $this->language->get('error_warning');
			}
		}
		
		if (!isset($this->request->post['default_product_delivery'])) {
			$this->error['warning'] = $this->language->get('error_product_delivery');
		} else {
			if ((int) $this->request->post['default_product_delivery'] > 99) {
				$this->error['warning'] = $this->language->get('error_product_delivery');
			}
		}
		
		if (!isset($this->request->post['default_brand']) || (oc_strlen($this->request->post['default_brand']) > 64)) {
			$this->error['warning'] = $this->language->get('error_brand');
		}
		
		if (!isset($this->request->post['address_1']) || (oc_strlen($this->request->post['address_1'])) > 128) {
			$this->error['warning'] = $this->language->get('error_address_1');
		}
		
		if (!isset($this->request->post['address_2']) || (oc_strlen($this->request->post['address_2'])) > 128) {
			$this->error['warning'] = $this->language->get('error_address_2');
		}
		
		if (!isset($this->request->post['city']) || (oc_strlen($this->request->post['city'])) > 128) {
			$this->error['warning'] = $this->language->get('error_city');
		}
		
		if (!isset($this->request->post['postcode']) || (oc_strlen($this->request->post['postcode'])) > 10) {
			$this->error['warning'] = $this->language->get('error_postcode');
		}
		
		if (!isset($this->request->post['country_id'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		} elseif(!empty($this->request->post['country_id'])) {
			$this->load->model('localisation/country');
			
			if (!$this->model_localisation_country->getCountry($this->request->post['country_id'])) {
				$this->error['warning'] = $this->language->get('error_warning');
			}
		}
		
		if (!isset($this->request->post['zone_id'])) {
			$this->error['warning'] = $this->language->get('error_zone');
		} elseif(!empty($this->request->post['zone_id'])) {
			$this->load->model('localisation/zone');
			
			if (!$this->model_localisation_zone->getZone($this->request->post['zone_id'])) {
				$this->error['warning'] = $this->language->get('error_warning');
			}
		}
		
		if (!isset($this->request->post['phone']) || (oc_strlen($this->request->post['phone'])) > 32) {
			$this->error['warning'] = $this->language->get('error_phone');
		}
		
		if(!empty($this->request->post['logo'])) {
			if (!file_exists(DIR_IMAGE . $this->request->post['logo'])) {
				$this->error['warning'] = $this->language->get('error_warning');
			}
		}

		return !$this->error;
	}
	
	public function warehouse() {
		$this->load->model('catalog/warehouse');
		
		$this->load->language('account/setting');

		$this->document->setTitle($this->language->get('heading_title'));
		
		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}
		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		$data['account'] = $this->url->link('account/setting', 'user_token=' . $this->session->data['user_token'], true);
		$data['password'] = $this->url->link('account/setting.password', 'user_token=' . $this->session->data['user_token'], true);
		$data['invoice'] = $this->url->link('account/setting.invoice', 'user_token=' . $this->session->data['user_token'], true);
		
		$data['add'] = $this->url->link('account/setting.add_warehouse', 'user_token=' . $this->session->data['user_token'], true);
		
		$warehouses = $this->model_catalog_warehouse->getWarehouses($this->user->getId());
		
		$data['warehouses'] = array();
		
		foreach ($warehouses as $warehouse) {
			$data['warehouses'][] = array(
				'name' => $warehouse['name'],
				'edit' =>  $this->url->link('account/setting.edit_warehouse', 'user_token=' . $this->session->data['user_token'] . '&warehouse_id=' . $warehouse['warehouse_id'], true),
				'delete' =>  $this->url->link('account/setting.delete_warehouse', 'user_token=' . $this->session->data['user_token'] . '&warehouse_id=' . $warehouse['warehouse_id'], true),
			);
		}
		
		$data['header'] = $this->load->controller('common/header');
		$data['navigation'] = $this->load->controller('common/navigation');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('account/warehouse', $data));
	}
	
	public function add_warehouse() {
		$this->load->model('catalog/warehouse');
		
		$this->load->language('account/setting');

		$this->document->setTitle($this->language->get('heading_title'));
		
		if ($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validateWarehouseForm()) {
			$this->model_catalog_warehouse->addWarehouse($this->user->getId(), $this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->response->redirect($this->url->link('account/setting.warehouse', 'user_token=' . $this->session->data['user_token'], true));
		}
		
		$this->getWarehouseForm();
	}
	
	public function edit_warehouse() {
		$this->load->model('catalog/warehouse');
		
		$this->load->language('account/setting');

		$this->document->setTitle($this->language->get('heading_title'));
		
		if ($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validateWarehouseForm() && isset($this->request->get['warehouse_id'])) {
			$this->model_catalog_warehouse->editWarehouse($this->user->getId(), $this->request->get['warehouse_id'], $this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->response->redirect($this->url->link('account/setting.warehouse', 'user_token=' . $this->session->data['user_token'], true));
		}
		
		$this->getWarehouseForm();
	}
	
	public function delete_warehouse() {
		if (isset($this->request->get['warehouse_id'])) {
			$this->load->language('account/setting');
			
			$this->load->model('catalog/warehouse');
			
			$result = $this->model_catalog_warehouse->deleteWarehouse($this->user->getId(), $this->request->get['warehouse_id']);
			
			if ($result) {
				$this->session->data['success'] = $this->language->get('text_success');
			}
		}
		
		$this->response->redirect($this->url->link('account/setting.warehouse', 'user_token=' . $this->session->data['user_token'], true));
	}
	
	private function getWarehouseForm() {
		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}
		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if (isset($this->request->get['warehouse_id'])) {
			$warehouse_data = $this->model_catalog_warehouse->getWarehouse($this->user->getId(), $this->request->get['warehouse_id']);
		} else {
			$warehouse_data = array();
		}
		
		if (isset($this->request->post['sku_prefix'])) {
			$data['sku_prefix'] = $this->request->post['sku_prefix'];
		} elseif (!empty($warehouse_data)) {
			$data['sku_prefix'] = $warehouse_data['sku_prefix'];
		} else {
			$data['sku_prefix'] = '';
		}
		
		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($warehouse_data)) {
			$data['name'] = $warehouse_data['name'];
		} else {
			$data['name'] = '';
		}
		
		if (isset($this->request->post['address_1'])) {
			$data['address_1'] = $this->request->post['address_1'];
		} elseif (!empty($warehouse_data)) {
			$data['address_1'] = $warehouse_data['address_1'];
		} else {
			$data['address_1'] = '';
		}
		
		if (isset($this->request->post['address_2'])) {
			$data['address_2'] = $this->request->post['address_2'];
		} elseif (!empty($warehouse_data)) {
			$data['address_2'] = $warehouse_data['address_2'];
		} else {
			$data['address_2'] = '';
		}
		
		if (isset($this->request->post['city'])) {
			$data['city'] = $this->request->post['city'];
		} elseif (!empty($warehouse_data)) {
			$data['city'] = $warehouse_data['city'];
		} else {
			$data['city'] = '';
		}
		
		if (isset($this->request->post['postcode'])) {
			$data['postcode'] = $this->request->post['postcode'];
		} elseif (!empty($warehouse_data)) {
			$data['postcode'] = $warehouse_data['postcode'];
		} else {
			$data['postcode'] = '';
		}
		
		$this->load->model('localisation/country');
		
		$data['countries'] = $this->model_localisation_country->getCountries();
		
		if (isset($this->request->post['country_id'])) {
			$data['country_id'] = $this->request->post['country_id'];
		} elseif (!empty($warehouse_data)) {
			$data['country_id'] = $warehouse_data['country_id'];
		} else {
			$data['country_id'] = '';
		}
		
		$this->load->model('localisation/zone');
		
		if (isset($warehouse_data['country_id']) && $warehouse_data['country_id']) {
			$data['zones'] = $this->model_localisation_zone->getZonesByCountryId($warehouse_data['country_id']);
		} else {
			$data['zones'] = array();
		}
		
		if (isset($this->request->post['zone_id'])) {
			$data['zone_id'] = $this->request->post['zone_id'];
		} elseif (!empty($warehouse_data)) {
			$data['zone_id'] = $warehouse_data['zone_id'];
		} else {
			$data['zone_id'] = '';
		}

		if (isset($this->request->post['email'])) {
			$data['email'] = $this->request->post['email'];
		} elseif (!empty($warehouse_data)) {
			$data['email'] = $warehouse_data['email'];
		} else {
			$data['email'] = '';
		}
		
		if (isset($this->request->post['phone'])) {
			$data['phone'] = $this->request->post['phone'];
		} elseif (!empty($warehouse_data)) {
			$data['phone'] = $warehouse_data['phone'];
		} else {
			$data['phone'] = '';
		}
		
		if ($warehouse_data) {
			$data['action'] = $this->url->link('account/setting.edit_warehouse', 'user_token=' . $this->session->data['user_token'] . '&warehouse_id=' . $warehouse_data['warehouse_id'], true);
		} else {
			$data['action'] = $this->url->link('account/setting.add_warehouse', 'user_token=' . $this->session->data['user_token'], true);
		}
		
		$data['cancel'] = $this->url->link('account/setting.warehouse', 'user_token=' . $this->session->data['user_token'], true);
		
		$data['user_token'] = $this->session->data['user_token'];
		
		$data['header'] = $this->load->controller('common/header');
		$data['navigation'] = $this->load->controller('common/navigation');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('account/warehouse_form', $data));
	}
	
	private function validateWarehouseForm() {
		if (!isset($this->request->post['sku_prefix']) or oc_strlen($this->request->post['sku_prefix']) > 4) {
			$this->error['warning'] = $this->language->get('error_sku_prefix');
		}
		
		if (empty($this->request->post['name']) or oc_strlen($this->request->post['name']) > 64) {
			$this->error['warning'] = $this->language->get('error_name');
		}
		
		if (!isset($this->request->post['address_1']) || (oc_strlen($this->request->post['address_1'])) > 128) {
			$this->error['warning'] = $this->language->get('error_address_1');
		}
		
		if (!isset($this->request->post['address_2']) || (oc_strlen($this->request->post['address_2'])) > 128) {
			$this->error['warning'] = $this->language->get('error_address_2');
		}
		
		if (!isset($this->request->post['city']) || (oc_strlen($this->request->post['city'])) > 128) {
			$this->error['warning'] = $this->language->get('error_city');
		}
		
		if (!isset($this->request->post['postcode']) || (oc_strlen($this->request->post['postcode'])) > 10) {
			$this->error['warning'] = $this->language->get('error_postcode');
		}
		
		if (!isset($this->request->post['country_id'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		} elseif(!empty($this->request->post['country_id'])) {
			$this->load->model('localisation/country');
			
			if (!$this->model_localisation_country->getCountry($this->request->post['country_id'])) {
				$this->error['warning'] = $this->language->get('error_warning');
			}
		}
		
		if (!isset($this->request->post['zone_id'])) {
			$this->error['warning'] = $this->language->get('error_zone');
		} elseif(!empty($this->request->post['zone_id'])) {
			$this->load->model('localisation/zone');
			
			if (!$this->model_localisation_zone->getZone($this->request->post['zone_id'])) {
				$this->error['warning'] = $this->language->get('error_warning');
			}
		}
		
		if (!isset($this->request->post['phone']) || (oc_strlen($this->request->post['phone'])) > 32) {
			$this->error['warning'] = $this->language->get('error_phone');
		}

		if (!empty($this->request->post['email']) and ((oc_strlen($this->request->post['email']) > 96) or !filter_var($this->request->post['email'], FILTER_VALIDATE_EMAIL))) {
			$this->error['warning'] = $this->language->get('error_email');
		} elseif (!isset($this->request->post['email'])) {
			$this->error['warning'] = $this->language->get('error_email');
		}
		
		return !$this->error;
	}
	
	public function password() {
		$this->load->model('user/user');
		
		$this->load->language('account/setting');

		$this->document->setTitle($this->language->get('heading_title'));

		if (isset($this->request->post['password'])) {
			$data['password'] = $this->request->post['password'];
		} else {
			$data['password'] = '';
		}
		
		if (isset($this->request->post['confirm'])) {
			$data['confirm'] = $this->request->post['confirm'];
		} else {
			$data['confirm'] = '';
		}
		
		$data['action'] = $this->url->link('account/setting.password', 'user_token=' . $this->session->data['user_token'], true);
		
		$data['account'] = $this->url->link('account/setting', 'user_token=' . $this->session->data['user_token'], true);
		$data['warehouse'] = $this->url->link('account/setting.warehouse', 'user_token=' . $this->session->data['user_token'], true);
		$data['invoice'] = $this->url->link('account/setting.invoice', 'user_token=' . $this->session->data['user_token'], true);
		
		if ($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validatePasswordForm()) {
			$this->model_user_user->editPassword($this->user->getId(), $this->request->post['password']);
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->response->redirect($this->url->link('account/setting', 'user_token=' . $this->session->data['user_token'], true));
		}
		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		$data['header'] = $this->load->controller('common/header');
		$data['navigation'] = $this->load->controller('common/navigation');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('account/password', $data));
	}
	
	protected function validatePasswordForm() {
		if (empty($this->request->post['password']) || (oc_strlen(html_entity_decode($this->request->post['password'], ENT_QUOTES, 'UTF-8')) < 4) || (oc_strlen(html_entity_decode($this->request->post['password'], ENT_QUOTES, 'UTF-8')) > 40)) {
			$this->error['warning'] = $this->language->get('error_password');
		}

		if (empty($this->request->post['password']) || empty($this->request->post['confirm']) || $this->request->post['confirm'] != $this->request->post['password']) {
			$this->error['warning'] = $this->language->get('error_confirm');
		}
		
		return !$this->error;
	}
	
	public function invoice() {
		$this->load->model('user/user');
		
		$this->load->language('account/setting');

		$this->document->setTitle($this->language->get('heading_title'));
		
		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->post['tax'])) {
			$data['tax'] = $this->request->post['tax'];
		} else {
			$data['tax'] = $this->user->get('tax');
		}
		
		$data['action'] = $this->url->link('account/setting.invoice', 'user_token=' . $this->session->data['user_token'], true);
		
		$data['account'] = $this->url->link('account/setting', 'user_token=' . $this->session->data['user_token'], true);
		$data['warehouse'] = $this->url->link('account/setting.warehouse', 'user_token=' . $this->session->data['user_token'], true);
		$data['password'] = $this->url->link('account/setting.password', 'user_token=' . $this->session->data['user_token'], true);
		
		if ($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validateInvoiceForm()) {
			$this->model_user_user->editTax($this->user->getId(), $this->request->post['tax']);
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->response->redirect($this->url->link('account/setting.invoice', 'user_token=' . $this->session->data['user_token'], true));
		}
		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		$data['header'] = $this->load->controller('common/header');
		$data['navigation'] = $this->load->controller('common/navigation');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('account/invoice', $data));
	}
	
	protected function validateInvoiceForm() {
		if (!isset($this->request->post['tax']) || (int) $this->request->post['tax'] > 100 ||  (int) $this->request->post['tax'] < 0) {
			$this->error['warning'] = $this->language->get('error_warning');
		}
		
		return !$this->error;
	}
	
	public function getZones() {
		$json = array();
		
		if (isset($this->request->get['country_id'])) {
			$this->load->model('localisation/zone');
			
			$json = $this->model_localisation_zone->getZonesByCountryId($this->request->get['country_id']);
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function uploadImage() {
		$json = array();
		
		$this->load->language('account/setting');

		if (isset($this->request->files['logo'])) {
			$content = file_get_contents($this->request->files['logo']['tmp_name']);

			if (preg_match('/\<\?php/i', $content)) {
				$json['error'] = $this->language->get('error_image');
			}
			
			if ($this->request->files['logo']['size'] > 25000000) {
				$json['error'] = $this->language->get('error_image');
			}
			
			$mime = mime_content_type($this->request->files['logo']['tmp_name']);
			
			switch($mime) {
				case 'image/jpeg':
					break;
				case 'image/png':
					break;
				default:
					$json['error'] = $this->language->get('error_image');
			}
		} else {
			$json['error'] = $this->language->get('error_image');
		}
		
		if (!isset($json['error'])) {
			$name_exp = explode('.', $this->request->files['logo']['name']);
			$file_name = $this->user->getId() . time() . '.' . end($name_exp);
			
			list($width_orig, $height_orig, $image_type) = getimagesize($this->request->files['logo']['tmp_name']);
		
			$image = new \Opencart\System\Library\Image($this->request->files['logo']['tmp_name']);

			if (MAX_IMAGE_WIDTH < $width_orig or MAX_IMAGE_HEIGHT < $height_orig) {
				$scale_width = $width_orig / MAX_IMAGE_WIDTH;
				$scale_height = $height_orig / MAX_IMAGE_HEIGHT;
				
				if ($scale_width > $scale_height) {
					$scale = $scale_width;
				} else {
					$scale = $scale_height;
				}
				
				$image->resize(round(MAX_IMAGE_WIDTH / $scale), round(MAX_IMAGE_HEIGHT / $scale));
			}
			
			$image->save(DIR_IMAGE_USER_LOGO . $file_name);

			unset($image);
			
			$json['logo'] = DIR_IMAGE_USER_LOGO_NAME . $file_name;
			$json['preview'] = HTTP_SERVER . DIR_IMAGE_USER_LOGO_RELATIVE . $file_name;	
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
