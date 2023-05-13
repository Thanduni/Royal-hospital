<?php
session_start();
require_once("../conf/config.php");
//get doctor id
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
    // $get_prescID = "SELECT MAX(prescriptionID) FROM prescription WHERE patientID = " . $patientID . " AND date >= (SELECT admit_date FROM inpatient WHERE patientID = " . $patientID . ")";
    // $prescID_query = mysqli_query($con,$get_prescID);
    $prescID_query = mysqli_query($con,"SELECT MAX(prescriptionID) FROM prescription WHERE patientID = " . $patientID . " AND date >= (SELECT MAX(admit_date) FROM inpatient WHERE patientID = " . $patientID . " AND discharge_date is NULL)");
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

function outOFStock() {
    echo '<script>
    document.addEventListener("DOMContentLoaded", function() {
      const errorMessage = document.getElementById("success-message");
      if (errorMessage) {
        errorMessage.innerHTML = \'<p>Sorry, this medicine is out of stock.</p><div><input type="button" class="close-button" value="Close" onclick="closeErrorMessage()"></div>\';
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
      refreshURLWithoutErrorCode();
    }
  
    function refreshURLWithoutErrorCode() {
      const url = window.location.href;
      const updatedURL = url.replace(/([&?])errorCode=[^&]+&?/, "$1").replace(/&$/, "");
      window.location.href = updatedURL;
    }
    </script>';
  }
  
  
  if (isset($_GET['errorCode'])) {
    outOFStock();
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
        <style>
            .user{
                height:inherit;
            }
        </style>
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
            <div class="main-container">
                <div class="prescription-container">

                        <!-- front and back buttons -->
                        <div class="tab-line">
                            <div class="back-div">
                                <a href="inpatient.php ?>">
                                <img src="<?php echo BASEURL . '/images/back-button.png' ?>" alt="">
                                <div class="button-name">Patient</div class="button-name"></a>
                            </div>
                            <div class="front-div">
                                <a href="prescriptionTest.php?patientid=<?=$patientID?>">
                                <img src="<?php echo BASEURL . '/images/right-arrow.png' ?>" alt="">
                                <div class="button-name">Test Prescription</div class="button-name"></a>
                            </div>
                            <!-- <div class="medicine-button " id="medicine-button" onclick ="drugPrescription()">Prescribe Medicine</div>
                            <a href="prescriptionTest.php?patientid=<?=$patientID?>"><div class="test-button" id="test-button">Prescribe Test</div></a> -->
                        </div>

                        <!-- error message  -->
                        <div class="error-message prescription-container-error-message" id="success-message" style="display:none;">
                            <p>Please enter a doctor Note first</p>
                            <a href="displayPatient.php?patientid=<?=$patientID?>"><input type="button" value="Add" class="add-note " name="add-note"></a>
                        </div>
                        <div class="prescribe-medicine-content" id="prescribe-medicine-content">
                            <!-- form for enter medicine prescription -->
                            <form action="processPrescription.php?patientid=<?=$patientID?>&prescriptionid=<?=$prescriptionID?>" class="insert-form" id="insert_form" method="post" autocomplete="off">
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
                                            <td><input type="number" name="days[]" required value=1 readonly></td>
                                            <td><input type="button" name="addd" class="add" value="Add row"></td>
                                            <td><input type="submit" class="save-prescription" name="save" id="save" value="Save Prescription"></td>
                                            <td><input type="submit" class="add-any-prescription" name="add-any" id="add-any" value="Add unavailable medicines"></td>
                                        </tr>
                                        </div>
                                    </table>
                                </div>  
                            </form> 
                            <script type="module" src=<?php echo BASEURL . '/js/medicine.js' ?>></script>
                            <!-- display inserted prescriptions -->
                            <div class="show-prescription">
                                <table class="table">
                                    <thead>
                                        <th>Date</th>
                                        <th>Drug Name</th>
                                        <th>Dosage</th>
                                        <th>Frequency (per day)</th>
                                        <th>No of days</th>
                                        <th>Remove</th>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    if(isset($prescriptionID)){
                                        $select = "SELECT * from prescribed_drugs where prescriptionID ='$prescriptionID';";
                                        $result = mysqli_query($con,$select);
                                
                                        while($row= mysqli_fetch_array($result)){
                                            $med_name = $row['drug_name'];?>
                                    <tr>
                                        <td><?php echo $current_date?></td>
                                        <?php 
                                            $td_color ='';
                                            $check_item = mysqli_query($con,"SELECT * from item WHERE item_name = '$med_name'");
                                            if(mysqli_num_rows($check_item) >0){
                                                $td_color = 'no';
                                            }else{
                                                $td_color = 'yes';
                                            }
                                        ?>
                                        <td class="<?php echo $td_color ?>"><?php echo $row['drug_name'] ?></td>
                                        <td><?php echo $row['quantity'] ?></td>
                                        <td><?php echo $row['frequency'] ?></td>
                                        <td><?php echo $row['days'] ?></td>
                                        <!-- <td><a href="editPrescription.php?drugName=<?php echo $row['drug_name'];?>&prescriptionID=<?= $prescriptionID ?>"><input type="button" name="edit" class="edit-prescription" value="Edit"></a></td> -->
                                        <td>
                                            <!-- delete prescription -->
                                            <a href="deletePrescription.php?pdID=<?php echo $row['pdID'];?>&patientID=<?php echo $patientID ?>">
                                            <input type="button" name="remove" class="remove-prescription" value="Remove"></a>
                                        </td>
                                        <style>
                                            .yes{
                                                color: red;
                                            }
                                        </style>
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
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <!-- autocomplete dropdown for medicine names -->
    <script src="../js/medicine.js"></script>
    <!-- create dynamic table -->
    <script>
        // to add rows
        $(document).ready(function(){
            $(".add").click(function(e){    //pass parameter e
                e.preventDefault();         //stop page refresh
                $("#prescription-table").append(`<tr>
                    <td><input type="text" name="drugName[]" class="autoComplete-input"></td>
                    <td><input type="number" name="dosage[]"></td>
                    <td><input type="number" name="frequency[]"></td>
                    <td><input type="number" name="days[]"  value=1 readonly></td>
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