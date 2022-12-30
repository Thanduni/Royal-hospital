<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASEURL . '/public/assets/css/style.css' ?>">
    <title>Login</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            float: right;
        }

        p,
        button {
            font-size: 20px;
            margin: 10px;
            color: #24354E;
        }

        button {
            float: right;
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
    <form action="<?php echo BASEURL . '/Homepage/logoutCheck'; ?>" method="post">
        <button name="logout">
            Logout
        </button>
        <button>
            <a href="<?php if(isset($_GET['url'])) echo $_GET['url']; else echo BASEURL . '/Homepage'; ?>">
                Cancel
            </a>
        </button>
    </form>
</div>
</body>

</html>