<?php
session_start();
require_once("../conf/config.php");

$query = "UPDATE notification set Status = '1' where notificationID='".$_GET['notID']."';";
$result = mysqli_query($con, $query);
header("Location: ".BASEURL."/Nurse/nursedashboard.php");
?>

