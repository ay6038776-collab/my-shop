-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2026 at 06:13 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `river_project2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `color` varchar(50) DEFAULT 'N/A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `customer_id`, `product_id`, `quantity`, `created_at`, `updated_at`, `color`) VALUES
(10, NULL, 35, 1, '2025-09-30 14:44:01', '2025-10-02 13:58:18', NULL),
(14, NULL, 12, 1, '2025-09-30 16:57:44', '2025-10-02 13:58:21', NULL),
(18, NULL, 39, 2, '2025-10-01 01:05:12', '2025-10-02 14:27:40', NULL),
(19, NULL, 40, 1, '2025-10-01 01:05:34', '2025-10-02 13:58:24', NULL),
(21, NULL, 44, 4, '2025-10-12 16:25:21', '2025-10-12 16:27:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `password`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Ibrahem', 'ip12349@gmail.com', '$2y$12$BOqJRHza5uLxXvDIzvenXOFmd3UxDMiYYZdLL3do/aNj.mX.OQOgK', NULL, NULL, '2025-10-12 15:49:48', '2025-10-12 15:49:48'),
(2, 'mohed', 'mohmed@gmail.com', '$2y$12$GlBJDEzaCoYH.1oWwfeNCO5Lg7pgrHRAknfLNcp8hBr3TegwuY/0i', NULL, NULL, '2025-10-13 15:11:13', '2025-10-15 16:08:09'),
(3, 'Ahmed', 'ay603877ea@gmail.com', '$2y$12$zD5.e39YMq0WgtudlrtM.OnSRXUHtOsCRowktQmgFUgznMxSEqcqu', NULL, NULL, '2025-10-20 16:53:34', '2025-10-20 16:53:34'),
(4, 'Silma', 'silam@gmail.com', '$2y$12$dg./We0KSkZxKKj5FKIkmefz7UMBgxtx0VByP3gmDfCM40YbYni8a', NULL, NULL, '2025-10-23 09:05:20', '2025-10-23 09:05:20'),
(5, 'AHMED', 'ahmed45@gmail.com', '$2y$12$JE5qVvdM2J6UUZ8OF1vPVuUfxp9hvPIT0ujLpCChsI5eL9SK5I.Bi', NULL, NULL, '2026-01-01 15:35:02', '2026-01-01 15:35:44'),
(6, 'Ahmed', 'ahmed9@gmail.com', '$2y$12$VThuCWu2MWgvRmdg198fO.plH4HhQhIAgOXzpum/4x1eAc0vKwWIS', NULL, NULL, '2026-01-14 06:30:35', '2026-01-24 09:39:45'),
(7, 'Mohmed', 'mohmed4@gmail.com', '$2y$12$niRnspPfvour0SD73FZBzejUNd34CvAhJJ2I0EykZibHhj.XFKf0K', NULL, NULL, '2026-01-22 16:31:28', '2026-01-22 16:31:28'),
(8, 'Mohmed', 'mohmed10@gmail.com', '$2y$12$XT.ithM5DCMGFBIpksWcHu7mVynAZ4ijkywOuztKUEO5m./kiT2.u', NULL, NULL, '2026-02-04 18:14:02', '2026-02-04 18:14:02'),
(9, 'Salma', 'salma123@gmail.com', '$2y$12$tzlSnaEuy5WLC9zYoLMUoeIBKzf2Jhi0/eowtJRYqAw6yzMHE.E8u', NULL, NULL, '2026-02-06 17:06:24', '2026-02-06 17:06:24'),
(10, 'Salma', 'salma9@gmail.com', '$2y$12$shWutUDEOsQuKysIoHjVHeLn9MYky8Yws6mu.KgPRHUVLuwTl8Ph.', NULL, NULL, '2026-02-09 13:48:32', '2026-02-09 13:48:32');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `daily_hours` int(11) NOT NULL DEFAULT 8,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `email`, `phone`, `daily_hours`, `created_at`, `updated_at`) VALUES
(1, 'ahmed', 'ahmed9@gmail.com', NULL, 9, '2026-01-19 22:07:48', '2026-01-19 22:07:48'),
(2, 'ahmed', 'ahmed8@gmail.com', NULL, 9, '2026-01-19 23:05:18', '2026-01-19 23:05:18');

-- --------------------------------------------------------

--
-- Table structure for table `employee_role`
--

CREATE TABLE `employee_role` (
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_08_31_151032_create_products_table', 2),
(5, '2025_08_31_151816_create_categories_table', 3),
(6, '2025_09_15_145331_create_videos_table', 3),
(7, '2025_09_29_144712_create_carts_table', 4),
(8, '2025_09_29_172702_create_clients_table', 5),
(9, '2025_09_29_190809_create_orders_table', 6),
(10, '2025_09_29_190810_create_order_items_table', 6),
(11, '2025_10_15_180941_create_complaints_table', 7),
(12, '2025_09_30_181715_add_is_new_products', 8),
(13, '2025_10_20_182913_create_order_items_table', 9),
(14, '2025_10_20_170544_create_orders_table', 10),
(15, '2025_11_07_113651_create_admins_table', 11),
(16, '2025_12_19_185421_create_notifications_table', 11),
(17, '2026_01_18_142146_create_ratings_table', 12),
(18, '2026_01_19_195826_create_employees_table', 13),
(19, '2026_01_19_195855_create_roles_table', 13),
(20, '2026_01_19_195929_create_employee_role_table', 13),
(21, '2026_01_19_202330_create_role_user_table', 14);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(255) DEFAULT NULL,
  `total_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  `is_expired` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `order_number`, `total_price`, `status`, `notes`, `created_at`, `updated_at`, `expires_at`, `is_expired`) VALUES
