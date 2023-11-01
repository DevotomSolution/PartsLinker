<?php
namespace Opencart\Catalog\Controller\Sale;
class Order extends \Opencart\System\Engine\Controller {
	private $error = array();

	public function index() {
		$this->load->model('sale/order');
		$this->load->model('localisation/order_status');
		$this->load->model('integration/onlineshop/onlineshop');
		
		$this->load->language('sale/order');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->getList();
	}
	
	protected function getList() {
		$limit = 20;
		
		if (isset($this->request->get['filter_order_status'])) {
			$filter_order_status = $this->request->get['filter_order_status'];
		} else {
			$filter_order_status = '';
		}
		
		if (isset($this->request->get['filter_order_status_id'])) {
			$filter_order_status_id = $this->request->get['filter_order_status_id'];
		} else {
			$filter_order_status_id = '';
		}
		
		if (isset($this->request->get['filter_date_added'])) {
			$filter_date_added = $this->request->get['filter_date_added'];
		} else {
			$filter_date_added = '';
		}

		if (isset($this->request->get['filter_date_modified'])) {
			$filter_date_modified = $this->request->get['filter_date_modified'];
		} else {
			$filter_date_modified = '';
		}
		
		if (isset($this->request->get['filter_onlineshop'])) {
			$filter_onlineshop = $this->request->get['filter_onlineshop'];
		} else {
			$filter_onlineshop = '';
		}

		if (isset($this->request->get['page'])) {
			$page = (int)$this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['filter_order_status'])) {
			$url .= '&filter_order_status=' . $this->request->get['filter_order_status'];
		}
	
