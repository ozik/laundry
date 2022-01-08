<section class="main-content-wrapper">
<section id="main-content" class="animated fadeInUp">
<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">Data Layanan</h3>
<div class="actions pull-right">
<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#tambah">Tambah</button>
<i class="fa fa-expand"></i>
<i class="fa fa-chevron-down"></i>
</div>
</div>
<!--page body-->
<div class="panel-body">

<!--proses hapus data-->
<?php 
if(isset($_POST['hapus'])){
      $id_layanan=$_POST['id_layanan'];
     if(mysqli_query($koneksi,"DELETE FROM tb_layanan WHERE Id_layanan='$id_layanan';")){
      echo ('<div class="alert alert-success alert-dismissable">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <strong>Data berhasil Dihapus</strong>
                          </div>');
    }else {
      echo('<div class="alert alert-danger alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <strong>SQL Error ! </strong>"' . mysqli_error($koneksi). 
              '</div>');
    }
  }
?>
<!--end proses hapus data-->

<!--proses tambah data-->
<?php 
if(isset($_POST['simpan'])){
      $Id_layanan=$_POST['Id_layanan'];
      $Nama=$_POST['Nama'];
      $Jenis=$_POST['Jenis'];
      $Satuan=$_POST['Satuan'];
      $Harga=$_POST['Harga'];
      $Waktu=$_POST['Waktu'];
      if(mysqli_query($koneksi,"INSERT INTO tb_layanan VALUES ('$Id_layanan','$Nama','$Jenis','$Satuan',$Harga,$Waktu);")){
          echo ('<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>Data berhasil disimpan</strong>
                </div>');
              }else {
                  echo('<div class="alert alert-danger alert-dismissable">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                         <strong>SQL Error ! </strong>"' . mysqli_error($koneksi). 
                          '</div>');
                }
              
} 
?>
<!--end proses tambah data-->

 <!--proses edit data-->
<?php 
if(isset($_POST['edit'])){
      $Id_layanan=$_POST['Id_layanan'];
      $Nama=$_POST['Nama'];
      $Jenis=$_POST['Jenis'];
      $Satuan=$_POST['Satuan'];
      $Harga=$_POST['Harga'];
      $Waktu=$_POST['Waktu'];
        if(mysqli_query($koneksi,"UPDATE tb_layanan SET Nama='$Nama',Jenis='$Jenis',Satuan='$Satuan',Harga=$Harga,Waktu=$Waktu WHERE Id_layanan='$Id_layanan';")){
                            echo ('<div class="alert alert-success alert-dismissable">
                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                  <strong>Data berhasil disimpan</strong>
                                  </div>');
                        }else {
                            echo('<div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                   <strong>SQL Error ! </strong>"' . mysqli_error($koneksi). 
                                    '</div>');
                          }
} 
?>
<!--end proses edit data-->

<!--tampil data-->
<div class="table-responsive">
<table id="tabel_data" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
      <tr>
            <th>No</th>
            <th>Nama Layanan</th>
            <th>Jenis layanan</th>
            <th>Satuan</th>
            <th>Harga/Satuan</th>
            <th>Waktu pengerjaan/Hari</th>
            <th>Action</th>
      </tr>
    </thead>
    <tbody>
<?php 
$query = mysqli_query($koneksi,"SELECT * FROM tb_layanan");
$no = 1;
while($data = mysqli_fetch_array($query)){
?>
      <tr>
          <td><?php echo $no ?></td>
          <td><?php echo $data["Nama"];?></td>
          <td><?php echo $data["Jenis"];?></td>
          <td><?php echo $data["Satuan"];?></td>
          <td><?php echo $data["Harga"];?></td>
          <td><?php echo $data["Waktu"];?></td>
          <td align="center">
              <a id="btn_edit" data-toggle="modal" data-target="#form_edit" data-id_layanan="<?php echo $data["Id_layanan"];?>" data-nama="<?php echo $data["Nama"];?>" data-jenis="<?php echo $data["Jenis"];?>" data-Satuan="<?php echo $data["Satuan"];?>" data-harga="<?php echo $data["Harga"];?>" data-waktu="<?php echo $data["Waktu"];?>" >
                          <button type="button" class="btn btn-warning  btn-trans btn-xs" title="Edit">
                              <i class="fa fa-pencil"></i> 
                          </button>
               </a>
               <a id="btn_hapus" data-toggle="modal" data-target="#form_hapus" data-id_layanan="<?php echo $data["Id_layanan"];?>" data-nama="<?php echo $data["Nama"];?>" >
                          <button type="button" class="btn btn-danger  btn-trans btn-xs" title="Hapus"> 
                              <i class="fa fa-trash-o"></i> 
                          </button>
               </a> 
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

<!--popup tambah--> 
<?php
$query = mysqli_query($koneksi,'SELECT max(Id_layanan) as maxId FROM tb_layanan');
$data = mysqli_fetch_array($query);
$id = $data['maxId'];
$noUrut = (int) substr($id, 3, 3);
$noUrut++;
$char = "LY-";
$id = $char . sprintf("%03s", $noUrut);
?>
 <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Tambah Data Layanan</h4>
                </div>
                <div class="modal-body modal-scroll">
                    <form class="form-horizontal" role="form" method="post" action="">
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="Id_layanan">ID Layanan</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="Id_layanan" id="Id_layanan" value="<?php echo($id)?>" title="Id terisi otomatis" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label"  for="Jenis">Nama layanan</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control hurufSaja" minlength="5" name="Nama" id="Nama" placeholder="Nama layanan" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label"  for="Jenis">Jenis layanan</label>
                              <div class="col-sm-8">
                                <select class="form-control  input-sm" name="Jenis" required>
                                     <option>Pilih jenis layanan</option>
                                     <option value="Reguler" >Reguler</option>
                                     <option value="Express">Express</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label"  for="Satuan">Satuan</label>
                              <div class="col-sm-8">
                                <select class="form-control  input-sm" name="Satuan" required>
                                     <option>Pilih Satuan</option>
                                     <option value="Kg" >Kilogram</option>
                                     <option value="Unit">Unit</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label"  for="Harga">Harga</label>
                              <div class="col-sm-8"> 
                                <input type="text" class="form-control angkaSaja" maxlength="10" name="Harga" id="Harga" placeholder="Harga per satuan" required>
                              </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label"  for="Waktu">Waktu pengerjaan</label>
                            <div class="col-sm-8">
                                 <input type="text" class="form-control angkaSaja" maxlength="2" name="Waktu" id="Waktu" placeholder="Dalam bentuk hari pengerjaan" required>
                            </div>
                        </div>                
                        <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Batal</button>
                    <button type="reset" class="btn btn-danger btn-sm">Reset</button>
                    <input type="submit" class="btn btn-info btn-sm" name="simpan" value="Simpan">
                </div>
                </form>
            </div>

        </div>
    </div>
</div> 
<!--end popup tambah-->  

<!--popup edit--> 
 <div class="modal fade" id="form_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Edit Data Layanan</h4>
                </div>
                <div class="modal-body modal-scroll" id="modal_edit">
                    <form class="form-horizontal" role="form" method="post" action="">
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="id_layanan">ID Layanan</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="Id_layanan" id="id_layanan" title="Id tidak dapat diedit" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label"  for="Nama">Nama layanan</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control hurufSaja" minlength="5" name="Nama" id="nama" placeholder="Nama layanan" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label"  for="Jenis">Jenis layanan</label>
                              <div class="col-sm-8">
                                <select class="form-control  input-sm" name="Jenis" id="jenis" required>
                                     <option>Pilih jenis layanan</option>
                                     <option value="Reguler" >Reguler</option>
                                     <option value="Express">Express</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label"  for="Satuan">Satuan</label>
                              <div class="col-sm-8">
                                <select class="form-control  input-sm" name="Satuan" id="satuan" required>
                                     <option>Pilih Satuan</option>
                                     <option value="Kg" >Kilogram</option>
                                     <option value="Unit">Unit</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label"  for="Harga">Harga</label>
                              <div class="col-sm-8"> 
                                <input type="text" class="form-control angkaSaja" maxlength="10" name="Harga" id="Harga" placeholder="Harga per satuan" required>
                              </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label"  for="Waktu">Waktu pengerjaan</label>
                            <div class="col-sm-8">
                                 <input type="text" class="form-control angkaSaja" maxlength="2" name="Waktu" id="Waktu" placeholder="Dalam bentuk hari pengerjaan" required>
                            </div>
                        </div>                
                        <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Batal</button>
                    <input type="submit" class="btn btn-info btn-sm" name="edit" value="Simpan">
                </div>
                </form>
            </div>
        </div>
    </div>
<script type="text/javascript">
$(document).on('click', '#btn_edit', function(){
  var id_layanan = $(this).data('id_layanan');
  var nama = $(this).data('nama');
  var jenis = $(this).data('jenis');
  var satuan = $(this).data('satuan');
  var harga = $(this).data('harga');
  var waktu = $(this).data('waktu');

  $("#modal_edit #id_layanan").val(id_layanan);
  $("#modal_edit #nama").val(nama);
  $("#modal_edit #jenis").val(jenis);
  $("#modal_edit #satuan").val(satuan);
  $("#modal_edit #Harga").val(harga);
  $("#modal_edit #Waktu").val(waktu);

  } );
</script>
</div> 
<!--end popup edit-->  

<!--popup hapus--> 
 <div class="modal fade" id="form_hapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Hapus data</h4>
                </div>
                <div class="modal-body" id="modal_hapus">
                    <form class="form-horizontal" role="form" method="post" action="">
                   <input type="hidden" class="form-control" name="id_layanan" id="id_layanan">
                 <p id="nama"></p>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Batal</button>
                    <input type="submit" class="btn btn-danger btn-sm" name="hapus" value="Hapus">
                </div>
              </form>
            </div>
        </div>
      </div>
<script type="text/javascript">
$(document).on('click', '#btn_hapus', function(){
  var id_layanan = $(this).data('id_layanan');
  var nama = $(this).data('nama');
  $("#modal_hapus #id_layanan").val(id_layanan);
  $("#modal_hapus #nama").html("Benar ingin menghapus data Jenis Layanan <b> "+nama+" </b>  ?");
  } );
</script>
</div> 
<!--end popup hapus-->  
</section>