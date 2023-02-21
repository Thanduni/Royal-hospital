<?php
require_once("../conf/config.php");
session_start();

if (isset($_POST['login'])) {
    if (empty($_POST["email"]) || empty($_POST["password"])) {
        header("location:". BASEURL . "/Homepage/login.php?Empty=Please fill in the blanks");
    } else {
        $query = $con->prepare("select nic,name, email, password, user_role, profile_image from user where email=?;");
        $query->bind_param("s", $_POST["email"]);
        $query->execute();
        $query->store_result();
        $query->bind_result($nic, $name, $email, $password, $userRole, $profilePic);

        if ($query->num_rows == 1) {
            $pass = $_POST['password'];

            $query->fetch();
            if (password_verify($pass, $password)) {
                $_SESSION['name'] = $name;
                $_SESSION['profilePic'] = $profilePic;
                $_SESSION['mailaddress'] = $_POST["email"];
                $_SESSION['userRole'] = $userRole;
                $_SESSION['nic'] = $nic;

                
//                die($_SESSION['name']);
                if ($userRole == "Admin")
                    header("location: " . BASEURL . "/Admin/adminDash.php");
                else if ($userRole == "Doctor")
                header("location: " . BASEURL . "/Doctor/doctorDash.php");
                else if ($userRole == "Nurse")
                    header("location: " . BASEURL . "/Nurse/nursedashboard.php");
                else if ($userRole == "Receptionist")
                    header("location: " . BASEURL . "/Receptionist/receptionistDash.php");
                else if ($userRole == "Patient")
                    header("location: " . BASEURL . "/Patient/patientDash.php");
                else if ($userRole == "Storekeeper")
                    header("location: " . BASEURL . "/Storekeeper/storekeeperDash.php");

            } else {
                header("location:" . BASEURL . "/Homepage/login.php?Invalid=Incorrect login credentials i.e. email or password!");
            }
        } else {
            header("location:" . BASEURL .  "/Homepage/login.php?Invalid=Incorrect login credentials i.e. email or password!");
        }
    }
} else {
    die("not working");
}

