<?php
include("connection.php");
session_start();
if(isset($_POST["Login"])){
    $username=$_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query="SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result=mysqli_query($con, $query);
    $check=mysqli_num_rows($result);
    if($check=== 1){
        $_SESSION["username"]=$username;
        header("location:index.php");
        exit();
    }
    else{
        echo"Incorrect username or password.";
    }

}


