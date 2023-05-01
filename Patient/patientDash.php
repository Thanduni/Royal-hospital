<?php
session_start();
require_once("../conf/config.php");
$_SESSION['appID_array'][] = '';
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://kit.fontawesome.com/04b61c29c2.js" crossorigin="anonymous"></script>
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

        date_default_timezone_set('Asia/Calcutta');
        
        $app_sql = "select * from appointment where date ='".date("Y-m-d")."' and patientID = '$pid' ORDER BY `appointment`.`date` DESC";
        $result_app = mysqli_query($con, $app_sql);

        date_default_timezone_set('Asia/Calcutta');
        $current_time = date("H:i:s"); 

        while($row = mysqli_fetch_assoc($result_app)) {
            $docName_sql = "select * from doctor inner join user on doctor.nic = user.nic where doctor.doctorID = '" . $row['doctorID'] . "'";
            $docName = mysqli_fetch_assoc(mysqli_query($con, $docName_sql))['name'];
            $appTime = $row['time'];

            $current_date = date('Y-m-d');
            $flag = 0;
            for ($i = 0; $i < count($_SESSION['appID_array']); $i++) {
                if ($row['appointmentID'] == $_SESSION['appID_array'][$i])
                    $flag = 1;
            }
            if ($flag == 0) {
                $_SESSION['appID_array'][] = $row['appointmentID'];
                if (!isset($_SESSION['query_executed_date']) || $_SESSION['query_executed_date'] != $current_date) {
                    $query = "INSERT INTO `notification`( `nic`, `Message`, `Timestamp`)
                          VALUES ('$nic','Today you have an appointment with the doctor $docName at $appTime.',CURRENT_TIMESTAMP)";
                    $result = mysqli_query($con, $query);
                }
            }
        }

        $name = urlencode( $_SESSION['name']);
        include(BASEURL.'/Components/PatientSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name); ?>
        
        <!-- <?php //include(BASEURL.'/Components/PatientSidebar.php?profilePic='.$_SESSION['profilePic']."&name".$_SESSION['name']); ?> -->

        <div class="userContents"  id="center">
            <?php
            include(BASEURL.'/Components/patientTopbar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name . "&userRole=" . $_SESSION['userRole']. "&nic=" . $_SESSION['nic']);
            ?>
            
            <ul>
                <li class="userType"><img src="<?php echo BASEURL.'/images/userInPage.svg' ?>" alt="">
                Patient
            </li>
            </ul>

            <div class="cards">
                <h3 style="color: var(--primary-color);display: flex;margin-top: -18px;font-size: large;margin-left: -10px;flex-wrap: wrap;width: 0px;height: 10px;">Dashboard</h3>
            <a href="<?php echo BASEURL.'/Patient/summaryreport.php' ?>">
                <div class="card">
                    <div class="card-content"></div>
                    <div class="card-name">Summary</div>
                    <div class="icon-box">
                    <i class="fas fa-file-text"></i>
                </div>
                </div>
            </a>

            <a href="<?php echo BASEURL.'/Patient/dailyreport.php' ?>">
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
            <a  id="open" target="_self" style="cursor:pointer">
                <div class="card">
                    <div class="card-content"></div>
                    <div class="card-name">Appointment</div>
                    <div class="icon-box">
                    <i class="far fa-calendar-alt"></i>
                </div>
                </div>
            </a>
            <a href="<?php echo BASEURL.'/Patient/stripe/checkout.php' ?>">
                <div class="card">
                    <div class="card-content"></div>
                    <div class="card-name">Pay Now</div>
                    <div class="icon-box">
                    <i class="fas fa-money"></i>
                </div>
                </div>
            </a>
    </div>
            <div class="mcontent">
                <div class="pcontent">
                    <div class="table_header"><h3 style="color: var(--primary-color);">Common Details</h3></div>
                    <div class="height">
                        <div class="h-icon"><img src="<?php echo BASEURL.'/images/height.png';?>" alt="">
                            <div class="ce"><a>Height</a></div>
                        </div>
                        <div class="val"><?php echo $height;echo 'cm'; ?></div>
                    </div>
                    <div class="weight">
                        <div class="w-icon"><img src="<?php echo BASEURL.'/images/weight.png';?>" alt="">
                            <div class="ce"><a>Weight</a></div>
                        </div>
                        <div class="val"><?php echo  $weight;echo 'kg'; ?></div>
                    </div>
                    <div class="pulse">
                        <div class="p-icon"><img src="<?php echo BASEURL.'/images/blood.png';?>" alt="">
                            <div class="ce"><a>Blood</a> </div>
                        </div>
                        <div class="val"><?php echo  $blood; ?></div>
                    </div>
                </div>
                    <div class="wrapper_p">
                    <div class="table_header"><h3 style="color: var(--primary-color);margin-left:125px;">Confirmed Appointments</h3></div></br>
                    <div class="table">
                        <div class="row headerT">
                            <div class="cell">Date</div>
                            <div class="cell">Time</div>
                            <div class="cell">Venue</div>
                            <div class="cell">Doctor</div>
                            <div class="cell">Message</div>
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
                                <div id ="current_date" class="cell" data-title="Date">
                                    <?php echo $rows['date']; ?>
                                </div>
                                <div id="current_time" class="cell" data-title="Time">
                                    <?php echo $rows['time']; ?>
                                </div>
                                <div class="cell" data-title="Venue">
                                    <?php echo $rows['venue']; ?>
                                </div>
                                <div class="cell" data-title="Doctor">
                                    <?php echo $rows['name']; ?>
                                </div>
                                <div class="cell" data-title="Message">
                                    <?php echo $rows['message'];?>
                                </div>
                                <div class="cell" style="" data-title="Options">
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
    </div>


    <div id="login-modal">
        <div class="modal">
            <div class="login-form">
            <h2>Put Your Appointment</h2><br>
            <form id="addForm"  action="appointment.php" method="post">

                <div class="field">
                    <label for="">Date</label><br>
                    <input type="date" name="date" id="current-date" placeholder="">
                </div>
                <script>
                    var today = new Date().toISOString().substr(0, 10);
                    document.getElementById("current-date").value = today;
                </script>
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
            $('#open-').click(function(){
                $('#login-modal').fadeIn().css("display","flex");
            });
            $('.cancel-modal').click(function(){
                $('#login-modal').fadeOut();
            });
        });
        var c_time = new Date().toLocaleTimeString();
        var c_date = new Date().toLocaleDateString();
        
        if(c_time > document.getElementById("current_time").innerHTML && document.getElementById("current_date").innerHTML < c_date)
        {
            document.getElementsByClassName("row").style.background = "#00FF00";
        }
        
    </script>
</body>
</html>

<?php
}else{
    header('location:../Homepage/login.php');
}
?>