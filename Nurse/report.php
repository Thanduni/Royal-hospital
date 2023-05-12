<?php
session_start();
require_once("../conf/config.php");
if (isset($_SESSION['mailaddress']) && $_SESSION['userRole'] == 'Nurse') {
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/style.css' ?>">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/nurseStyle.css' ?>">
    <style>
        .user{
            height:inherit;
        }
        .next {
            position: initial;
            height: auto;
        }
    </style> 
    <title>Reports</title>
</head>

<body>
<div class="user">
<?php
        $name = urlencode( $_SESSION['name']);
        include(BASEURL . '/Components/nurseSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name); ?>
        <div class="userContents">
        <?php
            $name = urlencode( $_SESSION['name']);
            include(BASEURL.'/Components/nursetopbar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name . "&userRole=" . $_SESSION['userRole']. "&nic=" . $_SESSION['nic']);
            ?>

            <div class="main-container">
                <h3 class="nurse_heads">In-patient List</h3>
                <div class="wrapper">
                    <div class="table">
                        <div class="row headerT">
                            <div class="cell">Name</div>
                            <div class="cell">Room No</div>
                            <div class="cell">Option</div>
                        </div>
                        <?php 
                            $sql="select patient.patientID,user.name,inpatient.room_no from user join patient on user.nic=patient.nic join inpatient on inpatient.patientID=patient.patientID;";
                            $result=mysqli_query($con,$sql);
                            
                            if($result){
                                while($row=mysqli_fetch_assoc($result)){
                                $name =  $row['name'];
                                $RoomNo = $row['room_no'];
                                $admit_date = $row['admit_date'];
                                $admit_time = $row['admit_time'];
                                $drug_allergies = $row['drug_allergies'];
                                $emergency_contact = $row['emergency_contact'];?>

                        <div class="row">
                            <div class="cell"><?php echo $name?></div>
                            <div class="cell"><?php echo $RoomNo?></div>
                            <div class="cell"><button class="button custom-btn" id="report-button"><a href="dailyReport.php?patientid='.$patientID.'&name='.$name.'">View </a></button></div>
                        </div>
                        <?php }
                            }
                            ?>
                <div class="table-container" id="reportContainer">
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