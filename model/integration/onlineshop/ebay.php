<?php
namespace Opencart\Catalog\Model\Integration\Onlineshop;
class Ebay extends \Opencart\System\Engine\Model {
	// ORDERS
	public function getOrders($token, $language, $marketplace_id, $filter_data, $sandbox) {
		$filter = '';
		
		if ($filter_data['lastmodifieddate']) {
			$filter = 'lastmodifieddate:%5B' . $filter_data['lastmodifieddate'] . '%5D';
		}
		
		if ($filter_data['limit']) {
			$filter .= '&limit=' . $filter_data['limit'];
		}
		
		if ($filter_data['offset']) {
			$filter .= '&offset=' . $filter_data['offset'];
		}
		
		$json = $this->requestGET($this->getHeaders($token, $language, $marketplace_id), 'sell/fulfillment', 'order?filter=' . $filter, $sandbox);
		return json_decode($json, true);
	}
	
	// INVENTORY
	public function createOrReplaceInventoryItem($token, $language, $marketplace_id, $item, $sandbox) {
		$put = array(
			'sku' => $item['sku'],
			'product' => array(
				'title' => $item['name'],
				'description' => $item['description'],
			),
			'condition' => $item['used'] ? 'USED_EXCELLENT' : 'NEW',
		);
		
		if (!empty($item['quantity'])) {
			$put['availability']['shipToLocationAvailability']['quantity'] = $item['quantity'];
		}
		
		if (!empty($item['brand'])) {
			$put['product']['brand'] = $item['brand'];
			$put['product']['aspects']['Brand'] = array($item['brand']);
		} else {
			$put['product']['brand'] = 'Unbranded';
			$put['product']['aspects']['Brand'] = array('Unbranded');
		}
		
		if (!empty($item['mpn'])) {
			$put['product']['mpn'] = $item['mpn'];
			$put['product']['aspects']['mpn'] = array($item['mpn']);
		} else {
			$put['product']['mpn'] = 'Does not apply';
			$put['product']['aspects']['mpn'] = array('Does not apply');
		}
		
		if (!empty($item['ean'])) {
			$put['product']['ean'] = array($item['ean']);
			$put['product']['aspects']['ean'] = array($item['ean']);
		} elseif (!$item['used']) {
			$put['product']['ean'] = array('Does not apply');
			$put['product']['aspects']['ean'] = array('Does not apply');
		}
		
		if (!empty($item['images'])) {
			$put['product']['imageUrls'] = $item['images'];
		}
		
		if (!empty($item['conditionDescription'])) {
			$put['conditionDescription'] = $item['conditionDescription'];
		}
		
		$json = $this->requestPUT($this->getHeaders($token, $language, $marketplace_id), 'sell/inventory', 'inventory_item/' . $item['sku'], json_encode($put), $sandbox);
		
		return json_decode($json, true);
	}
	
	public function getInventoryItem($token, $language, $marketplace_id, $sku, $sandbox) {
		$json = $this->requestGET($this->getHeaders($token, $language, $marketplace_id), 'sell/inventory', 'inventory_item/' . $sku, $sandbox);
		return json_decode($json, true);
	}
	
	public function createOffer($token, $language, $marketplace_id, $offer, $sandbox) {
		$post = array(
			'sku' => $offer['sku'],
			'marketplaceId' => $marketplace_id,
			'availableQuantity' => (int) $offer['quantity'],
			'format' => 'FIXED_PRICE',
			'categoryId' => $offer['ebay_category_id'],
			'pricingSummary' => array(
				'price' => array(
					'value' => $offer['price'],
					'currency' => $offer['currency'],
				)
			),
			'listingPolicies' => array(
				'fulfillmentPolicyId' => $offer['policies']['fulfillment_policy_id'],
				'returnPolicyId' => $offer['policies']['return_policy_id'],
				'paymentPolicyId' => $offer['policies']['payment_policy_id'],
			),
			'merchantLocationKey' => $offer['location_key'],
		);
		
		if (!empty($offer['shipping'])) {
			foreach ($offer['shipping'] as $shipping) {
				$post['listingPolicies']['shippingCostOverrides'][] = array(
					'shippingServiceType' => $shipping['type'],
					'priority' => $shipping['priority'],
					'shippingCost' => array(
						'value' => $shipping['price'],
						'currency' => $offer['currency'],
					),
				);
			}
		}
		
		$json = $this->requestPOST($this->getHeaders($token, $language, $marketplace_id), 'sell/inventory', 'offer', json_encode($post), $sandbox);
		return json_decode($json, true);
	}
	
