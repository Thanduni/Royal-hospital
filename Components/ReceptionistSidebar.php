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
        <li><a href="<?php echo BASEURL . '/Receptionist/receptionistDash.php' ?>" target="_self"><img class="icons"
                                                                                                       src=<?php echo BASEURL . '/images/dashboard.svg' ?> alt="dashboard"
                                                                                                       align="middle">
                <p>Dashboard</p>
            </a></li>
        <li><a href="" target="_self"><img class="icons"
                                           src=<?php echo BASEURL . '/images/appointment.svg' ?> alt="Appointment"
                                           align="middle">
                <p>Appointments</p>
            </a></li>
        <li><a href="" target="_self"><img class="icons"
                                           src=<?php echo BASEURL . '/images/patient.svg' ?> alt="Patient"
                                           align="middle">
                <p>Patient</p>
            </a></li>
        <li><a href="" target="_self"><img class="icons"
                                           src=<?php echo BASEURL . '/images/payroll.svg' ?> alt="Payroll"
                                           align="middle">
                <p>Payroll</p>
            </a></li>
        <li><a href="<?php echo BASEURL . '/Receptionist/updateReceptionistProfile.php' ?>" target="_self"><img
                        class="icons"
                        src=<?php echo BASEURL . '/images/profile.svg' ?> alt="Profile"
                        align="middle">
                <p>Profile</p>
            </a></li>
    </ul>
</div>