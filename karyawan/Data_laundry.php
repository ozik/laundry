<section class="main-content-wrapper">
<section id="main-content" class="animated fadeInUp">
<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">Data Laundry-an</h3>
<div class="actions pull-right">
<a href="?page=Penerimaan" class="btn btn-info btn-sm">Tambah</a>
<i class="fa fa-expand"></i>
<i class="fa fa-chevron-down"></i>
</div>
</div>
<!--page body-->
<div class="panel-body">

<!--proses Tambah data-->
<?php 
if(isset($_POST['Simpan_ambil'])){
$Penerimaan=$_POST['Penerimaan'];
$tgl=date("Ymd");
mysqli_query($koneksi,"UPDATE tb_detail_order set Status='Diambil',Tgl_ambil=$tgl WHERE Id_penerimaan IN(".implode(",",$Penerimaan).")");
$query = mysqli_query($koneksi,"SELECT Id_order FROM `tb_detail_order` WHERE Id_penerimaan IN(".implode(",",$Penerimaan).")");
  while ($data=mysqli_fetch_row($query)) {
  $id_order=$data[0];
  }
$query = mysqli_query($koneksi,"SELECT Status_pembayaran FROM `tb_order` WHERE Id_order='$id_order'");
  while ($data=mysqli_fetch_row($query)) {
  $Pembayaran=$data[0];
  }
$query = mysqli_query($koneksi,"SELECT Count(Id_penerimaan) from tb_detail_order WHERE Id_order='$id_order'");
  while ($data=mysqli_fetch_row($query)) {
  $Id_penerimaan=$data[0];
  }
$query = mysqli_query($koneksi,"SELECT COUNT(Status) from tb_detail_order WHERE Status='Diambil' and Id_order='$id_order'");
  while ($data=mysqli_fetch_row($query)) {
  $status=$data[0];
  }
  if ($Pembayaran='-') {
    $Status_pembayaran="Lunas";
    mysqli_query($koneksi,"UPDATE tb_order SET Status_pembayaran='$Status_pembayaran' WHERE Id_order='$id_order'");
  }
   if($status==$Id_penerimaan){
    $status='Diambil';
    mysqli_query($koneksi,"UPDATE tb_order SET Status='$status' WHERE Id_order='$id_order'");
  }

}
if(isset($_POST['update_order'])){
$Penerimaan=$_POST['Penerimaan']; 
mysqli_query($koneksi,"UPDATE tb_detail_order set Status='Selesai' WHERE Id_penerimaan IN(".implode(",",$Penerimaan).")");
$query = mysqli_query($koneksi,"SELECT Id_order,tgl_masuk FROM `tb_detail_order` WHERE Id_penerimaan IN(".implode(",",$Penerimaan).")");
  while ($data=mysqli_fetch_row($query)) {
  $id_order=$data[0];
  $tgl_masuk=$data[1];
  }
$query = mysqli_query($koneksi,"SELECT tb_pelanggan.No_telp,tb_pelanggan.Nama FROM tb_order INNER JOIN tb_pelanggan ON tb_order.Id_pelanggan=tb_pelanggan.Id_pelanggan WHERE tb_order.Id_order='$id_order'");
  while ($data=mysqli_fetch_row($query)) {
  $Notelp=$data[0];
  $namaplg=$data[1];
  }
  $isi_sms="pelanggan Arsena laundry proses pencucian atas nama ".$namaplg." ,tanggal masuk laundry ".$tgl_masuk." telah selesai dan dapat dilakukan pengambilan.Terima kasih";
$query = mysqli_query($koneksi,"SELECT Count(Status) from tb_detail_order WHERE Status='Proses' and Id_order='$id_order'");
  while ($data=mysqli_fetch_row($query)) {
  $status=$data[0];
  }
  if($status=='0')
  {
    $status='Selesai';
    mysqli_query($koneksi,"INSERT INTO outbox(DestinationNumber, TextDecoded, CreatorID) VALUES ('$Notelp','$isi_sms','Gammu')");
  }else {
  $status="Dalam Proses ".$status;
  }
mysqli_query($koneksi,"UPDATE tb_order SET Status='$status' WHERE Id_order='$id_order'");
}
if(isset($_POST['Simpan_transaksi'])){
$id_order=$_POST['id_order'];
$Tgl_masuk=$_POST['tgl_masuk'];
$Tgl_masuk=date("Ymd",strtotime($Tgl_masuk));
$Estimasi=$_POST['tgl_selesai'];
$Estimasi=date("Ymd",strtotime($Estimasi));
$Total_harga=$_POST['total_harga'];
$Status_pembayaran=$_POST['status_pemabayaran'];
$Status=$_POST['jumlah_order'];
$Status="Dalam Proses ".$Status;
if ($Status_pembayaran=="akhir") {
  $Status_pembayaran="Belum lunas";
  mysqli_query($koneksi,"UPDATE tb_order SET Tgl_masuk=$Tgl_masuk,Estimasi=$Estimasi,Total_harga=$Total_harga,Status_pembayaran='$Status_pembayaran',Status='$Status' WHERE id_order='$id_order'");
  }else if ($Status_pembayaran=="awal") {
    $Status_pembayaran="Lunas";
    mysqli_query($koneksi,"UPDATE tb_order SET Id_karyawan='$id_karyawan',Tgl_masuk=$Tgl_masuk,Estimasi=$Estimasi,Total_harga=$Total_harga,Status_pembayaran='$Status_pembayaran',Status='$Status' WHERE id_order='$id_order'");
  }
} 
if(isset($_POST['batal_transaksi'])){
$id_order=$_POST['id_order'];
mysqli_query($koneksi,"DELETE FROM tb_order WHERE id_order='$id_order'");
mysqli_query($koneksi,"DELETE FROM tb_detail_order WHERE id_order='$id_order'");
}
 ?>
