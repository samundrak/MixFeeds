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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gar_plan_descs`
--
ALTER TABLE `gar_plan_descs`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gar_plan_descs`
--
ALTER TABLE `gar_plan_descs`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
