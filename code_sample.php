<?php

require_once (dirname(__FILE__) . '/minebit_php_sdk/minebit.php');

const ACCESS_KEY = "aQ5rQg1RjgZKnttH6SRdURulcb8J9Y0F";
const SECRET_KEY = "165hB8OT2Hl8kDFUiiOR7cmqLAUbBh0n";
$client = new minebit(new minebit_authentication(ACCESS_KEY, SECRET_KEY));

//获取MineBit行情（盘口数据）
function minebit_ticker()
{
        global $client;
	    list($t1, $t2) = explode(' ', microtime());
	    $ts = (float)sprintf('%.0f',(floatval($t1)+floatval($t2))*1000);
        $params = array('coin' => 'btc', 'timestamp' => $ts);
        $result = $client->tickerApi($params);
        $res = $result->data;
        return $res;
}

$last = minebit_ticker();
var_dump($last)."\n";

?>
