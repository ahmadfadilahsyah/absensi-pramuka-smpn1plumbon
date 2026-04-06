-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Apr 2026 pada 06.10
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi_pramuka`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

CREATE TABLE `absensi` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `sesi_id` int(11) DEFAULT NULL,
  `waktu_absen` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('hadir','izin','sakit','alpha') DEFAULT 'hadir',
  `keterangan` text DEFAULT NULL,
  `qr_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sesi_latihan`
--

CREATE TABLE `sesi_latihan` (
  `id` int(11) NOT NULL,
  `nama_sesi` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_selesai` time NOT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `kelas` varchar(20) DEFAULT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama_lengkap`, `kelas`, `role`, `created_at`) VALUES
(1, 'admin', '$2y$10$ciXlHOhOdiiuYVVg1Wgiq.JZVwGTxLM9Bphf0PfbJXJkR5RQ0Jhne', 'Administrator', NULL, 'admin', '2026-04-05 04:22:01'),
(3, 'rizky', '$2y$10$02L1g.Wwgak9WKBW42ZesuOWPYuiNGMlVx7Z/iIRcP3o67uqZssb6', 'Muhammad Rizky', NULL, 'user', '2026-04-05 04:25:59'),
(184, 'PHS79', '100412', 'Pedro Hasiholan Sianturi', '7', 'user', '2026-04-05 08:24:30'),
(185, 'CL80', '110511', 'Chilyatul Lubby', '8', 'user', '2026-04-05 08:24:30'),
(186, 'HMR79', '290412', 'Hanif Muhammad Rafa', '8', 'user', '2026-04-05 08:24:30'),
(187, 'HRP79', '100412', 'Hafidz Rizqy Prasetyo', '8', 'user', '2026-04-05 08:24:30'),
(188, 'KI79', '260312', 'Keanu Ibrahim', '8', 'user', '2026-04-05 08:24:30'),
(189, 'NIN80', '110112', 'Nanda Izzatun Nisa', '8', 'user', '2026-04-05 08:24:30'),
(190, 'MHA79', '270312', 'Mukhamad Hedar Ali', '8', 'user', '2026-04-05 08:24:30'),
(191, 'VBF80', '201011', 'Vega Bintang Fallas', '8', 'user', '2026-04-05 08:24:30'),
(192, 'MAH80', '281211', 'Mentari Alifa Hasan', '8', 'user', '2026-04-05 08:24:30'),
(193, 'DAF79', '160513', 'Dzaky Arrafi Firmansyah', '7', 'user', '2026-04-05 08:24:30'),
(194, 'AN80', '100513', 'Anisa Nayla', '7', 'user', '2026-04-05 08:24:30'),
(195, 'CNF80', '260213', 'Citra Nuramaliya Fauzi', '7', 'user', '2026-04-05 08:24:30'),
(196, 'EN80', '010713', 'Elmira Nurkhalishah', '7', 'user', '2026-04-05 08:24:30'),
(197, 'RPF80', '170213', 'Rizka Putri Febriany', '7', 'user', '2026-04-05 08:24:30'),
(198, 'RR79', '100813', 'Rangga Respati', '7', 'user', '2026-04-05 08:24:30'),
(199, 'LAM80', '010113', 'Lifia Al Mughniy', '7', 'user', '2026-04-05 08:24:30'),
(200, 'WSK80', '250612', 'Wukir Sekar Kencana', '8', 'user', '2026-04-05 08:24:30'),
(201, 'AF80', '160812', 'Adellia Fitriyana', '7', 'user', '2026-04-05 08:24:30'),
(202, 'PRRA80', '200413', 'Putri Rosada Ratu Aila', '7', 'user', '2026-04-05 08:24:30'),
(203, 'A80', '100612', 'Ayuni', '8', 'user', '2026-04-05 08:24:30'),
(204, 'EN801', '020113', 'Elfa Nurfadila', '7', 'user', '2026-04-05 08:24:30'),
(205, 'NNI80', '080713', 'Nabilla Nuri Isnaningsih', '7', 'user', '2026-04-05 08:24:30'),
(206, 'SAH80', '261211', 'Silvi Aswatun Hasanah', '8', 'user', '2026-04-05 08:24:30'),
(207, 'YMN80', '120513', 'Yasmin Maya Nurkharomah', '7', 'user', '2026-04-05 08:24:30'),
(208, 'MIRP79', '240812', 'Muhammad Irsyad Rizki Pratama', '7', 'user', '2026-04-05 08:24:30'),
(209, 'NND80', '291112', 'Nur Naya Dewi', '7', 'user', '2026-04-05 08:24:30'),
(210, 'NA80', '200412', 'Nabilla Azahra', '8', 'user', '2026-04-05 08:24:30'),
(211, 'DPA80', '240913', 'Delisa Putri Anindia', '7', 'user', '2026-04-05 08:24:30'),
(212, 'AP80', '110412', 'Aisyah Putri', '7', 'user', '2026-04-05 08:24:30'),
(213, 'ZML80', '060312', 'Zahra Melita Lestari', '8', 'user', '2026-04-05 08:24:30'),
(214, 'IZ80', '210912', 'Indah Zafirah', '7', 'user', '2026-04-05 08:24:30'),
(215, 'MFH79', '180412', 'Muhamad Fadli Hafidz', '8', 'user', '2026-04-05 08:24:30'),
(216, 'VSP79', '040613', 'Viros Safana Putra', '7', 'user', '2026-04-05 08:24:30'),
(217, 'SPR80', '080811', 'Safira Putri Ramadhani', '8', 'user', '2026-04-05 08:24:30'),
(218, 'NR80', '240811', 'Natasya Ramadhani', '8', 'user', '2026-04-05 08:24:30'),
(219, 'ZNK80', '050513', 'Zahra Nurul Khotimah', '7', 'user', '2026-04-05 08:24:30'),
(220, 'MRS79', '300513', 'Muhammad Ridwan Syaputra', '7', 'user', '2026-04-05 08:24:30'),
(221, 'RF79', '111112', 'Raditiya Fakhrurrazi', '7', 'user', '2026-04-05 08:24:30'),
(222, 'HF80', '021212', 'Husna Farisah', '7', 'user', '2026-04-05 08:24:30'),
(223, 'SI80', '170612', 'Shufi Irawan', '8', 'user', '2026-04-05 08:24:30'),
(224, 'OSW79', '160413', 'Okky Satria Wibowo', '7', 'user', '2026-04-05 08:24:30'),
(225, 'MFH791', '060611', 'Muhammad Fajri Hidayat', '8', 'user', '2026-04-05 08:24:30'),
(226, 'NZ80', '180713', 'Nihalillah Zainurramadhani', '7', 'user', '2026-04-05 08:24:30'),
(227, 'GIP80', '090613', 'Gishel Ismi\'raj Pratama', '7', 'user', '2026-04-05 08:24:30'),
(228, 'FNR80', '160512', 'Faiha Nur Radhwa', '8', 'user', '2026-04-05 08:24:30'),
(229, 'AA80', '110712', 'Adhelia Azahra', '7', 'user', '2026-04-05 08:24:30'),
(230, 'RAS80', '121212', 'Rheifa Aulya Syabilla', '7', 'user', '2026-04-05 08:24:30'),
(231, 'BC80', '010612', 'Bunga Cinta', '8', 'user', '2026-04-05 08:24:30'),
(232, 'PRL80', '060812', 'Prika Ratu Langi', '7', 'user', '2026-04-05 08:24:30'),
(233, 'CRP80', '140611', 'Chika Revalina Putri', '8', 'user', '2026-04-05 08:24:30'),
(234, 'RAP80', '201211', 'Raisya Aulia Putri', '8', 'user', '2026-04-05 08:24:30'),
(235, 'D80', '171211', 'Deviani', '8', 'user', '2026-04-05 08:24:30'),
(236, 'DAR80', '060412', 'Dwi April Rianti', '8', 'user', '2026-04-05 08:24:30'),
(237, 'AA801', '281012', 'Afikha Annisatunajwa', '7', 'user', '2026-04-05 08:24:30'),
(238, 'AEH80', '220412', 'Afika Eka Hermawan', '8', 'user', '2026-04-05 08:24:30'),
(239, 'SNA80', '090913', 'Siti Naima Azzahra', '7', 'user', '2026-04-05 08:24:30'),
(240, 'BF79', '080813', 'Bagus Fikriansyah', '7', 'user', '2026-04-05 08:24:30'),
(241, 'NR801', '240712', 'Naurah Ramadhani', '7', 'user', '2026-04-05 08:24:30'),
(242, 'AN801', '051012', 'Atiyatun Nihaya', '7', 'user', '2026-04-05 08:24:30'),
(243, 'NAZ80', '080712', 'Neysa Alicia Zandra', '7', 'user', '2026-04-05 08:24:30'),
(244, 'ANZ80', '201212', 'Afifah Nisa Zukhairoh', '7', 'user', '2026-04-05 08:24:30'),
(245, 'SV80', '120112', 'Siti Vidiawati', '7', 'user', '2026-04-05 08:24:30'),
(246, 'NSK80', '140612', 'Nur Salsabila Khoyriyah', '7', 'user', '2026-04-05 08:24:30'),
(247, 'RDR80', '301210', 'Raya Devina Rachmania', '8', 'user', '2026-04-05 08:24:30'),
(248, 'NFR80', '140812', 'Nov Fina Ramadani', '8', 'user', '2026-04-05 08:24:30'),
(249, 'NZ801', '151211', 'Naura Zahiratulabiebah', '8', 'user', '2026-04-05 08:24:30'),
(250, 'AF801', '040213', 'Asiila Fauziah', '7', 'user', '2026-04-05 08:24:30'),
(251, 'TA80', '030412', 'Tria Aprilia', '8', 'user', '2026-04-05 08:24:30'),
(252, 'NA79', '210112', 'Nizar Alghifari', '8', 'user', '2026-04-05 08:24:30'),
(253, 'ABA79', '291110', 'Anton Bahrul Alam', '8', 'user', '2026-04-05 08:24:30'),
(254, 'ID80', '181212', 'Intan Desviyan', '7', 'user', '2026-04-05 08:24:30'),
(255, 'KEAU80', '090212', 'Kharin Ezha Avisa Utomo', '7', 'user', '2026-04-05 08:24:30'),
(256, 'LPM80', '161211', 'Luna Pramusita Muharum', '8', 'user', '2026-04-05 08:24:30'),
(257, 'DLA80', '041211', 'Desty Lisa Amalliyah', '8', 'user', '2026-04-05 08:24:30'),
(258, 'ATA80', '070313', 'Anggun Tri Andini', '7', 'user', '2026-04-05 08:24:30'),
(259, 'ANA80', '140912', 'Alya Nur Alifqi', '7', 'user', '2026-04-05 08:24:30'),
(260, 'SAS80', '230313', 'Sakila Anatasya Syakieb', '7', 'user', '2026-04-05 08:24:30'),
(261, 'SZ80', '201212', 'Salwa Zafirah', '7', 'user', '2026-04-05 08:24:30'),
(262, 'RIS79', '150912', 'Rizky Imanulhaq Setiono', '8', 'user', '2026-04-05 08:24:30'),
(263, 'AJ79', '300912', 'Aryasepta Jonazein', '7', 'user', '2026-04-05 08:24:30'),
(264, 'TTA80', '311011', 'Tiara Tutuh Arima', '8', 'user', '2026-04-05 08:24:30'),
(265, 'RAF80', '011012', 'Robi\'ah Anisatul Farhah', '7', 'user', '2026-04-05 08:24:30'),
(266, 'MJS79', '030911', 'Muhammad Jibran Saputra', '8', 'user', '2026-04-05 08:24:30'),
(267, 'NAH79', '261012', 'Nurohman Al Hafidz', '7', 'user', '2026-04-05 08:24:30'),
(268, 'NRS80', '300811', 'Nur Rizki Safitri', '8', 'user', '2026-04-05 08:24:30'),
(269, 'ZCA80', '260112', 'Zhievana Chantika Azahra', '8', 'user', '2026-04-05 08:24:30'),
(270, 'FHNA80', '100511', 'Firyal Hasna Nur Azizah', '8', 'user', '2026-04-05 08:24:30'),
(271, 'SS80', '010713', 'Syifa Sauqiya', '7', 'user', '2026-04-05 08:24:30'),
(272, 'AH79', '190812', 'Alfaro Hartanto', '8', 'user', '2026-04-05 08:24:30'),
(273, 'admin79', 'admin123', 'ADMINISTRATOR', 'SISTEM', 'admin', '2026-04-05 08:42:09'),
(274, 'SAN80', '080713', 'Syifa Aulia Nafisyah', '7', 'user', '2026-04-06 03:47:57'),
(275, 'MFN79', '271011', 'Muhammad Fahmi Nurhikmah', '8', 'user', '2026-04-06 03:47:57'),
(276, 'ADP79', '260426', 'Azka Diandra Prasetyo', '7', 'user', '2026-04-06 03:47:57'),
(277, 'RR791', '191211', 'Reyhan Rhulianto', '8', 'user', '2026-04-06 03:47:57'),
(278, 'DM80', '140313', 'Desinta Maharani', '7', 'user', '2026-04-06 03:47:57'),
(279, 'SAJ80', '080212', 'Shahia Athifa Jasmine', '8', 'user', '2026-04-06 03:47:57'),
(280, 'RDS80', '100112', 'Reviana Dwi Siswandi', '8', 'user', '2026-04-06 03:47:57'),
(281, 'CL801', '110511', 'Chilyatul Lubby', '8', 'user', '2026-04-06 03:47:57'),
(282, 'BAM80', '250213', 'Bunga Ayunda Mutiara', '7', 'user', '2026-04-06 03:47:57'),
(283, 'AFS80', '020612', 'Ananda Fikhri Sahira', '7', 'user', '2026-04-06 03:47:57'),
(284, 'FAZ80', '231112', 'Fathimah Az Zahra', '8', 'user', '2026-04-06 03:47:57'),
(285, 'KF80', '261211', 'Kaila Fauziyyah', '8', 'user', '2026-04-06 03:47:57'),
(286, 'AA802', '060313', 'Alena Angellika', '7', 'user', '2026-04-06 03:47:57'),
(287, 'SA80', '201012', 'Salma Amanda', '7', 'user', '2026-04-06 03:47:57'),
(288, 'ICG80', '010813', 'Isnaynie Cahaya Gunawan', '7', 'user', '2026-04-06 03:47:57'),
(289, 'AZS80', '200113', 'Adisty Zian Syakhila', '7', 'user', '2026-04-06 03:47:57'),
(290, 'GD80', '270712', 'Giyara Deviola', '7', 'user', '2026-04-06 03:47:57'),
(291, 'E80', '150113', 'Erina', '7', 'user', '2026-04-06 03:47:57'),
(292, 'FA80', '230612', 'Fatimah Azzahro', '7', 'user', '2026-04-06 03:47:57'),
(293, 'JYSS79', '110712', 'Jullyan Yafet Sintong Sinambela', '8', 'user', '2026-04-06 03:47:57'),
(294, 'MFV80', '100312', 'Mutiara Fajar Velani', '8', 'user', '2026-04-06 03:47:57'),
(295, 'NAAP80', '120813', 'Nafisah Al Abidah Permana', '7', 'user', '2026-04-06 03:47:57'),
(296, 'FAP79', '040413', 'Fauzan Anugerah Pratama', '7', 'user', '2026-04-06 03:47:57'),
(297, 'RNA80', '280712', 'Rizky Nur Aeni', '7', 'user', '2026-04-06 03:47:57'),
(298, 'HKL80', '070313', 'Hafiza Khaira Lubna', '7', 'user', '2026-04-06 03:47:57'),
(299, 'LP80', '080112', 'Listi Purnama', '8', 'user', '2026-04-06 03:47:57');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `sesi_id` (`sesi_id`);

--
-- Indeks untuk tabel `sesi_latihan`
--
ALTER TABLE `sesi_latihan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `sesi_latihan`
--
ALTER TABLE `sesi_latihan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=300;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `absensi_ibfk_2` FOREIGN KEY (`sesi_id`) REFERENCES `sesi_latihan` (`id`);

--
-- Ketidakleluasaan untuk tabel `sesi_latihan`
--
ALTER TABLE `sesi_latihan`
  ADD CONSTRAINT `sesi_latihan_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
