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
        <link rel="stylesheet" href="<?php echo BASEURL . '/css/displayInduvidualBillsPage.css' ?>">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <style>
            .next {
                position: initial;
                height: auto;
            }
        </style>
        <title>Receptionist dashboard</title>
    </head>
    <body>
    <div class="user">
        <?php include(BASEURL . '/Components/ReceptionistSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $_SESSION['name']); ?>
        <div class="userContents" id="center">
            <div class="title">
                <img src="<?php echo BASEURL . '/images/logo5.png' ?>" alt="logo">
                Royal Hospital Management System
            </div>
            <ul>
                <li class="userType"><img src=<?php echo BASEURL . '/images/userInPage.svg' ?> alt="admin">
                    Receptionist
                </li>
                <li class="logout"><a href="<?php echo BASEURL . '/Homepage/logout.php?logout' ?>">Logout
                        <img
                            src=<?php echo BASEURL . '/images/logout.svg' ?> alt="logout"></a>
                </li>
            </ul>
            <div class="arrow">
                <img src=<?php echo BASEURL . '/images/arrow-right-circle.svg' ?> alt="arrow">Bill List
            </div>
            <p>
                <script src="<?php echo BASEURL . '/js/addUser.js' ?>"></script>
                <button type="button" id="addButton" onclick="displayPatientAddForm()">+Create Bill</button>
            </p>
            <div class="userClass">
                <?php
                $query1 = "SELECT * FROM bill where patientID = '" . $_GET['id'] . "'";
                $result1 = $con->query($query1);

                $rows = $result1->num_rows;

                $patient = "SELECT user.name, patient.patientID FROM user INNER JOIN patient on user.nic = patient.nic where patient.patientID = '".$_GET['id']."'";
                $patientResult = $con -> query($patient) -> fetch_array(MYSQLI_ASSOC);
                ?>
                <div class="patientInfo">
                    <h2>Patient Information</h2><br>
                    <p>Patient Name :- <?php echo $patientResult['name'] ?></p>
                    <p>Patient ID :- <?php echo $patientResult['patientID'] ?> </p>
                </div>
                <div class="wrapper">
                    <div class="table">
                        <div class="row headerT">
                            <div class="cell">Options</div>
                            <div class="cell">Bill ID</div>
                            <div class="cell">Date</div>
                            <div class="cell">Profile Image</div>
                            <div class="cell">ID of Receptionist handles the bill</div>
                            <div class="cell">Patient type</div>
                            <div class="cell">Status</div>
                        </div>
                        <?php
                        for ($j = 0; $j < $rows; ++$j) {
                            $result1->data_seek($j);
                            $row1 = $result1->fetch_array(MYSQLI_ASSOC);
                            $query2 = "SELECT bill.billID, bill.bill_date, user.profile_image, bill.receptionistID, patient.patient_type, bill.status FROM 
                            bill join patient on bill.patientID = patient.patientID join user on user.nic = patient.nic where patient.patientID = '".$_GET['id']."'";
                            $result2 = $con->query($query2);
                            $result2->data_seek(0);
                            $row2 = $result2->fetch_array(MYSQLI_ASSOC);
                            ?>
                            <div class="row">
                                <div class="cell" style="100px" data-title="Options">
                                    <a href="<?php echo BASEURL . '/Receptionist/payrollPageBill.php?id= '.$patientResult['patientID'].'&name='.$patientResult['name'] ?>">
                                        <button class="edit"><img
                                                    src="<?php echo BASEURL . '/images/bill.svg' ?>" alt=" Edit">
                                            View Bill
                                        </button>
                                    </a>
                                </div>
                                <div class="cell" data-title="Bill ID">
                                    <?php echo $row2['billID']; ?>
                                </div>
                                <div class="cell" data-title="Patient ID">
                                    <?php echo $row2['bill_date']; ?>
                                </div>
                                <div class="cell" style="width:100px" data-title="Profile image">
                                    <?php
                                    echo "<img class='profilePic' src='" . BASEURL . "/uploads/".$row2['profile_image']." alt='Upload Image' width=150px>";
                                    ?>
                                </div>
                                <div class="cell" data-title="Patient type">
                                    <?php echo $row2['receptionistID']; ?>
                                </div>
                                <div class="cell" data-title="Patient type">
                                    <?php echo $row2['patient_type']; ?>
                                </div>
                                <div class="cell" data-title="Patient type">
                                    <?php echo $row2['status']; ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include(BASEURL . '/Components/Footer.php'); ?>
    </body>
    </html>

    <?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>