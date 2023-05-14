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
        <li onmouseover="changeImage('dashboard.svg', 'dashboard')" onmouseout="restoreImage('dashboardDef.svg', 'dashboard')"><a href="<?php echo BASEURL . '/Patient/patientDash.php' ?>" target="_self"><img id="dashboard" class="butbut icons"
                src=<?php echo BASEURL.'/images/dashboardDef.svg' ?> alt="dashboard"
                                            align="middle">
                <p>Dashboard</p>
            </a></li>

        <li onmouseover="changeImage('appointment.svg','appointment')" onmouseout="restoreImage('appointmentDef.svg','appointment')"><a id="open-" target="_self"><img id="appointment" class="butbut icons"
                src=<?php echo BASEURL . '/images/appointmentDef.svg' ?> alt="user" align="middle">
                <p>Appointment</p>
            </a></li>

        <li onmouseover="changeImage('prescription.svg', 'prescription')" onmouseout="restoreImage('prescriptionDef.svg', 'prescription')"><a href="<?php echo BASEURL.'/Patient/prescription.php' ?>" target="_self"><img id="prescription" class="butbut icons"
                src=<?php echo BASEURL . '/images/prescriptionDef.svg' ?> alt="doctor" align="middle">
                <p>Prescription</p>
            </a></li>

        <li onmouseover="changeImage('payment.svg', 'payment')" onmouseout="restoreImage('paymentDef.svg', 'payment')"><a  href="<?php echo BASEURL.'/patient/stripe/checkout.php'?>" target="_self"><img id="payment" class="butbut icons"
                 src=<?php echo BASEURL . '/images/paymentDef.svg' ?> alt="nurse" align="middle">
                <p>Payment</p>
            </a></li>
        
        <li onmouseover="changeImage('notice-board.png', 'noticeboard')" onmouseout="restoreImage('notice-boardDef.png', 'noticeboard')"><a id="notice" href="<?php echo BASEURL.'/Patient/noticeboard.php'?>" target="_self"><img id="noticeboard" class="butbut icons"
                                            src=<?php echo BASEURL . '/images/notice-boardDef.png' ?> alt="noticeboard"
                                            align="middle">
                <p>Noticeboard</p>
            </a></li>

        <li onmouseover="changeImage('profile.svg','profile')" onmouseout="restoreImage('profileDef.svg','profile')"><a  href="<?php echo BASEURL . '/Patient/updatePatientProfile.php' ?>" target="_self"><img id="profile" class="butbut icons"
                        src=<?php echo BASEURL . '/images/profileDef.svg' ?> alt="Profile"
                        align="middle">
                <p>Profile</p>
            </a></li>
    </ul>
</div>
<script>
    function changeImage(imgName, id) {
        let image = document.getElementById(id);
        image.src = '<?php echo BASEURL.'/images/'?>' + imgName;
    }

    function restoreImage(imgName, id) {
        let image = document.getElementById(id);
        image.src = '<?php echo BASEURL.'/images/'?>' + imgName;
    }
</script>