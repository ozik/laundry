<section class="main-content-wrapper">
<section id="main-content" class="animated fadeInUp">
<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">Laporan data Laundry-an</h3>
<div class="actions pull-right">
<i class="fa fa-chevron-down"></i>
</div>
</div>
<!--page body-->
<div class="panel-body">
<div class="row">
<form action="" method="post">
<div class="col-lg-12">
	<div class="form-group">
      <label class="col-sm-2 control-label">Dari Tanggal</label>
    <div class="col-sm-3">
      <input type="date" class="form-control" name="awal" placeholder="Tanggal lahiir" required>
    </div>
    <label class="col-sm-2 control-label">Sampai Tanggal</label>
    <div class="col-sm-3">
      <input type="date" class="form-control" name="sampai" placeholder="Tanggal lahiir" required>
    </div>
    <div class="col-sm-2">
      <input type="submit" class="btn btn-success" name="cari" value="&nbsp; Cari &nbsp; ">
    </div>
    </div>
</div>
</form>
</div>
<br>
<!--tampil data-->
<div class="row">
<div class="col-lg-12">
<div class="table-responsive">
<table class="table table-hover">
    <thead>
      <tr>
            <th>No</th>
            <th>Id order</th>
            <th>Nama Pelanggan</th>
            <th>Nama Karyawan</th>
            <th>Tgl Masuk</th>
            <th>Total harga</th>
            <th>Status Pembayaran</th>
            <th>Status</th>
      </tr>
    </thead>
    <tbody>
<?php 
if(isset($_POST['cari'])){
$dari=$_POST['awal'];
$sampai=$_POST['sampai'];
$query = mysqli_query($koneksi,"SELECT tb_order.Id_order,tb_pelanggan.Nama,tb_karyawan.Nama,tb_order.Tgl_masuk,tb_order.Total_harga,tb_order.Status_pembayaran,tb_order.Status FROM tb_order INNER JOIN tb_pelanggan ON tb_order.Id_pelanggan=tb_pelanggan.Id_pelanggan INNER JOIN tb_karyawan ON tb_order.Id_karyawan=tb_karyawan.Id_karyawan where tb_order.Tgl_masuk between '$dari' and '$sampai'");
$no = 1;
while($data =mysqli_fetch_row($query)){	
?>
      <tr>
          <td><?php echo $no ?></td>
          <td><?php echo $data[0];?></td>
          <td><?php echo $data[1];?></td>
          <td><?php echo $data[2];?></td>
          <td><?php echo $data[3];?></td>
          <td><?php echo $data[4];?></td>
          <td><?php echo $data[5];?></td>
          <td><?php echo $data[6];?>
<?php $no++; }} ?>
          </td>
      </tr>
      <tr>
      	<td colspan="7"></td>
      	<td align="right"><a href="laporan_laundry-an.php?awal=<?php echo $dari ?>&sampai=<?php echo $sampai ?>" class="btn btn-success" target="blank"><span class="fa fa-print"> Cetak</span></a></td>
      </tr>
    </tbody>
</table>
</div>
</div>
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