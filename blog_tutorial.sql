-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 20, 2012 at 09:31 AM
-- Server version: 5.5.24-0ubuntu0.12.04.1
-- PHP Version: 5.3.10-1ubuntu3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `blog_tutorial`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `published` tinyint(4) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=102 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `name`, `email`, `url`, `body`, `published`, `created`, `modified`) VALUES
(18, 1, 'deepak', 'deepak@gmail.com', 'http://book.cakephp.org', 'the title - comment 1', 1, '2012-08-31 17:23:44', '2012-09-12 03:16:31'),
(19, 2, '', '', '', 'a title once again - comment 1', 0, '2012-08-31 17:24:08', '2012-09-03 08:23:37'),
(20, 3, '', '', '', 'title strikes back - comment 1', 0, '2012-08-31 17:24:29', '2012-09-03 08:23:47'),
(23, 1, 'deepak1', 'deepak1@gmail.com', 'http://book.cakephp.org', 'the title - comment 2', 0, '2012-08-31 17:27:33', '2012-09-03 13:28:12'),
(24, 2, '', '', '', 'test title once again - comment 2\r\n', 0, '2012-08-31 17:29:06', '2012-09-03 08:15:48'),
(25, 3, '', '', '', 'Title strikes back - comment 2', 0, '2012-09-03 08:22:56', '2012-09-03 08:23:05'),
(27, 9, 'deepak', 'deepak@gmail.com', 'sanisoft.com', 'test post1 - comment 1', 0, '2012-09-03 08:25:38', '2012-09-03 11:27:27'),
(28, 9, 'deepak', 'deepak@gmail.com', '', 'test post1 - comment 2', 0, '2012-09-03 08:25:54', '2012-09-03 11:27:42'),
(29, 1, 'deepak3', 'deepak3@gmail.com', 'http://book.cakephp.org', 'the title- comment 3', 1, '2012-09-03 08:29:43', '2012-09-12 03:16:34'),
(31, 1, 'deepak4', 'deepak@gmail.com', 'http://book.cakephp.org', 'the title - comment 4', 0, '2012-09-03 09:54:12', '2012-09-03 13:28:19'),
(32, 1, 'deepak5', 'deepak5@gmail.com', 'http://book.cakephp.org', 'the title - comment 5', 0, '2012-09-03 09:55:53', '2012-09-03 13:28:25'),
(37, 11, 'deepak', 'deepak@gmail.com', 'sanisoft.com', 'the test post2 - comment 1', 0, '2012-09-03 10:38:19', '2012-09-03 10:49:43'),
(41, 3, 'deepak', 'deepak@gmail.com', 'http://book.cakephp.org', 'title strikes back - comment 3', 0, '2012-09-03 14:12:48', '2012-09-03 14:12:48'),
(42, 1, 'deepak', 'deepak@gmail.com', '', 'test', 0, '2012-09-03 14:13:48', '2012-09-03 14:13:48'),
(44, 1, 'deepak6', 'deepak@gmail.com', 'sanisoft.com', 'comment 6', 1, '2012-09-10 08:33:49', '2012-09-12 03:16:33'),
(53, 9, 'deepak2', 'deepak2@gmail.com', 'deepak1.com', 'test', 0, '2012-09-11 04:00:43', '2012-09-11 04:00:43'),
(54, 11, 'deepak2', 'deepak2@gmail.com', 'deepak2.com', 'test', 0, '2012-09-11 04:01:47', '2012-09-11 04:01:47'),
(55, 11, 'deepak3', 'deepak3@gmail.com', 'deepak3.com', 'deea', 0, '2012-09-11 04:04:31', '2012-09-11 04:04:31'),
(65, 18, 'deepak3', 'deepak3@gmail.com', 'deepak3.com', 'test3', 0, '2012-09-11 09:37:28', '2012-09-11 09:37:28'),
(66, 18, 'deepak3', 'deepak3@gmail.com', 'deepak3.com', 'test34', 0, '2012-09-11 09:37:59', '2012-09-11 09:37:59'),
(67, 18, 'deepak sakure', 'deepak@gmail.com', 'deepak.com', 'admin test', 0, '2012-09-11 09:38:43', '2012-09-11 09:38:43'),
(68, 71, 'deepak sakure', 'deepak@gmail.com', 'deepak.com', 'admun', 0, '2012-09-11 09:39:18', '2012-09-11 09:39:18'),
(73, 0, 'deepak sakure', 'deepak@gmail.com', 'deepak.com', 'admin testww', 1, '2012-09-11 09:44:20', '2012-09-11 12:58:32'),
(74, 0, 'deepak', 'deepak@gmail.com', 'deepak.com', 'test general ww', 0, '2012-09-11 09:45:39', '2012-09-11 12:56:45'),
(86, 74, 'deepak1', 'deepak1@gmail.com', 'deepak1.com', 'test test t', 1, '2012-09-11 13:01:26', '2012-09-12 03:48:42'),
(87, 72, 'deepak1', 'deepak1@gmail.com', 'deepak1.com', 'test 1 test 44', 1, '2012-09-12 02:57:52', '2012-09-12 04:15:24'),
(89, 72, 'deepak1', 'deepak1@gmail.com', 'deepak1.com', 'test 2 test', 1, '2012-09-12 03:08:29', '2012-09-12 03:08:29'),
(91, 72, 'deepak2', 'deepak2@gmail.com', 'deepak2.com', 'deep 2 testedded', 1, '2012-09-12 03:11:31', '2012-09-12 03:12:54'),
(92, 73, 'deepak2', 'deepak2@gmail.com', 'deepak2.com', 'deep 2 tested', 1, '2012-09-12 03:11:42', '2012-09-12 03:11:48'),
(94, 73, 'deepak2', 'deepak2@gmail.com', 'deepak2.com', 'test again', 1, '2012-09-12 03:26:59', '2012-09-12 03:26:59'),
(95, 72, 'deepak2', 'deepak2@gmail.com', 'deepak2.com', 'test by d2', 1, '2012-09-12 03:28:52', '2012-09-12 03:30:59'),
(96, 72, 'deepak2', 'deepak2@gmail.com', 'deepak2.com', 'test by d2 again', 0, '2012-09-12 03:29:05', '2012-09-12 03:29:05'),
(97, 74, 'deepak2', 'deepak2@gmail.com', 'deepak2.com', 'test 4 two', 0, '2012-09-12 03:29:28', '2012-09-12 03:29:28'),
(98, 74, 'deepak2', 'deepak2@gmail.com', 'deepak2.com', 'test 4 thtree', 0, '2012-09-12 03:29:35', '2012-09-12 03:29:35'),
(100, 74, 'deepak1', 'deepak1@gmail.com', 'deepak1.com', 'test test', 1, '2012-09-12 03:56:43', '2012-09-12 03:57:14'),
(101, 76, 'deepak sakure', 'deepak@gmail.com', 'deepak.com', 'latest comment', 1, '2012-09-13 04:47:56', '2012-09-13 04:47:56');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `filename` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `post_id`, `filename`, `created`, `modified`) VALUES
(22, 18, '', '2012-09-07 12:23:13', '2012-09-11 08:25:55'),
(24, 1, 'jpeg.jpg', '2012-09-07 15:52:22', '2012-09-14 04:22:29'),
(25, 2, '', '2012-09-10 08:46:58', '2012-09-10 08:46:58'),
(26, 3, '', '2012-09-10 08:47:10', '2012-09-10 08:47:10'),
(29, 9, '', '2012-09-11 08:25:33', '2012-09-11 08:25:33'),
(30, 11, '', '2012-09-11 08:25:42', '2012-09-11 08:25:42'),
(31, 17, '', '2012-09-11 08:25:51', '2012-09-11 08:25:51'),
(33, 71, '', '2012-09-11 09:39:30', '2012-09-11 09:39:30'),
(34, 72, '', '2012-09-11 09:40:33', '2012-09-12 03:27:42'),
(35, 73, '', '2012-09-11 09:41:52', '2012-09-12 03:26:47'),
(36, 74, '', '2012-09-12 10:41:25', '2012-09-12 10:41:31'),
(37, 1, '', '2012-09-14 04:19:04', '2012-09-14 04:19:04'),
(38, 1, 'palace1.jpg', '2012-09-14 04:19:16', '2012-09-14 04:19:16'),
(39, 1, 'palace1.jpg', '2012-09-14 04:19:32', '2012-09-14 04:19:32');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `body` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=77 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `body`, `created`, `modified`, `user_id`) VALUES
(1, 'The title', 'thetitle2', 'This is the post body.', '2012-08-29 17:26:26', '2012-09-14 04:22:29', 1),
(2, 'A title once again', 'atitleonceagain1', 'And the post body follows.', '2012-08-29 17:26:26', '2012-09-10 08:46:58', 1),
(3, 'Title strikes back..', 'titlestrikesback1', 'This is really exciting! Not.', '2012-08-29 17:26:26', '2012-09-10 08:47:10', 1),
(9, 'the test post1', 'thetestpost11', 'first post for test post 1 ', '2012-09-03 08:25:18', '2012-09-11 08:25:33', 1),
(11, 'the test post 2', 'thetestpost21', 'post 2 body', '2012-09-03 10:06:28', '2012-09-11 08:25:42', 1),
(17, 'test post-tag1', 'testposttag11', 'tests trest', '2012-09-03 18:33:48', '2012-09-11 08:25:51', 1),
(18, 'test post-tag2', 'testposttag21', 'test post-tag2 body', '2012-09-04 08:23:41', '2012-09-11 08:25:55', 1),
(71, 'admin test.', 'admintest2', 'test', '2012-09-11 09:39:07', '2012-09-11 09:39:30', 1),
(72, 'author deepak1 test', 'authordeepak1test1', 'test1', '2012-09-11 09:40:18', '2012-09-12 03:27:42', 4),
(73, 'author deepak2 test', 'authordeepak2test1', 'test2', '2012-09-11 09:41:46', '2012-09-12 03:26:47', 5),
(74, 'author deepak1 test2', 'authordeepak1test21', 'test2', '2012-09-11 09:42:47', '2012-09-12 10:41:31', 4),
(75, 'test admin post', 'testadminpost1', 'test', '2012-09-13 04:33:50', '2012-09-13 04:33:50', 1),
(76, 'test admin post 2', 'testadminpost21', 'test 2', '2012-09-13 04:38:50', '2012-09-13 04:38:50', 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts_tags`
--

CREATE TABLE IF NOT EXISTS `posts_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=205 ;

--
-- Dumping data for table `posts_tags`
--

INSERT INTO `posts_tags` (`id`, `post_id`, `tag_id`, `created`, `modified`) VALUES
(69, 42, 10, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(70, 43, 10, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(145, 3, 16, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(146, 3, 17, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(171, 17, 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(172, 17, 16, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(173, 17, 17, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(179, 71, 10, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(188, 73, 10, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(189, 73, 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(190, 72, 10, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(193, 74, 10, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(194, 74, 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(195, 75, 10, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(196, 76, 10, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(204, 1, 9, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `title`, `body`, `created`, `modified`) VALUES
(1, 'Tag 1', 'Tag 1 body', '2012-09-03 15:32:43', '2012-09-03 15:33:16'),
(3, 'Tag 2', 'tag 2 body', '2012-09-03 15:33:57', '2012-09-03 15:33:57'),
(4, 'Tag 3 ', 'tag 3 body', '2012-09-03 15:34:15', '2012-09-03 15:34:15'),
(5, 'Tag 4', 'tag 4 body', '2012-09-03 15:34:29', '2012-09-03 15:34:57'),
(6, 'Tag 5', 'tag 5 body', '2012-09-03 15:34:43', '2012-09-03 15:34:43'),
(7, 'newtag1', '', '2012-09-06 08:50:15', '2012-09-06 08:50:15'),
(8, 'newtag2', '', '2012-09-06 08:50:15', '2012-09-06 08:50:15'),
(9, 'newtag3', '', '2012-09-06 09:19:50', '2012-09-06 09:19:50'),
(10, 'tag1', '', '2012-09-06 09:20:59', '2012-09-06 09:20:59'),
(11, 'tag2', '', '2012-09-06 09:39:39', '2012-09-06 09:39:39'),
(12, 'one', '', '2012-09-06 09:41:45', '2012-09-06 09:41:45'),
(13, 'two', '', '2012-09-06 09:41:45', '2012-09-06 09:41:45'),
(14, 'three', '', '2012-09-06 09:44:11', '2012-09-06 09:44:11'),
(15, 'four', '', '2012-09-06 10:51:30', '2012-09-06 10:51:30'),
(16, 'tag3', '', '2012-09-07 08:50:01', '2012-09-07 08:50:01'),
(17, 'tag4', '', '2012-09-07 08:50:01', '2012-09-07 08:50:01'),
(18, 'test', '', '2012-09-07 11:47:46', '2012-09-07 11:47:46'),
(19, 'testhkh', '', '2012-09-10 08:46:44', '2012-09-10 08:46:44'),
(20, 'asd', '', '2012-09-10 12:11:44', '2012-09-10 12:11:44'),
(21, 'as', '', '2012-09-10 12:19:23', '2012-09-10 12:19:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `name`, `email`, `url`, `created`, `modified`) VALUES
(1, 'deepak', 'cd025a46d7fab8e51d1cf5312b0a48e5db0dfbdc', 'admin', 'deepak sakure', 'deepak@gmail.com', 'deepak.com', '2012-09-10 11:06:20', '2012-09-10 11:06:20'),
(4, 'deepak1', '5aef0754752b659745885663d471932ba6482f4a', 'author', 'deepak1', 'deepak1@gmail.com', 'deepak1.com', '2012-09-10 12:23:20', '2012-09-10 12:23:20'),
(5, 'deepak2', '5aa0d94e53b56b26db652ba9354cd814990e3cf5', 'author', 'deepak2', 'deepak2@gmail.com', 'deepak2.com', '2012-09-10 12:23:52', '2012-09-10 12:23:52'),
(6, 'deepak3', 'cd025a46d7fab8e51d1cf5312b0a48e5db0dfbdc', 'author', 'deepak3', 'deepak3@gmail.com', 'deepak3.com', '2012-09-11 08:49:44', '2012-09-11 08:49:44');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
