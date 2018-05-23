-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2018 at 03:31 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `addhoc`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `url` varchar(200) DEFAULT '',
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `url`, `id_user`) VALUES
(13, 'Test', '', 16),
(14, 'Prefecture', 'http://www.meurthe-et-moselle.gouv.fr/', 19),
(15, 'Startup', '', 21);

-- --------------------------------------------------------

--
-- Table structure for table `deposit`
--

CREATE TABLE IF NOT EXISTS `deposit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(50) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `deposit`
--

INSERT INTO `deposit` (`id`, `id_user`, `date_creation`, `name`) VALUES
(1, 16, '2018-05-11 14:20:38', 'Premier Depot'),
(2, 19, '2018-05-21 22:09:29', 'Permis de conduire'),
(3, 16, '2018-05-22 06:35:54', 'Deuxieme Depot'),
(4, 21, '2018-05-22 07:16:02', 'Test Depot'),
(5, 21, '2018-05-22 07:18:24', 'Test2 Depot'),
(6, 21, '2018-05-22 07:52:13', 'Test3 Depot'),
(7, 16, '2018-05-22 12:07:21', 'Troisieme Depot'),
(8, 16, '2018-05-22 12:51:43', 'Quatrieme Depot');

-- --------------------------------------------------------

--
-- Table structure for table `deposit_contain`
--

CREATE TABLE IF NOT EXISTS `deposit_contain` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_deposit` int(11) NOT NULL,
  `id_directory` int(11) NOT NULL,
  `annotations` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `deposit_contain`
--

INSERT INTO `deposit_contain` (`id`, `id_deposit`, `id_directory`, `annotations`) VALUES
(1, 1, 23, ''),
(2, 1, 24, ''),
(3, 1, 25, ''),
(4, 1, 26, ''),
(5, 1, 27, ''),
(6, 3, 28, ''),
(7, 3, 29, ''),
(8, 4, 30, ''),
(9, 6, 31, ''),
(10, 2, 32, ''),
(11, 2, 33, ''),
(12, 1, 34, '');

-- --------------------------------------------------------

--
-- Table structure for table `deposit_model`
--

CREATE TABLE IF NOT EXISTS `deposit_model` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_deposit` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `deposit_model`
--

INSERT INTO `deposit_model` (`id`, `id_deposit`, `id_type`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 1),
(4, 3, 1),
(5, 3, 2),
(6, 3, 3),
(7, 3, 4),
(8, 4, 3),
(9, 4, 4),
(10, 5, 1),
(11, 5, 3),
(12, 6, 1),
(13, 6, 4),
(14, 7, 3),
(15, 7, 2),
(16, 8, 2),
(17, 8, 4);

-- --------------------------------------------------------

--
-- Table structure for table `directory`
--

CREATE TABLE IF NOT EXISTS `directory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `directory`
--

INSERT INTO `directory` (`id`, `id_user`, `date_creation`, `name`) VALUES
(25, 17, '2018-05-11 14:36:26', 'Premier Depot'),
(26, 18, '2018-05-18 16:17:44', 'Premier Depot'),
(27, 19, '2018-05-18 16:32:54', 'Premier Depot'),
(28, 19, '2018-05-22 06:37:13', 'Deuxieme Depot'),
(29, 17, '2018-05-22 06:41:40', 'Deuxieme Depot'),
(30, 16, '2018-05-22 07:17:20', 'Test Depot'),
(31, 16, '2018-05-22 07:53:13', 'Test3 Depot'),
(32, 23, '2018-05-22 12:04:47', 'Permis de conduire'),
(33, 24, '2018-05-22 12:50:17', 'Permis de conduire'),
(34, 24, '2018-05-22 12:53:36', 'Premier Depot');

-- --------------------------------------------------------

--
-- Table structure for table `directory_contain`
--

