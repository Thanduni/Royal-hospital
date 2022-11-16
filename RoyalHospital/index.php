<?php
require_once("DBconnect.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <!--    <link rel="stylesheet" href="css/navandfooter.css">-->
    <title>Home</title>
    <style>
        b{
            text-align: center;
            display: block;
        }
    </style>
</head>

<body>
<section class="header">
    <nav>
        <a href="index.php">
            <p><img src="images/logo5.png" alt="logo" align="middle">
                Royal Hospital Management System
            </p>
        </a>
        <div class="nav-links">
            <ul>
                <li><a href=""> Home </a></li>
                <li><a href=""> About us </a></li>
                <li><a href=""> Appointment </a></li>
                <li><a href=""> Register patient </a></li>
                <li><a href="login.php"> Login </a></li>
            </ul>
        </div>
    </nav>
    <div class="advertise">
        <div class="centered-element">
            <p style="color: white" class="slider-title">The skill to heal, the spirit to care</p>
            <p style="color: white" class="slider-description">Dedicated to providing multidisciplinary
                medical care and backed by state-of-the-art facilities.</p>
        </div>
    </div>
    <div class="options">
        <div class="optionA">
            <p>
                <img src="images/Vector.svg" alt="Phone"><br>
                Emergency contact <br><br>
                123-456-789
            </p>
        </div>
        <div class="optionB">
            <p>
                <img src="images/calendar.svg" alt="calender"><br>
                Doctor appointment <br><br>
                <a href="">
                    <button type="button">Book an appointment</button>
                </a>
            </p>
        </div>
        <br>

    </div>
    <div class="articleHome">
        <div class="doctorImage">
            <img src="images/homepageDoctor.jpg" alt="homepageDoctor">
        </div>
        <div class="hospitalArticle">
            <p style="font-size:26px;text-align: center">About Bayanno Diagnostic Center</p>
            <br>
            <p>Royal Hospital has been a trusted name in Sri Lankan healthcare
                for more than seven Decades. Since our foundation in 1946, we have
                built a reputation for regional leadership in medical excellence and innovation,
                based on a simple philosophy: that improving the health of our community
                should be driven by passion as well as compassion. Durdans Hospital offers 260
                beds – including 60 in our critical care department – across a range of spacious
                , modern rooms. We offer the best consultants, specialists and employees, all of whom are dedicated to
                providing
                exceptional clinical outcomes and utmost customer satisfaction.
                Royal Hospital is also proud to offer the industry-leading Heart Command Centre
                and Heart Station, supported by the country’s finest cardiologists and cardiac surgeons.
                With 15 beds and world-class facilities, the centre offers a comprehensive range of diagnostic tests,
                advanced surgical treatments, cardiac rehabilitation and post-operative counselling.</p>
        </div>
    </div>
    <div class="midPortion">
        <h4>Our World Class Services</h4>

        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,
            sed do eiusmod tempor incididunt ut labore et dolore magna.
            Ut enim ad minim veniam.</p>
    </div>
    <div class="cards">
        <ul >
            <li><b>Careers With Us</b>
                We’re proud to belong to a pioneer in healthcare that
                continuously innovates. We welcome passionate individuals
                who want to be part of our growing legacy.
            </li>
            <li><b>Corporate Services</b>
                From wellness to preventive care to treatment of
                illnesses to rehabilitation.
            </li>
            <li><b>Health Check ups</b>
                Make an appointment with our panel of expert physicians
                and learn about maintaining a wholesome lifestyle and
                good health.
            </li>
            <li><b>Clinical Laboratory Services</b>
                Our laboratory network spreading across 86 branches
                comprises of 06 medical centres, 08 main laboratories,
                18 mini labs and 54 collection centres islandwide.
            </li>
        </ul>
    </div>

    <div class="next">
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="footer-col" id="one">

                        <img src="images/logo5.png" alt="">
                        <p class="slogen">Modern medicine is a negation of health. It isn’t organised to serve human
                            health, but only itself, as
                            an institution. It makes more people sick than it heals.</p>
                        <hr style="background-color: #ADB6CD">
                        <p class="txt"><i class="fa fa-copyright" aria-hidden="true"></i> 2021 All Rights Reserved</p>
                    </div>
                    <div class="footer-col" id="three">
                        <h4>follow us</h4>
                        <div class="social-links">
                            <a href="#https://web.facebook.com/UCSC.LK"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                        <h4>Contact us</h4>
                        <ul>
                            <li><a href=><i class="fa fa-map-marker"></i> 41 Station Road LEICESTER LE26 4FY</a></li>
                            <li><i class="fa fa-envelope" aria-hidden="true"></i> royalhospital@gmail.com</li>
                        </ul>
                    </div>
                    <div class="footer-col" id="two">
                        <h4>follow us</h4>
                        <ul>
                            <li><a href=""> Home </a></li>
                            <li><a href=""> About us </a></li>
                            <li><a href=""> Appointment </a></li>
                            <li><a href=""> Register patient </a></li>
                            <li><a href="login.php"> Login </a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </footer>
    </div>


</section>

</body>

</html>