<section class="main-content-wrapper">
<section id="main-content" class="animated fadeInUp">
<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">Data Bahan-Baku</h3>
<div class="actions pull-right">
<i class="fa fa-expand"></i>
<i class="fa fa-chevron-down"></i>
</div>
</div>
<!--page body-->
<div class="panel-body">

 <!--proses ambil bb-->
<?php 
if(isset($_POST['ambil'])){
      $id_bb=$_POST['id_bb'];
      $nama=$_POST['nama'];
      $ambil_stok=$_POST['ambil_stok'];
      $stok=$_POST['stok'];
      $sisa=$stok-$ambil_stok;
      $tgl=$_POST['tgl'];
      $tgl=date("Ymd",strtotime($tgl));
        if(mysqli_query($koneksi,"UPDATE tb_bb SET Stok=$sisa WHERE Id_bb='$id_bb';")){
         if(mysqli_query($koneksi,"INSERT INTO `tb_pengeluaran`(`Id_pengeluaran`, `Jenis`, `kegunaan`,`Jumlah`,`Biaya`, `Tgl`, `Id_karyawan`,`Id_bb`) VALUES ('','Ambil Bahan-Baku',' $nama', $ambil_stok,'',$tgl,'$id_karyawan','$id_bb')"));
                            echo ('<div class="alert alert-success alert-dismissable">
                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                  Berhasil Ambil bahan-baku
                                  </div>');
                        }else {
                            echo('<div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                   <strong>SQL Error ! </strong>"' . mysqli_error($koneksi). 
                                    '</div>');
                          }
} 
?>
<!--end proses ambil bb-->

<!--tampil data-->
<div class="table-responsive">
<table id="tabel_data" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
      <tr>
            <th>No</th>
            <th>Id Bahan-Baku</th>
            <th>Nama Bahan-baku</th>
            <th>Stok</th>
            <th>Action</th>
      </tr>
    </thead>
    <tbody>
<?php 
$query = mysqli_query($koneksi,"SELECT * FROM tb_bb");
$no = 1;
while ($data=mysqli_fetch_row($query)) {
?>
      <tr>
          <td><?php echo $no ?></td>
          <td><?php echo $data[0];?></td>
          <td><?php echo $data[1];?></td>
          <td><?php echo $data[2];?></td>
           <td align="center">
               <a id="btn_ambil" data-toggle="modal" data-target="#form_ambil" data-id_bb="<?php echo $data[0];?>" data-nama="<?php echo $data[1];?>" data-stok="<?php echo $data[2];?>" >
                          <button type="button" class="btn btn-danger  btn-trans btn-xs" title="Ambil Bahan-baku"> 
                              <i class="fa  fa-minus-circle"></i> 
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

<!--popup edit--> 
 <div class="modal fade" id="form_ambil" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Ambil Bahan-baku</h4>
                </div>
                <div class="modal-body modal-scroll" id="modal_ambil_bb">
                    <form class="form-horizontal" role="form" method="post" action="">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">ID BB</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="id_bb" id="id_bb" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Nama BB</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama" id="nama" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Tanggal</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="tgl" value="<?php echo date('m/d/Y'); ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label"  for="ambil_stok">Jumlah</label>
                            <div class="col-sm-2">
                                 <input type="text" class="form-control" id="stok" name="stok" readonly>
                            </div>
                            <div class="col-sm-6">
                                 <input type="text" class="form-control" id="ambil_stok" name="ambil_stok" placeholder="Ambil Jumlah Bahan-baku" required>
                                 <label id="pesan"></label>
                            </div>
                        </div>                
                        <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Batal</button>
                    <input type="submit" class="btn btn-info btn-sm" name="ambil" id="Ambil" value="Ambil">
                </div>
                </form>
            </div>
        </div>
    </div>
<script type="text/javascript">
var stok;
$(document).on('click', '#btn_ambil', function(){
  var id_bb = $(this).data('id_bb');
  var nama = $(this).data('nama');
  stok = $(this).data('stok');
  $("#modal_ambil_bb #id_bb").val(id_bb);
  $("#modal_ambil_bb #nama").val(nama);
  $("#modal_ambil_bb #stok").val(stok);

  } );
  $(document).ready(function(){
          $("#ambil_stok").keyup(function(data){
             var isi = $("#ambil_stok").val();
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesan").html("isikan angka").show().fadeOut("slow").addClass("error");
                $("#Ambil").prop('disabled', true);
             }else{
                $("#Ambil").prop('disabled', false);
             }
             if( isi>stok || stok== 0){
                $("#pesan").html("jumlah melebihi stok").show().fadeOut("slow").addClass("error");
                $("#Ambil").prop('disabled', true);
                             }
        });
    });
</script>
</div> 
<!--end popup edit-->  

</section>