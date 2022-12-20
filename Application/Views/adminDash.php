<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASEURL . '/public/assets/css/style.css' ?>">
    <link rel="stylesheet" href="<?php echo BASEURL . '/public/assets/css/adminDash.css' ?>">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Users</title>
</head>
<body>
<div class="user">
    <?php include('adminSidebar.php'); ?>
    <div class="userContents" id="center">
        <div class="title">
            <img src="<?php echo BASEURL . '/public/assets/images/logo5.png' ?>" alt="logo">
            Royal Hospital Management System
        </div>
        <ul>
            <li class="userType"><img src=<?php echo BASEURL . '/public/assets/images/userInPage.svg' ?> alt="admin">
                Admin
            </li>
            <li class="logout"><a href="<?php echo BASEURL . '/Homepage/Logout?url=' . $_SERVER['REQUEST_URI'] ?>">Logout
                    <img
                            src=<?php echo BASEURL . '/public/assets/images/logout.jpg' ?> alt="logout"></a>
            </li>
        </ul>
        <div class="arrow">
            <img src=<?php echo BASEURL . '/public/assets/images/arrow-right-circle.svg' ?> alt="arrow">User
        </div>
        <div class="actorCards">
            <ul>
                <a href="<?php echo BASEURL . '/Admin/getUsers' ?>">
                    <li>Dashboard</li>
                </a>
                <a href="<?php echo BASEURL . '/Admin/getUsers' ?>">
                    <li>User</li>
                </a>
                <a href="">
                    <li>Doctor</li>
                </a>
                <a href="">
                    <li>Nurse</li>
                </a>
                <a href="">
                    <li>Receptionist</li>
                </a>
                <a href="">
                    <li>Noticeboard</li>
                </a>
            </ul>
        </div>
        <?php include('adminFooter.php'); ?>
    </div>
</div>
</body>
</html>