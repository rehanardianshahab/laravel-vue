-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2023 at 01:01 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apk-pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_category` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name_category`, `created_at`, `updated_at`) VALUES
(1, 'Makanan', '2023-04-07 06:54:42', '2023-04-07 06:54:42'),
(2, 'Elektronik', '2023-05-04 01:58:45', '2023-05-04 01:58:45'),
(3, 'Perawatan & Kecantikan', '2023-05-06 06:17:18', '2023-05-06 06:17:18'),
(4, 'Fashion Muslim', '2023-05-06 06:17:43', '2023-05-06 06:17:43');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) NOT NULL,
  `nominal` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `description`, `nominal`, `created_at`, `updated_at`) VALUES
(2, 'Gaji Admin Bulan April', 1000000, '2023-04-30 07:24:29', '2023-04-30 07:24:43');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `member_code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `member_code`, `name`, `address`, `phone_number`, `created_at`, `updated_at`) VALUES
(1, '00001', 'Arhatia', 'Jatibarang', '089675468546', '2023-04-10 07:48:39', '2023-04-10 07:48:39'),
(2, '00002', 'Lintang', 'Pawidean', '089642254856', '2023-05-02 00:40:48', '2023-05-02 00:46:57'),
(3, '00003', 'Willy', 'Indramayu', '089654126545', '2023-05-02 00:46:28', '2023-05-02 00:46:28'),
(4, '00004', 'Lilyanaa', 'Cirebon', '081234567890', '2023-05-06 06:21:10', '2023-05-06 06:21:10');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
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
(5, '2023_03_20_124831_create_categories_table', 1),
(6, '2023_03_20_133417_create_products_table', 1),
(7, '2023_03_20_145757_add_product_code_to_products_table', 1),
(8, '2023_03_23_055407_create_members_table', 1),
(9, '2023_03_23_124833_create_suppliers_table', 1),
(39, '2023_03_23_140342_create_expenses_table', 2),
(40, '2023_04_05_222934_create_purchases_table', 2),
(52, '2023_04_05_223017_create_purchase_details_table', 3),
(56, '2023_04_15_054242_create_sales_table', 4),
(57, '2023_04_15_054644_create_sale_details_table', 4),
(58, '2023_04_17_060627_create_settings_table', 4),
(60, '2023_05_04_015149_create_permission_tables', 5);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'lihat dashboard', 'web', '2023-05-06 06:13:24', '2023-05-06 06:13:24'),
(2, 'lihat kategori', 'web', '2023-05-06 06:13:24', '2023-05-06 06:13:24'),
(3, 'tambah kategori', 'web', '2023-05-06 06:13:24', '2023-05-06 06:13:24'),
(4, 'edit kategori', 'web', '2023-05-06 06:13:24', '2023-05-06 06:13:24'),
(5, 'hapus kategori', 'web', '2023-05-06 06:13:24', '2023-05-06 06:13:24'),
(6, 'lihat produk', 'web', '2023-05-06 06:13:24', '2023-05-06 06:13:24'),
(7, 'tambah produk', 'web', '2023-05-06 06:13:24', '2023-05-06 06:13:24'),
(8, 'edit produk', 'web', '2023-05-06 06:13:24', '2023-05-06 06:13:24'),
(9, 'hapus produk', 'web', '2023-05-06 06:13:24', '2023-05-06 06:13:24'),
(10, 'cetak barcode', 'web', '2023-05-06 06:13:24', '2023-05-06 06:13:24'),
(11, 'lihat member', 'web', '2023-05-06 06:13:24', '2023-05-06 06:13:24'),
(12, 'tambah member', 'web', '2023-05-06 06:13:24', '2023-05-06 06:13:24'),
(13, 'edit member', 'web', '2023-05-06 06:13:24', '2023-05-06 06:13:24'),
(14, 'hapus member', 'web', '2023-05-06 06:13:24', '2023-05-06 06:13:24'),
(15, 'lihat pengeluaran', 'web', '2023-05-06 06:13:24', '2023-05-06 06:13:24'),
(16, 'tambah pengeluaran', 'web', '2023-05-06 06:13:24', '2023-05-06 06:13:24'),
(17, 'edit pengeluaran', 'web', '2023-05-06 06:13:24', '2023-05-06 06:13:24'),
(18, 'hapus pengeluaran', 'web', '2023-05-06 06:13:25', '2023-05-06 06:13:25'),
(19, 'lihat supplier', 'web', '2023-05-06 06:13:25', '2023-05-06 06:13:25'),
(20, 'tambah supplier', 'web', '2023-05-06 06:13:25', '2023-05-06 06:13:25'),
(21, 'edit supplier', 'web', '2023-05-06 06:13:25', '2023-05-06 06:13:25'),
(22, 'hapus supplier', 'web', '2023-05-06 06:13:25', '2023-05-06 06:13:25'),
(23, 'lihat pengaturan', 'web', '2023-05-06 06:13:25', '2023-05-06 06:13:25'),
(24, 'tambah pengaturan', 'web', '2023-05-06 06:13:25', '2023-05-06 06:13:25'),
(25, 'edit pengaturan', 'web', '2023-05-06 06:13:25', '2023-05-06 06:13:25'),
(26, 'lihat pembelian', 'web', '2023-05-06 06:13:25', '2023-05-06 06:13:25'),
(27, 'tambah pembelian', 'web', '2023-05-06 06:13:25', '2023-05-06 06:13:25'),
(28, 'detail pembelian', 'web', '2023-05-06 06:13:25', '2023-05-06 06:13:25'),
(29, 'hapus pembelian', 'web', '2023-05-06 06:13:25', '2023-05-06 06:13:25'),
(30, 'lihat penjualan', 'web', '2023-05-06 06:13:25', '2023-05-06 06:13:25'),
(31, 'tambah penjualan', 'web', '2023-05-06 06:13:25', '2023-05-06 06:13:25'),
(32, 'detail penjualan', 'web', '2023-05-06 06:13:25', '2023-05-06 06:13:25'),
(33, 'hapus penjualan', 'web', '2023-05-06 06:13:25', '2023-05-06 06:13:25'),
(34, 'print penjualan', 'web', '2023-05-06 06:13:25', '2023-05-06 06:13:25');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `name_product` varchar(255) NOT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `purchase_price` int(11) NOT NULL,
  `discount` int(11) NOT NULL DEFAULT 0,
  `selling_price` int(11) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `product_code`, `name_product`, `brand`, `purchase_price`, `discount`, `selling_price`, `stock`, `created_at`, `updated_at`) VALUES
(1, 4, 'P000001', 'Snack1', '-', 1000, 0, 2000, 48, '2023-04-07 06:55:11', '2023-05-06 15:59:31'),
(2, 1, 'P000002', 'Snack2', '-', 2000, 0, 3000, 43, '2023-04-07 06:57:02', '2023-05-06 15:59:31'),
(3, 4, 'P000003', 'Snack3', '-', 3000, 0, 2000, 43, '2023-04-12 00:20:22', '2023-05-06 15:59:31'),
(7, 4, 'P000004', 'Snack 4', '-', 5000, 0, 7000, 49, '2023-05-04 01:11:05', '2023-05-06 16:01:08'),
(9, 4, 'P000008', 'Blender', 'Piliph', 500000, 0, 600000, 60, '2023-05-04 02:00:05', '2023-05-06 15:52:29'),
(11, 4, 'P000010', 'Gamis Motif', 'Elzatta', 150000, 0, 200000, 48, '2023-05-06 06:20:05', '2023-05-06 16:01:08');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `total_item` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `discount` tinyint(4) NOT NULL DEFAULT 0,
  `payment` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `supplier_id`, `total_item`, `total_price`, `discount`, `payment`, `created_at`, `updated_at`) VALUES
(11, 2, 22, 56000, 0, 56000, '2023-05-06 15:56:19', '2023-05-06 15:56:57'),
(12, 1, 22, 69000, 10, 62100, '2023-05-06 15:57:29', '2023-05-06 15:58:32');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_details`
--

