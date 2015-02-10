/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50614
Source Host           : localhost:3306
Source Database       : cafethuy

Target Server Type    : MYSQL
Target Server Version : 50614
File Encoding         : 65001

Date: 2015-02-10 18:18:54
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
INSERT INTO `category` VALUES ('1', 'Bò né - Bánh mì', null, '1');
INSERT INTO `category` VALUES ('2', 'Cơm tắm', null, '1');
INSERT INTO `category` VALUES ('3', 'Giải khát', null, '1');

-- ----------------------------
-- Table structure for dish
-- ----------------------------
DROP TABLE IF EXISTS `dish`;
CREATE TABLE `dish` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '1:Id',
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '2:title',
  `description` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '3:description',
  `price` int(11) DEFAULT '0' COMMENT '4:price',
  `view_num` int(11) NOT NULL DEFAULT '0' COMMENT '5:view_num',
  `like_num` int(11) NOT NULL DEFAULT '0' COMMENT '6:like_num',
  `is_active` smallint(1) DEFAULT '1' COMMENT '7:is_active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='dish';

-- ----------------------------
-- Records of dish
-- ----------------------------
INSERT INTO `dish` VALUES ('1', 'Bò né', null, '50000', '0', '0', '1');
INSERT INTO `dish` VALUES ('2', 'Bò trừng', null, '50000', '0', '0', '1');
INSERT INTO `dish` VALUES ('3', 'Bò ba tê', null, '50000', '0', '0', '1');
INSERT INTO `dish` VALUES ('4', 'Bò xiu mại', null, '50000', '0', '0', '1');
INSERT INTO `dish` VALUES ('5', 'Bò xúc xích', null, '50000', '0', '0', '1');
INSERT INTO `dish` VALUES ('6', 'Thập cẩm', null, '50000', '0', '0', '1');
INSERT INTO `dish` VALUES ('7', 'Ốp la (2 trứng)', null, '20000', '0', '0', '1');
INSERT INTO `dish` VALUES ('8', 'Ốp lếch', null, '20000', '0', '0', '1');
INSERT INTO `dish` VALUES ('9', 'Ốp la ba tê', null, '30000', '0', '0', '1');
INSERT INTO `dish` VALUES ('10', 'Ốp la xiu mại', null, '30000', '0', '0', '1');
INSERT INTO `dish` VALUES ('11', 'Ốp la xúc xích', null, '30000', '0', '0', '1');
INSERT INTO `dish` VALUES ('12', 'Bò kho bánh mì', null, '25000', '0', '0', '1');
INSERT INTO `dish` VALUES ('13', 'Hủ tiếu bò kho', null, '30000', '0', '0', '1');
INSERT INTO `dish` VALUES ('14', 'Hù tiếu mì bò kho', null, '30000', '0', '0', '1');
INSERT INTO `dish` VALUES ('15', 'Hủ tiếu xướng', null, '30000', '0', '0', '1');
INSERT INTO `dish` VALUES ('16', 'Hủ tiếu thịt', null, '30000', '0', '0', '1');
INSERT INTO `dish` VALUES ('17', 'Hủ tiếu thịt băm', null, '30000', '0', '0', '1');
INSERT INTO `dish` VALUES ('18', 'Hủ tiếu bò tái', null, '40000', '0', '0', '1');
INSERT INTO `dish` VALUES ('19', 'Mì gói xào bò', null, '40000', '0', '0', '1');
INSERT INTO `dish` VALUES ('20', 'Mì gói xào trứng', null, '25000', '0', '0', '1');
INSERT INTO `dish` VALUES ('21', 'Mì gói bò tái', null, '40000', '0', '0', '1');
INSERT INTO `dish` VALUES ('22', 'Cá hộp', null, '30000', '0', '0', '1');
INSERT INTO `dish` VALUES ('23', 'Sườn', null, '23000', '0', '0', '1');
INSERT INTO `dish` VALUES ('24', 'Sườn chả', null, '28000', '0', '0', '1');
INSERT INTO `dish` VALUES ('25', 'Sườn bì', null, '28000', '0', '0', '1');
INSERT INTO `dish` VALUES ('26', 'Sườn trứng', null, '28000', '0', '0', '1');
INSERT INTO `dish` VALUES ('27', 'Sườn phá lấu', null, '30000', '0', '0', '1');
INSERT INTO `dish` VALUES ('28', 'Sườn bì chả', null, '30000', '0', '0', '1');
INSERT INTO `dish` VALUES ('29', 'Phá lấu', null, '30000', '0', '0', '1');
INSERT INTO `dish` VALUES ('30', 'Phá lấu opla', null, '30000', '0', '0', '1');
INSERT INTO `dish` VALUES ('31', 'Phá lấu bì', null, '30000', '0', '0', '1');
INSERT INTO `dish` VALUES ('32', 'Phá lấu chả', null, '30000', '0', '0', '1');
INSERT INTO `dish` VALUES ('33', 'Bì chả', null, '20000', '0', '0', '1');
INSERT INTO `dish` VALUES ('34', 'Bì opla', null, '20000', '0', '0', '1');
INSERT INTO `dish` VALUES ('35', 'Bì chả opla', null, '28000', '0', '0', '1');
INSERT INTO `dish` VALUES ('36', 'Chả opla', null, '20000', '0', '0', '1');
INSERT INTO `dish` VALUES ('37', 'Lạp xưởng', null, '23000', '0', '0', '1');
INSERT INTO `dish` VALUES ('38', 'Xíu mại', null, '28000', '0', '0', '1');
INSERT INTO `dish` VALUES ('39', 'Cà phê đen nóng', null, '15000', '0', '0', '1');
INSERT INTO `dish` VALUES ('40', 'Cà phê đen đá', null, '15000', '0', '0', '1');
INSERT INTO `dish` VALUES ('41', 'Cà phê sữa nóng', null, '15000', '0', '0', '1');
INSERT INTO `dish` VALUES ('42', 'Cà phê sữa đá', null, '20000', '0', '0', '1');
INSERT INTO `dish` VALUES ('43', 'Chanh đá', null, '15000', '0', '0', '1');
INSERT INTO `dish` VALUES ('44', 'Cam vắt', null, '25000', '0', '0', '1');
INSERT INTO `dish` VALUES ('45', 'Chanh muối', null, '15000', '0', '0', '1');
INSERT INTO `dish` VALUES ('46', 'Chanh dây', null, '15000', '0', '0', '1');
INSERT INTO `dish` VALUES ('47', 'Dâu tằm', null, '15000', '0', '0', '1');
INSERT INTO `dish` VALUES ('48', 'Xí muội', null, '15000', '0', '0', '1');
INSERT INTO `dish` VALUES ('49', 'Trà Lipton', null, '15000', '0', '0', '1');
INSERT INTO `dish` VALUES ('50', 'Trà Lipton chanh nóng', null, '15000', '0', '0', '1');
INSERT INTO `dish` VALUES ('51', 'Trà Lipton chanh đá', null, '15000', '0', '0', '1');
INSERT INTO `dish` VALUES ('52', 'Soda chanh', null, '20000', '0', '0', '1');
INSERT INTO `dish` VALUES ('53', 'Sữa tươi (nấu)', null, '15000', '0', '0', '1');
INSERT INTO `dish` VALUES ('54', 'Rong biển (nấu)', null, '15000', '0', '0', '1');
INSERT INTO `dish` VALUES ('55', 'Mủ trôm (nấu)', null, '15000', '0', '0', '1');
INSERT INTO `dish` VALUES ('56', 'Bông cúc rể chanh (nấu)', null, '15000', '0', '0', '1');
INSERT INTO `dish` VALUES ('57', 'Đậu đỏ không đường (nấu)', null, '15000', '0', '0', '1');
INSERT INTO `dish` VALUES ('58', 'Sữa đậu nành (chai)', null, '15000', '0', '0', '1');
INSERT INTO `dish` VALUES ('59', 'Coca', null, '15000', '0', '0', '1');
INSERT INTO `dish` VALUES ('60', 'Pepsi', null, '15000', '0', '0', '1');
INSERT INTO `dish` VALUES ('61', 'Sting dâu', null, '15000', '0', '0', '1');
INSERT INTO `dish` VALUES ('62', 'Number 1', null, '15000', '0', '0', '1');
INSERT INTO `dish` VALUES ('63', '7 up', null, '15000', '0', '0', '1');
INSERT INTO `dish` VALUES ('64', 'Xá xị', null, '15000', '0', '0', '1');
INSERT INTO `dish` VALUES ('65', 'Trà xanh 00', null, '15000', '0', '0', '1');
INSERT INTO `dish` VALUES ('66', 'Cam ép', null, '15000', '0', '0', '1');
INSERT INTO `dish` VALUES ('67', 'Nước suối', null, '15000', '0', '0', '1');
INSERT INTO `dish` VALUES ('68', 'Ô long', null, '18000', '0', '0', '1');
INSERT INTO `dish` VALUES ('69', 'Doctor Thanh', null, '18000', '0', '0', '1');
INSERT INTO `dish` VALUES ('70', 'Revive', null, '18000', '0', '0', '1');
INSERT INTO `dish` VALUES ('71', 'C2', null, '18000', '0', '0', '1');
INSERT INTO `dish` VALUES ('72', 'Bò húc', null, '18000', '0', '0', '1');

