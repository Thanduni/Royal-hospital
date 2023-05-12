<?php
session_start();
require_once("../conf/config.php");
if (isset($_SESSION['mailaddress']) && $_SESSION['userRole'] == 'Nurse') {

?>
<?php
if(isset($_GET['patientid'])){
    $patientID = $_GET['patientid'];

    $get_prescID = "SELECT MAX(prescriptionID) FROM prescription WHERE patientID = $patientID";
    $prescID_query = mysqli_query($con,$get_prescID);
    if(mysqli_num_rows($prescID_query) > 0) {
        $get_row = mysqli_fetch_assoc($prescID_query);
        $prescriptionID = $get_row['MAX(prescriptionID)'];
    } else {
        //DOMContentLoaded event listener ensure that the code is executed only after the HTML document has loaded
        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {          
            var errorMessage = document.querySelector(".prescription-container .prescription-container-error-message");
            if(errorMessage) {
                errorMessage.style.display = "block";
            } else {
                console.error("Error: Could not find error message element.");
            }
        });
      </script>';
    }
}
$get_patient_data = "SELECT name,profile_image from user join patient on patient.nic = user.nic WHERE patientID = $patientID;";
$get_data_query = mysqli_query($con,$get_patient_data);
if($get_data_query){
    $data_row = mysqli_fetch_assoc($get_data_query);
    $patientName = $data_row['name'];
    $patient_image = $data_row['profile_image'];
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/style.css' ?>">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/nurseStyle.css' ?>">
    <title>Prescription</title>
    <style>
        .sub-main{
            width:100%;
            justify-content: center;
        }
        .sub-main .left-container {
            width: 75%;
        }
        .sub-main .right-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: unset;
            width: 25%;
        }
        .table{
            width: 100%;
            color: #000;
        }
    </style>
</head>
<body>
    <div class="user">
        <?php
        $name = urlencode( $_SESSION['name']);
        include(BASEURL . '/Components/nurseSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name); ?>
        <div class="userContents" id="center">
            <?php
            $name = urlencode( $_SESSION['name']);
            include(BASEURL.'/Components/nursetopbar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name . "&userRole=" . $_SESSION['userRole']. "&nic=" . $_SESSION['nic']);
            ?>
            <div class="main-container">
                <h3 class="nurse_heads">View Prescription</h3>
                <div class="sub-main">
                    <div class="left-container">
                        <div class="patient-details">
                        <div class="patient-image">
                            <?php echo "<img src='".BASEURL."/uploads/".$patient_image."'width = 40px height=40px>";?>
                        </div>
                        <div class="detail-cell">
                            <div class="patient-name">Patient Name: <?php  echo $patientName ?>  </div>
                            <div class="patient-id">Patient ID: <?php echo $patientID?></div>
                        </div>
                        </div>

                        <div class="table-container">
                            <style>
                            .table-container{
                                align-items: flex-start;
                            }
                            </style>
                            <table class="table">
                                <thead>
                                    <th>Date</th>
                                    <th>Drug Name</th>
                                    <th>Dosage</th>
                                    <th>Frequency</th>
                                    <th>No of Days</th>
                                </thead>
                                <tbody>
                                    <?php 
                                    $select = "SELECT * from prescribed_drugs where prescriptionID ='$prescriptionID';";
                                    $result = mysqli_query($con,$select);

                                    while($row= mysqli_fetch_array($result)){?>
                                    <tr><td><?php echo $row['date'] ?></td>
                                        <td><?php echo $row['drug_name'] ?></td>
                                        <td><?php echo $row['quantity'] ?></td>
                                        <td><?php echo $row['frequency'] ?></td>
                                        <td><?php echo $row['days'] ?></td>
                                    </tr>
                                    <?php
                                    } 
                                    ?> 
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="right-container">
                        <!-- <button class="button custom-btn" id="dailyreportbutton">
                        New entry
                        </button> -->
                        <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
                        <lord-icon
                            src="https://cdn.lordicon.com/nocovwne.json"
                            trigger="hover"
                            colors="primary:#121331,secondary:#3c77c6"
                            stroke="55"
                            style="width:250px;height:250px">
                        </lord-icon>
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