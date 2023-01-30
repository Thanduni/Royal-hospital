<?php
require_once("../conf/config.php");

if (isset($_POST['addNurse'])) {

    $nic = $_POST['nic'];
    $query = "Select count(*) from user where nic = " . $nic . " and user_role='Nurse'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row['count(*)']) {

        $query = "INSERT INTO nurse(nic) VALUES ('$nic');";
        $result = mysqli_query($con, $query);

        header("location:" . BASEURL . "/Admin/adminNursePage.php");
    } else {
        header("location:" . BASEURL . "/Admin/adminUsersPage.php?click=addNurse&nic=" . $nic);
    }
} else if (isset($_POST['cancel'])) {
    header("location: " . BASEURL . "/Admin/adminNursePage.php");
}
