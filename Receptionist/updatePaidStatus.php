<?php
require_once("../conf/config.php");
session_start();

$purchaseID = $_POST['purchaseID'];

$updatePaidStatusQuery = "UPDATE `purchases` SET `paid_status`='paid',`paid_status1`='Paid' WHERE purchaseID='$purchaseID';";
$updatePaidStatusResult = mysqli_query($con, $updatePaidStatusQuery);

if($updatePaidStatusResult)
    echo json_encode(array("status" => "Success"));
else
    echo json_encode(array("status" => "Failure"));