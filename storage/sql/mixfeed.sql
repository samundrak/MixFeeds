-- phpMyAdmin SQL Dump
-- version 4.2.3deb1.precise~ppa.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 07, 2015 at 05:12 PM
-- Server version: 5.6.25
-- PHP Version: 5.6.10-1+deb.sury.org~precise+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mixfeed`
--

-- --------------------------------------------------------

--
-- Table structure for table `gar_migrations`
--

CREATE TABLE IF NOT EXISTS `gar_migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gar_migrations`
--

INSERT INTO `gar_migrations` (`migration`, `batch`) VALUES
('2014_10_12_100000_create_password_resets_table', 1),
('2015_10_28_153122_create_users_table', 2),
('2015_10_28_151459_create_users_table', 3),
('2015_10_29_143657_create_widgets_table', 3),
('2015_10_29_162426_create_transaction_table', 4),
('2015_11_02_174300_create_subscription_table', 5),
('2015_11_03_174052_create_plans_table', 6),
('2015_11_06_155753_create_plan-desc_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `gar_password_resets`
--

CREATE TABLE IF NOT EXISTS `gar_password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gar_plans`
--

CREATE TABLE IF NOT EXISTS `gar_plans` (
`id` int(10) unsigned NOT NULL,
  `plan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `active` tinyint(1) NOT NULL,
  `creator` int(11) NOT NULL,
  `validate` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `gar_plans`
--

INSERT INTO `gar_plans` (`id`, `plan`, `amount`, `active`, `creator`, `validate`, `created_at`, `updated_at`) VALUES
(2, 'Basic', 0, 1, 1, '2015-11-03', '2015-11-03 12:06:50', '2015-11-03 12:06:50'),
(3, 'Lite', 9, 1, 1, '2015-11-03', '2015-11-03 12:06:50', '2015-11-03 12:06:50'),
(4, 'Pro', 19, 1, 1, '2015-11-03', '2015-11-03 12:06:50', '2015-11-03 12:06:50');

-- --------------------------------------------------------

--
-- Table structure for table `gar_plan_descs`
--

