<?php
session_start();
require_once("../conf/config.php");

// $GLOBALS['hash_val'] = $hash;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<body>
<form method="post" action="https://sandbox.payhere.lk/pay/checkout">   
    <input type="hidden" name="merchant_id" value="1222208">    <!-- Replace your Merchant ID -->
    <input type="hidden" name="return_url" value="http://sample.com/return">
    <input type="hidden" name="cancel_url" value="http://sample.com/cancel">
    <input type="hidden" name="notify_url" value="http://sample.com/notify">  
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
    <input type="hidden" name="hash" value="<?php $merchant_id = "1222208";
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
    echo $hash; ?>">    <!-- Replace with generated hash -->
    <input type="submit" value="Buy Now">   
</form> 
</body>
</html>

<!-- <?php  ?> -->