<?php
session_start();
include('connect.php');
$a1 = $_POST['invoice'];
$ar = $_POST['amount'];
$type = $_POST['type'];
$note = $_POST['note'];
$discount= $_POST['discount'];
$email=$_POST['email'];
$km=$_POST['km'];
date_default_timezone_set("Asia/Colombo"); 

$act=1;
$sql = "UPDATE sales_list 
        SET action=?
		WHERE invoice_no=?";
$q = $db->prepare($sql);
$q->execute(array($act,$a1));

$result = $db->prepare("SELECT sum(amount) FROM sales_list WHERE invoice_no = '$a1' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
            $a = $row['sum(amount)'];	
		}


$result = $db->prepare("SELECT sum(profit) FROM sales_list WHERE invoice_no = '$a1' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
        $profit = $row['sum(profit)'];	
		}


$result = $db->prepare("SELECT sum(amount) FROM sales_list WHERE invoice_no = '$a1' and type='Service'");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
        $labor_cost = $row['sum(amount)'];	
		}




$result = $db->prepare("SELECT * FROM sales_list WHERE invoice_no = '$a1' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
        $id = $row['product_id'];
		$qty = $row['qty'];
			
$sql = "UPDATE product 
        SET qty=qty-?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($qty,$id));
		}




$result = $db->prepare("SELECT * FROM hold_amount WHERE date_sum='' ORDER by id DESC limit 0,1 ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
        $hold_id = $row['id'];
		$hold_date = date("Y-m-d");
			
$sql = "UPDATE hold_amount 
        SET date_sum=?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($hold_date,$hold_id));
		}
$result = $db->prepare("SELECT * FROM hold_amount WHERE date_sum='$hold_date' and date='$hold_date' ORDER by id DESC limit 0,1 ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
        $hold_id = $row['id'];
		$hold_date1 ="";
			
$sql = "UPDATE hold_amount 
        SET date_sum=?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($hold_date1,$hold_id));
		}


$result1 = $db->prepare("SELECT * FROM sales WHERE invoice_number='$a1' ");
		$result1->bindParam(':userid', $a1);
		$result1->execute();
		for($i=0; $row1 = $result1->fetch(); $i++){
		$job_no=$row1['job_no'];	
		$customer_id=$row1['customer_id'];
		}

$result1 = $db->prepare("SELECT * FROM job WHERE id='$job_no' ");
		$result1->bindParam(':userid', $a1);
		$result1->execute();
		for($i=0; $row1 = $result1->fetch(); $i++){
		$mechanic_id=$row1['mechanic_id'];	
		}

$result1 = $db->prepare("SELECT * FROM mechanic WHERE id='$mechanic_id' ");
		$result1->bindParam(':userid', $a1);
		$result1->execute();
		for($i=0; $row1 = $result1->fetch(); $i++){
		$mechanic=$row1['name'];	
		}
//$mechanic_id=1;

$a=$a-$discount;
$b = $ar-$a;

$sale_total_ds=$ar-$discount;

$c = "active";
$date=date("Y-m-d");
$time=date('H:i:s');

$credit=0;
if($a > $sale_total_ds){
	$credit=$a-$ar;
}

// query
$sql = "UPDATE  sales SET amount=?,balance=?,action=?,profit=?,labor_cost=?,pay_type=?,date=?,mechanic_id=?,mechanic=?,email=?,plus_km=?,comment=?,time=?,credit=?,credit_left=?,sales_discount=? WHERE invoice_number=?";
$ql = $db->prepare($sql);
$ql->execute(array($a,$b,$c,$profit,$labor_cost,$type,$date,$mechanic_id,$mechanic,$email,$km,$note,$time,$credit,$credit,$discount,$a1));

$result1 = $db->prepare("SELECT * FROM sales WHERE invoice_number='$a1' ");
		$result1->bindParam(':userid', $a1);
		$result1->execute();
		for($i=0; $row1 = $result1->fetch(); $i++){
		$vehicle_no=$row1['vehicle_no'];	
		}
$job_type="Close";
$sql = "UPDATE job 
        SET type=?
		WHERE vehicle_no=?";
$q = $db->prepare($sql);
$q->execute(array($job_type,$vehicle_no));
$credit_sms='';
$result1 = $db->prepare("SELECT sum(credit) FROM sales WHERE customer_id='$customer_id' ");
		$result1->bindParam(':userid', $a1);
		$result1->execute();
		for($i=0; $row1 = $result1->fetch(); $i++){	
		$credit_balance=$row1['sum(credit)'];
		}

		if($type=="Credit"){
			$credit_sms="Credit balance Rs.".$credit_balance;
		}


//*********************** SMS  **********************/
$result = $db->prepare('SELECT * FROM customer WHERE  id=:id ');
$result->bindParam(':id', $customer_id);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){ 
    $contact=$row['contact'];
	$cus_name=$row['customer_name'];
 }

 $contact='94'.substr($contact,-9);

$sms="Now your car is Clean and Shine. 
Your invoice amount is Rs.".$a."
".$credit_sms."
Thank you. 
See you Soon";

//$contact="94779252594";	

$url="https://api.getshoutout.com/coreservice/messages";
$auth_token="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJqdGkiOiIxN2RhNDNkMC0wZDAxLTExZWEtODE2MC0xNWRkYTBlYTcwOTEiLCJzdWIiOiJTSE9VVE9VVF9BUElfVVNFUiIsImlhdCI6MTU3NDQxMDg5MywiZXhwIjoxODkwMDMwMDkzLCJzY29wZXMiOnsiYWN0aXZpdGllcyI6WyJyZWFkIiwid3JpdGUiXSwibWVzc2FnZXMiOlsicmVhZCIsIndyaXRlIl0sImNvbnRhY3RzIjpbInJlYWQiLCJ3cml0ZSJdfSwic29fdXNlcl9pZCI6IjM1NjMiLCJzb191c2VyX3JvbGUiOiJ1c2VyIiwic29fcHJvZmlsZSI6ImFsbCIsInNvX3VzZXJfbmFtZSI6IiIsInNvX2FwaWtleSI6Im5vbmUifQ.GKl2yGb27oTgZ1gHBL0_TdCM2lCNX1fMJAjQYuA9pQo";
//$auth_token="";
$mobile=$contact;
$params = array(

                    'source' => 'STARTUPAUTO', // Sender ID
                    'destinations' => array($mobile), // Receiver's mobile numebers
                     'transports'=>array('sms'),
                    'content' => array(
                        'sms'=>$sms,
                    ) 

                );

$body = json_encode($params);


$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_POSTFIELDS,$body);
curl_setopt($ch, CURLOPT_POST, 1);

$headers = array();
$headers[] = "Content-Type: application/json";
$headers[] = "Accept: application/json";
$headers[] = "Authorization: Apikey $auth_token";
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$result = curl_exec($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);


if (curl_errno($ch)) {
    $action="Error";
}else{ $action="SEND"; }


curl_close ($ch); 

echo $action;

$time=date("H.i");

$sql = "INSERT INTO sms (customer_id,customer_name,phone_number,massage,date,time,action,type,vehicle_no) VALUES (:a,:b,:c,:mas,:date,:time,:act,:ty,:vhi)";
$ql = $db->prepare($sql);
$ql->execute(array(':a'=>$customer_id,':b'=>$cus_name,':c'=>$contact,':mas'=>$sms,':date'=>$date,':time'=>$time,':act'=>$action,':ty'=>'2',':vhi'=>$vehicle_no));
//*********************** SMS End **********************/


header("location: bill.php?id=$a1");

?>