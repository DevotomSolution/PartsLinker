<?php
namespace Opencart\Catalog\Controller\Api;
class Vehicle extends \Opencart\System\Engine\Controller {
	private $error = array();

	public function index() {
		$data = array();
		
		$data['message'] = 'Api Add is Working Now';
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($data));
	}
	
	public function add() {
		$this->load->model('catalog/vehicle4parts');
		$this->load->model('catalog/vehicle');
		
		$this->load->language('catalog/vehicle4parts');

		if ($this->validateForm()) {
			if (!isset($this->request->post['price'])) {
				$this->request->post['price'] = 0;
			} else {
				$this->request->post['price'] = $this->currency->convert((float) $this->request->post['price'], $this->user->get('currency'), '0');
			}
			
			$this->request->post['vehicle_id'] = $this->model_catalog_vehicle->getVehicleByModel($this->request->post['model_id'])['vehicle_id'];
			
			if (!isset($this->request->post['win'])) {
				$this->request->post['win'] = '';
			}
			
			if (!isset($this->request->post['color_id'])) {
				$this->request->post['color_id'] = 0;
			}
			
			if (!isset($this->request->post['color_code'])) {
				$this->request->post['color_code'] = '';
			}
			
			if (!isset($this->request->post['engine_id'])) {
				$this->request->post['engine_id'] = 0;
			}
			
			if (!isset($this->request->post['engine_code'])) {
				$this->request->post['engine_code'] = '';
			}
			
			if (!isset($this->request->post['year'])) {
				$this->request->post['year'] = 0;
			}
			
			if (!isset($this->request->post['transmission_id'])) {
				$this->request->post['transmission_id'] = 0;
			}
			
			if (!isset($this->request->post['gb_code'])) {
				$this->request->post['gb_code'] = '';
			}
			
			if (!isset($this->request->post['gb_speed_level'])) {
				$this->request->post['gb_speed_level'] = 0;
			}
			
			if (!isset($this->request->post['drive_id'])) {
				$this->request->post['drive_id'] = 0;
			}
			
			if (!isset($this->request->post['km'])) {
				$this->request->post['km'] = 0;
			}
			
			if (!isset($this->request->post['warehouse_id'])) {
				$this->request->post['warehouse_id'] = 0;
			}
			
			if (!isset($this->request->post['vehicle4parts_description']) or !is_array($this->request->post['vehicle4parts_description'])) {
				$this->request->post['vehicle4parts_description'] = array();
				
				$this->load->model('localisation/language');
			
				$languages = $this->model_localisation_language->getLanguages();
				
				foreach ($languages as $language) {
					$this->request->post['vehicle4parts_description'][$language['language_id']]['title'] = '';
					$this->request->post['vehicle4parts_description'][$language['language_id']]['note'] = '';
					$this->request->post['vehicle4parts_description'][$language['language_id']]['specifications'] = '';
				}
			}

			$sku = $this->model_catalog_vehicle4parts->addVehicle4Parts($this->user->getId(), $this->request->post);
			
			if ($sku) {
				$data['sku'] = $sku;
				$data['success'] = "New Vehicle has been has been created";
			} else {
				$data['sku'] = '';
				$data['success'] = '';
			}
		} else {
			$data['sku'] = '';
			$data['success'] = '';
		}
	
		if (isset($this->error['warning'])) {
			$data['error'] = $this->error['warning'];
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($data));
	}

	protected function validateForm() {
		$this->load->model('catalog/vehicle');
		
		if (!isset($this->request->post['sku']) or !preg_match('/^[a-zA-Z0-9]{3,10}$/', $this->request->post['sku'])) {
			$this->error['warning'] = $this->language->get('error_sku');
			return false;
		} else {
			$vehicle4parts_id = $this->model_catalog_vehicle4parts->getVehicle4PartsIdBySku($this->user->getId(), $this->request->post['sku']);

			if ($vehicle4parts_id) {
				$this->error['warning'] = $this->language->get('error_sku_duplicate');
				return false;
			}
		}
		
		if (empty($this->request->post['model_id'])) {
			$this->error['warning'] = $this->language->get('error_model');
			return false;
		} else {
			$vehicle = $this->model_catalog_vehicle->getVehicleByModel($this->request->post['model_id']);
			
			if (!$vehicle) {
				$this->error['warning'] = $this->language->get('error_model');
				return false;
			}
		}
		
		if (isset($this->request->post['vehicle4parts_description']) and is_array($this->request->post['vehicle4parts_description'])) {
			$this->load->model('localisation/language');
		
			$languages = $this->model_localisation_language->getLanguages();
			
			if (count($this->request->post['vehicle4parts_description']) != count($languages)) {
				$this->error['warning'] = $this->language->get('error_warning');
				return false;
			} else {
				foreach ($languages as $language) {
					if (!isset($this->request->post['vehicle4parts_description'][$language['language_id']]) or !is_array($this->request->post['vehicle4parts_description'][$language['language_id']])) {
						$this->error['warning'] = $this->language->get('error_warning');
						return false;
					}
					
					$allowed_tags = array('<p', '</p>', '<ul', '</ul>', '<li', '</li>', '<br', '<b', '</b>', '<i', '</i>', '<span', '</span>', '<div', '</div>');

					if (!isset($this->request->post['vehicle4parts_description'][$language['language_id']]['note'])) {
						$this->error['warning'] = $this->language->get('error_note');
						return false;
					} else {
						if (preg_match('/\<(.*?)\>/', str_replace($allowed_tags, '', html_entity_decode($this->request->post['vehicle4parts_description'][$language['language_id']]['note'])))) {
							$this->error['warning'] = $this->language->get('error_tags');
							return false;
						}
					}

					if (!isset($this->request->post['vehicle4parts_description'][$language['language_id']]['specifications'])) {
						$this->error['warning'] = $this->language->get('error_specifications');
						return false;
					} else {
						if (preg_match('/\<(.*?)\>/', str_replace($allowed_tags, '', html_entity_decode($this->request->post['vehicle4parts_description'][$language['language_id']]['specifications'])))) {
							$this->error['warning'] = $this->language->get('error_tags');
							return false;
						}
					}	
				}
			}
		}

		if (isset($this->request->post['vehicle4parts_image']) and (!is_array($this->request->post['vehicle4parts_image']) or count($this->request->post['vehicle4parts_image']) > 8)) {
			$this->error['warning'] = $this->language->get('error_warning');
			return false;
		} elseif (!empty($this->request->post['vehicle4parts_image'])) {
			foreach ($this->request->post['vehicle4parts_image'] as $image) {
				if (!file_exists(DIR_IMAGE . $image)) {
					$this->error['warning'] = $this->language->get('error_image');
					return false;
				}
			}
		}
		
		if (!empty($this->request->post['vehicle4parts_video'])) {
			if (empty($this->request->post['vehicle4parts_video']['mime']) or (oc_strlen($this->request->post['vehicle4parts_video']['mime']) > 32) or empty($this->request->post['vehicle4parts_video']['video'])) {
				$this->error['warning'] = $this->language->get('error_warning');
				return false;
			}
			
			if (!file_exists(DIR_IMAGE . $this->request->post['vehicle4parts_video']['video'])) {
				$this->error['warning'] = $this->language->get('error_video');
				return false;
			}
		}
		
		if (isset($this->request->post['warehouse_id']) and oc_strlen($this->request->post['warehouse_id']) > 11) {
			$this->error['warning'] = $this->language->get('error_warehouse');
			return false;
		}
		
		if (isset($this->request->post['win']) and oc_strlen($this->request->post['win']) > 32) {
			$this->error['warning'] = $this->language->get('error_win');
			return false;
		}
		
		if (!empty($this->request->post['color_id'])) {
			$color_info = $this->model_catalog_vehicle->getColor($this->request->post['color_id']);
			
			if (!$color_info) {
				$this->error['warning'] = $this->language->get('error_color_id');
				return false;
			}
		}
		
		if (isset($this->request->post['color_code']) and oc_strlen($this->request->post['color_code']) > 32) {
			$this->error['warning'] = $this->language->get('error_color_code');
			return false;
		}
		
		if (!empty($this->request->post['engine_id'])) {
			$engine_info = $this->model_catalog_vehicle->getEngine($this->request->post['engine_id']);
			
			if (!$engine_info) {
				$this->error['warning'] = $this->language->get('error_engine_id');
				return false;
			}
		}
		
		if (isset($this->request->post['engine_code']) and oc_strlen($this->request->post['engine_code']) > 64) {
			$this->error['warning'] = $this->language->get('error_engine_code');
			return false;
		}
		
		if (isset($this->request->post['year']) and (int) $this->request->post['year'] > 9999) {
			$this->error['warning'] = $this->language->get('error_year');
			return false;
		}
		
		if (!empty($this->request->post['transmission_id'])) {
			$transmission_info = $this->model_catalog_vehicle->getTransmission($this->request->post['transmission_id']);
			
			if (!$transmission_info) {
				$this->error['warning'] = $this->language->get('error_transmission_id');
				return false;
			}
		}
		
		if (isset($this->request->post['gb_code']) and oc_strlen($this->request->post['gb_code']) > 64) {
			$this->error['warning'] = $this->language->get('error_gb_code');
			return false;
		}
		
		if (!empty($this->request->post['gb_speed_level'])) {
			$gb_speed_level_info = $this->model_catalog_vehicle->getGBSpeedLevel($this->request->post['gb_speed_level']);
			
			if (!$gb_speed_level_info) {
				$this->error['warning'] = $this->language->get('error_gb_speed_level');
				return false;
			}
		}
		
		if (!empty($this->request->post['drive_id'])) {
			$drive_info = $this->model_catalog_vehicle->getDrive($this->request->post['drive_id']);
			
			if (!$drive_info) {
				$this->error['warning'] = $this->language->get('error_drive_id');
				return false;
			}
		}
		
		if (isset($this->request->post['km']) and (int) $this->request->post['km'] > 999999) {
			$this->error['warning'] = $this->language->get('error_km');
			return false;
		}
		
		if (isset($this->request->post['price']) and (int) $this->request->post['price'] > 999999) {
			$this->error['warning'] = $this->language->get('error_price');
			return false;
		}

		return !$this->error;
	}

	public function getBrands()	{
		$this->load->model('catalog/vehicle');
		
		$data = $this->model_catalog_vehicle->getBrands();

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($data));
	}

	public function getModels()	{
		$data = array();
		
		if (!isset($this->request->get['brand_id'])) {
			$data['error'] = 'Please provide brand_id';
		} else {
			$this->load->model('catalog/vehicle');
			
			$data['data'] = $this->model_catalog_vehicle->getModels(array('filter_brand_id' => $this->request->get['brand_id']));
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($data));
	}

	public function getEngines() {
		$data = array();
		
		if (!isset($this->request->get['model_id'])) {
			$data['error'] = 'Please provide model_id';
		} else {
			$this->load->model('catalog/vehicle');
			
			$data['data'] = $this->model_catalog_vehicle->getEngines(array('filter_model_id' => $this->request->get['model_id']));
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($data));
	}

	public function getColors()	{
		$this->load->model('catalog/vehicle');
		
		$data = $this->model_catalog_vehicle->getColors();

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($data));
	}

	public function getTransmissions() {
		$this->load->model('catalog/vehicle');
		
		$data = $this->model_catalog_vehicle->getTransmissions();

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($data));
	}

	public function getDrives()	{
		$this->load->model('catalog/vehicle');
		
		$data = $this->model_catalog_vehicle->getDrives();

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($data));
	}

	public function getGBSpeedLevels() {
		$this->load->model('catalog/vehicle');
		
		$data = $this->model_catalog_vehicle->getGBSpeedLevels();

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($data));
	}
	
	public function uploadVideo() {
		$json = array();
		
		$this->load->language('catalog/vehicle4partst');

		if (isset($this->request->files['file'])) {
			$content = file_get_contents($this->request->files['file']['tmp_name']);

			if (preg_match('/\<\?php/i', $content)) {
				$json['error'] = $this->language->get('error_warning');
			}
			
			if ($this->request->files['file']['size'] > 50000000) {
				$json['error'] = $this->language->get('error_video_size');
			}
			
			$mime = mime_content_type($this->request->files['file']['tmp_name']);
			
			switch($mime) {
				case 'video/mp4':
				case 'video/webm':
				case 'video/ogg':
				case 'video/quicktime':
				case 'video/x-m4v':
					break;
				default:
					$json['error'] = sprintf($this->language->get('error_file_type'), $mime);
			}
		} else {
			$json['error'] = $this->language->get('error_warning');
		}

		if (!isset($json['error'])) {
			$name_exp = explode('.', $this->request->files['file']['name']);
			$file_name = time() . rand(100, 900) . $this->user->getId() . '.' . end($name_exp);
			
			move_uploaded_file($this->request->files['file']['tmp_name'], DIR_IMAGE_VEHICLE4PARTS . $file_name);
			
			$json['video'] = DIR_IMAGE_VEHICLE4PARTS_NAME . $file_name;
			$json['path'] = HTTP_SERVER . DIR_IMAGE_VEHICLE4PARTS_RELATIVE . $file_name;
			$json['mime'] = $mime;
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function uploadImage() {
		$json = array();
		
		$this->load->language('catalog/vehicle4partst');

		if (isset($this->request->files['file'])) {
			$content = file_get_contents($this->request->files['file']['tmp_name']);

			if (preg_match('/\<\?php/i', $content)) {
				$json['error'] = $this->language->get('error_warning');
			}
			
			if ($this->request->files['file']['size'] > 25000000) {
				$json['error'] = $this->language->get('error_image');
			}
			
			$mime = mime_content_type($this->request->files['file']['tmp_name']);
			
			switch($mime) {
				case 'image/jpeg':
					break;
				default:
					$json['error'] = sprintf($this->language->get('error_file_type'), $mime);
			}
		} else {
			$json['error'] = $this->language->get('error_warning');
		}

		if (!isset($json['error'])) {
			$name_exp = explode('.', $this->request->files['file']['name']);
			$file_name = time() . rand(100, 900) . $this->user->getId() . '.' . end($name_exp);
			
			list($width_orig, $height_orig, $image_type) = getimagesize($this->request->files['file']['tmp_name']);
		
			$image = new \Opencart\System\Library\Image($this->request->files['file']['tmp_name']);
			
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
			
			$image->save(DIR_IMAGE_VEHICLE4PARTS . $file_name);
			
			unset($image);
			
			$json['image'] = DIR_IMAGE_VEHICLE4PARTS_NAME . $file_name;
			$json['path'] = HTTP_SERVER . DIR_IMAGE_VEHICLE4PARTS_RELATIVE . $file_name;
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function uploadFile() {
		$json = array();

		$this->load->language('catalog/vehicle4parts');
		$this->load->model('catalog/vehicle4parts');
		
		if (isset($this->request->files['file'])) {
			$content = file_get_contents($this->request->files['file']['tmp_name']);

			if (preg_match('/\<\?php/i', $content)) {
				$json['error'] = $this->language->get('error_warning');
			}
			
			if ($this->request->files['file']['size'] > 25000000) {
				$json['error'] = $this->language->get('error_file_size');
			}
			
			$mime = mime_content_type($this->request->files['file']['tmp_name']);
			
			switch($mime) {
				case 'image/jpeg':
				case 'image/gif':
				case 'image/png':
				case 'image/bmp':
				case 'application/pdf':
				case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
					break;
				default:
					$json['error'] = sprintf($this->language->get('error_file_type'), $mime);
			}
		} else {
			$json['error'] = $this->language->get('error_warning');
		}
		
		if (empty($this->request->get['sku'])) {
			$json['error'] = $this->language->get('error_warning');
		}

		if (!isset($json['error'])) {
			$name_exp1 = explode('.', $this->request->files['file']['name']);
			$file_name = time() . rand(100, 900) . $this->user->getId() . '.' . end($name_exp1);
			
			move_uploaded_file($this->request->files['file']['tmp_name'], DIR_UPLOAD . $file_name);
			
			$name_exp2 = explode('/', $this->request->files['file']['name']);
			$title = mb_substr(end($name_exp2), 0, 32);
			
			$sku = $this->request->get['sku'];
			
			$file_id = $this->model_catalog_vehicle4parts->addVehicle4PartsFile($this->user->getId(), $sku, array('file' => $file_name, 'title' => $title));
			
			$json['id'] = $file_id;
			$json['title'] = $title;
			$json['path'] = HTTP_SERVER . DIR_UPLOAD_RELATIVE . $file_name;
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}	
}
