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
// get current date
$mindate = date("Y-m-d");
$mintime = date("h:i");
if(isset($_GET['patientid'])){
    $patientID = $_GET['patientid'];
    $patientName = $_GET['name'];
    $age = $_GET['age'];
}
?>

<?php
if (isset($_POST['submit'])) {
    $date = $_POST['date'];
    $investigation = $_POST['investigation'];
    $impression = $_POST['impression'];

    $prescription = "INSERT into prescription(date,age,patientID,doctorID,investigation,impression) values('$date','$age','$patientID','$doctorID','$investigation','$impression');";    
}
if(mysqli_query($con,$prescription)){
    $last_id = mysqli_insert_id($con);
    printf("new record added had id %d ", $last_id);
}else{
    echo "Error";
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

    <link rel="stylesheet" href="<?php echo BASEURL . '/css/prescription.css' ?>">
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
                    <div class="prescribe-medicine-content">
                        <form method="post">
                            <div class="first-row">
                                <div class="form-group">
                                    <label>Name: </label>
                                    <input type="text" value="<?php echo $patientName?>">
                                </div>
                                <div class="form-group">
                                    <label>Patient ID: </label>
                                    <input type="text" value ="<?php echo $patientID?>">
                                </div>
                                
                                
                            </div>
                            <div class="second-row">
                                <div class="form-group">
                                    <label>Age: </label>
                                    <input type="text" value="<?php echo $age?>">
                                </div>
                                <div class="form-group">
                                    <label>Date: </label>
                                    <input type="date" name="date" value ="<?php echo date('Y-m-d') ?>" min="<?php echo $mindate?>">
                                </div>
                            </div> 
                            <div class="third-row">
                                <div class="form-group">
                                    <label>Investigation: </label>
                                    <input type="text" name="investigation" >
                                </div>
                                <div class="form-group">
                                    <label>Impression: </label>
                                    <input type="text" name="impression">
                                </div>
                            </div>
                            <button class="addPrescription-button" type="submit" name="submit">Submit</button>
                        </form>
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