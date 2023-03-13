<?php
session_start();
require_once("../conf/config.php");

$nic = $_POST['nic'];

$sql = "SELECT * FROM patient INNER JOIN user on patient.nic = user.nic where patient.nic='$nic';";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

echo json_encode($row);
//echo json_encode(array("status" => $sql));