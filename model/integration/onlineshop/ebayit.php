<?php
namespace Opencart\Catalog\Model\Integration\Onlineshop;
class Ebayit extends \Opencart\System\Engine\Model {
	private $language_code = 'it-IT';
	private $marketplace_id = 'EBAY_IT';
	private $marketplace_code = 'ebayit';
	private $locale = 'it_IT';
	
	private $fulfillment_policy = false;
	private $product_category_to_ebay_category = false;
	
	public function getStorage($user_id) {
		$this->load->model('integration/onlineshop/onlineshop');
		
		return $this->model_integration_onlineshop_onlineshop->getStorage($user_id, 'ebayit');
	}
	
	public function editStorage($user_id, $storage) {
		$this->load->model('integration/onlineshop/onlineshop');
		
		$this->model_integration_onlineshop_onlineshop->editStorage($user_id, 'ebayit', $storage);
	}
	
	public function setStorageValue($user_id, $key, $value) {
		$this->load->model('integration/onlineshop/onlineshop');
		
		return $this->model_integration_onlineshop_onlineshop->setStorageValue($user_id, 'ebayit', $key, $value);
	}
	
	public function connect($user_id, $rewrite = false) {
		if (isset($this->session->data['ebayit']['connected']) and isset($this->session->data['ebayit']['expires_in']) and $this->session->data['ebayit']['expires_in'] > time() and !$rewrite) {
			return $this->session->data['ebayit']['connected'];
		}
		
		$this->load->model('integration/onlineshop/onlineshop');
		
		$this->session->data['ebayit'] = array();
		
		$storage = $this->getStorage($user_id);
		
		if (!isset($storage['access_token']) or $storage['expires_in'] < time()) {
			if (isset($storage['refresh_token']) and $storage['refresh_token_expires_in'] > time()) {
				$this->load->model('integration/onlineshop/ebay');
				
				$token_response = $this->model_integration_onlineshop_ebay->refreshToken($storage['refresh_token'], $storage['app_id'], $storage['cert_id'],  $storage['sandbox']);
				
				if (isset($token_response['access_token'])) {
					$storage['access_token'] = $token_response['access_token'];
					$storage['expires_in'] = $token_response['expires_in'] + time();
					
					$this->editStorage($user_id, $storage);
				}
			}
		}
		
		$this->session->data['ebayit'] = $storage;
		$this->session->data['ebayit']['connected'] = 0;
		
		if (!isset($this->session->data['ebayit']['access_token']) or $this->session->data['ebayit']['expires_in'] < time() or !isset($this->session->data['ebayit']['sandbox'])) {
			return 0;
		}
		
		// Testing connection
		$fulfillment_policies = $this->getFulfillmentPolicies();

		if (empty($fulfillment_policies['policies'])) {
			return 0;
		}
		
		if (!isset($this->session->data['ebayit']['fulfillment_policy_id'])) {
			$this->session->data['ebayit']['fulfillment_policy_id'] = 0;
		}
		
		if (!isset($this->session->data['ebayit']['payment_policy_id'])) {
			$this->session->data['ebayit']['payment_policy_id'] = 0;
		}
		
		if (!isset($this->session->data['ebayit']['return_policy_id'])) {
			$this->session->data['ebayit']['return_policy_id'] = 0;
		}
		
		if (!isset($this->session->data['ebayit']['location_key'])) {
			$this->session->data['ebayit']['location_key'] = 0;
		}
		
		if (!isset($this->session->data['ebayit']['max_quantity_value'])) {
			$this->session->data['ebayit']['max_quantity_value'] = 0;
		}
		
		if (!isset($this->session->data['ebayit']['filter_max_price'])) {
			$this->session->data['ebayit']['filter_max_price'] = 0;
		}
		
		if (!isset($this->session->data['ebayit']['filter_min_price'])) {
			$this->session->data['ebayit']['filter_min_price'] = 0;
		}
		
		if (!isset($this->session->data['ebayit']['order_lastmodifieddate'])) {
			$lastmodifieddate = date("Y-m-d") . 'T' . date("H:i:s") . '.' . '000Z';
			
			$this->session->data['ebayit']['order_lastmodifieddate'] = $this->setStorageValue($user_id, 'order_lastmodifieddate', $lastmodifieddate);
		}
		
		$this->session->data['ebayit']['connected'] = 1;
		
		return 1;
	}
	
