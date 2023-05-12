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

    $patientNameQuery = "SELECT name FROM user inner join patient on user.nic=patient.nic WHERE patientID = '$pid'";
    $patientName = mysqli_fetch_assoc(mysqli_query($con, $patientNameQuery))['name'];

    $recID_query = "SELECT receptionistID FROM receptionist WHERE nic = '$nic'";
    $result_recID = mysqli_query($con, $recID_query);
    $recID = mysqli_fetch_assoc($result_recID)['receptionistID'];

    $appointmentCountPerDayQuery = "select count(*) from appointment where patientID = '$pid' and date='$date';";
    $appointmentCountPerDay = mysqli_fetch_assoc(mysqli_query($con, $appointmentCountPerDayQuery))['count(*)'];

    if($appointmentCountPerDay == 1){
        header("location: " . BASEURL ."/Homepage/homepageAppointment.php?warning=Already you have an appointment this day. Try another date.");
        exit();
    }

    $query = "INSERT INTO `appointment`(`date`, `time`, `doctorID`, `patientID`, `message`, `status`, `receptionistID`) 
    VALUES ('$date','$time','$doctor','$pid','$msg','Confirmed', '$recID')";
    $result = mysqli_query($con, $query);


    $query = "INSERT INTO `purchases`(`patientID`, `date`, `quantity`, `paid_status`, `paid_status1`, `item`, `item_flag`) 
    VALUES ('$pid', '$date',1, 'not paid', 'Not paid', 4, 's')";
    $result = mysqli_query($con, $query);

    $query = "INSERT INTO `notification`( `nic`, `Message`, `Timestamp`) 
              VALUES ('$docNIC','An appointment booked by patient No $pid',CURRENT_TIMESTAMP)";
    $result = mysqli_query($con, $query);

    header("location: " . BASEURL ."/Receptionist/makeAppointment.php");
}else{
    header("location: " . BASEURL ."/Receptionist/makeAppointment.php");
}
