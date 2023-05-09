<?php
session_start();
//die( $_SESSION['profilePic']);
require_once("../conf/config.php");
if (isset($_SESSION['mailaddress']) && $_SESSION['userRole'] == 'Doctor') {
  $nic = $_SESSION['nic'];
  $doctorID_query = "select doctorID from doctor join user on user.nic = doctor.nic where user.nic = $nic";
  $get_doctorID = mysqli_query($con,$doctorID_query);
  $row = mysqli_fetch_assoc($get_doctorID);
  $doctorID = $row["doctorID"];
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/style.css' ?>">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/doctorStyle.css' ?>">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/inpatient.css' ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
    </script>
    <script src="https://kit.fontawesome.com/04b61c29c2.js" crossorigin="anonymous"></script>
    <style>
        .next {
            position: initial;
            height: auto;
        }
    </style>   
    <title>Appointments</title> 
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
                <div class="show-inpatients">
                <input type="text" class="doctor-searchBar" id="myInput" placeholder="Search for Names...">
                <script src=<?php echo BASEURL . '/js/filterTable.js' ?>></script>
                    <h3>Previous Appointments</h3>
                    <table class="table">
                        <thead>
                          <th>Patient</th>
                          <th>Status</th>
                          <th>Investigation</th>
                          <!-- <th>Prescription</th> -->
                        </thead>
                        <tbody>
                            <?php 
                                $select="SELECT user.profile_image,user.name,appointment.appointmentID,appointment.date,appointment.time,appointment.message,appointment.patientID,prescription.prescriptionID,prescription.investigation,patient.patient_type FROM appointment JOIN patient ON appointment.patientID=patient.patientID JOIN user ON user.nic=patient.nic LEFT JOIN prescription ON appointment.patientID = prescription.patientID WHERE appointment.doctorID =$doctorID AND appointment.date=CURDATE() AND appointment.status='Complete'";
                                $result = mysqli_query($con,$select);
                            
                                while($row= mysqli_fetch_array($result)){
                                    $patientID = $row['patientID'];
                                    $prescriptionID = $row['prescriptionID'];
                                    ?>
                                <tr>
                                    <td><div class="left-cell">
                                            <?php echo "<img src='".BASEURL."/uploads/".$row['profile_image']."'width = 40px height=40px>";?>
                                        </div>
                                        <div class="right-cell">
                                            <div class="up-cell"><?php echo $row['name'] ?></div>
                                            <div class="down-cell">id :<?php echo $row['patientID'] ?></div>
                                        </div>
                                    </td>
                                    <td><?php echo $row['patient_type'] ?></td>
                                    <td><?php echo $row['investigation'] ?></td>
                                    <!-- <td><?php 
                                        $get_prescription = "SELECT drug_name from prescribed_drugs WHERE prescriptionID= $prescriptionID  ";
                                        $get_prescription_query = mysqli_query($con,$get_prescription);
                                        $row2 = mysqli_fetch_array($get_prescription_query);
                                        echo $row2['drug_name'];
                                    ?></td> -->
                                </tr>
                                <?php
                                } ?>
                        </tbody>
                    </table>
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
