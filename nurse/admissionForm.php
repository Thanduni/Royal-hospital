<?php
include 'connect.php';
if(isset($_POST['submit'])){
    $name =  $_POST['name'];
    $patientID = $_POST['patientID'];
    $RoomNo = $_POST['roomNo'];
    $admit_date = $_POST['admit_date'];
    $admit_time = $_POST['admit_time'];
    $emergency_contact_num = $_POST['emergency_contact_num'];

    $sql="INSERT INTO admission(name,patientID,roomNo,admit_time,admit_date,emergency_contact_num) values('$name','$patientID','$RoomNo','$admit_time','$admit_date','$emergency_contact_num')";

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
    <title>Crud Operation</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <div class="container">
        <form method="post">
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" placeholder="Enter name" name="name">
            </div>
            <div class="form-group">
                <label>Patient ID</label>
                <input type="text" class="form-control" placeholder="Enter patient ID" name="patientID">
            </div>
            <div class="form-group">
                <label>Room No</label>
                <input type="text" class="form-control" placeholder="Enter room No" name="roomNo">
            </div>
            <div class="form-group">
                <label>Admit date</label>
                <input type="date" class="form-control" placeholder="" name="admit_date">
            </div>
            <div class="form-group">
                <label>Admit time</label>
                <input type="time" class="form-control" placeholder="" name="admit_time">
            </div>
            <div class="form-group">
                <label>Emergency contact</label>
                <input type="text" class="form-control" placeholder="" name="emergency_contact_num">
            </div>
            <button type="submit" name ="submit">Submit</button>
        </form>
    </div>
    
</body>
</html>