<?php
session_start();
include('connect.php');

$result1 = $db->prepare("SELECT * FROM sales JOIN vehicle ON vehicle.customer_id = sales.customer_id ");
		$result1->bindParam(':userid', $a1);
		$result1->execute();
		for($i=0; $row1 = $result1->fetch(); $i++){
		$invo=$row1['transaction_id '];
		$cus_id=$row1['id'];
		
	echo $cus_id.'__'.$invo.'<br>';	

			
$sql = "UPDATE sales 
        SET vehicle_id=? 
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($cus_id,$invo));		
		
		}


$qty=10;



?>