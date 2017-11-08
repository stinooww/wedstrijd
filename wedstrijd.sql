-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: ID211210_wedstrijd1.db.webhosting.be-- Generation Time: Nov 07, 2017 at 02:54 AM
-- Server version: 5.7.20-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: ID211210_wedstrijd1--

-- --------------------------------------------------------

--
-- Table structure for table `deelnemer`
--

CREATE TABLE `deelnemer` (
  `id` int(10) UNSIGNED NOT NULL,
  `wedstrijd_id` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `streetname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `streetnumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postcode` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `qualified` tinyint(1) NOT NULL DEFAULT '0',
  `ip` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deelnemer`
--

INSERT INTO `deelnemer` (`id`, `wedstrijd_id`, `firstname`, `lastname`, `streetname`, `streetnumber`, `postcode`, `email`, `question`, `is_deleted`, `qualified`, `ip`, `created_at`, `updated_at`) VALUES
(3, 2, 'stijnn', 'heynderickx', 'oude baan', '205', 2990, 'stijn.heynderickx@gmail.com', '20', 0, 0, '192.168.56.15', '2017-11-06 01:02:11', '2017-11-06 20:51:29'),
(4, 2, 'Bennnnnn', 'Heynderickx', 'oude baan 205555', '25', 2990, 'stijn.heynderickx@gmail.com', '20', 0, 0, '192.168.56.1', '2017-11-06 02:00:45', '2017-11-06 20:30:04');

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
(1, '2013_10_21_102211_create_roles_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2017_10_22_115709_create_wedstrijd_table', 1),
(5, '2017_10_23_110625_create_deelnemer_table', 1),
(6, '2017_10_23_115845_create_winnaar_table', 1),
(7, '2017_10_27_140217_create_social_facebook_accounts_table', 1),
(11, '2017_11_05_225103_create_emails_table', 2);

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
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
(1, 'verantwoordelijke'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `social_facebook_accounts`
--

CREATE TABLE `social_facebook_accounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `provider_user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED DEFAULT '2',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 2, 'stijn', 'stijn.heynderickx@gmail.com', 'billabong', NULL, NULL, '2017-11-06 06:57:09'),
(2, 1, 'sti145', 'sti.hx@gmail.com', 'billabong', NULL, NULL, '2017-11-06 23:42:21'),
(4, 1, 'stijn8', 'stijn.heynderick@gmail.com', 'billabong1', NULL, NULL, '2017-11-06 06:57:09'),
(6, 2, 'stinoo', 'stijntje_98@hotmail.com', '$2y$10$1vI.Nvo1gcAkkbjWnrqELuKgu7yYg9VFf6bdevOL1cit5mBWnilaq', 'mUWJBNq4gMQhUZUYOYZ7DgnDFNeHfBaVqJDSrrNhLMCFAVyaCZgSpyNDMZBz', '2017-11-06 17:12:15', '2017-11-06 17:12:15');

-- --------------------------------------------------------

--
-- Table structure for table `wedstrijd`
--

CREATE TABLE `wedstrijd` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wedstrijd`
--

INSERT INTO `wedstrijd` (`id`, `user_id`, `name`, `start_date`, `end_date`, `is_active`, `created_at`, `updated_at`) VALUES
(2, 2, 'wedstrijd4', '1992-10-29', '1992-10-30', 1, NULL, '2017-11-06 05:11:53'),
(3, 1, 'probeersel', '1992-10-29', '1992-10-30', 0, '2017-11-06 18:43:19', '2017-11-06 20:38:15');

-- --------------------------------------------------------

--
-- Table structure for table `winnaar`
--

CREATE TABLE `winnaar` (
  `id` int(10) UNSIGNED NOT NULL,
  `deelnemer_id` int(10) UNSIGNED NOT NULL,
  `disqualified` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `winnaar`
--

INSERT INTO `winnaar` (`id`, `deelnemer_id`, `disqualified`, `created_at`, `updated_at`) VALUES
(1, 3, 0, NULL, NULL),
(2, 3, 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `deelnemer`
--
ALTER TABLE `deelnemer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `deelnemer_ip_unique` (`ip`),
  ADD KEY `deelnemer_wedstrijd_id_foreign` (`wedstrijd_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_facebook_accounts`
--
ALTER TABLE `social_facebook_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `wedstrijd`
--
ALTER TABLE `wedstrijd`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wedstrijd_user_id_foreign` (`user_id`);

--
-- Indexes for table `winnaar`
--
ALTER TABLE `winnaar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `winnaar_deelnemer_id_foreign` (`deelnemer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `deelnemer`
--
ALTER TABLE `deelnemer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `social_facebook_accounts`
--
ALTER TABLE `social_facebook_accounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `wedstrijd`
--
ALTER TABLE `wedstrijd`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `winnaar`
--
ALTER TABLE `winnaar`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `deelnemer`
--
ALTER TABLE `deelnemer`
  ADD CONSTRAINT `deelnemer_wedstrijd_id_foreign` FOREIGN KEY (`wedstrijd_id`) REFERENCES `wedstrijd` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wedstrijd`
--
ALTER TABLE `wedstrijd`
  ADD CONSTRAINT `wedstrijd_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `winnaar`
--
ALTER TABLE `winnaar`
  ADD CONSTRAINT `winnaar_deelnemer_id_foreign` FOREIGN KEY (`deelnemer_id`) REFERENCES `deelnemer` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
