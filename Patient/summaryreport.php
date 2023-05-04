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

        .s-content table{
            background-color: #ffffff;
            padding:30px 30px;
            margin:50px 50px;
            width:auto;
            border-radius: 10px;
            border-color: black;
        }

        .s-content table tr{
            background-color: #ffffff;
            height: 65px;
            font-size: 20px;
            font-weight: 500;
            width: auto;
            border-radius: 10px;
            border-color: black;
        }
        .s-content table tr td{
            background-color: #ffffff;
            color: black;
            /* padding:30px 30px; */
            /* margin:30px 30px; */
            width:auto;
            border-radius: 10px;
            border-color: none;
            
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
                <img src="../images/arrow-right-circle.svg" alt="arrow">Patient's Summary
        </div>
        <?php 
            $nic = $_SESSION['nic'];
            $res1 = mysqli_query($con,"select patientID from patient where nic=$nic");
            $pid = mysqli_fetch_assoc($res1)['patientID'];

            $res2 = mysqli_query($con,"select doctorID from prescription where patientID = $pid");
            $docid = mysqli_fetch_assoc($res2)['doctorID'];

            $res3 = mysqli_query($con,"select nic from doctor where doctorID=$docid");
            $docnic = mysqli_fetch_assoc($res3)['nic'];

            $query = "select i.admit_date,i.admit_duration,u.name,p.investigation,p.Impression from inpatient i inner join prescription p on i.patientID=p.patientID
             inner join patient t on p.patientID=t.patientID inner join user u on t.nic=u.nic where i.patientID=$pid and u.nic=$docnic and i.doctorID=$docid";

            $result = mysqli_query($con,$query);

            while($rows = mysqli_fetch_assoc($result)){
        ?>
            <div class="s-content">
                <table>
                    <tr>
                        <td><label for="">Date:</label></td>
                        <td><a href=""><?php echo $rows['admit_date'].$rows['admit_duration']; ?></a></td>
                    </tr>
                    <tr>
                        <td><label for="">Doctor Name:</label></td>
                        <td><a href=""><?php echo $rows['name']; ?></a></td>
                    </tr>
                    <tr>
                        <td><label for="">Impression:</label></td>
                        <td><a href=""><?php echo $rows['Impression']; ?></a></td>
                    </tr>
                    <tr>
                        <td><label for="">Investigation:</label></td>
                        <td><a href=""><?php echo $rows['Investigation']; ?></a></td>
                    </tr>
                </table>

            <?php
                }
            ?>
        
    </div>
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
            $('#openform').click(function(){
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