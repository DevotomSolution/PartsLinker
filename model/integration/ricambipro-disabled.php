<?php
class ModelExtensionRicambipro extends Model {
	public function connect($customer_id) {
		return 1;
	}
	
	public function authenticate($username, $password, $secret) {
		$post = array('username' => $username, 'password' => $password, 'secret' => $secret);
	
		$ch = curl_init('https://ricambipro.it/api/v1/users/authenticate.php');

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
		
		$result = curl_exec($ch);
		$result = json_decode($result, true);
		
		if($result['success']) {
			return $result['data']['token'];
		} else {
			//return $result['error'];
			return false;
		}
	}
	
	public function checkToken($token) {
		$post = array('token' => $token);

		$ch = curl_init('https://ricambipro.it/api/v1/users/checkToken.php');

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
		
		$result = curl_exec($ch);
		$result = json_decode($result, true);
		

		if($result['success']) {
			return $result['data']['valid'];
		} else {
			return false;
		}
	}
	
	public function getProducts($token, $limit = 50, $offset = 0, $filters = array()) {
		$post = array('limit' => $limit, 'offset' => $offset, 'filters' => $filters);
		
		$ch = curl_init('https://ricambipro.it/api/v1/products/list.php');
		
		$authorization = 'WWW-Authorization: ' . $token;
		curl_setopt($ch, CURLOPT_HTTPHEADER, array($authorization));
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
		
		$result = curl_exec($ch);
		$result = json_decode($result, true);
		
		if($result['success']) {
			return $result['data'];
		} else {
			return $result['error'];
		}
	}
	
	public function postProduct($token, $data = array()) {
		$post = array();
		
		if(isset($data['quantity'])) {
			$post['quantity'] = (int) $data['quantity'];
		} else {
			return false;
		}
		
		if(isset($data['price'])) {
			$post['price'] = (float) $data['price'];
		} else {
			return false;
		}
		
		if(isset($data['prototypeId'])) {
			$post['prototypeId'] = (int) $data['prototypeId'];
		} else {
			return false;
		}
		
		if(isset($data['bundleId'])) {
			$post['bundleId'] = (int) $data['bundleId'];
		} else {
			return false;
		}
		
		if(isset($data['images']) and is_array($data['images'])) {
			$post['images'] = array_slice($data['images'], 0, 8);
		} else {
			return false;
		}
		
		if(isset($data['year'])) {
			$post['year'] = (int) $data['year'];
		} else {
			return false;
		}
		
		if(isset($data['cc'])) {
			$post['cc'] = (int) $data['cc'];
		} else {
			return false;
		}
		
		if(isset($data['engineType'])) {
			
			switch($data['engineType']) {
				case 'benzina':
					$post['engineType'] = 'benzina';
					break;
				case 'diesel':
					$post['engineType'] = 'diesel';
					break;
				case 'gas':
					$post['engineType'] = 'gas';
					break;
				case 'elettrica':
					$post['engineType'] = 'elettrica';
					break;
				case 'bipower':
					$post['engineType'] = 'bipower';
					break;
				case 'ibrida':
					$post['engineType'] = 'ibrida';
					break;
				default:
					return false;
			}

		} else {
			return false;
		}
		
		
		if(isset($data['manufacturerCode']) and $data['manufacturerCode'] !== '') {
			$post['manufacturerCode'] = $data['manufacturerCode'];
		}
		
		if(isset($data['notes']) and $data['notes'] !== '') {
			$post['notes'] = $data['notes'];
		}
		
		if(isset($data['onlineshopsNotes']) and $data['onlineshopsNotes'] !== '') {
			$post['onlineshopsNotes'] = $data['onlineshopsNotes'];
		}
		
		if(isset($data['position']) and $data['position'] !== '') {
			$post['position'] = $data['position'];
		}
		
		if(isset($data['internalCode']) and $data['internalCode'] !== '') {
			$post['internalCode'] = $data['internalCode'];
		}
		
		if(isset($data['facebook']) and $data['facebook'] !== '') {
			$post['facebook'] = (boolean) $data['facebook'];
		}
		
		if(isset($data['twitter']) and $data['twitter'] !== '') {
			$post['twitter'] = (boolean) $data['twitter'];
		}
		
		if(isset($data['plate']) and $data['plate'] !== '') {
			$post['plate'] = $data['plate'];
		}
		
		if(isset($data['chassis']) and $data['chassis'] !== '') {
			$post['chassis'] = $data['chassis'];
		}
		
		if(isset($data['engineCode']) and $data['engineCode'] !== '') {
			$post['engineCode'] = $data['engineCode'];
		}
		
		if(isset($data['km']) and $data['km'] !== '') {
			$post['km'] = $data['km'];
		}
		
		if(isset($data['kw']) and $data['kw'] !== '') {
			$post['kw'] = $data['kw'];
		}
		
		if(isset($data['online']) and $data['online'] !== '') {
			$post['online'] = (boolean) $data['online'];
		}
		
		$ch = curl_init('https://ricambipro.it/api/v1/warehouses/quickLoad.php');
		
		$authorization = 'WWW-Authorization: ' . $token;
		curl_setopt($ch, CURLOPT_HTTPHEADER, array($authorization));
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
		
		$result = curl_exec($ch);
		$result = json_decode($result, true);
		
		if($result['success']) {
			return $result['data']['id'];
		} else {
			return $result['error'];
		}
	}
	
	
	public function editProduct($token, $id, $data = array()) {
		$post = array();
		
		if(isset($data['online'])) {
			$post['online'] = (boolean) $data['online'];
		}
		
		if(isset($data['price'])) {
			$post['price'] = (float) $data['price'];
		}
		
		if(isset($data['position'])) {
			$post['position'] = $data['position'];
		}
		
		$post['productId'] = (int) $id;
		
		$ch = curl_init('https://ricambipro.it/api/v1/products/edit.php');
		
		$authorization = 'WWW-Authorization: ' . $token;
		curl_setopt($ch, CURLOPT_HTTPHEADER, array($authorization));
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
		
		$result = curl_exec($ch);
		$result = json_decode($result, true);
		
		return $result['success'];
	}
	
	public function editProductStock($token, $id, $quantity) {
		$post = array(
			'productId' => $id,
			'quantity'  => $quantity,
		);
		
		$ch = curl_init('https://ricambipro.it/api/v1/warehouses/movement.php');
		
		$authorization = 'WWW-Authorization: ' . $token;
		curl_setopt($ch, CURLOPT_HTTPHEADER, array($authorization));
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
		
		$result = curl_exec($ch);
		$result = json_decode($result, true);
		
		return $result['success'];
	}
	
	public function getBundles() {
		$query = $this->db->query("SELECT * FROM ricambipro_bundle");
		return $query->rows;
	}
	
	public function getPrototypes() {
		$query = $this->db->query("SELECT * FROM ricambipro_prototypes");
		return $query->rows;
	}
	
	public function getEngines() {
		$query = $this->db->query("SELECT * FROM ricambipro_engines");
		return $query->rows;
	}
	
	public function updateBundles() {
		$post = array('limit' => 999999, 'offset' => 0);

		$ch = curl_init('https://ricambipro.it/api/v1/products/bundles.php');

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
		
		$result = curl_exec($ch);
		
		$result = json_decode($result, true);
	}
	
}