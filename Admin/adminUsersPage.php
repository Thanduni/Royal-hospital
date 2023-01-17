<?php
session_start();
//die( $_SESSION['profilePic']);
require_once("../conf/config.php");
if (isset($_SESSION['mailaddress'])) {
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <!--    <php echo "" ?>-->
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo BASEURL . '/css/style.css' ?>">
        <link rel="stylesheet" href="<?php echo BASEURL . '/css/adminUsersPage.css' ?>">
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
                <li class="logout"><a href="../Homepage/logout.php?logout">Logout <img src="../images/logout.jpg">
                    </a></li>
            </ul>
            <div class="arrow">
                <img src="../images/arrow-right-circle.svg" alt="arrow">User
            </div>
            <p>
                <button type="button" id="addButton" onclick="displayUserAddForm()">+Add user</button>
            </p>
            <div class="userClass">
                <?php
                $query = "SELECT * FROM user";
                $result = $con->query($query);
                if (!$result) die("Database access failed: " . $con->error);
                $rows = $result->num_rows;
                ?>
                <table class="table">

                    <tr class="tableHead">
                        <th>NIC</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th>Contact number</th>
                        <th>Gender</th>
                        <th>Password</th>
                        <th>User role</th>
                        <th>Profile image</th>
                        <th>Options</th>
                    </tr>
                    <?php
                    for ($j = 0; $j < $rows; ++$j) {
                        $result->data_seek($j);
                        $row = $result->fetch_array(MYSQLI_NUM);
                        ?>
                        <tr id="UDfunc">
                            <?php
                            for ($k = 0; $k < 8; ++$k) { ?>
                                <td>
                                    <?php echo $row[$k]; ?>
                                </td>
                            <?php } ?>

                            <td style="width:100px">
                                <?php
                                echo "<img class='profilePic' src='". BASEURL . "/uploads/$row[8]' alt='Upload Image' width=150px>";
//                                $sampleArray = array('Car', 'Bike', 'Boat');
                                ?>
                            </td>
                            <div class="tableCon"><?php echo $row[1] ?></div>
                            <div class="tableCon"><?php echo $row[2] ?></div>
                            <div class="tableCon"><?php echo $row[3] ?></div>
                            <div class="tableCon"><?php echo $row[4] ?></div>
                            <div class="tableCon"><?php echo $row[5] ?></div>
                            <div class="tableCon"><?php echo $row[7] ?></div>
                            <div class="tableCon"><?php echo $row[8]?></div>
                            <td style="100px">
                                    <button id="edit" onclick="displayUserUpdateForm()"><img src="<?php echo BASEURL . '/images/edit.svg' ?>" alt="Edit"> Edit
                                    </button>

                                <script src="<?php echo BASEURL . '/js/updateUser.js' ?>"></script>

                                <a href="<?php echo BASEURL . '/Admin/delEdiUser.php?op=delete&id='.$row[0] ?>">
                                    <button ><img src="<?php echo BASEURL . '/images/trash.svg' ?>"
                                                 alt="Delete">Delete
                                    </button>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
    <script src="<?php echo BASEURL . '/js/addUser.js' ?>"></script>
    <div id="userForm">
        <div id="form">
            <form action="<?php echo BASEURL . '/Admin/addUser.php' ?>" method="post" onsubmit="return validateForm()" enctype="multipart/form-data" id="addForm" name="userForm">
                <p class="royal">Royal Hospital Management System </p>
                <p class="addUser" id="titleOperation">Add user</p>
                <table>
                    <tr colspan="3">
                        <div class="alert" id="warning"></div>
                    </tr>
                    <tr>
                        <td>
                            <label for="nic">NIC:</label>
                        </td>
                        <td colspan="2">
                            <input type="text" name="nic" id="IN_nic" required><div class="alert" id="nic"></div>
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
                    <tr>
                        <td>
                            <label for="password">Password:</label>
                        </td>
                        <td colspan="2">
                            <input type="text" name="password" id="IN_password" required><div class="alert" id="password"></div>
                        </td>
                    </tr>
                    <tr>
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
                            <button id="submit" name="addUser">Apply</button>
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