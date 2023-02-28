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
        <li><a href="<?php echo BASEURL . '/Doctor/doctorDash.php' ?>" target="_self"><img class="icons"
                                            src=<?php echo BASEURL . '/images/dashboard.svg' ?> alt="dashboard"
                                            align="middle">
                <p>Dashboard</p>
            </a>
        </li>
        <li><a href="<?php echo BASEURL . '/Doctor/inpatient.php' ?>" target="_self"><img class="icons"
                                            src=<?php echo BASEURL . '/images/addpatient.png' ?> alt="Patient"
                                            align="middle">
                <p>Patients</p>
            </a>
        </li>
        <li><a href="<?php echo BASEURL . '/Doctor/workingHours.php' ?>" target="_self"><img class="icons"
                                            src=<?php echo BASEURL . '/images/calender.png' ?> alt="schedule"
                                            align="middle">
                <p>Schedule</p>
            </a>
        </li>
        <li><a href="<?php echo BASEURL . '/Doctor/updateDoctorProfile.php' ?>" target="_self"><img class="icons"
                                            src=<?php echo BASEURL . '/images/doctor.svg' ?> alt="profile"
                                            align="middle">
                <p>Profile</p>
            </a></li>
        <li><a href="<?php echo BASEURL . '/Doctor/updateWorkingHours.php' ?>" target="_self"><img class="icons"
                                                                                                    src=<?php echo BASEURL . '/images/doctor.svg' ?> alt="profile"
                                                                                                    align="middle">
                <p>Working hours</p>
            </a></li>
    </ul>
</div>
