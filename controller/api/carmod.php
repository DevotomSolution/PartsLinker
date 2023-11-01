<?php
namespace Opencart\Catalog\Controller\Api;
class Carmod extends \Opencart\System\Engine\Controller {
	public function index() {
		if(!isset($this->request->get['u'])) {
			return;
		}
		
		$this->load->model('catalog/product');

		$products = $this->model_catalog_product->getProducts((int) $this->request->get['u']);
		
		if (empty($products)) {
			die();
		}
		
		header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename="list.csv"');
		
		$str = '';
	
		$str .= '"Product Id";';
		$str .= '"Manufacturer";';
		$str .= '"MPN";';
		$str .= '"OEM";';
		$str .= '"Quantity";';
		$str .= '"Price(EUR)";';
		$str .= '"Name"';
		
		$str .= "\n";
		
		echo $str;

		foreach($products as $product) {
			if (empty($product['brand']) or empty($product['mpn'])) {
				continue;
			}
			
			$str = '';
			
			$str .= '"' . (int) $product['product_id'] . '";';
			$str .= '"' . $product['brand'] . '";';
			$str .= '"' . $product['mpn'] . '";';
			$str .= '"' . $product['oem'] . '";';
			$str .= '"' . (int) $product['quantity'] . '";';
			$str .= '"' . (float) $product['price'] . '";';
			$str .= '"' . $product['name'] . '"';
			
			$str .= "\n";
			
			echo $str;
		}
	}

}