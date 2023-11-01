<?php
namespace Opencart\Catalog\Controller\Api;
class Pieseauto extends \Opencart\System\Engine\Controller {
	public function index() {
		if(!isset($_GET['u']) or !isset($_GET['s'])) {
			return;
		}
		
		$this->load->model('integration/onlineshop/onlineshop');
		
		$storage = $this->model_integration_onlineshop_onlineshop->getStorage((int) $_GET['u'], 'pieseauto');

		if(!isset($storage['secret']) or $storage['secret'] !== $_GET['s']) {
			return;
		}

		$products = $this->getProducts((int) $_GET['u']);
		
		header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename="list.csv"');

		foreach($products as $product) {
			$price = (float) $product['price'];
			
			if(isset($storage['price_percent'])) {
				$price += $price / 100 * (float) $storage['price_percent'];
			}
			
			if(isset($storage['transport_price_fixed'])) {
				$price += (float) $storage['transport_price_fixed'];
			}
			
			if(isset($storage['transport_price_by_weight']) and is_array($storage['transport_price_by_weight'])) {
				foreach($storage['transport_price_by_weight'] as $price_by_weight) {
					if($product['weight'] >= $price_by_weight['weight_from'] and $product['weight'] <= $price_by_weight['weight_to']) {
						$price += (float) $price_by_weight['price'];
					}
				}
			}
			
			$pieseauto_category = $product['pieseauto_category'] ? $product['pieseauto_category'] : 'Various';
			
			$description = str_replace(array(';', '"', "\r", "\n"), array('', "'", '', ''), html_entity_decode($product['description']));
			
			if (isset($storage['general_description'])) {
				$description .= str_replace(array(';', '"', "\r", "\n"), array('', "'", '', ''), html_entity_decode($storage['general_description']));
			}
			
			$str = '';
			
			$str .= '"' . $product['product_id'] . '";';
			$str .= '"' . str_replace(array(';', '"'), array('', "'"), html_entity_decode($product['name'])) . '";';
			$str .= '"' . $pieseauto_category . '";';
			$str .= '"' . $description . '";';
			$str .= '"RON";';
			$str .= '"' . round($this->currency->convert($product['price'], '0', 'RON'), 2) . '";';
			$str .= '"' . (int) $product['quantity'] . '";';
			
			$images = array();
			
			if($product['image']) {
				$images[] = HTTP_SERVER . DIR_IMAGE_RELATIVE . $product['image'];
			}
			
			foreach($this->getProductImages($product['product_id']) as $image) {
				$images[] = HTTP_SERVER . DIR_IMAGE_RELATIVE . $image['image'];
			}
			
			$str .= '"' . implode('[,]', str_replace('[,]', '[%2C]', $images)) . '";';
			
			if ($product['used'] == 1) {
				$str .= '"second"';
			} else {
				$str .= '"new"';
			}
			
			$str .= "\n";
			
			echo $str;
		}
	}
	
	private function getProductImages($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_image WHERE product_id = '" . (int) $product_id . "' ORDER BY sort_order ASC");
		
		return $query->rows;
	}
	
	private function getProducts($user_id) {
		$language_id = 2;
		
		$sql = "SELECT p.product_id, p.price, p.quantity, pd.name, pd.description, p.image, p.weight, p.used, pc.pieseauto_category FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_user ptu ON (p.product_id = ptu.product_id) LEFT JOIN " . DB_PREFIX . "product_to_category ptcat ON (p.product_id = ptcat.product_id) LEFT JOIN " . DB_PREFIX . "product_to_onlineshop ptm ON (p.product_id = ptm.product_id) LEFT JOIN " . DB_PREFIX . "category_to_pieseauto_category ctpc ON (ptcat.category_id = ctpc.category_id) LEFT JOIN pieseauto_category pc ON (pc.pieseauto_category_id = ctpc.pieseauto_category_id) WHERE ptu.user_id = '" . (int) $user_id . "' AND pd.language_id = '" . (int) $language_id . "' AND ptm.onlineshop_code = 'pieseauto' AND ptm.status = '1' AND p.status = '1' GROUP BY p.product_id";
		
		$query = $this->db->query($sql);
		
		return $query->rows;
	}
}