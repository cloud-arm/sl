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
                <input type="text" name="number" class="model-box v-3" placeholder="Vehicle NO" > 
                <input class="model-box" type="submit" value="Filter">
            </form>
    </center>
    <br>
    <?php include("../connect.php");
    if(!$_GET["number"]){ $result = $db->prepare("SELECT  model.parth, model.name , vehicle.*  FROM vehicle INNER JOIN model ON vehicle.model= model.name ORDER BY vehicle.id DESC LIMIT 30");}else{ $number=$_GET["number"];
        $result = $db->prepare("SELECT  *  FROM vehicle  WHERE vehicle_no='$number'");
    }
    
    $result->bindParam(':userid', $date);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){
    ?>
    <div
        style="border-radius: 15px; background: linear-gradient(to left,#0E1020,#181929); color:aliceblue;  margin: 55px 10px 10px 10px; ">


        <img align="left" style=" width: 150px; margin:-35px 0px 0px 10px; color:#dbdbdb;"
            src="../<?php echo $row['parth'];  ?>" alt="">

        <p align="right" style="font-size: 20px; color:#B8B8B8; margin:5px;"><?php echo $row['name'] ?></p>
        <p align="right" style="margin: -5px 5px 5px"><?php echo $row['vehicle_no'] ?></p>

        <table width="100%">
            <tr>
                
                <td>

                    
                </td>
                
            </tr>
        </table>

        <div align="left" style="width:100%;">
        <p style="color:#333654; margin: 0 0 -20px 15px;">Mr.<?php echo $row['customer_name'] ?></p>
        </div>
        
        <div align="right" style="width:100%;">
            <a style="width:30%;" href="profile.php?id=<?php echo $row['id']; ?>">
                <div
                    style="background-color: #3E41F0; color:#dbdbdb; width:30%; text-align: center; border-radius: 15px 0px 15px 0px; ">
                    Details</div>
            </a>
        </div>
    </div>
    <?php } ?>

    <br><br><br><br>
    <?php $nav="customer"; include('nav.php'); ?>
</body>
<script src="js/nav.js"></script>

</html>