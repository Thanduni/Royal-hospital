<?php
session_start();
//die($_SESSION['name']);
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
        <li><a href="<?php echo BASEURL . '/Storekeeper/storekeeperDash.php' ?>" target="_self"><img class="icons"
                                            src=<?php echo BASEURL . '/images/dashboard.svg' ?> alt="dashboard"
                                            align="middle">
                <p>Dashboard</p>
            </a></li>
        <li><a href="<?php echo BASEURL.'/Storekeeper/storekeeperAddMedicine.php'?>" target="_self"><img class="icons"
                                                                         src=<?php echo BASEURL . '/images/medicine.svg' ?> alt="user"
                                                                         align="middle">
                <p>Add Medicine</p>
            </a></li>
        <li><a href="<?php echo BASEURL . '/Storekeeper/storekeeperAddStock.php' ?>" target="_self"><img class="icons"
                                            src=<?php echo BASEURL . '/images/database.svg' ?> alt="dashboard"
                                            align="middle">
                <p>Add Stock</p>
            </a></li>
        <li><a href="<?php echo BASEURL . '/Storekeeper/storekeeperViewStock.php' ?>" target="_self"><img class="icons"
                                            src=<?php echo BASEURL . '/images/viewStock.svg' ?> alt="doctor"
                                            align="middle">
                <p>View Stocks</p>
            </a></li>
        <li><a href="<?php echo BASEURL . '/Storekeeper/updateStorekeeperProfile.php' ?>" target="_self"><img class="icons"
                                            src=<?php echo BASEURL . '/images/profile.svg' ?> alt="nurse"
                                            align="middle">
                <p>Profile</p>
            </a></li>
        
    </ul>
</div>