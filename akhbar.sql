-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Jul 12, 2020 at 10:46 AM
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
-- Database: `greeting7`
--

-- --------------------------------------------------------

--
-- Table structure for table `advertising_urls`
--

CREATE TABLE `advertising_urls` (
  `id` int(10) UNSIGNED NOT NULL,
  `adv_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `msisdn` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `operatorId` int(11) DEFAULT NULL,
  `operatorName` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL COMMENT ' 1 = hit , 2 = pincode send  , 3 pincode verify success  , 4 = intech subscribe success',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publisherId_macro` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobrain_token` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ads_compnay_name` enum('intech','headway','DF') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'DF'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'اخبار', '2020-07-12 06:33:00', '2020-07-12 06:33:00');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(110) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Egypt', '2015-09-08 11:28:15', '2015-09-08 11:28:15'),
(2, 'Algeria', '2015-09-09 04:59:43', '2015-09-09 04:59:43'),
(5, 'Kuwait', '2015-09-13 12:01:32', '2015-09-13 12:01:32'),
(6, 'Austria', '2015-09-14 05:08:25', '2015-09-14 05:08:25'),
(7, 'Bahrain', '2015-09-14 05:08:41', '2015-09-14 05:08:41'),
(9, 'Saudi Arabia', '2015-09-14 06:26:20', '2015-09-14 06:26:20'),
(10, 'Yemen', '2015-09-14 08:37:35', '2015-09-14 08:37:35'),
(11, 'Jordan', '2015-09-14 09:58:15', '2015-09-14 09:58:15'),
(12, 'Sudan', '2015-09-14 09:58:22', '2015-09-14 09:58:22'),
(13, 'United Arab Emirates', '2018-12-20 13:31:36', '2018-12-20 13:31:36'),
(14, 'Iraq', '2019-01-08 12:43:50', '2019-01-08 12:43:50');

-- --------------------------------------------------------

--
-- Table structure for table `cproviders`
--

CREATE TABLE `cproviders` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `du_integration`
--

