<section class="main-content-wrapper">
<section id="main-content" class="animated fadeInUp">
<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
            <div class="panel-heading">
            <h3 class="panel-title"><button type="button" class="btn btn-info btn-xs"> 1&nbsp;</button>&nbsp;Penerimaan Laundry</h3>
                  <div class="actions pull-right">
                  <i class="fa fa-chevron-down"></i>
                  </div>
            </div>
<!--page body-->
<div class="panel-body">
        <div class="tab-wrapper tab-primary">
        <ul class="nav nav-tabs">
            <li id="lipelanggan" class="active"><a href="#Data_pelanggan" data-toggle="tab">
            <button type="button" class="btn btn-info btn-xs"> 2 </button>&nbsp; Data Pelanggan</a>
            </li>
            <li id="licucian"><a href="#Data_cucian" data-toggle="tab">
            <button type="button" class="btn btn-info btn-xs"> 3 </button>&nbsp; Data Cucian</a>
            </li>
        </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="Data_pelanggan">
<?php
$query= mysqli_query($koneksi,'SELECT max(Id_pelanggan) as maxId FROM tb_pelanggan');
$data = mysqli_fetch_array($query);
$id = $data['maxId'];
$noUrut = (int) substr($id, 3, 3);
$noUrut++;
$char = "PG-";
$id_pg = $char . sprintf("%03s", $noUrut);

$query = mysqli_query($koneksi,'SELECT max(Id_order) as maxId FROM tb_order');
$data = mysqli_fetch_array($query);
$id = $data['maxId'];
$noUrut = (int) substr($id, 3, 3);
$noUrut++;
$char = "OD-";
$id_od = $char . sprintf("%03s", $noUrut);
?>
                  <form class="form-horizontal" role="form" id="form_simpan_plg" method="post" action="Simpan_pelanggan.php">
                  <div class="form-group">
                  <label class="col-sm-2 control-label" for="id_pelanggan">ID Pelanggan</label>
                      <div class="col-sm-9">
                      <input type="hidden"name="id_order" id="id_order" value="<?php echo($id_od)?>">
                      <input type="text" class="form-control" name="id_pelanggan" id="id_pelanggan" value="<?php echo($id_pg)?>" title="Id terisi otomatis" readonly>
                      </div>
                  </div>
                  <div class="form-group">
                  <label class="col-sm-2 control-label"  for="nama">Nama</label>
                  <div class="col-sm-9">
                  <input type="text" class="form-control" list="nama_pelanggan" name="nama_pelanggan"  onchange="Tampilpelanggan(this.value)">
                  <datalist id="nama_pelanggan">
<?php
$query=mysqli_query($koneksi,"SELECT * From tb_pelanggan");
$jspelanggan = "var pelanggan = new Array();\n";
while ($row=mysqli_fetch_array($query)) {
echo '<option value="' . $row['Nama'] . '">' . $row['Nama']  .' || '.  $row['Alamat'] .' || '. $row['No_telp'] .'</option>';
$jspelanggan .= "pelanggan['" . $row['Nama'] . "'] = {id_pelanggan:'" . addslashes($row['Id_pelanggan']) . "',nama:'" . addslashes($row['Nama']) . "',alamat:'" . addslashes($row['Alamat']) . "',jk:'" . addslashes($row['Jk']) . "',no_telp:'" . addslashes($row['No_telp']) . "'};\n";
}
?>
                  </datalist>
                  </div>
                  </div>         
                  <div class="form-group">
                  <label class="col-sm-2 control-label"  for="alamat">Alamat</label>
                  <div class="col-sm-9">
                  <textarea class="form-control" name="alamat" id="alamat" placeholder="Alamat" required></textarea>
                  </div>
                  </div>
                  <div class="form-group">
                  <label class="col-sm-2 control-label" for="jk">Jenis Kelamin</label>
                  <div class="col-sm-9">
                  <label class="radio-inline">
                  <input class="icheck" type="radio" name="jk" value="Laki-laki" id="Laki-laki" required>Laki-laki</label>
                  <label class="radio-inline">
                  <input class="icheck" type="radio" name="jk" value="Perempuan" id="Perempuan" required>Perempuan</label>
                  </div>
                  </div>
                  <div class="form-group">
                  <label class="col-sm-2 control-label"  for="telp">No telp</label>
                  <div class="col-sm-9">
                  <input type="text" class="form-control" name="telp" id="telp"  placeholder="082123456786" maxlength="12" onkeypress="return hanyaAngka(event)"  required>
                  </div>
                  </div>
                  <div class="form-group">
                  <label class="col-sm-11 control-label">
                    <button type="reset" class="btn btn-danger btn-sm">&nbsp; Reset&nbsp; </button>
                    <input type="submit" class="btn btn-info btn-sm" id="Selanjutnya" value="Selanjutnya">
                  </label>
                  </div>
                  </form>
              </div>
              <div class="tab-pane" id="Data_cucian">
                  <form class="form-horizontal" id="form_tambah_cucian" role="form" method="post" action="Daftar_cucian.php">
                      <input type="hidden"name="id_order" id="id_order" value="<?php echo($id_od)?>">
                  <div class="form-group">
                  <label class="col-sm-3 control-label"  for="Jenis">Jenis layanan</label>
                  <div class="col-sm-8">
                  <select class="form-control  input-sm" name="jenis" id="jenis" onchange="Tampillayanan(this.value)" required>
                    <option></option>