	public function syncProduct($user_id, $sku, $product = false) {
		$response = array(
			'success' => 0,
			'message' => '',
		);
		
		$warnings = '';
		
		if (!$this->connect($user_id)) {
			return false;
		}
		
		$this->load->model('catalog/product');
		$this->load->model('integration/onlineshop/ebay');
		
		$this->load->language('integration/ebay');
		$this->load->language('integration/onlineshop');
		
		if ($this->user->get('language_id') != 3 or $product === false) {
			$product = $this->model_catalog_product->getProduct($user_id, $sku, 3);
		}
		
		$ebay_sku = $user_id . '-' . $sku;
		
		if (!$product) {
			$onlineshop_data = $this->model_catalog_product->getProduct2OnlineshopData($user_id, $sku, 'ebayit');
			
			if (isset($onlineshop_data['in_inventory'])) {
				$this->model_integration_onlineshop_ebay->deleteInventoryItem($this->session->data['ebayit']['access_token'], $this->language_code, $this->marketplace_id, $ebay_sku, $this->session->data['ebayit']['sandbox']);
				
				$this->model_catalog_product->deleteProduct2Onlineshop($user_id, $sku, 'ebayit');
			}
			
			$response['success'] = 1;
			$response['message'] = $this->language->get('text_deleted');
			
			return $response;
		}
		
		if (!$product['onlineshops']['ebayit']['status'] or !$product['quantity'] or !$product['status'] or (($this->session->data['ebayit']['filter_max_price'] > 0) and ($product['price'] > $this->session->data['ebayit']['filter_max_price'])) or ($product['price'] < $this->session->data['ebayit']['filter_min_price'])) {
			if ($product and isset($product['onlineshops']['ebayit']['data']['offer_id'])) {
				$this->model_integration_onlineshop_ebay->deleteOffer($this->session->data['ebayit']['access_token'], $this->language_code, $this->marketplace_id, $product['onlineshops']['ebayit']['data']['offer_id'], $this->session->data['ebayit']['sandbox']);

				$this->model_catalog_product->setProduct2OnlineshopData($user_id, $sku, 'ebayit', array('in_inventory' => 1));
				
				$response['success'] = 1;
				$response['message'] = $this->language->get('text_disabled');
			} else {
				if (!$product['onlineshops']['ebayit']['status']) {
					return false;
				} else {
					$response['success'] = 1;
					$response['message'] = $this->language->get('text_ignored');
				}
			}
			
			return $response;
		}
		
		//add product
		
		// shipping price
		
		$shipping_price = 0;
		
		$shipping = array();
		
		$fulfillment_policy = $this->fulfillmentPolicy();

		if (isset($fulfillment_policy['shippingOptions'])) {
			foreach ($fulfillment_policy['shippingOptions'] as $shipping_option) {
				if (!isset($shipping_option['optionType']) or !isset($shipping_option['shippingServices'][0]['sortOrder'])) {
					continue;
				}

				$shipping[] = array(
					'type'		=>  $shipping_option['optionType'],
					'priority'	=>  $shipping_option['shippingServices'][0]['sortOrder'],
					'price'		=>  &$shipping_price,
				);
			}
		}
		
		// policies
		
		$policies = array(
			'fulfillment_policy_id'	=> $this->session->data['ebayit']['fulfillment_policy_id'],
			'payment_policy_id' 	=> $this->session->data['ebayit']['payment_policy_id'],
			'return_policy_id'		=> $this->session->data['ebayit']['return_policy_id'],
		);
		
		// uploading product
		
		$product['price'] = $product['price'] + (($product['price'] / 100) * (float) $this->session->data['ebayit']['price_percent']);
		
		$shipping_price = $this->session->data['ebayit']['transport_price_fixed'];
			
		if (isset($this->session->data['ebayit']['transport_price_by_weight']) and is_array($this->session->data['ebayit']['transport_price_by_weight'])) {
			foreach ($this->session->data['ebayit']['transport_price_by_weight'] as $price_by_weight) {
				if ($product['weight'] >= $price_by_weight['weight_from'] and $product['weight'] <= $price_by_weight['weight_to']) {
					$shipping_price += $price_by_weight['price'];
					break;
				}
			}
		}
		
		if (($this->session->data['ebayit']['max_quantity_value'] > 0) and ($product['quantity'] > $this->session->data['ebayit']['max_quantity_value'])) {
			$product['quantity'] = $this->session->data['ebayit']['max_quantity_value'];
		}
		
		$product_categories = $this->model_catalog_product->getProductCategories($user_id, $sku);

		$ebay_category_id = 0;
		
		$product_category_to_ebay_category = $this->productCategoryToEbayCategory();
		
		foreach ($product_categories as $product_category) {
			if (isset($product_category_to_ebay_category[$product_category['category_id']])) {
				$ebay_category_id = $product_category_to_ebay_category[$product_category['category_id']];
				break;
			}
		}
		
		if (!$ebay_category_id && isset($product_category_to_ebay_category[0])) {
			$ebay_category_id = $product_category_to_ebay_category[0];
		} elseif (!$ebay_category_id) {
			$response['message'] = $this->language->get('error_category');
			
			return $response;
		}
		
		$images = array();
		
		if ($product['image']) {
			$images[] = HTTP_SERVER . DIR_IMAGE_RELATIVE . $product['image'];
		}
		
		$product_images = $this->model_catalog_product->getProductImages($user_id, $product['sku']);
		
		foreach ($product_images as $product_image) {
			$images[] = HTTP_SERVER . DIR_IMAGE_RELATIVE . $product_image['image'];
		}
		
		$description = html_entity_decode($product['description']);
		
		if (isset($this->session->data['ebayit']['general_description'])) {
			$description .= html_entity_decode($this->session->data['ebayit']['general_description']);
		}
	
		$item = array(
			'name'			=> oc_substr($product['name'], 0, 80),
			'description'	=> oc_substr($description, 0, 4000),
			'brand'			=> oc_substr($product['brand'], 0, 65),
			'used'			=> $product['used'],
			'images'		=> $images,
			'sku'			=> $ebay_sku,
			'ean'			=> $product['ean'],
			'mpn'			=> $product['mpn'],
			'quantity'		=> $product['quantity'],
		);
		
		if ($item['used']) {
			$item['conditionDescription'] = $this->language->get('text_condition_in_photo');
		}
		
		$item_response = $this->model_integration_onlineshop_ebay->createOrReplaceInventoryItem($this->session->data['ebayit']['access_token'], $this->language_code, $this->marketplace_id, $item, $this->session->data['ebayit']['sandbox']);

		if (isset($item_response['errors'])) {
			$response['message'] = $this->model_integration_onlineshop_ebay->getError($item_response);
			
			return $response;
		} else {
			$product['onlineshops']['ebayit']['data']['in_inventory'] = 1;
			
			$this->model_catalog_product->setProduct2OnlineshopData($user_id, $product['sku'], 'ebayit', $product['onlineshops']['ebayit']['data']);
			
			if (isset($item_response['warnings'])) {
				$warnings .= '<br/>' . $this->model_integration_onlineshop_ebay->getWarning($item_response);
			}
		}
		
		if (isset($product['onlineshops']['ebayit']['data']['offer_id'])) {
			$offer = array(
				'quantity'				=> $product['quantity'],
				'price'					=> $product['price'],
				'currency'				=> 'EUR',
				'ebay_category_id'		=> $ebay_category_id,
				'policies'				=> $policies,
				'location_key'			=> $this->session->data['ebayit']['location_key'],
				'listingDescription'	=> oc_substr($description, 0, 500000),
			);
			
			if ($shipping_price && $shipping) {
				$offer['shipping'] = $shipping;
			}
			
			$update_offer_response = $this->model_integration_onlineshop_ebay->updateOffer($this->session->data['ebayit']['access_token'], $this->language_code, $this->marketplace_id, $product['onlineshops']['ebayit']['data']['offer_id'], $offer, $this->session->data['ebayit']['sandbox']);
			
			if (isset($update_offer_response['errors'])) {
				$response['message'] = $this->model_integration_onlineshop_ebay->getError($update_offer_response);
				
				return $response;
			}
			
			if (isset($update_offer_response['warnings'])) {
				$warnings .= '<br/>' . $this->model_integration_onlineshop_ebay->getWarning($update_offer_response);
			}
		} else {
			$offer = array(
				'sku'					=> $ebay_sku,
				'quantity'				=> $product['quantity'],
				'price'					=> $product['price'],
				'currency'				=> 'EUR',
				'ebay_category_id'		=> $ebay_category_id,
				'policies'				=> $policies,
				'location_key'			=> $this->session->data['ebayit']['location_key'],
				'listingDescription'	=> oc_substr($description, 0, 500000),
			);
			
			if ($shipping_price && $shipping) {
				$offer['shipping'] = $shipping;
			}
			
			$offer_response = $this->model_integration_onlineshop_ebay->createOffer($this->session->data['ebayit']['access_token'], $this->language_code, $this->marketplace_id, $offer, $this->session->data['ebayit']['sandbox']);
			
			if (isset($offer_response['offerId'])) {
				$product['onlineshops']['ebayit']['data']['offer_id'] = $offer_response['offerId'];
				
				$this->model_catalog_product->setProduct2OnlineshopData($user_id, $product['sku'], 'ebayit', $product['onlineshops']['ebayit']['data']);
				
				if (isset($offer_response['warnings'])) {
					$warnings .= '<br/>' . $this->model_integration_onlineshop_ebay->getWarning($offer_response);
				}
			} else {
				$response['message'] = $this->model_integration_onlineshop_ebay->getError($offer_response);
			
				return $response;
			}
		}
		
		$publish_response = $this->model_integration_onlineshop_ebay->publishOffer($this->session->data['ebayit']['access_token'], $this->language_code, $this->marketplace_id, $product['onlineshops']['ebayit']['data']['offer_id'], $this->session->data['ebayit']['sandbox']);
		
		if (isset($publish_response['listingId'])) {
			if (!isset($product['onlineshops']['ebayit']['data']['listing_id']) or $product['onlineshops']['ebayit']['data']['listing_id'] !== $publish_response['listingId']) {
				$product['onlineshops']['ebayit']['data']['listing_id'] = $publish_response['listingId'];
				
				$this->model_catalog_product->setProduct2OnlineshopData($user_id, $product['sku'], 'ebayit', $product['onlineshops']['ebayit']['data']);
			
				$this->model_catalog_product->setOnlineshopProductId($user_id, $product['sku'], 'ebayit', $product['onlineshops']['ebayit']['data']['listing_id']);
			}

			$response['success'] = 1;
			$response['message'] = $this->language->get('text_uploaded');
			
			if (isset($publish_response['warnings'])) {
				$warnings .= '<br/>' . $this->model_integration_onlineshop_ebay->getWarning($publish_response);
			}
		} else {
			$response['message'] = $this->model_integration_onlineshop_ebay->getError($publish_response);
		}
		
		if ($warnings) {
			$response['message'] .= $warnings;
		}
		
		return $response;
	}
	
