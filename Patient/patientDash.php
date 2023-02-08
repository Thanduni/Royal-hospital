<?php
session_start();
require_once("../conf/config.php");

if(isset($_SESSION['mailaddress']) && $_SESSION['userRole'] == 'Patient'){
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

        <?php
        $name = urlencode( $_SESSION['name']);
        include(BASEURL.'/Components/PatientSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name); ?>
        
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

            </ul>
            <div class="payment">
                <button><img src="<?php echo BASEURL.'/images/payement.svg' ?>"></img>Online Payment</button>  
            </div>
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
                    <div class="card-name">Daily Reports</div>
                    <div class="icon-box">
                    <i class="fa fa-calendar"></i>
                </div>
                </div> 
            </a>

            <a href="<?php echo BASEURL.'/Patient/billDetails.php' ?>">
                <div class="card">
                    <div class="card-content"></div>
                    <div class="card-name">Bill Details</div>
                    <div class="icon-box">
                    <i class="fas fa-dollar"></i>
                </div>
                </div> 
            </a> 
            </div>
            
            <div class="wrapper">
            <div class="table">
                <div class="row headerT">
                    <div class="cell">Date</div>
                    <div class="cell">Time</div>
                    <div class="cell">Venue</div>
                    <div class="cell">Doctor</div>
                </div>
                    <?php
                    if (isset($_POST["submit"]) or isset($_SESSION['mailaddress'])) {

                        $date = $_POST['date'];
                        $department = $_POST['department'];
                        $doctor = $_POST['doctor'];
                        $msg = $_POST['msg'];

                        $query = "SELECT appointmentID FROM appointment WHERE date = '$date' and patientID is NULL";
                        // die($query);
                        $result = mysqli_query($con, $query);
                        $row1 = mysqli_fetch_array(mysqli_query($con, $query));

                        $nic = $_SESSION['nic'];
                        $pid_query = "SELECT patientID FROM patient WHERE nic = '$nic'";
                        $result_pid = mysqli_query($con, $pid_query);
                        $pid = mysqli_fetch_array($result_pid);
                        $appID = $row1[0];

                        if ($row1) {
                            $sql = "UPDATE `appointment` SET `date`='$date',`patientID`= $pid[0] WHERE appointmentID = $appID";
                            mysqli_query($con, $sql);
                        } else {
                            echo '<script>alert("NO More Apointments!");</script>;';
                        }
                    

                        $query = "SELECT date,time,venue,doctorID FROM appointment WHERE patientID = $pid[0]";
                        // die($query);
                        $result = mysqli_query($con, $query);
                        while($rows = mysqli_fetch_assoc($result)){
                            // $dID = $rows['doctorID'];
                            // $sql = "select nic from doctor where doctorID = $dID";
                            // $res1 = mysqli_query($con, $sql);
                            // $row2 = mysqli_fetch_array($res1);
                            // $dNIC = $row2[0];
                            // $sql2 = "select name from user where nic = '$dNIC' and userRole = 'Doctor'";
                            // die($sql);
                            // $res2 = mysqli_query($con, $sql2);
                            // $row1 = mysqli_fetch_array($res2);
                            ?>     
                                    <div class="row">
                                        <div class="cell" data-title="Date">
                                            <?php echo $rows['date']; ?>
                                        </div>
                                        <div class="cell" data-title="Time">
                                        <?php echo $rows['time']; ?>
                                        </div>
                                        <div class="cell" data-title="Venue">
                                            <?php echo $rows['venue']; ?>
                                        </div>
                                        <div class="cell" data-title="Doctor">
                                            <?php echo $rows['doctorID']; ?>
                                        </div>
                                    </div> 
                         <?php
                    }
                }
                        //  header('location:./patient/patientdash.php?pid='.$pid.''); ?>
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
    <?php include(BASEURL.'/Components/Footer.php'); ?>
</body>
</html>

<?php
}else{
    header('location:../Homepage/login.php');
}
?>