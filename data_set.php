<?php
session_start();
include('connect.php');

$result1 = $db->prepare("SELECT * FROM supplier ");
		$result1->bindParam(':userid', $a1);
		$result1->execute();
		for($i=0; $row1 = $result1->fetch(); $i++){
		$invo=$row1['id'];
		$cus=$row1['old_id'];


		
	echo $cus.'__'.$invo.'<br>';	

			
$sql = "UPDATE purchases 
        SET supplier_id=? 
		WHERE suplier_invoice=?";
$q = $db->prepare($sql);
$q->execute(array($invo,$cus));		
		
		}


$qty=10;



?>