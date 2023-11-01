<?php
namespace Opencart\Catalog\Controller\Admin\Tool;
class Category extends \Opencart\System\Engine\Controller {
	private $error = array();
	
	public function index() {
		$this->load->language('admin/category');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/category');
		
		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}
		
		$limit = 50;
		
		if(isset($this->request->get['page'])) {
			$page = (int) $this->request->get['page'];
		} else {
			$page = 1;
		}
		
		if (isset($this->request->get['search'])) {
			$search = $this->request->get['search'];
		} else {
			$search = '';
		}
		
		if (!empty($search)) {
			$data['search'] = $search;
		}
		
		$filter_data = array(
			'start' => ($page - 1) * $limit,
			'limit' => $limit,
			'filter_name' => $search,
		);
		
		$categories_total = $this->model_catalog_category->getTotalCategories(false, $filter_data);
		
		$categories = $this->model_catalog_category->getCategories(false, $filter_data);
		
		$url = '';
		
		$url .= '&user_token=' . $this->session->data['user_token'];
		
		if (isset($this->request->get['search'])) {
			$url .= '&search=' . $this->request->get['search'];
		}
		
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		foreach ($categories as $category) {
			$data['categories'][] = array(
				'category_id' => $category['category_id'],
				'name' => $category['name'],
				'path' => $category['path'],
				'edit' => $this->url->link('admin/tool/category.edit', $url . '&category_id=' . $category['category_id'], true),
			);
		}
		
		$data['add'] = $this->url->link('admin/tool/category.add', $url, true);
		
		$data['action'] = $this->url->link('admin/tool/category', '&user_token=' . $this->session->data['user_token'], true);
		
		$url = '';
		
		$url .= '&user_token=' . $this->session->data['user_token'];
		
		if (isset($this->request->get['search'])) {
			$url .= '&search=' . $this->request->get['search'];
		}
		
		$data['pagination'] = $this->load->controller('common/pagination', [
			'total' => $categories_total,
			'page'  => $page,
			'limit' => $limit,
			'url'   => $this->url->link('admin/tool/category', 'user_token=' . $url . '&page={page}')
		]);

		$data['results'] = sprintf($this->language->get('text_pagination'), ($categories_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($categories_total - $limit)) ? $categories_total : ((($page - 1) * $limit) + $limit), $categories_total, ceil($categories_total / $limit));

		$data['user_token'] = $this->session->data['user_token'];

		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['navigation'] = $this->load->controller('common/navigation');
		