	public function updateOffer($token, $language, $marketplace_id, $id, $offer, $sandbox) {
		$put = array(
			'availableQuantity' => (int) $offer['quantity'],
			'categoryId' => $offer['ebay_category_id'],
			'pricingSummary' => array(
				'price' => array(
					'value' => $offer['price'],
					'currency' => $offer['currency'],
				)
			),
			'listingPolicies' => array(
				'fulfillmentPolicyId' => $offer['policies']['fulfillment_policy_id'],
				'returnPolicyId' => $offer['policies']['return_policy_id'],
				'paymentPolicyId' => $offer['policies']['payment_policy_id'],
			),
			'merchantLocationKey' => $offer['location_key'],
		);
		
		if (!empty($offer['shipping'])) {
			foreach ($offer['shipping'] as $shipping) {
				$put['listingPolicies']['shippingCostOverrides'][] = array(
					'shippingServiceType' => $shipping['type'],
					'priority' => $shipping['priority'],
					'shippingCost' => array(
						'value' => $shipping['price'],
						'currency' => $offer['currency'],
					),
				);
			}
		}

		$json = $this->requestPUT($this->getHeaders($token, $language, $marketplace_id), 'sell/inventory', 'offer/' . $id, json_encode($put), $sandbox);
		return json_decode($json, true);
	}
	
	public function getOffer($token, $language, $marketplace_id, $id, $sandbox) {
		$json = $this->requestGET($this->getHeaders($token, $language, $marketplace_id), 'sell/inventory', 'offer/' . $id, $sandbox);
		return json_decode($json, true);
	}
	
	public function deleteInventoryItem($token, $language, $marketplace_id, $sku, $sandbox) {
		$json = $this->requestDELETE($this->getHeaders($token, $language, $marketplace_id), 'sell/inventory', 'inventory_item/' . $sku, $sandbox);
		return json_decode($json, true);
	}
	
	public function deleteOffer($token, $language, $marketplace_id, $offer_id, $sandbox) {
		$json = $this->requestDELETE($this->getHeaders($token, $language, $marketplace_id), 'sell/inventory', 'offer/' . $offer_id, $sandbox);
		return json_decode($json, true);
	}
	
	public function publishOffer($token, $language, $marketplace_id, $offer_id, $sandbox) {
		$json = $this->requestPOST($this->getHeaders($token, $language, $marketplace_id), 'sell/inventory', 'offer/' . $offer_id . '/publish/', array(), $sandbox);
		return json_decode($json, true);
	}
	
	public function bulkUpdatePriceQuantity($token, $language, $marketplace_id, $data, $sandbox) {
		$post = array(
			'requests' => array(),
		);
		
		foreach ($data as $item) {
			$request = array();
			$request['sku'] = $item['sku'];
			$request['shipToLocationAvailability']['quantity'] = $item['quantity'];
			
			foreach ($item['offers'] as $offer) {
				$request['offers'][] = array(
					'offerId' => $offer['offer_id'],
					'availableQuantity' => $offer['quantity'],
					'price' => array(
						'value' => $offer['price'],
						'currency' => $offer['currency'],
					),
				);
			}
			
			$post['requests'][] = $request;
		}
		
		$json = $this->requestPOST($this->getHeaders($token, $language, $marketplace_id), 'sell/inventory', 'bulk_update_price_quantity', json_encode($post), $sandbox);
		return json_decode($json, true);
	}
	
