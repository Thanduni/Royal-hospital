<?php
require_once("../conf/config.php");

//  if ($con->connect_error) die($con->connect_error);
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

        $allowed_exs = array("jpg", "jpeg", "png");

        if (in_array($img_ex, $allowed_exs)) {
            $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
            $img_upload_path = '../uploads/' . $new_img_name;
            move_uploaded_file($tmp_name, $img_upload_path);
            // $sql = "INSERT INTO user(profile_image) VALUES ('$new_img_name');";
            // header("location: adminUsersPage.php");
            // if (mysqli_query($con, $sql)) die("Success");
            // else die("Fail");
        } else {
            $em = "You can't upload files of this type";
            header("location:" .BASEURL . "/Admin/adminUsersPage.php?error = $em");
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


    $query = "INSERT INTO user(nic, name, address, email, contact_num, gender, password, user_role, profile_image) VALUES ('$nic', '$name', '$address', '$email', '$contactNum', '$gender', '$password', '$userRole', '$profile_image');";
    $result = mysqli_query($con, $query);
    header("location:". BASEURL . "/Admin/adminUsersPage.php");
} else if (isset($_POST['cancel'])) {
    header("location: " .BASEURL . "/Admin/adminUsersPage.php");
}
