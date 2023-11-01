<?php
namespace Opencart\Catalog\Model\Integration\Onlineshop;
class Pieseauto extends \Opencart\System\Engine\Model {
	public function getStorage($user_id) {
		$this->load->model('integration/onlineshop/onlineshop');
		
		return $this->model_integration_onlineshop_onlineshop->getStorage($user_id, 'pieseauto');
	}
	
	public function editStorage($user_id, $storage) {
		$this->load->model('integration/onlineshop/onlineshop');
		
		$this->model_integration_onlineshop_onlineshop->editStorage($user_id, 'pieseauto', $storage);
	}
	
	public function setStorageValue($user_id, $key, $value) {
		$this->load->model('integration/onlineshop/onlineshop');
		
		return $this->model_integration_onlineshop_onlineshop->setStorageValue($user_id, 'pieseauto', $key, $value);
	}
	
	public function connect($user_id, $rewrite = false) {
		if (isset($this->session->data['pieseauto']['connected']) and !$rewrite) {
			return $this->session->data['pieseauto']['connected'];
		}
		
		$this->session->data['pieseauto']['connected'] = 0;
		
		$storage = $this->getStorage($user_id);
		
		if (!$storage) {
			return 0;
		}
		
		$this->session->data['pieseauto'] = $storage;
		
		if (empty($storage['auth_code'])) {
			$this->session->data['pieseauto']['connected'] = 1;
			return 1;
		}
		
		if (!isset($storage['last_orderid']) or $rewrite) {
			$orders = $this->getOrdersPrivate($storage['auth_code']);

			if (!isset($orders['orders'])) {
				return 0;
			} else {
				if (count($orders['orders'])) {
					$last_orderid = $orders['orders'][0]['order_id'];
				} else {
					$last_orderid = 0;
				}
				
				$this->session->data['pieseauto']['last_orderid'] = $this->setStorageValue($user_id, 'last_orderid', $last_orderid);
			}
		}
		
		$this->session->data['pieseauto']['connected'] = 1;
		
		return 1;
	}
	
	public function syncProduct($user_id, $sku, $product = false) {
		$response = array(
			'success' => 0,
			'message' => '',
		);
		
		if (!$this->connect($user_id)) {
			return $response;
		}
		
		$this->load->language('integration/onlineshop');
		
		if ($product === false) {
			$this->load->model('catalog/product');
			
			$product = $this->model_catalog_product->getProduct($user_id, $sku);
		}
		
		if ($product and $product['status'] and isset($product['onlineshops']['pieseauto']) and $product['onlineshops']['pieseauto']['status']) {
			$response['success'] = 1;
			$response['message'] = $this->language->get('text_success');
		}
		
		return $response;
	}
	
