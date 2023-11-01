<?php
namespace Opencart\Catalog\Controller\Api;
class Warehouse extends \Opencart\System\Engine\Controller {
	public function index() {
        $json = array();
		
		$this->load->language('catalog/warehouse');
		
		if (!empty($this->request->post['cod']) && !empty($this->request->post['location'])) {
			$this->load->model('catalog/product');

			$product_id = $this->model_catalog_product->getProductIdBySkuOrEan($this->user->getId(), $this->request->post['cod']);

			if ($product_id) {
				$this->model_catalog_product->editProductLocation($product_id, $this->request->post['location']);

				$json['sku'] = $this->model_catalog_product->getSkuByProductId($this->user->getId(), $product_id);
			} else {
				$json['error'] = $this->language->get('error_cod');
			}
        } else {
			$json['error'] = $this->language->get('error_warning');
		}
		
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    public function editQuantity() {
        $json = array();
		
		$this->load->language('catalog/warehouse');

        if (!empty($this->request->get['sku']) && !empty($this->request->get['quantity'])) {
            $this->load->model('catalog/product');

            $product_id = $this->model_catalog_product->getProductIdBySku($this->user->getId(), $this->request->get['sku']);

            if ($product_id) {
                $json['date'] = $this->model_catalog_product->editProductStock($product_id, (int) $this->request->get['quantity']);
            } else {
				$json['error'] = $this->language->get('error_sku');
			}
        } else {
			$json['error'] = $this->language->get('error_warning');
		}

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
}
