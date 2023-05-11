<?php
session_start();
date_default_timezone_set('Asia/Colombo');
//die( $_SESSION['profilePic']);
require_once("../conf/config.php");

if(isset($_POST['postNotice'])){
    $msg = $_POST['notice'];
    $userRoles = $_POST['roles'];
    $title = $_POST['title'];
    $nic = $_SESSION['nic'];

    if (count($userRoles) == 0){
        header("location: " . BASEURL . "/Admin/announcementPage.php?Empty=No user roles are not selected. Please select any user role.");
        exit();
    }

    $Query = "INSERT INTO announcement(nic, message, title) VALUES ('$nic', '$msg', '$title')";
    $result = mysqli_query($con, $Query);

    $announcementIdQuery = "SELECT LAST_INSERT_ID()";
    $announcementID = mysqli_fetch_assoc(mysqli_query($con, $announcementIdQuery))['LAST_INSERT_ID()'];

    foreach ($userRoles as $userRole) {
        $announcementUsersQuery = "INSERT INTO `announcementreaders`(`announcementID`, `user_role`) VALUES ('$announcementID','$userRole')";
        mysqli_query($con, $announcementUsersQuery);

        $nic_query = "SELECT nic FROM user WHERE user_role = '$userRole'";
        $result_nic = mysqli_query($con, $nic_query);

        while($nicRow = mysqli_fetch_assoc($result_nic)){
            $nicRowMember = $nicRow['nic'];
            $query = "INSERT INTO `notification`( `nic`, `Message`, `Timestamp`) 
              VALUES ('$nicRowMember','A notice had been posted.',CURRENT_TIMESTAMP)";
            $result = mysqli_query($con, $query);
        }
    }



    header("location: " . BASEURL . "/Admin/announcementPage.php?result=Notice is successfully posted.");
}