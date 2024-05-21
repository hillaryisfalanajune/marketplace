-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 21, 2024 at 11:08 AM
-- Server version: 8.0.35-cll-lve
-- PHP Version: 8.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `barbeqsh_laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggotas`
--

CREATE TABLE `anggotas` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `anggotas`
--

INSERT INTO `anggotas` (`id`, `name`, `phone`, `email`, `updated_at`, `created_at`) VALUES
(1, 'admin', 141413, 'admin@gmail.com', '2024-04-22', '2024-04-22'),
(2, 'dhan', 82287, 'dhn@gmail.com', '2024-04-22', '2024-04-22'),
(3, 'test', 13414, 'dasda@mail', '2024-04-22', '2024-04-22'),
(4, 'Dhaniel', 88080808, 'dhany6654@gmail.com', '2024-04-22', '2024-04-22'),
(5, 'ahhas', 19292, 'hillaryjune2309@gmail.com', '2024-04-22', '2024-04-22');

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id` int NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `detail` varchar(3000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `gambar`, `detail`) VALUES
(1, 'https://barbeqshop.online/pesanan-images/disc_1715919899.jpg', 'Lupakan bahwa Foto Sampul Facebook(opens in a new tab or window)berukuran 851 x 315 piksel atau Banner X (Twitter) harus berukuran 1500 x 500 piksel. Dengan pembuat banner dari Canva, Anda dapat menelusuri dan menyesuaikan banner web untuk setiap platform, lalu langsung mengunduh grafis beresolusi tinggi dalam setiap format (JPEG, PNG, PDF).'),
(2, 'https://barbeqshop.online/pesanan-images/wp9024457_1715919831.jpg', 'sfaf');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint UNSIGNED NOT NULL,
  `produk_id` int NOT NULL,
  `user_id` int NOT NULL,
  `penjual_id` int NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `produk_id`, `user_id`, `penjual_id`, `nama_produk`, `harga`, `gambar`, `created_at`, `updated_at`) VALUES
(12, 0, 0, 0, 'panci goreng', 80000, 'https://barbeqshop.online/produk-images/1714450388.jpg', '2024-04-30 00:50:54', '2024-04-30 00:50:54'),
(15, 0, 0, 0, 'sapuuuu', 650000, 'https://barbeqshop.online/produk-images/1714450241.jpg', '2024-05-05 21:09:25', '2024-05-05 21:09:25'),
(16, 0, 0, 0, 'cuyik', 125321, 'https://barbeqshop.online/produk-images/1714808994.jpg', '2024-05-05 21:09:49', '2024-05-05 21:09:49'),
(31, 0, 19, 0, 'sapuuuu', 650000, 'https://barbeqshop.online/produk-images/1714450241.jpg', '2024-05-14 05:29:35', '2024-05-14 05:29:35'),
(32, 0, 19, 0, 'sapuuuu', 650000, 'https://barbeqshop.online/produk-images/1714450241.jpg', '2024-05-14 05:29:38', '2024-05-14 05:29:38'),
(33, 0, 19, 0, 'mouse bekas', 50000, 'https://barbeqshop.online/produk-images/1715155211.jpg', '2024-05-14 08:54:23', '2024-05-14 08:54:23'),
(37, 30, 12, 20, 'panci goreng', 80000, 'https://barbeqshop.online/produk-images/1714450388.jpg', '2024-05-15 02:05:05', '2024-05-15 02:05:05'),
(38, 32, 12, 20, 'crob top', 70000, 'https://barbeqshop.online/produk-images/1714450703.jpg', '2024-05-15 02:11:28', '2024-05-15 02:11:28'),
(39, 29, 24, 20, 'sapuuuu', 650000, 'https://barbeqshop.online/produk-images/1714450241.jpg', '2024-05-15 21:03:42', '2024-05-15 21:03:42'),
(40, 29, 23, 20, 'sapuuuu', 650000, 'https://barbeqshop.online/produk-images/1714450241.jpg', '2024-05-15 21:15:39', '2024-05-15 21:15:39'),
(41, 31, 23, 20, 'rok mini', 120000, 'https://barbeqshop.online/produk-images/1714450510.jpg', '2024-05-15 21:16:10', '2024-05-15 21:16:10'),
(44, 29, 26, 20, 'sapuuuu', 650000, 'https://barbeqshop.online/produk-images/1714450241.jpg', '2024-05-17 01:23:39', '2024-05-17 01:23:39'),
(45, 33, 25, 20, 'baju sekolah', 145000, 'https://barbeqshop.online/produk-images/1714450790.jpg', '2024-05-17 01:31:12', '2024-05-17 01:31:12'),
(47, 29, 18, 20, 'sapuuuu', 650000, 'https://barbeqshop.online/produk-images/1714450241.jpg', '2024-05-19 20:48:26', '2024-05-19 20:48:26'),
(48, 30, 18, 20, 'panci goreng', 80000, 'https://barbeqshop.online/produk-images/1714450388.jpg', '2024-05-19 20:49:05', '2024-05-19 20:49:05'),
(49, 32, 18, 20, 'crob top', 70000, 'https://barbeqshop.online/produk-images/1714450703.jpg', '2024-05-19 20:49:39', '2024-05-19 20:49:39'),
(50, 31, 23, 20, 'rok mini', 120000, 'https://barbeqshop.online/produk-images/1714450510.jpg', '2024-05-20 00:15:11', '2024-05-20 00:15:11'),
(51, 34, 18, 20, 'cuyik', 125321, 'https://barbeqshop.online/produk-images/1714808994.jpg', '2024-05-20 00:48:24', '2024-05-20 00:48:24');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategoris`
--

