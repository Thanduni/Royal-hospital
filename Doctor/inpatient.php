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
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/inpatient.css' ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
    </script>
    <script src="https://kit.fontawesome.com/04b61c29c2.js" crossorigin="anonymous"></script>
    <style>
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
                    <h3>Patient List</h3>
                    <table class="table">
                        <thead>
                          <!-- <th>Profile Picture</th>     -->
                          <th>Patient</th>
                          <th>Room No</th>
                          <th>Option</th>
                        </thead>
                        <tbody>
                            <?php 
                                $select = "select user.profile_image,user.name,patient.patientID,inpatient.room_no from user join patient on user.nic=patient.nic join inpatient on patient.patientID=inpatient.patientID where doctorID=$doctorID";
                                $result = mysqli_query($con,$select);
                            
                                while($row= mysqli_fetch_array($result)){?>
                                <tr>
                                    <td><div class="left-cell">
                                            <?php echo "<img src='".BASEURL."/uploads/".$row['profile_image']."'width = 40px height=40px>";?>
                                        </div>
                                        <div class="right-cell">
                                            <div class="up-cell"><?php echo $row['name'] ?></div>
                                            <div class="down-cell">id :<?php echo $row['patientID'] ?></div>
                                        </div>
                                    </td>
                                    <td><?php echo $row['room_no'] ?></td>
                                    <td><a href="viewReport.php?patientid=<?=$row['patientID']?>"><input type="button" name="view-reports" class="view-reports" value="View Reports"></a>
                                    <a href="discharge.php?patientid=<?=$row['patientID']?>"><input type="button" name="discharge" class="discharge" value="Discharge"></a></td>
                                </tr>
                                <?php
                                } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php
if(isset($_POST['discharge'])){

    $sql = "DELETE from inpatient WHERE patientID = $patientID;";
    // $sql = "INSERT INTo room(room_availability) VALUES('available');";
    $addresult=mysqli_query($con,$sql);

    if($addresult){
        header('location:inpatient.php');
    }else{
        die(mysqli_error($con));
    }
}
?>   
    
</body>
</html>
<?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>
