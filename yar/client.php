<?php
$api 	= "http://127.0.0.1/yar/service.php";

#$client = new Yar_Client($api);
$param	= array(1,2,3);
#$ret 	= $client->test($param);
#$ret 	= $client->test2($param);

function callback($retval, $callinfo){
	echo "<pre>";
	var_dump($retval, $callinfo);
	echo "</pre>";
}
$squ = Yar_Concurrent_Client::call($api, 'test', array($param), 'callback');
$squ2 = Yar_Concurrent_Client::call($api, 'test2', array($param), 'callback');
$squ3 = Yar_Concurrent_Client::call($api, 'test3', array($param), 'callback');
Yar_Concurrent_Client::loop();
var_dump($squ, $squ2, $squ3);
