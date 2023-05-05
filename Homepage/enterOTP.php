<?php
session_start();

require_once("../conf/config.php");
if(!isset($_SESSION['mailaddress'])){
    ?>

    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="<?php echo BASEURL.'/css/style.css' ?>">
        <link rel="stylesheet" href="<?php echo BASEURL.'/css/enterOTP.css' ?>">
        <title>Document</title>
    </head>
    <body>
    <section class="header">
        <?php include(BASEURL . '/Components/Navbar.php'); ?>
        <div class="verify">
            <div class="verifyDesign">
                <div class="verifyInfo">
                    <h2>Code Verification</h2>
                    <p>We have sent a password reset OTP to your </p>
                    <p>email - <?php echo $_GET['email'] ?></p>
                </div>
                <img src="<?php echo BASEURL.'/images/otpDesign.png' ?>" alt="">
            </div>

            <div class="verifyPart">
                <div class="form">
                    <h1>Code verification</h1>
                    <form action="<?php echo BASEURL . '/Homepage/checkOTP.php?email='.$_GET['email'] ?>" method="post">
                        <div class="alert" id="warning">
                            <?php
                            if(@$_GET['error'])
                                echo $_GET['error'];
                            ?>
                        </div>
                        <div class="group">
                            <input type="number" name="otp">
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label>OTP code</label>
                        </div>
                        <button type="submit" name="submit" class="custom-btn">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
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


