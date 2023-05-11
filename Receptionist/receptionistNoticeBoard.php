<?php 
session_start();
require_once("../conf/config.php");

if (isset($_SESSION['mailaddress']) && $_SESSION['userRole'] == 'Receptionist') {

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASEURL.'/css/style.css';?>">
    <link rel="stylesheet" href="<?php echo BASEURL.'/css/patientDash.css';?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="<?php echo BASEURL . '/js/appoinment.js'; ?>"></script>
    <link rel="stylesheet" href="<?php echo BASEURL.'/css/patientAppointment.css' ?>">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Patient's Summary</title>
    <style>
        body{
            background-color: #f9f8ff;
        }

        .s-content{
            overflow-y: hidden;
            max-width: 1800px;
            /* float: left; */
            background-color: #ffffff;
            padding:30px 30px;
            margin:50px 50px;
            width:95%;
            border-color: #000100;
            border-radius: rgba(0,0,0,0);
            /* border-color: black; */
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        .s-content .n-content textarea{
            overflow-y: hidden;
            width: 98.5%;
            min-height:300px;
            font-size: 18px;
            
        }
    </style>
</head>
<body>
    <div class="user">

    <?php
    $name = urlencode( $_SESSION['name']);
    include(BASEURL.'/Components/PatientSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name); ?>
    <!-- <?php //include(BASEURL.'/Components/PatientSidebar.php?profilePic='.$_SESSION['profilePic']."&name".$_SESSION['name']); ?> -->
    
    <div class="userContents"  id="center">
        <?php
        $name = urlencode( $_SESSION['name']);
        include(BASEURL.'/Components/patientTopbar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name . "&userRole=" . $_SESSION['userRole']. "&nic=" . $_SESSION['nic']);
        ?>
        <div class="arrow">
                <img src="../images/arrow-right-circle.svg" alt="arrow">Receptionist's Noticeboard
        </div>
        <?php 

                $query = "select a.announcementID,a.title,a.nic,u.name,u.profile_image,a.message,a.date,a.time from announcement a inner join announcementreaders r on a.announcementID=r.announcementID inner join user u on u.nic=a.nic where r.user_role='Receptionist';";
                $result = mysqli_query($con,$query);
           
                 while($rows = mysqli_fetch_assoc($result)){
             ?>
                 <div class="s-content">
                    <div class="t-content"><h2><u><?php echo $rows['title'];?></u></h2></div>
                    <div class="n-header" style="font-size:20px;font-weight: 600;"><img src="<?php echo BASEURL.'/images/'.$rows['profile_image'] ?>" > <?php echo " by "."<span style='color:var(--primary-color);'>".$rows['name']."</span>"." - ".date("l, j F Y",strtotime($rows['date']))." , ".$rows['time']; ?></div><br><br>
                    <div class="n-content"><pre><textarea><?php echo "".$rows['message']; ?></textarea></pre></div>
                    
                </div>
            <?php
                }
            ?>
        
    
    </script>
</body>
</html>
<?php } ?>