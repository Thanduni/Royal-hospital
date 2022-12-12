<?php

$con = new mysqli('localhost','root','','royalhospital');

if(!$con){
    die(mysqli_error($con));
}
?>