<?php
session_start();
//die( $_SESSION['mailaddress']);
require_once("../conf/config.php");

if (isset($_POST["submit"])) {

    $date = $_POST['date'];
    $department = $_POST['department'];
    $doctor = $_POST['doctor'];
    $time = $_POST['time'];
    $pid = $_POST['patient'];
    $msg = $_POST['msg'];
    $nic = $_SESSION['nic'];

    $docNIC_query = "SELECT nic FROM doctor WHERE doctorID = '$doctor'";
    $result_docNIC = mysqli_query($con, $docNIC_query);
    $docNIC = mysqli_fetch_assoc($result_docNIC)['nic'];

    $recID_query = "SELECT receptionistID FROM receptionist WHERE nic = '$nic'";
    $result_recID = mysqli_query($con, $recID_query);
    $recID = mysqli_fetch_assoc($result_recID)['receptionistID'];

    $query = "INSERT INTO `appointment`(`date`, `time`, `venue`, `doctorID`, `patientID`, `message`, `status`, `receptionistID`) 
    VALUES ('$date','$time','[value-4]','$doctor','$pid','$msg','Confirmed', '$recID')";
    $result = mysqli_query($con, $query);

    $query = "INSERT INTO `purchases`(`patientID`, `date`, `quantity`, `paid_status`, `item`, `item_flag`) 
    VALUES ('$pid' ,'$date',1,'not paid', 3, 's'), ('$pid', '$date',1,'not paid', 4, 's')";
    $result = mysqli_query($con, $query);

    $query = "INSERT INTO `notification`( `nic`, `Message`, `Timestamp`) 
              VALUES ('$docNIC','An appointment booked by patient No $pid',CURRENT_TIMESTAMP)";
    $result = mysqli_query($con, $query);

    header("location: " . BASEURL ."/Receptionist/makeAppointment.php");
}else{
    header("location: " . BASEURL ."/Receptionist/makeAppointment.php");
}
