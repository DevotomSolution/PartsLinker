<?php
namespace Opencart\Catalog\Controller\Common;
class Navigation extends \Opencart\System\Engine\Controller {
	public function index() {
		$this->load->model('tool/image');

		if (is_file(DIR_IMAGE . $this->user->get('logo'))) {
			$logo = $this->model_tool_image->resize($this->user->get('logo'), 0, 45, 150);
		} else {
			$logo = $this->model_tool_image->resize('no_image.png', 0, 45, 150);
		}
		
		$data['logo'] = $logo;
		
		$this->load->language('common/navigation');
		
		$data['navigaton'] = array();
		
		$data['navigaton'][] = array(
			'title' => '<i class="fas fa-bars me-3"></i>' . $this->language->get('text_catalog'),
			'link' => false,
			'collapse' => array(
				array(
					'title' => '<i class="fas fa-car-battery me-3"></i>' . $this->language->get('text_product'),
					'link' => $this->url->link('catalog/product', 'user_token=' . $this->session->data['user_token'], true),
				),
				array(
					'title' => '<i class="fas fa-car-side me-3"></i>' . $this->language->get('text_vehicle4parts'),
					'link' => $this->url->link('catalog/vehicle4parts', 'user_token=' . $this->session->data['user_token'], true),
				),
				array(
					'title' => '<i class="fas fa-tasks me-3"></i>' . $this->language->get('text_category'),
					'link' => $this->url->link('catalog/category', 'user_token=' . $this->session->data['user_token'], true),
				),
				array(
					'title' => '<i class="fas fa-tasks me-3"></i>' . $this->language->get('text_vehicle_brand'),
					'link' => $this->url->link('catalog/vehicle_brand', 'user_token=' . $this->session->data['user_token'], true),
				),
				array(
					'title' => '<i class="fas fa-file-import me-3"></i>' . $this->language->get('text_import_export'),
					'link' => $this->url->link('catalog/import_export', 'user_token=' . $this->session->data['user_token'], true),
				),
			),
		);
		
		$data['navigaton'][] = array(
			'title' => '<i class="fas fa-plug me-3"></i>' . $this->language->get('text_integrations'),
			'link' => $this->url->link('integration/integration', 'user_token=' . $this->session->data['user_token'], true),
		);
		
		$data['navigaton'][] = array(
			'title' => '<i class="far fa-credit-card me-3"></i>' . $this->language->get('text_sale'),
			'link' => false,
			'collapse' => array(
				array(
					'title' => '<i class="fas fa-file-invoice-dollar me-3"></i>' . $this->language->get('text_orders'),
					'link' => $this->url->link('sale/order', 'user_token=' . $this->session->data['user_token'], true),
				),
			),
		);
		
		$warehouse_collapse = array();
		
		$warehouse_collapse[] = array(
			'title' => $this->language->get('text_all_warehouses'),
			'link' => $this->url->link('catalog/warehouse', 'user_token=' . $this->session->data['user_token'], true),
		);
		
		$this->load->model('catalog/warehouse');
		
		$warehouses = $this->model_catalog_warehouse->getWarehouses($this->user->getId());
		
		foreach ($warehouses as $warehouse) {
			$warehouse_collapse[] = array(
				'title' => $warehouse['name'],
				'link' => $this->url->link('catalog/warehouse', 'user_token=' . $this->session->data['user_token'] . '&warehouse_id=' . $warehouse['warehouse_id'], true),
			);
		}
		
		$data['navigaton'][] = array(
			'title' => '<i class="fas fa-warehouse me-3"></i>' . $this->language->get('text_warehouse'),
			'link' => false,
			'collapse' => $warehouse_collapse,
		);
		
		$admin = array();
		
		if ($this->user->hasPermission('access', 'admin/onlineshop')) {
			$admin[] = array(
				'title' => '<i class="fas fa-tools me-3"></i>' . $this->language->get('text_admin_onlineshop_pieseauto'),
				'link' => $this->url->link('admin/onlineshop/pieseauto', 'user_token=' . $this->session->data['user_token'], true),
			);
			
			$admin[] = array(
				'title' => '<i class="fas fa-tools me-3"></i>' . $this->language->get('text_admin_onlineshop_autovit'),
				'link' => $this->url->link('admin/onlineshop/autovit', 'user_token=' . $this->session->data['user_token'], true),
			);
		}
		
		if ($this->user->hasPermission('access', 'admin/vehicle')) {
			$admin[] = array(
				'title' => '<i class="fas fa-tools me-3"></i>' . $this->language->get('text_admin_vehicle_position'),
				'link' => $this->url->link('admin/vehicle/position', 'user_token=' . $this->session->data['user_token'], true),
			);
			$admin[] = array(
				'title' => '<i class="fas fa-tools me-3"></i>' . $this->language->get('text_admin_vehicle_color'),
				'link' => $this->url->link('admin/vehicle/color', 'user_token=' . $this->session->data['user_token'], true),
			);
			$admin[] = array(
				'title' => '<i class="fas fa-tools me-3"></i>' . $this->language->get('text_admin_vehicle_transmission'),
				'link' => $this->url->link('admin/vehicle/transmission', 'user_token=' . $this->session->data['user_token'], true),
			);
			$admin[] = array(
				'title' => '<i class="fas fa-tools me-3"></i>' . $this->language->get('text_admin_vehicle_drive'),
				'link' => $this->url->link('admin/vehicle/drive', 'user_token=' . $this->session->data['user_token'], true),
			);
			$admin[] = array(
				'title' => '<i class="fas fa-tools me-3"></i>' . $this->language->get('text_admin_vehicle_gb_speed_level'),
				'link' => $this->url->link('admin/vehicle/gb_speed_level', 'user_token=' . $this->session->data['user_token'], true),
			);
		}
		
		if ($this->user->hasPermission('access', 'admin/tool')) {
			$admin[] = array(
				'title' => '<i class="fas fa-tools me-3"></i>' . $this->language->get('text_admin_tool_category'),
				'link' => $this->url->link('admin/tool/category', 'user_token=' . $this->session->data['user_token'], true),
			);
			
			$admin[] = array(
				'title' => '<i class="fas fa-tools me-3"></i>' . $this->language->get('text_admin_tool_cache'),
				'link' => $this->url->link('admin/tool/cache', 'user_token=' . $this->session->data['user_token'], true),
			);
		}
		
		if ($admin) {
			$data['navigaton'][] = array(
				'title' => '<i class="fas fa-unlock me-3"></i>' . $this->language->get('text_admin'),
				'link' => false,
				'collapse' => $admin
			);
		}
		
		$data['home'] = $this->url->link('catalog/product', 'user_token=' . $this->session->data['user_token'], true);
		$data['setting'] = $this->url->link('account/setting', 'user_token=' . $this->session->data['user_token'], true);
		$data['logout'] = $this->url->link('account/logout', 'user_token=' . $this->session->data['user_token'], true);
		
		$data['language_selector'] = $this->load->controller('common/language');
		$data['cart'] = $this->load->controller('catalog/cart');
		
		$data['user_token'] = $this->session->data['user_token'];

		return $this->load->view('common/navigation', $data);
	}
}