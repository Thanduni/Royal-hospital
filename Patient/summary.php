
<?php 
session_start();
require_once("/xampp/htdocs/Royalhospital/conf/config.php");
$_SESSION['appID_array'][] = '';
if(isset($_SESSION['mailaddress']) && $_SESSION['userRole'] == 'Patient'){
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Patient Summary</title>
    
    <link rel="stylesheet" href="<?php echo BASEURL.'/css/style.css';?>">
    <link rel="stylesheet" href="<?php echo BASEURL.'/css/patientDash.css';?>">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="<?php echo BASEURL. '/js/getDocDetails.js'; ?>"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="<?php echo BASEURL .'/css/appoinment.css';?>">
    <link rel="stylesheet" href="<?php echo BASEURL.'/css/patientAppointment.css' ?>">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://kit.fontawesome.com/04b61c29c2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script src="https://js.stripe.com/v3/"></script>
  </head>
  <body>
  <div class="u">
  <?php
          $name = urlencode( $_SESSION['name']);
          include(BASEURL.'/Components/patientTopbar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name . "&userRole=" . $_SESSION['userRole']. "&nic=" . $_SESSION['nic']);

          ?>  
            
            <ul>
                <li class="userType"><img src="<?php echo BASEURL.'/images/userInPage.svg' ?>" alt="">
                Patient
            </li>
            </ul>
  </div>
    <div class="box">
    <img src="<?php echo BASEURL.'/images/p-checkout.avif' ?>" alt="">

      <div class="product">
        <div class="description">
          <h3>Total Amount</h3>
          <h5>LKR 20.00</h5>
        </div>
      </div>
      <form action="http://localhost:8080/ROYALHOSPITAL/Patient/stripe/checkout_process.php" method="POST">
        <button type="submit" id="checkout-button">Checkout</button>
      </form>
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

    $(function(){
            $('#open').click(function(){
                $('#login-modal').fadeIn().css("display","flex");
            });
            $('#open-').click(function(){
                $('#login-modal').fadeIn().css("display","flex");
            });
            $('.cancel-modal').click(function(){
                $('#login-modal').fadeOut();
            });
        });
  </script>
</html>
<?php
}
?>
