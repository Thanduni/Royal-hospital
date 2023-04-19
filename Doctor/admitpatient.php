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
$mindate = date("Y-m-d");
$mintime = date("h:i");
if(isset($_GET['patientid'])){
    $patientID = $_GET['patientid'];
    $patientName = $_GET['name'];
    $age = $_GET['age'];
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
    if(isset($_POST['submit'])){
        $sql = "INSERT INTO inpatient(patientID,admit_time,admit_date,room_no,doctorID) VALUES ('$patientID','$mintime','$mindate','$room_no','$doctorID');";
        // $sql = "UPDATE patient SET patient_type = 'inpatient' WHERE patientID = $patientID;";
        $result=mysqli_query($con,$sql);

        if($result){
            // echo '
            // <script type="text/javascript">
            // document.getElementById("admit-popup").style.visibility = "visible";
            // ';
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
                <div class="admit-patient-container">
                    <form method="post">
                        <div class="form-column">
                            <div class="form-row-name">
                                <div class="label">Patient Name</div>
                                <div class="label">Patient ID</div>
                                <div class="label">Age </div>
                                <!-- <div class="label">Gender</div> -->
                                <div class="label">Room No</div>
                                <div class="label">Admit Date</div>
                                <div class="label">Admit Time</div>
                            </div>
                            <div class="form-row-content">
                                <div class="input-feild"><?php echo $patientName ?></div>
                                <div class="input-feild"><?php echo $patientID ?></div>
                                <div class="input-feild"><?php echo $age ?></div>
                                <!-- <div class="input-feild"><?php echo $patientName ?></div> -->
                                
                                <div class="input-feild"><?php echo $room_no ?></div>
                                <div class="input-feild"><?php echo $mindate ?></div>
                                <div class="input-feild"><?php echo $mintime ?></div>
                            </div>
                        </div>
                        <button id="admit-btn" type="submit">Admit Patient</button>
                    </form>
                </div>
        </div>
    </div>
    <!-- <div class="confirm-popup" id ="admit-popup">
        <img src="../images/check.png" alt="check">
        <h2>Admit Successfull!</h2>
        <p>Your patient has been successfully admitted</p>
        <button type="button">OK</button>
    </div> -->
</body>
<!-- <script>
    document.getElementById("admit-btn").addEventListener("click", function(){
        document.querySelector(".confirm-popup").style.visibility = "visible";
    })
</script> -->
</html>
<?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>