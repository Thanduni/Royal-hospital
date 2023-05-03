<?php
session_start();
require_once("../conf/config.php");

if (isset($_POST['updatePatient'])) {
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
    $email = $_POST['email'];
    $contactNum = $_POST['contactNum'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $blood = $_POST['blood'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $illness = $_POST['illness'];
    $drug_al = $_POST['Drug_al'];
    $profile_image = $new_img_name;

    

    $q = mysqli_query($con,"select patientID from patient where nic='".$_SESSION['nic']."'");
    $pid = mysqli_fetch_assoc($q)['patientID'];

    $query = mysqli_query($con, "SELECT COUNT(*) FROM user WHERE email = '".$_SESSION['mailaddress']."'");
    
    $row = mysqli_fetch_array($query);
    if(($email != $_SESSION['mailaddress'] && $row[0]>0))
        header("location:" . BASEURL . "/Patient/updatePatientProfile.php?wrongResult=The email address already exists!");

    $query1 = "UPDATE user u inner join patient p SET u.name='$name', u.address='$address', u.email='$email', u.contact_num='$contactNum', u.gender='$gender', u.profile_image='$profile_image',p.height = $height,p.weight=$weight,p.blood=$blood,p.illness=$illness,p.drug_allergies=$drug_al WHERE u.email = '" . $_SESSION['mailaddress'] . "' and p.patientID=$pid";
    $result = mysqli_query($con, $query1);

    // $res = mysqli_query($con,"update patient set height = $height,weight=$weight,blood=$blood,illness=$illness,drug_allergies=$drug_al where patientId = $pid;");

    $_SESSION['mailaddress'] = $email;
    $_SESSION['name'] = $name;
    $_SESSION['profilePic'] = $profile_image;
    if ($result)
        header("location:" . BASEURL . "/Patient/updatePatientProfile.php?correctResult=The patient profile is updated successfully!");
}

if (isset($_POST['changePassword'])){
    $query = mysqli_query($con, "SELECT password FROM user WHERE email = '".$_SESSION['mailaddress']."'");
    $row = mysqli_fetch_array($query);
    if(!password_verify($_POST['oldPassword'], $row[0])){
        header("location:" . BASEURL . "/Patient/updatePatientProfile.php?wrongResult=The old password you have entered is wrong!");
    }
    else {
        if ($_POST['newPassword'] != $_POST['confirmPassword'])
            header("location:" . BASEURL . "/Patient/updatePatientProfile.php?wrongResult=The passwords you have entered is different!");
        else{
            $hash = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
            $query = "UPDATE user SET  password='$hash' WHERE email = '" . $_SESSION['mailaddress'] . "'";
            $result = mysqli_query($con, $query);
            if($result)
                header("location:" . BASEURL . "/Patient/updatePatientProfile.php?correctResult=The password is changed successfully!");
            else
                die("fail");
        }
    }
}