<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");
$id = $_POST['id'];

$qty = $_POST['qty'];
//$c = $_POST['cus_name'];



$result = $db->prepare("SELECT * FROM product WHERE product_id = '$id' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
        $name = $row['name'];	
		$code = $row['code'];
			
		$qty1 = $row['qty'];
		}
if($qty==""){$qty=$qty1;}






$date=date("Y-m-d");
$sql = "UPDATE product 
        SET date=?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($date,$id));

		
$sql = "UPDATE product 
        SET qty=?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($qty,$id));






$cashi = $_SESSION['SESS_FIRST_NAME'];

$sql = "INSERT INTO stock_up (name,code,qty,com_qty,date,user) VALUES (:a,:b,:c,:d,:e,:f)";
$ql = $db->prepare($sql);
$ql->execute(array(':a'=>$name,':b'=>$code,':c'=>$qty,':d'=>'0',':e'=>$date,':f'=>$cashi));




header("location: stock_up.php");


?>