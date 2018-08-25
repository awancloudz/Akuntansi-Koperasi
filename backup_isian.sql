INSERT INTO `users` (`id`, `name`, `no_badan_hukum`, `username`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '1234567', 'admin', '$2y$10$qYX1WgLPv9KEN2JS0wCCS.1h25Wu9D6h81S/5X/PB6rxHoc5goXny', 'Pc8tFQ0idg2Bw6vI9tKDA4JIPbMMbCTKeeCwnqm5vmIqDJvcNpVn6j9rNEog', NULL, '2018-07-26 07:01:20');

INSERT INTO `keanggotaan` (`id`, `nama_keanggotaan`, `simpanan_pokok`, `simpanan_wajib`, `bunga_simpanan`, `bunga_pinjaman`, `denda_pinjaman`, `keterangan`, `id_users`, `created_at`, `updated_at`) VALUES
(1, 'Anggota', 500000, 50000, 2, 1, 1, 'Anggota Koperasi', 1, '2017-11-04 17:21:18', '2017-11-13 04:35:33');

INSERT INTO `nasabah` (`id`, `no_nasabah`, `nama`, `alamat`, `no_hp`, `id_keanggotaan`, `tanggal_masuk`, `id_users`, `created_at`, `updated_at`) VALUES
(1, '123456', 'Awan A', 'Jalan Jalan', '081236324786', 1, '2017-11-05', 1, '2017-11-04 17:21:40', '2017-11-04 17:21:40');

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