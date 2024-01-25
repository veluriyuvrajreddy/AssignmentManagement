<?php
session_start();
$name3 = $_SESSION["name"] ;
$sub3=$_SESSION["subname"];
$json = file_get_contents('php://input');
$prem = json_decode($json, true) ;
$task = $_GET["task"];
include './config.php';



if($task == "assignment_name")
{
    $time=date("d-m-y");
    $assignment = $prem["assignment_name"];
    $sql = "INSERT INTO assignments(subject_name,assignment_name,is_active,date,user_name2) VALUES('$sub3','$assignment','false','$time','$name3')";
    if(mysqli_query($db,$sql)) 
    {
       if(mkdir($assignment)) echo "done";
    }
    else echo "error";
}

if($task == "assignments")
{
    $sql = "SELECT * FROM assignments WHERE subject_name = '$sub3' AND user_name2='$name3' ";
    $res = mysqli_query($db,$sql) ;
echo json_encode(mysqli_fetch_all($res));
}

if($task == "is_active")
{
    $assignment = $prem["assignment_name"];
    $sql = "SELECT * FROM assignments WHERE assignment_name = '$assignment' AND subject_name = '$sub3' AND user_name2='$name3'";
    $res = mysqli_query($db,$sql);
    $row = mysqli_fetch_assoc($res);
    $check = "false" ;
    if($check == $row["is_active"]) 
    {
        $sql1 = "UPDATE assignments SET is_active = 'true' WHERE id = ".$row['id']."";
        if(mysqli_query($db,$sql1))
        {
            echo "done";
        }
        else echo "error";
    }
    else
    {
        $sql1 = "UPDATE assignments SET is_active = 'false' WHERE id = ".$row['id']."";
        if(mysqli_query($db,$sql1))
        {
            echo "done";
        }
        else echo "error";
    }
}



if($task == "delete")
{
    $assignment_name = $prem["delete_assignment"];
    $sql = "DELETE FROM assignments WHERE assignment_name = '$assignment_name' AND subject_name = '$sub3' AND user_name2='$name3'";
    $check = "false" ;
    if(mysqli_query($db,$sql)) 
    {
        foreach ( glob($assignment_name."/*") as $file )
{
    unlink($file);
}
rmdir($assignment_name);
echo "done";
    }
    else
    {
        echo "error";
    }
}
?>