<?php
session_start();
// connect to the database
require_once("../conf/config.php");


$start = $_POST['start'];
$end = $_POST['end'];
$day = $_POST['day'];

$query = "SELECT doctor.doctorID FROM doctor INNER JOIN user ON doctor.nic=user.nic WHERE user.nic='".$_SESSION['nic']."'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

$query = "DELETE FROM doctor_working_hours WHERE doctorID='".$row["doctorID"]."' AND day_of_week='".$day."'";
$result = mysqli_query($con, $query);

for($i=0; $i<sizeof($start); $i++){
    $query = "INSERT INTO doctor_working_hours(doctorID, day_of_week, start_time, end_time) VALUES ('".$row["doctorID"]."', '".$day."' , '". $start[$i] ."' , '". $end[$i] ."');";
    $result = mysqli_query($con, $query);
}

//$query = "INSERT INTO doctor_working_hours(start_time, end_time) VALUES ('$start', '$end');";
//$result = mysqli_query($con, $query);

$array = array('status' => "Success");

echo json_encode($array);
