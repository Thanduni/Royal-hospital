<?php
session_start();
require_once("../../conf/config.php");
require("fpdf.php");

$pdf = new FPDF();

$pdf->AddPage();
$pdf->SetFont("Arial","B",18);

$prescriptionID = $_GET['id'];
$doctorID = $_GET['name'];

if(isset($_SESSION['mailaddress']) && $_SESSION['userRole'] == 'Patient'){
    
$nic = $_SESSION['nic'];
$pid_query = "SELECT patientID FROM patient WHERE nic = '$nic'";
$result_pid = mysqli_query($con, $pid_query);
$pid = mysqli_fetch_assoc($result_pid)['patientID'];

$query = "select * from prescription where patientID = $pid";
$res = mysqli_query($con,$query);

$query1 = "select p.date,u.name,p.prescriptionID from prescription p inner join doctor d on p.doctorID = d.doctorID inner join user u on d.nic=u.nic where p.patientID = $pid";
$res1 = mysqli_query($con,$query1);

$query2 = "select u.name from user u inner join doctor d on u.nic=d.nic where d.doctorID = $doctorID";
$res2 = mysqli_query($con,$query1);

// $prescriptionID =  mysqli_fetch_assoc($res)['prescriptionID'];
$rowResult = mysqli_fetch_assoc($res);
$test_flag = $rowResult['test_flag'];
$drug_flag = $rowResult['drug_flag'];
$date = $rowResult['date'];
$gender = $rowResult['gender'];
$age = $rowResult['age'];
$patientname = mysqli_fetch_assoc($res2)['name'];
$doctorname = mysqli_fetch_assoc($res1)['name'];
$investigation = $rowResult['investigation'];
$impression = $rowResult['Impression'];

if($test_flag){
    $q1 = "select test_name from prescribed_tests where prescriptionID = $prescriptionID";
    $rest1 = mysqli_query($con,$q1);

    $testname = array();

    while($testNameRow = mysqli_fetch_assoc($rest1)){
        array_push($testname, $testNameRow['test_name']);
    }
}
else{
    $testname = '-';
}

if($drug_flag){
    $q2 = "select * from prescribed_drugs where prescriptionID = $prescriptionID";
    $rest2 = mysqli_query($con,$q2);

    $drugname = array();
    $days = array();
    $freq = array();
    $quantity = array();

    while($rowres = mysqli_fetch_assoc($rest2)){
        array_push($drugname, $rowres['drug_name']);
        array_push($days, $rowres['days']);
        array_push($freq, $rowres['frequency']);
        array_push($quantity, $rowres['quantity']);
    }
}
else{
    $drugname = '-';
    $days = '-';
    $freq = '-';
    $quantity = '-';
}

$pdf->Cell(140,10,"Patient's Prescription ROYAL HOSPITAL",1,0);
$pdf->Cell(50,10,"Date:$date",1,1);

$pdf->Cell(190,10,"Doctor_Name:$doctorname",1,1);

$pdf->Cell(50,10,"Patient_Name:",1,0);
$pdf->Cell(140,10,"$patientname",1,1);

$pdf->Cell(50,10,"Patient_Age:",1,0);
$pdf->Cell(140,10,"$age",1,1);

$pdf->Cell(50,10,"Gender:",1,0);
$pdf->Cell(140,10,"$gender",1,1);

$pdf->Cell(47.5,10,"Drug_Names:",1,0);
$pdf->Cell(47.5,10,"Days:",1,0);
$pdf->Cell(47.5,10,"Quantity:",1,0);
$pdf->Cell(47.5,10,"Frequency:",1,1);


for($i=0; $i<count($drugname); $i++){
    $pdf->Cell(47.5,10,"$drugname[$i]",1,0);
    $pdf->Cell(47.5,10,"$days[$i]",1,0);
    $pdf->Cell(47.5,10,"$quantity[$i]",1,0);
    $pdf->Cell(47.5,10,"$freq[$i]",1,1);
}

$pdf->Cell(190,10,"Test_Name:",1,1);

for($i=0; $i<count($testname); $i++){
        $pdf->Cell(190,10,"$testname[$i]",1,1, 'C');
}

$pdf->Cell(50,10,"Investigation:",1,0);
$pdf->Cell(140,10,"$investigation",1,1);

$pdf->Cell(50,10,"Impression:",1,0);
$pdf->Cell(140,10,"$impression",1,1);

$pdf->Output();

}

?>