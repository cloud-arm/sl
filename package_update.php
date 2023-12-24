<?php 
include('connect.php');

$name=$_POST['name'];
$type=$_POST['type'];
$amount=$_POST['amount'];
$model=$_POST['model'];
$d1=$_POST['d1'];
$d2=$_POST['d2'];

$pack_id=$_POST['pack_id'];

if($model> 0){$result = $db->prepare("SELECT * FROM model WHERE id='$model'");
    $result->bindParam(':userid', $res);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){ $model_name=$row['name']; }
}else{
    $model=0;
    $model_name="All models";
}


$sql = "UPDATE package 
        SET name=?,type=?,start_date=?,end_date=?,model=?,amount=?,model_id=?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($name,$type,$d1,$d2,$model_name,$amount,$model,$pack_id));





header("location: package.php");
?>