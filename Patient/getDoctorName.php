<?php
// connect to the database
require_once("../conf/config.php");

// get the selected doctor
$department= $_POST['depName'];

// query the database for the departments for the selected doctor
$sql = "SELECT doctorID, name FROM doctor inner join user on user.nic=doctor.nic WHERE department = '$department'";
$result = $con->query($sql);

// create an array of departments
$doctorNames = array();
while ($row = $result->fetch_assoc()) {
    $doctorNames[] = $row;
}

//echo(print_r($doctorNames));

// return the departments as JSON
echo json_encode($doctorNames);

?>