	public function getOrders($user_id) {
		$response = array();
		
		if (empty($this->session->data['pieseauto']['auth_code'])) {
			return $response;
		}
		
		$this->load->model('sale/order');
		$this->load->model('catalog/product');
		$this->load->model('integration/onlineshop/onlineshop');
		
		$this->load->language('sale/order');
		
		$auth_code = $this->session->data['pieseauto']['auth_code'];
		$last_orderid = $this->session->data['pieseauto']['last_orderid'];
		
		$orders = $this->getOrdersPrivate($auth_code, $last_orderid);	
	
		if (!isset($orders['orders'])) {
			return $response;
		}
		
		$max = 50;
		
		if (count($orders['orders']) > $max) {
			$orders['orders'] = array_slice($orders['orders'], count($orders['orders']) - $max - 1);
		}
		
		foreach($orders['orders'] as $order) {
			if ($order['order_id'] > $last_orderid) {
				$last_orderid = $order['order_id'];
			}
			
			$order_data['onlineshop_order_id'] = $order['order_id'];
			
			$order_id = $this->model_sale_order->getOrderIdByOnlineshopOrderId($user_id, $order_data['onlineshop_order_id']);
			
			if (!$order_id) {
				$order_data['date_added'] = date("Y-m-d H:i:s", $order['order_date']);
				$order_data['date_modified'] = $order_data['date_added'];
			}
			
			if ($order['order_status'] == 'finalized') {
				$order_data['order_status'] = $this->config->get('config_complete_status')[0];
			}
			
			if ($order['order_status'] == 'cancelled') {
				$order_data['order_status'] = $this->config->get('config_fraud_status_id');
			}
			
			if ($order_id) {
				$order_data['order_id'] = $order_id;
				$response[] = $order_data;
				continue;
			}
			
			$order_data['invoice_prefix'] = $this->config->get('config_invoice_prefix');
			
			$order_data['store_name'] = $this->user->get('company');
			$order_data['store_url'] = $this->user->get('website');
			$order_data['onlineshop_code'] = 'pieseauto';
			
			$order_data['fullname'] = $order['buyer_name'];
			
			$order_data['email'] = $order['buyer_email'];
			$order_data['telephone'] = $order['buyer_phone'];
			
			$order_data['shipping_company'] = '';
			$order_data['shipping_address_1'] = $order['shipping_address'];
			$order_data['shipping_address_2'] = '';
			$order_data['shipping_city'] = $order['shipping_city'];
			$order_data['shipping_postcode'] = '';
			
			$order_data['comment'] = $order['buyer_comments'];
			
			$order_data['shipping_country'] = 'Romania';
			$order_data['shipping_country_id'] = '';
			$order_data['shipping_zone'] = $order['shipping_county'];
			$order_data['shipping_zone_id'] = '';
			
			$order_data['shipping_method'] = $order['shipping_type'];
			$order_data['shipping_code'] = '';
			
			$order_data['order_product'] = array();
			
			$sub_total = 0;
			
			foreach($order['items'] as $item) {
				$sku = $this->model_catalog_product->getSkuByProductId($user_id, $item['external_id']);
				
				$product_data = $this->model_catalog_product->getProduct($user_id, $sku);
				
				if ($product_data) {
					$weight = $product_data['weight'];
				} else {
					$weight = 0;
				}
				
				$order_data['order_product'][] = array(
					'product_id'	=> $sku ? $item['external_id'] : 0,
					'sku'			=> $sku ? $sku : '',
					'name'			=> $item['title'],
					'quantity'		=> $item['quantity'],
					'price'			=> $item['unit_price_ron'],
					'total'			=> $item['unit_price_ron'] * $item['quantity'],
					'weight'		=> $weight,
				);
				
				$sub_total += $item['unit_price_ron'] * $item['quantity'];
			}
			
			$total_data = array();
			$total = 0;
			
			$total_data['sub_total'] = array(
				'code' => 'sub_total',
				'title' => $this->language->get('text_sub_total'),
				'value' => $sub_total,
				'sort_order' => '1',
			);
			
			$total += $sub_total;
			
			$total_data['shipping'] = array(
				'code' => 'shipping',
				'title' => $this->language->get('text_shipping'),
				'value' => $order['shipping_cost_ron'],
				'sort_order' => '2',
			);
			
			$total += (float) $order['shipping_cost_ron'];
			
			$total_data['total'] = array(
				'code' => 'total',
				'title' => $this->language->get('text_total'),
				'value' => $total,
				'sort_order' => '9',
			);
			
			$order_data['order_totals'] = $total_data;
			$order_data['total'] = $total;

			$order_data['currency_code'] = 'RON';
			$order_data['currency_id'] = $this->currency->getId($order_data['currency_code']);
			$order_data['currency_value'] = $this->currency->getValue($order_data['currency_code']);

			$response[] = $order_data;
		}
		
		if (isset($last_orderid)) {
			$this->session->data['pieseauto']['last_orderid'] = $this->setStorageValue($user_id, 'last_orderid', $last_orderid);
		}
		
		return $response;
	}
	
	//
	// FUNCTIONS
	//
	
	private function getOrdersPrivate($auth_code, $last_orderid = false) {
		$url = 'https://www.pieseauto.ro/ctl.php?a=exportOrders&auth=' . $auth_code;
		
		if ($last_orderid !== false) {
			$url .= '&last_orderid=' . $last_orderid;
		}
		
		$ch = curl_init($url);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		
		$response = curl_exec($ch);
		
		curl_close($ch);
		
		return json_decode($response, true);
	}
}