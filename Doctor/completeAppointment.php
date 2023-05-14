<?php
session_start();
require_once("../conf/config.php");

if(isset($_GET['patientid'])){
    $patientID = $_GET['patientid'];
    $appointmentID = $_GET['appointmentid'];
    echo $patientID;
    echo $appointmentID;

    //get date and time
    date_default_timezone_set('Asia/Colombo');
    $date = date("Y-m-d");

    //update appointment status to complete
    $update = "UPDATE appointment SET status='Complete' WHERE patientID = $patientID AND appointmentID = $appointmentID;";
    $update_query=mysqli_query($con,$update);

    //insert channeling fee
    $channel_fee ="INSERT INTO purchases(patientID, date, quantity, paid_status, paid_status1, item, item_flag) VALUES ('$patientID', '$date',1, 'not paid', 'Not paid', 4, 's')";
    $channel_fee_query = mysqli_query($con,$channel_fee);

    if($update_query&& $channel_fee_query){
        // Set doctorBusy to true
        $_SESSION['doctor_busy'] = false;
        header("Location: doctorDash.php");
    }
}