<?php
session_start();
//die( $_SESSION['profilePic']);
require_once("../conf/config.php");
if (isset($_SESSION['mailaddress']) && $_SESSION['userRole'] == 'Doctor') {
  $nic = $_SESSION['nic'];
  $doctorID_query = "select doctorID from doctor join user on user.nic = doctor.nic where user.nic = $nic";
  $get_doctorID = mysqli_query($con,$doctorID_query);
  $row = mysqli_fetch_assoc($get_doctorID);
  $doctorID = $row["doctorID"];
    ?>

<?php
if(isset($_GET['patientid'])){
    $patientID = $_GET['patientid'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/style.css' ?>">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/doctorStyle.css' ?>">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/inpatient.css' ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
    </script>
    <script src="https://kit.fontawesome.com/04b61c29c2.js" crossorigin="anonymous"></script>
    <style>
        .user{
            height:inherit;
        }
        .next {
            position: initial;
            height: auto;
        }
    </style>   
    <title>inpatients</title> 
</head>
<body>
    <div class="user">
        <?php
        $name = urlencode( $_SESSION['name']);
        include(BASEURL . '/Components/doctorSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name); ?>
        <div class="userContents" id="center">
        <?php
          include(BASEURL.'/Components/topbar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name);
          ?>
            <div class="display-container">
                <div class="show-inpatients">
                    <h3>Daily Reports</h3>
                    <table class="table">
                        <thead>
                          <th>Date</th>
                          <th>Time</th>
                          <th>Temperature</th>
                          <th>Blood Preasure</th>
                          <th>O2 Saturation</th>
                        </thead>
                        <tbody>
                            <?php 
                                $select = "SELECT daily_report.*, inpatient.admit_date from daily_report join inpatient on inpatient.patientID=daily_report.patientID WHERE date between inpatient.admit_date and CURDATE();";
                                $result = mysqli_query($con,$select);
                            
                                while($row= mysqli_fetch_array($result)){?>
                                <tr>
                                    <td><?php echo $row['date'] ?></td>
                                    <td><?php echo $row['time'] ?></td>
                                    <td><?php echo $row['temperature'] ?></td>
                                    <td><?php echo $row['blood_preasure'] ?></td>
                                    <td><?php echo $row['o2_saturation'] ?></td>
                                </tr>
                                <?php
                                } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>  
</body>
</html>
<?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>
