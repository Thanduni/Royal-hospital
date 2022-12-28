<?php
require_once("../conf/config.php");

if (isset($_POST['addDoctor'])) {

    $nic = $_POST['nic'];
    $query = "Select count(*) from user where nic = ". $nic . " and user_role='Doctor'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
//    die($row['count(*)']);

    if($row['count(*)']){
        $department = $_POST['department'];

        $query = "INSERT INTO doctor(nic, department) VALUES ('$nic', '$department');";
        $result = mysqli_query($con, $query);

        header("location:". BASEURL . "/Admin/adminDoctorPage.php");
    }else{
        header("location:". BASEURL . "/Admin/adminUsersPage.php?click=addUser");
    }
} else if (isset($_POST['cancel'])) {
    header("location: " .BASEURL . "/Admin/adminDoctorPage.php");
}
