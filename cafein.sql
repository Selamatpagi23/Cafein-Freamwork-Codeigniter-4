-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Des 2023 pada 13.26
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cafein`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `antrian`
--

CREATE TABLE `antrian` (
  `id` int(11) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `noMeja` int(11) NOT NULL,
  `total_bayar` varchar(255) NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL DEFAULT 0,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `antrian`
--

INSERT INTO `antrian` (`id`, `nama`, `noMeja`, `total_bayar`, `tanggal`, `status`, `idUser`) VALUES
(109, 'melia', 2, '7.600', '2023-12-05 22:42:04', 2, 59),
(110, 'melia', 1, '11.400', '2023-12-05 22:42:26', 2, 59),
(111, 'melia', 3, '19.000', '2023-12-06 09:20:56', 2, 59),
(112, 'melia', 3, '32.300', '2023-12-10 12:51:48', 2, 59),
(113, 'melia', 4, '11.400', '2023-12-10 13:13:42', 2, 59),
(114, 'melia', 5, '8.500', '2023-12-10 14:41:10', 2, 59),
(115, 'melia', 6, '88.200', '2023-12-11 16:16:18', 2, 59),
(116, 'Satria', 4, '275.400', '2023-12-23 09:54:11', 2, 64);

-- --------------------------------------------------------

--
-- Struktur dari tabel `membership`
--

CREATE TABLE `membership` (
  `id_member` int(11) NOT NULL,
  `level_member` enum('SILVER','PLATINUM','EMAS') NOT NULL,
  `aktif` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `sampai` datetime NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `membership`
--

INSERT INTO `membership` (`id_member`, `level_member`, `aktif`, `sampai`, `user_id`) VALUES
(32, 'EMAS', '2023-12-10 07:08:52', '2024-01-10 14:08:00', 59),
(34, 'EMAS', '2023-12-23 03:01:11', '2023-12-23 12:00:00', 64);

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `jenis` int(1) NOT NULL,
  `harga` int(11) NOT NULL,
  `foto` varchar(32) NOT NULL,
  `status` int(1) NOT NULL,
  `hapus` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id`, `nama`, `jenis`, `harga`, `foto`, `status`, `hapus`) VALUES