<?php
$query=mysqli_query($koneksi,"SELECT * From tb_layanan");
$jslayanan = "var layanan = new Array();\n";
while ($row=mysqli_fetch_array($query)) {
echo '<option value="' . $row['Id_layanan'] . '">' . $row['Nama'] .' || '. $row['Jenis'] .' || '. $row['Harga'] .' || '. $row['Waktu'] .'</option>';
$jslayanan .= "layanan['" . $row['Id_layanan'] . "'] = {satuan:'" . addslashes($row['Satuan']) . "',waktu:'" . addslashes($row['Waktu']) . "',harga:'" . addslashes($row['Harga']) . "'};\n";
}
?>
                  </select>
                  </div>
                  </div>  
                  <div class="form-group">
                  <label class="col-sm-3 control-label" for="jumlah">Jumlah</label>
                  <div class="col-sm-4">
                  <input type="text" class="form-control " name="jumlah" id="jumlah" placeholder="Jumlah Cucian" maxlength="2" onkeypress="return hanyaAngka(event)" onkeyup="hitung()"  required >
                  <label id="pesan"></label>
                  </div>
                  <div class="col-sm-4">
                  <input type="text" class="form-control" name="Satuan" id="satuan" placeholder="Satuan" readonly>
                  </div>
                  </div>
                  <div class="form-group">
                  <label class="col-sm-3 control-label" for="harga">Total Harga</label>
                  <div class="col-sm-8">
                  <input type="text" class="form-control" name="harga" id="harga" readonly>
                  </div>
                  </div>
                  <div class="form-group">
                  <label class="col-sm-3 control-label"  for="keterangan">Keterangan</label>
                  <div class="col-sm-8">
                  <textarea class="form-control" name="keterangan" id="keterangan" placeholder="Tulis keterangan jika dibutuhkan"></textarea>
                  </div>
                  </div>       
                  <div class="form-group">
                  <label class="col-sm-3 control-label">Wakru Pengerjaan</label>
                  <div class="col-sm-4">
                  <input type="text" class="form-control" name="tgl" id="tgl" value="<?php echo date('m/d/Y'); ?>" readonly>
                  </div>
                  <div class="col-sm-4">
                  <input type="text" class="form-control" name="waktu" id="waktu" placeholder="m/d/yyyyy" readonly>
                  </div>
                  </div>       
                  <div class="form-group">
                  <label class="col-sm-11 control-label">
                    <button type="reset" class="btn btn-danger btn-sm">&nbsp; Reset&nbsp; </button>
                    <input type="submit" class="btn btn-info btn-sm" value="Tambah">
                  </label>
                  </div>
                  </form>    
              </div>

            </div>
        </div>
</div>
<!--end page body-->
</div>
<!-- end panel panel-default-->
</div>
<!--end col-md-12-->
</div> 
<!-- end row pertama-->

<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
            <div class="panel-heading">
            <h3 class="panel-title"><button type="button" class="btn btn-info btn-xs"> 4 </button>&nbsp; Konfirmasi Penerimaan</h3>
                  <div class="actions pull-right">
                  <i class="fa fa-chevron-down"></i>
                  </div>
            </div>
