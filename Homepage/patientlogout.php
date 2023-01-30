<?php
session_start();
require_once("../conf/config.php");

if (isset($_SESSION['name'])) { ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo BASEURL . '/css/patientlogin.css' ?>">
        <title>Patient Logout</title>
    </head>

    <body>
        <form action="" method="get">
                <div class="alreadyLogged">
                    <h1>Confirm</h1>
                    <hr>
                    <?php echo "<p>You are already logged in as "
                        . $_SESSION['name'] . " you need to log 
            out before logging in as different user.</p>" ?>
                    <hr>
                    <button>
                        <a href="<?php echo BASEURL . '/Homepage/patientlogout.php?logout' ?>">Logout</a>
                    </button>
                    <button>
                        <a href="<?php echo BASEURL . '/Homepage/patientlogout.php?cancel' ?>">Cancel</a>
                    </button>
                </div>
        </form>
    </body>

    </html>
    <?php


    if (isset($_GET['logout'])) {
        session_destroy();
        header("location:" . BASEURL . "/Homepage/login.php");
    } else if (isset($_GET['cancel'])) {
        header("location: " . BASEURL . "/patient/patientDash.php");
    }
?>
<?php }
?>