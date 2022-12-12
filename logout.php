<?php
session_start();
if (isset($_GET['logout'])) {
    session_destroy();
    header("location:login.php");
} else if (isset($_GET['cancel'])) {
    header("location:adminDash.php");
}
