<?php
//add medicine page
require_once("../conf/config.php");

if(isset($_POST['submit'])){

    $itemId = $_POST['itemID'];
    $medicineName = $_POST['medicineName'];
    $companyName = $_POST['companyName'];
    $unitCost = $_POST['unitCost'];
    $unitQuantity = $_POST['unitQuantity'];

    $sql="insert into `item` (item_name,companyName,unit_price, unit_quantity) values('$medicineName','$companyName','$unitCost', '$unitQuantity')";
    $result=mysqli_query($con,$sql);
}
header("Location: ". BASEURL . "/Storekeeper/storekeeperAddMedicine.php");
