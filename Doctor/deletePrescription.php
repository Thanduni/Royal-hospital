<?php
require_once("../conf/config.php");

if (isset($_GET['pdID'])) {
    $pdID = $_GET['pdID'];
    $patientID = $_GET['patientID'];
    
    $sql = "DELETE from prescribed_drugs WHERE pdID = ?;";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $pdID);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    
    header("Location: prescription.php?patientid=".$patientID);
}
