<?php
session_start();
//die( $_SESSION['profilePic']);
require_once("../conf/config.php");
if (isset($_SESSION['mailaddress']) && $_SESSION['userRole'] == 'Admin') {
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo BASEURL . '/css/style.css' ?>">
        <link rel="stylesheet" href="<?php echo BASEURL . '/css/announcementPage.css' ?>">
        <script src="https://kit.fontawesome.com/04b61c29c2.js" crossorigin="anonymous"></script>
        <title>Admin dashboard - Notices</title>
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
            form{
                text-align: left;
            }

            label{
                font-size: 20px;
                /* margin-top: 124px; */
                position: relative;
            }
        </style>
        <script src="<?php echo BASEURL . '/js/updateUser.js' ?>"></script>
    </head>

    <body>
    <div class="user">
        <?php include(BASEURL . '/Components/AdminSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $_SESSION['name']); ?>
        <div class="userContents" id="center">
            <?php
            $name = urlencode( $_SESSION['name']);
            include(BASEURL.'/Components/adminTopbar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name . "&userRole=" . $_SESSION['userRole']. "&nic=" . $_SESSION['nic']);
            ?>
            <div class="arrow">
                <img src="../images/arrow-right-circle.svg" alt="arrow">Place Notices
            </div>
            <div class="editRegion">
                <div class="editForm">
                    <h2>Notice</h2>
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
                    <form action="placeAnnouncement.php" method="post">
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
                        <label style="text-align: left">Title :</label>
                        <input type="text" style="margin: 20px 0px 20px; " name="title" required>
                        <label style="text-align: left">Message :</label>
                        <pre><textarea name="notice" cols="30" rows="20" style="margin: 20px 0px 20px;" required></textarea></pre>

                        <label style="text-align: left">User roles :</label>

                        <div class="userRoleSet">
                            <div class="checkBoxOptions">
                                Receptionist
                                <input type="checkbox" name="roles[]"
                                       value="Receptionist" style="display: block;">
                            </div>

                            <div class="checkBoxOptions">
                                Doctor
                                <input type="checkbox" name="roles[]"
                                       value="Doctor" style="display: block;">
                            </div>

                            <div class="checkBoxOptions">
                                Nurse
                                <input type="checkbox" name="roles[]"
                                       value="Nurse" style="display: block;">
                            </div>

                            <div class="checkBoxOptions">
                                Storekeeper
                                <input type="checkbox" name="roles[]"
                                       value="Storekeeper" style="display: block;">
                            </div>

                            <div class="checkBoxOptions">
                                Patient
                                <input type="checkbox" name="roles[]"
                                       value="Patient" style="display: block;">
                            </div>
                        </div>


                        <button name="postNotice" class="custom-btn" type="submit">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src=<?php echo BASEURL . '/js/ValidateForm.js' ?>></script>


    </body>

    </html>
    <?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>