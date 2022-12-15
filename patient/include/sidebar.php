<style>
    <?php include 'style.css';
    ?>
</style>
<div class="sidebar">
        <div class="sidebar-header">
            <div class="logo">
                <img src="./images/hospital-logo.PNG" alt="">
            </div>
            <div class="sidebar-name">
                Royal Hospital
                <!-- <h1><span class="lab la-accosoft"></span>Royal Hospital</h1> -->
            </div>
        </div>
        <!-- <div class="logo">
            <img src="./images/hospital-logo.PNG" alt="">
        </div>
        <div class="sidebar-name">
            <h1><span class="lab la-accosoft"></span>System</h1>
        </div> -->
        <div class="sidebar-menu">
            <ul>
            <li class="<?php if($page=='dashboard'){echo 'active';}?>">
                    <a href="index.php">
                        <i class="fas fa-th-large"></i>
                        <div>Dashboard</div>
                    </a>
                </li>
                <li class="<?php if($page=='display'){echo 'active';}?>">
                    <a href="display.php">
                        <i class="fas fa-user-injured"></i>
                        <div>Patient</div>
                    </a>
                </li>
                <li class="<?php if($page=='appointment'){echo 'active';}?>">
                    <a href="/royalhospital/makeappointment.php">
                        <i class="fas fa-list-alt"></i>
                        <div>Appointments</div>
                    </a>
                </li>
                <li class="<?php if($page=='payroll'){echo 'active';}?>">
                    <a href="payroll.php">
                        <i class="fas fa-credit-card"></i>
                        <div>Payroll</div>
                    </a>
                </li>
                <li>
                    <a href="">
                        <i class="fas fa-user"></i>
                        <div>Profile</div>
                    </a>
                </li>
            </ul>
        </div>
    </div>