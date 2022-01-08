<section class="main-content-wrapper">
<section id="main-content" class="animated fadeInUp">
<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">Laporan data Bahan baku</h3>
<div class="actions pull-right">
<i class="fa fa-chevron-down"></i>
</div>
</div>
<!--page body-->
<div class="panel-body">
<!--tampil data-->
<div class="row">
<div class="col-lg-12">
                <div class="tab-wrapper tab-left">
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#transaksi" data-toggle="tab">Transaksi Bahan baku</a>
                    </li>
                    <li > <a href="#Stok" data-toggle="tab"> Stok Bahan baku</a>
                    </li>
                  </ul>
                    <div class="tab-content">
                    <div class="tab-pane" id="Stok">
                     <div class="table-responsive">
<table class="table table-hover">
    <thead>
      <tr>
            <th>No</th>
            <th>Id Bahan Baku</th>
            <th>Bahan baku </th>
            <th>Stok</th>
      </tr>
    </thead>
    <tbody>
<?php 
$query = mysqli_query($koneksi,"SELECT * FROM tb_bb");
$no = 1;
while($data = mysqli_fetch_row($query)){  
?>
      <tr>
          <td><?php echo $no ?></td>
          <td><?php echo $data[0];?></td>
          <td><?php echo $data[1];?></td>
          <td><?php echo $data[2];?>
<?php $no++; }?>
          </td>
      </tr>
      <tr>
        <td colspan="3"></td>
        <td align="right"><a href="laporan_bb.php" class="btn btn-success"><span class="fa fa-print"> Cetak</span></a></td>
      </tr>
    </tbody>
</table>
</div>
                    </div>
                    <div class="tab-pane active" id="transaksi">
 <div class="table-responsive">
<table class="table table-hover">
    <thead>
      <tr>
            <th>No</th>
            <th>Nama Karyawan</th>
            <th>Jenis Transaksi</th>
            <th>Bahan baku</th>
            <th>Jumlah</th>
            <th>Tanggal</th>
      </tr>
    </thead>
    <tbody>
<?php 
$tgl=date('m');
$query = mysqli_query($koneksi,"SELECT tb_karyawan.Nama,tb_pengeluaran.Jenis,tb_pengeluaran.kegunaan,tb_pengeluaran.Jumlah,tb_pengeluaran.Tgl,tb_pengeluaran.Biaya FROM tb_pengeluaran INNER JOIN tb_karyawan on tb_pengeluaran.Id_karyawan=tb_karyawan.Id_karyawan where  month(tb_pengeluaran.Tgl)='$tgl' and tb_pengeluaran.Jenis !='Biaya Operasional' " );
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
<?php $no++; }?>
          </td>
      </tr>
      <tr>
        <td colspan="5"></td>
        <td align="right"><a href="laporan_transaksi_bb.php" class="btn btn-success" target="blank"><span class="fa fa-print"> Cetak</span></a></td>
      </tr>
    </tbody>
</table>
</div>
                    </div>
                    </div>
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