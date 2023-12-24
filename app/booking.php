<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('hed.php'); ?>
    <link rel="stylesheet" href="css/datepik.css">
</head>

<body>
    <?php include('preload.php'); include("../connect.php"); $date=date('Y-m-d');?>
    <br>
    <a href="index.php"><i style="font-size:30px; color:#3A3939; margin:6%" class="ion-chevron-left"></i></a>
    <br>
    <h2 style="margin: 15px; color:#dbdbdb">Advance</h2>
    <br>

   <a href="booking_add.php"><div style="margin: 10px;" >ADD Booking</div></a>
<br><br>


        <?php $result = $db->prepare("SELECT * FROM booking WHERE  action= '0' ORDER BY id DESC LIMIT 20");
        $result->bindParam(':userid', $res);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){   ?>


        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
        <div style="border-radius: 15px; background-color: #181929; color:aliceblue; margin: 2%; ">

            <table style="width:100%;  margin: 10px;">
                <tr>
                    <td>
                        <h3 style="color:#D1D1D1; margin: 10px;"><?php echo $row['vehicle_no']; ?></h3>
                    </td>
                    <td><?php echo $row['type']  ?></td>
                    
                </tr>
                <tr>
                    <td style="color:#959595;font-size: 20px;"> <?php echo $row['customer_name']; ?></td>
                    <td style="color:#959595"></td>

                </tr>
            </table>

            <p style="margin:10px"><?php echo nl2br($row['note']);  ?></p>

            <table style="width:100%">
                <tr>
                    <td>
                        <div align="left" style="width:100%;">

                            <div class="bg-green"
                                style="color:#dbdbdb; width:100px;  text-align: center; border-radius: 15px 15px 15px 15px ">
                                <?php echo $row['booking_date'];?></div>

                        </div>
                    </td>


                    <td>
                        <div align="right" style="width:100%;">
                           
                                <div class="bg-red"
                                    style="color:#dbdbdb; width:100px;  text-align: center; border-radius: 15px 0px 15px 0px">
                                    <?php echo $row['contact']; ?></div>
                          

                        </div>
                    </td>
                </tr>
            </table>

        </div>
    </div>
        <?php } ?>

        <div >
        <br><br><br>- <br><br><br>
        </div>


   
    <?php $nav="home"; include('nav.php'); ?>

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