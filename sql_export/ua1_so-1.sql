-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 16, 2018 at 05:28 AM
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
-- Add database account
--

GRANT ALL PRIVILEGES ON ua1_so.* TO 'ua1'@'localhost' IDENTIFIED BY 'Ua1password0)';

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL DEFAULT 'john117',
  `password` varchar(500) DEFAULT NULL,
  `name` varchar(25) NOT NULL DEFAULT 'default name',
  `last_name` varchar(25) NOT NULL DEFAULT 'default  last',
  `gender` set('Male','Female','Other') NOT NULL DEFAULT 'Male',
  `security_one` set('What is the first name of the person you first kissed?','What is the last name of the teacher who gave you your first failing grade?','What is your pets name?','What was the name of your elementary / primary school?','In what city or town does your nearest sibling live?','What was your childhood nickname?','What is the name of your favorite childhood friend?') DEFAULT 'What is the first name of the person you first kissed?',
  `security_two` set('In what city or town did your mother and father meet?','What is the middle name of your oldest child?','What is your favorite team?','What is your favorite movie?','What was your favorite sport in high school?','What was your favorite food as a child?','Who is your childhood sports hero?','What was the name of the company where you had your first job?') NOT NULL DEFAULT 'In what city or town did your mother and father meet?',
  `answer_one` varchar(20) NOT NULL DEFAULT 'a1',
  `answer_two` varchar(20) NOT NULL DEFAULT 'a2',
  `bio` varchar(500) NOT NULL DEFAULT 'Training to be like goku',
  `profession` set('Gamer','Student','Potatoe','Teacher','Professor','Hipster','Trainer','Sloth') NOT NULL DEFAULT 'Potatoe',
  `pin` varchar(4) DEFAULT NULL,
  `profile_picture_path` varchar(500) NOT NULL DEFAULT '../img/avatar2.png',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`, `name`, `last_name`, `gender`, `security_one`, `security_two`, `answer_one`, `answer_two`, `bio`, `profession`, `pin`, `profile_picture_path`) VALUES
(1, 'john117', '$2y$10$C/uoZeY8TclVBl7UskXJceE7v800lyCnANBNtbTWX6jH7/dtOSqoK', 'John', 'Master Chief', 'Male', 'What is the first name of the person you first kissed?', 'In what city or town did your mother and father meet?', 'Cortana', 'EDZ', 'Last Spartan Alive', 'Gamer', NULL, '../img/avatar2.png');

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
CREATE TABLE IF NOT EXISTS `answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `content` varchar(500) NOT NULL DEFAULT 'noob did not answer',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upvotes` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `downvotes` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `best` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_answers_account_id` (`account_id`),
  KEY `fk_answers_question_id` (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(250) NOT NULL DEFAULT 'This is noob''s comment',
  `account_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `answer_id` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_comments_account_id` (`account_id`),
  KEY `fk_comments_question_id` (`question_id`),
  KEY `fk_comments_answer_id` (`answer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `favourites`
--

DROP TABLE IF EXISTS `favourites`;
CREATE TABLE IF NOT EXISTS `favourites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `answer_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_favourties_account_id` (`account_id`),
  KEY `fk_favourites_question_id` (`question_id`),
  KEY `fk_favourites_answer_id` (`answer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(3, 1, 'Aint it Fun?', 'Riot! or Self titled is better?\r\n\r\npersonally Riot! is the best', '2018-03-16 02:43:34', 0, 0, 'Paramore. album, music'),
(4, NULL, 'How now brown cow', 'Testing question with no account id (i.e. account was removed)', '2018-03-16 02:43:34', 0, 0, 'removed, test');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `fk_answers_account_id` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_answers_question_id` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_account_id` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_comments_answer_id` FOREIGN KEY (`answer_id`) REFERENCES `answers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_comments_question_id` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `favourites`
--
ALTER TABLE `favourites`
  ADD CONSTRAINT `fk_favourites_answer_id` FOREIGN KEY (`answer_id`) REFERENCES `answers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_favourites_question_id` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_favourties_account_id` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `fk_questions_account_id` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
