<?php
session_start();
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
    <style>
        .next {
            position: initial;
            height: auto;
        }
    </style> 
    <title>Reports</title>
</head>

<body>
<div class="user">
    <?php
    $name = urlencode( $_SESSION['name']);
    include(BASEURL.'/Components/PatientSidebar.php?profilePic=' . $_SESSION['profilePic'] . "&name=" . $name); ?>
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
                <img src=<?php echo BASEURL . '/images/arrow-right-circle.svg' ?> alt="arrow">Report
            </div>

            <div class="main-container">
                <div class="table-container" id="reportContainer">
                    <table class="table">
                        <thead>    
                    
                            <th>Patient ID</th>
                            <th>Name</th>
                            <th>Room No</th>
                            <th>Option</th>
                        </thead>
                        <tbody>
                            <?php
                                $sql="select patient.patientID,user.name,inpatient.roomNo from user join patient on user.nic=patient.nic join inpatient on inpatient.patientID=patient.patientID;";
                                $result=mysqli_query($con,$sql);

                                if($result){
                                    while($row=mysqli_fetch_assoc($result)){
                                     $patientID = $row['patientID'];
                                        $name =  $row['name'];
                                        $RoomNo = $row['roomNo'];
                                        echo '<tr>
                                        <td>'.$patientID.'</td>
                                        <td>'.$name.'</td>
                                        <td>'.$RoomNo.'</td>
                                        <td> <button class="button" id="report-button"><a href="dailyReport.php?patientid='.$patientID.'&name='.$name.'">
                                        View </a>
                                    </button></td>

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