<?php
session_start();
require_once("../conf/config.php");
if ($_GET['op'] == "delete") {
    $nic = $_GET['id'];
    $query = "Delete FROM user where nic=" . $nic;
    $con->query($query);
    header("location: " . BASEURL . "/Admin/adminUsersPage.php");
} else if ($_GET['op'] == "edit") {
    $result = unserialize($_GET['result']);
}