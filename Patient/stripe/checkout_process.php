<?php

include('../stripe/stripe-php/init.php');

session_start();
// require_once '../vendor/autoload.php';
require_once '../stripe/secrets.php';

\Stripe\Stripe::setApiKey('sk_test_51Mee0bK432Tp6pbC2IFI7EttuniB0JxwduzOVR934bALbwdaN11b2VI2t9qGN0y5Gq7HWsiG16hgWTsCr3ppFa76004QGuNY2v');
header('Content-Type: application/json');

$url =  "http://localhost:8080/ROYALHOSPITAL/Patient/stripe/";
echo $url;
$YOUR_DOMAIN = $url;

$totall = $_SESSION['total'];
$total = 100*$totall;
$checkout_session = \Stripe\Checkout\Session::create([
  'payment_method_types' => ['card'],
  'line_items' => [[
    'price_data' => [
      'currency' => 'lkr',
      'unit_amount' => $total,//1000lkr = 100000
      'product_data' => [
        'name' => 'Bill Payment',
        'images' => ["https://image.isu.pub/191130173733-5a8475ac3d94714cf55d7a05296b3d63/jpg/page_1.jpg"],
      ],
    ],
    # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
    // 'price' => '{{PRICE_ID}}',
    'quantity' => 1,
  ]],
  'mode' => 'payment',
  'success_url' => $YOUR_DOMAIN . '/success.php',
  'cancel_url' => $YOUR_DOMAIN . '/cancel.php',
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);