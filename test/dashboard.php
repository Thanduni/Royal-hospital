<!-- importing configaration files -->

<?php

    session_start();
    require_once("../conf/config.php");
    if(isset($_SESSION['mailaddress']) && $_SESSION['userRole']=="Storekeeper") {


?>



<!-- html heading part -->


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASEURL . 'dash.css' ?>">
    <link rel="stylesheet" href="<?php echo BASEURL . 'style.css' ?>">
    <link rel="stylesheet" href="<?php echo BASEURL . 'addMedicine.css' ?>">
    <script src="https://kit.fontawesome.com/04b61c29c2.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/style.css' ?>">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .next {
            position: initial;
            height: auto;
        }
    </style>
    <title>Storekeeper Dashboard</title>
</head>


<!-- html body part -->

<body>

<div class="user">

<!-- importing storekeeper sidebar -->

<?php
$name = urlencode(($_SESSION['name']));
include(BASEURL . '/sidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name".$name);
?>

<div class="userContents" id="center">

</div>

</div>


</body>



<!--  -->






































<?php

}else{
        header("location: " .BASEURL . "/Homepage/login.php");
    }

?>