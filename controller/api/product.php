<?php
namespace Opencart\Catalog\Controller\Api;
class Product extends \Opencart\System\Engine\Controller {
	private $error = array();

	public function index() {
		$data = array();
		
		$data['message'] = 'Api Add is Working Now';
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($data));
	}
	
	public function add() {
		$data = array();
		
		$this->load->model('catalog/product');
		
		$this->load->language('catalog/product');
		
		if ($this->validateForm()) {
			if (!isset($this->request->post['price'])) {
				$this->request->post['price'] = 0;
			} else {
				$this->request->post['price'] = $this->currency->convert((float) $this->request->post['price'], $this->user->get('currency'), '0');
			}
			
			if (!isset($this->request->post['product_description']) or !is_array($this->request->post['product_description'])) {
				$this->request->post['product_description'] = array();
				
				$this->load->model('localisation/language');
			
				$languages = $this->model_localisation_language->getLanguages();
				
				foreach ($languages as $language) {
					$this->request->post['product_description'][$language['language_id']]['name'] = '';
					$this->request->post['product_description'][$language['language_id']]['description'] = '';
					$this->request->post['product_description'][$language['language_id']]['note'] = '';
				}
			}
			
			if (!isset($this->request->post['vehicle_position_id'])) {
				$this->request->post['vehicle_position_id'] = 0;
			}
			
			if (!isset($this->request->post['brand'])) {
				$this->request->post['brand'] = '';
			}
			
			if (!isset($this->request->post['mpn'])) {
				$this->request->post['mpn'] = '';
			}
			
			if (!isset($this->request->post['quantity'])) {
				$this->request->post['quantity'] = 0;
			}
			
			if (!isset($this->request->post['used'])) {
				$this->request->post['used'] = $this->user->get('default_product_used');
			}
			
			if ($this->user->get('catalog') === 'carparts') {
				$catalog = 'carparts';
			} else {
				$catalog = 'market';
			}
			
			if (!isset($this->request->post['warehouse_id'])) {
				$this->request->post['warehouse_id'] = 0;
			}

			$sku = $this->model_catalog_product->addProduct($this->user->getId(), $this->request->post, $catalog);
		  
			if ($sku) {
				$data['sku'] = $sku;
				$data['success'] = $this->language->get('text_success');
			} else {
				$data['sku'] = '';
				$data['success'] = '';
			}
		} else {
			$data['sku'] = '';
			$data['success'] = '';
		}

		if (isset($this->error['warning'])) {
			$data['error'] = $this->error['warning'];
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($data));
	}
	
	protected function validateForm($catalog = false) {
		if (!$catalog) {
			$catalog = $this->user->get('catalog');
		}

		if ($catalog === 'carparts') {
			return $this->carparts_validateForm();
		} else {
			return $this->market_validateForm();
		}
	}

	protected function market_validateForm() {
		if (!isset($this->request->post['sku']) or !preg_match('/^[a-zA-Z0-9]{3,10}$/', $this->request->post['sku'])) {
			$this->error['warning'] = $this->language->get('error_sku');
		} else {
			$product_id = $this->model_catalog_product->getProductIdBySku($this->user->getId(), $this->request->post['sku']);

			if ($product_id) {
				$this->error['warning'] = $this->language->get('error_sku_duplicate');
			}
		}
		
		if (isset($this->request->post['product_description']) and is_array($this->request->post['product_description'])) {
			$this->load->model('localisation/language');
		
			$languages = $this->model_localisation_language->getLanguages();
			
			if (count($this->request->post['product_description']) != count($languages)) {
				$this->error['warning'] = $this->language->get('error_warning');
			} else {
				foreach ($languages as $language) {
					if (!isset($this->request->post['product_description'][$language['language_id']]) or !is_array($this->request->post['product_description'][$language['language_id']])) {
						$this->error['warning'] = $this->language->get('error_warning');
						break;
					}
					
					$allowed_tags = array('<p', '</p>', '<ul', '</ul>', '<li', '</li>', '<br', '<b', '</b>', '<i', '</i>', '<span', '</span>', '<div', '</div>');
					
					if (!isset($this->request->post['product_description'][$language['language_id']]['name'])) {
						$this->error['warning'] = $this->language->get('error_warning');
						break;
					} else {
						if (preg_match('/\<(.*?)\>/', str_replace($allowed_tags, '', html_entity_decode($this->request->post['product_description'][$language['language_id']]['name'])))) {
							$this->error['warning'] = $this->language->get('error_tags');
							break;
						}
					}
					
					if (!isset($this->request->post['product_description'][$language['language_id']]['description'])) {
						$this->error['warning'] = $this->language->get('error_warning');
						break;
					} else {
						if (preg_match('/\<(.*?)\>/', str_replace($allowed_tags, '', html_entity_decode($this->request->post['product_description'][$language['language_id']]['description'])))) {
							$this->error['warning'] = $this->language->get('error_tags');
							break;
						}
					}
					
					if (!isset($this->request->post['product_description'][$language['language_id']]['note'])) {
						$this->error['warning'] = $this->language->get('error_warning');
						break;
					} else {
						if (preg_match('/\<(.*?)\>/', str_replace($allowed_tags, '', html_entity_decode($this->request->post['product_description'][$language['language_id']]['note'])))) {
							$this->error['warning'] = $this->language->get('error_tags');
							break;
						}
					}	
				}
			}
		}
		
		if (isset($this->request->post['product_image']) and (!is_array($this->request->post['product_image']) or count($this->request->post['product_image']) > 8)) {
			$this->error['warning'] = $this->language->get('error_image');
		} elseif (!empty($this->request->post['product_image'])) {
			foreach ($this->request->post['product_image'] as $image) {
				if (!file_exists(DIR_IMAGE . $image)) {
					$this->error['warning'] = $this->language->get('error_image');
					break;
				}
			}
		}
		
		if (isset($this->request->post['name_product']) and oc_strlen($this->request->post['name_product']) > 120) {
			$this->error['warning'] = $this->language->get('error_name_product');
		}
		
		if (isset($this->request->post['product_category'])) {
			if (!is_array($this->request->post['product_category']) or count($this->request->post['product_category']) > 10) {
				$this->error['warning'] = $this->language->get('error_product_category');
			} elseif (!empty($this->request->post['product_category'])) {
				$this->load->model('catalog/category');
				
				foreach ($this->request->post['product_category'] as $category_id) {
					$category_info = $this->model_catalog_category->getCategory($category_id);
					
					if (!$category_info) {
						$this->error['warning'] = $this->language->get('error_product_category');
						break;
					}
				}
			}
		}
		
		if (isset($this->request->post['vehicle_position_id']) and $this->request->post['vehicle_position_id'] != 0) {
			$this->load->model('catalog/vehicle');
			
			$vehicle_position_info = $this->model_catalog_vehicle->getPosition($this->request->post['vehicle_position_id']);
			
			if (!$vehicle_position_info) {
				$this->error['warning'] = $this->language->get('error_warning');
			}
		}
		
		if (isset($this->request->post['product_vehicle'])) {
			if (!is_array($this->request->post['product_vehicle'])) {
				$this->error['warning'] = $this->language->get('error_product_vehicle_array');
			} elseif (count($this->request->post['product_vehicle']) > 10) {
				$this->error['warning'] = $this->language->get('error_product_vehicle_count');
			} elseif (!empty($this->request->post['product_vehicle'])) {
				$this->load->model('catalog/vehicle');
				
				foreach ($this->request->post['product_vehicle'] as $vehicle_id) {
					$vehicle_info = $this->model_catalog_vehicle->getVehicle($vehicle_id);
					
					if (!$vehicle_info) {
						$this->error['warning'] = $this->language->get('error_product_vehicle_id');
						break;
					}
				}
			}
		}
		
		if (isset($this->request->post['product_vehicle4parts'])) {
			if (!is_array($this->request->post['product_vehicle4parts']) or count($this->request->post['product_vehicle4parts']) > 10) {
				$this->error['warning'] = $this->language->get('error_product_vehicle4parts');
			} elseif (!empty($this->request->post['product_vehicle4parts'])) {
				$this->load->model('catalog/vehicle4parts');
				
				foreach ($this->request->post['product_vehicle4parts'] as $vehicle4parts_sku) {
					$vehicle4parts_info = $this->model_catalog_vehicle4parts->getVehicle4Parts($this->user->getId(), $vehicle4parts_sku);
					
					if (!$vehicle4parts_info) {
						$this->error['warning'] = $this->language->get('error_product_vehicle4parts');
						break;
					}
				}
			}
		}
		
		if (isset($this->request->post['brand']) and oc_strlen($this->request->post['brand']) > 36) {
			$this->error['warning'] = $this->language->get('error_brand');
		}
		
		if (isset($this->request->post['mpn']) and oc_strlen($this->request->post['mpn']) > 24) {
			$this->error['warning'] = $this->language->get('error_mpn');
		}
		
		if (isset($this->request->post['quantity']) and oc_strlen($this->request->post['quantity']) > 4) {
			$this->error['warning'] = $this->language->get('error_quantity');
		}
		
		if (isset($this->request->post['price']) and oc_strlen($this->request->post['price']) > 10) {
			$this->error['warning'] = $this->language->get('error_price');
		}
		
		if (isset($this->request->post['ean']) and oc_strlen($this->request->post['ean']) > 14) {
			$this->error['warning'] = $this->language->get('error_ean');
		}
		
		if (isset($this->request->post['oe']) and oc_strlen($this->request->post['oe']) > 32) {
			$this->error['warning'] = $this->language->get('error_oe');
		}
		
		if (isset($this->request->post['others']) and oc_strlen($this->request->post['others']) > 128) {
			$this->error['warning'] = $this->language->get('error_others');
		}
		
		if (isset($this->request->post['location']) and oc_strlen($this->request->post['location']) > 64) {
			$this->error['warning'] = $this->language->get('error_location');
		}
		
		if (isset($this->request->post['weight']) and oc_strlen($this->request->post['weight']) > 15) {
			$this->error['warning'] = $this->language->get('error_weight');
		}
		
		if (isset($this->request->post['used']) and (($this->request->post['used'] != '1') and ($this->request->post['used'] != '0'))) {
			$this->error['warning'] = $this->language->get('error_used');
		}
		
		if (isset($this->request->post['warehouse_id']) and oc_strlen($this->request->post['warehouse_id']) > 11) {
			$this->error['warning'] = $this->language->get('error_warehouse');
		}

		return !$this->error;
	}
	
	protected function carparts_validateForm() {
		if (!isset($this->request->post['sku']) or !preg_match('/^[a-zA-Z0-9]{3,10}$/', $this->request->post['sku'])) {
			$this->error['warning'] = $this->language->get('error_sku');
		} else {
			$product_id = $this->model_catalog_product->getProductIdBySku($this->user->getId(), $this->request->post['sku']);

			if ($product_id) {
				$this->error['warning'] = $this->language->get('error_sku_duplicate');
			}
		}
		
		if (isset($this->request->post['mpn']) and (oc_strlen($this->request->post['mpn']) < 3 or oc_strlen($this->request->post['mpn']) > 24)) {
			$this->error['warning'] = $this->language->get('error_mpn');
		}
		
		if (!empty($this->request->post['brand'])) {
			$this->load->model('catalog/brand');
			
			if (!$this->model_catalog_brand->getBrandCodeByName($this->request->post['brand'])) {
				$this->error['warning'] = $this->language->get('error_brand');
			}
		} else {
			$this->error['warning'] = $this->language->get('error_brand');
		}
		
		if (isset($this->request->post['quantity']) and oc_strlen(trim($this->request->post['quantity'])) > 4) {
			$this->error['warning'] = $this->language->get('error_quantity');
		}
		
		if (isset($this->request->post['price']) and oc_strlen(trim($this->request->post['price'])) > 10) {
			$this->error['warning'] = $this->language->get('error_price');
		}
		
		if (isset($this->request->post['location']) and oc_strlen(trim($this->request->post['location'])) > 64) {
			$this->error['warning'] = $this->language->get('error_location');
		}
		
		if (isset($this->request->post['delivery']) and oc_strlen(trim($this->request->post['delivery'])) > 4) {
			$this->error['warning'] = $this->language->get('error_delivery');
		}

		return !$this->error;
	}
	
	public function getCategories()	{
		$data = array();
		
		$this->load->model('catalog/category');
		
		$data = $this->model_catalog_category->getCategories($this->user->getId());
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($data));
	}

	public function getVehicles() {
		$data = array();
		
		$this->load->model('catalog/vehicle');
	
		$data = $this->model_catalog_vehicle->getVehicles();
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($data));
	}

	public function getVehicles4Parts() {
		$data = array();
		
		$this->load->model('catalog/vehicle4parts');
		
		$data = $this->model_catalog_vehicle4parts->getVehicles4Parts($this->user->getId());
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($data));
	}
	
	public function uploadImage() {
		$json = array();
		
		$this->load->language('catalog/product');

		if (isset($this->request->files['file'])) {
			$content = file_get_contents($this->request->files['file']['tmp_name']);

			if (preg_match('/\<\?php/i', $content)) {
				$json['error'] = $this->language->get('error_image');
			}
			
			if ($this->request->files['file']['size'] > 25000000) {
				$json['error'] = $this->language->get('error_image');
			}
			
			$mime = mime_content_type($this->request->files['file']['tmp_name']);
			
			switch($mime) {
				case 'image/jpeg':
					break;
				default:
					$json['error'] = $this->language->get('error_image');
			}
		} else {
			$json['error'] = $this->language->get('error_image');
		}
		
		if (!isset($json['error'])) {
			$name_exp = explode('.', $this->request->files['file']['name']);
			$file_name = time() . rand(100, 900) . $this->user->getId() . '.' . end($name_exp);
			
			list($width_orig, $height_orig, $image_type) = getimagesize($this->request->files['file']['tmp_name']);
		
			$image = new \Opencart\System\Library\Image($this->request->files['file']['tmp_name']);
			
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
			
			$image->save(DIR_IMAGE_PRODUCT . $file_name);
			
			unset($image);
			
			$json['image'] = DIR_IMAGE_PRODUCT_NAME . $file_name;
			$json['path'] = HTTP_SERVER . DIR_IMAGE_PRODUCT_RELATIVE . $file_name;	
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function autocompleteSearch() {
		$json = array();
		
		if (isset($this->request->get['search']) && $this->request->get['search']) {
			$filter_data = array(
				'filter_name' => $this->request->get['search'],
				'start' => '0',
				'limit' => '15',
			);
			
			$this->load->model('catalog/category');
			
			$categories = $this->model_catalog_category->getCategories($this->user->getId(), $filter_data);
			
			if (!$categories) {
				$this->load->model('catalog/product');
				
				$products = $this->model_catalog_product->autocompleate($this->user->getId(), $this->request->get['search']);
				
				foreach ($products as $product) {
					$json[] = array(
						'name' => $product['name'],
						'sku' => $product['sku'],
					);
				}
			} else {
				foreach ($categories as $category) {
					$json[] = array('name' => $category['name']);
				}
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
