<?php
session_start();
//die( $_SESSION['profilePic']);
require_once("../conf/config.php");
if (isset($_SESSION['mailaddress']) && isset($_SESSION['userRole']) && $_SESSION['userRole']=="Storekeeper") {
?> 

<?php

if(isset($_POST['submit'])){

    // $itemId = $_POST['itemID'];
    // $badgeNo = $_POST['badgeNo'];
    $medicineName = $_POST['medicineName'];
    // $companyName = $_POST['companyName'];
    // $supplierName = $_POST['supplierName'];
    // $unitType = $_POST['unitType'];
    // $unitCost = $_POST['unitCost'];
    $quantity = $_POST['quantity'];
    $manufacturedDate = $_POST['manufacturedDate'];
    $expiredDate = $_POST['expiredDate'];
    // $useState = $_POST['useState'];

    $sql="insert into `inventory` (medicineName,quantity,manufacturedDate,expiredDate) values ('$medicineName','$quantity','$manufacturedDate','$expiredDate')";
    // echo $sql;
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
    <title>Storekeeper Add Stock</title>
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
            <li class="logout"><a href="<?php echo BASEURL . '/Homepage/logout.php?logout' ?>">Logout
                    <img
                            src=<?php echo BASEURL . '/images/logout.svg' ?> alt="logout"></a>
            </li>
        </ul>
        <div class="arrow">
            <img src=<?php echo BASEURL . '/images/arrow-right-circle.svg' ?> alt="arrow">Add Stock
        </div>

        <div class="form-content">

        <div class="form-box">
        <h1>ADD STOCK</h1>
        
        <form method="post">
            <div class="row">
                <!-- <div class="column">
                    <label for="name">Item ID</label>
                    <input name="itemId" type="text" id="name" placeholder="Enter Item ID here">
                </div> -->
                <!-- <div class="column">
                    <label for="email">Badge no.</label>
                    <input name="badgeNo" type="text" id="email" placeholder="Enter Badge no. here">
                </div> -->
                <div class="column">
                    <label>Medicine name</label>

                    <select name="medicineName" id="">
                    <!-- <option>--Select--</option> -->
                    <?php
                    $sql="Select medicineName from `item`";
                    $result=mysqli_query($con,$sql);
                    
                    

                    
                        while($row=mysqli_fetch_assoc($result)){
                            $medicineName = $row['medicineName'];
                            

                        ?>
                    
                    <option value=<?php echo $medicineName ?>><?php echo $medicineName?></option>
                        
<?php } ?>
                    </select>
                    <!-- <input name="medicineName" type="text" id="email" placeholder="Enter Medicine name here"> -->
                </div>
                
                
            </div>

            <!-- <div class="row">
                <div class="column">
                    <label>Company Name</label>
                    <input name="companyName" type="text" id="name" placeholder="Enter Company Name here">
                </div></div>

            <div class="row">
                
                <div class="column">
                    <label>Supplier Name</label>
                    <input name="supplierName" type="text" id="email" placeholder="Enter Supplier Name here">
                </div>
                
            </div> -->
            <!-- <div class="row">
                <div class="column">
                    <label>Unit Type</label>
                    <select name="unitType" id="">
                        <option value="">Select type</option>
                        <option value="cards">cards</option>
                        <option value="bottles">bottles</option>
                        <option value="pills">pills</option>
                        <option value="injections">injections</option>
                        <option value="tablets">tablets</option>

                    </select>
                    <input name="unitType" type="text" id="subject" placeholder="Enter Unit Type here">
                </div>
                
               
                
            </div> -->

            

            <!-- <div class="row"><div class="column">
                    <label>Unit Cost</label>
                    <input name="unitCost" type="text" id="contact" placeholder="Enter Unit Cos here">
                </div></div> -->

            <div class="row"> <div class="column">
                    <label>Qantity</label>
                    <input name="quantity" type="text" id="contact" placeholder="Enter Qantity here">
                </div></div>

                <div class="row"> <div class="column">
                <div class="column">
                    <label>Manufactured date</label>
                    <input name="manufacturedDate" type="date" id="name" placeholder="Enter Manufactured date here">
                </div>
                    
            </div></div>
            <div class="row">
                
                <div class="column">
                    <label>Expired date</label>
                    <input name="expiredDate" type="date" id="name" placeholder="Enter Expired date here">
                </div>
                <!-- <div class="column">
                    <label for="email">Use state</label>
                    <input name="useState" type="text" id="email" placeholder="Enter Use state here">
                </div> -->
                
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