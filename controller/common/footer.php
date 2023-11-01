<?php
namespace Opencart\Catalog\Controller\Common;
class Footer extends \Opencart\System\Engine\Controller {
	public function index() {
		if (isset($this->session->data['alerts'])) {
			$data['alerts'] = $this->session->data['alerts'];

			unset($this->session->data['alerts']);
		} else {
			$data['alerts'] = array();
		}
	
		$this->document->addScript(HTTP_SERVER . 'view/js/mdb.min.js?v=1.01', 'footer');

		$data['scripts'] = $this->document->getScripts('footer');
		$data['styles'] = $this->document->getStyles('footer');

		return $this->load->view('common/footer', $data);
	}
}