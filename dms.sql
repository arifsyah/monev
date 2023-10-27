/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50724
Source Host           : localhost:3306
Source Database       : dms

Target Server Type    : MYSQL
Target Server Version : 50724
File Encoding         : 65001

Date: 2022-12-11 13:25:43
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `admins`
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `role` int(1) DEFAULT '0',
  `path` text,
  `status` int(1) unsigned DEFAULT '0',
  `nip` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of admins
-- ----------------------------
INSERT INTO admins VALUES ('1', '2019-12-03 10:39:44', '2021-10-04 17:12:53', 'arifsyah11@gmail.com', 'Arif Firmansyah', '$2y$10$MpkvROSHiuvtEHc53LpoCOHuv2hsJl.AYb24TKyoXEmQHSe125nBe', 'yMExiTbCYfESqIgikR9rjgpHWkY8RVJvRDcCW0RQXNV0pRsbfGC75v0pUyfH', '1', null, '1', '199005302020121012');
INSERT INTO admins VALUES ('4', '2021-09-11 15:25:37', '2021-10-18 08:14:25', 'arifsyah.dev@gmail.com', 'arif lagi', '$2y$10$sxQ0yIKfESL.Fq4n5OvI7u3c/j6H717BGQzMmDgvYieE.mNG0M4qe', null, '2', null, '1', null);

-- ----------------------------
-- Table structure for `bidang`
-- ----------------------------
DROP TABLE IF EXISTS `bidang`;
CREATE TABLE `bidang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `id_parent` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `show` int(1) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `users_created` int(11) DEFAULT NULL,
  `users_modified` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of bidang
-- ----------------------------
INSERT INTO bidang VALUES ('1', 'Bidang Perumahan', null, 'Bidang Perumahan', null, '2021-10-11 09:28:23', '2021-10-11 09:28:23', null, null, '1', null);
INSERT INTO bidang VALUES ('2', 'Bidang Kawasan Permukiman', null, 'Bidang Kawasan Permukiman', null, '2021-10-11 09:53:59', '2021-10-11 09:53:59', null, null, '1', null);
INSERT INTO bidang VALUES ('3', 'Sekretariat', null, 'Sekretariat', null, '2021-10-18 03:44:28', '2021-10-18 03:44:28', null, null, '1', null);
INSERT INTO bidang VALUES ('4', 'Bidang Pertamanan dan Dekorasi Kota', null, 'Bidang Pertamanan dan Dekorasi Kota', null, '2021-10-18 03:44:39', '2022-11-28 14:34:52', null, null, '1', '1');
INSERT INTO bidang VALUES ('5', 'Bidang Pertanahan dan PSU', null, 'Bidang Pertanahan dan PSU', null, '2021-10-18 03:44:46', '2022-11-28 14:34:38', null, null, '1', '1');

-- ----------------------------
-- Table structure for `categories`
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `id_parent` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `show` int(1) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `users_created` int(11) DEFAULT NULL,
  `users_modified` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO categories VALUES ('1', 'Dokumen Pendukung Perencanaan', 'berita', 'Dokumen Pendukung Perencanaan', null, '2020-06-01 06:53:08', '2021-10-02 00:32:36', null, null, '1', '1');
INSERT INTO categories VALUES ('4', 'Dokumen Pelaporan', null, 'Dokumen Pelaporan', null, '2021-09-11 12:55:14', '2021-10-02 00:32:26', null, null, '1', '1');
INSERT INTO categories VALUES ('5', 'Dokumen Perencanaan', null, 'Dokumen Perencanaan', null, '2021-09-11 12:55:21', '2021-10-02 00:32:16', null, null, '1', '1');
INSERT INTO categories VALUES ('26', 'Dokumen Pendukung Pelaporan', null, 'Dokumen Pendukung Pelaporan', null, '2021-10-02 00:32:43', '2021-10-02 00:32:43', null, null, '1', null);
INSERT INTO categories VALUES ('27', 'Capaian Kinerja', null, 'Data Capaian Kinerja', null, '2021-10-19 04:22:09', '2021-10-19 04:22:09', null, null, '1', null);
INSERT INTO categories VALUES ('28', 'KAK', null, 'Kerangka Acuan Kerja', null, '2021-10-19 04:22:22', '2021-10-19 04:22:22', null, null, '1', null);

-- ----------------------------
-- Table structure for `configurations`
-- ----------------------------
DROP TABLE IF EXISTS `configurations`;
CREATE TABLE `configurations` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `address` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `desc_home` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `link_facebook` varchar(255) DEFAULT NULL,
  `link_google` varchar(255) DEFAULT NULL,
  `link_instagram` varchar(255) DEFAULT NULL,
  `link_twitter` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `meta_keyword` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `site_title` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_modified` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of configurations
-- ----------------------------

-- ----------------------------
-- Table structure for `files`
-- ----------------------------
DROP TABLE IF EXISTS `files`;
CREATE TABLE `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `show` int(1) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `users_created` int(11) DEFAULT NULL,
  `users_modified` int(11) DEFAULT NULL,
  `path` text,
  `id_kategori` int(11) unsigned NOT NULL,
  `tahun` int(4) unsigned DEFAULT NULL,
  `id_bidang` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of files
-- ----------------------------
INSERT INTO files VALUES ('18', 'Daftar Informasi Publik', null, 'Daftar informasi Publik yang akan dikirimkan ke diskominfo', '2021-09-23 15:24:41', '2021-10-02 00:46:05', null, null, '1', '1', '2021/10/02/2021_10_02_00_46_05_5eb0019bf15339677adf323993036bb9.pdf', '4', '2021', '0');
INSERT INTO files VALUES ('19', 'SPM Bidang Permukiman', null, 'SPM Bidang Permukiman DPKP3', '2021-10-02 00:44:00', '2021-10-02 00:44:00', null, null, '1', null, '2021/10/02/2021_10_02_00_44_00_a0c6415e7e77a3dd0ce8aaeb4715dc44.pdf', '29', '2020', '0');
INSERT INTO files VALUES ('20', 'Data Sewa Tanah', null, 'Data Sewa Tanah terakhir update tahun 2021', '2021-10-02 00:45:18', '2021-10-18 06:18:09', null, null, '1', '1', '2021/10/18/data_sewa_tanah_2021_10_18_06_18_09_614f339624dd84181d2260bdb298b6d2.pdf', '4', '2021', '0');
INSERT INTO files VALUES ('21', 'Data dan Informasi LKPJ Tahun2020', null, 'Data dan Informasi LKPJ Tahun2020', '2021-10-02 00:50:23', '2021-10-07 00:56:45', null, null, '1', '1', '2021/10/07/data_dan_informasi_lkpj_tahun2020_2021_10_07_00_56_45_5b8d8d0fb1594eeaace387608d2824a7.txt', '26', '2020', '0');
INSERT INTO files VALUES ('22', 'Indikator Kinerja Individu Eselon IV', null, 'Indikator Kinerja Individu Eselon IV / 4. data ini digunakan untuk banyak laporan dan merupakan indikator yang sangat penting untuk kemajuan perangkat daerah', '2021-10-02 17:56:36', '2021-10-11 10:10:43', null, null, '1', '1', '2021/10/02/2021_10_02_17_56_36_72931a92101def17106cf22be25e3bcc.pdf', '4', '2020', '1');
INSERT INTO files VALUES ('23', 'Indikator Kinerja Individu Eselon 3', null, 'Indikator Kinerja Individu Eselon 3', '2021-10-02 17:57:32', '2021-10-11 10:10:34', null, null, '1', '1', '2021/10/02/2021_10_02_17_57_32_9c953a7f8e6cf6f9124e1d7d6cd76674.pdf', '4', '2020', '1');
INSERT INTO files VALUES ('24', 'Data Kegiatan Kelitbangan', null, 'Data Kegiatan Kelitbangan revisi tanggal 7 oktober', '2021-10-02 17:59:50', '2021-10-07 04:22:29', null, null, '1', '1', '2021/10/07/data_kegiatan_kelitbangan_2021_10_07_04_22_29_fd65ddec0670ad349b330e7444231fe6.txt', '1', '2021', '0');
INSERT INTO files VALUES ('31', 'Kerangka Acuan Kerja', null, 'Kerangka Acuan Kerja UPT Pembibitan', '2021-10-11 03:50:33', '2022-01-12 10:20:36', null, null, '1', '1', '2021/10/11/kerangka_acuan_kerja_2021_10_11_03_50_33_5edef0e415a42ce59deec01462cf1bf5.zip', '4', '2021', '1');

-- ----------------------------
-- Table structure for `files_history`
-- ----------------------------
DROP TABLE IF EXISTS `files_history`;
CREATE TABLE `files_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `users_created` int(11) DEFAULT NULL,
  `users_modified` int(11) DEFAULT NULL,
  `path` text,
  `id_kategori` int(11) unsigned NOT NULL,
  `id_file` int(11) unsigned NOT NULL DEFAULT '0',
  `tahun` int(4) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of files_history
