<?php
require_once("../conf/config.php");
?>

<nav>
    <a href="<?php echo BASEURL.'/Homepage'?>">
        <p><img src=<?php echo BASEURL.'/images/logo5.png' ?> alt="logo" align="middle">
            Royal Hospital Management System
        </p>
    </a>
    <div class="nav-links">
        <ul>
            <li><a href="<?php echo BASEURL.'/index.php'?>"> Home </a></li>
            <li><a href="<?php echo BASEURL.'/Homepage/aboutUs.php'?>"> About us </a></li>
            <li><a href=""> Appointment </a></li>
            <li><a href=""> Register patient </a></li>
            <li><a href="<?php echo BASEURL.'/Homepage/login.php'?>"> Login </a></li>
        </ul>
    </div>
</nav>