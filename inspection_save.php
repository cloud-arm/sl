<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");


$type=$_POST['type'];
$name=$_POST['name']; 


//echo $customer_name;

$sql = "INSERT INTO job_inspection (name,type,cat) VALUES (?,?,?)";
$q = $db->prepare($sql);
$q->execute(array($name,'2',$type));


header("location: inspection.php");

?>