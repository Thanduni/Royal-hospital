<?php
session_start();

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
                <img src="../images/arrow-right-circle.svg" alt="arrow">User
            </div>
            <p>
                <script src="<?php echo BASEURL . '/js/addUser.js' ?>"></script>
                <button type="button" id="addButton" onclick="displayUserAddForm()">+Add user</button>
            </p>

            <div class="filter">
                <input type="text" id="myInputName" onkeyup="filterByName()" placeholder="Search for names.." title="Type in a name">
                <input type="text" id="myInputRole" onkeyup="filterByRole()" placeholder="Search for user role.." title="Type in a name">
            </div>

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
                            <div class="cell">Options</div>
                            <div class="cell">NIC</div>
                            <div class="cell">Name</div>
                            <div class="cell">Profile image</div>
                            <div class="cell">User role</div>
                            <div class="cell">Address</div>
                            <div class="cell">Email</div>
                            <div class="cell">Contact number</div>
                            <div class="cell">Gender</div>
                            <div class="cell">Password</div>
                        </div>
                        <?php
                        for ($j = 0; $j < $rows; ++$j) {
                            $result->data_seek($j);
                            $row = $result->fetch_array(MYSQLI_NUM);
                            ?>
                            <ul class="tableCon">
                                <li class="<?php echo $row[0] ?>_tableCon"><?php echo $row[1] ?></li>
                                <li class="<?php echo $row[0] ?>_tableCon"><?php echo $row[2] ?></li>
                                <li class="<?php echo $row[0] ?>_tableCon"><?php echo $row[3] ?></li>
                                <li class="<?php echo $row[0] ?>_tableCon"><?php echo $row[4] ?></li>
                                <li class="<?php echo $row[0] ?>_tableCon"><?php echo $row[5] ?></li>
                                <li class="<?php echo $row[0] ?>_tableCon"><?php echo $row[7] ?></li>
                            </ul>
                            <!--                        <div id="UDfunc">-->
                            <div class="row">
                                <div class="cell" style="100px" data-title="Options">
                                    <button class="edit" id="<?php echo $row[0] ?>"
                                            onclick="displayUserUpdateForm(<?php echo $row[0] ?>);"><img
                                                src="<?php echo BASEURL . '/images/edit.svg' ?>" alt=" Edit">
                                        Edit
                                    </button>
                                    <a href="<?php echo BASEURL . '/Admin/delEdiUser.php?op=delete&id=' . $row[0] ?>">
                                        <button><img src="<?php echo BASEURL . '/images/trash.svg' ?>" alt="Delete">Delete
                                        </button>
                                    </a>
                                </div>
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
                                <div class="cell" data-title="Gender">
                                    <?php echo $row[5]; ?>
                                </div>
                                <div class="cell" data-title="Password">
                                    <?php echo $row[6]; ?>
                                </div>
                            </div>

                        <?php } ?>
                    </div>
                </div>
        </div>
    </div>
    <div id="userForm">
        <div id="form">
            <form method="post" onsubmit="return validateForm()" enctype="multipart/form-data" id="addForm"
                  name="userForm">
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
                            <label for="address">Gender:</label>
                        </td>
                        <td colspan="1">
                            <label for="address">Male:</label>
                            <input type="radio" id="M_gender" name="gender" value="m" required>
                        </td>
                        <td colspan="1">
                            <label for="address">Female:</label>
                            <input type="radio" id="F_gender" name="gender" value="f" required>
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
                                <option value="Patient">Patient</option>
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
                            <button type="submit" id="submit" name="addUser">Apply</button>
                            <button name="cancel" id="cancel">Cancel</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    </div>
    <?php include(BASEURL . '/Components/Footer.php'); ?>

    <script src=<?php echo BASEURL . '/js/ValidateForm.js' ?>></script>
    <script src=<?php echo BASEURL . '/js/filterElements.js' ?>></script>

    <?php
    if (@$_GET['click'] == "addDoctor") {
        $_SESSION['nic'] = $_GET['nic'];
        $_SESSION['department'] = $_GET['department'];
        $_SESSION['which_user'] = "Doctor";
        echo
        "<script>
                displayUserAddForm();
                document.getElementById('IN_nic').value = ". $_GET['nic'] . ";
                document.getElementById('IN_userRole').selectedIndex = 1;
            </script>";
        }
    if (@$_GET['click'] == "addNurse") {
        $_SESSION['nic'] = $_GET['nic'];
        $_SESSION['which_user'] = "Nurse";
        echo
            "<script>
                displayUserAddForm();
                document.getElementById('IN_nic').value = ". $_GET['nic'] . ";
                document.getElementById('IN_userRole').selectedIndex = 4;
            </script>";
    }
    if (@$_GET['click'] == "addReceptionist") {
        $_SESSION['nic'] = $_GET['nic'];
        $_SESSION['which_user'] = "Receptionist";
        echo
            "<script>
                displayUserAddForm();
                document.getElementById('IN_nic').value = ". $_GET['nic'] . ";
                document.getElementById('IN_userRole').selectedIndex = 2;
            </script>";
    }
    if (@$_GET['click'] == "addStorekeeper") {
        $_SESSION['nic'] = $_GET['nic'];
        $_SESSION['which_user'] = "Storekeeper";
        echo
            "<script>
                displayUserAddForm();
                document.getElementById('IN_nic').value = ". $_GET['nic'] . ";
                document.getElementById('IN_userRole').selectedIndex = 3;
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