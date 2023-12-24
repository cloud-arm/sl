<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");
$vehicle_id = $_POST['cus'];

	$result = $db->prepare("SELECT * FROM vehicle WHERE id = '$vehicle_id' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
            $vehicle = $row['vehicle_no'];
			$customer_id=$row['customer_id'];
			$cus_name=$row['customer_name'];
			$model=$row['model'];
		}

	$result = $db->prepare("SELECT * FROM job WHERE vehicle_no = '$vehicle' and type='active' and category='' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
            $job_id = $row['id'];
		}

if($job_id>1){
?>	
	
<!DOCTYPE html>
<html>
<?php 
include("head.php");
include("connect.php");
?>
<?php $sec=1;?>
<meta http-equiv="refresh" content="<?php echo $sec;?>;URL='job_add.php'">	
<body class="hold-transition skin-red sidebar-mini layout-top-nav">
	
<center>
	<br>
	
<br><br><br>
 <div class="col-md-12">
<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                It's Already save
              </div> </div>
	
	
	</center>
	</body>
</html>
<?php	
}else{


$imageUploadPath='';
$imageUploadPath2='';
$imageUploadPath3='';
$imageUploadPath4='';

$job_type = $_POST['type'];
$km = $_POST['km'];
$note1 = $_POST['note'];
$product1 = "";
	
$toolkit = 0;
$carpet = 0;
$piuot_arm_cover = 0;
$piuot_arm_cover_r = 0;
$helmet = 0;	
	
	
$type="active";
$time= date("H.i");
$date= date("Y-m-d");

$note= str_replace(".","<br>",$note1); 
$product= str_replace(".","<br>",$product1);

$date=date("Y-m-d");
			 


 $result = $db->prepare("SELECT COUNT(id) FROM job WHERE date='$date' ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
					$jid=$row['COUNT(id)'];
	}


$nba=1;
	


//---------------------------------------------------------------- upload image file ------------------------------------------------//

function compressImage($source, $destination, $quality) { 
    // Get image info 
    $imgInfo = getimagesize($source); 
    $mime = $imgInfo['mime']; 
     
    // Create a new image from file 
    switch($mime){ 
        case 'image/jpeg': 
            $image = imagecreatefromjpeg($source); 
           imagejpeg($image, $destination, $quality);
            break; 
        case 'image/png': 
            $image = imagecreatefrompng($source); 
            imagepng($image, $destination, $quality);
            break; 
        case 'image/gif': 
            $image = imagecreatefromgif($source); 
            imagegif($image, $destination, $quality);
            break; 
        default: 
            $image = imagecreatefromjpeg($source); 
           imagejpeg($image, $destination, $quality);
    } 
     
     
    // Return compressed image 
    return $destination; 
} 
 
 
// File upload path 
$uploadPath = "job_img/"; 
 
// If file upload form is submitted 
$status = $statusMsg = ''; 
if(isset($_POST["fileToUpload"])){ 
    $status = 'error'; 
    if(!empty($_FILES["fileToUpload"]["name"])) { 
        // File info 
        $fileName = date('ymdHis').'.'.pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION); 
        $imageUploadPath = $uploadPath . $fileName; 
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION); 
         
        // Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
            // Image temp source 
            $imageTemp = $_FILES["fileToUpload"]["tmp_name"]; 
             
            // Compress size and upload image 
            $compressedImage = compressImage($imageTemp, $imageUploadPath, 60); 
             
            if($compressedImage){ 
                $status = 'success'; 
                $statusMsg = "Image compressed successfully."; 
            }else{ 
                $statusMsg = "Image compress failed!"; 
            } 
        }else{ 
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
        } 
    }else{ 
        $statusMsg = 'Please select an image file to upload.'; 
    } 
} 


if(isset($_POST["fileToUpload2"])){ 
    $status = 'error'; 
    if(!empty($_FILES["fileToUpload2"]["name"])) { 
        // File info 
        $fileName = "2".date('ymdHis').'.'.pathinfo($_FILES["fileToUpload2"]["name"], PATHINFO_EXTENSION); 
        $imageUploadPath2 = $uploadPath . $fileName; 
        $fileType = pathinfo($imageUploadPath2, PATHINFO_EXTENSION); 
         
        // Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
            // Image temp source 
            $imageTemp = $_FILES["fileToUpload2"]["tmp_name"]; 
             
            // Compress size and upload image 
            $compressedImage = compressImage($imageTemp, $imageUploadPath2, 60); 
             
            if($compressedImage){ 
                $status = 'success'; 
                $statusMsg = "Image compressed successfully."; 
            }else{ 
                $statusMsg = "Image compress failed!"; 
            } 
        }else{ 
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
        } 
    }else{ 
        $statusMsg = 'Please select an image file to upload.'; 
    } 
} 
 