	public function bulkCreateOrReplaceInventoryItem($token, $language, $marketplace_id, $locale, $data, $sandbox) {
		$this->load->language('onlineshop/ebay');
		
		$post = array(
			'requests' => array(),
		);
		
		foreach ($data as $item) {
			$request = array(
				'sku' => $item['sku'],
				'locale' => $locale,
				'product' => array(
					'title' => $item['name'],
					'description' => $item['description'],
				),
				'condition' => $item['used'] ? 'USED_EXCELLENT' : 'NEW',
			);
			
			if (!empty($item['quantity'])) {
				$request['availability']['shipToLocationAvailability']['quantity'] = $item['quantity'];
			}
			
			if (!empty($item['brand'])) {
				$request['product']['brand'] = $item['brand'];
				$request['product']['aspects']['Brand'] = array($item['brand']);
			} else {
				$request['product']['brand'] = 'Unbranded';
				$request['product']['aspects']['Brand'] = array('Unbranded');
			}
			
			if (!empty($item['mpn'])) {
				$request['product']['mpn'] = $item['mpn'];
				$request['product']['aspects']['mpn'] = array($item['mpn']);
			} else {
				$request['product']['mpn'] = 'Does not apply';
				$request['product']['aspects']['mpn'] = array('Does not apply');
			}
			
			if (!empty($item['ean'])) {
				$request['product']['ean'] = array($item['ean']);
				$request['product']['aspects']['ean'] = array($item['ean']);
			} elseif (!$item['used']) {
				$request['product']['ean'] = array('Does not apply');
				$request['product']['aspects']['ean'] = array('Does not apply');
			}
			
			if (!empty($item['images'])) {
				$request['product']['imageUrls'] = $item['images'];
			}
			
			if ($item['used']) {
				$request['conditionDescription'] = $this->language->get('message_used_condition');
			}
			
			$post['requests'][] = $request;
		}
		
		$json = $this->requestPOST($this->getHeaders($token, $language, $marketplace_id), 'sell/inventory', 'bulk_create_or_replace_inventory_item', json_encode($post), $sandbox);
		return json_decode($json, true);
	}
	
	public function bulkCreateOffer($token, $language, $marketplace_id, $data, $sandbox) {
		$this->load->language('onlineshop/ebay');
		
		$post = array(
			'requests' => array(),
		);
		
		foreach ($data as $offer) {
			$request = array(
				'sku' => $offer['sku'],
				'marketplaceId' => $marketplace_id,
				'availableQuantity' => (int) $offer['quantity'],
				'format' => 'FIXED_PRICE',
				'categoryId' => $offer['ebay_category_id'],
				'pricingSummary' => array(
					'price' => array(
						'value' => $offer['price'],
						'currency' => $offer['currency'],
					)
				),
				'listingPolicies' => array(
					'fulfillmentPolicyId' => $offer['policies']['fulfillment_policy_id'],
					'returnPolicyId' => $offer['policies']['return_policy_id'],
					'paymentPolicyId' => $offer['policies']['payment_policy_id'],
				),
				'merchantLocationKey' => $offer['location_key'],
			);
			
			if (!empty($offer['shipping'])) {
				foreach ($offer['shipping'] as $shipping) {
					$request['listingPolicies']['shippingCostOverrides'][] = array(
						'shippingServiceType' => $shipping['type'],
						'priority' => $shipping['priority'],
						'shippingCost' => array(
							'value' => $shipping['price'],
							'currency' => $offer['currency'],
						),
					);
				}
			}
			
			
			$post['requests'][] = $request;
		}
		
		$json = $this->requestPOST($this->getHeaders($token, $language, $marketplace_id), 'sell/inventory', 'bulk_create_offer', json_encode($post), $sandbox);
		return json_decode($json, true);
	}
	
	public function bulkPublishOffer($token, $language, $marketplace_id, $data, $sandbox) {
		$this->load->language('onlineshop/ebay');
		
		$post = array(
			'requests' => array(),
		);
		
		foreach ($data as $offer_id) {
			$post['requests'][] = array(
				'offerId' => $offer_id,
			);
		}
		
		$json = $this->requestPOST($this->getHeaders($token, $language, $marketplace_id), 'sell/inventory', 'bulk_publish_offer', json_encode($post), $sandbox);
		return json_decode($json, true);
	}
	