CREATE TABLE `purchase_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `purchase_price` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_details`
--

INSERT INTO `purchase_details` (`id`, `purchase_id`, `product_id`, `purchase_price`, `amount`, `subtotal`, `created_at`, `updated_at`) VALUES
(12, 11, 3, 3000, 12, 36000, '2023-05-06 15:56:25', '2023-05-06 15:56:36'),
(13, 11, 2, 2000, 10, 20000, '2023-05-06 15:56:32', '2023-05-06 15:56:39'),
(14, 12, 1, 1000, 5, 5000, '2023-05-06 15:57:43', '2023-05-06 15:57:59'),
(15, 12, 2, 2000, 3, 6000, '2023-05-06 15:57:46', '2023-05-06 15:58:04'),
(16, 12, 3, 3000, 6, 18000, '2023-05-06 15:57:49', '2023-05-06 15:58:11'),
(17, 12, 7, 5000, 8, 40000, '2023-05-06 15:57:52', '2023-05-06 15:58:17');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2023-05-06 06:13:25', '2023-05-06 06:13:25'),
(2, 'kasir', 'web', '2023-05-06 06:13:25', '2023-05-06 06:13:25');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(30, 2),
(31, 1),
(31, 2),
(32, 1),
(32, 2),
(33, 1),
(33, 2),
(34, 1),
(34, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `member_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total_item` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `discount` tinyint(4) NOT NULL DEFAULT 0,
  `payment` int(11) NOT NULL DEFAULT 0,
  `cash` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `member_id`, `total_item`, `total_price`, `discount`, `payment`, `cash`, `user_id`, `created_at`, `updated_at`) VALUES
