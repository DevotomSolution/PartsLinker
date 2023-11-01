<?php
namespace Opencart\Catalog\Controller\Catalog;
class ImportExport extends \Opencart\System\Engine\Controller {
	private $error = array();
	private $separators_values = array('coma' => ',', 'coma_point' => ';', 'tab' => '	');
	
	public function index() {
		$this->load->model('catalog/import');
		
		$this->load->language('catalog/import_export');

		$this->document->setTitle($this->language->get('heading_title'));
		
		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}
		
		$last_import = $this->model_catalog_import->getLastImport($this->user->getId());

		if ($last_import) {
			if (file_exists(DIR_UPLOAD . 'importcsv' . $this->user->getId() . $last_import['csv_separator'] . '.csv')) {
				$import_csv_file = DIR_UPLOAD . 'importcsv' . $this->user->getId() . $last_import['csv_separator'] . '.csv';
			} else {
				$import_csv_file = false;
			}
			
			$import_csv_separator = $this->separators_values[$last_import['csv_separator']];
		} else {
			$import_csv_file = false;
			$import_csv_separator = false;
		}
		
		if ($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validate()) {
			if (file_exists($import_csv_file)) {
				unlink($import_csv_file);
			}
			
			move_uploaded_file($this->request->files['import_csv_list']['tmp_name'], DIR_UPLOAD . 'importcsv' . $this->user->getId() . $this->request->post['import_csv_separator'] . '.csv');

			$import_csv_file = DIR_UPLOAD . 'importcsv' . $this->user->getId() . $this->request->post['import_csv_separator'] . '.csv';
			$import_csv_separator = $this->separators_values[$this->request->post['import_csv_separator']];
			
			$history_data = array(
				'filename' => $this->request->files['import_csv_list']['name'],
				'csv_separator' => $this->request->post['import_csv_separator'],
			);
			
			$this->model_catalog_import->addImportHistory($this->user->getId(), $history_data);
		}
		
		if ($import_csv_file) {
			$f = fopen($import_csv_file, 'r');
			
			$data['import_csv_values'] = array();
			
			for ($i = 0; $i < 5; $i++) {
				$csv_string = fgetcsv($f, null, $import_csv_separator);
			
				foreach ($csv_string as $key => $csv_value) {
					$value = mb_substr($csv_value, 0, 240);
					
					if (mb_strlen($csv_value) > 240) {
						$value .= '...';
					}
					
					$data['import_csv_values'][$i][] = array(
						'key' => $key,
						'value' => htmlentities($value),
					);
				}
			}
			
			
			fclose($f);
			
			$data['import_total'] = 0;
			
			$f = fopen($import_csv_file, 'r');
			
			while(fgetcsv($f, null, $import_csv_separator)) {
				$data['import_total']++;
			}
			
			fclose($f);
		} else {
			$data['import_csv_values'] = array();
			$data['import_total'] = 0;
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		$this->load->model('localisation/currency');
		
		$data['currencies'] = $this->model_localisation_currency->getCurrencies();
		
		$data['action'] = $this->url->link('catalog/import_export', '&user_token=' . $this->session->data['user_token'], true);
		
		$data['user_token'] = $this->session->data['user_token'];
		
		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['navigation'] = $this->load->controller('common/navigation');
		
		$this->response->setOutput($this->load->view('catalog/import_export', $data));
	}
	
	protected function validate() {
		if (isset($this->request->files['import_csv_list']['size']) && $this->request->files['import_csv_list']['size'] > 0) {
			$content = file_get_contents($this->request->files['import_csv_list']['tmp_name']);

			if (preg_match('/\<\?php/i', $content)) {
				$this->error['warning'] = $this->language->get('error_warning');
			}
			
			if ($this->request->files['import_csv_list']['size'] > 50000000) {
				$this->error['warning'] = $this->language->get('error_file_size');
			}
			
			$mime = mime_content_type($this->request->files['import_csv_list']['tmp_name']);
			
			if ($mime !== 'text/plain' and $mime !== 'text/csv') {
				$this->error['warning'] = $this->language->get('error_file_type');
			}
		} else {
			$this->error['warning'] = $this->language->get('error_warning');
		}
		
		if (isset($this->request->post['import_csv_separator'])) {
			if (!isset($this->separators_values[$this->request->post['import_csv_separator']])) {
				$this->error['warning'] = $this->language->get('error_warning');
			}
		} else {
			$this->error['warning'] = $this->language->get('error_warning');
		}
		
		return !$this->error;
	}
	
