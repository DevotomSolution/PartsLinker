<?php
namespace Opencart\Catalog\Controller\Info;
class Label extends \Opencart\System\Engine\Controller {
	public function index() {
		$this->load->model('info/label');
		
		$this->load->language('info/label');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$url = '';
		
		foreach($this->request->get as $key => $value) {
			if($key === 'route' or $key === '_route_' or $key === 'redirect' or $key === 'product' or $key === 'vehicle4parts' or $key === 'price') {
				continue;
			}
			
			if($url) {
				$url .= '&';
			}
			
			$url .= $key . '=' . $value;
		}
		
		if(isset($this->request->get['product'])) {
			$this->load->model('catalog/product');
			
			if(isset($this->request->get['redirect'])) {
				$data['cancel'] = $this->url->link($this->request->get['redirect'], $url, true);
			} else {
				$data['cancel'] = $this->url->link('catalog/product', $url, true);
			}
			
			$product_info = $this->model_catalog_product->getProduct($this->user->getId(), $this->request->get['product']);

			$data['link'] = $product_info['link'];
			$data['name'] = $product_info['name'];
			
			$text = $product_info['sku'];
		}
		
		if(isset($this->request->get['vehicle4parts'])) {
			$this->load->model('catalog/vehicle4parts');
			
			$data['cancel'] = $this->url->link('catalog/vehicle4parts', $url, true);
			
			$vehicle4parts_info = $this->model_catalog_vehicle4parts->getVehicle4Parts($this->user->getId(), $this->request->get['vehicle4parts']);
			
			$data['link'] = $vehicle4parts_info['link'];
			$data['name'] = $vehicle4parts_info['title'];
			
			$text = $vehicle4parts_info['sku'];
		}
		
		$label_data = $this->model_info_label->getLabel($this->user->get('label'));
		
		$data['label_width'] = $label_data['label_width'];
		$data['label_height'] = $label_data['label_height'];
		$data['barcode_width'] = $label_data['barcode_width'];
		$data['barcode_height'] = $label_data['barcode_height'];
		$data['qrcode_size'] = $label_data['qrcode_size'];
		$data['font_size'] = $label_data['font_size'];
		$data['label_type'] = $label_data['label_type'];
		
		$data['text'] = $text;
		
		$this->document->addScript(HTTP_SERVER . 'view/js/JsBarcode.all.min.js', 'footer');
		$this->document->addScript(HTTP_SERVER . 'view/js/jquery-qrcode-0.18.0.min.js', 'footer');
		
		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['navigation'] = $this->load->controller('common/navigation');
		
		$this->response->setOutput($this->load->view('info/label', $data));
	}
}