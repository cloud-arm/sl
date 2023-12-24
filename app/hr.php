<!DOCTYPE html>
<html lang="en">

<head>
<?php include('hed.php'); ?>
</head>

<body>
    <?php include('preload.php'); include("../connect.php"); $date=date('Y-m-d');?>
    <br><br>
    <h3 style="margin: 15px; color:#dbdbdb">Human Resources Management</h3>
    <br>
    
   

    <div class="model-box" style="margin:15px">
    <div align="right" style="width:100%;">
            <a style="width:30%;" href="hr_attendance.php">
                <div
                    style="background-color: #9A2222; color:#dbdbdb; width:40%; text-align: center; border-radius: 0px 15px 0px 15px ; ">
                    GO</div>
            </a>
        </div>
        <div class="align-line">
            <h1 style="margin: 15px; color:#B5B5B8">
       <i class="fa fa-fingerprint"></i>
        </h1>
        <center><h1>Attendance</h1></center>
        
           
        </div>
    </div>

    <div class="model-box" style="margin:15px">
    <div align="right" style="width:100%;">
            <a style="width:30%;" href="hr_advance.php">
                <div
                    style="background-color: #9A2222; color:#dbdbdb; width:40%; text-align: center; border-radius: 0px 15px 0px 15px ; ">
                    GO</div>
            </a>
        </div>
        <div class="align-line">
            <h1 style="margin: 15px; color:#B5B5B8">
       <i class="fa fa-usd"></i>
        </h1>
        <center><h1>Advance</h1></center>
        </div>
    </div>
    

   




    <br><br><br><br>
    <?php $nav="hr"; include('nav.php'); ?>

</body>
<!-- jQuery 2.2.3 -->
<script src="../../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../../bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="../../../plugins/morris/morris.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="../../../plugins/chartjs/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../../../plugins/sparkline/jquery.sparkline.min.js"></script>

<script src="js/nav.js"></script>
<script>
$(function() {

    // Line charts taking their values from the tag
    $('.sparkline-1').sparkline();

    //INITIALIZE SPARKLINE CHARTS
    $(".sparkline").each(function() {
        var $this = $(this);
        $this.sparkline('html', $this.data());
    });

});
</script>

</html>