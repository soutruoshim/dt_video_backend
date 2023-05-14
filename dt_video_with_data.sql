-- phpMyAdmin SQL Dump
-- version 4.9.7deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 08, 2023 at 01:41 PM
-- Server version: 8.0.27-0ubuntu0.21.04.1
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dt_video`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `name`, `email`, `password`, `image`, `status`, `created_at`) VALUES
(2, 'Divinetechs', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', '', 1, '2020-08-08 15:34:53');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_album`
--

CREATE TABLE `tbl_album` (
  `id` int NOT NULL,
  `video_ids` text NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_album`
--

INSERT INTO `tbl_album` (`id`, `video_ids`, `name`, `image`) VALUES
(1, '19,17,16,13', 'Solo Dance', '1662375333.jpeg'),
(3, '17', 'Classical', '1662382837.jpg'),
(4, '14', 'comedy', '1662373617.jpg'),
(5, '16', 'metrimonial', '1662373710.jpeg'),
(8, '5', 'Cricket', '1662375696.jpg'),
(9, '19', 'Holliwood', '1662375826.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_artist`
--

CREATE TABLE `tbl_artist` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `bio` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `address` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `image` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_artist`
--

INSERT INTO `tbl_artist` (`id`, `name`, `bio`, `address`, `image`, `status`, `created_at`) VALUES
(1, 'Michael Jackson', 'Jay Vasavada is Gujarati language writer, orator and columnist from India. Born in Bhavnagar and brought up in Gondal, Gujarat, he writes columns in various publications since 1996. He has published several books compiling his columns.', 'Far Rockaway, NY', '1604136983.jpg', 0, '2020-07-19 08:57:50'),
(5, 'Birju Maharaj', 'Jay Vasavada is Gujarati language writer, orator and columnist from India. Born in Bhavnagar and brought up in Gondal, Gujarat, he writes columns in various publications since 1996. He has published several books compiling his columns.', 'Far Rockaway, NY', '1604148347.jpg', 0, '2020-07-19 08:57:50'),
(7, 'Prabhudeva', 'Jay Vasavada is Gujarati language writer, orator and columnist from India. Born in Bhavnagar and brought up in Gondal, Gujarat, he writes columns in various publications since 1996. He has published several books compiling his columns.', 'Far Rockaway, NY', '1662373151.jpg', 0, '2020-07-19 08:57:50'),
(9, 'Sakti Mohan', 'The man behind much loved Gujarati songs like Puchhine thay nahi prem, Mann masti ane motor cycle, Bhaasha Mari Gujarati Chhe, O Rangrasiya and many more Shukla is gifted with the art of language.', 'San Francisco ,California', '1604147042.jpg', 0, '2020-07-19 08:57:50'),
(10, 'Nakul Dev Mahajan', 'Jay Vasavada is Gujarati language writer, orator and columnist from India. Born in Bhavnagar and brought up in Gondal, Gujarat, he writes columns in various publications since 1996. He has published several books compiling his columns.', 'Far Rockaway, NY', '1604147963.jpg', 0, '2020-07-19 08:57:50'),
(11, 'Remo D\'Souza', 'D\'Souza hails from Olavakkode, Palakkad, Kerala, and was born on April 2, 1974 in Bangalore to K. Gopi, a chef in the Indian Air Force, and Madhvi Laxmi. He has an elder brother, Ganesh Gopi, and four sisters. He did his schooling at the Air Force School, Jamnagar, . During his school days, he was an athlete and won prizes in the 100 meter race.', 'Los Angeles', '1604148394.jpg', 0, '2020-07-19 08:57:50'),
(12, 'Sujata Mohapatra', 'Jay Vasavada is Gujarati language writer, orator and columnist from India. Born in Bhavnagar and brought up in Gondal, Gujarat, he writes columns in various publications since 1996. He has published several books compiling his columns.', 'Far Rockaway, YK', '1604148693.jpg', 0, '2020-07-19 08:57:50'),
(13, 'Bosco Martis', 'Bosco–Caesar is an Indian choreographer duo who work in Bollywood. They are Bosco Martis and Caesar Gonsalves, who have together worked on 200 songs and about 75 films. They run the Bosco Caesar Dance Company in Brampton, Scarborough, Mumbai, Phoolbagan, and Salt Lake in Kolkata.', '123', '1604146837.jpeg', 1, '2020-08-10 12:12:25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int NOT NULL,
  `name` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `image` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `name`, `image`, `status`, `created_at`) VALUES
(4, 'Comic', '1662375317.jpg', 2147483647, '2022-02-01 17:41:33'),
(5, 'Dance', '1662816466.jpg', 2147483647, '2022-02-01 17:41:36'),
(6, 'Entertainment', '1662375035.jpg', 2147483647, '2022-02-01 17:41:39'),
(7, 'Business', '1662374974.jpg', 2147483647, '2022-02-01 17:41:42');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comment`
--

CREATE TABLE `tbl_comment` (
  `id` int NOT NULL,
  `video_id` int NOT NULL,
  `comment` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `user_id` int NOT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_comment`
--

INSERT INTO `tbl_comment` (`id`, `video_id`, `comment`, `user_id`, `status`) VALUES
(1, 1, 'retertreter', 2, 0),
(2, 19, 'nice', 171, 0),
(3, 19, 'nice', 171, 0),
(4, 19, 'nice', 171, 0),
(5, 19, 'nice', 171, 0),
(6, 1, 'nice', 2, 0),
(7, 19, 'good', 171, 0),
(8, 19, 'beautiful ', 171, 0),
(9, 5, 'good work ', 174, 0),
(10, 20, 'retertreter', 175, 0),
(11, 3, 'retertreter', 175, 0),
(12, 20, 'retertreter', 2, 0),
(13, 20, 'retertreter12312', 175, 0),
(14, 20, 'This is a Testing COmments', 175, 0),
(15, 20, 'This is a Testing COmments', 174, 0),
(16, 20, 'This is again Testing comments', 175, 0),
(17, 20, 'This is Testing Comment 1', 175, 0),
(18, 20, 'This is Testing Comment 1', 175, 0),
(19, 20, 'This is Testing Comment 1', 175, 0),
(20, 20, 'asasdasd', 175, 0),
(21, 20, 'asasdasd', 175, 0),
(22, 20, 'nice', 174, 0),
(23, 3, 'boom', 183, 0),
(24, 3, 'boom', 183, 0),
(25, 11, 'testt', 187, 0),
(26, 19, 'hi', 204, 0),
(27, 3, 'juvvyvuv', 181, 0),
(28, 23, 'test', 174, 0),
(29, 19, 'nice', 174, 0),
(30, 3, 'gjkkkgf', 239, 0),
(31, 3, 'ghhjj', 239, 0),
(32, 1, 'yuk huik huio ', 239, 0),
(33, 1, 'tyikk', 239, 0),
(34, 23, 'tttt', 239, 0),
(35, 24, 'ghjkl', 239, 0),
(36, 3, 'hi', 241, 0),
(37, 6, 'by to ghggf', 243, 0),
(38, 25, 'salut', 244, 0),
(39, 6, 'hi', 241, 0),
(40, 23, 'test', 245, 0),
(41, 28, 'test', 181, 0),
(42, 1, 'test 1', 181, 0),
(43, 1, 'test', 258, 0),
(44, 1, 'hhhhhh', 219, 0),
(45, 3, 'y es', 290, 0),
(46, 20, 'test ', 293, 0),
(47, 19, 'oi', 304, 0),
(48, 20, 'sabir', 316, 0),
(49, 20, 'kkj', 318, 0),
(50, 3, 'sabir', 318, 0),
(51, 3, 'ggyukuk', 322, 0),
(52, 20, 'sdhsrnrtn', 322, 0),
(53, 12, 'nice', 350, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_currency`
--

CREATE TABLE `tbl_currency` (
  `id` int NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `code` varchar(3) DEFAULT NULL,
  `symbol` varchar(5) DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tbl_currency`
--

INSERT INTO `tbl_currency` (`id`, `name`, `code`, `symbol`, `status`) VALUES
(2, 'Dollars', 'USD', '$', 0),
(11, 'Euro', 'EUR', '€', 1),
(50, 'Pounds', 'IMP', '£', 0),
(113, 'Rupees', 'INR', '₹', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_favorite`
--

CREATE TABLE `tbl_favorite` (
  `id` int NOT NULL,
  `video_id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_favorite`
--

INSERT INTO `tbl_favorite` (`id`, `video_id`, `user_id`) VALUES
(2, 14, 6),
(7, 17, 17),
(9, 7, 18),
(10, 18, 14),
(11, 1, 11),
(12, 18, 25),
(13, 1, 26),
(14, 5, 26),
(15, 11, 27),
(16, 17, 29),
(17, 18, 37),
(18, 3, 45),
(19, 1, 14),
(20, 1, 117),
(34, 1, 1),
(73, 4, 175),
(79, 1, 2),
(81, 1, 175),
(89, 17, 175),
(96, 3, 175),
(99, 16, 190),
(100, 5, 190),
(101, 3, 202),
(102, 19, 204),
(103, 3, 181),
(104, 3, 214),
(105, 23, 226),
(107, 23, 232),
(112, 24, 239),
(113, 3, 241),
(115, 3, 245),
(118, 3, 243),
(121, 1, 242),
(122, 17, 258),
(126, 1, 219),
(130, 3, 278),
(131, 3, 290),
(132, 17, 290),
(133, 19, 291),
(135, 19, 304),
(140, 6, 264),
(141, 3, 338),
(144, 17, 3),
(145, 20, 338),
(148, 1, 348),
(149, 1, 352);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_follow`
--

CREATE TABLE `tbl_follow` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `artist_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_follow`
--

INSERT INTO `tbl_follow` (`id`, `user_id`, `artist_id`) VALUES
(4, 2, 1),
(5, 3, 5),
(6, 3, 2),
(7, 175, 7),
(12, 175, 5),
(18, 175, 1),
(27, 81, 11),
(28, 183, 10),
(29, 187, 10),
(32, 190, 1),
(34, 200, 1),
(35, 204, 10),
(36, 211, 10),
(38, 181, 10),
(39, 214, 10),
(40, 222, 5),
(41, 226, 11),
(42, 229, 10),
(46, 174, 1),
(47, 206, 13),
(50, 239, 5),
(51, 241, 10),
(52, 243, 1),
(53, 244, 10),
(55, 245, 10),
(56, 243, 5),
(57, 242, 13),
(60, 227, 5),
(65, 81, 1),
(66, 242, 1),
(67, 254, 10),
(70, 219, 9),
(71, 219, 10),
(72, 171, 10),
(75, 270, 10),
(81, 282, 10),
(82, 288, 1),
(84, 290, 10),
(86, 291, 7),
(96, 328, 1),
(98, 329, 1),
(101, 350, 5),
(102, 352, 7);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_general_setting`
--

CREATE TABLE `tbl_general_setting` (
  `id` int NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_general_setting`
--

INSERT INTO `tbl_general_setting` (`id`, `key`, `value`) VALUES
(10, 'host_email', 'support@divinetechs.com'),
(11, 'app_name', 'DTVideo'),
(12, 'app_desripation', 'DTVideo - Multi purpose video application ( YouTube + External video + vimeo )'),
(13, 'app_logo', '1662958498.png'),
(14, 'app_version', '1.0'),
(15, 'Author', 'DivineTechs'),
(16, 'contact', '+91 7984859403'),
(17, 'email', 'support@divinetechs.com'),
(18, 'website', 'www.divinetechs.com'),
(19, 'privacy_policy', 'undefined'),
(20, 'publisher_id', 'android 1'),
(21, 'banner_ad', 'yes'),
(22, 'banner_adid', ''),
(23, 'interstital_ad', 'yes'),
(24, 'interstital_adid', ''),
(25, 'interstital_adclick', '1'),
(26, 'onesignal_apid', '22222'),
(27, 'onesignal_rest_key', '124124124124214'),
(28, 'custom_ads', 'no'),
(29, 'custom_image', 'Google-AdMob-Tutorial-Result1576501169.png'),
(30, 'paypal_name', 'DivineTechs'),
(31, 'paypal_client_id', ''),
(35, 'purchase_code', ''),
(36, 'package_name', ''),
(37, 'ios_publisher_id', 'ios 1'),
(38, 'ios_banner_ad', 'yes'),
(39, 'ios_interstital_ad', 'yes'),
(40, 'ios_banner_adid', ''),
(41, 'ios_interstital_adid', ''),
(42, 'ios_interstital_adclick', '1'),
(43, 'reward_ad', 'yes'),
(44, 'reward_adid', ''),
(45, 'reward_adclick', '1'),
(46, 'ios_reward_ad', 'yes'),
(47, 'ios_reward_adid', ''),
(48, 'ios_reward_adclick', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_like`
--

CREATE TABLE `tbl_like` (
  `id` int NOT NULL,
  `video_id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_like`
--

INSERT INTO `tbl_like` (`id`, `video_id`, `user_id`) VALUES
(1, 3, 2),
(2, 14, 6),
(7, 17, 17),
(9, 7, 18),
(10, 18, 14),
(11, 1, 11),
(12, 18, 25),
(13, 1, 26),
(14, 5, 26),
(15, 11, 27),
(16, 17, 29),
(17, 18, 37),
(18, 3, 45),
(19, 1, 14),
(20, 1, 117),
(33, 17, 3),
(35, 1, 2),
(36, 20, 175);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notification`
--

CREATE TABLE `tbl_notification` (
  `id` int NOT NULL,
  `app_id` varchar(255) NOT NULL,
  `included_segments` varchar(255) NOT NULL,
  `data` text NOT NULL,
  `headings` varchar(255) NOT NULL,
  `contents` text NOT NULL,
  `big_picture` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;


--
-- Dumping data for table `tbl_notification`
--

INSERT INTO `tbl_notification` (`id`, `app_id`, `included_segments`, `data`, `headings`, `contents`, `big_picture`, `created_at`) VALUES
(1, '22222', 'All', 'bar', 'tyj', 'hj', '', '2022-09-15 05:34:05'),
(2, '22222', 'All', 'bar', 'fdfsdfxc ', 'dassadasda aasdas asdasdas sadasdas', '1664437504.jpeg', '2022-09-29 07:45:04'),
(3, '22222', 'All', 'bar', 'Test Test Test Test Test Test Test Test ', 'Test Test Test Test Test Test Test Test Test Test Test Test Test ', '', '2022-09-29 07:46:34'),
(4, '22222', 'All', 'bar', 'Test Test Test Test Test Test ', 'Test Test Test Test Test Test Test Test Test Test Test Test ', '1664437688.png', '2022-09-29 07:48:09'),
(5, '22222', 'All', 'bar', 'rhrty', 'rtyrty', '', '2023-01-16 06:59:46'),
(6, '22222', 'All', 'bar', 'asdfghjkl', 'sdfghjkl', '', '2023-02-16 07:21:54'),
(7, '22222', 'All', 'bar', 'Salut', 'Coucou', '1678166556.png', '2023-03-07 05:22:36'),
(8, '22222', 'All', 'bar', 'dsgfds', 'fgdsfsdf', '', '2023-03-21 00:57:27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_package`
--

CREATE TABLE `tbl_package` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `type` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `image` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `product_package` varchar(255) NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_package`
--

INSERT INTO `tbl_package` (`id`, `name`, `type`, `price`, `time`, `image`, `product_package`, `status`, `created_at`) VALUES
(5, 'Monthly', 'month', '10', '1', '1669441918.png', 'android.test.purchased', 0, '2020-08-21 11:13:41'),
(6, 'Quaterlly', 'month', '30', '3', '1669441909.png', 'android.test.purchased', 0, '2020-08-22 09:41:17'),
(7, 'Half-Year', 'month', '50', '6', '1669441899.png', 'android.test.purchased', 0, '2020-08-22 09:43:04'),
(8, 'Yearlly', 'year', '80', '1', '1669441889.png', 'android.test.purchased', 0, '2020-08-22 09:43:28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_page`
--

CREATE TABLE `tbl_page` (
  `id` int NOT NULL,
  `page_name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `tbl_page`
--

INSERT INTO `tbl_page` (`id`, `page_name`, `title`, `description`, `status`) VALUES
(1, 'about-us', 'About Us', 'About Us', 1),
(2, 'privacy-policy', 'Privacy Policy', 'PRIVACY POLICYPRIVACY POLICYPRIVACY POLICYPRIVACY POLICY', 1),
(3, 'terms-and-conditions', 'terms-and-conditions', '<h1>Lorem ipsum dolor sit amet consectetuer adipiscing \r\nelit</h1>\r\n\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing \r\nelit. Aenean commodo ligula eget dolor. Aenean massa \r\n<strong>strong</strong>. Cum sociis natoque penatibus \r\net magnis dis parturient montes, nascetur ridiculus \r\nmus. Donec quam felis, ultricies nec, pellentesque \r\neu, pretium quis, sem. Nulla consequat massa quis \r\nenim. Donec pede justo, fringilla vel, aliquet nec, \r\nvulputate eget, arcu. In enim justo, rhoncus ut, \r\nimperdiet a, venenatis vitae, justo. Nullam dictum \r\nfelis eu pede <a class=\"external ext\" href=\"#\">link</a> \r\nmollis pretium. Integer tincidunt. Cras dapibus. \r\nVivamus elementum semper nisi. Aenean vulputate \r\neleifend tellus. Aenean leo ligula, porttitor eu, \r\nconsequat vitae, eleifend ac, enim. Aliquam lorem ante, \r\ndapibus in, viverra quis, feugiat a, tellus. Phasellus \r\nviverra nulla ut metus varius laoreet. Quisque rutrum. \r\nAenean imperdiet. Etiam ultricies nisi vel augue. \r\nCurabitur ullamcorper ultricies nisi.</p>\r\n\r\n\r\n<h1>Lorem ipsum dolor sit amet consectetuer adipiscing \r\nelit</h1>\r\n\r\n\r\n<h2>Aenean commodo ligula eget dolor aenean massa</h2>\r\n\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing \r\nelit. Aenean commodo ligula eget dolor. Aenean massa. \r\nCum sociis natoque penatibus et magnis dis parturient \r\nmontes, nascetur ridiculus mus. Donec quam felis, \r\nultricies nec, pellentesque eu, pretium quis, sem.</p>\r\n\r\n\r\n<h2>Aenean commodo ligula eget dolor aenean massa</h2>\r\n\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing \r\nelit. Aenean commodo ligula eget dolor. Aenean massa. \r\nCum sociis natoque penatibus et magnis dis parturient \r\nmontes, nascetur ridiculus mus. Donec quam felis, \r\nultricies nec, pellentesque eu, pretium quis, sem.</p>\r\n\r\n\r\n<ul>\r\n  <li>Lorem ipsum dolor sit amet consectetuer.</li>\r\n  <li>Aenean commodo ligula eget dolor.</li>\r\n  <li>Aenean massa cum sociis natoque penatibus.</li>\r\n</ul>\r\n\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing \r\nelit. Aenean commodo ligula eget dolor. Aenean massa. \r\nCum sociis natoque penatibus et magnis dis parturient \r\nmontes, nascetur ridiculus mus. Donec quam felis, \r\nultricies nec, pellentesque eu, pretium quis, sem.</p>\r\n\r\n\r\n&lt;form action=\"#\" method=\"post\"&gt;\r\n  <fieldset>\r\n    <label for=\"name\">Name:</label>\r\n    &lt;input type=\"text\" id=\"name\" placeholder=\"Enter your \r\nfull name\" /&gt;\r\n\r\n    <label for=\"email\">Email:</label>\r\n    &lt;input type=\"email\" id=\"email\" placeholder=\"Enter \r\nyour email address\" /&gt;\r\n\r\n    <label for=\"message\">Message:</label>\r\n    &lt;textarea id=\"message\" placeholder=\"What\'s on your \r\nmind?\"&gt;&lt;/textarea&gt;\r\n\r\n    &lt;input type=\"submit\" value=\"Send message\" /&gt;\r\n\r\n  </fieldset>\r\n&lt;/form&gt;\r\n\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing \r\nelit. Aenean commodo ligula eget dolor. Aenean massa. \r\nCum sociis natoque penatibus et magnis dis parturient \r\nmontes, nascetur ridiculus mus. Donec quam felis, \r\nultricies nec, pellentesque eu, pretium quis, sem.</p>\r\n\r\n\r\n<table class=\"data\">\r\n  <tr>\r\n    <th>Entry Header 1</th>\r\n    <th>Entry Header 2</th>\r\n    <th>Entry Header 3</th>\r\n    <th>Entry Header 4</th>\r\n  </tr>\r\n  <tr>\r\n    <td>Entry First Line 1</td>\r\n    <td>Entry First Line 2</td>\r\n    <td>Entry First Line 3</td>\r\n    <td>Entry First Line 4</td>\r\n  </tr>\r\n  <tr>\r\n    <td>Entry Line 1</td>\r\n    <td>Entry Line 2</td>\r\n    <td>Entry Line 3</td>\r\n    <td>Entry Line 4</td>\r\n  </tr>\r\n  <tr>\r\n    <td>Entry Last Line 1</td>\r\n    <td>Entry Last Line 2</td>\r\n    <td>Entry Last Line 3</td>\r\n    <td>Entry Last Line 4</td>\r\n  </tr>\r\n</table>\r\n\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing \r\nelit. Aenean commodo ligula eget dolor. Aenean massa. \r\nCum sociis natoque penatibus et magnis dis parturient \r\nmontes, nascetur ridiculus mus. Donec quam felis, \r\nultricies nec, pellentesque eu, pretium quis, sem.</p>\r\n', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ratings`
--

CREATE TABLE `tbl_ratings` (
  `id` int NOT NULL,
  `video_id` int NOT NULL,
  `rating` float NOT NULL,
  `user_id` int NOT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_ratings`
--

INSERT INTO `tbl_ratings` (`id`, `video_id`, `rating`, `user_id`, `status`) VALUES
(1, 1, 5, 2, 0),
(3, 2, 5, 2, 0),
(4, 20, 5, 175, 0),
(5, 3, 5, 175, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_smtp_setting`
--

CREATE TABLE `tbl_smtp_setting` (
  `id` int NOT NULL,
  `protocol` varchar(255) NOT NULL,
  `host` varchar(255) NOT NULL,
  `port` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `from_name` varchar(255) NOT NULL,
  `from_email` varchar(255) NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_smtp_setting`
--

INSERT INTO `tbl_smtp_setting` (`id`, `protocol`, `host`, `port`, `user`, `pass`, `from_name`, `from_email`, `status`) VALUES
(1, 'smtp', 'ssl://smtp.gmail.com', '465', 'admin@admin.com', '', 'DivineTechs', 'admin@admin.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaction`
--

CREATE TABLE `tbl_transaction` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `video_id` int NOT NULL,
  `package_id` int NOT NULL,
  `currency_code` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `payment_id` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `state` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `amount` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int NOT NULL,
  `role_id` int NOT NULL DEFAULT '2',
  `fullname` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'user.png',
  `background_image` varchar(255) NOT NULL,
  `email` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `auth_token` text NOT NULL,
  `mobile` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `type` int NOT NULL DEFAULT '1' COMMENT '1- normal , 2- facebook , 3- otp	',
  `status` int NOT NULL DEFAULT '1',
  `package_expiry_date` date DEFAULT NULL,
  `is_updated` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `role_id`, `fullname`, `image`, `background_image`, `email`, `password`, `auth_token`, `mobile`, `type`, `status`, `package_expiry_date`, `is_updated`, `created_at`) VALUES
(3, 2, '', '1662362679.jpg', 'default_background_image.png', '', '', '631c8574830f0G91PtmUfOVnFMBhX7Q_3', '', 2, 1, NULL, 0, '2020-12-23 03:24:27'),
(4, 2, 'iostest', 'user.png', 'default_background_image.png', 'ios@mail.com', 'd41d8cd98f00b204e9800998ecf8427e', '', '1234567890', 1, 1, NULL, 0, '2020-12-23 13:50:54'),
(5, 2, 'testios1', 'user.png', 'default_background_image.png', 'test1@mail.com', '25f9e794323b453885f5181f1b624d0b', '', '1234567894', 1, 1, NULL, 0, '2020-12-23 14:08:12'),
(6, 2, 'r', 'user.png', 'default_background_image.png', 'r@mail.com', 'e10adc3949ba59abbe56e057f20f883e', '5fe350100112azl4U0D8KEFLctwyoqa_6', '1478523690', 1, 1, NULL, 0, '2020-12-23 14:11:11'),
(7, 2, 'Rushabh Patel', '1609330987.png', '1609331650.png', 'ios1@mail.com', '25f9e794323b453885f5181f1b624d0b', '5fedfe69cecac4uSdAMYUxP5BkEsatV_7', '1234567890', 1, 1, NULL, 0, '2020-12-24 14:18:56'),
(8, 2, 'KongBoraraksmey', '1608997993.jpg', 'default_background_image.png', 'boraraksmeykong87@gmail.com', '', '5fe75c694dee60t8lCuj1VFAWNygrGB_8', '', 2, 1, NULL, 0, '2020-12-26 15:53:13'),
(9, 2, 'KongBoraraksmey', '1608997993.jpg', 'default_background_image.png', 'boraraksmeykong87@gmail.com', '', '5fe75c6949e79KIFiT71uOoV3sbmStU_9', '', 2, 1, NULL, 0, '2020-12-26 15:53:13'),
(10, 2, 'Karthik Suresh', 'user.png', 'default_background_image.png', 'karthiksuresh1680@gmail.com', '', '5fe9e68dc259b9NQrcOXoHf0MLgh1IW_10', '', 2, 1, NULL, 0, '2020-12-28 14:07:09'),
(11, 2, 'DivineTechs Developer', '1677749528.jpg', '1609328716.jpg', 'support@divinetechs.com', '', '6426ec84a92c5HLzV1KSaeZJIkpjW6w_11', '7984859403', 2, 1, NULL, 1, '2020-12-30 11:44:08'),
(14, 2, 'RushabhPatel', '1609341861.png', 'default_background_image.png', 'rushabh.spaceo@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', '60b9c775697f5x2qkuz3M7n6PemLbfK_14', '1389396926', 1, 1, NULL, 0, '2020-12-30 14:31:21'),
(15, 2, 'ios9', '1609565728.png', '1609565711.png', 'ios9@mail.com', '25f9e794323b453885f5181f1b624d0b', '5ff004af42466IWQswOzZtuBpLNFiKR_15', '123478569', 1, 1, NULL, 0, '2020-12-30 16:21:24'),
(16, 2, 'ChiragPatel', '1609398124.png', '1609398172.png', 'ckpatel@divinetechs.com', 'd41d8cd98f00b204e9800998ecf8427e', '', '9198137811', 1, 1, NULL, 0, '2020-12-31 07:01:28'),
(17, 2, '', '1609485938.png', 'default_background_image.png', 'Rushabh Patel', '', '5ff000b42aac0ufj2tRDWSG4BZMVxap_17', '', 2, 1, NULL, 0, '2020-12-31 13:28:46'),
(18, 2, 'DivineTechs', '1609522349.png', '1609522429.png', 'divinetechs@gmail.com', '', '5fef5bc43d1be7hIYyjp1LZfwgtxr6b_18', '983877338', 2, 1, NULL, 0, '2020-12-31 14:39:28'),
(19, 2, '', '1609516261.png', '1609515267.png', 'poonam gadhiya', '', '5fef44d9844229SvyN7YpIU5D2bXMFA_19', '', 2, 1, NULL, 0, '2021-01-01 15:27:40'),
(20, 2, '', 'user.png', 'default_background_image.png', 'DivineTechs Developer', '', '5feff0b2e8feaJCINduAyxhLbBUr8HP_20', '', 2, 1, NULL, 0, '2021-01-02 04:04:02'),
(21, 2, 'testapp1', '1609675922.png', '1609675934.png', 'testapp1@pay-mon.com', 'c4ca4238a0b923820dcc509a6f75849b', '5ff1b3ff38557PlxzB8Qrfjwmq4teWp_21', '12121212', 1, 1, NULL, 0, '2021-01-03 12:09:19'),
(22, 2, 'craig Iredia', '1610659338.jpg', 'default_background_image.png', 'designtechng@gmail.com', '', '6000b60a5ee09g4OSvnY1zaUwbIFtGM_22', '', 2, 1, NULL, 0, '2021-01-14 21:22:18'),
(23, 2, 'Cybernetix Solutions', 'user.png', 'default_background_image.png', 'cybernetixsolution@gmail.com', '', '6007c1b45e01duMjOgGPdaCEtoc9flX_23', '', 2, 1, NULL, 0, '2021-01-20 05:37:56'),
(24, 2, 'MSSOFTPC COM', '1611127436.jpg', 'default_background_image.png', 'mssoftwarespresents@gmail.com', '', '6007da8c8c507pOPax2ugCKUnlX4Rbs_24', '', 2, 1, NULL, 0, '2021-01-20 07:23:56'),
(25, 2, 'Darlington Chiiko', '1611358771.jpg', 'default_background_image.png', 'chiikozm@gmail.com', '', '600b623313494sAxMNUkYChZ8D7tKVr_25', '', 2, 1, NULL, 0, '2021-01-22 23:39:31'),
(26, 2, 'felx', 'user.png', 'default_background_image.png', 'felx@gmail.com', '7a40e75bc76d8262da418bf28ba3aa82', '', '999999999', 1, 1, NULL, 0, '2021-01-24 11:52:27'),
(27, 2, 'lee', 'user.png', 'default_background_image.png', 'leelee@gmail.com', '415a69585d462781ef60f2d2d40413ca', '', '99999999', 1, 1, NULL, 0, '2021-01-24 22:42:45'),
(28, 2, 'lee', 'user.png', 'default_background_image.png', 'lee@gmail.com', '3b51941a9904ce23b87c58372d0c9aa2', '', '66666666', 1, 1, NULL, 0, '2021-01-25 07:32:50'),
(29, 2, 'sathish ramyen', '1612517780.jpg', 'default_background_image.png', 'sathishramyen@gmail.com', '', '601d11946c463M1A4v0CYJXK5nkGyQT_29', '', 2, 1, NULL, 0, '2021-02-05 09:36:20'),
(30, 2, 'bik', 'user.png', 'default_background_image.png', 'bbbb@gmail.com', 'c07c9d98ada18fb549c8fcf1fcc44755', '', '0123456789', 1, 1, NULL, 0, '2021-02-13 17:08:36'),
(31, 2, 'MARUF MMA', '1613422015.jpg', 'default_background_image.png', 'Mvideo.tj@bk.ru', '', '602addbfcaefc5wHyblrM7KPhBoGNmL_31', '', 2, 1, NULL, 0, '2021-02-15 20:46:56'),
(32, 2, 'kn', 'user.png', 'default_background_image.png', 'knkkg@gmail.com', '4eb42189da719f538271819c5934a78c', '', '6558233108', 1, 1, NULL, 0, '2021-02-18 06:28:51'),
(33, 2, 'Ravi Sha', 'user.png', 'default_background_image.png', 'rs692594@gmail.com', '', '6030d6e22d2b8sF9L03r2oh5mVJqYpg_33', '', 2, 1, NULL, 0, '2021-02-20 09:31:14'),
(34, 2, 'Diy New TecH', '1613823023.jpg', 'default_background_image.png', 'helpvlove@gmail.com', '', '6030fc2f09fb74TDScCpV6s0Nt8KfOI_34', '', 2, 1, NULL, 0, '2021-02-20 12:10:23'),
(35, 2, 'Hoàng Ngọc Long', 'user.png', 'default_background_image.png', 'dasdragon036@gmail.com', '', '60351b2defbb8H3cxqJvVQMXLCbtoS2_35', '', 2, 1, NULL, 0, '2021-02-23 15:11:41'),
(36, 2, 'Fatima Jou', 'user.png', 'default_background_image.png', 'fatimajou01@gmail.com', '', '6147211dc0c23WFQgZSYmMNGR4nEXw2_36', '', 2, 1, NULL, 0, '2021-02-25 10:04:11'),
(37, 2, 'hshhs', 'user.png', 'default_background_image.png', 'hahhs', 'fb74e14cf256e5cf3e023c65255822c4', '', '94646646', 1, 1, NULL, 0, '2021-03-02 19:29:39'),
(38, 2, 'Kushal Mondal', '1614860208.jpg', 'default_background_image.png', 'mondalkushal10000@gmail.com', '', '6040cfb00b87bdS6IPogabZCfDRTvB7_38', '', 2, 1, NULL, 0, '2021-03-04 12:16:48'),
(39, 2, 'kong boraraksmey', 'user.png', 'default_background_image.png', 'boraraksmeykong1990@gmail.com', '', '6040f0f360aa78oTcNVrk0bWvwmQzhn_39', '', 2, 1, NULL, 0, '2021-03-04 14:38:43'),
(40, 2, 'Khaled Yr', 'user.png', 'default_background_image.png', 'khaledtwittersnap@gmail.com', '', '604c8ebe6913cEAyUFngv0KBmZYr38P_40', '', 2, 1, NULL, 0, '2021-03-13 10:06:54'),
(41, 2, 'iuri felipe custodio', 'user.png', 'default_background_image.png', 'iuritp18@gmail.com', '', '604fbc8f58f72e5uS2rY8mlahD9xw0d_41', '', 2, 1, NULL, 0, '2021-03-15 19:59:11'),
(42, 2, 'ali', 'user.png', 'default_background_image.png', 'sujonali889900@gmail.com ', 'd3786ec2413a8cd9413bfcb24be95a73', '', '01718028856', 1, 1, NULL, 0, '2021-03-20 06:04:24'),
(43, 2, 'short clips', '1616637173.jpg', 'default_background_image.png', 'shofytech@gmail.com', '', '605becf5b965eNF0w1nilWIZMO56dB4_43', '', 2, 1, NULL, 0, '2021-03-25 01:52:53'),
(44, 2, 'kalu114 thakor', 'user.png', 'default_background_image.png', 'mdthakor2021kalu114@gmail.com', '', '6070975ce9a372XliG6bLPwp3MkjrYC_44', '', 2, 1, NULL, 0, '2021-04-09 18:05:16'),
(45, 2, 'alsahley', 'user.png', 'default_background_image.png', 'c4ea@live.com', '4297f44b13955235245b2497399d7a93', '', '12345678', 1, 1, NULL, 0, '2021-04-10 01:35:57'),
(46, 2, 'test', 'user.png', 'default_background_image.png', 'test@test.com', '827ccb0eea8a706c4c34a16891f84e7b', '', '99995555588', 1, 1, NULL, 0, '2021-04-13 16:42:28'),
(47, 2, 'cpt', 'user.png', 'default_background_image.png', 'cptbrk@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '889565955595', 1, 1, NULL, 0, '2021-04-18 18:00:55'),
(48, 2, 'arjun', 'user.png', 'default_background_image.png', 'arjun@dtechs.com', '827ccb0eea8a706c4c34a16891f84e7b', '', '987654321', 1, 1, NULL, 0, '2021-04-20 10:13:34'),
(49, 2, 'Poo', 'user.png', 'default_background_image.png', 'poo@mail.com', 'e10adc3949ba59abbe56e057f20f883e', '608a8a8c855036AWHsrGqucD3mTXntI_49', '123456789', 1, 1, NULL, 0, '2021-04-28 12:23:07'),
(50, 2, 'Rushabh Patel', '1619692382.png', 'default_background_image.png', 'rushabh0999@yahoo.co.in', '', '60b9c698d08c51qwvWKCme7pX3ySYPO_50', '', 2, 1, NULL, 0, '2021-04-29 10:25:17'),
(51, 2, 'manpreet Kaur ', 'user.png', 'default_background_image.png', 'Mann.tuteja07@gmail.com', '25d55ad283aa400af464c76d713c07ad', '', '1234567891', 1, 1, NULL, 0, '2021-05-05 07:13:36'),
(52, 2, 'Vamsi Madduluri', 'user.png', 'default_background_image.png', 'vamsii.wrkhost@gmail.com', '', '6093044c97dc6nDpg9GTLhMvdPejz3E_52', '', 2, 1, NULL, 0, '2021-05-05 20:47:08'),
(53, 2, 'Vivek Kumar', 'user.png', 'default_background_image.png', 'tiwar04ivivek@gmail.com', '8a09052c9601178c546f1ee513920cf2', '609405ed26ddf5e3Y2sgAzStbVp1r7I_53', '9970220181', 1, 1, NULL, 0, '2021-05-06 14:04:25'),
(54, 2, 'Vikash Kumar', 'user.png', 'default_background_image.png', 'vikashkjmit@gmail.com', 'e79861ab507044bd919aa5af5851a4c4', '', '7972234002', 1, 1, NULL, 0, '2021-05-06 14:15:56'),
(55, 2, 'Ali Noureddine Testing', 'user.png', 'default_background_image.png', 'alinoureddinetesting@gmail.com', '', '609924561bd2cB6ORLf9y7TmeMqNG08_55', '', 2, 1, NULL, 0, '2021-05-10 12:17:26'),
(56, 2, 'Bekir Aydoğan', 'user.png', 'default_background_image.png', 'zeetoun.11@gmail.com', '', '60997ac1520f0lmfYOaJW6SzuTC8kcD_56', '', 2, 1, NULL, 0, '2021-05-10 18:26:09'),
(57, 2, 'Nokia Mobibox', 'user.png', 'default_background_image.png', 'nokiamobibox@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '8734961806', 1, 1, NULL, 0, '2021-05-11 05:41:04'),
(58, 2, 'Halilo Liloo', 'user.png', 'default_background_image.png', 'haliloliloo@gmail.com', '', '60a115148d3cbPWZFU7Vz4psyRvcnbY_58', '', 2, 1, NULL, 0, '2021-05-16 12:50:28'),
(59, 2, 'frank', 'user.png', 'default_background_image.png', 'ke70714@gmail.com', 'db7068a18fbc5a91dac038c5816d11ce', '60be7312d63b11nwapLyjBItTrcQiVk_59', '911', 1, 1, NULL, 0, '2021-06-04 21:43:25'),
(60, 2, 'Frank', 'user.png', 'default_background_image.png', 'kfang1@gmail.com', '696be92ffa095530bd8aecb5aa012546', '', '111', 1, 1, NULL, 0, '2021-06-05 16:14:12'),
(61, 2, 'anass', 'user.png', 'default_background_image.png', 'proshopnow6@gmail.com', '0b956b89972affc8b322c4ee312135e2', '', '0617015987', 1, 1, NULL, 0, '2021-06-14 11:56:48'),
(62, 2, 'Daljeet Singh', 'user.png', 'default_background_image.png', '07daljeetkumar@gmail.com', '', '60c746b96470atIjDSmMHVY58GuJBaC_62', '', 2, 1, NULL, 0, '2021-06-14 12:08:25'),
(63, 2, 'as', 'user.png', 'default_background_image.png', 'as@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '60caf65f61024kcSihNyKX51T4e7WLG_63', '01049147968', 1, 1, NULL, 0, '2021-06-17 07:00:59'),
(64, 2, 'T Kanna', 'user.png', 'default_background_image.png', 'steeventamada.info@gmail.com', '', '60cf0d887bfda2oqQMVer9RDtzcn0Bb_64', '', 2, 1, NULL, 0, '2021-06-20 09:42:32'),
(65, 2, 'Meraki Foryou', 'user.png', 'default_background_image.png', 'm3rak14u@gmail.com', '', '60d91a24db53dZfqnuQwprBWm2xHUOj_65', '', 2, 1, NULL, 0, '2021-06-28 00:39:00'),
(66, 2, 'Pooja singh', 'user.png', 'default_background_image.png', 'ps6553490@gmail.com', '', '60de239c6879eCfbBFWDYZ5XJIuMp0z_66', '', 2, 1, NULL, 0, '2021-07-01 20:20:44'),
(67, 2, 'Charles Darwin ', 'user.png', 'default_background_image.png', 'betgroup.com@gmail.com', '9499b45b3d96c01205e83c4fd9639ef2', '60e18c7478da2sp2Ge1mtwHocik8raI_67', '+2348175189323', 1, 1, NULL, 0, '2021-07-04 10:24:04'),
(68, 2, 'Sin Techs', 'user.png', 'default_background_image.png', 'techssin@gmail.com', '', '60e5b8c013385o4CEIas0q9M5ZiHfdR_68', '', 2, 1, NULL, 0, '2021-07-07 14:22:56'),
(69, 2, 'Sanjit Bhukta', 'user.png', 'default_background_image.png', 'unstoppablesanjit@gmail.com', '', '634997decf3663pGWhQ2kjDOMclJVex_69', '', 2, 1, NULL, 0, '2021-07-08 14:28:49'),
(70, 2, 'Nazeer Naxee', 'user.png', 'default_background_image.png', 'mrnaxee2@gmail.com', '', '60e8a72e50fd41SPKxsUhg0poOmwca9_70', '', 2, 1, NULL, 0, '2021-07-09 19:44:46'),
(71, 2, 'kada8513', 'user.png', 'default_background_image.png', 'f3tv8513@gmail.com', '198f4882de1586a9a5e906e09ec01f9a', '', '00213770780898', 1, 1, NULL, 0, '2021-07-09 20:16:48'),
(72, 2, 'jesus', 'user.png', 'default_background_image.png', 'jesus@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', '', '01715433523', 1, 1, NULL, 0, '2021-07-20 16:28:26'),
(73, 2, 'abdul', 'user.png', 'default_background_image.png', 'abdulmethaarth@gmail.com', 'a386b98daf9b459cb2958a1f6d5a18e3', '', '7845533782', 1, 1, NULL, 0, '2021-07-24 19:09:06'),
(74, 2, 'Marufjon Abdujabborov', '1627223416.jpg', 'default_background_image.png', 'mmabdujabborov@gmail.com', '', '60fd7578d3def3VRF6cfEr2IUq7Azmu_74', '', 2, 1, NULL, 0, '2021-07-25 14:30:17'),
(75, 2, 'arjun', 'user.png', 'default_background_image.png', 'arjun@dt.com', '827ccb0eea8a706c4c34a16891f84e7b', '61481378a4acdJUK82nhr7TCLwixXge_75', '34534534534', 1, 1, NULL, 0, '2021-08-04 04:05:51'),
(76, 2, 'anil', 'user.png', 'default_background_image.png', 'anilmotwani13@gmail.com ', '8e3dd3ced8406c2cde1836e9da050cf9', '', '+918511523122', 1, 1, NULL, 0, '2021-08-04 11:50:17'),
(77, 2, 'TECHNICAL BIRU VIDEO\'S', '1628882081.jpg', 'default_background_image.png', 'kumarrajesh90137@gmail.com', '', '6116c4a1a21549hGLSJy3DPA4akQRfY_77', '', 2, 1, NULL, 0, '2021-08-13 19:14:41'),
(78, 2, 'Arief Sani Putra', 'user.png', 'default_background_image.png', 'vidnowkoe@gmail.com', '', '612a2e8e6512fcW6fytjz7aOdvex0rn_78', '', 2, 1, NULL, 0, '2021-08-15 19:10:13'),
(79, 2, 'test', 'user.png', 'default_background_image.png', 'test@pest.com', 'da070c43779d51963b0942a490aa62c8', '', '05545541122', 1, 1, NULL, 0, '2021-08-20 14:48:58'),
(80, 2, 'mariano tesler', 'user.png', 'default_background_image.png', 'teslerm@gmail.com', '', '6124efa3ea848ry8nvfMIzCbdBXo1st_80', '', 2, 1, NULL, 0, '2021-08-24 13:09:55'),
(81, 2, 'Meet Patel', '1630559858.jpg', 'default_background_image.png', 'meetp5082@gmail.com', '', '6395ac4c053bes2YR04lA3XJHn5W8QI_81', '8780827603', 2, 1, NULL, 0, '2021-09-01 11:46:28'),
(82, 2, 'a', 'user.png', 'default_background_image.png', 'a@a.a', '0cc175b9c0f1b6a831c399e269772661', '', '1234567899', 1, 1, NULL, 0, '2021-09-07 08:09:14'),
(83, 2, 'hjsjk', 'user.png', 'default_background_image.png', 'nwjsjjfj@sjisk.xom', 'e10adc3949ba59abbe56e057f20f883e', '', '+447598982721', 1, 1, NULL, 0, '2021-09-16 12:06:25'),
(84, 2, 'BIŘU ŠÎŇĞH', 'user.png', 'default_background_image.png', 'birus0055@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '', '8210369247', 1, 1, NULL, 0, '2021-09-19 08:31:31'),
(85, 2, 'jesus', 'user.png', 'default_background_image.png', 'jabco2015.luciana.8.8@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '3005566335', 1, 1, NULL, 0, '2021-10-08 20:25:43'),
(86, 2, 'Amin Vito', 'user.png', 'default_background_image.png', 'aminvito32@gmail.com', '', '616896282191ansaLZruXAtIcUxwMRE_86', '', 2, 1, NULL, 0, '2021-10-14 20:42:16'),
(87, 2, 'man ela', 'user.png', 'default_background_image.png', 'mnlgrps@gmail.com', '', '616f3db370172cHPGda0rpe3h4xBZlJ_87', '', 2, 1, NULL, 0, '2021-10-19 21:50:43'),
(88, 2, 'Hanson Field', 'user.png', 'default_background_image.png', 'hansonfield2020@gmail.com', '', '617383fa8266cGgdcvKoL1Iwf9eAECq_88', '', 2, 1, NULL, 0, '2021-10-23 03:39:38'),
(89, 2, 'santhosh kallatt', 'user.png', 'default_background_image.png', 'kallattsanghosh@gmail.com', '32e2700136300533c0dae28dfe723423', '', '9495423286', 1, 1, NULL, 0, '2021-10-25 07:28:32'),
(90, 2, 'sotech', 'user.png', 'default_background_image.png', 'somto403@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '586639', 1, 1, NULL, 0, '2021-10-26 22:34:12'),
(91, 2, 'brk', 'user.png', 'default_background_image.png', 'brk@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '12158285', 1, 1, NULL, 0, '2021-10-31 21:54:18'),
(92, 2, 'abcd', 'user.png', 'default_background_image.png', 'abcd@gmail.com', 'b16e35b7dff429ddfbe3b9cfe150145e', '', '9123456789', 1, 1, NULL, 0, '2021-11-06 14:21:51'),
(93, 2, 'arif khalil', 'user.png', 'default_background_image.png', 'anonhkr68@gmail.com', '', '61a3c119126e2HvJS2ULW9wpM8rgVeR_93', '', 2, 1, NULL, 0, '2021-11-28 17:49:13'),
(94, 2, 'Waleed Mohamed', '1638188392.jpg', 'default_background_image.png', 'anime.lookat@gmail.com', '', '61a4c5689e98dxCYLoN0aV3IE9HK4Gd_94', '', 2, 1, NULL, 0, '2021-11-29 12:19:52'),
(95, 2, 'Raj Kumar GK', 'user.png', 'default_background_image.png', 'myprint1995@gmail.com', '', '61bcc596365440Z8lIFY7Q21dnA6pDz_95', '', 2, 1, NULL, 0, '2021-12-07 10:09:22'),
(96, 2, 'hacker tom', 'user.png', 'default_background_image.png', 'hackertomobile@gmail.com', '', '61b14a375bf0cltYshwJRebFgLGdCfq_96', '23', 2, 1, NULL, 0, '2021-12-09 00:13:43'),
(97, 2, 'Idah Emmanuel', 'user.png', 'default_background_image.png', 'idahemmanuel@yahoo.com', '50f43f79c20de66c2c8ccb887db022a7', '', '08066565654', 1, 1, NULL, 0, '2021-12-10 14:03:52'),
(98, 2, 'Aaron Ikpefua', 'user.png', 'default_background_image.png', 'natureswaypro2@gmail.com', '898dc2c947cee718e4afd7dfcb2f1a09', '61c8387cd38443PYFAik6OZzncyHQoe_98', '08146626688', 1, 1, NULL, 0, '2021-12-14 12:22:16'),
(99, 2, 'Sumit Patel', 'user.png', 'default_background_image.png', 'sumitvadher45@gmail.com', '', '61b9c22660cd7bQsiSPV2YoBz4v9HIe_99', '', 2, 1, NULL, 0, '2021-12-15 10:23:34'),
(100, 2, '宽伊通伤', 'user.png', 'default_background_image.png', 'chenyan39999@gmail.com', '70d03f001fd5e6d26b1f5c6a53d4d7e3', '61c2b9210ac57L0Rkles5z124iDQjJA_100', '1137395075', 1, 1, NULL, 0, '2021-12-22 05:33:40'),
(101, 2, 'arjun111', 'user.png', 'default_background_image.png', 'arjun111@dt.com', '827ccb0eea8a706c4c34a16891f84e7b', '', '872389472934', 1, 1, NULL, 0, '2022-01-05 13:29:36'),
(102, 2, 'arjun111', 'user.png', 'default_background_image.png', 'arjun1111@dt.com', '827ccb0eea8a706c4c34a16891f84e7b', '61d59edf6c4433wc4sIrRFtBTj65dWG_102', '872389472934222', 1, 1, NULL, 0, '2022-01-05 13:34:42'),
(103, 2, 'mrpunjabttt', 'user.png', 'default_background_image.png', 'mrpunjabttt@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '61d7354694b501HDupnrJ8AiG0lZOfV_103', '8888888888', 1, 1, NULL, 0, '2022-01-06 18:28:42'),
(104, 2, 'arjun01', 'user.png', 'default_background_image.png', 'arjun011@dt.com', '96e79218965eb72c92a549dd5a330112', '', '1234567890', 1, 1, NULL, 0, '2022-01-07 10:46:21'),
(105, 2, 'Anand007', 'user.png', 'default_background_image.png', 'anand@caretit.cm', '827ccb0eea8a706c4c34a16891f84e7b', '', '9510031431', 1, 1, NULL, 0, '2022-01-08 12:05:05'),
(106, 2, 'anand007', 'user.png', 'default_background_image.png', 'anand@caretit.com', '827ccb0eea8a706c4c34a16891f84e7b', '', '9510031432', 1, 1, NULL, 0, '2022-01-08 12:06:37'),
(107, 2, 'anand', 'user.png', 'default_background_image.png', 'info@divinetechs.com', 'e10adc3949ba59abbe56e057f20f883e', '61d97f7dba819pU1w7qlhGSIy904YZE_107', '9519931433', 1, 1, NULL, 0, '2022-01-08 12:11:16'),
(117, 2, 'Randhir', 'user.png', 'default_background_image.png', 'randhir@caret.com', '827ccb0eea8a706c4c34a16891f84e7b', '61f4ec0e7d734f4JHsr2MiwWI78ovkO_117', '9825813958', 1, 1, NULL, 0, '2022-01-29 07:25:49'),
(119, 2, 'Priyank', 'user.png', 'default_background_image.png', 'priyank.it@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '', '7960333050', 1, 1, NULL, 0, '2022-03-24 04:37:41'),
(120, 2, 'eeer', 'user.png', 'default_background_image.png', 'aaaz@ff.com', '1b3f79332c68d03802decc784b659805', '', '1441441441', 1, 1, NULL, 0, '2022-03-24 10:57:42'),
(121, 2, 'abc', 'user.png', 'default_background_image.png', 'aaa@tg.com', 'e86fdc2283aff4717103f2d44d0610f7', '', '1111111111', 1, 1, NULL, 0, '2022-03-24 11:09:01'),
(122, 2, 'dddd', 'user.png', 'default_background_image.png', 'sggddg@dg.com', '9d401765d0f88f98191c35ce28d0d50f', '', '2525252525', 1, 1, NULL, 0, '2022-03-24 11:36:57'),
(123, 2, 'rrrr', 'user.png', 'default_background_image.png', 'eeee@fr.com', '4f859d88d71593edf8fb6507494db416', '', '1212121212', 1, 1, NULL, 0, '2022-03-24 11:41:42'),
(124, 2, 'aaa', 'user.png', 'default_background_image.png', 'aaaa@gmail.com', '509ed9f6fed35159804f2e5178224bad', '', '3536981248', 1, 1, NULL, 0, '2022-03-24 11:57:59'),
(125, 2, 'pinkal', 'user.png', 'default_background_image.png', 'pinkal121@gmail.com', 'e23ab22a24cad30b9521268a33d00e79', '', '8181252568', 1, 1, NULL, 0, '2022-03-24 12:02:10'),
(126, 2, 'pinkal', 'user.png', 'default_background_image.png', 'pinkal123@gmail.com', 'fe9943dc57f263eb572dc42bcf406a36', '', '8181252542', 1, 1, NULL, 0, '2022-03-24 12:04:42'),
(127, 2, 'abc', 'user.png', 'default_background_image.png', 'abc@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '', '5164823186', 1, 1, NULL, 0, '2022-03-24 12:57:09'),
(128, 2, 'admin', 'user.png', 'default_background_image.png', 'admin@gmail.com', '0192023a7bbd73250516f069df18b500', '623dbfc9774d2kUYNC8Iar6EOMgsGAT_128', '1234123412', 1, 1, NULL, 0, '2022-03-25 04:30:09'),
(129, 2, 'admin1', 'user.png', 'default_background_image.png', 'admin12@gmail.com', '0192023a7bbd73250516f069df18b500', '', '1234512345', 1, 1, NULL, 0, '2022-03-25 04:35:36'),
(130, 2, 'pp_patel', 'user.png', 'default_background_image.png', 'pinkal@pp.com', '99acad480ab3622e68df0ae5834096b2', '62715165b93bfd2BxymIip9atLq6nre_130', '1234567812', 1, 1, NULL, 0, '2022-03-25 04:42:37'),
(131, 2, 'admin2', 'user.png', 'default_background_image.png', 'admin112@gmail.com', '0192023a7bbd73250516f069df18b500', '', '1234512312', 1, 1, NULL, 0, '2022-03-25 04:45:27'),
(132, 2, 'pppatel', 'user.png', 'default_background_image.png', 'pp_patel@mp.com', '99acad480ab3622e68df0ae5834096b2', '', '1122334455', 1, 1, NULL, 0, '2022-03-25 04:51:00'),
(133, 2, 'tirth', 'user.png', 'default_background_image.png', 'tirth12@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', '7788994455', 1, 1, NULL, 0, '2022-03-25 04:52:39'),
(134, 2, 'tirth bhuro', 'user.png', 'default_background_image.png', 'bhuro@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '624dbcc6a7bc64F25QgfjNtAdbiRczW_134', '1234561234', 1, 1, NULL, 0, '2022-03-25 04:54:09'),
(135, 2, 'nayan', 'user.png', 'default_background_image.png', 'nayan@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', '1231234512', 1, 1, NULL, 0, '2022-03-25 04:55:53'),
(136, 2, 'kano', 'user.png', 'default_background_image.png', 'kano@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', '1234567800', 1, 1, NULL, 0, '2022-03-25 05:00:03'),
(137, 2, 'guddi', 'user.png', 'default_background_image.png', 'guddi@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '624bcd3f31950bnoISFW6HGP5uRKB1f_137', '1234509876', 1, 1, NULL, 0, '2022-03-28 13:11:11'),
(138, 2, 'meet', 'user.png', 'default_background_image.png', 'meet@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', '8780857606', 1, 1, NULL, 0, '2022-03-29 06:11:48'),
(139, 2, 'priyank', 'user.png', 'default_background_image.png', 'pp@dt.com', '827ccb0eea8a706c4c34a16891f84e7b', '625f93ff30ae77Na8zmEn9oi4dt5jrl_139', '7624952886', 1, 1, NULL, 0, '2022-03-29 06:13:17'),
(140, 2, 'priyank', 'user.png', 'default_background_image.png', 'pp@cit.com', '827ccb0eea8a706c4c34a16891f84e7b', '', '7672456138', 1, 1, NULL, 0, '2022-03-29 06:17:20'),
(141, 2, 'meet', 'user.png', 'default_background_image.png', 'meet@cit.com', '827ccb0eea8a706c4c34a16891f84e7b', '6246bf3426f29Hnp06Ek71zvhOLAB3C_141', '4586127809', 1, 1, NULL, 0, '2022-03-30 09:51:08'),
(142, 2, 'maulik', 'user.png', 'default_background_image.png', 'maulik@mp.com', '5f4dcc3b5aa765d61d8327deb882cf99', '626148ac7424bjyItpbK3v409gmcC86_142', '9714725226', 1, 1, NULL, 0, '2022-03-30 09:54:04'),
(143, 2, 'jeet', 'user.png', 'default_background_image.png', 'jeet@jt.com', '5f4dcc3b5aa765d61d8327deb882cf99', '62454601c6c1aRA2mpuEiK1JkXPYeMO_143', '9924739530', 1, 1, NULL, 0, '2022-03-30 09:56:27'),
(144, 2, 'kaushik patel', 'user.png', 'default_background_image.png', 'kv@pp.com', '5f4dcc3b5aa765d61d8327deb882cf99', '6251b922730f5zjFWwQLV053aHcir9b_144', '6352751142', 1, 1, NULL, 0, '2022-04-09 16:49:26'),
(145, 2, 'nayan', 'user.png', 'default_background_image.png', 'n.s@ns.com', 'e10adc3949ba59abbe56e057f20f883e', '', '9601190440', 1, 1, NULL, 0, '2022-04-19 08:44:28'),
(146, 2, 'nayan', 'user.png', 'default_background_image.png', 'nayan@ns.com', 'e10adc3949ba59abbe56e057f20f883e', '625e772c230adhTfHaOZUIwKepRAirN_146', '9601190450', 1, 1, NULL, 0, '2022-04-19 08:46:46'),
(147, 2, 'mayank', 'user.png', 'default_background_image.png', 'mayank@mp.com', 'e10adc3949ba59abbe56e057f20f883e', '625e7d8831a07LfUE8C15AINGwdo2QK_147', '6355781567', 1, 1, NULL, 0, '2022-04-19 08:58:50'),
(148, 2, 'pinkal', 'user.png', 'default_background_image.png', 'pinkal@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '1234561237', 1, 1, NULL, 0, '2022-04-20 06:04:47'),
(149, 2, 'pinkal', 'user.png', 'default_background_image.png', 'pinkal@mp.com', 'e10adc3949ba59abbe56e057f20f883e', '', '1234561238', 1, 1, NULL, 0, '2022-04-20 06:06:48'),
(150, 2, 'janak', 'user.png', 'default_background_image.png', 'janak@pp.com', 'e10adc3949ba59abbe56e057f20f883e', '625fa6186be6a4ULIrmsSe8oa9nkQN6_150', '8440280199', 1, 1, NULL, 0, '2022-04-20 06:09:03'),
(151, 2, 'janak', 'user.png', 'default_background_image.png', 'janak@fb.com', 'e10adc3949ba59abbe56e057f20f883e', '62614bce2fde4PhpMlCVS2o6UbLX7wI_151', '8440270155', 1, 1, NULL, 0, '2022-04-20 06:23:43'),
(152, 2, 'pinkal', 'user.png', 'default_background_image.png', 'pinkal@fb.com', 'e10adc3949ba59abbe56e057f20f883e', '626103b6768eaxJ7qrdP63OYIKHAF5U_152', '9775025602', 1, 1, NULL, 0, '2022-04-20 06:26:13'),
(153, 2, 'janak', 'user.png', 'default_background_image.png', 'janak11@fb.com', 'e10adc3949ba59abbe56e057f20f883e', '6267e5ff57450I3JFAlHYXNdikaMn86_153', '8140590488', 1, 1, NULL, 0, '2022-04-21 12:32:56'),
(154, 2, 'pinkal', 'user.png', 'default_background_image.png', 'pinkal11@fb.com', 'e10adc3949ba59abbe56e057f20f883e', '6277c2a6e494bUkQVJNGrT4fnZHbcwo_154', '9773058609', 1, 1, NULL, 0, '2022-04-21 12:33:40'),
(155, 2, 'maulik', 'user.png', 'default_background_image.png', 'maulik11@fb.com', 'e10adc3949ba59abbe56e057f20f883e', '6267e54e50e9fbWoL4ImlXytzDeUHRq_155', '9714755263', 1, 1, NULL, 0, '2022-04-21 13:20:31'),
(156, 2, 'priyank', 'user.png', 'default_background_image.png', 'priyank11@fb.com', 'e10adc3949ba59abbe56e057f20f883e', '626fc72766e67Q5bSgoleDPKnZ0Ua14_156', '9761664669', 1, 1, NULL, 0, '2022-04-22 10:29:26'),
(157, 2, 'Divine', 'user.png', 'default_background_image.png', 'dd@dt.com', 'e10adc3949ba59abbe56e057f20f883e', '6270b646d7e42N7JZVARwWsiDgPmj3B_157', '4661661696', 1, 1, NULL, 0, '2022-04-22 10:30:25'),
(158, 2, 'Vraj', 'user.png', 'default_background_image.png', 'vraj@123.com', '202cb962ac59075b964b07152d234b70', '', '456789123', 1, 1, NULL, 0, '2022-07-29 12:58:38'),
(159, 2, 'VrajRaval', 'user.png', 'default_background_image.png', 'vrajraval7777@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '9898564526', 1, 1, NULL, 0, '2022-07-29 13:12:46'),
(160, 2, 'meetPatel', 'user.png', 'default_background_image.png', 'meet7777@gmail.com', 'e9fd92b4e8a79b1c0b046ec770197f60', '', '6985685469', 1, 1, NULL, 0, '2022-07-29 13:15:48'),
(161, 2, 'meetPatel', 'user.png', 'default_background_image.png', 'meet5656@gmail.com', 'e9fd92b4e8a79b1c0b046ec770197f60', '', '8956784523', 1, 1, NULL, 0, '2022-07-29 13:37:15'),
(162, 2, 'Priyank Patel', 'user.png', 'default_background_image.png', 'priyank@gmail.com', '6365f973cbe648d9435a377b44cf2495', '', '9845785689', 1, 1, NULL, 0, '2022-07-29 13:38:17'),
(163, 2, 'Chirag Patel', 'user.png', 'default_background_image.png', 'chirag3232@gmail.com', '5b70ebc72ce5ff9dee7689f47969824d', '', '9823459865', 1, 1, NULL, 0, '2022-07-29 14:03:16'),
(164, 2, 'uvuvyvy', 'user.png', 'default_background_image.png', 'iet28vrajraval@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', '632075f668afd6UPMg20GwrsDeB5oVN_164', '212121', 1, 1, NULL, 0, '2022-07-30 04:42:34'),
(165, 2, 'viraj raval', 'user.png', 'default_background_image.png', 'viraj4545@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', '', '987123', 1, 1, NULL, 0, '2022-07-30 05:23:37'),
(166, 2, 'nonivvy', 'user.png', 'default_background_image.png', 'ivuvuvu9796@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', '', '563214', 1, 1, NULL, 0, '2022-07-30 05:25:44'),
(167, 2, 'kbuvyvy', 'user.png', 'default_background_image.png', 'xtxtcc383@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', '', '353828', 1, 1, NULL, 0, '2022-07-30 05:29:47'),
(168, 2, 'uguvyf', 'user.png', 'default_background_image.png', 'jvuvuv99@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', '', '563289', 1, 1, NULL, 0, '2022-07-30 05:33:14'),
(169, 2, 'kbububu', 'user.png', 'default_background_image.png', 'juvyu@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', '', '321145', 1, 1, NULL, 0, '2022-07-30 05:34:23'),
(170, 2, 'gugugy', 'user.png', 'default_background_image.png', 'uvuug3636@gmail.com', '2f69247c362157356ebcaee5394b29b4', '', '124578', 1, 1, NULL, 0, '2022-07-30 07:27:46'),
(171, 2, 'vraj Raval ', 'user.png', 'default_background_image.png', 'vraj@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '6365e2319eab2hxZpf2n4EvPAw9cKgJ_171', '098765', 1, 1, NULL, 0, '2022-07-30 09:59:47'),
(172, 2, 'deeppatel', 'user.png', 'default_background_image.png', 'deep@gmail.com', '25d55ad283aa400af464c76d713c07ad', '62e51cab63012CXzSDpHv7WVAJLMa0u_172', '555555', 1, 1, NULL, 0, '2022-07-30 10:57:15'),
(173, 2, 'jignesh ', 'user.png', 'default_background_image.png', 'jignesh@gmail.com', '3abf00fa61bfae2fff9133375e142416', '62ea2def3b547KNzQolmr1F5eYDEiLy_173', '9999999990', 1, 1, NULL, 0, '2022-08-03 08:11:34'),
(174, 2, 'vvv', 'user.png', 'default_background_image.png', 'vvv2121@gmail.com', '4693fbb215b8ca15a6900f0cfa164cdc', '63207641713173toLyfqhHznZjGsUKu_174', '6351212608', 1, 1, NULL, 0, '2022-08-31 10:47:11'),
(175, 2, 'arjun', 'user.png', 'default_background_image.png', 'arjun27@dt.com', 'e10adc3949ba59abbe56e057f20f883e', '631716d07deadKhQzP6ndvU4mtcaGTb_175', '3242342334', 1, 1, NULL, 0, '2022-09-06 09:36:48'),
(177, 2, 'abc', '', '', 'abc@gmal.com', '', '', '9876549878', 3, 1, NULL, 1, '2022-09-13 09:08:34'),
(178, 2, '', '', '', '', '', '', '437263', 3, 1, NULL, 0, '2022-09-13 10:20:13'),
(179, 2, '', '', '', '', '', '', '+919824652931', 3, 1, NULL, 0, '2022-09-13 10:43:43'),
(180, 2, '', '', '', '', '', '', '+919898352931', 3, 1, NULL, 0, '2022-09-13 10:53:11'),
(181, 2, 'Priyank Patel', '', 'default_background_image.png', 'priyank24898@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '634a5b183043cM82CrNiYdspTWEySZ6_181', '1234567890', 2, 1, NULL, 0, '2022-09-13 11:14:01'),
(182, 2, '', '', 'default_background_image.png', 'liujunpeng00@gmail.com', '', '63212e5c6cb1dvIWYG5dCMkmiDSh9fF_182', '', 2, 1, NULL, 0, '2022-09-14 01:29:00'),
(183, 2, 'demot', 'user.png', 'default_background_image.png', 'Demot@demo.com', '875f26fdb1cecf20ceb4ca028263dec6', '63217a4594f1d8xIfZXycLKb13je5EG_183', '848449', 1, 1, NULL, 0, '2022-09-14 06:52:41'),
(184, 2, '', '', 'default_background_image.png', 'mazatvapp@gmail.com', '', '63218a1277526MfoNDlpJ4eHnVZhTL0_184', '', 2, 1, NULL, 0, '2022-09-14 08:00:18'),
(185, 2, 'Vicky', 'user.png', 'default_background_image.png', 'matatvapp@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '9359201321', 1, 1, NULL, 0, '2022-09-14 08:02:44'),
(186, 2, '', '', 'default_background_image.png', 'cowboot06@gmail.com', '', '6321ffd4ed315yMU96IGrCZbRPB2Vqv_186', '', 2, 1, NULL, 0, '2022-09-14 16:22:11'),
(187, 2, 'test', 'user.png', 'default_background_image.png', 'test123@test.com', '25d55ad283aa400af464c76d713c07ad', '632244f72256fMdl7yLKeO1PAYJHkoR_187', '00000088776', 1, 1, NULL, 0, '2022-09-14 21:14:04'),
(188, 2, '', '', 'default_background_image.png', 'nagarsltd@gmail.com', '', '632259e424b91NiZVoekcXhPKgTIFOH_188', '', 2, 1, NULL, 0, '2022-09-14 22:47:00'),
(189, 2, '', '', 'default_background_image.png', 'sout.rahim@gmail.com', '', '6322af77cb63eWnJSqlfaDrIbV5xCMQ_189', '', 2, 1, NULL, 0, '2022-09-15 04:52:07'),
(190, 2, 'lou', 'user.png', 'default_background_image.png', '11@11.com', '96e79218965eb72c92a549dd5a330112', '6322bee3239f23rtz4ThiPoV9jlnfKC_190', '18888899999', 1, 1, NULL, 0, '2022-09-15 05:57:37'),
(191, 2, '', '', 'default_background_image.png', 'griffinjam149@gmail.com', '', '6322e67eb9858TNKjuiP6Jhwbc1Qf5d_191', '', 2, 1, NULL, 0, '2022-09-15 08:46:54'),
(192, 2, '', '', 'default_background_image.png', 'asikkhan62325@gmail.com', '', '63732978edf84gTu0Fv1ISOfqxRlLHc_192', '', 2, 1, NULL, 0, '2022-09-15 09:43:06'),
(193, 2, '', '', 'default_background_image.png', 'peter.sabuy@gmail.com', '', '6322fe535383397GD0Jxm4upl1EktM5_193', '', 2, 1, NULL, 0, '2022-09-15 10:28:35'),
(194, 2, '', '', 'default_background_image.png', 'dharmendrakumarinfo88@gmail.com', '', '632307e02eed1CxZd1q2NnHpToLkEjO_194', '', 2, 1, NULL, 0, '2022-09-15 11:08:51'),
(195, 2, '', '', 'default_background_image.png', 'pornovideolarifsa@gmail.com', '', '63232b5a24345vbKMclU0RFgJYp87do_195', '', 2, 1, NULL, 0, '2022-09-15 13:40:23'),
(196, 2, 'deneme', 'user.png', 'default_background_image.png', 'deneme@gmail.com', 'cb345e66b9367ef0b836a032d187a709', '', 'napcan', 1, 1, NULL, 0, '2022-09-15 13:54:44'),
(198, 2, '', '', 'default_background_image.png', 'smartt.appss@gmail.com', '', '6323e4fb67144dflAVKRavXSc7NT1i6_198', '', 2, 1, NULL, 0, '2022-09-16 02:52:43'),
(199, 2, '', '', 'default_background_image.png', 'derrickcastillo.01045@gmail.com', '', '6323e8359aaf5uxL4w3ZWGcs1YProfO_199', '', 2, 1, NULL, 0, '2022-09-16 03:06:29'),
(200, 2, 'abid', 'user.png', 'default_background_image.png', 'abid@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '6323f4e3d9c99aVJpYFRj3nLzHT6Asv_200', '9874568745', 1, 1, NULL, 0, '2022-09-16 04:00:21'),
(201, 2, '', '', 'default_background_image.png', 'pushaprajverma67@gmail.com', '', '6323fe49786996o9Cf3UPGHO4pyuZwX_201', '', 2, 1, NULL, 0, '2022-09-16 04:40:00'),
(202, 2, 'Pushap Raj Verma', 'user.png', 'default_background_image.png', 'iprvermaa@gmail.com', '2110c82d4f4c212d92b38562e7219569', '6323fe83db1ccnyd2lm5bOuL0QksDEo_202', '9805281458', 1, 1, NULL, 0, '2022-09-16 04:41:24'),
(203, 2, '', '', 'default_background_image.png', 'abdullatifabdu@gmail.com', '', '63286a36703a25Mx3UFRizlKN8JAgdX_203', '', 2, 1, NULL, 0, '2022-09-16 14:49:22'),
(204, 2, 'Africa Francis', 'user.png', 'default_background_image.png', 'asikufrancis2@gmai.com', '0f5fe9f518acdd0272e181a8d9f4c76d', '6324ac74667d3dDjgutZ9wmY1vFz4GM_204', '0784403443', 1, 1, NULL, 0, '2022-09-16 16:59:43'),
(205, 2, '', '', 'default_background_image.png', 'venteperso77@gmail.com', '', '6324f90ca9edfzSAjtxX1hqMweZY5Qg_205', '', 2, 1, NULL, 0, '2022-09-16 22:30:36'),
(206, 2, '', '', 'default_background_image.png', 'seromedaniel@gmail.com', '', '632e8969cea1e8qBkThHFVfJLXDy4WA_206', '', 2, 1, NULL, 0, '2022-09-17 01:03:11'),
(207, 2, '', '', 'default_background_image.png', 'mcpatel219@gmail.com', '', '632523e76b9e7Nxkvo98YCQtLRiaVlB_207', '', 2, 1, NULL, 0, '2022-09-17 01:33:27'),
(208, 2, '', '', 'default_background_image.png', 'jaydipsurani@gmail.com', '', '632526ee97352mVhdRGNL0TSYia98B3_208', '', 2, 1, NULL, 0, '2022-09-17 01:46:22'),
(209, 2, '', '', '', '', '', '', '+919978468886', 3, 1, NULL, 0, '2022-09-17 01:46:53'),
(210, 2, '', '', 'default_background_image.png', 'priyastack9@gmail.com', '', '6328180e3e63eawU2KGkZ6uHSvd5jqO_210', '', 2, 1, NULL, 0, '2022-09-17 04:37:22'),
(211, 2, '', '', '', '', '', '', '+918200883041', 3, 1, NULL, 0, '2022-09-17 06:31:40'),
(212, 2, '', '', 'default_background_image.png', 'asvinpatel808@gmail.com', '', '63257f780a8e7HsbAxJqONM3nPrRdp0_212', '', 2, 1, NULL, 0, '2022-09-17 08:03:55'),
(213, 2, 'rua', 'user.png', 'default_background_image.png', 'ruatfela64@gmail.com', '414d6c4878db716c897f0de5c102e4da', '6325b3d58274basMYhSXwrE0OC3Gfi6_213', '9089601490', 1, 1, NULL, 0, '2022-09-17 11:47:22'),
(214, 2, '', '', '', '', '', '', '+919913269834', 3, 1, NULL, 0, '2022-09-17 12:01:20'),
(215, 2, '', '', 'default_background_image.png', 'mikegeorge.90325@gmail.com', '', '6325b8d14588b4y21tW9bK8FuCrVapg_215', '', 2, 1, NULL, 0, '2022-09-17 12:08:49'),
(216, 2, 'Bebiya17', 'user.png', 'default_background_image.png', 'bebiya171656@edxplus.com', '02c75fb22c75b23dc963c7eb91a062cc', '6325c0a60a2e7lnZLHRP6MfI1iBop5V_216', '9000000001', 1, 1, NULL, 0, '2022-09-17 12:41:38'),
(217, 2, '', '', 'default_background_image.png', 'csatrabalho3@gmail.com', '', '6325f51874c0eWApe5sjPlYw3QxByo1_217', '', 2, 1, NULL, 0, '2022-09-17 16:26:00'),
(218, 2, 'Cristiano ', 'user.png', 'default_background_image.png', 'cliente@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '6325f60103d23uVGtvPORf8q7ih3Sce_218', '7768975478', 1, 1, NULL, 0, '2022-09-17 16:29:32'),
(219, 2, 'harry', 'user.png', '', 'harib@hotmail.com', 'e10adc3949ba59abbe56e057f20f883e', '6326d918bb4c9jAx0N4J8b7SCMVzQTc_219', '9901302', 1, 1, NULL, 0, '2022-09-17 18:13:53'),
(220, 2, '', '', 'default_background_image.png', 'meriidhai01@gmail.com', '', '6326e251ba02drlWRcs7Vkn5IAMzHYi_220', '', 2, 1, NULL, 0, '2022-09-18 09:18:03'),
(221, 2, '', '', 'default_background_image.png', 'appbuysellbd@gmail.com', '', '6326eda8cd351jM9ZvmEltrSWVykBfI_221', '', 2, 1, NULL, 0, '2022-09-18 10:06:32'),
(222, 2, '', '', '', '', '', '', '+8801650232288', 3, 1, NULL, 0, '2022-09-18 10:07:15'),
(223, 2, '', '', '', '', '', '', '+916351285929', 3, 1, NULL, 0, '2022-09-18 12:44:02'),
(224, 2, 'jimmy', 'user.png', 'default_background_image.png', 'Jimmy38allen029@outlook.com ', 'fa4852e174433fdd6b66fe9293041b70', '', '(857) 323-1008', 1, 1, NULL, 0, '2022-09-19 04:06:32'),
(225, 2, '', '', 'default_background_image.png', 'joonkt.lee@gmail.com', '', '63281e0e7eda0JUgnkLwfQDOaCl8IFv_225', '', 2, 1, NULL, 0, '2022-09-19 07:45:18'),
(226, 2, '', '', 'default_background_image.png', 'sachinsingh4084@gmail.com', '', '6328458fed2b9OqijYTonH38zX6tycV_226', '', 2, 1, NULL, 0, '2022-09-19 10:33:35'),
(227, 2, '', '', 'default_background_image.png', 'hashimjodahalawi@gmail.com', '', '63423f1814061GSbmj0DEHcqZKf3agv_227', '', 2, 1, NULL, 0, '2022-09-19 17:42:23'),
(228, 2, '', '', 'default_background_image.png', 'identicalpeter@gmail.com', '', '6329cf5846dfd85w7vkTOrc6aPdlCMJ_228', '', 2, 1, NULL, 0, '2022-09-20 14:34:00'),
(229, 2, '', '', '', '', '', '', '+2348060332224', 3, 1, NULL, 0, '2022-09-20 14:34:46'),
(230, 2, 'Craig', 'user.png', 'default_background_image.png', 'craig@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '632bfb4aaf5d98lDQsnOk92SB6y7wKt_230', '777777', 1, 1, NULL, 0, '2022-09-22 06:05:47'),
(231, 2, '', '', 'default_background_image.png', 'skkudan@gmail.com', '', '632c282b2ea57u34feQO7RnmTsFc2vq_231', '', 2, 1, NULL, 0, '2022-09-22 09:17:31'),
(232, 2, '', '', '', '', '', '', '+918019285811', 3, 1, NULL, 0, '2022-09-22 09:18:03'),
(233, 2, '', '', 'default_background_image.png', 'josecute7@gmail.com', '', '632ca08b0ba918H2ctjY4OzCKDsuibU_233', '', 2, 1, NULL, 0, '2022-09-22 17:51:07'),
(234, 2, '', '', 'default_background_image.png', 'networksystemone@gmail.com', '', '632d06f2e231fe3UkplyjtAwaHGiZuL_234', '', 2, 1, NULL, 0, '2022-09-23 01:06:01'),
(235, 2, '', '', 'default_background_image.png', 'swafa7720@gmail.com', '', '632d5f818c80a0hZp25zVUIfobq3SwM_235', '', 2, 1, NULL, 0, '2022-09-23 07:25:48'),
(236, 2, '', '', 'default_background_image.png', 'helensaunders.33249@gmail.com', '', '632e813a738b7Khm1jCEO0RX5ZxLald_236', '', 2, 1, NULL, 0, '2022-09-24 04:02:02'),
(237, 2, '', '', 'default_background_image.png', 'mitchluvmusic@gmail.com', '', '6332b148455965YOQFEtC2ukM3qm7JL_237', '', 2, 1, NULL, 0, '2022-09-27 08:16:08'),
(238, 2, '', '', 'default_background_image.png', 'abedalmnam6@gmail.com', '', '6332e48284351Q1Oirq7TEGtBc0xvek_238', '', 2, 1, NULL, 0, '2022-09-27 11:54:24'),
(239, 2, '', '', 'default_background_image.png', 'bestintradaycall@gmail.com', '', '63354c711c835Xiet73kPyECxpbJfnm_239', '', 2, 1, NULL, 0, '2022-09-29 07:40:33'),
(240, 2, '', '', 'default_background_image.png', 'abhishekjain.acs@gmail.com', '', '6335f7ff10bedNrHxW8BLaD0vbhfJ6p_240', '', 2, 1, NULL, 0, '2022-09-29 19:52:33'),
(241, 2, '', '', '', '', '', '', '+919584827298', 3, 1, NULL, 0, '2022-09-29 19:55:11'),
(242, 2, '', '', 'default_background_image.png', 'qra6666@gmail.com', '', '633ed7f9b57cdgVjoKObnRdFZtPcCAz_242', '', 2, 1, NULL, 0, '2022-09-30 17:21:45'),
(243, 2, 'rash', 'user.png', 'default_background_image.png', 'rashidsharif6666@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '633725eed020e8MiErj6AbSeI5cPW7X_243', '56533642', 1, 1, NULL, 0, '2022-09-30 17:22:35'),
(244, 2, '', '', 'default_background_image.png', 'deonetflix7@gmail.com', '', '6338b715e1c776f2JIa7AO0msUK9gEi_244', '', 2, 1, NULL, 0, '2022-10-01 21:53:56'),
(245, 2, '', '', 'default_background_image.png', 'mohammadkaouakibi@gmail.com', '', '633d4c84a0763nQ789BwAaTGiNORutz_245', '', 2, 1, NULL, 0, '2022-10-02 13:47:43'),
(246, 2, '', '', 'default_background_image.png', 'solomonthomas82@gmail.com', '', '633a380d520e8gvT150PqlZhHxsINE4_246', '', 2, 1, NULL, 0, '2022-10-03 01:17:01'),
(247, 2, '', '', 'default_background_image.png', 'vrlsatuci@gmail.com', '', '633d292a95823c7Y8O5HB1bwzgluGvJ_247', '', 2, 1, NULL, 0, '2022-10-05 06:50:18'),
(248, 2, '', '', '', '', '', '', '+905373195123', 3, 1, NULL, 0, '2022-10-05 06:50:43'),
(249, 2, 'Onyerikam', 'user.png', 'default_background_image.png', 'onyerikam3@gmail.com', '1ed4a3d6c1c6e1c87c7cc96d1d3ebdf7', '6341be618e80fyHDMBNq6IG1fvV9a3c_249', '0905893562', 1, 1, NULL, 0, '2022-10-08 18:15:28'),
(250, 2, '', '', 'default_background_image.png', 'shahsujon80@gmail.com', '', '6342755c71be2BGD8QAIiPelx9HCTXE_250', '', 2, 1, NULL, 0, '2022-10-09 07:16:44'),
(251, 2, 'dxhieu', 'user.png', 'default_background_image.png', 'dxhieuc10@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '0329961247', 1, 1, NULL, 0, '2022-10-11 10:22:37'),
(252, 2, '', '', '', '', '', '', '+620895369724500', 3, 1, NULL, 0, '2022-10-15 14:22:06'),
(254, 2, '', '', 'default_background_image.png', 'esdras.ferreira999@gmail.com', '', '63503c672281c6ZaKbyr2q8LHonJERC_254', '', 2, 1, NULL, 0, '2022-10-19 18:05:13'),
(255, 2, 'KJ', 'user.png', 'default_background_image.png', 'assalam.walaikum.ji@gmail.com', '40fbe32a8a5789ea8f62f978c81d2ba7', '63539235b56612WKNSUGpa5tVHYduCO_255', '9999778866', 1, 1, NULL, 0, '2022-10-22 06:47:25'),
(256, 2, '', '', 'default_background_image.png', 'christianmediastamil@gmail.com', '', '635429ce68e6dtDXYZL0A5jUHivT3u6_256', '', 2, 1, NULL, 0, '2022-10-22 17:34:56'),
(257, 2, '', '', 'default_background_image.png', 'kishangopi232@gmail.com', '', '63549c1a3f318PYTcGAspQaM8F5y1rH_257', '', 2, 1, NULL, 0, '2022-10-23 01:42:50'),
(258, 2, '', '', 'default_background_image.png', 'nikiwikiteam@gmail.com', '', '635525ad4112azpnTVbgXPG6ykl2HR4_258', '', 2, 1, NULL, 0, '2022-10-23 11:29:35'),
(259, 2, '', '', 'default_background_image.png', 'nougheez@gmail.com', '', '63567cb87640b9L4ECVPZF617mjMQwy_259', '', 2, 1, NULL, 0, '2022-10-24 11:53:19'),
(260, 2, '', '', 'default_background_image.png', 'dbcontent1@gmail.com', '', '636d0794ce2c1sBYZNfIVApzauFSOGt_260', '', 2, 1, NULL, 0, '2022-10-24 16:59:50'),
(262, 2, 'Jemboot', 'user.png', 'default_background_image.png', 'gicidi5313@3mkz.com', 'ac43724f16e9241d990427ab7c8f4228', '635f609e9f15bw7N28fOr4Koe6ThAtx_262', '087777776868', 1, 1, NULL, 0, '2022-10-31 05:43:47'),
(263, 2, '', '', 'default_background_image.png', 'mdmasumbella2113@gmail.com', '', '63826cc4d38c5JCFHGab3Oqjlhwe8X9_263', '', 2, 1, NULL, 0, '2022-10-31 19:39:52'),
(264, 2, '', '', 'default_background_image.png', 'abdelmksoud83@gmail.com', '', '63653e138f784J1qEItsa84hLboSHPC_264', '', 2, 1, NULL, 0, '2022-11-04 16:29:53'),
(265, 2, '', '', 'default_background_image.png', 'lordesy01@gmail.com', '', '6367e01e69bb1Jf3t8LjWYFagqZ6OlH_265', '', 2, 1, NULL, 0, '2022-11-06 16:25:57'),
(266, 2, 'kadirofe Ben', 'user.png', 'default_background_image.png', 'kadirofe89@gmail.com', '5fd0d6c580e31d2036c6af93f037a1e8', '63680ce9e77c1Ioj8wqDxPlV0n1eLvu_266', '086432245', 1, 1, NULL, 0, '2022-11-06 19:36:55'),
(267, 2, 'mangmi', 'user.png', 'default_background_image.png', 'mangmi@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '63685e6891311CI6XnEwSDrdqVRk5Uv_267', '0895925364', 1, 1, NULL, 0, '2022-11-07 01:24:36'),
(268, 2, '', '', 'default_background_image.png', 'imtiazsaifullah.m@gmail.com', '', '63697c90969f6nieRJDW4pTzhu9mSXt_268', '', 2, 1, NULL, 0, '2022-11-07 21:45:49'),
(269, 2, '', '', 'default_background_image.png', 'gvandeenen1981@gmail.com', '', '636d3532487f6A8MnT5aFrmxv6fukeD_269', '', 2, 1, NULL, 0, '2022-11-10 17:29:33'),
(271, 2, '', '', 'default_background_image.png', 'dhruvendra66@gmail.com', '', '636e0dfceb1bd57winGIMSq68uKyoAU_271', '', 2, 1, NULL, 0, '2022-11-11 08:51:19'),
(272, 2, '', '', 'default_background_image.png', 'editor.rams@gmail.com', '', '6370b57ce3559x7BS9HXvJjbnzmcUOw_272', '', 2, 1, NULL, 0, '2022-11-13 09:14:32'),
(273, 2, '', '', 'default_background_image.png', 'ashikurrahman6436@gmail.com', '', '6373448637403h79mRMXHPu0tgsdlnV_273', '', 2, 1, NULL, 0, '2022-11-15 07:49:15'),
(274, 2, '', '', 'default_background_image.png', 'mynpjob@gmail.com', '', '637659597da15Pxb5QNOTF9n81X7kV2_274', '', 2, 1, NULL, 0, '2022-11-17 15:54:55'),
(275, 2, '', '', 'default_background_image.png', 'abdelazeez.yousef@gmail.com', '', '6377a7f4f22e8JvtW9G1BxYRdpmQAeT_275', '', 2, 1, NULL, 0, '2022-11-18 15:36:31'),
(276, 2, 'ghh', 'user.png', 'default_background_image.png', 'vbo', '7371a12b02592b0df19f6179b6b1f57c', '', 'tyj', 1, 1, NULL, 0, '2022-11-18 19:48:03'),
(277, 2, 'janedoe', 'user.png', 'default_background_image.png', 'jane@doe.com', 'e10adc3949ba59abbe56e057f20f883e', '6377e1a68986dX7Ss6E1kgdDa5hl42p_277', '12345', 1, 1, NULL, 0, '2022-11-18 19:48:40'),
(278, 2, 'shivam vyas', 'user.png', 'default_background_image.png', 'shivam@gmail.com', '50c155d72e01e9e1bd16341139d2495b', '637b43d8c6da5pRCUWJh7ix6Vo31Qec_278', '8469781667', 1, 1, NULL, 0, '2022-11-21 09:24:26'),
(280, 2, '', '', 'default_background_image.png', '092196tjk@gmail.com', '', '6380578aaaf55VnsI0mF6WZGY1XyHe2_280', '', 2, 1, NULL, 0, '2022-11-25 05:50:02'),
(281, 2, '', '', '', '', '', '', '+79996674334', 3, 1, NULL, 0, '2022-11-25 05:50:50'),
(282, 2, '', '', 'default_background_image.png', 'martin.mucito@gmail.com', '', '6384d15ede1a5GnF4N5TLDtAhbXzHr7_282', '', 2, 1, NULL, 0, '2022-11-28 15:16:23'),
(283, 2, '', '', 'default_background_image.png', 'scyanh@gmail.com', '', '638586e0247c8kEQVjbcGwd2ATCIyO1_283', '', 2, 1, NULL, 0, '2022-11-29 04:13:17'),
(284, 2, '', '', 'default_background_image.png', 'padma1184@gmail.com', '', '6385f20b07d79J5DS2A8lTQHuyEkpIx_284', '', 2, 1, NULL, 0, '2022-11-29 11:50:35'),
(285, 2, '', 'user.png', 'default_background_image.png', 'dorajoj527@probdd.com', 'f925916e2754e5e03f75dd58a5733251', '6386f13839a8dBiCcYPxuhX6zj8DrHm_285', '9887753256', 1, 1, NULL, 0, '2022-11-30 05:59:04'),
(286, 2, '', '', 'default_background_image.png', 'ksubramani860@gmail.com', '', '63877e37cf054x7d8ibmZYDk1hzvHcp_286', '', 2, 1, NULL, 0, '2022-11-30 16:00:55'),
(287, 2, '', '', '', '', '', '', '+91546789235', 3, 1, NULL, 0, '2022-12-01 07:48:28'),
(288, 2, '', '', 'default_background_image.png', 'pornalfa1@gmail.com', '', '6388f51ccdcdb2S8xA4q7LcZ3mzkGUM_288', '', 2, 1, NULL, 0, '2022-12-01 18:38:32'),
(289, 2, '', '', 'default_background_image.png', 'trukito.webmaster@gmail.com', '', '6393a0cfe5241kdl5ngsNz6HOfC8yPj_289', '', 2, 1, NULL, 0, '2022-12-09 20:55:43'),
(290, 2, '', '', '', '', '', '', '+51967277106', 3, 1, NULL, 0, '2022-12-09 20:56:18'),
(291, 2, '', '', '', '', '', '', '+918306240012', 3, 1, NULL, 0, '2022-12-10 09:44:57'),
(292, 2, '', '', 'default_background_image.png', 'shivamvyas2610@gmail.com', '', '639c221522d5bDpFgoZks6PayR9KGYh_292', '', 2, 1, NULL, 0, '2022-12-16 07:45:25'),
(293, 2, '', '', '', '', '', '', '+916351212608', 3, 1, NULL, 0, '2022-12-16 07:46:43'),
(294, 2, '', '', '', '', '', '', '+918012120120', 3, 1, NULL, 0, '2022-12-16 12:40:23'),
(295, 2, '', '', 'default_background_image.png', 'ckpatel219@gmail.com', '', '64005e0347721qjB1n8Rk69FLKvgOhy_295', '', 2, 1, NULL, 0, '2022-12-21 13:54:48'),
(296, 2, 'Arjun', 'user.png', 'default_background_image.png', 'arjun111222@dt.com', 'e10adc3949ba59abbe56e057f20f883e', '', '989898989', 1, 1, NULL, 0, '2022-12-22 06:03:01'),
(297, 2, 'arjun', 'user.png', 'default_background_image.png', 'arjun1001@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '3879879', 1, 1, NULL, 0, '2022-12-22 06:17:26'),
(298, 2, 'arjun', 'user.png', 'default_background_image.png', 'arjun1002@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '38798793', 1, 1, NULL, 0, '2022-12-22 06:18:47'),
(299, 2, '', '', 'default_background_image.png', 'rpr.sanjaysharma@gmail.com', '', '63b484de6c8bbCkiLrZBMY7stNoTlx5_299', '', 2, 1, NULL, 0, '2023-01-03 19:41:18'),
(300, 2, '', '', 'default_background_image.png', 'rjjangid911@gmail.com', '', '63b56ffb6f991THm9Di2ChYFIqfXye4_300', '', 2, 1, NULL, 0, '2023-01-04 12:24:27'),
(301, 2, '', '', 'default_background_image.png', 'nwakamoshi@gmail.com', '', '63bb0e5403c12XWvBbTzhmVLU0pwDjY_301', '', 2, 1, NULL, 0, '2023-01-08 18:41:18'),
(302, 2, 'sunilkumar', 'user.png', 'default_background_image.png', 'sunilkumar@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '63c2626e9ad8dNAgHIYGm8u642Zk59n_302', '111111111', 1, 1, NULL, 0, '2023-01-14 08:05:48'),
(303, 2, '', '', 'default_background_image.png', 'tmiguelssantos@gmail.com', '', '63c48abbd7b37nF80HxGwpBE1ZjqJ7S_303', '', 2, 1, NULL, 0, '2023-01-15 23:22:27'),
(304, 2, '', '', 'default_background_image.png', 'contablindada.com@gmail.com', '', '63c59c6eb7acaXSxcJHIP4DGkd3vriC_304', '', 2, 1, NULL, 0, '2023-01-16 18:50:14'),
(305, 2, '', '', 'default_background_image.png', 'info.sadlove11@gmail.com', '', '63c8f687480e3Ew6gzU5THVvQ83xLuI_305', '', 2, 1, NULL, 0, '2023-01-19 07:51:35'),
(306, 2, '', '', 'default_background_image.png', 'bsourabh356@gmail.com', '', '63c96760cb22ees2coibVhnfCAOp3FL_306', '', 2, 1, NULL, 0, '2023-01-19 15:53:04'),
(307, 2, '', '', 'default_background_image.png', 'techfamy@gmail.com', '', '63ce8502b65992pxDeQEXNgca8kw7Gt_307', '', 2, 1, NULL, 0, '2023-01-23 13:00:50'),
(308, 2, '', '', 'default_background_image.png', 'naveedislam545@gmail.com', '', '63ce891c23fa7l0zgDIKATov4PH3JNV_308', '', 2, 1, NULL, 0, '2023-01-23 13:15:01');
INSERT INTO `tbl_user` (`id`, `role_id`, `fullname`, `image`, `background_image`, `email`, `password`, `auth_token`, `mobile`, `type`, `status`, `package_expiry_date`, `is_updated`, `created_at`) VALUES
(309, 2, '', '', 'default_background_image.png', 'monk.developer.ghy@gmail.com', '', '63ce8c6422100S7Mobc6qL5KpTDuOZz_309', '', 2, 1, NULL, 0, '2023-01-23 13:32:13'),
(310, 2, '', '', 'default_background_image.png', 'kegan.coleman1@gmail.com', '', '63cec38561557rFhW8iQR0xSebPyJk3_310', '', 2, 1, NULL, 0, '2023-01-23 17:27:33'),
(311, 2, '', '', 'default_background_image.png', 'kara.haider2020@gmail.com', '', '63cfddf000c69rZwSh76XnokqvBdKIc_311', '', 2, 1, NULL, 0, '2023-01-24 13:32:25'),
(312, 2, 'eldarovms', 'user.png', 'default_background_image.png', 'musaeldarov@gmail.com', '25f9e794323b453885f5181f1b624d0b', '63d0f37c935a67Xj3fytSopdVabQs5q_312', '+994702180868', 1, 1, NULL, 0, '2023-01-25 09:15:59'),
(313, 2, 'Sabir', 'user.png', 'default_background_image.png', 'sabiralakber22@gmail.com ', '74636d31362f12722b005f2162a9363c', '63d27ac682193oyj1irLIbcaZgM3VFR_313', '0559642706 ', 1, 1, NULL, 0, '2023-01-26 13:06:01'),
(314, 2, '', '', 'default_background_image.png', 'sanibansari120@gmail.com', '', '63d49b7aaec2bv69t0UpiCSl78asgeG_314', '', 2, 1, NULL, 0, '2023-01-28 03:48:55'),
(315, 2, '', '', '', '', '', '', '+994702185888', 3, 1, NULL, 0, '2023-01-28 13:47:01'),
(316, 2, '', '', '', '', '', '', '+994559642706', 3, 1, NULL, 0, '2023-01-28 13:57:13'),
(317, 2, '', '', '', '', '', '', '+994508638524', 3, 1, NULL, 0, '2023-01-30 10:04:13'),
(318, 2, '', '', '', '', '', '', '+994552039226', 3, 1, NULL, 0, '2023-01-30 10:31:05'),
(319, 2, '', '', 'default_background_image.png', 'yerelkarne@gmail.com', '', '63d97c092687bjxLBH19YkrMQpKlGoA_319', '', 2, 1, NULL, 0, '2023-01-31 20:37:13'),
(320, 2, '', '', 'default_background_image.png', 'arssi.bogor001@gmail.com', '', '63da568830a917gMfRYxZhjUDXEerV3_320', '', 2, 1, NULL, 0, '2023-02-01 12:09:44'),
(321, 2, '', '', '', '', '', '', '+917076609087', 3, 1, NULL, 0, '2023-02-08 08:32:02'),
(322, 2, '', '', '', '', '', '', '+994517274152', 3, 1, NULL, 0, '2023-02-09 08:51:16'),
(323, 2, '', '', 'default_background_image.png', 'scholarmwangi64@gmail.com', '', '63eb4bd0161beScvkajzAqW3Bt2NufJ_323', '', 2, 1, NULL, 0, '2023-02-14 08:47:14'),
(324, 2, '', '', 'default_background_image.png', 'sharmaventures.in@gmail.com', '', '63ee1086cfa8dLweIfcBYov1rsEpu5O_324', '', 2, 1, NULL, 0, '2023-02-16 10:21:03'),
(325, 2, 'Semral Sadiq', 'user.png', 'default_background_image.png', 'semralsadiq@gmail.com', '5f2c8d696e63fab7bee0d3d55148a905', '', '0505921908', 1, 1, NULL, 0, '2023-02-18 10:38:00'),
(326, 2, 'CAVAD', 'user.png', 'default_background_image.png', 'semralsadiq067@gmail.com', '5f2c8d696e63fab7bee0d3d55148a905', '', '994517274152', 1, 1, NULL, 0, '2023-02-18 10:40:15'),
(327, 2, '', '', 'default_background_image.png', 'karimfbskarim@gmail.com', '', '63f1626fa9cb22vLJpiS6RYm7U0Xagw_327', '', 2, 1, NULL, 0, '2023-02-18 23:42:30'),
(328, 2, 'byron', 'user.png', 'default_background_image.png', 'mundourbanofm@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '63f53e2262246LRSdY4gOavVC3MFmui_328', '0988303279', 1, 1, NULL, 0, '2023-02-21 21:56:37'),
(329, 2, '', '', 'default_background_image.png', 'achtakir0@gmail.com', '', '63f8e6a7c5c62cvqjTCVlio29tSPxyA_329', '', 2, 1, NULL, 0, '2023-02-24 16:32:31'),
(330, 2, '', '', 'default_background_image.png', 'dastardlybunny47@gmail.com', '', '63fa91f452416kLgu9ODYmWU6FJhVaf_330', '', 2, 1, NULL, 0, '2023-02-25 22:55:48'),
(331, 2, '', '', 'default_background_image.png', 'sudhanshuvrns@gmail.com', '', '63fb5e8ccc0a2wIR2smueivDfxa9z14_331', '', 2, 1, NULL, 0, '2023-02-26 13:28:09'),
(332, 2, '', '', 'default_background_image.png', 'sivait34@gmail.com', '', '63ff6dad5eef3tuvo5aA63Tzyh4kQp1_332', '', 2, 1, NULL, 0, '2023-03-01 15:22:21'),
(333, 2, '', '', 'default_background_image.png', 'khanrahish776@gmail.com', '', '64005134bce1dIc5yW48sSTPoGtEJha_333', '', 2, 1, NULL, 0, '2023-03-02 07:33:08'),
(334, 2, '', '', 'default_background_image.png', 'suskampala256@gmail.com', '', '6401c8eabeb89hPSKdywQfCHZtMm3UO_334', '', 2, 1, NULL, 0, '2023-03-03 10:16:10'),
(335, 2, '', '', 'default_background_image.png', 'posanicnu@gmail.com', '', '6405824936d4bZanbUVl7tOsv09CyuW_335', '', 2, 1, NULL, 0, '2023-03-06 06:03:53'),
(336, 2, '', '', '', '', '', '', '+918220785431', 3, 1, NULL, 0, '2023-03-06 18:17:55'),
(337, 2, '', '', '', '', '', '', '+5512996849756', 3, 1, NULL, 0, '2023-03-09 03:37:07'),
(338, 2, '', '', 'default_background_image.png', 'shubhams.daundkar123@gmail.com', '', '640f0313f0351nV8v0QfFedG2g3aSz5_338', '', 2, 1, NULL, 0, '2023-03-13 11:02:34'),
(339, 2, '', '', 'default_background_image.png', 'arpanpadamani2000@gmail.com', '', '640fe9356d69cdVo9J2U3YkLPmnNCXH_339', '', 2, 1, NULL, 0, '2023-03-14 03:25:28'),
(340, 2, '', '', '', '', '', '', '+918309190519', 3, 1, NULL, 0, '2023-03-15 10:08:57'),
(341, 2, 'Support', '1679482951.jpg', 'default_background_image.png', 'support@divinetechs.com', '', '641adc5f779e7audq9YGpWLNf0SURcl_341', '1112222222', 2, 1, NULL, 1, '2023-03-17 13:37:00'),
(342, 2, 'Thiyagarajan', '', 'default_background_image.png', 'thiyateju.galaxys9plus@gmail.com', '', '64146f4617c33vwkFDLQ81tnyzic3VH_342', '9003730200', 2, 1, NULL, 1, '2023-03-17 13:46:37'),
(343, 2, '', '', 'default_background_image.png', 'tptmedia2020@gmail.com', '', '641aeebc7b773wiES39jDdQblFLZmBI_343', '', 2, 1, NULL, 0, '2023-03-22 12:04:12'),
(344, 2, 'hi', '1679577304.jpg', '', 'support@divinetechs.com', '', '', '9003730200', 3, 1, NULL, 1, '2023-03-22 12:06:03'),
(345, 2, 'adamobile', 'user.png', 'default_background_image.png', 'mrdamsg', 'c5fde9de2d29789a81d1bc0f16292048', '', '0997777', 1, 1, NULL, 0, '2023-03-23 17:46:49'),
(346, 2, '', '', 'default_background_image.png', 'ranjithnani1405@gmail.com', '', '641e99b5bc090d1wsP8fkq2KDCJcSR9_346', '', 2, 1, NULL, 0, '2023-03-25 06:50:29'),
(347, 2, 'ranjith1405', 'user.png', 'default_background_image.png', 'ranjithsutrala14@gmail.com', 'b520f2b66756072580640c3f2766941d', '', 'Sr@9652594627', 1, 1, NULL, 0, '2023-03-25 06:51:36'),
(348, 2, '', '', '', '', '', '', '+919177442252', 3, 1, NULL, 0, '2023-03-25 06:54:39'),
(349, 2, 'vuassist', 'user.png', 'default_background_image.png', 'vuassist@gmail.com', '57d75596282dcc9aadb5c8bb40206a63', '641f2f92ac558T8XspiDgNlMnJu1r3U_349', '+316695', 1, 1, NULL, 0, '2023-03-25 17:28:39'),
(350, 2, 'samuca ', 'user.png', 'default_background_image.png', 'juca@cinemaeingles.com ', '9b13e59273c8a9e5a9b46c1cabcf3255', '641facea6573cgJa7OVdkFW81KiHCPG_350', '235689', 1, 1, NULL, 0, '2023-03-26 02:20:26'),
(351, 2, '', '', 'default_background_image.png', 'martinsbruno061@gmail.com', '', '64263675cddc3lyEZFU7NH5pvtfGeMR_351', '', 2, 1, NULL, 0, '2023-03-31 01:24:53'),
(352, 2, '', '', '', '', '', '', '+5511948340223', 3, 1, NULL, 0, '2023-03-31 01:26:23'),
(353, 2, '', '', 'default_background_image.png', 'yougajr@gmail.com', '', '6428e68333bb9LOeQm0yqGc2HxhU3nz_353', '', 2, 1, NULL, 0, '2023-04-02 02:18:55'),
(354, 2, 'babm', '', '', 'support@divinetechs.com', '', '', '2126857895', 3, 1, NULL, 1, '2023-04-02 17:55:30'),
(361, 2, '', '', 'default_background_image.png', 'patelsanjay.it@gmail.com', '', '6431405c7120e4lAX1a7Rx5UFZqbkHe_361', '', 2, 1, NULL, 0, '2023-04-08 10:22:20'),
(362, 2, '', '', 'default_background_image.png', 'developer.divinetechs@gmail.com', '', '6431423f1af2cZLz8OrNXKCqQMTHDbB_362', '', 2, 1, NULL, 0, '2023-04-08 10:23:53');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_notification_tracking`
--

CREATE TABLE `tbl_user_notification_tracking` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `notification_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `tbl_user_notification_tracking`
--

INSERT INTO `tbl_user_notification_tracking` (`id`, `user_id`, `notification_id`, `created_at`) VALUES
(1, 2, 3, '2022-08-24 05:40:01'),
(2, 2, 3, '2022-08-24 05:41:56'),
(3, 2, 3, '2022-08-24 06:12:00'),
(4, 1, 4, '2023-03-02 09:52:42'),
(5, 11, 6, '2023-03-02 10:21:28'),
(6, 11, 5, '2023-03-02 10:22:31'),
(7, 11, 1, '2023-03-02 10:24:10'),
(8, 11, 2, '2023-03-02 10:24:17'),
(9, 11, 3, '2023-03-02 10:24:22'),
(10, 11, 4, '2023-03-02 10:24:24'),
(11, 344, 8, '2023-03-22 00:07:33'),
(12, 344, 8, '2023-03-22 00:07:33'),
(13, 344, 8, '2023-03-22 00:07:33'),
(14, 344, 8, '2023-03-22 00:07:33'),
(15, 344, 1, '2023-03-22 00:07:35'),
(16, 344, 1, '2023-03-22 00:07:35'),
(17, 344, 7, '2023-03-22 00:07:36'),
(18, 344, 6, '2023-03-22 00:07:38'),
(19, 344, 5, '2023-03-22 00:07:39'),
(20, 344, 4, '2023-03-22 00:07:41'),
(21, 344, 3, '2023-03-22 00:07:42'),
(22, 344, 2, '2023-03-22 00:07:44');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_video`
--

CREATE TABLE `tbl_video` (
  `id` int NOT NULL,
  `artist_id` int NOT NULL,
  `category_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `video_type` varchar(255) NOT NULL,
  `url` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `image` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `v_view` int NOT NULL,
  `v_like` int NOT NULL,
  `is_feature` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `is_paid` int NOT NULL COMMENT '0- free, 1- paid',
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_video`
--

INSERT INTO `tbl_video` (`id`, `artist_id`, `category_id`, `name`, `description`, `video_type`, `url`, `image`, `v_view`, `v_like`, `is_feature`, `is_paid`, `status`, `created_at`) VALUES
(1, 1, 5, 'Get ready to fight - Baaghi 3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque fringilla nisi vitae mollis cursus. Suspendisse a egestas eros. Nulla condimentum magna in tortor auctor dictum. Nam elementum sem est, id aliquet dui tristique sit amet. Sed mattis dolor vel nibh fringilla dictum. Quisque a ultrices ipsum. Cras odio lacus, dictum placerat ultricies ac, tincidunt eget massa. Suspendisse ut metus in turpis sollicitudin tincidunt.', 'video', '1608461262.mp4', '1662375303.jpg', 845, 1, '1', 0, 1, '2020-01-03 23:49:14'),
(3, 10, 4, 'Asvaar - Hellaro', 'Proin id sagittis elit. Proin luctus ligula nec sagittis euismod. Phasellus neque sapien, eleifend vitae urna sed, pharetra pretium urna. Aenean posuere neque et elit tincidunt pharetra eget nec libero. Aenean eget pulvinar elit. Quisque tellus elit.', 'youtube', 'w8b4nPOlzSM', '1662374432.jpg', 953, 447, '0', 0, 0, '2019-07-07 19:48:37'),
(5, 5, 5, 'Jai Jai Shivshankar - War', 'Hrithik Roshan and Tiger Shroff create magic, one move at a time in the celebratory song Jai Jai Shivshankar - full song.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque fringilla nisi vitae mollis cursus. Suspendisse a egestas eros. Nulla condimentum magna in tortor auctor dictum. Nam elementum sem est, id aliquet dui tristique sit amet. Sed mattis dolor vel nibh fringilla dictum. Quisque a ultrices ipsum. Cras odio lacus, dictum placerat ultricies ac, tincidunt eget massa. Suspendisse ut metus in turpis sollicitudin tincidunt.', 'video', '1608461262.mp4', '1608461564.jpg', 208, 161, '1', 0, 0, '2019-07-07 19:52:58'),
(6, 5, 6, 'Ek zindagi - Hindi Medium', 'Proin id sagittis elit. Proin luctus ligula nec sagittis euismod. Phasellus neque sapien, eleifend vitae urna sed, pharetra pretium urna. Aenean posuere neque et elit tincidunt pharetra eget nec libero. Aenean eget pulvinar elit. Quisque tellus elit.', 'video', '1608461262.mp4', '1662374606.jpeg', 76, 38, '0', 0, 0, '2019-07-07 19:52:02'),
(7, 11, 7, 'Bharat ki beti - Gunjan Saxena', 'Bharat Ki Beti Song from Gunjan Saxena starring Janhvi Kapoor is latest song sung by Arijit Singh. Bharat Ki Beti song lyrics are written by Kausar Munir and music is given by Amit Trivedi.', 'video', '1608461262.mp4', '1662374740.jpg', 61, 60, '0', 0, 0, '2019-07-14 23:02:22'),
(11, 1, 4, 'Dil ne kaha - Panga', 'Dil Ne Kaha, a romantic song from the movie Panga, sung by Jassie Gill, Asees Kaur, composed by Shankar-Ehsaan-Loy and penned by Javed Akhtar.', 'video', '1608461262.mp4', '1662374790.jpg', 203, 50, '0', 0, 0, '2019-12-17 02:00:39'),
(12, 9, 5, 'Maay Bhavani - Tanhaji', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque fringilla nisi vitae mollis cursus. Suspendisse a egestas eros. Nulla condimentum magna in tortor auctor dictum. Nam elementum sem est, id aliquet dui tristique sit amet. Sed mattis dolor vel nibh fringilla dictum. Quisque a ultrices ipsum. Cras odio lacus, dictum placerat ultricies ac, tincidunt eget massa. Suspendisse ut metus in turpis sollicitudin tincidunt.', 'video', '1608461262.mp4', '1608461524.jpg', 62, 32, '0', 0, 0, '2019-07-22 20:55:04'),
(13, 10, 6, 'Kaise hua - Kabir Singh', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque fringilla nisi vitae mollis cursus. Suspendisse a egestas eros. Nulla condimentum magna in tortor auctor dictum. Nam elementum sem est, id aliquet dui tristique sit amet. Sed mattis dolor vel nibh fringilla dictum. Quisque a ultrices ipsum. Cras odio lacus, dictum placerat ultricies ac, tincidunt eget massa. Suspendisse ut metus in turpis sollicitudin tincidunt.', 'video', '1608461262.mp4', '1662374894.jpg', 68, 131, '0', 0, 0, '2019-07-24 07:15:42'),
(14, 1, 7, 'Tu mila to haina - De de pyar de', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque fringilla nisi vitae mollis cursus. Suspendisse a egestas eros. Nulla condimentum magna in tortor auctor dictum. Nam elementum sem est, id aliquet dui tristique sit amet. Sed mattis dolor vel nibh fringilla dictum. Quisque a ultrices ipsum. Cras odio lacus, dictum placerat ultricies ac, tincidunt eget massa. Suspendisse ut metus in turpis sollicitudin tincidunt.', 'video', '1608461262.mp4', '1662375046.jpg', 75, 88, '0', 0, 0, '2019-07-26 00:38:09'),
(16, 1, 4, 'Shankara Re Shankara - Tanhaji', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque fringilla nisi vitae mollis cursus. Suspendisse a egestas eros. Nulla condimentum magna in tortor auctor dictum. Nam elementum sem est, id aliquet dui tristique sit amet. Sed mattis dolor vel nibh fringilla dictum. Quisque a ultrices ipsum. Cras odio lacus, dictum placerat ultricies ac, tincidunt eget massa. Suspendisse ut metus in turpis sollicitudin tincidunt.', 'video', '1608461262.mp4', '1662374250.jpg', 87, 78, '0', 0, 0, '2019-12-15 19:45:31'),
(17, 1, 4, 'Dil Bechara – Title Track', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque fringilla nisi vitae mollis cursus. Suspendisse a egestas eros. Nulla condimentum magna in tortor auctor dictum. Nam elementum sem est, id aliquet dui tristique sit amet. Sed mattis dolor vel nibh fringilla dictum. Quisque a ultrices ipsum. Cras odio lacus, dictum placerat ultricies ac, tincidunt eget massa. Suspendisse ut metus in turpis sollicitudin tincidunt.', 'youtube', 'CXZQomvJn4Q', '1662374330.jpg', 537, 75, '1', 0, 1, '2020-08-11 05:22:46'),
(19, 1, 7, 'New Dance', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque fringilla nisi vitae mollis cursus. Suspendisse a egestas eros. Nulla condimentum magna in tortor auctor dictum. Nam elementum sem est, id aliquet dui tristique sit amet. Sed mattis dolor vel nibh fringilla dictum. Quisque a ultrices ipsum. Cras odio lacus, dictum placerat ultricies ac, tincidunt eget massa. Suspendisse ut metus in turpis sollicitudin tincidunt.', 'youtube', 'M8vDwlHigJA', '1662373937.jpg', 75, 18, '1', 0, 1, '2022-01-06 18:31:52'),
(20, 1, 6, 'Bharatnatyam', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque fringilla nisi vitae mollis cursus. Suspendisse a egestas eros. Nulla condimentum magna in tortor auctor dictum. Nam elementum sem est, id aliquet dui tristique sit amet. Sed mattis dolor vel nibh fringilla dictum. Quisque a ultrices ipsum. Cras odio lacus, dictum placerat ultricies ac, tincidunt eget massa. Suspendisse ut metus in turpis sollicitudin tincidunt.', 'youtube', 'M8vDwlHigJA', '1662373535.jpg', 186, 1, '0', 0, 1, '2022-09-02 12:57:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_album`
--
ALTER TABLE `tbl_album`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_artist`
--
ALTER TABLE `tbl_artist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_comment`
--
ALTER TABLE `tbl_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_currency`
--
ALTER TABLE `tbl_currency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_favorite`
--
ALTER TABLE `tbl_favorite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_follow`
--
ALTER TABLE `tbl_follow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_general_setting`
--
ALTER TABLE `tbl_general_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_like`
--
ALTER TABLE `tbl_like`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_notification`
--
ALTER TABLE `tbl_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_package`
--
ALTER TABLE `tbl_package`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_page`
--
ALTER TABLE `tbl_page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_ratings`
--
ALTER TABLE `tbl_ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_smtp_setting`
--
ALTER TABLE `tbl_smtp_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_notification_tracking`
--
ALTER TABLE `tbl_user_notification_tracking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_video`
--
ALTER TABLE `tbl_video`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_album`
--
ALTER TABLE `tbl_album`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_artist`
--
ALTER TABLE `tbl_artist`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_comment`
--
ALTER TABLE `tbl_comment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `tbl_currency`
--
ALTER TABLE `tbl_currency`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `tbl_favorite`
--
ALTER TABLE `tbl_favorite`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `tbl_follow`
--
ALTER TABLE `tbl_follow`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `tbl_general_setting`
--
ALTER TABLE `tbl_general_setting`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `tbl_like`
--
ALTER TABLE `tbl_like`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tbl_notification`
--
ALTER TABLE `tbl_notification`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_package`
--
ALTER TABLE `tbl_package`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_page`
--
ALTER TABLE `tbl_page`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_ratings`
--
ALTER TABLE `tbl_ratings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_smtp_setting`
--
ALTER TABLE `tbl_smtp_setting`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=363;

--
-- AUTO_INCREMENT for table `tbl_user_notification_tracking`
--
ALTER TABLE `tbl_user_notification_tracking`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_video`
--
ALTER TABLE `tbl_video`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
