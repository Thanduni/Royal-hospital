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

    $query = $result = mysqli_query($con, "select receptionistID from Receptionist where nic = '" . $_SESSION['nic'] . "'");
    $row = mysqli_fetch_array($result);

    $nic = $_GET['id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $contactNum = $_POST['contactNum'];
    $gender = $_POST['gender'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $userRole = 'Patient';
    $dob = $_POST['dob'];
    $profile_image = $new_img_name;

    $weight = $_POST['weight'];
    $receptionistID = $row['receptionistID'];
    $patientType = 'Outpatient';
    $height = $_POST['height'];
    $illness = $_POST['illness'];
    $drugAllergies = $_POST['drugAllergies'];
    $medHisCom = $_POST['medHisCom'];
    $curUsingMed = $_POST['curUsingMed'];
    $emerCon = $_POST['emerCon'];

    $query = "UPDATE user SET name = '$name', address = '$address', email = '$email', contact_num = '$contactNum', gender = '$gender', profile_image = '$profile_image', DOB = '$dob' WHERE nic = '$nic';";
    $result = mysqli_query($con, $query);

    $query = "UPDATE `patient` SET `weight` = '$weight', `patient_type` = '$patientType', `height` = '$height', `illness` = '$illness', `drug_allergies` = '$drugAllergies', `medical_history_comments`, = '$medHisCom', `currently_using_medicine` = '$curUsingMed', `emergency_contact`= '$emerCon') WHERE nic = '$nic';";
    $result = mysqli_query($con, $query);

    if($nic == $_SESSION['nic']){
        $_SESSION['name'] = $name;
        $_SESSION['profilePic'] = $profile_image;
        $_SESSION['mailaddress'] = $email;
    }

    header("location:" . BASEURL . "/Receptionist/patientPage.php");
} else if (isset($_POST['cancel'])) {
    header("location:" . BASEURL . "/Receptionist/patientPage.php");
}

?>