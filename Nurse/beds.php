<?php
session_start();
//die( $_SESSION['profilePic']);
require_once("../conf/config.php");
if (isset($_SESSION['mailaddress']) && $_SESSION['userRole'] == 'Nurse') {
    ?>
<?php 
    $query ="SELECT room_no FROM room";
    $result = $con->query($query);
    if($result->num_rows> 0){
      $options= mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
?>

<!-- php code for add room -->
<?php
if(isset($_POST['addRoom'])){

    $sql = "INSERT INTo room(room_availability) VALUES('available');";
    $addresult=mysqli_query($con,$sql);

    if($addresult){
        header('location:beds.php');
    }else{
        die(mysqli_error($con));
    }
}
?>

<?php
$sql = "select room_no,room_availability from `room`";
$result = mysqli_query($con,$sql);

while(true){
    $row = mysqli_fetch_assoc($result);
    $roomNo = isset($cOTLdata['room_no']) ? $row['room_no'] : 0;
    $availability = isset($cOTLdata['room_availability']) ? $row['room_availability'] : 0;
    if(!$row){
        break;
    }
    $rows[] = $row;
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/style.css' ?>">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/nurseStyle.css' ?>">
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
                <h3 class="nurse_heads">Room List</h3>
                <button class="bed-button custom-btn" id="add-room">Add Room</button>
                <div class="room-cards">                    
                    <?php foreach ($rows as $row):?>
                        <?php $room_no = $row['room_no'];
                        $room_availability = $row['room_availability']; ?>
                    <a href="roominfo.php?roomno=<?= $room_no ?>&roomAvailability=<?= $room_availability?>">
                    <div class="room">
                        <div class="room-content">
                            <div class="room-no">Room No: <?php print $row['room_no']; ?></div>
                            <div class="room-availability"><?php if($row['room_availability']=='available'){echo "<p style='color:#3c77c6;'>Available </p>";} else{echo "<p style='color:grey;'>Not Available </p>";} ?></div>
                        </div>
                        <div class="icon-box">
                            <?php if($row['room_availability']=='available'){?>
                                <i style='color:#3c77c6;' class="fas fa-bed"></i>
                            <?php }
                            else if($row['room_availability']=='not_available'){?>
                                <i style='color:grey;' class="fas fa-bed"></i>
                            <?php }?>
                        </div>
                    </div>
                    </a> 
                    <?php endforeach ?>
                </div>

                

            </div>
        </div>
    </div>
</body>

<!-- <script>
    document.getElementById("room-card").addEventListener("click",function(){
        document.qeu
    })
</script> -->
<script>
    document.getElementById("add-room").addEventListener("click", function(){
        document.querySelector("#add-room-popup").style.display = "flex";
    })
    document.querySelector(".close").addEventListener("click", function(){
        document.querySelector("#add-room-popup").style.display = "none";
    })
</script>
                <div class="add-rooms">
                    <div class="popup" id="add-room-popup">
                        <div class="popup-content">
                            <form method="post">
                                <h1>Do you want to add a room?</h1>
                                <div class="button-container">
                                    <button type="submit" name ="addRoom" class="custom-btn">Yes</button>
                                    <button class="close-button custom-btn"  name ="close">No</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

</html>
<?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>