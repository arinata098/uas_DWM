/*
 Navicat Premium Data Transfer

 Source Server         : 1. localhost
 Source Server Type    : MySQL
 Source Server Version : 100137
 Source Host           : localhost:3306
 Source Schema         : data_warehouse_harvest

 Target Server Type    : MySQL
 Target Server Version : 100137
 File Encoding         : 65001

 Date: 03/12/2019 18:07:29
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for harvest_type
-- ----------------------------
DROP TABLE IF EXISTS `harvest_type`;
CREATE TABLE `harvest_type` (
  `harvest_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `temperature_min` int(11) DEFAULT NULL,
  `temperature_max` int(11) DEFAULT NULL,
  `humidity_min` int(11) DEFAULT NULL,
  `humidity_max` int(11) DEFAULT NULL,
  `harvest_type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`harvest_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=283 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of harvest_type
-- ----------------------------
BEGIN;
INSERT INTO `harvest_type` VALUES (277, 25, 27, 65, 84, 'Kurang');
INSERT INTO `harvest_type` VALUES (278, 28, 29, 65, 84, 'Cukup');
INSERT INTO `harvest_type` VALUES (279, 30, 31, 65, 84, 'Baik');
INSERT INTO `harvest_type` VALUES (280, 32, 33, 65, 84, 'Sangat Baik');
INSERT INTO `harvest_type` VALUES (281, 30, 31, 65, 84, 'Agak Baik');
INSERT INTO `harvest_type` VALUES (282, 32, 34, 65, 84, 'Cukup');
COMMIT;

-- ----------------------------
-- Table structure for process
-- ----------------------------
DROP TABLE IF EXISTS `process`;
CREATE TABLE `process` (
  `process_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `temperature` varchar(255) DEFAULT NULL,
  `humidity` varchar(255) DEFAULT NULL,
  `euclidience_distance` float DEFAULT NULL,
  `urutan_jarak` int(11) DEFAULT NULL,
  `harvest_type` varchar(255) DEFAULT NULL,
  `include_knn` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`process_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5441 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of process
-- ----------------------------
BEGIN;
INSERT INTO `process` VALUES (5409, '2019-10-01 00:00:00', '29', '79', 3.16228, 17, 'Cukup', 'Tidak');
INSERT INTO `process` VALUES (5410, '2019-10-02 00:00:00', '30', '81', 3.60555, 21, 'Baik', 'Tidak');
INSERT INTO `process` VALUES (5411, '2019-10-03 00:00:00', '32', '78', 0, 1, 'Sangat Baik', 'Ya');
INSERT INTO `process` VALUES (5412, '2019-10-04 00:00:00', '31', '75', 3.16228, 18, 'Baik', 'Tidak');
INSERT INTO `process` VALUES (5413, '2019-10-05 00:00:00', '30', '74', 4.47214, 26, 'Baik', 'Tidak');
INSERT INTO `process` VALUES (5414, '2019-10-06 00:00:00', '30', '79', 2.23607, 9, 'Baik', 'Tidak');
INSERT INTO `process` VALUES (5415, '2019-10-07 00:00:00', '30', '81', 3.60555, 22, 'Baik', 'Tidak');
INSERT INTO `process` VALUES (5416, '2019-10-08 00:00:00', '30', '76', 2.82843, 14, 'Baik', 'Tidak');
INSERT INTO `process` VALUES (5417, '2019-10-09 00:00:00', '30', '81', 3.60555, 23, 'Baik', 'Tidak');
INSERT INTO `process` VALUES (5418, '2019-10-10 00:00:00', '31', '73', 5.09902, 27, 'Baik', 'Tidak');
INSERT INTO `process` VALUES (5419, '2019-10-11 00:00:00', '32', '74', 4, 24, 'Sangat Baik', 'Tidak');
INSERT INTO `process` VALUES (5420, '2019-10-12 00:00:00', '31', '75', 3.16228, 19, 'Baik', 'Tidak');
INSERT INTO `process` VALUES (5421, '2019-10-13 00:00:00', '32', '71', 7, 30, 'Sangat Baik', 'Tidak');
INSERT INTO `process` VALUES (5422, '2019-10-14 00:00:00', '31', '73', 5.09902, 28, 'Baik', 'Tidak');
INSERT INTO `process` VALUES (5423, '2019-10-15 00:00:00', '30', '78', 2, 6, 'Baik', 'Tidak');
INSERT INTO `process` VALUES (5424, '2019-10-16 00:00:00', '30', '76', 2.82843, 15, 'Baik', 'Tidak');
INSERT INTO `process` VALUES (5425, '2019-10-17 00:00:00', '30', '78', 2, 7, 'Baik', 'Tidak');
INSERT INTO `process` VALUES (5426, '2019-10-18 00:00:00', '30', '78', 2, 8, 'Baik', 'Tidak');
INSERT INTO `process` VALUES (5427, '2019-10-19 00:00:00', '31', '77', 1.41421, 5, 'Baik', 'Tidak');
INSERT INTO `process` VALUES (5428, '2019-10-20 00:00:00', '32', '78', 0, 2, 'Sangat Baik', 'Ya');
INSERT INTO `process` VALUES (5429, '2019-10-21 00:00:00', '32', '81', 3, 16, 'Sangat Baik', 'Tidak');
INSERT INTO `process` VALUES (5430, '2019-10-22 00:00:00', '32', '77', 1, 3, 'Sangat Baik', 'Ya');
INSERT INTO `process` VALUES (5431, '2019-10-23 00:00:00', '33', '68', 10.0499, 32, 'Sangat Baik', 'Tidak');
INSERT INTO `process` VALUES (5432, '2019-10-24 00:00:00', '33', '73', 5.09902, 29, 'Sangat Baik', 'Tidak');
INSERT INTO `process` VALUES (5433, '2019-10-25 00:00:00', '32', '77', 1, 4, 'Sangat Baik', 'Tidak');
INSERT INTO `process` VALUES (5434, '2019-10-26 00:00:00', '31', '76', 2.23607, 10, 'Baik', 'Tidak');
INSERT INTO `process` VALUES (5435, '2019-10-27 00:00:00', '31', '74', 4.12311, 25, 'Baik', 'Tidak');
INSERT INTO `process` VALUES (5436, '2019-10-28 00:00:00', '31', '76', 2.23607, 11, 'Baik', 'Tidak');
INSERT INTO `process` VALUES (5437, '2019-10-29 00:00:00', '32', '70', 8, 31, 'Sangat Baik', 'Tidak');
INSERT INTO `process` VALUES (5438, '2019-10-30 00:00:00', '31', '80', 2.23607, 12, 'Baik', 'Tidak');
INSERT INTO `process` VALUES (5439, '2019-10-31 00:00:00', '31', '81', 3.16228, 20, 'Baik', 'Tidak');
INSERT INTO `process` VALUES (5440, '2019-11-01 00:00:00', '31', '80', 2.23607, 13, 'Baik', 'Tidak');
COMMIT;

-- ----------------------------
-- Table structure for weather
-- ----------------------------
DROP TABLE IF EXISTS `weather`;
CREATE TABLE `weather` (
  `weather_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `temperature` int(11) DEFAULT NULL,
  `humidity` int(11) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`weather_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1219 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of weather
-- ----------------------------
BEGIN;
INSERT INTO `weather` VALUES (1187, '2019-10-01', 29, 79, 'Badung, Indonesia');
INSERT INTO `weather` VALUES (1188, '2019-10-02', 30, 81, 'Badung, Indonesia');
INSERT INTO `weather` VALUES (1189, '2019-10-03', 32, 78, 'Badung, Indonesia');
INSERT INTO `weather` VALUES (1190, '2019-10-04', 31, 75, 'Badung, Indonesia');
INSERT INTO `weather` VALUES (1191, '2019-10-05', 30, 74, 'Badung, Indonesia');
INSERT INTO `weather` VALUES (1192, '2019-10-06', 30, 79, 'Badung, Indonesia');
INSERT INTO `weather` VALUES (1193, '2019-10-07', 30, 81, 'Badung, Indonesia');
INSERT INTO `weather` VALUES (1194, '2019-10-08', 30, 76, 'Badung, Indonesia');
INSERT INTO `weather` VALUES (1195, '2019-10-09', 30, 81, 'Badung, Indonesia');
INSERT INTO `weather` VALUES (1196, '2019-10-10', 31, 73, 'Badung, Indonesia');
INSERT INTO `weather` VALUES (1197, '2019-10-11', 32, 74, 'Badung, Indonesia');
INSERT INTO `weather` VALUES (1198, '2019-10-12', 31, 75, 'Badung, Indonesia');
INSERT INTO `weather` VALUES (1199, '2019-10-13', 32, 71, 'Badung, Indonesia');
INSERT INTO `weather` VALUES (1200, '2019-10-14', 31, 73, 'Badung, Indonesia');
INSERT INTO `weather` VALUES (1201, '2019-10-15', 30, 78, 'Badung, Indonesia');
INSERT INTO `weather` VALUES (1202, '2019-10-16', 30, 76, 'Badung, Indonesia');
INSERT INTO `weather` VALUES (1203, '2019-10-17', 30, 78, 'Badung, Indonesia');
INSERT INTO `weather` VALUES (1204, '2019-10-18', 30, 78, 'Badung, Indonesia');
INSERT INTO `weather` VALUES (1205, '2019-10-19', 31, 77, 'Badung, Indonesia');
INSERT INTO `weather` VALUES (1206, '2019-10-20', 32, 78, 'Badung, Indonesia');
INSERT INTO `weather` VALUES (1207, '2019-10-21', 32, 81, 'Badung, Indonesia');
INSERT INTO `weather` VALUES (1208, '2019-10-22', 32, 77, 'Badung, Indonesia');
INSERT INTO `weather` VALUES (1209, '2019-10-23', 33, 68, 'Badung, Indonesia');
INSERT INTO `weather` VALUES (1210, '2019-10-24', 33, 73, 'Badung, Indonesia');
INSERT INTO `weather` VALUES (1211, '2019-10-25', 32, 77, 'Badung, Indonesia');
INSERT INTO `weather` VALUES (1212, '2019-10-26', 31, 76, 'Badung, Indonesia');
INSERT INTO `weather` VALUES (1213, '2019-10-27', 31, 74, 'Badung, Indonesia');
INSERT INTO `weather` VALUES (1214, '2019-10-28', 31, 76, 'Badung, Indonesia');
INSERT INTO `weather` VALUES (1215, '2019-10-29', 32, 70, 'Badung, Indonesia');
INSERT INTO `weather` VALUES (1216, '2019-10-30', 31, 80, 'Badung, Indonesia');
INSERT INTO `weather` VALUES (1217, '2019-10-31', 31, 81, 'Badung, Indonesia');
INSERT INTO `weather` VALUES (1218, '2019-11-01', 31, 80, 'Badung, Indonesia');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
