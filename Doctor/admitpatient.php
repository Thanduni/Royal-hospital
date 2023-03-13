<?php
session_start();
require_once("../conf/config.php");
if (isset($_SESSION['mailaddress']) && $_SESSION['userRole'] == 'Doctor') {

?>
<?php
$mindate = date("Y-m-d");
$mintime = date("h:i");
if(isset($_GET['patientid'])){
    $patientID = $_GET['patientid'];
    $patientName = $_GET['name'];
    $age = $_GET['age'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/style.css' ?>">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/doctorStyle.css' ?>">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/admitpatient.css' ?>">
    <title>Admission</title>
</head>
<body>
<div class="user">
        <?php 
        $name = urlencode( $_SESSION['name']);
        include(BASEURL . '/Components/doctorSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $_SESSION['name']); ?>
        <div class="userContents" id="center">
        <?php include(BASEURL.'/Components/topbar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name);?>
                <div class="admit-patient-container">
                    <form method="post">
                        <div class="form-column">
                            <div class="form-row-name">
                                <div class="label">Patient Name</div>
                                <div class="label">Patient ID</div>
                                <div class="label">Age </div>
                                <div class="label">Gender</div>
                                <div class="label">Room No</div>
                                <div class="label">Admit Date</div>
                                <div class="label">Admit Time</div>
                            </div>
                            <div class="form-row-content">
                                <div class="input-feild"><?php echo $patientName ?></div>
                                <div class="input-feild"><?php echo $patientID ?></div>
                                <div class="input-feild"><?php echo $age ?></div>
                                <div class="input-feild"><?php echo $patientName ?></div>
                            </div>
                        </div>
                        <!-- <div class="from-row">
                            <div class="form-row-name">Name </div>
                            <div class="form-row-content"><?php echo $patientName ?></div>
                        </div>
                        <div class="from-row">
                            <div class="form-row-name">Patient ID </div>
                            <div class="form-row-content"><?php echo $patientID ?></div>
                        </div>
                        <div class="from-row">
                            <div class="form-row-name">Age </div>
                            <div class="form-row-content"><?php echo $age ?></div>
                        </div>
                        <div class="from-row">
                            <div class="form-row-name">Gender </div>
                            <div class="form-row-content"><?php echo $age ?></div>
                        </div>
                        <div class="from-row">
                            <div class="form-row-name">Room No </div>
                            <div class="form-row-content"><?php echo $age ?></div>
                        </div>
                        <div class="from-row">
                            <div class="form-row-name">Admit date</div>
                            <div class="form-row-content"><?php echo $age ?></div>
                        </div>
                        <div class="from-row">
                            <div class="form-row-name">Admit time </div>
                            <div class="form-row-content"><?php echo $age ?></div>
                        </div> -->
                    </form>
                </div>
        </div>
    </div>
</body>
</html>
<?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>