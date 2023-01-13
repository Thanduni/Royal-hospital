<?php
include 'connect.php';
if(isset($_POST['submit'])){
    $name =  $_POST['name'];
    // $patientID = $_POST['patientID'];
    $RoomNo = $_POST['roomNo'];
    $admit_date = $_POST['admit_date'];
    $admit_time = $_POST['admit_time'];
    $emergency_contact_num = $_POST['emergency_contact_num'];

    $sql="INSERT INTO admission(name,roomNo,admit_time,admit_date) values('$name','$RoomNo','$admit_time','$admit_date')";

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
    <div class="form-container">
        <h1>Admission Form</h1>

        <!-- <div class="popup"> -->
            <!-- <div class="popup-content">
                <img src="" alt="">
                <input type="text">
                <input type="text">
            </div> -->
        <!-- </div> -->
        <form method="post">
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
                <input type="time" class="form-control" placeholder="" name="admit_time" value="<?=date(H:i); ?>" required>
            </div>
            <div class="form-group">
                <label>Emergency contact</label>
                <input type="text" class="form-control" placeholder="" name="emergency_contact_num" required>
            </div>
            <button type="submit" name ="submit">Submit</button>
        </form>
    </div>
    
</body>
</html>