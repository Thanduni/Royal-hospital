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
$patient_sql = "SELECT user.name,
                user.profile_image,
                user.nic, 
                YEAR(CURRENT_TIMESTAMP) - YEAR(user.DOB) - (RIGHT(CURRENT_TIMESTAMP, 5) < RIGHT(user.DOB, 5)) as age 
                from user join patient on patient.nic=user.nic
                where patientID = $patientID; ";

$get_details=mysqli_query($con,$patient_sql);
if($get_details){
    while($row = mysqli_fetch_assoc($get_details)){
        $profile_image = $row['profile_image'];
        $age = $row['age'];
        $patientName = $row['name'];
        $patientnic = $row['nic'];
    }
}
?>
<!-- select first available room -->
<?php
    $sql = "select room_no from room where room_availability='available';";
    $result = mysqli_query($con,$sql);
    if($result){
        $roomArray = mysqli_fetch_array($result);
        $room_no = $roomArray[0];
    }
?>

<?php
    if(isset($_POST['admit-patient'])){

        $admit_patient = "INSERT INTO inpatient(patientID,nic,admit_time,admit_date,room_no,doctorID) VALUES ('$patientID','$patientnic','$mintime','$mindate','$room_no','$doctorID');";
        $get_result=mysqli_query($con,$admit_patient);

        if($get_result){
            echo '
            <script type="text/javascript">
            document.getElementById("popup").style.visibility = "visible";
            </script>
            ';
        }
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
            <div class="display-container">
                <div class="admit-patient-container">
                    <div class="admit-patient-detail">
                        <h2>Patient Admission Details</h2>
                        <form method="post">
                            <div class="form-group">
                                <label for="">Patient Name</label>
                                <input type="text" name="patientName" value ="<?php echo $patientName ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Patient ID</label>
                                <input type="text" name="patientID" value ="<?php echo $patientID?>">
                            </div>
                            <div class="form-group">
                                <label for="">Age</label>
                                <input type="text" name="age" value ="<?php echo $age?>">
                            </div>
                            <div class="form-group">
                                <label for="">Room No</label>
                                <input type="text" name="roomNo" value ="<?php echo $room_no?>">
                            </div>
                            <div class="form-group">
                                <label for="">Admit Date</label>
                                <input type="text" name="admitDate" value ="<?php echo $mindate?>">
                            </div>
                            <div class="form-group">
                                <label for="">Admit Time</label>
                                <input type="text" name="admitTime" value ="<?php echo $mintime?>">
                            </div>
                        <button id="admit-btn" class="admit-patient-btn" type="submit" name="admit-patient">Admit Patient</button>
                        </form>
                </div>
        </div>
    </div>
    <div class="popup" id="popup">
        <div class="confirm-popup" id ="admit-popup">
            <img src="../images/check.png" alt="check">
            <h2>Admit Successfull!</h2>
            <p>Your patient has been successfully admitted</p>
            <button type="button" class="close-confirm-popup">OK</button>
        </div>
    </div>
</body>
<script>
    document.querySelector(".close-confirm-popup").addEventListener("click", function(){
                document.querySelector(".popup").style.display = "none";
            })
</script>

</html>
<?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>