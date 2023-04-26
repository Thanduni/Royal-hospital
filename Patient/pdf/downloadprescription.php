<?php
session_start();
require_once("./conf/config.php");
require("fpdf.php");

$pdf = new FPDF();

$pdf->AddPage();
$ppdf->SetFront("Arial","B",18);

if(isset($_SESSION['mailaddress']) && $_SESSION['userRole'] == 'Patient'){

$nic = $_SESSION['nic'];
$pid_query = "SELECT patientID FROM patient WHERE nic = '$nic'";
$result_pid = mysqli_query($con, $pid_query);
$pid = mysqli_fetch_assoc($result_pid)['patientID'];

$query = "select * from prescription where patientID = $pid";
$res = mysqli_query($con,$query);

$prescriptionID =  mysqli_fetch_assoc($res)['prescriptionID'];
$test_flag = mysqli_fetch_assoc($res)['prescriptionID'];
$drug_flag =
$date =
$gender = 
$age = 
$patientID







}

?>