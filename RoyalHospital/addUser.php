<?php
require_once("DBconnect.php");

//  if ($con->connect_error) die($con->connect_error);
if(isset($_POST['addUser'])){
    $nic = $_POST['nic'];
    $query = "INSERT INTO users(nic, name, address, email, contact_num, gender, password, user_role) VALUES('$nic', '$_POST['name']', '$_POST['address']', '$_POST['email']', '$_POST['address']', $_POST['contactNum'], $_POST['Gender'], $_POST['userRole'])";
    $result = mysqli_query($con, $query);
}
 $result = $conn->query($query);
 if (!$result) die ("Database access failed: " . $conn->error);
?>