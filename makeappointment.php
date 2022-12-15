<?php
require_once("DBconnect.php");

if(isset($_POST["email"])){
    $email = $_POST['email'];
    $date = $_POST['date'];
    $department = $_POST['department'];
    $doctor = $_POST["doctor"];
    $msg = $_POST['msg'];

    $dnic = "SELECT `nic` FROM `user` WHERE user_role = 'doctor' && name = '$doctor'";
    $pnic = "SELECT `nic` FROM `user` WHERE user_role = 'patient' && email = '$email'";
    $docid = "SELECT `doctorID` FROM `doctor` WHERE nic='$dnic'";
    $pid = "SELECT patientID FROM patient WHERE nic='$pnic'";
    $query = "INSERT INTO `appointment`(`appointmentID`, `date`, `venue`, `doctorID`, `patientID`, `department`, `message`,`time`,`status`)VALUES('','$date','---','$docid','$pid','$department','$msg','---','---')" ;

    $result = mysqli_query($con,$query);
    if($query){echo "Query is successful";}

    else {echo "Qyery failed";
        echo $result;
        echo $query; }
    header('location:./patient/patientdash.php');
    

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link rel="stylesheet" href="./css1/appointment.css">
    <script src="./js/appointment.js"></script>
    
    <title>MakeAppointment</title>
</head>
<body>
    <section class="header">
    <nav>
        <a href="index.php">
            <p><img src="images/logo5.png" alt="logo" align="middle">
                Royal Hospital Management System
            </p>
        </a>
        <div class="nav-links">
            <ul>
                <li><a href=""> Home </a></li>
                <li><a href=""> About us </a></li>
                <li><a href="../makeappointment.php"> Appointment </a></li>
                <li><a href=""> Register patient </a></li>
                <li><a href="login.php"> Login </a></li>
            </ul>
        </div>
    </nav>

    <div class="heading">
        <h3>Make an Appointment</h3>
    </div>
    <div class="Form">
        <form action=" " method="post">
            <br><br>
            <label for="">Email</label><br><br>
            <input type="email" name="email" id="email" placeholder="eg:- kumarsanga84@gmail.com"><br><br>
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
            <textarea name="msg" id="msg" cols="30" rows="50" placeholder="Your Message To The Doctor"></textarea>
            <!-- <br><br><input type="submit" value="Submit" id="btn" name="btn" class="btn"> -->
            <button type="submit" name="submit" id="btn" value="submit" onclick="">Submit</button>
        </form> 
        
    </div>

    <!-- <div class="footer">
    <?php include"./component/footer.php" ?>
    </div> -->
    </section>
</body>
</html>

