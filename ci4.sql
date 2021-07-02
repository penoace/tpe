-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2021 at 06:24 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci4`
--

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `id` int(5) UNSIGNED NOT NULL,
  `area` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`id`, `area`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Unit-#1', '2021-06-29 07:40:39', '2021-06-29 07:40:39', NULL),
(2, 'Unit-#2', '2021-06-29 07:40:46', '2021-06-29 07:40:46', NULL),
(3, 'Unit-#3', '2021-06-29 07:40:54', '2021-06-29 07:40:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_activation_attempts`
--

CREATE TABLE `auth_activation_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_groups`
--

INSERT INTO `auth_groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'administrator'),
(2, 'user', 'user biasa');

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_permissions`
--

CREATE TABLE `auth_groups_permissions` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`group_id`, `user_id`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `email`, `user_id`, `date`, `success`) VALUES
(1, '::1', 'admin@mail.com', 1, '2021-06-28 23:31:55', 1),
(2, '::1', 'admin@mail.com', 1, '2021-06-28 23:32:41', 1),
(3, '::1', 'tes@mail.com', 2, '2021-06-28 23:32:57', 1),
(4, '::1', 'admin@mail.com', 1, '2021-06-28 23:33:02', 1),
(5, '::1', 'admin@mail.com', 1, '2021-06-29 04:22:16', 1),
(6, '::1', 'admin@mail.com', 1, '2021-06-29 04:24:57', 1),
(7, '::1', 'admin@mail.com', 1, '2021-06-29 20:18:13', 1),
(8, '::1', 'admin@mail.com', 1, '2021-06-29 21:22:41', 1),
(9, '::1', 'admin@mail.com', 1, '2021-06-30 02:21:02', 1),
(10, '::1', 'admin@mail.com', 1, '2021-06-30 05:18:09', 1),
(11, '::1', 'admin@mail.com', 1, '2021-07-01 00:49:04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_reset_attempts`
--

CREATE TABLE `auth_reset_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_users_permissions`
--

CREATE TABLE `auth_users_permissions` (
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `evalu`
--

CREATE TABLE `evalu` (
  `id` int(5) UNSIGNED NOT NULL,
  `id_fdt` int(5) UNSIGNED NOT NULL,
  `desc` varchar(255) NOT NULL,
  `jenis` enum('3','6','12') NOT NULL DEFAULT '3',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `fdt`
--

CREATE TABLE `fdt` (
  `id` int(5) UNSIGNED NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `id_rcfa` int(5) UNSIGNED NOT NULL,
  `id_pic` int(5) UNSIGNED NOT NULL,
  `target` datetime NOT NULL,
  `no_wo` varchar(255) NOT NULL,
  `progress` enum('open','inprogress','close') NOT NULL DEFAULT 'open',
  `implementasi` datetime NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(17, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1624940675, 1),
(23, '2021-06-29-025207', 'App\\Database\\Migrations\\Peta', 'default', 'App', 1624948439, 2),
(24, '2021-06-29-025211', 'App\\Database\\Migrations\\Area', 'default', 'App', 1624948439, 2),
(25, '2021-06-29-025215', 'App\\Database\\Migrations\\Rcfa', 'default', 'App', 1624948439, 2),
(26, '2021-06-29-025219', 'App\\Database\\Migrations\\Fdt', 'default', 'App', 1624948439, 2),
(27, '2021-06-29-025227', 'App\\Database\\Migrations\\Evaluasi', 'default', 'App', 1624948439, 2),
(28, '2021-06-30-041025', 'App\\Database\\Migrations\\Pareto', 'default', 'App', 1625026692, 3);

-- --------------------------------------------------------

--
-- Table structure for table `pareto`
--

CREATE TABLE `pareto` (
  `id` int(5) UNSIGNED NOT NULL,
  `pereto` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pareto`
--

INSERT INTO `pareto` (`id`, `pereto`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Lost Output', '2021-06-30 11:20:24', NULL, NULL),
(2, 'Maintenance Cost', '2021-06-30 11:20:24', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `peta`
--

CREATE TABLE `peta` (
  `id` int(5) UNSIGNED NOT NULL,
  `problem` varchar(255) NOT NULL,
  `id_area` int(5) UNSIGNED NOT NULL,
  `effect` varchar(255) NOT NULL,
  `pareto` varchar(255) NOT NULL,
  `rcfa` varchar(255) DEFAULT NULL,
  `s_rcfa` tinyint(1) DEFAULT NULL,
  `id_pic` int(5) UNSIGNED NOT NULL,
  `status` enum('open','inprogress','close') NOT NULL DEFAULT 'open',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `peta`
--

INSERT INTO `peta` (`id`, `problem`, `id_area`, `effect`, `pareto`, `rcfa`, `s_rcfa`, `id_pic`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '34', 2, '[\"1\"]', '[\"Alaska\"]', '', 0, 1, 'open', '2021-06-29 08:39:54', '2021-06-29 20:22:03', '2021-06-29 20:22:03'),
(2, 'tee', 1, '[\"1\",\"2\"]', '[\"Alabama\",\"California\"]', '', 0, 1, 'open', '2021-06-29 08:40:33', '2021-06-29 20:21:46', '2021-06-29 20:21:46'),
(3, 'tes', 1, '[\"1\",\"2\"]', '[\"Delaware\"]', '1231', 1, 1, 'open', '2021-06-29 08:41:29', '2021-06-29 20:21:44', '2021-06-29 20:21:44'),
(4, '2131', 1, '[\"2\"]', '[\"Texas\"]', '234', 0, 1, 'close', '2021-06-29 08:43:27', '2021-06-29 20:21:18', '2021-06-29 20:21:18'),
(5, '123', 2, 'deratin', '[\"Alaska\"]', '123141', 1, 2, 'open', '2021-06-29 23:00:23', '2021-06-29 23:22:27', '2021-06-29 23:22:27'),
(6, 'tss', 2, 'deratin', '[\"2\"]', '', 1, 2, 'close', '2021-06-29 23:26:32', '2021-06-30 08:34:00', NULL),
(8, 'problem', 3, 'donwtine', '[\"1\",\"2\"]', 'aaa', 1, 1, 'open', '2021-06-30 00:00:28', '2021-06-30 00:04:11', NULL),
(9, 'problem', 3, '\"1ped\"', '[\"1\",\"2\"]', NULL, NULL, 1, 'open', '2021-06-30 00:01:59', '2021-06-30 00:03:04', '2021-06-30 00:03:04');

-- --------------------------------------------------------

--
-- Table structure for table `rcfa`
--

CREATE TABLE `rcfa` (
  `id` int(5) UNSIGNED NOT NULL,
  `id_peta` int(5) UNSIGNED NOT NULL,
  `workshop` datetime DEFAULT NULL,
  `nota` varchar(255) DEFAULT NULL,
  `status` enum('open','inprogress','close') NOT NULL DEFAULT 'open',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rcfa`
--

INSERT INTO `rcfa` (`id`, `id_peta`, `workshop`, `nota`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 8, NULL, NULL, 'open', '2021-06-30 06:47:19', '2021-06-30 06:47:19', NULL),
(2, 6, NULL, NULL, 'open', '2021-07-01 00:49:13', '2021-07-01 00:49:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password_hash`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin@mail.com', 'admin', '$2y$10$7bs/uTGhalYmxCwcOM9v8Onyc5AAJcsRpw2zYbsJNMDcbP/2W46li', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2021-06-28 23:27:02', '2021-06-28 23:27:02', NULL),
(2, 'tes@mail.com', 'tes', '$2y$10$KS8mQW/LE5AszeWYG5yLa..ZYPQCDx8A2Dsl0YuR0TbXOKooYLCcS', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2021-06-28 23:32:38', '2021-06-28 23:32:38', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `group_id_permission_id` (`group_id`,`permission_id`);

--
-- Indexes for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`),
  ADD KEY `group_id_user_id` (`group_id`,`user_id`);

--
-- Indexes for table `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_tokens_user_id_foreign` (`user_id`),
  ADD KEY `selector` (`selector`);

--
-- Indexes for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `user_id_permission_id` (`user_id`,`permission_id`);

--
-- Indexes for table `evalu`
--
ALTER TABLE `evalu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fdt`
--
ALTER TABLE `fdt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pareto`
--
ALTER TABLE `pareto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peta`
--
ALTER TABLE `peta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rcfa`
--
ALTER TABLE `rcfa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `evalu`
--
ALTER TABLE `evalu`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fdt`
--
ALTER TABLE `fdt`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `pareto`
--
ALTER TABLE `pareto`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `peta`
--
ALTER TABLE `peta`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `rcfa`
--
ALTER TABLE `rcfa`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
