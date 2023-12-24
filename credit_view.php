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

include_once("sidebar2.php");
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
                Credit
                <small>Preview</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Forms</a></li>
            </ol>
        </section>


        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-4">
                    <div class="box box-info">
                        <div class="box-header">
                            <h3 class="box-title">Payment</h3>
                        </div>
                        <!-- /.box-header -->

                        <div class="box-body">
                            <form action="credit_pay_save.php" method="post">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" name="amount" class="form-control" placeholder="Amount">
                                    </div>
                                  
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-7">
                                    <select class="form-control" name="pay_type" aria-placeholder="Payment Type">
                                        <option >Cash</option>
                                        <option >Bank</option>
                                        <option >Chq</option>
                                    </select>
                                    </div>
                                    <div class="col-md-5">
                                    
                                    <input type="submit" class="btn btn-info pull-right" value="Pay">
                                    </div>
                                </div>
                                
                              
                                
                                <input type="hidden" name="cus_id" value="<?php echo $_GET['id']; ?>">
                            </form>
                        </div>
                        <!-- /.box-body -->
                    </div>

                    <!-- /.box -->
                </div>

                <div class="col-md-8">
                    <div class="box box-warning">
                        <div class="box-header">
                            <h3 class="box-title">Invoice</h3>
                        </div>
                        <!-- /.box-header -->

                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-striped">

                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Vehicle No</th>
                                        <th>Amount</th>
                                    </tr>

                                </thead>

                                <tbody>
                                    <?php $id=$_GET['id']; $tot=0;
                            $result = $db->prepare("SELECT * FROM sales WHERE customer_id='$id' AND credit > 0 AND action='active' ORDER BY transaction_id ASC");
				            $result->bindParam(':userid', $date);
                            $result->execute();
                            for($i=0; $row = $result->fetch(); $i++){
                                ?>
                                    <tr class="record">
                                        <td><?php echo $row['date'];?></td>
                                        <td><?php echo $row['vehicle_no']; ?></td>
                                        <td><?php echo $row['credit']; ?></td>


                                        <?php $tot+=$row['credit']; } ?>
                                    </tr>
                                </tbody>

                            </table>
                            <h3>Credit Total <b style="color:red;">RS.<?php echo $tot; ?></b> </h3>
                        </div>
                        <!-- /.box-body -->
                    </div>

                    <!-- /.box -->
                </div>


            </div>
            <!-- /.box -->
        </section>
        <!-- /.content -->

        <section class="content">


    </div>

    </section>






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

    <!-- InputMask -->
    <script src="../../plugins/input-mask/jquery.inputmask.js"></script>
    <script src="../../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="../../plugins/input-mask/jquery.inputmask.extensions.js"></script>

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


        $(".delbutton").click(function() {
            //Save the link in a variable called element
            var element = $(this);
            //Find the id of the link that was clicked
            var del_id = element.attr("id");
            //Built a url to send
            var info = 'id=' + del_id;
            if (confirm("Sure you want to Pay this credit invoice? There is NO undo!")) {

                $.ajax({
                    type: "GET",
                    url: "credit_pay_save.php",
                    data: info,
                    success: function() {}
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