<?php
session_start();
require "../phpmailer/src/Exception.php";
require "../phpmailer/src/PHPMailer.php";
require "../phpmailer/src/SMTP.php";
require_once("../conf/config.php");

//static $patientCount = 0;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exceptionsdasd;

if(isset($_POST["nic"])){
    $name = $_POST['name'];
    $nic = $_POST['nic'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $cpassword = $_POST['cpassword'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $ecn = $_POST['ecn'];
    $cmed = $_POST["cmed"];
    $allergies = $_POST['allergies'];
    $illness = $_POST['illness'];
    $oillness = $_POST['oillness'];
    $comments = $_POST['comments'];

    $ill = " ";
    foreach($illness as $ill1){
        $ill .= $ill1.",";
    }
    $ill .= $oillness.".";

    $select1 = "SELECT * FROM `user` where name='".$name."' and nic='".$nic."' and user_role ='Patient'";
    $select2 = "SELECT * FROM `user` where email='".$email."' and user_role ='Patient'";

    $result1 = $con->query($select1);
    $result2 = $con->query($select2);
    // echo "$result";

    $rows1 = $result1->num_rows;
    $rows2 = $result2->num_rows;

    if($rows1 > 0){
        $error = 'User already exists. Try another name or NIC.';
        header("location:".BASEURL."/Patient/registration.php?error=".$error);
        exit();
    } else if($rows2 > 0){
        $error = 'Try another Email.';
        header("location:".BASEURL."/Patient/registration.php?error=".$error);
        exit();
    }
    else{
        if($password != $cpassword)
        {
            $error = 'Passwords are not matched';
            header("location:".BASEURL."/Patient/registration.php?error=".$error);
            exit();
        }
        else{

            $otp = rand(100000, 999999);


            $query1 = "INSERT INTO `user`(`nic`, `name`, `address`, `email`, `contact_num`, `gender`, `password`, `user_role`, `profile_image`, `DOB`, `verify`, `otp`) VALUES 
            ('$nic','$name','$address','$email','$phone','$gender','$hash','Patient','','$dob', '0', '$otp')";
            
            $query2 = "INSERT INTO `patient`(`nic`, `patient_type`, `illness`, `drug_allergies`, `medical_history_comments`, `currently_using_medicine`, `emergency_contact`) VALUES 
            ('$nic','outpatient','$ill','$allergies','$comments','$cmed','$ecn')";
           
            $result1 = mysqli_query($con,$query1);
            $result2 = mysqli_query($con,$query2);

            $pid_query = "SELECT patientID FROM patient WHERE nic = '$nic'";
            $result_pid = mysqli_query($con, $pid_query);
            $pid = mysqli_fetch_assoc($result_pid)['patientID'];

            $nic_query = "SELECT nic FROM user WHERE user_role = 'Receptionist' or user_role = 'Admin'";
            $result_nic = mysqli_query($con, $nic_query);

            while($nic = mysqli_fetch_assoc($result_nic)['nic']){
                $query = "INSERT INTO `notification`( `nic`, `Message`, `Timestamp`) 
              VALUES ('$nic','Patient $name has been registered to the system.',CURRENT_TIMESTAMP)";
                $result = mysqli_query($con, $query);
            }

            $mail = new PHPMailer(true);

            $mail -> isSMTP();
            $mail -> Host = "smtp.gmail.com";
            $mail -> Port = 465;
            $mail -> SMTPAuth = true;
            $mail -> SMTPSecure = 'tls';

            $mail -> Username = 'hospitalroyal56@gmail.com';
            $mail -> Password = 'Royal__123';

            $mail -> setFrom("nareash20010150@gmail.com", 'OTP Verification');
            $mail -> addAddress($email);

            $mail -> isHTML(true);
            $mail -> Subject = "Your verify code";
            $mail -> Body = "<p>Dear user, </p> <h3>Your verify OTP code is $otp <br></h3>
                    <br><br>
                    <p>With regrads,</p>
                    <b>Programming with Lam</b>";

            if(!$mail -> send()){
                die("Success");
//                ?>
<!--                <script>-->
<!--                    alert("--><?php //echo "Register Failed, Invalid Email "?>//");
//                </script>
<!--                --><?php
            }else{
                die("Fail");
//                ?>
<!--                <script>-->
<!--                    alert("--><?php //echo "Register Successfully, OTP sent to " . $email ?>//");
//                    window.location.replace('verification.php');
//                </script>
//                <?php
            }
            $mail->smtpClose();
            header("location:".BASEURL."/Homepage/login.php");
        }
    }
} 
?>

<?php

if (!isset($_SESSION['mailaddress'])) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <link rel="stylesheet" href="<?php echo BASEURL.'/css/style.css' ?>">
        <link rel="stylesheet" href="<?php echo BASEURL.'/css/registration.css' ?>">

        <title>Registration</title>
    </head>
    <body>
    <section class="header">
        <?php include(BASEURL.'/Components/Navbar.php'); ?>
        <div class="advertise">
            <div class="hey">
                <p style="color: white" class="title">Registration</p>
            </div>
        </div>
    <?php
    if (@$_GET['error'] == true) {
        ?>
        <div class="alert" style="margin: 20px">
            <?php
            echo $_GET["error"];
            ?>
        </div>
        <?php } ?>
        <form action=" " method="post" onsubmit="return validateForm()" enctype="multipart/form-data" id="validateForm">
            <div class="content">
                <div class="box" style="padding-bottom: 0px">
                    <label for="">Name</label><br><br>
                    <input type="text" name="name" id="name" placeholder="eg:- S.W.A.Siriwardana"required><div id="nameDiv"></div>
                    <br><br>

                    <label>NIC(if you have not NIC please enter your guardian's NIC number)</label><br><br>
                    <input type="text" name="nic" id="nic" placeholder="eg:- 19XXXXXXXXX/99XXXXXXXV"required><div id="nicDiv"></div><br><br>

                    <label>Email</label><br><br>
                    <input type="email" name="email" id="email" placeholder="eg:- kumarsanga84@gmail.com"required><div id="emailDiv"></div><br><br>

                    <label>Password</label><br><br>
                    <input type="password" name="password" id="password" placeholder="XXXXXXXXXXX"required><div id="passwordDiv"></div><br><br>

                    <label for="">Confirm Password</label><br><br>
                    <input type="password" name="cpassword" id="cpassword" placeholder="XXXXXXXXXXX"required><div id="cpasswordDiv"></div><br><br>

                    <label for="">Phone</label><br><br>
                    <input type="text" name="phone" id="phone" placeholder="eg:- 07XXXXXXXX"><div id="phoneDiv"required></div><br><br>

                    <label for="">Date of Birth</label><br><br>
                    <input type="date"  max="<?php echo date("2005-m-d") ?>" name="dob" id="dob"required><br><br>

                    <label for="">Address</label><br><br>
                    <input type="text" name="address" id="address" placeholder="eg:- 119/1/A, Willmot Street, Colombo-07"required><br><br>

                    <label for="">Gender</label><br><br>
                    <select name="gender" id="gender"required>
                        <option value="m">Male</option>
                        <option value="f">Female</option>
                    </select><br><br>

                    <label for="">Emergency Contact Number</label><br><br>
                    <input type="text" name="ecn" id="ecn" placeholder="eg:- 07XXXXXXXX"required><br><br>
                </div>

                <div class="box">
                    <label for="">Currently Using Medicines</label><br><br>
                    <textarea name="cmed" id="cmed" cols="30" rows="3" placeholder="If you currently use any medicines please mention"></textarea><br><br>
                    <label for="">Drug Allergies</label><br><br>
                    <textarea name="allergies" id="allergies" cols="30" rows="3" placeholder="If you have any drug allergies please mention"></textarea><br><br>
                    <label for="">Illness</label><br><br>
                    <div class="illness">
                        <div class="ill">
                            <label><input type="checkbox" name="illness[]" id="illness" value="Asthma">&numsp;Asthma</label>
                            <label><input type="checkbox" name="illness[]" id="illness" value="Diarrhea">&numsp;Diarrhea</label>
                            <label><input type="checkbox" name="illness[]" id="illness" value="Gastritis ">&numsp;Gastritis</label>
                            <label><input type="checkbox" name="illness[]" id="illness" value="Mononucleosis">&numsp;Mononucleosis</label>
                            <label><input type="checkbox" name="illness[]" id="illness" value="Dysentery">&numsp;Dysentery</label>
                            <label><input type="checkbox" name="illness[]" id="illness" value="Giardiasis">&numsp;Giardiasis</label>
                            <label><input type="checkbox" name="illness[]" id="illness" value="Blood pressure">&numsp;Blood pressure</label>
                        </div>
                        <div class="ill">
                            <label><input type="checkbox" name="illness[]" id="illness" value="Cholesterol">&numsp;Cholesterol</label>
                            <label><input type="checkbox" name="illness[]" id="illness" value="Diabetes">&numsp;Diabetes</label>
                            <label><input type="checkbox" name="illness[]" id="illness" value="Nausea and Vomiting">&numsp;Nausea and Vomiting</label>
                            <label><input type="checkbox" name="illness[]" id="illness" value="Cancers">&numsp;Cancers</label>
                            <label><input type="checkbox" name="illness[]" id="illness" value="Hypertension">&numsp;Hypertension</label>
                            <label><input type="checkbox" name="illness[]" id="illness" value="Blindness">&numsp;Blindness</label>
                            <label><input type="checkbox" name="illness[]" id="illness" value="Hyperlipidemia">&numsp;Hyperlipidemia</label>

                        </div>
                    </div>

                    <label for="">Other Illness</label><br><br>
                    <textarea name="oillness" id="oillness" cols="30" rows="3" placeholder="If you have any other illness please mention"></textarea><br><br>
                    <label for="">Any Medical Comments</label><br><br>
                    <textarea name="comments" id="comments" cols="30" rows="3" placeholder="If you have any drug allergies please mention"></textarea><br><br>

                    <br><br>
                    <div style="margin: 0 auto">
                        <button style="color: var(--primary-color)" type="submit" name="btn" class="custom-btn">Submit</button>
                    </div>
                </div>

            </div>

        </form>

        <?php include(BASEURL.'/Components/Footer.php'); ?>
    </section>
    <script src="<?php echo BASEURL.'/js/registrationFormValidate.js' ?>"></script>
    </body>
    </html>


    <?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>