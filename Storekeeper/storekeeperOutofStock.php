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
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/style.css' ?>">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .next {
            position: initial;
            height: auto;
        }
    </style>
    <title>Storekeeper Out of Stock</title>
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
            <img src=<?php echo BASEURL . '/images/arrow-right-circle.svg' ?> alt="arrow">Out of Stock
        </div>

        <div class="pad">
            
        </div>
        <!-- content start -->

        <div class="wrapper">
            <div class="table">
                <div class="row headerT">
                    <div class="cell">Medicine name</div>
                    <div class="cell">Options</div>
                </div>
                <?php
                $sql = "select item.item_name from inventory inner join item on inventory.itemID=item.itemID where inventory.expiredDate > CURRENT_DATE group by inventory.itemID having sum(quantity)=0;";
                $result = mysqli_query($con, $sql);
                $num = mysqli_num_rows($result);

                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $item_name = $row['item_name'];
                        ?>
                        <div class="row">

                            <div class="cell" data-title="Medicine name">
                                <?php echo $item_name; ?>
                            </div>
                            <div class="cell" data-title="Options">
                                <button class="custom-btn">+Add stock</button>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>

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