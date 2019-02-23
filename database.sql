/*
Navicat MySQL Data Transfer

Source Server         : phpMySql
Source Server Version : 50721
Source Host           : localhost:3306
Source Database       : bookmanagesystem

Target Server Type    : MYSQL
Target Server Version : 50721
File Encoding         : 65001

Date: 2018-07-03 17:00:16
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for bookinfo
-- ----------------------------
DROP TABLE IF EXISTS `bookinfo`;
CREATE TABLE `bookinfo` (
  `contributor` varchar(255) DEFAULT NULL,
  `bookId` int(8) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `bookName` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `language` varchar(255) DEFAULT NULL,
  `filepath` varchar(255) DEFAULT NULL,
  `author` varchar(20) DEFAULT NULL,
  `press` varchar(100) DEFAULT NULL,
  `insturction` varchar(255) DEFAULT NULL,
  `scope` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`bookId`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bookinfo
-- ----------------------------
INSERT INTO `bookinfo` VALUES ('G小兔', '00000007', '面向对象', '计算机', '简体中文', 'BookFiles/123.txt', '', '', '', '0');
INSERT INTO `bookinfo` VALUES ('G小兔', '00000008', '结构化', '计算机', '简体中文', 'BookFiles/123.txt', '', '', '', '0');
INSERT INTO `bookinfo` VALUES ('G小兔', '00000009', '数据结构', '计算机', '简体中文', 'BookFiles/123.txt', '', '', '', '1');
INSERT INTO `bookinfo` VALUES ('G小兔', '00000011', '会计学', '经管', '简体中文', 'BookFiles/123.txt', '', '', '', '1');
INSERT INTO `bookinfo` VALUES ('G小兔', '00000012', 'JAVA框架', '计算机', '简体中文', 'BookFiles/123.txt', '', '', '', '6');
INSERT INTO `bookinfo` VALUES ('G小兔', '00000001', 'PHP程序设计', '计算机', '简体中文', 'BookFiles/123.txt', '郑阿奇', '电子工业出版社', 'php是最好的编程语言', '5');
INSERT INTO `bookinfo` VALUES ('G小兔', '00000015', '钢铁是怎样炼成的', '小说', '简体中文', 'BookFiles/123.txt', null, null, null, '0');

-- ----------------------------
-- Table structure for languageinfo
-- ----------------------------
DROP TABLE IF EXISTS `languageinfo`;
CREATE TABLE `languageinfo` (
  `Id` int(3) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `lanName` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of languageinfo
-- ----------------------------
INSERT INTO `languageinfo` VALUES ('001', '简体中文');
INSERT INTO `languageinfo` VALUES ('002', '繁體中文');
INSERT INTO `languageinfo` VALUES ('003', 'English');

-- ----------------------------
-- Table structure for subjectinfo
-- ----------------------------
DROP TABLE IF EXISTS `subjectinfo`;
CREATE TABLE `subjectinfo` (
  `subject` varchar(50) DEFAULT NULL,
  `number` int(3) unsigned DEFAULT '0',
  `subjectId` int(3) unsigned zerofill NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`subjectId`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of subjectinfo
-- ----------------------------
INSERT INTO `subjectinfo` VALUES ('小说', '0', '001');
INSERT INTO `subjectinfo` VALUES ('经管', '0', '002');
INSERT INTO `subjectinfo` VALUES ('成功励志', '0', '003');
INSERT INTO `subjectinfo` VALUES ('人文社科', '0', '004');
INSERT INTO `subjectinfo` VALUES ('历史', '0', '005');
INSERT INTO `subjectinfo` VALUES ('生活', '0', '006');
INSERT INTO `subjectinfo` VALUES ('自然科学', '0', '007');
INSERT INTO `subjectinfo` VALUES ('传记', '0', '008');
INSERT INTO `subjectinfo` VALUES ('计算机', '0', '010');

-- ----------------------------
-- Table structure for userinfo
-- ----------------------------
DROP TABLE IF EXISTS `userinfo`;
CREATE TABLE `userinfo` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `usersex` int(11) DEFAULT '1' COMMENT '1表示男，0表示女',
  `birthday` varchar(8) DEFAULT NULL,
  `job` varchar(100) DEFAULT NULL,
  `insturction` varchar(255) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`userId`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of userinfo
-- ----------------------------
INSERT INTO `userinfo` VALUES ('1', 'admin', '123456', null, '1', '19990203', null, null);
INSERT INTO `userinfo` VALUES ('2', 'root', 'root', null, '0', null, null, null);
INSERT INTO `userinfo` VALUES ('3', 'gh', 'gh', null, '0', null, null, null);
INSERT INTO `userinfo` VALUES ('4', 'zhangsan', '123456', '457696790@qq.com', '1', null, null, null);
INSERT INTO `userinfo` VALUES ('7', '123', '123456', '', '1', null, null, null);
INSERT INTO `userinfo` VALUES ('8', 'G小兔', '123456', '457696790', '0', '19880123', '编辑', '最棒的管理员');
