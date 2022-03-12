/*
Navicat MySQL Data Transfer

Source Server         : 本地数据库
Source Server Version : 50726
Source Host           : localhost:3306
Source Database       : b5yii2cmf2

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2022-03-12 20:17:51
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `b5net_adlist`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_adlist`;
CREATE TABLE `b5net_adlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '信息标题',
  `parent_id` int(10) NOT NULL DEFAULT '0' COMMENT '推荐位置',
  `redinfo` varchar(500) CHARACTER SET utf8 DEFAULT '' COMMENT '跳转值',
  `listsort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `text_text` text COMMENT '文本信息',
  `text_rich` text CHARACTER SET utf8 COMMENT '富文本信息',
  `imglist` text CHARACTER SET utf8 COMMENT '图片信息',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='推荐信息表';

-- ----------------------------
-- Records of b5net_adlist
-- ----------------------------
INSERT INTO `b5net_adlist` VALUES ('2', '测试大苏打大苏打', '1', 'asdasd', '1', '1', 'asdsadasd', '<p><img style=\"width: 50%;\" src=\"/uploads/editor/2021/01/18/0c4395ade564554f101b80705d024e65.jpg\" data-filename=\"timg (2)\"><br></p><p><br></p><p><br></p><p></p><p><br></p><p><br></p><p><br></p><p><br></p><p><br></p><p><br></p><p><br></p><p>asdasdsadasd</p><p>asdasdasdasd</p>', '/uploads/adlist/2021/05/21/2e7eedae3a88981f165be29a30b3e587.jpg', '2021-01-05 03:33:07', '2021-05-21 16:19:10');

-- ----------------------------
-- Table structure for `b5net_admin`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_admin`;
CREATE TABLE `b5net_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL DEFAULT '' COMMENT '登录名',
  `password` varchar(255) NOT NULL DEFAULT '' COMMENT '登录密码',
  `realname` varchar(30) NOT NULL DEFAULT '' COMMENT '人员姓名',
  `status` char(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `note` varchar(255) DEFAULT '' COMMENT '备注',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  `last_time` datetime DEFAULT NULL COMMENT '登录时间',
  `last_ip` varchar(30) DEFAULT NULL COMMENT '登录ip',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='管理员表';

-- ----------------------------
-- Records of b5net_admin
-- ----------------------------
INSERT INTO `b5net_admin` VALUES ('1', 'admin', '$2y$13$tPD2ym10wIZOXmabzQzJPOgISq/NldKEv0FPbp0yDbd08RwS0QGQO', '超管', '1', '超级管理员', '2020-12-24 10:50:56', '2021-05-21 15:48:25', '2022-03-12 19:43:52', '127.0.0.1');
INSERT INTO `b5net_admin` VALUES ('2', 'ceshi', '$2y$13$sHMB3vFS2dBDrIrHOqvpQO1Y7nhGEAj6/FjgorgxMd5ZVgzXxKSG2', '测试1111', '1', '测试账号', '2020-12-24 13:14:57', '2021-05-21 16:57:17', '2021-05-21 15:57:43', '127.0.0.1');

-- ----------------------------
-- Table structure for `b5net_admin_role`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_admin_role`;
CREATE TABLE `b5net_admin_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL COMMENT '用户ID',
  `role_id` int(11) NOT NULL COMMENT '角色ID',
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_id` (`admin_id`,`role_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COMMENT='用户和角色关联表';

-- ----------------------------
-- Records of b5net_admin_role
-- ----------------------------
INSERT INTO `b5net_admin_role` VALUES ('30', '1', '1');
INSERT INTO `b5net_admin_role` VALUES ('39', '2', '2');

-- ----------------------------
-- Table structure for `b5net_admin_struct`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_admin_struct`;
CREATE TABLE `b5net_admin_struct` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL COMMENT '用户ID',
  `struct_id` int(11) NOT NULL COMMENT '组织ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COMMENT='用户与组织架构关联表';

-- ----------------------------
-- Records of b5net_admin_struct
-- ----------------------------
INSERT INTO `b5net_admin_struct` VALUES ('20', '1', '100');
INSERT INTO `b5net_admin_struct` VALUES ('34', '2', '112');

-- ----------------------------
-- Table structure for `b5net_adposition`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_adposition`;
CREATE TABLE `b5net_adposition` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(100) NOT NULL DEFAULT '' COMMENT '唯一标识',
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '位置名称',
  `note` varchar(255) DEFAULT '' COMMENT '备注',
  `width` mediumint(9) DEFAULT '0',
  `height` mediumint(9) DEFAULT '0',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`type`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='推荐位置表';

-- ----------------------------
-- Records of b5net_adposition
-- ----------------------------
INSERT INTO `b5net_adposition` VALUES ('1', 'web_index_banner', '首页banner图片', '宽高为1920*400像素', '0', '0', '2021-01-08 06:02:11', '2021-07-30 15:23:20');

-- ----------------------------
-- Table structure for `b5net_app_token`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_app_token`;
CREATE TABLE `b5net_app_token` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `token` varchar(255) NOT NULL DEFAULT '',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `addtime` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `type` varchar(30) NOT NULL DEFAULT '' COMMENT '类型',
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of b5net_app_token
-- ----------------------------

-- ----------------------------
-- Table structure for `b5net_config`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_config`;
CREATE TABLE `b5net_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '配置ID',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '配置名称',
  `type` varchar(30) NOT NULL DEFAULT '' COMMENT '配置标识',
  `style` varchar(10) NOT NULL DEFAULT '' COMMENT '配置类型',
  `is_sys` char(1) NOT NULL DEFAULT '0' COMMENT '是否系统内置 0否 1是',
  `groups` varchar(50) DEFAULT '' COMMENT '配置分组',
  `value` text COMMENT '配置值',
  `extra` varchar(255) DEFAULT '' COMMENT '配置项',
  `note` varchar(255) DEFAULT '' COMMENT '配置说明',
  `listsort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COMMENT='系统配置表';

-- ----------------------------
-- Records of b5net_config
-- ----------------------------
INSERT INTO `b5net_config` VALUES ('1', '配置分组', 'sys_config_group', 'array', '0', '', 'site:基本设置\r\nwx:微信设置\r\nsms:短信配置\r\nemail:邮箱配置\r\nimgwater:图片水印', '', '系统配置的分组配置', '0', '2020-12-30 16:17:10', '2021-07-29 20:44:01');
INSERT INTO `b5net_config` VALUES ('2', '系统名称', 'sys_config_sysname', 'text', '0', 'site', 'B5YiiCMF', '', '系统后台显示的名称', '0', '2020-12-31 14:01:18', '2021-05-21 16:58:00');
INSERT INTO `b5net_config` VALUES ('4', '阿里accessKeyId', 'sms_ali_key', 'text', '0', 'sms', '', '', '阿里短信-AccessKey ID', '0', '2021-01-11 19:26:13', '2021-01-17 21:27:04');
INSERT INTO `b5net_config` VALUES ('5', '阿里accessSecret', 'sms_ali_secret', 'text', '0', 'sms', '', '', '阿里短信-AccessKey Secret', '1', '2021-01-11 19:26:45', '2021-01-17 21:27:04');
INSERT INTO `b5net_config` VALUES ('6', '阿里signName', 'sms_ali_signname', 'text', '0', 'sms', '', '', '阿里短信-签名', '2', '2021-01-11 19:27:53', '2021-01-17 21:27:04');
INSERT INTO `b5net_config` VALUES ('7', '阿里tempId', 'sms_ali_temp', 'text', '0', 'sms', '', '', '阿里短信-tempId模板', '3', '2021-01-11 19:30:21', '2021-01-17 21:27:04');
INSERT INTO `b5net_config` VALUES ('8', '聚合appkey', 'sms_juhe_appkey', 'text', '0', 'sms', '', '', '聚合短信-APPKEY', '10', '2021-01-11 19:33:27', '2021-01-17 21:27:04');
INSERT INTO `b5net_config` VALUES ('9', '聚合tempId', 'sms_juhe_temp', 'text', '0', 'sms', '', '', '聚合短信-TPLID模板', '11', '2021-01-11 19:34:26', '2021-05-18 16:03:38');
INSERT INTO `b5net_config` VALUES ('10', '公众号appid', 'wechat_appid', 'text', '0', 'wx', 'wx2dbcd1ebf29bd18f', '', '微信公众号的AppId', '0', '2021-01-12 11:05:50', '2021-03-27 23:06:59');
INSERT INTO `b5net_config` VALUES ('11', '公众号secret', 'wechat_appsecret', 'text', '0', 'wx', '8f2ea486cf4182ba9211d26cdb7c343a', '', '微信公众号-AppSecret', '1', '2021-01-12 11:06:24', '2021-03-27 23:06:59');
INSERT INTO `b5net_config` VALUES ('12', '服务地址', 'sys_email_host', 'text', '0', 'email', 'smtp.163.com', '', '类似:smtp.163.com', '1', '2021-01-22 15:28:10', '2021-01-23 13:03:59');
INSERT INTO `b5net_config` VALUES ('13', '邮箱地址', 'sys_email_username', 'text', '0', 'email', 'lyyd_lh@163.com', '', '发送邮件的邮箱地址', '2', '2021-01-22 15:28:39', '2021-01-23 13:03:59');
INSERT INTO `b5net_config` VALUES ('14', '授权密码', 'sys_email_password', 'text', '0', 'email', 'UCSMPMHNDJSALQVW', '', '', '3', '2021-01-22 15:29:34', '2021-01-23 13:03:59');
INSERT INTO `b5net_config` VALUES ('15', '服务端口', 'sys_email_port', 'text', '0', 'email', '465', '', '', '4', '2021-01-22 15:30:05', '2021-01-23 13:03:59');
INSERT INTO `b5net_config` VALUES ('16', '是否SSL', 'sys_email_ssl', 'select', '0', 'email', '1', '0:否\r\n1:是', '', '5', '2021-01-22 15:31:23', '2021-01-23 13:03:59');
INSERT INTO `b5net_config` VALUES ('17', '网站标题', 'web_site_name', 'text', '0', 'site', 'XXXXXX公司', '', '', '0', '2021-03-24 15:09:24', '2021-05-21 16:58:00');
INSERT INTO `b5net_config` VALUES ('18', '水印文字', 'img_water_text', 'text', '0', 'imgwater', 'B5YiiCMF', '', '', '0', '2021-07-29 20:44:32', '2021-07-29 20:44:32');
INSERT INTO `b5net_config` VALUES ('19', '水印文字大小', 'img_water_text_font', 'text', '0', 'imgwater', '20', '', '', '0', '2021-07-29 20:44:48', '2021-07-29 20:44:48');
INSERT INTO `b5net_config` VALUES ('20', '水印文字颜色', 'img_water_text_color', 'text', '0', 'imgwater', 'ff0000', '', '', '0', '2021-07-29 20:45:03', '2021-07-29 20:45:03');
INSERT INTO `b5net_config` VALUES ('21', '水印位置', 'img_water_text_position', 'select', '0', 'imgwater', 'bottom_right', 'top_left:左上角\r\ntop_right:右上角\r\nbottom_left:左下角\r\nbottom_right:右下角', '', '0', '2021-07-29 20:45:28', '2021-07-29 20:45:28');

-- ----------------------------
-- Table structure for `b5net_demo_img`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_demo_img`;
CREATE TABLE `b5net_demo_img` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `img1` varchar(200) DEFAULT NULL,
  `img2` text,
  `img3` varchar(200) DEFAULT NULL,
  `video` varchar(200) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of b5net_demo_img
-- ----------------------------
INSERT INTO `b5net_demo_img` VALUES ('1', '/uploads/bmimage/2021/07/29/980ecade129c1711178a8e511e6c244e.jpg', '/uploads/bmimage/2021/07/29/07fa053839b2920327bcea76516c8756.jpeg,/uploads/bmimage/2021/07/29/e8198dc2d7a8470a6928163d37399f25.jpeg,/uploads/bmimage/2021/07/29/2509aa5b3a25c0343f09c05fd4c7d3f4.jpeg', '/uploads/bmimage/2021/07/29/8534eac6f8512ae8d14944b264b6b387.jpg', '/uploads/cuvideo/2021/07/29/f830da8f8ea037e786597697b96e9cc2.mp4', null, '2021-07-29 21:10:10');

-- ----------------------------
-- Table structure for `b5net_dict_data`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_dict_data`;
CREATE TABLE `b5net_dict_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '字典编码',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '字典标签',
  `value` varchar(100) NOT NULL DEFAULT '' COMMENT '字典键值',
  `parent_id` int(10) NOT NULL DEFAULT '0',
  `listsort` int(11) NOT NULL DEFAULT '0' COMMENT '字典排序',
  `status` char(1) NOT NULL DEFAULT '1' COMMENT '状态（1正常 0停用）',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  `note` varchar(500) DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`id`),
  KEY `value` (`value`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='字典数据表';

-- ----------------------------
-- Records of b5net_dict_data
-- ----------------------------
INSERT INTO `b5net_dict_data` VALUES ('1', '通知', '1', '1', '1', '1', '2021-01-01 14:39:33', '2021-01-17 21:27:32', '');
INSERT INTO `b5net_dict_data` VALUES ('2', '公告', '2', '1', '2', '1', '2021-01-01 14:40:37', '2021-05-21 16:57:05', '');

-- ----------------------------
-- Table structure for `b5net_dict_type`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_dict_type`;
CREATE TABLE `b5net_dict_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '字典主键',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '字典名称',
  `type` varchar(100) NOT NULL DEFAULT '' COMMENT '字典类型',
  `status` char(1) NOT NULL DEFAULT '1' COMMENT '状态（1正常 0停用）',
  `listsort` int(11) NOT NULL DEFAULT '0',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  `note` varchar(500) DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`id`),
  UNIQUE KEY `dict_type` (`type`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='字典类型表';

-- ----------------------------
-- Records of b5net_dict_type
-- ----------------------------
INSERT INTO `b5net_dict_type` VALUES ('1', '通知类型', 'sys_notice_type', '1', '0', '2020-12-30 14:32:58', '2021-01-17 21:27:26', '通知公告类型列表');

-- ----------------------------
-- Table structure for `b5net_loginlog`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_loginlog`;
CREATE TABLE `b5net_loginlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '访问ID',
  `login_name` varchar(50) DEFAULT '' COMMENT '登录账号',
  `ipaddr` varchar(50) DEFAULT '' COMMENT '登录IP地址',
  `login_location` varchar(255) DEFAULT '' COMMENT '登录地点',
  `browser` varchar(100) DEFAULT '' COMMENT '浏览器类型',
  `os` varchar(100) DEFAULT '' COMMENT '操作系统',
  `net` varchar(50) DEFAULT '',
  `status` char(1) DEFAULT '0' COMMENT '登录状态（0成功 1失败）',
  `msg` varchar(255) DEFAULT '' COMMENT '提示消息',
  `login_time` datetime DEFAULT NULL COMMENT '访问时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COMMENT='系统访问记录';

-- ----------------------------
-- Records of b5net_loginlog
-- ----------------------------
INSERT INTO `b5net_loginlog` VALUES ('1', 'admin', '127.0.0.1', '本机地址', 'Chrome 86.0.4240.198', 'Windows 10.0', '', '0', '用户名或密码不正确', '2021-07-30 14:38:36');
INSERT INTO `b5net_loginlog` VALUES ('2', 'admin', '127.0.0.1', '本机地址', 'Chrome 86.0.4240.198', 'Windows 10.0', '', '1', '登录成功', '2021-07-30 14:38:45');
INSERT INTO `b5net_loginlog` VALUES ('3', 'admin', '127.0.0.1', '本机地址', 'Chrome 86.0.4240.198', 'Windows 10.0', '', '1', '登录成功', '2021-07-30 15:19:21');
INSERT INTO `b5net_loginlog` VALUES ('4', 'admin', '127.0.0.1', '本机地址', 'Chrome 86.0.4240.198', 'Windows 10.0', '', '1', '登录成功', '2021-08-03 17:39:42');
INSERT INTO `b5net_loginlog` VALUES ('5', 'admin', '127.0.0.1', '本机地址', 'Chrome 86.0.4240.198', 'Windows 10.0', '', '1', '登录成功', '2021-08-10 11:48:28');
INSERT INTO `b5net_loginlog` VALUES ('6', 'admin', '127.0.0.1', '本机地址', 'Chrome 86.0.4240.198', 'Windows 10.0', '', '1', '登录成功', '2021-08-16 10:55:45');
INSERT INTO `b5net_loginlog` VALUES ('7', 'admin', '127.0.0.1', '本机地址', 'Chrome 94.0.4606.61', 'Windows 10.0', '', '1', '登录成功', '2022-01-24 17:08:07');
INSERT INTO `b5net_loginlog` VALUES ('8', 'admin', '127.0.0.1', '本机地址', 'Chrome 94.0.4606.61', 'Windows 10.0', '', '1', '登录成功', '2022-03-03 11:24:32');
INSERT INTO `b5net_loginlog` VALUES ('9', 'admin', '127.0.0.1', '本机地址', 'Chrome 94.0.4606.61', 'Windows 10.0', '', '1', '登录成功', '2022-03-06 09:46:17');
INSERT INTO `b5net_loginlog` VALUES ('10', 'admin', '127.0.0.1', '本机地址', 'Chrome 94.0.4606.61', 'Windows 10.0', '', '1', '登录成功', '2022-03-10 15:47:23');
INSERT INTO `b5net_loginlog` VALUES ('11', 'admin', '127.0.0.1', '本机地址', 'Chrome 94.0.4606.61', 'Windows 10.0', '', '1', '登录成功', '2022-03-12 19:43:52');

-- ----------------------------
-- Table structure for `b5net_menu`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_menu`;
CREATE TABLE `b5net_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '菜单ID',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '菜单名称',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT '父菜单ID',
  `listsort` int(11) NOT NULL DEFAULT '0' COMMENT '显示顺序',
  `url` varchar(200) NOT NULL DEFAULT '' COMMENT '请求地址',
  `target` tinyint(1) NOT NULL DEFAULT '0' COMMENT '打开方式（0页签 1新窗口）',
  `type` char(1) NOT NULL DEFAULT '' COMMENT '菜单类型（M目录 C菜单 F按钮）',
  `status` char(1) NOT NULL DEFAULT '1' COMMENT '菜单状态（1显示 0隐藏）',
  `is_refresh` char(1) DEFAULT '0' COMMENT '是否刷新（0不刷新 1刷新）',
  `perms` varchar(100) DEFAULT '' COMMENT '权限标识',
  `icon` varchar(100) DEFAULT '' COMMENT '菜单图标',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  `note` varchar(500) DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`) USING BTREE,
  KEY `listsort` (`listsort`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11006 DEFAULT CHARSET=utf8mb4 COMMENT='菜单权限表';

-- ----------------------------
-- Records of b5net_menu
-- ----------------------------
INSERT INTO `b5net_menu` VALUES ('1', '系统管理', '0', '1', '', '0', 'M', '1', '0', '', 'fa fa-cog', '2021-01-03 07:25:11', '2021-03-29 23:20:25', '系统管理');
INSERT INTO `b5net_menu` VALUES ('2', '权限管理', '0', '2', '', '0', 'M', '1', '0', '', 'fa fa-id-card-o', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '权限管理');
INSERT INTO `b5net_menu` VALUES ('90', '官方网站', '0', '99', 'http://www.b5net.com', '1', 'C', '1', '0', '', 'fa fa-send', '2021-01-05 12:05:30', '2021-01-18 17:07:15', '官方网站');
INSERT INTO `b5net_menu` VALUES ('100', '人员管理', '2', '1', 'admin/index', '0', 'C', '1', '0', 'admin:admin:index', 'fa fa-user-o', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '人员管理');
INSERT INTO `b5net_menu` VALUES ('101', '角色管理', '2', '2', 'role/index', '0', 'C', '1', '0', 'admin:role:index', 'fa fa-address-book-o', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '角色管理');
INSERT INTO `b5net_menu` VALUES ('102', '组织架构', '2', '3', 'struct/index', '0', 'C', '1', '0', 'admin:struct:index', 'fa fa-sitemap', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '组织架构');
INSERT INTO `b5net_menu` VALUES ('103', '菜单管理', '2', '4', 'menu/index', '0', 'C', '1', '0', 'admin:menu:index', 'fa fa-server', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '菜单管理');
INSERT INTO `b5net_menu` VALUES ('104', '登录日志', '2', '5', 'loginlog/index', '0', 'C', '1', '0', 'admin:loginlog:index', 'fa fa-paw', '2021-01-03 07:25:11', '2021-01-07 12:54:43', '登录日志');
INSERT INTO `b5net_menu` VALUES ('105', '参数配置', '1', '1', 'config/index', '0', 'C', '1', '0', 'admin:config:index', 'fa fa-sliders', '2021-01-03 07:25:11', '2021-01-05 12:20:56', '参数配置');
INSERT INTO `b5net_menu` VALUES ('106', '字典管理', '1', '2', 'dict/index', '0', 'C', '1', '0', 'admin:dict:index', 'fa fa-file-code-o', '2021-01-03 07:25:11', '2021-01-05 06:01:47', '字典管理');
INSERT INTO `b5net_menu` VALUES ('107', '通知公告', '1', '10', 'notice/index', '0', 'C', '1', '0', 'admin:notice:index', 'fa fa-bullhorn', '2021-01-03 07:25:11', '2021-03-17 14:05:34', '通知公告');
INSERT INTO `b5net_menu` VALUES ('109', '推荐位置', '1', '4', 'adposition/index', '0', 'C', '1', '0', 'admin:adposition:index', 'fa fa-file-zip-o', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '推荐位置');
INSERT INTO `b5net_menu` VALUES ('110', '推荐信息', '1', '11', 'adlist/index', '0', 'C', '1', '0', 'admin:adlist:index', 'fa fa-sun-o', '2021-01-03 07:25:11', '2021-03-17 14:05:46', '推荐信息');
INSERT INTO `b5net_menu` VALUES ('10000', '用户新增', '100', '1', '', '0', 'F', '1', '0', 'admin:admin:add', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '用户新增');
INSERT INTO `b5net_menu` VALUES ('10001', '用户修改', '100', '2', '', '0', 'F', '1', '0', 'admin:admin:edit', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '用户修改');
INSERT INTO `b5net_menu` VALUES ('10002', '用户删除', '100', '3', '', '0', 'F', '1', '0', 'admin:admin:drop', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '用户删除');
INSERT INTO `b5net_menu` VALUES ('10004', '用户状态', '100', '4', '', '0', 'F', '1', '0', 'admin:admin:setstatus', '', '2021-01-03 07:25:11', '2021-01-08 10:47:09', '用户状态');
INSERT INTO `b5net_menu` VALUES ('10100', '角色新增', '101', '1', '', '0', 'F', '1', '0', 'admin:role:add', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '角色新增');
INSERT INTO `b5net_menu` VALUES ('10101', '角色修改', '101', '2', '', '0', 'F', '1', '0', 'admin:role:edit', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '角色修改');
INSERT INTO `b5net_menu` VALUES ('10102', '角色删除', '101', '3', '', '0', 'F', '1', '0', 'admin:role:drop', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '角色删除');
INSERT INTO `b5net_menu` VALUES ('10104', '角色状态', '101', '4', '', '0', 'F', '1', '0', 'admin:role:setstatus', '', '2021-01-03 07:25:11', '2021-01-08 10:47:31', '角色状态');
INSERT INTO `b5net_menu` VALUES ('10105', '菜单授权', '101', '10', '', '0', 'F', '1', '0', 'admin:role:auth', '', '2021-01-03 07:25:11', '2021-01-07 13:32:41', '菜单授权');
INSERT INTO `b5net_menu` VALUES ('10106', '数据权限', '101', '11', '', '0', 'F', '1', '0', 'admin:role:datascope', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '数据权限');
INSERT INTO `b5net_menu` VALUES ('10200', '组织新增', '102', '1', '', '0', 'F', '1', '0', 'admin:struct:add', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '组织新增');
INSERT INTO `b5net_menu` VALUES ('10201', '组织修改', '102', '2', '', '0', 'F', '1', '0', 'admin:struct:edit', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '组织修改');
INSERT INTO `b5net_menu` VALUES ('10202', '组织删除', '102', '3', '', '0', 'F', '1', '0', 'admin:struct:drop', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '组织删除');
INSERT INTO `b5net_menu` VALUES ('10300', '菜单新增', '103', '1', '', '0', 'F', '1', '0', 'admin:menu:add', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '菜单新增');
INSERT INTO `b5net_menu` VALUES ('10301', '菜单修改', '103', '2', '', '0', 'F', '1', '0', 'admin:menu:edit', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '菜单修改');
INSERT INTO `b5net_menu` VALUES ('10302', '菜单删除', '103', '3', '', '0', 'F', '1', '0', 'admin:menu:drop', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '菜单删除');
INSERT INTO `b5net_menu` VALUES ('10400', '日志删除', '104', '0', '', '0', 'F', '1', '0', 'admin:loginlog:drop', '', '2021-01-07 13:03:15', '2021-01-07 13:03:15', '日志删除');
INSERT INTO `b5net_menu` VALUES ('10401', '日志清空', '104', '0', '', '0', 'F', '1', '0', 'admin:loginlog:trash', '', '2021-01-07 13:04:06', '2021-01-07 13:04:06', '日志清空');
INSERT INTO `b5net_menu` VALUES ('10500', '参数新增', '105', '1', '', '0', 'F', '1', '0', 'admin:config:add', '', '2021-01-03 07:25:11', '2021-01-05 06:00:02', '参数新增');
INSERT INTO `b5net_menu` VALUES ('10501', '参数修改', '105', '2', '', '0', 'F', '1', '0', 'admin:config:edit', '', '2021-01-03 07:25:11', '2021-01-05 06:00:25', '参数修改');
INSERT INTO `b5net_menu` VALUES ('10502', '参数删除', '105', '3', '', '0', 'F', '1', '0', 'admin:config:drop', '', '2021-01-03 07:25:11', '2021-01-05 06:00:59', '参数删除');
INSERT INTO `b5net_menu` VALUES ('10503', '参数批量删除', '105', '4', '', '0', 'F', '1', '0', 'admin:config:dropall', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '参数批量删除');
INSERT INTO `b5net_menu` VALUES ('10504', '清除缓存', '105', '5', '', '0', 'F', '1', '0', 'admin:config:delcache', '', '2021-01-03 07:25:11', '2021-01-08 10:46:47', '清除缓存');
INSERT INTO `b5net_menu` VALUES ('10505', '网站设置', '1', '0', 'config/site', '0', 'C', '1', '0', 'admin:config:site', 'fa fa-object-group', '2021-01-11 22:17:31', '2021-01-11 22:39:46', '网站设置');
INSERT INTO `b5net_menu` VALUES ('10600', '字典新增', '106', '1', '', '0', 'F', '1', '0', 'admin:dict:add', '', '2021-01-03 07:25:11', '2021-01-05 06:02:13', '字典新增');
INSERT INTO `b5net_menu` VALUES ('10601', '字典修改', '106', '2', '', '0', 'F', '1', '0', 'admin:dict:edit', '', '2021-01-03 07:25:11', '2021-01-05 06:02:32', '字典修改');
INSERT INTO `b5net_menu` VALUES ('10602', '字典删除', '106', '3', '', '0', 'F', '1', '0', 'admin:dict:drop', '', '2021-01-03 07:25:11', '2021-01-05 06:02:53', '字典删除');
INSERT INTO `b5net_menu` VALUES ('10603', '清除缓存', '106', '4', '', '0', 'F', '1', '0', 'admin:dict:delcache', '', '2021-01-03 07:25:11', '2021-01-07 15:27:19', '清除缓存');
INSERT INTO `b5net_menu` VALUES ('10610', '数据列表', '106', '10', '', '0', 'F', '1', '0', 'admin:dictdata:index', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '数据列表');
INSERT INTO `b5net_menu` VALUES ('10611', '数据新增', '106', '11', '', '0', 'F', '1', '0', 'admin:dictdata:add', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '数据新增');
INSERT INTO `b5net_menu` VALUES ('10612', '数据修改', '106', '12', '', '0', 'F', '1', '0', 'admin:dictdata:edit', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '数据修改');
INSERT INTO `b5net_menu` VALUES ('10613', '数据删除', '106', '13', '', '0', 'F', '1', '0', 'admin:dictdata:drop', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '数据删除');
INSERT INTO `b5net_menu` VALUES ('10614', '数据批量删除', '106', '14', '', '0', 'F', '1', '0', 'admin:dictdata:dropall', '', '2021-01-03 07:25:11', '2021-05-19 16:10:33', '数据批量删除');
INSERT INTO `b5net_menu` VALUES ('10700', '公告新增', '107', '1', '', '0', 'F', '1', '0', 'admin:notice:add', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '公告新增');
INSERT INTO `b5net_menu` VALUES ('10701', '公告修改', '107', '2', '', '0', 'F', '1', '0', 'admin:notice:edit', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '公告修改');
INSERT INTO `b5net_menu` VALUES ('10702', '公告删除', '107', '3', '', '0', 'F', '1', '0', 'admin:notice:drop', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '公告删除');
INSERT INTO `b5net_menu` VALUES ('10703', '公告批量删除', '107', '4', '', '0', 'F', '1', '0', 'admin:notice:dropall', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '公告批量删除');
INSERT INTO `b5net_menu` VALUES ('10900', '位置新增', '109', '1', '', '0', 'F', '1', '0', 'admin:adposition:add', '', '2021-01-07 15:36:14', '2021-01-07 15:36:14', '位置新增');
INSERT INTO `b5net_menu` VALUES ('10901', '位置编辑', '109', '2', '', '0', 'F', '1', '0', 'admin:adposition:edit', '', '2021-01-07 15:37:56', '2021-01-07 15:37:56', '位置编辑');
INSERT INTO `b5net_menu` VALUES ('10902', '位置删除', '109', '3', '', '0', 'F', '1', '0', 'admin:adposition:drop', '', '2021-01-03 07:25:11', '2021-01-07 15:36:14', '位置删除');
INSERT INTO `b5net_menu` VALUES ('10903', '清除缓存', '109', '4', '', '0', 'F', '1', '0', 'admin:adposition:delcache', '', '2021-01-03 07:25:11', '2021-01-07 15:36:14', '清除缓存');
INSERT INTO `b5net_menu` VALUES ('11000', '信息新增', '110', '1', '', '0', 'F', '1', '0', 'admin:adlist:add', '', '2021-01-08 07:26:14', '2021-01-08 07:26:14', '信息新增');
INSERT INTO `b5net_menu` VALUES ('11001', '信息编辑', '110', '2', '', '0', 'F', '1', '0', 'admin:adlist:edit', '', '2021-01-08 07:26:14', '2021-01-08 07:26:14', '信息编辑');
INSERT INTO `b5net_menu` VALUES ('11002', '信息删除', '110', '3', '', '0', 'F', '1', '0', 'admin:adlist:drop', '', '2021-01-08 07:26:14', '2021-01-08 07:26:14', '信息删除');
INSERT INTO `b5net_menu` VALUES ('11003', '信息批量删除', '110', '5', '', '0', 'F', '1', '0', 'admin:adlist:dropall', '', '2021-01-08 07:26:14', '2021-01-08 07:26:14', '信息批量删除');
INSERT INTO `b5net_menu` VALUES ('11004', '操作实例', '0', '0', '', '0', 'M', '1', '0', '', 'fa fa-cloud', '2021-07-29 20:28:41', '2021-07-29 20:28:41', '');
INSERT INTO `b5net_menu` VALUES ('11005', '图片操作', '11004', '0', 'demoimg/index', '0', 'C', '1', '0', 'admin:demoimg:index', '', '2021-07-29 20:29:15', '2021-07-29 20:29:15', '');

-- ----------------------------
-- Table structure for `b5net_notice`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_notice`;
CREATE TABLE `b5net_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '公告ID',
  `title` varchar(150) NOT NULL DEFAULT '' COMMENT '公告标题',
  `type` varchar(10) DEFAULT '' COMMENT '公告类型（1通知 2公告）',
  `content` text COMMENT '公告内容',
  `textarea` text COMMENT '非html内容',
  `status` char(1) NOT NULL DEFAULT '1' COMMENT '公告状态（1正常 0关闭）',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='通知公告表';

-- ----------------------------
-- Records of b5net_notice
-- ----------------------------
INSERT INTO `b5net_notice` VALUES ('1', '【公告】： B5LaravelCMF新版本发布啦', '2', '<p>新版本内容</p><p><br></p><p>新版本内容</p><p>新版本内容</p><p>新版本内容<br></p>', '', '1', '2020-12-24 11:33:42', '2021-01-18 17:07:21');
INSERT INTO `b5net_notice` VALUES ('2', '【通知】：B5LaravelCMF系统凌晨维护', '1', '<p><font color=\"#0000ff\">维护内容</font><img src=\"/uploads/editor/2021/07/29/3aee1c0951212b455fb847dac4429efd.jpg\" data-filename=\"1\" style=\"width: 200px;\"></p>', '', '1', '2020-12-24 11:33:42', '2021-07-29 21:07:20');

-- ----------------------------
-- Table structure for `b5net_role`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_role`;
CREATE TABLE `b5net_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '角色ID',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '角色名称',
  `rolekey` varchar(50) NOT NULL DEFAULT '' COMMENT '角色权限字符串',
  `data_scope` char(1) NOT NULL DEFAULT '1' COMMENT '数据范围（1：全部数据权限 2：自定数据权限 3：本部门数据权限 4：本部门及以下数据权限）',
  `listsort` int(11) NOT NULL DEFAULT '0' COMMENT '显示顺序',
  `status` char(1) NOT NULL DEFAULT '1' COMMENT '角色状态（1正常 0停用）',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  `note` varchar(500) DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`id`),
  UNIQUE KEY `rolekey` (`rolekey`) USING BTREE,
  KEY `listsort` (`listsort`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='角色信息表';

-- ----------------------------
-- Records of b5net_role
-- ----------------------------
INSERT INTO `b5net_role` VALUES ('1', '超管', 'administrator', '1', '0', '1', '2020-12-28 07:42:31', '2021-05-19 17:30:13', '超级管理员');
INSERT INTO `b5net_role` VALUES ('2', '测试角色', 'common', '3', '1', '1', '2020-12-28 07:44:00', '2022-01-24 17:11:23', '');

-- ----------------------------
-- Table structure for `b5net_role_menu`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_role_menu`;
CREATE TABLE `b5net_role_menu` (
  `role_id` bigint(20) NOT NULL COMMENT '角色ID',
  `menu_id` bigint(20) NOT NULL COMMENT '菜单ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='角色和菜单关联表';

-- ----------------------------
-- Records of b5net_role_menu
-- ----------------------------
INSERT INTO `b5net_role_menu` VALUES ('2', '1');
INSERT INTO `b5net_role_menu` VALUES ('2', '2');
INSERT INTO `b5net_role_menu` VALUES ('2', '90');
INSERT INTO `b5net_role_menu` VALUES ('2', '102');
INSERT INTO `b5net_role_menu` VALUES ('2', '104');
INSERT INTO `b5net_role_menu` VALUES ('2', '107');
INSERT INTO `b5net_role_menu` VALUES ('2', '10400');
INSERT INTO `b5net_role_menu` VALUES ('2', '10401');
INSERT INTO `b5net_role_menu` VALUES ('3', '1');
INSERT INTO `b5net_role_menu` VALUES ('3', '2');
INSERT INTO `b5net_role_menu` VALUES ('3', '104');
INSERT INTO `b5net_role_menu` VALUES ('3', '107');
INSERT INTO `b5net_role_menu` VALUES ('3', '10700');
INSERT INTO `b5net_role_menu` VALUES ('3', '10701');
INSERT INTO `b5net_role_menu` VALUES ('3', '10702');
INSERT INTO `b5net_role_menu` VALUES ('3', '10703');

-- ----------------------------
-- Table structure for `b5net_role_struct`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_role_struct`;
CREATE TABLE `b5net_role_struct` (
  `role_id` int(10) NOT NULL COMMENT '角色ID',
  `struct_id` int(10) NOT NULL COMMENT '部门ID',
  PRIMARY KEY (`role_id`,`struct_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='角色和部门关联表';

-- ----------------------------
-- Records of b5net_role_struct
-- ----------------------------
INSERT INTO `b5net_role_struct` VALUES ('4', '101');
INSERT INTO `b5net_role_struct` VALUES ('4', '103');
INSERT INTO `b5net_role_struct` VALUES ('4', '104');
INSERT INTO `b5net_role_struct` VALUES ('4', '105');
INSERT INTO `b5net_role_struct` VALUES ('4', '111');

-- ----------------------------
-- Table structure for `b5net_smscode`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_smscode`;
CREATE TABLE `b5net_smscode` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mobile` varchar(20) NOT NULL DEFAULT '' COMMENT '手机号码',
  `code` varchar(20) NOT NULL DEFAULT '' COMMENT '验证码',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '例如：1注册 2登录 3忘记密码',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态 0未验证 1已验证',
  `os` varchar(20) NOT NULL DEFAULT '' COMMENT '运营商',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='验证码表';

-- ----------------------------
-- Records of b5net_smscode
-- ----------------------------

-- ----------------------------
-- Table structure for `b5net_struct`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_struct`;
CREATE TABLE `b5net_struct` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '部门id',
  `name` varchar(30) DEFAULT '' COMMENT '部门名称',
  `fullname` varchar(255) DEFAULT '',
  `parent_id` int(11) DEFAULT '0' COMMENT '父部门id',
  `levels` varchar(100) DEFAULT '' COMMENT '祖级列表',
  `listsort` int(11) DEFAULT '0' COMMENT '显示顺序',
  `leader` varchar(20) DEFAULT NULL COMMENT '负责人',
  `phone` varchar(11) DEFAULT NULL COMMENT '联系电话',
  `note` varchar(255) DEFAULT '' COMMENT '备注',
  `status` char(1) DEFAULT '1' COMMENT '部门状态（1正常 0停用）',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8mb4 COMMENT='组织架构';

-- ----------------------------
-- Records of b5net_struct
-- ----------------------------
INSERT INTO `b5net_struct` VALUES ('100', '冰舞科技', '', '0', '0', '0', '冰舞', '15888888888', '', '1', '2020-12-24 11:33:42', '2021-05-19 17:09:25');
INSERT INTO `b5net_struct` VALUES ('101', '北京总公司', '冰舞科技', '100', '0,100', '1', '冰舞', '18888888888', '', '1', '2020-12-24 11:33:42', '2021-05-19 17:09:34');
INSERT INTO `b5net_struct` VALUES ('103', '研发部门', '冰舞科技-北京总公司', '101', '0,100,101', '1', '冰舞', '15888888888', '', '1', '2020-12-24 11:33:42', '2021-05-19 17:10:25');
INSERT INTO `b5net_struct` VALUES ('104', '市场部门', '冰舞科技-北京总公司', '101', '0,100,101', '2', '冰舞', '15888888888', '', '1', '2020-12-24 11:33:42', '2021-05-19 17:09:49');
INSERT INTO `b5net_struct` VALUES ('105', '测试部门', '冰舞科技-北京总公司', '101', '0,100,101', '3', '冰舞', '15888888888', '', '1', '2020-12-24 11:33:42', '2021-05-19 17:09:51');
INSERT INTO `b5net_struct` VALUES ('110', '山东分公司', '冰舞科技', '100', '0,100', '2', '冰舞', '1888888', '', '1', '2021-01-08 11:11:33', '2021-05-19 17:09:56');
INSERT INTO `b5net_struct` VALUES ('111', '销售部门', '冰舞科技-山东分公司', '110', '0,100,110', '1', '', '', '', '1', '2021-01-08 11:11:48', '2021-05-19 17:09:58');
INSERT INTO `b5net_struct` VALUES ('112', 'php开发', '冰舞科技-北京总公司-测试部门', '105', '0,100,101,105', '1', '', '', '', '1', '2021-03-29 18:02:29', '2021-05-19 17:09:53');

-- ----------------------------
-- Table structure for `b5net_wechat_access`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_wechat_access`;
CREATE TABLE `b5net_wechat_access` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `appid` varchar(50) NOT NULL DEFAULT '',
  `access_token` varchar(255) NOT NULL DEFAULT '',
  `jsapi_ticket` varchar(255) NOT NULL DEFAULT '',
  `access_token_add` int(11) NOT NULL DEFAULT '0',
  `jsapi_ticket_add` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `appid` (`appid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='微信jsapi和access';

-- ----------------------------
-- Records of b5net_wechat_access
-- ----------------------------

-- ----------------------------
-- Table structure for `b5net_wechat_users`
-- ----------------------------
DROP TABLE IF EXISTS `b5net_wechat_users`;
CREATE TABLE `b5net_wechat_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `openid` varchar(100) NOT NULL DEFAULT '' COMMENT '唯一标识',
  `appid` varchar(50) NOT NULL DEFAULT '' COMMENT '公众号参数',
  `nickname` varchar(50) NOT NULL DEFAULT '' COMMENT '昵称',
  `headimg` varchar(255) NOT NULL DEFAULT '' COMMENT '头像地址',
  `type` varchar(100) NOT NULL DEFAULT '' COMMENT '所属活动',
  `update_time` datetime DEFAULT NULL COMMENT '资料更新时间',
  `create_time` datetime DEFAULT NULL COMMENT '添加时间',
  `sex` tinyint(1) NOT NULL DEFAULT '0' COMMENT '性别',
  `city` varchar(50) NOT NULL DEFAULT '' COMMENT '城市',
  `country` varchar(50) NOT NULL DEFAULT '' COMMENT '国家',
  `province` varchar(50) NOT NULL DEFAULT '' COMMENT '省份',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`),
  UNIQUE KEY `openid` (`openid`,`appid`,`type`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COMMENT='微信用户信息表';

-- ----------------------------
-- Records of b5net_wechat_users
-- ----------------------------
INSERT INTO `b5net_wechat_users` VALUES ('1', 'oHwQ-52n1phwDERwoeTWlio_vooE', 'wx2dbcd1ebf29bd18f', '李先生', 'https://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83eqBURUj29IqEIsiakaJV6icmctgf8gSWibLNMUsGpUmNPGR1T6W0jYicYcelq4e1lEnwMKUvMQSvVTYCQ/132', 'scratch_1', '2021-03-28 10:45:05', '2021-03-28 10:45:05', '1', '临沂', '中国', '山东', '1');
INSERT INTO `b5net_wechat_users` VALUES ('2', 'oHwQ-5zzJiXhutCVWmSPfQyAx7Yk', 'wx2dbcd1ebf29bd18f', '简单', 'https://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLGqoCcD0iamzHcJDmfU4sKbpqBYxD9icXcTtxlKkia3mB2OZIrIucsnq21FwSvFvBSxsiaTtAm5ZHmeQ/132', 'scratch_1', '2021-04-08 16:47:17', '2021-04-08 16:47:17', '1', '', '中国', '', '1');
INSERT INTO `b5net_wechat_users` VALUES ('3', 'oHwQ-5_qj1L9HHnUpclLOJPh_Z7M', 'wx2dbcd1ebf29bd18f', '九方资源ヽ赖小伙 ', 'https://thirdwx.qlogo.cn/mmopen/vi_32/fKibib5mxicWGxOgAQY0PUucIft3D243GXLMkm4vMY7cJmqzR2Zmhr9nrsTR1PFfDXlCsZ3sJcy4UGwptNu7CmSwQ/132', 'scratch_1', '2021-04-14 14:07:13', '2021-04-14 14:07:13', '1', '赣州', '中国', '江西', '1');
INSERT INTO `b5net_wechat_users` VALUES ('4', 'oHwQ-54NH0I3WbRt77eF5-EKo-C8', 'wx2dbcd1ebf29bd18f', 'Hello World', 'https://thirdwx.qlogo.cn/mmopen/vi_32/M3PEicW5ziceOUdVDX7vQicZgvxDMPYCaiavl4l2m8IFPyzSHMTbiaeL3mtaXMiafD8CJQicFrNoHiau1ypkJo0m2HYibcw/132', 'scratch_1', '2021-04-19 21:24:36', '2021-04-19 21:24:36', '1', '', '黑山', '', '1');
