    <!--proses simpan_plg sementara-->
<?php 
      require_once('../koneksi.php');
      $id_order=$_POST['id_order'];
      $id_pelanggan=$_POST['id_pelanggan'];
      $nama_pelanggan=$_POST['nama_pelanggan'];
      $alamat=$_POST['alamat'];
      $jk=$_POST['jk'];
      $no_telp=$_POST['telp'];
      mysqli_query($koneksi,"INSERT INTO tb_pelanggan VALUES ('$id_pelanggan','$nama_pelanggan','$alamat','$jk','$no_telp');");
      mysqli_query($koneksi,"INSERT INTO `tb_order`(`Id_order`,`Id_pelanggan`) VALUES ('$id_order','$id_pelanggan');");
      $query=mysqli_query($koneksi,"SELECT * FROM tb_pelanggan WHERE id_pelanggan='$id_pelanggan' ");
while ($data=mysqli_fetch_row($query)) {       
?>
  <div class="table-responsive">
 <table class="table table-condensed">

  <tr>
    <td width="130"><b>Id Pelanggan </b> </td>
    <td><?php echo $data[0] ?></td>
  </tr>
  <tr>
    <td><b>Nama</b> </td>
    <td><?php echo $data[1] ?></td>
  </tr>
  <tr>
    <td><b>Alamat</b> </td>
    <td><?php echo $data[2] ?></td>
  </tr>
  <tr>
    <td><b>Jenis Kelamin</b> </td>
    <td><?php echo $data[3] ?></td>
  </tr>
  <tr>
    <td><b>No Telp </b></td>
    <td><?php echo $data[4] ?></td>
  </tr>
 </table>
   </div>
 <?php } ?>