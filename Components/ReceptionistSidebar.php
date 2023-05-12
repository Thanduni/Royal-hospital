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
        <li onmouseover="changeImage('dashboard.svg', 'dashboard')" onmouseout="restoreImage('dashboardDef.svg', 'dashboard')"><a href="<?php echo BASEURL . '/Receptionist/receptionistDash.php' ?>" target="_self"><img class="icons butbut" id="dashboard"
                                                                                                       src=<?php echo BASEURL . '/images/dashboardDef.svg' ?> alt="dashboard"
                                                                                                       align="middle">
                <p>Dashboard</p>
            </a></li>
        <li onmouseover="changeImage('appointment.svg', 'appointment')" onmouseout="restoreImage('appointmentDef.svg', 'appointment')"><a href="<?php echo BASEURL . '/Receptionist/makeAppointment.php' ?>" target="_self"><img class="icons butbut" id="appointment"
                                           src=<?php echo BASEURL . '/images/appointmentDef.svg' ?> alt="Appointment"
                                           align="middle">
                <p>Appointments</p>
            </a></li>
        <li onmouseover="changeImage('patient.svg', 'patient')" onmouseout="restoreImage('patientDef.svg', 'patient')"><a href="<?php echo BASEURL . '/Receptionist/patientPage.php' ?>" target="_self"><img class="icons butbut" id="patient"
                                           src=<?php echo BASEURL . '/images/patientDef.svg' ?> alt="Patient"
                                           align="middle">
                <p>Patient</p>
            </a></li>
        <li onmouseover="changeImage('receptionist.svg', 'receptionist')" onmouseout="restoreImage('receptionistDef.svg', 'receptionist')"><a href="<?php echo BASEURL . '/Receptionist/viewBillPage.php' ?>" target="_self"><img class="icons butbut" id="receptionist"
                                           src=<?php echo BASEURL . '/images/receptionistDef.svg' ?> alt="Payroll"
                                           align="middle">
                <p>Bills</p>
            </a></li>
        <li onmouseover="changeImage('notice-board.png', 'noticeboard')" onmouseout="restoreImage('notice-boardDef.png', 'noticeboard')"><a id="notice" href="<?php echo BASEURL.'/Receptionist/receptionistNoticeBoard.php'?>" target="_self"><img id="noticeboard" class="butbut icons"
                                            src=<?php echo BASEURL . '/images/noticeboardDef.svg' ?> alt="noticeboard"
                                            align="middle">
                <p>Noticeboard</p>
            </a></li>
        <li onmouseover="changeImage('profile.svg', 'profile')" onmouseout="restoreImage('profileDef.svg', 'profile')"><a href="<?php echo BASEURL . '/Receptionist/updateReceptionistProfile.php' ?>" target="_self"><img id="profile"
                        class="icons butbut"
                        src=<?php echo BASEURL . '/images/profileDef.svg' ?> alt="Profile"
                        align="middle">
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