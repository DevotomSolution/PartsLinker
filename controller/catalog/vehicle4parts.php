<?php
namespace Opencart\Catalog\Controller\Catalog;
class Vehicle4parts extends \Opencart\System\Engine\Controller {
	private $error = array();

	public function index() {
		$this->load->model('catalog/vehicle4parts');
		$this->load->model('catalog/vehicle');
		$this->load->model('catalog/warehouse');
		$this->load->model('tool/image');
		
		$this->load->language('catalog/vehicle4parts');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->getList();
	}

	public function add() {
		$this->load->model('catalog/vehicle4parts');
		$this->load->model('catalog/vehicle');
		
		$this->load->language('catalog/vehicle4parts');

		$this->document->setTitle($this->language->get('heading_title'));

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->request->post['price'] = $this->currency->convert((float) $this->request->post['price'], $this->user->get('currency'), '0');
			
			$this->request->post['vehicle_id'] = $this->model_catalog_vehicle->getVehicleByModel($this->request->post['model_id'])['vehicle_id'];

			$sku = $this->model_catalog_vehicle4parts->addVehicle4Parts($this->user->getId(), $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';
			
			$url .= '&user_token=' . $this->session->data['user_token'];

			if (isset($this->request->get['search'])) {
				$url .= '&search=' . urlencode(html_entity_decode($this->request->get['search'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['warehouse_id'])) {
				$url .= '&warehouse_id=' . $this->request->get['warehouse_id'];
			}
			
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			
			$url .= '&vehicle4parts=' . $sku;
			
			$this->session->data['alerts'] = $this->onlineshopSyncVehicle4Parts($sku);
			
			$this->response->redirect($this->url->link('info/label', $url, true));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->model('catalog/vehicle4parts');
		$this->load->model('catalog/vehicle');
		
		$this->load->language('catalog/vehicle4parts');

		$this->document->setTitle($this->language->get('heading_title'));

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->request->post['price'] = $this->currency->convert((float) $this->request->post['price'], $this->user->get('currency'), '0');
			
			$this->request->post['vehicle_id'] = $this->model_catalog_vehicle->getVehicleByModel($this->request->post['model_id'])['vehicle_id'];
			
			$this->model_catalog_vehicle4parts->editVehicle4Parts($this->user->getId(), $this->request->get['vehicle4parts'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';
			
			$url .= '&user_token=' . $this->session->data['user_token'];

			if (isset($this->request->get['search'])) {
				$url .= '&search=' . urlencode(html_entity_decode($this->request->get['search'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['warehouse_id'])) {
				$url .= '&warehouse_id=' . $this->request->get['warehouse_id'];
			}
			
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			
			$this->session->data['alerts'] = $this->onlineshopSyncVehicle4Parts($this->request->get['vehicle4parts']);

			$this->response->redirect($this->url->link('catalog/vehicle4parts', $url, true));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->model('catalog/vehicle4parts');
		
		$this->load->language('catalog/vehicle4parts');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->model_catalog_vehicle4parts->deleteVehicle4Parts($this->user->getId(), $this->request->get['vehicle4parts']);
		
		$this->session->data['success'] = $this->language->get('text_success');

		$url = '';
		
		$url .= '&user_token=' . $this->session->data['user_token'];

		if (isset($this->request->get['search'])) {
			$url .= '&search=' . urlencode(html_entity_decode($this->request->get['search'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['warehouse_id'])) {
			$url .= '&warehouse_id=' . $this->request->get['warehouse_id'];
		}
		
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		$this->session->data['alerts'] = $this->onlineshopSyncVehicle4Parts($this->request->get['vehicle4parts']);

		$this->response->redirect($this->url->link('catalog/vehicle4parts', $url, true));
	}

	protected function getList() {
		$limit = 20;
		
		if (isset($this->error['warning'])) {
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
		
		$this->load->language('catalog/vehicle4partst');
		
		if (isset($this->request->get['search'])) {
			$search = urlencode(html_entity_decode($this->request->get['search'], ENT_QUOTES, 'UTF-8'));
		} else {
			$search = '';
		}

		if (isset($this->request->get['warehouse_id'])) {
			$warehouse_id = (int)$this->request->get['warehouse_id'];
		} else {
			$warehouse_id = '';
		}
		
		if (isset($this->request->get['page'])) {
			$page = (int)$this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';
		
		$url .= '&user_token=' . $this->session->data['user_token'];

		if (isset($this->request->get['search'])) {
			$url .= '&search=' . urlencode(html_entity_decode($this->request->get['search'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['warehouse_id'])) {
			$url .= '&warehouse_id=' . $this->request->get['warehouse_id'];
		}
		
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['add'] = $this->url->link('catalog/vehicle4parts.add', $url, true);
		$data['product'] = $this->url->link('catalog/product', $url, true);
		$data['warehouse'] = $this->url->link('catalog/warehouse', $url, true);
		
		$filter_data = array(
			'start'					=> ($page - 1) * $limit,
			'limit'					=> $limit,
			'search'				=> $search,
			'filter_warehouse_id'	=> $warehouse_id,
		);

		$vehicle_total = $this->model_catalog_vehicle4parts->getTotalVehicles4Parts($this->user->getId(), $filter_data);

		$results = $this->model_catalog_vehicle4parts->getVehicles4Parts($this->user->getId(), $filter_data);
		
		$data['vehicle4parts'] = array();

		foreach ($results as $result) {
			if (is_file(DIR_IMAGE . $result['image'])) {
				$image_min = $this->model_tool_image->resize($result['image'], 60, 60);
			} else {
				$image_min = $this->model_tool_image->resize('no_image.png', 60, 60);
			}
			
			$title = oc_substr($result['title'], 0, 128);
			
			if (mb_strlen($result['title']) > 128) {
				$title .= '...';
			}
			
			$title_min = oc_substr($result['title'], 0, 64);
			
			if (mb_strlen($result['title']) > 64) {
				$title_min .= '...';
			}
			
			$data['vehicles4parts'][] = array(
				'sku'			=> $result['sku'],
				'title'         => $title,
				'title_min'     => $title_min,
				'image'			=> HTTP_SERVER . DIR_IMAGE_RELATIVE . $result['image'],
				'image_min'     => $image_min,
				'label_url'     => $this->url->link('info/label', 'vehicle4parts=' . $result['sku'] . $url, true),
				'edit'          => $this->url->link('catalog/vehicle4parts.edit', 'vehicle4parts=' . $result['sku'] . $url, true),
				'delete'        => $this->url->link('catalog/vehicle4parts.delete', 'vehicle4parts=' . $result['sku'] . $url, true),
				'list_products' => $this->url->link('catalog/product', 'user_token=' . $this->session->data['user_token'] . '&filter_vehicle4parts=' . $result['sku'], true),
				'add_product'   => $this->url->link('catalog/product.add', 'user_token=' . $this->session->data['user_token'] . '&vehicle4parts=' . $result['sku'], true),
				'link'			=> $result['link'],
				'files'			=> $this->model_catalog_vehicle4parts->getVehicle4PartsFiles($this->user->getId(), $result['sku']),
			);
		}

		$url = '';
		
		$url .= '&user_token=' . $this->session->data['user_token'];

		if (isset($this->request->get['warehouse_id'])) {
			$url .= '&warehouse_id=' . $this->request->get['warehouse_id'];
		}
		
		if (isset($this->request->get['search'])) {
			$url .= '&search=' . urlencode(html_entity_decode($this->request->get['search'], ENT_QUOTES, 'UTF-8'));
		}
		
		$data['pagination'] = $this->load->controller('common/pagination', [
			'total' => $vehicle_total,
			'page'  => $page,
			'limit' => $limit,
			'url'   => $this->url->link('catalog/vehicle4parts', 'user_token=' . $this->session->data['user_token'] . $url . '&page={page}')
		]);

		$data['results'] = sprintf($this->language->get('text_pagination'), ($vehicle_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($vehicle_total - $limit)) ? $vehicle_total : ((($page - 1) * $limit) + $limit), $vehicle_total, ceil($vehicle_total / $limit));
		
		$data['search'] = $search;
		$data['warehouse_id'] = $warehouse_id;
		
		$data['warehouses'] = $this->model_catalog_warehouse->getWarehouses($this->user->getId());

		$data['user_token'] = $this->session->data['user_token'];
		
		$data['dir_upload'] = DIR_UPLOAD_RELATIVE;
		
		$this->document->addScript(HTTP_SERVER . 'view/js/magnific/jquery.magnific-popup.min.js', 'footer');
		$this->document->addStyle(HTTP_SERVER . 'view/js/magnific/magnific-popup.css', 'stylesheet', 'screen', 'footer');
		
		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['navigation'] = $this->load->controller('common/navigation');
		
		$this->response->setOutput($this->load->view('catalog/vehicle4parts_list', $data));
	}

	protected function getForm() {
		$this->load->model('catalog/product');
		$this->load->model('catalog/warehouse');
		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['brand'])) {
			$data['error_brand'] = $this->error['brand'];
		} else {
			$data['error_brand'] = array();
		}

		$url = '';
		
		$url .= '&user_token=' . $this->session->data['user_token'];

		if (isset($this->request->get['search'])) {
			$url .= '&search=' . $this->request->get['search'];
		}
		
		if (isset($this->request->get['warehouse_id'])) {
			$url .= '&warehouse_id=' . $this->request->get['warehouse_id'];
		}
		
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		if (!isset($this->request->get['vehicle4parts'])) {
			$data['action'] = $this->url->link('catalog/vehicle4parts.add', $url, true);
		} else {
			$data['action'] = $this->url->link('catalog/vehicle4parts.edit', 'vehicle4parts=' . $this->request->get['vehicle4parts'] . $url, true);
		}

		$data['cancel'] = $this->url->link('catalog/vehicle4parts', $url, true);

		if (isset($this->request->get['vehicle4parts'])) {
			$vehicle_info = $this->model_catalog_vehicle4parts->getVehicle4Parts($this->user->getId(), $this->request->get['vehicle4parts']);
			
			if (!$vehicle_info) {
				$this->response->redirect($this->url->link('catalog/vehicle4parts', $url, true));
			}
			
			$data['new'] = false;
		} else {
			$data['new'] = true;
		}
		
		if (isset($this->request->post['sku'])) {
			$data['sku'] = $this->request->post['sku'];
		} elseif (!empty($vehicle_info)) {
			$data['sku'] = $vehicle_info['sku'];
		} else {
			$data['sku'] = $this->model_catalog_vehicle4parts->getNewSku($this->user->getId());
		}
		
		if (isset($this->request->post['vehicle4parts_description'])) {
			$data['vehicle4parts_description'] = $this->request->post['vehicle4parts_description'];
		} elseif (!empty($vehicle_info)) {
			$data['vehicle4parts_description'] = $this->model_catalog_vehicle4parts->getVehicle4PartsDescription($this->user->getId(), $vehicle_info['sku']);
		} else {
			$data['vehicle4parts_description'] = array();
		}
		
		if (isset($this->request->post['note'])) {
			$data['note'] = $this->request->post['note'];
		} elseif (!empty($vehicle_info)) {
			$data['note'] = $vehicle_info['note'];
		} else {
			$data['note'] = '';
		}
		
		if (!empty($vehicle_info)) {
			$currency_code = $this->user->get('currency');
		
			$product_list = $this->model_catalog_vehicle4parts->getProductList($this->user->getId(), $vehicle_info['sku']);
			
			foreach($product_list as $key => $product) {
				$product_list[$key]['price'] = $this->currency->format($this->currency->convert($product['price'], '0', $currency_code), $currency_code, 1);
				$product_list[$key]['link'] = $this->url->link('catalog/product.edit', 'user_token=' . $this->session->data['user_token'] . '&product=' . $product['sku'], true);
			}
			
			$data['product_list'] = $product_list;
		} else {
			$data['product_list'] = '';
		}
		
		$data['brands'] = $this->model_catalog_vehicle->getBrands($this->user->getId());

		if (isset($this->request->post['brand_id'])) {
			$data['brand_id'] = $this->request->post['brand_id'];
		} elseif (!empty($vehicle_info)) {
			$brand = $this->model_catalog_vehicle->getBrandByVehicleId($vehicle_info['vehicle_id']);

			if (isset($brand['id'])) {
				$data['brand_id'] = $brand['id'];
			} else {
				$data['brand_id'] = '';
			}
		} else {
			$data['brand_id'] = '';
		}
		
		if ($data['brand_id']) {
			$data['models'] = $this->model_catalog_vehicle->getModels(array('filter_brand_id' => $data['brand_id']));
		}
		
		if (isset($this->request->post['model_id'])) {
			$data['model_id'] = $this->request->post['model_id'];
		} elseif (!empty($vehicle_info)) {
			$current_model = $this->model_catalog_vehicle->getModelByVehicleId($vehicle_info['vehicle_id']);
			
			if (isset($current_model['id'])) {
				$data['model_id'] = $current_model['id'];
			} else {
				$data['model_id'] = '';
			}
		} else {
			$data['model_id'] = '';
		}
		
		if (isset($this->request->post['engine_id'])) {
			$data['engine_id'] = $this->request->post['engine_id'];
		} elseif (!empty($vehicle_info)) {
			$data['engine_id'] = $vehicle_info['engine_id'];
		} else {
			$data['engine_id'] = '';
		}
		
		if ($data['model_id']) {
			$data['engines'] = $this->model_catalog_vehicle->getEngines(array('filter_model_id' => $data['model_id']));
		} else {
			$data['engines'] = array();
		}
		
		if (isset($this->request->post['engine_code'])) {
			$data['engine_code'] = $this->request->post['engine_code'];
		} elseif (!empty($vehicle_info)) {
			$data['engine_code'] = $vehicle_info['engine_code'];
		} else {
			$data['engine_code'] = '';
		}
		
		if (isset($this->request->post['year'])) {
			$data['year'] = $this->request->post['year'];
		} elseif (!empty($vehicle_info)) {
			$data['year'] = $vehicle_info['year'];
		} else {
			$data['year'] = '';
		}
		
		if (isset($this->request->post['win'])) {
			$data['win'] = $this->request->post['win'];
		} elseif (!empty($vehicle_info)) {
			$data['win'] = $vehicle_info['win'];
		} else {
			$data['win'] = '';
		}
		
		$data['colors'] = $this->model_catalog_vehicle->getColors();
		
		if (isset($this->request->post['color_id'])) {
			$data['color_id'] = $this->request->post['color_id'];
		} elseif (!empty($vehicle_info)) {
			$data['color_id'] = $vehicle_info['color_id'];
		} else {
			$data['color_id'] = '';
		}
		
		if (isset($this->request->post['color_code'])) {
			$data['color_code'] = $this->request->post['color_code'];
		} elseif (!empty($vehicle_info)) {
			$data['color_code'] = $vehicle_info['color_code'];
		} else {
			$data['color_code'] = '';
		}
		
		$data['transmissions'] = $this->model_catalog_vehicle->getTransmissions();
		
		if (isset($this->request->post['transmission_id'])) {
			$data['transmission_id'] = $this->request->post['transmission_id'];
		} elseif (!empty($vehicle_info)) {
			$data['transmission_id'] = $vehicle_info['transmission_id'];
		} else {
			$data['transmission_id'] = '';
		}
		
		$data['drives'] = $this->model_catalog_vehicle->getDrives();
		
		if (isset($this->request->post['drive_id'])) {
			$data['drive_id'] = $this->request->post['drive_id'];
		} elseif (!empty($vehicle_info)) {
			$data['drive_id'] = $vehicle_info['drive_id'];
		} else {
			$data['drive_id'] = '';
		}
		
		if (isset($this->request->post['gb_code'])) {
			$data['gb_code'] = $this->request->post['gb_code'];
		} elseif (!empty($vehicle_info)) {
			$data['gb_code'] = $vehicle_info['gb_code'];
		} else {
			$data['gb_code'] = '';
		}
		
		$data['gb_speed_levels'] = $this->model_catalog_vehicle->getGBSpeedLevels();
		
		if (isset($this->request->post['gb_speed_level'])) {
			$data['gb_speed_level'] = $this->request->post['gb_speed_level'];
		} elseif (!empty($vehicle_info)) {
			$data['gb_speed_level'] = $vehicle_info['gb_speed_level'];
		} else {
			$data['gb_speed_level'] = '';
		}
		
		if (isset($this->request->post['km'])) {
			$data['km'] = $this->request->post['km'];
		} elseif (!empty($vehicle_info)) {
			$data['km'] = $vehicle_info['km'];
		} else {
			$data['km'] = '';
		}
		
		if (isset($this->request->post['price'])) {
			$data['price'] = $this->request->post['price'];
		} elseif (!empty($vehicle_info)) {
			$data['price'] = $vehicle_info['price'];
		} else {
			$data['price'] = 0;
		}
		
		if (isset($this->request->post['warehouse_id'])) {
			$data['warehouse_id'] = $this->request->post['warehouse_id'];
		} elseif (!empty($vehicle_info)) {
			$data['warehouse_id'] = $vehicle_info['warehouse_id'];
		} elseif (isset($this->request->get['warehouse_id'])) {
			$data['warehouse_id'] = $this->request->get['warehouse_id'];
		} else {
			$data['warehouse_id'] = '';
		}
		
		if (isset($this->request->post['title'])) {
			$data['vehicle4parts_title'] = $this->request->post['title'];
		} elseif (!empty($vehicle_info)) {
			$data['vehicle4parts_title'] = $vehicle_info['title'];
		} else {
			$data['vehicle4parts_title'] = '';
		}
		
		$data['vehicle4parts_images'] = array();
		
		if (isset($this->request->post['vehicle4parts_image'])) {
			foreach($this->request->post['vehicle4parts_image'] as $image) {
				$data['vehicle4parts_images'][] = array(
					'image' => $image,
					'path' => HTTP_SERVER . DIR_IMAGE_RELATIVE . $image,
				);
			}
		} elseif (!empty($vehicle_info)) {
			if ($vehicle_info['image']) {
				$data['vehicle4parts_images'][] = array(
					'image' => $vehicle_info['image'],
					'path' => HTTP_SERVER . DIR_IMAGE_RELATIVE . $vehicle_info['image'],
				);
			}
			
			$images = $this->model_catalog_vehicle4parts->getVehicle4PartsImages($this->user->getId(), $this->request->get['vehicle4parts']);
			
			foreach($images as $image) {
				$data['vehicle4parts_images'][] = array(
					'image' => $image['image'],
					'path' => HTTP_SERVER . DIR_IMAGE_RELATIVE . $image['image'],
				);
			}
		}
		
		if (isset($this->request->post['vehicle4parts_video'])) {
			$data['vehicle4parts_video'] = array(
				'video' => $this->request->post['vehicle4parts_video']['video'],
				'mime' => $this->request->post['vehicle4parts_video']['mime'],
				'path' => HTTP_SERVER . DIR_IMAGE_RELATIVE . $this->request->post['vehicle4parts_video']['video'],
			);
		} elseif (!empty($vehicle_info)) {
			$video = $this->model_catalog_vehicle4parts->getVehicle4PartsVideo($this->user->getId(), $this->request->get['vehicle4parts']);

			if ($video) {
				$data['vehicle4parts_video'] = array(
					'video' => $video['video'],
					'mime' => $video['mime'],
					'path' => HTTP_SERVER . DIR_IMAGE_RELATIVE . $video['video'],
				);
			} else {
				$data['vehicle4parts_video'] = false;
			}
		} else {
			$data['vehicle4parts_video'] = false;
		}
		
		$this->load->model('localisation/language');
		
		$data['languages'] = $this->model_localisation_language->getLanguages();
		
		$data['user_language'] = $this->user->get('language_id');
		
		$data['translates'] = array();
		
		foreach($data['languages'] as $language) {
			$ln = new \Opencart\System\Library\Language($language['code']);
			
			$ln->addPath(DIR_LANGUAGE);
			$ln->load('catalog/vehicle4parts');
			
			$data['translates'][$language['language_id']] = $ln->all();
		}
		
		$data['user_token'] = $this->session->data['user_token'];
		
		$data['warehouses'] = $this->model_catalog_warehouse->getWarehouses($this->user->getId());
		
		$this->document->addScript(HTTP_SERVER . 'view/js/magnific/jquery.magnific-popup.min.js', 'footer');
		$this->document->addStyle(HTTP_SERVER . 'view/js/magnific/magnific-popup.css', 'stylesheet', 'screen', 'footer');
		
		$this->document->addScript('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js', 'footer');
		$this->document->addStyle('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css', 'stylesheet', 'screen', 'footer');

		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['navigation'] = $this->load->controller('common/navigation');
		
		$data['MAX_IMAGE_WIDTH'] = MAX_IMAGE_WIDTH;
		$data['MAX_IMAGE_HEIGHT'] = MAX_IMAGE_HEIGHT;

		$this->response->setOutput($this->load->view('catalog/vehicle4parts_form', $data));
	}
	
	protected function validateForm() {
		$this->load->model('catalog/vehicle');
		
		if (!isset($this->request->get['vehicle4parts'])) {
			if (!isset($this->request->post['sku']) or !preg_match('/^[a-zA-Z0-9]{3,10}$/', $this->request->post['sku'])) {
				$this->error['warning'] = $this->language->get('error_sku');
			} else {
				$vehicle4parts_id = $this->model_catalog_vehicle4parts->getVehicle4PartsIdBySku($this->user->getId(), $this->request->post['sku']);

				if ($vehicle4parts_id) {
					$this->error['warning'] = $this->language->get('error_sku_duplicate');
				}
			}
		}
		
		if (empty($this->request->post['model_id'])) {
			$this->error['warning'] = $this->language->get('error_model');
			
			return !$this->error;
		} else {
			if (!$this->model_catalog_vehicle->getVehicleByModel($this->request->post['model_id'])) {
				$this->error['warning'] = $this->language->get('error_model');
				
				return !$this->error;
			}
		}
		
		if (isset($this->request->post['vehicle4parts_image']) and (!is_array($this->request->post['vehicle4parts_image']) or count($this->request->post['vehicle4parts_image']) > 8)) {
			$this->error['warning'] = $this->language->get('error_warning');
		} elseif (!empty($this->request->post['vehicle4parts_image'])) {
			foreach ($this->request->post['vehicle4parts_image'] as $image) {
				if (!file_exists(DIR_IMAGE . $image)) {
					$this->error['warning'] = $this->language->get('error_warning');
					break;
				}
			}
		}
		
		if (!empty($this->request->post['vehicle4parts_video'])) {
			if (empty($this->request->post['vehicle4parts_video']['mime']) or (oc_strlen($this->request->post['vehicle4parts_video']['mime']) > 32) or empty($this->request->post['vehicle4parts_video']['video'])) {
				$this->error['warning'] = $this->language->get('error_warning');
			}
			
			if (!file_exists(DIR_IMAGE . $this->request->post['vehicle4parts_video']['video'])) {
				$this->error['warning'] = $this->language->get('error_warning');
			}
		}
		
		$this->load->model('localisation/language');
		
		$languages = $this->model_localisation_language->getLanguages();
		
		if (count($this->request->post['vehicle4parts_description']) != count($languages)) {
			$this->error['warning'] = $this->language->get('error_warning');
		}
		
		foreach($languages as $language) {
			$allowed_tags = array('<p', '</p>', '<ul', '</ul>', '<li', '</li>', '<br', '<b', '</b>', '<i', '</i>', '<span', '</span>', '<div', '</div>');
			
			if (!isset($this->request->post['vehicle4parts_description'][$language['language_id']]['title'])) {
				$this->error['warning'] = $this->language->get('error_note');
			} else {
				if (preg_match('/\<(.*?)\>/', str_replace($allowed_tags, '', html_entity_decode($this->request->post['vehicle4parts_description'][$language['language_id']]['title'])))) {
					$this->error['warning'] = $this->language->get('error_tags');
				}
			}
			
			if (!isset($this->request->post['vehicle4parts_description'][$language['language_id']]['note'])) {
				$this->error['warning'] = $this->language->get('error_note');
			} else {
				if (preg_match('/\<(.*?)\>/', str_replace($allowed_tags, '', html_entity_decode($this->request->post['vehicle4parts_description'][$language['language_id']]['note'])))) {
					$this->error['warning'] = $this->language->get('error_tags');
				}
			}

			if (!isset($this->request->post['vehicle4parts_description'][$language['language_id']]['specifications'])) {
				$this->error['warning'] = $this->language->get('error_specifications');
			} else {
				if (preg_match('/\<(.*?)\>/', str_replace($allowed_tags, '', html_entity_decode($this->request->post['vehicle4parts_description'][$language['language_id']]['specifications'])))) {
					$this->error['warning'] = $this->language->get('error_tags');
				}
			}
		}
		
		if (!isset($this->request->post['win']) or oc_strlen($this->request->post['win']) > 32) {
			$this->error['warning'] = $this->language->get('error_win');
		}
		
		if (!isset($this->request->post['color_id'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		} elseif (!empty($this->request->post['color_id'])) {
			$color_info = $this->model_catalog_vehicle->getColor($this->request->post['color_id']);
			
			if (!$color_info) {
				$this->error['warning'] = $this->language->get('error_warning');
			}
		}
		
		if (!isset($this->request->post['color_code']) or oc_strlen($this->request->post['color_code']) > 32) {
			$this->error['warning'] = $this->language->get('error_color_code');
		}
		
		if (!isset($this->request->post['engine_id'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		} elseif (!empty($this->request->post['engine_id'])) {
			$engine_info = $this->model_catalog_vehicle->getEngine($this->request->post['engine_id']);
			
			if (!$engine_info) {
				$this->error['warning'] = $this->language->get('error_warning');
			}
		}
		
		if (!isset($this->request->post['engine_code']) or oc_strlen($this->request->post['engine_code']) > 64) {
			$this->error['warning'] = $this->language->get('error_engine_code');
		}
		
		if (!isset($this->request->post['year']) or (int) $this->request->post['year'] > 9999) {
			$this->error['warning'] = $this->language->get('error_year');
		}
		
		if (!isset($this->request->post['transmission_id'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		} elseif (!empty($this->request->post['transmission_id'])) {
			$transmission_info = $this->model_catalog_vehicle->getTransmission($this->request->post['transmission_id']);
			
			if (!$transmission_info) {
				$this->error['warning'] = $this->language->get('error_warning');
			}
		}
		
		if (!isset($this->request->post['gb_code']) or oc_strlen($this->request->post['gb_code']) > 64) {
			$this->error['warning'] = $this->language->get('error_gb_code');
		}
		
		if (!isset($this->request->post['gb_speed_level'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		} elseif (!empty($this->request->post['gb_speed_level'])) {
			$gb_speed_level_info = $this->model_catalog_vehicle->getGBSpeedLevel($this->request->post['gb_speed_level']);
			
			if (!$gb_speed_level_info) {
				$this->error['warning'] = $this->language->get('error_warning');
			}
		}
		
		if (!isset($this->request->post['drive_id'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		} elseif (!empty($this->request->post['drive_id'])) {
			$drive_info = $this->model_catalog_vehicle->getDrive($this->request->post['drive_id']);
			
			if (!$drive_info) {
				$this->error['warning'] = $this->language->get('error_warning');
			}
		}
		
		if (!isset($this->request->post['km']) or (int) $this->request->post['km'] > 999999) {
			$this->error['warning'] = $this->language->get('error_km');
		}
		
		if (!isset($this->request->post['price']) or (int) $this->request->post['price'] > 999999) {
			$this->error['warning'] = $this->language->get('error_price');
		}
		
		if (!isset($this->request->post['warehouse_id'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}

		return !$this->error;
	}
	
	protected function onlineshopSyncVehicle4Parts($sku) {
		$responce = array();
		
		$this->load->model('integration/onlineshop/onlineshop');
		
		$sync_responce = $this->model_integration_onlineshop_onlineshop->syncVehicle4Parts($this->user->getId(), $sku);
		
		foreach($sync_responce as $onlineshop_response) {
			if ($onlineshop_response['success']) {
				$responce[] = array('type' => 'success', 'title' => $onlineshop_response['title'], 'alert' => $onlineshop_response['message']);
			} else {
				$responce[] = array('type' => 'danger', 'title' => $onlineshop_response['title'], 'alert' => $onlineshop_response['message']);
			}
		}
		
		return $responce;
	}
	
	public function getModels() {
		$json = array();
		
		if (!empty($this->request->get['brand_id'])) {
			$this->load->model('catalog/vehicle');
			
			$json = $this->model_catalog_vehicle->getModels(array('filter_brand_id' => $this->request->get['brand_id']));
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function getEngines() {
		$json = array();
		
		if (!empty($this->request->get['model_id'])) {
			$this->load->model('catalog/vehicle');
			
			$json = $this->model_catalog_vehicle->getEngines(array('filter_model_id' => $this->request->get['model_id']));
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function uploadVideo() {
		$json = array();
		
		$this->load->language('catalog/vehicle4partst');

		if (isset($this->request->files['file'])) {
			$content = file_get_contents($this->request->files['file']['tmp_name']);

			if (preg_match('/\<\?php/i', $content)) {
				$json['error'] = $this->language->get('error_warning');
			}
			
			if ($this->request->files['file']['size'] > 50000000) {
				$json['error'] = $this->language->get('error_video_size');
			}
			
			$mime = mime_content_type($this->request->files['file']['tmp_name']);
			
			switch($mime) {
				case 'video/mp4':
				case 'video/webm':
				case 'video/ogg':
				case 'video/quicktime':
				case 'video/x-m4v':
					break;
				default:
					$json['error'] = sprintf($this->language->get('error_file_type'), $mime);
			}
		} else {
			$json['error'] = $this->language->get('error_warning');
		}

		if (!isset($json['error'])) {
			$name_exp = explode('.', $this->request->files['file']['name']);
			$file_name = time() . rand(100, 900) . $this->user->getId() . '.' . end($name_exp);
			
			move_uploaded_file($this->request->files['file']['tmp_name'], DIR_IMAGE_VEHICLE4PARTS . $file_name);
			
			$json['video'] = DIR_IMAGE_VEHICLE4PARTS_NAME . $file_name;
			$json['path'] = HTTP_SERVER . DIR_IMAGE_VEHICLE4PARTS_RELATIVE . $file_name;
			$json['mime'] = $mime;
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function uploadImage() {
		$json = array();
		
		$this->load->language('catalog/vehicle4partst');

		if (isset($this->request->files['file'])) {
			$content = file_get_contents($this->request->files['file']['tmp_name']);

			if (preg_match('/\<\?php/i', $content)) {
				$json['error'] = $this->language->get('error_warning');
			}
			
			if ($this->request->files['file']['size'] > 25000000) {
				$json['error'] = $this->language->get('error_image');
			}
			
			$mime = mime_content_type($this->request->files['file']['tmp_name']);
			
			switch($mime) {
				case 'image/jpeg':
					break;
				default:
					$json['error'] = sprintf($this->language->get('error_file_type'), $mime);
			}
		} else {
			$json['error'] = $this->language->get('error_warning');
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
			
			$watermark = new \Opencart\System\Library\Image(DIR_IMAGE . 'powered.png');
			
			$image->watermark($watermark);
			
			$image->save(DIR_IMAGE_VEHICLE4PARTS . $file_name);
			
			unset($watermark);
			
			unset($image);
			
			$json['image'] = DIR_IMAGE_VEHICLE4PARTS_NAME . $file_name;
			$json['path'] = HTTP_SERVER . DIR_IMAGE_VEHICLE4PARTS_RELATIVE . $file_name;
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function uploadFile() {
		$json = array();

		$this->load->language('catalog/vehicle4parts');
		$this->load->model('catalog/vehicle4parts');
		
		if (isset($this->request->files['file'])) {
			$content = file_get_contents($this->request->files['file']['tmp_name']);

			if (preg_match('/\<\?php/i', $content)) {
				$json['error'] = $this->language->get('error_warning');
			}
			
			if ($this->request->files['file']['size'] > 25000000) {
				$json['error'] = $this->language->get('error_file_size');
			}
			
			$mime = mime_content_type($this->request->files['file']['tmp_name']);
			
			switch($mime) {
				case 'image/jpeg':
				case 'image/gif':
				case 'image/png':
				case 'image/bmp':
				case 'application/pdf':
				case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
					break;
				default:
					$json['error'] = sprintf($this->language->get('error_file_type'), $mime);
			}
		} else {
			$json['error'] = $this->language->get('error_warning');
		}
		
		if (empty($this->request->get['sku'])) {
			$json['error'] = $this->language->get('error_warning');
		}

		if (!isset($json['error'])) {
			$name_exp1 = explode('.', $this->request->files['file']['name']);
			$file_name = time() . rand(100, 900) . $this->user->getId() . '.' . end($name_exp1);
			
			move_uploaded_file($this->request->files['file']['tmp_name'], DIR_UPLOAD . $file_name);
			
			$name_exp2 = explode('/', $this->request->files['file']['name']);
			$title = mb_substr(end($name_exp2), 0, 32);
			
			$sku = $this->request->get['sku'];
			
			$file_id = $this->model_catalog_vehicle4parts->addVehicle4PartsFile($this->user->getId(), $sku, array('file' => $file_name, 'title' => $title));
			
			$json['id'] = $file_id;
			$json['title'] = $title;
			$json['path'] = HTTP_SERVER . DIR_UPLOAD_RELATIVE . $file_name;
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function deleteFile() {
		if (isset($this->request->get['sku']) and isset($this->request->get['file_id'])) {
			$this->load->model('catalog/vehicle4parts');
			
			$this->model_catalog_vehicle4parts->deleteVehicle4PartsFile($this->user->getId(), $this->request->get['sku'], (int) $this->request->get['file_id']);
		}
	}
}
