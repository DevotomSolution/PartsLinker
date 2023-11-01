<?php
namespace Opencart\Catalog\Controller\Integration\Onlineshop;
class Baselinker extends \Opencart\System\Engine\Controller {
	private $error = array();
	
	public function index() {
		$this->load->language('integration/baselinker');
		
		$this->load->model('integration/onlineshop/baselinker');
		
		if(!$this->model_integration_onlineshop_baselinker->connect($this->user->getId())) {
			$this->session->data['error'] = $this->language->get('error_connect');
			$this->response->redirect($this->url->link('integration/onlineshop/baselinker.connect', 'user_token=' . $this->session->data['user_token'], true));
		}
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		if(isset($this->session->data['error'])) {
			$data['error_warning'] = $this->session->data['error'];

			unset($this->session->data['error']);
		} elseif(isset($this->error['warning'])) {
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
			'filter_onlineshop' => 'baselinker',
		);
		
		$data['total'] = $this->model_catalog_product->getTotalProducts($this->user->getId(), $filter_data);
		
		$data['user_token'] = $this->session->data['user_token'];
		
		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['navigation'] = $this->load->controller('common/navigation');
		
		$data['connect'] = $this->url->link('integration/onlineshop/baselinker.connect', 'user_token=' . $this->session->data['user_token'], true);
		$data['setting'] = $this->url->link('integration/onlineshop/baselinker.setting', 'user_token=' . $this->session->data['user_token'], true);
		
		$this->response->setOutput($this->load->view('integration/baselinker_index', $data));
	}
	
	public function connect() {
		$this->load->language('integration/baselinker');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('integration/onlineshop/baselinker');
		
		if($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validateConnectForm()) {
			$storage = $this->model_integration_onlineshop_baselinker->getStorage($this->user->getId());
			
			$storage['token'] = $this->request->post['token'];
			
			unset($storage['date_confirmed_from']);
			
			$this->model_integration_onlineshop_baselinker->editStorage($this->user->getId(), $storage);
			
			if ($this->model_integration_onlineshop_baselinker->connect($this->user->getId(), true)) {
				$this->session->data['success'] = $this->language->get('text_success');
				$this->response->redirect($this->url->link('integration/onlineshop/baselinker.setting', 'user_token=' . $this->session->data['user_token'], true));
			} else {
				$this->error['warning'] = $this->language->get('error_connect');
			}
		}
		
		$this->getConnectForm();
	}
	
	protected function getConnectForm() {
		$storage = $this->model_integration_onlineshop_baselinker->getStorage($this->user->getId());

		if(isset($this->session->data['error'])) {
			$data['error_warning'] = $this->session->data['error'];

			unset($this->session->data['error']);
		} elseif(isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if(isset($this->request->post['token'])) {
			$data['token'] = $this->request->post['token'];
		} elseif(isset($storage['token'])) {
			$data['token'] = $storage['token'];
		} else {
			$data['token'] = '';
		}
		
		$data['action'] = $this->url->link('integration/onlineshop/baselinker.connect', 'user_token=' . $this->session->data['user_token'], true);
		
		$data['setting'] = $this->url->link('integration/onlineshop/baselinker.setting', 'user_token=' . $this->session->data['user_token'], true);
		$data['home'] = $this->url->link('integration/onlineshop/baselinker', 'user_token=' . $this->session->data['user_token'], true);
		
		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['navigation'] = $this->load->controller('common/navigation');
		
		$this->response->setOutput($this->load->view('integration/baselinker_connect', $data));
	}	
	
	protected function validateConnectForm() {
		if(empty($this->request->post['token'])) {
			$this->error['warning'] = $this->language->get('error_setting');
		}
		
		return !$this->error;
	}
	
	public function setting() {
		$this->load->language('integration/baselinker');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('integration/onlineshop/baselinker');
		
		if(!$this->model_integration_onlineshop_baselinker->connect($this->user->getId())) {
			$this->session->data['error'] = $this->language->get('error_connect');
			$this->response->redirect($this->url->link('integration/onlineshop/baselinker.connect', 'user_token=' . $this->session->data['user_token'], true));
		}
		
		if($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validateSettingForm()) {
			$storage = $this->model_integration_onlineshop_baselinker->getStorage($this->user->getId());
			
			$storage['warehouse_id'] = $this->request->post['warehouse_id'];
			
			$storage['inventory_id'] = $this->request->post['inventory_id'];
			
			$storage['price_group_id'] = $this->request->post['price_group_id'];
			
			$storage['general_description'] = $this->request->post['general_description'];
			
			$storage['currency'] = $this->request->post['currency'];
			
			$this->model_integration_onlineshop_baselinker->editStorage($this->user->getId(), $storage);
			
			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('integration/onlineshop/baselinker', 'user_token=' . $this->session->data['user_token'], true));
		}
		
		$this->getSettingForm();
	}
	
