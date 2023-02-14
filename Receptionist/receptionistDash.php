<?php
session_start();
//die( $_SESSION['profilePic']);
require_once("../conf/config.php");
if (isset($_SESSION['mailaddress']) && $_SESSION['userRole'] == 'Receptionist') {
    ?>

    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" href="<?php echo BASEURL . '/css/style.css' ?>">
        <link rel="stylesheet" href="<?php echo BASEURL . '/css/receptionistDash.css' ?>">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <style>
            .next {
                position: initial;
                height: auto;
            }
        </style>
        <title>Receptionist dashboard</title>
    </head>
    <body>
    <div class="user">
        <?php
        $name = urlencode( $_SESSION['name']);
        include(BASEURL . '/Components/ReceptionistSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name); ?>
        <div class="userContents" id="center">
            <div class="title">
                <img src="<?php echo BASEURL . '/images/logo5.png' ?>" alt="logo">
                Royal Hospital Management System
            </div>
            <ul>
                <li class="userType"><img src=<?php echo BASEURL . '/images/userInPage.svg' ?> alt="admin">
                    Receptionist
                </li>
                <li class="logout"><a href="<?php echo BASEURL . '/Homepage/logout.php?logout' ?>">Logout
                        <img
                                src=<?php echo BASEURL . '/images/logout.svg' ?> alt="logout"></a>
                </li>
            </ul>
            <div class="arrow">
                <img src=<?php echo BASEURL . '/images/arrow-right-circle.svg' ?> alt="arrow">Dashboard
            </div>
            <aside>
                <p id="second-head">Tabs in use</p>
                <hr style="color: #344168; margin: 20px;">
                <div class="actorCards">
                    <ul>
                        <a href="<?php echo BASEURL . '/Receptionist/receptionistDash.php' ?>">
                            <li class="tab-cards" id="dashboard">Dashboard</li>
                        </a>
                        <a href="">
                            <li class="tab-cards" id="appointments">Appointments</li>
                        </a>
                        <a href="<?php echo BASEURL . '/Receptionist/patientPage.php' ?>">
                            <li class="tab-cards" id="patient">Patient</li>
                        </a>
                        <a href="<?php echo BASEURL . '/Receptionist/viewbillPage.php' ?>">
                            <li class="tab-cards" id="bills">Bills</li>
                        </a>
                        <a href="<?php echo BASEURL . '/Receptionist/updateReceptionistProfile.php' ?>">
                            <li class="tab-cards" id="profile">Profile</li>
                        </a>
                    </ul>
                </div>
            </aside>
        </div>

    </div>

    <?php include(BASEURL . '/Components/Footer.php'); ?>
    </body>
    </html>

    <?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>