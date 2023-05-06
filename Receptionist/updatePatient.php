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
    $contactNum = $_POST['contactNum'];
    $gender = $_POST['gender'];
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
    $email = $_SESSION['mailaddress'];

    $query = "UPDATE user SET name = '$name', address = '$address', contact_num = '$contactNum', gender = '$gender', profile_image = '$profile_image', DOB = '$dob' WHERE email = '$email';";
    $result = mysqli_query($con, $query);


    $patientIdQuery = "Select patientID from patient where nic='$nic'";
    $patientID = mysqli_fetch_assoc(mysqli_query($con, $patientIdQuery))['patientID'];

    $query = "UPDATE `patient` SET`weight`='$weight',`receptionistID`='$receptionistID',`patient_type`='Outpatient',`height`='$height',`illness`='$illness'
    ,`drug_allergies`='$drugAllergies',`medical_history_comments`='$medHisCom',`currently_using_medicine`='$curUsingMed',`emergency_contact`='$emerCon' WHERE `patientID`='$patientID'";
    $result = mysqli_query($con, $query);

    if($nic == $_SESSION['nic']){
        $_SESSION['name'] = $name;
        $_SESSION['profilePic'] = $profile_image;
    }

    header("location:" . BASEURL . "/Receptionist/patientPage.php");
} else if (isset($_POST['cancel'])) {
    header("location:" . BASEURL . "/Receptionist/patientPage.php");
}

?>