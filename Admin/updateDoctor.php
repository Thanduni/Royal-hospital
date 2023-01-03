<?php
require_once("../conf/config.php");

if (isset($_POST['addDoctor'])) {

    $nic = $_GET['id'];
    $department = $_POST['department'];

    $query = "UPDATE doctor SET department = '$department' WHERE
                nic = '$nic';";
    $result = mysqli_query($con, $query);

    header("location:". BASEURL . "/Admin/adminDoctorPage.php");
} else if (isset($_POST['cancel'])) {
    header("location: " .BASEURL . "/Admin/adminDoctorPage.php");
}
