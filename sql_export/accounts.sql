-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 02, 2018 at 09:58 PM
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`, `name`, `last_name`, `gender`, `security_one`, `security_two`, `answer_one`, `answer_two`, `bio`, `profession`, `pin`) VALUES
(1, 'john117', '$2y$10$C/uoZeY8TclVBl7UskXJceE7v800lyCnANBNtbTWX6jH7/dtOSqoK', 'John', 'Master Chief', 'Male', 'What is the first name of the person you first kissed?', 'In what city or town did your mother and father meet?', 'Cortana', 'EDZ', 'Last Spartan Alive', 'Gamer', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
