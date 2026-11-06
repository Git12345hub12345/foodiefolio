<?php
include("connection.php");
if(mysqli_connect_errno()){
    echo "connection error";
}
else{
    $adname=$_POST["username"] ?? null;
    $adpass=$_POST["password"] ?? null;
    $sql= "INSERT INTO `admin`(`adminid`, `adname`, `adpass`) VALUES (NULL,'$adname','$adpass')";
    $result=mysqli_query($con,$sql);
    if($result){
        //echo"signup complete";
    }
    else{
        echo "signup error";
    }
}
if(isset($_POST["Confirm"])){
    header("location:adminlog.html");
}


