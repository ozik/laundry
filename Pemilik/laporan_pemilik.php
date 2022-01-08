<?php
require_once('../koneksi.php');
//Memanggil file FPDF dari file yang anda download tadi
require('../assets/plugins/fpdf/fpdf.php');
class PDF extends FPDF
{
// Page header
function Header()
{
//set font to arial, bold, 14pt
$this->SetFont('Arial','B',16);


//Cell(width , height , text , border , end line , [align] )

$this->Cell(189 ,5,'Arsena Laundry',0,1);

//set font to arial, regular, 12pt
$this->SetFont('Arial','',12);

$this->Cell(189 ,5,'JL. Pandega Marta No.99-101, Pogung Kidul, Sinduadi, Mlati, Sleman',0,1);
$this->Cell(189 ,5,'Daerah Istimewa Yogyakarta',0,1);
$this->Cell(189 ,5,'Telp 0822 4113 9809',0,1);
$this->Cell(189 ,1,'','B',1,'L');
$this->Cell(189 ,1,'','B',1,'L');
$this->Cell(189 ,5,'',0,1);//end of line
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',10);
    // Page number
    $this->Cell(189,4,"Di Cetak Pada : ".date("d/m/Y"),0,0,'C');
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);
$pdf->Cell(189 ,5,'Laporan Data Pemilik',0,1,'C');//end of line
$pdf->Cell(189 ,10,'',0,1);//end of line


$pdf->SetFont('Arial','B',12);
$pdf->Cell(7 ,7,'No',0,0);
$pdf->Cell(25 ,7,'Id Pemilik',0,0);
$pdf->Cell(32 ,7,'Nama',0,0);
$pdf->Cell(45 ,7,'Alamat',0,0);
$pdf->Cell(25 ,7,'Jenis kel',0,0);
$pdf->Cell(25 ,7,'Tgl Lahir',0,0);
$pdf->Cell(32 ,7,'No Telp',0,1);
$query=mysqli_query($koneksi,"SELECT * FROM tb_pemilik");
$no=1;
while($lihat=mysqli_fetch_row($query)){
$pdf->SetFont('Arial','',12);
$pdf->Cell(7 ,6,$no,0,0);
$pdf->Cell(25 ,6,$lihat[0],0,0);
$pdf->Cell(32 ,6,$lihat[1],0,0);
$pdf->Cell(45 ,6,$lihat[2],0,0);
$pdf->Cell(25 ,6,$lihat[3],0,0);
$pdf->Cell(25 ,6,$lihat[4],0,0);
$pdf->Cell(32 ,6,$lihat[5],0,1);
$no++;
}

$pdf->Output();
?>