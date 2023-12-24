<!DOCTYPE html>
<html>
<?php
include("head.php");
include("connect.php");
?>

<body class="hold-transition skin-blue sidebar-mini">

    <?php
include_once("auth.php");
$r=$_SESSION['SESS_LAST_NAME'];
if($r =='Cashier'){
header("location:./../../../index.php");
}

if($r =='admin'){
include_once("sidebar.php");
}

?>









    <link rel="stylesheet" href="datepicker.css" type="text/css" media="all" />
    <script src="datepicker.js" type="text/javascript"></script>
    <script src="datepicker.ui.min.js" type="text/javascript"></script>
    <script type="text/javascript">
    $(function() {

        $("#datepicker1").datepicker({
            dateFormat: 'yy/mm/dd'
        });

        $("#datepicker2").datepicker({
            dateFormat: 'yy/mm/dd'
        });



    });
    </script>

    <!-- /.sidebar -->

    </aside>



    <!-- Content Wrapper. Contains page content -->

    <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

            <h1>

                Stock

                <small>Preview</small>

            </h1>

            <ol class="breadcrumb">

                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

                <li><a href="#">Forms</a></li>

                <li class="active">PRODUCT</li>

            </ol>

        </section>

        <section class="content">



            <div class="box box-success">

                <div class="box-header">

                    <h3 class="box-title">STOCK Data</h3>



                </div>

                <!-- /.box-header -->



                <div class="box-body">
                   

                   <div class="pull-center" >
                   <form action="" method="get">
                        <div class="row" >
                            <div class="col-md-2" > Type:
                            <select name="type" class="form-control" >
                                <option>All</option>
                                <option>Product</option>
                                <option>Service</option>
                                <option>Materials</option>
                                <option>Quick</option>
                            </select>
                                 </div>

                            <div class="col-md-2" > Category: <select name="cat" class="form-control" >
                            <option>All</option>
                                <?php $result = $db->prepare('SELECT * FROM catogary_list ');
                                $result->bindParam(':userid', $res);
                                $result->execute();
                                for($i=0; $row = $result->fetch(); $i++){ ?>
                                <option value="<?php echo $row['id'] ?>"><?php echo $row['name']; ?></option>
                                <?php } ?>
                            </select> </div>
                            <div class="col-md-2" > <br> <input type="submit" value="Filter" class="btn btn-info" ></div>
                            
                        </div>
                    </form>
                   </div>
                    <br><br>
                    <table id="example1" class="table table-bordered table-striped">



                        <thead>
                            <tr>
                                <th>Product_id</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Category</th>
                                <th>qty</th>
                                <th>Re Order</th>
                                <th>#</th>
                            </tr>
                        </thead>



                        <tbody>

                            <?php
                            if(isset($_GET['type'])){
                                $w='WHERE';
                                $a='AND';
                                $fil1="product.category='".$_GET['cat']."'";
                                $fil2="product.type='".$_GET['type']."'";

                                if($_GET['cat']=='All'){$fil1=''; $a='';}
                                if($_GET['type']=='All'){$fil2=''; $a='';}
                                if($_GET['type']=='All' && $_GET['cat']=='All'){$w=''; $a='';}


                            }else{
                                $fil1=''; $fil2=''; $w=''; $a=''; 
                            }

$style="";
  $result = $db->prepare("SELECT product.name as name, catogary_list.name as cat , product.* FROM product JOIN catogary_list ON product.category=catogary_list.id $w  $fil1 $a $fil2 ORDER by product.product_id ASC  ");
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
                                <td><?php echo $row['re_order'];?></td>
                                <td>
                                    <a href="#" id="<?php echo $row['product_id']; ?>" class="delbutton"
                                        title="Click to Delete">
                                        <button class="btn btn-danger"><i class="icon-trash">x</i></button></a>
                                </td>
                                <?php	}	?>
                            </tr>

                        </tbody>

                    </table>
                    <a href="stock_print.php?id=<?php echo $w.' '.$fil1.' '.$a.' '.$fil2 ?> "><button class="btn btn-info">Print</button></a>
                </div>

                <!-- /.box-body -->

            </div>

            <!-- /.box -->

    </div>

    <!-- /.col -->











    <!-- Main content -->




    <!-- /.row -->



    </section>

    <!-- /.content -->

    </div>

    <!-- /.content-wrapper -->

    <?php

  include("dounbr.php");

?>

    <!-- /.control-sidebar -->

    <!-- Add the sidebar's background. This div must be placed

       immediately after the control sidebar -->

    <div class="control-sidebar-bg"></div>

    </div>

    <!-- ./wrapper -->

    <script src="js/jquery.js"></script>

    <!-- jQuery 2.2.3 -->

    <script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>

    <!-- Bootstrap 3.3.6 -->

    <script src="../../bootstrap/js/bootstrap.min.js"></script>

    <!-- DataTables -->

    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>

    <script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>

    <!-- SlimScroll -->

    <script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>

    <!-- FastClick -->

    <script src="../../plugins/fastclick/fastclick.js"></script>

    <!-- AdminLTE App -->

    <script src="../../dist/js/app.min.js"></script>

    <!-- AdminLTE for demo purposes -->

    <script src="../../dist/js/demo.js"></script>

    <!-- page script -->

    <script>
    $(function() {

        $("#example1").DataTable();

        $('#example2').DataTable({

            "paging": true,

            "lengthChange": false,

            "searching": false,

            "ordering": true,

            "info": true,

            "autoWidth": false

        });

    });
    </script>

    <script type="text/javascript">
    $(function() {





        $(".delbutton").click(function() {
            //Save the link in a variable called element
            var element = $(this);
            //Find the id of the link that was clicked
            var del_id = element.attr("id");
            //Built a url to send
            var info = 'id=' + del_id;
            if (confirm("Sure you want to delete this product? There is NO undo!"))
            {

                $.ajax({
                    type: "GET",
                    url: "product_dll.php",
                    data: info,
                    success: function() {
                    }
                });
                $(this).parents(".record").animate({
                        backgroundColor: "#fbc7c7"
                    }, "fast")
                    .animate({
                        opacity: "hide"
                    }, "slow");
            }



            return false;



        });



    });
    </script>

</body>

</html>