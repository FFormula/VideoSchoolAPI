-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.6.28-log - MySQL Community Server (GPL)
-- ОС Сервера:                   Win64
-- HeidiSQL Версия:              9.1.0.4867
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры базы данных drivers
CREATE DATABASE IF NOT EXISTS `drivers` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `drivers`;


-- Дамп структуры для таблица drivers.db_version
CREATE TABLE IF NOT EXISTS `db_version` (
  `required_2017_02_23` bit(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

-- Дамп данных таблицы drivers.db_version: 1 rows
/*!40000 ALTER TABLE `db_version` DISABLE KEYS */;
INSERT IGNORE INTO `db_version` (`required_2017_02_23`) VALUES
	(NULL);
/*!40000 ALTER TABLE `db_version` ENABLE KEYS */;


-- Дамп структуры для таблица drivers.docs
CREATE TABLE IF NOT EXISTS `docs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `driver_id` int(11) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `info` text COMMENT 'Тип документа и комментарий',
  PRIMARY KEY (`id`),
  KEY `FK_docs_drivers` (`driver_id`),
  CONSTRAINT `FK_docs_drivers` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Список прикреплённых файлов-документов';

-- Дамп данных таблицы drivers.docs: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `docs` DISABLE KEYS */;
/*!40000 ALTER TABLE `docs` ENABLE KEYS */;


-- Дамп структуры для таблица drivers.drivers
CREATE TABLE IF NOT EXISTS `drivers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `insert_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `father_name` varchar(255) DEFAULT NULL,
  `passport_serial` varchar(255) DEFAULT NULL,
  `passport_number` varchar(255) DEFAULT NULL,
  `license_serial` varchar(255) DEFAULT NULL,
  `license_number` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '0 - drop, 1 - to check, 2 - approved',
  `info` text,
  PRIMARY KEY (`id`),
  KEY `FK_drivers_users` (`user_id`),
  CONSTRAINT `FK_drivers_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='Список водителей';

-- Дамп данных таблицы drivers.drivers: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `drivers` DISABLE KEYS */;
/*!40000 ALTER TABLE `drivers` ENABLE KEYS */;


-- Дамп структуры для таблица drivers.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `park` varchar(255) DEFAULT NULL,
  `failed_logins` int(11) unsigned NOT NULL DEFAULT '0',
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='Список пользователей системы';

-- Дамп данных таблицы drivers.users: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT IGNORE INTO `users` (`id`, `name`, `email`, `password`, `phone`, `park`, `failed_logins`, `status`) VALUES
	(1, 'Admin', 'admin', 'admin', NULL, NULL, 0, 3);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
