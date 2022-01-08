 <section class="main-content-wrapper">
            <section id="main-content" class="animated fadeInUp">
                <div class="row">
                    <div class="col-md-6">
                        <div class="col-md-6">
                                <div class="panel panel-solid-info widget-mini">
                                    <div class="panel-body">
<?php 
$query = mysqli_query($koneksi,"SELECT COUNT(Id_order) FROM tb_detail_order WHERE Status!='Selesai' and Status!='Diambil'");
while ($data=mysqli_fetch_row($query)){ ?>
                                        <i class="fa  fa-clock-o"></i>
                                        <span class="total text-center"><?php echo $data[0];} ?></span>
                                        <span class="title text-center">Order dalam Proses</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="panel panel-solid-success widget-mini">
                                    <div class="panel-body">
<?php 
$query = mysqli_query($koneksi,"SELECT COUNT(Id_order) FROM tb_detail_order WHERE  Status ='Selesai'");
while ($data=mysqli_fetch_row($query)){ ?>
                                        <i class="fa fa-check"></i>
                                        <span class="total text-center"><?php echo $data[0];} ?></span>
                                        <span class="title text-center">Order selesai</span>
                                    </div>
                                </div>
                            </div>
                                 <div class="col-md-6">
                                <div class="panel panel-solid-warning widget-mini">
                                    <div class="panel-body">
<?php 
$query = mysqli_query($koneksi,"SELECT COUNT(Id_order) FROM tb_detail_order WHERE Status='Selesai' and Status!='Diambil'");
while ($data=mysqli_fetch_row($query)){ ?>
                                        <i class="fa fa-shopping-cart"></i>
                                        <span class="total text-center"><?php echo $data[0];} ?></span>
                                        <span class="title text-center">Order Belum Diambil</span>
                                    </div>
                                </div>
                            </div>
                              <div class="col-md-6">
                                <div class="panel panel-solid-danger widget-mini">
                                    <div class="panel-body">
<?php 
$query = mysqli_query($koneksi,"SELECT COUNT(Id_order) FROM tb_detail_order WHERE Estimasi=CURDATE()");
while ($data=mysqli_fetch_row($query)){ ?>
                                        <i class="fa fa-calendar-o"></i>
                                        <span class="total text-center"><?php echo $data[0];} ?></span>
                                        <span class="title text-center">Order Waktu habis</span>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="panel panel-solid-default widget-mini">
                             <div class="panel-heading">
                                <h3 class="panel-title">Stok bahan baku</h3>
                            </div>
                                    <div class="panel-body">
<div class="table-responsive">
<table class="table" cellspacing="0" width="100%">
    <thead>
      <tr>
            <th>Nama Bahan-baku</th>
            <th>Stok</th>
      </tr>
    </thead>
    <tbody>
<?php 
$query = mysqli_query($koneksi,"SELECT Nama,Stok FROM tb_bb");
while ($data=mysqli_fetch_row($query)) {
?>
      <tr>
          <td><?php echo $data[0];?></td>
          <td><?php echo $data[1]; }?></td>
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
                </section>
        </section>
    </div>