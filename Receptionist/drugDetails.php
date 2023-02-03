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
        <link rel="stylesheet" href="<?php echo BASEURL . '/css/drugDetails.css' ?>">
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
                $query1 = "SELECT purchases.date, item.item_name, purchases.quantity, purchases.quantity * item.unit_price as rate, purchases.paid_status from 
                        purchases inner JOIN item ON purchases.item = item.itemID where purchases.item_flag='d' and purchases.patientID='".$_GET['id']."'";
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
                <ul id="billInfo">
                    <li id="serviceDetails"><a href="<?php echo BASEURL . '/Receptionist/serviceDetails.php?id=' . $_GET['id']?>">Service</a></li>
                    <li id="testDetails"><a href="<?php echo BASEURL . '/Receptionist/testDetails.php?id=' . $_GET['id'] ?>">Test</a></li>
                    <li id="drugDetails"><a href="<?php echo BASEURL . '/Receptionist/drugDetails.php?id=' . $_GET['id'] ?>">Drug</a></li>
                </ul>
                <div class="wrapper">
                    <div class="table">
                        <div class="row headerT">
                            <div class="cell">Date</div>
                            <div class="cell">Drug name</div>
                            <div class="cell">Quantity</div>
                            <div class="cell">Rate</div>
                            <div class="cell">Status</div>
                        </div>
                        <?php
                        for ($j = 0; $j < $rows; ++$j) {
                            $result1->data_seek($j);
                            $row1 = $result1->fetch_array(MYSQLI_ASSOC);
                            ?>
                            <div class="row">
                                <div class="cell" data-title="Date">
                                    <?php echo $row1['date']; ?>
                                </div>
                                <div class="cell" data-title="Drug name">
                                    <?php echo $row1['item_name']; ?>
                                </div>
                                <div class="cell" data-title="Quantity">
                                    <?php echo $row1['quantity']; ?>
                                </div>
                                <div class="cell" data-title="Rate">
                                    <?php echo $row1['rate']; ?>
                                </div>
                                <div class="cell" data-title="Status">
                                    <?php echo $row1['paid_status']; ?>
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