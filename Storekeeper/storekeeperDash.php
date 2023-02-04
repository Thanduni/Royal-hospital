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
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/storekeeperDash.css' ?>">
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
                    <p>Total medicines</p>
                </div>

                <div class="card-m">
                    <?php
                        $sql = "SELECT itemID FROM item ORDER BY itemID";
                        $result = mysqli_query($con,$sql);
                        $row = mysqli_num_rows($result);
//                        if($result)
//                            die("success");
//                        else
//                            die("Fail");
                        echo '<h1>'.$row.'</h1>';
                    ?>
                    <!-- <p>40</p> -->
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
        <!-- <a href="storekeeperAvailableMedicine.php"> -->
            <div class="card-cont">
                
                <div class="card-h">
                    <p>Available medicine</p>
                </div>

                <div class="card-m">
                <?php
                        $sql = "SELECT medicineName FROM availableitemstock WHERE fullQuantity>0";
                        $result = mysqli_query($con,$sql);
                        $row = mysqli_num_rows($result);
                        echo '<h1>'.$row.'</h1>';
                    ?>
                    <!-- <p>40</p> -->
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
                        $sql = "SELECT * FROM `availableitemstock` WHERE fullQuantity=0";
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
                        // $sql = "SELECT itemID FROM inventory ORDER BY itemID";
                        // $result = mysqli_query($con,$sql);
                        // $row = mysqli_num_rows($result);
                        // echo '<h1>'.$row.'</h1>';
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
        <?php echo "hgjh" ?>
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