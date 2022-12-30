<?php session_start(); ?>
<?php
include 'connect.php';
if(isset($_POST['submit'])){
    $roomNo =  $_POST['roomNo'];
    $room_availability = $_POST['room_availability'];

    $sql="INSERT INTO room(room_no,room_availability) values('$roomNo','$room_availability')";

    $result=mysqli_query($con,$sql);

    if($result){
        echo "Date inserted successfully";
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
    <title>Room</title>
</head>
<body>
    <div class="container">
        <form method="post">
            <div class="form-group">
                <label>Room No</label>
                <input type="text" class="form-control" placeholder="Enter room no" name="roomNo">
            </div>
            <div class="form-group">
                <label>Room availability</label>
                <input type="text" class="form-control" placeholder="Enter patient ID" name="room_availability">
            </div>
            
            <button type="submit" name ="submit">Submit</button>
        </form>
    </div>
    
</body>
</html>