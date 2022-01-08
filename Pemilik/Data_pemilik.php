<section class="main-content-wrapper">
<section id="main-content" class="animated fadeInUp">
<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">Data pemilik</h3>
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
      $id_pemilik=$_POST['id_pemilik'];
       $query = mysqli_query($koneksi,"SELECT Foto FROM tb_pemilik WHERE id_pemilik='$id_pemilik'");
          $data= mysqli_fetch_array($query);
         $fotolama=$data['Foto'];
     if(mysqli_query($koneksi,"DELETE FROM tb_pemilik WHERE id_pemilik='$id_pemilik';")){
         if($fotolama != ''){
             unlink("../assets/img/pemilik/" . $fotolama);
            }
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
      $id_pemilik=$_POST['id_pemilik'];
      $nama=$_POST['nama'];
      $alamat=$_POST['alamat'];
      $jk=$_POST['jk'];
      $tgl_lahir=$_POST['tgl_lahir'];
      $tgl_lahir=date("Ymd",strtotime($tgl_lahir));
      $no_telp=$_POST['no_telp'];
      $username=$_POST['nama'];
      $password=md5($_POST['nama']);
    //upload foto
      $file=$_FILES['foto']['name'];
      $extensi = pathinfo($file, PATHINFO_EXTENSION);
      $foto = $_POST['id_pemilik']."_".date('d-m-Y').".".$extensi;
      $sumber=$_FILES['foto']['tmp_name'];
      $ukuran = $_FILES['foto']['size'];
      if($ukuran <= 2000000){
          if( ($extensi == "jpg") or ($extensi == "png") or ($extensi == "JPG") or ($extensi == "PNG")){
                        if(mysqli_query($koneksi,"INSERT INTO tb_pemilik VALUES ('$id_pemilik','$nama','$alamat','$jk',$tgl_lahir,'$no_telp','$foto','$username','$password');")){
                            $upload =move_uploaded_file($sumber, "../assets/img/pemilik/" .$foto);
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
               }else{
                 echo ('<div class="alert alert-danger alert-dismissable">
                       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                       <strong>Simpan data Gagal ! </strong> Format foto harus jpg atau png.
                       </div>');
               }

      } else if($ukuran >2000000){
            echo ('<div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong>Simpan data Gagal ! </strong> Ukuran foto tidak boleh lebih dari 2MB.
            </div>');
         } 
} 
?>
<!--end proses tambah data-->

 <!--proses edit data-->
<?php 
if(isset($_POST['edit'])){
      $id_pemilik=$_POST['id_pemilik'];
      $nama=$_POST['nama'];
      $alamat=$_POST['alamat'];
      $jk=$_POST['jk'];
      $tgl_lahir=$_POST['tgl_lahir'];
      $tgl_lahir=date("Ymd",strtotime($tgl_lahir));
      $no_telp=$_POST['no_telp'];
    //upload foto
      $file=$_FILES['foto']['name'];
      $extensi = pathinfo($file, PATHINFO_EXTENSION);
      $foto = $_POST['id_pemilik']."_".date('d-m-Y').".".$extensi;
      $sumber=$_FILES['foto']['tmp_name'];
      $ukuran = $_FILES['foto']['size'];
      if($file == ''){
        if(mysqli_query($koneksi,"UPDATE tb_pemilik SET Nama='$nama',alamat='$alamat',Jk='$jk',Tgl_lahir=$tgl_lahir,No_telp='$no_telp' WHERE id_pemilik='$id_pemilik';")){
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
      /**else file = 0 */
      }else{
      $query = mysqli_query($koneksi,"SELECT Foto FROM tb_pemilik WHERE id_pemilik='$id_pemilik'");
          $data= mysqli_fetch_array($query);
         $fotolama=$data['Foto'];
         unlink("../assets/img/pemilik/" . $fotolama);
      if($ukuran <= 2000000){
          if( ($extensi == "jpg") or ($extensi == "png") or ($extensi == "JPG") or ($extensi == "PNG")){
                        if(mysqli_query($koneksi,"UPDATE tb_pemilik SET Nama='$nama',alamat='$alamat',Jk='$jk',Tgl_lahir=$tgl_lahir,No_telp='$no_telp',Foto='$foto' WHERE id_pemilik='$id_pemilik';")){
                            $upload =move_uploaded_file($sumber, "../assets/img/pemilik/" .$foto);
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
            }else{
              echo('<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>Format foto tidak benar !</strong>  foto harus jpg atau png.
                </div>');
           }

      }else {
        echo ('<div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong>Ukuran foto terlalu besar ! </strong>  tidak boleh lebih dari 2MB.
            </div>');
        } 
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
            <th>Jenis Kelamin</th>
            <th>Tgl Lahir</th>
            <th>No Telp</th>
            <th>Action</th>
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
          <td><?php echo $data["No_telp"];?></td>
          <td align="center">
              <a id="btn_detail" data-toggle="modal" data-target="#form_detail" data-id_pemilik="<?php echo $data["Id_pemilik"];?>" data-nama="<?php echo $data["Nama"];?>" data-alamat="<?php echo $data["Alamat"];?>" data-jk="<?php echo $data["Jk"];?>" data-tgl_lahir="<?php echo $data["Tgl_lahir"];?>" data-no_telp="<?php echo $data["No_telp"];?>" data-foto="<?php echo $data["Foto"];?>" >
                          <button type="button" class="btn btn-info btn-trans btn-xs" title="Detail">
                              <i class="fa fa-eye"></i>
                          </button>
              </a>
              <a id="btn_edit" data-toggle="modal" data-target="#form_edit" data-id_pemilik="<?php echo $data["Id_pemilik"];?>" data-nama="<?php echo $data["Nama"];?>" data-alamat="<?php echo $data["Alamat"];?>" data-jk="<?php echo $data["Jk"];?>" data-tgl_lahir="<?php echo $data["Tgl_lahir"];?>" data-no_telp="<?php echo $data["No_telp"];?>" data-foto="<?php echo $data["Foto"];?>" >
                          <button type="button" class="btn btn-warning  btn-trans btn-xs" title="Edit">
                              <i class="fa fa-pencil"></i> 
                          </button>
               </a>
               <a id="btn_hapus" data-toggle="modal" data-target="#form_hapus" data-id_pemilik="<?php echo $data["Id_pemilik"];?>" data-nama="<?php echo $data["Nama"];?>" >
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
$query = mysqli_query($koneksi,'SELECT max(Id_pemilik) as maxId FROM tb_pemilik');
$data = mysqli_fetch_array($query);
$id = $data['maxId'];
$noUrut = (int) substr($id, 3, 3);
$noUrut++;
$char = "PM-";
$id = $char . sprintf("%03s", $noUrut);
?>
 <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Tambah Data Pemilik</h4>
                </div>
                <div class="modal-body modal-scroll">
                    <form class="form-horizontal" role="form" method="post" action="" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="id_pemilik">ID Pemilik</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="id_pemilik" id="id_pemilik" value="<?php echo($id)?>" title="Id terisi otomatis" readonly>
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
                                <textarea class="form-control hurufSpesial" minlength="6"  name="alamat" id="alamat" placeholder="Alamat" required></textarea>
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
                            <label class="col-sm-3 control-label"  for="tgl_lahir">Tanggal Lahir</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" placeholder="Tanggal lahiir" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"  for="no_telp">No telp</label>
                            <div class="col-sm-9">
                                 <input type="text" class="form-control angkaSaja" maxlength="12" name="no_telp" id="no_telp" placeholder="082123456789" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"  for="foto">Foto</label>
                            <div class="col-sm-9">
                                 <input type="file" class="form-control" name="foto" id="foto" onchange="tampil();" required>
                                 <p> * foto maksimal 2Mb</p>
                                 <img id="foto_tampil" width="100px" src="../assets/img/icon-profil.png" class="img-responsive img-thumbnail">
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
                    <h4 class="modal-title" id="myModalLabel">Edit data pemilik</h4>
                </div>
                <div class="modal-body modal-scroll" id="modal_edit">
                    <form class="form-horizontal" role="form" method="post" action="" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="id_pemilik">ID Pemilik</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="id_pemilik" id="id_pemilik"  title="Id tidak dapat diubah" readonly>
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
                                <textarea class="form-control hurufSpesial" minlength="6"  name="alamat" id="alamat" placeholder="Alamat" required></textarea>
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
                            <label class="col-sm-3 control-label"  for="tgl_lahir">Tgl Lahir</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" placeholder="Tanggal lahiir" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"  for="no_telp">No telp</label>
                            <div class="col-sm-9">
                                 <input type="text" class="form-control angkaSaja" maxlength="12" name="no_telp" id="no_telp" placeholder="082123456789" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"  for="foto">Foto</label>
                            <div class="col-sm-9">
                                 <input type="file" class="form-control" name="foto" id="foto" onchange="tampil();">
                                 <p> * foto maksimal 2Mb</p>
                                 <img id="foto_tampil" width="100px" src="" class="img-responsive img-thumbnail">
                            </div>
                        </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Batal</button>
                    <input type="submit" class="btn btn-info btn-sm" name="edit" value="Simpan">
                </div>
                </form>
            </div>
        </div>
    </div>
<script type="text/javascript">
$(document).on('click', '#btn_edit', function(){
  var id_pemilik = $(this).data('id_pemilik');
  var nama = $(this).data('nama');
  var alamat = $(this).data('alamat');
  var jk = $(this).data('jk');
  var tgl_lahir = $(this).data('tgl_lahir');
  var no_telp = $(this).data('no_telp');
  var foto = $(this).data('foto');

  $("#modal_edit #id_pemilik").val(id_pemilik);
  $("#modal_edit #nama").val(nama);
  $("#modal_edit #alamat").val(alamat);
  $("#modal_edit #tgl_lahir").val(tgl_lahir);
  $("#modal_edit #no_telp").val(no_telp);
  $("#modal_edit #foto_tampil").attr("src", "../assets/img/pemilik/"+foto);
  if(jk=="Laki-laki"){
        $("#Laki-laki").prop("checked", true);
    }else{
      $("#Perempuan").prop("checked", true);
    };
  } );
</script>
</div> 
<!--end popup edit-->  


<!--popup detail--> 
 <div class="modal fade" id="form_detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Detail Data Karyawan</h4>
                </div>
                <div class="modal-body" id="modal_detail">
                  <table class="table table-striped">
                  <tr>
                  <td>ID Karyawan</td>
                  <td><p id="id_pemilik"></p></td>
                  <td rowspan="6" align="center"><img src="" id="foto" width="150px" class="img-responsive img-thumbnail"></td> 
                  </tr>  
                  <tr>
                    <td>Nama</td>
                    <td><p id="nama"></p></td> 
                  </tr>  
                  <tr>
                    <td>Alamat</td>
                    <td><p id="alamat"></p></td> 
                  </tr>  
                  <tr>
                    <td>Jenis Kelamin</td>
                    <td><p id="jk"></p></td> 
                  </tr>  
                  <tr>
                    <td>Tanggal Lahir</td>
                    <td><p id="tgl_lahir"></p></td> 
                  </tr>  
                  <tr>
                    <td>No Telphon</td>
                    <td><p id="no_telp"></p></td> 
                  </tr>           
                  </table>
                <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">tutup</button>
                </div>
            </div>
        </div>
      </div>
<script type="text/javascript">
$(document).on('click', '#btn_detail', function(){
  var id_pemilik = $(this).data('id_pemilik');
  var nama = $(this).data('nama');
  var alamat = $(this).data('alamat');
  var jk = $(this).data('jk');
  var tgl_lahir = $(this).data('tgl_lahir');
  var no_telp = $(this).data('no_telp');
  var foto = $(this).data('foto');

  $("#modal_detail #id_pemilik").html(id_pemilik);
  $("#modal_detail #nama").html(nama);
  $("#modal_detail #alamat").html(alamat);
  $("#modal_detail #jk").html(jk);
  $("#modal_detail #tgl_lahir").html(tgl_lahir);
  $("#modal_detail #no_telp").html(no_telp);
  $("#modal_detail #foto").attr("src", "../assets/img/pemilik/"+foto);
  } );
</script>
</div> 
<!--end popup detail-->   

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
                   <input type="hidden" class="form-control" name="id_pemilik" id="id_pemilik">
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
  var id_pemilik = $(this).data('id_pemilik');
  var nama = $(this).data('nama');
  $("#modal_hapus #id_pemilik").val(id_pemilik);
  $("#modal_hapus #nama").html("Benar ingin menghapus data atas nama <b> "+nama+" </b>  ?");
  } );
</script>
</div> 
<!--end popup hapus-->  


<script type="text/javascript">
function tampil() {
    document.getElementById("foto_tampil").style.display = "block";
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("foto").files[0]);

    oFReader.onload = function(oFREvent) {
      document.getElementById("foto_tampil").src = oFREvent.target.result;
    };
};
</script>

</section>