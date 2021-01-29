/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50726
Source Host           : localhost:3306
Source Database       : yifeng

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2021-01-29 18:07:15
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for yf_classitem
-- ----------------------------
DROP TABLE IF EXISTS `yf_classitem`;
CREATE TABLE `yf_classitem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `classid` int(10) NOT NULL DEFAULT '0' COMMENT '价格类型id',
  `name` varchar(60) NOT NULL DEFAULT '' COMMENT '配置项名称',
  `sort` int(10) NOT NULL DEFAULT '100' COMMENT '排序',
  `value` decimal(10,4) NOT NULL DEFAULT '0.0000' COMMENT '值/价格',
  `nvalue` decimal(10,4) NOT NULL DEFAULT '0.0000' COMMENT '值/价格',
  `formtype` int(10) NOT NULL DEFAULT '100' COMMENT '表单类型，1：单行，2：多行',
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yf_classitem
-- ----------------------------

-- ----------------------------
-- Table structure for yf_classs
-- ----------------------------
DROP TABLE IF EXISTS `yf_classs`;
CREATE TABLE `yf_classs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL DEFAULT '' COMMENT '价格类型',
  `label` varchar(60) NOT NULL DEFAULT '' COMMENT '标识',
  `sort` int(10) NOT NULL DEFAULT '100' COMMENT '排序',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `label` (`label`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yf_classs
-- ----------------------------

-- ----------------------------
-- Table structure for yf_manager
-- ----------------------------
DROP TABLE IF EXISTS `yf_manager`;
CREATE TABLE `yf_manager` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL DEFAULT '' COMMENT '用户名，登陆使用',
  `password` varchar(100) NOT NULL DEFAULT '$2y$10$vBXFOKnrMr/UOWLtE0HegOmo1uzMamZ2kD.E2wuzKxnWJV0UrHYda' COMMENT '用户密码',
  `login_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '登陆状态',
  `login_code` varchar(32) NOT NULL DEFAULT '0' COMMENT '排他性登陆标识',
  `last_login_ip` int(11) NOT NULL DEFAULT '0' COMMENT '最后登录IP',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0' COMMENT '删除状态，1已删除',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yf_manager
-- ----------------------------
INSERT INTO `yf_manager` VALUES ('1', 'admin', '$2y$10$/Q4MgwykGppEZktEincv6OE/QDWmqf2gBMn14coxef.1SN3tp9Zsm', '0', '0', '0', '0');

-- ----------------------------
-- Table structure for yf_migrations
-- ----------------------------
DROP TABLE IF EXISTS `yf_migrations`;
CREATE TABLE `yf_migrations` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yf_migrations
-- ----------------------------
INSERT INTO `yf_migrations` VALUES ('20190717074336', 'Classitem', '2021-01-29 17:36:42', '2021-01-29 17:36:42', '0');
INSERT INTO `yf_migrations` VALUES ('20190717074516', 'Classs', '2021-01-29 17:36:42', '2021-01-29 17:36:42', '0');
INSERT INTO `yf_migrations` VALUES ('20210129043337', 'Manager', '2021-01-29 12:45:28', '2021-01-29 12:45:28', '0');
