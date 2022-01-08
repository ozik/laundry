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
$pdf->Cell(189 ,5,'Laporan Data Transaksi Stok',0,1,'C');//end of line
$pdf->Cell(189 ,5,'',0,1);//end of line

$pdf->SetFont('Arial','',12);
$pdf->Cell(40 ,7,'Periode laporan :',0,0);
$pdf->Cell(20 ,7,Date('Y-m-d'),0,1);
$pdf->Cell(189 ,5,'',0,1);//end of line

$pdf->SetFont('Arial','B',12);
$pdf->Cell(7 ,7,'No',0,0);
$pdf->Cell(40 ,7,'Nama Karyawan ',0,0);
$pdf->Cell(48 ,7,'Jenis Transaksi',0,0);
$pdf->Cell(40 ,7,'Bahan baku',0,0);
$pdf->Cell(30 ,7,'Jumlah',0,0);
$pdf->Cell(25 ,7,'Tanggal',0,1);
$tgl=date('m');
  $query1=mysqli_query($koneksi,"SELECT tb_karyawan.Nama,tb_pengeluaran.Jenis,tb_pengeluaran.kegunaan,tb_pengeluaran.Jumlah,tb_pengeluaran.Tgl,tb_pengeluaran.Biaya FROM tb_pengeluaran INNER JOIN tb_karyawan on tb_pengeluaran.Id_karyawan=tb_karyawan.Id_karyawan where  month(tb_pengeluaran.Tgl)='$tgl' and tb_pengeluaran.Jenis !='Biaya Operasional'");
$no=1;
while($data=mysqli_fetch_row($query1)){
  $pdf->SetFont('Arial','',12);
$pdf->Cell(7 ,6,$no,0,0);
$pdf->Cell(40 ,6,$data[0],0,0);
$pdf->Cell(48 ,6,$data[1],0,0);
$pdf->Cell(40 ,6,$data[2],0,0);
$pdf->Cell(30 ,6,$data[3],0,0);
$pdf->Cell(25 ,6,$data[4],0,1);
$no++;
}
$pdf->Output();
?>