<?php
session_start();
require_once("../conf/config.php");

if (isset($_POST['updateReceptionist'])) {
    echo "<pre>";
    print_r($_FILES['profile_image']);
    echo "</pre>";

    $img_name = $_FILES['profile_image']['name'];
    $img_size = $_FILES['profile_image']['size'];
    $tmp_name = $_FILES['profile_image']['tmp_name'];
    $error = $_FILES['profile_image']['error'];

    if ($error === 0) {
        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);

        $allowed_exs = array("jpg", "jpeg", "png", "PNG");

        if (in_array($img_ex, $allowed_exs)) {
            $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
            $img_upload_path = '../uploads/' . $new_img_name;
            move_uploaded_file($tmp_name, $img_upload_path);
        } else {
            $em = "You can't upload files of this type";
            header("location:" . BASEURL . "/Admin/adminUsersPage.php?error = $em");
        }
    }

    $name = $_POST['name'];
    $address = $_POST['address'];
    $contactNum = $_POST['contactNum'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $profile_image = $new_img_name;

    $query = mysqli_query($con, "SELECT COUNT(*) FROM user WHERE email = '".$_SESSION['mailaddress']."'");
    $row = mysqli_fetch_array($query);

    $query = "UPDATE user SET name='$name' ,DOB='$dob' ,address='$address', contact_num='$contactNum', gender='$gender', profile_image='$profile_image' WHERE email = '" . $_SESSION['mailaddress'] . "'";
    $result = mysqli_query($con, $query);
    $_SESSION['name'] = $name;
    $_SESSION['profilePic'] = $profile_image;
    if ($result)
        header("location:" . BASEURL . "/Receptionist/updateReceptionistProfile.php?correctResult=The receptionist profile is updated successfully!");
}

if (isset($_POST['changePassword'])){
    $query = mysqli_query($con, "SELECT password FROM user WHERE email = '".$_SESSION['mailaddress']."'");
    $row = mysqli_fetch_array($query);
    if(!password_verify($_POST['oldPassword'], $row[0])){
        header("location:" . BASEURL . "/Receptionist/updateReceptionistProfile.php?wrongResult=The old password you have entered is wrong!");
    }
    else {
        if ($_POST['newPassword'] != $_POST['confirmPassword'])
            header("location:" . BASEURL . "/Receptionist/updateReceptionistProfile.php?wrongResult=The passwords you have entered is different!");
        else{
            $hash = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
            $query = "UPDATE user SET  password='$hash' WHERE email = '" . $_SESSION['mailaddress'] . "'";
            $result = mysqli_query($con, $query);
            if($result)
                header("location:" . BASEURL . "/Receptionist/updateReceptionistProfile.php?correctResult=The password is changed successfully!");
            else
                die("fail");
        }
    }
}