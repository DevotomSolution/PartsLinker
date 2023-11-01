<?php
namespace Opencart\Catalog\Model\Info;
class Label extends \Opencart\System\Engine\Model {
	public function getLabels() {
		$labels = array(
			array(
				'code' => 0,
				'title' => '70x30',
				'label_width' => '264',
				'label_height' => '113',
				'barcode_width' => '1.5',
				'barcode_height' => '68',
				'qrcode_size' => '108',
				'font_size' => '35',
				'label_type' => '1',
			),
			array(
				'code' => 1,
				'title' => '90x30',
				'label_width' => '340',
				'label_height' => '108',
				'barcode_width' => '2',
				'barcode_height' => '52',
				'qrcode_size' => '104',
				'font_size' => '49',
				'label_type' => '1',
			),
			array(
				'code' => 2,
				'title' => '60x40',
				'label_width' => '226',
				'label_height' => '151',
				'barcode_width' => '1.2',
				'barcode_height' => '96',
				'qrcode_size' => '96',
				'font_size' => '49',
				'label_type' => '2',
			),
			array(
				'code' => 3,
				'title' => '50x30',
				'label_width' => '189',
				'label_height' => '113',
				'barcode_width' => '1',
				'barcode_height' => '69',
				'qrcode_size' => '96',
				'font_size' => '24',
				'label_type' => '1',
			),
		);
		
		return $labels;
	}
	
	public function getLabel($code) {
		$labels = $this->getLabels();
		
		if(!isset($labels[$code])) {
			return false;
		}
		
		return $labels[$code];
	}
}
