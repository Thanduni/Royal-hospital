<?php
$page = 'report';
include 'include/sidebar.php';
include 'connect.php';
?>
<style>
    <?php include 'style.css';
    ?>
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Report</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>
<body>
    <div class="main-container">
    <div class="table">
        <button><a href="reportForm.php">
            Add report</a>
        </button>
            <table>
                <thead>    
                    <th>Name</th>
                    <th>patientID</th>
                    <th>roomNo</th>
                    <th>admit date</th>
                    <th>admit time</th>
                    <th>Emergency No</th>
                </thead>

                <tbody>

            <?php
$sql="select * from `admission`";
$result=mysqli_query($con,$sql);

if($result){
    while($row=mysqli_fetch_assoc($result)){
        $name =  $row['name'];
        $patientID = $row['patientID'];
        $RoomNo = $row['roomNo'];
        $admit_date = $row['admit_date'];
        $admit_time = $row['admit_time'];
        $emergency_contact_num = $row['emergency_contact_num'];
        echo '<tr>
        <th scope="row">'.$name.'</th>
        <td>'.$patientID.'</td>
        <td>'.$RoomNo.'</td>
        <td>'.$admit_date.'</td>
        <td>'.$admit_time.'</td>
        <td>'.$emergency_contact_num.'</td>
    </tr>';
    }
}
    ?>    
            </tbody>
            
        </table>
        </div>
    </div>
</body>
</html>