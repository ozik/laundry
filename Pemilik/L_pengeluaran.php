<section class="main-content-wrapper">
<section id="main-content" class="animated fadeInUp">
<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">Laporan Data Pengeluaran</h3>
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
            <th>Nama Karyawan</th>
            <th>Jenis Pengeluaran</th>
            <th>Nama</th>
            <th>Tanggal</th>
            <th>Biaya</th>
      </tr>
    </thead>
    <tbody>
<?php 
if(isset($_POST['cari'])){
$dari=$_POST['awal'];
$sampai=$_POST['sampai'];
$query = mysqli_query($koneksi,"SELECT tb_karyawan.Nama,tb_pengeluaran.Jenis,tb_pengeluaran.kegunaan,tb_pengeluaran.Tgl,tb_pengeluaran.Biaya FROM tb_pengeluaran INNER JOIN tb_karyawan on tb_pengeluaran.Id_karyawan=tb_karyawan.Id_karyawan where tb_pengeluaran.Tgl between '$dari' and '$sampai'and tb_pengeluaran.Jenis !='Ambil Bahan-Baku' " );
$no = 1;
while($data =mysqli_fetch_row($query)){	
?>
      <tr>
          <td><?php echo $no ?></td>
          <td><?php echo $data[0];?></td>
          <td><?php echo $data[1];?></td>
          <td><?php echo $data[2];?></td>
          <td><?php echo $data[3];?></td>
          <td><?php echo $data[4];?>
<?php $no++; } ?>
          </td>
      </tr>
        <tr>
        <td colspan="5">Biaya Total</td>
        <td>
          <?php
          $query = mysqli_query($koneksi,"SELECT Sum(tb_pengeluaran.Biaya) FROM tb_pengeluaran INNER JOIN tb_karyawan on tb_pengeluaran.Id_karyawan=tb_karyawan.Id_karyawan where tb_pengeluaran.Tgl between '$dari' and '$sampai'  and tb_pengeluaran.Jenis!='Ambil Bahan-Baku'");
$no = 1;
while($data =mysqli_fetch_row($query)){ echo $data[0];?>
<?php $no++; }} ?></td>
      <tr>
      	<td colspan="5"></td>
      	<td align="right"><a href="laporan_pengeluaran.php?awal=<?php echo $dari ?>&sampai=<?php echo $sampai ?>" class="btn btn-success" target="blank"><span class="fa fa-print"> Cetak</span></a></td>
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