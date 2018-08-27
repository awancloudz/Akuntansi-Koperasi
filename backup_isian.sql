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

INSERT INTO `aspekgrup` (`id`, `nama_aspekgrup`, `created_at`, `updated_at`) VALUES
(1, 'MANAJEMEN UMUM', '2018-08-24 18:18:35', '2018-08-24 18:22:50'),
(2, 'KELEMBAGAAN', '2018-08-24 18:19:02', '2018-08-24 18:19:02'),
(3, 'PERMODALAN', '2018-08-24 18:19:15', '2018-08-24 18:19:15'),
(4, 'AKTIVA', '2018-08-24 18:19:22', '2018-08-24 18:19:22'),
(5, 'LIKUIDITAS', '2018-08-24 18:19:37', '2018-08-24 18:19:37');

INSERT INTO `kuesioner` (`id`, `id_aspekgrup`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 1, 'Apakah KSP/USP Koperasi memiliki visi, misi dan tujuan yang jelas (dibuktikan dengan dokumen tertulis)', '2018-08-24 12:05:22', '2018-08-24 12:05:22'),
(2, 1, 'Apakah KSP/USP Koperasi memiliki rencana kerja jangka panjang minimal untuk 3 tahun ke depan dan dijadikan sebagai acuan KSP/USP Koperasi dalam menjalankan usahanya (dibuktikan dengan dokumen tertulis)', '2018-08-24 12:08:39', '2018-08-24 12:08:39'),
(3, 1, 'Apakah KSP/USP Koperasi memiliki rencana kerja tahunan yang digunakan sebagai dasar acuan kegiatan usaha selama 1 tahun (dibuktikan dengan dokumen tertulis)', '2018-08-24 12:09:32', '2018-08-24 12:09:32'),
(4, 1, 'Adakah kesesuaian antara rencana kerja jangka pendek dengan rencana jangka panjang (dibuktikan dengan dokumen tertulis)', '2018-08-24 12:10:15', '2018-08-24 12:10:15'),
(5, 1, 'Apakah visi, misi, tujuan dan rencana kerja diketahui dan dipahami oleh pengurus, pengawas, pengelola dan seluruh karyawan (ddengan cara pengecekan silang)', '2018-08-25 14:20:37', '2018-08-25 14:20:37'),
(6, 1, 'Pengambilan keputusan yang bersifat operasional dilakukan oleh pengelola secara independent (konfirmasi kepada pengurus atau pengawas)', '2018-08-25 14:21:16', '2018-08-25 14:21:16'),
(7, 1, 'Pengurus dan atau pengelola KSP/USP Koperasi memiliki komitmen untuk mengangani permasalahan yang dihadapi serta melakukan tindakan perbaikan yang diperlukan', '2018-08-25 14:22:20', '2018-08-25 14:22:20'),
(8, 1, 'KSP/USP koperasi memiliki tata tertib kerja SDM yang meliputi disiplin kerja serta didukung sarana kerja yang memadai dalam melaksanakan pekerjaan (dibuktikan dengan dokumen tertulis dan pengecekan fisik sarana kerja)', '2018-08-25 14:23:22', '2018-08-25 14:23:22'),
(9, 1, 'Pengurus KSP/USP koperasi yang mengangkat pengelola, tidak mencampuri kegiatan operasional sehari-hari yang cenderung menguntungkan kepentingan sendiri, keluarga atau kelompoknya sehingga dapat merugikan KSP/USP Koperasi (dilakukan konfirmasi)', '2018-08-25 14:25:28', '2018-08-25 14:25:28'),
(10, 1, 'Anggota KSP/USP Koperasi sebagai pemilik mempunyai kemampuan untuk meningkatkan permodalan KSP/USP Koperasi sesuai dengan ketentuan yang berlaku (pengecekan silang dilakukan terhadap partisipasi modal anggota)', '2018-08-25 14:26:34', '2018-08-25 14:26:34'),
(11, 1, 'Pengurus KSP/USP koperasi di dalam melaksanakan kegiatan operasional tidak melakukan hal-hal yang cenderung menguntungkan kepentingan sendiri, keluarga atau kelompoknya atau berpotensi merugikan KSP/USP Koperasi (dilakukan konfirmasi)', '2018-08-25 14:30:26', '2018-08-25 14:30:26'),
(12, 1, 'Pengurus melaksanakan fungsi pengawasan terhadap pelaksanaan tugas pengelola sesuai dengan tugas dan wewenangnya secara efektif (pengecekan silang kepada pengelola dan atau pengawas)', '2018-08-25 14:31:41', '2018-08-25 14:31:41'),
(13, 2, 'Bagan organisasi yang ada telah mencerminkan seluruh kegiatan KSP/USP Koperasi dan tidak terdapat jabatan kosong atau perangkapan jabatan (dibuktikan dengan adanya dokumen tertulis tentang job description)', '2018-08-25 14:33:15', '2018-08-25 14:35:20'),
(14, 2, 'KSP/USP Koperasi memiliki rincian tugas yang jelas untuk masing-masing karyawannya. (dibuktikan dengan adanya dokumen tertulis tentang job specifications) ', '2018-08-25 14:36:28', '2018-08-25 14:36:28'),
(15, 2, 'Di dalam struktur kelembagaan KSP/USP Koperasi terdapat struktur yang melakukan fungsi sebagai dewan pengawas (yang dibuktikan dengan dokumen tertulis tentang struktur organisasi)', '2018-08-25 14:37:27', '2018-08-25 14:37:27'),
(16, 2, 'KSP/USP Koperasi terbukti mempunyai Standar Operasional dan Manajemen (SOM) dan Standar Operasional Prosedur (SOP) (dibuktikan dengan dokumen tertulis tentang SOM dan SOP KSP/USP Koperasi)', '2018-08-25 14:39:02', '2018-08-25 14:39:02'),
(17, 2, 'KSP/USP Koperasi telah menjalankan kegiatannya sesuai SOM dan SOP KSP/USP Koperasi (pengecekan silang antara pelaksanaan kegiatan dengan SOM dan SOP-nya)', '2018-08-25 14:39:56', '2018-08-25 14:39:56'),
(18, 2, 'KSP/USP Koperasi mempunyai sistem pengamanan yang baik terhadap semua dokumen penting (dibuktikan dengan adanya sistem pengamanan dokumen penting berikut sarana penyimpanannya)', '2018-08-25 14:40:48', '2018-08-25 14:40:48'),
(19, 3, 'Tingkat pertumbuhan modal sendiri sama atau lebih besar dari tingkat pertumbuhan asset (dihitung berdasarkan data yang ada di neraca)', '2018-08-26 07:52:18', '2018-08-26 07:52:18'),
(20, 3, 'Tingkat pertumbuhan modal sendiri yang berasal dari anggota sekurang kurangnya sebesar 10% dibandingkan tahun sebelumnya (dihitung berdasarkan data yang ada di Neraca)', '2018-08-26 07:53:04', '2018-08-26 07:53:04'),
(21, 3, 'Penyisihan cadangan dari SHU sama atau lebih besar dari seperempat SHU tahun berjalan', '2018-08-26 07:53:48', '2018-08-26 07:53:48'),
(22, 3, 'Simpanan dan simpanan berjangka koperasi meningkat minimal 10% dari tahun sebelumnya', '2018-08-26 07:54:16', '2018-08-26 07:54:16'),
(23, 3, 'Investasi harta tetap dari inventaris serta pendanaan ekspansi perkantoran dibiayai dengan modal sendiri (pengecekan silang dengan laporan sumber dan penggunaan dana)', '2018-08-26 07:55:02', '2018-08-26 07:55:02'),
(24, 4, 'Pinjaman dengan kolektibilitas lancar minimal sebesar 90% dari pinjaman yang diberikan (dibuktikan dengan laporan pengembalian pinjaman)', '2018-08-26 07:55:46', '2018-08-26 07:55:46'),
(25, 4, 'Setiap pinjaman uang diberikan didukung dengan agunan yang nilainya sama atau lebih besar dari pinjaman yang diberikan kecuali pinjaman bagi anggota sampai dengan 1 juta rupiah (dibuktikan dengan laporan pinjaman dan daftar agunannya)', '2018-08-26 07:57:22', '2018-08-26 07:57:22'),
(26, 4, 'Dana cadangan penghapusan pinjaman sama atau lebih besar dari jumlah pinjaman macet tahunan (dibuktikan dengan laporan kolektibilitas pinjaman dan cadangan penghapusan pinjaman)', '2018-08-26 07:58:26', '2018-08-26 07:58:26'),
(27, 4, 'Pinjaman macet tahun lalu dapat ditagih sekurang-kurangnya sepertiganya (dibuktikan dengan laporan penagihan pinjaman macet tahunan)', '2018-08-26 07:58:56', '2018-08-26 07:58:56'),
(28, 4, 'KSP/USP Koperasi menerapkan prosedur pinjaman dilaksanakan dengan efektif (pengecekan silang antara pelaksanaan prosedur pinjaman dengan SOP-nya)', '2018-08-26 07:59:43', '2018-08-26 07:59:43'),
(29, 4, 'Memiliki kebijakan cadangan penghapusan pinjaman bermasalah (dibuktikan dengan kebijakan tertulisa dan laporan keuangan)', '2018-08-26 08:00:17', '2018-08-26 08:00:17'),
(30, 4, 'Dalam memberikan pinjaman KSP/USP Kkoperasi mengambil keputusan berdasarkan prinsip kehati-hatian (dibuktikan dengan hasil analisis kelayakan pinjaman)', '2018-08-26 08:01:21', '2018-08-26 08:01:21'),
(31, 4, 'Keputusan pemberian pinjaman dan atau penempatan dana dilakukan melalui komite (dibuktikan dengan risalah rapat koomite)', '2018-08-26 08:02:03', '2018-08-26 08:02:03'),
(32, 4, 'Setelah pinjaman diberikan KSP/USP Koperasi melakukan pemantauan terhadap penggunaan pinjaman serta kemampuan dan kepatuhan anggota atau peminjam dalam memenuhi kewajibannya (dibuktikan dengan laporan monitoring)', '2018-08-26 08:03:05', '2018-08-26 08:03:05'),
(33, 4, 'KSP/USP Koperasi mekalukan peninjauan, penilaian dan pengikatan terhadap agunannya (dibuktikan dengan dokumen pengikatan dan atau penyerahan agunan)', '2018-08-26 08:04:04', '2018-08-26 08:04:04'),
(34, 5, 'Memiliki kebijaksanaan tertulis mengenai pengendaian likuiditas (dibuktikan dengan dokumen tertulis mengenai perencanaan usaha)', '2018-08-26 08:05:18', '2018-08-26 08:05:18'),
(35, 5, 'Memiliki fasilitas pinjaman yang akan diterima dari lembaga lain untuk menjakga likuiditasnya (dbuktikan dengan dokumen tertulisa mengenai kerjasama pendanaan dari lembaga keuangan lainnya)', '2018-08-26 08:06:11', '2018-08-26 08:06:11'),
(36, 5, 'Memiiki pedoman administrasi yang efektif untuk memantau kewajiban yang jatuh tempo (dibuktikan dengan adanya dokumen tertulis mengenai skedul penghimpunan simpanan dan pemberian pinjaman)', '2018-08-26 08:07:10', '2018-08-26 08:07:10'),
(37, 5, 'Memiliki kebijakan penghimpunan simpanan dan pemberian pinjaman sesuai dengan kondisi keuangan KSP/USP Koperasi (dibuktikan dengan kebijakan tertulis)', '2018-08-26 08:07:50', '2018-08-26 08:07:50'),
(38, 5, 'Memiliki sistem informasi manajemen yang memadai untuk pemantauan likuiditas (dibuktikan dengan dokumen tertulis berupa sistem pelaporan penghimpunan simpanan dan pemberian pinjaman)', '2018-08-26 08:08:44', '2018-08-26 08:08:44');