	public function getOrders($user_id) {
		$response = array();
		
		if (!$this->connect($user_id)) {
			return $response;
		}

		$this->load->model('integration/onlineshop/ebay');
		$this->load->model('catalog/product');
		$this->load->model('sale/order');
		$this->load->model('localisation/country');
		
		$this->load->language('sale/order');
		
		$max = 50;
		
		$offset = 0;
		$limit = 50;
		
		$filter_data = array(
			'lastmodifieddate' => $this->session->data['ebayit']['order_lastmodifieddate'],
			'offset' => &$offset,
			'limit' => &$limit,
		);

		$orders = $this->model_integration_onlineshop_ebay->getOrders($this->session->data['ebayit']['access_token'], $this->language_code, $this->marketplace_id, $filter_data, $this->session->data['ebayit']['sandbox']);

		if (!isset($orders['orders'])) {
			return array();
		}
		
		if ($orders['total'] > $offset + $limit) {
			$offset = $orders['total'] - $limit;
			
			$orders = $this->model_integration_onlineshop_ebay->getOrders($this->session->data['ebayit']['access_token'], $this->language_code, $this->marketplace_id, $filter_data, $this->session->data['ebayit']['sandbox']);
		}

		$order_lastmodifieddate = 0;		

		foreach ($orders['orders'] as $order) {
			if (strtotime($order['lastModifiedDate']) <= strtotime($this->session->data['ebayit']['order_lastmodifieddate'])) {
				continue;
			}
			
			if ($order_lastmodifieddate !== 0 and (strtotime($order['lastModifiedDate']) > strtotime($order_lastmodifieddate))) {
				$order_lastmodifieddate = $order['lastModifiedDate'];
			} elseif ($order_lastmodifieddate === 0 and (strtotime($order['lastModifiedDate']) > strtotime($this->session->data['ebayit']['order_lastmodifieddate']))) {
				$order_lastmodifieddate = $order['lastModifiedDate'];
			}
			
			$order_data = array();
			
			$order_data['date_added'] = str_replace('T', ' ', explode('.', $order['creationDate'])[0]);
			$order_data['date_modified'] = str_replace('T', ' ', explode('.', $order['lastModifiedDate'])[0]);
			
			$order_data['onlineshop_order_id'] = $order['orderId'];
			
			$order_id = $this->model_sale_order->getOrderIdByOnlineshopOrderId($user_id, $order_data['onlineshop_order_id']);
			
			if ($order['orderFulfillmentStatus'] === 'FULFILLED' && $order_id) {
				$order_data['order_status'] = $this->config->get('config_complete_status')[0];
			}
			
			if ($order_id) {
				$order_data['order_id'] = $order_id;
				
				$response[] = $order_data;
				continue;
			}
			
			$order_data['invoice_prefix'] = $this->config->get('config_invoice_prefix');
			
			$order_data['store_name'] = $this->user->get('company');
			$order_data['store_url'] = $this->user->get('website');
			$order_data['onlineshop_code'] = 'ebayit';
			
			$order_data['fullname'] = $order['buyer']['username'];
			$order_data['email'] = '';
			$order_data['telephone'] = '';
			
			$order_data['shipping_company'] = '';
			$order_data['shipping_address_1'] = '';
			$order_data['shipping_address_2'] = '';
			$order_data['shipping_city'] = '';
			$order_data['shipping_postcode'] = '';
			
			$order_data['comment'] = '';
			
			$order_data['shipping_country'] = '';
			$order_data['shipping_country_id'] = '';
			$order_data['shipping_zone'] = '';
			$order_data['shipping_zone_id'] = '';
			
			if (isset($order['fulfillmentStartInstructions'][0]['shippingStep']['shipTo'])) {
				$ship_to = $order['fulfillmentStartInstructions'][0]['shippingStep']['shipTo'];
				
				if (isset($ship_to['fullName'])) {
					$order_data['fullname'] = $ship_to['fullName'];
				}
				
				if (isset($ship_to['email'])) {
					$order_data['email'] = $ship_to['email'];
				}
				
				if (isset($ship_to['primaryPhone']['phoneNumber'])) {
					$order_data['telephone'] = $ship_to['primaryPhone']['phoneNumber'];
				}
				
				if (isset($ship_to['companyName'])) {
					$order_data['shipping_company'] = $ship_to['companyName'];
				}
				
				if (isset($ship_to['contactAddress']['addressLine1'])) {
					$order_data['shipping_address_1'] = $ship_to['contactAddress']['addressLine1'];
				}
				
				if (isset($ship_to['contactAddress']['addressLine2'])) {
					$order_data['shipping_address_2'] = $ship_to['contactAddress']['addressLine2'];
				}
				
				if (isset($ship_to['contactAddress']['city'])) {
					$order_data['shipping_city'] = $ship_to['contactAddress']['city'];
				}
				
				if (isset($ship_to['contactAddress']['postalCode'])) {
					$order_data['shipping_postcode'] = $ship_to['contactAddress']['postalCode'];
				}
				
				if (isset($ship_to['contactAddress']['country'])) {
					$order_data['shipping_country'] = $ship_to['contactAddress']['country'];
				}
				
				if (isset($ship_to['contactAddress']['countryCode'])) {
					$country = $this->model_localisation_country->getCountryByCode($ship_to['contactAddress']['countryCode']);
					
					if (isset($country)) {
						$order_data['shipping_country_id'] = $country['country_id'];
						$order_data['shipping_country'] = $country['name'];
					}
				}
				
				if (isset($ship_to['contactAddress']['stateOrProvince'])) {
					$order_data['shipping_zone'] = $ship_to['contactAddress']['stateOrProvince'];
				}
				
			}
			
			if (isset($order['fulfillmentStartInstructions'][0]['shippingStep'])) {
				$order_data['shipping_method'] = $order['fulfillmentStartInstructions'][0]['shippingStep']['shippingServiceCode'];
			} else {
				$order_data['shipping_method'] = '';
			}
			
			$order_data['shipping_code'] = '';
			
			$order_data['order_product'] = array();
			
			foreach ($order['lineItems'] as $item) {
				$product = $this->model_catalog_product->getProductByOnlineshopProductId($user_id, 'ebayit', $item['legacyItemId']);
				
				if ($product) {
					$product_id = $product['product_id'];
					$sku = $product['sku'];
					$weight = $product['weight'];
				} else {
					$product_id = 0;
					$sku = '';
					$weight = 0;
				}
				
				$order_data['order_product'][] = array(
					'product_id'	=> $product_id,
					'sku'			=> $sku,
					'name'			=> $item['title'],
					'quantity'		=> $item['quantity'],
					'price'			=> $item['lineItemCost']['value'],
					'total'			=> $item['lineItemCost']['value'] * $item['quantity'],
					'weight'		=> $weight,
				);
			}
			
			$total_data = array();
			$total = 0;

			foreach ($order['pricingSummary'] as $key => $summary) {
				if ($key === 'priceSubtotal') {
					$total_data['sub_total'] = array(
						'code' => 'sub_total',
						'title' => $this->language->get('text_sub_total'),
						'value' => (float) $summary['value'],
						'sort_order' => '1',
					);
					
					$total += (float) $summary['value'];
					continue;
				}
				
				if ($key === 'deliveryCost') {
					$total_data['shipping'] = array(
						'code' => 'shipping',
						'title' => $this->language->get('text_shipping'),
						'value' => (float) $summary['value'],
						'sort_order' => '2',
					);
					
					$total += (float) $summary['value'];
					continue;
				}
				
				if ($key === 'total') {
					continue;
				}
				
				$total_data[] = array(
					'title' => $key,
					'value' => (float) $summary['value'],
				);
				
				$total_data[] = array(
					'code' => '',
					'title' => $key,
					'value' => (float) $summary['value'],
					'sort_order' => count($total_data) + 1,
				);
				
				$total += (float) $summary['value'];
			}
			
			$total_data['total'] = array(
				'code' => 'total',
				'title' => $this->language->get('text_total'),
				'value' => $total,
				'sort_order' => '9',
			);
			
			$order_data['order_totals'] = $total_data;
			$order_data['total'] = $total;

			$order_data['currency_code'] = $order['pricingSummary']['total']['currency'];
			$order_data['currency_id'] = $this->currency->getId($order_data['currency_code']);
			$order_data['currency_value'] = $this->currency->getValue($order_data['currency_code']);
			
			$response[] = $order_data;
		}

		if ($order_lastmodifieddate !== 0) {
			$this->session->data['ebayit']['order_lastmodifieddate'] = $this->setStorageValue($user_id, 'order_lastmodifieddate', $order_lastmodifieddate);
		}
		
		return $response;
	}
	
