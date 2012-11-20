-- phpMyAdmin SQL Dump
-- version 3.5.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 19, 2012 at 09:40 PM
-- Server version: 5.5.28-0ubuntu0.12.10.1
-- PHP Version: 5.4.6-1ubuntu1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ccnu_download`
--

-- --------------------------------------------------------

--
-- Table structure for table `cd_admin`
--

CREATE TABLE IF NOT EXISTS `cd_admin` (
  `ID` bigint(6) unsigned NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(16) NOT NULL,
  `admin_pass` varchar(64) NOT NULL DEFAULT '49ba59abbe56e057' COMMENT 'MD5 16进制加密',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `cd_admin`
--

INSERT INTO `cd_admin` (`ID`, `admin_name`, `admin_pass`) VALUES
(1, 'cd-admin', 'dbbea736b90d78c7d4fc69085acccdba'),
(2, 'lexuxin', 'ac2a778453a36dd52ca4a830da6b3f8c'),
(3, 'ccnu', '6f4ce50f0c5c5708a898848f0fae024b'),
(6, '631', 'b7bb35b9c6ca2aee2df08cf09d7016c2'),
(7, 'itccnu', '362f0eba550eca6b2b1ea8918a84e5cf');

-- --------------------------------------------------------

--
-- Table structure for table `cd_downlog`
--

CREATE TABLE IF NOT EXISTS `cd_downlog` (
  `ID` bigint(6) unsigned NOT NULL AUTO_INCREMENT,
  `downer_ip` char(16) NOT NULL DEFAULT '000.000.000.000',
  `down_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `down_soft` bigint(6) unsigned NOT NULL,
  `downer_os` varchar(20) NOT NULL,
  `down_speed` int(6) unsigned NOT NULL COMMENT '单位:KB/s',
  `soft_appraise` tinyint(1) NOT NULL DEFAULT '0' COMMENT '踩:-1 缺省:0 顶:1',
  `soft_viru` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '举报有毒:1 缺省:0',
  `soft_null` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '举报无效:1 缺省:0',
  PRIMARY KEY (`ID`),
  KEY `down_soft` (`down_soft`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cd_softs`
--

CREATE TABLE IF NOT EXISTS `cd_softs` (
  `ID` bigint(6) unsigned NOT NULL AUTO_INCREMENT,
  `soft_name` varchar(40) NOT NULL,
  `soft_url` varchar(100) NOT NULL COMMENT '需以 http:// 开头',
  `term_id` bigint(6) unsigned NOT NULL,
  `tag_id` bigint(6) unsigned NOT NULL,
  `post_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `soft_description` text NOT NULL,
  `soft_size` int(8) unsigned NOT NULL COMMENT '单位:KB',
  `soft_os` varchar(30) NOT NULL,
  `soft_img` varchar(40) DEFAULT NULL COMMENT '需以 http:// 开头',
  `down_count` bigint(6) unsigned NOT NULL DEFAULT '0',
  `downer_top_count` bigint(6) NOT NULL DEFAULT '0' COMMENT '被顶次数',
  `downer_down_count` bigint(6) NOT NULL DEFAULT '0' COMMENT '被踩次数',
  `downer_viru_count` bigint(6) unsigned NOT NULL DEFAULT '0' COMMENT '被报毒次数',
  `downer_null_count` bigint(6) unsigned NOT NULL DEFAULT '0' COMMENT '报告文件无效次数',
  PRIMARY KEY (`ID`),
  KEY `FK_softs_terms` (`term_id`),
  KEY `FK_softs_tags` (`tag_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `cd_softs`
--

INSERT INTO `cd_softs` (`ID`, `soft_name`, `soft_url`, `term_id`, `tag_id`, `post_time`, `soft_description`, `soft_size`, `soft_os`, `soft_img`, `down_count`, `downer_top_count`, `downer_down_count`, `downer_viru_count`, `downer_null_count`) VALUES
(40, '一键Ghost', 'cd-resource/53/20121117151347_9565.zip', 53, 213, '2012-11-17 15:13:47', '<span style="font-family: 微软雅黑, Tahoma, Arial, sans-serif; font-size: small; line-height: 19px; text-indent: 24px; background-color: rgb(255, 255, 255);">一键还原精灵，是一款傻瓜式的系统备份和还原工具。它具有安全、快速、保密性强、压缩率高、兼容性好等特点，特别适合电脑新手和担心操作麻烦的人使用。</span>', 254688, 'win', 'cd-resource/53/20121117151347_9565.jpg', 0, 0, 0, 0, 0),
(41, '驱动精灵2012 SP5 6.1.1018 官方版', 'cd-resource/53/20121117152459_4446.zip', 53, 213, '2012-11-17 15:24:59', '<span style="color: rgb(119, 119, 119); font-family: 宋体; font-size: 12px; line-height: 24px; background-color: rgb(255, 255, 255);">驱动精灵2012官方版革命性的新增了硬件设备问题判别的功能与相应算法，驱动精灵2012官方版幅增强了硬件识别能力，本站提供驱动精灵2012官网下载。</span>', 254688, 'win', 'cd-resource/53/20121117152459_4446.jpg', 0, 0, 0, 0, 0),
(42, 'Windows优化大师 免费版 7.99 官方正式版', 'cd-resource/53/20121117152638_2663.zip', 53, 198, '2012-11-17 15:26:38', '<span style="color: rgb(119, 119, 119); font-family: 宋体; font-size: 12px; line-height: 22px; background-color: rgb(255, 255, 255);">Windows优化大师是功能强大的Windows系统优化辅助软件，Windows优化大师提供全面有效且简便安全的系统优化，本站提供优化大师免费下载、优化大师官方下载。</span>', 254688, 'win', 'cd-resource/53/20121117152638_2663.png', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cd_tags`
--

CREATE TABLE IF NOT EXISTS `cd_tags` (
  `tag_id` bigint(6) unsigned NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(10) NOT NULL,
  `tag_rank` bigint(6) unsigned NOT NULL,
  `tag_parent` bigint(6) unsigned NOT NULL,
  `down_count` bigint(6) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`tag_id`),
  KEY `FK_tags_terms` (`tag_parent`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=215 ;

--
-- Dumping data for table `cd_tags`
--

INSERT INTO `cd_tags` (`tag_id`, `tag_name`, `tag_rank`, `tag_parent`, `down_count`) VALUES
(191, '音乐播放软件', 2, 49, 0),
(193, '国内聊天软件', 1, 52, 0),
(194, '国外聊天软件', 2, 52, 0),
(195, '音乐下载软件', 1, 49, 5),
(198, '提速用的', 2, 53, 12),
(201, '专业画图软件', 1, 55, 0),
(202, '普通画图软件', 2, 55, 0),
(203, '免费杀毒软件', 1, 56, 1),
(204, '收费杀毒软件', 3, 56, 0),
(205, '国产杀毒软件', 2, 56, 0),
(206, '国外杀毒软件', 4, 56, 0),
(207, '校园网客户端', 1, 57, 0),
(208, '修电脑的', 3, 53, 7),
(209, 'windows', 1, 58, 0),
(213, '装电脑的', 1, 53, 0),
(214, '瞎折腾的', 4, 53, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cd_terms`
--

CREATE TABLE IF NOT EXISTS `cd_terms` (
  `term_id` bigint(6) unsigned NOT NULL AUTO_INCREMENT,
  `term_name` varchar(10) NOT NULL,
  `term_rank` bigint(6) unsigned NOT NULL,
  `down_count` bigint(6) unsigned NOT NULL,
  PRIMARY KEY (`term_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=59 ;

--
-- Dumping data for table `cd_terms`
--

INSERT INTO `cd_terms` (`term_id`, `term_name`, `term_rank`, `down_count`) VALUES
(49, '聊天工具', 7, 5),
(52, '学习天地', 2, 0),
(53, '系统工具', 1, 19),
(55, '网络安全', 4, 0),
(56, '媒体工具', 6, 1),
(57, '驱动下载', 3, 0),
(58, '网络工具', 4, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cd_downlog`
--
ALTER TABLE `cd_downlog`
  ADD CONSTRAINT `FK_soft_id` FOREIGN KEY (`down_soft`) REFERENCES `cd_softs` (`ID`);

--
-- Constraints for table `cd_softs`
--
ALTER TABLE `cd_softs`
  ADD CONSTRAINT `FK_softs_tags` FOREIGN KEY (`tag_id`) REFERENCES `cd_tags` (`tag_id`),
  ADD CONSTRAINT `FK_softs_terms` FOREIGN KEY (`term_id`) REFERENCES `cd_terms` (`term_id`);

--
-- Constraints for table `cd_tags`
--
ALTER TABLE `cd_tags`
  ADD CONSTRAINT `FK_tags_terms` FOREIGN KEY (`tag_parent`) REFERENCES `cd_terms` (`term_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