CREATE TABLE IF NOT EXISTS `directory_contain` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_directory` int(11) NOT NULL,
  `id_file` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `directory_contain`
--

INSERT INTO `directory_contain` (`id`, `id_directory`, `id_file`, `name`, `date_added`) VALUES
(5, 25, 20, 'passport.jpg', '2018-05-11 14:36:26'),
(6, 25, 21, 'visa.jpg', '2018-05-11 14:36:26'),
(7, 26, 22, 'passport.jpg', '2018-05-18 16:17:44'),
(8, 26, 23, 'visa.jpg', '2018-05-18 16:17:44'),
(9, 27, 24, 'ring3.png', '2018-05-18 16:32:55'),
(10, 27, 25, 'Capture.PNG', '2018-05-18 16:32:55'),
(11, 28, 26, 'test.jpg', '2018-05-22 06:37:13'),
(12, 28, 27, 'visa.jpg', '2018-05-22 06:37:13'),
(13, 29, 20, '', '2018-05-22 06:41:40'),
(14, 29, 21, '', '2018-05-22 06:41:40'),
(15, 29, 28, 'test.jpg', '2018-05-22 06:41:40'),
(16, 29, 29, 'visa.jpg', '2018-05-22 06:41:40'),
(17, 30, 30, 'passport.jpg', '2018-05-22 07:17:21'),
(18, 30, 31, 'test.jpg', '2018-05-22 07:17:21'),
(19, 31, 32, 'test.jpg', '2018-05-22 07:53:13'),
(20, 31, 31, '', '2018-05-22 07:53:13'),
(21, 32, 33, 'index.png', '2018-05-22 12:04:47'),
(22, 33, 34, 'index.png', '2018-05-22 12:50:17'),
(23, 34, 34, '', '2018-05-22 12:53:36'),
(24, 34, 35, 'index.png', '2018-05-22 12:53:37');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `id_company` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id_company`, `id_user`) VALUES
(12, 14),
(13, 16),
(14, 19),
(15, 21),
(13, 24);

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE IF NOT EXISTS `file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  `date_uploaded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `address` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`id`, `id_user`, `id_type`, `date_uploaded`, `address`) VALUES
(20, 17, 1, '2018-05-11 14:36:26', 'C:\\wamp\\www\\ADDOC/file/20.jpg'),
(21, 17, 2, '2018-05-11 14:36:26', 'C:\\wamp\\www\\ADDOC/file/21.jpg'),
(22, 18, 1, '2018-05-18 16:17:44', 'C:\\wamp\\www\\ADDOC/file/22.jpg'),
(23, 18, 2, '2018-05-18 16:17:44', 'C:\\wamp\\www\\ADDOC/file/23.jpg'),
(24, 19, 1, '2018-05-18 16:32:54', 'C:\\wamp\\www\\ADDOC/file/24.png'),
(25, 19, 2, '2018-05-18 16:32:55', 'C:\\wamp\\www\\ADDOC/file/25.PNG'),
(26, 19, 3, '2018-05-22 06:37:13', 'C:\\wamp\\www\\ADDOC/file/26.jpg'),
(27, 19, 4, '2018-05-22 06:37:13', 'C:\\wamp\\www\\ADDOC/file/27.jpg'),
(28, 17, 3, '2018-05-22 06:41:40', 'C:\\wamp\\www\\ADDOC/file/28.jpg'),
(29, 17, 4, '2018-05-22 06:41:40', 'C:\\wamp\\www\\ADDOC/file/29.jpg'),
(30, 16, 3, '2018-05-22 07:17:21', 'C:\\wamp\\www\\ADDOC/file/30.PNG'),
(31, 16, 4, '2018-05-22 07:17:21', 'C:\\wamp\\www\\ADDOC/file/31.jpg'),
(32, 16, 1, '2018-05-22 07:53:13', 'C:\\wamp\\www\\ADDOC/file/32.jpg'),
(33, 23, 1, '2018-05-22 12:04:47', 'C:\\wamp\\www\\ADDOC/file/33.jpg'),
(34, 24, 1, '2018-05-22 12:50:17', 'C:\\wamp\\www\\ADDOC/file/34.jpg'),
(35, 24, 2, '2018-05-22 12:53:36', 'C:\\wamp\\www\\ADDOC/file/35.png');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `type`) VALUES
(1, 'Passport'),
(2, 'Visa'),
(3, 'Driving Licence'),
(4, 'Bank Details');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pwd` varchar(50) NOT NULL,
  `date_signedup` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `pwd`, `date_signedup`) VALUES
(16, 'Noah', 'Delophont', 'yulebidon@hotmail.fr', 'ensiie', '2018-05-11 14:11:42'),
(17, 'Noah', 'Delophont', 'delophont.noah@outlook.fr', 'ensiie', '2018-05-11 14:22:44'),
(18, 'Noah', 'Delophont', 'test@mail.com', 'ensiie', '2018-05-18 15:10:37'),
(19, 'Blaise', 'Rosyan', 'test@jsp.com', 'ensiie', '2018-05-18 16:24:03'),
(20, 'Rosyan', 'Blaise', 't@mail.com', 'ensiie', '2018-05-21 18:19:01'),
(21, 'Timothee', 'Denoux', 'thimothee.denoux@ensiie.fr', 'ensiie', '2018-05-22 07:13:57'),
(22, 'Blaise', 'Rosyan', 'rosyan.blaise@gmail.com', 'ensiie', '2018-05-22 10:30:34'),
(23, 'N', 'D', 'presentation@mail.com', 'ensiie', '2018-05-22 12:00:29'),
(24, 'Tim', 'Denoux', 't.denoux@mail.com', 'ensiie', '2018-05-22 12:49:27');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
