-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.39 - Source distribution
-- Server OS:                    Linux
-- HeidiSQL Version:             9.2.0.4947
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for nearmiss_db
DROP DATABASE IF EXISTS `nearmiss_db`;
CREATE DATABASE IF NOT EXISTS `nearmiss_db` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `nearmiss_db`;


-- Dumping structure for table nearmiss_db.constval
DROP TABLE IF EXISTS `constval`;
CREATE TABLE IF NOT EXISTS `constval` (
  `name` varchar(250) DEFAULT NULL,
  `value` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table nearmiss_db.constval: ~9 rows (approximately)
DELETE FROM `constval`;
/*!40000 ALTER TABLE `constval` DISABLE KEYS */;
INSERT INTO `constval` (`name`, `value`) VALUES
	('sf_anggotabadan_code_prefix', 'AB'),
	('show_number_datatable', '10'),
	('sf_cedera_code_prefix', 'CE'),
	('sf_hubungan_code_prefix', 'SH'),
	('sf_jenispekerjaan_code_prefix', 'JP'),
	('sf_jenisbahaya_code_prefix', 'JB'),
	('sf_keadaan_code_prefix', 'SK'),
	('sf_klasifikasi_code_prefix', 'KS'),
	('sf_sumberp_code_prefix', 'SP');
/*!40000 ALTER TABLE `constval` ENABLE KEYS */;


-- Dumping structure for table nearmiss_db.departemen
DROP TABLE IF EXISTS `departemen`;
CREATE TABLE IF NOT EXISTS `departemen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `nama` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) DEFAULT NULL,
  `desc` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pic` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table nearmiss_db.departemen: ~1 rows (approximately)
DELETE FROM `departemen`;
/*!40000 ALTER TABLE `departemen` DISABLE KEYS */;
INSERT INTO `departemen` (`id`, `code`, `nama`, `created_at`, `user_id`, `desc`, `pic`) VALUES
	(2, 'HSE', 'Human Safety and Environment', '2015-06-19 07:22:04', 1, 'Departemen Keselamatan dan Lingkungan', 'Katamso');
/*!40000 ALTER TABLE `departemen` ENABLE KEYS */;


-- Dumping structure for table nearmiss_db.divisi
DROP TABLE IF EXISTS `divisi`;
CREATE TABLE IF NOT EXISTS `divisi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `nama` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table nearmiss_db.divisi: ~0 rows (approximately)
DELETE FROM `divisi`;
/*!40000 ALTER TABLE `divisi` DISABLE KEYS */;
/*!40000 ALTER TABLE `divisi` ENABLE KEYS */;


-- Dumping structure for table nearmiss_db.menu
DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `url` varchar(250) DEFAULT NULL,
  `if_url` varchar(250) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `publish` enum('Y','N') DEFAULT 'Y',
  `order` int(11) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- Dumping data for table nearmiss_db.menu: ~25 rows (approximately)
DELETE FROM `menu`;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`id`, `nama`, `url`, `if_url`, `parent_id`, `publish`, `order`, `icon`) VALUES
	(1, 'Home', 'home', 'home', 0, 'Y', 1, 'fa-home'),
	(2, 'Master', '#', 'master*', 0, 'Y', 2, 'fa-th-large'),
	(3, 'Anggota Badan', 'master/safetyanggotabadan', 'master/safetyanggotabadan*', 2, 'Y', 1, NULL),
	(4, 'Cedera', 'master/safetycedera', 'master/safetycedera*', 2, 'Y', 2, NULL),
	(5, 'Hub dengan plant', 'master/safetyhubungan', 'master/safetyhubungan*', 2, 'Y', 3, NULL),
	(6, 'Jenis Pekerjaan', 'master/jenispekerjaan', 'master/jenispekerjaan*', 2, 'Y', 4, NULL),
	(7, 'Jenis Bahaya', 'master/jenisbahaya', 'master/jenisbahaya*', 2, 'Y', 5, NULL),
	(8, 'Keadaan', 'master/safetykeadaan', 'master/safetykeadaan*', 2, 'Y', 6, NULL),
	(9, 'Pegawai', 'master/pegawai', 'master/pegawai*', 2, 'Y', 10, NULL),
	(10, 'Departemen', 'master/departemen', 'master/departemen*', 2, 'Y', 11, NULL),
	(11, 'Group', 'master/group', 'master/group*', 2, 'Y', 8, NULL),
	(12, 'Vendor', 'master/vendor', 'master/vendor*', 2, 'Y', 9, NULL),
	(13, 'Work Request', 'master/workreq', 'master/workreq*', 2, 'Y', 12, NULL),
	(14, 'Sumber Penyebab', 'master/safetysumberp', 'master/safetysumberp*', 2, 'Y', 13, NULL),
	(15, 'Resepsionis', NULL, NULL, 2, 'Y', 14, NULL),
	(16, 'Transaksi', NULL, NULL, 0, 'Y', 3, 'fa-download'),
	(17, 'Safety', NULL, NULL, 16, 'Y', 1, NULL),
	(18, 'Near Miss', NULL, NULL, 16, 'Y', 2, NULL),
	(19, 'Pasal', NULL, NULL, 16, 'Y', 3, NULL),
	(20, 'Work Permit', NULL, NULL, 16, 'Y', 4, NULL),
	(21, 'Aturan Keselamatan', NULL, NULL, 16, 'Y', 5, NULL),
	(22, 'Monitoring', NULL, NULL, 0, 'Y', 4, 'fa-signal'),
	(23, 'Near Miss', NULL, NULL, 22, 'Y', 1, NULL),
	(24, 'Grafik Near Miss', NULL, NULL, 22, 'Y', 2, NULL),
	(25, 'Klasifikasi', 'master/safetyklasifikasi', 'master/safetyklasifikasi*', 2, 'Y', 7, NULL);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;


-- Dumping structure for table nearmiss_db.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table nearmiss_db.migrations: ~0 rows (approximately)
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;


-- Dumping structure for table nearmiss_db.pegawai
DROP TABLE IF EXISTS `pegawai`;
CREATE TABLE IF NOT EXISTS `pegawai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL,
  `kode` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nama` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jns_kelamin` enum('M','F') COLLATE utf8_unicode_ci DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `tmpt_lahir` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alamat` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kota` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telp` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tgl_masuk` date DEFAULT NULL,
  `posisi_id` int(11) DEFAULT NULL,
  `level_pegawai` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `group_pegawai` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nama_label` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `label_departemen` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `resign` enum('Y','N') COLLATE utf8_unicode_ci DEFAULT NULL,
  `status_safety` enum('Y','N') COLLATE utf8_unicode_ci DEFAULT NULL,
  `status_nearmiss` enum('Y','N') COLLATE utf8_unicode_ci DEFAULT NULL,
  `status_pic` enum('Y','N') COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `departemen_id` int(11) NOT NULL,
  `divisi_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ts_pegawai_users1_idx` (`user_id`),
  KEY `fk_ts_pegawai_departemen1_idx` (`departemen_id`),
  KEY `fk_ts_pegawai_divisi1_idx` (`divisi_id`),
  CONSTRAINT `fk_ts_pegawai_departemen1` FOREIGN KEY (`departemen_id`) REFERENCES `departemen` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ts_pegawai_divisi1` FOREIGN KEY (`divisi_id`) REFERENCES `divisi` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ts_pegawai_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table nearmiss_db.pegawai: ~0 rows (approximately)
DELETE FROM `pegawai`;
/*!40000 ALTER TABLE `pegawai` DISABLE KEYS */;
/*!40000 ALTER TABLE `pegawai` ENABLE KEYS */;


-- Dumping structure for table nearmiss_db.permissions
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `deskription` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `permissions_name_index` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table nearmiss_db.permissions: ~0 rows (approximately)
DELETE FROM `permissions`;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;


-- Dumping structure for table nearmiss_db.permission_role
DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE IF NOT EXISTS `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  KEY `permission_role_permission_id_index` (`permission_id`),
  KEY `permission_role_role_id_index` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table nearmiss_db.permission_role: ~0 rows (approximately)
DELETE FROM `permission_role`;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;


-- Dumping structure for table nearmiss_db.roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `deskription` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `roles_name_index` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table nearmiss_db.roles: ~1 rows (approximately)
DELETE FROM `roles`;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `deskription`, `level`, `created_at`, `updated_at`) VALUES
	(1, 'Super Admin', NULL, 10, '2015-06-12 06:23:03', '2015-06-12 06:23:03');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;


-- Dumping structure for table nearmiss_db.role_user
DROP TABLE IF EXISTS `role_user`;
CREATE TABLE IF NOT EXISTS `role_user` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  KEY `role_user_user_id_index` (`user_id`),
  KEY `role_user_role_id_index` (`role_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table nearmiss_db.role_user: ~1 rows (approximately)
DELETE FROM `role_user`;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` (`user_id`, `role_id`, `created_at`, `updated_at`) VALUES
	(1, 1, '2015-06-12 06:23:03', '2015-06-12 06:23:03');
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;


-- Dumping structure for table nearmiss_db.sec_group
DROP TABLE IF EXISTS `sec_group`;
CREATE TABLE IF NOT EXISTS `sec_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL,
  `code` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nama` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ws` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sec_group_users1_idx` (`user_id`),
  CONSTRAINT `fk_sec_group_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table nearmiss_db.sec_group: ~2 rows (approximately)
DELETE FROM `sec_group`;
/*!40000 ALTER TABLE `sec_group` DISABLE KEYS */;
INSERT INTO `sec_group` (`id`, `created_at`, `code`, `nama`, `ws`, `user_id`) VALUES
	(1, '2015-06-21 11:45:25', 'GR1', 'MCE', '1', 1),
	(2, '2015-06-21 11:48:13', 'GR2', 'BLEN', '1', 1);
/*!40000 ALTER TABLE `sec_group` ENABLE KEYS */;


-- Dumping structure for table nearmiss_db.sf_anggota_badan
DROP TABLE IF EXISTS `sf_anggota_badan`;
CREATE TABLE IF NOT EXISTS `sf_anggota_badan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL COMMENT '\n',
  `code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `desk` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sf_anggota_badan_users1_idx` (`user_id`),
  CONSTRAINT `fk_sf_anggota_badan_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table nearmiss_db.sf_anggota_badan: ~21 rows (approximately)
DELETE FROM `sf_anggota_badan`;
/*!40000 ALTER TABLE `sf_anggota_badan` DISABLE KEYS */;
INSERT INTO `sf_anggota_badan` (`id`, `created_at`, `code`, `desk`, `user_id`) VALUES
	(1, '2015-06-12 14:21:31', 'AB1', 'Pergelangan Tangan', 1),
	(2, '2015-06-12 14:27:01', 'AB2', 'Tidak Cedera', 1),
	(3, '2015-06-12 14:27:05', 'AB3', 'Lengan', 1),
	(4, '2015-06-12 14:27:36', 'AB4', 'Punggung', 1),
	(5, '2015-06-12 14:27:39', 'AB5', 'Telinga', 1),
	(6, '2015-06-12 14:27:41', 'AB6', 'Siku', 1),
	(7, '2015-06-12 14:27:48', 'AB7', 'Mata', 1),
	(8, '2015-06-12 14:27:50', 'AB8', 'Muka', 1),
	(9, '2015-06-12 14:27:52', 'AB9', 'Jari', 1),
	(10, '2015-06-12 14:28:18', 'AB10', 'Kaki', 1),
	(11, '2015-06-12 14:28:20', 'AB11', 'Tangan', 1),
	(12, '2015-06-12 14:28:22', 'AB12', 'Kepala', 1),
	(13, '2015-06-12 14:28:40', 'AB13', 'Organ Bagian Dalam', 1),
	(14, '2015-06-12 14:28:43', 'AB14', 'Lutut', 1),
	(15, '2015-06-12 14:28:58', 'AB15', 'Tungkai Bawah (Kaki)', 1),
	(16, '2015-06-12 14:29:02', 'AB16', 'Mulut', 1),
	(17, '2015-06-12 14:29:10', 'AB17', 'Leher', 1),
	(18, '2015-06-12 14:29:15', 'AB18', 'Hidung', 1),
	(20, '2015-06-12 14:40:15', 'AB20', 'Dagu', 1),
	(56, '2015-06-19 07:00:36', 'AB56', 'Jempol Kaki', 1),
	(57, '2015-06-19 07:00:54', 'AB57', 'Jempol Tangan', 1);
/*!40000 ALTER TABLE `sf_anggota_badan` ENABLE KEYS */;


-- Dumping structure for table nearmiss_db.sf_cedera
DROP TABLE IF EXISTS `sf_cedera`;
CREATE TABLE IF NOT EXISTS `sf_cedera` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL COMMENT '\n',
  `code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `desk` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sf_cedera_users1_idx` (`user_id`),
  CONSTRAINT `fk_sf_cedera_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table nearmiss_db.sf_cedera: ~34 rows (approximately)
DELETE FROM `sf_cedera`;
/*!40000 ALTER TABLE `sf_cedera` DISABLE KEYS */;
INSERT INTO `sf_cedera` (`id`, `created_at`, `code`, `desk`, `user_id`) VALUES
	(3, '2015-06-12 15:54:28', 'CE3', 'Tidak Cedera', 1),
	(4, '2015-06-12 15:56:29', 'CE4', 'Lecet/Barut-barut', 1),
	(5, '2015-06-12 15:56:35', 'CE5', 'Amputasi', 1),
	(6, '2015-06-12 15:56:41', 'CE6', 'Tidak sadar karena kekurangan O2', 1),
	(7, '2015-06-12 15:56:47', 'CE7', 'Bengkak', 1),
	(8, '2015-06-12 15:56:55', 'CE8', 'Terbakar bahan kimia', 1),
	(9, '2015-06-12 15:57:03', 'CE9', 'Terbakar karena arus listrik', 1),
	(10, '2015-06-12 15:57:10', 'CE10', 'Terbakar karena panas', 1),
	(11, '2015-06-12 15:57:15', 'CE11', 'Terkejut dan hilang kesadaran', 1),
	(12, '2015-06-12 15:57:21', 'CE12', 'Tergilas', 1),
	(13, '2015-06-12 15:57:24', 'CE13', 'Ketegangan yang menumpuk', 1),
	(14, '2015-06-12 15:57:30', 'CE14', 'Terpotong atau tergores', 1),
	(15, '2015-06-12 15:57:39', 'CE15', 'Tuli', 1),
	(16, '2015-06-12 15:57:44', 'CE16', 'Iritasi Kulit', 1),
	(17, '2015-06-12 15:57:48', 'CE17', 'Sendi Terlepas', 1),
	(18, '2015-06-12 15:57:54', 'CE18', 'Kejutan Listrik', 1),
	(19, '2015-06-12 15:57:58', 'CE19', 'Mata', 1),
	(20, '2015-06-12 15:58:03', 'CE20', 'Bagian tubuh lainnya', 1),
	(21, '2015-06-12 15:58:08', 'CE21', 'Retak Tulang', 1),
	(22, '2015-06-12 15:58:12', 'CE22', 'Lumpuh', 1),
	(23, '2015-06-12 15:58:16', 'CE23', 'Gangguan Pendengaran', 1),
	(24, '2015-06-12 15:58:21', 'CE24', 'Stress/Stroke', 1),
	(25, '2015-06-12 15:58:28', 'CE25', 'Hernia', 1),
	(26, '2015-06-12 15:58:32', 'CE26', 'Melepuh', 1),
	(27, '2015-06-12 15:58:42', 'CE27', 'Lain-lain, silahkan identifikasi di uraian', 1),
	(28, '2015-06-12 15:58:53', 'CE28', 'Tertusuk', 1),
	(29, '2015-06-12 15:58:56', 'CE29', 'Radiasi', 1),
	(30, '2015-06-12 15:59:01', 'CE30', 'Kerusakan Organ Dalam', 1),
	(31, '2015-06-12 15:59:07', 'CE31', 'Otot Meregang dan Terkilir', 1),
	(32, '2015-06-12 15:59:13', 'CE32', 'Keracunan asap/keracunan lainnya', 1),
	(33, '2015-06-12 15:59:18', 'CE33', 'Tidak Diketahui', 1),
	(34, '2015-06-12 15:59:23', 'CE34', 'Hampir Cedera', 1),
	(35, '2015-06-19 07:02:02', 'CE35', 'Luka-luka parah sekali', 1),
	(36, '2015-06-19 07:02:08', 'CE36', 'Hampir Mati', 1);
/*!40000 ALTER TABLE `sf_cedera` ENABLE KEYS */;


-- Dumping structure for table nearmiss_db.sf_hubungan
DROP TABLE IF EXISTS `sf_hubungan`;
CREATE TABLE IF NOT EXISTS `sf_hubungan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL COMMENT '\n',
  `code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `desk` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sf_hubungan_users1_idx` (`user_id`),
  CONSTRAINT `fk_sf_hubungan_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table nearmiss_db.sf_hubungan: ~0 rows (approximately)
DELETE FROM `sf_hubungan`;
/*!40000 ALTER TABLE `sf_hubungan` DISABLE KEYS */;
/*!40000 ALTER TABLE `sf_hubungan` ENABLE KEYS */;


-- Dumping structure for table nearmiss_db.sf_jenis_bahaya
DROP TABLE IF EXISTS `sf_jenis_bahaya`;
CREATE TABLE IF NOT EXISTS `sf_jenis_bahaya` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL COMMENT '\n',
  `code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `desk` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sf_jenis_bahaya_users1_idx` (`user_id`),
  CONSTRAINT `fk_sf_jenis_bahaya_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table nearmiss_db.sf_jenis_bahaya: ~0 rows (approximately)
DELETE FROM `sf_jenis_bahaya`;
/*!40000 ALTER TABLE `sf_jenis_bahaya` DISABLE KEYS */;
/*!40000 ALTER TABLE `sf_jenis_bahaya` ENABLE KEYS */;


-- Dumping structure for table nearmiss_db.sf_jenis_pekerjaan
DROP TABLE IF EXISTS `sf_jenis_pekerjaan`;
CREATE TABLE IF NOT EXISTS `sf_jenis_pekerjaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL COMMENT '\n',
  `code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `desk` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sf_jenis_pekerjaan_users1_idx` (`user_id`),
  CONSTRAINT `fk_sf_jenis_pekerjaan_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table nearmiss_db.sf_jenis_pekerjaan: ~0 rows (approximately)
DELETE FROM `sf_jenis_pekerjaan`;
/*!40000 ALTER TABLE `sf_jenis_pekerjaan` DISABLE KEYS */;
/*!40000 ALTER TABLE `sf_jenis_pekerjaan` ENABLE KEYS */;


-- Dumping structure for table nearmiss_db.sf_keadaan
DROP TABLE IF EXISTS `sf_keadaan`;
CREATE TABLE IF NOT EXISTS `sf_keadaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL COMMENT '\n',
  `code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `desk` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sf_keadaan_users1_idx` (`user_id`),
  CONSTRAINT `fk_sf_keadaan_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table nearmiss_db.sf_keadaan: ~0 rows (approximately)
DELETE FROM `sf_keadaan`;
/*!40000 ALTER TABLE `sf_keadaan` DISABLE KEYS */;
/*!40000 ALTER TABLE `sf_keadaan` ENABLE KEYS */;


-- Dumping structure for table nearmiss_db.sf_klasifikasi
DROP TABLE IF EXISTS `sf_klasifikasi`;
CREATE TABLE IF NOT EXISTS `sf_klasifikasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL COMMENT '\n',
  `code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `desk` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sf_klasifikasi_users1_idx` (`user_id`),
  CONSTRAINT `fk_sf_klasifikasi_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table nearmiss_db.sf_klasifikasi: ~0 rows (approximately)
DELETE FROM `sf_klasifikasi`;
/*!40000 ALTER TABLE `sf_klasifikasi` DISABLE KEYS */;
/*!40000 ALTER TABLE `sf_klasifikasi` ENABLE KEYS */;


-- Dumping structure for table nearmiss_db.sf_lokasi
DROP TABLE IF EXISTS `sf_lokasi`;
CREATE TABLE IF NOT EXISTS `sf_lokasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL COMMENT '\n',
  `code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `desk` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sf_lokasi_users1_idx` (`user_id`),
  CONSTRAINT `fk_sf_lokasi_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table nearmiss_db.sf_lokasi: ~0 rows (approximately)
DELETE FROM `sf_lokasi`;
/*!40000 ALTER TABLE `sf_lokasi` DISABLE KEYS */;
/*!40000 ALTER TABLE `sf_lokasi` ENABLE KEYS */;


-- Dumping structure for table nearmiss_db.sf_sumber_penyebab
DROP TABLE IF EXISTS `sf_sumber_penyebab`;
CREATE TABLE IF NOT EXISTS `sf_sumber_penyebab` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL COMMENT '\n',
  `code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `desk` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sf_sumber_penyebab_users1_idx` (`user_id`),
  CONSTRAINT `fk_sf_sumber_penyebab_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table nearmiss_db.sf_sumber_penyebab: ~0 rows (approximately)
DELETE FROM `sf_sumber_penyebab`;
/*!40000 ALTER TABLE `sf_sumber_penyebab` DISABLE KEYS */;
/*!40000 ALTER TABLE `sf_sumber_penyebab` ENABLE KEYS */;


-- Dumping structure for procedure nearmiss_db.SP_INSERT_SAFETY
DROP PROCEDURE IF EXISTS `SP_INSERT_SAFETY`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_INSERT_SAFETY`(IN `p_desc` VARCHAR(250), IN `p_userid` INT, IN `p_table` VARCHAR(100), IN `p_prefix_col_name` VARCHAR(100))
begin

SET @sql_text = concat("insert into ", p_table,"(desk,user_id,created_at) values ('",p_desc,"','",p_userid,"',sysdate())");
PREPARE stmt FROM @sql_text;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

select @prefix := value from constval where name = p_prefix_col_name COLLATE utf8_unicode_ci  limit 1 ;

SET @sql_text2 = concat('select @newid := max(id) from ', p_table);
PREPARE stmt2 FROM @sql_text2;
EXECUTE stmt2;
DEALLOCATE PREPARE stmt2;

select @newid,@prefix,p_desc from dual;

SET @sql_text3 = concat("update ", p_table," set code = '",concat(@prefix,@newid),"' where id = @newid");
PREPARE stmt3 FROM @sql_text3;
EXECUTE stmt3;
DEALLOCATE PREPARE stmt3;

end//
DELIMITER ;


-- Dumping structure for table nearmiss_db.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `disabled` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_username_index` (`username`),
  KEY `users_password_index` (`password`),
  KEY `users_email_index` (`email`),
  KEY `users_remember_token_index` (`remember_token`),
  KEY `users_deleted_at_index` (`deleted_at`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table nearmiss_db.users: ~1 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`, `salt`, `email`, `remember_token`, `verified`, `disabled`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'admin', '$2a$08$Afz2r1HFDMA8cSoo6GwkCOlAQSHGMMNdO31aDenx10iUfKiANITHO', '8ba5d18b4cd2b70626a912a775f94658', 'admin@example.com', 'r7peivPFrAtLSfolurmo1NUEi0wwcveFOB5Nz8ASBESc4YQBqNMkBi7ZvuRg', 1, 0, '2015-06-12 06:23:03', '2015-06-19 00:19:18', NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


-- Dumping structure for table nearmiss_db.vendor
DROP TABLE IF EXISTS `vendor`;
CREATE TABLE IF NOT EXISTS `vendor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL,
  `code` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nama` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `desk` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alamat` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_person` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ts_vendor_users1_idx` (`user_id`),
  CONSTRAINT `fk_ts_vendor_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table nearmiss_db.vendor: ~3 rows (approximately)
DELETE FROM `vendor`;
/*!40000 ALTER TABLE `vendor` DISABLE KEYS */;
INSERT INTO `vendor` (`id`, `created_at`, `code`, `nama`, `desk`, `alamat`, `contact_person`, `phone`, `fax`, `email`, `user_id`) VALUES
	(10, '2015-06-21 12:33:57', 'VE10', 'ALP', 'ALP Petro Industry', 'Gempol', 'raditya', '0821', '08212', 'raditya.bayu.waskita@gmail.com', 1),
	(11, '2015-06-21 12:45:27', 'VE11', 'BNL', 'bahana', 'jakarta', 'bayu waskita', '0978', '087', 'waskita@gmail.com', 1),
	(12, '2015-06-21 13:04:13', 'VE12', 'SVL', 'GANI', 'GANI', 'bayu', '098', '0111', 'bayu@gmail.com', 1);
/*!40000 ALTER TABLE `vendor` ENABLE KEYS */;


-- Dumping structure for view nearmiss_db.VIEW_DEPARTEMEN
DROP VIEW IF EXISTS `VIEW_DEPARTEMEN`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `VIEW_DEPARTEMEN` (
	`id` INT(11) NOT NULL,
	`code` VARCHAR(3) NOT NULL COLLATE 'utf8_unicode_ci',
	`nama` VARCHAR(45) NULL COLLATE 'utf8_unicode_ci',
	`created_at` TIMESTAMP NULL,
	`user_id` INT(11) NULL,
	`username` VARCHAR(30) NOT NULL COLLATE 'utf8_unicode_ci',
	`desc` VARCHAR(150) NULL COLLATE 'utf8_unicode_ci',
	`pic` VARCHAR(50) NULL COLLATE 'utf8_unicode_ci'
) ENGINE=MyISAM;


-- Dumping structure for view nearmiss_db.view_group
DROP VIEW IF EXISTS `view_group`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `view_group` (
	`id` INT(11) NOT NULL,
	`code` VARCHAR(10) NULL COLLATE 'utf8_unicode_ci',
	`nama` VARCHAR(30) NULL COLLATE 'utf8_unicode_ci',
	`ws` CHAR(1) NULL COLLATE 'utf8_unicode_ci',
	`user_id` INT(10) UNSIGNED NOT NULL,
	`username` VARCHAR(30) NOT NULL COLLATE 'utf8_unicode_ci',
	`created_at` DATETIME NULL
) ENGINE=MyISAM;


-- Dumping structure for view nearmiss_db.VIEW_PEGAWAI
DROP VIEW IF EXISTS `VIEW_PEGAWAI`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `VIEW_PEGAWAI` (
	`id` INT(11) NOT NULL,
	`created_at` DATETIME NULL,
	`kode` VARCHAR(45) NULL COLLATE 'utf8_unicode_ci',
	`nama` VARCHAR(150) NULL COLLATE 'utf8_unicode_ci',
	`jns_kelamin` ENUM('M','F') NULL COLLATE 'utf8_unicode_ci',
	`tgl_lahir` DATE NULL,
	`tmpt_lahir` VARCHAR(50) NULL COLLATE 'utf8_unicode_ci',
	`status` VARCHAR(10) NULL COLLATE 'utf8_unicode_ci',
	`alamat` VARCHAR(100) NULL COLLATE 'utf8_unicode_ci',
	`kota` VARCHAR(50) NULL COLLATE 'utf8_unicode_ci',
	`telp` VARCHAR(20) NULL COLLATE 'utf8_unicode_ci',
	`tgl_masuk` DATE NULL,
	`posisi_id` INT(11) NULL,
	`level_pegawai` VARCHAR(2) NULL COLLATE 'utf8_unicode_ci',
	`group_pegawai` VARCHAR(10) NULL COLLATE 'utf8_unicode_ci',
	`nama_label` VARCHAR(50) NULL COLLATE 'utf8_unicode_ci',
	`label_departemen` VARCHAR(30) NULL COLLATE 'utf8_unicode_ci',
	`email` VARCHAR(60) NULL COLLATE 'utf8_unicode_ci',
	`resign` ENUM('Y','N') NULL COLLATE 'utf8_unicode_ci',
	`status_safety` ENUM('Y','N') NULL COLLATE 'utf8_unicode_ci',
	`status_nearmiss` ENUM('Y','N') NULL COLLATE 'utf8_unicode_ci',
	`status_pic` ENUM('Y','N') NULL COLLATE 'utf8_unicode_ci',
	`user_id` INT(10) UNSIGNED NOT NULL,
	`departemen_id` INT(11) NOT NULL,
	`kode_departemen` VARCHAR(3) NOT NULL COLLATE 'utf8_unicode_ci',
	`departemen` VARCHAR(45) NULL COLLATE 'utf8_unicode_ci',
	`divisi_id` INT(11) NOT NULL,
	`kode_divisi` VARCHAR(3) NOT NULL COLLATE 'utf8_unicode_ci',
	`divisi` VARCHAR(45) NULL COLLATE 'utf8_unicode_ci'
) ENGINE=MyISAM;


-- Dumping structure for view nearmiss_db.VIEW_SF_ANGGOTA_BADAN
DROP VIEW IF EXISTS `VIEW_SF_ANGGOTA_BADAN`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `VIEW_SF_ANGGOTA_BADAN` (
	`id` INT(11) NOT NULL,
	`created_at` DATETIME NULL COMMENT '\n',
	`code` VARCHAR(50) NULL COLLATE 'utf8_unicode_ci',
	`desk` VARCHAR(150) NULL COLLATE 'utf8_unicode_ci',
	`user_id` INT(10) UNSIGNED NOT NULL,
	`username` VARCHAR(30) NOT NULL COLLATE 'utf8_unicode_ci'
) ENGINE=MyISAM;


-- Dumping structure for view nearmiss_db.VIEW_SF_CEDERA
DROP VIEW IF EXISTS `VIEW_SF_CEDERA`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `VIEW_SF_CEDERA` (
	`id` INT(11) NOT NULL,
	`created_at` DATETIME NULL COMMENT '\n',
	`code` VARCHAR(50) NULL COLLATE 'utf8_unicode_ci',
	`desk` VARCHAR(150) NULL COLLATE 'utf8_unicode_ci',
	`user_id` INT(10) UNSIGNED NOT NULL,
	`username` VARCHAR(30) NOT NULL COLLATE 'utf8_unicode_ci'
) ENGINE=MyISAM;


-- Dumping structure for view nearmiss_db.view_sf_hubungan
DROP VIEW IF EXISTS `view_sf_hubungan`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `view_sf_hubungan` (
	`id` INT(11) NOT NULL,
	`created_at` DATETIME NULL COMMENT '\n',
	`code` VARCHAR(50) NULL COLLATE 'utf8_unicode_ci',
	`desk` VARCHAR(150) NULL COLLATE 'utf8_unicode_ci',
	`user_id` INT(10) UNSIGNED NOT NULL,
	`username` VARCHAR(30) NOT NULL COLLATE 'utf8_unicode_ci'
) ENGINE=MyISAM;


-- Dumping structure for view nearmiss_db.view_sf_jenis_bahaya
DROP VIEW IF EXISTS `view_sf_jenis_bahaya`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `view_sf_jenis_bahaya` (
	`id` INT(11) NOT NULL,
	`created_at` DATETIME NULL COMMENT '\n',
	`code` VARCHAR(50) NULL COLLATE 'utf8_unicode_ci',
	`desk` VARCHAR(150) NULL COLLATE 'utf8_unicode_ci',
	`user_id` INT(10) UNSIGNED NOT NULL,
	`username` VARCHAR(30) NOT NULL COLLATE 'utf8_unicode_ci'
) ENGINE=MyISAM;


-- Dumping structure for view nearmiss_db.view_sf_jenis_pekerjaan
DROP VIEW IF EXISTS `view_sf_jenis_pekerjaan`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `view_sf_jenis_pekerjaan` (
	`id` INT(11) NOT NULL,
	`created_at` DATETIME NULL COMMENT '\n',
	`code` VARCHAR(50) NULL COLLATE 'utf8_unicode_ci',
	`desk` VARCHAR(150) NULL COLLATE 'utf8_unicode_ci',
	`user_id` INT(10) UNSIGNED NOT NULL,
	`username` VARCHAR(30) NOT NULL COLLATE 'utf8_unicode_ci'
) ENGINE=MyISAM;


-- Dumping structure for view nearmiss_db.view_sf_keadaan
DROP VIEW IF EXISTS `view_sf_keadaan`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `view_sf_keadaan` (
	`id` INT(11) NOT NULL,
	`created_at` DATETIME NULL COMMENT '\n',
	`code` VARCHAR(50) NULL COLLATE 'utf8_unicode_ci',
	`desk` VARCHAR(150) NULL COLLATE 'utf8_unicode_ci',
	`user_id` INT(10) UNSIGNED NOT NULL,
	`username` VARCHAR(30) NOT NULL COLLATE 'utf8_unicode_ci'
) ENGINE=MyISAM;


-- Dumping structure for view nearmiss_db.view_sf_klasifikasi
DROP VIEW IF EXISTS `view_sf_klasifikasi`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `view_sf_klasifikasi` (
	`id` INT(11) NOT NULL,
	`created_at` DATETIME NULL COMMENT '\n',
	`code` VARCHAR(50) NULL COLLATE 'utf8_unicode_ci',
	`desk` VARCHAR(150) NULL COLLATE 'utf8_unicode_ci',
	`user_id` INT(10) UNSIGNED NOT NULL,
	`username` VARCHAR(30) NOT NULL COLLATE 'utf8_unicode_ci'
) ENGINE=MyISAM;


-- Dumping structure for view nearmiss_db.view_vendor
DROP VIEW IF EXISTS `view_vendor`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `view_vendor` (
	`id` INT(11) NOT NULL,
	`code` VARCHAR(10) NULL COLLATE 'utf8_unicode_ci',
	`nama` VARCHAR(100) NULL COLLATE 'utf8_unicode_ci',
	`desk` VARCHAR(50) NULL COLLATE 'utf8_unicode_ci',
	`alamat` VARCHAR(150) NULL COLLATE 'utf8_unicode_ci',
	`contact_person` VARCHAR(30) NULL COLLATE 'utf8_unicode_ci',
	`phone` VARCHAR(20) NULL COLLATE 'utf8_unicode_ci',
	`fax` VARCHAR(20) NULL COLLATE 'utf8_unicode_ci',
	`email` VARCHAR(100) NULL COLLATE 'utf8_unicode_ci',
	`user_id` INT(10) UNSIGNED NOT NULL,
	`username` VARCHAR(30) NOT NULL COLLATE 'utf8_unicode_ci',
	`created_at` DATETIME NULL
) ENGINE=MyISAM;


-- Dumping structure for view nearmiss_db.VIEW_DEPARTEMEN
DROP VIEW IF EXISTS `VIEW_DEPARTEMEN`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `VIEW_DEPARTEMEN`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `VIEW_DEPARTEMEN` AS select `dp`.`id` AS `id`,`dp`.`code` AS `code`,`dp`.`nama` AS `nama`,`dp`.`created_at` AS `created_at`,`dp`.`user_id` AS `user_id`,`users`.`username` AS `username`,`dp`.`desc` AS `desc`,`dp`.`pic` AS `pic` from (`departemen` `dp` join `users` on((`dp`.`user_id` = `users`.`id`)));


-- Dumping structure for view nearmiss_db.view_group
DROP VIEW IF EXISTS `view_group`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `view_group`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_group` AS select `sec_group`.`id` AS `id`,`sec_group`.`code` AS `code`,`sec_group`.`nama` AS `nama`,`sec_group`.`ws` AS `ws`,`sec_group`.`user_id` AS `user_id`,`users`.`username` AS `username`,`sec_group`.`created_at` AS `created_at` from (`sec_group` join `users` on((`sec_group`.`user_id` = `users`.`id`))) order by `sec_group`.`id`;


-- Dumping structure for view nearmiss_db.VIEW_PEGAWAI
DROP VIEW IF EXISTS `VIEW_PEGAWAI`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `VIEW_PEGAWAI`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `VIEW_PEGAWAI` AS select `pegawai`.`id` AS `id`,`pegawai`.`created_at` AS `created_at`,`pegawai`.`kode` AS `kode`,`pegawai`.`nama` AS `nama`,`pegawai`.`jns_kelamin` AS `jns_kelamin`,`pegawai`.`tgl_lahir` AS `tgl_lahir`,`pegawai`.`tmpt_lahir` AS `tmpt_lahir`,`pegawai`.`status` AS `status`,`pegawai`.`alamat` AS `alamat`,`pegawai`.`kota` AS `kota`,`pegawai`.`telp` AS `telp`,`pegawai`.`tgl_masuk` AS `tgl_masuk`,`pegawai`.`posisi_id` AS `posisi_id`,`pegawai`.`level_pegawai` AS `level_pegawai`,`pegawai`.`group_pegawai` AS `group_pegawai`,`pegawai`.`nama_label` AS `nama_label`,`pegawai`.`label_departemen` AS `label_departemen`,`pegawai`.`email` AS `email`,`pegawai`.`resign` AS `resign`,`pegawai`.`status_safety` AS `status_safety`,`pegawai`.`status_nearmiss` AS `status_nearmiss`,`pegawai`.`status_pic` AS `status_pic`,`pegawai`.`user_id` AS `user_id`,`pegawai`.`departemen_id` AS `departemen_id`,`departemen`.`code` AS `kode_departemen`,`departemen`.`nama` AS `departemen`,`pegawai`.`divisi_id` AS `divisi_id`,`divisi`.`code` AS `kode_divisi`,`divisi`.`nama` AS `divisi` from ((`divisi` join `pegawai` on((`divisi`.`id` = `pegawai`.`divisi_id`))) join `departemen` on((`pegawai`.`departemen_id` = `departemen`.`id`)));


-- Dumping structure for view nearmiss_db.VIEW_SF_ANGGOTA_BADAN
DROP VIEW IF EXISTS `VIEW_SF_ANGGOTA_BADAN`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `VIEW_SF_ANGGOTA_BADAN`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `VIEW_SF_ANGGOTA_BADAN` AS select `sfa`.`id` AS `id`,`sfa`.`created_at` AS `created_at`,`sfa`.`code` AS `code`,`sfa`.`desk` AS `desk`,`sfa`.`user_id` AS `user_id`,`usr`.`username` AS `username` from (`sf_anggota_badan` `sfa` join `users` `usr` on((`sfa`.`user_id` = `usr`.`id`)));


-- Dumping structure for view nearmiss_db.VIEW_SF_CEDERA
DROP VIEW IF EXISTS `VIEW_SF_CEDERA`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `VIEW_SF_CEDERA`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `VIEW_SF_CEDERA` AS select `sfa`.`id` AS `id`,`sfa`.`created_at` AS `created_at`,`sfa`.`code` AS `code`,`sfa`.`desk` AS `desk`,`sfa`.`user_id` AS `user_id`,`usr`.`username` AS `username` from (`sf_cedera` `sfa` join `users` `usr` on((`sfa`.`user_id` = `usr`.`id`)));


-- Dumping structure for view nearmiss_db.view_sf_hubungan
DROP VIEW IF EXISTS `view_sf_hubungan`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `view_sf_hubungan`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_sf_hubungan` AS select `sfh`.`id` AS `id`,`sfh`.`created_at` AS `created_at`,`sfh`.`code` AS `code`,`sfh`.`desk` AS `desk`,`sfh`.`user_id` AS `user_id`,`usr`.`username` AS `username` from (`sf_hubungan` `sfh` join `users` `usr` on((`sfh`.`user_id` = `usr`.`id`))) order by `sfh`.`id`;


-- Dumping structure for view nearmiss_db.view_sf_jenis_bahaya
DROP VIEW IF EXISTS `view_sf_jenis_bahaya`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `view_sf_jenis_bahaya`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_sf_jenis_bahaya` AS select `sfjb`.`id` AS `id`,`sfjb`.`created_at` AS `created_at`,`sfjb`.`code` AS `code`,`sfjb`.`desk` AS `desk`,`sfjb`.`user_id` AS `user_id`,`usr`.`username` AS `username` from (`sf_jenis_bahaya` `sfjb` join `users` `usr` on((`sfjb`.`user_id` = `usr`.`id`))) order by `sfjb`.`id`;


-- Dumping structure for view nearmiss_db.view_sf_jenis_pekerjaan
DROP VIEW IF EXISTS `view_sf_jenis_pekerjaan`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `view_sf_jenis_pekerjaan`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_sf_jenis_pekerjaan` AS select `sfjp`.`id` AS `id`,`sfjp`.`created_at` AS `created_at`,`sfjp`.`code` AS `code`,`sfjp`.`desk` AS `desk`,`sfjp`.`user_id` AS `user_id`,`usr`.`username` AS `username` from (`sf_jenis_pekerjaan` `sfjp` join `users` `usr` on((`sfjp`.`user_id` = `usr`.`id`))) order by `sfjp`.`id`;


-- Dumping structure for view nearmiss_db.view_sf_keadaan
DROP VIEW IF EXISTS `view_sf_keadaan`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `view_sf_keadaan`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_sf_keadaan` AS select `sfke`.`id` AS `id`,`sfke`.`created_at` AS `created_at`,`sfke`.`code` AS `code`,`sfke`.`desk` AS `desk`,`sfke`.`user_id` AS `user_id`,`usr`.`username` AS `username` from (`sf_keadaan` `sfke` join `users` `usr` on((`sfke`.`user_id` = `usr`.`id`))) order by `sfke`.`id`;


-- Dumping structure for view nearmiss_db.view_sf_klasifikasi
DROP VIEW IF EXISTS `view_sf_klasifikasi`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `view_sf_klasifikasi`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_sf_klasifikasi` AS select `sfkl`.`id` AS `id`,`sfkl`.`created_at` AS `created_at`,`sfkl`.`code` AS `code`,`sfkl`.`desk` AS `desk`,`sfkl`.`user_id` AS `user_id`,`usr`.`username` AS `username` from (`sf_klasifikasi` `sfkl` join `users` `usr` on((`sfkl`.`user_id` = `usr`.`id`))) order by `sfkl`.`id`;


-- Dumping structure for view nearmiss_db.view_vendor
DROP VIEW IF EXISTS `view_vendor`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `view_vendor`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_vendor` AS select `vendor`.`id` AS `id`,`vendor`.`code` AS `code`,`vendor`.`nama` AS `nama`,`vendor`.`desk` AS `desk`,`vendor`.`alamat` AS `alamat`,`vendor`.`contact_person` AS `contact_person`,`vendor`.`phone` AS `phone`,`vendor`.`fax` AS `fax`,`vendor`.`email` AS `email`,`vendor`.`user_id` AS `user_id`,`users`.`username` AS `username`,`vendor`.`created_at` AS `created_at` from (`vendor` join `users` on((`vendor`.`user_id` = `users`.`id`))) order by `vendor`.`id`;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
