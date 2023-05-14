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
//function for display error message
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

    $prescID_query = mysqli_query($con,"SELECT MAX(prescriptionID) FROM prescription WHERE patientID = $patientID  AND doctorID= $doctorID; ");
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
        //if a doctor note is added
        if(isset($presID_row[0])){
            $prescriptionID = $presID_row[0];
        }
        else{
            //no doctor note added
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
    <title>Prescription Test</title>
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
            <div class="back-button-div">
                <a href="opd-prescription.php?patientid=<?=$patientID ?>">
            <img src="<?php echo BASEURL . '/images/back-button.png' ?>" alt="">
            <div class="button-name">Medicine Prescription</div class="button-name"></a>
            </div>
            <!-- display error message -->
            <div class="error-message prescription-container-error-message" id="success-message" style="display:none;">
                <p>Please enter a doctor Note first</p>
                <a href="displayPatient.php?patientid=<?=$patientID?>"><input type="button" value="Add" class="add-note " name="add-note"></a>
            </div>
            <!-- dynamic form for test prescription -->
            <div class="prescribe-test-content" id="prescribe-test-content">
                <form action="processTestPrescription.php?patientid=<?=$patientID?>&prescriptionid=<?=$prescriptionID?>" class="insert-form" id="insert_form" method="post" autocomplete="off" onsubmit="return validateForm()">
                    <table class="prescription-test-table">
                        <thead>
                            <th>Test Name</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td><div id="autocomplete-wrapper" class="autocomplete-wrapper"><input type="text"  name="Testname[]" class="autoComplete-input" required></div></td>
                                <td><input type="button" name="addd" class="add-test" value="Add"></td>
                                <td><input type="submit" value="Save Prescription" name="Save-test" class="save-prescription" id="save-test"></td>
                            </tr>
                        </tbody>
                    </table>
                </form>
                <script src="../js/medical-tests.js"></script>
                <script>
                    function validateForm() {
                    // Get the input field values
                    var testName = document.querySelector('input[name="Testname[]"]').value.trim();

                    // Check if any input field contains only whitespace
                    if (testName === '') {
                        alert('Please fill in all fields.');
                        return false; // Prevent form submission
                    }

                    // All input fields have valid values, allow form submission
                    return true;
                    }
                </script>
                <!-- display added prescriptions -->
                <div class="show-test-prescription">
                    <table class="table">
                        <thead>
                            <th>Date</th>
                            <th>Test Name</th>
                            <th>Option</th>
                        </thead>
                        <tbody>
                        <?php
                            if(isset($prescriptionID)){
                                $select_test = "SELECT * from prescribed_tests where prescriptionID ='$prescriptionID';";
                                $select_query = mysqli_query($con,$select_test);

                                while($test_row =mysqli_fetch_array($select_query)){?>
                                    <tr>

                                        <td><?php echo $test_row['date']?></td>
                                        <td><?php echo $test_row['test_name']?></td>
                                        <td>
                                        <a href="deletePrescription.php?ptID=<?php echo $test_row['ptID'];?>&patientID=<?php echo $patientID ?>">
                                        <input type="button" name="remove" class="remove-prescription" value="Remove"></a>
                                    </td>
                                    </tr>
                                <?php
                                }
                            }
                        ?>
                        <tr></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script>
    // to add rows
    $(document).ready(function(){
        $(".add-test").click(function(e){    //pass parameter e
            e.preventDefault();             //stop page refresh
            $(".prescription-test-table").append(`<tr>
                <td><input type="text"  name="Testname[]" class="autoComplete-input" required></td>
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