<?php
namespace Opencart\Catalog\Model\Sale;
class Order extends \Opencart\System\Engine\Model {
	public function addOrder($user_id, $data) {
		if(isset($data['order_status'])) {
			$order_status = $data['order_status'];
		} else {
			$order_status = $this->config->get('config_processing_status')[0];
		}
		
		if(!isset($data['onlineshop_order_id'])) {
			$data['onlineshop_order_id'] = '';
		}
		
		if(!isset($data['invoice_prefix'])) {
			$data['invoice_prefix'] = $this->config->get('config_invoice_prefix');
		}
		
		if(!isset($data['shipping_method'])) {
			$data['shipping_method'] = '';
		}
		
		if(!isset($data['shipping_code'])) {
			$data['shipping_code'] = '';
		}
		
		if(!isset($data['payment_method'])) {
			$data['payment_method'] = '';
		}
		
		if(!isset($data['payment_code'])) {
			$data['payment_code'] = '';
		}
		
		if(!isset($data['onlineshop_code'])) {
			$data['onlineshop_code'] = '';
		}
		
		if(!isset($data['date_added'])) {
			$data['date_added'] = date("Y-m-d H:i:s");
		}
		
		if(!isset($data['date_modified'])) {
			$data['date_modified'] = date("Y-m-d H:i:s");
		}
		
		$this->db->query("INSERT INTO " . DB_PREFIX . "order SET order_status_id = '0', user_id = '" . (int) $user_id . "', onlineshop_code = '" . $this->db->escape($data['onlineshop_code']) . "', onlineshop_order_id = '" . $this->db->escape($data['onlineshop_order_id']) . "', invoice_prefix = '" . $this->db->escape($data['invoice_prefix']) . "', store_name = '" . $this->db->escape($data['store_name']) . "', store_url = '" . $this->db->escape($data['store_url']) . "', fullname = '" . $this->db->escape($data['fullname']) . "', email = '" . $this->db->escape($data['email']) . "', telephone = '" . $this->db->escape($data['telephone']) . "', shipping_company = '" . $this->db->escape($data['shipping_company']) . "', shipping_address_1 = '" . $this->db->escape($data['shipping_address_1']) . "', shipping_address_2 = '" . $this->db->escape($data['shipping_address_2']) . "', shipping_city = '" . $this->db->escape($data['shipping_city']) . "', shipping_postcode = '" . $this->db->escape($data['shipping_postcode']) . "', shipping_country = '" . $this->db->escape($data['shipping_country']) . "', shipping_country_id = '" . (int) $data['shipping_country_id'] . "', shipping_zone = '" . $this->db->escape($data['shipping_zone']) . "', shipping_zone_id = '" . (int) $data['shipping_zone_id'] . "', shipping_method = '" . $this->db->escape($data['shipping_method']) . "', shipping_code = '" . $this->db->escape($data['shipping_code']) . "', payment_method = '" . $this->db->escape($data['payment_method']) . "', payment_code = '" . $this->db->escape($data['payment_code']) . "', comment = '" . $this->db->escape($data['comment']) . "', total = '" . (float) $data['total'] . "', currency_id = '" . (int) $data['currency_id'] . "', currency_code = '" . $this->db->escape($data['currency_code']) . "', currency_value = '" . (float) $data['currency_value'] . "', date_added = '" . $this->db->escape($data['date_added']) . "', date_modified = '" . $this->db->escape($data['date_modified']) . "'");

		$order_id = $this->db->getLastId();

		// Products
		foreach($data['order_product'] as $product) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "order_product SET order_id = '" . (int) $order_id . "', product_id = '" . (int) $product['product_id'] . "', sku = '" . $this->db->escape($product['sku']) . "', name = '" . $this->db->escape($product['name']) . "', quantity = '" . (int) $product['quantity'] . "', price = '" . (float)$product['price'] . "', total = '" . (float) $product['total'] . "', weight = '" . (float) $product['weight'] . "'");
		}

		// Totals
		foreach($data['order_totals'] as $total) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "order_total SET order_id = '" . (int)$order_id . "', code = '" . $this->db->escape($total['code']) . "', title = '" . $this->db->escape($total['title']) . "', `value` = '" . (float)$total['value'] . "', sort_order = '" . (int)$total['sort_order'] . "'");
		}
		
		$this->addOrderHistory($user_id, $order_id, $order_status, '', false, $data['date_modified']);

		return $order_id;
	}
	
	public function editTracking($user_id, $order_id, $shipping_code, $tracking) {
		if(!$this->issetOrder($user_id, $order_id)) {
			return false;
		}
		
		$this->db->query("UPDATE " . DB_PREFIX . "order SET shipping_code = '" . $this->db->escape($shipping_code) . "', tracking = '" . $this->db->escape($tracking) . "' WHERE order_id = '" . (int) $order_id . "'");
	}

	public function deleteOrder($user_id, $order_id) {
		if(!$this->issetOrder($user_id, $order_id)) {
			return false;
		}
		
		// Void the order first
		$this->addOrderHistory($user_id, $order_id, 0);

		$this->db->query("DELETE FROM `" . DB_PREFIX . "order` WHERE order_id = '" . (int)$order_id . "'");
		$this->db->query("DELETE FROM `" . DB_PREFIX . "order_product` WHERE order_id = '" . (int)$order_id . "'");
		$this->db->query("DELETE FROM `" . DB_PREFIX . "order_total` WHERE order_id = '" . (int)$order_id . "'");
		$this->db->query("DELETE FROM `" . DB_PREFIX . "order_history` WHERE order_id = '" . (int)$order_id . "'");
	}
	
	public function getOrders($user_id, $data = array()) {
		$sql = "SELECT o.order_id, o.invoice_no, o.onlineshop_code, o.onlineshop_order_id, o.fullname AS customer, (SELECT os.name FROM " . DB_PREFIX . "order_status os WHERE os.order_status_id = o.order_status_id AND os.language_id = '" . (int)$this->config->get('config_language_id') . "') AS order_status, o.shipping_code, o.order_status_id, o.total, o.currency_code, o.currency_value, o.date_added, o.date_modified FROM `" . DB_PREFIX . "order` o";
		
		$sql .= " WHERE o.user_id = '" . (int) $user_id . "'";
		
		if (!empty($data['filter_order_status'])) {
			$implode = array();

			$order_statuses = explode(',', $data['filter_order_status']);

			foreach ($order_statuses as $order_status_id) {
				$implode[] = "o.order_status_id = '" . (int)$order_status_id . "'";
			}

			if ($implode) {
				$sql .= " AND (" . implode(" OR ", $implode) . ")";
			}
		} elseif (isset($data['filter_order_status_id']) && $data['filter_order_status_id'] !== '') {
			$sql .= " AND o.order_status_id = '" . (int)$data['filter_order_status_id'] . "'";
		} else {
			$sql .= " AND o.order_status_id > '0'";
		}

		if (!empty($data['filter_date_added'])) {
			$sql .= " AND DATE(o.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}

		if (!empty($data['filter_date_modified'])) {
			$sql .= " AND DATE(o.date_modified) = DATE('" . $this->db->escape($data['filter_date_modified']) . "')";
		}
		
		if (!empty($data['filter_onlineshop'])) {
			$sql .= " AND o.onlineshop_code = '" . $this->db->escape($data['filter_onlineshop']) . "'";
		}
		
		$sql .= " ORDER BY o.order_id DESC";

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}
	
	public function getTotalOrders($user_id, $data = array()) {
		$sql = "SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "order`";
		
		$sql .= " WHERE user_id = '" . (int) $user_id . "'";

		if (!empty($data['filter_order_status'])) {
			$implode = array();

			$order_statuses = explode(',', $data['filter_order_status']);

			foreach ($order_statuses as $order_status_id) {
				$implode[] = "order_status_id = '" . (int)$order_status_id . "'";
			}

			if ($implode) {
				$sql .= " AND (" . implode(" OR ", $implode) . ")";
			}
		} elseif (isset($data['filter_order_status_id']) && $data['filter_order_status_id'] !== '') {
			$sql .= " AND order_status_id = '" . (int)$data['filter_order_status_id'] . "'";
		} else {
			$sql .= " AND order_status_id > '0'";
		}

		if (!empty($data['filter_date_added'])) {
			$sql .= " AND DATE(date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}

		if (!empty($data['filter_date_modified'])) {
			$sql .= " AND DATE(date_modified) = DATE('" . $this->db->escape($data['filter_date_modified']) . "')";
		}
		
		if (!empty($data['filter_onlineshop'])) {
			$sql .= " AND onlineshop_code = '" . $this->db->escape($data['filter_onlineshop']) . "'";
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}
	
	public function getOrder($user_id, $order_id) {
		$query = $this->db->query("SELECT *, o.fullname AS customer, (SELECT os.name FROM " . DB_PREFIX . "order_status os WHERE os.order_status_id = o.order_status_id AND os.language_id = '" . (int)$this->config->get('config_language_id') . "') AS order_status FROM `" . DB_PREFIX . "order` o WHERE o.order_id = '" . (int) $order_id . "' AND o.user_id = '" . (int) $user_id . "'");

		return $query->row;
	}
	
	public function getOrderIdByOnlineshopOrderId($user_id, $onlineshop_order_id) {
		$query = $this->db->query("SELECT order_id FROM " . DB_PREFIX . "order WHERE onlineshop_order_id = '" .  $this->db->escape($onlineshop_order_id) . "' AND user_id = '" . (int) $user_id . "'");
		
		if(isset($query->row['order_id'])) {
			return $query->row['order_id'];
		} else {
			return false;
		}
	}
	
	public function addOrderHistory($user_id, $order_id, $order_status_id, $comment = '', $date = false) {
		$order_info = $this->getOrder($user_id, $order_id);
		
		if ($order_info) {
			// If current order status is not processing or complete but new status is processing or complete then commence completing the order
			if (!in_array($order_info['order_status_id'], array_merge($this->config->get('config_processing_status'), $this->config->get('config_complete_status'))) && in_array($order_status_id, array_merge($this->config->get('config_processing_status'), $this->config->get('config_complete_status')))) {
				// Stock subtraction
				$order_products = $this->getOrderProducts($user_id, $order_id);

				foreach ($order_products as $order_product) {
					$this->db->query("UPDATE " . DB_PREFIX . "product SET quantity = (quantity - " . (int)$order_product['quantity'] . ") WHERE product_id = '" . (int)$order_product['product_id'] . "' AND subtract = '1'");
				}		
			}

			// Update the DB with the new statuses
			if(!$date) {
				$date = date("Y-m-d H:i:s");
			}
			
			$this->db->query("UPDATE `" . DB_PREFIX . "order` SET order_status_id = '" . (int)$order_status_id . "', date_modified = '" . $this->db->escape($date) . "' WHERE order_id = '" . (int)$order_id . "'");

			$this->db->query("INSERT INTO " . DB_PREFIX . "order_history SET order_id = '" . (int)$order_id . "', order_status_id = '" . (int)$order_status_id . "', comment = '" . $this->db->escape($comment) . "', date_added = '" . $this->db->escape($date) . "'");

			// If old order status is the processing or complete status but new status is not then commence restock
			if (in_array($order_info['order_status_id'], array_merge($this->config->get('config_processing_status'), $this->config->get('config_complete_status'))) && !in_array($order_status_id, array_merge($this->config->get('config_processing_status'), $this->config->get('config_complete_status')))) {
				// Restock
				$order_products = $this->getOrderProducts($user_id, $order_id);

				foreach($order_products as $order_product) {
					$this->db->query("UPDATE `" . DB_PREFIX . "product` SET quantity = (quantity + " . (int)$order_product['quantity'] . ") WHERE product_id = '" . (int)$order_product['product_id'] . "' AND subtract = '1'");
				}
			}
		}
	}
	
	public function getOrderHistories($user_id, $order_id, $start = 0, $limit = 10) {
		if(!$this->issetOrder($user_id, $order_id)) {
			return array();
		}
		
		if ($start < 0) {
			$start = 0;
		}

		if ($limit < 1) {
			$limit = 10;
		}

		$query = $this->db->query("SELECT oh.date_added, os.name AS status, oh.comment FROM " . DB_PREFIX . "order_history oh LEFT JOIN " . DB_PREFIX . "order_status os ON oh.order_status_id = os.order_status_id WHERE oh.order_id = '" . (int)$order_id . "' AND os.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY oh.date_added DESC LIMIT " . (int)$start . "," . (int)$limit);

		return $query->rows;
	}
	
	public function createInvoiceNo($user_id, $order_id) {
		$order_info = $this->getOrder($user_id, $order_id);

		if ($order_info && !$order_info['invoice_no']) {
			$query = $this->db->query("SELECT MAX(invoice_no) AS invoice_no FROM `" . DB_PREFIX . "order` WHERE invoice_prefix = '" . $this->db->escape($order_info['invoice_prefix']) . "' AND user_id = '" . (int) $user_id . "'");

			if ($query->row['invoice_no']) {
				$invoice_no = $query->row['invoice_no'] + 1;
			} else {
				$invoice_no = 1;
			}

			$this->db->query("UPDATE `" . DB_PREFIX . "order` SET invoice_no = '" . (int) $invoice_no . "', invoice_prefix = '" . $this->db->escape($order_info['invoice_prefix']) . "' WHERE order_id = '" . (int) $order_id . "'");

			return $order_info['invoice_prefix'] . $invoice_no;
		}
	}
	
	public function getOrderProducts($user_id, $order_id) {
		if(!$this->issetOrder($user_id, $order_id)) {
			return array();
		}
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_product WHERE order_id = '" . (int)$order_id . "'");

		return $query->rows;
	}
	
	public function getOrderTotals($user_id, $order_id) {
		if(!$this->issetOrder($user_id, $order_id)) {
			return array();
		}
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_total WHERE order_id = '" . (int)$order_id . "' ORDER BY sort_order");

		return array_column($query->rows, null, 'code');
	}
	
	public function issetOrder($user_id, $order_id) {
		$query = $this->db->query("SELECT order_id FROM " . DB_PREFIX . "order WHERE order_id = '" . (int) $order_id . "' AND user_id ='" . (int) $user_id . "' LIMIT 1");

		return isset($query->row['order_id']);
	}

	public function getTotalOrdersByOrderStatusId($order_status_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "order` WHERE order_status_id = '" . (int)$order_status_id . "' AND order_status_id > '0'");

		return $query->row['total'];
	}

	public function getTotalOrdersByProcessingStatus() {
		$implode = array();

		$order_statuses = $this->config->get('config_processing_status');

		foreach ($order_statuses as $order_status_id) {
			$implode[] = "order_status_id = '" . (int)$order_status_id . "'";
		}

		if ($implode) {
			$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "order` WHERE " . implode(" OR ", $implode));

			return $query->row['total'];
		} else {
			return 0;
		}
	}

	public function getTotalOrdersByCompleteStatus() {
		$implode = array();

		$order_statuses = $this->config->get('config_complete_status');

		foreach ($order_statuses as $order_status_id) {
			$implode[] = "order_status_id = '" . (int)$order_status_id . "'";
		}

		if ($implode) {
			$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "order` WHERE " . implode(" OR ", $implode) . "");

			return $query->row['total'];
		} else {
			return 0;
		}
	}
	
	public function getTotalOrderHistories($order_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "order_history WHERE order_id = '" . (int)$order_id . "'");

		return $query->row['total'];
	}

	public function newOrder($user_id, $data) {
		if(!isset($data['invoice_prefix'])) {
			$data['invoice_prefix'] = $this->config->get('config_invoice_prefix');
		}

		if(!isset($data['date_added'])) {
			$data['date_added'] = date("Y-m-d H:i:s");
		}
		
		if(!isset($data['date_modified'])) {
			$data['date_modified'] = date("Y-m-d H:i:s");
		}
		
		$this->db->query("INSERT INTO " . DB_PREFIX . "order SET order_status_id = '0', user_id = '" . (int) $user_id . "', onlineshop_code = '', onlineshop_order_id = '', invoice_prefix = '" . $this->db->escape($data['invoice_prefix']) . "', store_name = '" . $this->db->escape($data['store_name']) . "', store_url = '" . $this->db->escape($data['store_url']) . "', fullname = '', email = '', telephone = '', shipping_company = '', shipping_address_1 = '', shipping_address_2 = '', shipping_city = '', shipping_postcode = '', shipping_country = '', shipping_country_id = '', shipping_zone = '', shipping_zone_id = '', shipping_method = '', shipping_code = '', payment_method = '', payment_code = '', comment = '', total = '0', currency_id = '" . (int) $data['currency_id'] . "', currency_code = '" . $this->db->escape($data['currency_code']) . "', currency_value = '" . (float) $data['currency_value'] . "', date_added = '" . $this->db->escape($data['date_added']) . "', date_modified = '" . $this->db->escape($data['date_modified']) . "'");

		$order_id = $this->db->getLastId();
		
		// Totals
		if (isset($data['order_totals'])) {
			foreach($data['order_totals'] as $total) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "order_total SET order_id = '" . (int)$order_id . "', code = '" . $this->db->escape($total['code']) . "', title = '" . $this->db->escape($total['title']) . "', `value` = '" . (float)$total['value'] . "', sort_order = '" . (int)$total['sort_order'] . "'");
			}
		}

		return $order_id;
	}
	
	public function editOrderInfo($user_id, $order_id, $data) {
		if ($order_id == 0) {
			return false;
		}
		
		if(!$this->issetOrder($user_id, $order_id)) {
			return false;
		}
		
		if (isset($data['order_status_id'])) {
			$this->addOrderHistory($user_id, $order_id, $data['order_status_id']);
		}
		
		if (isset($data['shipping_cost'])) {
			$shipping_query = $this->db->query("SELECT order_total_id FROM " . DB_PREFIX . "order_total WHERE order_id = '" . (int) $order_id . "' AND code = 'shipping'");

			if (isset($shipping_query->row['order_total_id'])) {
				$this->db->query("UPDATE " . DB_PREFIX . "order_total SET value = '" . (float) $data['shipping_cost'] . "' WHERE order_total_id = '" . (int) $shipping_query->row['order_total_id'] . "'");
				
				if (isset($data['shipping_method'])) {
					$this->db->query("UPDATE " . DB_PREFIX . "order_total SET title = '" . $this->db->escape($data['shipping_method']) . " WHERE order_total_id = '" . (int) $shipping_query->row['order_total_id'] . "'");
				}
			} else {
				if (isset($data['shipping_method'])) {
					$title = $data['shipping_method'];
				} else {
					$title = '';
				}
				
				$this->db->query("INSERT INTO " . DB_PREFIX . "order_total SET order_id = '" . (int) $order_id . "', title = '" . $this->db->escape($title) . ", value = '" . (float) $data['shipping_cost'] . "'");
			}
			
			$this->updateOrderTotal($user_id, $order_id);
		}
		
		$date_modified = date("Y-m-d H:i:s");
		
		$sql = "UPDATE " . DB_PREFIX . "order SET date_modified = '" . $this->db->escape($date_modified) . "'";
		
		if (isset($data['email'])) {
			$sql .= ", email = '" . $this->db->escape($data['email']) . "'";
		}
		
		if (isset($data['telephone'])) {
			$sql .= ", telephone = '" . $this->db->escape($data['telephone']) . "'";
		}
		
		if (isset($data['fullname'])) {
			$sql .= ", fullname = '" . $this->db->escape($data['fullname']) . "'";
		}
		
		if (isset($data['shipping_company'])) {
			$sql .= ", shipping_company = '" . $this->db->escape($data['shipping_company']) . "'";
		}
		
		if (isset($data['shipping_address_1'])) {
			$sql .= ", shipping_address_1 = '" . $this->db->escape($data['shipping_address_1']) . "'";
		}
		
		if (isset($data['shipping_address_2'])) {
			$sql .= ", shipping_address_2 = '" . $this->db->escape($data['shipping_address_2']) . "'";
		}
		
		if (isset($data['shipping_city'])) {
			$sql .= ", shipping_city = '" . $this->db->escape($data['shipping_city']) . "'";
		}
		
		if (isset($data['shipping_postcode'])) {
			$sql .= ", shipping_postcode = '" . $this->db->escape($data['shipping_postcode']) . "'";
		}
		
		if (isset($data['shipping_country_id'])) {
			$sql .= ", shipping_country_id = '" . (int) $data['shipping_country_id'] . "'";
		}
		
		if (isset($data['shipping_country'])) {
			$sql .= ", shipping_country = '" . $this->db->escape($data['shipping_country']) . "'";
		}
		
		if (isset($data['shipping_zone_id'])) {
			$sql .= ", shipping_zone_id = '" . (int) $data['shipping_zone_id'] . "'";
		}
		
		if (isset($data['shipping_zone'])) {
			$sql .= ", shipping_zone = '" . $this->db->escape($data['shipping_zone']) . "'";
		}
		
		if (isset($data['shipping_method'])) {
			$sql .= ", shipping_method = '" . $this->db->escape($data['shipping_method']) . "'";
		}
		
		if (isset($data['payment_fullname'])) {
			$sql .= ", payment_fullname = '" . $this->db->escape($data['payment_fullname']) . "'";
		}
		
		if (isset($data['payment_company'])) {
			$sql .= ", payment_company = '" . $this->db->escape($data['payment_company']) . "'";
		}
		
		if (isset($data['payment_address_1'])) {
			$sql .= ", payment_address_1 = '" . $this->db->escape($data['payment_address_1']) . "'";
		}
		
		if (isset($data['payment_address_2'])) {
			$sql .= ", payment_address_2 = '" . $this->db->escape($data['payment_address_2']) . "'";
		}
		
		if (isset($data['payment_city'])) {
			$sql .= ", payment_city = '" . $this->db->escape($data['payment_city']) . "'";
		}
		
		if (isset($data['payment_postcode'])) {
			$sql .= ", payment_postcode = '" . $this->db->escape($data['payment_postcode']) . "'";
		}
		
		if (isset($data['payment_country_id'])) {
			$sql .= ", payment_country_id = '" . (int) $data['payment_country_id'] . "'";
		}
		
		if (isset($data['payment_country'])) {
			$sql .= ", payment_country = '" . $this->db->escape($data['payment_country']) . "'";
		}
		
		if (isset($data['payment_zone_id'])) {
			$sql .= ", payment_zone_id = '" . (int) $data['payment_zone_id'] . "'";
		}
		
		if (isset($data['payment_zone'])) {
			$sql .= ", payment_zone = '" . $this->db->escape($data['payment_zone']) . "'";
		}
		
		if (isset($data['payment_method'])) {
			$sql .= ", payment_method = '" . $this->db->escape($data['payment_method']) . "'";
		}
		
		if (isset($data['comment'])) {
			$sql .= ", comment = '" . $this->db->escape($data['comment']) . "'";
		}
		
		if (isset($data['fiscal_code'])) {
			$sql .= ", fiscal_code = '" . $this->db->escape($data['fiscal_code']) . "'";
		}
		
		$sql .= " WHERE order_id = '" . (int) $order_id . "'";
		
		$this->db->query($sql);
	}
	
	public function addOrderProduct($user_id, $order_id, $data) {
		if ($order_id == 0) {
			return false;
		}
		
		if(!$this->issetOrder($user_id, $order_id)) {
			return false;
		}
		
		$this->db->query("INSERT INTO " . DB_PREFIX . "order_product SET order_id = '" . (int) $order_id . "', product_id = '" . (int) $data['product_id'] . "', sku = '" . $this->db->escape($data['sku']) . "', name = '" . $this->db->escape($data['name']) . "', quantity = '" . (int) $data['quantity'] . "', price = '" . (float) $data['price'] . "', total = '" . (float) $data['total'] . "', weight = '" . (float) $data['weight'] . "'");
		
		$order_product_id = $this->db->getLastId();
		
		$date_modified = date("Y-m-d H:i:s");
		
		$this->db->query("UPDATE " . DB_PREFIX . "order SET date_modified = '" . $this->db->escape($date_modified) . "' WHERE order_id = '" . (int) $order_id . "'");
		
		$this->updateOrderTotal($user_id, $order_id);
		
		return $order_product_id;
	}
	
	public function editOrderProduct($user_id, $order_id, $order_product_id, $data) {
		if ($order_id == 0) {
			return false;
		}
		
		if(!$this->issetOrder($user_id, $order_id)) {
			return false;
		}
		
		$this->db->query("UPDATE " . DB_PREFIX . "order_product SET name = '" . $this->db->escape($data['name']) . "', quantity = '" . (int) $data['quantity'] . "', price = '" . (float) $data['price'] . "', total = '" . (float) $data['total'] . "', weight = '" . (float) $data['weight'] . "' WHERE order_product_id = '" . (int) $order_product_id . "'");
		
		$date_modified = date("Y-m-d H:i:s");
		
		$this->db->query("UPDATE " . DB_PREFIX . "order SET date_modified = '" . $this->db->escape($date_modified) . "' WHERE order_id = '" . (int) $order_id . "'");
		
		$this->updateOrderTotal($user_id, $order_id);
		
		return $order_product_id;
	}
	
	public function deleteOrderProduct($user_id, $order_id, $order_product_id) {
		if(!$this->issetOrder($user_id, $order_id)) {
			return false;
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "order_product WHERE order_product_id = '" . (int) $order_product_id . "'");
		
		$this->updateOrderTotal($user_id, $order_id);
		
		return true;
	}
	
	public function getOrderCurrency($user_id, $order_id) {
		$query = $this->db->query("SELECT currency_code FROM " . DB_PREFIX . "order WHERE order_id = '" . (int) $order_id . "' AND user_id = '" . (int) $user_id . "'");
		
		if (isset($query->row['currency_code'])) {
			return $query->row['currency_code'];
		}
		
		return false;
	}
	
	public function getOrderProduct($user_id, $order_id, $order_product_id) {
		if(!$this->issetOrder($user_id, $order_id)) {
			return array();
		}
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_product WHERE order_id = '" . (int)$order_id . "' AND order_product_id = '" . (int)$order_product_id . "'");

		return $query->row;
	}
	
	public function getOrderTotal($user_id, $order_id, $formated = false) {
		if(!$this->issetOrder($user_id, $order_id)) {
			return array();
		}
		
		$query = $this->db->query("SELECT total, currency_code FROM " . DB_PREFIX . "order WHERE order_id = '" . (int)$order_id . "'");
		
		if ($formated) {
			return $this->currency->format($query->row['total'], $query->row['currency_code'], 1);
		} else {
			return $query->row['total'];
		}
	}
	
	public function getOrderStatus($user_id, $order_id) {
		if(!$this->issetOrder($user_id, $order_id)) {
			return array();
		}
		
		$query = $this->db->query("SELECT order_status_id FROM " . DB_PREFIX . "order WHERE order_id = '" . (int)$order_id . "'");

		if (isset($query->row['order_status_id'])) {
			return $query->row['order_status_id'];
		} else {
			return false;
		}
	}
	
	public function updateOrderTotal($user_id, $order_id) {
		if(!$this->issetOrder($user_id, $order_id)) {
			return array();
		}
		
		$sub_total = 0;
		
		$order_products = $this->getOrderProducts($user_id, $order_id);
		
		foreach ($order_products as $order_product) {
			$sub_total += (float) $order_product['total'];
		}
		
		$this->db->query("UPDATE " . DB_PREFIX . "order_total SET value = '" . (float) $sub_total . "' WHERE order_id = '" . (int) $order_id . "' AND code = 'sub_total'");
		
		$order_totals = $this->getOrderTotals($user_id, $order_id);
		
		$total = 0;
		
		foreach ($order_totals as $order_total) {
			if ($order_total['code'] == 'total') {
				continue;
			}
			
			$total += $order_total['value'];
		}
		
		$this->db->query("UPDATE " . DB_PREFIX . "order_total SET value = '" . (float) $total . "' WHERE order_id = '" . (int) $order_id . "' AND code = 'total'");
		
		$this->db->query("UPDATE " . DB_PREFIX . "order SET total = '" . (float) $total . "' WHERE order_id = '" . (int) $order_id . "'");
		
		return $total;
	}
}
