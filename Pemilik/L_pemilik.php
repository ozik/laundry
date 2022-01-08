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
            <th>Nama</th>
            <th>Alamat</th>
            <th>Jenis Kelamin</th>
            <th>Tgl Lahir</th>
            <th>No Telp</th>
      </tr>
    </thead>
    <tbody>
<?php 
$query = mysqli_query($koneksi,"SELECT * FROM tb_pemilik");
$no = 1;
while($data = mysqli_fetch_array($query)){	
?>
      <tr>
          <td><?php echo $no ?></td>
          <td><?php echo $data["Nama"];?></td>
          <td><?php echo $data["Alamat"];?></td>
          <td><?php echo $data["Jk"];?></td>
          <td><?php echo $data["Tgl_lahir"];?></td>
          <td><?php echo $data["No_telp"];?>
<?php $no++; }?>
          </td>
      </tr>
      <tr>
      	<td colspan="5"></td>
      	<td align="right"><a href="laporan_pemilik.php" class="btn btn-success"><span class="fa fa-print"> Cetak</span></a></td>
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