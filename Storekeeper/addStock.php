<?php
require_once("../conf/config.php");

if(isset($_POST['submit'])){

    $itemID = $_POST['item_name'];
    $quantity = $_POST['quantity'];
    $unitQuantity = $_POST['unitQuantity'];
    $manufacturedDate = $_POST['manufacturedDate'];
    $expiredDate = $_POST['expiredDate'];

//    $itemIDSql = "select itemID from item where item_name='".$medicineName."'";
//    $result=mysqli_query($con,$itemIDSql);
//    $itemID = mysqli_fetch_array($result, MYSQLI_ASSOC)['itemID'];

    $sql="insert into `inventory` (itemID, quantity, unit_quantity, manufacturedDate, expiredDate) values 
    ('$itemID','$quantity' ,'$unitQuantity' ,'$manufacturedDate','$expiredDate')";
    $result=mysqli_query($con,$sql);

    if($result)
        die("success");
    else
        die($sql);
}

header("Location: ". BASEURL . "/Storekeeper/storekeeperAddStock.php");
?>