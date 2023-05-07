<?php
session_start();
//die( $_SESSION['profilePic']);
require_once("../conf/config.php");
if (isset($_SESSION['mailaddress']) && $_SESSION['userRole'] == 'Receptionist') {
    ?>

    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" href="<?php echo BASEURL . '/css/style.css' ?>">
        <link rel="stylesheet" href="<?php echo BASEURL . '/css/receptionistDash.css' ?>">
        <link rel="stylesheet" href="https://cdn.iconscout.com/iconscout-1.0.0-beta/iconscout.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://kit.fontawesome.com/04b61c29c2.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <style>
            .next {
                position: initial;
                height: auto;
            }
            .sidebarMenuInner p{
                font-size: 13px;
            }
        </style>
        <title>Receptionist dashboard</title>
    </head>
    <body>
    <div class="user">
        <?php
        $name = urlencode( $_SESSION['name']);
        include(BASEURL . '/Components/ReceptionistSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name); ?>
        <div class="userContents" id="center">
            <?php
            $name = urlencode( $_SESSION['name']);
            include(BASEURL.'/Components/receptionistTopbar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name . "&userRole=" . $_SESSION['userRole']. "&nic=" . $_SESSION['nic']);
            ?>
            <div class="arrow">
                <img src=<?php echo BASEURL . '/images/arrow-right-circle.svg' ?> alt="arrow">Dashboard
            </div>
            <aside>
                <div class="actorCards">
                    <ul>
                        <a href="<?php echo BASEURL . '/Receptionist/makeAppointment.php' ?>">
                            <li class="tab-cards" id="appointments">Make Appointment
                                <div>
                                    <img class="cardIcon" style="float: right" src="<?php echo BASEURL."/images/calenderCard.png"?>" alt="">
                                </div>
                            </li>
                        </a>
                        <a href="<?php echo BASEURL . '/Receptionist/patientPage.php' ?>">
                            <li class="tab-cards" id="bills">
                                Patient
                                <div>
                                    <img class="cardIcon" style="float: right" src="<?php echo BASEURL."/images/patient.png"?>" alt="">
                                </div>
                            </li>
                        </a>
                        <a href="<?php echo BASEURL . '/Receptionist/viewbillPage.php' ?>">
                            <li class="tab-cards" id="bills">Bills
                                <div>
                                    <img class="cardIcon" right" src="<?php echo BASEURL."/images/receipt.png"?>" alt="">
                                </div>
                            </li>
                        </a>
                        <a href="<?php echo BASEURL . '/Receptionist/updateReceptionistProfile.php' ?>">
                            <li class="tab-cards" id="profile">Profile
                                <div>
                                    <img class="cardIcon" style="float: right" src="<?php echo BASEURL."/images/profile.png"?>" alt="">
                                </div>
                            </li>
                        </a>
                    </ul>
                </div>
                <?php
                $np_service = mysqli_query($con, "select sum(cost * quantity) as cost from purchases inner join service on purchases.item = service.serviceID where purchases.paid_status = 'not paid' 
                                and MONTH(purchases.date) = MONTH(NOW()) and YEAR(purchases.date) = YEAR(NOW()) group by purchases.item_flag having purchases.item_flag = 's';");
                $np_test = mysqli_query($con, "select sum(cost * quantity) as cost from purchases inner join test on purchases.item = test.testID where purchases.paid_status = 'not paid'
                                and MONTH(purchases.date) = MONTH(NOW()) and YEAR(purchases.date) = YEAR(NOW()) GROUP BY purchases.item_flag having purchases.item_flag = 't';");
                $np_drug = mysqli_query($con, "select sum(unit_price * quantity) as cost from purchases inner join item on purchases.item = item.itemID where purchases.paid_status = 'not paid' 
                                and MONTH(purchases.date) = MONTH(NOW()) and YEAR(purchases.date) = YEAR(NOW()) GROUP BY purchases.item_flag HAVING purchases.item_flag = 'd';");

                $np_sum = 0;
                $np_serviceRow = mysqli_fetch_assoc($np_service);
                $np_testRow = mysqli_fetch_assoc($np_test);
                $np_drugRow = mysqli_fetch_assoc($np_drug);
                if(isset($np_serviceRow['cost']))
                {
                    $np_sum += intval($np_serviceRow['cost']);
                }
                if(isset($np_testRow['cost'])){
                    $np_sum += intval($np_testRow['cost']);
                }
                if(isset($np_drugRow['cost'])){
                    $np_sum += intval($np_drugRow['cost']);
                }

                $p_service = mysqli_query($con, "select sum(cost * quantity) as cost from purchases inner join service on purchases.item = service.serviceID where purchases.paid_status = 'paid' 
                                and MONTH(purchases.date) = MONTH(NOW()) and YEAR(purchases.date) = YEAR(NOW()) group by purchases.item_flag having purchases.item_flag = 's';");
                $p_test = mysqli_query($con, "select sum(cost * quantity) as cost from purchases inner join test on purchases.item = test.testID where purchases.paid_status = 'paid'
                                and MONTH(purchases.date) = MONTH(NOW()) and YEAR(purchases.date) = YEAR(NOW()) GROUP BY purchases.item_flag having purchases.item_flag = 't';");
                $p_drug = mysqli_query($con, "select sum(unit_price * quantity) as cost from purchases inner join item on purchases.item = item.itemID where purchases.paid_status = 'paid' 
                                and MONTH(purchases.date) = MONTH(NOW()) and YEAR(purchases.date) = YEAR(NOW()) GROUP BY purchases.item_flag HAVING purchases.item_flag = 'd';");

                $p_sum = 0;
                $p_serviceRow = mysqli_fetch_assoc($p_service);
                $p_testRow = mysqli_fetch_assoc($p_test);
                $p_drugRow = mysqli_fetch_assoc($p_drug);

                if(isset($p_serviceRow['cost'])){
                    $p_sum += intval($p_serviceRow['cost']);
                }
                if(isset($p_testRow['cost'])){
                    $p_sum += intval($p_testRow['cost']);
                }
                if(isset($p_drugRow['cost'])){
                    $p_sum += intval($p_drugRow['cost']);
                }

                ?>
                <div style="display: flex; flex-wrap: wrap">
                    <div class="BundleCard">
                        <div class="costInfo">
                            <div class="first">
                                <div id="id1">
                                    <img class="cardIcon" style="float: right" src="<?php echo BASEURL."/images/profit.png"?>" alt="">
                                </div>
                                <div id="id1">
                                    <img class="cardIcon" style="float: right" src="<?php echo BASEURL."/images/loss.png"?>" alt="">
                                </div>
                            </div>
                            <div class="second">
                                <div id="id2">
                                    Income
                                </div>
                                <div id="id2">
                                    Pending payment
                                </div>
                            </div>
                            <div class="third">
                                <div>
                                    <?php echo "Rs.".$p_sum?>
                                </div>
                                <div>
                                    <?php echo "Rs.".$np_sum?>
                                </div>
                            </div>
                        </div>

                        <div class="graph">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>

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
                    <div class="divider">
                        <div class="card-set">
                                <div class="card">
                                    Number of total users
                                    <img style="margin: 10px" class="cardIcon" style="float: right"
                                         src="<?php echo BASEURL . "/images/userCard.png" ?>" alt="">

                                    <p class="val"><?php echo $row1['count(*)'] ?></p>
                                </div>
                                <div class="card">
                                    Number of doctors
                                    <img style="margin: 10px" class="cardIcon" style="float: right"
                                         src="<?php echo BASEURL . "/images/doctorCard.png" ?>" alt="">
                                    <p class="val"><?php echo $row4['count(*)'] ?></p>
                                </div>
                                <div class="card">
                                    Number of nurses
                                    <img style="margin: 10px" class="cardIcon" style="float: right"
                                         src="<?php echo BASEURL . "/images/nurseCard.png" ?>" alt="">
                                    <p class="val"><?php echo $row6['count(*)'] ?></p>
                                </div>
                            <div class="card">
                                Number of Patients
                                <img style="margin: 10px" class="cardIcon" style="float: right"
                                     src="<?php echo BASEURL . "/images/patientCard.png" ?>" alt="">
                                <p class="val"><?php echo $row3['count(*)'] ?></p>
                            </div>
                            <!--                        </div>-->
                            <!--                        <div class="card-set">-->
                                <div class="card">
                                    Number of receptionists
                                    <img style="margin: 10px" class="cardIcon" style="float: right"
                                         src="<?php echo BASEURL . "/images/receptionistCard.png" ?>" alt="">
                                    <p class="val"><?php echo $row5['count(*)'] ?></p>
                                </div>
                                <div class="card">
                                    Number of storekeepers
                                    <img style="margin: 10px" class="cardIcon" style="float: right"
                                         src="<?php echo BASEURL . "/images/storekeeperCard.png" ?>" alt="">
                                    <p class="val"><?php echo $row2['count(*)'] ?></p>
                                </div>
                        </div>
                    </div>
                </div>

            </aside>
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
        canvas.width = 650;
        canvas.height = 650;

        // Set the width and height of the container element
        var container = document.querySelector('#myChart').parentNode;
        container.style.width = '650px';
        container.style.height = '420px';
    </script>

    </body>
    </html>

    <?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>