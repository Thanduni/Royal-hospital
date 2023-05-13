<?php
session_start();
require_once("../conf/config.php");

$query = "DELETE from notification where notificationID='".$_GET['notID']."';";
$result = mysqli_query($con, $query);
header("Location: ".BASEURL."/Admin/adminDash.php");
?>

