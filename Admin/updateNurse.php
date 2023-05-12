<?php
require_once("../conf/config.php");

if (isset($_POST['addNurse'])) {

    $nic = $_GET['id'];
    $department = $_POST['department'];

    $query = "UPDATE nurse SET department = '$department' WHERE
                nic = '$nic';";
    $result = mysqli_query($con, $query);

    header("location:". BASEURL . "/Admin/adminNursePage.php");
} else if (isset($_POST['cancel'])) {
    header("location: " .BASEURL . "/Admin/adminNursePage.php");
}
