<?php
// $page = 'daily-report';
include 'include/sidebar.php';
include 'include/topbar.php';

require_once 'connect.php';
if(isset($_GET['reportid'])){
    $patientID = $_GET['reportid'];
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
        
        header('location:dailyReport.php?reportid ='.$patientID);
    }else{
        die(mysqli_error($con));
    }
}

?>

<style>
    <?php include 'style.css';
    ?>
</style>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="main-container">
        <div class="patient-details">
            <div class="patient-name">Patient Name: <?php echo $patientName ?>  </div>
            <div class="patient-id">Patient ID: <?php echo $patientID ?></div>
        </div>
        <div class="table-container">
            <h2>Vital Signs</h2>
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
// die($sql);
// $result=mysqli_query($con,$sql);
$result = $con -> query($sql);
$rows = $result->num_rows; 

if($result){
//     die("fgdhgasjd");
// for($j=0; $j<$rows; $j++){
//     $result = data_seek($j);
//     $row = $result -> fetch_array(MYSQLI_NUM);
//     $date = $row[0];
//     die($date);
//     $Time = $row[1];
//     $temperature = $row[2];
//     $pulse = $row[3];
//     $blood_preasure = $row[4];
//     $o2_saturation = $row[5];
//     echo '<tr>
//         <th scope="row">'.$date.'</th>
//         <td>'.$time.'</td>
//         <td>'.$pulse.'</td>
//         <td>'.$temperature.'</td>
//         <td>'.$blood_preasure.'</td>
//         <td>'.$o2_saturation.'</td>
        
//     </tr>';
// }
    while($row=$result->fetch_assoc()){
        $date =  $row['date'];
        $time =  $row['time'];
        $pulse = $row['pulse'];
        $temperature = $row['temperature'];
        $blood_preasure = $row['blood_preasure'];
        $o2_saturation = $row['o2_saturation'];
        echo '<tr>
        <th scope="row">'.$date.'</th>
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
            <button class="button" id="report-button">
            New entry
            </button>

        <script>
            document.getElementById("report-button").addEventListener("click", function(){
            document.querySelector("#report-popup").style.display = "flex";
        })
        </script>
        
        </div>
    </div>
    
    <div class="popup" id="report-popup">
        <div class="popup-content">
        <form method="post">
            <h1>Daily Report</h1>
            
            <div class="form-group">
                    <label>Date</label>
                    <input type="date" class="form-control" placeholder="" name="date" required>
            </div>
            <div class="form-group">
                    <label>Time</label>
                    <input type="time" class="form-control" placeholder="" name="time" required>
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



</body>
</html>