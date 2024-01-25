<?php
session_start();
include './config.php';
error_reporting(0);
$sub=$_GET["sub_name"];
$_SESSION["subname"]=$sub;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <style>
        .col-sm-6 {
            margin-top: 30px;
        }

        a {
            text-decoration: none;
        }

        .card {
            margin-top: 15px;
        }

        .card:hover {
            box-shadow: 1px 1px 15px grey;
        }

        body {
            background-color: #F1F2EF;
        }
    </style>
        <form action="" method="post">
    <div style="background-color:#576b95;padding:10px;box-shadow:0px 5px 20px grey;position:fixed;width:100%;z-index:1;top:0px;">
    <div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
        <center>
            <a href="<?php echo $domain."/logout.php" ; ?>" style="color:white;text-decoration:none;">
                <h4>ASSIGNMENT MANAGEMENT</h4>
            </a>
        </center>

        </div>
        <div class="col-sm-3"></div>
        <div class="col-sm-1">
        <button class="btn btn-success" type="submit" name="log-out" id="log-out">Logout</button>
        </div>
        <?php
        if (isset($_POST["log-out"]))
        {
        header("location:".$domain);
        }?>
        </div>
    </div>
    </div>
    </form>
    <div class="container" style="margin-top:100px;">
        <div class="row">
            <div class="col-sm-4">
                <div style="margin-top:30px;">
                    <center><span style="font-size:20px;">Add Assignments</span></center>
                    <hr style="border:1px solid blue;width:100px">

                    <input type="text" name="assignment_name" class="form-control" id="assignment_name"
                        placeholder="Assignment Name" required><br>
                    <center><button name="submit" class="btn btn-success" type="submit"
                            id="add_assignment">Create</button></center>

                </div>

            </div>
            <div class="col-sm-4">
                <div style="margin-top:30px;">
                    <center><span style="font-size:20px;">Is Active</span></center>
                    <hr style="border:1px solid blue;width:40px;">
                    <select class="form-control" name="is_active" id="is_active">

                    </select>
                    <br>
                    <center><button class="btn btn-success" name="is_active_update"
                            id="is_active_update">Update</button></center>
                </div>
            </div>
            <div class="col-sm-4">
                <div style="margin-top:30px;">
                    <center><span style="font-size:20px;">Delete Assignments</span></center>
                    <hr style="border:1px solid blue;width:80px;">

                    <select class="form-control" name="to_delete" id="to_delete">

                    </select>
                    <br>
                    <center><button class="btn btn-danger" name="delete_update" id="delete_update">Delete</button>
                    </center>
                </div>
            </div>
        </div>
        <br>
        <hr style="border:1px solid grey;">

        <div class="row">
            <div class="col-sm-12">
                <div>
                    <div style="padding:10px;">
                        <center><span style="font-size:20px;"><?php echo "$sub "?>Assignments</span></center>
                        <hr style="border:1px solid blue;width:100px">

                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="all_assignments">
            
        </div>
    </div>
    <br><br><br>
    <script src="all1.js"></script>
    
</body>

</html>
