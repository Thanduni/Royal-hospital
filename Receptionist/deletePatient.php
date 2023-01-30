<?php
session_start();
require_once("../conf/config.php");

$query = "DELETE FROM user WHERE nic = '".$_GET['id']."'";
$result = mysqli_query($con, $query);

header("location:" . BASEURL . "/Receptionist/patientPage.php");
