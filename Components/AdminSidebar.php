<?php
session_start();
require_once("../conf/config.php");
?>

<input type="checkbox" class="openSidebarMenu" id="openSidebarMenu">
<label for="openSidebarMenu" class="sidebarIconToggle">
    <div class="spinner diagonal part-1"></div>
    <div class="spinner horizontal"></div>
    <div class="spinner diagonal part-2"></div>
</label>
<div id="sidebarMenu">
    <div class="welcomeUser">
        <?php
        $profilePic = $_GET['profilePic'];
        echo
        "<p align='middle'>"
        ?>
        <img class='profilePic' align='middle' src=<?php echo BASEURL . '/uploads/' . $profilePic ?>
        alt='Upload Image'>
        <?php
        echo $_GET['name'] . "</p>";
        ?>
    </div>
    <ul class="sidebarMenuInner">
        <li><a href="<?php echo BASEURL . '/Admin/adminDash.php' ?>" target="_self"><img class="icons"
                                            src=<?php echo BASEURL . '/images/dashboard.svg' ?> alt="dashboard"
                                            align="middle">
                <p>Dashboard</p>
            </a></li>
        <li><a href="<?php echo BASEURL.'/Admin/adminUsersPage.php'?>" target="_self"><img class="icons"
                                                                         src=<?php echo BASEURL . '/images/user.svg' ?> alt="user"
                                                                         align="middle">
                <p>User</p>
            </a></li>
        <li><a href="<?php echo BASEURL . '/Admin/adminDoctorPage.php' ?>" target="_self"><img class="icons"
                                            src=<?php echo BASEURL . '/images/doctor.svg' ?> alt="doctor"
                                            align="middle">
                <p>Doctor</p>
            </a></li>
        <li><a href="<?php echo BASEURL . '/Admin/adminNursePage.php' ?>" target="_self"><img class="icons"
                                            src=<?php echo BASEURL . '/images/nurse.svg' ?> alt="nurse"
                                            align="middle">
                <p>Nurse</p>
            </a></li>
        <li><a href="<?php echo BASEURL . '/Admin/adminReceptionistPage.php' ?>" target="_self"><img class="icons"
                                            src=<?php echo BASEURL . '/images/receptionist.svg' ?> alt="Receptionist"
                                            align="middle">
                <p>Receptionist</p>
            </a></li>
        <li><a href="<?php echo BASEURL . '/Admin/adminStorekeeperPage.php' ?>" target="_self"><img class="icons"
                                            src=<?php echo BASEURL . '/images/database.svg' ?> alt="Store keeper"
                                            align="middle">
                <p>Store keeper</p>
            </a></li>
        <li><a href="<?php echo BASEURL . '/Admin/noticeboardHomepageEdit.php' ?>" target="_self"><img class="icons"
                                            src=<?php echo BASEURL . '/images/noticeboard.svg' ?> alt="noticeboard"
                                            align="middle">
                <p>Noticeboard</p>
            </a></li>
    </ul>
</div>