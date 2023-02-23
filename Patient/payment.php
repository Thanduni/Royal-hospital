<?php
session_start();
require_once("../conf/config.php");

// if(isset($_SESSION['mailaddress']) && $_SESSION['userRole'] == 'Patient'){
    
//         // $merchant_id = $_POST['merchant_id'];
//         // $order_id = $_POST['order_id'];
//         // $amount = $_POST['amount'];
//         // $currency = $_POST['currency'];
//         // $merchant_secret = "MzcyNTg5MzM2MzU0MjIyMTk3MDQyMjIwMDg1Mjk0MTgzODk4MDk4";

//         $merchant_id = "1222208";
//         $order_id = "ItemNo12345";
//         $amount = "1000";
//         $currency = "LKR";
//         $merchant_secret = "MzcyNTg5MzM2MzU0MjIyMTk3MDQyMjIwMDg1Mjk0MTgzODk4MDk4";
        
//         $hash = strtoupper(
//         md5(
//             $merchant_id . 
//             $order_id . 
//             number_format($amount, 2, '.', '') . 
//             $currency .  
//             strtoupper(md5($merchant_secret)) 
//         ) 
//     );

// $GLOBALS['hash_val'] = $hash;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="post" action="https://sandbox.payhere.lk/pay/checkout">   
    <input type="hidden" name="merchant_id" value="1222208">    <!-- Replace your Merchant ID -->
    <input type="hidden" name="return_url" value="http://localhost:8080/ROYALHOSPITAL/Patient/patientDash.php">
    <input type="hidden" name="cancel_url" value="http://localhost:8080/ROYALHOSPITAL/Patient/patientDash.php">
    <input type="hidden" name="notify_url" value="http://localhost:8080/ROYALHOSPITAL/Patient/payment.php">  
    </br></br>Item Details</br>
    <input type="text" name="order_id" value="ItemNo12345">
    <input type="text" name="items" value="Door bell wireless">
    <input type="text" name="currency" value="LKR">
    <input type="text" name="amount" value="1000">  
    </br></br>Customer Details</br>
    <input type="text" name="first_name" value="Saman">
    <input type="text" name="last_name" value="Perera">
    <input type="text" name="email" value="samanp@gmail.com">
    <input type="text" name="phone" value="0771234567">
    <input type="text" name="address" value="No.1, Galle Road">
    <input type="text" name="city" value="Colombo">
    <input type="hidden" name="country" value="Sri Lanka">
    <input type="hidden" name="hash" value="<?php 
        $merchant_id = "1222208";
        $order_id = "ItemNo12345";
        $amount = "1000";
        $currency = "LKR";
        $merchant_secret = "MzcyNTg5MzM2MzU0MjIyMTk3MDQyMjIwMDg1Mjk0MTgzODk4MDk4";
        
        $hash = strtoupper(
        md5(
            $merchant_id . 
            $order_id . 
            number_format($amount, 2, '.', '') . 
            $currency .  
            strtoupper(md5($merchant_secret)) 
        ) 
    );  
    $GLOBALS['hash_val'] = $hash;
    echo $hash_val ?>">    <!-- Replace with generated hash -->
    <input name="submit" type="submit" value="Buy Now">   
</form> 
</body>
</html>

<!-- <?php  ?> -->