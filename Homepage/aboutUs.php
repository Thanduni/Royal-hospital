<?php
require_once("../conf/config.php");
session_start();
//die( $_SESSION['profilePic']);

if (!isset($_SESSION['mailaddress'])) {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo BASEURL . '/css/style.css' ?>">
        <link rel="stylesheet" href="<?php echo BASEURL . '/css/index.css' ?>">
        <link rel="stylesheet" href="<?php echo BASEURL . '/css/aboutUs.css' ?>">
        <!--    <link rel="stylesheet" href="css/navandfooter.css">-->
        <title>About us</title>
        <style>
            b{
                text-align: center;
                display: block;
            }

            .next {
                position: relative;
                height: auto;
            }

            @media screen and (max-width: 1229px) {
                .next {
                    position: relative;
                    height: auto;
                }
            }
        </style>
    </head>

    <body>

    <section class="header">
        <?php include(BASEURL . '/Components/Navbar.php'); ?>
        <div class="advertise">
            <div class="hey">
                <p style="color: white" class="title">About Us</p>
            </div>
        </div>
        <?php
        $query = "SELECT * FROM aboutusinfo";
        $result = $con->query($query);
        $result->data_seek(0);
        $row = $result->fetch_array(MYSQLI_NUM);
        ?>
        <div class="aboutUs">
            <p style="text-align: justify; font-size: 20px">
                <?php echo $row[0] ?>
            </p>
        </div>
        <div class="midPortion">
            <h4>Our World Class Services</h4>

            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                sed do eiusmod tempor incididunt ut labore et dolore magna.
                Ut enim ad minim veniam.</p>
        </div>
        <div class="cards">
            <ul>
                <li id="home1"><b>Careers With Us</b>
                    We’re proud to belong to a pioneer in healthcare that
                    continuously innovates. We welcome passionate individuals
                    who want to be part of our growing legacy.
                </li>
                <li id="home2"><b>Corporate Services</b>
                    From wellness to preventive care to treatment of
                    illnesses to rehabilitation.
                </li>
                <li id="home3"><b>Health Check ups</b>
                    Make an appointment with our panel of expert physicians
                    and learn about maintaining a wholesome lifestyle and
                    good health.
                </li>
                <li id="home4"><b>Clinical Laboratory Services</b>
                    Our laboratory network spreading across 86 branches
                    comprises of 06 medical centres, 08 main laboratories,
                    18 mini labs and 54 collection centres islandwide.
                </li>
            </ul>
        </div>

        <?php include(BASEURL . '/Components/Footer.php'); ?>

    </section>


    </body>

    </html>


    <?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>