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

    $query = "select p.date,p.paid_status,p.quantity,p.item_flag,s.service_name,p.quantity*s.cost from purchases p inner join service s on p.item = s.serviceID where p.patientID = $pid and p.paid_status1 = 'Not Paid';";
    $query1 = "select p.date,p.paid_status,p.quantity,p.item_flag,t.test_name,p.quantity*t.cost from purchases p inner join test t on p.item = t.testID where p.patientID = $pid and p.paid_status1 = 'Not Paid';";
    $query2 = "select p.date,p.paid_status,p.quantity,p.item_flag,i.item_name,p.quantity*i.unit_price from purchases p inner join item i on p.item = i.itemID where p.patientID = $pid and p.paid_status1 = 'Not Paid';";

    $result = mysqli_query($con,$query);
    $result1 = mysqli_query($con,$query1);
    $result2 = mysqli_query($con,$query2);

    $total = 0;
    $total1 = 0;
    $total2 = 0;
    

    $pdf->SetTextColor(0,0,255);
    $pdf->Cell(190,10,"Royal Hospital Patient's Payment Confirmation Receipt",0,1,'C');
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(38,10,"Date",1,0,'C');
    $pdf->Cell(38,10,"Type",1,0,'C');
    $pdf->Cell(58,10,"Name",1,0,'C');
    $pdf->Cell(18,10,"Quantity",1,0,'C');
    $pdf->Cell(38,10,"Cost",1,1,'C');

while($rows1 = mysqli_fetch_array($result)){
    if($rows1['item_flag'] == 's')
    {
        $item =  'Service';
    }
    elseif($rows1['item_flag'] == 't')
    {
        $item ='Test';
    }
    elseif($rows1['item_flag'] == 'd')
    {
        $item ='Drugs';
    }
        
    $pdf->Cell(38,10,$rows1['date'],1,0);
    $pdf->Cell(38,10,$item,1,0);
    $pdf->Cell(58,10,$rows1['service_name'],1,0);
    $pdf->Cell(18,10,$rows1['quantity'],1,0);
    $pdf->Cell(38,10,$rows1['p.quantity*s.cost'].'.00',1,1);

    $total = $total + $rows1['p.quantity*s.cost'].'.00';
}

while($rows1 = mysqli_fetch_array($result1)){
    if($rows1['item_flag'] == 's')
    {
        $item =  'Service';
    }
    elseif($rows1['item_flag'] == 't')
    {
        $item ='Test';
    }
    elseif($rows1['item_flag'] == 'd')
    {
        $item ='Drugs';
    }
        
    $pdf->Cell(38,10,$rows1['date'],1,0);
    $pdf->Cell(38,10,$item,1,0);
    $pdf->Cell(58,10,$rows1['test_name'],1,0);
    $pdf->Cell(18,10,$rows1['quantity'],1,0);
    $pdf->Cell(38,10,$rows1['p.quantity*t.cost'].'.00',1,1);

    $total1 = $total1 + $rows1['p.quantity*t.cost'].'.00';
}

while($rows1 = mysqli_fetch_array($result2)){
    if($rows1['item_flag'] == 's')
    {
        $item =  'Service';
    }
    elseif($rows1['item_flag'] == 't')
    {
        $item ='Test';
    }
    elseif($rows1['item_flag'] == 'd')
    {
        $item ='Drugs';
    }
        
    $pdf->Cell(38,10,$rows1['date'],1,0);
    $pdf->Cell(38,10,$item,1,0);
    $pdf->Cell(58,10,$rows1['item_name'],1,0);
    $pdf->Cell(18,10,$rows1['quantity'],1,0);
    $pdf->Cell(38,10,$rows1['p.quantity*i.unit_price'].'.00',1,1);

    $total1 = $total1 + $rows1['p.quantity*i.unit_price'].'.00';
}
$pdf->SetTextColor(255,0,0);
$pdf->Cell(120,10,'Successfully Paid',1,0);
$pdf->SetTextColor(255,0,0);
$pdf->Cell(70,10,"Total_Cost:LKR ".($total+$total1+$total2).'.00',1,1);

$pdf->Output();

}

?>