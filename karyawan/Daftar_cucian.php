 <?php 
    require_once('../koneksi.php');
    $id_order = $_POST['id_order'];
    $jenis = $_POST['jenis'];
    $jumlah = $_POST['jumlah'];
    $harga = $_POST['harga'];
    $keterangan = $_POST['keterangan'];
    $tgl = $_POST['tgl'];
    $tgl=date("Ymd",strtotime($tgl));
    $waktu = $_POST['waktu'];
    $waktu=date("Ymd",strtotime($waktu));

      mysqli_query($koneksi,"INSERT INTO tb_detail_order VALUES('','$id_order','$jenis',$jumlah,$tgl,$waktu,'','$keterangan',$harga,'proses');");

$query=mysqli_query($koneksi,"SELECT Tgl_masuk,max(Estimasi),count(Id_penerimaan),sum(harga) from tb_detail_order WHERE Id_order='$id_order' ");
while ($data=mysqli_fetch_row($query)) {
$tgl_masuk=$data[0];
$tgl_selesai=$data[1];
$jumlah_order=$data[2];
$total_harga=$data[3];
 }
 ?>
<form action="?page=Laundry-an" method="post" name="pembayaran">
<input type="hidden" name="id_order" value="<?php echo $id_order; ?>">
<input type="hidden" name="tgl_masuk" value="<?php echo $tgl_masuk; ?>">
<input type="hidden" name="tgl_selesai" value="<?php echo $tgl_selesai; ?>">
<input type="hidden" name="jumlah_order" value="<?php echo $jumlah_order; ?>">
<input type="hidden" name="total_harga" id="total_harga" value="<?php echo $total_harga; ?>">
<div class="col-md-6">
  <div class="table-responsive">
 <table class="table table-condensed">
  <tr>
    <td><b>Id order </b></td>
    <td><?php echo $id_order ?></td>
  </tr>
  <tr>
    <td><b>Tgl masuk </b> </td>
    <td><?php echo $tgl_masuk ?></td>
  </tr>
  <tr>
    <td><b>Tgl Selesai </b></td>
    <td><?php echo $tgl_selesai ?></td>
  </tr>
  <tr>
    <td><b>jumlah Order </b></td>
    <td><?php echo $jumlah_order ?></td>
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
    <?php
$query=mysqli_query($koneksi,"SELECT tb_layanan.Nama,tb_layanan.Jenis,tb_detail_order.Jumlah,tb_layanan.Satuan,tb_detail_order.Tgl_masuk,tb_detail_order.Estimasi,tb_detail_order.Keterangan,tb_detail_order.harga FROM tb_detail_order INNER JOIN tb_layanan on tb_detail_order.Id_layanan=tb_layanan.Id_layanan where tb_detail_order.id_order='$id_order' ORDER BY Id_penerimaan ASC ");
$no = 1;
while ($data=mysqli_fetch_array($query)) {
?>
        <tr>
          <td><?php echo $no ?></td>
          <td><?php echo $data["Nama"];?></td>
          <td><?php echo $data["Jenis"];?></td>
          <td><?php echo $data["Jumlah"];?></td>
          <td><?php echo $data["Satuan"];?></td>
          <td><?php echo $data["Tgl_masuk"];?></td>
          <td><?php echo $data["Estimasi"];?></td>
          <td><?php echo $data["Keterangan"];?></td>
          <td><?php echo $data["harga"];?></td>
        </tr>
          <?php $no++; } ?>
        <tr><b>
            <td colspan="7"><b>Total Harga :</b></td>
            <td align="right"><b>Rp.</b></td>
<td><b><?php echo $total_harga ?></b></td> 
        </tr>
    </tbody>
</table>
   </div>
   </div>
 </div>
  <div class="row">
    <div class="col-md-7">
   </div>
   <div class="col-md-5">
                  <div class="form-group">
                  <label class="radio-inline">
                  <input type="radio" name="status_pemabayaran" id="akhir" value="akhir" class="icheck"/>Bayar Saat Pengambilan</label>
                  <label class="radio-inline">
                  <input  type="radio" name="status_pemabayaran" id="awal" value="awal" class="icheck"/>Bayar Sekarang</label>
                  </div>
                  <div id="kondisi">
                  <div class="form-group">
                  <label for="bayar">Bayar</label>
                  <input type="text" class="form-control" name="bayar" id="bayar" onkeyup="hitungtotal()">
                  </div>
                  <div class="form-group">
                  <label for="kembalian">Kembalian</label>
                  <input type="text" class="form-control" name="kembalian" id="kembalian" readonly>
                  </div>
                  </div>
                   <div class="btn-group btn-group-justified">
                  <label class="col-sm-5"></label>
                  <div class="col-sm-3">
                    <input type="submit" class="btn btn-danger btn-sm" name="batal_transaksi" value="&nbsp; Batal &nbsp; ">
                  </div>
                  <div class="col-sm-4">
                    <input type="submit" class="btn btn-info btn-sm" id="btn_simpan" name="Simpan_transaksi" value="Simpan dan Cetak" onclick="window.open('Nota.php')">
                  </div>
                  </div>
   </div>
   </div>
    </form>  

   <script type="text/javascript">
$(function(){
        $(":radio.icheck").click(function(){
          $("#kondisi").hide()
          if($(this).val() == "awal"){
            $("#kondisi").show();
             $("#btn_simpan").hide();
             bayar.required='true';
          }
        });
        
      });
    $(document).ready(function() {
          $("#akhir").prop("checked",true);
          $("#kondisi").hide();
    });
  function hitungtotal(){
 var totalharga = document.getElementById('total_harga').value;
 var bayar = document.getElementById('bayar').value;
 var t_harga=bayar-totalharga;
 document.getElementById('kembalian').value = t_harga;
         var tampil_button=document.getElementById('kembalian').value;
        if(tampil_button>=0){
             $("#btn_simpan").show();
        } else if(tampil_button<=-1){
             $("#btn_simpan").hide();
        }
      }
   </script>