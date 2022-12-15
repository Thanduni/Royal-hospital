<?php include 'include/sidebar.php';
include 'include/header.php';
$page = 'dashboard';
require_once "../DBconnect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard</title>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="mcontainer">
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
        
    <div class="payment">
    <div class="tcontent">
        <div class="mtable">
            <table>
                <thead>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Venue</th>
                    <th>Doctor</th>
                    <!-- <th>Patient_ID</th> -->
                    <th>Department</th>
                    <!-- <th>Message</th> -->
                    <th>Time</th>
                    <th>status</th>
                </thead>
            </table>
            <tbody>
                <?php
                $query = "SELECT `appointmentID`, `date`, `venue`, `doctorID`, `department`, `time`, `status` FROM `appointment`";
                $result = mysqli_query($con, $query);
                if($result){
                    while($row=mysqli_fetch_assoc($result)){
                        $ID = $row['appointmentID'];
                        $date = $row['date'];
                        $venue = $row['venue'];
                        $doctor = $row['doctorID'];
                        // $patientID = $row['patientID'];
                        $department = $row['department'];
                        // $message = $row['message'];
                        $time = $row['time'];
                        $status = $row['status'];

                        echo '<tr>
                        <th scope="row">' . $ID . '</th>
                        <th>' . $date . '</th>
                        <th>' . $venue . '</th>
                        <th>' . $doctor . '</th>
                        <th>' . $department . '</th>
                        <th>'.$time.'</th>
                        <th>' . $status . '</th>
                        </tr>';
                    }
                }
                ?>
            </tbody>
        </div>
        </div>
        <a href=""><div class="pay">Pay Online<i class="fa fa-money"></i></div></a>
        <div class="card1">
            <div class="card1-content">Pulse</div>
            <div class="icon-box">
                <i class="fa fa-heartbeat"></i>
            </div>
            <div class="card-number">70 bpm</div>
            
        </div>

        <div class="card2">
            <div class="card2-content">Weigth</div>
            <div class="icon-box">
                <i class="fas fa-cash-register"></i>
            </div>
            <div class="card-number">65 kg</div>
        </div>

        <div class="card3">
            <div class="card3-content">Heigth</div>
            <div class="icon-box">
                <i class="fas fa-arrows-alt-v"></i>
            </div>
            <div class="card-number">1.7 m</div>
        </div>
    </div>

    
</div>
</body>
</html>