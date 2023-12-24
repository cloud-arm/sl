<?php
session_start();
include('connect.php');

$a = $_POST['name'];
$vehicle = $_POST['vehicle_no'];

$phone = $_POST['contact'];

$id= $_POST['id'];
$email=$_POST['email'];
$address=$_POST['address'];
$model_id=$_POST['model'];

$cus_id=$_POST['cus_id'];


$result = $db->prepare("SELECT * FROM model WHERE id='$model_id' ");
$result->bindParam(':userid', $res);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){ $model=$row['name']; }


$sql = "UPDATE customer 
        SET customer_name=?,address=?,email=?,contact=?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($a,$address,$email,$phone,$cus_id));



$sql = "UPDATE vehicle 
        SET customer_name=?,vehicle_no=?,model_id=?,model=?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($a,$vehicle,$model_id,$model,$id));



header("location: profile.php?id=$id");


?>