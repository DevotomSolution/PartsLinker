<?php
namespace Opencart\Catalog\Controller\Tool;
class Translate extends \Opencart\System\Engine\Controller {
	public function index() {		
		$json = array(
			'success' => 0
		);
		
		if(isset($this->request->post['text']) && isset($this->request->post['language_to'])) {
			$this->load->model('tool/translate');
			
			$result = $this->model_tool_translate->translate($this->request->post['text'], $this->request->post['language_to']);
			
			if($result) {
				$json['success'] = 1;
				$json['text'] = $result;
			}
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}