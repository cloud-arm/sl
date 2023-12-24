<?php
session_start();
include('connect.php');

$result1 = $db->prepare("SELECT * FROM sales_temp JOIN customer ON sales_temp.cus_id = customer.cus_id ");
		$result1->bindParam(':userid', $a1);
		$result1->execute();
		for($i=0; $row1 = $result1->fetch(); $i++){
		$invo=$row1['invo'];
		$cus_id=$row1['id'];
		
	echo $cus_id.'--<br>';	

			
$sql = "UPDATE sales 
        SET customer_id=? 
		WHERE invoice_number=?";
// $q = $db->prepare($sql);
// $q->execute(array($cus_id,$invo));		
		
		}


$qty=10;



?>