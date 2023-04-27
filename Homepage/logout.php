<?php
session_start();
require_once("../conf/config.php");
if (isset($_GET['logout'])) {
    session_destroy();
    header("location:" . BASEURL . "/Homepage/login.php");
} else if (isset($_GET['cancel'])) {
    if ($_SESSION['userRole'] == "Admin")
        header("location: " . BASEURL . "/Admin/adminDash.php");
    else if ($_SESSION['userRole'] == "Doctor")
        header("location: " . BASEURL . "/Doctor/doctorDash.php");
    else if ($_SESSION['userRole'] == "Nurse")
        header("location: " . BASEURL . "/Nurse/nursedashboard.php");
    else if ($_SESSION['userRole'] == "Receptionist")
        header("location: " . BASEURL . "/Receptionist/receptionistDash.php");
    else if ($_SESSION['userRole'] == "Patient")
        header("location: " . BASEURL . "/Patient/patientDash.php");
    else if ($_SESSION['userRole'] == "Storekeeper")
        header("location: " . BASEURL . "/Storekeeper/storekeeperDash.php");
}
