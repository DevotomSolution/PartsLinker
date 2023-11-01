<?php
namespace Opencart\Catalog\Controller\Integration\Onlineshop;
class Opencart extends \Opencart\System\Engine\Controller {
	private $error = array();
	
	public function index() {
		$this->load->model('integration/onlineshop/opencart');
		
		$this->load->language('integration/opencart');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		if (!$this->model_integration_onlineshop_opencart->connect($this->user->getId())) {
			$this->session->data['error'] = $this->language->get('error_connect');
			$this->response->redirect($this->url->link('integration/onlineshop/opencart.connect', 'user_token=' . $this->session->data['user_token'], true));
		}
		
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
			'filter_onlineshop' => 'opencart',
		);
		
		$data['total'] = $this->model_catalog_product->getTotalProducts($this->user->getId(), $filter_data);
		
		$data['user_token'] = $this->session->data['user_token'];
		
		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['navigation'] = $this->load->controller('common/navigation');
		
		$data['connect'] = $this->url->link('integration/onlineshop/opencart.connect', 'user_token=' . $this->session->data['user_token'], true);
		$data['setting'] = $this->url->link('integration/onlineshop/opencart.setting', 'user_token=' . $this->session->data['user_token'], true);
		
		$this->response->setOutput($this->load->view('integration/opencart_index', $data));
	}
	
	public function connect() {
		$this->load->language('integration/opencart');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('integration/onlineshop/opencart');
		
		if ($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validateConnectForm()) {
			$storage = $this->model_integration_onlineshop_opencart->getStorage($this->user->getId());
			
			$storage['username'] = $this->request->post['username'];
			$storage['key'] = $this->request->post['key'];
			$storage['website'] = $this->request->post['website'];
			$storage['version'] = $this->request->post['version'];
			
			$this->model_integration_onlineshop_opencart->editStorage($this->user->getId(), $storage);
			
			if ($this->model_integration_onlineshop_opencart->connect($this->user->getId(), true)) {
				$this->session->data['success'] = $this->language->get('text_success');
				
				$this->response->redirect($this->url->link('integration/onlineshop/opencart.setting', 'user_token=' . $this->session->data['user_token'], true));
			} else {
				$this->error['warning'] = $this->language->get('error_connect');
			}
		}
		
		$this->getConnectForm();
	}
	
	protected function getConnectForm() {
		$storage = $this->model_integration_onlineshop_opencart->getStorage($this->user->getId());

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
		
		if (isset($this->request->post['website'])) {
			$data['website'] = $this->request->post['website'];
		} elseif (isset($storage['website'])) {
			$data['website'] = $storage['website'];
		} else {
			$data['website'] = $this->user->get('website');
		}
		
		if (isset($this->request->post['version'])) {
			$data['version'] = $this->request->post['version'];
		} elseif (isset($storage['version'])) {
			$data['version'] = $storage['version'];
		} else {
			$data['version'] = '';
		}
		
		if (isset($this->request->post['username'])) {
			$data['username'] = $this->request->post['username'];
		} elseif (isset($storage['username'])) {
			$data['username'] = $storage['username'];
		} else {
			$data['username'] = '';
		}
		
		if (isset($this->request->post['key'])) {
			$data['key'] = $this->request->post['key'];
		} elseif (isset($storage['key'])) {
			$data['key'] = $storage['key'];
		} else {
			$data['key'] = '';
		}
		
		$data['ip'] = '65.109.127.35';
		
		$data['action'] = $this->url->link('integration/onlineshop/opencart.connect', 'user_token=' . $this->session->data['user_token'], true);
		
		$data['home'] = $this->url->link('integration/onlineshop/opencart', 'user_token=' . $this->session->data['user_token'], true);
		$data['setting'] = $this->url->link('integration/onlineshop/opencart.setting', 'user_token=' . $this->session->data['user_token'], true);
		
		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['navigation'] = $this->load->controller('common/navigation');
		
		$this->response->setOutput($this->load->view('integration/opencart_connect', $data));
	}
	
	protected function validateConnectForm() {
		if (empty($this->request->post['username'])) {
			$this->error['warning'] = $this->language->get('error_username');
		}
		
		if (empty($this->request->post['key'])) {
			$this->error['warning'] = $this->language->get('error_key');
		}
		
		if (empty($this->request->post['website']) or !preg_match("/^http(s)?:\\/\\/.+$/", $this->request->post['website'])) {
			$this->error['warning'] = $this->language->get('error_website');
		}
		
		if (empty($this->request->post['version'])) {
			$this->error['warning'] = $this->language->get('error_version');
		}

		return !$this->error;
	}
	
	public function setting() {
		$this->load->language('integration/opencart');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('integration/onlineshop/opencart');
		
		if (!$this->model_integration_onlineshop_opencart->connect($this->user->getId())) {
			$this->session->data['error'] = $this->language->get('error_connect');
			$this->response->redirect($this->url->link('integration/onlineshop/opencart.connect', 'user_token=' . $this->session->data['user_token'], true));
		}
		
		if ($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validateSettingForm()) {
			$storage = $this->model_integration_onlineshop_opencart->getStorage($this->user->getId());
			
			$storage['price_percent'] = $this->request->post['price_percent'];
			$storage['transport_price_fixed'] = $this->currency->convert((float) $this->request->post['transport_price_fixed'], $this->user->get('currency'), '0');
			
			if (isset($this->request->post['transport_price_by_weight'])) {
				foreach ($this->request->post['transport_price_by_weight'] as $key => $price) {
					$storage['transport_price_by_weight'][$key]['weight_from'] = $price['weight_from'];
					$storage['transport_price_by_weight'][$key]['weight_to'] = $price['weight_to'];
					$storage['transport_price_by_weight'][$key]['price'] = $this->currency->convert((float) $price['price'], $this->user->get('currency'), '0');
				}
			}

			$this->model_integration_onlineshop_opencart->editStorage($this->user->getId(), $storage);

			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->response->redirect($this->url->link('integration/onlineshop/opencart', 'user_token=' . $this->session->data['user_token'], true));
		}
		
		$this->getSettingForm();
	}
	
	protected function getSettingForm() {
		$storage = $this->model_integration_onlineshop_opencart->getStorage($this->user->getId());

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
		
		$data['action'] = $this->url->link('integration/onlineshop/opencart.setting', 'user_token=' . $this->session->data['user_token'], true);
		
		$data['home'] = $this->url->link('integration/onlineshop/opencart', 'user_token=' . $this->session->data['user_token'], true);
		$data['connect'] = $this->url->link('integration/onlineshop/opencart.connect', 'user_token=' . $this->session->data['user_token'], true);
		
		$this->document->addScript('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js', 'footer');
		$this->document->addStyle('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css', 'stylesheet', 'screen', 'footer');
		
		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['navigation'] = $this->load->controller('common/navigation');
		
		$this->response->setOutput($this->load->view('integration/opencart_setting', $data));
	}
	
	protected function validateSettingForm() {
		if (!isset($this->request->post['price_percent'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}
		
		if (!isset($this->request->post['transport_price_fixed'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}
		
		if (isset($this->request->post['transport_price_by_weight'])) {
			foreach ($this->request->post['transport_price_by_weight'] as $price) {
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
		}

		return !$this->error;
	}
	
	public function uploadProducts() {
		$json = array();

		$this->load->model('integration/onlineshop/opencart');
		
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
				'filter_onlineshop' => 'opencart',
			);
			
			$products = $this->model_catalog_product->getProducts($this->user->getId(), $filter_data);
		}
		
		foreach($products as $product) {
			$json[$product['sku']] = $this->model_integration_onlineshop_opencart->syncProduct($this->user->getId(), $product['sku'], $product);
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function uploadManufacturers() {
		$json = array(
			'total' => 0
		);
		
		$this->load->model('catalog/brand');
		$this->load->model('integration/onlineshop/opencart');
		
		$brands = $this->model_catalog_brand->getUserBrands($this->user->getId());
		
		$oc_manufacturers = $this->model_integration_onlineshop_opencart->getManufacturers();
		
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
			
			foreach ($oc_manufacturers as $oc_manufacturer) {
				if (strtolower(str_replace(array(' ', '-'), '', $brand['name'])) === strtolower(str_replace(array(' ', '-'), '', $oc_manufacturer['name']))) {
					continue 2;
				}
			}
			
			$manufacturer_response = $this->model_integration_onlineshop_opencart->addManufacturer(array('name' => $brand['name']));
			
			if (isset($manufacturer_response['manufacturer_id'])) {
				$json['total']++;
			} else {
				$json['error'] = 'Error';
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
		
		$this->load->model('integration/onlineshop/opencart');
		$this->load->model('catalog/category');
		$this->load->model('localisation/language');
		
		$languages = $this->model_localisation_language->getLanguages();
		$languages = array_column($languages, null, 'language_id');
		
		$product_categories = $this->model_catalog_category->getCategories($this->user->getId());
		
		$oc_categories = $this->model_integration_onlineshop_opencart->getCategories();
		
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
			
			$oc_parent_id = 0;
			
			if ($product_category_data['parent_id'] != 0) {
				foreach ($oc_categories as $oc_category) {
					foreach ($parent_product_category_data['translates'] as $parent_product_category_name) {
						if (str_replace(array(' ', '-'), '', strtolower($oc_category['name'])) === str_replace(array(' ', '-'), '', strtolower($parent_product_category_name))) {
							$oc_parent_id = $oc_category['category_id'];
							break 2;
						}
					}
				}
			}
			
			foreach ($oc_categories as $oc_category) {
				foreach ($product_category_data['translates'] as $product_category_name) {
					if (str_replace(array(' ', '-'), '', strtolower($oc_category['name'])) === str_replace(array(' ', '-'), '', strtolower($product_category_name))) {
						if ($oc_parent_id == $oc_category['parent_id']) {
							continue 3;
						}
					}
				}
			}
			
			
			$oc_category_data = array(
				'parent_id' => $oc_parent_id,
			);
			
			if ($product_category_data['image']) {
				$oc_category_data['image'] = HTTP_SERVER . DIR_IMAGE_RELATIVE . $product_category_data['image'];
			}
			
			foreach ($product_category_data['translates'] as $language_id => $product_category_name) {
				$oc_category_data['category_description'][$languages[$language_id]['code']]['name'] = $product_category_name;
			}
			
			$oc_category_response = $this->model_integration_onlineshop_opencart->addCategory($oc_category_data);

			if (isset($oc_category_response['category_id'])) {
				$oc_categories[$oc_category_response['category_id']] = array(
					'category_id' => $oc_category_response['category_id'], 
					'parent_id' => $oc_parent_id, 
					'name' => $product_category_data['name'], 
				);
				
				$json['total']++;
			} else {
				$json['error'] = 'Error';
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
	
	public function uploadFilters() {
		$json = array(
			'total' => 0
		);
		
		$this->load->model('integration/onlineshop/opencart');
		$this->load->model('catalog/vehicle');
		$this->load->model('catalog/vehicle4parts');
		$this->load->model('localisation/language');
		
		$languages = $this->model_localisation_language->getLanguages();
		$languages = array_column($languages, null, 'language_id');
		
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
		
		$oc_filter_groups = $this->model_integration_onlineshop_opencart->getFilterGroups();
		
		$vehicle_brands	= $this->model_catalog_vehicle->getBrands($this->user->getId());
		
		foreach ($vehicle_brands as $vehicle_brand) {
			$oc_filter_group_id = 0;
			
			foreach ($oc_filter_groups as $oc_filter_group) {
				if (str_replace(array(' ', '-'), '', strtolower($oc_filter_group['name'])) === str_replace(array(' ', '-'), '', strtolower($vehicle_brand['name']))) {
					$oc_filter_group_id = $oc_filter_group['filter_group_id'];
					break;
				}
			}
			
			if ($oc_filter_group_id == 0) {	
				$oc_filter_group_data = array();
				
				foreach ($languages as $language) {
					$oc_filter_group_data['filter_group_description'][$language['code']]['name'] = $vehicle_brand['name'];
				}

				$oc_filter_group_response = $this->model_integration_onlineshop_opencart->addFilterGroup($oc_filter_group_data);
				
				if (isset($oc_filter_group_response['filter_group_id'])) {
					$oc_filter_group_id = $oc_filter_group_response['filter_group_id'];
				} else {
					$json['error'] = 'Error';
					break;
				}
			}
			
			$oc_filters = $this->model_integration_onlineshop_opencart->getFilters($oc_filter_group_id);
			
			$vehicle_models	= $this->model_catalog_vehicle->getModels(array('filter_brand_id' => $vehicle_brand['id']));
			
			foreach ($vehicle_models as $vehicle_model) {
				if ($i < $start) {
					$i++;
					continue;
				}
				
				if ($i >= $start + $limit) {
					break 2;
				}
				
				$i++;
				
				foreach ($oc_filters as $oc_filter) {
					if ($oc_filter['name'] === $vehicle_model['name']) {
						continue 2;
					}
				}
				
				$oc_filter_data = array();
				
				foreach ($languages as $language) {
					$oc_filter_data['filter_description'][$language['code']]['name'] = $vehicle_model['name'];
				}
				
				$oc_filter_data['filter_group_id'] = $oc_filter_group_id;
				
				$oc_filter_response = $this->model_integration_onlineshop_opencart->addFilter($oc_filter_data);

				if (isset($oc_filter_response['filter_id'])) {
					$json['total']++;
				} else {
					$json['error'] = 'Error';
					break 2;
				}
			}
		}
		
		if ($i < $start + $limit) {
			$filters_data = array();
			
			$years = $this->model_catalog_vehicle4parts->getUserYears($this->user->getId());
			
			$gb_speed_levels = $this->model_catalog_vehicle->getGBSpeedLevels();

			foreach ($languages as $language) {
				$ln = new Language($language['code']);
				$ln->load('catalog/filter');
				
				$filters_data['quality']['filter_group']['translates'][$language['code']] = $ln->get('text_filter_quality');
				
				$filters_data['quality']['filter']['used']['translates'][$language['code']] = $ln->get('text_quality_used');
				$filters_data['quality']['filter']['new']['translates'][$language['code']] = $ln->get('text_quality_new');
				
				
				$filters_data['color']['filter_group']['translates'][$language['code']] = $ln->get('text_filter_color');
				
				$colors = $this->model_catalog_vehicle->getColors($language['language_id']);
		
				foreach ($colors as $color) {
					$filters_data['color']['filter'][$color['vehicle_color_id']]['translates'][$language['code']] = $color['text'];
				}
				
				
				$filters_data['transmission']['filter_group']['translates'][$language['code']] = $ln->get('text_filter_transmission');
				
				$transmissions = $this->model_catalog_vehicle->getTransmissions($language['language_id']);
		
				foreach ($transmissions as $transmission) {
					$filters_data['transmission']['filter'][$transmission['vehicle_transmission_id']]['translates'][$language['code']] = $transmission['text'];
				}
				
				
				$filters_data['drive']['filter_group']['translates'][$language['code']] = $ln->get('text_filter_drive');
				
				$drives = $this->model_catalog_vehicle->getDrives($language['language_id']);
		
				foreach ($drives as $drive) {
					$filters_data['drive']['filter'][$drive['vehicle_drive_id']]['translates'][$language['code']] = $drive['text'];
				}
				
				
				$filters_data['year']['filter_group']['translates'][$language['code']] = $ln->get('text_filter_year');
		
				foreach ($years as $year) {
					$filters_data['year']['filter'][$year['year']]['translates'][$language['code']] = $year['year'];
				}
				
				
				$filters_data['gb_speed_level']['filter_group']['translates'][$language['code']] = $ln->get('text_filter_gb_speed_level');
		
				foreach ($gb_speed_levels as $gb_speed_level) {
					$filters_data['gb_speed_level']['filter'][$gb_speed_level['vehicle_gb_speed_level_id']]['translates'][$language['code']] = $gb_speed_level['text'];
				}
			}


			foreach ($filters_data as $filter_data) {
				$oc_filter_group_id = 0;
				
				foreach ($oc_filter_groups as $oc_filter_group) {
					foreach ($filter_data['filter_group']['translates'] as $filter_group_name) {
						if (str_replace(array(' ', '-'), '', strtolower($oc_filter_group['name'])) === str_replace(array(' ', '-'), '', strtolower($filter_group_name))) {
							$oc_filter_group_id = $oc_filter_group['filter_group_id'];
							break 2;
						}
					}
				}
				
				if ($oc_filter_group_id == 0) {
					$oc_filter_group_data = array();
					
					foreach ($languages as $language) {
						$oc_filter_group_data['filter_group_description'][$language['code']]['name'] = $filter_data['filter_group']['translates'][$language['code']];
					}

					$oc_filter_group_response = $this->model_integration_onlineshop_opencart->addFilterGroup($oc_filter_group_data);
					
					if (isset($oc_filter_group_response['filter_group_id'])) {
						$oc_filter_group_id = $oc_filter_group_response['filter_group_id'];
					} else {
						$json['error'] = 'Error';
						break;
					}
				}
				
				$oc_filters = $this->model_integration_onlineshop_opencart->getFilters($oc_filter_group_id);
				
				foreach ($filter_data['filter'] as $filter) {
					if ($i < $start) {
						$i++;
						continue;
					}
					
					if ($i >= $start + $limit) {
						break 2;
					}
					
					$i++;
				
					foreach ($oc_filters as $oc_filter) {
						foreach ($filter['translates'] as $filter_name) {
							if ($oc_filter['name'] === $filter_name) {
								continue 3;
							}
						}				
					}
					
					$oc_filter_data = array();
					
					foreach ($languages as $language) {
						$oc_filter_data['filter_description'][$language['code']]['name'] = $filter['translates'][$language['code']];
					}
					
					$oc_filter_data['filter_group_id'] = $oc_filter_group_id;
					
					$oc_filter_response = $this->model_integration_onlineshop_opencart->addFilter($oc_filter_data);

					if (isset($oc_filter_response['filter_id'])) {
						$json['total']++;
					} else {
						$json['error'] = 'Error';
						break 2;
					}
				}
			}
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function getTotalFilters() {
		$json = array(
			'total' => 0
		);
		
		$this->load->model('catalog/vehicle');
		$this->load->model('catalog/vehicle4parts');
		
		$vehicle_brands = $this->model_catalog_vehicle->getBrands($this->user->getId());
		
		foreach ($vehicle_brands as $key => $vehicle_brand) {
			$json['total'] += $this->model_catalog_vehicle->getTotalModels(array('filter_brand_id' => $vehicle_brand['id']));		
		}
		
		$json['total'] += 2;
		
		$years = $this->model_catalog_vehicle4parts->getUserYears($this->user->getId());
		
		$json['total'] += count($years);;
		
		$colors = $this->model_catalog_vehicle->getColors();
		
		$json['total'] += count($colors);
		
		$transmissions = $this->model_catalog_vehicle->getTransmissions();
		
		$json['total'] += count($transmissions);
		
		$gb_speed_levels = $this->model_catalog_vehicle->getGBSpeedLevels();
		
		$json['total'] += count($gb_speed_levels);
		
		$drives = $this->model_catalog_vehicle->getDrives();
		
		$json['total'] += count($drives);	
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
