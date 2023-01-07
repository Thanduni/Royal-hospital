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
                <img src="../images/arrow-right-circle.svg" alt="arrow">Manage homepage
            </div>
            <div class="editRegion">
                <div class="buttonSet">
                    <a href="<?php echo BASEURL . '/Admin/noticeboardHomepageEdit.php' ?>"><button type="button" id="slider">Homepage</button></a>
                    <button type="button" id="aboutUs" style="background-color: #AADDDD; color: #24354E" disabled>About us</button>
                </div>
                <div class="editForm">
                    <h2>About us</h2>
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
                    <form action="updateAboutUs.php" method="post">
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
                            <?php
                            $query = "SELECT * FROM aboutusinfo";
                            $result = $con->query($query);
                            $result->data_seek(0);
                            $row = $result->fetch_array(MYSQLI_NUM);
                                ?>
                            <textarea name="aboutUs" cols="30" rows="20" style="margin-top: 25px;" required><?php echo $row[0] ?></textarea>
                                    <button name="aboutUsInfo" type="submit">Save changes</button>
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