<!--end proses Tambah data-->

<!--tampil data-->
<div class="table-responsive">
<table id="tabel_data" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
      <tr>  
            <th>No</th>
            <th>Id Order</th>
            <th>Nama Pelanggan</th>
            <th>Tgl Masuk</th>
            <th>Tgl Selesai</th>
            <th>Status Pembayaran</th>
            <th>Total Harga</th>
            <th width="110px">Status Order</th>
            <th>Action</th>
      </tr>
    </thead>
    <tbody>
<?php 

mysqli_query($koneksi,"DELETE FROM `tb_detail_order` WHERE Id_order=(SELECT Id_order FROM tb_order WHERE Total_harga is null);");
mysqli_query($koneksi,"DELETE FROM `tb_order` WHERE Total_harga is null;");
$query = mysqli_query($koneksi,"SELECT tb_order.Id_order,tb_pelanggan.Nama,tb_order.Tgl_masuk,tb_order.Estimasi,tb_order.Status_pembayaran,tb_order.Total_harga,tb_order.Status FROM tb_order INNER JOIN tb_pelanggan on tb_order.Id_pelanggan=tb_pelanggan.Id_pelanggan ORDER BY tb_order.Id_order DESC");
$no = 1;
while ($data=mysqli_fetch_row($query)) {
?>
      <tr>
          <td><?php echo $no ?></td>
          <td><?php echo $data[0];?></td>
          <td><?php echo $data[1];?></td>
          <td><?php echo $data[2];?></td>
          <td><?php echo $data[3];?></td>
          <td><?php echo $data[4];?></td>
          <td><?php echo $data[5];?></td>
          <td><?php echo $data[6];?></td>
          <td align="center">
            <a href="?page=Detail order&id=<?php echo $data[0];?>">
                <button type="button" class="btn btn-info  btn-trans btn-xs" title="Detail Order">
                <i class="fa fa-eye"></i></button></a>
            <a href="?page=Pengembalian&id=<?php echo $data[0];?>">
                <button type="button" class="btn btn-danger  btn-trans btn-xs" title="Ambil Laundry">
                <i class="fa fa-minus-circle"></i></button></a>
<?php $no++; } ?>
          </td>
      </tr>
    </tbody>
</table>
<!--end tampil data-->

<!--tag template-->
</div>
</div>
<!--end page body-->
</div>
</div>
</div> 
</section>
<!--end tag template-->
</section>