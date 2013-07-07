<?php  
$client= new GearmanClient();  


$client->addServer("127.0.0.1", 4730);  
$client->doBackground('test', 'hehe');
echo 'done';
exit;
$client->setCompleteCallback('callback');
$client->addTask('test', 'hello');
$client->addTask('test2', 'world');
$client->addTask('test', 'hello');
$client->addTask('test2', 'world');

$client->runTasks();

function callback($task) {
	echo "<pre>";
	print_r(array("handle"=>$task->jobHandle(), "data"=>$task->data()));
	echo "</pre>";

}
  
