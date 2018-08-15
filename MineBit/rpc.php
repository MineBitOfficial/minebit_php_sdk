<?php

class minebit_rpc{
	private $_requestor;
	private $_authentication;

	public function __construct($requestor, $authentication) {
		$this -> _requestor = $requestor;
		$this -> _authentication = $authentication;
	}

	public function request($method, $url, $params) {
		// Initialize CURL
		$ch = curl_init();
		// $curl = curl_init();
		$curlOpts = array();

		// Headers
		$headers = array('User-Agent: MineBit-PHP-SDK/v1');

		//GET USER APIKEY
		$auth = $this -> _authentication -> getData();

		// HTTP method
		$method = strtolower($method);
		if ($method == 'get') {
			curl_setopt($ch, CURLOPT_HTTPGET, 1);
			if ($params != null) {
				$queryString = http_build_query($params);
				$url .= "?" . $queryString;
			}
		} else if ($method == 'post') {
			$authenticationClass = get_class($this -> _authentication);

			switch ($authenticationClass) {

				case 'minebit_authentication' :
					ksort($params);
					$sign = "";
					while ($key = key($params)) {
						$sign .= $key . "=" . $params[$key] . "&";
						next($params);
					}
					$sign = $sign . "secretkey=" . $auth -> apiKeySecret;
					$sign = strtoupper(md5($sign));
					$params['signature'] = $sign;
					break;
				default :
					throw new minebit_exception("Invalid authentication mechanism");
					break;
			}

			curl_setopt($ch, CURLOPT_POST, 1);

			// Create query string
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
		}

		// CURL options
		curl_setopt($ch, CURLOPT_URL, substr(minebit_base::WEB_BASE, 0, -1) . $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);


		// Do request
		$response = $this -> _requestor -> doCurlRequest($ch);
		// Decode response
		try {
			$body = $response['body'];
			$json = json_decode($body);
		} catch (Exception $e) {
			echo "Invalid response body" . $response['statusCode'] . $response['body'];
		}
		if ($json === null) {
			echo "Invalid response body" . $response['statusCode'] . $response['body'];
		}
		if (isset($json -> error)) {
			throw new minebit_exception($json -> error, $response['statusCode'], $response['body']);
		} else if (isset($json -> errors)) {
			throw new minebit_exception(implode($json -> errors, ', '), $response['statusCode'], $response['body']);
		}
		return $json;
	}
}
