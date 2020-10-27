-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 27, 2020 at 10:52 AM
-- Server version: 5.6.47
-- PHP Version: 7.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci4_cms1`
--

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE `color` (
  `id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `language` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `userid_updated` int(11) NOT NULL,
  `userid_created` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` tinyint(4) NOT NULL,
  `publish` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `color`
--

INSERT INTO `color` (`id`, `title`, `language`, `code`, `created_at`, `userid_updated`, `userid_created`, `updated_at`, `deleted_at`, `publish`) VALUES
(39, 'đen', 'vi', '000000', '2020-10-26 16:15:36', 0, 8, '0000-00-00 00:00:00', 0, 1),
(40, '', 'en', '000000', '2020-10-26 16:15:36', 0, 8, '0000-00-00 00:00:00', 0, 1),
(41, '', 'jp', '000000', '2020-10-26 16:15:36', 0, 8, '0000-00-00 00:00:00', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

CREATE TABLE `property` (
  `id` int(11) NOT NULL,
  `parentid` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `userid_created` int(11) NOT NULL,
  `userid_updated` int(11) NOT NULL,
  `deleted_at` tinyint(4) NOT NULL,
  `publish` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`id`, `parentid`, `created_at`, `updated_at`, `userid_created`, `userid_updated`, `deleted_at`, `publish`) VALUES
(6, 9, '2020-10-27 12:41:36', '0000-00-00 00:00:00', 8, 0, 0, 1),
(7, 9, '2020-10-27 12:42:17', '0000-00-00 00:00:00', 8, 0, 0, 1),
(8, 9, '2020-10-27 12:42:45', '2020-10-27 14:35:39', 8, 8, 1, 1),
(9, 11, '2020-10-27 14:25:50', '0000-00-00 00:00:00', 8, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `property_catalogue`
--

CREATE TABLE `property_catalogue` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` int(11) NOT NULL,
  `userid_created` int(11) NOT NULL,
  `userid-updated` int(11) NOT NULL,
  `deleted_at` tinyint(4) NOT NULL,
  `publish` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_catalogue`
--

INSERT INTO `property_catalogue` (`id`, `created_at`, `updated_at`, `userid_created`, `userid-updated`, `deleted_at`, `publish`) VALUES
(9, '2020-10-26 17:13:05', 0, 8, 0, 0, 1),
(10, '2020-10-26 17:14:30', 0, 8, 0, 0, 1),
(11, '2020-10-26 17:15:16', 0, 8, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `property_translate`
--

CREATE TABLE `property_translate` (
  `module` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `objectid` int(11) NOT NULL,
  `language` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_translate`
--

INSERT INTO `property_translate` (`module`, `title`, `value`, `objectid`, `language`) VALUES
('property_catalogue', 'kích thước', '', 9, 'vi'),
('property_catalogue', 'phụ kiện', '', 10, 'vi'),
('property_catalogue', 'ram', '', 11, 'vi'),
('property_catalogue', 'ram', '', 11, 'en'),
('property_catalogue', 'phụ kiện', '', 10, 'en'),
('property', 'Size', 'M', 6, 'vi'),
('property', 'Size', 'S', 7, 'vi'),
('property', 'Size', 'XXL', 8, 'vi'),
('property', 'Ram ', '8gb', 9, 'vi'),
('property', 'Kích thước', '', 7, 'en');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_catalogue`
--
ALTER TABLE `property_catalogue`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `color`
--
ALTER TABLE `color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `property_catalogue`
--
ALTER TABLE `property_catalogue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
