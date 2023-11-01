<?php
namespace Opencart\Catalog\Model\Tool;
class Translate extends \Opencart\System\Engine\Model {
	public function translate($text, $language_to, $language_from = false) {
		if(!$text) {
			return '';
		}
		
		$this->load->model('localisation/language');
		
		$language_to_result = $this->model_localisation_language->getLanguage($language_to);
	
		if($language_to_result) {
			$target_lang = strtoupper(mb_substr($language_to_result['code'], 0, 2));
		} else {
			return '';
		}
		
		if($language_from) {
			$language_from_result = $this->model_localisation_language->getLanguage($language_from);
			
			if($language_from_result) {
				$source_lang = strtoupper(mb_substr($language_from_result['code'], 0, 2));
			} else {
				$source_lang = false;
			}
		} else {
			$source_lang = false;
		}
	
		$auth_key = '03bc3846-4c28-c96c-439d-ef5445dca60c:fx';
	
		$ch = curl_init('https://api-free.deepl.com/v2/translate');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		
		$post = 'text=' . urlencode($text) . '&target_lang=' . $target_lang;
		
		if($source_lang) {
			$post .= '&source_lang=' . $source_lang;
		}
		
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

		$headers = array();
		$headers[] = 'Authorization: DeepL-Auth-Key ' . $auth_key ;
		$headers[] = 'Content-Type: application/x-www-form-urlencoded';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		
		$result = json_decode($result, true);
		
		curl_close($ch);
		
		if(!curl_errno($ch)) {
			return html_entity_decode($result['translations'][0]['text']);
		} else {
			return '';
		}
	}
}