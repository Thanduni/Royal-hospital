<?php
session_start();

require_once("../conf/config.php");

if(isset($_POST['change'])){
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $email = $_GET['email'];

    if($password == $confirmPassword){
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $updateQuery = "update user set password='$password' where email='$email'";
        mysqli_query($con, $updateQuery);
        header("location:".BASEURL."/Homepage/login.php?success=Your password changed. Now you can login with your new password.");
    } else {
        header("location:".BASEURL."/Homepage/changePassword.php?error=The entered passwords are different. Try again.&email=".$email);
    }
}