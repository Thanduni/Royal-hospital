<?php
require_once("../conf/config.php");

if (isset($_POST['submit'])) {

    $currentDate = date("Y-m-d");
    $expiredDate = $_POST['expiredDate'];
    $query = "Select expiredDate from inventory where expiredDate = " . $expiredDate . " ";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);

    if ($expiredDate > $currentDate) {

        $query = "INSERT INTO inventory(useState) VALUES ('0');";
        $result = mysqli_query($con, $query);

        header("location:" . BASEURL . "/Storekeeper/storekeeperViewStock.php");
    } else {

        $query = "INSERT INTO inventory(useState) VALUES ('1');";
        $result = mysqli_query($con, $query);

        header("location:" . BASEURL . "/Admin/adminUsersPage.php?click=addNurse&nic=" . $nic);
    }
} 
