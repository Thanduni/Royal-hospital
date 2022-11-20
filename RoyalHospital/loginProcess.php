<?php
require_once("DBconnect.php");
session_start();

//$_SESSION['mailaddress'] = "nareash";
//header("location:adminDash.php");
//exit(0);

if (isset($_POST['login'])) {
    if (empty($_POST["email"]) || empty($_POST["password"])) {
        header("location:login.php?Empty=Please fill in the blanks");
    } else {
        $query = $con -> prepare("select name, email, password, user_role, profile_image from user where email=?;");
        $query -> bind_param("s", $_POST["email"]);
        $query->execute();
        $query->store_result();
        $query ->bind_result($name, $email,$password, $userRole, $profilePic);

        if ($query -> num_rows == 1) {
            $pass = $_POST['password'];

            $query -> fetch();

            if (password_verify($pass, $password)) {

                $_SESSION['name'] = $name;
                $_SESSION['profilePic'] = $profilePic;
                if ($userRole == "Admin")
                    header("location:adminDash.php");
                else if ($userRole == "Doctor")
                    header("location:doctorDash.php");
                else if ($userRole == "Nurse")
                    header("location:nurseDash.php");
                else if ($userRole == "Receptionist")
                    header("location:receptionistDash.php");
                else if ($userRole == "Patient")
                    header("location:adminDash.php");
                else if ($userRole == "Storekeeper")
                    header("location:storekeeperDash.php");
                $_SESSION['mailaddress'] = $_POST["email"];
            } else {
                header("location:login.php?Invalid=Incorrect login credentials i.e. email or password!");
            }
        } else {
            header("location:login.php?Invalid=Incorrect login credentials i.e. email or password!");
        }
    }
} else {
    die("not working");
}

