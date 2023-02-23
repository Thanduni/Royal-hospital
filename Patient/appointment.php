<?php
session_start();
//die( $_SESSION['mailaddress']);
require_once("../conf/config.php");

if (isset($_POST["submit"])) {

    $date = $_POST['date'];
    $department = $_POST['department'];
    $doctor = $_POST['doctor'];
    $time = $_POST['time'];
    $msg = $_POST['msg'];

//    $query = "SELECT appointmentID FROM appointment WHERE date = '$date' and patientID is NULL";
//    $result = mysqli_query($con, $query);
//    $row1 = mysqli_fetch_array($result);

    $nic = $_SESSION['nic'];
    $pid_query = "SELECT patientID FROM patient WHERE nic = '$nic'";
    $result_pid = mysqli_query($con, $pid_query);
    $pid = mysqli_fetch_assoc($result_pid)['patientID'];

    $_SESSION['patientID'] = $pid;
//    $appID = $row1[0];
//
//    if ($row1) {
//        $sql = "UPDATE `appointment` SET `date`='$date',`patientID`= $pid WHERE appointmentID = $appID";
//        $result = mysqli_query($con, $sql);
//    } else {
//        echo '<h3>No More Apointments!</h3>;';
//    }

    $query = "INSERT INTO `appointment`(`date`, `time`, `venue`, `doctorID`, `patientID`, `message`, `status`) 
    VALUES ('$date','$time','[value-4]','$doctor','$pid','$msg','Confirmed')";
    $result = mysqli_query($con, $query);
//    $row1 = mysqli_fetch_array($result);

    header("location: " . BASEURL ."/Patient/patientDash.php");
}else{
    header("location: " . BASEURL ."/Patient/patientDash.php");
}
