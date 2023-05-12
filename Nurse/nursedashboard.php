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
      .user{
            height:inherit;
        }
        .table-container{
          align-items: flex-start;
        }
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
        include(BASEURL . '/Components/nurseSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name); ?>
        <div class="userContents">
        <?php
            $name = urlencode( $_SESSION['name']);
            include(BASEURL.'/Components/nursetopbar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name . "&userRole=" . $_SESSION['userRole']. "&nic=" . $_SESSION['nic']);
            ?>

            <div class="main-container">
              <div class="nurse-cards">
                <a href="#">
                  <div class="nurse-card">
                    <div class="card-content">
                        <div class="number">
                          <?php
                          $dash_patient_query = "select * from patient where patient_type = 'inpatient';";
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
                    <!-- <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
                    <lord-icon
                        src="https://cdn.lordicon.com/mbcrjouw.json"
                        trigger="hover"
                        colors="primary:#121331,secondary:#3c77c6"
                        stroke="85"
                        style="width:70px;height:70px">
                    </lord-icon> -->
                        <i class="fas fa-user-injured"></i>
                    </div>
                  </div>
                </a>
                <a href="beds.php">
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
                </a>
              </div>

              <div class="table-container">
                    <table class="nursedash-table table">
                        <thead>
                            <th>Patient</th>
                            <th>Room No</th>
                            <th>Admit Date</th>
                            <th>Drug Allergies</th>
                            <th>Emergency Contact</th>
                            <th colspan ='2'>Option</th>
                        </thead>
                        <tbody>
                          <?php
                              $sql="SELECT user.profile_image,user.name,inpatient.patientID,inpatient.room_no,inpatient.admit_date,inpatient.admit_time,patient.drug_allergies,patient.emergency_contact from user join patient on user.nic=patient.nic join inpatient on inpatient.patientID=patient.patientID WHERE inpatient.discharge_date is NULL;";
                              $result=mysqli_query($con,$sql);
                              if($result){
                              while($row=mysqli_fetch_assoc($result)){
                                $profile_image = $row['profile_image'];
                                $patientID= $row['patientID'];
                              $name =  $row['name'];
                              $RoomNo = $row['room_no'];
                              $admit_date = $row['admit_date'];
                              $drug_allergies = $row['drug_allergies'];
                              $emergency_contact = $row['emergency_contact']; ?>
                          <tr>
                            <td><div class="left-cell">
                                  <?php echo "<img src='".BASEURL."/uploads/".$profile_image."'width = 40px height=40px>";?>
                                </div>
                                <div class="right-cell">
                                    <div class="up-cell"><?php echo $name ?></div>
                                    <div class="down-cell">id :<?php echo $patientID ?></div>
                                </div>
                            </td>
                              <td><?php echo $RoomNo ?></td>
                              <td><?php echo $admit_date ?></td>
                              <td><?php echo $drug_allergies ?></td>
                              <td><?php echo $emergency_contact ?></td>
                              <td><a href="dailyReport.php?patientid=<?=$patientID?>"><input type="button" name="Reports" class="add-daily-report" value="Add Report"></a>
                              <td><a href="viewPrescription.php?patientid=<?=$patientID?>"><input type="button" name="Prescription" class="view-prescription" value="View Prescription"></a>
                              </td>
                          </tr>
                                   <?php }
                                }
                            ?> 
                        </tbody>
                    </table>
                </div>


              <!-- <div class="wrapper">
                    <div class="table nursedash-table">
                        <div class="row headerT">
                            <div class="cell">Patient</div>
                            <div class="cell">Room No</div>
                            <div class="cell">Admit Date</div>
                            <div class="cell">Drug Allergies</div>
                            <div class="cell">Emergancy No</div>
                            <div class="cell">Option</div>
                        </div>
                        <?php
                                $sql="select user.profile_image,user.name,inpatient.patientID,inpatient.room_no,inpatient.admit_date,inpatient.admit_time,patient.drug_allergies,patient.emergency_contact from user join patient on user.nic=patient.nic join inpatient on inpatient.patientID=patient.patientID;";
                                $result=mysqli_query($con,$sql);

                                if($result){
                                while($row=mysqli_fetch_assoc($result)){
                                  $profile_image = $row['profile_image'];
                                  $patientID= $row['patientID'];
                                $name =  $row['name'];
                                $RoomNo = $row['room_no'];
                                $admit_date = $row['admit_date'];
                                $drug_allergies = $row['drug_allergies'];
                                $emergency_contact = $row['emergency_contact']; ?>
                        <div class="row">
                            <div class="cell" id="patient-info-cell">
                              <div class="left-cell">
                              <?php echo "<img src='".BASEURL."/uploads/".$profile_image."'width = 40px height=40px>";?>
                              </div>
                              <div class="right-cell">
                                <div class="up-cell"><?php echo $name ?></div>
                                <div class="down-cell">id :<?php echo $patientID ?></div>
                              </div>
                            </div>
                            <div class="cell"><?php echo $RoomNo?></div>
                            <div class="cell"><?php echo $admit_date?></div>
                            <div class="cell"><?php echo $drug_allergies?></div>
                            <div class="cell"><?php echo $emergency_contact?></div>
                            <div class="cell"><a href="dailyReport.php?patientid=<?=$patientID?>">
                              <img class="view-btn-image" src="../images/eye.png "width = 40px height=40px> </a></div>
                        </div>
                             <?php   }
                                }
                            ?>    
                    </div>
                </div>
                           
            </div> -->
        </div>
    </div>
    
    
</body>
</html>
<?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>
