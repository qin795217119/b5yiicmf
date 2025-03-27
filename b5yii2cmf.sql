/*
 Navicat Premium Data Transfer

 Source Server         : 本地mysql
 Source Server Type    : MySQL
 Source Server Version : 80028
 Source Host           : localhost:3306
 Source Schema         : b5yii2cmf

 Target Server Type    : MySQL
 Target Server Version : 80028
 File Encoding         : 65001

 Date: 12/03/2024 17:10:45
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for b5net_admin
-- ----------------------------
DROP TABLE IF EXISTS `b5net_admin`;
CREATE TABLE `b5net_admin`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '登录名',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '登录密码',
  `realname` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '人员姓名',
  `status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1' COMMENT '状态',
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '备注',
  `create_time` datetime NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `username`(`username`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10009 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '管理员表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of b5net_admin
-- ----------------------------
INSERT INTO `b5net_admin` VALUES (10000, 'admin', 'e10adc3949ba59abbe56e057f20f883e', '超管', '1', '超级管理员', '2020-12-24 10:50:56', '2022-04-21 11:31:02');
INSERT INTO `b5net_admin` VALUES (10008, 'test1', 'e10adc3949ba59abbe56e057f20f883e', 'test1', '1', '', '2022-03-21 15:27:03', '2022-03-21 15:27:03');

-- ----------------------------
-- Table structure for b5net_admin_pos
-- ----------------------------
DROP TABLE IF EXISTS `b5net_admin_pos`;
CREATE TABLE `b5net_admin_pos`  (
  `admin_id` int NOT NULL COMMENT '用户ID',
  `pos_id` int NOT NULL COMMENT '职位ID',
  UNIQUE INDEX `admin_id`(`admin_id`, `pos_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '用户和职位关联表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of b5net_admin_pos
-- ----------------------------
INSERT INTO `b5net_admin_pos` VALUES (10000, 1);
INSERT INTO `b5net_admin_pos` VALUES (10008, 3);

-- ----------------------------
-- Table structure for b5net_admin_role
-- ----------------------------
DROP TABLE IF EXISTS `b5net_admin_role`;
CREATE TABLE `b5net_admin_role`  (
  `admin_id` int NOT NULL COMMENT '用户ID',
  `role_id` int NOT NULL COMMENT '角色ID',
  UNIQUE INDEX `admin_id`(`admin_id`, `role_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '用户和角色关联表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of b5net_admin_role
-- ----------------------------
INSERT INTO `b5net_admin_role` VALUES (10000, 1);
INSERT INTO `b5net_admin_role` VALUES (10008, 3);

-- ----------------------------
-- Table structure for b5net_admin_struct
-- ----------------------------
DROP TABLE IF EXISTS `b5net_admin_struct`;
CREATE TABLE `b5net_admin_struct`  (
  `admin_id` int NOT NULL COMMENT '用户ID',
  `struct_id` int NOT NULL COMMENT '组织ID'
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '用户与组织架构关联表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of b5net_admin_struct
-- ----------------------------
INSERT INTO `b5net_admin_struct` VALUES (10000, 100);
INSERT INTO `b5net_admin_struct` VALUES (10008, 103);

-- ----------------------------
-- Table structure for b5net_app_token
-- ----------------------------
DROP TABLE IF EXISTS `b5net_app_token`;
CREATE TABLE `b5net_app_token`  (
  `token` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '用户类型',
  `plat` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '平台类型',
  `user_id` int NOT NULL DEFAULT 0 COMMENT '用户ID',
  `extend` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '额外信息',
  `exp_time` int NOT NULL DEFAULT 0 COMMENT '过期时间',
  PRIMARY KEY (`token`) USING BTREE,
  UNIQUE INDEX `token`(`token`) USING BTREE,
  UNIQUE INDEX `type`(`type`, `user_id`, `plat`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of b5net_app_token
-- ----------------------------
INSERT INTO `b5net_app_token` VALUES ('bdca98d484dca4f9efa684ec256f197b', 'admin', 'web', 10000, '', 1684401747);
INSERT INTO `b5net_app_token` VALUES ('eb5a1e900eb052c06ad251d00f2a1d04', 'app', '', 112, '', 1651123493);

-- ----------------------------
-- Table structure for b5net_area
-- ----------------------------
DROP TABLE IF EXISTS `b5net_area`;
CREATE TABLE `b5net_area`  (
  `id` mediumint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '',
  `code` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `p_code` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `level` tinyint(1) NOT NULL DEFAULT 0,
  `status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1',
  `list_sort` int NOT NULL DEFAULT 10,
  `create_time` datetime NULL DEFAULT NULL,
  `update_time` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `code`(`code`) USING BTREE,
  INDEX `pcode`(`p_code`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3373 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '省市区表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of b5net_area
-- ----------------------------
INSERT INTO `b5net_area` VALUES (1, '北京市', '11', '0', 1, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2, '天津市', '12', '0', 1, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3, '河北省', '13', '0', 1, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (4, '山西省', '14', '0', 1, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (5, '内蒙古自治区', '15', '0', 1, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (6, '辽宁省', '21', '0', 1, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (7, '吉林省', '22', '0', 1, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (8, '黑龙江省', '23', '0', 1, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (9, '上海市', '31', '0', 1, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (10, '江苏省', '32', '0', 1, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (11, '浙江省', '33', '0', 1, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (12, '安徽省', '34', '0', 1, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (13, '福建省', '35', '0', 1, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (14, '江西省', '36', '0', 1, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (15, '山东省', '37', '0', 1, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (16, '河南省', '41', '0', 1, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (17, '湖北省', '42', '0', 1, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (18, '湖南省', '43', '0', 1, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (19, '广东省', '44', '0', 1, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (20, '广西壮族自治区', '45', '0', 1, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (21, '海南省', '46', '0', 1, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (22, '重庆市', '50', '0', 1, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (23, '四川省', '51', '0', 1, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (24, '贵州省', '52', '0', 1, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (25, '云南省', '53', '0', 1, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (26, '西藏自治区', '54', '0', 1, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (27, '陕西省', '61', '0', 1, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (28, '甘肃省', '62', '0', 1, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (29, '青海省', '63', '0', 1, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (30, '宁夏回族自治区', '64', '0', 1, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (31, '新疆维吾尔自治区', '65', '0', 1, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (32, '市辖区', '1101', '11', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (33, '市辖区', '1201', '12', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (34, '石家庄市', '1301', '13', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (35, '唐山市', '1302', '13', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (36, '秦皇岛市', '1303', '13', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (37, '邯郸市', '1304', '13', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (38, '邢台市', '1305', '13', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (39, '保定市', '1306', '13', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (40, '张家口市', '1307', '13', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (41, '承德市', '1308', '13', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (42, '沧州市', '1309', '13', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (43, '廊坊市', '1310', '13', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (44, '衡水市', '1311', '13', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (45, '太原市', '1401', '14', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (46, '大同市', '1402', '14', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (47, '阳泉市', '1403', '14', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (48, '长治市', '1404', '14', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (49, '晋城市', '1405', '14', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (50, '朔州市', '1406', '14', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (51, '晋中市', '1407', '14', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (52, '运城市', '1408', '14', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (53, '忻州市', '1409', '14', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (54, '临汾市', '1410', '14', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (55, '吕梁市', '1411', '14', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (56, '呼和浩特市', '1501', '15', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (57, '包头市', '1502', '15', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (58, '乌海市', '1503', '15', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (59, '赤峰市', '1504', '15', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (60, '通辽市', '1505', '15', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (61, '鄂尔多斯市', '1506', '15', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (62, '呼伦贝尔市', '1507', '15', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (63, '巴彦淖尔市', '1508', '15', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (64, '乌兰察布市', '1509', '15', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (65, '兴安盟', '1522', '15', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (66, '锡林郭勒盟', '1525', '15', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (67, '阿拉善盟', '1529', '15', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (68, '沈阳市', '2101', '21', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (69, '大连市', '2102', '21', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (70, '鞍山市', '2103', '21', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (71, '抚顺市', '2104', '21', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (72, '本溪市', '2105', '21', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (73, '丹东市', '2106', '21', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (74, '锦州市', '2107', '21', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (75, '营口市', '2108', '21', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (76, '阜新市', '2109', '21', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (77, '辽阳市', '2110', '21', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (78, '盘锦市', '2111', '21', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (79, '铁岭市', '2112', '21', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (80, '朝阳市', '2113', '21', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (81, '葫芦岛市', '2114', '21', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (82, '长春市', '2201', '22', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (83, '吉林市', '2202', '22', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (84, '四平市', '2203', '22', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (85, '辽源市', '2204', '22', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (86, '通化市', '2205', '22', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (87, '白山市', '2206', '22', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (88, '松原市', '2207', '22', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (89, '白城市', '2208', '22', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (90, '延边朝鲜族自治州', '2224', '22', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (91, '哈尔滨市', '2301', '23', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (92, '齐齐哈尔市', '2302', '23', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (93, '鸡西市', '2303', '23', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (94, '鹤岗市', '2304', '23', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (95, '双鸭山市', '2305', '23', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (96, '大庆市', '2306', '23', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (97, '伊春市', '2307', '23', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (98, '佳木斯市', '2308', '23', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (99, '七台河市', '2309', '23', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (100, '牡丹江市', '2310', '23', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (101, '黑河市', '2311', '23', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (102, '绥化市', '2312', '23', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (103, '大兴安岭地区', '2327', '23', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (104, '市辖区', '3101', '31', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (105, '南京市', '3201', '32', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (106, '无锡市', '3202', '32', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (107, '徐州市', '3203', '32', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (108, '常州市', '3204', '32', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (109, '苏州市', '3205', '32', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (110, '南通市', '3206', '32', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (111, '连云港市', '3207', '32', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (112, '淮安市', '3208', '32', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (113, '盐城市', '3209', '32', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (114, '扬州市', '3210', '32', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (115, '镇江市', '3211', '32', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (116, '泰州市', '3212', '32', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (117, '宿迁市', '3213', '32', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (118, '杭州市', '3301', '33', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (119, '宁波市', '3302', '33', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (120, '温州市', '3303', '33', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (121, '嘉兴市', '3304', '33', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (122, '湖州市', '3305', '33', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (123, '绍兴市', '3306', '33', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (124, '金华市', '3307', '33', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (125, '衢州市', '3308', '33', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (126, '舟山市', '3309', '33', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (127, '台州市', '3310', '33', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (128, '丽水市', '3311', '33', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (129, '合肥市', '3401', '34', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (130, '芜湖市', '3402', '34', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (131, '蚌埠市', '3403', '34', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (132, '淮南市', '3404', '34', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (133, '马鞍山市', '3405', '34', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (134, '淮北市', '3406', '34', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (135, '铜陵市', '3407', '34', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (136, '安庆市', '3408', '34', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (137, '黄山市', '3410', '34', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (138, '滁州市', '3411', '34', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (139, '阜阳市', '3412', '34', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (140, '宿州市', '3413', '34', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (141, '六安市', '3415', '34', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (142, '亳州市', '3416', '34', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (143, '池州市', '3417', '34', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (144, '宣城市', '3418', '34', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (145, '福州市', '3501', '35', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (146, '厦门市', '3502', '35', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (147, '莆田市', '3503', '35', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (148, '三明市', '3504', '35', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (149, '泉州市', '3505', '35', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (150, '漳州市', '3506', '35', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (151, '南平市', '3507', '35', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (152, '龙岩市', '3508', '35', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (153, '宁德市', '3509', '35', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (154, '南昌市', '3601', '36', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (155, '景德镇市', '3602', '36', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (156, '萍乡市', '3603', '36', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (157, '九江市', '3604', '36', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (158, '新余市', '3605', '36', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (159, '鹰潭市', '3606', '36', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (160, '赣州市', '3607', '36', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (161, '吉安市', '3608', '36', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (162, '宜春市', '3609', '36', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (163, '抚州市', '3610', '36', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (164, '上饶市', '3611', '36', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (165, '济南市', '3701', '37', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (166, '青岛市', '3702', '37', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (167, '淄博市', '3703', '37', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (168, '枣庄市', '3704', '37', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (169, '东营市', '3705', '37', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (170, '烟台市', '3706', '37', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (171, '潍坊市', '3707', '37', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (172, '济宁市', '3708', '37', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (173, '泰安市', '3709', '37', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (174, '威海市', '3710', '37', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (175, '日照市', '3711', '37', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (176, '临沂市', '3713', '37', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (177, '德州市', '3714', '37', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (178, '聊城市', '3715', '37', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (179, '滨州市', '3716', '37', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (180, '菏泽市', '3717', '37', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (181, '郑州市', '4101', '41', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (182, '开封市', '4102', '41', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (183, '洛阳市', '4103', '41', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (184, '平顶山市', '4104', '41', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (185, '安阳市', '4105', '41', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (186, '鹤壁市', '4106', '41', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (187, '新乡市', '4107', '41', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (188, '焦作市', '4108', '41', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (189, '濮阳市', '4109', '41', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (190, '许昌市', '4110', '41', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (191, '漯河市', '4111', '41', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (192, '三门峡市', '4112', '41', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (193, '南阳市', '4113', '41', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (194, '商丘市', '4114', '41', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (195, '信阳市', '4115', '41', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (196, '周口市', '4116', '41', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (197, '驻马店市', '4117', '41', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (198, '省直辖县级行政区划', '4190', '41', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (199, '武汉市', '4201', '42', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (200, '黄石市', '4202', '42', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (201, '十堰市', '4203', '42', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (202, '宜昌市', '4205', '42', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (203, '襄阳市', '4206', '42', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (204, '鄂州市', '4207', '42', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (205, '荆门市', '4208', '42', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (206, '孝感市', '4209', '42', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (207, '荆州市', '4210', '42', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (208, '黄冈市', '4211', '42', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (209, '咸宁市', '4212', '42', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (210, '随州市', '4213', '42', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (211, '恩施土家族苗族自治州', '4228', '42', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (212, '省直辖县级行政区划', '4290', '42', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (213, '长沙市', '4301', '43', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (214, '株洲市', '4302', '43', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (215, '湘潭市', '4303', '43', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (216, '衡阳市', '4304', '43', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (217, '邵阳市', '4305', '43', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (218, '岳阳市', '4306', '43', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (219, '常德市', '4307', '43', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (220, '张家界市', '4308', '43', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (221, '益阳市', '4309', '43', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (222, '郴州市', '4310', '43', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (223, '永州市', '4311', '43', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (224, '怀化市', '4312', '43', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (225, '娄底市', '4313', '43', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (226, '湘西土家族苗族自治州', '4331', '43', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (227, '广州市', '4401', '44', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (228, '韶关市', '4402', '44', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (229, '深圳市', '4403', '44', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (230, '珠海市', '4404', '44', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (231, '汕头市', '4405', '44', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (232, '佛山市', '4406', '44', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (233, '江门市', '4407', '44', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (234, '湛江市', '4408', '44', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (235, '茂名市', '4409', '44', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (236, '肇庆市', '4412', '44', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (237, '惠州市', '4413', '44', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (238, '梅州市', '4414', '44', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (239, '汕尾市', '4415', '44', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (240, '河源市', '4416', '44', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (241, '阳江市', '4417', '44', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (242, '清远市', '4418', '44', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (243, '东莞市', '4419', '44', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (244, '中山市', '4420', '44', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (245, '潮州市', '4451', '44', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (246, '揭阳市', '4452', '44', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (247, '云浮市', '4453', '44', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (248, '南宁市', '4501', '45', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (249, '柳州市', '4502', '45', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (250, '桂林市', '4503', '45', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (251, '梧州市', '4504', '45', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (252, '北海市', '4505', '45', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (253, '防城港市', '4506', '45', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (254, '钦州市', '4507', '45', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (255, '贵港市', '4508', '45', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (256, '玉林市', '4509', '45', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (257, '百色市', '4510', '45', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (258, '贺州市', '4511', '45', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (259, '河池市', '4512', '45', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (260, '来宾市', '4513', '45', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (261, '崇左市', '4514', '45', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (262, '海口市', '4601', '46', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (263, '三亚市', '4602', '46', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (264, '三沙市', '4603', '46', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (265, '儋州市', '4604', '46', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (266, '省直辖县级行政区划', '4690', '46', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (267, '市辖区', '5001', '50', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (268, '县', '5002', '50', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (269, '成都市', '5101', '51', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (270, '自贡市', '5103', '51', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (271, '攀枝花市', '5104', '51', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (272, '泸州市', '5105', '51', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (273, '德阳市', '5106', '51', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (274, '绵阳市', '5107', '51', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (275, '广元市', '5108', '51', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (276, '遂宁市', '5109', '51', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (277, '内江市', '5110', '51', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (278, '乐山市', '5111', '51', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (279, '南充市', '5113', '51', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (280, '眉山市', '5114', '51', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (281, '宜宾市', '5115', '51', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (282, '广安市', '5116', '51', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (283, '达州市', '5117', '51', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (284, '雅安市', '5118', '51', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (285, '巴中市', '5119', '51', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (286, '资阳市', '5120', '51', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (287, '阿坝藏族羌族自治州', '5132', '51', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (288, '甘孜藏族自治州', '5133', '51', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (289, '凉山彝族自治州', '5134', '51', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (290, '贵阳市', '5201', '52', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (291, '六盘水市', '5202', '52', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (292, '遵义市', '5203', '52', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (293, '安顺市', '5204', '52', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (294, '毕节市', '5205', '52', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (295, '铜仁市', '5206', '52', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (296, '黔西南布依族苗族自治州', '5223', '52', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (297, '黔东南苗族侗族自治州', '5226', '52', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (298, '黔南布依族苗族自治州', '5227', '52', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (299, '昆明市', '5301', '53', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (300, '曲靖市', '5303', '53', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (301, '玉溪市', '5304', '53', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (302, '保山市', '5305', '53', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (303, '昭通市', '5306', '53', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (304, '丽江市', '5307', '53', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (305, '普洱市', '5308', '53', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (306, '临沧市', '5309', '53', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (307, '楚雄彝族自治州', '5323', '53', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (308, '红河哈尼族彝族自治州', '5325', '53', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (309, '文山壮族苗族自治州', '5326', '53', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (310, '西双版纳傣族自治州', '5328', '53', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (311, '大理白族自治州', '5329', '53', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (312, '德宏傣族景颇族自治州', '5331', '53', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (313, '怒江傈僳族自治州', '5333', '53', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (314, '迪庆藏族自治州', '5334', '53', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (315, '拉萨市', '5401', '54', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (316, '日喀则市', '5402', '54', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (317, '昌都市', '5403', '54', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (318, '林芝市', '5404', '54', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (319, '山南市', '5405', '54', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (320, '那曲市', '5406', '54', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (321, '阿里地区', '5425', '54', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (322, '西安市', '6101', '61', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (323, '铜川市', '6102', '61', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (324, '宝鸡市', '6103', '61', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (325, '咸阳市', '6104', '61', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (326, '渭南市', '6105', '61', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (327, '延安市', '6106', '61', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (328, '汉中市', '6107', '61', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (329, '榆林市', '6108', '61', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (330, '安康市', '6109', '61', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (331, '商洛市', '6110', '61', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (332, '兰州市', '6201', '62', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (333, '嘉峪关市', '6202', '62', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (334, '金昌市', '6203', '62', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (335, '白银市', '6204', '62', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (336, '天水市', '6205', '62', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (337, '武威市', '6206', '62', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (338, '张掖市', '6207', '62', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (339, '平凉市', '6208', '62', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (340, '酒泉市', '6209', '62', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (341, '庆阳市', '6210', '62', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (342, '定西市', '6211', '62', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (343, '陇南市', '6212', '62', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (344, '临夏回族自治州', '6229', '62', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (345, '甘南藏族自治州', '6230', '62', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (346, '西宁市', '6301', '63', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (347, '海东市', '6302', '63', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (348, '海北藏族自治州', '6322', '63', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (349, '黄南藏族自治州', '6323', '63', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (350, '海南藏族自治州', '6325', '63', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (351, '果洛藏族自治州', '6326', '63', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (352, '玉树藏族自治州', '6327', '63', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (353, '海西蒙古族藏族自治州', '6328', '63', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (354, '银川市', '6401', '64', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (355, '石嘴山市', '6402', '64', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (356, '吴忠市', '6403', '64', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (357, '固原市', '6404', '64', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (358, '中卫市', '6405', '64', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (359, '乌鲁木齐市', '6501', '65', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (360, '克拉玛依市', '6502', '65', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (361, '吐鲁番市', '6504', '65', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (362, '哈密市', '6505', '65', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (363, '昌吉回族自治州', '6523', '65', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (364, '博尔塔拉蒙古自治州', '6527', '65', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (365, '巴音郭楞蒙古自治州', '6528', '65', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (366, '阿克苏地区', '6529', '65', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (367, '克孜勒苏柯尔克孜自治州', '6530', '65', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (368, '喀什地区', '6531', '65', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (369, '和田地区', '6532', '65', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (370, '伊犁哈萨克自治州', '6540', '65', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (371, '塔城地区', '6542', '65', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (372, '阿勒泰地区', '6543', '65', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (373, '自治区直辖县级行政区划', '6590', '65', 2, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (374, '东城区', '110101', '1101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (375, '西城区', '110102', '1101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (376, '朝阳区', '110105', '1101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (377, '丰台区', '110106', '1101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (378, '石景山区', '110107', '1101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (379, '海淀区', '110108', '1101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (380, '门头沟区', '110109', '1101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (381, '房山区', '110111', '1101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (382, '通州区', '110112', '1101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (383, '顺义区', '110113', '1101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (384, '昌平区', '110114', '1101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (385, '大兴区', '110115', '1101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (386, '怀柔区', '110116', '1101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (387, '平谷区', '110117', '1101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (388, '密云区', '110118', '1101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (389, '延庆区', '110119', '1101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (390, '和平区', '120101', '1201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (391, '河东区', '120102', '1201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (392, '河西区', '120103', '1201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (393, '南开区', '120104', '1201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (394, '河北区', '120105', '1201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (395, '红桥区', '120106', '1201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (396, '东丽区', '120110', '1201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (397, '西青区', '120111', '1201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (398, '津南区', '120112', '1201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (399, '北辰区', '120113', '1201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (400, '武清区', '120114', '1201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (401, '宝坻区', '120115', '1201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (402, '滨海新区', '120116', '1201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (403, '宁河区', '120117', '1201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (404, '静海区', '120118', '1201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (405, '蓟州区', '120119', '1201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (406, '长安区', '130102', '1301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (407, '桥西区', '130104', '1301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (408, '新华区', '130105', '1301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (409, '井陉矿区', '130107', '1301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (410, '裕华区', '130108', '1301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (411, '藁城区', '130109', '1301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (412, '鹿泉区', '130110', '1301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (413, '栾城区', '130111', '1301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (414, '井陉县', '130121', '1301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (415, '正定县', '130123', '1301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (416, '行唐县', '130125', '1301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (417, '灵寿县', '130126', '1301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (418, '高邑县', '130127', '1301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (419, '深泽县', '130128', '1301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (420, '赞皇县', '130129', '1301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (421, '无极县', '130130', '1301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (422, '平山县', '130131', '1301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (423, '元氏县', '130132', '1301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (424, '赵县', '130133', '1301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (425, '石家庄高新技术产业开发区', '130171', '1301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (426, '石家庄循环化工园区', '130172', '1301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (427, '辛集市', '130181', '1301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (428, '晋州市', '130183', '1301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (429, '新乐市', '130184', '1301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (430, '路南区', '130202', '1302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (431, '路北区', '130203', '1302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (432, '古冶区', '130204', '1302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (433, '开平区', '130205', '1302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (434, '丰南区', '130207', '1302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (435, '丰润区', '130208', '1302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (436, '曹妃甸区', '130209', '1302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (437, '滦南县', '130224', '1302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (438, '乐亭县', '130225', '1302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (439, '迁西县', '130227', '1302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (440, '玉田县', '130229', '1302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (441, '河北唐山芦台经济开发区', '130271', '1302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (442, '唐山市汉沽管理区', '130272', '1302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (443, '唐山高新技术产业开发区', '130273', '1302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (444, '河北唐山海港经济开发区', '130274', '1302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (445, '遵化市', '130281', '1302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (446, '迁安市', '130283', '1302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (447, '滦州市', '130284', '1302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (448, '海港区', '130302', '1303', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (449, '山海关区', '130303', '1303', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (450, '北戴河区', '130304', '1303', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (451, '抚宁区', '130306', '1303', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (452, '青龙满族自治县', '130321', '1303', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (453, '昌黎县', '130322', '1303', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (454, '卢龙县', '130324', '1303', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (455, '秦皇岛市经济技术开发区', '130371', '1303', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (456, '北戴河新区', '130372', '1303', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (457, '邯山区', '130402', '1304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (458, '丛台区', '130403', '1304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (459, '复兴区', '130404', '1304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (460, '峰峰矿区', '130406', '1304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (461, '肥乡区', '130407', '1304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (462, '永年区', '130408', '1304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (463, '临漳县', '130423', '1304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (464, '成安县', '130424', '1304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (465, '大名县', '130425', '1304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (466, '涉县', '130426', '1304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (467, '磁县', '130427', '1304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (468, '邱县', '130430', '1304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (469, '鸡泽县', '130431', '1304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (470, '广平县', '130432', '1304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (471, '馆陶县', '130433', '1304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (472, '魏县', '130434', '1304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (473, '曲周县', '130435', '1304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (474, '邯郸经济技术开发区', '130471', '1304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (475, '邯郸冀南新区', '130473', '1304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (476, '武安市', '130481', '1304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (477, '桥东区', '130502', '1305', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (478, '桥西区', '130503', '1305', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (479, '邢台县', '130521', '1305', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (480, '临城县', '130522', '1305', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (481, '内丘县', '130523', '1305', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (482, '柏乡县', '130524', '1305', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (483, '隆尧县', '130525', '1305', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (484, '任县', '130526', '1305', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (485, '南和县', '130527', '1305', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (486, '宁晋县', '130528', '1305', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (487, '巨鹿县', '130529', '1305', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (488, '新河县', '130530', '1305', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (489, '广宗县', '130531', '1305', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (490, '平乡县', '130532', '1305', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (491, '威县', '130533', '1305', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (492, '清河县', '130534', '1305', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (493, '临西县', '130535', '1305', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (494, '河北邢台经济开发区', '130571', '1305', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (495, '南宫市', '130581', '1305', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (496, '沙河市', '130582', '1305', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (497, '竞秀区', '130602', '1306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (498, '莲池区', '130606', '1306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (499, '满城区', '130607', '1306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (500, '清苑区', '130608', '1306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (501, '徐水区', '130609', '1306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (502, '涞水县', '130623', '1306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (503, '阜平县', '130624', '1306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (504, '定兴县', '130626', '1306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (505, '唐县', '130627', '1306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (506, '高阳县', '130628', '1306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (507, '容城县', '130629', '1306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (508, '涞源县', '130630', '1306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (509, '望都县', '130631', '1306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (510, '安新县', '130632', '1306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (511, '易县', '130633', '1306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (512, '曲阳县', '130634', '1306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (513, '蠡县', '130635', '1306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (514, '顺平县', '130636', '1306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (515, '博野县', '130637', '1306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (516, '雄县', '130638', '1306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (517, '保定高新技术产业开发区', '130671', '1306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (518, '保定白沟新城', '130672', '1306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (519, '涿州市', '130681', '1306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (520, '定州市', '130682', '1306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (521, '安国市', '130683', '1306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (522, '高碑店市', '130684', '1306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (523, '桥东区', '130702', '1307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (524, '桥西区', '130703', '1307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (525, '宣化区', '130705', '1307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (526, '下花园区', '130706', '1307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (527, '万全区', '130708', '1307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (528, '崇礼区', '130709', '1307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (529, '张北县', '130722', '1307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (530, '康保县', '130723', '1307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (531, '沽源县', '130724', '1307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (532, '尚义县', '130725', '1307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (533, '蔚县', '130726', '1307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (534, '阳原县', '130727', '1307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (535, '怀安县', '130728', '1307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (536, '怀来县', '130730', '1307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (537, '涿鹿县', '130731', '1307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (538, '赤城县', '130732', '1307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (539, '张家口经济开发区', '130771', '1307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (540, '张家口市察北管理区', '130772', '1307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (541, '张家口市塞北管理区', '130773', '1307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (542, '双桥区', '130802', '1308', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (543, '双滦区', '130803', '1308', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (544, '鹰手营子矿区', '130804', '1308', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (545, '承德县', '130821', '1308', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (546, '兴隆县', '130822', '1308', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (547, '滦平县', '130824', '1308', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (548, '隆化县', '130825', '1308', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (549, '丰宁满族自治县', '130826', '1308', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (550, '宽城满族自治县', '130827', '1308', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (551, '围场满族蒙古族自治县', '130828', '1308', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (552, '承德高新技术产业开发区', '130871', '1308', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (553, '平泉市', '130881', '1308', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (554, '新华区', '130902', '1309', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (555, '运河区', '130903', '1309', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (556, '沧县', '130921', '1309', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (557, '青县', '130922', '1309', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (558, '东光县', '130923', '1309', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (559, '海兴县', '130924', '1309', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (560, '盐山县', '130925', '1309', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (561, '肃宁县', '130926', '1309', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (562, '南皮县', '130927', '1309', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (563, '吴桥县', '130928', '1309', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (564, '献县', '130929', '1309', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (565, '孟村回族自治县', '130930', '1309', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (566, '河北沧州经济开发区', '130971', '1309', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (567, '沧州高新技术产业开发区', '130972', '1309', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (568, '沧州渤海新区', '130973', '1309', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (569, '泊头市', '130981', '1309', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (570, '任丘市', '130982', '1309', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (571, '黄骅市', '130983', '1309', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (572, '河间市', '130984', '1309', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (573, '安次区', '131002', '1310', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (574, '广阳区', '131003', '1310', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (575, '固安县', '131022', '1310', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (576, '永清县', '131023', '1310', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (577, '香河县', '131024', '1310', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (578, '大城县', '131025', '1310', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (579, '文安县', '131026', '1310', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (580, '大厂回族自治县', '131028', '1310', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (581, '廊坊经济技术开发区', '131071', '1310', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (582, '霸州市', '131081', '1310', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (583, '三河市', '131082', '1310', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (584, '桃城区', '131102', '1311', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (585, '冀州区', '131103', '1311', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (586, '枣强县', '131121', '1311', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (587, '武邑县', '131122', '1311', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (588, '武强县', '131123', '1311', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (589, '饶阳县', '131124', '1311', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (590, '安平县', '131125', '1311', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (591, '故城县', '131126', '1311', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (592, '景县', '131127', '1311', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (593, '阜城县', '131128', '1311', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (594, '河北衡水高新技术产业开发区', '131171', '1311', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (595, '衡水滨湖新区', '131172', '1311', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (596, '深州市', '131182', '1311', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (597, '小店区', '140105', '1401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (598, '迎泽区', '140106', '1401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (599, '杏花岭区', '140107', '1401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (600, '尖草坪区', '140108', '1401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (601, '万柏林区', '140109', '1401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (602, '晋源区', '140110', '1401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (603, '清徐县', '140121', '1401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (604, '阳曲县', '140122', '1401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (605, '娄烦县', '140123', '1401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (606, '山西转型综合改革示范区', '140171', '1401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (607, '古交市', '140181', '1401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (608, '新荣区', '140212', '1402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (609, '平城区', '140213', '1402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (610, '云冈区', '140214', '1402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (611, '云州区', '140215', '1402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (612, '阳高县', '140221', '1402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (613, '天镇县', '140222', '1402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (614, '广灵县', '140223', '1402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (615, '灵丘县', '140224', '1402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (616, '浑源县', '140225', '1402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (617, '左云县', '140226', '1402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (618, '山西大同经济开发区', '140271', '1402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (619, '城区', '140302', '1403', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (620, '矿区', '140303', '1403', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (621, '郊区', '140311', '1403', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (622, '平定县', '140321', '1403', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (623, '盂县', '140322', '1403', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (624, '潞州区', '140403', '1404', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (625, '上党区', '140404', '1404', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (626, '屯留区', '140405', '1404', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (627, '潞城区', '140406', '1404', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (628, '襄垣县', '140423', '1404', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (629, '平顺县', '140425', '1404', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (630, '黎城县', '140426', '1404', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (631, '壶关县', '140427', '1404', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (632, '长子县', '140428', '1404', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (633, '武乡县', '140429', '1404', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (634, '沁县', '140430', '1404', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (635, '沁源县', '140431', '1404', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (636, '山西长治高新技术产业园区', '140471', '1404', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (637, '城区', '140502', '1405', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (638, '沁水县', '140521', '1405', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (639, '阳城县', '140522', '1405', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (640, '陵川县', '140524', '1405', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (641, '泽州县', '140525', '1405', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (642, '高平市', '140581', '1405', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (643, '朔城区', '140602', '1406', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (644, '平鲁区', '140603', '1406', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (645, '山阴县', '140621', '1406', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (646, '应县', '140622', '1406', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (647, '右玉县', '140623', '1406', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (648, '山西朔州经济开发区', '140671', '1406', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (649, '怀仁市', '140681', '1406', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (650, '榆次区', '140702', '1407', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (651, '榆社县', '140721', '1407', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (652, '左权县', '140722', '1407', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (653, '和顺县', '140723', '1407', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (654, '昔阳县', '140724', '1407', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (655, '寿阳县', '140725', '1407', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (656, '太谷县', '140726', '1407', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (657, '祁县', '140727', '1407', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (658, '平遥县', '140728', '1407', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (659, '灵石县', '140729', '1407', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (660, '介休市', '140781', '1407', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (661, '盐湖区', '140802', '1408', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (662, '临猗县', '140821', '1408', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (663, '万荣县', '140822', '1408', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (664, '闻喜县', '140823', '1408', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (665, '稷山县', '140824', '1408', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (666, '新绛县', '140825', '1408', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (667, '绛县', '140826', '1408', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (668, '垣曲县', '140827', '1408', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (669, '夏县', '140828', '1408', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (670, '平陆县', '140829', '1408', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (671, '芮城县', '140830', '1408', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (672, '永济市', '140881', '1408', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (673, '河津市', '140882', '1408', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (674, '忻府区', '140902', '1409', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (675, '定襄县', '140921', '1409', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (676, '五台县', '140922', '1409', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (677, '代县', '140923', '1409', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (678, '繁峙县', '140924', '1409', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (679, '宁武县', '140925', '1409', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (680, '静乐县', '140926', '1409', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (681, '神池县', '140927', '1409', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (682, '五寨县', '140928', '1409', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (683, '岢岚县', '140929', '1409', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (684, '河曲县', '140930', '1409', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (685, '保德县', '140931', '1409', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (686, '偏关县', '140932', '1409', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (687, '五台山风景名胜区', '140971', '1409', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (688, '原平市', '140981', '1409', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (689, '尧都区', '141002', '1410', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (690, '曲沃县', '141021', '1410', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (691, '翼城县', '141022', '1410', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (692, '襄汾县', '141023', '1410', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (693, '洪洞县', '141024', '1410', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (694, '古县', '141025', '1410', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (695, '安泽县', '141026', '1410', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (696, '浮山县', '141027', '1410', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (697, '吉县', '141028', '1410', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (698, '乡宁县', '141029', '1410', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (699, '大宁县', '141030', '1410', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (700, '隰县', '141031', '1410', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (701, '永和县', '141032', '1410', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (702, '蒲县', '141033', '1410', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (703, '汾西县', '141034', '1410', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (704, '侯马市', '141081', '1410', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (705, '霍州市', '141082', '1410', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (706, '离石区', '141102', '1411', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (707, '文水县', '141121', '1411', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (708, '交城县', '141122', '1411', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (709, '兴县', '141123', '1411', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (710, '临县', '141124', '1411', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (711, '柳林县', '141125', '1411', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (712, '石楼县', '141126', '1411', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (713, '岚县', '141127', '1411', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (714, '方山县', '141128', '1411', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (715, '中阳县', '141129', '1411', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (716, '交口县', '141130', '1411', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (717, '孝义市', '141181', '1411', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (718, '汾阳市', '141182', '1411', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (719, '新城区', '150102', '1501', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (720, '回民区', '150103', '1501', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (721, '玉泉区', '150104', '1501', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (722, '赛罕区', '150105', '1501', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (723, '土默特左旗', '150121', '1501', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (724, '托克托县', '150122', '1501', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (725, '和林格尔县', '150123', '1501', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (726, '清水河县', '150124', '1501', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (727, '武川县', '150125', '1501', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (728, '呼和浩特金海工业园区', '150171', '1501', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (729, '呼和浩特经济技术开发区', '150172', '1501', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (730, '东河区', '150202', '1502', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (731, '昆都仑区', '150203', '1502', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (732, '青山区', '150204', '1502', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (733, '石拐区', '150205', '1502', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (734, '白云鄂博矿区', '150206', '1502', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (735, '九原区', '150207', '1502', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (736, '土默特右旗', '150221', '1502', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (737, '固阳县', '150222', '1502', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (738, '达尔罕茂明安联合旗', '150223', '1502', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (739, '包头稀土高新技术产业开发区', '150271', '1502', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (740, '海勃湾区', '150302', '1503', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (741, '海南区', '150303', '1503', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (742, '乌达区', '150304', '1503', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (743, '红山区', '150402', '1504', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (744, '元宝山区', '150403', '1504', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (745, '松山区', '150404', '1504', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (746, '阿鲁科尔沁旗', '150421', '1504', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (747, '巴林左旗', '150422', '1504', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (748, '巴林右旗', '150423', '1504', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (749, '林西县', '150424', '1504', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (750, '克什克腾旗', '150425', '1504', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (751, '翁牛特旗', '150426', '1504', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (752, '喀喇沁旗', '150428', '1504', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (753, '宁城县', '150429', '1504', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (754, '敖汉旗', '150430', '1504', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (755, '科尔沁区', '150502', '1505', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (756, '科尔沁左翼中旗', '150521', '1505', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (757, '科尔沁左翼后旗', '150522', '1505', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (758, '开鲁县', '150523', '1505', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (759, '库伦旗', '150524', '1505', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (760, '奈曼旗', '150525', '1505', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (761, '扎鲁特旗', '150526', '1505', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (762, '通辽经济技术开发区', '150571', '1505', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (763, '霍林郭勒市', '150581', '1505', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (764, '东胜区', '150602', '1506', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (765, '康巴什区', '150603', '1506', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (766, '达拉特旗', '150621', '1506', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (767, '准格尔旗', '150622', '1506', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (768, '鄂托克前旗', '150623', '1506', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (769, '鄂托克旗', '150624', '1506', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (770, '杭锦旗', '150625', '1506', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (771, '乌审旗', '150626', '1506', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (772, '伊金霍洛旗', '150627', '1506', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (773, '海拉尔区', '150702', '1507', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (774, '扎赉诺尔区', '150703', '1507', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (775, '阿荣旗', '150721', '1507', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (776, '莫力达瓦达斡尔族自治旗', '150722', '1507', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (777, '鄂伦春自治旗', '150723', '1507', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (778, '鄂温克族自治旗', '150724', '1507', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (779, '陈巴尔虎旗', '150725', '1507', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (780, '新巴尔虎左旗', '150726', '1507', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (781, '新巴尔虎右旗', '150727', '1507', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (782, '满洲里市', '150781', '1507', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (783, '牙克石市', '150782', '1507', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (784, '扎兰屯市', '150783', '1507', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (785, '额尔古纳市', '150784', '1507', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (786, '根河市', '150785', '1507', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (787, '临河区', '150802', '1508', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (788, '五原县', '150821', '1508', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (789, '磴口县', '150822', '1508', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (790, '乌拉特前旗', '150823', '1508', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (791, '乌拉特中旗', '150824', '1508', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (792, '乌拉特后旗', '150825', '1508', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (793, '杭锦后旗', '150826', '1508', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (794, '集宁区', '150902', '1509', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (795, '卓资县', '150921', '1509', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (796, '化德县', '150922', '1509', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (797, '商都县', '150923', '1509', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (798, '兴和县', '150924', '1509', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (799, '凉城县', '150925', '1509', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (800, '察哈尔右翼前旗', '150926', '1509', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (801, '察哈尔右翼中旗', '150927', '1509', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (802, '察哈尔右翼后旗', '150928', '1509', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (803, '四子王旗', '150929', '1509', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (804, '丰镇市', '150981', '1509', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (805, '乌兰浩特市', '152201', '1522', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (806, '阿尔山市', '152202', '1522', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (807, '科尔沁右翼前旗', '152221', '1522', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (808, '科尔沁右翼中旗', '152222', '1522', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (809, '扎赉特旗', '152223', '1522', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (810, '突泉县', '152224', '1522', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (811, '二连浩特市', '152501', '1525', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (812, '锡林浩特市', '152502', '1525', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (813, '阿巴嘎旗', '152522', '1525', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (814, '苏尼特左旗', '152523', '1525', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (815, '苏尼特右旗', '152524', '1525', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (816, '东乌珠穆沁旗', '152525', '1525', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (817, '西乌珠穆沁旗', '152526', '1525', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (818, '太仆寺旗', '152527', '1525', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (819, '镶黄旗', '152528', '1525', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (820, '正镶白旗', '152529', '1525', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (821, '正蓝旗', '152530', '1525', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (822, '多伦县', '152531', '1525', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (823, '乌拉盖管委会', '152571', '1525', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (824, '阿拉善左旗', '152921', '1529', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (825, '阿拉善右旗', '152922', '1529', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (826, '额济纳旗', '152923', '1529', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (827, '内蒙古阿拉善经济开发区', '152971', '1529', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (828, '和平区', '210102', '2101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (829, '沈河区', '210103', '2101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (830, '大东区', '210104', '2101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (831, '皇姑区', '210105', '2101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (832, '铁西区', '210106', '2101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (833, '苏家屯区', '210111', '2101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (834, '浑南区', '210112', '2101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (835, '沈北新区', '210113', '2101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (836, '于洪区', '210114', '2101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (837, '辽中区', '210115', '2101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (838, '康平县', '210123', '2101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (839, '法库县', '210124', '2101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (840, '新民市', '210181', '2101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (841, '中山区', '210202', '2102', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (842, '西岗区', '210203', '2102', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (843, '沙河口区', '210204', '2102', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (844, '甘井子区', '210211', '2102', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (845, '旅顺口区', '210212', '2102', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (846, '金州区', '210213', '2102', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (847, '普兰店区', '210214', '2102', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (848, '长海县', '210224', '2102', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (849, '瓦房店市', '210281', '2102', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (850, '庄河市', '210283', '2102', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (851, '铁东区', '210302', '2103', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (852, '铁西区', '210303', '2103', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (853, '立山区', '210304', '2103', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (854, '千山区', '210311', '2103', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (855, '台安县', '210321', '2103', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (856, '岫岩满族自治县', '210323', '2103', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (857, '海城市', '210381', '2103', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (858, '新抚区', '210402', '2104', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (859, '东洲区', '210403', '2104', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (860, '望花区', '210404', '2104', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (861, '顺城区', '210411', '2104', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (862, '抚顺县', '210421', '2104', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (863, '新宾满族自治县', '210422', '2104', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (864, '清原满族自治县', '210423', '2104', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (865, '平山区', '210502', '2105', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (866, '溪湖区', '210503', '2105', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (867, '明山区', '210504', '2105', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (868, '南芬区', '210505', '2105', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (869, '本溪满族自治县', '210521', '2105', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (870, '桓仁满族自治县', '210522', '2105', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (871, '元宝区', '210602', '2106', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (872, '振兴区', '210603', '2106', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (873, '振安区', '210604', '2106', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (874, '宽甸满族自治县', '210624', '2106', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (875, '东港市', '210681', '2106', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (876, '凤城市', '210682', '2106', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (877, '古塔区', '210702', '2107', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (878, '凌河区', '210703', '2107', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (879, '太和区', '210711', '2107', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (880, '黑山县', '210726', '2107', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (881, '义县', '210727', '2107', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (882, '凌海市', '210781', '2107', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (883, '北镇市', '210782', '2107', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (884, '站前区', '210802', '2108', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (885, '西市区', '210803', '2108', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (886, '鲅鱼圈区', '210804', '2108', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (887, '老边区', '210811', '2108', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (888, '盖州市', '210881', '2108', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (889, '大石桥市', '210882', '2108', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (890, '海州区', '210902', '2109', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (891, '新邱区', '210903', '2109', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (892, '太平区', '210904', '2109', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (893, '清河门区', '210905', '2109', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (894, '细河区', '210911', '2109', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (895, '阜新蒙古族自治县', '210921', '2109', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (896, '彰武县', '210922', '2109', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (897, '白塔区', '211002', '2110', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (898, '文圣区', '211003', '2110', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (899, '宏伟区', '211004', '2110', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (900, '弓长岭区', '211005', '2110', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (901, '太子河区', '211011', '2110', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (902, '辽阳县', '211021', '2110', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (903, '灯塔市', '211081', '2110', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (904, '双台子区', '211102', '2111', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (905, '兴隆台区', '211103', '2111', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (906, '大洼区', '211104', '2111', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (907, '盘山县', '211122', '2111', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (908, '银州区', '211202', '2112', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (909, '清河区', '211204', '2112', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (910, '铁岭县', '211221', '2112', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (911, '西丰县', '211223', '2112', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (912, '昌图县', '211224', '2112', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (913, '调兵山市', '211281', '2112', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (914, '开原市', '211282', '2112', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (915, '双塔区', '211302', '2113', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (916, '龙城区', '211303', '2113', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (917, '朝阳县', '211321', '2113', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (918, '建平县', '211322', '2113', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (919, '喀喇沁左翼蒙古族自治县', '211324', '2113', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (920, '北票市', '211381', '2113', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (921, '凌源市', '211382', '2113', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (922, '连山区', '211402', '2114', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (923, '龙港区', '211403', '2114', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (924, '南票区', '211404', '2114', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (925, '绥中县', '211421', '2114', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (926, '建昌县', '211422', '2114', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (927, '兴城市', '211481', '2114', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (928, '南关区', '220102', '2201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (929, '宽城区', '220103', '2201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (930, '朝阳区', '220104', '2201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (931, '二道区', '220105', '2201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (932, '绿园区', '220106', '2201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (933, '双阳区', '220112', '2201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (934, '九台区', '220113', '2201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (935, '农安县', '220122', '2201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (936, '长春经济技术开发区', '220171', '2201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (937, '长春净月高新技术产业开发区', '220172', '2201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (938, '长春高新技术产业开发区', '220173', '2201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (939, '长春汽车经济技术开发区', '220174', '2201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (940, '榆树市', '220182', '2201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (941, '德惠市', '220183', '2201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (942, '昌邑区', '220202', '2202', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (943, '龙潭区', '220203', '2202', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (944, '船营区', '220204', '2202', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (945, '丰满区', '220211', '2202', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (946, '永吉县', '220221', '2202', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (947, '吉林经济开发区', '220271', '2202', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (948, '吉林高新技术产业开发区', '220272', '2202', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (949, '吉林中国新加坡食品区', '220273', '2202', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (950, '蛟河市', '220281', '2202', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (951, '桦甸市', '220282', '2202', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (952, '舒兰市', '220283', '2202', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (953, '磐石市', '220284', '2202', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (954, '铁西区', '220302', '2203', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (955, '铁东区', '220303', '2203', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (956, '梨树县', '220322', '2203', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (957, '伊通满族自治县', '220323', '2203', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (958, '公主岭市', '220381', '2203', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (959, '双辽市', '220382', '2203', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (960, '龙山区', '220402', '2204', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (961, '西安区', '220403', '2204', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (962, '东丰县', '220421', '2204', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (963, '东辽县', '220422', '2204', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (964, '东昌区', '220502', '2205', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (965, '二道江区', '220503', '2205', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (966, '通化县', '220521', '2205', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (967, '辉南县', '220523', '2205', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (968, '柳河县', '220524', '2205', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (969, '梅河口市', '220581', '2205', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (970, '集安市', '220582', '2205', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (971, '浑江区', '220602', '2206', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (972, '江源区', '220605', '2206', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (973, '抚松县', '220621', '2206', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (974, '靖宇县', '220622', '2206', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (975, '长白朝鲜族自治县', '220623', '2206', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (976, '临江市', '220681', '2206', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (977, '宁江区', '220702', '2207', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (978, '前郭尔罗斯蒙古族自治县', '220721', '2207', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (979, '长岭县', '220722', '2207', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (980, '乾安县', '220723', '2207', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (981, '吉林松原经济开发区', '220771', '2207', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (982, '扶余市', '220781', '2207', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (983, '洮北区', '220802', '2208', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (984, '镇赉县', '220821', '2208', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (985, '通榆县', '220822', '2208', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (986, '吉林白城经济开发区', '220871', '2208', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (987, '洮南市', '220881', '2208', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (988, '大安市', '220882', '2208', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (989, '延吉市', '222401', '2224', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (990, '图们市', '222402', '2224', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (991, '敦化市', '222403', '2224', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (992, '珲春市', '222404', '2224', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (993, '龙井市', '222405', '2224', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (994, '和龙市', '222406', '2224', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (995, '汪清县', '222424', '2224', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (996, '安图县', '222426', '2224', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (997, '道里区', '230102', '2301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (998, '南岗区', '230103', '2301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (999, '道外区', '230104', '2301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1000, '平房区', '230108', '2301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1001, '松北区', '230109', '2301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1002, '香坊区', '230110', '2301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1003, '呼兰区', '230111', '2301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1004, '阿城区', '230112', '2301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1005, '双城区', '230113', '2301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1006, '依兰县', '230123', '2301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1007, '方正县', '230124', '2301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1008, '宾县', '230125', '2301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1009, '巴彦县', '230126', '2301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1010, '木兰县', '230127', '2301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1011, '通河县', '230128', '2301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1012, '延寿县', '230129', '2301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1013, '尚志市', '230183', '2301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1014, '五常市', '230184', '2301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1015, '龙沙区', '230202', '2302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1016, '建华区', '230203', '2302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1017, '铁锋区', '230204', '2302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1018, '昂昂溪区', '230205', '2302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1019, '富拉尔基区', '230206', '2302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1020, '碾子山区', '230207', '2302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1021, '梅里斯达斡尔族区', '230208', '2302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1022, '龙江县', '230221', '2302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1023, '依安县', '230223', '2302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1024, '泰来县', '230224', '2302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1025, '甘南县', '230225', '2302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1026, '富裕县', '230227', '2302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1027, '克山县', '230229', '2302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1028, '克东县', '230230', '2302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1029, '拜泉县', '230231', '2302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1030, '讷河市', '230281', '2302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1031, '鸡冠区', '230302', '2303', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1032, '恒山区', '230303', '2303', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1033, '滴道区', '230304', '2303', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1034, '梨树区', '230305', '2303', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1035, '城子河区', '230306', '2303', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1036, '麻山区', '230307', '2303', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1037, '鸡东县', '230321', '2303', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1038, '虎林市', '230381', '2303', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1039, '密山市', '230382', '2303', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1040, '向阳区', '230402', '2304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1041, '工农区', '230403', '2304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1042, '南山区', '230404', '2304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1043, '兴安区', '230405', '2304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1044, '东山区', '230406', '2304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1045, '兴山区', '230407', '2304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1046, '萝北县', '230421', '2304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1047, '绥滨县', '230422', '2304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1048, '尖山区', '230502', '2305', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1049, '岭东区', '230503', '2305', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1050, '四方台区', '230505', '2305', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1051, '宝山区', '230506', '2305', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1052, '集贤县', '230521', '2305', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1053, '友谊县', '230522', '2305', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1054, '宝清县', '230523', '2305', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1055, '饶河县', '230524', '2305', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1056, '萨尔图区', '230602', '2306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1057, '龙凤区', '230603', '2306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1058, '让胡路区', '230604', '2306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1059, '红岗区', '230605', '2306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1060, '大同区', '230606', '2306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1061, '肇州县', '230621', '2306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1062, '肇源县', '230622', '2306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1063, '林甸县', '230623', '2306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1064, '杜尔伯特蒙古族自治县', '230624', '2306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1065, '大庆高新技术产业开发区', '230671', '2306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1066, '伊美区', '230717', '2307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1067, '乌翠区', '230718', '2307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1068, '友好区', '230719', '2307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1069, '嘉荫县', '230722', '2307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1070, '汤旺县', '230723', '2307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1071, '丰林县', '230724', '2307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1072, '大箐山县', '230725', '2307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1073, '南岔县', '230726', '2307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1074, '金林区', '230751', '2307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1075, '铁力市', '230781', '2307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1076, '向阳区', '230803', '2308', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1077, '前进区', '230804', '2308', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1078, '东风区', '230805', '2308', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1079, '郊区', '230811', '2308', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1080, '桦南县', '230822', '2308', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1081, '桦川县', '230826', '2308', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1082, '汤原县', '230828', '2308', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1083, '同江市', '230881', '2308', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1084, '富锦市', '230882', '2308', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1085, '抚远市', '230883', '2308', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1086, '新兴区', '230902', '2309', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1087, '桃山区', '230903', '2309', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1088, '茄子河区', '230904', '2309', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1089, '勃利县', '230921', '2309', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1090, '东安区', '231002', '2310', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1091, '阳明区', '231003', '2310', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1092, '爱民区', '231004', '2310', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1093, '西安区', '231005', '2310', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1094, '林口县', '231025', '2310', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1095, '牡丹江经济技术开发区', '231071', '2310', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1096, '绥芬河市', '231081', '2310', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1097, '海林市', '231083', '2310', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1098, '宁安市', '231084', '2310', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1099, '穆棱市', '231085', '2310', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1100, '东宁市', '231086', '2310', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1101, '爱辉区', '231102', '2311', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1102, '逊克县', '231123', '2311', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1103, '孙吴县', '231124', '2311', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1104, '北安市', '231181', '2311', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1105, '五大连池市', '231182', '2311', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1106, '嫩江市', '231183', '2311', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1107, '北林区', '231202', '2312', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1108, '望奎县', '231221', '2312', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1109, '兰西县', '231222', '2312', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1110, '青冈县', '231223', '2312', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1111, '庆安县', '231224', '2312', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1112, '明水县', '231225', '2312', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1113, '绥棱县', '231226', '2312', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1114, '安达市', '231281', '2312', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1115, '肇东市', '231282', '2312', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1116, '海伦市', '231283', '2312', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1117, '漠河市', '232701', '2327', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1118, '呼玛县', '232721', '2327', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1119, '塔河县', '232722', '2327', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1120, '加格达奇区', '232761', '2327', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1121, '松岭区', '232762', '2327', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1122, '新林区', '232763', '2327', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1123, '呼中区', '232764', '2327', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1124, '黄浦区', '310101', '3101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1125, '徐汇区', '310104', '3101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1126, '长宁区', '310105', '3101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1127, '静安区', '310106', '3101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1128, '普陀区', '310107', '3101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1129, '虹口区', '310109', '3101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1130, '杨浦区', '310110', '3101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1131, '闵行区', '310112', '3101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1132, '宝山区', '310113', '3101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1133, '嘉定区', '310114', '3101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1134, '浦东新区', '310115', '3101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1135, '金山区', '310116', '3101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1136, '松江区', '310117', '3101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1137, '青浦区', '310118', '3101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1138, '奉贤区', '310120', '3101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1139, '崇明区', '310151', '3101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1140, '玄武区', '320102', '3201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1141, '秦淮区', '320104', '3201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1142, '建邺区', '320105', '3201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1143, '鼓楼区', '320106', '3201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1144, '浦口区', '320111', '3201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1145, '栖霞区', '320113', '3201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1146, '雨花台区', '320114', '3201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1147, '江宁区', '320115', '3201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1148, '六合区', '320116', '3201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1149, '溧水区', '320117', '3201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1150, '高淳区', '320118', '3201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1151, '锡山区', '320205', '3202', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1152, '惠山区', '320206', '3202', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1153, '滨湖区', '320211', '3202', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1154, '梁溪区', '320213', '3202', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1155, '新吴区', '320214', '3202', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1156, '江阴市', '320281', '3202', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1157, '宜兴市', '320282', '3202', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1158, '鼓楼区', '320302', '3203', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1159, '云龙区', '320303', '3203', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1160, '贾汪区', '320305', '3203', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1161, '泉山区', '320311', '3203', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1162, '铜山区', '320312', '3203', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1163, '丰县', '320321', '3203', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1164, '沛县', '320322', '3203', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1165, '睢宁县', '320324', '3203', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1166, '徐州经济技术开发区', '320371', '3203', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1167, '新沂市', '320381', '3203', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1168, '邳州市', '320382', '3203', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1169, '天宁区', '320402', '3204', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1170, '钟楼区', '320404', '3204', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1171, '新北区', '320411', '3204', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1172, '武进区', '320412', '3204', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1173, '金坛区', '320413', '3204', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1174, '溧阳市', '320481', '3204', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1175, '虎丘区', '320505', '3205', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1176, '吴中区', '320506', '3205', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1177, '相城区', '320507', '3205', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1178, '姑苏区', '320508', '3205', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1179, '吴江区', '320509', '3205', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1180, '苏州工业园区', '320571', '3205', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1181, '常熟市', '320581', '3205', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1182, '张家港市', '320582', '3205', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1183, '昆山市', '320583', '3205', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1184, '太仓市', '320585', '3205', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1185, '崇川区', '320602', '3206', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1186, '港闸区', '320611', '3206', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1187, '通州区', '320612', '3206', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1188, '如东县', '320623', '3206', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1189, '南通经济技术开发区', '320671', '3206', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1190, '启东市', '320681', '3206', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1191, '如皋市', '320682', '3206', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1192, '海门市', '320684', '3206', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1193, '海安市', '320685', '3206', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1194, '连云区', '320703', '3207', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1195, '海州区', '320706', '3207', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1196, '赣榆区', '320707', '3207', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1197, '东海县', '320722', '3207', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1198, '灌云县', '320723', '3207', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1199, '灌南县', '320724', '3207', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1200, '连云港经济技术开发区', '320771', '3207', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1201, '连云港高新技术产业开发区', '320772', '3207', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1202, '淮安区', '320803', '3208', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1203, '淮阴区', '320804', '3208', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1204, '清江浦区', '320812', '3208', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1205, '洪泽区', '320813', '3208', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1206, '涟水县', '320826', '3208', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1207, '盱眙县', '320830', '3208', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1208, '金湖县', '320831', '3208', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1209, '淮安经济技术开发区', '320871', '3208', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1210, '亭湖区', '320902', '3209', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1211, '盐都区', '320903', '3209', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1212, '大丰区', '320904', '3209', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1213, '响水县', '320921', '3209', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1214, '滨海县', '320922', '3209', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1215, '阜宁县', '320923', '3209', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1216, '射阳县', '320924', '3209', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1217, '建湖县', '320925', '3209', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1218, '盐城经济技术开发区', '320971', '3209', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1219, '东台市', '320981', '3209', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1220, '广陵区', '321002', '3210', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1221, '邗江区', '321003', '3210', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1222, '江都区', '321012', '3210', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1223, '宝应县', '321023', '3210', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1224, '扬州经济技术开发区', '321071', '3210', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1225, '仪征市', '321081', '3210', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1226, '高邮市', '321084', '3210', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1227, '京口区', '321102', '3211', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1228, '润州区', '321111', '3211', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1229, '丹徒区', '321112', '3211', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1230, '镇江新区', '321171', '3211', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1231, '丹阳市', '321181', '3211', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1232, '扬中市', '321182', '3211', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1233, '句容市', '321183', '3211', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1234, '海陵区', '321202', '3212', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1235, '高港区', '321203', '3212', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1236, '姜堰区', '321204', '3212', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1237, '泰州医药高新技术产业开发区', '321271', '3212', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1238, '兴化市', '321281', '3212', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1239, '靖江市', '321282', '3212', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1240, '泰兴市', '321283', '3212', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1241, '宿城区', '321302', '3213', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1242, '宿豫区', '321311', '3213', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1243, '沭阳县', '321322', '3213', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1244, '泗阳县', '321323', '3213', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1245, '泗洪县', '321324', '3213', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1246, '宿迁经济技术开发区', '321371', '3213', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1247, '上城区', '330102', '3301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1248, '下城区', '330103', '3301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1249, '江干区', '330104', '3301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1250, '拱墅区', '330105', '3301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1251, '西湖区', '330106', '3301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1252, '滨江区', '330108', '3301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1253, '萧山区', '330109', '3301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1254, '余杭区', '330110', '3301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1255, '富阳区', '330111', '3301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1256, '临安区', '330112', '3301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1257, '桐庐县', '330122', '3301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1258, '淳安县', '330127', '3301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1259, '建德市', '330182', '3301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1260, '海曙区', '330203', '3302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1261, '江北区', '330205', '3302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1262, '北仑区', '330206', '3302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1263, '镇海区', '330211', '3302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1264, '鄞州区', '330212', '3302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1265, '奉化区', '330213', '3302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1266, '象山县', '330225', '3302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1267, '宁海县', '330226', '3302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1268, '余姚市', '330281', '3302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1269, '慈溪市', '330282', '3302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1270, '鹿城区', '330302', '3303', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1271, '龙湾区', '330303', '3303', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1272, '瓯海区', '330304', '3303', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1273, '洞头区', '330305', '3303', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1274, '永嘉县', '330324', '3303', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1275, '平阳县', '330326', '3303', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1276, '苍南县', '330327', '3303', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1277, '文成县', '330328', '3303', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1278, '泰顺县', '330329', '3303', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1279, '温州经济技术开发区', '330371', '3303', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1280, '瑞安市', '330381', '3303', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1281, '乐清市', '330382', '3303', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1282, '龙港市', '330383', '3303', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1283, '南湖区', '330402', '3304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1284, '秀洲区', '330411', '3304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1285, '嘉善县', '330421', '3304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1286, '海盐县', '330424', '3304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1287, '海宁市', '330481', '3304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1288, '平湖市', '330482', '3304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1289, '桐乡市', '330483', '3304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1290, '吴兴区', '330502', '3305', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1291, '南浔区', '330503', '3305', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1292, '德清县', '330521', '3305', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1293, '长兴县', '330522', '3305', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1294, '安吉县', '330523', '3305', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1295, '越城区', '330602', '3306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1296, '柯桥区', '330603', '3306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1297, '上虞区', '330604', '3306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1298, '新昌县', '330624', '3306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1299, '诸暨市', '330681', '3306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1300, '嵊州市', '330683', '3306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1301, '婺城区', '330702', '3307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1302, '金东区', '330703', '3307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1303, '武义县', '330723', '3307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1304, '浦江县', '330726', '3307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1305, '磐安县', '330727', '3307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1306, '兰溪市', '330781', '3307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1307, '义乌市', '330782', '3307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1308, '东阳市', '330783', '3307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1309, '永康市', '330784', '3307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1310, '柯城区', '330802', '3308', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1311, '衢江区', '330803', '3308', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1312, '常山县', '330822', '3308', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1313, '开化县', '330824', '3308', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1314, '龙游县', '330825', '3308', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1315, '江山市', '330881', '3308', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1316, '定海区', '330902', '3309', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1317, '普陀区', '330903', '3309', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1318, '岱山县', '330921', '3309', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1319, '嵊泗县', '330922', '3309', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1320, '椒江区', '331002', '3310', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1321, '黄岩区', '331003', '3310', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1322, '路桥区', '331004', '3310', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1323, '三门县', '331022', '3310', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1324, '天台县', '331023', '3310', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1325, '仙居县', '331024', '3310', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1326, '温岭市', '331081', '3310', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1327, '临海市', '331082', '3310', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1328, '玉环市', '331083', '3310', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1329, '莲都区', '331102', '3311', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1330, '青田县', '331121', '3311', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1331, '缙云县', '331122', '3311', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1332, '遂昌县', '331123', '3311', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1333, '松阳县', '331124', '3311', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1334, '云和县', '331125', '3311', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1335, '庆元县', '331126', '3311', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1336, '景宁畲族自治县', '331127', '3311', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1337, '龙泉市', '331181', '3311', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1338, '瑶海区', '340102', '3401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1339, '庐阳区', '340103', '3401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1340, '蜀山区', '340104', '3401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1341, '包河区', '340111', '3401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1342, '长丰县', '340121', '3401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1343, '肥东县', '340122', '3401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1344, '肥西县', '340123', '3401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1345, '庐江县', '340124', '3401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1346, '合肥高新技术产业开发区', '340171', '3401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1347, '合肥经济技术开发区', '340172', '3401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1348, '合肥新站高新技术产业开发区', '340173', '3401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1349, '巢湖市', '340181', '3401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1350, '镜湖区', '340202', '3402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1351, '弋江区', '340203', '3402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1352, '鸠江区', '340207', '3402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1353, '三山区', '340208', '3402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1354, '芜湖县', '340221', '3402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1355, '繁昌县', '340222', '3402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1356, '南陵县', '340223', '3402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1357, '无为县', '340225', '3402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1358, '芜湖经济技术开发区', '340271', '3402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1359, '安徽芜湖长江大桥经济开发区', '340272', '3402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1360, '龙子湖区', '340302', '3403', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1361, '蚌山区', '340303', '3403', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1362, '禹会区', '340304', '3403', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1363, '淮上区', '340311', '3403', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1364, '怀远县', '340321', '3403', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1365, '五河县', '340322', '3403', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1366, '固镇县', '340323', '3403', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1367, '蚌埠市高新技术开发区', '340371', '3403', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1368, '蚌埠市经济开发区', '340372', '3403', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1369, '大通区', '340402', '3404', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1370, '田家庵区', '340403', '3404', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1371, '谢家集区', '340404', '3404', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1372, '八公山区', '340405', '3404', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1373, '潘集区', '340406', '3404', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1374, '凤台县', '340421', '3404', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1375, '寿县', '340422', '3404', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1376, '花山区', '340503', '3405', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1377, '雨山区', '340504', '3405', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1378, '博望区', '340506', '3405', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1379, '当涂县', '340521', '3405', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1380, '含山县', '340522', '3405', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1381, '和县', '340523', '3405', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1382, '杜集区', '340602', '3406', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1383, '相山区', '340603', '3406', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1384, '烈山区', '340604', '3406', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1385, '濉溪县', '340621', '3406', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1386, '铜官区', '340705', '3407', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1387, '义安区', '340706', '3407', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1388, '郊区', '340711', '3407', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1389, '枞阳县', '340722', '3407', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1390, '迎江区', '340802', '3408', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1391, '大观区', '340803', '3408', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1392, '宜秀区', '340811', '3408', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1393, '怀宁县', '340822', '3408', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1394, '太湖县', '340825', '3408', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1395, '宿松县', '340826', '3408', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1396, '望江县', '340827', '3408', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1397, '岳西县', '340828', '3408', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1398, '安徽安庆经济开发区', '340871', '3408', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1399, '桐城市', '340881', '3408', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1400, '潜山市', '340882', '3408', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1401, '屯溪区', '341002', '3410', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1402, '黄山区', '341003', '3410', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1403, '徽州区', '341004', '3410', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1404, '歙县', '341021', '3410', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1405, '休宁县', '341022', '3410', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1406, '黟县', '341023', '3410', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1407, '祁门县', '341024', '3410', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1408, '琅琊区', '341102', '3411', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1409, '南谯区', '341103', '3411', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1410, '来安县', '341122', '3411', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1411, '全椒县', '341124', '3411', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1412, '定远县', '341125', '3411', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1413, '凤阳县', '341126', '3411', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1414, '苏滁现代产业园', '341171', '3411', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1415, '滁州经济技术开发区', '341172', '3411', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1416, '天长市', '341181', '3411', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1417, '明光市', '341182', '3411', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1418, '颍州区', '341202', '3412', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1419, '颍东区', '341203', '3412', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1420, '颍泉区', '341204', '3412', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1421, '临泉县', '341221', '3412', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1422, '太和县', '341222', '3412', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1423, '阜南县', '341225', '3412', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1424, '颍上县', '341226', '3412', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1425, '阜阳合肥现代产业园区', '341271', '3412', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1426, '阜阳经济技术开发区', '341272', '3412', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1427, '界首市', '341282', '3412', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1428, '埇桥区', '341302', '3413', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1429, '砀山县', '341321', '3413', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1430, '萧县', '341322', '3413', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1431, '灵璧县', '341323', '3413', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1432, '泗县', '341324', '3413', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1433, '宿州马鞍山现代产业园区', '341371', '3413', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1434, '宿州经济技术开发区', '341372', '3413', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1435, '金安区', '341502', '3415', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1436, '裕安区', '341503', '3415', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1437, '叶集区', '341504', '3415', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1438, '霍邱县', '341522', '3415', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1439, '舒城县', '341523', '3415', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1440, '金寨县', '341524', '3415', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1441, '霍山县', '341525', '3415', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1442, '谯城区', '341602', '3416', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1443, '涡阳县', '341621', '3416', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1444, '蒙城县', '341622', '3416', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1445, '利辛县', '341623', '3416', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1446, '贵池区', '341702', '3417', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1447, '东至县', '341721', '3417', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1448, '石台县', '341722', '3417', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1449, '青阳县', '341723', '3417', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1450, '宣州区', '341802', '3418', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1451, '郎溪县', '341821', '3418', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1452, '泾县', '341823', '3418', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1453, '绩溪县', '341824', '3418', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1454, '旌德县', '341825', '3418', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1455, '宣城市经济开发区', '341871', '3418', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1456, '宁国市', '341881', '3418', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1457, '广德市', '341882', '3418', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1458, '鼓楼区', '350102', '3501', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1459, '台江区', '350103', '3501', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1460, '仓山区', '350104', '3501', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1461, '马尾区', '350105', '3501', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1462, '晋安区', '350111', '3501', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1463, '长乐区', '350112', '3501', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1464, '闽侯县', '350121', '3501', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1465, '连江县', '350122', '3501', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1466, '罗源县', '350123', '3501', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1467, '闽清县', '350124', '3501', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1468, '永泰县', '350125', '3501', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1469, '平潭县', '350128', '3501', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1470, '福清市', '350181', '3501', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1471, '思明区', '350203', '3502', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1472, '海沧区', '350205', '3502', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1473, '湖里区', '350206', '3502', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1474, '集美区', '350211', '3502', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1475, '同安区', '350212', '3502', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1476, '翔安区', '350213', '3502', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1477, '城厢区', '350302', '3503', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1478, '涵江区', '350303', '3503', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1479, '荔城区', '350304', '3503', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1480, '秀屿区', '350305', '3503', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1481, '仙游县', '350322', '3503', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1482, '梅列区', '350402', '3504', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1483, '三元区', '350403', '3504', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1484, '明溪县', '350421', '3504', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1485, '清流县', '350423', '3504', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1486, '宁化县', '350424', '3504', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1487, '大田县', '350425', '3504', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1488, '尤溪县', '350426', '3504', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1489, '沙县', '350427', '3504', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1490, '将乐县', '350428', '3504', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1491, '泰宁县', '350429', '3504', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1492, '建宁县', '350430', '3504', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1493, '永安市', '350481', '3504', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1494, '鲤城区', '350502', '3505', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1495, '丰泽区', '350503', '3505', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1496, '洛江区', '350504', '3505', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1497, '泉港区', '350505', '3505', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1498, '惠安县', '350521', '3505', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1499, '安溪县', '350524', '3505', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1500, '永春县', '350525', '3505', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1501, '德化县', '350526', '3505', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1502, '金门县', '350527', '3505', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1503, '石狮市', '350581', '3505', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1504, '晋江市', '350582', '3505', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1505, '南安市', '350583', '3505', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1506, '芗城区', '350602', '3506', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1507, '龙文区', '350603', '3506', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1508, '云霄县', '350622', '3506', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1509, '漳浦县', '350623', '3506', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1510, '诏安县', '350624', '3506', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1511, '长泰县', '350625', '3506', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1512, '东山县', '350626', '3506', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1513, '南靖县', '350627', '3506', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1514, '平和县', '350628', '3506', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1515, '华安县', '350629', '3506', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1516, '龙海市', '350681', '3506', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1517, '延平区', '350702', '3507', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1518, '建阳区', '350703', '3507', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1519, '顺昌县', '350721', '3507', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1520, '浦城县', '350722', '3507', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1521, '光泽县', '350723', '3507', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1522, '松溪县', '350724', '3507', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1523, '政和县', '350725', '3507', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1524, '邵武市', '350781', '3507', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1525, '武夷山市', '350782', '3507', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1526, '建瓯市', '350783', '3507', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1527, '新罗区', '350802', '3508', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1528, '永定区', '350803', '3508', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1529, '长汀县', '350821', '3508', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1530, '上杭县', '350823', '3508', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1531, '武平县', '350824', '3508', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1532, '连城县', '350825', '3508', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1533, '漳平市', '350881', '3508', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1534, '蕉城区', '350902', '3509', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1535, '霞浦县', '350921', '3509', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1536, '古田县', '350922', '3509', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1537, '屏南县', '350923', '3509', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1538, '寿宁县', '350924', '3509', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1539, '周宁县', '350925', '3509', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1540, '柘荣县', '350926', '3509', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1541, '福安市', '350981', '3509', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1542, '福鼎市', '350982', '3509', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1543, '东湖区', '360102', '3601', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1544, '西湖区', '360103', '3601', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1545, '青云谱区', '360104', '3601', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1546, '湾里区', '360105', '3601', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1547, '青山湖区', '360111', '3601', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1548, '新建区', '360112', '3601', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1549, '南昌县', '360121', '3601', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1550, '安义县', '360123', '3601', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1551, '进贤县', '360124', '3601', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1552, '昌江区', '360202', '3602', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1553, '珠山区', '360203', '3602', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1554, '浮梁县', '360222', '3602', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1555, '乐平市', '360281', '3602', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1556, '安源区', '360302', '3603', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1557, '湘东区', '360313', '3603', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1558, '莲花县', '360321', '3603', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1559, '上栗县', '360322', '3603', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1560, '芦溪县', '360323', '3603', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1561, '濂溪区', '360402', '3604', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1562, '浔阳区', '360403', '3604', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1563, '柴桑区', '360404', '3604', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1564, '武宁县', '360423', '3604', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1565, '修水县', '360424', '3604', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1566, '永修县', '360425', '3604', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1567, '德安县', '360426', '3604', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1568, '都昌县', '360428', '3604', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1569, '湖口县', '360429', '3604', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1570, '彭泽县', '360430', '3604', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1571, '瑞昌市', '360481', '3604', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1572, '共青城市', '360482', '3604', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1573, '庐山市', '360483', '3604', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1574, '渝水区', '360502', '3605', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1575, '分宜县', '360521', '3605', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1576, '月湖区', '360602', '3606', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1577, '余江区', '360603', '3606', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1578, '贵溪市', '360681', '3606', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1579, '章贡区', '360702', '3607', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1580, '南康区', '360703', '3607', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1581, '赣县区', '360704', '3607', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1582, '信丰县', '360722', '3607', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1583, '大余县', '360723', '3607', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1584, '上犹县', '360724', '3607', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1585, '崇义县', '360725', '3607', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1586, '安远县', '360726', '3607', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1587, '龙南县', '360727', '3607', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1588, '定南县', '360728', '3607', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1589, '全南县', '360729', '3607', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1590, '宁都县', '360730', '3607', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1591, '于都县', '360731', '3607', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1592, '兴国县', '360732', '3607', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1593, '会昌县', '360733', '3607', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1594, '寻乌县', '360734', '3607', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1595, '石城县', '360735', '3607', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1596, '瑞金市', '360781', '3607', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1597, '吉州区', '360802', '3608', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1598, '青原区', '360803', '3608', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1599, '吉安县', '360821', '3608', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1600, '吉水县', '360822', '3608', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1601, '峡江县', '360823', '3608', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1602, '新干县', '360824', '3608', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1603, '永丰县', '360825', '3608', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1604, '泰和县', '360826', '3608', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1605, '遂川县', '360827', '3608', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1606, '万安县', '360828', '3608', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1607, '安福县', '360829', '3608', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1608, '永新县', '360830', '3608', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1609, '井冈山市', '360881', '3608', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1610, '袁州区', '360902', '3609', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1611, '奉新县', '360921', '3609', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1612, '万载县', '360922', '3609', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1613, '上高县', '360923', '3609', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1614, '宜丰县', '360924', '3609', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1615, '靖安县', '360925', '3609', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1616, '铜鼓县', '360926', '3609', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1617, '丰城市', '360981', '3609', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1618, '樟树市', '360982', '3609', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1619, '高安市', '360983', '3609', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1620, '临川区', '361002', '3610', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1621, '东乡区', '361003', '3610', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1622, '南城县', '361021', '3610', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1623, '黎川县', '361022', '3610', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1624, '南丰县', '361023', '3610', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1625, '崇仁县', '361024', '3610', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1626, '乐安县', '361025', '3610', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1627, '宜黄县', '361026', '3610', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1628, '金溪县', '361027', '3610', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1629, '资溪县', '361028', '3610', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1630, '广昌县', '361030', '3610', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1631, '信州区', '361102', '3611', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1632, '广丰区', '361103', '3611', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1633, '广信区', '361104', '3611', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1634, '玉山县', '361123', '3611', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1635, '铅山县', '361124', '3611', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1636, '横峰县', '361125', '3611', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1637, '弋阳县', '361126', '3611', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1638, '余干县', '361127', '3611', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1639, '鄱阳县', '361128', '3611', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1640, '万年县', '361129', '3611', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1641, '婺源县', '361130', '3611', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1642, '德兴市', '361181', '3611', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1643, '历下区', '370102', '3701', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1644, '市中区', '370103', '3701', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1645, '槐荫区', '370104', '3701', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1646, '天桥区', '370105', '3701', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1647, '历城区', '370112', '3701', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1648, '长清区', '370113', '3701', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1649, '章丘区', '370114', '3701', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1650, '济阳区', '370115', '3701', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1651, '莱芜区', '370116', '3701', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1652, '钢城区', '370117', '3701', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1653, '平阴县', '370124', '3701', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1654, '商河县', '370126', '3701', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1655, '济南高新技术产业开发区', '370171', '3701', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1656, '市南区', '370202', '3702', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1657, '市北区', '370203', '3702', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1658, '黄岛区', '370211', '3702', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1659, '崂山区', '370212', '3702', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1660, '李沧区', '370213', '3702', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1661, '城阳区', '370214', '3702', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1662, '即墨区', '370215', '3702', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1663, '青岛高新技术产业开发区', '370271', '3702', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1664, '胶州市', '370281', '3702', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1665, '平度市', '370283', '3702', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1666, '莱西市', '370285', '3702', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1667, '淄川区', '370302', '3703', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1668, '张店区', '370303', '3703', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1669, '博山区', '370304', '3703', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1670, '临淄区', '370305', '3703', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1671, '周村区', '370306', '3703', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1672, '桓台县', '370321', '3703', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1673, '高青县', '370322', '3703', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1674, '沂源县', '370323', '3703', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1675, '市中区', '370402', '3704', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1676, '薛城区', '370403', '3704', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1677, '峄城区', '370404', '3704', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1678, '台儿庄区', '370405', '3704', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1679, '山亭区', '370406', '3704', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1680, '滕州市', '370481', '3704', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1681, '东营区', '370502', '3705', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1682, '河口区', '370503', '3705', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1683, '垦利区', '370505', '3705', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1684, '利津县', '370522', '3705', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1685, '广饶县', '370523', '3705', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1686, '东营经济技术开发区', '370571', '3705', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1687, '东营港经济开发区', '370572', '3705', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1688, '芝罘区', '370602', '3706', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1689, '福山区', '370611', '3706', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1690, '牟平区', '370612', '3706', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1691, '莱山区', '370613', '3706', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1692, '长岛县', '370634', '3706', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1693, '烟台高新技术产业开发区', '370671', '3706', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1694, '烟台经济技术开发区', '370672', '3706', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1695, '龙口市', '370681', '3706', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1696, '莱阳市', '370682', '3706', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1697, '莱州市', '370683', '3706', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1698, '蓬莱市', '370684', '3706', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1699, '招远市', '370685', '3706', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1700, '栖霞市', '370686', '3706', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1701, '海阳市', '370687', '3706', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1702, '潍城区', '370702', '3707', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1703, '寒亭区', '370703', '3707', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1704, '坊子区', '370704', '3707', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1705, '奎文区', '370705', '3707', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1706, '临朐县', '370724', '3707', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1707, '昌乐县', '370725', '3707', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1708, '潍坊滨海经济技术开发区', '370772', '3707', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1709, '青州市', '370781', '3707', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1710, '诸城市', '370782', '3707', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1711, '寿光市', '370783', '3707', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1712, '安丘市', '370784', '3707', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1713, '高密市', '370785', '3707', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1714, '昌邑市', '370786', '3707', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1715, '任城区', '370811', '3708', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1716, '兖州区', '370812', '3708', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1717, '微山县', '370826', '3708', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1718, '鱼台县', '370827', '3708', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1719, '金乡县', '370828', '3708', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1720, '嘉祥县', '370829', '3708', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1721, '汶上县', '370830', '3708', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1722, '泗水县', '370831', '3708', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1723, '梁山县', '370832', '3708', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1724, '济宁高新技术产业开发区', '370871', '3708', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1725, '曲阜市', '370881', '3708', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1726, '邹城市', '370883', '3708', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1727, '泰山区', '370902', '3709', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1728, '岱岳区', '370911', '3709', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1729, '宁阳县', '370921', '3709', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1730, '东平县', '370923', '3709', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1731, '新泰市', '370982', '3709', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1732, '肥城市', '370983', '3709', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1733, '环翠区', '371002', '3710', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1734, '文登区', '371003', '3710', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1735, '威海火炬高技术产业开发区', '371071', '3710', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1736, '威海经济技术开发区', '371072', '3710', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1737, '威海临港经济技术开发区', '371073', '3710', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1738, '荣成市', '371082', '3710', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1739, '乳山市', '371083', '3710', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1740, '东港区', '371102', '3711', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1741, '岚山区', '371103', '3711', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1742, '五莲县', '371121', '3711', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1743, '莒县', '371122', '3711', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1744, '日照经济技术开发区', '371171', '3711', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1745, '兰山区', '371302', '3713', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1746, '罗庄区', '371311', '3713', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1747, '河东区', '371312', '3713', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1748, '沂南县', '371321', '3713', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1749, '郯城县', '371322', '3713', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1750, '沂水县', '371323', '3713', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1751, '兰陵县', '371324', '3713', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1752, '费县', '371325', '3713', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1753, '平邑县', '371326', '3713', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1754, '莒南县', '371327', '3713', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1755, '蒙阴县', '371328', '3713', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1756, '临沭县', '371329', '3713', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1757, '临沂高新技术产业开发区', '371371', '3713', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1758, '临沂经济技术开发区', '371372', '3713', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1759, '临沂临港经济开发区', '371373', '3713', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1760, '德城区', '371402', '3714', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1761, '陵城区', '371403', '3714', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1762, '宁津县', '371422', '3714', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1763, '庆云县', '371423', '3714', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1764, '临邑县', '371424', '3714', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1765, '齐河县', '371425', '3714', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1766, '平原县', '371426', '3714', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1767, '夏津县', '371427', '3714', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1768, '武城县', '371428', '3714', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1769, '德州经济技术开发区', '371471', '3714', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1770, '德州运河经济开发区', '371472', '3714', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1771, '乐陵市', '371481', '3714', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1772, '禹城市', '371482', '3714', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1773, '东昌府区', '371502', '3715', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1774, '茌平区', '371503', '3715', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1775, '阳谷县', '371521', '3715', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1776, '莘县', '371522', '3715', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1777, '东阿县', '371524', '3715', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1778, '冠县', '371525', '3715', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1779, '高唐县', '371526', '3715', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1780, '临清市', '371581', '3715', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1781, '滨城区', '371602', '3716', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1782, '沾化区', '371603', '3716', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1783, '惠民县', '371621', '3716', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1784, '阳信县', '371622', '3716', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1785, '无棣县', '371623', '3716', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1786, '博兴县', '371625', '3716', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1787, '邹平市', '371681', '3716', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1788, '牡丹区', '371702', '3717', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1789, '定陶区', '371703', '3717', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1790, '曹县', '371721', '3717', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1791, '单县', '371722', '3717', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1792, '成武县', '371723', '3717', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1793, '巨野县', '371724', '3717', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1794, '郓城县', '371725', '3717', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1795, '鄄城县', '371726', '3717', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1796, '东明县', '371728', '3717', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1797, '菏泽经济技术开发区', '371771', '3717', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1798, '菏泽高新技术开发区', '371772', '3717', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1799, '中原区', '410102', '4101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1800, '二七区', '410103', '4101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1801, '管城回族区', '410104', '4101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1802, '金水区', '410105', '4101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1803, '上街区', '410106', '4101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1804, '惠济区', '410108', '4101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1805, '中牟县', '410122', '4101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1806, '郑州经济技术开发区', '410171', '4101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1807, '郑州高新技术产业开发区', '410172', '4101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1808, '郑州航空港经济综合实验区', '410173', '4101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1809, '巩义市', '410181', '4101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1810, '荥阳市', '410182', '4101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1811, '新密市', '410183', '4101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1812, '新郑市', '410184', '4101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1813, '登封市', '410185', '4101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1814, '龙亭区', '410202', '4102', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1815, '顺河回族区', '410203', '4102', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1816, '鼓楼区', '410204', '4102', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1817, '禹王台区', '410205', '4102', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1818, '祥符区', '410212', '4102', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1819, '杞县', '410221', '4102', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1820, '通许县', '410222', '4102', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1821, '尉氏县', '410223', '4102', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1822, '兰考县', '410225', '4102', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1823, '老城区', '410302', '4103', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1824, '西工区', '410303', '4103', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1825, '瀍河回族区', '410304', '4103', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1826, '涧西区', '410305', '4103', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1827, '吉利区', '410306', '4103', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1828, '洛龙区', '410311', '4103', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1829, '孟津县', '410322', '4103', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1830, '新安县', '410323', '4103', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1831, '栾川县', '410324', '4103', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1832, '嵩县', '410325', '4103', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1833, '汝阳县', '410326', '4103', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1834, '宜阳县', '410327', '4103', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1835, '洛宁县', '410328', '4103', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1836, '伊川县', '410329', '4103', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1837, '洛阳高新技术产业开发区', '410371', '4103', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1838, '偃师市', '410381', '4103', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1839, '新华区', '410402', '4104', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1840, '卫东区', '410403', '4104', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1841, '石龙区', '410404', '4104', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1842, '湛河区', '410411', '4104', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1843, '宝丰县', '410421', '4104', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1844, '叶县', '410422', '4104', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1845, '鲁山县', '410423', '4104', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1846, '郏县', '410425', '4104', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1847, '平顶山高新技术产业开发区', '410471', '4104', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1848, '平顶山市城乡一体化示范区', '410472', '4104', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1849, '舞钢市', '410481', '4104', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1850, '汝州市', '410482', '4104', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1851, '文峰区', '410502', '4105', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1852, '北关区', '410503', '4105', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1853, '殷都区', '410505', '4105', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1854, '龙安区', '410506', '4105', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1855, '安阳县', '410522', '4105', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1856, '汤阴县', '410523', '4105', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1857, '滑县', '410526', '4105', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1858, '内黄县', '410527', '4105', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1859, '安阳高新技术产业开发区', '410571', '4105', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1860, '林州市', '410581', '4105', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1861, '鹤山区', '410602', '4106', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1862, '山城区', '410603', '4106', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1863, '淇滨区', '410611', '4106', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1864, '浚县', '410621', '4106', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1865, '淇县', '410622', '4106', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1866, '鹤壁经济技术开发区', '410671', '4106', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1867, '红旗区', '410702', '4107', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1868, '卫滨区', '410703', '4107', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1869, '凤泉区', '410704', '4107', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1870, '牧野区', '410711', '4107', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1871, '新乡县', '410721', '4107', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1872, '获嘉县', '410724', '4107', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1873, '原阳县', '410725', '4107', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1874, '延津县', '410726', '4107', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1875, '封丘县', '410727', '4107', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1876, '新乡高新技术产业开发区', '410771', '4107', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1877, '新乡经济技术开发区', '410772', '4107', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1878, '新乡市平原城乡一体化示范区', '410773', '4107', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1879, '卫辉市', '410781', '4107', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1880, '辉县市', '410782', '4107', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1881, '长垣市', '410783', '4107', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1882, '解放区', '410802', '4108', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1883, '中站区', '410803', '4108', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1884, '马村区', '410804', '4108', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1885, '山阳区', '410811', '4108', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1886, '修武县', '410821', '4108', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1887, '博爱县', '410822', '4108', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1888, '武陟县', '410823', '4108', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1889, '温县', '410825', '4108', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1890, '焦作城乡一体化示范区', '410871', '4108', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1891, '沁阳市', '410882', '4108', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1892, '孟州市', '410883', '4108', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1893, '华龙区', '410902', '4109', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1894, '清丰县', '410922', '4109', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1895, '南乐县', '410923', '4109', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1896, '范县', '410926', '4109', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1897, '台前县', '410927', '4109', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1898, '濮阳县', '410928', '4109', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1899, '河南濮阳工业园区', '410971', '4109', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1900, '濮阳经济技术开发区', '410972', '4109', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1901, '魏都区', '411002', '4110', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1902, '建安区', '411003', '4110', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1903, '鄢陵县', '411024', '4110', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1904, '襄城县', '411025', '4110', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1905, '许昌经济技术开发区', '411071', '4110', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1906, '禹州市', '411081', '4110', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1907, '长葛市', '411082', '4110', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1908, '源汇区', '411102', '4111', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1909, '郾城区', '411103', '4111', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1910, '召陵区', '411104', '4111', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1911, '舞阳县', '411121', '4111', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1912, '临颍县', '411122', '4111', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1913, '漯河经济技术开发区', '411171', '4111', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1914, '湖滨区', '411202', '4112', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1915, '陕州区', '411203', '4112', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1916, '渑池县', '411221', '4112', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1917, '卢氏县', '411224', '4112', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1918, '河南三门峡经济开发区', '411271', '4112', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1919, '义马市', '411281', '4112', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1920, '灵宝市', '411282', '4112', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1921, '宛城区', '411302', '4113', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1922, '卧龙区', '411303', '4113', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1923, '南召县', '411321', '4113', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1924, '方城县', '411322', '4113', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1925, '西峡县', '411323', '4113', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1926, '镇平县', '411324', '4113', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1927, '内乡县', '411325', '4113', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1928, '淅川县', '411326', '4113', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1929, '社旗县', '411327', '4113', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1930, '唐河县', '411328', '4113', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1931, '新野县', '411329', '4113', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1932, '桐柏县', '411330', '4113', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1933, '南阳高新技术产业开发区', '411371', '4113', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1934, '南阳市城乡一体化示范区', '411372', '4113', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1935, '邓州市', '411381', '4113', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1936, '梁园区', '411402', '4114', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1937, '睢阳区', '411403', '4114', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1938, '民权县', '411421', '4114', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1939, '睢县', '411422', '4114', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1940, '宁陵县', '411423', '4114', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1941, '柘城县', '411424', '4114', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1942, '虞城县', '411425', '4114', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1943, '夏邑县', '411426', '4114', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1944, '豫东综合物流产业聚集区', '411471', '4114', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1945, '河南商丘经济开发区', '411472', '4114', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1946, '永城市', '411481', '4114', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1947, '浉河区', '411502', '4115', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1948, '平桥区', '411503', '4115', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1949, '罗山县', '411521', '4115', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1950, '光山县', '411522', '4115', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1951, '新县', '411523', '4115', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1952, '商城县', '411524', '4115', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1953, '固始县', '411525', '4115', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1954, '潢川县', '411526', '4115', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1955, '淮滨县', '411527', '4115', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1956, '息县', '411528', '4115', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1957, '信阳高新技术产业开发区', '411571', '4115', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1958, '川汇区', '411602', '4116', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1959, '淮阳区', '411603', '4116', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1960, '扶沟县', '411621', '4116', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1961, '西华县', '411622', '4116', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1962, '商水县', '411623', '4116', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1963, '沈丘县', '411624', '4116', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1964, '郸城县', '411625', '4116', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1965, '太康县', '411627', '4116', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1966, '鹿邑县', '411628', '4116', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1967, '河南周口经济开发区', '411671', '4116', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1968, '项城市', '411681', '4116', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1969, '驿城区', '411702', '4117', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1970, '西平县', '411721', '4117', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1971, '上蔡县', '411722', '4117', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1972, '平舆县', '411723', '4117', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1973, '正阳县', '411724', '4117', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1974, '确山县', '411725', '4117', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1975, '泌阳县', '411726', '4117', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1976, '汝南县', '411727', '4117', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1977, '遂平县', '411728', '4117', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1978, '新蔡县', '411729', '4117', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1979, '河南驻马店经济开发区', '411771', '4117', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1980, '济源市', '419001', '4190', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1981, '江岸区', '420102', '4201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1982, '江汉区', '420103', '4201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1983, '硚口区', '420104', '4201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1984, '汉阳区', '420105', '4201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1985, '武昌区', '420106', '4201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1986, '青山区', '420107', '4201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1987, '洪山区', '420111', '4201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1988, '东西湖区', '420112', '4201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1989, '汉南区', '420113', '4201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1990, '蔡甸区', '420114', '4201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1991, '江夏区', '420115', '4201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1992, '黄陂区', '420116', '4201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1993, '新洲区', '420117', '4201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1994, '黄石港区', '420202', '4202', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1995, '西塞山区', '420203', '4202', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1996, '下陆区', '420204', '4202', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1997, '铁山区', '420205', '4202', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1998, '阳新县', '420222', '4202', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (1999, '大冶市', '420281', '4202', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2000, '茅箭区', '420302', '4203', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2001, '张湾区', '420303', '4203', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2002, '郧阳区', '420304', '4203', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2003, '郧西县', '420322', '4203', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2004, '竹山县', '420323', '4203', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2005, '竹溪县', '420324', '4203', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2006, '房县', '420325', '4203', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2007, '丹江口市', '420381', '4203', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2008, '西陵区', '420502', '4205', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2009, '伍家岗区', '420503', '4205', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2010, '点军区', '420504', '4205', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2011, '猇亭区', '420505', '4205', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2012, '夷陵区', '420506', '4205', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2013, '远安县', '420525', '4205', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2014, '兴山县', '420526', '4205', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2015, '秭归县', '420527', '4205', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2016, '长阳土家族自治县', '420528', '4205', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2017, '五峰土家族自治县', '420529', '4205', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2018, '宜都市', '420581', '4205', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2019, '当阳市', '420582', '4205', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2020, '枝江市', '420583', '4205', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2021, '襄城区', '420602', '4206', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2022, '樊城区', '420606', '4206', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2023, '襄州区', '420607', '4206', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2024, '南漳县', '420624', '4206', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2025, '谷城县', '420625', '4206', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2026, '保康县', '420626', '4206', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2027, '老河口市', '420682', '4206', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2028, '枣阳市', '420683', '4206', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2029, '宜城市', '420684', '4206', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2030, '梁子湖区', '420702', '4207', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2031, '华容区', '420703', '4207', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2032, '鄂城区', '420704', '4207', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2033, '东宝区', '420802', '4208', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2034, '掇刀区', '420804', '4208', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2035, '沙洋县', '420822', '4208', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2036, '钟祥市', '420881', '4208', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2037, '京山市', '420882', '4208', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2038, '孝南区', '420902', '4209', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2039, '孝昌县', '420921', '4209', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2040, '大悟县', '420922', '4209', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2041, '云梦县', '420923', '4209', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2042, '应城市', '420981', '4209', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2043, '安陆市', '420982', '4209', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2044, '汉川市', '420984', '4209', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2045, '沙市区', '421002', '4210', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2046, '荆州区', '421003', '4210', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2047, '公安县', '421022', '4210', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2048, '监利县', '421023', '4210', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2049, '江陵县', '421024', '4210', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2050, '荆州经济技术开发区', '421071', '4210', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2051, '石首市', '421081', '4210', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2052, '洪湖市', '421083', '4210', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2053, '松滋市', '421087', '4210', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2054, '黄州区', '421102', '4211', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2055, '团风县', '421121', '4211', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2056, '红安县', '421122', '4211', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2057, '罗田县', '421123', '4211', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2058, '英山县', '421124', '4211', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2059, '浠水县', '421125', '4211', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2060, '蕲春县', '421126', '4211', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2061, '黄梅县', '421127', '4211', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2062, '龙感湖管理区', '421171', '4211', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2063, '麻城市', '421181', '4211', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2064, '武穴市', '421182', '4211', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2065, '咸安区', '421202', '4212', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2066, '嘉鱼县', '421221', '4212', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2067, '通城县', '421222', '4212', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2068, '崇阳县', '421223', '4212', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2069, '通山县', '421224', '4212', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2070, '赤壁市', '421281', '4212', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2071, '曾都区', '421303', '4213', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2072, '随县', '421321', '4213', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2073, '广水市', '421381', '4213', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2074, '恩施市', '422801', '4228', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2075, '利川市', '422802', '4228', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2076, '建始县', '422822', '4228', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2077, '巴东县', '422823', '4228', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2078, '宣恩县', '422825', '4228', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2079, '咸丰县', '422826', '4228', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2080, '来凤县', '422827', '4228', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2081, '鹤峰县', '422828', '4228', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2082, '仙桃市', '429004', '4290', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2083, '潜江市', '429005', '4290', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2084, '天门市', '429006', '4290', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2085, '神农架林区', '429021', '4290', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2086, '芙蓉区', '430102', '4301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2087, '天心区', '430103', '4301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2088, '岳麓区', '430104', '4301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2089, '开福区', '430105', '4301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2090, '雨花区', '430111', '4301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2091, '望城区', '430112', '4301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2092, '长沙县', '430121', '4301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2093, '浏阳市', '430181', '4301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2094, '宁乡市', '430182', '4301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2095, '荷塘区', '430202', '4302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2096, '芦淞区', '430203', '4302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2097, '石峰区', '430204', '4302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2098, '天元区', '430211', '4302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2099, '渌口区', '430212', '4302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2100, '攸县', '430223', '4302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2101, '茶陵县', '430224', '4302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2102, '炎陵县', '430225', '4302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2103, '云龙示范区', '430271', '4302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2104, '醴陵市', '430281', '4302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2105, '雨湖区', '430302', '4303', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2106, '岳塘区', '430304', '4303', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2107, '湘潭县', '430321', '4303', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2108, '湖南湘潭高新技术产业园区', '430371', '4303', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2109, '湘潭昭山示范区', '430372', '4303', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2110, '湘潭九华示范区', '430373', '4303', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2111, '湘乡市', '430381', '4303', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2112, '韶山市', '430382', '4303', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2113, '珠晖区', '430405', '4304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2114, '雁峰区', '430406', '4304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2115, '石鼓区', '430407', '4304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2116, '蒸湘区', '430408', '4304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2117, '南岳区', '430412', '4304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2118, '衡阳县', '430421', '4304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2119, '衡南县', '430422', '4304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2120, '衡山县', '430423', '4304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2121, '衡东县', '430424', '4304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2122, '祁东县', '430426', '4304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2123, '衡阳综合保税区', '430471', '4304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2124, '湖南衡阳高新技术产业园区', '430472', '4304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2125, '湖南衡阳松木经济开发区', '430473', '4304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2126, '耒阳市', '430481', '4304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2127, '常宁市', '430482', '4304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2128, '双清区', '430502', '4305', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2129, '大祥区', '430503', '4305', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2130, '北塔区', '430511', '4305', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2131, '新邵县', '430522', '4305', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2132, '邵阳县', '430523', '4305', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2133, '隆回县', '430524', '4305', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2134, '洞口县', '430525', '4305', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2135, '绥宁县', '430527', '4305', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2136, '新宁县', '430528', '4305', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2137, '城步苗族自治县', '430529', '4305', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2138, '武冈市', '430581', '4305', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2139, '邵东市', '430582', '4305', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2140, '岳阳楼区', '430602', '4306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2141, '云溪区', '430603', '4306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2142, '君山区', '430611', '4306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2143, '岳阳县', '430621', '4306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2144, '华容县', '430623', '4306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2145, '湘阴县', '430624', '4306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2146, '平江县', '430626', '4306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2147, '岳阳市屈原管理区', '430671', '4306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2148, '汨罗市', '430681', '4306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2149, '临湘市', '430682', '4306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2150, '武陵区', '430702', '4307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2151, '鼎城区', '430703', '4307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2152, '安乡县', '430721', '4307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2153, '汉寿县', '430722', '4307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2154, '澧县', '430723', '4307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2155, '临澧县', '430724', '4307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2156, '桃源县', '430725', '4307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2157, '石门县', '430726', '4307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2158, '常德市西洞庭管理区', '430771', '4307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2159, '津市市', '430781', '4307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2160, '永定区', '430802', '4308', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2161, '武陵源区', '430811', '4308', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2162, '慈利县', '430821', '4308', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2163, '桑植县', '430822', '4308', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2164, '资阳区', '430902', '4309', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2165, '赫山区', '430903', '4309', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2166, '南县', '430921', '4309', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2167, '桃江县', '430922', '4309', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2168, '安化县', '430923', '4309', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2169, '益阳市大通湖管理区', '430971', '4309', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2170, '湖南益阳高新技术产业园区', '430972', '4309', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2171, '沅江市', '430981', '4309', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2172, '北湖区', '431002', '4310', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2173, '苏仙区', '431003', '4310', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2174, '桂阳县', '431021', '4310', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2175, '宜章县', '431022', '4310', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2176, '永兴县', '431023', '4310', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2177, '嘉禾县', '431024', '4310', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2178, '临武县', '431025', '4310', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2179, '汝城县', '431026', '4310', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2180, '桂东县', '431027', '4310', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2181, '安仁县', '431028', '4310', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2182, '资兴市', '431081', '4310', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2183, '零陵区', '431102', '4311', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2184, '冷水滩区', '431103', '4311', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2185, '祁阳县', '431121', '4311', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2186, '东安县', '431122', '4311', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2187, '双牌县', '431123', '4311', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2188, '道县', '431124', '4311', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2189, '江永县', '431125', '4311', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2190, '宁远县', '431126', '4311', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2191, '蓝山县', '431127', '4311', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2192, '新田县', '431128', '4311', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2193, '江华瑶族自治县', '431129', '4311', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2194, '永州经济技术开发区', '431171', '4311', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2195, '永州市金洞管理区', '431172', '4311', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2196, '永州市回龙圩管理区', '431173', '4311', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2197, '鹤城区', '431202', '4312', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2198, '中方县', '431221', '4312', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2199, '沅陵县', '431222', '4312', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2200, '辰溪县', '431223', '4312', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2201, '溆浦县', '431224', '4312', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2202, '会同县', '431225', '4312', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2203, '麻阳苗族自治县', '431226', '4312', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2204, '新晃侗族自治县', '431227', '4312', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2205, '芷江侗族自治县', '431228', '4312', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2206, '靖州苗族侗族自治县', '431229', '4312', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2207, '通道侗族自治县', '431230', '4312', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2208, '怀化市洪江管理区', '431271', '4312', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2209, '洪江市', '431281', '4312', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2210, '娄星区', '431302', '4313', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2211, '双峰县', '431321', '4313', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2212, '新化县', '431322', '4313', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2213, '冷水江市', '431381', '4313', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2214, '涟源市', '431382', '4313', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2215, '吉首市', '433101', '4331', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2216, '泸溪县', '433122', '4331', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2217, '凤凰县', '433123', '4331', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2218, '花垣县', '433124', '4331', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2219, '保靖县', '433125', '4331', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2220, '古丈县', '433126', '4331', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2221, '永顺县', '433127', '4331', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2222, '龙山县', '433130', '4331', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2223, '湖南永顺经济开发区', '433173', '4331', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2224, '荔湾区', '440103', '4401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2225, '越秀区', '440104', '4401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2226, '海珠区', '440105', '4401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2227, '天河区', '440106', '4401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2228, '白云区', '440111', '4401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2229, '黄埔区', '440112', '4401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2230, '番禺区', '440113', '4401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2231, '花都区', '440114', '4401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2232, '南沙区', '440115', '4401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2233, '从化区', '440117', '4401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2234, '增城区', '440118', '4401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2235, '武江区', '440203', '4402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2236, '浈江区', '440204', '4402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2237, '曲江区', '440205', '4402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2238, '始兴县', '440222', '4402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2239, '仁化县', '440224', '4402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2240, '翁源县', '440229', '4402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2241, '乳源瑶族自治县', '440232', '4402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2242, '新丰县', '440233', '4402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2243, '乐昌市', '440281', '4402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2244, '南雄市', '440282', '4402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2245, '罗湖区', '440303', '4403', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2246, '福田区', '440304', '4403', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2247, '南山区', '440305', '4403', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2248, '宝安区', '440306', '4403', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2249, '龙岗区', '440307', '4403', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2250, '盐田区', '440308', '4403', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2251, '龙华区', '440309', '4403', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2252, '坪山区', '440310', '4403', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2253, '光明区', '440311', '4403', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2254, '香洲区', '440402', '4404', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2255, '斗门区', '440403', '4404', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2256, '金湾区', '440404', '4404', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2257, '龙湖区', '440507', '4405', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2258, '金平区', '440511', '4405', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2259, '濠江区', '440512', '4405', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2260, '潮阳区', '440513', '4405', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2261, '潮南区', '440514', '4405', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2262, '澄海区', '440515', '4405', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2263, '南澳县', '440523', '4405', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2264, '禅城区', '440604', '4406', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2265, '南海区', '440605', '4406', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2266, '顺德区', '440606', '4406', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2267, '三水区', '440607', '4406', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2268, '高明区', '440608', '4406', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2269, '蓬江区', '440703', '4407', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2270, '江海区', '440704', '4407', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2271, '新会区', '440705', '4407', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2272, '台山市', '440781', '4407', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2273, '开平市', '440783', '4407', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2274, '鹤山市', '440784', '4407', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2275, '恩平市', '440785', '4407', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2276, '赤坎区', '440802', '4408', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2277, '霞山区', '440803', '4408', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2278, '坡头区', '440804', '4408', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2279, '麻章区', '440811', '4408', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2280, '遂溪县', '440823', '4408', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2281, '徐闻县', '440825', '4408', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2282, '廉江市', '440881', '4408', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2283, '雷州市', '440882', '4408', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2284, '吴川市', '440883', '4408', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2285, '茂南区', '440902', '4409', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2286, '电白区', '440904', '4409', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2287, '高州市', '440981', '4409', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2288, '化州市', '440982', '4409', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2289, '信宜市', '440983', '4409', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2290, '端州区', '441202', '4412', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2291, '鼎湖区', '441203', '4412', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2292, '高要区', '441204', '4412', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2293, '广宁县', '441223', '4412', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2294, '怀集县', '441224', '4412', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2295, '封开县', '441225', '4412', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2296, '德庆县', '441226', '4412', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2297, '四会市', '441284', '4412', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2298, '惠城区', '441302', '4413', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2299, '惠阳区', '441303', '4413', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2300, '博罗县', '441322', '4413', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2301, '惠东县', '441323', '4413', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2302, '龙门县', '441324', '4413', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2303, '梅江区', '441402', '4414', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2304, '梅县区', '441403', '4414', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2305, '大埔县', '441422', '4414', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2306, '丰顺县', '441423', '4414', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2307, '五华县', '441424', '4414', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2308, '平远县', '441426', '4414', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2309, '蕉岭县', '441427', '4414', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2310, '兴宁市', '441481', '4414', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2311, '城区', '441502', '4415', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2312, '海丰县', '441521', '4415', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2313, '陆河县', '441523', '4415', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2314, '陆丰市', '441581', '4415', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2315, '源城区', '441602', '4416', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2316, '紫金县', '441621', '4416', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2317, '龙川县', '441622', '4416', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2318, '连平县', '441623', '4416', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2319, '和平县', '441624', '4416', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2320, '东源县', '441625', '4416', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2321, '江城区', '441702', '4417', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2322, '阳东区', '441704', '4417', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2323, '阳西县', '441721', '4417', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2324, '阳春市', '441781', '4417', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2325, '清城区', '441802', '4418', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2326, '清新区', '441803', '4418', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2327, '佛冈县', '441821', '4418', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2328, '阳山县', '441823', '4418', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2329, '连山壮族瑶族自治县', '441825', '4418', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2330, '连南瑶族自治县', '441826', '4418', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2331, '英德市', '441881', '4418', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2332, '连州市', '441882', '4418', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2333, '东莞市', '441900', '4419', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2334, '中山市', '442000', '4420', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2335, '湘桥区', '445102', '4451', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2336, '潮安区', '445103', '4451', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2337, '饶平县', '445122', '4451', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2338, '榕城区', '445202', '4452', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2339, '揭东区', '445203', '4452', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2340, '揭西县', '445222', '4452', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2341, '惠来县', '445224', '4452', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2342, '普宁市', '445281', '4452', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2343, '云城区', '445302', '4453', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2344, '云安区', '445303', '4453', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2345, '新兴县', '445321', '4453', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2346, '郁南县', '445322', '4453', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2347, '罗定市', '445381', '4453', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2348, '兴宁区', '450102', '4501', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2349, '青秀区', '450103', '4501', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2350, '江南区', '450105', '4501', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2351, '西乡塘区', '450107', '4501', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2352, '良庆区', '450108', '4501', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2353, '邕宁区', '450109', '4501', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2354, '武鸣区', '450110', '4501', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2355, '隆安县', '450123', '4501', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2356, '马山县', '450124', '4501', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2357, '上林县', '450125', '4501', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2358, '宾阳县', '450126', '4501', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2359, '横县', '450127', '4501', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2360, '城中区', '450202', '4502', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2361, '鱼峰区', '450203', '4502', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2362, '柳南区', '450204', '4502', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2363, '柳北区', '450205', '4502', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2364, '柳江区', '450206', '4502', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2365, '柳城县', '450222', '4502', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2366, '鹿寨县', '450223', '4502', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2367, '融安县', '450224', '4502', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2368, '融水苗族自治县', '450225', '4502', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2369, '三江侗族自治县', '450226', '4502', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2370, '秀峰区', '450302', '4503', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2371, '叠彩区', '450303', '4503', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2372, '象山区', '450304', '4503', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2373, '七星区', '450305', '4503', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2374, '雁山区', '450311', '4503', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2375, '临桂区', '450312', '4503', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2376, '阳朔县', '450321', '4503', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2377, '灵川县', '450323', '4503', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2378, '全州县', '450324', '4503', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2379, '兴安县', '450325', '4503', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2380, '永福县', '450326', '4503', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2381, '灌阳县', '450327', '4503', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2382, '龙胜各族自治县', '450328', '4503', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2383, '资源县', '450329', '4503', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2384, '平乐县', '450330', '4503', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2385, '恭城瑶族自治县', '450332', '4503', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2386, '荔浦市', '450381', '4503', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2387, '万秀区', '450403', '4504', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2388, '长洲区', '450405', '4504', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2389, '龙圩区', '450406', '4504', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2390, '苍梧县', '450421', '4504', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2391, '藤县', '450422', '4504', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2392, '蒙山县', '450423', '4504', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2393, '岑溪市', '450481', '4504', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2394, '海城区', '450502', '4505', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2395, '银海区', '450503', '4505', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2396, '铁山港区', '450512', '4505', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2397, '合浦县', '450521', '4505', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2398, '港口区', '450602', '4506', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2399, '防城区', '450603', '4506', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2400, '上思县', '450621', '4506', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2401, '东兴市', '450681', '4506', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2402, '钦南区', '450702', '4507', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2403, '钦北区', '450703', '4507', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2404, '灵山县', '450721', '4507', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2405, '浦北县', '450722', '4507', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2406, '港北区', '450802', '4508', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2407, '港南区', '450803', '4508', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2408, '覃塘区', '450804', '4508', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2409, '平南县', '450821', '4508', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2410, '桂平市', '450881', '4508', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2411, '玉州区', '450902', '4509', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2412, '福绵区', '450903', '4509', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2413, '容县', '450921', '4509', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2414, '陆川县', '450922', '4509', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2415, '博白县', '450923', '4509', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2416, '兴业县', '450924', '4509', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2417, '北流市', '450981', '4509', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2418, '右江区', '451002', '4510', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2419, '田阳区', '451003', '4510', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2420, '田东县', '451022', '4510', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2421, '平果县', '451023', '4510', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2422, '德保县', '451024', '4510', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2423, '那坡县', '451026', '4510', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2424, '凌云县', '451027', '4510', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2425, '乐业县', '451028', '4510', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2426, '田林县', '451029', '4510', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2427, '西林县', '451030', '4510', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2428, '隆林各族自治县', '451031', '4510', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2429, '靖西市', '451081', '4510', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2430, '八步区', '451102', '4511', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2431, '平桂区', '451103', '4511', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2432, '昭平县', '451121', '4511', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2433, '钟山县', '451122', '4511', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2434, '富川瑶族自治县', '451123', '4511', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2435, '金城江区', '451202', '4512', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2436, '宜州区', '451203', '4512', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2437, '南丹县', '451221', '4512', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2438, '天峨县', '451222', '4512', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2439, '凤山县', '451223', '4512', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2440, '东兰县', '451224', '4512', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2441, '罗城仫佬族自治县', '451225', '4512', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2442, '环江毛南族自治县', '451226', '4512', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2443, '巴马瑶族自治县', '451227', '4512', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2444, '都安瑶族自治县', '451228', '4512', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2445, '大化瑶族自治县', '451229', '4512', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2446, '兴宾区', '451302', '4513', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2447, '忻城县', '451321', '4513', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2448, '象州县', '451322', '4513', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2449, '武宣县', '451323', '4513', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2450, '金秀瑶族自治县', '451324', '4513', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2451, '合山市', '451381', '4513', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2452, '江州区', '451402', '4514', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2453, '扶绥县', '451421', '4514', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2454, '宁明县', '451422', '4514', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2455, '龙州县', '451423', '4514', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2456, '大新县', '451424', '4514', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2457, '天等县', '451425', '4514', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2458, '凭祥市', '451481', '4514', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2459, '秀英区', '460105', '4601', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2460, '龙华区', '460106', '4601', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2461, '琼山区', '460107', '4601', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2462, '美兰区', '460108', '4601', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2463, '海棠区', '460202', '4602', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2464, '吉阳区', '460203', '4602', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2465, '天涯区', '460204', '4602', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2466, '崖州区', '460205', '4602', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2467, '西沙群岛', '460321', '4603', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2468, '南沙群岛', '460322', '4603', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2469, '中沙群岛的岛礁及其海域', '460323', '4603', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2470, '儋州市', '460400', '4604', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2471, '五指山市', '469001', '4690', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2472, '琼海市', '469002', '4690', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2473, '文昌市', '469005', '4690', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2474, '万宁市', '469006', '4690', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2475, '东方市', '469007', '4690', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2476, '定安县', '469021', '4690', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2477, '屯昌县', '469022', '4690', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2478, '澄迈县', '469023', '4690', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2479, '临高县', '469024', '4690', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2480, '白沙黎族自治县', '469025', '4690', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2481, '昌江黎族自治县', '469026', '4690', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2482, '乐东黎族自治县', '469027', '4690', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2483, '陵水黎族自治县', '469028', '4690', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2484, '保亭黎族苗族自治县', '469029', '4690', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2485, '琼中黎族苗族自治县', '469030', '4690', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2486, '万州区', '500101', '5001', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2487, '涪陵区', '500102', '5001', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2488, '渝中区', '500103', '5001', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2489, '大渡口区', '500104', '5001', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2490, '江北区', '500105', '5001', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2491, '沙坪坝区', '500106', '5001', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2492, '九龙坡区', '500107', '5001', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2493, '南岸区', '500108', '5001', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2494, '北碚区', '500109', '5001', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2495, '綦江区', '500110', '5001', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2496, '大足区', '500111', '5001', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2497, '渝北区', '500112', '5001', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2498, '巴南区', '500113', '5001', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2499, '黔江区', '500114', '5001', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2500, '长寿区', '500115', '5001', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2501, '江津区', '500116', '5001', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2502, '合川区', '500117', '5001', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2503, '永川区', '500118', '5001', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2504, '南川区', '500119', '5001', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2505, '璧山区', '500120', '5001', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2506, '铜梁区', '500151', '5001', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2507, '潼南区', '500152', '5001', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2508, '荣昌区', '500153', '5001', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2509, '开州区', '500154', '5001', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2510, '梁平区', '500155', '5001', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2511, '武隆区', '500156', '5001', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2512, '城口县', '500229', '5002', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2513, '丰都县', '500230', '5002', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2514, '垫江县', '500231', '5002', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2515, '忠县', '500233', '5002', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2516, '云阳县', '500235', '5002', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2517, '奉节县', '500236', '5002', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2518, '巫山县', '500237', '5002', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2519, '巫溪县', '500238', '5002', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2520, '石柱土家族自治县', '500240', '5002', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2521, '秀山土家族苗族自治县', '500241', '5002', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2522, '酉阳土家族苗族自治县', '500242', '5002', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2523, '彭水苗族土家族自治县', '500243', '5002', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2524, '锦江区', '510104', '5101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2525, '青羊区', '510105', '5101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2526, '金牛区', '510106', '5101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2527, '武侯区', '510107', '5101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2528, '成华区', '510108', '5101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2529, '龙泉驿区', '510112', '5101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2530, '青白江区', '510113', '5101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2531, '新都区', '510114', '5101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2532, '温江区', '510115', '5101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2533, '双流区', '510116', '5101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2534, '郫都区', '510117', '5101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2535, '金堂县', '510121', '5101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2536, '大邑县', '510129', '5101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2537, '蒲江县', '510131', '5101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2538, '新津县', '510132', '5101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2539, '都江堰市', '510181', '5101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2540, '彭州市', '510182', '5101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2541, '邛崃市', '510183', '5101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2542, '崇州市', '510184', '5101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2543, '简阳市', '510185', '5101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2544, '自流井区', '510302', '5103', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2545, '贡井区', '510303', '5103', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2546, '大安区', '510304', '5103', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2547, '沿滩区', '510311', '5103', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2548, '荣县', '510321', '5103', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2549, '富顺县', '510322', '5103', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2550, '东区', '510402', '5104', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2551, '西区', '510403', '5104', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2552, '仁和区', '510411', '5104', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2553, '米易县', '510421', '5104', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2554, '盐边县', '510422', '5104', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2555, '江阳区', '510502', '5105', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2556, '纳溪区', '510503', '5105', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2557, '龙马潭区', '510504', '5105', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2558, '泸县', '510521', '5105', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2559, '合江县', '510522', '5105', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2560, '叙永县', '510524', '5105', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2561, '古蔺县', '510525', '5105', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2562, '旌阳区', '510603', '5106', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2563, '罗江区', '510604', '5106', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2564, '中江县', '510623', '5106', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2565, '广汉市', '510681', '5106', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2566, '什邡市', '510682', '5106', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2567, '绵竹市', '510683', '5106', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2568, '涪城区', '510703', '5107', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2569, '游仙区', '510704', '5107', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2570, '安州区', '510705', '5107', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2571, '三台县', '510722', '5107', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2572, '盐亭县', '510723', '5107', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2573, '梓潼县', '510725', '5107', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2574, '北川羌族自治县', '510726', '5107', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2575, '平武县', '510727', '5107', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2576, '江油市', '510781', '5107', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2577, '利州区', '510802', '5108', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2578, '昭化区', '510811', '5108', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2579, '朝天区', '510812', '5108', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2580, '旺苍县', '510821', '5108', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2581, '青川县', '510822', '5108', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2582, '剑阁县', '510823', '5108', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2583, '苍溪县', '510824', '5108', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2584, '船山区', '510903', '5109', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2585, '安居区', '510904', '5109', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2586, '蓬溪县', '510921', '5109', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2587, '大英县', '510923', '5109', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2588, '射洪市', '510981', '5109', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2589, '市中区', '511002', '5110', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2590, '东兴区', '511011', '5110', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2591, '威远县', '511024', '5110', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2592, '资中县', '511025', '5110', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2593, '内江经济开发区', '511071', '5110', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2594, '隆昌市', '511083', '5110', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2595, '市中区', '511102', '5111', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2596, '沙湾区', '511111', '5111', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2597, '五通桥区', '511112', '5111', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2598, '金口河区', '511113', '5111', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2599, '犍为县', '511123', '5111', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2600, '井研县', '511124', '5111', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2601, '夹江县', '511126', '5111', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2602, '沐川县', '511129', '5111', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2603, '峨边彝族自治县', '511132', '5111', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2604, '马边彝族自治县', '511133', '5111', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2605, '峨眉山市', '511181', '5111', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2606, '顺庆区', '511302', '5113', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2607, '高坪区', '511303', '5113', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2608, '嘉陵区', '511304', '5113', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2609, '南部县', '511321', '5113', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2610, '营山县', '511322', '5113', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2611, '蓬安县', '511323', '5113', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2612, '仪陇县', '511324', '5113', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2613, '西充县', '511325', '5113', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2614, '阆中市', '511381', '5113', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2615, '东坡区', '511402', '5114', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2616, '彭山区', '511403', '5114', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2617, '仁寿县', '511421', '5114', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2618, '洪雅县', '511423', '5114', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2619, '丹棱县', '511424', '5114', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2620, '青神县', '511425', '5114', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2621, '翠屏区', '511502', '5115', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2622, '南溪区', '511503', '5115', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2623, '叙州区', '511504', '5115', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2624, '江安县', '511523', '5115', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2625, '长宁县', '511524', '5115', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2626, '高县', '511525', '5115', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2627, '珙县', '511526', '5115', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2628, '筠连县', '511527', '5115', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2629, '兴文县', '511528', '5115', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2630, '屏山县', '511529', '5115', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2631, '广安区', '511602', '5116', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2632, '前锋区', '511603', '5116', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2633, '岳池县', '511621', '5116', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2634, '武胜县', '511622', '5116', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2635, '邻水县', '511623', '5116', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2636, '华蓥市', '511681', '5116', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2637, '通川区', '511702', '5117', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2638, '达川区', '511703', '5117', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2639, '宣汉县', '511722', '5117', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2640, '开江县', '511723', '5117', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2641, '大竹县', '511724', '5117', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2642, '渠县', '511725', '5117', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2643, '达州经济开发区', '511771', '5117', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2644, '万源市', '511781', '5117', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2645, '雨城区', '511802', '5118', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2646, '名山区', '511803', '5118', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2647, '荥经县', '511822', '5118', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2648, '汉源县', '511823', '5118', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2649, '石棉县', '511824', '5118', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2650, '天全县', '511825', '5118', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2651, '芦山县', '511826', '5118', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2652, '宝兴县', '511827', '5118', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2653, '巴州区', '511902', '5119', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2654, '恩阳区', '511903', '5119', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2655, '通江县', '511921', '5119', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2656, '南江县', '511922', '5119', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2657, '平昌县', '511923', '5119', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2658, '巴中经济开发区', '511971', '5119', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2659, '雁江区', '512002', '5120', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2660, '安岳县', '512021', '5120', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2661, '乐至县', '512022', '5120', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2662, '马尔康市', '513201', '5132', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2663, '汶川县', '513221', '5132', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2664, '理县', '513222', '5132', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2665, '茂县', '513223', '5132', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2666, '松潘县', '513224', '5132', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2667, '九寨沟县', '513225', '5132', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2668, '金川县', '513226', '5132', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2669, '小金县', '513227', '5132', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2670, '黑水县', '513228', '5132', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2671, '壤塘县', '513230', '5132', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2672, '阿坝县', '513231', '5132', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2673, '若尔盖县', '513232', '5132', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2674, '红原县', '513233', '5132', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2675, '康定市', '513301', '5133', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2676, '泸定县', '513322', '5133', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2677, '丹巴县', '513323', '5133', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2678, '九龙县', '513324', '5133', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2679, '雅江县', '513325', '5133', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2680, '道孚县', '513326', '5133', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2681, '炉霍县', '513327', '5133', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2682, '甘孜县', '513328', '5133', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2683, '新龙县', '513329', '5133', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2684, '德格县', '513330', '5133', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2685, '白玉县', '513331', '5133', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2686, '石渠县', '513332', '5133', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2687, '色达县', '513333', '5133', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2688, '理塘县', '513334', '5133', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2689, '巴塘县', '513335', '5133', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2690, '乡城县', '513336', '5133', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2691, '稻城县', '513337', '5133', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2692, '得荣县', '513338', '5133', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2693, '西昌市', '513401', '5134', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2694, '木里藏族自治县', '513422', '5134', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2695, '盐源县', '513423', '5134', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2696, '德昌县', '513424', '5134', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2697, '会理县', '513425', '5134', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2698, '会东县', '513426', '5134', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2699, '宁南县', '513427', '5134', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2700, '普格县', '513428', '5134', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2701, '布拖县', '513429', '5134', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2702, '金阳县', '513430', '5134', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2703, '昭觉县', '513431', '5134', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2704, '喜德县', '513432', '5134', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2705, '冕宁县', '513433', '5134', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2706, '越西县', '513434', '5134', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2707, '甘洛县', '513435', '5134', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2708, '美姑县', '513436', '5134', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2709, '雷波县', '513437', '5134', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2710, '南明区', '520102', '5201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2711, '云岩区', '520103', '5201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2712, '花溪区', '520111', '5201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2713, '乌当区', '520112', '5201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2714, '白云区', '520113', '5201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2715, '观山湖区', '520115', '5201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2716, '开阳县', '520121', '5201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2717, '息烽县', '520122', '5201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2718, '修文县', '520123', '5201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2719, '清镇市', '520181', '5201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2720, '钟山区', '520201', '5202', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2721, '六枝特区', '520203', '5202', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2722, '水城县', '520221', '5202', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2723, '盘州市', '520281', '5202', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2724, '红花岗区', '520302', '5203', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2725, '汇川区', '520303', '5203', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2726, '播州区', '520304', '5203', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2727, '桐梓县', '520322', '5203', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2728, '绥阳县', '520323', '5203', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2729, '正安县', '520324', '5203', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2730, '道真仡佬族苗族自治县', '520325', '5203', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2731, '务川仡佬族苗族自治县', '520326', '5203', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2732, '凤冈县', '520327', '5203', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2733, '湄潭县', '520328', '5203', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2734, '余庆县', '520329', '5203', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2735, '习水县', '520330', '5203', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2736, '赤水市', '520381', '5203', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2737, '仁怀市', '520382', '5203', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2738, '西秀区', '520402', '5204', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2739, '平坝区', '520403', '5204', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2740, '普定县', '520422', '5204', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2741, '镇宁布依族苗族自治县', '520423', '5204', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2742, '关岭布依族苗族自治县', '520424', '5204', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2743, '紫云苗族布依族自治县', '520425', '5204', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2744, '七星关区', '520502', '5205', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2745, '大方县', '520521', '5205', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2746, '黔西县', '520522', '5205', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2747, '金沙县', '520523', '5205', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2748, '织金县', '520524', '5205', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2749, '纳雍县', '520525', '5205', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2750, '威宁彝族回族苗族自治县', '520526', '5205', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2751, '赫章县', '520527', '5205', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2752, '碧江区', '520602', '5206', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2753, '万山区', '520603', '5206', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2754, '江口县', '520621', '5206', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2755, '玉屏侗族自治县', '520622', '5206', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2756, '石阡县', '520623', '5206', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2757, '思南县', '520624', '5206', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2758, '印江土家族苗族自治县', '520625', '5206', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2759, '德江县', '520626', '5206', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2760, '沿河土家族自治县', '520627', '5206', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2761, '松桃苗族自治县', '520628', '5206', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2762, '兴义市', '522301', '5223', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2763, '兴仁市', '522302', '5223', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2764, '普安县', '522323', '5223', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2765, '晴隆县', '522324', '5223', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2766, '贞丰县', '522325', '5223', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2767, '望谟县', '522326', '5223', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2768, '册亨县', '522327', '5223', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2769, '安龙县', '522328', '5223', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2770, '凯里市', '522601', '5226', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2771, '黄平县', '522622', '5226', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2772, '施秉县', '522623', '5226', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2773, '三穗县', '522624', '5226', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2774, '镇远县', '522625', '5226', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2775, '岑巩县', '522626', '5226', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2776, '天柱县', '522627', '5226', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2777, '锦屏县', '522628', '5226', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2778, '剑河县', '522629', '5226', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2779, '台江县', '522630', '5226', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2780, '黎平县', '522631', '5226', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2781, '榕江县', '522632', '5226', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2782, '从江县', '522633', '5226', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2783, '雷山县', '522634', '5226', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2784, '麻江县', '522635', '5226', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2785, '丹寨县', '522636', '5226', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2786, '都匀市', '522701', '5227', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2787, '福泉市', '522702', '5227', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2788, '荔波县', '522722', '5227', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2789, '贵定县', '522723', '5227', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2790, '瓮安县', '522725', '5227', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2791, '独山县', '522726', '5227', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2792, '平塘县', '522727', '5227', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2793, '罗甸县', '522728', '5227', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2794, '长顺县', '522729', '5227', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2795, '龙里县', '522730', '5227', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2796, '惠水县', '522731', '5227', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2797, '三都水族自治县', '522732', '5227', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2798, '五华区', '530102', '5301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2799, '盘龙区', '530103', '5301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2800, '官渡区', '530111', '5301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2801, '西山区', '530112', '5301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2802, '东川区', '530113', '5301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2803, '呈贡区', '530114', '5301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2804, '晋宁区', '530115', '5301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2805, '富民县', '530124', '5301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2806, '宜良县', '530125', '5301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2807, '石林彝族自治县', '530126', '5301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2808, '嵩明县', '530127', '5301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2809, '禄劝彝族苗族自治县', '530128', '5301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2810, '寻甸回族彝族自治县', '530129', '5301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2811, '安宁市', '530181', '5301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2812, '麒麟区', '530302', '5303', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2813, '沾益区', '530303', '5303', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2814, '马龙区', '530304', '5303', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2815, '陆良县', '530322', '5303', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2816, '师宗县', '530323', '5303', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2817, '罗平县', '530324', '5303', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2818, '富源县', '530325', '5303', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2819, '会泽县', '530326', '5303', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2820, '宣威市', '530381', '5303', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2821, '红塔区', '530402', '5304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2822, '江川区', '530403', '5304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2823, '澄江县', '530422', '5304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2824, '通海县', '530423', '5304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2825, '华宁县', '530424', '5304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2826, '易门县', '530425', '5304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2827, '峨山彝族自治县', '530426', '5304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2828, '新平彝族傣族自治县', '530427', '5304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2829, '元江哈尼族彝族傣族自治县', '530428', '5304', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2830, '隆阳区', '530502', '5305', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2831, '施甸县', '530521', '5305', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2832, '龙陵县', '530523', '5305', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2833, '昌宁县', '530524', '5305', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2834, '腾冲市', '530581', '5305', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2835, '昭阳区', '530602', '5306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2836, '鲁甸县', '530621', '5306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2837, '巧家县', '530622', '5306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2838, '盐津县', '530623', '5306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2839, '大关县', '530624', '5306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2840, '永善县', '530625', '5306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2841, '绥江县', '530626', '5306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2842, '镇雄县', '530627', '5306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2843, '彝良县', '530628', '5306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2844, '威信县', '530629', '5306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2845, '水富市', '530681', '5306', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2846, '古城区', '530702', '5307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2847, '玉龙纳西族自治县', '530721', '5307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2848, '永胜县', '530722', '5307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2849, '华坪县', '530723', '5307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2850, '宁蒗彝族自治县', '530724', '5307', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2851, '思茅区', '530802', '5308', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2852, '宁洱哈尼族彝族自治县', '530821', '5308', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2853, '墨江哈尼族自治县', '530822', '5308', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2854, '景东彝族自治县', '530823', '5308', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2855, '景谷傣族彝族自治县', '530824', '5308', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2856, '镇沅彝族哈尼族拉祜族自治县', '530825', '5308', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2857, '江城哈尼族彝族自治县', '530826', '5308', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2858, '孟连傣族拉祜族佤族自治县', '530827', '5308', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2859, '澜沧拉祜族自治县', '530828', '5308', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2860, '西盟佤族自治县', '530829', '5308', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2861, '临翔区', '530902', '5309', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2862, '凤庆县', '530921', '5309', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2863, '云县', '530922', '5309', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2864, '永德县', '530923', '5309', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2865, '镇康县', '530924', '5309', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2866, '双江拉祜族佤族布朗族傣族自治县', '530925', '5309', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2867, '耿马傣族佤族自治县', '530926', '5309', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2868, '沧源佤族自治县', '530927', '5309', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2869, '楚雄市', '532301', '5323', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2870, '双柏县', '532322', '5323', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2871, '牟定县', '532323', '5323', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2872, '南华县', '532324', '5323', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2873, '姚安县', '532325', '5323', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2874, '大姚县', '532326', '5323', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2875, '永仁县', '532327', '5323', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2876, '元谋县', '532328', '5323', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2877, '武定县', '532329', '5323', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2878, '禄丰县', '532331', '5323', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2879, '个旧市', '532501', '5325', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2880, '开远市', '532502', '5325', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2881, '蒙自市', '532503', '5325', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2882, '弥勒市', '532504', '5325', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2883, '屏边苗族自治县', '532523', '5325', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2884, '建水县', '532524', '5325', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2885, '石屏县', '532525', '5325', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2886, '泸西县', '532527', '5325', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2887, '元阳县', '532528', '5325', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2888, '红河县', '532529', '5325', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2889, '金平苗族瑶族傣族自治县', '532530', '5325', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2890, '绿春县', '532531', '5325', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2891, '河口瑶族自治县', '532532', '5325', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2892, '文山市', '532601', '5326', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2893, '砚山县', '532622', '5326', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2894, '西畴县', '532623', '5326', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2895, '麻栗坡县', '532624', '5326', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2896, '马关县', '532625', '5326', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2897, '丘北县', '532626', '5326', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2898, '广南县', '532627', '5326', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2899, '富宁县', '532628', '5326', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2900, '景洪市', '532801', '5328', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2901, '勐海县', '532822', '5328', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2902, '勐腊县', '532823', '5328', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2903, '大理市', '532901', '5329', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2904, '漾濞彝族自治县', '532922', '5329', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2905, '祥云县', '532923', '5329', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2906, '宾川县', '532924', '5329', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2907, '弥渡县', '532925', '5329', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2908, '南涧彝族自治县', '532926', '5329', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2909, '巍山彝族回族自治县', '532927', '5329', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2910, '永平县', '532928', '5329', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2911, '云龙县', '532929', '5329', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2912, '洱源县', '532930', '5329', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2913, '剑川县', '532931', '5329', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2914, '鹤庆县', '532932', '5329', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2915, '瑞丽市', '533102', '5331', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2916, '芒市', '533103', '5331', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2917, '梁河县', '533122', '5331', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2918, '盈江县', '533123', '5331', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2919, '陇川县', '533124', '5331', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2920, '泸水市', '533301', '5333', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2921, '福贡县', '533323', '5333', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2922, '贡山独龙族怒族自治县', '533324', '5333', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2923, '兰坪白族普米族自治县', '533325', '5333', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2924, '香格里拉市', '533401', '5334', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2925, '德钦县', '533422', '5334', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2926, '维西傈僳族自治县', '533423', '5334', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2927, '城关区', '540102', '5401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2928, '堆龙德庆区', '540103', '5401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2929, '达孜区', '540104', '5401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2930, '林周县', '540121', '5401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2931, '当雄县', '540122', '5401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2932, '尼木县', '540123', '5401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2933, '曲水县', '540124', '5401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2934, '墨竹工卡县', '540127', '5401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2935, '格尔木藏青工业园区', '540171', '5401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2936, '拉萨经济技术开发区', '540172', '5401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2937, '西藏文化旅游创意园区', '540173', '5401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2938, '达孜工业园区', '540174', '5401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2939, '桑珠孜区', '540202', '5402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2940, '南木林县', '540221', '5402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2941, '江孜县', '540222', '5402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2942, '定日县', '540223', '5402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2943, '萨迦县', '540224', '5402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2944, '拉孜县', '540225', '5402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2945, '昂仁县', '540226', '5402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2946, '谢通门县', '540227', '5402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2947, '白朗县', '540228', '5402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2948, '仁布县', '540229', '5402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2949, '康马县', '540230', '5402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2950, '定结县', '540231', '5402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2951, '仲巴县', '540232', '5402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2952, '亚东县', '540233', '5402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2953, '吉隆县', '540234', '5402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2954, '聂拉木县', '540235', '5402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2955, '萨嘎县', '540236', '5402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2956, '岗巴县', '540237', '5402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2957, '卡若区', '540302', '5403', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2958, '江达县', '540321', '5403', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2959, '贡觉县', '540322', '5403', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2960, '类乌齐县', '540323', '5403', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2961, '丁青县', '540324', '5403', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2962, '察雅县', '540325', '5403', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2963, '八宿县', '540326', '5403', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2964, '左贡县', '540327', '5403', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2965, '芒康县', '540328', '5403', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2966, '洛隆县', '540329', '5403', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2967, '边坝县', '540330', '5403', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2968, '巴宜区', '540402', '5404', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2969, '工布江达县', '540421', '5404', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2970, '米林县', '540422', '5404', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2971, '墨脱县', '540423', '5404', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2972, '波密县', '540424', '5404', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2973, '察隅县', '540425', '5404', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2974, '朗县', '540426', '5404', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2975, '乃东区', '540502', '5405', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2976, '扎囊县', '540521', '5405', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2977, '贡嘎县', '540522', '5405', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2978, '桑日县', '540523', '5405', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2979, '琼结县', '540524', '5405', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2980, '曲松县', '540525', '5405', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2981, '措美县', '540526', '5405', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2982, '洛扎县', '540527', '5405', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2983, '加查县', '540528', '5405', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2984, '隆子县', '540529', '5405', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2985, '错那县', '540530', '5405', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2986, '浪卡子县', '540531', '5405', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2987, '色尼区', '540602', '5406', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2988, '嘉黎县', '540621', '5406', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2989, '比如县', '540622', '5406', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2990, '聂荣县', '540623', '5406', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2991, '安多县', '540624', '5406', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2992, '申扎县', '540625', '5406', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2993, '索县', '540626', '5406', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2994, '班戈县', '540627', '5406', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2995, '巴青县', '540628', '5406', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2996, '尼玛县', '540629', '5406', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2997, '双湖县', '540630', '5406', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2998, '普兰县', '542521', '5425', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (2999, '札达县', '542522', '5425', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3000, '噶尔县', '542523', '5425', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3001, '日土县', '542524', '5425', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3002, '革吉县', '542525', '5425', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3003, '改则县', '542526', '5425', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3004, '措勤县', '542527', '5425', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3005, '新城区', '610102', '6101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3006, '碑林区', '610103', '6101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3007, '莲湖区', '610104', '6101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3008, '灞桥区', '610111', '6101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3009, '未央区', '610112', '6101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3010, '雁塔区', '610113', '6101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3011, '阎良区', '610114', '6101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3012, '临潼区', '610115', '6101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3013, '长安区', '610116', '6101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3014, '高陵区', '610117', '6101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3015, '鄠邑区', '610118', '6101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3016, '蓝田县', '610122', '6101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3017, '周至县', '610124', '6101', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3018, '王益区', '610202', '6102', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3019, '印台区', '610203', '6102', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3020, '耀州区', '610204', '6102', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3021, '宜君县', '610222', '6102', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3022, '渭滨区', '610302', '6103', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3023, '金台区', '610303', '6103', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3024, '陈仓区', '610304', '6103', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3025, '凤翔县', '610322', '6103', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3026, '岐山县', '610323', '6103', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3027, '扶风县', '610324', '6103', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3028, '眉县', '610326', '6103', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3029, '陇县', '610327', '6103', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3030, '千阳县', '610328', '6103', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3031, '麟游县', '610329', '6103', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3032, '凤县', '610330', '6103', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3033, '太白县', '610331', '6103', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3034, '秦都区', '610402', '6104', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3035, '杨陵区', '610403', '6104', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3036, '渭城区', '610404', '6104', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3037, '三原县', '610422', '6104', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3038, '泾阳县', '610423', '6104', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3039, '乾县', '610424', '6104', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3040, '礼泉县', '610425', '6104', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3041, '永寿县', '610426', '6104', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3042, '长武县', '610428', '6104', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3043, '旬邑县', '610429', '6104', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3044, '淳化县', '610430', '6104', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3045, '武功县', '610431', '6104', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3046, '兴平市', '610481', '6104', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3047, '彬州市', '610482', '6104', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3048, '临渭区', '610502', '6105', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3049, '华州区', '610503', '6105', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3050, '潼关县', '610522', '6105', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3051, '大荔县', '610523', '6105', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3052, '合阳县', '610524', '6105', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3053, '澄城县', '610525', '6105', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3054, '蒲城县', '610526', '6105', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3055, '白水县', '610527', '6105', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3056, '富平县', '610528', '6105', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3057, '韩城市', '610581', '6105', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3058, '华阴市', '610582', '6105', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3059, '宝塔区', '610602', '6106', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3060, '安塞区', '610603', '6106', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3061, '延长县', '610621', '6106', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3062, '延川县', '610622', '6106', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3063, '志丹县', '610625', '6106', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3064, '吴起县', '610626', '6106', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3065, '甘泉县', '610627', '6106', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3066, '富县', '610628', '6106', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3067, '洛川县', '610629', '6106', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3068, '宜川县', '610630', '6106', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3069, '黄龙县', '610631', '6106', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3070, '黄陵县', '610632', '6106', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3071, '子长市', '610681', '6106', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3072, '汉台区', '610702', '6107', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3073, '南郑区', '610703', '6107', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3074, '城固县', '610722', '6107', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3075, '洋县', '610723', '6107', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3076, '西乡县', '610724', '6107', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3077, '勉县', '610725', '6107', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3078, '宁强县', '610726', '6107', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3079, '略阳县', '610727', '6107', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3080, '镇巴县', '610728', '6107', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3081, '留坝县', '610729', '6107', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3082, '佛坪县', '610730', '6107', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3083, '榆阳区', '610802', '6108', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3084, '横山区', '610803', '6108', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3085, '府谷县', '610822', '6108', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3086, '靖边县', '610824', '6108', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3087, '定边县', '610825', '6108', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3088, '绥德县', '610826', '6108', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3089, '米脂县', '610827', '6108', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3090, '佳县', '610828', '6108', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3091, '吴堡县', '610829', '6108', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3092, '清涧县', '610830', '6108', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3093, '子洲县', '610831', '6108', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3094, '神木市', '610881', '6108', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3095, '汉滨区', '610902', '6109', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3096, '汉阴县', '610921', '6109', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3097, '石泉县', '610922', '6109', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3098, '宁陕县', '610923', '6109', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3099, '紫阳县', '610924', '6109', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3100, '岚皋县', '610925', '6109', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3101, '平利县', '610926', '6109', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3102, '镇坪县', '610927', '6109', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3103, '旬阳县', '610928', '6109', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3104, '白河县', '610929', '6109', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3105, '商州区', '611002', '6110', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3106, '洛南县', '611021', '6110', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3107, '丹凤县', '611022', '6110', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3108, '商南县', '611023', '6110', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3109, '山阳县', '611024', '6110', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3110, '镇安县', '611025', '6110', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3111, '柞水县', '611026', '6110', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3112, '城关区', '620102', '6201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3113, '七里河区', '620103', '6201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3114, '西固区', '620104', '6201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3115, '安宁区', '620105', '6201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3116, '红古区', '620111', '6201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3117, '永登县', '620121', '6201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3118, '皋兰县', '620122', '6201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3119, '榆中县', '620123', '6201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3120, '兰州新区', '620171', '6201', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3121, '嘉峪关市', '620201', '6202', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3122, '金川区', '620302', '6203', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3123, '永昌县', '620321', '6203', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3124, '白银区', '620402', '6204', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3125, '平川区', '620403', '6204', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3126, '靖远县', '620421', '6204', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3127, '会宁县', '620422', '6204', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3128, '景泰县', '620423', '6204', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3129, '秦州区', '620502', '6205', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3130, '麦积区', '620503', '6205', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3131, '清水县', '620521', '6205', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3132, '秦安县', '620522', '6205', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3133, '甘谷县', '620523', '6205', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3134, '武山县', '620524', '6205', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3135, '张家川回族自治县', '620525', '6205', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3136, '凉州区', '620602', '6206', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3137, '民勤县', '620621', '6206', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3138, '古浪县', '620622', '6206', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3139, '天祝藏族自治县', '620623', '6206', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3140, '甘州区', '620702', '6207', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3141, '肃南裕固族自治县', '620721', '6207', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3142, '民乐县', '620722', '6207', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3143, '临泽县', '620723', '6207', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3144, '高台县', '620724', '6207', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3145, '山丹县', '620725', '6207', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3146, '崆峒区', '620802', '6208', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3147, '泾川县', '620821', '6208', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3148, '灵台县', '620822', '6208', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3149, '崇信县', '620823', '6208', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3150, '庄浪县', '620825', '6208', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3151, '静宁县', '620826', '6208', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3152, '华亭市', '620881', '6208', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3153, '肃州区', '620902', '6209', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3154, '金塔县', '620921', '6209', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3155, '瓜州县', '620922', '6209', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3156, '肃北蒙古族自治县', '620923', '6209', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3157, '阿克塞哈萨克族自治县', '620924', '6209', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3158, '玉门市', '620981', '6209', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3159, '敦煌市', '620982', '6209', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3160, '西峰区', '621002', '6210', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3161, '庆城县', '621021', '6210', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3162, '环县', '621022', '6210', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3163, '华池县', '621023', '6210', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3164, '合水县', '621024', '6210', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3165, '正宁县', '621025', '6210', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3166, '宁县', '621026', '6210', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3167, '镇原县', '621027', '6210', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3168, '安定区', '621102', '6211', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3169, '通渭县', '621121', '6211', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3170, '陇西县', '621122', '6211', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3171, '渭源县', '621123', '6211', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3172, '临洮县', '621124', '6211', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3173, '漳县', '621125', '6211', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3174, '岷县', '621126', '6211', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3175, '武都区', '621202', '6212', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3176, '成县', '621221', '6212', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3177, '文县', '621222', '6212', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3178, '宕昌县', '621223', '6212', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3179, '康县', '621224', '6212', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3180, '西和县', '621225', '6212', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3181, '礼县', '621226', '6212', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3182, '徽县', '621227', '6212', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3183, '两当县', '621228', '6212', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3184, '临夏市', '622901', '6229', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3185, '临夏县', '622921', '6229', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3186, '康乐县', '622922', '6229', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3187, '永靖县', '622923', '6229', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3188, '广河县', '622924', '6229', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3189, '和政县', '622925', '6229', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3190, '东乡族自治县', '622926', '6229', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3191, '积石山保安族东乡族撒拉族自治县', '622927', '6229', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3192, '合作市', '623001', '6230', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3193, '临潭县', '623021', '6230', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3194, '卓尼县', '623022', '6230', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3195, '舟曲县', '623023', '6230', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3196, '迭部县', '623024', '6230', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3197, '玛曲县', '623025', '6230', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3198, '碌曲县', '623026', '6230', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3199, '夏河县', '623027', '6230', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3200, '城东区', '630102', '6301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3201, '城中区', '630103', '6301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3202, '城西区', '630104', '6301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3203, '城北区', '630105', '6301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3204, '大通回族土族自治县', '630121', '6301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3205, '湟中县', '630122', '6301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3206, '湟源县', '630123', '6301', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3207, '乐都区', '630202', '6302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3208, '平安区', '630203', '6302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3209, '民和回族土族自治县', '630222', '6302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3210, '互助土族自治县', '630223', '6302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3211, '化隆回族自治县', '630224', '6302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3212, '循化撒拉族自治县', '630225', '6302', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3213, '门源回族自治县', '632221', '6322', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3214, '祁连县', '632222', '6322', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3215, '海晏县', '632223', '6322', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3216, '刚察县', '632224', '6322', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3217, '同仁县', '632321', '6323', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3218, '尖扎县', '632322', '6323', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3219, '泽库县', '632323', '6323', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3220, '河南蒙古族自治县', '632324', '6323', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3221, '共和县', '632521', '6325', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3222, '同德县', '632522', '6325', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3223, '贵德县', '632523', '6325', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3224, '兴海县', '632524', '6325', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3225, '贵南县', '632525', '6325', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3226, '玛沁县', '632621', '6326', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3227, '班玛县', '632622', '6326', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3228, '甘德县', '632623', '6326', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3229, '达日县', '632624', '6326', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3230, '久治县', '632625', '6326', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3231, '玛多县', '632626', '6326', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3232, '玉树市', '632701', '6327', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3233, '杂多县', '632722', '6327', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3234, '称多县', '632723', '6327', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3235, '治多县', '632724', '6327', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3236, '囊谦县', '632725', '6327', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3237, '曲麻莱县', '632726', '6327', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3238, '格尔木市', '632801', '6328', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3239, '德令哈市', '632802', '6328', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3240, '茫崖市', '632803', '6328', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3241, '乌兰县', '632821', '6328', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3242, '都兰县', '632822', '6328', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3243, '天峻县', '632823', '6328', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3244, '大柴旦行政委员会', '632857', '6328', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3245, '兴庆区', '640104', '6401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3246, '西夏区', '640105', '6401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3247, '金凤区', '640106', '6401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3248, '永宁县', '640121', '6401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3249, '贺兰县', '640122', '6401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3250, '灵武市', '640181', '6401', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3251, '大武口区', '640202', '6402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3252, '惠农区', '640205', '6402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3253, '平罗县', '640221', '6402', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3254, '利通区', '640302', '6403', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3255, '红寺堡区', '640303', '6403', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3256, '盐池县', '640323', '6403', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3257, '同心县', '640324', '6403', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3258, '青铜峡市', '640381', '6403', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3259, '原州区', '640402', '6404', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3260, '西吉县', '640422', '6404', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3261, '隆德县', '640423', '6404', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3262, '泾源县', '640424', '6404', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3263, '彭阳县', '640425', '6404', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3264, '沙坡头区', '640502', '6405', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3265, '中宁县', '640521', '6405', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3266, '海原县', '640522', '6405', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3267, '天山区', '650102', '6501', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3268, '沙依巴克区', '650103', '6501', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3269, '新市区', '650104', '6501', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3270, '水磨沟区', '650105', '6501', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3271, '头屯河区', '650106', '6501', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3272, '达坂城区', '650107', '6501', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3273, '米东区', '650109', '6501', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3274, '乌鲁木齐县', '650121', '6501', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3275, '独山子区', '650202', '6502', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3276, '克拉玛依区', '650203', '6502', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3277, '白碱滩区', '650204', '6502', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3278, '乌尔禾区', '650205', '6502', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3279, '高昌区', '650402', '6504', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3280, '鄯善县', '650421', '6504', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3281, '托克逊县', '650422', '6504', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3282, '伊州区', '650502', '6505', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3283, '巴里坤哈萨克自治县', '650521', '6505', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3284, '伊吾县', '650522', '6505', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3285, '昌吉市', '652301', '6523', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3286, '阜康市', '652302', '6523', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3287, '呼图壁县', '652323', '6523', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3288, '玛纳斯县', '652324', '6523', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3289, '奇台县', '652325', '6523', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3290, '吉木萨尔县', '652327', '6523', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3291, '木垒哈萨克自治县', '652328', '6523', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3292, '博乐市', '652701', '6527', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3293, '阿拉山口市', '652702', '6527', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3294, '精河县', '652722', '6527', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3295, '温泉县', '652723', '6527', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3296, '库尔勒市', '652801', '6528', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3297, '轮台县', '652822', '6528', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3298, '尉犁县', '652823', '6528', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3299, '若羌县', '652824', '6528', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3300, '且末县', '652825', '6528', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3301, '焉耆回族自治县', '652826', '6528', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3302, '和静县', '652827', '6528', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3303, '和硕县', '652828', '6528', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3304, '博湖县', '652829', '6528', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3305, '库尔勒经济技术开发区', '652871', '6528', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3306, '阿克苏市', '652901', '6529', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3307, '温宿县', '652922', '6529', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3308, '库车县', '652923', '6529', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3309, '沙雅县', '652924', '6529', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3310, '新和县', '652925', '6529', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3311, '拜城县', '652926', '6529', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3312, '乌什县', '652927', '6529', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3313, '阿瓦提县', '652928', '6529', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3314, '柯坪县', '652929', '6529', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3315, '阿图什市', '653001', '6530', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3316, '阿克陶县', '653022', '6530', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3317, '阿合奇县', '653023', '6530', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3318, '乌恰县', '653024', '6530', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3319, '喀什市', '653101', '6531', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3320, '疏附县', '653121', '6531', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3321, '疏勒县', '653122', '6531', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3322, '英吉沙县', '653123', '6531', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3323, '泽普县', '653124', '6531', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3324, '莎车县', '653125', '6531', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3325, '叶城县', '653126', '6531', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3326, '麦盖提县', '653127', '6531', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3327, '岳普湖县', '653128', '6531', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3328, '伽师县', '653129', '6531', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3329, '巴楚县', '653130', '6531', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3330, '塔什库尔干塔吉克自治县', '653131', '6531', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3331, '和田市', '653201', '6532', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3332, '和田县', '653221', '6532', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3333, '墨玉县', '653222', '6532', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3334, '皮山县', '653223', '6532', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3335, '洛浦县', '653224', '6532', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3336, '策勒县', '653225', '6532', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3337, '于田县', '653226', '6532', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3338, '民丰县', '653227', '6532', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3339, '伊宁市', '654002', '6540', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3340, '奎屯市', '654003', '6540', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3341, '霍尔果斯市', '654004', '6540', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3342, '伊宁县', '654021', '6540', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3343, '察布查尔锡伯自治县', '654022', '6540', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3344, '霍城县', '654023', '6540', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3345, '巩留县', '654024', '6540', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3346, '新源县', '654025', '6540', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3347, '昭苏县', '654026', '6540', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3348, '特克斯县', '654027', '6540', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3349, '尼勒克县', '654028', '6540', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3350, '塔城市', '654201', '6542', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3351, '乌苏市', '654202', '6542', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3352, '额敏县', '654221', '6542', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3353, '沙湾县', '654223', '6542', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3354, '托里县', '654224', '6542', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3355, '裕民县', '654225', '6542', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3356, '和布克赛尔蒙古自治县', '654226', '6542', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3357, '阿勒泰市', '654301', '6543', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3358, '布尔津县', '654321', '6543', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3359, '富蕴县', '654322', '6543', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3360, '福海县', '654323', '6543', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3361, '哈巴河县', '654324', '6543', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3362, '青河县', '654325', '6543', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3363, '吉木乃县', '654326', '6543', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3364, '石河子市', '659001', '6590', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3365, '阿拉尔市', '659002', '6590', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3366, '图木舒克市', '659003', '6590', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3367, '五家渠市', '659004', '6590', 3, '1', 100, NULL, NULL);
INSERT INTO `b5net_area` VALUES (3368, '铁门关市', '659006', '6590', 3, '1', 100, NULL, NULL);

-- ----------------------------
-- Table structure for b5net_config
-- ----------------------------
DROP TABLE IF EXISTS `b5net_config`;
CREATE TABLE `b5net_config`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '配置ID',
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '配置名称',
  `type` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '配置标识',
  `style` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '配置类型',
  `is_sys` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0' COMMENT '是否系统内置 0否 1是',
  `groups` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '配置分组',
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '配置值',
  `extra` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '配置项',
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '配置说明',
  `create_time` datetime NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `type`(`type`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '系统配置表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of b5net_config
-- ----------------------------
INSERT INTO `b5net_config` VALUES (1, '配置分组', 'sys_config_group', 'array', '1', '', 'site:基本设置\r\nwx:微信设置\r\nsms:短信配置\r\nemail:邮箱配置\r\nimgwater:图片水印', '', '', '2020-12-31 14:01:18', '2022-03-22 20:45:21');
INSERT INTO `b5net_config` VALUES (2, '系统名称', 'sys_config_sysname', 'text', '1', 'site', 'B5YiiCMF', '', '系统后台显示的名称', '2020-12-31 14:01:18', '2022-03-23 12:41:01');
INSERT INTO `b5net_config` VALUES (4, '阿里accessKeyId', 'sms_ali_key', 'text', '0', 'sms', '', '', '阿里短信-AccessKey ID', '2021-01-11 19:26:13', '2021-01-17 21:27:04');
INSERT INTO `b5net_config` VALUES (5, '阿里accessSecret', 'sms_ali_secret', 'text', '0', 'sms', '', '', '阿里短信-AccessKey Secret', '2021-01-11 19:26:45', '2021-01-17 21:27:04');
INSERT INTO `b5net_config` VALUES (6, '阿里signName', 'sms_ali_signname', 'text', '0', 'sms', '', '', '阿里短信-签名', '2021-01-11 19:27:53', '2021-01-17 21:27:04');
INSERT INTO `b5net_config` VALUES (7, '阿里tempId', 'sms_ali_temp', 'text', '0', 'sms', '', '', '阿里短信-tempId模板', '2021-01-11 19:30:21', '2021-01-17 21:27:04');
INSERT INTO `b5net_config` VALUES (10, '公众号appid', 'wechat_appid', 'text', '0', 'wx', 'wx2ba634598c7df708', '', '微信公众号的AppId', '2021-01-12 11:05:50', '2021-03-27 23:06:59');
INSERT INTO `b5net_config` VALUES (11, '公众号secret', 'wechat_appsecret', 'text', '0', 'wx', 'e82cdf89c396b1dd88f1632eaf70fb2d', '', '微信公众号-AppSecret', '2021-01-12 11:06:24', '2021-03-27 23:06:59');
INSERT INTO `b5net_config` VALUES (12, '服务地址', 'sys_email_host', 'text', '0', 'email', 'smtp.163.com', '', '类似:smtp.163.com', '2021-01-22 15:28:10', '2021-01-23 13:03:59');
INSERT INTO `b5net_config` VALUES (13, '邮箱地址', 'sys_email_username', 'text', '0', 'email', 'lyyd_lh@163.com', '', '发送邮件的邮箱地址', '2021-01-22 15:28:39', '2021-01-23 13:03:59');
INSERT INTO `b5net_config` VALUES (14, '授权密码', 'sys_email_password', 'text', '0', 'email', 'STTLQFEMOIGAOGVI', '', '', '2021-01-22 15:29:34', '2021-01-23 13:03:59');
INSERT INTO `b5net_config` VALUES (15, '服务端口', 'sys_email_port', 'text', '0', 'email', '465', '', '', '2021-01-22 15:30:05', '2021-01-23 13:03:59');
INSERT INTO `b5net_config` VALUES (16, '是否SSL', 'sys_email_ssl', 'select', '0', 'email', '1', '0:否\r\n1:是', '', '2021-01-22 15:31:23', '2021-01-23 13:03:59');
INSERT INTO `b5net_config` VALUES (17, '网站标题', 'web_site_name', 'text', '0', 'site', 'XXXXXX公司', '', '', '2021-03-24 15:09:24', '2022-03-21 16:28:31');
INSERT INTO `b5net_config` VALUES (18, '水印文字', 'img_water_text', 'text', '0', 'imgwater', 'B5YiiCMF', '', '', '2021-07-29 20:44:32', '2022-03-21 13:26:25');
INSERT INTO `b5net_config` VALUES (19, '水印文字大小', 'img_water_text_font', 'text', '0', 'imgwater', '20', '', '', '2021-07-29 20:44:48', '2022-03-21 13:26:25');
INSERT INTO `b5net_config` VALUES (20, '水印文字颜色', 'img_water_text_color', 'text', '0', 'imgwater', 'ff0000', '', '', '2021-07-29 20:45:03', '2022-03-21 13:26:25');
INSERT INTO `b5net_config` VALUES (21, '水印位置', 'img_water_text_position', 'select', '0', 'imgwater', '1', '1:左上角\r\n3:右上角\r\n5:垂直水平居中\r\n7:左下角\r\n9:右下角', '对应think-image的水印位置 1-9', '2021-07-29 20:45:28', '2022-03-21 13:26:25');
INSERT INTO `b5net_config` VALUES (22, '是否演示模式', 'demo_mode', 'select', '0', '', '1', '1:是\r\n0:否', '', '2022-03-21 16:17:48', '2022-03-21 16:17:48');

-- ----------------------------
-- Table structure for b5net_dict_data
-- ----------------------------
DROP TABLE IF EXISTS `b5net_dict_data`;
CREATE TABLE `b5net_dict_data`  (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `title` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '字典标签',
  `value` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '字典键值',
  `type` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '字典类型',
  `list_sort` int NOT NULL DEFAULT 0 COMMENT '字典排序',
  `list_class` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '表格回显样式',
  `css_class` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '样式属性',
  `is_default` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'N' COMMENT '是否默认（Y是 N否）',
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '备注',
  `status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1' COMMENT '状态（1正常 0停用）',
  `create_time` datetime NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 100 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '字典数据表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of b5net_dict_data
-- ----------------------------
INSERT INTO `b5net_dict_data` VALUES (1, '男', '1', 'sys_user_sex', 1, 'default', '', 'Y', '性别男', '0', '2023-05-12 10:40:01', '2024-03-12 16:51:03');
INSERT INTO `b5net_dict_data` VALUES (2, '女', '2', 'sys_user_sex', 2, 'default', '', 'N', '性别女', '0', '2023-05-12 10:40:01', '2024-03-12 16:51:00');
INSERT INTO `b5net_dict_data` VALUES (3, '未知', '3', 'sys_user_sex', 3, 'default', '', 'N', '性别未知', '0', '2023-05-12 10:40:01', '2024-03-12 16:50:57');
INSERT INTO `b5net_dict_data` VALUES (6, '正常', '1', 'sys_normal_disable', 1, 'primary', '', 'Y', '正常状态', '1', '2023-05-12 10:40:01', '2024-03-12 16:51:26');
INSERT INTO `b5net_dict_data` VALUES (7, '停用', '0', 'sys_normal_disable', 2, 'danger', '', 'N', '停用状态', '1', '2023-05-12 10:40:01', '2024-03-12 16:51:28');
INSERT INTO `b5net_dict_data` VALUES (14, '通知', '1', 'sys_notice_type', 1, 'warning', NULL, 'Y', '通知', '0', '2023-05-12 10:40:01', NULL);
INSERT INTO `b5net_dict_data` VALUES (15, '公告', '2', 'sys_notice_type', 2, 'success', NULL, 'N', '公告', '0', '2023-05-12 10:40:01', NULL);
INSERT INTO `b5net_dict_data` VALUES (16, '正常', '1', 'sys_notice_status', 1, 'primary', NULL, 'Y', '正常状态', '1', '2023-05-12 10:40:01', NULL);
INSERT INTO `b5net_dict_data` VALUES (17, '关闭', '0', 'sys_notice_status', 2, 'danger', NULL, 'N', '关闭状态', '1', '2023-05-12 10:40:01', NULL);

-- ----------------------------
-- Table structure for b5net_dict_type
-- ----------------------------
DROP TABLE IF EXISTS `b5net_dict_type`;
CREATE TABLE `b5net_dict_type`  (
  `id` bigint NOT NULL AUTO_INCREMENT COMMENT '字典主键',
  `name` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '字典名称',
  `type` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '字典类型',
  `status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1' COMMENT '状态（1正常 0停用）',
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '备注',
  `create_time` datetime NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `dict_type`(`type`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 100 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '字典类型表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of b5net_dict_type
-- ----------------------------
INSERT INTO `b5net_dict_type` VALUES (1, '用户性别', 'sys_user_sex', '1', '用户性别列表', '2023-05-12 10:40:01', '2024-03-12 15:50:22');
INSERT INTO `b5net_dict_type` VALUES (3, '系统开关', 'sys_normal_disable', '1', '系统开关列表', '2023-05-12 10:40:01', '2024-03-12 16:50:22');
INSERT INTO `b5net_dict_type` VALUES (7, '通知类型', 'sys_notice_type', '1', '通知类型列表', '2023-05-12 10:40:01', '2024-03-12 16:50:19');
INSERT INTO `b5net_dict_type` VALUES (8, '通知状态', 'sys_notice_status', '1', '通知状态列表', '2023-05-12 10:40:01', '2024-03-12 16:50:25');

-- ----------------------------
-- Table structure for b5net_login_log
-- ----------------------------
DROP TABLE IF EXISTS `b5net_login_log`;
CREATE TABLE `b5net_login_log`  (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '访问ID',
  `login_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '登录账号',
  `ipaddr` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '登录IP地址',
  `login_location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '登录地点',
  `browser` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '浏览器类型',
  `os` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '操作系统',
  `net` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0' COMMENT '登录状态（0成功 1失败）',
  `msg` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '提示消息',
  `create_time` datetime NULL DEFAULT NULL COMMENT '访问时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 64 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '系统访问记录' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of b5net_login_log
-- ----------------------------
INSERT INTO `b5net_login_log` VALUES (1, 'admin', '127.0.0.1', '本机地址', 'Chrome 99.0.4844.74', 'Windows 10.0', '', '1', '登录成功', NULL);
INSERT INTO `b5net_login_log` VALUES (2, 'admin', '127.0.0.1', '本机地址', 'Chrome 99.0.4844.74', 'Windows 10.0', '', '1', '登录成功', NULL);
INSERT INTO `b5net_login_log` VALUES (3, 'admin', '127.0.0.1', '本机地址', 'Chrome 99.0.4844.74', 'Windows 10.0', '', '0', '验证码不正确。', NULL);
INSERT INTO `b5net_login_log` VALUES (4, 'admin', '127.0.0.1', '本机地址', 'Chrome 99.0.4844.74', 'Windows 10.0', '', '1', '登录成功', NULL);
INSERT INTO `b5net_login_log` VALUES (5, 'admin', '127.0.0.1', '本机地址', 'Chrome 99.0.4844.74', 'Windows 10.0', '', '1', '登录成功', NULL);
INSERT INTO `b5net_login_log` VALUES (6, 'admin', '127.0.0.1', '本机地址', 'Chrome 99.0.4844.74', 'Windows 10.0', '', '1', '登录成功', NULL);
INSERT INTO `b5net_login_log` VALUES (7, 'admin', '127.0.0.1', '本机地址', 'Chrome 99.0.4844.74', 'Windows 10.0', '', '0', '验证码不正确。', NULL);
INSERT INTO `b5net_login_log` VALUES (8, 'admin', '127.0.0.1', '本机地址', 'Chrome 99.0.4844.74', 'Windows 10.0', '', '1', '登录成功', NULL);
INSERT INTO `b5net_login_log` VALUES (9, 'admin', '127.0.0.1', '本机地址', 'IE 11.0', 'Windows 10.0', '', '0', '验证码不正确。', NULL);
INSERT INTO `b5net_login_log` VALUES (10, 'admin', '127.0.0.1', '本机地址', 'IE 11.0', 'Windows 10.0', '', '0', '验证码不正确。', NULL);
INSERT INTO `b5net_login_log` VALUES (11, 'admin', '127.0.0.1', '本机地址', 'IE 11.0', 'Windows 10.0', '', '1', '登录成功', NULL);
INSERT INTO `b5net_login_log` VALUES (12, 'admin', '127.0.0.1', '本机地址', 'IE 10.0', 'Windows 10.0', '', '1', '登录成功', NULL);
INSERT INTO `b5net_login_log` VALUES (13, 'admin', '127.0.0.1', '本机地址', 'Chrome 99.0.4844.74', 'Windows 10.0', '', '1', '登录成功', NULL);
INSERT INTO `b5net_login_log` VALUES (14, 'admin', '127.0.0.1', '本机地址', 'IE 10.0', 'Windows 10.0', '', '1', '登录成功', NULL);
INSERT INTO `b5net_login_log` VALUES (15, 'admin', '127.0.0.1', '本机地址', 'IE 9.0', 'Windows 10.0', '', '0', '验证码不正确。', NULL);
INSERT INTO `b5net_login_log` VALUES (16, 'admin', '127.0.0.1', '本机地址', 'IE 9.0', 'Windows 10.0', '', '0', '验证码不正确。', NULL);
INSERT INTO `b5net_login_log` VALUES (17, 'admin', '127.0.0.1', '本机地址', 'IE 9.0', 'Windows 10.0', '', '0', '验证码不正确。', NULL);
INSERT INTO `b5net_login_log` VALUES (18, 'admin', '127.0.0.1', '本机地址', 'IE 9.0', 'Windows 10.0', '', '0', '验证码不正确。', NULL);
INSERT INTO `b5net_login_log` VALUES (19, 'admin', '127.0.0.1', '本机地址', 'IE 9.0', 'Windows 10.0', '', '0', '验证码不正确。', NULL);
INSERT INTO `b5net_login_log` VALUES (20, 'asdadas', '127.0.0.1', '本机地址', 'Chrome 99.0.4844.74', 'Windows 10.0', '', '0', '验证码不正确。', NULL);
INSERT INTO `b5net_login_log` VALUES (21, 'asdadas', '127.0.0.1', '本机地址', 'Chrome 99.0.4844.74', 'Windows 10.0', '', '0', '验证码不正确。', NULL);
INSERT INTO `b5net_login_log` VALUES (22, 'asdadas', '127.0.0.1', '本机地址', 'Chrome 99.0.4844.74', 'Windows 10.0', '', '0', '验证码不正确。', NULL);
INSERT INTO `b5net_login_log` VALUES (23, 'asdad', '127.0.0.1', '本机地址', 'IE 9.0', 'Windows 10.0', '', '0', '验证码不正确。', NULL);
INSERT INTO `b5net_login_log` VALUES (24, 'admin', '127.0.0.1', '本机地址', 'IE 9.0', 'Windows 10.0', '', '1', '登录成功', NULL);
INSERT INTO `b5net_login_log` VALUES (25, 'admin', '127.0.0.1', '本机地址', 'Chrome 108.0.0.0', 'Windows 10.0', '', '1', '登录成功', NULL);
INSERT INTO `b5net_login_log` VALUES (26, 'admin', '127.0.0.1', '本机地址', 'Chrome 108.0.0.0', 'Windows 10.0', '', '1', '登录成功', NULL);
INSERT INTO `b5net_login_log` VALUES (27, 'admin', '127.0.0.1', '本机地址', 'IE 9.0', 'Windows 10.0', '', '1', '登录成功', NULL);
INSERT INTO `b5net_login_log` VALUES (28, 'admin', '127.0.0.1', '本机地址', 'Chrome 108.0.0.0', 'Windows 10.0', '', '1', '登录成功', NULL);
INSERT INTO `b5net_login_log` VALUES (29, 'admin', '127.0.0.1', '本机地址', 'Chrome 94.0.4606.71', 'Windows 10.0', '', '1', '登录成功', NULL);
INSERT INTO `b5net_login_log` VALUES (30, 'admin', '127.0.0.1', '本机地址', 'Chrome 108.0.0.0', 'Windows 10.0', '', '1', '登录成功', NULL);
INSERT INTO `b5net_login_log` VALUES (31, 'admin', '127.0.0.1', '本机地址', 'Chrome 108.0.0.0', 'Windows 10.0', '', '1', '登录成功', NULL);
INSERT INTO `b5net_login_log` VALUES (32, 'admin', '127.0.0.1', '本机地址', 'Chrome 108.0.0.0', 'Windows 10.0', '', '1', '登录成功', NULL);
INSERT INTO `b5net_login_log` VALUES (33, 'admin', '127.0.0.1', '本机地址', 'Chrome 108.0.0.0', 'Windows 10.0', '', '1', '登录成功', NULL);
INSERT INTO `b5net_login_log` VALUES (34, 'admin', '127.0.0.1', '本机地址', 'Chrome 108.0.0.0', 'Windows 10.0', '', '1', '登录成功', NULL);
INSERT INTO `b5net_login_log` VALUES (35, 'admin', '127.0.0.1', '本机地址', 'Chrome 108.0.0.0', 'Windows 10.0', '', '1', '登录成功', NULL);
INSERT INTO `b5net_login_log` VALUES (36, 'admin', '127.0.0.1', '本机地址', 'Chrome 108.0.0.0', 'Windows 10.0', '', '1', '登录成功', NULL);
INSERT INTO `b5net_login_log` VALUES (37, 'admin', '127.0.0.1', '本机地址', 'Chrome 108.0.0.0', 'Windows 10.0', '', '1', '登录成功', NULL);
INSERT INTO `b5net_login_log` VALUES (38, 'admin', '127.0.0.1', '本机地址', 'Chrome 108.0.0.0', 'Windows 10.0', '', '1', '登录成功', NULL);
INSERT INTO `b5net_login_log` VALUES (39, 'admin', '127.0.0.1', '本机地址', 'Chrome 113.0.0.0', 'Windows 10.0', '', '1', '登录成功', NULL);
INSERT INTO `b5net_login_log` VALUES (40, 'admin', '127.0.0.1', '本机地址', 'Chrome 113.0.0.0', 'Windows 10.0', '', '1', '登录成功', NULL);
INSERT INTO `b5net_login_log` VALUES (41, 'admin', '127.0.0.1', '本机地址', 'Chrome 113.0.0.0', 'Windows 10.0', '', '1', '登录成功', NULL);
INSERT INTO `b5net_login_log` VALUES (42, 'admin', '127.0.0.1', '本机地址', 'Chrome 113.0.0.0', 'Windows 10.0', '', '1', '登录成功', NULL);
INSERT INTO `b5net_login_log` VALUES (43, 'admin', '127.0.0.1', '本机地址', 'Chrome 113.0.0.0', 'Windows 10.0', '', '1', '登录成功', NULL);
INSERT INTO `b5net_login_log` VALUES (44, 'admin', '127.0.0.1', '本机地址', 'Chrome 113.0.0.0', 'Windows 10.0', '', '1', '登录成功', NULL);
INSERT INTO `b5net_login_log` VALUES (45, 'admin', '127.0.0.1', '本机地址', 'Chrome 113.0.0.0', 'Windows 10.0', '', '1', '登录成功', NULL);
INSERT INTO `b5net_login_log` VALUES (46, 'admin', '127.0.0.1', '本机地址', 'Chrome 113.0.0.0', 'Windows 10.0', '', '1', '登录成功', NULL);
INSERT INTO `b5net_login_log` VALUES (47, 'admin', '127.0.0.1', '本机地址', 'Chrome 113.0.0.0', 'Windows 10.0', '', '1', '登录成功', NULL);
INSERT INTO `b5net_login_log` VALUES (48, 'admin', '127.0.0.1', '本机地址', 'Chrome 113.0.0.0', 'Windows 10.0', '', '1', '登录成功', NULL);
INSERT INTO `b5net_login_log` VALUES (49, 'admin', '127.0.0.1', '本机地址', 'Chrome 113.0.0.0', 'Windows 10.0', '', '1', '登录成功', NULL);
INSERT INTO `b5net_login_log` VALUES (50, 'admin', '127.0.0.1', '本机地址', 'Chrome 113.0.0.0', 'Windows 10.0', '', '1', '登录成功', NULL);
INSERT INTO `b5net_login_log` VALUES (51, 'admin', '127.0.0.1', '本机地址', 'Chrome 113.0.0.0', 'Windows 10.0', '', '1', '登录成功', NULL);
INSERT INTO `b5net_login_log` VALUES (52, 'admin', '127.0.0.1', '本机地址', 'Chrome 113.0.0.0', 'Windows 10.0', '', '1', '登录成功', NULL);
INSERT INTO `b5net_login_log` VALUES (53, 'admin', '127.0.0.1', '本机地址', 'Chrome 113.0.0.0', 'Windows 10.0', '', '1', '登录成功', NULL);
INSERT INTO `b5net_login_log` VALUES (54, 'admin', '127.0.0.1', '本机地址', 'Chrome 113.0.0.0', 'Windows 10.0', '', '1', '登录成功', NULL);
INSERT INTO `b5net_login_log` VALUES (55, 'admin', '127.0.0.1', '本机地址', 'Chrome 113.0.0.0', 'Windows 10.0', '', '1', '登录成功', NULL);
INSERT INTO `b5net_login_log` VALUES (56, 'admin', '127.0.0.1', '本机地址', 'Chrome 113.0.0.0', 'Windows 10.0', '', '0', '验证码不正确。', NULL);
INSERT INTO `b5net_login_log` VALUES (57, 'admin', '127.0.0.1', '本机地址', 'Chrome 113.0.0.0', 'Windows 10.0', '', '1', '登录成功', NULL);
INSERT INTO `b5net_login_log` VALUES (58, 'admin', '127.0.0.1', '本机地址', 'Chrome 113.0.0.0', 'Windows 10.0', '', '1', '登录成功', NULL);
INSERT INTO `b5net_login_log` VALUES (59, 'admin', '127.0.0.1', '本机地址', 'Chrome 113.0.0.0', 'Windows 10.0', '', '1', '登录成功', NULL);
INSERT INTO `b5net_login_log` VALUES (60, 'admin', '127.0.0.1', '本机地址', 'Chrome 113.0.0.0', 'Windows 10.0', '', '1', '登录成功', NULL);
INSERT INTO `b5net_login_log` VALUES (61, 'admin', '127.0.0.1', '本机地址', 'Chrome 113.0.0.0', 'Windows 10.0', '', '1', '登录成功', NULL);
INSERT INTO `b5net_login_log` VALUES (62, 'admin', '127.0.0.1', '本机地址', 'Chrome 113.0.0.0', 'Windows 10.0', '', '1', '登录成功', '2023-09-08 09:13:03');
INSERT INTO `b5net_login_log` VALUES (63, 'admin', '127.0.0.1', '本机地址', 'Chrome 117.0.0.0', 'Windows 10.0', '', '1', '登录成功', '2024-03-12 14:13:20');

-- ----------------------------
-- Table structure for b5net_menu
-- ----------------------------
DROP TABLE IF EXISTS `b5net_menu`;
CREATE TABLE `b5net_menu`  (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '菜单ID',
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '菜单名称',
  `parent_id` int NOT NULL DEFAULT 0 COMMENT '父菜单ID',
  `list_sort` int NOT NULL DEFAULT 0 COMMENT '显示顺序',
  `url` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '请求地址',
  `target` tinyint(1) NOT NULL DEFAULT 0 COMMENT '打开方式（0页签 1新窗口）',
  `type` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '菜单类型（M目录 C菜单 F按钮）',
  `status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1' COMMENT '菜单状态（1显示 0隐藏）',
  `is_refresh` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0' COMMENT '是否刷新（0不刷新 1刷新）',
  `perms` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '权限标识',
  `icon` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '菜单图标',
  `note` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '备注',
  `create_time` datetime NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `parent_id`(`parent_id`) USING BTREE,
  INDEX `listsort`(`list_sort`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15205 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '菜单权限表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of b5net_menu
-- ----------------------------
INSERT INTO `b5net_menu` VALUES (1, '系统管理', 0, 10, '', 0, 'M', '1', '0', '', 'fa fa-cog', '系统管理', '2021-01-03 07:25:11', '2022-03-20 16:00:14');
INSERT INTO `b5net_menu` VALUES (2, '权限管理', 0, 20, '', 0, 'M', '1', '0', '', 'fa fa-id-card-o', '权限管理', '2021-01-03 07:25:11', '2022-03-20 16:00:10');
INSERT INTO `b5net_menu` VALUES (3, '系统工具', 0, 30, '', 0, 'M', '1', '0', '', 'fa fa-cloud', '', '2021-07-29 20:28:41', '2022-03-20 15:59:55');
INSERT INTO `b5net_menu` VALUES (90, '官方网站', 0, 99, 'http://www.b5net.com', 1, 'C', '1', '0', '', 'fa fa-send', '官方网站', '2021-01-05 12:05:30', '2021-01-18 17:07:15');
INSERT INTO `b5net_menu` VALUES (100, '人员管理', 2, 1, 'system/admin/index', 0, 'C', '1', '0', 'system:admin:index', 'fa fa-user-o', '人员管理', '2021-01-03 07:25:11', '2022-03-20 16:02:24');
INSERT INTO `b5net_menu` VALUES (101, '角色管理', 2, 2, 'system/role/index', 0, 'C', '1', '0', 'system:role:index', 'fa fa-address-book-o', '角色管理', '2021-01-03 07:25:11', '2021-01-03 07:25:11');
INSERT INTO `b5net_menu` VALUES (102, '组织架构', 2, 3, 'system/struct/index', 0, 'C', '1', '0', 'system:struct:index', 'fa fa-sitemap', '组织架构', '2021-01-03 07:25:11', '2021-01-03 07:25:11');
INSERT INTO `b5net_menu` VALUES (103, '菜单管理', 2, 4, 'system/menu/index', 0, 'C', '1', '0', 'system:menu:index', 'fa fa-server', '菜单管理', '2021-01-03 07:25:11', '2021-01-03 07:25:11');
INSERT INTO `b5net_menu` VALUES (104, '登录日志', 2, 5, 'system/login-log/index', 0, 'C', '1', '0', 'system:login-log:index', 'fa fa-paw', '登录日志', '2021-01-03 07:25:11', '2021-01-07 12:54:43');
INSERT INTO `b5net_menu` VALUES (105, '参数配置', 1, 1, 'system/config/index', 0, 'C', '1', '0', 'system:config:index', 'fa fa-sliders', '参数配置', '2021-01-03 07:25:11', '2021-01-05 12:20:56');
INSERT INTO `b5net_menu` VALUES (106, '网站设置', 1, 0, 'system/config/site', 0, 'C', '1', '0', 'system:config:site', 'fa fa-object-group', '网站设置', '2021-01-11 22:17:31', '2021-01-11 22:39:46');
INSERT INTO `b5net_menu` VALUES (107, '通知公告', 1, 10, 'notice/index', 0, 'C', '1', '0', 'notice:index', 'fa fa-bullhorn', '通知公告', '2021-01-03 07:25:11', '2021-03-17 14:05:34');
INSERT INTO `b5net_menu` VALUES (108, '岗位管理', 1, 2, 'system/position/index', 0, 'C', '1', '0', 'system:position:index', '', '', NULL, NULL);
INSERT INTO `b5net_menu` VALUES (109, '字典管理', 1, 6, 'system/dict-type/index', 0, 'C', '1', '0', 'system:dict-type:index', '', '', NULL, NULL);
INSERT INTO `b5net_menu` VALUES (110, '区划管理', 1, 1, 'system/area/index', 0, 'C', '1', '0', 'system:area:index', '', '', NULL, NULL);
INSERT INTO `b5net_menu` VALUES (150, '代码生成', 3, 3, 'demo/tool/create', 0, 'C', '1', '0', 'demo:tool:create', '', '', '2021-07-29 20:29:15', '2021-07-29 20:29:15');
INSERT INTO `b5net_menu` VALUES (151, '表单构建', 3, 2, 'demo/tool/build', 0, 'C', '1', '0', 'demo:tool:build', '', '', '2021-07-29 20:29:15', '2021-07-29 20:29:15');
INSERT INTO `b5net_menu` VALUES (152, '图片操作', 3, 1, 'demo/media/index', 0, 'C', '1', '0', 'demo:media:index', '', '', '2021-07-29 20:29:15', '2021-07-29 20:29:15');
INSERT INTO `b5net_menu` VALUES (10000, '用户新增', 100, 1, '', 0, 'F', '1', '0', 'system:admin:add', '', '用户新增', '2021-01-03 07:25:11', '2021-01-03 07:25:11');
INSERT INTO `b5net_menu` VALUES (10001, '用户修改', 100, 2, '', 0, 'F', '1', '0', 'system:admin:edit', '', '用户修改', '2021-01-03 07:25:11', '2021-01-03 07:25:11');
INSERT INTO `b5net_menu` VALUES (10002, '用户删除', 100, 3, '', 0, 'F', '1', '0', 'system:admin:drop', '', '用户删除', '2021-01-03 07:25:11', '2021-01-03 07:25:11');
INSERT INTO `b5net_menu` VALUES (10004, '用户状态', 100, 4, '', 0, 'F', '1', '0', 'system:admin:setstatus', '', '用户状态', '2021-01-03 07:25:11', '2021-01-08 10:47:09');
INSERT INTO `b5net_menu` VALUES (10100, '角色新增', 101, 1, '', 0, 'F', '1', '0', 'system:role:add', '', '角色新增', '2021-01-03 07:25:11', '2021-01-03 07:25:11');
INSERT INTO `b5net_menu` VALUES (10101, '角色修改', 101, 2, '', 0, 'F', '1', '0', 'system:role:edit', '', '角色修改', '2021-01-03 07:25:11', '2021-01-03 07:25:11');
INSERT INTO `b5net_menu` VALUES (10102, '角色删除', 101, 3, '', 0, 'F', '1', '0', 'system:role:drop', '', '角色删除', '2021-01-03 07:25:11', '2021-01-03 07:25:11');
INSERT INTO `b5net_menu` VALUES (10104, '角色状态', 101, 4, '', 0, 'F', '1', '0', 'system:role:setstatus', '', '角色状态', '2021-01-03 07:25:11', '2021-01-08 10:47:31');
INSERT INTO `b5net_menu` VALUES (10105, '菜单授权', 101, 10, '', 0, 'F', '1', '0', 'system:role:auth', '', '菜单授权', '2021-01-03 07:25:11', '2021-01-07 13:32:41');
INSERT INTO `b5net_menu` VALUES (10106, '数据权限', 101, 11, '', 0, 'F', '1', '0', 'system:role:datascope', '', '数据权限', '2021-01-03 07:25:11', '2021-01-03 07:25:11');
INSERT INTO `b5net_menu` VALUES (10200, '组织新增', 102, 1, '', 0, 'F', '1', '0', 'system:struct:add', '', '组织新增', '2021-01-03 07:25:11', '2021-01-03 07:25:11');
INSERT INTO `b5net_menu` VALUES (10201, '组织修改', 102, 2, '', 0, 'F', '1', '0', 'system:struct:edit', '', '组织修改', '2021-01-03 07:25:11', '2021-01-03 07:25:11');
INSERT INTO `b5net_menu` VALUES (10202, '组织删除', 102, 3, '', 0, 'F', '1', '0', 'system:struct:drop', '', '组织删除', '2021-01-03 07:25:11', '2021-01-03 07:25:11');
INSERT INTO `b5net_menu` VALUES (10300, '菜单新增', 103, 1, '', 0, 'F', '1', '0', 'system:menu:add', '', '菜单新增', '2021-01-03 07:25:11', '2021-01-03 07:25:11');
INSERT INTO `b5net_menu` VALUES (10301, '菜单修改', 103, 2, '', 0, 'F', '1', '0', 'system:menu:edit', '', '菜单修改', '2021-01-03 07:25:11', '2021-01-03 07:25:11');
INSERT INTO `b5net_menu` VALUES (10302, '菜单删除', 103, 3, '', 0, 'F', '1', '0', 'system:menu:drop', '', '菜单删除', '2021-01-03 07:25:11', '2021-01-03 07:25:11');
INSERT INTO `b5net_menu` VALUES (10400, '日志删除', 104, 0, '', 0, 'F', '1', '0', 'system:loginlog:drop', '', '日志删除', '2021-01-07 13:03:15', '2021-01-07 13:03:15');
INSERT INTO `b5net_menu` VALUES (10401, '日志清空', 104, 0, '', 0, 'F', '1', '0', 'system:loginlog:trash', '', '日志清空', '2021-01-07 13:04:06', '2021-01-07 13:04:06');
INSERT INTO `b5net_menu` VALUES (10500, '参数新增', 105, 1, '', 0, 'F', '1', '0', 'system:config:add', '', '参数新增', '2021-01-03 07:25:11', '2021-01-05 06:00:02');
INSERT INTO `b5net_menu` VALUES (10501, '参数修改', 105, 2, '', 0, 'F', '1', '0', 'system:config:edit', '', '参数修改', '2021-01-03 07:25:11', '2021-01-05 06:00:25');
INSERT INTO `b5net_menu` VALUES (10502, '参数删除', 105, 3, '', 0, 'F', '1', '0', 'system:config:drop', '', '参数删除', '2021-01-03 07:25:11', '2021-01-05 06:00:59');
INSERT INTO `b5net_menu` VALUES (10503, '参数批量删除', 105, 4, '', 0, 'F', '1', '0', 'system:config:dropall', '', '参数批量删除', '2021-01-03 07:25:11', '2021-01-03 07:25:11');
INSERT INTO `b5net_menu` VALUES (10504, '清除缓存', 105, 5, '', 0, 'F', '1', '0', 'system:config:delcache', '', '清除缓存', '2021-01-03 07:25:11', '2021-01-08 10:46:47');
INSERT INTO `b5net_menu` VALUES (10700, '公告新增', 107, 1, '', 0, 'F', '1', '0', 'notice:add', '', '公告新增', '2021-01-03 07:25:11', '2021-01-03 07:25:11');
INSERT INTO `b5net_menu` VALUES (10701, '公告修改', 107, 2, '', 0, 'F', '1', '0', 'notice:edit', '', '公告修改', '2021-01-03 07:25:11', '2021-01-03 07:25:11');
INSERT INTO `b5net_menu` VALUES (10702, '公告删除', 107, 3, '', 0, 'F', '1', '0', 'notice:drop', '', '公告删除', '2021-01-03 07:25:11', '2021-01-03 07:25:11');
INSERT INTO `b5net_menu` VALUES (10703, '公告批量删除', 107, 4, '', 0, 'F', '1', '0', 'notice:dropall', '', '公告批量删除', '2021-01-03 07:25:11', '2021-01-03 07:25:11');
INSERT INTO `b5net_menu` VALUES (10801, '添加岗位', 108, 1, '', 0, 'F', '1', '0', 'system:position:index', '', '', NULL, NULL);
INSERT INTO `b5net_menu` VALUES (10802, '编辑岗位', 108, 2, '', 0, 'F', '1', '0', 'system:position:add', '', '', NULL, NULL);
INSERT INTO `b5net_menu` VALUES (10803, '删除岗位', 108, 3, '', 0, 'F', '1', '0', 'system:position:dropall', '', '', NULL, NULL);
INSERT INTO `b5net_menu` VALUES (10901, '字典类型新增', 109, 1, '', 0, 'F', '1', '0', 'system:dict-type:add', '', '', NULL, NULL);
INSERT INTO `b5net_menu` VALUES (10902, '字典类型编辑', 109, 2, '', 0, 'F', '1', '0', 'system:dict-type:edit', '', '', NULL, NULL);
INSERT INTO `b5net_menu` VALUES (10903, '字典类型删除', 109, 3, '', 0, 'F', '1', '0', 'system:dict-type:drop', '', '', NULL, NULL);
INSERT INTO `b5net_menu` VALUES (10904, '字典类型批量删除', 109, 4, '', 0, 'F', '1', '0', 'system:dict-type:dropall', '', '', NULL, NULL);
INSERT INTO `b5net_menu` VALUES (10910, '字典数据', 109, 10, '', 0, 'F', '1', '0', 'system:dict-data:index', '', '', NULL, NULL);
INSERT INTO `b5net_menu` VALUES (10911, '字典数据新增', 109, 11, '', 0, 'F', '1', '0', 'system:dict-data:add', '', '', NULL, NULL);
INSERT INTO `b5net_menu` VALUES (10912, '字典数据编辑', 109, 12, '', 0, 'F', '1', '0', 'system:dict-data:edit', '', '', NULL, NULL);
INSERT INTO `b5net_menu` VALUES (10913, '字典数据删除', 109, 13, '', 0, 'F', '1', '0', 'system:dict-data:drop', '', '', NULL, NULL);
INSERT INTO `b5net_menu` VALUES (10914, '字典数据批量删除', 109, 14, '', 0, 'F', '1', '0', 'system:dict-data:dropall', '', '', NULL, NULL);
INSERT INTO `b5net_menu` VALUES (15201, '图片添加', 152, 1, '', 0, 'F', '1', '0', 'demo:media:add', '', '', NULL, NULL);
INSERT INTO `b5net_menu` VALUES (15202, '图片编辑', 152, 2, '', 0, 'F', '1', '0', 'demo:media:edit', '', '', NULL, NULL);
INSERT INTO `b5net_menu` VALUES (15203, '图片删除', 152, 3, '', 0, 'F', '1', '0', 'demo:media:drop', '', '', NULL, NULL);
INSERT INTO `b5net_menu` VALUES (15204, '图片批量删除', 152, 4, '', 0, 'F', '1', '0', 'demo:media:dropall', '', '', NULL, NULL);

-- ----------------------------
-- Table structure for b5net_notice
-- ----------------------------
DROP TABLE IF EXISTS `b5net_notice`;
CREATE TABLE `b5net_notice`  (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '公告ID',
  `title` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '公告标题',
  `type` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '公告类型（1通知 2公告）',
  `desc` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1' COMMENT '公告状态（1正常 0关闭）',
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '公告内容',
  `create_time` datetime NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '通知公告表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of b5net_notice
-- ----------------------------
INSERT INTO `b5net_notice` VALUES (1, '【公告】： B5LaravelCMF新版本发布啦', '2', '', '1', '<p>新版本内容</p><p><br></p><p>新版本内容</p><p>新版本内容</p><p>新版本内容</p><p><br><img src=\"http://tp6cmf.my/uploads/editor/2022/03/22/39f66f7bb77e23ad05bf2dc50524fcd0.jpg\" style=\"width: 500px;\" data-filename=\"u=1160057685,2978145411&amp;fm=26&amp;gp=0.jpg\"></p>', '2022-03-12 11:33:42', '2022-03-22 19:42:08');
INSERT INTO `b5net_notice` VALUES (2, '【通知】：B5LaravelCMF系统凌晨维护', '1', '', '1', '<p><img src=\"http://tp6cmf.my/uploads/editor/2022/03/22/e61034cba38250949bd2c26319085033.jpg\" style=\"width: 500px;\" data-filename=\"u=3671441873,259090506&amp;fm=26&amp;gp=0.jpg\"><font color=\"#0000ff\">维护内容</font></p><p><font color=\"#0000ff\"><br></font></p>', '2022-03-20 11:33:42', '2022-03-22 19:42:17');

-- ----------------------------
-- Table structure for b5net_position
-- ----------------------------
DROP TABLE IF EXISTS `b5net_position`;
CREATE TABLE `b5net_position`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '岗位名称',
  `pos_key` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '岗位标识',
  `list_sort` int NOT NULL DEFAULT 100 COMMENT '排序',
  `status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1' COMMENT '状态',
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '备注',
  `create_time` datetime NULL DEFAULT NULL,
  `update_time` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '岗位表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of b5net_position
-- ----------------------------
INSERT INTO `b5net_position` VALUES (1, '总经理', 'ceo', 1, '1', '', '2022-04-04 23:04:49', '2022-04-08 12:44:52');
INSERT INTO `b5net_position` VALUES (2, '部门经理', 'cpo', 2, '1', '', '2022-04-04 23:25:34', '2022-04-08 13:24:04');
INSERT INTO `b5net_position` VALUES (3, '组长', 'cgo', 3, '1', '', '2022-04-04 23:26:08', '2022-04-08 12:53:33');
INSERT INTO `b5net_position` VALUES (4, '员工', 'user', 4, '1', '', '2022-04-04 23:26:50', '2022-04-08 13:24:01');

-- ----------------------------
-- Table structure for b5net_role
-- ----------------------------
DROP TABLE IF EXISTS `b5net_role`;
CREATE TABLE `b5net_role`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '角色ID',
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '角色名称',
  `role_key` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '角色权限字符串',
  `data_scope` mediumint NOT NULL DEFAULT 1 COMMENT '数据范围（1：全部数据权限 2：自定数据权限 3：本部门数据权限 4：本部门及以下数据权限）',
  `list_sort` int NOT NULL DEFAULT 0 COMMENT '显示顺序',
  `status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1' COMMENT '角色状态（1正常 0停用）',
  `note` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '备注',
  `create_time` datetime NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `rolekey`(`role_key`) USING BTREE,
  INDEX `listsort`(`list_sort`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '角色信息表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of b5net_role
-- ----------------------------
INSERT INTO `b5net_role` VALUES (1, '超级管理员', 'administrator', 1, 0, '1', '超级管理员', '2020-12-28 07:42:31', '2022-03-19 23:31:09');
INSERT INTO `b5net_role` VALUES (3, '测试角色', 'test', 8, 0, '1', '', '2022-03-19 23:43:03', '2023-06-27 11:21:06');

-- ----------------------------
-- Table structure for b5net_role_menu
-- ----------------------------
DROP TABLE IF EXISTS `b5net_role_menu`;
CREATE TABLE `b5net_role_menu`  (
  `role_id` bigint NOT NULL COMMENT '角色ID',
  `menu_id` bigint NOT NULL COMMENT '菜单ID'
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '角色和菜单关联表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of b5net_role_menu
-- ----------------------------
INSERT INTO `b5net_role_menu` VALUES (4, 1);
INSERT INTO `b5net_role_menu` VALUES (4, 106);
INSERT INTO `b5net_role_menu` VALUES (4, 105);
INSERT INTO `b5net_role_menu` VALUES (4, 10500);
INSERT INTO `b5net_role_menu` VALUES (4, 10501);
INSERT INTO `b5net_role_menu` VALUES (4, 10502);
INSERT INTO `b5net_role_menu` VALUES (4, 10503);
INSERT INTO `b5net_role_menu` VALUES (4, 10504);
INSERT INTO `b5net_role_menu` VALUES (4, 107);
INSERT INTO `b5net_role_menu` VALUES (4, 10700);
INSERT INTO `b5net_role_menu` VALUES (4, 10701);
INSERT INTO `b5net_role_menu` VALUES (4, 10702);
INSERT INTO `b5net_role_menu` VALUES (4, 10703);
INSERT INTO `b5net_role_menu` VALUES (3, 1);
INSERT INTO `b5net_role_menu` VALUES (3, 106);
INSERT INTO `b5net_role_menu` VALUES (3, 105);
INSERT INTO `b5net_role_menu` VALUES (3, 10500);
INSERT INTO `b5net_role_menu` VALUES (3, 10501);
INSERT INTO `b5net_role_menu` VALUES (3, 10502);
INSERT INTO `b5net_role_menu` VALUES (3, 10503);
INSERT INTO `b5net_role_menu` VALUES (3, 10504);
INSERT INTO `b5net_role_menu` VALUES (3, 107);
INSERT INTO `b5net_role_menu` VALUES (3, 10700);
INSERT INTO `b5net_role_menu` VALUES (3, 10701);
INSERT INTO `b5net_role_menu` VALUES (3, 10702);
INSERT INTO `b5net_role_menu` VALUES (3, 10703);
INSERT INTO `b5net_role_menu` VALUES (3, 2);
INSERT INTO `b5net_role_menu` VALUES (3, 100);
INSERT INTO `b5net_role_menu` VALUES (3, 10000);
INSERT INTO `b5net_role_menu` VALUES (3, 10001);
INSERT INTO `b5net_role_menu` VALUES (3, 10002);
INSERT INTO `b5net_role_menu` VALUES (3, 10004);
INSERT INTO `b5net_role_menu` VALUES (3, 101);
INSERT INTO `b5net_role_menu` VALUES (3, 10100);
INSERT INTO `b5net_role_menu` VALUES (3, 10101);
INSERT INTO `b5net_role_menu` VALUES (3, 10102);
INSERT INTO `b5net_role_menu` VALUES (3, 10104);
INSERT INTO `b5net_role_menu` VALUES (3, 10105);
INSERT INTO `b5net_role_menu` VALUES (3, 10106);
INSERT INTO `b5net_role_menu` VALUES (3, 102);
INSERT INTO `b5net_role_menu` VALUES (3, 10200);
INSERT INTO `b5net_role_menu` VALUES (3, 10201);
INSERT INTO `b5net_role_menu` VALUES (3, 10202);
INSERT INTO `b5net_role_menu` VALUES (3, 103);
INSERT INTO `b5net_role_menu` VALUES (3, 10300);
INSERT INTO `b5net_role_menu` VALUES (3, 10301);
INSERT INTO `b5net_role_menu` VALUES (3, 10302);
INSERT INTO `b5net_role_menu` VALUES (3, 104);
INSERT INTO `b5net_role_menu` VALUES (3, 10400);
INSERT INTO `b5net_role_menu` VALUES (3, 10401);
INSERT INTO `b5net_role_menu` VALUES (3, 3);
INSERT INTO `b5net_role_menu` VALUES (3, 152);
INSERT INTO `b5net_role_menu` VALUES (3, 15201);
INSERT INTO `b5net_role_menu` VALUES (3, 15202);
INSERT INTO `b5net_role_menu` VALUES (3, 15203);
INSERT INTO `b5net_role_menu` VALUES (3, 15204);
INSERT INTO `b5net_role_menu` VALUES (3, 151);
INSERT INTO `b5net_role_menu` VALUES (3, 150);
INSERT INTO `b5net_role_menu` VALUES (3, 90);

-- ----------------------------
-- Table structure for b5net_role_struct
-- ----------------------------
DROP TABLE IF EXISTS `b5net_role_struct`;
CREATE TABLE `b5net_role_struct`  (
  `role_id` int NOT NULL COMMENT '角色ID',
  `struct_id` int NOT NULL COMMENT '部门ID',
  PRIMARY KEY (`role_id`, `struct_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '角色和部门关联表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of b5net_role_struct
-- ----------------------------
INSERT INTO `b5net_role_struct` VALUES (3, 101);
INSERT INTO `b5net_role_struct` VALUES (3, 103);
INSERT INTO `b5net_role_struct` VALUES (3, 104);

-- ----------------------------
-- Table structure for b5net_smscode
-- ----------------------------
DROP TABLE IF EXISTS `b5net_smscode`;
CREATE TABLE `b5net_smscode`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `mobile` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '手机号码',
  `code` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '验证码',
  `type` tinyint(1) NOT NULL DEFAULT 0 COMMENT '例如：1注册 2登录 3忘记密码',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '状态 0未验证 1已验证',
  `os` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '运营商',
  `create_time` datetime NULL DEFAULT NULL,
  `update_time` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '验证码表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for b5net_struct
-- ----------------------------
DROP TABLE IF EXISTS `b5net_struct`;
CREATE TABLE `b5net_struct`  (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '部门id',
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '部门名称',
  `parent_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `parent_id` int NOT NULL DEFAULT 0 COMMENT '父部门id',
  `levels` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '祖级列表',
  `list_sort` int NOT NULL DEFAULT 0 COMMENT '显示顺序',
  `leader` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '负责人',
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '联系电话',
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '备注',
  `status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1' COMMENT '部门状态（1正常 0停用）',
  `create_time` datetime NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 113 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '组织架构' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of b5net_struct
-- ----------------------------
INSERT INTO `b5net_struct` VALUES (100, '冰舞科技', '', 0, '0', 0, '冰舞', '15888888888', '', '1', '2020-12-24 11:33:42', '2022-03-19 16:20:29');
INSERT INTO `b5net_struct` VALUES (101, '北京总公司', '冰舞科技', 100, '0,100', 1, '冰舞', '18888888888', '', '1', '2020-12-24 11:33:42', '2022-03-19 16:21:09');
INSERT INTO `b5net_struct` VALUES (103, '研发部门', '冰舞科技,北京总公司', 101, '0,100,101', 1, '冰舞', '15888888888', '', '1', '2020-12-24 11:33:42', '2022-03-19 16:21:01');
INSERT INTO `b5net_struct` VALUES (104, '市场部门', '冰舞科技,北京总公司', 101, '0,100,101', 2, '冰舞', '15888888888', '', '1', '2020-12-24 11:33:42', '2022-03-19 16:21:01');
INSERT INTO `b5net_struct` VALUES (105, '测试部门', '冰舞科技,北京总公司', 101, '0,100,101', 3, '冰舞', '15888888888', '', '1', '2020-12-24 11:33:42', '2022-03-19 16:21:01');
INSERT INTO `b5net_struct` VALUES (110, '山东分公司', '冰舞科技', 100, '0,100', 2, '冰舞', '1888888', '', '1', '2021-01-08 11:11:33', '2022-03-19 16:21:14');
INSERT INTO `b5net_struct` VALUES (111, '销售部门', '冰舞科技,山东分公司', 110, '0,100,110', 1, '', '', '', '1', '2021-01-08 11:11:48', '2022-03-19 16:21:14');
INSERT INTO `b5net_struct` VALUES (112, 'php开发', '冰舞科技,北京总公司,测试部门', 105, '0,100,101,105', 1, '', '', '', '1', '2021-03-29 18:02:29', '2023-06-27 11:21:13');

-- ----------------------------
-- Table structure for b5net_wechat_access
-- ----------------------------
DROP TABLE IF EXISTS `b5net_wechat_access`;
CREATE TABLE `b5net_wechat_access`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `appid` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `access_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `jsapi_ticket` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `access_token_add` int NOT NULL DEFAULT 0,
  `jsapi_ticket_add` int NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `appid`(`appid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '微信jsapi和access' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of b5net_wechat_access
-- ----------------------------
INSERT INTO `b5net_wechat_access` VALUES (1, 'wx2ba634598c7df708', '56_-gDlZ3QfDLABs_DkZvAoR_Zol93_PC1SEHX_ORuGvEuqkHK5RXPK0Kze7_8oTe7cKUSHNZKd1b669ZddVyQiwKDxyK7DS7ix70KG_7GjMFnxiqP8OAUcnfhLMde8cZ1SNOn5bapfr4HE-LP2VIQiAEAIVD', 'sM4AOVdWfPE4DxkXGEs8VEHh_EQ4eLTYEqfB5PSBsfjeivfj4e6h5yEFTVP-_EIn78RGwPetriPcft2bevEGcg', 1650606815, 1650606827);

-- ----------------------------
-- Table structure for b5net_wechat_users
-- ----------------------------
DROP TABLE IF EXISTS `b5net_wechat_users`;
CREATE TABLE `b5net_wechat_users`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `openid` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '唯一标识',
  `appid` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '公众号参数',
  `nickname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '昵称',
  `headimg` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '头像地址',
  `type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '所属活动',
  `update_time` datetime NULL DEFAULT NULL COMMENT '资料更新时间',
  `create_time` datetime NULL DEFAULT NULL COMMENT '添加时间',
  `sex` tinyint(1) NOT NULL DEFAULT 0 COMMENT '性别',
  `city` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '城市',
  `country` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '国家',
  `province` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '省份',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `openid`(`openid`, `appid`, `type`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '微信用户信息表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of b5net_wechat_users
-- ----------------------------
INSERT INTO `b5net_wechat_users` VALUES (2, 'oHwQ-5zzJiXhutCVWmSPfQyAx7Yk', 'wx2dbcd1ebf29bd18f', '简单', 'https://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLGqoCcD0iamzHcJDmfU4sKbpqBYxD9icXcTtxlKkia3mB2OZIrIucsnq21FwSvFvBSxsiaTtAm5ZHmeQ/132', 'scratch_1', '2021-04-08 16:47:17', '2021-04-08 16:47:17', 1, '', '中国', '', 1);
INSERT INTO `b5net_wechat_users` VALUES (3, 'oHwQ-5_qj1L9HHnUpclLOJPh_Z7M', 'wx2dbcd1ebf29bd18f', '九方资源ヽ赖小伙 ', 'https://thirdwx.qlogo.cn/mmopen/vi_32/fKibib5mxicWGxOgAQY0PUucIft3D243GXLMkm4vMY7cJmqzR2Zmhr9nrsTR1PFfDXlCsZ3sJcy4UGwptNu7CmSwQ/132', 'scratch_1', '2021-04-14 14:07:13', '2021-04-14 14:07:13', 1, '赣州', '中国', '江西', 1);
INSERT INTO `b5net_wechat_users` VALUES (4, 'oHwQ-54NH0I3WbRt77eF5-EKo-C8', 'wx2dbcd1ebf29bd18f', 'Hello World', 'https://thirdwx.qlogo.cn/mmopen/vi_32/M3PEicW5ziceOUdVDX7vQicZgvxDMPYCaiavl4l2m8IFPyzSHMTbiaeL3mtaXMiafD8CJQicFrNoHiau1ypkJo0m2HYibcw/132', 'scratch_1', '2021-04-19 21:24:36', '2021-04-19 21:24:36', 1, '', '黑山', '', 1);
INSERT INTO `b5net_wechat_users` VALUES (5, 'oBi_at-f8RORVDzNs-DY42Gx2Z5Y', 'wx2ba634598c7df708', '李先生', 'https://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83eo5thwrUYkscpLLpLc8gx4q6CL8nxm7Ciaicjc9icMYCYEsXWaGsbkjETycFAZMVUIGmiazSDiaib7XKOgw/132', '', NULL, NULL, 0, '', '', '', 1);

-- ----------------------------
-- Table structure for demo_media
-- ----------------------------
DROP TABLE IF EXISTS `demo_media`;
CREATE TABLE `demo_media`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `img` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '单图',
  `imgs` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '多图',
  `crop` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '裁剪图片',
  `video` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '视频',
  `file` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '单文件',
  `files` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '多文件',
  `create_time` datetime NULL DEFAULT NULL,
  `update_time` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of demo_media
-- ----------------------------
INSERT INTO `demo_media` VALUES (1, '/uploads/demo/2022/03/22/167cdb475bc8f70805b1d6af37bdb451.jpeg', '/uploads/demo/2022/03/22/e2cb477c6f7b4ed61522f401263e855b.jpeg,/uploads/demo/2022/03/22/6e8c0545c09d524274282264234621db.jpeg,/uploads/demo/2022/03/22/e95bd881e231782acfbacf1ef833a589.jpeg,/uploads/demo/2022/03/22/9092d78f09fcd47728171b3061acbd1e.jpg,/uploads/demo/2022/03/22/7347334e10d823500b85b4e5148d7f78.jpeg', '/uploads/demo/2022/03/22/a8927794241a9afe97a0609c56ea7bb7.jpg,/uploads/demo/2022/03/22/73bbf84a13f7797609568bc3f9c0c2f1.jpg', '/uploads/demo/2022/04/23/dfcff5d22c7b1aec6e34f99fbdcdab4a.mp4', '/uploads/demo/2022/03/22/320167184252acbd548880a009f6d5c9.txt', '/uploads/demo/2022/03/22/2c657603884aa84e4730986555988154.txt,/uploads/demo/2022/03/22/d2e6263a628dad4cd0841d64a9105a7f.txt,/uploads/demo/2022/04/23/54a915fa63cfbf15918611b4dae933a8.png', '2022-03-22 19:43:57', '2022-03-22 20:42:17');

-- ----------------------------
-- Table structure for demo_table
-- ----------------------------
DROP TABLE IF EXISTS `demo_table`;
CREATE TABLE `demo_table`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for test_goods_list
-- ----------------------------
DROP TABLE IF EXISTS `test_goods_list`;
CREATE TABLE `test_goods_list`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '商品名称',
  `price` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '价格',
  `detail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `status` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `create_time` datetime NULL DEFAULT NULL,
  `update_time` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- View structure for b5net_admin_view
-- ----------------------------
DROP VIEW IF EXISTS `b5net_admin_view`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `b5net_admin_view` AS select `a`.`id` AS `id`,`a`.`username` AS `username`,`a`.`password` AS `password`,`a`.`realname` AS `realname`,`a`.`status` AS `status`,`a`.`note` AS `note`,`a`.`create_time` AS `create_time`,`a`.`update_time` AS `update_time`,`d`.`struct_id_tree` AS `struct_id_tree`,`d`.`struct_id` AS `struct_id`,group_concat(`r`.`role_id` separator ',') AS `role_id` from ((`b5net_admin` `a` left join `b5net_admin_role` `r` on((`a`.`id` = `r`.`admin_id`))) left join (select `b`.`admin_id` AS `admin_id`,group_concat(concat(`c`.`levels`,',',`c`.`id`) separator ',') AS `struct_id_tree`,group_concat(`c`.`id` separator ',') AS `struct_id` from (`b5net_admin_struct` `b` join `b5net_struct` `c` on((`c`.`id` = `b`.`struct_id`))) group by `b`.`admin_id`) `d` on((`a`.`id` = `d`.`admin_id`))) group by `a`.`id`;

SET FOREIGN_KEY_CHECKS = 1;
