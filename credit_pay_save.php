<?php 
include("connect.php");
$date=date('Y-m-d');
$pay_amount=$_POST['amount'];
$pay_type=$_POST['pay_type'];
$cus_id=$_POST['cus_id'];


$result = $db->prepare('SELECT * FROM customer WHERE  id=:id ');
$result->bindParam(':id', $cus_id);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){ $cus_name=$row['customer_name']; }

// save credit payment
$sql = 'INSERT INTO credit_payment (cus_id,cus_name,pay_type,amount,date,type) VALUES (?,?,?,?,?,?)';
$q = $db->prepare($sql);
$q->execute(array($cus_id,$cus_name,$pay_type,$pay_amount,$date,'1'));


// Check credit id
$result = $db->prepare('SELECT * FROM credit_payment WHERE  cus_id=:id ORDER BY id DESC LIMIT 1');
$result->bindParam(':id', $cus_id);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){ $credit_id=$row['id']; }

//###########  Credit pay process  #########//
$pay_balance=$pay_amount;
$result = $db->prepare("SELECT * FROM sales WHERE credit > 0 AND customer_id = '$cus_id' ORDER BY transaction_id ASC");
$result->bindParam(':id', $res);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){  
$credit_amount=$row['credit'];
$sales_id=$row['transaction_id'];
$invoice_no=$row['invoice_number'];
$invoice_amount=$row['amount'];


if($pay_balance > 0){

    if($pay_balance > $credit_amount){$pay_amount=$credit_amount;}else{$pay_amount=$pay_balance;}

// create credit payment record
$sql = 'INSERT INTO credit_payment_list (cus_id,sales_id,invoice_no,credit_id,invoice_amount,credit_amount,pay_amount,date) VALUES (?,?,?,?,?,?,?,?)';
$q = $db->prepare($sql);
$q->execute(array($cus_id,$sales_id,$invoice_no,$credit_id,$invoice_amount,$credit_amount,$pay_amount,$date));

// credit invoice updated
$sql = 'UPDATE  sales SET credit =  ?, pay_date=? WHERE transaction_id =? ';
$ql = $db->prepare($sql);
$ql->execute(array($credit_amount-$pay_amount,$date,$sales_id));

$pay_balance = $pay_balance - $credit_amount;
}

}

header("location: credit_payment_print.php?id=$credit_id");
?>