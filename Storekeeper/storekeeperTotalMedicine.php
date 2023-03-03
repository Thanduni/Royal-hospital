<?php
session_start();
//die( $_SESSION['profilePic']);
require_once("../conf/config.php");
if (isset($_SESSION['mailaddress']) && $_SESSION['userRole']=="Storekeeper") {
?> 

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/style.css' ?>">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/storekeeperStyle.css' ?>">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/storekeeperAddMedicine.css' ?>">
    <script src="https://kit.fontawesome.com/04b61c29c2.js" crossorigin="anonymous"></script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .next {
            position: initial;
            height: auto;
        }
    </style>
    <title>Storekeeper Medicine Log</title>
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
            <img src=<?php echo BASEURL . '/images/arrow-right-circle.svg' ?> alt="arrow">Medicine Log
        </div>

        <div class="pad">
            
        </div>
        <!-- content start -->



        <div class="wrapper">
            <div class="table">
                <div class="row headerT">
                    <div class="cell">Medicine name</div>
                    <div class="cell">Company name</div>
                    <div class="cell">Unit type</div>
                    <div class="cell">Unit cost</div>
                    <div class="cell">Items remaining</div>
                    <div class="cell">Use state</div>
                    <div class="cell">Options</div>
                </div>
                <?php
                $sql = "SELECT q.item_name, q.companyName, q.unitType, q.unit_price, SUM(quantity) FROM inventory p inner join item q on p.itemID = q.itemID where CURRENT_DATE > p.expiredDate GROUP BY p.itemID;";
                $result = mysqli_query($con, $sql);
                $num = mysqli_num_rows($result);

                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $item_name = $row['item_name'];
                        $companyName = $row['companyName'];
                        $unitType = $row['unitType'];
                        $unitCost = $row['unit_price'];
                        ?>
                        <div class="row">

                            <div class="cell" data-title="Medicine name">
                                <?php echo $item_name; ?>
                            </div>
                            <div class="cell" data-title="Company name">
                                <?php echo $companyName; ?>
                            </div>
                            <div class="cell" data-title="Unit type">
                                <?php echo $unitType; ?>
                            </div>
                            <div class="cell" data-title="Unit cost">
                                <?php echo $unitCost; ?>
                            </div>
                            <div class="cell" data-title="Items remaining">
                                <?php echo $row['SUM(quantity)']; ?>
                            </div>
                            <div class="cell" data-title="Use state">
                                <div class="expired">Expired</div>
                            </div>
                            <div class="cell" data-title="Options">
                                <button class="custom-btn">+ Add stock</button>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
                <?php
                $sql = "SELECT q.item_name, q.companyName, q.unitType, q.unit_price, SUM(quantity) FROM inventory p inner join item q on p.itemID = q.itemID where CURRENT_DATE < p.expiredDate GROUP BY p.itemID;";
                $result = mysqli_query($con, $sql);
                $num = mysqli_num_rows($result);

                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $item_name = $row['item_name'];
                        $companyName = $row['companyName'];
                        $unitType = $row['unitType'];
                        $unitCost = $row['unit_price'];
                        ?>
                        <div class="row">

                            <div class="cell" data-title="Medicine name">
                                <?php echo $item_name; ?>
                            </div>
                            <div class="cell" data-title="Company name">
                                <?php echo $companyName; ?>
                            </div>
                            <div class="cell" data-title="Unit type">
                                <?php echo $unitType; ?>
                            </div>
                            <div class="cell" data-title="Unit cost">
                                <?php echo $unitCost; ?>
                            </div>
                            <div class="cell" data-title="Items remaining">
                                <?php echo $row['SUM(quantity)']; ?>
                            </div>
                            <div class="cell" data-title="Use state">
                                <div class="inStock">In Stock</div>
                            </div>
                            <div class="cell" data-title="Options">
                                <button class="custom-btn">+ Add stock</button>
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


    </div>
</div>
</body>
</html>

    <?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>