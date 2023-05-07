<?php
session_start();

require "../phpmailer/src/Exception.php";
require "../phpmailer/src/PHPMailer.php";
require "../phpmailer/src/SMTP.php";
require_once("../conf/config.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exceptionsdasd;

if(isset($_POST['continue'])){
    $email = $_POST['email'];

    $emailCheckQuery = "Select count(*) from user where email = '$email'";
    $emailCount = mysqli_fetch_assoc(mysqli_query($con, $emailCheckQuery))['count(*)'];

    if((int)$emailCount){
        $otp = rand(100000, 999999);

        $query1 = "UPDATE USER SET `otp`='$otp' where `email`='$email'";
        $result1 = mysqli_query($con,$query1);

        $mail = new PHPMailer();

        $mail -> isSMTP();
        $mail -> Host = "smtp.gmail.com";
        $mail -> Port = 25;
        $mail -> SMTPAuth = true;
        $mail -> SMTPSecure = 'tls';

        $mail -> Username = 'hospitalroyal56@gmail.com';
        $mail -> Password = 'usygevftzbeyiqea';

        $mail -> setFrom("hospitalroyal56@gmail.com", 'Royal hospital');
        $mail -> addAddress($email);

        $mail -> isHTML(true);
        $mail -> Subject = "Your verify code";
        $mail -> Body = "<p>Dear user, </p> <h3>To reset your password enter the verification code below on the Reset Password screen.<br></h3>
                    <br><br>
                    <h2>$otp</h2>
                    <b>Royal hospital.</b>";

        $mail -> send();
        $mail->smtpClose();
        header("location:" . BASEURL . "/Homepage/enterOTP.php?email=".$email);
    } else {
        header("location:" . BASEURL . "/Homepage/forgotPassword.php?error=Invalid Email. Enter the email correctly.");
    }
}