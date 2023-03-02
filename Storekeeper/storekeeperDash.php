 <?php
session_start();
require_once("../conf/config.php");
if (isset($_SESSION['mailaddress']) && $_SESSION['userRole']=="Storekeeper") {
?> 

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/storekeeperStyle.css' ?>">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/storekeeperDash.css' ?>">
    <script src="https://kit.fontawesome.com/04b61c29c2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/style.css' ?>">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .next {
            position: initial;
            height: auto;
        }
    </style>
    <title>Storekeeper Dashboard</title>
</head>
<body>
<div class="user">
    <?php
    $name = urlencode( $_SESSION['name']);
    include(BASEURL . '/Components/storekeeperSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=".$name);?>
    <div class="userContents" id="center">
        <?php
        $name = urlencode( $_SESSION['name']);
        include(BASEURL.'/Components/storekeeperTopbar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name . "&userRole=" . $_SESSION['userRole']. "&nic=" . $_SESSION['nic']);
        ?>
        <div class="arrow">
            <img src=<?php echo BASEURL . '/images/arrow-right-circle.svg' ?> alt="arrow">Dashboard
        </div>

        <div class="pad">
            
        </div>
        <!-- content start -->


<!--        <div class="content">-->
        <div class="card-list">
            
        <div class="card">
        <!-- onclick='window.location.replace("google.com")' direct linking part farzan-->
        <!-- <a href="storekeeperTotalMedicine.php"> -->
            <div class="card-cont">
                
                <div class="card-h">
                    <p>Available Medicines</p>
                </div>

                <div class="card-m">
                    <?php
                        $sql = "SELECT itemID FROM item ORDER BY itemID";
                        $result = mysqli_query($con,$sql);
                        $row = mysqli_num_rows($result);
                        echo '<h1>'.$row.'</h1>';
                    ?>
                </div>

                <div class="card-b">
                    <a href="storekeeperTotalMedicine.php" target="_self">
                        <button>More details</button>
                    </a>
                </div>
                
                
            </div>

        </div>
</a>
        <div class="card">
            <div class="card-cont">
                
                <div class="card-h">
                    <p>Medicines in stock</p>
                </div>

                <div class="card-m">
                <?php
                        $sql = "select DISTINCT itemID from inventory where expiredDate > CURRENT_DATE and quantity > 0;";
                        $result = mysqli_query($con,$sql);
                        $row = mysqli_num_rows($result);
                        echo '<h1>'.$row.'</h1>';
                    ?>
                </div>

                <div class="card-b">
                    <a href="storekeeperAvailableMedicine.php">
                        <button>More details</button>
                    </a>
                </div>
                
            </div>

        </div>
        <div class="card">
        <!-- <a href="storekeeperOutofStock.php"> -->
            <div class="card-cont">
                
                <div class="card-h">
                    <p>Out of stock medicine</p>
                </div>

                <div class="card-m">
                <?php
                        $sql = "select * from inventory where expiredDate > CURRENT_DATE group by itemID having sum(quantity)=0";
                        $result = mysqli_query($con,$sql);
                        $row = mysqli_num_rows($result);
                        echo '<h1>'.$row.'</h1>';
                    ?>
                    <!-- <p>40</p> -->
                </div>

                <div class="card-b">
                    <a href="storekeeperOutofStock.php">
                        <button>More details</button>
                    </a>
                </div>
                
                
            </div>

        </div>
        <div class="card">
        <!-- <a href="storekeeperExpire.php"> -->
            <div class="card-cont">
                
                <div class="card-h">
                    <p>Expired medicine</p>
                </div>

                <div class="card-m">
                <?php
                         $sql = "SELECT * from inventory INNER JOIN item on inventory.itemID=item.itemID where expiredDate < CURRENT_DATE GROUP BY inventory.itemID;";
                         $result = mysqli_query($con,$sql);
                         $row = mysqli_num_rows($result);
                         echo '<h1>'.$row.'</h1>';
                    ?>
                    <!-- <p>40</p> -->
                </div>

                <div class="card-b">
                    <a href="storekeeperExpire.php">
                        <button>More details</button>
                    </a>
                </div>
                
                
            </div>

        </div>

    </div>
                
<!--                </div>-->
        <!-- content start -->
    </div>
</div>
</body>
</html>

    <?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>