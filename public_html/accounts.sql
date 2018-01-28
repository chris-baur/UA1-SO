-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 28, 2018 at 05:10 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ua1_so`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL DEFAULT 'john117',
  `password` varchar(500) DEFAULT NULL,
  `name` varchar(25) NOT NULL DEFAULT 'default name',
  `last_name` varchar(25) NOT NULL DEFAULT 'default  last',
  `gender` set('male','female','other') NOT NULL DEFAULT 'other',
  `security_one` set('q1','q2','q3') DEFAULT 'q1',
  `security_two` set('q1','q2','q3') NOT NULL DEFAULT 'q1',
  `answer_one` varchar(20) NOT NULL DEFAULT 'a1',
  `answer_two` varchar(20) NOT NULL DEFAULT 'a1',
  `bio` varchar(500) NOT NULL DEFAULT 'Training to be like goku',
  `profession` set('gamer','student','potatoe','teacher','professor','hipster','trainer','sloth') NOT NULL DEFAULT 'potatoe',
  `pin` tinyint(4) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
