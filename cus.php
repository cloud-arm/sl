<!DOCTYPE html>
<html>
<?php 
include("head.php");
include("connect.php");
?>

<body class="hold-transition skin-blue sidebar-mini">
    <!-- The Modal -->

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
                Customer Form
                <small>Preview</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Forms</a></li>
                <li class="active">Customer Form</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">


            <button class="btn btn-info" id="myBtn">Add Model</button>
            <button class="btn btn-info" id="makeBtn">Manufacture</button>

            <div id="myModal" class="modal">

                <!-- Modal content -->
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="close">&times;</span>
                        <center>
                            <h2>Save New Modal</h2>
                        </center>

                    </div>
                    <div class="modal-body">
                        <form method="post" action="model_save.php">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h3>Model Name</h3>
                                            <input class="form-control" type="text" name="model">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h3>Manufacture</h3>
                                            <select class="form-control select2" name="com" style="width: 100%;"
                                                autofocus>


                                                <?php
                        $result = $db->prepare("SELECT * FROM manufacture ");
            $result->bindParam(':userid', $res);
            $result->execute();
            for($i=0; $row = $result->fetch(); $i++){
          ?>
                                                <option value="<?php echo $row['id'];?>"><?php echo $row['name']; ?>
                                                </option>
                                                <?php
                }
              ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box -->
                            <input class="btn btn-info" type="submit" value="Save">
                        </form>
                    </div>

                </div>

            </div>



            <div id="make" class="modal">

                <!-- Modal content -->
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="close">&times;</span>
                        <center>
                            <h2>Save New Make</h2>
                        </center>

                    </div>
                    <div class="modal-body">
                        <form method="post" action="make_save.php">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <h3>Manufacture Name</h3>
                                            <input class="form-control" type="text" name="name">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- /.box -->
                            <input class="btn btn-info" type="submit" value="Save">
                        </form>
                    </div>

                </div>

            </div>




            <!-- SELECT2 EXAMPLE -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Add Customer</h3>


                    <!-- /.box-header -->
                    <div class="form-group">

                        <form method="post" action="save_cus.php">

                            <div class="box-body">



                                <!-- /.box -->
                                <div class="form-group">


                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label> Phone Number</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-phone"></i>
                                                        </div>
                                                        <input type="text" class="form-control" onchange="ex_cus();"
                                                            id="phone" name="phone_no">
                                                    </div>
                                                </div>

                                            </div>


                                            <div class="form-group">
                                                <label> Address</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-home"></i>
                                                    </div>
                                                    <input type="text" name="address" id="address"
                                                        class="form-control pull-right">
                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label> Customer Name</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-user"></i>
                                                        </div>
                                                        <input type="text" class="form-control" id="name"
                                                            name="cus_name" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Email</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-at"></i>
                                                    </div>
                                                    <input type="text" name="email" id="email"
                                                        class="form-control pull-right">
                                                </div>
                                            </div>



                                        </div>
                                    </div>



                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6">





                                                <div class="form-group">
                                                    <label>Birthday</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-odnoklassniki"></i>
                                                        </div>
                                                        <input type="text" name="birthday" id="birthday"
                                                            class="form-control pull-right"
                                                            data-inputmask='"mask": "9999-99-99"' data-mask>
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label> Vehicle Number</label>
                                                    <p style="color:brown" id='vehicle_data'></p>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-car"></i>
                                                        </div>

                                                        <input type="text" onchange="vehicle_data()" name="vehicle_no"
                                                            id="vehicle_no" class="form-control" required>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>



                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label> Fuel Type</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-users"></i>
                                                        </div>
                                                        <select name="fuel_type" class="form-control">

                                                            <option value="Diesel">Diesel</option>
                                                            <option value="Petrol">Petrol</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label>Model</label>

                                                <div class="input-group date">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-arrow-down"></i>
                                                    </div>
                                                    <select class="form-control select2" name="model"
                                                        style="width: 100%;" autofocus>


                                                        <?php
                $result = $db->prepare("SELECT * FROM model ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
	?>
                                                        <option value="<?php echo $row['id'];?>">
                                                            <?php echo $row['manufacture_name'].' - '.$row['name']; ?>
                                                        </option>
                                                        <?php
				}
			?>
                                                    </select>

                                                </div>



                                            </div>
                                        </div>
                                    </div>




                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Transmission</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-gears"></i>
                                                        </div>
                                                        <select name="transmission" class="form-control">
                                                            <option value="Manual">Manual</option>
                                                            <option value="Auto">Auto</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>



                                        </div>
                                    </div>




                                    <input type="hidden" name="cus_id" id="cus_id">

                                    <input class="btn btn-info" id='submit' type="submit" value="Submit">

                        </form>
                        <!-- /.box -->

                    </div>
                    <!-- /.col (left) -->



                    <!-- /.box-body -->

                </div>
            </div>
            <!-- /.box -->
    </div>
    <!-- /.col (right) -->
    </div>
    <!-- /.row -->

    </section>


    <section class="content">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Model List</h3>
            </div>
            <div class="box-body">





                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Manufacture</th>
                                <th>#</th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php $result = $db->prepare("SELECT * FROM model");
				
					                       $result->bindParam(':userid', $date);
                                 $result->execute();
                                 for($i=0; $row = $result->fetch(); $i++){  ?>
                            <tr class="record">
                                <td><?php echo $row['id'];   ?> </td>
                                <td><?php echo $row['name'];   ?></td>
                                <td><?php echo $row['manufacture_name'];   ?></td>




                                <td>

                                    <a href="#" id="<?php //echo $row['id']; ?>" class="delbutton"
                                        title="Click to Edit">
                                        <button class="btn btn-danger">Edit</button></a>


                                </td>
                            </tr>


                            <?php }   ?>
                        </tbody>

                    </table>
                </div>



            </div>
            <!-- /.box-body -->
        </div>


        </div>


        </div>
        <!-- /.col (left) -->



        <!-- /.box-body -->

        </div>
        </div>
        <!-- /.box -->
        </div>
        <!-- /.col (right) -->
        </div>
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
    <!-- bootstrap color picker -->
    <script src="../../plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
    <!-- bootstrap time picker -->
    <script src="../../plugins/timepicker/bootstrap-timepicker.min.js"></script>
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

    <!-- DataTables -->
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script>
    var modal = document.getElementById("myModal");
    var btn = document.getElementById("myBtn");
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal 
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }


    var make = document.getElementById("make");
    var makebtn = document.getElementById("makeBtn");
    var span2 = document.getElementsByClassName("close")[1];

    // When the user clicks the button, open the modal 
    makebtn.onclick = function() {
        make.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span2.onclick = function() {
        make.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            make.style.display = "none";
        }
    }

    function ex_cus() {
        var phone = document.getElementById('phone').value;
        var data = 'ur';
        fetch("app/customer_data.php?phone=" + phone)
            .then((response) => response.json())
            .then((json) => fill(json));
    }


    function fill(json) {


        if (json.action == "true") {
            console.log("old customer");
            document.getElementById('name').value = json.name;
            document.getElementById('address').value = json.address;
            document.getElementById('email').value = json.email;
            document.getElementById('birthday').value = json.birthday;
            document.getElementById('cus_id').value = json.id;

            document.getElementById('name').disabled = true;
            document.getElementById('address').disabled = true;
            document.getElementById('email').disabled = true;
            document.getElementById('birthday').disabled = true;

        } else {
            console.log("new customer");
            document.getElementById('name').value = '';
            document.getElementById('address').value = '';
            document.getElementById('email').value = '';
            document.getElementById('birthday').value = "";
            document.getElementById('cus_id').value = "0";

            document.getElementById('name').disabled = false;
            document.getElementById('address').disabled = false;
            document.getElementById('email').disabled = false;
            document.getElementById('birthday').disabled = false;
        }
    }




    function vehicle_data() {
        var phone = document.getElementById('vehicle_no').value;
        var data = 'ur';
        fetch("app/vehicle_data.php?vehicle_no=" + phone)
            .then((response) => response.json())
            .then((json) => find(json));
    }


    function find(json) {

        if (json.action == "true") {
            console.log("old vehicle");
            document.getElementById('vehicle_data').innerHTML = 'This Vehicle is already save';
            document.getElementById('submit').disabled = true;

        } else {
            console.log("new vehicle");
            document.getElementById('vehicle_data').innerHTML = '';
            document.getElementById('submit').disabled = false;
        }
    }


    $(function() {

        $(".select2").select2();

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
</body>

</html>