<?php
session_start();
//die( $_SESSION['profilePic']);
require_once("../conf/config.php");
if (isset($_SESSION['mailaddress'])) {
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/style.css' ?>">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/adminDash.css' ?>">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .next {
            position: initial;
            height: auto;
        }
    </style>
    <title>Admin dashboard</title>
</head>
<body>
<div class="user">
    <?php include(BASEURL . '/Components/AdminSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $_SESSION['name']); ?>
    <div class="userContents" id="center">
        <div class="title">
            <img src="<?php echo BASEURL . '/images/logo5.png' ?>" alt="logo">
            Royal Hospital Management System
        </div>
        <ul>
            <li class="userType"><img src=<?php echo BASEURL . '/images/userInPage.svg' ?> alt="admin">
                Admin
            </li>
            <li class="logout"><a href="<?php echo BASEURL . '/Homepage/logout.php?logout' ?>">Logout
                    <img
                            src=<?php echo BASEURL . '/images/logout.jpg' ?> alt="logout"></a>
            </li>
        </ul>
        <div class="arrow">
            <img src=<?php echo BASEURL . '/images/arrow-right-circle.svg' ?> alt="arrow">Dashboard
        </div>
        <div class="actorCards">
            <ul>
                <a href="<?php echo BASEURL . '/Admin/adminDash.php' ?>">
                    <li>Dashboard</li>
                </a>
                <a href="<?php echo BASEURL . '/Admin/adminUsersPage.php' ?>">
                    <li>User</li>
                </a>
                <a href="<?php echo BASEURL . '/Admin/adminDoctorPage.php' ?>">
                    <li>Doctor</li>
                </a>
                <a href="<?php echo BASEURL . '/Admin/adminNursePage.php' ?>">
                    <li>Nurse</li>
                </a>
                <a href="">
                    <li>Receptionist</li>
                </a>
                <a href="<?php echo BASEURL . '/Admin/noticeboardHomepageEdit.php' ?>">
                    <li>Noticeboard</li>
                </a>
            </ul>
        </div>
        <?php include(BASEURL . '/Components/Footer.php'); ?>
    </div>
</div>
</body>
</html>

    <?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>