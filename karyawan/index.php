<?php 
session_start();
if( !isset($_SESSION['Id_karyawan']) ){
header("location:../login.php");
}
require_once('../koneksi.php');
$id_karyawan=$_SESSION['Id_karyawan'];
$query = mysqli_query($koneksi,"SELECT Nama,Foto FROM tb_karyawan where Id_karyawan='$id_karyawan'");
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
                    <img class="img-circle profile-image" src="../assets/img/karyawan/<?php echo $foto ?>" alt="profile">
                    <i class="on border-dark animated bounceIn"></i>
                </div>
                <div class="profile-body dropdown">
                    <h4><?php echo $nama ?></h4>
                </div>
            </div>
            <nav>
                <h5 class="sidebar-header">Menu</h5>
                <ul class="nav nav-pills nav-stacked">
                     <li <?php if($page == "dashboard") echo "class='active'";?>> <a href="?page=dashboard" title="Dashboard" >
                            <i class="fa  fa-fw fa-tachometer"></i> Dashboard
                        </a>
                    </li>
                    <li <?php if($page == "Data pelanggan") echo "class='nav-dropdown open active'";?>>
                        <a href="#" title="Pendataan">
                            <i class="fa  fa-fw fa-edit"></i> Pendataan
                        </a>
                        <ul class="nav-sub">
                            <li <?php if($page == "Data pelanggan") echo "class='active'";?>>
                                <a href="?page=Data pelanggan" title="Data karyawan">
                                     Data pelanggan
                                </a>
                            </li>
                        </ul>
                    </li>
                     <li <?php if($page == "Laundry-an" || $page == "Bahan baku" || $page == "Biaya Pengeluaran" || $page == "Penerimaan"|| $page == "Detail order" || $page == "Pengembalian") echo "class='nav-dropdown open active'";?>>
                        <a href="#" title="Transaksi">
                            <i class="fa  fa-fw fa-money"></i> Transaksi
                        </a>
                        <ul class="nav-sub">
                            <li <?php if($page == "Laundry-an" || $page == "Penerimaan" || $page == "Detail order" || $page == "Pengembalian") echo "class='active'";?>>
                                <a href="?page=Laundry-an" title="Data Laundry">
                                     Laundry-an
                                </a>
                            </li>
                            <li <?php if($page == "Bahan baku") echo "class='active'";?>>
                                <a href="?page=Bahan baku" title="Stock bahan baku">
                                     Bahan baku
                                </a>
                            </li>
                            <li <?php if($page == "Biaya Pengeluaran") echo "class='active'";?>>
                                <a href="?page=Biaya Pengeluaran" title="Biaya pengeluaran">
                                    Biaya Pengeluaran
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
            case 'Data pelanggan':
                include "Data_pelanggan.php";
                break; 
            case 'Laundry-an':
                include "Data_laundry.php";
                break;
            case 'Bahan baku':
                include "Bahan_baku.php";
                break;
            case 'Biaya Pengeluaran':
                include "Biaya_pengeluaran.php";
                break;
            case 'Penerimaan':
                include "Penerimaan.php";
                break;
            case 'Detail order':
                include "Detail_order.php";
                break;
            case 'Pengembalian':
                include "Pengembalian.php";
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
