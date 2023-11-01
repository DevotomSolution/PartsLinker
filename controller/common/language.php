<?php
namespace Opencart\Catalog\Controller\Common;
class Language extends \Opencart\System\Engine\Controller {
	public function index() {
		$this->load->model('localisation/language');
		
		if($this->user->isLogged()) {
			$user_language = $this->user->get('language_id');
		} elseif (isset($this->request->cookie['language_id'])) {
			$user_language = (int) $this->request->cookie['language_id'];
		} else {
			$user_language = 1;
		}

		$data['languages'] = array();
		$data['current_language'] = array();

		$results = $this->model_localisation_language->getLanguages();

		foreach ($results as $result) {
			if ($result['status']) {
				if ($user_language == $result['language_id']) {
					$data['current_language'] = array(
						'name' => $result['name'],
						'id' => $result['language_id'],
						'code' => $result['code'],
					);
					continue;
				}
				
				$data['languages'][] = array(
					'name' => $result['name'],
					'id' => $result['language_id'],
					'code' => $result['code'],
				);
			}
		}
		
		return $this->load->view('common/language', $data);
	}
	
	public function setLanguage() {
		if (!isset($this->request->post['language_id'])) {
			return;
		}
		
		if($this->user->isLogged()) {
			$this->load->model('user/user'); 
			
			$this->model_user_user->editUserLanguage($this->user->getId(), (int) $this->request->post['language_id']);
		}
		
		setcookie('language_id', (int) $this->request->post['language_id'], time()+60*60*24*365);
	}
}