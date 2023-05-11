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
        <li onmouseover="changeImage('dashboard.svg', 'dashboard')" onmouseout="restoreImage('dashboardDef.svg', 'dashboard')"><a href="<?php echo BASEURL . '/Admin/adminDash.php' ?>" target="_self"><img id="dashboard" class="icons butbut"
                                            src=<?php echo BASEURL . '/images/dashboardDef.svg' ?> alt="dashboard"
                                            align="middle">
                <p>Dashboard</p>
            </a></li>
        <li onmouseover="changeImage('user.svg', 'user')" onmouseout="restoreImage('userDef.svg', 'user')"><a href="<?php echo BASEURL.'/Admin/adminUsersPage.php'?>" target="_self"><img id="user" class="icons butbut"
                                                                         src=<?php echo BASEURL . '/images/userDef.svg' ?> alt="user"
                                                                         align="middle">
                <p>User</p>
            </a></li>
        <li onmouseover="changeImage('doctor.svg', 'doctor')" onmouseout="restoreImage('doctorDef.svg', 'doctor')"><a href="<?php echo BASEURL . '/Admin/adminDoctorPage.php' ?>" target="_self"><img id="doctor" class="icons butbut"
                                            src=<?php echo BASEURL . '/images/doctorDef.svg' ?> alt="doctor"
                                            align="middle">
                <p>Doctor</p>
            </a></li>
        <li onmouseover="changeImage('nurse.svg', 'nurse')" onmouseout="restoreImage('nurseDef.svg', 'nurse')"><a href="<?php echo BASEURL . '/Admin/adminNursePage.php' ?>" target="_self"><img id="nurse" class="icons butbut"
                                            src=<?php echo BASEURL . '/images/nurseDef.svg' ?> alt="nurse"
                                            align="middle">
                <p>Nurse</p>
            </a></li>
        <li onmouseover="changeImage('receptionist.svg', 'receptionist')" onmouseout="restoreImage('receptionistDef.svg', 'receptionist')"><a href="<?php echo BASEURL . '/Admin/adminReceptionistPage.php' ?>" target="_self"><img id="receptionist" class="icons butbut"
                                            src=<?php echo BASEURL . '/images/receptionistDef.svg' ?> alt="Receptionist"
                                            align="middle">
                <p>Receptionist</p>
            </a></li>
        <li onmouseover="changeImage('database.svg', 'database')" onmouseout="restoreImage('databaseDef.svg', 'database')"><a href="<?php echo BASEURL . '/Admin/adminStorekeeperPage.php' ?>" target="_self"><img id="database" class="icons butbut"
                                            src=<?php echo BASEURL . '/images/databaseDef.svg' ?> alt="Storekeeper"
                                            align="middle">
                <p>Storekeeper</p>
            </a></li>
        <li onmouseover="changeImage('noticeboard.svg', 'notice')" onmouseout="restoreImage('noticeboardDef.svg', 'notice')"><a href="<?php echo BASEURL . '/Admin/noticeboardHomepageEdit.php' ?>" target="_self"><img id="notice" class="icons butbut"
                                            src=<?php echo BASEURL . '/images/noticeboardDef.svg' ?> alt="noticeboard"
                                            align="middle">
                <p>Homepage</p>
            </a></li>
        <li onmouseover="changeImage('announcement.svg', 'announcement')" onmouseout="restoreImage('announcementDef.svg', 'announcement')"><a href="<?php echo BASEURL . '/Admin/announcementPage.php' ?>" target="_self"><img id="announcement" class="icons butbut"
                                                                                                                                                                                                                        src=<?php echo BASEURL . '/images/announcementDef.svg' ?> alt="noticeboard"
                                                                                                                                                                                                                        align="middle">
                <p>Notices</p>
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