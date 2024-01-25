<?php
session_start();
$name2 = $_SESSION["name"] ;
$json = file_get_contents('php://input');
$prem = json_decode($json, true) ;
$task1 = $_GET["task1"];
include './config.php';

if($task1=="subject_name")
{
    $subject=$prem["subject_name"];
    $sql="INSERT INTO subjects(user_name1,subject_name) VALUES('$name2','$subject')";
    if(mysqli_query($db,$sql)) 
    {
        echo "done";
    }
    else echo "error";
}

if($task1=="deletes")
{
    
    $subject=$prem["delete_subject"];
    $sql="DELETE FROM subjects WHERE subject_name = '".$subject."' ";
    if(mysqli_query($db,$sql)) 
    {
        echo "done";
    }
    else echo "error";
}

if($task1== "subjects")
{
    $sql = "SELECT * FROM subjects WHERE user_name1='".$name2."' ";
    $res = mysqli_query($db,$sql) ;
echo json_encode(mysqli_fetch_all($res));
}
?>