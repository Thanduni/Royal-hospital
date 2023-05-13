<?php
session_start();
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://kit.fontawesome.com/04b61c29c2.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.js"></script>
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
        <?php include(BASEURL . '/Components/AdminSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $_SESSION['name']) ?>
        <div class="userContents" id="center">
            <?php
            $name = urlencode($_SESSION['name']);
            include(BASEURL . '/Components/adminTopbar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name . "&userRole=" . $_SESSION['userRole'] . "&nic=" . $_SESSION['nic']);
            ?>
            <div class="arrow">
                <img src=<?php echo BASEURL . '/images/arrow-right-circle.svg' ?> alt="arrow">Dashboard
            </div>
            <p id="second-head">Day analysis</p>
            <p style="color: #344168;  margin:20px;"> Date : <?php echo date("d - m - Y") ?>
            </p>
            <div class="userDetails">
                <div class="card-set">
                    <?php
                    $sql = mysqli_query($con, "select count(*) from appointment where date ='" . date("Y-m-d") . "'");
                    $row = mysqli_fetch_array($sql);
                    ?>
                    <div class="dividerA">
                        <div class="card" style="max-height: 75px;">
                            <div>
                                <img class="cardIcon" style="float: right"
                                     src="<?php echo BASEURL . "/images/medical-appointment.png" ?>" alt="">
                            </div>
                            Number of appointments
                            <p class="val"><?php echo $row['count(*)'] ?></p>
                        </div>
                        <?php
                        $query = "SELECT COUNT(appointment.appointmentID), user.name FROM appointment INNER JOIN doctor ON 
                            appointment.doctorID = doctor.doctorID INNER JOIN user ON doctor.nic = user.nic where patientID IS NOT NULL AND date ='" . date("Y-m-d") . "' GROUP BY user.name;";
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
                                            <td><?php echo $rows['name'] ?></td>
                                            <td><?php echo $rows['COUNT(appointment.appointmentID)'] ?></td>
                                        </tr>
                                    <?php } ?>
                            </table>
                        </div>
                    </div>
                    <!--                <p id="second-head">Whole system analysis</p>-->
                    <?php
                    $sql1 = mysqli_query($con, "select count(*) from user;");
                    $row1 = mysqli_fetch_array($sql1);
                    $sql2 = mysqli_query($con, "select count(*) from user where user_role = 'Storekeeper';");
                    $row2 = mysqli_fetch_array($sql2);
                    $sql3 = mysqli_query($con, "select count(*) from user where user_role = 'patient';");
                    $row3 = mysqli_fetch_array($sql3);
                    $sql4 = mysqli_query($con, "select count(*) from user where user_role = 'doctor';");
                    $row4 = mysqli_fetch_array($sql4);
                    $sql5 = mysqli_query($con, "select count(*) from user where user_role = 'Receptionist';");
                    $row5 = mysqli_fetch_array($sql5);
                    $sql6 = mysqli_query($con, "select count(*) from user where user_role = 'nurse';");
                    $row6 = mysqli_fetch_array($sql6);
                    ?>
                    <div class="dividerB">
                        <div class="card-set">
                            <a href="<?php echo BASEURL . '/Admin/adminUsersPage.php' ?>">
                                <div class="card">
                                    Number of total users
                                    <img style="margin: 10px" class="cardIcon" style="float: right"
                                         src="<?php echo BASEURL . "/images/userCard.png" ?>" alt="">

                                    <p class="val"><?php echo $row1['count(*)'] ?></p>
                                </div>
                            </a>
                            <a href="<?php echo BASEURL . '/Admin/adminDoctorPage.php' ?>">
                                <div class="card">
                                    Number of doctors
                                    <img style="margin: 10px" class="cardIcon" style="float: right"
                                         src="<?php echo BASEURL . "/images/doctorCard.png" ?>" alt="">
                                    <p class="val"><?php echo $row4['count(*)'] ?></p>
                                </div>
                            </a>
                            <a href="<?php echo BASEURL . '/Admin/adminNursePage.php' ?>">
                                <div class="card">
                                    Number of nurses
                                    <img style="margin: 10px" class="cardIcon" style="float: right"
                                         src="<?php echo BASEURL . "/images/nurseCard.png" ?>" alt="">
                                    <p class="val"><?php echo $row6['count(*)'] ?></p>
                                </div>
                            </a>
                                <div class="card">
                                    Number of Patients
                                    <img style="margin: 10px" class="cardIcon" style="float: right"
                                         src="<?php echo BASEURL . "/images/patientCard.png" ?>" alt="">
                                    <p class="val"><?php echo $row3['count(*)'] ?></p>
                                </div>
<!--                        </div>-->
<!--                        <div class="card-set">-->
                            <a href="<?php echo BASEURL . '/Admin/adminReceptionistPage.php' ?>">
                                <div class="card">
                                    Number of receptionists
                                    <img style="margin: 10px" class="cardIcon" style="float: right"
                                         src="<?php echo BASEURL . "/images/receptionistCard.png" ?>" alt="">
                                    <p class="val"><?php echo $row5['count(*)'] ?></p>
                                </div>
                            </a>
                            <a href="<?php echo BASEURL . '/Admin/adminStorekeeperPage.php' ?>">
                                <div class="card">
                                    Number of storekeepers
                                    <img style="margin: 10px" class="cardIcon" style="float: right"
                                         src="<?php echo BASEURL . "/images/storekeeperCard.png" ?>" alt="">
                                    <p class="val"><?php echo $row2['count(*)'] ?></p>
                                </div>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
            <div class="BundleCard">
                <div class="graph">
                    <canvas id="myChart" height="200" width="400"></canvas>
                </div>
            </div>
        </div>
    </div>
    <script>



        function getData() {
            return new Promise(function(resolve) {
                $.ajax({
                    type: "GET",
                    url: "getGraphDetails.php",
                    success: function(response) {
                        let result = $.parseJSON(response);
                        resolve(result);
                    },
                    error: function(xhr, status, error) {
                        console.log("Error: " + error);
                    }
                });
            });
        }

        let male, female;
        var graphDetails = getData();

        async function myFunction() {
            try {
                const result = await graphDetails;
                console.log(result[0]) ;
                let myChart = new Chart(document.getElementById('myChart'), {
                    type: 'bar',
                    data: {
                        labels: ["Receptionist", "Doctor", "Nurse", "Patient", 'Storekeeper'],
                        datasets: [{
                            label: "Male",
                            data: result[0],
                            backgroundColor: "#002e72",
                            borderColor: 'transparent',
                            borderWidth: 2.5,
                            barPercentage: 0.4,
                        }, {
                            label: "Female",
                            startAngle: 2,
                            data: result[1],
                            backgroundColor: "#3c77c6",
                            borderColor: 'transparent',
                            borderWidth: 2.5,
                            barPercentage: 0.4,
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                gridLines: {},
                                ticks: {
                                    stepSize: 15,
                                },
                            }],
                            xAxes: [{
                                gridLines: {
                                    display: false,
                                }
                            }]
                        }
                    }
                })
            } catch(error) {
                console.error(error);
            }
        }

        myFunction();

        var canvas = document.getElementById('myChart');
        canvas.width = '200';
        canvas.height = '50';

        // Set the width and height of the container element
        // var container = document.querySelector('#myChart').parentNode;
        // container.style.width = '50px';
        // container.style.height = '50px';
    </script>
    </body>
    </html>

    <?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>