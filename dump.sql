-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.7.25 - MySQL Community Server (GPL)
-- Операционная система:         Win64
-- HeidiSQL Версия:              11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Дамп структуры базы данных mvc
CREATE DATABASE IF NOT EXISTS `mvc` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `mvc`;

-- Дамп структуры для таблица mvc.logs
CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `current_query` varchar(255) DEFAULT NULL,
  `method` varchar(255) DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  `query_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы mvc.logs: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;

-- Дамп структуры для таблица mvc.messages
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `text` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы mvc.messages: ~7 rows (приблизительно)
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` (`id`, `author_id`, `image`, `created_at`, `text`) VALUES
	(1, 7, NULL, '2020-07-04 21:31:49', '543'),
	(2, 7, 'E:\\OpenServer\\tmp\\OSPanel\\userdata\\temp\\php8046.tmp', '2020-07-04 21:33:27', 'bfdx h dxhjxd '),
	(3, 7, '7493f5443a79b3a44e139c61073a122fd9ec47af.jpg', '2020-07-04 21:37:32', 'b63 hhrfm n'),
	(4, 1, NULL, '2020-07-04 22:44:06', 'dgsd hs hs ghshd s'),
	(5, 1, NULL, '2020-07-04 22:44:09', 'dfgs hs yhas zhz '),
	(6, 1, NULL, '2020-07-04 22:44:21', 'dgs sdhg sdazh sejhn '),
	(8, 1, NULL, '2020-07-04 22:45:29', 'ds ghsd hash ah adsa g');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;

-- Дамп структуры для таблица mvc.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_idx` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы mvc.users: ~4 rows (приблизительно)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `created_at`, `email`, `password`, `image`) VALUES
	(1, 'odmen', '2020-06-24 23:46:46', 'odmen@odmen.odmen', 'bf465db9e7f00067627b28cc216bc2a3b10d0667', '64f2332cb2eb24f0425c3120de401471a5e8fe97.jpg'),
	(2, 'test1234', '2020-06-24 12:54:36', 'test1234@test.ru', 'bf465db9e7f00067627b28cc216bc2a3b10d0667', '4ef9a5fc675d7c45170a4924813179c39a87b06a.jpg'),
	(3, 'Лолкек', '2020-06-24 13:09:27', 'lolkek@kek.ru', 'd353e76c8f27abd68e70bbb1da4eaa8d762f1d47', NULL),
	(8, '423151223', '2020-07-05 00:13:24', '55215@fdsg.ty', 'Qwerty123', NULL),
	(11, 'Олег', '2020-07-05 09:58:24', 'Олег', 'Олег1', '6b458ebdb11dfdc9122085ba2006c28b88e96095.jpg'),
	(12, 'Павел', '2020-07-05 10:00:21', 'Павел', 'Павел', '32249dcb2e5d428073d11cc854414044bc529145.jpg'),
	(13, 'Ольга', '2020-07-05 10:01:35', 'Ольга', 'Ольга', '6c486647395e820fb930e05b5925f7b887cdf481.jpg');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
