<?php

session_start();

include('connect.php');

date_default_timezone_set("Asia/Colombo"); 



$a1 = $_POST['name'];

//$d = $_POST['km'];
$comment = $_POST['comment'];
$type = "";
$mechanic=0;


$result = $db->prepare("SELECT * FROM vehicle WHERE id = '$a1' ");

		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
            $c = $row['customer_name'];
			 $model = $row['model'];
			$a = $row['vehicle_no'];
		}
$result = $db->prepare("SELECT * FROM job WHERE vehicle_no = '$a' and type='active' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
			$d = $row['km'];
			$mechanic = $row['mechanic_id'];
			$job_no=$row['id'];
			$job_type=$row['job_type'];
			$b=$row['invoice_no'];
		}

$result = $db->prepare("SELECT * FROM sales WHERE vehicle_no = '$a' and job_no='$job_no' and action='' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
            $old_invo = $row['invoice_number'];	
            
		}

if($old_invo>0){
    

 }else{


$e = date("Y-m-d");

$f = $_SESSION['SESS_FIRST_NAME'];



// query

$sql = "INSERT INTO sales (vehicle_no,invoice_number,customer_name,km,date,cashier,comment,type,customer_id,model,mechanic,job_no,job_type) VALUES (:a,:b,:c,:d,:e,:f,:j,:type,:cus_id,:model,:mech,:job,:job_type)";

$ql = $db->prepare($sql);

$ql->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$e,':f'=>$f,':j'=>$comment,':type'=>$type,':cus_id'=>$a1,':model'=>$model,':mech'=>$mechanic,':job'=>$job_no,':job_type'=>$job_type));
}
header("location: sales.php?id=$b");
?>
