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

function displayErrorMessage() {
    echo '<script>
  document.addEventListener("DOMContentLoaded", function() {          
    var errorMessage = document.querySelector(".prescription-container .prescription-container-error-message");
    if(errorMessage) {
      errorMessage.style.display = "flex";
    } else {
      console.error("Error: Could not find error message element.");
    }
  });
</script>';
}

if(isset($_GET['patientid'])){
    $patientID = $_GET['patientid'];

    //if a inpatient re direct to prescription.php
    $check_patientType = "SELECT * from inpatient WHERE patientID = $patientID;";
    $check_query = mysqli_query($con,$check_patientType);
    if(mysqli_num_rows($check_query)>0){
        header("Location: prescription.php?patientid=".$patientID);
    }

    $get_prescID = "SELECT MAX(prescriptionID) FROM prescription WHERE patientID = $patientID AND doctorID = $doctorID";
    $prescID_query = mysqli_query($con,$get_prescID);
    // Fetch the result of the query (query can return a row with NULL)
    $row = mysqli_fetch_array($prescID_query);

    // Check if the value is not null
    if (isset($row[0])){
        $prescriptionID = $row[0];
    }else{
        //get out patient prescriptionID
        $get_opd_prescriptionID = "SELECT MAX(prescriptionID) from prescription WHERE patientID =$patientID";
        $get_opd_prescriptionID_query = mysqli_query($con,$get_opd_prescriptionID);
        $presID_row = mysqli_fetch_array($get_opd_prescriptionID_query);
        if(isset($presID_row[0])){
            $prescriptionID = $presID_row[0];
        }
        else{
            displayErrorMessage();
        }
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

        <link rel="stylesheet" href="<?php echo BASEURL . '/css/prescription.css' ?>">
        <title>Prescription</title>
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
            <div class="prescription-container">


                    <div class="tab-line">
                        <div class="medicine-button " id="medicine-button" onclick ="drugPrescription()">Prescribe Medicine</div>
                        <a href="prescriptionTest.php?patientid=<?=$patientID?>"><div class="test-button" id="test-button">Prescribe Test</div></a>
                    </div>

                    <div class="error-message prescription-container-error-message" id="success-message" style="display:none;">
                        <p>Please enter a doctor Note first</p>
                        <a href="displayPatient.php?patientid=<?=$patientID?>"><input type="button" value="Add" class="add-note " name="add-note"></a>
                    </div>
                    <div class="prescribe-medicine-content" id="prescribe-medicine-content">
                        <form action="processOPDPrescription.php?patientid=<?=$patientID?>&prescriptionid=<?=$prescriptionID?>" class="insert-form" id="insert_form" method="post" autocomplete="off">
                            <div class="input-feild">
                                <table id="prescription-table">
                                    <tr>
                                        <th>Drug Name</th>
                                        <th>Dosage</th>
                                        <th>Frequency (per day)</th>
                                        <th>No of days</th>
                                    </tr>
                                    <div class="show-medicine">

                                    <tr>
                                        <td><div id="autocomplete-wrapper" class="autocomplete-wrapper"><input type="text" name="drugName[]" class="autoComplete-input" required>
                                            </div>
                                        </td>
                                        <td><input type="number" name="dosage[]" required min=0></td>
                                        <td><input type="number" name="frequency[]" required min=0></td>
                                        <td><input type="number" name="days[]" required min=0></td>
                                        <td><input type="button" name="addd" class="add" value="Add"></td>
                                    </tr>
                                    </div>
                                </table>
                                <input type="submit" class="save-prescription" name="save" id="save" value="save data">
                            </div>  
                        </form> 
                        <script type="module" src=<?php echo BASEURL . '/js/medicine.js' ?>></script>
                        
                        <div class="show-prescription">
                            <table class="table">
                                <thead>
                                    <th>ID</th>
                                    <th>Drug Name</th>
                                    <th>Dosage (per day)</th>
                                    <th>Frequency (per day)</th>
                                    <th>No of days</th>
                                    <!-- <th>Edit</th> -->
                                    <th>Remove</th>
                                </thead>
                                <tbody>
                                <?php 
                                if(isset($prescriptionID)){
                                    $select = "SELECT * from prescribed_drugs where prescriptionID ='$prescriptionID';";
                                    $result = mysqli_query($con,$select);
                            
                                    while($row= mysqli_fetch_array($result)){?>
                                <tr><td><?php  echo $prescriptionID ?></td>
                                    <td><?php echo $row['drug_name'] ?></td>
                                    <td><?php echo $row['quantity'] ?></td>
                                    <td><?php echo $row['frequency'] ?></td>
                                    <td><?php echo $row['days'] ?></td>
                                    <!-- <td><a href="editPrescription.php?drugName=<?php echo $row['drug_name'];?>&prescriptionID=<?= $prescriptionID ?>"><input type="button" name="edit" class="edit-prescription" value="Edit"></a></td> -->
                                    <td>
                                        <a href="deleteOPDPrescription.php?pdID=<?php echo $row['pdID'];?>&patientID=<?php echo $patientID ?>">
                                        <input type="button" name="remove" class="remove-prescription" value="Remove"></a>
                                    </td>
                                    
                                </tr>
                                <?php
                                    }
                                }else{
                                    displayErrorMessage();
                                } ?>
                                </tbody>

                            </table>
                            
                        </div>
                    </form>
                    <script type="module" src=<?php echo BASEURL . '/js/medicine.js' ?>></script>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="../js/medicine.js"></script>
    <script>
        // to add rows
        $(document).ready(function(){
            $(".add").click(function(e){    //pass parameter e
                e.preventDefault();         //stop page refresh
                $("#prescription-table").append(`<tr>
                    <td><input type="text" name="drugName[]" class="autoComplete-input"></td>
                    <td><input type="number" name="dosage[]"></td>
                    <td><input type="number" name="days[]"></td>
                    <td><input type="number" name="frequency[]"></td>
                    <td><input type="button" name="remove" class="remove" value="Remove"></td>
                    </tr>`);

                addAutoCompleteDropdownToInputs();


            });
            //remove rows
            $(document).on('click', '.remove', function(e){
                e.preventDefault();
                let = row_med = $(this).parent().parent();  //select parent of parent of remove btn.. which is <tr>
                $(row_med).remove();
            });
        });

    </script>
    </body>
    </html>
    <?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>