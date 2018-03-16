-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 16, 2018 at 03:01 AM
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
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) DEFAULT NULL,
  `header` varchar(100) NOT NULL DEFAULT 'Ain''t it Fun',
  `content` varchar(500) NOT NULL DEFAULT 'Brick by Boring Brick',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upvotes` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `downvotes` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `tags` varchar(100) NOT NULL DEFAULT 'noob',
  PRIMARY KEY (`id`),
  KEY `fk_questions_account_id` (`account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `account_id`, `header`, `content`, `date`, `upvotes`, `downvotes`, `tags`) VALUES
(1, 1, 'How many fingers does a gopher have?', 'I cant seem to find the information on google. can anyone help ?', '2018-03-16 02:39:48', 0, 0, 'animal, silly'),
(2, 1, 'Where can you go to the bathroom legally?', 'Im asking about the non usual places? for Science reasons. ', '2018-03-16 02:39:48', 0, 0, 'potty, bathroom'),
(3, 1, 'Ain\'t it Fun?', 'Riot! or Self titled is better?\r\n\r\npersonally Riot! is the best', '2018-03-16 02:43:34', 0, 0, 'Paramore. album, music'),
(4, NULL, 'How now brown cow', 'Testing question with no account id (i.e. account was removed)', '2018-03-16 02:43:34', 0, 0, 'removed, test');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `fk_questions_account_id` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
