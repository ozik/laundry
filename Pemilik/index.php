<?php 
session_start();
if( !isset($_SESSION['Id_pemilik']) ){
header("location:../login.php");
}
require_once('../koneksi.php');
$id_pemilik=$_SESSION['Id_pemilik'];
$query = mysqli_query($koneksi,"SELECT Nama,Foto FROM tb_pemilik where Id_pemilik='$id_pemilik'");
while($data = mysqli_fetch_array($query)){
$nama=$data["Nama"];
$foto=$data["Foto"];
}
if(isset($_GET['page'])){
$page = $_GET['page'];
?>
<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> <?php echo $page;?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <!-- Favicon -->
    <link rel="shortcut icon" href="../assets/fonts/icon-layers.png" type="image/x-icon">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css">
    <!-- Fonts  -->
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/simple-line-icons.css">
    <!-- Fonts from Font Awsome -->
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <!-- CSS Animate -->
    <link rel="stylesheet" href="../assets/css/animate.css">
    <!-- Switchery -->
    <link rel="stylesheet" href="../assets/plugins/switchery/switchery.min.css">
    <!-- Custom styles for this theme -->
    <link rel="stylesheet" href="../assets/css/main.css">
    <!-- DataTables-->
    <link rel="stylesheet" href="../assets/plugins/dataTables/datatables.css">
    <!-- Feature detection -->
    <script src="../assets/js/vendor/modernizr-2.6.2.min.js"></script>
    <script src="../assets/js/vendor/jquery-1.11.1.min.js"></script>
    <script type="text/javascript">
     $(document).ready(function() {
$(".angkaSaja").keypress(function(event){
var charCode = (event.which) ? event.which : event.keyCode
if ((charCode >= 48 && charCode <= 57))
return true;
return false;
});
$(".hurufSpesial").keypress(function(event){
var charCode = (event.which) ? event.which : event.keyCode
if ((charCode >= 65 && charCode <= 90)||(charCode >= 97 && charCode <= 122) || charCode == 32 ||(charCode >= 44 && charCode <= 57))
return true;
return false;
});
$(".hurufSaja").keypress(function(event){
var charCode = (event.which) ? event.which : event.keyCode
if ((charCode >= 65 && charCode <= 90)||(charCode >= 97 && charCode <= 122) || charCode == 32)
return true;
return false;
});
});
     </script>
</head>
<body>
<section id="main-wrapper" class="theme-blue-full">
        <header id="header">
            <!--logo start-->
            <div class="brand"><a href="?page=dashboard" class="logo"><span>ARSENA</span> LAUNDRY</a></div>
            <!--logo end-->
                        <ul class="nav navbar-nav navbar-right">
                <li class="toggle-profile hidden-xs">
                    <button type="button" class="btn btn-default" id="toggle-profile">
                                <i class="icon-user"></i>
                    </button>
                </li>
                <li class="dropdown profile hidden-xs">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="meta">
                        <span class="text"><?php echo $nama ?></span>
                        <span class="caret"></span>
                        </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight" role="menu">
                        <li></li>
                        <li>
                            <a href="?page=Pengaturan">
                                <span class="icon"><i class="fa fa-cog"></i>
                                </span>Pengaturan akun</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                             <a href="../logout.php">
                                <span class="icon"><i class="fa fa-sign-out"></i>
                                </span>Logout</a>
                        </li>
                    </ul>
                </li>
                </li>
                <li class="toggle-fullscreen hidden-xs">
                    <button type="button" class="btn btn-default expand" id="toggle-fullscreen">
                        <i class="fa fa-expand"></i>
                    </button>
                </li>
            </ul>
        </header>
        <!--sidebar left start-->
        <aside class="sidebar sidebar-left">
            <div class="sidebar-profile">
                <div class="avatar">
                    <img class="img-circle profile-image" src="../assets/img/pemilik/<?php echo $foto ?>" alt="profile">
                    <i class="on border-dark animated bounceIn"></i>
                </div>
                <div class="profile-body dropdown">
                    <h4><?php echo $nama; ?></h4>
                </div>
            </div>
            <nav>
                <h5 class="sidebar-header">Menu</h5>
                <ul class="nav nav-pills nav-stacked">
                     <li <?php if($page == "dashboard") echo "class='active'";?>> <a href="?page=dashboard" title="Dashboard" >
                            <i class="fa  fa-fw fa-tachometer"></i> Dashboard
                        </a>
                    </li>
                    <li <?php if($page == "Data pemilik" || $page == "Data karyawan" || $page == "Data layanan") echo "class='nav-dropdown open active'";?>>
                        <a href="#" title="Pendataan">
                            <i class="fa  fa-fw fa-edit"></i> Pendataan
                        </a>
                        <ul class="nav-sub">
                            <li <?php if($page == "Data pemilik") echo "class='active'";?>>
                                <a href="?page=Data pemilik" title="Data pemilik">
                                     Data Pemilik
                                </a>
                            </li>
                            <li <?php if($page == "Data karyawan") echo "class='active'";?>>
                                <a href="?page=Data karyawan" title="Data karyawan">
                                     Data Karyawan
                                </a>
                            </li>
                            <li <?php if($page == "Data layanan") echo "class='active'";?>>
                                <a href="?page=Data layanan" title="Data layanan">
                                     Data Layanan
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li <?php if($page == "Laporan data pemilik" || $page == "Laporan data karyawan" || $page == "Laporan data pelanggan" || $page == "Laporan data layanan" || $page == "Laporan data pengeluaran" || $page == "Laporan data bahan baku" || $page == "Laporan data laundry-an") echo "class='nav-dropdown open active'";?>>
                        <a href="#" title="Laporan">
                            <i class="fa  fa-fw fa-paperclip"></i> Laporan
                        </a>
                        <ul class="nav-sub">
                            <li <?php if($page == "Laporan data pemilik") echo "class='active'";?>>
                                <a href="?page=Laporan data pemilik" title="Laporan data pemilik">
                                     Data Pemilik
                                </a>
                            </li>
                            <li <?php if($page == "Laporan data karyawan") echo "class='active'";?>>
                                <a href="?page=Laporan data karyawan" title="Laporan data Karyawan">
                                     Data Karyawan
                                </a>
                            </li>
                            <li <?php if($page == "Laporan data pelanggan") echo "class='active'";?>>
                                <a href="?page=Laporan data pelanggan" title="Laporan data Pelanggan">
                                     Data Pelanggan
                                </a>
                            </li>
                            <li <?php if($page == "Laporan data layanan") echo "class='active'";?>>
                                <a href="?page=Laporan data layanan" title="Laporan data Layanan">
                                     Data Layanan
                                </a>
                            </li>
                            <li <?php if($page == "Laporan data pengeluaran") echo "class='active'";?>>
                                <a href="?page=Laporan data pengeluaran" title="Laporan data Pengeluaran">
                                     Data Biaya Pengeluaran
                                </a>
                            </li>
                            <li <?php if($page == "Laporan data bahan baku") echo "class='active'";?>>
                                <a href="?page=Laporan data bahan baku" title="Laporan data Laundry-an">
                                     Data Bahan Baku
                                </a>
                            </li>
                            <li <?php if($page == "Laporan data laundry-an") echo "class='active'";?>>
                                <a href="?page=Laporan data laundry-an" title="Laporan data Laundry-an">
                                     Data Laundry-an
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </aside>
        <!--sidebar left end-->
        <!--main content start-->
  <?php 
        switch ($page) {
            case 'Pengaturan':
                include "Pengaturan.php";
                break;
            case 'dashboard':
                include "dashboard.php";
                break;
            case 'Data pemilik':
                include "Data_pemilik.php";
                break;
            case 'Data karyawan':
                include "Data_karyawan.php";
                break;       
            case 'Data layanan':
                include "Data_layanan.php";
                break;
            case 'Laporan data pemilik':
                include "L_pemilik.php";
                break;
            case 'Laporan data karyawan':
                include "L_karyawan.php";
                break;
            case 'Laporan data pelanggan':
                include "L_pelanggan.php";
                break;
            case 'Laporan data layanan':
                include "L_layanan.php";
                break;
            case 'Laporan data pengeluaran':
                include "L_pengeluaran.php";
                break;
            case 'Laporan data bahan baku':
                include "L_bb.php";
                break;
            case 'Laporan data laundry-an':
                include "L_laundry-an.php";
                break;

            default:
                echo "pages-404.php";
                break;

        }
    }else{
        header("location:?page=dashboard");
    }
     ?>
        <!--main content end-->
</section>  
    <!--Global JS-->
    <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/plugins/navgoco/jquery.navgoco.min.js"></script>
    <script src="../assets/plugins/pace/pace.min.js"></script>
    <script src="../assets/plugins/fullscreen/jquery.fullscreen-min.js"></script>
    <script src="../assets/js/src/app.js"></script>
    <!--Page Level JS-->
    <script src="../assets/plugins/countTo/jquery.countTo.js"></script>
    <script src="../assets/plugins/weather/js/skycons.js"></script>
    <!-- Switch -->
    <script src="../assets/plugins/switchery/switchery.min.js"></script>
    <!--datatables -->
    <script src="../assets/plugins/dataTables/datatables.js"></script>
    <!--Page Level JS-->  
    <script src="../assets/plugins/sweetalert2-8.14.0/sweetalert2.all.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#tabel_data').dataTable();
    });
    </script>
</body>
</html>
