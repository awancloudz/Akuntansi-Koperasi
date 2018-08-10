-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 10, 2018 at 09:58 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `simkora_akuntansi`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE IF NOT EXISTS `akun` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_header` int(10) unsigned NOT NULL,
  `kode_akun` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nama_akun` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('header','akun') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `akun_id_header_foreign` (`id_header`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id`, `id_header`, `kode_akun`, `nama_akun`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '1-10001', 'Kas', 'header', '2017-11-04 16:42:50', '2017-11-04 16:42:50'),
(2, 1, '1-10002', 'Rekening Bank', 'header', '2017-11-04 16:44:33', '2017-11-04 16:44:33'),
(3, 2, '1-10100', 'Piutang Anggota', 'header', '2017-11-04 16:44:48', '2017-11-04 16:44:48'),
(4, 3, '1-10200', 'Persediaan Barang', 'header', '2017-11-04 16:45:24', '2017-11-04 16:45:32'),
(5, 4, '1-10300', 'Peralatan Kantor', 'header', '2017-11-04 16:46:44', '2017-11-04 16:46:44'),
(6, 5, '1-10400', 'Penyusutan Peralatan', 'header', '2017-11-04 16:48:16', '2017-11-04 16:48:16'),
(7, 6, '2-20100', 'Hutang Usaha', 'header', '2017-11-04 17:03:10', '2017-11-04 17:03:10'),
(8, 7, '2-20200', 'Hutang Bunga', 'header', '2017-11-04 17:05:35', '2017-11-04 17:05:35'),
(9, 8, '2-20300', 'Simpanan Sukarela', 'header', '2017-11-04 17:07:24', '2017-11-04 17:07:24'),
(10, 9, '2-20400', 'Hutang Bank', 'header', '2017-11-04 17:10:36', '2017-11-04 17:10:36'),
(11, 10, '3-30100', 'Simpanan Pokok', 'header', '2017-11-04 17:12:18', '2017-11-04 17:12:18'),
(12, 11, '3-30200', 'Simpanan Wajib', 'header', '2017-11-04 17:15:00', '2017-11-04 17:15:00'),
(13, 12, '4-40100', 'Pinjaman', 'header', '2017-11-04 17:18:28', '2017-11-04 17:18:36'),
(14, 13, '4-40200', 'Provisi', 'header', '2017-11-04 17:18:58', '2017-11-04 17:18:58'),
(15, 14, '5-50100', 'Beban Bunga', 'header', '2017-11-04 17:19:39', '2017-11-04 17:19:39'),
(16, 15, '6-60100', 'Gaji', 'header', '2017-11-04 17:20:34', '2017-11-04 17:20:34');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE IF NOT EXISTS `currencies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `symbol` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `format` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `exchange_rate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `currencies_code_index` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `detail_angsuran`
--

CREATE TABLE IF NOT EXISTS `detail_angsuran` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_transaksi_pinjaman` int(10) unsigned NOT NULL,
  `angsuran` double NOT NULL,
  `jasa_uang` double NOT NULL,
  `total_bayar` double NOT NULL,
  `saldo` double NOT NULL,
  `jatuh_tempo` date NOT NULL,
  `tanggal_bayar` date NOT NULL,
  `status_bayar` enum('belum','sudah') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_angsuran_id_transaksi_pinjaman_foreign` (`id_transaksi_pinjaman`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `grup`
--

CREATE TABLE IF NOT EXISTS `grup` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama_grup` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `grup`
--

INSERT INTO `grup` (`id`, `nama_grup`, `created_at`, `updated_at`) VALUES
(1, 'Aktiva Lancar', NULL, NULL),
(2, 'Aktiva Tetap', NULL, NULL),
(3, 'Hutang Lancar', NULL, NULL),
(4, 'Hutang Jangka Panjang', NULL, NULL),
(5, 'Ekuitas', NULL, NULL),
(6, 'Bruto Anggota', NULL, NULL),
(7, 'Beban Pokok', NULL, NULL),
(8, 'Beban Operasi', NULL, NULL),
(9, 'SHU', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `header`
--

CREATE TABLE IF NOT EXISTS `header` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_grup` int(10) unsigned NOT NULL,
  `kode_header` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nama_header` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `header_id_grup_foreign` (`id_grup`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `header`
--

INSERT INTO `header` (`id`, `id_grup`, `kode_header`, `nama_header`, `created_at`, `updated_at`) VALUES
(1, 1, '1', 'Kas', '2017-11-04 14:48:51', '2017-11-04 14:48:51'),
(2, 1, '2', 'Piutang Anggota', '2017-11-04 14:49:18', '2017-11-04 14:49:18'),
(3, 1, '3', 'Perlengkapan Kantor', '2017-11-04 16:29:40', '2017-11-04 16:29:40'),
(4, 2, '4', 'Peralatan Kantor', '2017-11-04 16:29:58', '2017-11-04 16:29:58'),
(5, 2, '5', 'Penyusutan Peralatan', '2017-11-04 16:30:14', '2017-11-04 16:30:14'),
(6, 3, '6', 'Hutang Usaha', '2017-11-04 16:30:52', '2017-11-04 16:30:52'),
(7, 3, '7', 'Hutang Bunga', '2017-11-04 16:31:04', '2017-11-04 16:31:04'),
(8, 3, '8', 'Simpanan Sukarela', '2017-11-04 16:31:35', '2017-11-04 16:31:35'),
(9, 4, '9', 'Hutang Bank', '2017-11-04 16:32:04', '2017-11-04 16:32:04'),
(10, 5, '10', 'Simpanan Pokok', '2017-11-04 16:32:27', '2017-11-04 16:32:27'),
(11, 5, '11', 'Simpanan Wajib', '2017-11-04 16:38:32', '2017-11-04 16:38:32'),
(12, 6, '12', 'Partisipasi Jasa Pinjaman', '2017-11-04 16:39:05', '2017-11-04 16:39:05'),
(13, 6, '13', 'Partisipasi Jasa Provisi', '2017-11-04 16:39:20', '2017-11-04 16:39:20'),
(14, 7, '14', 'Beban Bunga', '2017-11-04 16:39:51', '2017-11-04 16:39:51'),
(15, 8, '15', 'Gaji', '2017-11-04 16:40:10', '2017-11-04 16:40:10'),
(16, 8, '16', 'Pemakaian Perlengkapan', '2017-11-12 11:52:42', '2017-11-12 11:52:42');

-- --------------------------------------------------------

--
-- Table structure for table `jurnalumum`
--

CREATE TABLE IF NOT EXISTS `jurnalumum` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `keterangan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `keanggotaan`
--

CREATE TABLE IF NOT EXISTS `keanggotaan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama_keanggotaan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `simpanan_pokok` double NOT NULL,
  `simpanan_wajib` double NOT NULL,
  `bunga_simpanan` double NOT NULL,
  `bunga_pinjaman` double NOT NULL,
  `denda_pinjaman` double NOT NULL,
  `keterangan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_users` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `keanggotaan_id_users_foreign` (`id_users`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `keanggotaan`
--

INSERT INTO `keanggotaan` (`id`, `nama_keanggotaan`, `simpanan_pokok`, `simpanan_wajib`, `bunga_simpanan`, `bunga_pinjaman`, `denda_pinjaman`, `keterangan`, `id_users`, `created_at`, `updated_at`) VALUES
(1, 'Anggota', 500000, 50000, 2, 1, 1, 'Anggota Koperasi', 1, '2017-11-04 17:21:18', '2017-11-13 04:35:33');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2013_11_26_161501_create_currency_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2017_09_26_204645_create_table_detail_angsuran', 1),
('2017_09_26_203305_create_table_transaksi_pinjaman', 2),
('2017_09_26_204100_create_table_transaksi_simpanan', 2),
('2017_09_26_204958_create_table_transaksi_umum', 2),
('2017_10_31_214818_create_table_transaksi_semua', 2),
('2017_09_26_202850_create_table_nasabah', 3),
('2017_11_02_133831_create_table_jurnalumum', 3),
('2017_09_26_202325_create_table_keanggotaan', 4),
('2017_09_26_201907_create_table_akun', 5),
('2017_09_26_201510_create_table_header', 6),
('2017_11_04_210634_create_table_grup', 7),
('2014_10_12_000000_create_users_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `nasabah`
--

CREATE TABLE IF NOT EXISTS `nasabah` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `no_nasabah` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_keanggotaan` int(10) unsigned NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `id_users` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nasabah_no_nasabah_unique` (`no_nasabah`),
  KEY `nasabah_id_keanggotaan_foreign` (`id_keanggotaan`),
  KEY `nasabah_id_users_foreign` (`id_users`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `nasabah`
--

INSERT INTO `nasabah` (`id`, `no_nasabah`, `nama`, `alamat`, `no_hp`, `id_keanggotaan`, `tanggal_masuk`, `id_users`, `created_at`, `updated_at`) VALUES
(1, '123456', 'Awan A', 'Jalan Jalan', '081236324786', 1, '2017-11-05', 1, '2017-11-04 17:21:40', '2017-11-04 17:21:40');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_pinjaman`
--

CREATE TABLE IF NOT EXISTS `transaksi_pinjaman` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kodetransaksi` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `id_akun` int(10) unsigned NOT NULL,
  `id_nasabah` int(10) unsigned NOT NULL,
  `tanggal` date NOT NULL,
  `nominal_pinjam` double NOT NULL,
  `kali_angsuran` int(11) NOT NULL,
  `nominal_angsuran` double NOT NULL,
  `id_users` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `transaksi_pinjaman_kodetransaksi_unique` (`kodetransaksi`),
  KEY `transaksi_pinjaman_id_nasabah_foreign` (`id_nasabah`),
  KEY `transaksi_pinjaman_id_akun_foreign` (`id_akun`),
  KEY `transaksi_pinjaman_id_users_foreign` (`id_users`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `transaksi_pinjaman`
--

INSERT INTO `transaksi_pinjaman` (`id`, `kodetransaksi`, `id_akun`, `id_nasabah`, `tanggal`, `nominal_pinjam`, `kali_angsuran`, `nominal_angsuran`, `id_users`, `created_at`, `updated_at`) VALUES
(1, 'TR-PINJ00001', 13, 1, '2017-11-06', 10000000, 10, 100000, 1, '2017-11-06 06:56:39', '2017-11-06 06:56:39');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_semua`
--

CREATE TABLE IF NOT EXISTS `transaksi_semua` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_akun` int(10) unsigned NOT NULL,
  `id_jurnalumum` int(10) unsigned NOT NULL,
  `kodetransaksi` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `nominal` double NOT NULL,
  `keterangan` text COLLATE utf8_unicode_ci NOT NULL,
  `id_users` int(10) unsigned NOT NULL,
  `status` enum('debit','kredit') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `transaksi_semua_kodetransaksi_unique` (`kodetransaksi`),
  KEY `transaksi_semua_id_jurnalumum_foreign` (`id_jurnalumum`),
  KEY `transaksi_semua_id_akun_foreign` (`id_akun`),
  KEY `transaksi_semua_id_users_foreign` (`id_users`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_simpanan`
--

CREATE TABLE IF NOT EXISTS `transaksi_simpanan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kodetransaksi` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `id_akun` int(10) unsigned NOT NULL,
  `id_nasabah` int(10) unsigned NOT NULL,
  `tanggal` date NOT NULL,
  `jenis_simpanan` enum('pokok','sukarela','penarikan') COLLATE utf8_unicode_ci NOT NULL,
  `nominal_simpan` double NOT NULL,
  `id_users` int(10) unsigned NOT NULL,
  `status` enum('debit','kredit') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `transaksi_simpanan_kodetransaksi_unique` (`kodetransaksi`),
  KEY `transaksi_simpanan_id_nasabah_foreign` (`id_nasabah`),
  KEY `transaksi_simpanan_id_akun_foreign` (`id_akun`),
  KEY `transaksi_simpanan_id_users_foreign` (`id_users`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `transaksi_simpanan`
--

INSERT INTO `transaksi_simpanan` (`id`, `kodetransaksi`, `id_akun`, `id_nasabah`, `tanggal`, `jenis_simpanan`, `nominal_simpan`, `id_users`, `status`, `created_at`, `updated_at`) VALUES
(1, 'TR-SIMP00001', 11, 1, '2017-11-06', 'pokok', 200000, 1, 'debit', '2017-11-06 07:02:27', '2017-11-11 06:18:09');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_umum`
--

CREATE TABLE IF NOT EXISTS `transaksi_umum` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kodetransaksi` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `id_akun` int(10) unsigned NOT NULL,
  `tanggal` date NOT NULL,
  `nominal` double NOT NULL,
  `keterangan` text COLLATE utf8_unicode_ci NOT NULL,
  `id_users` int(10) unsigned NOT NULL,
  `status` enum('debit','kredit') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `transaksi_umum_kodetransaksi_unique` (`kodetransaksi`),
  KEY `transaksi_umum_id_akun_foreign` (`id_akun`),
  KEY `transaksi_umum_id_users_foreign` (`id_users`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `no_badan_hukum` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `no_badan_hukum`, `username`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '1234567', 'admin', '$2y$10$qYX1WgLPv9KEN2JS0wCCS.1h25Wu9D6h81S/5X/PB6rxHoc5goXny', 'Pc8tFQ0idg2Bw6vI9tKDA4JIPbMMbCTKeeCwnqm5vmIqDJvcNpVn6j9rNEog', NULL, '2018-07-26 07:01:20');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `akun`
--
ALTER TABLE `akun`
  ADD CONSTRAINT `akun_id_header_foreign` FOREIGN KEY (`id_header`) REFERENCES `header` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_angsuran`
--
ALTER TABLE `detail_angsuran`
  ADD CONSTRAINT `detail_angsuran_id_transaksi_pinjaman_foreign` FOREIGN KEY (`id_transaksi_pinjaman`) REFERENCES `transaksi_pinjaman` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `header`
--
ALTER TABLE `header`
  ADD CONSTRAINT `header_id_grup_foreign` FOREIGN KEY (`id_grup`) REFERENCES `grup` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `keanggotaan`
--
ALTER TABLE `keanggotaan`
  ADD CONSTRAINT `keanggotaan_id_users_foreign` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nasabah`
--
ALTER TABLE `nasabah`
  ADD CONSTRAINT `nasabah_id_keanggotaan_foreign` FOREIGN KEY (`id_keanggotaan`) REFERENCES `keanggotaan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nasabah_id_users_foreign` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_pinjaman`
--
ALTER TABLE `transaksi_pinjaman`
  ADD CONSTRAINT `transaksi_pinjaman_id_akun_foreign` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_pinjaman_id_nasabah_foreign` FOREIGN KEY (`id_nasabah`) REFERENCES `nasabah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_pinjaman_id_users_foreign` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_semua`
--
ALTER TABLE `transaksi_semua`
  ADD CONSTRAINT `transaksi_semua_id_akun_foreign` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_semua_id_jurnalumum_foreign` FOREIGN KEY (`id_jurnalumum`) REFERENCES `jurnalumum` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_semua_id_users_foreign` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_simpanan`
--
ALTER TABLE `transaksi_simpanan`
  ADD CONSTRAINT `transaksi_simpanan_id_akun_foreign` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_simpanan_id_nasabah_foreign` FOREIGN KEY (`id_nasabah`) REFERENCES `nasabah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_simpanan_id_users_foreign` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_umum`
--
ALTER TABLE `transaksi_umum`
  ADD CONSTRAINT `transaksi_umum_id_akun_foreign` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_umum_id_users_foreign` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
