<?php
require_once("../conf/config.php");

if (isset($_POST['addDoctor'])) {

    $nic = $_POST['nic'];
    $query = "Select count(*) from user where nic = " . $nic . " and user_role='Doctor'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $department = $_POST['department'];


    if ($row['count(*)']) {

        $query = "INSERT INTO doctor(nic, department) VALUES ('$nic', '$department');";
        $result = mysqli_query($con, $query);

        header("location:" . BASEURL . "/Admin/adminDoctorPage.php");
    } else {
        header("location:" . BASEURL . "/Admin/adminUsersPage.php?click=addDoctor&nic=" . $nic . "&department=" . $department);
    }
} else if (isset($_POST['cancel'])) {
    header("location: " . BASEURL . "/Admin/adminDoctorPage.php");
}
