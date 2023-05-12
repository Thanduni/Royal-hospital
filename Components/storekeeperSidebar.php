<!-- importing configaration file -->

<?php
session_start();
//die($_SESSION['name']);
require_once("../conf/config.php");
?>
<!-- sidebar start -->


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
        <li onmouseover="changeImage('dashboard.svg', 'dashboard')" onmouseout="restoreImage('dashboardDef.svg', 'dashboard')"><a href="<?php echo BASEURL . '/Storekeeper/storekeeperDash.php' ?>" target="_self"><img id="dashboard" class="icons butbut"
                                            src=<?php echo BASEURL . '/images/dashboardDef.svg' ?> alt="dashboard"
                                            align="middle">
                <p>Dashboard</p>
            </a></li>
        <li onmouseover="changeImage('medicine.svg', 'medicine')" onmouseout="restoreImage('medicineDef.svg', 'medicine')"><a href="<?php echo BASEURL.'/Storekeeper/storekeeperAddMedicine.php'?>" target="_self"><img id="medicine" class="icons butbut"
                                                                         src=<?php echo BASEURL . '/images/medicineDef.svg' ?> alt="user"
                                                                         align="middle">
                <p>Medicine</p>
            </a></li>
        <li onmouseover="changeImage('database.svg', 'database')" onmouseout="restoreImage('databaseDef.svg', 'database')"><a href="<?php echo BASEURL . '/Storekeeper/storekeeperAddStock.php' ?>" target="_self"><img id="database" class="icons butbut"
                                            src=<?php echo BASEURL . '/images/databaseDef.svg' ?> alt="dashboard"
                                            align="middle">
                <p>Stock</p>
            </a></li>
        <li onmouseover="changeImage('notice-board.png', 'noticeboard')" onmouseout="restoreImage('notice-boardDef.png', 'noticeboard')"><a id="notice" href="<?php echo BASEURL.'/Storekeeper/storekeeperNoticeBoard.php'?>" target="_self"><img id="noticeboard" class="butbut icons"
                                            src=<?php echo BASEURL . '/images/noticeboardDef.svg' ?> alt="noticeboard"
                                            align="middle">
                <p>Noticeboard</p>
            </a></li>
        <li onmouseover="changeImage('profile.svg', 'profile')" onmouseout="restoreImage('profileDef.svg', 'profile')"><a href="<?php echo BASEURL . '/Storekeeper/updateStorekeeperProfile.php' ?>" target="_self"><img id="profile" class="butbut icons"
                                            src=<?php echo BASEURL . '/images/profileDef.svg' ?> alt="nurse"
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