		$this->response->setOutput($this->load->view('admin/category_list', $data));
	}
	
	public function add() {
		$this->load->language('admin/category');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/category');

		if ($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validateForm()) {
			$this->model_catalog_category->addCategory($this->request->post);
			
			$url = '';
			
			$url .= '&user_token=' . $this->session->data['user_token'];

			if (isset($this->request->get['search'])) {
				$url .= '&search=' . urlencode(html_entity_decode($this->request->get['search'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->response->redirect($this->url->link('admin/tool/category', $url, true));
		}

		$this->getForm();
	}
	
	public function edit() {
		$this->load->language('admin/category');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/category');

		if ($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validateForm()) {
			$this->model_catalog_category->editCategory($this->request->get['category_id'], $this->request->post);
			
			$url = '';
			
			$url .= '&user_token=' . $this->session->data['user_token'];

			if (isset($this->request->get['search'])) {
				$url .= '&search=' . urlencode(html_entity_decode($this->request->get['search'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->response->redirect($this->url->link('admin/tool/category', $url, true));
		}

		$this->getForm();
	}
	
	protected function getForm() {
		$this->load->model('localisation/language');
		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		$url = '';
		
		$url .= '&user_token=' . $this->session->data['user_token'];

		if (isset($this->request->get['search'])) {
			$url .= '&search=' . urlencode(html_entity_decode($this->request->get['search'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		if (!isset($this->request->get['category_id'])) {
			$data['action'] = $this->url->link('admin/tool/category.add', $url, true);
		} else {
			$data['action'] = $this->url->link('admin/tool/category.edit', 'category_id=' . $this->request->get['category_id'] . $url, true);
		}
		
		if (isset($this->request->get['redirect'])) {
			$data['cancel'] = $this->url->link($this->request->get['redirect'], $url, true);
		} else {
			$data['cancel'] = $this->url->link('admin/tool/category', $url, true);
		}
		
		if (isset($this->request->get['category_id'])) {
			$category_info = $this->model_catalog_category->getCategory($this->request->get['category_id']);
		}
		
		$languages = $this->model_localisation_language->getLanguages();
		
		if (isset($this->request->post['parent_id'])) {
			$parent_category_info = $this->model_catalog_category->getCategory($this->request->post['parent_id']);
			
			if ($parent_category_info) {
				$data['parent_id'] = $parent_category_info['category_id'];
				$data['parent_path'] = $parent_category_info['path'];
			} else {
				$data['parent_id'] = 0;
				$data['parent_path'] = '';
			}
		} elseif (!empty($category_info)) {
			$parent_category_info = $this->model_catalog_category->getCategory($category_info['parent_id']);
			
			if ($parent_category_info) {
				$data['parent_id'] = $parent_category_info['category_id'];
				$data['parent_path'] = $parent_category_info['path'];
			} else {
				$data['parent_id'] = 0;
				$data['parent_path'] = '';
			}
		} else {
			$data['parent_id'] = 0;
			$data['parent_path'] = '';
		}
		
		foreach ($languages as $language) {
			if (isset($this->request->post['category_description'][$language['language_id']]['name'])) {
				$data['category_description'][$language['language_id']]['name'] = $this->request->post['category_description'][$language['language_id']]['name'];
			} elseif (!empty($category_info)) {
				$data['category_description'][$language['language_id']]['name'] = $category_info['translates'][$language['language_id']];
			} else {
				$data['category_description'][$language['language_id']]['name'] = '';
			}
		}
		
		if (isset($this->request->post['default_weight'])) {
			$data['default_weight'] = $this->request->post['default_weight'];
		} elseif (!empty($category_info)) {
			$data['default_weight'] = $category_info['default_weight'];
		} else {
			$data['default_weight'] = 0;
		}
		
		if (isset($this->request->post['image'])) {
			$data['image']['image'] = $this->request->post['image'];
			$data['image']['path'] = HTTP_SERVER . DIR_IMAGE_RELATIVE . $this->request->post['image'];
		} elseif (!empty($category_info) and $this->request->server['REQUEST_METHOD'] !== 'POST') {
			if ($category_info['image']) {
				$data['image']['image'] = $category_info['image'];
				$data['image']['path'] = HTTP_SERVER . DIR_IMAGE_RELATIVE . $category_info['image'];
			}
		}
		
		if (empty($data['image']['image'])) {
			$data['image']['image'] = '';
			$data['image']['path'] = HTTP_SERVER . DIR_IMAGE_RELATIVE . 'no_image.png';
		}
		
		$data['user_language'] = $this->user->get('language_id');
		
		foreach ($languages as $language) {
			if ($language['language_id'] == $data['user_language']) {
				$data['languages'][0] = $language;
			} else {
				$data['languages'][$language['language_id']] = $language;
			}
		}
		
		ksort($data['languages']);
		
		$data['all_categories'] = $this->model_catalog_category->getCategories();
		
		$data['user_token'] = $this->session->data['user_token'];
		
		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['navigation'] = $this->load->controller('common/navigation');
		
		$data['MAX_IMAGE_WIDTH'] = MAX_IMAGE_WIDTH;
		$data['MAX_IMAGE_HEIGHT'] = MAX_IMAGE_HEIGHT;

		$this->response->setOutput($this->load->view('admin/category_form', $data));
	}
	
	protected function validateForm() {
		$this->load->model('localisation/language');
		
		$languages = $this->model_localisation_language->getLanguages();
		
		foreach ($languages as $language) {
			if (empty($this->request->post['category_description'][$language['language_id']]['name'])) {
				$this->error['warning'] = $this->language->get('error_name');
			} else {
				if (oc_strlen($this->request->post['category_description'][$language['language_id']]['name']) > 48) {
					$this->error['warning'] = $this->language->get('error_name');
				}
			}	
		}
		
		if (!isset($this->request->post['parent_id'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}
		
		if (!isset($this->request->post['default_weight']) or oc_strlen($this->request->post['default_weight']) > 15) {
			$this->error['warning'] = $this->language->get('error_default_weight');
		}
		
		if (!empty($this->request->post['image']) and !file_exists(DIR_IMAGE . $this->request->post['image'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}

		return !$this->error;
	}
	
	public function delete() {
		$json = array();
		
		$this->load->language('admin/category');
		
		if (!empty($this->request->post['category_id'])) {
			$this->load->model('catalog/category');

			$this->model_catalog_category->deleteCategory($this->request->post['category_id']);
			
			$json['category_id'] = $this->request->post['category_id'];
		} else {
			$json['error'] = $this->error['warning'];
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function uploadImage() {
		$json = array();
		
		$this->load->language('catalog/product');

		if (isset($this->request->files['image'])) {
			$content = file_get_contents($this->request->files['image']['tmp_name']);

			if (preg_match('/\<\?php/i', $content)) {
				$json['error'] = $this->language->get('error_image');
			}
			
			if ($this->request->files['image']['size'] > 25000000) {
				$json['error'] = $this->language->get('error_image');
			}
			
			$mime = mime_content_type($this->request->files['image']['tmp_name']);
			
			switch($mime) {
				case 'image/jpeg':
					break;
				case 'image/png':
					break;
				default:
					$json['error'] = $this->language->get('error_image');
			}
		} else {
			$json['error'] = $this->language->get('error_image');
		}
		
		if (!isset($json['error'])) {
			$name_exp = explode('.', $this->request->files['image']['name']);
			$file_name = time() . rand(100, 900) . '.' . end($name_exp);
			
			list($width_orig, $height_orig, $image_type) = getimagesize($this->request->files['image']['tmp_name']);
		
			$image = new \Opencart\System\Library\Image($this->request->files['image']['tmp_name']);
			
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
			
			$image->save(DIR_IMAGE_CATEGORY . $file_name);

			unset($image);
			
			$json['image'] = DIR_IMAGE_CATEGORY_NAME . $file_name;
			$json['path'] = HTTP_SERVER . DIR_IMAGE_CATEGORY_RELATIVE . $file_name;	
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}