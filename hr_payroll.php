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
                Payroll
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
                <div class="col-md-6">
                    <!-- SELECT2 EXAMPLE -->
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Payroll</h3>


                            <!-- /.box-header -->
                            <div class="form-group">

                                <form method="get" action="">

                                    <div class="box-body">
                                        <!-- /.box -->
                                        <div class="form-group">
                                            <div class="box-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            
                                                                
                                                                <select class="form-control select2" name="id"
                                                                    style="width: 100%;" tabindex="1" autofocus>
                                                                    <option value="0"></option>
                                                                    <?php  
                                                             $result = $db->prepare("SELECT * FROM Employees ");
		                                                     $result->bindParam(':userid', $res);
		                                                     $result->execute();
		                                                     for($i=0; $row = $result->fetch(); $i++){ ?>
                                                                    <option value="<?php echo $row['id'];?>">
                                                                        <?php echo $row['name']; ?>
                                                                    </option>
                                                                    <?php	} ?>
                                                                </select>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <select class="form-control select2" name="year"
                                                                style="width: 100%;" tabindex="1" autofocus>
                                                                <option> <?php echo date('Y')-1 ?> </option>
                                                                <option selected> <?php echo date('Y') ?> </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <select class="form-control select2" name="month"
                                                                style="width: 100%;" tabindex="1" autofocus>
                                                                <?php for($x = 1; $x <= 12; $x++){ ?>
                                                                <option> <?php echo sprintf("%02d", $x); ?> </option>
                                                                <?php  } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <input class="btn btn-info" type="submit" value="Submit">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                
                                <?php
                                function AddPlayTime($times) {
                                    $minutes = 0; //declare minutes either it gives Notice: Undefined variable
                                    // loop throught all the times
                                    foreach ($times as $time) {
                                        list($hour, $minute) = explode('.', $time);
                                        $minutes += $hour * 60;
                                        $minutes += $minute;
                                    }
                                
                                    $hours = floor($minutes / 60);
                                    $minutes -= $hours * 60;
                                
                                    // returns the time already formatted
                                    return sprintf('%02d.%02d', $hours, $minutes);
                                  
                                }

                                function TimeSet($times) {
                                    
                                    list($hour, $minute) = explode('.', $times);
                                    $minutes=$minute+$hour*60;
                                
                                   return $minutes/60; 
                                }
                                
                                if(isset($_GET['id'])){ 
                                    $id=$_GET["id"];
                                    $d1=$_GET['year'].'-'.$_GET['month'].'-01';
                                    $d2=$_GET['year'].'-'.$_GET['month'].'-31';  $h=0;$m=0;
                                    $result = $db->prepare("SELECT work_time,ot FROM attendance WHERE emp_id='$id' AND date BETWEEN '$d1' AND '$d2' ORDER BY id ASC");
                                    $result->bindParam(':userid', $date);
                                    $result->execute();
                                    for($i=0; $row = $result->fetch(); $i++){ 
                                        $hour[]=$row['work_time'];
                                        $ot[]=$row['ot'];
                                    }

                                    $result = $db->prepare("SELECT count(id) FROM attendance WHERE action='0' AND emp_id='$id' AND date BETWEEN '$d1' AND '$d2' ORDER BY id ASC");
                                    $result->bindParam(':userid', $date);
                                    $result->execute();
                                    for($i=0; $row = $result->fetch(); $i++){ 
                                        $day=$row['count(id)'];
                                    }

                                    $result = $db->prepare("SELECT count(id) FROM attendance WHERE action='1' AND emp_id='$id' AND date BETWEEN '$d1' AND '$d2' ORDER BY id ASC");
                                    $result->bindParam(':userid', $date);
                                    $result->execute();
                                    for($i=0; $row = $result->fetch(); $i++){ 
                                        $holf_day=$row['count(id)'];
                                    }

                                    $day=$day+$holf_day*0.5;

                                    $result = $db->prepare("SELECT * FROM Employees WHERE id='$id' ");
                                    $result->bindParam(':userid', $date);
                                    $result->execute();
                                    for($i=0; $row = $result->fetch(); $i++){ 
                                        $name=$row['name'];
                                        $basic=$row['hour_rate'];
                                        $epf=$row['epf_amount'];
                                        $ex_date_rate=$row['ot'];
                                        $set_allowance=$row['allowance'];
                                    }

                                    $loan=0;
                                    $result = $db->prepare("SELECT * FROM hr_loan WHERE emp_id='$id' AND action='0' ");
                                    $result->bindParam(':userid', $date);
                                    $result->execute();
                                    for($i=0; $row = $result->fetch(); $i++){ 
                                        $loan=$row['term_amount'];
                                    }

                                    $result = $db->prepare("SELECT sum(amount) FROM salary_advance WHERE emp_id='$id' AND date BETWEEN '$d1' AND '$d2' ORDER BY id ASC");
				                    $result->bindParam(':userid', $date);
                                    $result->execute();
                                    for($i=0; $row = $result->fetch(); $i++){$adv=$row['sum(amount)'];}
                                    
                                    ?>
                                    <h2><?php echo $name; ?></h2>
                                    <h3><?php echo $_GET['year'].'-'.$_GET['month'] ?></h3>
                                <table class="table">
                                   <tr>
                                        <td>Basic Salary</td>
                                        <td>Rs.<?php echo $basic; ?></td>
                                    </tr>
                                    <tr>
                                        <td>ATTENDANCE DAYS</td>
                                        <td><?php echo $day; ?></td>
                                    </tr>
                                    <tr>
                                        <td>No Pay</td>
                                        <td><?php $month_day=26;
                                        if($day >= 26){$nopay=0; echo '0.00';}else{
                                           echo 'Rs. -'.$nopay=($month_day-$day)*$ex_date_rate;
                                        } ?>
                                        </td>
                                    </tr>
                                    
                                    <tr style="font-size: 16px; color:#2E86C1">
                                        <td>Salary</td>
                                        <td>Rs.<?php echo number_format($salary=$basic-$nopay,2); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Day Off</td>
                                        <td><?php if($day > 26){ echo $day_off=($day-26)*$ex_date_rate; }else{ echo '0.00'; $day_off=0; } ?></td>
                                    </tr>



                                    <?php  $allowances=0;
                                    $result = $db->prepare("SELECT * FROM hr_allowances WHERE emp_id='$id' AND date BETWEEN '$d1' AND '$d2' ORDER BY id ASC");
				                    $result->bindParam(':userid', $date);
                                    $result->execute();
                                    for($i=0; $row = $result->fetch(); $i++){ ?>

                                    <tr>
                                        <td><?php echo $row['note'] ?></td>
                                        <td>Rs.<?php echo $row['amount']; ?></td>
                                    </tr>
                                    <?php $allowances+=$row['amount'];} ?>

                                    <tr  style="font-size: 16px; color:#2E86C1">
                                        <td>Set Allowance</td>
                                        <td>Rs.<?php echo $set_allowance; $allowances+=$set_allowance; ?></td>
                                    </tr>

                                    <tr  style="font-size: 16px; color:#2E86C1">
                                        <td>Gross Salary</td>
                                        <td>Rs.<?php echo $gross=$salary+$day_off+$allowances; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Salary Advance</td>
                                        <td>Rs.<?php echo $adv; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Loan Deduction</td>
                                        <td>Rs.<?php echo $loan; ?></td>
                                    </tr>
                                    <tr style="font-size: 16px; color:#2E86C1">
                                        <td>Total Deduction</td>
                                        <td>Rs.<?php echo $loan+$adv; ?></td>
                                    </tr>
                                    
                                    <tr style="font-size: 20px; color:#2E86C1">
                                        <td>Balance Pay</td>
                                        <td>Rs.<?php echo $b_amount=$gross-$loan-$adv ?></td>
                                    </tr>
                                </table>
                                <?php } ?>
                                <!-- /.box -->
                            </div>
                            <!-- /.col (left) -->
                            <a href="hr_payroll_process.php?id=<?php echo $_GET['id'] ?>&year=<?php echo $_GET['year'] ?>&month=<?php echo $_GET['month'] ?>&amount=<?php echo $b_amount; ?>"><button class="btn btn-danger pull-right" ><i class="fa fa-print"></i></button></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <?php if(isset($_GET['id'])){ ?>
                    <div class="box box-warning">
                        <div class="box-header">
                            <h3 class="box-title">Attendance List</h3>
                        </div>
                        <!-- /.box-header -->

                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-striped">

                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Date</th>
                                    </tr>

                                </thead>

                                <tbody>
                                    <?php
                            $result = $db->prepare("SELECT * FROM attendance WHERE emp_id='$id' AND date BETWEEN '$d1' AND '$d2' ORDER BY id ASC");
				            $result->bindParam(':userid', $date);
                            $result->execute();
                            for($i=0; $row = $result->fetch(); $i++){
                                ?>
                                    <tr>
                                        <td><?php echo $row['id'];?></td>
                                        <td><?php echo $row['date']; if($row['action']==1){ echo '(Half Day)'; }?></td>

                                        <?php } ?>
                                    </tr>
                                </tbody>
                                
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <?php } ?>
                    <!-- /.box -->
                </div>

                <div class="col-md-6">
                    <?php if(isset($_GET['id'])){ ?>
                    <div class="box box-danger">
                        <div class="box-header">
                            <h3 class="box-title">Salary Advance List</h3>
                        </div>
                        <!-- /.box-header -->

                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-striped">

                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Note</th>
                                    </tr>

                                </thead>

                                <tbody>
                                    <?php
                            $result = $db->prepare("SELECT * FROM salary_advance WHERE emp_id='$id' AND date BETWEEN '$d1' AND '$d2' ORDER BY id ASC");
				            $result->bindParam(':userid', $date);
                            $result->execute();
                            for($i=0; $row = $result->fetch(); $i++){
                                ?>
                                    <tr>
                                        <td><?php echo $row['id'];?></td>
                                        <td><?php echo $row['date']?></td>
                                        <td>Rs.<?php echo $row['amount'];?></td>
                                        <td><?php echo $row['note'];?></td>

                                        <?php	} ?>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <th></th>
                                    <th></th>
                                    <th>Rs.<?php echo number_format($adv,2); ?></th>
                                    <th></th>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <?php } ?>
                    <!-- /.box -->
                </div>
            </div>
            <!-- /.box -->
        </section>
        <!-- /.content -->

        <section class="content">


    </div>

    </section>




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
    });
    </script>
</body>

</html>