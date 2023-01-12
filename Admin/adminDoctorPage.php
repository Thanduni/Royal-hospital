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
        <link rel="stylesheet" href="<?php echo BASEURL . '/css/adminDoctorPage.css' ?>">
        <title>Admin dashboard - Doctor</title>
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
                <img src="../images/arrow-right-circle.svg" alt="arrow">Doctor
            </div>
            <p>
                <button type="button" id="addButton" onclick="displayDoctorAddForm()">+Add doctor</button>
                <script src="<?php echo BASEURL . '/js/addUser.js' ?>"></script>
            </p>

            <input type="text" id="myInputName" onkeyup="filterByName()" placeholder="Search for names.." title="Type in a name">

            <div class="userClass">
                <?php
                $query = " SELECT user.nic, doctor.doctorID, user.name, doctor.department, user.profile_image FROM doctor inner join user where doctor.nic=user.nic;";
                $result = $con->query($query);
                if (!$result) die("Database access failed: " . $con->error);
                $rows = $result->num_rows;
                ?>
                <div class="wrapper">
                    <div class="table">
                        <div class="row headerT">
                            <div class="cell">NIC</div>
                            <div class="cell">DoctorID</div>
                            <div class="cell">Doctor Name</div>
                            <div class="cell">Department</div>
                            <div class="cell">Profile image</div>
                            <div class="cell">Options</div>
                        </div>
                        <?php
                        for ($j = 0; $j < $rows; ++$j) {
                            $result->data_seek($j);
                            $row = $result->fetch_array(MYSQLI_NUM);
                            ?>

                            <div class="row">
                                <div class="cell" data-title="NIC">
                                    <?php echo $row[0]; ?>
                                </div>
                                <div class="cell" data-title="Doctor ID">
                                    <?php echo $row[1]; ?>
                                </div>
                                <div class="cell" data-title="Doctor Name">
                                    <?php echo $row[2]; ?>
                                </div>
                                <div class="cell" data-title="Department">
                                    <?php echo $row[3]; ?>
                                </div>
                                <div class="cell" style="width:100px" data-title="Profile image">
                                    <?php
                                    echo "<img class='profilePic' src='" . BASEURL . "/uploads/$row[4]' alt='Upload Image' width=150px>";
                                    ?>
                                </div>
                                <div class="cell" style="100px" data-title="Options">
                                    <button class="edit" id="<?php echo $row[0] ?>" onclick="displayDoctorUpdateForm(<?php echo $row[0] ?>);"><img src="<?php echo BASEURL . '/images/edit.svg' ?>" alt="Edit">
                                        Edit
                                    </button>
                                    <a href="<?php echo BASEURL . '/Admin/delEdiUser.php?op=deleteDoctor&id=' . $row[0] ?>">
                                        <button><img src="<?php echo BASEURL . '/images/trash.svg' ?>" alt="Delete">Delete
                                        </button>
                                    </a>
                                </div>

                                <ul class="tableCon">
                                    <li class="<?php echo $row[0] ?>_tableCon"><?php echo $row[3] ?></li>
                                </ul>

                            </div>

                        <?php } ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div id="userForm">
        <div id="form">
            <form method="post" onsubmit="return validateDoctorForm()" enctype="multipart/form-data" id="addForm" name="userForm">
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
                            <label for="department">Department:</label>
                        </td>
                        <td colspan="2">
                            <input type="text" name="department" id="IN_department" required><div class="alert" id="name"></div>
                        </td>
                    </tr>
                    </tr>
                        <td></td>
                        <td colspan="2">
                            <button type="submit" id="submit" name="addDoctor">Apply</button>
                            <button name="cancel" id="cancel">Cancel</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <?php include(BASEURL . '/Components/Footer.php'); ?>

    <script src=<?php echo BASEURL . '/js/filterElements.js' ?>></script>
    <script src=<?php echo BASEURL . '/js/validateDoctor.js' ?>></script>

    <?php
    if (@$_GET['task'] == "insertDoctor") {
        $nic = $_GET['nic'];
        echo
        "<script>
                displayDoctorAddForm();
                document.getElementById('IN_nic').value = ". $nic. ";
            </script>";
        } ?>

    </body>
    </html>
    <?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>