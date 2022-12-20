<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href= <?php echo BASEURL . '/public/assets/css/style.css'; ?>>
    <link rel="stylesheet" href= <?php echo BASEURL . '/public/assets/css/adminUsersPage.css'; ?>>
    <style>
        .next {
            position: initial;
            height: auto;
        }
    </style>
    <title>Admin dashboard - user</title>
</head>

<body>
<div class="user">
    <?php include('adminSidebar.php'); ?>
    <div class="userContents" id="center">
        <div class="title">
            <img src=<?php echo BASEURL . '/public/assets/images/logo5.png' ?> alt="logo">
            Royal Hospital Management System
        </div>
        <ul>
            <li class="userType"><img src=<?php echo BASEURL . '/public/assets/images/userInPage.svg' ?> alt="admin">
                Admin
            </li>
            <li class="logout"><a href="<?php echo BASEURL . '/Homepage/Logout?url=' . $_SERVER['REQUEST_URI'] ?>">Logout
                    <img
                            src=<?php echo BASEURL . '/public/assets/images/logout.jpg' ?> alt="logout"></a>
            </li>
        </ul>
        <div class="arrow">
            <img src=<?php echo BASEURL . '/public/assets/images/arrow-right-circle.svg' ?> alt="arrow">User
        </div>
        <p>
            <button type="button">+Add user</button>
        </p>
        <div class="userClass">
            <?php
            //            $query = "SELECT * FROM user";
            $result = $data['result'];
            //            print_r($result);
            $rows = count($result);
            //            die ($result[0]['']);
            ?>
            <table class="table">
                <tr>
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
                for ($j = 0; $j < "$rows"; ++$j) {
                    ?>
                    <tr>
                        <?php
                        for ($k = 0; $k < 8; ++$k) { ?>
                            <td>
                                <?php echo $result[$j][$k]; ?>
                            </td>

                        <?php } ?>
                        <td style="100px">
                            <img class='profilePic'
                                 src=<?php echo BASEURL . '/public/assets/uploads/' . $result[$j][8] ?> alt='Upload
                                 Image' width=150px>
                        </td>
                        <td style="100px" class="UDfunc">
                            <?php $result[$j] ?>
                            <button><img src="<?php echo BASEURL . '/public/assets/images/edit.svg' ?>" alt="Edit"> Edit
                            </button>
                            <a href="<?php echo BASEURL . '/Admin/removeUser?NIC='.$result[$j][0] ?>">
                                <button><img src="<?php echo BASEURL . '/public/assets/images/trash.svg' ?>"
                                             alt="Delete">Delete
                                </button>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <?php include('adminFooter.php'); ?>
    </div>
    <script src=<?php echo BASEURL . '/public/assets/js/addUser.js' ?>></script>
    <script src=<?php echo BASEURL . '/public/assets/js/updateUser.js' ?>>

    </script>
    <div id="note">
        <div id="form">
            <form action="<?php echo BASEURL . '/Admin/addUser' ?>" method="post" onsubmit="return validateForm()" enctype="multipart/form-data"
                  id="userForm" name="userForm">
                <p class="royal">Royal Hospital Management System </p>
                <p class="addUser">Add user </p>
                <table>
                    <tr colspan="3">
                        <div class="alert" id="warning"></div>
                    </tr>
                    <tr>
                        <td>
                            <label for="nic">NIC:</label>
                        </td>
                        <td colspan="2">
                            <input type="text" name="nic" id="" required><div class="alert" id="nic"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="Name">Name:</label>
                        </td>
                        <td colspan="2">
                            <input type="text" name="name" id="" required><div class="alert" id="name"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="address">Address:</label>
                        </td>
                        <td colspan="2">
                            <textarea type="text" name="address" id="" rows=3 required></textarea><div class="alert" id="address"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="email">Email:</label>
                        </td>
                        <td colspan="2">
                            <input type="email" name="email" id="" required><div class="alert" id="email"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="contact">Contact number:</label>
                        </td>
                        <td colspan="2">
                            <input type="text" name="contactNum" id="" required><div class="alert" id="contactNum"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="address">Gender:</label>
                        </td>
                        <td colspan="1">
                            <label for="address">Male:</label>
                            <input type="radio" name="gender" value="m" required>
                        </td>
                        <td colspan="1">
                            <label for="address">Female:</label>
                            <input type="radio" name="gender" value="f" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="userRole">User role:</label>
                        </td>
                        <td colspan="2">
                            <select name="userRole">
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
                            <label for="password">Password:</label>
                        </td>
                        <td colspan="2">
                            <input type="text" name="password" id="" required><div class="alert" id="password"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="profile_image">Profile picture:</label>
                        </td>
                        <td colspan="2">
                            <input type="file" name="profile_image" required>
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
    <script src=<?php echo BASEURL . '/public/assets/js/ValidateForm.js' ?>></script>
</body>
</html>
