<?php
namespace Opencart\Catalog\Model\Integration\Delivery;
class Fancourier extends \Opencart\System\Engine\Model {
    private $api_url = 'https://api.dpd.ro/v1/';

    public function getStorage($user_id) {
        $this->load->model('integration/delivery/delivery');

        return $this->model_integration_delivery_delivery->getStorage($user_id, 'dpdro');
    }

    public function editStorage($user_id, $storage) {
        $this->load->model('integration/delivery/delivery');

        $this->model_integration_delivery_delivery->editStorage($user_id, 'dpdro', $storage);
    }

    public function connect($user_id, $rewrite = false) {
        if (isset($this->session->data['dpdro']['connected']) and !$rewrite) {
            return $this->session->data['dpdro']['connected'];
        }

        $this->session->data['dpdro'] = array();

        $this->session->data['dpdro']['connected'] = 0;

        $this->load->model('integration/delivery/delivery');

        $storage = $this->getStorage($user_id, 'dpdro');

        if (!isset($storage['username']) or !isset($storage['password'])) {
            return 0;
        }

        $this->session->data['dpdro'] = $storage;

        $this->session->data['dpdro']['connected'] = 0;

        $response = $this->getServices();

        if (empty($response)) {
            return 0;
        }

        $this->session->data['dpdro']['connected'] = 1;

        return 1;
    }

    public function createShipment($post) {
        if (!isset($this->session->data['dpdro']['username']) or !isset($this->session->data['dpdro']['password'])) {
            return false;
        }

        $post['userName'] = $this->session->data['dpdro']['username'];
        $post['password'] = $this->session->data['dpdro']['password'];

        $result = $this->dpdRequest('shipment', $post);

        $result = json_decode($result, true);

        return $result;
    }

    public function getCountries($name = '') {
        if (!isset($this->session->data['dpdro']['username']) or !isset($this->session->data['dpdro']['password'])) {
            return false;
        }

        $post = array(
            'userName' => $this->session->data['dpdro']['username'],
            'password' => $this->session->data['dpdro']['password'],
            'name' => $name,
        );

        $result = $this->dpdRequest('location/country', $post);

        $result = json_decode($result, true);

        if (isset($result['countries'])) {
            return $result['countries'];
        } else {
            return false;
        }
    }

    public function getStates($country_id, $name = '') {
        if (!isset($this->session->data['dpdro']['username']) or !isset($this->session->data['dpdro']['password'])) {
            return false;
        }

        $post = array(
            'userName'	=> $this->session->data['dpdro']['username'],
            'password'	=> $this->session->data['dpdro']['password'],
            'countryId'	=> (int) $country_id,
            'name'		=> $name,
        );

        $result = $this->dpdRequest('location/state', $post);

        $result = json_decode($result, true);

        if (isset($result['states'])) {
            return $result['states'];
        } else {
            return false;
        }
    }

    public function getSites($country_id, $name = '') {
        if (!isset($this->session->data['dpdro']['username']) or !isset($this->session->data['dpdro']['password'])) {
            return false;
        }

        $post = array(
            'userName'	=> $this->session->data['dpdro']['username'],
            'password'	=> $this->session->data['dpdro']['password'],
            'countryId'	=> (int) $country_id,
            'name'		=> $name,
        );

        $result = $this->dpdRequest('location/site', $post);

        $result = json_decode($result, true);

        if (isset($result['sites'])) {
            return $result['sites'];
        } else {
            return false;
        }
    }

    public function getStreets($site_id, $name = '') {
        if (!isset($this->session->data['dpdro']['username']) or !isset($this->session->data['dpdro']['password'])) {
            return false;
        }

        $post = array(
            'userName'	=> $this->session->data['dpdro']['username'],
            'password'	=> $this->session->data['dpdro']['password'],
            'siteId'	=> (int) $site_id,
            'name'		=> $name,
        );

        $result = $this->dpdRequest('location/street', $post);

        $result = json_decode($result, true);

        if (isset($result['streets'])) {
            return $result['streets'];
        } else {
            return false;
        }
    }

    public function getServices() {
        if (!isset($this->session->data['dpdro']['username']) or !isset($this->session->data['dpdro']['password'])) {
            return false;
        }

        $username = $this->session->data['dpdro']['username'];

        if (isset($this->session->data['dpdro'][$username]['services'])) {
            return $this->session->data['dpdro'][$username]['services'];
        }

        $post = array(
            'userName'	=> $this->session->data['dpdro']['username'],
            'password'	=> $this->session->data['dpdro']['password'],
        );

        $result = $this->dpdRequest('services', $post);

        $result = json_decode($result, true);

        if (isset($result['services'])) {
            $this->session->data['dpdro'][$username]['services'] = $result['services'];

            return $result['services'];
        } else {
            return false;
        }
    }

