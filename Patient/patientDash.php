<?php
session_start();
require_once("../conf/config.php");
if(isset($_SESSION['mailaddress']) && $_SESSION['userRole'] == 'Patient'){

// if(isset($_POST["submit"])){
//     $email = $_POST['email'];
//     $date = $_POST['date'];
//     $department = $_POST['department'];
//     $doctor = mysqli
//     $msg = $_POST['msg'];

//     // $dnic = mysqli_fetch_assoc(mysqli_query($con,"SELECT `nic` FROM `user` WHERE user_role = 'doctor' and name = '.$doctor.'"));
//     // $pnic =  mysqli_fetch_assoc(mysqli_query($con,"SELECT `nic` FROM `user` WHERE user_role = 'patient' and email = '.$email.'"));
//     // $docid =  mysqli_fetch_assoc(mysqli_query($con,"SELECT `doctorID` FROM `doctor` WHERE nic='.$dnic.'"));
//     // $pid =  mysqli_fetch_assoc(mysqli_query($con,"SELECT patientID FROM patient WHERE nic='.$pnic.'"));
//     $pid = $_SESSION['patientID'];
//     $query = "INSERT INTO `appointment`(`appointmentID`,`date`, `time`,`venue`, `doctorID`,`doctor`, `department`, `patientID`,`message`, `status`)
//     VALUES('','$date','Pending','Pennding','---','$doctor','$department','$pid','$msg','Pending')" ;

//     $result = mysqli_query($con,$query);
//     if($query){echo "Query is successful";}

//     else {echo "Qyery failed";
//         echo $result;
//         echo $query; }
//     header('location:./patient/patientdash.php?pid='.$pid.'');
    

// }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASEURL.'/css/style.css';?>">
    <link rel="stylesheet" href="<?php echo BASEURL.'/css/patientDash.css';?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="<?php echo BASEURL . '/js/appoinment.js'; ?>"></script>
    <link rel="stylesheet" href="<? echo BASEURL .'/css/appoinment.css';?>">
    <link rel="stylesheet" href="<?php echo BASEURL.'/css/patientAppointment.css' ?>">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <title>Patient Dashboard</title>
    <style>
        body{
            background-color: #f9f8ff;
        }
    </style>
</head>
<body>
    <div class="user">
        <?php include(BASEURL.'/Components/PatientSidebar.php?profilePic='.$_SESSION['profilePic']."&name=".$_SESSION['name']);
        $_SESSION['plogout'] = $_SERVER['REQUEST_URI'];
        ?>
        <!-- <?php //include(BASEURL.'/Components/PatientSidebar.php?profilePic='.$_SESSION['profilePic']."&name".$_SESSION['name']); ?> -->
        <div class="userContents"  id="center">
            <div class="title">
                <img src="<?php echo BASEURL.'/images/logo5.png' ?>" alt="logo">
                Royal Hospital Management System
                
            </div>
            <ul>
                <li class="userType"><img src="<?php echo BASEURL.'/images/userInPage.svg' ?>" alt="">
                Patient
                </li>
                <li class="logout"><a href="<?php echo BASEURL.'/Homepage/logout.php?logout&url= http:/localhost:8080'.$_SERVER['REQUEST_URI'] ?>">Logout
                    <img src="<?php echo BASEURL.'/images/logout.svg' ?>" alt="logout"></a> 
                </li>
            </ul>

            <div class="cards">
            <a href="">
                <div class="card">
                    <div class="card-content"></div>
                    <div class="card-name">Download Summary</div>
                    <div class="icon-box">
                    <i class="fas fa-file-text"></i>
                </div>
                </div>
            </a>

            <a href="">
                <div class="card">
                    <div class="card-content"></div>
                    <div class="card-name">Appointment Confirmation</div>
                    <div class="icon-box">
                    <i class="fas fa-book"></i>
                </div>
                </div> 
            </a>

            <a href="">
                <div class="card">
                    <div class="card-content"></div>
                    <div class="card-name">Daily Reports</div>
                    <div class="icon-box">
                    <i class="fa fa-calendar"></i>
                </div>
                </div> 
            </a>

            <a href="">
                <div class="card">
                    <div class="card-content"></div>
                    <div class="card-name">Bill Details</div>
                    <div class="icon-box">
                    <i class="fas fa-dollar"></i>
                </div>
                </div> 
            </a> 
            </div>
        </div>
        <div class="wrapper">
            <div class="table">
                <div class="row headerT">
                    <div class="cell">Date</div>
                    <div class="cell">Time</div>
                    <div class="cell">Venue</div>
                    <div class="cell">Doctor</div>
                    <!-- <div class="cell">Status</div> -->
                </div>
            </div>
        </div>
    </div>
    <div id="login-modal">
        <div class="modal">
            <div class="login-form">
            <h2>Put Your Appointment</h2><br>
            <form  action="" method="post">
                <label for="">Date</label><br><br>
                <input type="date" name="date" id="date"><br><br>
                <label for="">Department</label><br><br>
                <select name="department" id="department">
                    <option value="">Please A Select Department</option>
                    <option value="Anesthetics">Anesthetics</option>
                    <option value="Cardiology">Cardiology</option>
                    <option value="Gastroentology">Gastroentology</option>
                </select><br><br>
                <label for="">Doctor</label><br><br>
                <select name="doctor" id="doctor">
                    <option value="">Select A Department First</option>
                </select><br><br>
                <label for="">Message</label><br><br>
                <textarea name="msg" id="msg" cols="30" rows="3" placeholder="Your Message To The Doctor"></textarea><br><br>
                <!-- <br><br><input type="submit" value="Submit" id="btn" name="btn" class="btn"> -->
               
                <button type="submit" name="cancel" id="cancel" value="cancel" class="cancel-modal">Cancel</button>
                <button type="submit" name="submit" id="btn" value="submit" onclick="">Submit</button>
            </form>
            </div>
        </div>
    </div>
    <?php include(BASEURL.'/Components/Footer.php'); ?>
    <script type="text/javascript">
        $(function(){
            $('#openform').click(function(){
                $('#login-modal').fadeIn().css("display","flex");
            });
            $('.cancel-modal').click(function(){
                $('#login-modal').fadeOut();
            });
        });
    </script>
</body>
</html>

<?php
}else{
    header('location:../Homepage/login.php');
}
?>