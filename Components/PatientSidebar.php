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
        <li><a href="<?php echo BASEURL . '/Patient/patientDash.php' ?>" target="_blank"><img class="icons"
                                            src=<?php echo BASEURL . '/images/dashboard.svg' ?> alt="dashboard"
                                            align="middle">
                <p>Dashboard</p>
            </a></li>
        <li><a href="<?php echo BASEURL.'/Patient/appointment.php'?>" target="_blank"><img class="icons"
                                                                         src=<?php echo BASEURL . '/images/MakeAnAppointments.svg' ?> alt="user"
                                                                         align="middle">
                <p>Make an Appointment</p>
            </a></li>
        <li><a href="<?php echo BASEURL.'/Patient/appointment.php' ?>" target="_blank"><img class="icons"
                                            src=<?php echo BASEURL . '/images/doctor.svg' ?> alt="doctor"
                                            align="middle">
                <p>Patient Reports</p>
            </a></li>
        <li><a href="" target="_blank"><img class="icons"
                                            src=<?php echo BASEURL . '/images/Payroll.svg' ?> alt="nurse"
                                            align="middle">
                <p>Payroll</p>
            </a></li>
        
        <li><a href="" target="_blank"><img class="icons"
                                            src=<?php echo BASEURL . '/images/noticeboard.svg' ?> alt="noticeboard"
                                            align="middle">
                <p>Noticeboard</p>
            </a></li>
    </ul>
</div>

