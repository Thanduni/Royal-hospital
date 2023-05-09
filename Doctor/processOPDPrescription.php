<?php
require_once("../conf/config.php");
// include "prescription.php";

if(isset($_GET['patientid'])){
    $patientID = $_GET['patientid'];
    $prescID = $_GET['prescriptionid'];
    $prescriptionID = $prescID;

    if(isset($_POST['save'])){
        //looping through medicines
        foreach($_POST['drugName'] as $key => $value){
            $drugName = $_POST['drugName'][$key];
            $dosage = $_POST['dosage'][$key];
            $days = $_POST['days'][$key];
            $frequency = $_POST['frequency'][$key];
            echo "<br>".$drugName."<br>";
            echo $dosage."<br>";
            echo $days."<br>";
            echo $frequency."<br>";

            $save = "INSERT INTO prescribed_drugs(drug_name, quantity, days, frequency,prescriptionID,date) VALUES ('$value', '$dosage', '$days', '$frequency', '$prescriptionID', CURDATE());";
            $stmt = mysqli_query($con, $save);
            if($stmt){
                echo "added successfully";
            }
        }
        header("Location: opd-prescription.php?patientid=".$patientID);
    }
}