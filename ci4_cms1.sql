-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 18, 2020 at 10:30 AM
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
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `catalogueid` int(11) NOT NULL,
  `catalogue` longtext NOT NULL,
  `album` longtext NOT NULL,
  `viewed` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `order` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` tinyint(1) NOT NULL,
  `publish` tinyint(1) NOT NULL,
  `userid_created` int(11) NOT NULL,
  `userid_updated` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `catalogueid`, `catalogue`, `album`, `viewed`, `image`, `order`, `created_at`, `updated_at`, `deleted_at`, `publish`, `userid_created`, `userid_updated`) VALUES
(2, 2, 'null', 'null', 0, '/upload/image/Bong-da/bong-da-trong-nuoc/qh-1598246997-21-width660height492.jpg', 0, '2020-08-24 16:13:47', '0000-00-00 00:00:00', 0, 1, 8, 0);

-- --------------------------------------------------------

--
-- Table structure for table `article_catalogue`
--

CREATE TABLE `article_catalogue` (
  `id` int(11) NOT NULL,
  `parentid` int(11) NOT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `album` longtext NOT NULL,
  `viewed` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `order` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` tinyint(1) NOT NULL,
  `publish` tinyint(1) NOT NULL,
  `userid_created` int(11) NOT NULL,
  `userid_updated` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `article_catalogue`
--

INSERT INTO `article_catalogue` (`id`, `parentid`, `lft`, `rgt`, `level`, `album`, `viewed`, `image`, `order`, `created_at`, `updated_at`, `deleted_at`, `publish`, `userid_created`, `userid_updated`) VALUES
(1, 0, 4, 7, 1, '[\"\\/upload\\/image\\/Bong-da\\/bong-da-trong-nuoc\\/hagl_cong_phuong_5_zing.jpg\"]', 0, '/upload/image/Bong-da/cat-1.jpg', 0, '2020-08-24 14:54:12', '0000-00-00 00:00:00', 0, 1, 8, 0),
(2, 1, 5, 6, 2, 'null', 0, '', 0, '2020-08-24 14:55:18', '0000-00-00 00:00:00', 0, 1, 8, 0),
(4, 0, 2, 3, 1, 'null', 0, '', 0, '2020-08-24 15:02:51', '0000-00-00 00:00:00', 0, 1, 8, 0);

-- --------------------------------------------------------

--
-- Table structure for table `article_translate`
--

