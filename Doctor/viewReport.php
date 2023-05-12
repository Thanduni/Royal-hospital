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

<?php
if(isset($_GET['patientid'])){
    $patientID = $_GET['patientid'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/style.css' ?>">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/doctorStyle.css' ?>">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/inpatient.css' ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
    </script>
    <script src="https://kit.fontawesome.com/04b61c29c2.js" crossorigin="anonymous"></script>
    <style>
        .user{
            height:inherit;
        }
        .next {
            position: initial;
            height: auto;
        }
    </style>   
    <title>inpatients</title> 
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
            <div class="display-container">
                <div class="show-inpatients">
                    <h3>Daily Reports</h3>
                    <table class="table">
                        <thead>
                          <th>Date</th>
                          <th>Time</th>
                          <th>Pulse</th>
                          <th>Temperature</th>
                          <th>Blood Preasure</th>
                          <th>O2 Saturation</th>
                        </thead>
                        <tbody>
                            <?php 
                                $pulseNormalRange = [80,100];
                                $temperatureNormalRange = [36.5, 37.5]; // Example temperature range
                                $bloodPressureNormalRange = [80, 120]; // Example blood pressure range
                                $o2SaturationNormalRange = [95, 100]; // Example oxygen saturation range

                                $select = "SELECT * from daily_report WHERE patientID = $patientID";
                                $result = mysqli_query($con,$select);
                            
                                while($row= mysqli_fetch_array($result)){
                                    // Fetch the vital sign values from the database and assign them to variables
                                    $date = $row['date'];
                                    $time = $row['time'];
                                    $pulse = $row['pulse'];
                                    $temperature = $row['temperature'];
                                    $bloodPressure = $row['blood_preasure'];
                                    $o2Saturation = $row['o2_saturation'];

                                    // Determine the background color based on the value range
                                    $pulseColor ='';
                                    if($pulse < $pulseNormalRange[0]){
                                        $pulseColor = 'low';
                                    }else if($pulse > $pulseNormalRange[1]){
                                        $pulseColor = 'high';
                                    }
                                    $temperatureColor = '';
                                    if ($temperature < $temperatureNormalRange[0]) {
                                        $temperatureColor = 'low';
                                    } elseif ($temperature > $temperatureNormalRange[1]) {
                                        $temperatureColor = 'high';
                                    }
                                
                                    $bloodPressureColor = '';
                                    if ($bloodPressure < $bloodPressureNormalRange[0]) {
                                        $bloodPressureColor = 'low';
                                    } elseif ($bloodPressure > $bloodPressureNormalRange[1]) {
                                        $bloodPressureColor = 'high';
                                    }
                                
                                    $o2SaturationColor = '';
                                    if ($o2Saturation < $o2SaturationNormalRange[0]) {
                                        $o2SaturationColor = 'low';
                                    } elseif ($o2Saturation > $o2SaturationNormalRange[1]) {
                                        $o2SaturationColor = 'high';
                                    }
                                ?>
                                <style>
                                    .low {
                                        background-color: #b6d4fe !important;
                                        color: #000 !important;
                                    }

                                    .high {
                                        background-color: #f1aeb5 !important;
                                        color: #000 !important;
                                    }
                                </style>
                                <tr>
                                    <td><?php echo $date ?></td>
                                    <td><?php echo $time ?></td>
                                    <td class="<?php echo $pulseColor ?>"><?php echo $pulse ?></td>
                                    <td class="<?php echo $temperatureColor ?>"><?php echo $temperature ?></td>
                                    <td class="<?php echo $bloodPressureColor ?>"><?php echo $bloodPressure ?></td>
                                    <td class="<?php echo $o2SaturationColor ?>"><?php echo $o2Saturation ?></td>
                                </tr>
                                <?php
                                } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>  
</body>
</html>
<?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>
