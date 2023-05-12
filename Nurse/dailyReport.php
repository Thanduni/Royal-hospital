<?php
session_start();
//die( $_SESSION['profilePic']);
require_once("../conf/config.php");
if (isset($_SESSION['mailaddress']) && $_SESSION['userRole'] == 'Nurse') {
    ?>

<?php
$mindate = date("Y-m-d");
$mintime = date("h:i");
if(isset($_GET['patientid'])){
    $patientID = $_GET['patientid'];
}

$get_patient_data = "SELECT user.name from user join patient on patient.nic = user.nic WHERE patientID = $patientID;";
$get_data_query = mysqli_query($con,$get_patient_data);
if($get_data_query){
    $data_row = mysqli_fetch_assoc($get_data_query);
    $patientName = $data_row['name'];
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
        header('location:dailyReport.php?patientid='.$patientID);
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
        #form-btn{
            width: 139px;
            height: 40px;
            background: var(--secondary-color);
            color: var(--primary-color);
            font-style: normal;
            font-weight: 700;
            font-family: var(--primary-font);
            font-size: 15px;
            vertical-align: middle;
            margin: 10px;
            border-style: none;
        }
    </style> 
    <title>Daily Report</title>
</head>
<body>
    <div class="user">
    <?php
        $name = urlencode( $_SESSION['name']);
        include(BASEURL . '/Components/nurseSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name); ?>
        <div class="userContents">
        <?php
            $name = urlencode( $_SESSION['name']);
            include(BASEURL.'/Components/nursetopbar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name . "&userRole=" . $_SESSION['userRole']. "&nic=" . $_SESSION['nic']);
            ?>

            <div class="main-container">
                <h3 class="nurse_heads">Vital Signs</h3>
                <div class="patient-details">
                    <div class="patient-name">Patient Name: <?php  echo $patientName ?>  </div>
                    <div class="patient-id">Patient ID: <?php echo $patientID?></div>
                </div>
                <button class="button custom-btn" id="dailyreportbutton">
                        New entry
                </button>
                <div class="table-container">
                
                    <table class="table">
                        <thead>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Temperature</th>
                            <th>Pulse</th>
                            <th>Blood Preasure</th>
                            <th>O2 Saturation</th>
                            <th>Option</th>
                        </thead>
                        <tbody>

                            <?php
                                $sql="select * from daily_report where patientID = '$patientID'";
                                $result = $con -> query($sql);
                                $rows = $result->num_rows; 

                                if($result){
                                    while($row=$result->fetch_assoc()){
                                        $date =  $row['date'];
                                        $time =  $row['time'];
                                        $pulse = $row['pulse'];
                                        $temperature = $row['temperature'];
                                        $blood_preasure = $row['blood_preasure'];
                                        $o2_saturation = $row['o2_saturation'];?>
                                        <tr>
                                            <td><?php echo $date ?></td>
                                            <td><?php echo $time ?></td>
                                            <td><?php echo $pulse ?></td>
                                            <td><?php echo $temperature ?></td>
                                            <td><?php echo $blood_preasure ?></td>
                                            <td><?php echo $o2_saturation ?></td>
                                            <td><a href="deletedailyreport.php?id=<?php echo $row['reportID']?>&patientid=<?=$patientID?>">
                                            <input type="button" name="remove" class="remove-daily-report" value="Remove"></a></td>
                                        </tr>
                                   <?php }
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
        <!-- <img src="../images/close.png" alt="close" class="close"> -->
        <form method="post">
            <h1>Daily Report</h1>
            
            <div class="form-group">
                    <label>Date</label>
                    <input type="date" name="date" value ="<?php echo date('Y-m-d') ?>" readonly>
                    <!-- <input type="date" class="form-control" placeholder="" name="date" required> -->
            </div>
            <div class="form-group">
                    <label>Time</label>
                    <input type="time" id="time" name="time" value="<?php
                     
                    date_default_timezone_set("Asia/Colombo");
                    echo date("h:i:sa");
                    ?>" required min="<?php echo $mintime?>" readonly>
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
            <button type="submit" class="close custom-btn" id="form-btn" name ="close">Close</button>
            <button type="submit" class="custom-btn" id="form-btn" name ="submit">Submit</button>
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