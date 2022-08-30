-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th7 07, 2022 lúc 09:38 PM
-- Phiên bản máy phục vụ: 10.3.35-MariaDB-log-cll-lve
-- Phiên bản PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `tshopdatvcom_taowebgame`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `band_ip`
--

CREATE TABLE `band_ip` (
  `id` int(11) NOT NULL,
  `ip_band` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `status` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `url_config` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `band_ip`
--

INSERT INTO `band_ip` (`id`, `ip_band`, `status`, `url_config`) VALUES
(10, '127.0.0', 'block', 'LIKESUB.TAIMMO.NET');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bank`
--

CREATE TABLE `bank` (
  `id` int(11) NOT NULL,
  `id_xep` int(11) DEFAULT NULL,
  `namectk` text CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `namestk` text CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `img` text CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `url_config` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `bank`
--

INSERT INTO `bank` (`id`, `id_xep`, `namectk`, `namestk`, `img`, `status`, `url_config`) VALUES
(12, 10000, 'Phạm Thị Thắm', '0858140439', 'https://upanh.cf/y4r0ynzbni.png', 1, 'AUTOTUONGTAC.SITE'),
(13, 10000, 'LE TUAN TAI', '24200618066666', 'https://subgiare.vn/assets/images/mbb.png', 1, 'LOCALHOST'),
(14, 10000, 'Lê Tuấn Tài', '0398206564', 'https://subgiare.vn/assets/images/momo.png', 1, 'LOCALHOST'),
(17, 10000, 'Lê VănLập', '0392683381', 'https://subgiare.vn/assets/images/momo.png', 1, 'LIKESUB.TAIMMO.NET'),
(18, 5000, 'LE TUAN TAI', '24200618066666', 'https://subgiare.vn/assets/images/mbb.png', 1, 'LIKESUB.TAIMMO.NET');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cron_momo`
--

CREATE TABLE `cron_momo` (
  `id` int(11) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `password` varchar(6) DEFAULT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `imei` varchar(100) DEFAULT NULL,
  `AAID` varchar(100) DEFAULT NULL,
  `TOKEN` varchar(300) DEFAULT NULL,
  `ohash` varchar(100) DEFAULT NULL,
  `SECUREID` varchar(100) DEFAULT NULL,
  `rkey` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `rowCardId` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `authorization` varchar(2000) NOT NULL DEFAULT 'undefined',
  `agent_id` varchar(100) NOT NULL DEFAULT 'undefined',
  `setupKeyDecrypt` varchar(150) DEFAULT NULL,
  `setupKey` varchar(200) DEFAULT NULL,
  `sessionkey` varchar(150) DEFAULT ' ',
  `RSA_PUBLIC_KEY` text DEFAULT NULL,
  `REFRESH_TOKEN` text DEFAULT NULL,
  `BALANCE` int(11) DEFAULT NULL,
  `device` varchar(50) DEFAULT NULL,
  `hardware` varchar(50) DEFAULT NULL,
  `facture` varchar(50) DEFAULT NULL,
  `MODELID` varchar(100) DEFAULT NULL,
  `sitename` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `cron_momo`
--

INSERT INTO `cron_momo` (`id`, `phone`, `password`, `Name`, `imei`, `AAID`, `TOKEN`, `ohash`, `SECUREID`, `rkey`, `rowCardId`, `authorization`, `agent_id`, `setupKeyDecrypt`, `setupKey`, `sessionkey`, `RSA_PUBLIC_KEY`, `REFRESH_TOKEN`, `BALANCE`, `device`, `hardware`, `facture`, `MODELID`, `sitename`) VALUES
(10, '0392683381', '180606', '', '474e214c-56e5-764a-125d-01ce61d33a2e', '0e8cb9a5-32a4-e00e-c16e-dd288b41e696', 'chGGnTUR5CBr8eUoaE1iri:QpMM9heEo-fJstO3YUHKDMrWSvYxLt-DNQAjcvlseYT-C1E1CuM-z9UsJYG-nwhSgem8lwYWOrqsdS8Ca2CoBJiibPo4STcH6G1uQPCTYuOszLjDt-ZoKENVIog_9rWFoV0aJYo-JJys', '893a6121ad5e88379cece4c69f5f3cbb0fb34137604cee678baac1561798390b', 'ce2b57bd256495791', 'c5QIYuqNJEbieCHrEoZS', NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJ1c2VyIjoiMDE2OTI2ODMzODEiLCJpbWVpIjoiNDc0ZTIxNGMtNTZlNS03NjRhLTEyNWQtMDFjZTYxZDMzYTJlIiwiQkFOS19DT0RFIjoiMCIsIkJBTktfTkFNRSI6IiIsIk1BUF9TQUNPTV9DQVJEIjowLCJOQU1FIjoiTMOKIFbEgk4gTOG6rFAiLCJJREVOVElGWSI6IkNPTkZJUk0iLCJERVZJQ0VfT1MiOiJBbmRyb2lkIiwiQVBQX1ZFUiI6MzExMTAsImFnZW50X2lkIjo1OTExMTkyNCwic2Vzc2lvbktleSI6IlhUcFY5Sm9yVWc1ZEh5SDM3cUJMT1B6RmhNRkxVblJBUUozYjRvVWIrbVV3akdxYStNaVZ6Zz09IiwiTkVXX0xPR0lOIjp0cnVlLCJwaW4iOiJMN051TXYxR2ZpQT0iLCJpc1Nob3AiOmZhbHNlLCJyZWZyZXNoVG9rZW5JZCI6Ijk3ZmUyZGU5LTI0OGMtNDcxNy1iYjUwLTM5ZmNhYjZjZTNjNSIsInVzZXJfdHlwZSI6MCwiZXhwIjoxNjU1MDE1NDEwfQ.hvrUcz9paC0fgWI6InP3NqE_yb0bqirvczPVjrsh9hmCE-tBJGsOQ1ryfDtIzXtl1qt5JwUjiVCei8KTcXkCtYzkOeCvMtN1HcPbhGb12HE26rCUNABPtXVpNsTkUT4llcIKf3uw8g7wog8OSZ9xQkb3R7d8Z4lsJJQQEuEQmoo7bxJ6ZHo-v1sVaHJ6V6NyF8mBmEgxfvBRn6dOv3sixMqj7kWRpunmky6QlAvmGp_0zCi7ch8k6QKFZHa1TaG2Ktq3O8dOhlBymJ9XWuqnKwMcplaI0djGwctf9rNyAISSa2SFCoGVBoZ4drp1U0_loWy8GEz9gKhOLxRqbiRR_g', '59111924', 'b8ba4981-1da7-4338-b221-f10294d2dfc0', 'zIgW5JQG1x70nIDYZm75ZfDng8NDkOjzRMh9NK4MrGaVOeNjcT11RYhFqJbey6R1', '27ab51c1-67ba-42f0-ad45-4897f1d40fbd', '-----BEGIN RSA PUBLIC KEY-----\nMEgCQQDjtTNZJnbMWXON/mhhLzENzQW8TOH/gaOZ72u6FEzfjyWSfGsP6/rMIVjY\n2w44ZyqNG2p45PGmp3Y8bquPAQGnAgMBAAE=\n-----END RSA PUBLIC KEY-----\n', '2HFL4i/ymDC98CrQGKChKfRqTFQwewcEUZd9VqEvMZGnnMSJHVJHjrUaerbAPuTWmmZliAZ5+/y/qgdR/ilNyanxUmAt/fhH414Dv87CzLZqjLqXTCQbqPJcLpyJjX+AH2awusQDozz5du+/rYhqeQtoXQjVZdVm44eHPNqYwd6fV6hUX2V0PV5bVSh57pkX0dbUlucaH3mRTW8HdoxkynAbAkiJXfY5zlZc1ut8D1qwY15uVC4DKrXE9tW8b0IgyYdSEMSFZKscL9WF3wUr42OiOghmDaplBqipkWksBc84TweKoYZJVj4/xunTSpWhqI4d/2cK+/aXub7u+eL7+Ev+e3U2H1+P7xHF7qysmgYjmrb7iBKUytUQSzLCf+BHqgMsqVTIp4hJJW5zTTuZ9Td7eOjUz51HjLJK4JZQOdPizuDp/l3KQ11JMA3u49ZeP6X5szqPdVBqs7SPBQlBxHQZqpJHtyM49tLqCN82hFWpyygi5mUfz3WrTNcMP6dZzhv8mY0Fya67aJKvr640XAxCokkRRq6+t/s0mLu5MSF1zAZKL8Nkis2HSxkVP69lu7epFr/ZV0iDPIQVvRf4WL1HBdQZCu7VHGmP5yqmxJHCDOlxK6ec5rxJmE4VToQK60vi3WdDlP4=', 33802, 'SM-A102U', 'a10e', 'Samsung', 'Samsung SM-A102U', 'LIKESUB.TAIMMO.NET');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `device`
--

CREATE TABLE `device` (
  `id` int(11) NOT NULL,
  `device` varchar(50) DEFAULT NULL,
  `hardware` varchar(50) DEFAULT NULL,
  `facture` varchar(50) DEFAULT NULL,
  `MODELID` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `device`
--

INSERT INTO `device` (`id`, `device`, `hardware`, `facture`, `MODELID`) VALUES
(1, 'SM-G532F', 'mt6735', 'samsung', 'samsung sm-g532gmt6735r58j8671gsw'),
(3, 'SM-A102U', 'a10e', 'Samsung', 'Samsung SM-A102U'),
(4, 'SM-A305FN', 'a30', 'Samsung', 'Samsung SM-A305FN'),
(5, 'HTC One X9 dual sim', 'htc_e56ml_dtul', 'HTC', 'HTC One X9 dual sim'),
(6, 'HTC 7060', 'cp5dug', 'HTC', 'HTC HTC_7060'),
(7, 'HTC D10w', 'htc_a56dj_pro_dtwl', 'HTC', 'HTC htc_a56dj_pro_dtwl'),
(8, 'Oppo realme X Lite', 'RMX1851CN', 'Oppo', 'Oppo RMX1851'),
(9, 'MI 9', 'equuleus', 'Xiaomi', 'Xiaomi equuleus');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ds_sitecon`
--

CREATE TABLE `ds_sitecon` (
  `id_site` int(11) NOT NULL,
  `username` varchar(999) NOT NULL,
  `domain` varchar(999) NOT NULL,
  `token` varchar(999) DEFAULT NULL,
  `ip` varchar(999) NOT NULL,
  `date` varchar(999) NOT NULL,
  `site_me` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `site_con` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `url_config` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `status` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `ds_sitecon`
--

INSERT INTO `ds_sitecon` (`id_site`, `username`, `domain`, `token`, `ip`, `date`, `site_me`, `site_con`, `url_config`, `status`) VALUES
(8, 'taile2k6', 'taile.cf', 'eyJhbGciOOnUToWxRjKaiTUWnlTDrIEPgZOsejgcuFmMPkbXjvxpOUmWcHhkjRfbYGSANYzmLThPIvcIgxxJtCBdEYUVwynQWQIkhqPmYbgzO1655015026MjM3MjQ2MWI4NjQ4MTlkOGIyNjQ2NThjODRiNzMyYjU==', '162.158.178.88', '2022-06-12 18:05:38', 'LIKESUB.TAIMMO.NET', 'TAILE.CF', 'LIKESUB.TAIMMO.NET', 'Active'),
(9, 'adminweb', 'taimmo.net', 'eyJhbGciOrmcPPcjlwbjQEUQQJBgjOxnamTqHtPKnTczSYLOzphPWIdxXTnnclOVWRlmkNgUlhAIoDjuIERQGYxishWbkZyOkvbkCfexTFYRM1656414273ZjdhYjNkMjE2Y2M5NTFmNmFlYmU5MDQyMmQ2NDc1NjA==', '::1', '2022-06-28 07:43:11', 'LOCALHOST', 'TAIMMO.NET', 'LOCALHOST', 'Active'),
(10, 'adminweb', 'sellxu365.com', 'eyJhbGciOrmcPPcjlwbjQEUQQJBgjOxnamTqHtPKnTczSYLOzphPWIdxXTnnclOVWRlmkNgUlhAIoDjuIERQGYxishWbkZyOkvbkCfexTFYRM1656414273ZjdhYjNkMjE2Y2M5NTFmNmFlYmU5MDQyMmQ2NDc1NjA==', '::1', '2022-06-28 18:05:22', 'LOCALHOST', 'SELLXU365.COM', 'LOCALHOST', 'Active');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `history_buy`
--

CREATE TABLE `history_buy` (
  `id` int(11) NOT NULL,
  `username` varchar(999) NOT NULL,
  `type` varchar(999) DEFAULT NULL,
  `hinh_thuc` varchar(999) DEFAULT NULL,
  `soluong` varchar(999) DEFAULT NULL,
  `number_star` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `number_end` int(255) NOT NULL,
  `buff` int(11) DEFAULT NULL,
  `time_buy` int(255) NOT NULL,
  `tong_tien` varchar(999) DEFAULT NULL,
  `link_buy` varchar(999) DEFAULT NULL,
  `server_buy` varchar(999) DEFAULT NULL,
  `list_msg` text CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `ghichu` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `status` varchar(999) DEFAULT NULL,
  `ma_gd` varchar(999) DEFAULT NULL,
  `date` varchar(999) DEFAULT NULL,
  `url_config` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `history_buy`
--

INSERT INTO `history_buy` (`id`, `username`, `type`, `hinh_thuc`, `soluong`, `number_star`, `number_end`, `buff`, `time_buy`, `tong_tien`, `link_buy`, `server_buy`, `list_msg`, `ghichu`, `status`, `ma_gd`, `date`, `url_config`) VALUES
(10, 'adminne', 'like_post_sale', 'Login Website', '100', '43678', 100, NULL, 0, '400', 'https://www.facebook.com/taile.official.2006/posts/546559036905538', '1', '', '', 'Success', 'FbLikePostSale_JO4HK220B6D3', '2022-06-11 14:56:28', 'LIKESUB.TAIMMO.NET'),
(11, 'adminne', 'sub_vip', 'Login Website', '5000', '146055', 5000, NULL, 0, '10000', '100046543398712', '4', '', '', 'Success', 'FbSubVip_LRSZ9BWA2YOK', '2022-06-11 15:08:36', 'LIKESUB.TAIMMO.NET'),
(12, 'adminweb', 'like_post_sale', 'Login Website', '100', '43778', 100, NULL, 0, '400', 'https://www.facebook.com/taile.official.2006/posts/546559036905538', '1', '', '', 'Success', 'FbLikePostSale_BCUDY6RSBGBI', '2022-06-11 15:13:58', 'LIKESUB.TAIMMO.NET'),
(13, 'adminweb', 'sub_vip', 'Login Website', '1000', '151055', 1002, NULL, 0, '3000', '100046543398712', '3', '', '', 'Success', 'FbSubVip_UM72B6OJRPIN', '2022-06-11 15:27:48', 'LOCALHOST'),
(14, 'adminweb', 'sub_vip', 'Login Website', '10000', '152057', 10027, NULL, 0, '30000', '100046543398712', '3', '', 'Test sub auto', 'Success', 'FbSubVip_B5AHM39DU3ST', '2022-06-11 15:32:52', 'LOCALHOST'),
(15, 'adminweb', 'sub_vip', 'Login Website', '10000', '162083', 10000, NULL, 0, '30000', '100046543398712', '3', '', '', 'Success', 'FbSubVip_HN02TW342P8L', '2022-06-12 08:03:07', 'LOCALHOST'),
(16, 'adminweb', 'sub_vip', 'Login Website', '1000', '172083', 1002, NULL, 0, '3000', '100046543398712', '3', '', '', 'Success', 'FbSubVip_SYBORBXC5WFG', '2022-06-12 12:37:10', 'LOCALHOST'),
(17, 'adminweb', 'sub_vip', 'Login Website', '5000', '173085', 5000, NULL, 0, '15000', '100046543398712', '3', '', '', 'Success', 'FbSubVip_V0EFHD7FOZHZ', '2022-06-12 13:02:08', 'LOCALHOST'),
(18, 'adminweb', 'like_post_sale', 'Login Website', '1000', '0', 1000, NULL, 0, '4000', 'https://www.facebook.com/taile.official.2006/posts/546559036905538', '9', '', '', 'Success', 'FbLikePostSale_CPGDE7S6AJ5P', '2022-06-28 14:15:53', 'LOCALHOST'),
(19, 'adminweb', 'like_post_sale', 'Login Website', '100', '0', 100, NULL, 0, '400', 'https://www.facebook.com/taile.official.2006/posts/546559036905538', '9', '', '', 'Success', 'FbLikePostSale_WB3HC3YOV5D6', '2022-06-28 18:05:45', 'LOCALHOST'),
(20, 'adminweb', 'sub_vip', 'Login Website', '1000', '206144', 1000, NULL, 0, '2000', '100046543398712', '1', '', 'test nè', 'Success', 'FbSubVip_CBXVB733Z4C0', '2022-06-29 06:56:37', 'LOCALHOST'),
(21, 'adminweb', 'like_post', 'Login Website', '100', '89', 0, NULL, 0, '300', '572516867643088', '9', '', '', 'Start', 'FbLikePostSpeed_MVNUSHVT3I93', '2022-06-29 09:07:23', 'LOCALHOST'),
(22, 'adminweb', 'like_post_sale', 'Login Website', '100', '0', 0, NULL, 0, '400', 'https://www.facebook.com/taile.official.2006/posts/546559036905538', '9', '', '', 'Start', 'FbLikePostSale_7P8N71XKKOFP', '2022-06-29 10:45:06', 'LOCALHOST'),
(23, 'adminweb', 'sub_vip', 'Login Website', '5000', '207142', 5000, NULL, 0, '4900', '100046543398712', '4', '', '', 'Success', 'FbSubVip_M84KMYLDWFVJ', '2022-06-29 16:09:04', 'LOCALHOST'),
(24, 'adminweb', 'sub_vip', 'Login Website', '5000', '212142', 5000, NULL, 0, '4900', '100046543398712', '4', '', '', 'Success', 'FbSubVip_U0EWMZTNM3OV', '2022-06-29 16:14:43', 'LOCALHOST'),
(25, 'adminweb', 'sub_vip', 'Login Website', '5000', '217142', 0, NULL, 0, '4900', '100046543398712', '4', '', 'abc', 'Start', 'FbSubVip_IUNKRLJI3MZ4', '2022-06-29 16:16:12', 'LOCALHOST');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `history_naptien`
--

CREATE TABLE `history_naptien` (
  `id` int(11) NOT NULL,
  `type` varchar(999) NOT NULL,
  `username` varchar(999) NOT NULL,
  `loaithe` varchar(999) DEFAULT NULL,
  `menhgia` varchar(999) NOT NULL,
  `sothe` varchar(999) DEFAULT NULL,
  `soseri` varchar(999) DEFAULT NULL,
  `thucnhan` varchar(999) DEFAULT NULL,
  `trangthai` varchar(999) NOT NULL,
  `date` varchar(999) DEFAULT NULL,
  `namemomo` text CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `phonemomo` varchar(999) DEFAULT NULL,
  `tranid` varchar(999) DEFAULT NULL,
  `url_config` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `history_naptien`
--

INSERT INTO `history_naptien` (`id`, `type`, `username`, `loaithe`, `menhgia`, `sothe`, `soseri`, `thucnhan`, `trangthai`, `date`, `namemomo`, `phonemomo`, `tranid`, `url_config`) VALUES
(7, 'napthe', 'demo_code', 'VIETTEL', '10000', '011040706499321', '10008579549663', '0', '0', '1652948655', NULL, NULL, '307588992', 'AUTOVIET.PRO'),
(8, 'napthe', 'demo_code', 'VIETTEL', '20000', '011040706499323', '10008579549663', '0', '1', '1652949106', NULL, NULL, '405400100', 'AUTOVIET.PRO'),
(9, 'napthe', 'demo_code', 'VIETTEL', '20000', '011040706499322', '10008579549665', '0', '2', '1652949486', NULL, NULL, '889062107', 'AUTOVIET.PRO'),
(10, 'napthe', 'thanhvucoder', 'VIETTEL', '10000', '664646446644777', '10000004777777', '0', '2', '2022-06-05 10:41:39', NULL, NULL, '136134356', 'AUTOTUONGTAC.SITE'),
(11, 'napthe', 'thanhvucoder', 'VIETTEL', '10000', '516167293839397', '10008855121774', '7500', '1', '2022-06-05 10:43:29', NULL, NULL, '799218392', 'AUTOTUONGTAC.SITE'),
(12, 'Bank', 'adminne', 'momoauto', '10000', 'momoauto', 'momoauto', '10000', '1', '2022-06-12 12:00:12', NULL, NULL, '25030877625', 'LIKESUB.TAIMMO.NET'),
(14, 'Bank', 'adminne', 'Mbbank Auto', '10000', 'Mbbank Auto', 'Mbbank auto', '10000', '1', '2022-06-12 12:14:05', NULL, NULL, 'FT22164085763357', 'LIKESUB.TAIMMO.NET'),
(15, 'napthe', 'adminweb', 'VIETTEL', '10000', '1687237162323', '12635123782687', '0', '0', '2022-06-28 06:52:04', NULL, NULL, '629042136', 'LOCALHOST'),
(16, 'napthe', 'adminweb', 'VIETTEL', '20000', '1231241331241', '12312312314213', '0', '0', '2022-06-28 16:00:55', NULL, NULL, '266640918', 'LOCALHOST'),
(17, 'napthe', 'adminweb', 'VIETTEL', '20000', '2313716273781', '6562536152713', '0', '0', '2022-06-28 18:05:05', NULL, NULL, '213473522', 'LOCALHOST');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `list_api`
--

CREATE TABLE `list_api` (
  `id` int(11) NOT NULL,
  `username` varchar(999) DEFAULT NULL,
  `token` varchar(999) DEFAULT NULL,
  `date` varchar(999) DEFAULT NULL,
  `url_config` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `name_api` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `link_callback` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `status` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `list_hotro`
--

CREATE TABLE `list_hotro` (
  `id` int(11) NOT NULL,
  `username` varchar(999) DEFAULT NULL,
  `loai_hotro` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `tieu_de_hotro` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `id_hotro` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `date` varchar(999) DEFAULT NULL,
  `url_config` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `noi_dung_hotro` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `noi_dung_xuly` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `status` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `log_site`
--

CREATE TABLE `log_site` (
  `id` int(11) NOT NULL,
  `username` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `note` text CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `ip` varchar(999) DEFAULT NULL,
  `date` varchar(999) DEFAULT NULL,
  `url_config` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `log_site`
--

INSERT INTO `log_site` (`id`, `username`, `note`, `ip`, `date`, `url_config`) VALUES
(1, 'nhquang', 'Đăng kí tài khoản', '171.229.69.204', '2022-05-12 19:46:19', 'AUTOVIET.PRO'),
(2, 'nhquang', '', '171.229.69.204', '2022-05-12 19:52:30', 'AUTOVIET.PRO'),
(3, 'Ltt009', 'Đăng kí tài khoản', '123.19.208.221', '2022-05-12 20:36:20', 'AUTOVIET.PRO'),
(4, 'anhtugood', 'Đăng kí tài khoản', '171.247.153.2', '2022-05-13 11:08:02', 'AUTOVIET.PRO'),
(5, 'Buliem123', 'Đăng kí tài khoản', '1.52.248.223', '2022-05-13 11:08:28', 'AUTOVIET.PRO'),
(6, 'Nhannhan', 'Đăng kí tài khoản', '171.234.11.197', '2022-05-13 13:07:31', 'AUTOVIET.PRO'),
(7, 'okvnss', 'Đăng kí tài khoản', '113.186.56.130', '2022-05-13 15:06:19', 'AUTOVIET.PRO'),
(8, 'nddcoder', 'Đăng kí tài khoản', '117.6.169.13', '2022-05-13 15:46:02', 'AUTOVIET.PRO'),
(9, 'Vanlam123', 'Đăng kí tài khoản', '113.178.218.253', '2022-05-13 17:34:08', 'AUTOVIET.PRO'),
(10, 'xuandung19049x', 'Đăng kí tài khoản', '117.7.100.21', '2022-05-13 19:49:46', 'AUTOVIET.PRO'),
(11, '000999', 'Đăng kí tài khoản', '113.189.13.145', '2022-05-13 21:00:08', 'AUTOVIET.PRO'),
(12, 'giahungg', 'Đăng kí tài khoản', '116.111.155.53', '2022-05-14 05:59:05', 'AUTOVIET.PRO'),
(13, 'giahungg', '', '116.111.155.53', '2022-05-14 05:59:32', 'AUTOVIET.PRO'),
(14, 'Concac3007', 'Đăng kí tài khoản', '14.236.213.50', '2022-05-14 20:50:46', 'AUTOVIET.PRO'),
(15, 'manh0044', 'Đăng kí tài khoản', '116.104.63.47', '2022-05-14 23:36:11', 'AUTOVIET.PRO'),
(16, 'vuongtu123', 'Đăng kí tài khoản', '171.245.231.253', '2022-05-15 12:09:53', 'AUTOVIET.PRO'),
(17, 'nhquang', 'Đăng kí tài khoản', '27.78.5.71', '2022-05-15 21:05:47', 'AUTOVIET.PRO'),
(18, 'Hobaphuoc', 'Đăng kí tài khoản', '59.153.233.74', '2022-05-16 06:09:13', 'AUTOVIET.PRO'),
(19, 'admin123', 'Đăng kí tài khoản', '14.230.170.35', '2022-05-16 09:18:54', 'AUTOVIET.PRO'),
(20, 'nhquang', 'Đăng kí tài khoản', '171.255.69.175', '2022-05-16 11:50:56', 'AUTOVIET.PRO'),
(21, 'nhquang', '', '171.255.69.175', '2022-05-16 12:06:12', 'AUTOVIET.PRO'),
(22, 'admin999', 'Đăng kí tài khoản', '27.68.156.101', '2022-05-16 19:11:51', 'AUTOVIET.PRO'),
(23, 'thanhvucoder', 'Đăng kí tài khoản', '113.188.42.246', '2022-05-16 19:22:31', 'AUTOVIET.PRO'),
(24, 'demo_code', 'Đăng kí tài khoản', '125.235.14.144', '2022-05-16 19:36:11', 'AUTOVIET.PRO'),
(25, 'Abcd1234', 'Đăng kí tài khoản', '14.247.98.199', '2022-05-16 19:43:58', 'AUTOVIET.PRO'),
(26, 'demo_code', '', '171.255.70.197', '2022-05-16 20:01:22', 'AUTOVIET.PRO'),
(27, 'anhtugood', 'Đăng kí tài khoản', '125.235.209.11', '2022-05-16 23:22:25', 'AUTOVIET.PRO'),
(28, 'thanhvucoder', 'Đăng kí tài khoản', '113.188.42.246', '2022-05-16 23:26:33', 'AUTOVIET.PRO'),
(29, 'ngothanhdoan', 'Đăng kí tài khoản', '59.153.243.67', '2022-05-17 12:08:03', 'AUTOVIET.PRO'),
(30, 'Admin2002', 'Đăng kí tài khoản', '171.236.209.118', '2022-05-18 00:46:37', 'AUTOVIET.PRO'),
(31, 'demo_code', ' Đã Tạo Giao Dịch sub-vip Với Số Tiền 6000', '171.229.72.122', '2022-05-18 11:40:22', 'AUTOVIET.PRO'),
(32, 'hjgjhjk', 'Đăng kí tài khoản', '123.19.208.221', '2022-05-18 15:18:34', 'AUTOVIET.PRO'),
(33, 'tovankhuong', 'Đăng kí tài khoản', '171.232.62.117', '2022-05-18 19:51:02', 'AUTOVIET.PRO'),
(34, 'demo_code', ' Đã Tạo Giao Dịch sub-speed Với Số Tiền 3500', '171.229.85.87', '2022-05-19 15:07:56', 'AUTOVIET.PRO'),
(35, 'demo_code', 'Vừa nạp thẻ VIETTEL với mệnh giá  vào lúc 2022-05-19 15:24:15', '171.229.85.87', '2022-05-19 15:24:15', 'AUTOVIET.PRO'),
(36, 'demo_code', 'Vừa nạp thẻ VIETTEL với mệnh giá  vào lúc 2022-05-19 15:31:46', '171.229.85.87', '2022-05-19 15:31:46', 'AUTOVIET.PRO'),
(37, 'demo_code', 'Vừa nạp thẻ VIETTEL với mệnh giá  vào lúc 2022-05-19 15:38:06', '171.229.85.87', '2022-05-19 15:38:06', 'AUTOVIET.PRO'),
(38, 'hoadz99', 'Đăng kí tài khoản', '115.75.34.237', '2022-05-19 16:12:53', 'AUTOVIET.PRO'),
(39, 'Nhan77', 'Đăng kí tài khoản', '171.234.10.96', '2022-05-19 16:16:32', 'AUTOVIET.PRO'),
(40, 'adminbinh', 'Đăng kí tài khoản', '171.251.236.64', '2022-05-19 16:44:44', 'AUTOVIET.PRO'),
(41, 'dothevi', 'Đăng kí tài khoản', '117.5.147.220', '2022-05-19 18:14:41', 'AUTOVIET.PRO'),
(42, 'kienvu', 'Đăng kí tài khoản', '14.175.32.201', '2022-05-19 23:05:43', 'AUTOVIET.PRO'),
(43, 'Nqa2007', 'Đăng kí tài khoản', '171.234.9.177', '2022-05-21 06:31:13', 'AUTOVIET.PRO'),
(44, 'Binhpudz', 'Đăng kí tài khoản', '27.68.136.97', '2022-05-21 12:20:54', 'AUTOVIET.PRO'),
(45, 'Ppp111', 'Đăng kí tài khoản', '27.67.73.238', '2022-05-21 13:52:08', 'AUTOVIET.PRO'),
(46, 'okvnss', 'Đăng kí tài khoản', '125.212.156.37', '2022-05-23 12:59:19', 'AUTOVIET.PRO'),
(47, 'bjhfghjhj', 'Đăng kí tài khoản', '123.19.208.221', '2022-05-23 18:56:01', 'AUTOVIET.PRO'),
(48, 'harune1120', 'Đăng kí tài khoản', '42.118.2.57', '2022-05-23 21:09:33', 'AUTOVIET.PRO'),
(49, 'TKtiendezet', 'Đăng kí tài khoản', '14.191.24.105', '2022-06-04 13:29:54', 'TRUMSUBRE.COM'),
(50, 'duynam244', 'Đăng kí tài khoản', '14.190.80.21', '2022-06-04 13:31:04', 'TRUMSUBRE.COM'),
(51, 'nvn32vip', 'Đăng kí tài khoản', '125.212.159.141', '2022-06-04 13:32:48', 'TRUMSUBRE.COM'),
(52, 'Luuhamancute', 'Đăng kí tài khoản', '113.187.166.194', '2022-06-04 13:32:54', 'TRUMSUBRE.COM'),
(53, 'anhviet2607', 'Đăng kí tài khoản', '1.53.198.159', '2022-06-04 13:33:32', 'TRUMSUBRE.COM'),
(54, 'adminbinh', 'Đăng kí tài khoản', '171.251.237.12', '2022-06-04 13:33:53', 'TRUMSUBRE.COM'),
(55, 'Levanquan2927', 'Đăng kí tài khoản', '171.237.155.128', '2022-06-04 13:35:24', 'TRUMSUBRE.COM'),
(56, 'admin123', 'Đăng kí tài khoản', '113.166.248.95', '2022-06-04 13:36:43', 'TRUMSUBRE.COM'),
(57, 'nhanvu147', 'Đăng kí tài khoản', '113.170.208.180', '2022-06-04 13:45:27', 'TRUMSUBRE.COM'),
(58, 'dung25102000444', 'Đăng kí tài khoản', '113.179.216.3', '2022-06-04 13:48:29', 'TRUMSUBRE.COM'),
(59, 'nqt1111', 'Đăng kí tài khoản', '42.1.70.141', '2022-06-04 13:49:51', 'TRUMSUBRE.COM'),
(60, 'lamthanhdat213', 'Đăng kí tài khoản', '14.250.4.204', '2022-06-04 13:56:47', 'TRUMSUBRE.COM'),
(61, 'TrieuVyahiicuto', 'Đăng kí tài khoản', '116.96.77.92', '2022-06-04 13:57:37', 'TRUMSUBRE.COM'),
(62, 'thanhvucoder', 'Đăng kí tài khoản', '103.180.149.88', '2022-06-04 18:04:24', 'AUTOTUONGTAC.SITE'),
(63, 'thanhvucoder', '', '103.180.149.88', '2022-06-04 18:15:36', 'AUTOTUONGTAC.SITE'),
(64, 'hello123', 'Đăng kí tài khoản', '2402:800:61a4:a38f::6', '2022-06-04 18:23:36', 'AUTOTUONGTAC.SITE'),
(65, 'bhdtbgaming12', 'Đăng kí tài khoản', '42.118.34.232', '2022-06-05 09:30:53', 'AUTOTUONGTAC.SITE'),
(66, 'thiendz', 'Đăng kí tài khoản', '113.183.247.47', '2022-06-05 09:32:51', 'AUTOTUONGTAC.SITE'),
(67, 'thanhvucoder', ' Đã Tạo Giao Dịch sub-vip Với Số Tiền 500000', '103.82.27.174', '2022-06-05 10:23:57', 'AUTOTUONGTAC.SITE'),
(68, 'thanhvucoder', 'Đăng kí website con', '103.82.27.174', '2022-06-05 10:24:20', 'AUTOTUONGTAC.SITE'),
(69, 'Thanhvucoder', '', '103.82.27.174', '2022-06-05 10:29:55', 'SHOPCHIENTUONG.FUN'),
(70, 'thanhvucoder', ' Đã Tạo Giao Dịch sub-vip Với Số Tiền 500', '103.82.27.174', '2022-06-05 10:31:28', 'SHOPCHIENTUONG.FUN'),
(71, 'thanhvucoder', ' Đã Tạo Giao Dịch sub-vip Với Số Tiền 500', '103.82.27.174', '2022-06-05 10:31:28', 'AUTOTUONGTAC.SITE'),
(72, 'thanhvucoder', ' Vừa nạp thẻ VIETTEL với mệnh giá  vào lúc 2022-06-05 10:41:39', '103.82.27.174', '2022-06-05 10:41:39', 'AUTOTUONGTAC.SITE'),
(73, 'thanhvucoder', ' Vừa nạp thẻ VIETTEL với mệnh giá  vào lúc 2022-06-05 10:43:29', '103.82.27.174', '2022-06-05 10:43:29', 'AUTOTUONGTAC.SITE'),
(74, 'adminweb', 'Đăng kí tài khoản', '::1', '2022-06-10 09:46:53', 'LOCALHOST'),
(75, 'adminne', 'Đăng kí tài khoản', '172.68.254.42', '2022-06-10 23:33:05', 'LIKESUB.TAIMMO.NET'),
(76, 'BaoDepTraiCuToVl', 'Đăng kí tài khoản', '162.158.179.241', '2022-06-10 23:41:09', 'LIKESUB.TAIMMO.NET'),
(77, 'adminne', 'Nạp thành công auto Momo\\\\', '162.158.179.178', '2022-06-11 14:55:29', 'LIKESUB.TAIMMO.NET'),
(78, 'adminne', ' Đã Tạo Giao Dịch like-post-sale Với Số Tiền 400', '162.158.179.178', '2022-06-11 14:56:28', 'LIKESUB.TAIMMO.NET'),
(79, 'adminne', ' Đã Tạo Giao Dịch sub-vip Với Số Tiền 10000', '162.158.178.80', '2022-06-11 15:08:36', 'LIKESUB.TAIMMO.NET'),
(80, 'adminne', ' Đã Tạo Giao Dịch like-post-sale Với Số Tiền 400', '172.68.254.72', '2022-06-11 15:13:58', 'LIKESUB.TAIMMO.NET'),
(81, 'adminne', ' Đã Tạo Giao Dịch sub-vip Với Số Tiền 3000', '172.68.253.66', '2022-06-11 15:27:48', 'LIKESUB.TAIMMO.NET'),
(82, 'adminne', ' Đã Tạo Giao Dịch sub-vip Với Số Tiền 30000', '172.68.254.42', '2022-06-11 15:32:52', 'LIKESUB.TAIMMO.NET'),
(83, 'longhhhh', 'Đăng kí tài khoản', '162.158.179.18', '2022-06-11 16:07:25', 'LIKESUB.TAIMMO.NET'),
(84, 'Phuong', 'Đăng kí tài khoản', '162.158.179.18', '2022-06-11 17:02:22', 'LIKESUB.TAIMMO.NET'),
(85, 'huucuongtb', 'Đăng kí tài khoản', '162.158.179.151', '2022-06-11 17:04:24', 'LIKESUB.TAIMMO.NET'),
(86, 'adminbinh', 'Đăng kí tài khoản', '172.68.253.26', '2022-06-11 17:15:31', 'LIKESUB.TAIMMO.NET'),
(87, 'volamchimong', 'Đăng kí tài khoản', '162.158.179.147', '2022-06-11 17:23:38', 'LIKESUB.TAIMMO.NET'),
(88, 'Thethanh', 'Đăng kí tài khoản', '162.158.179.147', '2022-06-11 18:55:12', 'LIKESUB.TAIMMO.NET'),
(89, 'Cc123321', 'Đăng kí tài khoản', '162.158.178.80', '2022-06-11 19:00:05', 'LIKESUB.TAIMMO.NET'),
(90, 'Anhdung05', 'Đăng kí tài khoản', '162.158.179.122', '2022-06-11 19:04:11', 'LIKESUB.TAIMMO.NET'),
(91, 'oreo943', 'Đăng kí tài khoản', '162.158.178.88', '2022-06-11 19:10:51', 'LIKESUB.TAIMMO.NET'),
(92, 'Vuminhnghia ', 'Đăng kí tài khoản', '162.158.178.88', '2022-06-11 19:55:06', 'LIKESUB.TAIMMO.NET'),
(93, 'adminne', ' Đã Tạo Giao Dịch sub-vip Với Số Tiền 30000', '162.158.179.147', '2022-06-12 08:03:08', 'LIKESUB.TAIMMO.NET'),
(94, 'Hsyi2001', 'Đăng kí tài khoản', '162.158.179.178', '2022-06-12 10:07:52', 'LIKESUB.TAIMMO.NET'),
(95, 'adminne', ' Vừa nạp momo auto 10000 vào lúc 2022-06-12 12:00:12', '162.158.179.147', '2022-06-12 12:00:12', 'LIKESUB.TAIMMO.NET'),
(96, 'adminne', ' Vừa nạp mbbank auto 10000 vào lúc 2022-06-12 12:12:07', '162.158.178.88', '2022-06-12 12:12:07', 'LIKESUB.TAIMMO.NET'),
(97, 'adminne', ' Vừa nạp mbbank auto 10000 vào lúc 2022-06-12 12:14:05', '162.158.179.211', '2022-06-12 12:14:05', 'LIKESUB.TAIMMO.NET'),
(98, 'adminne', ' Đã Tạo Giao Dịch sub-vip Với Số Tiền 3000', '162.158.179.151', '2022-06-12 12:37:10', 'LIKESUB.TAIMMO.NET'),
(99, 'adminne', ' Đã Tạo Giao Dịch sub-vip Với Số Tiền 15000', '162.158.178.80', '2022-06-12 13:02:08', 'LIKESUB.TAIMMO.NET'),
(100, 'taile2k6', 'Đăng kí tài khoản', '162.158.178.80', '2022-06-12 13:23:48', 'LIKESUB.TAIMMO.NET'),
(101, 'taile2k6', '', '162.158.178.88', '2022-06-12 13:24:09', 'LIKESUB.TAIMMO.NET'),
(102, 'taile2k6', 'Đăng kí website con', '172.68.254.72', '2022-06-12 13:45:26', 'LIKESUB.TAIMMO.NET'),
(103, 'taile2k6', '', '162.158.179.151', '2022-06-12 15:07:54', 'LIKESUB.TAIMMO.NET'),
(104, 'taile2k6', 'Đăng kí website con', '172.68.253.66', '2022-06-12 17:05:45', 'LIKESUB.TAIMMO.NET'),
(105, 'taile2k6', 'Đăng kí website con', '162.158.178.80', '2022-06-12 17:12:01', 'LIKESUB.TAIMMO.NET'),
(106, 'taile2k6', 'Đăng kí website con', '162.158.179.151', '2022-06-12 17:27:31', 'LIKESUB.TAIMMO.NET'),
(107, 'taile2k6', 'Đăng kí website con', '162.158.178.88', '2022-06-12 17:50:05', 'LIKESUB.TAIMMO.NET'),
(108, 'huy2xdt', 'Đăng kí tài khoản', '172.70.92.154', '2022-06-12 17:56:26', 'LIKESUB.TAIMMO.NET'),
(109, 'taile2k6', 'Đăng kí website con', '162.158.179.211', '2022-06-12 18:02:45', 'LIKESUB.TAIMMO.NET'),
(110, 'taile2k6', 'Đăng kí website con', '162.158.178.88', '2022-06-12 18:05:38', 'LIKESUB.TAIMMO.NET'),
(111, 'adminweb', ' Vừa nạp thẻ VIETTEL với mệnh giá  vào lúc 2022-06-28 06:52:04', '::1', '2022-06-28 06:52:04', 'LOCALHOST'),
(112, 'adminweb', 'Đăng kí website con', '::1', '2022-06-28 07:43:11', 'LOCALHOST'),
(113, 'adminweb', ' Đã Tạo Giao Dịch like-post-sale Với Số Tiền 4000', '::1', '2022-06-28 14:15:54', 'LOCALHOST'),
(114, 'adminweb', ' Vừa nạp thẻ VIETTEL với mệnh giá  vào lúc 2022-06-28 16:00:55', '::1', '2022-06-28 16:00:55', 'LOCALHOST'),
(115, 'adminweb', ' Vừa nạp thẻ VIETTEL với mệnh giá  vào lúc 2022-06-28 18:05:05', '::1', '2022-06-28 18:05:05', 'LOCALHOST'),
(116, 'adminweb', 'Đăng kí website con', '::1', '2022-06-28 18:05:22', 'LOCALHOST'),
(117, 'adminweb', ' Đã Tạo Giao Dịch like-post-sale Với Số Tiền 400', '::1', '2022-06-28 18:05:46', 'LOCALHOST'),
(118, 'adminweb', ' Đã Tạo Giao Dịch sub-vip Với Số Tiền 2000', '::1', '2022-06-29 06:56:38', 'LOCALHOST'),
(119, 'adminweb', ' Đã Tạo Giao Dịch like-post Với Số Tiền 300', '::1', '2022-06-29 09:07:23', 'LOCALHOST'),
(120, 'adminweb', ' Đã Tạo Giao Dịch like-post-sale Với Số Tiền 400', '::1', '2022-06-29 10:45:07', 'LOCALHOST'),
(121, 'adminweb', ' Đã Tạo Giao Dịch sub-vip Với Số Tiền 4900', '::1', '2022-06-29 16:09:05', 'LOCALHOST'),
(122, 'adminweb', ' Đã Tạo Giao Dịch sub-vip Với Số Tiền 4900', '::1', '2022-06-29 16:14:44', 'LOCALHOST'),
(123, 'adminweb', ' Đã Tạo Giao Dịch sub-vip Với Số Tiền 4900', '::1', '2022-06-29 16:16:13', 'LOCALHOST'),
(124, 'adminne', 'Đăng kí tài khoản', '::1', '2022-06-29 16:37:56', 'LOCALHOST'),
(125, 'taile2k6', 'Đăng kí tài khoản', '::1', '2022-06-29 17:34:21', 'LOCALHOST'),
(126, 'tai2k6', 'Đăng kí tài khoản', '::1', '2022-06-29 17:36:01', 'LOCALHOST'),
(127, 'taile2k6', 'Đăng kí tài khoản', '::1', '2022-06-29 17:50:13', 'LOCALHOST'),
(128, 'taile2k6', 'Đăng kí tài khoản', '::1', '2022-06-29 17:53:37', 'LOCALHOST'),
(129, 'taile2k6', 'Đăng kí tài khoản', '::1', '2022-06-29 17:54:42', 'LOCALHOST'),
(130, 'taile2k6', 'Đăng kí tài khoản', '::1', '2022-06-29 17:55:44', 'LOCALHOST'),
(131, 'taile2k6', 'Đăng kí tài khoản', '::1', '2022-06-29 17:56:14', 'LOCALHOST'),
(132, 'taile2k6', 'Đăng kí tài khoản', '::1', '2022-06-29 17:58:51', 'LOCALHOST'),
(133, 'tai2k6', 'Đăng kí tài khoản', '::1', '2022-06-29 18:00:45', 'LOCALHOST'),
(134, 'tai2k6', 'Đăng kí tài khoản', '::1', '2022-06-29 18:01:24', 'LOCALHOST'),
(135, 'tai2k6', 'Đăng kí tài khoản', '::1', '2022-06-29 18:02:18', 'LOCALHOST'),
(136, 'tai2k6', 'Đăng kí tài khoản', '::1', '2022-06-29 18:03:20', 'LOCALHOST'),
(137, 'tai2k6', 'Đăng kí tài khoản', '::1', '2022-06-29 18:06:11', 'LOCALHOST'),
(138, 'tai2k6', 'Đăng kí tài khoản', '::1', '2022-06-29 18:07:03', 'LOCALHOST'),
(139, 'tai2k6', 'Đăng kí tài khoản', '::1', '2022-06-29 18:11:40', 'LOCALHOST'),
(140, 'tai2k6', 'Đăng kí tài khoản', '::1', '2022-06-29 18:11:51', 'LOCALHOST'),
(141, 'tai2k6', 'Đăng kí tài khoản', '::1', '2022-06-29 18:14:21', 'LOCALHOST'),
(142, 'tai2k6', 'Đăng kí tài khoản', '::1', '2022-06-29 18:15:20', 'LOCALHOST'),
(143, 'tai2k6', 'Đăng kí tài khoản', '::1', '2022-06-29 18:16:19', 'LOCALHOST'),
(144, 'taile2k6', 'Đăng kí tài khoản', '::1', '2022-06-29 18:17:55', 'LOCALHOST'),
(145, 'taile2k6', 'Đăng kí tài khoản', '::1', '2022-06-29 18:27:25', 'LOCALHOST'),
(146, 'taile2k6bg', 'Đăng kí tài khoản', '::1', '2022-06-29 21:01:51', 'LOCALHOST'),
(147, 'tai2k6', 'Đăng kí tài khoản', '::1', '2022-06-29 21:06:13', 'LOCALHOST'),
(148, 'tai2k6', 'Đăng kí tài khoản', '::1', '2022-06-29 21:19:12', 'LOCALHOST'),
(149, 'tai2k6', 'Đăng kí tài khoản', '::1', '2022-06-29 21:24:46', 'LOCALHOST'),
(150, 'taibg222', 'Đăng kí tài khoản', '::1', '2022-06-29 21:35:10', 'LOCALHOST'),
(151, 'tai2k6', 'Đăng kí tài khoản', '::1', '2022-06-29 21:40:18', 'LOCALHOST'),
(152, 'tai2k6ne', 'Đăng kí tài khoản', '::1', '2022-06-29 22:23:49', 'LOCALHOST'),
(153, 'taowebgame', 'Đăng kí tài khoản', '123.26.170.8', '2022-07-07 20:35:25', 'DVWEBGAME.INFO');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `mbbank`
--

CREATE TABLE `mbbank` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `refNo` varchar(255) DEFAULT NULL,
  `tId` varchar(255) DEFAULT NULL,
  `deviceIdCommon` varchar(255) DEFAULT NULL,
  `appVersion` varchar(255) NOT NULL DEFAULT 'ndroid_13.1_',
  `softTokenId` text DEFAULT NULL,
  `sessionId` varchar(255) DEFAULT NULL,
  `IDMB` text DEFAULT NULL,
  `custId` varchar(255) DEFAULT NULL,
  `chrgAcctCd` text DEFAULT NULL,
  `createdBy` text DEFAULT NULL,
  `custSectorCd` varchar(11) DEFAULT NULL,
  `entrustId` text DEFAULT NULL,
  `phoneNo` text DEFAULT NULL,
  `name` text DEFAULT NULL,
  `birthday` text DEFAULT NULL,
  `spiUsrCd` text DEFAULT NULL,
  `srvcPcCd` text DEFAULT NULL,
  `acct_list` text DEFAULT NULL,
  `cardList` text DEFAULT NULL,
  `softTokenList` text DEFAULT NULL,
  `biomatricAuthDeviceList` text DEFAULT NULL,
  `defaultAccount` text DEFAULT NULL,
  `custjson` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `create_at` datetime DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `mbbank`
--

INSERT INTO `mbbank` (`id`, `username`, `password`, `refNo`, `tId`, `deviceIdCommon`, `appVersion`, `softTokenId`, `sessionId`, `IDMB`, `custId`, `chrgAcctCd`, `createdBy`, `custSectorCd`, `entrustId`, `phoneNo`, `name`, `birthday`, `spiUsrCd`, `srvcPcCd`, `acct_list`, `cardList`, `softTokenList`, `biomatricAuthDeviceList`, `defaultAccount`, `custjson`, `create_at`, `update_at`) VALUES
(1, '0398206564', '20062006@Tai', '0398206564-2022061212014353601', '6e4b029833db1d17cb84939781fa903da2fb384c', '0000000-0000-0000-cacf-e2248f57a196', 'ndroid_13.1_', NULL, '7ac7ce34-674a-44c4-b6f9-4ca0c05eec00', 'D8D8945279FD48E5E0530E5C010A85F7', NULL, '24200618066666', 'ONLINE', '1918', '17537326', '0398xxx564', 'LE TUAN TAI', '2006-06-18 00:00:00', 'D8D8945279FC48E5E0530E5C010A85F7', 'EBANKINGKYCLV2', 'eyI1NTU1NTQ0MzMzMyI6eyJhY2N0Tm8iOiI1NTU1NTQ0MzMzMyIsImFjY3RBbGlhcyI6IkxFIFRVQU4gVEFJIiwiYWNjdE5tIjoiTEUgVFVBTiBUQUkiLCJhY2N0VHlwQ2QiOiJDQSIsImNjeUNkIjoiVk5EIiwiY3VzdElkIjoiRDhEODk0NTI3OUZENDhFNUUwNTMwRTVDMDEwQTg1RjciLCJob3N0Q3VzdElkIjoiMTc1MzczMjYiLCJpbmFjdGl2ZVN0cyI6IjAiLCJvcmdVbml0Q2QiOiJWTjAwMTA3NjEiLCJpc0NyZHQiOiJZIiwiaXNEZWJpdCI6IlkiLCJpc0lucSI6IlkiLCJjdXJyZW50QmFsYW5jZSI6bnVsbCwiaXNTeW5jIjpudWxsLCJjYXRlZ29yeSI6IjEwMDEiLCJwcm9kdWN0VHlwZSI6IlRHVFQifSwiMjAwODExMjIzMzQ0NTUiOnsiYWNjdE5vIjoiMjAwODExMjIzMzQ0NTUiLCJhY2N0QWxpYXMiOiJMRSBUVUFOIFRBSSIsImFjY3RObSI6IkxFIFRVQU4gVEFJIiwiYWNjdFR5cENkIjoiQ0EiLCJjY3lDZCI6IlZORCIsImN1c3RJZCI6IkQ4RDg5NDUyNzlGRDQ4RTVFMDUzMEU1QzAxMEE4NUY3IiwiaG9zdEN1c3RJZCI6IjE3NTM3MzI2IiwiaW5hY3RpdmVTdHMiOiIwIiwib3JnVW5pdENkIjoiVk4wMDEwNzYxIiwiaXNDcmR0IjoiWSIsImlzRGViaXQiOiJZIiwiaXNJbnEiOiJZIiwiY3VycmVudEJhbGFuY2UiOm51bGwsImlzU3luYyI6bnVsbCwiY2F0ZWdvcnkiOiIxMDAxIiwicHJvZHVjdFR5cGUiOiJUR1RUIn0sIjI0MjAwNjE4MDY2NjY2Ijp7ImFjY3RObyI6IjI0MjAwNjE4MDY2NjY2IiwiYWNjdEFsaWFzIjoiTEUgVFVBTiBUQUkgIiwiYWNjdE5tIjoiTEUgVFVBTiBUQUkgIiwiYWNjdFR5cENkIjoiQ0EiLCJjY3lDZCI6IlZORCIsImN1c3RJZCI6IkQ4RDg5NDUyNzlGRDQ4RTVFMDUzMEU1QzAxMEE4NUY3IiwiaG9zdEN1c3RJZCI6IjE3NTM3MzI2IiwiaW5hY3RpdmVTdHMiOiIwIiwib3JnVW5pdENkIjoiVk4wMDEwNzYxIiwiaXNDcmR0IjoiWSIsImlzRGViaXQiOiJZIiwiaXNJbnEiOiJZIiwiY3VycmVudEJhbGFuY2UiOm51bGwsImlzU3luYyI6bnVsbCwiY2F0ZWdvcnkiOiIxMDAxIiwicHJvZHVjdFR5cGUiOiJUR1RUIn19', 'eyIxMDA2Nzc5MDMiOnsiaWQiOm51bGwsImFjY3RObSI6IkxFIFRVQU4gVEFJIiwiYWNjdE5vIjoiMjQyMDA2MTgwNjY2NjYiLCJhbHdPdmVyTG10UGVyRGF5IjpudWxsLCJhbHdPdmVyTm9UcnhQZXJEYXkiOm51bGwsImJpbGxpbmdEdCI6bnVsbCwiY2FyZENhdENkIjpudWxsLCJjYXJkRmxhZyI6bnVsbCwiY2FyZEx2bCI6IkNMQVNTSUMiLCJjYXJkTm0iOiJMRSBUVUFOIFRBSS00MDg5MDRYWFhYWFgxODI2IiwiY2FyZE5vIjoiMTAwNjc3OTAzIiwiY2FyZFByZENkIjoiVklTQV9ERUJJVF9OT1JNQUwiLCJjYXJkVHlwIjoiRCIsImNjeUNkIjoiVk5EIiwiY3JlZGl0TG10IjpudWxsLCJob3N0Q3VzdElkIjoiMTc1MzczMjYiLCJpc0FjY3NFYmFua2luZyI6bnVsbCwib3JnVW5pdENkIjpudWxsLCJwbXJ5Q2FyZE5tIjoiTEUgVFVBTiBUQUktNDA4OTA0WFhYWFhYMTgyNiIsInBtcnlDYXJkTm8iOiIxMDA2Nzc5MDMiLCJwcmRUeXBDZCI6bnVsbCwic3BsbXRyeUZsYWciOiJOIiwic3RzIjoiQ2FyZCBPSyIsInN0c0NhcmQiOm51bGwsInN0c0luZXRVc2FnZSI6Ik9OIiwidmFsaWRUaHJvdWdoIjoiMjcwNiIsImJyYW5jaENvZGUiOm51bGwsImNhcmREaXNwbGF5IjpudWxsLCJhbW91bnRBdmFpbGFibGUiOm51bGwsImludGVyZXN0UmF0ZSI6bnVsbCwidHlwZSI6bnVsbCwiYWN0aXZlRGF0ZSI6bnVsbCwiZ3JvdXBEZWJpdCI6bnVsbCwib3V0c3RhbmRpbmdCYWxhbmNlIjpudWxsLCJ0b3RhbFdpdGhEcmF3SW5Nb250aCI6bnVsbCwibWF4V2l0aERyYXciOm51bGwsImVyciI6bnVsbCwibWVzc2FnZUVyciI6bnVsbCwiZW1ib3NzZWROYW1lIjpudWxsLCJtaW5QYXltZW50QW1vdW50IjpudWxsLCJjYXJkU3RhdHVzRGV0YWlsIjpudWxsLCJjb250cmFjdFN0YXR1c05hbWUiOm51bGwsInJlZ051bWJlciI6bnVsbCwiaXNDb25maXJtIjoiWSIsImlzU291cmNlRGViaXQiOm51bGwsImNhcmROdW1iZXIiOm51bGwsInBhY2tJbmNBY3RpdmUiOm51bGwsInBsYXN0aWNTdGF0dXMiOm51bGwsInByb2R1Y3RTdGF0dXMiOm51bGwsImNvbnRyYWN0U3RhdHVzQ29kZSI6bnVsbCwiYXBwcm92YWxTdGF0dXMiOm51bGwsImNhcmRDb2RlIjpudWxsLCJjYXJkQ2xhc3NEZXRhaWwiOm51bGwsImlzRXh0ZW5kVmFsaWQiOm51bGwsInBhaWRBbW91bnQiOm51bGwsImN1cnJlbnRNaW5QYXltZW50IjpudWxsLCJjdXJyZW50UGF5bWVudCI6bnVsbCwiZGVidE1vbWVudCI6bnVsbCwidG90YWxEZWJpdEFtb3VudCI6bnVsbCwicHJpbnRpbmdTdGF0dXMiOm51bGwsImNhcmRQcm9ncmFtQ2QiOm51bGwsImRlYml0TWV0aG9kIjpudWxsLCJjYXJkT3BlbkRhdGUiOm51bGwsInByaW50QWRkcmVzcyI6bnVsbCwicHJpbnREdCI6bnVsbCwiY2hhbm5lbCI6bnVsbCwiaHRudCI6bnVsbCwiYWRkdGlvbmFsQ2FyZCI6bnVsbCwicmJzTnVtYmVyIjpudWxsfSwiMTAwNzI5NDIzIjp7ImlkIjpudWxsLCJhY2N0Tm0iOiJMRSBUVUFOIFRBSSIsImFjY3RObyI6IjI0MjAwNjE4MDY2NjY2IiwiYWx3T3ZlckxtdFBlckRheSI6bnVsbCwiYWx3T3Zlck5vVHJ4UGVyRGF5IjpudWxsLCJiaWxsaW5nRHQiOm51bGwsImNhcmRDYXRDZCI6bnVsbCwiY2FyZEZsYWciOm51bGwsImNhcmRMdmwiOiJESUFNT05EIiwiY2FyZE5tIjoiTEUgVFVBTiBUQUktOTcwNDIyWFhYWFhYMTAzNCIsImNhcmRObyI6IjEwMDcyOTQyMyIsImNhcmRQcmRDZCI6IkFDVElWRVBMVVMiLCJjYXJkVHlwIjoiRCIsImNjeUNkIjoiVk5EIiwiY3JlZGl0TG10IjpudWxsLCJob3N0Q3VzdElkIjoiMTc1MzczMjYiLCJpc0FjY3NFYmFua2luZyI6bnVsbCwib3JnVW5pdENkIjpudWxsLCJwbXJ5Q2FyZE5tIjoiTEUgVFVBTiBUQUktOTcwNDIyWFhYWFhYMTAzNCIsInBtcnlDYXJkTm8iOiIxMDA3Mjk0MjMiLCJwcmRUeXBDZCI6bnVsbCwic3BsbXRyeUZsYWciOiJOIiwic3RzIjoiQ2FyZCBPSyIsInN0c0NhcmQiOm51bGwsInN0c0luZXRVc2FnZSI6Ik9OIiwidmFsaWRUaHJvdWdoIjoiMjcwNiIsImJyYW5jaENvZGUiOm51bGwsImNhcmREaXNwbGF5IjpudWxsLCJhbW91bnRBdmFpbGFibGUiOm51bGwsImludGVyZXN0UmF0ZSI6bnVsbCwidHlwZSI6bnVsbCwiYWN0aXZlRGF0ZSI6bnVsbCwiZ3JvdXBEZWJpdCI6bnVsbCwib3V0c3RhbmRpbmdCYWxhbmNlIjpudWxsLCJ0b3RhbFdpdGhEcmF3SW5Nb250aCI6bnVsbCwibWF4V2l0aERyYXciOm51bGwsImVyciI6bnVsbCwibWVzc2FnZUVyciI6bnVsbCwiZW1ib3NzZWROYW1lIjpudWxsLCJtaW5QYXltZW50QW1vdW50IjpudWxsLCJjYXJkU3RhdHVzRGV0YWlsIjpudWxsLCJjb250cmFjdFN0YXR1c05hbWUiOm51bGwsInJlZ051bWJlciI6bnVsbCwiaXNDb25maXJtIjoiWSIsImlzU291cmNlRGViaXQiOm51bGwsImNhcmROdW1iZXIiOm51bGwsInBhY2tJbmNBY3RpdmUiOm51bGwsInBsYXN0aWNTdGF0dXMiOm51bGwsInByb2R1Y3RTdGF0dXMiOm51bGwsImNvbnRyYWN0U3RhdHVzQ29kZSI6bnVsbCwiYXBwcm92YWxTdGF0dXMiOm51bGwsImNhcmRDb2RlIjpudWxsLCJjYXJkQ2xhc3NEZXRhaWwiOm51bGwsImlzRXh0ZW5kVmFsaWQiOm51bGwsInBhaWRBbW91bnQiOm51bGwsImN1cnJlbnRNaW5QYXltZW50IjpudWxsLCJjdXJyZW50UGF5bWVudCI6bnVsbCwiZGVidE1vbWVudCI6bnVsbCwidG90YWxEZWJpdEFtb3VudCI6bnVsbCwicHJpbnRpbmdTdGF0dXMiOm51bGwsImNhcmRQcm9ncmFtQ2QiOm51bGwsImRlYml0TWV0aG9kIjpudWxsLCJjYXJkT3BlbkRhdGUiOm51bGwsInByaW50QWRkcmVzcyI6bnVsbCwicHJpbnREdCI6bnVsbCwiY2hhbm5lbCI6bnVsbCwiaHRudCI6bnVsbCwiYWRkdGlvbmFsQ2FyZCI6bnVsbCwicmJzTnVtYmVyIjpudWxsfX0=', 'W3siZGV2aWNlTm8iOiJEOEQ4OTNBQzUxRDhBRkNERTA1MzBENUMwMTBBMzBGMSIsImN1c3RJZCI6IkQ4RDg5NDUyNzlGRDQ4RTVFMDUzMEU1QzAxMEE4NUY3IiwiZGV2aWNlVHlwZSI6InNvdHAiLCJpc0RlZmF1bHQiOiJOIiwiY2xhenoiOiJjb20uYXByaXNtYS5wcm9kdWN0LmdjbS5jb21tb24ubW9kZWwuQXV0aGVudGljYXRpb25EZXZpY2UiLCJpc1Jlc2V0IjpudWxsLCJpc010QXNzaWduZWQiOm51bGwsImRldmljZUlkIjoiNjcxYmQzY2FhNzNiODE2OTM1ZDk3NTdmZGQ2YWVjYmQ5YzQwYzdhYiIsInRva2VuIjoiTU02NkQ3NEU3NCIsInN0YXR1cyI6IjAiLCJyZXRyeSI6MCwibW9iaWxlRGV2aWNlSWQiOiIwMDAwMDAwMC0wMDAwLTAwMDAtMTA4Ni1lZGMzNzRmZjczOTQiLCJwaG9uZUlkIjoiR2FsYXh5IEEzMHMiLCJhc3NpZ25lZER0IjpudWxsLCJ1c2VySWQiOm51bGwsImFjdGl2ZWRPdHAiOm51bGwsInNtc0NvdW50IjpudWxsLCJoYXNoVXNlcklkIjpudWxsLCJiaW9JZCI6bnVsbCwiYmlvTGV2ZWwiOm51bGwsImRvdHBQaW4iOiI2MDYxNmY2NjM5Nzg3MTlkYmJhZDA0ZGFlOGFmOTcwMDRiOGNhMGI5Y2Q5ZTZjMjI0ZmExNTc1YTYxZjYzNWU2IiwicGluVXBkYXRlRGF0ZSI6IjI1XC8wMlwvMjAyMiAyMDoyNjowNyIsImhhc2hEZXZpY2VObyI6bnVsbH0seyJkZXZpY2VObyI6IkRCNDdCRTk0QTI1MjgxMDZFMDUzMEQ1QzAxMEEyQjJEIiwiY3VzdElkIjoiRDhEODk0NTI3OUZENDhFNUUwNTMwRTVDMDEwQTg1RjciLCJkZXZpY2VUeXBlIjoic290cCIsImlzRGVmYXVsdCI6Ik4iLCJjbGF6eiI6ImNvbS5hcHJpc21hLnByb2R1Y3QuZ2NtLmNvbW1vbi5tb2RlbC5BdXRoZW50aWNhdGlvbkRldmljZSIsImlzUmVzZXQiOm51bGwsImlzTXRBc3NpZ25lZCI6bnVsbCwiZGV2aWNlSWQiOiJhZjI3NmE3MGJlMGNmYjk5OGI4YmMwMGM3MjZiNGJiMjI3Y2JjNDg2IiwidG9rZW4iOiJGUTY5REFFQTI2Iiwic3RhdHVzIjoiMCIsInJldHJ5IjowLCJtb2JpbGVEZXZpY2VJZCI6ImZhZmY2OTIwLTMyOTItNjIzOC04NjUyLTU5MDMxMjE1MTEwOCIsInBob25lSWQiOiJDUEgxNzAxIiwiYXNzaWduZWREdCI6bnVsbCwidXNlcklkIjpudWxsLCJhY3RpdmVkT3RwIjpudWxsLCJzbXNDb3VudCI6bnVsbCwiaGFzaFVzZXJJZCI6bnVsbCwiYmlvSWQiOm51bGwsImJpb0xldmVsIjpudWxsLCJkb3RwUGluIjoiNzMzZjMwMGNmYTA2ZGVmOTYyOWQ1ZTIyZTJlZDY2NzI3NGZkMGY4OGE2YTk0ODNhODdjY2UzZjYzNmFhYzljOCIsInBpblVwZGF0ZURhdGUiOiIyOFwvMDNcLzIwMjIgMjA6MDg6MjgiLCJoYXNoRGV2aWNlTm8iOm51bGx9LHsiZGV2aWNlTm8iOiJERDE1OTAyMzNCQzcyMTgxRTA1MzBENUMwMTBBOEU5QSIsImN1c3RJZCI6IkQ4RDg5NDUyNzlGRDQ4RTVFMDUzMEU1QzAxMEE4NUY3IiwiZGV2aWNlVHlwZSI6InNvdHAiLCJpc0RlZmF1bHQiOiJOIiwiY2xhenoiOiJjb20uYXByaXNtYS5wcm9kdWN0LmdjbS5jb21tb24ubW9kZWwuQXV0aGVudGljYXRpb25EZXZpY2UiLCJpc1Jlc2V0IjpudWxsLCJpc010QXNzaWduZWQiOm51bGwsImRldmljZUlkIjoiYzQ2N2MzNDJmYThiNWRlMDk4Yzk0NmI4YWNlMDRhMGMxNGYyMTc2YyIsInRva2VuIjoiR0NBQzM3RjRGNCIsInN0YXR1cyI6IjAiLCJyZXRyeSI6MCwibW9iaWxlRGV2aWNlSWQiOiIwMDAwMDAwMC0wMDAwLTAwMDAtNjYyYy03YzMxMmQxNzE1ZTAiLCJwaG9uZUlkIjoiQ1BIMjE3OSIsImFzc2lnbmVkRHQiOm51bGwsInVzZXJJZCI6bnVsbCwiYWN0aXZlZE90cCI6bnVsbCwic21zQ291bnQiOm51bGwsImhhc2hVc2VySWQiOm51bGwsImJpb0lkIjpudWxsLCJiaW9MZXZlbCI6bnVsbCwiZG90cFBpbiI6IjYwNjE2ZjY2Mzk3ODcxOWRiYmFkMDRkYWU4YWY5NzAwNGI4Y2EwYjljZDllNmMyMjRmYTE1NzVhNjFmNjM1ZTYiLCJwaW5VcGRhdGVEYXRlIjoiMjBcLzA0XC8yMDIyIDE5OjEyOjUxIiwiaGFzaERldmljZU5vIjpudWxsfSx7ImRldmljZU5vIjoiRERBNDM0NTM0MUY1NURGNUUwNTMwRDVDMDEwQUNEMDciLCJjdXN0SWQiOiJEOEQ4OTQ1Mjc5RkQ0OEU1RTA1MzBFNUMwMTBBODVGNyIsImRldmljZVR5cGUiOiJzb3RwIiwiaXNEZWZhdWx0IjoiTiIsImNsYXp6IjoiY29tLmFwcmlzbWEucHJvZHVjdC5nY20uY29tbW9uLm1vZGVsLkF1dGhlbnRpY2F0aW9uRGV2aWNlIiwiaXNSZXNldCI6bnVsbCwiaXNNdEFzc2lnbmVkIjpudWxsLCJkZXZpY2VJZCI6IjdjYTQzOGU3MDg2MzM3ZDcxYzRlMGRlNzZhYmUxMGI3NDI0OGJiMjciLCJ0b2tlbiI6IkFHQ0Q2QzcyRTQiLCJzdGF0dXMiOiIwIiwicmV0cnkiOjAsIm1vYmlsZURldmljZUlkIjoiOGQwMmY5MWEtM2ZmYy02MWU4LTY1MjUtOTAzMTIxNTExMDg5IiwicGhvbmVJZCI6IkNQSDE3MDEiLCJhc3NpZ25lZER0IjpudWxsLCJ1c2VySWQiOm51bGwsImFjdGl2ZWRPdHAiOm51bGwsInNtc0NvdW50IjpudWxsLCJoYXNoVXNlcklkIjpudWxsLCJiaW9JZCI6bnVsbCwiYmlvTGV2ZWwiOm51bGwsImRvdHBQaW4iOiI3MzNmMzAwY2ZhMDZkZWY5NjI5ZDVlMjJlMmVkNjY3Mjc0ZmQwZjg4YTZhOTQ4M2E4N2NjZTNmNjM2YWFjOWM4IiwicGluVXBkYXRlRGF0ZSI6IjI3XC8wNFwvMjAyMiAyMToxMToyNSIsImhhc2hEZXZpY2VObyI6bnVsbH0seyJkZXZpY2VObyI6IkUxMUJCNTNGMDY0QUVEMDVFMDUzMEU1QzAxMEE2MTczIiwiY3VzdElkIjoiRDhEODk0NTI3OUZENDhFNUUwNTMwRTVDMDEwQTg1RjciLCJkZXZpY2VUeXBlIjoic290cCIsImlzRGVmYXVsdCI6Ik4iLCJjbGF6eiI6ImNvbS5hcHJpc21hLnByb2R1Y3QuZ2NtLmNvbW1vbi5tb2RlbC5BdXRoZW50aWNhdGlvbkRldmljZSIsImlzUmVzZXQiOm51bGwsImlzTXRBc3NpZ25lZCI6bnVsbCwiZGV2aWNlSWQiOiI2MWI4YmY3NTY5MmJlNTU0YzgzMmNkNGY3ZmU3OGFkZTgyMDQ4ZTdhIiwidG9rZW4iOiJLTkZBQ0NBN0U2Iiwic3RhdHVzIjoiMCIsInJldHJ5IjowLCJtb2JpbGVEZXZpY2VJZCI6ImUzZDQ1YTkyLTcxNzctNTRlOC04NjUyLTU5MDMxMjE1MTEwOCIsInBob25lSWQiOiJDUEgxNzAxIiwiYXNzaWduZWREdCI6bnVsbCwidXNlcklkIjpudWxsLCJhY3RpdmVkT3RwIjpudWxsLCJzbXNDb3VudCI6bnVsbCwiaGFzaFVzZXJJZCI6bnVsbCwiYmlvSWQiOm51bGwsImJpb0xldmVsIjpudWxsLCJkb3RwUGluIjoiNzMzZjMwMGNmYTA2ZGVmOTYyOWQ1ZTIyZTJlZDY2NzI3NGZkMGY4OGE2YTk0ODNhODdjY2UzZjYzNmFhYzljOCIsInBpblVwZGF0ZURhdGUiOiIxMVwvMDZcLzIwMjIgMDA6MDg6MjQiLCJoYXNoRGV2aWNlTm8iOm51bGx9XQ==', 'W3siZGV2aWNlTm8iOiJEOEQ4NTU0MzNGOTBBQzJCRTA1MzBENUMwMTBBMTc4MSIsImN1c3RJZCI6IkQ4RDg5NDUyNzlGRDQ4RTVFMDUzMEU1QzAxMEE4NUY3IiwiZGV2aWNlVHlwZSI6ImJpb21ldHJpYyIsImlzRGVmYXVsdCI6Ik4iLCJjbGF6eiI6ImNvbS5hcHJpc21hLnByb2R1Y3QuZ2NtLmNvbW1vbi5tb2RlbC5BdXRoZW50aWNhdGlvbkRldmljZSIsImlzUmVzZXQiOm51bGwsImlzTXRBc3NpZ25lZCI6bnVsbCwiZGV2aWNlSWQiOiI2NzFiZDNjYWE3M2I4MTY5MzVkOTc1N2ZkZDZhZWNiZDljNDBjN2FiIiwidG9rZW4iOm51bGwsInN0YXR1cyI6IjAiLCJyZXRyeSI6MCwibW9iaWxlRGV2aWNlSWQiOm51bGwsInBob25lSWQiOm51bGwsImFzc2lnbmVkRHQiOjE2NDU3OTU1NjQwMDAsInVzZXJJZCI6bnVsbCwiYWN0aXZlZE90cCI6bnVsbCwic21zQ291bnQiOm51bGwsImhhc2hVc2VySWQiOiIzNDBlMTgyYjM3YzM5OWQzYmJlZGIzMzk0OTFhZGQzMjY0YmY5ZTdlIiwiYmlvSWQiOiJkMTBjYmU0Yi1mNTc3LTQ3ZmYtYjExNy1hMzdmZDEyYTQyZWZfNjcxYmQzY2FhNzNiODE2OTM1ZDk3NTdmZGQ2YWVjYmQ5YzQwYzdhYl8xNjQ1Nzk1MDg5ODE1IiwiYmlvTGV2ZWwiOiIyIiwiZG90cFBpbiI6bnVsbCwicGluVXBkYXRlRGF0ZSI6bnVsbCwiaGFzaERldmljZU5vIjpudWxsfV0=', 'eyJhY2N0Tm8iOiIyNDIwMDYxODA2NjY2NiIsImFjY3RBbGlhcyI6IkxFIFRVQU4gVEFJICIsImFjY3RObSI6IkxFIFRVQU4gVEFJICIsImFjY3RUeXBDZCI6IkNBIiwiY2N5Q2QiOiJWTkQiLCJjdXN0SWQiOiJEOEQ4OTQ1Mjc5RkQ0OEU1RTA1MzBFNUMwMTBBODVGNyIsImhvc3RDdXN0SWQiOiIxNzUzNzMyNiIsImluYWN0aXZlU3RzIjoiMCIsIm9yZ1VuaXRDZCI6IlZOMDAxMDc2MSIsImlzQ3JkdCI6IlkiLCJpc0RlYml0IjoiWSIsImlzSW5xIjoiWSIsImN1cnJlbnRCYWxhbmNlIjpudWxsLCJpc1N5bmMiOm51bGwsImNhdGVnb3J5IjoiMTAwMSIsInByb2R1Y3RUeXBlIjoiVEdUVCJ9', '{\"id\":\"D8D8945279FD48E5E0530E5C010A85F7\",\"addr1\":\"TDP DONG NGAN THI TRAN THANG HIEP HOA BAC GIANG\",\"addr2\":\"TDP DONG NGAN THI TRAN THANG\",\"chrgAcctCd\":\"24200618066666\",\"cityCd\":null,\"correspondentEmail\":\"thattinh14122@gmail.com\",\"createdBy\":\"ONLINE\",\"creditFrameworkBranch\":null,\"creditFrameworkContract\":null,\"custSectorCd\":\"1918\",\"email1\":\"thattinh14122@gmail.com\",\"entrustId\":\"17537326\",\"hndlingOfficerCd\":\"O741\",\"hostCifId\":\"17537326\",\"idTypDt\":1640106000000,\"idTypNo\":\"024xx6012490\",\"idTypPlace\":\"CUC CANH SAT QUAN LY HANH CHINH \",\"isDelete\":\"N\",\"isInactive\":\"N\",\"isLoan\":\"Y\",\"mobilePhoneNo1\":\"0398xxx564\",\"mobilePhoneNo2\":null,\"dob\":\"2006-06-18 00:00:00\",\"nm\":\"LE TUAN TAI\",\"orgUnitCd\":\"VN0010761\",\"phoneNo\":\"0398xxx564\",\"secHndlingOfficerCd\":\"O741\",\"spiUsrCd\":\"D8D8945279FC48E5E0530E5C010A85F7\",\"srvcPcCd\":\"EBANKINGKYCLV2\",\"stateCd\":null,\"userId\":\"0398206564\",\"state\":1,\"gender\":\"0\",\"password\":\"\",\"imUserStatus\":\"ACTIVE\",\"auth_type\":null,\"device_no\":null,\"chargeCd\":null,\"menuCd\":null,\"limitCd\":null,\"acct_list\":{\"55555443333\":{\"acctNo\":\"55555443333\",\"acctAlias\":\"LE TUAN TAI\",\"acctNm\":\"LE TUAN TAI\",\"acctTypCd\":\"CA\",\"ccyCd\":\"VND\",\"custId\":\"D8D8945279FD48E5E0530E5C010A85F7\",\"hostCustId\":\"17537326\",\"inactiveSts\":\"0\",\"orgUnitCd\":\"VN0010761\",\"isCrdt\":\"Y\",\"isDebit\":\"Y\",\"isInq\":\"Y\",\"currentBalance\":null,\"isSync\":null,\"category\":\"1001\",\"productType\":\"TGTT\"},\"20081122334455\":{\"acctNo\":\"20081122334455\",\"acctAlias\":\"LE TUAN TAI\",\"acctNm\":\"LE TUAN TAI\",\"acctTypCd\":\"CA\",\"ccyCd\":\"VND\",\"custId\":\"D8D8945279FD48E5E0530E5C010A85F7\",\"hostCustId\":\"17537326\",\"inactiveSts\":\"0\",\"orgUnitCd\":\"VN0010761\",\"isCrdt\":\"Y\",\"isDebit\":\"Y\",\"isInq\":\"Y\",\"currentBalance\":null,\"isSync\":null,\"category\":\"1001\",\"productType\":\"TGTT\"},\"24200618066666\":{\"acctNo\":\"24200618066666\",\"acctAlias\":\"LE TUAN TAI \",\"acctNm\":\"LE TUAN TAI \",\"acctTypCd\":\"CA\",\"ccyCd\":\"VND\",\"custId\":\"D8D8945279FD48E5E0530E5C010A85F7\",\"hostCustId\":\"17537326\",\"inactiveSts\":\"0\",\"orgUnitCd\":\"VN0010761\",\"isCrdt\":\"Y\",\"isDebit\":\"Y\",\"isInq\":\"Y\",\"currentBalance\":null,\"isSync\":null,\"category\":\"1001\",\"productType\":\"TGTT\"}},\"cardList\":{\"100677903\":{\"id\":null,\"acctNm\":\"LE TUAN TAI\",\"acctNo\":\"24200618066666\",\"alwOverLmtPerDay\":null,\"alwOverNoTrxPerDay\":null,\"billingDt\":null,\"cardCatCd\":null,\"cardFlag\":null,\"cardLvl\":\"CLASSIC\",\"cardNm\":\"LE TUAN TAI-408904XXXXXX1826\",\"cardNo\":\"100677903\",\"cardPrdCd\":\"VISA_DEBIT_NORMAL\",\"cardTyp\":\"D\",\"ccyCd\":\"VND\",\"creditLmt\":null,\"hostCustId\":\"17537326\",\"isAccsEbanking\":null,\"orgUnitCd\":null,\"pmryCardNm\":\"LE TUAN TAI-408904XXXXXX1826\",\"pmryCardNo\":\"100677903\",\"prdTypCd\":null,\"splmtryFlag\":\"N\",\"sts\":\"Card OK\",\"stsCard\":null,\"stsInetUsage\":\"ON\",\"validThrough\":\"2706\",\"branchCode\":null,\"cardDisplay\":null,\"amountAvailable\":null,\"interestRate\":null,\"type\":null,\"activeDate\":null,\"groupDebit\":null,\"outstandingBalance\":null,\"totalWithDrawInMonth\":null,\"maxWithDraw\":null,\"err\":null,\"messageErr\":null,\"embossedName\":null,\"minPaymentAmount\":null,\"cardStatusDetail\":null,\"contractStatusName\":null,\"regNumber\":null,\"isConfirm\":\"Y\",\"isSourceDebit\":null,\"cardNumber\":null,\"packIncActive\":null,\"plasticStatus\":null,\"productStatus\":null,\"contractStatusCode\":null,\"approvalStatus\":null,\"cardCode\":null,\"cardClassDetail\":null,\"isExtendValid\":null,\"paidAmount\":null,\"currentMinPayment\":null,\"currentPayment\":null,\"debtMoment\":null,\"totalDebitAmount\":null,\"printingStatus\":null,\"cardProgramCd\":null,\"debitMethod\":null,\"cardOpenDate\":null,\"printAddress\":null,\"printDt\":null,\"channel\":null,\"htnt\":null,\"addtionalCard\":null,\"rbsNumber\":null},\"100729423\":{\"id\":null,\"acctNm\":\"LE TUAN TAI\",\"acctNo\":\"24200618066666\",\"alwOverLmtPerDay\":null,\"alwOverNoTrxPerDay\":null,\"billingDt\":null,\"cardCatCd\":null,\"cardFlag\":null,\"cardLvl\":\"DIAMOND\",\"cardNm\":\"LE TUAN TAI-970422XXXXXX1034\",\"cardNo\":\"100729423\",\"cardPrdCd\":\"ACTIVEPLUS\",\"cardTyp\":\"D\",\"ccyCd\":\"VND\",\"creditLmt\":null,\"hostCustId\":\"17537326\",\"isAccsEbanking\":null,\"orgUnitCd\":null,\"pmryCardNm\":\"LE TUAN TAI-970422XXXXXX1034\",\"pmryCardNo\":\"100729423\",\"prdTypCd\":null,\"splmtryFlag\":\"N\",\"sts\":\"Card OK\",\"stsCard\":null,\"stsInetUsage\":\"ON\",\"validThrough\":\"2706\",\"branchCode\":null,\"cardDisplay\":null,\"amountAvailable\":null,\"interestRate\":null,\"type\":null,\"activeDate\":null,\"groupDebit\":null,\"outstandingBalance\":null,\"totalWithDrawInMonth\":null,\"maxWithDraw\":null,\"err\":null,\"messageErr\":null,\"embossedName\":null,\"minPaymentAmount\":null,\"cardStatusDetail\":null,\"contractStatusName\":null,\"regNumber\":null,\"isConfirm\":\"Y\",\"isSourceDebit\":null,\"cardNumber\":null,\"packIncActive\":null,\"plasticStatus\":null,\"productStatus\":null,\"contractStatusCode\":null,\"approvalStatus\":null,\"cardCode\":null,\"cardClassDetail\":null,\"isExtendValid\":null,\"paidAmount\":null,\"currentMinPayment\":null,\"currentPayment\":null,\"debtMoment\":null,\"totalDebitAmount\":null,\"printingStatus\":null,\"cardProgramCd\":null,\"debitMethod\":null,\"cardOpenDate\":null,\"printAddress\":null,\"printDt\":null,\"channel\":null,\"htnt\":null,\"addtionalCard\":null,\"rbsNumber\":null}},\"saving_acct_list\":[],\"photoStr\":null,\"maxInactiveInterval\":\"600\",\"menuList\":[{\"code\":\"MNU_GCME_701500\",\"parentCode\":\"MNU_GCME_700000\",\"name\":\"menu.cardService.creditcardpayment\"},{\"code\":\"MNU_GCME_701300\",\"parentCode\":\"MNU_GCME_700000\",\"name\":\"menu.cardService.cardTranSearch\"},{\"code\":\"MNU_GCME_701000\",\"parentCode\":\"MNU_GCME_700000\",\"name\":\"menu.cardService.activeLockUnlock\"},{\"code\":\"MNU_GCME_990600\",\"parentCode\":\"MNU_GCME_750000\",\"name\":\"menu.child.savingsplacement\"},{\"code\":\"MNU_GCME_040100\",\"parentCode\":\"MNU_GCME_040000\",\"name\":\"menu.child.balanceinquiry\"},{\"code\":\"MNU_GCME_050200\",\"parentCode\":\"MNU_GCME_050000\",\"name\":\"menu.child.inhousetransfer2\"},{\"code\":\"MNU_GCME_040200\",\"parentCode\":\"MNU_GCME_040000\",\"name\":\"menu.child.transactioninquiry\"},{\"code\":\"MNU_GCME_701100\",\"parentCode\":\"MNU_GCME_700000\",\"name\":\"menu.cardService.onOffInternet\"},{\"code\":\"MNU_GCME_050300\",\"parentCode\":\"MNU_GCME_050000\",\"name\":\"menu.child.domesticfast\"},{\"code\":\"MNU_GCME_780200\",\"parentCode\":\"MNU_GCME_780000\",\"name\":\"menu.child.onlineloan\"},{\"code\":\"MNU_GCME_990610\",\"parentCode\":\"MNU_GCME_750000\",\"name\":\"menu.child.savingsinformation\"},{\"code\":\"MNU_GCME_040000\",\"parentCode\":null,\"name\":\"menu.parent.accountstatement\"},{\"code\":\"MNU_GCME_060200\",\"parentCode\":\"MNU_GCME_060000\",\"name\":\"menu.child.billpayment\"},{\"code\":\"MNU_GCME_160500\",\"parentCode\":\"MNU_GCME_160000\",\"name\":\"menu.child.changepassword\"},{\"code\":\"MNU_GCME_050301\",\"parentCode\":\"MNU_GCME_050000\",\"name\":\"menu.child.domesticibps\"},{\"code\":\"MNU_GCME_050000\",\"parentCode\":null,\"name\":\"menu.parent.transfermanagement\"},{\"code\":\"MNU_GCME_990620\",\"parentCode\":\"MNU_GCME_750000\",\"name\":\"menu.child.savingscalculator\"},{\"code\":\"MNU_GCME_780100\",\"parentCode\":\"MNU_GCME_780000\",\"name\":\"menu.child.loaninformation\"},{\"code\":\"MNU_GCME_701200\",\"parentCode\":\"MNU_GCME_700000\",\"name\":\"menu.cardService.openCloseLimitTran\"},{\"code\":\"MNU_GCME_780300\",\"parentCode\":\"MNU_GCME_780000\",\"name\":\"menu.child.loanpayment\"},{\"code\":\"MNU_GCME_060000\",\"parentCode\":null,\"name\":\"menu.parent.paymentmanagement2\"},{\"code\":\"MNU_GCME_050500\",\"parentCode\":\"MNU_GCME_050000\",\"name\":\"menu.child.securities\"},{\"code\":\"MNU_GCME_780400\",\"parentCode\":\"MNU_GCME_780000\",\"name\":\"menu.child.loancalculator\"},{\"code\":\"MNU_GCME_750000\",\"parentCode\":null,\"name\":\"menu.parent.saving\"},{\"code\":\"MNU_GCME_160300\",\"parentCode\":\"MNU_GCME_160000\",\"name\":\"menu.child.helpdesk\"},{\"code\":\"MNU_GCME_051400\",\"parentCode\":\"MNU_GCME_050000\",\"name\":\"menu.child.transactionupdate\"},{\"code\":\"MNU_GCME_130400\",\"parentCode\":\"MNU_GCME_040000\",\"name\":\"menu.child.transactionstatus\"},{\"code\":\"MNU_GCME_990901\",\"parentCode\":\"MNU_GCME_050000\",\"name\":\"menu.child.tocash\"},{\"code\":\"MNU_GCME_700000\",\"parentCode\":null,\"name\":\"menu.cardService\"},{\"code\":\"MNU_GCME_160000\",\"parentCode\":null,\"name\":\"menu.parent.preferences\"},{\"code\":\"MNU_GCME_051500\",\"parentCode\":\"MNU_GCME_050000\",\"name\":\"menu.child.overseamoneyreceive\"},{\"code\":\"MNU_GCME_780000\",\"parentCode\":null,\"name\":\"menu.parent.loans\"},{\"code\":\"MNU_GCME_780200\",\"parentCode\":\"MNU_GCME_780000\",\"name\":\"menu.child.onlineloan\"}],\"lastLogin\":\"2022-06-12 12:01:31\",\"ctryCd\":\"VN\",\"refNumber\":\"UWJZPM0IDLLWD7BK57VH\",\"createdDt\":1645795561000,\"isSoftToken\":\"UNREGISTERED\",\"softTokenList\":[{\"deviceNo\":\"D8D893AC51D8AFCDE0530D5C010A30F1\",\"custId\":\"D8D8945279FD48E5E0530E5C010A85F7\",\"deviceType\":\"sotp\",\"isDefault\":\"N\",\"clazz\":\"com.aprisma.product.gcm.common.model.AuthenticationDevice\",\"isReset\":null,\"isMtAssigned\":null,\"deviceId\":\"671bd3caa73b816935d9757fdd6aecbd9c40c7ab\",\"token\":\"MM66D74E74\",\"status\":\"0\",\"retry\":0,\"mobileDeviceId\":\"00000000-0000-0000-1086-edc374ff7394\",\"phoneId\":\"Galaxy A30s\",\"assignedDt\":null,\"userId\":null,\"activedOtp\":null,\"smsCount\":null,\"hashUserId\":null,\"bioId\":null,\"bioLevel\":null,\"dotpPin\":\"60616f663978719dbbad04dae8af97004b8ca0b9cd9e6c224fa1575a61f635e6\",\"pinUpdateDate\":\"25/02/2022 20:26:07\",\"hashDeviceNo\":null},{\"deviceNo\":\"DB47BE94A2528106E0530D5C010A2B2D\",\"custId\":\"D8D8945279FD48E5E0530E5C010A85F7\",\"deviceType\":\"sotp\",\"isDefault\":\"N\",\"clazz\":\"com.aprisma.product.gcm.common.model.AuthenticationDevice\",\"isReset\":null,\"isMtAssigned\":null,\"deviceId\":\"af276a70be0cfb998b8bc00c726b4bb227cbc486\",\"token\":\"FQ69DAEA26\",\"status\":\"0\",\"retry\":0,\"mobileDeviceId\":\"faff6920-3292-6238-8652-590312151108\",\"phoneId\":\"CPH1701\",\"assignedDt\":null,\"userId\":null,\"activedOtp\":null,\"smsCount\":null,\"hashUserId\":null,\"bioId\":null,\"bioLevel\":null,\"dotpPin\":\"733f300cfa06def9629d5e22e2ed667274fd0f88a6a9483a87cce3f636aac9c8\",\"pinUpdateDate\":\"28/03/2022 20:08:28\",\"hashDeviceNo\":null},{\"deviceNo\":\"DD1590233BC72181E0530D5C010A8E9A\",\"custId\":\"D8D8945279FD48E5E0530E5C010A85F7\",\"deviceType\":\"sotp\",\"isDefault\":\"N\",\"clazz\":\"com.aprisma.product.gcm.common.model.AuthenticationDevice\",\"isReset\":null,\"isMtAssigned\":null,\"deviceId\":\"c467c342fa8b5de098c946b8ace04a0c14f2176c\",\"token\":\"GCAC37F4F4\",\"status\":\"0\",\"retry\":0,\"mobileDeviceId\":\"00000000-0000-0000-662c-7c312d1715e0\",\"phoneId\":\"CPH2179\",\"assignedDt\":null,\"userId\":null,\"activedOtp\":null,\"smsCount\":null,\"hashUserId\":null,\"bioId\":null,\"bioLevel\":null,\"dotpPin\":\"60616f663978719dbbad04dae8af97004b8ca0b9cd9e6c224fa1575a61f635e6\",\"pinUpdateDate\":\"20/04/2022 19:12:51\",\"hashDeviceNo\":null},{\"deviceNo\":\"DDA4345341F55DF5E0530D5C010ACD07\",\"custId\":\"D8D8945279FD48E5E0530E5C010A85F7\",\"deviceType\":\"sotp\",\"isDefault\":\"N\",\"clazz\":\"com.aprisma.product.gcm.common.model.AuthenticationDevice\",\"isReset\":null,\"isMtAssigned\":null,\"deviceId\":\"7ca438e7086337d71c4e0de76abe10b74248bb27\",\"token\":\"AGCD6C72E4\",\"status\":\"0\",\"retry\":0,\"mobileDeviceId\":\"8d02f91a-3ffc-61e8-6525-903121511089\",\"phoneId\":\"CPH1701\",\"assignedDt\":null,\"userId\":null,\"activedOtp\":null,\"smsCount\":null,\"hashUserId\":null,\"bioId\":null,\"bioLevel\":null,\"dotpPin\":\"733f300cfa06def9629d5e22e2ed667274fd0f88a6a9483a87cce3f636aac9c8\",\"pinUpdateDate\":\"27/04/2022 21:11:25\",\"hashDeviceNo\":null},{\"deviceNo\":\"E11BB53F064AED05E0530E5C010A6173\",\"custId\":\"D8D8945279FD48E5E0530E5C010A85F7\",\"deviceType\":\"sotp\",\"isDefault\":\"N\",\"clazz\":\"com.aprisma.product.gcm.common.model.AuthenticationDevice\",\"isReset\":null,\"isMtAssigned\":null,\"deviceId\":\"61b8bf75692be554c832cd4f7fe78ade82048e7a\",\"token\":\"KNFACCA7E6\",\"status\":\"0\",\"retry\":0,\"mobileDeviceId\":\"e3d45a92-7177-54e8-8652-590312151108\",\"phoneId\":\"CPH1701\",\"assignedDt\":null,\"userId\":null,\"activedOtp\":null,\"smsCount\":null,\"hashUserId\":null,\"bioId\":null,\"bioLevel\":null,\"dotpPin\":\"733f300cfa06def9629d5e22e2ed667274fd0f88a6a9483a87cce3f636aac9c8\",\"pinUpdateDate\":\"11/06/2022 00:08:24\",\"hashDeviceNo\":null}],\"deviceId\":\"0000000-0000-0000-cacf-e2248f57a196\",\"authDevice\":null,\"isMBCust\":\"N\",\"promotionUserList\":[],\"isAcceptDigitalOTP\":\"N\",\"sectorDetail\":{\"Priority Sector\":\"1747|1746|1891|1890|1889|1888|1745\",\"Private sector\":\"1688|1689|1690|1691|1699|1741|1666\"},\"isOnlineSector\":\"Y\",\"smsCount\":null,\"idTypType\":\"CAN.CUOC.CD\",\"corpBook\":\"VN0010761\",\"isNeedUpdateLimit\":null,\"idExpiryDate\":null,\"biomatricAuthDeviceList\":[{\"deviceNo\":\"D8D855433F90AC2BE0530D5C010A1781\",\"custId\":\"D8D8945279FD48E5E0530E5C010A85F7\",\"deviceType\":\"biometric\",\"isDefault\":\"N\",\"clazz\":\"com.aprisma.product.gcm.common.model.AuthenticationDevice\",\"isReset\":null,\"isMtAssigned\":null,\"deviceId\":\"671bd3caa73b816935d9757fdd6aecbd9c40c7ab\",\"token\":null,\"status\":\"0\",\"retry\":0,\"mobileDeviceId\":null,\"phoneId\":null,\"assignedDt\":1645795564000,\"userId\":null,\"activedOtp\":null,\"smsCount\":null,\"hashUserId\":\"340e182b37c399d3bbedb339491add3264bf9e7e\",\"bioId\":\"d10cbe4b-f577-47ff-b117-a37fd12a42ef_671bd3caa73b816935d9757fdd6aecbd9c40c7ab_1645795089815\",\"bioLevel\":\"2\",\"dotpPin\":null,\"pinUpdateDate\":null,\"hashDeviceNo\":null}],\"inactiveReason\":null,\"defaultAccount\":{\"acctNo\":\"24200618066666\",\"acctAlias\":\"LE TUAN TAI \",\"acctNm\":\"LE TUAN TAI \",\"acctTypCd\":\"CA\",\"ccyCd\":\"VND\",\"custId\":\"D8D8945279FD48E5E0530E5C010A85F7\",\"hostCustId\":\"17537326\",\"inactiveSts\":\"0\",\"orgUnitCd\":\"VN0010761\",\"isCrdt\":\"Y\",\"isDebit\":\"Y\",\"isInq\":\"Y\",\"currentBalance\":null,\"isSync\":null,\"category\":\"1001\",\"productType\":\"TGTT\"},\"email2\":null,\"requestId\":null,\"addr3\":null,\"rcfromState\":\"00\",\"kyc\":null,\"idTypDtValue\":null}', '2022-06-12 12:01:43', '2022-06-12 12:11:58');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `mbbankauto`
--

CREATE TABLE `mbbankauto` (
  `id` int(11) NOT NULL,
  `account` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `accountno` varchar(255) DEFAULT NULL,
  `sitename` varchar(255) DEFAULT NULL,
  `balance` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `mbbankauto`
--

INSERT INTO `mbbankauto` (`id`, `account`, `password`, `accountno`, `sitename`, `balance`) VALUES
(2, '0398206564', '20062006@Tai', '24200618066666', 'LIKESUB.TAIMMO.NET', '0');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `note_thongbao`
--

CREATE TABLE `note_thongbao` (
  `id` int(11) NOT NULL,
  `nguoidang` varchar(999) NOT NULL,
  `noidung` text CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `date` varchar(999) NOT NULL,
  `url_config` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `note_thongbao`
--

INSERT INTO `note_thongbao` (`id`, `nguoidang`, `noidung`, `date`, `url_config`) VALUES
(2, 'adminkhanh', 'HỆ THỐNG BẢO TRÌ ĐẾN 05/06 VUI LÒNG QUAY LẠI SAU', '2022-06-04 08:43:55', 'LOCALHOST'),
(21, 'nhquang', 'xin chào mọi người !', '2022-05-12 19:48:52', 'LOCALHOST'),
(22, 'nhquang', 'AUTOVIET.PRO Hệ Thống Dịch Vụ Mạng Xã Hội Chất Lượng !', '2022-05-16 13:22:05', 'LOCALHOST'),
(24, 'demo_code', 'Mua Mã Nguồn Tại: https://www.facebook.com/taile.official.2006', '2022-05-20 19:49:27', 'LOCALHOST'),
(26, 'adminweb', 'Test', '2022-06-10 22:51:12', 'LOCALHOST'),
(27, 'adminne', 'TEST CODE', '2022-06-10 23:38:23', 'LOCALHOST'),
(28, 'adminne', 'Hello anh em. Chúc anh em sử dụng vui vẻ', '2022-06-11 14:47:06', 'LOCALHOST'),
(29, 'adminne', 'Code được mod và sửa bởi Tài Lê\r\nZalo: 0398206564', '2022-06-11 14:47:39', 'LOCALHOST'),
(30, 'adminne', 'Code được sửa bởi Tài', '2022-06-11 15:35:44', 'LOCALHOST');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `key` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `value` longtext COLLATE utf8_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `options`
--

INSERT INTO `options` (`id`, `key`, `value`) VALUES
(1, 'url_admin', 'LOCALHOST'),
(2, 'trang_thai_auto', 'ON'),
(3, 'token_auto_dvfb', 'eyJpdiI6IktGdWpvTDdzWnd3amhOeG5VdnI5Mnc9PSIsInZhbHVlIjoiWE44ckFyWXkxZnNTK3J3QjlEdytramU0cUFiTzFqOU9CTGExSXFzZmlzQ21XMmdkWkdUOEEvMVdEZnJpVFBzcmxJLzF6UzhraDhrZW9KM2FDaTIvTGZieVpqOVorQVQxYTF2T0Fmd2orZStwOHpSYmt4OTY4T2pGVTJjY212V01XWUdGZ3NlL21ObU5qWHcxNEhrYk5BPT0iLCJtYWMiOiI1NDhhMDFmNDM3MTg0ODBhNDI1NjQ4NTQyYjk2OTRlODA2ZmZjNGRiYzU4OTY0NDZmMTVmODViMzk3NTdmYTQxIiwidGFnIjoiIn0='),
(4, 'link_host', 'https://sng106.arandomserver.com:2083/cpsess1672226166/'),
(5, 'ip_host', '172.96.191.78'),
(6, 'username_host', 'ttaileml'),
(7, 'password_host', 'Az9Daily1964655707'),
(8, 'id_cloud_flare', 'ca47b16113a500aadb0d9b60c2762230'),
(9, 'key_cloud_flare', '07b3aa73f42846ad738267d98427fadd'),
(10, 'email_cloud_flare', 'cloudflare.luutru@gmail.com'),
(11, 'name_sv1', 'dee.ns.cloudflare.com'),
(12, 'name_sv2', 'trey.ns.cloudflare.com'),
(13, 'name_sv3', 'dee.ns.cloudflare.com'),
(14, 'name_sv4', 'trey.ns.cloudflare.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `server_service`
--

CREATE TABLE `server_service` (
  `id` int(11) NOT NULL,
  `code_service` varchar(999) DEFAULT NULL,
  `server_service` varchar(999) DEFAULT NULL,
  `rate_service` varchar(999) DEFAULT NULL,
  `title_service` text CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `server_name` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `status_service` int(11) DEFAULT NULL,
  `url_config` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `server_service`
--

INSERT INTO `server_service` (`id`, `code_service`, `server_service`, `rate_service`, `title_service`, `server_name`, `status_service`, `url_config`) VALUES
(116, 'like_post_sale', '9', '4', 'Like clone nuôi, max 1m5 like', '- Tốc độ ổn 1k -&gt; 3k/ngày, không hỗ trợ bài viết chia sẻ video, bài viết trong nhóm, bài viết hoặc video đang chạy ads.', 1, 'LOCALHOST'),
(117, 'sub_sale', '6', '6', 'Sv6 (Clone nuôi, max 1m5 sub, bảo hành 7 ngày)', 'Tốc độ ổn 1k -&gt; 3k/ngày, không bảo hành.', 1, 'LOCALHOST'),
(119, 'like_post', '9', '3', 'Like clone giá rẻ', '- Tốc độ chậm 1k - 2k/ngày, max 10k like, không bảo hành (có thể lên thiếu)', 1, 'LOCALHOST'),
(120, 'mat_live', '5', '5', 'abc', 'ưadsa', 1, 'LOCALHOST'),
(121, 'sub_vip', '3', '1.2', 'Sub dạng mới, cực bá, không hỗ trợ pro5, đang sale độc quyền tại Việt Nam', 'Tốc độ cực nhanh, gần như lên ngay sau 5s - 1h, max 2m / 1 ID Facebook, không chạy cho pro5.', 1, 'LOCALHOST'),
(122, 'sub_vip', '4', '0.98', 'Sub dạng mới, cực bá, không hỗ trợ pro5, đang sale độc quyền tại Việt Nam', 'Tốc độ cực nhanh, gần như lên ngay sau 5s - 1h, max 500k / 1 ID Facebook, mỗi ngày mua được 10 đơn, không chạy cho pro5.', 1, 'LOCALHOST');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `auth_otp` varchar(11) DEFAULT NULL,
  `partner_id` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `partner_key` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `facebook` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `token_facebook` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `id_page` longtext CHARACTER SET utf32 COLLATE utf32_vietnamese_ci DEFAULT NULL,
  `id_page_chat` varchar(32) CHARACTER SET armscii8 NOT NULL,
  `mail_config` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `pass_mail_config` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `base_url` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `url_site_con` varchar(99) NOT NULL,
  `cuphap` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `site_napthe` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `logo` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `trangthai_auto` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `full_name_admin` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `phone_zalo` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `rate_ctv` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `rate_daily` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `rate_admin` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `ten_website` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `logo_user` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `favicon` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `api_automm` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `callback_momo` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `script_live_chat` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `bao_tri` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `logo_mini` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `tu_khoa` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `anhbia` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `user_auto_dvfb` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `pass_auto_dvfb` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `ck_ctv` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `ck_dl` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `ck_npp` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `gioi_thieu_web` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `ck_user` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `thongbao` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `anh_thong_bao` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `ck_thecao` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `trang_thai_lam_tron` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `token_auto_dvfb` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `theme_home` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `theme_login` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `theme_landing` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `so_du_tao_site` int(11) NOT NULL,
  `so_tieu_tao_site` int(11) NOT NULL,
  `cap_bac_tao_site` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `status` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `bot_tele` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `id_chat_tele` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `thong_bao_mail` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `nap_km_bank` int(255) NOT NULL,
  `color_web` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `bg_header_site` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `bg_navbar_site` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `icon_color_site` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `text_color_site` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `modal_color` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `img_1` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `img_2` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `img_3` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `url_config` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `setting`
--

INSERT INTO `setting` (`id`, `auth_otp`, `partner_id`, `partner_key`, `facebook`, `token_facebook`, `id_page`, `id_page_chat`, `mail_config`, `pass_mail_config`, `base_url`, `url_site_con`, `cuphap`, `site_napthe`, `logo`, `trangthai_auto`, `full_name_admin`, `phone_zalo`, `rate_ctv`, `rate_daily`, `rate_admin`, `ten_website`, `logo_user`, `favicon`, `api_automm`, `callback_momo`, `script_live_chat`, `bao_tri`, `logo_mini`, `tu_khoa`, `anhbia`, `user_auto_dvfb`, `pass_auto_dvfb`, `ck_ctv`, `ck_dl`, `ck_npp`, `gioi_thieu_web`, `ck_user`, `thongbao`, `anh_thong_bao`, `ck_thecao`, `trang_thai_lam_tron`, `token_auto_dvfb`, `theme_home`, `theme_login`, `theme_landing`, `so_du_tao_site`, `so_tieu_tao_site`, `cap_bac_tao_site`, `status`, `bot_tele`, `id_chat_tele`, `thong_bao_mail`, `nap_km_bank`, `color_web`, `bg_header_site`, `bg_navbar_site`, `icon_color_site`, `text_color_site`, `modal_color`, `img_1`, `img_2`, `img_3`, `url_config`) VALUES
(1, 'OFF', '', '', 'https://www.facebook.com/dungkk.vl', 'EAABsbCS1iHgBAPoCuw3nJihpXGMgwqN5sMkwvojLLzTGC9fsuJP0hTvAZAwZCzfm02SedmBgHqXPZC9EI2ZCelfwilp32AfnQlPuuApogOhaxTI0RZAu3h8X8xLTezZA2BBUWwiCuu6USfDbruw5q7CxENn2oPGBAXSZA3NtbeYRnGVA2rl05ClYjZCppdZCx0EwZD', '100046543398712', '100073368032491', '', '', 'https://dvwebgame.info/', 'https://dvwebgame.info/', '', 'thesieure', 'https://upanh.cf/1fxxvf7pky.png', 'ON', 'Phạm Việt Dũng', '+84398206564', '100000', '5000000', '10000000', 'TAOWEBGAME.COM', 'https://ui-avatars.com/api/?background=random&name=', 'https://subgiare.vn/assets/images/favicon.ico', '1', 'https://NTIENDAT.CLICK/callback/callback_bank.php', '', 'ON', 'https://i.imgur.com/9yZhV9g.jpg', 'Like Sub Tai MMO, automxh, Tăng like Facebook, tuongtaccheo, traodoisub, tăng like, tăng follow facebook, tiktok, instagram, miễn phí, tương tác chéo, trao đổi sub. Hệ thống mua like uy tín, Tăng like giá rẻ , Dịch vụ tăng like tăng sub giá rẻ, tăng view video FB, Tăng người xem Livestream, tăng theo dõi, tăng like Facebook, tuongtaccheo, traodoisub, tăng like, tăng follow facebook, tiktok, instagram, miễn phí, tương tác chéo, trao đổi sub, giá rẻ đảm bảo uy tín, chất lượng...', 'https://skillking.fpt.edu.vn/wp-content/uploads/2021/04/social-media-marketing-gom-nhung-gi-cach-thuc-do-luong-hieu-qua-social-media-marketing.png', 'Để trống phần này với password', '', '7', '5', '2', 'Like Sub Tai MMO- Hệ Thống Dịch Vụ Mạng Xã Hội Chất Lượng !', '8', 'CODE BY TAOWEBGAME.COm', 'https://imgur.com/1Rw0ePu.png', '25', 'OFF', 'eyJpdiI6IktGdWpvTDdzWnd3amhOeG5VdnI5Mnc9PSIsInZhbHVlIjoiWE44ckFyWXkxZnNTK3J3QjlEdytramU0cUFiTzFqOU9CTGExSXFzZmlzQ21XMmdkWkdUOEEvMVdEZnJpVFBzcmxJLzF6UzhraDhrZW9KM2FDaTIvTGZieVpqOVorQVQxYTF2T0Fmd2orZStwOHpSYmt4OTY4T2pGVTJjY212V01XWUdGZ3NlL21ObU5qWHcxNEhrYk5BPT0iLCJtYWMiOiI1NDhhMDFmNDM3MTg0ODBhNDI1NjQ4NTQyYjk2OTRlODA2ZmZjNGRiYzU4OTY0NDZmMTVmODViMzk3NTdmYTQxIiwidGFnIjoiIn0=', '5', '', '2', 50000, 1, '1', 'active', '', '', 'ON', 0, 'dark', '', '', '', '', '', 'https://ngaocontent.com/wp-content/uploads/2020/11/Social-content-la-gi-2.jpg', 'https://i.imgur.com/bRHvcCN.png', 'https://prodima.vn/wp-content/uploads/2021/06/social-content-la-gi-chien-luoc-xay-dung-noi-dung-social-dinh-cao-1.jpg', 'DVWEBGAME.INFO');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thesieureauto`
--

CREATE TABLE `thesieureauto` (
  `id` int(11) NOT NULL,
  `account` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `cookie` text DEFAULT NULL,
  `sitename` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thong_bao_modal`
--

CREATE TABLE `thong_bao_modal` (
  `id` int(11) NOT NULL,
  `loai_tb` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `text_thong_bao` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `status` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `url_config` varchar(52) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `thong_bao_modal`
--

INSERT INTO `thong_bao_modal` (`id`, `loai_tb`, `text_thong_bao`, `status`, `url_config`) VALUES
(1, 'like_post', '', 'OFF', 'LIKESUB.TAIMMO.NET'),
(2, 'sub_sale', 'Hiện tại đang sale - tốc độ giữ nguyên. Hệ thống tự động cập nhật đơn', 'ON', 'LIKESUB.TAIMMO.NET'),
(3, 'cx_post', '', 'OFF', 'LIKESUB.TAIMMO.NET'),
(4, 'cmt', '', 'OFF', 'LIKESUB.TAIMMO.NET'),
(5, 'like_page_sale', '', 'OFF', 'LIKESUB.TAIMMO.NET'),
(6, 'share', '', 'OFF', 'LIKESUB.TAIMMO.NET'),
(7, 'mat_live', '', 'OFF', 'LIKESUB.TAIMMO.NET'),
(8, 'view_video', '', 'OFF', 'LIKESUB.TAIMMO.NET'),
(9, 'like_cmt', '', 'OFF', 'LIKESUB.TAIMMO.NET'),
(10, 'view_story', '', 'OFF', 'LIKESUB.TAIMMO.NET'),
(11, 'mem_gr', '', 'OFF', 'LIKESUB.TAIMMO.NET'),
(12, 'like_ins', '', 'OFF', 'LIKESUB.TAIMMO.NET'),
(13, 'cmt_ins', '', 'OFF', 'LIKESUB.TAIMMO.NET'),
(14, 'sub_ins', '', 'OFF', 'LIKESUB.TAIMMO.NET'),
(15, 'like_tiktok', '', 'OFF', 'LIKESUB.TAIMMO.NET'),
(16, 'cmt_tiktok', '', 'OFF', 'LIKESUB.TAIMMO.NET'),
(17, 'sub_tiktok', '', 'OFF', 'LIKESUB.TAIMMO.NET'),
(18, 'sub_youtube', '', 'OFF', 'LIKESUB.TAIMMO.NET'),
(19, 'like_youtube', '', 'OFF', 'LIKESUB.TAIMMO.NET'),
(20, 'nap_the', 'Tốc độ nạp momo đang mượt, khuyên nạp Momo.Bank dễ bị delay, quá 1h inbox Admin để được suport', 'ON', ''),
(41, 'like_post', '', 'OFF', 'LOCALHOST'),
(42, 'sub_sale', 'Sale mạnh', 'ON', 'LOCALHOST'),
(43, 'cx_post', '', 'OFF', 'LOCALHOST'),
(44, 'cmt', '', 'OFF', 'LOCALHOST'),
(45, 'like_page_sale', '', 'OFF', 'LOCALHOST'),
(46, 'share', '', 'OFF', 'LOCALHOST'),
(47, 'mat_live', '', 'OFF', 'LOCALHOST'),
(48, 'view_video', '', 'OFF', 'LOCALHOST'),
(49, 'like_cmt', '', 'OFF', 'LOCALHOST'),
(50, 'view_story', '', 'OFF', 'LOCALHOST'),
(51, 'mem_gr', '', 'OFF', 'LOCALHOST'),
(52, 'like_ins', '', 'OFF', 'LOCALHOST'),
(53, 'cmt_ins', '', 'OFF', 'LOCALHOST'),
(54, 'sub_ins', '', 'OFF', 'LOCALHOST'),
(55, 'like_tiktok', '', 'OFF', 'LOCALHOST'),
(56, 'cmt_tiktok', '', 'OFF', 'LOCALHOST'),
(57, 'sub_tiktok', '', 'OFF', 'LOCALHOST'),
(58, 'sub_youtube', '', 'OFF', 'LOCALHOST'),
(59, 'like_youtube', '', 'OFF', 'LOCALHOST'),
(60, 'nap_the', '', 'OFF', 'LOCALHOST');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(999) DEFAULT NULL,
  `name` text CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `password` varchar(999) DEFAULT NULL,
  `email` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `token` varchar(999) DEFAULT NULL,
  `capbac` varchar(999) DEFAULT NULL,
  `money` varchar(999) DEFAULT NULL,
  `tongnap` varchar(999) DEFAULT NULL,
  `tongtru` varchar(999) DEFAULT NULL,
  `banned` varchar(999) DEFAULT NULL,
  `time_banned` varchar(999) DEFAULT NULL,
  `ip` varchar(999) DEFAULT NULL,
  `cuphap` varchar(999) DEFAULT NULL,
  `date` varchar(999) DEFAULT NULL,
  `lastdate` varchar(999) DEFAULT NULL,
  `otp_code` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `status_account` varchar(11) DEFAULT NULL,
  `url_config` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `password`, `email`, `token`, `capbac`, `money`, `tongnap`, `tongtru`, `banned`, `time_banned`, `ip`, `cuphap`, `date`, `lastdate`, `otp_code`, `status_account`, `url_config`) VALUES
(19, 'adminweb', 'Lê Tuấn Tài', 'd39834f4c70b0700acbd9ae68a6b41ad', 'thattinh14122@gmail.com', 'eyJhbGciOrmcPPcjlwbjQEUQQJBgjOxnamTqHtPKnTczSYLOzphPWIdxXTnnclOVWRlmkNgUlhAIoDjuIERQGYxishWbkZyOkvbkCfexTFYRM1656414273ZjdhYjNkMjE2Y2M5NTFmNmFlYmU5MDQyMmQ2NDc1NjA==', '99', '9978200', '10000000', '10021800', '0', NULL, '', 'NAPTIEN_ adminweb', '2022-06-10 09:46:53', '2022-06-29 22:13:13', '', NULL, 'LOCALHOST'),
(90, 'tai2k6ne', 'Tài Lê Tuấn', '658fac7dea5202db8cba72e54f4dc564', 'taihhbg200@gmail.com', 'eyJhbGciOrmUnTdWVEjUIcIWgxgxvREvzoQkYRzlTcjPgQzWkpSPPAFbJhZkfPbeRGvblhtOYKqlkUHmngEbYcuxOivBXOnWhRzjOmTNaEywI1656516225MzljNGM2Y2VjNmFmZmNiZThkODEwMTdiMTdiNTI0NzI==', '0', '0', '0', '0', '0', NULL, '::1', 'TAIMMO tai2k6ne', '2022-06-29 22:23:45', NULL, '631528', 'wait', 'LOCALHOST'),
(91, 'taowebgame', 'taowebgame', '1ce5b81c876738e4777f30ee2638781e', 'taowebgame@taowebgame.com', 'eyJhbGciOaOngTvgqzmyEtARpQhZOmDObfhVogzELPkjlHEmekIbPccMhjrWlFQIWcWnTjmlXNCBlQUnRhbYKusgnPYIJEdUUYvYvkGxbjkxz1657200922YzcwZmIyZTI0YTBlMzdiMjZiYTgxZjFjNTMyNjEwYTk==', '0', '0', '0', '0', '0', NULL, '123.26.170.8', 'TAIMMO taowebgame', '2022-07-07 20:35:22', NULL, '', '', 'DVWEBGAME.INFO');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `band_ip`
--
ALTER TABLE `band_ip`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `cron_momo`
--
ALTER TABLE `cron_momo`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `device`
--
ALTER TABLE `device`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ds_sitecon`
--
ALTER TABLE `ds_sitecon`
  ADD PRIMARY KEY (`id_site`);

--
-- Chỉ mục cho bảng `history_buy`
--
ALTER TABLE `history_buy`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `history_naptien`
--
ALTER TABLE `history_naptien`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `list_api`
--
ALTER TABLE `list_api`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `list_hotro`
--
ALTER TABLE `list_hotro`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `log_site`
--
ALTER TABLE `log_site`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `mbbank`
--
ALTER TABLE `mbbank`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `mbbankauto`
--
ALTER TABLE `mbbankauto`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `note_thongbao`
--
ALTER TABLE `note_thongbao`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `server_service`
--
ALTER TABLE `server_service`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `thesieureauto`
--
ALTER TABLE `thesieureauto`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `thong_bao_modal`
--
ALTER TABLE `thong_bao_modal`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `band_ip`
--
ALTER TABLE `band_ip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `cron_momo`
--
ALTER TABLE `cron_momo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `device`
--
ALTER TABLE `device`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `ds_sitecon`
--
ALTER TABLE `ds_sitecon`
  MODIFY `id_site` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `history_buy`
--
ALTER TABLE `history_buy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `history_naptien`
--
ALTER TABLE `history_naptien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `list_api`
--
ALTER TABLE `list_api`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `list_hotro`
--
ALTER TABLE `list_hotro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `log_site`
--
ALTER TABLE `log_site`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT cho bảng `mbbank`
--
ALTER TABLE `mbbank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `mbbankauto`
--
ALTER TABLE `mbbankauto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `note_thongbao`
--
ALTER TABLE `note_thongbao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `server_service`
--
ALTER TABLE `server_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT cho bảng `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `thesieureauto`
--
ALTER TABLE `thesieureauto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `thong_bao_modal`
--
ALTER TABLE `thong_bao_modal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
