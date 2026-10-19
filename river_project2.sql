-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2026 at 07:09 AM
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
-- Table structure for table `admin_login_logs`
--

CREATE TABLE `admin_login_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `ip_address` varchar(45) NOT NULL,
  `user_agent` text DEFAULT NULL,
  `login_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `logout_at` timestamp NULL DEFAULT NULL,
  `status` enum('success','failed','blocked') NOT NULL DEFAULT 'failed',
  `failure_reason` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_login_logs`
--

INSERT INTO `admin_login_logs` (`id`, `employee_id`, `email`, `ip_address`, `user_agent`, `login_at`, `logout_at`, `status`, `failure_reason`, `country`, `city`, `created_at`, `updated_at`) VALUES
(1, NULL, 'mohmed4@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-07-05 13:02:33', NULL, 'success', NULL, NULL, NULL, '2026-07-05 13:02:33', '2026-07-05 13:02:33'),
(2, 3, 'ahmed1@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-07-05 13:04:37', NULL, 'success', NULL, NULL, NULL, '2026-07-05 13:04:37', '2026-07-05 13:04:37'),
(3, 6, 'ahmed5@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-07-05 13:17:25', NULL, 'success', NULL, NULL, NULL, '2026-07-05 13:17:25', '2026-07-05 13:17:25'),
(4, 3, 'ahmed1@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-07-05 13:20:37', NULL, 'success', NULL, NULL, NULL, '2026-07-05 13:20:37', '2026-07-05 13:20:37'),
(5, 3, 'ahmed1@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-07-05 18:52:17', NULL, 'success', NULL, NULL, NULL, '2026-07-05 18:52:17', '2026-07-05 18:52:17'),
(6, 3, 'ahmed1@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-07-05 19:02:23', NULL, 'success', NULL, NULL, NULL, '2026-07-05 19:02:23', '2026-07-05 19:02:23'),
(7, 3, 'ahmed1@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-07-06 09:02:15', NULL, 'success', NULL, NULL, NULL, '2026-07-06 09:02:15', '2026-07-06 09:02:15'),
(8, 3, 'ahmed1@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-07-06 13:29:03', NULL, 'success', NULL, NULL, NULL, '2026-07-06 13:29:03', '2026-07-06 13:29:03'),
(9, 3, 'ahmed1@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-07-06 17:36:28', NULL, 'success', NULL, NULL, NULL, '2026-07-06 17:36:28', '2026-07-06 17:36:28'),
(10, 3, 'ahmed1@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-06 18:16:02', NULL, 'success', NULL, NULL, NULL, '2026-07-06 18:16:02', '2026-07-06 18:16:02'),
(11, 3, 'ahmed1@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-06 18:28:23', NULL, 'success', NULL, NULL, NULL, '2026-07-06 18:28:23', '2026-07-06 18:28:23'),
(12, 10, 'mohmed16@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-06 18:29:39', NULL, 'success', NULL, NULL, NULL, '2026-07-06 18:29:39', '2026-07-06 18:29:39'),
(13, NULL, 'slam@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-06 18:32:00', NULL, 'success', NULL, NULL, NULL, '2026-07-06 18:32:00', '2026-07-06 18:32:00'),
(14, 3, 'ahmed1@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-06 18:58:58', NULL, 'success', NULL, NULL, NULL, '2026-07-06 18:58:58', '2026-07-06 18:58:58'),
(15, NULL, 'slam2@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-06 19:49:32', NULL, 'failed', 'invalid_credentials', NULL, NULL, '2026-07-06 19:49:32', '2026-07-06 19:49:32'),
(16, NULL, 'slam2@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-06 19:49:38', NULL, 'failed', 'invalid_credentials', NULL, NULL, '2026-07-06 19:49:38', '2026-07-06 19:49:38'),
(17, 3, 'ahmed1@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-06 19:49:45', NULL, 'success', NULL, NULL, NULL, '2026-07-06 19:49:45', '2026-07-06 19:49:45'),
(18, NULL, 'malak@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-06 19:51:51', NULL, 'failed', 'invalid_credentials', NULL, NULL, '2026-07-06 19:51:51', '2026-07-06 19:51:51'),
(19, 3, 'ahmed1@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-06 19:51:58', NULL, 'success', NULL, NULL, NULL, '2026-07-06 19:51:58', '2026-07-06 19:51:58'),
(20, NULL, 'idrahem@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-06 19:53:48', NULL, 'success', NULL, NULL, NULL, '2026-07-06 19:53:48', '2026-07-06 19:53:48'),
(21, 10, 'mohmed16@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-06 19:58:14', NULL, 'success', NULL, NULL, NULL, '2026-07-06 19:58:14', '2026-07-06 19:58:14'),
(22, NULL, 'idrahem@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-06 19:58:43', NULL, 'success', NULL, NULL, NULL, '2026-07-06 19:58:43', '2026-07-06 19:58:43'),
(23, 3, 'ahmed1@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-06 19:58:58', NULL, 'success', NULL, NULL, NULL, '2026-07-06 19:58:58', '2026-07-06 19:58:58'),
(24, 3, 'ahmed1@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-07 12:59:34', NULL, 'success', NULL, NULL, NULL, '2026-07-07 12:59:34', '2026-07-07 12:59:34'),
(25, 3, 'ahmed1@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-08 19:22:33', NULL, 'success', NULL, NULL, NULL, '2026-07-08 19:22:33', '2026-07-08 19:22:33'),
(26, 3, 'ahmed1@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-09 04:59:24', NULL, 'success', NULL, NULL, NULL, '2026-07-09 04:59:24', '2026-07-09 04:59:24'),
(27, 3, 'ahmed1@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-09 05:12:30', NULL, 'success', NULL, NULL, NULL, '2026-07-09 05:12:30', '2026-07-09 05:12:30'),
(28, NULL, 'idrahem@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-09 10:11:33', NULL, 'success', NULL, NULL, NULL, '2026-07-09 10:11:33', '2026-07-09 10:11:33'),
(29, 3, 'ahmed1@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-09 10:24:41', NULL, 'success', NULL, NULL, NULL, '2026-07-09 10:24:41', '2026-07-09 10:24:41'),
(30, NULL, 'malak@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-10 15:25:51', NULL, 'failed', 'invalid_credentials', NULL, NULL, '2026-07-10 15:25:51', '2026-07-10 15:25:51'),
(31, NULL, 'slam2@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-10 15:25:58', NULL, 'failed', 'invalid_credentials', NULL, NULL, '2026-07-10 15:25:58', '2026-07-10 15:25:58'),
(32, 3, 'ahmed1@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-10 15:26:09', NULL, 'success', NULL, NULL, NULL, '2026-07-10 15:26:09', '2026-07-10 15:26:09'),
(33, 3, 'ahmed1@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-10 15:26:34', NULL, 'success', NULL, NULL, NULL, '2026-07-10 15:26:34', '2026-07-10 15:26:34'),
(34, NULL, 'salma@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-10 15:27:55', NULL, 'success', NULL, NULL, NULL, '2026-07-10 15:27:55', '2026-07-10 15:27:55'),
(35, NULL, 'salma@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-10 16:25:00', NULL, 'success', NULL, NULL, NULL, '2026-07-10 16:25:00', '2026-07-10 16:25:00'),
(36, NULL, 'salma@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-10 16:25:59', NULL, 'failed', 'invalid_credentials', NULL, NULL, '2026-07-10 16:25:59', '2026-07-10 16:25:59'),
(37, 3, 'ahmed1@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-10 16:26:05', NULL, 'success', NULL, NULL, NULL, '2026-07-10 16:26:05', '2026-07-10 16:26:05'),
(38, 3, 'ahmed1@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-12 08:23:22', NULL, 'success', NULL, NULL, NULL, '2026-07-12 08:23:22', '2026-07-12 08:23:22'),
(39, 3, 'ahmed1@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-12 08:46:05', NULL, 'success', NULL, NULL, NULL, '2026-07-12 08:46:05', '2026-07-12 08:46:05'),
(40, NULL, 'idrahem@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-12 09:01:32', NULL, 'success', NULL, NULL, NULL, '2026-07-12 09:01:32', '2026-07-12 09:01:32'),
(41, 3, 'ahmed1@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-07-12 09:36:39', NULL, 'success', NULL, NULL, NULL, '2026-07-12 09:36:39', '2026-07-12 09:36:39'),
(42, NULL, 'mohmed11@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-07-12 09:48:51', NULL, 'failed', 'invalid_credentials', NULL, NULL, '2026-07-12 09:48:51', '2026-07-12 09:48:51'),
(43, NULL, 'ahmed@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-07-12 09:51:47', NULL, 'failed', 'invalid_credentials', NULL, NULL, '2026-07-12 09:51:47', '2026-07-12 09:51:47'),
(44, 3, 'ahmed1@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-07-12 09:51:53', NULL, 'success', NULL, NULL, NULL, '2026-07-12 09:51:53', '2026-07-12 09:51:53'),
(45, 3, 'ahmed1@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-13 13:31:16', NULL, 'success', NULL, NULL, NULL, '2026-07-13 13:31:16', '2026-07-13 13:31:16'),
(46, 10, 'mohmed16@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-15 11:25:01', NULL, 'success', NULL, NULL, NULL, '2026-07-15 11:25:01', '2026-07-15 11:25:01'),
(47, 10, 'mohmed16@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-15 12:52:15', NULL, 'success', NULL, NULL, NULL, '2026-07-15 12:52:15', '2026-07-15 12:52:15'),
(48, 3, 'ahmed1@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-07-22 23:28:38', NULL, 'success', NULL, NULL, NULL, '2026-07-22 23:28:38', '2026-07-22 23:28:38'),
(49, 3, 'ahmed1@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-30 01:23:13', NULL, 'success', NULL, NULL, NULL, '2026-07-30 01:23:13', '2026-07-30 01:23:13');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-admin_session_10', 's:40:\"136vaHbuDsUCUhFvpEm3VDaxniB1cFrHnIq3LV1R\";', 1784159535),
('laravel-cache-admin_session_3', 's:40:\"mwe2gtLSFhQLzXBRqNO2WPFbJCXZQZtdVoxxTNUB\";', 1785414193),
('laravel-cache-dark_mode_enabled', 'b:0;', 1816922315),
('laravel-cache-maintenance_mode', 'b:0;', 1816922315),
('laravel-cache-site_settings', 'a:21:{s:18:\"two_factor_enabled\";b:1;s:19:\"login_attempt_limit\";b:1;s:15:\"session_timeout\";b:1;s:15:\"strong_password\";b:1;s:17:\"dark_mode_enabled\";b:0;s:17:\"dark_mode_default\";b:0;s:25:\"respect_system_preference\";b:0;s:17:\"user_registration\";b:0;s:15:\"reviews_enabled\";b:0;s:13:\"video_section\";b:0;s:14:\"multi_language\";b:0;s:14:\"guest_checkout\";b:0;s:9:\"ssl.https\";b:0;s:11:\"cod_enabled\";b:0;s:12:\"card_enabled\";b:0;s:21:\"vodafone_cash_enabled\";b:0;s:14:\"paypal_enabled\";b:0;s:24:\"order_confirmation_email\";b:0;s:18:\"order_status_email\";b:0;s:13:\"welcome_email\";b:0;s:20:\"password_reset_email\";b:0;}', 1816922315);

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

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`id`, `name`, `email`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(19, 'Ahmed Yasser', 'ahmed5678@gmail.com', 'products', 'jwekjiuhfw', '2026-06-15 08:07:39', '2026-06-15 08:07:39'),
(20, 'Ahmed Yasser', 'ahmed5678@gmail.com', 'products', 'kkjfhkwjf', '2026-06-16 08:09:05', '2026-06-16 08:09:05'),
(22, 'ahmed', 'ahmed9@gmail.com', 'products', 'htdkfkuyt', '2026-07-01 08:51:49', '2026-07-01 08:51:49'),
(23, 'mohmed', 'mohmed09@gmail.com', 'products', 'tank you', '2026-07-06 18:47:26', '2026-07-06 18:47:26');

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
(8, 'Mohmed', 'mohmed11@gmail.com', '$2y$12$XT.ithM5DCMGFBIpksWcHu7mVynAZ4ijkywOuztKUEO5m./kiT2.u', NULL, NULL, '2026-02-04 18:14:02', '2026-07-05 14:39:03'),
(9, 'Salma', 'salma123@gmail.com', '$2y$12$tzlSnaEuy5WLC9zYoLMUoeIBKzf2Jhi0/eowtJRYqAw6yzMHE.E8u', NULL, NULL, '2026-02-06 17:06:24', '2026-02-06 17:06:24'),
(10, 'Zehra', 'salma9@gmail.com', '$2y$12$shWutUDEOsQuKysIoHjVHeLn9MYky8Yws6mu.KgPRHUVLuwTl8Ph.', NULL, NULL, '2026-02-09 13:48:32', '2026-04-08 17:17:01'),
(11, 'ahmed', 'ahmed@gmail.com', '$2y$12$4bFxLuJzboGIhOOFUWADd.Jlm4cCPD3TfpYFJ8hqfMeQ/5d0KZmJu', NULL, NULL, '2026-02-17 19:56:59', '2026-02-17 19:56:59'),
(12, 'AYA', 'Aya1234@gmail.com', '$2y$12$Hm2xXYFHfG5QWjU1Z9t0E.us.hpiTvVaXc1oQTZXYVv388n5D4SxS', NULL, NULL, '2026-03-04 21:32:13', '2026-03-04 21:32:13'),
(13, 'Ahmed', 'ahmed5678@gmail.com', '$2y$12$UqQZ0Xhkq3JZ6uJNHD2IVuVfEWk19uXeELcbfGhpwV3Bi2JbDUUYe', NULL, NULL, '2026-04-13 14:35:11', '2026-04-13 14:35:11'),
(14, 'ahmed', 'ahmed345@gmail.com', '$2y$12$wCrVaKaZC1SUidbgdHucGejwAJUk61RjOFhcsZ2nuZ7.Fix/ZTsyy', NULL, NULL, '2026-05-20 18:51:23', '2026-05-20 18:51:23'),
(15, 'Mohmed', 'mohmed9@gmail.com', '$2y$12$aXh1d3nMB6Iq8Q6CxLA9nOnzbDlC9HDuwWQrkK8YeocI2NwZj6ssG', NULL, NULL, '2026-06-16 08:19:24', '2026-06-16 08:19:24'),
(16, 'zehra', 'zehra12@gmail.com', '$2y$12$LfTcglnJLK0r8kHEOPhAdeRG3hoTcocCRfAbXM1Z.qaxaoDaG8mzy', NULL, NULL, '2026-06-17 14:49:33', '2026-06-17 14:49:33'),
(17, 'mohmed', 'mohmed09@gmail.com', '$2y$12$YSwtkfdKejDv8P7CVqAeyePDBFfoBx9rfdz1//yTxaoEUkZfBaJoK', NULL, NULL, '2026-07-06 18:14:29', '2026-07-06 18:14:29'),
(18, 'zehra', 'z12342@gmail.com', '$2y$12$5AD7QaCN1IPjLMrf8Q8EAeTgRWNVktwwMSP8xEaO46cXOFKy1vqP.', NULL, NULL, '2026-07-09 05:51:41', '2026-07-09 05:51:41');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `daily_hours` int(11) NOT NULL DEFAULT 8,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(5000) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  `last_ip` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `email`, `phone`, `image`, `daily_hours`, `created_at`, `updated_at`, `is_active`, `password`, `remember_token`, `avatar`, `last_activity`, `last_ip`) VALUES
(3, 'Ahmed', 'ahmed1@gmail.com', '01505422414', NULL, 8, '2026-05-29 21:00:12', '2026-07-30 02:03:37', 1, '$2y$12$R7Ui1NRpis4EiKqCSa0iK.5eb//RZfwhxuUN2G9FFijnW7bkr3HWq', 'B6zgY0BRyG3ePIMCtY2Z9ybLrUeBE8yHNIMnQyCbUJmZ081WkutbTrq382l9', '1783378928_IMG_6572.JPG', '2026-07-30 05:03:37', '127.0.0.1'),
(6, 'ahmed', 'ahmed5@gmail.com', '+201505422414', NULL, 8, '2026-06-19 14:33:04', '2026-07-06 19:56:38', 1, '$2y$12$32UZCQVoxDXLtD95cEluhuNFVHQ2mQ4at8Igh6UxvIEv1Dwn3V8iG', 'fXFyYoamJdGyXxnTsuWv6be7Yyvw4on3ny9IGaloEAmewZO8OxhGvDDXfiFz', '1783378598_IMG_6555.JPG', '2026-07-05 16:20:24', '127.0.0.1'),
(10, 'mohmed', 'mohmed16@gmail.com', '+201505422414', NULL, 8, '2026-07-06 18:29:26', '2026-07-30 01:22:56', 1, '$2y$12$2tgGTkehH3TZKH9wRf7YYeJvAR3uA78wLHHFEi2wNCUSl5OTdnplu', 'f4GlA00Wc744jzy4KP2fKh79dhF7Qv65fhOX3orHciaI0J4sZ9eJngwfEffI', '1783378677_WhatsApp Image 2026-06-23 at 7.23.08 AM.jpeg', '2026-07-30 04:22:56', '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `employee_role`
--

CREATE TABLE `employee_role` (
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_role`
--

