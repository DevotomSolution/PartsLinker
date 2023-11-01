<?php
namespace Opencart\Catalog\Controller\Admin\Onlineshop;
class Pieseauto extends \Opencart\System\Engine\Controller {
	public function index() {
		$this->load->language('admin/pieseauto');

		$this->document->setTitle($this->language->get('heading_title'));
		
		if (isset($this->session->data['error'])) {
			$data['error_warning'] = $this->session->data['error'];

			unset($this->session->data['error']);
		} else {
			$data['error_warning'] = '';
		}
		
		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}
		
		if (isset($this->request->get['page'])) {
			$page = (int)$this->request->get['page'];
		} else {
			$page = 1;
		}
		
		$limit = 15;
		
		$this->load->model('catalog/category');
		
		$data['product_categories'] = $this->model_catalog_category->getCategories(false, array('start' => ($page - 1) * $limit, 'limit' => $limit));
		
		$total = $this->model_catalog_category->getTotalCategories();
		
		$data['pieseauto_categories'] = $this->getPieseautoCategories();
		$data['product_category_2_pieseauto_category'] = $this->getCategory2PieseautoCategory();
		
		$data['pagination'] = $this->load->controller('common/pagination', [
			'total' => $total,
			'page'  => $page,
			'limit' => $limit,
			'url'   => $this->url->link('admin/onlineshop/pieseauto', 'user_token=' . $this->session->data['user_token'] . '&page={page}')
		]);

		$data['results'] = sprintf($this->language->get('text_pagination'), ($total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($total - $limit)) ? $total : ((($page - 1) * $limit) + $limit), $total, ceil($total / $limit));
		
		$data['user_token'] = $this->session->data['user_token'];
		
		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['navigation'] = $this->load->controller('common/navigation');
		
		$this->response->setOutput($this->load->view('admin/pieseauto_categories', $data));
	}
	
	public function write() {
		if (isset($this->request->get['product_category']) and isset($this->request->get['pieseauto_category_id'])) {
			if($this->request->get['pieseauto_category_id'] == 0) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "category_to_pieseauto_category WHERE category_id = '" . (int) $this->request->get['product_category'] . "'");
				return;
			}
			
			$this->db->query("REPLACE INTO " . DB_PREFIX . "category_to_pieseauto_category SET category_id = '" . (int) $this->request->get['product_category'] . "', pieseauto_category_id = '"  . (int) $this->request->get['pieseauto_category_id'] . "'");
		}
	}

	private function getPieseautoCategories() {
		$query = $this->db->query("SELECT DISTINCT * FROM pieseauto_category");
		return $query->rows;
	}
	
	private function getCategory2PieseautoCategory() {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category_to_pieseauto_category");
		return array_column($query->rows, 'pieseauto_category_id', 'category_id');
	}
}