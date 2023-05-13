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
//get patientID from url
if(isset($_GET['patientid'])){
    $patientID = $_GET['patientid'];
}

//function to display error message
function displayRemove() {
    echo '<script>
    document.addEventListener("DOMContentLoaded", function() {
      const errorMessage = document.getElementById("success-message");
      if (errorMessage) {
        errorMessage.innerHTML = \'<p>Previously added prescription will be removed</p><div><input type="button" class="close-button" value="Close" onclick="closeErrorMessage()"></div>\';
        errorMessage.style.display = "flex";
      } else {
        console.error("Error: Could not find error message element.");
      }
    });
  
    function closeErrorMessage() {
      const errorMessage = document.getElementById("success-message");
      if (errorMessage) {
        errorMessage.style.display = "none";
      }
    }
    </script>';
}

//check for added medical prescriptions
$checkid = 0;
$get_opd_prescriptionID = "SELECT MAX(prescriptionID) from prescription WHERE patientID =$patientID";
$get_opd_prescriptionID_query = mysqli_query($con,$get_opd_prescriptionID);
$presID_row = mysqli_fetch_array($get_opd_prescriptionID_query);
if(isset($presID_row[0])){
    $prescriptionID = $presID_row[0];
    $check_pdID = mysqli_query($con,"SELECT pdID from prescribed_drugs WHERE prescriptionID = $prescriptionID");
    if(mysqli_num_rows($check_pdID)>0){
        displayRemove();
        $checkid = 1;
    }
    
}

//get date and time
date_default_timezone_set('Asia/Colombo');
$mindate = date("Y-m-d");
$mintime = date("h:i");

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

        $update_status = "UPDATE patient SET patient_type ='inpatient' WHERE patientID = $patientID;";
        $update_status_query = mysqli_query($con,$update_status);

        $update_bed = "UPDATE room SET room_availability = 'not_available' WHERE room_no= $room_no;";
        $update_bed_query = mysqli_query($con,$update_bed);

        if($get_result && $update_bed_query && $update_status_query){ 
            if($checkid ==1){
                //if a prescription added delete it
                $delete = "DELETE from prescribed_drugs WHERE prescriptionID = $prescriptionID ";
                $delete_query = mysqli_query($con,$delete);
            }
            header("Location: inpatient.php");

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
    <style>
        .user{
            height:inherit;
        }
        .next {
            position: initial;
            height: auto;
        }
        .error-message {
            margin: 0.6em 0 0 0
        }
    </style>
    <title>Admission</title>
</head>
<body>
    <div class="user">
        <?php
        $name = urlencode( $_SESSION['name']);
        include(BASEURL . '/Components/doctorSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name); ?>
        <div class="userContents" id="center">
            <?php
            $name = urlencode( $_SESSION['name']);
            include(BASEURL.'/Components/doctorTopbar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name . "&userRole=" . $_SESSION['userRole']. "&nic=" . $_SESSION['nic']);
            ?>
            <!-- <div class="display-container"> -->
                <div class="admit-patient-container">
                    <div class="admit-patient-detail ">
                        <div class="error-message admit-patient-container-error-message" id="success-message" style="display:none;">
                            <p>Previously added prescription will be removed</p>
                            <input type="button" class="close-button" value="Okay" onclick="closeErrorMessage()">
                        </div>
                        <h2>Patient Admission Details</h2>
                        <form method="post" class="admit-patient-form">
                            <div class="form-group">
                                <label for="">Patient Name</label>
                                <input type="text" name="patientName" value ="<?php echo $patientName ?>" readonly>
                            </div>
                            <!-- <div class="form-group">
                                <label for="">Patient ID</label>
                                <input type="text" name="patientID" value ="<?php echo $patientID?>" readonly>
                            </div> -->
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="">Age</label>
                                    <input type="number" name="age" value ="<?php echo $age?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Room No</label>
                                    <input type="number" name="roomNo" value ="<?php echo $room_no?>" readonly>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="">Admit Date</label>
                                    <input type="date" name="admitDate" value ="<?php echo $mindate?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Admit Time</label>
                                    <input type="time" name="admitTime" value ="<?php echo $mintime?>" readonly>
                                </div>
                            </div>
                            <button id="admit-btn" class="admit-patient-btn custom-btn" type="submit" name="admit-patient">Admit Patient</button>
                        </form>
                    </div>
                </div>
            <!-- </div> -->
        </div>
    </div>
    <div class="popup" id="popup">
        <div class="confirm-popup" id ="admit-popup">
            <img src="../images/check.png" alt="check">
            <h2>Admit Successfull!</h2>
            <p>Your patient has been successfully admitted</p>
            <button type="button" class="close-confirm-popup custom-btn">OK</button>
        </div>
    </div>

    <script>
    document.querySelector(".close-confirm-popup").addEventListener("click", function(){
                document.querySelector(".popup").style.display = "none";
            })
    </script>
</body>
</html>
<?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>