<?php 
session_start();
//require_once("/xampp/htdocs/Royalhospital/conf/config.php");

require_once("../../conf/config.php");
$_SESSION['appID_array'][] = '';
if(isset($_SESSION['mailaddress']) && $_SESSION['userRole'] == 'Patient'){
  $totall = $_SESSION['total'];
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Checkout Bill</title>
    
    <link rel="stylesheet" href="<?php echo BASEURL.'/css/style.css';?>">
    <link rel="stylesheet" href="<?php echo BASEURL.'/css/patientDash.css';?>">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="<?php echo BASEURL. '/js/getDocDetails.js'; ?>"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- <link rel="stylesheet" href="<?php echo BASEURL .'/css/appoinment.css';?>"> -->
    <link rel="stylesheet" href="<?php echo BASEURL.'/css/patientAppointment.css' ?>">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://kit.fontawesome.com/04b61c29c2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script src="https://js.stripe.com/v3/"></script>

    <style>
      .not-paid h1{
        display:flex;
      }
      .userContents .box{
        background: #ffffff;
        display: flex;
        margin: 90px 545px;
        width: 579px;
        height: 432px;
        border-radius: 6px;
        justify-content: space-around;
        flex-wrap: wrap;
        align-content: stretch;
      }

      .box #checkout-button{
        font-weight: 500;
        font-size: 16px;
        color: #fff;
        background-color:#0066cc;
        padding: 10px 30px;
        border: 2px solid #0066cc;
        box-shadow: rgb(0, 0, 0) 0px 0px 0px 0px;
        border-radius: 50px;
        transition : 1000ms;
        transform: translateX(0);
        display: flex;
        flex-direction: row;
        align-items: center;
        cursor: pointer;
        float: left;
        }

        .box #checkout-button:hover{

        transition : 1000ms;
        padding: 10px 50px;
        transform : translateX(-0px);
        background-color: #fff;
        color: #0066cc;
        border: solid 2px #0066cc;
        }
    </style>
  </head>
<body>
  <div class="user">
        <?php
        $name = urlencode( $_SESSION['name']);
        include(BASEURL.'/Components/PatientSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name);  
        ?>
  <div class="userContents"  id="center">
  <?php

          $name = urlencode( $_SESSION['name']);
          include(BASEURL.'/Components/patientTopbar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name . "&userRole=" . $_SESSION['userRole']. "&nic=" . $_SESSION['nic']);

          ?>  
            
            <div class="arrow">
                <img src="<?php echo BASEURL.'/images/arrow-right-circle.svg' ?>" alt="arrow">Bills
            </div>
            <!-- <ul>
                <li class="userType"><img src="<?php echo BASEURL.'/images/userInPage.svg' ?>" alt="">
                Patient
            </li>
            </ul> -->
  
    <div class="box">
    <img src="<?php echo BASEURL.'/images/p-checkout.avif' ?>" alt="">

      <div class="product">
        <div class="description">
          <div class="not-paid"><h1 style="color:red;">Not Paid</h1>
          <h1 style="color:red;">Balance</h1></div>
          <h3>Total Amount</h3>
          <h3 style="font-weight:700;">LKR <?php echo$totall;?></h3>
        </div>
      </div>
      <form action="http://localhost:8080/ROYALHOSPITAL/Patient/stripe/checkout_process.php" method="POST">
        <button type="submit" id="checkout-button">Checkout</button>
      </form>
    </div>

    </div>
  </div>
  </body>
  <script type="text/javascript">
    var stripe = Stripe("pk_test_51Mee0bK432Tp6pbC39lCcsewe29n4Ld0GeXdL1FxZ1UZaSWIf1HgtW9IVJ83WIG9Ei8QrveHEBgVR2Ly1EVwIkCn00a0NueY3A");
    var checkoutButton = document.getElementById("checkout-button");

    checkoutButton.addEventListener("click", function(){
      fetch("http://localhost:8080/ROYALHOSPITAL/Patient/stripe/",{  //define path
        method:"POST",
      })
      .then(function(response){
        return response.json();
      })
      .then(function(session){
        return stripe.redirectToCheckout({sessionId:session})
      })
    })
  </script>
</html>
<?php
}
?>
