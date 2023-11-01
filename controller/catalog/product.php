<?php
namespace Opencart\Catalog\Controller\Catalog;
class Product extends \Opencart\System\Engine\Controller {
	private $error = array();
	
	public function index() {
		$this->load->model('catalog/product');
		$this->load->model('catalog/category');
		$this->load->model('catalog/vehicle');
		$this->load->model('catalog/warehouse');
		$this->load->model('tool/image');
		
		$this->load->language('catalog/product');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->getList();
	}
	
	private function getList() {
		$limit = 20;
		
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
		
		if (isset($this->session->data['sync_product'])) {
			$data['sync_product'] = $this->session->data['sync_product'];

			unset($this->session->data['sync_product']);
		} else {
			$data['sync_product'] = '';
		}

		if (isset($this->request->get['search'])) {
			$search = $this->request->get['search'];
		} else {
			$search = '';
		}

		if (isset($this->request->get['filter_vehicle_brand'])) {
			$filter_vehicle_brand = (int) $this->request->get['filter_vehicle_brand'];
		} else {
			$filter_vehicle_brand = '';
		}
		
		if (isset($this->request->get['filter_vehicle_model'])) {
			$filter_vehicle_model = (int) $this->request->get['filter_vehicle_model'];
		} else {
			$filter_vehicle_model = '';
		}
		
		if (isset($this->request->get['filter_vehicle_engine'])) {
			$filter_vehicle_engine = (int) $this->request->get['filter_vehicle_engine'];
		} else {
			$filter_vehicle_engine = '';
		}

		if (isset($this->request->get['filter_category'])) {
			$filter_category = $this->request->get['filter_category'];
		} else {
			$filter_category = '';
		}
		
		if (isset($this->request->get['filter_vehicle4parts'])) {
			$filter_vehicle4parts = $this->request->get['filter_vehicle4parts'];
		} else {
			$filter_vehicle4parts = '';
		}
		
		if (isset($this->request->get['warehouse_id'])) {
			$warehouse_id = $this->request->get['warehouse_id'];
		} else {
			$warehouse_id = '';
		}
		
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = '';
		}
		
		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = '';
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
		
		if (isset($this->request->get['filter_vehicle_brand'])) {
			$url .= '&filter_vehicle_brand=' . $this->request->get['filter_vehicle_brand'];
		}

		if (isset($this->request->get['filter_vehicle_model'])) {
			$url .= '&filter_vehicle_model=' . $this->request->get['filter_vehicle_model'];
		}
		
		if (isset($this->request->get['filter_vehicle_engine'])) {
			$url .= '&filter_vehicle_engine=' . $this->request->get['filter_vehicle_engine'];
		}

		if (isset($this->request->get['filter_category'])) {
			$url .= '&filter_category=' . $this->request->get['filter_category'];
		}
		
		if (isset($this->request->get['filter_vehicle4parts'])) {
			$url .= '&filter_vehicle4parts=' . $this->request->get['filter_vehicle4parts'];
		}
		
		if (isset($this->request->get['warehouse_id'])) {
			$url .= '&warehouse_id=' . $this->request->get['warehouse_id'];
		}
		
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		$data['add'] = $this->url->link('catalog/product.add', $url, true);
		$data['vehicle4parts'] = $this->url->link('catalog/vehicle4parts', $url, true);
		$data['warehouse'] = $this->url->link('catalog/warehouse', $url, true);
		$data['product'] = $this->url->link('catalog/product', '&user_token=' . $this->session->data['user_token'], true);
		//$data['product'] = html_entity_decode($this->url->link('catalog/product', '&user_token=' . $this->session->data['user_token'], true));

		$data['products'] = array();

		$filter_data = array(
			'search'				=> $search,
			'filter_vehicle_brand'	=> $filter_vehicle_brand,
			'filter_vehicle_model'	=> $filter_vehicle_model,
			'filter_vehicle_engine'	=> $filter_vehicle_engine,
			'filter_category'		=> $filter_category,
			'filter_vehicle4parts'	=> $filter_vehicle4parts,
			'filter_warehouse'		=> $warehouse_id,
			'sort'					=> $sort,
			'order'					=> $order,
			'start'					=> ($page - 1) * $limit,
			'limit'					=> $limit
		);
		
		$currency_code = $this->user->get('currency');

		$product_total = $this->model_catalog_product->getTotalProducts($this->user->getId(), $filter_data);

		$results = $this->model_catalog_product->getProducts($this->user->getId(), $filter_data, false, false);
		
		foreach ($results as $result) {
			if (is_file(DIR_IMAGE . $result['image'])) {
				$image_min = $this->model_tool_image->resize($result['image'], 75, 75);
			} else {
				$image_min = $this->model_tool_image->resize('no_image.png', 75, 75);
			}
			
			$name = oc_substr($result['name'], 0, 128);
			
			if (mb_strlen($result['name']) > 128) {
				$name .= '...';
			}
			
			$name_min = oc_substr($result['name'], 0, 64);
			
			if (mb_strlen($result['name']) > 64) {
				$name_min .= '...';
			}

			$data['products'][] = array(
				'image_min'				=> $image_min,
				'image'					=> HTTP_SERVER . DIR_IMAGE_RELATIVE . $result['image'],
				'sku'					=> $result['sku'],
				'name'					=> $name,
				'name_min'				=> $name_min,
				'price'					=> $this->currency->format($this->currency->convert($result['price'], 1, $currency_code), $currency_code, 1),
				'quantity'				=> $result['quantity'],
				'edit'					=> $this->url->link('catalog/product.edit', 'product=' . $result['sku'] . '&catalog=' . $result['catalog'] . $url, true),
				'preview'				=> $this->url->link('catalog/product.edit', 'product=' . $result['sku'] . '&preview=1&catalog=' . $result['catalog'] . $url, true),
				'delete'				=> $this->url->link('catalog/product.delete', 'product=' . $result['sku'] . $url, true),
				'label'					=> $this->url->link('info/label', 'product=' . $result['sku'] . $url, true),
				'status'				=> $result['status'],
			);
		}

		$data['vehicle_brands'] = $this->model_catalog_vehicle->getBrands($this->user->getId());
		
		if ($filter_vehicle_brand) {
			$data['vehicle_models'] = $this->model_catalog_vehicle->getModels(array('filter_brand_id' => $filter_vehicle_brand));
		} else {
			$data['vehicle_models'] = array();
		}
		
		if ($filter_vehicle_model) {
			$data['vehicle_engines'] = $this->model_catalog_vehicle->getEngines(array('filter_model_id' => $filter_vehicle_model));
		} else {
			$data['vehicle_engines'] = array();
		}
		
		$filter_data = array(
			'filter_vehicle_brand' => $filter_vehicle_brand,
			'filter_vehicle_model' => $filter_vehicle_model,
			'filter_vehicle_engine' => $filter_vehicle_engine,
		);
		
