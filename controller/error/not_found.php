<?php
namespace Opencart\Catalog\Controller\Error;
class NotFound extends \Opencart\System\Engine\Controller {
	public function index() {
		$this->load->language('error/not_found');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['header'] = $this->load->controller('common/header');
		$data['navigation'] = $this->load->controller('common/navigation');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('error/not_found', $data));
	}
}
