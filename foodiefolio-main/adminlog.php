<?php
include("connection.php");
session_start();
if(isset($_POST["Login"])){
    $adname=$_POST['username'];
    $adpass = $_POST['password'];
    $query="SELECT * FROM admin WHERE adname='$adname' AND adpass='$adpass'";
    $result=mysqli_query($con, $query);
    $check=mysqli_num_rows($result);
    if($check=== 1){
        $_SESSION["username"]=$adname;
        header("location:dash.php");
        exit();
    }
    else{
        echo"Incorrect username or password.";
    }

}


