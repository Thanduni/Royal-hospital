<?php
// require_once("../conf/config.php");

// if(isset($_POST['save'])){
//     $drugName = $_POST['drugName'];
//     $dosage = $_POST['dosage'];
//     $days = $_POST['days'];
//     $frequency = $_POST['frequency'];

//     foreach ($drugName as $key => $value){
//         $save = "INSERT INTO prescribed_drugs(drug_name,days,quantity,frequency) VALUES ('".$value."','".$dosage[$key]."','".$days[$key]."','".$frequency[$key]."')";

//         $query = mysqli_query($con,$save);
//     }
// }

$conn = new PDO('mysql:host=localhost:8080;dbname=royalhospital','root','');

foreach ($_POST['drugName'] as $key => $value) {
    $sql = 'INSERT INTO prescribed_drugs(drug_name,days,quantity,frequency,prescriptionID) VALUES (:name,:days,:qty,:fr,)';
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        'name' => $value,
        'days' => $_POST['days'][$key],
        'qty' => $_POST['dosage'][$key],
        'fr' => $_POST['frequency'][$key]
    ]);
    echo 'Added successfully!';
}

?>