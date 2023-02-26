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
        <script src="https://kit.fontawesome.com/04b61c29c2.js" crossorigin="anonymous"></script>
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
                        <a href="">
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
                <div>
                    <div class="costInfo">
                        <div>
                            <div id="id1">
                                <img class="cardIcon" style="float: right" src="<?php echo BASEURL."/images/profit.png"?>" alt="">
                            </div>
                            <div id="id2">
                                Income
                            </div>
                        </div>
                        <div>
                            <div id="id1">
                                <img class="cardIcon" style="float: right" src="<?php echo BASEURL."/images/loss.png"?>" alt="">
                            </div>
                            <div id="id2">
                                Pending payment
                            </div>
                        </div>
                    </div>
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