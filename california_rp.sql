-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 05, 2017 at 09:18 PM
-- Server version: 5.5.49-0+deb8u1
-- PHP Version: 5.6.22-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `california_rp`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE IF NOT EXISTS `announcements` (
`id` int(5) NOT NULL,
  `title` text NOT NULL,
  `text` text NOT NULL,
  `date` text NOT NULL,
  `by` text NOT NULL,
  `visible` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `text`, `date`, `by`, `visible`) VALUES
(1, 'test', '	test							', '2017-02-05 16:57:08', 'test232', '0'),
(2, 'test2', '		test2						', '2017-02-05 16:57:11', 'test232', '1'),
(3, 'test3', '		test3						', '2017-02-05 16:57:15', 'test232', '1'),
(4, '	test4							', '	test4							', '2017-02-05 16:57:20', 'test232', '1');

-- --------------------------------------------------------

--
-- Table structure for table `login_logs`
--

CREATE TABLE IF NOT EXISTS `login_logs` (
`id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `ip` text NOT NULL,
  `useragent` text NOT NULL,
  `os` text NOT NULL,
  `date` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_logs`
--

INSERT INTO `login_logs` (`id`, `user_id`, `ip`, `useragent`, `os`, `date`) VALUES
(2, 1, '::1', '', '', '2017-02-02 10:43:13'),
(3, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', ' ()', '2017-02-02 10:45:48'),
(4, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', ' ()', '2017-02-02 10:49:11'),
(5, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', ' ()', '2017-02-02 10:49:55'),
(6, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', ' ()', '2017-02-02 10:50:57'),
(7, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', ' ()', '2017-02-02 10:51:54'),
(8, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', ' ()', '2017-02-03 06:58:11'),
(9, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', ' ()', '2017-02-03 07:01:12'),
(10, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', ' ()', '2017-02-03 07:02:41'),
(11, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', ' ()', '2017-02-03 07:18:02'),
(12, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', ' ()', '2017-02-03 07:19:43'),
(13, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', ' ()', '2017-02-03 07:20:34'),
(14, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', ' ()', '2017-02-03 07:21:43'),
(15, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', ' ()', '2017-02-03 07:23:01'),
(16, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', ' ()', '2017-02-03 07:23:48'),
(17, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', ' ()', '2017-02-03 07:24:14'),
(18, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', ' ()', '2017-02-03 07:25:33'),
(19, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', ' ()', '2017-02-03 07:26:19'),
(20, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', ' ()', '2017-02-03 07:26:29'),
(21, 1, '31.176.131.134', 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', ' ()', '2017-02-03 08:00:07'),
(22, 5, '31.176.131.134', 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', ' ()', '2017-02-03 09:19:18'),
(23, 5, '31.176.131.134', 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', ' ()', '2017-02-03 09:19:56'),
(24, 5, '31.176.131.134', 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', ' ()', '2017-02-03 09:22:07'),
(25, 5, '31.176.131.134', 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', ' ()', '2017-02-03 09:24:49'),
(26, 6, '31.176.131.134', 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', ' ()', '2017-02-03 09:31:01'),
(27, 6, '31.176.131.134', 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', ' ()', '2017-02-03 10:12:20'),
(28, 6, '31.176.131.134', 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', ' ()', '2017-02-03 10:13:34'),
(29, 6, '31.176.131.134', 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', ' ()', '2017-02-03 22:14:47'),
(30, 6, '31.176.131.134', 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', ' ()', '2017-02-03 22:16:00'),
(31, 6, '31.176.131.134', 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', ' ()', '2017-02-03 22:18:19'),
(32, 6, '31.176.131.134', 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', ' ()', '2017-02-03 22:55:04'),
(33, 7, '93.87.255.29', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', ' ()', '2017-02-03 23:25:45'),
(34, 6, '109.163.166.89', 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', ' ()', '2017-02-05 14:57:22'),
(35, 6, '188.2.112.192', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', ' ()', '2017-02-05 14:57:57'),
(36, 6, '212.39.125.182', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', ' ()', '2017-02-05 14:58:57'),
(37, 6, '109.163.166.89', 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', ' ()', '2017-02-05 14:59:00'),
(38, 6, '109.163.166.89', 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', ' ()', '2017-02-05 20:28:45'),
(39, 6, '109.163.166.89', 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', ' ()', '2017-02-05 20:38:17'),
(40, 6, '109.163.166.89', 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', '', '2017-02-05 21:04:43'),
(41, 6, '109.163.166.89', 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', '', '2017-02-05 21:05:47'),
(42, 6, '109.163.166.89', 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', '', '2017-02-05 21:06:16'),
(43, 6, '109.163.166.89', 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', '', '2017-02-05 21:07:04');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
`id` int(5) NOT NULL,
  `by` text NOT NULL,
  `action` text NOT NULL,
  `text` text NOT NULL,
  `date` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `by`, `action`, `text`, `date`) VALUES
(4, 'test232', 'Ban', 'Admin test232 je banovao korisnika sa ID: 6', '2017-02-05 17:19:05'),
(7, 'test232', 'Unban', 'Admin test232 je unbanovao korisnika sa ID: 1', '2017-02-05 20:33:42'),
(8, 'test232', 'Izmjena Profila', 'Korisnik test232 je promjenio postavke profila!', '2017-02-05 20:37:03'),
(9, 'testiramsamo', 'Registracija', 'Korisnik testiramsamo se registrovao!', '2017-02-05 20:37:58'),
(10, 'test232', 'Izmjena Profila', 'Korisnik test232 je promjenio postavke profila!', '2017-02-05 20:50:00'),
(11, 'test232', 'Izmjena Profila', 'Korisnik test232 je promjenio postavke profila!', '2017-02-05 20:50:30'),
(12, 'test232', 'Postavka', 'Admin test232 je izmjenio postavku max_characters', '2017-02-05 21:13:43');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
`setting_id` int(5) NOT NULL,
  `setting_name` text NOT NULL,
  `setting_value` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`setting_id`, `setting_name`, `setting_value`) VALUES
(1, 'max_characters', '4');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(5) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `sig_pitanje` text,
  `sig_odgovor` text,
  `register_date` text NOT NULL,
  `lastactivity_date` text NOT NULL,
  `last_ip` text NOT NULL,
  `session_id` text NOT NULL,
  `avatar` text NOT NULL,
  `ucp_rank` int(2) NOT NULL,
  `ban` int(1) NOT NULL DEFAULT '0',
  `ban_reason` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `sig_pitanje`, `sig_odgovor`, `register_date`, `lastactivity_date`, `last_ip`, `session_id`, `avatar`, `ucp_rank`, `ban`, `ban_reason`) VALUES
(1, 'test', 'test', 'test@gmail.com', NULL, NULL, '22', '2', '31.176.131.134', 'cf9s9s4mnckt8r0rd3jfblgkc1', '', 0, 0, '0'),
(6, 'test232', '899b76161701a4111b36cbadd0d168e896f1e97d22b4f470331293b9d9bce5fd6a338b64bfd640b8d78ef3a465047886527e1c250d587ca7693f46d27ae8721a', 'testiram@gmail.com22', 'test_p22', 'test_o22', '2017-02-03 09:30:48', '2017-02-05 21:07:04', '109.163.166.89', 'khbmpuu7pnqg7k4kqvlepgob03', 'http://gorillaplayer.com/images/svg/gorilla-avatar.svg', 3, 0, 'Nisam teo :('),
(7, 'Zekiloni', 'cc34631799a727399b66175e4b7e0146173fab99341e5229c58fbe1aa0bf6dcf8f5d20b47052e26749a476eb9467ae141f1c5aef8f3d279b3416c6d0fcd7f7b1', 'zekirija2001@hotmail.com', 'sta', 'nista', '2017-02-03 23:24:15', '2017-02-03 23:25:45', '93.87.255.29', 'uvui5p34f2qvoc4lhoemfb0ek7', '', 0, 1, 'test'),
(8, 'testiramsamo', '899b76161701a4111b36cbadd0d168e896f1e97d22b4f470331293b9d9bce5fd6a338b64bfd640b8d78ef3a465047886527e1c250d587ca7693f46d27ae8721a', 'testiram@gmail.com', 'koliki ti je kurac?', 'veliki', '2017-02-05 20:37:58', '2017-02-05 20:37:58', '109.163.166.89', 'khbmpuu7pnqg7k4kqvlepgob03', '', 0, 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_logs`
--
ALTER TABLE `login_logs`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
 ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `login_logs`
--
ALTER TABLE `login_logs`
MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
MODIFY `setting_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
