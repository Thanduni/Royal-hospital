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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/style.css' ?>">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/doctorStyle.css' ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
    </script>
    <style>
        .next {
            position: initial;
            height: auto;
        }
    </style>   
    <title>Doctor Dashboard</title> 
</head>


<body>
    <div class="user">
    <?php include(BASEURL . '/Components/doctorSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $_SESSION['name']); ?>
        <div class="userContents" id="center">
            <div class="title">
                <img src="<?php echo BASEURL . '/images/logo5.png' ?>" alt="logo">
                Royal Hospital Management System
            </div>
            <ul>
                <li class="userType"><img src=<?php echo BASEURL . '/images/userInPage.svg' ?> alt="doctor">
                    Doctor
                </li>
                <li class="logout"><a href="<?php echo BASEURL . '/Homepage/logout.php?logout' ?>">Logout
                        <img
                                src=<?php echo BASEURL . '/images/logout.svg' ?> alt="logout"></a>
                </li>
            </ul>
            <div class="arrow">
                <img src=<?php echo BASEURL . '/images/arrow-right-circle.svg' ?> alt="arrow">Patients
            </div>


            <div class="main-container">
              <h3>Patient List</h3>
              <div class="table-container">
                    <table class="table">

                        <thead>
                          <th>Profile Picture</th>    
                          <th>Name</th>
                          <th>Room No</th>
                          <th>Option</th>
                        </thead>

                        <tbody>

                            <?php
                                $sql="select user.profile_image,user.name,patient.patientID,inpatient.room_no from user join patient on user.nic=patient.nic join inpatient on patient.patientID=inpatient.patientID";
                                $result=mysqli_query($con,$sql);

                                if($result){
                                  while($row=mysqli_fetch_assoc($result)){
                                    $profile_image = $row['profile_image'];
                                    $name =  $row['name'];
                                    $room_no = $row['room_no'];
                                    $patientID= $row['patientID'];
                                    echo '<tr> 

                                    
                                    <td>'.$name.'</td>
                                    <td>'.$room_no.'</td>
                                    <td> <button class="button" id="view-report-button"><a href="patientReport.php?patientid='.$patientID.'&name='.$name.'">
                                        View Reports </a>
                                    </button>
                                    <button class="button">Discharge</button>
                                    </td>
                                    </tr>';
                                  }
                                }
                            ?>    
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
