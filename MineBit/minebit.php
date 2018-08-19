<?php
require_once (dirname(__FILE__) . '/base.php');

class minebit extends minebit_base{

	function __construct($authentication) {
		parent::__construct($authentication);
	}

	//MineBit ticker
	public function tickerApi($params = null) {
		return $this -> post("/openapi/v1/market/quote", $params);
	}
	
	//place an order
	public function tradeApi($params = null) {
		return $this -> post("/openapi/v1/trade/order", $params);
	}


	//cancel an order
	public function cancelOrderApi($params = null) {
		return $this -> post("/openapi/v1/trade/cancel_order", $params);
	}

	//get order info 
	public function orderInfoApi($params = null) {
		return $this -> post("/openapi/v1/trade/order_info", $params);
	}

	//get finished orders 
	public function orderInfoApi($params = null) {
		return $this -> post("/openapi/v1/trade/finished_orders", $params);
	}

	//get pending orders
	public function orderInfoApi($params = null) {
		return $this -> post("/openapi/v1/trade/pending_orders", $params);
	}


	//get market depth
	public function depthApi($params = null) {
		return $this -> post("/openapi/v1/market/depth", $params);
	}

	//get user asset 
	public function depthApi($params = null) {
		return $this -> post("/openapi/v1/userasset/balance", $params);
	}

	//withdrawl
	public function withdrawApi($params = null) {
		return $this -> post("/openapi/v1/wallet/withdraw", $params);
	}
	
	//cancel withdrawl
	public function cancelWithdrawApi($params = null) {
		return $this -> post("/openapi/v1/wallet/cancel_withdraw", $params);
	}
}
