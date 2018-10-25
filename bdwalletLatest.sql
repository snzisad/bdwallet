-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2018 at 01:19 AM
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
(1, 'BDT', NULL, NULL),
(2, 'USD', NULL, NULL);

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
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `send_amount` double NOT NULL,
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
(1, 'myI2Y181019062727', 1, NULL, '123456', '6564', 6, 3, 100, 8000, '1 USD = 80 BDT', '1551515545', 'Processing', NULL, '2018-10-19 00:27:43', '2018-10-19 00:55:10'),
(2, 'myI2Y181019062728', 1, NULL, '123456', '6564', 3, 7, 10, 80, '1 USD = 80 BDT', '1551515545', 'Rejected', NULL, '2018-10-19 00:27:43', '2018-10-19 00:58:47');

-- --------------------------------------------------------

--
-- Table structure for table `exchange_rate`
--

CREATE TABLE `exchange_rate` (
  `id` int(10) UNSIGNED NOT NULL,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `from_rate` double NOT NULL,
  `to_rate` double NOT NULL,
  `from_rate_type` int(11) NOT NULL,
  `to_rate_type` int(11) NOT NULL,
  `minimum_transfer` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exchange_rate`
--

INSERT INTO `exchange_rate` (`id`, `from_id`, `to_id`, `from_rate`, `to_rate`, `from_rate_type`, `to_rate_type`, `minimum_transfer`, `created_at`, `updated_at`) VALUES
(2, 7, 6, 95, 1, 1, 2, 5000, '2018-10-18 23:36:20', '2018-10-18 23:36:20'),
(3, 7, 7, 1, 0.99, 1, 1, 1000, '2018-10-18 23:48:51', '2018-10-18 23:48:51'),
(4, 6, 8, 1, 0.9, 2, 2, 20, '2018-10-19 00:15:06', '2018-10-19 00:15:06'),
(5, 6, 3, 1, 80, 2, 1, 20, '2018-10-19 00:15:33', '2018-10-19 00:15:33'),
(6, 7, 8, 100, 5, 1, 1, 1000, '2018-10-19 01:06:50', '2018-10-19 01:06:50');

-- --------------------------------------------------------

--
-- Table structure for table `gateway`
--

CREATE TABLE `gateway` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reserve` double NOT NULL,
  `type` int(1) NOT NULL,
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gateway`
--

INSERT INTO `gateway` (`id`, `name`, `account`, `reserve`, `type`, `icon`, `created_at`, `updated_at`) VALUES
(3, 'Rocket', '01815211454', 35700, 1, '3.jpeg', '2018-10-06 15:22:26', '2018-10-19 01:06:07'),
(6, 'PayPal', '465464854', 24450, 2, '6.png', '2018-10-06 16:14:51', '2018-10-19 01:06:21'),
(7, 'bKash', '0154848115', 30500, 1, '7.png', '2018-10-06 16:27:24', '2018-10-18 11:55:12'),
(8, 'Skrill', 'asASAADSADAS', 2000, 2, '8.jpeg', '2018-10-18 23:40:24', '2018-10-18 23:40:25'),
(9, 'Payoneer', 'fgdfgdfg', 5000, 2, '9.png', '2018-10-19 01:11:58', '2018-10-19 01:11:59');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `message`, `created_at`, `updated_at`) VALUES
(1, 'Islami Bank Bangladesh LTD', 'snzisad@gmail.com', 'Hello this is a test message', '2018-10-18 12:39:41', '2018-10-18 12:39:41');

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
(6, '2018_10_06_065706_bala', 3),
(7, '2018_10_17_210645_reviews', 4),
(8, '2018_10_17_210814_wallet_balance', 4),
(9, '2018_10_17_211107_wallet_exchange', 4),
(10, '2018_10_17_211118_wallet_deposit', 4),
(11, '2018_10_17_211140_wallet_withdraw', 4),
(12, '2018_10_18_085353_wallet', 5),
(13, '2018_10_18_171353_message', 6),
(14, '2018_10_25_214137_online_status', 7);

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
(1, 'Hello this is first news. How are you', '2018-10-06 13:56:33', '2018-10-25 15:36:17'),
(2, 'This is track exchange notice', '2018-10-06 13:56:33', '2018-10-25 15:36:17');

-- --------------------------------------------------------

--
-- Table structure for table `online_status`
--

CREATE TABLE `online_status` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `online_status`
--

INSERT INTO `online_status` (`id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(6, 1, 1, '2018-10-25 16:07:50', '2018-10-25 16:07:50');

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
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `status`, `comment`, `created_at`, `updated_at`) VALUES
(2, 2, 'positive', 'very good site', '2018-10-17 16:08:33', '2018-10-17 16:26:42'),
(3, 1, 'negative', 'The site is bad', '2018-10-17 16:08:33', '2018-10-19 00:31:12');

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
(1, 'Sahrif Noor Zisad', 'snzisad@gmail.com', 1, '$2y$10$RLQrgyq5.XQlnGagDo4BqOe729UzRa9Cr0zTVejQ0b/5YSThWAxuS', '2dHj0WfdsZ5YZG1MFQBhpcU6O1ECB6q3xjsafwBdlQcUY0nr5sv974IrnGWh', '2018-10-08 01:51:35', '2018-10-08 01:51:35'),
(2, 'Bangla Soft Tech', 'snzisad2@gmail.com', 0, '$2y$10$zkvcrbPz.TK7kZRrVgCWb.r.xChDRc1huyCds4x3ra02ex4LwTnHe', 'zlSqBkgN95LUAdfz8Sn5MZva9QFWSVW1vBxA2RN52sYokehUWMqp4Jfz1rCm', '2018-10-08 15:16:04', '2018-10-17 16:35:41');

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `wallet_id` int(11) NOT NULL,
  `balance` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`id`, `user_id`, `wallet_id`, `balance`, `created_at`, `updated_at`) VALUES
