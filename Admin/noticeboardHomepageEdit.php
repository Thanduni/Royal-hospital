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
                    <button type="button" id="slider" style="background-color: #AADDDD; color: #24354E" disabled>Homepage</button>
                    <a href="<?php echo BASEURL . '/Admin/noticeboardAboutUsEdit.php' ?>"><button type="button" id="aboutUs">About us</button></a>
                </div>
                <div class="editForm">
                    <h2>Main slider</h2>
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
                            <?php
                            $query = "SELECT * FROM homepagecontent";
                            $result = $con->query($query);
                            if (!$result) die("Database access failed: " . $con->error);
                            $rows = $result->num_rows;
                            $sliderImg = array();
                            for ($j = 0; $j < $rows; $j++) {
                                $result->data_seek($j);
                                $row = $result->fetch_array(MYSQLI_NUM);
                                $sliderImg[] = $row[3];
                                ?>
                                <tr>
                                    <td colspan="1" class="col-1"><label>Slider title: </label></td>
                                    <td>
                                        <input type="text" name="slider_title-<?php echo $j ?>" value="<?php echo $row[1] ?>" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="1" class="col-1"><label>Slider description: </label></td>
                                    <td>
                                        <textarea name="slider_description-<?php echo $j ?>" cols="30" rows="10" required><?php echo $row[2] ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="1" class="col-1"><label>Slider image: </label></td>
                                    <td>
                                        Current Slider Image:
                                        <img class="sliderImg" src="../uploads/<?php echo $row[3] ?>" alt="">
                                        <input type="file" name="slider_image_<?php echo $j ?>" required>
                                    </td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td colspan="1"></td>
                                <td align="right">
                                    <button name="homepageInfo" type="submit">Save changes</button>
                                </td>
                            </tr>
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