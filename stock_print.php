<!DOCTYPE html>
<html>

<head>
    <?php
		  include("connect.php");
	

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
</head>

<body onload="window.print() " style=" font-size: 13px; font-family: arial;">
    <?php
$sec = "1";
?>
    <meta http-equiv="refresh" content="<?php echo $sec;?>;URL='stock.php">
    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice">
            <div class="col-xs-6">
                <h3>STOCK REPORT.</h3>

                Date:<?php date_default_timezone_set("Asia/Colombo"); 
    echo date("Y-m-d"); echo "  Time-";  echo date("h:ia")  ?>
                </h5>

            </div>
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">



                    <thead>
                        <tr>
                            <th>Product_id</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Category</th>
                            <th>qty</th>
                            <th>Price</th>
                            <th>Value</th>

                        </tr>
                    </thead>


                    <tbody>

                        <?php

$style=""; $tot=0; $filter=$_GET['id'];
$result = $db->prepare("SELECT product.name as name, catogary_list.name as cat , product.* FROM product JOIN catogary_list ON product.category=catogary_list.id $filter ORDER by catogary_list.id ASC  ");
$result->bindParam(':userid', $date);
$result->execute();

for($i=0; $row = $result->fetch(); $i++){
$qty=$row['qty'];
$re=$row['re_order'];
if ($qty < $re) {
$style='style="color:green" ';
}
if ($qty < 0) {
$style='style="color:red" ';
}
?>

                        <tr <?php echo $style; ?> class="record">
                            <td><?php echo $id=$row['product_id'];?></td>
                            <td><?php echo $row['code'];?></td>
                            <td><?php echo $row['name'];?></td>
                            <td><?php echo $row['type'];?></td>
                            <td><?php echo $row['cat'];?></td>
                            <td><?php echo $row['qty'];?></td>
                            <td><?php echo $row['sell'];?></td>
                            <th><?php echo $row['qty']*$row['sell']  ?></th>


                            <?php if($row['qty'] > 0 ){ $tot+=$row['qty']*$row['sell'];}	}	?>
                        </tr>

                    </tbody>



                    <tfoot>


                    </tfoot>

                </table>
                <h3>Total Value Rs.<?php echo $tot; ?></h3>
            </div>






    </div>
    </div>
    </section>
    </div>
</body>

</html>