<?php 
include("../connect.php");

$job_no=$_POST['job_no'];

$cat=$_POST['cat'];

$result = $db->prepare("SELECT * FROM job_inspection WHERE type >= '2' AND cat= '$cat' ORDER by id ASC ");
$result->bindParam(':userid', $res);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){  
$ins_id=$row['id'];

$name=$row['name'];
$cat=$row['cat'];
$type=$_POST['type'.$ins_id];
$note=$_POST['note'.$ins_id];

if($type=='none'){}else{

    $result1 = $db->prepare("DELETE FROM job_list WHERE  job_no= '$job_no' AND ins_id= '$ins_id' ");
    $result1->bindParam(':userid', $date);
    $result1->execute();

$sql = "INSERT INTO job_list (name,type,ins_id,note,job_no,ins_type,cat) VALUES (?,?,?,?,?,?,?)";
$q = $db->prepare($sql);
$q->execute(array($name, $type, $ins_id,$note,$job_no,'2',$cat));
}

 
}

header("location: inspection.php?id=$job_no");
?>