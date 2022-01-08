<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login Laundry</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/fonts/icon-layers.png" type="image/x-icon">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
    <!-- Fonts  -->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/simple-line-icons.css">
    <!-- CSS Animate -->
    <link rel="stylesheet" href="assets/css/animate.css">
    <!-- Custom styles for this theme -->
    <link rel="stylesheet" href="assets/css/main.css">
    <!-- Feature detection -->
    <script src="assets/js/vendor/modernizr-2.6.2.min.js"></script>
</head>
<body>

    <section class="container animated fadeInUp">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div id="login-wrapper">
                    <header>
                        <div class="brand">
                            <a href="index.html" class="logo">
                                <span>ARSENA</span> Laundry</a>
                        </div>
                    </header>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">     
                           Sign In
                        </h3>
                        </div>
                        <div class="panel-body">
<?php 
session_start();
include 'koneksi.php';
if(isset($_POST['username']) && ($_POST['password'])){
// menangkap data yang dikirim dari form
$username = $_POST['username'];
$password = md5($_POST['password']);
$query = mysqli_query($koneksi,"select Id_pemilik from tb_pemilik where username='$username' and password='$password'");
$data_pemilik = mysqli_fetch_array($query);
$query1 = mysqli_query($koneksi,"select Id_karyawan from tb_karyawan where username='$username' and password='$password'");
$data_karyawan = mysqli_fetch_array($query1);
    if( ! empty($data_pemilik)){ 
          $_SESSION['Id_pemilik'] = $data_pemilik['Id_pemilik'];
          header("location:pemilik/index.php?page=dashboard");
        }else if( ! empty($data_karyawan)){ 
          $_SESSION['Id_karyawan'] = $data_karyawan['Id_karyawan'];
          header("location:karyawan/index.php?page=dashboard");
    }else{
  echo ('<div class="alert alert-danger alert-dismissable">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          Username dan Password tidak cocok
                          </div>');
    }
}
?>
                            <form class="form-horizontal" role="form" method="post" action="login.php">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username">
                                        <i class="fa fa-user"></i>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                        <i class="fa fa-lock"></i>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                      <input type="submit" class="btn btn-primary btn-block" value="Login" name="login">
                                        <hr />
                                        <input type="reset" class="btn btn-danger btn-block"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Global JS-->
</body>
    <script src="assets/js/vendor/jquery-1.11.1.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/plugins/navgoco/jquery.navgoco.min.js"></script>
    <script src="assets/plugins/pace/pace.min.js"></script>
    <script src="assets/js/src/app.js"></script>
</html>