if(isset($_POST["fileToUpload3"])){ 
    $status = 'error'; 
    if(!empty($_FILES["fileToUpload3"]["name"])) { 
        // File info 
        $fileName = "2".date('ymdHis').'.'.pathinfo($_FILES["fileToUpload3"]["name"], PATHINFO_EXTENSION); 
        $imageUploadPath3 = $uploadPath . $fileName; 
        $fileType = pathinfo($imageUploadPath3, PATHINFO_EXTENSION); 
         
        // Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
            // Image temp source 
            $imageTemp = $_FILES["fileToUpload3"]["tmp_name"]; 
             
            // Compress size and upload image 
            $compressedImage = compressImage($imageTemp, $imageUploadPath3, 60); 
             
            if($compressedImage){ 
                $status = 'success'; 
                $statusMsg = "Image compressed successfully."; 
            }else{ 
                $statusMsg = "Image compress failed!"; 
            } 
        }else{ 
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
        } 
    }else{ 
        $statusMsg = 'Please select an image file to upload.'; 
    } 
} 


if(isset($_POST["fileToUpload4"])){ 
    $status = 'error'; 
    if(!empty($_FILES["fileToUpload4"]["name"])) { 
        // File info 
        $fileName = "2".date('ymdHis').'.'.pathinfo($_FILES["fileToUpload4"]["name"], PATHINFO_EXTENSION); 
        $imageUploadPath4 = $uploadPath . $fileName; 
        $fileType = pathinfo($imageUploadPath4, PATHINFO_EXTENSION); 
         
        // Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
            // Image temp source 
            $imageTemp = $_FILES["fileToUpload4"]["tmp_name"]; 
             
            // Compress size and upload image 
            $compressedImage = compressImage($imageTemp, $imageUploadPath4, 60); 
             
            if($compressedImage){ 
                $status = 'success'; 
                $statusMsg = "Image compressed successfully."; 
            }else{ 
                $statusMsg = "Image compress failed!"; 
            } 
        }else{ 
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
        } 
    }else{ 
        $statusMsg = 'Please select an image file to upload.'; 
    } 
} 
// Display status message 
//echo $statusMsg; 

  

//---------------------------------------------------------------- upload image end ----------------------------------------------------//
	



$sql = "INSERT INTO job (vehicle_no,km,note,type,date,time,product_note,job_type,job_no,cus_id,vehicle_id,img,img2,img3,img4) VALUES (:ve,:km,:note,:type,:date,:time,:pro,:j_type,:job_no,:cus_id,:vehicle_id,:img,:img2,:img3,:img4)";
$q = $db->prepare($sql);
$q->execute(array(':ve'=>$vehicle,':km'=>$km,':note'=>$note,':type'=>$type,':date'=>$date,':time'=>$time,':pro'=>$product,':j_type'=>$job_type,':job_no'=>$nba,':cus_id'=>$customer_id,':vehicle_id'=>$vehicle_id,':img'=>$imageUploadPath,':img2'=>$imageUploadPath2,':img3'=>$imageUploadPath3,':img4'=>$imageUploadPath4));

//echo $customer_id;

$result = $db->prepare("SELECT * FROM job ORDER by id DESC limit 0,1");
$result->bindParam(':userid', $date);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
   $job_no=$row['id'];
}

$invo=date('ymdhis');
$sql = "INSERT INTO sales (vehicle_no,invoice_number,customer_name,km,date,cashier,comment,type,customer_id,model,job_no,job_type,vehicle_id) VALUES (:a,:b,:c,:d,:e,:f,:j,:type,:cus_id,:model,:job,:job_type,:vehicle_id)";
$ql = $db->prepare($sql);
$ql->execute(array(':a'=>$vehicle,':b'=>$invo,':c'=>$cus_name,':d'=>$km,':e'=>$date,':f'=>"",':j'=>"",':type'=>'',':cus_id'=>$customer_id,':model'=>$model,':job'=>$job_no,':job_type'=>$job_type,':vehicle_id'=>$vehicle_id));



$sql = "UPDATE job
SET invoice_no=?
WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($invo,$job_no));


//*********************** SMS  **********************/
$result = $db->prepare('SELECT * FROM customer WHERE  id=:id ');
$result->bindParam(':id', $customer_id);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){ 
    $contact=$row['contact'];
 }

 $contact='94'.substr($contact,-9);

$sms="Welcome to START UP Auto Care.
We receive your ".$vehicle." to make it Clean and Shine.
Keep Your Pride in Your Ride";

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
$ql->execute(array(':a'=>$customer_id,':b'=>$cus_name,':c'=>$contact,':mas'=>$sms,':date'=>$date,':time'=>$time,':act'=>$action,':ty'=>'1',':vhi'=>$vehicle));





if(isset($_POST['end'])){
	

$result = $db->prepare("SELECT * FROM job_inspection WHERE type='1' ORDER by id ASC ");
$result->bindParam(':userid', $res);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$ins_id=$row['id'];

$name=$row['name'];
$type=$_POST['type'.$ins_id];
$note=$_POST['note'.$ins_id];

if($type=='none'){}else{
$sql = "INSERT INTO job_list (name,type,ins_id,note,job_no,ins_type) VALUES (?,?,?,?,?,?)";
$q = $db->prepare($sql);
$q->execute(array($name, $type, $ins_id,$note,$job_no,'1'));
}

 
}
header("location: app/index.php");
}else{header("location: index.php"); }
	
	
}



?>