CREATE TABLE `du_integration` (
  `id` int(10) UNSIGNED NOT NULL,
  `url` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `trxid` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `uid` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `serviceid` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `plan` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `price` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `local` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `du_integration`
--

INSERT INTO `du_integration` (`id`, `url`, `trxid`, `uid`, `serviceid`, `plan`, `price`, `created_at`, `updated_at`, `local`) VALUES
(1, 'http://pay-with-du.ae/20/digizone/digizone-flaterdaily-1-ar-doi-web?origin=digizone&uid=971555802322&trxid=f5e0bf65-97d6-4216-9a1a-953c988f1c73&serviceProvider=secured&serviceid=flaterdaily&plan=daily&price=2&locale=ar', 'f5e0bf65-97d6-4216-9a1a-953c988f1c73', '971555802322', 'flaterdaily', 'daily', '2', '2020-01-16 11:53:05', '2020-01-16 11:53:05', 'ar'),
(2, 'http://pay-with-du.ae/20/digizone/digizone-flaterdaily-1-ar-doi-web?origin=digizone&uid=971555802322&trxid=81760c7a-1bea-41e1-b1df-a0e6ba009442&serviceProvider=secured&serviceid=flaterdaily&plan=daily&price=2&locale=ar', '81760c7a-1bea-41e1-b1df-a0e6ba009442', '971555802322', 'flaterdaily', 'daily', '2', '2020-01-16 12:10:10', '2020-01-16 12:10:10', 'ar'),
(3, 'http://pay-with-du.ae/20/digizone/digizone-flaterdaily-1-ar-doi-web?origin=digizone&uid=971555802322&trxid=eb7cfa79-1749-4270-a2e6-b7bc6f2b6d7d&serviceProvider=secured&serviceid=flaterdaily&plan=daily&price=2&locale=ar', 'eb7cfa79-1749-4270-a2e6-b7bc6f2b6d7d', '971555802322', 'flaterdaily', 'daily', '2', '2020-01-21 07:52:05', '2020-01-21 07:52:05', 'ar'),
(4, 'http://pay-with-du.ae/20/digizone/digizone-flaterdaily-1-ar-doi-web?origin=digizone&uid=971555802322&trxid=24a50ba7-797e-489b-ac15-440348eaed69&serviceProvider=secured&serviceid=flaterdaily&plan=daily&price=2&locale=ar', '24a50ba7-797e-489b-ac15-440348eaed69', '971555802322', 'flaterdaily', 'daily', '2', '2020-01-21 13:34:33', '2020-01-21 13:34:33', 'ar'),
(5, 'http://pay-with-du.ae/20/digizone/digizone-flaterdaily-1-ar-doi-web?origin=digizone&uid=971555802322&trxid=54b08f1e-cf06-42b7-adca-aa2a1942fdba&serviceProvider=secured&serviceid=flaterdaily&plan=daily&price=2&locale=ar', '54b08f1e-cf06-42b7-adca-aa2a1942fdba', '971555802322', 'flaterdaily', 'daily', '2', '2020-01-21 13:38:10', '2020-01-21 13:38:10', 'ar'),
(6, 'http://pay-with-du.ae/20/digizone/digizone-flaterdaily-1-ar-doi-web?origin=digizone&uid=971555802322&trxid=deb6534d-0198-42b9-98fc-76d4c2f865b5&serviceProvider=secured&serviceid=flaterdaily&plan=daily&price=2&locale=ar', 'deb6534d-0198-42b9-98fc-76d4c2f865b5', '971555802322', 'flaterdaily', 'daily', '2', '2020-01-21 15:37:59', '2020-01-21 15:37:59', 'ar'),
(7, 'http://pay-with-du.ae/20/digizone/digizone-flaterdaily-1-ar-doi-web?origin=digizone&uid=971555802322&trxid=12b9af65-091e-48bd-9ca2-13eece841b31&serviceProvider=secured&serviceid=flaterweekly&plan=weekly&price=14&locale=en', '12b9af65-091e-48bd-9ca2-13eece841b31', '971555802322', 'flaterweekly', 'weekly', '14', '2020-01-21 15:38:17', '2020-01-21 15:38:17', 'en'),
(8, 'http://pay-with-du.ae/20/digizone/digizone-flaterdaily-1-ar-doi-web?origin=digizone&uid=971554281453&trxid=776da37a-6225-4cac-b6d5-6c6a79fc98be&serviceProvider=secured&serviceid=flaterdaily&plan=daily&price=2&locale=ar', '776da37a-6225-4cac-b6d5-6c6a79fc98be', '971554281453', 'flaterdaily', 'daily', '2', '2020-01-21 15:50:50', '2020-01-21 15:50:50', 'ar'),
(9, 'http://pay-with-du.ae/20/digizone/digizone-flaterdaily-1-ar-doi-web?origin=digizone&uid=971554281453&trxid=3630417a-3585-4329-9e61-d4f3e3920dbf&serviceProvider=secured&serviceid=flaterdaily&plan=daily&price=2&locale=ar', '3630417a-3585-4329-9e61-d4f3e3920dbf', '971554281453', 'flaterdaily', 'daily', '2', '2020-01-21 16:10:15', '2020-01-21 16:10:15', 'ar'),
(10, 'http://pay-with-du.ae/20/digizone/digizone-flaterdaily-1-ar-doi-web?origin=digizone&uid=971123456789&trxid=f6384966-8ccb-4a8d-8570-2dc61efb0a8d&serviceProvider=secured&serviceid=flaterdaily&plan=daily&price=2&locale=ar', 'f6384966-8ccb-4a8d-8570-2dc61efb0a8d', '971123456789', 'flaterdaily', 'daily', '2', '2020-01-21 16:22:51', '2020-01-21 16:22:51', 'ar'),
(11, 'http://pay-with-du.ae/20/digizone/digizone-flaterdaily-1-en-doi-web?origin=digizone&uid=971123456789&trxid=663592f0-9b34-484c-aeee-b126ad0d29f9&serviceProvider=secured&serviceid=flaterdaily&plan=daily&price=2&locale=en', '663592f0-9b34-484c-aeee-b126ad0d29f9', '971123456789', 'flaterdaily', 'daily', '2', '2020-01-21 16:23:18', '2020-01-21 16:23:18', 'en'),
(12, 'http://pay-with-du.ae/20/digizone/digizone-flaterdaily-1-ar-doi-web?origin=digizone&uid=971123456789&trxid=710902d7-8f97-4b7b-af8f-84a250aa8dbe&serviceProvider=secured&serviceid=flaterdaily&plan=daily&price=2&locale=ar', '710902d7-8f97-4b7b-af8f-84a250aa8dbe', '971123456789', 'flaterdaily', 'daily', '2', '2020-01-21 16:24:05', '2020-01-21 16:24:05', 'ar'),
(13, 'http://pay-with-du.ae/20/digizone/digizone-flaterdaily-1-ar-doi-web?origin=digizone&uid=971551596697&trxid=adb77046-b447-410c-a1da-087a6c11c56d&serviceProvider=secured&serviceid=flaterdaily&plan=daily&price=2&locale=ar', 'adb77046-b447-410c-a1da-087a6c11c56d', '971551596697', 'flaterdaily', 'daily', '2', '2020-01-22 09:02:39', '2020-01-22 09:02:39', 'ar'),
(14, 'http://pay-with-du.ae/20/digizone/digizone-flaterdaily-1-ar-doi-web?origin=digizone&uid=971123456789&trxid=ab1a94e5-b764-4a3c-99da-d14f083d1e83&serviceProvider=secured&serviceid=flaterdaily&plan=daily&price=2&locale=ar&redirectUrl=', 'ab1a94e5-b764-4a3c-99da-d14f083d1e83', '971123456789', 'flaterdaily', 'daily', '2', '2020-01-28 12:11:03', '2020-01-28 12:11:03', 'ar'),
(15, 'http://pay-with-du.ae/20/digizone/digizone-flaterdaily-1-ar-doi-web?origin=digizone&uid=971123456789&trxid=e8c6ee4e-f013-4908-b69d-1e9a28efc5de&serviceProvider=secured&serviceid=flaterdaily&plan=daily&price=2&locale=ar&redirectUrl=', 'e8c6ee4e-f013-4908-b69d-1e9a28efc5de', '971123456789', 'flaterdaily', 'daily', '2', '2020-01-28 12:11:25', '2020-01-28 12:11:25', 'ar'),
(16, 'http://pay-with-du.ae/20/digizone/digizone-flaterdaily-1-ar-doi-web?origin=digizone&uid=971123456789&trxid=0e560f45-3ed6-4dbc-ab57-8a4a380add13&serviceProvider=secured&serviceid=flaterdaily&plan=daily&price=2&locale=ar&redirectUrl=', '0e560f45-3ed6-4dbc-ab57-8a4a380add13', '971123456789', 'flaterdaily', 'daily', '2', '2020-01-28 12:16:39', '2020-01-28 12:16:39', 'ar'),
(17, 'http://pay-with-du.ae/20/digizone/digizone-flaterdaily-1-ar-doi-web?origin=digizone&uid=971123456788&trxid=145dda48-fdfc-4155-ba8f-fd915f791941&serviceProvider=secured&serviceid=flaterdaily&plan=daily&price=2&locale=ar&redirectUrl=', '145dda48-fdfc-4155-ba8f-fd915f791941', '971123456788', 'flaterdaily', 'daily', '2', '2020-01-28 12:29:43', '2020-01-28 12:29:43', 'ar'),
(18, 'http://pay-with-du.ae/20/digizone/digizone-flaterdaily-1-ar-doi-web?origin=digizone&uid=971123456789&trxid=262aba96-91b4-4e32-a157-100ac62cd6b9&serviceProvider=secured&serviceid=flaterdaily&plan=daily&price=2&locale=ar&redirectUrl=', '262aba96-91b4-4e32-a157-100ac62cd6b9', '971123456789', 'flaterdaily', 'daily', '2', '2020-01-28 14:54:08', '2020-01-28 14:54:08', 'ar'),
(19, 'http://pay-with-du.ae/20/digizone/digizone-flaterweekly-7-en-doi-web?origin=digizone&uid=971123456789&trxid=4ce17007-ede0-4976-b4de-2e0eae419ab2&serviceProvider=secured&serviceid=flaterweekly&plan=weekly&price=14&locale=en&redirectUrl=', '4ce17007-ede0-4976-b4de-2e0eae419ab2', '971123456789', 'flaterweekly', 'weekly', '14', '2020-01-28 14:54:22', '2020-01-28 14:54:22', 'en'),
(20, 'http://pay-with-du.ae/20/digizone/digizone-flaterweekly-7-ar-doi-web?origin=digizone&uid=971123456789&trxid=3dd0e4d9-e19a-4244-a76c-0eaacda240db&serviceProvider=secured&serviceid=flaterweekly&plan=weekly&price=14&locale=ar&redirectUrl=', '3dd0e4d9-e19a-4244-a76c-0eaacda240db', '971123456789', 'flaterweekly', 'weekly', '14', '2020-01-28 14:54:36', '2020-01-28 14:54:36', 'ar'),
(21, 'http://pay-with-du.ae/20/digizone/digizone-flaterdaily-1-ar-doi-web?origin=digizone&uid=&trxid=4d72d065-27ff-4e12-8193-fc45b8a98b4a&serviceProvider=secured&serviceid=flaterdaily&plan=daily&price=2&locale=ar&redirectUrl=', '4d72d065-27ff-4e12-8193-fc45b8a98b4a', '', 'flaterdaily', 'daily', '2', '2020-02-16 12:15:24', '2020-02-16 12:15:24', 'ar'),
(22, 'http://pay-with-du.ae/20/digizone/digizone-flaterdaily-1-ar-doi-web?origin=digizone&uid=971123456789&trxid=7ced6a3c-29e0-4115-9fff-40917bbd6b35&serviceProvider=secured&serviceid=flaterdaily&plan=daily&price=2&locale=ar&redirectUrl=', '7ced6a3c-29e0-4115-9fff-40917bbd6b35', '971123456789', 'flaterdaily', 'daily', '2', '2020-02-16 12:24:13', '2020-02-16 12:24:13', 'ar'),
(23, 'http://pay-with-du.ae/20/digizone/digizone-flaterdaily-1-en-doi-web?origin=digizone&uid=971123456789&trxid=873915ef-d09b-48b5-93fb-96ed30f5768a&serviceProvider=secured&serviceid=flaterdaily&plan=daily&price=2&locale=en&redirectUrl=', '873915ef-d09b-48b5-93fb-96ed30f5768a', '971123456789', 'flaterdaily', 'daily', '2', '2020-02-16 12:24:31', '2020-02-16 12:24:31', 'en'),
(24, 'http://pay-with-du.ae/20/digizone/digizone-flaterweekly-7-en-doi-web?origin=digizone&uid=971123456789&trxid=a68868dc-f3b4-4dd4-8a6a-c4590675135a&serviceProvider=secured&serviceid=flaterweekly&plan=weekly&price=14&locale=en&redirectUrl=', 'a68868dc-f3b4-4dd4-8a6a-c4590675135a', '971123456789', 'flaterweekly', 'weekly', '14', '2020-02-16 12:24:53', '2020-02-16 12:24:53', 'en'),
(25, 'http://pay-with-du.ae/20/digizone/digizone-flaterweekly-7-ar-doi-web?origin=digizone&uid=971123456789&trxid=f0a0048a-c2f4-45e7-854b-c563a8599f71&serviceProvider=secured&serviceid=flaterweekly&plan=weekly&price=14&locale=ar&redirectUrl=', 'f0a0048a-c2f4-45e7-854b-c563a8599f71', '971123456789', 'flaterweekly', 'weekly', '14', '2020-02-16 12:25:05', '2020-02-16 12:25:05', 'ar'),
(26, 'http://pay-with-du.ae/20/digizone/digizone-flaterdaily-1-ar-doi-web?origin=digizone&uid=971123456789&trxid=fd6a7554-cca5-4218-ba5f-4ed7cc5f3df4&serviceProvider=secured&serviceid=flaterdaily&plan=daily&price=2&locale=ar&redirectUrl=', 'fd6a7554-cca5-4218-ba5f-4ed7cc5f3df4', '971123456789', 'flaterdaily', 'daily', '2', '2020-02-18 15:59:52', '2020-02-18 15:59:52', 'ar'),
(27, 'http://pay-with-du.ae/20/digizone/digizone-flaterdaily-1-ar-doi-web?origin=digizone&uid=971123456789&trxid=09a5a44c-d533-462b-bf76-4084310494f4&serviceProvider=secured&serviceid=flaterdaily&plan=daily&price=2&locale=ar&redirectUrl=', '09a5a44c-d533-462b-bf76-4084310494f4', '971123456789', 'flaterdaily', 'daily', '2', '2020-02-19 08:35:00', '2020-02-19 08:35:00', 'ar'),
(28, 'http://pay-with-du.ae/20/digizone/digizone-flaterdaily-1-ar-doi-web?origin=digizone&uid=971123456789&trxid=d6045262-f684-44ca-b59b-f22fcf28cc15&serviceProvider=secured&serviceid=flaterdaily&plan=daily&price=2&locale=ar&redirectUrl=', 'd6045262-f684-44ca-b59b-f22fcf28cc15', '971123456789', 'flaterdaily', 'daily', '2', '2020-02-19 08:35:07', '2020-02-19 08:35:07', 'ar'),
(29, 'http://pay-with-du.ae/20/digizone/digizone-flaterdaily-1-ar-doi-web?origin=digizone&uid=971123789545&trxid=43782006-0f44-485e-9bb1-3d14b0fbd5ca&serviceProvider=secured&serviceid=flaterdaily&plan=daily&price=2&locale=ar&redirectUrl=', '43782006-0f44-485e-9bb1-3d14b0fbd5ca', '971123789545', 'flaterdaily', 'daily', '2', '2020-02-19 15:16:36', '2020-02-19 15:16:36', 'ar');

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
  `UID` bigint(20) NOT NULL,
  `url_occasion_text` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `url_occasion_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `generatedurls`
--

INSERT INTO `generatedurls` (`id`, `operator_id`, `occasion_id`, `img`, `audio`, `video`, `UID`, `url_occasion_text`, `url_occasion_image`, `created_at`, `updated_at`) VALUES
(1, 17, 1, 1, 0, 0, 63311, NULL, '', '2020-07-12 06:43:58', '2020-07-12 06:43:58');

-- --------------------------------------------------------

--
-- Table structure for table `greetingaudios`
--

CREATE TABLE `greetingaudios` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(90) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `occasion_id` int(10) UNSIGNED NOT NULL,
  `cprovider_id` int(10) UNSIGNED NOT NULL,
  `RDate` date NOT NULL,
  `EXDate` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `notification` int(11) NOT NULL,
  `rbt` int(11) NOT NULL,
  `popular_count` int(11) NOT NULL,
  `featured` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `greetingaudio_operator`
--

CREATE TABLE `greetingaudio_operator` (
  `greetingaudio_id` int(10) UNSIGNED NOT NULL,
  `operator_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `greetingimgs`
--

CREATE TABLE `greetingimgs` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(90) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vid_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vid_path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `occasion_id` int(10) UNSIGNED DEFAULT NULL,
  `RDate` date NOT NULL,
  `EXDate` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `X` int(11) NOT NULL DEFAULT 150,
  `Y` int(11) NOT NULL DEFAULT 330,
  `Font` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Fonts/29ltbukralight.ttf',
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
  `popular_count` int(11) NOT NULL,
  `dislike` int(11) NOT NULL,
  `like` int(11) NOT NULL,
  `featured` int(11) NOT NULL DEFAULT 0,
  `snap` int(11) NOT NULL DEFAULT 0 COMMENT '0:default / 1:snap',
  `snap_link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rbt_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `greetingimgs`
--

INSERT INTO `greetingimgs` (`id`, `title`, `path`, `vid_type`, `vid_path`, `occasion_id`, `RDate`, `EXDate`, `created_at`, `updated_at`, `X`, `Y`, `Font`, `FontSize`, `Angle`, `FirstR`, `FirstG`, `FirstB`, `SecondR`, `secondG`, `secondB`, `MainR`, `MainG`, `MainB`, `DefLetLength`, `Arabic`, `popular_count`, `dislike`, `like`, `featured`, `snap`, `snap_link`, `rbt_id`) VALUES
(1, 'خبر 1', 'Greetings/12-07-2020/209-Pic01.png', NULL, NULL, 1, '2020-07-12', '2020-08-12', '2020-07-12 06:35:40', '2020-07-12 06:35:40', 150, 330, 'Fonts/29ltbukralight.ttf', 24, 0, 255, 255, 255, 128, 128, 128, 0, 0, 0, 15, 1, 1486, 0, 0, 1, 1, 'https://www.snapchat.com/unlock/?type=SNAPCODE&uuid=5190090f73104bd9af7504cb96bae1dd&metadata=01', NULL),
(2, 'خبر 2', 'Greetings/12-07-2020/137-Pic02.png', NULL, NULL, 1, '2020-07-12', '2020-08-12', '2020-07-12 06:36:10', '2020-07-12 06:37:09', 150, 330, 'Fonts/29ltbukralight.ttf', 24, 0, 255, 255, 255, 128, 128, 128, 0, 0, 0, 15, 1, 1239, 0, 0, 1, 1, 'https://www.snapchat.com/unlock/?type=SNAPCODE&uuid=5190090f73104bd9af7504cb96bae1dd&metadata=01', NULL),
(3, 'خبر 3', 'Greetings/12-07-2020/843-Pic03.png', NULL, NULL, 1, '2020-07-12', '2020-08-12', '2020-07-12 06:37:27', '2020-07-12 06:37:27', 150, 330, 'Fonts/29ltbukralight.ttf', 24, 0, 255, 255, 255, 128, 128, 128, 0, 0, 0, 15, 1, 1308, 0, 0, 1, 1, 'https://www.snapchat.com/unlock/?type=SNAPCODE&uuid=5190090f73104bd9af7504cb96bae1dd&metadata=01', NULL),
(4, 'خبر 4', 'Greetings/12-07-2020/740-Pic04.png', NULL, NULL, 1, '2020-07-12', '2020-08-12', '2020-07-12 06:37:38', '2020-07-12 06:37:38', 150, 330, 'Fonts/29ltbukralight.ttf', 24, 0, 255, 255, 255, 128, 128, 128, 0, 0, 0, 15, 1, 1064, 0, 0, 1, 1, 'https://www.snapchat.com/unlock/?type=SNAPCODE&uuid=5190090f73104bd9af7504cb96bae1dd&metadata=01', NULL),
(5, 'خبر 5', 'Greetings/12-07-2020/989-Pic05.png', NULL, NULL, 1, '2020-07-12', '2020-08-12', '2020-07-12 06:37:49', '2020-07-12 06:37:49', 150, 330, 'Fonts/29ltbukralight.ttf', 24, 0, 255, 255, 255, 128, 128, 128, 0, 0, 0, 15, 1, 1345, 0, 0, 1, 1, 'https://www.snapchat.com/unlock/?type=SNAPCODE&uuid=5190090f73104bd9af7504cb96bae1dd&metadata=01', NULL),
(6, 'خبر 6', 'Greetings/12-07-2020/649-Pic06.png', NULL, NULL, 1, '2020-07-12', '2020-08-12', '2020-07-12 06:38:01', '2020-07-12 06:38:01', 150, 330, 'Fonts/29ltbukralight.ttf', 24, 0, 255, 255, 255, 128, 128, 128, 0, 0, 0, 15, 1, 1433, 0, 0, 1, 1, 'https://www.snapchat.com/unlock/?type=SNAPCODE&uuid=5190090f73104bd9af7504cb96bae1dd&metadata=01', NULL),
(7, 'خبر 7', 'Greetings/12-07-2020/893-Pic02.png', NULL, NULL, 1, '2020-07-12', '2020-08-12', '2020-07-12 06:38:18', '2020-07-12 06:38:18', 150, 330, 'Fonts/29ltbukralight.ttf', 24, 0, 255, 255, 255, 128, 128, 128, 0, 0, 0, 15, 1, 1034, 0, 0, 1, 1, 'https://www.snapchat.com/unlock/?type=SNAPCODE&uuid=5190090f73104bd9af7504cb96bae1dd&metadata=01', NULL),
(8, 'خبر 8', 'Greetings/12-07-2020/772-Pic04.png', NULL, NULL, 1, '2020-07-12', '2020-08-12', '2020-07-12 06:38:37', '2020-07-12 06:38:37', 150, 330, 'Fonts/29ltbukralight.ttf', 24, 0, 255, 255, 255, 128, 128, 128, 0, 0, 0, 15, 1, 1255, 0, 0, 1, 1, 'https://www.snapchat.com/unlock/?type=SNAPCODE&uuid=5190090f73104bd9af7504cb96bae1dd&metadata=01', NULL),
(9, 'خبر 9', 'Greetings/12-07-2020/329-Pic06.png', NULL, NULL, 1, '2020-07-12', '2020-08-12', '2020-07-12 06:38:53', '2020-07-12 06:38:53', 150, 330, 'Fonts/29ltbukralight.ttf', 24, 0, 255, 255, 255, 128, 128, 128, 0, 0, 0, 15, 1, 1481, 0, 0, 1, 1, 'https://www.snapchat.com/unlock/?type=SNAPCODE&uuid=5190090f73104bd9af7504cb96bae1dd&metadata=01', NULL),
(10, 'خبر 10', 'Greetings/12-07-2020/803-Pic01.png', NULL, NULL, 1, '2020-07-12', '2020-08-12', '2020-07-12 06:39:51', '2020-07-12 06:39:51', 150, 330, 'Fonts/29ltbukralight.ttf', 24, 0, 255, 255, 255, 128, 128, 128, 0, 0, 0, 15, 1, 1423, 0, 0, 1, 1, 'https://www.snapchat.com/unlock/?type=SNAPCODE&uuid=5190090f73104bd9af7504cb96bae1dd&metadata=01', NULL),
(11, 'خبر 11', 'Greetings/12-07-2020/386-Pic03.png', NULL, NULL, 1, '2020-07-12', '2020-08-12', '2020-07-12 06:40:01', '2020-07-12 06:40:01', 150, 330, 'Fonts/29ltbukralight.ttf', 24, 0, 255, 255, 255, 128, 128, 128, 0, 0, 0, 15, 1, 1245, 0, 0, 1, 1, 'https://www.snapchat.com/unlock/?type=SNAPCODE&uuid=5190090f73104bd9af7504cb96bae1dd&metadata=01', NULL),
(12, 'خبر 12', 'Greetings/12-07-2020/390-Pic05.png', NULL, NULL, 1, '2020-07-12', '2020-08-12', '2020-07-12 06:40:12', '2020-07-12 06:40:12', 150, 330, 'Fonts/29ltbukralight.ttf', 24, 0, 255, 255, 255, 128, 128, 128, 0, 0, 0, 15, 1, 1244, 0, 0, 1, 1, 'https://www.snapchat.com/unlock/?type=SNAPCODE&uuid=5190090f73104bd9af7504cb96bae1dd&metadata=01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `greetingimg_operator`
--

CREATE TABLE `greetingimg_operator` (
  `greetingimg_id` int(10) UNSIGNED NOT NULL,
  `operator_id` int(10) UNSIGNED NOT NULL,
  `popular_count` int(11) NOT NULL,
  `dislike` int(11) NOT NULL,
  `like` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `greetingimg_operator`
--

INSERT INTO `greetingimg_operator` (`greetingimg_id`, `operator_id`, `popular_count`, `dislike`, `like`, `created_at`, `updated_at`, `id`) VALUES
(1, 17, 0, 0, 0, '2020-07-12 06:35:40', '2020-07-12 06:35:40', 1),
(2, 17, 0, 0, 0, '2020-07-12 06:36:10', '2020-07-12 06:36:10', 2),
(3, 17, 0, 0, 0, '2020-07-12 06:37:27', '2020-07-12 06:37:27', 3),
(4, 17, 0, 0, 0, '2020-07-12 06:37:38', '2020-07-12 06:37:38', 4),
(5, 17, 0, 0, 0, '2020-07-12 06:37:49', '2020-07-12 06:37:49', 5),
(6, 17, 0, 0, 0, '2020-07-12 06:38:01', '2020-07-12 06:38:01', 6),
(7, 17, 0, 0, 0, '2020-07-12 06:38:18', '2020-07-12 06:38:18', 7),
(8, 17, 0, 0, 0, '2020-07-12 06:38:37', '2020-07-12 06:38:37', 8),
(9, 17, 0, 0, 0, '2020-07-12 06:38:53', '2020-07-12 06:38:53', 9),
(10, 17, 0, 0, 0, '2020-07-12 06:39:51', '2020-07-12 06:39:51', 10),
(11, 17, 0, 0, 0, '2020-07-12 06:40:01', '2020-07-12 06:40:01', 11),
(12, 17, 0, 0, 0, '2020-07-12 06:40:12', '2020-07-12 06:40:12', 12);

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `short_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rtl` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2018_12_09_093056_create_advertising_urls_table', 0),
('2018_12_09_093056_create_categories_table', 0),
('2018_12_09_093056_create_countries_table', 0),
('2018_12_09_093056_create_cproviders_table', 0),
('2018_12_09_093056_create_generatedurls_table', 0),
('2018_12_09_093056_create_greetingaudio_operator_table', 0),
('2018_12_09_093056_create_greetingaudios_table', 0),
('2018_12_09_093056_create_greetingimg_operator_table', 0),
('2018_12_09_093056_create_greetingimgs_table', 0),
('2018_12_09_093056_create_msisdns_table', 0),
('2018_12_09_093056_create_notify_table', 0),
('2018_12_09_093056_create_occasions_table', 0),
('2018_12_09_093056_create_operators_table', 0),
('2018_12_09_093056_create_password_resets_table', 0),
('2018_12_09_093056_create_processedimgs_table', 0),
('2018_12_09_093056_create_processedvids_table', 0),
('2018_12_09_093056_create_rbt_codes_table', 0),
('2018_12_09_093056_create_sessions_table', 0),
('2018_12_09_093056_create_users_table', 0),
('2018_12_09_093059_add_foreign_keys_to_msisdns_table', 0),
('2018_09_13_094721_create_sessions_table', 1),
('2018_12_09_084836_create_settings_table', 1),
('2019_03_18_084855_create_msisdn_greetingimgs_table', 2),
('2019_03_18_103433_add_forgin_key_to_msisdn_freetingimgs', 2),
('2019_03_31_105142_add_close_to_operators', 3),
('2019_04_08_110315_add_slider_flag_in_occasions', 4),
('2019_04_22_071431_add_parent_id_to_occasions', 5),
('2019_08_27_113159_add_column_to_msisdens', 4),
('2019_08_28_122559_add_msisdn_to_msisdns', 6),
('2019_08_28_132258_add_viav_to_notify', 7),
('2019_10_13_133223_add_popular_count_to_greetingimg_operator_table', 8),
('2019_10_28_093504_add_date_ocasions_table', 8),
('2019_11_04_105149_add_like_dislike_to_greetingimgs_table', 9),
('2019_11_04_105150_add_like_dislike_to_greetingimg_operator_table', 9),
('2019_11_25_100756_add_vid_link_to_greetingimg', 10),
('2019_11_19_081652_create_language_table', 11),
('2019_11_19_081736_create_static_translations_table', 11),
('2019_11_19_081756_create_static_body_table', 11),
('2019_11_19_081817_create_translatable_table', 11),
('2019_11_19_081846_create_translate_body', 11),
('2019_11_19_081918_add_short_code_and_rtl_to_language', 11),
('2020_01_15_123132_create_du_intgration', 12),
('2020_01_16_113647_edit_du_integration', 12),
('2020_01_19_162326_add_forgin_key', 13),
('2020_01_22_163125_add_null_value_to_greetingimgs', 13),
('2020_01_22_172338_add_value_to_setting', 13),
('2020_01_19_162125_add_null_value_to_greetingimgs', 14),
('2018_10_16_105750_create_roles_table', 15),
('2020_01_26_101630_operator_rbt_sms_nullable', 15),
('2020_01_26_110517_country_operator_innodb', 15),
('2020_07_09_143114_create_news_table', 16),
('2020_07_09_150741_add_published_date_to_news_table', 16);

-- --------------------------------------------------------

--
-- Table structure for table `msisdns`
--

CREATE TABLE `msisdns` (
  `id` int(10) UNSIGNED NOT NULL,
  `phone_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `msisdn` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `operator_id` int(11) NOT NULL COMMENT '8=zain , 50 ooredo , 51= viva',
  `ooredoo_notify_id` int(10) UNSIGNED DEFAULT NULL,
  `ads_ur_id` int(10) UNSIGNED DEFAULT NULL,
  `transaction_id` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ad_company` enum('headway','intech','DF') COLLATE utf8_unicode_ci DEFAULT NULL,
  `final_status` tinyint(1) DEFAULT NULL COMMENT '0=not active  , 1 active ',
  `pincode` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `plan_id` tinyint(4) NOT NULL COMMENT '1= Postpaid , 2 = Prepaid  , 3 = Data/blacklisted/Non ooredoo numbers',
  `subscribe_date` date NOT NULL,
  `renew_date` date NOT NULL,
  `type` enum('wifi','HE','SMS') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'wifi' COMMENT 'wifi= wifi , HE = Header enriched,SMS = SMS',
  `validityDays` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `plan` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `msisdns`
--

INSERT INTO `msisdns` (`id`, `phone_number`, `msisdn`, `created_at`, `updated_at`, `operator_id`, `ooredoo_notify_id`, `ads_ur_id`, `transaction_id`, `ad_company`, `final_status`, `pincode`, `plan_id`, `subscribe_date`, `renew_date`, `type`, `validityDays`, `plan`) VALUES
(1786, '96599949005', '', '2019-11-11 14:41:41', '2019-11-11 14:41:41', 50, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2019-11-11', '0000-00-00', 'HE', NULL, NULL),
(2096, '', '966548053333', '2020-03-05 11:49:24', '2020-03-05 11:49:24', 16, NULL, 5292, NULL, 'DF', NULL, NULL, 0, '0000-00-00', '0000-00-00', 'wifi', NULL, NULL),
(2097, '', '966581301863', '2020-03-05 12:16:02', '2020-03-05 12:36:32', 14, NULL, 5308, NULL, 'DF', NULL, NULL, 0, '0000-00-00', '0000-00-00', 'wifi', NULL, NULL),
(2098, '', '966548053333', '2020-03-09 12:21:24', '2020-03-09 12:21:24', 14, NULL, 5317, NULL, 'DF', NULL, NULL, 0, '0000-00-00', '0000-00-00', 'wifi', NULL, NULL),
(2099, '', '966548053333', '2020-03-09 12:21:25', '2020-03-09 12:21:25', 14, NULL, 5318, NULL, 'DF', NULL, NULL, 0, '0000-00-00', '0000-00-00', 'wifi', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `msisdn_greetingimgs`
--

CREATE TABLE `msisdn_greetingimgs` (
  `id` int(10) UNSIGNED NOT NULL,
  `greetingimg_id` int(10) UNSIGNED NOT NULL,
  `msisdn_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `occasion_id` int(10) UNSIGNED DEFAULT NULL,
  `published_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `description`, `image`, `occasion_id`, `published_date`, `created_at`, `updated_at`) VALUES
(3, 'بدء امتحاني الكيمياء والجغرافيا لطلاب الثانوية العامة', '<p arabic=\"\" color:=\"\" droid=\"\" font-size:=\"\" font-weight:=\"\" line-height:=\"\" medium=\"\" none=\"\" outline:=\"\" style=\"box-sizing: border-box; margin: 0px 0px 1.25em; padding: 0px; direction: rtl; font-family: \" text-align:=\"\" text-rendering:=\"\">بدأ منذ قليل 667 ألف طالب وطالبة بالثانوية العامة أداء امتحان الكيمياء والجغرافيا، وذلك في 2216 لجنة سير رئيسية و56 ألف و591 لجنة فرعية على مستوى الجمهورية.<br style=\"box-sizing: border-box; outline: none medium !important;\" />\r\nوبدأ طلاب الثانوية العامة التوافد على لجان الامتحانات لأداء المسح الحراري قبل أداء الامتحان، وذلك عن طريق الكواشف الحرارية في الثامنة صباحا ،وكذلك المرور من بوابات التعقيم واستلام غطاء الأحذية والمعقمات الشخصية قبل بدء الامتحان.</p>', '1594543532157.jpg', 1, '2020-07-12', '2020-07-12 06:42:19', '2020-07-12 06:45:32'),
(4, 'اتخاذ الإجراءات القانونية ضد 350 طالبًا بتهمة الغش', '<p arabic=\"\" color:=\"\" droid=\"\" font-size:=\"\" font-weight:=\"\" line-height:=\"\" medium=\"\" none=\"\" outline:=\"\" style=\"box-sizing: border-box; margin: 0px 0px 1.25em; padding: 0px; direction: rtl; font-family: \" text-rendering:=\"\">عقدت وزارة التربية والتعليم والتعليم الفني، اجتماعًا مع مديري المديريات ورؤساء لجان السير وأعضاء غرف العمليات بالإدارات والمديريات على مستوى الجمهورية عبر شبكة الفيديو كونفرانس، للتصدي لبعض التجاوزات التي حدثت في بعض لجان شهادة الثانوية العامة للعام الدراسي 2019-2020 خلال الامتحانات السابقة.</p>', '1594543541915.jpg', 1, '2020-07-12', '2020-07-12 06:43:43', '2020-07-12 06:46:02');

-- --------------------------------------------------------

--
-- Table structure for table `notify`
--

CREATE TABLE `notify` (
  `id` int(10) UNSIGNED NOT NULL,
  `complete_url` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `msisdn` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Result` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Reason` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `transID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `FLOW` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `action` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `occasions`
--

CREATE TABLE `occasions` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `slider` int(11) NOT NULL DEFAULT 0,
  `occasion_RDate` date NOT NULL,
  `occasion_EXDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `occasions`
--

INSERT INTO `occasions` (`id`, `title`, `category_id`, `created_at`, `updated_at`, `image`, `parent_id`, `slider`, `occasion_RDate`, `occasion_EXDate`) VALUES
(1, 'اخبار', 1, '2020-07-12 06:34:33', '2020-07-12 06:34:33', 'Greetings/Occasion/1594542873.png', NULL, 1, '2020-07-12', '2021-07-12');

-- --------------------------------------------------------

--
-- Table structure for table `operators`
--

CREATE TABLE `operators` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `country_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `rbt_sms` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `close` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `operators`
--

INSERT INTO `operators` (`id`, `name`, `country_id`, `created_at`, `updated_at`, `rbt_sms`, `close`) VALUES
(8, 'Zain', 5, '2015-09-13 10:02:08', '2018-09-13 06:51:46', '55555', 0),
(12, 'Ooredoo', 5, '2015-09-14 06:25:11', '2015-09-14 06:25:11', '', 0),
(13, 'Viva', 5, '2015-09-14 06:25:31', '2015-09-14 06:25:31', '', 0),
(14, 'Mobily', 9, '2015-09-14 06:45:02', '2019-11-19 06:49:45', '', 1),
(15, 'STC', 9, '2015-09-14 06:45:32', '2015-09-14 06:45:32', '', 0),
(16, 'Zain', 9, '2015-09-14 06:45:55', '2019-11-19 06:49:35', '', 1),
(17, 'Etisalat', 1, '2015-09-14 07:14:18', '2015-09-14 07:14:18', '', 0),
(18, 'yemen oper', 10, '2015-09-14 08:37:58', '2015-09-14 08:38:13', '', 0),
(19, 'Zain', 11, '2015-09-14 09:58:40', '2015-09-14 09:59:09', '', 0),
(20, 'Umniah', 11, '2015-09-14 09:59:25', '2015-09-14 09:59:25', '', 0),
(21, 'Orange', 11, '2015-09-14 09:59:45', '2015-09-14 09:59:45', '', 0),
(22, 'Zain', 12, '2015-09-14 09:59:59', '2015-09-14 09:59:59', '', 0),
(23, 'sarah', 2, '2018-08-14 11:02:29', '2018-08-14 11:11:02', '111', 0),
(24, 'DU', 13, '2018-12-20 13:32:07', '2018-12-20 13:32:07', '', 0),
(25, 'ZAIN JORDAN', 11, '2019-01-08 12:42:28', '2020-01-23 09:32:42', '212', 0),
(26, 'ZAIN IRAQ', 14, '2019-01-08 12:44:13', '2019-01-08 12:44:13', '', 0),
(27, 'korek', 14, '2019-04-18 11:39:45', '2019-04-18 11:39:45', '', 0),
(28, 'test', 10, '2020-01-23 09:32:35', '2020-01-23 09:32:57', '', 0),
(30, 'stc', 1, '2020-07-11 12:25:45', '2020-07-11 12:25:45', '789', 0);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('hany@ivas.mobi', '915d75509b5b3c69e194d5831f5739407b05172e164ce7ed45ed9bcad5328c9f', '2015-09-16 13:11:54'),
('emad@ivas.mobi', '75c4d298e303d0f6ff445930627c7701abe8853c2f306debc52dcc4df3346ce9', '2016-02-22 13:36:34'),
('ahmed333555777@gmail.com', '$2y$10$jl51mj.MPGCHlvIQHuaAWebXU/1K2mLeFrO9BowCfOur504W0YpUS', '2020-01-27 05:58:35');

-- --------------------------------------------------------

--
-- Table structure for table `processedimgs`
--

CREATE TABLE `processedimgs` (
  `id` int(10) UNSIGNED NOT NULL,
  `greetingimg_id` int(10) UNSIGNED NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FID` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `processedvids`
--

CREATE TABLE `processedvids` (
  `id` int(10) UNSIGNED NOT NULL,
  `processedimg_id` int(10) UNSIGNED NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FID` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rbt_codes`
--

CREATE TABLE `rbt_codes` (
  `id` int(10) UNSIGNED NOT NULL,
  `audio_id` int(10) UNSIGNED NOT NULL,
  `operator_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rbt_codes`
--

INSERT INTO `rbt_codes` (`id`, `audio_id`, `operator_id`, `code`, `created_at`, `updated_at`) VALUES
(3, 8, 8, '1333', '2018-08-15 08:03:33', '2018-08-15 09:20:54'),
(4, 8, 13, '5656', '2018-08-15 08:03:33', '2018-08-15 09:21:04'),
(5, 8, 19, '86784', '2018-08-15 08:03:33', '2018-08-15 08:03:33'),
(12, 8, 17, '1234', '2018-08-15 09:18:25', '2018-08-15 09:18:25'),
(13, 83, 14, '5644', '2018-08-15 10:30:01', '2018-08-15 10:30:01'),
(14, 88, 8, '123', '2018-09-13 06:53:41', '2018-09-13 06:53:41'),
(15, 93, 8, '789', '2018-09-13 07:02:54', '2018-09-13 07:02:54'),
(18, 94, 8, '123', '2018-09-19 11:01:18', '2018-09-19 11:01:18'),
(19, 95, 13, '123', '2018-09-19 11:20:48', '2018-12-10 11:45:52'),
(20, 96, 8, '123', '2018-09-19 11:28:28', '2018-09-19 11:28:28'),
(21, 97, 8, '123', '2018-09-19 11:30:05', '2018-09-19 11:30:05'),
(22, 99, 8, '123', '2019-10-29 08:16:47', '2019-10-29 08:16:47'),
(23, 102, 8, '123', '2020-01-23 09:42:52', '2020-01-23 09:42:52'),
(24, 102, 19, '6565', '2020-01-23 09:42:52', '2020-01-23 09:42:52'),
(25, 104, 8, '123', '2020-01-27 07:28:06', '2020-01-27 07:28:06');

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
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payload` text COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `payload`, `last_activity`) VALUES
('91c3d8559f05ef12687adf1d163575d9d74028ff', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZ1VKSHUycEM1b3dNbUFjaG1ZQ2JBanA4WVlqbURkcGY1M2VCYWxXRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHBzOi8vZmlsdGVycy5kaWdpem9uZS5jb20ua3cvdmlld1NuYXAyLzE1ODgvODIyODE4OCI7fXM6OToiX3NmMl9tZXRhIjthOjM6e3M6MToidSI7aToxNTc5NzcxMDIyO3M6MToiYyI7aToxNTc5NzcxMDIyO3M6MToibCI7czoxOiIwIjt9czo1OiJmbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1579771022),
('f272425c56828e6a3679e3936467d367395f64f1', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQWlyR3pDYmlaU09URFJtTTY2Wkk3TGVsZjVwVVBtV1FWTGlYUzk2cSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHBzOi8vZmlsdGVycy5kaWdpem9uZS5jb20ua3cvdmlld1NuYXAyLzE1ODgvODIyODE4OCI7fXM6OToiX3NmMl9tZXRhIjthOjM6e3M6MToidSI7aToxNTc5NzcxMDIxO3M6MToiYyI7aToxNTc5NzcxMDIxO3M6MToibCI7czoxOiIwIjt9czo1OiJmbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1579771021),
('2ae2287e8a7b4d8d4f7e0f22585b8e4bb35c4a74', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYjljQ1ZCSVNuczVDUm9ieVk5Mk9uZkZJQ1lXYUI1THp1S0QzekcxSiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHBzOi8vZmlsdGVycy5kaWdpem9uZS5jb20ua3cvdmlld1NuYXAyLzE1ODgvODIyODE4OCI7fXM6OToiX3NmMl9tZXRhIjthOjM6e3M6MToidSI7aToxNTc5NzcxMDAwO3M6MToiYyI7aToxNTc5NzcxMDAwO3M6MToibCI7czoxOiIwIjt9czo1OiJmbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1579771001),
('a76e354180010a50b69cec49bf96e9e4143e4bd2', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieWdDSEt0WWgyYWVEbjFXeEk1TXFzNWlIUmVhWm9mQXZ0cUJ6UVJWcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHBzOi8vZmlsdGVycy5kaWdpem9uZS5jb20ua3cvdmlld1NuYXAyLzE1ODgvODIyODE4OCI7fXM6OToiX3NmMl9tZXRhIjthOjM6e3M6MToidSI7aToxNTc5NzcwOTk5O3M6MToiYyI7aToxNTc5NzcwOTk5O3M6MToibCI7czoxOiIwIjt9czo1OiJmbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1579771000),
('7037d0e52e932c82ff37f03c7386b58d3dfc33f8', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiN0NXSkNhNlNhRTFMNVVWeng2NGpCbURFRVhwdExaSmhybHFzYkxHZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHBzOi8vZmlsdGVycy5kaWdpem9uZS5jb20ua3cvdmlld1NuYXAyLzE1ODgvODIyODE4OCI7fXM6OToiX3NmMl9tZXRhIjthOjM6e3M6MToidSI7aToxNTc5NzcwOTk5O3M6MToiYyI7aToxNTc5NzcwOTk5O3M6MToibCI7czoxOiIwIjt9czo1OiJmbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1579770999),
('ae67b1f84e9d24b994beeb82af95047429cd2153', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNW1XZTROM0R5RGZZR1NxVlJ2UG1mVHQ2NnFVWjN6ZzBjTVlRRmFRMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHBzOi8vZmlsdGVycy5kaWdpem9uZS5jb20ua3cvdmlld1NuYXAyLzE1ODgvODIyODE4OCI7fXM6OToiX3NmMl9tZXRhIjthOjM6e3M6MToidSI7aToxNTc5NzcwOTk5O3M6MToiYyI7aToxNTc5NzcwOTk5O3M6MToibCI7czoxOiIwIjt9czo1OiJmbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1579770999),
('b01a3db5b94405d73cec92ea219336002c610fa8', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUnBoQklQM3pwVWZNYXpNUko1dTFNeHZlVDRKam9LdGltV3BVbTFXQiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHBzOi8vZmlsdGVycy5kaWdpem9uZS5jb20ua3cvdmlld1NuYXAyLzE1ODQvODIyODE4OCI7fXM6OToiX3NmMl9tZXRhIjthOjM6e3M6MToidSI7aToxNTc5NzcxMTU1O3M6MToiYyI7aToxNTc5NzcxMTU1O3M6MToibCI7czoxOiIwIjt9czo1OiJmbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1579771155),
('a72994732e8565887c10496f97598f599aa2cc2e', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaUFXeXRwYjJLRzB3ZEZzYzh0cVpxYzV2bHNYdjNvaDY0RlNsa3N6TCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHBzOi8vZmlsdGVycy5kaWdpem9uZS5jb20ua3cvdmlld1NuYXAyLzE1ODgvODIyODE4OCI7fXM6OToiX3NmMl9tZXRhIjthOjM6e3M6MToidSI7aToxNTc5NzcxMjU5O3M6MToiYyI7aToxNTc5NzcxMjU5O3M6MToibCI7czoxOiIwIjt9czo1OiJmbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1579771259),
('18b53dbe1255d94e30234efd5c283e2b55c097be', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiS1NiUlhjZFM1Z1JnVUhVR0VOMU5qOHY5QTJXQ2dKVnFSMkNXMjlxVCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHBzOi8vZmlsdGVycy5kaWdpem9uZS5jb20ua3cvdmlld1NuYXAyLzE1ODgvODIyODE4OCI7fXM6OToiX3NmMl9tZXRhIjthOjM6e3M6MToidSI7aToxNTc5NzcxMjU5O3M6MToiYyI7aToxNTc5NzcxMjU5O3M6MToibCI7czoxOiIwIjt9czo1OiJmbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1579771260),
('5d427138dd22f1ac07d6f89208dbf7b29bb15930', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidk1ObXZRZWNYN1JteFVtTDFSU0VTMFBTN3lyT2JSSGdndnQzck1jZiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHBzOi8vZmlsdGVycy5kaWdpem9uZS5jb20ua3cvdmlld1NuYXAyLzE1ODgvODIyODE4OCI7fXM6OToiX3NmMl9tZXRhIjthOjM6e3M6MToidSI7aToxNTc5NzcxMjY4O3M6MToiYyI7aToxNTc5NzcxMjY4O3M6MToibCI7czoxOiIwIjt9czo1OiJmbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1579771268),
('54a5c1921f8b1d1db675a1b1acbb4b9d1cd96b5f', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQTM1RWVlaHA4QVlPaW9ERk5tMGluVkh6TVZ3SlJwSWlTcEl2QmNSdyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHBzOi8vZmlsdGVycy5kaWdpem9uZS5jb20ua3cvdmlld1NuYXAyLzE1ODgvODIyODE4OCI7fXM6OToiX3NmMl9tZXRhIjthOjM6e3M6MToidSI7aToxNTc5NzcxMjY5O3M6MToiYyI7aToxNTc5NzcxMjY5O3M6MToibCI7czoxOiIwIjt9czo1OiJmbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1579771269),
('d020f81faf5feb63a18895c6f8045fb204baecdd', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMHNuZlY5aHpibnF1MktnN1FxR0dOeVJNU2R6ZGlxWE9kUVpOVG9PMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHBzOi8vZmlsdGVycy5kaWdpem9uZS5jb20ua3cvdmlld1NuYXAyLzE1ODgvODIyODE4OCI7fXM6OToiX3NmMl9tZXRhIjthOjM6e3M6MToidSI7aToxNTc5NzcxMzU2O3M6MToiYyI7aToxNTc5NzcxMzU2O3M6MToibCI7czoxOiIwIjt9czo1OiJmbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1579771356),
('7b8e24da54c2df891c24602595d5e320e83d4eea', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRW9abWFpcGF5aU1vaThnMXZkQ2VNY0hobTBoVTg2MEF2dmd2a1hFbCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHBzOi8vZmlsdGVycy5kaWdpem9uZS5jb20ua3cvdmlld1NuYXAyLzE1ODgvODIyODE4OCI7fXM6OToiX3NmMl9tZXRhIjthOjM6e3M6MToidSI7aToxNTc5NzcxMzU2O3M6MToiYyI7aToxNTc5NzcxMzU2O3M6MToibCI7czoxOiIwIjt9czo1OiJmbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1579771357),
('8de6fa1c2b33ffb7cc573bf26b744f5bc9d81981', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiOWthSk05R2xlYnhSRG13d2FLbVhDWFB1U3J2Q0ZIekFrNlR2ZnlsdCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHBzOi8vZmlsdGVycy5kaWdpem9uZS5jb20ua3cvdmlld1NuYXAyLzE1ODgvODIyODE4OCI7fXM6OToiX3NmMl9tZXRhIjthOjM6e3M6MToidSI7aToxNTc5NzcxMzY5O3M6MToiYyI7aToxNTc5NzcxMzY5O3M6MToibCI7czoxOiIwIjt9czo1OiJmbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1579771369),
('0b6fd162d8f7016ed73d12ca35679546acd3f828', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRzJFYWYwbks3dFFYYjRSYUdnM1FWcTFSY3MybWtlWWlVTmpvUWNpUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHBzOi8vZmlsdGVycy5kaWdpem9uZS5jb20ua3cvdmlld1NuYXAyLzE1ODgvODIyODE4OCI7fXM6OToiX3NmMl9tZXRhIjthOjM6e3M6MToidSI7aToxNTc5NzcxMzcwO3M6MToiYyI7aToxNTc5NzcxMzcwO3M6MToibCI7czoxOiIwIjt9czo1OiJmbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1579771370),
('1c7d83d801025442b7db0482c061642f5e55b0c1', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMUxkeU9ET0VtZGJxWkFFcHE4ZW9QRmszcDNKd1FBc1pUaWt3d0VYYSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHBzOi8vZmlsdGVycy5kaWdpem9uZS5jb20ua3cvdmlld1NuYXAyLzE1ODgvODIyODE4OCI7fXM6OToiX3NmMl9tZXRhIjthOjM6e3M6MToidSI7aToxNTc5NzcxMzk1O3M6MToiYyI7aToxNTc5NzcxMzk1O3M6MToibCI7czoxOiIwIjt9czo1OiJmbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1579771396),
('f2d4f24ee657dececa7d1160288fd07eaafdae74', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidmJOU1pnNkRNVEFtb1Nua002V0Ywc2lNU0dmNHE5bkMxSVpNZjgzcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHBzOi8vZmlsdGVycy5kaWdpem9uZS5jb20ua3cvdmlld1NuYXAyLzE1ODgvODIyODE4OCI7fXM6OToiX3NmMl9tZXRhIjthOjM6e3M6MToidSI7aToxNTc5NzcxMzk2O3M6MToiYyI7aToxNTc5NzcxMzk2O3M6MToibCI7czoxOiIwIjt9czo1OiJmbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1579771396),
('7d455ac33dda21c66fd7c1c2bb7fecbebaecd105', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUHdKZldnZjU3Sm1uVUZRcE1TTjlaeGlPNXpYNmw5alc2OFcwV2ZEcCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHBzOi8vZmlsdGVycy5kaWdpem9uZS5jb20ua3cvdmlld1NuYXAyLzE1ODgvODIyODE4OCI7fXM6OToiX3NmMl9tZXRhIjthOjM6e3M6MToidSI7aToxNTc5NzcxNDE2O3M6MToiYyI7aToxNTc5NzcxNDE2O3M6MToibCI7czoxOiIwIjt9czo1OiJmbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1579771416),
('96d11321764dd16db16c4808b9757a80401e5d23', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZW5wRDRmbkFyYmhjbGFocGV2elZCd1BadngzcE5iTm5VVWhOZUY2OSI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE1Nzk3Njg5NzE7czoxOiJjIjtpOjE1Nzk3Njg5NzE7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1579768972),
('f74a855a9a34ac63593c1f4ed4064b133db5c0db', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoic205dXNBbVdxZ1hVMmp0MHZYcURnS2J5YkZBaW1ETzZ1TjZrd2l4MSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHBzOi8vZmlsdGVycy5kaWdpem9uZS5jb20ua3cvdmlld1NuYXAyLzE1ODgvNjAxNzE4OSI7fXM6NToiZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE1Nzk3Njk4MDY7czoxOiJjIjtpOjE1Nzk3Njg5NzI7czoxOiJsIjtzOjE6IjAiO319', 1579769807),
('409936fb74ee63d1595a38fda9bf8feef263c472', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoieWxzZ1pVWDF4NjhhM3JYbDZlTmt3QVp4SU1MV0RsOUM0RFFGODBiRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHBzOi8vZmlsdGVycy5kaWdpem9uZS5jb20ua3cvdmlld1NuYXAyLzE1ODgvODczODE5MCI7fXM6NToiZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoxMDoiYWR2X3BhcmFtcyI7czo2MzoicHJldl91cmw9aHR0cHM6Ly9maWx0ZXJzLmRpZ2l6b25lLmNvbS5rdy92aWV3U25hcDIvMTU5NS84NTA2MjM0IjtzOjY6Ik1TSVNETiI7czo5OiI1NDgwNTMzMzMiO3M6NjoiU3RhdHVzIjtzOjY6ImFjdGl2ZSI7czo5OiJjdXJyZW50T3AiO2k6MTQ7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE1Nzk3Njk4MTE7czoxOiJjIjtpOjE1Nzk3Njg1MTg7czoxOiJsIjtzOjE6IjAiO319', 1579769811),
('2c09dea8347e72edb0b9a7dade00ec42b69cc14d', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWElMRG5td1Azb0ZJQllzeURaVHU0WDZINk1CWHlBRXlvMDFiSHRqYiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjAxOiJodHRwczovL2ZpbHRlcnMuZGlnaXpvbmUuY29tLmt3L3ZpdmFfbm90aWZpY2F0aW9uP0NoYW5uZWxJRD00NDkzJk1TSVNETj05NjU1MDYzMTkwMyZPcGVyYXRvcklEPTQxOTA0JlBhc3N3b3JkPWt1d2FpdCU0MCUyMWRleCZQcmljZT01MCZSZXF1ZXN0SUQ9NzE5OTkyOTE0JlNUQVRVUz1SU0MtQkwmU2VydmljZUlEPTgwOCZVc2VyPWt1d2FpdCU0MGlkZXgiO31zOjk6Il9zZjJfbWV0YSI7YTozOntzOjE6InUiO2k6MTU3OTc2NzczMztzOjE6ImMiO2k6MTU3OTc2NzczMztzOjE6ImwiO3M6MToiMCI7fXM6NToiZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1579767733),
('a8be6a5b97329b2e471162e3d43b5dfcee38cc9d', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicWYxVEdSYlk1SDQ0Yzd0Y29DWmtKazlXaXlpMzJySmdnN2s3U3hGcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjAxOiJodHRwczovL2ZpbHRlcnMuZGlnaXpvbmUuY29tLmt3L3ZpdmFfbm90aWZpY2F0aW9uP0NoYW5uZWxJRD00NDkzJk1TSVNETj05NjU1MDUwMjY4MiZPcGVyYXRvcklEPTQxOTA0JlBhc3N3b3JkPWt1d2FpdCU0MCUyMWRleCZQcmljZT01MCZSZXF1ZXN0SUQ9NzE5OTQxMTM5JlNUQVRVUz1SU0MtQkwmU2VydmljZUlEPTgwOCZVc2VyPWt1d2FpdCU0MGlkZXgiO31zOjk6Il9zZjJfbWV0YSI7YTozOntzOjE6InUiO2k6MTU3OTc2NzE4MztzOjE6ImMiO2k6MTU3OTc2NzE4MztzOjE6ImwiO3M6MToiMCI7fXM6NToiZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1579767183),
('f7bba8a37dfc224e67e8bb3d53973ed702cc5b86', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicFphN0p5UUxMcFFsTGI4dzJac29lTnZCb1A1Q1I4OUpGZjFOcUxpUSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHBzOi8vZmlsdGVycy5kaWdpem9uZS5jb20ua3cvdmlld1NuYXAyLzE1ODgvNDE2NzE2NiI7fXM6OToiX3NmMl9tZXRhIjthOjM6e3M6MToidSI7aToxNTc5NzY2NDE5O3M6MToiYyI7aToxNTc5NzY2NDE5O3M6MToibCI7czoxOiIwIjt9czo1OiJmbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1579766419),
('ea94752b7235d7efeff679497919a8039252f6af', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibzhaWTlabkJ4OWVRaEdPYVlpazhXVlFHcU0yNzFSRFZWV1pnbW56dSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjAxOiJodHRwczovL2ZpbHRlcnMuZGlnaXpvbmUuY29tLmt3L3ZpdmFfbm90aWZpY2F0aW9uP0NoYW5uZWxJRD00NDkzJk1TSVNETj05NjU1MTY3MzYzNiZPcGVyYXRvcklEPTQxOTA0JlBhc3N3b3JkPWt1d2FpdCU0MCUyMWRleCZQcmljZT01MCZSZXF1ZXN0SUQ9NzE5OTY3MjUyJlNUQVRVUz1SU0MtQkwmU2VydmljZUlEPTgwOCZVc2VyPWt1d2FpdCU0MGlkZXgiO31zOjk6Il9zZjJfbWV0YSI7YTozOntzOjE6InUiO2k6MTU3OTc2NjY1MTtzOjE6ImMiO2k6MTU3OTc2NjY1MTtzOjE6ImwiO3M6MToiMCI7fXM6NToiZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1579766651),
('4093b8f9487c020b98126b01320c4a7bcecc17c0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYWk3M1BFOGFlSWRKQTVaeFdTUk96SUROZTF5VkxQWEV4UkgwdVZieSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHBzOi8vZmlsdGVycy5kaWdpem9uZS5jb20ua3cvdmlld1NuYXAyLzE1ODgvNDE2NzE2NiI7fXM6OToiX3NmMl9tZXRhIjthOjM6e3M6MToidSI7aToxNTc5NzY2NDE4O3M6MToiYyI7aToxNTc5NzY2NDE4O3M6MToibCI7czoxOiIwIjt9czo1OiJmbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1579766418),
('3051a4e24bb6d164c79447c040e8e6fc093410f2', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVXFzYjZadjJuSlRjZ0ZPWUNHS1lOdmJCTVVzR0RBSHZYdDhmYlRweCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHBzOi8vZmlsdGVycy5kaWdpem9uZS5jb20ua3cvdmlld1NuYXAyLzE1ODgvODczODE5MCI7fXM6OToiX3NmMl9tZXRhIjthOjM6e3M6MToidSI7aToxNTc5NzY0ODk2O3M6MToiYyI7aToxNTc5NzY0ODk2O3M6MToibCI7czoxOiIwIjt9czo1OiJmbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1579764896),
('0ae50a9fbb19691afdb60f055f5601d4b3b6532e', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVjNsdVZ5SlpNZm5IeGRKaEV5SkZnbmpleEVxQ3IzVXNJcnpLbWRjYSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHBzOi8vZmlsdGVycy5kaWdpem9uZS5jb20ua3cvdmlld1NuYXAyLzE1ODgvODIyODE4OCI7fXM6OToiX3NmMl9tZXRhIjthOjM6e3M6MToidSI7aToxNTc5NzcxNDE3O3M6MToiYyI7aToxNTc5NzcxNDE3O3M6MToibCI7czoxOiIwIjt9czo1OiJmbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1579771417),
('b04e3f04c5a5cdd27e3b97cf14f1e931991be474', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiRVVlVDdVbnRtVVBmb1dJdmJ3ZFhhZTZYU3JZajl5dU4zckZYQ2dkYiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHBzOi8vZmlsdGVycy5kaWdpem9uZS5jb20ua3cvdmlld1NuYXAyLzE1ODgvODg2OTE3NCI7fXM6NToiZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6Mzg6ImxvZ2luXzgyZTVkMmM1NmJkZDA4MTEzMThmMGNmMDc4Yjc4YmZjIjtpOjE7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE1Nzk3NzE2ODM7czoxOiJjIjtpOjE1Nzk3NjU0Nzk7czoxOiJsIjtzOjE6IjAiO319', 1579771683),
('c46a13d4a7a0968b50d51acde1dc9e33f22793cb', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTGl6cWtyeEtoVjRLeDZZbnRmNlp4VGJGTE9UNVZvajZCSldpTk9rciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHBzOi8vZmlsdGVycy5kaWdpem9uZS5jb20ua3cvdmlld1NuYXAyLzE1ODgvODIyODE4OCI7fXM6OToiX3NmMl9tZXRhIjthOjM6e3M6MToidSI7aToxNTc5NzcxMDY3O3M6MToiYyI7aToxNTc5NzcxMDY3O3M6MToibCI7czoxOiIwIjt9czo1OiJmbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1579771067),
('81c42d38878f67e04a54cf120884ffafb94803e0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSDAyZ3dCTDVnM285d0NPazN2OHJMSkppWXdvRFVoVVpjYWhLWk9oYSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHBzOi8vZmlsdGVycy5kaWdpem9uZS5jb20ua3cvdmlld1NuYXAyLzE1ODgvODIyODE4OCI7fXM6OToiX3NmMl9tZXRhIjthOjM6e3M6MToidSI7aToxNTc5NzcxMTU1O3M6MToiYyI7aToxNTc5NzcxMTU1O3M6MToibCI7czoxOiIwIjt9czo1OiJmbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1579771155),
('7531735215a37cd6b8f7df9baad5a12cc59865e9', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWWJIeFdIaTdRNnRSNUwwYkRDOUFObzB6OVFlN2s4MjBTZzNLYzdDMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHBzOi8vZmlsdGVycy5kaWdpem9uZS5jb20ua3cvdmlld1NuYXAyLzE1ODcvODIyODE4OCI7fXM6OToiX3NmMl9tZXRhIjthOjM6e3M6MToidSI7aToxNTc5NzcxMTU1O3M6MToiYyI7aToxNTc5NzcxMTU1O3M6MToibCI7czoxOiIwIjt9czo1OiJmbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1579771155),
('c22d9255de4a0206a66e152caa3aea3e558aa08c', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidUoxWWdkVWpLODBNbDc3VG1qZHpOZjJjRllxcnROeU1qTUFpcjZaeiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHBzOi8vZmlsdGVycy5kaWdpem9uZS5jb20ua3cvdmlld1NuYXAyLzE1ODUvODIyODE4OCI7fXM6OToiX3NmMl9tZXRhIjthOjM6e3M6MToidSI7aToxNTc5NzcxMTU1O3M6MToiYyI7aToxNTc5NzcxMTU1O3M6MToibCI7czoxOiIwIjt9czo1OiJmbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1579771155),
('f748db269e145b156213d4d05edf5176579d58c2', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiM1FRcndJR0ZTc3Y5RzdkUEVnWTZWMDlFOE9YbXNxYnBoeHZFcHFlViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHBzOi8vZmlsdGVycy5kaWdpem9uZS5jb20ua3cvdmlld1NuYXAyLzE1ODgvODIyODE4OCI7fXM6OToiX3NmMl9tZXRhIjthOjM6e3M6MToidSI7aToxNTc5NzcxMDY3O3M6MToiYyI7aToxNTc5NzcxMDY3O3M6MToibCI7czoxOiIwIjt9czo1OiJmbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1579771067),
('123e57610d2cd2694ed636f0fa763ce8bbdbddbc', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNEV3cE9WaHgzSXVXb1hmcnNBVmNqczZjUkNQUFA0RUxPMHlaVk1xSCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHBzOi8vZmlsdGVycy5kaWdpem9uZS5jb20ua3cvdmlld1NuYXAyLzE1ODgvODIyODE4OCI7fXM6OToiX3NmMl9tZXRhIjthOjM6e3M6MToidSI7aToxNTc5NzcxMDU2O3M6MToiYyI7aToxNTc5NzcxMDU2O3M6MToibCI7czoxOiIwIjt9czo1OiJmbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1579771057),
('cbd122518cb02a0439b9a7c697921ea7411efda2', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYzlNNU8zUlhtdjZ2dGpRSWVWZlBLUUVxaUx1dHBBU0E3T2hVMUFRQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHBzOi8vZmlsdGVycy5kaWdpem9uZS5jb20ua3cvdmlld1NuYXAyLzE1ODgvODIyODE4OCI7fXM6OToiX3NmMl9tZXRhIjthOjM6e3M6MToidSI7aToxNTc5NzcxMDU3O3M6MToiYyI7aToxNTc5NzcxMDU3O3M6MToibCI7czoxOiIwIjt9czo1OiJmbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1579771058);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'pagination_limit', '10', '2018-12-09 11:45:42', '2018-12-12 07:49:04'),
(3, 'OperatorSnap_limit', '100', '2019-10-28 09:33:59', '2019-10-28 09:34:32'),
(4, 'OrderSnap_limit', '100', '2019-10-28 09:51:57', '2019-10-28 09:52:20'),
(6, 'enable_parent', '1', '2020-01-22 13:14:17', '2020-01-23 09:35:04'),
(8, 'only_favorites', '0', '2020-07-12 06:32:00', '2020-07-12 06:32:00');

-- --------------------------------------------------------

--
-- Table structure for table `static_bodies`
--

CREATE TABLE `static_bodies` (
  `id` int(10) UNSIGNED NOT NULL,
  `language_id` int(10) UNSIGNED NOT NULL,
  `static_translation_id` int(10) UNSIGNED NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `static_bodies`
--

INSERT INTO `static_bodies` (`id`, `language_id`, `static_translation_id`, `body`, `created_at`, `updated_at`) VALUES
(3, 1, 5, 'Search', '2019-11-19 08:27:50', '2019-11-19 08:27:50'),
(4, 2, 5, 'بحث', '2019-11-19 08:27:50', '2019-11-19 08:27:50'),
(5, 1, 6, 'Most popular', '2019-11-19 08:33:15', '2019-11-19 08:33:15'),
(6, 2, 6, 'الاكثر شيوعا', '2019-11-19 08:33:15', '2019-11-19 08:33:15'),
(7, 1, 7, 'Liked Filters', '2019-11-19 08:34:04', '2019-11-19 08:34:04'),
(8, 2, 7, 'فلاتر اعجبتك', '2019-11-19 08:34:04', '2019-11-19 08:34:04'),
(9, 1, 8, 'Most Popular 2', '2019-11-19 08:35:05', '2019-11-19 08:35:05'),
(10, 2, 8, 'الاكثر شيوعا 2', '2019-11-19 08:35:05', '2019-11-19 08:35:05'),
(11, 1, 9, 'Use Filter', '2019-11-19 08:39:39', '2019-11-19 08:39:39'),
(12, 2, 9, 'اسنخدم الفلتر', '2019-11-19 08:39:39', '2019-11-19 08:39:39'),
(13, 1, 10, 'Buy Tone', '2019-11-19 08:40:20', '2019-11-19 08:40:20'),
(14, 2, 10, 'شراء النغمة', '2019-11-19 08:40:20', '2019-11-19 08:40:20'),
(15, 1, 11, 'Close', '2019-11-19 08:40:45', '2019-11-19 08:40:45'),
(16, 2, 11, 'الرجوع', '2019-11-19 08:40:45', '2019-11-19 08:40:45'),
(19, 1, 13, 'Categories', '2019-11-19 08:44:21', '2019-11-19 08:44:21'),
(20, 2, 13, 'فئات', '2019-11-19 08:44:21', '2019-11-19 08:44:21'),
(21, 1, 14, 'Flatter', '2019-11-20 02:16:54', '2019-11-20 02:16:54'),
(22, 2, 14, 'فلاتر', '2019-11-20 02:16:54', '2019-11-20 02:16:54'),
(29, 1, 12, '<p>Today&#39;s Filter</p>\r\n', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 2, 12, '<p>فلتر&nbsp;اليوم</p>\r\n', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 1, 16, '<p>favourite</p>\r\n', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 2, 16, '<p>المفضلة</p>\r\n', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 1, 17, '<p>HOME</p>\r\n', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 2, 17, '<p>الرئيسية</p>\r\n', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 1, 18, 'share\r\n', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 2, 18, 'مشاركة\r\n', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 1, 15, '<p>categories</p>\r\n', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 2, 15, '<p>التصنيفات</p>\r\n', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 1, 4, '<p>Filters for you</p>\r\n', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 2, 4, '<p>فلاتر مقترحة لك</p>\r\n', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 2, 19, '<p>اختبار</p>', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 3, 19, '<p>test</p>', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `static_translations`
--

CREATE TABLE `static_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `key_word` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `static_translations`
--

INSERT INTO `static_translations` (`id`, `key_word`, `created_at`, `updated_at`) VALUES
(4, 'filter4you', '2019-11-19 08:25:30', '2019-11-19 08:25:30'),
(5, 'search', '2019-11-19 08:27:50', '2019-11-19 08:27:50'),
(6, 'mostp', '2019-11-19 08:33:15', '2019-11-19 08:33:15'),
(7, 'likedf', '2019-11-19 08:34:04', '2019-11-19 08:34:04'),
(8, 'mostp2', '2019-11-19 08:35:05', '2019-11-19 08:35:05'),
(9, 'usefilter', '2019-11-19 08:39:39', '2019-11-19 08:39:39'),
(10, 'buytone', '2019-11-19 08:40:20', '2019-11-19 08:40:20'),
(11, 'close', '2019-11-19 08:40:45', '2019-11-19 08:40:45'),
(12, 'todayfilter', '2019-11-19 08:43:02', '2019-11-19 08:43:02'),
(13, 'categ', '2019-11-19 08:44:21', '2019-11-19 08:44:21'),
(14, 'home', '2019-11-20 02:16:54', '2019-11-20 02:16:54'),
(15, 'tasnefat', '2019-12-05 03:42:07', '2019-12-05 03:42:07'),
(16, 'fav', '2019-12-05 03:43:37', '2019-12-05 03:43:37'),
(17, 'homee', '2019-12-05 03:44:43', '2019-12-05 03:44:43'),
(18, 'share', '2019-12-05 03:47:54', '2019-12-05 03:47:54');

-- --------------------------------------------------------

--
-- Table structure for table `tans_bodies`
--

CREATE TABLE `tans_bodies` (
  `id` int(10) UNSIGNED NOT NULL,
  `language_id` int(10) UNSIGNED NOT NULL,
  `translatable_id` int(10) UNSIGNED NOT NULL,
  `body` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tans_bodies`
--

INSERT INTO `tans_bodies` (`id`, `language_id`, `translatable_id`, `body`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 'test_occ', '2020-01-23 09:33:34', '2020-01-23 09:33:34'),
(2, 3, 2, 'noooooooo', '2020-01-23 09:34:16', '2020-01-23 09:34:16'),
(3, 3, 3, 'test_occas', '2020-01-23 09:40:30', '2020-01-23 09:40:30'),
(4, 3, 4, 'test23', '2020-01-23 09:41:16', '2020-01-23 09:41:16');

-- --------------------------------------------------------

--
-- Table structure for table `translatables`
--

CREATE TABLE `translatables` (
  `id` int(10) UNSIGNED NOT NULL,
  `table_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `record_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `column_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `translatables`
--

INSERT INTO `translatables` (`id`, `table_name`, `record_id`, `column_name`, `created_at`, `updated_at`) VALUES
(1, 'occasions', '105', 'title', '2020-01-23 09:33:34', '2020-01-23 09:33:34'),
(3, 'occasions', '106', 'title', '2020-01-23 09:40:30', '2020-01-23 09:40:30'),
(4, 'greetingimgs', '1600', 'title', '2020-01-23 09:41:16', '2020-01-23 09:41:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `admin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Emad mohamed', 'emad@ivas.com.eg', '$2y$10$VPlKhzpwaaGiBFQ5K1rj4.eqpdgl0cmUHEIUJGZFYfzfn1o6aHSCa', 1, 'fMrRhAXdRXHEAO9u4rwvpxuyPUbUgSIPm1B57QGunKOnN3nxkq70NNXLdNiU', '2015-09-08 09:24:49', '2019-12-09 12:57:29'),
(17, 'mada', 'mhamdy@ivas.com.eg', '$2y$10$VPlKhzpwaaGiBFQ5K1rj4.eqpdgl0cmUHEIUJGZFYfzfn1o6aHSCa', 1, 'cWUSfYzfIBN4oqkE1rgJoG2K7SgRjsEcWrF5aHrtw3YWlT3S3JZmczIlN2XI', '2018-10-03 12:16:26', '2019-12-02 06:17:49'),
(19, 'nermeen', 'nermeen.elsharkawy@ivas.com.eg', '$2y$10$OMD1omkTHM7Fhr76k3cFa./RJrCiqv6mBywYpJnF4/b05XlU9DQjC', 1, NULL, '2019-12-09 12:57:09', '2019-12-09 12:57:26'),
(20, 'test', 'test@ivas.com.eg', '$2y$10$VhY2BW2oQ2HNZ.iovCzpIOWwGeNdknTLAo9IPNZf4L5z67JHs75ES', 1, NULL, '2020-01-23 09:43:34', '2020-01-23 09:44:11'),
(21, 'test', 'ahmed333555777@gmail.com', '$2y$10$fbjiVV7jqFznnjsETIZssOdib5iX2r3Eg3wBia1rK5XP3O/GJbsP.', 1, NULL, '2020-01-27 05:58:09', '2020-01-27 05:58:09');

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
  ADD KEY `greetingimgs_rbt_id_index` (`rbt_id`),
  ADD KEY `greet_img_occas_fk1` (`occasion_id`);

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
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `rbt_codes_operator_id_foreign` (`operator_id`),
  ADD KEY `rbt_codes_audio_id_foreign` (`audio_id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `cproviders`
--
ALTER TABLE `cproviders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `du_integration`
--
ALTER TABLE `du_integration`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `generatedurls`
--
ALTER TABLE `generatedurls`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `greetingaudios`
--
ALTER TABLE `greetingaudios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `greetingimgs`
--
ALTER TABLE `greetingimgs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `greetingimg_operator`
--
ALTER TABLE `greetingimg_operator`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `msisdns`
--
ALTER TABLE `msisdns`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2100;

--
-- AUTO_INCREMENT for table `msisdn_greetingimgs`
--
ALTER TABLE `msisdn_greetingimgs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notify`
--
ALTER TABLE `notify`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28804;

--
-- AUTO_INCREMENT for table `occasions`
--
ALTER TABLE `occasions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `operators`
--
ALTER TABLE `operators`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `static_bodies`
--
ALTER TABLE `static_bodies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `static_translations`
--
ALTER TABLE `static_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tans_bodies`
--
ALTER TABLE `tans_bodies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `translatables`
--
ALTER TABLE `translatables`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `msisdns`
--
ALTER TABLE `msisdns`
  ADD CONSTRAINT `msisdns_ibfk_1` FOREIGN KEY (`ads_ur_id`) REFERENCES `advertising_urls` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `msisdns_ibfk_2` FOREIGN KEY (`ooredoo_notify_id`) REFERENCES `notify` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
