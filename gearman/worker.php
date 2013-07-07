<?php  
$worker= new GearmanWorker();  
$worker->addServer("127.0.0.1", 4730);   
$worker->addFunction("test", "test_function");  
$worker->addFunction("test2", "test_function2");  
while ($worker->work());  
         
 function test_function($job)  
 {  
    $param = $job->workload(); 
	sleep(1); 
    return $param;  
  }  
 function test_function2($job)  
 {  
    $param = $job->workload(); 
	sleep(1); 
    return $param;  
}
