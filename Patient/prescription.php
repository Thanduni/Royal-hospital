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
    <title>Bill Details</title>
    <style>
        body{
            background-color: #f9f8ff;
        }
        
        .table1 {
            margin: 10px 0 0px 0;
            width: 100%;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            height: 500px;
            overflow-y: scroll;
            border-style: none;
            border-radius: 10px;
        }
        
    </style>
</head>
<body>
    <div class="user">

    <?php
    $total = 0;
    $total1 = 0;
    $total2 = 0;
    $npaid = 0;
    $name = urlencode( $_SESSION['name']);
    include(BASEURL.'/Components/PatientSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name); ?>
    <!-- <?php //include(BASEURL.'/Components/PatientSidebar.php?profilePic='.$_SESSION['profilePic']."&name".$_SESSION['name']); ?> -->
    
    <div class="userContents"  id="center">
        <?php
        $name = urlencode( $_SESSION['name']);
        include(BASEURL.'/Components/patientTopbar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name . "&userRole=" . $_SESSION['userRole']. "&nic=" . $_SESSION['nic']);
        ?>
        <div class="arrow">
                <img src="../images/arrow-right-circle.svg" alt="arrow">Prescriptions
        </div>
        <div class="m-content">
            <div class="p-content">
            <div class="wrapper_p">
                <div class="table_header"><h3 style="color: var(--primary-color);">Prescriptions</h3></div>
                <div class="table1">
                    <div class="row headerT">
                        <div class="cell">Date</div>
                        <div class="cell" style="width:300px;">Doctor Name</div>
                        <div class="cell" style="width:300px;">Preview & Download</div>
                    </div>
                    <?php 
                        $nic = $_SESSION['nic'];
                        $pid_query = "SELECT patientID FROM patient WHERE nic = '$nic'";
                        $result_pid = mysqli_query($con, $pid_query);
                        $pid = mysqli_fetch_assoc($result_pid)['patientID'];

                        $query = "select p.date,u.name,p.prescriptionID,p.patientID,p.doctorID from prescription p inner join doctor d on p.doctorID = d.doctorID inner join user u on d.nic=u.nic where p.patientID = $pid";
                        $res = mysqli_query($con,$query);

                        while($rows = mysqli_fetch_assoc($res)){ ?>
                        <div class="row">
                            <div class="cell" data-title="Date">
                                    <?php echo $rows['date']; ?>
                            </div>
                            <div class="cell" data-title="Date">
                                    <?php echo $rows['name']; ?>

                            </div>
                            <div class="cell" data-title="Option">
                                <a href="<?php echo BASEURL.'/Patient/pdf/downloadprescription.php?id='.$rows['prescriptionID'].'&name='.$rows['doctorID']?>">
                                <img style="width:250px;height:60px;position: relative;bottom: 0px;bottom: 0px;padding: 0px;" src=<?php echo BASEURL.'/images/download-pdf.png';?> alt="download">
                            </a>    
                            </div>
                        </div>
                        <?php
                        
                        }
                    ?>
            </div>
            </div>
            </div>

            <div class="p-img">
                    <img style="max-width: 412px;height:608px;" src="<?php echo BASEURL.'/images/prescription.png'?>" alt="">
            </div>
        </div>

        
        
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