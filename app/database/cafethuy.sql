/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50614
Source Host           : localhost:3306
Source Database       : cafethuy

Target Server Type    : MYSQL
Target Server Version : 50614
File Encoding         : 65001

Date: 2015-02-05 15:58:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '1:Id',
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '2:name',
  `parent_id` int(1) DEFAULT NULL COMMENT '3:parent_id',
	`is_active` smallint(1) DEFAULT '1' COMMENT '4:is_active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='distributor';

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', 'Bò né - Bánh mì', null, 1);
INSERT INTO `category` VALUES ('2', 'Cơm tắm', null, 1);
INSERT INTO `category` VALUES ('3', 'Giải khát', null, 1);

-- ----------------------------
-- Table structure for dish
-- ----------------------------
DROP TABLE IF EXISTS `dish`;
CREATE TABLE `dish` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '1:Id',
  `category_id` int(11) NOT NULL COMMENT '2:category_id',
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '3:title',
  `description` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '4:description',
  `price` int(11) DEFAULT '0' COMMENT '5:price',
  `view_num` int(11) NOT NULL DEFAULT '0' COMMENT '6:view_num',
  `like_num` int(11) NOT NULL DEFAULT '0' COMMENT '7:like_num',
  `is_active` smallint(1) DEFAULT '1' COMMENT '8:is_active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='dish';

-- ----------------------------
-- Table structure for dish_image
-- ----------------------------
DROP TABLE IF EXISTS `dish_image`;
CREATE TABLE `dish_image` (
  `dish_id` int(11) NOT NULL COMMENT '1:dish_id',
  `image_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '2:image_name'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='dish_image';

-- ----------------------------
-- Records of dish_image
-- ----------------------------

-- ----------------------------
-- Table structure for dish_category
-- ----------------------------
DROP TABLE IF EXISTS `dish_category`;
CREATE TABLE `dish_category` (
  `dish_id` int(11) NOT NULL COMMENT '1:dish_id',
  `category_id` int(11) NOT NULL COMMENT '2:category_id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='dish_category';

-- ----------------------------
-- Table structure for menu_bar
-- ----------------------------
DROP TABLE IF EXISTS `menu_bar`;
CREATE TABLE `menu_bar` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '1:Id',
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '2:name',
  `routes` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '3:routes',
  `parent_id` int(11) DEFAULT NULL COMMENT '4:parent_id',
	`is_active` smallint(1) DEFAULT '1' COMMENT '5:is_active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='menu_bar';

-- ----------------------------
-- Records of menu_bar
-- ----------------------------
INSERT INTO `menu_bar` VALUES ('1', 'Trang chủ', 'home/index', null, 1);
INSERT INTO `menu_bar` VALUES ('2', 'Thực đơn', 'home/menu', null, 1);
INSERT INTO `menu_bar` VALUES ('3', 'Hình ảnh', 'home/gallery', null, 1);
INSERT INTO `menu_bar` VALUES ('4', 'Địa điểm', 'home/location', null, 1);
INSERT INTO `menu_bar` VALUES ('5', 'Giới thiệu', 'home/about', null, 1);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '1:Id',
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '2:username',
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '3:password',
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '4:name',
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '5:email',
  `is_active` smallint(1) DEFAULT '1' COMMENT '6:is_active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user';

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'Admin', null, 1);
INSERT INTO `user` VALUES ('2', 'guest', 'e10adc3949ba59abbe56e057f20f883e', 'Guest', null, 1);
