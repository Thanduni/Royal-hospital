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

            $result_2 = mysqli_query($con, $query);

            $row = $result_2->fetch_assoc();

            $_SESSION['name'] = $row['name'];

            header("location:adminDash.php");
        } else {

            header("location:login.php?Invalid=Incorrect login credentials i.e. email or password!");
        }
    }
} else {

    die("not working");
}
