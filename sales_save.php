<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo"); 

$a1 = $_REQUEST['name'];
$f = $_REQUEST['qty'];

$discount = $_REQUEST['dis'];

$c = $_REQUEST['invoice'];
$type_q = 0;

$co = substr($c,0,2);

$result = $db->prepare("SELECT * FROM product WHERE product_id = '$a1' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
            $b = $row['name'];
			$d = $row['sell'];
			$g = $row['code'];
			$cost = $row['cost'];
			$type = $row['type'];
		}



if($co=="pu"){$d=$cost;}

$discount=($d/100)*$discount;

$d=$d-$discount;

$profit=$d-$cost;
$profit=$profit*$f;

$amount=$d*$f;
$discount=$discount*$f;

$date=date("Y-m-d");


// query
$sql = "INSERT INTO sales_list (product_id,name,invoice_no,price,dic,qty,code,profit,type,date,amount,cost) VALUES (:a,:b,:c,:d,:e,:f,:g,:pro,:type,:date,:amount,:cost)";
$ql = $db->prepare($sql);
$ql->execute(array(':a'=>$a1,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$discount,':f'=>$f,':g'=>$g,':pro'=>$profit,':type'=>$type,':date'=>$date,':amount'=>$amount,':cost'=>$cost));

if(isset($_REQUEST['end'])){
	header("location: app/sales.php?id=$c");
}else{
	header("location: sales.php?id=$c");
}



?>