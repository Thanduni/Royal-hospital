<?php
session_start();
//die( $_SESSION['mailaddress']);
require_once("../conf/config.php");

if (isset($_POST["submit"])) {

                        $date = $_POST['date'];
                        $department = $_POST['department'];
                        $doctor = $_POST['doctor'];
                        $msg = $_POST['msg'];
                    
                        $query = "SELECT * FROM appointment WHERE patientID IS NULL";
                        $result = mysqli_query($con, $query);
                        // $select_slot = mysqli_fetch_assoc($result);
    die(mysqli_num_rows($result));
                        print_r($select_slot);
                        $nic = $_SESSION['nic'];
                        $pid_query = "SELECT patientID FROM patient WHERE nic = '.$nic.'";
                        $result_pid = mysqli_query($con,$pid_query);
                        $pid = mysqli_fetch_assoc($result_pid);

                        // echo $pid;
                        if ($select_slot) {
                            mysqli_query($con, "INSERT INTO `appointment`(`patientID`)
                            VALUES ('$pid')");
                            $query = "SELECT date,time,venue,doctor,patientID FROM appointment WHERE patientID = '.$pid.'";
                            $result = mysqli_query($con, $query);
                            $rows = mysqli_num_rows($result);
        for ($j = 0; $j < $rows; ++$j) {
            $result->data_seek($j);
            $row = $result->fetch_array(MYSQLI_ASSOC);
        }
                    }}?>