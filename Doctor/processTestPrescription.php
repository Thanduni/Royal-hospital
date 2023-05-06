<?php
require_once("../conf/config.php");

if(isset($_GET['patientid']) && isset($_GET['prescriptionid'])){
    $patientID = $_GET['patientid'];
    $prescriptionID = $_GET['prescriptionid'];
    echo "<br>".$patientID."<br>";
    echo "<br>".$prescriptionID."<br>";

    if(isset($_POST['Save-test'])){
        //looping tests 
        foreach($_POST['Testname'] as $key => $value){
            $Testname = $_POST['Testname'][$key];
            echo "<br>".$Testname."<br>";

            $save = "INSERT into prescribed_tests(prescriptionID,test_name,date) VALUES('$prescriptionID','$Testname',CURDATE());";
            $query =mysqli_query($con,$save);
            if($query){
                echo "Updated successfully";
            }else{
                echo "There was an error";
            }
        }
    }
    header("Location: prescription.php?patientid=".$patientID);
} else {
    echo "Error: Required parameters not set.";
}
