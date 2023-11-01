<?php
namespace Opencart\Catalog\Controller\Common;
class Header extends \Opencart\System\Engine\Controller {
	public function index() {
		$data['lang'] = $this->language->get('code');
		$data['direction'] = $this->language->get('direction');

		$this->document->addLink('https://use.fontawesome.com/releases/v6.0.0/css/all.css', 'stylesheet');
		$this->document->addLink('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap', 'stylesheet');
		
		$this->document->addStyle(HTTP_SERVER . 'view/css/mdb.min.css?v=1.12');
		$this->document->addStyle(HTTP_SERVER . 'view/css/style.css?v=2.80');
		
		$this->document->addScript(HTTP_SERVER . 'view/js/jquery-3.6.0.min.js');
		$this->document->addScript(HTTP_SERVER . 'view/js/common.js?v=1.5');
		
		$data['links'] = $this->document->getLinks();
		$data['styles'] = $this->document->getStyles();
		$data['scripts'] = $this->document->getScripts();
		
		$data['title'] = $this->document->getTitle();

		return $this->load->view('common/header', $data);
	}
}