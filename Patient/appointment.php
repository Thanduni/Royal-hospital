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

    $docNIC_query = "SELECT nic FROM doctor WHERE doctorID = '$doctor'";
    $result_docNIC = mysqli_query($con, $docNIC_query);
    $docNIC = mysqli_fetch_assoc($result_docNIC)['nic'];

    $nic = $_SESSION['nic'];
    $pid_query = "SELECT patientID FROM patient WHERE nic = '$nic'";
    $result_pid = mysqli_query($con, $pid_query);
    $pid = mysqli_fetch_assoc($result_pid)['patientID'];

    $_SESSION['patientID'] = $pid;

    $appointmentCountPerDayQuery = "select count(*) from appointment where patientID = '$pid' and date='$date';";
    $appointmentCountPerDay = mysqli_fetch_assoc(mysqli_query($con, $appointmentCountPerDayQuery))['count(*)'];

    if($appointmentCountPerDay == 1){
        header("location: " . BASEURL ."/Patient/patientDash.php?warning=Already you have an appointment this day. Try another date.");
        exit();
    }

    $query = "INSERT INTO `appointment`(`date`, `time`, `doctorID`, `patientID`, `message`, `status`) 
    VALUES ('$date','$time','$doctor','$pid','$msg','Confirmed')";
    $result = mysqli_query($con, $query);

    $appIdQuery = "SELECT LAST_INSERT_ID()";
    $appID = mysqli_fetch_assoc(mysqli_query($con, $appIdQuery))['LAST_INSERT_ID()'];

    $query = "INSERT INTO `purchases`(`patientID`, `date`, `quantity`, `paid_status`, `paid_status1`, `item`, `item_flag`, `appointmentID`) 
    VALUES ('$pid' ,'$date',1,'not paid', 'Not paid', 3, 's', NULL), ('$pid', '$date',1, 'not paid', 'Not paid', 4, 's', '$appID')";
    $result = mysqli_query($con, $query);

    $query = "INSERT INTO `notification`( `nic`, `Message`, `Timestamp`) 
              VALUES ('$docNIC','An appointment booked by patient No $pid',CURRENT_TIMESTAMP)";
    $result = mysqli_query($con, $query);

    header("location: " . BASEURL ."/Patient/patientDash.php");
}else{
    header("location: " . BASEURL ."/Patient/patientDash.php");
}
