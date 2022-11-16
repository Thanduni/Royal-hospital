<?php
require_once("DBconnect.php");
session_start();

if (isset($_POST['login'])) {
    if (empty($_POST["email"]) || empty($_POST["password"])) {

        header("location:login.php?Empty=Please fill in the blanks");
    } else {
        $query = "select * from user where email='" . $_POST["email"] . "' and password='" . $_POST['password'] . "'";

        $result = mysqli_query($con, $query);

        if (mysqli_fetch_assoc($result)) {
            $_SESSION['mailaddress'] = $_POST["email"];

            $query_2 =  "select name from user where email='" . $_POST["email"] . "' and password='" . $_POST['password'] . "'";

            $result_2 = mysqli_query($con, $query_2);

            $query_3 = "select user_role from user where email='" . $_POST["email"] . "' and password='" . $_POST['password'] . "'";

            $result_3 = mysqli_query($con, $query_3);

            $row_3 = $result_3->fetch_assoc();

            $row_1 = $result_2->fetch_assoc();

            $_SESSION['name'] = $row_1['name'];

            if($row_3['user_role'] == "Admin")
                header("location:adminDash.php");
            else if($row_3['user_role'] == "Doctor")
                header("location:doctorDash.php");
            else if($row_3['user_role'] == "Nurse")
                header("location:nurseDash.php");
            else if($row_3['user_role'] == "Receptionist")
                header("location:receptionistDash.php");
            else if($row_3['user_role'] == "Patient")
                header("location:patientDash.php");
            else if($row_3['user_role'] == "Storekeeper")
                header("location:storekeeperDash.php");
        } else {

            header("location:login.php?Invalid=Incorrect login credentials i.e. email or password!");
        }
    }
} else {

    die("not working");
}
