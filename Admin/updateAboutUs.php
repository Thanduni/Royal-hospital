<?php
session_start();

require_once("../conf/config.php");

if (isset($_POST['aboutUsInfo'])) {
    if (empty($_POST["aboutUs"])) {
        header("location:" . BASEURL . "/Admin/noticeboardAboutUsEdit.php?Empty=Please fill in the blanks");
    } else {

        $content = $_POST['aboutUs'];

        $query = "UPDATE `aboutusinfo` SET `aboutus`='".$content."' WHERE 1";
        $result = mysqli_query($con, $query);

        if($result)
            header("location:" . BASEURL . "/Admin/noticeboardAboutUsEdit.php?result=About us updated successfully!");


    }
}

?>