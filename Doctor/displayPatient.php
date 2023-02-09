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
    $patientName = $_GET['name'];
}

$sql = "SELECT patient.weight, patient.height, patient.illness, patient.drug_allergies, patient.medical_history_comments,patient.currently_using_medicine,user.profile_image, YEAR(CURRENT_TIMESTAMP) - YEAR(user.DOB) - (RIGHT(CURRENT_TIMESTAMP, 5) < RIGHT(user.DOB, 5)) as age from user join patient on user.nic=patient.nic WHERE patientID = $patientID";
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
    <title>Display Patient</title>
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
                <img src=<?php echo BASEURL . '/images/arrow-right-circle.svg' ?> alt="arrow">Patient
            </div>

            <div class="display-container">
                <div class="patient-detail-container">
                    <h3>Patient Details</h3>
                    <div class="patient-image">
                        <img src="" alt="">
                    </div>
                    <div class="row">
                        <div class="row-name">Name: </div>
                        <div class="row-content"><?php echo $patientName ?></div>
                    </div>
                    <div class="row">
                        <div class="row-name">Age: </div>
                        <div class="row-content"><?php echo $age ?></div>
                    </div>
                    <div class="row">
                        <div class="row-name">Weight: </div>
                        <div class="row-content"><?php echo $weight ?></div>
                    </div>
                    <div class="row">
                        <div class="row-name">Height: </div>
                        <div class="row-content"><?php echo $height ?></div>
                    </div>
                    <div class="row">
                        <div class="row-name">Allergies: </div>
                        <div class="row-content"><?php echo $drug_allergies ?></div>
                    </div>
                    <div class="row">
                        <div class="row-name">illness: </div>
                        <div class="row-content"><?php echo $illness ?></div>
                    </div>
                    <div class="row">
                        <div class="row-name">Medical History: </div>
                        <div class="row-content"><?php echo $medical_history_comments ?></div>
                    </div>
                    <div class="row">
                        <div class="row-name">Currently using medicines: </div>
                        <div class="row-content"><?php echo $currently_using_medicine ?></div>
                    </div>
                </div>
                <div class="doctor-note-container">
                    <h3>Doctor note</h3>
                    <form method="post">
                            <div class="prescription-group">
                                <label>Date</label>
                                <input type="date" name="date" value ="<?php echo date('Y-m-d') ?>">
                            </div>
                            <div class="prescription-group">
                                <label>Investigation </label>
                                <input type="text" class="form-control" placeholder="Investigation" name="Investigation">
                            </div>
                            <div class="prescription-group">
                                <label>Impression </label>
                                <input type="text" class="form-control" placeholder="Impression" name="Impression">
                            </div>
                            <button type="submit" name ="submit">Submit</button>
                    </form>
                    <button class="button" id="admit-button">
                        Admit patient
                    </button>
                </div>
                <div class="prescription-container">
                    <div class="tab-line">
                        <div class="medicine-button" id="medicine-button">Prescribe Medicine</div>
                        <div class="test-button" id="test-button">Prescribe Test</div>
                    </div>
                    <div class="prescribe-medicine-content">
                        <form action="post">
                            <div class="prescription-group">
                                <label>Drug Name </label>
                                <input type="text" class="form-control" placeholder="Drug Name" name="Drug Name">
                            </div>
                            <div class="prescription-group">
                                <label>Quantity</label>
                                <input type="number" class="form-control" placeholder="Quantity" name="Quantity">
                            </div>
                            <div class="prescription-group">
                                <label>No of days</label>
                                <input type="number" class="form-control" placeholder="No-of-days" name="No-of-days">
                            </div>
                            <div class="prescription-group">
                                <label>Frequency</label>
                                <input type="number" class="form-control" placeholder="Frequency" name="Frequency">
                            </div>
                            <div class="prescription-group">
                                <label>Instructions</label>
                                <input type="text" class="form-control" placeholder="Instructions" name="Instructions">
                            </div>
                            <button type="submit" name ="submit">Submit</button>
                        </form>
                    </div>
                    <div class="prescribe-test-content">
                        <form action="post">
                            <div class="prescription-group">
                                <label>Test Name </label>
                                <input type="text" class="form-control" placeholder="Test Name" name="Test Name">
                            </div>
                            <button type="submit" name ="submit">Submit</button>
                        </form>
                    </div>
                </div>

                <div class="Admit-patient-alert">
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
                </div>
            </div>
        </div>
    </div>
                
    <script>
        document.getElementById("medicine-button").addEventListener("click", function(){
            document.querySelector(".prescribe-medicine-content").style.display = "flex";
            document.querySelector(".prescribe-test-content").style.display = "none";
        })
        document.getElementById("test-button").addEventListener("click", function(){
            document.querySelector(".prescribe-medicine-content").style.display = "none";
            document.querySelector(".prescribe-test-content").style.display = "flex";
        })
        document.getElementById("admit-button").addEventListener("click", function(){
            document.querySelector(".popup").style.display = "flex";
        })
        document.querySelector(".close-button").addEventListener("click", function(){
            document.querySelector("#Admit-patient-popup").style.display = "none";
        })
    </script>
</body>
</html>
<?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>