INSERT INTO `employee_role` (`employee_id`, `role_id`) VALUES
(3, 1),
(6, 2),
(10, 3);

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
(21, '2026_01_19_202330_create_role_user_table', 14),
(22, '2024_01_01_000000_create_admin_login_logs_table', 15);

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

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('0111b5e2-d098-4be8-9c13-2d69111f00e2', 'App\\Notifications\\LowStock', 'App\\Models\\Employee', 3, '{\"message\":\"\\u062a\\u062d\\u0630\\u064a\\u0631: \\u0627\\u0644\\u0645\\u062e\\u0632\\u0648\\u0646 \\u0645\\u0646\\u062e\\u0641\\u0636 \\u0644\\u0640 \\\"realme C65\\\" \\u2014 \\u0628\\u0627\\u0642\\u064a 1 \\u0642\\u0637\\u0639\\u0629 \\u0641\\u0642\\u0637!\",\"icon\":\"fa-solid fa-triangle-exclamation\",\"icon_color\":\"#f59e0b\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/products\\/12\\/edit\",\"product_id\":12}', NULL, '2026-07-01 10:03:56', '2026-07-01 10:03:56'),
('032d5a7b-0bd6-4f4c-a69f-3f78acad2efd', 'App\\Notifications\\NewCustomer', 'App\\Models\\Employee', 3, '{\"message\":\"\\u0639\\u0645\\u064a\\u0644 \\u062c\\u062f\\u064a\\u062f: Mohmed \\u2014 mohmed9@gmail.com\",\"icon\":\"fa-solid fa-user-plus\",\"icon_color\":\"#3b82f6\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/index\",\"customer_id\":15}', NULL, '2026-06-16 08:19:24', '2026-06-16 08:19:24'),
('0c102c8a-b75c-4225-afef-b6a084b5181c', 'App\\Notifications\\OrderApproved', 'App\\Models\\Employee', 3, '{\"message\":\"\\u062a\\u0645 \\u0627\\u0639\\u062a\\u0645\\u0627\\u062f \\u0627\\u0644\\u0637\\u0644\\u0628 \\u0631\\u0642\\u0645 #ORD-6a3585e6879b2\",\"icon\":\"fa-solid fa-circle-check\",\"icon_color\":\"#10b981\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/orders\",\"order_id\":109}', NULL, '2026-06-19 15:10:19', '2026-06-19 15:10:19'),
('0e37b227-999e-423a-8aa7-baaa1a8dfc31', 'App\\Notifications\\OrderPlaced', 'App\\Models\\Employee', 10, '{\"message\":\"\\u0637\\u0644\\u0628 \\u062c\\u062f\\u064a\\u062f \\u0631\\u0642\\u0645 #ORD-6a57c37b3c7df \\u2014 18,050 EGP\",\"icon\":\"fa-solid fa-cart-shopping\",\"icon_color\":\"#4f46e5\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/orders\",\"order_id\":123}', NULL, '2026-07-15 14:29:32', '2026-07-15 14:29:32'),
('0e556d0a-e48f-450a-8881-de6f42495d3e', 'App\\Notifications\\OrderPlaced', 'App\\Models\\Employee', 3, '{\"message\":\"\\u0637\\u0644\\u0628 \\u062c\\u062f\\u064a\\u062f \\u0631\\u0642\\u0645 #ORD-6a6ad3089067e \\u2014 160,050 EGP\",\"icon\":\"fa-solid fa-cart-shopping\",\"icon_color\":\"#4f46e5\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/orders\",\"order_id\":126}', NULL, '2026-07-30 01:28:56', '2026-07-30 01:28:56'),
('183b81e1-9076-42fa-85ed-44a2e1be2132', 'App\\Notifications\\OrderPlaced', 'App\\Models\\Employee', 3, '{\"message\":\"\\u0637\\u0644\\u0628 \\u062c\\u062f\\u064a\\u062f \\u0631\\u0642\\u0645 #ORD-6a357f5b84927 \\u2014 180,050 EGP\",\"icon\":\"fa-solid fa-cart-shopping\",\"icon_color\":\"#4f46e5\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/orders\",\"order_id\":106}', NULL, '2026-06-19 14:41:49', '2026-06-19 14:41:49'),
('1d20a3b5-c8d1-450b-b6ec-3a04cc054972', 'App\\Notifications\\OrderRejected', 'App\\Models\\Employee', 3, '{\"message\":\"\\u062a\\u0645 \\u0631\\u0641\\u0636 \\u0627\\u0644\\u0637\\u0644\\u0628 \\u0631\\u0642\\u0645 #ORD-6a35854882833\",\"icon\":\"fa-solid fa-circle-xmark\",\"icon_color\":\"#ef4444\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/orders\",\"order_id\":107}', NULL, '2026-06-19 15:11:36', '2026-06-19 15:11:36'),
('21be2aa5-cc6a-4c59-a793-17c9126b2a31', 'App\\Notifications\\OrderPlaced', 'App\\Models\\Employee', 3, '{\"message\":\"\\u0637\\u0644\\u0628 \\u062c\\u062f\\u064a\\u062f \\u0631\\u0642\\u0645 #ORD-6a514dbf8a615 \\u2014 60,050 EGP\",\"icon\":\"fa-solid fa-cart-shopping\",\"icon_color\":\"#4f46e5\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/orders\",\"order_id\":118}', NULL, '2026-07-10 16:53:35', '2026-07-10 16:53:35'),
('26d6f807-40e5-4ee3-8087-454ea7112a9e', 'App\\Notifications\\LowStock', 'App\\Models\\Employee', 3, '{\"message\":\"\\u062a\\u062d\\u0630\\u064a\\u0631: \\u0627\\u0644\\u0645\\u062e\\u0632\\u0648\\u0646 \\u0645\\u0646\\u062e\\u0641\\u0636 \\u0644\\u0640 \\\"rtx 5060\\\" \\u2014 \\u0628\\u0627\\u0642\\u064a 1 \\u0642\\u0637\\u0639\\u0629 \\u0641\\u0642\\u0637!\",\"icon\":\"fa-solid fa-triangle-exclamation\",\"icon_color\":\"#f59e0b\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/products\\/115\\/edit\",\"product_id\":115}', NULL, '2026-07-30 01:27:16', '2026-07-30 01:27:16'),
('2e5fa74b-8e07-408b-9947-bb36ea9cbb15', 'App\\Notifications\\NewComplaint', 'App\\Models\\User', 2, '{\"message\":\"\\u0634\\u0643\\u0648\\u0649 \\u062c\\u062f\\u064a\\u062f\\u0629 \\u0645\\u0646 Ahmed Yasser: products\",\"icon\":\"fa-solid fa-flag\",\"icon_color\":\"#f59e0b\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/complaints\\/20\",\"complaint_id\":20}', NULL, '2026-06-16 08:09:05', '2026-06-16 08:09:05'),
('3ccdf538-498f-4ebb-a6ae-3ce325d5d620', 'App\\Notifications\\NewComplaint', 'App\\Models\\Employee', 11, '{\"message\":\"\\u0634\\u0643\\u0648\\u0649 \\u062c\\u062f\\u064a\\u062f\\u0629 \\u0645\\u0646 mohmed: products\",\"icon\":\"fa-solid fa-flag\",\"icon_color\":\"#f59e0b\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/complaints\\/23\",\"complaint_id\":23}', NULL, '2026-07-06 18:47:26', '2026-07-06 18:47:26'),
('42ac7d27-f0a5-4bf4-b51f-afe15dbf48bc', 'App\\Notifications\\OrderPlaced', 'App\\Models\\Employee', 3, '{\"message\":\"\\u0637\\u0644\\u0628 \\u062c\\u062f\\u064a\\u062f \\u0631\\u0642\\u0645 #ORD-6a3585e6879b2 \\u2014 16,000,000,050 EGP\",\"icon\":\"fa-solid fa-cart-shopping\",\"icon_color\":\"#4f46e5\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/orders\",\"order_id\":109}', NULL, '2026-06-19 15:09:42', '2026-06-19 15:09:42'),
('50cfc5e2-3895-49a2-a3d1-2d350c8ed03f', 'App\\Notifications\\OrderRejected', 'App\\Models\\Employee', 3, '{\"message\":\"\\u062a\\u0645 \\u0631\\u0641\\u0636 \\u0627\\u0644\\u0637\\u0644\\u0628 \\u0631\\u0642\\u0645 #ORD-6a4b99222dd07\",\"icon\":\"fa-solid fa-circle-xmark\",\"icon_color\":\"#ef4444\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/orders\",\"order_id\":111}', NULL, '2026-07-06 09:04:02', '2026-07-06 09:04:02'),
('5914e042-e16c-49f0-b2cc-fd85256ee24e', 'App\\Notifications\\OrderPlaced', 'App\\Models\\Employee', 3, '{\"message\":\"\\u0637\\u0644\\u0628 \\u062c\\u062f\\u064a\\u062f \\u0631\\u0642\\u0645 #ORD-6a4fa0ffa25df \\u2014 3,050 EGP\",\"icon\":\"fa-solid fa-cart-shopping\",\"icon_color\":\"#4f46e5\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/orders\",\"order_id\":115}', NULL, '2026-07-09 10:24:15', '2026-07-09 10:24:15'),
('5c91b621-3536-418c-93b4-6eaa9260af7a', 'App\\Notifications\\OrderPlaced', 'App\\Models\\Employee', 3, '{\"message\":\"\\u0637\\u0644\\u0628 \\u062c\\u062f\\u064a\\u062f \\u0631\\u0642\\u0645 #ORD-6a557975cf948 \\u2014 240,050 EGP\",\"icon\":\"fa-solid fa-cart-shopping\",\"icon_color\":\"#4f46e5\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/orders\",\"order_id\":121}', NULL, '2026-07-13 20:49:10', '2026-07-13 20:49:10'),
('60e30786-35e4-4c7a-98a2-dea848afd057', 'App\\Notifications\\OrderPlaced', 'App\\Models\\Employee', 3, '{\"message\":\"\\u0637\\u0644\\u0628 \\u062c\\u062f\\u064a\\u062f \\u0631\\u0642\\u0645 #ORD-6a4ed5cd73f6e \\u2014 120,050 EGP\",\"icon\":\"fa-solid fa-cart-shopping\",\"icon_color\":\"#4f46e5\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/orders\",\"order_id\":114}', NULL, '2026-07-08 19:57:17', '2026-07-08 19:57:17'),
('6ecbcb81-bb34-43b0-ab48-7e168497129f', 'App\\Notifications\\OrderPlaced', 'App\\Models\\Employee', 3, '{\"message\":\"\\u0637\\u0644\\u0628 \\u062c\\u062f\\u064a\\u062f \\u0631\\u0642\\u0645 #ORD-6a3131ebcac06 \\u2014 552,050 EGP\",\"icon\":\"fa-solid fa-cart-shopping\",\"icon_color\":\"#4f46e5\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/orders\",\"order_id\":102}', NULL, '2026-06-16 08:22:19', '2026-06-16 08:22:19'),
('75abd06f-9e42-47b5-98c2-178d1bc8d8b0', 'App\\Notifications\\NewComplaint', 'App\\Models\\Employee', 3, '{\"message\":\"\\u0634\\u0643\\u0648\\u0649 \\u062c\\u062f\\u064a\\u062f\\u0629 \\u0645\\u0646 Ahmed Yasser: products\",\"icon\":\"fa-solid fa-flag\",\"icon_color\":\"#f59e0b\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/complaints\\/21\",\"complaint_id\":21}', NULL, '2026-06-17 07:40:40', '2026-06-17 07:40:40'),
('7cd6f228-8b62-4e9a-b9d2-df0aa5f452a0', 'App\\Notifications\\OrderPlaced', 'App\\Models\\Employee', 3, '{\"message\":\"\\u0637\\u0644\\u0628 \\u062c\\u062f\\u064a\\u062f \\u0631\\u0642\\u0645 #ORD-6a4b99222dd07 \\u2014 30,050 EGP\",\"icon\":\"fa-solid fa-cart-shopping\",\"icon_color\":\"#4f46e5\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/orders\",\"order_id\":111}', NULL, '2026-07-06 09:01:40', '2026-07-06 09:01:40'),
('8062713b-2328-47df-84aa-33c3ad32eaea', 'App\\Notifications\\OrderPlaced', 'App\\Models\\Employee', 3, '{\"message\":\"\\u0637\\u0644\\u0628 \\u062c\\u062f\\u064a\\u062f \\u0631\\u0642\\u0645 #ORD-6a31332c408e4 \\u2014 40,050 EGP\",\"icon\":\"fa-solid fa-cart-shopping\",\"icon_color\":\"#4f46e5\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/orders\",\"order_id\":103}', NULL, '2026-06-16 08:27:40', '2026-06-16 08:27:40'),
('85eee75a-ecc3-4324-84a5-7783ff0d2eac', 'App\\Notifications\\OrderApproved', 'App\\Models\\Employee', 14, '{\"message\":\"\\u062a\\u0645 \\u0627\\u0639\\u062a\\u0645\\u0627\\u062f \\u0627\\u0644\\u0637\\u0644\\u0628 \\u0631\\u0642\\u0645 #ORD-6a51442b76354\",\"icon\":\"fa-solid fa-circle-check\",\"icon_color\":\"#10b981\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/orders\",\"order_id\":116}', NULL, '2026-07-10 16:24:13', '2026-07-10 16:24:13'),
('8943df56-31c0-4d8d-96c4-8178232241ce', 'App\\Notifications\\OrderPlaced', 'App\\Models\\User', 2, '{\"message\":\"\\u0637\\u0644\\u0628 \\u062c\\u062f\\u064a\\u062f \\u0631\\u0642\\u0645 #ORD-6a312e1aed745 \\u2014 60,050 EGP\",\"icon\":\"fa-solid fa-cart-shopping\",\"icon_color\":\"#4f46e5\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/orders\",\"order_id\":101}', NULL, '2026-06-16 08:06:06', '2026-06-16 08:06:06'),
('8b039769-a391-4b2d-b8cf-396358919ce9', 'App\\Notifications\\OrderApproved', 'App\\Models\\Employee', 3, '{\"message\":\"\\u062a\\u0645 \\u0627\\u0639\\u062a\\u0645\\u0627\\u062f \\u0627\\u0644\\u0637\\u0644\\u0628 \\u0631\\u0642\\u0645 #ORD-6a514dbf8a615\",\"icon\":\"fa-solid fa-circle-check\",\"icon_color\":\"#10b981\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/orders\",\"order_id\":118}', NULL, '2026-07-12 09:36:49', '2026-07-12 09:36:49'),
('8de7ecfc-6c95-4d73-ae45-d9bf527d5439', 'App\\Notifications\\OrderPlaced', 'App\\Models\\Employee', 3, '{\"message\":\"\\u0637\\u0644\\u0628 \\u062c\\u062f\\u064a\\u062f \\u0631\\u0642\\u0645 #ORD-6a538ce771ded \\u2014 9,050 EGP\",\"icon\":\"fa-solid fa-cart-shopping\",\"icon_color\":\"#4f46e5\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/orders\",\"order_id\":120}', NULL, '2026-07-12 09:47:35', '2026-07-12 09:47:35'),
('9dd1d841-1b13-4cdc-928f-379d930e7bb2', 'App\\Notifications\\NewCustomer', 'App\\Models\\Employee', 3, '{\"message\":\"\\u0639\\u0645\\u064a\\u0644 \\u062c\\u062f\\u064a\\u062f: zehra \\u2014 z12342@gmail.com\",\"icon\":\"fa-solid fa-user-plus\",\"icon_color\":\"#3b82f6\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/index\",\"customer_id\":18}', NULL, '2026-07-09 05:51:43', '2026-07-09 05:51:43'),
('9f9c615a-3503-4b01-ae08-9c3fd7eb9392', 'App\\Notifications\\OrderRejected', 'App\\Models\\Employee', 3, '{\"message\":\"\\u062a\\u0645 \\u0631\\u0641\\u0636 \\u0627\\u0644\\u0637\\u0644\\u0628 \\u0631\\u0642\\u0645 #ORD-6a6ad3089067e\",\"icon\":\"fa-solid fa-circle-xmark\",\"icon_color\":\"#ef4444\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/orders\",\"order_id\":126}', NULL, '2026-07-30 01:29:22', '2026-07-30 01:29:22'),
('a2390ba7-7f98-42f0-bf6f-ce352b8c9563', 'App\\Notifications\\OrderPlaced', 'App\\Models\\Employee', 3, '{\"message\":\"\\u0637\\u0644\\u0628 \\u062c\\u062f\\u064a\\u062f \\u0631\\u0642\\u0645 #ORD-6a32e44e3ab14 \\u2014 4,050 EGP\",\"icon\":\"fa-solid fa-cart-shopping\",\"icon_color\":\"#4f46e5\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/orders\",\"order_id\":105}', NULL, '2026-06-17 15:15:43', '2026-06-17 15:15:43'),
('aa701b2f-a93e-4257-aecf-b2810a97b41e', 'App\\Notifications\\OrderApproved', 'App\\Models\\Employee', 14, '{\"message\":\"\\u062a\\u0645 \\u0627\\u0639\\u062a\\u0645\\u0627\\u062f \\u0627\\u0644\\u0637\\u0644\\u0628 \\u0631\\u0642\\u0645 #ORD-6a4fa0ffa25df\",\"icon\":\"fa-solid fa-circle-check\",\"icon_color\":\"#10b981\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/orders\",\"order_id\":115}', NULL, '2026-07-10 16:24:11', '2026-07-10 16:24:11'),
('ac3c6f77-93b3-4465-80a4-d615701eb979', 'App\\Notifications\\OrderPlaced', 'App\\Models\\Employee', 3, '{\"message\":\"\\u0637\\u0644\\u0628 \\u062c\\u062f\\u064a\\u062f \\u0631\\u0642\\u0645 #ORD-6a514d9d81ca2 \\u2014 120,050 EGP\",\"icon\":\"fa-solid fa-cart-shopping\",\"icon_color\":\"#4f46e5\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/orders\",\"order_id\":117}', NULL, '2026-07-10 16:53:01', '2026-07-10 16:53:01'),
('ad416d2f-4f7b-437b-94a4-7a6ee5dcbd05', 'App\\Notifications\\OrderApproved', 'App\\Models\\Employee', 3, '{\"message\":\"\\u062a\\u0645 \\u0627\\u0639\\u062a\\u0645\\u0627\\u062f \\u0627\\u0644\\u0637\\u0644\\u0628 \\u0631\\u0642\\u0645 #ORD-6a4ed5cd73f6e\",\"icon\":\"fa-solid fa-circle-check\",\"icon_color\":\"#10b981\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/orders\",\"order_id\":114}', NULL, '2026-07-08 19:59:46', '2026-07-08 19:59:46'),
('b8cd77d4-dd01-4a41-b5d3-401c90d7a15d', 'App\\Notifications\\OrderApproved', 'App\\Models\\Employee', 3, '{\"message\":\"\\u062a\\u0645 \\u0627\\u0639\\u062a\\u0645\\u0627\\u062f \\u0627\\u0644\\u0637\\u0644\\u0628 \\u0631\\u0642\\u0645 #ORD-6a358597699b7\",\"icon\":\"fa-solid fa-circle-check\",\"icon_color\":\"#10b981\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/orders\",\"order_id\":108}', NULL, '2026-06-19 15:11:29', '2026-06-19 15:11:29'),
('c2e26ef7-f69e-4814-9bb4-bce048dda8b0', 'App\\Notifications\\OrderApproved', 'App\\Models\\Employee', 3, '{\"message\":\"\\u062a\\u0645 \\u0627\\u0639\\u062a\\u0645\\u0627\\u062f \\u0627\\u0644\\u0637\\u0644\\u0628 \\u0631\\u0642\\u0645 #ORD-6a357f5b84927\",\"icon\":\"fa-solid fa-circle-check\",\"icon_color\":\"#10b981\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/orders\",\"order_id\":106}', NULL, '2026-06-19 14:42:12', '2026-06-19 14:42:12'),
('c4d263a7-4d33-4230-93cb-65880bdecf10', 'App\\Notifications\\OrderApproved', 'App\\Models\\Employee', 3, '{\"message\":\"\\u062a\\u0645 \\u0627\\u0639\\u062a\\u0645\\u0627\\u062f \\u0627\\u0644\\u0637\\u0644\\u0628 \\u0631\\u0642\\u0645 #ORD-6a4ed187b7f3d\",\"icon\":\"fa-solid fa-circle-check\",\"icon_color\":\"#10b981\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/orders\",\"order_id\":113}', NULL, '2026-07-08 19:39:22', '2026-07-08 19:39:22'),
('c6748662-4764-43ff-9f0c-38985d968459', 'App\\Notifications\\OrderApproved', 'App\\Models\\Employee', 3, '{\"message\":\"\\u062a\\u0645 \\u0627\\u0639\\u062a\\u0645\\u0627\\u062f \\u0627\\u0644\\u0637\\u0644\\u0628 \\u0631\\u0642\\u0645 #ORD-6a3279b87181b\",\"icon\":\"fa-solid fa-circle-check\",\"icon_color\":\"#10b981\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/orders\",\"order_id\":104}', NULL, '2026-06-17 07:42:08', '2026-06-17 07:42:08'),
('cba96c15-91d6-42bc-b371-ec8c6c1e76fb', 'App\\Notifications\\OrderPlaced', 'App\\Models\\Employee', 3, '{\"message\":\"\\u0637\\u0644\\u0628 \\u062c\\u062f\\u064a\\u062f \\u0631\\u0642\\u0645 #ORD-6a46606c373a4 \\u2014 460,050 EGP\",\"icon\":\"fa-solid fa-cart-shopping\",\"icon_color\":\"#4f46e5\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/orders\",\"order_id\":110}', NULL, '2026-07-02 09:58:22', '2026-07-02 09:58:22'),
('cd92517f-7d90-4f33-b0f7-faecfe9771d0', 'App\\Notifications\\OrderPlaced', 'App\\Models\\Employee', 3, '{\"message\":\"\\u0637\\u0644\\u0628 \\u062c\\u062f\\u064a\\u062f \\u0631\\u0642\\u0645 #ORD-6a57ac7f77983 \\u2014 184,050 EGP\",\"icon\":\"fa-solid fa-cart-shopping\",\"icon_color\":\"#4f46e5\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/orders\",\"order_id\":122}', NULL, '2026-07-15 12:51:29', '2026-07-15 12:51:29'),
('e1886e4f-4315-4e48-a758-757208299628', 'App\\Notifications\\OrderApproved', 'App\\Models\\Employee', 3, '{\"message\":\"\\u062a\\u0645 \\u0627\\u0639\\u062a\\u0645\\u0627\\u062f \\u0627\\u0644\\u0637\\u0644\\u0628 \\u0631\\u0642\\u0645 #ORD-6a31332c408e4\",\"icon\":\"fa-solid fa-circle-check\",\"icon_color\":\"#10b981\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/orders\",\"order_id\":103}', NULL, '2026-06-16 08:28:06', '2026-06-16 08:28:06'),
('e49db0ab-93dc-4852-970e-d8285cf27ef7', 'App\\Notifications\\OrderApproved', 'App\\Models\\Employee', 3, '{\"message\":\"\\u062a\\u0645 \\u0627\\u0639\\u062a\\u0645\\u0627\\u062f \\u0627\\u0644\\u0637\\u0644\\u0628 \\u0631\\u0642\\u0645 #ORD-6a32e44e3ab14\",\"icon\":\"fa-solid fa-circle-check\",\"icon_color\":\"#10b981\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/orders\",\"order_id\":105}', NULL, '2026-06-17 15:34:31', '2026-06-17 15:34:31'),
('e4a198d8-d990-4526-a8ae-e7c84d34bf8a', 'App\\Notifications\\OrderPlaced', 'App\\Models\\Employee', 11, '{\"message\":\"\\u0637\\u0644\\u0628 \\u062c\\u062f\\u064a\\u062f \\u0631\\u0642\\u0645 #ORD-6a4c1f25f1265 \\u2014 22,550 EGP\",\"icon\":\"fa-solid fa-cart-shopping\",\"icon_color\":\"#4f46e5\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/orders\",\"order_id\":112}', NULL, '2026-07-06 18:33:27', '2026-07-06 18:33:27'),
('e7183a97-7d59-4b80-9bfc-df2bdbd7fefb', 'App\\Notifications\\OrderRejected', 'App\\Models\\Employee', 11, '{\"message\":\"\\u062a\\u0645 \\u0631\\u0641\\u0636 \\u0627\\u0644\\u0637\\u0644\\u0628 \\u0631\\u0642\\u0645 #ORD-6a4c1f25f1265\",\"icon\":\"fa-solid fa-circle-xmark\",\"icon_color\":\"#ef4444\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/orders\",\"order_id\":112}', NULL, '2026-07-06 18:34:29', '2026-07-06 18:34:29'),
('e7c26c7c-b364-47f4-8b13-e7cd33947ba6', 'App\\Notifications\\OrderPlaced', 'App\\Models\\Employee', 14, '{\"message\":\"\\u0637\\u0644\\u0628 \\u062c\\u062f\\u064a\\u062f \\u0631\\u0642\\u0645 #ORD-6a51442b76354 \\u2014 10,050 EGP\",\"icon\":\"fa-solid fa-cart-shopping\",\"icon_color\":\"#4f46e5\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/orders\",\"order_id\":116}', NULL, '2026-07-10 16:12:46', '2026-07-10 16:12:46'),
('f26acdbe-f290-4302-8e32-87a27be00524', 'App\\Notifications\\NewComplaint', 'App\\Models\\Employee', 3, '{\"message\":\"\\u0634\\u0643\\u0648\\u0649 \\u062c\\u062f\\u064a\\u062f\\u0629 \\u0645\\u0646 ahmed: products\",\"icon\":\"fa-solid fa-flag\",\"icon_color\":\"#f59e0b\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/complaints\\/22\",\"complaint_id\":22}', NULL, '2026-07-01 08:51:52', '2026-07-01 08:51:52'),
('f303b969-6d37-437a-b927-924f9aaf4ad3', 'App\\Notifications\\OrderPlaced', 'App\\Models\\Employee', 3, '{\"message\":\"\\u0637\\u0644\\u0628 \\u062c\\u062f\\u064a\\u062f \\u0631\\u0642\\u0645 #ORD-6a3279b87181b \\u2014 7,550 EGP\",\"icon\":\"fa-solid fa-cart-shopping\",\"icon_color\":\"#4f46e5\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/orders\",\"order_id\":104}', NULL, '2026-06-17 07:40:56', '2026-06-17 07:40:56'),
('f5659b1c-7de5-4667-9e4a-e8040c84b843', 'App\\Notifications\\OrderApproved', 'App\\Models\\Employee', 3, '{\"message\":\"\\u062a\\u0645 \\u0627\\u0639\\u062a\\u0645\\u0627\\u062f \\u0627\\u0644\\u0637\\u0644\\u0628 \\u0631\\u0642\\u0645 #ORD-6a46606c373a4\",\"icon\":\"fa-solid fa-circle-check\",\"icon_color\":\"#10b981\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/orders\",\"order_id\":110}', NULL, '2026-07-02 10:00:32', '2026-07-02 10:00:32'),
('f6d74430-e458-4dd6-866a-8b47dddbc8f9', 'App\\Notifications\\OrderPlaced', 'App\\Models\\Employee', 3, '{\"message\":\"\\u0637\\u0644\\u0628 \\u062c\\u062f\\u064a\\u062f \\u0631\\u0642\\u0645 #ORD-6a4ed187b7f3d \\u2014 36,050 EGP\",\"icon\":\"fa-solid fa-cart-shopping\",\"icon_color\":\"#4f46e5\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/orders\",\"order_id\":113}', NULL, '2026-07-08 19:39:05', '2026-07-08 19:39:05'),
('f6e95086-aa88-4f36-b7de-e2c582f6f8c0', 'App\\Notifications\\OrderPlaced', 'App\\Models\\Employee', 3, '{\"message\":\"\\u0637\\u0644\\u0628 \\u062c\\u062f\\u064a\\u062f \\u0631\\u0642\\u0645 #ORD-6a6ad2007f7a3 \\u2014 360,050 EGP\",\"icon\":\"fa-solid fa-cart-shopping\",\"icon_color\":\"#4f46e5\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/orders\",\"order_id\":125}', NULL, '2026-07-30 01:24:34', '2026-07-30 01:24:34'),
('fa3c44dd-c306-4217-93c8-ba059d74038b', 'App\\Notifications\\OrderPlaced', 'App\\Models\\Employee', 3, '{\"message\":\"\\u0637\\u0644\\u0628 \\u062c\\u062f\\u064a\\u062f \\u0631\\u0642\\u0645 #ORD-6a617c1d26aef \\u2014 6,050 EGP\",\"icon\":\"fa-solid fa-cart-shopping\",\"icon_color\":\"#4f46e5\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/orders\",\"order_id\":124}', NULL, '2026-07-22 23:27:43', '2026-07-22 23:27:43');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(255) DEFAULT NULL,
  `total_price` decimal(18,2) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  `is_expired` tinyint(1) NOT NULL DEFAULT 0,
  `payment_method` varchar(50) NOT NULL DEFAULT 'card'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `order_number`, `total_price`, `status`, `notes`, `created_at`, `updated_at`, `expires_at`, `is_expired`, `payment_method`) VALUES
