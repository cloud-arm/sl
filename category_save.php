<?php
session_start();
include('connect.php');
$a1 = $_POST['name'];



$sql = "INSERT INTO catogary_list (name) VALUES (?)";
$ql = $db->prepare($sql);
$ql->execute(array($a1));




if(isset($_POST['end'])){
    header("location: app/product.php");
   }else{
    header("location: product.php");
   }
?>