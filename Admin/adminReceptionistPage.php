<?php
session_start();
//die( $_SESSION['profilePic']);
require_once("../conf/config.php");
if (isset($_SESSION['mailaddress'])) {
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo BASEURL . '/css/style.css' ?>">
        <link rel="stylesheet" href="<?php echo BASEURL . '/css/adminReceptionistPage.css' ?>">
        <title>Admin dashboard - user</title>
        <style>
            p.royal {
                font-size: 20px;
            }

            p.addUSer {
                font-size: 30px;
            }

            .next {
                position: initial;
                height: auto;
            }
        </style>
        <script src="<?php echo BASEURL . '/js/updateUser.js' ?>"></script>
    </head>

    <body>
    <div class="user">
        <?php include(BASEURL . '/Components/AdminSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $_SESSION['name']); ?>
        <div class="userContents" id="center">
            <div class="title">
                <img src="../images/logo5.png" alt="logo">
                Royal Hospital Management System
            </div>
            <ul>
                <li class="userType"><img src="../images/userInPage.svg" alt="admin"> Admin</li>
                <li class="logout"><a href="<?php echo BASEURL . '/Homepage/logout.php?logout' ?>">Logout <img
                            src="../images/logout.jpg">
                    </a></li>
            </ul>
            <div class="arrow">
                <img src="../images/arrow-right-circle.svg" alt="arrow">Receptionist
            </div>
            <p>
                <button type="button" id="addButton" onclick="displayReceptionistAddForm()">+Add receptionist</button>
                <script src="<?php echo BASEURL . '/js/addUser.js' ?>"></script>
            </p>
            <div class="userClass">
                <?php
                $query = " SELECT user.nic, receptionist.receptionistID, user.name, user.profile_image FROM receptionist inner join user where receptionist.nic=user.nic;";
                $result = $con->query($query);
                if (!$result) die("Database access failed: " . $con->error);
                $rows = $result->num_rows;
                ?>
                <table class="table">
                    <tr class="tableHead">
                        <th>NIC</th>
                        <th>receptionistID</th>
                        <th>Receptionist Name</th>
                        <th>Profile image</th>
                        <th>Options</th>
                    </tr>
                    <?php
                    for ($j = 0; $j < $rows; ++$j) {
                        $result->data_seek($j);
                        $row = $result->fetch_array(MYSQLI_NUM);
                        ?>
                        <?php
                        for ($k = 0; $k < 3; ++$k) { ?>
                            <td>
                                <?php echo $row[$k]; ?>
                            </td>
                        <?php } ?>

                        <td style="width:100px">
                            <?php
                            echo "<img class='profilePic' src='" . BASEURL . "/uploads/$row[3]' alt='Upload Image' width=150px>";
                            ?>
                        </td>
                        <ul class="tableCon">
                            <li class="<?php echo $row[0] ?>_tableCon"><?php echo $row[2] ?></li>
                            <li class="<?php echo $row[0] ?>_tableCon"><?php echo $row[3] ?></li>
                        </ul>

                        <td style="100px">
                            <a href="<?php echo BASEURL . '/Admin/delEdiUser.php?op=deleteReceptionist&id=' . $row[0] ?>">
                                <button><img src="<?php echo BASEURL . '/images/trash.svg' ?>" alt="Delete">Delete
                                </button>
                            </a>
                        </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
    <div id="userForm">
        <div id="form">
            <form method="post" onsubmit="return validateNurseReceptionistForm()" enctype="multipart/form-data" id="addForm" name="userForm">
                <p class="royal">Royal Hospital Management System </p>
                <p class="addUser" id="titleOperation">Add user</p>
                <table>
                    <tr colspan="3">
                        <div class="alert" id="warning"></div>
                    </tr>
                    <tr id="nicRow">
                        <td>
                            <label for="nic">NIC:</label>
                        </td>
                        <td colspan="2">
                            <input type="text" name="nic" id="IN_nic"><div class="alert" id="nic"></div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="2">
                            <button type="submit" id="submit" name="addReceptionist">Apply</button>
                            <button name="cancel" id="cancel">Cancel</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <?php include(BASEURL . '/Components/Footer.php'); ?>

    <script src=<?php echo BASEURL . '/js/ValidateForm.js' ?>></script>


    </body>

    </html>
    <?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>