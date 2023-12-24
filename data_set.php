<?php
session_start();
include('connect.php');

$result1 = $db->prepare("SELECT * FROM sales ");
		$result1->bindParam(':userid', $a1);
		$result1->execute();
		for($i=0; $row1 = $result1->fetch(); $i++){
		$invo=$row1['transaction_id'];
		$cus_id=$row1['customer_id'];
		$vid=0;

		$result = $db->prepare('SELECT * FROM vehicle WHERE  customer_id=:id ');
		$result->bindParam(':id', $cus_id);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){ $vid=$row['id']; }
		
	echo $cus_id.'__'.$vid.'<br>';	

			
$sql = "UPDATE sales 
        SET vehicle_id=? 
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($vid,$invo));		
		
		}


$qty=10;



?>