<?php
session_start();

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
        <script src="https://code.iconify.design/iconify-icon/1.0.5/iconify-icon.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://kit.fontawesome.com/04b61c29c2.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="<?php echo BASEURL . '/css/adminUsersPage.css' ?>">
        <title>Admin dashboard - User</title>
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
            <?php
            $name = urlencode( $_SESSION['name']);
            include(BASEURL.'/Components/adminTopbar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name . "&userRole=" . $_SESSION['userRole']. "&nic=" . $_SESSION['nic']);
            ?>
<!--            <div class="title">-->
<!--                <img src="../images/logo5.png" alt="logo">-->
<!--                Royal Hospital Management System-->
<!--            </div>-->
<!--            <ul>-->
<!--                <li class="userType"><img src="../images/userInPage.svg" alt="admin"> Admin</li>-->
<!--                <li class="logout"><a href="--><?php //echo BASEURL . '/Homepage/logout.php?logout' ?><!--">Logout-->
<!--                        <img                          src="../images/logout.svg">-->
<!--                    </a></li>-->
<!--            </ul>-->
            <div class="arrow">
                <img src="../images/arrow-right-circle.svg" alt="arrow">User
            </div>
            <p>
                <script src="<?php echo BASEURL . '/js/addUser.js' ?>"></script>
                <button type="button" id="addButton" class="custom-btn" class="custom-btn" onclick="displayUserAddForm()">+Add user</button>
            </p>

            <div class="filter">
                <input type="text" id="myInputName" onkeyup="filterByNameUsers()" placeholder="Search for names.." title="Type in a name">
                <input type="text" id="myInputRole" onkeyup="filterByRoleUsers()" placeholder="Search for user role.." title="Type in a name">
            </div>

            <?php
            if (@$_GET['warning']) {
                ?>
                <div class="alert">
                    <?php
                    echo $_GET["warning"];
                    ?>
                </div>
            <?php }
            if (@$_GET['result']) {
                ?>
                <div class="success">
                    <?php
                    echo $_GET["result"];
                    ?>
                </div>
            <?php }?>

            <div class="userClass">
                <?php
                $query = "SELECT * FROM user";
                $result = $con->query($query);
                if (!$result) die("Database access failed: " . $con->error);
                $rows = $result->num_rows;
                ?>
                <div class="wrapper">
                    <div class="table">
                        <div class="row headerT">
                            <div class="cell">NIC</div>
                            <div class="cell">Name</div>
                            <div class="cell">Profile image</div>
                            <div class="cell">User role</div>
                            <div class="cell">Address</div>
                            <div class="cell">Email</div>
                            <div class="cell">Contact number</div>
                            <div class="cell">Date of Birth</div>
                            <div class="cell">Gender</div>
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
                                <li class="<?php echo $row[0] ?>_tableCon"><?php echo $row[5] ?></li>
                                <li class="<?php echo $row[0] ?>_tableCon"><?php echo $row[7] ?></li>
                                <li class="<?php echo $row[0] ?>_tableCon"><?php echo $row[9] ?></li>
                            </ul>
                            <!--                        <div id="UDfunc">-->
                            <div class="row">

                                <div class="cell" data-title="NIC">
                                    <?php echo $row[0]; ?>
                                </div>
                                <div class="cell" data-title="Name">
                                    <?php echo $row[1]; ?>
                                </div>
                                <div class="cell" style="width:100px" data-title="Profile image">
                                    <?php
                                    echo "<img class='profilePic' src='" . BASEURL . "/uploads/$row[8]' alt='Upload Image' width=150px>";
                                    ?>
                                </div>
                                <div class="cell" data-title="User role">
                                    <?php echo $row[7]; ?>
                                </div>
                                <div class="cell" data-title="Address">
                                    <?php echo $row[2]; ?>
                                </div>
                                <div class="cell" data-title="Email">
                                    <?php echo $row[3]; ?>
                                </div>
                                <div class="cell" data-title="Contact number">
                                    <?php echo $row[4]; ?>
                                </div>
                                <div class="cell" data-title="Date of Birth">
                                    <?php echo $row[9]; ?>
                                </div>
                                <div class="cell" data-title="Gender">
                                    <?php echo $row[5]; ?>
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
    </div>
        </div>
    <div id="userForm">
        <div id="form">
            <form method="post" onsubmit="return validateForm()" enctype="multipart/form-data" id="addForm"
                  name="userForm">
                <div class="banner">
                    <h1>User</h1>
                </div>
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
                        <td>
                            <label for="Name">Name:</label>
                        </td>
                        <td colspan="2">
                            <input type="text" name="name" id="IN_name" required><div class="alert" id="name"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="address">Address:</label>
                        </td>
                        <td colspan="2">
                            <textarea type="text" name="address" id="IN_address" rows=3 required></textarea><div class="alert" id="address"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="email">Email:</label>
                        </td>
                        <td colspan="2">
                            <input type="email" name="email" id="IN_email" required><div class="alert" id="email"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="contact">Contact number:</label>
                        </td>
                        <td colspan="2">
                            <input type="text" name="contactNum" id="IN_contnum" required><div class="alert" id="contactNum"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="gender">Gender:</label>
                        </td>
                        <td colspan="1">
                            <label for="gender">Male:</label>
                            <input type="radio" id="M_gender" name="gender" value="m" required>
                        </td>
                        <td colspan="1">
                            <label for="gender">Female:</label>
                            <input type="radio" id="F_gender" name="gender" value="f" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="dob">Date of Birth:</label>
                        </td>
                        <td colspan="2">
                            <input type="date" name="dob" id="IN_dob" max="<?php echo date("2005-m-d") ?>" required><div class="alert" id="dob"></div>
                        </td>
                    </tr>
                    <tr id="passRow">
                        <td>
                            <label for="password">Password:</label>
                        </td>
                        <td colspan="2">
                            <input type="text" name="password" id="IN_password"><div class="alert" id="password"></div>
                        </td>
                    </tr>
                    <tr id="userRoleRow">
                        <td>
                            <label for="userRole">User role:</label>
                        </td>
                        <td colspan="2">
                            <select name="userRole" id="IN_userRole">
                                <option value="Doctor">Doctor</option>
                                <option value="Receptionist">Receptionist</option>
                                <option value="Storekeeper">Storekeeper</option>
                                <option value="Nurse">Nurse</option>
                            </select>
                            <br><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="profile_image">Profile picture:</label>
                        </td>
                        <td colspan="2">
                            <input type="file" name="profile_image" id="IN_profPic" value="IN_profPic.txt" required>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="2">
                            <button class="custom-btn" type="submit" id="submit" name="addUser">Apply</button>
                            <button name="cancel" class="custom-btn" id="cancel">Cancel</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    </div>

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

    <?php
    if (@$_GET['click'] == "addDoctor") {
        $_SESSION['nic'] = $_GET['nic'];
        $_SESSION['department'] = $_GET['department'];
        $_SESSION['which_user'] = "Doctor";
        echo
        "<script>
                displayUserAddForm();
                document.getElementById('IN_nic').value = ". $_GET['nic'] . ";
                document.getElementById('IN_userRole').selectedIndex = 0;
            </script>";
        }
    if (@$_GET['click'] == "addNurse") {
        $_SESSION['nic'] = $_GET['nic'];
        $_SESSION['which_user'] = "Nurse";
        echo
            "<script>
                displayUserAddForm();
                document.getElementById('IN_nic').value = ". $_GET['nic'] . ";
                document.getElementById('IN_userRole').selectedIndex = 3;
            </script>";
    }
    if (@$_GET['click'] == "addReceptionist") {
        $_SESSION['nic'] = $_GET['nic'];
        $_SESSION['which_user'] = "Receptionist";
        echo
            "<script>
                displayUserAddForm();
                document.getElementById('IN_nic').value = ". $_GET['nic'] . ";
                document.getElementById('IN_userRole').selectedIndex = 1;
            </script>";
    }
    if (@$_GET['click'] == "addStorekeeper") {
        $_SESSION['nic'] = $_GET['nic'];
        $_SESSION['which_user'] = "Storekeeper";
        echo
            "<script>
                displayUserAddForm();
                document.getElementById('IN_nic').value = ". $_GET['nic'] . ";
                document.getElementById('IN_userRole').selectedIndex = 2;
            </script>";
    }
//    ?>

    </body>

    </html>
    <?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>