(1, 1, 6, 570, '2018-10-19 00:47:59', '2018-10-19 01:06:07'),
(2, 1, 8, 18, '2018-10-19 00:49:03', '2018-10-19 00:49:03');

-- --------------------------------------------------------

--
-- Table structure for table `wallet_deposit`
--

CREATE TABLE `wallet_deposit` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `wallet_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'processing',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallet_deposit`
--

INSERT INTO `wallet_deposit` (`id`, `user_id`, `wallet_id`, `amount`, `transaction_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 6, 150, '5I9272MAVA', 'processing', '2018-10-19 00:47:30', '2018-10-19 01:03:09'),
(2, 1, 3, 4500, '5i9272MAVA', 'rejected', '2018-10-19 00:47:42', '2018-10-19 01:03:38');

-- --------------------------------------------------------

--
-- Table structure for table `wallet_exchange`
--

CREATE TABLE `wallet_exchange` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `send_amount` double NOT NULL,
  `receive_amount` double NOT NULL,
  `rate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'processing',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallet_exchange`
--

INSERT INTO `wallet_exchange` (`id`, `user_id`, `from_id`, `to_id`, `send_amount`, `receive_amount`, `rate`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 6, 8, 20, 18, '1 USD = 0.9 USD', 'processing', '2018-10-19 00:49:04', '2018-10-19 00:49:04'),
(2, 1, 2, 3, 20, 18, '1 USD = 0.9 USD', 'processing', '2018-10-19 00:49:04', '2018-10-19 00:49:04');

-- --------------------------------------------------------

--
-- Table structure for table `wallet_withdraw`
--

CREATE TABLE `wallet_withdraw` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `send_amount` double NOT NULL,
  `receive_amount` double NOT NULL,
  `rate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'processing',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallet_withdraw`
--

INSERT INTO `wallet_withdraw` (`id`, `user_id`, `from_id`, `to_id`, `send_amount`, `receive_amount`, `rate`, `account`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 6, 3, 10, 800, '1 USD = 80 BDT', '5000', 'accepted', '2018-10-19 00:51:34', '2018-10-19 01:06:08'),
(2, 1, 3, 7, 100, 90, '1 USD = 80 BDT', '5000', 'rejected', '2018-10-19 00:51:34', '2018-10-19 01:06:11');

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
-- Indexes for table `messages`
--
ALTER TABLE `messages`
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
-- Indexes for table `online_status`
--
ALTER TABLE `online_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reviews_user_id_unique` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet_deposit`
--
ALTER TABLE `wallet_deposit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet_exchange`
--
ALTER TABLE `wallet_exchange`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet_withdraw`
--
ALTER TABLE `wallet_withdraw`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `exchange_rate`
--
ALTER TABLE `exchange_rate`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `gateway`
--
ALTER TABLE `gateway`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `online_status`
--
ALTER TABLE `online_status`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wallet_deposit`
--
ALTER TABLE `wallet_deposit`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wallet_exchange`
--
ALTER TABLE `wallet_exchange`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wallet_withdraw`
--
ALTER TABLE `wallet_withdraw`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