-- ----------------------------
INSERT INTO files_history VALUES ('17', 'daftar informasi publik', null, 'daftar informasi publik', '2021-09-23 06:38:19', '2021-09-23 06:38:19', null, '1', null, '2021/09/23/2021_09_23_06_38_19_0863f0fe61602b9b550a75a1b5970337.docx', '4', '0', null);
INSERT INTO files_history VALUES ('18', 'Coba file sekretariat asdadasd', null, 'Coba file sekretariat asdadasd', '2021-10-06 06:53:54', '2021-10-06 06:53:38', null, '1', '1', null, '37', '0', '2020');
INSERT INTO files_history VALUES ('19', 'Coba file sekretariat asdadasd', null, 'Coba file sekretariat asdadasd', '2021-10-06 06:54:18', '2021-10-06 06:53:54', null, '1', '1', null, '37', '0', '2020');
INSERT INTO files_history VALUES ('20', 'Coba file sekretariat', null, 'Coba file sekretariat', '2021-10-06 06:55:01', '2021-10-06 06:54:18', null, '1', '1', null, '37', '25', '2020');
INSERT INTO files_history VALUES ('21', 'Data Kegiatan Kelitbangan', null, 'Data Kegiatan Kelitbangan', '2021-10-06 06:56:48', '2021-10-06 03:18:19', null, '1', '1', null, '4', '24', '2020');
INSERT INTO files_history VALUES ('22', 'Data Kegiatan Kelitbangan', null, 'Data Kegiatan Kelitbangan', '2021-10-06 06:57:59', '2021-10-06 06:57:38', null, '1', '1', null, '4', '24', '2020');
INSERT INTO files_history VALUES ('23', 'Data Kegiatan Kelitbangan', null, 'Data Kegiatan Kelitbangan', '2021-10-06 06:58:56', '2021-10-06 06:57:59', null, '1', '1', null, '4', '24', '2020');
INSERT INTO files_history VALUES ('24', 'Data Kegiatan Kelitbangan', null, 'Data Kegiatan Kelitbangan', '2021-10-06 06:59:16', '2021-10-06 06:58:56', null, '1', '1', null, '4', '24', '2020');
INSERT INTO files_history VALUES ('25', 'Data Kegiatan Kelitbangan', null, 'Data Kegiatan Kelitbangan', '2021-10-06 06:59:17', '2021-10-06 06:59:16', null, '1', '1', null, '1', '24', '2020');
INSERT INTO files_history VALUES ('26', 'Data Kegiatan Kelitbangan', null, 'Data Kegiatan Kelitbangan', '2021-10-06 06:59:28', '2021-10-06 06:59:17', null, '1', '1', null, '1', '24', '2020');
INSERT INTO files_history VALUES ('27', 'Data Kegiatan Kelitbangan', null, 'Data Kegiatan Kelitbangan', '2021-10-06 06:59:58', '2021-10-06 06:59:28', null, '1', '1', '2021/10/06/data_kegiatan_kelitbangan_2021_10_06_06_59_28_62808cd794cf059581af01690fe2ae7a.doc', '1', '24', '2020');
INSERT INTO files_history VALUES ('28', 'Data Kegiatan Kelitbangan', null, 'Data Kegiatan Kelitbangan', '2021-10-06 07:00:20', '2021-10-06 06:59:58', null, '1', '1', '2021/10/06/data_kegiatan_kelitbangan_2021_10_06_06_59_28_62808cd794cf059581af01690fe2ae7a.doc', '1', '24', '2020');
INSERT INTO files_history VALUES ('29', 'Data Kegiatan Kelitbangan', null, 'Data Kegiatan Kelitbangan', '2021-10-06 07:00:29', '2021-10-06 07:00:20', null, '1', '1', '2021/10/06/data_kegiatan_kelitbangan_2021_10_06_07_00_20_97c4c90f02e19deeb0980ad62b4ed742.pdf', '1', '24', '2020');
INSERT INTO files_history VALUES ('30', 'Data Kegiatan Kelitbangan', null, 'Data Kegiatan Kelitbangan', '2021-10-06 07:00:39', '2021-10-06 07:00:29', null, '1', '1', '2021/10/06/data_kegiatan_kelitbangan_2021_10_06_07_00_20_97c4c90f02e19deeb0980ad62b4ed742.pdf', '1', '24', '2020');
INSERT INTO files_history VALUES ('31', 'Data dan Informasi LKPJ Tahun2020', null, 'Data dan Informasi LKPJ Tahun2020', '2021-10-06 07:00:59', '2021-10-02 00:50:23', null, '1', null, '2021/10/02/2021_10_02_00_50_23_2f5581bed5581fe55359c748133cc43b.pdf', '26', '21', '2020');
INSERT INTO files_history VALUES ('32', 'Data dan Informasi LKPJ Tahun2020', null, 'Data dan Informasi LKPJ Tahun2020', '2021-10-06 07:01:05', '2021-10-06 07:00:59', null, '1', '1', '2021/10/02/2021_10_02_00_50_23_2f5581bed5581fe55359c748133cc43b.pdf', '26', '21', '2020');
INSERT INTO files_history VALUES ('33', 'Data dan Informasi LKPJ Tahun2020', null, 'Data dan Informasi LKPJ Tahun2020', '2021-10-07 00:56:45', '2021-10-06 07:01:05', null, '1', '1', '2021/10/06/data_dan_informasi_lkpj_tahun2020_2021_10_06_07_01_05_230b93ec1413119e21ec4644aa1987fe.xlsx', '26', '21', '2020');
INSERT INTO files_history VALUES ('34', 'Data Kegiatan Kelitbangan', null, 'Data Kegiatan Kelitbangan', '2021-10-07 04:22:29', '2021-10-06 07:00:39', null, '1', '1', '2021/10/06/data_kegiatan_kelitbangan_2021_10_06_07_00_20_97c4c90f02e19deeb0980ad62b4ed742.pdf', '1', '24', '2021');
INSERT INTO files_history VALUES ('35', 'Coba file sekretariat', null, 'Coba file sekretariat', '2021-10-07 07:10:26', '2021-10-06 06:55:01', null, '1', '1', '2021/10/06/coba_file_sekretariat_2021_10_06_06_54_18_ec3dfefb6b67cb22a08e04d352c67ae7.pdf', '37', '25', '2020');
INSERT INTO files_history VALUES ('36', 'aaaaaaaaa aaaaaaaaaaaaa', null, 'aaaaaaaaa aaaaaaaaaaaaa', '2021-10-07 08:27:31', '2021-10-07 08:27:23', null, '1', null, '2021/10/07/aaaaaaaaa_aaaaaaaaaaaaa_2021_10_07_08_27_23_f3be2da52cc9f9190963ae0077e99eee.pdf', '4', '27', '2021');
INSERT INTO files_history VALUES ('37', 'adas asd', null, 'adas asd', '2021-10-07 08:35:47', '2021-10-07 08:35:17', null, '1', null, '2021/10/07/adas_asd_2021_10_07_08_35_17_0dda9cf0560bcf3092daae957b555d3d.txt', '4', '30', '2021');
INSERT INTO files_history VALUES ('38', 'asdaas adasd', null, 'asdaas adasd', '2021-10-11 09:54:57', '2021-10-11 09:51:44', null, '1', null, '2021/10/11/asdaas_adasd_2021_10_11_09_51_44_e0b756ee50373ab6fed4ad6b1c56db70.xlsx', '1', '32', '2020');
INSERT INTO files_history VALUES ('39', 'asdaas adasd', null, 'asdaas adasd', '2021-10-11 09:55:24', '2021-10-11 09:54:57', null, '1', '1', '2021/10/11/asdaas_adasd_2021_10_11_09_51_44_e0b756ee50373ab6fed4ad6b1c56db70.xlsx', '1', '32', '2020');
INSERT INTO files_history VALUES ('40', 'asdaas adasd', null, 'asdaas adasd', '2021-10-11 10:02:53', '2021-10-11 09:55:24', null, '1', '1', '2021/10/11/asdaas_adasd_2021_10_11_09_51_44_e0b756ee50373ab6fed4ad6b1c56db70.xlsx', '1', '32', '2020');
INSERT INTO files_history VALUES ('41', 'Kerangka Acuan Kerja', null, 'Kerangka Acuan Kerja', '2021-10-11 10:10:20', '2021-10-11 03:50:33', null, '1', null, '2021/10/11/kerangka_acuan_kerja_2021_10_11_03_50_33_5edef0e415a42ce59deec01462cf1bf5.zip', '33', '31', '2021');
INSERT INTO files_history VALUES ('42', 'Indikator Kinerja Individu Eselon 3', null, 'Indikator Kinerja Individu Eselon 3', '2021-10-11 10:10:34', '2021-10-02 17:57:32', null, '1', null, '2021/10/02/2021_10_02_17_57_32_9c953a7f8e6cf6f9124e1d7d6cd76674.pdf', '4', '23', '2020');
INSERT INTO files_history VALUES ('43', 'Indikator Kinerja Individu Eselon IV', null, 'Indikator Kinerja Individu Eselon IV', '2021-10-11 10:10:43', '2021-10-03 14:39:04', null, '1', '1', '2021/10/02/2021_10_02_17_56_36_72931a92101def17106cf22be25e3bcc.pdf', '4', '22', '2020');
INSERT INTO files_history VALUES ('44', 'asd asdasd', null, 'asd asdasd', '2021-10-18 03:41:56', '2021-10-18 03:41:32', null, '1', null, '2021/10/18/asd_asdasd_2021_10_18_03_41_32_6921cf2cd4d96afeac7feaa274686662.jpg', '1', '34', '2021');
INSERT INTO files_history VALUES ('45', 'asdsd ad', null, 'asdsd ad', '2021-10-18 03:42:22', '2021-10-18 03:42:18', null, '1', null, '2021/10/18/asdsd_ad_2021_10_18_03_42_18_ce8e2c18faa98cb9e5144b0da1e5b508.jpg', '5', '35', '2021');
INSERT INTO files_history VALUES ('46', 'asdsd ad', null, 'asdsd ad', '2021-10-18 03:42:25', '2021-10-18 03:42:22', null, '1', '1', '2021/10/18/asdsd_ad_2021_10_18_03_42_18_ce8e2c18faa98cb9e5144b0da1e5b508.jpg', '5', '35', '2021');
INSERT INTO files_history VALUES ('47', 'asdaas adasd', null, 'asdaas adasd', '2021-10-18 06:05:36', '2021-10-11 10:02:53', null, '1', '1', '2021/10/11/asdaas_adasd_2021_10_11_09_51_44_e0b756ee50373ab6fed4ad6b1c56db70.xlsx', '1', '32', '2020');
INSERT INTO files_history VALUES ('48', 'asdaas adasd', null, 'asdaas adasd', '2021-10-18 06:12:38', '2021-10-18 06:05:36', null, '1', '1', '2021/10/11/asdaas_adasd_2021_10_11_09_51_44_e0b756ee50373ab6fed4ad6b1c56db70.xlsx', '1', '32', '2020');
INSERT INTO files_history VALUES ('49', 'Data Sewa Tanah', null, 'Data Sewa Tanah', '2021-10-18 06:18:00', '2021-10-02 00:45:18', null, '1', null, '2021/10/02/2021_10_02_00_45_18_86a6ee02a2bf178911805ff06801cbfa.xls', '31', '20', '2021');
INSERT INTO files_history VALUES ('50', 'Data Sewa Tanah', null, 'Data Sewa Tanah', '2021-10-18 06:18:09', '2021-10-18 06:18:00', null, '1', '1', '2021/10/02/2021_10_02_00_45_18_86a6ee02a2bf178911805ff06801cbfa.xls', '4', '20', '2021');
INSERT INTO files_history VALUES ('51', 'Kerangka Acuan Kerja', null, 'Kerangka Acuan Kerja', '2022-01-12 10:20:36', '2021-10-11 10:10:19', null, '1', '1', '2021/10/11/kerangka_acuan_kerja_2021_10_11_03_50_33_5edef0e415a42ce59deec01462cf1bf5.zip', '33', '31', '2021');

