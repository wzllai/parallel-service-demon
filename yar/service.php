<?php

/**
 * this is a test service for Yar
 * @author hyq
*/
class ServiceTest
{
	private $a;


	public function __construct($array){
		return $array;
	}	
	
	
	
	/**
	* @author hyq
 	* this is a test fucntion for testing
 	* the function receive an array argument and then return its count
	* @author hyq
	*	
	* @array $param
	* @return int
	*/
	public function test($param){
		sleep(1);
		return count($param);
	}
	
	/**
	* @author hyq
 	* this is a test fucntion for testing
 	* the function receive an array argument and then return its first element
	* @author hyq
	*	
	* @array $param
	* @return mixed
	*/
	public function test2($param){
		sleep(1);
		return $param[0];
	}

	public function test3($param){
		sleep(1);
		return $param[0];
	}
}

$service = @new Yar_Server(new ServiceTest());
$service->handle();
