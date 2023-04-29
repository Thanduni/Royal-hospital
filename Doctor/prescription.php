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

    $get_prescID = "SELECT MAX(prescriptionID) FROM prescription WHERE patientID = $patientID AND date >= (SELECT admit_date FROM inpatient WHERE patientID = $patientID)";
    $prescID_query = mysqli_query($con,$get_prescID);
    // Fetch the result of the query (query can return a row with NULL)
    $row = mysqli_fetch_array($prescID_query);

    // Check if the value is not null
    if (isset($row[0])){
        $prescriptionID = $row[0];
    }else{
        displayErrorMessage();
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
                        <div class="medicine-button" id="medicine-button" onclick ="drugPrescription()">Prescribe Medicine</div>
                        <div class="test-button" id="test-button" onclick="testPrescription()">Prescribe Test</div>
                    </div>

                    <div class="error-message prescription-container-error-message" id="success-message" style="display:none;">
                        <p>Please enter a doctor Note first</p>
                        <a href="displayPatient.php?patientid=<?=$patientID?>"><input type="button" value="Add" class="add-note" name="add-note"></a>
                    </div>
                    <div class="prescribe-medicine-content">
                        <form action="#" class="insert-form" id="insert_form" method="post">
                            <div class="input-feild">
                                <table id="prescription-table">
                                    <tr>
                                        <th>Drug Name</th>
                                        <th>Dosage (per day)</th>
                                        <th>Frequency (per day)</th>
                                        <th>No of days</th>
                                    </tr>
                                    <div class="show-medicine">
                                        
                                        <?php
                                        if(isset($_POST['save'])){
                                            $drugName = $_POST['drugName'];
                                            $dosage = $_POST['dosage'];
                                            $days = $_POST['days'];
                                            $frequency = $_POST['frequency'];

                                            //to prevent SQL injection 
                                            $save = "INSERT INTO prescribed_drugs(drug_name, quantity, days, frequency, prescriptionID,date) VALUES (?, ?, ?, ?, ?,CURDATE());";   // ? is used as placeholders to represent the value we want to insert
                                            $stmt = mysqli_prepare($con, $save);        //prepare the statement

                                            if(isset($prescriptionID)){
                                                //bind the variables to the statement usding mysqli_stmt_bind_param()
                                                // 'sssss' indicate the type of variables we are binding (all strings)
                                                foreach ($drugName as $key => $value) {
                                                    mysqli_stmt_bind_param($stmt, "sssss", $value, $dosage[$key], $days[$key], $frequency[$key], $prescriptionID);
                                                    mysqli_stmt_execute($stmt);     //actualy execute the the statement
                                                }
                                                mysqli_stmt_close($stmt);           //close the statement
                                            } 
  
                                        }

                                        ?>

                                    <tr>
                                        <td><input type="text" name="drugName[]"></td>
                                        <td><input type="number" name="dosage[]"></td>
                                        <td><input type="number" name="frequency[]"></td>
                                        <td><input type="number" name="days[]"></td>
                                        <td><input type="button" name="addd" class="add" value="Add"></td>
                                    </tr>
                                    </div>
                                </table>
                                <input type="submit" class="save-prescription" name="save" id="save" value="save data">
                            </div>  
                        </form> 
                        
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
                                        <a href="deletePrescription.php?pdID=<?php echo $row['pdID'];?>&patientID=<?php echo $patientID ?>">
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
                    </div>

                    <!-- <div class="prescribe-test-content">
                        <form action="post">
                            <div class="prescription-group">
                                <label>Test Name </label>
                                <input type="text" class="form-control" placeholder="Test Name" name="Test Name">
                            </div>
                            <button type="submit" name ="submit-test-prescription">Submit</button>
                        </form>
                    </div> -->
                </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        // to add rows
        $(document).ready(function(){
            $(".add").click(function(e){    //pass parameter e
                e.preventDefault();         //stop page refresh
                $("#prescription-table").append(`<tr>
                    <td><input type="text" name="drugName[]"></td>
                    <td><input type="number" name="dosage[]"></td>
                    <td><input type="number" name="days[]"></td>
                    <td><input type="number" name="frequency[]"></td>
                    <td><input type="button" name="remove" class="remove" value="Remove"></td>
                    </tr>`);
            });

            //remove rows
            $(document).on('click', '.remove', function(e){
                e.preventDefault();
                let = row_med = $(this).parent().parent();  //select parent of parent of remove btn.. which is <tr>
                $(row_med).remove();
            });
        });
    </script>

<?php
    if(isset($_POST['remove'])){
        $id = $_POST['id'];
        $drug_name = $_POST['drug'];

        $delete_row = "DELETE from prescribed_drugs WHERE prescriptionID = $id AND drug_name = '$drug_name';";
        $delete_query = mysqli_query($con,$delete_row);

        if($delete_query){
            echo "Row deleted Successfully";
        }
    }
?>
</body>
</html>
<?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>