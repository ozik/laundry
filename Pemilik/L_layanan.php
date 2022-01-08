<section class="main-content-wrapper">
<section id="main-content" class="animated fadeInUp">
<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">Laporan data pemilik</h3>
<div class="actions pull-right">
<i class="fa fa-chevron-down"></i>
</div>
</div>
<!--page body-->
<div class="panel-body">
<!--tampil data-->
<div class="row">
<div class="col-lg-12">
<div class="table-responsive">
<table class="table table-hover">
    <thead>
      <tr>
            <th>No</th>
            <th>Id Layanan</th>
            <th>Nama Layanan</th>
            <th>Jenis Layanan</th>
            <th>Satuan</th>
            <th>Harga</th>
            <th>Waktu Pengerjaan</th>
      </tr>
    </thead>
    <tbody>
<?php 
$query = mysqli_query($koneksi,"SELECT * FROM tb_layanan");
$no = 1;
while($data = mysqli_fetch_row($query)){	
?>
      <tr>
          <td><?php echo $no ?></td>
          <td><?php echo $data[0];?></td>
          <td><?php echo $data[1];?></td>
          <td><?php echo $data[2];?></td>
          <td><?php echo $data[3];?></td>
          <td><?php echo $data[4];?></td>
          <td align="center"><?php echo $data[5];?>
<?php $no++; }?>
          </td>
      </tr>
      <tr>
      	<td colspan="6"></td>
      	<td align="right"><a href="laporan_layanan.php" class="btn btn-success"><span class="fa fa-print"> Cetak</span></a></td>
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