		$data['categories'] = $this->model_catalog_category->getInvolvedCategories($this->user->getId(), $filter_data);
		
		$data['warehouses'] = $this->model_catalog_warehouse->getWarehouses($this->user->getId());

		$url = '';
		
		$url .= '&user_token=' . $this->session->data['user_token'];

		if (isset($this->request->get['search'])) {
			$url .= '&search=' . urlencode(html_entity_decode($this->request->get['search'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_vehicle_brand'])) {
			$url .= '&filter_vehicle_brand=' . $this->request->get['filter_vehicle_brand'];
		}

		if (isset($this->request->get['filter_vehicle_model'])) {
			$url .= '&filter_vehicle_model=' . $this->request->get['filter_vehicle_model'];
		}
		
		if (isset($this->request->get['filter_vehicle_engine'])) {
			$url .= '&filter_vehicle_engine=' . $this->request->get['filter_vehicle_engine'];
		}

		if (isset($this->request->get['filter_category'])) {
			$url .= '&filter_category=' . $this->request->get['filter_category'];
		}
		
		if (isset($this->request->get['filter_vehicle4parts'])) {
			$url .= '&filter_vehicle4parts=' . $this->request->get['filter_vehicle4parts'];
		}
		
		if (isset($this->request->get['warehouse_id'])) {
			$url .= '&warehouse_id=' . $this->request->get['warehouse_id'];
		}
		
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
		
		$data['pagination'] = $this->load->controller('common/pagination', [
			'total' => $product_total,
			'page'  => $page,
			'limit' => $limit,
			'url'   => $this->url->link('catalog/product', 'user_token=' . $this->session->data['user_token'] . $url . '&page={page}')
		]);

		$data['results'] = sprintf($this->language->get('text_pagination'), ($product_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($product_total - $limit)) ? $product_total : ((($page - 1) * $limit) + $limit), $product_total, ceil($product_total / $limit));
		
		$url = '';
		
		$url .= '&user_token=' . $this->session->data['user_token'];

		if (isset($this->request->get['search'])) {
			$url .= '&search=' . urlencode(html_entity_decode($this->request->get['search'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_vehicle_brand'])) {
			$url .= '&filter_vehicle_brand=' . $this->request->get['filter_vehicle_brand'];
		}

		if (isset($this->request->get['filter_vehicle_model'])) {
			$url .= '&filter_vehicle_model=' . $this->request->get['filter_vehicle_model'];
		}
		
		if (isset($this->request->get['filter_vehicle_engine'])) {
			$url .= '&filter_vehicle_engine=' . $this->request->get['filter_vehicle_engine'];
		}

		if (isset($this->request->get['filter_category'])) {
			$url .= '&filter_category=' . $this->request->get['filter_category'];
		}
		
		if (isset($this->request->get['filter_vehicle4parts'])) {
			$url .= '&filter_vehicle4parts=' . $this->request->get['filter_vehicle4parts'];
		}
		
		if (isset($this->request->get['warehouse_id'])) {
			$url .= '&warehouse_id=' . $this->request->get['warehouse_id'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		$data['sort_url'] = array();
		
		$data['sort_url'][] = array(
			'url' => $order !== 'ASC' && $sort === 'ptu.sku' ? $this->url->link('catalog/product', $url . '&sort=ptu.sku&order=ASC', true) : $this->url->link('catalog/product', $url . '&sort=ptu.sku&order=DESC', true),
			'title' =>  $order === 'ASC' && $sort === 'ptu.sku' ? 'SKU<i class="fas fa-caret-up ms-2"></i>' : 'SKU<i class="fas fa-caret-down ms-2"></i>',
			'active' => $sort === 'ptu.sku' ? 1 : 0
		);
		
		$data['sort_url'][] = array(
			'url' => $order !== 'ASC' && $sort === 'p.date_added' ? $this->url->link('catalog/product', $url . '&sort=p.date_added&order=ASC', true) : $this->url->link('catalog/product', $url . '&sort=p.date_added&order=DESC', true),
			'title' => $order === 'ASC' && $sort === 'p.date_added' ? 'Date<i class="fas fa-caret-up ms-2"></i>' : 'Date<i class="fas fa-caret-down ms-2"></i>',
			'active' => $sort === 'p.date_added' ? 1 : 0
		);
		
		$data['sort_url'][] = array(
			'url' => $order !== 'ASC' && $sort === 'p.brand' ? $this->url->link('catalog/product', $url . '&sort=p.brand&order=ASC', true) : $this->url->link('catalog/product', $url . '&sort=p.brand&order=DESC', true),
			'title' => $order === 'ASC' && $sort === 'p.brand' ? 'Brand<i class="fas fa-caret-up ms-2"></i>' : 'Brand<i class="fas fa-caret-down ms-2"></i>',
			'active' => $sort === 'p.brand' ? 1 : 0
		);		

		
		$data['sort'] = $sort;
		$data['order'] = $order;
		
		$data['search'] = $search;
		$data['filter_vehicle_brand'] = $filter_vehicle_brand;
		$data['filter_vehicle_model'] = $filter_vehicle_model;
		$data['filter_vehicle_engine'] = $filter_vehicle_engine;
		$data['filter_category'] = explode(',', $filter_category);
		$data['filter_vehicle4parts'] = $filter_vehicle4parts;
		$data['warehouse_id'] = $warehouse_id;
		
		$data['filter_off'] = $this->user->get('catalog') === 'carparts';
		
		$data['url_image'] = HTTP_SERVER . DIR_IMAGE_RELATIVE;
		
		$data['user_token'] = $this->session->data['user_token'];
		
		$this->document->addScript(HTTP_SERVER . 'view/js/magnific/jquery.magnific-popup.min.js', 'footer');
		$this->document->addStyle(HTTP_SERVER . 'view/js/magnific/magnific-popup.css', 'stylesheet', 'screen', 'footer');
		
		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['navigation'] = $this->load->controller('common/navigation');
		
		$this->response->setOutput($this->load->view('catalog/product_list', $data));
	}

	public function add() {
		$this->load->model('catalog/product');
		
		$this->load->language('catalog/product');

		$this->document->setTitle($this->language->get('heading_title'));

		if ($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validateForm()) {
			$this->request->post['price'] = $this->currency->convert((float) $this->request->post['price'], $this->user->get('currency'), '0');
			
			if ($this->user->get('catalog') === 'carparts') {
				$catalog = 'carparts';
			} else {
				$catalog = 'market';
			}

			$sku = $this->model_catalog_product->addProduct($this->user->getId(), $this->request->post, $catalog);
			
			$this->session->data['sync_product'] = $sku;
			
			if (isset($this->request->post['product_vehicle'])) {
				$this->load->model('catalog/vehicle');
				
				$this->session->data['last_product_vehicle'] = array();

				foreach ($this->request->post['product_vehicle'] as $vehicle_id) {
					$vehicle = $this->model_catalog_vehicle->getVehicle($vehicle_id);
					
					if (!$vehicle) {
						continue;
					}
					
					if (isset($this->request->post['product_vehicle_engine'][$vehicle['vehicle_id']])) {
						$engine = $this->model_catalog_vehicle->getEngine($this->request->post['product_vehicle_engine'][$vehicle['vehicle_id']]);
					} else {
						$engine = false;
					}
					
					$this->session->data['last_product_vehicle'][] = array(
						'vehicle_id' => $vehicle['vehicle_id'],
						'title' => $vehicle['title'],
						'engine' => $engine,
					);
				}
			}

			if (isset($this->request->post['product_vehicle4parts'])) {
				$this->load->model('catalog/vehicle4parts');
				
				$this->session->data['last_product_vehicle4parts'] = array();
				
				foreach ($this->request->post['product_vehicle4parts'] as $vehicle4parts_sku) {
					$vehicle4parts = $this->model_catalog_vehicle4parts->getVehicle4Parts($this->user->getId(), $vehicle4parts_sku);
				
					if (isset($vehicle4parts['vehicle4parts_id'])) {
						$this->session->data['last_product_vehicle4parts'][] = array(
							'sku' => $vehicle4parts['sku'],
							'title' => $vehicle4parts['title'],
						);
					}
				}
			}
			
			$url = '';
			
			$url .= '&user_token=' . $this->session->data['user_token'];

			if (isset($this->request->get['search'])) {
				$url .= '&search=' . urlencode(html_entity_decode($this->request->get['search'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_vehicle_brand'])) {
				$url .= '&filter_vehicle_brand=' . $this->request->get['filter_vehicle_brand'];
			}
			
			if (isset($this->request->get['filter_vehicle_model'])) {
				$url .= '&filter_vehicle_model=' . $this->request->get['filter_vehicle_model'];
			}
			
			if (isset($this->request->get['filter_vehicle_engine'])) {
				$url .= '&filter_vehicle_engine=' . $this->request->get['filter_vehicle_engine'];
			}

			if (isset($this->request->get['filter_category'])) {
				$url .= '&filter_category=' . $this->request->get['filter_category'];
			}
			
			if (isset($this->request->get['filter_vehicle4parts'])) {
				$url .= '&filter_vehicle4parts=' . $this->request->get['filter_vehicle4parts'];
			}
			
			if (isset($this->request->get['warehouse_id'])) {
				$url .= '&warehouse_id=' . $this->request->get['warehouse_id'];
			}
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			
			$this->session->data['success'] = sprintf($this->language->get('text_success_add'), $this->url->link('catalog/product.add', $url . '&prev_vehicle=1', true));
			
			$this->response->redirect($this->url->link('catalog/product', $url, true));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->model('catalog/product');
		
		$this->load->language('catalog/product');

		$this->document->setTitle($this->language->get('heading_title'));

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && isset($this->request->get['catalog']) && $this->validateForm($this->request->get['catalog'])) {
			$sku = $this->request->get['product'];
			
			$this->request->post['price'] = $this->currency->convert((float) $this->request->post['price'], $this->user->get('currency'), '0');
			
			if ($this->request->get['catalog'] === 'carparts') {
				$catalog = 'carparts';
			} else {
				$catalog = 'market';
			}
			
			$this->model_catalog_product->editProduct($this->user->getId(), $sku, $this->request->post, $catalog);
			
			$this->session->data['sync_product'] = $sku;

			$this->session->data['success'] = $this->language->get('text_success_edit');

			$url = '';
			
			$url .= '&user_token=' . $this->session->data['user_token'];

			if (isset($this->request->get['search'])) {
				$url .= '&search=' . urlencode(html_entity_decode($this->request->get['search'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_vehicle_brand'])) {
				$url .= '&filter_vehicle_brand=' . $this->request->get['filter_vehicle_brand'];
			}
			
			if (isset($this->request->get['filter_vehicle_model'])) {
				$url .= '&filter_vehicle_model=' . $this->request->get['filter_vehicle_model'];
			}
			
			if (isset($this->request->get['filter_vehicle_engine'])) {
				$url .= '&filter_vehicle_engine=' . $this->request->get['filter_vehicle_engine'];
			}

			if (isset($this->request->get['filter_category'])) {
				$url .= '&filter_category=' . $this->request->get['filter_category'];
			}
			
			if (isset($this->request->get['filter_vehicle4parts'])) {
				$url .= '&filter_vehicle4parts=' . $this->request->get['filter_vehicle4parts'];
			}
			
			if (isset($this->request->get['warehouse_id'])) {
				$url .= '&warehouse_id=' . $this->request->get['warehouse_id'];
			}
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['redirect'])) {
				$this->response->redirect($this->url->link($this->request->get['redirect'], $url, true));
			} else {
				$this->response->redirect($this->url->link('catalog/product', $url, true));
			}
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->model('catalog/product');
		$this->load->model('catalog/vehicle4parts');
		
		$this->load->language('catalog/product');
		
		$sku = $this->request->get['product'];
		
		$this->model_catalog_product->deleteProduct($this->user->getId(), $sku);
		
		$this->session->data['alerts'] = $this->onlineshopSyncProduct($sku);

		$this->session->data['success'] = $this->language->get('text_success_delete');

		$url = '';
		
		$url .= '&user_token=' . $this->session->data['user_token'];

		if (isset($this->request->get['search'])) {
			$url .= '&search=' . urlencode(html_entity_decode($this->request->get['search'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_vehicle_brand'])) {
			$url .= '&filter_vehicle_brand=' . $this->request->get['filter_vehicle_brand'];
		}
		
		if (isset($this->request->get['filter_vehicle_model'])) {
			$url .= '&filter_vehicle_model=' . $this->request->get['filter_vehicle_model'];
		}
		
		if (isset($this->request->get['filter_vehicle_engine'])) {
			$url .= '&filter_vehicle_engine=' . $this->request->get['filter_vehicle_engine'];
		}

		if (isset($this->request->get['filter_category'])) {
			$url .= '&filter_category=' . $this->request->get['filter_category'];
		}
		
		if (isset($this->request->get['filter_vehicle4parts'])) {
			$url .= '&filter_vehicle4parts=' . $this->request->get['filter_vehicle4parts'];
		}
		
		if (isset($this->request->get['warehouse_id'])) {
			$url .= '&warehouse_id=' . $this->request->get['warehouse_id'];
		}
		
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		$this->response->redirect($this->url->link('catalog/product', $url, true));
	}
	
	protected function getForm() {
		if (isset($this->request->get['product'])) {
			$product_info = $this->model_catalog_product->getProduct($this->user->getId(), $this->request->get['product']);
			
			if (!$product_info) {
				$this->response->redirect($this->url->link('catalog/product', '&user_token=' . $this->session->data['user_token'], true));
				return;
			}
			
			if ($product_info['catalog'] === 'carparts') {
				$this->carparts_getForm($product_info);
			} else {
				$this->market_getForm($product_info);
			}
			
			return;
		}
		
		if ($this->user->get('catalog') === 'carparts') {
			$this->carparts_getForm();
		} else {
			$this->market_getForm();
		}
	}

	protected function market_getForm($product_info = false) {
		$this->load->model('localisation/language');
		$this->load->model('catalog/vehicle4parts');
		
		$languages_result = $this->model_localisation_language->getLanguages();
		
		$languages = array();
		
		
		
		$languages[$this->config->get('config_language_code')] = $languages_result[$this->config->get('config_language_code')];
		
		unset($languages_result[$this->config->get('config_language_code')]);
		
		$languages = array_merge($languages, $languages_result);
		
		unset($languages_result);
		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = array();
		}
		
		$url = '';
		
		$url .= '&user_token=' . $this->session->data['user_token'];

		if (isset($this->request->get['search'])) {
			$url .= '&search=' . urlencode(html_entity_decode($this->request->get['search'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_vehicle_brand'])) {
			$url .= '&filter_vehicle_brand=' . $this->request->get['filter_vehicle_brand'];
		}

		if (isset($this->request->get['filter_vehicle_model'])) {
			$url .= '&filter_vehicle_model=' . $this->request->get['filter_vehicle_model'];
		}
		
		if (isset($this->request->get['filter_vehicle_engine'])) {
			$url .= '&filter_vehicle_engine=' . $this->request->get['filter_vehicle_engine'];
		}

		if (isset($this->request->get['filter_category'])) {
			$url .= '&filter_category=' . $this->request->get['filter_category'];
		}
		
		if (isset($this->request->get['filter_vehicle4parts'])) {
			$url .= '&filter_vehicle4parts=' . $this->request->get['filter_vehicle4parts'];
		}
		
		if (isset($this->request->get['warehouse_id'])) {
			$url .= '&warehouse_id=' . $this->request->get['warehouse_id'];
		}
		
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		if (!isset($this->request->get['product']) or !isset($this->request->get['catalog'])) {
			$data['action'] = $this->url->link('catalog/product.add', $url, true);
		} else {
			$data['action'] = $this->url->link('catalog/product.edit', 'product=' . $this->request->get['product'] . '&catalog=' . $this->request->get['catalog'] . $url, true);
		}
		
		if (isset($this->request->get['redirect'])) {
			$data['cancel'] = $this->url->link($this->request->get['redirect'], $url, true);
		} else {
			$data['cancel'] = $this->url->link('catalog/product', $url, true);
		}

		if (isset($this->request->get['preview'])) {
			$data['edit'] = false;
		} else {
			$data['edit'] = true;
		}
		
		if (empty($product_info)) {
			if (isset($this->request->post['sku'])) {
				$data['sku'] = $this->request->post['sku'];
			} else {
				if (isset($this->request->get['warehouse_id'])) {
					$data['sku'] = $this->model_catalog_product->getNewSku($this->user->getId(), $this->request->get['warehouse_id']);
				} else {
					$data['sku'] = $this->model_catalog_product->getNewSku($this->user->getId());
				}
			}
			
			$data['new_product'] = true;
		} else {
			$data['sku'] = $product_info['sku'];
			$data['new_product'] = false;
		}
		
		if (isset($this->request->post['product_description'])) {
			$data['product_description'] = $this->request->post['product_description'];
		} elseif (!empty($product_info)) {
			$product_descriptions = $this->model_catalog_product->getProductDescription($this->user->getId(), $product_info['sku']);
			
			foreach ($product_descriptions as $language_id => $product_description) {
				$data['product_description'][$language_id] = str_replace("'", "`", $product_description);
			}
		} else {
			$data['product_description'] = array();
		}
		
		if (isset($this->request->post['note'])) {
			$data['note'] = $this->request->post['note'];
		} elseif (!empty($product_info)) {
			$data['note'] = $product_info['note'];
		} else {
			$data['note'] = '';
		}
		
		if (isset($this->request->post['mpn'])) {
			$data['mpn'] = $this->request->post['mpn'];
		} elseif (!empty($product_info)) {
			$data['mpn'] = $product_info['mpn'];
		} else {
			$data['mpn'] = '';
		}
		
		if (isset($this->request->post['used'])) {
			$data['used'] = $this->request->post['used'];
		} elseif (!empty($product_info)) {
			$data['used'] = $product_info['used'];
		} else {
			$data['used'] = $this->user->get('default_product_used');
		}
		
		if (isset($this->request->post['brand'])) {
			$data['brand'] = $this->request->post['brand'];
		} elseif (!empty($product_info)) {
			$data['brand'] = $product_info['brand'];
		} else {
			$data['brand'] = $this->user->get('default_brand');
		}
		
		if (isset($this->request->post['price'])) {
			$data['price'] = $this->request->post['price'];
		} elseif (!empty($product_info)) {
			$data['price'] = round($this->currency->convert($product_info['price'], '0', $this->user->get('currency')), 2);
		} else {
			$data['price'] = '';
		}
		
		if (isset($this->request->post['location'])) {
			$data['location'] = $this->request->post['location'];
		} elseif (!empty($product_info)) {
			$data['location'] = $product_info['location'];
		} else {
			$data['location'] = '';
		}
		
		$this->load->model('catalog/warehouse');
		
		$data['warehouses'] = $this->model_catalog_warehouse->getWarehouses($this->user->getId());
		
		if (isset($this->request->post['warehouse_id'])) {
			$data['warehouse_id'] = $this->request->post['warehouse_id'];
		} elseif (!empty($product_info)) {
			$data['warehouse_id'] = $product_info['warehouse_id'];
		} elseif (isset($this->request->get['warehouse_id'])) {
			$data['warehouse_id'] = $this->request->get['warehouse_id'];
		} else {
			$data['warehouse_id'] = '';
		}

		if (isset($this->request->post['quantity'])) {
			$data['quantity'] = $this->request->post['quantity'];
		} elseif (!empty($product_info)) {
			$data['quantity'] = $product_info['quantity'];
		} else {
			$data['quantity'] = 1;
		}
		
		if (isset($this->request->post['oe'])) {
			$data['oe'] = $this->request->post['oe'];
		} elseif (!empty($product_info)) {
			$data['oe'] = $product_info['oe'];
		} else {
			$data['oe'] = '';
		}
		
		if (isset($this->request->post['ean'])) {
			$data['ean'] = $this->request->post['ean'];
		} elseif (!empty($product_info)) {
			$data['ean'] = $product_info['ean'];
		} else {
			$data['ean'] = '';
		}
		
		if (isset($this->request->post['others'])) {
			$data['others'] = $this->request->post['others'];
		} elseif (!empty($product_info)) {
			$data['others'] = $product_info['others'];
		} else {
			$data['others'] = '';
		}
		
		if (isset($this->request->post['weight'])) {
			$data['weight'] = $this->request->post['weight'];
		} elseif (!empty($product_info)) {
			$data['weight'] = $product_info['weight'];
		} else {
			$data['weight'] = 1;
		}
		
		$data['product_image'] = array();
		
		if (isset($this->request->post['product_image'])) {
			foreach ($this->request->post['product_image'] as $image) {
				$data['product_image'][] = array(
					'image' => $image,
					'path' => HTTP_SERVER . DIR_IMAGE_RELATIVE . $image,
				);
			}
		} elseif (!empty($product_info) and $this->request->server['REQUEST_METHOD'] !== 'POST') {
			if ($product_info['image']) {
				$data['product_image'][] = array(
					'image' => $product_info['image'],
					'path' => HTTP_SERVER . DIR_IMAGE_RELATIVE . $product_info['image'],
				);
			}
			
			$images = $this->model_catalog_product->getProductImages($this->user->getId(), $product_info['sku']);

			foreach ($images as $image) {
				$data['product_image'][] = array(
					'image' => $image['image'],
					'path' => HTTP_SERVER . DIR_IMAGE_RELATIVE . $image['image'],
				);
			}
		}
		
		$this->load->model('catalog/category');

		if (isset($this->request->post['product_category'])) {
			$product_category = $this->model_catalog_category->getCategory($this->request->post['product_category']);
			
			if ($product_category) {
				$data['category_id'] = $product_category['category_id'];
				$data['category_path'] = $product_category['path'];
			} else {
				$data['category_id'] = 0;
				$data['category_path'] = '';
			}
		} elseif (!empty($product_info)) {
			$product_categories = $this->model_catalog_product->getProductCategories($this->user->getId(), $product_info['sku']);
			
			if ($product_categories) {
				$product_category = $this->model_catalog_category->getCategory($product_categories[0]['category_id']);
				
				if ($product_category) {
					$data['category_id'] = $product_category['category_id'];
					$data['category_path'] = $product_category['path'];
				} else {
					$data['category_id'] = 0;
					$data['category_path'] = '';
				}
			} else {
				$data['category_id'] = 0;
				$data['category_path'] = '';
			}
		} else {
			$data['category_id'] = 0;
			$data['category_path'] = '';
		}
		
		$this->load->model('catalog/vehicle');
		
		if (isset($this->request->post['product_vehicle'])) {
			foreach ($this->request->post['product_vehicle'] as $vehicle_id) {
				$vehicle = $this->model_catalog_vehicle->getVehicle($vehicle_id);
				
				if (!$vehicle) {
					continue;
				}
				
				if (isset($this->request->post['product_vehicle_engine'][$vehicle['vehicle_id']])) {
					$engine = $this->model_catalog_vehicle->getEngine($this->request->post['product_vehicle_engine'][$vehicle['vehicle_id']]);
				} else {
					$engine = false;
				}
				
				$data['product_vehicle'][] = array(
					'vehicle_id' => $vehicle['vehicle_id'],
					'title' => $vehicle['title'],
					'engine' => $engine,
				);
			}
		} elseif (!empty($product_info) and $this->request->server['REQUEST_METHOD'] !== 'POST') {
			$data['product_vehicle'] = $this->model_catalog_product->getProductVehicles($this->user->getId(), $product_info['sku']);
		} else {
			$data['product_vehicle'] = array();
		}
		
		$data['product_vehicle4parts'] = array();
		
		if (isset($this->request->post['product_vehicle4parts'])) {
			foreach ($this->request->post['product_vehicle4parts'] as $vehicle4parts_sku) {
				$vehicle4parts = $this->model_catalog_vehicle4parts->getVehicle4Parts($this->user->getId(), $vehicle4parts_sku);
			
				if (isset($vehicle4parts['vehicle4parts_id'])) {
					$data['product_vehicle4parts'][] = array(
						'sku' => $vehicle4parts['sku'],
						'title' => $vehicle4parts['title'],
					);
				}
			}
		} elseif (!empty($product_info) and $this->request->server['REQUEST_METHOD'] !== 'POST') {
			$product_vehicle4parts = $this->model_catalog_product->getProductVehicles4Parts($this->user->getId(), $product_info['sku']);
			
			foreach ($product_vehicle4parts as $vehicle4parts) {
				$data['product_vehicle4parts'][] = array(
					'sku' => $vehicle4parts['sku'],
					'title' => $vehicle4parts['title'],
				);
			}
		}
		
		if (isset($this->request->get['vehicle4parts'])) {
			$vehicle4parts = $this->model_catalog_vehicle4parts->getVehicle4Parts($this->user->getId(), $this->request->get['vehicle4parts']);
			
			if (isset($vehicle4parts['vehicle4parts_id'])) {
				$data['product_vehicle4parts'][] = array(
					'sku' => $vehicle4parts['sku'],
					'title' => $vehicle4parts['title'],
				);
				
				$vehicle = $this->model_catalog_vehicle->getVehicle($vehicle4parts['vehicle_id']);
				
				if (!empty($vehicle4parts['engine_id'])) {
					$engine = $this->model_catalog_vehicle->getEngine($vehicle4parts['engine_id']);
				} else {
					$engine = false;
				}
				
				$data['product_vehicle'][] = array(
					'vehicle_id' => $vehicle['vehicle_id'],
					'title' => $vehicle['title'],
					'engine' => $engine,
				);
			}
		}
		
		if (isset($this->request->get['prev_vehicle']) and $this->request->get['prev_vehicle'] == 1) {
			if (isset($this->session->data['last_product_vehicle'])) {
				$data['product_vehicle'] = $this->session->data['last_product_vehicle'];
			}
			
			if (isset($this->session->data['last_product_vehicle4parts'])) {
				$data['product_vehicle4parts'] = $this->session->data['last_product_vehicle4parts'];
			}
		}
		
		$vehicle_positions = $this->model_catalog_vehicle->getPositions();
		
		$vehicle_positions_translates = array();
		
		foreach ($vehicle_positions as $vehicle_position) {
			foreach ($languages as $language) {
				$vehicle_position_data = $this->model_catalog_vehicle->getPosition($vehicle_position['vehicle_position_id'], $language['language_id']);
				
				$vehicle_positions_translates[$vehicle_position['vehicle_position_id']][$language['language_id']] = $vehicle_position_data['text'];
			}
		}
		
		$data['vehicle_positions_translates'] = json_encode($vehicle_positions_translates);
		
		$data['vehicle_positions'] = $vehicle_positions;
		
		if (isset($this->request->post['vehicle_position_id'])) {
			$data['vehicle_position_id'] = $this->request->post['vehicle_position_id'];
		} elseif (!empty($product_info)) {
			$data['vehicle_position_id'] = $product_info['vehicle_position_id'];
		} else {
			$data['vehicle_position_id'] = 0;
		}
		
		$data['languages'] = $languages;
		
		$data['user_language'] = $this->user->get('language_id');
		
		$data['translates'] = array();
		
		foreach ($languages as $language) {
			$ln = new \Opencart\System\Library\Language($language['code']);
			
			$ln->addPath(DIR_LANGUAGE);
			$ln->load('catalog/product');
			
			$data['translates'][$language['language_id']] = $ln->all();
		}
		
		// MARKETPLACES
		
		$this->load->model('integration/onlineshop/onlineshop');
		
		$data['onlineshops'] = $this->model_integration_onlineshop_onlineshop->getOnlineshops();

		foreach ($data['onlineshops'] as $key => $value) {
			if (isset($product_info['onlineshops'][$key])) {
				$data['onlineshops'][$key]['status'] = $product_info['onlineshops'][$key]['status'];
			} elseif ($product_info) {
				$data['onlineshops'][$key]['status'] = 0;
			} else {
				$data['onlineshops'][$key]['status'] = 1;
			}
			
			if (isset($data['onlineshops'][$key]['always_on'])) {
				$data['onlineshops'][$key]['status'] = 1;
			}
		}
		
		$data['user_token'] = $this->session->data['user_token'];
		
		$this->document->addScript(HTTP_SERVER . 'view/js/magnific/jquery.magnific-popup.min.js', 'footer');
		$this->document->addStyle(HTTP_SERVER . 'view/js/magnific/magnific-popup.css', 'stylesheet', 'screen', 'footer');
		
		$this->document->addScript('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js', 'footer');
		$this->document->addStyle('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css', 'stylesheet', 'screen', 'footer');
		
		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['navigation'] = $this->load->controller('common/navigation');
		
		$data['MAX_IMAGE_WIDTH'] = MAX_IMAGE_WIDTH;
		$data['MAX_IMAGE_HEIGHT'] = MAX_IMAGE_HEIGHT;

		$this->response->setOutput($this->load->view('catalog/market_product_form', $data));
	}
	
	protected function carparts_getForm($product_info = false) {
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = array();
		}

		$url = '';
		
		$url .= '&user_token=' . $this->session->data['user_token'];

		if (isset($this->request->get['search'])) {
			$url .= '&search=' . urlencode(html_entity_decode($this->request->get['search'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_vehicle_brand'])) {
			$url .= '&filter_vehicle_brand=' . $this->request->get['filter_vehicle_brand'];
		}

		if (isset($this->request->get['filter_vehicle_model'])) {
			$url .= '&filter_vehicle_model=' . $this->request->get['filter_vehicle_model'];
		}
		
		if (isset($this->request->get['filter_vehicle_engine'])) {
			$url .= '&filter_vehicle_engine=' . $this->request->get['filter_vehicle_engine'];
		}

		if (isset($this->request->get['filter_category'])) {
			$url .= '&filter_category=' . $this->request->get['filter_category'];
		}
		
		if (isset($this->request->get['filter_vehicle4parts'])) {
			$url .= '&filter_vehicle4parts=' . $this->request->get['filter_vehicle4parts'];
		}
		
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		if (!isset($this->request->get['product']) or !isset($this->request->get['catalog'])) {
			$data['action'] = $this->url->link('catalog/product.add', $url, true);
		} else {
			$data['action'] = $this->url->link('catalog/product.edit', 'product=' . $this->request->get['product'] . '&catalog=' . $this->request->get['catalog'] . $url, true);
		}
		
		if (isset($this->request->get['redirect'])) {
			$data['cancel'] = $this->url->link($this->request->get['redirect'], $url, true);
		} else {
			$data['cancel'] = $this->url->link('catalog/product', $url, true);
		}

		if ($product_info) {
			$data['edit'] = true;
		} else {
			$data['edit'] = false;
		}
		
		if (isset($this->request->post['sku'])) {
			$data['sku'] = $this->request->post['sku'];
		} elseif (!empty($product_info)) {
			$data['sku'] = $product_info['sku'];
		} else {
			$data['sku'] = $this->model_catalog_product->getNewSku($this->user->getId());
		}

		if (isset($this->request->post['mpn'])) {
			$data['mpn'] = $this->request->post['mpn'];
		} elseif (!empty($product_info)) {
			$data['mpn'] = $product_info['mpn'];
		} else {
			$data['mpn'] = '';
		}
		
		if (isset($this->request->post['brand'])) {
			$data['brand'] = $this->request->post['brand'];
		} elseif (!empty($product_info)) {
			$data['brand'] = $product_info['brand'];
		} else {
			$data['brand'] = '';
		}
		
		if (isset($this->request->post['price'])) {
			$data['price'] = $this->request->post['price'];
		} elseif (!empty($product_info)) {
			$data['price'] = round($this->currency->convert($product_info['price'], '0', $this->user->get('currency')), 2);
		} else {
			$data['price'] = 0;
		}

		if (isset($this->request->post['quantity'])) {
			$data['quantity'] = $this->request->post['quantity'];
		} elseif (!empty($product_info)) {
			$data['quantity'] = $product_info['quantity'];
		} else {
			$data['quantity'] = 1;
		}
		
		if (isset($this->request->post['delivery'])) {
			$data['delivery'] = $this->request->post['delivery'];
		} elseif (!empty($product_info)) {
			$data['delivery'] = $product_info['delivery'];
		} else {
			$data['delivery'] = $this->user->get('default_product_delivery');
		}
		
		if (isset($this->request->post['used'])) {
			$data['used'] = $this->request->post['used'];
		} elseif (!empty($product_info)) {
			$data['used'] = $product_info['used'];
		} else {
			$data['used'] = $this->user->get('default_product_used');
		}
		
		if (isset($this->request->post['location'])) {
			$data['location'] = $this->request->post['location'];
		} elseif (!empty($product_info)) {
			$data['location'] = $product_info['location'];
		} else {
			$data['location'] = '';
		}
		
		$this->load->model('catalog/brand');
		
		$data['all_brands'] = $this->model_catalog_brand->getBrands();
		
		$data['user_token'] = $this->session->data['user_token'];

		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['navigation'] = $this->load->controller('common/navigation');

		$this->response->setOutput($this->load->view('catalog/carparts_product_form', $data));
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
		if (!isset($this->request->get['product'])) {
			if (!isset($this->request->post['sku']) or !preg_match('/^[a-zA-Z0-9]{3,10}$/', $this->request->post['sku'])) {
				$this->error['warning'] = $this->language->get('error_sku');
			} else {
				$product_id = $this->model_catalog_product->getProductIdBySku($this->user->getId(), $this->request->post['sku']);

				if ($product_id) {
					$this->error['warning'] = $this->language->get('error_sku_duplicate');
				}
			}
		}
		
		if (!isset($this->request->post['product_description']) or !is_array($this->request->post['product_description'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		} else {
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
					
					if (!isset($this->request->post['product_description'][$language['language_id']]['name_product']) or oc_strlen($this->request->post['product_description'][$language['language_id']]['name_product']) > 120) {
						$this->error['warning'] = $this->language->get('error_name_product');
					}
				}
			}
		}	
		
		if(isset($this->request->post['product_image']) and (!is_array($this->request->post['product_image']) or count($this->request->post['product_image']) > 8)) {
			$this->error['warning'] = $this->language->get('error_warning');
		} elseif (!empty($this->request->post['product_image'])) {
			foreach ($this->request->post['product_image'] as $image) {
				if (!file_exists(DIR_IMAGE . $image)) {
					$this->error['warning'] = $this->language->get('error_warning');
					break;
				}
			}
		}
		
		if (!isset($this->request->post['product_category'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		} elseif($this->request->post['product_category'] != 0) {
			$this->load->model('catalog/category');
			
			$category_info = $this->model_catalog_category->getCategory($this->request->post['product_category']);
			
			if (!$category_info) {
				$this->error['warning'] = $this->language->get('error_warning');
			}
		}

		if (!isset($this->request->post['vehicle_position_id'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		} elseif ($this->request->post['vehicle_position_id'] != '') {
			$this->load->model('catalog/vehicle');
			
			$vehicle_position_info = $this->model_catalog_vehicle->getPosition($this->request->post['vehicle_position_id']);
			
			if (!$vehicle_position_info) {
				$this->error['warning'] = $this->language->get('error_warning');
			}
		}
		
		if (isset($this->request->post['product_vehicle'])) {
			if (!is_array($this->request->post['product_vehicle']) or count($this->request->post['product_vehicle']) > 10) {
				$this->error['warning'] = $this->language->get('error_product_vehicle');
			} elseif (!empty($this->request->post['product_vehicle'])) {
				$this->load->model('catalog/vehicle');
				
				foreach ($this->request->post['product_vehicle'] as $vehicle_id) {
					$vehicle_info = $this->model_catalog_vehicle->getVehicle($vehicle_id);
					
					if (!$vehicle_info) {
						$this->error['warning'] = $this->language->get('error_product_vehicle');
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
		
		if (!isset($this->request->post['brand']) or oc_strlen($this->request->post['brand']) > 36) {
			$this->error['warning'] = $this->language->get('error_brand');
		}
		
		if (!isset($this->request->post['mpn']) or oc_strlen($this->request->post['mpn']) > 24) {
			$this->error['warning'] = $this->language->get('error_mpn');
		}
		
		if (!isset($this->request->post['quantity']) or oc_strlen($this->request->post['quantity']) > 4) {
			$this->error['warning'] = $this->language->get('error_quantity');
		}
		
		if (!isset($this->request->post['price']) or oc_strlen($this->request->post['price']) > 10) {
			$this->error['warning'] = $this->language->get('error_price');
		}
		
		if (!isset($this->request->post['ean']) or oc_strlen($this->request->post['ean']) > 14) {
			$this->error['warning'] = $this->language->get('error_ean');
		}
		
		if (!isset($this->request->post['oe']) or oc_strlen($this->request->post['oe']) > 32) {
			$this->error['warning'] = $this->language->get('error_oe');
		}
		
		if (!isset($this->request->post['others']) or oc_strlen($this->request->post['others']) > 128) {
			$this->error['warning'] = $this->language->get('error_others');
		}
		
		if (!isset($this->request->post['location']) or oc_strlen($this->request->post['location']) > 64) {
			$this->error['warning'] = $this->language->get('error_location');
		}
		
		if (!isset($this->request->post['weight']) or oc_strlen($this->request->post['weight']) > 15) {
			$this->error['warning'] = $this->language->get('error_weight');
		}
		
		if (!isset($this->request->post['used']) and ($this->request->post['used'] != '1') and ($this->request->post['used'] != '0')) {
			$this->error['warning'] = $this->language->get('error_warning');
		}

		return !$this->error;
	}
	
	protected function carparts_validateForm() {
		if (!isset($this->request->get['product'])) {
			if (!isset($this->request->post['sku']) or !preg_match('/^[a-zA-Z0-9]{3,10}$/', $this->request->post['sku'])) {
				$this->error['warning'] = $this->language->get('error_sku');
			} else {
				$product_id = $this->model_catalog_product->getProductIdBySku($this->user->getId(), $this->request->post['sku']);

				if ($product_id) {
					$this->error['warning'] = $this->language->get('error_sku_duplicate');
				}
			}
		}
		
		if (!isset($this->request->post['mpn']) or oc_strlen($this->request->post['mpn']) < 3 or oc_strlen($this->request->post['mpn']) > 24) {
			$this->error['warning'] = $this->language->get('error_mpn');
		}
		
		if (empty($this->request->post['brand'])) {
			$this->error['warning'] = $this->language->get('error_brand');
		} else {
			$this->load->model('catalog/brand');
			
			if (!$this->model_catalog_brand->getBrandCodeByName($this->request->post['brand'])) {
				$this->error['warning'] = $this->language->get('error_warning');
			}
		}
		
		if (!isset($this->request->post['quantity']) or oc_strlen(trim($this->request->post['quantity'])) > 4) {
			$this->error['warning'] = $this->language->get('error_quantity');
		}
		
		if (!isset($this->request->post['price']) or oc_strlen(trim($this->request->post['price'])) > 10) {
			$this->error['warning'] = $this->language->get('error_price');
		}
		
		if (!isset($this->request->post['location']) or oc_strlen(trim($this->request->post['location'])) > 64) {
			$this->error['warning'] = $this->language->get('error_location');
		}
		
		if (!isset($this->request->post['delivery']) or oc_strlen(trim($this->request->post['delivery'])) > 4) {
			$this->error['warning'] = $this->language->get('error_delivery');
		}

		return !$this->error;
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
	
	public function autocompleteVehicle() {
		$json = array();
		
		$json['vehicles'] = array();
		
		if (isset($this->request->get['search']) && oc_strlen(trim($this->request->get['search'])) >= 2) {
			$this->load->model('catalog/vehicle');
			
			$filter_data = array(
				'filter_name' => $this->request->get['search'],
				'start' => '0',
				'limit' => '15',
			);
			
			$vehicles = $this->model_catalog_vehicle->getVehicles($filter_data);
			
			foreach ($vehicles as $vehicle) {
				$json['vehicles'][] = array(
					'name' => $vehicle['title'],
					'id'   => $vehicle['vehicle_id'],
					'model_id'   => $vehicle['vehicle_model_id']
				);	
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function getVehicle4PartsByVehicle() {
		$json = array();
		
		if (isset($this->request->get['vehicle_id']) and isset($this->request->get['engine_id']) and isset($this->request->get['warehouse_id'])) {
			$this->load->model('catalog/vehicle4parts');
			
			$filter_data = array(
				'filter_vehicle_id' => $this->request->get['vehicle_id'],
				'filter_engine_id' => $this->request->get['engine_id'],
				'filter_warehouse_id' => $this->request->get['warehouse_id'],
			);

			$vehicles4parts = $this->model_catalog_vehicle4parts->getVehicles4Parts($this->user->getId(), $filter_data);
			
			foreach ($vehicles4parts as $vehicle4parts) {
				$json[] = array(
					'sku'	=> $vehicle4parts['sku'],
					'name'	=> $vehicle4parts['title'],
				);
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function getVehicle4Parts() {
		$json = array();
		
		if (isset($this->request->get['sku'])) {
			$this->load->model('catalog/vehicle4parts');
			$this->load->model('catalog/vehicle');

			$vehicle4parts = $this->model_catalog_vehicle4parts->getVehicle4Parts($this->user->getId(), $this->request->get['sku']);
			
			if (isset($vehicle4parts['vehicle4parts_id'])) {
				$json = array(
					'name'				=> $vehicle4parts['title'],
					'sku'				=> $vehicle4parts['sku'],
					'win'				=> $vehicle4parts['win'],
					'brand'				=> $this->model_catalog_vehicle->getBrandByVehicleId($vehicle4parts['vehicle_id'])['name'],
					'model'				=> $this->model_catalog_vehicle->getModelByVehicleId($vehicle4parts['vehicle_id'])['name'],
					'engine'			=> $this->model_catalog_vehicle4parts->getEngine($vehicle4parts['engine_id']),
					'engine_code'		=> $vehicle4parts['engine_code'],
					'year'				=> $vehicle4parts['year'],
					'color'				=> $this->model_catalog_vehicle4parts->getColor($vehicle4parts['color_id']),
					'color_code'		=> $vehicle4parts['color_code'],
					'transmission'		=> $this->model_catalog_vehicle4parts->getTransmission($vehicle4parts['transmission_id']),
					'gb_code'			=> $vehicle4parts['gb_code'],
					'gb_speed_level'	=> $vehicle4parts['gb_speed_level'],
					'drive'				=> $this->model_catalog_vehicle4parts->getDrive($vehicle4parts['drive_id']),
					'km'				=> $vehicle4parts['km'],
				);	
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function autocompleteCategory() {
		$json = array();
		
		$json['categories'] = array();

		if (isset($this->request->get['search']) and trim($this->request->get['search']) !== '') {
			$this->load->model('catalog/category');
			
			$categories = $this->model_catalog_category->getCategories($this->user->getId(), array('filter_name' => $this->request->get['search']));
			
			if ($categories) {
				$json['categories'] = $categories;
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function autocompleteBrand() {
		$json = array();
		
		$json['brands'] = array();

		if (isset($this->request->get['search']) and trim($this->request->get['search']) !== '') {
			$this->load->model('catalog/brand');
			
			$brands = $this->model_catalog_brand->getBrands(array('filter_name' => $this->request->get['search']));
			
			if ($brands) {
				$json['brands'] = $brands;
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function getCategoryDefaultWeight() {
		$json = array();

		if (isset($this->request->get['category_id'])) {
			$this->load->model('catalog/category');
			
			$category_data = $this->model_catalog_category->getCategory($this->request->get['category_id']);
			
			if ($category_data) {
				$json['weight'] = $category_data['default_weight'];
			} else {
				$json['weight'] = 0;
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function getNewSku() {
		$json = array();

		if (isset($this->request->get['warehouse_id'])) {
			$this->load->model('catalog/product');
			
			$json['sku'] = $this->model_catalog_product->getNewSku($this->user->getId(), $this->request->get['warehouse_id']);
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
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
			
			$watermark = new \Opencart\System\Library\Image(DIR_IMAGE . 'powered.png');
			
			$image->watermark($watermark);
			
			$image->save(DIR_IMAGE_PRODUCT . $file_name);
			
			unset($watermark);
			
			unset($image);
			
			$json['image'] = DIR_IMAGE_PRODUCT_NAME . $file_name;
			$json['path'] = HTTP_SERVER . DIR_IMAGE_PRODUCT_RELATIVE . $file_name;	
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function getModels() {
		$json = array();

		if (isset($this->request->get['brand_id'])) {
			$this->load->model('catalog/vehicle');
			
			$json = $this->model_catalog_vehicle->getModels(array('filter_brand_id' => $this->request->get['brand_id']));
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function getEngines() {
		$json = array();

		if (isset($this->request->get['model_id'])) {
			$this->load->model('catalog/vehicle');
			
			$json = $this->model_catalog_vehicle->getEngines(array('filter_model_id' => $this->request->get['model_id']));
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function enableProduct() {
		$json = array();
		
		if (isset($this->request->get['sku'])) {
			$sku = $this->request->get['sku'];
			
			$this->load->model('catalog/product');
			
			$product_id = $this->model_catalog_product->getProductIdBySku($this->user->getId(), $sku);
			
			if ($product_id) {
				$this->model_catalog_product->editProductStatus($product_id, 1);
			}
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function disableProduct() {
		$json = array();
		
		if (isset($this->request->get['sku'])) {
			$sku = $this->request->get['sku'];
			
			$this->load->model('catalog/product');
			
			$product_id = $this->model_catalog_product->getProductIdBySku($this->user->getId(), $this->request->get['sku']);
			
			if ($product_id) {
				$this->model_catalog_product->editProductStatus($product_id, 0);
			}
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function onlineshopSynchronization() {
		$json = array();
		
		if (isset($this->request->get['sku'])) {
			$sku = $this->request->get['sku'];
			
			$this->load->model('catalog/product');
			
			$product_id = $this->model_catalog_product->getProductIdBySku($this->user->getId(), $this->request->get['sku']);
			
			if ($product_id) {
				$responce = $this->onlineshopSyncProduct($sku);
				
				if ($responce) {
					$json['alerts'] = $responce;
				}
			}
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	protected function onlineshopSyncProduct($sku) {
		$responce = array();
		
		$this->load->model('integration/onlineshop/onlineshop');
		
		$sync_responce = $this->model_integration_onlineshop_onlineshop->syncProduct($this->user->getId(), $sku);
		
		foreach ($sync_responce as $onlineshop_response) {
			if (isset($onlineshop_response['success'])) {
				if ($onlineshop_response['success']) {
					$responce[] = array('type' => 'success', 'title' => $onlineshop_response['title'], 'alert' => $onlineshop_response['message']);
				} else {
					$responce[] = array('type' => 'danger', 'title' => $onlineshop_response['title'], 'alert' => $onlineshop_response['message']);
				}
			}
		}
		
		return $responce;
	}
	
	public function getCategoryByText() {
		$json = array();
		
		if (isset($this->request->get['text']) and trim($this->request->get['text']) !== '') {
			$this->load->model('catalog/category');
			
			$category_id = $this->model_catalog_category->getCategoryByText($this->user->getId(), $this->request->get['text']);
			
			if ($category_id) {
				$json['category'] = $this->model_catalog_category->getCategory($category_id);
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
