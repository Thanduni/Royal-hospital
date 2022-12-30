<?php session_start(); ?>
<?php
$page = 'display';
include 'include/sidebar.php';
include 'include/topbar.php';

?>

<?php
include 'connect.php';
if(isset($_POST['submit'])){
    $name =  $_POST['name'];
    $RoomNo = $_POST['roomNo'];
    $admit_date = $_POST['admit_date'];
    $admit_time = $_POST['admit_time'];
    $emergency_contact_num = $_POST['emergency_contact_num'];

    $sql="INSERT INTO admission(name,roomNo,admit_time,admit_date,emergency_contact_num) values('$name','$RoomNo','$admit_time','$admit_date','$emergency_contact_num');";

    $result=mysqli_query($con,$sql);

    if($result){
        // echo "Date inserted successfully";
        header('location:display.php');
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
 
</head>
<body>

    <div class="main-container">
        
        <!-- <button class="button" id="button"><a href="admissionForm.php">
            New admission</a>
        </button> -->

        <button class="button" id="admission-button">
            New Admission
        </button>

        <script>
            document.getElementById("admission-button").addEventListener("click", function(){
                document.querySelector("#admission-popup").style.display = "flex";
            // document.querySelector(".popup").style.display = "flex";
        })

        </script>

        <div class="table-container">
            <table class="table">
                <thead>    
                    <th>Name</th>
                    <!-- <th>patientID</th> -->
                    <th>roomNo</th>
                    <th>admit date</th>
                    <th>admit time</th>
                    <th>Emergency No</th>
                    <th>           </th>
                </thead>

                <tbody>

            <?php
$sql="select * from `admission`";
$result=mysqli_query($con,$sql);

if($result){
    while($row=mysqli_fetch_assoc($result)){
        $name =  $row['name'];
        // $patientID = $row['patientID'];
        $RoomNo = $row['roomNo'];
        $admit_date = $row['admit_date'];
        $admit_time = $row['admit_time'];
        $emergency_contact_num = $row['emergency_contact_num'];
        echo '<tr>
        <th scope="row">'.$name.'</th>
        
        <td>'.$RoomNo.'</td>
        <td>'.$admit_date.'</td>
        <td>'.$admit_time.'</td>
        <td>'.$emergency_contact_num.'</td>
        
    </tr>';
    }
}
    ?>    
<!-- <td> <button class="button" id="report-button"><a href="dailyReport.php">
        Go to Patient
    </button></td> -->
            </tbody>
            
        </table>
        </div>
    </div>

    <div class="popup" id="admission-popup">
        <div class="popup-content">
        <form method="post">
            <h1>Admission Form</h1>
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" placeholder="Enter name" name="name" required>
            </div>
            <div class="form-group">
                <label>Room No</label>
                <input type="text" class="form-control" placeholder="Enter room No" name="roomNo" required>
            </div>
            <div class="form-group">
                <label>Admit date</label>
                <input type="date" class="form-control" placeholder="" name="admit_date" required>
            </div>
            <div class="form-group">
                <label>Admit time</label>
                <input type="time" class="form-control" placeholder="" name="admit_time" required>
            </div>
            <div class="form-group">
                <label>Emergency contact</label>
                <input type="text" class="form-control" placeholder="" name="emergency_contact_num" required>
            </div>
            <button type="submit" name ="submit">Submit</button>
        </form>
        </div>
    </div>

    <!-- <div class="popup" id="report-popup">
        <div class="popup-content">
            <h1>Daily Report</h1>
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" placeholder="Enter name" name="name" required>
            </div>
            <div class="form-group">
                <label>Room No</label>
                <input type="text" class="form-control" placeholder="Enter room No" name="roomNo" required>
            </div>
            <div class="form-group">
                <label>Admit date</label>
                <input type="date" class="form-control" placeholder="" name="admit_date" required>
            </div>
            <div class="form-group">
                <label>Admit time</label>
                <input type="time" class="form-control" placeholder="" name="admit_time" required>
            </div>
            <div class="form-group">
                <label>Emergency contact</label>
                <input type="text" class="form-control" placeholder="" name="emergency_contact_num" required>
            </div>
            <button type="submit" name ="submit">Submit</button>
        </div>
    </div> -->
</body>
</html>