(8, 2, 'ORD-68f688f13e97c', 497100.00, 'approved', NULL, '2025-10-20 16:09:37', '2025-12-22 15:30:57', NULL, 0),
(9, 2, 'ORD-68f68e5a2c769', 700.00, 'approved', NULL, '2025-10-20 16:32:42', '2025-12-22 15:37:34', NULL, 0),
(10, 1, 'ORD-68f692739d68f', 1300.00, 'approved', NULL, '2025-10-20 16:50:11', '2025-12-22 15:41:10', NULL, 0),
(11, 3, 'ORD-68f6936f6bc77', 1300.00, 'approved', NULL, '2025-10-20 16:54:23', '2025-12-22 15:41:02', NULL, 0),
(12, 3, 'ORD-68f78d66c2485', 1476000.00, 'approved', NULL, '2025-10-21 10:40:54', '2025-12-22 15:40:51', NULL, 0),
(13, 2, 'ORD-68f78f3267bcd', 272000.00, 'approved', NULL, '2025-10-21 10:48:34', '2025-12-22 15:39:20', NULL, 0),
(14, 2, 'ORD-68f78fa05dce3', 75000.00, 'approved', NULL, '2025-10-21 10:50:24', '2025-12-22 15:39:41', NULL, 0),
(15, 3, 'ORD-68f7df226e25b', 140500.00, 'approved', NULL, '2025-10-21 16:29:38', '2025-12-22 15:38:23', NULL, 0),
(16, 3, 'ORD-68fa15e21e7a5', 1800.00, 'approved', NULL, '2025-10-23 08:47:46', '2025-12-22 15:38:07', NULL, 0),
(17, 4, 'ORD-68fa1aa917a07', 69800.00, 'rejected', NULL, '2025-10-23 09:08:09', '2025-12-22 15:37:47', NULL, 0),
(18, 1, 'ORD-68fa2e19e47bd', 2300.00, 'approved', NULL, '2025-10-23 10:31:05', '2025-12-22 15:37:21', NULL, 0),
(19, 4, 'ORD-68fa7dffb4957', 5600.00, 'approved', NULL, '2025-10-23 16:11:59', '2025-12-22 15:37:12', NULL, 0),
(20, 4, 'ORD-6908c09ee1690', 800.00, 'approved', NULL, '2025-11-03 12:47:58', '2025-12-22 15:37:04', NULL, 0),
(21, 4, 'ORD-690a4d23df661', 210000.00, 'approved', NULL, '2025-11-04 16:59:47', '2025-12-22 15:36:56', NULL, 0),
(22, 2, 'ORD-690a4df93f483', 450000.00, 'approved', NULL, '2025-11-04 17:03:21', '2025-12-22 15:36:46', NULL, 0),
(23, 2, 'ORD-690c8080e94ec', 90000.00, 'approved', NULL, '2025-11-06 09:03:28', '2025-12-22 15:36:39', NULL, 0),
(24, 3, 'ORD-69133935c2032', 3024800.00, 'approved', NULL, '2025-11-11 11:25:09', '2025-12-22 15:36:31', NULL, 0),
(25, 1, 'ORD-691c3c3f90894', 123000.00, 'approved', NULL, '2025-11-18 07:28:31', '2025-12-22 15:35:19', NULL, 0),
(26, 1, 'ORD-6920e81a85554', 340900.00, 'approved', NULL, '2025-11-21 20:30:50', '2025-12-22 15:35:10', NULL, 0),
(27, 1, 'ORD-6927127e8439b', 262100.00, 'approved', NULL, '2025-11-26 12:45:18', '2025-12-22 15:34:05', NULL, 0),
(28, 1, 'ORD-6928317d9d2f7', 187500.00, 'approved', NULL, '2025-11-27 09:09:49', '2025-12-22 15:33:18', NULL, 0),
(29, 1, 'ORD-6928454b29e4a', 6501600.00, 'approved', NULL, '2025-11-27 10:34:19', '2025-12-22 15:33:08', NULL, 0),
(30, 4, 'ORD-6937fc9eba170', 1400.00, 'approved', NULL, '2025-12-09 08:40:30', '2025-12-22 15:31:18', NULL, 0),
(31, 4, 'ORD-693857c170b35', 2400.00, 'approved', NULL, '2025-12-09 15:09:21', '2025-12-22 15:31:13', NULL, 0),
(32, 1, 'ORD-693f09016b569', 60000.00, 'approved', NULL, '2025-12-14 16:59:13', '2025-12-22 15:31:07', NULL, 0),
(33, 1, 'ORD-6945a170cc32d', 7500.00, 'approved', NULL, '2025-12-19 17:03:12', '2025-12-22 15:31:02', '2025-12-26 19:03:12', 0),
(34, 1, 'ORD-6945a1fcddd57', 7500.00, 'approved', NULL, '2025-12-19 17:05:32', '2025-12-22 15:30:46', '2025-12-26 19:05:32', 0),
(35, 1, 'ORD-6945a4398d0f1', 17000.00, 'approved', NULL, '2025-12-19 17:15:05', '2025-12-22 15:30:41', '2025-12-26 19:15:05', 0),
(36, 1, 'ORD-6945a7bd7dc95', 7500.00, 'approved', NULL, '2025-12-19 17:30:05', '2025-12-22 15:30:35', '2025-12-26 19:30:05', 0),
(37, 1, 'ORD-69471d4a145e3', 7500.00, 'approved', NULL, '2025-12-20 20:03:54', '2025-12-22 15:30:30', '2025-12-27 22:03:54', 0),
(38, 1, 'ORD-694720632d26f', 50000.00, 'approved', NULL, '2025-12-20 20:17:07', '2025-12-22 15:30:25', '2025-12-27 22:17:07', 0),
(39, 2, 'ORD-6947fea58990a', 16000.00, 'approved', NULL, '2025-12-21 12:05:25', '2025-12-22 15:27:56', '2025-12-28 14:05:25', 0),
(40, 4, 'ORD-69498000a24fe', 117500.00, 'approved', NULL, '2025-12-22 15:29:36', '2025-12-22 15:29:57', '2025-12-29 17:29:36', 0),
(41, 3, 'ORD-69498305e03c8', 17000.00, 'approved', NULL, '2025-12-22 15:42:29', '2025-12-22 15:42:38', '2025-12-29 17:42:29', 0),
(42, 3, 'ORD-694984fc0d5c3', 60000.00, 'approved', NULL, '2025-12-22 15:50:52', '2025-12-22 15:51:00', NULL, 0),
(43, 3, 'ORD-6949858cd7ec9', 14000.00, 'approved', NULL, '2025-12-22 15:53:16', '2025-12-22 15:53:47', NULL, 0),
(44, 1, 'ORD-694a8bad691cb', 15000.00, 'approved', NULL, '2025-12-23 10:31:41', '2025-12-23 10:32:44', NULL, 0),
(45, 4, 'ORD-694c41ed8ceff', 85000.00, 'approved', NULL, '2025-12-24 17:41:33', '2025-12-24 17:41:46', NULL, 0),
(46, 1, 'ORD-694c454e55002', 85000.00, 'approved', NULL, '2025-12-24 17:55:58', '2025-12-24 17:56:13', NULL, 0),
(47, 1, 'ORD-694eeaf3e2735', 21001.42, 'approved', NULL, '2025-12-26 18:07:15', '2025-12-26 18:07:38', NULL, 0),
(48, 1, 'ORD-695341385ef12', 22801.00, 'approved', NULL, '2025-12-30 01:04:24', '2025-12-30 01:04:46', NULL, 0),
(49, 1, 'ORD-695343826fe09', 3750000.00, 'approved', NULL, '2025-12-30 01:14:10', '2025-12-30 01:14:31', NULL, 0),
(50, 1, 'ORD-6953449dc689c', 5000000.00, 'approved', NULL, '2025-12-30 01:18:53', '2025-12-30 01:19:04', NULL, 0),
(51, 1, 'ORD-6953455e201d3', 38000.00, 'approved', NULL, '2025-12-30 01:22:06', '2025-12-30 01:22:38', NULL, 0),
(52, 1, 'ORD-6953c30c69621', 68000.00, 'approved', NULL, '2025-12-30 10:18:20', '2025-12-30 10:18:37', NULL, 0),
(53, 1, 'ORD-695577064791c', 50000.00, 'approved', NULL, '2025-12-31 17:18:30', '2025-12-31 18:24:27', NULL, 0),
(54, 1, 'ORD-69557e9582d7b', 34000.00, 'approved', NULL, '2025-12-31 17:50:45', '2025-12-31 18:24:21', NULL, 0),
(55, 1, 'ORD-695582bf5a3b7', 0.00, 'rejected', NULL, '2025-12-31 18:08:31', '2025-12-31 18:10:51', NULL, 0),
(56, 1, 'ORD-695582c36b74e', 0.00, 'rejected', NULL, '2025-12-31 18:08:35', '2025-12-31 18:10:56', NULL, 0),
(57, 1, 'ORD-695582ea80660', 60000.00, 'approved', NULL, '2025-12-31 18:09:14', '2025-12-31 18:10:37', NULL, 0),
(58, 1, 'ORD-6955831f4b0d3', 50000.00, 'approved', NULL, '2025-12-31 18:10:07', '2025-12-31 18:10:33', NULL, 0),
(59, 1, 'ORD-6955837f149a6', 17000.00, 'approved', NULL, '2025-12-31 18:11:43', '2025-12-31 18:11:54', NULL, 0),
(60, 1, 'ORD-69558c4fd8ffa', 12000.00, 'approved', NULL, '2025-12-31 18:49:19', '2025-12-31 18:50:28', NULL, 0),
(61, 1, 'ORD-69558c7d57fc4', 60000.00, 'approved', NULL, '2025-12-31 18:50:05', '2025-12-31 18:50:22', NULL, 0),
(62, 1, 'ORD-69558d3b967eb', 24001.00, 'approved', NULL, '2025-12-31 18:53:15', '2025-12-31 18:53:54', NULL, 0),
(63, 1, 'ORD-695590ae898f0', 900.00, 'approved', NULL, '2025-12-31 19:07:58', '2026-01-05 02:25:02', NULL, 0),
(64, 5, 'ORD-6956b0f2bd4cc', 190400.00, 'approved', NULL, '2026-01-01 15:37:54', '2026-01-01 15:38:56', NULL, 0),
(65, 5, 'ORD-695b278edce6a', 267000.00, 'approved', NULL, '2026-01-05 00:53:02', '2026-01-05 02:21:28', NULL, 0),
(66, 5, 'ORD-696551cd52af1', 320000.00, 'approved', NULL, '2026-01-12 17:55:57', '2026-01-12 17:56:09', NULL, 0),
(67, 5, 'ORD-69656b0d6c851', 60000.00, 'rejected', NULL, '2026-01-12 19:43:41', '2026-01-16 16:44:43', NULL, 0),
(68, 5, 'ORD-69663147e03f2', 7500.00, 'approved', NULL, '2026-01-13 09:49:27', '2026-01-15 14:36:40', NULL, 0),
(69, 5, 'ORD-696636f8da155', 60000.00, 'approved', NULL, '2026-01-13 10:13:44', '2026-01-15 14:36:35', NULL, 0),
(70, 6, 'ORD-69675482cce67', 348000.00, 'approved', NULL, '2026-01-14 06:32:02', '2026-01-14 06:32:14', NULL, 0),
(71, 6, 'ORD-696918c4587d1', 947400.00, 'approved', NULL, '2026-01-15 14:41:40', '2026-01-15 14:42:34', NULL, 0),
(72, 6, 'ORD-696a86a54d9e3', 250000.00, 'approved', NULL, '2026-01-16 16:42:45', '2026-01-16 16:43:37', NULL, 0),
(73, 6, 'ORD-696cfd36be882', 3600.00, 'approved', NULL, '2026-01-18 13:33:10', '2026-01-19 18:42:07', NULL, 0),
(74, 6, 'ORD-696d3d0c29850', 700800.00, 'approved', NULL, '2026-01-18 18:05:32', '2026-01-19 18:42:01', NULL, 0),
(75, 6, 'ORD-696e53dd2b589', 420000.00, 'approved', NULL, '2026-01-19 13:55:09', '2026-01-19 18:42:10', NULL, 0),
(76, 6, 'ORD-696e96e811091', 270000.00, 'approved', NULL, '2026-01-19 18:41:12', '2026-01-19 18:41:34', NULL, 0),
(77, 6, 'ORD-696fe4fc3b222', 900.00, 'approved', NULL, '2026-01-20 18:26:36', '2026-01-20 18:31:53', NULL, 0),
(78, 6, 'ORD-6970fd0fa0b09', 20600.00, 'approved', NULL, '2026-01-21 14:21:35', '2026-01-21 14:22:26', NULL, 0),
(79, 6, 'ORD-697228e81bb95', 300.00, 'approved', NULL, '2026-01-22 11:40:56', '2026-01-22 11:41:38', NULL, 0),
(80, 7, 'ORD-6972851562df9', 270000.00, 'rejected', NULL, '2026-01-22 18:14:13', '2026-02-04 18:41:26', NULL, 0),
(81, 6, 'ORD-6974a39772b1a', 360000.00, 'approved', NULL, '2026-01-24 08:48:55', '2026-01-24 08:59:08', NULL, 0),
(82, 8, 'ORD-6983aee613139', 22500.00, 'approved', NULL, '2026-02-04 18:41:10', '2026-02-04 18:41:17', NULL, 0),
(83, 10, 'ORD-698a0348cd023', 15000.00, 'approved', NULL, '2026-02-09 13:54:48', '2026-02-09 13:55:13', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` decimal(10,2) NOT NULL,
  `color` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `color`, `created_at`, `updated_at`) VALUES
(1, 8, 44, 3, 40000.00, 'red', '2025-10-20 16:09:37', '2025-10-20 16:09:37'),
(2, 8, 17, 1, 17000.00, 'transparent', '2025-10-20 16:09:37', '2025-10-20 16:09:37'),
(3, 8, 20, 1, 600.00, 'transparent', '2025-10-20 16:09:37', '2025-10-20 16:09:37'),
(4, 8, 12, 1, 7500.00, 'transparent', '2025-10-20 16:09:37', '2025-10-20 16:09:37'),
(5, 8, 19, 2, 70000.00, 'transparent', '2025-10-20 16:09:37', '2025-10-20 16:09:37'),
(6, 8, 24, 2, 60000.00, 'transparent', '2025-10-20 16:09:37', '2025-10-20 16:09:37'),
(7, 8, 47, 1, 300.00, 'transparent', '2025-10-20 16:09:37', '2025-10-20 16:09:37'),
(8, 8, 48, 1, 1000.00, 'transparent', '2025-10-20 16:09:37', '2025-10-20 16:09:37'),
(9, 8, 46, 1, 700.00, 'transparent', '2025-10-20 16:09:37', '2025-10-20 16:09:37'),
(10, 8, 34, 1, 30000.00, 'transparent', '2025-10-20 16:09:37', '2025-10-20 16:09:37'),
(11, 8, 33, 1, 10000.00, 'transparent', '2025-10-20 16:09:37', '2025-10-20 16:09:37'),
(12, 8, 42, 1, 50000.00, 'transparent', '2025-10-20 16:09:37', '2025-10-20 16:09:37'),
(13, 9, 46, 1, 700.00, 'transparent', '2025-10-20 16:32:42', '2025-10-20 16:32:42'),
(14, 10, 47, 1, 300.00, 'transparent', '2025-10-20 16:50:11', '2025-10-20 16:50:11'),
(15, 10, 48, 1, 1000.00, 'transparent', '2025-10-20 16:50:11', '2025-10-20 16:50:11'),
(16, 11, 16, 1, 600.00, 'transparent', '2025-10-20 16:54:23', '2025-10-20 16:54:23'),
(17, 11, 46, 1, 700.00, 'transparent', '2025-10-20 16:54:23', '2025-10-20 16:54:23'),
(18, 12, 24, 5, 60000.00, 'transparent', '2025-10-21 10:40:54', '2025-10-21 10:40:54'),
(19, 12, 19, 5, 70000.00, 'transparent', '2025-10-21 10:40:54', '2025-10-21 10:40:54'),
(20, 12, 29, 10, 70000.00, 'transparent', '2025-10-21 10:40:54', '2025-10-21 10:40:54'),
(21, 12, 39, 18, 7000.00, 'transparent', '2025-10-21 10:40:54', '2025-10-21 10:40:54'),
(22, 13, 17, 16, 17000.00, 'transparent', '2025-10-21 10:48:34', '2025-10-21 10:48:34'),
(23, 14, 12, 10, 7500.00, 'transparent', '2025-10-21 10:50:24', '2025-10-21 10:50:24'),
(24, 15, 12, 3, 7500.00, 'transparent', '2025-10-21 16:29:38', '2025-10-21 16:29:38'),
(25, 15, 31, 2, 9000.00, 'transparent', '2025-10-21 16:29:38', '2025-10-21 16:29:38'),
(26, 15, 37, 2, 50000.00, 'transparent', '2025-10-21 16:29:38', '2025-10-21 16:29:38'),
(27, 16, 50, 6, 300.00, 'transparent', '2025-10-23 08:47:46', '2025-10-23 08:47:46'),
(28, 17, 52, 4, 1200.00, 'transparent', '2025-10-23 09:08:09', '2025-10-23 09:08:09'),
(29, 17, 56, 2, 1000.00, 'transparent', '2025-10-23 09:08:09', '2025-10-23 09:08:09'),
(30, 17, 20, 3, 600.00, 'transparent', '2025-10-23 09:08:09', '2025-10-23 09:08:09'),
(31, 17, 24, 1, 60000.00, 'transparent', '2025-10-23 09:08:09', '2025-10-23 09:08:09'),
(32, 17, 50, 4, 300.00, 'transparent', '2025-10-23 09:08:09', '2025-10-23 09:08:09'),
(33, 18, 16, 1, 600.00, 'transparent', '2025-10-23 10:31:05', '2025-10-23 10:31:05'),
(34, 18, 48, 1, 1000.00, 'transparent', '2025-10-23 10:31:05', '2025-10-23 10:31:05'),
(35, 18, 46, 1, 700.00, 'transparent', '2025-10-23 10:31:05', '2025-10-23 10:31:05'),
(36, 19, 57, 2, 800.00, 'transparent', '2025-10-23 16:11:59', '2025-10-23 16:11:59'),
(37, 19, 56, 2, 1000.00, 'transparent', '2025-10-23 16:11:59', '2025-10-23 16:11:59'),
(38, 19, 58, 2, 1000.00, 'transparent', '2025-10-23 16:11:59', '2025-10-23 16:11:59'),
(39, 20, 57, 1, 800.00, 'transparent', '2025-11-03 12:47:58', '2025-11-03 12:47:58'),
(40, 21, 59, 7, 30000.00, 'transparent', '2025-11-04 16:59:47', '2025-11-04 16:59:47'),
(41, 22, 59, 7, 30000.00, 'transparent', '2025-11-04 17:03:21', '2025-11-04 17:03:21'),
(42, 22, 16, 4, 60000.00, 'transparent', '2025-11-04 17:03:21', '2025-11-04 17:03:21'),
(43, 23, 59, 3, 30000.00, 'transparent', '2025-11-06 09:03:28', '2025-11-06 09:03:28'),
(44, 24, 12, 10, 7500.00, 'transparent', '2025-11-11 11:25:09', '2025-11-11 11:25:09'),
(45, 24, 19, 10, 70000.00, 'transparent', '2025-11-11 11:25:09', '2025-11-11 11:25:09'),
(46, 24, 25, 10, 6000.00, 'transparent', '2025-11-11 11:25:09', '2025-11-11 11:25:09'),
(47, 24, 29, 10, 70000.00, 'transparent', '2025-11-11 11:25:09', '2025-11-11 11:25:09'),
(48, 24, 33, 10, 10000.00, 'transparent', '2025-11-11 11:25:09', '2025-11-11 11:25:09'),
(49, 24, 37, 10, 50000.00, 'transparent', '2025-11-11 11:25:09', '2025-11-11 11:25:09'),
(50, 24, 42, 10, 50000.00, 'transparent', '2025-11-11 11:25:09', '2025-11-11 11:25:09'),
(51, 24, 46, 10, 700.00, 'transparent', '2025-11-11 11:25:09', '2025-11-11 11:25:09'),
(52, 24, 50, 3, 300.00, 'transparent', '2025-11-11 11:25:09', '2025-11-11 11:25:09'),
(53, 24, 56, 2, 1000.00, 'transparent', '2025-11-11 11:25:09', '2025-11-11 11:25:09'),
(54, 24, 59, 1, 30000.00, 'transparent', '2025-11-11 11:25:09', '2025-11-11 11:25:09'),
(55, 24, 16, 1, 60000.00, 'transparent', '2025-11-11 11:25:09', '2025-11-11 11:25:09'),
(56, 24, 20, 1, 600.00, 'transparent', '2025-11-11 11:25:09', '2025-11-11 11:25:09'),
(57, 24, 26, 1, 8000.00, 'transparent', '2025-11-11 11:25:09', '2025-11-11 11:25:09'),
(58, 24, 31, 1, 9000.00, 'transparent', '2025-11-11 11:25:09', '2025-11-11 11:25:09'),
(59, 24, 34, 1, 30000.00, 'transparent', '2025-11-11 11:25:09', '2025-11-11 11:25:09'),
(60, 24, 39, 1, 7000.00, 'transparent', '2025-11-11 11:25:09', '2025-11-11 11:25:09'),
(61, 24, 44, 1, 40000.00, 'transparent', '2025-11-11 11:25:09', '2025-11-11 11:25:09'),
(62, 24, 47, 1, 300.00, 'transparent', '2025-11-11 11:25:09', '2025-11-11 11:25:09'),
(63, 24, 52, 1, 1200.00, 'transparent', '2025-11-11 11:25:09', '2025-11-11 11:25:09'),
(64, 24, 57, 1, 800.00, 'transparent', '2025-11-11 11:25:09', '2025-11-11 11:25:09'),
(65, 24, 61, 1, 400.00, 'transparent', '2025-11-11 11:25:09', '2025-11-11 11:25:09'),
(66, 24, 17, 1, 17000.00, 'transparent', '2025-11-11 11:25:09', '2025-11-11 11:25:09'),
(67, 24, 24, 1, 60000.00, 'transparent', '2025-11-11 11:25:09', '2025-11-11 11:25:09'),
(68, 24, 27, 1, 4000.00, 'transparent', '2025-11-11 11:25:10', '2025-11-11 11:25:10'),
(69, 24, 32, 1, 10000.00, 'transparent', '2025-11-11 11:25:10', '2025-11-11 11:25:10'),
(70, 24, 35, 1, 80000.00, 'transparent', '2025-11-11 11:25:10', '2025-11-11 11:25:10'),
(71, 24, 40, 1, 700.00, 'transparent', '2025-11-11 11:25:10', '2025-11-11 11:25:10'),
(72, 24, 45, 2, 9000.00, 'transparent', '2025-11-11 11:25:10', '2025-11-11 11:25:10'),
(73, 24, 48, 1, 1000.00, 'transparent', '2025-11-11 11:25:10', '2025-11-11 11:25:10'),
(74, 24, 54, 1, 900.00, 'transparent', '2025-11-11 11:25:10', '2025-11-11 11:25:10'),
(75, 24, 58, 1, 1000.00, 'transparent', '2025-11-11 11:25:10', '2025-11-11 11:25:10'),
(76, 25, 63, 3, 1000.00, 'transparent', '2025-11-18 07:28:31', '2025-11-18 07:28:31'),
(77, 25, 59, 4, 30000.00, 'transparent', '2025-11-18 07:28:31', '2025-11-18 07:28:31'),
(78, 26, 48, 2, 1000.00, 'transparent', '2025-11-21 20:30:50', '2025-11-21 20:30:50'),
(79, 26, 16, 3, 60000.00, 'transparent', '2025-11-21 20:30:50', '2025-11-21 20:30:50'),
(80, 26, 63, 1, 1000.00, 'transparent', '2025-11-21 20:30:50', '2025-11-21 20:30:50'),
(81, 26, 12, 1, 7500.00, 'transparent', '2025-11-21 20:30:50', '2025-11-21 20:30:50'),
(82, 26, 24, 2, 60000.00, 'transparent', '2025-11-21 20:30:50', '2025-11-21 20:30:50'),
(83, 26, 34, 1, 30000.00, 'transparent', '2025-11-21 20:30:50', '2025-11-21 20:30:50'),
(84, 26, 61, 1, 400.00, 'transparent', '2025-11-21 20:30:50', '2025-11-21 20:30:50'),
(85, 27, 17, 2, 17000.00, 'transparent', '2025-11-26 12:45:18', '2025-11-26 12:45:18'),
(86, 27, 34, 1, 30000.00, 'transparent', '2025-11-26 12:45:18', '2025-11-26 12:45:18'),
(87, 27, 16, 1, 60000.00, 'transparent', '2025-11-26 12:45:18', '2025-11-26 12:45:18'),
(88, 27, 42, 1, 50000.00, 'transparent', '2025-11-26 12:45:18', '2025-11-26 12:45:18'),
(89, 27, 19, 1, 70000.00, 'transparent', '2025-11-26 12:45:18', '2025-11-26 12:45:18'),
(90, 27, 63, 2, 1000.00, 'transparent', '2025-11-26 12:45:18', '2025-11-26 12:45:18'),
(91, 27, 12, 1, 7500.00, 'transparent', '2025-11-26 12:45:18', '2025-11-26 12:45:18'),
(92, 27, 20, 1, 600.00, 'transparent', '2025-11-26 12:45:18', '2025-11-26 12:45:18'),
(93, 27, 64, 2, 4000.00, 'transparent', '2025-11-26 12:45:18', '2025-11-26 12:45:18'),
(94, 28, 16, 3, 60000.00, 'transparent', '2025-11-27 09:09:49', '2025-11-27 09:09:49'),
(95, 28, 12, 1, 7500.00, 'transparent', '2025-11-27 09:09:49', '2025-11-27 09:09:49'),
(96, 29, 16, 2, 60000.00, 'transparent', '2025-11-27 10:34:19', '2025-11-27 10:34:19'),
(97, 29, 64, 3, 4000.00, 'transparent', '2025-11-27 10:34:19', '2025-11-27 10:34:19'),
(98, 29, 24, 106, 60000.00, 'transparent', '2025-11-27 10:34:19', '2025-11-27 10:34:19'),
(99, 29, 20, 16, 600.00, 'transparent', '2025-11-27 10:34:19', '2025-11-27 10:34:19'),
(100, 30, 47, 2, 300.00, 'transparent', '2025-12-09 08:40:30', '2025-12-09 08:40:30'),
(101, 30, 61, 2, 400.00, 'transparent', '2025-12-09 08:40:30', '2025-12-09 08:40:30'),
(102, 31, 66, 4, 600.00, 'transparent', '2025-12-09 15:09:21', '2025-12-09 15:09:21'),
(103, 32, 16, 1, 60000.00, 'transparent', '2025-12-14 16:59:13', '2025-12-14 16:59:13'),
(104, 33, 12, 1, 7500.00, 'transparent', '2025-12-19 17:03:12', '2025-12-19 17:03:12'),
(105, 34, 12, 1, 7500.00, 'transparent', '2025-12-19 17:05:32', '2025-12-19 17:05:32'),
(106, 35, 17, 1, 17000.00, 'transparent', '2025-12-19 17:15:05', '2025-12-19 17:15:05'),
(107, 36, 12, 1, 7500.00, 'transparent', '2025-12-19 17:30:05', '2025-12-19 17:30:05'),
(108, 37, 12, 1, 7500.00, 'transparent', '2025-12-20 20:03:54', '2025-12-20 20:03:54'),
(109, 38, 67, 1, 50000.00, 'transparent', '2025-12-20 20:17:07', '2025-12-20 20:17:07'),
(110, 39, 68, 2, 8000.00, 'transparent', '2025-12-21 12:05:25', '2025-12-21 12:05:25'),
(111, 40, 16, 1, 60000.00, 'transparent', '2025-12-22 15:29:36', '2025-12-22 15:29:36'),
(112, 40, 12, 1, 7500.00, 'transparent', '2025-12-22 15:29:36', '2025-12-22 15:29:36'),
(113, 40, 67, 1, 50000.00, 'transparent', '2025-12-22 15:29:36', '2025-12-22 15:29:36'),
(114, 41, 17, 1, 17000.00, 'transparent', '2025-12-22 15:42:29', '2025-12-22 15:42:29'),
(115, 42, 16, 1, 60000.00, 'transparent', '2025-12-22 15:50:52', '2025-12-22 15:50:52'),
(116, 43, 39, 2, 7000.00, 'transparent', '2025-12-22 15:53:16', '2025-12-22 15:53:16'),
(117, 44, 12, 2, 7500.00, 'transparent', '2025-12-23 10:31:41', '2025-12-23 10:31:41'),
(118, 45, 71, 5, 17000.00, 'transparent', '2025-12-24 17:41:33', '2025-12-24 17:41:33'),
(119, 46, 17, 5, 17000.00, 'transparent', '2025-12-24 17:55:58', '2025-12-24 17:55:58'),
(120, 47, 68, 2, 1000.14, 'transparent', '2025-12-26 18:07:15', '2025-12-26 18:07:15'),
(121, 47, 68, 1, 1000.14, 'transparent', '2025-12-26 18:07:15', '2025-12-26 18:07:15'),
(122, 47, 69, 1, 1001.00, 'transparent', '2025-12-26 18:07:15', '2025-12-26 18:07:15'),
(123, 47, 71, 1, 17000.00, 'transparent', '2025-12-26 18:07:15', '2025-12-26 18:07:15'),
(124, 48, 12, 1, 7500.00, 'transparent', '2025-12-30 01:04:24', '2025-12-30 01:04:24'),
(125, 48, 12, 1, 7500.00, 'transparent', '2025-12-30 01:04:24', '2025-12-30 01:04:24'),
(126, 48, 73, 1, 6000.00, 'transparent', '2025-12-30 01:04:24', '2025-12-30 01:04:24'),
(127, 48, 69, 1, 1001.00, 'transparent', '2025-12-30 01:04:24', '2025-12-30 01:04:24'),
(128, 48, 57, 1, 800.00, 'transparent', '2025-12-30 01:04:24', '2025-12-30 01:04:24'),
(129, 49, 12, 100, 7500.00, 'transparent', '2025-12-30 01:14:10', '2025-12-30 01:14:10'),
(130, 49, 12, 100, 7500.00, 'transparent', '2025-12-30 01:14:10', '2025-12-30 01:14:10'),
(131, 49, 12, 100, 7500.00, 'transparent', '2025-12-30 01:14:10', '2025-12-30 01:14:10'),
(132, 49, 12, 100, 7500.00, 'transparent', '2025-12-30 01:14:10', '2025-12-30 01:14:10'),
(133, 49, 12, 100, 7500.00, 'transparent', '2025-12-30 01:14:10', '2025-12-30 01:14:10'),
(134, 50, 67, 100, 50000.00, 'transparent', '2025-12-30 01:18:53', '2025-12-30 01:18:53'),
(135, 51, 25, 1, 6000.00, 'transparent', '2025-12-30 01:22:06', '2025-12-30 01:22:06'),
(136, 51, 27, 6, 4000.00, 'transparent', '2025-12-30 01:22:06', '2025-12-30 01:22:06'),
(137, 51, 27, 2, 4000.00, 'transparent', '2025-12-30 01:22:06', '2025-12-30 01:22:06'),
(138, 52, 71, 4, 17000.00, 'transparent', '2025-12-30 10:18:20', '2025-12-30 10:18:20'),
(139, 53, 74, 1, 50000.00, 'transparent', '2025-12-31 17:18:30', '2025-12-31 17:18:30'),
(140, 54, 17, 2, 17000.00, NULL, '2025-12-31 17:50:45', '2025-12-31 17:50:45'),
(141, 57, 16, 1, 60000.00, 'أحمر', '2025-12-31 18:09:14', '2025-12-31 18:09:14'),
(142, 58, 74, 1, 50000.00, 'كريمي', '2025-12-31 18:10:07', '2025-12-31 18:10:07'),
(143, 59, 17, 1, 17000.00, 'ذهبي', '2025-12-31 18:11:43', '2025-12-31 18:11:43'),
(144, 60, 73, 2, 6000.00, 'أخضر', '2025-12-31 18:49:19', '2025-12-31 18:49:19'),
(145, 61, 16, 1, 60000.00, 'أحمر', '2025-12-31 18:50:05', '2025-12-31 18:50:05'),
(146, 62, 71, 1, 17000.00, 'أحمر', '2025-12-31 18:53:15', '2025-12-31 18:53:15'),
(147, 62, 69, 1, 1001.00, 'أصفر', '2025-12-31 18:53:15', '2025-12-31 18:53:15'),
(148, 62, 73, 1, 6000.00, 'أزرق', '2025-12-31 18:53:15', '2025-12-31 18:53:15'),
(149, 63, 78, 3, 300.00, 'أسود', '2025-12-31 19:07:58', '2025-12-31 19:07:58'),
(150, 64, 77, 3, 40000.00, 'كحلي', '2026-01-01 15:37:54', '2026-01-01 15:37:54'),
(151, 64, 75, 3, 800.00, 'بني', '2026-01-01 15:37:54', '2026-01-01 15:37:54'),
(152, 64, 73, 3, 6000.00, 'ذهبي', '2026-01-01 15:37:54', '2026-01-01 15:37:54'),
(153, 64, 74, 1, 50000.00, 'أزرق', '2026-01-01 15:37:54', '2026-01-01 15:37:54'),
(154, 65, 77, 1, 40000.00, 'أحمر', '2026-01-05 00:53:02', '2026-01-05 00:53:02'),
(155, 65, 16, 3, 60000.00, 'أحمر', '2026-01-05 00:53:02', '2026-01-05 00:53:02'),
(156, 65, 77, 1, 40000.00, 'زيتي', '2026-01-05 00:53:02', '2026-01-05 00:53:02'),
(157, 65, 39, 1, 7000.00, 'أسود', '2026-01-05 00:53:02', '2026-01-05 00:53:02'),
(158, 66, 81, 4, 80000.00, 'زهري', '2026-01-12 17:55:57', '2026-01-12 17:55:57'),
(159, 67, 16, 1, 60000.00, 'أخضر', '2026-01-12 19:43:41', '2026-01-12 19:43:41'),
(160, 68, 12, 1, 7500.00, 'ذهبي', '2026-01-13 09:49:27', '2026-01-13 09:49:27'),
(161, 69, 16, 1, 60000.00, 'أصفر', '2026-01-13 10:13:44', '2026-01-13 10:13:44'),
(162, 70, 82, 4, 87000.00, 'أحمر', '2026-01-14 06:32:02', '2026-01-14 06:32:02'),
(163, 71, 66, 4, 600.00, 'أسود', '2026-01-15 14:41:40', '2026-01-15 14:41:40'),
(164, 71, 19, 5, 70000.00, 'عنابي', '2026-01-15 14:41:40', '2026-01-15 14:41:40'),
(165, 71, 34, 4, 30000.00, 'بني', '2026-01-15 14:41:40', '2026-01-15 14:41:40'),
(166, 71, 46, 4, 700.00, 'بيج', '2026-01-15 14:41:40', '2026-01-15 14:41:40'),
(167, 71, 24, 7, 60000.00, 'ذهبي', '2026-01-15 14:41:40', '2026-01-15 14:41:40'),
(168, 71, 39, 6, 7000.00, 'أبيض', '2026-01-15 14:41:40', '2026-01-15 14:41:40'),
(169, 71, 56, 3, 1000.00, 'كهرماني', '2026-01-15 14:41:40', '2026-01-15 14:41:40'),
(170, 71, 47, 4, 300.00, 'أحمر', '2026-01-15 14:41:40', '2026-01-15 14:41:40'),
(171, 71, 54, 5, 900.00, 'رمادي', '2026-01-15 14:41:40', '2026-01-15 14:41:40'),
(172, 71, 78, 5, 300.00, 'أسود', '2026-01-15 14:41:40', '2026-01-15 14:41:40'),
(173, 72, 74, 5, 50000.00, 'رمادي', '2026-01-16 16:42:45', '2026-01-16 16:42:45'),
(174, 73, 52, 3, 1200.00, 'أسود', '2026-01-18 13:33:10', '2026-01-18 13:33:10'),
(175, 74, 82, 2, 87000.00, 'أزرق', '2026-01-18 18:05:32', '2026-01-18 18:05:32'),
(176, 74, 82, 2, 87000.00, 'كحلي', '2026-01-18 18:05:32', '2026-01-18 18:05:32'),
(177, 74, 82, 4, 87000.00, 'أحمر', '2026-01-18 18:05:32', '2026-01-18 18:05:32'),
(178, 74, 83, 4, 600.00, 'أزرق', '2026-01-18 18:05:32', '2026-01-18 18:05:32'),
(179, 74, 52, 1, 1200.00, 'أسود', '2026-01-18 18:05:32', '2026-01-18 18:05:32'),
(180, 74, 52, 1, 1200.00, 'أزرق', '2026-01-18 18:05:32', '2026-01-18 18:05:32'),
(181, 75, 16, 4, 60000.00, 'كهرماني', '2026-01-19 13:55:09', '2026-01-19 13:55:09'),
(182, 75, 16, 1, 60000.00, 'أحمر', '2026-01-19 13:55:09', '2026-01-19 13:55:09'),
(183, 75, 16, 2, 60000.00, 'أصفر', '2026-01-19 13:55:09', '2026-01-19 13:55:09'),
(184, 76, 84, 3, 90000.00, 'برتقالي', '2026-01-19 18:41:12', '2026-01-19 18:41:12'),
(185, 77, 88, 1, 300.00, 'أحمر', '2026-01-20 18:26:36', '2026-01-20 18:26:36'),
(186, 77, 20, 1, 600.00, 'أسود', '2026-01-20 18:26:36', '2026-01-20 18:26:36'),
(187, 78, 88, 2, 300.00, 'أسود', '2026-01-21 14:21:35', '2026-01-21 14:21:35'),
(188, 78, 89, 1, 20000.00, 'أبيض', '2026-01-21 14:21:35', '2026-01-21 14:21:35'),
(189, 79, 88, 1, 300.00, 'أزرق', '2026-01-22 11:40:56', '2026-01-22 11:40:56'),
(190, 80, 84, 3, 90000.00, 'ذهبي', '2026-01-22 18:14:13', '2026-01-22 18:14:13'),
(191, 81, 84, 4, 90000.00, 'برتقالي', '2026-01-24 08:48:55', '2026-01-24 08:48:55'),
(192, 82, 92, 3, 7500.00, 'بني', '2026-02-04 18:41:10', '2026-02-04 18:41:10'),
(193, 83, 12, 2, 7500.00, 'أحمر', '2026-02-09 13:54:48', '2026-02-09 13:54:48');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `is_new` tinyint(1) NOT NULL DEFAULT 0,
  `stock` int(11) NOT NULL DEFAULT 0,
  `sku` varchar(255) NOT NULL,
  `discount_percentage` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `is_new`, `stock`, `sku`, `discount_percentage`, `category_id`, `created_at`, `updated_at`, `img`) VALUES
(12, 'realme C65', 'cooler gold \r\ncamera 64px\r\nDisplay 90HZ', 7500.00, 0, 1461, '1', 0, NULL, '2025-09-12 03:57:29', '2026-02-09 13:55:13', '[\"1769114246_69728a86dc8a7.jpg\",\"1769114246_69728a86dd48b.png\",\"1769114246_69728a86de99b.jpg\"]'),
(16, 'lap-45', 'camera 20px', 60000.00, 0, 985, '2', 0, NULL, '2025-09-12 06:25:44', '2026-01-20 16:40:47', '[\"1768934447_696fcc2f5a59b.png\"]'),
(17, 'lap-45', '\"\"La...\"\"', 17000.00, 0, 56, '3', 0, NULL, '2025-09-22 15:22:05', '2025-12-31 18:24:21', '1758565325.png'),
(19, 'appel', 'camera14px', 70000.00, 0, 42, '45%', 0, NULL, '2025-09-23 07:02:29', '2026-01-15 14:42:34', '1758621749.jpg'),
(20, 'Backpack', 'Brow', 600.00, 0, 997, '8%', 0, NULL, '2025-09-23 07:03:11', '2026-01-20 18:31:53', '1758621791.jpg'),
(24, 'Samsung s24 ultr', 'camera 200px', 60000.00, 0, 1877, '9%', 0, NULL, '2025-09-23 17:59:25', '2026-01-15 14:42:34', '1758661165.jpg'),
(25, 'realme', 'camera100px', 6000.00, 0, 1989, '3%', 0, NULL, '2025-09-24 09:27:02', '2025-12-30 01:22:38', '1758716822.jpg'),
(26, 'lap-45', 'color b', 8000.00, 0, 8, '7', 0, NULL, '2025-09-24 10:05:57', '2025-12-22 15:36:31', '1758719157.png'),
(27, 'realme c6', 'camera 50px', 4000.00, 0, 8, '0267', 0, NULL, '2025-09-24 10:14:58', '2025-12-30 01:23:24', '1758719698.jpg'),
(29, 'Computer pc', 'CPU: intel Core i5 \r\nGPU:NVIDIA RTX 3060', 70000.00, 0, 20, '19%', 0, NULL, '2025-09-24 11:20:57', '2025-12-22 15:40:51', '1758723657.jpg'),
(31, 'realmec50 not', 'camera 64px', 9000.00, 0, 997, '19', 0, NULL, '2025-09-26 05:38:07', '2025-12-22 15:38:23', '1758875887.jpg'),
(32, 'realme C65', 'camera 50px', 10000.00, 0, 75, '20%', 0, NULL, '2025-09-26 06:27:48', '2025-12-22 15:36:31', '1758878868.png'),
(33, 'realme C65', 'jhfddjh/', 10000.00, 0, 67, '21%', 0, NULL, '2025-09-28 09:02:00', '2025-12-22 15:36:31', '1759060920.png'),
(34, 'apple 13 pro max', 'camera 64px', 30000.00, 0, 1, '30', 0, NULL, '2025-09-29 11:01:15', '2026-01-15 14:42:34', '1759154475.jpg'),
(35, 'Samsung s24 ultr', 'camera 200px', 80000.00, 0, 6, '4', 0, NULL, '2025-09-30 14:43:09', '2025-12-22 15:36:31', '1759254189.png'),
(37, 'apple 15 pro max', 'camera 40px', 50000.00, 0, 66, '10', 0, NULL, '2025-09-30 15:51:08', '2025-12-22 15:38:23', '1759258268.jpg'),
(39, 'realme C65', 'camera', 7000.00, 1, 22, 'ps', 0, NULL, '2025-09-30 16:05:33', '2026-01-15 14:42:34', '1759259133.jpg'),
(40, 'watch', 'color blake', 700.00, 1, 55, '6', 0, NULL, '2025-09-30 16:17:59', '2025-12-22 15:36:31', '1759259879.jpg'),
(42, 'Computer', 'RTX:4060', 50000.00, 1, 487, '5', 0, NULL, '2025-10-01 17:44:32', '2025-12-22 15:36:31', '1759351472.jpg'),
(44, 'apple 13', 'camera 50px', 40000.00, 1, 72, '20', 0, NULL, '2025-10-09 17:48:04', '2025-12-22 15:36:31', '1760042884.jpg'),
(45, 'oppo', 'camera', 9000.00, 1, 698, '60', 0, NULL, '2025-10-09 18:02:36', '2025-12-22 15:36:31', '1760043756.jpg'),
(46, 'watch', 'black', 700.00, 1, 983, '90', 0, NULL, '2025-10-13 15:59:54', '2026-01-15 14:42:34', '1760381994.jpg'),
(47, 'T-shirt', 'color :Gray', 300.00, 1, 791, '000', 0, NULL, '2025-10-18 18:00:17', '2026-01-15 14:42:34', '1760821217.jpg'),
(48, 'Backpack', 'color blak', 1000.00, 1, 94, '40', 0, NULL, '2025-10-20 10:58:40', '2025-12-22 15:41:10', '1760968720.jpg'),
(50, 'shoos', 'color: bleak', 300.00, 1, 691, '7%', 0, NULL, '2025-10-22 19:37:58', '2025-12-22 15:38:07', '1761172678.jpg'),
(52, 'dreas', 'prefect', 1200.00, 1, 5994, '8', 0, NULL, '2025-10-23 08:52:47', '2026-01-19 18:42:07', '1761220367.jpg'),
(54, 'jacket', 'color bone', 900.00, 1, 7994, '5%', 0, NULL, '2025-10-23 08:54:36', '2026-01-15 14:42:34', '1761220476.jpg'),
(56, 'Back', 'color ramde', 1000.00, 1, 293, '90$', 0, NULL, '2025-10-23 08:57:04', '2026-01-15 14:42:34', '1761220624.jpg'),
(57, 'shoos', 'color: wait', 800.00, 1, 495, '00', 0, NULL, '2025-10-23 10:26:43', '2025-12-30 01:04:46', '1761226003.jpg'),
(58, 'glass', 'sun glass', 1000.00, 1, 3997, '89', 0, NULL, '2025-10-23 10:29:46', '2025-12-22 15:37:12', '1761226186.jpg'),
(59, 'apple 13 pro max', 'camera : 50px', 30000.00, 1, 56, '09', 0, NULL, '2025-11-04 15:23:12', '2025-12-22 15:36:56', '1762276992.jpg'),
(61, 'T-shirt', 'color : wait', 400.00, 1, 596, '80', 0, NULL, '2025-11-11 09:28:11', '2025-12-22 15:36:31', '1762860491.jpg'),
(63, 'watch', 'color Brown', 1000.00, 1, 394, '6$', 0, NULL, '2025-11-18 07:19:44', '2025-12-22 15:35:19', '1763457584.jpg'),
(64, 'mocap', 'Roge\r\nPrevue\r\nlegalese', 4000.00, 1, 7995, '60$', 0, NULL, '2025-11-26 12:43:44', '2025-12-22 15:34:05', '1764168224.jpg'),
(66, 'pantaloon', 'Howa pantaloon morays \r\nmen hadal al Shereka .\r\ncolor : below', 600.00, 1, 2992, '7$', 0, NULL, '2025-12-09 15:07:20', '2026-01-15 14:42:34', '1765300040.jpg'),
(67, 'Samsung s23', 'camera 200px', 50000.00, 1, 5898, '2$', 0, NULL, '2025-12-13 22:21:23', '2025-12-30 01:19:04', '1765671683.jpg'),
(68, 'T-shirt', 'T-shirt sport', 1000.14, 1, 595, '#3', 10, NULL, '2025-12-20 20:46:28', '2025-12-26 18:07:38', '1766270788.jpg'),
(69, 'Bird', 'PET BIRD', 1001.00, 1, 197, 'jhj', 8, NULL, '2025-12-24 14:39:52', '2025-12-31 18:53:54', '1766594392.png'),
(71, 'apple 13', 'ggl', 17000.00, 1, 53, '2006', 6, NULL, '2025-12-24 15:12:19', '2025-12-31 18:53:54', '1766596339.jpg'),
(73, 'watch', 'color white', 6000.00, 1, 393, 'asd', 9, NULL, '2025-12-26 17:48:33', '2026-01-01 15:38:56', '1766778513.jpg'),
(74, 'Computer pc', 'computer pc', 50000.00, 1, 58, 'cty', 20, NULL, '2025-12-31 16:52:55', '2026-01-16 16:43:37', '1767207175.jpg'),
(75, 'jacket', 'kkldj', 800.00, 1, 197, 'kji', 2, NULL, '2025-12-31 18:59:44', '2026-01-01 15:38:56', '1767214784.jpg'),
(76, 'Backpack', 'hjd', 3000.00, 1, 890, 'pou', 3, NULL, '2025-12-31 19:01:34', '2025-12-31 19:01:46', '1767214894.jpg'),
(77, 'apple 13', 'ooroe', 40000.00, 1, 795, '1869', 4, NULL, '2025-12-31 19:03:06', '2026-01-05 02:21:28', '1767214986.jpg'),
(78, 'T-shirt', 'ijfi', 300.00, 1, 891, 'jhue', 6, NULL, '2025-12-31 19:05:21', '2026-01-15 14:42:34', '1767215121.jpg'),
(81, 'Computer', 'gjhgh', 80000.00, 1, 896, 'kloi', 7, NULL, '2026-01-01 15:50:19', '2026-01-12 17:56:09', '1767289819.jpg'),
(82, 'Samsung s24 ultr', 'samseng', 87000.00, 1, 387, 'tyi', 35, NULL, '2026-01-12 18:01:32', '2026-01-19 18:42:01', '1768248092.jpg'),
(83, 'wash', 'color black', 600.00, 1, 596, '89lo', 7, NULL, '2026-01-18 16:31:17', '2026-01-19 18:42:01', '1768761077.jpg'),
(84, 'iPhone17 pro', 'nm', 90000.00, 1, 193, '78ui', 10, NULL, '2026-01-19 18:39:38', '2026-01-24 08:59:08', '[\"1769086693_69721ee59bbcc.jpg\",\"1769086693_69721ee59cb90.jpg\",\"1769086693_69721ee59d7b9.png\",\"1769086693_69721ee59e120.jpg\"]'),
(88, 'rtx 5060', 'rtx', 300.00, 1, 6996, 'yuio', 5, NULL, '2026-01-20 17:12:52', '2026-01-22 11:41:38', '[\"1768941600_696fe8204ce4e.jpg\",\"1768941600_696fe8204d67b.jpg\",\"1768941600_696fe8204dfb9.jpg\"]'),
(89, 'pc computer', 'jfj', 20000.00, 1, 6999, 'jko', 7, NULL, '2026-01-21 11:45:20', '2026-01-21 14:22:25', '[\"1769003120_6970d870194de.jpg\",\"1769003120_6970d87024f0b.jpg\",\"1769003120_6970d87034ef0.jpg\",\"1769003120_6970d870392ed.jpg\"]'),
(92, 'oppo 15 pro +5g', 'yuioioiouuu', 7500.00, 1, 1460, 'io', 10, NULL, '2026-02-04 18:30:00', '2026-02-06 12:27:54', '[\"1770237000_6983ac486f803.jpg\",\"1770237000_6983ac486fe57.jpg\",\"1770237000_6983ac48705b6.png\",\"1770237000_6983ac4871301.jpg\",\"1770237000_6983ac4871b12.jpg\"]'),
(93, 'iPhone15 pro max', 'camera 42 mpx', 50000.00, 1, 400, 'pgo', 40, NULL, '2026-02-06 12:47:23', '2026-02-06 12:47:23', '[\"1770389243_6985fefb162e7.jpg\",\"1770389243_6985fefb16cad.jpg\",\"1770389243_6985fefb174c7.jpg\",\"1770389243_6985fefb17cb1.jpg\",\"1770389243_6985fefb185c9.jpg\"]');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `user_id`, `product_id`, `rating`, `created_at`, `updated_at`) VALUES
(1, 11, 31, 5, '2026-01-18 16:26:07', '2026-01-18 16:26:07'),
(2, 11, 56, 5, '2026-01-18 17:35:29', '2026-01-18 17:35:29');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('2iHaLTTRlMyyxhIJmC8DRTfidruLlU0BAXQ8P2mE', 12, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36 Edg/144.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoieWt0S2J5dDRyb0RWZU03ZDJPcWV1WWs0R252Sk1oeXdmSG9GN21VYiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zaG93L2hvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjU1OiJsb2dpbl9jdXN0b21lcl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjEwO3M6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjEyO30=', 1770654329);

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
(2, 'ahmed', 'ay603877ea@gmail.com', NULL, '$2y$12$8TLNjypkwbnDA7kScmRnzOFrjBt9ahHuRYa/EpYAkG4VbB.4X8RKe', '2P0tHTEBUkUO0cJN4DmzO808D0ogekcT7xjBuXZryFpiR91FMEWpmMqT1TMZ', '2025-09-19 05:50:20', '2025-09-19 05:50:20'),
(3, 'mohed', 'mohmed@gmail.com', NULL, '$2y$12$WTc9qBcbQsfPrqK8FyNaXeKI6WuVGewFfI.A3kB95QEe.Yd49xoXi', 'u2lNRoOqpitAwUjHWe7pSrGpQF327N9225QazR7yeMWjIin5uS31dBh32Se5', '2025-09-19 07:03:37', '2025-09-19 07:03:37'),
(4, 'Ahmed', 'ay603877es@gmail.com', NULL, '$2y$12$Wzam2U3HuNAwoXSl.H.YG.7y8a9ncKlHgReAckEIzWBeGxByr7LyG', 'UoJHMudcuYOZBVPTPnAjMMYBQgxYauL7KEgnuSZaQ8WOBjQPkPynBrtj9FDM', '2025-09-23 17:25:51', '2025-09-23 17:25:51'),
(5, 'malak', 'makal@gimel.com', NULL, '$2y$12$hzNOErYwNR7YDYXM5U/v7.wLiimMspVK8TIxsttsPUAAwMavRCC4W', 'CukB3HAqMfihSD0ZLflr0gTLugGy9kkuf8yt5tpInEk8zo6h72TxH7WyVx6T', '2025-09-29 16:47:56', '2025-09-29 16:47:56'),
(6, 'Ibrahem', 'ip12345@gmail.com', NULL, '$2y$12$bnqlZ0BLvFayUKGoRC8Vs.xqAw38OlpBD2iqzXUvrMwbAww3ce7BO', NULL, '2025-10-12 15:02:46', '2025-10-12 15:02:46'),
(7, 'Ibrahem', 'ip12349@gmail.com', NULL, '$2y$12$h1oz7rh.K7HK24bgOr1JZ.eI5HLS5l50x5Vr7lHiTEw0T7flmnK/y', NULL, '2025-10-12 15:13:56', '2025-10-12 15:13:56'),
(8, 'Ibrahem', 'Ibrahem@gimel.com', NULL, '$2y$12$aii5LJsc3bo/4n6yauBVE.aBeKR4ITGnSZnnMC2mhc.UVX7HL3Ml2', NULL, '2025-10-12 15:30:16', '2025-10-12 15:30:16'),
(9, 'Ahmed', 'ahmwd@gmail.com', NULL, '$2y$12$Th4ZcUbDSarCOnTrtt2hwuC5.c5m2b39bMQ05Hv12HHL19.xkuXFe', NULL, '2025-11-07 09:27:18', '2025-11-07 09:27:18'),
(10, 'Ahmed', 'ahmed1@gmail.com', NULL, '$2y$12$JyhBdAF7YApgRsrL0o.N6u8Uvijyl484PUr4B8yJtJ10yHVeAUPyy', NULL, '2026-01-12 19:21:26', '2026-01-12 19:21:26'),
(11, 'ahmed', 'ahmed7@gmail.com', NULL, '$2y$12$xNhXVVnBJAA5TyVc9ZSmKeMNjGInoG0QK3HKt0XhIqIKAHvrzYDd6', NULL, '2026-01-14 06:28:09', '2026-01-14 06:28:09'),
(12, 'ahmed', 'ahmed8@gmail.com', NULL, '$2y$12$QQ4xtHBtHLljSK6Ff3OL4.UUGIBDQCin5KcMWj3ZEB4gCI199YgX6', 'vAYW66AJFk3JEE3ITeTAezV3UfbGyyesnq6xMU9e1D2gpfsXlLKaEIvv1B6x', '2026-01-19 18:31:11', '2026-01-19 18:31:11');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `youtube_url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `title`, `youtube_url`, `created_at`, `updated_at`) VALUES
(21, 'pc', 'https://www.youtube.com/watch?v=T8vGwAsYomw&pp=ygUDcGMg', '2026-01-16 16:48:19', '2026-01-16 16:48:19'),
(22, 'lap', 'https://www.youtube.com/watch?v=PT7Qa7P00ZY&pp=ygUDcGMg', '2026-01-16 16:49:11', '2026-01-16 16:49:11'),
(23, 'pc', 'https://www.youtube.com/watch?v=tsu0Rw3Nqi8&pp=ygUDcGMg', '2026-01-16 16:49:56', '2026-01-16 16:49:56'),
(24, 'lap', 'https://www.youtube.com/watch?v=nBerPYFxXZo&pp=ygUDcGMg', '2026-01-16 16:51:23', '2026-01-16 16:51:23'),
(26, 'iphone 17 pro', 'https://www.youtube.com/watch?v=TZfNHV24sR4&pp=ygURaXBob25lIDE3IHBybyBtYXg%3D', '2026-01-19 18:35:35', '2026-01-19 18:35:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_product_id_foreign` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clients_email_unique` (`email`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `employee_role`
--
ALTER TABLE `employee_role`
  ADD PRIMARY KEY (`employee_id`,`role_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_sku_unique` (`sku`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ratings_user_id_foreign` (`user_id`),
  ADD KEY `ratings_product_id_foreign` (`product_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`),
  ADD KEY `role_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=289;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employee_role`
--
ALTER TABLE `employee_role`
  ADD CONSTRAINT `employee_role_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `employee_role_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ratings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