(20, 2, 14, 59000, 2, 57820, 60000, 2, '2023-05-06 15:58:45', '2023-05-06 15:59:31'),
(21, NULL, 5, 421000, 0, 421000, 430000, 1, '2023-05-06 16:00:06', '2023-05-06 16:01:08');

-- --------------------------------------------------------

--
-- Table structure for table `sale_details`
--

CREATE TABLE `sale_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sale_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `selling_price` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `discount` tinyint(4) NOT NULL DEFAULT 0,
  `subtotal` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_details`
--

INSERT INTO `sale_details` (`id`, `sale_id`, `product_id`, `selling_price`, `amount`, `discount`, `subtotal`, `created_at`, `updated_at`) VALUES
(27, 20, 1, 2000, 2, 2, 4000, '2023-05-06 15:58:53', '2023-05-06 15:59:31'),
(28, 20, 2, 3000, 1, 2, 3000, '2023-05-06 15:58:57', '2023-05-06 15:59:31'),
(29, 20, 3, 2000, 5, 2, 10000, '2023-05-06 15:59:00', '2023-05-06 15:59:31'),
(30, 20, 7, 7000, 6, 2, 42000, '2023-05-06 15:59:03', '2023-05-06 15:59:31'),
(31, 21, 11, 200000, 2, 0, 400000, '2023-05-06 16:00:13', '2023-05-06 16:00:50'),
(32, 21, 7, 7000, 3, 0, 21000, '2023-05-06 16:00:16', '2023-05-06 16:00:33');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_store` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `phone_number` varchar(255) NOT NULL,
  `discount` int(11) NOT NULL,
  `path_logo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name_store`, `address`, `phone_number`, `discount`, `path_logo`, `created_at`, `updated_at`) VALUES
(12, 'NiceStore', 'Desa Pawidean, Indramayu', '0896701234567', 2, 'logo.png', '2023-05-03 03:33:39', '2023-05-03 06:40:38');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `address`, `phone_number`, `created_at`, `updated_at`) VALUES
(1, 'Tia', 'Jalan Sudirman, Indramayu', '08965478962', '2023-04-07 06:58:14', '2023-05-06 06:21:48'),
(2, 'Lianaa', 'Jalan Olahraga, Indramayu', '086541265475', '2023-04-07 06:58:36', '2023-05-06 06:21:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Kasir', 'kasir@gmail.com', NULL, '$2y$10$GqiF8pfqPcoqlsvn.D0hZOeH2/DEOnRlrk0MAm3HLXAkJ.CLJFnf.', NULL, '2023-05-03 19:14:35', '2023-05-03 19:14:35'),
(2, 'Admin', 'admin@gmail.com', NULL, '$2y$10$0hHt9aWplchshpYq4.7BaeECrSayFzDRqSiUdMXLRIyb.RZfTAJRG', NULL, '2023-05-03 19:13:41', '2023-05-03 19:13:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_name_product_unique` (`name_product`),
  ADD UNIQUE KEY `products_product_code_unique` (`product_code`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchases_supplier_id_foreign` (`supplier_id`);

--
-- Indexes for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_details_purchase_id_foreign` (`purchase_id`),
  ADD KEY `purchase_details_product_id_foreign` (`product_id`);

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
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_member_id_foreign` (`member_id`);

--
-- Indexes for table `sale_details`
--
ALTER TABLE `sale_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_details_sale_id_foreign` (`sale_id`),
  ADD KEY `sale_details_product_id_foreign` (`product_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `purchase_details`
--
ALTER TABLE `purchase_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `sale_details`
--
ALTER TABLE `sale_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

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
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`);

--
-- Constraints for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD CONSTRAINT `purchase_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `purchase_details_purchase_id_foreign` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`id`);

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`);

--
-- Constraints for table `sale_details`
--
ALTER TABLE `sale_details`
  ADD CONSTRAINT `sale_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `sale_details_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
