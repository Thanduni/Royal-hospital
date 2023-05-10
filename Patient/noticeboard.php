<?php 
session_start();
require_once("../conf/config.php");

if (isset($_SESSION['mailaddress']) && $_SESSION['userRole'] == 'Patient') {

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
            height:600px;
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
                <img src="../images/arrow-right-circle.svg" alt="arrow">Patient's Noticeboard
        </div>
        <?php 
            $nic = $_SESSION['nic'];
            $res1 = mysqli_query($con,"select patientID from patient where nic=$nic");
            $pid = mysqli_fetch_assoc($res1)['patientID'];

                $query = "select a.announcementID,a.title,a.nic,u.name,u.profile_image,a.message,a.date,a.time from announcement a inner join announcementreaders r on a.announcementID=r.announcementID inner join user u on u.nic=a.nic where r.user_role='Patient';";
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
        
    
</div>      
        <div id="login-modal">
        <div class="modal">
            <div class="login-form">
            <h2>Put Your Appointment</h2><br>
            <form  action="" method="post">
                <label for="">Date</label><br><br>
                <input type="date" name="date" id="date"><br><br>
                <label for="">Department</label><br><br>
                <select name="department" id="department">
                    <option value="">Please A Select Department</option>
                    <option value="Anesthetics">Anesthetics</option>
                    <option value="Cardiology">Cardiology</option>
                    <option value="Gastroentology">Gastroentology</option>
                </select><br><br>
                <label for="">Doctor</label><br><br>
                <select name="doctor" id="doctor">
                    <option value="">Select A Department First</option>
                </select><br><br>
                <label for="">Message</label><br><br>
                <textarea name="msg" id="msg" cols="30" rows="3" placeholder="Your Message To The Doctor"></textarea><br><br>
                <!-- <br><br><input type="submit" value="Submit" id="btn" name="btn" class="btn"> -->
               
                <button type="submit" name="cancel" id="cancel" value="cancel" class="cancel-modal">Cancel</button>
                <button type="submit" name="submit" id="btn" value="submit" onclick="">Submit</button>
            </form>
            </div>
        </div>
    </div>
    
    <script type="text/javascript">
        $(function(){
            $('#open').click(function(){
                $('#login-modal').fadeIn().css("display","flex");
            });
            $('#open-').click(function(){
                $('#login-modal').fadeIn().css("display","flex");
            });
            $('.cancel-modal').click(function(){
                $('#login-modal').fadeOut();
            });
        });
    </script>
</body>
</html>
<?php } ?>