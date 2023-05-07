<?php 
session_start();
require_once("/xampp/htdocs/Royalhospital/conf/config.php");
$_SESSION['appID_array'][] = '';
if(isset($_SESSION['mailaddress']) && $_SESSION['userRole'] == 'Patient'){
?>
<!DOCTYPE html>
<html>
<head>
  <title>Thanks for your order!</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="<?php echo BASEURL.'/css/style.css';?>">
    <link rel="stylesheet" href="<?php echo BASEURL.'/css/patientDash.css';?>">
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

    <style>
      body{
        background-color:#ffffff;
      }

      .userContents .receipt{
        display: flex;
        flex-wrap:wrap;
        justify-content: center;
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

          
          $nic = $_SESSION['nic'];
          $pid_query = "SELECT patientID FROM patient WHERE nic = '$nic'";
          $result_pid = mysqli_query($con, $pid_query);
          $pid = mysqli_fetch_assoc($result_pid)['patientID'];

          $query = "update purchases set paid_status = 'paid' where patientID = $pid;";
          mysqli_query($con,$query);
          ?>  
            
            <ul>
                <li class="userType"><img src="<?php echo BASEURL.'/images/userInPage.svg' ?>" alt="">
                Patient
            </li>
            </ul>
        
  <div class="box1">
    <img src="<?php echo BASEURL.'/images/successfull.png'?>" alt="">
    <div class="product">
      <h2>Thank You</h2>
      <div class="done"><h3>Your Payment is Successfully Done.</h3></div>
    <div class="description">
      We appreciate your business! If you have any questions, please email
      <a href="mailto:orders@example.com">orders@example.com</a>.
    </div>
    </div>
  </div>
  <div class="receipt">
    <h2>download Receipt  -><a href="<?php echo BASEURL.'/Patient/pdf/receipt.php?id='.$pid?>">
    <img style="width:250px;height:60px;position:relative;" src=<?php echo BASEURL.'/images/download-pdf.png';?> alt="download">
  </a></h2>
      
  </div>

    </div>
</div>
<script>
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
</body>
</html>
<?php 
}
?>