<?php
require_once("../conf/config.php");

if (isset($_GET['drugName'])) {
    $drug_name = $_GET['drugName'];
    $prescriptionID = $_GET['presID'];
    
    $sql = "DELETE from prescribed_drugs WHERE prescriptionID = ? AND drug_name = ?;";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $prescriptionID, $drug_name);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    
    header("Location: prescription.php?prescriptionID=".$prescriptionID);
}