<!--page body-->
<div class="panel-body" id="pnl_konfirmasi" style="display: none;">
  <div id="data_pelanggan" class="col-md-6">
  <div class="table-responsive">
 <table class="table table-condensed">
  <tr>
    <td width="130"><b>Id Pelanggan </b> </td>
    <td></td>
  </tr>
  <tr>
    <td><b>Nama</b> </td>
    <td></td>
  </tr>
  <tr>
    <td><b>Alamat</b> </td>
    <td></td>
  </tr>
  <tr>
    <td><b>Jenis Kelamin</b> </td>
    <td></td>
  </tr>
  <tr>
    <td><b>No Telp </b></td>
    <td></td>
  </tr>
 </table>
   </div>
 </div>

  <div id="konfirmasi">
 <div class="col-md-6">
  <div class="table-responsive">
 <table class="table table-condensed">
  <tr>
    <td><b>Id order </b></td>
    <td></td>
  </tr>
  <tr>
    <td><b>Tgl masuk </b> </td>
    <td></td>
  </tr>
  <tr>
    <td><b>Tgl Selesai </b></td>
    <td></td>
  </tr>
  <tr>
    <td><b>jumlah Order </b></td>
    <td></td>
  </tr>
 </table>
   </div>
   </div>

<div class="row">
    <div class="col-md-12">
  <div class="table-responsive">
    <table class="table table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Layanan</th>
            <th>Jenis</th>
            <th>Jumlah</th>
            <th>Satuan</th>
            <th>Tanggal Masuk</th>
            <th>Estimasi Selesai</th>
            <th>Keterangan</th>
            <th>Harga</th>
        </tr>
    </thead>
    <tbody>
        <tr>
          <td colspan="9"></td>
        </tr>
        <tr><b>
            <td colspan="7"><b>Total Harga :</b></td>
            <td align="right"><b>Rp.</b></td>
<td></td>  
        </tr>
    </tbody>
</table>
   </div>
   </div>
 </div>


 </div>
 <hr>
  
</div>
</form>
<!--end page body-->
</div>
<!-- end panel panel-default-->
</div>
<!--end col-md-12-->
</div> 
<!-- end row kedua-->

</section>
<!--end main-content--> 
</section>
<!--end main-content-wrapper-->
 
<script type="text/javascript">
<?php echo $jspelanggan; ?>
function Tampilpelanggan(id){
document.getElementById('id_pelanggan').value = pelanggan[id].id_pelanggan;
document.getElementById('alamat').value = pelanggan[id].alamat;
document.getElementById('telp').value = pelanggan[id].no_telp;
var jk = pelanggan[id].jk;
  if(jk=="Laki-laki"){
  $("#Laki-laki").prop("checked", true);
  }else{
  $("#Perempuan").prop("checked", true);
  };
};


<?php echo $jslayanan; ?>
function Tampillayanan(id){
  var waktu = layanan[id].waktu;
  harga = layanan[id].harga;
  var tanggal = new Date(new Date().getTime()+(waktu*24*60*60*1000)); 
  var estimasi = tanggal.toLocaleDateString();
document.getElementById('satuan').value = layanan[id].satuan;
document.getElementById('waktu').value = estimasi;
};


function hitung(){
 var jumlah = document.getElementById('jumlah').value;
 var t_harga=harga*jumlah;
 document.getElementById('harga').value = t_harga;
}

$('#form_simpan_plg').submit(function(e){
    e.preventDefault();

    $.ajax({
      type:$(this).attr('method'), 
      url:$(this).attr('action'),//url target
      data:$(this).serialize(),
      success:function(id){
     $('#Data_cucian').addClass('active');
      $('#Data_pelanggan').removeClass('active');
      $('#licucian').addClass('active');
      $('#lipelanggan').removeClass('active');
      }
    }).done(function(data){
      $('#data_pelanggan').html(data);
    })
});
  
$('#form_tambah_cucian').submit(function(e){
    e.preventDefault();

    $.ajax({
      type:$(this).attr('method'), 
      url:$(this).attr('action'),//url target
      data:$(this).serialize(),
      success:function(id){
        document.getElementById("pnl_konfirmasi").style.display = "block";
        Swal.fire(
         'Berhasil !',
         'Data cucian berhasil ditambahkan',
         'success'
      )
      }
    }).done(function(data){
      $('#konfirmasi').html(data);
      document.getElementById("jumlah").value="";
      document.getElementById("jenis").value="";
      document.getElementById("satuan").value="";
      document.getElementById("harga").value="";
      document.getElementById("keterangan").value="";
      document.getElementById("waktu").value="";
    })
});

</script>