<?php
require_once("../conf/config.php");

if(isset($_GET['patientid'])){
    $patientID = $_GET['patientid'];
    $appointmentID = $_GET['appointmentid'];

    $update = "UPDATE appointment SET status='Complete' WHERE patientID = $patientID AND appointmentID = $appointmentID;";
    $update_query=mysqli_query($con,$update);
    if($update_query){
        header("Location: doctorDash.php");
    }
}