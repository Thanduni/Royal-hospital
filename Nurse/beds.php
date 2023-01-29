<?php
$page = 'beds';
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
    <title>Beds</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>
<body>
    <div class="main-container">
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
        
                    <div class="room-availability">Availability: <?php if($row['room_availability']=='available'){print 'Yes';} else{print 'No';} ?></div>
                </div>
                <div class="icon-box">
                <?php if($row['room_availability']==1){?> 
                    <i src="./images/available.png"></i>
                    <?php } ?>
                    <!-- <i class="fas fa-bed"></i> -->
                </div>
            </div> 
<?php endforeach ?>



        </div>
    </div>
</body>
</html>