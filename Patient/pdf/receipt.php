<?php
session_start();
require_once("/xampp/htdocs/Royalhospital/conf/config.php");
require("fpdf.php");

$pdf = new FPDF();

$pdf->AddPage();
$pdf->SetFont("Arial","B",12);

$pid = $_GET['id'];

if(isset($_SESSION['mailaddress']) && $_SESSION['userRole'] == 'Patient'){
    
    $nic = $_SESSION['nic'];
    $pid_query = "SELECT patientID FROM patient WHERE nic = '$nic'";
    $result_pid = mysqli_query($con, $pid_query);
    $pid = mysqli_fetch_assoc($result_pid)['patientID'];

    $query = "select p.date,p.paid_status,p.quantity,p.item_flag,s.service_name,p.quantity*s.cost from purchases p inner join service s on p.item = s.serviceID where p.patientID = $pid and p.paid_status = 'not paid';;";
    $query1 = "select p.date,p.paid_status,p.quantity,p.item_flag,t.test_name,p.quantity*t.cost from purchases p inner join test t on p.item = t.testID where p.patientID = $pid and p.paid_status = 'not paid';;";
    $query2 = "select p.date,p.paid_status,p.quantity,p.item_flag,i.item_name,p.quantity*i.unit_price from purchases p inner join item i on p.item = i.itemID where p.patientID = $pid and p.paid_status = 'not paid';;";

    // $qu1 = "select sum(p.quantity*s.cost) from purchases p inner join service s on p.item = s.serviceID where p.patientID = $pid and p.paid_status = 'not paid';";
    // $qu2 = "select sum(p.quantity*t.cost) from purchases p inner join test t on  p.item = t.testID where p.patientID = $pid and p.paid_status = 'not paid';"; //test
    // $qu3 = "select sum(p.quantity*i.unit_price) from purchases p inner join item i on  p.item = i.itemID where p.patientID = $pid and p.paid_status = 'not paid';"; //drug

    // $res1 = mysqli_query($con,$qu1);
    // $res2 = mysqli_query($con,$qu2);
    // $res3 = mysqli_query($con,$qu3);

    // $npaid1 = mysqli_fetch_assoc($res1);
    // $npaid2 = mysqli_fetch_assoc($res2);
    // $npaid3 = mysqli_fetch_assoc($res3);

    // $npaid = $npaid1['sum(p.quantity*s.cost)'] + $npaid2['sum(p.quantity*t.cost)'] + $npaid3['sum(p.quantity*i.unit_price)'];
    // $_SESSION['total'] = $npaid;

    $result = mysqli_query($con,$query);
    $result1 = mysqli_query($con,$query1);
    $result2 = mysqli_query($con,$query2);

    $total = 0;
    $total1 = 0;
    $total2 = 0;

    $pdf->Cell(38,10,"Date",1,0,'C');
    $pdf->Cell(38,10,"Type",1,0,'C');
    $pdf->Cell(38,10,"Name",1,0,'C');
    $pdf->Cell(38,10,"Quantity",1,0,'C');
    $pdf->Cell(38,10,"Cost",1,0,'C');

while($rows1 = mysqli_fetch_array($result)){
        
    $pdf->Cell(38,10,$rows1['date'],1,0);
    $pdf->Cell(38,10,$rows1['item_flag'],2,0);
    $pdf->Cell(38,10,$rows1['item_name'],3,0);
    $pdf->Cell(38,10,$rows1['quantity'],4,0);
    $pdf->Cell(38,10,$rows1['p.quantity*i.unit_price'].'.00',5,0);

    $total = $total + $rows1['p.quantity*i.unit_price'].'.00';
}

while($rows1 = mysqli_fetch_array($result1)){
        
    $pdf->Cell(38,10,$rows1['date'],1,0);
    $pdf->Cell(38,10,$rows1['item_flag'],2,0);
    $pdf->Cell(38,10,$rows1['item_name'],3,0);
    $pdf->Cell(38,10,$rows1['quantity'],4,0);
    $pdf->Cell(38,10,$rows1['p.quantity*i.unit_price'].'.00',5,0);

    $total1 = $total1 + $rows1['p.quantity*i.unit_price'].'.00';
}

while($rows1 = mysqli_fetch_array($result2)){
        
    $pdf->Cell(38,10,$rows1['date'],1,0);
    $pdf->Cell(38,10,$rows1['item_flag'],1,1);
    $pdf->Cell(38,10,$rows1['item_name'],1,2);
    $pdf->Cell(38,10,$rows1['quantity'],1,3);
    $pdf->Cell(38,10,$rows1['p.quantity*i.unit_price'].'.00',1,4);

    $total1 = $total1 + $rows1['p.quantity*i.unit_price'].'.00';
}

$pdf->Cell(200,10,"Total_Cost:".($total+$total1+$total2),1,0);

$pdf->Output();

}

?>