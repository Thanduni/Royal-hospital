<?php
require_once("../conf/config.php");
if(isset($_POST['submit'])){

    $itemId = $_POST['itemID'];
    $medicineName = $_POST['medicineName'];
    $companyName = $_POST['companyName'];
    $unitType = $_POST['unitType'];
    $unitCost = $_POST['unitCost'];
    $itemID = $_GET['id'];

    $sql="update `item` set item_name = '$medicineName',companyName = '$companyName',unitType = '$unitType',unit_price = '$unitCost' where itemID = '$itemID'";
    $result=mysqli_query($con,$sql);
}
header("Location: ". BASEURL . "/Storekeeper/storekeeperAddMedicine.php");
