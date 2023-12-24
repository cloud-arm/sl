<?php
session_start();
include('connect.php');
$a1 = $_POST['name'];



$sql = "INSERT INTO manufacture (name) VALUES (?)";
$ql = $db->prepare($sql);
$ql->execute(array($a1));




if(isset($_POST['end'])){
    header("location: app/customer_add.php");
   }else{
    header("location: cus.php");
   }
?>