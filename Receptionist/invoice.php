<?php
require('fpdf183/fpdf.php');
session_start();
require_once("../conf/config.php");



$queryPatient = mysqli_query($con, "SELECT * FROM user INNER JOIN patient on user.nic = patient.nic WHERE patientID='".$_GET['id']."'");
$patient = mysqli_fetch_array($queryPatient);
//die(print_r($invoice));

//die($_GET['query']);

//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

$pdf = new FPDF('P','mm','A4');

$pdf->AddPage();

//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',14);

//Cell(width , height , text , border , end line , [align] )

$pdf->Cell(130	,5,'Royal Hospital',0,0);
$pdf->Cell(59	,5,'INVOICE',0,1);//end of line

//set font to arial, regular, 12pt
$pdf->SetFont('Arial','',12);

$pdf->Cell(130	,5,'No. 56, Galle Road,',0,0);
$pdf->Cell(59	,5,'',0,1);//end of line

$pdf->Cell(130	,5,'Colombo, Sri Lanka, 00100',0,0);
$pdf->Cell(25	,5,'Date',0,0);
$pdf->Cell(34	,5,date("d/m/Y"),0,1);//end of line

$pdf->Cell(130	,5,'Phone [+12345678]',0,0);
$pdf->Cell(25	,5,'Invoice #',0,0);
$pdf->Cell(34	,5,'',0,1);//end of line

$pdf->Cell(130	,5,'Fax [+12345678]',0,0);
$pdf->Cell(25	,5,'Patient ID',0,0);
$pdf->Cell(34	,5,$_GET['id'],0,1);//end of line

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189	,10,'',0,1);//end of line

//billing address
$pdf->Cell(100	,5,'Bill to',0,1);//end of line

//add dummy cell at beginning of each line for indentation
$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,$patient['name'],0,1);

$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,$patient['address'],0,1);

$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,$patient['contact_num'],0,1);

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189	,10,'',0,1);//end of line

//invoice contents
$pdf->SetFont('Arial','B',12);

$pdf->Cell(37.8	,5,'Purchase Date',1,0);
$pdf->Cell(37.8	,5,'Description',1,0);
$pdf->Cell(37.8	,5,'Quantity',1,0);
$pdf->Cell(37.8	,5,'Status',1,0);
$pdf->Cell(37.8	,5,'Amount',1,1);

$pdf->SetFont('Arial','',12);

//Numbers are right-aligned so we give 'R' after new line parameter

//items
//$query=mysqli_query($con,"select * from item where invoiceID = '".$invoice['invoiceID']."'");
$queryInvoice=mysqli_query($con,$_GET['query']);
$amount=0;
while($invoice=mysqli_fetch_array($queryInvoice)){
    $pdf->Cell(37.8	,5,$invoice['date'],1,0);
    $pdf->Cell(37.8	,5,$invoice['name'],1,0);
    $pdf->Cell(37.8	,5,number_format($invoice['quantity']),1,0);
    $pdf->Cell(37.8	,5,$invoice['paid_status'],1,0);
    $pdf->Cell(37.8	,5,number_format($invoice['rate']),1,1);

    $amount+=$invoice['rate'];
}

//summary

$pdf->Cell(130	,5,'',0,0);
$pdf->Cell(25	,5,'Total Due',0,0);
$pdf->Cell(4	,5,'$',1,0);
$pdf->Cell(30	,5,number_format($amount),1,1,'R');//end of line

$pdf->Output();
?>
