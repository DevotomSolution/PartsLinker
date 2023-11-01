<?php
namespace Opencart\Catalog\Controller\Admin\Tool;
class Cache extends \Opencart\System\Engine\Controller {
	public function index() {
		$this->load->language('admin/cache');

		$this->document->setTitle($this->language->get('heading_title'));
		
		if($this->request->server['REQUEST_METHOD'] == 'POST') {
			$this->cache->clear();
			
			$data['success'] = $this->language->get('text_success');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['navigation'] = $this->load->controller('common/navigation');
		
		$this->response->setOutput($this->load->view('admin/cache', $data));
	}
}