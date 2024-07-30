<?php

session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location:login.php");
    exit;
}

require 'functions.php';

$kode_pemasok = $_GET["kode_pemasok"];

if ( hapusPemasok($kode_pemasok) > 0) {
		echo "
			<script>
				alert('Data pemasok berhasil dihapus');
				document.location.href = 'pemasok.php';
			</script>
			";
	} else {
		echo "
			<script>
				alert('Data pemasok gagal dihapus');
				document.location.href = 'pemasok.php';
			</script>
			";
	}

?>