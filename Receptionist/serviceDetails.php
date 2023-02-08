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
        <link rel="stylesheet" href="<?php echo BASEURL . '/css/serviceDetails.css' ?>">
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
        <?php
        $name = urlencode( $_SESSION['name']);
        include(BASEURL . '/Components/ReceptionistSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name . "&id=" . $_GET['id']); ?>
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
            <div class="userClass">
                <?php
                if (@$_GET['startDate'] && @$_GET['endDate'] && @$_GET['status']) {
                    $query1 = "SELECT purchases.date, service.Service_name, purchases.quantity, purchases.quantity * service.cost as rate, purchases.paid_status from 
                        purchases inner JOIN service ON purchases.item = service.serviceID where purchases.item_flag='s' and purchases.patientID='" . $_GET['id'] . "'
                        and purchases.paid_status='" . $_GET['status'] . "' and purchases.date between '" . $_GET['startDate'] . "' AND '" . $_GET['endDate'] . "'";
                }else if((@$_GET['startDate'] && @$_GET['endDate']) && !@$_GET['status']){
                    $query1 = "SELECT purchases.date, service.Service_name, purchases.quantity, purchases.quantity * service.cost as rate, purchases.paid_status from 
                        purchases inner JOIN service ON purchases.item = service.serviceID where purchases.item_flag='s' and purchases.patientID='" . $_GET['id'] . "'
                         and purchases.date between '" . $_GET['startDate'] . "' AND '" . $_GET['endDate'] . "'";
                } else if ((!@$_GET['startDate'] || !@$_GET['endDate']) && @$_GET['status']) {
                    $query1 = "SELECT purchases.date, service.Service_name, purchases.quantity, purchases.quantity * service.cost as rate, purchases.paid_status from 
                        purchases inner JOIN service ON purchases.item = service.serviceID where purchases.item_flag='s' and purchases.patientID='" . $_GET['id'] . "'
                        and purchases.paid_status='" . $_GET['status'] . "'";
                } else {
                    $query1 = "SELECT purchases.date, service.Service_name, purchases.quantity, purchases.quantity * service.cost as rate, purchases.paid_status from 
                        purchases inner JOIN service ON purchases.item = service.serviceID where purchases.item_flag='s' and purchases.patientID='" . $_GET['id'] . "'";
                }
                $result1 = $con->query($query1);
                $rows = $result1->num_rows;

                $patient = "SELECT user.name, patient.patientID FROM user INNER JOIN patient on user.nic = patient.nic where patient.patientID = '" . $_GET['id'] . "'";
                $patientResult = $con->query($patient)->fetch_array(MYSQLI_ASSOC);
                ?>
                <div class="patientInfo">
                    <h2>Patient Information</h2><br>
                    <p>Patient Name :- <?php echo $patientResult['name'] ?></p>
                    <p>Patient ID :- <?php echo $patientResult['patientID'] ?> </p>
                </div>
                <div id="filterInfo">
                    <h3 style="text-align: center"><u>Filter Cost Information</u></h3>
                    <table>
                        <form action="dateFilter.php?id=<?php echo $_GET['id'] ?>" method="post">
                            <tr>
                                <td><label for="Start date">Start date: </label></td>
                                <td><input type="date" name="startDate" id="startDate"
                                           placeholder="Enter the start date"></td>
                            </tr>
                            <tr>
                                <td colspan="2" id="startDateWarn"></td>
                            </tr>
                            <tr>
                                <td><label for="End date">End date: </label></td>
                                <td><input type="date" name="endDate" id="endDate" placeholder="Enter the end date">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" id="endDateWarn"></td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="Not paid">Not paid</label>
                                </td>
                                <td>
                                    <input type="checkbox" style="display: inline" id="paidStatus" name="paidStatus">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <button style="width: auto;height: auto;padding: 10px; margin: 0px" type="submit"
                                            id="filterAppointment" name="filterAppointment">
                                        Filter appointments
                                    </button>
                                </td>
                            </tr>
                        </form>
                        <tr>
                            <td colspan="2" id="finalWarning"></td>
                        </tr>
                    </table>
                    <br>
                </div>
                <ul id="billInfo">
                    <li><a
                                href="#table-service">Service</a>
                    </li>
                    <li><a
                                href="#table-test">Test</a>
                    </li>
                    <li><a
                                href="#table-drug">Drug</a>
                    </li>
                    <li><a
                                href="#table-summary">Summary</a>
                    </li>
                </ul>
                <div class="table-set">
                    <div class="wrapper" id="table-service">
                        <h3 style="text-align: center;color: #24354E">Service Cost Information</h3>
                        <div class="table">
                            <div class="row headerT">
                                <div class="cell">Date</div>
                                <div class="cell">Service name</div>
                                <div class="cell">Quantity</div>
                                <div class="cell">Rate</div>
                                <div class="cell">Status</div>
                            </div>
                            <?php
                            $serviceSum = 0;
                            for ($j = 0; $j < $rows; ++$j) {
                                $result1->data_seek($j);
                                $row1 = $result1->fetch_array(MYSQLI_ASSOC);
                                $serviceSum += $row1['rate'];
                                ?>
                                <div class="row">
                                    <div class="cell" data-title="Date">
                                        <?php echo $row1['date']; ?>
                                    </div>
                                    <div class="cell" data-title="Service name">
                                        <?php echo $row1['Service_name']; ?>
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
                            <div class="row total">
                                <div class="cell" data-title="Rate">

                                </div>
                                <div class="cell" data-title="Rate">

                                </div>
                                <div class="cell" data-title="Rate">
                                    <b>Total amount</b>
                                </div>
                                <div class="cell" data-title="Rate">
                                    <b><?php echo $serviceSum; ?></b>
                                </div>
                                <div class="cell" data-title="Status">

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    if (@$_GET['startDate'] && @$_GET['endDate'] && @$_GET['status']) {
                        $query1 = "SELECT purchases.date, test.test_name, purchases.quantity, purchases.quantity * test.cost as rate, purchases.paid_status from 
                        purchases inner JOIN test ON purchases.item = test.testID where purchases.item_flag='t' and purchases.patientID='" . $_GET['id'] . "'
                        and purchases.paid_status='" . $_GET['status'] . "' and purchases.date between '" . $_GET['startDate'] . "' AND '" . $_GET['endDate'] . "'";
                    } else if((@$_GET['startDate'] && @$_GET['endDate']) && !@$_GET['status']){
                        $query1 = "SELECT purchases.date, test.test_name, purchases.quantity, purchases.quantity * test.cost as rate, purchases.paid_status from 
                        purchases inner JOIN test ON purchases.item = test.testID where purchases.item_flag='t' and purchases.patientID='" . $_GET['id'] . "'
                         and purchases.date between '" . $_GET['startDate'] . "' AND '" . $_GET['endDate'] . "'";
                    } else if ((!@$_GET['startDate'] || !@$_GET['endDate']) && @$_GET['status']) {
                        $query1 = "SELECT purchases.date, test.test_name, purchases.quantity, purchases.quantity * test.cost as rate, purchases.paid_status from 
                        purchases inner JOIN test ON purchases.item = test.testID where purchases.item_flag='t' and purchases.patientID='" . $_GET['id'] . "'
                        and purchases.paid_status='" . $_GET['status'] . "'";
                    } else {
                        $query1 = "SELECT purchases.date, test.test_name, purchases.quantity, purchases.quantity * test.cost as rate, purchases.paid_status from 
                        purchases inner JOIN test ON purchases.item = test.testID where purchases.item_flag='t' and purchases.patientID='" . $_GET['id'] . "'";
                    }
                    $result1 = $con->query($query1);
                    $rows = $result1->num_rows;
                    ?>
                    <div class="wrapper" id="table-test">
                        <h3 style="text-align: center;color: #24354E">Test Cost Information</h3>
                        <div class="table">
                            <div class="row headerT">
                                <div class="cell">Date</div>
                                <div class="cell">Test name</div>
                                <div class="cell">Quantity</div>
                                <div class="cell">Rate</div>
                                <div class="cell">Status</div>
                            </div>
                            <?php
                            $testSum = 0;
                            for ($j = 0; $j < $rows; ++$j) {
                                $result1->data_seek($j);
                                $row1 = $result1->fetch_array(MYSQLI_ASSOC);
                                $testSum += $row1['rate'];
                                ?>
                                <div class="row">
                                    <div class="cell" data-title="Date">
                                        <?php echo $row1['date']; ?>
                                    </div>
                                    <div class="cell" data-title="Test name">
                                        <?php echo $row1['test_name']; ?>
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
                            <div class="row total">
                                <div class="cell" data-title="Rate">

                                </div>
                                <div class="cell" data-title="Rate">

                                </div>
                                <div class="cell" data-title="Rate">
                                    <b>Total amount</b>
                                </div>
                                <div class="cell" data-title="Rate">
                                    <b><?php echo $testSum; ?></b>
                                </div>
                                <div class="cell" data-title="Status">

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    if (@$_GET['startDate'] && @$_GET['endDate'] && @$_GET['status']) {
                        $query1 = "SELECT purchases.date, item.item_name, purchases.quantity, purchases.quantity * item.unit_price as rate, purchases.paid_status from 
                        purchases inner JOIN item ON purchases.item = item.itemID where purchases.item_flag='d' and purchases.patientID='" . $_GET['id'] . "'
                         and purchases.paid_status='" . $_GET['status'] . "' and  purchases.date between '" . $_GET['startDate'] . "' AND '" . $_GET['endDate'] . "'";
                    } else if((@$_GET['startDate'] && @$_GET['endDate']) && !@$_GET['status']){
                        $query1 = "SELECT purchases.date, item.item_name, purchases.quantity, purchases.quantity * item.unit_price as rate, purchases.paid_status from 
                        purchases inner JOIN item ON purchases.item = item.itemID where purchases.item_flag='d' and purchases.patientID='" . $_GET['id'] . "'
                        and  purchases.date between '" . $_GET['startDate'] . "' AND '" . $_GET['endDate'] . "'";
                    } else if ((!@$_GET['startDate'] || !@$_GET['endDate']) && @$_GET['status']) {
                        $query1 = "SELECT purchases.date, item.item_name, purchases.quantity, purchases.quantity * item.unit_price as rate, purchases.paid_status from 
                        purchases inner JOIN item ON purchases.item = item.itemID where purchases.item_flag='d' and purchases.patientID='" . $_GET['id'] . "'
                         and purchases.paid_status='" . $_GET['status'] . "'";
                    } else {
                        $query1 = "SELECT purchases.date, item.item_name, purchases.quantity, purchases.quantity * item.unit_price as rate, purchases.paid_status from 
                        purchases inner JOIN item ON purchases.item = item.itemID where purchases.item_flag='d' and purchases.patientID='" . $_GET['id'] . "'";
                    }

                    $result1 = $con->query($query1);
                    $rows = $result1->num_rows;
                    ?>
                    <div class="wrapper" id="table-drug">
                        <h3 style="text-align: center;color: #24354E">Drug Cost Information</h3>
                        <div class="table">
                            <div class="row headerT">
                                <div class="cell">Date</div>
                                <div class="cell">Drug name</div>
                                <div class="cell">Quantity</div>
                                <div class="cell">Rate</div>
                                <div class="cell">Status</div>
                            </div>
                            <?php
                            $drugSum = 0;
                            for ($j = 0; $j < $rows; ++$j) {
                                $result1->data_seek($j);
                                $row1 = $result1->fetch_array(MYSQLI_ASSOC);
                                $drugSum += $row1['rate'];
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
                            <div class="row total">
                                <div class="cell" data-title="Rate">

                                </div>
                                <div class="cell" data-title="Rate">

                                </div>
                                <div class="cell" data-title="Rate">
                                    <b>Total amount</b>
                                </div>
                                <div class="cell" data-title="Rate">
                                    <b><?php echo $drugSum; ?></b>
                                </div>
                                <div class="cell" data-title="Status">

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php

                    if (@$_GET['startDate'] && @$_GET['endDate'] && @$_GET['status']) {
                        $query1 = "SELECT purchases.date, service.Service_name AS name, purchases.quantity, purchases.quantity * service.cost as rate, purchases.paid_status from 
                        purchases inner JOIN service ON purchases.item = service.serviceID where purchases.item_flag='s' and purchases.patientID='" . $_GET['id'] . "'
                         and purchases.paid_status='" . $_GET['status'] . "' and purchases.date between '" . $_GET['startDate'] . "' AND '" . $_GET['endDate'] . "'"
                            . " UNION " .
                            "SELECT purchases.date, test.test_name AS name, purchases.quantity, purchases.quantity * test.cost as rate, purchases.paid_status from
                        purchases inner JOIN test ON purchases.item = test.testID where purchases.item_flag='t' and purchases.patientID='" . $_GET['id'] . "'
                         and purchases.paid_status='" . $_GET['status'] . "' and purchases.date between '" . $_GET['startDate'] . "' AND '" . $_GET['endDate'] . "'"
                            . " UNION " .
                            "SELECT purchases.date, item.item_name AS name, purchases.quantity, purchases.quantity * item.unit_price as rate, purchases.paid_status from 
                        purchases inner JOIN item ON purchases.item = item.itemID where purchases.item_flag='d' and purchases.patientID='" . $_GET['id'] . "'
                         and purchases.paid_status='" . $_GET['status'] . "' and purchases.date between '" . $_GET['startDate'] . "' AND '" . $_GET['endDate'] . "'";
                    } else if((@$_GET['startDate'] && @$_GET['endDate']) && !@$_GET['status']){
                        $query1 = "SELECT purchases.date, service.Service_name AS name, purchases.quantity, purchases.quantity * service.cost as rate, purchases.paid_status from 
                        purchases inner JOIN service ON purchases.item = service.serviceID where purchases.item_flag='s' and purchases.patientID='" . $_GET['id'] . "'
                        and purchases.date between '" . $_GET['startDate'] . "' AND '" . $_GET['endDate'] . "'"
                            . " UNION " .
                            "SELECT purchases.date, test.test_name AS name, purchases.quantity, purchases.quantity * test.cost as rate, purchases.paid_status from 
                        purchases inner JOIN test ON purchases.item = test.testID where purchases.item_flag='t' and purchases.patientID='" . $_GET['id'] . "'
                         and purchases.date between '" . $_GET['startDate'] . "' AND '" . $_GET['endDate'] . "'"
                            . " UNION " .
                            "SELECT purchases.date, item.item_name AS name, purchases.quantity, purchases.quantity * item.unit_price as rate, purchases.paid_status from 
                        purchases inner JOIN item ON purchases.item = item.itemID where purchases.item_flag='d' and purchases.patientID='" . $_GET['id'] . "'
                         and purchases.date between '" . $_GET['startDate'] . "' AND '" . $_GET['endDate'] . "'";
                    } else if ((!@$_GET['startDate'] || !@$_GET['endDate']) && @$_GET['status']) {
                        $query1 = "SELECT purchases.date, service.Service_name AS name, purchases.quantity, purchases.quantity * service.cost as rate, purchases.paid_status from 
                        purchases inner JOIN service ON purchases.item = service.serviceID where purchases.item_flag='s' and purchases.patientID='" . $_GET['id'] . "' AND 
                        purchases.paid_status = '" . $_GET['status'] . "'"
                            . " UNION " .
                            "SELECT purchases.date, test.test_name AS name, purchases.quantity, purchases.quantity * test.cost as rate, purchases.paid_status from 
                        purchases inner JOIN test ON purchases.item = test.testID where purchases.item_flag='t' and purchases.patientID='" . $_GET['id'] . "' AND 
                        purchases.paid_status = '" . $_GET['status'] . "'"
                            . " UNION " .
                            "SELECT purchases.date, item.item_name AS name, purchases.quantity, purchases.quantity * item.unit_price as rate, purchases.paid_status from 
                        purchases inner JOIN item ON purchases.item = item.itemID where purchases.item_flag='d' and purchases.patientID='" . $_GET['id'] . "' AND 
                        purchases.paid_status = '" . $_GET['status'] . "'";
                    } else {
                        $query1 = "SELECT purchases.date, service.Service_name AS name, purchases.quantity, purchases.quantity * service.cost as rate, purchases.paid_status from 
                        purchases inner JOIN service ON purchases.item = service.serviceID where purchases.item_flag='s' and purchases.patientID='" . $_GET['id'] . "'"
                            . " UNION " .
                            "SELECT purchases.date, test.test_name AS name, purchases.quantity, purchases.quantity * test.cost as rate, purchases.paid_status from 
                        purchases inner JOIN test ON purchases.item = test.testID where purchases.item_flag='t' and purchases.patientID='" . $_GET['id'] . "'"
                            . " UNION " .
                            "SELECT purchases.date, item.item_name AS name, purchases.quantity, purchases.quantity * item.unit_price as rate, purchases.paid_status from 
                        purchases inner JOIN item ON purchases.item = item.itemID where purchases.item_flag='d' and purchases.patientID='" . $_GET['id'] . "'";
                    }

                    $result1 = $con->query($query1);
                    $rows = $result1->num_rows;
                    ?>
                    <div class="wrapper" id="table-summary">
                        <h3 style="text-align: center;color: #24354E">Summary Cost Information</h3>
                        <div class="table">
                            <div class="row headerT">
                                <div class="cell">Date</div>
                                <div class="cell">Name</div>
                                <div class="cell">Quantity</div>
                                <div class="cell">Rate</div>
                                <div class="cell">Status</div>
                            </div>
                            <?php
                            $sum = 0;
                            for ($j = 0; $j < $rows; ++$j) {
                                $result1->data_seek($j);
                                $row1 = $result1->fetch_array(MYSQLI_ASSOC);
                                $sum += $row1['rate'];
                                ?>
                                <div class="row">
                                    <div class="cell" data-title="Date">
                                        <?php echo $row1['date']; ?>
                                    </div>
                                    <div class="cell" data-title="Drug name">
                                        <?php echo $row1['name']; ?>
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
                            <div class="row total">
                                <div class="cell" data-title="Rate">

                                </div>
                                <div class="cell" data-title="Rate">

                                </div>
                                <div class="cell" data-title="Rate">
                                    <b>Total amount</b>
                                </div>
                                <div class="cell" data-title="Rate">
                                    <b><?php echo $sum; ?></b>
                                </div>
                                <div class="cell" data-title="Status">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <p>
                <script src="<?php echo BASEURL . '/js/addUser.js' ?>"></script>
            <form action="invoice.php?query=<?php echo $query1 ?>&id=<?php echo $_GET['id'] ?>" method="post">
                <button type="submit" name="createBill">+Create Bill</button>
            </form>
            </p>
        </div>
    </div>
    <?php include(BASEURL . '/Components/Footer.php'); ?>
    <!--    <script src="--><?php //echo BASEURL . '/js/filterCostInfo.js' ?><!--"></script>-->
    </body>
    </html>
    <?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>