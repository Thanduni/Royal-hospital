<?php
session_start();
//die( $_SESSION['profilePic']);
require_once("../conf/config.php");
if (isset($_SESSION['mailaddress']) && $_SESSION['userRole'] == 'Doctor') {
  $nic = $_SESSION['nic'];
  $doctorID_query = "select doctorID from doctor join user on user.nic = doctor.nic where user.nic = $nic";
  $get_doctorID = mysqli_query($con,$doctorID_query);
  $row = mysqli_fetch_assoc($get_doctorID);
  $doctorID = $row["doctorID"];
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/style.css' ?>">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/doctorStyle.css' ?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
    </script>
    <script src="https://kit.fontawesome.com/04b61c29c2.js" crossorigin="anonymous"></script>
    <style>
        .next {
            position: initial;
            height: auto;
        }
    </style>   
    <title>Doctor Dashboard</title> 
</head>


<body>
    <div class="user">
      
    <?php
        $name = urlencode( $_SESSION['name']);
        include(BASEURL . '/Components/doctorSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name); ?>
        <div class="userContents" id="center">
            <?php
            $name = urlencode( $_SESSION['name']);
            include(BASEURL.'/Components/doctorTopbar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name . "&userRole=" . $_SESSION['userRole']. "&nic=" . $_SESSION['nic']);
            ?>

            <div class="doctorDashInfo">
                <div class="main-container">
                    <div class="doctor-cards">
                        <div class="doctor-card">
                            <div class="card-content">
                                <div class="number">
                                    <?php
                                    $appointment_query = "select * from appointment where doctorID= $doctorID;";
                                    $appointment_query_run = mysqli_query($con,$appointment_query);
                                    if($appointment_count =mysqli_num_rows($appointment_query_run)){
                                        echo $appointment_count;
                                    }
                                    else{
                                        echo 'No Data';
                                    }
                                    ?>
                                </div>
                                <div class="card-name">
                                    Appointments
                                </div>
                            </div>
                            <div class="icon-box">
                                <i class="fas fa-user-injured"></i>
                            </div>
                        </div>
                        <a href="inpatient.php">
                        <div class="doctor-card">
                            <div class="card-content">
                                <div class="number">
                                    <?php
                                    // $dash_patient_query = "select * from `user` where user_role = 'Patient';";
                                    $dash_patient_query = "select * from `inpatient` where doctorID = $doctorID;";
                                    $dash_patient_query_run = mysqli_query($con,$dash_patient_query);
                                    if($total_patient = mysqli_num_rows($dash_patient_query_run)){
                                        echo $total_patient ;
                                    }
                                    else{
                                        echo 'No Data';
                                    }
                                    ?>
                                </div>
                                <div class="card-name">
                                    Total Patients
                                </div>
                            </div>
                            <div class="icon-box">
                                <i class="fas fa-user-injured"></i>
                            </div>
                        </div>
                        </a>
                        <div class="doctor-card">
                            <div class="card-content">
                                <div class="number">
                                    <?php
                                    $dash_bed_query="Select * from `room` where room_availability='available';";
                                    $dash_bed_query_run = mysqli_query($con,$dash_bed_query);
                                    if($total_available_beds = mysqli_num_rows($dash_bed_query_run)){
                                        echo $total_available_beds;
                                    }
                                    else{
                                        echo 'No data';
                                    }
                                    ?>
                                </div>
                                <div class="card-name">
                                    Available Beds
                                </div>
                            </div>
                            <div class="icon-box">
                                <i class="fas fa-bed"></i>
                            </div>
                        </div>
                    </div>

                    <h3>Upcomming Appointments</h3>
                    <div class="table-container">
                        <table class="table">
                            <thead>
                            <th>Patient</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Message</th>
                            <th>Option</th>
                            </thead>
                            <tbody>
                            <?php
                            $sql="select user.profile_image,user.name,appointment.date,appointment.time,appointment.message,appointment.patientID from appointment join patient on appointment.patientID=patient.patientID join user on user.nic=patient.nic where doctorID =$doctorID; ";
                            // $sql="select user.profile_image,user.name,appointment.date,appointment.time,appointment.message,appointment.patientID from appointment join patient on appointment.patientID=patient.patientID join user on user.nic=patient.nic where doctorID =$doctorID AND appointment.date = CURDATE(); ";

                            $result=mysqli_query($con,$sql);

                            if($result){
                                while($row=mysqli_fetch_assoc($result)){
                                    $profile_image = $row['profile_image'];
                                    $name =  $row['name'];
                                    $date = $row['date'];
                                    $time = $row['time'];
                                    $message = $row['message'];
                                    $patientID= $row['patientID']; ?>
                                    <tr>
                                        <td><div class="left-cell">
                                                <?php echo "<img src='".BASEURL."/uploads/".$profile_image."'width = 40px height=40px>";?>
                                            </div>
                                            <div class="right-cell">
                                                <div class="up-cell"><?php echo $name ?></div>
                                                <div class="down-cell">id :<?php echo $patientID ?></div>
                                            </div>
                                        </td>
                                        <td><?php echo $date ?></td>
                                        <td><?php echo $time ?></td>
                                        <td><?php echo $message ?></td>

                                        <td><a href="displayPatient.php?patientid=<?=$patientID?>">
                                                <img class="view-btn-image" src="../images/eye.png "width = 40px height=40px> </a>
                                            </button></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="calendar">
                    <div class="wrapperCalender">
                        <header>
                            <p class="current-date"></p>
                            <div class="iconslr">
                                <span id="prev" class="material-symbols-rounded">chevron_left</span>
                                <span id="next" class="material-symbols-rounded">chevron_right</span>
                            </div>
                        </header>
                        <div class="calendar">
                            <ul class="weeks">
                                <li>Sun</li>
                                <li>Mon</li>
                                <li>Tue</li>
                                <li>Wed</li>
                                <li>Thu</li>
                                <li>Fri</li>
                                <li>Sat</li>
                            </ul>
                            <ul class="days"></ul>
                        </div>
                    </div>
                    <div id="appointmentCard">
                    </div>
                </div>
            </div>



        </div>
    </div>

    <script src="<?php echo BASEURL . '/js/calendar.js' ?>"></script>
</body>
</html>
<?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>
