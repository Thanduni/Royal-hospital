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
        <link rel="stylesheet" href="<?php echo BASEURL . '/css/noticeboardHomepageEdit.css' ?>">
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
        <?php include(BASEURL . '/Components/ReceptionistSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $_SESSION['name']); ?>
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
                <img src="../images/arrow-right-circle.svg" alt="arrow">Profile
            </div>
            <div class="editRegion">
                <div class="editForm">
                    <h2>Edit profile</h2>
                    <?php
                    if (@$_GET['result'] == true) {
                        ?>
                        <div class="success">
                            <?php
                            echo $_GET["result"];
                            ?>
                        </div>
                        <?php
                    } ?>
                    <form action="updateHomepage.php" method="post">
                        <?php
                        if (@$_GET['Empty'] == true) {
                            ?>
                            <div class="alert">
                                <?php
                                echo $_GET["Empty"];
                                ?>
                            </div>
                            <?php
                        } ?>
                        <table>
                            <tr>
                                <td><label for="Name">Name: </label></td>
                                <td colspan="2"><input type="text" name="name" ></td>
                            </tr>
                            <tr>
                                <td><label for="email">Email: </label></td>
                                <td colspan="2"><input type="text" name="name" ></td>
                            </tr>
                            <tr>
                                <td><label for="address">Address: </label></td>
                                <td  colspan="2"><textarea name="address" cols="30" rows="3"></textarea></td>
                            </tr>
                            <tr>
                                <td><label for="contactnum">Contact number: </label></td>
                                <td  colspan="2"><input type="text" name="conNum"></td>
                            </tr>
                            <tr>
                                <td><label for="contactnum">Contact number: </label></td>
                                <td colspan="2"><input type="text" name="conNum"></td>
                            </tr>
                            <tr>
                                <td><label for="gender">Gender: </label></td>
                                <td>
                                    <label for="address">Male:</label>
                                    <input type="radio" id="M_gender" name="gender" value="m" required>
                                </td>
                                <td>
                                    <label for="address">Female:</label>
                                    <input type="radio" id="F_gender" name="gender" value="f" required>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="profilePic">Profile Image: </label></td>
                                <td colspan="2"><img src="" alt=""></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
            <div class="editRegion">
                <div class="editForm">
                    <h2>Change password</h2>
                    <?php
                    if (@$_GET['result'] == true) {
                        ?>
                        <div class="success">
                            <?php
                            echo $_GET["result"];
                            ?>
                        </div>
                        <?php
                    } ?>
                    <form action="updateHomepage.php" method="post">
                        <?php
                        if (@$_GET['Empty'] == true) {
                            ?>
                            <div class="alert">
                                <?php
                                echo $_GET["Empty"];
                                ?>
                            </div>
                            <?php
                        } ?>
                        <table>

                        </table>
                    </form>

                </div>
            </div>
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