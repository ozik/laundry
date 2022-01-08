
 <section class="main-content-wrapper">
            <section id="main-content" class="animated fadeInUp">
                <div class="row">
                    <div class="col-md-3">
                                <div class="panel panel-solid-success widget-mini">
                                    <div class="panel-body">
<?php 
$bln = date("m");
$query = mysqli_query($koneksi,"SELECT SUM(Total_harga) FROM tb_order WHERE MONTH(Tgl_masuk)='$bln'");
while ($data=mysqli_fetch_row($query)){
    $pendapatan=$data[0];
}
if (empty($pendapatan)) {
    $pendapatan=0;
}
 ?>
                                        <i class="fa   fa-sign-in"></i>
                                        <span class="total text-center"><?php echo $pendapatan ?></span>
                                        <span class="title text-center">Pendapatan Bualan Ini</span>
                                    </div>
                                </div>
                                <div class="panel panel-solid-danger widget-mini">
                                    <div class="panel-body">
<?php 
$bln = date("m");
$query = mysqli_query($koneksi,"SELECT SUM(Biaya) FROM tb_pengeluaran WHERE MONTH(Tgl)='$bln'");
while ($data=mysqli_fetch_row($query)){ 
$pengeluaran=$data[0];
}
if (empty($pengeluaran)) {
    $pengeluaran=0;
}
 ?>
                                        <i class="fa  fa-sign-out"></i>
                                        <span class="total text-center"><?php echo $pengeluaran ?></span>
                                        <span class="title text-center">Pengeluaran Bualan Ini</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
<div class="col-md-6">
                            <div class="panel panel-solid-primary widget-mini">
                             <div class="panel-heading">
                                <h3 class="panel-title">Biaya pengeluaran Terahir</h3>
                            </div>
                                    <div class="panel-body">
<div class="table-responsive">
<table class="table" cellspacing="0" width="100%">
    <thead>
      <tr>
            <th>Tanggal</th>
            <th>Kegunaan</th>
            <th>Biaya</th>
      </tr>
    </thead>
    <tbody>
<?php 
$query = mysqli_query($koneksi,"SELECT Tgl,kegunaan,Biaya FROM tb_pengeluaran WHERE Jenis='Biaya Operasional' ORDER BY Tgl
DESC LIMIT 5");
while ($data=mysqli_fetch_row($query)) {
?>
      <tr>
          <td><?php echo $data[0];?></td>
          <td><?php echo $data[1];?></td>
          <td><?php echo $data[2]; }?></td>
      </tr>
    </tbody>
</table>
<!--end tampil data-->
<!--tag template-->
</div>
                                    </div>
                                </div>
                            </div>
<div class="col-md-6">
                            <div class="panel panel-solid-default widget-mini">
                             <div class="panel-heading">
                                <h3 class="panel-title">Pembelian bahan baku Terahir</h3>
                            </div>
                                    <div class="panel-body">
<div class="table-responsive">
<table class="table" cellspacing="0" width="100%">
    <thead>
      <tr>
            <th>Tanggal</th>
            <th>Nama BB</th>
            <th>Jumlah</th>
            <th>Biaya</th>
      </tr>
    </thead>
    <tbody>
<?php 
$query = mysqli_query($koneksi,"SELECT Tgl,kegunaan,Jumlah,Biaya FROM tb_pengeluaran WHERE Jenis='Pembelian Bahan Baku' ORDER BY Tgl
DESC LIMIT 5");
while ($data=mysqli_fetch_row($query)) {
?>
      <tr>
          <td><?php echo $data[0];?></td>
          <td><?php echo $data[1];?></td>
          <td><?php echo $data[2];?></td>
          <td><?php echo $data[3]; }?></td>
      </tr>
    </tbody>
</table>
<!--end tampil data-->
<!--tag template-->
</div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                </section>
        </section>
    </div>