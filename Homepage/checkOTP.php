<?php
session_start();
require_once("../conf/config.php");

if(isset($_POST['submit'])){
    $otp = $_POST['otp'];
    $email = $_GET['email'];

    $otpQuery = "Select otp from user where email='$email'";
    $otpUser = mysqli_fetch_assoc(mysqli_query($con, $otpQuery))['otp'];

    if($otp == $otpUser){
        header("location:" . BASEURL . "/Homepage/changePassword.php?email=".$email."&otp=verified");
    }else{
        header("location:" . BASEURL . "/Homepage/enterOTP.php?error=Incorrect OTP. Try again.&email=".$email);
    }
}