<?php session_start(); ?>
<?php require_once('connection.php'); ?>
<?php
//check for form submission
if(isset($_POST['submit'])){
    $errors = array();
    //check if the username and password has been entered
    if(!isset($_POST['email']) || strlen(trim($_POST['email'])) < 1){
        $errors[] = 'username is missing or invalid';
    }
    if(!isset($_POST['password']) || strlen(trim($_POST['password'])) < 1){
        $errors[] = 'password is missing or invalid';
    }
    //check if there are any errors in the form
    if(empty($errors)){
        //save username and password into variables
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);
        
        // $hashed_password = sha1($password);

        //prepare database query
        $query = "SELECT * FROM user WHERE email= '{$email}' AND password ='{$password}'
        LIMIT 1";


        $result_set = mysqli_query($connection,$query);

        
        if($result_set){
            if(mysqli_num_rows($result_set) ==1 ){
                //valid user found
                $user = mysqli_fetch_assoc($result_set);
                $_SESSION['user_id'] = $user['nic'];
                $_SESSION['user_name'] = $user['name'];

                header('Location: nursedashboard.php');
            }else{
                $errors[] = 'Invalid user name or password';
            }
        }else {
            $errors[] = 'Database query failed';
        }
    }
}
?>
<style>
    <?php include 'index.css';
    ?>
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="index.css">
</head>


<body>
    <div class="login">
        <form action="index.php" method="post">
            <fieldset>
                <legend><h1>Log in</h1></legend>
                <?php
                if(isset($errors) && !empty($errors)){
                    echo '<p class="error">Invadid Usename/password</p>';
                }
                ?>
                <!-- <p class="error">Invadid Usename/password</p> -->
                <p>
                    <label for="">Username:</label>
                    <input type="text" name="email" id="" placeholder="Email address">
                </p>
                <p>
                    <label for="">Password</label>
                    <input type="password" name="password" placeholder="Password">
                </p>
                <p>
                    <button type="submit" name="submit">Log in</button>
                </p>
            </fieldset>
        </form>
    </div>

</body>

</html>