CREATE TABLE IF NOT EXISTS `gar_plan_descs` (
`id` int(10) unsigned NOT NULL,
  `points` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `widgets` int(11) NOT NULL DEFAULT '1',
  `pages` int(11) NOT NULL DEFAULT '8',
  `settings` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `plan_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `gar_plan_descs`
--

INSERT INTO `gar_plan_descs` (`id`, `points`, `widgets`, `pages`, `settings`, `plan_id`, `created_at`, `updated_at`) VALUES
(1, '["User can create only 1 widget","Max 8 Facebook Pages embedded","Logo for MultiEmbed.com displayed (100x40px), that links back to www.multiembed.com","Can display random","Can display facebook page with latest post first","Can set widget with or choose responsive ","Can set height ","Can show friends face ","Can set small header ","Can hide cover photo"]', 1, 8, '{"size":true,"display":{"random":true,"latest":true,"friends_face":true,"small_header":true,"hide_cover_photo":true}}', 2, '2015-11-06 10:32:33', '2015-11-06 10:32:33'),
(2, '["Logo for MultiEmbed.com displayed (100x40px), that links back to www.multiembed.com","Can display random","Can display facebook page with latest post first","Can set widget with or choose responsive ","Can set height ","Can show friends face ","Can set small header ","Can hide cover photo","Can create up to 5 widgets","Max 16 Facebook Pages for each widget"]', 5, 16, '{"size":true,"display":{"random":true,"latest":true,"friends_face":true,"small_header":true,"hide_cover_photo":true}}', 3, '2015-11-06 10:34:25', '2015-11-06 10:34:25'),
(3, '["Can display random","Can display facebook page with latest post first","Can set widget with or choose responsive ","Can set height ","Can show friends face ","Can set small header ","Can hide cover photo","Can create up to 20 widgets","Max 40 Facebook Pages for each widget","No logo or ad for MultiEmbed"]', 20, 40, '{"size":true,"display":{"random":true,"latest":true,"friends_face":true,"small_header":true,"hide_cover_photo":true}}', 4, '2015-11-06 10:36:07', '2015-11-06 10:36:07');

-- --------------------------------------------------------

--
-- Table structure for table `gar_subscription`
--

CREATE TABLE IF NOT EXISTS `gar_subscription` (
`id` int(10) unsigned NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `plan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `user` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=43 ;

--
-- Dumping data for table `gar_subscription`
--

INSERT INTO `gar_subscription` (`id`, `start`, `end`, `plan`, `amount`, `user`, `created_at`, `updated_at`) VALUES
(42, '2015-11-06', '2015-12-06', '2', 0, 3, '2015-11-06 14:41:25', '2015-11-06 14:41:25');

-- --------------------------------------------------------

--
-- Table structure for table `gar_transaction`
--

CREATE TABLE IF NOT EXISTS `gar_transaction` (
`id` int(10) unsigned NOT NULL,
  `user` int(11) NOT NULL,
  `amount` double NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `gar_users`
--

CREATE TABLE IF NOT EXISTS `gar_users` (
`id` int(10) unsigned NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `balance` double NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_verified` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `gar_users`
--

INSERT INTO `gar_users` (`id`, `firstname`, `lastname`, `email`, `password`, `remember_token`, `is_admin`, `balance`, `created_at`, `updated_at`, `is_verified`) VALUES
(3, 'samundra', 'kha', 'samundrak@yahoo.com', '$2y$10$KfqK./DCkmi/oHZDU.q7zukwemyHu/.dpB/TtgsLS7nWTB8Fw.0Ue', 'AqGT25aRR7va9gbnxSnJrZwRn6mcgZxvaJaOtotnAblvJ2XgLhQst9nuRV5q', 0, 888.25, '2015-10-28 15:04:34', '2015-11-06 14:37:19', 0),
(4, 'samundra', 'kha', 'nepali@yahoo.com', '$2y$10$5zzFF00HPEtSVMpWg0/IIe19LAGp0JFX/8aBqoheP3KqAQJXhrwFa', 'QrcVvQq4xTocwklrAI6MAk8JgzvN0rnBb9A1gdwtqYxirBG20adaTE8nGDIG', 0, 1, '2015-11-04 13:34:29', '2015-11-06 11:46:18', 0),
(5, 'samundra', 'kha', 'samundraks@yahoo.com', '$2y$10$oru3Q0o/XN2SL6GXP0MObOCxClptRblHvkxZAka22K.i7DQMbJaYW', NULL, 0, 0, '0000-00-00 00:00:00', '2015-11-06 11:46:18', 0),
(6, 'samundra', 'kha', 'arati@yahoo.com', '$2y$10$u..krGTQ4yjXFRhEfdCS3uAcSTnOtmsQlqoStRn84QwXYWyuGpPru', '6wC4ThLNePKiAQp5ZRXShQDQis0QyChb531OC6DvNKFABiZs1HzY6mHZytRC', 0, 0, '2015-11-05 13:27:11', '2015-11-06 11:46:18', 0);

-- --------------------------------------------------------

--
-- Table structure for table `gar_widgets`
--

CREATE TABLE IF NOT EXISTS `gar_widgets` (
`id` int(10) unsigned NOT NULL,
  `creator` int(11) NOT NULL,
  `widget_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pages` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `domain` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `settings` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `gar_widgets`
--

INSERT INTO `gar_widgets` (`id`, `creator`, `widget_name`, `pages`, `domain`, `settings`, `token`, `created_at`, `updated_at`) VALUES
(2, 3, 'rfrrr', '["http:\\/\\/www.facebook.com\\/ncell"]', 'http://www.google.com', '{"size":"{\\"responsive\\":false,\\"width\\":\\"\\",\\"height\\":\\"\\"}","show_friends_face":null,"show_small_header":true,"hide_cover_photo":true,"display":"{\\"type\\":\\"random\\"}"}', '4dd6b779783b928c588e6da6678900f7', '2015-11-02 11:29:54', '2015-11-04 00:03:48'),
(3, 4, 'samundrak', '["http:\\/\\/www.facebook.com\\/ncell"]', 'http://www.google.com', '{"size":"{\\"responsive\\":true}","show_friends_face":true,"show_small_header":true,"hide_cover_photo":true,"display":"{\\"type\\":\\"random\\"}"}', '358430defadbac9717591b95e8eadfc8', '2015-11-04 13:36:05', '2015-11-04 13:36:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gar_password_resets`
--
ALTER TABLE `gar_password_resets`
 ADD KEY `password_resets_email_index` (`email`), ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `gar_plans`
--
ALTER TABLE `gar_plans`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gar_plan_descs`
--
ALTER TABLE `gar_plan_descs`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gar_subscription`
--
ALTER TABLE `gar_subscription`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gar_transaction`
--
ALTER TABLE `gar_transaction`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gar_users`
--
ALTER TABLE `gar_users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `gar_widgets`
--
ALTER TABLE `gar_widgets`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gar_plans`
--
ALTER TABLE `gar_plans`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `gar_plan_descs`
--
ALTER TABLE `gar_plan_descs`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `gar_subscription`
--
ALTER TABLE `gar_subscription`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `gar_transaction`
--
ALTER TABLE `gar_transaction`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gar_users`
--
ALTER TABLE `gar_users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `gar_widgets`
--
ALTER TABLE `gar_widgets`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;