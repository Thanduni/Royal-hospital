<?php

require_once("../conf/config.php");

if(isset($_GET['deleteid'])){
    $id=$_GET['deleteid'];
}

$sql="delete from `item` where itemID=$id";
$result=mysqli_query($con,$sql);
header("Location:".BASEURL. "/Storekeeper/storekeeperAddMedicine.php");
exit();
?>