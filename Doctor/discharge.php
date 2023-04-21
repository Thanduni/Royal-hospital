<?php
session_start();
require_once("../conf/config.php");
if (isset($_SESSION['mailaddress']) && $_SESSION['userRole'] == 'Doctor') {
    $nic = $_SESSION['nic'];
    $doctorID_query = "select doctorID from doctor join user on user.nic = doctor.nic where user.nic = $nic";
    $get_doctorID = mysqli_query($con,$doctorID_query);
    $row = mysqli_fetch_assoc($get_doctorID);
    $doctorID = $row["doctorID"];
?>
<?php
//get date and time
date_default_timezone_set('Asia/Colombo');
$mindate = date("Y-m-d");
$mintime = date("h:i");
if(isset($_GET['patientid'])){
    $patientID = $_GET['patientid'];
}
//get patient details from database
$patient_sql = "SELECT user.name,user.profile_image,user.nic, 
                YEAR(CURRENT_TIMESTAMP) - YEAR(user.DOB) - (RIGHT(CURRENT_TIMESTAMP, 5) < RIGHT(user.DOB, 5)) as age 
                from user join patient on patient.nic=user.nic where patientID = $patientID; ";

$get_details=mysqli_query($con,$patient_sql);
if($get_details){
    while($row = mysqli_fetch_assoc($get_details)){
        $profile_image = $row['profile_image'];
        $age = $row['age'];
        $patientName = $row['name'];
        $patientnic = $row['nic'];
    }
}

$admit_details = "SELECT * from inpatient WHERE patientID = $patientID;";
$get_admit_details = mysqli_query($con,$admit_details);
if($get_admit_details){
    $admit_row = mysqli_fetch_assoc($get_admit_details);
    $admitTime = $admit_row['admit_time'];
    $admitDate = $admit_row['admit_date'];
    $room_no = $admit_row['room_no'];
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
    <title>Discharge Patient</title>
</head>
<body>
    <div class="user">
        <?php 
        $name = urlencode( $_SESSION['name']);
        include(BASEURL . '/Components/doctorSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $_SESSION['name']); ?>
        <div class="userContents" id="center">
            <?php include(BASEURL.'/Components/topbar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name);?>
            <div class="display-container">
                <div class="admit-patient-container">
                    <div class="admit-patient-detail">
                        <h2>Patient Discharge Details</h2>
                        <form method="post">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="">Patient Name</label>
                                    <input type="text" name="patientName" value ="<?php echo $patientName ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Patient ID</label>
                                    <input type="text" name="patientID" value ="<?php echo $patientID?>" readonly>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="">Admit Date</label>
                                    <input type="date" name="admitDate" value ="<?php echo $admitDate?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Admit Time</label>
                                    <input type="time" name="admitTime" value ="<?php echo $admitTime?>" readonly>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="">Discharge Date</label>
                                    <input type="date" name="admitDate" value ="<?php echo $mindate?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Discharge Time</label>
                                    <input type="time" name="admitTime" value ="<?php echo $mintime?>" readonly>
                                </div>
                            </div>
                                <p>This part is yet to made. <br> Generate Medical and how to discharge</p>
                            <button id="discharge-btn" class="discharge-patient-btn" type="submit" name="discharge-patient">Discharge Patient</button>
                        </form>
                    </div>
                </div>
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