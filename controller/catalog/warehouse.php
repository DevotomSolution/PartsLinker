<?php
namespace Opencart\Catalog\Controller\Catalog;
class Warehouse extends \Opencart\System\Engine\Controller {
	private $error = array();

	public function index() {
		$this->load->model('catalog/product');
		$this->load->model('catalog/warehouse');
		$this->load->model('tool/image');
		
		$this->load->language('catalog/warehouse');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->getList();
	}

	protected function getList() {
		$limit = 20;
		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if (isset($this->request->get['warehouse_id'])) {
			$warehouse_id = $this->request->get['warehouse_id'];
		} else {
			$warehouse_id = '';
		}
		
		if (isset($this->request->get['search'])) {
			$search = $this->request->get['search'];
		} else {
			$search = '';
		}

		if (isset($this->request->get['page'])) {
			$page = (int)$this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';
		
		$url .= '&user_token=' . $this->session->data['user_token'];

		if (isset($this->request->get['warehouse_id'])) {
			$url .= '&warehouse_id=' . $this->request->get['warehouse_id'];
		}
		
		if (isset($this->request->get['search'])) {
			$url .= '&search=' . urlencode(html_entity_decode($this->request->get['search'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		$url .= '&redirect=catalog/warehouse';
		
		$warehouses = $this->model_catalog_warehouse->getWarehouses($this->user->getId());

		$filter_data = array(
			'search_warehouse'	=> $search,
			'filter_warehouse'	=> $warehouse_id,
			'start'				=> ($page - 1) * $limit,
			'limit'				=> $limit
		);

		$product_total = $this->model_catalog_product->getTotalProducts($this->user->getId(), $filter_data);

		$results = $this->model_catalog_product->getProducts($this->user->getId(), $filter_data, false, false);
		
		$data['products'] = array();

		foreach ($results as $result) {
			if(is_file(DIR_IMAGE . $result['image'])) {
				$image = $this->model_tool_image->resize($result['image'], 60, 60);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 60, 60);
			}

			$data['products'][] = array(
				'sku'			=> $result['sku'],
				'image'			=> $image,
				'quantity'		=> $result['quantity'],
				'label'			=> $this->url->link('info/label', 'product=' . $result['sku'] . $url, true),
				'edit'			=> $this->url->link('catalog/product.edit', 'product=' . $result['sku'] . $url, true),
				'warehouse'		=> isset($warehouses[$result['warehouse_id']]) ? $warehouses[$result['warehouse_id']]['name'] : '',
				'location'		=> $result['location'],
				'date_modified'	=> $result['date_modified'],
			);
		}
		
		$data['warehouses'] = $warehouses;

		$url = '';
		
		$url .= '&user_token=' . $this->session->data['user_token'];

		if (isset($this->request->get['warehouse_id'])) {
			$url .= '&warehouse_id=' . $this->request->get['warehouse_id'];
		}
		
		if (isset($this->request->get['search'])) {
			$url .= '&search=' . urlencode(html_entity_decode($this->request->get['search'], ENT_QUOTES, 'UTF-8'));
		}
		
		$data['pagination'] = $this->load->controller('common/pagination', [
			'total' => $product_total,
			'page'  => $page,
			'limit' => $limit,
			'url'   => $this->url->link('catalog/warehouse', 'user_token=' . $this->session->data['user_token'] . $url . '&page={page}')
		]);

		$data['results'] = sprintf($this->language->get('text_pagination'), ($product_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($product_total - $limit)) ? $product_total : ((($page - 1) * $limit) + $limit), $product_total, ceil($product_total / $limit));

		$data['search'] = $search;
		
		$data['warehouse_id'] = $warehouse_id;
		
		$data['user_token'] = $this->session->data['user_token'];
		$data['vehicle4parts'] = $this->url->link('catalog/vehicle4parts', $url, true);
		$data['product'] = $this->url->link('catalog/product', $url, true);
		
		$this->document->addScript(HTTP_SERVER . 'view/js/JsBarcode.all.min.js', 'footer');

		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['navigation'] = $this->load->controller('common/navigation');
		
		$this->response->setOutput($this->load->view('catalog/warehouse', $data));
	}
	
	public function editLocation() {
		$json = array();
		
		if (!empty($this->request->get['cod']) && !empty($this->request->get['location'])) {
			$this->load->model('catalog/product');
			
			$product_id = $this->model_catalog_product->getProductIdBySkuOrEan($this->user->getId(), $this->request->get['cod']);
			
			if($product_id) {
				$this->model_catalog_product->editProductLocation($product_id, $this->request->get['location']);
				
				$json['sku'] = $this->model_catalog_product->getSkuByProductId($this->user->getId(), $product_id);
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function editQuantity() {
		$json = array();
		
		if (!empty($this->request->get['sku']) && !empty($this->request->get['quantity'])) {
			$this->load->model('catalog/product');
			
			$product_id = $this->model_catalog_product->getProductIdBySku($this->user->getId(), $this->request->get['sku']);
			
			if($product_id) {
				$json['date'] = $this->model_catalog_product->editProductStock($product_id, (int) $this->request->get['quantity']);
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
