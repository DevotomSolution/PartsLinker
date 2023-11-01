<?php
namespace Opencart\Catalog\Controller\Catalog;
class VehicleBrand extends \Opencart\System\Engine\Controller {
	private $error = array();
	
	public function index() {
		$this->load->model('catalog/vehicle');
		
		$this->load->language('catalog/vehicle_brand');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->getList();
	}
	
	private function getList() {
		$limit = 50;
		
		if(isset($this->request->get['page'])) {
			$page = (int)$this->request->get['page'];
		} else {
			$page = 1;
		}
		
		$filter_data = array(
			'start' => ($page - 1) * $limit,
			'limit' => $limit,
		);
		
		$data['user_vehicle_brands'] = array_column($this->model_catalog_vehicle->getBrands($this->user->getId()), 'id', 'id');

		$data['vehicle_brands'] = $this->model_catalog_vehicle->getBrands(false, $filter_data);		
		
		$vehicle_brands_total = $this->model_catalog_vehicle->getTotalBrands();

		$url = '';
		
		$url .= '&user_token=' . $this->session->data['user_token'];
		
		$data['pagination'] = $this->load->controller('common/pagination', [
			'total' => $vehicle_brands_total,
			'page'  => $page,
			'limit' => $limit,
			'url'   => $this->url->link('catalog/product', 'user_token=' . $this->session->data['user_token'] . $url . '&page={page}')
		]);

		$data['results'] = sprintf($this->language->get('text_pagination'), ($vehicle_brands_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($vehicle_brands_total - $limit)) ? $vehicle_brands_total : ((($page - 1) * $limit) + $limit), $vehicle_brands_total, ceil($vehicle_brands_total / $limit));

		$data['user_token'] = $this->session->data['user_token'];
		
		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['navigation'] = $this->load->controller('common/navigation');
		
		$this->response->setOutput($this->load->view('catalog/vehicle_brand_list', $data));
	}

	public function enableVehicleBrand() {
		if(isset($this->request->get['vehicle_brand_id'])) {
			$this->load->model('catalog/vehicle');
			
			$this->model_catalog_vehicle->enableVehicleBrandForUser($this->user->getId(), (int) $this->request->get['vehicle_brand_id']);
		}
	}
	
	public function disableVehicleBrand() {
		if(isset($this->request->get['vehicle_brand_id'])) {
			$this->load->model('catalog/vehicle');
			
			$json = $this->model_catalog_vehicle->disableVehicleBrandForUser($this->user->getId(), (int) $this->request->get['vehicle_brand_id']);
		}
	}
}
