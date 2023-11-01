<?php
namespace Opencart\Catalog\Controller\Admin\Vehicle;
class GBSpeedLevel extends \Opencart\System\Engine\Controller {
	public function index() {
		$this->load->language('admin/vehicle');

		$this->document->setTitle($this->language->get('heading_title'));
		
		if(isset($this->session->data['error'])) {
			$data['error_warning'] = $this->session->data['error'];

			unset($this->session->data['error']);
		} else {
			$data['error_warning'] = '';
		}
		
		if(isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}
		
		$this->load->model('catalog/vehicle');
		
		$data['vehicle_gb_speed_levels'] = $this->model_catalog_vehicle->getGBSpeedLevels();

		$data['user_token'] = $this->session->data['user_token'];
		
		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['navigation'] = $this->load->controller('common/navigation');
		
		$this->response->setOutput($this->load->view('admin/vehicle_gb_speed_level', $data));
	}
	
	public function add() {
		$json = array();

		if(isset($this->request->post['gb_speed_level_text'])) {
			$this->load->model('catalog/vehicle');
			
			$json['gb_speed_level_id'] = $this->model_catalog_vehicle->addGBSpeedLevel($this->request->post['gb_speed_level_text']);
			
			$json['text'] = (int) $this->request->post['gb_speed_level_text'];
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function remove() {
		if(isset($this->request->get['gb_speed_level_id'])) {
			$this->load->model('catalog/vehicle');
			
			$this->model_catalog_vehicle->deleteGBSpeedLevel($this->request->get['gb_speed_level_id']);
		}
	}
}