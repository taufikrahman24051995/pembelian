<?php 

session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location:login.php");
    exit;
}

require 'functions.php';

$admin = query("SELECT * FROM admin");

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

        <link rel="stylesheet" type="text/css" href="../css/style.css">

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
                                <a href="pemasok.php"><i class="fa fa-truck fa-fw"></i> Data Pemasok</a>
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
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header"><i class="fa fa-user fa-fw"></i> Data Admin</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <a href="admin_input.php"><button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Input Admin</button></a>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th><div align="center">No</div></th>
                                                    <th><div align="center">Kode Admin</div></th>
                                                    <th><div align="center">Nama Admin</div></th>
                                                    <th><div align="center">Username</div></th>
                                                    <th><div align="center">Password</div></th>
                                                </tr>
                                            </thead>

                                            <?php $i = 1; ?>
                                            <?php foreach ($admin as $row) : ?>

                                            <tr>
                                                <td align="center"><?php echo $i; ?></td>
                                                <td align="center"><?php echo $row["kode_admin"]; ?></td>
                                                <td align="center"><?php echo $row["nama"]; ?></td>
                                                <td align="center"><?php echo $row["username"]; ?></td>
                                                <td align="center">Password tidak ditampilkan</td>
                                            </tr>

                                            <?php $i++; ?>
                                            <?php endforeach; ?>

                                        </table>
                                    </div>
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


    </body>
	
</html>