	// ACCOUNT
	public function getFulfillmentPolicies($token, $language, $marketplace_id, $sandbox) {
		$json = $this->requestGET($this->getHeaders($token, $language, $marketplace_id), 'sell/account', 'fulfillment_policy?marketplace_id=' . $marketplace_id, $sandbox);
		return json_decode($json, true);
	}
	
	public function getFulfillmentPolicy($token, $language, $marketplace_id, $policy_id, $sandbox) {
		$json = $this->requestGET($this->getHeaders($token, $language, $marketplace_id), 'sell/account', 'fulfillment_policy/' . $policy_id, $sandbox);
		return json_decode($json, true);
	}
	
	public function getPaymentPolicies($token, $language, $marketplace_id, $sandbox) {
		$json = $this->requestGET($this->getHeaders($token, $language, $marketplace_id), 'sell/account', 'payment_policy?marketplace_id=' . $marketplace_id, $sandbox);
		return json_decode($json, true);
	}
	
	public function getReturnPolicies($token, $language, $marketplace_id, $sandbox) {
		$json = $this->requestGET($this->getHeaders($token, $language, $marketplace_id), 'sell/account', 'return_policy?marketplace_id=' . $marketplace_id, $sandbox);
		return json_decode($json, true);
	}
	
	public function getInventoryLocations($token, $language, $marketplace_id, $sandbox) {
		$json = $this->requestGET($this->getHeaders($token, $language, $marketplace_id), 'sell/inventory', 'location', $sandbox);
		return json_decode($json, true);
	}
	
	public function createPaymentPolicy($token, $language, $marketplace_id, $data, $sandbox) {
		$post = array(
			'name' => $data['name'],
			'marketplaceId' => $marketplace_id,
			'categoryTypes' => array(
				array(
					'name' => 'ALL_EXCLUDING_MOTORS_VEHICLES',
				),
			),
		);
		
		$json = $this->requestPOST($this->getHeaders($token, $language, $marketplace_id), 'sell/account', 'payment_policy', json_encode($post), $sandbox);
		return json_decode($json, true);
	}
	
	public function createFulfillmentPolicy($token, $language, $marketplace_id, $data, $sandbox) {
		$post = array(
			'name' => $data['name'],
			'marketplaceId' => $marketplace_id,
			'categoryTypes' => array(
				array(
					'name' => 'ALL_EXCLUDING_MOTORS_VEHICLES',
				),
			),
		);
		
		$json = $this->requestPOST($this->getHeaders($token, $language, $marketplace_id), 'sell/account', 'fulfillment_policy', json_encode($post), $sandbox);
		return json_decode($json, true);
	}
	
	public function createReturnPolicy($token, $language, $marketplace_id, $data, $sandbox) {
		if ($data['period']) {
			$post = array(
				'name' => $data['name'],
				'marketplaceId' => $marketplace_id,
				'refundMethod' => 'MONEY_BACK',
				'returnsAccepted' => true,
				'returnShippingCostPayer' => 'SELLER',
				'returnPeriod' => array(
					'value' => (int) $data['period'],
					'unit' => 'DAY',
				),
			);
		} else {
			$post = array(
				'name' => $data['name'],
				'marketplaceId' => $marketplace_id,
				'returnsAccepted' => false,
			);
		}
		
		$json = $this->requestPOST($this->getHeaders($token, $language, $marketplace_id), 'sell/account', 'return_policy', json_encode($post), $sandbox);
		return json_decode($json, true);
	}
	
	public function createInventoryLocation($token, $language, $marketplace_id, $key, $data, $sandbox) {
		$post = array(
			'location' => array(
				'address' => array(
					'stateOrProvince' => $data['state'],
					'country' => $data['country'],
					'city' => $data['city'],
				),
			),
			'name' => $key,
			'phone' => $data['phone'],
		);
		
		if (isset($data['address_1']) && $data['address_1']) {
			$post['location']['address']['addressLine1'] =  $data['address_1'];
		}
		
		if (isset($data['address_2']) && $data['address_2']) {
			$post['location']['address']['addressLine2'] =  $data['address_2'];
		}
		
		if (isset($data['postcode']) && $data['postcode']) {
			$post['location']['address']['postalCode'] =  $data['postcode'];
		}
		
		$json = $this->requestPOST($this->getHeaders($token, $language, $marketplace_id), 'sell/inventory', 'location/' . $key, json_encode($post), $sandbox);
		return json_decode($json, true);
	}
	
