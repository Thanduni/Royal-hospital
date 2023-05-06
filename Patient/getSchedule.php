<?php
// connect to the database
require_once("../conf/config.php");
date_default_timezone_set('Asia/Colombo');

// get the selected doctor
$doctorID= $_POST['doctorID'];
$date = $_POST['date'];
//$doctorID= '22';
//$date = '2023-05-06';

$dayOfWeek = date('l', strtotime($date));

// query the database for the departments for the selected doctor
$sql = "SELECT start_time, end_time FROM doctor_working_hours where doctorID='$doctorID' and day_of_week='$dayOfWeek'";
$result = $con->query($sql);

// create an array of departments
$docSchedule = array();
while ($row = $result->fetch_assoc()) {
    $start_time = $row['start_time'];
    $end_time = $row['end_time'];
//    $start_time = '12:00:00';
//    $end_time = '15:00:00';

    $start = new DateTime($start_time);
    $end = new DateTime($end_time);

    $interval = new DateInterval('PT15M');

    $current = clone $start;

    $currentDateTime = new DateTime();
    $currentTime = strtotime($currentDateTime ->format('H:i:s'));
    $currentDate = $currentDateTime -> format('Y-m-d');

    if($date = $currentDate){
        while ($current < $end) {
            if( strtotime($current->format('H:i:s')) > $currentTime){
                $docSchedule[] = $current->format('h:i A');
//                echo($current->format('h:i A'));
            }
            $current->add($interval);
        }
    } else {
        while ($current < $end) {
            $docSchedule[] = $current->format('h:i A');
            $current->add($interval);
        }
    }
}

$sql = "SELECT time FROM appointment where doctorID='$doctorID' and date='$date'";
$result = $con->query($sql);

$reservedSlots = array();
while ($row = $result->fetch_assoc()) {
    $reservedSlots[] = date('h:i A', strtotime($row['time']));
}

$availableSlots = array_diff($docSchedule, $reservedSlots);

// return the departments as JSON
echo json_encode($availableSlots);

?>

