<?php
session_start();
//die( $_SESSION['profilePic']);
require_once("../conf/config.php");

if(isset($_POST['filterAppointment'])){
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    if($_POST['paidStatus']){
        $status = "not paid";
    }
    if($status)
        header("Location: ". BASEURL . "/Receptionist/serviceDetails.php?startDate=".$startDate."&endDate=".$endDate."&id=".$_GET['id']."&status=".$status);
    else
        header("Location: ". BASEURL . "/Receptionist/serviceDetails.php?startDate=".$startDate."&endDate=".$endDate."&id=".$_GET['id']);
}