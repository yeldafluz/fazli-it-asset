-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for it_sistem
CREATE DATABASE IF NOT EXISTS `it_sistem` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `it_sistem`;

-- Dumping structure for table it_sistem.aset
CREATE TABLE IF NOT EXISTS `aset` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(100) DEFAULT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `no_siri` varchar(50) DEFAULT NULL,
  `lokasi_asal` varchar(100) DEFAULT NULL,
  `lokasi_sekarang` varchar(100) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `tarikh_update` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tarikh_masuk` date DEFAULT NULL,
  `tarikh_keluar` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table it_sistem.aset: ~0 rows (approximately)
INSERT INTO `aset` (`id`, `nama_barang`, `kategori`, `no_siri`, `lokasi_asal`, `lokasi_sekarang`, `status`, `tarikh_update`, `tarikh_masuk`, `tarikh_keluar`) VALUES
	(6, 'Dell Monitor 22inch', 'Monitor', 'monitor01', NULL, 'B1-DesaRishah', 'In-Use', '2026-01-13 18:15:20', '2026-01-11', '2026-01-13'),
	(7, 'Keyboard Gaming', 'Keyboard', 'keyboard01', NULL, 'Control Room', 'Ready Stock', '2026-01-13 18:16:30', '2026-01-13', NULL),
	(8, 'Receipt Printer', 'Receipt Printer', 'printer01', NULL, 'Control Room', 'Ready Stock', '2026-01-13 18:19:02', '2026-01-13', NULL),
	(9, 'Keyboard Pecah', 'PC/Laptop', 'Keyboard02', NULL, 'B2-Tasek', 'Repair', '2026-01-13 18:20:55', '2026-01-04', '2026-01-14');

-- Dumping structure for table it_sistem.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table it_sistem.users: ~1 rows (approximately)
INSERT INTO `users` (`id`, `username`, `password`) VALUES
	(1, 'admin', 'admin123');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
