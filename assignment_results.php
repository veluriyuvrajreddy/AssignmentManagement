<?php
session_start();
error_reporting(0);
include './config.php';
$user=$_GET["user"];
$subject = $_GET["subject"];
$assignment_name = $_GET["assignment_name"];
$sql = "SELECT * FROM submitted_students WHERE user='$user' AND subject1='$subject' AND assignment_name = '$assignment_name' ORDER BY roll_number ASC";
$res = mysqli_query($db,$sql) ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<style>

</style>
<div style="background-color:#576b95;padding:10px;color:white">
<center><h4>Assignment Pdfs</h4></center>
</div>
    <div class="container">
    <div class="row" >
    <div class="col-sm-1"></div>
    <div class="col-sm-10">
    <br>
    <center><h3><?php echo $_GET["assignment_name"]; ?></h3>
    <hr style="border:1px solid blue">
    </center>
    <br>
    <strong>Submitted Students : <?php echo mysqli_num_rows($res); ?></strong> 
    <br>
    <strong>Remaining Students : <?php echo 59-mysqli_num_rows($res); ?></strong> 
<br><br>
<hr>

<div class="row" >
        <div class="col-sm-2"></div>
        <div class="col-sm-3">
            <center><h4>Students</h4></center>
        </div>
        <div class="col-sm-1"></div>
        <div class="col-sm-4">
            <center><h4>Marks</h4></center>
        </div>
        <form action="" method="post">
        <div class="col-sm-2">
            <center><button class="btn btn-success" type="submit" name="upload"id="upload">Submit</button></center>
        </div>
</div>
<br>
    <?php
    while($row = mysqli_fetch_assoc($res)){
        ?>
        <div class="row" >
        <div class="col-sm-2"></div>
        <div class="col-sm-4">
        <p><b><?php echo $row["roll_number"]; ?></b>: <a href="<?php echo $domain.$assignment_name."/".$row["roll_number"].".pdf"; ?>" target="_blank">Click Here</a> </p>
        </div>
        
        <div class="col-sm-4">
        <input type="text" class="form-control" placeholder="/10"  name="<?php echo "y_".$row["roll_number"]?>" id="<?php echo "y_".$row["roll_number"]?>" value=" <?php echo $row["marks"]."/10"?>">
        </div>
    </div>
    <?php
    }
    ?>
    </form>
    </div>
    <div class="col-sm-2"></div>
    </div>
    </div>
</body>
</html>
<?php
if (isset($_POST["upload"]))
{  
    $sql = "SELECT * FROM submitted_students WHERE user='$user' AND subject1='$subject' AND assignment_name = '$assignment_name' ORDER BY roll_number ASC";
    $res = mysqli_query($db,$sql) ;
    while($row = mysqli_fetch_assoc($res))
    {
        
        $roll_num=$row["roll_number"];
        $x="y_".$roll_num;
        $marks1=$_POST["$x"];
        $sql = "UPDATE submitted_students SET marks='$marks1' WHERE roll_number='$roll_num' AND user='$user' AND subject1='$subject' AND assignment_name = '$assignment_name' ORDER BY roll_number ASC" ;
        mysqli_query($db, $sql);
    }
    header("location:".$domain."assignment_results.php?security_key=JFJYhgcdydHJV56486456GHTDTRfdtrdrft54874NBVGHCGC5484545&subject=$subject&assignment_name=$assignment_name&user=$user");
}
?>





