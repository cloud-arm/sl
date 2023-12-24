<!DOCTYPE html>
<html>
<head>
	<?php
		  include("connect.php");
	
	$invo = $_GET['id'];
	$co = substr($invo,0,2) ;
			?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CLOUD ARM | Invoice</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
<style>
body {
    font-family: 'Poppins';
}

.container {
  position: relative;
  text-align: center;
  color: white;
}

.bottom-left {
  position: absolute;
  bottom: 8px;
  left: 18%;
}

.top-left {
  position: absolute;
  top: 8px;
  left: 18%;
}

.top-right {
  position: absolute;
  top: 8px;
  right: 58%;
}

.bottom-right {
  position: absolute;
  bottom: 8px;
  right: 57%;
}


.centered {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
</style>
</head>
<body onload="window.print() " style=" font-size: 13px; font-family: 'Poppins';">
	
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
	  
	           <?php
           $invo=$_GET['id'];	
		   $result1 = $db->prepare("SELECT * FROM credit_payment WHERE   id='$invo'");
		   $result1->bindParam(':userid', $date);
           $result1->execute();
           for($i=0; $row1 = $result1->fetch(); $i++){ 
                $cus_name= $row1['cus_name']; 
                $tot_amount= $row1['amount'];
                $cus_id= $row1['cus_id'];
                }
                
                
         ?>
	  
	  
	  <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
        <img src="bill.jpg" width="145" alt="">
         <h5> <b>STARTUP Auto Care</b></h5>
         <p>52/B/1, 10th Mile Post,  <br>
			Katuwawala,  <br>
			Boralasgauwa <BR>
         <br>
         Call: 0112 150 400<br>
         E-mail: startupautoare@gmail.com<br><br>
         Bill To:<br>
         <?php echo $cus_name; ?>

         </p>
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <h1 class="pull-right">Credit Payment</h1>
        </div>
		  		  

		  
	
			 
			 
        <!-- /.col -->
</div>
<div class="box-body">
              <table id="example1" class="table">
                <thead>
                <tr style="background-color: #737373; color:#eee">
				<th>Invoice No</th>
                <th>Bill Amount</th>
				<th>Credit Amount</th>
				<th>Pay Amount</th>
                </tr>
                </thead>
                <tbody>
				<?php
				$result = $db->prepare("SELECT * FROM credit_payment_list WHERE   credit_id='$invo'  ");
					$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
          
			?>
                <tr>
				<td><?php echo $row['invoice_no'];?></td>
                  <td><?php echo $row['invoice_amount'];?></td>
					<td><?php echo $row['credit_amount'];?></td>
				  <td><?php echo $row['pay_amount'];?></td>
                  <?php   }?>
                 </tr>
                 
                
                </tbody>
              </table>
	<?php
				$result1 = $db->prepare("SELECT sum(credit) FROM sales WHERE   customer_id ='$cus_id' ");		
					$result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){
					$balance=$row1['sum(credit)'];
				}
			?>  
			<div class="col-xs-5 pull-right">
			    <div class="row" >
					    <div class="col-xs-6">
					       <h4 class="pull-right">Credit Total</h4>
					    </div>
					    <div class="col-xs-6">
					       <h4><b class="pull-right">Rs.<?php echo number_format($tot_amount+$balance,2); ?></b> </h4>
					       
					    </div>
					</div>
					<?php if ($co>0){ ?>
					<div class="row" >
					    <div class="col-xs-6">
					       <p class="pull-right">Pay Amount</p> 
					    </div>
					    <div class="col-xs-6">
					       <p class="pull-right">Rs.<?php echo number_format($tot_amount,2); ?></p> 
					    </div>
					</div>
					
					<div class="row" >
					    <div class="col-xs-6">
					       <p class="pull-right">Balance:</p> 
					    </div>
					    <div class="col-xs-6">
					       <p class="pull-right">Rs.<?php echo number_format($balance,2); ?></p> 
					    </div>
					</div>
					<?php } ?>
			</div>



	
            </div> 


	  
	
        </div>
  </section>
  <?php
$sec = "1";
?><meta http-equiv="refresh" content="<?php echo $sec;?>;<?php echo "URL='credit_rp.php"?>" >
</div>
</body>
</html>