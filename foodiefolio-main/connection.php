<?php
$server="localhost";
$username="root";
$password= "";
$dbname= "foodiefolio";
$port=3306;
$con=mysqli_connect($server,$username,$password,$dbname);
if(mysqli_connect_errno())
{
    //echo "Failed to connect to MySQL:" . mysqli_connect_error();
    exit();
}
else
{
    //echo "Connected to DB";
}