(1, 'Chiken Katsu', 1, 20000, 'chickenkatsu1.jpg', 1, NULL),
(2, 'Kentang Goreng', 2, 12000, 'kentanggoreng.jpg', 1, NULL),
(3, 'Chesee Tea', 3, 10000, 'cheseetea.jpg', 0, NULL),
(4, 'Espresso', 4, 10000, 'espresso.jpg', 1, NULL),
(5, 'Mie Goreng Telur', 1, 8000, 'miegorengtelur.jpg', 1, NULL),
(6, 'Nasi Goreng Keju', 1, 12000, 'nasigorengkeju.jpg', 1, NULL),
(7, 'Ayam Goreng Tepung', 1, 20000, 'ayamgorengtepung.jpg', 1, NULL),
(8, 'Sate Ayam', 1, 15000, 'sateayam.jpg', 0, NULL),
(9, 'Tahu Bakso', 2, 10000, 'tahubakso.jpg', 1, NULL),
(10, 'Kulit Ayam', 2, 10000, 'kulitayam.jpg', 0, NULL),
(11, 'Banana Roll', 2, 10000, 'bananaroll.jpg', 0, NULL),
(12, 'Sosis Bakar', 2, 10000, 'sosisbakar.jpg', 0, NULL),
(13, 'Martabak Ayam', 2, 15000, 'martabakayam.jpg', 1, NULL),
(14, 'Pisang Keju', 2, 12000, 'pisangkeju.jpg', 1, NULL),
(15, 'Coklat Keju', 3, 12000, 'coklatkeju.jpg', 1, NULL),
(16, 'Greentea keju', 3, 10000, 'greenteakeju.jpg', 0, NULL),
(17, 'Milk Tea', 3, 10000, 'milktea.jpg', 0, NULL),
(18, 'Cappucino Cincau', 3, 10000, 'cappucinocincau.jpg', 1, NULL),
(19, 'Teh Keju Susu', 3, 12000, 'tehkejususu.jpg', 1, NULL),
(20, 'Jus Melon', 3, 10000, 'jusmelon.jpg', 1, NULL),
(21, 'Jus Semangka', 3, 10000, 'jussemangka.jpg', 1, NULL),
(22, 'Jus Buah Naga', 3, 10000, 'jusbuahnaga.jpg', 1, NULL),
(23, 'Jus Sirsak', 3, 10000, 'jussirsak.jpg', 1, NULL),
(24, 'Cappucino Latte', 4, 10000, 'cappucinolatte.jpg', 1, NULL),
(25, 'Green tea latte', 4, 10000, 'greentealatte.jpg', 1, NULL),
(26, 'Kopi Americano', 4, 8000, 'kopiamericano.jpg', 1, NULL),
(27, 'Kopi Susu', 4, 8000, 'kopisusu.jpg', 1, NULL),
(28, 'ayam bakar', 1, 20000, 'default.jpg', 0, '2022-01-20 12:01:00'),
(29, 'Kopi Tubruk', 4, 8000, 'default.jpg', 0, '2022-01-20 12:01:00'),
(30, 'Mie Pedas ', 1, 18000, 'miepedas.jpg', 1, NULL),
(31, 'Ayam Bakar Manis', 1, 17000, 'ayambakarmanis.jpg', 1, '2023-12-23 12:12:00'),
(32, 'Ayam Bakar', 1, 19000, 'ayambakar.jpg', 1, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `meta`
--

CREATE TABLE `meta` (
  `id_meta` int(11) NOT NULL,
  `favicon` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `alamat_toko` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `youtube` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `meta`
--

INSERT INTO `meta` (`id_meta`, `favicon`, `logo`, `title`, `description`, `keywords`, `alamat_toko`, `facebook`, `youtube`, `email`) VALUES
(112, 'favicon_4.png', 'mie.png', 'Like Mie', 'Mie dengan Cinta, Hanya di Like Mie & Coffee.', 'warung mindo terdekat,warteg terdekat,warung mie terenak', 'Sambong Bridge, Jl. Jendral Sudirman No.18, Pertodanan Utara, Proyonanggan Tengah, Kec. Batang, Kabupaten Batang, Jawa Tengah 51216', 'https://facebook.com/LikeMie', 'https://youtube.com/LikeMie', 'LikeMie@gmail.com');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `pembelian`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `pembelian` (
`idAntrian` int(11)
,`namaAntrian` varchar(32)
,`noMeja` int(11)
,`statusAntrian` int(1)
,`tanggal` datetime
,`idMenu` int(11)
,`foto` varchar(32)
,`hapus` datetime
,`harga` int(11)
,`jenis` int(1)
,`namaMenu` varchar(32)
,`statusMenu` int(1)
,`idTransaksi` int(11)
,`jumlah` int(11)
,`harga_akhir` varchar(255)
,`idUser` int(11)
,`namaUser` varchar(100)
,`rule` varchar(255)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanmasuk`
--

CREATE TABLE `pesanmasuk` (
  `id_pesanMasuk` int(11) NOT NULL,
  `nama_user` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `jenis_member` enum('SILVER','PLATINUM','EMAS') NOT NULL,
  `bulan` varchar(255) NOT NULL,
  `status` enum('tertunda','terbayar') NOT NULL,
  `waktu_pesan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `waktu_bayar` datetime NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pesanmasuk`
--

INSERT INTO `pesanmasuk` (`id_pesanMasuk`, `nama_user`, `email`, `jenis_member`, `bulan`, `status`, `waktu_pesan`, `waktu_bayar`, `user_id`) VALUES
(19, 'melia', 'melia@gmail.com', 'EMAS', '60 Hari', 'terbayar', '2023-12-10 07:08:07', '2023-12-10 14:08:26', 59),
(20, 'Satria', 'Satria23@gmail.com', 'EMAS', 'Request Langsung', 'terbayar', '2023-12-23 02:59:27', '2023-12-23 09:59:41', 64);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `idMenu` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_akhir` varchar(255) NOT NULL,
  `idAntrian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `idMenu`, `jumlah`, `harga_akhir`, `idAntrian`) VALUES
(157, 5, 1, '7600', 109),
(158, 6, 1, '11400', 110),
(159, 1, 1, '19000', 111),
(160, 6, 1, '11400', 112),
(161, 2, 1, '11400', 112),
(162, 21, 1, '9500', 112),
(163, 6, 1, '11400', 113),
(164, 20, 1, '8500', 114),
(165, 4, 1, '8500', 115),
(166, 22, 1, '8500', 115),
(167, 2, 3, '34200', 115),
(168, 7, 2, '37000', 115),
(169, 5, 1, '7200', 116),
(170, 32, 2, '34200', 116),
(171, 13, 4, '54000', 116),
(172, 18, 8, '72000', 116),
(173, 27, 15, '108000', 116);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`, `user_create_at`, `user_role`) VALUES
(59, 'melia', 'melia@gmail.com', '$2y$10$NrhDyRn4xnc2Z8PxyckHZej0y9.McxiMgPvpVisLnQWmqktdzZaWu', '2023-11-04 02:25:12', 'pelanggan'),
(60, 'galang', 'galang123@gmail.com', '$2y$10$cJHLZ6ZHxwychOfFy8C3Oe.YaRTAP.5dRw0VFlWqenkmSfitH8eua', '2023-11-05 10:14:19', 'admin'),
(62, 'Rangga Putra', 'rangga@gmail.com', '$2y$10$UbZkuKUXxg1HQEZsMOgGReRoktyrj70kw1EAg4Hb0tOSTH5lLsfNu', '2023-11-26 09:44:58', 'pelanggan'),
(63, 'tama', 'Tama123@gmail.com', '$2y$10$ZHGkgDoLi2BgWRS2IYIuXe/rwtKJqsKilLeG2d0KLzoowfIParpPG', '2023-11-29 14:54:33', 'pelanggan'),
(64, 'Satria', 'Satria23@gmail.com', '$2y$10$ti/fAaqVu5KcnbnHzp7G.uvo0KkoYvF.TWfx1cind3P7fObNITm2W', '2023-12-05 00:42:37', 'pelanggan'),
(66, 'IchaZ', 'IchaZ@gmail.com', '$2y$10$p8EfM2iyvVFt25Dt6zpXyO4NQp7lfWiubyY3xbLRcm.NjImQtFxWe', '2023-12-23 02:58:03', 'admin');

-- --------------------------------------------------------

--
-- Struktur untuk view `pembelian`
--
DROP TABLE IF EXISTS `pembelian`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pembelian`  AS SELECT `antrian`.`id` AS `idAntrian`, `antrian`.`nama` AS `namaAntrian`, `antrian`.`noMeja` AS `noMeja`, `antrian`.`status` AS `statusAntrian`, `antrian`.`tanggal` AS `tanggal`, `menu`.`id` AS `idMenu`, `menu`.`foto` AS `foto`, `menu`.`hapus` AS `hapus`, `menu`.`harga` AS `harga`, `menu`.`jenis` AS `jenis`, `menu`.`nama` AS `namaMenu`, `menu`.`status` AS `statusMenu`, `transaksi`.`id` AS `idTransaksi`, `transaksi`.`jumlah` AS `jumlah`, `transaksi`.`harga_akhir` AS `harga_akhir`, `users`.`user_id` AS `idUser`, `users`.`user_name` AS `namaUser`, `users`.`user_role` AS `rule` FROM (((`antrian` join `transaksi` on(`antrian`.`id` = `transaksi`.`idAntrian`)) join `menu` on(`transaksi`.`idMenu` = `menu`.`id`)) join `users` on(`antrian`.`idUser` = `users`.`user_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `antrian`
--
ALTER TABLE `antrian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUser` (`idUser`);

--
-- Indeks untuk tabel `membership`
--
ALTER TABLE `membership`
  ADD PRIMARY KEY (`id_member`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `meta`
--
ALTER TABLE `meta`
  ADD PRIMARY KEY (`id_meta`);

--
-- Indeks untuk tabel `pesanmasuk`
--
ALTER TABLE `pesanmasuk`
  ADD PRIMARY KEY (`id_pesanMasuk`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idMenu` (`idMenu`) USING BTREE,
  ADD KEY `idAntrian` (`idAntrian`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `antrian`
--
ALTER TABLE `antrian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT untuk tabel `membership`
--
ALTER TABLE `membership`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `pesanmasuk`
--
ALTER TABLE `pesanmasuk`
  MODIFY `id_pesanMasuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `antrian`
--
ALTER TABLE `antrian`
  ADD CONSTRAINT `relasi_users` FOREIGN KEY (`idUser`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`idAntrian`) REFERENCES `antrian` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`idMenu`) REFERENCES `menu` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
