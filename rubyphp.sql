/*
Navicat MySQL Data Transfer

Source Server         : 121.41.21.58
Source Server Version : 50548
Source Host           : 121.41.21.58:3306
Source Database       : rubyphp

Target Server Type    : MYSQL
Target Server Version : 50548
File Encoding         : 65001

Date: 2016-05-16 16:36:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for gc_users
-- ----------------------------
DROP TABLE IF EXISTS `gc_users`;
CREATE TABLE `gc_users` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `city` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `pwd` char(20) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of gc_users
-- ----------------------------
INSERT INTO `gc_users` VALUES ('1', 'Tanmay', 'Bangalore', '560001');
INSERT INTO `gc_users` VALUES ('2', 'Sachin', 'Mumbai', '400003');
INSERT INTO `gc_users` VALUES ('3', 'Uma', 'Pune', '411027');
