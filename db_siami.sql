-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2022 at 10:54 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_siami`
--

-- --------------------------------------------------------

--
-- Table structure for table `auditees`
--

CREATE TABLE `auditees` (
  `id` int(10) UNSIGNED NOT NULL,
  `unit_id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `audit_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `auditees`
--

INSERT INTO `auditees` (`id`, `unit_id`, `user_id`, `audit_id`, `created_at`, `updated_at`) VALUES
(2, 1, 9, 2, '2022-04-01 06:31:51', '2022-04-03 00:20:56'),
(3, 2, 10, 2, '2022-04-02 22:59:19', '2022-04-22 14:22:47'),
(4, 3, 11, 2, '2022-04-03 00:22:15', '2022-04-22 14:22:53');

-- --------------------------------------------------------

--
-- Table structure for table `auditors`
--

CREATE TABLE `auditors` (
  `id` int(10) UNSIGNED NOT NULL,
  `kode` int(11) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `pelaksana_id` int(10) UNSIGNED NOT NULL,
  `audit_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `auditors`
--

INSERT INTO `auditors` (`id`, `kode`, `user_id`, `pelaksana_id`, `audit_id`, `created_at`, `updated_at`) VALUES
(3, 1, 2, 3, 2, '2022-04-04 06:42:43', '2022-05-18 13:15:39'),
(4, NULL, 5, 4, 2, '2022-04-04 06:44:36', '2022-04-04 06:44:36'),
(5, 2, 10, 3, 2, '2022-04-07 05:51:44', '2022-05-18 13:15:44');

-- --------------------------------------------------------

--
-- Table structure for table `auditor_unit`
--

