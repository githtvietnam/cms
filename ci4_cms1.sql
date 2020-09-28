-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 28, 2020 at 10:30 AM
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
-- Table structure for table `slide`
--

CREATE TABLE `slide` (
  `id` int(11) NOT NULL,
  `catalogueid` int(11) NOT NULL,
  `image` longtext NOT NULL,
  `order` int(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` tinyint(1) NOT NULL,
  `userid_created` int(11) NOT NULL,
  `userid_updated` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `slide`
--

INSERT INTO `slide` (`id`, `catalogueid`, `image`, `order`, `created_at`, `updated_at`, `deleted_at`, `userid_created`, `userid_updated`) VALUES
(673, 313, '/upload/image/language/en.png', 0, '2020-09-27 09:33:15', '0000-00-00 00:00:00', 0, 8, 0),
(674, 313, '/upload/image/language/japan.png', 0, '2020-09-27 09:33:15', '0000-00-00 00:00:00', 0, 8, 0),
(677, 314, '/upload/image/phap-luat/3_zing.jpg', 0, '0000-00-00 00:00:00', '2020-09-28 14:29:24', 0, 0, 8),
(678, 314, '/upload/image/Bong-da/cat-1.jpg', 0, '0000-00-00 00:00:00', '2020-09-28 14:29:24', 0, 0, 8),
(679, 314, '/upload/image/Bong-da/cat-1.jpg', 0, '0000-00-00 00:00:00', '2020-09-28 14:29:24', 0, 0, 8);

-- --------------------------------------------------------

--
-- Table structure for table `slide_catalogue`
--

CREATE TABLE `slide_catalogue` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `keyword` varchar(50) NOT NULL,
  `publish` tinyint(1) NOT NULL,
  `data` longtext NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` tinyint(1) NOT NULL,
  `userid_created` int(11) NOT NULL,
  `userid_updated` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `slide_catalogue`
--

INSERT INTO `slide_catalogue` (`id`, `title`, `keyword`, `publish`, `data`, `created_at`, `updated_at`, `deleted_at`, `userid_created`, `userid_updated`) VALUES
(313, 'cờ', 'co', 1, '[{\"image\":\"\\/upload\\/image\\/language\\/en.png\",\"order\":\"0\",\"title\":\"ch\\u01b0a d\\u1ecbch\",\"url\":\"ch\\u01b0a d\\u1ecbch\",\"description\":\"ch\\u01b0a d\\u1ecbch\",\"content\":\"ch\\u01b0a d\\u1ecbch\"},{\"image\":\"\\/upload\\/image\\/language\\/japan.png\",\"order\":\"0\",\"title\":\"ch\\u01b0a d\\u1ecbch\",\"url\":\"ch\\u01b0a d\\u1ecbch\",\"description\":\"ch\\u01b0a d\\u1ecbch\",\"content\":\"ch\\u01b0a d\\u1ecbch\"}]', '2020-09-27 09:33:15', '0000-00-00 00:00:00', 0, 8, 0),
(314, 'tin tức', 'tin', 1, '[{\"image\":\"\\/upload\\/image\\/phap-luat\\/3_zing.jpg\",\"order\":\"0\",\"title\":\"b\\u00e1n rau\",\"url\":\"b\\u00e1n rau 1\",\"description\":\"b\\u00e1n rau 2\",\"content\":\"b\\u00e1n rau 2 3\"},{\"image\":\"\\/upload\\/image\\/Bong-da\\/cat-1.jpg\",\"order\":\"0\",\"title\":\"b\\u00f3ng \\u0111\\u00e1\",\"url\":\"b\\u00f3ng \\u0111\\u00e1 1\",\"description\":\"b\\u00f3ng \\u0111\\u00e1 2\",\"content\":\"b\\u00f3ng \\u0111\\u00e1 3\"},{\"image\":\"\\/upload\\/image\\/Bong-da\\/cat-1.jpg\",\"order\":\"0\",\"title\":\"\",\"url\":\"\",\"description\":\"\",\"content\":\"\"}]', '2020-09-27 09:41:50', '2020-09-28 14:29:24', 0, 8, 8);

-- --------------------------------------------------------

--
-- Table structure for table `slide_translate`
--

CREATE TABLE `slide_translate` (
  `catalogueid` int(11) NOT NULL,
  `objectid` int(11) NOT NULL,
  `language` varchar(10) NOT NULL,
  `title` varchar(50) NOT NULL,
  `url` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `content` longtext NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` tinyint(1) NOT NULL,
  `userid_created` int(11) NOT NULL,
  `userid_updated` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `slide_translate`
--

INSERT INTO `slide_translate` (`catalogueid`, `objectid`, `language`, `title`, `url`, `description`, `content`, `created_at`, `updated_at`, `deleted_at`, `userid_created`, `userid_updated`) VALUES
(313, 673, 'vi', 'chưa dịch', 'chưa dịch', 'chưa dịch', 'chưa dịch', '2020-09-27 09:33:15', '0000-00-00 00:00:00', 0, 8, 0),
(313, 674, 'vi', 'chưa dịch', 'chưa dịch', 'chưa dịch', 'chưa dịch', '2020-09-27 09:33:15', '0000-00-00 00:00:00', 0, 8, 0),
(313, 673, 'en', 'đã dịch tiếng anh', 'đã dịch tiếng anh', '', '', '0000-00-00 00:00:00', '2020-09-27 09:40:37', 0, 0, 8),
(313, 674, 'en', 'đã dịch tiếng anh', 'đã dịch tiếng anh', '', '', '0000-00-00 00:00:00', '2020-09-27 09:40:37', 0, 0, 8),
(314, 677, 'en', 'ddax dicjh  tiếng anh', 'đã dịch tiếng anh', 'đã dịch tiếng anh', 'đã dịch tiếng anh', '2020-09-28 14:29:01', '0000-00-00 00:00:00', 0, 8, 0),
(314, 677, 'en', 'đã dịch tiếng anh', 'đã dịch tiếng anh', 'đã dịch tiếng anh', 'đã dịch tiếng anh', '2020-09-28 14:29:01', '0000-00-00 00:00:00', 0, 8, 0),
(314, 677, 'vi', 'bán rau', 'bán rau 1', 'bán rau 2', 'bán rau 2 3', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(314, 678, 'vi', 'bóng đá', 'bóng đá 1', 'bóng đá 2', 'bóng đá 3', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(314, 679, 'vi', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `slide`
--
ALTER TABLE `slide`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slide_catalogue`
--
ALTER TABLE `slide_catalogue`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `slide`
--
ALTER TABLE `slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=680;

--
-- AUTO_INCREMENT for table `slide_catalogue`
--
ALTER TABLE `slide_catalogue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=315;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
