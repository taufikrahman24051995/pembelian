-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Apr 2021 pada 14.23
-- Versi server: 10.1.36-MariaDB
-- Versi PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pembelian`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `kode_admin` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`kode_admin`, `nama`, `username`, `password`) VALUES
('ADM001', 'Taufik', 'taufikrahman', '$2y$10$Qz6UJQjxBsJlB4NQScN6JenslTo0ih8JBFdLJ0aUOrUGIzXCqv9O.'),
('ADM002', 'Novian Hidayat', 'novian', '$2y$10$uNxH/kDXGKKOPj3H95aU8OJKv4rodWVRj3rCOYhQ9QV32gcEZLa/i'),
('ADM003', 'Rolanski Programing', 'rolanski', '$2y$10$DLoeTqt/ZhMOkxoLwVdYwuR6QXuxVab2RJCsq61z3yb688lHY3k0m'),
('ADM004', 'Nimatol', 'nimatol', '$2y$10$rNMAx5tToJq8gCtC927Vbu3gLSms.fdHS1bOl0cBy/Gk40pSMAQyG');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `kode_barang` varchar(50) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga` varchar(50) NOT NULL,
  `stok` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`kode_barang`, `nama_barang`, `harga`, `stok`) VALUES
('BRG001', 'Printer Canon 287', '1200000', '6'),
('BRG002', 'Printer Canon 237', '1000000', '3'),
('BRG003', 'Printer Epson L120', '1400000', '2'),
('BRG004', 'Printer Epson L3110', '1800000', '1'),
('BRG005', 'Printer Epson L310', '1700000', '4'),
('BRG006', 'Printer Canon IP2772', '800000', '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `beli`
--

CREATE TABLE `beli` (
  `kode_beli` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `kode_admin` varchar(50) NOT NULL,
  `kode_pemasok` varchar(50) NOT NULL,
  `total` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `beli`
--

INSERT INTO `beli` (`kode_beli`, `tanggal`, `kode_admin`, `kode_pemasok`, `total`) VALUES
('BELI000000001', '2021-04-04', 'ADM002', 'PMS001', '1800000'),
('BELI000000002', '2021-04-04', 'ADM002', 'PMS001', '1700000'),
('BELI000000003', '2021-04-04', 'ADM002', 'PMS002', '800000'),
('BELI000000004', '2021-04-04', 'ADM002', 'PMS001', '800000'),
('BELI000000005', '2021-04-04', 'ADM002', 'PMS001', '1200000'),
('BELI000000006', '2021-04-04', 'ADM002', 'PMS001', '1000000'),
('BELI000000007', '2021-04-04', 'ADM002', 'PMS003', '1700000'),
('BELI000000008', '2021-04-04', 'ADM002', 'PMS001', '1400000'),
('BELI000000009', '2021-04-04', 'ADM002', 'PMS001', '1200000'),
('BELI000000010', '2021-04-04', 'ADM002', 'PMS001', '1000000'),
('BELI000000011', '2021-04-04', 'ADM002', 'PMS001', '2400000'),
('BELI000000012', '2021-04-04', 'ADM002', 'PMS001', '1700000'),
('BELI000000013', '2021-04-04', 'ADM002', 'PMS005', '1400000'),
('BELI000000014', '2021-04-04', 'ADM002', 'PMS002', '1000000'),
('BELI000000015', '2021-04-05', 'ADM002', 'PMS001', '1700000'),
('BELI000000016', '2021-04-16', 'ADM002', 'PMS001', '1200000'),
('BELI000000017', '2021-04-08', 'ADM001', 'PMS003', '1200000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_beli`
--

CREATE TABLE `detail_beli` (
  `kode_beli` varchar(50) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `harga` int(50) NOT NULL,
  `jumlah` int(50) NOT NULL,
  `subtotal` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_beli`
--

INSERT INTO `detail_beli` (`kode_beli`, `kode_barang`, `harga`, `jumlah`, `subtotal`) VALUES
('BELI000000001', 'BRG004', 1800000, 1, 1800000),
('BELI000000002', 'BRG005', 1700000, 1, 1700000),
('BELI000000003', 'BRG006', 800000, 1, 800000),
('BELI000000004', 'BRG006', 800000, 1, 800000),
('BELI000000005', 'BRG001', 1200000, 1, 1200000),
('BELI000000006', 'BRG002', 1000000, 1, 1000000),
('BELI000000007', 'BRG005', 1700000, 1, 1700000),
('BELI000000008', 'BRG003', 1400000, 1, 1400000),
('BELI000000009', 'BRG001', 1200000, 1, 1200000),
('BELI000000010', 'BRG002', 1000000, 1, 1000000),
('BELI000000011', 'BRG001', 1200000, 2, 2400000),
('BELI000000012', 'BRG005', 1700000, 1, 1700000),
('BELI000000013', 'BRG003', 1400000, 1, 1400000),
('BELI000000014', 'BRG002', 1000000, 1, 1000000),
('BELI000000015', 'BRG005', 1700000, 1, 1700000),
('BELI000000016', 'BRG001', 1200000, 1, 1200000),
('BELI000000017', 'BRG001', 1200000, 1, 1200000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `kode_beli` varchar(50) NOT NULL,
  `kode_admin` varchar(50) NOT NULL,
  `kode_pemasok` varchar(50) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `harga` int(50) NOT NULL,
  `jumlah` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemasok`
--

CREATE TABLE `pemasok` (
  `kode_pemasok` varchar(50) NOT NULL,
  `nama_pemasok` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pemasok`
--

INSERT INTO `pemasok` (`kode_pemasok`, `nama_pemasok`, `alamat`, `telepon`) VALUES
('PMS001', 'PT Buana Putra', 'Jl. Banua Saringga no 37', '085251602837'),
('PMS002', 'PT Cakra Anggara', 'Jl. Pokda no. 14', '087886456765'),
('PMS003', 'PT Mandala Krida', 'Jl. Linggapati', '085751105654'),
('PMS004', 'PT Nusantara Jaya', 'Jl. Tarumanegara', '085345607985'),
('PMS005', 'PT Sarina Narada', 'Jl. Kertanegara no. 78', '081667657879'),
('PMS006', 'PT Ekalaya Jaya', 'Jl. Bina Putra No.17', '085245676576');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`kode_admin`);

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kode_barang`);

--
-- Indeks untuk tabel `beli`
--
ALTER TABLE `beli`
  ADD PRIMARY KEY (`kode_beli`);

--
-- Indeks untuk tabel `detail_beli`
--
ALTER TABLE `detail_beli`
  ADD PRIMARY KEY (`kode_beli`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`kode_beli`);

--
-- Indeks untuk tabel `pemasok`
--
ALTER TABLE `pemasok`
  ADD PRIMARY KEY (`kode_pemasok`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
