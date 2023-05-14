<?php
require_once("conf/config.php");

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
        <script src="https://kit.fontawesome.com/04b61c29c2.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&display=swap" rel="stylesheet">
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
        <div class="displayInfo">
<!--            <div>-->
<!--                <i id="close" class="fa-solid fa-rectangle-xmark" onclick="hideDetails()"></i>-->
<!--            </div>-->
<!--            <div id="imgHolder">-->
<!--                <img src="uploads/art-hauntington-jzY0KRJopEI-unsplash.jpg">-->
<!--                <text style="font-weight: 600; font-size: 25px">Raman</text>-->
<!--            </div>-->
<!--            <hr style="width: 80%;">-->
<!--            <ul>-->
<!--                <li>-->
<!--                    <strong>Phone:</strong>-->
<!--                    <span>077 848 9936</span>-->
<!--                </li>-->
<!--            </ul>-->
        </div>
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
                    <div class="slider__contents"
                         style="background: center / cover no-repeat url('<?php echo BASEURL . '/uploads/' . $row[3] ?>'), 0 #B5E2FA; background-attachment: fixed"
                         class="slider-title">
                        <p style="color: white; font-family:'Lato'" class="slider-title"><?php echo $row[1] ?></p>
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
                <p style="font-size:26px;text-align: center;font-weight: 900; font-family:'Lato'">About Royal hospital</p>
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

            <!--        </div>-->
<!---->
<!--        <div>-->

        </div>

        <p style="font-size:26px; color: var(--para-color); text-align: center;font-weight: 900; font-family:'Lato'">Our Departments</p>
        <section class="hero-section">
            <div class="card-grid">
                <div class="card">
                    <div class="card__background" style="background-image: url(images/gas.jpg);    box-shadow: 8px 8px 22px var(--primary-color), -8px -8px 22px var(--primary-color);"></div>
                    <div class="card__content">
                        <h3 class="card__heading">Gastroenterology</h3>
                    </div>
                </div>
                <div class="card">
                    <div class="card__background" style="background-image: url(images/neurology.jpg);    box-shadow: 8px 8px 22px var(--primary-color), -8px -8px 22px var(--primary-color);"></div>
                    <div class="card__content">
                        <h3 class="card__heading">Neurology</h3>
                    </div>
                </div>
                <div class="card">
                    <div class="card__background" style="background-image: url(images/heart.jpg);    box-shadow: 8px 8px 22px var(--primary-color), -8px -8px 22px var(--primary-color);"></div>
                    <div class="card__content">
                        <h3 class="card__heading">Cardiology</h3>
                    </div>
                </div>
                    <div>
        </section>

        <p style="font-size:26px; color: var(--para-color);text-align: center;font-weight: 900; font-family:'Lato'">Our Doctors</p>

        <?php
        $query = "SELECT * FROM user inner join doctor on user.nic=doctor.nic";
        $result = $con->query($query);
        if (!$result) die("Database access failed: " . $con->error);
        $rows = $result->num_rows;
        ?>

        <section class="hero-section">
            <div class="card-grid">
    <?php
    for ($j = 0; $j < $rows; ++$j) {
        $result->data_seek($j);
        $row = $result->fetch_array(MYSQLI_ASSOC);
        ?>
                <div class="card" onmouseover="displayDocButton(<?php echo $row['doctorID']; ?>)" onmouseout="hideDocButton(<?php echo $row['doctorID']; ?>)">
                    <div class="card__background doctor" style="background-image: url(uploads/<?php echo $row['profile_image'] ?>); box-shadow: 8px 8px 22px var(--dec-color-1), -8px -8px 22px var(--dec-color-1);"></div>
                    <div class="card__content">
                        <p class="card__category"><?php echo $row['department'] ?></p>
                        <h3 class="card__heading"><?php echo $row['name'] ?></h3>
                        <button id="doctor_<?php echo $row['doctorID']; ?>" class="hide doctorInfo custom-btn" onclick="displayDetails(<?php echo $row['nic'] ?>)">View details</button>
                    </div>
                </div>
        <?php } ?>
                    <div>
        </section>

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

    <script>
        function displayDocButton(id){
            let button = document.getElementById("doctor_"+id);
            button.classList.remove('hide');
            button.classList.add('active');
        }

        function hideDocButton(id){
            let button = document.getElementById("doctor_"+id);
            button.classList.remove('active');
            button.classList.add('hide');
        }
    </script>

    <script src="<?php echo BASEURL . '/js/docInfo.js' ?>"></script>
    </body>

    </html>
    <?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>