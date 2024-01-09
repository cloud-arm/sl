<?php
session_start();
include('connect.php');


$result = $db->prepare("SELECT * FROM purchases ");
$result->bindParam(':userid', $d);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$id=$row['transaction_id'];
	
	$date=$row['date'];
    $split = explode("-", $date);
            $d= $split[0];
			$m= $split[1];
			$y= $split[2];
			
	if($m<10){
		$m="0".$m;
	}
	if($d<10){
		$d="0".$d;
	}
	
	
			$f=$y."-".$m."-".$d;
			echo $f;
	
	echo "<br>";
	
	
	
	$sql = "UPDATE purchases 
        SET date=? 
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($f,$id));
	
	
				}

?>