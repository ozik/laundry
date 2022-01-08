<?php
//koneksi ke database
require_once('../koneksi.php');
//Memanggil file FPDF dari file yang anda download tadi
require('../assets/plugins/fpdf/fpdf.php');
{
date_default_timezone_set('Asia/Jakarta');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );
}
session_start();
$id_karyawan=$_SESSION['Id_karyawan'];
$query = mysqli_query($koneksi,"SELECT Nama FROM tb_karyawan where Id_karyawan='$id_karyawan'");
while($data = mysqli_fetch_array($query)){
$nama_karyawan=$data["Nama"];
}
$query=mysqli_query($koneksi,"SELECT Id_order,Tgl_masuk,Estimasi,Total_harga,Status_pembayaran FROM tb_order GROUP BY Id_order DESC LIMIT 1");
while($lihat=mysqli_fetch_row($query)){
$Id_order=$lihat[0];
$Tgl_masuk=date("d/m/Y",strtotime($lihat[1]));
$Tgl_selesai=date("d/m/Y",strtotime($lihat[2]));
$Total_harga=$lihat[3];
$Status_pembayaran=$lihat[4];
}
$query=mysqli_query($koneksi,"SELECT tb_pelanggan.Id_pelanggan,tb_pelanggan.Nama,tb_pelanggan.Alamat,tb_pelanggan.Jk,tb_pelanggan.No_telp FROM tb_order INNER JOIN tb_pelanggan on tb_order.Id_pelanggan=tb_pelanggan.Id_pelanggan WHERE tb_order.Id_order='$Id_order'");
while($lihat=mysqli_fetch_row($query)){
$Id_pelanggan=$lihat[0];
$Nama=$lihat[1];
$alamat=$lihat[2];
$Jk=$lihat[3];
$no_telp=$lihat[4];
}
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

$this->Cell(130 ,5,'JL. Pandega Marta No.99-101, Pogung Kidul, Sinduadi, Mlati, Sleman',0,1);
$this->Cell(130 ,5,'Daerah Istimewa Yogyakarta',0,1);
$this->Cell(130 ,5,'Telp 0822 4113 9809',0,1);
$this->Cell(129 ,1,'','B',1,'L');
$this->Cell(129 ,1,'','B',1,'L');
$this->Cell(129 ,5,'',0,1);//end of line
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',10);
    // Page number
    $this->Cell(130,4,"Di Cetak Pada : ".date("d/m/Y"),0,0,'C');
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

$pdf = new PDF('P','mm','A5');
$pdf->AliasNbPages();
$pdf->AddPage();
//set font to arial, regular, 12pt
$pdf->SetFont('Arial','',10);

$pdf->Cell(30 ,6,'Id Pelanggan :',0,0);
$pdf->Cell(43 ,6,$Id_pelanggan,0,0);
$pdf->Cell(36 ,6,'Id Order :',0,0);
$pdf->Cell(43 ,6,$Id_order,0,1);//end of line

$pdf->Cell(30 ,6,'Nama :',0,0);
$pdf->Cell(43 ,6,$Nama,0,0);
$pdf->Cell(36 ,6,'Tgl Masuk :',0,0);
$pdf->Cell(43 ,6,$Tgl_masuk,0,1);//end of line

$pdf->Cell(30 ,6,'Alamat :',0,0);
$pdf->Cell(43 ,6,$alamat,0,0);
$pdf->Cell(36 ,6,'Tgl Selesai :',0,0);
$pdf->Cell(43 ,6,$Tgl_selesai,0,1);//end of line

$pdf->Cell(30 ,6,'Jenis Kelamin :',0,0);
$pdf->Cell(43 ,6,$Jk,0,0);
$pdf->Cell(36 ,6,'Total harga :',0,0);
$pdf->Cell(43 ,6,$Total_harga,0,1);//end of line

$pdf->Cell(30 ,6,'No telp :',0,0);
$pdf->Cell(43 ,6,$no_telp,0,0);
$pdf->Cell(36 ,6,'Status Pembayaran :',0,0);
$pdf->Cell(43 ,6,$Status_pembayaran,0,1);//end of line

//make a dummy empty cell as a vertical spacer
$pdf->Cell(148  ,5,'',0,1);//end of line

//billing address
$pdf->SetFont('Arial','B',11);
$pdf->Cell(100 ,5,'Detail Order Laundry',0,1);//end of line
$pdf->Cell(100 ,0,'',0,1);//end of line


$pdf->SetFont('Arial','B',10);
$pdf->Cell(7 ,7,'No',0,0);
$pdf->Cell(25 ,7,'layanan',0,0);
$pdf->Cell(16 ,7,'Jenis',0,0);
$pdf->Cell(17 ,7,'Jumlah',0,0,'C');
$pdf->Cell(20 ,7,'Satuan',0,0);
$pdf->Cell(30 ,7,'Keterangan',0,0);
$pdf->Cell(25 ,7,'Harga',0,1);
$query=mysqli_query($koneksi,"SELECT tb_layanan.Nama,tb_layanan.Jenis,tb_detail_order.Jumlah,tb_layanan.Satuan,tb_detail_order.Keterangan,tb_detail_order.harga FROM tb_detail_order INNER JOIN tb_layanan on tb_detail_order.Id_layanan=tb_layanan.Id_layanan where tb_detail_order.id_order='$Id_order'");
$no=1;
while($lihat=mysqli_fetch_row($query)){
$pdf->SetFont('Arial','',10);
$pdf->Cell(7 ,5,$no,0,0);
$pdf->Cell(25 ,5,$lihat[0],0,0);
$pdf->Cell(16 ,5,$lihat[1],0,0);
$pdf->Cell(17 ,5,$lihat[2],0,0,'C');
$pdf->Cell(20 ,5,$lihat[3],0,0);
$pdf->Cell(30 ,5,$lihat[4],0,0);
$pdf->Cell(25 ,5,$lihat[5],0,1);
$no++;
}
//set font to arial, bold, 14pt
$pdf->Cell(148 ,10,'',0,1);//end of line
$pdf->SetFont('Arial','B',10);
$query=mysqli_query($koneksi,"SELECT tb_layanan.Nama,tb_layanan.Jenis,tb_detail_order.Jumlah,tb_layanan.Satuan,tb_detail_order.Keterangan,tb_detail_order.harga FROM tb_detail_order INNER JOIN tb_layanan on tb_detail_order.Id_layanan=tb_layanan.Id_layanan where tb_detail_order.id_order='$Id_order'");
$pdf->Cell(75 ,4,'',0,0);
$pdf->Cell(27 ,5,'Dilayani Oleh :',0,0);
$pdf->Cell(40 ,4,$nama_karyawan,0,1);

$pdf->Output("Laporan Check.pdf","I");
?>