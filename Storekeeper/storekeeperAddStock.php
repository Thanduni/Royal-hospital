<?php
session_start();
//die( $_SESSION['profilePic']);
require_once("../conf/config.php");
if (isset($_SESSION['mailaddress']) && $_SESSION['userRole']=="Storekeeper") {
?> 

<?php

if(isset($_POST['submit'])){

    $medicineName = $_POST['item_name'];
    $quantity = $_POST['quantity'];
    $manufacturedDate = $_POST['manufacturedDate'];
    $expiredDate = $_POST['expiredDate'];

    $itemIDSql = "select itemID from item where item_name='".$medicineName."'";
    $result=mysqli_query($con,$itemIDSql);
    $itemID = mysqli_fetch_array($result, MYSQLI_ASSOC)['itemID'];

    $sql="insert into `inventory` (itemID, quantity, manufacturedDate, expiredDate) values ('$itemID','$quantity','$manufacturedDate','$expiredDate')";
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
    <?php
    $name = urlencode( $_SESSION['name']);
    include(BASEURL . '/Components/storekeeperSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=".$name);?>
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
                <div class="column">
                    <label>Medicine name</label>

                    <select name="item_name" id="">
                    <?php
                    $sql="Select * from `item`";
                    $result=mysqli_query($con,$sql);
                    
                    

                    
                        while($row=mysqli_fetch_assoc($result)){
                            $medicineName = $row['item_name'];
                            

                        ?>
                    
                    <option value=<?php echo $medicineName ?>><?php echo $medicineName?></option>
                        
<?php } ?>
                    </select>
                    <!-- <input name="medicineName" type="text" id="email" placeholder="Enter Medicine name here"> -->
                </div>
                
                
            </div>

<!--            <div class="row">-->
<!--                <div class="column">-->
<!--                    <label>Unit Type</label>-->
<!--                    <select name="unitType" id="" value="">-->
<!--                        <option value="">Select type</option>-->
<!--                        <option value="cards">cards</option>-->
<!--                        <option value="bottles">bottles</option>-->
<!--                        <option value="pills">pills</option>-->
<!--                        <option value="injections">injections</option>-->
<!--                        <option value="tablets">tablets</option>-->
<!---->
<!--                    </select>-->
<!---->
<!--                    <input name="unitType" type="text" id="subject" placeholder="Enter Unit Type here">-->
<!--                </div>-->
<!--                -->
<!--               -->
<!--                -->
<!---->
<!--            </div>-->

            <div class="row"> <div class="column">
                    <label>Quantity</label>
                    <input name="quantity" type="number" id="contact" placeholder="Enter Quantity here">
                </div></div>



            <div class="row">
                
                <div class="column">

                    <label>Manufactured date</label>
                    <input name="manufacturedDate" type="date" id="name" placeholder="Enter Manufactured date here" max="<?php echo date("Y-m-d") ?>">
                </div>
                <div class="column">
                    <label>Expired date</label>
                    <input name="expiredDate" type="date" id="name" placeholder="Enter Expired date here" min="<?php echo date('Y-m-d', strtotime('+1 week')); ?>">
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