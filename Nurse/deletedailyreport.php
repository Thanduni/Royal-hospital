<?php
require_once("../conf/config.php");

if(isset($_GET['id'])){
    $reportid = $_GET['id'];
    $patientID = $_GET['patientid'];

    $delete = "DELETE from daily_report WHERE reportID = $reportid";
    $query = mysqli_query($con,$delete);
    if($query){
        header("Location: dailyReport.php?patientid=$patientID");
    }
}