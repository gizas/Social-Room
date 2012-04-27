-- phpMyAdmin SQL Dump
-- version 2.11.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 15, 2012 at 04:02 PM
-- Server version: 5.0.67
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `askhsh`
--

-- --------------------------------------------------------

--
-- Table structure for table `gallery_category`
--

CREATE TABLE IF NOT EXISTS `gallery_category` (
  `category_id` bigint(20) unsigned NOT NULL auto_increment,
  `category_name` varchar(50) NOT NULL default '0',
  `view` int(11) NOT NULL default '0',
  `creator` int(11) default NULL,
  PRIMARY KEY  (`category_id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `gallery_category`
--

INSERT INTO `gallery_category` (`category_id`, `category_name`, `view`, `creator`) VALUES
(1, 'My First Gallery', 0, NULL),
(2, 'Second Gallery', 1, 2),
(3, 'Koulik''s', 1, 4),
(7, 'pas2', 0, 13),
(6, 'pas', 1, 13),
(8, 'syros', 2, 14),
(9, 'pas', 0, 14);

-- --------------------------------------------------------

--
-- Table structure for table `gallery_photos`
--

CREATE TABLE IF NOT EXISTS `gallery_photos` (
  `photo_id` bigint(20) unsigned NOT NULL auto_increment,
  `photo_filename` varchar(25) default NULL,
  `photo_caption` text character set utf8 collate utf8_unicode_ci,
  `photo_category` bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY  (`photo_id`),
  KEY `photo_id` (`photo_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `gallery_photos`
--

INSERT INTO `gallery_photos` (`photo_id`, `photo_filename`, `photo_caption`, `photo_category`) VALUES
(1, '1.jpg', '', 1),
(2, '2.jpg', 'Ο Παγιουμτζής', 1),
(3, '3.jpg', 'Markara', 1),
(4, '4.jpg', 'goalllllll', 1),
(5, '5.jpg', 'Koulikis', 3),
(6, '6.jpg', 'pas ole', 7),
(7, '7.jpg', '', 7),
(8, '8.jpg', '', 0),
(9, '9.jpg', 'antreoulis', 8),
(10, '10.jpg', '', 8),
(11, '11.jpg', '', 8),
(12, '12.jpg', '', 8);

-- --------------------------------------------------------

--
-- Table structure for table `myuser`
--

CREATE TABLE IF NOT EXISTS `myuser` (
  `ID` int(10) unsigned NOT NULL auto_increment,
  `userName` char(50) character set utf8 collate utf8_bin default NULL,
  `userPass` char(50) character set utf8 collate utf8_bin default NULL,
  `isAdmin` tinyint(2) NOT NULL default '-1',
  `userGroup` int(10) unsigned default '1',
  `sessionID` char(50) default NULL,
  `lastLog` datetime default NULL,
  `userRemark` char(255) default NULL,
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `userName` (`userName`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Created by the AdminPro Class MySQL Setup ' AUTO_INCREMENT=16 ;

--
-- Dumping data for table `myuser`
--

INSERT INTO `myuser` (`ID`, `userName`, `userPass`, `isAdmin`, `userGroup`, `sessionID`, `lastLog`, `userRemark`) VALUES
(1, 'admin', 'admin', 1, 1, '', '0000-00-00 00:00:00', 'Default Administrator'),
(2, 'pasole', 'cd0acfe085eeb0f874391fb9b8009bed', -1, 4, '', '0000-00-00 00:00:00', ''),
(4, 'koulikis', 'b98ff9bc78fc8da0837bc4aed8ca48e7', -1, 1, '', '0000-00-00 00:00:00', ''),
(5, '1koulikis', '1koulikis', -1, 3, '', '0000-00-00 00:00:00', NULL),
(6, '1pasole', 'pas', -1, 1, 'b8a7501281f491b7df4f9349c283f746', '2009-06-24 20:15:53', NULL),
(11, 'dfsfds@fsdfds.gr', '124323edfds', -1, 1, NULL, NULL, NULL),
(10, 'dadsad@sdfd.gr', '1232', -1, 1, NULL, NULL, NULL),
(12, 'dfsfds@fsd.gr', '343dfdsf', -1, 1, NULL, NULL, NULL),
(13, 'gizas@ceid.upatras.gr', '123', -1, 1, '', '0000-00-00 00:00:00', ''),
(14, 'efi@kk.gr', '0099', -1, 1, '', '0000-00-00 00:00:00', NULL),
(15, 'et@ceid.gr', '123', -1, 1, '', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL auto_increment,
  `NewsTitle` mediumtext NOT NULL,
  `NewsText` mediumtext NOT NULL,
  `author_id` int(11) default NULL,
  `view` tinyint(4) NOT NULL default '0',
  `NewsDate` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `NewsTitle`, `NewsText`, `author_id`, `view`, `NewsDate`) VALUES
(1, 'Ola komple', 'fdsfdsfdsfsda', 13, 0, NULL),
(2, 'Ola kala Edw', 'dkfhdfhdskjfhfdhjkfhkdsjfhds', 1, 0, NULL),
(5, 'dfdsfds', 'fdsfdsfdsff', 1, 0, NULL),
(6, 'pasole', 'Ole pas', 1, 1, '2009-06-22 00:00:00'),
(7, 'dsad', 'dsadsa', 1, 1, '2009-06-22 00:00:00'),
(8, 'Î•Î³Ï‰ ÎµÎ¯Î¼Î±Î¹ ÎµÎ´ÏŽ', 'Î´ÏƒÎ¹Ï†Î·Î´ÏƒÎ¸Î¹Î·Ï†Î¹Î¸Î´', 13, 1, '2009-06-22 00:00:00'),
(9, 'diko mas', 'fdhfdkjshfjkdshfjkdshfds\nfdshfjdshfkjdsgfkjdshfkjdsgf\ndskjfhjdskfhjkdhfjkdhfkjdshfd\nfdsljhfjdshfjkdshfjkdshfdsfh<br/>', 13, 1, '2009-06-22 00:00:00'),
(10, 'dsadsa', 'dsadsad', 1, 2, '2009-06-22 00:00:00'),
(11, 'gia ton admin', 'gia sena admin', 13, 2, '2009-06-22 00:00:00'),
(12, 'for admin 2', 'fewfewfewfwqf', 13, 2, '2009-06-22 00:00:00'),
(13, 'ole', 'iuufydugfdgfkdgf', 1, 0, '2009-07-01 00:00:00'),
(14, 'pros admin', 'admin', 13, 2, '2009-07-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `message` varchar(50) NOT NULL default '0',
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `notifications`
--


-- --------------------------------------------------------

--
-- Table structure for table `user_friends`
--

CREATE TABLE IF NOT EXISTS `user_friends` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` bigint(20) unsigned NOT NULL,
  `friend_id` bigint(20) NOT NULL,
  `remarks` mediumtext,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `user_friends`
--

INSERT INTO `user_friends` (`id`, `user_id`, `friend_id`, `remarks`) VALUES
(1, 2, 4, NULL),
(2, 2, 6, NULL),
(3, 4, 6, NULL),
(4, 13, 12, NULL),
(5, 13, 1, 'ame'),
(6, 1, 13, 'ame');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE IF NOT EXISTS `user_info` (
  `user_id` bigint(20) unsigned NOT NULL auto_increment,
  `name` varchar(25) default NULL,
  `surname` varchar(25) default NULL,
  `email` varchar(25) default NULL,
  `available` tinyint(1) NOT NULL default '0',
  `my_id` bigint(20) default '0',
  `telephone` int(10) default NULL,
  `icon` varchar(25) NOT NULL default 'user.jpg',
  PRIMARY KEY  (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_id`, `name`, `surname`, `email`, `available`, `my_id`, `telephone`, `icon`) VALUES
(4, 'fddsf', 'fdsaf', 'dfsfds@fsd.gr', 0, 12, 4343, 'user.jpg'),
(5, 'gizas', '1andreas', 'gizas@ceid.upatras.gr', 0, 13, 232, 'ATT00001.jpg'),
(6, 'admin', 'admin', 'admin@localhost.gr', 0, 1, 6756756, 'user.jpg'),
(7, '1koulikis', 'koulikako', '1koulikis', 1, 5, 67567, 'user.jpg'),
(8, 'vygyggy', 'ftftft', 'efi@kk.gr', 0, 14, 0, 'DSCN2858.JPG'),
(9, 'eyth', 'eyth', 'et@ceid.gr', 0, 15, 0, 'user.jpg');
