<?php 
session_start();

include('../connect.php'); 


$phone=$_GET["vehicle_no"];

$name='nott';

$result = $db->prepare("SELECT * FROM vehicle WHERE vehicle_no='$phone' ");
$result->bindParam(':userid', $res);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$name=$row['vehicle_no'];
}

if($name =='nott'){$response = array('action'=>'false');
}else{
$response = array('action'=>'true');
}


	$json_response = json_encode($response);
	echo $json_response;
?>