		if (isset($this->request->get['filter_order_status_id'])) {
			$url .= '&filter_order_status_id=' . $this->request->get['filter_order_status_id'];
		}
			
		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}

		if (isset($this->request->get['filter_date_modified'])) {
			$url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
		}
		
		if (isset($this->request->get['filter_onlineshop'])) {
			$url .= '&filter_onlineshop=' . $this->request->get['filter_onlineshop'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['invoice'] = $this->url->link('sale/order.invoice', 'user_token=' . $this->session->data['user_token'], true);
		$data['add'] = $this->url->link('sale/order.edit', 'user_token=' . $this->session->data['user_token'] . $url, true);
		
		$data['onlineshops'] = $this->model_integration_onlineshop_onlineshop->getOnlineshops();

		$data['orders'] = array();

		$filter_data = array(
			'filter_order_status'		=> $filter_order_status,
			'filter_order_status_id'	=> $filter_order_status_id,
			'filter_date_added'			=> $filter_date_added,
			'filter_date_modified'		=> $filter_date_modified,
			'filter_onlineshop'		=> $filter_onlineshop,
			'start'						=> ($page - 1) * $limit,
			'limit'						=> $limit
		);

		$order_total = $this->model_sale_order->getTotalOrders($this->user->getId(), $filter_data);

		$results = $this->model_sale_order->getOrders($this->user->getId(), $filter_data);

		foreach ($results as $result) {
			if ($result['onlineshop_code'] and isset($data['onlineshops'][$result['onlineshop_code']]['title'])) {
				$onlineshop_title = $data['onlineshops'][$result['onlineshop_code']]['title'];
			} else {
				$onlineshop_title = '';
			}
			
			$data['orders'][] = array(
				'order_id'				=> $result['order_id'],
				'customer'				=> $result['customer'],
				'order_status'			=> $result['order_status'] ? $result['order_status'] : $this->language->get('text_missing'),
				'order_status_id'		=> $result['order_status_id'],
				'total'					=> $this->currency->format($result['total'], $result['currency_code'], 1),
				'date_added'			=> date($this->language->get('date_format_short'), strtotime($result['date_added'])),
				'date_modified'			=> date($this->language->get('date_format_short'), strtotime($result['date_modified'])),
				'view'					=> $this->url->link('sale/order.edit', 'user_token=' . $this->session->data['user_token'] . '&order_id=' . $result['order_id'] . $url, true),
				'onlineshop'			=> $onlineshop_title,
				'onlineshop_order_id'	=> $result['onlineshop_order_id'],
				'invoice'				=> $result['invoice_no'] ? $this->url->link('sale/order.invoice', 'user_token=' . $this->session->data['user_token'] . '&order_id=' . $result['order_id'], true) : '',
			);
		}
		
		$data['processing_status'] =  $this->config->get('config_processing_status');
		$data['complete_status'] =  $this->config->get('config_complete_status');
		$data['fraud_status_id'] =  $this->config->get('config_fraud_status_id');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}
		
		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		if (isset($this->request->get['filter_order_status'])) {
			$url .= '&filter_order_status=' . $this->request->get['filter_order_status'];
		}
		
		if (isset($this->request->get['filter_order_status_id'])) {
			$url .= '&filter_order_status_id=' . $this->request->get['filter_order_status_id'];
		}
			
		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}

		if (isset($this->request->get['filter_date_modified'])) {
			$url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
		}
		
		if (isset($this->request->get['filter_onlineshop'])) {
			$url .= '&filter_onlineshop=' . $this->request->get['filter_onlineshop'];
		}
		
		$data['pagination'] = $this->load->controller('common/pagination', [
			'total' => $order_total,
			'page'  => $page,
			'limit' => $limit,
			'url'   => $this->url->link('sale/order', 'user_token=' . $this->session->data['user_token'] . $url . '&page={page}')
		]);

		$data['results'] = sprintf($this->language->get('text_pagination'), ($order_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($order_total - $limit)) ? $order_total : ((($page - 1) * $limit) + $limit), $order_total, ceil($order_total / $limit));

		$data['filter_order_status'] = $filter_order_status;
		$data['filter_order_status_id'] = $filter_order_status_id;
		$data['filter_date_added'] = $filter_date_added;
		$data['filter_date_modified'] = $filter_date_modified;
		$data['filter_onlineshop'] = $filter_onlineshop;

		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
		
		$data['user_token'] = $this->session->data['user_token'];
		$data['limit'] = $limit;

		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['navigation'] = $this->load->controller('common/navigation');

		$this->response->setOutput($this->load->view('sale/order_list', $data));
	}	
	
	public function createInvoiceNo() {
		$this->load->language('sale/order');

		$json = array();

		if (isset($this->request->get['order_id'])) {
			$order_id = $this->request->get['order_id'];
		} else {
			$order_id = 0;
		}

		$this->load->model('sale/order');

		$invoice_no = $this->model_sale_order->createInvoiceNo($this->user->getId(), $order_id);

		if ($invoice_no) {
			$json['invoice_no'] = $invoice_no;
			$json['invoice'] = $this->url->link('sale/order.invoice', '&user_token=' . $this->session->data['user_token'] . '&order_id=' . $order_id, true);
		} else {
			$json['error'] = $this->language->get('error_action');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function getZones() {
		$json = array();
		
		if (isset($this->request->get['country_id'])) {
			$this->load->model('localisation/zone');
			
			$zones = $this->model_localisation_zone->getZonesByCountryId($this->request->get['country_id']);
			
			foreach($zones as $zone) {
				$json[] = array(
					'id'	=> $zone['zone_id'],
					'name'	=> $zone['name'],
				);	
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function autocompleteProduct() {
		$json = array();
		
		if (!empty($this->request->get['search'])) {
			$this->load->model('catalog/product');
			
			$products = $this->model_catalog_product->autocompleate($this->user->getId(), $this->request->get['search']);
			
			foreach($products as $product) {
				$json[] = array(
					'sku'		=> $product['sku'],
					'name'		=> $product['name'],
					'price'		=> $product['price'],
					'weight'	=> $product['weight'],
				);	
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function getProductBySku() {
		$json = array();
		
		if (!empty($this->request->get['sku'])) {
			$this->load->model('catalog/product');
			
			$product = $this->model_catalog_product->getProduct($this->user->getId(), $this->request->get['sku']);
			
			if ($product) {
				$json = array(
					'name'		=> $product['name'],
					'price'		=> $product['price'],
					'weight'	=> $product['weight'],
				);	
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function getOrdersFromOnlineshops() {
		$json = array(
			'total' => 0,
		);
		
		if (!isset($this->session->data['orders_from_onlineshop_last_update']) or $this->session->data['orders_from_onlineshop_last_update'] < time()-60*15) {
			$this->load->model('sale/order');
			$this->load->model('integration/onlineshop/onlineshop');
			
			$orders = $this->model_integration_onlineshop_onlineshop->getOrders($this->user->getId());
			
			foreach($orders as $order_data) {
				$json['total']++;
				
				if (isset($order_data['order_id']) && isset($order_data['order_status'])) {
					if (isset($order_data['date_modified'])) {
						$date_modified = $order_data['date_modified'];
					} else {
						$date_modified = false;
					}
					
					$this->model_sale_order->addOrderHistory($this->user->getId(), $order_data['order_id'], $order_data['order_status'], '', $date_modified);
					continue;
				} elseif (isset($order_data['order_id'])) {
					continue;
				}
				
				$this->model_sale_order->addOrder($this->user->getId(), $order_data);
				
				if ($order_data['onlineshop_code'] !== 'baselinker') {
					$this->load->model('integration/onlineshop/baselinker');
					
					$this->model_integration_onlineshop_baselinker->syncOrder($this->user->getId(), $order_data);
				}
			}
			
			if (count($orders) < 50) {
				$this->session->data['orders_from_onlineshop_last_update'] = time();
			}
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function invoice2() {
		$this->load->model('sale/order');
		
		$this->load->language('sale/order');

		$data['title'] = $this->language->get('text_invoice');

		$data['base'] = HTTP_SERVER;
		
		$data['direction'] = $this->language->get('direction');
		
		$data['lang'] = $this->language->get('code');

		$data['orders'] = array();

		$orders = array();

		if (isset($this->request->get['order_id'])) {
			$orders[] = $this->request->get['order_id'];
		}

		foreach ($orders as $order_id) {
			$order_info = $this->model_sale_order->getOrder($this->user->getId(), $order_id);

			$data['text_order'] = sprintf($this->language->get('text_order'), $order_id);
			
			if ($order_info) {
				$format = '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';

				$find = array(
					'{address_1}',
					'{address_2}',
					'{city}',
					'{postcode}',
					'{zone}',
					'{country}'
				);
				
				$replace = array(
					'address_1' => $this->user->get('address_1'),
					'address_2' => $this->user->get('address_2'),
					'city'      => $this->user->get('city'),
					'postcode'  => $this->user->get('postcode'),
					'zone'      => $this->user->get('zone'),
					'country'   => $this->user->get('country'),
				);
				
				$store_address = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));
				
				$store_email = $this->user->get('company_email');
				$store_telephone = $this->user->get('phone');
				$store_vat = $this->user->get('vat');

				if ($order_info['invoice_no']) {
					$invoice_no = $order_info['invoice_prefix'] . $order_info['invoice_no'];
				} else {
					$invoice_no = '';
				}

				$format = '{fullname}' . "\n" . '{company}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';

				$find = array(
					'{fullname}',
					'{company}',
					'{address_1}',
					'{address_2}',
					'{city}',
					'{postcode}',
					'{zone}',
					'{zone_code}',
					'{country}'
				);

				$replace = array(
					'fullname' => $order_info['fullname'],
					'company'   => $order_info['shipping_company'],
					'address_1' => $order_info['shipping_address_1'],
					'address_2' => $order_info['shipping_address_2'],
					'city'      => $order_info['shipping_city'],
					'postcode'  => $order_info['shipping_postcode'],
					'zone'      => $order_info['shipping_zone'],
					//'zone_code' => $order_info['shipping_zone_code'],
					'country'   => $order_info['shipping_country']
				);

				$shipping_address = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));

				$product_data = array();

				$products = $this->model_sale_order->getOrderProducts($this->user->getId(), $order_id);
				
				foreach ($products as $product) {
					$product_data[] = array(
						'name'     => $product['name'],
						'quantity' => $product['quantity'],
						'price'    => $this->currency->format($product['price'] + ($this->config->get('config_tax') ? $product['tax'] : 0), $order_info['currency_code'], 1),
						'total'    => $this->currency->format($product['total'] + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), $order_info['currency_code'], 1)
					);
				}

				$total_data = array();

				$totals = $this->model_sale_order->getOrderTotals($this->user->getId(), $order_id);

				foreach ($totals as $total) {
					$total_data[] = array(
						'title' => $total['title'],
						'text'  => $this->currency->format($total['value'], $order_info['currency_code'], 1)
					);
				}

				$data['orders'][] = array(
					'order_id'	       => $order_id,
					'invoice_no'       => $invoice_no,
					'date_added'       => date($this->language->get('date_format_short'), strtotime($order_info['date_added'])),
					'store_name'       => $order_info['store_name'],
					'store_url'        => rtrim($order_info['store_url'], '/'),
					'store_address'    => nl2br($store_address),
					'store_email'      => $store_email,
					'store_telephone'  => $store_telephone,
					'store_vat'        => $store_vat,
					'email'            => $order_info['email'],
					'telephone'        => $order_info['telephone'],
					'shipping_method'  => $order_info['shipping_method'],
					'shipping_address' => $shipping_address,
					'payment_method'   => $order_info['payment_method'],
					'product'          => $product_data,
					'total'            => $total_data,
					'comment'          => nl2br($order_info['comment'])
				);
			}
		}

		$this->response->setOutput($this->load->view('sale/order_invoice', $data));
	}
	
	public function invoice() {
		$this->load->model('sale/order');
		
		$this->load->language('sale/order');

		$data['title'] = $this->language->get('title_invoice');

		$data['base'] = HTTP_SERVER;
		
		$data['direction'] = $this->language->get('direction');
		
		$data['lang'] = $this->language->get('code');
		
		$this->load->model('tool/image');

		if (is_file(DIR_IMAGE . $this->user->get('logo'))) {
			$data['logo'] = $this->model_tool_image->resize($this->user->get('logo'), 0, 60, 200);
		} else {
			$data['logo'] = $this->model_tool_image->resize('no_image.png', 0, 45, 150);
		}
		
		if (isset($this->request->get['order_id'])) {
			$order_id = $this->request->get['order_id'];
		} else {
			$order_id = 0;
		}
		
		$order_info = $this->model_sale_order->getOrder($this->user->getId(), $order_id);
		
		if (!$order_info) {
			die('324');
		}
		
		$data['order_id'] = $order_id;
		$data['invoice_no'] = $order_info['invoice_prefix'] . $order_info['invoice_no'];
		$data['store_name'] = $order_info['store_name'];
		$data['payment_method'] = $order_info['payment_method'];
		$data['user_email'] = $this->user->get('email');
		$data['user_vat'] = $this->user->get('vat');
		$data['tax'] = $this->user->get('tax');

		$data['date_added'] = date('d-m-Y', strtotime($order_info['date_added']));
		
		$format = '{address_1}, {address_2}, {city} {postcode}, {zone}, {country}';

		$find = array(
			'{address_1}',
			'{address_2}',
			'{city}',
			'{postcode}',
			'{zone}',
			'{country}'
		);
		
		$replace = array(
			'address_1' => $this->user->get('address_1'),
			'address_2' => $this->user->get('address_2'),
			'city'      => $this->user->get('city'),
			'postcode'  => $this->user->get('postcode'),
			'zone'      => $this->user->get('zone'),
			'country'   => $this->user->get('country'),
		);
		
		
		$data['store_address'] = preg_replace("/(\,\ )+/", ', ', trim(str_replace($find, $replace, $format)));
		$data['store_address'] = trim($data['store_address'], ' ,');
		
		$format = '{fullname}' . "\n" . '{company}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';

		$find = array(
			'{fullname}',
			'{company}',
			'{address_1}',
			'{address_2}',
			'{city}',
			'{postcode}',
			'{zone}',
			'{zone_code}',
			'{country}'
		);

		$replace = array(
			'fullname'  => $order_info['fullname'],
			'company'   => $order_info['shipping_company'],
			'address_1' => $order_info['shipping_address_1'],
			'address_2' => $order_info['shipping_address_2'],
			'city'      => $order_info['shipping_city'],
			'postcode'  => $order_info['shipping_postcode'],
			'zone'      => $order_info['shipping_zone'],
			'country'   => $order_info['shipping_country']
		);

		$data['recepient'] = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));
		
		
		$format = '{company}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';

		$find = array(
			'{company}',
			'{address_1}',
			'{address_2}',
			'{city}',
			'{postcode}',
			'{zone}',
			'{zone_code}',
			'{country}'
		);

		$replace = array(
			'company'   => $order_info['shipping_company'],
			'address_1' => $order_info['shipping_address_1'],
			'address_2' => $order_info['shipping_address_2'],
			'city'      => $order_info['shipping_city'],
			'postcode'  => $order_info['shipping_postcode'],
			'zone'      => $order_info['shipping_zone'],
			'country'   => $order_info['shipping_country']
		);


		$products = $this->model_sale_order->getOrderProducts($this->user->getId(), $order_id);
	
		foreach ($products as $product) {
			$data['order_product'][] = array(
				'sku'			=> $product['sku'],
				'name'			=> $product['name'],
				'quantity'		=> $product['quantity'],
				'price'			=> $this->currency->format($product['price'], $order_info['currency_code'], 1),
				'total'			=> $this->currency->format($product['total'], $order_info['currency_code'], 1)
			);
		}
		
		$totals = $this->model_sale_order->getOrderTotals($this->user->getId(), $order_id);
		
		$data['order_totals'] = array();
		
		$data['order_totals'][] = array(
			'title' => $totals['sub_total']['title'],
			'code' => $totals['sub_total']['code'],
			'text' => $this->currency->format($totals['sub_total']['value'], $order_info['currency_code'], 1)
		);
		
		if ($this->user->get('tax') > 0) {
			$data['order_totals'][] = array(
				'title' => $this->language->get('text_total_tax'),
				'code' => 'total_tax',
				'text' => $this->currency->format($totals['sub_total']['value'] / 100 * $this->user->get('tax'), $order_info['currency_code'], 1)
			);
		}
		
		unset($totals['sub_total']);
		
		foreach ($totals as $total) {
			$data['order_totals'][] = array(
				'title'		=> $total['title'],
				'code'		=> $total['code'],
				'text'		=> $this->currency->format($total['value'], $order_info['currency_code'], 1)
			);
		}
		
		$data['total'] = $this->currency->format($totals['total']['value'], $order_info['currency_code'], 1);


		/*
		$data['orders'] = array();

		$orders = array();

		if (isset($this->request->get['order_id'])) {
			$orders[] = $this->request->get['order_id'];
		}

		foreach ($orders as $order_id) {
			$order_info = $this->model_sale_order->getOrder($this->user->getId(), $order_id);

			$data['text_order'] = sprintf($this->language->get('text_order'), $order_id);
			
			if ($order_info) {
				$format = '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';

				$find = array(
					'{address_1}',
					'{address_2}',
					'{city}',
					'{postcode}',
					'{zone}',
					'{country}'
				);
				
				$replace = array(
					'address_1' => $this->user->get('address_1'),
					'address_2' => $this->user->get('address_2'),
					'city'      => $this->user->get('city'),
					'postcode'  => $this->user->get('postcode'),
					'zone'      => $this->user->get('zone'),
					'country'   => $this->user->get('country'),
				);
				
				$store_address = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));
				
				$store_email = $this->user->get('company_email');
				$store_telephone = $this->user->get('phone');
				$store_vat = $this->user->get('vat');

				if ($order_info['invoice_no']) {
					$invoice_no = $order_info['invoice_prefix'] . $order_info['invoice_no'];
				} else {
					$invoice_no = '';
				}

				$format = '{fullname}' . "\n" . '{company}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';

				$find = array(
					'{fullname}',
					'{company}',
					'{address_1}',
					'{address_2}',
					'{city}',
					'{postcode}',
					'{zone}',
					'{zone_code}',
					'{country}'
				);

				$replace = array(
					'fullname' => $order_info['fullname'],
					'company'   => $order_info['shipping_company'],
					'address_1' => $order_info['shipping_address_1'],
					'address_2' => $order_info['shipping_address_2'],
					'city'      => $order_info['shipping_city'],
					'postcode'  => $order_info['shipping_postcode'],
					'zone'      => $order_info['shipping_zone'],
					//'zone_code' => $order_info['shipping_zone_code'],
					'country'   => $order_info['shipping_country']
				);

				$shipping_address = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));

				$product_data = array();

				$products = $this->model_sale_order->getOrderProducts($this->user->getId(), $order_id);
				
				foreach ($products as $product) {
					$product_data[] = array(
						'name'     => $product['name'],
						'quantity' => $product['quantity'],
						'price'    => $this->currency->format($product['price'] + ($this->config->get('config_tax') ? $product['tax'] : 0), $order_info['currency_code'], 1),
						'total'    => $this->currency->format($product['total'] + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), $order_info['currency_code'], 1)
					);
				}

				$total_data = array();

				$totals = $this->model_sale_order->getOrderTotals($this->user->getId(), $order_id);

				foreach ($totals as $total) {
					$total_data[] = array(
						'title' => $total['title'],
						'text'  => $this->currency->format($total['value'], $order_info['currency_code'], 1)
					);
				}

				$data['orders'][] = array(
					'order_id'	       => $order_id,
					'invoice_no'       => $invoice_no,
					'date_added'       => date($this->language->get('date_format_short'), strtotime($order_info['date_added'])),
					'store_name'       => $order_info['store_name'],
					'store_url'        => rtrim($order_info['store_url'], '/'),
					'store_address'    => nl2br($store_address),
					'store_email'      => $store_email,
					'store_telephone'  => $store_telephone,
					'store_vat'        => $store_vat,
					'email'            => $order_info['email'],
					'telephone'        => $order_info['telephone'],
					'shipping_method'  => $order_info['shipping_method'],
					'shipping_address' => $shipping_address,
					'payment_method'   => $order_info['payment_method'],
					'product'          => $product_data,
					'total'            => $total_data,
					'comment'          => nl2br($order_info['comment'])
				);
			}
		}
		*/

		$this->response->setOutput($this->load->view('sale/order_invoice2', $data));
	}	
	
	public function edit() {
		$this->load->model('sale/order');
		$this->load->model('integration/delivery/delivery');
		$this->load->model('localisation/order_status');
		$this->load->model('localisation/currency');
		$this->load->model('localisation/country');
		$this->load->model('localisation/zone');
		$this->load->model('catalog/product');
		$this->load->model('tool/image');
		
		$this->load->language('sale/order');

		$this->document->setTitle($this->language->get('heading_title'));
		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		$url = '';
		
		$url .= '&user_token=' . $this->session->data['user_token'];
		
		if (isset($this->request->get['filter_order_status_id'])) {
			$url .= '&filter_order_status_id=' . $this->request->get['filter_order_status_id'];
		}

		if (isset($this->request->get['filter_onlineshop'])) {
			$url .= '&filter_onlineshop=' . $this->request->get['filter_onlineshop'];
		}
		
		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}

		if (isset($this->request->get['filter_date_modified'])) {
			$url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
		}
		
		$data['cancel'] = $this->url->link('sale/order', $url, true);

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		if (isset($this->request->get['order_id'])) {
			$url .= '&order_id=' . $this->request->get['order_id'];
		}

		if (isset($this->request->get['order_id'])) {
			$order_info = $this->model_sale_order->getOrder($this->user->getId(), $this->request->get['order_id']);
		}

		if (!empty($order_info)) {
			$order_id = (int) $this->request->get['order_id'];
			$data['order_id'] = $order_id;
			
			$order_totals = $this->model_sale_order->getOrderTotals($this->user->getId(), (int) $this->request->get['order_id']);
			
			$order_products = $this->model_sale_order->getOrderProducts($this->user->getId(), (int) $this->request->get['order_id']);
			
			foreach ($order_products as $order_product) {
				$product = $this->model_catalog_product->getProduct($this->user->getId(), $order_product['sku']);
				
				if (!$product) {
					$image_min = $this->model_tool_image->resize('no_image.png', 50, 50);
				} else {
					if (is_file(DIR_IMAGE . $product['image'])) {
						$image_min = $this->model_tool_image->resize($product['image'], 50, 50);
					} else {
						$image_min = $this->model_tool_image->resize('no_image.png', 50, 50);
					}
				}

				$name = oc_substr($order_product['name'], 0, 128);
				
				if (mb_strlen($order_product['name']) > 128) {
					$name .= '...';
				}
				
				$name_min = oc_substr($order_product['name'], 0, 64);
				
				if (mb_strlen($order_product['name']) > 64) {
					$name_min .= '...';
				}
				
				$data['order_product'][] = array(
					'order_product_id'	=> $order_product['order_product_id'],
					'sku' 				=> $order_product['sku'],
					'name'				=> $name,
					'name_min'			=> $name_min,
					'image_min'			=> $image_min,
					'price'				=> $order_product['price'],
					'price_formated'	=> $this->currency->format($order_product['price'], $order_info['currency_code'], 1),
					'weight'			=> $order_product['weight'],
					'quantity'			=> $order_product['quantity'],
				);
			}			
			
			$data['email'] = $order_info['email'];
			$data['telephone'] = $order_info['telephone'];
			
			$data['total'] = $this->currency->format($order_info['total'], $order_info['currency_code'], 1);
			
			$data['order_status_id'] = $order_info['order_status_id'];
			
			$data['date_added'] = $order_info['date_added'];
			$data['date_modified'] = $order_info['date_modified'];
			
			if ($order_info['invoice_no']) {
				$data['invoice_no'] = $order_info['invoice_prefix'] . $order_info['invoice_no'];
				$data['invoice'] = $this->url->link('sale/order.invoice', '&user_token=' . $this->session->data['user_token'] . '&order_id=' . $order_id, true);
			} else {
				$data['invoice_no'] = '';
				$data['invoice'] = '';
			}

			$data['fullname'] = $order_info['fullname'];
			$data['shipping_company'] = $order_info['shipping_company'];
			$data['shipping_address_1'] = $order_info['shipping_address_1'];
			$data['shipping_address_2'] = $order_info['shipping_address_2'];
			$data['shipping_city'] = $order_info['shipping_city'];
			$data['shipping_postcode'] = $order_info['shipping_postcode'];
			$data['shipping_country_id'] = $order_info['shipping_country_id'];
			$data['shipping_country'] = $order_info['shipping_country'];
			$data['shipping_zone_id'] = $order_info['shipping_zone_id'];
			$data['shipping_zone'] = $order_info['shipping_zone'];
			
			$data['shipping_method'] = $order_info['shipping_method'];
			
			$data['shipping_code'] = $order_info['shipping_code'];
			$data['tracking'] = $order_info['tracking'];
			
			if ($order_info['tracking']) {
				$data['print_waybill'] = $this->url->link('integration/delivery/' . $order_info['shipping_code'] . '.print', 'user_token=' . $this->session->data['user_token'] . '&tracking=' . $order_info['tracking'], true);
			} else {
				$data['print_waybill'] = '';
			}
			
			if (isset($order_totals['shipping'])) {
				$data['shipping_cost'] = $order_totals['shipping']['value'];
			} else {
				$data['shipping_cost'] = '0.00';
			}

			$data['payment_fullname'] = $order_info['payment_fullname'];
			$data['payment_company'] = $order_info['payment_company'];
			$data['payment_address_1'] = $order_info['payment_address_1'];
			$data['payment_address_2'] = $order_info['payment_address_2'];
			$data['payment_city'] = $order_info['payment_city'];
			$data['payment_postcode'] = $order_info['payment_postcode'];
			$data['payment_country_id'] = $order_info['payment_country_id'];
			$data['payment_country'] = $order_info['payment_country'];
			$data['payment_zone_id'] = $order_info['payment_zone_id'];
			$data['payment_zone'] = $order_info['payment_zone'];
			
			$data['payment_method'] = $order_info['payment_method'];
			
			$data['payment_code'] = $order_info['payment_code'];
			
			$data['fiscal_code'] = $order_info['fiscal_code'];

			$data['comment'] = $order_info['comment'];
			
			$data['currency'] = $order_info['currency_code'];
		} else {
			$this->load->model('catalog/cart');
			
			$post['store_name'] = $this->user->get('company');
			$post['store_url'] = $this->user->get('website');
			
			$post['currency_id'] = $this->currency->getId($this->user->get('currency'));
			$post['currency_code'] = $this->user->get('currency');
			$post['currency_value'] = $this->currency->getValue($this->user->get('currency'));
			
			$post['order_totals']['sub_total'] = array(
				'code' => 'sub_total',
				'title' => $this->language->get('text_sub_total'),
				'value' => 0,
				'sort_order' => '1',
			);
			
			$post['order_totals']['shipping'] = array(
				'code' => 'shipping',
				'title' => $this->language->get('text_shipping'),
				'value' => 0,
				'sort_order' => '2',
			);
			
			$post['order_totals']['total'] = array(
				'code' => 'total',
				'title' => $this->language->get('text_total'),
				'value' => 0,
				'sort_order' => '9',
			);
			
			$order_id = $this->model_sale_order->newOrder($this->user->getId(), $post);
			$data['order_id'] = $order_id;
			
			$order_info = $this->model_sale_order->getOrder($this->user->getId(), $order_id);
			
			// Add products from cart
			$cart_products = $this->model_catalog_cart->getProducts();
			
			foreach($cart_products as $cart_product) {
				$product = $this->model_catalog_product->getProduct($this->user->getId(), $cart_product['sku']);
				
				if (!$product) {
					continue;
				}
				
				$order_product_price = $this->currency->convert((float) $product['price'], 1, $this->user->get('currency'));
				
				$order_product_data = array(
					'product_id'		=> $product['product_id'],
					'sku'				=> $product['sku'],
					'name'				=> oc_substr($product['name'], 0, 255),
					'quantity' 			=> $cart_product['quantity'],
					'weight'			=> $product['weight'],
					'price'				=> $order_product_price,
					'total'				=> $order_product_price * $cart_product['quantity'],
				);
				
				$order_product_id = $this->model_sale_order->addOrderProduct($this->user->getId(), $order_id, $order_product_data);
				
				if (!$order_product_id) {
					continue;
				}

				if (is_file(DIR_IMAGE . $product['image'])) {
					$image_min = $this->model_tool_image->resize($product['image'], 50, 50);
				} else {
					$image_min = $this->model_tool_image->resize('no_image.png', 50, 50);
				}
				
				$name = oc_substr($product['name'], 0, 128);
				
				if (mb_strlen($product['name']) > 128) {
					$name .= '...';
				}
				
				$name_min = oc_substr($product['name'], 0, 64);
				
				if (mb_strlen($product['name']) > 64) {
					$name_min .= '...';
				}

				$data['order_product'][] = array(
					'order_product_id'	=> $order_product_id,
					'sku'				=> $product['sku'],
					'name'				=> $name,
					'name_min'			=> $name_min,
					'image_min'			=> $image_min,
					'price'				=> $order_product_price,
					'price_formated'	=> $this->currency->format($order_product_price, $this->user->get('currency'), 1),
					'weight'			=> $product['weight'],
					'quantity'			=> $cart_product['quantity'],
				);
			}
			
			$this->model_catalog_cart->clear();
			
			if (isset($data['order_product'])) {
				$this->model_sale_order->addOrderHistory($this->user->getId(), $order_id, $this->config->get('config_processing_status')[0]);
				
				$order_info['total'] = $this->model_sale_order->getOrderTotal($this->user->getId(), $order_id);
			}
			
			$data['email'] = $order_info['email'];
			$data['telephone'] = $order_info['telephone'];
			
			$data['total'] = $this->currency->format($order_info['total'], $this->user->get('currency'), 1);
			
			$data['order_status_id'] = $order_info['order_status_id'];
			
			$data['date_added'] = $order_info['date_added'];
			$data['date_modified'] = $order_info['date_modified'];
			
			$data['invoice_no'] = '';
			$data['invoice'] = '';

			$data['fullname'] = '';
			$data['shipping_company'] = '';
			$data['shipping_address_1'] = '';
			$data['shipping_address_2'] = '';
			$data['shipping_city'] = '';
			$data['shipping_postcode'] = '';
			$data['shipping_country_id'] = '';
			$data['shipping_country'] = '';
			$data['shipping_zone_id'] = '';
			$data['shipping_zone'] = '';
			
			$data['shipping_method'] = '';
			$data['shipping_code'] = '';
			$data['tracking'] = '';
			$data['print_waybill'] = '';
			
			$data['shipping_cost'] = '0.00';
			
			$data['payment_fullname'] = '';
			$data['payment_company'] = '';
			$data['payment_address_1'] = '';
			$data['payment_address_2'] = '';
			$data['payment_city'] = '';
			$data['payment_postcode'] = '';
			$data['payment_country_id'] = '';
			$data['payment_country'] = '';
			$data['payment_zone_id'] = '';
			$data['payment_zone'] = '';
			
			$data['payment_method'] = '';
			$data['payment_code'] = '';
			
			$data['fiscal_code'] = '';

			$data['comment'] = '';
			
			$data['currency'] = $this->user->get('currency');
		}

		$data['countries'] = $this->model_localisation_country->getCountries();

		$data['shipping_zones'] = $this->model_localisation_zone->getZonesByCountryId((int) $data['shipping_country_id']);
		$data['payment_zones'] = $this->model_localisation_zone->getZonesByCountryId((int) $data['payment_country_id']);

		$data['currencies'] = $this->model_localisation_currency->getCurrencies();
		
		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
		
		$data['currency_symbol_left'] = $this->currency->getSymbolLeft($data['currency']);
		$data['currency_symbol_right'] = $this->currency->getSymbolRight($data['currency']);
		
		$data['user_token'] = $this->session->data['user_token'];
		
		$delivery_integrations = $this->model_integration_delivery_delivery->getActiveDeliveryMethods($this->user->getId());
		
		if (!isset($this->request->get['order_id'])) {
			$url .= '&order_id=' . $order_id;
		}
		
		foreach ($delivery_integrations as $delivery_integration) {
			$delivery_integration['url'] = $this->url->link('integration/delivery/' . $delivery_integration['code'] . '.waybill', $url, true);
			
			$data['delivery_integrations'][] = $delivery_integration;
		}

		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['navigation'] = $this->load->controller('common/navigation');

		$this->response->setOutput($this->load->view('sale/order_form', $data));
	}
	
	public function editOrderInfo() {
		$json = array();
		
		$this->load->language('sale/order');
		
		if (isset($this->request->get['order_id']) and $this->validateOrderInfo()) {
			$this->load->model('sale/order');
			
			$this->model_sale_order->editOrderInfo($this->user->getId(), $this->request->get['order_id'], $this->request->post);
			
			$json['date_modified'] = date("Y-m-d H:i:s");
			$json['total'] = $this->model_sale_order->getOrderTotal($this->user->getId(), $this->request->get['order_id'], true);
			
			$order_status_id = $this->model_sale_order->getOrderStatus($this->user->getId(), $this->request->get['order_id']);
			
			if ($order_status_id == 0) {
				$this->model_sale_order->addOrderHistory($this->user->getId(), $this->request->get['order_id'], $this->config->get('config_processing_status')[0]);
			}
		} else {
			$json['error'] = $this->error['warning'];
		}

		//echo '<pre>'; print_r($this->request->post); echo '</pre><br><br>'; die();
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function deleteOrderProduct() {
		$json = array();
		
		$this->load->language('sale/order');
		
		if (isset($this->request->get['order_product_id']) and isset($this->request->get['order_id'])) {
			$this->load->model('sale/order');
			
			$this->model_sale_order->deleteOrderProduct($this->user->getId(), $this->request->get['order_id'], $this->request->get['order_product_id']);
			
			$json['date_modified'] = date("Y-m-d H:i:s");
			
			$json['total'] = $this->model_sale_order->getOrderTotal($this->user->getId(), $this->request->get['order_id'], true);
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function editOrderProduct() {
		$json = array(
			'success' => 0
		);
		
		$this->load->language('sale/order');
		
		if (isset($this->request->get['order_product_id']) and isset($this->request->get['order_id']) and $this->validateOrderProduct()) {
			$this->load->model('sale/order');
			
			$this->request->post['name'] = oc_substr($this->request->post['name'], 0, 255);
			$this->request->post['total'] = (float) $this->request->post['price'] * (int) $this->request->post['quantity'];
			
			$this->model_sale_order->editOrderProduct($this->user->getId(), $this->request->get['order_id'], $this->request->get['order_product_id'], $this->request->post);
			
			$json['success'] = 1;
			
			$order_currency = $this->model_sale_order->getOrderCurrency($this->user->getId(), $this->request->get['order_id']);
			
			$json['name'] = $this->request->post['name'];
			$json['price_formated'] = $this->currency->format((float) $this->request->post['price'], $order_currency, 1);
			$json['quantity'] = $this->request->post['quantity'];
			$json['weight'] = $this->request->post['weight'];
			$json['price'] = $this->request->post['price'];
			
			$json['date_modified'] = date("Y-m-d H:i:s");
			$json['total'] = $this->model_sale_order->getOrderTotal($this->user->getId(), $this->request->get['order_id'], true);
		} else {
			$json['error'] = $this->error['warning'];
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function addOrderProduct() {
		$json = array(
			'success' => 0
		);
		
		$this->load->language('sale/order');
		
		if (isset($this->request->get['order_id']) and $this->validateOrderProduct()) {
			$this->load->model('sale/order');
			$this->load->model('tool/image');
			
			$this->request->post['name'] = oc_substr($this->request->post['name'], 0, 255);
			$this->request->post['total'] = (float) $this->request->post['price'] * (int) $this->request->post['quantity'];
			
			if (!empty($this->request->post['sku'])) {
				$this->load->model('catalog/product');
				
				$product = $this->model_catalog_product->getProduct($this->user->getId(), $this->request->post['sku']);
				
				if ($product) {
					$this->request->post['product_id'] = $product['product_id'];
					
					if (is_file(DIR_IMAGE . $product['image'])) {
						$json['image'] = $this->model_tool_image->resize($product['image'], 50, 50);
					} else {
						$json['image'] = $this->model_tool_image->resize('no_image.png', 50, 50);
					}
				} else {
					$this->request->post['sku'] = '';
					$this->request->post['product_id'] = '';
					$json['image'] = $this->model_tool_image->resize('no_image.png', 50, 50);
				}
			} else {
				$this->request->post['sku'] = '';
				$this->request->post['product_id'] = '';
				$json['image'] = $this->model_tool_image->resize('no_image.png', 50, 50);
			}

			$order_product_id = $this->model_sale_order->addOrderProduct($this->user->getId(), $this->request->get['order_id'], $this->request->post);
			
			$json['success'] = 1;
			
			$order_product = $this->model_sale_order->getOrderProduct($this->user->getId(), $this->request->get['order_id'], $order_product_id);
			
			$order_currency = $this->model_sale_order->getOrderCurrency($this->user->getId(), $this->request->get['order_id']);

			$json['name'] = oc_substr($order_product['name'], 0, 128);
			$json['price_formated'] = $this->currency->format($order_product['price'], $order_currency, 1);
			$json['price'] = $order_product['price'];
			$json['quantity'] = $order_product['quantity'];
			$json['weight'] = $order_product['weight'];
			
			if (!empty($this->request->post['sku'])) {
				$json['sku'] = $this->request->post['sku'];
			} else {
				$json['sku'] = '';
			}
			
			$json['order_product_id'] = $order_product_id;
			
			$json['date_modified'] = date("Y-m-d H:i:s");
			$json['total'] = $this->model_sale_order->getOrderTotal($this->user->getId(), $this->request->get['order_id'], true);
			
			$order_status_id = $this->model_sale_order->getOrderStatus($this->user->getId(), $this->request->get['order_id']);
			
			if ($order_status_id == 0) {
				$this->model_sale_order->addOrderHistory($this->user->getId(), $this->request->get['order_id'], $this->config->get('config_processing_status')[0]);
			}
		} else {
			$json['error'] = $this->error['warning'];
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	private function validateOrderProduct() {
		if (!isset($this->request->post['name']) or oc_strlen($this->request->post['name']) > 255) {
			$this->error['warning'] = $this->language->get('error_order_product_name');
		}

		if (!isset($this->request->post['price']) or oc_strlen($this->request->post['price']) > 10) {
			$this->error['warning'] = $this->language->get('error_order_product_price');
		}
		
		if (!isset($this->request->post['quantity']) or oc_strlen($this->request->post['quantity']) > 4) {
			$this->error['warning'] = $this->language->get('error_order_product_quantity');
		}
		
		if (!isset($this->request->post['weight']) or oc_strlen($this->request->post['weight']) > 15) {
			$this->error['warning'] = $this->language->get('error_order_product_weight');
		}

		return !$this->error;
	}
	
	private function validateOrderInfo() {
		// order_status_id
		
		if (isset($this->request->post['email']) and ((oc_strlen($this->request->post['email']) > 96) or !filter_var($this->request->post['email'], FILTER_VALIDATE_EMAIL))) {
			$this->error['warning'] = $this->language->get('error_email');
		}
		
		if (isset($this->request->post['telephone']) and (oc_strlen(trim($this->request->post['telephone'])) > 32)) {
			$this->error['warning'] = $this->language->get('error_telephone');
		}
		
		if (isset($this->request->post['fullname']) and (oc_strlen(trim($this->request->post['fullname'])) > 64)) {
			$this->error['warning'] = $this->language->get('error_fullname');
		}
		
		if (isset($this->request->post['shipping_company']) and (oc_strlen(trim($this->request->post['shipping_company'])) > 40)) {
			$this->error['warning'] = $this->language->get('error_company');
		}
		
		if (isset($this->request->post['shipping_address_1']) and (oc_strlen(trim($this->request->post['shipping_address_1'])) > 128)) {
			$this->error['warning'] = $this->language->get('error_address_1');
		}
		
		if (isset($this->request->post['shipping_address_2']) and (oc_strlen(trim($this->request->post['shipping_address_2'])) > 128)) {
			$this->error['warning'] = $this->language->get('error_address_2');
		}
		
		if (isset($this->request->post['shipping_city']) and (oc_strlen(trim($this->request->post['shipping_city'])) > 128)) {
			$this->error['warning'] = $this->language->get('error_city');
		}
		
		if (isset($this->request->post['shipping_postcode']) and (oc_strlen(trim($this->request->post['shipping_postcode'])) > 10)) {
			$this->error['warning'] = $this->language->get('error_postcode');
		}
		
		if (isset($this->request->post['shipping_country_id']) and (int) $this->request->post['shipping_country_id'] != 0) {
			$this->load->model('localisation/country');
			
			$country = $this->model_localisation_country->getCountry($this->request->post['shipping_country_id']);
			
			if (!$country) {
				$this->error['warning'] = $this->language->get('error_country');
			}
		}
		
		if (isset($this->request->post['shipping_country']) and (oc_strlen(trim($this->request->post['shipping_country'])) > 128)) {
			$this->error['warning'] = $this->language->get('error_country');
		}
		
		if (isset($this->request->post['shipping_zone_id']) and (int) $this->request->post['shipping_zone_id'] != 0) {
			$this->load->model('localisation/zone');
			
			$zone = $this->model_localisation_zone->getZone($this->request->post['shipping_zone_id']);
			
			if (!$zone) {
				$this->error['warning'] = $this->language->get('error_zone');
			}
		}
		
		if (isset($this->request->post['shipping_zone']) and (oc_strlen(trim($this->request->post['shipping_zone'])) > 128)) {
			$this->error['warning'] = $this->language->get('error_zone');
		}
		
		if (isset($this->request->post['shipping_method']) and (oc_strlen(trim($this->request->post['shipping_method'])) > 128)) {
			$this->error['warning'] = $this->language->get('error_shipping_method');
		}
		
		if (isset($this->request->post['payment_fullname']) and (oc_strlen(trim($this->request->post['payment_fullname'])) > 64)) {
			$this->error['warning'] = $this->language->get('error_fullname');
		}
		
		if (isset($this->request->post['payment_company']) and (oc_strlen(trim($this->request->post['payment_company'])) > 40)) {
			$this->error['warning'] = $this->language->get('error_company');
		}
		
		if (isset($this->request->post['payment_address_1']) and (oc_strlen(trim($this->request->post['payment_address_1'])) > 128)) {
			$this->error['warning'] = $this->language->get('error_address_1');
		}
		
		if (isset($this->request->post['payment_address_2']) and (oc_strlen(trim($this->request->post['payment_address_2'])) > 128)) {
			$this->error['warning'] = $this->language->get('error_address_2');
		}
		
		if (isset($this->request->post['payment_city']) and (oc_strlen(trim($this->request->post['payment_city'])) > 128)) {
			$this->error['warning'] = $this->language->get('error_city');
		}
		
		if (isset($this->request->post['payment_postcode']) and (oc_strlen(trim($this->request->post['payment_postcode'])) > 10)) {
			$this->error['warning'] = $this->language->get('error_postcode');
		}
		
		if (isset($this->request->post['payment_country_id']) and (int) $this->request->post['payment_country_id'] != 0) {
			$this->load->model('localisation/country');
			
			$country = $this->model_localisation_country->getCountry($this->request->post['payment_country_id']);
			
			if (!$country) {
				$this->error['warning'] = $this->language->get('error_country');
			}
		}
		
		if (isset($this->request->post['payment_country']) and (oc_strlen(trim($this->request->post['payment_country'])) > 128)) {
			$this->error['warning'] = $this->language->get('error_country');
		}
		
		if (isset($this->request->post['payment_zone_id']) and (int) $this->request->post['payment_zone_id'] != 0) {
			$this->load->model('localisation/zone');
			
			$zone = $this->model_localisation_zone->getZone($this->request->post['payment_zone_id']);
			
			if (!$zone) {
				$this->error['warning'] = $this->language->get('error_zone');
			}
		}
		
		if (isset($this->request->post['payment_zone']) and (oc_strlen(trim($this->request->post['payment_zone'])) > 128)) {
			$this->error['warning'] = $this->language->get('error_zone');
		}
		
		if (isset($this->request->post['payment_method']) and (oc_strlen(trim($this->request->post['payment_method'])) > 128)) {
			$this->error['warning'] = $this->language->get('error_payment_method');
		}
		
		if (isset($this->request->post['comment']) and (oc_strlen(trim($this->request->post['comment'])) > 256)) {
			$this->error['warning'] = $this->language->get('error_comment');
		}
		
		if (isset($this->request->post['shipping_cost']) and oc_strlen($this->request->post['shipping_cost']) > 10) {
			$this->error['warning'] = $this->language->get('error_shipping_cost');
		}
		
		if (isset($this->request->post['fiscal_code']) and oc_strlen($this->request->post['fiscal_code']) > 32) {
			$this->error['warning'] = $this->language->get('error_fiscal_code');
		}
		
		return !$this->error;
	}
	
	/*
	public function history() {
		$limit = 10;
		
		$this->load->language('sale/order');

		if (isset($this->request->get['page'])) {
			$page = (int)$this->request->get['page'];
		} else {
			$page = 1;
		}
		
		if (isset($this->request->get['order_id'])) {
			$order_id = (int)$this->request->get['order_id'];
		} else {
			$order_id = 0;
		}

		$data['histories'] = array();

		$this->load->model('sale/order');

		$results = $this->model_sale_order->getOrderHistories($this->user->getId(), $order_id, ($page - 1) * 10, 10);

		foreach($results as $result) {
			$data['histories'][] = array(
				'status'     => $result['status'],
				'comment'    => nl2br($result['comment']),
				'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added']))
			);
		}

		$history_total = $this->model_sale_order->getTotalOrderHistories($order_id);

		$data['pagination'] = $this->load->controller('common/pagination', [
			'total' => $history_total,
			'page'  => $page,
			'limit' => $limit,
			'url'   => $this->url->link('sale/order.history', 'user_token=' . $this->session->data['user_token'] .'&order_id=' . $order_id . '&page={page}')
		]);
		

		$data['results'] = sprintf($this->language->get('text_pagination'), ($history_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($history_total - $limit)) ? $history_total : ((($page - 1) * $limit) + $limit), $history_total, ceil($history_total / $limit));

		$this->response->setOutput($this->load->view('sale/order_history', $data));
	}
	*/
	
	/*
	public function addHistory() {
		$this->load->language('sale/order');

		$json = array();

		// Add keys for missing post vars
		$keys = array(
			'order_status_id',
			'comment'
		);

		foreach ($keys as $key) {
			if (!isset($this->request->post[$key])) {
				$this->request->post[$key] = '';
			}
		}

		$this->load->model('sale/order');

		if (isset($this->request->get['order_id'])) {
			$order_id = $this->request->get['order_id'];
		} else {
			$order_id = 0;
		}

		$order_info = $this->model_sale_order->getOrder($this->user->getId(), $order_id);

		if ($order_info) {
			$this->model_sale_order->addOrderHistory($this->user->getId(), $order_id, $this->request->post['order_status_id'], $this->request->post['comment']);

			$json['success'] = $this->language->get('text_success');
		} else {
			$json['error'] = $this->language->get('error_not_found');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	*/
}
