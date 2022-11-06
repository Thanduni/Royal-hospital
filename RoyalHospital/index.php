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
    <title>Home</title>
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
                    <li><a href=""> Doctors </a></li>
                    <li><a href="login.php"> Login </a></li>
                </ul>
            </div>
        </nav>
        <div class="advertise">
            <div class="centered-element">
                <p class="slider-title">The skill to heal, the spirit to care</p>
                <p class="slider-description">Dedicated to providing multidisciplinary
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
                    <a href=""><button type="button">Book an appointment</button></a>
                </p>
            </div><br>

        </div>
        <div class="articleHome">
            <div class="doctorImage">
                <img src="images/homepageDoctor.jpg" alt="homepageDoctor">
            </div>
            <div class="hospitalArticle">
                <p style="font-size:26px" align="center">About Bayanno Diagnostic Center</p>
                <br>
                <p>Royal Hospital has been a trusted name in Sri Lankan healthcare
                    for more than seven Decades. Since our foundation in 1946, we have
                    built a reputation for regional leadership in medical excellence and innovation,
                    based on a simple philosophy: that improving the health of our community
                    should be driven by passion as well as compassion. Durdans Hospital offers 260
                    beds – including 60 in our critical care department – across a range of spacious
                    , modern rooms. We offer the best consultants, specialists and employees, all of whom are dedicated to providing
                    exceptional clinical outcomes and utmost customer satisfaction.
                    Royal Hospital is also proud to offer the industry-leading Heart Command Centre
                    and Heart Station, supported by the country’s finest cardiologists and cardiac surgeons.
                    With 15 beds and world-class facilities, the centre offers a comprehensive range of diagnostic tests,
                    advanced surgical treatments, cardiac rehabilitation and post-operative counselling.</p>
            </div>
        </div>
        <div class="midPortion">
            Our World Class Services

            Lorem ipsum dolor sit amet, consectetur adipiscing elit,
            sed do eiusmod tempor incididunt ut labore et dolore magna.
            Ut enim ad minim veniam.


        </div>
    </section>

</body>

</html>