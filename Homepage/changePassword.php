<?php
session_start();
//require_once("/xampp/htdocs/Royalhospital/conf/config.php");

require_once("../conf/config.php");
if(!isset($_SESSION['mailaddress']) && $_GET['otp'] == 'verified'){
    ?>

    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="<?php echo BASEURL.'/css/style.css' ?>">
        <link rel="stylesheet" href="<?php echo BASEURL.'/css/forgotPassword.css' ?>">
        <title>Changed password</title>
    </head>
    <body>
    <?php include(BASEURL . '/Components/Navbar.php'); ?>
    <div class="verify">
        <div class="verifyPart">
            <div class="form">
                <h1>New password</h1>
                <form action="<?php echo BASEURL . '/Homepage/processNewPassword.php?email='.$_GET['email'] ?>" method="post" onsubmit="return validatePasswordForm()">
                    <div class="alert" id="warning">
                        <?php
                        if(@$_GET['error'])
                            echo $_GET['error'];
                        ?>
                    </div>
                    <div class="group">
                        <input type="password" name="password" id="password1">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>New password</label>
                    </div>
                    <div class="alert" style="width: 286px; word-break: break-word; margin-right: 10px" id="password1Div"></div>
                    <div class="group">
                        <input type="password" name="confirmPassword"  id="password2">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Confirm password</label>
                    </div>
                    <div class="alert" style="width: 286px; word-break: break-word; margin-right: 10px" id="password2Div"></div>
                    <button type="submit" name="change" class="custom-btn">
                        Change
                    </button>
                </form>
            </div>
        </div>
        <div class="verifyDesign">
            <div class="verifyInfo">
                <h2>Change password?</h2>
                <p>Dear user, Please create a new password that you don't use on any other site.</p>
            </div>
            <img src="<?php echo BASEURL.'/images/otpDesign.png' ?>" alt="">
        </div>
    </div>
    <script src=<?php echo BASEURL . '/js/ValidatePassword.js' ?>></script>
    </body>
    </html>

<?php } else if(isset($_SESSION['mailaddress']) && $_SESSION['verify'] == 1){
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
}  else {
    header("location: " . BASEURL . "/Homepage/login.php");
}?>