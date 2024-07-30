<?php 

session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location:login.php");
    exit;
}

require 'functions.php';

// fungsi untuk mendapatkan isi keranjang belanja
function isi_keranjang($koneksi) {
	$isikeranjang = array();
	$sql = mysqli_query($koneksi, "SELECT * FROM keranjang WHERE kode_admin ='$_SESSION[kode_admin]'");
	
	while ($r = mysqli_fetch_array($sql) ) {
		$isikeranjang[] = $r;
	}
	return $isikeranjang;
}  

$tgl_skrg = date("Ymd");

// panggil fungsi isi_keranjang dan hitung jumlah produk yang dipesan
$isikeranjang = isi_keranjang($koneksi);
$jml          = count($isikeranjang);

// simpan data detail pemesanan  
for ($i = 0; $i < $jml; $i++){
	$kode_beli = $isikeranjang[$i]['kode_beli'];
	$kode_admin = $isikeranjang[$i]['kode_admin'];
	$kode_pemasok = $isikeranjang[$i]['kode_pemasok'];
	$total = $isikeranjang[$i]['jumlah'] * $isikeranjang[$i]['harga'];
  	mysqli_query($koneksi, "INSERT INTO beli(kode_beli, kode_admin, kode_pemasok, total, tanggal) VALUES ('{$kode_beli}', '{$kode_admin}', '{$kode_pemasok}', {$total}, '{$tgl_skrg}')");
}

// simpan data detail pemesanan  
for ($i = 0; $i < $jml; $i++){
	$kode_beli = $isikeranjang[$i]['kode_beli'];
	$kode_barang = $isikeranjang[$i]['kode_barang'];
	$kode_pemasok = $isikeranjang[$i]['kode_pemasok'];
	$harga = $isikeranjang[$i]['harga'];
	$jumlah = $isikeranjang[$i]['jumlah'];
	$total = $isikeranjang[$i]['jumlah'] * $isikeranjang[$i]['harga'];
  	mysqli_query($koneksi, "INSERT INTO detail_beli(kode_beli, kode_barang, harga, jumlah, subtotal) VALUES ('{$kode_beli}', '{$kode_barang}', {$harga}, {$jumlah}, {$total})");
}

	//di cek dulu apakah barang yang di beli sudah ada di tabel barang
for ($i = 0; $i < $jml; $i++) {
	$kode_barang = $isikeranjang[$i]['kode_barang'];
	$jumlah = $isikeranjang[$i]['jumlah'];
    mysqli_query($koneksi, "UPDATE barang
            SET stok = stok + $jumlah
            WHERE kode_barang = '$kode_barang'");     
}

// setelah data pemesanan tersimpan, hapus data pemesanan di tabel keranjang
for ($i = 0; $i < $jml; $i++) {
	mysqli_query($koneksi, "DELETE FROM keranjang WHERE kode_beli = '{$isikeranjang[$i]['kode_beli']}'");
}

			echo "<script>
				alert('Data berhasil dibeli');
				document.location.href = 'pembelian.php';
			</script>";
?>