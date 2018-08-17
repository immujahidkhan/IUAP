<?php
include "config.php";
include_once('libs/fpdf.php');
class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('logo.png',10,-1,70);
    $this->SetFont('Arial','B',13);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(80,10,'Employee List',1,0,'C');
    // Line break
    $this->Ln(20);
}
 
// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
$query= $class->fetchdata("SELECT * FROM `admin_p_detail`");
$rows=$query->fetch(PDO::FETCH_ASSOC);
$image="http://localhost/rimsha/images/banner1.jpg";
$pdf =new FPDF();
$pdf-> AddPage();
$pdf-> SetFont("Arial","B",10);
$pdf-> Image(''.$image,100,15,35,35);
$pdf->Output();
?>