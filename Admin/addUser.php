<?php
session_start();
require_once("../conf/config.php");

if (isset($_POST['addUser'])) {
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

    $nic = $_POST['nic'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $contactNum = $_POST['contactNum'];
    $gender = $_POST['gender'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $userRole = $_POST['userRole'];
    $profile_image = $new_img_name;

    $query = "INSERT INTO user(nic, name, address, email, contact_num, gender, password, user_role, profile_image) VALUES
                            ('$nic', '$name', '$address', '$email', '$contactNum', '$gender', '$password', '$userRole', '$profile_image');";
    $result = mysqli_query($con, $query);

    if ($userRole == "Nurse"){
        $query = "INSERT INTO nurse(nic) VALUES ('$nic');";
        $result = mysqli_query($con, $query);
        header("location:" . BASEURL . "/Admin/adminUsersPage.php");
        exit();
    }
    else if($userRole == "Receptionist"){
        $query = "INSERT INTO receptionist(nic) VALUES ('$nic');";
        $result = mysqli_query($con, $query);
        header("location:" . BASEURL . "/Admin/adminUsersPage.php");
        exit();
    }
    else if ($userRole == "Storekeeper"){
        $query = "INSERT INTO storekeeper(nic) VALUES ('$nic');";
        $result = mysqli_query($con, $query);
        header("location:" . BASEURL . "/Admin/adminUsersPage.php");
        exit();
    }
    else if($userRole == "Doctor"){
        header("location:" . BASEURL . "/Admin/adminDoctorPage.php?task=insertDoctor&nic=".$nic);
        exit();
    }


        if ($_SESSION['which_user'] == "Doctor") {
            $nic = $_SESSION['nic'];
            $department = $_SESSION['department'];
            $query = "INSERT INTO doctor(nic, department) VALUES ('$nic', '$department');";
            $result = mysqli_query($con, $query);
            unset($_SESSION['which_user']);
            header("location:" . BASEURL . "/Admin/adminDoctorPage.php");
            exit();
        }
    if ($_SESSION['which_user'] == "Nurse") {
        $nic = $_SESSION['nic'];
        $query = "INSERT INTO nurse(nic) VALUES ('$nic');";
        $result = mysqli_query($con, $query);
        unset($_SESSION['which_user']);
        header("location:" . BASEURL . "/Admin/adminNursePage.php");
        exit();
    }
    if ($_SESSION['which_user'] == "Storekeeper") {
        $nic = $_SESSION['nic'];
        $query = "INSERT INTO storekeeper(nic) VALUES ('$nic');";
        $result = mysqli_query($con, $query);
        unset($_SESSION['which_user']);
        header("location:" . BASEURL . "/Admin/adminStorekeeperPage.php");
        exit();
    }
    if ($_SESSION['which_user'] == "Receptionist") {
        $nic = $_SESSION['nic'];
        $query = "INSERT INTO receptionist(nic) VALUES ('$nic');";
        $result = mysqli_query($con, $query);
        unset($_SESSION['which_user']);
        header("location:" . BASEURL . "/Admin/adminReceptionistPage.php");
        exit();
    }
    header("location:" . BASEURL . "/Admin/adminUsersPage.php");
} else if (isset($_POST['cancel'])) {
    header("location: " . BASEURL . "/Admin/adminUsersPage.php");
}

?>