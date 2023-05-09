<?php
require_once("../conf/config.php");

if (isset($_GET['pdID'])) {
    $pdID = $_GET['pdID'];
    $patientID = $_GET['patientID'];

    $delete = "DELETE from prescribed_drugs WHERE pdID = $pdID;";
    $stmt = mysqli_query($con, $delete);
    if($stmt){
        header("Location: opd-prescription.php?patientid=".$patientID);
    }
}
        