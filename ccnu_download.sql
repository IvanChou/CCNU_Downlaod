/*
 Navicat MySQL Data Transfer

 Source Server         : localhost
 Source Server Version : 50527
 Source Host           : localhost
 Source Database       : ccnu_download

 Target Server Version : 50527
 File Encoding         : utf-8

 Date: 11/12/2012 22:26:49 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `cd_admin`
-- ----------------------------
DROP TABLE IF EXISTS `cd_admin`;
CREATE TABLE `cd_admin` (
  `ID` bigint(6) unsigned NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(16) NOT NULL,
  `admin_pass` varchar(64) NOT NULL DEFAULT '49ba59abbe56e057' COMMENT 'MD5 16进制加密',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `cd_admin`
-- ----------------------------
BEGIN;
INSERT INTO `cd_admin` VALUES ('1', 'cd-admin', 'dbbea736b90d78c7d4fc69085acccdba'), ('2', 'lexuxin', 'ac2a778453a36dd52ca4a830da6b3f8c'), ('3', 'ccnu', '6f4ce50f0c5c5708a898848f0fae024b'), ('6', '631', 'b7bb35b9c6ca2aee2df08cf09d7016c2'), ('7', 'itccnu', '362f0eba550eca6b2b1ea8918a84e5cf');
COMMIT;

-- ----------------------------
--  Table structure for `cd_downlog`
-- ----------------------------
DROP TABLE IF EXISTS `cd_downlog`;
CREATE TABLE `cd_downlog` (
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
  KEY `down_soft` (`down_soft`),
  CONSTRAINT `FK_soft_id` FOREIGN KEY (`down_soft`) REFERENCES `cd_softs` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `cd_softs`
-- ----------------------------
DROP TABLE IF EXISTS `cd_softs`;
CREATE TABLE `cd_softs` (
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
  KEY `FK_softs_tags` (`tag_id`),
  CONSTRAINT `FK_softs_tags` FOREIGN KEY (`tag_id`) REFERENCES `cd_tags` (`tag_id`),
  CONSTRAINT `FK_softs_terms` FOREIGN KEY (`term_id`) REFERENCES `cd_terms` (`term_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `cd_softs`
-- ----------------------------
BEGIN;
INSERT INTO `cd_softs` VALUES ('34', '4444', 'cd-resource/49/20120621053012_3376.exe', '49', '195', '2012-06-21 05:30:12', 'dddd', '4089446', '3333', 'cd-resource/49/20120621053012_3376.jpg', '5', '10', '20', '0', '0'), ('37', 'ffff', 'cd-resource/53/20120622021810_4015.rar', '53', '198', '2012-06-22 02:18:10', 'fffff交电费', '121215386', 'ffff', 'cd-resource/53/20120622021810_4015.jpg', '12', '6', '1', '0', '0'), ('38', '360杀毒', 'cd-resource/56/20120626021227_3735.exe', '56', '203', '2012-06-26 02:12:27', '测试多个点号听音乐', '11744051', 'XP', 'cd-resource/56/20120626021227_3735.jpg', '1', '0', '0', '0', '0'), ('39', 'ubuntu系统上传测试', 'cd-resource/57/20120721194025_5084.exe', '57', '207', '2012-10-31 19:40:25', '用ubuntu系统运行测试', '4159912', 'xp', 'cd-resource/57/20120721194025_5084.jpg', '7', '0', '0', '0', '0');
COMMIT;

-- ----------------------------
--  Table structure for `cd_tags`
-- ----------------------------
DROP TABLE IF EXISTS `cd_tags`;
CREATE TABLE `cd_tags` (
  `tag_id` bigint(6) unsigned NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(10) NOT NULL,
  `tag_rank` bigint(6) unsigned NOT NULL,
  `tag_parent` bigint(6) unsigned NOT NULL,
  `down_count` bigint(6) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`tag_id`),
  KEY `FK_tags_terms` (`tag_parent`),
  CONSTRAINT `FK_tags_terms` FOREIGN KEY (`tag_parent`) REFERENCES `cd_terms` (`term_id`)
) ENGINE=InnoDB AUTO_INCREMENT=214 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `cd_tags`
-- ----------------------------
BEGIN;
INSERT INTO `cd_tags` VALUES ('191', '音乐播放软件', '2', '49', '0'), ('193', '国内聊天软件', '1', '52', '0'), ('194', '国外聊天软件', '2', '52', '0'), ('195', '音乐下载软件', '1', '49', '5'), ('198', 'php运行平台', '1', '53', '12'), ('201', '专业画图软件', '1', '55', '0'), ('202', '普通画图软件', '2', '55', '0'), ('203', '免费杀毒软件', '1', '56', '1'), ('204', '收费杀毒软件', '3', '56', '0'), ('205', '国产杀毒软件', '2', '56', '0'), ('206', '国外杀毒软件', '4', '56', '0'), ('207', '校园网客户端', '1', '57', '0'), ('208', 'asp', '2', '53', '7'), ('209', 'windows', '1', '58', '0'), ('213', '111', '1', '53', '0');
COMMIT;

-- ----------------------------
--  Table structure for `cd_terms`
-- ----------------------------
DROP TABLE IF EXISTS `cd_terms`;
CREATE TABLE `cd_terms` (
  `term_id` bigint(6) unsigned NOT NULL AUTO_INCREMENT,
  `term_name` varchar(10) NOT NULL,
  `term_rank` bigint(6) unsigned NOT NULL,
  `down_count` bigint(6) unsigned NOT NULL,
  PRIMARY KEY (`term_id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `cd_terms`
-- ----------------------------
BEGIN;
INSERT INTO `cd_terms` VALUES ('49', '音乐软件', '7', '5'), ('52', '聊天软件', '2', '0'), ('53', '编程平台', '1', '19'), ('55', '画图软件', '4', '0'), ('56', '杀毒软件', '6', '1'), ('57', '网络应用', '3', '0'), ('58', '操作系统', '4', '0');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
