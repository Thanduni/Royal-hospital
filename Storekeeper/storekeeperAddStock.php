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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://kit.fontawesome.com/04b61c29c2.js" crossorigin="anonymous"></script>
        <script src=<?php echo BASEURL . '/js/filterElements.js' ?>></script>
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

        <?php
        $name = urlencode( $_SESSION['name']);
        include(BASEURL . '/Components/storekeeperSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name); ?>
        <div class="userContents" id="center">
            <?php
            $name = urlencode( $_SESSION['name']);
            include(BASEURL.'/Components/storekeeperTopbar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name . "&userRole=" . $_SESSION['userRole']. "&nic=" . $_SESSION['nic']);
            ?>
            <div class="arrow">
                <img src="../images/arrow-right-circle.svg" alt="arrow">Stock
            </div>
            <p>
                <script src="<?php echo BASEURL . '/js/addUser.js' ?>"></script>
                <button type="button" id="addButton" class="custom-btn" class="custom-btn" onclick="">+Add stock</button>
            </p>

            <div class="filter">
                <input type="text" id="myInputName" onkeyup="filterByMedicine()" placeholder="Search for names.." title="Type in a name">
                <div style="position: relative; color: green; top: 8px; margin: 14px;font-weight: 600;"> In Stock </div>
                <input class="filter" type="checkbox" id="switch" onchange="filterExpired()" /><label for="switch">Toggle</label>
                <div style="position: relative;color: red; top: 5px; margin: 14px; font-weight: 600;">Expired</div>
            </div>

            <?php
            if (@$_GET['msg']) {
                ?>
                <div class="alert">
                    <?php
                    echo $_GET["msg"];
                    ?>
                </div>
            <?php }?>
            <div class="userClass">
                <?php
                $query = "select item.item_name, inventory.badgeNo, item.companyName, item.unit_price, item.unit_quantity, inventory.quantity, 
                          inventory.manufacturedDate, inventory.expiredDate from item inner join inventory on item.itemID=inventory.itemID;";
                $result = mysqli_query($con, $query);
                if (!$result) die("Database access failed: " . $con->error);
                $rows = $result->num_rows;

                ?>


                <div class="wrapper">
                    <div class="table">
                        <div class="row headerT">
                            <div class="cell">Medicine name</div>
                            <div class="cell">Badge number</div>
                            <div class="cell">Company name</div>
                            <div class="cell">Unit cost</div>
                            <div class="cell">Quantity</div>
                            <div class="cell">Unit quantity</div>
                            <div class="cell">Manufactured date</div>
                            <div class="cell">Expired date</div>
                            <div class="cell">Use state</div>
                        </div>
                        <?php
                        if ($result) {
                            while ($row = mysqli_fetch_array($result)) {
                                ?>
                                        <?php
                                $item_name = $row['item_name'];
                                $batchNo = $row['badgeNo'];
                                $companyName = $row['companyName'];
                                $unitCost = $row['unit_price'];
                                $quantity = $row['quantity'];
                                $manDate = $row['manufacturedDate'];
                                $expiredDate = $row['expiredDate'];
                                $unitQuantity = $row['unit_quantity'];
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
                                        <?php echo $companyName; ?>
                                    </div>
                                    <div class="cell" data-title="Unit cost">
                                        <?php echo $unitCost; ?>
                                    </div>
                                    <div class="cell" data-title="Quantity">
                                        <?php echo $quantity; ?>
                                    </div>
                                    <div class="cell" data-title="Unit quantity">
                                        <?php echo $unitQuantity; ?>
                                    </div>
                                    <div class="cell" data-title="Manufacture date">
                                        <?php echo $manDate; ?>
                                    </div>
                                    <div class="cell" data-title="Expire date">
                                        <?php echo $expiredDate; ?>
                                    </div>
                                    <div class="cell" data-title="Use state">
                                <?php if(date("Y-m-d") < $expiredDate) {?>
                                    <div class="cell inStock">In Stock</div>
                                <?php } else { ?>
                                    <div class="cell expired">Expired</div>
                                <?php } ?>
                                    </div>

                                </div>

                            <?php } }?>
                    </div>
                </div>
                <!-- pagination buttons -->
            </div>

        </div>
        <div id="userForm">
            <div id="form">
                <form method="post" action="<?php echo BASEURL . '/Storekeeper/addStock.php' ?>" enctype="multipart/form-data" id="addForm" name="userForm">
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
                                        <option value=<?php echo $medicineID ?>><?php echo $medicineName?></option>
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
                                <button class="custom-btn" name="cancel" id="cancel">Cancel</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>

    </div>
    <!-- content start -->

    <script>
        // alert("asfsdfsdf");
        // let switchButton = document.getElementById("switch");
        // alert(switchButton);


        function filterExpired(){
            var table, row, cell, i;
            table = document.getElementsByClassName("table")[0];
            row = table.getElementsByClassName("row");
            let switchButton = document.getElementById("switch");
            if(switchButton.checked){
                // alert("Checked");
                for (i = 1; i < row.length; i++) {
                    cell = row[i].getElementsByClassName("cell")[8];
                    if(cell.textContent.trim() === "Expired"){
                        row[i].style.display = "";
                    }
                    else{
                        row[i].style.display = "none";
                    }
                }
            }else{
                for (i = 1; i < row.length; i++) {
                    cell = row[i].getElementsByClassName("cell")[8];
                    if(cell.textContent.trim() === "In Stock".trim()){
                        row[i].style.display = "";
                    }
                    else{
                        row[i].style.display = "none";
                    }
                }
            }
        }
    </script>
    <script src=<?php echo BASEURL . '/js/ValidateForm.js' ?>></script>
    <script src=<?php echo BASEURL . '/js/updateMedicine.js' ?>></script>
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

    <!-- content start -->
    </body>
    </html>

    <?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>