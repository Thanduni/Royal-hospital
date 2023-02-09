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
?>
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <style>
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
        include(BASEURL.'/Components/nurseSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name); ?>
        <div class="userContents" id="center">
            <div class="title">
                <img src="<?php echo BASEURL . '/images/logo5.png' ?>" alt="logo">
                Royal Hospital Management System
            </div>
            <ul>
                <li class="userType"><img src=<?php echo BASEURL . '/images/userInPage.svg' ?> alt="nurse">
                    Nurse
                </li>
                <li class="logout"><a href="<?php echo BASEURL . '/Homepage/logout.php?logout' ?>">Logout
                        <img
                                src=<?php echo BASEURL . '/images/logout.svg' ?> alt="logout"></a>
                </li>
            </ul>
            <div class="arrow">
                <img src=<?php echo BASEURL . '/images/arrow-right-circle.svg' ?> alt="arrow">Room
            </div>
            <button class="button" id="update-room">
                Update Room
            </button>
            <div class="main-container">

                <button class="button" id="add-room">
                    Add Room
                </button>
                <div class="room-cards">                    
                    <?php foreach ($rows as $row):?>
                    <div class="room">
                        <div class="room-content">
                            <div class="room-no">Room No: <?php print $row['room_no']; ?></div>
                            <div class="room-availability">Availability: <?php if($row['room_availability']=='available'){echo "<p style='color:Green;'>Yes </p>";} else{echo "<p style='color:red;'>No </p>";} ?></div>
                        </div>
                        <div class="icon-box">
                            <?php if($row['room_availability']=='available'){?>
                                <i style='color:Green;' class="fas fa-bed"></i>
                            <?php }
                            else if($row['room_availability']=='not_available'){?>
                                <i style='color:Red;' class="fas fa-bed"></i>
                            <?php }?>
                        </div>
                    </div> 
                    <?php endforeach ?>
                </div>

                <div class="update-rooms">
                    <div class="popup" id="update-room-popup">
                        <div class="popup-content">
                            <form method="post">
                                <h1>Update Room</h1>
                                <div class="form-group">
                                    <label>Room No</label>
                                    <select name="room_no">
                                        <?php foreach($rows as $row):?>
                                        <option><?php print $row['room_no']; ?> </option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Availability</label>
                                    <select name="room_availability" id="room_availability">
                                        <option value="available">Available</option>
                                        <option value="not_available">not_available</option>
                                    </select>
                                </div>
                                <div class="button-container">
                                    <button type="submit" name ="updateRoom">Submit</button>
                                    <button class="close-button" name ="close">Close</button>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>

                <div class="add-rooms">
                    <div class="popup" id="add-room-popup">
                        <div class="popup-content">
                            <form method="post">
                                <h1>Dp you want to add a room?</h1>
                                <!-- <div class="form-group">
                                    <label>Room No</label>
                                    <input type="text" class="form-control" placeholder="Enter Room No" name="room_no">
                                </div>
                                <div class="form-group">
                                    <label>Availability</label>
                                    <select name="room_availability" id="room_availability">
                                        <option value="available">Available</option>
                                        <option value="not_available">not_available</option>
                                    </select>
                                </div> -->
                                <div class="button-container">
                                    <button type="submit" name ="addRoom">Yes</button>
                                    <button class="close-button" name ="close">No</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

<script>
   document.getElementById("update-room").addEventListener("click", function(){
        document.querySelector("#update-room-popup").style.display = "flex";
    })
    document.querySelector(".close-button").addEventListener("click", function(){
        document.querySelector("#update-room-popup").style.display = "none";
    })
    document.getElementById("add-room").addEventListener("click", function(){
        document.querySelector("#add-room-popup").style.display = "flex";
    })
    document.querySelector(".close").addEventListener("click", function(){
        document.querySelector("#add-room-popup").style.display = "none";
    })
</script>

</html>
<?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>