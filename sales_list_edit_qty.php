<?php 
include('connect.php');


$qtys=$_POST['qty'];
$id=$_POST['id'];

$result = $db->prepare("SELECT * FROM sales_list WHERE id='$id' ");
$result->bindParam(':userid', $date);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$qty=$row['qty'];
$price=$row['price'];
$dicount=$row['dic'];
$invoice_no=$row['invoice_no'];
}


$dis=($dicount/$qty)*$qtys;
    


$amount=$price*$qtys;



$sql = "UPDATE sales_list
SET amount=?,qty=?,dic=?
WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($amount,$qtys,$dis,$id));

if(isset($_POST['end'])){header("location: app/sales.php?id=$invoice_no");}else{
header("location: sales.php?id=$invoice_no"); }

?>