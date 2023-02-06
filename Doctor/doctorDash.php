<?php
session_start();
require_once("../conf/config.php");
if (isset($_SESSION['mailaddress']) && $_SESSION['userRole'] == 'Doctor') {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/style.css' ?>">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/doctorStyle.css' ?>">
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
                <li class="userType"><img src=<?php echo BASEURL . '/images/userInPage.svg' ?> alt="admin">
                    Nurse
                </li>
                <li class="logout"><a href="<?php echo BASEURL . '/Homepage/logout.php?logout' ?>">Logout
                        <img
                                src=<?php echo BASEURL . '/images/logout.jpg' ?> alt="logout"></a>
                </li>
            </ul>
            <div class="arrow">
                <img src=<?php echo BASEURL . '/images/arrow-right-circle.svg' ?> alt="arrow">Dashboard
            </div>


            <div class="main-container">
              <div class="doctor-cards">
                <div class="doctor-card">
                <div class="card-content">
                    <div class="number">
                      <?php
                      $dash_patient_query = "select * from `user` where user_role = 'Patient';";
                      $dash_patient_query_run = mysqli_query($con,$dash_patient_query);
                      if($total_patient = mysqli_num_rows($dash_patient_query_run)){
                        echo $total_patient ;
                      }
                      else{
                        echo 'No Data';
                      }
                      ?>
                    </div>
                    <div class="card-name">
                      Total Patients
                    </div>
                </div>
                <div class="icon-box">
                    <i class="fas fa-user-injured"></i>
                </div>
                </div>
                <div class="doctor-card">
                <div class="card-content">
                    <div class="number">
                      <?php
                      $dash_bed_query="Select * from `room` where room_availability='available';";
                      $dash_bed_query_run = mysqli_query($con,$dash_bed_query);
                      if($total_available_beds = mysqli_num_rows($dash_bed_query_run)){
                        echo $total_available_beds;
                      }
                      else{
                        echo 'No data';
                      }
                      ?>
                    </div>
                    <div class="card-name">
                      Available Beds
                    </div>
                </div>
                <div class="icon-box">
                    <i class="fas fa-bed"></i>
                </div>
                </div>
              </div>

              <div class="appointment">
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <th>Profile pic</th>
                            <th>Name</th>
                            <th>Time</th>
                            <th>Status</th>
                        </thead>
                        <tbody>
                            <?php
                                $sql="select user.name,user.profile_image,appointment.time,appointment.status from user join patient on user.nic=patient.nic join appointment on appointment.patientID=patient.patientID;";
                                $result=mysqli_query($con,$sql);

                                if($result){
                                  while($row=mysqli_fetch_assoc($result)){
                                    $profile_image =  $row['profile_image'];
                                    $name = $row['name'];
                                    $time = $row['time'];
                                    $status = $row['status'];
                                    echo '<tr> 

                                    <td>'.$profile_image.'</td>
                                    <td>'.$name.'</td>
                                    <td>'.$time.'</td>
                                    <td>'.$status.'</td>
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
    </div>
    
    
</body>
</html>
<?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>
