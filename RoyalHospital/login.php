<?php
require_once("DBconnect.php");
session_start();
if (!isset($_SESSION['mailaddress'])) {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <title>Login</title>
    </head>

    <body>
        <div class="page">
            <div class="p1">
                <div class="loginContents">
                    <p><img src="images/logo5.png" alt="logo" align="middle"><br>
                        Royal Hospital Management System
                    </p>
                    <?php
                    if (@$_GET['Empty'] == true) {
                    ?>
                        <div class="alert">
                            <?php
                            echo $_GET["Empty"];
                            ?>
                        </div>
                    <?php
                    } else if (@$_GET['Invalid'] == true) {
                    ?>
                        <div class="alert">
                            <?php
                            echo $_GET["Invalid"];
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                    <form action="loginProcess.php" method="post">
                        <input type="email" name="email" placeholder="Email"><br>
                        <input type="password" name="password" placeholder="Password"><br>
                        <button name="login">Login</button>
                    </form>
                </div>
            </div>
            <div class="p2"></div>
        </div>
    </body>

    </html>
<?php
} else {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <title>Login</title>
        <style>
            body {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }

            p,
            button {
                font-size: 20px;
                margin: 10px;
                color: #24354E;
            }

            h1 {
                margin: 10px;
                color: #24354E;
            }

            a {
                text-decoration: none;
                color: #24354E;
            }

            button {
                align-items: flex-end;
            }
        </style>
    </head>

    <body>
        <div class="alreadyLogged">
            <h1>Confirm</h1>
            <hr>
            <?php echo "<p>You are already logged in as "
                . $_SESSION['name'] . " you need to log 
            out before logging in as different user.</p>" ?>
            <hr>
            <button>
                <a href="logout.php?logout">
                    Logout
                </a>
            </button>
            <button>
                <a href="logout.php?cancel">
                    Cancel
                </a>
            </button>
        </div>
    </body>

    </html>

<?php
}
?>