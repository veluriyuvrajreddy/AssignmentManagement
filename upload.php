<?php
error_reporting(0);
include './config.php';
$user=$_GET["user"];
$subject = $_GET["subject"];
$assignment_name = $_GET["assignment_name"];
$sql = "SELECT is_active FROM assignments WHERE user_name2='$user' AND subject_name='$subject' AND assignment_name = '$assignment_name'";
$res = mysqli_query($db,$sql);
$row = mysqli_fetch_assoc($res);

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
body{
     background-color:#2d3b45;
     
     }
</style>
    <div class="container">
    <div class="row" style="margin-top:20%">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
    <?php
    if($row["is_active"] == "true") { 
   if($_GET["error"]){
   ?>
    <div class="alert alert-danger" role="alert" style="text-align:center;">
 Not Uploaded
</div>
  <?php
   }
  ?>
   <?php
   if($_GET["success"]){
   ?>
    <div class="alert alert-success" role="alert" style="text-align:center;">
 Uploaded successfully
</div>
  <?php
   }
  ?>
  <?php
   if($_GET["file_size"]){
   ?>
    <div class="alert alert-danger" role="alert" style="text-align:center;">
 Upload File Less than 10 MB
</div>
  <?php
   }
  ?>
   <form action="" method="post" enctype="multipart/form-data">
   <div class="card" style="padding:10px;">
   <div style="text-align: center;padding:10px;background-color: #00cc99;">
   <center><h3><?php echo $assignment_name; ?></h3></center>
   </div>
   <br>
   <input type="text" class="form-control" placeholder="Enter Roll Number" name="roll" required><br>
   <input type="file" class="form-control" name="pdf_file" accept="application/pdf" required><br>
   <button type="submit" class="btn btn-success" name="submit"> Submit</button>
   </div>
   </form>
   <?php }
   else
   {
   ?>
<h3>Sorry Currently this page is not active.....</h3>
   <?php
   
   }?>
    </div>
    <div class="col-sm-3"></div>
    </div>
    </div>
</body>
</html>

<?php

if(isset($_POST['submit']))
{
    //echo $_FILES["pdf_file"]["size"];

if($_FILES["pdf_file"]["size"] < 10240000)
{
        $roll_number=strval($_POST["roll"]) ;
    $time=date("d-m-y");
   if(move_uploaded_file($_FILES["pdf_file"]["tmp_name"],$assignment_name."/".$roll_number.".pdf"))
   {
$sql = "INSERT INTO submitted_students(roll_number,subject1,assignment_name,date,user) VALUES('$roll_number','$subject','$assignment_name','$time','$user') ";
if(mysqli_query($db,$sql))
{
    header("location:".$domain."upload.php?security_key=JFJYhgcdydHJV56486456GHTDTRfdtrdrft54874NBVGHCGC5484545&subject=".$subject."&assignment_name=".$assignment_name."&user=".$user."&success=done");
}
   }
   else
   {
header("location:".$domain."upload.php?security_key=JFJYhgcdydHJV56486456GHTDTRfdtrdrft54874NBVGHCGC5484545&subject=".$subject."&assignment_name=".$assignment_name."&user=".$user."&error=wrong");
       
   }
}
else
{
    header("location:".$domain."upload.php?security_key=JFJYhgcdydHJV56486456GHTDTRfdtrdrft54874NBVGHCGC5484545&subject=".$subject."&assignment_name=".$assignment_name."&user=".$user."&file_size=wrong");
}


}
?>