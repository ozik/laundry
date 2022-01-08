<section class="main-content-wrapper">
<section id="main-content" class="animated fadeInUp">
  <div class="row">
      <div class="col-md-12">
          <div class="panel panel-default">
              <div class="panel-heading">
                  <h3 class="panel-title">Pengaturan</h3>
                  <div class="actions pull-right">
                      <i class="fa fa-chevron-down"></i>
                  </div>
              </div>
              <div class="panel-body">
<!--proses edit Password-->
<?php 
if(isset($_POST['btn_password'])){
      $password_lama=md5($_POST['password_lama']);
      $password_baru=md5($_POST['password_baru']);
      $ulangi_password=md5($_POST['ulangi_password']);
      $query = mysqli_query($koneksi,"SELECT Password FROM tb_karyawan WHERE id_karyawan='$id_karyawan'");
      $data = mysqli_fetch_array($query);
      $dbpass = $data['Password'];
      if ($dbpass==$password_lama) {
        if ($password_baru==$ulangi_password) {
                  if(mysqli_query($koneksi,"UPDATE tb_karyawan SET Password='$password_baru' WHERE id_karyawan='$id_karyawan';")){
                            echo ('<div class="alert alert-success alert-dismissable">
                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                  Password berhasil diganti
                                  </div>');
                        }else {
                            echo('<div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                   <strong>SQL Error ! </strong>"' . mysqli_error($koneksi). 
                                    '</div>');
                          }
          
        }else {
          echo ('<div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                   <strong>Gagal ! </strong> Password Baru tidak sama</div>');
        }
        
      }else{
        echo ('<div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                   <strong>Gagal ! </strong> Password Lama Salah </div>');
      }
} 
?>
<!--end proses edit Password-->
<!--proses edit username-->
<?php 
if(isset($_POST['btn_username'])){
      $username_lama=$_POST['username_lama'];
      $username_baru=$_POST['username_baru'];
      $ulangi_username=$_POST['ulangi_username'];
      $query = mysqli_query($koneksi,"SELECT Username FROM tb_karyawan WHERE id_karyawan='$id_karyawan'");
      $data = mysqli_fetch_array($query);
      $dbuser = $data['Username'];
      if ($dbuser==$username_lama) {
        if ($username_baru==$ulangi_username) {
                  if(mysqli_query($koneksi,"UPDATE tb_karyawan SET Username='$username_baru' WHERE id_karyawan='$id_karyawan';")){
                            echo ('<div class="alert alert-success alert-dismissable">
                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                  Username berhasil diganti
                                  </div>');
                        }else {
                            echo('<div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                   <strong>SQL Error ! </strong>"' . mysqli_error($koneksi). 
                                    '</div>');
                          }
          
        }else {
          echo ('<div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                   <strong>Gagal ! </strong> Username Baru tidak sama</div>');
        }
        
      }else{
        echo ('<div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                   <strong>Gagal ! </strong> Username Lama Salah </div>');
      }
} 
?>
<!--end proses edit username-->
                <div class="tab-wrapper tab-left">
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#Ganti_username" data-toggle="tab">Ganti Username</a>
                    </li>
                    <li><a href="#Ganti_password" data-toggle="tab"> Ganti Password</a>
                    </li>
                  </ul>
                    <div class="tab-content">
                    <div class="tab-pane active" id="Ganti_username">
                      <form class="form-horizontal form-border" method="post">
                      <div class="form-group">
                      <label class="col-sm-3 control-label" for="username_lama">Username Lama</label>
                      <div class="col-sm-6">
                      <input type="text" class="form-control" name="username_lama" required>
                      </div>
                      </div>
                      <div class="form-group">
                      <label class="col-sm-3 control-label" for="username_baru">Username baru</label>
                      <div class="col-sm-6">
                      <input type="text" class="form-control" name="username_baru" required>
                      </div>
                      </div>
                      <div class="form-group">
                      <label class="col-sm-3 control-label" for="ulangi_username">Ulangi Username</label>
                      <div class="col-sm-6">
                      <input type="text" class="form-control" name="ulangi_username" required>
                      </div>
                      </div>
                      <div class="form-group">
                      <label class="col-sm-9 control-label">
                      <button type="reset" class="btn btn-danger btn-sm">&nbsp; Reset&nbsp; </button>
                      <input type="submit" class="btn btn-info btn-sm" name="btn_username" value="Simpan">
                      </label>
                      </div>
                      </form>
                    </div>
                    <div class="tab-pane" id="Ganti_password">
                      <form class="form-horizontal form-border" method="post" action="">
                      <div class="form-group">
                      <label class="col-sm-3 control-label" for="password_lama">Password Lama</label>
                      <div class="col-sm-6">
                      <input type="password" class="form-control" name="password_lama" required>
                      </div>
                      </div>
                      <div class="form-group">
                      <label class="col-sm-3 control-label" for="password_baru">Password baru</label>
                      <div class="col-sm-6">
                      <input type="password" class="form-control" name="password_baru" required>
                      </div>
                      </div>
                      <div class="form-group">
                      <label class="col-sm-3 control-label" for="ulangi_password">Ulangi Password</label>
                      <div class="col-sm-6">
                      <input type="password" class="form-control" name="ulangi_password" required>
                      </div>
                      </div>
                      <div class="form-group">
                      <label class="col-sm-9 control-label">
                      <button type="reset" class="btn btn-danger btn-sm">&nbsp; Reset&nbsp; </button>
                      <input type="submit" class="btn btn-info btn-sm" name="btn_password" value="Simpan">
                      </label>
                      </div>
                      </form>
                    </div>
                    
                    </div>
                </div>
              </div>
          </div>
      </div>
  </div>
</div> 
</section>
<!--end tag template--> 
</section>