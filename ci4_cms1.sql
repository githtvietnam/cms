-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 25, 2020 at 06:52 AM
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
  `catalogue_id` int(11) NOT NULL,
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

INSERT INTO `slide` (`id`, `catalogue_id`, `image`, `order`, `created_at`, `updated_at`, `deleted_at`, `userid_created`, `userid_updated`) VALUES
(351, 242, '/upload/image/language/japan.png', 0, '0000-00-00 00:00:00', '2020-09-25 10:47:23', 0, 0, 8),
(352, 242, '/upload/image/language/vietnam.jpg', 0, '0000-00-00 00:00:00', '2020-09-25 10:47:23', 0, 0, 8);

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
(242, 'rrrrrrrr', 'rrrrrrrrrrrr', 1, '[{\"image\":\"\\/upload\\/image\\/language\\/japan.png\",\"order\":\"0\",\"title\":\"pppp\",\"url\":\"pppppppp\",\"description\":\"\",\"content\":\"\"},{\"image\":\"\\/upload\\/image\\/language\\/vietnam.jpg\",\"order\":\"0\",\"title\":\"ppppp\",\"url\":\"ppppp\",\"description\":\"\",\"content\":\"\"}]', '2020-09-25 10:31:56', '2020-09-25 10:47:23', 0, 8, 8);

-- --------------------------------------------------------

--
-- Table structure for table `slide_translate`
--

CREATE TABLE `slide_translate` (
  `id` int(11) NOT NULL,
  `object_id` int(11) NOT NULL,
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

INSERT INTO `slide_translate` (`id`, `object_id`, `language`, `title`, `url`, `description`, `content`, `created_at`, `updated_at`, `deleted_at`, `userid_created`, `userid_updated`) VALUES
(305, 328, 'en', 'ssssssssssssss', 'ssssssssss', '', '', '2020-09-25 10:40:35', '0000-00-00 00:00:00', 0, 8, 0),
(306, 329, 'en', 'ssssssssss', 'ssssssss', '', '', '2020-09-25 10:40:35', '0000-00-00 00:00:00', 0, 8, 0),
(307, 330, 'en', 'sssssss', 'ffffffffff', '', '', '2020-09-25 10:40:35', '0000-00-00 00:00:00', 0, 8, 0),
(308, 331, 'en', 'fffffffffffff', '', '', '', '2020-09-25 10:40:35', '0000-00-00 00:00:00', 0, 8, 0),
(309, 328, 'jp', '111111111', '111111', '', '', '2020-09-25 10:41:32', '0000-00-00 00:00:00', 0, 8, 0),
(310, 329, 'jp', '11111', '1111', '', '', '2020-09-25 10:41:32', '0000-00-00 00:00:00', 0, 8, 0),
(311, 330, 'jp', '2222', '111', '', '', '2020-09-25 10:41:32', '0000-00-00 00:00:00', 0, 8, 0),
(312, 331, 'jp', '111', '', '', '', '2020-09-25 10:41:32', '0000-00-00 00:00:00', 0, 8, 0),
(320, 351, 'en', 'aaaaaaaaaa', 'rrrrrrrrrrr', '', '', '2020-09-25 10:46:44', '0000-00-00 00:00:00', 0, 8, 0),
(321, 352, 'en', 'rrrrrrrrrrrr', 'rtgggggggggggg', '', '', '2020-09-25 10:46:44', '0000-00-00 00:00:00', 0, 8, 0),
(322, 351, 'vi', 'pppp', 'pppppppp', '', '', '0000-00-00 00:00:00', '2020-09-25 10:47:23', 0, 0, 8),
(323, 352, 'vi', 'ppppp', 'ppppp', '', '', '0000-00-00 00:00:00', '2020-09-25 10:47:23', 0, 0, 8);

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
-- Indexes for table `slide_translate`
--
ALTER TABLE `slide_translate`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `slide`
--
ALTER TABLE `slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=353;

--
-- AUTO_INCREMENT for table `slide_catalogue`
--
ALTER TABLE `slide_catalogue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;

--
-- AUTO_INCREMENT for table `slide_translate`
--
ALTER TABLE `slide_translate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=324;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
