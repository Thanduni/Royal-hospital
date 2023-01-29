<?php
session_start();
//die( $_SESSION['profilePic']);
require_once("../conf/config.php");
if (isset($_SESSION['mailaddress']) && isset($_SESSION['userRole']) && $_SESSION['userRole']=="Storekeeper") {
?> 

<?php

if(isset($_POST['submit'])){

    $itemId = $_POST['itemID'];
    $badgeNo = $_POST['badgeNo'];
    $medicineName = $_POST['medicineName'];
    $companyName = $_POST['companyName'];
    $supplierName = $_POST['supplierName'];
    $unitType = $_POST['unitType'];
    $unitCost = $_POST['unitCost'];
    $qantity = $_POST['quantity'];
    $manufacturedDate = $_POST['manufactureDate'];
    $expiredDate = $_POST['expireDate'];
    $useState = $_POST['useState'];

    $sql="insert into `inventory` (itemID,medicineName,badgeNo,companyName,supplierName,unitType,unitCost,quantity,manufactureDate,expireDate,useState) values('$itemId','$badgeNo','$medicineName','$companyName','$supplierName','$unitType','$unitCost','$qantity','$manufacturedDate','$expiredDate','$useState')";

    $result=mysqli_query($con,$sql);

}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/storekeeperStyle.css' ?>">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/storekeeperAddMedicine.css' ?>">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .next {
            position: initial;
            height: auto;
        }
    </style>
    <title>Storekeeper Add Medicine</title>
</head>
<body>
<div class="user">
    <?php include(BASEURL . '/Components/storekeeperSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $_SESSION['name']); ?>
    <div class="userContents" id="center">
        <div class="title">
            <img src="<?php echo BASEURL . '/images/logo5.png' ?>" alt="logo">
            Royal Hospital Management System
        </div>
        <ul>
            <li class="userType"><img src=<?php echo BASEURL . '/images/userInPage.svg' ?> alt="Storekeeper">
                Storekeeper
            </li>
            <li class="logout"><a href="<?php echo BASEURL . '/Homepage/Logout?url=' . $_SERVER['REQUEST_URI'] ?>">Logout
                    <img
                            src=<?php echo BASEURL . '/images/logout.jpg' ?> alt="logout"></a>
            </li>
        </ul>
        <div class="arrow">
            <img src=<?php echo BASEURL . '/images/arrow-right-circle.svg' ?> alt="arrow">Add Medicine
        </div>

        <!-- <div class="pad">
            
        </div> -->
        <div class="form-content">

        <div class="pad">
            
        </div>



        <div class="form-box">
        <h1>ADD MEDICINE</h1>
        
        <form method="post">
            <div class="row">
                <div class="column">
                    <label for="name">Item ID</label>
                    <input name="itemId" type="text" id="name" placeholder="Enter Item ID here">
                </div>
                <div class="column">
                    <label for="email">Badge no.</label>
                    <input name="badgeNo" type="text" id="email" placeholder="Enter Badge no. here">
                </div>
                <div class="column">
                    <label for="email">Medicine name</label>
                    <input name="medicineName" type="text" id="email" placeholder="Enter Medicine name here">
                </div>
                
                
            </div>
            <div class="row">
                <div class="column">
                    <label for="name">Company Name</label>
                    <input name="companyName" type="text" id="name" placeholder="Enter Company Name here">
                </div>
                <div class="column">
                    <label for="email">Supplier Name</label>
                    <input name="supplierName" type="text" id="email" placeholder="Enter Supplier Name here">
                </div>
                
            </div>
            <div class="row">
                <div class="column">
                    <label for="subject">Unit Type</label>
                    <input name="unitType" type="text" id="subject" placeholder="Enter Unit Type here">
                </div>
                <div class="column">
                    <label for="contact">Unit Cost</label>
                    <input name="unitCost" type="text" id="contact" placeholder="Enter Unit Cos here">
                </div>
                <div class="column">
                    <label for="contact">Qantity</label>
                    <input name="qantity" type="text" id="contact" placeholder="Enter Qantity here">
                </div>
                
            </div>
            <div class="row">
                <div class="column">
                    <label for="name">Manufactured date</label>
                    <input name="manufacturedDate" type="text" id="name" placeholder="Enter Manufactured date here">
                </div>
                <div class="column">
                    <label for="name">Expired date</label>
                    <input name="expiredDate" type="text" id="name" placeholder="Enter Expired date here">
                </div>
                <div class="column">
                    <label for="email">Use state</label>
                    <input name="useState" type="text" id="email" placeholder="Enter Use state here">
                </div>
                
            </div>
            
            <!-- <div class="row">
                <div class="column">
                    <label for="issue">Describe your issue</label>
                    <textarea id="issue" placeholder="Describe your issue in detail here" rows="3"></textarea>
                </div>
            </div> -->
            <button name="submit">Submit</button>
        </form>
    </div>
            
        </div>
        <!-- content start -->


        <!-- content start -->
        <?php include(BASEURL . '/Components/Footer.php'); ?>
    </div>
</div>
</body>
</html>

    <?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>