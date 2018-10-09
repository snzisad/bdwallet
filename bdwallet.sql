-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2018 at 07:01 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bdwallet`
--

-- --------------------------------------------------------

--
-- Table structure for table `balance_type`
--

CREATE TABLE `balance_type` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `balance_type`
--

INSERT INTO `balance_type` (`id`, `type`, `created_at`, `updated_at`) VALUES
(1, 'BDT', '2018-10-06 15:06:40', '2018-10-06 15:06:40'),
(2, 'USD', '2018-10-06 15:06:49', '2018-10-06 15:06:49');

-- --------------------------------------------------------

--
-- Table structure for table `exchange_history`
--

CREATE TABLE `exchange_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `exchange_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(255) NOT NULL,
  `user_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_account` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `send_amount` int(255) NOT NULL,
  `receive_amount` double NOT NULL DEFAULT '0',
  `rate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exchange_history`
--

INSERT INTO `exchange_history` (`id`, `exchange_id`, `user_id`, `user_email`, `user_phone`, `user_account`, `from_id`, `to_id`, `send_amount`, `receive_amount`, `rate`, `transaction_number`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'XRQ8y181008194141', 1, NULL, '1000', '2000', 'Paypal', 'Rocket', 5002, 10004, '500 BDT = 10 USD', '2500', 'Accepted', NULL, '2018-10-08 13:41:54', '2018-10-08 14:36:01'),
(2, 'C0HXB181008201529', 1, NULL, '1000', '25652', 'bKash', 'bKash', 5000, 100, '500 BDT = 10 USD', '1551515545', 'Rejected', NULL, '2018-10-08 14:15:41', '2018-10-08 14:36:15'),
(3, 'eAR5c181008201648', 1, NULL, '4154548', '4654564', 'bKash', 'Paypal', 40000, 2000, '500 BDT = 10 USD', '12151', 'Rejected', NULL, '2018-10-08 14:17:00', '2018-10-08 15:41:32'),
(4, 'XWi9f181008213337', 2, NULL, '0051556556', '6564', 'Paypal', 'Rocket', 5025, 10050, '500 BDT = 10 USD', '25252', 'Processing', NULL, '2018-10-08 15:33:53', '2018-10-08 15:33:53'),
(5, 'VrIwg181008214239', 2, NULL, '0051556556', '02020', 'bKash', 'Paypal', 4000, 200, '500 BDT = 10 USD', '21213213', 'Processing', NULL, '2018-10-08 15:42:50', '2018-10-08 15:42:50');

-- --------------------------------------------------------

--
-- Table structure for table `exchange_rate`
--

CREATE TABLE `exchange_rate` (
  `id` int(10) UNSIGNED NOT NULL,
  `from_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_rate` double NOT NULL,
  `to_rate` double NOT NULL,
  `from_rate_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_rate_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `minimum_transfer` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exchange_rate`
--

INSERT INTO `exchange_rate` (`id`, `from_id`, `to_id`, `from_rate`, `to_rate`, `from_rate_type`, `to_rate_type`, `minimum_transfer`, `created_at`, `updated_at`) VALUES
(5, 'Paypal', 'Rocket', 50, 100, 'USD', 'BDT', 5000, '2018-10-08 01:15:38', '2018-10-08 01:15:38'),
(7, 'bKash', 'bKash', 500, 10, 'BDT', 'USD', 3000, '2018-10-08 01:19:13', '2018-10-08 01:19:13'),
(8, 'bKash', 'Paypal', 400, 20, 'BDT', 'USD', 2000, '2018-10-08 01:19:33', '2018-10-08 01:19:33');

-- --------------------------------------------------------

--
-- Table structure for table `gateway`
--

CREATE TABLE `gateway` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reserve` int(255) NOT NULL,
  `type` int(1) NOT NULL,
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gateway`
--

INSERT INTO `gateway` (`id`, `name`, `account`, `reserve`, `type`, `icon`, `created_at`, `updated_at`) VALUES
(3, 'Rocket', '01815211454', 50000, 1, '3.jpeg', '2018-10-06 15:22:26', '2018-10-06 15:22:27'),
(6, 'Paypal', '465464854', 3800, 2, '6.png', '2018-10-06 16:14:51', '2018-10-08 15:42:50'),
(7, 'bKash', '0154848115', 30000, 1, '7.png', '2018-10-06 16:27:24', '2018-10-08 14:40:43');

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
(2, '2018_10_06_065706_news', 2),
(3, '2018_10_06_065852_gateway', 2),
(4, '2018_10_06_065906_exchange_rate', 2),
(5, '2018_10_06_065918_exchange_history', 2),
(6, '2018_10_06_065706_bala', 3);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(10) UNSIGNED NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `text`, `created_at`, `updated_at`) VALUES
(1, 'Hello this is first news. How are you all', '2018-10-06 13:56:33', '2018-10-06 14:02:42');

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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(1) NOT NULL DEFAULT '0',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `type`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Sahrif Noor Zisad', 'snzisad@gmail.com', 1, '$2y$10$RLQrgyq5.XQlnGagDo4BqOe729UzRa9Cr0zTVejQ0b/5YSThWAxuS', 'dgErTrPI3xx4hx7nxu03sCIRUZny7EEMmg2gfsJCWMZwQPgHsy4gQ9HKhCdO', '2018-10-08 01:51:35', '2018-10-08 01:51:35'),
(2, 'Bangla Soft Tech', 'snzisad2@gmail.com', 0, '$2y$10$6Mk0iawckXEXvh0s/Kb5j.8QycBqzOmrWfLgpu8aXRe7FhOeznvAW', 'dyTIKcrRqsC8GOfKvauyM7OOuUjjmgLof3nrD67wvH3lgB0dE3svDWu39MuF', '2018-10-08 15:16:04', '2018-10-08 15:16:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `balance_type`
--
ALTER TABLE `balance_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exchange_history`
--
ALTER TABLE `exchange_history`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `exchange_id` (`exchange_id`);

--
-- Indexes for table `exchange_rate`
--
ALTER TABLE `exchange_rate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gateway`
--
ALTER TABLE `gateway`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
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
-- AUTO_INCREMENT for table `balance_type`
--
ALTER TABLE `balance_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `exchange_history`
--
ALTER TABLE `exchange_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `exchange_rate`
--
ALTER TABLE `exchange_rate`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `gateway`
--
ALTER TABLE `gateway`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
