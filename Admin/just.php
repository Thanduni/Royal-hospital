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
        <link rel="stylesheet" href="just.css">
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
                <li class="logout"><a href="<?php echo BASEURL . '/Homepage/logout.php?logout' ?>">Logout <img
                                src="../images/logout.jpg">
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
                <div class="wrapper">
                    <div class="table">
                        <div class="row headerT">
                            <div class="cell">NIC</div>
                            <div class="cell">Name</div>
                            <div class="cell">Address</div>
                            <div class="cell">Email</div>
                            <div class="cell">Contact number</div>
                            <div class="cell">Gender</div>
                            <div class="cell">Password</div>
                            <div class="cell">User role</div>
                            <div class="cell">Profile image</div>
                            <div class="cell">Options</div>
                        </div>
                        <?php
                        for ($j = 0; $j < $rows; ++$j) {
                            $result->data_seek($j);
                            $row = $result->fetch_array(MYSQLI_NUM);
                            ?>
                            <!--                        <div id="UDfunc">-->
                            <div class="row">
                                <div class="cell" data-title="NIC">
                                    <?php echo $row[0]; ?>
                                </div>
                                <div class="cell" data-title="Name">
                                    <?php echo $row[1]; ?>
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
                                <div class="cell" data-title="User role">
                                    <?php echo $row[7]; ?>
                                </div>
                                <div class="cell" style="width:100px" data-title="Profile image">
                                    <?php
                                    echo "<img class='profilePic' src='" . BASEURL . "/uploads/$row[8]' alt='Upload Image' width=150px>";
                                    ?>
                                </div>
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
                            </div>

                        <?php } ?>
                    </div>
                    <!--                        <li class="table-row">-->
                    <!--                            <div class="col col-1" data-label="Job Id">42235</div>-->
                    <!--                            <div class="col col-2" data-label="Customer Name">John Doe</div>-->
                    <!--                            <div class="col col-3" data-label="Amount">$350</div>-->
                    <!--                            <div class="col col-4" data-label="Payment Status">Pending</div>-->
                    <!--                        </li>-->
                    <!--                        <li class="table-row">-->
                    <!--                            <div class="col col-1" data-label="Job Id">42442</div>-->
                    <!--                            <div class="col col-2" data-label="Customer Name">Jennifer Smith</div>-->
                    <!--                            <div class="col col-3" data-label="Amount">$220</div>-->
                    <!--                            <div class="col col-4" data-label="Payment Status">Pending</div>-->
                    <!--                        </li>-->
                    <!--                        <li class="table-row">-->
                    <!--                            <div class="col col-1" data-label="Job Id">42257</div>-->
                    <!--                            <div class="col col-2" data-label="Customer Name">John Smith</div>-->
                    <!--                            <div class="col col-3" data-label="Amount">$341</div>-->
                    <!--                            <div class="col col-4" data-label="Payment Status">Pending</div>-->
                    <!--                        </li>-->
                    <!--                        <li class="table-row">-->
                    <!--                            <div class="col col-1" data-label="Job Id">42311</div>-->
                    <!--                            <div class="col col-2" data-label="Customer Name">John Carpenter</div>-->
                    <!--                            <div class="col col-3" data-label="Amount">$115</div>-->
                    <!--                            <div class="col col-4" data-label="Payment Status">Pending</div>-->
                    <!--                        </li>-->
                </div>
            </div>
        </div>
    </div>


    </body>

    </html>
    <?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>