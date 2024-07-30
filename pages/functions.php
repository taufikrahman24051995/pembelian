<?php 

// koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "pembelian");

function query ($query) {
	global $koneksi;
	$result = mysqli_query ($koneksi, $query);
	$rows = [];
	while ( $row = mysqli_fetch_assoc ($result)) {
		$rows [] = $row;
	}
	return $rows;
}

function tambahAdmin ($data) {
	global $koneksi;

	$kode_admin = htmlspecialchars($data["kode_admin"]);
	$nama = htmlspecialchars($data["nama"]);
	$username = strtolower(stripslashes($data["username"]));
	$password = mysqli_real_escape_string($koneksi, $data["password"]);
	$password2 = mysqli_real_escape_string($koneksi, $data["password2"]);

	// cek username sudah ada atau belum
	$result = mysqli_query($koneksi, "SELECT username FROM admin WHERE username = '$username'");

	if (mysqli_fetch_assoc($result) ) {
		echo "<script>
				alert ('Username sudah terdaftar');
			  </script>";

		return false;
	}

	// cek konfirmasi password
	if ( $password !== $password2) {
		echo "<script>
				alert ('Konfirmasi password tidak sesuai');
			  </script>";

		return false;
	}

	// enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);

	// tambahkan user baru ke database
	mysqli_query($koneksi, "INSERT INTO admin VALUES ('$kode_admin', '$nama', '$username', '$password')");

	return mysqli_affected_rows($koneksi);
}

function editAdmin($data) {
	global $koneksi;

	$kode_admin = htmlspecialchars($data["kode_admin"]);
	$nama = htmlspecialchars($data["nama"]);
	$username = strtolower(stripslashes($data["username"]));
	
	$query = "UPDATE admin SET kode_admin = '$kode_admin', nama = '$nama', username = '$username' WHERE kode_admin = '$kode_admin' ";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);

}

function editPasswordAdmin($data) {
	global $koneksi;

	$password_lama = mysqli_real_escape_string($koneksi, $data["password_lama"]);
	$password_baru = mysqli_real_escape_string($koneksi, $data["password_baru"]);
	$password_baru2 = mysqli_real_escape_string($koneksi, $data["password_baru2"]);

	// cek password sudah ada atau belum
	$result = mysqli_query($koneksi, "SELECT * FROM admin WHERE kode_admin = '$_SESSION[kode_admin]' ");
	$data = mysqli_fetch_array($result);

    // cek password
   	$pass = password_verify($password_lama, $data['password']);

   	if ($pass === TRUE) {
        
        	// cek konfirmasi password
			if ( $password_baru !== $password_baru2) {
				echo "<script>
						alert ('Konfirmasi password tidak sesuai');
					  </script>";

				return false;
			}

			// enkripsi password
			$password_baru = password_hash($password_baru, PASSWORD_DEFAULT);
			
			$query = "UPDATE admin SET password = '$password_baru' WHERE kode_admin = '$_SESSION[kode_admin]' ";
			mysqli_query($koneksi, $query);

			return mysqli_affected_rows($koneksi);

	}
}

function tambahPemasok ($data) {
	global $koneksi;

	$kode_pemasok = htmlspecialchars($data["kode_pemasok"]);
	$nama_pemasok = htmlspecialchars($data["nama_pemasok"]);
	$alamat = htmlspecialchars($data["alamat"]);
	$telepon = htmlspecialchars($data["telepon"]);

	$query = "INSERT INTO pemasok VALUES ('$kode_pemasok', '$nama_pemasok', '$alamat', '$telepon')";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function hapusPemasok($kode_pemasok) {
	global $koneksi;
	mysqli_query ($koneksi, "DELETE FROM pemasok WHERE kode_pemasok='$kode_pemasok'");
	
	return mysqli_affected_rows($koneksi);
}

function ubahPemasok($data) {
	global $koneksi;

	$kode_pemasok = htmlspecialchars($data["kode_pemasok"]);
	$nama_pemasok = htmlspecialchars($data["nama_pemasok"]);
	$alamat = htmlspecialchars($data["alamat"]);
	$telepon = htmlspecialchars($data["telepon"]);
	
	$query = "UPDATE pemasok SET kode_pemasok = '$kode_pemasok', nama_pemasok = '$nama_pemasok', alamat = '$alamat', telepon = '$telepon' WHERE kode_pemasok = '$kode_pemasok' ";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function tambahBarang ($data) {
	global $koneksi;

	$kode_barang = htmlspecialchars($data["kode_barang"]);
	$nama_barang = htmlspecialchars($data["nama_barang"]);
	$harga = htmlspecialchars($data["harga"]);
	$stok = htmlspecialchars($data["stok"]);

	$query = "INSERT INTO barang VALUES ('$kode_barang', '$nama_barang', '$harga', '$stok')";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function hapusBarang($kode_barang) {
	global $koneksi;
	mysqli_query ($koneksi, "DELETE FROM barang WHERE kode_barang='$kode_barang'");
	
	return mysqli_affected_rows($koneksi);
}

function ubahBarang($data) {
	global $koneksi;

	$kode_barang = htmlspecialchars($data["kode_barang"]);
	$nama_barang = htmlspecialchars($data["nama_barang"]);
	$harga = htmlspecialchars($data["harga"]);
	$stok = htmlspecialchars($data["stok"]);
	
	$query = "UPDATE barang SET kode_barang = '$kode_barang', nama_barang = '$nama_barang', harga = '$harga', stok = '$stok' WHERE kode_barang = '$kode_barang' ";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function rupiah($angka) {
	$hasil_rupiah = number_format($angka,2,',','.');
	return $hasil_rupiah;
}

function tambahKeranjang($data) {
	global $koneksi;

	$kode_beli = htmlspecialchars($data["kode_beli"]);
	$kode_admin = htmlspecialchars($_SESSION["kode_admin"]);
	$kode_pemasok = htmlspecialchars($data["nama_pemasok"]);
	$kode_barang = htmlspecialchars($data["nama_barang"]);
	$harga = htmlspecialchars($data["harga"]);
	$jumlah = htmlspecialchars($data["jumlah"]);
 
	//di cek dulu apakah barang yang di beli sudah ada di tabel keranjang
	$sql = mysqli_query($koneksi, "SELECT * FROM keranjang WHERE kode_barang = '$kode_barang' AND kode_admin = '$_SESSION[kode_admin]' ");
    $ketemu = mysqli_num_rows($sql);
    if ($ketemu === 0){
        // kalau barang belum ada, maka di jalankan perintah insert
        mysqli_query($koneksi, "INSERT INTO keranjang (kode_beli, kode_admin, kode_pemasok, kode_barang, harga, jumlah)
                VALUES ('$kode_beli', '$kode_admin', '$kode_pemasok', '$kode_barang', '$harga', '$jumlah')");
    } else {
        //  kalau barang ada, maka di jalankan perintah update
        mysqli_query($koneksi, "UPDATE keranjang
                SET jumlah = jumlah + $jumlah
                WHERE kode_barang = '$kode_barang' AND kode_admin = '$_SESSION[kode_admin]' ");       
    }   

	return mysqli_affected_rows($koneksi);
}

function hapusKeranjang($kode_beli) {
	global $koneksi;
	mysqli_query ($koneksi, "DELETE FROM keranjang WHERE kode_beli='$kode_beli'");
	
	return mysqli_affected_rows($koneksi);
}

?>



                                        