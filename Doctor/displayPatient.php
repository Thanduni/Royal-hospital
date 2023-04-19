<?php
session_start();
require_once("../conf/config.php");
if (isset($_SESSION['mailaddress']) && $_SESSION['userRole'] == 'Doctor') {
  $nic = $_SESSION['nic'];
  $doctorID_query = "select doctorID from doctor join user on user.nic = doctor.nic where user.nic = $nic";
  $get_doctorID = mysqli_query($con,$doctorID_query);
  $row = mysqli_fetch_assoc($get_doctorID);
  $doctorID = $row["doctorID"];
?>

<?php
$mindate = date("Y-m-d");
$mintime = date("h:i:sa");

if(isset($_GET['patientid'])){
    $patientID = $_GET['patientid'];
    $patientName = $_GET['name'];
}


$sql = "SELECT user.profile_image,
 patient.weight,
 patient.height, 
 patient.illness, 
 patient.drug_allergies, 
 patient.medical_history_comments,
 patient.currently_using_medicine,
 YEAR(CURRENT_TIMESTAMP) - YEAR(user.DOB) - (RIGHT(CURRENT_TIMESTAMP, 5) < RIGHT(user.DOB, 5)) as age 
 from user 
 join patient on user.nic=patient.nic 
 WHERE patientID = $patientID;";

$result=mysqli_query($con,$sql);
if($result){
    while($row = mysqli_fetch_assoc($result)){
        $profile_image = $row['profile_image'];
        $age = $row['age'];
        $weight = $row['weight'];
        $height = $row['height'];
        $illness = $row['illness'];
        $drug_allergies = $row['drug_allergies'];
        $medical_history_comments = $row['medical_history_comments'];
        $currently_using_medicine = $row['currently_using_medicine'];
    }
}

if(isset($_POST['submit-doctor-note'])) {
    $date = $_POST['date'];
    $age = $_POST['age'];
    $investigation = $_POST['investigation'];
    $impression = $_POST['impression'];
    $patientID = $_POST['patientID'];

    $prescription = "INSERT into prescription(date,age,patientID,doctorID,investigation,impression) values('$date','$age','$patientID','$doctorID','$investigation','$impression');";    
    if(mysqli_query($con,$prescription)){
        $last_id = mysqli_insert_id($con);
        printf("new record added had id %d ", $last_id);
    }else{
        echo "Error";
    }
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
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/displayPatient.css' ?>">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/04b61c29c2.js" crossorigin="anonymous"></script>
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
    <title>Display Patient</title>
</head>

<body>
    <div class="user">
        <?php 
        $name = urlencode( $_SESSION['name']);
        include(BASEURL . '/Components/doctorSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $_SESSION['name']); ?>
        <div class="userContents" id="center">
        <?php
          include(BASEURL.'/Components/topbar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name);
          ?>

            <div class="display-container">
                <div class="patient-detail-container">
                    <div class="left-container">
                        <div class="patient-image">
                            <img src="<?=BASEURL?>/uploads/<?=$profile_image?>" alt="upload profile picture">
                            <!-- <hr> -->
                        </div>
                        
                        <div class="row">
                            <label for="Name">Name: </label>
                            <div class="content"><?php echo $patientName ?></div>
                        </div>
                        <div class="row">
                            <label for="Name">Age: </label>
                            <div class="content"><?php echo $age ?></div>
                        </div>
                        <div class="row">
                            <label for="Name">Weight: </label>
                            <div class="content"><?php echo $weight ?></div>
                        </div>
                        <div class="row">
                            <label for="Name">Drug Allergies: </label>
                            <div class="content"><?php echo $drug_allergies ?></div>
                        </div>
                        <div class="row">
                            <label for="Name">Currently using Medicines: </label>
                            <div class="content"><?php echo $currently_using_medicine ?></div>
                        </div> 
                    </div>
                    
                    <div class="right-container">
                        <div class="doctor-note">
                            <h2>Doctor Note</h2>
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="">Patient ID</label>
                                    <input type="text" name="patientID" value ="<?php echo $patientID?>">
                                </div>
                                <div class="form-group">
                                    <label>Age: </label>
                                    <input type="text" name="age" value="<?php echo $age?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Date</label>
                                    <input type="date" name="date" value ="<?php echo date('Y-m-d') ?>" min="<?php echo $mindate?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Investigation</label>
                                    <input type="text" name="investigation" placeholder="Investigation" id="">
                                </div>
                                <div class="form-group">
                                    <label for="">Impression</label>
                                    <!-- <input type="text" name="impression" placeholder="Impression" id=""> -->
                                    <textarea name="impression" id="" cols="30" rows="4" placeholder="Impression"></textarea>
                                </div>
                                <button class="addPrescription-button" type="submit" name="submit-doctor-note">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>



                <div class="doctor-action">
                    <a href="prescription.php?patientid=<?=$patientID?>&name=<?=$patientName?>&last_id=<?=$last_id?>&doctorID=<?=$doctorID?>">
                    <div class="doctor-card">
                        <div class="card-content">
                            <div class="card-name">
                              Add Prescription
                            </div>
                        </div>
                        <div class="icon-box">
                            <i class="fa fa-pencil-square"></i>
                        </div>
                    </div>
                    </a>

                    <!-- <a href="doctornote.php?patientid=<?=$patientID?>&name=<?=$patientName?>&age=<?=$age?>&doctorID=<?=$doctorID?>">
                    <div class="doctor-card">
                        <div class="card-content">
                            <div class="card-name">
                              Add Doctor Note
                            </div>
                        </div>
                        <div class="icon-box">
                            <i class="fa fa-pencil-square"></i>
                        </div>
                    </div>
                    </a> -->

                    <a href="admitpatient.php?patientid=<?=$patientID?>&name=<?=$patientName?>&age=<?=$age?>">
                    <div class="doctor-card">
                        <div class="card-content">
                            <div class="card-name">
                              Admit Patient
                            </div>
                        </div>
                        <div class="icon-box">
                            <i class="fa-user-plus"></i>
                        </div>
                    </div>
                    </a>
                </div>

                

                <!-- <div class="Admit-patient-alert">
                    <div class="popup" id="Admit-patient-popup">
                        <div class="alert-content">
                            <form method="post">
                                <h4>Do you want to admit this patient?</h4>
                                <div class="button-container">
                                    <button type="submit" name ="updateRoom">Yes</button>
                                    <button class="close-button" name ="close">No</button>
                                </div>  
                            </form>
                        </div>
                    </div>
                </div> -->


            </div>
        </div>
    </div>
<?php
if(isset($_POST['submit-drug-prescription'])){
    $drugname =  $_POST['drugname'];
    $quantity = $_POST['quantity'];
    $no_of_days = $_POST['no_of_days'];
    $frequency = $_POST['frequency'];
    $instructions = $_POST['instructions'];

    $sql="INSERT INTO prescribed_drugs(drug_name,days,quantity,frequency) values('$drugname','$no_of_days','$quantity','$frequency');";
    $result=mysqli_query($con,$sql);

    // if($result){
        
    //     header('location:dailyReport.php?patientid='.$patientID.'&name='.$patientName);
    // }else{
    //     die(mysqli_error($con));
    // }
}
?>
<?php
if(isset($_POST['submitdoctornote'])){
    $date =  $_POST['date'];
    $time = $_POST['time'];
    $Investigation = $_POST['Investigation'];
    $Impression = $_POST['Impression'];

    $sql="INSERT INTO prescription(date,time,investigation,Impression,patientID,doctorID) values('$date','$time','$Investigation','$Impression','$patientID','$doctorID');";
    $result=mysqli_query($con,$sql);

    // if($result){
        
    //     header('location:dailyReport.php?patientid='.$patientID.'&name='.$patientName);
    // }else{
    //     die(mysqli_error($con));
    // }
}
?>
    
</body>
</html>
<?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>
