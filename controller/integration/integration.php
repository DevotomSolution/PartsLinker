<?php
namespace Opencart\Catalog\Controller\Integration;
class Integration extends \Opencart\System\Engine\Controller {
	public function index() {
		$this->load->model('integration/onlineshop/onlineshop');
		$this->load->model('integration/delivery/delivery');
		
		$this->load->language('integration/integration');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$onlineshops = $this->model_integration_onlineshop_onlineshop->getOnlineshops();
		$active_onlineshops = $this->model_integration_onlineshop_onlineshop->getActiveOnlineshops($this->user->getId());
		
		$delivery_methods = $this->model_integration_delivery_delivery->getDeliveryMethods();
		$active_delivery_methods = $this->model_integration_delivery_delivery->getActiveDeliveryMethods($this->user->getId());
		
		foreach ($onlineshops as $onlineshop) {
			$onlineshop['active'] = isset($active_onlineshops[$onlineshop['code']]);
			$onlineshop['link'] = $this->url->link('integration/onlineshop/' . $onlineshop['code'], '&user_token=' . $this->session->data['user_token'], true);
			$onlineshop['image'] = HTTP_SERVER . $onlineshop['image'];
			
			$data[$onlineshop['type']][$onlineshop['code']] = $onlineshop;
		}
		
		foreach ($delivery_methods as $delivery_method) {
			$delivery_method['active'] = isset($active_delivery_methods[$delivery_method['code']]);
			$delivery_method['link'] = $this->url->link('integration/delivery/' . $delivery_method['code'], '&user_token=' . $this->session->data['user_token'], true);
			$delivery_method['image'] = HTTP_SERVER . $delivery_method['image'];
			
			$data['delivery'][$delivery_method['code']] = $delivery_method;
		}
		
		$data['user_token'] = $this->session->data['user_token'];
		
		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['navigation'] = $this->load->controller('common/navigation');
		
		$this->response->setOutput($this->load->view('integration/integration', $data));
	}
}
