<?php

/**
 * this is a test service for Yar
 * @author hyq
*/
class ServiceTest
{
	public function test(){
		sleep(3);
		return 'function test:sleep 3s-----' ;
	}
	
	public function test2(){
		sleep(2);
		return 'function test2:sleep 2s' ;
	}

}

$service = new ServiceTest();
$function = $_GET['function'];
echo call_user_func(array($service, $function));
