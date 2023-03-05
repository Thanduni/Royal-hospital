<?php

require_once("../conf/config.php");

if(isset($_POST['submit'])){

    $itemId = $_POST['itemID'];
    $medicineName = $_POST['medicineName'];
    $companyName = $_POST['companyName'];
    $unitType = $_POST['unitType'];
    $unitCost = $_POST['unitCost'];


    $sql="insert into `item` (item_name,companyName,unitType,unit_price) values('$medicineName','$companyName','$unitType','$unitCost')";
    $result=mysqli_query($con,$sql);
}
header("Location: ". BASEURL . "/Storekeeper/storekeeperAddMedicine.php");