-- ----------------------------
-- Table structure for dish_category
-- ----------------------------
DROP TABLE IF EXISTS `dish_category`;
CREATE TABLE `dish_category` (
  `dish_id` int(11) NOT NULL COMMENT '1:dish_id',
  `category_id` int(11) NOT NULL COMMENT '2:category_id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='dish_category';

-- ----------------------------
-- Records of dish_category
-- ----------------------------
INSERT INTO `dish_category` VALUES ('1', '1');
INSERT INTO `dish_category` VALUES ('2', '1');
INSERT INTO `dish_category` VALUES ('3', '1');
INSERT INTO `dish_category` VALUES ('4', '1');
INSERT INTO `dish_category` VALUES ('5', '1');
INSERT INTO `dish_category` VALUES ('7', '1');
INSERT INTO `dish_category` VALUES ('8', '1');
INSERT INTO `dish_category` VALUES ('9', '1');
INSERT INTO `dish_category` VALUES ('10', '1');
INSERT INTO `dish_category` VALUES ('11', '1');
INSERT INTO `dish_category` VALUES ('12', '1');
INSERT INTO `dish_category` VALUES ('13', '1');
INSERT INTO `dish_category` VALUES ('14', '1');
INSERT INTO `dish_category` VALUES ('15', '1');
INSERT INTO `dish_category` VALUES ('16', '1');
INSERT INTO `dish_category` VALUES ('17', '1');
INSERT INTO `dish_category` VALUES ('18', '1');
INSERT INTO `dish_category` VALUES ('19', '1');
INSERT INTO `dish_category` VALUES ('20', '1');
INSERT INTO `dish_category` VALUES ('21', '1');
INSERT INTO `dish_category` VALUES ('22', '1');
INSERT INTO `dish_category` VALUES ('23', '2');
INSERT INTO `dish_category` VALUES ('24', '2');
INSERT INTO `dish_category` VALUES ('25', '2');
INSERT INTO `dish_category` VALUES ('26', '2');
INSERT INTO `dish_category` VALUES ('27', '2');
INSERT INTO `dish_category` VALUES ('28', '2');
INSERT INTO `dish_category` VALUES ('29', '2');
INSERT INTO `dish_category` VALUES ('30', '2');
INSERT INTO `dish_category` VALUES ('31', '2');
INSERT INTO `dish_category` VALUES ('32', '2');
INSERT INTO `dish_category` VALUES ('33', '2');
INSERT INTO `dish_category` VALUES ('34', '2');
INSERT INTO `dish_category` VALUES ('35', '2');
INSERT INTO `dish_category` VALUES ('36', '2');
INSERT INTO `dish_category` VALUES ('37', '2');
INSERT INTO `dish_category` VALUES ('38', '2');
INSERT INTO `dish_category` VALUES ('70', '3');
INSERT INTO `dish_category` VALUES ('69', '3');
INSERT INTO `dish_category` VALUES ('61', '3');
INSERT INTO `dish_category` VALUES ('68', '3');
INSERT INTO `dish_category` VALUES ('72', '3');
INSERT INTO `dish_category` VALUES ('44', '3');
INSERT INTO `dish_category` VALUES ('71', '3');
INSERT INTO `dish_category` VALUES ('43', '3');
INSERT INTO `dish_category` VALUES ('47', '3');
INSERT INTO `dish_category` VALUES ('46', '3');
INSERT INTO `dish_category` VALUES ('45', '3');
INSERT INTO `dish_category` VALUES ('49', '3');
INSERT INTO `dish_category` VALUES ('65', '3');
INSERT INTO `dish_category` VALUES ('66', '3');
INSERT INTO `dish_category` VALUES ('63', '3');
INSERT INTO `dish_category` VALUES ('62', '3');
INSERT INTO `dish_category` VALUES ('58', '3');
INSERT INTO `dish_category` VALUES ('60', '3');
INSERT INTO `dish_category` VALUES ('59', '3');
INSERT INTO `dish_category` VALUES ('53', '3');
INSERT INTO `dish_category` VALUES ('64', '3');
INSERT INTO `dish_category` VALUES ('48', '3');
INSERT INTO `dish_category` VALUES ('50', '3');
INSERT INTO `dish_category` VALUES ('40', '3');
INSERT INTO `dish_category` VALUES ('42', '3');
INSERT INTO `dish_category` VALUES ('41', '3');
INSERT INTO `dish_category` VALUES ('51', '3');
INSERT INTO `dish_category` VALUES ('52', '3');
INSERT INTO `dish_category` VALUES ('67', '3');
INSERT INTO `dish_category` VALUES ('39', '3');
INSERT INTO `dish_category` VALUES ('57', '3');
INSERT INTO `dish_category` VALUES ('55', '3');
INSERT INTO `dish_category` VALUES ('56', '3');
INSERT INTO `dish_category` VALUES ('54', '3');
INSERT INTO `dish_category` VALUES ('6', '1');

-- ----------------------------
-- Table structure for dish_image
-- ----------------------------
DROP TABLE IF EXISTS `dish_image`;
CREATE TABLE `dish_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '1:Id',
  `dish_id` int(11) NOT NULL COMMENT '2:dish_id',
  `image_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '3:image_name',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='dish_image';

-- ----------------------------
-- Records of dish_image
-- ----------------------------
INSERT INTO `dish_image` VALUES ('1', '1', '20150206110023941.jpg');
INSERT INTO `dish_image` VALUES ('2', '2', '20150206110023941.jpg');
INSERT INTO `dish_image` VALUES ('3', '3', '20150206110023941.jpg');
INSERT INTO `dish_image` VALUES ('4', '4', '20150206110023941.jpg');
INSERT INTO `dish_image` VALUES ('5', '5', '20150206110023941.jpg');
INSERT INTO `dish_image` VALUES ('7', '7', '20150206110023941.jpg');
INSERT INTO `dish_image` VALUES ('8', '8', '20150206110023941.jpg');
INSERT INTO `dish_image` VALUES ('9', '9', '20150206110023941.jpg');
INSERT INTO `dish_image` VALUES ('10', '10', '20150206110023941.jpg');
INSERT INTO `dish_image` VALUES ('11', '11', '20150206110023941.jpg');
INSERT INTO `dish_image` VALUES ('12', '12', '20150206110023941.jpg');
INSERT INTO `dish_image` VALUES ('13', '13', '20150206110023941.jpg');
INSERT INTO `dish_image` VALUES ('14', '14', '20150206110023941.jpg');
INSERT INTO `dish_image` VALUES ('15', '15', '20150206110023941.jpg');
INSERT INTO `dish_image` VALUES ('16', '16', '20150206110023941.jpg');
INSERT INTO `dish_image` VALUES ('17', '17', '20150206110023941.jpg');
INSERT INTO `dish_image` VALUES ('18', '18', '20150206110023941.jpg');
INSERT INTO `dish_image` VALUES ('19', '19', '20150206110023941.jpg');
INSERT INTO `dish_image` VALUES ('20', '20', '20150206110023941.jpg');
INSERT INTO `dish_image` VALUES ('21', '21', '20150206110023941.jpg');
INSERT INTO `dish_image` VALUES ('22', '22', '20150206110023941.jpg');
INSERT INTO `dish_image` VALUES ('23', '23', '20150206110023941.jpg');
INSERT INTO `dish_image` VALUES ('24', '24', '20150206110023941.jpg');
INSERT INTO `dish_image` VALUES ('25', '25', '20150206110023941.jpg');
INSERT INTO `dish_image` VALUES ('26', '26', '20150206110023941.jpg');
INSERT INTO `dish_image` VALUES ('27', '27', '20150206110023941.jpg');
INSERT INTO `dish_image` VALUES ('28', '28', '20150206110023941.jpg');
INSERT INTO `dish_image` VALUES ('29', '29', '20150206110023941.jpg');
INSERT INTO `dish_image` VALUES ('30', '30', '20150206110023941.jpg');
INSERT INTO `dish_image` VALUES ('31', '31', '20150206110023941.jpg');
INSERT INTO `dish_image` VALUES ('32', '32', '20150206110023941.jpg');
INSERT INTO `dish_image` VALUES ('33', '33', '20150206110023941.jpg');
INSERT INTO `dish_image` VALUES ('34', '34', '20150206110023941.jpg');
INSERT INTO `dish_image` VALUES ('35', '35', '20150206110023941.jpg');
INSERT INTO `dish_image` VALUES ('36', '36', '20150206110023941.jpg');
INSERT INTO `dish_image` VALUES ('37', '37', '20150206110023941.jpg');
INSERT INTO `dish_image` VALUES ('38', '38', '20150206110023941.jpg');
INSERT INTO `dish_image` VALUES ('73', '70', '20150207053512728.JPG');
INSERT INTO `dish_image` VALUES ('74', '69', '20150207054113914.jpg');
INSERT INTO `dish_image` VALUES ('75', '61', '20150207054131710.jpg');
INSERT INTO `dish_image` VALUES ('76', '68', '20150207055209267.jpg');
INSERT INTO `dish_image` VALUES ('77', '72', '20150207055320174.jpg');
INSERT INTO `dish_image` VALUES ('78', '44', '20150207055520398.jpeg');
INSERT INTO `dish_image` VALUES ('79', '71', '20150210091610616.jpg');
INSERT INTO `dish_image` VALUES ('80', '43', '20150210091922234.jpg');
INSERT INTO `dish_image` VALUES ('82', '47', '20150210092926538.jpg');
INSERT INTO `dish_image` VALUES ('84', '46', '20150210093116319.jpg');
INSERT INTO `dish_image` VALUES ('85', '45', '20150210093136938.png');
INSERT INTO `dish_image` VALUES ('86', '49', '20150210093403512.jpg');
INSERT INTO `dish_image` VALUES ('87', '65', '20150210094031162.jpg');
INSERT INTO `dish_image` VALUES ('89', '66', '20150210094905616.jpg');
INSERT INTO `dish_image` VALUES ('90', '63', '20150210095309237.jpg');
INSERT INTO `dish_image` VALUES ('91', '62', '20150210095324650.jpeg');
INSERT INTO `dish_image` VALUES ('93', '58', '20150210095847660.jpg');
INSERT INTO `dish_image` VALUES ('94', '60', '20150210100010425.jpg');
INSERT INTO `dish_image` VALUES ('95', '59', '20150210100029868.jpg');
INSERT INTO `dish_image` VALUES ('96', '53', '20150210100049113.jpg');
INSERT INTO `dish_image` VALUES ('97', '64', '20150210100244271.jpg');
INSERT INTO `dish_image` VALUES ('98', '48', '20150210100413115.jpg');
INSERT INTO `dish_image` VALUES ('99', '50', '20150210100440713.jpg');
INSERT INTO `dish_image` VALUES ('100', '40', '20150210100553859.jpg');
INSERT INTO `dish_image` VALUES ('102', '42', '20150210100851330.jpg');
INSERT INTO `dish_image` VALUES ('103', '41', '20150210100907225.jpg');
INSERT INTO `dish_image` VALUES ('104', '51', '20150210101244075.jpg');
INSERT INTO `dish_image` VALUES ('105', '52', '20150210101520196.jpg');
INSERT INTO `dish_image` VALUES ('106', '67', '20150210101600553.jpg');
INSERT INTO `dish_image` VALUES ('107', '39', '20150210101901863.jpg');
INSERT INTO `dish_image` VALUES ('108', '57', '20150210102316315.jpg');
INSERT INTO `dish_image` VALUES ('109', '55', '20150210102335995.jpg');
INSERT INTO `dish_image` VALUES ('110', '56', '20150210102547222.jpg');
INSERT INTO `dish_image` VALUES ('111', '54', '20150210103903922.jpg');
INSERT INTO `dish_image` VALUES ('112', '6', '20150210110830687.jpg');

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
INSERT INTO `menu_bar` VALUES ('1', 'Trang chủ', 'home/index', null, '1');
INSERT INTO `menu_bar` VALUES ('2', 'Thực đơn', 'home/menu', null, '1');
INSERT INTO `menu_bar` VALUES ('3', 'Hình ảnh', 'home/gallery', null, '1');
INSERT INTO `menu_bar` VALUES ('4', 'Địa điểm', 'home/location', null, '1');
INSERT INTO `menu_bar` VALUES ('5', 'Giới thiệu', 'home/about', null, '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user';

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'Admin', null, '1');
INSERT INTO `user` VALUES ('2', 'guest', 'e10adc3949ba59abbe56e057f20f883e', 'Guest', null, '1');
