<section class="main-content-wrapper">
<section id="main-content" class="animated fadeInUp">
<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">Biaya Pengeluaran</h3>
<div class="actions pull-right">
<i class="fa fa-expand"></i>
<i class="fa fa-chevron-down"></i>
</div>
</div>
<!--page body-->
<div class="panel-body">
    <div class="panel-body">
<!--proses ambil bb-->
<?php 
if(isset($_POST['simpan'])){
      $jenis=$_POST['jenis'];
      $tgl=$_POST['tgl'];
      $tgl=date("Ymd",strtotime($tgl));
      $biaya=$_POST['biaya'];
      $Kegunaan=$_POST['Kegunaan'];
      $id_bb=$_POST['id_bb'];
      $jumlah=$_POST['jumlah'];
      $nama=$_POST['nama'];
      $stok=$_POST['stok'];
      if($jenis=='Pembelian Bahan Baku'){
        $query = mysqli_query($koneksi,"SELECT Id_bb FROM tb_bb where Id_bb='$id_bb'");
        while ($data=mysqli_fetch_row($query))
        $iddb=$data[0];
    if(empty($iddb)){
            mysqli_query($koneksi,"INSERT INTO `tb_bb` VALUES ('$id_bb','$nama',$jumlah)");
        }else if($iddb==$id_bb){
            $total=$stok+$jumlah;
            mysqli_query($koneksi,"UPDATE tb_bb SET Stok=$total WHERE Id_bb='$id_bb';");
              }
                if(mysqli_query($koneksi,"INSERT INTO `tb_pengeluaran`(`Id_pengeluaran`, `Jenis`, `kegunaan`,`Jumlah`,`Biaya`, `Tgl`, `Id_karyawan`,`Id_bb`) VALUES ('','$jenis','$nama','$jumlah',$biaya,$tgl,'$id_karyawan','$id_bb')")){
                            echo ('<div class="alert alert-success alert-dismissable">
                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                  Simpan Data Berhasil
                                  </div>');
                        }else {
                            echo('<div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                   <strong>SQL Error ! </strong>"' . mysqli_error($koneksi). 
                                    '</div>');
                          }
      }else if($jenis=='Biaya Operasional'){
         if(mysqli_query($koneksi,"INSERT INTO `tb_pengeluaran`(`Id_pengeluaran`, `Jenis`, `kegunaan`, `Biaya`, `Tgl`, `Id_karyawan`) VALUES ('','$jenis','$Kegunaan',$biaya,$tgl,'$id_karyawan')")){
                            echo ('<div class="alert alert-success alert-dismissable">
                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                  Simpan Data Berhasil
                                  </div>');
                        }else {
                            echo('<div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                   <strong>SQL Error ! </strong>"' . mysqli_error($koneksi). 
                                    '</div>');
                          }

      }
} 
?>
<!--end proses ambil bb-->
         <form class="form-horizontal" role="form" method="post" action="">
                    <div class="form-group">
                <label class="col-sm-3 control-label" for="jenis">Jenis Pembiayaan</label>
                <div class="col-sm-6">
                  <select class="form-control" id="jenis" name="jenis" required>
                    <option></option>
                    <option value="Pembelian Bahan Baku">Pembelian Bahan Baku</option>
                    <option value="Biaya Operasional">Biaya Operasional</option>
                  </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="tgl">Tanggal</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="tgl" value="<?php echo date('m/d/Y'); ?>" readonly>
                </div>
            </div>
            <div id="Pembelian_bb">
<?php 
$query= mysqli_query($koneksi,'SELECT max(Id_bb) as maxId FROM tb_bb');
$data = mysqli_fetch_array($query);
$id = $data['maxId'];
$noUrut = (int) substr($id, 3, 3);
$noUrut++;
$char = "BB-";
$id = $char . sprintf("%03s", $noUrut);
?>
                  <div class="form-group">
                  <label class="col-sm-3 control-label" for="nama">Nama BB</label>
                  <div class="col-sm-6">
                    <input type="text" name="id_bb" id="id_bb" value="<?php echo($id)?>">
                    <input type="hidden" name="stok" id="stok">
                    <input type="text" class="form-control" list="nama-bb" name="nama"  onchange="tampilbb(this.value)">
                  <datalist id="nama-bb">
<?php
$query=mysqli_query($koneksi,"SELECT * From tb_bb");
$jsbb = "var bb = new Array();\n";
while ($row=mysqli_fetch_row($query)) {
echo '<option value="' . $row[1] . '"> Stok : '. $row['2'] .'</option>';
$jsbb .= "bb['" . $row[1] . "'] = {id_bb:'" . addslashes($row[0]) . "',stok:'" . addslashes($row[2]). "'};\n";
}
?>
                  </datalist>
                  </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-3 control-label" for="jumlah">Jumlah</label>
                      <div class="col-sm-6">
                          <input type="text" class="form-control angkaSaja" name="jumlah" id="jumlah" maxlength="3">
                      </div>
                  </div>
            </div>
            <div id="Biaya_Operasional">
                  <div class="form-group">
                  <label class="col-sm-3 control-label" for="Kegunaan">Kegunaan</label>
                  <div class="col-sm-6">
                      <input type="text" class="form-control" name="Kegunaan" id="Kegunaan">
                  </div>
                  </div>
            </div>
            <div id="by">
                  <div class="form-group">
                      <label class="col-sm-3 control-label" for="biaya">Biaya</label>
                      <div class="col-sm-6">
                          <input type="text" class="form-control angkaSaja" name="biaya" id="biaya" maxlength="12" required>
                      </div>
                  </div>
            </div>
            <div class="form-group">
            <label class="col-sm-9 control-label">
              <button type="reset" class="btn btn-danger btn-sm">&nbsp; Reset&nbsp; </button>
              <input type="submit" class="btn btn-info btn-sm" name="simpan" value="simpan">
            </label>
            </div>
                </form>

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
<script type="text/javascript">
  $(function(){
  $("#jenis").change(function() {
      if ($("#jenis option:selected").val() == 'Pembelian Bahan Baku') {
             $("#Biaya_Operasional").hide();
             $("#Pembelian_bb").show();
             $("#by").show();
          }else if ($("#jenis option:selected").val() == "Biaya Operasional"){
            $("#Pembelian_bb").hide();
            $("#Biaya_Operasional").show();
            $("#by").show();
          }
        });
      });
    $(document).ready(function() {
          $("#Pembelian_bb").hide();
          $("#Biaya_Operasional").hide();
          $("#by").hide();
    });
    <?php echo $jsbb; ?>
function tampilbb(id){
document.getElementById('id_bb').value = bb[id].id_bb;
document.getElementById('stok').value = bb[id].stok;
};

</script>