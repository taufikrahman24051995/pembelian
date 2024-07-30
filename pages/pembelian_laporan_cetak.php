<?php 

session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location:login.php");
    exit;
};

require 'functions.php';

if (isset($_POST['tanggal_awal']) && isset($_POST['tanggal_akhir'])) {

$tanggal_awal=date('Y-m-d', strtotime($_POST["tanggal_awal"]));
$tanggal_akhir=date('Y-m-d', strtotime($_POST["tanggal_akhir"]));

$beli = query("SELECT * FROM beli INNER JOIN detail_beli ON beli.kode_beli = detail_beli.kode_beli INNER JOIN pemasok ON beli.kode_pemasok = pemasok.kode_pemasok INNER JOIN admin ON beli.kode_admin = admin.kode_admin INNER JOIN barang ON barang.kode_barang = detail_beli.kode_barang WHERE tanggal BETWEEN '".$tanggal_awal."' AND '".$tanggal_akhir."' ORDER BY beli.kode_beli ASC ");

} else {

$beli = query("SELECT * FROM beli INNER JOIN detail_beli ON beli.kode_beli = detail_beli.kode_beli INNER JOIN pemasok ON beli.kode_pemasok = pemasok.kode_pemasok INNER JOIN admin ON beli.kode_admin = admin.kode_admin INNER JOIN barang ON barang.kode_barang = detail_beli.kode_barang ORDER BY beli.kode_beli ASC");

}

$nama_admin = query("SELECT * FROM admin WHERE kode_admin = '$_SESSION[kode_admin]' ");

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>APLIKASI PEMBELIAN BARANG</title>

        <!-- Bootstrap Core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../css/metisMenu.min.css" rel="stylesheet">

        <!-- DataTables CSS -->
        <link href="../css/dataTables/dataTables.bootstrap.css" rel="stylesheet">

        <!-- DataTables Responsive CSS -->
        <link href="../css/dataTables/dataTables.responsive.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../css/startmin.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <link href="../css/datepicker.css" rel="stylesheet" >

        <link rel="shorcut icon" href="../img/pembelian.png">

        <style type="text/css">
            .navbar-inverse {
                background-color: #337ab7;
                border-color: blue;
            }
            li a:hover {
                color: blue;
                text-decoration: none;
            }
            .navbar-header a{
                font-weight: bold;
            }
        </style>
    </head>
    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" >
                <div class="navbar-header">
                    <a class="navbar-brand" style="color:white;" href="#">APLIKASI PEMBELIAN BARANG</a>
                </div>


                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <ul class="nav navbar-right navbar-top-links">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color:white;">
                            <i class="fa fa-user fa-fw"></i>
                                <?php foreach ($nama_admin as $row) : ?>
                                    <?php echo $row["nama"]; ?>
                                <?php endforeach; ?>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="admin_edit.php"><i class="fa fa-user fa-fw"></i> Edit Profil</a>
                            </li>
                            <li><a href="admin_edit_password.php"><i class="fa fa-gear fa-fw"></i> Ganti Password</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li>
                                <a href="index.php"><i class="fa fa-home fa-fw"></i> Dashboard</a>
                            </li>
                            <li>
                                <a href="admin.php"><i class="fa fa-user fa-fw"></i> Data Admin</a>
                            </li>
                            <li>
                                <a href="pemasok.php" ><i class="fa fa-truck fa-fw"></i> Data Pemasok</a>
                            </li>
                            <li>
                                <a href="barang.php"><i class="fa fa-briefcase fa-fw"></i> Data Barang</a>
                            </li>
                            <li>
                                <a href="pembelian.php"><i class="fa fa-money fa-fw"></i> Data Pembelian</a>
                            </li>
                            <li>
                                <a href="transaksi.php"><i class="fa fa-weixin fa-fw"></i> Transaksi</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-print fa-fw"></i> Laporan<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="admin_laporan.php" target="_blank">Laporan Data Admin</a>
                                    </li>
                                    <li>
                                        <a href="pemasok_laporan.php" target="_blank">Laporan Data Pemasok</a>
                                    </li>
                                    <li>
                                        <a href="barang_laporan.php" target="_blank">Laporan Data Barang</a>
                                    </li>
                                    <li>
                                        <a href="pembelian_laporan_cetak.php" class="active">Laporan Data Pembelian</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header"><i class="fa fa-print fa-fw"></i> Laporan Data Pembelian</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <form action="pembelian_laporan.php" method="post" target = "_blank">

                                          <div class="col-lg-6">
                                          <label for="tanggal_awal">Tanggal Awal</label>
                                          <input type="text" class="form-control datepicker" id="tanggal_awal" name="tanggal_awal" placeholder="Masukkan tanggal awal" value="<?php if (isset($_POST['tanggal_awal'])) echo $_POST['tanggal_awal'];?>" autocomplete="off" required>
                                          </div>

                                          <div class="col-lg-6">
                                          <label for="tanggal_akhir">Tanggal Akhir</label>
                                          <input type="text" class="form-control datepicker" id="tanggal_akhir" name="tanggal_akhir" placeholder="Masukkan tanggal akhir" value="<?php if (isset($_POST['tanggal_akhir'])) echo $_POST['tanggal_akhir'];?>" autocomplete="off" required>
                                          <br>
                                          </div>

                                          <div class="col-lg-6">
                                        
                                          <button type="submit" name="cetak_pembelian_tanggal" class="btn btn-success">
                                          <i class="fa fa-print"></i> Cetak Pertanggal
                                          </button>

                                          <a href="pembelian_laporan.php" target="_blank">
                                          <button type="button" name="cetak_pembelian" class="btn btn-danger">
                                          <i class="fa fa-print"></i> Cetak Pembelian
                                          </button>
                                          </a>

                                          </div>

                                    </form>
                                </div>
                  </div>                <!-- /.table-responsive -->
            </div>

             <!-- jQuery -->
        <script src="../js/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="../js/metisMenu.min.js"></script>

        <!-- DataTables JavaScript -->
        <script src="../js/dataTables/jquery.dataTables.min.js"></script>
        <script src="../js/dataTables/dataTables.bootstrap.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="../js/startmin.js"></script>

        <!-- Page-Level Demo Scripts - Tables - Use for reference -->
        <script>
            $(document).ready(function() {
                $('#dataTables-example').DataTable({
                        responsive: true
                });
            });
        </script>

        <script src="../js/bootstrap-datepicker.js"></script>

        <script type="text/javascript">
            $(function(){
                $(".datepicker").datepicker({
                    format: 'dd-mm-yyyy',
                    autoclose: true,
                    todayHighlight: false,
                });
                $("#tanggal_awal").on('changeDate', function(selected) {
                    var startDate = new Date(selected.date.valueOf());
                    $("#tanggal_akhir").datepicker('setStartDate', startDate);
                    if($("#tanggal_awal").val() > $("#tanggal_awal").val()){
                        $("#tanggal_akhir").val($("#tanggal_awal").val());
                    }
                });
            });
        </script>

    </body>
	
</html>
