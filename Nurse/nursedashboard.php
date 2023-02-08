<?php
session_start();
//die( $_SESSION['profilePic']);
require_once("../conf/config.php");
if (isset($_SESSION['mailaddress']) && $_SESSION['userRole'] == 'Nurse') {
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/style.css' ?>">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/nurseStyle.css' ?>">
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
    <title>Nurse Dashboard</title> 
</head>


<body>
    <div class="user">
        <?php
        $name = urlencode( $_SESSION['name']);
        include(BASEURL.'/Components/nurseSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name); ?>
        <div class="userContents" id="center">
            <div class="title">
                <img src="<?php echo BASEURL . '/images/logo5.png' ?>" alt="logo">
                Royal Hospital Management System
            </div>
            <ul>
                <li class="userType"><img src=<?php echo BASEURL . '/images/userInPage.svg' ?> alt="nurse">
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
              <div class="nurse-cards">
              <div class="nurse-card">
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
              <div class="nurse-card">
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

              <div class="table-container">
                    <table class="table">

                        <thead>    
                            <th>Name</th>
                            <th>Room No</th>
                            <th>Admit date</th>
                            <th>Admit time</th>
                            <th>Drug allergies</th>
                            <th>Emergency No</th>
                        </thead>

                        <tbody>

                            <?php
                                $sql="select user.name,inpatient.roomNo,inpatient.admit_date,inpatient.admit_time,patient.drug_allergies,patient.emergency_contact from user join patient on user.nic=patient.nic join inpatient on inpatient.patientID=patient.patientID;";
                                $result=mysqli_query($con,$sql);

                                if($result){
                                while($row=mysqli_fetch_assoc($result)){
                                $name =  $row['name'];
                                $RoomNo = $row['roomNo'];
                                $admit_date = $row['admit_date'];
                                $admit_time = $row['admit_time'];
                                $drug_allergies = $row['drug_allergies'];
                                $emergency_contact = $row['emergency_contact'];
                                echo '<tr> 

                                <td>'.$name.'</td>
                                <td>'.$RoomNo.'</td>
                                <td>'.$admit_date.'</td>
                                <td>'.$admit_time.'</td>
                                <td>'.$drug_allergies.'</td>
                                <td>'.$emergency_contact.'</td>
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
