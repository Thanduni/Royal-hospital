<?php
session_start();
require_once("../conf/config.php");
if ($_GET['op'] == "delete") {
    $nic = $_GET['id'];
    $query = "Delete FROM user where nic=" . $nic;
    $con->query($query);
    header("location: " . BASEURL . "/Admin/adminUsersPage.php");
}
if ($_GET['op'] == "deleteDoctor") {
    $nic = $_GET['id'];
    $query = "Delete FROM user where nic=" . $nic;
    $con->query($query);
    header("location: " . BASEURL . "/Admin/adminDoctorPage.php");
}
