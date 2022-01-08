<section class="main-content-wrapper">
<section id="main-content" class="animated fadeInUp">
<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">Detail Order</h3>
<div class="actions pull-right">
<i class="fa fa-chevron-down"></i>
</div>
</div>
<!--page body-->
<div class="panel-body">
<!--tampil data-->
<div class="row">
	<div class="col-md-6">
  <div class="table-responsive">
 <table class="table table-condensed">
<?php 
$id_order=$_GET['id'];
$query=mysqli_query($koneksi,"SELECT tb_pelanggan.Id_pelanggan,tb_pelanggan.Nama,tb_pelanggan.Alamat,tb_pelanggan.Jk,tb_pelanggan.No_telp FROM tb_order INNER JOIN tb_pelanggan ON tb_order.Id_pelanggan=tb_pelanggan.Id_pelanggan WHERE tb_order.Id_order='$id_order'");
while ($data_plg=mysqli_fetch_array($query)){ ?>
  <tr>
    <td width="130"><b>Id Pelanggan </b> </td>
    <td><?php echo $data_plg[0]; ?></td>
  </tr>
  <tr>
    <td><b>Nama</b> </td>
    <td><?php echo $data_plg[1]; ?></td>
  </tr>
  <tr>
    <td><b>Alamat</b> </td>
    <td><?php echo $data_plg[2]; ?></td>
  </tr>
  <tr>
    <td><b>Jenis Kelamin</b> </td>
    <td><?php echo $data_plg[3]; ?></td>
  </tr>
  <tr>
    <td><b>No Telp </b></td>
    <td><?php echo $data_plg[4]; }?></td>
  </tr>
 </table>
   </div>
   </div>
   <div class="col-md-6">
  <div class="table-responsive">
 <table class="table table-condensed">
 <?php 
$id_order=$_GET['id'];
$query=mysqli_query($koneksi,"SELECT ID_order,Tgl_masuk,Estimasi,Total_harga,Status_pembayaran from tb_order WHERE Id_order='$id_order' ");
while ($data_order=mysqli_fetch_row($query)) { ?>
  <tr>
    <td><b>Id order </b></td>
    <td><?php echo $data_order[0]; ?></td>
  </tr>
  <tr>
    <td><b>Tgl masuk </b> </td>
    <td><?php echo $data_order[1]; ?></td>
  </tr>
  <tr>
    <td><b>Tgl Selesai </b></td>
    <td><?php echo $data_order[2]; ?></td>
  </tr>
  <tr>
    <td><b>Total Harga </b></td>
    <td><?php echo $data_order[3]; ?></td>
  </tr>
  <tr>
    <td><b>Status Pembayaran </b></td>
    <td><?php echo $data_order[4]; } ?></td>
  </tr>
 </table>
   </div>
   </div>
	
</div>
  <div class="table-responsive">
 <form action="?page=Laundry-an" method="post">
    <table class="table table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>No</th>
            <th>Layanan</th>
            <th>Jenis</th>
            <th>Jumlah</th>
            <th>Satuan</th>
            <th>Estimasi Selesai</th>
            <th>Keterangan</th>
            <th>Harga</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
    <?php
$query=mysqli_query($koneksi,"SELECT tb_detail_order.Id_penerimaan,tb_layanan.Nama,tb_layanan.Jenis,tb_detail_order.Jumlah,tb_layanan.Satuan,tb_detail_order.Estimasi,tb_detail_order.Keterangan,tb_detail_order.harga,tb_detail_order.Status FROM tb_detail_order INNER JOIN tb_layanan on tb_detail_order.Id_layanan=tb_layanan.Id_layanan where tb_detail_order.id_order='$id_order'");
$no = 1;
while ($data=mysqli_fetch_array($query)) {
?>
        <tr>
          <td><input type="checkbox" name="Penerimaan[]" value="<?php echo $data["Id_penerimaan"];?>"></td>
          <td><?php echo $no ?></td>
          <td><?php echo $data["Nama"];?></td>
          <td><?php echo $data["Jenis"];?></td>
          <td><?php echo $data["Jumlah"];?></td>
          <td><?php echo $data["Satuan"];?></td>
          <td><?php echo $data["Estimasi"];?></td>
          <td><?php echo $data["Keterangan"];?></td>
          <td><?php echo $data["harga"];?></td>
          <td><?php echo $data["Status"];?></td>
        </tr>
          <?php $no++; } ?>
   <tr>
   <td colspan="8"><b>NB* Pilih Data Order yang sudah Selesai</b></td>
    <td align="right"><a href="?page=Laundry-an" class="btn btn-default btn-sm">&nbsp;Batal&nbsp;</a></td>
	<td><input type="submit" class="btn btn-info btn-sm" name="update_order" value="Simpan"></td> 
    </tr>
    </tbody>
</table>
</form>
   </div>
</div>
<!--end page body-->
</div>
</div>
</div> 
</section>
<!--end tag template-->
</section>