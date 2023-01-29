
<?php
$page = 'report';
include '../Components/nurseSidebar.php';
include '../Components/nursetopbar.php';
require_once("../conf/config.php")
// include 'connect.php';
?>
<style>
    <?php include '../css/nurseStyle.css';
    ?>
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Report</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>
<body>
    <div class="main-container">
    
        <!-- <button ><a href="reportForm.php">
            Add report</a>
        </button> -->
        <!-- <a href="#" class="button" id="button">Add Report</a> -->


        <!-- <button class="button" id="button">Add Report</button>
        <script>
            document.getElementById("button").addEventListener("click", function(){
            document.querySelector(".popup").style.display = "flex";
        })
        </script> -->

        <div class="table-container">
            <table class="table">
                <thead>    
                    
                    <th>patient ID</th>
                    <th>Name</th>
                    <th>room No</th>
                </thead>

                <tbody>

            <?php
$sql="select patientID,roomNo from `admission`";
$result=mysqli_query($con,$sql);

if($result){
    while($row=mysqli_fetch_assoc($result)){
        $patientID = $row['patientID'];
        $name =  $row['name'];
        $RoomNo = $row['roomNo'];
        echo '<tr>
        <th scope="row">'.$patientID.'</th>
        <td>'.$name.'</td>
        <td>'.$RoomNo.'</td>
        <td> <button class="button" id="report-button"><a href="dailyReport.php?reportid='.$patientID.' &name='.$name.'">
        View
    </button></td>

    </tr>';
    }
}
    ?>    
               </tbody>
            
            </table>
        </div>
    </div>

    <!-- <div class="form-container"> -->
        
    <!-- <div class="popup">
        <div class="popup-content">
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
                    <label>Temperature</label>
                    <input type="number" class="form-control" placeholder="" name="temperature">
            </div>
            <div class="form-group">
                    <label>Blood Preasure</label>
                    <input type="number" class="form-control" placeholder="" name="temperature">
            </div>
            <div class="form-group">
                    <label>O2 Saturation</label>
                    <input type="number" class="form-control" placeholder="" name="temperature">
            </div>
                
            
            <button type="submit" name ="submit">Submit</button>
        </div>
    </div> -->
    <!-- </div> -->

</body>
</html>