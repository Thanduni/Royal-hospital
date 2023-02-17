<?php
session_start();
//die( $_SESSION['profilePic']);
require_once("../conf/config.php");
if (isset($_SESSION['mailaddress']) && $_SESSION['userRole'] == 'Admin') {
    ?>

    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" href="<?php echo BASEURL . '/css/style.css' ?>">
        <link rel="stylesheet" href="<?php echo BASEURL . '/css/adminDash.css' ?>">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <style>
            .next {
                position: initial;
                height: auto;
            }
        </style>

        <title>Admin dashboard</title>
    </head>
    <body>
    <div class="user">
        <?php include(BASEURL . '/Components/AdminSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $_SESSION['name']); ?>
        <div class="userContents" id="center">
            <?php include(BASEURL . '/Components/nursetopbar.php');?>
            <div class="title">
                <img src="<?php echo BASEURL . '/images/logo5.png' ?>" alt="logo">
                Royal Hospital Management System
            </div>
            <ul>
                <li class="userType"><img src=<?php echo BASEURL . '/images/userInPage.svg' ?> alt="admin">
                    Admin
                </li>
                <li class="logout"><a href="<?php echo BASEURL . '/Homepage/logout.php?logout' ?>">Logout
                        <img
                                src=<?php echo BASEURL . '/images/logout.svg' ?> alt="logout"></a>
                </li>
            </ul>
            <div class="arrow">
                <img src=<?php echo BASEURL . '/images/arrow-right-circle.svg' ?> alt="arrow">Dashboard
            </div>
            <p id="second-head">Day analysis</p>
            <p style="color: #344168;  margin:20px;"> Date : <?php echo date("d - m - Y") ?>
            </p>
            <hr style="color: #344168; margin: 20px;">
            <div class="userDetails">
                <div class="card-set">
                    <?php
                    $sql = mysqli_query($con, "select count(*) from appointment where date ='".date("Y-m-d")."'");
                    $row = mysqli_fetch_array($sql);
                    ?>
                    <div>
                        <div class="card" style="max-height: 75px;">
                            Number of appointments
                            <p class="val"><?php echo $row['count(*)'] ?></p>
                        </div>
                        <?php
                        $query = "SELECT COUNT(appointment.appointmentID), user.name FROM appointment INNER JOIN doctor ON 
                            appointment.doctorID = doctor.doctorID INNER JOIN user ON doctor.nic = user.nic where patientID IS NOT NULL AND date ='".date("Y-m-d")."' GROUP BY user.name;";
                        $result = ($con->query($query));
                        $row = $result->fetch_all(MYSQLI_ASSOC);
                        ?>
                        <div class="card table">
                            <table>
                                <tr>
                                    <th>Doctor name</th>
                                    <th>Number of appointments</th>
                                </tr>
                                <?php
                                if (!empty($row))
                                    foreach ($row as $rows) {
                                        ?>
                                        <tr>
                                            <td><?php echo $rows['COUNT(appointment.appointmentID)'] ?></td>
                                            <td><?php echo $rows['name'] ?></td>
                                        </tr>
                                    <?php } ?>
                            </table>
                        </div>
                    </div>

                    <!--                <p id="second-head">Whole system analysis</p>-->
                    <?php
                    $sql1 = mysqli_query($con, "select count(*) from user;");
                    $row1 = mysqli_fetch_array($sql1);
                    $sql2 = mysqli_query($con, "select count(*) from storekeeper;");
                    $row2 = mysqli_fetch_array($sql2);
                    $sql3 = mysqli_query($con, "select count(*) from patient;");
                    $row3 = mysqli_fetch_array($sql3);
                    $sql4 = mysqli_query($con, "select count(*) from doctor;");
                    $row4 = mysqli_fetch_array($sql4);
                    $sql5 = mysqli_query($con, "select count(*) from receptionist;");
                    $row5 = mysqli_fetch_array($sql5);
                    ?>
                    <div class="card-set">

                        <div class="card">
                            Number of total users
                            <p class="val"><?php echo $row1['count(*)'] ?></p>
                        </div>
                        <div class="card">
                            Number of doctors
                            <p class="val"><?php echo $row2['count(*)'] ?></p>
                        </div>
                        <div class="card">
                            Number of nurses
                            <p class="val"><?php echo $row3['count(*)'] ?></p>
                        </div>
                    </div>
                    <div class="card-set">
                        <div class="card">
                            Number of receptionists
                            <p class="val"><?php echo $row4['count(*)'] ?></p>
                        </div>
                        <div class="card">
                            Number of storekeepers
                            <p class="val"><?php echo $row5['count(*)'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <aside>
                <p id="second-head">Tabs in use</p>
                <hr style="color: #344168; margin: 20px;">
                <div class="actorCards">
                    <ul>
                        <a href="<?php echo BASEURL . '/Admin/adminDash.php' ?>">
                            <li class="tab-cards" id="dashboard">Dashboard</li>
                        </a>
                        <a href="<?php echo BASEURL . '/Admin/adminUsersPage.php' ?>">
                            <li class="tab-cards" id="user">User</li>
                        </a>
                        <a href="<?php echo BASEURL . '/Admin/adminDoctorPage.php' ?>">
                            <li class="tab-cards" id="doctor">Doctor</li>
                        </a>
                        <a href="<?php echo BASEURL . '/Admin/adminNursePage.php' ?>">
                            <li class="tab-cards" id="nurse">Nurse</li>
                        </a>
                        <a href="">
                            <li class="tab-cards" id="receptionist">Receptionist</li>
                        </a>
                        <a href="<?php echo BASEURL . '/Admin/noticeboardHomepageEdit.php' ?>">
                            <li class="tab-cards" id="notice">Noticeboard</li>
                        </a>
                    </ul>
                </div>
            </aside>

        </div>
    </div>

    </body>
    </html>

    <?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>