	//
	// FUNCTIONS
	//
	
	public function getFulfillmentPolicies() {
		if (!isset($this->session->data['ebayit']['access_token']) or !isset($this->session->data['ebayit']['sandbox'])) {
			return array('success' => false, 'error' => '');
		}
		
		$this->load->model('integration/onlineshop/ebay');
		
		$response = $this->model_integration_onlineshop_ebay->getFulfillmentPolicies($this->session->data['ebayit']['access_token'], $this->language_code, $this->marketplace_id, $this->session->data['ebayit']['sandbox']);
		
		if (isset($response['fulfillmentPolicies'])) {
			return array('success' => true, 'policies' => $response['fulfillmentPolicies']);
		} else {
			return array('success' => false, 'error' => $this->model_integration_onlineshop_ebay->getError($response));
		}
	}
	
	public function getPaymentPolicies() {
		if (!isset($this->session->data['ebayit']['access_token']) or !isset($this->session->data['ebayit']['sandbox'])) {
			return array('success' => false, 'error' => '');
		}
		
		$this->load->model('integration/onlineshop/ebay');
		
		$response = $this->model_integration_onlineshop_ebay->getPaymentPolicies($this->session->data['ebayit']['access_token'], $this->language_code, $this->marketplace_id, $this->session->data['ebayit']['sandbox']);
		
		if (isset($response['paymentPolicies'])) {
			return array('success' => true, 'policies' => $response['paymentPolicies']);
		} else {
			return array('success' => false, 'error' => $this->model_integration_onlineshop_ebay->getError($response));
		}
	}
	
