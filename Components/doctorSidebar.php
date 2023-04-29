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
        <li onmouseover="changeImage('dashboard.svg', 'dashboard')" onmouseout="restoreImage('dashboardDef.svg', 'dashboard')"><a href="<?php echo BASEURL . '/Doctor/doctorDash.php' ?>" target="_self"><img class="icons butbut" id="dashboard"
                                                                                                                                                                                                                          src=<?php echo BASEURL . '/images/dashboardDef.svg' ?> alt="dashboard"
                                                                                                                                                                                                                          align="middle">
                <p>Dashboard</p>
            </a></li>
        <li onmouseover="changeImage('patient.svg', 'patient')" onmouseout="restoreImage('patientDef.svg', 'patient')"><a href="<?php echo BASEURL . '/Doctor/inpatient.php' ?>" target="_self"><img class="icons butbut" id="patient"
                                                                                                                                                                                                              src=<?php echo BASEURL . '/images/patientDef.svg' ?> alt="patient"
                                                                                                                                                                                                              align="middle">
                <p>Patients</p>
            </a></li>
        <li onmouseover="changeImage('calender.svg', 'calender')" onmouseout="restoreImage('calenderDef.svg', 'calender')"><a href="<?php echo BASEURL . '/Doctor/updateWorkingHours.php' ?>" target="_self"><img class="icons butbut" id="calender"
                                                                                                                                                                                                               src=<?php echo BASEURL . '/images/calenderDef.svg' ?> alt="Profile"
                                                                                                                                                                                                               align="middle">
                <p>Schedule</p>
            </a></li>
        <li onmouseover="changeImage('profile.svg', 'profile')" onmouseout="restoreImage('profileDef.svg', 'profile')"><a href="<?php echo BASEURL . '/Doctor/updateDoctorProfile.php' ?>"
        target="_self"><img id="profile"
        class="icons butbut" src=<?php echo BASEURL . '/images/profileDef.svg' ?> alt="Profile" align="middle">
                <p>Profile</p>
            </a></li>
    </ul>
</div>

<script>
    function changeImage(imgName, id) {
        let image = document.getElementById(id);
        image.src = '../images/' + imgName;
    }

    function restoreImage(imgName, id) {
        let image = document.getElementById(id);
        image.src = '../images/' + imgName;
    }
</script>