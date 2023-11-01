<?php
namespace Opencart\Catalog\Model\Catalog;
class Cart extends \Opencart\System\Engine\Model {
	public function getProducts() {
		if(isset($this->session->data['cart'])) {
			return $this->session->data['cart'];
		} else {
			return array();
		}
	}
	
	public function add($user_id, $sku) {
		$this->load->model('catalog/product');
	
		$product = $this->model_catalog_product->getProduct($user_id, $sku);
		
		if(!$product) {
			return $this->getTotal();
		}
		
		$price_formated = $this->currency->format($product['price'], $this->user->get('currency'));
		
		if (isset($this->session->data['cart'][$sku])) {
			$this->session->data['cart'][$sku]['quantity'] += 1;
		} else {
			$this->load->model('tool/image');
			
			if($product['image']) {
				$image_min = $this->model_tool_image->resize($product['image'], 75, 75);
			} else {
				$image_min = $this->model_tool_image->resize('no_image.png', 75, 75);
			}
			
			$name = oc_substr($product['name'], 0, 18);
			
			if (mb_strlen($product['name']) > 18) {
				$name .= '...';
			}
			
			$this->session->data['cart'][$sku] = array(
				'sku'				=> $sku,
				'name'				=> $name,
				'image'				=> $image_min,
				'quantity'			=> 1,
				'price_formated'	=> $price_formated ,
				'link'				=> $product['link'],
			);
		}
	
		return $this->session->data['cart'][$sku];
	}
	
	public function remove($sku) {
		unset($this->session->data['cart'][$sku]);
		return $this->getTotal();
	}
	
	public function getTotal() {
		$total = 0;
		
		if(isset($this->session->data['cart'])) {
			foreach($this->session->data['cart'] as $product) {
				$total += $product['quantity'];
			}
		}
		
		return $total;
	}
	
	public function clear() {
		$this->session->data['cart'] = array();
	}
}