	public function getReturnPolicies() {
		if (!isset($this->session->data['ebayit']['access_token']) or !isset($this->session->data['ebayit']['sandbox'])) {
			return array('success' => false, 'error' => '');
		}
		
		$this->load->model('integration/onlineshop/ebay');
		
		$response = $this->model_integration_onlineshop_ebay->getReturnPolicies($this->session->data['ebayit']['access_token'], $this->language_code, $this->marketplace_id, $this->session->data['ebayit']['sandbox']);
		
		if (isset($response['returnPolicies'])) {
			return array('success' => true, 'policies' => $response['returnPolicies']);
		} else {
			return array('success' => false, 'error' => $this->model_integration_onlineshop_ebay->getError($response));
		}
	}
	
	public function getInventoryLocations() {
		if (!isset($this->session->data['ebayit']['access_token']) or !isset($this->session->data['ebayit']['sandbox'])) {
			return array('success' => false, 'error' => '');
		}
		
		$this->load->model('integration/onlineshop/ebay');
		
		$response = $this->model_integration_onlineshop_ebay->getInventoryLocations($this->session->data['ebayit']['access_token'], $this->language_code, $this->marketplace_id, $this->session->data['ebayit']['sandbox']);
		
		if (isset($response['locations'])) {
			return array('success' => true, 'locations' => $response['locations']);
		} else {
			return array('success' => false, 'error' => $this->model_integration_onlineshop_ebay->getError($response));
		}
	}
	
