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
$current_date = date("Y-m-d");
$current_time = date("h:i");
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
//get patient admit details from the database
$admit_details = "SELECT  DATE_FORMAT(admit_time, '%h:%i') as admit_time, admit_date,patientID,room_no from inpatient WHERE patientID = $patientID;";
$get_admit_details = mysqli_query($con,$admit_details);
if($get_admit_details){
    $admit_row = mysqli_fetch_assoc($get_admit_details);
    $admitTime = $admit_row['admit_time'];
    $admitDate = $admit_row['admit_date'];
    $room_no = $admit_row['room_no'];
}
//create string with date and time
$admit_dateTime_string = $admitDate.''.$admitTime;
$current_datetime_string = $current_date. ''. $current_time;

$start_date = new DateTime($admit_dateTime_string);         //create DateTime objects 
$end_date = new DateTime($current_datetime_string);

$interval = date_diff($start_date,$end_date);   //will return a dateInterval object
$admitted_days = $interval->days;
if($admitted_days==0){
    $hours = $interval->h;
    if($hours>=1){
        $admitted_days =1;
    }
}
function displaySuccess(){
    echo '<script>
    document.addEventListener("DOMContentLoaded", function() {
        var successMessage = document.querySelector(".admit-patient-container .admit-patient-detail .success-message");
        if (successMessage) {
            successMessage.style.display = "flex";
        } else {
            console.error("Error: Could not find success message element.");
        }
    });
    </script>';
}

//discharge patient
if(isset($_POST['discharge-patient'])){
    //start a new transaction
    mysqli_begin_transaction($con);

    try{
        //execute queries
        // mysqli_query($con, "DELETE from inpatient WHERE patientID= $patientID");
        mysqli_query($con, "UPDATE inpatient SET discharge_date = CURDATE() WHERE patientID= $patientID");
        mysqli_query($con, "UPDATE room SET room_availability='available' WHERE room_no = $room_no ;");
        mysqli_query($con, "UPDATE patient SET patient_type='outpatient' WHERE patientID = $patientID ;");
        mysqli_query($con, "INSERT into purchases(patientID,date,quantity,paid_status,paid_status1,item,item_flag) VALUES ('$patientID','$current_date','$admitted_days','not paid','not paid','2','s');");

        //commit transaction
        mysqli_commit($con);
        //show success message using javascript
        displaySuccess();

    // header("Location: discharge.php?patientid=".$patientID);
    // exit;
    }catch(Exception $e){
        //rollback if any query failed
        mysqli_rollback($con);
        echo "An error occurred";
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
    <title>Discharge Patient</title>
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
            <div class="display-container">
                <div class="admit-patient-container">
                    <div class="admit-patient-detail">
                        <h2>Patient Discharge Details</h2>
                        <div class="success-message" id="success-message" style="display:none;">
                            <p>Please enter a doctor Note first</p>
                            <a href="inpatient.php"><input type="button" value="OK" class="ok-btn " name="ok-btn"></a>
                        </div>
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
                                    <input type="date" name="dischargeDate" value ="<?php echo $current_date?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Discharge Time</label>
                                    <input type="time" name="dischargeTime" value ="<?php echo $current_time?>" readonly>
                                </div>
                            </div>
                            <button id="discharge-btn" class="discharge-patient-btn custom-btn" type="submit" name="discharge-patient">Discharge Patient</button>
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