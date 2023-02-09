<?php
session_start();
//die( $_SESSION['mailaddress']);
require_once("../conf/config.php");
if (isset($_SESSION['mailaddress']) && $_SESSION['userRole'] == 'Receptionist') {
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo BASEURL . '/css/style.css' ?>">
        <link rel="stylesheet" href="<?php echo BASEURL . '/css/updateProfile.css' ?>">
        <title>Receptionist update profile - Receptionist</title>
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
        <?php
        $name = urlencode( $_SESSION['name']);
        include(BASEURL . '/Components/ReceptionistSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name); ?>        <div class="userContents" id="center">
            <div class="title">
                <img src="../images/logo5.png" alt="logo">
                Royal Hospital Management System
            </div>
            <ul>
                <li class="userType"><img src="../images/userInPage.svg" alt="admin"> Receptionist</li>

                <li class="logout"><a href="<?php echo BASEURL . '/Homepage/logout.php?logout& url = http://localhost:8080'.$_SERVER['REQUEST_URI'] ?>">Logout <img src="../images/logout.svg">

                    </a></li>
            </ul>
            <div class="arrow">
                <img src="../images/arrow-right-circle.svg" alt="arrow">Profile
            </div>
            <div class="editRegion">
                <div class="editForm">
                    <h2>Edit profile</h2>
                    <?php
                    if (@$_GET['wrongResult']) {
                        ?>
                        <div class="alert">
                            <?php
                            echo $_GET["wrongResult"];
                            ?>
                        </div>
                        <?php
                    } ?>
                    <?php
                    if (@$_GET['correctResult']) {
                        ?>
                        <div class="success">
                            <?php
                            echo $_GET["correctResult"];
                            ?>
                        </div>
                        <?php
                    } ?>
                    <form action="updateProfile.php" method="post" enctype="multipart/form-data">
                        <?php
                        $result = mysqli_query($con, "select * from user where email = '" . $_SESSION['mailaddress'] . "'");
                        $row = mysqli_fetch_array($result);
                        ?>
                        <table>
                            <tr>
                                <td><label for="Name">Name: </label></td>
                                <td colspan="2"><input type="text" name="name" value="<?php echo $row['name'] ?> " required><div class="alert" id="name"></div></td>
                            </tr>
                            <tr>
                                <td><label for="email">Email: </label></td>
                                <td colspan="2"><input type="text" name="email" value="<?php echo $row['email'] ?>" required><div class="alert" id="email"></div></td>
                            </tr>
                            <tr>
                                <td><label for="address">Address: </label></td>
                                <td colspan="2"><textarea name="address" cols="30"
                                                          rows="3" required><?php echo $row['address'] ?></textarea><div class="alert" id="address"></div></td>
                            </tr>
                            <tr>
                                <td><label for="contactnum">Contact number: </label></td>
                                <td colspan="2"><input type="text" name="contactNum" value="<?php echo $row['contact_num'] ?>" required><div class="alert" id="contactNum"></div></td>
                            </tr>
                            <tr>
                                <td><label for="dob">Date of birth: </label></td>
                                <td colspan="2"><input type="date" name="dob" max="<?php echo date("2005-m-d")?>" required></td>
                                <script>document.getElementsByName('dob')[0].value="<?php echo $row['DOB'] ?>";</script>
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
                                <script>
                                    if('<?php echo $row['gender'] ?>' == 'm')
                                        document.getElementById('M_gender').checked = true;
                                    else
                                        document.getElementById('F_gender').checked = true;
                                </script>
                            </tr>
                            <tr>
                                <td><label for="profilePic">Profile Image: </label></td>
                                <td colspan="2"><img  src="<?php echo BASEURL . '/uploads/' . $row['profile_image'] ?>" id="profilePic" alt=""><br>
                                    <input type="file"  name="profile_image" required>
                                </td>
                            </tr>
                        </table>
                        <button name="updateReceptionist" type="submit">Save changes</button>
                    </form>
                </div>
            </div>
            <div class="editRegion">
                <div class="editForm">
                    <h2>Change password</h2>

                    <form action="updateProfile.php" onsubmit="validatePasswordForm()" method="post">

                        <table>
                            <tr>
                                <td><label for="Old password">Old password: </label></td>
                                <td colspan="2"><input type="password" name="oldPassword" required><div class="alert password"></div></td>
                            </tr>
                            <tr>
                                <td><label for="New password">New password: </label></td>
                                <td colspan="2"><input type="password" name="newPassword" required><div class="alert password" ></div></td>
                            </tr>
                            <tr>
                                <td><label for="confirmPassword">Confirm Password: </label></td>
                                <td colspan="2"><input type="password" name="confirmPassword" required><div class="alert password"></div></td>
                            </tr>
                        </table>
                        <button name="changePassword" type="submit">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include(BASEURL . '/Components/Footer.php'); ?>

    <script src=<?php echo BASEURL . '/js/validateFormReceptionist.js' ?>></script>

    <div id="counter">0</div>

    </body>

    </html>
    <?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>