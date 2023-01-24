<?php
require_once("../conf/config.php");

if (isset($_POST['addStorekeeper'])) {
    $nic = $_POST['nic'];
    $query = "Select count(*) from user where nic = " . $nic . " and user_role='Storekeeper'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row['count(*)']) {

        $query = "INSERT INTO storekeeper(nic) VALUES ('$nic');";
        $result = mysqli_query($con, $query);

        header("location:" . BASEURL . "/Admin/adminStorekeeperPage.php");
    } else {
        header("location:" . BASEURL . "/Admin/adminUsersPage.php?click=addStorekeeper&nic=" . $nic);
    }
} else if (isset($_POST['cancel'])) {
    header("location: " . BASEURL . "/Admin/adminStorekeeperPage.php");
}