CREATE TABLE `auditor_unit` (
  `auditor_id` int(10) UNSIGNED NOT NULL,
  `unit_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `auditor_unit`
--

INSERT INTO `auditor_unit` (`auditor_id`, `unit_id`) VALUES
(3, 1),
(3, 2),
(5, 3),
(5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `audits`
--

CREATE TABLE `audits` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester` enum('Ganjil','Genap') COLLATE utf8mb4_unicode_ci NOT NULL,
  `thn_akademik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `jadwal_evaluasi` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audits`
--

INSERT INTO `audits` (`id`, `name`, `semester`, `thn_akademik`, `start`, `end`, `is_active`, `created_at`, `updated_at`, `jadwal_evaluasi`) VALUES
(2, 'Audit 2021', 'Genap', '2021/2022', '2022-04-07', '2022-04-30', 1, '2022-03-31 07:32:28', '2022-04-29 04:01:56', '2022-04-29 12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `audit_indicators`
--

CREATE TABLE `audit_indicators` (
  `id` int(10) UNSIGNED NOT NULL,
  `link_referensi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `audit_id` int(10) UNSIGNED NOT NULL,
  `indicator_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audit_indicators`
--

INSERT INTO `audit_indicators` (`id`, `link_referensi`, `audit_id`, `indicator_id`, `created_at`, `updated_at`) VALUES
(1, NULL, 2, 1, '2022-04-03 01:16:58', '2022-04-03 01:16:58'),
(2, NULL, 2, 2, '2022-04-03 01:20:48', '2022-04-03 01:20:48');

-- --------------------------------------------------------

--
-- Table structure for table `audit_indicator_units`
--

CREATE TABLE `audit_indicator_units` (
  `id` int(10) UNSIGNED NOT NULL,
  `audit_indicator_id` int(10) UNSIGNED NOT NULL,
  `unit_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audit_indicator_units`
--

INSERT INTO `audit_indicator_units` (`id`, `audit_indicator_id`, `unit_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 2, NULL, NULL),
(3, 1, 3, NULL, NULL),
(8, 2, 2, NULL, NULL),
(9, 2, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `audit_notes`
--

CREATE TABLE `audit_notes` (
  `id` int(10) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `dokumen` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_rev` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auditor_id` int(10) UNSIGNED NOT NULL,
  `auditee_id` int(10) UNSIGNED NOT NULL,
  `indicator_id` int(10) UNSIGNED NOT NULL,
  `audit_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audit_notes`
--

INSERT INTO `audit_notes` (`id`, `tanggal`, `catatan`, `dokumen`, `tanggal_rev`, `auditor_id`, `auditee_id`, `indicator_id`, `audit_id`, `created_at`, `updated_at`) VALUES
(1, '2022-05-27', '<p>catatan</p>', '<p>dokumen saya</p>', NULL, 4, 2, 1, 2, '2022-05-26 03:45:14', '2022-05-26 03:47:43');

-- --------------------------------------------------------

--
-- Table structure for table `audit_plans`
--

CREATE TABLE `audit_plans` (
  `id` int(10) UNSIGNED NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `auditor_id` int(10) UNSIGNED NOT NULL,
  `auditee_id` int(10) UNSIGNED NOT NULL,
  `indicator_id` int(10) UNSIGNED NOT NULL,
  `audit_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audit_plans`
--

INSERT INTO `audit_plans` (`id`, `start`, `end`, `auditor_id`, `auditee_id`, `indicator_id`, `audit_id`, `created_at`, `updated_at`) VALUES
(3, '2022-05-18', '2022-05-21', 4, 2, 1, 2, '2022-05-18 14:52:23', '2022-05-18 14:53:38');

-- --------------------------------------------------------

--
-- Table structure for table `audit_plan_details`
--

CREATE TABLE `audit_plan_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `tanggal` date DEFAULT NULL,
  `organisasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auditor_kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `standar` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `audit_plan_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audit_plan_details`
--

INSERT INTO `audit_plan_details` (`id`, `tanggal`, `organisasi`, `auditor_kode`, `standar`, `audit_plan_id`, `created_at`, `updated_at`) VALUES
(4, NULL, NULL, '1, 2', '1. Profile Kampus', 3, NULL, NULL),
(5, NULL, NULL, '2', '2. Capaian Pembelajaran Sikap', 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `audit_work_steps`
--

CREATE TABLE `audit_work_steps` (
  `id` int(10) UNSIGNED NOT NULL,
  `tentatif` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tujuan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auditor_id` int(10) UNSIGNED NOT NULL,
  `auditee_id` int(10) UNSIGNED NOT NULL,
  `indicator_id` int(10) UNSIGNED NOT NULL,
  `audit_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audit_work_steps`
--

INSERT INTO `audit_work_steps` (`id`, `tentatif`, `tujuan`, `auditor_id`, `auditee_id`, `indicator_id`, `audit_id`, `created_at`, `updated_at`) VALUES
(3, 'Program studi TO Belum mencapai target yang diharapkan', 'Memastikan program studi TO telah mencapai standar', 4, 2, 1, 2, '2022-05-19 14:59:51', '2022-05-19 15:04:16');

-- --------------------------------------------------------

--
-- Table structure for table `audit_work_step_details`
--

CREATE TABLE `audit_work_step_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `langkah_kerja` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `audit_work_step_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audit_work_step_details`
--

INSERT INTO `audit_work_step_details` (`id`, `langkah_kerja`, `keterangan`, `audit_work_step_id`, `created_at`, `updated_at`) VALUES
(3, 'Dapatkan Dokumen Profil Lulusan', NULL, 3, NULL, NULL),
(4, 'Dapatkan Bukti dokumentasi kegiatan CPL', NULL, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `catatan_audits`
--

CREATE TABLE `catatan_audits` (
  `id` int(10) UNSIGNED NOT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `dokumen` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_rev` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal` date NOT NULL,
  `lokasi` date NOT NULL,
  `auditee_id` int(10) UNSIGNED NOT NULL,
  `indicator_id` int(10) UNSIGNED NOT NULL,
  `auditor_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `code`, `name`, `type`) VALUES
(1, 'M', 'Melampaui', 'Temuan'),
(2, 'T', 'Tercapai', 'Temuan'),
(3, 'OB', 'Observasi', 'Temuan'),
(4, 'KTS', 'Ketidaksesuaian', 'Temuan');

-- --------------------------------------------------------

--
-- Table structure for table `evaluasi_parameters`
--

CREATE TABLE `evaluasi_parameters` (
  `id` int(10) UNSIGNED NOT NULL,
  `standar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sasaran` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `indicator_id` int(10) UNSIGNED NOT NULL,
  `auditee_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `evaluasi_parameters`
--

INSERT INTO `evaluasi_parameters` (`id`, `standar`, `sasaran`, `indicator_id`, `auditee_id`, `created_at`, `updated_at`) VALUES
(11, 'Tersedianya rencana strategis \r\ndan operasional untuk \r\npengelolaan pembelajaran', 'Ada item kegiatan untuk \r\npengelolaan pembelajaran \r\npada renstra dan renop setiap \r\ntahun', 1, 2, '2022-04-28 06:05:03', '2022-04-28 06:05:03'),
(12, 'Tersedianya sistem \r\npembelajaran yang dapat \r\nmenciptakan suasana akademik \r\ndan budaya mutu', 'Pedoman terdiri dari: \r\nperencanaan, pelaksanaan \r\npembelajaran, evaluasi, \r\npeningkatan', 1, 2, '2022-04-28 06:05:03', '2022-04-28 06:05:03'),
(13, 'Tersedianya rencana strategis \r\ndan operasional untuk \r\npengelolaan pembelajaran', 'Ada item kegiatan untuk \r\npengelolaan pembelajaran \r\npada renstra dan renop setiap \r\ntahun', 2, 2, '2022-05-20 11:02:59', '2022-05-20 11:02:59');

-- --------------------------------------------------------

--
-- Table structure for table `evaluasi_parameter_tahun`
--

CREATE TABLE `evaluasi_parameter_tahun` (
  `id` int(10) UNSIGNED NOT NULL,
  `tahun` int(11) NOT NULL,
  `persen` int(11) NOT NULL,
  `evaluasi_parameter_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `evaluasi_parameter_tahun`
--

INSERT INTO `evaluasi_parameter_tahun` (`id`, `tahun`, `persen`, `evaluasi_parameter_id`, `created_at`, `updated_at`) VALUES
(7, 2019, 100, 11, '2022-04-28 06:10:34', '2022-04-28 06:10:34'),
(8, 2020, 100, 11, '2022-04-28 06:10:34', '2022-04-28 06:10:34'),
(9, 2021, 100, 11, '2022-04-28 06:10:34', '2022-04-28 06:10:34'),
(10, 2022, 100, 11, '2022-04-28 06:10:34', '2022-04-28 06:10:34'),
(11, 2019, 100, 12, '2022-04-28 06:10:34', '2022-04-28 06:10:34'),
(12, 2020, 100, 12, '2022-04-28 06:10:34', '2022-04-28 06:10:34'),
(13, 2021, 100, 12, '2022-04-28 06:10:34', '2022-04-28 06:10:34'),
(14, 2022, 100, 12, '2022-04-28 06:10:34', '2022-04-28 06:10:34'),
(15, 2019, 80, 13, '2022-05-20 11:02:59', '2022-05-20 11:02:59'),
(16, 2020, 80, 13, '2022-05-20 11:02:59', '2022-05-20 11:02:59'),
(17, 2021, 80, 13, '2022-05-20 11:02:59', '2022-05-20 11:02:59'),
(18, 2022, 90, 13, '2022-05-20 11:02:59', '2022-05-20 11:02:59');

-- --------------------------------------------------------

--
-- Table structure for table `evaluasi_rasionals`
--

CREATE TABLE `evaluasi_rasionals` (
  `id` int(10) UNSIGNED NOT NULL,
  `rasionale_standar` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `laporan_kinerja` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hambatan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upaya_perbaikan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lainnya` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `indicator_id` int(10) UNSIGNED NOT NULL,
  `auditee_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `evaluasi_rasionals`
--

INSERT INTO `evaluasi_rasionals` (`id`, `rasionale_standar`, `laporan_kinerja`, `hambatan`, `upaya_perbaikan`, `lainnya`, `indicator_id`, `auditee_id`, `created_at`, `updated_at`) VALUES
(1, '<ol><li>Sebagaimana diamanatkan dalam Misi dan Tujuan Politeknik Hasnur untuk mencetak lulusan yang terampil dan memiliki soft skills, leadership, managerial skills serta berstandar kompetensi yang diakui oleh dunia usaha maupun industri</li><li>Sesuai dengan Permenristekdikti No. 44 tahun 2015, untuk memastikan bahwa lulusan Politeknik Hasnur bermutu baik haruslah memiliki unsur sikap, pengetahuan, keterampilan umum dan keterampilan khusus baik sesuai dengan jenjang dan ciri khas masing &ndash; masing program studi, maka perlu adanya standar kompetensi lulusan.</li><li>Berdasarkan Peraturan Presiden Republik Indonesia Nomor 8 Tahun 2012 pasal 5, Penyetaraan capaian pembelajaran yang dihasilkan melalui pendidikan dengan jenjang Program Diploma 3 adalah setara Level 5, dengan deskripsi: Aspek Penguasaan Pengetahuan, Aspek tingkat Kemampuan Kerja dan Aspek tingkat Kerjasama.</li><li>Mempertimbangkan bahwa kompetensi lulusan Politeknik Hasnur harus mengikuti Standar Pendidikan Tinggi Nasional dan menunjukkan ciri khas Politeknik Hasnur, maka diperlukan adanya standar kompetensi lulusan</li></ol>', '<ol><li>Sesuai parameter standar kompetensi lulusan, prodi teknik informatika telah menyusun profil lulusan dengan melibatkan stakeholder serta mengacu pada KKNI level V. Sebagai bukti kinerja dilampirkan lampiran Kuesioner Stakeholder sebagai bukti legal dalam penyusunan Lokakarya Kurikulum D3 teknik Informatika Politeknik Hasnur pada tahun 2019. Adapun pihak yang terlibat dalam kegiatan ini : Bisa di akses pada halaman&nbsp;<a href=\"https://drive.google.com/drive/folders/17aMRq4bCmaTYjeWJ3FMYkj2aDDmOQs_w?usp =sharing\">https://drive.google.com/drive/folders/17aMRq4bCmaTYjeWJ3FMYkj2aDDmOQs_w?usp =sharing</a></li></ol>', '<ol><li>Keterbatasan SDM dalam melakukan Analisis Laporan Tracert</li></ol>', '<ol><li>Perbanyak tim yang focus dalam pengerjaan sesuai kriteria yang di tentutkan untuk tecapainya program studi D3 Teknik Informatika yang berkualitas</li></ol>', 'tidak ada', 1, 2, '2022-04-28 05:06:20', '2022-04-28 05:14:22'),
(2, '<ol><li>Sebagaimana diamanatkan dalam Misi dan Tujuan Politeknik Hasnur untuk mencetak lulusan yang terampil dan memiliki soft skills, leadership, managerial skills serta berstandar kompetensi yang diakui oleh dunia usaha maupun industri</li><li>Sesuai dengan Permenristekdikti No. 44 tahun 2015, untuk memastikan bahwa lulusan Politeknik Hasnur bermutu baik haruslah memiliki unsur sikap, pengetahuan, keterampilan umum dan keterampilan khusus baik sesuai dengan jenjang dan ciri khas masing &ndash; masing program studi, maka perlu adanya standar kompetensi lulusan.</li><li>Berdasarkan Peraturan Presiden Republik Indonesia Nomor 8 Tahun 2012 pasal 5, Penyetaraan capaian pembelajaran yang dihasilkan melalui pendidikan dengan jenjang Program Diploma 3 adalah setara Level 5, dengan deskripsi: Aspek Penguasaan Pengetahuan, Aspek tingkat Kemampuan Kerja dan Aspek tingkat Kerjasama.</li><li>Mempertimbangkan bahwa kompetensi lulusan Politeknik Hasnur harus mengikuti Standar Pendidikan Tinggi Nasional dan menunjukkan ciri khas Politeknik Hasnur, maka diperlukan adanya standar kompetensi lulusan</li></ol>', '<p>Sesuai parameter standar kompetensi lulusan, prodi teknik informatika telah menyusun profil lulusan dengan melibatkan stakeholder serta mengacu pada KKNI level V. Sebagai bukti kinerja dilampirkan lampiran Kuesioner Stakeholder sebagai bukti legal dalam penyusunan Lokakarya Kurikulum D3 teknik Informatika Politeknik Hasnur pada tahun 2019. Adapun pihak yang terlibat dalam kegiatan ini : Bisa di akses pada halaman&nbsp;<a href=\"https://drive.google.com/drive/folders/17aMRq4bCmaTYjeWJ3FMYkj2aDDmOQs_w?usp =sharing\">https://drive.google.com/drive/folders/17aMRq4bCmaTYjeWJ3FMYkj2aDDmOQs_w?usp =sharing</a></p>', '<p>Keterbatasan SDM dalam melakukan Analisis Laporan Tracert</p>', '<p>Perbanyak tim yang focus dalam pengerjaan sesuai kriteria yang di tentutkan untuk tecapainya program studi D3 Teknik Informatika yang berkualitas</p>', 'tidak ada', 2, 2, '2022-05-20 11:02:59', '2022-05-20 11:02:59');

-- --------------------------------------------------------

--
-- Table structure for table `evaluasi_swots`
--

CREATE TABLE `evaluasi_swots` (
  `id` int(10) UNSIGNED NOT NULL,
  `strenght` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weakness` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opportunity` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `strategi_so` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `strategi_wo` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `strategi_st` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `strategi_wt` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `threat` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `indicator_id` int(10) UNSIGNED NOT NULL,
  `auditee_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `evaluasi_swots`
--

INSERT INTO `evaluasi_swots` (`id`, `strenght`, `weakness`, `opportunity`, `strategi_so`, `strategi_wo`, `strategi_st`, `strategi_wt`, `threat`, `indicator_id`, `auditee_id`, `created_at`, `updated_at`) VALUES
(1, '1. SDM Dosen potensial', '1. Jumlah SDM terbatas\r\n2. Minim pengalaman pengembangan kurikulum', NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, '2022-04-28 05:23:20', '2022-04-28 06:16:15'),
(2, '1. SDM Dosen potensial', '1. Jumlah SDM terbatas\r\n2. Minim pengalaman pengembangan kurikulum', NULL, '1. Jumlah SDM terbatas\r\n2. Minim pengalaman pengembangan kurikulum', NULL, NULL, NULL, NULL, 2, 2, '2022-05-20 11:02:59', '2022-05-20 11:02:59');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `indicators`
--

CREATE TABLE `indicators` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `indicators`
--

INSERT INTO `indicators` (`id`, `name`) VALUES
(1, 'Standar Kompetensi Lulusan'),
(2, 'Standar Isi Pembelajaran'),
(3, 'Standar Proses Pembelajaran'),
(4, 'Standar Penilaian Pembelajaran'),
(5, 'Standar Dosen dan Tenaga Kependidikan'),
(6, 'Standar Pengelolaan Pembelajaran'),
(7, 'Standar Pendanaan dan Pembiayaan Pembelajaran');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id` int(10) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `kegiatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rincian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `audit_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id`, `tanggal`, `kegiatan`, `rincian`, `audit_id`, `created_at`, `updated_at`) VALUES
(1, '2022-04-07', 'Pemberitahuan Audit', 'Penyerahan berkas audit', 2, '2022-04-04 06:09:08', '2022-04-04 06:17:25'),
(3, '2022-04-08', 'Kegiatan A', 'Rincian Kegiatan A', 2, '2022-04-04 06:20:25', '2022-04-04 06:20:25');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_pelaksana`
--

CREATE TABLE `jadwal_pelaksana` (
  `jadwal_id` int(10) UNSIGNED NOT NULL,
  `pelaksana_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jadwal_pelaksana`
--

INSERT INTO `jadwal_pelaksana` (`jadwal_id`, `pelaksana_id`) VALUES
(1, 1),
(1, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_03_28_141820_create_permission_tables', 1),
(7, '2022_03_29_124034_create_units_table', 2),
(8, '2022_03_29_141813_create_indicators_table', 3),
(9, '2022_03_31_115805_create_categories_table', 4),
(10, '2022_03_31_120657_create_jadwal_table', 5),
(13, '2022_03_31_121336_create_pelaksana_table', 6),
(14, '2022_03_31_122101_create_jadwal_pelaksana_table', 6),
(15, '2022_03_31_122831_create_audits_table', 7),
(17, '2022_03_31_123214_add_paid_to_jadwal_table', 8),
(19, '2022_03_31_123519_create_auditors_table', 9),
(20, '2022_03_31_123936_create_auditees_table', 10),
(21, '2022_03_31_124129_create_auditor_unit_table', 11),
(22, '2022_04_03_065744_add_unique_to_auditees_table', 12),
(23, '2022_04_03_083658_create_audit_indicators_table', 13),
(24, '2022_04_03_084032_create_audit_indicator_units_table', 13),
(25, '2022_04_07_150202_add_tanggal_to_audits_table', 14),
(32, '2022_04_21_040645_create_evaluasi_rasionals_table', 15),
(33, '2022_04_21_041007_create_evaluasi_parameters_table', 15),
(34, '2022_04_21_041322_create_evaluasi_parameter_tahun_table', 15),
(35, '2022_04_21_041436_create_evaluasi_swots_table', 15),
(36, '2022_04_21_154936_create_catatan_audits_table', 15),
(38, '2022_04_29_110802_add_jadwal_evaluasi_column_to_audits_table', 16),
(41, '2022_05_18_211959_create_audit_plans_table', 17),
(42, '2022_05_18_212601_create_audit_plan_details_table', 17),
(43, '2022_05_18_232643_create_audit_work_steps_table', 18),
(44, '2022_05_18_232652_create_audit_work_step_details_table', 18),
(45, '2022_05_20_191257_create_audit_notes_table', 19),
(48, '2022_05_26_123634_create_ringkasans_table', 20),
(49, '2022_05_26_123705_create_ringkasan_details_table', 20),
(52, '2022_05_26_131412_create_temuans_table', 21);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'user', 1),
(2, 'user', 2),
(2, 'user', 5),
(2, 'user', 6),
(2, 'user', 9),
(2, 'user', 10),
(2, 'user', 11);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelaksana`
--

CREATE TABLE `pelaksana` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pelaksana`
--

INSERT INTO `pelaksana` (`id`, `name`, `description`) VALUES
(1, 'UPM', 'Unit Pelaksana Mutu'),
(2, 'Ka UPM', 'Kepala UPM'),
(3, 'Tim Auditor', 'Tim Auditor'),
(4, 'Ka Auditor', 'Ketua Auditor'),
(5, 'Auditee', 'Auditee'),
(6, 'Direktur', 'Direktur'),
(7, 'Wadir 1', 'Wadir 1'),
(8, 'Wadir 2', 'Wadir 2'),
(9, 'Ka Prodi', 'Ketua Prodi');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ringkasan`
--

CREATE TABLE `ringkasan` (
  `id` int(10) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `approval_pimpinan_audit` int(10) UNSIGNED DEFAULT NULL,
  `approval_ketua_auditor` int(10) UNSIGNED DEFAULT NULL,
  `reviewed_by` int(10) UNSIGNED DEFAULT NULL,
  `auditor_id` int(10) UNSIGNED NOT NULL,
  `auditee_id` int(10) UNSIGNED NOT NULL,
  `indicator_id` int(10) UNSIGNED NOT NULL,
  `audit_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ringkasan`
--

INSERT INTO `ringkasan` (`id`, `tanggal`, `approval_pimpinan_audit`, `approval_ketua_auditor`, `reviewed_by`, `auditor_id`, `auditee_id`, `indicator_id`, `audit_id`, `created_at`, `updated_at`) VALUES
(2, '2022-05-27', NULL, NULL, NULL, 4, 2, 1, 2, '2022-05-26 06:48:54', '2022-05-26 06:48:54');

-- --------------------------------------------------------

--
-- Table structure for table `ringkasan_details`
--

CREATE TABLE `ringkasan_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `temuan` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `ringkasan_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ringkasan_details`
--

INSERT INTO `ringkasan_details` (`id`, `temuan`, `category_id`, `ringkasan_id`, `created_at`, `updated_at`) VALUES
(1, 'Temuan 1', 3, 2, NULL, NULL),
(2, 'Temuan 2', 4, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'kepala upm', 'web', '2022-03-28 06:35:56', '2022-03-28 06:35:56'),
(2, 'user', 'web', '2022-03-28 06:35:56', '2022-03-28 06:35:56');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `temuan`
--

CREATE TABLE `temuan` (
  `id` int(10) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `deskripsi_temuan` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kriteria` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `akar_penyebab` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `akibat` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rekomendasi_temuan` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggapan_auditi` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rencana_perbaikan` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jadwal_perbaikan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pj_perbaikan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jadwal_pencegahan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pj_pencegahan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approval_pimpinan_audit` int(10) UNSIGNED DEFAULT NULL,
  `approval_ketua_auditor` int(10) UNSIGNED DEFAULT NULL,
  `reviewed_by` int(10) UNSIGNED DEFAULT NULL,
  `rekomendasi` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tindakan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penanggung_jawab` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hasil_tindak_lanjut` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auditor_id` int(10) UNSIGNED NOT NULL,
  `auditee_id` int(10) UNSIGNED NOT NULL,
  `indicator_id` int(10) UNSIGNED NOT NULL,
  `audit_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `temuan`
--

INSERT INTO `temuan` (`id`, `tanggal`, `deskripsi_temuan`, `kriteria`, `akar_penyebab`, `akibat`, `rekomendasi_temuan`, `tanggapan_auditi`, `rencana_perbaikan`, `jadwal_perbaikan`, `pj_perbaikan`, `jadwal_pencegahan`, `pj_pencegahan`, `approval_pimpinan_audit`, `approval_ketua_auditor`, `reviewed_by`, `rekomendasi`, `tindakan`, `penanggung_jawab`, `hasil_tindak_lanjut`, `auditor_id`, `auditee_id`, `indicator_id`, `audit_id`, `created_at`, `updated_at`) VALUES
(1, '2022-05-27', '<p>deskripsi</p>', '<p>kriteria</p>', '<p>akar penyebab</p>', '<ul><li>satu</li><li>dua</li><li>tiga</li></ul>', '<ul><li>satu</li><li>dua</li></ul>', 'tanggapan auditi', '<ul><li>rencana perbaikan 1</li><li>rencana perbaikan 2</li></ul>', 'Minimal Bulan Januari 2022', 'Abdullah Ardi', 'Setiap tahun sekali', 'Rusydan Hakim', NULL, NULL, NULL, '<ul><li>Rekomendasi 1</li><li>Rekomendasi 2</li><li>Rekomendasi 3</li></ul>', '<ul><li>Tindakan 1</li><li>Tindakan 2</li></ul>', '<ul><li>Teknis Perbaikan</li><li>Pengawas</li></ul>', '<p>Hasil tindakan</p>', 4, 2, 1, 2, '2022-05-26 08:53:21', '2022-05-26 08:53:21');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `description`) VALUES
(1, 'TO', 'Teknik Otomotif'),
(2, 'TI', 'Teknik informatika'),
(3, 'BTP', 'Budidaya Tanaman Perkebunan'),
(4, 'BAAK', 'Bagian Akademik'),
(5, 'BAUK', 'Bagian Keuangan'),
(6, 'UPT PP', 'UPT PP');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'upm', 'Danang Yugo Pratomo', NULL, NULL, '$2a$12$/p/VN.qGiLHoz.hJmWufou5Ci0HSMG5Af7MJZT8WA0S1VM4w3DSrG', 'K5FatUzyumtgHK8kmWeWKlIyNSAI7BaHkPTyXK3q4qZgow2kpkcw85mm1BDs', 1, '2022-03-28 08:03:43', '2022-03-29 08:54:52'),
(2, 'rimar', 'Rimar Callista', NULL, NULL, '$2y$10$iHhSjhH8RrbbgGq4Rg.iDO/L5KB/ftvl2QIgUnfBCJHeNVy8y5.G.', 'qMjK0MOKz7UlOyjaXehN6mWUjpVgdzI2ZcVKMtbmNMuSJCEehXbb3j349ANu', 1, '2022-03-28 08:12:10', '2022-04-21 14:12:36'),
(5, 'rendi', 'Rendi Tamamilang', NULL, NULL, '$2y$10$Iu8XVW/kj2U0hJEfNA9Syuxhn9rfX.zCDzEKeJZ5xa5XKPBQYeX9G', 'aziGux3Doc8hFSjVNQ2eEuu0mAe93Ht7Lt1SyBhS6lTkUzwuZHsJ3CkjfiSK', 1, '2022-03-29 07:59:41', '2022-04-21 14:12:26'),
(6, 'andika', 'Andika Pratama', NULL, NULL, '$2y$10$W/PxWHWCbVEr0YIjXpKWo.W8AIZGiiHdD/u6ehNti6fBLTwLE2rpW', 'AfLjNJOppVjsS5T7wW3u5XGIoYCrdDj0BE5YQSA3jLxDAo2YlwmHVeng2HFX', 1, '2022-03-29 08:00:43', '2022-04-21 14:11:51'),
(9, 'arhan', 'Pratama Arhan', NULL, NULL, '$2y$10$CisLjA8U2UbuZZMPsjKaNOz2MditQwF4qx2iBU6Pl7LBqBaGTQWEK', 'XCxcGAHfdvUkPLhEr2EhmEigrOXvGeajdOyotZTC41GTTtwb6hCb7VtAuSQJ', 1, '2022-03-29 08:15:20', '2022-04-21 14:12:19'),
(10, 'indahpermata', 'Indah Permatasari', NULL, NULL, '$2y$10$w6868MCycIXCWlW55y9C1.BsKenXRV3bR2TsIwfk0NxdSAKABTGma', NULL, 1, '2022-03-29 08:20:35', '2022-04-21 14:12:02'),
(11, 'meta', 'Meta Agustina', NULL, NULL, '$2y$10$Uem3ZjMo4EtqP8h22ZhyrOr6Jp7SqPUowW1pdAnKUiSibHYyVS81K', NULL, 1, '2022-03-29 08:23:04', '2022-04-21 14:12:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auditees`
--
ALTER TABLE `auditees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `auditees_unit_id_user_id_audit_id_unique` (`unit_id`,`user_id`,`audit_id`),
  ADD KEY `auditees_user_id_foreign` (`user_id`),
  ADD KEY `auditees_audit_id_foreign` (`audit_id`);

--
-- Indexes for table `auditors`
--
ALTER TABLE `auditors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auditors_user_id_foreign` (`user_id`),
  ADD KEY `auditors_pelaksana_id_foreign` (`pelaksana_id`),
  ADD KEY `auditors_audit_id_foreign` (`audit_id`);

--
-- Indexes for table `auditor_unit`
--
ALTER TABLE `auditor_unit`
  ADD KEY `auditor_unit_auditor_id_foreign` (`auditor_id`),
  ADD KEY `auditor_unit_unit_id_foreign` (`unit_id`);

--
-- Indexes for table `audits`
--
ALTER TABLE `audits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `audit_indicators`
--
ALTER TABLE `audit_indicators`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audit_indicators_audit_id_foreign` (`audit_id`),
  ADD KEY `audit_indicators_indicator_id_foreign` (`indicator_id`);

--
-- Indexes for table `audit_indicator_units`
--
ALTER TABLE `audit_indicator_units`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `audit_indicator_units_audit_indicator_id_unit_id_unique` (`audit_indicator_id`,`unit_id`),
  ADD KEY `audit_indicator_units_unit_id_foreign` (`unit_id`);

--
-- Indexes for table `audit_notes`
--
ALTER TABLE `audit_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audit_notes_auditor_id_foreign` (`auditor_id`),
  ADD KEY `audit_notes_auditee_id_foreign` (`auditee_id`),
  ADD KEY `audit_notes_indicator_id_foreign` (`indicator_id`),
  ADD KEY `audit_notes_audit_id_foreign` (`audit_id`);

--
-- Indexes for table `audit_plans`
--
ALTER TABLE `audit_plans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audit_plans_auditor_id_foreign` (`auditor_id`),
  ADD KEY `audit_plans_auditee_id_foreign` (`auditee_id`),
  ADD KEY `audit_plans_indicator_id_foreign` (`indicator_id`),
  ADD KEY `audit_plans_audit_id_foreign` (`audit_id`);

--
-- Indexes for table `audit_plan_details`
--
ALTER TABLE `audit_plan_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audit_plan_details_audit_plan_id_foreign` (`audit_plan_id`);

--
-- Indexes for table `audit_work_steps`
--
ALTER TABLE `audit_work_steps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audit_work_steps_auditor_id_foreign` (`auditor_id`),
  ADD KEY `audit_work_steps_auditee_id_foreign` (`auditee_id`),
  ADD KEY `audit_work_steps_indicator_id_foreign` (`indicator_id`),
  ADD KEY `audit_work_steps_audit_id_foreign` (`audit_id`);

--
-- Indexes for table `audit_work_step_details`
--
ALTER TABLE `audit_work_step_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audit_work_step_details_audit_work_step_id_foreign` (`audit_work_step_id`);

--
-- Indexes for table `catatan_audits`
--
ALTER TABLE `catatan_audits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `catatan_audits_auditee_id_foreign` (`auditee_id`),
  ADD KEY `catatan_audits_indicator_id_foreign` (`indicator_id`),
  ADD KEY `catatan_audits_auditor_id_foreign` (`auditor_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evaluasi_parameters`
--
ALTER TABLE `evaluasi_parameters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evaluasi_parameters_indicator_id_foreign` (`indicator_id`),
  ADD KEY `evaluasi_parameters_auditee_id_foreign` (`auditee_id`);

--
-- Indexes for table `evaluasi_parameter_tahun`
--
ALTER TABLE `evaluasi_parameter_tahun`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evaluasi_parameter_tahun_evaluasi_parameter_id_foreign` (`evaluasi_parameter_id`);

--
-- Indexes for table `evaluasi_rasionals`
--
ALTER TABLE `evaluasi_rasionals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evaluasi_rasionals_indicator_id_foreign` (`indicator_id`),
  ADD KEY `evaluasi_rasionals_auditee_id_foreign` (`auditee_id`);

--
-- Indexes for table `evaluasi_swots`
--
ALTER TABLE `evaluasi_swots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evaluasi_swots_indicator_id_foreign` (`indicator_id`),
  ADD KEY `evaluasi_swots_auditee_id_foreign` (`auditee_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `indicators`
--
ALTER TABLE `indicators`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jadwal_audit_id_foreign` (`audit_id`);

--
-- Indexes for table `jadwal_pelaksana`
--
ALTER TABLE `jadwal_pelaksana`
  ADD KEY `jadwal_pelaksana_jadwal_id_foreign` (`jadwal_id`),
  ADD KEY `jadwal_pelaksana_pelaksana_id_foreign` (`pelaksana_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pelaksana`
--
ALTER TABLE `pelaksana`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `ringkasan`
--
ALTER TABLE `ringkasan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ringkasan_auditor_id_foreign` (`auditor_id`),
  ADD KEY `ringkasan_auditee_id_foreign` (`auditee_id`),
  ADD KEY `ringkasan_indicator_id_foreign` (`indicator_id`),
  ADD KEY `ringkasan_audit_id_foreign` (`audit_id`);

--
-- Indexes for table `ringkasan_details`
--
ALTER TABLE `ringkasan_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ringkasan_details_category_id_foreign` (`category_id`),
  ADD KEY `ringkasan_details_ringkasan_id_foreign` (`ringkasan_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `temuan`
--
ALTER TABLE `temuan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `temuan_auditor_id_foreign` (`auditor_id`),
  ADD KEY `temuan_auditee_id_foreign` (`auditee_id`),
  ADD KEY `temuan_indicator_id_foreign` (`indicator_id`),
  ADD KEY `temuan_audit_id_foreign` (`audit_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auditees`
--
ALTER TABLE `auditees`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `auditors`
--
ALTER TABLE `auditors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `audits`
--
ALTER TABLE `audits`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `audit_indicators`
--
ALTER TABLE `audit_indicators`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `audit_indicator_units`
--
ALTER TABLE `audit_indicator_units`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `audit_notes`
--
ALTER TABLE `audit_notes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `audit_plans`
--
ALTER TABLE `audit_plans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `audit_plan_details`
--
ALTER TABLE `audit_plan_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `audit_work_steps`
--
ALTER TABLE `audit_work_steps`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `audit_work_step_details`
--
ALTER TABLE `audit_work_step_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `catatan_audits`
--
ALTER TABLE `catatan_audits`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `evaluasi_parameters`
--
ALTER TABLE `evaluasi_parameters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `evaluasi_parameter_tahun`
--
ALTER TABLE `evaluasi_parameter_tahun`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `evaluasi_rasionals`
--
ALTER TABLE `evaluasi_rasionals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `evaluasi_swots`
--
ALTER TABLE `evaluasi_swots`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `indicators`
--
ALTER TABLE `indicators`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `pelaksana`
--
ALTER TABLE `pelaksana`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ringkasan`
--
ALTER TABLE `ringkasan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ringkasan_details`
--
ALTER TABLE `ringkasan_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `temuan`
--
ALTER TABLE `temuan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auditees`
--
ALTER TABLE `auditees`
  ADD CONSTRAINT `auditees_audit_id_foreign` FOREIGN KEY (`audit_id`) REFERENCES `audits` (`id`),
  ADD CONSTRAINT `auditees_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`),
  ADD CONSTRAINT `auditees_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `auditors`
--
ALTER TABLE `auditors`
  ADD CONSTRAINT `auditors_audit_id_foreign` FOREIGN KEY (`audit_id`) REFERENCES `audits` (`id`),
  ADD CONSTRAINT `auditors_pelaksana_id_foreign` FOREIGN KEY (`pelaksana_id`) REFERENCES `pelaksana` (`id`),
  ADD CONSTRAINT `auditors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `auditor_unit`
--
ALTER TABLE `auditor_unit`
  ADD CONSTRAINT `auditor_unit_auditor_id_foreign` FOREIGN KEY (`auditor_id`) REFERENCES `auditors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auditor_unit_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `audit_indicators`
--
ALTER TABLE `audit_indicators`
  ADD CONSTRAINT `audit_indicators_audit_id_foreign` FOREIGN KEY (`audit_id`) REFERENCES `audits` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `audit_indicators_indicator_id_foreign` FOREIGN KEY (`indicator_id`) REFERENCES `indicators` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `audit_indicator_units`
--
ALTER TABLE `audit_indicator_units`
  ADD CONSTRAINT `audit_indicator_units_audit_indicator_id_foreign` FOREIGN KEY (`audit_indicator_id`) REFERENCES `audit_indicators` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `audit_indicator_units_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `audit_notes`
--
ALTER TABLE `audit_notes`
  ADD CONSTRAINT `audit_notes_audit_id_foreign` FOREIGN KEY (`audit_id`) REFERENCES `audits` (`id`),
  ADD CONSTRAINT `audit_notes_auditee_id_foreign` FOREIGN KEY (`auditee_id`) REFERENCES `auditees` (`id`),
  ADD CONSTRAINT `audit_notes_auditor_id_foreign` FOREIGN KEY (`auditor_id`) REFERENCES `auditors` (`id`),
  ADD CONSTRAINT `audit_notes_indicator_id_foreign` FOREIGN KEY (`indicator_id`) REFERENCES `indicators` (`id`);

--
-- Constraints for table `audit_plans`
--
ALTER TABLE `audit_plans`
  ADD CONSTRAINT `audit_plans_audit_id_foreign` FOREIGN KEY (`audit_id`) REFERENCES `audits` (`id`),
  ADD CONSTRAINT `audit_plans_auditee_id_foreign` FOREIGN KEY (`auditee_id`) REFERENCES `auditees` (`id`),
  ADD CONSTRAINT `audit_plans_auditor_id_foreign` FOREIGN KEY (`auditor_id`) REFERENCES `auditors` (`id`),
  ADD CONSTRAINT `audit_plans_indicator_id_foreign` FOREIGN KEY (`indicator_id`) REFERENCES `indicators` (`id`);

--
-- Constraints for table `audit_plan_details`
--
ALTER TABLE `audit_plan_details`
  ADD CONSTRAINT `audit_plan_details_audit_plan_id_foreign` FOREIGN KEY (`audit_plan_id`) REFERENCES `audit_plans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `audit_work_steps`
--
ALTER TABLE `audit_work_steps`
  ADD CONSTRAINT `audit_work_steps_audit_id_foreign` FOREIGN KEY (`audit_id`) REFERENCES `audits` (`id`),
  ADD CONSTRAINT `audit_work_steps_auditee_id_foreign` FOREIGN KEY (`auditee_id`) REFERENCES `auditees` (`id`),
  ADD CONSTRAINT `audit_work_steps_auditor_id_foreign` FOREIGN KEY (`auditor_id`) REFERENCES `auditors` (`id`),
  ADD CONSTRAINT `audit_work_steps_indicator_id_foreign` FOREIGN KEY (`indicator_id`) REFERENCES `indicators` (`id`);

--
-- Constraints for table `audit_work_step_details`
--
ALTER TABLE `audit_work_step_details`
  ADD CONSTRAINT `audit_work_step_details_audit_work_step_id_foreign` FOREIGN KEY (`audit_work_step_id`) REFERENCES `audit_work_steps` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `catatan_audits`
--
ALTER TABLE `catatan_audits`
  ADD CONSTRAINT `catatan_audits_auditee_id_foreign` FOREIGN KEY (`auditee_id`) REFERENCES `auditees` (`id`),
  ADD CONSTRAINT `catatan_audits_auditor_id_foreign` FOREIGN KEY (`auditor_id`) REFERENCES `auditors` (`id`),
  ADD CONSTRAINT `catatan_audits_indicator_id_foreign` FOREIGN KEY (`indicator_id`) REFERENCES `indicators` (`id`);

--
-- Constraints for table `evaluasi_parameters`
--
ALTER TABLE `evaluasi_parameters`
  ADD CONSTRAINT `evaluasi_parameters_auditee_id_foreign` FOREIGN KEY (`auditee_id`) REFERENCES `auditees` (`id`),
  ADD CONSTRAINT `evaluasi_parameters_indicator_id_foreign` FOREIGN KEY (`indicator_id`) REFERENCES `indicators` (`id`);

--
-- Constraints for table `evaluasi_parameter_tahun`
--
ALTER TABLE `evaluasi_parameter_tahun`
  ADD CONSTRAINT `evaluasi_parameter_tahun_evaluasi_parameter_id_foreign` FOREIGN KEY (`evaluasi_parameter_id`) REFERENCES `evaluasi_parameters` (`id`);

--
-- Constraints for table `evaluasi_rasionals`
--
ALTER TABLE `evaluasi_rasionals`
  ADD CONSTRAINT `evaluasi_rasionals_auditee_id_foreign` FOREIGN KEY (`auditee_id`) REFERENCES `auditees` (`id`),
  ADD CONSTRAINT `evaluasi_rasionals_indicator_id_foreign` FOREIGN KEY (`indicator_id`) REFERENCES `indicators` (`id`);

--
-- Constraints for table `evaluasi_swots`
--
ALTER TABLE `evaluasi_swots`
  ADD CONSTRAINT `evaluasi_swots_auditee_id_foreign` FOREIGN KEY (`auditee_id`) REFERENCES `auditees` (`id`),
  ADD CONSTRAINT `evaluasi_swots_indicator_id_foreign` FOREIGN KEY (`indicator_id`) REFERENCES `indicators` (`id`);

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_audit_id_foreign` FOREIGN KEY (`audit_id`) REFERENCES `audits` (`id`);

--
-- Constraints for table `jadwal_pelaksana`
--
ALTER TABLE `jadwal_pelaksana`
  ADD CONSTRAINT `jadwal_pelaksana_jadwal_id_foreign` FOREIGN KEY (`jadwal_id`) REFERENCES `jadwal` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jadwal_pelaksana_pelaksana_id_foreign` FOREIGN KEY (`pelaksana_id`) REFERENCES `pelaksana` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ringkasan`
--
ALTER TABLE `ringkasan`
  ADD CONSTRAINT `ringkasan_audit_id_foreign` FOREIGN KEY (`audit_id`) REFERENCES `audits` (`id`),
  ADD CONSTRAINT `ringkasan_auditee_id_foreign` FOREIGN KEY (`auditee_id`) REFERENCES `auditees` (`id`),
  ADD CONSTRAINT `ringkasan_auditor_id_foreign` FOREIGN KEY (`auditor_id`) REFERENCES `auditors` (`id`),
  ADD CONSTRAINT `ringkasan_indicator_id_foreign` FOREIGN KEY (`indicator_id`) REFERENCES `indicators` (`id`);

--
-- Constraints for table `ringkasan_details`
--
ALTER TABLE `ringkasan_details`
  ADD CONSTRAINT `ringkasan_details_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `ringkasan_details_ringkasan_id_foreign` FOREIGN KEY (`ringkasan_id`) REFERENCES `ringkasan` (`id`);

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `temuan`
--
ALTER TABLE `temuan`
  ADD CONSTRAINT `temuan_audit_id_foreign` FOREIGN KEY (`audit_id`) REFERENCES `audits` (`id`),
  ADD CONSTRAINT `temuan_auditee_id_foreign` FOREIGN KEY (`auditee_id`) REFERENCES `auditees` (`id`),
  ADD CONSTRAINT `temuan_auditor_id_foreign` FOREIGN KEY (`auditor_id`) REFERENCES `auditors` (`id`),
  ADD CONSTRAINT `temuan_indicator_id_foreign` FOREIGN KEY (`indicator_id`) REFERENCES `indicators` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
