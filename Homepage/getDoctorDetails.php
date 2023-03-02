<?php
require_once("../conf/config.php");
session_start();

$nic = $_POST['nic'];

$query = "SELECT * FROM user INNER JOIN doctor ON user.nic = doctor.nic WHERE user.nic = '$nic'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);

echo json_encode($row);