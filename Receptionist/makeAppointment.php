<?php
session_start();
//die( $_SESSION['profilePic']);
require_once("../conf/config.php");
if (isset($_SESSION['mailaddress']) && $_SESSION['userRole'] == 'Receptionist') {
    ?>

    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" href="<?php echo BASEURL . '/css/style.css' ?>">
        <link rel="stylesheet" href="<?php echo BASEURL . '/css/receptionistDash.css' ?>">
        <link rel="stylesheet" href="<?php echo BASEURL . '/css/makeAppointments.css' ?>">
        <link rel="stylesheet" href="https://cdn.iconscout.com/iconscout-1.0.0-beta/iconscout.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
        <script src="https://kit.fontawesome.com/04b61c29c2.js" crossorigin="anonymous"></script>
        <script src="<?php echo BASEURL. '/js/getDocDetails.js'; ?>"></script>
        <link rel="stylesheet" href="<?php echo BASEURL .'/css/appoinment.css';?>">
        <link rel="stylesheet" href="<?php echo BASEURL .'/css/adminUsersPage.css';?>">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <style>
            .next {
                position: initial;
                height: auto;
            }

        </style>
        <title>Appointment dashboard</title>
    </head>
    <body>
    <div class="user">
        <?php
        $name = urlencode( $_SESSION['name']);
        include(BASEURL . '/Components/ReceptionistSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name); ?>
        <div class="userContents" id="center">
            <?php
            $name = urlencode( $_SESSION['name']);
            include(BASEURL.'/Components/receptionistTopbar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name . "&userRole=" . $_SESSION['userRole']. "&nic=" . $_SESSION['nic']);
            ?>
            <div class="arrow">
                <img src=<?php echo BASEURL . '/images/arrow-right-circle.svg' ?> alt="arrow">Appointments
            </div>
            <p>
                <button id=open type="button" class="custom-btn">+Add appointment</button>
            </p>
            <div class="wrapper_p">
                <div class="table">
                    <div class="row headerT">
                        <div class="cell">Appointment ID</div>
                        <div class="cell">Doctor Name</div>
                        <div class="cell">Patient Name</div>
                        <div class="cell">Date</div>
                        <div class="cell">Time</div>
                        <div class="cell">Venue</div>
                        <div class="cell">Message</div>
                        <div class="cell">Options</div>
                    </div>

                    <?php

                    $query = "SELECT `appointmentID`,`date`,`time`,`venue`,`doctorID`,`patientID`,`message`,`status` FROM `appointment` 
                              ORDER BY appointmentID;";
                    $result = mysqli_query($con, $query);
                    while($rows = mysqli_fetch_assoc($result)){
                        $doctorName = mysqli_fetch_assoc(mysqli_query($con, "SELECT user.name FROM doctor inner join user on doctor.nic = user.nic 
                        where doctor.doctorID = '".$rows['doctorID']."';"))['name'];
                        $patientQuery = "SELECT  name FROM user inner join patient on patient.nic = user.nic  where patient.patientID = '".$rows['patientID']."';";
                        $patientResult = mysqli_fetch_array(mysqli_query($con, $patientQuery));
                        $patientName = $patientResult['name'];
                        ?>
                        <div class="row">
                            <div class="cell" data-title="Appointment ID">
                                <?php echo $rows['appointmentID']; ?>
                            </div>
                            <div class="cell" data-title="Doctor Name">
                                <?php echo $doctorName; ?>
                            </div>
                            <div class="cell" data-title="Patient Name">
                                <?php echo $patientName; ?>
                            </div>
                            <div class="cell" data-title="Date">
                                <?php echo $rows['date']; ?>
                            </div>
                            <div class="cell" data-title="Time">
                                <?php echo $rows['time']; ?>
                            </div>
                            <div class="cell" data-title="Venue">
                                <?php echo $rows['venue']; ?>
                            </div>
                            <div class="cell" data-title="Message">
                                <?php echo $rows['message']; ?>
                            </div>
                            <div class="cell" style="" data-title="Options">
                                <a href="<?php echo BASEURL . '/Patient/deleteAppointment.php?id=' . $rows['appointmentID'] ?>">
                                    <button class="operation"><img src="<?php echo BASEURL . '/images/trash.svg' ?>" alt="Delete">
                                    </button>
                                </a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <div id="userForm">
            <div id="form">
                <form method="post" action="appointment.php" enctype="multipart/form-data" id="addForm"
                      name="userForm">
                    <div class="banner">
                        <h1>Appointment</h1>
                    </div>
                    <p class="royal">Royal Hospital Management System </p>
                    <p class="addUser" id="titleOperation">Add appointment</p>
                    <table>
                        <tr colspan="3">
                            <div class="alert" id="warning"></div>
                        </tr>
                        <tr id="nicRow">
                            <td>
                                <label for="">Date</label><br>
                            </td>
                            <td colspan="2">
                                <input type="date" name="date" id="date" min = "<?php echo date('Y-m-d') ?>" max = "<?php echo date('Y-m-d', strtotime('+1 week')) ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="">Department</label><br>
                            </td>
                            <td colspan="2">
                                <select name="department" id="department">
                                    <option value="">Please A Select Department</option>
                                    <option value="Anesthetics">Anesthetics</option>
                                    <option value="Cardiology">Cardiology</option>
                                    <option value="Gastroentology">Gastroentology</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label  for="">Doctor</label><br>
                            </td>
                            <td colspan="2">
                                <select name="doctor" id="doctor">
                                    <option value="">Select a doctor</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Patient</label>
                            </td>
                            <td colspan="2">
                                <select name="patient" id="">
                                    <?php
                                    $sql="Select * from `patient` inner join user on user.nic = patient.nic";
                                    $result=mysqli_query($con,$sql);
                                    while($row=mysqli_fetch_assoc($result)){
                                        $pid = $row['patientID'];
                                        $pName = $row['name'];
                                    ?>
                                    <option value=<?php echo $pid ?>><?php echo $pName?></option>

                                <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="">Time</label><br>
                            </td>
                            <td colspan="2">
                                <select name="time" id="time">
                                    <option value="">Please select a time slot</option>
                                </select>                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="">Message</label><br>
                            </td>
                            <td colspan="2">
                                <textarea name="msg" id="msg" cols="30" rows="3" placeholder="Your Message To The Doctor"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="2">
                                <button type="submit" class="custom-btn" name="cancel" id="cancel" value="cancel" class="cancel-modal">Cancel</button>
                                <button type="submit" class="custom-btn" name="submit" id="btn" value="submit">Submit</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function(){
            $('#open').click(function(){
                $('#userForm').fadeIn().css("display","flex");
            });
            $('#cancel').click(function(){
                $('#userForm').fadeOut();
            });
        });
    </script>
    </body>
    </html>

    <?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>

