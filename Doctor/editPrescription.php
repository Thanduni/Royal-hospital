<?php
require_once("../conf/config.php");

if(isset($_GET['drugName'])){
    $drugName = $_GET['drugName'];
    $$prescriptionID = $_GET['$prescriptionID '];
}

$sql = "SELECT * from prescribed_drugs where drug_name = drugName AND prescriptionID =$prescriptionID ";
$result = mysqli_query($con,$sql);

$row = mysqli_fetch_assoc($result);

echo '<form method="POST">';
echo '<input type="text" name="name" value="'.$row['drug_name'].'">';
echo '<input type="text" name="email" value="'.$row['quantity'].'">';
echo '<input type="text" name="email" value="'.$row['frequency'].'">';
echo '<input type="text" name="email" value="'.$row['days'].'">';
echo '<input type="submit" value="Save">';
echo '</form>';

if(isset($_POST['save'])){
    $drug_name = $_POST['drug_name'];
    $quantity = $_POST['quantity'];
    $frequency = $_POST['frequency'];
    $days = $_POST['days'];
}

$update = "UPDATE prescribed_drugs SET drug_name = $drug_name, quantity=$quantity, frequency=$frequency, days=$days;";
$update_query = mysqli_query($con,$update);

if($update_query){
    header("Location: prescription.php");
}
?>