	protected function getSettingForm() {
		if(isset($this->session->data['error'])) {
			$data['error_warning'] = $this->session->data['error'];

			unset($this->session->data['error']);
		} elseif(isset($this->error['warning'])) {
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
		
		$storage = $this->model_integration_onlineshop_baselinker->getStorage($this->user->getId());
		
		if(isset($this->request->post['currency'])) {
			$data['currency'] = $this->request->post['currency'];
		} elseif(isset($storage['currency'])) {
			$data['currency'] = $storage['currency'];
		} else {
			$data['currency'] = '';
		}
		
		if(isset($this->request->post['warehouse_id'])) {
			$data['warehouse_id'] = $this->request->post['warehouse_id'];
		} elseif(isset($storage['warehouse_id'])) {
			$data['warehouse_id'] = $storage['warehouse_id'];
		} else {
			$data['warehouse_id'] = '';
		}
		
		if(isset($this->request->post['inventory_id'])) {
			$data['inventory_id'] = $this->request->post['inventory_id'];
		} elseif(isset($storage['inventory_id'])) {
			$data['inventory_id'] = $storage['inventory_id'];
		} else {
			$data['inventory_id'] = '';
		}
		
		if(isset($this->request->post['price_group_id'])) {
			$data['price_group_id'] = $this->request->post['price_group_id'];
		} elseif(isset($storage['price_group_id'])) {
			$data['price_group_id'] = $storage['price_group_id'];
		} else {
			$data['price_group_id'] = '';
		}
		
		if(isset($this->request->post['general_description'])) {
			$data['general_description'] = $this->request->post['general_description'];
		} elseif(isset($storage['general_description'])) {
			$data['general_description'] = $storage['general_description'];
		} else {
			$data['general_description'] = '';
		}
		
		$data['inventories'] = $this->model_integration_onlineshop_baselinker->getInventories();
		
		$data['warehouses'] = $this->model_integration_onlineshop_baselinker->getInventoryWarehouses();
		
		foreach($data['warehouses'] as $key => $warehouse) {
			$data['warehouses'][$key]['id'] = $warehouse['warehouse_type'] . '_' . $warehouse['warehouse_id'];
		}
		
		$data['price_groups'] = $this->model_integration_onlineshop_baselinker->getInventoryPriceGroups();
		
		$data['action'] = $this->url->link('integration/onlineshop/baselinker.setting', 'user_token=' . $this->session->data['user_token'], true);
		
		$data['home'] = $this->url->link('integration/onlineshop/baselinker', 'user_token=' . $this->session->data['user_token'], true);
		$data['connect'] = $this->url->link('integration/onlineshop/baselinker.connect', 'user_token=' . $this->session->data['user_token'], true);
		
		$this->document->addScript('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js', 'footer');
		$this->document->addStyle('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css', 'stylesheet', 'screen', 'footer');
		
		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['navigation'] = $this->load->controller('common/navigation');
		
		$this->response->setOutput($this->load->view('integration/baselinker_setting', $data));
	}	
	
	protected function validateSettingForm() {
		if(empty($this->request->post['warehouse_id'])) {
			$this->error['warning'] = $this->language->get('error_warehouse_id');
		}
		
		if(empty($this->request->post['inventory_id'])) {
			$this->error['warning'] = $this->language->get('error_inventory_id');
		}
		
		if(empty($this->request->post['price_group_id'])) {
			$this->error['warning'] = $this->language->get('error_price_group_id');
		}
		
		if(empty($this->request->post['currency']) or !$this->currency->getId($this->request->post['currency'])) {
			$this->error['warning'] = $this->language->get('error_currency');
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
	
	public function uploadProducts() {
		$json = array();

		$this->load->model('integration/onlineshop/baselinker');
		
		if(isset($this->request->get['start'])) {
			$start = (int) $this->request->get['start'];
		} else {
			$start = false;
		}
		
		$this->load->model('catalog/product');
		
		$products = array();

		if($start !== false) {
			$filter_data = array(
				'start' => (int) $start,
				'limit' => 20,
				'filter_onlineshop' => 'baselinker',
			);
			
			$products = $this->model_catalog_product->getProducts($this->user->getId(), $filter_data);
		}
		
		foreach($products as $product) {
			$json[$product['sku']] = $this->model_integration_onlineshop_baselinker->syncProduct($this->user->getId(), $product['sku'], $product);
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function uploadManufacturers() {
		$json = array(
			'total' => 0
		);
		
		$this->load->language('integration/baselinker');
		
		$this->load->model('catalog/brand');
		$this->load->model('integration/onlineshop/baselinker');
		
		$brands = $this->model_catalog_brand->getUserBrands($this->user->getId());
		
		$baselinker_manufacturers = $this->model_integration_onlineshop_baselinker->getInventoryManufacturers();
		
		if (isset($this->request->get['start'])) {
			$start = (int) $this->request->get['start'];
		} else {
			$start = 0;
		}
		
		if (isset($this->request->get['limit'])) {
			$limit = (int) $this->request->get['limit'];
		} else {
			$limit = 50;
		}
		
		$i = 0;
		
		foreach ($brands as $brand) {
			if ($i < $start) {
				$i++;
				continue;
			}
			
			if ($i >= $start + $limit) {
				break;
			}
			
			$i++;
			
			foreach ($baselinker_manufacturers as $baselinker_manufacturer) {
				if (strtolower(str_replace(array(' ', '-'), '', $brand['name'])) === strtolower(str_replace(array(' ', '-'), '', $baselinker_manufacturer['name']))) {
					continue 2;
				}
			}
			
			$manufacturer_response = $this->model_integration_onlineshop_baselinker->addInventoryManufacturer(array('name' => $brand['name']));
				
			if ($manufacturer_response['status'] === 'SUCCESS') {
				$json['total']++;
			} else {
				$json['error'] = $this->language->get('text_error');
				break;
			}
			
			
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function getTotalManufacturers() {
		$json = array(
			'total' => 0
		);
		
		$this->load->model('catalog/brand');
		
		$brands = $this->model_catalog_brand->getUserBrands($this->user->getId());
		
		$json['total'] = count($brands);
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function uploadCategories() {
		$json = array(
			'total' => 0
		);
		
		$this->load->model('integration/onlineshop/baselinker');
		$this->load->model('catalog/category');
		$this->load->model('localisation/language');
		
		$languages = $this->model_localisation_language->getLanguages();
		$languages = array_column($languages, null, 'language_id');
		
		$product_categories = $this->model_catalog_category->getCategories($this->user->getId());
		
		$baselinker_categories = $this->model_integration_onlineshop_baselinker->getInventoryCategories();
		
		if (isset($this->request->get['start'])) {
			$start = (int) $this->request->get['start'];
		} else {
			$start = 0;
		}
		
		if (isset($this->request->get['limit'])) {
			$limit = (int) $this->request->get['limit'];
		} else {
			$limit = 50;
		}
		
		$i = 0;
		
		foreach ($product_categories as $product_category) {
			if ($i < $start) {
				$i++;
				continue;
			}
			
			if ($i >= $start + $limit) {
				break;
			}
			
			$i++;
			
			$product_category_data = $this->model_catalog_category->getCategory($product_category['category_id']);
			
			$parent_product_category_data = $this->model_catalog_category->getCategory($product_category_data['parent_id']);
			
			$baselinker_parent_id = 0;
			
			if ($product_category_data['parent_id'] != 0) {
				foreach ($baselinker_categories as $baselinker_category) {
					foreach ($parent_product_category_data['translates'] as $parent_product_category_name) {
						if (str_replace(array(' ', '-'), '', strtolower($baselinker_category['name'])) === str_replace(array(' ', '-'), '', strtolower($parent_product_category_name))) {
							$baselinker_parent_id = $baselinker_category['category_id'];
							break 2;
						}
					}
				}
			}
			
			foreach ($baselinker_categories as $baselinker_category) {
				foreach ($product_category_data['translates'] as $product_category_name) {
					if (str_replace(array(' ', '-'), '', strtolower($baselinker_category['name'])) === str_replace(array(' ', '-'), '', strtolower($product_category_name))) {
						if ($baselinker_parent_id == $baselinker_category['parent_id']) {
							continue 3;
						}
					}
				}
			}

			
			$baselinker_category_data = array(
				'parent_id' => $baselinker_parent_id,
				'name' => $product_category_data['name'],
			);

			$baselinker_category_response = $this->model_integration_onlineshop_baselinker->addInventoryCategory($baselinker_category_data);

			if (isset($baselinker_category_response['category_id'])) {
				$baselinker_categories[] = array(
					'parent_id' => $baselinker_category_data['parent_id'],
					'name' => $product_category_data['name'],
					'category_id' => $baselinker_category_response['category_id'],
				);
				
				$baselinker_parent_id = $baselinker_category_response['category_id'];
				
				$json['total']++;
			} else {
				$json['error'] = $this->language->get('text_error');
				break;
			}		
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function getTotalCategories() {
		$json = array(
			'total' => 0
		);
		
		$this->load->model('catalog/category');
		
		$product_categories = $this->model_catalog_category->getCategories($this->user->getId());
		
		$json['total'] = count($product_categories);

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
