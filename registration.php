<?php
error_reporting(0);
$error = false ;
include './config.php';
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
   if($_GET["error"]){
   ?>
    <div class="alert alert-danger" role="alert" style="text-align:center;">
 Please Check ALL fields
</div>
  <?php
   }
  ?>
   <form action="" method="post">
   <div class="card" >
    <div style="text-align: center;padding:10px;background-color: #00cc99;">
    <h4>SignUp Form</h4>
    </div>
    <div style="padding:10px;text-align:center;">
    <input type="text" class="form-control" placeholder="Name" name="name" required><br>
    <input type="password" class="form-control" placeholder="Password" name="pass" required><br>
    <p>Already Registered ? <a href="<?php echo $domain; ?>">Click Here</a></p><br>
    <button class="btn btn-success" type="submit" name="submit">Sign Up</button><br>
    </div>
    </div></form>
    </div>
    <div class="col-sm-3"></div>
    </div>
    </div>
</body>
</html>

<?php

$db  = mysqli_connect("sql107.infinityfree.com","if0_35797059","3Knpr5YzT65brwI","if0_35797059_assignments");
if (isset($_POST["submit"]))
{
    $name = $_POST["name"];
    $password = $_POST["pass"];
    $sql = "INSERT INTO user_data(name1,password) VALUES('$name','$password')" ;
    if(mysqli_query($db, $sql)) header("location:".$domain);
    else header("location:".$domain."registration.php?error=wrong");
}

?>

