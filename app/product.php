<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('hed.php'); ?>
</head>

<body>

    <?php include('preload.php'); ?>

    <br><br>
    <h2 style="margin:10px">CUSTOMERS</h2>
    <br><br>
    <center>

        <form action="" method="get">
            <input type="text" name="number" class="model-box v-3" placeholder="Product">
            <input class="model-box" type="submit" value="Filter">
        </form>
    </center>
    <br>
    <?php include("../connect.php");
    if(!$_GET["number"]){ $result = $db->prepare("SELECT *  FROM product ");}else{ $number=$_GET["number"];
        $result = $db->prepare("SELECT *  FROM product WHERE name LIKE '%$number%' OR  code LIKE '$number%' ");
    }
    
    $result->bindParam(':userid', $date);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){
    ?>
    <div
        style="border-radius: 15px; background: linear-gradient(to left,#0E1020,#181929); color:aliceblue;  margin: 55px 10px 10px 10px; ">




        <p style="font-size: 20px; color:#B8B8B8; margin:5px;"><?php echo $row['name'] ?></p>
        <p align="right" style="margin: -5px 5px 5px">Rs.<?php echo $row['sell'] ?></p>
        <?php if($_SESSION['SESS_LAST_NAME']=='admin'){ ?>
        <p align="right" style="margin: -5px 5px 5px; color:red;">Rs.<?php echo $row['cost'] ?></p>
        <?php } ?>


        <table width="100%">
            <tr>
                <td>
                    <p style="margin: -5px 5px 5px; color: #B8B8B8;"><?php echo $row['code'] ?></p>
                </td>
                <td>
                    <p style="margin: -5px 5px 5px"><?php echo $row['type'] ?></p>
                </td>
                <td>
                    <p style="margin: -5px 5px 5px">Stock:<?php echo $row['qty'] ?></p>

                </td>

            </tr>
        </table>




    </div>
    <?php } ?>

    <br><br><br><br>
    <?php $nav="product"; include('nav.php'); ?>
</body>
<script src="js/nav.js"></script>

</html>