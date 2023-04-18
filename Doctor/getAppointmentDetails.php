<?php
session_start();
// connect to the database
require_once("../conf/config.php");

$nic = $_SESSION['nic'];
$doctorIdSQL = "SELECT doctorID from doctor inner join user on doctor.nic=user.nic where user.nic = '$nic';";
$doctorId = mysqli_fetch_assoc(mysqli_query($con,$doctorIdSQL))['doctorID'];

$appInfoSQL = "select * from appointment a join patient p  on a.patientID = p.patientID join user u on p.nic = u.nic where doctorID = '$doctorId';";
$result = mysqli_query($con, $appInfoSQL);

while ($row = $result->fetch_assoc()) {
        $appInfo[] = $row;
}

echo json_encode($appInfo);
//echo json_encode(array('one' => 'two'));
