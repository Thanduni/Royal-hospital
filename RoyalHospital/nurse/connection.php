<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "royalhospital";

$connection = mysqli_connect('localhost', 'root','','royalhospital');

// checking connection
if(mysqli_connect_errno()){
    die('Database connection failed '. mysqli_connect_error());
}

?>


<!-- <?php 
// $connection = mysqli_connect('localhost','root','','royalhospital');

// if(!$connection){
//     die('Please check your connection'.mysqli_error());
// }
?> -->