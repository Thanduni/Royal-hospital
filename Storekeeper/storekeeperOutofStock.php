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
        <?php
        $name = urlencode( $_SESSION['name']);
        include(BASEURL.'/Components/storekeeperTopbar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name . "&userRole=" . $_SESSION['userRole']. "&nic=" . $_SESSION['nic']);
        ?>
        <div class="arrow">
            <img src=<?php echo BASEURL . '/images/arrow-right-circle.svg' ?> alt="arrow">Out of Stock
        </div>

        <div class="wrapper">
            <div class="table">
                <div class="row headerT">
                    <div class="cell">Medicine name</div>
                    <div class="cell">Options</div>
                </div>
                <?php
                $sql = "select item.item_name from inventory inner join item on inventory.itemID=item.itemID where inventory.expiredDate > CURRENT_DATE 
                        group by inventory.itemID having sum(quantity)=0;";
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

<div id="userForm">
    <div id="form">
        <form method="post" onsubmit="return validateForm()" enctype="multipart/form-data" id="addForm"
              name="userForm">
            <div class="banner">
                <h1>Stock</h1>
            </div>
            <p class="royal">Royal Hospital Management System </p>
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
                    </td>
                </tr>
                <tr id="nicRow">
                    <td>
                        <label>Quantity</label>
                    </td>
                    <td colspan="2">
                        <input name="quantity" type="number" id="contact" placeholder="Enter Quantity here">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="Manufactured date">Manufactured date:</label>
                    </td>
                    <td colspan="2">
                        <input name="manufacturedDate" type="date" id="name" placeholder="Enter Manufactured date here" max="<?php echo date("Y-m-d") ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Expired date</label>
                    </td>
                    <td colspan="2">
                        <input name="expiredDate" type="date" id="name" placeholder="Enter Expired date here" min="<?php echo date('Y-m-d', strtotime('+1 week')); ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="issue">Describe your issue</label>
                    </td>
                    <td colspan="2">
                        <textarea id="issue" placeholder="Describe your issue in detail here" rows="3"></textarea>
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