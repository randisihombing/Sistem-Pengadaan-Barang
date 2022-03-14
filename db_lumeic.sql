-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 17 Nov 2021 pada 20.08
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_lumeic`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `barang_id` int(11) NOT NULL,
  `kode_barang` varchar(200) NOT NULL,
  `kode_kat` varchar(200) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `harga` decimal(50,2) NOT NULL,
  `stock` varchar(200) NOT NULL,
  `created_by` varchar(200) NOT NULL,
  `created_date` date NOT NULL,
  `modified_by` varchar(200) NOT NULL,
  `modified_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`barang_id`, `kode_barang`, `kode_kat`, `nama`, `harga`, `stock`, `created_by`, `created_date`, `modified_by`, `modified_date`) VALUES
(1, 'KB001', 'KT001', 'Testing', '500000.00', '91', '', '2021-09-30', '', '0000-00-00'),
(2, 'KB002', 'KT001', 'Panci', '1000.00', '72843', 'admin', '2021-09-30', 'admin', '2021-09-30'),
(4, 'KB003', 'KB002', 'Wajan', '150000.00', '1', 'admin', '2021-10-15', 'admin', '2021-10-15'),
(5, 'ST001', 'ST', 'MOUNTING MODUL', '20000.00', '904', 'admin', '2021-11-18', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `kategori_id` int(11) NOT NULL,
  `kode_kat` varchar(200) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `created_by` varchar(200) NOT NULL,
  `created_date` date NOT NULL,
  `modified_by` varchar(200) NOT NULL,
  `modified_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`kategori_id`, `kode_kat`, `nama`, `created_by`, `created_date`, `modified_by`, `modified_date`) VALUES
(1, 'KT001', 'Tester', 'admin', '2021-09-09', '', '0000-00-00'),
(2, 'KB002', 'Besi', 'admin', '2021-09-30', '', '0000-00-00'),
(3, 'ST', 'STAINLESS', 'admin', '2021-11-18', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `cart_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `harga` decimal(50,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `created_by` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang_pesanan`
--

CREATE TABLE `keranjang_pesanan` (
  `keranjang_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `created_by` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `pesanan_id` int(11) NOT NULL,
  `no_psn` varchar(128) NOT NULL,
  `no_surat` varchar(128) NOT NULL,
  `alamat_psn` varchar(128) NOT NULL,
  `nama_psn` varchar(128) NOT NULL,
  `ppn` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `total_akhir` int(11) NOT NULL,
  `tgl_psn` date NOT NULL,
  `created_by` varchar(128) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` varchar(128) NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`pesanan_id`, `no_psn`, `no_surat`, `alamat_psn`, `nama_psn`, `ppn`, `total_harga`, `total_akhir`, `tgl_psn`, `created_by`, `created_date`, `modified_by`, `modified_date`) VALUES
(23, 'PS2111140001', '5', 'u', 'lll', 50000, 500000, 550000, '2021-11-14', 'admin', '2021-11-14 23:15:53', '', '0000-00-00 00:00:00'),
(24, 'PS2111140002', '123d1', 'asdwwwwwwwww', 'asdw', 300, 3000, 3300, '2021-11-14', 'admin', '2021-11-14 23:18:22', '', '0000-00-00 00:00:00'),
(25, 'PS2111180001', '999288829', 'Ciamis', 'PT.Lingkar Jaya', 500000, 5000000, 5500000, '2021-11-18', 'admin', '2021-11-18 00:01:38', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan_detail`
--

CREATE TABLE `pesanan_detail` (
  `detailpsn_id` int(11) NOT NULL,
  `pesanan_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pesanan_detail`
--

INSERT INTO `pesanan_detail` (`detailpsn_id`, `pesanan_id`, `barang_id`, `harga`, `qty`, `total`, `status`) VALUES
(37, 23, 1, 500000, 1, 500000, 'approve'),
(38, 24, 2, 1000, 3, 3000, 'approve'),
(39, 25, 1, 500000, 10, 5000000, 'approve');

--
-- Trigger `pesanan_detail`
--
DELIMITER $$
CREATE TRIGGER `stock_berkurang` AFTER INSERT ON `pesanan_detail` FOR EACH ROW BEGIN
	UPDATE barang SET stock = stock - NEW.qty
    WHERE barang_id = NEW.barang_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sph`
--

CREATE TABLE `sph` (
  `sph_id` int(11) NOT NULL,
  `no_pesanan` varchar(128) NOT NULL,
  `no_surat` varchar(128) NOT NULL,
  `alamat_cust` varchar(128) NOT NULL,
  `jabatan_cust` varchar(128) NOT NULL,
  `nm_cust` varchar(128) NOT NULL,
  `surat_cust` varchar(128) NOT NULL,
  `tanggal_surat` date NOT NULL,
  `created_by` varchar(128) NOT NULL,
  `created_date` date NOT NULL,
  `modified_by` varchar(128) NOT NULL,
  `modified_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sph`
--

INSERT INTO `sph` (`sph_id`, `no_pesanan`, `no_surat`, `alamat_cust`, `jabatan_cust`, `nm_cust`, `surat_cust`, `tanggal_surat`, `created_by`, `created_date`, `modified_by`, `modified_date`) VALUES
(13, 'LM2110290002', '123456', 'Cimahi, Jl. Probolinggo No. 666, Pangalengan', 'Testing', 'Coba 1', '112233', '2021-10-29', 'admin', '2021-10-29', '', '0000-00-00'),
(15, 'LM2111090001', '12123131', 'fsdfsefsdf', 'sdfsdfes', 'ssdfsdf', '312312222', '2021-11-09', 'admin', '2021-11-09', '', '0000-00-00'),
(21, 'LM2111110001', '222322112', 'Cimahi', 'Direktur', 'Pa Fikar', 'Burhan', '2021-11-11', 'admin', '2021-11-11', '', '0000-00-00'),
(25, 'LM2111140001', 'XYZ/11', 'WW', 'Want', 'Wey', '123r1r12', '2021-11-14', 'admin', '2021-11-14', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sph_detail`
--

CREATE TABLE `sph_detail` (
  `detail_id` int(11) NOT NULL,
  `sph_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sph_detail`
--

INSERT INTO `sph_detail` (`detail_id`, `sph_id`, `barang_id`, `harga`, `qty`) VALUES
(17, 13, 1, 500000, 1),
(18, 13, 2, 1000, 1),
(19, 13, 4, 150000, 1),
(23, 15, 2, 1000, 1),
(29, 21, 1, 500000, 5),
(30, 21, 2, 1000, 4),
(35, 25, 1, 500000, 2),
(36, 25, 2, 1000, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock`
--

CREATE TABLE `stock` (
  `stock_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `tipe` enum('masuk','keluar') NOT NULL,
  `keterangan` varchar(256) NOT NULL,
  `qty` int(10) NOT NULL,
  `gambar` varchar(128) NOT NULL,
  `created_by` varchar(200) NOT NULL,
  `created_date` date NOT NULL,
  `modified_by` varchar(200) NOT NULL,
  `modified_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `stock`
--

INSERT INTO `stock` (`stock_id`, `barang_id`, `tipe`, `keterangan`, `qty`, `gambar`, `created_by`, `created_date`, `modified_by`, `modified_date`) VALUES
(37, 5, 'masuk', 'By Panji', 100, '', 'admin', '2021-11-18', '', '0000-00-00'),
(38, 5, 'masuk', 'By Panji', 100, '', 'admin', '2021-11-18', '', '0000-00-00'),
(39, 5, 'masuk', 'By Panji', 100, '', 'admin', '2021-11-18', '', '0000-00-00'),
(40, 5, 'masuk', 'By Panji', 100, '', 'admin', '2021-11-18', '', '0000-00-00'),
(41, 5, 'masuk', 'By Panji', 100, '', 'admin', '2021-11-18', '', '0000-00-00'),
(42, 5, 'masuk', 'By Panji', 100, '', 'admin', '2021-11-18', '', '0000-00-00'),
(43, 5, 'masuk', 'By Panji', 100, '', 'admin', '2021-11-18', '', '0000-00-00'),
(44, 5, 'masuk', 'By Panji', 100, '', 'admin', '2021-11-18', '', '0000-00-00'),
(45, 5, 'masuk', 'By Panji', 100, '', 'admin', '2021-11-18', '', '0000-00-00'),
(46, 5, 'masuk', 'Masuk', 1, '', 'admin', '2021-11-18', '', '0000-00-00'),
(47, 5, 'masuk', 'Masuk', 1, '', 'admin', '2021-11-18', '', '0000-00-00'),
(48, 5, 'masuk', 'Masuk', 1, '', 'admin', '2021-11-18', '', '0000-00-00'),
(49, 5, 'masuk', 'Masuk', 1, '$', 'admin', '2021-11-18', '', '0000-00-00'),
(50, 0, 'masuk', 'sdad', 2131, '', 'admin', '2021-11-18', '', '0000-00-00'),
(51, 2, 'masuk', 'sdad', 2131, '', 'admin', '2021-11-18', '', '0000-00-00'),
(52, 2, 'masuk', 'sdad', 2131, '', 'admin', '2021-11-18', '', '0000-00-00'),
(53, 2, 'masuk', 'sdad', 2131, '', 'admin', '2021-11-18', '', '0000-00-00'),
(54, 2, 'masuk', 'sdad', 2131, '', 'admin', '2021-11-18', '', '0000-00-00'),
(55, 2, 'masuk', 'sad', 21313, '', 'admin', '2021-11-18', '', '0000-00-00'),
(56, 2, 'masuk', 'sad', 21313, '', 'admin', '2021-11-18', '', '0000-00-00'),
(57, 2, 'masuk', 'sad', 21313, '', 'admin', '2021-11-18', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_jalan`
--

CREATE TABLE `surat_jalan` (
  `surat_jln_id` int(11) NOT NULL,
  `no_surat_jln` varchar(128) NOT NULL,
  `pesanan_id` int(11) NOT NULL,
  `created_by` varchar(128) NOT NULL,
  `created_date` date NOT NULL,
  `modified_by` varchar(128) NOT NULL,
  `modified_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `surat_jalan`
--

INSERT INTO `surat_jalan` (`surat_jln_id`, `no_surat_jln`, `pesanan_id`, `created_by`, `created_date`, `modified_by`, `modified_date`) VALUES
(22, '8899', 23, 'admin', '2021-11-18', '', '0000-00-00'),
(23, '678678', 24, 'admin', '2021-11-18', '', '0000-00-00'),
(24, '888888', 25, 'admin', '2021-11-18', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tagihan`
--

CREATE TABLE `tagihan` (
  `tagihan_id` int(11) NOT NULL,
  `pesanan_id` int(11) NOT NULL,
  `no_tagihan` varchar(128) NOT NULL,
  `created_by` varchar(128) NOT NULL,
  `created_date` date NOT NULL,
  `modified_by` varchar(128) NOT NULL,
  `modified_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tagihan`
--

INSERT INTO `tagihan` (`tagihan_id`, `pesanan_id`, `no_tagihan`, `created_by`, `created_date`, `modified_by`, `modified_date`) VALUES
(13, 25, '9999', 'admin', '2021-11-18', '', '0000-00-00'),
(14, 24, '809809809', 'admin', '2021-11-18', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `telp` varchar(200) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `role` varchar(50) NOT NULL,
  `created_by` varchar(200) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` varchar(200) NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`username`, `password`, `nama`, `telp`, `alamat`, `role`, `created_by`, `created_date`, `modified_by`, `modified_date`) VALUES
('admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin', '-', '-', 'admin', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('direktur', 'ef55c764d670377f3b24cf6d065252f06ee031c5', 'Direktur', '088808551211', 'Bandung', 'direktur', 'admin', '2021-11-09 02:03:27', 'admin', '2021-11-09 02:03:27');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`barang_id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `barang_id` (`barang_id`);

--
-- Indeks untuk tabel `keranjang_pesanan`
--
ALTER TABLE `keranjang_pesanan`
  ADD PRIMARY KEY (`keranjang_id`),
  ADD KEY `barang_id` (`barang_id`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`pesanan_id`);

--
-- Indeks untuk tabel `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  ADD PRIMARY KEY (`detailpsn_id`),
  ADD KEY `pesanan_id` (`pesanan_id`);

--
-- Indeks untuk tabel `sph`
--
ALTER TABLE `sph`
  ADD PRIMARY KEY (`sph_id`);

--
-- Indeks untuk tabel `sph_detail`
--
ALTER TABLE `sph_detail`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `sph_id` (`sph_id`);

--
-- Indeks untuk tabel `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indeks untuk tabel `surat_jalan`
--
ALTER TABLE `surat_jalan`
  ADD PRIMARY KEY (`surat_jln_id`);

--
-- Indeks untuk tabel `tagihan`
--
ALTER TABLE `tagihan`
  ADD PRIMARY KEY (`tagihan_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `keranjang_pesanan`
--
ALTER TABLE `keranjang_pesanan`
  MODIFY `keranjang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `pesanan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  MODIFY `detailpsn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `sph`
--
ALTER TABLE `sph`
  MODIFY `sph_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `sph_detail`
--
ALTER TABLE `sph_detail`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `stock`
--
ALTER TABLE `stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT untuk tabel `surat_jalan`
--
ALTER TABLE `surat_jalan`
  MODIFY `surat_jln_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `tagihan`
--
ALTER TABLE `tagihan`
  MODIFY `tagihan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`barang_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `keranjang_pesanan`
--
ALTER TABLE `keranjang_pesanan`
  ADD CONSTRAINT `keranjang_pesanan_ibfk_1` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`barang_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  ADD CONSTRAINT `pesanan_detail_ibfk_1` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanan` (`pesanan_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sph_detail`
--
ALTER TABLE `sph_detail`
  ADD CONSTRAINT `sph_detail_ibfk_1` FOREIGN KEY (`sph_id`) REFERENCES `sph` (`sph_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
