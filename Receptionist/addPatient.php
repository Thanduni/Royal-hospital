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

    $nic = $_POST['nic'];
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

    $query = "INSERT INTO user(nic, name, address, email, contact_num, gender, password, user_role, profile_image, DOB) VALUES
                            ('$nic', '$name', '$address', '$email', '$contactNum', '$gender', '$password', '$userRole', '$profile_image', '$dob');";
    $result = mysqli_query($con, $query);

    $query = "INSERT INTO `patient`(`nic`, `weight`, `receptionistID`, `patient_type`, `height`, `illness`, `drug_allergies`, `medical_history_comments`, `currently_using_medicine`, `emergency_contact`) VALUES
            ('$nic', '$weight', '$receptionistID', '$patientType', '$height', '$illness', '$drugAllergies', '$medHisCom', '$curUsingMed', '$emerCon');";
    $result = mysqli_query($con, $query);

//    $pid_query = "SELECT patientID FROM patient WHERE nic = '$nic'";
//    $result_pid = mysqli_query($con, $pid_query);
//    $pid = mysqli_fetch_assoc($result_pid)['patientID'];

    $nic_query = "SELECT nic FROM user WHERE user_role = 'Receptionist' or user_role = 'Admin'";
    $result_nic = mysqli_query($con, $nic_query);

    while($nic = mysqli_fetch_assoc($result_nic)['nic']){
        $query = "INSERT INTO `notification`( `nic`, `Message`, `Timestamp`) 
              VALUES ('$nic','Patient $name has been registered to the system.',CURRENT_TIMESTAMP)";
        $result = mysqli_query($con, $query);
    }

    header("location:" . BASEURL . "/Receptionist/patientPage.php");
} else if (isset($_POST['cancel'])) {
    header("location:" . BASEURL . "/Receptionist/patientPage.php");
}

?>