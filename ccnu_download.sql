-- phpMyAdmin SQL Dump
-- version 3.5.3
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2012 年 12 月 12 日 10:27
-- 服务器版本: 5.0.91-community-nt
-- PHP 版本: 5.2.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `ccnu_download`
--

-- --------------------------------------------------------

--
-- 表的结构 `cd_admin`
--

CREATE TABLE IF NOT EXISTS `cd_admin` (
  `ID` bigint(6) unsigned NOT NULL auto_increment,
  `admin_name` varchar(16) NOT NULL,
  `admin_pass` varchar(64) NOT NULL default '49ba59abbe56e057' COMMENT 'MD5 16进制加密',
  PRIMARY KEY  (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `cd_admin`
--

INSERT INTO `cd_admin` (`ID`, `admin_name`, `admin_pass`) VALUES
(1, 'cd-admin', 'dbbea736b90d78c7d4fc69085acccdba'),
(2, 'lexuxin', 'ac2a778453a36dd52ca4a830da6b3f8c'),
(3, 'ccnu', '6f4ce50f0c5c5708a898848f0fae024b'),
(4, 'nanpuyue', 'e581e2943826b1ba3d7caf45d4d041d3'),
(7, 'itccnu', '362f0eba550eca6b2b1ea8918a84e5cf');

-- --------------------------------------------------------

--
-- 表的结构 `cd_comments`
--

CREATE TABLE IF NOT EXISTS `cd_comments` (
  `com_id` bigint(6) unsigned NOT NULL auto_increment,
  `user_num` bigint(8) unsigned default NULL,
  `user_name` varchar(12) character set utf8 NOT NULL,
  `com_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `com_text` text character set utf8 NOT NULL,
  `soft_id` bigint(6) unsigned NOT NULL,
  PRIMARY KEY  (`com_id`),
  KEY `FK_soft_ids` (`soft_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=armscii8 AUTO_INCREMENT=19 ;

--
-- 转存表中的数据 `cd_comments`
--

INSERT INTO `cd_comments` (`com_id`, `user_num`, `user_name`, `com_time`, `com_text`, `soft_id`) VALUES
(2, 2009213640, '小胖', '2012-11-23 18:44:38', '2L 是SB', 40),
(3, 2009213663, '猪猪侠', '0000-00-00 00:00:00', '猪猪侠无敌 猪猪侠威武 猪猪侠爱打广告', 40),
(4, 2009213663, '斯蒂芬', '0000-00-00 00:00:00', '最复杂的斯蒂芬', 40),
(7, 2009213663, '时间仔', '2012-11-24 02:50:11', '看看时间对不对', 40),
(8, 2009213663, '我是酱油瓶', '2012-11-24 02:31:24', '我可以留言吗 可以吗？', 40),
(9, 2009213663, '胡一刀', '2012-11-24 02:46:13', '抢个沙发~', 41),
(13, 2009213663, '我晕', '2012-12-07 08:14:02', '这个太差了', 42),
(17, 2009213663, '啊啊', '2012-12-08 12:02:26', '啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊', 40),
(18, 2009213663, 'alvin', '2012-12-10 10:45:30', '= =(凑字数)', 42);

-- --------------------------------------------------------

--
-- 表的结构 `cd_downlog`
--

CREATE TABLE IF NOT EXISTS `cd_downlog` (
  `ID` bigint(6) unsigned NOT NULL auto_increment,
  `downer_ip` char(16) NOT NULL default '000.000.000.000',
  `down_time` datetime default '0000-00-00 00:00:00',
  `down_soft` bigint(6) unsigned NOT NULL,
  `downer_bs` varchar(20) NOT NULL,
  `downer_os` varchar(20) NOT NULL,
  `down_speed` int(6) unsigned default NULL COMMENT '单位:KB/s',
  `soft_appraise` tinyint(1) NOT NULL default '0' COMMENT '踩:-1 缺省:0 顶:1',
  `soft_viru` tinyint(1) unsigned NOT NULL default '0' COMMENT '举报有毒:1 缺省:0',
  `soft_null` tinyint(1) unsigned NOT NULL default '0' COMMENT '举报无效:1 缺省:0',
  PRIMARY KEY  (`ID`),
  KEY `down_soft` (`down_soft`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=103 ;

--
-- 转存表中的数据 `cd_downlog`
--

INSERT INTO `cd_downlog` (`ID`, `downer_ip`, `down_time`, `down_soft`, `downer_bs`, `downer_os`, `down_speed`, `soft_appraise`, `soft_viru`, `soft_null`) VALUES
(1, '127.0.0.1', '0000-00-00 00:00:00', 40, 'Chrome', 'Linux', NULL, 0, 0, 0),
(26, '127.0.0.1', '2012-11-24 01:57:15', 40, 'Chrome', 'Linux', NULL, 1, 0, 0),
(27, '10.144.113.240', '2012-11-24 03:04:51', 40, 'Chrome', 'Linux', NULL, 1, 0, 0),
(28, '10.144.113.240', '2012-11-24 04:28:01', 40, 'Chrome', 'Linux', NULL, 0, 0, 0),
(29, '10.144.113.240', '2012-11-24 04:28:04', 40, 'Chrome', 'Linux', NULL, 0, 0, 0),
(30, '218.199.196.7', '2012-11-24 06:05:22', 40, 'Chrome', 'Windows 2003', NULL, 1, 0, 0),
(31, '10.144.84.143', '2012-11-25 07:56:20', 40, 'Internet Explorer', 'Windows XP', NULL, 0, 0, 0),
(32, '10.144.84.143', '2012-11-25 07:58:34', 40, 'Chrome', 'Windows XP', NULL, 0, 0, 0),
(33, '10.144.84.143', '2012-11-25 07:59:15', 40, 'Firefox', 'Windows XP', NULL, 0, 0, 0),
(34, '10.144.84.143', '2012-11-25 07:59:24', 40, 'Internet Explorer', 'Windows XP', NULL, 0, 0, 0),
(35, '218.199.196.7', '2012-11-26 09:37:14', 41, 'Internet Explorer', 'Windows 2003', NULL, 1, 0, 0),
(36, '10.144.82.107', '2012-11-26 09:52:48', 41, 'Chrome', 'Linux', NULL, 0, 0, 0),
(37, '10.144.82.107', '2012-11-26 09:52:51', 41, 'Chrome', 'Linux', NULL, 0, 0, 0),
(38, '10.144.82.107', '2012-11-26 09:52:53', 41, 'Chrome', 'Linux', NULL, 0, 0, 0),
(39, '218.199.196.7', '2012-11-26 12:19:49', 42, 'Internet Explorer', 'Windows 2003', NULL, 0, 0, 0),
(40, '218.199.196.7', '2012-11-26 12:19:52', 42, 'Internet Explorer', 'Windows 2003', NULL, 1, 0, 0),
(41, '202.114.40.44', '2012-11-26 12:19:59', 40, 'Internet Explorer', 'Windows XP', NULL, -1, 0, 0),
(42, '202.114.40.44', '2012-11-26 12:20:27', 40, 'Internet Explorer', 'Windows XP', NULL, 0, 0, 0),
(43, '202.114.40.44', '2012-11-26 12:20:30', 40, 'Internet Explorer', 'Windows XP', NULL, 0, 0, 0),
(44, '202.114.40.44', '2012-11-26 12:20:38', 40, 'Internet Explorer', 'Windows XP', NULL, 0, 0, 0),
(45, '218.199.196.7', '2012-11-26 12:24:13', 42, 'Internet Explorer', 'Windows 2003', NULL, 0, 0, 0),
(46, '202.114.40.44', '2012-11-26 12:24:23', 40, 'Internet Explorer', 'Windows XP', NULL, 0, 0, 0),
(47, '218.199.196.7', '2012-11-26 12:25:04', 40, 'Chrome', 'Windows 2003', NULL, 0, 0, 0),
(48, '218.199.196.7', '2012-11-26 12:26:31', 40, 'Chrome', 'Windows 2003', NULL, 0, 0, 0),
(49, '218.199.196.7', '2012-11-26 12:26:46', 42, 'Internet Explorer', 'Windows 2003', NULL, 0, 0, 0),
(50, '202.114.40.44', '2012-11-26 12:26:53', 40, 'Internet Explorer', 'Windows XP', NULL, 0, 0, 0),
(51, '202.114.40.44', '2012-11-26 12:27:04', 40, 'Internet Explorer', 'Windows XP', NULL, 0, 0, 0),
(52, '218.199.196.7', '2012-11-26 12:27:32', 40, 'Chrome', 'Windows 2003', NULL, 1, 0, 0),
(53, '202.114.40.44', '2012-11-26 12:29:16', 40, 'Internet Explorer', 'Windows XP', NULL, 0, 0, 0),
(54, '202.114.40.44', '2012-11-26 12:29:23', 41, 'Internet Explorer', 'Windows XP', NULL, 0, 0, 0),
(55, '202.114.40.44', '2012-11-26 12:29:28', 41, 'Internet Explorer', 'Windows XP', NULL, 0, 0, 0),
(56, '202.114.40.44', '2012-11-26 12:29:33', 42, 'Internet Explorer', 'Windows XP', NULL, 0, 0, 0),
(57, '218.199.196.7', '2012-11-26 12:30:01', 42, 'Internet Explorer', 'Windows 2003', NULL, 0, 0, 0),
(58, '218.199.196.7', '2012-11-26 12:30:05', 40, 'Chrome', 'Windows 2003', NULL, 0, 0, 0),
(59, '218.199.196.7', '2012-11-26 12:30:08', 42, 'Chrome', 'Windows 2003', NULL, 1, 0, 0),
(60, '218.199.196.7', '2012-11-26 12:30:14', 41, 'Chrome', 'Windows 2003', NULL, 0, 0, 0),
(61, '202.114.40.44', '2012-11-26 12:32:20', 40, 'Internet Explorer', 'Windows XP', NULL, 0, 0, 0),
(62, '202.114.40.44', '2012-11-26 12:32:25', 40, 'Internet Explorer', 'Windows XP', NULL, 0, 0, 0),
(63, '202.114.40.44', '2012-11-26 12:32:30', 40, 'Internet Explorer', 'Windows XP', NULL, 0, 0, 0),
(64, '202.114.40.44', '2012-11-26 12:32:59', 40, 'Internet Explorer', 'Windows XP', NULL, 0, 0, 0),
(65, '218.199.196.7', '2012-11-26 12:33:34', 41, 'Internet Explorer', 'Windows 2003', NULL, 0, 0, 0),
(66, '218.199.196.7', '2012-11-26 12:35:03', 41, 'Chrome', 'Windows 2003', NULL, 0, 0, 0),
(67, '218.199.196.7', '2012-11-26 12:35:09', 41, 'Chrome', 'Windows 2003', NULL, 0, 0, 0),
(68, '218.199.196.7', '2012-11-26 12:35:20', 41, 'Chrome', 'Windows 2003', NULL, 0, 0, 0),
(69, '202.114.40.44', '2012-11-26 12:36:45', 40, 'Internet Explorer', 'Windows XP', NULL, 0, 0, 0),
(70, '202.114.40.44', '2012-11-26 12:36:49', 40, 'Internet Explorer', 'Windows XP', NULL, 0, 0, 0),
(71, '202.114.40.44', '2012-11-26 12:36:52', 40, 'Internet Explorer', 'Windows XP', NULL, 0, 0, 0),
(72, '202.114.40.44', '2012-11-26 12:36:54', 40, 'Internet Explorer', 'Windows XP', NULL, 0, 0, 0),
(73, '202.114.40.44', '2012-11-26 12:37:02', 40, 'Internet Explorer', 'Windows XP', NULL, 0, 0, 0),
(74, '202.114.40.44', '2012-11-26 12:37:06', 40, 'Internet Explorer', 'Windows XP', NULL, 0, 0, 0),
(75, '202.114.40.44', '2012-11-26 12:40:14', 40, 'Internet Explorer', 'Windows XP', NULL, 0, 0, 0),
(76, '202.114.40.44', '2012-11-26 12:40:20', 41, 'Internet Explorer', 'Windows XP', NULL, 0, 0, 0),
(77, '202.114.40.44', '2012-11-26 12:40:27', 42, 'Internet Explorer', 'Windows XP', NULL, 0, 0, 0),
(78, '202.114.40.44', '2012-11-26 12:40:38', 42, 'Internet Explorer', 'Windows XP', NULL, 0, 0, 0),
(79, '10.144.84.143', '2012-11-26 11:13:55', 40, 'Internet Explorer', 'Windows XP', NULL, 0, 0, 0),
(80, '192.168.161.90', '2012-11-27 10:06:37', 40, 'Internet Explorer', 'Unknown Windows OS', NULL, 0, 0, 0),
(81, '192.168.161.90', '2012-11-27 10:06:55', 40, 'Internet Explorer', 'Unknown Windows OS', NULL, 0, 0, 0),
(82, '192.168.161.90', '2012-11-27 11:35:51', 40, 'Internet Explorer', 'Unknown Windows OS', NULL, 0, 0, 0),
(83, '192.168.161.90', '2012-11-27 11:36:11', 40, 'Internet Explorer', 'Unknown Windows OS', NULL, 0, 0, 0),
(84, '192.168.161.90', '2012-11-27 11:36:44', 40, 'Internet Explorer', 'Unknown Windows OS', NULL, 0, 0, 0),
(85, '192.168.161.90', '2012-11-27 11:37:00', 40, 'Internet Explorer', 'Unknown Windows OS', NULL, 0, 0, 0),
(86, '202.114.40.48', '2012-11-27 12:42:57', 40, 'Chrome', 'Windows XP', NULL, 1, 0, 0),
(87, '192.168.128.177', '2012-11-27 08:44:20', 42, 'Internet Explorer 10', 'Unknown Windows OS', NULL, 0, 0, 0),
(88, '192.168.128.177', '2012-11-27 09:14:48', 42, 'Internet Explorer 10', 'Unknown Windows OS', NULL, -1, 0, 0),
(89, '192.168.128.177', '2012-11-27 09:55:09', 41, 'Internet Explorer 10', 'Windows 8', NULL, 1, 0, 0),
(90, '218.199.196.7', '2012-11-28 07:40:35', 40, 'Chrome 23.0.1271.64', 'Windows 2003', NULL, 1, 0, 0),
(91, '10.144.83.188', '2012-12-03 07:58:39', 40, 'Chrome 23.0.1271.64', 'Linux', NULL, 1, 0, 0),
(92, '10.144.83.188', '2012-12-03 07:59:06', 42, 'Chrome 23.0.1271.64', 'Linux', NULL, 1, 0, 0),
(93, '10.144.82.135', '2012-12-07 08:28:04', 45, 'Chrome 23.0.1271.95', 'Linux', NULL, -1, 0, 0),
(94, '10.144.82.135', '2012-12-07 08:28:40', 45, 'Chrome 23.0.1271.95', 'Linux', NULL, 1, 0, 0),
(95, '10.144.84.143', '2012-12-07 11:57:21', 46, 'Firefox 17.0', 'Windows XP', NULL, 0, 0, 0),
(96, '10.144.84.143', '2012-12-07 11:59:24', 47, 'Chrome 16.0.912.63', 'Windows XP', NULL, 0, 0, 0),
(97, '10.144.84.143', '2012-12-08 12:01:24', 47, 'Chrome 16.0.912.63', 'Windows XP', NULL, 0, 0, 0),
(98, '10.144.84.143', '2012-12-08 12:01:28', 47, 'Chrome 16.0.912.63', 'Windows XP', NULL, 0, 0, 0),
(99, '10.144.82.135', '2012-12-08 12:48:52', 45, 'Chrome 23.0.1271.95', 'Linux', NULL, 0, 0, 0),
(100, '192.168.130.40', '2012-12-10 06:03:09', 42, 'Internet Explorer 6.', 'Windows XP', NULL, 0, 0, 0),
(102, '10.144.115.233', '2012-12-10 10:51:49', 42, 'Chrome 22.0.1229.94', 'Windows 7', NULL, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `cd_softs`
--

CREATE TABLE IF NOT EXISTS `cd_softs` (
  `ID` bigint(6) unsigned NOT NULL auto_increment,
  `soft_name` varchar(40) NOT NULL,
  `soft_url` varchar(100) NOT NULL COMMENT '需以 http:// 开头',
  `term_id` bigint(6) unsigned NOT NULL,
  `tag_id` bigint(6) unsigned NOT NULL,
  `post_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `soft_description` text NOT NULL,
  `soft_size` int(8) unsigned NOT NULL COMMENT '单位:KB',
  `soft_os` varchar(30) NOT NULL,
  `soft_img` varchar(40) default NULL COMMENT '需以 http:// 开头',
  `down_count` bigint(6) unsigned NOT NULL default '0',
  `downer_top_count` bigint(6) NOT NULL default '0' COMMENT '被顶次数',
  `downer_down_count` bigint(6) NOT NULL default '0' COMMENT '被踩次数',
  `downer_viru_count` bigint(6) unsigned NOT NULL default '0' COMMENT '被报毒次数',
  `downer_null_count` bigint(6) unsigned NOT NULL default '0' COMMENT '报告文件无效次数',
  PRIMARY KEY  (`ID`),
  KEY `FK_softs_terms` (`term_id`),
  KEY `FK_softs_tags` (`tag_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=50 ;

--
-- 转存表中的数据 `cd_softs`
--

INSERT INTO `cd_softs` (`ID`, `soft_name`, `soft_url`, `term_id`, `tag_id`, `post_time`, `soft_description`, `soft_size`, `soft_os`, `soft_img`, `down_count`, `downer_top_count`, `downer_down_count`, `downer_viru_count`, `downer_null_count`) VALUES
(40, '一键Ghost', 'cd-resource/53/20121117151347_9565.zip', 53, 213, '2012-11-17 15:13:47', '一键还原精灵，是一款傻瓜式的系统备份和还原工具。它具有安全、快速、保密性强、压缩率高、兼容性好等特点，特别适合电脑新手和担心操作麻烦的人使用。', 254688, 'win', 'cd-resource/53/20121117151347_9565.jpg', 54, 15, 8, 0, 0),
(41, '驱动精灵2012 SP5 6.1.1018 官方版', 'cd-resource/53/20121117152459_4446.zip', 53, 213, '2012-11-17 15:24:59', '<span style="color: rgb(119, 119, 119); font-family: 宋体; font-size: 12px; line-height: 24px; background-color: rgb(255, 255, 255);">驱动精灵2012官方版革命性的新增了硬件设备问题判别的功能与相应算法，驱动精灵2012官方版幅增强了硬件识别能力，本站提供驱动精灵2012官网下载。</span>', 254688, 'win', 'cd-resource/53/20121117152459_4446.jpg', 13, 2, 0, 0, 0),
(42, 'Windows优化大师 免费版 7.99 官方正式版', 'cd-resource/53/20121117152638_2663.zip', 53, 198, '2012-11-17 15:26:38', '<span style="color: rgb(119, 119, 119); font-family: 宋体; font-size: 12px; line-height: 22px; background-color: rgb(255, 255, 255);">Windows优化大师是功能强大的Windows系统优化辅助软件，Windows优化大师提供全面有效且简便安全的系统优化，本站提供优化大师免费下载、优化大师官方下载。</span>', 254688, 'win', 'cd-resource/53/20121117152638_2663.png', 14, 3, 1, 0, 0),
(45, 'QQ', 'cd-resource/52/20121207202335_6160.jpg', 52, 193, '2012-12-07 20:23:35', '啊啊啊啊', 107957, 'win', NULL, 3, 1, 1, 0, 0),
(46, '1234', 'cd-resource/56/20121207235227_6465.txt', 56, 203, '2012-12-07 23:52:27', 'rrrrr', 3, 'dddd', NULL, 1, 0, 0, 0, 0),
(47, 'http', 'cd-resource/57/20121207235811_8398.jpg', 57, 207, '2012-12-07 23:58:11', 'hhh', 15904, 'xp', 'cd-resource/57/20121207235811_8398.jpg', 3, 0, 0, 0, 0),
(48, 'Notepad++ 6.2.2 官方正式版', 'cd-resource/58/20121208000211_7843.zip', 58, 209, '2012-12-08 00:02:11', '<div>Notepad++ 是在微軟視窗環境之下的一個免費的代碼編輯器。</div><div>了產生小巧且有效率的代碼編輯器，這個在 GPL 許可證下的自由軟體開發專案採用 win32 api 和 STL 以 C++ 程式語言撰寫成，並且選用功能強大的編輯模組 Scintilla.</div><div>藉由加強與優化許多函數及演算法，Notepad++ 致力於減少世界二氧化碳的排放。當使</div><div>用較少的 CPU 功率，降低電腦系統能源消耗，Notepad++ 間接造就了綠化的環境。多虧它的輕巧與執行效率，Notepad++ 可完美地取代微軟視窗的記事本。</div>', 50688, 'windows', 'cd-resource/58/20121208000211_7843.png', 0, 0, 0, 0, 0),
(49, '上传测试', 'cd-resource/58/20121210212116_1752.psd', 58, 209, '2012-12-10 21:21:16', '&nbsp;水水水水水', 2328243, 'Win', 'cd-resource/58/20121210212116_1752.jpg', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `cd_tags`
--

CREATE TABLE IF NOT EXISTS `cd_tags` (
  `tag_id` bigint(6) unsigned NOT NULL auto_increment,
  `tag_name` varchar(10) NOT NULL,
  `tag_rank` bigint(6) unsigned NOT NULL,
  `tag_parent` bigint(6) unsigned NOT NULL,
  `down_count` bigint(6) unsigned NOT NULL default '0',
  PRIMARY KEY  (`tag_id`),
  KEY `FK_tags_terms` (`tag_parent`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=214 ;

--
-- 转存表中的数据 `cd_tags`
--

INSERT INTO `cd_tags` (`tag_id`, `tag_name`, `tag_rank`, `tag_parent`, `down_count`) VALUES
(191, '音乐播放软件', 2, 49, 0),
(193, '国内聊天软件', 1, 52, 3),
(194, '国外聊天软件', 2, 52, 0),
(195, '音乐下载软件', 1, 49, 5),
(198, '提速用的', 2, 53, 26),
(201, '专业画图软件', 1, 55, 0),
(202, '普通画图软件', 2, 55, 0),
(203, '免费杀毒软件', 1, 56, 3),
(204, '收费杀毒软件', 3, 56, 0),
(205, '国产杀毒软件', 2, 56, 0),
(206, '国外杀毒软件', 4, 56, 0),
(207, '校园网客户端', 1, 57, 3),
(208, '修电脑的', 3, 53, 7),
(209, 'windows', 1, 58, 0),
(213, '装电脑的', 1, 53, 60);

-- --------------------------------------------------------

--
-- 表的结构 `cd_terms`
--

CREATE TABLE IF NOT EXISTS `cd_terms` (
  `term_id` bigint(6) unsigned NOT NULL auto_increment,
  `term_name` varchar(10) NOT NULL,
  `term_rank` bigint(6) unsigned NOT NULL,
  `down_count` bigint(6) unsigned NOT NULL,
  PRIMARY KEY  (`term_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=60 ;

--
-- 转存表中的数据 `cd_terms`
--

INSERT INTO `cd_terms` (`term_id`, `term_name`, `term_rank`, `down_count`) VALUES
(49, '聊天工具', 7, 5),
(52, '学习天地', 2, 3),
(53, '系统工具', 1, 91),
(55, '网络安全', 4, 0),
(56, '媒体工具', 6, 3),
(57, '驱动下载', 3, 3),
(58, '网络工具', 4, 0),
(59, '缓存测试', 1, 0);

--
-- 限制导出的表
--

--
-- 限制表 `cd_comments`
--
ALTER TABLE `cd_comments`
  ADD CONSTRAINT `FK_soft_ids` FOREIGN KEY (`soft_id`) REFERENCES `cd_softs` (`ID`);

--
-- 限制表 `cd_downlog`
--
ALTER TABLE `cd_downlog`
  ADD CONSTRAINT `FK_soft_id` FOREIGN KEY (`down_soft`) REFERENCES `cd_softs` (`ID`);

--
-- 限制表 `cd_softs`
--
ALTER TABLE `cd_softs`
  ADD CONSTRAINT `FK_softs_tags` FOREIGN KEY (`tag_id`) REFERENCES `cd_tags` (`tag_id`),
  ADD CONSTRAINT `FK_softs_terms` FOREIGN KEY (`term_id`) REFERENCES `cd_terms` (`term_id`);

--
-- 限制表 `cd_tags`
--
ALTER TABLE `cd_tags`
  ADD CONSTRAINT `FK_tags_terms` FOREIGN KEY (`tag_parent`) REFERENCES `cd_terms` (`term_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
