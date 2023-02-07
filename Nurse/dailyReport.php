<?php
session_start();
//die( $_SESSION['profilePic']);
require_once("../conf/config.php");
if (isset($_SESSION['mailaddress']) && $_SESSION['userRole'] == 'Nurse') {
    ?>

<?php
if(isset($_GET['patientid'])){
    $patientID = $_GET['patientid'];
    $patientName = $_GET['name'];
}
?>

<?php
if(isset($_POST['submit'])){
    $date =  $_POST['date'];
    $time = $_POST['time'];
    $pulse = $_POST['pulse'];
    $temperature = $_POST['temperature'];
    $blood_preasure = $_POST['blood_preasure'];
    $o2_saturation = $_POST['o2_saturation'];

    $sql="INSERT INTO daily_report(date,time,pulse,temperature,blood_preasure,o2_saturation,patientID) values('$date','$time','$pulse','$temperature','$blood_preasure','$o2_saturation','$patientID');";

    $result=mysqli_query($con,$sql);

    if($result){
        
        header('location:dailyReport.php?patientid='.$patientID.'&name='.$patientName);
    }else{
        die(mysqli_error($con));
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/style.css' ?>">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/nurseStyle.css' ?>">
    <style>
        .next {
            position: initial;
            height: auto;
        }
    </style> 
    <title>Daily Report</title>
</head>
<body>
    <div class="user">
        <?php include(BASEURL . '/Components/nurseSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $_SESSION['name']); ?>
        <div class="userContents" id="center">
            <div class="title">
                <img src="<?php echo BASEURL . '/images/logo5.png' ?>" alt="logo">
                Royal Hospital Management System
            </div>
            <ul>
                <li class="userType"><img src=<?php echo BASEURL . '/images/userInPage.svg' ?> alt="nurse">
                    Nurse
                </li>
                <li class="logout"><a href="<?php echo BASEURL . '/Homepage/logout.php?logout' ?>">Logout
                        <img
                                src=<?php echo BASEURL . '/images/logout.jpg' ?> alt="logout"></a>
                </li>
            </ul>
            <div class="arrow">
                <img src=<?php echo BASEURL . '/images/arrow-right-circle.svg' ?> alt="arrow">daily Report
            </div>

            <div class="main-container">
                <div class="patient-details">
                    <div class="patient-name">Patient Name: <?php
                                                                // $patientName =  $patientName;
                                                                echo $patientName ?>  </div>
                    <div class="patient-id">Patient ID: <?php 
                                                                // $patientID = $patientID;
                                                                echo $patientID?></div>
                </div>
                <div class="table-container">
                    <h2>Vital Signs</h2>
                    <button class="button" id="dailyreportbutton">
                        New entry
                    </button>
                    <table class="table">
                        <thead>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Temperature</th>
                            <th>Pulse</th>
                            <th>Blood Preasure</th>
                            <th>O2 Saturation</th>
                        </thead>
                        <tbody>

                            <?php
                                $sql="select patientID,date,time,pulse,temperature,blood_preasure,o2_saturation from daily_report where patientID = '$patientID'";
                                $result = $con -> query($sql);
                                $rows = $result->num_rows; 

                                if($result){
                                    while($row=$result->fetch_assoc()){
                                        $date =  $row['date'];
                                        $time =  $row['time'];
                                        $pulse = $row['pulse'];
                                        $temperature = $row['temperature'];
                                        $blood_preasure = $row['blood_preasure'];
                                        $o2_saturation = $row['o2_saturation'];
                                        echo '<tr>
                                        <td>'.$date.'</td>
                                        <td>'.$time.'</td>
                                        <td>'.$pulse.'</td>
                                        <td>'.$temperature.'</td>
                                        <td>'.$blood_preasure.'</td>
                                        <td>'.$o2_saturation.'</td>
        
                                    </tr>';
                                    }
                                }
                            ?> 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
 
    <div class="popup" id="report-popup">
        <div class="popup-content">
        <img src="../images/close.png" alt="close" class="close">
        <form method="post">
            <h1>Daily Report</h1>
            
            <div class="form-group">
                    <label>Date</label>
                    <input type="date" name="date" value ="<?php echo date('Y-m-d') ?>">
                    <!-- <input type="date" class="form-control" placeholder="" name="date" required> -->
            </div>
            <div class="form-group">
                    <label>Time</label>
                    <input type="time" id="time" name="time" required>
                    <!-- <input type="time" class="form-control" placeholder="" name="time" required> -->
            </div>
            <div class="form-group">
                    <label>Pulse</label>
                    <input type="number" class="form-control" placeholder="" name="pulse">
            </div>
            <div class="form-group">
                    <label>Temperature</label>
                    <input type="number" class="form-control" placeholder="" name="temperature">
            </div>
            <div class="form-group">
                    <label>Blood Preasure</label>
                    <input type="number" class="form-control" placeholder="" name="blood_preasure">
            </div>
            <div class="form-group">
                    <label>O2 Saturation</label>
                    <input type="number" class="form-control" placeholder="" name="o2_saturation">
            </div>
            <button type="submit" name ="submit">Submit</button>
        </form> 
        </div>
    </div>

<script>

    let objectDate = new Date();

    var time = objectDate.toLocaleTimeString([], {
        hourCycle: 'h24',
        hour: '2-digit',
        minute: '2-digit'
    });
    document.getElementById('time').value = time;
    document.getElementById("dailyreportbutton").addEventListener("click", function(){
        document.querySelector(".popup").style.display = "flex";
    })
    document.querySelector(".close").addEventListener("click", function(){
        document.querySelector(".popup").style.display = "none";
    })
</script>

</body>
</html>
<?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>