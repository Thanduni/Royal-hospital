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
        <li><a href="<?php echo BASEURL . '/Nurse/nurseDash.php' ?>" target="_self"><img class="icons"
                                            src=<?php echo BASEURL . '/images/dashboard.svg' ?> alt="dashboard"
                                            align="middle">
                <p>Dashboard</p>
            </a></li>
        <li><a href="<?php echo BASEURL.'/Nurse/display.php'?>" target="_self"><img class="icons"
                                            src=<?php echo BASEURL . '/images/addpatient.png' ?> alt="patient"
                                            align="middle">
                <p>Patient</p>
            </a></li>
        <li><a href="<?php echo BASEURL . '/Nurse/beds.php' ?>" target="_self"><img class="icons"
                                            src=<?php echo BASEURL . '/images/bed.png' ?> alt="bedr"
                                            align="middle">
                <p>Rooms</p>
            </a></li>
        <li><a href="<?php echo BASEURL . '/Nurse/report.php' ?>" target="_self"><img class="icons"
                                            src=<?php echo BASEURL . '/images/dailyreport.png' ?> alt="report"
                                            align="middle">
                <p>Report</p>
            </a></li>
        <li><a href="<?php echo BASEURL . '/Nurse/updateNurseProfile.php' ?>" target="_self"><img class="icons"
                                            src=<?php echo BASEURL . '/images/nurseProfile.png' ?> alt="profile"
                                            align="middle">
                <p>Profile</p>
            </a></li>
    </ul>
</div>