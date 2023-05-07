<?php
session_start();
require_once("../conf/config.php");
if (isset($_SESSION['mailaddress']) && $_SESSION['userRole'] == 'Nurse') {

?>
<?php
if(isset($_GET['patientid'])){
    $patientID = $_GET['patientid'];

    $get_prescID = "SELECT MAX(prescriptionID) FROM prescription WHERE patientID = $patientID AND date >= (SELECT admit_date FROM inpatient WHERE patientID = $patientID)";
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

                    <div class="prescribe-medicine-content">
                        <div class="show-prescription" id="nurse-view-prescription">
                            <table class="table">
                                <thead>
                                    <th>ID</th>
                                    <th>Drug Name</th>
                                    <th>Dosage (per day)</th>
                                    <th>Frequency (per day)</th>
                                    <th>No of days</th>
                                </thead>
                                <tbody>
                                <?php 
                                $select = "SELECT * from prescribed_drugs where prescriptionID ='$prescriptionID';";
                                $result = mysqli_query($con,$select);
                            
                                while($row= mysqli_fetch_array($result)){?>
                                <tr><td><?php  echo $prescriptionID ?></td>
                                    <td><?php echo $row['drug_name'] ?></td>
                                    <td><?php echo $row['quantity'] ?></td>
                                    <td><?php echo $row['frequency'] ?></td>
                                    <td><?php echo $row['days'] ?></td>
                                    <td>
                                        <a href="deletePrescription.php?pdID=<?php echo $row['pdID'];?>&patientID=<?php echo $patientID ?>">
                                        <input type="button" name="remove" class="remove-prescription custom-btn" value="Remove"></a>
                                    </td>
                                    
                                </tr>
                                <?php
                                } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="request-medicine">
                            <h2></h2>
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