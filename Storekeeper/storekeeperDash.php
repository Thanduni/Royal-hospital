<!-- importing configaration file -->
 
<?php
session_start();
require_once("../conf/config.php");
if (isset($_SESSION['mailaddress']) && $_SESSION['userRole']=="Storekeeper") {
?>

<!-- html heading part -->
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/storekeeperDash.css' ?>">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/storekeeperStyle.css' ?>">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/storekeeperAddMedicine.css' ?>">
    <script src="https://kit.fontawesome.com/04b61c29c2.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
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

<!-- html body part -->

<body>

<div class="user">

        <!-- importing storekeeper sidebar -->
    <?php
        $name = urlencode( $_SESSION['name']);
        include(BASEURL . '/Components/storekeeperSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=".$name);
    ?>

    <div class="userContents" id="center">
        
    <!-- importing storkeeper topbar -->
        <?php
        $name = urlencode( $_SESSION['name']);
        include(BASEURL.'/Components/storekeeperTopbar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name . "&userRole=" . $_SESSION['userRole']. "&nic=" . $_SESSION['nic']);
        ?>

    <!-- icone and dashbord  -->
        <div class="arrow">
            <img src=<?php echo BASEURL . '/images/arrow-right-circle.svg' ?> alt="arrow">Dashboard
        </div>
        <!-- medicine stock profile user cards -->
        <div class="actorCards">

                <ul>
                    <!-- medicine card -->
                    <a href="<?php echo BASEURL . '/Storekeeper/storekeeperAddMedicine.php' ?>">
                        <li class="tab-cards" id="bills">
                            Medicine
                            <div>
                                <img class="cardIcon" style="float: right" src="<?php echo BASEURL."/images/medicine.png"?>" alt="">
                            </div>
                        </li>
                    </a>
                    <!-- stock card -->
                    <a href="<?php echo BASEURL . '/Storekeeper/storekeeperAddStock.php' ?>">
                        <li class="tab-cards" id="bills">Stock
                            <div>
                                <img class="cardIcon" right" src="<?php echo BASEURL."/images/stock.png"?>" alt="">
                            </div>
                        </li>
                    </a>
                    <!-- profile card -->
                    <a href="<?php echo BASEURL . '/Storekeeper/updateStorekeeperProfile.php' ?>">
                        <li class="tab-cards" id="profile">Profile
                            <div>
                                <img class="cardIcon" style="float: right" src="<?php echo BASEURL."/images/profile.png"?>" alt="">
                            </div>
                        </li>
                    </a>
                </ul>
            </div>


            <!-- wrappers and card list components about instock expired filter,
            add stock shortcut and out of medicine card -->
        <div class="tableCardPack">

        <!-- instock expired filter wrapper -->
            <div class="wrapper">
                <div class="filter" style="justify-content: center; margin-bottom: 20px; margin-left: 0">
                    <div style="position: relative; color: green; top: 8px; margin: 14px;font-weight: 600;"> In Stock </div>
                    <input class="filter" type="checkbox" id="switch" /><label for="switch">Toggle</label>
                    <div style="position: relative;color: red; top: 5px; margin: 14px; font-weight: 600;">Expired</div>
                </div>
                <div class="table">
                    <div class="row headerT">
                        <div class="cell">Medicine name</div>
                        <div class="cell">Items remaining</div>
                        <div class="cell">Use state</div>
                    </div>
                    <?php
                    $sql = "SELECT q.itemID, q.item_name, q.companyName, q.unit_price, SUM(quantity) FROM inventory p inner join item q on p.itemID = q.itemID where CURRENT_DATE > p.expiredDate GROUP BY p.itemID;";
                    $result = mysqli_query($con, $sql);
                    $num = mysqli_num_rows($result);

                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $item_ID = $row['itemID'];
                            $item_name = $row['item_name'];
                            $companyName = $row['companyName'];
                            $unitCost = $row['unit_price'];
                            ?>
                            <div class="row">

                                <div class="cell" data-title="Medicine name">
                                    <?php echo $item_name; ?>
                                </div>
                                <div class="cell" data-title="Items remaining">
                                    <?php echo $row['SUM(quantity)']; ?>
                                </div>
                                <div class="cell" data-title="Use state">
                                    <div class="expired cell">Expired</div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                    <?php
                    $sql = "SELECT q.itemID, q.item_name, q.companyName, q.unit_price, SUM(quantity) FROM inventory p inner join item q on p.itemID = q.itemID where CURRENT_DATE < p.expiredDate GROUP BY p.itemID;";
                    $result = mysqli_query($con, $sql);
                    $num = mysqli_num_rows($result);

                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $item_ID = $row['itemID'];
                            $item_name = $row['item_name'];
                            $companyName = $row['companyName'];
                            $unitCost = $row['unit_price'];
                            ?>
                            <div class="row">

                                <div class="cell" data-title="Medicine name">
                                    <?php echo $item_name; ?>
                                </div>
                                <div class="cell" data-title="Items remaining">
                                    <?php echo $row['SUM(quantity)']; ?>
                                </div>
                                <div class="cell" data-title="Use state">
                                    <div class="inStock cell">In Stock</div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
                    <!--  add stock shortcut wrapper-->
            <div class="wrapper">
                <div class="table">
                    <div class="row headerT">
                        <div class="cell">Medicine name</div>
                        <div class="cell">Options</div>
                    </div>
                    <?php
                    $sql = "SELECT * FROM item";
                    $result = mysqli_query($con, $sql);
                    $num = mysqli_num_rows($result);

                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $item_ID = $row['itemID'];
                            $item_name = $row['item_name'];
                            $companyName = $row['companyName'];
                            $unitCost = $row['unit_price'];
                            ?>
                            <div class="row">

                                <div class="cell" data-title="Medicine name">
                                    <?php echo $item_name; ?>
                                </div>
                                <div class="cell" data-title="Options">
                                    <button class="custom-btn" id="<?php echo $item_ID ?>" onclick="displayStockForm('<?php echo $item_name ?>');">
                                        + Add stock
                                    </button>
                                    <script type="text/javascript">
                                        $(function(){
                                            $('#<?php echo $item_ID ?>').click(function(){
                                                $('#userForm').fadeIn().css("display","flex");
                                            });
                                        });
                                    </script>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>


            <!-- out of stock medicine card -->
            <div class="card-list">
                </a>
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
                                <button class="custom-btn">More details</button>
                            </a>
                        </div>


                    </div>

                </div>
            </div>

        </div>


    </div>
</div>

<!-- add stock popup form -->
<div id="userForm">
    <div id="form">
        <form method="post" action="<?php echo BASEURL . '/Storekeeper/addStock.php' ?>" enctype="multipart/form-data" id="addForm"
              name="userForm">
            <div class="banner">
                <h1>Stock</h1>
            </div>
            <p class="royal">Royal Hospital </p>
            <p class="addUser" id="titleOperation">Add stock</p>
            <table>
                <tr colspan="3">
                    <div class="alert" id="warning"></div>
                </tr>
                <tr id="nicRow">
                    <td>
                        <label for="medicineName">Medicine name:</label>
                    </td>
                    <td colspan="2">
                        <select name="item_name" id="" required>
                            <?php
                            $sql="Select * from `item`";
                            $result=mysqli_query($con,$sql);
                            while($row=mysqli_fetch_assoc($result)){
                                $medicineName = $row['item_name'];
                                $medicineID = $row['itemID'];
                                ?>
                                <option value='<?php echo $medicineID ?>'><?php echo $medicineName?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr id="nicRow">
                    <td>
                        <label>Quantity</label>
                    </td>
                    <td colspan="2">
                        <input name="quantity" type="number" min="1" id="contact" placeholder="Enter Quantity here" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="Manufactured date">Manufactured date:</label>
                    </td>
                    <td colspan="2">
                        <input name="manufacturedDate" type="date" id="name" placeholder="Enter Manufactured date here" max="<?php echo date("Y-m-d") ?>" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Expired date</label>
                    </td>
                    <td colspan="2">
                        <input name="expiredDate" type="date" id="name" placeholder="Enter Expired date here" min="<?php echo date('Y-m-d', strtotime('+1 week')); ?>" required>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2">
                        <button class="custom-btn" name="submit">Submit</button>
                        <button class="custom-btn" id="cancel">Cancel</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<script src=<?php echo BASEURL . '/js/updateMedicine.js' ?>></script>
<script>
    let switchButton = document.getElementById("switch");

    switchButton.addEventListener("change", function(){
        var table, row, cell, i;
        table = document.getElementsByClassName("table")[0];
        // alert(table);
        row = table.getElementsByClassName("row");
        if(this.checked){
            // alert("Checked");
            for (i = 1; i < row.length; i++) {
                cell = row[i].getElementsByClassName("cell")[2];
                if(cell.textContent.trim() === "Expired"){
                    row[i].style.display = "";
                }
                else{
                    row[i].style.display = "none";
                }
            }
        }else{
            for (i = 1; i < row.length; i++) {
                cell = row[i].getElementsByClassName("cell")[2];
                if(cell.textContent.trim() === "In Stock".trim()){
                    row[i].style.display = "";
                }
                else{
                    row[i].style.display = "none";
                }
            }
        }
    })
</script>
<script type="text/javascript">
    $(function(){
        $('#addButton').click(function(){
            $('#userForm').fadeIn().css("display","flex");
        });
        $('#cancel').click(function(){
            $('#userForm').fadeOut();
        });
    });
</script>
</body>
</html>

    <?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>