	public function import() {
		$json = array(
			'total' => 0
		);
		
		if (isset($this->request->get['start'])) {
			$start = (int) $this->request->get['start'];
		} else {
			$start = 1;
		}
		
		if (isset($this->request->get['limit'])) {
			$limit = (int) $this->request->get['limit'];
		} else {
			$limit = 20;
		}
		
		if (isset($this->request->post['product_name'])) {
			$product_name = $this->request->post['product_name'];
		} else {
			$product_name = '';
		}
		
		if (isset($this->request->post['product_description'])) {
			$product_description = $this->request->post['product_description'];
		} else {
			$product_description = '';
		}
		
		if (isset($this->request->post['price'])) {
			$price = $this->request->post['price'];
		} else {
			$price = false;
		}
		
		if (isset($this->request->post['currency'])) {
			$currency = $this->request->post['currency'];
		} else {
			$currency = false;
		}
		
		if (isset($this->request->post['quantity'])) {
			$quantity = $this->request->post['quantity'];
		} else {
			$quantity = false;
		}
		
		if (isset($this->request->post['quality'])) {
			$quality = $this->request->post['quality'];
		} else {
			$quality = false;
		}
		
		if (isset($this->request->post['product_image'])) {
			$product_image = $this->request->post['product_image'];
		} else {
			$product_image = false;
		}
		
		if (isset($this->request->post['product_image_separator'])) {
			$product_image_separator = $this->request->post['product_image_separator'];
		} else {
			$product_image_separator = false;
		}
		
		if (isset($this->request->post['sku'])) {
			$sku = $this->request->post['sku'];
		} else {
			$sku = false;
		}
		
		if (isset($this->request->post['product_category'])) {
			$product_category = $this->request->post['product_category'];
		} else {
			$product_category = false;
		}
		
		if (isset($this->request->post['product_vehicle'])) {
			$product_vehicle = $this->request->post['product_vehicle'];
		} else {
			$product_vehicle = false;
		}
		
		if (isset($this->request->post['brand'])) {
			$brand = $this->request->post['brand'];
		} else {
			$brand = false;
		}
		
		if (isset($this->request->post['mpn'])) {
			$mpn = $this->request->post['mpn'];
		} else {
			$mpn = false;
		}
		
		if (isset($this->request->post['oe'])) {
			$oe = $this->request->post['oe'];
		} else {
			$oe = false;
		}
		
		if (isset($this->request->post['others'])) {
			$others = $this->request->post['others'];
		} else {
			$others = false;
		}
		
		if (isset($this->request->post['weight'])) {
			$weight = $this->request->post['weight'];
		} else {
			$weight = false;
		}
		
		$this->load->model('catalog/import');
		
		$last_import = $this->model_catalog_import->getLastImport($this->user->getId());

		if ($last_import) {
			if (file_exists(DIR_UPLOAD . 'importcsv' . $this->user->getId() . $last_import['csv_separator'] . '.csv')) {
				$import_csv_file = DIR_UPLOAD . 'importcsv' . $this->user->getId() . $last_import['csv_separator'] . '.csv';
			} else {
				$import_csv_file = false;
			}
			
			$import_csv_separator = $this->separators_values[$last_import['csv_separator']];
		} else {
			$import_csv_file = false;
			$import_csv_separator = false;
		}

		if ($import_csv_file) {
			$this->load->model('catalog/product');
			$this->load->model('catalog/category');
			$this->load->model('catalog/vehicle');
			$this->load->model('localisation/language');
			$this->load->model('integration/onlineshop/onlineshop');
		
			$onlineshops = $this->model_integration_onlineshop_onlineshop->getOnlineshops();
		
			$languages = $this->model_localisation_language->getLanguages();
			
			$allowed_tags = array('<p', '</p>', '<ul', '</ul>', '<li', '</li>', '<br', '<b', '</b>', '<i', '</i>', '<span', '</span>', '<div', '</div>');
			
			$f = fopen($import_csv_file, 'r');
			
			$i = 1;
			
			$uploaded = 0;
			$updated = 0;
			$ignored = 0;
			
			while($csvstring = fgetcsv($f, null, $import_csv_separator)) {
				if ($i < $start) {
					$i++;
					continue;
				}
				
				if ($i >= $start + $limit) {
					break;
				}
				
				$i++;
				
				$product_data = array();
				
				foreach ($languages as $language) {
					if (isset($csvstring[$product_name])) {
						$product_data['product_description'][$language['language_id']]['name'] = $csvstring[$product_name];
					} else {
						continue;
					}
					
					if (isset($csvstring[$product_description]) and !preg_match('/\<(.*?)\>/', str_replace($allowed_tags, '', html_entity_decode($csvstring[$product_description])))) {
						$product_data['product_description'][$language['language_id']]['description'] = $csvstring[$product_description];
						$product_data['product_description'][$language['language_id']]['note'] = $csvstring[$product_description];
					} else {
						$product_data['product_description'][$language['language_id']]['description'] = '';
						$product_data['product_description'][$language['language_id']]['note'] = '';
					}
				}
				
				if ($currency !== false and isset($csvstring[$currency]) and $this->currency->has($csvstring[$currency])) {
					$product_currency = $csvstring[$currency];
				} elseif ($currency !== false and $this->currency->has($currency)) {
					$product_currency = $currency;
				} else {
					$ignored++;
					continue;
				}
				
				if ($price !== false and isset($csvstring[$price])) {
					$product_data['price'] = round($this->currency->convert((float) $csvstring[$price], $product_currency, '0'), 2);
				} else {
					$ignored++;
					continue;
				}
				
				if ($quantity !== false and isset($csvstring[$quantity])) {
					$product_data['quantity'] = (int) $csvstring[$quantity];
				} else {
					$ignored++;
					continue;
				}
				
				if ($quality !== false and isset($csvstring[$quality])) {
					if (strtolower($csvstring[$quality]) === 'used') {
						$product_data['used'] = 1;
					} else {
						$product_data['used'] = 0;
					}
				} elseif ($quality !== false) {
					if (strtolower($quality) === 'used') {
						$product_data['used'] = 1;
					} else {
						$product_data['used'] = 0;
					}
				} else {
					$ignored++;
					continue;
				}
				
				if ($product_image !== false and isset($csvstring[$product_image]) and $product_image_separator !== false) {
					$images = explode($product_image_separator, $csvstring[$product_image]);
					
					for($j = 0; $j < 8; $j++) {
						if (isset($images[$j])) {
							$path_info = pathinfo($images[$j]);
							$type = $path_info['extension'];
							
							$allowed_types = array('jpg', 'jpeg', 'png', 'webp', 'gif');
							
							if (!in_array($type, $allowed_types)) {
								continue;
							}
							
							
							$curl = curl_init($images[$j]);
							
							curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
							curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
							
							curl_exec($curl);
							
							$size = curl_getinfo($curl, CURLINFO_SIZE_DOWNLOAD);
							
							$http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
							
							$res = curl_exec($curl);
							
							curl_close($curl);
							
							if ($http_code != 200 or $size > 50000000) {
								continue;
							}
							
							$local = DIR_IMAGE_PRODUCT_NAME . time() . rand(10, 90) . $j . $this->user->getId() . '.' . $type;

							$tmpfile = tmpfile();
							
							$tmpfile_path = stream_get_meta_data($tmpfile)['uri'];
							
							fwrite($tmpfile, $res);
							
							list($width_orig, $height_orig, $image_type) = getimagesize($tmpfile_path);
		
							$image = new \Opencart\System\Library\Image($tmpfile_path);
							
							if (MAX_IMAGE_WIDTH < $width_orig or MAX_IMAGE_HEIGHT < $height_orig) {
								$scale_width = $width_orig / MAX_IMAGE_WIDTH;
								$scale_height = $height_orig / MAX_IMAGE_HEIGHT;
								
								if ($scale_width > $scale_height) {
									$scale = $scale_width;
								} else {
									$scale = $scale_height;
								}
								
								$image->resize(round(MAX_IMAGE_WIDTH / $scale), round(MAX_IMAGE_HEIGHT / $scale));
							}
							
							$image->save(DIR_IMAGE . $local);
							
							unset($image);
							
							fclose($tmpfile);
		
							$product_data['product_image'][] = $local;
						} else {
							break;
						}
					}
				} else {
					$ignored++;
					continue;
				}
				
				if ($product_category !== false and isset($csvstring[$product_category])) {
					$category_id = $this->model_catalog_category->getCategoryByText($this->user->getId(), $csvstring[$product_category]);
					
					if ($category_id) {
						$product_data['product_category'] = $category_id;
					}
				}
				
				if ($product_vehicle !== false and isset($csvstring[$product_vehicle])) {
					$vehicles = $this->model_catalog_vehicle->getVehiclesByText($csvstring[$product_vehicle]);
					
					foreach ($vehicles as $vehicle) {
						$product_data['product_vehicle'][] = $vehicle['vehicle_id'];
					}
				}
				
				if ($brand !== false and isset($csvstring[$brand])) {
					$product_data['brand'] = $csvstring[$brand];
				} else {
					$product_data['brand'] = '';
				}
				
				if ($mpn !== false and isset($csvstring[$mpn])) {
					$product_data['mpn'] = $csvstring[$mpn];
				} else {
					$product_data['mpn'] = '';
				}
				
				if ($oe !== false and isset($csvstring[$oe])) {
					$product_data['oe'] = $csvstring[$oe];
				} else {
					$product_data['oe'] = '';
				}
				
				if ($others !== false and isset($csvstring[$others])) {
					$product_data['others'] = $csvstring[$others];
				} else {
					$product_data['others'] = '';
				}
				
				if ($weight !== false and isset($csvstring[$weight])) {
					$product_data['weight'] = (float) $csvstring[$weight];
				} else {
					$product_data['weight'] = '';
				}
				
				$product_data['name_product'] = '';
				
				$product_data['ean'] = '';
				
				$product_data['location'] = '';
				
				$product_data['weight'] = '';
				
				$product_data['vehicle_position_id'] = 0;
				
				foreach($onlineshops as $onlineshop) {
					$product_data[$onlineshop['code']] = 1;
				}
				
				if ($sku !== false and isset($csvstring[$sku])) {
					if (preg_match('/^[a-zA-Z0-9]{3,10}$/', $csvstring[$sku])) {
						$product_data['sku'] = $csvstring[$sku];
						
						$product_id = $this->model_catalog_product->getProductIdBySku($this->user->getId(), $csvstring[$sku]);
		
						if ($product_id) {
							$this->model_catalog_product->editProduct($this->user->getId(), $csvstring[$sku], $product_data, 'market');
							$updated++;
						} else {
							$this->model_catalog_product->addProduct($this->user->getId(), $product_data, 'market');
							$uploaded++;
						}
					} else {
						$ignored++;
						continue;
					}
				} else {
					$product_data['sku'] = $this->model_catalog_product->getNewSku($this->user->getId());
				
					if (!$product_data['sku']) {
						break;
					}
					
					$this->model_catalog_product->addProduct($this->user->getId(), $product_data, 'market');
					$uploaded++;
				}
			}
			
			$json['total'] = $updated + $uploaded + $ignored;
			
			$next_csvstring = fgetcsv($f, null, $import_csv_separator);
			
			fclose($f);
			
			if (!$next_csvstring) {
				unlink($import_csv_file);
				
				$this->load->language('catalog/import_export');
				
				$this->session->data['success'] = $this->language->get('text_import_success');
			}
			
			$this->model_catalog_import->updateImportHistory($last_import['user_import_history_id'], $uploaded, $updated, $ignored);
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function checkCurrency() {
		$json = array(
			'success' => 0
		);
		
		if (isset($this->request->get['currency'])) {
			$currency = $this->request->get['currency'];
		} else {
			$currency = false;
		}
		
		$this->load->model('catalog/import');
		
		$last_import = $this->model_catalog_import->getLastImport($this->user->getId());

		if ($last_import) {
			if (file_exists(DIR_UPLOAD . 'importcsv' . $this->user->getId() . $last_import['csv_separator'] . '.csv')) {
				$import_csv_file = DIR_UPLOAD . 'importcsv' . $this->user->getId() . $last_import['csv_separator'] . '.csv';
			} else {
				$import_csv_file = false;
			}
			
			$import_csv_separator = $this->separators_values[$last_import['csv_separator']];
		} else {
			$import_csv_file = false;
			$import_csv_separator = false;
		}

		if ($import_csv_file and $currency !== false) {
			$f = fopen($import_csv_file, 'r');
			
			$first_csvstring = fgetcsv($f, null, $import_csv_separator);
			
			$i = 0;
			
			while($csvstring = fgetcsv($f, null, $import_csv_separator)) {
				if ($i > 3) {
					break;
				}
				
				if (isset($csvstring[$currency]) and $this->currency->has($csvstring[$currency])) {
					$json['success'] = 1;
				} elseif ($this->currency->has($currency)) {
					$json['success'] = 1;
				} else {
					$json['success'] = 0;
					break;
				}
				
				$i++;
			}
			
			fclose($f);
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function checkSku() {
		$json = array(
			'success' => 0
		);
		
		if (isset($this->request->get['sku'])) {
			$sku = $this->request->get['sku'];
		} else {
			$sku = false;
		}
		
		$this->load->model('catalog/import');
		
		$last_import = $this->model_catalog_import->getLastImport($this->user->getId());

		if ($last_import) {
			if (file_exists(DIR_UPLOAD . 'importcsv' . $this->user->getId() . $last_import['csv_separator'] . '.csv')) {
				$import_csv_file = DIR_UPLOAD . 'importcsv' . $this->user->getId() . $last_import['csv_separator'] . '.csv';
			} else {
				$import_csv_file = false;
			}
			
			$import_csv_separator = $this->separators_values[$last_import['csv_separator']];
		} else {
			$import_csv_file = false;
			$import_csv_separator = false;
		}

		if ($import_csv_file and $sku !== false) {
			$f = fopen($import_csv_file, 'r');
			
			$first_csvstring = fgetcsv($f, null, $import_csv_separator);
			
			$i = 0;
			
			while($csvstring = fgetcsv($f, null, $import_csv_separator)) {
				if ($i > 3) {
					break;
				}
				
				if (isset($csvstring[$sku]) and preg_match('/^[a-zA-Z0-9]{3,10}$/', $csvstring[$sku])) {
					$json['success'] = 1;
				} else {
					$json['success'] = 0;
					break;
				}
				
				$i++;
			}
			
			fclose($f);
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function checkProductDescription() {
		$json = array(
			'success' => 0
		);
		
		if (isset($this->request->get['product_description'])) {
			$product_description = $this->request->get['product_description'];
		} else {
			$product_description = false;
		}
		
		$this->load->model('catalog/import');
		
		$last_import = $this->model_catalog_import->getLastImport($this->user->getId());

		if ($last_import) {
			if (file_exists(DIR_UPLOAD . 'importcsv' . $this->user->getId() . $last_import['csv_separator'] . '.csv')) {
				$import_csv_file = DIR_UPLOAD . 'importcsv' . $this->user->getId() . $last_import['csv_separator'] . '.csv';
			} else {
				$import_csv_file = false;
			}
			
			$import_csv_separator = $this->separators_values[$last_import['csv_separator']];
		} else {
			$import_csv_file = false;
			$import_csv_separator = false;
		}

		if ($import_csv_file and $product_description !== false) {
			$f = fopen($import_csv_file, 'r');
			
			$first_csvstring = fgetcsv($f, null, $import_csv_separator);
			
			$allowed_tags = array('<p', '</p>', '<ul', '</ul>', '<li', '</li>', '<br', '<b', '</b>', '<i', '</i>', '<span', '</span>', '<div', '</div>');
			
			$i = 0;
			
			while($csvstring = fgetcsv($f, null, $import_csv_separator)) {
				if ($i > 3) {
					break;
				}
			
				if (preg_match('/\<(.*?)\>/', str_replace($allowed_tags, '', html_entity_decode($csvstring[$product_description])))) {
					$json['success'] = 0;
					break;
				} else {
					$json['success'] = 1;
				}
				
				$i++;
			}
			
			fclose($f);
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function checkQuality() {
		$json = array(
			'success' => 0
		);
		
		if (isset($this->request->get['quality'])) {
			$quality = $this->request->get['quality'];
		} else {
			$quality = false;
		}
		
		$this->load->model('catalog/import');
		
		$last_import = $this->model_catalog_import->getLastImport($this->user->getId());

		if ($last_import) {
			if (file_exists(DIR_UPLOAD . 'importcsv' . $this->user->getId() . $last_import['csv_separator'] . '.csv')) {
				$import_csv_file = DIR_UPLOAD . 'importcsv' . $this->user->getId() . $last_import['csv_separator'] . '.csv';
			} else {
				$import_csv_file = false;
			}
			
			$import_csv_separator = $this->separators_values[$last_import['csv_separator']];
		} else {
			$import_csv_file = false;
			$import_csv_separator = false;
		}

		if ($import_csv_file and $quality !== false) {
			$f = fopen($import_csv_file, 'r');
			
			$first_csvstring = fgetcsv($f, null, $import_csv_separator);
			
			$i = 0;
			
			while($csvstring = fgetcsv($f, null, $import_csv_separator)) {
				if ($i > 3) {
					break;
				}
				
				if (isset($csvstring[$quality]) and (strtolower($csvstring[$quality]) === 'used' or strtolower($csvstring[$quality]) === 'new')) {
					$json['success'] = 1;
				} elseif (strtolower($quality) === 'used' or strtolower($quality) === 'new') {
					$json['success'] = 1;
				} else {
					$json['success'] = 0;
					break;
				}
				
				$i++;
			}
			
			fclose($f);
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function checkProductImage() {
		$json = array(
			'success' => 0
		);
		
		if (isset($this->request->post['product_image'])) {
			$product_image = $this->request->post['product_image'];
		} else {
			$product_image = false;
		}
		
		if (isset($this->request->post['product_image_separator'])) {
			$product_image_separator = $this->request->post['product_image_separator'];
		} else {
			$product_image_separator = false;
		}
		
		$this->load->model('catalog/import');
		
		$last_import = $this->model_catalog_import->getLastImport($this->user->getId());

		if ($last_import) {
			if (file_exists(DIR_UPLOAD . 'importcsv' . $this->user->getId() . $last_import['csv_separator'] . '.csv')) {
				$import_csv_file = DIR_UPLOAD . 'importcsv' . $this->user->getId() . $last_import['csv_separator'] . '.csv';
			} else {
				$import_csv_file = false;
			}
			
			$import_csv_separator = $this->separators_values[$last_import['csv_separator']];
		} else {
			$import_csv_file = false;
			$import_csv_separator = false;
		}

		if ($import_csv_file and $product_image !== false and $product_image_separator !== false) {
			$f = fopen($import_csv_file, 'r');
			
			$first_csvstring = fgetcsv($f, null, $import_csv_separator);
			
			$i = 0;
			
			while($csvstring = fgetcsv($f, null, $import_csv_separator)) {
				if ($i > 3) {
					break;
				}
				
				if (isset($csvstring[$product_image])) {
					$images = explode($product_image_separator, $csvstring[$product_image]);
					
					for($j = 0; $j < 8; $j++) {						
						if (isset($images[$j])) {
							$path_info = pathinfo($images[$j]);
							$type = $path_info['extension'];

							$allowed_types = array('jpg', 'jpeg', 'png', 'webp', 'gif');
							
							if (!in_array($type, $allowed_types)) {
								continue;
							}
							
							$curl = curl_init($images[$j]);
							
							curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
							curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
							
							curl_exec($curl);
							
							$http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
							
							curl_close($curl);
							
							if($http_code == 200) {
								$json['success'] = 1;
								break 2;
							}
						} else {
							break;
						}
					}
				} else {
					break;
				}
				
				$i++;
			}
			
			fclose($f);
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function importHistory() {
		$this->load->model('catalog/import');
		
		$this->load->language('catalog/import_export');

		$data['histories'] = array();

		$results = $this->model_catalog_import->getImportHistory($this->user->getId());

		foreach($results as $result) {
			$data['histories'][] = array(
				'filename'		=> $result['filename'],
				'date'			=> $result['date'],
				'result'		=> sprintf($this->language->get('text_history_result'), $result['uploaded'], $result['ignored'], $result['updated']),
			);
		}

		$this->response->setOutput($this->load->view('catalog/import_history', $data));
	}
	
	public function export() {
		$this->load->model('catalog/product');
		$this->load->model('catalog/category');
		
		if (!isset($this->request->get['separator'])) {
			die();
		}
		
		$this->load->language('catalog/import_export');
		
		switch ($this->request->get['separator']) {
			case 'coma_point':
				$separator = ';';
				break;
			case 'tab':
				$separator = '	';
				break;
			default:
				$separator = ',';
		}
		
		$products = $this->model_catalog_product->getProducts($this->user->getId());
		
		header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename="list.csv"');
		
		$str = '';
		
		if (isset($this->request->get['sku']) and $this->request->get['sku'] == 1) {
			$str .= '"' . $this->language->get('text_sku') . '"';
		}
			
		if (isset($this->request->get['product_name']) and $this->request->get['product_name'] == 1) {
			if ($str !== '') {
				$str .= $separator;
			}
			
			$str .= '"' . $this->language->get('text_product_name') . '"';
		}
		
		if (isset($this->request->get['product_description']) and $this->request->get['product_description'] == 1) {
			if ($str !== '') {
				$str .= $separator;
			}
			
			$str .= '"' . $this->language->get('text_product_description') . '"';
		}
		
		if (isset($this->request->get['price']) and $this->request->get['price'] == 1) {
			if ($str !== '') {
				$str .= $separator;
			}
			
			$str .= '"' . $this->language->get('text_price') . '"';
		}
		
		if (isset($this->request->get['currency']) and $this->request->get['currency'] == 1) {
			if ($str !== '') {
				$str .= $separator;
			}
			
			$str .= '"' . $this->language->get('text_currency') . '"';
		}
		
		if (isset($this->request->get['quantity']) and $this->request->get['quantity'] == 1) {
			if ($str !== '') {
				$str .= $separator;
			}
			
			$str .= '"' . $this->language->get('text_quantity') . '"';
		}
		
		if (isset($this->request->get['quality']) and $this->request->get['quality'] == 1) {
			if ($str !== '') {
				$str .= $separator;
			}
			
			$str .= '"' . $this->language->get('text_quality') . '"';
		}
		
		if (isset($this->request->get['product_image']) and $this->request->get['product_image'] == 1) {
			if ($str !== '') {
				$str .= $separator;
			}
			
			$str .= '"' . $this->language->get('text_product_image') . '"';
		}
		
		if (isset($this->request->get['product_category']) and $this->request->get['product_category'] == 1) {
			if ($str !== '') {
				$str .= $separator;
			}
			
			$str .= '"' . $this->language->get('text_product_category') . '"';
		}
		
		if (isset($this->request->get['product_vehicle']) and $this->request->get['product_vehicle'] == 1) {
			if ($str !== '') {
				$str .= $separator;
			}
			
			$str .= '"' . $this->language->get('text_product_vehicle') . '"';
		}
		
		if (isset($this->request->get['brand']) and $this->request->get['brand'] == 1) {
			if ($str !== '') {
				$str .= $separator;
			}
			
			$str .= '"' . $this->language->get('text_brand') . '"';
		}
		
		if (isset($this->request->get['mpn']) and $this->request->get['mpn'] == 1) {
			if ($str !== '') {
				$str .= $separator;
			}
			
			$str .= '"' . $this->language->get('text_mpn') . '"';
		}
		
		if (isset($this->request->get['oe']) and $this->request->get['oe'] == 1) {
			if ($str !== '') {
				$str .= $separator;
			}
			
			$str .= '"' . $this->language->get('text_oe') . '"';
		}
		
		if (isset($this->request->get['others']) and $this->request->get['others'] == 1) {
			if ($str !== '') {
				$str .= $separator;
			}
			
			$str .= '"' . $this->language->get('text_others') . '"';
		}
		
		if (isset($this->request->get['weight']) and $this->request->get['weight'] == 1) {
			if ($str !== '') {
				$str .= $separator;
			}
			
			$str .= '"' . $this->language->get('text_weight') . '"';
		}
		
		$str .= "\n";
		
		echo $str;

		foreach($products as $product) {
			$str = '';
			
			if (isset($this->request->get['sku']) and $this->request->get['sku'] == 1) {
				$str .= '"' . $product['sku'] . '"';
			}
			
			if (isset($this->request->get['product_name']) and $this->request->get['product_name'] == 1) {
				if ($str !== '') {
					$str .= $separator;
				}
				
				$str .= '"' . $product['name'] . '"';
			}
			
			if (isset($this->request->get['product_description']) and $this->request->get['product_description'] == 1) {
				if ($str !== '') {
					$str .= $separator;
				}
				
				$str .= '"' . $product['description'] . '"';
			}
			
			if (isset($this->request->get['price']) and $this->request->get['price'] == 1) {
				if ($str !== '') {
					$str .= $separator;
				}
				
				$str .= '"' . round($this->currency->convert($product['price'], '0', $this->user->get('currency')), 2) . '"';
			}
			
			if (isset($this->request->get['currency']) and $this->request->get['currency'] == 1) {
				if ($str !== '') {
					$str .= $separator;
				}
				
				$str .= '"' . $this->user->get('currency') . '"';
			}
			
			if (isset($this->request->get['quantity']) and $this->request->get['quantity'] == 1) {
				if ($str !== '') {
					$str .= $separator;
				}
				
				$str .= '"' . $product['quantity'] . '"';
			}
			
			if (isset($this->request->get['quality']) and $this->request->get['quality'] == 1) {
				if ($str !== '') {
					$str .= $separator;
				}
				
				if ($product['used'] == 1) {
					$str .= '"' . $this->language->get('text_quality_used') . '"';
				} else {
					$str .= '"' . $this->language->get('text_quality_new') . '"';
				}
			}
			
			if (isset($this->request->get['product_image']) and $this->request->get['product_image'] == 1) {
				if ($str !== '') {
					$str .= $separator;
				}
				
				$images = array();
			
				if($product['image']) {
					$images[] = HTTP_SERVER . DIR_IMAGE_RELATIVE . $product['image'];
				}
				
				foreach($this->model_catalog_product->getProductImages($this->user->getId(), $product['sku']) as $image) {
					$images[] = HTTP_SERVER . DIR_IMAGE_RELATIVE . $image['image'];
				}
				
				$str .= '"' . implode('[,]', str_replace('[,]', '[%2C]', $images)) . '"';
			}
			
			if (isset($this->request->get['product_category']) and $this->request->get['product_category'] == 1) {
				if ($str !== '') {
					$str .= $separator;
				}
				
				$str .= '"';
				
				$categories = $this->model_catalog_product->getProductCategories($this->user->getId(), $product['sku']);
				
				foreach ($categories as $key => $category) {
					$category_data = $this->model_catalog_category->getCategory($category['category_id']);
					
					if ($key != 0) {
						$str .= ', ';
					}
					
					$str .= html_entity_decode($category_data['path']);
				}
				
				$str .= '"';
			}
			
			if (isset($this->request->get['product_vehicle']) and $this->request->get['product_vehicle'] == 1) {
				if ($str !== '') {
					$str .= $separator;
				}
				
				$str .= '"';
				
				$vehicles = $this->model_catalog_product->getProductVehicles($this->user->getId(), $product['sku']);
				
				foreach ($vehicles as $key => $vehicle) {
					if ($key != 0) {
						$str .= ', ';
					}
					
					$str .= html_entity_decode($vehicle['title']);
					
					if (is_array($vehicle['engine'])) {
						$str .= ' ' . html_entity_decode($vehicle['engine']['name']);
					}
				}
				
				$str .= '"';
			}
			
			if (isset($this->request->get['brand']) and $this->request->get['brand'] == 1) {
				if ($str !== '') {
					$str .= $separator;
				}
				
				$str .= '"' . $product['brand'] . '"';
			}
			
			if (isset($this->request->get['mpn']) and $this->request->get['mpn'] == 1) {
				if ($str !== '') {
					$str .= $separator;
				}
				
				$str .= '"' . $product['mpn'] . '"';
			}
			
			if (isset($this->request->get['oe']) and $this->request->get['oe'] == 1) {
				if ($str !== '') {
					$str .= $separator;
				}
				
				$str .= '"' . $product['oe'] . '"';
			}
			
			if (isset($this->request->get['others']) and $this->request->get['others'] == 1) {
				if ($str !== '') {
					$str .= $separator;
				}
				
				$str .= '"' . $product['others'] . '"';
			}
			
			if (isset($this->request->get['weight']) and $this->request->get['weight'] == 1) {
				if ($str !== '') {
					$str .= $separator;
				}
				
				$str .= '"' . $product['weight'] . '"';
			}
			
			$str .= "\n";
			
			echo $str;
		}
	}
}