-- ----------------------------
-- Table structure for `images`
-- ----------------------------
DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(150) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `users_created` int(11) DEFAULT NULL,
  `users_updated` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of images
-- ----------------------------
INSERT INTO images VALUES ('1', 'test', 'test', '2021/02/05/2021_02_05_07_22_27_7a7838d0f6290be297d9e5143cf9d22b.png', '2021-02-05 07:22:27', '2021-02-05 07:22:29', '1', null);
INSERT INTO images VALUES ('4', 'asdsa asdsd', 'asdas dsda', '2021/05/24/2021_05_24_03_58_47_99aed13085c622afd3a60ea2524e7368.jpeg', '2021-05-24 03:53:51', '2021-05-24 03:58:47', '1', '1');

-- ----------------------------
-- Table structure for `logs`
-- ----------------------------
DROP TABLE IF EXISTS `logs`;
CREATE TABLE `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `detail` varchar(255) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `ip_address` varchar(30) DEFAULT NULL,
  `module_name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=146 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of logs
-- ----------------------------
INSERT INTO logs VALUES ('1', 'Menambahkan users dengan nama = Arif Firmansyah', null, null, 'Users', '2019-12-03 10:39:44', '2019-12-03 10:39:44');
INSERT INTO logs VALUES ('2', 'Mengubah users id = 1', null, null, 'Users', '2019-12-03 10:50:37', '2019-12-03 10:50:37');
INSERT INTO logs VALUES ('3', 'Mengubah users id = 1', null, null, 'Users', '2019-12-28 13:52:07', '2019-12-28 13:52:07');
INSERT INTO logs VALUES ('4', 'Menambahkan category nama = Berita', '1', null, 'Category', '2020-06-01 06:53:08', '2020-06-01 06:53:08');
INSERT INTO logs VALUES ('5', 'Menambahkan blog categories dengan nama = asdasd', '1', null, 'Blog Categories', '2021-05-24 03:14:22', '2021-05-24 03:14:22');
INSERT INTO logs VALUES ('6', 'Menambahkan Kategori dengan nama asdads ', '4', null, 'Kategori', '2021-10-05 01:21:48', '2021-10-05 01:21:48');
INSERT INTO logs VALUES ('7', 'Mengubah Kategori menjadi ssss ssss ', '4', null, 'Kategori', '2021-10-05 01:31:30', '2021-10-05 01:31:30');
INSERT INTO logs VALUES ('8', 'Menghapus Kategori dengan id = 38 ', '4', null, 'Kategori', '2021-10-05 01:32:56', '2021-10-05 01:32:56');
INSERT INTO logs VALUES ('9', 'Menambahkan Kategori dengan nama coba kategori popup ', '4', null, 'Kategori', '2021-10-05 01:41:02', '2021-10-05 01:41:02');
INSERT INTO logs VALUES ('10', 'Mengubah File/Dokumen menjadi Data Kegiatan Kelitbangan ', '1', null, 'File/Dokumen', '2021-10-06 03:18:19', '2021-10-06 03:18:19');
INSERT INTO logs VALUES ('11', 'Menambahkan Kategori dengan nama coba tambah kategori ', '1', null, 'Kategori', '2021-10-06 03:18:35', '2021-10-06 03:18:35');
INSERT INTO logs VALUES ('12', 'Menambahkan File / Dokumen dengan nama Coba file sekretariat ', '1', null, 'File / Dokumen', '2021-10-06 06:37:16', '2021-10-06 06:37:16');
INSERT INTO logs VALUES ('13', 'Mengubah File/Dokumen menjadi Coba file sekretariat ', '1', null, 'File/Dokumen', '2021-10-06 06:37:56', '2021-10-06 06:37:56');
INSERT INTO logs VALUES ('14', 'Mengubah File/Dokumen menjadi Coba file sekretariat asdadasd ', '1', null, 'File/Dokumen', '2021-10-06 06:53:54', '2021-10-06 06:53:54');
INSERT INTO logs VALUES ('15', 'Mengubah File/Dokumen menjadi Coba file sekretariat ', '1', null, 'File/Dokumen', '2021-10-06 06:54:18', '2021-10-06 06:54:18');
INSERT INTO logs VALUES ('16', 'Mengubah File/Dokumen menjadi Coba file sekretariat ', '1', null, 'File/Dokumen', '2021-10-06 06:55:01', '2021-10-06 06:55:01');
INSERT INTO logs VALUES ('17', 'Mengubah File/Dokumen menjadi Data Kegiatan Kelitbangan ', '1', null, 'File/Dokumen', '2021-10-06 06:56:48', '2021-10-06 06:56:48');
INSERT INTO logs VALUES ('18', 'Mengubah File/Dokumen menjadi Data Kegiatan Kelitbangan ', '1', null, 'File/Dokumen', '2021-10-06 06:57:59', '2021-10-06 06:57:59');
INSERT INTO logs VALUES ('19', 'Mengubah File/Dokumen menjadi Data Kegiatan Kelitbangan ', '1', null, 'File/Dokumen', '2021-10-06 06:58:56', '2021-10-06 06:58:56');
INSERT INTO logs VALUES ('20', 'Mengubah File/Dokumen menjadi Data Kegiatan Kelitbangan ', '1', null, 'File/Dokumen', '2021-10-06 06:59:16', '2021-10-06 06:59:16');
INSERT INTO logs VALUES ('21', 'Mengubah File/Dokumen menjadi Data Kegiatan Kelitbangan ', '1', null, 'File/Dokumen', '2021-10-06 06:59:17', '2021-10-06 06:59:17');
INSERT INTO logs VALUES ('22', 'Mengubah File/Dokumen menjadi Data Kegiatan Kelitbangan ', '1', null, 'File/Dokumen', '2021-10-06 06:59:28', '2021-10-06 06:59:28');
INSERT INTO logs VALUES ('23', 'Mengubah File/Dokumen menjadi Data Kegiatan Kelitbangan ', '1', null, 'File/Dokumen', '2021-10-06 06:59:58', '2021-10-06 06:59:58');
INSERT INTO logs VALUES ('24', 'Mengubah File/Dokumen menjadi Data Kegiatan Kelitbangan ', '1', null, 'File/Dokumen', '2021-10-06 07:00:20', '2021-10-06 07:00:20');
INSERT INTO logs VALUES ('25', 'Mengubah File/Dokumen menjadi Data Kegiatan Kelitbangan ', '1', null, 'File/Dokumen', '2021-10-06 07:00:29', '2021-10-06 07:00:29');
INSERT INTO logs VALUES ('26', 'Mengubah File/Dokumen menjadi Data Kegiatan Kelitbangan ', '1', null, 'File/Dokumen', '2021-10-06 07:00:39', '2021-10-06 07:00:39');
INSERT INTO logs VALUES ('27', 'Mengubah File/Dokumen menjadi Data dan Informasi LKPJ Tahun2020 ', '1', null, 'File/Dokumen', '2021-10-06 07:00:59', '2021-10-06 07:00:59');
INSERT INTO logs VALUES ('28', 'Mengubah File/Dokumen menjadi Data dan Informasi LKPJ Tahun2020 ', '1', null, 'File/Dokumen', '2021-10-06 07:01:05', '2021-10-06 07:01:05');
INSERT INTO logs VALUES ('29', 'Mengubah File/Dokumen menjadi Data dan Informasi LKPJ Tahun2020 ', '1', null, 'File/Dokumen', '2021-10-07 00:56:45', '2021-10-07 00:56:45');
INSERT INTO logs VALUES ('30', 'Mengubah File/Dokumen menjadi Data Kegiatan Kelitbangan ', '1', null, 'File/Dokumen', '2021-10-07 04:22:29', '2021-10-07 04:22:29');
INSERT INTO logs VALUES ('31', 'Mengubah File/Dokumen menjadi Coba file sekretariat ', '1', null, 'File/Dokumen', '2021-10-07 07:10:26', '2021-10-07 07:10:26');
INSERT INTO logs VALUES ('32', 'Menghapus File dengan judul = Coba file sekretariat ', '1', null, 'File', '2021-10-07 08:24:18', '2021-10-07 08:24:18');
INSERT INTO logs VALUES ('33', 'Menambahkan File / Dokumen dengan nama adad adsd ', '1', null, 'File / Dokumen', '2021-10-07 08:26:47', '2021-10-07 08:26:47');
INSERT INTO logs VALUES ('34', 'Menghapus File dengan judul = adad adsd ', '1', null, 'File', '2021-10-07 08:27:07', '2021-10-07 08:27:07');
INSERT INTO logs VALUES ('35', 'Menambahkan File / Dokumen dengan nama aaaaaaaaa aaaaaaaaaaaaa ', '1', null, 'File / Dokumen', '2021-10-07 08:27:23', '2021-10-07 08:27:23');
INSERT INTO logs VALUES ('36', 'Mengubah File/Dokumen menjadi aaaaaaaaa aaaaaaaaaaaaa ', '1', null, 'File/Dokumen', '2021-10-07 08:27:31', '2021-10-07 08:27:31');
INSERT INTO logs VALUES ('37', 'Menghapus File dengan judul = aaaaaaaaa aaaaaaaaaaaaa ', '1', null, 'File', '2021-10-07 08:33:48', '2021-10-07 08:33:48');
INSERT INTO logs VALUES ('38', 'Menambahkan File / Dokumen dengan nama adas asd ', '1', null, 'File / Dokumen', '2021-10-07 08:35:17', '2021-10-07 08:35:17');
INSERT INTO logs VALUES ('39', 'Menghapus File dengan judul = asdas dadad ', '1', null, 'File', '2021-10-07 08:35:31', '2021-10-07 08:35:31');
INSERT INTO logs VALUES ('40', 'Menghapus File dengan judul = adas dasd ', '1', null, 'File', '2021-10-07 08:35:34', '2021-10-07 08:35:34');
INSERT INTO logs VALUES ('41', 'Mengubah File/Dokumen menjadi adas asd ', '1', null, 'File/Dokumen', '2021-10-07 08:35:47', '2021-10-07 08:35:47');
INSERT INTO logs VALUES ('42', 'Menghapus File dengan judul = adas asd ', '1', null, 'File', '2021-10-07 08:36:09', '2021-10-07 08:36:09');
INSERT INTO logs VALUES ('43', 'Menambahkan File / Dokumen dengan nama Kerangka Acuan Kerja ', '1', null, 'File / Dokumen', '2021-10-11 03:50:33', '2021-10-11 03:50:33');
INSERT INTO logs VALUES ('44', 'Menambahkan Tag dengan nama asdasd ', '1', null, 'Tag', '2021-10-11 07:42:46', '2021-10-11 07:42:46');
INSERT INTO logs VALUES ('45', 'Menghapus Tag dengan judul = as ', '1', null, 'Tag', '2021-10-11 07:42:50', '2021-10-11 07:42:50');
INSERT INTO logs VALUES ('46', 'Menghapus Tag dengan judul = asdasd ', '1', null, 'Tag', '2021-10-11 07:42:53', '2021-10-11 07:42:53');
INSERT INTO logs VALUES ('47', 'Menambahkan Kategori dengan nama Bidang Perumahan ', '1', null, 'Kategori', '2021-10-11 09:28:23', '2021-10-11 09:28:23');
INSERT INTO logs VALUES ('48', 'Menambahkan File / Dokumen dengan nama asdaas adasd ', '1', null, 'File / Dokumen', '2021-10-11 09:51:44', '2021-10-11 09:51:44');
INSERT INTO logs VALUES ('49', 'Menambahkan Kategori dengan nama Bidang Kawasan Permukiman ', '1', null, 'Kategori', '2021-10-11 09:53:59', '2021-10-11 09:53:59');
INSERT INTO logs VALUES ('50', 'Mengubah File/Dokumen menjadi asdaas adasd ', '1', null, 'File/Dokumen', '2021-10-11 09:54:57', '2021-10-11 09:54:57');
INSERT INTO logs VALUES ('51', 'Mengubah File/Dokumen menjadi asdaas adasd ', '1', null, 'File/Dokumen', '2021-10-11 09:55:24', '2021-10-11 09:55:24');
INSERT INTO logs VALUES ('52', 'Mengubah File/Dokumen menjadi asdaas adasd ', '1', null, 'File/Dokumen', '2021-10-11 10:02:53', '2021-10-11 10:02:53');
INSERT INTO logs VALUES ('53', 'Mengubah File/Dokumen menjadi Kerangka Acuan Kerja ', '1', null, 'File/Dokumen', '2021-10-11 10:10:20', '2021-10-11 10:10:20');
INSERT INTO logs VALUES ('54', 'Mengubah File/Dokumen menjadi Indikator Kinerja Individu Eselon 3 ', '1', null, 'File/Dokumen', '2021-10-11 10:10:34', '2021-10-11 10:10:34');
INSERT INTO logs VALUES ('55', 'Mengubah File/Dokumen menjadi Indikator Kinerja Individu Eselon IV ', '1', null, 'File/Dokumen', '2021-10-11 10:10:43', '2021-10-11 10:10:43');
INSERT INTO logs VALUES ('56', 'Menghapus Kategori dengan judul = coba tambah kategori ', '1', null, 'Kategori', '2021-10-11 10:35:20', '2021-10-11 10:35:20');
INSERT INTO logs VALUES ('57', 'Menghapus Kategori dengan judul = coba kategori popup ', '1', null, 'Kategori', '2021-10-11 10:35:24', '2021-10-11 10:35:24');
INSERT INTO logs VALUES ('58', 'Menghapus Kategori dengan judul = Sekretariat ', '1', null, 'Kategori', '2021-10-12 04:33:42', '2021-10-12 04:33:42');
INSERT INTO logs VALUES ('59', 'Menghapus Kategori dengan judul = UPT Sarana dan Pasarana ', '1', null, 'Kategori', '2021-10-12 04:33:45', '2021-10-12 04:33:45');
INSERT INTO logs VALUES ('60', 'Menghapus Kategori dengan judul = UPT Rusunawa ', '1', null, 'Kategori', '2021-10-12 04:33:47', '2021-10-12 04:33:47');
INSERT INTO logs VALUES ('61', 'Menghapus Kategori dengan judul = UPT Tegallega ', '1', null, 'Kategori', '2021-10-12 04:33:52', '2021-10-12 04:33:52');
INSERT INTO logs VALUES ('62', 'Menghapus Kategori dengan judul = UPT Pembibitan ', '1', null, 'Kategori', '2021-10-12 04:33:54', '2021-10-12 04:33:54');
INSERT INTO logs VALUES ('63', 'Menghapus Kategori dengan judul = UPT Penghijauan ', '1', null, 'Kategori', '2021-10-12 04:33:57', '2021-10-12 04:33:57');
INSERT INTO logs VALUES ('64', 'Menghapus Kategori dengan judul = Bidang Pertanahan ', '1', null, 'Kategori', '2021-10-12 04:34:35', '2021-10-12 04:34:35');
INSERT INTO logs VALUES ('65', 'Menghapus Kategori dengan judul = Bidang PSU ', '1', null, 'Kategori', '2021-10-12 04:34:38', '2021-10-12 04:34:38');
INSERT INTO logs VALUES ('66', 'Menghapus Kategori dengan judul = Bidang Kawasan Permukiman ', '1', null, 'Kategori', '2021-10-12 04:34:40', '2021-10-12 04:34:40');
INSERT INTO logs VALUES ('67', 'Menghapus Kategori dengan judul = Bidang Pertamanan ', '1', null, 'Kategori', '2021-10-12 04:34:43', '2021-10-12 04:34:43');
INSERT INTO logs VALUES ('68', 'Menghapus Kategori dengan judul = Bidang Perumahan ', '1', null, 'Kategori', '2021-10-12 04:34:46', '2021-10-12 04:34:46');
INSERT INTO logs VALUES ('69', 'User Arif Firmansyah melakukan Login ', '1', null, 'Login', '2021-10-12 09:18:56', '2021-10-12 09:18:56');
INSERT INTO logs VALUES ('70', 'User Arif Firmansyah melakukan Login ', '1', null, 'Login', '2021-10-13 12:58:45', '2021-10-13 12:58:45');
INSERT INTO logs VALUES ('71', 'User Arif Firmansyah melakukan Login ', '1', null, 'Login', '2021-10-14 00:34:00', '2021-10-14 00:34:00');
INSERT INTO logs VALUES ('72', 'User Arif Firmansyah melakukan Login ', '1', null, 'Login', '2021-10-14 01:57:53', '2021-10-14 01:57:53');
INSERT INTO logs VALUES ('73', 'User Arif Firmansyah melakukan Login ', '1', null, 'Login', '2021-10-15 04:08:18', '2021-10-15 04:08:18');
INSERT INTO logs VALUES ('74', 'User Arif Firmansyah melakukan Login ', '1', null, 'Login', '2021-10-15 09:19:14', '2021-10-15 09:19:14');
INSERT INTO logs VALUES ('75', 'User Arif Firmansyah melakukan Login ', '1', null, 'Login', '2021-10-15 23:43:52', '2021-10-15 23:43:52');
INSERT INTO logs VALUES ('76', 'User Arif Firmansyah melakukan Login ', '1', null, 'Login', '2021-10-16 06:53:57', '2021-10-16 06:53:57');
INSERT INTO logs VALUES ('77', 'User Arif Firmansyah melakukan Login ', '1', null, 'Login', '2021-10-17 15:57:18', '2021-10-17 15:57:18');
INSERT INTO logs VALUES ('78', 'User Arif Firmansyah melakukan Login ', '1', null, 'Login', '2021-10-18 01:06:05', '2021-10-18 01:06:05');
INSERT INTO logs VALUES ('79', 'Menambahkan pengguna ssdadasdaa ', '1', null, 'Pengguna', '2021-10-18 02:38:39', '2021-10-18 02:38:39');
INSERT INTO logs VALUES ('80', 'Menghapus pengguna adads ', '1', null, 'Pengguna', '2021-10-18 02:38:49', '2021-10-18 02:38:49');
INSERT INTO logs VALUES ('81', 'Mengubah pengguna ssdadasdaasssss ', '1', null, 'Pengguna', '2021-10-18 02:39:00', '2021-10-18 02:39:00');
INSERT INTO logs VALUES ('82', 'Menghapus pengguna ssdadasdaasssss ', '1', null, 'Pengguna', '2021-10-18 02:39:14', '2021-10-18 02:39:14');
INSERT INTO logs VALUES ('83', 'Mengubah pengguna arif lagi ', '1', null, 'Pengguna', '2021-10-18 02:45:13', '2021-10-18 02:45:13');
INSERT INTO logs VALUES ('84', 'Mengubah pengguna arif lagi ', '1', null, 'Pengguna', '2021-10-18 02:45:25', '2021-10-18 02:45:25');
INSERT INTO logs VALUES ('85', 'Menambahkan File / Dokumen dengan nama asdas ', '1', null, 'File / Dokumen', '2021-10-18 03:41:06', '2021-10-18 03:41:06');
INSERT INTO logs VALUES ('86', 'Menghapus File dengan judul = asdas ', '1', null, 'File', '2021-10-18 03:41:20', '2021-10-18 03:41:20');
INSERT INTO logs VALUES ('87', 'Menambahkan File / Dokumen dengan nama asd asdasd ', '1', null, 'File / Dokumen', '2021-10-18 03:41:32', '2021-10-18 03:41:32');
INSERT INTO logs VALUES ('88', 'Mengubah File/Dokumen menjadi asd asdasd ', '1', null, 'File/Dokumen', '2021-10-18 03:41:56', '2021-10-18 03:41:56');
INSERT INTO logs VALUES ('89', 'Menghapus File dengan judul = asd asdasd ', '1', null, 'File', '2021-10-18 03:42:07', '2021-10-18 03:42:07');
INSERT INTO logs VALUES ('90', 'Menambahkan File / Dokumen dengan nama asdsd ad ', '1', null, 'File / Dokumen', '2021-10-18 03:42:18', '2021-10-18 03:42:18');
INSERT INTO logs VALUES ('91', 'Mengubah File/Dokumen menjadi asdsd ad ', '1', null, 'File/Dokumen', '2021-10-18 03:42:22', '2021-10-18 03:42:22');
INSERT INTO logs VALUES ('92', 'Mengubah File/Dokumen menjadi asdsd ad ', '1', null, 'File/Dokumen', '2021-10-18 03:42:25', '2021-10-18 03:42:25');
INSERT INTO logs VALUES ('93', 'Menghapus File dengan judul = asdsd ad ', '1', null, 'File', '2021-10-18 03:42:29', '2021-10-18 03:42:29');
INSERT INTO logs VALUES ('94', 'Menambahkan Bidang dengan nama Sekretariat ', '1', null, 'Bidang', '2021-10-18 03:44:28', '2021-10-18 03:44:28');
INSERT INTO logs VALUES ('95', 'Menambahkan Bidang dengan nama Bidang Pertamanan ', '1', null, 'Bidang', '2021-10-18 03:44:39', '2021-10-18 03:44:39');
INSERT INTO logs VALUES ('96', 'Menambahkan Bidang dengan nama Bidang Pertanahan ', '1', null, 'Bidang', '2021-10-18 03:44:46', '2021-10-18 03:44:46');
INSERT INTO logs VALUES ('97', 'Menambahkan Bidang dengan nama Bidang Prasarana, Sarana dan Utilitas (PSU) ', '1', null, 'Bidang', '2021-10-18 03:44:59', '2021-10-18 03:44:59');
INSERT INTO logs VALUES ('98', 'Menambahkan File / Dokumen dengan nama asdas asd ', '1', null, 'File / Dokumen', '2021-10-18 06:04:48', '2021-10-18 06:04:48');
INSERT INTO logs VALUES ('99', 'Menghapus File dengan judul = asdas asd ', '1', null, 'File', '2021-10-18 06:04:54', '2021-10-18 06:04:54');
INSERT INTO logs VALUES ('100', 'Mengubah File/Dokumen menjadi asdaas adasd ', '1', null, 'File/Dokumen', '2021-10-18 06:05:36', '2021-10-18 06:05:36');
INSERT INTO logs VALUES ('101', 'Mengubah File/Dokumen menjadi asdaas adasd ', '1', null, 'File/Dokumen', '2021-10-18 06:12:38', '2021-10-18 06:12:38');
INSERT INTO logs VALUES ('102', 'Mengubah File/Dokumen menjadi Data Sewa Tanah ', '1', null, 'File/Dokumen', '2021-10-18 06:18:00', '2021-10-18 06:18:00');
INSERT INTO logs VALUES ('103', 'Mengubah File/Dokumen menjadi Data Sewa Tanah ', '1', null, 'File/Dokumen', '2021-10-18 06:18:09', '2021-10-18 06:18:09');
INSERT INTO logs VALUES ('104', 'Mengubah pengguna arif lagi ', '1', null, 'Pengguna', '2021-10-18 08:12:04', '2021-10-18 08:12:04');
INSERT INTO logs VALUES ('105', 'User arif lagi melakukan Login ', '4', null, 'Login', '2021-10-18 08:12:14', '2021-10-18 08:12:14');
INSERT INTO logs VALUES ('106', 'User Arif Firmansyah melakukan Login ', '1', null, 'Login', '2021-10-18 08:13:55', '2021-10-18 08:13:55');
INSERT INTO logs VALUES ('107', 'User Arif Firmansyah melakukan Login ', '1', null, 'Login', '2021-10-18 08:14:18', '2021-10-18 08:14:18');
INSERT INTO logs VALUES ('108', 'Mengubah pengguna arif lagi ', '1', null, 'Pengguna', '2021-10-18 08:14:25', '2021-10-18 08:14:25');
INSERT INTO logs VALUES ('109', 'User arif lagi melakukan Login ', '4', null, 'Login', '2021-10-18 08:14:44', '2021-10-18 08:14:44');
INSERT INTO logs VALUES ('110', 'User Arif Firmansyah melakukan Login ', '1', null, 'Login', '2021-10-18 08:16:44', '2021-10-18 08:16:44');
INSERT INTO logs VALUES ('111', 'Menambahkan File / Dokumen dengan nama asd sadasd ', '1', null, 'File / Dokumen', '2021-10-18 11:24:08', '2021-10-18 11:24:08');
INSERT INTO logs VALUES ('112', 'User Arif Firmansyah melakukan Login ', '1', null, 'Login', '2021-10-19 01:26:56', '2021-10-19 01:26:56');
INSERT INTO logs VALUES ('113', 'Mengunduh File / Dokumen dengan nama asd sadasd ', '1', null, 'File / Dokumen', '2021-10-19 02:00:26', '2021-10-19 02:00:26');
INSERT INTO logs VALUES ('114', 'Mengunduh File / Dokumen dengan nama Kerangka Acuan Kerja ', '1', null, 'File / Dokumen', '2021-10-19 02:46:54', '2021-10-19 02:46:54');
INSERT INTO logs VALUES ('115', 'Mengunduh File / Dokumen dengan nama Indikator Kinerja Individu Eselon IV ', '1', null, 'File / Dokumen', '2021-10-19 02:46:56', '2021-10-19 02:46:56');
INSERT INTO logs VALUES ('116', 'Mengunduh File / Dokumen dengan nama asd sadasd ', '1', null, 'File / Dokumen', '2021-10-19 04:02:43', '2021-10-19 04:02:43');
INSERT INTO logs VALUES ('117', 'Mengunduh File / Dokumen dengan nama Data Kegiatan Kelitbangan ', '1', null, 'File / Dokumen', '2021-10-19 04:02:46', '2021-10-19 04:02:46');
INSERT INTO logs VALUES ('118', 'Mengunduh File / Dokumen dengan nama Data dan Informasi LKPJ Tahun2020 ', '1', null, 'File / Dokumen', '2021-10-19 04:03:15', '2021-10-19 04:03:15');
INSERT INTO logs VALUES ('119', 'Mengunduh File / Dokumen dengan nama Kerangka Acuan Kerja ', '1', null, 'File / Dokumen', '2021-10-19 04:05:31', '2021-10-19 04:05:31');
INSERT INTO logs VALUES ('120', 'Mengunduh File / Dokumen dengan nama Kerangka Acuan Kerja ', '1', null, 'File / Dokumen', '2021-10-19 04:05:35', '2021-10-19 04:05:35');
INSERT INTO logs VALUES ('121', 'Menambahkan Kategori dengan nama Capaian Kinerja ', '1', null, 'Kategori', '2021-10-19 04:22:09', '2021-10-19 04:22:09');
INSERT INTO logs VALUES ('122', 'Menambahkan Kategori dengan nama KAK ', '1', null, 'Kategori', '2021-10-19 04:22:22', '2021-10-19 04:22:22');
INSERT INTO logs VALUES ('123', 'Menambahkan File / Dokumen dengan nama asdas ', '1', null, 'File / Dokumen', '2021-10-19 06:10:57', '2021-10-19 06:10:57');
INSERT INTO logs VALUES ('124', 'Menghapus File dengan judul = asdaas adasd ', '1', null, 'File', '2021-10-19 07:51:02', '2021-10-19 07:51:02');
INSERT INTO logs VALUES ('125', 'Menghapus File dengan judul = asdas ', '1', null, 'File', '2021-10-19 07:51:04', '2021-10-19 07:51:04');
INSERT INTO logs VALUES ('126', 'Menghapus File dengan judul = asd sadasd ', '1', null, 'File', '2021-10-19 07:51:07', '2021-10-19 07:51:07');
INSERT INTO logs VALUES ('127', 'User Arif Firmansyah melakukan Login ', '1', null, 'Login', '2021-10-19 08:37:03', '2021-10-19 08:37:03');
INSERT INTO logs VALUES ('128', 'User Arif Firmansyah melakukan Login ', '1', null, 'Login', '2021-10-20 15:52:27', '2021-10-20 15:52:27');
INSERT INTO logs VALUES ('129', 'User Arif Firmansyah melakukan Login ', '1', null, 'Login', '2021-10-21 01:27:36', '2021-10-21 01:27:36');
INSERT INTO logs VALUES ('130', 'User Arif Firmansyah melakukan Login ', '1', null, 'Login', '2021-11-11 03:34:24', '2021-11-11 03:34:24');
INSERT INTO logs VALUES ('131', 'User Arif Firmansyah melakukan Login ', '1', null, 'Login', '2021-11-27 17:18:27', '2021-11-27 17:18:27');
INSERT INTO logs VALUES ('132', 'User Arif Firmansyah melakukan Login ', '1', null, 'Login', '2021-11-28 03:44:38', '2021-11-28 03:44:38');
INSERT INTO logs VALUES ('133', 'User Arif Firmansyah melakukan Login ', '1', null, 'Login', '2021-11-28 11:01:09', '2021-11-28 11:01:09');
INSERT INTO logs VALUES ('134', 'User Arif Firmansyah melakukan Login ', '1', null, 'Login', '2021-12-06 01:08:47', '2021-12-06 01:08:47');
INSERT INTO logs VALUES ('135', 'User Arif Firmansyah melakukan Login ', '1', null, 'Login', '2021-12-30 16:28:04', '2021-12-30 16:28:04');
INSERT INTO logs VALUES ('136', 'User Arif Firmansyah melakukan Login ', '1', null, 'Login', '2021-12-30 16:28:21', '2021-12-30 16:28:21');
INSERT INTO logs VALUES ('137', 'User Arif Firmansyah melakukan Login ', '1', null, 'Login', '2022-01-12 10:20:12', '2022-01-12 10:20:12');
INSERT INTO logs VALUES ('138', 'Mengubah File/Dokumen menjadi Kerangka Acuan Kerja ', '1', null, 'File/Dokumen', '2022-01-12 10:20:36', '2022-01-12 10:20:36');
INSERT INTO logs VALUES ('139', 'User Arif Firmansyah melakukan Login ', '1', null, 'Login', '2022-09-01 05:52:24', '2022-09-01 05:52:24');
INSERT INTO logs VALUES ('140', 'User Arif Firmansyah melakukan Login ', '1', null, 'Login', '2022-10-14 17:28:26', '2022-10-14 17:28:26');
INSERT INTO logs VALUES ('141', 'User Arif Firmansyah melakukan Login ', '1', null, 'Login', '2022-10-16 11:29:07', '2022-10-16 11:29:07');
INSERT INTO logs VALUES ('142', 'User Arif Firmansyah melakukan Login ', '1', null, 'Login', '2022-11-28 14:34:00', '2022-11-28 14:34:00');
INSERT INTO logs VALUES ('143', 'Mengubah Bidang menjadi Bidang Pertanahan dan PSU ', '1', null, 'Bidang', '2022-11-28 14:34:38', '2022-11-28 14:34:38');
INSERT INTO logs VALUES ('144', 'Mengubah Bidang menjadi Bidang Pertamanan dan Dekorasi Kota ', '1', null, 'Bidang', '2022-11-28 14:34:52', '2022-11-28 14:34:52');
INSERT INTO logs VALUES ('145', 'Menghapus Bidang dengan judul = Bidang Prasarana, Sarana dan Utilitas (PSU) ', '1', null, 'Bidang', '2022-11-28 14:35:06', '2022-11-28 14:35:06');

