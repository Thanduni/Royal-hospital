<?php
require_once("../conf/config.php");
if(isset($_POST['submit'])){

    $medicineName = $_POST['medicineName'];
    $companyName = $_POST['companyName'];
    $unitCost = $_POST['unitCost'];
    $unitQuantity = $_POST['unitQuantity'];
    $itemID = $_GET['id'];

    $sql="update `item` set item_name = '$medicineName',companyName = '$companyName',`unit_quantity` = '$unitQuantity', unit_price = '$unitCost' where itemID = '$itemID'";
    $result=mysqli_query($con,$sql);
}
header("Location: ". BASEURL . "/Storekeeper/storekeeperAddMedicine.php");
