<?php
include("connection.php");
if(mysqli_connect_errno()){
    echo "connection error";
}
else{
    $username=$_POST["username"] ?? null;
    $email=$_POST["email"] ?? null;
    $password=$_POST["password"] ?? null;
    $sql= "INSERT INTO `user`(`userid`, `username`, `email`, `password`) VALUES (NULL,'$username','$email','$password')";
    $result=mysqli_query($con,$sql);
    if($result){
        //echo"signup complete";
    }
    else{
        echo "signup error";
    }
}
if(isset($_POST["Confirm"])){
    header("location:login.html");
}