CREATE TABLE `kategoris` (
  `id` bigint UNSIGNED NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_kategori` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategoris`
--

INSERT INTO `kategoris` (`id`, `kode`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'wrap23', 'baju', NULL, NULL),
(2, 'wrap24', 'laptop', NULL, NULL),
(3, 'wrap25', 'celana', NULL, NULL),
(9, 'ara24', 'Perlengkapan Sekolah', '2024-03-13 00:33:57', '2024-03-13 00:33:57'),
(10, 'qr22', 'Perlengkapan Rumah', '2024-03-13 00:38:01', '2024-03-13 00:38:01'),
(11, '123456', 'turu', '2024-03-13 01:27:47', '2024-03-13 01:27:47'),
(12, '2135621gju', 'tas', '2024-03-13 02:13:13', '2024-03-13 02:13:13'),
(13, 'PDC', 'test', '2024-03-13 02:14:15', '2024-03-13 02:14:15'),
(14, 'asd', 'asd', '2024-03-13 02:17:59', '2024-03-13 02:17:59'),
(15, '44rg', 'buku', '2024-03-13 19:16:27', '2024-03-13 19:16:27'),
(16, 'acv23', 'Elektronik', '2024-03-13 23:07:09', '2024-03-13 23:07:09');

-- --------------------------------------------------------

--
-- Table structure for table `keuangans`
--

CREATE TABLE `keuangans` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_02_29_033110_create_role_table', 1),
(6, '2024_02_29_033333_create_penjual_table', 1),
(7, '2024_02_29_033439_create_produk_table', 1),
(8, '2024_02_29_033618_create_kategori_table', 1),
(9, '2024_02_29_033748_create_pembeli_table', 1),
(10, '2024_02_29_033944_create_transaksi_table', 1),
(11, '2024_02_29_034044_create_pembayaran_table', 1),
(12, '2024_03_04_041919_create_penjuals_table', 2),
(13, '2024_03_05_032659_create_kategoris_table', 3),
(14, '2024_03_05_034011_create_kategoris_table', 4),
(15, '2024_03_06_053817_create_tests_table', 5),
(16, '2024_03_06_075718_create_pembelis_table', 6),
(17, '2024_03_06_080137_create_pembelis_table', 7),
(18, '2024_03_07_032117_create_pengirimen_table', 8),
(19, '2024_03_07_034626_create_pengirimans_table', 9),
(20, '2024_03_07_072704_create_transaksis_table', 10),
(21, '2024_03_08_030222_create_statuss_table', 11),
(22, '2024_03_08_074437_create_keuangans_table', 12),
(23, '2024_03_13_022219_create_keuangans_table', 13),
(24, '2024_03_22_075031_add_is_admin_user', 14),
(25, '2024_03_24_141130_add_is_superadmin_user', 15),
(26, '2024_03_22_063039_create_wishlists_table', 16),
(27, '2024_03_22_074853_create_carts_table', 16),
(28, '2024_03_25_040309_create_promos_table', 16),
(29, '2024_03_29_213827_create_pengirimans_table', 17),
(30, '2024_03_30_164501_create_pesanans_table', 18),
(31, '2024_04_04_041631_create_rekenings_table', 19),
(32, '2024_04_18_065841_create_statusverifikasis_table', 20);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` bigint UNSIGNED NOT NULL,
  `id_transaksi` bigint UNSIGNED NOT NULL,
  `no_rek` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_bank` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `atas_nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_bayar` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembelis`
--

CREATE TABLE `pembelis` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_tlp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_pembeli` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembelis`
--

INSERT INTO `pembelis` (`id`, `name`, `no_tlp`, `alamat_pembeli`, `gambar`, `created_at`, `updated_at`, `email`, `password`, `token`) VALUES
(2, 'rani', '3467898', 'Solok', NULL, NULL, NULL, '', '0', ''),
(3, 'zeta', '8764834', 'Padang Panjang', NULL, NULL, NULL, '', '0', ''),
(4, 'dita', '74357854', 'Bukit Tinggi', NULL, NULL, NULL, '', '0', ''),
(5, 'ai', '23444546', 'PKU', NULL, NULL, NULL, '', '0', ''),
(6, 'dhaniel', '849653980', 'PKU', NULL, NULL, NULL, '', '0', ''),
(7, 'BG VIKI', '74368762', 'TANGSEL', NULL, NULL, NULL, '', '0', ''),
(8, 'BG RONI', '879586969', 'PADANG', NULL, NULL, NULL, '', '0', ''),
(9, 'WIN', '7483594', 'JABAR', NULL, NULL, NULL, '', '0', ''),
(10, 'CACA', '98789468', 'JATENG', NULL, NULL, NULL, '', '0', ''),
(11, 'NURUL', '88734687', 'JATIM', NULL, NULL, NULL, '', '0', ''),
(12, 'dhan', '085942148562', NULL, 'https://barbeqshop.online/pembeli-images/1715680825_1000083247.jpg', '2024-04-28 19:54:57', '2024-05-14 03:00:25', 'dhnn@gmail.com', '$2y$12$84vtLk28cEESPjYjkqAg8eJasey65QabIp51NY5NqnXx5oT1t1zhC', ''),
(13, 'eususu', '121232', NULL, NULL, '2024-04-29 02:51:46', '2024-04-29 02:51:46', 'dhany6654@gmail.com', '$2y$12$vq7WGunjoL3HSbsHvRqUKO6UxamjlgrE2bOlMZ8C2VRnGS6OX.Xja', NULL),
(14, 'dhan', '41114341341', NULL, NULL, '2024-04-29 20:02:00', '2024-04-29 20:02:00', 'dhnen@gmail.com', '$2y$12$Mrs7LraD.c9S/9//oA5UjuMCTMBAUYywJBRTimK2vhzNwmt/z74VK', NULL),
(15, 'dhan', '41114341341', NULL, NULL, '2024-04-29 20:04:00', '2024-04-29 20:04:00', 'dhnen@gmail.comg', '$2y$12$LwUlCrqR0KFny4rOh2IaiOlKR3mejwoNaKA6rKa5SaAjyD6osrPJy', NULL),
(16, 'dhank', '412414', NULL, NULL, '2024-04-29 20:09:16', '2024-04-29 20:09:16', 'ddnn@gmail.com', '$2y$12$pCalNYgdiN/fScDF4MPwceYJW.8HypnnVVNuJj0NMrgdqcHT3NEOy', NULL),
(17, 'dad', '54355', NULL, NULL, '2024-04-29 20:27:44', '2024-04-29 20:27:44', 'asu@mail.com', '$2y$12$1IYmhgZhGG6KcWTJ7lu2U.OHQ4OM937y4OZ7V6rwvFbMZ7fqRbeCi', NULL),
(18, 'Pandu', '08765432478', NULL, 'https://barbeqshop.online/produk-images/1714450241.jpg', '2024-04-29 20:53:01', '2024-05-16 00:21:02', 'pnd@gmail.com', '$2y$12$SCii3ZiTPk6I5K.ZjqXxX.CodOhQFq5S9cqRHobyGV1BPRl0CPj8i', NULL),
(19, 'pantek', '08sumbarangtakan', NULL, NULL, '2024-05-14 05:29:01', '2024-05-14 05:29:01', 'thoriqihiw@gmail.com', '$2y$12$4/leAnfKwgjDAQ9Y74XMUOgqvel4gxCRH5ln/sC1.myouknkuEvka', NULL),
(20, 'pantek', '08sumbarangtakan', NULL, NULL, '2024-05-14 05:29:02', '2024-05-14 05:29:02', 'thoriqihiw@gmail.com', '$2y$12$lqUHF4FWH8ZchswYxF95.uBRM0dLFy6FQXa4gZjqUeNrUC4oLnXPy', NULL),
(21, 'pantek', '08sumbarangtakan', NULL, NULL, '2024-05-14 05:29:02', '2024-05-14 05:29:02', 'thoriqihiw@gmail.com', '$2y$12$2z7G6HLpdRYOvXt7LOcTHeQtpEPwuttqY.I0/pCYK.uaOLO36sl9C', NULL),
(22, 'Daniel', '085942148562', NULL, NULL, '2024-05-15 11:08:19', '2024-05-15 11:08:19', 'dhany6654@gmail.com', '$2y$12$T9ZiRvs0SUfyRPVD///GA.kO2NrNEtuxGM4XobkOjdiPQhVE01F.K', NULL),
(23, 'dhaniel', '097895743525', NULL, 'https://barbeqshop.online/pembeli-images/1715831853_Viper_VALORANT.jpg', '2024-05-15 20:55:44', '2024-05-15 20:57:33', 'dhany6649@gmail.com', '$2y$12$qNDKQDxVlgeZbALfF8Z6d.2H4FkQH1D53Evg16m5TkpNAiUhkWGFy', NULL),
(24, 'sadad', '1412412412', NULL, 'https://barbeqshop.online/pembeli-images/1715832144_1000000034.jpg', '2024-05-15 21:00:50', '2024-05-15 21:02:24', 'test@example.com', '$2y$12$NEw9XYZYF3mlzdDVitwGaOycHb69aPzPNXiOUnH4MyWaFtrkG4Pp.', NULL),
(25, 'ishabel', '085267196972', NULL, 'https://barbeqshop.online/pembeli-images/1715944481_IMG-20240517-WA0000.jpg', '2024-05-16 01:35:43', '2024-05-17 04:14:41', 'ishabell414@gmail.com', '$2y$12$G5ClKFKWSU8ZWbJwvwkPrechbf.bzbWYSruq8HSb.BNsOQGS/2V0q', NULL),
(26, 'ayi', '083186940022', NULL, 'https://barbeqshop.online/pembeli-images/1715934296_1000083295.jpg', '2024-05-17 01:23:05', '2024-05-17 01:24:56', 'ayi@gmail.com', '$2y$12$QyTvrARKkC4siI7flGAwnunmEGjfmZTAmh.ydApCrhg7.HrfZOXIa', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pesanans`
--

CREATE TABLE `pesanans` (
  `id` bigint UNSIGNED NOT NULL,
  `produk_id` bigint UNSIGNED NOT NULL,
  `pembeli_id` bigint UNSIGNED NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `cara_bayar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bukti_transfer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status_id` tinyint UNSIGNED DEFAULT NULL,
  `statusverifikasi_id` tinyint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pesanans`
--

INSERT INTO `pesanans` (`id`, `produk_id`, `pembeli_id`, `alamat`, `user_id`, `cara_bayar`, `bukti_transfer`, `status_id`, `statusverifikasi_id`, `created_at`, `updated_at`) VALUES
(27, 29, 23, 'sfa', 20, '2', 'https://barbeqshop.online/pesanan-images/1000000034_1715850606.jpg', NULL, NULL, '2024-05-16 02:10:06', '2024-05-16 02:10:06'),
(31, 29, 23, 'fasfa', 20, '2', 'https://barbeqshop.online/pesanan-images/1000000034_1715852705.jpg', 3, NULL, '2024-05-16 02:45:05', '2024-05-16 02:45:05'),
(37, 31, 23, 'porselin', 20, '2', 'https://barbeqshop.online/pesanan-images/1000000034_1715914822.jpg', 1, NULL, '2024-05-16 20:00:22', '2024-05-16 20:00:22'),
(51, 29, 26, 'Jl. Mandar III No.66 Blok DC10, Pd. Karya, Kec. Pd. Aren, Kota Tangerang Selatan, Banten 15225', 20, '2', 'https://barbeqshop.online/pesanan-images/1000083236_1715934406.jpg', 1, NULL, '2024-05-17 01:26:46', '2024-05-17 01:26:46'),
(75, 29, 23, 'zcz', 20, '2', 'https://barbeqshop.online/pesanan-images/1000000034_1716180836.jpg', 1, NULL, '2024-05-19 21:53:56', '2024-05-19 21:53:56'),
(76, 29, 18, 'hbi', 20, '2', 'https://barbeqshop.online/pesanan-images/1000221871_1716180958.jpg', NULL, NULL, '2024-05-19 21:55:58', '2024-05-19 21:55:58'),
(77, 30, 18, 'itdru', 20, '1', NULL, 1, NULL, '2024-05-19 21:56:55', '2024-05-19 21:56:55'),
(78, 32, 18, 'jl. tanmalaka', 20, '2', 'https://barbeqshop.online/pesanan-images/1000230504_1716191125.jpg', NULL, NULL, '2024-05-20 00:45:25', '2024-05-20 00:45:25'),
(90, 31, 23, 'kjl', 20, '1', NULL, 1, NULL, '2024-05-20 02:32:27', '2024-05-20 02:32:27'),
(91, 31, 23, 'ds', 20, '1', NULL, 1, NULL, '2024-05-20 02:34:04', '2024-05-20 02:34:04'),
(92, 31, 23, 'd', 20, '1', NULL, 1, NULL, '2024-05-20 02:37:02', '2024-05-20 02:37:02'),
(93, 29, 23, 'd', 20, '1', NULL, 1, NULL, '2024-05-20 02:50:23', '2024-05-20 02:50:23'),
(94, 29, 12, 'Jl. Mandar III No.66 Blok DC10, Pd. Karya, Kec. Pd. Aren, Kota Tangerang Selatan, Banten 15225', 20, '2', 'https://barbeqshop.online/pesanan-images/1000083729_1716212318.jpg', 1, NULL, '2024-05-20 06:38:38', '2024-05-20 06:38:38');

-- --------------------------------------------------------

--
-- Table structure for table `produks`
--

CREATE TABLE `produks` (
  `id` bigint UNSIGNED NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` bigint NOT NULL,
  `stock` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no-images.jpg',
  `detail` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint NOT NULL,
  `kategori_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produks`
--

INSERT INTO `produks` (`id`, `kode`, `nama_produk`, `harga`, `stock`, `gambar`, `detail`, `user_id`, `kategori_id`, `created_at`, `updated_at`) VALUES
(29, '44444', 'sapuuuu', 650000, '3', 'https://barbeqshop.online/produk-images/1714450241.jpg', 'hshssjjenduuejbjenfjenfffffffffffffff', 20, 10, '2024-04-29 21:10:42', '2024-04-29 21:10:42'),
(30, '34567', 'panci goreng', 80000, '5', 'https://barbeqshop.online/produk-images/1714450388.jpg', 'panci rebus dan goreng anti lengkett', 20, 10, '2024-04-29 21:13:08', '2024-04-29 21:13:08'),
(31, '67894', 'rok mini', 120000, '2', 'https://barbeqshop.online/produk-images/1714450510.jpg', 'rok mini untuk jalan jalan, nyaman dipakai', 20, 1, '2024-04-29 21:15:10', '2024-04-29 21:15:10'),
(32, '12345', 'crob top', 70000, '4', 'https://barbeqshop.online/produk-images/1714450703.jpg', 'crob top dengan bahan lembut, halus, dan tidak mudah luntur', 20, 1, '2024-04-29 21:18:23', '2024-04-29 21:18:23'),
(33, '98765', 'baju sekolah', 145000, '8', 'https://barbeqshop.online/produk-images/1714450790.jpg', 'baju sekolah anak keginian', 20, 9, '2024-04-29 21:19:50', '2024-04-29 21:19:50'),
(34, '335tffgy', 'cuyik', 125321, '1', 'https://barbeqshop.online/produk-images/1714808994.jpg', 'bzjffififjduxhxyxyxtstsyssysy', 20, 1, '2024-05-04 00:49:54', '2024-05-04 00:49:54'),
(35, 'mouse1', 'mouse bekas', 50000, '1', 'https://barbeqshop.online/produk-images/1715155211.jpg', 'mousenya bekas yaaaa', 20, 9, '2024-05-08 01:00:11', '2024-05-08 01:00:11'),
(36, 'kacamata1', 'Kaca Mata Bekas', 10000, '2', 'https://barbeqshop.online/produk-images/1715155255.jpg', 'bekas yaaa seperti d gambar', 20, 16, '2024-05-08 01:00:55', '2024-05-08 01:00:55'),
(38, '123456', 'laptop asus', 14000000, '9', 'https://barbeqshop.online/produk-images/1715678421.jpg', 'Processor	AMD Ryzen™ 3 7320U Mobile Processor (4-core/8-thread, 4MB cache, up to 4.1 GHz max boost)\r\nOS	Windows 11 Home \r\nPanel	14.0-inch  FHD (1920 x 1080) 16:9 aspect ratio 250nits anti-glare panel\r\n\r\nGraphic	AMD Radeon™ Graphics\r\n\r\nMemory	LPDDR5 8GB\r\n\r\nStorage	256GB M.2 NVMe™ PCIe® 3.0 SSD\r\nPorts	\"1x USB 2.0 Type-A\r\n1x USB 3.2 Gen 1 Type-A\r\n\r\n1x USB 3.2 Gen 1 Type-C\r\n\r\n1x HDMI 1.4\r\n1x 3.5mm Combo Audio Jack\r\n1x DC-in\"', 20, 2, '2024-05-14 02:20:21', '2024-05-14 02:20:21'),
(39, '987654', 'hotpans', 60000, '5', 'https://barbeqshop.online/produk-images/1715678827.jpg', 'Hot Pants Wanita Celana Jeans Pendek Wanita Celana Strech Wanita Short Pants Cewek', 20, 3, '2024-05-14 02:27:07', '2024-05-14 02:27:07'),
(40, '6453738', 'tas sandang', 180000, '10', 'https://barbeqshop.online/produk-images/1715678989.jpg', 'Tas Sekolah Tas Punggung Tas Ransel Pria Wanita Gendong pria Wanita Korea Style Tas Backpack Kerja Sekolah Kuliah Model Fashion', 20, 12, '2024-05-14 02:29:49', '2024-05-14 02:29:49');

-- --------------------------------------------------------

--
-- Table structure for table `promos`
--

CREATE TABLE `promos` (
  `id` bigint UNSIGNED NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rekenings`
--

CREATE TABLE `rekenings` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `nama_bank` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_rek` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pemilik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rekenings`
--

INSERT INTO `rekenings` (`id`, `user_id`, `nama_bank`, `no_rek`, `nama_pemilik`, `created_at`, `updated_at`) VALUES
(2, 20, 'BSI', '1234586990', 'zahra', '2024-04-16 01:06:31', '2024-04-16 01:06:31');

-- --------------------------------------------------------

--
-- Table structure for table `statuss`
--

CREATE TABLE `statuss` (
  `id` bigint UNSIGNED NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `statuss`
--

INSERT INTO `statuss` (`id`, `kode`, `status`, `created_at`, `updated_at`) VALUES
(1, 'st01', 'Diproses', NULL, NULL),
(2, 'st02', 'Dikirim', NULL, NULL),
(3, 'st03', 'Selesei', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `statusverifikasis`
--

CREATE TABLE `statusverifikasis` (
  `id` bigint UNSIGNED NOT NULL,
  `statusverifikasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `statusverifikasis`
--

INSERT INTO `statusverifikasis` (`id`, `statusverifikasi`, `created_at`, `updated_at`) VALUES
(1, 'belum bayar', NULL, NULL),
(2, 'sudah bayar', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_tlp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `isadmin` tinyint(1) NOT NULL DEFAULT '0',
  `issuperadmin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `no_tlp`, `alamat`, `gambar`, `remember_token`, `created_at`, `updated_at`, `isadmin`, `issuperadmin`) VALUES
(10, 'Super Admin', 'Super Admin', 'superadmin@gmail.com', NULL, '$2y$12$6qBkoI7UEf0Z3GBJ8RSYWOpHjLzt3En5tV2aK3ZUxEhr5LOUZZrN.', '', '', '', NULL, '2024-03-24 09:16:36', '2024-03-24 09:16:36', 0, 2),
(20, 'zahraa', 'zahra', 'zahra@gmail.com', NULL, '$2y$12$D453gqM1nwrdo3gDcdgRlu6mQAl5NvZr39KCvo/I0Q8nulY1YJNpS', '979479836583742', 'Kecamatan Ulakan Tapakis, Tapakis, Batang Gadang', '1713772025.png', NULL, '2024-03-31 23:51:09', '2024-04-22 00:47:05', 0, 0),
(22, 'admin', 'addd', 'admin@gmail.com', NULL, '$2y$12$llUSFyQDlffonJ/LconyOeRs55w1rAV.LT9F081ydeanI2DFdAJHK', '0987536896', 'Batang Gadang , kec. Ulakan Tapakis , kab. Padang Pariaman , prov. Sumatra Barat', '1713772064.jpg', NULL, '2024-04-16 02:38:48', '2024-04-22 00:47:44', 1, 0),
(23, 'rani', 'rani', 'rani@gmail.com', NULL, '$2y$12$SuE4Ejj8fxgFL4MSUU.r7eTDCvUnBjbcCJfz1b.n4K9OB/NroDF8m', '089876757646', 'solok selatan', '1714116853.jpeg', NULL, '2024-04-26 00:34:13', '2024-04-26 00:34:13', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint UNSIGNED NOT NULL,
  `id_wish` int NOT NULL,
  `user_id` int NOT NULL,
  `nama_product` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `penjual_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `id_wish`, `user_id`, `nama_product`, `harga`, `gambar`, `created_at`, `updated_at`, `penjual_id`) VALUES
(137, 29, 23, 'sapuuuu', 650000, 'https://barbeqshop.online/produk-images/1714450241.jpg', '2024-05-20 01:12:59', '2024-05-20 01:12:59', 20),
(138, 31, 23, 'rok mini', 120000, 'https://barbeqshop.online/produk-images/1714450510.jpg', '2024-05-20 01:20:02', '2024-05-20 01:20:02', 20),
(139, 29, 12, 'sapuuuu', 650000, 'https://barbeqshop.online/produk-images/1714450241.jpg', '2024-05-20 06:37:48', '2024-05-20 06:37:48', 20);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggotas`
--
ALTER TABLE `anggotas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kategoris_kode_unique` (`kode`);

--
-- Indexes for table `keuangans`
--
ALTER TABLE `keuangans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembelis`
--
ALTER TABLE `pembelis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pesanans`
--
ALTER TABLE `pesanans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produks`
--
ALTER TABLE `produks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `produks_kode_unique` (`kode`);

--
-- Indexes for table `promos`
--
ALTER TABLE `promos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rekenings`
--
ALTER TABLE `rekenings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rekenings_user_id_foreign` (`user_id`);

--
-- Indexes for table `statuss`
--
ALTER TABLE `statuss`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `statuss_kode_unique` (`kode`);

--
-- Indexes for table `statusverifikasis`
--
ALTER TABLE `statusverifikasis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggotas`
--
ALTER TABLE `anggotas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `keuangans`
--
ALTER TABLE `keuangans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pembelis`
--
ALTER TABLE `pembelis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pesanans`
--
ALTER TABLE `pesanans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `produks`
--
ALTER TABLE `produks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `promos`
--
ALTER TABLE `promos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rekenings`
--
ALTER TABLE `rekenings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `statuss`
--
ALTER TABLE `statuss`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `statusverifikasis`
--
ALTER TABLE `statusverifikasis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rekenings`
--
ALTER TABLE `rekenings`
  ADD CONSTRAINT `rekenings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
