<?php

session_start();
require "../phpmailer/src/Exception.php";
require "../phpmailer/src/PHPMailer.php";
require "../phpmailer/src/SMTP.php";
require_once("../conf/config.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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
    $dob = $_POST['dob'];
    $profile_image = $new_img_name;

    $countUserNIC = "SELECT * FROM user WHERE nic = '$nic' ;";
    $resultCountUserNIC = mysqli_query($con, $countUserNIC);
    $num_rows_user_nic = mysqli_num_rows($resultCountUserNIC);

    if($num_rows_user_nic > 0){
        header("location:" . BASEURL . "/Admin/adminUsersPage.php?warning=The Username exists try another NIC.");
        exit();
    }

    $countUserEmail = "SELECT * FROM user WHERE email = '$email' ;";
    $resultCountUserEmail = mysqli_query($con, $countUserEmail);
    $num_rows_user_email = mysqli_num_rows($resultCountUserEmail);

    if($num_rows_user_email > 0){
        header("location:" . BASEURL . "/Admin/adminUsersPage.php?warning=The Email exists try another Email.");
        exit();
    }

    $mail = new PHPMailer();

    $mail -> isSMTP();
    $mail -> Host = "smtp.gmail.com";
    $mail -> Port = 25;
    $mail -> SMTPAuth = true;
    $mail -> SMTPSecure = 'tls';

    $mail -> Username = 'hospitalroyal56@gmail.com';
    $mail -> Password = 'usygevftzbeyiqea';

    $mail -> setFrom("hospitalroyal56@gmail.com", 'Royal hospital');
    $mail -> addAddress($email);

    $mail -> isHTML(true);
    $mail -> Subject = "Your password";
    $mail -> Body = "<p>Dear user, </p> <h3>Your password is ".$_POST['password']."<br></h3>
                    <br><br>
                    <p>With regrads,</p>
                    <b>Royal hospital.</b>";

    if(!$mail -> send()){
        header("location:" . BASEURL . "/Admin/adminUsersPage.php?warning=Invalid Email. Try another Email.");
        exit();
    }
    $mail->smtpClose();

    $query = "INSERT INTO user(nic, name, address, email, contact_num, gender, password, user_role, profile_image, DOB, otp, verify) VALUES
                            ('$nic', '$name', '$address', '$email', '$contactNum', '$gender', '$password', '$userRole', '$profile_image', '$dob',0 , '1');";
    $result = mysqli_query($con, $query);

    $nic_query = "SELECT nic FROM user WHERE user_role = 'Receptionist' or user_role = 'Admin'";
    $result_nic = mysqli_query($con, $nic_query);

    while($nicRow = mysqli_fetch_assoc($result_nic)){
        $nicRowMember = $nicRow['nic'];
        $query = "INSERT INTO `notification`( `nic`, `Message`, `Timestamp`) 
              VALUES ('$nicRowMember','$userRole $name has been registered to the system.',CURRENT_TIMESTAMP)";
        $result = mysqli_query($con, $query);
    }

    if ($userRole == "Nurse"){
        $query = "INSERT INTO nurse(nic) VALUES ('$nic');";
        $result = mysqli_query($con, $query);
        header("location:" . BASEURL . "/Admin/adminUsersPage.php?result=The user nurse added to the system successfully.");
        exit();
    }
    else if($userRole == "Receptionist"){
        $query = "INSERT INTO receptionist(nic) VALUES ('$nic');";
        $result = mysqli_query($con, $query);
        header("location:" . BASEURL . "/Admin/adminUsersPage.php?result=The user receptionist added to the system successfully.");
        exit();
    }
    else if ($userRole == "Storekeeper"){
        $query = "INSERT INTO storekeeper(nic) VALUES ('$nic');";
        $result = mysqli_query($con, $query);
        header("location:" . BASEURL . "/Admin/adminUsersPage.php?result=The user Receptionist added to the system successfully.");
        exit();
    }
    else if($userRole == "Doctor"){
        header("location:" . BASEURL . "/Admin/adminDoctorPage.php?task=insertDoctor&nic=$nic");
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