<?php
namespace Opencart\Catalog\Controller\Catalog;
class Cart extends \Opencart\System\Engine\Controller {
	public function index() {
		$this->load->model('catalog/cart');
		
		$this->load->language('catalog/cart');
		
		$data['cart_total'] = $this->model_catalog_cart->getTotal();
		$data['cart_products'] = $this->model_catalog_cart->getProducts();
		
		$data['add_order'] = $this->url->link('sale/order.edit', 'user_token=' . $this->session->data['user_token'], true);
		
		$data['user_token'] = $this->session->data['user_token'];
		
		return $this->load->view('catalog/cart', $data);
	}
	
	public function add() {
		$json = array();
	
		if(isset($this->request->get['sku'])) {
			$this->load->model('catalog/cart');
			
			$json['product'] = $this->model_catalog_cart->add($this->user->getId(), $this->request->get['sku']);
			
			$json['total'] = $this->model_catalog_cart->getTotal($this->user->getId(), $this->request->get['sku']);
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function remove() {
		$json = array();
		
		if(isset($this->request->get['sku'])) {
			$this->load->model('catalog/cart');
			
			$json['total'] = $this->model_catalog_cart->remove($this->request->get['sku']);
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}