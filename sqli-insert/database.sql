-- Adminer 4.6.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `lxl_data`;
CREATE TABLE `lxl_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(75) NOT NULL,
  `author` varchar(255) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `lxl_data` (`id`, `link`, `author`, `date`) VALUES
(1,	'https://wegihngetik.blogspot.com/',	'Lutfi Anam',	'2020-07-25');

-- 2020-07-25 16:41:59
