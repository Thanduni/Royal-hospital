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
    <script src="<?php echo BASEURL. '/js/getDocDetails.js'; ?>"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="<?php echo BASEURL .'/css/appoinment.css';?>">
    <link rel="stylesheet" href="<?php echo BASEURL.'/css/patientAppointment.css' ?>">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <title>Patient Dashboard</title>
    <style>
        body{
            background-color: #f9f8ff;
        }
        .field{
            margin: 20px;
        }
    </style>
</head>
<body>
    <div class="user">

        <?php
        $nic = $_SESSION['nic'];
        $pid_query = "SELECT patientID FROM patient WHERE nic = '$nic'";
        $result_pid = mysqli_query($con, $pid_query);
        $pid = mysqli_fetch_assoc($result_pid)['patientID'];
        
        $result_h = "select height from patient where patientID =  $pid";
        $result_w = "select weight from patient where patientID =  $pid";
        $result_b = "select blood from patient where patientID =  $pid";
        // die($result);
        $h = mysqli_fetch_assoc( mysqli_query($con,$result_h))['height'];
        $w = mysqli_fetch_assoc( mysqli_query($con,$result_w))['weight'];
        $b = mysqli_fetch_assoc( mysqli_query($con,$result_b))['blood'];
       
        $GLOBALS['height'] = $GLOBALS['h'];
        $GLOBALS['weight'] = $GLOBALS['w'];
        $GLOBALS['blood'] = $GLOBALS['b'];
        
        // mysqli_fetch_assoc( mysqli_query($con,$result))['height'];
        // mysqli_fetch_assoc( mysqli_query($con,$result))['height'];
        

        $name = urlencode( $_SESSION['name']);
        include(BASEURL.'/Components/PatientSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name); ?>
        
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

            <div class="cards">
                <h3 style="color: var(--primary-color);display: flex;margin-top: -18px;font-size: large;margin-left: -10px;flex-wrap: wrap;width: 0px;height: 10px;">Dashboard</h3>
            <a href="">
                <div class="card">
                    <div class="card-content"></div>
                    <div class="card-name">Summary</div>
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
            <a id=open target="_self" style="cursor:pointer">
                <div class="card">
                    <div class="card-content"></div>
                    <div class="card-name">Appointment</div>
                    <div class="icon-box">
                    <i class="far fa-calendar-alt"></i>
                </div>
                </div>
            </a>
            <a href="<?php echo BASEURL.'/Patient/payment.php' ?>">
                <div class="card">
                    <div class="card-content"></div>
                    <div class="card-name">Pay Now</div>
                    <div class="icon-box">
                    <i class="fas fa-money"></i>
                </div>
                </div>
            </a>
            </div>
            <div class="pcontent">
                <div class="height">
                    <div class="val"><?php echo  $height; ?> </div>
                    <div class="h-icon"><img src="<?php echo BASEURL.'/images/height.avif';?>" alt="">
                    <div class="ce"><a>Height</a></div>
                </div>
                </div>
                <div class="weight">
                    <div class="val"><?php echo  $weight; ?> </div>
                    <div class="w-icon"><img src="<?php echo BASEURL.'/images/weight.avif';?>" alt="">
                    <div class="ce"><a>Weight</a> </div>
                </div>
                </div>
                <div class="pulse">
                    <div class="val"><?php echo  $blood; ?> </div>
                    <div class="p-icon"><img src="<?php echo BASEURL.'/images/pulse.avif';?>" alt="">
                    <div class="ce"><a>Blood</a> </div>
                </div>
                </div>
            </div>
            

            <div class="wrapper_p">
            <div class="table_header"><h3 style="color: var(--primary-color);">Confirmed Appointments</h3></div></br>
            <div class="table">
                <div class="row headerT">
                    <div class="cell">Date</div>
                    <div class="cell">Time</div>
                    <div class="cell">Venue</div>
                    <div class="cell">Doctor</div>
                    <div class="cell">Options</div>
                </div>

<?php

        $patientIdQuery = "select patientID from patient where nic = '" . $_SESSION['nic'] . "'";
        $result = mysqli_query($con, $patientIdQuery);
        $pID = mysqli_fetch_assoc($result)['patientID'];

                        $query = "SELECT appointment.date, appointment.message, doctor.department, appointment.time, appointment.venue, user.name, appointment.doctorID, appointment.appointmentID 
                            FROM appointment join doctor on appointment.doctorID=doctor.doctorID join user on user.nic=doctor.nic WHERE patientID = $pID";
                        $result = mysqli_query($con, $query);
                        while($rows = mysqli_fetch_assoc($result)){ ?>
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
                                            <?php echo $rows['name']; ?>
                                        </div>
                                        <div class="cell" style="100px" data-title="Options">
                                            <a href="<?php echo BASEURL . '/Patient/deleteAppointment.php?id=' . $rows['appointmentID'] ?>">
                                                <button class="operation"><img src="<?php echo BASEURL . '/images/trash.svg' ?>" alt="Delete">
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                            <ul class="tableCon">
                                <li class="<?php echo $rows['appointmentID'] ?>_tableCon"><?php echo $rows['date'] ?></li>
                                <li class="<?php echo $rows['appointmentID'] ?>_tableCon"><?php echo $rows['department'] ?></li>
                                <li class="<?php echo $rows['appointmentID'] ?>_tableCon"><?php echo $rows['name'] ?></li>
                                <li class="<?php echo $rows['appointmentID'] ?>_tableCon"><?php echo $rows['time'] ?></li>
                                <li class="<?php echo $rows['appointmentID'] ?>_tableCon"><?php echo $rows['message'] ?></li>
                            </ul>
                         <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>


    <div id="login-modal">
        <div class="modal">
            <div class="login-form">
            <h2>Put Your Appointment</h2><br>
            <form id="addForm"  action="appointment.php" method="post">

                <div class="field">
                    <label for="">Date</label><br>
                    <input type="date" name="date" id="date">
                </div>

                <div class="field">
                    <label for="">Department</label><br>
                    <select name="department" id="department">
                        <option value="">Please A Select Department</option>
                        <option value="Anesthetics">Anesthetics</option>
                        <option value="Cardiology">Cardiology</option>
                        <option value="Gastroentology">Gastroentology</option>
                    </select>
                </div>

                <div class="field" id="doctorRow">
                    <label  for="">Doctor</label><br>
                    <select name="doctor" id="doctor">
                        <option value="">Select a doctor</option>
                    </select>
                </div>

                <div class="field">
                    <label for="">Time</label><br>
                    <select name="time" id="time">
                        <option value="">Please select a time slot</option>
                    </select>
                </div>

                <div class="field">
                    <label for="">Message</label><br>
                    <textarea name="msg" id="msg" cols="30" rows="3" placeholder="Your Message To The Doctor"></textarea>
                </div>

                <button type="submit" name="cancel" id="cancel" value="cancel" class="cancel-modal">Cancel</button>
                <button type="submit" name="submit" id="btn" value="submit">Submit</button>
            </form>
            </div>
        </div>
    </div>

    <script src="<?php echo BASEURL . '/js/updateUser.js' ?>"></script>
    <script type="text/javascript">
        $(function(){
            $('#open').click(function(){
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