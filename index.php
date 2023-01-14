<?php
require_once("conf/config.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/style.css' ?>">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/index.css' ?>">
    <!--    <link rel="stylesheet" href="css/navandfooter.css">-->
    <title>Home</title>
    <style>
        b {
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
    <div class="slider">
        <input type="radio" name="slider" title="slide1" checked="checked" class="slider__nav"/>
        <input type="radio" name="slider" title="slide2" class="slider__nav"/>
        <input type="radio" name="slider" title="slide3" class="slider__nav"/>
        <div class="slider__inner">
            <?php
            $query = "SELECT * FROM homepagecontent";
            $result = $con->query($query);
            if (!$result) die("Database access failed: " . $con->error);
            $rows = $result->num_rows;

            for ($j = 0; $j < $rows; $j++) {
                $result->data_seek($j);
                $row = $result->fetch_array(MYSQLI_NUM);
                ?>
                <div class="slider__contents animate-left"
                     style="background: center / cover no-repeat url('<?php echo BASEURL . '/uploads/' . $row[3] ?>'), 0 #616161;"
                     class="slider-title">
                    <p style="color: white" class="slider-title"><?php echo $row[1] ?></p>
                    <p style="color: white" class="slider-description"><?php echo $row[2] ?></p>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="articleHome">
        <div class="doctorImage">
            <img src="<?php echo BASEURL . '/images/homepageDoctor.jpg' ?>" alt="homepageDoctor">
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
        <ul>
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

    <?php include(BASEURL . '/Components/Footer.php'); ?>

    <script>
        var slides = document.getElementsByName('slider');
        var  i = 0;

        setInterval(function () {
            slides[i % 3].click();
            i++;
        }, 4000);

    </script>

</section>


</body>

</html>