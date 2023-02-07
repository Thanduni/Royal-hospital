<?php
session_start();
//die( $_SESSION['profilePic']);
require_once("../conf/config.php");
if (isset($_SESSION['mailaddress']) && $_SESSION['userRole'] == 'Nurse') {
    ?>

<?php
if(isset($_POST['submit'])){
    // $patientID =  $_POST['patientID'];
    $RoomNo = $_POST['roomNo'];
    $admit_date = $_POST['admit_date'];
    $admit_time = $_POST['admit_time'];

    $sql="INSERT INTO inpatient(admit_time,admit_date,roomNo) values('$admit_time','$admit_date','$RoomNo');";
    $result=mysqli_query($con,$sql);

    if($result){
        // echo "Date inserted successfully";
        header('location:display.php');
    }else{
        die(mysqli_error($con));
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
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/nurseStyle.css' ?>">
    <style>
        .next {
            position: initial;
            height: auto;
        }
    </style>
    <title>Patient</title>
 
</head>
<body>
    <div class="user">
        <?php include(BASEURL . '/Components/nurseSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $_SESSION['name']); ?>
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
                <img src=<?php echo BASEURL . '/images/arrow-right-circle.svg' ?> alt="arrow">Patient
            </div>

            <div class="main-container">

                <button class="button" id="admission-button">
                    New Admission
                </button>

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

    <div class="popup" id="admission-popup">
        <div class="popup-content">  
            <img src="../images/close.png" alt="close" class="close">
            <form method="post">
                <h3>Admission Form</h3>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" placeholder="Enter name" name="name">
                </div>
                <div class="form-group">
                    <label>Room No</label>
                    <input type="text" class="form-control" placeholder="Enter room No" name="roomNo" >
                </div>
                <div class="form-group">
                    <label>Admit date</label>
                    <input type="date" name ="admit_date"value ="<?php echo date('Y-m-d') ?>">
                </div>
                <div class="form-group">
                    <label>Admit time</label>
                    <input type="time" id="time" name="admit_time" required>
                </div>
                <button class="submit" type="submit" name ="submit">Submit</button>
            </form>
        </div>
    </div>
<script>
    let objectDate = new Date();

    var time = objectDate.toLocaleTimeString([], {
      hourCycle: 'h24',
      hour: '2-digit',
      minute: '2-digit'
    });
    document.getElementById('time').value = time;

   document.getElementById("admission-button").addEventListener("click", function(){
        document.querySelector("#admission-popup").style.display = "flex";
    })
    document.querySelector(".close").addEventListener("click", function(){
        document.querySelector("#admission-popup").style.display = "none";
    })
</script>

</body>
</html>
<?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>
