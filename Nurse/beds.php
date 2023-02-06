<?php
session_start();
//die( $_SESSION['profilePic']);
require_once("../conf/config.php");
if (isset($_SESSION['mailaddress']) && $_SESSION['userRole'] == 'Nurse') {
    ?>

<?php
if(isset($_POST['submit'])){
    $room_availability =  $_POST['room_availability'];
    $room_no = $_POST['room_no'];

    $sql="UPDATE room SET room_availability = '$room_availability' WHERE room_no = '$room_no';";
    $result=mysqli_query($con,$sql);

    if($result){
        header('location:beds.php');
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
        <?php include(BASEURL . '/Components/nurseSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $_SESSION['name']); ?>
        <div class="userContents" id="center">
            <div class="title">
                <img src="<?php echo BASEURL . '/images/logo5.png' ?>" alt="logo">
                Royal Hospital Management System
            </div>
            <ul>
                <li class="userType"><img src=<?php echo BASEURL . '/images/userInPage.svg' ?> alt="admin">
                    Nurse
                </li>
                <li class="logout"><a href="<?php echo BASEURL . '/Homepage/logout.php?logout' ?>">Logout
                        <img
                                src=<?php echo BASEURL . '/images/logout.svg' ?> alt="logout"></a>
                </li>
            </ul>
            <div class="arrow">
                <img src=<?php echo BASEURL . '/images/arrow-right-circle.svg' ?> alt="arrow">Dashboard
            </div>

            <div class="main-container">
                <button class="button" id="update-room">
                    Update Room
                </button>
                <div class="room-cards">
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
                            <img src="../images/close.png" alt="close" class="close">
                            <form method="post">
                                <h1>Update Room</h1>
                                <div class="form-group">
                                    <label>Room No</label>
                                    <input type="text" class="form-control" placeholder="Enter name" name="room_no">
                                </div>
                                <div class="form-group">
                                    <label>Availability</label>
                                    <select name="room_availability" id="room_availability">
                                        <option value="available">Available</option>
                                        <option value="not_available">not_available</option>
                                    </select>
                                </div>
                                <button type="submit" name ="submit">Submit</button>
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
    document.querySelector(".close").addEventListener("click", function(){
        document.querySelector("#update-room-popup").style.display = "none";
    })
</script>

</html>
<?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>