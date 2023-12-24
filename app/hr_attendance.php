<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('hed.php'); ?>
    <link rel="stylesheet" href="css/datepik.css">
</head>

<body>
    <?php include('preload.php'); include("../connect.php"); $date=date('Y-m-d');?>
    <br>
    <a href="hr.php"><i style="font-size:30px; color:#3A3939; margin:6%" class="ion-chevron-left"></i></a>
    <br>
    <h2 style="margin: 15px; color:#dbdbdb">Attendance</h2>
    <br>

    <form method="post" action="../hr_attendance_save.php">
        <?php $result = $db->prepare("SELECT * FROM Employees WHERE  action='0' ");
        $result->bindParam(':userid', $res);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){ ?>
        <div class="model-box" style="margin:15px">

            <input type="checkbox" name="emp_<?php echo $row['id'] ?>" id="" value="1">
            <label for="emp_<?php echo $row['id'] ?>"><?php echo $row['name']  ?></label>
        </div>
        <?php } ?>
        <center>
        <input type="text" name="date" id="d1" class="model-box " readonly onclick="calender('d1')" value="<?php echo date('Y-m-d') ?>">
        <input type="submit" value="Save" class="model-box color-red v-3">
        </center>

        <input type="hidden" name="end" value="app">
    </form>

<br><br>
<table style="width: 90%; margin: 5%; border:solid;">
    
    <tbody>
        <?php $result = $db->prepare("SELECT * FROM attendance WHERE  action= '0' ORDER BY id DESC LIMIT 20");
        $result->bindParam(':userid', $res);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){   ?>
        <tr>
            <td><?php echo $row['name'];  ?></td>
            <td><?php echo $row['date']  ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>




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
<script src="js/datepik.js"></script>
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