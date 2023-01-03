<?php
session_start();
require_once("../conf/config.php");
if (isset($_GET['logout'])) {
    session_destroy();
    header("location:" . BASEURL . "/Homepage/login.php");
} else if (isset($_GET['cancel'])) {
    header("location: ".BASEURL . "/Admin/adminUsersPage.php");
}
