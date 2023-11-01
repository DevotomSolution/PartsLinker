<?php
namespace Opencart\Catalog\Controller\Integration\Delivery;
class Dpdro extends \Opencart\System\Engine\Controller {
	private $error = array();
	
	public function index() {
		$this->load->model('integration/delivery/delivery');
		$this->load->model('integration/delivery/dpdro');
		
		$this->load->language('integration/dpd');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$storage = $this->model_integration_delivery_delivery->getStorage($this->user->getId(), 'dpdro');
		
		if ($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validateSettingForm()) {
			$storage = $this->request->post;
			
			$this->model_integration_delivery_delivery->editStorage($this->user->getId(), 'dpdro', $storage);
			
			if ($this->model_integration_delivery_dpdro->connect($this->user->getId(), true)) {
				$this->session->data['success'] = $this->language->get('text_success');
			} else {
				$this->session->data['error'] = $this->language->get('error_connect');
			}
		}
		
		if(isset($this->session->data['error'])) {
			$data['error_warning'] = $this->session->data['error'];

			unset($this->session->data['error']);
		} elseif(isset($this->error['warning'])) {
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
		
		if(isset($this->request->post['username'])) {
			$data['username'] = $this->request->post['username'];
		} elseif(isset($storage['username'])) {
			$data['username'] = $storage['username'];
		} else {
			$data['username'] = '';
		}
		
		if(isset($this->request->post['password'])) {
			$data['password'] = $this->request->post['password'];
		} elseif(isset($storage['password'])) {
			$data['password'] = $storage['password'];
		} else {
			$data['password'] = '';
		}
		
		$data['action'] = $this->url->link('integration/delivery/dpdro', 'user_token=' . $this->session->data['user_token'], true);
		
		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['navigation'] = $this->load->controller('common/navigation');
		
		$this->response->setOutput($this->load->view('integration/dpd', $data));
	}
	
	private function validateSettingForm() {
		if(empty($this->request->post['username'])) {
			$this->error['warning'] = $this->language->get('error_username');
		}
		
		if(empty($this->request->post['password'])) {
			$this->error['warning'] = $this->language->get('error_password');
		}
		
		return !$this->error;
	}
	
	public function waybill() {
		$this->load->model('integration/delivery/dpdro');
		
		$connect = $this->model_integration_delivery_dpdro->connect($this->user->getId());
		
		if (!$connect) {
			$this->session->data['error'] = $this->language->get('error_connect');
			$this->response->redirect($this->url->link('integration/delivery/dpdro', 'user_token=' . $this->session->data['user_token'], true));
		}
		
		$this->load->model('sale/order');
		$this->load->model('localisation/country');
		
		$this->load->language('integration/dpd');

		$this->document->setTitle($this->language->get('heading_title'));
		
		if (!empty($this->request->get['order_id'])) {
			$order_id = $this->request->get['order_id'];
		} else {
			$order_id = 0;
		}
		
		$order_info = $this->model_sale_order->getOrder($this->user->getId(), $order_id);
		
		if (!$order_info) {
			return new \Opencart\System\Engine\Action('error/not_found');
		}
		
		$url = '';
		
		$url .= '&user_token=' . $this->session->data['user_token'];
		
		if (isset($this->request->get['order_id'])) {
			$url .= '&order_id=' . $this->request->get['order_id'];
		}

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
		
		if ($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validateWaybillForm()) {
			$post = array();
			
			$post['recipient']['phone1']['number'] = $this->request->post['phone1'];
			
			if (!empty($this->request->post['phone2'])) {
				$post['recipient']['phone2']['number'] = $this->request->post['phone2'];
			}
			
			$post['recipient']['clientName'] = $this->request->post['name'];
			
			if (!empty($this->request->post['contact'])) {
				$post['recipient']['contactName'] = $this->request->post['contact'];
			}
			
			if (!empty($this->request->post['email'])) {
				$post['recipient']['email'] = $this->request->post['email'];
			}
			
			if (!empty($this->request->post['private'])) {
				$post['recipient']['privatePerson'] = true;
			}
			
			$post['recipient']['address']['countryId'] = $this->request->post['country_id'];
			
			if (!empty($this->request->post['postcode'])) {
				$post['recipient']['address']['postCode'] = $this->request->post['postcode'];
			}
			
			if (!empty($this->request->post['state_id'])) {
				$post['recipient']['address']['stateId'] = $this->request->post['state_id'];
			}
			
			if (!empty($this->request->post['site_id'])) {
				$post['recipient']['address']['siteId'] = $this->request->post['site_id'];
			} else {
				$post['recipient']['address']['siteName'] = $this->request->post['site_name'];
			}
			
			if (!empty($this->request->post['street_id'])) {
				$post['recipient']['address']['streetId'] = $this->request->post['street_id'];
			} else {
				$post['recipient']['address']['streetName'] = $this->request->post['street_name'];
			}
			
			if (!empty($this->request->post['street_no'])) {
				$post['recipient']['address']['streetNo'] = $this->request->post['street_no'];
			}
			
			if (!empty($this->request->post['address_note'])) {
				$post['recipient']['address']['addressNote'] = $this->request->post['address_note'];
			}
			
			if (!empty($this->request->post['address1'])) {
				$post['recipient']['address']['addressLine1'] = $this->request->post['address1'];
			}
			
			if (!empty($this->request->post['address2'])) {
				$post['recipient']['address']['addressLine2'] = $this->request->post['address2'];
			}
			
			if (!empty($this->request->post['pickup_date'])) {
				$post['service']['pickupDate'] = $this->request->post['pickup_date'];
			}
			
			$post['service']['serviceId'] = $this->request->post['service_id'];
			
			if (!empty($this->request->post['cod'])) {
				$post['service']['additionalServices']['cod']['amount'] = $this->currency->convert((float) $this->request->post['cod'], $this->user->get('currency'), 'RON');
				$post['service']['additionalServices']['cod']['currencyCode'] = 'RON';
			}
			
			$post['content']['parcelsCount'] = $this->request->post['parcels_count'];
			
			$post['content']['totalWeight'] = $this->request->post['total_weight'];
			
			$post['content']['contents'] = $this->request->post['contents'];
			
			$post['content']['package'] = $this->request->post['package'];
			
			if ($this->request->post['service_payer'] === 'SENDER') {
				$post['payment']['courierServicePayer'] = 'SENDER';
			} elseif ($this->request->post['service_payer'] === 'RECIPIENT') {
				$post['payment']['courierServicePayer'] = 'RECIPIENT';
			} else {
				$post['payment']['courierServicePayer'] = 'THIRD_PARTY';
				$post['payment']['thirdPartyClientId'] = $this->request->post['service_payer'];
			}
			
			$post['shipmentNote'] = $this->request->post['note'];
			
			$result = $this->model_integration_delivery_dpdro->createShipment($post);
			
			if (isset($result['id']) and isset($result['price'])) {
				$this->model_sale_order->editTracking($this->user->getId(), $order_id, 'dpdro', $result['id']);
				
				$this->session->data['alerts'] = array(
					array(
						'title' => $this->language->get('heading_title'),
						'alert' => $this->language->get('text_success'),
						'type' => 'success',
					),
				);
				
				$this->response->redirect($this->url->link('sale/order.info', $url, true));
			}
			
			if (isset($result['error']) and isset($result['error']['message'])) {
				$this->error['warning'] = $result['error']['message'];
			}
		}
		
		if(isset($this->session->data['error'])) {
			$data['error_warning'] = $this->session->data['error'];

			unset($this->session->data['error']);
		} elseif(isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		for($i = 0; $i < 7; $i++) {
			$data['pickup_dates'][] = date("Y-m-d", time() + (3600 * 24 * $i));
		}
		
		$data['services'] = $this->model_integration_delivery_dpdro->getServices();
		
		$data['services_json'] = json_encode($data['services']);
		
		$data['clients'] = $this->model_integration_delivery_dpdro->getContractClients();

		if (isset($this->request->post['phone1'])) {
			$data['phone1'] = $this->request->post['phone1'];
		} else {
			$data['phone1'] = $order_info['telephone'];
		}
		
		if (isset($this->request->post['phone2'])) {
			$data['phone2'] = $this->request->post['phone2'];
		} else {
			$data['phone2'] = '';
		}
		
		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} else {
			$data['name'] = $order_info['fullname'];
		}
		
		if (isset($this->request->post['email'])) {
			$data['email'] = $this->request->post['email'];
		} else {
			$data['email'] = $order_info['email'];
		}
		
		if (isset($this->request->post['country_name'])) {
			$data['country_name'] = $this->request->post['country_name'];
		} else {
			$data['country_name'] = '';
		}
		
		if (isset($this->request->post['country_id'])) {
			$data['country_id'] = $this->request->post['country_id'];
		} else {
			$data['country_id'] = '';
		}
		
		if (isset($this->request->post['address_type'])) {
			$data['address_type'] = $this->request->post['address_type'];
		} else {
			$data['address_type'] = '';
		}
		
		if (isset($this->request->post['site_id'])) {
			$data['site_id'] = $this->request->post['site_id'];
		} else {
			$data['site_id'] = '';
		}
		
		if (isset($this->request->post['site_name'])) {
			$data['site_name'] = $this->request->post['site_name'];
		} else {
			$data['site_name'] = '';
		}
		
		if (isset($this->request->post['site_nomen'])) {
			$data['site_nomen'] = $this->request->post['site_nomen'];
		} else {
			$data['site_nomen'] = 0;
		}
		
		if (isset($this->request->post['postcode'])) {
			$data['postcode'] = $this->request->post['postcode'];
		} else {
			$data['postcode'] = $order_info['shipping_postcode'];
		}
		
		if ($data['country_name'] == '' and $order_info['shipping_country']) {
			$countries = $this->model_integration_delivery_dpdro->getCountries($order_info['shipping_country']);
			
			if (is_array($countries) and count($countries) == 1) {
				$data['country_id'] = $countries[0]['id'];
				$data['country_name'] = $countries[0]['nameEn'];
				$data['address_type'] = $countries[0]['addressType'];
				$data['site_nomen'] = $countries[0]['siteNomen'];
				
				if ($countries[0]['siteNomen'] == 0) {
					$data['site_name'] = $order_info['shipping_city'];
				} elseif ($countries[0]['siteNomen'] == 1) {
					$sites = $this->model_integration_delivery_dpdro->getSites($countries[0]['id'], $order_info['shipping_city']);
					
					if (is_array($sites) and count($sites) == 1) {
						$data['site_id'] = $sites[0]['id'];
						$data['site_name'] = $sites[0]['nameEn'];
						$data['postcode'] = $sites[0]['postCode'];
					} elseif(is_array($sites) and count($sites) > 1) {
						foreach ($sites as $site) {
							if (strtolower($order_info['shipping_zone']) === strtolower($site['region']) or strtolower($order_info['shipping_zone']) === strtolower($site['regionEn'])) {
								$data['site_id'] = $site['id'];
								$data['site_name'] = $site['nameEn'];
								$data['postcode'] = $site['postCode'];
								
								break;
							}
						}
					}
				}
			}
		}
		
		if (isset($this->request->post['state_name'])) {
			$data['state_name'] = $this->request->post['state_name'];
		} else {
			$data['state_name'] = '';
		}
		
		if (isset($this->request->post['state_id'])) {
			$data['state_id'] = $this->request->post['state_id'];
		} else {
			$data['state_id'] = '';
		}
		
		if (isset($this->request->post['address1'])) {
			$data['address1'] = $this->request->post['address1'];
		} else {
			$data['address1'] = $order_info['shipping_address_1'];
		}
		
		if (isset($this->request->post['address2'])) {
			$data['address2'] = $this->request->post['address2'];
		} else {
			$data['address2'] = $order_info['shipping_address_2'];
		}
		
		if (isset($this->request->post['street_name'])) {
			$data['street_name'] = $this->request->post['street_name'];
		} else {
			$data['street_name'] = preg_replace('/\s[0-9]{1}.*$/', '', $order_info['shipping_address_1']);
		}
		
		if (isset($this->request->post['street_id'])) {
			$data['street_id'] = $this->request->post['street_id'];
		} else {
			$data['street_id'] = '';
		}
		
		if (isset($this->request->post['street_no'])) {
			$data['street_no'] = $this->request->post['street_no'];
		} else {
			preg_match('/\s[0-9]{1}.*$/', $order_info['shipping_address_1'], $matches);

			if (isset($matches[0])) {
				$data['street_no'] = $matches[0];
			} else {
				$data['street_no'] = '';
			}
		}
		
		if (isset($this->request->post['address_note'])) {
			$data['address_note'] = $this->request->post['address_note'];
		} else {
			$data['address_note'] = '';
		}
		
		if (isset($this->request->post['pickup_date'])) {
			$data['pickup_date'] = $this->request->post['pickup_date'];
		} else {
			$data['pickup_date'] = '';
		}
		
		if (isset($this->request->post['service_id'])) {
			$data['service_id'] = $this->request->post['service_id'];
		} else {
			$data['service_id'] = '2505';
		}
		
		if (isset($this->request->post['cod'])) {
			$data['cod'] = $this->request->post['cod'];
		} else {
			$data['cod'] = round($this->currency->convert($order_info['total'], $order_info['currency_code'], $this->user->get('currency')), 2);
		}
		
		if (isset($this->request->post['service_payer'])) {
			$data['service_payer'] = $this->request->post['service_payer'];
		} else {
			$data['service_payer'] = '';
		}
		
		if (isset($this->request->post['contents'])) {
			$data['contents'] = $this->request->post['contents'];
		} else {
			$data['contents'] = 'AUTO PARTS';
		}
		
		if (isset($this->request->post['package'])) {
			$data['package'] = $this->request->post['package'];
		} else {
			$data['package'] = 'BOX';
		}
		
		if (isset($this->request->post['parcels_count'])) {
			$data['parcels_count'] = $this->request->post['parcels_count'];
		} else {
			$data['parcels_count'] = 1;
		}
		
		if (isset($this->request->post['total_weight'])) {
			$data['total_weight'] = $this->request->post['total_weight'];
		} else {
			$data['total_weight'] = 0;
			
			$order_products = $this->model_sale_order->getOrderProducts($this->user->getId(), $order_id);

			foreach ($order_products as $product) {
				$data['total_weight'] += (float) $product['weight'];
			}
		}
		
		$data['user_token'] = $this->session->data['user_token'];
		
		$data['action'] = $this->url->link('integration/delivery/dpdro.waybill', $url, true);

		$data['cancel'] = $this->url->link('sale/order.info', $url, true);
		
		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['navigation'] = $this->load->controller('common/navigation');
		
		$this->response->setOutput($this->load->view('integration/dpd_wb_form', $data));
	}
	
	private function validateWaybillForm() {
		$post = array();
		
		if (empty($this->request->post['phone1'])) {
			$this->error['warning'] = $this->language->get('error_phone1');
		}
		
		if (empty($this->request->post['name']) or oc_strlen($this->request->post['name']) < 3 or oc_strlen($this->request->post['name']) > 60) {
			$this->error['warning'] = $this->language->get('error_name');
		}
		
		if (empty($this->request->post['country_id'])) {
			$this->error['warning'] = $this->language->get('error_country');
		}
		
		if (empty($this->request->post['site_name']) or oc_strlen($this->request->post['site_name']) > 50) {
			$this->error['warning'] = $this->language->get('error_site');
		}
		
		if (!isset($this->request->post['address_type'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		} else {
			if ($this->request->post['address_type'] == 1) {
				if (empty($this->request->post['street_name']) or oc_strlen($this->request->post['street_name']) > 50) {
					$this->error['warning'] = $this->language->get('error_street');
				}
			}
		}
		
		if (empty($this->request->post['service_id'])) {
			$this->error['warning'] = $this->language->get('error_service');
		}
		
		if (empty($this->request->post['parcels_count'])) {
			$this->error['warning'] = $this->language->get('error_parcels_count');
		}
		
		if (!isset($this->request->post['total_weight']) or $this->request->post['total_weight'] <= 0) {
			$this->error['warning'] = $this->language->get('error_total_weight');
		}
		
		if (empty($this->request->post['contents'])) {
			$this->error['warning'] = $this->language->get('error_contents');
		}
		
		if (empty($this->request->post['package'])) {
			$this->error['warning'] = $this->language->get('error_package');
		}

		if (empty($this->request->post['service_payer'])) {
			$this->error['warning'] = $this->language->get('error_service_payer');
		}
		
		if (!isset($this->request->post['note'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}
		
		return !$this->error;
	}
	
	public function getCountries() {
		$json = array();
		
		if (!empty($this->request->get['search'])) {
			$this->load->model('integration/delivery/dpdro');
			
			$countries = $this->model_integration_delivery_dpdro->getCountries($this->request->get['search']);
			
			if ($countries) {
				$json['countries'] = $countries;
			}
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function getStates() {
		$json = array();
		
		if (!empty($this->request->get['search']) and !empty($this->request->get['country_id'])) {
			$this->load->model('integration/delivery/dpdro');
			
			$states = $this->model_integration_delivery_dpdro->getStates($this->request->get['country_id'], $this->request->get['search']);
			
			if ($states) {
				foreach ($states as $state) {
					$json['states'][] = array(
						'id' => $state['id'],
						'name' => $state['nameEn'],
					);
				}
			}
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function getSites() {
		$json = array();
		
		if (!empty($this->request->get['search']) and !empty($this->request->get['country_id'])) {
			$this->load->model('integration/delivery/dpdro');
			
			$sites = $this->model_integration_delivery_dpdro->getSites($this->request->get['country_id'], $this->request->get['search']);
			
			if ($sites) {
				foreach ($sites as $site) {
					$json['sites'][] = array(
						'id' => $site['id'],
						'name' => $site['typeEn'] . ' ' .  $site['nameEn'],
						'value' => $site['nameEn'],
					);
				}
			}
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function getStreets() {
		$json = array();
		
		if (!empty($this->request->get['search']) and !empty($this->request->get['site_id'])) {
			$this->load->model('integration/delivery/dpdro');
			
			$streets = $this->model_integration_delivery_dpdro->getStreets($this->request->get['site_id'], $this->request->get['search']);

			if ($streets) {
				foreach ($streets as $street) {
					$json['streets'][] = array(
						'id' => $street['id'],
						'name' => $street['typeEn'] . ' ' .  $street['nameEn'],
						'value' => $street['nameEn'],
					);
				}
			}
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function print () {
		if (isset($this->request->get['tracking'])) {
			$this->load->model('integration/delivery/dpdro');
			
			$result = $this->model_integration_delivery_dpdro->getLabel($this->request->get['tracking']);
			
			header('Content-type:application/pdf');
			
			echo $result;
		}
	}
}