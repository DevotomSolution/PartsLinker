<?php
namespace Opencart\Catalog\Controller\Admin\Vehicle;
class Color extends \Opencart\System\Engine\Controller {
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
		
		$this->load->model('localisation/language');
		
		$data['languages'] = $this->model_localisation_language->getLanguages();
		
		$this->load->model('catalog/vehicle');
		
		$data['vehicle_colors'] = $this->model_catalog_vehicle->getColors();

		$data['user_token'] = $this->session->data['user_token'];
		
		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['navigation'] = $this->load->controller('common/navigation');
		
		$this->response->setOutput($this->load->view('admin/vehicle_color', $data));
	}
	
	public function add() {
		$json = array();
		
		if(isset($this->request->post['color_description'])) {
			$this->load->model('catalog/vehicle');
			
			$json['color_id'] = $this->model_catalog_vehicle->addColor($this->request->post['color_description']);
			
			$json['text'] = $this->request->post['color_description'][$this->user->get('language_id')];
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function remove() {
		if(isset($this->request->get['color_id'])) {
			$this->load->model('catalog/vehicle');
			
			$this->model_catalog_vehicle->deleteColor($this->request->get['color_id']);
		}
	}
}