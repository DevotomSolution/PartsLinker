<?php
namespace Opencart\Catalog\Controller\Admin\Onlineshop;
class Autovit extends \Opencart\System\Engine\Controller {
	public function index() {
		$this->load->language('admin/autovit');

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
		
		$data['product_category_2_autovit_type'] = $this->getCategory2AutovitType();
		
		$data['autovit_types'] = array(
			array(
				'code' => 'parts-wheels',
				'name' => 'Accesorii roti si Capace',
			),
			array(
				'code' => 'altele',
				'name' => 'Altele',
			),
			array(
				'code' => 'roti-jante-anvelope',
				'name' => 'Anvelope',
			),
			array(
				'code' => 'audio-si-electronice',
				'name' => 'Audio si Electronice',
			),
			array(
				'code' => 'caroserie-interior',
				'name' => 'Caroserie, oglinzi si faruri',
			),
			array(
				'code' => 'climatizare',
				'name' => 'Climatizare',
			),
			array(
				'code' => 'consumabile-accesorii',
				'name' => 'Consumabile si Accesorii',
			),
			array(
				'code' => 'cutie-viteze-ambreiaj-transmisie',
				'name' => 'Cutie viteze, ambreiaj, transmisie',
			),
			array(
				'code' => 'directie-si-suspensie',
				'name' => 'Directie si suspensie',
			),
			array(
				'code' => 'echipamente-si-scule-auto',
				'name' => 'Echipamente si scule auto',
			),
			array(
				'code' => 'frane',
				'name' => 'Frane',
			),
			array(
				'code' => 'interior',
				'name' => 'Interior',
			),
			array(
				'code' => 'parts-rims',
				'name' => 'Jante si Roti',
			),
			array(
				'code' => 'mecanica-electrica',
				'name' => 'Motor, racire si evacuare',
			),
			array(
				'code' => 'ulei-lubrifianti-si-lichide',
				'name' => 'Ulei - lubrifianti si lichide',
			),
			array(
				'code' => 'vehicul-pentru-dezmembrare',
				'name' => 'Vehicule pentru dezmembrare',
			),
		);
		
		$data['pagination'] = $this->load->controller('common/pagination', [
			'total' => $total,
			'page'  => $page,
			'limit' => $limit,
			'url'   => $this->url->link('admin/onlineshop/autovit', 'user_token=' . $this->session->data['user_token'] . '&page={page}')
		]);

		$data['results'] = sprintf($this->language->get('text_pagination'), ($total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($total - $limit)) ? $total : ((($page - 1) * $limit) + $limit), $total, ceil($total / $limit));
		
		$data['user_token'] = $this->session->data['user_token'];
		
		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['navigation'] = $this->load->controller('common/navigation');
		
		$this->response->setOutput($this->load->view('admin/autovit_types', $data));
	}
	
	public function write() {
		if (isset($this->request->get['product_category']) and isset($this->request->get['autovit_type_code'])) {
			if($this->request->get['autovit_type_code'] == '') {
				$this->db->query("DELETE FROM " . DB_PREFIX . "category_to_autovit_type WHERE category_id = '" . (int) $this->request->get['product_category'] . "'");
				return;
			}
			
			$this->db->query("REPLACE INTO " . DB_PREFIX . "category_to_autovit_type SET category_id = '" . (int) $this->request->get['product_category'] . "', autovit_type_code = '"  . $this->db->escape($this->request->get['autovit_type_code']) . "'");
		}
	}
	
	private function getCategory2AutovitType() {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category_to_autovit_type");
		return array_column($query->rows, 'autovit_type_code', 'category_id');
	}
}