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
$pdf->Cell(189 ,5,'Laporan Data Laundry-an',0,1,'C');//end of line
$pdf->Cell(189 ,10,'',0,1);//end of line



$dari=$_GET['awal'];
$sampai=$_GET['sampai'];
$query=mysqli_query($koneksi,"SELECT tb_pelanggan.Id_pelanggan,tb_pelanggan.Nama,tb_pelanggan.Alamat,tb_pelanggan.No_telp,tb_order.Id_order,tb_order.Tgl_masuk,tb_order.Estimasi,tb_order.Total_harga FROM `tb_order` LEFT JOIN tb_pelanggan on tb_order.Id_pelanggan=tb_pelanggan.Id_pelanggan where Tgl_masuk between '$dari' and '$sampai'");
while($lihat=mysqli_fetch_row($query)){
$Id_order=$lihat[4];

$pdf->SetFont('Arial','',12);
$pdf->Cell(35 ,7,'Id Pelanggan :',0,0);
$pdf->Cell(97 ,7,$lihat[0],0,0);
$pdf->Cell(30 ,7,'Id Order :',0,0);
$pdf->Cell(50 ,7,$lihat[4],0,1);

$pdf->Cell(35 ,7,'Nama :',0,0);
$pdf->Cell(97 ,7,$lihat[1],0,0);
$pdf->Cell(30 ,7,'Tgl Masuk :',0,0);
$pdf->Cell(50 ,7,$lihat[5],0,1);

$pdf->Cell(35 ,7,'Alamat :',0,0);
$pdf->Cell(97 ,7,$lihat[2],0,0);
$pdf->Cell(30 ,7,'Tgl Selesai :',0,0);
$pdf->Cell(50 ,7,$lihat[6],0,1);

$pdf->Cell(35 ,7,'No Telp :',0,0);
$pdf->Cell(97 ,7,$lihat[3],0,0);
$pdf->Cell(30 ,7,'Total Harga :',0,0);
$pdf->Cell(50 ,7,$lihat[7],0,1);

$pdf->Cell(148 ,3,'',0,1);//end of line
$pdf->Cell(7 ,7,'No',0,0);
$pdf->Cell(10 ,7,'Id ',0,0);
$pdf->Cell(32 ,7,'Nama Layanan',0,0);
$pdf->Cell(30 ,7,'Jenis Layanan',0,0);
$pdf->Cell(20 ,7,'Jumlah',0,0);
$pdf->Cell(25 ,7,'Satuan',0,0);
$pdf->Cell(25 ,7,'Tgl ambil',0,0);
$pdf->Cell(25 ,7,'Keterangan',0,0);
$pdf->Cell(25 ,7,'Harga',0,1);
	$query1=mysqli_query($koneksi,"SELECT tb_penerimaan.Id_penerimaan,tb_layanan.Nama,tb_layanan.Jenis,tb_penerimaan.Jumlah,tb_layanan.Satuan,tb_penerimaan.Tgl_ambil,tb_penerimaan.Keterangan,tb_penerimaan.harga,tb_penerimaan.Status FROM tb_penerimaan INNER JOIN tb_layanan on tb_penerimaan.Id_layanan=tb_layanan.Id_layanan where tb_penerimaan.id_order='$Id_order'");
$no=1;
while($data=mysqli_fetch_row($query1)){
	$pdf->SetFont('Arial','',12);
$pdf->Cell(7 ,6,$no,0,0);
$pdf->Cell(10 ,6,$data[0],0,0);
$pdf->Cell(32 ,6,$data[1],0,0);
$pdf->Cell(30 ,6,$data[2],0,0);
$pdf->Cell(20 ,6,$data[3],0,0);
$pdf->Cell(25 ,6,$data[4],0,0);
$pdf->Cell(25 ,6,$data[5],0,0);
$pdf->Cell(25 ,6,$data[6],0,0);
$pdf->Cell(25 ,6,$data[7],0,1);
$no++;
}
$pdf->Cell(148 ,5,'',0,1);//end of line
$pdf->Cell(189 ,1,'','B',1,'P');
$pdf->Cell(148 ,5,'',0,1);//end of line
}
$pdf->Output();
?>