(8, 2, 'ORD-68f688f13e97c', 497100.00, 'approved', NULL, '2025-10-20 16:09:37', '2025-12-22 15:30:57', NULL, 0, 'card'),
(9, 2, 'ORD-68f68e5a2c769', 700.00, 'approved', NULL, '2025-10-20 16:32:42', '2025-12-22 15:37:34', NULL, 0, 'card'),
(10, 1, 'ORD-68f692739d68f', 1300.00, 'approved', NULL, '2025-10-20 16:50:11', '2025-12-22 15:41:10', NULL, 0, 'card'),
(11, 3, 'ORD-68f6936f6bc77', 1300.00, 'approved', NULL, '2025-10-20 16:54:23', '2025-12-22 15:41:02', NULL, 0, 'card'),
(12, 3, 'ORD-68f78d66c2485', 1476000.00, 'approved', NULL, '2025-10-21 10:40:54', '2025-12-22 15:40:51', NULL, 0, 'card'),
(13, 2, 'ORD-68f78f3267bcd', 272000.00, 'approved', NULL, '2025-10-21 10:48:34', '2025-12-22 15:39:20', NULL, 0, 'card'),
(14, 2, 'ORD-68f78fa05dce3', 75000.00, 'approved', NULL, '2025-10-21 10:50:24', '2025-12-22 15:39:41', NULL, 0, 'card'),
(15, 3, 'ORD-68f7df226e25b', 140500.00, 'approved', NULL, '2025-10-21 16:29:38', '2025-12-22 15:38:23', NULL, 0, 'card'),
(16, 3, 'ORD-68fa15e21e7a5', 1800.00, 'approved', NULL, '2025-10-23 08:47:46', '2025-12-22 15:38:07', NULL, 0, 'card'),
(17, 4, 'ORD-68fa1aa917a07', 69800.00, 'rejected', NULL, '2025-10-23 09:08:09', '2025-12-22 15:37:47', NULL, 0, 'card'),
(18, 1, 'ORD-68fa2e19e47bd', 2300.00, 'approved', NULL, '2025-10-23 10:31:05', '2025-12-22 15:37:21', NULL, 0, 'card'),
(19, 4, 'ORD-68fa7dffb4957', 5600.00, 'approved', NULL, '2025-10-23 16:11:59', '2025-12-22 15:37:12', NULL, 0, 'card'),
(20, 4, 'ORD-6908c09ee1690', 800.00, 'approved', NULL, '2025-11-03 12:47:58', '2025-12-22 15:37:04', NULL, 0, 'card'),
(21, 4, 'ORD-690a4d23df661', 210000.00, 'approved', NULL, '2025-11-04 16:59:47', '2025-12-22 15:36:56', NULL, 0, 'card'),
(22, 2, 'ORD-690a4df93f483', 450000.00, 'approved', NULL, '2025-11-04 17:03:21', '2025-12-22 15:36:46', NULL, 0, 'card'),
(23, 2, 'ORD-690c8080e94ec', 90000.00, 'approved', NULL, '2025-11-06 09:03:28', '2025-12-22 15:36:39', NULL, 0, 'card'),
(24, 3, 'ORD-69133935c2032', 3024800.00, 'approved', NULL, '2025-11-11 11:25:09', '2025-12-22 15:36:31', NULL, 0, 'card'),
(25, 1, 'ORD-691c3c3f90894', 123000.00, 'approved', NULL, '2025-11-18 07:28:31', '2025-12-22 15:35:19', NULL, 0, 'card'),
(26, 1, 'ORD-6920e81a85554', 340900.00, 'approved', NULL, '2025-11-21 20:30:50', '2025-12-22 15:35:10', NULL, 0, 'card'),
(27, 1, 'ORD-6927127e8439b', 262100.00, 'approved', NULL, '2025-11-26 12:45:18', '2025-12-22 15:34:05', NULL, 0, 'card'),
(28, 1, 'ORD-6928317d9d2f7', 187500.00, 'approved', NULL, '2025-11-27 09:09:49', '2025-12-22 15:33:18', NULL, 0, 'card'),
(29, 1, 'ORD-6928454b29e4a', 6501600.00, 'approved', NULL, '2025-11-27 10:34:19', '2025-12-22 15:33:08', NULL, 0, 'card'),
(30, 4, 'ORD-6937fc9eba170', 1400.00, 'approved', NULL, '2025-12-09 08:40:30', '2025-12-22 15:31:18', NULL, 0, 'card'),
(31, 4, 'ORD-693857c170b35', 2400.00, 'approved', NULL, '2025-12-09 15:09:21', '2025-12-22 15:31:13', NULL, 0, 'card'),
(32, 1, 'ORD-693f09016b569', 60000.00, 'approved', NULL, '2025-12-14 16:59:13', '2025-12-22 15:31:07', NULL, 0, 'card'),
(33, 1, 'ORD-6945a170cc32d', 7500.00, 'approved', NULL, '2025-12-19 17:03:12', '2025-12-22 15:31:02', '2025-12-26 19:03:12', 0, 'card'),
(34, 1, 'ORD-6945a1fcddd57', 7500.00, 'approved', NULL, '2025-12-19 17:05:32', '2025-12-22 15:30:46', '2025-12-26 19:05:32', 0, 'card'),
(35, 1, 'ORD-6945a4398d0f1', 17000.00, 'approved', NULL, '2025-12-19 17:15:05', '2025-12-22 15:30:41', '2025-12-26 19:15:05', 0, 'card'),
(36, 1, 'ORD-6945a7bd7dc95', 7500.00, 'approved', NULL, '2025-12-19 17:30:05', '2025-12-22 15:30:35', '2025-12-26 19:30:05', 0, 'card'),
(37, 1, 'ORD-69471d4a145e3', 7500.00, 'approved', NULL, '2025-12-20 20:03:54', '2025-12-22 15:30:30', '2025-12-27 22:03:54', 0, 'card'),
(38, 1, 'ORD-694720632d26f', 50000.00, 'approved', NULL, '2025-12-20 20:17:07', '2025-12-22 15:30:25', '2025-12-27 22:17:07', 0, 'card'),
(39, 2, 'ORD-6947fea58990a', 16000.00, 'approved', NULL, '2025-12-21 12:05:25', '2025-12-22 15:27:56', '2025-12-28 14:05:25', 0, 'card'),
(40, 4, 'ORD-69498000a24fe', 117500.00, 'approved', NULL, '2025-12-22 15:29:36', '2025-12-22 15:29:57', '2025-12-29 17:29:36', 0, 'card'),
(41, 3, 'ORD-69498305e03c8', 17000.00, 'approved', NULL, '2025-12-22 15:42:29', '2025-12-22 15:42:38', '2025-12-29 17:42:29', 0, 'card'),
(42, 3, 'ORD-694984fc0d5c3', 60000.00, 'approved', NULL, '2025-12-22 15:50:52', '2025-12-22 15:51:00', NULL, 0, 'card'),
(43, 3, 'ORD-6949858cd7ec9', 14000.00, 'approved', NULL, '2025-12-22 15:53:16', '2025-12-22 15:53:47', NULL, 0, 'card'),
(44, 1, 'ORD-694a8bad691cb', 15000.00, 'approved', NULL, '2025-12-23 10:31:41', '2025-12-23 10:32:44', NULL, 0, 'card'),
(45, 4, 'ORD-694c41ed8ceff', 85000.00, 'approved', NULL, '2025-12-24 17:41:33', '2025-12-24 17:41:46', NULL, 0, 'card'),
(46, 1, 'ORD-694c454e55002', 85000.00, 'approved', NULL, '2025-12-24 17:55:58', '2025-12-24 17:56:13', NULL, 0, 'card'),
(47, 1, 'ORD-694eeaf3e2735', 21001.42, 'approved', NULL, '2025-12-26 18:07:15', '2025-12-26 18:07:38', NULL, 0, 'card'),
(48, 1, 'ORD-695341385ef12', 22801.00, 'approved', NULL, '2025-12-30 01:04:24', '2025-12-30 01:04:46', NULL, 0, 'card'),
(49, 1, 'ORD-695343826fe09', 3750000.00, 'approved', NULL, '2025-12-30 01:14:10', '2025-12-30 01:14:31', NULL, 0, 'card'),
(50, 1, 'ORD-6953449dc689c', 5000000.00, 'approved', NULL, '2025-12-30 01:18:53', '2025-12-30 01:19:04', NULL, 0, 'card'),
(51, 1, 'ORD-6953455e201d3', 38000.00, 'approved', NULL, '2025-12-30 01:22:06', '2025-12-30 01:22:38', NULL, 0, 'card'),
(52, 1, 'ORD-6953c30c69621', 68000.00, 'approved', NULL, '2025-12-30 10:18:20', '2025-12-30 10:18:37', NULL, 0, 'card'),
(53, 1, 'ORD-695577064791c', 50000.00, 'approved', NULL, '2025-12-31 17:18:30', '2025-12-31 18:24:27', NULL, 0, 'card'),
(54, 1, 'ORD-69557e9582d7b', 34000.00, 'approved', NULL, '2025-12-31 17:50:45', '2025-12-31 18:24:21', NULL, 0, 'card'),
(55, 1, 'ORD-695582bf5a3b7', 0.00, 'rejected', NULL, '2025-12-31 18:08:31', '2025-12-31 18:10:51', NULL, 0, 'card'),
(56, 1, 'ORD-695582c36b74e', 0.00, 'rejected', NULL, '2025-12-31 18:08:35', '2025-12-31 18:10:56', NULL, 0, 'card'),
(57, 1, 'ORD-695582ea80660', 60000.00, 'approved', NULL, '2025-12-31 18:09:14', '2025-12-31 18:10:37', NULL, 0, 'card'),
(58, 1, 'ORD-6955831f4b0d3', 50000.00, 'approved', NULL, '2025-12-31 18:10:07', '2025-12-31 18:10:33', NULL, 0, 'card'),
(59, 1, 'ORD-6955837f149a6', 17000.00, 'approved', NULL, '2025-12-31 18:11:43', '2025-12-31 18:11:54', NULL, 0, 'card'),
(60, 1, 'ORD-69558c4fd8ffa', 12000.00, 'approved', NULL, '2025-12-31 18:49:19', '2025-12-31 18:50:28', NULL, 0, 'card'),
(61, 1, 'ORD-69558c7d57fc4', 60000.00, 'approved', NULL, '2025-12-31 18:50:05', '2025-12-31 18:50:22', NULL, 0, 'card'),
(62, 1, 'ORD-69558d3b967eb', 24001.00, 'approved', NULL, '2025-12-31 18:53:15', '2025-12-31 18:53:54', NULL, 0, 'card'),
(63, 1, 'ORD-695590ae898f0', 900.00, 'approved', NULL, '2025-12-31 19:07:58', '2026-01-05 02:25:02', NULL, 0, 'card'),
(64, 5, 'ORD-6956b0f2bd4cc', 190400.00, 'approved', NULL, '2026-01-01 15:37:54', '2026-01-01 15:38:56', NULL, 0, 'card'),
(65, 5, 'ORD-695b278edce6a', 267000.00, 'approved', NULL, '2026-01-05 00:53:02', '2026-01-05 02:21:28', NULL, 0, 'card'),
(66, 5, 'ORD-696551cd52af1', 320000.00, 'approved', NULL, '2026-01-12 17:55:57', '2026-01-12 17:56:09', NULL, 0, 'card'),
(67, 5, 'ORD-69656b0d6c851', 60000.00, 'rejected', NULL, '2026-01-12 19:43:41', '2026-01-16 16:44:43', NULL, 0, 'card'),
(68, 5, 'ORD-69663147e03f2', 7500.00, 'approved', NULL, '2026-01-13 09:49:27', '2026-01-15 14:36:40', NULL, 0, 'card'),
(69, 5, 'ORD-696636f8da155', 60000.00, 'approved', NULL, '2026-01-13 10:13:44', '2026-01-15 14:36:35', NULL, 0, 'card'),
(70, 6, 'ORD-69675482cce67', 348000.00, 'approved', NULL, '2026-01-14 06:32:02', '2026-01-14 06:32:14', NULL, 0, 'card'),
(71, 6, 'ORD-696918c4587d1', 947400.00, 'approved', NULL, '2026-01-15 14:41:40', '2026-01-15 14:42:34', NULL, 0, 'card'),
(72, 6, 'ORD-696a86a54d9e3', 250000.00, 'approved', NULL, '2026-01-16 16:42:45', '2026-01-16 16:43:37', NULL, 0, 'card'),
(73, 6, 'ORD-696cfd36be882', 3600.00, 'approved', NULL, '2026-01-18 13:33:10', '2026-01-19 18:42:07', NULL, 0, 'card'),
(74, 6, 'ORD-696d3d0c29850', 700800.00, 'approved', NULL, '2026-01-18 18:05:32', '2026-01-19 18:42:01', NULL, 0, 'card'),
(75, 6, 'ORD-696e53dd2b589', 420000.00, 'approved', NULL, '2026-01-19 13:55:09', '2026-01-19 18:42:10', NULL, 0, 'card'),
(76, 6, 'ORD-696e96e811091', 270000.00, 'approved', NULL, '2026-01-19 18:41:12', '2026-01-19 18:41:34', NULL, 0, 'card'),
(77, 6, 'ORD-696fe4fc3b222', 900.00, 'approved', NULL, '2026-01-20 18:26:36', '2026-01-20 18:31:53', NULL, 0, 'card'),
(78, 6, 'ORD-6970fd0fa0b09', 20600.00, 'approved', NULL, '2026-01-21 14:21:35', '2026-01-21 14:22:26', NULL, 0, 'card'),
(79, 6, 'ORD-697228e81bb95', 300.00, 'approved', NULL, '2026-01-22 11:40:56', '2026-01-22 11:41:38', NULL, 0, 'card'),
(80, 7, 'ORD-6972851562df9', 270000.00, 'rejected', NULL, '2026-01-22 18:14:13', '2026-02-04 18:41:26', NULL, 0, 'card'),
(81, 6, 'ORD-6974a39772b1a', 360000.00, 'approved', NULL, '2026-01-24 08:48:55', '2026-01-24 08:59:08', NULL, 0, 'card'),
(82, 8, 'ORD-6983aee613139', 22500.00, 'approved', NULL, '2026-02-04 18:41:10', '2026-02-04 18:41:17', NULL, 0, 'card'),
(83, 10, 'ORD-698a0348cd023', 15000.00, 'approved', NULL, '2026-02-09 13:54:48', '2026-02-09 13:55:13', NULL, 0, 'card'),
(84, 10, 'ORD-69a4bf8c4271c', 50000.00, 'approved', NULL, '2026-03-01 20:37:00', '2026-03-04 21:22:18', NULL, 0, 'card'),
(85, 10, 'ORD-69bc5120e3b9c', 30000.00, 'approved', NULL, '2026-03-19 17:40:16', '2026-03-19 17:41:07', NULL, 0, 'card'),
(86, 12, 'ORD-69c32f4aa81a1', 45000.00, 'approved', NULL, '2026-03-24 22:41:46', '2026-03-24 22:42:03', NULL, 0, 'card'),
(87, 12, 'ORD-69c32fbb4eab1', 60000.00, 'approved', NULL, '2026-03-24 22:43:39', '2026-03-24 22:43:51', NULL, 0, 'card'),
(88, 10, 'ORD-69d10b6cc1f3f', 270000.00, 'approved', NULL, '2026-04-04 11:00:28', '2026-05-27 19:39:14', NULL, 0, 'card'),
(89, 10, 'ORD-69d65611b7234', 30000.00, 'approved', NULL, '2026-04-08 11:20:17', '2026-04-08 11:20:42', NULL, 0, 'card'),
(90, 10, 'ORD-69d6aab1ce131', 24000.00, 'rejected', NULL, '2026-04-08 17:21:21', '2026-04-13 13:54:55', NULL, 0, 'card'),
(91, 13, 'ORD-69de49c5785de', 120000.00, 'approved', NULL, '2026-04-14 12:05:57', '2026-05-27 19:39:20', NULL, 0, 'card'),
(92, 13, 'ORD-69de4c7c823dd', 140000.00, 'approved', NULL, '2026-04-14 12:17:32', '2026-05-01 15:18:03', NULL, 0, 'card'),
(93, 13, 'ORD-69ef7e15c393a', 270000.00, 'approved', NULL, '2026-04-27 12:17:41', '2026-04-27 12:20:07', NULL, 0, 'card'),
(94, 13, 'ORD-6a068d95f2074', 280000.00, 'approved', NULL, '2026-05-15 00:05:57', '2026-05-18 20:34:31', NULL, 0, 'card'),
(95, 10, 'ORD-6a189aee4da34', 245650.00, 'approved', NULL, '2026-05-28 16:43:42', '2026-05-28 17:08:27', NULL, 0, 'card'),
(96, 10, 'ORD-6a18a3b86cd85', 2450.00, 'approved', NULL, '2026-05-28 17:21:12', '2026-05-28 17:21:23', NULL, 0, 'cash'),
(97, 10, 'ORD-6a1a1c68dbd3f', 60050.00, 'approved', NULL, '2026-05-29 20:08:24', '2026-05-29 20:09:52', NULL, 0, 'cash'),
(98, 13, 'ORD-6a1a1cfb20925', 350.00, 'rejected', NULL, '2026-05-29 20:10:51', '2026-05-29 20:11:06', NULL, 0, 'card'),
(99, 12, 'ORD-6a1a2b246cfbf', 1050050.00, 'approved', NULL, '2026-05-29 21:11:16', '2026-05-29 21:11:34', NULL, 0, 'card'),
(100, 13, 'ORD-6a2b2aa387d69', 120050.00, 'approved', NULL, '2026-06-11 18:37:39', '2026-06-11 18:47:20', NULL, 0, 'cash'),
(101, 13, 'ORD-6a312e1aed745', 60050.00, 'approved', NULL, '2026-06-16 08:06:02', '2026-06-16 08:07:15', NULL, 0, 'cash'),
(102, 15, 'ORD-6a3131ebcac06', 552050.00, 'approved', NULL, '2026-06-16 08:22:19', '2026-06-16 08:22:50', NULL, 0, 'vodafone'),
(103, 15, 'ORD-6a31332c408e4', 40050.00, 'approved', NULL, '2026-06-16 08:27:40', '2026-06-16 08:28:06', NULL, 0, 'vodafone'),
(104, 15, 'ORD-6a3279b87181b', 7550.00, 'approved', NULL, '2026-06-17 07:40:56', '2026-06-17 07:42:08', NULL, 0, 'card'),
(105, 16, 'ORD-6a32e44e3ab14', 4050.00, 'approved', NULL, '2026-06-17 15:15:42', '2026-06-17 15:34:31', NULL, 0, 'card'),
(106, 16, 'ORD-6a357f5b84927', 180050.00, 'approved', NULL, '2026-06-19 14:41:47', '2026-06-19 14:42:12', NULL, 0, 'vodafone'),
(107, 15, 'ORD-6a35854882833', 0.00, 'rejected', NULL, '2026-06-19 15:07:04', '2026-06-19 15:11:35', NULL, 0, 'card'),
(108, 15, 'ORD-6a358597699b7', 0.00, 'approved', NULL, '2026-06-19 15:08:23', '2026-06-19 15:11:29', NULL, 0, 'card'),
(109, 15, 'ORD-6a3585e6879b2', 16000000049.68, 'approved', NULL, '2026-06-19 15:09:42', '2026-06-19 15:10:19', NULL, 0, 'card'),
(110, 8, 'ORD-6a46606c373a4', 460050.00, 'approved', NULL, '2026-07-02 09:58:20', '2026-07-02 10:00:32', NULL, 0, 'card'),
(111, 8, 'ORD-6a4b99222dd07', 30050.00, 'rejected', NULL, '2026-07-06 09:01:38', '2026-07-06 09:04:02', NULL, 0, 'cash'),
(112, 17, 'ORD-6a4c1f25f1265', 22550.00, 'rejected', NULL, '2026-07-06 18:33:25', '2026-07-06 18:34:29', NULL, 0, 'card'),
(113, 17, 'ORD-6a4ed187b7f3d', 36050.00, 'approved', NULL, '2026-07-08 19:39:03', '2026-07-08 19:39:22', NULL, 0, 'cash'),
(114, 17, 'ORD-6a4ed5cd73f6e', 120050.00, 'approved', NULL, '2026-07-08 19:57:17', '2026-07-08 19:59:46', NULL, 0, 'cash'),
(115, 17, 'ORD-6a4fa0ffa25df', 3050.00, 'approved', NULL, '2026-07-09 10:24:15', '2026-07-10 16:24:11', NULL, 0, 'instapay'),
(116, 17, 'ORD-6a51442b76354', 10050.00, 'approved', NULL, '2026-07-10 16:12:43', '2026-07-10 16:24:13', NULL, 0, 'vodafone'),
(117, 17, 'ORD-6a514d9d81ca2', 120050.00, 'pending', NULL, '2026-07-10 16:53:01', '2026-07-10 16:53:01', '2026-07-17 19:53:01', 0, 'vodafone'),
(118, 17, 'ORD-6a514dbf8a615', 60050.00, 'approved', NULL, '2026-07-10 16:53:35', '2026-07-12 09:36:47', NULL, 0, 'vodafone'),
(119, 18, 'ORD-6a538cd6a33f2', 720050.00, 'pending', NULL, '2026-07-12 09:47:18', '2026-07-12 09:47:18', '2026-07-19 12:47:18', 0, 'etisalat'),
(120, 8, 'ORD-6a538ce771ded', 9050.00, 'pending', NULL, '2026-07-12 09:47:35', '2026-07-12 09:47:35', '2026-07-19 12:47:35', 0, 'vodafone'),
(121, 17, 'ORD-6a557975cf948', 240050.00, 'pending', NULL, '2026-07-13 20:49:09', '2026-07-13 20:49:09', '2026-07-20 23:49:09', 0, 'etisalat'),
(122, 17, 'ORD-6a57ac7f77983', 184050.00, 'pending', NULL, '2026-07-15 12:51:27', '2026-07-15 12:51:27', '2026-07-22 15:51:27', 0, 'vodafone'),
(123, 17, 'ORD-6a57c37b3c7df', 18050.00, 'pending', NULL, '2026-07-15 14:29:31', '2026-07-15 14:29:31', '2026-07-22 17:29:31', 0, 'orange'),
(124, 8, 'ORD-6a617c1d26aef', 6050.00, 'pending', NULL, '2026-07-22 23:27:41', '2026-07-22 23:27:41', '2026-07-30 02:27:41', 0, 'vodafone'),
(125, 17, 'ORD-6a6ad2007f7a3', 360050.00, 'pending', NULL, '2026-07-30 01:24:32', '2026-07-30 01:24:32', '2026-08-06 04:24:32', 0, 'vodafone'),
(126, 17, 'ORD-6a6ad3089067e', 160050.00, 'rejected', NULL, '2026-07-30 01:28:56', '2026-07-30 01:29:22', NULL, 0, 'etisalat');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` decimal(15,2) DEFAULT NULL,
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
(193, 83, 12, 2, 7500.00, 'أحمر', '2026-02-09 13:54:48', '2026-02-09 13:54:48'),
(194, 84, 94, 1, 50000.00, 'أحمر', '2026-03-01 20:37:00', '2026-03-01 20:37:00'),
(195, 85, 92, 4, 7500.00, 'نيلي', '2026-03-19 17:40:16', '2026-03-19 17:40:16'),
(196, 86, 96, 3, 15000.00, 'ذهبي', '2026-03-24 22:41:46', '2026-03-24 22:41:46'),
(197, 87, 96, 4, 15000.00, 'نيلي', '2026-03-24 22:43:39', '2026-03-24 22:43:39'),
(198, 88, 84, 3, 90000.00, 'أزرق', '2026-04-04 11:00:28', '2026-04-04 11:00:28'),
(199, 89, 97, 5, 6000.00, 'أسود', '2026-04-08 11:20:17', '2026-04-08 11:20:17'),
(200, 90, 97, 4, 6000.00, 'كحلي', '2026-04-08 17:21:21', '2026-04-08 17:21:21'),
(201, 91, 98, 3, 40000.00, 'نيلي', '2026-04-14 12:05:57', '2026-04-14 12:05:57'),
(202, 92, 93, 1, 50000.00, 'بنفسجي', '2026-04-14 12:17:32', '2026-04-14 12:17:32'),
(203, 92, 84, 1, 90000.00, 'أبيض', '2026-04-14 12:17:32', '2026-04-14 12:17:32'),
(204, 93, 84, 3, 90000.00, 'أحمر', '2026-04-27 12:17:41', '2026-04-27 12:17:41'),
(205, 94, 100, 3, 40000.00, 'أسود', '2026-05-15 00:05:58', '2026-05-15 00:05:58'),
(206, 94, 100, 4, 40000.00, 'رمادي', '2026-05-15 00:05:58', '2026-05-15 00:05:58'),
(207, 95, 100, 1, 40000.00, 'أزرق', '2026-05-28 16:43:42', '2026-05-28 16:43:42'),
(208, 95, 12, 1, 7500.00, 'بنفسجي', '2026-05-28 16:43:42', '2026-05-28 16:43:42'),
(209, 95, 16, 1, 60000.00, 'رمادي', '2026-05-28 16:43:42', '2026-05-28 16:43:42'),
(210, 95, 19, 1, 70000.00, 'برتقالي', '2026-05-28 16:43:42', '2026-05-28 16:43:42'),
(211, 95, 20, 1, 600.00, 'بنفسجي', '2026-05-28 16:43:42', '2026-05-28 16:43:42'),
(212, 95, 12, 1, 7500.00, 'أسود', '2026-05-28 16:43:42', '2026-05-28 16:43:42'),
(213, 95, 16, 1, 60000.00, 'أسود', '2026-05-28 16:43:42', '2026-05-28 16:43:42'),
(214, 96, 83, 4, 600.00, 'أسود', '2026-05-28 17:21:12', '2026-05-28 17:21:12'),
(215, 97, 16, 1, 60000.00, 'أسود', '2026-05-29 20:08:24', '2026-05-29 20:08:24'),
(216, 98, 50, 1, 300.00, 'أحمر', '2026-05-29 20:10:51', '2026-05-29 20:10:51'),
(217, 99, 35, 1, 80000.00, 'أخضر', '2026-05-29 21:11:16', '2026-05-29 21:11:16'),
(218, 99, 35, 1, 80000.00, 'فضي', '2026-05-29 21:11:16', '2026-05-29 21:11:16'),
(219, 99, 35, 1, 80000.00, 'رمادي', '2026-05-29 21:11:16', '2026-05-29 21:11:16'),
(220, 99, 35, 1, 80000.00, 'ذهبي', '2026-05-29 21:11:16', '2026-05-29 21:11:16'),
(221, 99, 35, 2, 80000.00, 'تركواز', '2026-05-29 21:11:16', '2026-05-29 21:11:16'),
(222, 99, 34, 19, 30000.00, 'ذهبي', '2026-05-29 21:11:16', '2026-05-29 21:11:16'),
(223, 100, 100, 3, 40000.00, 'أزرق', '2026-06-11 18:37:39', '2026-06-11 18:37:39'),
(224, 101, 16, 1, 60000.00, 'أحمر', '2026-06-16 08:06:02', '2026-06-16 08:06:02'),
(225, 102, 89, 6, 20000.00, 'أسود', '2026-06-16 08:22:19', '2026-06-16 08:22:19'),
(226, 102, 89, 6, 20000.00, 'أبيض', '2026-06-16 08:22:19', '2026-06-16 08:22:19'),
(227, 102, 101, 6, 6000.00, 'ذهبي', '2026-06-16 08:22:19', '2026-06-16 08:22:19'),
(228, 102, 101, 6, 6000.00, 'أسود', '2026-06-16 08:22:19', '2026-06-16 08:22:19'),
(229, 102, 100, 6, 40000.00, 'نيلي', '2026-06-16 08:22:19', '2026-06-16 08:22:19'),
(230, 103, 103, 1, 40000.00, 'أسود', '2026-06-16 08:27:40', '2026-06-16 08:27:40'),
(231, 104, 12, 1, 7500.00, 'أحمر', '2026-06-17 07:40:56', '2026-06-17 07:40:56'),
(232, 105, 106, 4, 1000.00, 'أزرق', '2026-06-17 15:15:42', '2026-06-17 15:15:42'),
(233, 106, 16, 3, 60000.00, 'أسود', '2026-06-19 14:41:47', '2026-06-19 14:41:47'),
(234, 108, 108, 16, 999999999.98, 'أسود', '2026-06-19 15:08:23', '2026-06-19 15:08:23'),
(235, 109, 108, 16, 999999999.98, 'أسود', '2026-06-19 15:09:42', '2026-06-19 15:09:42'),
(236, 110, 31, 2, 9000.00, 'تركواز', '2026-07-02 09:58:20', '2026-07-02 09:58:20'),
(237, 110, 102, 5, 50000.00, 'كحلي', '2026-07-02 09:58:20', '2026-07-02 09:58:20'),
(238, 110, 16, 3, 60000.00, 'نيلي', '2026-07-02 09:58:20', '2026-07-02 09:58:20'),
(239, 110, 107, 1, 6000.00, 'أسود', '2026-07-02 09:58:20', '2026-07-02 09:58:20'),
(240, 110, 52, 5, 1200.00, 'أسود', '2026-07-02 09:58:20', '2026-07-02 09:58:20'),
(241, 111, 92, 4, 7500.00, 'فيروزي', '2026-07-06 09:01:38', '2026-07-06 09:01:38'),
(242, 112, 92, 3, 7500.00, 'وردي', '2026-07-06 18:33:25', '2026-07-06 18:33:25'),
(243, 113, 107, 6, 6000.00, 'أحمر', '2026-07-08 19:39:03', '2026-07-08 19:39:03'),
(244, 114, 112, 1, 120000.00, 'برتقالي', '2026-07-08 19:57:17', '2026-07-08 19:57:17'),
(245, 115, 48, 3, 1000.00, 'برتقالي', '2026-07-09 10:24:15', '2026-07-09 10:24:15'),
(246, 116, 113, 5, 2000.00, 'نيلي', '2026-07-10 16:12:43', '2026-07-10 16:12:43'),
(247, 117, 112, 1, 120000.00, 'أسود', '2026-07-10 16:53:01', '2026-07-10 16:53:01'),
(248, 118, 111, 1, 60000.00, 'أزرق', '2026-07-10 16:53:35', '2026-07-10 16:53:35'),
(249, 119, 112, 6, 120000.00, 'أخضر', '2026-07-12 09:47:18', '2026-07-12 09:47:18'),
(250, 120, 76, 3, 3000.00, 'نيلي', '2026-07-12 09:47:35', '2026-07-12 09:47:35'),
(251, 121, 112, 2, 120000.00, 'كهرماني', '2026-07-13 20:49:09', '2026-07-13 20:49:09'),
(252, 122, 106, 4, 1000.00, 'ذهبي', '2026-07-15 12:51:27', '2026-07-15 12:51:27'),
(253, 122, 111, 3, 60000.00, 'أحمر', '2026-07-15 12:51:27', '2026-07-15 12:51:27'),
(254, 123, 113, 9, 2000.00, 'نيلي', '2026-07-15 14:29:31', '2026-07-15 14:29:31'),
(255, 124, 113, 3, 2000.00, 'أحمر', '2026-07-22 23:27:41', '2026-07-22 23:27:41'),
(256, 125, 112, 3, 120000.00, 'بنفسجي', '2026-07-30 01:24:32', '2026-07-30 01:24:32'),
(257, 126, 115, 4, 40000.00, 'أخضر', '2026-07-30 01:28:56', '2026-07-30 01:28:56');

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
  `price` decimal(15,2) DEFAULT NULL,
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
(12, 'realme C65', 'cooler gold \ncamera 64px\nDisplay 90HZ', 7500.00, 0, 19, '1', 0, NULL, '2025-09-12 03:57:29', '2026-07-05 14:31:20', '[\"1769114246_69728a86dc8a7.jpg\",\"1769114246_69728a86dd48b.png\",\"1769114246_69728a86de99b.jpg\"]'),
(16, 'lap-45', 'camera 20px', 60000.00, 0, 6, '2', 0, NULL, '2025-09-12 06:25:44', '2026-07-02 10:00:32', '[\"1768934447_696fcc2f5a59b.png\"]'),
(17, 'lap-45', '\"\"La...\"\"', 17000.00, 0, 56, '3', 0, NULL, '2025-09-22 15:22:05', '2025-12-31 18:24:21', '1758565325.png'),
(19, 'appel', 'camera14px', 70000.00, 0, 41, '45%', 0, NULL, '2025-09-23 07:02:29', '2026-05-28 17:08:27', '1758621749.jpg'),
(20, 'Backpack', 'Brow', 600.00, 0, 996, '8%', 0, NULL, '2025-09-23 07:03:11', '2026-05-28 17:08:27', '1758621791.jpg'),
(24, 'Samsung s24 ultr', 'camera 200px', 60000.00, 0, 1877, '9%', 0, NULL, '2025-09-23 17:59:25', '2026-01-15 14:42:34', '1758661165.jpg'),
(25, 'realme', 'camera100px', 6000.00, 0, 1989, '3%', 0, NULL, '2025-09-24 09:27:02', '2025-12-30 01:22:38', '1758716822.jpg'),
(26, 'lap-45', 'color b', 8000.00, 0, 8, '7', 0, NULL, '2025-09-24 10:05:57', '2025-12-22 15:36:31', '1758719157.png'),
(27, 'realme c6', 'camera 50px', 4000.00, 0, 8, '0267', 0, NULL, '2025-09-24 10:14:58', '2025-12-30 01:23:24', '1758719698.jpg'),
(29, 'Computer pc', 'CPU: intel Core i5 \r\nGPU:NVIDIA RTX 3060', 70000.00, 0, 20, '19%', 0, NULL, '2025-09-24 11:20:57', '2025-12-22 15:40:51', '1758723657.jpg'),
(31, 'realmec50 not', 'camera 64px', 9000.00, 0, 995, '19', 0, NULL, '2025-09-26 05:38:07', '2026-07-02 10:00:32', '1758875887.jpg'),
(32, 'realme C65', 'camera 50px', 10000.00, 0, 75, '20%', 0, NULL, '2025-09-26 06:27:48', '2025-12-22 15:36:31', '1758878868.png'),
(33, 'realme C65', 'jhfddjh/', 10000.00, 0, 67, '21%', 0, NULL, '2025-09-28 09:02:00', '2025-12-22 15:36:31', '1759060920.png'),
(34, 'apple 13 pro max', 'camera 64px', 30000.00, 0, 101, '30', 0, NULL, '2025-09-29 11:01:15', '2026-06-02 17:42:58', '[\"1780432978_6a1f4052ad17b.jpg\",\"1780432978_6a1f4052add88.jpg\",\"1780432978_6a1f4052ae7c1.jpg\"]'),
(35, 'Samsung s24 ultr', 'camera 200px', 80000.00, 0, 110, '4', 0, NULL, '2025-09-30 14:43:09', '2026-06-02 17:43:54', '1759254189.png'),
(37, 'apple 15 pro max', 'camera 40px', 50000.00, 0, 66, '10', 0, NULL, '2025-09-30 15:51:08', '2025-12-22 15:38:23', '1759258268.jpg'),
(39, 'realme C65', 'camera', 7000.00, 1, 22, 'ps', 0, NULL, '2025-09-30 16:05:33', '2026-01-15 14:42:34', '1759259133.jpg'),
(40, 'watch', 'color blake', 700.00, 1, 55, '6', 0, NULL, '2025-09-30 16:17:59', '2025-12-22 15:36:31', '1759259879.jpg'),
(42, 'Computer', 'RTX:4060', 50000.00, 1, 487, '5', 0, NULL, '2025-10-01 17:44:32', '2025-12-22 15:36:31', '1759351472.jpg'),
(44, 'apple 13', 'camera 50px', 40000.00, 1, 72, '20', 0, NULL, '2025-10-09 17:48:04', '2025-12-22 15:36:31', '1760042884.jpg'),
(45, 'oppo', 'camera', 9000.00, 1, 698, '60', 0, NULL, '2025-10-09 18:02:36', '2025-12-22 15:36:31', '1760043756.jpg'),
(46, 'watch', 'black', 700.00, 1, 983, '90', 0, NULL, '2025-10-13 15:59:54', '2026-01-15 14:42:34', '1760381994.jpg'),
(47, 'T-shirt', 'color :Gray', 300.00, 1, 791, '000', 0, NULL, '2025-10-18 18:00:17', '2026-01-15 14:42:34', '1760821217.jpg'),
(48, 'Backpack', 'color blak', 1000.00, 1, 91, '40', 0, NULL, '2025-10-20 10:58:40', '2026-07-10 16:24:11', '1760968720.jpg'),
(50, 'shoos', 'color: bleak', 300.00, 1, 691, '7%', 0, NULL, '2025-10-22 19:37:58', '2025-12-22 15:38:07', '1761172678.jpg'),
(52, 'dreas', 'prefect', 1200.00, 1, 5989, '8', 0, NULL, '2025-10-23 08:52:47', '2026-07-02 10:00:32', '1761220367.jpg'),
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
(68, 'T-shirt', 'T-shirt sport', 1000.14, 1, 595, '#3', 0, NULL, '2025-12-20 20:46:28', '2026-07-05 14:23:35', '1766270788.jpg'),
(69, 'Bird', 'PET BIRD', 1001.00, 1, 197, 'jhj', 0, NULL, '2025-12-24 14:39:52', '2026-07-05 14:23:54', '1766594392.png'),
(71, 'apple 13', 'ggl', 17000.00, 1, 53, '2006', 0, NULL, '2025-12-24 15:12:19', '2026-07-05 14:24:06', '1766596339.jpg'),
(73, 'watch', 'color white', 6000.00, 1, 393, 'asd', 0, NULL, '2025-12-26 17:48:33', '2026-07-05 14:24:17', '1766778513.jpg'),
(74, 'Computer pc', 'computer pc', 50000.00, 1, 58, 'cty', 0, NULL, '2025-12-31 16:52:55', '2026-07-05 14:24:39', '1767207175.jpg'),
(75, 'jacket', 'kkldj', 800.00, 1, 197, 'kji', 0, NULL, '2025-12-31 18:59:44', '2026-07-05 14:24:50', '1767214784.jpg'),
(76, 'Backpack', 'hjd', 3000.00, 1, 890, 'pou', 0, NULL, '2025-12-31 19:01:34', '2026-07-05 14:25:02', '1767214894.jpg'),
(77, 'apple 13', 'ooroe', 40000.00, 1, 795, '1869', 0, NULL, '2025-12-31 19:03:06', '2026-07-05 14:25:13', '1767214986.jpg'),
(78, 'T-shirt', 'ijfi', 300.00, 1, 891, 'jhue', 0, NULL, '2025-12-31 19:05:21', '2026-07-05 14:25:23', '1767215121.jpg'),
(81, 'Computer', 'gjhgh', 80000.00, 1, 896, 'kloi', 0, NULL, '2026-01-01 15:50:19', '2026-07-05 14:25:33', '1767289819.jpg'),
(82, 'Samsung s24 ultr', 'samseng', 87000.00, 1, 387, 'tyi', 0, NULL, '2026-01-12 18:01:32', '2026-07-05 14:25:44', '1768248092.jpg'),
(83, 'wash', 'color black', 600.00, 1, 592, '89lo', 0, NULL, '2026-01-18 16:31:17', '2026-07-05 14:25:57', '1768761077.jpg'),
(84, 'iPhone17 pro', 'nm', 90000.00, 1, 186, '78ui', 0, NULL, '2026-01-19 18:39:38', '2026-07-05 14:26:08', '[\"1769086693_69721ee59bbcc.jpg\",\"1769086693_69721ee59cb90.jpg\",\"1769086693_69721ee59d7b9.png\",\"1769086693_69721ee59e120.jpg\"]'),
(88, 'rtx 5060', 'rtx', 300.00, 1, 6996, 'yuio', 0, NULL, '2026-01-20 17:12:52', '2026-07-05 14:26:18', '[\"1768941600_696fe8204ce4e.jpg\",\"1768941600_696fe8204d67b.jpg\",\"1768941600_696fe8204dfb9.jpg\"]'),
(89, 'pc computer', 'jfj', 20000.00, 1, 6987, 'jko', 0, NULL, '2026-01-21 11:45:20', '2026-07-05 14:26:29', '[\"1769003120_6970d870194de.jpg\",\"1769003120_6970d87024f0b.jpg\",\"1769003120_6970d87034ef0.jpg\",\"1769003120_6970d870392ed.jpg\"]'),
(92, 'oppo 15 pro +5g', 'yuioioiouuu', 7500.00, 1, 1456, 'io', 0, NULL, '2026-02-04 18:30:00', '2026-07-05 14:26:45', '[\"1770237000_6983ac486f803.jpg\",\"1770237000_6983ac486fe57.jpg\",\"1770237000_6983ac48705b6.png\",\"1770237000_6983ac4871301.jpg\",\"1770237000_6983ac4871b12.jpg\"]'),
(93, 'iPhone15 pro max', 'camera 42 mpx', 50000.00, 1, 399, 'pgo', 0, NULL, '2026-02-06 12:47:23', '2026-07-05 14:26:57', '[\"1770389243_6985fefb162e7.jpg\",\"1770389243_6985fefb16cad.jpg\",\"1770389243_6985fefb174c7.jpg\",\"1770389243_6985fefb17cb1.jpg\",\"1770389243_6985fefb185c9.jpg\"]'),
(94, 'pc computer', 'jhh', 50000.00, 1, 33, 'fgkw', 0, NULL, '2026-03-01 20:12:46', '2026-07-05 14:27:09', '[\"1772403166_69a4b9de20186.jpg\",\"1772403166_69a4b9de21295.png\",\"1772403166_69a4b9de21cd0.png\",\"1772403166_69a4b9de22611.jpg\",\"1772403166_69a4b9de22ff5.jpg\"]'),
(96, 'oppo  Runo15 pro+', 'camera 60px', 15000.00, 1, 693, 'oppo15', 0, NULL, '2026-03-24 22:07:14', '2026-07-05 14:27:20', '[\"1774397234_69c32732e5d5c.jpg\",\"1774397234_69c32732e65f5.jpg\",\"1774397234_69c32732e6cc9.jpg\",\"1774397234_69c32732e7344.jpg\"]'),
(97, 'realme C65', 'hfejdaodj', 6000.00, 1, 6843, 'jofi', 0, NULL, '2026-04-01 23:03:15', '2026-07-05 14:27:32', '[\"1775652831_69d64fdf3dc29.jpg\",\"1775652831_69d64fdf3eec1.png\",\"1775652831_69d64fdf4c44d.jpg\",\"1775652831_69d64fdf4d1fd.jpg\"]'),
(98, 'samsuing s24 ultra', 'camera 200 px old 120HZ', 40000.00, 1, 697, 'sam876', 0, NULL, '2026-04-14 11:59:50', '2026-07-05 14:27:48', '[\"1776175190_69de4856b2127.jpg\",\"1776175190_69de4856b322a.jpg\",\"1776175190_69de4856b3c47.jpg\",\"1776175190_69de4856b46ec.jpg\"]'),
(100, 'samsuing s24 ultra', 'camera 200 px', 40000.00, 1, 683, 'ud,y', 0, NULL, '2026-05-10 17:47:14', '2026-07-05 14:27:59', '[\"1778446034_6a00eed21b1cd.jpg\",\"1778446034_6a00eed21bbac.jpg\",\"1778446034_6a00eed21c4e1.jpg\"]'),
(101, 'realme C65', 'Dsplay 120 hz', 6000.00, 1, 6836, 'obsj', 0, NULL, '2026-05-10 17:48:43', '2026-07-05 14:28:11', '[\"1778446123_6a00ef2b13bb5.png\",\"1778446123_6a00ef2b14d2a.jpg\",\"1778446123_6a00ef2b15af5.jpg\"]'),
(102, 'pc computer', 'cart 5090', 50000.00, 1, 85, 'nst', 0, NULL, '2026-05-10 17:50:15', '2026-07-05 14:28:23', '[\"1778446215_6a00ef87914fd.jpg\",\"1778446215_6a00ef8792093.jpg\",\"1778446215_6a00ef8792aad.jpg\",\"1778446215_6a00ef87934b7.jpg\"]'),
(103, 'pc computer', 'udhieh', 40000.00, 1, 76, 'pdt', 0, NULL, '2026-06-02 17:34:52', '2026-07-05 14:28:35', '[\"1780432492_6a1f3e6cdbc68.jpg\",\"1780432492_6a1f3e6cdcb46.jpg\",\"1780432492_6a1f3e6cdd68c.jpg\",\"1780432492_6a1f3e6cde1e7.jpg\",\"1780432492_6a1f3e6cdfb31.jpg\"]'),
(106, 'rtx 5060', 'yliut', 1000.00, 1, 73, 'mju', 0, NULL, '2026-06-17 14:54:48', '2026-07-05 14:28:48', '[\"1781718888_6a32df68df78b.jpg\",\"1781718888_6a32df68e0626.jpg\",\"1781718888_6a32df68e1379.jpg\"]'),
(107, 'realme C65', 'camera 64px', 6000.00, 1, 7993, 'ner', 0, NULL, '2026-06-17 14:57:02', '2026-07-08 19:39:22', '[\"1781719022_6a32dfee02848.png\",\"1781719022_6a32dfee03bf9.jpg\",\"1781719022_6a32dfee04741.jpg\",\"1781719022_6a32dfee04e8c.jpg\",\"1781719022_6a32dfee05c22.jpg\",\"1781719022_6a32dfee06a74.jpg\",\"1781719022_6a32dfee078be.png\",\"1781719022_6a32dfee0856a.jpg\"]'),
(108, 'with', 'sjdhdco', 60.00, 1, 7968, 'jfk', 0, NULL, '2026-06-19 15:03:33', '2026-07-05 14:29:29', '[\"1781892213_6a3584755bf23.jpg\",\"1781892213_6a3584755cb66.jpg\"]'),
(111, 'lap-45', 'kktk', 60000.00, 1, 59, 'yuwe', 0, NULL, '2026-07-05 18:54:37', '2026-07-12 09:36:47', '[\"1783288477_6a4ad29d8592d.png\",\"1783288477_6a4ad29d86472.png\"]'),
(112, 'Gaming Desktop PC', '• Brand: CyberPowerPC\n• Case Type: Mid Tower Gaming Case\n• Side Panel: Tempered Glass\n• Lighting: RGB LED Lighting\n• Cooling System: High Airflow Cooling\n• Rear Fan: 120mm RGB Cooling Fan\n• CPU Cooler: Air CPU Cooler\n• Motherboard: ATX / Micro-ATX Compatible\n• Processor Support: Intel &amp;amp; AMD Processors\n• Graphics Card: Dedicated GPU Support\n• Memory (RAM): Expandable DDR4 / DDR5 Memory\n• Storage Support: M.2 NVMe SSD, SATA SSD, HDD\n• Power Supply: Internal ATX Power Supply\n• Front I/O Ports: USB, Audio In/Out\n• Rear I/O Ports: USB, HDMI, DisplayPort, Ethernet, Audio\n• Network: Gigabit Ethernet\n• Expansion Slots: PCIe Expansion Slots\n• Cable Management: Optimized Cable Routing\n• Airflow: Top Ventilation Design\n• Upgradeability: Easy Hardware Upgrades\n• Operating System: Windows Compatible\n• Recommended Use: Gaming, Programming, Video Editing, Graphic Design, Office Work, Content Creation', 120000.00, 1, 872, 'ldjhf', 20, NULL, '2026-07-06 09:05:05', '2026-07-08 19:59:46', '[\"1783339505_6a4b99f12c0df.jpg\",\"1783339505_6a4b99f12d205.jpg\",\"1783339505_6a4b99f12df54.png\",\"1783339505_6a4b99f12eb17.png\"]'),
(113, 'Nike', 'Premium engineered upper with a lightweight and breathable design.\nInnovative full-length Air cushioning for maximum comfort and impact absorption.\nLow-profile silhouette with a modern, futuristic look.\nDurable rubber outsole provides excellent traction and stability.\nTextured seamless finish for a clean and premium appearance.\nLightweight construction for all-day comfort.\nPerfect for everyday wear, walking, and casual street style.\nSignature Nike Swoosh branding with eye-catching colorways.\nDesigned to combine advanced performance technology with iconic Air Max heritage. �\nabout.nike.com', 2000.00, 1, 562, 'ioldf', 5, NULL, '2026-07-08 21:21:12', '2026-07-10 16:24:13', '[\"1783556472_6a4ee97827123.webp\",\"1783556472_6a4ee978283eb.jpg\",\"1783556472_6a4ee978294e7.webp\",\"1783556472_6a4ee9782a93f.webp\",\"1783556472_6a4ee9782bc29.webp\",\"1783556472_6a4ee9782cfd1.jpg\"]'),
(115, 'rtx 5060', 'just other', 40000.00, 1, 8, 'other', 7, NULL, '2026-07-30 01:27:16', '2026-07-30 02:03:29', '[\"1785385636_6a6ad2a4e0869.jpg\",\"1785385636_6a6ad2a4e117f.webp\",\"1785385636_6a6ad2a4e1acb.jpg\",\"1785385636_6a6ad2a4e22ab.jpg\"]');

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
(2, 11, 56, 5, '2026-01-18 17:35:29', '2026-01-18 17:35:29'),
(3, 10, 102, 5, '2026-07-06 08:48:51', '2026-07-06 08:48:51'),
(4, 10, 92, 5, '2026-07-06 08:51:58', '2026-07-06 08:51:58'),
(13, 8, 113, 1, '2026-07-12 09:50:32', '2026-07-12 09:50:58');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `created_at`, `updated_at`, `name`, `description`) VALUES
(1, '2026-05-29 23:54:47', '2026-05-29 23:54:47', 'owner', 'Owner Account'),
(2, '2026-05-29 23:54:47', '2026-05-29 23:54:47', 'admin', 'Admin Account'),
(3, '2026-05-29 23:54:47', '2026-05-29 23:54:47', 'employee', 'Employee Account');

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
('mwe2gtLSFhQLzXBRqNO2WPFbJCXZQZtdVoxxTNUB', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YToxMjp7czo2OiJfdG9rZW4iO3M6NDA6InZVZ1dnS1RlRnZFUTJORkpaejVhMVg1MmVrcHJUODVHTUtkaXE0QTMiO3M6NjoibG9jYWxlIjtzOjI6ImVuIjtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozMDoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3Byb2R1Y3RzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1NToibG9naW5fY3VzdG9tZXJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxNztzOjUyOiJsb2dpbl9hZG1pbl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7czoxNzoiYWRtaW5fZmluZ2VycHJpbnQiO3M6NjQ6ImJlMGVjMTE5MjMzYmIyYTM0Y2MyNDY3YTdhNWQwZjc5NTFiNjA0NzJiNmY4MmVhMTU5OTk0MWI1YjVlNWVkOGIiO3M6MTk6ImFkbWluX2xhc3RfYWN0aXZpdHkiO3M6MjU6IjIwMjYtMDctMzBUMDQ6MjU6MDgrMDA6MDAiO3M6ODoiYWRtaW5faWQiO2k6MztzOjEwOiJhZG1pbl9yb2xlIjtzOjg6ImVtcGxveWVlIjtzOjE2OiJhZG1pbl9sb2dpbl90aW1lIjtzOjI1OiIyMDI2LTA3LTMwVDA0OjI1OjA4KzAwOjAwIjtzOjg6ImFkbWluX2lwIjtzOjk6IjEyNy4wLjAuMSI7fQ==', 1785387841),
('Qhx0mhfRJ5aO8FX3chCwJruQb4MqPRuZTUf4g5hD', 10, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'YToxMjp7czo2OiJfdG9rZW4iO3M6NDA6IktXM21MMzdFREhvNFhhV3ZDREdwbnR0RE1yMEF4NHBPazJyaG93NWQiO3M6NjoibG9jYWxlIjtzOjI6ImVuIjtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo0MToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL25vdGlmaWNhdGlvbnMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUyOiJsb2dpbl9hZG1pbl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7czoxNzoiYWRtaW5fZmluZ2VycHJpbnQiO3M6NjQ6IjhmMTEwNThmZjlkNWUxMGNlY2UzZTAzOTc3MjcxNzAzODNkNTMyM2NlMDYxNjM2NjAzYTg0NWZlNmE4MjFmNmMiO3M6MTk6ImFkbWluX2xhc3RfYWN0aXZpdHkiO3M6MjU6IjIwMjYtMDctMzBUMDU6MDM6MzcrMDA6MDAiO3M6ODoiYWRtaW5faWQiO2k6MztzOjEwOiJhZG1pbl9yb2xlIjtzOjg6ImVtcGxveWVlIjtzOjE2OiJhZG1pbl9sb2dpbl90aW1lIjtzOjI1OiIyMDI2LTA3LTMwVDA1OjAzOjM3KzAwOjAwIjtzOjg6ImFkbWluX2lwIjtzOjk6IjEyNy4wLjAuMSI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTA7fQ==', 1785387817),
('wGEsJuZ3EJeJu02KsQj8lmQkkuux0dTWluuIwC9c', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YToxMDp7czo2OiJfdG9rZW4iO3M6NDA6IkhHRDZQZ0VhTDB1RmU3U2VYZlluUzNZT0JpN3NoaER6d0lDTmNqR3IiO3M6NTI6ImxvZ2luX2FkbWluXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTA7czoxNzoiYWRtaW5fZmluZ2VycHJpbnQiO3M6NjQ6Ijk5ZWRhNTNkZmY3ODRkNGEwZTA0MWQ2MTVjMTM0MzE2MmU0MjE2ZTU3YjVkNmMyYjUwYzU3YjlkZjI1OWE5ODkiO3M6MTk6ImFkbWluX2xhc3RfYWN0aXZpdHkiO3M6MjU6IjIwMjYtMDctMzBUMDQ6MjI6MDcrMDA6MDAiO3M6ODoiYWRtaW5faWQiO2k6MTA7czoxMDoiYWRtaW5fcm9sZSI7czo4OiJlbXBsb3llZSI7czoxNjoiYWRtaW5fbG9naW5fdGltZSI7czoyNToiMjAyNi0wNy0zMFQwNDoyMjowNyswMDowMCI7czo4OiJhZG1pbl9pcCI7czo5OiIxMjcuMC4wLjEiO3M6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM0OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4vdmlkZW9zIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1785385328);

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
  `updated_at` timestamp NULL DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `avatar`) VALUES
(2, 'ahmed', 'ay603877ea@gmail.com', NULL, '$2y$12$8TLNjypkwbnDA7kScmRnzOFrjBt9ahHuRYa/EpYAkG4VbB.4X8RKe', '2P0tHTEBUkUO0cJN4DmzO808D0ogekcT7xjBuXZryFpiR91FMEWpmMqT1TMZ', '2025-09-19 05:50:20', '2025-09-19 05:50:20', NULL),
(3, 'mohed', 'mohmed@gmail.com', NULL, '$2y$12$WTc9qBcbQsfPrqK8FyNaXeKI6WuVGewFfI.A3kB95QEe.Yd49xoXi', 'u2lNRoOqpitAwUjHWe7pSrGpQF327N9225QazR7yeMWjIin5uS31dBh32Se5', '2025-09-19 07:03:37', '2025-09-19 07:03:37', NULL),
(4, 'Ahmed', 'ay603877es@gmail.com', NULL, '$2y$12$Wzam2U3HuNAwoXSl.H.YG.7y8a9ncKlHgReAckEIzWBeGxByr7LyG', 'UoJHMudcuYOZBVPTPnAjMMYBQgxYauL7KEgnuSZaQ8WOBjQPkPynBrtj9FDM', '2025-09-23 17:25:51', '2025-09-23 17:25:51', NULL),
(5, 'malak', 'makal@gimel.com', NULL, '$2y$12$hzNOErYwNR7YDYXM5U/v7.wLiimMspVK8TIxsttsPUAAwMavRCC4W', 'CukB3HAqMfihSD0ZLflr0gTLugGy9kkuf8yt5tpInEk8zo6h72TxH7WyVx6T', '2025-09-29 16:47:56', '2025-09-29 16:47:56', NULL),
(6, 'Ibrahem', 'ip12345@gmail.com', NULL, '$2y$12$bnqlZ0BLvFayUKGoRC8Vs.xqAw38OlpBD2iqzXUvrMwbAww3ce7BO', NULL, '2025-10-12 15:02:46', '2025-10-12 15:02:46', NULL),
(7, 'Ibrahem', 'ip12349@gmail.com', NULL, '$2y$12$h1oz7rh.K7HK24bgOr1JZ.eI5HLS5l50x5Vr7lHiTEw0T7flmnK/y', NULL, '2025-10-12 15:13:56', '2025-10-12 15:13:56', NULL),
(8, 'Ibrahem', 'Ibrahem@gimel.com', NULL, '$2y$12$aii5LJsc3bo/4n6yauBVE.aBeKR4ITGnSZnnMC2mhc.UVX7HL3Ml2', NULL, '2025-10-12 15:30:16', '2025-10-12 15:30:16', NULL),
(9, 'Ahmed', 'ahmwd@gmail.com', NULL, '$2y$12$Th4ZcUbDSarCOnTrtt2hwuC5.c5m2b39bMQ05Hv12HHL19.xkuXFe', NULL, '2025-11-07 09:27:18', '2025-11-07 09:27:18', NULL),
(10, 'Ahmed', 'ahmed1@gmail.com', NULL, '$2y$12$JyhBdAF7YApgRsrL0o.N6u8Uvijyl484PUr4B8yJtJ10yHVeAUPyy', 'M4s1WykQ7vKNaeQ7JReTuEtRlRg6dlLwoquYIbpNAsDnAoLRn36EWXw2qnH0', '2026-01-12 19:21:26', '2026-05-29 20:41:02', '1780098062.jpg'),
(11, 'ahmed', 'ahmed7@gmail.com', NULL, '$2y$12$xNhXVVnBJAA5TyVc9ZSmKeMNjGInoG0QK3HKt0XhIqIKAHvrzYDd6', NULL, '2026-01-14 06:28:09', '2026-05-29 04:37:52', '1780040272.jpg'),
(12, 'ahmed', 'ahmed8@gmail.com', NULL, '$2y$12$QQ4xtHBtHLljSK6Ff3OL4.UUGIBDQCin5KcMWj3ZEB4gCI199YgX6', 'vAYW66AJFk3JEE3ITeTAezV3UfbGyyesnq6xMU9e1D2gpfsXlLKaEIvv1B6x', '2026-01-19 18:31:11', '2026-05-27 20:39:03', '1779925143.jpg'),
(13, 'ahmed', 'ahmed10@gmail.com', NULL, '$2y$12$0vGU7frkojjPDrtkML.lduANqjg0K8AlJF73ru1CF9imuK4Rh4OOq', NULL, '2026-02-17 20:00:36', '2026-02-17 20:00:36', NULL),
(14, 'ahmed', 'ahmed0@gmail.com', NULL, '$2y$12$I5eSg11RH35.a/eW.jh4MO52iPYPtOzVLAz4EyBMfPgPY26KcjvFS', NULL, '2026-02-17 20:02:35', '2026-02-17 20:02:35', NULL),
(15, 'Mohmed', 'mohmed6@gmail.com', NULL, '$2y$12$NEb5S5ialnIr9mECUeC8meHS6ok7pFK6iqi4EwuK9RPot/GS4co32', NULL, '2026-05-27 19:49:32', '2026-05-27 20:12:48', '1779923568.jpg'),
(16, 'Ahmed', 'ahmed90@gmail.com', NULL, 'e807f1fcf82d132f9bb018ca6738a19f', NULL, NULL, NULL, NULL);

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
(32, 'pc', 'https://www.youtube.com/watch?v=nBerPYFxXZo&amp;pp=ygUDcGMg', '2026-07-01 10:02:15', '2026-07-01 10:02:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_login_logs`
--
ALTER TABLE `admin_login_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_login_logs_ip_address_login_at_index` (`ip_address`,`login_at`),
  ADD KEY `admin_login_logs_employee_id_login_at_index` (`employee_id`,`login_at`),
  ADD KEY `admin_login_logs_status_login_at_index` (`status`,`login_at`),
  ADD KEY `admin_login_logs_login_at_index` (`login_at`);

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
-- AUTO_INCREMENT for table `admin_login_logs`
--
ALTER TABLE `admin_login_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=374;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=258;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_login_logs`
--
ALTER TABLE `admin_login_logs`
  ADD CONSTRAINT `admin_login_logs_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE SET NULL;

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
