<?php
session_start();
//die( $_SESSION['profilePic']);
require_once("../conf/config.php");
if (isset($_SESSION['mailaddress']) && isset($_SESSION['userRole']) && $_SESSION['userRole']=="Storekeeper") {
?> 

<?php

if(isset($_POST['submit'])){

    $itemId = $_POST['itemID'];
    $medicineName = $_POST['medicineName'];
    $companyName = $_POST['companyName'];
    $unitType = $_POST['unitType'];
    $unitCost = $_POST['unitCost'];
    

    $sql="insert into `item` (item_name,companyName,unitType,unit_price) values('$medicineName','$companyName','$unitType','$unitCost')";
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
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/style.css' ?>">
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
            <img src="../images/arrow-right-circle.svg" alt="arrow">User
        </div>
        <p>
            <script src="<?php echo BASEURL . '/js/addUser.js' ?>"></script>
            <button type="button" id="addButton" class="custom-btn" class="custom-btn" onclick="">+Add medicine</button>
        </p>

        <div class="filter">
            <input type="text" id="myInputName" onkeyup="filterByNameUsers()" placeholder="Search for names.." title="Type in a name">
            <input type="text" id="myInputRole" onkeyup="filterByRoleUsers()" placeholder="Search for user role.." title="Type in a name">
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
            $query = "SELECT * FROM item";
            $result = mysqli_query($con, $query);
            if (!$result) die("Database access failed: " . $con->error);
            $rows = $result->num_rows;

            ?>


            <div class="wrapper">
                <div class="table">
                    <div class="row headerT">
                        <div class="cell">Item name</div>
                        <div class="cell">Company Name</div>
                        <div class="cell">Unit price</div>
                        <div class="cell">Unit type</div>
                        <div class="cell">Options</div>

                    </div>
                    <?php
                    if ($result) {
                        while ($row = mysqli_fetch_array($result)) {
                            ?>
                            <ul class="tableCon">
                                <li class="<?php echo $row[0] ?>_tableCon"><?php echo $row[1] ?></li>
                                <li class="<?php echo $row[0] ?>_tableCon"><?php echo $row[2] ?></li>
                                <li class="<?php echo $row[0] ?>_tableCon"><?php echo $row[3] ?></li>
                                <li class="<?php echo $row[0] ?>_tableCon"><?php echo $row[4] ?></li>
                            </ul>
                            <!--                        <div id="UDfunc">-->
                            <div class="row">
                                <div class="cell" data-title="Item name">
                                    <?php echo $row[1]; ?>
                                </div>
                                <div class="cell" data-title="Company Name">
                                    <?php echo $row[2]; ?>
                                </div>
                                <div class="cell" data-title="Unit price">
                                    <?php echo $row[3]; ?>
                                </div>
                                <div class="cell" data-title="Unit type">
                                    <?php echo $row[4]; ?>
                                </div>
                                <div class="cell" style="100px" data-title="Options">
                                    <button class="operation" id="<?php echo $row[0] ?>"
                                            onclick="displayUserUpdateForm(<?php echo $row[0] ?>);"><img
                                                src="<?php echo BASEURL . '/images/edit.svg' ?>" alt=" Edit">
                                    </button>
                                    <script type="text/javascript">
                                        $(function(){
                                            $('#<?php echo $row[0] ?>').click(function(){
                                                $('#userForm').fadeIn().css("display","flex");
                                            });
                                        });
                                    </script>
                                    <a href="<?php echo BASEURL . '/Admin/delEdiUser.php?op=delete&id=' . $row[0] ?>">
                                        <button class="operation"><img src="<?php echo BASEURL . '/images/trash.svg' ?>" alt="Delete">
                                        </button>
                                    </a>
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
            <form method="post" onsubmit="return validateForm()" enctype="multipart/form-data" id="addForm"
                  name="userForm">
                <div class="banner">
                    <h1>Medicine</h1>
                </div>
                <p class="royal">Royal Hospital Management System </p>
                <p class="addUser" id="titleOperation">Add medicine</p>
                <table>
                    <tr colspan="3">
                        <div class="alert" id="warning"></div>
                    </tr>
                    <tr id="nicRow">
                        <td>
                            <label for="medicineName">Medicine name:</label>
                        </td>
                        <td colspan="2">
                            <input type="text" name="medicineName" id="IN_medicineName"><div class="alert" id="nic"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="Unit Type">Unit Type:</label>
                        </td>
                        <td colspan="2">
                            <select name="unitType" id="">
                                <option value="">Select type</option>
                                <option value="cards">cards</option>
                                <option value="bottles">bottles</option>
                                <option value="pills">pills</option>
                                <option value="injections">injections</option>
                                <option value="tablets">tablets</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="Unit Cost">Unit Cost:</label>
                        </td>
                        <td colspan="2">
                            <input name="unitCost" type="text" id="contact" placeholder="Enter Unit Cost here">                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="2">
                            <button name="submit">Submit</button>
                            <button name="cancel" id="cancel">Cancel</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

        </div>
        <!-- content start -->

<script src=<?php echo BASEURL . '/js/ValidateForm.js' ?>></script>
<script src=<?php echo BASEURL . '/js/filterElements.js' ?>></script>
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