CREATE TABLE `article_translate` (
  `id` int(11) NOT NULL,
  `objectid` int(11) NOT NULL,
  `language` longtext NOT NULL,
  `module` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `canonical` varchar(255) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` longtext NOT NULL,
  `viewed` int(11) NOT NULL,
  `description` text NOT NULL,
  `content` longtext NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` tinyint(1) NOT NULL,
  `userid_created` int(11) NOT NULL,
  `userid_updated` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `article_translate`
--

INSERT INTO `article_translate` (`id`, `objectid`, `language`, `module`, `title`, `canonical`, `meta_title`, `meta_description`, `viewed`, `description`, `content`, `created_at`, `updated_at`, `deleted_at`, `userid_created`, `userid_updated`) VALUES
(1, 1, 'vi', 'article_catalogue', 'Bóng Đá', 'bong-da', 'Bóng đá 24h - Tin tức, lịch thi đấu bxh tin bóng đá thể thao', 'Bong da 24H - Trực tiếp bóng đá 24h Hôm Nay. Tin tức bóng đá số 24/7 mới nhất. Tin Nhanh Kết quả, lịch thi đấu, video trực tuyến tin chuyển nhượng.', 0, 'PHA+PHNwYW4gc3R5bGU9ImJhY2tncm91bmQtY29sb3I6cmdiKDI1NSwyNTUsMjU1KTtjb2xvcjpyZ2IoNzcsODEsODYpOyI+Qm9uZyBkYSAyNEggLSBUcuG7sWMgdGnhur9wIDwvc3Bhbj48aT48c3Ryb25nPmLDs25nIMSRw6E8L3N0cm9uZz48L2k+PHNwYW4gc3R5bGU9ImJhY2tncm91bmQtY29sb3I6cmdiKDI1NSwyNTUsMjU1KTtjb2xvcjpyZ2IoNzcsODEsODYpOyI+IDI0aCBIw7RtIE5heS4gVGluIHThu6ljIDwvc3Bhbj48aT48c3Ryb25nPmLDs25nIMSRw6E8L3N0cm9uZz48L2k+PHNwYW4gc3R5bGU9ImJhY2tncm91bmQtY29sb3I6cmdiKDI1NSwyNTUsMjU1KTtjb2xvcjpyZ2IoNzcsODEsODYpOyI+IHPhu5EgMjQvNyBt4bubaSBuaOG6pXQuIFRpbiBOaGFuaCBL4bq/dCBxdeG6oywgbOG7i2NoIHRoaSDEkeG6pXUsIHZpZGVvIHRy4buxYyB0dXnhur9uIHRpbiBjaHV54buDbiBuaMaw4bujbmcuPC9zcGFuPjwvcD4=', 'PHAgc3R5bGU9Im1hcmdpbi1sZWZ0OmF1dG87dGV4dC1hbGlnbjpqdXN0aWZ5OyI+PHN0cm9uZz5WYWkgdHLDsiBt4budIG5o4bqhdDwvc3Ryb25nPjwvcD48cCBzdHlsZT0ibWFyZ2luLWxlZnQ6YXV0bzsiPiZuYnNwOzwvcD48cCBzdHlsZT0ibWFyZ2luLWxlZnQ6YXV0bzt0ZXh0LWFsaWduOmp1c3RpZnk7Ij5TYXUgdGnhur9uZyBjw7JpIG3Do24gY3Xhu5ljIGPhu6dhIHRy4buNbmcgdMOgaSBEYW5pZWxlIE9yc2F0bywgTmV5bWFyIMO0bSBt4bq3dCBraMOzYy4gQW5oIMSRxrDhu6NjIMSR4buTbmcgxJHhu5lpIHbDoCDEkeG7kWkgdGjhu6cgxJHhur9uIGFuIOG7p2kuIFNhdSDEkcOzLCBj4bqndSB0aOG7pyDEkeG6r3QgZ2nDoSBuaOG6pXQgdGjhur8gZ2nhu5tpIHJhIGtodSBr4bu5IHRodeG6rXQsIG5n4buTaSB4deG7kW5nIGdo4bq/IHbDoCDDtG0gbeG6t3Qga2jDs2MgdGnhur9wLiBHacOhbSDEkeG7kWMgVGjhu4MgdGhhbyBj4bunYSBQU0cgTGVvbmFyZG8gcGjhuqNpIHJhIMSR4buZbmcgdmnDqm4gTmV5bWFyIMSR4buDIHRodXnhur90IHBo4bulYyBhbmggdsOgbyBzw6JuIGNodeG6qW4gYuG7iyBjaG8gbOG7hSBuaOG6rW4gaHV5IGNoxrDGoW5nLjwvcD48cCBzdHlsZT0ibWFyZ2luLWxlZnQ6YXV0bzsiPiZuYnNwOzwvcD48ZmlndXJlIGNsYXNzPSJpbWFnZSBpbWFnZV9yZXNpemVkIiBzdHlsZT0id2lkdGg6MTUxOS4ycHg7Ij48aW1nIHNyYz0iaHR0cHM6Ly9jZG4uMjRoLmNvbS52bi91cGxvYWQvMy0yMDIwL2ltYWdlcy8yMDIwLTA4LTI0L3R0dHV1LTE1OTgyNDA3NTktMTgwLXdpZHRoNjQwaGVpZ2h0Nzc2LmpwZyIgYWx0PSImYW1wOyMzNDvEkHXhu5VpJmFtcDsjMzQ7IE5leW1hciB54bq/dSBiw7NuZyB2w61hLCBQU0cgY8OzIHbDtCDEkeG7i2NoIENoYW1waW9ucyBMZWFndWU/IC0gMiI+PC9maWd1cmU+PGZpZ3VyZSBjbGFzcz0iaW1hZ2UgaW1hZ2VfcmVzaXplZCIgc3R5bGU9IndpZHRoOjc1My41MTNweDsiPjxpbWcgc3JjPSJodHRwczovL2Nkbi4yNGguY29tLnZuL3VwbG9hZC8zLTIwMjAvaW1hZ2VzLzIwMjAtMDgtMjQvMjAyMDA4MjMtdC0yMDE1Mzctei0xNTA1MTc4NjgtcmMtMi13amktOS15LTktb2R2cnRybWFkcC0zLXNvY2NlcmNoYW1waW9uc2JheXBzZ3JlcG9ydC0xNTk4MjI0ODg3MzY1LTE1OTgyNDA3NTktNzc5LXdpZHRoNjQwaGVpZ2h0NDIwLmpwZyIgYWx0PSImYW1wOyMzNDvEkHXhu5VpJmFtcDsjMzQ7IE5leW1hciB54bq/dSBiw7NuZyB2w61hLCBQU0cgY8OzIHbDtCDEkeG7i2NoIENoYW1waW9ucyBMZWFndWU/IC0gMyI+PC9maWd1cmU+PGZpZ3VyZSBjbGFzcz0iaW1hZ2UgaW1hZ2VfcmVzaXplZCIgc3R5bGU9IndpZHRoOjc1My41MTNweDsiPjxpbWcgc3JjPSJodHRwczovL2Nkbi4yNGguY29tLnZuL3VwbG9hZC8zLTIwMjAvaW1hZ2VzLzIwMjAtMDgtMjQvdHR0LTE1OTgyNDA3NTktNzYxLXdpZHRoNjQwaGVpZ2h0NDIwLmpwZyIgYWx0PSImYW1wOyMzNDvEkHXhu5VpJmFtcDsjMzQ7IE5leW1hciB54bq/dSBiw7NuZyB2w61hLCBQU0cgY8OzIHbDtCDEkeG7i2NoIENoYW1waW9ucyBMZWFndWU/IC0gNCI+PC9maWd1cmU+PHAgc3R5bGU9Im1hcmdpbi1sZWZ0OmF1dG87Ij4mbmJzcDs8L3A+PHAgc3R5bGU9Im1hcmdpbi1sZWZ0OmF1dG87dGV4dC1hbGlnbjpqdXN0aWZ5OyI+VHLDqm4gxJHGsOG7nW5nIGzDqm4gYuG7pWMgdHJhbyBnaeG6o2ksIE5leW1hciDEkWkga2jDtG5nIHbhu69uZyBy4buTaSBsacOqbiB04bulYyBn4bulYyDEkeG6p3UgdsOgbyB2YWkgdsOgIG5n4buxYyBj4bunYSBMZWFuZHJvIFBhcmVkZXMuIE5nw7RpIHNhbyBuZ8aw4budaSBCcmF6aWwgY8WpbmcgxJHGsOG7o2MgxJHDrWNoIHRow6JuIGNo4bunIHThu4tjaCBQU0cgTmFzc2VyIEFsIEtoZWxhaWZpIMO0bSB2w6AgbsOzaSBjaHV54buHbi4gVHLGsOG7m2Mga2hpIGLGsOG7m2MgcXVhIGNoaeG6v2MgY8O6cCBDaGFtcGlvbnMgTGVhZ3VlLCBOZXltYXIgxJHGsGEgdGF5IGNo4bqhbSB2w6BvIGRhbmggaGnhu4d1IHF1w70gZ2nDoSBtw6AgYW5oIHThu6tuZyBnacOgbmggxJHGsOG7o2MgaOG7k2kgMjAxNS48L3A+PHAgc3R5bGU9Im1hcmdpbi1sZWZ0OmF1dG87dGV4dC1hbGlnbjpqdXN0aWZ5OyI+Tmhp4buBdSBDxJBWIHBow6F0IGJp4buDdSB0csOqbiBUd2l0dGVyIHLhurFuZyBjw7MgduG6uyBuaMawIE5leW1hciBtdeG7kW4g4oCcZGnhu4Vu4oCdIHRyxrDhu5tjIG3DoXkgcXVheSBi4bqxbmcgbmjhu69uZyBtw6BuIHRo4buVbiB0aOG7qWMsIGjGoW4gbMOgIGtow6F0IGtoYW8gZ2nDoG5oIGRhbmggaGnhu4d1LiBUcsOqbiBzw6JuLCBOZXltYXIgxJHGsMahbmcgbmhpw6puIGPFqW5nIGzDoCBj4bqndSB0aOG7pyBjaMSDbSDigJxkaeG7hW7igJ0gbmjhuqV0IGPhu6dhIFBTRy4gTmfDtGkgc2FvIG5nxrDhu51pIEJyYXppbCB0aOG7gyBoaeG7h24gxJHGsOG7o2Mgc+G7sSBuxINuZyBu4buVLCBuaMawbmcgaGnhu4d1IHF14bqjIMSR4bqxbmcgc2F1IMSRw7MgbMOgIHRo4bupIHbDtCBjw7luZyBtw7RuZyBsdW5nLjwvcD48cCBzdHlsZT0ibWFyZ2luLWxlZnQ6YXV0bzsiPiZuYnNwOzwvcD48ZmlndXJlIGNsYXNzPSJpbWFnZSBpbWFnZV9yZXNpemVkIiBzdHlsZT0id2lkdGg6MTUxOS4ycHg7Ij48aW1nIHNyYz0iaHR0cHM6Ly9jZG4uMjRoLmNvbS52bi91cGxvYWQvMy0yMDIwL2ltYWdlcy8yMDIwLTA4LTI0L2RkLTE1OTgyNDE2NTYtOTItd2lkdGgxNjAwaGVpZ2h0MTA2Ny5qcGciIGFsdD0iJmFtcDsjMzQ7xJB14buVaSZhbXA7IzM0OyBOZXltYXIgeeG6v3UgYsOzbmcgdsOtYSwgUFNHIGPDsyB2w7QgxJHhu4tjaCBDaGFtcGlvbnMgTGVhZ3VlPyAtIDUiPjwvZmlndXJlPjxwIHN0eWxlPSJtYXJnaW4tbGVmdDphdXRvO3RleHQtYWxpZ246anVzdGlmeTsiPkFuaCBsw6AgbmfGsOG7nWkgZGkgY2h1eeG7g24gbmhp4buBdSB0aOG7qSBoYWkgY+G7p2EgUFNHIOG7nyB0cuG6rW4gbsOgeSAoOSwxMSBrbSksIGNo4buJIHNhdSBNYXJxdWluaG9zICg5LDcxIGttKSwgdHJvbmcgxJHDsyDEkWEgcGjhuqduIGzDoCBjw6FjIHTDrG5oIGh14buRbmcgcsOqIGThuq90LiBBbmggY8OzIG3hu5l0IHBoYSBixINuZyB4deG7kW5nIG5o4bqtbiDEkcaw4budbmcgY2jhu41jIGtoZSBj4bunYSBLeWxpYW4gTWJhcHBlIG5oxrBuZyBs4bqhaSBraMO0bmcgdGjhuq9uZyDEkcaw4bujYyBNYW51ZWwgTmV1ZXIg4bufIHTDrG5oIGh14buRbmcgxJHhu5FpIG3hurd0LiBOZ2/DoGkgbmjhu69uZyB0aOG7qSDEkcOzIHJhLCBhbmgga2jDtG5nIHR1bmcgxJHGsOG7o2MgxJHGsOG7nW5nIGNodXnhu4FuIG7DoG8gY2hvIMSR4buTbmcgxJHhu5lpIGThu6l0IMSRaeG7g20uIFBoYSB04bqhdCBiw7NuZyBj4bunYSBhbmgg4bufIHBow7p0IMSRw6EgYsO5IGhp4buHcCBoYWkgdGh14bqtbiBs4bujaSwgbmjGsG5nIHRp4buBbiDEkeG6oW8gRXJpYyBDaG91cG8tTW90aW5nIGzhuqFpIHPDunQgaOG7pXQuPC9wPjxwIHN0eWxlPSJtYXJnaW4tbGVmdDphdXRvO3RleHQtYWxpZ246anVzdGlmeTsiPk5leW1hciB04burbmcgdOG7j2Egc8OhbmcgcuG7sWMgcuG7oSB0cm9uZyBjaGnhur9uIHRo4bqvbmcgbmdo4bq5dCB0aOG7nyAyLTEgY+G7p2EgUFNHIHRyxrDhu5tjIEF0YWxhbnRhIOG7nyB04bupIGvhur90IHbhu5tpIG3hu5l0IHBoYSBraeG6v24gdOG6oW8gdsOgIG3hu5l0IHBoYSBwaMOhdCDEkeG7mW5nIHThuqVuIGPDtG5nIHR1eeG7h3QgaOG6o28uIE5o4buvbmcgdMaw4bufbmcgxJHhuqV5IHPhur0gbMOgIHRp4buBbiDEkeG7gSBnacO6cCBOZXltYXIgdsOgIFBTRyBsw6puIMSR4buJbmggdmluaCBxdWFuZyDhu58gQ2hhbXBpb25zIExlYWd1ZSBtw7lhIG7DoHksIG5oxrBuZyBy4buTaSBt4buNaSB0aOG7qSBjxaluZyBjaOG7iSBsw6AgcGjDuSBkdSBraGkgTmV5bWFyIHBo4bqjaSDEkeG7kWkgbeG6t3QgduG7m2kgbeG7mXQgxJHhu5FpIHRo4bunIHF1w6EgZ2nDoCBkxqEuPC9wPjxwIHN0eWxlPSJtYXJnaW4tbGVmdDphdXRvOyI+Jm5ic3A7PC9wPjxmaWd1cmUgY2xhc3M9ImltYWdlIGltYWdlX3Jlc2l6ZWQiIHN0eWxlPSJ3aWR0aDo3NTUuNnB4OyI+PGltZyBzcmM9Imh0dHBzOi8vY2RuLjI0aC5jb20udm4vdXBsb2FkLzMtMjAyMC9pbWFnZXMvMjAyMC0wOC0yNC9kd3ctMTU5ODI0MjUyOC02MTYtd2lkdGg3OTVoZWlnaHQ0NDYuanBnIiBhbHQ9IiZhbXA7IzM0O8SQdeG7lWkmYW1wOyMzNDsgTmV5bWFyIHnhur91IGLDs25nIHbDrWEsIFBTRyBjw7MgdsO0IMSR4buLY2ggQ2hhbXBpb25zIExlYWd1ZT8gLSA2Ij48L2ZpZ3VyZT48ZmlndXJlIGNsYXNzPSJpbWFnZSBpbWFnZV9yZXNpemVkIiBzdHlsZT0id2lkdGg6NzU1LjZweDsiPjxpbWcgc3JjPSJodHRwczovL2Nkbi4yNGguY29tLnZuL3VwbG9hZC8zLTIwMjAvaW1hZ2VzLzIwMjAtMDgtMjQvcnJyLTE1OTgyNDI1MjgtOTgtd2lkdGg3OTVoZWlnaHQ0NDYuanBnIiBhbHQ9IiZhbXA7IzM0O8SQdeG7lWkmYW1wOyMzNDsgTmV5bWFyIHnhur91IGLDs25nIHbDrWEsIFBTRyBjw7MgdsO0IMSR4buLY2ggQ2hhbXBpb25zIExlYWd1ZT8gLSA3Ij48L2ZpZ3VyZT48cCBzdHlsZT0ibWFyZ2luLWxlZnQ6YXV0bzt0ZXh0LWFsaWduOmp1c3RpZnk7Ij48c3Ryb25nPlTDrG0gxJHDonUgc+G7sSBraMOhYyBiaeG7h3Q/PC9zdHJvbmc+PC9wPjxwIHN0eWxlPSJtYXJnaW4tbGVmdDphdXRvOyI+Jm5ic3A7PC9wPjxmaWd1cmUgY2xhc3M9ImltYWdlIGltYWdlX3Jlc2l6ZWQiIHN0eWxlPSJ3aWR0aDo4MDMuMnB4OyI+PGltZyBzcmM9Imh0dHBzOi8vY2RuLjI0aC5jb20udm4vdXBsb2FkLzMtMjAyMC9pbWFnZXMvMjAyMC0wOC0yNC9ycnJ0dC0xNTk4MjQzMTcyLTEzNi13aWR0aDUwMGhlaWdodDgyMi5qcGciIGFsdD0iJmFtcDsjMzQ7xJB14buVaSZhbXA7IzM0OyBOZXltYXIgeeG6v3UgYsOzbmcgdsOtYSwgUFNHIGPDsyB2w7QgxJHhu4tjaCBDaGFtcGlvbnMgTGVhZ3VlPyAtIDgiPjwvZmlndXJlPjxwIHN0eWxlPSJtYXJnaW4tbGVmdDphdXRvO3RleHQtYWxpZ246anVzdGlmeTsiPkzDoCDEkeG6s25nIGPhuqVwIGPhu6dhIE5leW1hciBjaMawYSDEkeG7pyDEkeG7gyBj4bupdSB24bubdCBQU0cgdHLGsOG7m2Mgbmjhu69uZyDEkeG7kWkgdGjhu6cgbeG6oW5oIG5o4bqldCwg4bufIG5o4buvbmcgdMOsbmggdGjhur8ga2jhu5FuIMSR4buRbiBuaOG6pXQsIGhheSBCYXllcm4gcXXDoSBoYXk/IFbhu5tpIDYgdMOsbmggaHXhu5FuZyBi4buLIHBo4bqhbSBs4buXaSB0csaw4bubYyBCYXllcm4sIE5leW1hciDEkcOjIGLhu4sgcGjhuqFtIGzhu5dpIHThu5VuZyBj4buZbmcgMjIgbOG6p24gdMOtbmggYuG6r3QgxJHhuqd1IHThu6sgbG/huqF0IHThu6kga+G6v3QgQ2hhbXBpb25zIExlYWd1ZSAyMDE5LzIwIGfhurdwIEF0YWxhbnRhLCB2w6AgbMOgIGPhuqd1IHRo4bunIGLhu4sgcGjhuqFtIGzhu5dpIG5oaeG7gXUgbmjhuqV0IHThuqFpIGdp4bqjaSB0cm9uZyBj4bqjIG3DuWEgduG7q2Ega+G6v3QgdGjDumMuPC9wPjxwIHN0eWxlPSJtYXJnaW4tbGVmdDphdXRvO3RleHQtYWxpZ246anVzdGlmeTsiPlThuqV0IG5oacOqbiwgY8OzIGzhu61hIHBo4bqjaSBjw7Mga2jDs2kuIE5leW1hciBjw7MgaGFtIMSRaSBiw7NuZywgaGFtIHLDqiBk4bqvdCB2w6AgaGFtIGJp4buDdSBkaeG7hW4gdGjDrCBt4bubaSBraGnhur9uIMSR4buRaSB0aOG7pyB0cnV5IGPhuqNuLiBUaOG6vyBuaMawbmcgbmfDtGkgc2FvIG5nxrDhu51pIEJyYXppbCBs4bqhaSBraMO0bmcgdOG6rW4gZOG7pW5nIMSRxrDhu6NjIG5o4buvbmcgbsOpdCB0aW5oIHJhbmggdHJvbmcgY8OhY2ggY2jGoWkgY+G7p2EgbcOsbmggdsOgbyB0w6JtIGzDvSB0aGkgxJHhuqV1LiDEkOG7kWkgdGjhu6cgY8OgbmcgcGjhuqFtIGzhu5dpLCBOZXltYXIgbOG6oWkgY8OgbmcgxJFpIGLDs25nLCB2w6AgxJFpIGLDs25nIG5nw6B5IG3hu5l0IOKAnHThu5Fp4oCdIGjGoW4uPC9wPjxwIHN0eWxlPSJtYXJnaW4tbGVmdDphdXRvO3RleHQtYWxpZ246anVzdGlmeTsiPkLhuqNuIGzEqW5oIOG7nyBuaOG7r25nIHRy4bqtbiDEkeG6pXUgbOG7m24gbMOgIMSRaeG7gXUgbcOgIE5leW1hciBz4bq9IGPDsm4gcGjhuqNpIGjhu41jIGjhu49pIHLhuqV0IG5oaeG7gXUuIEh1eeG7gW4gdGhv4bqhaSBSdXVkIEd1bGxpdCDEkcOjIGJ1w7RuZyBs4budaSBraGVuIG5n4bujaSBTZXJnZSBHbmFicnkgdsOsIHPhu7Eg4oCcaGnhur91IGNoaeG6v27igJ0gc2F1IHTDrG5oIGh14buRbmcgc8O6dCB2w6BvIGNow6JuIE5leW1hciBraGkgdHJ1eSBj4bqjbiBj4bqndSB0aOG7pyBuw6B5IOG7nyDEkcaw4budbmcgYmnDqm4sIGRp4buFbiByYSB0cm9uZyBoaeG7h3AgMiB0cuG6rW4gxJHhuqV1LiDDlG5nIGNobyBy4bqxbmcgxJHDonkgbMOgIOKAnGtob+G6o25oIGto4bqvYyB0aGVuIGNo4buRdOKAnSBtYW5nIHbhu4EgdGjhuq9uZyBs4bujaSBjaG8gQmF5ZXJuLiBT4buxIGzhuqFuaCBsw7luZywgbOG6p20gbOG7syBj4bunYSBuZ8aw4budaSDEkOG7qWMgxJHDoyBjaGnhur9uIHRo4bqvbmcgbeG7mXQgTmV5bWFyIHF1w6EgbmjhuqF5IGPhuqNtLjwvcD48cCBzdHlsZT0ibWFyZ2luLWxlZnQ6YXV0bzsiPiZuYnNwOzwvcD48ZmlndXJlIGNsYXNzPSJpbWFnZSBpbWFnZV9yZXNpemVkIiBzdHlsZT0id2lkdGg6MTUxOS4ycHg7Ij48aW1nIHNyYz0iaHR0cHM6Ly9jZG4uMjRoLmNvbS52bi91cGxvYWQvMy0yMDIwL2ltYWdlcy8yMDIwLTA4LTI0L3R0Z2ctMTU5ODI0MzM5NC03NTctd2lkdGgxNjAwaGVpZ2h0OTAwLmpwZyIgYWx0PSImYW1wOyMzNDvEkHXhu5VpJmFtcDsjMzQ7IE5leW1hciB54bq/dSBiw7NuZyB2w61hLCBQU0cgY8OzIHbDtCDEkeG7i2NoIENoYW1waW9ucyBMZWFndWU/IC0gOSI+PC9maWd1cmU+PHAgc3R5bGU9Im1hcmdpbi1sZWZ0OmF1dG87dGV4dC1hbGlnbjpqdXN0aWZ5OyI+S2hpIG3DoCBOZXltYXIg4oCcaOG6v3QgcGjDqXDigJ0sIHThuq1wIHRo4buDIFBTRyBjxaluZyBuaMawIGNo4buLdSDigJxoaeG7h3Ug4bupbmcgZG9taW5v4oCdLCBraGkgbmjhu69uZyBuZ8O0aSBzYW8gc8OhbmcgbmjhuqV0IGPhu6dhIGjhu40gbMOgIE1iYXBwZSB2w6AgQW5nZWwgZGkgTWFyaWEgY8Wpbmcga2jDtG5nIHRo4buDIGhp4buHbiDEkcaw4bujYyBz4buxIHPhuq9jIHPhuqNvIG5nb8OgaSBt4buZdCB2w6BpIHTDrG5oIGh14buRbmcgxJHGoW4gbOG6uy4gTWJhcHBlIGfDonkgdGjhuqV0IHbhu41uZyDhu58ga2jhuqMgbsSDbmcgZOG7qXQgxJFp4buDbSwgdHJvbmcga2hpIMSRaeG7g20gc8OhbmcgY+G7p2EgRGkgTWFyaWEgY2jhu4kgbMOgIHTDrG5oIGh14buRbmcg4oCceMOidSBraW3igJ0gQWxwaG9uc28gRGF2aWVzLjwvcD48cCBzdHlsZT0ibWFyZ2luLWxlZnQ6YXV0bzt0ZXh0LWFsaWduOmp1c3RpZnk7Ij5ITFYgVGhvbWFzIFR1Y2hlbCDEkcOjIG5o4bqvYyDEkeG6v24gTGlvbmVsIE1lc3NpIHNhdSB0cuG6rW4gxJHhuqV1IHRyb25nIG3hu5l0IGPDonUgbsOzaSDEkcO5YSB04bq/dSB0w6FvIHbhu4Egdmnhu4djIFBTRyBjw7MgdGjhu4MgbXVhIHNpw6p1IHNhbyBuw6B5LiBOaMawbmcgbmfGsOG7nWkgUFNHIGPhuqduIHBo4bqjaSBuaMOsbiBuaOG6rW4gbeG7mXQgdGjhu7FjIHThur8gcuG6sW5nIHPhur0gcuG6pXQga2jDsyDEkeG7gyBOZXltYXIsIHbhu5tpIGPDoSB0w61uaCB2w6AgdGjDs2kgcXVlbiBj4bunYSBtw6xuaCwgY8OzIHRo4buDIHbGsMahbiB04bqnbSDEkeG7gyB0cuG7nyB0aMOgbmggbeG7mXQgdGjhu6cgbMSpbmggdGjhu7FjIHPhu7EsIGPhuqMgduG7gSBjaHV5w6puIG3DtG4gbOG6q24gdGluaCB0aOG6p24uIEFuaCBjw7MgdGjhu4MgY2jhu4kgxJHhuqF0IMSRxrDhu6NjIHPhu7EgdGjEg25nIGhvYSwga2hpIGNoxqFpIGPDuW5nIG5o4buvbmcgY29uIG5nxrDhu51pIG5oxrAgduG6rXkgbcOgIHRow7RpLjwvcD48cCBzdHlsZT0ibWFyZ2luLWxlZnQ6YXV0bzsiPiZuYnNwOzwvcD4=', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(2, 2, 'vi', 'article_catalogue', 'Bóng Đá Trong Nước', 'bong-da-trong-nuoc', '', '', 0, 'PHA+QsOzbmcgxJDDoSBUcm9uZyBOxrDhu5tjPC9wPg==', 'PHA+QsOzbmcgxJDDoSBUcm9uZyBOxrDhu5tjPC9wPg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(4, 4, 'vi', 'article_catalogue', 'Pháp Luật', 'phap-luat', '', '', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(5, 1, 'en', 'article_catalogue', 'Football 123', 'football-123', 'The more the opponent made the mistake, the more Neymar ', 'Football 24H - Live Football 24h Today. Latest digital football news 24/7. Quick News Results, fixtures, video streaming news transfers.', 0, 'PHA+Rm9vdGJhbGwgMjRIIC0gTGl2ZSBmb290YmFsbCAyNGggdG9kYXkuIExhdGVzdCBkaWdpdGFsIGZvb3RiYWxsIG5ld3MgMjQvNy4gRmFzdCBOZXdzIFJlc3VsdHMsIGZpeHR1cmVzLCBvbmxpbmUgdmlkZW8gdHJhbnNmZXJzLjwvcD4=', 'PHAgc3R5bGU9Im1hcmdpbi1sZWZ0OmF1dG87dGV4dC1hbGlnbjpqdXN0aWZ5OyI+UG9vciByb2xlIEFmdGVyIHRoZSBmaW5hbCB3aGlzdGxlIG9mIHJlZmVyZWUgRGFuaWVsZSBPcnNhdG8sIE5leW1hciBjcmllZC4gSGUgd2FzIGNvbWZvcnRlZCBieSBoaXMgdGVhbW1hdGVzIGFuZCBvcHBvbmVudHMuIEFmdGVyIHRoYXQsIHRoZSBtb3N0IGV4cGVuc2l2ZSBwbGF5ZXIgaW4gdGhlIHdvcmxkIHdlbnQgdG8gdGhlIHRlY2huaWNhbCB6b25lLCBzYXQgZG93biBvbiB0aGUgY2hhaXIgYW5kIGNvbnRpbnVlZCBjcnlpbmcuIFBTRydzIFNwb3J0cyBEaXJlY3RvciBMZW9uYXJkbyBoYWQgdG8gZW5jb3VyYWdlIE5leW1hciB0byBwZXJzdWFkZSBoaW0gdG8gY29tZSBvbiB0aGUgcGl0Y2ggdG8gcHJlcGFyZSBmb3IgdGhlIG1lZGFsIGNlcmVtb255LjwvcD48cCBzdHlsZT0ibWFyZ2luLWxlZnQ6YXV0bzsiPiZuYnNwOzwvcD48ZmlndXJlIGNsYXNzPSJpbWFnZSBpbWFnZV9yZXNpemVkIiBzdHlsZT0id2lkdGg6MTUxOS4ycHg7Ij48aW1nIHNyYz0iaHR0cHM6Ly9jZG4uMjRoLmNvbS52bi91cGxvYWQvMy0yMDIwL2ltYWdlcy8yMDIwLTA4LTI0L3R0dHV1LTE1OTgyNDA3NTktMTgwLXdpZHRoNjQwaGVpZ2h0Nzc2LmpwZyIgYWx0PSIiPjwvZmlndXJlPjxmaWd1cmUgY2xhc3M9ImltYWdlIGltYWdlX3Jlc2l6ZWQiIHN0eWxlPSJ3aWR0aDo3NTMuNTEzcHg7Ij48aW1nIHNyYz0iaHR0cHM6Ly9jZG4uMjRoLmNvbS52bi91cGxvYWQvMy0yMDIwL2ltYWdlcy8yMDIwLTA4LTI0LzIwMjAwODIzLXQtMjAxNTM3LXotMTUwNTE3ODY4LXJjLTItd2ppLTkteS05LW9kdnJ0cm1hZHAtMy1zb2NjZXJjaGFtcGlvbnNiYXlwc2dyZXBvcnQtMTU5ODIyNDg4NzM2NS0xNTk4MjQwNzU5LTc3OS13aWR0aDY0MGhlaWdodDQyMC5qcGciIGFsdD0iIj48L2ZpZ3VyZT48ZmlndXJlIGNsYXNzPSJpbWFnZSBpbWFnZV9yZXNpemVkIiBzdHlsZT0id2lkdGg6NzUzLjUxM3B4OyI+PGltZyBzcmM9Imh0dHBzOi8vY2RuLjI0aC5jb20udm4vdXBsb2FkLzMtMjAyMC9pbWFnZXMvMjAyMC0wOC0yNC90dHQtMTU5ODI0MDc1OS03NjEtd2lkdGg2NDBoZWlnaHQ0MjAuanBnIiBhbHQ9IiI+PC9maWd1cmU+PHAgc3R5bGU9Im1hcmdpbi1sZWZ0OmF1dG87Ij4mbmJzcDs8L3A+PHAgc3R5bGU9Im1hcmdpbi1sZWZ0OmF1dG87dGV4dC1hbGlnbjpqdXN0aWZ5OyI+T24gdGhlIHdheSB1cCB0byB0aGUgcG9kaXVtLCBOZXltYXIgd2FzIHVuc3RlYWR5IGFuZCB0aGVuIHJlcGVhdGVkbHkgZHJvcHBlZCBoaXMgaGVhZCBvbiBMZWFuZHJvIFBhcmVkZXMncyBzaG91bGRlciBhbmQgY2hlc3QuIFRoZSBCcmF6aWxpYW4gc3RhciB3YXMgYWxzbyBodWdnZWQgYW5kIHRhbGtlZCBieSBQU0cgcHJlc2lkZW50IE5hc3NlciBBbCBLaGVsYWlmaSBwZXJzb25hbGx5LiBCZWZvcmUgc3RlcHBpbmcgdGhyb3VnaCB0aGUgQ2hhbXBpb25zIExlYWd1ZSB0cm9waHksIE5leW1hciByZWFjaGVkIHRvIHRvdWNoIHRoZSBwcmVjaW91cyB0aXRsZSBoZSB3b24gaW4gMjAxNS4gTWFueSBmYW5zIHNhaWQgb24gVHdpdHRlciB0aGF0IGl0IHNlZW1zIHRoYXQgTmV5bWFyIHdhbnRzIHRvICJhY3QiIGluIGZyb250IG9mIHRoZSBjYW1lcmEgd2l0aCBzb2JzLCByYXRoZXIgdGhhbiB0aGUgZGVzaXJlIHRvIHdpbiB0aGUgdGl0bGUuIE9uIHRoZSBmaWVsZCwgTmV5bWFyIGlzIG9mIGNvdXJzZSBhbHNvIHRoZSBtb3N0IGhhcmQtd29ya2luZyBwbGF5ZXIgb2YgUFNHLiBUaGUgQnJhemlsaWFuIHN0YXIgc2hvd3MgZHluYW1pc20sIGJ1dCB0aGUgZWZmZWN0IGJlaGluZCBpdCBpcyBleHRyZW1lbHkgdmFndWUuPC9wPjxwIHN0eWxlPSJtYXJnaW4tbGVmdDphdXRvOyI+Jm5ic3A7PC9wPjxmaWd1cmUgY2xhc3M9ImltYWdlIGltYWdlX3Jlc2l6ZWQiIHN0eWxlPSJ3aWR0aDoxNTE5LjJweDsiPjxpbWcgc3JjPSJodHRwczovL2Nkbi4yNGguY29tLnZuL3VwbG9hZC8zLTIwMjAvaW1hZ2VzLzIwMjAtMDgtMjQvZGQtMTU5ODI0MTY1Ni05Mi13aWR0aDE2MDBoZWlnaHQxMDY3LmpwZyIgYWx0PSIiPjwvZmlndXJlPjxwIHN0eWxlPSJtYXJnaW4tbGVmdDphdXRvO3RleHQtYWxpZ246anVzdGlmeTsiPkhlIGlzIHRoZSBzZWNvbmQgbW9zdCBtb2JpbGUgcGxheWVyIG9mIFBTRyBpbiB0aGlzIG1hdGNoICg5LjExIGttKSwgYmVoaW5kIG9ubHkgTWFycXVpbmhvcyAoOS43MSBrbSksIGluIHdoaWNoIG1vc3Qgb2YgaXQgaXMgZHJpYmJsaW5nIHNpdHVhdGlvbnMuIEhlIGhhZCBhIGtpY2sgZG93biB0byByZWNlaXZlIEt5bGlhbiBNYmFwcGUncyBzbGl0IGJ1dCBjb3VsZCBub3Qgd2luIGFnYWluc3QgTWFudWVsIE5ldWVyIGluIGEgZmFjZS10by1mYWNlIHNpdHVhdGlvbi4gT3RoZXIgdGhhbiB0aGF0LCBoZSBjb3VsZCBub3QgZGVsaXZlciBhIHBhc3MgZm9yIGhpcyB0ZWFtbWF0ZXMgdG8gZmluaXNoLiBIaXMgY3Jvc3MgaW4gdGhlIHNlY29uZCBoYWxmIHdhcyBmYXZvcmFibGUsIGJ1dCBzdHJpa2VyIEVyaWMgQ2hvdXBvLU1vdGluZyBtaXNzZWQuIE5leW1hciBzaGluZWQgYnJpZ2h0bHkgaW4gUFNHJ3MgY2hva2luZyAyLTEgdmljdG9yeSBvdmVyIEF0YWxhbnRhIGluIHRoZSBxdWFydGVyLWZpbmFscyB3aXRoIGFuIGV4Y2VsbGVudCBhc3Npc3QgYW5kIGFuIGV4Y2VsbGVudCBsYXVuY2guIFRoZXNlIGlkZWFzIHdpbGwgYmUgdGhlIHByZW1pc2UgZm9yIE5leW1hciBhbmQgUFNHIHRvIHJlYWNoIHRoZSB0b3Agb2YgdGhlIENoYW1waW9ucyBMZWFndWUgZ2xvcnkgdGhpcyBzZWFzb24sIGJ1dCB0aGVuIGV2ZXJ5dGhpbmcgaXMganVzdCBlcGhlbWVyYWwgd2hlbiBOZXltYXIgaGFzIHRvIGZhY2UgYSB0b28gb2xkIG9wcG9uZW50LjwvcD48cCBzdHlsZT0ibWFyZ2luLWxlZnQ6YXV0bzsiPiZuYnNwOzwvcD48ZmlndXJlIGNsYXNzPSJpbWFnZSBpbWFnZV9yZXNpemVkIiBzdHlsZT0id2lkdGg6NzU1LjZweDsiPjxpbWcgc3JjPSJodHRwczovL2Nkbi4yNGguY29tLnZuL3VwbG9hZC8zLTIwMjAvaW1hZ2VzLzIwMjAtMDgtMjQvZHd3LTE1OTgyNDI1MjgtNjE2LXdpZHRoNzk1aGVpZ2h0NDQ2LmpwZyIgYWx0PSIiPjwvZmlndXJlPjxmaWd1cmUgY2xhc3M9ImltYWdlIGltYWdlX3Jlc2l6ZWQiIHN0eWxlPSJ3aWR0aDo3NTUuNnB4OyI+PGltZyBzcmM9Imh0dHBzOi8vY2RuLjI0aC5jb20udm4vdXBsb2FkLzMtMjAyMC9pbWFnZXMvMjAyMC0wOC0yNC9ycnItMTU5ODI0MjUyOC05OC13aWR0aDc5NWhlaWdodDQ0Ni5qcGciIGFsdD0iIj48L2ZpZ3VyZT48cCBzdHlsZT0ibWFyZ2luLWxlZnQ6YXV0bzt0ZXh0LWFsaWduOmp1c3RpZnk7Ij5XaGVyZSB0byBmaW5kIHRoZSBkaWZmZXJlbmNlPzwvcD48cCBzdHlsZT0ibWFyZ2luLWxlZnQ6YXV0bzsiPiZuYnNwOzwvcD48ZmlndXJlIGNsYXNzPSJpbWFnZSBpbWFnZV9yZXNpemVkIiBzdHlsZT0id2lkdGg6ODAzLjJweDsiPjxpbWcgc3JjPSJodHRwczovL2Nkbi4yNGguY29tLnZuL3VwbG9hZC8zLTIwMjAvaW1hZ2VzLzIwMjAtMDgtMjQvcnJydHQtMTU5ODI0MzE3Mi0xMzYtd2lkdGg1MDBoZWlnaHQ4MjIuanBnIiBhbHQ9IiI+PC9maWd1cmU+PHAgc3R5bGU9Im1hcmdpbi1sZWZ0OmF1dG87dGV4dC1hbGlnbjpqdXN0aWZ5OyI+PGJyPjxzcGFuIHN0eWxlPSJiYWNrZ3JvdW5kLWNvbG9yOnJnYigyNDgsMjQ5LDI1MCk7Y29sb3I6cmdiKDM0LDM0LDM0KTsiPklzIE5leW1hcidzIGxldmVsIG5vdCBlbm91Z2ggdG8gc2F2ZSBQU0cgYWdhaW5zdCB0aGUgc3Ryb25nZXN0IG9wcG9uZW50cywgaW4gdGhlIG1vc3QgZGlmZmljdWx0IHNpdHVhdGlvbnMsIG9yIHRvbyBnb29kIG9mIEJheWVybj8gV2l0aCBzaXggZm91bGVkIHNpdHVhdGlvbnMgYWdhaW5zdCBCYXllcm4sIE5leW1hciB3YXMgZm91bGVkIGEgdG90YWwgb2YgMjIgdGltZXMgc3RhcnRpbmcgZnJvbSB0aGUgMjAxOS8yMCBDaGFtcGlvbnMgTGVhZ3VlIHF1YXJ0ZXItZmluYWxzIGFnYWluc3QgQXRhbGFudGEsIGFuZCB3YXMgdGhlIG1vc3QgZm91bGVkIHBsYXllciBpbiB0aGUgdG91cm5hbWVudCBpbiB0aGUgZW50aXJlIHNlYXNvbi4gZW5kLiBPZiBjb3Vyc2UsIGZpcmUgbXVzdCBoYXZlIHNtb2tlLiBOZXltYXIgaGFzIGEgZGVzaXJlIHRvIGdvIGJhbGwsIHRvIGxlYWQgYW5kIHRvIHBlcmZvcm0sIHRvIG1ha2UgaGlzIG9wcG9uZW50IGludGVyY2VwdC4gQnV0IHRoZSBCcmF6aWxpYW4gc3RhciBkaWQgbm90IHRha2UgYWR2YW50YWdlIG9mIHRoZSBjdW5uaW5nIGZlYXR1cmVzIG9mIGhpcyBwbGF5IGluIHRoZSBwc3ljaG9sb2d5IG9mIHRoZSBnYW1lLiBUaGUgbW9yZSB0aGUgb3Bwb25lbnQgbWFkZSB0aGUgbWlzdGFrZSwgdGhlIG1vcmUgTmV5bWFyIHdlbnQgdG8gdGhlIGJhbGwsIGFuZCB0aGUgZGFya2VyIHRoZSBiYWxsIHdlbnQuIEJyYXZlcnkgaW4gYmlnIGdhbWVzIGlzIHNvbWV0aGluZyB0aGF0IE5leW1hciB3aWxsIHN0aWxsIGhhdmUgdG8gbGVhcm4gYSBsb3QgZnJvbS4gTGVnZW5kYXJ5IFJ1dWQgR3VsbGl0IHByYWlzZWQgU2VyZ2UgR25hYnJ5IGZvciBoaXMgImFnZ3Jlc3NpdmUiIGFmdGVyIGtpY2tpbmcgTmV5bWFyIGluIHRoZSBmb290IHdoZW4gaGUgd2FzIGJsb2NraW5nIHRoaXMgcGxheWVyIGF0IHRoZSBib3JkZXJsaW5lLCB3aGljaCB0b29rIHBsYWNlIGluIHRoZSBzZWNvbmQgaGFsZiBvZiB0aGUgbWF0Y2guIEhlIHNhaWQgdGhhdCB0aGlzIHdhcyBhICJwaXZvdGFsIG1vbWVudCIgdG8gd2luIEJheWVybi4gVGhlIGNvbGQsIHRhY2l0dXJuIEdlcm1hbiBoYXMgd29uIG92ZXIgYSBzZW5zaXRpdmUgTmV5bWFyLjwvc3Bhbj48L3A+PHAgc3R5bGU9Im1hcmdpbi1sZWZ0OmF1dG87Ij4mbmJzcDs8L3A+PGZpZ3VyZSBjbGFzcz0iaW1hZ2UgaW1hZ2VfcmVzaXplZCIgc3R5bGU9IndpZHRoOjE1MTkuMnB4OyI+PGltZyBzcmM9Imh0dHBzOi8vY2RuLjI0aC5jb20udm4vdXBsb2FkLzMtMjAyMC9pbWFnZXMvMjAyMC0wOC0yNC90dGdnLTE1OTgyNDMzOTQtNzU3LXdpZHRoMTYwMGhlaWdodDkwMC5qcGciIGFsdD0iIj48L2ZpZ3VyZT48cCBzdHlsZT0ibWFyZ2luLWxlZnQ6YXV0bzt0ZXh0LWFsaWduOmp1c3RpZnk7Ij5XaGVuIE5leW1hciAicmFuIG91dCBvZiBwZXJtaXNzaW9uIiwgdGhlIFBTRyB0ZWFtIGFsc28gc3VmZmVyZWQgImRvbWlubyBlZmZlY3QiLCB3aGVuIHRoZWlyIGJyaWdodGVzdCBzdGFycyBNYmFwcGUgYW5kIEFuZ2VsIGRpIE1hcmlhIGRpZCBub3Qgc2hvdyBzaGFycG5lc3MgYXBhcnQgZnJvbSBhIGZldyBzaW5nbGUgc2l0dWF0aW9ucy4gTWJhcHBlIGRpc2FwcG9pbnRlZCBpbiBoaXMgYWJpbGl0eSB0byBmaW5pc2gsIHdoaWxlIERpIE1hcmlhJ3MgYnJpZ2h0IHNwb3Qgd2FzIGp1c3QgQWxwaG9uc28gRGF2aWVzLiBDb2FjaCBUaG9tYXMgVHVjaGVsIG1lbnRpb25lZCBMaW9uZWwgTWVzc2kgYWZ0ZXIgdGhlIGdhbWUgaW4gYSBqb2tpbmcgam9rZSBhYm91dCBQU0cgY2FuIGJ1eSB0aGlzIHN1cGVyc3Rhci4gQnV0IFBTRyBwZW9wbGUgbmVlZCB0byByZWNvZ25pemUgdGhlIGZhY3QgdGhhdCBpdCB3aWxsIGJlIGRpZmZpY3VsdCBmb3IgTmV5bWFyLCB3aXRoIGhpcyBwZXJzb25hbGl0eSBhbmQgaGFiaXRzLCB0byByaXNlIHRvIGJlY29tZSBhIHRydWUgbGVhZGVyLCBib3RoIHByb2Zlc3Npb25hbGx5IGFuZCBtZW50YWxseS4gWW91IGNhbiBvbmx5IGFjaGlldmUgc3VibGltYXRpb24sIGJ5IHBsYXlpbmcgd2l0aCBwZW9wbGUgbGlrZSB0aGF0LkNvYWNoIFRob21hcyBUdWNoZWwgbWVudGlvbmVkIExpb25lbCBNZXNzaSBhZnRlciB0aGUgZ2FtZSBpbiBhIGpva2luZyBqb2tlIGFib3V0IFBTRyBjYW4gYnV5IHRoaXMgc3VwZXJzdGFyLiBCdXQgUFNHIHBlb3BsZSBuZWVkIHRvIHJlY29nbml6ZSB0aGUgZmFjdCB0aGF0IGl0IHdpbGwgYmUgZGlmZmljdWx0IGZvciBOZXltYXIsIHdpdGggaGlzIHBlcnNvbmFsaXR5IGFuZCBoYWJpdHMsIHRvIHJpc2UgdG8gYmVjb21lIGEgdHJ1ZSBsZWFkZXIsIGJvdGggcHJvZmVzc2lvbmFsbHkgYW5kIG1lbnRhbGx5LiBZb3UgY2FuIG9ubHkgYWNoaWV2ZSBzdWJsaW1hdGlvbiwgYnkgcGxheWluZyB3aXRoIHBlb3BsZSBsaWtlIHRoYXQuPC9wPjxwIHN0eWxlPSJtYXJnaW4tbGVmdDphdXRvOyI+Jm5ic3A7PC9wPg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(7, 2, 'vi', 'article', 'Quang Hải xoá hết ảnh Huỳnh Anh: Bạn gái hot girl phản ứng bất ngờ Thứ Hai, ngày 24/08/2020 12:37 PM (GMT+7)', 'quang-hai-xoa-het-anh-huynh-anh-ban-gai-hot-girl-phan-ung-bat-ngo-thu-hai-ngay-24-08-2020-12-37-pm-gmt-7', '', '', 0, 'PHAgc3R5bGU9Im1hcmdpbi1sZWZ0OjBweDsiPjxzdHJvbmc+VGnhu4FuIHbhu4cgTmd1eeG7hW4gUXVhbmcgSOG6o2kgYuG6pXQgbmfhu50geG/DoSBo4bq/dCBow6xuaCDhuqNuaCBjaOG7pXAgY2h1bmcgduG7m2kgSHXhu7NuaCBBbmggdHLDqm4gbeG6oW5nIHjDoyBo4buZaSwgdHJvbmcga2hpIGPDtCBi4bqhbiBnw6FpIGhvdCBnaXJsIGPFqW5nIGPDsyBwaOG6o24g4bupbmcgbOG6oS48L3N0cm9uZz48L3A+', 'PHA+UXVhbmcgSOG6o2kgY8O0bmcga2hhaSBo4bq5biBow7IgduG7m2kgSHXhu7NuaCBBbmggaMO0bSAxMi81IGLhurFuZyBt4buZdCBow6xuaCDhuqNuaCBnw6J5IHjDtG4geGFvIG3huqFuZyB4w6MgaOG7mWkuIEvhu4MgdOG7qyDEkcOzLCBRdWFuZyBI4bqjaSB2w6AgSHXhu7NuaCBBbmggbmjGsCBow6xuaCB24bubaSBiw7NuZy4gQ8O0IGLhuqFuIGfDoWkgaG90IGdpcmwgdGhlbyBjaMOibiBj4buVIHbFqSBRdWFuZyBI4bqjaSB0csOqbiBraOG6r3AgY8OhYyBzw6JuIGLDs25nIHRyw6puIGPhuqMgbsaw4bubYywgZMO5IHRp4buBbiB24buHIMSQVCBWaeG7h3QgTmFtIGPDsyBs4bqnbiBn4bq3cCBy4bqvYyBy4buRaSB2w6wgbOG7mSB0aW4gbmjhuq9uIG5o4bqheSBj4bqjbSB0csOqbiBt4bqhbmcuPC9wPjxmaWd1cmUgY2xhc3M9ImltYWdlIGltYWdlX3Jlc2l6ZWQiIHN0eWxlPSJ3aWR0aDo2NjBweDsiPjxpbWcgc3JjPSJodHRwczovL2Nkbi4yNGguY29tLnZuL3VwbG9hZC8zLTIwMjAvaW1hZ2VzLzIwMjAtMDgtMjQvcWgtMTU5ODI0Njk5Ny0yMS13aWR0aDY2MGhlaWdodDQ5Mi5qcGciIGFsdD0iUXVhbmcgSOG6o2kgeG/DoSBo4bq/dCDhuqNuaCBIdeG7s25oIEFuaDogQuG6oW4gZ8OhaSBob3QgZ2lybCBwaOG6o24g4bupbmcgYuG6pXQgbmfhu50gLSAxIj48L2ZpZ3VyZT48cCBzdHlsZT0idGV4dC1hbGlnbjpjZW50ZXI7Ij48aT5RdWFuZyBI4bqjaSBjw7RuZyBraGFpIGjhurluIGjDsiB24bubaSBIdeG7s25oIEFuaCBow7RtIDEyLzUuPC9pPjwvcD48cD7EkOG6v24ga2hpIFF1YW5nIEjhuqNpIGThu7EgbOG7hSB0cmFvIGdp4bqjaSBRdeG6oyBiw7NuZyB2w6BuZyBWaeG7h3QgTmFtIG5nw6B5IDI2LzUsIEh14buzbmggQW5oIGPFqW5nIGfDs3AgbeG6t3QsIHPDoW5oIGLGsOG7m2MgY8O5bmcgYuG6oW4gdHJhaS4gxJDDsyBjxaluZyBsw6AgbOG6p24gxJHhuqd1IHRpw6puIFF1YW5nIEjhuqNpIOKAkyBIdeG7s25oIEFuaCBjw7luZyBuaGF1IHh14bqldCBoaeG7h24gdHLGsOG7m2MgxJHDtG5nIMSR4bqjbyBnaeG7m2kgdHJ1eeG7gW4gdGjDtG5nIHbDoCBuZ8aw4budaSBow6JtIG3hu5kuPC9wPjxwPk5nb8OgaSByYSwgUXVhbmcgSOG6o2kgY8OybiBk4bqrbiBIdeG7s25oIEFuaCB24buBIHJhIG3huq90IGdpYSDEkcOsbmguIOG7niB0cuG6rW4gxJHhuqV1IGdp4buvYSBUUC5IQ00gdsOgIEjDoCBO4buZaSBow7RtIDI0LzcsIG3hurkgY+G7p2EgUXVhbmcgSOG6o2kgxJHDoyBkw6BuaCBuaGnhu4F1IGPhu60gY2jhu4kgdGjDom4gbeG6rXQgdsOgIGNoxINtIHPDs2MgSHXhu7NuaCBBbmggdHLDqm4ga2jDoW4gxJHDoGkgc8OibiB24bqtbiDEkeG7mW5nIFRo4buRbmcgTmjhuqV0LjwvcD48cD5UaOG6vyBuaMawbmcsIGRp4buFbiBiaeG6v24gbeG7m2kgbmjhuqV0IGPhu6dhIGNodXnhu4duIHTDrG5oIGPhuqNtIGdp4buvYSBRdWFuZyBI4bqjaSB2w6AgSHXhu7NuaCBBbmggbMOgbSBuaGnhu4F1IG5nxrDhu51pIGjDom0gbeG7mSBraMO0bmcga2jhu49pIHTDsiBtw7IuIFRoZW8gxJHDsywgdOG7kWkgbmfDoHkgMjMvOCwgbmhp4buBdSBuZ8aw4budaSBow6JtIG3hu5kgcGjDoXQgaGnhu4duIFF1YW5nIEjhuqNpIMSRw6MgYuG6pXQgbmfhu50geG/DoSDEkWkgaGFpIGLhu6ljIOG6o25oIHTDrG5oIGPhuqNtIGNo4bulcCBjw7luZyBIdeG7s25oIEFuaCB0csOqbiBt4bqhbmcgeMOjIGjhu5lpLjwvcD48cCBzdHlsZT0idGV4dC1hbGlnbjpjZW50ZXI7Ij4mbmJzcDs8L3A+PHA+Jm5ic3A7PC9wPjxwIHN0eWxlPSJ0ZXh0LWFsaWduOmNlbnRlcjsiPiZuYnNwOzwvcD48ZmlndXJlIGNsYXNzPSJpbWFnZSBpbWFnZV9yZXNpemVkIiBzdHlsZT0id2lkdGg6NjYwcHg7Ij48aW1nIHNyYz0iaHR0cHM6Ly9jZG4uMjRoLmNvbS52bi91cGxvYWQvMy0yMDIwL2ltYWdlcy8yMDIwLTA4LTI0L3VudGl0bGVkLTMtMTU5ODI0NzA0My0zMS13aWR0aDY2MGhlaWdodDQ1Ny5qcGciIGFsdD0iUXVhbmcgSOG6o2kgeG/DoSBo4bq/dCDhuqNuaCBIdeG7s25oIEFuaDogQuG6oW4gZ8OhaSBob3QgZ2lybCBwaOG6o24g4bupbmcgYuG6pXQgbmfhu50gLSAyIj48L2ZpZ3VyZT48cCBzdHlsZT0ibWFyZ2luLWxlZnQ6YXV0bzt0ZXh0LWFsaWduOmNlbnRlcjsiPiZuYnNwOzwvcD48cD4mbmJzcDs8L3A+PHA+Jm5ic3A7PC9wPjxwIHN0eWxlPSJ0ZXh0LWFsaWduOmNlbnRlcjsiPjxpPlBo4bqjbiDhu6luZyBs4bqhIGPhu6dhIEh14buzbmggQW5oIGtoaeG6v24gZMOibiBt4bqhbmcgxJHhu5NuIMSRb8OhbiB24buBIGNodXnhu4duIHTDrG5oIGPhuqNtIGPhu6dhIFF1YW5nIEjhuqNpLjwvaT48L3A+PHA+xJDDsyBsw6AgaMOsbmgg4bqjbmggUXVhbmcgSOG6o2kgZMO5bmcgxJHhu4MgY8O0bmcga2hhaSBt4buRaSBxdWFuIGjhu4cgduG7m2kgY8O0IGLhuqFuIGfDoWkgcXXDqiBOaGEgVHJhbmcgdsOgIG3hu5l0IGLhu6ljIOG6o25oIGtow6FjIGhhaSBuZ8aw4budaSDEkcaw4bujYyBjaOG7pXAg4bufIGzhu4UgdHJhbyBnaeG6o2kgUXXhuqMgYsOzbmcgdsOgbmcgVmnhu4d0IE5hbS48L3A+PHA+VuG7gSBwaOG6p24gbcOsbmgsIEh14buzbmggQW5oIGPFqW5nIGPDsyBwaOG6o24g4bupbmcga2jDoSBs4bqhLiZuYnNwO0h14buzbmggQW5oIMSRxINuZyB04bqjaSBsw6puIHRyYW5nIGPDoSBuaMOibiBt4buZdCBi4bupYyDhuqNuaCBjw7MgbcOgdSBz4bqvYyB1IHThu5FpIGvDqG0gY2jhu68g4oCcQuG6oWPigJ0uIE3hurd0IGtow6FjLCBIdeG7s25oIEFuaCBjw7JuIGNodXnhu4NuIHNhbmcgdHLhuqFuZyB0aMOhaSDigJzEkOG7mWMgdGjDom7igJ0g4bufIHBo4bqnbiBnaeG7m2kgdGhp4buHdSB0csOqbiBmYWNlYm9vayBjw6EgbmjDom4sIGTDuSBRdWFuZyBI4bqjaSB24bqrbiBnaeG7ryBjaOG6vyDEkeG7mSDigJxI4bq5biBow7LigJ0uPC9wPjxwPlRoZW8gdMOsbSBoaeG7g3UsIMSRw6J5IGtow7RuZyBwaOG6o2kgbOG6p24gxJHhuqd1IHRpw6puIEh14buzbmggQW5oIHRoYXkgxJHhu5VpIHRy4bqhbmcgdGjDoWkg4oCcSOG6uW4gaMOy4oCdIOKAkyDigJzEkOG7mWMgdGjDom7igJ0gdHLDqm4gdHJhbmcgY8OhIG5ow6JuIGvhu4MgdOG7qyBuZ8OgeSBjw7RuZyBraGFpIGNodXnhu4duIHTDrG5oIGPhuqNtIHbhu5tpIFF1YW5nIEjhuqNpLiBOaMawbmcg4bufIGzhuqduIG7DoHksIHZp4buHYyBRdWFuZyBI4bqjaSB4b8OhIMSRaSBow6xuaCDhuqNuaCB0w6xuaCBj4bqjbSBjw7luZyBi4bqhbiBnw6FpIGzDoG0gbmhp4buBdSBuZ8aw4budaSBraMO0bmcga2jhu49pIGPDsyBuaOG7r25nIMSR4buTbiDEkW/DoW4gbeG7kWkgcXVhbiBo4buHIGdp4buvYSB0aeG7gW4gduG7hyDEkFQgVmnhu4d0IE5hbSB2w6AgSHXhu7NuaCBBbmggZMaw4budbmcgbmjGsCDEkWFuZyBjw7MgZOG6pXUgaGnhu4d1IHLhuqFuIG7hu6l0PzwvcD4=', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(8, 2, 'en', 'article', 'Quang Hai deleted all pictures Huynh Anh: Hot girl\'s girlfriend responded unexpectedly Monday, August 24, 2020 12:37 PM (GMT + 7)', 'quang-hai-deleted-all-pictures-huynh-anh-hot-girl-s-girlfriend-responded-unexpectedly-monday-august-24-2020-12-37-pm-gmt-7', '', '', 0, 'PHA+PHNwYW4gc3R5bGU9ImJhY2tncm91bmQtY29sb3I6cmdiKDI0OCwyNDksMjUwKTtjb2xvcjpyZ2IoMzQsMzQsMzQpOyI+TWlkZmllbGRlciBOZ3V5ZW4gUXVhbmcgSGFpIHN1ZGRlbmx5IGRlbGV0ZWQgYWxsIHRoZSBwaWN0dXJlcyB0YWtlbiB3aXRoIEh1eW5oIEFuaCBvbiBzb2NpYWwgbmV0d29ya3MsIHdoaWxlIHRoZSBob3QgZ2lybCdzIGdpcmxmcmllbmQgYWxzbyByZWFjdGVkIHN0cmFuZ2VseS48L3NwYW4+PC9wPg==', 'PHA+UXVhbmcgSGFpIHB1YmxpY2x5IGRhdGVkIEh1eW5oIEFuaCBvbiBNYXkgMTIgd2l0aCBhbiBpbWFnZSB0aGF0IGNhdXNlZCBhIHN0aXIgaW4gc29jaWFsIG5ldHdvcmtzLiBTaW5jZSB0aGVuLCBRdWFuZyBIYWkgYW5kIEh1eW5oIEFuaCBhcmUgc2hvd24gd2l0aCBhIHNoYWRvdy4gVGhlIGhvdCBnaXJsJ3MgZ2lybGZyaWVuZCBmb2xsb3dlZCBRdWFuZyBIYWkncyBmb290c3RlcHMgb24gYWxsIGZvb3RiYWxsIGZpZWxkcyBhY3Jvc3MgdGhlIGNvdW50cnksIGFsdGhvdWdoIHRoZSBWaWV0bmFtZXNlIG1pZGZpZWxkZXIgd2FzIG9uYzwvcD48ZmlndXJlIGNsYXNzPSJpbWFnZSBpbWFnZV9yZXNpemVkIiBzdHlsZT0id2lkdGg6NjYwcHg7Ij48aW1nIHNyYz0iaHR0cHM6Ly9jZG4uMjRoLmNvbS52bi91cGxvYWQvMy0yMDIwL2ltYWdlcy8yMDIwLTA4LTI0L3FoLTE1OTgyNDY5OTctMjEtd2lkdGg2NjBoZWlnaHQ0OTIuanBnIiBhbHQ9IlF1YW5nIEjhuqNpIHhvw6EgaOG6v3Qg4bqjbmggSHXhu7NuaCBBbmg6IELhuqFuIGfDoWkgaG90IGdpcmwgcGjhuqNuIOG7qW5nIGLhuqV0IG5n4budIC0gMSI+PC9maWd1cmU+PHA+Jm5ic3A7PC9wPjxwPlF1YW5nIEhhaSBwdWJsaWNseSBkYXRlZCBIdXluaCBBbmggb24gTWF5IDEyLg0KDQpVbnRpbCBRdWFuZyBIYWkgYXR0ZW5kZWQgdGhlIFZpZXRuYW0gR29sZGVuIEJhbGwgQXdhcmRzIG9uIE1heSAyNiwgSHV5bmggQW5oIGFsc28gam9pbmVkIGluLCB3YWxraW5nIGFsb25nc2lkZSBoaXMgYm95ZnJpZW5kLiBJdCB3YXMgYWxzbyB0aGUgZmlyc3QgdGltZSB0aGF0IFF1YW5nIEhhaSAtIEh1eW5oIEFuaCB0b2dldGhlciBhcHBlYXJlZCBpbiBmcm9udCBvZiB0aGUgbWVkaWEgYW5kIGZhbnMuDQoNCkluIGFkZGl0aW9uLCBRdWFuZyBIYWkgYWxzbyBsZWQgSHV5bmggQW5oIHRvIGxhdW5jaCBoaXMgZmFtaWx5LiBJbiB0aGUgbWF0Y2ggYmV0d2VlbiBIbyBDaGkgTWluaCBDaXR5IGFuZCBIYW5vaSBvbiBKdWx5IDI0dGgsIFF1YW5nIEhhaSdzIG1vdGhlciB0b29rIGEgbG90IG9mIGludGltYXRlIGdlc3R1cmVzIGFuZCB0b29rIGNhcmUgb2YgSHV5bmggQW5oIGluIHRoZSBzdGFuZHMgb2YgVGhvbmcgTmhhdCBzdGFkaXVtLg0KDQpIb3dldmVyLCB0aGUgbGF0ZXN0IGRldmVsb3BtZW50IG9mIHRoZSBsb3ZlIHN0b3J5IGJldHdlZW4gUXVhbmcgSGFpIGFuZCBIdXluaCBBbmggbWFkZSBtYW55IGZhbnMgY3VyaW91cy4gQWNjb3JkaW5nbHksIG9uIHRoZSBldmVuaW5nIG9mIEF1Z3VzdCAyMywgbWFueSBmYW5zIGRpc2NvdmVyZWQgdGhhdCBRdWFuZyBIYWkgaGFkIHN1ZGRlbmx5IGRlbGV0ZWQgdHdvIGVtb3Rpb25hbCBwaG90b3MgdGFrZW4gd2l0aCBIdXluaCBBbmggb24gc29jaWFsIG5ldHdvcmtzLjwvcD48cD4mbmJzcDs8L3A+PHA+ZSBpbiB0cm91YmxlIGJlY2F1c2UgaGUgcmV2ZWFsZWQgc2Vuc2l0aXZlIG1lc3NhZ2VzIG9ubGluZS48L3A+', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `canonical` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `order` int(11) NOT NULL,
  `default` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` tinyint(1) NOT NULL,
  `publish` tinyint(1) NOT NULL,
  `userid_created` int(11) NOT NULL,
  `userid_updated` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `title`, `canonical`, `image`, `description`, `order`, `default`, `created_at`, `updated_at`, `deleted_at`, `publish`, `userid_created`, `userid_updated`) VALUES
(1, 'English', 'en', '/upload/image/language/en.png', 'PHA+TmfDtG4gTmfhu68gVGnhur9uZyBBbmg8L3A+', 0, 0, '2020-08-17 15:06:01', '2020-08-19 14:32:54', 0, 1, 8, 8),
(2, 'Việt Nam', 'vi', '/upload/image/language/vietnam.jpg', 'PHA+VGnhur9uZyBWaeG7h3QgMTIxMzwvcD4=', 0, 1, '2020-08-17 15:11:03', '2020-08-19 14:59:30', 0, 1, 8, 8),
(3, 'Japanese', 'jp', '/upload/image/language/japan.png', 'PHA+VGnhur9uZyBOaOG6rXQ8L3A+', 0, 0, '2020-08-17 15:36:18', '2020-08-19 14:33:40', 0, 1, 8, 8);

-- --------------------------------------------------------

--
-- Table structure for table `object_relationship`
--

CREATE TABLE `object_relationship` (
  `id` int(11) NOT NULL,
  `objectid` int(11) NOT NULL,
  `catalogueid` int(11) NOT NULL,
  `module` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `object_relationship`
--

INSERT INTO `object_relationship` (`id`, `objectid`, `catalogueid`, `module`) VALUES
(1, 2, 14, 'article'),
(2, 2, 15, 'article'),
(3, 2, 17, 'article'),
(4, 2, 16, 'article'),
(7, 4, 17, 'article'),
(8, 4, 14, 'article'),
(9, 5, 14, 'article'),
(10, 6, 18, 'article'),
(11, 7, 18, 'article'),
(12, 1, 2, 'article'),
(13, 2, 2, 'article');

-- --------------------------------------------------------

--
-- Table structure for table `slide`
--

CREATE TABLE `slide` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `canonical` varchar(50) NOT NULL,
  `album` longtext NOT NULL,
  `image` varchar(255) NOT NULL,
  `stt` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` tinyint(1) NOT NULL,
  `publish` tinyint(1) NOT NULL,
  `userid_created` int(11) NOT NULL,
  `userid_updated` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `slide`
--

INSERT INTO `slide` (`id`, `name`, `canonical`, `album`, `image`, `stt`, `created_at`, `updated_at`, `deleted_at`, `publish`, `userid_created`, `userid_updated`) VALUES
(46, 'co', 'aaaaaaaaa', '', '[\"\\/upload\\/image\\/language\\/japan.png\"]', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `slide_translate`
--

CREATE TABLE `slide_translate` (
  `id` int(11) NOT NULL,
  `objectid` int(11) NOT NULL,
  `language` longtext NOT NULL,
  `module` varchar(50) NOT NULL,
  `number` varchar(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `canonical` varchar(255) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` longtext NOT NULL,
  `viewed` int(11) NOT NULL,
  `description` text NOT NULL,
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

INSERT INTO `slide_translate` (`id`, `objectid`, `language`, `module`, `number`, `title`, `canonical`, `meta_title`, `meta_description`, `viewed`, `description`, `content`, `created_at`, `updated_at`, `deleted_at`, `userid_created`, `userid_updated`) VALUES
(38, 46, 'vi', 'slide', '[\"0\"]', '[\"co nhat\"]', '', '[\"co nhat 3\"]', '[\"qqqqqqqqqqq\"]', 0, '[\"co nhat111111\"]', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `catalogueid` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `gender` tinyint(1) UNSIGNED NOT NULL,
  `address` varchar(255) NOT NULL,
  `cityid` varchar(20) NOT NULL,
  `districtid` varchar(20) NOT NULL,
  `wardid` varchar(20) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `birthday` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `verify` varchar(50) NOT NULL,
  `remote_addr` varchar(20) NOT NULL,
  `user_agent` text NOT NULL,
  `otp` varchar(6) NOT NULL,
  `otp_live` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` tinyint(1) NOT NULL,
  `last_login` datetime NOT NULL,
  `publish` tinyint(1) NOT NULL,
  `userid_created` int(11) NOT NULL,
  `userid_updated` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `catalogueid`, `email`, `password`, `salt`, `fullname`, `image`, `gender`, `address`, `cityid`, `districtid`, `wardid`, `phone`, `birthday`, `description`, `verify`, `remote_addr`, `user_agent`, `otp`, `otp_live`, `created_at`, `updated_at`, `deleted_at`, `last_login`, `publish`, `userid_created`, `userid_updated`) VALUES
(8, 1, 'htvietnam@gmail.com', 'd3ba6506f10e5bb0009fe0dba670108e', '7GZ7Hz5xLpz5ODUX6Z3hu6AIavRGMnNLTsrQcP4J4JiKBpuf0ReAQFEllgCWDekqK3bh2HaoyyN1oEwY9Os4HKnbjJqXID8TmFlSfYQA29SvFUboCcNu9RBrfgU0Sj1PmtxqWx021vdcMiwIdzwkdyMYgCTpmiVVOG6Vk8P5', 'HT Việt Nam', '/upload/image/75072700_731756833976762_8445131186954567680_n.jpg', 0, 'The One Gamuda 885 Tam Trinh, Hà Nội', '01TTT', '008HH', '00334', '0982365824', '10/10/1989', '', '', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.102 Safari/537.36', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2020-08-04 17:03:53', 0, '2020-09-18 13:51:40', 1, 0, 8),
(19, 2, 'tuannc.dev@gmail.com', '5d49b267bc89abe78a0e2c8f62caddf8', '7raOShZu8ES36TfMokFs5C1kfWNnD0wyhlImgIC2XmgELD7QqB1bpsrjS1vwJrzkUw4Jon64G9XpKoGycvR0WtxWtMIyectaHaNQbLfPU0UeFsjMOXiOqQF3PYpuHdzVBAigDbhAC2xTHm5NYK47A9q8l3dZnx8vBeK2VTdz', 'Hoàng Văn Nam', '', 1, 'Số nhà 108B Ngõ 1277 Đường Giải Phóng, Quận Hoàng Mai', '0', '0', '0', '0982365824', '', '', '', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.105 Safari/537.36', '163902', '2020-08-21 15:28:11', '2020-07-29 17:36:52', '2020-08-04 17:23:44', 0, '2020-08-04 17:26:43', 1, 8, 8),
(20, 3, 'tudo2109@gmail.com', 'b4c68e78585d4b3d9b5dc4e1969d408a', 'TjXIfSXX0yMkQyG7cCPDPzjm8wLO2i8YHFZ8UpNqyAdEMAcZ06qCVzGr7gY9nWOouNahmejlzpm6TtLhI3vDKtfp4ktJ3R9RcxHYbHlvbWZs7uo5ArFJvqo52PJLdgQeSusw9f4GUaT62xRb11dCx3aNDMVBUK0EWnrO5esB', 'Tú Đỗ', '', 1, 'Hà Nội', '', '', '', '0987654211', '21/09/1994', '', '', '', '', '', '0000-00-00 00:00:00', '2020-07-30 15:46:25', '2020-07-31 16:56:15', 0, '0000-00-00 00:00:00', 0, 8, 8),
(21, 2, 'webchuanseohtvietnam@gmail.com', '8623fcd0e8ce8e0cdf7af7026f15c330', 'yTpkpqbiedRowtwJ7ObPt2GVKiRhsyFtrusxeYNl3q1x8nTQ4kCHI9Z3rLDlKfEY54fsJDF4mHV7jQWWzWUvrvgag5AbKkAJzn06PMXTydN9oRphA2IHZBSqB0aM1G8966XmLacj0egcxFEdOUu5vnDZVQUXShwI8NC13jPO', 'Công Nghệ HT', '', 1, 'Xóm Cầu Tiên, ngõ 1277 đường Giải Phóng, phường Thịnh Liệt', '', '', '', '0982365824', '10/10/1989', '', '', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.105 Safari/537.36', '', '0000-00-00 00:00:00', '2020-07-31 15:42:44', '2020-07-31 16:56:20', 0, '2020-07-31 15:43:57', 1, 8, 8),
(22, 3, 'vietduc54kd@gmail.com', 'e07755fa7867e1225f2b65ed2a633066', 'yKIsCdpw03m8DsmGBQVOjHLwyVFeGJDUQt9vn7rqtZx9JgukMCpWOX2OS2UUPAPfYz5PGfN03HIrcT6Y8uESHjeo4XQh5Xs5DlZtZ1EfoJrMbwExlVaq4zja8pF6Ri03vCkcS9gYRnzWL6n7MITbmioxNilTeNyd2c71KhBg', 'Phạm Việt Đức', '', 1, 'CT6A Xa La, Kiến Hưng, Hà Đông, Hà Nội', '', '', '', '0966929991', '', '', '', '', '', '', '0000-00-00 00:00:00', '2020-07-31 15:50:10', '2020-07-31 17:04:45', 0, '0000-00-00 00:00:00', 0, 8, 8);

-- --------------------------------------------------------

--
-- Table structure for table `user_catalogue`
--

CREATE TABLE `user_catalogue` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `permission` text NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` tinyint(1) NOT NULL,
  `publish` tinyint(1) NOT NULL,
  `userid_created` int(11) NOT NULL,
  `userid_updated` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_catalogue`
--

INSERT INTO `user_catalogue` (`id`, `title`, `permission`, `description`, `created_at`, `updated_at`, `deleted_at`, `publish`, `userid_created`, `userid_updated`) VALUES
(1, 'Quản trị viên', '[\"backend\\/article\\/catalogue\\/index\",\"backend\\/article\\/catalogue\\/create\",\"backend\\/article\\/catalogue\\/update\",\"backend\\/article\\/catalogue\\/delete\",\"backend\\/article\\/article\\/index\",\"backend\\/article\\/article\\/create\",\"backend\\/article\\/article\\/update\",\"backend\\/article\\/article\\/delete\",\"backend\\/language\\/language\\/index\",\"backend\\/language\\/language\\/create\",\"backend\\/language\\/language\\/update\",\"backend\\/language\\/language\\/delete\",\"backend\\/user\\/catalogue\\/index\",\"backend\\/user\\/catalogue\\/create\",\"backend\\/user\\/catalogue\\/update\",\"backend\\/user\\/catalogue\\/delete\",\"backend\\/user\\/user\\/index\",\"backend\\/user\\/user\\/create\",\"backend\\/user\\/user\\/update\",\"backend\\/user\\/user\\/delete\",\"All\",\"folderView\",\"folderCreate\",\"folderRename\",\"folderDelete\",\"fileView\",\"fileUpload\",\"fileRename\",\"fileDelete\"]', '', '0000-00-00 00:00:00', '2020-08-17 14:55:11', 0, 1, 0, 8),
(2, 'Thành viên', '[\"backend\\/user\\/catalogue\\/index\",\"backend\\/user\\/catalogue\\/create\",\"backend\\/user\\/catalogue\\/update\",\"backend\\/user\\/catalogue\\/delete\",\"backend\\/user\\/user\\/index\",\"backend\\/user\\/user\\/create\",\"backend\\/user\\/user\\/update\",\"backend\\/user\\/user\\/delete\",\"folderView\",\"folderCreate\",\"folderRename\",\"folderDelete\",\"fileView\",\"fileUpload\",\"fileRename\",\"fileDelete\"]', '', '0000-00-00 00:00:00', '2020-08-04 17:26:35', 0, 1, 0, 8),
(3, 'Cộng tác viên', '', '', '0000-00-00 00:00:00', '2020-07-31 16:11:53', 0, 0, 0, 8),
(4, 'Thực tập', '', '', '2020-07-31 16:15:32', '0000-00-00 00:00:00', 1, 1, 8, 0);

-- --------------------------------------------------------

--
-- Table structure for table `vn_district`
--

CREATE TABLE `vn_district` (
  `districtid` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provinceid` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vn_district`
--

INSERT INTO `vn_district` (`districtid`, `name`, `provinceid`) VALUES
('001HH', 'Quận Ba Đình', '01TTT'),
('002HH', 'Quận Hoàn Kiếm', '01TTT'),
('003HH', 'Quận Tây Hồ', '01TTT'),
('004HH', 'Quận Long Biên', '01TTT'),
('005HH', 'Quận Cầu Giấy', '01TTT'),
('006HH', 'Quận Đống Đa', '01TTT'),
('007HH', 'Quận Hai Bà Trưng', '01TTT'),
('008HH', 'Quận Hoàng Mai', '01TTT'),
('009HH', 'Quận Thanh Xuân', '01TTT'),
('016HH', 'Huyện Sóc Sơn', '01TTT'),
('017HH', 'Huyện Đông Anh', '01TTT'),
('018HH', 'Huyện Gia Lâm', '01TTT'),
('019HH', 'Quận Nam Từ Liêm', '01TTT'),
('020HH', 'Huyện Thanh Trì', '01TTT'),
('021HH', 'Quận Bắc Từ Liêm', '01TTT'),
('024HH', 'Thành phố Hà Giang', '02TTT'),
('026HH', 'Huyện Đồng Văn', '02TTT'),
('027HH', 'Huyện Mèo Vạc', '02TTT'),
('028HH', 'Huyện Yên Minh', '02TTT'),
('029HH', 'Huyện Quản Bạ', '02TTT'),
('030HH', 'Huyện Vị Xuyên', '02TTT'),
('031HH', 'Huyện Bắc Mê', '02TTT'),
('032HH', 'Huyện Hoàng Su Phì', '02TTT'),
('033HH', 'Huyện Xín Mần', '02TTT'),
('034HH', 'Huyện Bắc Quang', '02TTT'),
('035HH', 'Huyện Quang Bình', '02TTT'),
('040HH', 'Thành phố Cao Bằng', '04TTT'),
('042HH', 'Huyện Bảo Lâm', '04TTT'),
('043HH', 'Huyện Bảo Lạc', '04TTT'),
('044HH', 'Huyện Thông Nông', '04TTT'),
('045HH', 'Huyện Hà Quảng', '04TTT'),
('046HH', 'Huyện Trà Lĩnh', '04TTT'),
('047HH', 'Huyện Trùng Khánh', '04TTT'),
('048HH', 'Huyện Hạ Lang', '04TTT'),
('049HH', 'Huyện Quảng Uyên', '04TTT'),
('050HH', 'Huyện Phục Hòa', '04TTT'),
('051HH', 'Huyện Hòa An', '04TTT'),
('052HH', 'Huyện Nguyên Bình', '04TTT'),
('053HH', 'Huyện Thạch An', '04TTT'),
('058HH', 'Thành Phố Bắc Kạn', '06TTT'),
('060HH', 'Huyện Pác Nặm', '06TTT'),
('061HH', 'Huyện Ba Bể', '06TTT'),
('062HH', 'Huyện Ngân Sơn', '06TTT'),
('063HH', 'Huyện Bạch Thông', '06TTT'),
('064HH', 'Huyện Chợ Đồn', '06TTT'),
('065HH', 'Huyện Chợ Mới', '06TTT'),
('066HH', 'Huyện Na Rì', '06TTT'),
('070HH', 'Thành phố Tuyên Quang', '08TTT'),
('071HH', 'Huyện Lâm Bình', '08TTT'),
('072HH', 'Huyện Na Hang', '08TTT'),
('073HH', 'Huyện Chiêm Hóa', '08TTT'),
('074HH', 'Huyện Hàm Yên', '08TTT'),
('075HH', 'Huyện Yên Sơn', '08TTT'),
('076HH', 'Huyện Sơn Dương', '08TTT'),
('080HH', 'Thành phố Lào Cai', '10TTT'),
('082HH', 'Huyện Bát Xát', '10TTT'),
('083HH', 'Huyện Mường Khương', '10TTT'),
('084HH', 'Huyện Si Ma Cai', '10TTT'),
('085HH', 'Huyện Bắc Hà', '10TTT'),
('086HH', 'Huyện Bảo Thắng', '10TTT'),
('087HH', 'Huyện Bảo Yên', '10TTT'),
('088HH', 'Huyện Sa Pa', '10TTT'),
('089HH', 'Huyện Văn Bàn', '10TTT'),
('094HH', 'Thành phố Điện Biên Phủ', '11TTT'),
('095HH', 'Thị Xã Mường Lay', '11TTT'),
('096HH', 'Huyện Mường Nhé', '11TTT'),
('097HH', 'Huyện Mường Chà', '11TTT'),
('098HH', 'Huyện Tủa Chùa', '11TTT'),
('099HH', 'Huyện Tuần Giáo', '11TTT'),
('100HH', 'Huyện Điện Biên', '11TTT'),
('101HH', 'Huyện Điện Biên Đông', '11TTT'),
('102HH', 'Huyện Mường Ảng', '11TTT'),
('103HH', 'Huyện Nậm Pồ', '11TTT'),
('105HH', 'Thành phố Lai Châu', '12TTT'),
('106HH', 'Huyện Tam Đường', '12TTT'),
('107HH', 'Huyện Mường Tè', '12TTT'),
('108HH', 'Huyện Sìn Hồ', '12TTT'),
('109HH', 'Huyện Phong Thổ', '12TTT'),
('110HH', 'Huyện Than Uyên', '12TTT'),
('111HH', 'Huyện Tân Uyên', '12TTT'),
('112HH', 'Huyện Nậm Nhùn', '12TTT'),
('116HH', 'Thành phố Sơn La', '14TTT'),
('118HH', 'Huyện Quỳnh Nhai', '14TTT'),
('119HH', 'Huyện Thuận Châu', '14TTT'),
('120HH', 'Huyện Mường La', '14TTT'),
('121HH', 'Huyện Bắc Yên', '14TTT'),
('122HH', 'Huyện Phù Yên', '14TTT'),
('123HH', 'Huyện Mộc Châu', '14TTT'),
('124HH', 'Huyện Yên Châu', '14TTT'),
('125HH', 'Huyện Mai Sơn', '14TTT'),
('126HH', 'Huyện Sông Mã', '14TTT'),
('127HH', 'Huyện Sốp Cộp', '14TTT'),
('128HH', 'Huyện Vân Hồ', '14TTT'),
('132HH', 'Thành phố Yên Bái', '15TTT'),
('133HH', 'Thị xã Nghĩa Lộ', '15TTT'),
('135HH', 'Huyện Lục Yên', '15TTT'),
('136HH', 'Huyện Văn Yên', '15TTT'),
('137HH', 'Huyện Mù Căng Chải', '15TTT'),
('138HH', 'Huyện Trấn Yên', '15TTT'),
('139HH', 'Huyện Trạm Tấu', '15TTT'),
('140HH', 'Huyện Văn Chấn', '15TTT'),
('141HH', 'Huyện Yên Bình', '15TTT'),
('148HH', 'Thành phố Hòa Bình', '17TTT'),
('150HH', 'Huyện Đà Bắc', '17TTT'),
('151HH', 'Huyện Kỳ Sơn', '17TTT'),
('152HH', 'Huyện Lương Sơn', '17TTT'),
('153HH', 'Huyện Kim Bôi', '17TTT'),
('154HH', 'Huyện Cao Phong', '17TTT'),
('155HH', 'Huyện Tân Lạc', '17TTT'),
('156HH', 'Huyện Mai Châu', '17TTT'),
('157HH', 'Huyện Lạc Sơn', '17TTT'),
('158HH', 'Huyện Yên Thủy', '17TTT'),
('159HH', 'Huyện Lạc Thủy', '17TTT'),
('164HH', 'Thành phố Thái Nguyên', '19TTT'),
('165HH', 'Thành phố Sông Công', '19TTT'),
('167HH', 'Huyện Định Hóa', '19TTT'),
('168HH', 'Huyện Phú Lương', '19TTT'),
('169HH', 'Huyện Đồng Hỷ', '19TTT'),
('170HH', 'Huyện Võ Nhai', '19TTT'),
('171HH', 'Huyện Đại Từ', '19TTT'),
('172HH', 'Thị xã Phổ Yên', '19TTT'),
('173HH', 'Huyện Phú Bình', '19TTT'),
('178HH', 'Thành phố Lạng Sơn', '20TTT'),
('180HH', 'Huyện Tràng Định', '20TTT'),
('181HH', 'Huyện Bình Gia', '20TTT'),
('182HH', 'Huyện Văn Lãng', '20TTT'),
('183HH', 'Huyện Cao Lộc', '20TTT'),
('184HH', 'Huyện Văn Quan', '20TTT'),
('185HH', 'Huyện Bắc Sơn', '20TTT'),
('186HH', 'Huyện Hữu Lũng', '20TTT'),
('187HH', 'Huyện Chi Lăng', '20TTT'),
('188HH', 'Huyện Lộc Bình', '20TTT'),
('189HH', 'Huyện Đình Lập', '20TTT'),
('193HH', 'Thành phố Hạ Long', '22TTT'),
('194HH', 'Thành phố Móng Cái', '22TTT'),
('195HH', 'Thành phố Cẩm Phả', '22TTT'),
('196HH', 'Thành phố Uông Bí', '22TTT'),
('198HH', 'Huyện Bình Liêu', '22TTT'),
('199HH', 'Huyện Tiên Yên', '22TTT'),
('200HH', 'Huyện Đầm Hà', '22TTT'),
('201HH', 'Huyện Hải Hà', '22TTT'),
('202HH', 'Huyện Ba Chẽ', '22TTT'),
('203HH', 'Huyện Vân Đồn', '22TTT'),
('204HH', 'Huyện Hoành Bồ', '22TTT'),
('205HH', 'Thị xã Đông Triều', '22TTT'),
('206HH', 'Thị xã Quảng Yên', '22TTT'),
('207HH', 'Huyện Cô Tô', '22TTT'),
('213HH', 'Thành phố Bắc Giang', '24TTT'),
('215HH', 'Huyện Yên Thế', '24TTT'),
('216HH', 'Huyện Tân Yên', '24TTT'),
('217HH', 'Huyện Lạng Giang', '24TTT'),
('218HH', 'Huyện Lục Nam', '24TTT'),
('219HH', 'Huyện Lục Ngạn', '24TTT'),
('220HH', 'Huyện Sơn Động', '24TTT'),
('221HH', 'Huyện Yên Dũng', '24TTT'),
('222HH', 'Huyện Việt Yên', '24TTT'),
('223HH', 'Huyện Hiệp Hòa', '24TTT'),
('227HH', 'Thành phố Việt Trì', '25TTT'),
('228HH', 'Thị xã Phú Thọ', '25TTT'),
('230HH', 'Huyện Đoan Hùng', '25TTT'),
('231HH', 'Huyện Hạ Hòa', '25TTT'),
('232HH', 'Huyện Thanh Ba', '25TTT'),
('233HH', 'Huyện Phù Ninh', '25TTT'),
('234HH', 'Huyện Yên Lập', '25TTT'),
('235HH', 'Huyện Cẩm Khê', '25TTT'),
('236HH', 'Huyện Tam Nông', '25TTT'),
('237HH', 'Huyện Lâm Thao', '25TTT'),
('238HH', 'Huyện Thanh Sơn', '25TTT'),
('239HH', 'Huyện Thanh Thuỷ', '25TTT'),
('240HH', 'Huyện Tân Sơn', '25TTT'),
('243HH', 'Thành phố Vĩnh Yên', '26TTT'),
('244HH', 'Thị xã Phúc Yên', '26TTT'),
('246HH', 'Huyện Lập Thạch', '26TTT'),
('247HH', 'Huyện Tam Dương', '26TTT'),
('248HH', 'Huyện Tam Đảo', '26TTT'),
('249HH', 'Huyện Bình Xuyên', '26TTT'),
('250HH', 'Huyện Mê Linh', '01TTT'),
('251HH', 'Huyện Yên Lạc', '26TTT'),
('252HH', 'Huyện Vĩnh Tường', '26TTT'),
('253HH', 'Huyện Sông Lô', '26TTT'),
('256HH', 'Thành phố Bắc Ninh', '27TTT'),
('258HH', 'Huyện Yên Phong', '27TTT'),
('259HH', 'Huyện Quế Võ', '27TTT'),
('260HH', 'Huyện Tiên Du', '27TTT'),
('261HH', 'Thị xã Từ Sơn', '27TTT'),
('262HH', 'Huyện Thuận Thành', '27TTT'),
('263HH', 'Huyện Gia Bình', '27TTT'),
('264HH', 'Huyện Lương Tài', '27TTT'),
('268HH', 'Quận Hà Đông', '01TTT'),
('269HH', 'Thị xã Sơn Tây', '01TTT'),
('271HH', 'Huyện Ba Vì', '01TTT'),
('272HH', 'Huyện Phúc Thọ', '01TTT'),
('273HH', 'Huyện Đan Phượng', '01TTT'),
('274HH', 'Huyện Hoài Đức', '01TTT'),
('275HH', 'Huyện Quốc Oai', '01TTT'),
('276HH', 'Huyện Thạch Thất', '01TTT'),
('277HH', 'Huyện Chương Mỹ', '01TTT'),
('278HH', 'Huyện Thanh Oai', '01TTT'),
('279HH', 'Huyện Thường Tín', '01TTT'),
('280HH', 'Huyện Phú Xuyên', '01TTT'),
('281HH', 'Huyện Ứng Hòa', '01TTT'),
('282HH', 'Huyện Mỹ Đức', '01TTT'),
('288HH', 'Thành phố Hải Dương', '30TTT'),
('290HH', 'Thị xã Chí Linh', '30TTT'),
('291HH', 'Huyện Nam Sách', '30TTT'),
('292HH', 'Huyện Kinh Môn', '30TTT'),
('293HH', 'Huyện Kim Thành', '30TTT'),
('294HH', 'Huyện Thanh Hà', '30TTT'),
('295HH', 'Huyện Cẩm Giàng', '30TTT'),
('296HH', 'Huyện Bình Giang', '30TTT'),
('297HH', 'Huyện Gia Lộc', '30TTT'),
('298HH', 'Huyện Tứ Kỳ', '30TTT'),
('299HH', 'Huyện Ninh Giang', '30TTT'),
('300HH', 'Huyện Thanh Miện', '30TTT'),
('303HH', 'Quận Hồng Bàng', '31TTT'),
('304HH', 'Quận Ngô Quyền', '31TTT'),
('305HH', 'Quận Lê Chân', '31TTT'),
('306HH', 'Quận Hải An', '31TTT'),
('307HH', 'Quận Kiến An', '31TTT'),
('308HH', 'Quận Đồ Sơn', '31TTT'),
('309HH', 'Quận Dương Kinh', '31TTT'),
('311HH', 'Huyện Thủy Nguyên', '31TTT'),
('312HH', 'Huyện An Dương', '31TTT'),
('313HH', 'Huyện An Lão', '31TTT'),
('314HH', 'Huyện Kiến Thuỵ', '31TTT'),
('315HH', 'Huyện Tiên Lãng', '31TTT'),
('316HH', 'Huyện Vĩnh Bảo', '31TTT'),
('317HH', 'Huyện Cát Hải', '31TTT'),
('318HH', 'Huyện Bạch Long Vĩ', '31TTT'),
('323HH', 'Thành phố Hưng Yên', '33TTT'),
('325HH', 'Huyện Văn Lâm', '33TTT'),
('326HH', 'Huyện Văn Giang', '33TTT'),
('327HH', 'Huyện Yên Mỹ', '33TTT'),
('328HH', 'Huyện Mỹ Hào', '33TTT'),
('329HH', 'Huyện Ân Thi', '33TTT'),
('330HH', 'Huyện Khoái Châu', '33TTT'),
('331HH', 'Huyện Kim Động', '33TTT'),
('332HH', 'Huyện Tiên Lữ', '33TTT'),
('333HH', 'Huyện Phù Cừ', '33TTT'),
('336HH', 'Thành phố Thái Bình', '34TTT'),
('338HH', 'Huyện Quỳnh Phụ', '34TTT'),
('339HH', 'Huyện Hưng Hà', '34TTT'),
('340HH', 'Huyện Đông Hưng', '34TTT'),
('341HH', 'Huyện Thái Thụy', '34TTT'),
('342HH', 'Huyện Tiền Hải', '34TTT'),
('343HH', 'Huyện Kiến Xương', '34TTT'),
('344HH', 'Huyện Vũ Thư', '34TTT'),
('347HH', 'Thành phố Phủ Lý', '35TTT'),
('349HH', 'Huyện Duy Tiên', '35TTT'),
('350HH', 'Huyện Kim Bảng', '35TTT'),
('351HH', 'Huyện Thanh Liêm', '35TTT'),
('352HH', 'Huyện Bình Lục', '35TTT'),
('353HH', 'Huyện Lý Nhân', '35TTT'),
('356HH', 'Thành phố Nam Định', '36TTT'),
('358HH', 'Huyện Mỹ Lộc', '36TTT'),
('359HH', 'Huyện Vụ Bản', '36TTT'),
('360HH', 'Huyện Ý Yên', '36TTT'),
('361HH', 'Huyện Nghĩa Hưng', '36TTT'),
('362HH', 'Huyện Nam Trực', '36TTT'),
('363HH', 'Huyện Trực Ninh', '36TTT'),
('364HH', 'Huyện Xuân Trường', '36TTT'),
('365HH', 'Huyện Giao Thủy', '36TTT'),
('366HH', 'Huyện Hải Hậu', '36TTT'),
('369HH', 'Thành phố Ninh Bình', '37TTT'),
('370HH', 'Thành phố Tam Điệp', '37TTT'),
('372HH', 'Huyện Nho Quan', '37TTT'),
('373HH', 'Huyện Gia Viễn', '37TTT'),
('374HH', 'Huyện Hoa Lư', '37TTT'),
('375HH', 'Huyện Yên Khánh', '37TTT'),
('376HH', 'Huyện Kim Sơn', '37TTT'),
('377HH', 'Huyện Yên Mô', '37TTT'),
('380HH', 'Thành phố Thanh Hóa', '38TTT'),
('381HH', 'Thị xã Bỉm Sơn', '38TTT'),
('382HH', 'Thành phố Sầm Sơn', '38TTT'),
('384HH', 'Huyện Mường Lát', '38TTT'),
('385HH', 'Huyện Quan Hóa', '38TTT'),
('386HH', 'Huyện Bá Thước', '38TTT'),
('387HH', 'Huyện Quan Sơn', '38TTT'),
('388HH', 'Huyện Lang Chánh', '38TTT'),
('389HH', 'Huyện Ngọc Lặc', '38TTT'),
('390HH', 'Huyện Cẩm Thủy', '38TTT'),
('391HH', 'Huyện Thạch Thành', '38TTT'),
('392HH', 'Huyện Hà Trung', '38TTT'),
('393HH', 'Huyện Vĩnh Lộc', '38TTT'),
('394HH', 'Huyện Yên Định', '38TTT'),
('395HH', 'Huyện Thọ Xuân', '38TTT'),
('396HH', 'Huyện Thường Xuân', '38TTT'),
('397HH', 'Huyện Triệu Sơn', '38TTT'),
('398HH', 'Huyện Thiệu Hóa', '38TTT'),
('399HH', 'Huyện Hoằng Hóa', '38TTT'),
('400HH', 'Huyện Hậu Lộc', '38TTT'),
('401HH', 'Huyện Nga Sơn', '38TTT'),
('402HH', 'Huyện Như Xuân', '38TTT'),
('403HH', 'Huyện Như Thanh', '38TTT'),
('404HH', 'Huyện Nông Cống', '38TTT'),
('405HH', 'Huyện Đông Sơn', '38TTT'),
('406HH', 'Huyện Quảng Xương', '38TTT'),
('407HH', 'Huyện Tĩnh Gia', '38TTT'),
('412HH', 'Thành phố Vinh', '40TTT'),
('413HH', 'Thị xã Cửa Lò', '40TTT'),
('414HH', 'Thị xã Thái Hòa', '40TTT'),
('415HH', 'Huyện Quế Phong', '40TTT'),
('416HH', 'Huyện Quỳ Châu', '40TTT'),
('417HH', 'Huyện Kỳ Sơn', '40TTT'),
('418HH', 'Huyện Tương Dương', '40TTT'),
('419HH', 'Huyện Nghĩa Đàn', '40TTT'),
('420HH', 'Huyện Quỳ Hợp', '40TTT'),
('421HH', 'Huyện Quỳnh Lưu', '40TTT'),
('422HH', 'Huyện Con Cuông', '40TTT'),
('423HH', 'Huyện Tân Kỳ', '40TTT'),
('424HH', 'Huyện Anh Sơn', '40TTT'),
('425HH', 'Huyện Diễn Châu', '40TTT'),
('426HH', 'Huyện Yên Thành', '40TTT'),
('427HH', 'Huyện Đô Lương', '40TTT'),
('428HH', 'Huyện Thanh Chương', '40TTT'),
('429HH', 'Huyện Nghi Lộc', '40TTT'),
('430HH', 'Huyện Nam Đàn', '40TTT'),
('431HH', 'Huyện Hưng Nguyên', '40TTT'),
('432HH', 'Thị xã Hoàng Mai', '40TTT'),
('436HH', 'Thành phố Hà Tĩnh', '42TTT'),
('437HH', 'Thị xã Hồng Lĩnh', '42TTT'),
('439HH', 'Huyện Hương Sơn', '42TTT'),
('440HH', 'Huyện Đức Thọ', '42TTT'),
('441HH', 'Huyện Vũ Quang', '42TTT'),
('442HH', 'Huyện Nghi Xuân', '42TTT'),
('443HH', 'Huyện Can Lộc', '42TTT'),
('444HH', 'Huyện Hương Khê', '42TTT'),
('445HH', 'Huyện Thạch Hà', '42TTT'),
('446HH', 'Huyện Cẩm Xuyên', '42TTT'),
('447HH', 'Huyện Kỳ Anh', '42TTT'),
('448HH', 'Huyện Lộc Hà', '42TTT'),
('449HH', 'Thị xã Kỳ Anh', '42TTT'),
('450HH', 'Thành Phố Đồng Hới', '44TTT'),
('452HH', 'Huyện Minh Hóa', '44TTT'),
('453HH', 'Huyện Tuyên Hóa', '44TTT'),
('454HH', 'Huyện Quảng Trạch', '44TTT'),
('455HH', 'Huyện Bố Trạch', '44TTT'),
('456HH', 'Huyện Quảng Ninh', '44TTT'),
('457HH', 'Huyện Lệ Thủy', '44TTT'),
('458HH', 'Thị xã Ba Đồn', '44TTT'),
('461HH', 'Thành phố Đông Hà', '45TTT'),
('462HH', 'Thị xã Quảng Trị', '45TTT'),
('464HH', 'Huyện Vĩnh Linh', '45TTT'),
('465HH', 'Huyện Hướng Hóa', '45TTT'),
('466HH', 'Huyện Gio Linh', '45TTT'),
('467HH', 'Huyện Đakrông', '45TTT'),
('468HH', 'Huyện Cam Lộ', '45TTT'),
('469HH', 'Huyện Triệu Phong', '45TTT'),
('470HH', 'Huyện Hải Lăng', '45TTT'),
('474HH', 'Thành phố Huế', '46TTT'),
('476HH', 'Huyện Phong Điền', '46TTT'),
('477HH', 'Huyện Quảng Điền', '46TTT'),
('478HH', 'Huyện Phú Vang', '46TTT'),
('479HH', 'Thị xã Hương Thủy', '46TTT'),
('480HH', 'Thị xã Hương Trà', '46TTT'),
('481HH', 'Huyện A Lưới', '46TTT'),
('482HH', 'Huyện Phú Lộc', '46TTT'),
('483HH', 'Huyện Nam Đông', '46TTT'),
('490HH', 'Quận Liên Chiểu', '48TTT'),
('491HH', 'Quận Thanh Khê', '48TTT'),
('492HH', 'Quận Hải Châu', '48TTT'),
('493HH', 'Quận Sơn Trà', '48TTT'),
('494HH', 'Quận Ngũ Hành Sơn', '48TTT'),
('495HH', 'Quận Cẩm Lệ', '48TTT'),
('497HH', 'Huyện Hòa Vang', '48TTT'),
('502HH', 'Thành phố Tam Kỳ', '49TTT'),
('503HH', 'Thành phố Hội An', '49TTT'),
('504HH', 'Huyện Tây Giang', '49TTT'),
('505HH', 'Huyện Đông Giang', '49TTT'),
('506HH', 'Huyện Đại Lộc', '49TTT'),
('507HH', 'Thị xã Điện Bàn', '49TTT'),
('508HH', 'Huyện Duy Xuyên', '49TTT'),
('509HH', 'Huyện Quế Sơn', '49TTT'),
('510HH', 'Huyện Nam Giang', '49TTT'),
('511HH', 'Huyện Phước Sơn', '49TTT'),
('512HH', 'Huyện Hiệp Đức', '49TTT'),
('513HH', 'Huyện Thăng Bình', '49TTT'),
('514HH', 'Huyện Tiên Phước', '49TTT'),
('515HH', 'Huyện Bắc Trà My', '49TTT'),
('516HH', 'Huyện Nam Trà My', '49TTT'),
('517HH', 'Huyện Núi Thành', '49TTT'),
('518HH', 'Huyện Phú Ninh', '49TTT'),
('519HH', 'Huyện Nông Sơn', '49TTT'),
('522HH', 'Thành phố Quảng Ngãi', '51TTT'),
('524HH', 'Huyện Bình Sơn', '51TTT'),
('525HH', 'Huyện Trà Bồng', '51TTT'),
('526HH', 'Huyện Tây Trà', '51TTT'),
('527HH', 'Huyện Sơn Tịnh', '51TTT'),
('528HH', 'Huyện Tư Nghĩa', '51TTT'),
('529HH', 'Huyện Sơn Hà', '51TTT'),
('530HH', 'Huyện Sơn Tây', '51TTT'),
('531HH', 'Huyện Minh Long', '51TTT'),
('532HH', 'Huyện Nghĩa Hành', '51TTT'),
('533HH', 'Huyện Mộ Đức', '51TTT'),
('534HH', 'Huyện Đức Phổ', '51TTT'),
('535HH', 'Huyện Ba Tơ', '51TTT'),
('536HH', 'Huyện Lý Sơn', '51TTT'),
('540HH', 'Thành phố Quy Nhơn', '52TTT'),
('542HH', 'Huyện An Lão', '52TTT'),
('543HH', 'Huyện Hoài Nhơn', '52TTT'),
('544HH', 'Huyện Hoài Ân', '52TTT'),
('545HH', 'Huyện Phù Mỹ', '52TTT'),
('546HH', 'Huyện Vĩnh Thạnh', '52TTT'),
('547HH', 'Huyện Tây Sơn', '52TTT'),
('548HH', 'Huyện Phù Cát', '52TTT'),
('549HH', 'Thị xã An Nhơn', '52TTT'),
('550HH', 'Huyện Tuy Phước', '52TTT'),
('551HH', 'Huyện Vân Canh', '52TTT'),
('555HH', 'Thành phố Tuy Hòa', '54TTT'),
('557HH', 'Thị xã Sông Cầu', '54TTT'),
('558HH', 'Huyện Đồng Xuân', '54TTT'),
('559HH', 'Huyện Tuy An', '54TTT'),
('560HH', 'Huyện Sơn Hòa', '54TTT'),
('561HH', 'Huyện Sông Hinh', '54TTT'),
('562HH', 'Huyện Tây Hòa', '54TTT'),
('563HH', 'Huyện Phú Hòa', '54TTT'),
('564HH', 'Huyện Đông Hòa', '54TTT'),
('568HH', 'Thành phố Nha Trang', '56TTT'),
('569HH', 'Thành phố Cam Ranh', '56TTT'),
('570HH', 'Huyện Cam Lâm', '56TTT'),
('571HH', 'Huyện Vạn Ninh', '56TTT'),
('572HH', 'Thị xã Ninh Hòa', '56TTT'),
('573HH', 'Huyện Khánh Vĩnh', '56TTT'),
('574HH', 'Huyện Diên Khánh', '56TTT'),
('575HH', 'Huyện Khánh Sơn', '56TTT'),
('576HH', 'Huyện Trường Sa', '56TTT'),
('582HH', 'Thành phố Phan Rang-Tháp Chàm', '58TTT'),
('584HH', 'Huyện Bác Ái', '58TTT'),
('585HH', 'Huyện Ninh Sơn', '58TTT'),
('586HH', 'Huyện Ninh Hải', '58TTT'),
('587HH', 'Huyện Ninh Phước', '58TTT'),
('588HH', 'Huyện Thuận Bắc', '58TTT'),
('589HH', 'Huyện Thuận Nam', '58TTT'),
('593HH', 'Thành phố Phan Thiết', '60TTT'),
('594HH', 'Thị xã La Gi', '60TTT'),
('595HH', 'Huyện Tuy Phong', '60TTT'),
('596HH', 'Huyện Bắc Bình', '60TTT'),
('597HH', 'Huyện Hàm Thuận Bắc', '60TTT'),
('598HH', 'Huyện Hàm Thuận Nam', '60TTT'),
('599HH', 'Huyện Tánh Linh', '60TTT'),
('600HH', 'Huyện Đức Linh', '60TTT'),
('601HH', 'Huyện Hàm Tân', '60TTT'),
('602HH', 'Huyện Phú Quí', '60TTT'),
('608HH', 'Thành phố Kon Tum', '62TTT'),
('610HH', 'Huyện Đắk Glei', '62TTT'),
('611HH', 'Huyện Ngọc Hồi', '62TTT'),
('612HH', 'Huyện Đắk Tô', '62TTT'),
('613HH', 'Huyện Kon Plông', '62TTT'),
('614HH', 'Huyện Kon Rẫy', '62TTT'),
('615HH', 'Huyện Đắk Hà', '62TTT'),
('616HH', 'Huyện Sa Thầy', '62TTT'),
('617HH', 'Huyện Tu Mơ Rông', '62TTT'),
('618HH', 'Huyện Ia H\' Drai', '62TTT'),
('622HH', 'Thành phố Pleiku', '64TTT'),
('623HH', 'Thị xã An Khê', '64TTT'),
('624HH', 'Thị xã Ayun Pa', '64TTT'),
('625HH', 'Huyện KBang', '64TTT'),
('626HH', 'Huyện Đăk Đoa', '64TTT'),
('627HH', 'Huyện Chư Păh', '64TTT'),
('628HH', 'Huyện Ia Grai', '64TTT'),
('629HH', 'Huyện Mang Yang', '64TTT'),
('630HH', 'Huyện Kông Chro', '64TTT'),
('631HH', 'Huyện Đức Cơ', '64TTT'),
('632HH', 'Huyện Chư Prông', '64TTT'),
('633HH', 'Huyện Chư Sê', '64TTT'),
('634HH', 'Huyện Đăk Pơ', '64TTT'),
('635HH', 'Huyện Ia Pa', '64TTT'),
('637HH', 'Huyện Krông Pa', '64TTT'),
('638HH', 'Huyện Phú Thiện', '64TTT'),
('639HH', 'Huyện Chư Pưh', '64TTT'),
('643HH', 'Thành phố Buôn Ma Thuột', '66TTT'),
('644HH', 'Thị Xã Buôn Hồ', '66TTT'),
('645HH', 'Huyện Ea H\'leo', '66TTT'),
('646HH', 'Huyện Ea Súp', '66TTT'),
('647HH', 'Huyện Buôn Đôn', '66TTT'),
('648HH', 'Huyện Cư M\'gar', '66TTT'),
('649HH', 'Huyện Krông Búk', '66TTT'),
('650HH', 'Huyện Krông Năng', '66TTT'),
('651HH', 'Huyện Ea Kar', '66TTT'),
('652HH', 'Huyện M\'Đrắk', '66TTT'),
('653HH', 'Huyện Krông Bông', '66TTT'),
('654HH', 'Huyện Krông Pắc', '66TTT'),
('655HH', 'Huyện Krông A Na', '66TTT'),
('656HH', 'Huyện Lắk', '66TTT'),
('657HH', 'Huyện Cư Kuin', '66TTT'),
('660HH', 'Thị xã Gia Nghĩa', '67TTT'),
('661HH', 'Huyện Đăk Glong', '67TTT'),
('662HH', 'Huyện Cư Jút', '67TTT'),
('663HH', 'Huyện Đắk Mil', '67TTT'),
('664HH', 'Huyện Krông Nô', '67TTT'),
('665HH', 'Huyện Đắk Song', '67TTT'),
('666HH', 'Huyện Đắk R\'Lấp', '67TTT'),
('667HH', 'Huyện Tuy Đức', '67TTT'),
('672HH', 'Thành phố Đà Lạt', '68TTT'),
('673HH', 'Thành phố Bảo Lộc', '68TTT'),
('674HH', 'Huyện Đam Rông', '68TTT'),
('675HH', 'Huyện Lạc Dương', '68TTT'),
('676HH', 'Huyện Lâm Hà', '68TTT'),
('677HH', 'Huyện Đơn Dương', '68TTT'),
('678HH', 'Huyện Đức Trọng', '68TTT'),
('679HH', 'Huyện Di Linh', '68TTT'),
('680HH', 'Huyện Bảo Lâm', '68TTT'),
('681HH', 'Huyện Đạ Huoai', '68TTT'),
('682HH', 'Huyện Đạ Tẻh', '68TTT'),
('683HH', 'Huyện Cát Tiên', '68TTT'),
('688HH', 'Thị xã Phước Long', '70TTT'),
('689HH', 'Thị xã Đồng Xoài', '70TTT'),
('690HH', 'Thị xã Bình Long', '70TTT'),
('691HH', 'Huyện Bù Gia Mập', '70TTT'),
('692HH', 'Huyện Lộc Ninh', '70TTT'),
('693HH', 'Huyện Bù Đốp', '70TTT'),
('694HH', 'Huyện Hớn Quản', '70TTT'),
('695HH', 'Huyện Đồng Phú', '70TTT'),
('696HH', 'Huyện Bù Đăng', '70TTT'),
('697HH', 'Huyện Chơn Thành', '70TTT'),
('698HH', 'Huyện Phú Riềng', '70TTT'),
('703HH', 'Thành phố Tây Ninh', '72TTT'),
('705HH', 'Huyện Tân Biên', '72TTT'),
('706HH', 'Huyện Tân Châu', '72TTT'),
('707HH', 'Huyện Dương Minh Châu', '72TTT'),
('708HH', 'Huyện Châu Thành', '72TTT'),
('709HH', 'Huyện Hòa Thành', '72TTT'),
('710HH', 'Huyện Gò Dầu', '72TTT'),
('711HH', 'Huyện Bến Cầu', '72TTT'),
('712HH', 'Huyện Trảng Bàng', '72TTT'),
('718HH', 'Thành phố Thủ Dầu Một', '74TTT'),
('719HH', 'Huyện Bàu Bàng', '74TTT'),
('720HH', 'Huyện Dầu Tiếng', '74TTT'),
('721HH', 'Thị xã Bến Cát', '74TTT'),
('722HH', 'Huyện Phú Giáo', '74TTT'),
('723HH', 'Thị xã Tân Uyên', '74TTT'),
('724HH', 'Thị xã Dĩ An', '74TTT'),
('725HH', 'Thị xã Thuận An', '74TTT'),
('726HH', 'Huyện Bắc Tân Uyên', '74TTT'),
('731HH', 'Thành phố Biên Hòa', '75TTT'),
('732HH', 'Thị xã Long Khánh', '75TTT'),
('734HH', 'Huyện Tân Phú', '75TTT'),
('735HH', 'Huyện Vĩnh Cửu', '75TTT'),
('736HH', 'Huyện Định Quán', '75TTT'),
('737HH', 'Huyện Trảng Bom', '75TTT'),
('738HH', 'Huyện Thống Nhất', '75TTT'),
('739HH', 'Huyện Cẩm Mỹ', '75TTT'),
('740HH', 'Huyện Long Thành', '75TTT'),
('741HH', 'Huyện Xuân Lộc', '75TTT'),
('742HH', 'Huyện Nhơn Trạch', '75TTT'),
('747HH', 'Thành phố Vũng Tàu', '77TTT'),
('748HH', 'Thành phố Bà Rịa', '77TTT'),
('750HH', 'Huyện Châu Đức', '77TTT'),
('751HH', 'Huyện Xuyên Mộc', '77TTT'),
('752HH', 'Huyện Long Điền', '77TTT'),
('753HH', 'Huyện Đất Đỏ', '77TTT'),
('754HH', 'Huyện Tân Thành', '77TTT'),
('755HH', 'Huyện Côn Đảo', '77TTT'),
('760HH', 'Quận 1', '79TTT'),
('761HH', 'Quận 12', '79TTT'),
('762HH', 'Quận Thủ Đức', '79TTT'),
('763HH', 'Quận 9', '79TTT'),
('764HH', 'Quận Gò Vấp', '79TTT'),
('765HH', 'Quận Bình Thạnh', '79TTT'),
('766HH', 'Quận Tân Bình', '79TTT'),
('767HH', 'Quận Tân Phú', '79TTT'),
('768HH', 'Quận Phú Nhuận', '79TTT'),
('769HH', 'Quận 2', '79TTT'),
('770HH', 'Quận 3', '79TTT'),
('771HH', 'Quận 10', '79TTT'),
('772HH', 'Quận 11', '79TTT'),
('773HH', 'Quận 4', '79TTT'),
('774HH', 'Quận 5', '79TTT'),
('775HH', 'Quận 6', '79TTT'),
('776HH', 'Quận 8', '79TTT'),
('777HH', 'Quận Bình Tân', '79TTT'),
('778HH', 'Quận 7', '79TTT'),
('783HH', 'Huyện Củ Chi', '79TTT'),
('784HH', 'Huyện Hóc Môn', '79TTT'),
('785HH', 'Huyện Bình Chánh', '79TTT'),
('786HH', 'Huyện Nhà Bè', '79TTT'),
('787HH', 'Huyện Cần Giờ', '79TTT'),
('794HH', 'Thành phố Tân An', '80TTT'),
('795HH', 'Thị xã Kiến Tường', '80TTT'),
('796HH', 'Huyện Tân Hưng', '80TTT'),
('797HH', 'Huyện Vĩnh Hưng', '80TTT'),
('798HH', 'Huyện Mộc Hóa', '80TTT'),
('799HH', 'Huyện Tân Thạnh', '80TTT'),
('800HH', 'Huyện Thạnh Hóa', '80TTT'),
('801HH', 'Huyện Đức Huệ', '80TTT'),
('802HH', 'Huyện Đức Hòa', '80TTT'),
('803HH', 'Huyện Bến Lức', '80TTT'),
('804HH', 'Huyện Thủ Thừa', '80TTT'),
('805HH', 'Huyện Tân Trụ', '80TTT'),
('806HH', 'Huyện Cần Đước', '80TTT'),
('807HH', 'Huyện Cần Giuộc', '80TTT'),
('808HH', 'Huyện Châu Thành', '80TTT'),
('815HH', 'Thành phố Mỹ Tho', '82TTT'),
('816HH', 'Thị xã Gò Công', '82TTT'),
('817HH', 'Thị xã Cai Lậy', '82TTT'),
('818HH', 'Huyện Tân Phước', '82TTT'),
('819HH', 'Huyện Cái Bè', '82TTT'),
('820HH', 'Huyện Cai Lậy', '82TTT'),
('821HH', 'Huyện Châu Thành', '82TTT'),
('822HH', 'Huyện Chợ Gạo', '82TTT'),
('823HH', 'Huyện Gò Công Tây', '82TTT'),
('824HH', 'Huyện Gò Công Đông', '82TTT'),
('825HH', 'Huyện Tân Phú Đông', '82TTT'),
('829HH', 'Thành phố Bến Tre', '83TTT'),
('831HH', 'Huyện Châu Thành', '83TTT'),
('832HH', 'Huyện Chợ Lách', '83TTT'),
('833HH', 'Huyện Mỏ Cày Nam', '83TTT'),
('834HH', 'Huyện Giồng Trôm', '83TTT'),
('835HH', 'Huyện Bình Đại', '83TTT'),
('836HH', 'Huyện Ba Tri', '83TTT'),
('837HH', 'Huyện Thạnh Phú', '83TTT'),
('838HH', 'Huyện Mỏ Cày Bắc', '83TTT'),
('842HH', 'Thành phố Trà Vinh', '84TTT'),
('844HH', 'Huyện Càng Long', '84TTT'),
('845HH', 'Huyện Cầu Kè', '84TTT'),
('846HH', 'Huyện Tiểu Cần', '84TTT'),
('847HH', 'Huyện Châu Thành', '84TTT'),
('848HH', 'Huyện Cầu Ngang', '84TTT'),
('849HH', 'Huyện Trà Cú', '84TTT'),
('850HH', 'Huyện Duyên Hải', '84TTT'),
('851HH', 'Thị xã Duyên Hải', '84TTT'),
('855HH', 'Thành phố Vĩnh Long', '86TTT'),
('857HH', 'Huyện Long Hồ', '86TTT'),
('858HH', 'Huyện Mang Thít', '86TTT'),
('859HH', 'Huyện Vũng Liêm', '86TTT'),
('860HH', 'Huyện Tam Bình', '86TTT'),
('861HH', 'Thị xã Bình Minh', '86TTT'),
('862HH', 'Huyện Trà Ôn', '86TTT'),
('863HH', 'Huyện Bình Tân', '86TTT'),
('866HH', 'Thành phố Cao Lãnh', '87TTT'),
('867HH', 'Thành phố Sa Đéc', '87TTT'),
('868HH', 'Thị xã Hồng Ngự', '87TTT'),
('869HH', 'Huyện Tân Hồng', '87TTT'),
('870HH', 'Huyện Hồng Ngự', '87TTT'),
('871HH', 'Huyện Tam Nông', '87TTT'),
('872HH', 'Huyện Tháp Mười', '87TTT'),
('873HH', 'Huyện Cao Lãnh', '87TTT'),
('874HH', 'Huyện Thanh Bình', '87TTT'),
('875HH', 'Huyện Lấp Vò', '87TTT'),
('876HH', 'Huyện Lai Vung', '87TTT'),
('877HH', 'Huyện Châu Thành', '87TTT'),
('883HH', 'Thành phố Long Xuyên', '89TTT'),
('884HH', 'Thành phố Châu Đốc', '89TTT'),
('886HH', 'Huyện An Phú', '89TTT'),
('887HH', 'Thị xã Tân Châu', '89TTT'),
('888HH', 'Huyện Phú Tân', '89TTT'),
('889HH', 'Huyện Châu Phú', '89TTT'),
('890HH', 'Huyện Tịnh Biên', '89TTT'),
('891HH', 'Huyện Tri Tôn', '89TTT'),
('892HH', 'Huyện Châu Thành', '89TTT'),
('893HH', 'Huyện Chợ Mới', '89TTT'),
('894HH', 'Huyện Thoại Sơn', '89TTT'),
('899HH', 'Thành phố Rạch Giá', '91TTT'),
('900HH', 'Thị xã Hà Tiên', '91TTT'),
('902HH', 'Huyện Kiên Lương', '91TTT'),
('903HH', 'Huyện Hòn Đất', '91TTT'),
('904HH', 'Huyện Tân Hiệp', '91TTT'),
('905HH', 'Huyện Châu Thành', '91TTT'),
('906HH', 'Huyện Giồng Riềng', '91TTT'),
('907HH', 'Huyện Gò Quao', '91TTT'),
('908HH', 'Huyện An Biên', '91TTT'),
('909HH', 'Huyện An Minh', '91TTT'),
('910HH', 'Huyện Vĩnh Thuận', '91TTT'),
('911HH', 'Huyện Phú Quốc', '91TTT'),
('912HH', 'Huyện Kiên Hải', '91TTT'),
('913HH', 'Huyện U Minh Thượng', '91TTT'),
('914HH', 'Huyện Giang Thành', '91TTT'),
('916HH', 'Quận Ninh Kiều', '92TTT'),
('917HH', 'Quận Ô Môn', '92TTT'),
('918HH', 'Quận Bình Thuỷ', '92TTT'),
('919HH', 'Quận Cái Răng', '92TTT'),
('923HH', 'Quận Thốt Nốt', '92TTT'),
('924HH', 'Huyện Vĩnh Thạnh', '92TTT'),
('925HH', 'Huyện Cờ Đỏ', '92TTT'),
('926HH', 'Huyện Phong Điền', '92TTT'),
('927HH', 'Huyện Thới Lai', '92TTT'),
('930HH', 'Thành phố Vị Thanh', '93TTT'),
('931HH', 'Thị xã Ngã Bảy', '93TTT'),
('932HH', 'Huyện Châu Thành A', '93TTT'),
('933HH', 'Huyện Châu Thành', '93TTT'),
('934HH', 'Huyện Phụng Hiệp', '93TTT'),
('935HH', 'Huyện Vị Thủy', '93TTT'),
('936HH', 'Huyện Long Mỹ', '93TTT'),
('937HH', 'Thị xã Long Mỹ', '93TTT'),
('941HH', 'Thành phố Sóc Trăng', '94TTT'),
('942HH', 'Huyện Châu Thành', '94TTT'),
('943HH', 'Huyện Kế Sách', '94TTT'),
('944HH', 'Huyện Mỹ Tú', '94TTT'),
('945HH', 'Huyện Cù Lao Dung', '94TTT'),
('946HH', 'Huyện Long Phú', '94TTT'),
('947HH', 'Huyện Mỹ Xuyên', '94TTT'),
('948HH', 'Thị xã Ngã Năm', '94TTT'),
('949HH', 'Huyện Thạnh Trị', '94TTT'),
('950HH', 'Thị xã Vĩnh Châu', '94TTT'),
('951HH', 'Huyện Trần Đề', '94TTT'),
('954HH', 'Thành phố Bạc Liêu', '95TTT'),
('956HH', 'Huyện Hồng Dân', '95TTT'),
('957HH', 'Huyện Phước Long', '95TTT'),
('958HH', 'Huyện Vĩnh Lợi', '95TTT'),
('959HH', 'Thị xã Giá Rai', '95TTT'),
('960HH', 'Huyện Đông Hải', '95TTT'),
('961HH', 'Huyện Hòa Bình', '95TTT'),
('964HH', 'Thành phố Cà Mau', '96TTT'),
('966HH', 'Huyện U Minh', '96TTT'),
('967HH', 'Huyện Thới Bình', '96TTT'),
('968HH', 'Huyện Trần Văn Thời', '96TTT'),
('969HH', 'Huyện Cái Nước', '96TTT'),
('970HH', 'Huyện Đầm Dơi', '96TTT'),
('971HH', 'Huyện Năm Căn', '96TTT'),
('972HH', 'Huyện Phú Tân', '96TTT'),
('973HH', 'Huyện Ngọc Hiển', '96TTT');

-- --------------------------------------------------------

--
-- Table structure for table `vn_province`
--

CREATE TABLE `vn_province` (
  `provinceid` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vn_province`
--

INSERT INTO `vn_province` (`provinceid`, `name`, `order`) VALUES
('01TTT', 'Thành phố Hà Nội', 2),
('02TTT', 'Tỉnh Hà Giang', 0),
('04TTT', 'Tỉnh Cao Bằng', 0),
('06TTT', 'Tỉnh Bắc Kạn', 0),
('08TTT', 'Tỉnh Tuyên Quang', 0),
('10TTT', 'Tỉnh Lào Cai', 0),
('11TTT', 'Tỉnh Điện Biên', 0),
('12TTT', 'Tỉnh Lai Châu', 0),
('14TTT', 'Tỉnh Sơn La', 0),
('15TTT', 'Tỉnh Yên Bái', 0),
('17TTT', 'Tỉnh Hòa Bình', 0),
('19TTT', 'Tỉnh Thái Nguyên', 0),
('20TTT', 'Tỉnh Lạng Sơn', 0),
('22TTT', 'Tỉnh Quảng Ninh', 0),
('24TTT', 'Tỉnh Bắc Giang', 0),
('25TTT', 'Tỉnh Phú Thọ', 0),
('26TTT', 'Tỉnh Vĩnh Phúc', 0),
('27TTT', 'Tỉnh Bắc Ninh', 0),
('30TTT', 'Tỉnh Hải Dương', 0),
('31TTT', 'Thành phố Hải Phòng', 0),
('33TTT', 'Tỉnh Hưng Yên', 0),
('34TTT', 'Tỉnh Thái Bình', 0),
('35TTT', 'Tỉnh Hà Nam', 0),
('36TTT', 'Tỉnh Nam Định', 0),
('37TTT', 'Tỉnh Ninh Bình', 0),
('38TTT', 'Tỉnh Thanh Hóa', 0),
('40TTT', 'Tỉnh Nghệ An', 0),
('42TTT', 'Tỉnh Hà Tĩnh', 0),
('44TTT', 'Tỉnh Quảng Bình', 0),
('45TTT', 'Tỉnh Quảng Trị', 0),
('46TTT', 'Tỉnh Thừa Thiên Huế', 0),
('48TTT', 'Thành phố Đà Nẵng', 0),
('49TTT', 'Tỉnh Quảng Nam', 0),
('51TTT', 'Tỉnh Quảng Ngãi', 0),
('52TTT', 'Tỉnh Bình Định', 0),
('54TTT', 'Tỉnh Phú Yên', 0),
('56TTT', 'Tỉnh Khánh Hòa', 0),
('58TTT', 'Tỉnh Ninh Thuận', 0),
('60TTT', 'Tỉnh Bình Thuận', 0),
('62TTT', 'Tỉnh Kon Tum', 0),
('64TTT', 'Tỉnh Gia Lai', 0),
('66TTT', 'Tỉnh Đắk Lắk', 0),
('67TTT', 'Tỉnh Đắk Nông', 0),
('68TTT', 'Tỉnh Lâm Đồng', 0),
('70TTT', 'Tỉnh Bình Phước', 0),
('72TTT', 'Tỉnh Tây Ninh', 0),
('74TTT', 'Tỉnh Bình Dương', 0),
('75TTT', 'Tỉnh Đồng Nai', 0),
('77TTT', 'Tỉnh Bà Rịa - Vũng Tàu', 0),
('79TTT', 'Thành phố Hồ Chí Minh', 1),
('80TTT', 'Tỉnh Long An', 0),
('82TTT', 'Tỉnh Tiền Giang', 0),
('83TTT', 'Tỉnh Bến Tre', 0),
('84TTT', 'Tỉnh Trà Vinh', 0),
('86TTT', 'Tỉnh Vĩnh Long', 0),
('87TTT', 'Tỉnh Đồng Tháp', 0),
('89TTT', 'Tỉnh An Giang', 0),
('91TTT', 'Tỉnh Kiên Giang', 0),
('92TTT', 'Thành phố Cần Thơ', 0),
('93TTT', 'Tỉnh Hậu Giang', 0),
('94TTT', 'Tỉnh Sóc Trăng', 0),
('95TTT', 'Tỉnh Bạc Liêu', 0),
('96TTT', 'Tỉnh Cà Mau', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vn_village`
--

CREATE TABLE `vn_village` (
  `villageid` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wardid` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `slide`
--
ALTER TABLE `slide`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `slide_translate`
--
ALTER TABLE `slide_translate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
