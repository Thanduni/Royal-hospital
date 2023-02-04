<?php
session_start();
//die( $_SESSION['profilePic']);
require_once("../conf/config.php");

if(isset($_POST['filterAppointment'])){
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    header("Location: ". BASEURL . "/Receptionist/serviceDetails.php?startDate=".$startDate."&enddate=".$endDate);
}