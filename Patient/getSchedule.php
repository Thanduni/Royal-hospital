<?php
// connect to the database
require_once("../conf/config.php");

// get the selected doctor
$doctorID= $_POST['doctorID'];
$date = $_POST['date'];
$dayOfWeek = date('l', strtotime($date));

// query the database for the departments for the selected doctor
$sql = "SELECT start_time, end_time FROM doctor_working_hours where doctorID='$doctorID' and day_of_week='$dayOfWeek'";
$result = $con->query($sql);

// create an array of departments
$docSchedule = array();
while ($row = $result->fetch_assoc()) {
    $start_time = $row['start_time'];
    $end_time = $row['end_time'];

    $start = new DateTime($start_time);
    $end = new DateTime($end_time);

    $interval = new DateInterval('PT15M');

    $current = clone $start;
    while ($current < $end) {
        $docSchedule[] = $current->format('h:i A');
        $current->add($interval);
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