	public function optInToProgram() {
		if (!isset($this->session->data['ebayit']['access_token']) or !isset($this->session->data['ebayit']['sandbox'])) {
			return array('success' => false, 'error' => '');
		}
		
		$this->load->model('integration/onlineshop/ebay');
		
		$this->model_integration_onlineshop_ebay->optInToProgram($this->session->data['ebayit']['access_token'], $this->language_code, $this->marketplace_id, $this->session->data['ebayit']['sandbox']);
	}
	
	private function fulfillmentPolicy() {
		if ($this->fulfillment_policy !== false) {
			return $this->fulfillment_policy;
		}
		
		$this->load->model('integration/onlineshop/ebay');
		
		$this->fulfillment_policy = $this->model_integration_onlineshop_ebay->getFulfillmentPolicy($this->session->data['ebayit']['access_token'], $this->language_code, $this->marketplace_id, $this->session->data['ebayit']['fulfillment_policy_id'], $this->session->data['ebayit']['sandbox']);
		
		return $this->fulfillment_policy;
	}
	
	private function productCategoryToEbayCategory() {
		if ($this->product_category_to_ebay_category !== false) {
			return $this->product_category_to_ebay_category;
		}
		
		$this->load->model('integration/onlineshop/ebay');
		
		$this->product_category_to_ebay_category = $this->model_integration_onlineshop_ebay->getEbayCategoryToProductCategory($this->marketplace_id);
		
		return $this->product_category_to_ebay_category;
	}
}