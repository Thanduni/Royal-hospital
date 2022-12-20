<?php
    @session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--    <link rel="stylesheet" href="../assets/css/style.css">-->
    <link rel="stylesheet" href="<?php echo BASEURL.'/assets/css/style.css' ?>">
    <title>Login</title>
</head>

<body>
<nav>
    <a href="<?php echo BASEURL.'/Homepage'?>">
        <p><img src=<?php echo BASEURL.'/assets/images/logo5.png' ?> alt="logo" align="middle">
            Royal Hospital Management System
        </p>
    </a>
    <div class="nav-links">
        <ul>
            <li><a href="<?php echo BASEURL.'/Homepage'?>"> Home </a></li>
            <li><a href=""> About us </a></li>
            <li><a href=""> Appointment </a></li>
            <li><a href=""> Register patient </a></li>
            <li><a href=<?php echo BASEURL.'/Homepage/loginCheck'?>> Login </a></li>
        </ul>
    </div>
</nav>
<div class="page">
    <div class="p1">
        <div class="loginContents">
            <p><img src=<?php echo BASEURL.'/assets/images/logo5.png' ?> alt="logo" align="middle"><br>
                Royal Hospital Management System
            </p>
            <?php

//            print_r($status);
            if (isset($_POST['loginSubmit'])) {
                $status = $data['status'];
                ?>
                <div class="alert">
                    <?php
                    echo $status;
                    ?>
                </div>
                <?php
            } ?>
            <form action="<?php echo BASEURL.'/Homepage/submit';?>" method="post">
                <input type="email" name="email" placeholder="Email"><br>
                <input type="password" name="password" placeholder="Password"><br>
                <button name="loginSubmit">Login</button>
<!--                <input type="submit" name="loginSubmit" value="Login">-->
            </form>
        </div>
    </div>
    <div class="p2"></div>
</div>
</body>

</html>