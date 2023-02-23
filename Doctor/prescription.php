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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/style.css' ?>">
    <link rel="stylesheet" href="<?php echo BASEURL . '/css/doctorStyle.css' ?>">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <title>Prescription</title>
</head>
<body>
    <div class="user">
        <?php 
        $name = urlencode( $_SESSION['name']);
        include(BASEURL . '/Components/doctorSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $_SESSION['name']); ?>
        <div class="userContents" id="center">
        <?php include(BASEURL.'/Components/topbar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name);?>
                <div class="prescription-container">
                    <div class="tab-line">
                        <div class="medicine-button" id="medicine-button">Prescribe Medicine</div>
                        <div class="test-button" id="test-button">Prescribe Test</div>
                    </div>
                    <div class="prescribe-medicine-content">
                        <form action="post">
                            <div class="prescription-group">
                                <label>Drug Name </label>
                                <input type="text" class="form-control" placeholder="Drug Name" name="drugname">
                            </div>
                            <div class="prescription-group">
                                <label>Quantity</label>
                                <input type="number" class="form-control" placeholder="Quantity" name="quantity">
                            </div>
                            <div class="prescription-group">
                                <label>No of days</label>
                                <input type="number" class="form-control" placeholder="No-of-days" name="no-of-days">
                            </div>
                            <div class="prescription-group">
                                <label>Frequency</label>
                                <input type="number" class="form-control" placeholder="Frequency" name="frequency">
                            </div>
                            <div class="prescription-group">
                                <label>Instructions</label>
                                <input type="text" class="form-control" placeholder="Instructions" name="instructions">
                            </div>
                            <button type="submit" name ="submit-drug-prescription">Submit</button>
                        </form>
                    </div>
                    <div class="prescribe-test-content">
                        <form action="post">
                            <div class="prescription-group">
                                <label>Test Name </label>
                                <input type="text" class="form-control" placeholder="Test Name" name="Test Name">
                            </div>
                            <button type="submit" name ="submit-test-prescription">Submit</button>
                        </form>
                    </div>
                </div>
        </div>
    </div>
</body>
<script>
        // let objectDate = new Date();

        // var time = objectDate.toLocaleTimeString([], {
        //     hourCycle: 'h24',
        //     hour: '2-digit',
        //     minute: '2-digit'
        // });
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
</html>
<?php
} else {
    header("location: " . BASEURL . "/Homepage/login.php");
}
?>