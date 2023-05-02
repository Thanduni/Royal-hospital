<?php
session_start();
require_once("../conf/config.php");
    $appointmentID = $_GET['id'];
    $query = "Delete FROM appointment where appointmentID=" . $appointmentID;
    $con->query($query);

    header("location: " . BASEURL . "/Receptionist/makeAppointment.php");