-- ----------------------------
-- Table structure for `password_resets`
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of password_resets
-- ----------------------------
INSERT INTO password_resets VALUES ('4', 'arifsyah11@gmail.com', '2jsCFQizleLsessjH1qG24KUm6v6E8wSGeleQ6Z9JUGXXFN27KRt0sDthc4326eC', '2021-06-07 03:25:54');

-- ----------------------------
-- Table structure for `rel_files_kategori`
-- ----------------------------
DROP TABLE IF EXISTS `rel_files_kategori`;
CREATE TABLE `rel_files_kategori` (
  `id` int(11) unsigned NOT NULL,
  `id_files` int(11) unsigned DEFAULT NULL,
  `id_kategori` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rel_files_kategori
-- ----------------------------

-- ----------------------------
-- Table structure for `rel_files_tag`
-- ----------------------------
DROP TABLE IF EXISTS `rel_files_tag`;
CREATE TABLE `rel_files_tag` (
  `id_files` int(11) unsigned DEFAULT NULL,
  `id_tag` int(11) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rel_files_tag
-- ----------------------------
INSERT INTO rel_files_tag VALUES ('16', '4');
INSERT INTO rel_files_tag VALUES ('16', '1');
INSERT INTO rel_files_tag VALUES ('17', '1');
INSERT INTO rel_files_tag VALUES ('17', '4');
INSERT INTO rel_files_tag VALUES ('19', '7');
INSERT INTO rel_files_tag VALUES ('19', '15');
INSERT INTO rel_files_tag VALUES ('19', '16');
INSERT INTO rel_files_tag VALUES ('18', '2');
INSERT INTO rel_files_tag VALUES ('18', '4');
INSERT INTO rel_files_tag VALUES ('21', '18');
INSERT INTO rel_files_tag VALUES ('21', '16');
INSERT INTO rel_files_tag VALUES ('24', '21');
INSERT INTO rel_files_tag VALUES ('24', '16');
INSERT INTO rel_files_tag VALUES ('24', '2');
INSERT INTO rel_files_tag VALUES ('25', '21');
INSERT INTO rel_files_tag VALUES ('25', '2');
INSERT INTO rel_files_tag VALUES ('25', '4');
INSERT INTO rel_files_tag VALUES ('26', '4');
INSERT INTO rel_files_tag VALUES ('23', '20');
INSERT INTO rel_files_tag VALUES ('23', '2');
INSERT INTO rel_files_tag VALUES ('22', '20');
INSERT INTO rel_files_tag VALUES ('22', '2');
INSERT INTO rel_files_tag VALUES ('20', '9');
INSERT INTO rel_files_tag VALUES ('20', '17');
INSERT INTO rel_files_tag VALUES ('31', '22');
INSERT INTO rel_files_tag VALUES ('31', '11');

-- ----------------------------
-- Table structure for `subcategories`
-- ----------------------------
DROP TABLE IF EXISTS `subcategories`;
CREATE TABLE `subcategories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `slug` varchar(255) DEFAULT NULL,
  `description` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` int(1) unsigned DEFAULT NULL,
  `user_created` int(11) unsigned DEFAULT NULL,
  `user_modified` int(11) unsigned DEFAULT NULL,
  `id_categories` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of subcategories
-- ----------------------------

-- ----------------------------
-- Table structure for `tags`
-- ----------------------------
DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `show` int(1) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `users_created` int(11) DEFAULT NULL,
  `users_modified` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tags
-- ----------------------------
INSERT INTO tags VALUES ('1', 'Bidang Pertamanan', null, 'Bidang Pertamanan', '2021-09-19 10:34:47', '2021-10-02 00:34:41', null, null, '1', '1');
INSERT INTO tags VALUES ('2', 'PMPRB', null, 'Reformasi Birokrasi', '2021-09-23 15:29:19', '2021-09-23 15:29:19', null, null, '1', null);
INSERT INTO tags VALUES ('4', 'SPIP', null, 'Sistem Pemerintahan', '2021-09-23 15:29:39', '2021-09-23 15:29:39', null, null, '1', null);
INSERT INTO tags VALUES ('5', 'Standar Pelayanan', null, 'Standar Pelayanan', '2021-09-23 15:30:00', '2021-09-23 15:30:00', null, null, '1', null);
INSERT INTO tags VALUES ('6', 'Bidang Perumahan', null, 'Bidang Perumahan', '2021-09-30 08:15:01', '2021-10-02 00:35:02', null, null, '1', '1');
INSERT INTO tags VALUES ('7', 'Bidang Kawasan Permukiman', null, 'Bidang Kawasan Permukiman', '2021-09-30 08:15:40', '2021-10-02 00:35:13', null, null, '1', '1');
INSERT INTO tags VALUES ('8', 'Bidang PSU', null, 'Bidang PSU', '2021-09-30 08:29:47', '2021-10-02 00:35:23', null, null, '1', '1');
INSERT INTO tags VALUES ('9', 'Bidang Pertanahan', null, 'Bidang Pertanahan', '2021-10-02 00:35:30', '2021-10-02 00:35:30', null, null, '1', null);
INSERT INTO tags VALUES ('10', 'UPT Penghijauan', null, 'UPT Penghijauan', '2021-10-02 00:35:35', '2021-10-02 00:35:35', null, null, '1', null);
INSERT INTO tags VALUES ('11', 'UPT Pembibitan', null, 'UPT Pembibitan', '2021-10-02 00:35:40', '2021-10-02 00:35:40', null, null, '1', null);
INSERT INTO tags VALUES ('12', 'UPT Tegallega', null, 'UPT Tegallega', '2021-10-02 00:35:44', '2021-10-02 00:35:44', null, null, '1', null);
INSERT INTO tags VALUES ('13', 'UPT Rusunawa', null, 'UPT Rusunawa', '2021-10-02 00:35:48', '2021-10-02 00:35:48', null, null, '1', null);
INSERT INTO tags VALUES ('14', 'UPT Sarana dan Pasarana', null, 'UPT Sarana dan Pasarana', '2021-10-02 00:35:53', '2021-10-02 00:35:53', null, null, '1', null);
INSERT INTO tags VALUES ('15', 'SPM', null, 'SPM', '2021-10-02 00:43:15', '2021-10-02 00:43:15', null, null, '1', null);
INSERT INTO tags VALUES ('16', 'Laporan', null, 'Laporan', '2021-10-02 00:43:30', '2021-10-02 00:43:30', null, null, '1', null);
INSERT INTO tags VALUES ('17', 'sewa tanah', null, 'sewa tanah', '2021-10-02 00:45:04', '2021-10-02 00:45:04', null, null, '1', null);
INSERT INTO tags VALUES ('18', 'LKPJ', null, 'LKPJ', '2021-10-02 00:49:55', '2021-10-02 00:49:55', null, null, '1', null);
INSERT INTO tags VALUES ('19', 'DPKP3', null, 'DPKP3', '2021-10-02 00:50:11', '2021-10-02 17:54:49', null, null, '1', '1');
INSERT INTO tags VALUES ('20', 'IKI', null, 'Indikator Kinerja Individu', '2021-10-02 17:56:11', '2021-10-02 17:56:11', null, null, '1', null);
INSERT INTO tags VALUES ('21', 'Sekretariat', null, 'Sekretariat', '2021-10-02 17:59:35', '2021-10-02 17:59:35', null, null, '1', null);
INSERT INTO tags VALUES ('22', 'KAK', null, 'Kerangka Acuan Kerja', '2021-10-11 03:50:12', '2021-10-11 03:50:12', null, null, '1', null);

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `is_activated` int(1) DEFAULT NULL,
  `kode` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `nip` double(15,0) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO users VALUES ('1', 'Arif Firmansyah', 'arifsyah11@gmail.com', null, '1', null, '$2y$12$6qH42sBOHO4cnc05Y8w97.SI1bjyHDerOnTMbh4vfxOpKyFurg2Ci', null, null, '1', null, null, '0');
