SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '1:Id',
  `username` varchar(255) NOT NULL COMMENT '2:username',
  `password` varchar(255) NOT NULL COMMENT '3:password',
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '4:name',
  `email` varchar(255) DEFAULT NULL COMMENT '5:email',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='customer';

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (null, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'Ngô Lê Duy Hiếu', null);

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '1:Id',
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '2:name',
  `parent_id` int(1) DEFAULT NULL COMMENT '3:parent_id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='distributor';

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES (null, 'Bò né', null);
INSERT INTO `category` VALUES (null, 'Cơm tắm', null);
INSERT INTO `category` VALUES (null, 'Giải khác', null);

-- ----------------------------
-- Table structure for dish
-- ----------------------------
DROP TABLE IF EXISTS `dish`;
CREATE TABLE `dish` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '1:Id',
  `category_id` int(11) NOT NULL COMMENT '2:category_id',
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '3:title',
  `content` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '4:content',
  `thump_image_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '5:thump_image_name',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='dish';

-- ----------------------------
-- Table structure for dish_image
-- ----------------------------
DROP TABLE IF EXISTS `dish_image`;
CREATE TABLE `dish_image` (
  `dish_id` int(11) NOT NULL COMMENT '1:dish_id',
  `image_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '2:image_name'
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='dish_image';

-- ----------------------------
-- Table structure for dish_relation
-- ----------------------------
DROP TABLE IF EXISTS `dish_relation`;
CREATE TABLE `dish_relation` (
  `dish_id` int(11) NOT NULL COMMENT '1:dish_id',
  `root_category_id` int(11) NOT NULL COMMENT '2:root_category_id',
  `category_id` int(11) NOT NULL COMMENT '3:category_id'
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='dish_relation';

-- ----------------------------
-- Table structure for menu_bar
-- ----------------------------
DROP TABLE IF EXISTS `menu_bar`;
CREATE TABLE `menu_bar` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '1:Id',
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '2:name',
  `routes` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '3:routes',
  `parent_id` int(11) DEFAULT NULL COMMENT '4:parent_id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='menu_bar';

-- ----------------------------
-- Records of menu_bar
-- ----------------------------
INSERT INTO `menu_bar` VALUES (null, 'Trang chủ', 'home/index', null),
(null, 'Thực đơn', 'home/menu', null),
(null, 'Hình ảnh', 'home/gallery', null),
(null, 'Địa điểm', 'home/location', null),
(null, 'Giới thiệu', 'home/about', null);