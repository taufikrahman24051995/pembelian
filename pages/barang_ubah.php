<?php

session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location:login.php");
    exit;
}

require 'functions.php';

// ambil data di URL
$kode_barang = $_GET["kode_barang"];
// query data mahasiswa berdasarkan id
$barang = query("SELECT * FROM barang WHERE kode_barang = '$kode_barang'")[0];

// cek apakah tombol submit sudah ditekan atau belum
if( isset($_POST["ubah_barang"]) ) {

    // cek apakah data berhasil diubah atau tidak
    if( ubahBarang($_POST) > 0) {
        echo "
            <script>
                alert('Data Barang Berhasil Diubah');
                document.location.href = 'barang.php';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('Data Barang Gagal Diubah');
                document.location.href = 'barang.php';
            </script>
            ";
    }
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

        <!-- Timeline CSS -->
        <link href="../css/timeline.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../css/startmin.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="../css/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">

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
                            <li>
                                <a href="admin_edit.php"><i class="fa fa-user fa-fw"></i> Edit Profil</a>
                            </li>
                            <li>
                                <a href="admin_edit_password.php"><i class="fa fa-gear fa-fw"></i> Ganti Password</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
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
                                <a href="pemasok.php"><i class="fa fa-truck fa-fw"></i> Data Pemasok</a>
                            </li>
                            <li>
                                <a href="barang.php"  class="active"><i class="fa fa-briefcase fa-fw"></i> Data Barang</a>
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
                                        <a href="pembelian_laporan_cetak.php">Laporan Data Pembelian</a>
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
                	<form action="" method="post">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header"><i class="fa fa-briefcase fa-fw"></i> Ubah Data Barang</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                     <div class="form-group">
						<label for="kode_barang">Kode Barang</label>
						<input class="form-control" placeholder="Kode Barang" name="kode_barang" id="kode_barang" value="<?php echo $barang["kode_barang"] ?>" readonly>
					</div>
					<div class="form-group">
						<label for="nama_barang">Nama Barang</label>
						<input class="form-control" placeholder="Nama Barang" name="nama_barang" id="nama_barang" value="<?php echo $barang["nama_barang"] ?>" autocomplete="off" autofocus required>
					</div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" class="form-control" placeholder="Harga" name="harga" id="harga" value="<?php echo $barang["harga"] ?>" autocomplete="off" required>
                    </div>
					<div class="form-group">
						<label for="stok">Stok</label>
						<input class="form-control" placeholder="Stok" name="stok" id="stok" value="<?php echo $barang["stok"] ?>" readonly>
					</div>
					<button type="submit" class="btn btn-primary" name="ubah_barang">Ubah Barang</button>
                    </form>
				</div>
        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->
        <script src="../js/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="../js/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="../js/startmin.js"></script>

    </body>
</html>
