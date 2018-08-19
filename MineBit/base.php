<?php

if (!function_exists('curl_init')) {
	throw new Exception('The MineBit client library requires the CURL PHP extension.');
}

require_once (dirname(__FILE__) . '/exception.php');
require_once (dirname(__FILE__) . '/requestor.php');
require_once (dirname(__FILE__) . '/rpc.php');
require_once (dirname(__FILE__) . '/authentication.php');

class minebit_base {
	
	const WEB_BASE = 'https://api-test.minebit.com/';//API测试接口

	//const WEB_BASE = 'https://api.minebit.com/';//API正式接口

	
	private $_rpc;
	private $_authentication;

	public function __construct($authentication) {
		if (is_a($authentication, 'minebit_authentication')) {
			$this -> _authentication = $authentication;
		} else {
			throw new minebit_exception('Could not determine API authentication scheme');
		}
		$this -> _rpc = new minebit_rpc(new minebit_requestor(), $this -> _authentication);
	}

	public function setRequestor($requestor) {
		$this -> _rpc = new minebit_rpc($requestor, $this -> _authentication);
		return $this;
	}

	public function get($path, $params = array()) {
		return $this -> _rpc -> request("GET", $path, $params);
	}

	public function post($path, $params = array()) {
		return $this -> _rpc -> request("POST", $path, $params);
	}
}

?>