	public function deleteInventoryLocation($token, $language, $marketplace_id, $key, $sandbox) {
		$json = $this->requestDELETE($this->getHeaders($token, $language, $marketplace_id), 'sell/inventory', 'location/' . $key, $sandbox);
		return json_decode($json, true);
	}
	
	public function optInToProgram($token, $language, $marketplace_id, $sandbox) {
		$post = array(
			'programType' => 'SELLING_POLICY_MANAGEMENT'
		);
		
		$json = $this->requestPOST($this->getHeaders($token, $language, $marketplace_id), 'sell/account', 'program/opt_in', json_encode($post), $sandbox);
		return json_decode($json, true);
	}
	
	// AUTHORIZATION
	public function getUserConsent($app_id, $ru_name, $sandbox = false) {
		if ($sandbox) {
			$url = 'https://auth.sandbox.ebay.com/oauth2/authorize';
		} else {
			$url = 'https://auth.ebay.com/oauth2/authorize';
		}

		$url .= '?client_id=' . $app_id . '&redirect_uri=' . $ru_name . '&response_type=code&scope=' . urlencode('https://api.ebay.com/oauth/api_scope/sell.inventory') . ' ' . urlencode('https://api.ebay.com/oauth/api_scope/sell.account') . ' ' . urlencode('https://api.ebay.com/oauth/api_scope/sell.fulfillment') . '&prompt=login';
		header('location:' . $url); die();
	}
	
	public function getTokenByCode($code, $app_id, $cert_id, $ru_name, $sandbox = false) {
		$headers = array();
		$headers[] = 'Authorization: Basic ' . base64_encode($app_id . ':' . $cert_id);
		$headers[] = 'application/x-www-form-urlencoded';
		
		$post = 'grant_type=authorization_code&code=' . $code . '&redirect_uri=' . $ru_name;
		
		$json = $this->requestPOST($headers, 'identity', 'oauth2/token', $post, $sandbox);
		
		$res = json_decode($json, true);
		
		if (isset($res['access_token'])) {
			return $res;
		} else {
			return false;
		}
		
	}
	
	public function refreshToken($refresh_token, $app_id, $cert_id, $sandbox = false) {
		$headers = array();
		$headers[] = 'Authorization: Basic ' . base64_encode($app_id . ':' . $cert_id);
		$headers[] = 'application/x-www-form-urlencoded';
		
		$post = 'grant_type=refresh_token&refresh_token=' . $refresh_token . '&scope=' . urlencode('https://api.ebay.com/oauth/api_scope/sell.inventory') . ' ' . urlencode('https://api.ebay.com/oauth/api_scope/sell.account') . ' ' . urlencode('https://api.ebay.com/oauth/api_scope/sell.fulfillment');
		
		$json = $this->requestPOST($headers, 'identity', 'oauth2/token', $post, $sandbox);
		
		$res = json_decode($json, true);
		
		if (isset($res['access_token'])) {
			return $res;
		} else {
			return false;
		}
	}	
	
	private function getHeaders($token, $language, $marketplace_id)	{
		$headers = array (
			'Accept: application/json',
			'Authorization: Bearer ' . $token,
			'Content-Type: application/json',
			'Accept-Language: ' . $language,
			'Content-Language: ' . $language,
			'X-EBAY-C-MARKETPLACE-ID: ' . $marketplace_id,
		);

		return $headers;
	}
	
	// CATEGORIES
	public function getCategoryTree($token, $language, $marketplace_id, $id, $sandbox) {
		$json = $this->requestGET($this->getHeaders($token, $language, $marketplace_id), 'commerce/taxonomy', 'category_tree/' . $id, $sandbox);
		return json_decode($json, true);
	}
	
