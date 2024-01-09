<?php
session_start();
include('connect.php');


$result = $db->prepare("SELECT * FROM supply_payment ");
$result->bindParam(':userid', $d);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$id=$row['id'];
	
	$date=$row['date'];
    $split = explode("-", $date);
            $d= $split[0];
			$m= $split[1];
			$y= $split[2];
			

	
	
			$f=$y."-".$m."-".$d;
			echo 'Date: '.$f;
	
	echo "<br>";
	
	
	
	$sql = "UPDATE supply_payment 
        SET date=? 
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($f,$id));
	
	
				}

?>