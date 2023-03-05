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
            b {
                text-align: center;
                display: block;
            }

            .next {
                position: relative;
                height: auto;
            }

            .mySlides {
                display: none
            }

            .left, .right, .badge {
                cursor: pointer
            }

            .left{
                float: left!important;
                right: 123px;
                position: relative;
            }
            .right {
                float:right!important;
                left: 123px;
                position: relative;
            }
            .center{
                text-align:center!important;
            }

            .badge {
                height: 13px;
                width: 13px;
                padding: 0
            }

            .badge {
                background-color: #000;
                color: #fff;
                display: inline-block;
                padding-left: 8px;
                padding-right: 8px;
                text-align: center;
                border-radius: 50%
            }

            .border {
                border:1px solid #ccc!important;
            }

            .transparent {
                background-color:var(--secondary-color)!important;
            }

            transparent:hover
            {
                color:var(--secondary-color)!important;
                background-color:var(--para-color)!important;
            }
            hover-text-khaki:hover {
                color:#b4aa50!important;
            }

            .center {
                text-align:center!important;
                display:inline-block;
                width:auto
            }

            .container {
                padding:0.01em 16px;
            }

            .container:after,.container:before{
                content:"";
                display:table;
                clear:both
            }

            .large {
                font-size:18px!important;
            }

            .text-white {
                color:#fff!important;
            }

            .display-bottommiddle {
                position:absolute;
                left:21%;
                bottom: 0px;
                transform:translate(-50%,0%);
                -ms-transform:translate(-50%,0%)
            }

            .slider-section {
                display:block;
                margin-top:16px!important;
                margin-bottom:16px!important;
            }

            @media screen and (max-width: 1229px) {
                .next {
                    position: relative;
                    height: auto;
                }
                .left{
                    float: left!important;
                    right: 123px;
                    position: relative;
                }
                .right {
                    float:right!important;
                    left: 123px;
                    position: relative;
                }
                .center{
                    text-align:center!important;
                }
                .display-bottommiddle {
                    position:absolute;
                    left:50%;
                    bottom:-83px;
                    transform:translate(-50%,0%);
                    -ms-transform:translate(-50%,0%)
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
<!--            <div class="aboutUsImg">-->
<!--                <img src="--><?php //echo BASEURL . '/images/aboutUs.jpg' ?><!--" alt="homepageDoctor">-->
<!--            </div>-->
            <img class="mySlides" src="<?php echo BASEURL . '/images/aboutUs.jpg' ?>">
            <img class="mySlides" src="<?php echo BASEURL . '/images/hospital.jpg' ?>">
            <img class="mySlides" src="<?php echo BASEURL . '/images/aboutUs.jpg' ?>">
            <div class="center container slider-section large text-white display-bottommiddle aboutUsImg" >
                <div class="left hover-text-khaki" onclick="plusDivs(-1)">&#10094;</div>
                <div class="right hover-text-khaki" onclick="plusDivs(1)">&#10095;</div>
                <span class="badge demo border transparent hover-white" onclick="currentDiv(1)"></span>
                <span class="badge demo border transparent hover-white" onclick="currentDiv(2)"></span>
                <span class="badge demo border transparent hover-white" onclick="currentDiv(3)"></span>
            </div>
            <p style="text-align: justify; font-size: 20px;">
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
        <script>
            var slideIndex = 1;
            showDivs(slideIndex);

            function plusDivs(n) {
                showDivs(slideIndex += n);
            }

            function currentDiv(n) {
                showDivs(slideIndex = n);
            }

            function showDivs(n) {
                var i;
                var x = document.getElementsByClassName("mySlides");
                var dots = document.getElementsByClassName("demo");
                if (n > x.length) {slideIndex = 1}
                if (n < 1) {slideIndex = x.length}
                for (i = 0; i < x.length; i++) {
                    x[i].style.display = "none";
                }
                for (i = 0; i < dots.length; i++) {
                    dots[i].className = dots[i].className.replace(" w3-white", "");
                }
                x[slideIndex-1].style.display = "block";
                dots[slideIndex-1].className += " w3-white";
            }
        </script>
    </section>


    </body>

    </html>


    <?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>