    public function getContractClients() {
        if (!isset($this->session->data['dpdro']['username']) or !isset($this->session->data['dpdro']['password'])) {
            return false;
        }

        $username = $this->session->data['dpdro']['username'];

        if (isset($this->session->data['dpdro'][$username]['clients'])) {
            return $this->session->data['dpdro'][$username]['clients'];
        }

        $post = array(
            'userName'	=> $username,
            'password'	=> $this->session->data['dpdro']['password'],
        );

        $result = $this->dpdRequest('client/contract', $post);

        $result = json_decode($result, true);

        if (isset($result['clients'])) {
            $this->session->data['dpdro'][$username]['clients'] = $result['clients'];

            return $result['clients'];
        } else {
            return false;
        }
    }

    public function validateShipment($post) {
        if (!isset($this->session->data['dpdro']['username']) or !isset($this->session->data['dpdro']['password'])) {
            return false;
        }

        $post['userName'] = $this->session->data['dpdro']['username'];
        $post['password'] = $this->session->data['dpdro']['password'];

        $result = $this->dpdRequest('validation/shipment', $post);

        $result = json_decode($result, true);

        return $result;
    }

    public function getLabel($shipment_id) {
        if (!isset($this->session->data['dpdro']['username']) or !isset($this->session->data['dpdro']['password'])) {
            return false;
        }

        $post['userName'] = $this->session->data['dpdro']['username'];
        $post['password'] = $this->session->data['dpdro']['password'];
        $post['paperSize'] = 'A4';
        $post['parcels'] = array(array('parcel' => array('id' => $shipment_id)));

        $result = $this->dpdRequest('print', $post);

        return $result;
    }

    /*
    public function getAllCountries() {
        if (!isset($this->session->data['dpdro']['username']$this->session->data['dpdro']['username']) or !isset($this->session->data['dpdro']['password'])) {
            return false;
        }

        $post = array(
            'userName' => $this->session->data['dpdro']['username'],
            'password' => $this->session->data['dpdro']['password'],
        );

        $response = $this->dpdRequest('location/country/csv', $post);

        $tmpfile = tmpfile();

        fwrite($tmpfile, $response);

        unset($response);

        fseek($tmpfile, 0);

        $key_str = fgetcsv($tmpfile);

        $result = array();

        while($str = fgetcsv($tmpfile)) {
            $result[] = array('id' => $str[0], 'name' => $str[2], 'iso3' => $str[4], 'requireState' => $str[6], 'addressType' => $str[7]);
        }

        fclose($tmpfile);

        return $result;
    }

    public function getAllStates($country_id) {
        if (!isset($this->session->data['dpdro']['username']) or !isset($this->session->data['dpdro']['password'])) {
            return false;
        }

        $post = array(
            'userName' => $this->session->data['dpdro']['username'],
            'password' => $this->session->data['dpdro']['password'],
        );

        $response = $this->dpdRequest('location/state/csv/' . (int) $country_id, $post);

        $tmpfile = tmpfile();

        fwrite($tmpfile, $response);

        unset($response);

        fseek($tmpfile, 0);

        $key_str = fgetcsv($tmpfile);

        $result = array();

        while($str = fgetcsv($tmpfile)) {
            $result[] = array('id' => $str[0], 'name' => $str[2]);
        }

        fclose($tmpfile);

        return $result;
    }

    public function getAllSites($country_id) {
        if (!isset($this->session->data['dpdro']['username']) or !isset($this->session->data['dpdro']['password'])) {
            return false;
        }

        $post = array(
            'userName' => $this->session->data['dpdro']['username'],
            'password' => $this->session->data['dpdro']['password'],
        );

        $response = $this->dpdRequest('location/site/csv/' . (int) $country_id, $post);

        $tmpfile = tmpfile();

        fwrite($tmpfile, $response);

        unset($response);

        fseek($tmpfile, 0);

        $key_str = fgetcsv($tmpfile);

        $result = array();

        while($str = fgetcsv($tmpfile)) {
            $result[] = array('id' => $str[0], 'name' => $str[6]);
        }

        fclose($tmpfile);

        return $result;
    }
    */

    private function dpdRequest($action, $post) {
        $curl = curl_init($this->api_url . $action);

        $headers = array(
            'Content-type: application/json;  charset=utf-8',
        );

        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($post));
        curl_setopt($curl, CURLOPT_TIMEOUT, 5);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }
}