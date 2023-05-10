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

    // Assuming you have established a database connection
    $pdo = new mysqli('localhost', 'root', '', 'royalhospital');


// Prepare the SQL statement
    $announcementQuery = $pdo->prepare("INSERT INTO announcement(nic, message, title) VALUES (?, ?, ?)");

// Bind the parameter
    $announcementQuery->bind_param('sss', $nic, $msg, $title);

// Execute the statement
    $announcementQuery->execute();

    $result = $announcementQuery->get_result();


    if (count($userRoles) == 0){
        header("location: " . BASEURL . "/Admin/announcementPage.php?Empty=No user roles are not selected. Please select any user role.");
        exit();
    }


    $announcementIdQuery = "SELECT LAST_INSERT_ID()";
    $announcementID = mysqli_fetch_assoc(mysqli_query($con, $announcementIdQuery))['LAST_INSERT_ID()'];

    foreach ($userRoles as $userRole) {
        $announcementUsersQuery = "INSERT INTO `announcementreaders`(`announcementID`, `user_role`) VALUES ('$announcementID','$userRole')";
        mysqli_query($con, $announcementUsersQuery);
    }
    header("location: " . BASEURL . "/Admin/announcementPage.php?result=Notice is successfully posted.");
}