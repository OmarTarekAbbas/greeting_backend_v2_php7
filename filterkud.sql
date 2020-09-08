-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2020 at 05:36 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `filterkud`
--

-- --------------------------------------------------------

--
-- Table structure for table `advertising_urls`
--

CREATE TABLE `advertising_urls` (
  `id` int(10) UNSIGNED NOT NULL,
  `adv_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `msisdn` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operatorId` int(11) DEFAULT NULL,
  `operatorName` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL COMMENT '0=hit from adv company , 1= subscription success , 2 = subscription fail  , 3 = renew success',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `publisherId_macro` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobrain_token` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ads_compnay_name` enum('intech','headway','DF') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'DF'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `created_at`, `updated_at`) VALUES
(2, 'سينما', '2020-02-24 07:40:12', '2020-02-24 09:17:41'),
(3, 'دراما', '2020-02-24 08:52:42', '2020-02-24 09:22:52'),
(4, 'اكشن', '2020-02-24 09:23:11', '2020-02-24 09:23:11');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Egypt', '2020-02-24 07:39:45', '2020-02-24 07:39:45');

-- --------------------------------------------------------

--
-- Table structure for table `cproviders`
--

CREATE TABLE `cproviders` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `du_integration`
--

CREATE TABLE `du_integration` (
  `id` int(10) UNSIGNED NOT NULL,
  `url` varchar(400) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trxid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uid` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `serviceid` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plan` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `local` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `generatedurls`
--

CREATE TABLE `generatedurls` (
  `id` int(10) UNSIGNED NOT NULL,
  `operator_id` int(10) UNSIGNED NOT NULL,
  `occasion_id` int(10) UNSIGNED NOT NULL,
  `img` tinyint(1) NOT NULL,
  `audio` tinyint(1) NOT NULL,
  `video` tinyint(1) NOT NULL,
  `UID` bigint(20) DEFAULT NULL,
  `url_occasion_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url_occasion_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `generatedurls`
--

INSERT INTO `generatedurls` (`id`, `operator_id`, `occasion_id`, `img`, `audio`, `video`, `UID`, `url_occasion_text`, `url_occasion_image`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 0, 0, 75231, NULL, NULL, '2020-02-24 07:42:09', '2020-02-24 07:42:09');

-- --------------------------------------------------------

--
-- Table structure for table `greetingaudios`
--

CREATE TABLE `greetingaudios` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `occasion_id` int(10) UNSIGNED NOT NULL,
  `cprovider_id` int(10) UNSIGNED NOT NULL,
  `RDate` date NOT NULL,
  `EXDate` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `notification` int(11) NOT NULL,
  `rbt` int(11) NOT NULL,
  `popular_count` int(11) NOT NULL DEFAULT 0,
  `featured` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `greetingaudio_operator`
--

CREATE TABLE `greetingaudio_operator` (
  `greetingaudio_id` int(10) UNSIGNED NOT NULL,
  `operator_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `greetingimgs`
--

CREATE TABLE `greetingimgs` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vid_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vid_path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `occasion_id` int(10) UNSIGNED DEFAULT NULL,
  `RDate` date NOT NULL,
  `EXDate` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `X` int(11) NOT NULL DEFAULT 150,
  `Y` int(11) NOT NULL DEFAULT 330,
  `Font` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Fonts/29ltbukralight.ttf',
  `FontSize` int(11) NOT NULL DEFAULT 24,
  `Angle` int(11) NOT NULL DEFAULT 0,
  `FirstR` int(11) NOT NULL DEFAULT 255,
  `FirstG` int(11) NOT NULL DEFAULT 255,
  `FirstB` int(11) NOT NULL DEFAULT 255,
  `SecondR` int(11) NOT NULL DEFAULT 128,
  `secondG` int(11) NOT NULL DEFAULT 128,
  `secondB` int(11) NOT NULL DEFAULT 128,
  `MainR` int(11) NOT NULL DEFAULT 0,
  `MainG` int(11) NOT NULL DEFAULT 0,
  `MainB` int(11) NOT NULL DEFAULT 0,
  `DefLetLength` int(11) NOT NULL DEFAULT 15,
  `Arabic` tinyint(1) NOT NULL DEFAULT 1,
  `popular_count` int(11) NOT NULL DEFAULT 0,
  `dislike` int(11) NOT NULL,
  `like` int(11) NOT NULL,
  `featured` int(11) NOT NULL DEFAULT 0,
  `snap` int(11) NOT NULL DEFAULT 0 COMMENT '0:default / 1:snap',
  `snap_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rbt_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `greetingimgs`
--

INSERT INTO `greetingimgs` (`id`, `title`, `path`, `vid_type`, `vid_path`, `occasion_id`, `RDate`, `EXDate`, `created_at`, `updated_at`, `X`, `Y`, `Font`, `FontSize`, `Angle`, `FirstR`, `FirstG`, `FirstB`, `SecondR`, `secondG`, `secondB`, `MainR`, `MainG`, `MainB`, `DefLetLength`, `Arabic`, `popular_count`, `dislike`, `like`, `featured`, `snap`, `snap_link`, `rbt_id`) VALUES
(1, 'Snap Image 1', 'Greetings/26-02-2020/496-010.png', 'Greetings/24-02-2020/1582537317309.jpg', 'Greetings/24-02-2020/927-lionking.mp4', 2, '2020-02-24', '2020-03-24', '2020-02-24 07:41:58', '2020-02-26 09:42:37', 150, 330, 'Fonts/29ltbukralight.ttf', 24, 0, 255, 255, 255, 128, 128, 128, 0, 0, 0, 15, 1, 1114, 0, 0, 0, 1, 'https://www.snapchat.com/unlock/?type=SNAPCODE&uuid=5190090f73104bd9af7504cb96bae1dd&metadata=01', NULL),
(5, 'Snap Image 3', 'Greetings/26-02-2020/587-011.png', 'Greetings/24-02-2020/15825422943.jpg', 'Greetings/24-02-2020/496-JOKER.MP4', 3, '2020-02-24', '2020-03-24', '2020-02-24 09:04:55', '2020-02-26 09:42:46', 150, 330, 'Fonts/29ltbukralight.ttf', 24, 0, 255, 255, 255, 128, 128, 128, 0, 0, 0, 15, 1, 1229, 0, 0, 0, 1, 'https://www.snapchat.com/unlock/?type=SNAPCODE&uuid=5190090f73104bd9af7504cb96bae1dd&metadata=01', NULL),
(6, 'Snap Image 2', 'Greetings/26-02-2020/468-012.png', 'Greetings/24-02-2020/1582542869791.jpg', 'Greetings/24-02-2020/612-IT.MP4', 4, '2020-02-24', '2020-03-24', '2020-02-24 09:14:29', '2020-02-26 09:42:54', 150, 330, 'Fonts/29ltbukralight.ttf', 24, 0, 255, 255, 255, 128, 128, 128, 0, 0, 0, 15, 1, 1076, 0, 0, 0, 1, 'https://www.snapchat.com/unlock/?type=SNAPCODE&uuid=5190090f73104bd9af7504cb96bae1dd&metadata=01', NULL),
(7, 'Snap Image 4', 'Greetings/26-02-2020/530-010.png', NULL, NULL, 5, '2020-02-24', '2020-03-24', '2020-02-24 09:28:42', '2020-02-26 09:43:11', 150, 330, 'Fonts/29ltbukralight.ttf', 24, 0, 255, 255, 255, 128, 128, 128, 0, 0, 0, 15, 1, 1344, 0, 0, 0, 1, 'https://www.snapchat.com/unlock/?type=SNAPCODE&uuid=5190090f73104bd9af7504cb96bae1dd&metadata=01', NULL),
(8, 'Snap Image 10', 'Greetings/26-02-2020/462-011.png', NULL, NULL, 7, '2020-02-24', '2020-03-24', '2020-02-24 12:09:08', '2020-02-26 09:43:18', 150, 330, 'Fonts/29ltbukralight.ttf', 24, 0, 255, 255, 255, 128, 128, 128, 0, 0, 0, 15, 1, 1421, 0, 0, 0, 1, 'https://www.snapchat.com/unlock/?type=SNAPCODE&uuid=5190090f73104bd9af7504cb96bae1dd&metadata=01', NULL),
(9, 'Snap Image 10', 'Greetings/26-02-2020/228-012.png', NULL, NULL, 8, '2020-02-24', '2020-03-24', '2020-02-24 12:09:19', '2020-02-26 09:43:29', 150, 330, 'Fonts/29ltbukralight.ttf', 24, 0, 255, 255, 255, 128, 128, 128, 0, 0, 0, 15, 1, 1371, 0, 0, 0, 1, 'https://www.snapchat.com/unlock/?type=SNAPCODE&uuid=5190090f73104bd9af7504cb96bae1dd&metadata=01', NULL),
(22, 'Snap Image 10', 'Greetings/26-02-2020/228-012.png', NULL, NULL, 8, '2020-02-24', '2020-03-24', '2020-02-24 12:09:19', '2020-02-26 09:43:29', 150, 330, 'Fonts/29ltbukralight.ttf', 24, 0, 255, 255, 255, 128, 128, 128, 0, 0, 0, 15, 1, 1371, 0, 0, 0, 1, 'https://www.snapchat.com/unlock/?type=SNAPCODE&uuid=5190090f73104bd9af7504cb96bae1dd&metadata=01', NULL),
(23, 'Snap Image 10', 'Greetings/26-02-2020/228-012.png', NULL, NULL, 8, '2020-02-24', '2020-03-24', '2020-02-24 12:09:19', '2020-02-26 09:43:29', 150, 330, 'Fonts/29ltbukralight.ttf', 24, 0, 255, 255, 255, 128, 128, 128, 0, 0, 0, 15, 1, 1371, 0, 0, 0, 1, 'https://www.snapchat.com/unlock/?type=SNAPCODE&uuid=5190090f73104bd9af7504cb96bae1dd&metadata=01', NULL),
(24, 'Snap Image 10', 'Greetings/26-02-2020/228-012.png', NULL, NULL, 8, '2020-02-24', '2020-03-24', '2020-02-24 12:09:19', '2020-02-26 09:43:29', 150, 330, 'Fonts/29ltbukralight.ttf', 24, 0, 255, 255, 255, 128, 128, 128, 0, 0, 0, 15, 1, 1371, 0, 0, 0, 1, 'https://www.snapchat.com/unlock/?type=SNAPCODE&uuid=5190090f73104bd9af7504cb96bae1dd&metadata=01', NULL),
(25, 'Snap Image 10', 'Greetings/26-02-2020/228-012.png', NULL, NULL, 8, '2020-02-24', '2020-03-24', '2020-02-24 12:09:19', '2020-02-26 09:43:29', 150, 330, 'Fonts/29ltbukralight.ttf', 24, 0, 255, 255, 255, 128, 128, 128, 0, 0, 0, 15, 1, 1371, 0, 0, 0, 1, 'https://www.snapchat.com/unlock/?type=SNAPCODE&uuid=5190090f73104bd9af7504cb96bae1dd&metadata=01', NULL),
(26, 'Snap Image 10', 'Greetings/26-02-2020/228-012.png', NULL, NULL, 8, '2020-02-24', '2020-03-24', '2020-02-24 12:09:19', '2020-02-26 09:43:29', 150, 330, 'Fonts/29ltbukralight.ttf', 24, 0, 255, 255, 255, 128, 128, 128, 0, 0, 0, 15, 1, 1371, 0, 0, 0, 1, 'https://www.snapchat.com/unlock/?type=SNAPCODE&uuid=5190090f73104bd9af7504cb96bae1dd&metadata=01', NULL),
(27, 'Snap Image 10', 'Greetings/26-02-2020/228-012.png', NULL, NULL, 8, '2020-02-24', '2020-03-24', '2020-02-24 12:09:19', '2020-02-26 09:43:29', 150, 330, 'Fonts/29ltbukralight.ttf', 24, 0, 255, 255, 255, 128, 128, 128, 0, 0, 0, 15, 1, 1371, 0, 0, 0, 1, 'https://www.snapchat.com/unlock/?type=SNAPCODE&uuid=5190090f73104bd9af7504cb96bae1dd&metadata=01', NULL),
(28, 'Snap Image 10', 'Greetings/26-02-2020/228-012.png', NULL, NULL, 8, '2020-02-24', '2020-03-24', '2020-02-24 12:09:19', '2020-02-26 09:43:29', 150, 330, 'Fonts/29ltbukralight.ttf', 24, 0, 255, 255, 255, 128, 128, 128, 0, 0, 0, 15, 1, 1371, 0, 0, 0, 1, 'https://www.snapchat.com/unlock/?type=SNAPCODE&uuid=5190090f73104bd9af7504cb96bae1dd&metadata=01', NULL),
(29, 'Snap Image 10', 'Greetings/26-02-2020/228-012.png', NULL, NULL, 8, '2020-02-24', '2020-03-24', '2020-02-24 12:09:19', '2020-02-26 09:43:29', 150, 330, 'Fonts/29ltbukralight.ttf', 24, 0, 255, 255, 255, 128, 128, 128, 0, 0, 0, 15, 1, 1371, 0, 0, 0, 1, 'https://www.snapchat.com/unlock/?type=SNAPCODE&uuid=5190090f73104bd9af7504cb96bae1dd&metadata=01', NULL),
(30, 'Snap Image 10', 'Greetings/26-02-2020/228-012.png', NULL, NULL, 8, '2020-02-24', '2020-03-24', '2020-02-24 12:09:19', '2020-02-26 09:43:29', 150, 330, 'Fonts/29ltbukralight.ttf', 24, 0, 255, 255, 255, 128, 128, 128, 0, 0, 0, 15, 1, 1371, 0, 0, 0, 1, 'https://www.snapchat.com/unlock/?type=SNAPCODE&uuid=5190090f73104bd9af7504cb96bae1dd&metadata=01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `greetingimg_operator`
--

CREATE TABLE `greetingimg_operator` (
  `greetingimg_id` int(10) UNSIGNED NOT NULL,
  `operator_id` int(10) UNSIGNED NOT NULL,
  `popular_count` int(11) NOT NULL DEFAULT 0,
  `dislike` int(11) NOT NULL,
  `like` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `greetingimg_operator`
--

INSERT INTO `greetingimg_operator` (`greetingimg_id`, `operator_id`, `popular_count`, `dislike`, `like`, `created_at`, `updated_at`, `id`) VALUES
(1, 1, 0, 0, 0, '2020-02-24 07:41:59', '2020-02-24 07:41:59', 1),
(2, 1, 0, 0, 0, '2020-02-24 08:54:04', '2020-02-24 08:54:04', 2),
(3, 1, 0, 0, 0, '2020-02-24 09:02:26', '2020-02-24 09:02:26', 3),
(5, 1, 0, 0, 0, '2020-02-24 09:04:55', '2020-02-24 09:04:55', 4),
(4, 1, 0, 0, 0, '2020-02-24 09:12:29', '2020-02-24 09:12:29', 5),
(6, 1, 0, 0, 0, '2020-02-24 09:14:29', '2020-02-24 09:14:29', 6),
(7, 1, 0, 0, 0, '2020-02-24 09:28:42', '2020-02-24 09:28:42', 7),
(8, 1, 0, 0, 0, '2020-02-24 12:09:09', '2020-02-24 12:09:09', 8),
(9, 1, 0, 0, 0, '2020-02-24 12:09:31', '2020-02-24 12:09:31', 9),
(10, 1, 0, 0, 0, '2020-02-24 12:09:43', '2020-02-24 12:09:43', 10),
(11, 1, 0, 0, 0, '2020-02-24 12:10:12', '2020-02-24 12:10:12', 11),
(12, 1, 0, 0, 0, '2020-02-24 12:10:18', '2020-02-24 12:10:18', 12),
(13, 1, 0, 0, 0, '2020-02-24 12:10:26', '2020-02-24 12:10:26', 13),
(14, 1, 0, 0, 0, '2020-02-24 12:10:34', '2020-02-24 12:10:34', 14),
(15, 1, 0, 0, 0, '2020-02-24 12:10:38', '2020-02-24 12:10:38', 15),
(16, 1, 0, 0, 0, '2020-02-24 12:10:42', '2020-02-24 12:10:42', 16),
(17, 1, 0, 0, 0, '2020-02-24 12:17:22', '2020-02-24 12:17:22', 17),
(18, 1, 0, 0, 0, '2020-02-24 12:17:28', '2020-02-24 12:17:28', 18),
(19, 1, 0, 0, 0, '2020-02-24 12:17:33', '2020-02-24 12:17:33', 19),
(20, 1, 0, 0, 0, '2020-02-24 12:17:38', '2020-02-24 12:17:38', 20),
(21, 1, 0, 0, 0, '2020-02-24 12:17:43', '2020-02-24 12:17:43', 21),
(22, 1, 0, 0, 0, '2020-02-26 12:39:09', '2020-02-26 12:39:09', 22),
(23, 1, 0, 0, 0, '2020-02-26 12:39:17', '2020-02-26 12:39:17', 23),
(24, 1, 0, 0, 0, '2020-02-26 12:39:23', '2020-02-26 12:39:23', 24),
(25, 1, 0, 0, 0, '2020-02-26 12:39:27', '2020-02-26 12:39:27', 25),
(26, 1, 0, 0, 0, '2020-02-26 12:40:53', '2020-02-26 12:40:53', 26),
(27, 1, 0, 0, 0, '2020-02-26 12:41:04', '2020-02-26 12:41:04', 27),
(28, 1, 0, 0, 0, '2020-02-26 12:41:08', '2020-02-26 12:41:08', 28),
(29, 1, 0, 0, 0, '2020-02-26 12:41:15', '2020-02-26 12:41:15', 29),
(30, 1, 0, 0, 0, '2020-02-26 12:41:21', '2020-02-26 12:41:21', 30);

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `short_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rtl` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `title`, `created_at`, `updated_at`, `short_code`, `rtl`) VALUES
(2, 'Arabic', '2019-11-05 17:34:23', '2019-11-05 17:34:23', 'ar', 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2018_12_09_084836_create_settings_table', 1),
(2, '2018_12_09_093056_create_advertising_urls_table', 1),
(3, '2018_12_09_093056_create_categories_table', 1),
(4, '2018_12_09_093056_create_countries_table', 1),
(5, '2018_12_09_093056_create_cproviders_table', 1),
(6, '2018_12_09_093056_create_generatedurls_table', 1),
(7, '2018_12_09_093056_create_greetingaudio_operator_table', 1),
(8, '2018_12_09_093056_create_greetingaudios_table', 1),
(9, '2018_12_09_093056_create_greetingimg_operator_table', 1),
(10, '2018_12_09_093056_create_greetingimgs_table', 1),
(11, '2018_12_09_093056_create_msisdns_table', 1),
(12, '2018_12_09_093056_create_notify_table', 1),
(13, '2018_12_09_093056_create_occasions_table', 1),
(14, '2018_12_09_093056_create_operators_table', 1),
(15, '2018_12_09_093056_create_password_resets_table', 1),
(16, '2018_12_09_093056_create_processedimgs_table', 1),
(17, '2018_12_09_093056_create_processedvids_table', 1),
(18, '2018_12_09_093056_create_rbt_codes_table', 1),
(19, '2018_12_09_093056_create_sessions_table', 1),
(20, '2018_12_09_093056_create_users_table', 1),
(21, '2018_12_09_093059_add_foreign_keys_to_msisdns_table', 1),
(22, '2019_03_18_084855_create_msisdn_greetingimgs_table', 1),
(23, '2019_03_18_103433_add_forgin_key_to_msisdn_freetingimgs', 1),
(24, '2019_03_31_105142_add_close_to_operators', 1),
(25, '2019_04_08_110315_add_slider_flag_in_occasions', 1),
(26, '2019_04_22_071431_add_parent_id_to_occasions', 1),
(27, '2019_08_27_113159_add_column_to_msisdens', 1),
(28, '2019_08_28_122559_add_msisdn_to_msisdns', 1),
(29, '2019_08_28_132258_add_viav_to_notify', 1),
(30, '2019_10_13_133223_add_popular_count_to_greetingimg_operator_table', 1),
(31, '2019_10_27_121654_change_rbt_sms_in_operators_table', 1),
(32, '2019_10_28_093504_add_date_ocasions_table', 1),
(33, '2019_11_04_105149_add_like_dislike_to_greetingimgs_table', 1),
(34, '2019_11_04_105150_add_like_dislike_to_greetingimg_operator_table', 1),
(35, '2019_11_19_081652_create_language_table', 2),
(36, '2019_11_19_081736_create_static_translations_table', 2),
(37, '2019_11_19_081756_create_static_body_table', 2),
(38, '2019_11_19_081817_create_translatable_table', 2),
(39, '2019_11_19_081846_create_translate_body', 2),
(40, '2019_11_19_081918_add_short_code_and_rtl_to_language', 2),
(41, '2019_11_25_100756_add_vid_link_to_greetingimg', 2),
(42, '2020_01_15_123132_create_du_intgration', 2),
(43, '2020_01_16_113647_edit_du_integration', 2),
(44, '2020_01_19_162125_add_null_value_to_greetingimgs', 2),
(45, '2020_01_19_162326_add_forgin_key', 3),
(46, '2020_01_26_101630_operator_rbt_sms_nullable', 3),
(47, '2020_01_26_110517_country_operator_innodb', 3),
(48, '2020_01_19_161338_add_value_to_setting', 4),
(49, '2018_10_16_105750_create_roles_table', 5),
(51, '2020_02_25_083416_add_pagination_settings', 6);

-- --------------------------------------------------------

--
-- Table structure for table `msisdns`
--

CREATE TABLE `msisdns` (
  `id` int(11) NOT NULL,
  `msisdn` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `operator_id` int(11) NOT NULL COMMENT '8=zain , 50 ooredo , 51= viva',
  `ooredoo_notify_id` int(10) UNSIGNED DEFAULT NULL,
  `ads_ur_id` int(10) UNSIGNED DEFAULT NULL,
  `transaction_id` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ad_company` enum('headway','intech','DF') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `final_status` tinyint(1) DEFAULT NULL COMMENT '0=not active  , 1 active ',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pincode` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan_id` tinyint(4) NOT NULL COMMENT '1= Postpaid , 2 = Prepaid  , 3 = Data/blacklisted/Non viva numbers',
  `subscribe_date` date NOT NULL,
  `renew_date` date NOT NULL,
  `type` enum('wifi','HE','SMS') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'wifi' COMMENT 'wifi= wifi , HE = Header enriched,SMS = SMS',
  `validityDays` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `msisdn_greetingimgs`
--

CREATE TABLE `msisdn_greetingimgs` (
  `id` int(10) UNSIGNED NOT NULL,
  `greetingimg_id` int(10) UNSIGNED NOT NULL,
  `msisdn_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notify`
--

CREATE TABLE `notify` (
  `id` int(10) UNSIGNED NOT NULL,
  `complete_url` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `msisdn` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `occasions`
--

CREATE TABLE `occasions` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `slider` int(11) NOT NULL DEFAULT 0,
  `occasion_RDate` date NOT NULL,
  `occasion_EXDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `occasions`
--

INSERT INTO `occasions` (`id`, `title`, `category_id`, `created_at`, `updated_at`, `image`, `parent_id`, `slider`, `occasion_RDate`, `occasion_EXDate`) VALUES
(2, 'Occasion 1', 2, '2020-02-24 07:40:52', '2020-02-26 09:40:44', 'Greetings/Occasion/1582717244.png', NULL, 1, '2020-02-24', '2020-03-24'),
(3, 'Occasion 2', 3, '2020-02-24 08:53:01', '2020-02-26 09:40:36', 'Greetings/Occasion/1582717236.png', NULL, 1, '2020-02-24', '2020-03-24'),
(4, 'Occasion 3', 3, '2020-02-24 09:15:07', '2020-02-26 09:40:30', 'Greetings/Occasion/1582717230.png', NULL, 1, '2020-02-24', '2020-03-24'),
(5, 'Occasion 4', 4, '2020-02-24 09:23:45', '2020-02-26 09:40:21', 'Greetings/Occasion/1582717221.png', NULL, 1, '2020-02-24', '2020-03-24'),
(7, 'Occasion 6', 4, '2020-02-24 09:24:56', '2020-02-26 09:39:16', 'Greetings/Occasion/1582717156.png', NULL, 1, '2020-02-24', '2020-03-24'),
(8, 'Occasion 7', 4, '2020-02-24 09:25:12', '2020-02-26 09:39:09', 'Greetings/Occasion/1582717149.png', NULL, 1, '2020-02-24', '2020-03-24'),
(23, 'Occasion 10', 3, '2020-02-26 10:59:38', '2020-02-26 10:59:38', 'Greetings/Occasion/1582721978.png', NULL, 1, '2020-02-26', '2020-03-26'),
(24, 'Occasion 11', 2, '2020-02-26 10:59:57', '2020-02-26 10:59:57', 'Greetings/Occasion/1582721997.png', NULL, 1, '2020-02-26', '2020-03-26'),
(25, 'Occasion 14', 2, '2020-02-26 11:04:50', '2020-02-26 11:04:50', 'Greetings/Occasion/1582722290.png', NULL, 1, '2020-02-26', '2020-03-26');

-- --------------------------------------------------------

--
-- Table structure for table `operators`
--

CREATE TABLE `operators` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rbt_sms` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `close` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `operators`
--

INSERT INTO `operators` (`id`, `name`, `country_id`, `created_at`, `updated_at`, `rbt_sms`, `close`) VALUES
(1, 'etisalat', 1, '2020-02-24 07:40:01', '2020-02-24 07:40:01', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `processedimgs`
--

CREATE TABLE `processedimgs` (
  `id` int(10) UNSIGNED NOT NULL,
  `greetingimg_id` int(10) UNSIGNED NOT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `FID` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `processedvids`
--

CREATE TABLE `processedvids` (
  `id` int(10) UNSIGNED NOT NULL,
  `processedimg_id` int(10) UNSIGNED NOT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `FID` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rbt_codes`
--

CREATE TABLE `rbt_codes` (
  `id` int(10) UNSIGNED NOT NULL,
  `audio_id` int(10) UNSIGNED NOT NULL,
  `operator_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `Title` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `Title`, `approved`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 1, '2020-01-22 13:14:17', '2020-01-22 13:16:45'),
(2, 'User', 1, '2020-01-22 13:14:17', '2020-01-22 13:16:45');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(6, 'enable_parent', '1', '2020-01-22 13:14:17', '2020-01-22 13:16:45'),
(9, 'pagination_limit', '13', NULL, NULL),
(10, 'only_favorites', '0', NULL, '2020-02-26 09:08:38'),
(11, 'pagination_slider', '6', NULL, '2020-02-25 07:02:54');

-- --------------------------------------------------------

--
-- Table structure for table `static_bodies`
--

CREATE TABLE `static_bodies` (
  `id` int(10) UNSIGNED NOT NULL,
  `language_id` int(10) UNSIGNED NOT NULL,
  `static_translation_id` int(10) UNSIGNED NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `static_bodies`
--

INSERT INTO `static_bodies` (`id`, `language_id`, `static_translation_id`, `body`, `created_at`, `updated_at`) VALUES
(2, 2, 4, 'فلاتر لك', '2019-11-19 10:25:30', '2019-11-19 10:25:30'),
(4, 2, 5, 'بحث', '2019-11-19 10:27:50', '2019-11-19 10:27:50'),
(6, 2, 6, 'الاكثر شيوعا', '2019-11-19 10:33:15', '2019-11-19 10:33:15'),
(8, 2, 7, 'فلاتر اعجبتك', '2019-11-19 10:34:04', '2019-11-19 10:34:04'),
(10, 2, 8, 'الاكثر شيوعا 2', '2019-11-19 10:35:05', '2019-11-19 10:35:05'),
(12, 2, 9, 'اسنخدم الفلتر', '2019-11-19 10:39:39', '2019-11-19 10:39:39'),
(14, 2, 10, 'شراء النغمة', '2019-11-19 10:40:20', '2019-11-19 10:40:20'),
(16, 2, 11, 'الرجوع', '2019-11-19 10:40:45', '2019-11-19 10:40:45'),
(18, 2, 12, 'فلترات اليوم', '2019-11-19 10:43:02', '2019-11-19 10:43:02'),
(20, 2, 13, 'فئات', '2019-11-19 10:44:21', '2019-11-19 10:44:21'),
(22, 2, 14, 'فلاتر', '2019-11-20 04:16:54', '2019-11-20 04:16:54');

-- --------------------------------------------------------

--
-- Table structure for table `static_translations`
--

CREATE TABLE `static_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `key_word` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `static_translations`
--

INSERT INTO `static_translations` (`id`, `key_word`, `created_at`, `updated_at`) VALUES
(4, 'filter4you', '2019-11-19 10:25:30', '2019-11-19 10:25:30'),
(5, 'search', '2019-11-19 10:27:50', '2019-11-19 10:27:50'),
(6, 'mostp', '2019-11-19 10:33:15', '2019-11-19 10:33:15'),
(7, 'likedf', '2019-11-19 10:34:04', '2019-11-19 10:34:04'),
(8, 'mostp2', '2019-11-19 10:35:05', '2019-11-19 10:35:05'),
(9, 'usefilter', '2019-11-19 10:39:39', '2019-11-19 10:39:39'),
(10, 'buytone', '2019-11-19 10:40:20', '2019-11-19 10:40:20'),
(11, 'close', '2019-11-19 10:40:45', '2019-11-19 10:40:45'),
(12, 'todayfilter', '2019-11-19 10:43:02', '2019-11-19 10:43:02'),
(13, 'categ', '2019-11-19 10:44:21', '2019-11-19 10:44:21'),
(14, 'home', '2019-11-20 04:16:54', '2019-11-20 04:16:54');

-- --------------------------------------------------------

--
-- Table structure for table `tans_bodies`
--

CREATE TABLE `tans_bodies` (
  `id` int(10) UNSIGNED NOT NULL,
  `language_id` int(10) UNSIGNED NOT NULL,
  `translatable_id` int(10) UNSIGNED NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `translatables`
--

CREATE TABLE `translatables` (
  `id` int(10) UNSIGNED NOT NULL,
  `table_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `record_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `column_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `admin`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'super admin', 'super_admin@ivas.com', '$2y$10$cVF538eBwaXK83Zjdnqjbu08JIWXwJYd1h4HxWVRBShXkizMQNZwK', 1, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advertising_urls`
--
ALTER TABLE `advertising_urls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cproviders`
--
ALTER TABLE `cproviders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `du_integration`
--
ALTER TABLE `du_integration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `generatedurls`
--
ALTER TABLE `generatedurls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `generatedurls_operator_id_foreign` (`operator_id`),
  ADD KEY `generatedurls_occasion_id_foreign` (`occasion_id`);

--
-- Indexes for table `greetingaudios`
--
ALTER TABLE `greetingaudios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `greetingaudios_occasion_id_foreign` (`occasion_id`),
  ADD KEY `greetingaudios_cprovider_id_foreign` (`cprovider_id`);

--
-- Indexes for table `greetingaudio_operator`
--
ALTER TABLE `greetingaudio_operator`
  ADD KEY `greetingaudio_operator_greetingaudio_id_index` (`greetingaudio_id`),
  ADD KEY `greetingaudio_operator_operator_id_index` (`operator_id`);

--
-- Indexes for table `greetingimgs`
--
ALTER TABLE `greetingimgs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `greetingimgs_occasion_id_foreign` (`occasion_id`),
  ADD KEY `greetingimgs_rbt_id_index` (`rbt_id`);

--
-- Indexes for table `greetingimg_operator`
--
ALTER TABLE `greetingimg_operator`
  ADD PRIMARY KEY (`id`),
  ADD KEY `greetingimg_operator_greetingimg_id_index` (`greetingimg_id`),
  ADD KEY `greetingimg_operator_operator_id_index` (`operator_id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `msisdns`
--
ALTER TABLE `msisdns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ooredoo_notify_id_3` (`ooredoo_notify_id`),
  ADD KEY `ads_ur_id` (`ads_ur_id`);

--
-- Indexes for table `msisdn_greetingimgs`
--
ALTER TABLE `msisdn_greetingimgs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `msisdn_greetingimgs_ibfk_1` (`greetingimg_id`),
  ADD KEY `msisdn_greetingimgs_ibfk_2` (`msisdn_id`);

--
-- Indexes for table `notify`
--
ALTER TABLE `notify`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `occasions`
--
ALTER TABLE `occasions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `occasions_category_id_foreign` (`category_id`),
  ADD KEY `occasions_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `operators`
--
ALTER TABLE `operators`
  ADD PRIMARY KEY (`id`),
  ADD KEY `operators_country_id_foreign` (`country_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `processedimgs`
--
ALTER TABLE `processedimgs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `processedimgs_greetingimg_id_foreign` (`greetingimg_id`);

--
-- Indexes for table `processedvids`
--
ALTER TABLE `processedvids`
  ADD PRIMARY KEY (`id`),
  ADD KEY `processedvids_processedimg_id_foreign` (`processedimg_id`);

--
-- Indexes for table `rbt_codes`
--
ALTER TABLE `rbt_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rbt_codes_audio_id_foreign` (`audio_id`),
  ADD KEY `rbt_codes_operator_id_foreign` (`operator_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD UNIQUE KEY `sessions_id_unique` (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `static_bodies`
--
ALTER TABLE `static_bodies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `static_bodies_language_id_foreign` (`language_id`),
  ADD KEY `static_bodies_static_translation_id_foreign` (`static_translation_id`);

--
-- Indexes for table `static_translations`
--
ALTER TABLE `static_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tans_bodies`
--
ALTER TABLE `tans_bodies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tans_bodies_language_id_foreign` (`language_id`),
  ADD KEY `tans_bodies_translatable_id_foreign` (`translatable_id`);

--
-- Indexes for table `translatables`
--
ALTER TABLE `translatables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advertising_urls`
--
ALTER TABLE `advertising_urls`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cproviders`
--
ALTER TABLE `cproviders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `du_integration`
--
ALTER TABLE `du_integration`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `generatedurls`
--
ALTER TABLE `generatedurls`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `greetingaudios`
--
ALTER TABLE `greetingaudios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `greetingimgs`
--
ALTER TABLE `greetingimgs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `greetingimg_operator`
--
ALTER TABLE `greetingimg_operator`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `msisdns`
--
ALTER TABLE `msisdns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `msisdn_greetingimgs`
--
ALTER TABLE `msisdn_greetingimgs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notify`
--
ALTER TABLE `notify`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `occasions`
--
ALTER TABLE `occasions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `operators`
--
ALTER TABLE `operators`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `processedimgs`
--
ALTER TABLE `processedimgs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `processedvids`
--
ALTER TABLE `processedvids`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rbt_codes`
--
ALTER TABLE `rbt_codes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `static_bodies`
--
ALTER TABLE `static_bodies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `static_translations`
--
ALTER TABLE `static_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tans_bodies`
--
ALTER TABLE `tans_bodies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `translatables`
--
ALTER TABLE `translatables`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `msisdns`
--
ALTER TABLE `msisdns`
  ADD CONSTRAINT `msisdns_ibfk_1` FOREIGN KEY (`ads_ur_id`) REFERENCES `advertising_urls` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `msisdns_ibfk_2` FOREIGN KEY (`ooredoo_notify_id`) REFERENCES `notify` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `msisdn_greetingimgs`
--
ALTER TABLE `msisdn_greetingimgs`
  ADD CONSTRAINT `msisdn_greetingimgs_ibfk_1` FOREIGN KEY (`greetingimg_id`) REFERENCES `greetingimgs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `msisdn_greetingimgs_ibfk_2` FOREIGN KEY (`msisdn_id`) REFERENCES `msisdns` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `occasions`
--
ALTER TABLE `occasions`
  ADD CONSTRAINT `occasions_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `occasions_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `occasions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `operators`
--
ALTER TABLE `operators`
  ADD CONSTRAINT `operators_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `static_bodies`
--
ALTER TABLE `static_bodies`
  ADD CONSTRAINT `static_bodies_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `static_bodies_static_translation_id_foreign` FOREIGN KEY (`static_translation_id`) REFERENCES `static_translations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tans_bodies`
--
ALTER TABLE `tans_bodies`
  ADD CONSTRAINT `tans_bodies_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tans_bodies_translatable_id_foreign` FOREIGN KEY (`translatable_id`) REFERENCES `translatables` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
