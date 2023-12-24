<?php
session_start();
include('connect.php');
$a1 = $_POST['model'];
$com=$_POST['com'];

$result = $db->prepare("SELECT * FROM manufacture WHERE id='$com' ");
            $result->bindParam(':userid', $res);
            $result->execute();
            for($i=0; $row = $result->fetch(); $i++){ $com_name=$row['name']; }


$sql = "INSERT INTO model (name,manufacture_name,manufacture) VALUES (?,?,?)";
$ql = $db->prepare($sql);
$ql->execute(array($a1,$com_name,$com));




if(isset($_POST['end'])){
    header("location: app/customer_add.php");
   }else{
    header("location: cus.php");
   }
?>