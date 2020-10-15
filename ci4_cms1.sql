-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 15, 2020 at 01:28 PM
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
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `fullname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `publish` tinyint(4) NOT NULL,
  `created_at` date NOT NULL,
  `catalogueid` int(11) NOT NULL,
  `deleted_at` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `fullname`, `phone`, `email`, `address`, `title`, `content`, `publish`, `created_at`, `catalogueid`, `deleted_at`) VALUES
(4, 'barac obama', '01234858963', 'obama@gmail.com', 'American', 'During the meeting, Colonel Vinh mentioned that Quang Binh province had invited Major General Man as former Commander of the Military Command of Quang Binh province to attend the provincial patriotic emulation congress on the morning of October 13. .', 'During the meeting, Colonel Vinh mentioned that Quang Binh province had invited Major General Man as former Commander of the Military Command of Quang Binh province to attend the provincial patriotic emulation congress on the morning of October 13. . \"General Man said he went on a mission in there (Thua Thien - Hue), if possible, he would attend the congress with the province\", colonel Vinh recalled. That afternoon, Major General Man was present in Phong Dien district, Thua Thien - Hue, to command the rescue force. On the evening of October 12, he and 20 officers and soldiers crossed the forest into the landslide area at Rao Trang 3 hydropower plant. 67) the hill behind suddenly fell down. 8 lucky people escaped from the house. 13 people were lost under the rocky soil. On the afternoon of October 13, news about Deputy Commander of Military Region 4 Nguyen Van Man and 12 people missing when participating in the rescue of workers in Rao Trang 3 Hydropower was released. Looking at the image of forest ranger station No. 7 completely leveled by the rock, Mr. Vinh exclaimed \"too terrible\". \"The brothers at headquarters still hope, though very fragile, that they will save their comrades as soon as possible. I hope good luck will come,\" the colonel shared.', 1, '2020-10-16', 16, 0),
(5, 'Việt', '01234858963', 'v@gmail.com', 'Việt Nam', 'Vợ chồng tướng Man có 3 người con. Cô con gái cả vừa tốt nghiệp đại học, con gái thứ 2 đang học cấp 3 và con trai út đang học lớp 7. Từ khi nhậm chức Phó tư lệnh Quân khu 4, vị tướng càng ít có thời gian về thăm nhà.', 'Nói về quyết định hành quân ngay trong đêm của thiếu tướng Man và các đồng đội, ông Vĩnh gọi đó là quyết định rất táo bạo và rất vì dân.\r\n\r\n\"Khi nghe thông tin người dân bị nạn như thế mà mình không đi được thì trong lòng rất không yên. Tinh thần của người lính thôi thúc mình phải hành quân ngay, dù là đêm tối. Có lẽ suy nghĩ của anh Man lúc đó cũng như vậy, muốn đến được với người bị nạn càng sớm càng tốt\", đại tá Vĩnh chia sẻ.', 1, '2020-10-14', 17, 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact_catalogue`
--

CREATE TABLE `contact_catalogue` (
  `id` int(11) NOT NULL,
  `publish` tinyint(1) NOT NULL,
  `deleted_at` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `userid_created` int(11) NOT NULL,
  `userid_updated` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_catalogue`
--

INSERT INTO `contact_catalogue` (`id`, `publish`, `deleted_at`, `updated_at`, `userid_created`, `userid_updated`, `created_at`) VALUES
(16, 1, 0, '0000-00-00 00:00:00', 8, 0, '2020-10-15 17:09:03'),
(17, 1, 0, '0000-00-00 00:00:00', 8, 0, '2020-10-15 17:10:02');

-- --------------------------------------------------------

--
-- Table structure for table `contact_translate`
--

CREATE TABLE `contact_translate` (
  `id` int(11) NOT NULL,
  `objectid` int(11) NOT NULL,
  `module` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `language` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` int(11) NOT NULL,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL,
  `userid_updated` int(11) NOT NULL,
  `userid_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_translate`
--

INSERT INTO `contact_translate` (`id`, `objectid`, `module`, `title`, `language`, `deleted_at`, `updated_at`, `created_at`, `userid_updated`, `userid_created`) VALUES
(15, 16, 'contact_catalogue', 'Phòng thông tin và truyền thông', 'vi', 0, '0000-00-00', '2020-10-15', 0, 8),
(16, 17, 'contact_catalogue', 'qqqqqqqqqq', 'vi', 0, '0000-00-00', '2020-10-15', 0, 8);

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

CREATE TABLE `reply` (
  `objectid` int(11) NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `userid_created` int(11) NOT NULL,
  `userid_updated` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reply`
--

INSERT INTO `reply` (`objectid`, `content`, `created_at`, `userid_created`, `userid_updated`, `updated_at`, `deleted_at`) VALUES
(4, '<p>THE WORLD Iran released two Americans after the deal to exchange 200 Uyen Uyen prisoners. Thursday, October 15, 2020 07:38 (GMT + 7) Iran released the two Americans and sent back the bodies of another after reaching agreement to exchange prisoners. Two Americans - once captured by Houthi rebels in Yemen - were released on October 14. The move, according to officials in the US and Saudi Arabia, is part of a prisoner exchange agreement, under which the United States must return more than 200 Houthi followers in exchange for two American prisoners and a body. Hours after the Houthi fighters were released, an Oman Royal Air Force plane departed from the capital Sana’a, Yemen, to return two Americans and the remains to the country.</p>', '2020-10-15 17:17:46', 8, 8, '2020-10-15 17:23:23', 0),
(5, '<p><span style=\"background-color:rgb(255,255,255);color:rgb(51,51,51);\">Hình ảnh một con hổ cái ôm cây linh sam Mãn Châu cổ trong khu rừng xa xôi ở Siberia đã giành được giải thưởng cao nhất và giải thưởng của hạng mục Động vật tại môi trường sống trong cuộc thi nhiếp ảnh của Bảo tàng Lịch sử Tự nhiên London. Những bức ảnh thắng cuộc sẽ được triển lãm tại bảo tàng từ ngày 16/10 đến 6/6/2021. Ảnh: </span><i>Sergey Gorshkov</i><span style=\"background-color:rgb(255,255,255);color:rgb(51,51,51);\">.</span></p>', '2020-10-15 17:18:32', 8, 8, '2020-10-15 17:22:45', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_catalogue`
--
ALTER TABLE `contact_catalogue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_translate`
--
ALTER TABLE `contact_translate`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contact_catalogue`
--
ALTER TABLE `contact_catalogue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `contact_translate`
--
ALTER TABLE `contact_translate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
