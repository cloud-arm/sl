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
                Service Form
                <small>Preview</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Forms</a></li>
                <li class="active">Product Form</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-6">
                    <!-- SELECT2 EXAMPLE -->
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">New Request</h3>


                            <!-- /.box-header -->
                            <div class="form-group">

                                <form form="Login_form" onsubmit="submit_form()">
                                    <div class="box-body">
                                        <!-- /.box -->
                                        <div class="form-group">
                                            <div class="box-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">

                                                            <div class="input-group">
                                                                <div class="input-group-addon">
                                                                    <label>Type</label>

                                                                </div>
                                                                <select class="form-control select2" id="type"
                                                                    style="width: 100%;" autofocus required>

                                                                    <option value="bug">Error complaints</option>
                                                                    <option value="features">New features</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">

                                                        <textarea class="model-box" placeholder="Note" 
                                                            style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                                            name="note" id="note" cols="70" rows="5"></textarea>

                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="cus_id" value="15">
                                            <input type="hidden" name="user_id"
                                                value="<?php echo $_SESSION['SESS_MEMBER_ID'];?>">
                                            <input type="hidden" name="user_name"
                                                value="<?php echo $_SESSION['SESS_FIRST_NAME'];?>">
                                            <input class="btn btn-info" type="submit" value="Next">
                                        </div>
                                    </div>
                                </form>
                                <!-- /.box -->

                            </div>
                            <!-- /.col (left) -->



                            <!-- /.box-body -->

                        </div>

                        <!-- /.box -->
                    </div>
                    <!-- /.col (right) -->
                </div>
                <div class="col-md-6">
                    <?php 
                     $curl = curl_init();
                            
                     curl_setopt_array($curl, array(
                       CURLOPT_URL => 'http://api.colorbiz.org/service_request/service_request_view.php',
                       CURLOPT_RETURNTRANSFER => true,
                       CURLOPT_ENCODING => '',
                       CURLOPT_MAXREDIRS => 10,
                       CURLOPT_TIMEOUT => 0,
                       CURLOPT_FOLLOWLOCATION => true,
                       CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                       CURLOPT_CUSTOMREQUEST => 'POST',
                       CURLOPT_POSTFIELDS => 'cus_id=15',
                       CURLOPT_HTTPHEADER => array(
                         'Content-Type: application/x-www-form-urlencoded'
                       ),
                     ));
                     
                     $response = curl_exec($curl);
                     
                     curl_close($curl);

                    

                     $data= json_decode($response,true);
                    ?>
                    <!-- SELECT2 EXAMPLE -->
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title">Request List</h3>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Note</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                            <?php
                            foreach ($data as $row) {
                            ?>
                                <tr>
                                    <td><?php echo $row['id']  ?></td>
                                    <td><?php echo nl2br($row['note']) ?></td>
                                    <td><?php if($row['action']==1){ echo 'Pending';} 
                                    if($row['action']==2){ echo 'Start';}
                                    if($row['action']==3){ echo 'End';}
                                    ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            </table>
                            
                            <!-- /.box-header -->
                            <div class="form-group">


                                <!-- /.box -->

                            </div>
                            <!-- /.col (left) -->



                            <!-- /.box-body -->

                        </div>

                        <!-- /.box -->
                    </div>
                    <!-- /.col (right) -->
                </div>
            </div>

    </div>
    <!-- /.row -->
    </section>
    <!-- /.content -->


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

    <!-- jQuery 2.2.3 -->
    <script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <!-- Select2 -->
    <script src="../../plugins/select2/select2.full.min.js"></script>
    <!-- InputMask -->
    <script src="../../plugins/input-mask/jquery.inputmask.js"></script>
    <script src="../../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="../../plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <!-- date-range-picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="../../plugins/daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap datepicker -->
    <script src="../../plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="../../plugins/iCheck/icheck.min.js"></script>
    <!-- FastClick -->
    <script src="../../plugins/fastclick/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
    <!-- Page script -->

    <script type="text/javascript">
    function submit_form() {
        var type = document.getElementById('type').value;
        var note = document.getElementById('note').value;


var myHeaders = new Headers();
myHeaders.append("Content-Type", "application/x-www-form-urlencoded");

var urlencoded = new URLSearchParams();
urlencoded.append("user_id", "<?php echo $_SESSION['SESS_MEMBER_ID'];?>");
urlencoded.append("user_name", "<?php echo $_SESSION['SESS_FIRST_NAME'];?>");
urlencoded.append("cus_id", "5");
urlencoded.append("type", type);
urlencoded.append("note", note);

var requestOptions = {
  method: 'POST',
  headers: myHeaders,
  body: urlencoded,
  redirect: 'follow'
};

fetch("https://api.colorbiz.org/service_request/new.php", requestOptions)
  .then(response => response.text())
  .then(result => console.log(result))
  .catch(error => console.log('error', error));



        alert("Login successfully");
    }
    </script>

    <script>
    $(function() {
        //Initialize Select2 Elements
        $(".select2").select2();

        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("YYYY/MM/DD", {
            "placeholder": "YYYY/MM/DD"
        });
        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("YYYY/MM/DD", {
            "placeholder": "YYYY/MM/DD"
        });
        //Money Euro
        $("[data-mask]").inputmask();



        //Date picker
        $('#datepicker').datepicker({
            autoclose: true
        });

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass: 'iradio_minimal-red'
        });
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });


    });
    </script>
</body>

</html>