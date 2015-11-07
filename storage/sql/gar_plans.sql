-- phpMyAdmin SQL Dump
-- version 4.2.3deb1.precise~ppa.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 07, 2015 at 04:30 PM
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gar_plans`
--
ALTER TABLE `gar_plans`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gar_plans`
--
ALTER TABLE `gar_plans`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
