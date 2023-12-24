<?php 
include("connect.php");


$emp_id=$_POST['emp'];
$vehicle_id=$_POST['cus'];
$type_id=$_POST['type'];
$note=$_POST['note'];
$booking_date=$_POST['date'];
$date=date('Y-m-d');

//----- Job type---------//
$result = $db->prepare('SELECT * FROM job_type  WHERE  id=:id ');
$result->bindParam(':id', $type_id);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){ $type=$row['name']; }


//------------ employee -----------//
$result = $db->prepare('SELECT * FROM Employees WHERE  id=:id ');
$result->bindParam(':id', $emp_id);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){ $emp=$row['name']; }


//------------- Vehicle -------------//
$result = $db->prepare("SELECT * FROM vehicle WHERE  id='$vehicle_id' ");
$result->bindParam(':userid', $res);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){ 
    $vehicle_no=$row['vehicle_no'];
    $cus_id=$row['customer_id'];
 }


//--------- Customer ---------------//
 $result = $db->prepare('SELECT * FROM customer WHERE  id=:id ');
 $result->bindParam(':id', $cus_id);
 $result->execute();
 for($i=0; $row = $result->fetch(); $i++){ 
    $cus=$row['customer_name']; 
    $contact=$row['contact']; 
}



// --------- Save Booking --------//
$sql = "INSERT INTO booking (customer_name,vehicle_no,vehicle_id,type,type_id,emp_name,emp_id,date,booking_date,booking_time,note,contact) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
$ql = $db->prepare($sql);
$ql->execute(array($cus,$vehicle_no,$vehicle_id,$type,$type_id,$emp,$emp_id,$date,$booking_date,'',$note,$contact));


if(isset($_POST['end'])){
    header("location: app/booking.php");
   }else{
    header("location: index.php");
   }
?>