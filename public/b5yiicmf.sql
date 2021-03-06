/*
 Navicat Premium Data Transfer

 Source Server         : 我的新ECS
 Source Server Type    : MySQL
 Source Server Version : 80023
 Source Host           : 47.114.86.223:3306
 Source Schema         : b5yiicmf_b5net

 Target Server Type    : MySQL
 Target Server Version : 80023
 File Encoding         : 65001

 Date: 28/03/2021 16:57:11
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for b5net_adlist
-- ----------------------------
DROP TABLE IF EXISTS `b5net_adlist`;
CREATE TABLE `b5net_adlist`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '信息标题',
  `adtype` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '推荐位置',
  `redtype` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '跳转类型',
  `redfunc` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '跳转模块',
  `redinfo` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '跳转值',
  `listsort` int(0) NOT NULL DEFAULT 0 COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态',
  `text_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '文本信息',
  `text_rich` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '富文本信息',
  `imglist` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '图片信息',
  `create_time` datetime(0) NULL DEFAULT NULL,
  `update_time` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '推荐信息表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of b5net_adlist
-- ----------------------------
INSERT INTO `b5net_adlist` VALUES (2, '测试大苏打大苏打', 'web_index_banner', 'func', 'notice', '', 1, 1, 'asdsadasd', '<p><img style=\"width: 50%;\" src=\"/uploads/editor/2021/01/18/0c4395ade564554f101b80705d024e65.jpg\" data-filename=\"timg (2)\"><br></p><p><br></p><p><br></p><p></p><p><br></p><p><br></p><p><br></p><p><br></p><p><br></p><p><br></p><p><br></p><p>asdasdsadasd</p><p>asdasdasdasd</p>', '/uploads/adlist/2021/01/18/a0ba84471fdb59a513106827fa8a7ee0.jpg', '2021-01-05 03:33:07', '2021-01-18 17:07:56');

-- ----------------------------
-- Table structure for b5net_admin
-- ----------------------------
DROP TABLE IF EXISTS `b5net_admin`;
CREATE TABLE `b5net_admin`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '登录名',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '登录密码',
  `realname` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '人员姓名',
  `status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1' COMMENT '状态',
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '备注',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  `last_time` datetime(0) NULL DEFAULT NULL COMMENT '登录时间',
  `last_ip` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '登录ip',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `username`(`username`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '管理员表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of b5net_admin
-- ----------------------------
INSERT INTO `b5net_admin` VALUES (1, 'admin', '$2y$13$8vnjhCPxSzfg2nR65q6vyu.GDKWRUXSp0ArRk.ClLY55ovWrhNcEu', '超管', '1', '超级管理员', '2020-12-24 10:50:56', '2021-01-19 11:35:50', '2021-03-17 13:39:31', '123.132.237.18');
INSERT INTO `b5net_admin` VALUES (2, 'ceshi', '$2y$13$sHMB3vFS2dBDrIrHOqvpQO1Y7nhGEAj6/FjgorgxMd5ZVgzXxKSG2', '测试1111', '1', '测试账号', '2020-12-24 13:14:57', '2021-03-26 10:43:19', '2021-03-28 12:48:13', '113.70.230.182');

-- ----------------------------
-- Table structure for b5net_admin_role
-- ----------------------------
DROP TABLE IF EXISTS `b5net_admin_role`;
CREATE TABLE `b5net_admin_role`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `admin_id` int(0) NOT NULL COMMENT '用户ID',
  `role_id` int(0) NOT NULL COMMENT '角色ID',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `admin_id`(`admin_id`, `role_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 33 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '用户和角色关联表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of b5net_admin_role
-- ----------------------------
INSERT INTO `b5net_admin_role` VALUES (30, 1, 1);
INSERT INTO `b5net_admin_role` VALUES (32, 2, 2);

-- ----------------------------
-- Table structure for b5net_admin_struct
-- ----------------------------
DROP TABLE IF EXISTS `b5net_admin_struct`;
CREATE TABLE `b5net_admin_struct`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `admin_id` int(0) NOT NULL COMMENT '用户ID',
  `struct_id` int(0) NOT NULL COMMENT '组织ID',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '用户与组织架构关联表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of b5net_admin_struct
-- ----------------------------
INSERT INTO `b5net_admin_struct` VALUES (20, 1, 100);
INSERT INTO `b5net_admin_struct` VALUES (23, 2, 103);
INSERT INTO `b5net_admin_struct` VALUES (24, 2, 105);

-- ----------------------------
-- Table structure for b5net_adposition
-- ----------------------------
DROP TABLE IF EXISTS `b5net_adposition`;
CREATE TABLE `b5net_adposition`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '唯一标识',
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '位置名称',
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '备注',
  `width` mediumint(0) NULL DEFAULT 0,
  `height` mediumint(0) NULL DEFAULT 0,
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `name`(`type`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '推荐位置表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of b5net_adposition
-- ----------------------------
INSERT INTO `b5net_adposition` VALUES (1, 'web_index_banner', '首页banner图片', '宽高为1920*400像素', 0, 0, '2021-01-08 06:02:11', '2021-01-18 17:06:36');

-- ----------------------------
-- Table structure for b5net_app_token
-- ----------------------------
DROP TABLE IF EXISTS `b5net_app_token`;
CREATE TABLE `b5net_app_token`  (
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `user_id` int(0) NOT NULL DEFAULT 0 COMMENT '用户ID',
  `addtime` int(0) NOT NULL DEFAULT 0 COMMENT '添加时间',
  `type` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '类型',
  PRIMARY KEY (`token`) USING BTREE,
  UNIQUE INDEX `token`(`token`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for b5net_config
-- ----------------------------
DROP TABLE IF EXISTS `b5net_config`;
CREATE TABLE `b5net_config`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '配置ID',
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '配置名称',
  `type` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '配置标识',
  `style` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '配置类型',
  `is_sys` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0' COMMENT '是否系统内置 0否 1是',
  `groups` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '配置分组',
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '配置值',
  `extra` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '配置项',
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '配置说明',
  `listsort` int(0) UNSIGNED NOT NULL DEFAULT 0 COMMENT '排序',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '系统配置表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of b5net_config
-- ----------------------------
INSERT INTO `b5net_config` VALUES (1, '配置分组', 'sys_config_group', 'array', '0', '', 'site:基本设置\r\nwx:微信设置\r\nsms:短信配置\r\nemail:邮箱配置', '', '系统配置的分组配置', 0, '2020-12-30 16:17:10', '2021-01-22 15:27:12');
INSERT INTO `b5net_config` VALUES (2, '系统名称', 'sys_config_sysname', 'text', '0', 'site', 'B5LaravleCMF', '', '系统后台显示的名称', 0, '2020-12-31 14:01:18', '2021-01-18 17:06:10');
INSERT INTO `b5net_config` VALUES (3, '演示模式', 'sys_config_demo', 'select', '0', 'site', '1', '1:开启\r\n0:关闭', '开启后，除超管外不可进行非查询操作', 0, '2021-01-08 05:58:25', '2021-01-18 17:06:10');
INSERT INTO `b5net_config` VALUES (4, '阿里accessKeyId', 'sms_ali_key', 'text', '0', 'sms', '', '', '阿里短信-AccessKey ID', 0, '2021-01-11 19:26:13', '2021-01-17 21:27:04');
INSERT INTO `b5net_config` VALUES (5, '阿里accessSecret', 'sms_ali_secret', 'text', '0', 'sms', '', '', '阿里短信-AccessKey Secret', 1, '2021-01-11 19:26:45', '2021-01-17 21:27:04');
INSERT INTO `b5net_config` VALUES (6, '阿里signName', 'sms_ali_signname', 'text', '0', 'sms', '', '', '阿里短信-签名', 2, '2021-01-11 19:27:53', '2021-01-17 21:27:04');
INSERT INTO `b5net_config` VALUES (7, '阿里tempId', 'sms_ali_temp', 'text', '0', 'sms', '', '', '阿里短信-tempId模板', 3, '2021-01-11 19:30:21', '2021-01-17 21:27:04');
INSERT INTO `b5net_config` VALUES (8, '聚合appkey', 'sms_juhe_appkey', 'text', '0', 'sms', '', '', '聚合短信-APPKEY', 10, '2021-01-11 19:33:27', '2021-01-17 21:27:04');
INSERT INTO `b5net_config` VALUES (9, '聚合tempId', 'sms_juhe_temp', 'text', '0', 'sms', '', '', '聚合短信-TPLID模板', 11, '2021-01-11 19:34:26', '2021-01-17 21:27:04');
INSERT INTO `b5net_config` VALUES (10, '公众号appid', 'wechat_appid', 'text', '0', 'wx', 'wx2dbcd1ebf29bd18f', '', '微信公众号的AppId', 0, '2021-01-12 11:05:50', '2021-03-27 23:06:59');
INSERT INTO `b5net_config` VALUES (11, '公众号secret', 'wechat_appsecret', 'text', '0', 'wx', '8f2ea486cf4182ba9211d26cdb7c343a', '', '微信公众号-AppSecret', 1, '2021-01-12 11:06:24', '2021-03-27 23:06:59');
INSERT INTO `b5net_config` VALUES (12, '服务地址', 'sys_email_host', 'text', '0', 'email', 'smtp.163.com', '', '类似:smtp.163.com', 1, '2021-01-22 15:28:10', '2021-01-23 13:03:59');
INSERT INTO `b5net_config` VALUES (13, '邮箱地址', 'sys_email_username', 'text', '0', 'email', 'lyyd_lh@163.com', '', '发送邮件的邮箱地址', 2, '2021-01-22 15:28:39', '2021-01-23 13:03:59');
INSERT INTO `b5net_config` VALUES (14, '授权密码', 'sys_email_password', 'text', '0', 'email', 'UCSMPMHNDJSALQVW', '', '', 3, '2021-01-22 15:29:34', '2021-01-23 13:03:59');
INSERT INTO `b5net_config` VALUES (15, '服务端口', 'sys_email_port', 'text', '0', 'email', '465', '', '', 4, '2021-01-22 15:30:05', '2021-01-23 13:03:59');
INSERT INTO `b5net_config` VALUES (16, '是否SSL', 'sys_email_ssl', 'select', '0', 'email', '1', '0:否\r\n1:是', '', 5, '2021-01-22 15:31:23', '2021-01-23 13:03:59');
INSERT INTO `b5net_config` VALUES (17, '网站标题', 'web_site_name', 'text', '0', 'site', 'XXXXXX公司', '', '', 0, '2021-03-24 15:09:24', '2021-03-24 15:09:30');

-- ----------------------------
-- Table structure for b5net_dict_data
-- ----------------------------
DROP TABLE IF EXISTS `b5net_dict_data`;
CREATE TABLE `b5net_dict_data`  (
  `id` int(0) NOT NULL AUTO_INCREMENT COMMENT '字典编码',
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '字典标签',
  `value` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '字典键值',
  `type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '字典类型',
  `listsort` int(0) NOT NULL DEFAULT 0 COMMENT '字典排序',
  `status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1' COMMENT '状态（1正常 0停用）',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  `note` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `value`(`value`) USING BTREE,
  INDEX `type`(`type`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '字典数据表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of b5net_dict_data
-- ----------------------------
INSERT INTO `b5net_dict_data` VALUES (1, '通知', '1', 'sys_notice_type', 1, '1', '2021-01-01 14:39:33', '2021-01-17 21:27:32', '');
INSERT INTO `b5net_dict_data` VALUES (2, '公告', '2', 'sys_notice_type', 2, '1', '2021-01-01 14:40:37', '2021-01-01 14:41:14', '');
INSERT INTO `b5net_dict_data` VALUES (3, '无跳转', 'none', 'sys_redtype_type', 1, '1', '2021-01-04 06:12:52', '2021-01-18 16:48:29', '');
INSERT INTO `b5net_dict_data` VALUES (4, 'URL链接', 'url', 'sys_redtype_type', 2, '1', '2021-01-04 06:13:16', '2021-01-04 06:14:25', '');
INSERT INTO `b5net_dict_data` VALUES (5, '功能模块', 'func', 'sys_redtype_type', 3, '1', '2021-01-04 06:13:45', '2021-01-04 06:13:45', '');
INSERT INTO `b5net_dict_data` VALUES (6, '信息内容', 'info', 'sys_redtype_type', 4, '1', '2021-01-04 06:14:13', '2021-01-18 17:06:27', '');

-- ----------------------------
-- Table structure for b5net_dict_type
-- ----------------------------
DROP TABLE IF EXISTS `b5net_dict_type`;
CREATE TABLE `b5net_dict_type`  (
  `id` int(0) NOT NULL AUTO_INCREMENT COMMENT '字典主键',
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '字典名称',
  `type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '字典类型',
  `status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1' COMMENT '状态（1正常 0停用）',
  `listsort` int(0) NOT NULL DEFAULT 0,
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  `note` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `dict_type`(`type`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '字典类型表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of b5net_dict_type
-- ----------------------------
INSERT INTO `b5net_dict_type` VALUES (1, '通知类型', 'sys_notice_type', '1', 0, '2020-12-30 14:32:58', '2021-01-17 21:27:26', '通知公告类型列表');
INSERT INTO `b5net_dict_type` VALUES (2, '跳转类型', 'sys_redtype_type', '1', 1, '2021-01-04 06:12:22', '2021-01-18 17:06:17', '跳转管理中的跳转类型');

-- ----------------------------
-- Table structure for b5net_loginlog
-- ----------------------------
DROP TABLE IF EXISTS `b5net_loginlog`;
CREATE TABLE `b5net_loginlog`  (
  `id` int(0) NOT NULL AUTO_INCREMENT COMMENT '访问ID',
  `login_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '登录账号',
  `ipaddr` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '登录IP地址',
  `login_location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '登录地点',
  `browser` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '浏览器类型',
  `os` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '操作系统',
  `net` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '',
  `status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0' COMMENT '登录状态（0成功 1失败）',
  `msg` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '提示消息',
  `login_time` datetime(0) NULL DEFAULT NULL COMMENT '访问时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 221 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '系统访问记录' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of b5net_loginlog
-- ----------------------------
INSERT INTO `b5net_loginlog` VALUES (1, 'ceshi', '144.52.190.101', '山东省临沂市', 'Chrome 86.0.4240.198', 'Windows 10.0', '电信', '1', '登录成功', '2021-01-20 21:43:22');
INSERT INTO `b5net_loginlog` VALUES (2, 'ceshi', '106.8.79.163', '河北省廊坊市', 'Chrome 87.0.4280.141', 'Windows 10.0', '电信', '1', '登录成功', '2021-01-21 12:00:07');
INSERT INTO `b5net_loginlog` VALUES (3, 'ceshi', '27.42.99.228', '广东省珠海市', 'Chrome 87.0.4280.141', 'Windows 10.0', '联通', '0', '验证码不正确', '2021-01-21 15:36:31');
INSERT INTO `b5net_loginlog` VALUES (4, 'ceshi', '27.42.99.228', '广东省珠海市', 'Chrome 87.0.4280.141', 'Windows 10.0', '联通', '1', '登录成功', '2021-01-21 15:36:41');
INSERT INTO `b5net_loginlog` VALUES (5, 'ceshi', '120.85.238.127', '广东省广州市', 'Chrome 78.0.3904.108', 'Windows 10.0', '联通', '1', '登录成功', '2021-01-24 20:37:02');
INSERT INTO `b5net_loginlog` VALUES (6, 'ceshi', '36.25.64.170', '浙江省', 'Chrome 87.0.4280.141', 'Windows 10.0', '电信', '1', '登录成功', '2021-01-27 09:13:34');
INSERT INTO `b5net_loginlog` VALUES (7, 'ceshi', '111.14.244.107', '山东省济南市', 'Chrome 87.0.4280.141', 'OS X 11_1_0', '移动', '1', '登录成功', '2021-01-28 12:18:59');
INSERT INTO `b5net_loginlog` VALUES (8, 'ceshi', '113.65.70.27', '广东省广州市', 'Edge 88.0.705.56', 'Windows 10.0', '电信', '1', '登录成功', '2021-01-31 10:05:00');
INSERT INTO `b5net_loginlog` VALUES (9, 'ceshi', '113.70.219.192', '广东省佛山市', 'Chrome 83.0.4103.116', 'Windows 10.0', '电信', '1', '登录成功', '2021-02-02 16:05:17');
INSERT INTO `b5net_loginlog` VALUES (10, 'ceshi', '27.184.26.127', '河北省石家庄市', 'Chrome 86.0.4240.183', 'Windows 6.1', '电信', '1', '登录成功', '2021-02-03 10:31:18');
INSERT INTO `b5net_loginlog` VALUES (11, 'ceshi', '111.14.244.107', '山东省济南市', 'Chrome 88.0.4324.146', 'OS X 11_2_0', '移动', '1', '登录成功', '2021-02-04 12:31:05');
INSERT INTO `b5net_loginlog` VALUES (12, 'ceshi', '115.206.246.244', '浙江省杭州市', 'Chrome 88.0.4324.146', 'OS X 10_15_7', '电信', '0', '验证码不正确', '2021-02-18 17:24:54');
INSERT INTO `b5net_loginlog` VALUES (13, 'ceshi', '115.206.246.244', '浙江省杭州市', 'Chrome 88.0.4324.146', 'OS X 10_15_7', '电信', '0', '验证码不正确', '2021-02-18 17:25:04');
INSERT INTO `b5net_loginlog` VALUES (14, 'ceshi', '115.206.246.244', '浙江省杭州市', 'Chrome 88.0.4324.146', 'OS X 10_15_7', '电信', '1', '登录成功', '2021-02-18 17:25:14');
INSERT INTO `b5net_loginlog` VALUES (15, 'ceshi', '58.35.215.135', '上海市', 'Chrome 88.0.4324.182', 'Windows 10.0', '电信', '1', '登录成功', '2021-02-20 16:51:50');
INSERT INTO `b5net_loginlog` VALUES (16, 'ceshi', '110.87.217.60', '福建省三明市', 'Chrome 78.0.3904.108', 'Windows 10.0', '电信', '1', '登录成功', '2021-02-23 09:53:58');
INSERT INTO `b5net_loginlog` VALUES (17, 'ceshi', '36.5.78.14', '安徽省合肥市', 'Chrome 78.0.3904.108', 'Windows 10.0', '电信', '1', '登录成功', '2021-02-24 17:01:37');
INSERT INTO `b5net_loginlog` VALUES (18, 'ceshi', '180.113.63.70', '江苏省无锡市', 'Chrome 88.0.4324.190', 'Windows 10.0', '电信', '1', '登录成功', '2021-03-02 13:26:37');
INSERT INTO `b5net_loginlog` VALUES (19, 'ceshi', '124.126.200.248', '北京市', 'Chrome 88.0.4324.190', 'Windows 10.0', '中国电信北京研究院', '1', '登录成功', '2021-03-02 19:16:03');
INSERT INTO `b5net_loginlog` VALUES (20, 'ceshi', '117.64.15.219', '安徽省合肥市', 'Chrome 75.0.3770.156', 'AndroidOS 10', '电信', '1', '登录成功', '2021-03-02 23:58:26');
INSERT INTO `b5net_loginlog` VALUES (21, 'ceshi', '121.35.2.239', '广东省深圳市', 'Chrome 88.0.4324.104', 'Windows 10.0', '电信', '0', '验证码不正确', '2021-03-03 09:00:40');
INSERT INTO `b5net_loginlog` VALUES (22, 'ceshi', '121.35.2.239', '广东省深圳市', 'Chrome 88.0.4324.104', 'Windows 10.0', '电信', '1', '登录成功', '2021-03-03 09:00:57');
INSERT INTO `b5net_loginlog` VALUES (23, 'ceshi', '123.138.150.52', '陕西省西安市', 'Chrome 88.0.4324.190', 'Windows 10.0', '联通', '0', '验证码不正确', '2021-03-03 09:33:12');
INSERT INTO `b5net_loginlog` VALUES (24, 'ceshi', '123.138.150.52', '陕西省西安市', 'Chrome 88.0.4324.190', 'Windows 10.0', '联通', '1', '登录成功', '2021-03-03 09:33:21');
INSERT INTO `b5net_loginlog` VALUES (25, 'ceshi', '123.138.150.52', '陕西省西安市', 'Chrome 88.0.4324.190', 'Windows 10.0', '联通', '1', '登录成功', '2021-03-03 09:40:03');
INSERT INTO `b5net_loginlog` VALUES (26, 'ceshi', '220.202.227.231', '湖南省', 'Chrome 88.0.4324.150', 'Windows 10.0', '联通', '1', '登录成功', '2021-03-03 11:10:27');
INSERT INTO `b5net_loginlog` VALUES (27, 'ceshi', '119.250.178.30', '河北省廊坊市广阳区', 'Chrome 78.0.3904.108', 'Windows 10.0', '联通', '1', '登录成功', '2021-03-08 14:53:36');
INSERT INTO `b5net_loginlog` VALUES (28, 'ceshi', '115.204.5.166', '浙江省杭州市', 'Chrome 88.0.4324.190', 'Windows 10.0', '电信', '1', '登录成功', '2021-03-08 15:14:03');
INSERT INTO `b5net_loginlog` VALUES (29, 'ceshi', '121.19.245.188', '河北省保定市', 'Chrome 87.0.4280.88', 'Windows 10.0', '联通', '1', '登录成功', '2021-03-08 15:27:29');
INSERT INTO `b5net_loginlog` VALUES (30, 'ceshi', '27.185.24.47', '河北省石家庄市', 'Chrome 65.0.3325.181', 'Windows 10.0', '电信', '1', '登录成功', '2021-03-08 16:17:51');
INSERT INTO `b5net_loginlog` VALUES (31, '213', '27.185.24.47', '河北省石家庄市', 'Chrome 65.0.3325.181', 'Windows 10.0', '电信', '0', '验证码不正确', '2021-03-08 17:25:19');
INSERT INTO `b5net_loginlog` VALUES (32, '213', '27.185.24.47', '河北省石家庄市', 'Chrome 65.0.3325.181', 'Windows 10.0', '电信', '0', '验证码不正确', '2021-03-08 17:25:21');
INSERT INTO `b5net_loginlog` VALUES (33, '213', '27.185.24.47', '河北省石家庄市', 'Chrome 65.0.3325.181', 'Windows 10.0', '电信', '0', '验证码不正确', '2021-03-08 17:25:24');
INSERT INTO `b5net_loginlog` VALUES (34, 'ceshi', '219.139.202.206', '湖北省武汉市', 'Chrome 89.0.4389.72', 'Windows 10.0', '电信', '1', '登录成功', '2021-03-08 18:02:41');
INSERT INTO `b5net_loginlog` VALUES (35, 'ceshi', '123.159.110.108', '浙江省温州市', 'Chrome 88.0.4324.150', 'Windows 10.0', '联通', '0', '验证码不正确', '2021-03-08 20:40:13');
INSERT INTO `b5net_loginlog` VALUES (36, 'ceshi', '123.159.110.108', '浙江省温州市', 'Chrome 88.0.4324.150', 'Windows 10.0', '联通', '1', '登录成功', '2021-03-08 20:40:23');
INSERT INTO `b5net_loginlog` VALUES (37, 'admin', '182.109.119.127', '江西省吉安市', 'Chrome 86.0.4240.111', 'Windows 6.1', '电信', '0', '用户名或密码不正确', '2021-03-09 09:27:09');
INSERT INTO `b5net_loginlog` VALUES (38, 'admin', '182.109.119.127', '江西省吉安市', 'Chrome 86.0.4240.111', 'Windows 6.1', '电信', '0', '验证码不正确', '2021-03-09 09:27:14');
INSERT INTO `b5net_loginlog` VALUES (39, 'admin', '182.109.119.127', '江西省吉安市', 'Chrome 86.0.4240.111', 'Windows 6.1', '电信', '0', '验证码不正确', '2021-03-09 09:27:19');
INSERT INTO `b5net_loginlog` VALUES (40, 'admin', '182.109.119.127', '江西省吉安市', 'Chrome 86.0.4240.111', 'Windows 6.1', '电信', '0', '用户名或密码不正确', '2021-03-09 09:27:28');
INSERT INTO `b5net_loginlog` VALUES (41, 'ceshi', '1.85.220.131', '陕西省西安市', 'Chrome 87.0.4280.66', 'Windows 10.0', '电信', '1', '登录成功', '2021-03-09 09:29:36');
INSERT INTO `b5net_loginlog` VALUES (42, 'ceshi', '101.224.245.2', '上海市', 'Chrome 88.0.4324.192', 'OS X 11_2_0', '电信', '1', '登录成功', '2021-03-09 11:27:14');
INSERT INTO `b5net_loginlog` VALUES (43, 'admin', '124.89.103.40', '陕西省西安市', 'Chrome 88.0.4324.190', 'Windows 10.0', 'QQ旋风离线服务器', '0', '用户名或密码不正确', '2021-03-09 13:37:14');
INSERT INTO `b5net_loginlog` VALUES (44, 'ceshi', '124.89.103.40', '陕西省西安市', 'Chrome 88.0.4324.190', 'Windows 10.0', 'QQ旋风离线服务器', '1', '登录成功', '2021-03-09 13:37:30');
INSERT INTO `b5net_loginlog` VALUES (45, 'ceshi', '123.132.237.18', '山东省临沂市', 'Chrome 86.0.4240.198', 'Windows 10.0', '联通', '1', '登录成功', '2021-03-09 16:15:49');
INSERT INTO `b5net_loginlog` VALUES (46, 'ceshi', '124.133.51.196', '山东省济南市', 'Chrome 88.0.4324.192', 'OS X 10_15_6', '联通', '1', '登录成功', '2021-03-09 16:50:32');
INSERT INTO `b5net_loginlog` VALUES (47, 'ceshi', '124.133.51.196', '山东省济南市', 'Chrome 88.0.4324.192', 'OS X 10_15_6', '联通', '1', '登录成功', '2021-03-09 17:01:11');
INSERT INTO `b5net_loginlog` VALUES (48, 'ceshi', '113.246.166.72', '湖南省长沙市', 'Chrome 88.0.4324.190', 'Windows 10.0', '电信', '1', '登录成功', '2021-03-09 17:35:08');
INSERT INTO `b5net_loginlog` VALUES (49, 'ceshi', '112.10.89.35', '浙江省杭州市', 'Chrome 88.0.4324.192', 'OS X 10_14_0', '移动', '1', '登录成功', '2021-03-09 21:10:53');
INSERT INTO `b5net_loginlog` VALUES (50, 'ceshi', '36.161.108.13', '安徽省', 'Chrome 88.0.4324.190', 'Windows 10.0', '移动', '1', '登录成功', '2021-03-10 00:47:42');
INSERT INTO `b5net_loginlog` VALUES (51, 'ceshi', '123.117.91.247', '北京市昌平区', 'Chrome 89.0.4389.82', 'Windows 10.0', '联通', '1', '登录成功', '2021-03-10 10:06:27');
INSERT INTO `b5net_loginlog` VALUES (52, 'ceshi', '60.168.52.145', '安徽省合肥市', 'Chrome 89.0.4389.82', 'OS X 10_15_4', '电信', '1', '登录成功', '2021-03-10 10:37:07');
INSERT INTO `b5net_loginlog` VALUES (53, 'ceshi', '124.133.51.196', '山东省济南市', 'Chrome 78.0.3904.108', 'OS X 10_14_6', '联通', '1', '登录成功', '2021-03-10 11:09:11');
INSERT INTO `b5net_loginlog` VALUES (54, 'ceshi', '47.103.154.49', '上海市', 'Chrome 89.0.4389.82', 'OS X 10_14_5', '阿里云', '1', '登录成功', '2021-03-10 14:39:35');
INSERT INTO `b5net_loginlog` VALUES (55, 'ceshi', '113.16.56.237', '广西南宁市', 'Chrome 90.0.4430.11', 'Windows 10.0', '电信', '0', '验证码不正确', '2021-03-10 15:43:51');
INSERT INTO `b5net_loginlog` VALUES (56, 'ceshi', '113.16.56.237', '广西南宁市', 'Chrome 90.0.4430.11', 'Windows 10.0', '电信', '0', '验证码不正确', '2021-03-10 15:44:03');
INSERT INTO `b5net_loginlog` VALUES (57, 'ceshi', '113.16.56.237', '广西南宁市', 'Chrome 90.0.4430.11', 'Windows 10.0', '电信', '1', '登录成功', '2021-03-10 15:44:10');
INSERT INTO `b5net_loginlog` VALUES (58, 'ceshi', '220.191.34.112', '浙江省杭州市西湖区', 'Chrome 86.0.4240.111', 'Windows 10.0', '电信', '1', '登录成功', '2021-03-10 18:18:32');
INSERT INTO `b5net_loginlog` VALUES (59, 'ceshi', '171.43.215.170', '湖北省武汉市', 'Chrome 89.0.4389.82', 'Windows 10.0', '电信', '1', '登录成功', '2021-03-11 08:27:49');
INSERT INTO `b5net_loginlog` VALUES (60, 'ceshi', '13.94.27.46', '香港', 'Chrome 81.0.4044.138', 'Windows 10.0', 'Microsoft数据中心', '1', '登录成功', '2021-03-11 08:42:22');
INSERT INTO `b5net_loginlog` VALUES (61, 'ceshi', '112.9.1.102', '山东省青岛市', 'Chrome 88.0.4324.192', 'OS X 11_1_0', '移动', '1', '登录成功', '2021-03-11 10:59:13');
INSERT INTO `b5net_loginlog` VALUES (62, 'ceshi', '36.4.217.53', '安徽省马鞍山市', 'Chrome 87.0.4280.88', 'Windows 10.0', '电信', '1', '登录成功', '2021-03-11 13:33:26');
INSERT INTO `b5net_loginlog` VALUES (63, 'ceshi', '182.138.227.152', '四川省成都市', 'Chrome 88.0.4324.192', 'OS X 11_0_1', '电信', '1', '登录成功', '2021-03-11 14:20:30');
INSERT INTO `b5net_loginlog` VALUES (64, 'ceshi', '27.209.111.139', '山东省滨州市', 'Chrome 88.0.4324.192', 'OS X 10_15_3', '联通', '1', '登录成功', '2021-03-11 14:37:53');
INSERT INTO `b5net_loginlog` VALUES (65, 'ceshi', '180.141.111.239', '广西北海市', 'Chrome 83.0.4103.61', 'Windows 6.1', '电信', '0', '验证码不正确', '2021-03-11 16:14:07');
INSERT INTO `b5net_loginlog` VALUES (66, 'ceshi', '180.141.111.239', '广西北海市', 'Chrome 83.0.4103.61', 'Windows 6.1', '电信', '1', '登录成功', '2021-03-11 16:14:16');
INSERT INTO `b5net_loginlog` VALUES (67, 'ceshi', '1.80.120.59', '陕西省西安市', 'Chrome 88.0.4324.190', 'Windows 10.0', '电信', '1', '登录成功', '2021-03-11 17:39:37');
INSERT INTO `b5net_loginlog` VALUES (68, 'ceshi', '1.80.120.59', '陕西省西安市', 'Chrome 88.0.4324.190', 'Windows 10.0', '电信', '1', '登录成功', '2021-03-11 18:25:22');
INSERT INTO `b5net_loginlog` VALUES (69, 'ceshi', '223.115.12.169', '新疆喀什地区', 'Chrome 88.0.4324.150', 'Windows 10.0', '移动', '1', '登录成功', '2021-03-11 20:03:59');
INSERT INTO `b5net_loginlog` VALUES (70, 'ceshi', '123.189.38.10', '辽宁省鞍山市', 'Chrome 78.0.3904.108', 'Windows 10.0', '联通', '0', '验证码不正确', '2021-03-11 23:03:49');
INSERT INTO `b5net_loginlog` VALUES (71, 'ceshi', '123.189.38.10', '辽宁省鞍山市', 'Chrome 78.0.3904.108', 'Windows 10.0', '联通', '1', '登录成功', '2021-03-11 23:03:57');
INSERT INTO `b5net_loginlog` VALUES (72, 'ceshi', '116.252.162.74', '广西南宁市', 'Chrome 83.0.4103.61', 'Windows 6.1', '电信', '1', '登录成功', '2021-03-11 23:18:54');
INSERT INTO `b5net_loginlog` VALUES (73, 'ceshi', '116.252.162.74', '广西南宁市', 'Chrome 83.0.4103.61', 'Windows 6.1', '电信', '1', '登录成功', '2021-03-11 23:58:04');
INSERT INTO `b5net_loginlog` VALUES (74, 'ceshi', '113.111.195.63', '广东省广州市', 'Chrome 89.0.4389.82', 'OS X 11_2_3', '电信', '1', '登录成功', '2021-03-12 09:23:23');
INSERT INTO `b5net_loginlog` VALUES (75, 'ceshi', '123.149.86.231', '河南省郑州市', 'Edge 89.0.774.50', 'Windows 10.0', '电信', '1', '登录成功', '2021-03-12 11:23:41');
INSERT INTO `b5net_loginlog` VALUES (76, 'ceshi', '58.62.193.189', '广东省广州市荔湾区', 'Chrome 87.0.4280.141', 'Windows 10.0', '电信', '1', '登录成功', '2021-03-12 11:24:45');
INSERT INTO `b5net_loginlog` VALUES (77, 'ceshi', '183.216.206.138', '江西省宜春市', 'Chrome 86.0.4240.111', 'Windows 10.0', '移动', '1', '登录成功', '2021-03-12 11:56:44');
INSERT INTO `b5net_loginlog` VALUES (78, 'ceshi', '60.186.104.215', '浙江省杭州市', 'Chrome 89.0.4389.82', 'Windows 10.0', '电信', '1', '登录成功', '2021-03-12 13:58:34');
INSERT INTO `b5net_loginlog` VALUES (79, 'ceshi', '119.122.90.236', '广东省深圳市', 'Chrome 88.0.4324.150', 'Windows 10.0', '电信', '1', '登录成功', '2021-03-12 14:21:54');
INSERT INTO `b5net_loginlog` VALUES (80, 'ceshi', '222.129.121.72', '北京市', 'Chrome 89.0.4389.82', 'OS X 11_2_3', '联通', '0', '验证码不正确', '2021-03-12 14:36:03');
INSERT INTO `b5net_loginlog` VALUES (81, 'ceshi', '222.129.121.72', '北京市', 'Chrome 89.0.4389.82', 'OS X 11_2_3', '联通', '1', '登录成功', '2021-03-12 14:36:11');
INSERT INTO `b5net_loginlog` VALUES (82, 'ceshi', '39.74.20.66', '山东省德州市', 'Chrome 72.0.3626.81', 'Windows 10.0', '联通', '1', '登录成功', '2021-03-12 16:40:40');
INSERT INTO `b5net_loginlog` VALUES (83, 'ceshi', '111.225.250.28', '河北省保定市', 'Firefox 86.0', 'Windows 6.1', '电信', '1', '登录成功', '2021-03-12 18:00:11');
INSERT INTO `b5net_loginlog` VALUES (84, 'ceshi', '111.225.250.28', '河北省保定市', 'Firefox 86.0', 'Windows 6.1', '电信', '1', '登录成功', '2021-03-12 18:00:21');
INSERT INTO `b5net_loginlog` VALUES (85, 'ceshi', '111.225.250.28', '河北省保定市', 'Firefox 86.0', 'Windows 6.1', '电信', '0', '验证码不正确', '2021-03-12 18:00:26');
INSERT INTO `b5net_loginlog` VALUES (86, 'ceshi', '116.252.162.74', '广西南宁市', 'Chrome 55.0.2883.87', 'Windows 6.1', '电信', '1', '登录成功', '2021-03-12 21:44:54');
INSERT INTO `b5net_loginlog` VALUES (87, 'ceshi', '223.115.113.77', '新疆图木舒克市', 'Chrome 69.0.3947.100', 'Windows 10.0', '移动', '1', '登录成功', '2021-03-12 23:55:01');
INSERT INTO `b5net_loginlog` VALUES (88, 'ceshi', '39.73.124.89', '山东省临沂市', 'Chrome 88.0.4324.146', 'Windows 10.0', '联通', '1', '登录成功', '2021-03-13 10:21:53');
INSERT INTO `b5net_loginlog` VALUES (89, 'ceshi', '121.238.58.200', '江苏省无锡市', 'Edge 89.0.774.50', 'Windows 10.0', '电信', '1', '登录成功', '2021-03-13 10:53:31');
INSERT INTO `b5net_loginlog` VALUES (90, 'ceshi', '121.238.58.200', '江苏省无锡市', 'Edge 89.0.774.50', 'Windows 10.0', '电信', '1', '登录成功', '2021-03-13 10:53:50');
INSERT INTO `b5net_loginlog` VALUES (91, 'ceshi', '58.100.30.228', '浙江省杭州市', 'Chrome 49.0.2623.112', 'Windows 5.1', '华数', '1', '登录成功', '2021-03-13 18:03:33');
INSERT INTO `b5net_loginlog` VALUES (92, 'ceshi', '116.252.83.18', '广西南宁市', 'Chrome 83.0.4103.61', 'Windows 6.1', '电信', '0', '验证码不正确', '2021-03-14 11:16:08');
INSERT INTO `b5net_loginlog` VALUES (93, 'ceshi', '116.252.83.18', '广西南宁市', 'Chrome 83.0.4103.61', 'Windows 6.1', '电信', '1', '登录成功', '2021-03-14 11:16:17');
INSERT INTO `b5net_loginlog` VALUES (94, 'ceshi', '36.33.37.225', '安徽省合肥市', 'Safari 14.0.3', 'OS X 10_14_6', '联通', '1', '登录成功', '2021-03-14 12:59:34');
INSERT INTO `b5net_loginlog` VALUES (95, 'ceshi', '113.117.172.105', '广东省中山市', 'Chrome 89.0.4389.82', 'Windows 6.1', '电信', '1', '登录成功', '2021-03-15 08:46:31');
INSERT INTO `b5net_loginlog` VALUES (96, 'ceshi', '113.91.55.75', '广东省深圳市', 'Edge 89.0.774.50', 'Windows 10.0', '电信', '1', '登录成功', '2021-03-15 09:41:26');
INSERT INTO `b5net_loginlog` VALUES (97, 'ceshi', '182.46.191.2', '山东省聊城市', 'Chrome 88.0.4324.96', 'Windows 10.0', '电信', '1', '登录成功', '2021-03-15 10:43:43');
INSERT INTO `b5net_loginlog` VALUES (98, 'ceshi', '1.80.186.130', '陕西省西安市', 'Edge 89.0.774.50', 'Windows 10.0', '电信', '1', '登录成功', '2021-03-15 11:40:00');
INSERT INTO `b5net_loginlog` VALUES (99, 'ceshi', '119.146.144.4', '广东省梅州市', 'Chrome 89.0.4389.82', 'Windows 10.0', '电信', '1', '登录成功', '2021-03-15 16:52:55');
INSERT INTO `b5net_loginlog` VALUES (100, 'ceshi', '120.229.24.15', '广东省深圳市', 'Chrome 89.0.4389.82', 'Windows 10.0', '移动', '1', '登录成功', '2021-03-15 18:01:40');
INSERT INTO `b5net_loginlog` VALUES (101, 'ceshi', '113.17.41.109', '广西百色市', 'Safari 13.1.1', 'OS X 10_15_5', '电信', '1', '登录成功', '2021-03-15 19:59:09');
INSERT INTO `b5net_loginlog` VALUES (102, 'ceshi', '221.220.195.227', '北京市通州区', 'Safari 14.0.3', 'OS X 10_15_6', '联通', '1', '登录成功', '2021-03-15 21:02:17');
INSERT INTO `b5net_loginlog` VALUES (103, 'ceshi', '140.255.122.199', '山东省青岛市', 'Firefox 86.0', 'Windows 10.0', '电信', '1', '登录成功', '2021-03-15 21:12:42');
INSERT INTO `b5net_loginlog` VALUES (104, 'ceshi', '115.60.5.6', '河南省郑州市', 'Chrome 87.0.4280.66', 'Windows 10.0', '联通', '1', '登录成功', '2021-03-16 11:24:17');
INSERT INTO `b5net_loginlog` VALUES (105, 'ceshi', '124.202.186.130', '北京市', 'Chrome 89.0.4389.82', 'OS X 10_13_3', '鹏博士BGP', '1', '登录成功', '2021-03-16 15:48:32');
INSERT INTO `b5net_loginlog` VALUES (106, 'ceshi', '27.18.217.216', '湖北省武汉市', 'Chrome 87.0.4280.141', 'Windows 10.0', '电信', '1', '登录成功', '2021-03-16 16:20:22');
INSERT INTO `b5net_loginlog` VALUES (107, 'ceshi', '113.137.200.178', '陕西省西安市', 'Mozilla ', 'iOS 13_3', '电信', '1', '登录成功', '2021-03-16 19:24:16');
INSERT INTO `b5net_loginlog` VALUES (108, 'ceshi', '114.255.8.68', '北京市', 'Chrome 58.0.3029.110', 'Windows 6.1', '联通', '0', '验证码不正确', '2021-03-16 20:17:42');
INSERT INTO `b5net_loginlog` VALUES (109, 'ceshi', '119.136.154.199', '广东省深圳市', 'Chrome 69.0.3497.100', 'Windows 10.0', '电信', '1', '登录成功', '2021-03-16 21:27:19');
INSERT INTO `b5net_loginlog` VALUES (110, 'ceshi', '1.80.156.233', '陕西省西安市临潼区', 'Chrome 89.0.4389.82', 'Windows 10.0', '电信', '0', '验证码不正确', '2021-03-16 21:52:39');
INSERT INTO `b5net_loginlog` VALUES (111, 'ceshi', '1.80.156.233', '陕西省西安市临潼区', 'Chrome 89.0.4389.82', 'Windows 10.0', '电信', '1', '登录成功', '2021-03-16 21:52:47');
INSERT INTO `b5net_loginlog` VALUES (112, 'ceshi', '139.170.84.75', '青海省西宁市', 'Chrome 76.0.3809.89', 'AndroidOS 11', '联通', '1', '登录成功', '2021-03-16 22:52:14');
INSERT INTO `b5net_loginlog` VALUES (113, 'ceshi', '222.90.233.78', '陕西省西安市', 'Chrome 89.0.4389.82', 'Windows 10.0', '电信', '0', '验证码不正确', '2021-03-17 09:42:26');
INSERT INTO `b5net_loginlog` VALUES (114, 'ceshi', '222.90.233.78', '陕西省西安市', 'Chrome 89.0.4389.82', 'Windows 10.0', '电信', '1', '登录成功', '2021-03-17 09:42:40');
INSERT INTO `b5net_loginlog` VALUES (115, 'ceshi', '139.170.130.191', '青海省西宁市', 'Chrome 89.0.4389.82', 'Windows 10.0', '联通', '1', '登录成功', '2021-03-17 10:31:06');
INSERT INTO `b5net_loginlog` VALUES (116, 'ceshi', '116.26.172.170', '广东省汕头市', 'Chrome 49.0.2623.112', 'Windows 6.1', '电信', '1', '登录成功', '2021-03-17 11:58:53');
INSERT INTO `b5net_loginlog` VALUES (117, 'admin', '123.132.237.18', '山东省临沂市', 'Chrome 86.0.4240.198', 'Windows 10.0', '联通', '0', '用户名或密码不正确', '2021-03-17 13:39:17');
INSERT INTO `b5net_loginlog` VALUES (118, 'admin', '123.132.237.18', '山东省临沂市', 'Chrome 86.0.4240.198', 'Windows 10.0', '联通', '0', '验证码不正确', '2021-03-17 13:39:24');
INSERT INTO `b5net_loginlog` VALUES (119, 'admin', '123.132.237.18', '山东省临沂市', 'Chrome 86.0.4240.198', 'Windows 10.0', '联通', '1', '登录成功', '2021-03-17 13:39:31');
INSERT INTO `b5net_loginlog` VALUES (120, 'ceshi', '121.69.1.86', '北京市', 'Chrome 89.0.4389.82', 'OS X 11_2_2', '鹏博士BGP', '1', '登录成功', '2021-03-17 14:10:48');
INSERT INTO `b5net_loginlog` VALUES (121, 'ceshi', '113.200.81.36', '陕西省西安市', 'Chrome 89.0.4389.90', 'Windows 10.0', '联通', '1', '登录成功', '2021-03-17 17:45:08');
INSERT INTO `b5net_loginlog` VALUES (122, 'ceshi', '171.88.149.62', '四川省成都市', 'Chrome 87.0.4280.141', 'Windows 10.0', '电信', '1', '登录成功', '2021-03-17 17:55:27');
INSERT INTO `b5net_loginlog` VALUES (123, 'ceshi', '223.115.12.51', '新疆喀什地区', 'Chrome 78.0.3904.108', 'Windows 10.0', '移动', '1', '登录成功', '2021-03-17 18:03:02');
INSERT INTO `b5net_loginlog` VALUES (124, 'ceshi', '175.9.30.241', '湖南省长沙市', 'Chrome 86.0.4240.198', 'Windows 6.1', '电信', '1', '登录成功', '2021-03-17 22:16:54');
INSERT INTO `b5net_loginlog` VALUES (125, 'ceshi', '113.17.43.176', '广西河池市', 'Chrome 88.0.4324.192', 'OS X 10_15_5', '电信', '0', '验证码不正确', '2021-03-17 23:07:16');
INSERT INTO `b5net_loginlog` VALUES (126, 'ceshi', '113.17.43.176', '广西河池市', 'Chrome 88.0.4324.192', 'OS X 10_15_5', '电信', '1', '登录成功', '2021-03-17 23:07:25');
INSERT INTO `b5net_loginlog` VALUES (127, 'ceshi', '220.160.65.1', '福建省福州市', 'Safari 12.1.2', 'OS X 10_12_6', '电信', '1', '登录成功', '2021-03-18 08:20:22');
INSERT INTO `b5net_loginlog` VALUES (128, 'ceshi', '2.244.112.51', '德国', 'Chrome 88.0.4324.150', 'Windows 10.0', '', '1', '登录成功', '2021-03-18 10:04:57');
INSERT INTO `b5net_loginlog` VALUES (129, 'ceshi', '2.244.112.51', '德国', 'Chrome 88.0.4324.150', 'Windows 10.0', '', '1', '登录成功', '2021-03-18 10:08:24');
INSERT INTO `b5net_loginlog` VALUES (130, 'ceshi', '113.200.81.36', '陕西省西安市', 'Chrome 89.0.4389.90', 'Windows 10.0', '联通', '0', '验证码不正确', '2021-03-18 12:11:26');
INSERT INTO `b5net_loginlog` VALUES (131, 'ceshi', '113.200.81.36', '陕西省西安市', 'Chrome 89.0.4389.90', 'Windows 10.0', '联通', '1', '登录成功', '2021-03-18 12:11:34');
INSERT INTO `b5net_loginlog` VALUES (132, 'ceshi', '103.85.172.117', '北京市', 'Chrome 89.0.4389.82', 'Windows 10.0', '电信', '1', '登录成功', '2021-03-18 14:21:20');
INSERT INTO `b5net_loginlog` VALUES (133, 'ceshi', '117.136.23.40', '湖北省', 'Edge 89.0.774.54', 'Windows 10.0', '移动数据上网公共出口', '1', '登录成功', '2021-03-18 15:57:02');
INSERT INTO `b5net_loginlog` VALUES (134, 'ceshi', '111.173.243.192', '湖北省武汉市', 'Chrome 88.0.4324.150', 'Linux ', '电信', '1', '登录成功', '2021-03-18 16:33:52');
INSERT INTO `b5net_loginlog` VALUES (135, 'ceshi', '139.226.50.22', '上海市', 'Chrome 62.0.3202.62', 'Windows 10.0', '联通', '1', '登录成功', '2021-03-18 17:02:06');
INSERT INTO `b5net_loginlog` VALUES (136, 'ceshi', '1.119.203.254', '北京市', 'Chrome 89.0.4389.90', 'Windows 10.0', '联通', '1', '登录成功', '2021-03-18 17:14:52');
INSERT INTO `b5net_loginlog` VALUES (137, 'ceshi', '223.115.12.51', '新疆喀什地区', 'Chrome 90.0.4412.5', 'Windows 10.0', '移动', '0', '验证码不正确', '2021-03-18 20:04:33');
INSERT INTO `b5net_loginlog` VALUES (138, 'ceshi', '223.115.12.51', '新疆喀什地区', 'Chrome 90.0.4412.5', 'Windows 10.0', '移动', '1', '登录成功', '2021-03-18 20:04:41');
INSERT INTO `b5net_loginlog` VALUES (139, 'ceshi', '183.217.175.140', '江西省宜春市', 'Chrome 75.0.3770.100', 'Windows 6.1', '移动', '0', '验证码不正确', '2021-03-18 20:20:51');
INSERT INTO `b5net_loginlog` VALUES (140, 'ceshi', '183.217.175.140', '江西省宜春市', 'Chrome 75.0.3770.100', 'Windows 6.1', '移动', '1', '登录成功', '2021-03-18 20:21:01');
INSERT INTO `b5net_loginlog` VALUES (141, 'ceshi', '60.168.132.35', '安徽省合肥市', 'Chrome 87.0.4280.88', 'Windows 10.0', '电信', '1', '登录成功', '2021-03-19 11:26:58');
INSERT INTO `b5net_loginlog` VALUES (142, 'ceshi', '222.94.167.71', '江苏省南京市', 'Chrome 78.0.3904.108', 'Windows 6.1', '电信', '0', '验证码不正确', '2021-03-19 14:37:47');
INSERT INTO `b5net_loginlog` VALUES (143, 'ceshi', '222.94.167.71', '江苏省南京市', 'Chrome 78.0.3904.108', 'Windows 6.1', '电信', '1', '登录成功', '2021-03-19 14:37:54');
INSERT INTO `b5net_loginlog` VALUES (144, 'ceshi', '113.66.196.57', '广东省广州市', 'Chrome 89.0.4389.90', 'Windows 10.0', '电信', '0', '验证码不正确', '2021-03-19 17:35:03');
INSERT INTO `b5net_loginlog` VALUES (145, 'ceshi', '113.66.196.57', '广东省广州市', 'Chrome 89.0.4389.90', 'Windows 10.0', '电信', '0', '验证码不正确', '2021-03-19 17:35:35');
INSERT INTO `b5net_loginlog` VALUES (146, 'ceshi', '113.66.196.57', '广东省广州市', 'Chrome 89.0.4389.90', 'Windows 10.0', '电信', '1', '登录成功', '2021-03-19 17:35:47');
INSERT INTO `b5net_loginlog` VALUES (147, 'ceshi', '122.224.140.154', '浙江省杭州市', 'Chrome 89.0.4389.90', 'OS X 10_13_6', '电信', '0', '验证码不正确', '2021-03-19 17:47:15');
INSERT INTO `b5net_loginlog` VALUES (148, 'ceshi', '122.224.140.154', '浙江省杭州市', 'Chrome 89.0.4389.90', 'OS X 10_13_6', '电信', '1', '登录成功', '2021-03-19 17:47:30');
INSERT INTO `b5net_loginlog` VALUES (149, 'ceshi', '124.78.169.241', '上海市浦东新区', 'Chrome 89.0.4389.82', 'Windows 10.0', '电信', '1', '登录成功', '2021-03-19 17:49:00');
INSERT INTO `b5net_loginlog` VALUES (150, 'ceshi', '113.200.81.36', '陕西省西安市', 'Chrome 89.0.4389.90', 'Windows 10.0', '联通', '1', '登录成功', '2021-03-19 18:04:31');
INSERT INTO `b5net_loginlog` VALUES (151, 'ceshi', '118.199.166.176', '北京市', 'Chrome 87.0.4280.88', 'Windows 6.1', '鹏博士BGP', '1', '登录成功', '2021-03-19 20:39:41');
INSERT INTO `b5net_loginlog` VALUES (152, 'ceshi', '180.120.238.254', '江苏省南通市', 'Safari 14.0.3', 'OS X 10_15_6', '电信', '1', '登录成功', '2021-03-19 21:52:37');
INSERT INTO `b5net_loginlog` VALUES (153, 'ceshi', '122.97.179.151', '江苏省', 'Chrome 85.0.4183.121', 'Windows 10.0', '联通', '1', '登录成功', '2021-03-20 00:31:52');
INSERT INTO `b5net_loginlog` VALUES (154, 'ceshi', '122.97.179.151', '江苏省', 'Chrome 85.0.4183.121', 'Windows 10.0', '联通', '1', '登录成功', '2021-03-20 00:32:37');
INSERT INTO `b5net_loginlog` VALUES (155, 'ceshi', '2.244.134.126', '德国', 'Chrome 88.0.4324.150', 'Windows 10.0', '', '1', '登录成功', '2021-03-20 03:32:32');
INSERT INTO `b5net_loginlog` VALUES (156, 'ceshi', '221.10.101.35', '四川省德阳市', 'Chrome 76.0.3809.62', 'Windows 10.0', '联通', '0', '验证码不正确', '2021-03-20 14:32:20');
INSERT INTO `b5net_loginlog` VALUES (157, 'ceshi', '221.10.101.35', '四川省德阳市', 'Chrome 76.0.3809.62', 'Windows 10.0', '联通', '1', '登录成功', '2021-03-20 14:32:27');
INSERT INTO `b5net_loginlog` VALUES (158, 'ceshi', '221.10.101.35', '四川省德阳市', 'Chrome 76.0.3809.62', 'Windows 10.0', '联通', '0', '验证码不正确', '2021-03-20 14:32:58');
INSERT INTO `b5net_loginlog` VALUES (159, 'ceshi', '221.10.101.35', '四川省德阳市', 'Chrome 76.0.3809.62', 'Windows 10.0', '联通', '1', '登录成功', '2021-03-20 14:33:11');
INSERT INTO `b5net_loginlog` VALUES (160, 'ceshi', '59.173.123.77', '湖北省武汉市', 'Chrome 88.0.4324.150', 'Windows 10.0', '电信', '1', '登录成功', '2021-03-20 16:13:49');
INSERT INTO `b5net_loginlog` VALUES (161, 'ceshi', '223.115.14.127', '新疆喀什地区', 'Chrome 78.0.3904.108', 'Windows 10.0', '移动', '0', '验证码不正确', '2021-03-20 16:15:43');
INSERT INTO `b5net_loginlog` VALUES (162, 'ceshi', '223.115.14.127', '新疆喀什地区', 'Chrome 78.0.3904.108', 'Windows 10.0', '移动', '0', '验证码不正确', '2021-03-20 16:15:51');
INSERT INTO `b5net_loginlog` VALUES (163, 'ceshi', '223.115.14.127', '新疆喀什地区', 'Chrome 78.0.3904.108', 'Windows 10.0', '移动', '1', '登录成功', '2021-03-20 16:16:08');
INSERT INTO `b5net_loginlog` VALUES (164, 'ceshi', '175.161.174.174', '辽宁省沈阳市', 'Chrome 48.0.2564.116', 'Windows 10.0', '联通', '1', '登录成功', '2021-03-20 19:04:30');
INSERT INTO `b5net_loginlog` VALUES (165, 'ceshi', '183.229.152.147', '重庆市', 'Chrome 78.0.3904.108', 'Windows 10.0', '移动', '0', '验证码不正确', '2021-03-21 08:05:45');
INSERT INTO `b5net_loginlog` VALUES (166, 'ceshi', '183.229.152.147', '重庆市', 'Chrome 78.0.3904.108', 'Windows 10.0', '移动', '0', '验证码不正确', '2021-03-21 08:05:55');
INSERT INTO `b5net_loginlog` VALUES (167, 'ceshi', '183.229.152.147', '重庆市', 'Chrome 78.0.3904.108', 'Windows 10.0', '移动', '1', '登录成功', '2021-03-21 08:06:05');
INSERT INTO `b5net_loginlog` VALUES (168, 'ceshi', '111.19.39.33', '陕西省西安市', 'Chrome 89.0.4389.90', 'Windows 10.0', '移动', '0', '验证码不正确', '2021-03-21 18:58:43');
INSERT INTO `b5net_loginlog` VALUES (169, 'ceshi', '111.19.39.33', '陕西省西安市', 'Chrome 89.0.4389.90', 'Windows 10.0', '移动', '1', '登录成功', '2021-03-21 18:58:54');
INSERT INTO `b5net_loginlog` VALUES (170, 'ceshi', '183.135.152.147', '浙江省宁波市', 'Chrome 86.0.4240.198', 'Windows 10.0', '电信', '1', '登录成功', '2021-03-21 22:45:57');
INSERT INTO `b5net_loginlog` VALUES (171, 'ceshi', '113.218.217.120', '湖南省长沙市', 'Chrome 86.0.4240.198', 'Windows 10.0', '电信', '1', '登录成功', '2021-03-22 10:09:56');
INSERT INTO `b5net_loginlog` VALUES (172, 'ceshi', '115.236.178.242', '浙江省杭州市', 'Chrome 78.0.3904.108', 'Windows 10.0', '电信数据中心', '1', '登录成功', '2021-03-22 13:37:55');
INSERT INTO `b5net_loginlog` VALUES (173, 'ceshi', '36.7.68.19', '安徽省合肥市', 'Chrome 88.0.4324.182', 'Windows 10.0', '电信', '1', '登录成功', '2021-03-22 13:52:40');
INSERT INTO `b5net_loginlog` VALUES (174, 'ceshi', '223.100.6.179', '辽宁省沈阳市', 'Edge 89.0.774.57', 'Windows 10.0', '移动', '1', '登录成功', '2021-03-22 17:32:37');
INSERT INTO `b5net_loginlog` VALUES (175, 'ceshi', '218.26.44.210', '山西省晋城市', 'Chrome 91.0.4442.4', 'Windows 10.0', '联通', '1', '登录成功', '2021-03-23 09:43:46');
INSERT INTO `b5net_loginlog` VALUES (176, 'ceshi', '43.224.44.140', '北京市', 'Chrome 89.0.4389.82', 'Windows 10.0', '维实嘉业网络科技有限公司', '1', '登录成功', '2021-03-23 09:59:52');
INSERT INTO `b5net_loginlog` VALUES (177, 'ceshi', '183.17.229.120', '广东省深圳市', 'Chrome 72.0.3626.121', 'Windows 10.0', '电信', '1', '登录成功', '2021-03-23 10:41:24');
INSERT INTO `b5net_loginlog` VALUES (178, 'ceshi', '222.211.237.144', '四川省成都市', 'Chrome 89.0.4389.90', 'Windows 6.1', '电信', '1', '登录成功', '2021-03-23 12:04:05');
INSERT INTO `b5net_loginlog` VALUES (179, 'ceshi', '222.211.237.144', '四川省成都市', 'Chrome 89.0.4389.90', 'Windows 6.1', '电信', '1', '登录成功', '2021-03-23 12:07:43');
INSERT INTO `b5net_loginlog` VALUES (180, 'ceshi', '219.155.87.242', '河南省郑州市', 'Chrome 89.0.4389.90', 'Windows 10.0', '联通', '1', '登录成功', '2021-03-23 17:32:31');
INSERT INTO `b5net_loginlog` VALUES (181, 'ceshi', '220.249.4.122', '北京市', 'Safari 14.0.3', 'OS X 10_15_6', '联通', '1', '登录成功', '2021-03-23 18:03:21');
INSERT INTO `b5net_loginlog` VALUES (182, 'ceshi', '118.199.166.176', '北京市', 'Chrome 87.0.4280.88', 'Windows 6.1', '鹏博士BGP', '1', '登录成功', '2021-03-23 20:09:57');
INSERT INTO `b5net_loginlog` VALUES (183, 'ceshi', '117.188.20.164', '贵州省', 'Chrome 89.0.4389.90', 'OS X 10_13_6', '移动', '0', '验证码不正确', '2021-03-23 21:37:17');
INSERT INTO `b5net_loginlog` VALUES (184, 'ceshi', '183.251.16.185', '福建省厦门市', 'Chrome 86.0.4240.111', 'Windows 10.0', '移动', '1', '登录成功', '2021-03-23 22:37:44');
INSERT INTO `b5net_loginlog` VALUES (185, 'ceshi', '111.173.246.46', '湖北省武汉市', 'Chrome 88.0.4324.150', 'Linux ', '电信', '1', '登录成功', '2021-03-24 08:00:06');
INSERT INTO `b5net_loginlog` VALUES (186, 'ceshi', '218.26.44.210', '山西省晋城市', 'Chrome 91.0.4442.4', 'Windows 10.0', '联通', '1', '登录成功', '2021-03-24 10:50:28');
INSERT INTO `b5net_loginlog` VALUES (187, 'ceshi', '117.136.54.128', '天津市', 'Chrome 88.0.4500.0', 'Windows 10.0', '移动数据上网公共出口', '1', '登录成功', '2021-03-24 13:27:20');
INSERT INTO `b5net_loginlog` VALUES (188, 'ceshi', '115.218.107.204', '浙江省温州市', 'Firefox 86.0', 'Windows 6.1', '电信', '0', '验证码不正确', '2021-03-24 14:28:10');
INSERT INTO `b5net_loginlog` VALUES (189, 'ceshi', '115.218.107.204', '浙江省温州市', 'Firefox 86.0', 'Windows 6.1', '电信', '1', '登录成功', '2021-03-24 14:28:23');
INSERT INTO `b5net_loginlog` VALUES (190, 'ceshi', '183.92.248.144', '湖北省随州市', 'Chrome 88.0.4324.192', 'OS X 10_15_6', '联通', '1', '登录成功', '2021-03-24 15:34:13');
INSERT INTO `b5net_loginlog` VALUES (191, 'ceshi', '218.249.45.162', '北京市', 'Chrome 89.0.4389.90', 'Windows 10.0', '鹏博士BGP', '1', '登录成功', '2021-03-24 15:45:39');
INSERT INTO `b5net_loginlog` VALUES (192, 'ceshi', '222.128.93.4', '北京市', 'Safari 14.0.3', 'OS X 10_15_6', '联通', '0', '验证码不正确', '2021-03-24 17:06:20');
INSERT INTO `b5net_loginlog` VALUES (193, 'ceshi', '222.128.93.4', '北京市', 'Safari 14.0.3', 'OS X 10_15_6', '联通', '1', '登录成功', '2021-03-24 17:06:29');
INSERT INTO `b5net_loginlog` VALUES (194, 'ceshi', '124.200.101.10', '北京市', 'Chrome 89.0.4389.90', 'Windows 10.0', '鹏博士BGP', '1', '登录成功', '2021-03-24 18:17:49');
INSERT INTO `b5net_loginlog` VALUES (195, 'ceshi', '223.104.10.98', '江西省', 'Safari 14.0.3', 'iOS 14_4_1', '移动数据上网公共出口', '1', '登录成功', '2021-03-24 19:29:41');
INSERT INTO `b5net_loginlog` VALUES (196, 'ceshi', '45.135.186.140', '香港', 'Chrome 89.0.4389.90', 'OS X 11_2_3', 'LEASEWEB', '1', '登录成功', '2021-03-24 21:43:30');
INSERT INTO `b5net_loginlog` VALUES (197, 'ceshi', '112.64.61.94', '上海市徐汇区', 'Chrome 89.0.4389.90', 'OS X 10_15_5', '联通漕河泾数据中心', '1', '登录成功', '2021-03-24 22:36:22');
INSERT INTO `b5net_loginlog` VALUES (198, 'ceshi', '112.64.61.94', '上海市徐汇区', 'Chrome 89.0.4389.90', 'OS X 10_15_5', '联通漕河泾数据中心', '1', '登录成功', '2021-03-24 22:36:46');
INSERT INTO `b5net_loginlog` VALUES (199, 'ceshi', '113.87.183.185', '广东省深圳市', 'Chrome 87.0.4280.141', 'Linux ', '电信', '1', '登录成功', '2021-03-24 22:58:23');
INSERT INTO `b5net_loginlog` VALUES (200, 'ceshi', '121.8.34.190', '广东省', 'Chrome 89.0.4389.90', 'AndroidOS 10', '电信', '1', '登录成功', '2021-03-25 02:02:57');
INSERT INTO `b5net_loginlog` VALUES (201, 'ceshi', '218.19.137.128', '广东省广州市天河区', 'Chrome 89.0.4389.90', 'Windows 10.0', '电信', '0', '验证码不正确', '2021-03-25 11:08:48');
INSERT INTO `b5net_loginlog` VALUES (202, 'ceshi', '218.19.137.128', '广东省广州市天河区', 'Chrome 89.0.4389.90', 'Windows 10.0', '电信', '1', '登录成功', '2021-03-25 11:09:03');
INSERT INTO `b5net_loginlog` VALUES (203, 'ceshi', '182.137.186.75', '四川省绵阳市', 'Chrome 89.0.4389.90', 'Windows 10.0', '电信', '0', '验证码不正确', '2021-03-25 11:23:17');
INSERT INTO `b5net_loginlog` VALUES (204, 'ceshi', '182.137.186.75', '四川省绵阳市', 'Chrome 89.0.4389.90', 'Windows 10.0', '电信', '1', '登录成功', '2021-03-25 11:23:25');
INSERT INTO `b5net_loginlog` VALUES (205, 'ceshi', '121.15.131.171', '广东省', 'Chrome 88.0.4324.182', 'Linux ', '电信', '0', '验证码不正确', '2021-03-25 18:57:53');
INSERT INTO `b5net_loginlog` VALUES (206, 'ceshi', '121.15.131.171', '广东省', 'Chrome 88.0.4324.182', 'Linux ', '电信', '1', '登录成功', '2021-03-25 18:58:04');
INSERT INTO `b5net_loginlog` VALUES (207, 'ceshi', '117.147.41.85', '浙江省温州市', 'Chrome 89.0.4389.90', 'OS X 11_1_0', '移动', '1', '登录成功', '2021-03-25 22:30:30');
INSERT INTO `b5net_loginlog` VALUES (208, 'ceshi', '123.132.237.18', '山东省临沂市', 'Chrome 70.0.3538.25', 'Windows 10.0', '联通', '0', '用户名或密码不正确', '2021-03-26 10:42:44');
INSERT INTO `b5net_loginlog` VALUES (209, 'ceshi', '123.132.237.18', '山东省临沂市', 'Chrome 70.0.3538.25', 'Windows 10.0', '联通', '0', '用户名或密码不正确', '2021-03-26 10:42:59');
INSERT INTO `b5net_loginlog` VALUES (210, 'ceshi', '123.132.237.18', '山东省临沂市', 'Chrome 70.0.3538.25', 'Windows 10.0', '联通', '0', '用户名或密码不正确', '2021-03-26 10:44:08');
INSERT INTO `b5net_loginlog` VALUES (211, 'ceshi', '123.132.237.18', '山东省临沂市', 'Chrome 70.0.3538.25', 'Windows 10.0', '联通', '1', '登录成功', '2021-03-26 10:44:23');
INSERT INTO `b5net_loginlog` VALUES (212, 'ceshi', '123.132.237.18', '山东省临沂市', 'Chrome 70.0.3538.25', 'Windows 10.0', '联通', '0', '用户名或密码不正确', '2021-03-26 10:44:48');
INSERT INTO `b5net_loginlog` VALUES (213, 'ceshi', '123.132.237.18', '山东省临沂市', 'Chrome 70.0.3538.25', 'Windows 10.0', '联通', '0', '用户名或密码不正确', '2021-03-26 10:47:17');
INSERT INTO `b5net_loginlog` VALUES (214, 'ceshi', '123.132.237.18', '山东省临沂市', 'Chrome 70.0.3538.25', 'AndroidOS 5.0', '联通', '0', '用户名或密码不正确', '2021-03-26 10:47:29');
INSERT INTO `b5net_loginlog` VALUES (215, 'ceshi', '123.132.237.18', '山东省临沂市', 'Chrome 70.0.3538.25', 'Windows 10.0', '联通', '0', '验证码不正确', '2021-03-26 10:48:05');
INSERT INTO `b5net_loginlog` VALUES (216, 'ceshi', '123.132.237.18', '山东省临沂市', 'Chrome 70.0.3538.25', 'Windows 10.0', '联通', '0', '验证码不正确', '2021-03-26 10:48:24');
INSERT INTO `b5net_loginlog` VALUES (217, 'ceshi', '210.75.9.81', '广东省深圳市', 'Chrome 89.0.4389.90', 'OS X 11_2_1', '诺瓦科技发展有限公司', '1', '登录成功', '2021-03-26 14:36:04');
INSERT INTO `b5net_loginlog` VALUES (218, 'ceshi', '175.7.88.127', '湖南省长沙市', 'Chrome 78.0.3904.108', 'Windows 10.0', '电信', '1', '登录成功', '2021-03-26 14:51:22');
INSERT INTO `b5net_loginlog` VALUES (219, 'ceshi', '117.159.194.85', '河南省', 'Chrome 88.0.4324.104', 'Windows 10.0', '移动', '1', '登录成功', '2021-03-26 17:38:34');
INSERT INTO `b5net_loginlog` VALUES (220, 'ceshi', '113.129.60.94', '山东省济南市', 'Chrome 84.0.4147.111', 'AndroidOS 7.1.1', '电信', '1', '登录成功', '2021-03-26 22:28:13');
INSERT INTO `b5net_loginlog` VALUES (221, 'ceshi', '61.140.134.1', '广东省广州市海珠区', 'Chrome 88.0.4324.104', 'Windows 10.0', '电信', '1', '登录成功', '2021-03-27 22:23:57');
INSERT INTO `b5net_loginlog` VALUES (222, 'ceshi', '125.34.15.95', '北京市', 'Chrome 89.0.4389.90', 'OS X 11_2_3', '联通', '1', '登录成功', '2021-03-27 23:14:31');
INSERT INTO `b5net_loginlog` VALUES (223, 'ceshi', '119.128.113.33', '广东省东莞市', 'UCBrowser 13.3.2.1112', 'AndroidOS 10', '电信', '1', '登录成功', '2021-03-28 07:08:49');
INSERT INTO `b5net_loginlog` VALUES (224, 'ceshi', '113.123.222.9', '山东省枣庄市', 'Chrome 70.0.3538.25', 'Windows 10.0', '电信', '1', '登录成功', '2021-03-28 10:11:21');
INSERT INTO `b5net_loginlog` VALUES (225, 'ceshi', '113.70.230.182', '广东省佛山市', 'Chrome 91.0.4442.4', 'Windows 10.0', '电信', '1', '登录成功', '2021-03-28 12:48:13');

-- ----------------------------
-- Table structure for b5net_menu
-- ----------------------------
DROP TABLE IF EXISTS `b5net_menu`;
CREATE TABLE `b5net_menu`  (
  `id` int(0) NOT NULL AUTO_INCREMENT COMMENT '菜单ID',
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '菜单名称',
  `parent_id` int(0) NOT NULL DEFAULT 0 COMMENT '父菜单ID',
  `listsort` int(0) NOT NULL DEFAULT 0 COMMENT '显示顺序',
  `url` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '请求地址',
  `target` tinyint(1) NOT NULL DEFAULT 0 COMMENT '打开方式（0页签 1新窗口）',
  `type` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '菜单类型（M目录 C菜单 F按钮）',
  `status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1' COMMENT '菜单状态（1显示 0隐藏）',
  `is_refresh` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0' COMMENT '是否刷新（0不刷新 1刷新）',
  `perms` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '权限标识',
  `icon` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '菜单图标',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  `note` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `parent_id`(`parent_id`) USING BTREE,
  INDEX `listsort`(`listsort`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12508 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '菜单权限表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of b5net_menu
-- ----------------------------
INSERT INTO `b5net_menu` VALUES (1, '系统管理', 0, 1, '', 0, 'M', '1', '0', '', 'fa fa-cog', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '系统管理');
INSERT INTO `b5net_menu` VALUES (2, '权限管理', 0, 2, '', 0, 'M', '1', '0', '', 'fa fa-id-card-o', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '权限管理');
INSERT INTO `b5net_menu` VALUES (4, '网站管理', 0, 4, '', 0, 'M', '1', '0', '', 'fa fa-globe', '2021-03-17 13:46:11', '2021-03-17 13:46:11', '网站管理');
INSERT INTO `b5net_menu` VALUES (5, '微信应用', 0, 5, '', 0, 'M', '1', '0', '', 'fa fa-weixin', '2021-03-17 13:50:41', '2021-03-17 13:50:41', '');
INSERT INTO `b5net_menu` VALUES (90, '官方网站', 0, 99, 'http://www.b5net.com', 1, 'C', '1', '0', '', 'fa fa-send', '2021-01-05 12:05:30', '2021-01-18 17:07:15', '官方网站');
INSERT INTO `b5net_menu` VALUES (100, '人员管理', 2, 1, 'admin/index', 0, 'C', '1', '0', 'admin:admin:index', 'fa fa-user-o', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '人员管理');
INSERT INTO `b5net_menu` VALUES (101, '角色管理', 2, 2, 'role/index', 0, 'C', '1', '0', 'admin:role:index', 'fa fa-address-book-o', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '角色管理');
INSERT INTO `b5net_menu` VALUES (102, '组织架构', 2, 3, 'struct/index', 0, 'C', '1', '0', 'admin:struct:index', 'fa fa-sitemap', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '组织架构');
INSERT INTO `b5net_menu` VALUES (103, '菜单管理', 2, 4, 'menu/index', 0, 'C', '1', '0', 'admin:menu:index', 'fa fa-server', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '菜单管理');
INSERT INTO `b5net_menu` VALUES (104, '登录日志', 2, 5, 'loginlog/index', 0, 'C', '1', '0', 'admin:loginlog:index', 'fa fa-paw', '2021-01-03 07:25:11', '2021-01-07 12:54:43', '登录日志');
INSERT INTO `b5net_menu` VALUES (105, '参数配置', 1, 1, 'config/index', 0, 'C', '1', '0', 'admin:config:index', 'fa fa-sliders', '2021-01-03 07:25:11', '2021-01-05 12:20:56', '参数配置');
INSERT INTO `b5net_menu` VALUES (106, '字典管理', 1, 2, 'dict/index', 0, 'C', '1', '0', 'admin:dict:index', 'fa fa-file-code-o', '2021-01-03 07:25:11', '2021-01-05 06:01:47', '字典管理');
INSERT INTO `b5net_menu` VALUES (107, '通知公告', 1, 10, 'notice/index', 0, 'C', '1', '0', 'admin:notice:index', 'fa fa-bullhorn', '2021-01-03 07:25:11', '2021-03-17 14:05:34', '通知公告');
INSERT INTO `b5net_menu` VALUES (108, '跳转模块', 1, 3, 'redtype/index', 0, 'C', '1', '0', 'admin:redtype:index', 'fa fa-code-fork', '2021-01-03 07:25:11', '2021-01-04 08:12:28', '跳转模块');
INSERT INTO `b5net_menu` VALUES (109, '推荐位置', 1, 4, 'adposition/index', 0, 'C', '1', '0', 'admin:adposition:index', 'fa fa-file-zip-o', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '推荐位置');
INSERT INTO `b5net_menu` VALUES (110, '推荐信息', 1, 11, 'adlist/index', 0, 'C', '1', '0', 'admin:adlist:index', 'fa fa-sun-o', '2021-01-03 07:25:11', '2021-03-17 14:05:46', '推荐信息');
INSERT INTO `b5net_menu` VALUES (120, '网站内容', 4, 1, 'weblist/index', 0, 'C', '1', '0', 'admin:weblist:index', '', '2021-03-17 14:00:39', '2021-03-17 14:00:39', '');
INSERT INTO `b5net_menu` VALUES (121, '网站栏目', 4, 3, 'webcat/index', 0, 'C', '1', '0', 'admin:webcat:index', '', '2021-03-17 14:01:21', '2021-03-17 14:01:21', '');
INSERT INTO `b5net_menu` VALUES (122, '广告位置', 4, 4, 'webpos/index', 0, 'C', '1', '0', 'admin:webpos:index', '', '2021-03-17 14:01:37', '2021-03-17 14:01:37', '');
INSERT INTO `b5net_menu` VALUES (123, '广告信息', 4, 2, 'webad/index', 0, 'C', '1', '0', 'admin:webad:index', '', '2021-03-17 14:01:04', '2021-03-17 14:01:04', '');
INSERT INTO `b5net_menu` VALUES (125, '微刮奖', 5, 0, 'scratch/index', 0, 'C', '1', '0', 'admin:scratch:index', '', '2021-03-17 14:01:04', '2021-03-26 11:35:57', '');
INSERT INTO `b5net_menu` VALUES (10000, '用户新增', 100, 1, '', 0, 'F', '1', '0', 'admin:admin:add', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '用户新增');
INSERT INTO `b5net_menu` VALUES (10001, '用户修改', 100, 2, '', 0, 'F', '1', '0', 'admin:admin:edit', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '用户修改');
INSERT INTO `b5net_menu` VALUES (10002, '用户删除', 100, 3, '', 0, 'F', '1', '0', 'admin:admin:drop', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '用户删除');
INSERT INTO `b5net_menu` VALUES (10004, '用户状态', 100, 4, '', 0, 'F', '1', '0', 'admin:admin:setstatus', '', '2021-01-03 07:25:11', '2021-01-08 10:47:09', '用户状态');
INSERT INTO `b5net_menu` VALUES (10100, '角色新增', 101, 1, '', 0, 'F', '1', '0', 'admin:role:add', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '角色新增');
INSERT INTO `b5net_menu` VALUES (10101, '角色修改', 101, 2, '', 0, 'F', '1', '0', 'admin:role:edit', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '角色修改');
INSERT INTO `b5net_menu` VALUES (10102, '角色删除', 101, 3, '', 0, 'F', '1', '0', 'admin:role:drop', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '角色删除');
INSERT INTO `b5net_menu` VALUES (10104, '角色状态', 101, 4, '', 0, 'F', '1', '0', 'admin:role:setstatus', '', '2021-01-03 07:25:11', '2021-01-08 10:47:31', '角色状态');
INSERT INTO `b5net_menu` VALUES (10105, '菜单授权', 101, 10, '', 0, 'F', '1', '0', 'admin:role:auth', '', '2021-01-03 07:25:11', '2021-01-07 13:32:41', '菜单授权');
INSERT INTO `b5net_menu` VALUES (10110, '角色人员', 101, 11, '', 0, 'F', '1', '0', 'admin:adminrole:index', '', '2021-01-03 07:25:11', '2021-01-07 13:33:15', '角色人员');
INSERT INTO `b5net_menu` VALUES (10111, '取消角色人员', 101, 12, '', 0, 'F', '1', '0', 'admin:adminrole:drop', '', '2021-01-03 07:25:11', '2021-01-07 15:36:14', '取消角色人员');
INSERT INTO `b5net_menu` VALUES (10112, '添加角色人员', 101, 13, '', 0, 'F', '1', '0', 'admin:adminrole:add', '', '2021-01-03 07:25:11', '2021-01-07 15:36:14', '添加角色人员');
INSERT INTO `b5net_menu` VALUES (10200, '组织新增', 102, 1, '', 0, 'F', '1', '0', 'admin:struct:add', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '组织新增');
INSERT INTO `b5net_menu` VALUES (10201, '组织修改', 102, 2, '', 0, 'F', '1', '0', 'admin:struct:edit', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '组织修改');
INSERT INTO `b5net_menu` VALUES (10202, '组织删除', 102, 3, '', 0, 'F', '1', '0', 'admin:struct:drop', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '组织删除');
INSERT INTO `b5net_menu` VALUES (10300, '菜单新增', 103, 1, '', 0, 'F', '1', '0', 'admin:menu:add', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '菜单新增');
INSERT INTO `b5net_menu` VALUES (10301, '菜单修改', 103, 2, '', 0, 'F', '1', '0', 'admin:menu:edit', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '菜单修改');
INSERT INTO `b5net_menu` VALUES (10302, '菜单删除', 103, 3, '', 0, 'F', '1', '0', 'admin:menu:drop', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '菜单删除');
INSERT INTO `b5net_menu` VALUES (10400, '日志删除', 104, 0, '', 0, 'F', '1', '0', 'admin:loginlog:drop', '', '2021-01-07 13:03:15', '2021-01-07 13:03:15', '日志删除');
INSERT INTO `b5net_menu` VALUES (10401, '日志清空', 104, 0, '', 0, 'F', '1', '0', 'admin:loginlog:trash', '', '2021-01-07 13:04:06', '2021-01-07 13:04:06', '日志清空');
INSERT INTO `b5net_menu` VALUES (10500, '参数新增', 105, 1, '', 0, 'F', '1', '0', 'admin:config:add', '', '2021-01-03 07:25:11', '2021-01-05 06:00:02', '参数新增');
INSERT INTO `b5net_menu` VALUES (10501, '参数修改', 105, 2, '', 0, 'F', '1', '0', 'admin:config:edit', '', '2021-01-03 07:25:11', '2021-01-05 06:00:25', '参数修改');
INSERT INTO `b5net_menu` VALUES (10502, '参数删除', 105, 3, '', 0, 'F', '1', '0', 'admin:config:drop', '', '2021-01-03 07:25:11', '2021-01-05 06:00:59', '参数删除');
INSERT INTO `b5net_menu` VALUES (10504, '清除缓存', 105, 4, '', 0, 'F', '1', '0', 'admin:config:delcache', '', '2021-01-03 07:25:11', '2021-01-08 10:46:47', '清除缓存');
INSERT INTO `b5net_menu` VALUES (10505, '网站设置', 1, 0, 'config/site', 0, 'C', '1', '0', 'admin:config:site', 'fa fa-object-group', '2021-01-11 22:17:31', '2021-01-11 22:39:46', '');
INSERT INTO `b5net_menu` VALUES (10600, '字典新增', 106, 1, '', 0, 'F', '1', '0', 'admin:dict:add', '', '2021-01-03 07:25:11', '2021-01-05 06:02:13', '字典新增');
INSERT INTO `b5net_menu` VALUES (10601, '字典修改', 106, 2, '', 0, 'F', '1', '0', 'admin:dict:edit', '', '2021-01-03 07:25:11', '2021-01-05 06:02:32', '字典修改');
INSERT INTO `b5net_menu` VALUES (10602, '字典删除', 106, 3, '', 0, 'F', '1', '0', 'admin:dict:drop', '', '2021-01-03 07:25:11', '2021-01-05 06:02:53', '字典删除');
INSERT INTO `b5net_menu` VALUES (10603, '清除缓存', 106, 4, '', 0, 'F', '1', '0', 'admin:dict:delcache', '', '2021-01-03 07:25:11', '2021-01-07 15:27:19', '清除缓存');
INSERT INTO `b5net_menu` VALUES (10610, '数据列表', 106, 10, '', 0, 'F', '1', '0', 'admin:dictdata:index', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '数据列表');
INSERT INTO `b5net_menu` VALUES (10611, '数据新增', 106, 11, '', 0, 'F', '1', '0', 'admin:dictdata:add', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '数据新增');
INSERT INTO `b5net_menu` VALUES (10612, '数据修改', 106, 12, '', 0, 'F', '1', '0', 'admin:dictdata:edit', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '数据修改');
INSERT INTO `b5net_menu` VALUES (10613, '数据删除', 106, 13, '', 0, 'F', '1', '0', 'admin:dictdata:drop', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '数据删除');
INSERT INTO `b5net_menu` VALUES (10700, '公告新增', 107, 1, '', 0, 'F', '1', '0', 'admin:notice:add', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '公告新增');
INSERT INTO `b5net_menu` VALUES (10701, '公告修改', 107, 2, '', 0, 'F', '1', '0', 'admin:notice:edit', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '公告修改');
INSERT INTO `b5net_menu` VALUES (10702, '公告删除', 107, 3, '', 0, 'F', '1', '0', 'admin:notice:drop', '', '2021-01-03 07:25:11', '2021-01-03 07:25:11', '公告删除');
INSERT INTO `b5net_menu` VALUES (10800, '跳转新增', 108, 1, '', 0, 'F', '1', '0', 'admin:redtype:add', '', '2021-01-08 07:29:26', '2021-01-08 07:29:26', '跳转新增');
INSERT INTO `b5net_menu` VALUES (10801, '跳转编辑', 108, 2, '', 0, 'F', '1', '0', 'admin:redtype:edit', '', '2021-01-08 07:29:26', '2021-01-08 07:29:26', '跳转编辑');
INSERT INTO `b5net_menu` VALUES (10802, '跳转删除', 108, 3, '', 0, 'F', '1', '0', 'admin:redtype:drop', '', '2021-01-08 07:29:26', '2021-01-08 07:29:26', '跳转删除');
INSERT INTO `b5net_menu` VALUES (10803, '清除缓存', 108, 4, '', 0, 'F', '1', '0', 'admin:redtype:delcache', '', '2021-01-08 07:29:26', '2021-01-08 07:29:26', '清除缓存');
INSERT INTO `b5net_menu` VALUES (10900, '位置新增', 109, 1, '', 0, 'F', '1', '0', 'admin:adposition:add', '', '2021-01-07 15:36:14', '2021-01-07 15:36:14', '位置新增');
INSERT INTO `b5net_menu` VALUES (10901, '位置编辑', 109, 2, '', 0, 'F', '1', '0', 'admin:adposition:edit', '', '2021-01-07 15:37:56', '2021-01-07 15:37:56', '位置编辑');
INSERT INTO `b5net_menu` VALUES (10902, '位置删除', 109, 3, '', 0, 'F', '1', '0', 'admin:adposition:drop', '', '2021-01-03 07:25:11', '2021-01-07 15:36:14', '位置删除');
INSERT INTO `b5net_menu` VALUES (10903, '清除缓存', 109, 4, '', 0, 'F', '1', '0', 'admin:adposition:delcache', '', '2021-01-03 07:25:11', '2021-01-07 15:36:14', '清除缓存');
INSERT INTO `b5net_menu` VALUES (11000, '信息新增', 110, 1, '', 0, 'F', '1', '0', 'admin:adlist:add', '', '2021-01-08 07:26:14', '2021-01-08 07:26:14', '信息新增');
INSERT INTO `b5net_menu` VALUES (11001, '信息编辑', 110, 2, '', 0, 'F', '1', '0', 'admin:adlist:edit', '', '2021-01-08 07:26:14', '2021-01-08 07:26:14', '信息编辑');
INSERT INTO `b5net_menu` VALUES (11002, '信息删除', 110, 3, '', 0, 'F', '1', '0', 'admin:adlist:drop', '', '2021-01-08 07:26:14', '2021-01-08 07:26:14', '信息删除');
INSERT INTO `b5net_menu` VALUES (11003, '清除缓存', 110, 4, '', 0, 'F', '1', '0', 'admin:adlist:delcache', '', '2021-01-08 07:26:14', '2021-01-08 07:26:14', '清除缓存');
INSERT INTO `b5net_menu` VALUES (12001, '添加信息', 120, 1, '', 0, 'F', '1', '0', 'admin:weblist:add', '', '2021-03-17 14:02:57', '2021-03-17 14:02:57', '');
INSERT INTO `b5net_menu` VALUES (12002, '编辑信息', 120, 2, '', 0, 'F', '1', '0', 'admin:weblist:edit', '', '2021-03-17 14:03:07', '2021-03-17 14:03:07', '');
INSERT INTO `b5net_menu` VALUES (12003, '删除信息', 120, 3, '', 0, 'F', '1', '0', 'admin:weblist:drop', '', '2021-03-17 14:03:17', '2021-03-17 14:03:17', '');
INSERT INTO `b5net_menu` VALUES (12101, '添加栏目', 121, 1, '', 0, 'F', '1', '0', 'admin:webcat:add', '', '2021-03-17 14:04:04', '2021-03-17 14:04:04', '');
INSERT INTO `b5net_menu` VALUES (12102, '编辑栏目', 121, 2, '', 0, 'F', '1', '0', 'admin:webcat:edit', '', '2021-03-17 14:04:15', '2021-03-17 14:04:15', '');
INSERT INTO `b5net_menu` VALUES (12103, '删除栏目', 121, 3, '', 0, 'F', '1', '0', 'admin:webcat:drop', '', '2021-03-17 14:04:15', '2021-03-17 14:04:25', '');
INSERT INTO `b5net_menu` VALUES (12104, '清除缓存', 121, 4, '', 0, 'F', '1', '0', 'admin:webcat:delcache', '', '2021-03-17 14:04:15', '2021-03-17 14:04:15', '');
INSERT INTO `b5net_menu` VALUES (12201, '添加位置', 122, 1, '', 0, 'F', '1', '0', 'admin:webpos:add', '', '2021-03-17 14:04:15', '2021-03-17 14:04:35', '');
INSERT INTO `b5net_menu` VALUES (12202, '编辑位置', 122, 2, '', 0, 'F', '1', '0', 'admin:webpos:edit', '', '2021-03-17 14:04:15', '2021-03-17 14:04:45', '');
INSERT INTO `b5net_menu` VALUES (12203, '删除位置', 122, 3, '', 0, 'F', '1', '0', 'admin:webpos:drop', '', '2021-03-17 14:04:15', '2021-03-17 14:04:54', '');
INSERT INTO `b5net_menu` VALUES (12301, '添加广告', 123, 1, '', 0, 'F', '1', '0', 'admin:webad:add', '', '2021-03-17 14:04:15', '2021-03-17 14:03:32', '');
INSERT INTO `b5net_menu` VALUES (12302, '编辑广告', 123, 2, '', 0, 'F', '1', '0', 'admin:webad:edit', '', '2021-03-17 14:04:15', '2021-03-17 14:03:41', '');
INSERT INTO `b5net_menu` VALUES (12303, '删除广告', 123, 3, '', 0, 'F', '1', '0', 'admin:webad:drop', '', '2021-03-17 14:04:15', '2021-03-17 14:03:51', '');
INSERT INTO `b5net_menu` VALUES (12501, '添加活动', 125, 1, '', 0, 'F', '1', '0', 'admin:scratch:add', '', '2021-03-26 11:36:29', '2021-03-26 11:36:29', '');
INSERT INTO `b5net_menu` VALUES (12502, '编辑活动', 125, 2, '', 0, 'F', '1', '0', 'admin:scratch:edit', '', '2021-03-26 11:36:50', '2021-03-26 11:36:50', '');
INSERT INTO `b5net_menu` VALUES (12503, '数据清除', 125, 3, '', 0, 'F', '1', '0', 'admin:scratch:initdata', '', '2021-03-26 11:37:20', '2021-03-26 11:37:20', '');
INSERT INTO `b5net_menu` VALUES (12504, '奖品列表', 125, 10, '', 0, 'F', '1', '0', 'admin:scratchprize:index', '', '2021-03-26 11:44:31', '2021-03-26 11:44:31', '');
INSERT INTO `b5net_menu` VALUES (12505, '添加奖品', 125, 11, '', 0, 'F', '1', '0', 'admin:scratchprize:add', '', '2021-03-26 11:44:58', '2021-03-26 11:44:58', '');
INSERT INTO `b5net_menu` VALUES (12506, '奖品编辑', 125, 12, '', 0, 'F', '1', '0', 'admin:scratchprize:edit', '', '2021-03-26 11:45:27', '2021-03-26 11:45:27', '');
INSERT INTO `b5net_menu` VALUES (12507, '奖品删除', 125, 13, '', 0, 'F', '1', '0', 'admin:scratchprize:drop', '', '2021-03-26 11:45:56', '2021-03-26 11:45:56', '');

-- ----------------------------
-- Table structure for b5net_notice
-- ----------------------------
DROP TABLE IF EXISTS `b5net_notice`;
CREATE TABLE `b5net_notice`  (
  `id` int(0) NOT NULL AUTO_INCREMENT COMMENT '公告ID',
  `title` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '公告标题',
  `type` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '公告类型（1通知 2公告）',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '公告内容',
  `textarea` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '非html内容',
  `status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1' COMMENT '公告状态（1正常 0关闭）',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '通知公告表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of b5net_notice
-- ----------------------------
INSERT INTO `b5net_notice` VALUES (1, '【公告】： B5LaravelCMF新版本发布啦', '2', '<p>新版本内容</p><p><br></p><p>新版本内容</p><p>新版本内容</p><p>新版本内容<br></p>', '', '1', '2020-12-24 11:33:42', '2021-01-18 17:07:21');
INSERT INTO `b5net_notice` VALUES (2, '【通知】：B5LaravelCMF系统凌晨维护', '1', '<font color=\"#0000ff\">维护内容</font>', '', '1', '2020-12-24 11:33:42', '2021-01-01 15:57:22');

-- ----------------------------
-- Table structure for b5net_redtype
-- ----------------------------
DROP TABLE IF EXISTS `b5net_redtype`;
CREATE TABLE `b5net_redtype`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '名称',
  `type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '跳转标识',
  `list_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '跳转模块连接',
  `info_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '跳转信息链接',
  `status` tinyint(0) UNSIGNED NOT NULL DEFAULT 1,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '备注',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `adkey`(`type`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '跳转配置表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of b5net_redtype
-- ----------------------------
INSERT INTO `b5net_redtype` VALUES (1, '通知公告', 'notice', '', '', 1, '通知公告模块', '2021-01-04 07:34:32', '2021-01-17 21:10:17');
INSERT INTO `b5net_redtype` VALUES (2, '个人中心', 'ucenter', '', '', 1, '', '2021-01-08 06:39:27', '2021-01-18 17:06:31');

-- ----------------------------
-- Table structure for b5net_role
-- ----------------------------
DROP TABLE IF EXISTS `b5net_role`;
CREATE TABLE `b5net_role`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '角色ID',
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '角色名称',
  `rolekey` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '角色权限字符串',
  `listsort` int(0) NOT NULL DEFAULT 0 COMMENT '显示顺序',
  `status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1' COMMENT '角色状态（1正常 0停用）',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  `note` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `rolekey`(`rolekey`) USING BTREE,
  INDEX `listsort`(`listsort`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '角色信息表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of b5net_role
-- ----------------------------
INSERT INTO `b5net_role` VALUES (1, '超管', 'administrator', 0, '1', '2020-12-28 07:42:31', '2021-01-19 11:35:47', '超级管理员');
INSERT INTO `b5net_role` VALUES (2, '测试角色', 'common', 1, '1', '2020-12-28 07:44:00', '2021-01-05 06:11:52', '');

-- ----------------------------
-- Table structure for b5net_role_menu
-- ----------------------------
DROP TABLE IF EXISTS `b5net_role_menu`;
CREATE TABLE `b5net_role_menu`  (
  `role_id` bigint(0) NOT NULL COMMENT '角色ID',
  `menu_id` bigint(0) NOT NULL COMMENT '菜单ID',
  PRIMARY KEY (`role_id`, `menu_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '角色和菜单关联表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of b5net_role_menu
-- ----------------------------
INSERT INTO `b5net_role_menu` VALUES (2, 1);
INSERT INTO `b5net_role_menu` VALUES (2, 2);
INSERT INTO `b5net_role_menu` VALUES (2, 4);
INSERT INTO `b5net_role_menu` VALUES (2, 5);
INSERT INTO `b5net_role_menu` VALUES (2, 90);
INSERT INTO `b5net_role_menu` VALUES (2, 100);
INSERT INTO `b5net_role_menu` VALUES (2, 101);
INSERT INTO `b5net_role_menu` VALUES (2, 102);
INSERT INTO `b5net_role_menu` VALUES (2, 103);
INSERT INTO `b5net_role_menu` VALUES (2, 104);
INSERT INTO `b5net_role_menu` VALUES (2, 105);
INSERT INTO `b5net_role_menu` VALUES (2, 106);
INSERT INTO `b5net_role_menu` VALUES (2, 107);
INSERT INTO `b5net_role_menu` VALUES (2, 108);
INSERT INTO `b5net_role_menu` VALUES (2, 109);
INSERT INTO `b5net_role_menu` VALUES (2, 110);
INSERT INTO `b5net_role_menu` VALUES (2, 120);
INSERT INTO `b5net_role_menu` VALUES (2, 121);
INSERT INTO `b5net_role_menu` VALUES (2, 122);
INSERT INTO `b5net_role_menu` VALUES (2, 123);
INSERT INTO `b5net_role_menu` VALUES (2, 10000);
INSERT INTO `b5net_role_menu` VALUES (2, 10001);
INSERT INTO `b5net_role_menu` VALUES (2, 10002);
INSERT INTO `b5net_role_menu` VALUES (2, 10004);
INSERT INTO `b5net_role_menu` VALUES (2, 10100);
INSERT INTO `b5net_role_menu` VALUES (2, 10101);
INSERT INTO `b5net_role_menu` VALUES (2, 10102);
INSERT INTO `b5net_role_menu` VALUES (2, 10104);
INSERT INTO `b5net_role_menu` VALUES (2, 10105);
INSERT INTO `b5net_role_menu` VALUES (2, 10110);
INSERT INTO `b5net_role_menu` VALUES (2, 10111);
INSERT INTO `b5net_role_menu` VALUES (2, 10112);
INSERT INTO `b5net_role_menu` VALUES (2, 10200);
INSERT INTO `b5net_role_menu` VALUES (2, 10201);
INSERT INTO `b5net_role_menu` VALUES (2, 10202);
INSERT INTO `b5net_role_menu` VALUES (2, 10300);
INSERT INTO `b5net_role_menu` VALUES (2, 10301);
INSERT INTO `b5net_role_menu` VALUES (2, 10302);
INSERT INTO `b5net_role_menu` VALUES (2, 10400);
INSERT INTO `b5net_role_menu` VALUES (2, 10401);
INSERT INTO `b5net_role_menu` VALUES (2, 10500);
INSERT INTO `b5net_role_menu` VALUES (2, 10501);
INSERT INTO `b5net_role_menu` VALUES (2, 10502);
INSERT INTO `b5net_role_menu` VALUES (2, 10504);
INSERT INTO `b5net_role_menu` VALUES (2, 10505);
INSERT INTO `b5net_role_menu` VALUES (2, 10600);
INSERT INTO `b5net_role_menu` VALUES (2, 10601);
INSERT INTO `b5net_role_menu` VALUES (2, 10602);
INSERT INTO `b5net_role_menu` VALUES (2, 10603);
INSERT INTO `b5net_role_menu` VALUES (2, 10610);
INSERT INTO `b5net_role_menu` VALUES (2, 10611);
INSERT INTO `b5net_role_menu` VALUES (2, 10612);
INSERT INTO `b5net_role_menu` VALUES (2, 10613);
INSERT INTO `b5net_role_menu` VALUES (2, 10700);
INSERT INTO `b5net_role_menu` VALUES (2, 10701);
INSERT INTO `b5net_role_menu` VALUES (2, 10702);
INSERT INTO `b5net_role_menu` VALUES (2, 10800);
INSERT INTO `b5net_role_menu` VALUES (2, 10801);
INSERT INTO `b5net_role_menu` VALUES (2, 10802);
INSERT INTO `b5net_role_menu` VALUES (2, 10803);
INSERT INTO `b5net_role_menu` VALUES (2, 10900);
INSERT INTO `b5net_role_menu` VALUES (2, 10901);
INSERT INTO `b5net_role_menu` VALUES (2, 10902);
INSERT INTO `b5net_role_menu` VALUES (2, 10903);
INSERT INTO `b5net_role_menu` VALUES (2, 11000);
INSERT INTO `b5net_role_menu` VALUES (2, 11001);
INSERT INTO `b5net_role_menu` VALUES (2, 11002);
INSERT INTO `b5net_role_menu` VALUES (2, 11003);
INSERT INTO `b5net_role_menu` VALUES (2, 12001);
INSERT INTO `b5net_role_menu` VALUES (2, 12002);
INSERT INTO `b5net_role_menu` VALUES (2, 12003);
INSERT INTO `b5net_role_menu` VALUES (2, 12101);
INSERT INTO `b5net_role_menu` VALUES (2, 12102);
INSERT INTO `b5net_role_menu` VALUES (2, 12103);
INSERT INTO `b5net_role_menu` VALUES (2, 12104);
INSERT INTO `b5net_role_menu` VALUES (2, 12201);
INSERT INTO `b5net_role_menu` VALUES (2, 12202);
INSERT INTO `b5net_role_menu` VALUES (2, 12203);
INSERT INTO `b5net_role_menu` VALUES (2, 12301);
INSERT INTO `b5net_role_menu` VALUES (2, 12302);
INSERT INTO `b5net_role_menu` VALUES (2, 12303);

-- ----------------------------
-- Table structure for b5net_scratch
-- ----------------------------
DROP TABLE IF EXISTS `b5net_scratch`;
CREATE TABLE `b5net_scratch`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '活动名称',
  `status` tinyint(1) NULL DEFAULT 1 COMMENT '活动状态',
  `start_time` datetime(0) NULL DEFAULT NULL COMMENT '开始时间',
  `end_time` datetime(0) NULL DEFAULT NULL COMMENT '结束时间',
  `daynum` mediumint(0) NULL DEFAULT NULL COMMENT '每日刮奖次数',
  `contents` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '活动介绍',
  `create_time` datetime(0) NULL DEFAULT NULL,
  `update_time` datetime(0) NULL DEFAULT NULL,
  `support` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '技术支持',
  `company` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '主办单位',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '微信刮奖-活动表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of b5net_scratch
-- ----------------------------
INSERT INTO `b5net_scratch` VALUES (1, '测试刮奖活动', 1, '2021-03-26 16:01:00', '2021-10-26 16:01:00', 70, '阿大撒大撒大撒大苏打是\r\n撒大苏打实打实的撒阿萨大阿大撒大撒大撒大苏打萨达萨达萨达萨达是啊实打实 大撒大阿萨大阿萨大阿大撒阿萨大阿萨大阿达阿萨大啊谁说的\r\n大撒大\r\n阿三大苏打阿萨大', '2021-03-26 16:02:11', '2021-03-28 16:23:39', 'XXXXXX科技公司', 'XXX集团');

-- ----------------------------
-- Table structure for b5net_scratch_prize
-- ----------------------------
DROP TABLE IF EXISTS `b5net_scratch_prize`;
CREATE TABLE `b5net_scratch_prize`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `scratch_id` int(0) NOT NULL COMMENT '所属活动',
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '奖项名称:一等奖',
  `title` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '实际名称',
  `allnumber` mediumint(0) NOT NULL COMMENT '总数，0为不限制',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否显示',
  `isuse` tinyint(1) NOT NULL COMMENT '是否可以中将',
  `chance` int(0) NULL DEFAULT 1 COMMENT '概率',
  `thumbimg` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '奖品图片',
  `contents` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '奖品介绍',
  `get_start` datetime(0) NULL DEFAULT NULL COMMENT '兑换开始时间',
  `get_end` datetime(0) NULL DEFAULT NULL COMMENT '兑换结束时间',
  `create_time` datetime(0) NULL DEFAULT NULL,
  `update_time` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of b5net_scratch_prize
-- ----------------------------
INSERT INTO `b5net_scratch_prize` VALUES (1, 1, 'iphone 12手机', '一等奖', 1, 1, 1, 100000, '/uploads/scratch/2021/03/26/ceb54319b711f63d19ade122a22a9b27.jpg', '兑奖时间：2021-05-01至2021-05-07。超出时间无效', NULL, NULL, '2021-03-26 22:50:07', '2021-03-26 22:59:37');
INSERT INTO `b5net_scratch_prize` VALUES (2, 1, '华为运动手环', '二等奖', 2, 1, 1, 10000, '/uploads/scratch/2021/03/26/a54356f9afa67b541be268cf334e054e.jpg', '', NULL, NULL, '2021-03-26 23:00:31', '2021-03-26 23:00:31');
INSERT INTO `b5net_scratch_prize` VALUES (3, 1, '水杯', '幸运奖', 999999, 1, 1, 1, '/uploads/scratch/2021/03/26/0934cb92cbd07a339ea53106f3fe0ad7.jpg', '', NULL, NULL, '2021-03-26 23:01:03', '2021-03-28 16:26:48');

-- ----------------------------
-- Table structure for b5net_scratch_prize_users
-- ----------------------------
DROP TABLE IF EXISTS `b5net_scratch_prize_users`;
CREATE TABLE `b5net_scratch_prize_users`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `openid` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '微信标识',
  `nickname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '微信昵称',
  `headimg` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '微信头像',
  `prize_id` int(0) NOT NULL COMMENT '奖品ID',
  `prize_name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '奖品名称',
  `prize_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '奖品图片',
  `getcode` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '兑换码',
  `scratch_id` int(0) NOT NULL COMMENT '所属活动',
  `daytime` date NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '兑换状态',
  `get_time` datetime(0) NULL DEFAULT NULL COMMENT '兑换时间',
  `create_time` datetime(0) NULL DEFAULT NULL,
  `update_time` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '微现场-中奖用户表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of b5net_scratch_prize_users
-- ----------------------------
INSERT INTO `b5net_scratch_prize_users` VALUES (1, 'oHwQ-52n1phwDERwoeTWlio_vooE', '李先生', 'https://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83eqBURUj29IqEIsiakaJV6icmctgf8gSWibLNMUsGpUmNPGR1T6W0jYicYcelq4e1lEnwMKUvMQSvVTYCQ/132', 3, '幸运奖：水杯', '/uploads/scratch/2021/03/26/0934cb92cbd07a339ea53106f3fe0ad7.jpg', '316169201108831', 1, '2021-03-28', 0, NULL, '2021-03-28 16:28:30', NULL);

-- ----------------------------
-- Table structure for b5net_scratch_users_logs
-- ----------------------------
DROP TABLE IF EXISTS `b5net_scratch_users_logs`;
CREATE TABLE `b5net_scratch_users_logs`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT ' ',
  `openid` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `create_time` datetime(0) NULL DEFAULT NULL,
  `scratch_id` int(0) NULL DEFAULT NULL,
  `daytime` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of b5net_scratch_users_logs
-- ----------------------------
INSERT INTO `b5net_scratch_users_logs` VALUES (1, 'oHwQ-52n1phwDERwoeTWlio_vooE', '2021-03-28 16:28:29', 1, '2021-03-28');
INSERT INTO `b5net_scratch_users_logs` VALUES (2, 'oHwQ-52n1phwDERwoeTWlio_vooE', '2021-03-28 16:28:30', 1, '2021-03-28');
INSERT INTO `b5net_scratch_users_logs` VALUES (3, 'oHwQ-52n1phwDERwoeTWlio_vooE', '2021-03-28 16:31:27', 1, '2021-03-28');
INSERT INTO `b5net_scratch_users_logs` VALUES (4, 'oHwQ-52n1phwDERwoeTWlio_vooE', '2021-03-28 16:31:29', 1, '2021-03-28');
INSERT INTO `b5net_scratch_users_logs` VALUES (5, 'oHwQ-52n1phwDERwoeTWlio_vooE', '2021-03-28 16:31:29', 1, '2021-03-28');
INSERT INTO `b5net_scratch_users_logs` VALUES (6, 'oHwQ-52n1phwDERwoeTWlio_vooE', '2021-03-28 16:31:30', 1, '2021-03-28');
INSERT INTO `b5net_scratch_users_logs` VALUES (7, 'oHwQ-52n1phwDERwoeTWlio_vooE', '2021-03-28 16:31:31', 1, '2021-03-28');
INSERT INTO `b5net_scratch_users_logs` VALUES (8, 'oHwQ-52n1phwDERwoeTWlio_vooE', '2021-03-28 16:31:32', 1, '2021-03-28');
INSERT INTO `b5net_scratch_users_logs` VALUES (9, 'oHwQ-52n1phwDERwoeTWlio_vooE', '2021-03-28 16:31:33', 1, '2021-03-28');
INSERT INTO `b5net_scratch_users_logs` VALUES (10, 'oHwQ-52n1phwDERwoeTWlio_vooE', '2021-03-28 16:31:33', 1, '2021-03-28');
INSERT INTO `b5net_scratch_users_logs` VALUES (11, 'oHwQ-52n1phwDERwoeTWlio_vooE', '2021-03-28 16:31:34', 1, '2021-03-28');
INSERT INTO `b5net_scratch_users_logs` VALUES (12, 'oHwQ-52n1phwDERwoeTWlio_vooE', '2021-03-28 16:31:35', 1, '2021-03-28');
INSERT INTO `b5net_scratch_users_logs` VALUES (13, 'oHwQ-52n1phwDERwoeTWlio_vooE', '2021-03-28 16:31:36', 1, '2021-03-28');
INSERT INTO `b5net_scratch_users_logs` VALUES (14, 'oHwQ-52n1phwDERwoeTWlio_vooE', '2021-03-28 16:31:36', 1, '2021-03-28');
INSERT INTO `b5net_scratch_users_logs` VALUES (15, 'oHwQ-52n1phwDERwoeTWlio_vooE', '2021-03-28 16:31:37', 1, '2021-03-28');
INSERT INTO `b5net_scratch_users_logs` VALUES (16, 'oHwQ-52n1phwDERwoeTWlio_vooE', '2021-03-28 16:31:38', 1, '2021-03-28');
INSERT INTO `b5net_scratch_users_logs` VALUES (17, 'oHwQ-52n1phwDERwoeTWlio_vooE', '2021-03-28 16:53:03', 1, '2021-03-28');

-- ----------------------------
-- Table structure for b5net_smscode
-- ----------------------------
DROP TABLE IF EXISTS `b5net_smscode`;
CREATE TABLE `b5net_smscode`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mobile` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '手机号码',
  `code` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '验证码',
  `type` tinyint(1) NOT NULL DEFAULT 0 COMMENT '例如：1注册 2登录 3忘记密码',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '状态 0未验证 1已验证',
  `os` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '运营商',
  `create_time` datetime(0) NULL DEFAULT NULL,
  `update_time` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '验证码表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for b5net_struct
-- ----------------------------
DROP TABLE IF EXISTS `b5net_struct`;
CREATE TABLE `b5net_struct`  (
  `id` int(0) NOT NULL AUTO_INCREMENT COMMENT '部门id',
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '部门名称',
  `parent_id` int(0) NULL DEFAULT 0 COMMENT '父部门id',
  `levels` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '祖级列表',
  `listsort` int(0) NULL DEFAULT 0 COMMENT '显示顺序',
  `leader` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '负责人',
  `phone` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '联系电话',
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '备注',
  `status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '1' COMMENT '部门状态（1正常 0停用）',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 112 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '组织架构' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of b5net_struct
-- ----------------------------
INSERT INTO `b5net_struct` VALUES (100, '冰舞科技', 0, '0', 0, '冰舞', '15888888888', '', '1', '2020-12-24 11:33:42', '2021-01-08 11:06:15');
INSERT INTO `b5net_struct` VALUES (101, '北京总公司', 100, '0,100', 1, '冰舞', '18888888888', '', '1', '2020-12-24 11:33:42', '2021-01-08 11:06:04');
INSERT INTO `b5net_struct` VALUES (103, '研发部门', 101, '0,100,101', 1, '冰舞', '15888888888', '', '1', '2020-12-24 11:33:42', '2021-01-17 21:28:43');
INSERT INTO `b5net_struct` VALUES (104, '市场部门', 101, '0,100,101', 2, '冰舞', '15888888888', '', '1', '2020-12-24 11:33:42', '2021-01-08 11:06:33');
INSERT INTO `b5net_struct` VALUES (105, '测试部门', 101, '0,100,101', 3, '冰舞', '15888888888', '', '1', '2020-12-24 11:33:42', '2021-01-08 11:06:36');
INSERT INTO `b5net_struct` VALUES (110, '山东分公司', 100, '0,100', 2, '冰舞', '1888888', '', '1', '2021-01-08 11:11:33', '2021-01-08 11:11:33');
INSERT INTO `b5net_struct` VALUES (111, '销售部门', 110, '0,100,110', 1, '', '', '', '1', '2021-01-08 11:11:48', '2021-01-18 17:07:10');

-- ----------------------------
-- Table structure for b5net_test_chat
-- ----------------------------
DROP TABLE IF EXISTS `b5net_test_chat`;
CREATE TABLE `b5net_test_chat`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ip` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `addtime` int(0) NOT NULL,
  `content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `addtime`(`addtime`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 29 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of b5net_test_chat
-- ----------------------------
INSERT INTO `b5net_test_chat` VALUES (1, '123.132.237.18', 1616640078, 'asdasd');
INSERT INTO `b5net_test_chat` VALUES (2, '123.132.237.18', 1616640346, '阿三大苏打');
INSERT INTO `b5net_test_chat` VALUES (3, '123.132.237.18', 1616640434, '啊大苏打');
INSERT INTO `b5net_test_chat` VALUES (4, '123.132.237.18', 1616642420, 'sads');
INSERT INTO `b5net_test_chat` VALUES (5, '123.132.237.18', 1616642533, 'asdasd');
INSERT INTO `b5net_test_chat` VALUES (6, '123.132.237.18', 1616642551, 'asdasda');
INSERT INTO `b5net_test_chat` VALUES (7, '123.132.237.18', 1616642571, 'asdas');
INSERT INTO `b5net_test_chat` VALUES (8, '123.132.237.18', 1616642574, 'asdasd');
INSERT INTO `b5net_test_chat` VALUES (9, '123.132.237.18', 1616642634, 'asdasd');
INSERT INTO `b5net_test_chat` VALUES (10, '123.132.237.18', 1616642638, 'asdasd');
INSERT INTO `b5net_test_chat` VALUES (11, '123.132.237.18', 1616642641, 'asdasd');
INSERT INTO `b5net_test_chat` VALUES (12, '123.132.237.18', 1616642667, 'asdasd');
INSERT INTO `b5net_test_chat` VALUES (13, '123.132.237.18', 1616642687, 'asdasd');
INSERT INTO `b5net_test_chat` VALUES (14, '123.132.237.18', 1616642732, 'sadasdasdasdasdasdasd啊萨达萨达萨达是的撒大阿萨大大');
INSERT INTO `b5net_test_chat` VALUES (15, '123.132.237.18', 1616642780, '啊实打实');
INSERT INTO `b5net_test_chat` VALUES (16, '123.132.237.18', 1616642782, '啊实打实');
INSERT INTO `b5net_test_chat` VALUES (17, '123.132.237.18', 1616642784, '啊萨达萨达萨达是的啊实打实打算大苏打');
INSERT INTO `b5net_test_chat` VALUES (18, '123.132.237.18', 1616642821, '阿三大苏打');
INSERT INTO `b5net_test_chat` VALUES (19, '123.132.237.18', 1616642843, '阿三大苏打');
INSERT INTO `b5net_test_chat` VALUES (20, '123.132.237.18', 1616642877, '阿三大苏打');
INSERT INTO `b5net_test_chat` VALUES (21, '123.132.237.18', 1616642922, '萨达萨达萨达萨达是的');
INSERT INTO `b5net_test_chat` VALUES (22, '123.132.237.18', 1616642924, '阿三大苏打aa');
INSERT INTO `b5net_test_chat` VALUES (23, '123.132.237.18', 1616643023, '啊实打实');
INSERT INTO `b5net_test_chat` VALUES (24, '123.132.237.18', 1616643033, '啊实打实');
INSERT INTO `b5net_test_chat` VALUES (25, '123.132.237.18', 1616643066, '啊实打实');
INSERT INTO `b5net_test_chat` VALUES (26, '123.132.237.18', 1616643545, 'asdasd');
INSERT INTO `b5net_test_chat` VALUES (27, '123.132.237.18', 1616643547, '阿三大苏打撒旦撒');
INSERT INTO `b5net_test_chat` VALUES (28, '123.132.237.18', 1616650069, '啊实打实');

-- ----------------------------
-- Table structure for b5net_test_online
-- ----------------------------
DROP TABLE IF EXISTS `b5net_test_online`;
CREATE TABLE `b5net_test_online`  (
  `ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1',
  `create_time` datetime(0) NULL DEFAULT NULL,
  `fd` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `update_time` datetime(0) NULL DEFAULT NULL,
  `isrun` tinyint(1) NULL DEFAULT 1,
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 102 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of b5net_test_online
-- ----------------------------
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-25 14:32:34', '1', '2021-03-25 14:32:48', 0, 1);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-25 14:45:07', '1', '2021-03-25 14:45:10', 0, 2);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-25 14:45:10', '2', '2021-03-25 14:45:10', 0, 3);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-25 14:45:10', '3', '2021-03-25 14:48:49', 0, 4);
INSERT INTO `b5net_test_online` VALUES ('144.52.190.229', '2021-03-25 17:38:34', '7', '2021-03-25 17:38:43', 0, 5);
INSERT INTO `b5net_test_online` VALUES ('144.52.190.229', '2021-03-25 17:38:43', '8', '2021-03-25 17:38:47', 0, 6);
INSERT INTO `b5net_test_online` VALUES ('113.200.81.36', '2021-03-25 17:49:50', '9', '2021-03-25 17:51:03', 0, 7);
INSERT INTO `b5net_test_online` VALUES ('113.200.81.36', '2021-03-25 17:51:03', '10', '2021-03-25 17:51:13', 0, 8);
INSERT INTO `b5net_test_online` VALUES ('121.15.131.171', '2021-03-25 18:58:07', '11', '2021-03-25 18:58:17', 0, 9);
INSERT INTO `b5net_test_online` VALUES ('121.15.131.171', '2021-03-25 18:59:31', '12', '2021-03-25 19:45:00', 0, 10);
INSERT INTO `b5net_test_online` VALUES ('121.15.131.171', '2021-03-25 19:45:00', '13', '2021-03-25 21:28:28', 0, 11);
INSERT INTO `b5net_test_online` VALUES ('144.52.190.229', '2021-03-25 21:58:07', '14', '2021-03-25 21:58:19', 0, 12);
INSERT INTO `b5net_test_online` VALUES ('117.147.41.85', '2021-03-25 22:30:32', '15', '2021-03-25 22:32:54', 0, 13);
INSERT INTO `b5net_test_online` VALUES ('180.111.248.18', '2021-03-26 10:03:33', '92', '2021-03-26 10:04:25', 0, 14);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 10:31:06', '93', '2021-03-26 10:43:56', 0, 15);
INSERT INTO `b5net_test_online` VALUES ('139.226.50.22', '2021-03-26 10:39:14', '94', '2021-03-26 10:39:29', 0, 16);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 10:44:25', '96', '2021-03-26 10:44:42', 0, 17);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 11:27:29', '97', '2021-03-26 11:35:48', 0, 18);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 11:35:48', '98', '2021-03-26 11:51:38', 0, 19);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 11:51:38', '100', '2021-03-26 11:53:53', 0, 20);
INSERT INTO `b5net_test_online` VALUES ('221.10.101.35', '2021-03-26 13:24:15', '101', '2021-03-26 13:24:19', 0, 21);
INSERT INTO `b5net_test_online` VALUES ('221.10.101.35', '2021-03-26 13:24:47', '102', '2021-03-26 13:25:36', 0, 22);
INSERT INTO `b5net_test_online` VALUES ('221.10.101.35', '2021-03-26 13:54:45', '103', '2021-03-26 13:55:44', 0, 23);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 14:31:34', '107', '2021-03-26 14:31:43', 0, 24);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 14:31:43', '108', '2021-03-26 14:31:45', 0, 25);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 14:31:45', '109', '2021-03-26 14:32:18', 0, 26);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 14:32:18', '110', '2021-03-26 14:33:49', 0, 27);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 14:33:49', '111', '2021-03-26 14:34:22', 0, 28);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 14:34:22', '112', '2021-03-26 14:34:42', 0, 29);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 14:34:42', '113', '2021-03-26 14:34:57', 0, 30);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 14:34:57', '114', '2021-03-26 14:35:24', 0, 31);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 14:35:24', '115', '2021-03-26 14:36:12', 0, 32);
INSERT INTO `b5net_test_online` VALUES ('210.75.9.81', '2021-03-26 14:36:08', '116', '2021-03-26 14:37:19', 0, 33);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 14:36:12', '117', '2021-03-26 14:41:50', 0, 34);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 14:41:50', '118', '2021-03-26 14:42:31', 0, 35);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 14:42:31', '119', '2021-03-26 14:47:43', 0, 36);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 14:47:43', '124', '2021-03-26 14:48:34', 0, 37);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 14:48:35', '125', '2021-03-26 14:48:58', 0, 38);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 14:48:59', '126', '2021-03-26 14:49:05', 0, 39);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 14:49:05', '127', '2021-03-26 14:49:18', 0, 40);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 14:49:18', '128', '2021-03-26 14:49:41', 0, 41);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 14:49:41', '129', '2021-03-26 14:50:17', 0, 42);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 14:50:17', '130', '2021-03-26 14:50:43', 0, 43);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 14:50:44', '131', '2021-03-26 14:50:44', 0, 44);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 14:50:45', '132', '2021-03-26 14:50:50', 0, 45);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 14:50:50', '133', '2021-03-26 14:51:00', 0, 46);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 14:51:00', '134', '2021-03-26 14:51:09', 0, 47);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 14:51:09', '135', '2021-03-26 14:51:19', 0, 48);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 14:51:19', '136', '2021-03-26 14:51:26', 0, 49);
INSERT INTO `b5net_test_online` VALUES ('175.7.88.127', '2021-03-26 14:51:25', '137', '2021-03-26 14:53:21', 0, 50);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 14:51:26', '138', '2021-03-26 15:05:24', 0, 51);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 15:05:24', '139', '2021-03-26 15:06:30', 0, 52);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 15:06:30', '140', '2021-03-26 15:06:40', 0, 53);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 15:06:40', '141', '2021-03-26 15:07:10', 0, 54);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 15:07:10', '142', '2021-03-26 15:07:24', 0, 55);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 15:07:24', '143', '2021-03-26 15:07:48', 0, 56);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 15:07:49', '144', '2021-03-26 15:07:56', 0, 57);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 15:07:56', '145', '2021-03-26 15:08:04', 0, 58);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 15:08:04', '146', '2021-03-26 15:08:13', 0, 59);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 15:08:13', '147', '2021-03-26 15:10:49', 0, 60);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 15:10:49', '148', '2021-03-26 15:11:58', 0, 61);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 15:11:59', '149', '2021-03-26 15:13:13', 0, 62);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 15:13:13', '150', '2021-03-26 15:17:48', 0, 63);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 15:17:48', '151', '2021-03-26 15:23:10', 0, 64);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 15:23:10', '152', '2021-03-26 15:58:32', 0, 65);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 15:58:32', '153', '2021-03-26 16:01:16', 0, 66);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 16:01:16', '154', '2021-03-26 16:03:30', 0, 67);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 16:03:30', '155', '2021-03-26 16:04:26', 0, 68);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 16:04:26', '156', '2021-03-26 16:06:21', 0, 69);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 16:06:21', '157', '2021-03-26 16:06:52', 0, 70);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 16:06:52', '158', '2021-03-26 16:08:22', 0, 71);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 16:08:22', '159', '2021-03-26 16:09:02', 0, 72);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 16:09:02', '160', '2021-03-26 16:09:16', 0, 73);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 16:09:16', '161', '2021-03-26 16:09:30', 0, 74);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 16:09:30', '162', '2021-03-26 16:15:01', 0, 75);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 16:15:02', '163', '2021-03-26 16:40:21', 0, 76);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 16:40:21', '165', '2021-03-26 16:41:47', 0, 77);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 16:41:47', '166', '2021-03-26 16:42:32', 0, 78);
INSERT INTO `b5net_test_online` VALUES ('123.132.237.18', '2021-03-26 16:42:32', '167', '2021-03-26 16:56:30', 0, 79);
INSERT INTO `b5net_test_online` VALUES ('117.159.194.85', '2021-03-26 17:38:36', '168', '2021-03-26 17:40:08', 0, 80);
INSERT INTO `b5net_test_online` VALUES ('117.159.194.85', '2021-03-26 17:40:08', '169', '2021-03-26 17:40:14', 0, 81);
INSERT INTO `b5net_test_online` VALUES ('117.159.194.85', '2021-03-26 17:40:14', '170', '2021-03-26 17:48:54', 0, 82);
INSERT INTO `b5net_test_online` VALUES ('117.159.194.85', '2021-03-26 17:48:54', '171', '2021-03-26 17:48:58', 0, 83);
INSERT INTO `b5net_test_online` VALUES ('144.52.190.229', '2021-03-26 18:08:37', '172', '2021-03-26 18:10:00', 0, 84);
INSERT INTO `b5net_test_online` VALUES ('144.52.190.229', '2021-03-26 18:10:00', '173', '2021-03-26 18:41:55', 0, 85);
INSERT INTO `b5net_test_online` VALUES ('144.52.190.229', '2021-03-26 18:51:30', '174', '2021-03-26 18:52:09', 0, 86);
INSERT INTO `b5net_test_online` VALUES ('144.52.190.229', '2021-03-26 18:52:09', '175', '2021-03-26 19:26:17', 0, 87);
INSERT INTO `b5net_test_online` VALUES ('144.52.190.229', '2021-03-26 22:14:48', '176', '2021-03-26 23:09:08', 0, 88);
INSERT INTO `b5net_test_online` VALUES ('113.129.60.94', '2021-03-26 22:28:16', '177', '2021-03-26 22:28:54', 0, 89);
INSERT INTO `b5net_test_online` VALUES ('113.129.60.94', '2021-03-26 22:28:54', '178', '2021-03-26 22:29:29', 0, 90);
INSERT INTO `b5net_test_online` VALUES ('113.129.60.94', '2021-03-26 22:29:35', '179', '2021-03-26 22:31:29', 0, 91);
INSERT INTO `b5net_test_online` VALUES ('113.129.60.94', '2021-03-26 22:31:42', '180', '2021-03-26 22:32:12', 0, 92);
INSERT INTO `b5net_test_online` VALUES ('144.52.190.229', '2021-03-26 23:09:08', '181', '2021-03-26 23:11:44', 0, 93);
INSERT INTO `b5net_test_online` VALUES ('144.52.190.229', '2021-03-26 23:11:44', '182', '2021-03-26 23:12:03', 0, 94);
INSERT INTO `b5net_test_online` VALUES ('144.52.190.229', '2021-03-26 23:12:03', '183', '2021-03-26 23:18:38', 0, 95);
INSERT INTO `b5net_test_online` VALUES ('117.159.194.85', '2021-03-27 09:42:54', '193', '2021-03-27 10:20:09', 0, 96);
INSERT INTO `b5net_test_online` VALUES ('117.159.194.85', '2021-03-27 10:20:09', '194', '2021-03-27 11:36:06', 0, 97);
INSERT INTO `b5net_test_online` VALUES ('144.52.190.229', '2021-03-27 15:16:24', '197', '2021-03-27 15:16:36', 0, 98);
INSERT INTO `b5net_test_online` VALUES ('144.52.190.229', '2021-03-27 16:04:00', '199', '2021-03-27 16:56:32', 0, 99);
INSERT INTO `b5net_test_online` VALUES ('144.52.190.229', '2021-03-27 16:56:32', '201', '2021-03-27 16:56:39', 0, 100);
INSERT INTO `b5net_test_online` VALUES ('144.52.190.229', '2021-03-27 16:56:41', '202', '2021-03-27 17:34:37', 0, 101);
INSERT INTO `b5net_test_online` VALUES ('144.52.190.229', '2021-03-27 22:17:47', '207', '2021-03-27 22:18:35', 0, 102);
INSERT INTO `b5net_test_online` VALUES ('144.52.190.229', '2021-03-27 22:19:14', '208', '2021-03-27 23:07:01', 0, 103);
INSERT INTO `b5net_test_online` VALUES ('61.140.134.1', '2021-03-27 22:23:59', '209', '2021-03-27 22:24:26', 0, 104);
INSERT INTO `b5net_test_online` VALUES ('61.140.134.1', '2021-03-27 22:24:26', '210', '2021-03-27 22:24:27', 0, 105);
INSERT INTO `b5net_test_online` VALUES ('144.52.190.229', '2021-03-27 23:07:01', '211', '2021-03-27 23:12:16', 0, 106);
INSERT INTO `b5net_test_online` VALUES ('144.52.190.229', '2021-03-27 23:12:16', '212', '2021-03-27 23:14:20', 0, 107);
INSERT INTO `b5net_test_online` VALUES ('125.34.15.95', '2021-03-27 23:14:33', '213', '2021-03-27 23:15:31', 0, 108);
INSERT INTO `b5net_test_online` VALUES ('119.128.113.33', '2021-03-28 07:08:51', '227', '2021-03-28 07:09:44', 0, 109);
INSERT INTO `b5net_test_online` VALUES ('144.52.190.229', '2021-03-28 09:29:58', '228', '2021-03-28 11:30:08', 0, 110);
INSERT INTO `b5net_test_online` VALUES ('113.123.222.9', '2021-03-28 10:11:23', '229', '2021-03-28 10:27:08', 0, 111);
INSERT INTO `b5net_test_online` VALUES ('113.123.222.9', '2021-03-28 10:11:48', '230', '2021-03-28 10:11:51', 0, 112);
INSERT INTO `b5net_test_online` VALUES ('113.70.230.182', '2021-03-28 12:48:17', '231', '2021-03-28 12:48:34', 0, 113);
INSERT INTO `b5net_test_online` VALUES ('144.52.190.229', '2021-03-28 14:20:00', '234', '2021-03-28 14:23:41', 0, 114);
INSERT INTO `b5net_test_online` VALUES ('144.52.190.229', '2021-03-28 14:23:41', '235', '2021-03-28 14:24:40', 0, 115);
INSERT INTO `b5net_test_online` VALUES ('144.52.190.229', '2021-03-28 14:24:40', '236', '2021-03-28 14:25:26', 0, 116);
INSERT INTO `b5net_test_online` VALUES ('144.52.190.229', '2021-03-28 14:25:26', '237', '2021-03-28 14:34:50', 0, 117);
INSERT INTO `b5net_test_online` VALUES ('144.52.190.229', '2021-03-28 14:34:50', '238', '2021-03-28 15:09:05', 0, 118);
INSERT INTO `b5net_test_online` VALUES ('144.52.190.229', '2021-03-28 15:36:17', '239', '2021-03-28 16:13:04', 0, 119);
INSERT INTO `b5net_test_online` VALUES ('144.52.190.229', '2021-03-28 16:13:04', '243', '2021-03-28 16:14:04', 0, 120);
INSERT INTO `b5net_test_online` VALUES ('144.52.190.229', '2021-03-28 16:14:04', '244', '2021-03-28 16:21:39', 0, 121);
INSERT INTO `b5net_test_online` VALUES ('144.52.190.229', '2021-03-28 16:21:40', '245', '2021-03-28 16:21:51', 0, 122);
INSERT INTO `b5net_test_online` VALUES ('144.52.190.229', '2021-03-28 16:21:51', '246', '2021-03-28 16:24:16', 0, 123);
INSERT INTO `b5net_test_online` VALUES ('144.52.190.229', '2021-03-28 16:24:16', '247', '2021-03-28 16:25:14', 0, 124);
INSERT INTO `b5net_test_online` VALUES ('144.52.190.229', '2021-03-28 16:25:14', '248', '2021-03-28 16:25:21', 0, 125);
INSERT INTO `b5net_test_online` VALUES ('144.52.190.229', '2021-03-28 16:25:21', '249', '2021-03-28 16:53:40', 0, 126);
INSERT INTO `b5net_test_online` VALUES ('144.52.190.229', '2021-03-28 16:53:40', '250', '2021-03-28 16:56:33', 0, 127);
INSERT INTO `b5net_test_online` VALUES ('144.52.190.229', '2021-03-28 16:56:33', '252', NULL, 1, 128);

-- ----------------------------
-- Table structure for b5net_web_ad
-- ----------------------------
DROP TABLE IF EXISTS `b5net_web_ad`;
CREATE TABLE `b5net_web_ad`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '信息标题',
  `pos_id` int(0) NOT NULL DEFAULT 0 COMMENT '推荐位置',
  `linkurl` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '跳转链接',
  `listsort` int(0) NOT NULL DEFAULT 0 COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态',
  `text_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '文本信息',
  `text_rich` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '富文本信息',
  `imglist` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '图片信息',
  `create_time` datetime(0) NULL DEFAULT NULL,
  `update_time` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '推荐信息表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of b5net_web_ad
-- ----------------------------
INSERT INTO `b5net_web_ad` VALUES (1, '首页banner1', 1, 'http://www.baidu.com', 1, 1, 'asdasds', 'asdasdasd', '/uploads/webad/2021/03/18/74f4306c687e31e0a6ae303901c459f3.jpg', '2021-03-04 16:01:17', '2021-03-18 11:30:30');
INSERT INTO `b5net_web_ad` VALUES (2, '首页banner2', 1, 'http://www.b5net.com', 1, 1, '', '', '/uploads/webad/2021/03/18/6c841806e83f48bbc90d4ec7afa1cd8d.jpg', '2021-03-04 16:26:22', '2021-03-18 11:45:14');

-- ----------------------------
-- Table structure for b5net_web_cat
-- ----------------------------
DROP TABLE IF EXISTS `b5net_web_cat`;
CREATE TABLE `b5net_web_cat`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '栏目名称',
  `parent_id` int(0) NULL DEFAULT 0 COMMENT '父级栏目',
  `listsort` int(0) NOT NULL DEFAULT 0 COMMENT '显示排序',
  `type` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT 'album相册，list文章列表，page单页，link外链,',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态',
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '外链地址',
  `template_list` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '列表模板',
  `template_info` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '详情模板',
  `checkcode` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '选中菜单的标识',
  `create_time` datetime(0) NULL DEFAULT NULL,
  `update_time` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '网站-菜单分类' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of b5net_web_cat
-- ----------------------------
INSERT INTO `b5net_web_cat` VALUES (1, '企业简介', 0, 0, 'page', 1, '', '', '', 'jianjie', '2021-02-25 16:05:58', '2021-03-05 13:25:59');
INSERT INTO `b5net_web_cat` VALUES (2, '产品展示', 0, 1, 'none', 1, '', '', '', 'goods', '2021-02-25 16:08:10', '2021-03-05 13:26:53');
INSERT INTO `b5net_web_cat` VALUES (3, '联系我们', 0, 4, 'page', 1, '', '', '', 'aboutus', '2021-02-25 16:09:06', '2021-03-05 13:43:51');
INSERT INTO `b5net_web_cat` VALUES (4, '服务范围', 0, 3, 'link', 1, 'http://www.b5net.com', '', '', 'fuwu', '2021-02-25 16:12:30', '2021-03-05 16:51:46');
INSERT INTO `b5net_web_cat` VALUES (5, 'PE塑胶管', 2, 1, 'goods', 1, '', '', '', 'goods', '2021-02-25 16:14:54', '2021-03-17 16:36:34');
INSERT INTO `b5net_web_cat` VALUES (9, 'PVC塑胶管', 2, 2, 'goods', 1, '', '', '', 'goods', '2021-03-04 17:23:53', '2021-03-05 13:26:25');
INSERT INTO `b5net_web_cat` VALUES (12, '新闻资讯', 0, 5, 'list', 1, '', '', '', '', '2021-03-22 11:21:09', '2021-03-22 11:21:09');

-- ----------------------------
-- Table structure for b5net_web_list
-- ----------------------------
DROP TABLE IF EXISTS `b5net_web_list`;
CREATE TABLE `b5net_web_list`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标题',
  `remark` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '简介',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态',
  `author` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '作者',
  `froms` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '来源',
  `thumbimg` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '缩略图',
  `catid` int(0) NOT NULL DEFAULT 0 COMMENT '所属菜单ID',
  `click` int(0) NULL DEFAULT 0 COMMENT '点击量',
  `linkurl` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '外链地址',
  `create_time` datetime(0) NULL DEFAULT NULL,
  `update_time` datetime(0) NULL DEFAULT NULL,
  `subtime` datetime(0) NULL DEFAULT NULL COMMENT '发布时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '网站-信息列表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of b5net_web_list
-- ----------------------------
INSERT INTO `b5net_web_list` VALUES (3, 'PE穿线管', '', 1, '', '', '/uploads/weblist/2021/03/05/6b1c444d414becb88d5875b34447cb24.jpg', 5, 0, '', '2021-03-01 16:34:53', '2021-03-05 11:39:17', '2021-03-05 11:38:02');
INSERT INTO `b5net_web_list` VALUES (4, '全市民营经济统战工作会议召开', '3月4日上午，全市民营经济统战工作会议召开。市委书记王安德出席会议并讲话，市委副书记、市长孟庆斌主持。', 1, '临沂日报', '临沂日报', '/uploads/weblist/2021/03/22/d826c37a90834c9d3c051167e35a7485.jpg', 12, 0, '', '2021-03-03 14:21:00', '2021-03-24 14:50:34', '2021-03-22 11:15:00');
INSERT INTO `b5net_web_list` VALUES (5, '企业简介', '', 1, '', '', '', 1, 0, '', '2021-03-04 17:34:50', '2021-03-05 13:45:02', '2021-03-05 13:44:57');
INSERT INTO `b5net_web_list` VALUES (7, 'PVC-M给水管', '', 1, '', '', '/uploads/weblist/2021/03/05/ca174243017980aff0e5057b0e62326a.jpg', 9, 0, '', '2021-03-05 11:32:01', '2021-03-05 11:32:01', '2021-03-05 11:26:49');
INSERT INTO `b5net_web_list` VALUES (8, 'PVC-U给水管', '', 1, '', '', '/uploads/weblist/2021/03/05/b492a9964eef0b249eb8bf40518f63ee.jpg', 9, 0, '', '2021-03-05 11:34:51', '2021-03-05 11:34:51', '2021-03-05 11:32:48');
INSERT INTO `b5net_web_list` VALUES (9, 'PVC雨水管道', '', 1, '', '', '/uploads/weblist/2021/03/05/4a979db00e37757190a5ef25505e6032.jpg', 9, 0, '', '2021-03-05 11:36:06', '2021-03-05 11:36:06', '2021-03-05 11:35:34');
INSERT INTO `b5net_web_list` VALUES (10, 'PE农田灌溉管', '', 1, '', '', '/uploads/weblist/2021/03/05/1725a2e8c1153283d96befd516dcf59c.jpg', 5, 0, '', '2021-03-05 11:42:27', '2021-03-05 11:42:27', '2021-03-05 11:40:32');
INSERT INTO `b5net_web_list` VALUES (11, 'PE螺旋波纹管', '', 1, '', '', '/uploads/weblist/2021/03/05/924bcaa62f33f36c51143b3d8c7de62e.jpg', 5, 0, '', '2021-03-05 11:44:21', '2021-03-05 11:44:21', '2021-03-05 11:43:19');
INSERT INTO `b5net_web_list` VALUES (12, '联系我们', '', 1, '', '', '', 3, 0, '', '2021-03-05 13:43:31', '2021-03-05 13:50:46', '2021-03-05 13:50:34');
INSERT INTO `b5net_web_list` VALUES (13, '我市中小学、幼儿园如期开学   寒假，再见！新学期，你好!', '安静了月余的校园，再现朗朗读书声。3月1日，临沂市中小学、幼儿园分批、错时错峰，如期开学，让校园重现往日生机。', 1, '沂蒙晚报', '沂蒙晚报', '/uploads/weblist/2021/03/05/70db3bb4799fcce6ed970d773ba44d49.jpg', 12, 0, '', '2021-03-05 14:24:26', '2021-03-24 14:50:41', '2021-03-02 14:23:27');
INSERT INTO `b5net_web_list` VALUES (14, '舞狮闹新春', '', 1, '新华社', '新华社', '/uploads/weblist/2021/03/05/0fa247d4c6b7724d2b4a09da59b169a3.jpg', 12, 0, '', '2021-03-05 14:25:55', '2021-03-24 14:51:01', '2021-02-18 14:26:05');

-- ----------------------------
-- Table structure for b5net_web_list_ext
-- ----------------------------
DROP TABLE IF EXISTS `b5net_web_list_ext`;
CREATE TABLE `b5net_web_list_ext`  (
  `id` int(0) UNSIGNED NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '富文本信息',
  `imglist` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '图片列表',
  `catid` int(0) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '网站-信息列表其他信息' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of b5net_web_list_ext
-- ----------------------------
INSERT INTO `b5net_web_list_ext` VALUES (3, '<p>&nbsp; &nbsp; &nbsp; &nbsp;PE管是以聚乙烯树脂为主要原料，加入适当助剂，经挤出方式加工成型，具有耐腐蚀、抗冲击、抗老化、强度高、易弯曲、施工便捷等特点。</p><p style=\"margin-top: 5px; margin-bottom: 5px;\">&nbsp; &nbsp; &nbsp; &nbsp;可广泛用于室外通信电缆和光缆的护套管道系统，包括局间中继管道、馈线管道、配线管道和专用网管道以及特殊规定的长途通信管道。具有很强的适用型，适合电缆、电线等诸多线缆的穿放。</p><p style=\"margin-top: 5px; margin-bottom: 5px;\"><br></p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　*执行标准：GB/T13663-2000</p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　盘管（100米，200米，300米）</p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　穿线索主要型号：32405063</p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　*颜色：白色、红色、也可是用户指定的其它颜色。</p><p style=\"margin-top: 5px; margin-bottom: 5px;\"><br></p><p style=\"margin-top: 5px; margin-bottom: 5px;\">（1）优异的物理性能采用优良聚乙烯原料生产。既具有良好的刚性、强度、也有很好的柔性。既可以采用接套连接，又可以采用热熔对接。施工简便，有利于管道的安装。</p><p style=\"margin-top: 5px; margin-bottom: 5px;\"><br></p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　（2）耐腐蚀，使用寿命长。在沿海地区，地下水位偏高，土地湿度大。使用金属或其它管道须防腐，且寿命一般只有30年，而PE管材可耐多种化学介质，不受土壤腐蚀的影响。</p><p style=\"margin-top: 5px; margin-bottom: 5px;\"><br></p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　（3）韧性、挠度好。PE管材是一种高韧性管材，其断裂伸长率超过500％。对基础不均匀的地面沉降和错位的适应能力非常强。抗震性好。小口径管材可任意弯曲。（PE穿线管厂家如何选择）</p><p style=\"margin-top: 5px; margin-bottom: 5px;\"><br></p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　（4）管壁光滑，摩擦系数小，穿缆容易，施工效率高，施工成本低。</p><p style=\"margin-top: 5px; margin-bottom: 5px;\"><br></p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　（5）电绝缘性能好，使用寿命长（地埋管寿命五十年以上），经久耐用，线路运行安全可靠。</p><p style=\"margin-top: 5px; margin-bottom: 5px;\"><br></p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　（6）重量轻，维修、安装施工、保养方便，易于运输及操作。</p><p style=\"margin-top: 5px; margin-bottom: 5px;\"><br></p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　（7）小口径管材可采用盘管形式，管段长，接头少，安装简便。</p><p style=\"margin-top: 5px; margin-bottom: 5px;\"><br></p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　（8）管材可做成多种颜色，以示区分。（如何选择PE管）</p><p style=\"margin-top: 5px; margin-bottom: 5px;\"><br></p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　（9）低温抗冲性能优异。PE的低温脆化温度较低，可在-20～60℃温度范围内安全使用。冬季施工时因材料冲击性好，不会发生管子脆裂。</p><p style=\"margin-top: 5px; margin-bottom: 5px;\"><br></p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　（10）耐磨性好。PE管与其它金属管材相比，耐磨性是金属管的4倍。</p><p style=\"margin-top: 5px; margin-bottom: 5px;\"><br></p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　（11）多种全新的施工方式。PE管除了传统的开挖方式进行施工外，还可以采用多种全新的非开挖技术，如顶管，衬管，裂管等方式施工，这对于一些不允许开挖的场所，是好的选择。</p><p><br></p>', '/uploads/weblist/2021/03/05/6b1c444d414becb88d5875b34447cb24.jpg', 5);
INSERT INTO `b5net_web_list_ext` VALUES (4, '<div>3月4日上午，全市民营经济统战工作会议召开。市委书记王安德出席会议并讲话，市委副书记、市长孟庆斌主持。</div><div>王安德指出，临沂是民营经济大市，民营市场主体是推动经济社会发展的重要力量。全市各级各部门要深入学习贯彻习近平总书记关于新时代民营经济统战工作重要指示精神，坚持“两个毫不动摇”“三个没有变”，扎实做好民营经济统战工作，促进民营经济高质量发展。</div><div>王安德强调，要强化政治引领，进一步促进民营经济人士健康成长。着力巩固扩大政治共识，自觉用习近平新时代中国特色社会主义思想武装头脑、指导实践；着力深化理想信念教育，不断增强政治认同、思想认同、理论认同、情感认同；着力加强民营企业党建工作，教育引导民营经济人士树牢“四个意识”、坚定“四个自信”、做到“两个维护”。</div><div>王安德要求，要主动担当作为，进一步推动民营经济高质量发展。持续优化营商环境，抓好政策落实、政务服务、法治环境建设；健全政企沟通协商机制，坚持开门决策，构建“亲”“清”政商关系，引导民营经济人士发挥作用；坚决防范化解债务风险和安全生产风险，推动企业持续健康发展。</div><div>王安德强调，要加强党的领导，进一步凝聚民营经济统战工作合力。完善体制机制，明确职责、密切配合，引导民营企业规范有序发展；坚持重心下移、力量下沉，推动基层民营经济统战工作扎实开展；提升服务本领，加强教育培训，提升民营经济统战干部队伍整体素质，不断开创全市民营经济统战工作新局面。</div><div>孟庆斌在主持讲话时强调，全市各级各部门要提高政治站位，充分认识坚持基本经济制度的极端重要性，毫不动摇地鼓励、支持、引导非公有制经济发展。要结合党史学习教育，引导民营经济人士坚定理想信念，始终与党委政府同心同德，做爱国敬业、守法经营、创业创新、回报社会的典范。要用心搞好服务，深化“放管服”改革，坚持国企、民企一视同仁，推行全生命周期服务，用好政策落实、问题解决“两张清单”，做到“企业需要时、政府无处不在，企业不需要时、政府无声无息”。要形成工作合力，强化工作统筹、政策统筹、力量统筹，推动民营经济统战工作再上新水平，为加快临沂“由大到强、由美到富、由新到精”战略性转变贡献力量。</div><div>会上，传达了习近平总书记关于新时代民营经济统战工作的重要指示精神，学习了全国、全省民营经济统战工作会议要求，兰山区、市工信局、翔宇实业集团负责同志作了发言。</div><div>会议采取视频形式，市里设主会场，各县区设分会场。市领导边峰、侯晓滨、王晓嫚在主会场参加会议。</div>', '/uploads/weblist/2021/03/22/d826c37a90834c9d3c051167e35a7485.jpg', 12);
INSERT INTO `b5net_web_list_ext` VALUES (5, '<div>1、公司概况：这里面可以包括注册时间，注册资本，公司性质，技术力量，规模，员工人数，员工素质等;</div><div>2、公司发展状况:公司的发展速度,有何成绩,有何荣誉称号等;</div><div>3、公司文化:公司的目标,理念,宗旨,使命,愿景,寄语等;</div><div>4、公司主要产品:性能,特色,创新,超前;</div><div>5、销售业绩及网络:销售量,各地销售点等;</div><div>6、售后服务:主要是公司售后服务的承诺。</div><div><br></div><div>以上几个点都是重要的因素。</div><div><br></div><div>拓展资料：</div><div>一、公司的定义：</div><div>公司是依照公司法在中国境内设立的有限责任公司和股份有限公司，是以营利为目的的企业法人。它是适应市场经济社会化大生产的需要而形成的一种企业组织形式。</div><div><br></div><div>二、公司的类型：</div><div>1、无限责任公司</div><div><br></div><div>是指全体股东对公司债务承担无限连带清偿责任的公司。</div><div>2、有限责任公司</div><div>是指公司全体股东对公司债务仅以各自的出资额为限承担责任的公司。</div><div><br></div><div><br></div><div>3、两合公司</div><div>是指公司的一部分股东对公司债务承担无限连带责任，另一部分股东对公司债务仅以出资额为限承担有限责任的公司。</div><div><br></div><div>4、股份有限公司</div><div>是指公司资本划分为等额股份，全体股东仅以各自持有的股份额为限对公司债务承担责任的公司。</div><div><br></div><div>5、股份两合公司</div><div>是指公司资本划分为等额股份，一部分股东对公司债务承担无限连带责任，另一部分股东对公司债务仅以其持有的股份额为限承担责任的公司。</div>', '', 1);
INSERT INTO `b5net_web_list_ext` VALUES (7, '<p>&nbsp; &nbsp; &nbsp; &nbsp; 高抗冲聚氯乙烯（PVC-M）环保给水管是以PVC树脂粉为主材料，添加抗冲改性剂，通过先进的加工工艺挤出成型的兼有高强度及高韧性的高性能新型管道。产品执行行业标准CJ/T272-2008，性能优异。此管道在国外已成熟，并广泛推广应用。</p><p><br></p><p>&nbsp; &nbsp; &nbsp; &nbsp; 抗冲改性剂的添加在保持PVC-U管道高强度的同时增加了材料的延展性，从而使得产品具有良好的韧性，增强了管道的安全性和环境适应性。产品兼有了PVC-U管简易的连接方式、平直性等优点和PE管的高抗冲性能，是综合性能优异的管道。</p><p><br></p><p><b>高抗冲PVC-M环保给水管主要特点</b></p><p><br></p><p>1、质量轻，便于运输与安装。由于原料进行了高抗冲改性，在同等压力下，PVC-M管壁厚更小，质量也更轻。</p><p><br></p><p>2、良好的刚度和韧性。PVC-M管材在保持PVC-U管材的弹性模量的同时，提高了管材的柔韧性，抗冲击性能优异，能抵抗外界冲击，环境适应性强。耐环境开裂性能的提高能有效抵抗安装和运输过程中对管材的外力冲击。与同规格的普通PVC-U管材相比，抗冲击性能显著提高，能更有效地抵抗点载荷和地基不均匀沉降。</p><p><br></p><p>3、卫生环保，没有污染，保证输水水质，不结垢，不滋生细菌。管道使用无铅配方生产，卫生性能符合GB/T17219-1998安全性评价标准规定以及国家卫生部相关的卫生安全评价规定。</p><p><br></p><p>4、连接方式简便可靠。产品使用简单易行的胶粘剂粘接或弹性密封圈连接，安装简易牢固。</p><p><br></p><p>5、管道运行、维护成本更低。产品壁厚小，管道流径大，节能低耗。PVC-M管材的水力坡降值小于PVC-U管材，在出厂水压相同时，在管网相同的地点上用户水压相对较高，可以保证更多用户对水压的要求，且常年运行费用大大降低。产品韧性的提高，提升了管道抗水锤能力，杜绝管线在运行过程中的破坏，减少管道维护成本。</p><p><br></p><p>6、耐腐蚀，使用寿命长。耐化学腐蚀性能强，可用于任何适用于普通PVC-U管道的场合。在正常使用条件下，使用寿命在50年以上。</p>', '/uploads/weblist/2021/03/05/ca174243017980aff0e5057b0e62326a.jpg', 9);
INSERT INTO `b5net_web_list_ext` VALUES (8, '<p>&nbsp; &nbsp; &nbsp; &nbsp; UPVC管是一种以聚氯乙烯（PVC）树脂为质料，不含增塑剂的塑料管材。随着化学工业技术的开展，现能够出产无毒级的管材，所以它具有通常聚氯乙烯的功能，又增加了一些优良功能，具体来说它具有耐腐蚀性和柔软性好的长处，因此格外适用于供水管网。因为它不导电，因此不容易与酸、碱、盐发作电化学反响，酸、碱、盐都难于腐蚀它，所以不需要外防腐涂层和内衬。而柔软性好这又克服了曩昔塑料管脆性的缺陷，在荷载作用下能发生屈从而不发作决裂。</p><p><br></p><p>1、自来水配管工程（包括室内供水和室外市政水管），由于Upvc塑料管具有耐酸碱、耐腐蚀、不生锈、不结垢、保护水质、避免水次污染的优点，在大力提倡生产环保产品的今天，作为一种保护人类健康的理想“绿色建材”，已被中国乃至全球广泛推广应用。</p><p><br></p><p style=\"margin-top: 5px; margin-bottom: 5px;\">2、节水灌溉配管工程，Upvc喷滴灌溉系统的使用与普通灌溉相比，可节水50％－70％，同时可节约肥料和农药用量，农作物产量可提高30％－80％。在中国水资源缺乏、农业生产灌溉方式落后的今天，这对促进中国节水农业生产发展有着较大的社会效益。</p><p style=\"margin-top: 5px; margin-bottom: 5px;\"><br></p><p style=\"margin-top: 5px; margin-bottom: 5px;\">3、建筑用配管工程。</p><p style=\"margin-top: 5px; margin-bottom: 5px;\"><span style=\"color: inherit;\"><br></span></p><p style=\"margin-top: 5px; margin-bottom: 5px;\"><span style=\"color: inherit;\">4、Upvc塑料管具有优异的绝缘能力，还广泛用作邮电通讯电缆导管。</span><br></p><p style=\"margin-top: 5px; margin-bottom: 5px;\"><br></p><p style=\"margin-top: 5px; margin-bottom: 5px;\">5、Upvc塑料管耐酸碱、耐腐蚀，许多化工厂用作输液配管。其他还用于凿井工程、医药配管工程、矿物盐水输送配管工程、电气配管工程等。</p><p style=\"margin-top: 5px; margin-bottom: 5px;\"><br></p><p style=\"margin-top: 5px; margin-bottom: 5px;\">&nbsp; &nbsp; &nbsp; &nbsp; UPVC管的韧性是非常关键的指标。韧性大的管当我们将其锯成窄条后，试着折180°，如果一折就断，说明韧性很差，脆性大；如果很难折断，说明有韧性，而且在折时越需要费力才能折断的管材，强度很好，韧性一般不错。结尾可观察断茬（锯的茬口除外），茬口越细腻，说明管材均化性、强度和韧性越好。 UPVC管的抗冲击性，也可用简单的办法做宏观的大致的判断。可选择室温接近20℃的环境，将锯成200mm长的管段（对110mm管），用铁锤猛击，好的管材，用人力很难一次击破。（管越粗，承力越大）<br></p><p><span style=\"color: rgb(0, 0, 0); font-family: &quot;Microsoft YaHei&quot;; font-size: 14px; word-spacing: 10px;\"><br></span></p>', '/uploads/weblist/2021/03/05/b492a9964eef0b249eb8bf40518f63ee.jpg', 9);
INSERT INTO `b5net_web_list_ext` VALUES (9, '', '/uploads/weblist/2021/03/05/4a979db00e37757190a5ef25505e6032.jpg,/uploads/weblist/2021/03/05/a117db1348d657b10948ad808c440984.jpg', 9);
INSERT INTO `b5net_web_list_ext` VALUES (10, '<p style=\"margin-top: 5px; margin-bottom: 5px;\">大棚pe灌溉管，PE农田灌溉管的连接：</p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　1．电热熔接性：采用专用电热熔焊机将直管与直管、直管与管件连接起来。一般多用于160mm以下管。</p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　2．热熔对接连接：采用专用的对接焊机管道连接起来，一般多用于160mm以上管。</p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　3．钢塑连接：可采用法兰、螺纹丝扣等方法连接。</p><p style=\"margin-top: 5px; margin-bottom: 5px;\"><br></p><p style=\"margin-top: 5px; margin-bottom: 5px;\">大棚灌溉管，PE农田灌溉管管验收：</p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　①接收PE聚乙烯管材、管件须进行验收。先验收产品使用说明书、产品合格证、质量保证书和各项性能检验验收报告等有关资料。</p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　②验收PE聚乙烯管材、管件时，应在同一批中抽样，并按现行国家标准《给水用(PE)聚乙烯材》进行规格尺寸和外观性能检查，必要时宜进行测试。</p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　③农业灌溉聚乙烯管具有重量轻、水流阻力小、耐腐蚀、不易滋生微生物、安装简便迅速、造价低、寿命长、具有保温功能等。</p>', '/uploads/weblist/2021/03/05/1725a2e8c1153283d96befd516dcf59c.jpg', 5);
INSERT INTO `b5net_web_list_ext` VALUES (11, '<p>&nbsp; &nbsp; &nbsp; &nbsp;钢带增强PE螺旋波纹管是指以高密度聚乙烯(PE)为基体，用表面涂敷粘接树脂的钢带成型为波形作为主要支撑结构，并与聚乙烯材料缠绕复合成整体的双壁螺旋波纹管称之为钢带增强PE螺旋波纹管。</p><p><br></p><p>&nbsp; &nbsp; &nbsp; &nbsp;管材可使用热熔挤出焊接连接、热收缩管(带)连接、卡箍（哈夫套）连接和电熔带连接等连接方式。必要时可以结合应用两种连接方式。</p><p><br></p><p style=\"margin-top: 5px; margin-bottom: 5px;\">&nbsp; &nbsp; &nbsp; &nbsp;1、钢带增强PE螺旋波纹管管材管件的内外壁光滑，摩擦系数小。</p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　2、钢带增强PE螺旋波纹管抗压性能高：能承受750N以上压力，故可以明装也可暗敷于混凝土内，不会受压破坏。</p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　3、钢带增强PE螺旋波纹管抗冲、耐热性能好：套管在混凝土浇注过程中，受到正常的捣固冲击不会破裂，且在施工过程中受到凝结热作用不变软。</p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　4、钢带增强PE螺旋波纹管防潮耐酸碱：防潮耐酸碱性能优良，不会锈蚀，各连接处按规定用PVC粘合剂粘接，可防水渗进管内，防潮效果更佳。</p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　5、钢带增强PE螺旋波纹管离火自熄，火焰不会沿着管道蔓延。</p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　6、套管有优良绝缘性能，在浸水状态下AC2000V、50Hz不会击穿。在防止意外触电方面，国际上趋向于绝缘比接地好，而PVC套管正满足这个要求。</p><p style=\"margin-top: 5px; margin-bottom: 5px;\">　　7、因钢带增强PE螺旋波纹管中添加了特种助剂，不会发出气味，吸引虫鼠咬噬破坏。</p><p><span style=\"color: rgb(0, 0, 0); font-family: &quot;Microsoft YaHei&quot;; font-size: 18px; word-spacing: 10px;\"><br></span></p>', '/uploads/weblist/2021/03/05/924bcaa62f33f36c51143b3d8c7de62e.jpg', 5);
INSERT INTO `b5net_web_list_ext` VALUES (12, '<p>地址：XXXXXXXXXXXXXXXXXX</p><p><br></p><p>电话：XXXXXXXXX</p><p><br></p><p>邮箱：357145480@qq.com</p>', '', 3);
INSERT INTO `b5net_web_list_ext` VALUES (13, '<div>安静了月余的校园，再现朗朗读书声。3月1日，临沂市中小学、幼儿园分批、错时错峰，如期开学，让校园重现往日生机。</div><div><br></div><div>“寒假再见，新学期你好。”迎着蒙蒙细雨，“神兽们”背着书包、佩戴口罩、拎着水杯，与家长挥手道别，信步走进久违的校园。“终于盼到开学了！一个假期在家太无聊了。”临沂杏园小学5年级的张同学笑着说，他更喜欢与同学和老师朝夕相处的日子，特别迫切地希望早点见到他们。</div><div><br></div><div>升旗仪式，开学典礼，开学第一课……齐聚校园广场，平邑县地方镇中小学大泉校区进行新学期第一次升旗仪式，师生齐唱国歌，荡气回肠，让校园焕发出新生机；站在2021年的新起点上，兰陵县向城镇中心小学各班级通过PPT课件开启了开学第一课，点燃希望，再次出发，迎接新学期的到来；临沂佳和小学认真组织，上好开学第一课，传达有关疫情防控及学校一日常规要求，学生们认真听讲，展现佳和学子风貌……</div><div><br></div><div>为了迎接“神兽”返校，开学之前，临沂大部分中小学、幼儿园已提前做好准备，将学校、教室装扮一新。窗明几净的教室，摆放有序的桌子，静等“神兽们”的归来。临沂沂龙湾小学门口，红色的拱形门上写着，“开学啦，属我最牛！”还有教职工穿着玩偶装扮，特意迎接“神兽”返校。</div><div><br></div><div>如何帮助学生快速实现假期模式与学校模式的转换呢？临沂市第三中学于3月1日上午面向学生开展心理健康第一课。课堂上，心理老师鼓励学生复盘假期，畅谈开学后的心情与感受，引导学生平稳度过适应期，帮助学生提升情绪管理的能力，以更饱满、更高效的状态投入到学习中。</div><div><br></div><div>“神兽”返校离不开大家的守护，交警部门疏导交通，确保交通秩序井然，让学生安全返校。各学校的家长志愿者也成为开学首日一道亮丽的风景线，临沂第三实验小学的家长志愿们身穿荧光色马甲，早早出现在学校门口，随时准备提供帮助，助力学生返校。</div><div><br></div><div>根据疫情防控的相关要求，开学后，各学校要全面把控所有进出校园通道，实行校园相对封闭管理，做到专人负责、区域划分合理、人员登记排查记录齐全。工作人员和来访人员佩戴口罩,对进出人员监测体温。坚持入校登记制度，校外无关人员一律不准进校，师生员工进校门需核验身份并监测体温。入校时若出现发热、干咳、咽痛、嗅（味）觉减退、腹泻等疑似症状，应当由专人带至临时等候区，测量体温，及时联系学生家长，按规定流程处置。</div>', '/uploads/weblist/2021/03/05/70db3bb4799fcce6ed970d773ba44d49.jpg', 12);
INSERT INTO `b5net_web_list_ext` VALUES (14, '<div>近日，山东省临沂市沂南县铜井镇竹泉村的村民在民俗活动中表演舞狮。</div><div><br></div><div>春节期间，人们用丰富多彩的方式度过假期。&nbsp;</div>', '/uploads/weblist/2021/03/05/0fa247d4c6b7724d2b4a09da59b169a3.jpg', 12);

-- ----------------------------
-- Table structure for b5net_web_pos
-- ----------------------------
DROP TABLE IF EXISTS `b5net_web_pos`;
CREATE TABLE `b5net_web_pos`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '位置名称',
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '备注',
  `width` mediumint(0) NOT NULL DEFAULT 0 COMMENT '图片宽度',
  `height` mediumint(0) NOT NULL DEFAULT 0 COMMENT '图片高度',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '推荐位置表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of b5net_web_pos
-- ----------------------------
INSERT INTO `b5net_web_pos` VALUES (1, '首页顶部banner图', '宽度高度为1920*500像素', 1920, 500, '2021-03-18 10:44:53', '2021-03-18 10:45:16');

-- ----------------------------
-- Table structure for b5net_wechat_access
-- ----------------------------
DROP TABLE IF EXISTS `b5net_wechat_access`;
CREATE TABLE `b5net_wechat_access`  (
  `appid` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `access_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `jsapi_ticket` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `access_token_add` int(0) NOT NULL DEFAULT 0,
  `jsapi_ticket_add` int(0) NOT NULL DEFAULT 0,
  PRIMARY KEY (`appid`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '微信jsapi和access' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for b5net_wechat_users
-- ----------------------------
DROP TABLE IF EXISTS `b5net_wechat_users`;
CREATE TABLE `b5net_wechat_users`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `openid` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '唯一标识',
  `appid` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '公众号参数',
  `nickname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '昵称',
  `headimg` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '头像地址',
  `type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '所属活动',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '资料更新时间',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '添加时间',
  `sex` tinyint(1) NOT NULL DEFAULT 0 COMMENT '性别',
  `city` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '城市',
  `country` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '国家',
  `province` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '省份',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `openid`(`openid`, `appid`, `type`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '微信用户信息表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of b5net_wechat_users
-- ----------------------------
INSERT INTO `b5net_wechat_users` VALUES (1, 'oHwQ-52n1phwDERwoeTWlio_vooE', 'wx2dbcd1ebf29bd18f', '李先生', 'https://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83eqBURUj29IqEIsiakaJV6icmctgf8gSWibLNMUsGpUmNPGR1T6W0jYicYcelq4e1lEnwMKUvMQSvVTYCQ/132', 'scratch_1', '2021-03-28 10:45:05', '2021-03-28 10:45:05', 1, '临沂', '中国', '山东', 1);

SET FOREIGN_KEY_CHECKS = 1;
