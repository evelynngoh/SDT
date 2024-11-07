<?php

$servername="localhost";
$username="root";
$password="";
$database="studentregistration";

//create connection
$conn=mysqli_connect($servername,$username,$password,$database);

if(!$conn){
    die("Connection Failed: " . mysqli_connect_error());
}
else{
    echo "Connected succesfully";
}

?>
