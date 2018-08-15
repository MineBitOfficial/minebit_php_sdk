<?php
require_once (dirname(__FILE__) . '/base.php');

class minebit extends minebit_base{

	function __construct($authentication) {
		parent::__construct($authentication);
	}

	//获取MineBit行情
	public function tickerApi($params = null) {
		return $this -> post("/openapi/v1/market/quote", $params);
	}
	
	//下单交易
	public function tradeApi($params = null) {
		return $this -> post("/openapi/v1/trade/order", $params);
	}


	//撤销订单
	public function cancelOrderApi($params = null) {
		return $this -> post("/openapi/v1/trade/cancel_order", $params);
	}

	//获取用户的订单信息
	public function orderInfoApi($params = null) {
		return $this -> post("/openapi/v1/trade/order_info", $params);
	}


	//获取市场深度
	public function depthApi($params = null) {
		return $this -> post("/openapi/v1/trade/depth", $params);
	}
	//提币
	public function withdrawApi($params = null) {
		return $this -> post("/openapi/v1/wallet/withdraw", $params);
	}
	
	//取消提币
	public function cancelWithdrawApi($params = null) {
		return $this -> post("/openapi/v1/wallet/cancel_withdraw", $params);
	}

	//获取美元人民币汇率
	public function getUSD2CNYRateApi($params = null) {
		return $this -> post("/openapi/v1/market/change_rate", $params);
	}

}
