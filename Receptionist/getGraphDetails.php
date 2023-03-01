<?php
session_start();
require_once("../conf/config.php");

$patientMale = mysqli_num_rows(mysqli_query($con, "select * from user where user_role = 'Patient' and gender = 'm';"));
$nurseMale = mysqli_num_rows(mysqli_query($con, "select * from user where user_role = 'Nurse' and gender = 'm';"));
$storekeeperMale = mysqli_num_rows(mysqli_query($con, "select * from user where user_role = 'Storekeeper' and gender = 'm';"));
$receptionistMale = mysqli_num_rows(mysqli_query($con, "select * from user where user_role = 'Receptionist' and gender = 'm';"));
$doctorMale = mysqli_num_rows(mysqli_query($con, "select * from user where user_role = 'Doctor' and gender = 'm';"));

$patientFemale = mysqli_num_rows(mysqli_query($con, "select * from user where user_role = 'Patient' and gender = 'f';"));
$nurseFemale = mysqli_num_rows(mysqli_query($con, "select * from user where user_role = 'Nurse' and gender = 'f';"));
$storekeeperFemale = mysqli_num_rows(mysqli_query($con, "select * from user where user_role = 'Storekeeper' and gender = 'f';"));
$receptionistFemale = mysqli_num_rows(mysqli_query($con, "select * from user where user_role = 'Receptionist' and gender = 'f';"));
$doctorFemale = mysqli_num_rows(mysqli_query($con, "select * from user where user_role = 'Doctor' and gender = 'f';"));

$male = array($receptionistMale, $doctorMale, $nurseMale, $patientMale, $storekeeperMale);
$female = array($receptionistFemale, $doctorFemale, $nurseFemale, $patientFemale, $storekeeperFemale);

echo json_encode(array($male, $female));

?>