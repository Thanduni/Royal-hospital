<?php
require_once("../conf/config.php");
session_start();

if (isset($_POST['verify'])) {
    $otp = $_POST['otp'];
    $email = $_SESSION['mailaddress'];

    $otpQuery = "Select otp from user where email = '$email'";
    $userOTP = mysqli_fetch_assoc(mysqli_query($con, $otpQuery))['otp'];

    if($otp === $userOTP){
        $verifyQuery = "update user set verify = '1' where email = '$email'";
        mysqli_query($con, $verifyQuery);
        $userRole = $_SESSION['userRole'];
        if ($userRole == "Admin")
            header("location: " . BASEURL . "/Admin/adminDash.php");
        else if ($userRole == "Doctor")
            header("location: " . BASEURL . "/Doctor/doctorDash.php");
        else if ($userRole == "Nurse")
            header("location: " . BASEURL . "/Nurse/nursedashboard.php");
        else if ($userRole == "Receptionist")
            header("location: " . BASEURL . "/Receptionist/receptionistDash.php");
        else if ($userRole == "Patient")
            header("location: " . BASEURL . "/Patient/patientDash.php");
        else if ($userRole == "Storekeeper")
            header("location: " . BASEURL . "/Storekeeper/storekeeperDash.php");
    } else{
        header("location: " . BASEURL . "/Homepage/verify.php?error=Incorrect OTP. Try again.");
    }
}