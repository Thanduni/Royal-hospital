<?php
session_start();
//die( $_SESSION['profilePic']);
require_once("../conf/config.php");
if (isset($_SESSION['mailaddress']) && isset($_SESSION['userRole']) && $_SESSION['userRole']=="Storekeeper") {
?> 

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/storekeeperStyle.css' ?>">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/storekeeperViewStock.css' ?>">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .next {
            position: initial;
            height: auto;
        }
    </style>
    <title>Storekeeper View Stock</title>
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
            <img src=<?php echo BASEURL . '/images/arrow-right-circle.svg' ?> alt="arrow">View Stock
        </div>

        <div class="pad">
        <a href="storekeeperAddStock.php">   
            <button class="custom-btn">Add Stock</button>
        <a>
        </div>
        <!-- content start -->

        <div class="wrapper">
            <div class="table">
                <div class="row headerT">
                    <div class="cell">Medicine name</div>
                    <div class="cell">Badge number</div>
                    <div class="cell">Company name</div>
                    <div class="cell">Unit type</div>
                    <div class="cell">Unit cost</div>
                    <div class="cell">Quantity</div>
                    <div class="cell">Manufacture date</div>
                    <div class="cell">Expire date</div>
                    <div class="cell">Use state</div>
                    
                </div>
                <?php
                $sql = "select item.item_name, inventory.badgeNo, item.companyName, item.unitType, item.unit_price, inventory.quantity, inventory.manufacturedDate, inventory.expiredDate from item inner join inventory on item.itemID=inventory.itemID;";
                $allResult = mysqli_query($con, $sql);
                $num = mysqli_num_rows($allResult);

                $numberPages = 8;
                $totalPages = ceil($num / $numberPages);



                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }

                $startinglimit = ($page - 1) * $numberPages;
                $sql = "select item.item_name, inventory.badgeNo, item.companyName, item.unitType, item.unit_price, inventory.quantity, inventory.manufacturedDate, inventory.expiredDate from item inner join inventory on item.itemID=inventory.itemID limit " . $startinglimit . ',' . $numberPages;
                $result = mysqli_query($con, $sql);

                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $item_name = $row['item_name'];
                        $batchNo = $row['badgeNo'];
                        $companyName = $row['companyName'];
                        $unitType = $row['unitType'];
                        $unitCost = $row['unit_price'];
                        $quantity = $row['quantity'];
                        $manDate = $row['manufacturedDate'];
                        $expiredDate = $row['expiredDate'];
                        if(date("Y-m-d") < $expiredDate)
                            $useState = 'Available';
                        else
                            $useState = 'Out of stock';
                        ?>
                        <div class="row">

                            <div class="cell" data-title="Medicine name">
                                <?php echo $item_name; ?>
                            </div>
                            <div class="cell" data-title="Badge number">
                                <?php echo $batchNo; ?>
                            </div>
                            <div class="cell" data-title="Company name">
                                <?php echo $unitType; ?>
                            </div>
                            <div class="cell" data-title="Unit type">
                                <?php echo $unitCost; ?>
                            </div>
                            <div class="cell" data-title="Unit cost">
                                <?php echo $unitCost; ?>
                            </div>
                            <div class="cell" data-title="Quantity">
                                <?php echo $quantity; ?>
                            </div>
                            <div class="cell" data-title="Manufacture date">
                                <?php echo $manDate; ?>
                            </div>
                            <div class="cell" data-title="Expire date">
                                <?php echo $expiredDate; ?>
                            </div>
                            <div class="cell" data-title="Use state">
                                <?php echo $useState; ?>
                            </div>
                            
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>

        <!-- pagination buttons -->
        

        <div class="pagination-container">
        <div class="pagination">
          <ul class="pagination-2">

          <?php
            for($btn=1;$btn<=$totalPages;$btn++){
                echo '<li class="page-number active"><a href="storekeeperViewStock.php?page='.$btn.'">'.$btn.'</a></li>';
            }

          ?>
            <!-- <li class="page-number prev"><a href="#">&laquo;</a></li>
            <li class="page-number"><a href="#">1</a></li>
            <li class="page-number active"><a href="#">2</a></li>
            <li class="page-number prev"><a href="#">&raquo;</a></li> -->
          </ul>
        </div>
        </div>


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