	public function getEbayCategoryToProductCategory($marketplace_id) {
		$query = $this->db->query("SELECT ebay_category_id, product_category_id FROM ebay_category_to_" . DB_PREFIX . "category WHERE marketplace_id = '" . $this->db->escape($marketplace_id) . "'");
		return array_column($query->rows, 'ebay_category_id', 'product_category_id');
	}
	
	// ERRORS
	public function getError($responce) {
		$error_msg = '';
		
		if(!isset($responce['errors'])) {
			return $error_msg;
		}
		
		foreach ($responce['errors'] as $error) {
			if ($error_msg !== '') {
				$error_msg .= '<br/>';
			}
			
			$error_msg .= $error['message'];
			
			if (!isset($error['parameters'])) {
				continue;
			}
			
			foreach ($error['parameters'] as $parameter) {
				$error_msg .= '<br/>' . $parameter['value'];
				break;
			}
			
			// Admin msg
			
			if ($this->user->getGroupId() != 1) {
				continue;
			}
			
			$parameters_msg = '';
			
			foreach ($error['parameters'] as $parameter) {
				$parameters_msg .= $parameter['name'] . ' - ' . $parameter['value'] . '<br/>';
			}
			
			$modal_id = rand(0, 9999999);
			
			$error_msg .=  ' ';
			$error_msg .=  '<a href="#" data-mdb-toggle="modal" data-mdb-target="#modal' . $modal_id . '"><i class="fas fa-info-circle"></i></a><div class="modal fade" id="modal' . $modal_id . '" tabindex="-1" aria-hidden="true"><div class="modal-dialog modal-fullscreen"><div class="modal-content"><div class="modal-header"><button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button></div><div class="modal-body">' . $parameters_msg . '</div></div></div></div>';
		}
		
		return $error_msg;
	}
	
	public function getWarning($responce) {
		$text = '';
		
		if(!isset($responce['warnings'])) {
			return $text;
		}
		
		foreach ($responce['warnings'] as $warning) {
			if ($text !== '') {
				$text .= '<br/>';
			}
			
			$text .= $warning['message'];
		}
		
		return $text;
	}
	
	// REQUESTS
	private function requestGET($headers, $api_name, $resource, $sandbox = false) {
		if ($sandbox) {
			$endpoint = 'https://api.sandbox.ebay.com/';
		} else {
			$endpoint = 'https://api.ebay.com/';
		}

		$url = $endpoint . $api_name . '/v1/' . $resource;

		$ch = curl_init($url);

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
		$res = curl_exec($ch);
		curl_close($ch);
		
		return $res;
	}
	
	private function requestDELETE($headers, $api_name, $resource, $sandbox = false) {
		if ($sandbox) {
			$endpoint = 'https://api.sandbox.ebay.com/';
		} else {
			$endpoint = 'https://api.ebay.com/';
		}

		$url = $endpoint . $api_name . '/v1/' . $resource;

		$ch = curl_init($url);

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        
		$res = curl_exec($ch);
		curl_close($ch);
		
		return $res;
	}
	
	private function requestPUT($headers, $api_name, $resource, $put, $sandbox = false) {
		if ($sandbox) {
			$endpoint = 'https://api.sandbox.ebay.com/';
		} else {
			$endpoint = 'https://api.ebay.com/';
		}

		$url = $endpoint . $api_name . '/v1/' . $resource;

		$ch = curl_init($url);

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $put);
		
		$res = curl_exec($ch);
		$info = curl_getinfo($ch);
		
		curl_close($ch);
		
		if ($info['http_code'] == 204) {
			return true;
		} else {
			return $res;
		}
	}
	
	private function requestPOST($headers, $api_name, $resource, $post, $sandbox = false) {
		if ($sandbox) {
			$endpoint = 'https://api.sandbox.ebay.com/';
		} else {
			$endpoint = 'https://api.ebay.com/';
		}

		$url = $endpoint . $api_name . '/v1/' . $resource;

		$ch = curl_init($url);

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
		$res = curl_exec($ch);
		curl_close($ch);
		
		return $res;
	}
	
}