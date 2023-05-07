<?php
require_once("../conf/config.php");

if(isset($_POST['submit'])){

    $itemID = $_POST['item_name'];
    $quantity = $_POST['quantity'];
    $manufacturedDate = $_POST['manufacturedDate'];
    $expiredDate = $_POST['expiredDate'];

//    $itemIDSql = "select itemID from item where item_name='".$medicineName."'";
//    $result=mysqli_query($con,$itemIDSql);
//    $itemID = mysqli_fetch_array($result, MYSQLI_ASSOC)['itemID'];

    $sql="insert into `inventory` (itemID, quantity, manufacturedDate, expiredDate) values 
    ('$itemID','$quantity' ,'$manufacturedDate','$expiredDate')";
    $result=mysqli_query($con,$sql);

}

header("Location: ". BASEURL . "/Storekeeper/storekeeperAddStock.php");
?>