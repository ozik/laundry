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
      $id_pelanggan=$_POST['id_pelanggan'];
     if(mysqli_query($koneksi,"DELETE FROM tb_pelanggan WHERE Id_pelanggan='$id_pelanggan';")){
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
      $id_pelanggan=$_POST['id_pelanggan'];
      $nama=$_POST['nama'];
      $alamat=$_POST['alamat'];
      $jk=$_POST['jk'];
      $no_telp=$_POST['no_telp'];
      if(mysqli_query($koneksi,"INSERT INTO tb_pelanggan VALUES ('$id_pelanggan','$nama','$alamat','$jk','$no_telp');")){
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
      $id_pelanggan=$_POST['id_pelanggan'];
      $Nama=$_POST['nama'];
      $alamat=$_POST['alamat'];
      $jk=$_POST['jk'];
      $no_telp=$_POST['no_telp'];
        if(mysqli_query($koneksi,"UPDATE tb_pelanggan SET Nama='$Nama',Alamat='$alamat',Jk='$jk',No_telp='$no_telp' WHERE Id_pelanggan='$id_pelanggan';")){
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
            <th>Nama</th>
            <th>Alamat</th>
            <th>Jenis kelamin</th>
            <th>No telp</th>
            <th>Action</th>
      </tr>
    </thead>
    <tbody>
<?php 
$query = mysqli_query($koneksi,"SELECT * FROM tb_pelanggan");
$no = 1;
while($data = mysqli_fetch_array($query)){
?>
      <tr>
          <td><?php echo $no ?></td>
          <td><?php echo $data["Nama"];?></td>
          <td><?php echo $data["Alamat"];?></td>
          <td><?php echo $data["Jk"];?></td>
          <td><?php echo $data["No_telp"];?></td>
          <td align="center">
              <a id="btn_edit" data-toggle="modal" data-target="#form_edit" data-id_pelanggan="<?php echo $data["Id_pelanggan"];?>" data-nama="<?php echo $data["Nama"];?>" data-alamat="<?php echo $data["Alamat"];?>" data-jk="<?php echo $data["Jk"];?>" data-no_telp="<?php echo $data["No_telp"];?>" >
                          <button type="button" class="btn btn-warning  btn-trans btn-xs" title="Edit">
                              <i class="fa fa-pencil"></i> 
                          </button>
               </a>
               <a id="btn_hapus" data-toggle="modal" data-target="#form_hapus" data-id_pelanggan="<?php echo $data["Id_pelanggan"];?>" data-nama="<?php echo $data["Nama"];?>" >
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
$query = mysqli_query($koneksi,'SELECT max(Id_pelanggan) as maxId FROM tb_pelanggan');
$data = mysqli_fetch_array($query);
$id = $data['maxId'];
$noUrut = (int) substr($id, 3, 3);
$noUrut++;
$char = "PG-";
$id = $char . sprintf("%03s", $noUrut);
?>
 <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Tambah Data Pelanggan</h4>
                </div>
                <div class="modal-body modal-scroll">
                    <form class="form-horizontal" role="form" method="post" action="">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="id_pelanggan">ID Pelanggan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="id_pelanggan" id="id_pelanggan" value="<?php echo($id)?>" title="Id terisi otomatis" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"  for="nama">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control hurufSaja" minlength="3" name="nama" id="nama" placeholder="Nama" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"  for="alamat">Alamat</label>
                            <div class="col-sm-9">
                                <textarea class="form-control hurufSpesial" minlength="6" name="alamat" id="alamat" placeholder="Alamat" required></textarea>
                            </div>
                        </div>
                         <div class="form-group">
                             <label class="col-sm-3 control-label" for="jk">Jenis Kelamin</label>
                             <div class="col-sm-9">
                                 <label class="radio-inline">
                                      <input class="icheck" type="radio" name="jk" value="Laki-laki" required>Laki-laki</label>
                                 <label class="radio-inline">
                                      <input class="icheck" type="radio" name="jk" value="Perempuan" required>Perempuan</label>
                             </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"  for="no_telp">No telp</label>
                            <div class="col-sm-9">
                                 <input type="text" class="form-control angkaSaja" name="no_telp" maxlength="12" id="no_telp" placeholder="082123456789"  required>
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
                    <h4 class="modal-title" id="myModalLabel">Edit Data Pelanggan</h4>
                </div>
                <div class="modal-body modal-scroll" id="modal_edit">
                    <form class="form-horizontal" role="form" method="post" action="">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="id_pelanggan">ID Pelanggan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="id_pelanggan" id="id_pelanggan" title="Id tidak dapat diedit" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"  for="nama">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control hurufSaja" minlength="3" name="nama" id="nama" placeholder="Nama pelanggan" required>
                            </div>
                        </div>
                       <div class="form-group">
                            <label class="col-sm-3 control-label"  for="alamat">Alamat</label>
                            <div class="col-sm-9">
                                <textarea class="form-control hurufSpesial" minlength="6" name="alamat" id="alamat" placeholder="Alamat" required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                             <label class="col-sm-3 control-label" for="jk">Jenis Kelamin</label>
                             <div class="col-sm-9">
                                 <label class="radio-inline">
                                      <input class="icheck" type="radio" name="jk" value="Laki-laki" id="Laki-laki" required>Laki-laki</label>
                                 <label class="radio-inline">
                                      <input class="icheck" type="radio" name="jk" value="Perempuan" id="Perempuan" required>Perempuan</label>
                             </div>
                        </div>
                         <div class="form-group">
                            <label class="col-sm-3 control-label"  for="no_telp">No telp</label>
                            <div class="col-sm-9">
                                 <input type="text" class="form-control angkaSaja" maxlength="12" name="no_telp" id="no_telp" placeholder="082123456789" required>
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
  var id_pelanggan = $(this).data('id_pelanggan');
  var nama = $(this).data('nama');
  var alamat = $(this).data('alamat');
  var jk = $(this).data('jk');
  var no_telp = $(this).data('no_telp');

  $("#modal_edit #id_pelanggan").val(id_pelanggan);
  $("#modal_edit #nama").val(nama);
  $("#modal_edit #alamat").val(alamat);
  $("#modal_edit #no_telp").val(no_telp);
  if(jk=="Laki-laki"){
        $("#Laki-laki").prop("checked", true);
    }else{
      $("#Perempuan").prop("checked", true);
    };
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
                   <input type="hidden" class="form-control" name="id_pelanggan" id="id_pelanggan">
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
  var id_pelanggan = $(this).data('id_pelanggan');
  var nama = $(this).data('nama');
  $("#modal_hapus #id_pelanggan").val(id_pelanggan);
  $("#modal_hapus #nama").html("Benar ingin menghapus data atas nama <b> "+nama+" </b>  ?");
  } );
</script>
</div> 
<!--end popup hapus-->  
</section>