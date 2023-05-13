<?php
session_start();
require_once("../conf/config.php");
if (isset($_SESSION['mailaddress']) && $_SESSION['userRole'] == 'Nurse') {
    ?>

<?php 
if(isset($_GET['roomno'])){
    $room_no = $_GET['roomno'];
    $room_availability = $_GET['roomAvailability'];
}
?>


<!-- php code for update room -->
<?php
if(isset($_POST['updateRoom'])){
    $room_availability =  $_POST['room_availability'];
    $room_no = $_POST['room_no'];

    $sql="UPDATE room SET room_availability = '$room_availability' WHERE room_no = '$room_no';";
    $updateresult=mysqli_query($con,$sql);

    if($updateresult){
        header('location:beds.php');
    }else{
        die(mysqli_error($con));
    }
}

if(isset($_POST['deleteRoom'])){
    $delete = "DELETE from room WHERE room_no = $room_no";
    $delete_query = mysqli_query($con,$delete);

    if($delete_query){
        header("location: beds.php");
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
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/roominfo.css' ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <style>
        .custom-btn{
            color: var(--primary-color);
        }
        .user{
            height:inherit;
        }
        .next {
            position: initial;
            height: auto;
        }
    </style> 
    <title>Rooms</title>
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
                <div class="roomCard">
                    <div class="picture"><img src="../images/hospital-room.jpg" alt="hospital room"></div>
                    <div class="info">
                        
                        <div class="room-no">Room No : <?php echo $room_no?></div>
                        <div class="room-details">
                        <?php if($room_availability =='available'){
                            echo 'NOT ASIGNED';
                        }elseif($room_availability == 'not_available'){ ?>
                            <!-- get patient details -->
                            <?php
                            $sql = "SELECT ip.patientID, ip.admit_date, ip.doctorID, p.investigation, u.name as patientName from inpatient ip join user u on u.nic=ip.nic join prescription p on p.patientID=ip.patientID;";
                            // $sql="SELECT ip.patientID, ip.admit_date, ip.doctorID, p.investigation, u.name as patientName from inpatient ip join user u on u.nic=ip.nic where ip.room_no =$room_no LIMIT 1;";
                            $result=mysqli_query($con,$sql);

                            if($result){
                                $row = mysqli_fetch_assoc($result);  //mysqli_fetch_assoc return results as associative array
                                    $patientName =  $row['patientName'];
                                    $admit_date = $row['admit_date'];
                                    $patientID = $row['patientID'];
                                    $doctorID = $row['doctorID']; 
                                    $investigation = $row['investigation'];
                            }
                            ?>

                            <!-- get doctor details -->
                            <?php
                            $sql = "select name from user inner join doctor on doctor.nic= user.nic where doctorID=$doctorID;";
                            $result = mysqli_query($con,$sql);

                            if($result){
                                $row = mysqli_fetch_assoc($result);
                                $doctor_name = $row['name'];
                            }
                            ?>

                            <div class="patient-row">
                            <div class="name">Patient Name </div>:<div class="value"> <?php echo $patientName ?></div></div>
                            <div class="patient-row">
                            <div class="name">Patient ID</div>:<div class="value"> <?php echo $patientID?></div></div>
                            <div class="patient-row">
                            <div class="name">Doctor Name</div>:<div class="value"> <?php echo $doctor_name ?></div></div>
                            <div class="patient-row">
                            <div class="name">Investigation</div>:<div class="value"><?php echo $investigation?></div></div>
                            <div class="patient-row">
                            <div class="name">Admit Date</div>:<div class="value"> <?php echo $admit_date?></div></div>
                            <?php }
                            ?>
                        </div>
                        <button class="button custom-btn" id="remove-room">Remove</button>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</body>
<div class="add-rooms">
    <div class="popup" id="update-room-popup" style="display:none">
        <div class="popup-content">
            <form method="post">
                <h1>Do you want to delete this room?</h1>
                <div class="button-container">
                    <button type="submit" name ="deleteRoom" class="">Yes</button>
                    <button class="close-button "  name ="close">No</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
   document.getElementById("remove-room").addEventListener("click", function(){
        document.querySelector("#update-room-popup").style.display = "flex";
    })
    document.querySelector(".close-button").addEventListener("click", function(){
        document.querySelector("#update-room-popup").style.display = "none";
    })
</script>

</html>
<?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>