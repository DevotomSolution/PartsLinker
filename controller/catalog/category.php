<?php
namespace Opencart\Catalog\Controller\Catalog;
class Category extends \Opencart\System\Engine\Controller {
	private $error = array();

	public function index() {
		$this->load->model('catalog/category');

		$this->load->language('catalog/category');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->getList();
	}

	private function getList() {
		$limit = 50;

		if(isset($this->request->get['page'])) {
			$page = (int)$this->request->get['page'];
		} else {
			$page = 1;
		}

		$filter_data = array(
			'start' => ($page - 1) * $limit,
			'limit' => $limit,
		);

		$data['user_categories'] = array_column($this->model_catalog_category->getCategories($this->user->getId()), 'category_id', 'category_id');

		$data['categories'] = $this->model_catalog_category->getCategories(false, $filter_data);

		$categories_total = $this->model_catalog_category->getTotalCategories();

		$url = '';

		$url .= '&user_token=' . $this->session->data['user_token'];
		
		$data['pagination'] = $this->load->controller('common/pagination', [
			'total' => $categories_total,
			'page'  => $page,
			'limit' => $limit,
			'url'   => $this->url->link('catalog/category', 'user_token=' . $this->session->data['user_token'] . $url . '&page={page}')
		]);

		$data['results'] = sprintf($this->language->get('text_pagination'), ($categories_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($categories_total - $limit)) ? $categories_total : ((($page - 1) * $limit) + $limit), $categories_total, ceil($categories_total / $limit));

		$data['user_token'] = $this->session->data['user_token'];

		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['navigation'] = $this->load->controller('common/navigation');

		$this->response->setOutput($this->load->view('catalog/category_list', $data));
	}

	public function enableCategory() {
		if(isset($this->request->get['category_id'])) {
			$this->load->model('catalog/category');

			$this->model_catalog_category->enableCategoryForUser($this->user->getId(), (int) $this->request->get['category_id']);
		}
	}

	public function disableCategory() {
		if(isset($this->request->get['category_id'])) {
			$this->load->model('catalog/category');

			$json = $this->model_catalog_category->disableCategoryForUser($this->user->getId(), (int) $this->request->get['category_id']);
		}
	}
}
