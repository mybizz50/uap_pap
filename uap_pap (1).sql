-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 01, 2015 at 03:32 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `uap_pap`
--
CREATE DATABASE IF NOT EXISTS `uap_pap` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `uap_pap`;

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE IF NOT EXISTS `activity_log` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `activity_type` tinyint(4) NOT NULL,
  `executor` tinyint(4) NOT NULL,
  `executed_to` tinyint(4) NOT NULL,
  `description` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=250 ;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `activity_type`, `executor`, `executed_to`, `description`, `date`) VALUES
(1, 1, 1, 0, 'Obaidur Rahman(Admin) initiated purchase. Id #5', '2015-02-02 14:02:27'),
(2, 43, 1, 0, 'Obaidur Rahman(Admin) logged out', '2015-02-02 14:05:40'),
(3, 42, 1, 0, 'Obaidur Rahman(Admin) logged in', '2015-02-02 14:05:46'),
(4, 42, 5, 0, 'Faruk Ahmed(DAO) logged in', '2015-02-06 02:40:35'),
(5, 1, 5, 0, 'Faruk Ahmed(DAO) initiated purchase. Id #6', '2015-02-06 02:50:00'),
(6, 43, 1, 0, 'Obaidur Rahman(Admin) logged out', '2015-03-23 13:15:41'),
(7, 42, 10, 0, 'fname lname(None) logged in', '2015-03-23 13:18:14'),
(8, 43, 10, 0, 'fname lname(None) logged out', '2015-03-23 13:19:27'),
(9, 42, 1, 0, 'Obaidur Rahman(Admin) logged in', '2015-03-23 13:19:31'),
(10, 2, 1, 9, 'Obaidur Rahman(Admin) forwarded. purchase Id#5 to Jamilur Reza(VC)', '2015-03-23 13:20:23'),
(11, 43, 1, 0, 'Obaidur Rahman(Admin) logged out', '2015-03-23 13:20:29'),
(12, 42, 9, 0, 'Jamilur Reza(VC) logged in', '2015-03-23 13:20:37'),
(13, 4, 9, 7, 'Jamilur Reza(VC) approved purchase Id#5 and sent to TREASURER to issue work order', '2015-03-23 13:20:52'),
(14, 43, 9, 0, 'Jamilur Reza(VC) logged out', '2015-03-23 13:21:00'),
(15, 42, 7, 0, 'Abdul  Mazid (TREASURER) logged in', '2015-03-23 13:21:28'),
(16, 42, 1, 0, 'Obaidur Rahman(Admin) logged in', '2015-03-23 13:36:22'),
(17, 43, 7, 0, 'Abdul  Mazid (TREASURER) logged out', '2015-03-23 13:36:58'),
(18, 42, 1, 0, 'Obaidur Rahman(Admin) logged in', '2015-03-23 13:37:03'),
(19, 43, 1, 0, 'Obaidur Rahman(Admin) logged out', '2015-03-23 13:37:50'),
(20, 42, 9, 0, 'Jamilur Reza(VC) logged in', '2015-03-23 13:37:53'),
(21, 43, 9, 0, 'Jamilur Reza(VC) logged out', '2015-03-23 13:38:01'),
(22, 42, 7, 0, 'Abdul  Mazid (TREASURER) logged in', '2015-03-23 13:38:21'),
(23, 45, 7, 33, 'Abdul  Mazid (TREASURER) forwarded purchase Id#5 to Asst. Purchase Officer 1 to issue work order', '2015-03-23 15:52:07'),
(24, 43, 7, 0, 'Abdul  Mazid (TREASURER) logged out', '2015-03-23 15:57:49'),
(25, 42, 33, 0, 'a a(Asst. Purchase Officer 1) logged in', '2015-03-23 15:58:08'),
(26, 45, 33, 1, 'Work order for purchase Id#5 is issued by a a(Asst. Purchase Officer 1)', '2015-03-23 18:55:29'),
(27, 45, 33, 1, 'Work order for purchase Id#5 is issued by a a(Asst. Purchase Officer 1)', '2015-03-23 18:55:41'),
(28, 45, 33, 1, 'Work order for purchase Id#5 is issued by a a(Asst. Purchase Officer 1)', '2015-03-23 18:55:52'),
(29, 43, 33, 0, 'a a(Asst. Purchase Officer 1) logged out', '2015-03-23 18:55:57'),
(30, 42, 1, 0, 'Obaidur Rahman(Admin) logged in', '2015-03-23 18:56:01'),
(31, 42, 1, 0, 'Obaidur Rahman(Admin) logged in', '2015-03-24 11:03:12'),
(32, 1, 1, 0, 'Obaidur Rahman(Admin) initiated purchase. Id #7', '2015-03-24 11:04:54'),
(33, 2, 1, 6, 'Obaidur Rahman(Admin) forwarded. purchase Id#7 to Alok Kumar(Head)', '2015-03-24 11:09:11'),
(34, 43, 1, 0, 'Obaidur Rahman(Admin) logged out', '2015-03-24 13:41:01'),
(35, 42, 6, 0, 'Alok Kumar(Head) logged in', '2015-03-24 13:42:02'),
(36, 2, 6, 7, 'Alok Kumar(Head) forwarded. purchase Id#7 to Abdul  Mazid (TREASURER)', '2015-03-24 13:42:17'),
(37, 43, 6, 0, 'Alok Kumar(Head) logged out', '2015-03-24 13:42:22'),
(38, 42, 7, 0, 'Abdul  Mazid (TREASURER) logged in', '2015-03-24 13:42:30'),
(39, 4, 7, 7, 'Abdul  Mazid (TREASURER) approved purchase Id#7 and sent to TREASURER to issue work order', '2015-03-24 13:42:41'),
(40, 45, 7, 33, 'Abdul  Mazid (TREASURER) forwarded purchase Id#7 to Asst. Purchase Officer 1 to issue work order', '2015-03-24 13:43:58'),
(41, 43, 7, 0, 'Abdul  Mazid (TREASURER) logged out', '2015-03-24 13:44:05'),
(42, 42, 33, 0, 'a a(Asst. Purchase Officer 1) logged in', '2015-03-24 13:44:26'),
(43, 45, 33, 1, 'Work order for purchase Id#7 is issued by a a(Asst. Purchase Officer 1)', '2015-03-24 13:44:40'),
(44, 42, 1, 0, 'Obaidur Rahman(Admin) logged in', '2015-03-25 05:04:11'),
(45, 42, 1, 0, 'Obaidur Rahman(Admin) logged in', '2015-03-25 13:21:28'),
(46, 42, 1, 0, 'Obaidur Rahman(Admin) logged in', '2015-03-26 14:58:26'),
(47, 47, 1, 5, 'Obaidur Rahman(Admin) forwarded bill (purchase Id#7) to Faruk Ahmed(DAO)', '2015-03-26 17:27:07'),
(48, 53, 1, 0, 'Obaidur Rahman(Admin) received the stock for purchase Id#7', '2015-03-26 17:27:07'),
(49, 47, 1, 5, 'Obaidur Rahman(Admin) forwarded bill (purchase Id#7) to Faruk Ahmed(DAO)', '2015-03-26 17:27:57'),
(50, 53, 1, 0, 'Obaidur Rahman(Admin) received the stock for purchase Id#7', '2015-03-26 17:27:57'),
(51, 47, 1, 5, 'Obaidur Rahman(Admin) forwarded bill (purchase Id#7) to Faruk Ahmed(DAO)', '2015-03-26 17:29:00'),
(52, 53, 1, 0, 'Obaidur Rahman(Admin) received the stock for purchase Id#7', '2015-03-26 17:29:00'),
(53, 43, 1, 0, 'Obaidur Rahman(Admin) logged out', '2015-03-26 17:35:35'),
(54, 42, 5, 0, 'Faruk Ahmed(DAO) logged in', '2015-03-26 17:35:42'),
(55, 47, 5, 7, 'Faruk Ahmed(DAO) forwarded bill (purchase Id#7) to Abdul  Mazid (TREASURER)', '2015-03-26 19:44:22'),
(56, 53, 5, 0, 'Faruk Ahmed(DAO) received the stock for purchase Id#7', '2015-03-26 19:44:22'),
(57, 47, 5, 7, 'Faruk Ahmed(DAO) forwarded bill (purchase Id#7) to Abdul  Mazid (TREASURER)', '2015-03-26 20:17:25'),
(58, 53, 5, 0, 'Faruk Ahmed(DAO) received the stock for purchase Id#7', '2015-03-26 20:17:25'),
(59, 47, 5, 7, 'Faruk Ahmed(DAO) forwarded bill (purchase Id#7) to Abdul  Mazid (TREASURER)', '2015-03-26 20:20:51'),
(60, 42, 7, 0, 'Abdul  Mazid (TREASURER) logged in', '2015-03-27 05:51:44'),
(61, 43, 7, 0, 'Abdul  Mazid (TREASURER) logged out', '2015-03-27 06:42:35'),
(62, 42, 5, 0, 'Faruk Ahmed(DAO) logged in', '2015-03-27 06:42:47'),
(63, 47, 5, 5, 'Faruk Ahmed(DAO) forwarded bill (purchase Id#7) to Faruk Ahmed(DAO)', '2015-03-27 06:44:59'),
(64, 53, 5, 0, 'Faruk Ahmed(DAO) received the stock for purchase Id#7', '2015-03-27 06:44:59'),
(65, 47, 5, 5, 'Faruk Ahmed(DAO) forwarded bill (purchase Id#7) to Faruk Ahmed(DAO)', '2015-03-27 06:47:21'),
(66, 53, 5, 0, 'Faruk Ahmed(DAO) received the stock for purchase Id#7', '2015-03-27 06:47:21'),
(67, 43, 5, 0, 'Faruk Ahmed(DAO) logged out', '2015-03-27 06:47:53'),
(68, 42, 7, 0, 'Abdul  Mazid (TREASURER) logged in', '2015-03-27 06:47:59'),
(69, 42, 7, 0, 'Abdul  Mazid (TREASURER) logged in', '2015-03-27 12:52:41'),
(70, 48, 7, 0, 'Abdul  Mazid (TREASURER) issued check for purchase Id#7', '2015-03-27 12:53:00'),
(71, 48, 7, 0, 'Abdul  Mazid (TREASURER) issued check for purchase Id#7', '2015-03-27 12:54:20'),
(72, 48, 7, 0, 'Abdul  Mazid (TREASURER) issued check for purchase Id#7', '2015-03-27 12:57:14'),
(73, 48, 7, 0, 'Abdul  Mazid (TREASURER) issued check for purchase Id#7', '2015-03-27 12:59:32'),
(74, 49, 7, 0, 'Abdul  Mazid (TREASURER) signed a check and forwarded the check (purchase Id#7) to M. R. Kabir(Pro-vc)', '2015-03-27 13:46:28'),
(75, 49, 7, 0, 'Abdul  Mazid (TREASURER) signed a check and forwarded the check (purchase Id#7) to M. R. Kabir(Pro-vc)', '2015-03-27 13:47:36'),
(76, 50, 7, 0, 'Abdul  Mazid (TREASURER) signed a check and approved the bill (purchase Id#7)', '2015-03-27 13:48:19'),
(77, 51, 7, 0, 'Abdul  Mazid (TREASURER) paid the bill (purchase Id#7)', '2015-03-27 13:48:33'),
(78, 43, 7, 0, 'Abdul  Mazid (TREASURER) logged out', '2015-03-27 13:48:42'),
(79, 42, 33, 0, 'a a(Asst. Purchase Officer 1) logged in', '2015-03-27 13:48:48'),
(80, 43, 33, 0, 'a a(Asst. Purchase Officer 1) logged out', '2015-03-27 13:53:10'),
(81, 42, 7, 0, 'Abdul  Mazid (TREASURER) logged in', '2015-03-27 13:53:20'),
(82, 51, 7, 0, 'Abdul  Mazid (TREASURER) paid the bill (purchase Id#7)', '2015-03-27 13:53:51'),
(83, 42, 33, 0, 'a a(Asst. Purchase Officer 1) logged in', '2015-03-27 13:54:20'),
(84, 42, 33, 0, 'a a(Asst. Purchase Officer 1) logged in', '2015-03-27 13:54:29'),
(85, 43, 7, 0, 'Abdul  Mazid (TREASURER) logged out', '2015-03-27 13:54:47'),
(86, 42, 33, 0, 'a a(Asst. Purchase Officer 1) logged in', '2015-03-27 13:54:52'),
(87, 43, 33, 0, 'a a(Asst. Purchase Officer 1) logged out', '2015-03-27 13:55:21'),
(88, 42, 7, 0, 'Abdul  Mazid (TREASURER) logged in', '2015-03-27 13:55:29'),
(89, 52, 7, 0, 'Abdul  Mazid (TREASURER) rejected a bill (purchase Id#7)', '2015-03-27 14:19:42'),
(90, 43, 7, 0, 'Abdul  Mazid (TREASURER) logged out', '2015-03-27 14:19:48'),
(91, 42, 5, 0, 'Faruk Ahmed(DAO) logged in', '2015-03-27 14:20:08'),
(92, 42, 5, 0, 'Faruk Ahmed(DAO) logged in', '2015-03-31 04:56:36'),
(93, 47, 5, 9, 'Faruk Ahmed(DAO) forwarded bill (purchase Id#7) to Jamilur Reza(VC)', '2015-03-31 05:22:13'),
(94, 53, 5, 0, 'Faruk Ahmed(DAO) received the stock for purchase Id#7', '2015-03-31 05:22:13'),
(95, 43, 5, 0, 'Faruk Ahmed(DAO) logged out', '2015-03-31 05:22:41'),
(96, 42, 9, 0, 'Jamilur Reza(VC) logged in', '2015-03-31 05:22:50'),
(97, 50, 9, 0, 'Jamilur Reza(VC) signed a check and approved the bill (purchase Id#7)', '2015-03-31 05:23:13'),
(98, 43, 9, 0, 'Jamilur Reza(VC) logged out', '2015-03-31 05:23:19'),
(99, 42, 7, 0, 'Abdul  Mazid (TREASURER) logged in', '2015-03-31 05:23:27'),
(100, 51, 7, 0, 'Abdul  Mazid (TREASURER) paid the bill (purchase Id#7)', '2015-03-31 05:23:39'),
(101, 43, 7, 0, 'Abdul  Mazid (TREASURER) logged out', '2015-03-31 05:23:45'),
(102, 42, 5, 0, 'Faruk Ahmed(DAO) logged in', '2015-03-31 05:23:55'),
(103, 42, 5, 0, 'Faruk Ahmed(DAO) logged in', '2015-04-01 07:11:16'),
(104, 1, 5, 0, 'Faruk Ahmed(DAO) initiated purchase. Id #8', '2015-04-01 07:16:25'),
(105, 2, 5, 6, 'Faruk Ahmed(DAO) forwarded. purchase Id#8 to Alok Kumar(Head)', '2015-04-01 07:17:08'),
(106, 43, 5, 0, 'Faruk Ahmed(DAO) logged out', '2015-04-01 07:17:14'),
(107, 42, 6, 0, 'Alok Kumar(Head) logged in', '2015-04-01 07:19:32'),
(108, 2, 6, 7, 'Alok Kumar(Head) forwarded. purchase Id#8 to Abdul  Mazid (TREASURER)', '2015-04-01 07:20:40'),
(109, 43, 6, 0, 'Alok Kumar(Head) logged out', '2015-04-01 07:23:00'),
(110, 42, 7, 0, 'Abdul  Mazid (TREASURER) logged in', '2015-04-01 07:23:11'),
(111, 4, 7, 7, 'Abdul  Mazid (TREASURER) approved purchase Id#8 and sent to TREASURER to issue work order', '2015-04-01 07:24:26'),
(112, 45, 7, 33, 'Abdul  Mazid (TREASURER) forwarded purchase Id#8 to Asst. Purchase Officer 1 to issue work order', '2015-04-01 07:24:44'),
(113, 43, 7, 0, 'Abdul  Mazid (TREASURER) logged out', '2015-04-01 07:25:30'),
(114, 42, 33, 0, 'a a(Asst. Purchase Officer 1) logged in', '2015-04-01 07:25:37'),
(115, 45, 33, 5, 'Work order for purchase Id#8 is issued by a a(Asst. Purchase Officer 1)', '2015-04-01 07:25:54'),
(116, 43, 33, 0, 'a a(Asst. Purchase Officer 1) logged out', '2015-04-01 07:26:05'),
(117, 42, 5, 0, 'Faruk Ahmed(DAO) logged in', '2015-04-01 07:26:08'),
(118, 47, 5, 33, 'Faruk Ahmed(DAO) forwarded bill (purchase Id#8) to a a(Asst. Purchase Officer 1)', '2015-04-01 07:27:15'),
(119, 53, 5, 0, 'Faruk Ahmed(DAO) received the stock for purchase Id#8', '2015-04-01 07:27:15'),
(120, 43, 5, 0, 'Faruk Ahmed(DAO) logged out', '2015-04-01 07:27:24'),
(121, 42, 34, 0, 'a b(Asst. Purchase Officer 2) logged in', '2015-04-01 07:27:31'),
(122, 43, 34, 0, 'a b(Asst. Purchase Officer 2) logged out', '2015-04-01 07:27:36'),
(123, 42, 33, 0, 'a a(Asst. Purchase Officer 1) logged in', '2015-04-01 07:27:43'),
(124, 47, 33, 7, 'a a(Asst. Purchase Officer 1) forwarded bill (purchase Id#8) to Abdul  Mazid (TREASURER)', '2015-04-01 07:30:01'),
(125, 43, 33, 0, 'a a(Asst. Purchase Officer 1) logged out', '2015-04-01 07:30:06'),
(126, 42, 1, 0, 'Obaidur Rahman(Admin) logged in', '2015-04-01 07:30:21'),
(127, 43, 1, 0, 'Obaidur Rahman(Admin) logged out', '2015-04-01 07:31:28'),
(128, 42, 5, 0, 'Faruk Ahmed(DAO) logged in', '2015-04-01 07:31:31'),
(129, 42, 5, 0, 'Faruk Ahmed(DAO) logged in', '2015-04-15 05:18:48'),
(130, 2, 5, 33, 'Faruk Ahmed(DAO) forwarded. purchase Id#6 to a a(Asst. Purchase Officer 1)', '2015-04-15 05:34:12'),
(131, 43, 5, 0, 'Faruk Ahmed(DAO) logged out', '2015-04-15 05:34:32'),
(132, 42, 33, 0, 'a a(Asst. Purchase Officer 1) logged in', '2015-04-15 05:34:37'),
(133, 2, 33, 7, 'a a(Asst. Purchase Officer 1) forwarded. purchase Id#6 to Abdul  Mazid (TREASURER)', '2015-04-15 05:41:38'),
(134, 43, 33, 0, 'a a(Asst. Purchase Officer 1) logged out', '2015-04-15 05:41:43'),
(135, 42, 7, 0, 'Abdul  Mazid (TREASURER) logged in', '2015-04-15 05:43:07'),
(136, 4, 7, 7, 'Abdul  Mazid (TREASURER) approved purchase Id#6 and sent to TREASURER to issue work order', '2015-04-15 05:45:06'),
(137, 45, 7, 33, 'Abdul  Mazid (TREASURER) forwarded purchase Id#6 to Asst. Purchase Officer 1 to issue work order', '2015-04-15 05:45:30'),
(138, 43, 7, 0, 'Abdul  Mazid (TREASURER) logged out', '2015-04-15 05:45:36'),
(139, 42, 33, 0, 'a a(Asst. Purchase Officer 1) logged in', '2015-04-15 05:45:40'),
(140, 45, 33, 5, 'Work order for purchase Id#6 is issued by a a(Asst. Purchase Officer 1)', '2015-04-15 05:49:37'),
(141, 43, 33, 0, 'a a(Asst. Purchase Officer 1) logged out', '2015-04-15 05:51:27'),
(142, 42, 33, 0, 'a a(Asst. Purchase Officer 1) logged in', '2015-04-15 05:51:35'),
(143, 43, 33, 0, 'a a(Asst. Purchase Officer 1) logged out', '2015-04-15 05:52:38'),
(144, 42, 5, 0, 'Faruk Ahmed(DAO) logged in', '2015-04-15 05:52:39'),
(145, 47, 5, 33, 'Faruk Ahmed(DAO) forwarded bill (purchase Id#8) to a a(Asst. Purchase Officer 1)', '2015-04-15 06:04:46'),
(146, 53, 5, 0, 'Faruk Ahmed(DAO) received the stock for purchase Id#8', '2015-04-15 06:04:47'),
(147, 43, 5, 0, 'Faruk Ahmed(DAO) logged out', '2015-04-15 06:04:52'),
(148, 42, 5, 0, 'Faruk Ahmed(DAO) logged in', '2015-04-15 06:05:44'),
(149, 43, 5, 0, 'Faruk Ahmed(DAO) logged out', '2015-04-15 06:05:47'),
(150, 42, 33, 0, 'a a(Asst. Purchase Officer 1) logged in', '2015-04-15 06:05:52'),
(151, 43, 33, 0, 'a a(Asst. Purchase Officer 1) logged out', '2015-04-15 06:10:15'),
(152, 42, 5, 0, 'Faruk Ahmed(DAO) logged in', '2015-04-15 06:10:19'),
(153, 47, 5, 5, 'Faruk Ahmed(DAO) forwarded bill (purchase Id#6) to Faruk Ahmed(DAO)', '2015-04-15 06:11:18'),
(154, 53, 5, 0, 'Faruk Ahmed(DAO) received the stock for purchase Id#6', '2015-04-15 06:11:18'),
(155, 43, 5, 0, 'Faruk Ahmed(DAO) logged out', '2015-04-15 06:19:42'),
(156, 42, 33, 0, 'a a(Asst. Purchase Officer 1) logged in', '2015-04-15 06:19:48'),
(157, 47, 33, 7, 'a a(Asst. Purchase Officer 1) forwarded bill (purchase Id#8) to Abdul  Mazid (TREASURER)', '2015-04-15 06:22:11'),
(158, 43, 33, 0, 'a a(Asst. Purchase Officer 1) logged out', '2015-04-15 06:22:14'),
(159, 42, 7, 0, 'Abdul  Mazid (TREASURER) logged in', '2015-04-15 06:22:20'),
(160, 48, 7, 0, 'Abdul  Mazid (TREASURER) issued check for purchase Id#8', '2015-04-15 06:23:01'),
(161, 42, 5, 0, 'Faruk Ahmed(DAO) logged in', '2015-04-21 17:49:00'),
(162, 43, 5, 0, 'Faruk Ahmed(DAO) logged out', '2015-04-21 18:26:07'),
(163, 42, 5, 0, 'Faruk Ahmed(DAO) logged in', '2015-04-21 18:26:09'),
(164, 1, 5, 0, 'Faruk Ahmed(DAO) initiated purchase. Id #9', '2015-04-21 18:36:15'),
(165, 42, 5, 0, 'Faruk Ahmed(DAO) logged in', '2015-04-22 03:38:19'),
(166, 2, 5, 6, 'Faruk Ahmed(DAO) forwarded. purchase Id#9 to Alok Kumar(Head)', '2015-04-22 03:43:34'),
(167, 43, 5, 0, 'Faruk Ahmed(DAO) logged out', '2015-04-22 03:44:14'),
(168, 42, 6, 0, 'Alok Kumar(Head) logged in', '2015-04-22 03:44:28'),
(169, 2, 6, 7, 'Alok Kumar(Head) forwarded. purchase Id#9 to Abdul  Mazid (TREASURER)', '2015-04-22 03:46:56'),
(170, 43, 6, 0, 'Alok Kumar(Head) logged out', '2015-04-22 03:46:59'),
(171, 42, 7, 0, 'Abdul  Mazid (TREASURER) logged in', '2015-04-22 03:47:13'),
(172, 4, 7, 7, 'Abdul  Mazid (TREASURER) approved purchase Id#9 and sent to TREASURER to issue work order', '2015-04-22 03:51:43'),
(173, 45, 7, 33, 'Abdul  Mazid (TREASURER) forwarded purchase Id#9 to Asst. Purchase Officer 1 to issue work order', '2015-04-22 03:53:36'),
(174, 43, 7, 0, 'Abdul  Mazid (TREASURER) logged out', '2015-04-22 03:53:44'),
(175, 42, 33, 0, 'a a(Asst. Purchase Officer 1) logged in', '2015-04-22 03:53:49'),
(176, 45, 33, 5, 'Work order for purchase Id#9 is issued by a a(Asst. Purchase Officer 1)', '2015-04-22 03:54:43'),
(177, 43, 33, 0, 'a a(Asst. Purchase Officer 1) logged out', '2015-04-22 03:54:47'),
(178, 42, 5, 0, 'Faruk Ahmed(DAO) logged in', '2015-04-22 03:54:52'),
(179, 42, 5, 0, 'Faruk Ahmed(DAO) logged in', '2015-04-22 06:28:27'),
(180, 47, 5, 33, 'Faruk Ahmed(DAO) forwarded bill (purchase Id#9) to Riazul Hoque(Asst. Purchase Officer 1)', '2015-04-22 06:30:37'),
(181, 53, 5, 0, 'Faruk Ahmed(DAO) received the stock for purchase Id#9', '2015-04-22 06:30:37'),
(182, 43, 5, 0, 'Faruk Ahmed(DAO) logged out', '2015-04-22 06:32:23'),
(183, 42, 33, 0, 'Riazul Hoque(Asst. Purchase Officer 1) logged in', '2015-04-22 06:32:28'),
(184, 47, 33, 7, 'Riazul Hoque(Asst. Purchase Officer 1) forwarded bill (purchase Id#9) to Abdul  Mazid (TREASURER)', '2015-04-22 06:35:47'),
(185, 43, 33, 0, 'Riazul Hoque(Asst. Purchase Officer 1) logged out', '2015-04-22 06:35:51'),
(186, 42, 7, 0, 'Abdul  Mazid (TREASURER) logged in', '2015-04-22 06:36:08'),
(187, 42, 1, 0, 'Obaidur Rahman(Admin) logged in', '2015-05-16 06:06:38'),
(188, 42, 1, 0, 'Obaidur Rahman(Admin) logged in', '2015-05-17 04:35:34'),
(189, 1, 1, 0, 'Obaidur Rahman(Admin) initiated purchase. Id #10', '2015-05-17 05:57:20'),
(190, 1, 1, 0, 'Obaidur Rahman(Admin) initiated purchase. Id #11', '2015-05-17 05:59:26'),
(191, 1, 1, 0, 'Obaidur Rahman(Admin) initiated purchase. Id #12', '2015-05-17 07:41:50'),
(192, 1, 1, 0, 'Obaidur Rahman(Admin) initiated purchase. Id #13', '2015-05-17 08:41:43'),
(193, 1, 1, 0, 'Obaidur Rahman(Admin) initiated purchase. Id #14', '2015-05-17 08:43:41'),
(194, 1, 1, 0, 'Obaidur Rahman(Admin) initiated purchase. Id #15', '2015-05-17 08:44:25'),
(195, 1, 1, 0, 'Obaidur Rahman(Admin) initiated purchase. Id #16', '2015-05-17 09:06:52'),
(196, 42, 1, 0, 'Obaidur Rahman(Admin) logged in', '2015-05-17 13:16:40'),
(197, 2, 1, 33, 'Obaidur Rahman(Admin) forwarded. purchase Id#16 to Riazul Hoque(Asst. Purchase Officer 1)', '2015-05-17 14:21:31'),
(198, 43, 1, 0, 'Obaidur Rahman(Admin) logged out', '2015-05-17 14:21:42'),
(199, 42, 33, 0, 'Riazul Hoque(Asst. Purchase Officer 1) logged in', '2015-05-17 14:21:50'),
(200, 2, 33, 33, 'Riazul Hoque(Asst. Purchase Officer 1) updated item info purchase Id# item Id#', '2015-05-17 16:37:52'),
(201, 2, 33, 33, 'Riazul Hoque(Asst. Purchase Officer 1) updated item info purchase Id#16 item Id#14', '2015-05-17 16:41:51'),
(202, 2, 33, 33, 'Riazul Hoque(Asst. Purchase Officer 1) updated item info purchase Id#16 item Id#14', '2015-05-17 16:43:33'),
(203, 2, 33, 33, 'Riazul Hoque(Asst. Purchase Officer 1) updated item info purchase Id#16 item Id#14', '2015-05-17 16:44:03'),
(204, 56, 33, 6, 'Riazul Hoque(Asst. Purchase Officer 1) verified and forwarded purchase Id#16', '2015-05-17 18:50:54'),
(205, 43, 33, 0, 'Riazul Hoque(Asst. Purchase Officer 1) logged out', '2015-05-17 18:51:02'),
(206, 42, 6, 0, 'Alok Kumar(Head) logged in', '2015-05-17 18:51:20'),
(207, 42, 1, 0, 'Obaidur Rahman(Admin) logged in', '2015-05-18 13:38:50'),
(208, 43, 1, 0, 'Obaidur Rahman(Admin) logged out', '2015-05-18 15:39:07'),
(209, 42, 5, 0, 'Faruk Ahmed(DAO) logged in', '2015-05-18 15:39:12'),
(210, 1, 5, 0, 'Faruk Ahmed(DAO) initiated purchase. Id #17', '2015-05-18 15:44:46'),
(211, 2, 5, 6, 'Faruk Ahmed(DAO) forwarded. purchase Id#17 to Alok Kumar(Head)', '2015-05-18 15:46:33'),
(212, 43, 5, 0, 'Faruk Ahmed(DAO) logged out', '2015-05-18 15:46:37'),
(213, 42, 6, 0, 'Alok Kumar(Head) logged in', '2015-05-18 15:50:04'),
(214, 2, 6, 33, 'Alok Kumar(Head) forwarded. purchase Id#17 to Riazul Hoque(Asst. Purchase Officer 1)', '2015-05-18 15:50:20'),
(215, 43, 6, 0, 'Alok Kumar(Head) logged out', '2015-05-18 15:50:27'),
(216, 42, 33, 0, 'Riazul Hoque(Asst. Purchase Officer 1) logged in', '2015-05-18 15:50:51'),
(217, 2, 33, 33, 'Riazul Hoque(Asst. Purchase Officer 1) updated item info purchase Id#17 item Id#15', '2015-05-18 15:51:37'),
(218, 2, 33, 7, 'Riazul Hoque(Asst. Purchase Officer 1) forwarded. purchase Id#17 to Abdul  Mazid (TREASURER)', '2015-05-18 15:52:01'),
(219, 43, 33, 0, 'Riazul Hoque(Asst. Purchase Officer 1) logged out', '2015-05-18 15:52:05'),
(220, 42, 10, 0, 'fname lname(None) logged in', '2015-05-18 15:52:35'),
(221, 43, 10, 0, 'fname lname(None) logged out', '2015-05-18 15:52:47'),
(222, 42, 7, 0, 'Abdul  Mazid (TREASURER) logged in', '2015-05-18 15:53:31'),
(223, 4, 7, 7, 'Abdul  Mazid (TREASURER) approved purchase Id#17 and sent to TREASURER to issue work order', '2015-05-18 15:53:39'),
(224, 45, 7, 33, 'Abdul  Mazid (TREASURER) forwarded purchase Id#17 to Asst. Purchase Officer 1 to issue work order', '2015-05-18 15:53:48'),
(225, 43, 7, 0, 'Abdul  Mazid (TREASURER) logged out', '2015-05-18 15:53:51'),
(226, 42, 33, 0, 'Riazul Hoque(Asst. Purchase Officer 1) logged in', '2015-05-18 15:53:55'),
(227, 45, 33, 5, 'Work order for purchase Id#17 is issued by Riazul Hoque(Asst. Purchase Officer 1)', '2015-05-18 15:54:04'),
(228, 43, 33, 0, 'Riazul Hoque(Asst. Purchase Officer 1) logged out', '2015-05-18 15:54:07'),
(229, 42, 6, 0, 'Alok Kumar(Head) logged in', '2015-05-18 15:54:18'),
(230, 42, 8, 0, 'M. R. Kabir(Pro-vc) logged in', '2015-05-19 05:48:24'),
(231, 43, 8, 0, 'M. R. Kabir(Pro-vc) logged out', '2015-05-19 05:48:31'),
(232, 42, 9, 0, 'Jamilur Reza(VC) logged in', '2015-05-19 05:48:38'),
(233, 43, 9, 0, 'Jamilur Reza(VC) logged out', '2015-05-19 05:48:43'),
(234, 42, 5, 0, 'Faruk Ahmed(DAO) logged in', '2015-05-19 06:14:54'),
(235, 1, 5, 0, 'Faruk Ahmed(DAO) initiated purchase. Id #18', '2015-05-19 06:25:38'),
(236, 2, 5, 6, 'Faruk Ahmed(DAO) forwarded. purchase Id#18 to Alok Kumar(Head)', '2015-05-19 06:52:19'),
(237, 43, 5, 0, 'Faruk Ahmed(DAO) logged out', '2015-05-19 06:52:27'),
(238, 42, 6, 0, 'Alok Kumar(Head) logged in', '2015-05-19 06:52:36'),
(239, 2, 6, 33, 'Alok Kumar(Head) forwarded. purchase Id#18 to Riazul Hoque(Asst. Purchase Officer 1)', '2015-05-19 07:04:06'),
(240, 43, 6, 0, 'Alok Kumar(Head) logged out', '2015-05-19 07:05:23'),
(241, 42, 33, 0, 'Riazul Hoque(Asst. Purchase Officer 1) logged in', '2015-05-19 07:05:30'),
(242, 2, 33, 7, 'Riazul Hoque(Asst. Purchase Officer 1) forwarded. purchase Id#18 to Abdul  Mazid (TREASURER)', '2015-05-19 07:10:57'),
(243, 43, 33, 0, 'Riazul Hoque(Asst. Purchase Officer 1) logged out', '2015-05-19 07:11:53'),
(244, 42, 7, 0, 'Abdul  Mazid (TREASURER) logged in', '2015-05-19 07:12:13'),
(245, 4, 7, 7, 'Abdul  Mazid (TREASURER) approved purchase Id#18 and sent to TREASURER to issue work order', '2015-05-19 07:13:17'),
(246, 43, 7, 0, 'Abdul  Mazid (TREASURER) logged out', '2015-05-19 07:27:44'),
(247, 42, 5, 0, 'Faruk Ahmed(DAO) logged in', '2015-05-19 07:27:53'),
(248, 1, 5, 0, 'Faruk Ahmed(DAO) initiated purchase. Id #19', '2015-05-19 07:30:11'),
(249, 2, 5, 6, 'Faruk Ahmed(DAO) forwarded. purchase Id#19 to Alok Kumar(Head)', '2015-05-19 07:32:03');

-- --------------------------------------------------------

--
-- Table structure for table `activity_type`
--

CREATE TABLE IF NOT EXISTS `activity_type` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `activity_name` varchar(255) NOT NULL,
  `activity_description` varchar(1000) NOT NULL,
  `create_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `activity_type`
--

INSERT INTO `activity_type` (`id`, `activity_name`, `activity_description`, `create_date`) VALUES
(1, 'Purchase Initiate', 'requisition has been made', '2014-05-02 18:14:04'),
(2, 'Forward', 'user has been approved and forwarded to the next user', '2014-05-02 18:14:04'),
(3, 'Backward', 'user has been disapproved and backwarded to the previous user', '2014-05-02 18:14:04'),
(4, 'Approved', 'the end user has approved the purchase', '2014-05-02 18:14:04'),
(5, 'Reject', 'the end user has rejected the purchase', '2014-05-02 18:14:04'),
(6, 'Stock_entry', 'the admin has distributed the purchased product to the respective departments', '2014-05-02 18:14:04'),
(7, 'create_user', 'user info modification by admin', '2014-05-02 18:14:04'),
(8, 'reset_password', 'user info modification by admin', '2014-05-02 18:14:04'),
(9, 'edit_user_info', 'user info modification by admin', '2014-05-02 18:14:04'),
(10, 'lock_user', 'user info modification by admin', '2014-05-02 18:14:05'),
(11, 'unlock_user', 'user info modification by admin', '2014-05-02 18:14:05'),
(12, 'department_create', 'department info modification by admin', '2014-05-02 18:14:05'),
(13, 'edit_dept_info', 'department info modification by admin', '2014-05-02 18:14:05'),
(14, 'lock_dept', 'department info modification by admin', '2014-05-02 18:14:05'),
(15, 'unlock_dept', 'department info modification by admin', '2014-05-02 18:14:05'),
(16, 'role_create', 'role info modification by admin', '2014-05-02 18:14:05'),
(17, 'edit_role_info', 'role info modification by admin', '2014-05-02 18:14:05'),
(18, 'lock_role', 'role info modification by admin', '2014-05-02 18:14:05'),
(19, 'force_role_assign', 'role info modification by admin', '2014-05-02 18:14:05'),
(20, 'product_create', 'product info modification by admin', '2014-05-02 18:14:05'),
(21, 'edit_product_info', 'product info modification by admin', '2014-05-02 18:14:05'),
(22, 'lock_product', 'product info modification by admin', '2014-05-02 18:14:05'),
(23, 'category_create', 'product info modification by admin', '2014-05-02 18:14:05'),
(24, 'edit_category_info', 'product info modification by admin', '2014-05-02 18:14:05'),
(25, 'lock_category', 'product info modification by admin', '2014-05-02 18:14:05'),
(26, 'supplier_create', 'supplier info modification by admin', '2014-05-02 18:14:05'),
(27, 'edit_supplier_info', 'supplier info modification by admin', '2014-05-02 18:14:05'),
(28, 'lock_supplier', 'supplier info modification by admin', '2014-05-02 18:14:05'),
(29, 'edit_user_info', 'user info modification by user', '2014-05-02 18:14:05'),
(30, 'change_password', 'user info modification by user', '2014-05-02 18:14:06'),
(31, 'role_assign', 'user info modification by user', '2014-05-02 18:14:06'),
(33, 'unlock_role', 'user info modification by admin', '2014-05-02 21:22:44'),
(34, 'unlock_category', 'category info modification by admin', '2014-05-03 12:55:04'),
(35, 'unclock_supplier', 'supplier info modification by admin', '2014-05-03 21:38:09'),
(36, 'stock_distribution', 'stock distribution to departments by admin', '2014-05-03 21:58:33'),
(37, 'added_to_wastage', 'stock added to wastage', '2014-05-04 02:40:41'),
(38, 'added_to_auctionable', 'added to auctionable', '2014-05-04 02:40:41'),
(42, 'login', 'user login', '2014-05-04 03:26:44'),
(43, 'logout', 'user logout', '2014-05-04 03:26:44'),
(44, 'registration_completed', 'registration completed by user', '2014-05-04 03:26:44'),
(45, 'issue_work_order', 'Request to issue work order', '0000-00-00 00:00:00'),
(46, 'work_order_issued', 'Work order issued', '0000-00-00 00:00:00'),
(47, 'bill_forwarded', 'Bill forwarded for further processsing', '0000-00-00 00:00:00'),
(48, 'check_issued', 'Check issued against bill', '0000-00-00 00:00:00'),
(49, 'check_singed_and_forwarded', 'Check signed and forwarded for further processing', '0000-00-00 00:00:00'),
(50, 'check_singed_and_approved', 'Check singed and approved', '0000-00-00 00:00:00'),
(51, 'bill_paid', 'BIll paid', '0000-00-00 00:00:00'),
(52, 'bill_rejected', 'bill_rejected', '0000-00-00 00:00:00'),
(53, 'stock_entered', 'Stock received by respective departments/sections  ', '0000-00-00 00:00:00'),
(54, 'stock_adjusted', 'Stock adjusted after delete or updat', '0000-00-00 00:00:00'),
(55, 'update_item_info', 'Item information updated', '0000-00-00 00:00:00'),
(56, 'verify_and_forward', 'purchase info verified and forwarded', '2015-05-18 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `bill_process_flow_structure`
--

CREATE TABLE IF NOT EXISTS `bill_process_flow_structure` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `step` int(3) NOT NULL,
  `concerned_role` int(3) NOT NULL,
  `can_approve` int(1) NOT NULL,
  `check_issuer` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `bill_process_flow_structure`
--

INSERT INTO `bill_process_flow_structure` (`id`, `step`, `concerned_role`, `can_approve`, `check_issuer`) VALUES
(1, 1, 22, 0, 0),
(2, 2, 37, 0, 0),
(3, 2, 38, 0, 0),
(4, 3, 26, 1, 1),
(5, 4, 39, 1, 0),
(6, 5, 40, 1, 0),
(7, 6, 26, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `departmentsection`
--

CREATE TABLE IF NOT EXISTS `departmentsection` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `ds_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ds_type` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'department',
  `ds_loc` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `ds_phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `ds_mail` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `ds_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;

--
-- Dumping data for table `departmentsection`
--

INSERT INTO `departmentsection` (`id`, `ds_name`, `ds_type`, `ds_loc`, `ds_phone`, `ds_mail`, `ds_status`) VALUES
(1, 'CSE', 'department', 'Dhanmondi 4/a', '0192884472324', 'cse@uap-bd.edu', 1),
(2, 'EEE', 'department', '4/A, Dhanmondi, Dhaka', '01919000001', 'eee@uap-bd.edu', 1),
(3, 'BBA', 'department', '9/A, Dhanmondi, Dhaka', '123456', 'bba@uap-bd.edu', 1),
(4, 'Architecture', 'department', '4/A, Dhanmondi', '123456', 'arch@uap-bd.edu', 1),
(5, 'Law', 'department', '3/A, Dhanmondi', '123456', 'law@uap-bd.edu', 1),
(6, 'English', 'department', '15, Dhanmondi', '123456', 'english@uap-bd.', 1),
(7, 'New deptd', 'department', 'Test', '121212s', 'newdept@abc.com', 1),
(8, 'Purchase Section', 'section', 'Dhanmondi', '12121212', 'test@puchase.co', 1),
(9, 'Finance & Account section', 'section', 'Dhanmondi', '12121212', 'finance@abc.com', 1),
(10, 'Central Library', 'section', 'Dhanmondi', '12121212', 'test@abc.com', 1),
(11, 'Admission', 'section', 'Dhanmondi', '12121212', 'test@abc.com', 1),
(12, 'Administration', 'section', 'Dhanmondi', '12121212', 'test@abc.com', 1),
(13, 'City campus', 'section', 'Dhanmondi', '12121212', 'test@abc.com', 1),
(14, 'Controller of Examination', 'section', 'Dhanmondi', '12121212', 'test@abc.com', 1),
(15, 'It section', 'section', 'Dhanmondi', '12121212', 'test@abc.com', 1),
(16, 'Pro-vc office', 'section', 'Dhanmondi', '12121212', 'test@abc.com', 1),
(17, 'VC office', 'section', 'Dhanmondi', '12121212', 'test@abc.com', 1),
(18, 'PSC', 'section', 'Dhanmondi', '12121212', 'test@abc.com', 1),
(19, 'PPC', 'section', 'Dhanmondi', '12121212', 'test@abc.com', 1),
(20, 'It commitee', 'rec_com', 'Dhanmondi', '12121212', 'test@abc.com', 1),
(21, 'Pharmecy commitee', 'rec_com', 'Dhanmondi', '12121212', 'test@abc.com', 1),
(22, 'Replacement Committe', 'rec_com', 'Test location', '112233', 'aaa@bbb.com', 1),
(23, 'Recommendation committee', 'rec_com', 'Test location', '112233', 'aa@mail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `inspection_report`
--

CREATE TABLE IF NOT EXISTS `inspection_report` (
  `id` tinyint(5) NOT NULL AUTO_INCREMENT,
  `present_status` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `recommendation` tinyint(5) NOT NULL,
  `inspector_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `inspector_designation` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `inspection_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ir` (`recommendation`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from` int(11) DEFAULT NULL,
  `to` int(11) NOT NULL,
  `origin_module` varchar(50) NOT NULL,
  `relation` varchar(50) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `action` tinyint(50) NOT NULL,
  `task_name` varchar(50) NOT NULL,
  `is_processed` tinyint(1) NOT NULL DEFAULT '0',
  `is_readonly` int(2) NOT NULL DEFAULT '0',
  `date` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=101 ;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `from`, `to`, `origin_module`, `relation`, `entity_id`, `action`, `task_name`, `is_processed`, `is_readonly`, `date`) VALUES
(1, 1, 1, 'purchase', 'purchasing', 5, 1, '', 1, 0, 1422907346),
(2, 5, 5, 'purchase', 'purchasing', 6, 1, '', 1, 0, 1423212600),
(3, 1, 9, 'purchase', 'purchasing', 5, 5, '', 1, 0, 1427116823),
(4, 9, 7, 'purchase', 'purchasing', 5, 7, '', 1, 0, 1427116851),
(5, 9, 1, 'purchase', 'purchasing', 5, 7, '', 1, 1, 1427116851),
(6, 7, 33, 'purchase', 'work_order_issue', 5, 8, '', 1, 0, 1427124419),
(7, 7, 33, 'purchase', 'work_order_issue', 5, 8, '', 1, 0, 1427124842),
(8, 7, 33, 'purchase', 'work_order_issue', 5, 8, '', 1, 0, 1427125927),
(9, 33, 1, 'purchase', 'purchasing', 5, 9, '', 1, 1, 1427136928),
(10, 33, 1, 'purchase', 'purchasing', 5, 9, '', 1, 1, 1427136940),
(11, 33, 1, 'purchase', 'purchasing', 5, 9, '', 1, 1, 1427136952),
(12, 1, 1, 'purchase', 'purchasing', 7, 1, '', 1, 0, 1427195094),
(13, 1, 6, 'purchase', 'purchasing', 7, 5, '', 1, 0, 1427195351),
(14, 6, 7, 'purchase', 'purchasing', 7, 5, '', 1, 0, 1427204537),
(15, 7, 7, 'purchase', 'purchasing', 7, 7, '', 1, 0, 1427204560),
(16, 7, 1, 'purchase', 'purchasing', 7, 7, '', 1, 1, 1427204560),
(17, 7, 33, 'purchase', 'purchasing', 7, 8, '', 1, 0, 1427204637),
(18, 33, 1, 'purchase', 'purchasing', 7, 9, '', 1, 1, 1427204680),
(19, 1, 5, 'bill_process', 'bills', 7, 10, '', 0, 0, 1427390826),
(20, 1, 5, 'bill_process', 'bills', 7, 10, '', 0, 0, 1427390877),
(21, 1, 5, 'bill_process', 'bills', 7, 10, '', 1, 0, 1427390940),
(22, 5, 7, 'bill_process', 'bills', 7, 10, '', 1, 0, 1427399062),
(23, 5, 7, 'bill_process', 'bills', 7, 10, '', 1, 0, 1427401044),
(24, 5, 7, 'bill_process', 'bills', 7, 10, '', 1, 0, 1427401251),
(25, 5, 5, 'bill_process', 'bills', 7, 10, '', 0, 0, 1427438698),
(26, 5, 5, 'bill_process', 'bills', 7, 10, '', 0, 0, 1427438840),
(27, 5, 5, 'stock_management', 'stock_details', 7, 16, '', 0, 1, 1427438841),
(28, 7, 7, 'bill_process', 'bills', 7, 11, '', 1, 0, 1427460780),
(29, 7, 7, 'bill_process', 'bills', 7, 11, '', 1, 0, 1427460860),
(30, 7, 7, 'bill_process', 'bills', 7, 11, '', 1, 0, 1427461034),
(31, 7, 7, 'bill_process', 'bills', 7, 11, '', 1, 0, 1427461172),
(32, 7, 8, 'bill_process', 'bills', 7, 12, '', 0, 0, 1427463988),
(33, 7, 8, 'bill_process', 'bills', 7, 12, '', 0, 0, 1427464056),
(34, 7, 7, 'bill_process', 'bills', 7, 13, '', 1, 0, 1427464099),
(35, 7, 33, 'bill_process', 'bills', 7, 14, '', 1, 1, 1427464113),
(36, 7, 33, 'bill_process', 'bills', 7, 14, '', 1, 1, 1427464431),
(37, 7, 33, 'bill_process', 'bills', 7, 15, '', 0, 1, 1427465982),
(38, 7, 5, 'bill_process', 'bills', 7, 15, '', 1, 1, 1427465982),
(39, 7, 5, 'stock_management', 'stock_details', 7, 17, '', 0, 1, 1427465982),
(40, 5, 9, 'bill_process', 'bills', 7, 10, '', 1, 0, 1427779333),
(41, 5, 5, 'stock_management', 'stock_details', 7, 16, '', 0, 1, 1427779333),
(42, 9, 7, 'bill_process', 'bills', 7, 13, '', 1, 0, 1427779393),
(43, 7, 33, 'bill_process', 'bills', 7, 14, '', 0, 1, 1427779419),
(44, 5, 5, 'purchase', 'purchasing', 8, 1, '', 1, 0, 1427872585),
(45, 5, 6, 'purchase', 'purchasing', 8, 5, '', 1, 0, 1427872628),
(46, 6, 7, 'purchase', 'purchasing', 8, 5, '', 1, 0, 1427872840),
(47, 7, 7, 'purchase', 'purchasing', 8, 7, '', 1, 0, 1427873066),
(48, 7, 5, 'purchase', 'purchasing', 8, 7, '', 1, 1, 1427873066),
(49, 7, 33, 'purchase', 'purchasing', 8, 8, '', 1, 0, 1427873084),
(50, 33, 5, 'purchase', 'purchasing', 8, 9, '', 1, 1, 1427873154),
(51, 5, 33, 'bill_process', 'bills', 8, 10, '', 1, 0, 1427873235),
(52, 5, 5, 'stock_management', 'stock_details', 8, 16, '', 0, 1, 1427873235),
(53, 33, 7, 'bill_process', 'bills', 8, 10, '', 0, 0, 1427873401),
(54, 5, 33, 'purchase', 'purchasing', 6, 5, '', 1, 0, 1429076052),
(55, 33, 7, 'purchase', 'purchasing', 6, 5, '', 1, 0, 1429076498),
(56, 7, 7, 'purchase', 'purchasing', 6, 7, '', 1, 0, 1429076706),
(57, 7, 5, 'purchase', 'purchasing', 6, 7, '', 1, 1, 1429076706),
(58, 7, 33, 'purchase', 'purchasing', 6, 8, '', 1, 0, 1429076730),
(59, 33, 5, 'purchase', 'purchasing', 6, 9, '', 1, 1, 1429076976),
(60, 5, 33, 'bill_process', 'bills', 8, 10, '', 1, 0, 1429077886),
(61, 5, 5, 'stock_management', 'stock_details', 8, 16, '', 0, 1, 1429077887),
(62, 5, 5, 'bill_process', 'bills', 6, 10, '', 0, 0, 1429078278),
(63, 5, 5, 'stock_management', 'stock_details', 6, 16, '', 0, 1, 1429078278),
(64, 33, 7, 'bill_process', 'bills', 8, 10, '', 1, 0, 1429078931),
(65, 7, 7, 'bill_process', 'bills', 8, 11, '', 0, 0, 1429078981),
(66, 5, 5, 'purchase', 'purchasing', 9, 1, '', 1, 0, 1429641375),
(67, 5, 6, 'purchase', 'purchasing', 9, 5, '', 1, 0, 1429674214),
(68, 6, 7, 'purchase', 'purchasing', 9, 5, '', 1, 0, 1429674415),
(69, 7, 7, 'purchase', 'purchasing', 9, 7, '', 1, 0, 1429674703),
(70, 7, 5, 'purchase', 'purchasing', 9, 7, '', 1, 1, 1429674703),
(71, 7, 33, 'purchase', 'purchasing', 9, 8, '', 1, 0, 1429674816),
(72, 33, 5, 'purchase', 'purchasing', 9, 9, '', 1, 1, 1429674882),
(73, 5, 33, 'bill_process', 'bills', 9, 10, '', 1, 0, 1429684237),
(74, 5, 5, 'stock_management', 'stock_details', 9, 16, '', 0, 1, 1429684237),
(75, 33, 7, 'bill_process', 'bills', 9, 10, '', 0, 0, 1429684547),
(76, 1, 1, 'purchase', 'purchasing', 10, 1, '', 0, 0, 1431842240),
(77, 1, 1, 'purchase', 'purchasing', 11, 1, '', 0, 0, 1431842366),
(78, 1, 1, 'purchase', 'purchasing', 12, 1, '', 0, 0, 1431848510),
(79, 1, 1, 'purchase', 'purchasing', 13, 1, '', 0, 0, 1431852103),
(80, 1, 1, 'purchase', 'purchasing', 14, 1, '', 0, 0, 1431852221),
(81, 1, 1, 'purchase', 'purchasing', 15, 1, '', 0, 0, 1431852265),
(82, 1, 1, 'purchase', 'purchasing', 16, 1, '', 1, 0, 1431853612),
(83, 1, 33, 'purchase', 'purchasing', 16, 5, '', 1, 0, 1431872490),
(84, 33, 6, 'purchase', 'purchasing', 16, 18, '', 0, 0, 1431888654),
(85, 5, 5, 'purchase', 'purchasing', 17, 1, '', 1, 0, 1431963886),
(86, 5, 6, 'purchase', 'purchasing', 17, 5, '', 1, 0, 1431963993),
(87, 6, 33, 'purchase', 'purchasing', 17, 5, '', 1, 0, 1431964220),
(88, 33, 7, 'purchase', 'purchasing', 17, 5, '', 1, 0, 1431964321),
(89, 7, 7, 'purchase', 'purchasing', 17, 7, '', 1, 0, 1431964419),
(90, 7, 5, 'purchase', 'purchasing', 17, 7, '', 0, 1, 1431964419),
(91, 7, 33, 'purchase', 'purchasing', 17, 8, '', 1, 0, 1431964428),
(92, 33, 5, 'purchase', 'purchasing', 17, 9, '', 0, 1, 1431964444),
(93, 5, 5, 'purchase', 'purchasing', 18, 1, '', 1, 0, 1432016738),
(94, 5, 6, 'purchase', 'purchasing', 18, 5, '', 1, 0, 1432018339),
(95, 6, 33, 'purchase', 'purchasing', 18, 5, '', 1, 0, 1432019046),
(96, 33, 7, 'purchase', 'purchasing', 18, 5, '', 1, 0, 1432019457),
(97, 7, 7, 'purchase', 'purchasing', 18, 7, '', 0, 0, 1432019597),
(98, 7, 5, 'purchase', 'purchasing', 18, 7, '', 0, 1, 1432019597),
(99, 5, 5, 'purchase', 'purchasing', 19, 1, '', 1, 0, 1432020611),
(100, 5, 6, 'purchase', 'purchasing', 19, 5, '', 0, 0, 1432020723);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_attachment`
--

CREATE TABLE IF NOT EXISTS `purchase_attachment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'quotation',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `purchase_attachment`
--

INSERT INTO `purchase_attachment` (`id`, `purchase_id`, `file_name`, `type`) VALUES
(1, 8, 'Thesis_group_names.pdf', 'quotation'),
(2, 16, 'final_thesis_group.pdf', 'quotation'),
(3, 17, 'flow.jpg', 'quotation'),
(4, 17, 'flow1.jpg', 'cs'),
(5, 18, 'flow3.jpg', 'quotation'),
(6, 18, 'flow4.jpg', 'cs');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_category`
--

CREATE TABLE IF NOT EXISTS `purchase_category` (
  `id` tinyint(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `purchase_category`
--

INSERT INTO `purchase_category` (`id`, `name`, `description`) VALUES
(1, 'FORM B', 'Advance through quotation for capital item '),
(2, 'FORM B1', 'Advance (General advance form)'),
(3, 'FORM C', 'Adjustment of advance'),
(4, 'FORM D', 'Requisition for purchase section'),
(5, 'Administrative approval (200K to 1000K)', '');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_flow`
--

CREATE TABLE IF NOT EXISTS `purchase_flow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_id` int(11) NOT NULL,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `subject` text NOT NULL,
  `message` text NOT NULL,
  `status_type` int(11) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=86 ;

--
-- Dumping data for table `purchase_flow`
--

INSERT INTO `purchase_flow` (`id`, `purchase_id`, `from`, `to`, `subject`, `message`, `status_type`, `date`) VALUES
(1, 5, 1, 1, 'Purchase initiated', 'aaa', 1, '2015-02-02 14:02:26'),
(2, 6, 5, 5, 'Purchase initiated', 'aaa', 1, '2015-02-06 02:49:59'),
(3, 5, 1, 9, '', '', 5, '2015-03-23 13:20:23'),
(4, 5, 9, 7, '', '', 7, '2015-03-23 13:20:51'),
(5, 5, 7, 33, '0', '', 8, '2015-03-23 15:26:59'),
(6, 5, 7, 33, ' ', '', 8, '2015-03-23 15:34:02'),
(7, 5, 7, 33, ' ', '', 8, '2015-03-23 15:52:07'),
(8, 5, 33, 1, ' ', '', 9, '2015-03-23 18:55:28'),
(9, 5, 33, 1, ' ', '', 9, '2015-03-23 18:55:40'),
(10, 5, 33, 1, ' ', '', 9, '2015-03-23 18:55:52'),
(11, 7, 1, 1, 'Purchase initiated', 'aaaa', 1, '2015-03-24 11:04:53'),
(12, 7, 1, 6, ' ', '', 5, '2015-03-24 11:09:11'),
(13, 7, 6, 7, ' ', '', 5, '2015-03-24 13:42:17'),
(14, 7, 7, 7, ' ', '', 7, '2015-03-24 13:42:40'),
(15, 7, 7, 33, ' ', '', 8, '2015-03-24 13:43:58'),
(16, 7, 33, 1, ' ', '', 9, '2015-03-24 13:44:40'),
(17, 7, 1, 5, ' ', 'fdsfasf', 10, '2015-03-26 17:27:07'),
(18, 7, 1, 5, ' ', 'fdsfasf', 10, '2015-03-26 17:27:57'),
(19, 7, 1, 5, ' ', 'dfsdfsdf', 10, '2015-03-26 17:29:00'),
(20, 7, 5, 7, ' ', 'vcvsv', 10, '2015-03-26 19:44:22'),
(21, 7, 5, 7, ' ', 'c vsdfsd', 10, '2015-03-26 20:17:24'),
(22, 7, 5, 7, ' ', 'cdfsd', 10, '2015-03-26 20:20:51'),
(23, 7, 5, 5, ' ', 'dfsdfs', 10, '2015-03-27 06:44:59'),
(24, 7, 5, 5, ' ', 'fsdfsdf', 10, '2015-03-27 06:47:21'),
(25, 7, 7, 5, ' ', 'fsdfsd', 10, '2015-03-27 12:53:00'),
(26, 7, 7, 5, ' ', 'fsdfsd', 10, '2015-03-27 12:54:20'),
(27, 7, 7, 5, ' ', 'c dz', 10, '2015-03-27 12:57:14'),
(28, 7, 7, 7, 'Check issued', 'dsfdsf', 11, '2015-03-27 12:59:32'),
(29, 7, 7, 8, 'Check forward', '', 12, '2015-03-27 13:46:28'),
(30, 7, 7, 8, 'Check forward', '', 12, '2015-03-27 13:47:36'),
(31, 7, 7, 7, 'Check approved', 'fsdfsdfsd', 13, '2015-03-27 13:48:19'),
(32, 7, 7, 7, 'Bill paid', '', 14, '2015-03-27 13:48:33'),
(33, 7, 7, 7, 'Bill paid', 'fsdfsd', 14, '2015-03-27 13:53:51'),
(34, 7, 7, 7, 'Bill rejected', 'fdsfsdf', 15, '2015-03-27 14:19:42'),
(35, 7, 5, 9, ' ', 'fsdfsdfs', 10, '2015-03-31 05:22:13'),
(36, 7, 9, 7, 'Check approved', 'dfsdf', 13, '2015-03-31 05:23:13'),
(37, 7, 7, 7, 'Bill paid', '', 14, '2015-03-31 05:23:39'),
(38, 8, 5, 5, 'Purchase initiated', 'fwdfw', 1, '2015-04-01 07:16:24'),
(39, 8, 5, 6, ' ', 'rfefewrfe', 5, '2015-04-01 07:17:08'),
(40, 8, 6, 7, ' ', 'cdcsdc', 5, '2015-04-01 07:20:40'),
(41, 8, 7, 7, ' ', '', 7, '2015-04-01 07:24:26'),
(42, 8, 7, 33, ' ', '', 8, '2015-04-01 07:24:44'),
(43, 8, 33, 5, ' ', '', 9, '2015-04-01 07:25:54'),
(44, 8, 5, 33, ' ', 'sdfsdf', 10, '2015-04-01 07:27:15'),
(45, 8, 33, 7, ' ', 'dfsadf', 10, '2015-04-01 07:30:01'),
(46, 6, 5, 33, ' ', 'dsfsdfsd', 5, '2015-04-15 05:34:12'),
(47, 6, 33, 7, ' ', 'fdsfsdf', 5, '2015-04-15 05:41:38'),
(48, 6, 7, 7, ' ', '', 7, '2015-04-15 05:45:06'),
(49, 6, 7, 33, ' ', '', 8, '2015-04-15 05:45:30'),
(50, 6, 33, 5, ' ', 'fdsfasd', 9, '2015-04-15 05:49:36'),
(51, 8, 5, 33, ' ', 'fsdfsd', 10, '2015-04-15 06:04:46'),
(52, 6, 5, 5, ' ', '', 10, '2015-04-15 06:11:18'),
(53, 8, 33, 7, ' ', 'dfsdf', 10, '2015-04-15 06:22:11'),
(54, 8, 7, 7, 'Check issued', '', 11, '2015-04-15 06:23:01'),
(55, 9, 5, 5, 'Purchase initiated', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 1, '2015-04-21 18:36:15'),
(56, 9, 5, 6, ' ', 'ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat', 5, '2015-04-22 03:43:34'),
(57, 9, 6, 7, ' ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation', 5, '2015-04-22 03:46:55'),
(58, 9, 7, 7, ' ', '', 7, '2015-04-22 03:51:43'),
(59, 9, 7, 33, ' ', 'psum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation', 8, '2015-04-22 03:53:36'),
(60, 9, 33, 5, ' ', 'fsdfas', 9, '2015-04-22 03:54:42'),
(61, 9, 5, 33, ' ', 'dfasdfdsa', 10, '2015-04-22 06:30:37'),
(62, 9, 33, 7, ' ', 'fsdfs', 10, '2015-04-22 06:35:47'),
(63, 10, 1, 1, 'Purchase initiated', 'fasfa', 1, '2015-05-17 05:57:19'),
(64, 11, 1, 1, 'Purchase initiated', 'dsfsldjf', 1, '2015-05-17 05:59:26'),
(65, 12, 1, 1, 'Purchase initiated', 'dfsdf', 1, '2015-05-17 07:41:50'),
(66, 13, 1, 1, 'Purchase initiated', 'fdfas', 1, '2015-05-17 08:41:43'),
(67, 14, 1, 1, 'Purchase initiated', 'fdfas', 1, '2015-05-17 08:43:41'),
(68, 15, 1, 1, 'Purchase initiated', 'fdfas', 1, '2015-05-17 08:44:25'),
(69, 16, 1, 1, 'Purchase initiated', 'dfsd', 1, '2015-05-17 09:06:52'),
(70, 16, 1, 33, ' ', 'fsdfsd', 5, '2015-05-17 14:21:30'),
(71, 16, 33, 6, 'verified', 'fsdfsdfsd', 18, '2015-05-17 18:50:54'),
(72, 17, 5, 5, 'Purchase initiated', 'sdfas', 1, '2015-05-18 15:44:46'),
(73, 17, 5, 6, ' ', 'dfsdfsd', 5, '2015-05-18 15:46:33'),
(74, 17, 6, 33, ' ', '', 5, '2015-05-18 15:50:20'),
(75, 17, 33, 7, ' ', 'dfsdf', 5, '2015-05-18 15:52:01'),
(76, 17, 7, 7, ' ', '', 7, '2015-05-18 15:53:39'),
(77, 17, 7, 33, ' ', '', 8, '2015-05-18 15:53:48'),
(78, 17, 33, 5, ' ', '', 9, '2015-05-18 15:54:04'),
(79, 18, 5, 5, 'Purchase initiated', 'sdfsdf', 1, '2015-05-19 06:25:38'),
(80, 18, 5, 6, ' ', 'dsfsdf', 5, '2015-05-19 06:52:19'),
(81, 18, 6, 33, ' ', 'fdsfdsf', 5, '2015-05-19 07:04:06'),
(82, 18, 33, 7, ' ', 'fgrsfs', 5, '2015-05-19 07:10:57'),
(83, 18, 7, 7, ' ', '', 7, '2015-05-19 07:13:17'),
(84, 19, 5, 5, 'Purchase initiated', 'dfdsf', 1, '2015-05-19 07:30:11'),
(85, 19, 5, 6, ' ', 'fvdgsdvd', 5, '2015-05-19 07:32:03');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_flow_attachment`
--

CREATE TABLE IF NOT EXISTS `purchase_flow_attachment` (
  `flow_id` int(11) NOT NULL,
  `file_name` varchar(200) NOT NULL,
  PRIMARY KEY (`flow_id`,`file_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_flow_attachment`
--

INSERT INTO `purchase_flow_attachment` (`flow_id`, `file_name`) VALUES
(17, 'Transcations.pdf'),
(18, 'Transcations1.pdf'),
(19, 'Transcations2.pdf'),
(20, 'payment_history.pdf'),
(21, 'Transcations3.pdf'),
(22, 'Transcations4.pdf'),
(39, 'PlayerLab-UI-Draft1.pdf'),
(40, '10979405_1069080296442530_1519666552_n.jpg'),
(44, '10979405_1069080296442530_1519666552_n1.jpg'),
(56, 'payment_history1.pdf'),
(73, 'flow2.jpg'),
(81, 'flow5.jpg'),
(82, 'flow6.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_flow_structure`
--

CREATE TABLE IF NOT EXISTS `purchase_flow_structure` (
  `id` tinyint(5) NOT NULL AUTO_INCREMENT,
  `step` tinyint(4) NOT NULL DEFAULT '1',
  `concerned_role` tinyint(4) NOT NULL,
  `can_approve` tinyint(4) NOT NULL,
  `can_verify` int(2) NOT NULL DEFAULT '0',
  `can_edit` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `purchase_flow_structure`
--

INSERT INTO `purchase_flow_structure` (`id`, `step`, `concerned_role`, `can_approve`, `can_verify`, `can_edit`) VALUES
(1, 1, 22, 0, 0, 0),
(2, 2, 21, 0, 0, 0),
(3, 4, 37, 0, 1, 1),
(4, 4, 38, 0, 1, 1),
(5, 5, 42, 0, 0, 0),
(6, 6, 43, 0, 0, 0),
(7, 7, 25, 0, 0, 0),
(8, 8, 26, 1, 0, 0),
(9, 9, 39, 1, 0, 0),
(10, 10, 40, 1, 0, 0),
(11, 11, 44, 1, 0, 0),
(12, 12, 26, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_item_info`
--

CREATE TABLE IF NOT EXISTS `purchase_item_info` (
  `id` tinyint(5) NOT NULL AUTO_INCREMENT,
  `purchase_id` int(5) NOT NULL,
  `item_type` int(5) NOT NULL,
  `item_cat` int(5) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `unit` int(10) NOT NULL,
  `unit-approved` int(11) NOT NULL,
  `unit_name` varchar(30) NOT NULL,
  `item_code` varchar(30) NOT NULL,
  `unit_price` float NOT NULL,
  `payment_method` varchar(30) NOT NULL,
  `unit-price-approved` float NOT NULL,
  `purpose` text NOT NULL,
  `total_existing_functional_quantity` int(10) NOT NULL,
  `total_existing_nonFunctional_quantity` int(10) NOT NULL,
  `date-purchase-non-functional` date NOT NULL,
  `date-last-purchase` date NOT NULL,
  `quantity-last-purchase` int(11) NOT NULL,
  `price-last-purchase` float NOT NULL,
  `date-purchase` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `certified_by` varchar(300) NOT NULL,
  `prev_item_storing_place` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `purchase_item_info`
--

INSERT INTO `purchase_item_info` (`id`, `purchase_id`, `item_type`, `item_cat`, `item_name`, `unit`, `unit-approved`, `unit_name`, `item_code`, `unit_price`, `payment_method`, `unit-price-approved`, `purpose`, `total_existing_functional_quantity`, `total_existing_nonFunctional_quantity`, `date-purchase-non-functional`, `date-last-purchase`, `quantity-last-purchase`, `price-last-purchase`, `date-purchase`, `certified_by`, `prev_item_storing_place`) VALUES
(1, 2, 1, 1, 'adsfsdf', 10, 0, 'aa', '', 10, '', 0, 'aaa', 11, 11, '1970-01-01', '1970-01-01', 22, 22, '2015-02-02 04:37:35', '', ''),
(2, 3, 1, 1, '12', 12, 0, 'aaa', '', 12, '', 0, 'aaa', 12, 12, '1970-01-01', '1970-01-01', 12, 12, '2015-02-02 13:20:12', '', ''),
(3, 4, 1, 1, 'aaa', 10, 0, 'aa', '', 10, '', 0, 'aa', 10, 10, '1970-01-01', '1970-01-01', 19, 19, '2015-02-02 13:35:19', '', ''),
(4, 5, 1, 1, 'aaa', 10, 0, 'aaa', '', 100, '', 0, 'aaa', 10, 10, '1970-01-01', '1970-01-01', 10, 10, '2015-02-02 14:02:26', '', ''),
(5, 6, 1, 1, 'aaa', 10, 0, 'aaa', '', 10, '', 0, 'aaa', 10, 10, '1970-01-01', '1970-01-01', 10, 10, '2015-02-06 02:49:59', '', ''),
(6, 6, 2, 1, 'bbb', 20, 0, 'ccc', '', 10, '', 0, 'bbb', 10, 10, '1970-01-01', '1970-01-01', 10, 10, '0000-00-00 00:00:00', 'aaaa', 'aaa'),
(7, 7, 1, 1, 'aaaa', 10, 0, 'ac', '', 10, '', 0, 'aaaa', 11, 11, '1970-01-01', '1970-01-01', 10, 10, '2015-03-24 11:04:54', '', ''),
(8, 8, 1, 1, 'defxe', 10, 0, 'df', '', 10, '', 0, 'drdede', 11, 11, '1970-01-01', '1970-01-01', 11, 11, '2015-04-01 07:16:25', '', ''),
(9, 8, 2, 1, 'fefr', 10, 0, 'edr', '', 10, '', 0, 'deded', 111, 11, '1970-01-01', '1970-01-01', 11, 11, '0000-00-00 00:00:00', 'wswsw', 'xwsxws'),
(10, 9, 1, 1, 'Lorem ipsum', 10, 0, 'dfs', '', 10, '', 0, '', 0, 0, '2015-04-21', '2015-04-21', 0, 0, '2015-04-21 18:36:15', '', ''),
(11, 10, 1, 1, 'C1431840888871', 10, 0, 'kg', '', 10, 'cash', 0, 'fdsf', 10, 10, '1970-01-01', '1970-01-01', 10, 10, '2015-05-17 05:57:20', '', ''),
(12, 11, 1, 1, '', 10, 0, 'kg', 'J1431842318515', 10, 'cheque', 0, 'dfsaf', 30, 30, '1970-01-01', '1970-01-01', 10, 10, '2015-05-17 05:59:26', '', ''),
(13, 12, 1, 1, '', 10, 0, 'kg', 'D1431848458241', 19, 'cheque', 0, 'dfsd', 10, 10, '1970-01-01', '1970-01-01', 20, 20, '2015-05-17 07:41:50', '', ''),
(14, 16, 2, 1, '', 10, 0, 'litter', 'K1431853494329', 30, 'cheque', 0, 'dfdsf', 20, 10, '1970-01-01', '1970-01-01', 20, 10, '2015-05-17 16:44:02', 'sdfsd', 'dfdsf'),
(15, 17, 1, 1, '0', 20, 0, 'kg', 'F1431963800189', 10, 'cheque', 0, 'dfsd', 10, 10, '1970-01-01', '1970-01-01', 10, 10, '2015-05-18 15:51:37', '', ''),
(16, 18, 1, 1, '0', 100, 0, '', 'Z1432016538759', 100, 'cheque', 0, 'dsfsd', 10, 10, '1970-01-01', '1970-01-01', 10, 100, '2015-05-19 06:25:38', '', ''),
(17, 19, 1, 3, 'Projector', 30000, 0, '', 'S1432020486476', 1, 'cheque', 0, 'dfsdf', 10, 10, '1970-01-01', '1970-01-01', 10, 10, '2015-05-19 07:30:11', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_management_status_log`
--

CREATE TABLE IF NOT EXISTS `purchase_management_status_log` (
  `id` tinyint(5) NOT NULL AUTO_INCREMENT,
  `purchase_id` tinyint(5) NOT NULL,
  `assigned_by` tinyint(5) NOT NULL,
  `assigned_to` tinyint(5) DEFAULT NULL,
  `role_id` tinyint(5) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(5) NOT NULL,
  `comments` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `quotation_details_id` tinyint(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_notifications`
--

CREATE TABLE IF NOT EXISTS `purchase_notifications` (
  `id` tinyint(5) NOT NULL AUTO_INCREMENT,
  `notification_for` tinyint(5) NOT NULL,
  `msg` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `log_id` tinyint(5) NOT NULL,
  `is_processed` tinyint(1) NOT NULL DEFAULT '0',
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_related_status`
--

CREATE TABLE IF NOT EXISTS `purchase_related_status` (
  `id` tinyint(5) NOT NULL AUTO_INCREMENT,
  `status` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `purchase_related_status`
--

INSERT INTO `purchase_related_status` (`id`, `status`) VALUES
(1, 'Initialized'),
(2, 'Rejected'),
(3, 'Completed'),
(4, 'Bill piad'),
(5, 'Forward'),
(6, 'Backward'),
(7, 'approved'),
(8, 'issue_work_order'),
(9, 'work_order_issued'),
(10, 'bill_forwarded'),
(11, 'check_issued'),
(12, 'check_singed_and_forwarded'),
(13, 'check_singed_and_approved'),
(14, 'bill_paid'),
(15, 'bill_rejected'),
(16, 'stock_entered'),
(17, 'stock_adjusted'),
(18, 'verified_and_forward');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_type`
--

CREATE TABLE IF NOT EXISTS `purchase_type` (
  `id` tinyint(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `purchase_type`
--

INSERT INTO `purchase_type` (`id`, `name`, `description`) VALUES
(1, 'New', ''),
(2, 'Replace', ''),
(3, 'Maintenance', '');

-- --------------------------------------------------------

--
-- Table structure for table `purchasing`
--

CREATE TABLE IF NOT EXISTS `purchasing` (
  `id` tinyint(5) NOT NULL AUTO_INCREMENT,
  `ds_id` tinyint(5) NOT NULL,
  `purchase_category` tinyint(5) NOT NULL,
  `item_category` tinyint(5) NOT NULL,
  `item_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `specification` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `justification` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `purchase_type` tinyint(5) NOT NULL,
  `total_quantity` int(11) NOT NULL,
  `unit_price` float NOT NULL,
  `estimated_cost` float NOT NULL,
  `quotation_details_id` tinyint(5) NOT NULL,
  `purchase_purpose` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` tinyint(5) NOT NULL,
  `prev_item_storing_place` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `certified_by` int(11) NOT NULL,
  `total_existing_functional_quantity` int(11) NOT NULL,
  `total_existing_nonFunctional_quantity` int(11) NOT NULL,
  `last_purchase_date` date NOT NULL,
  `last_purchase_quantity` int(11) NOT NULL,
  `last_purchase_unit_rate` float NOT NULL,
  `last_purchase_total_amount` float NOT NULL,
  `inspection_report_id` tinyint(5) NOT NULL,
  `payment_mode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `advance_amount` float NOT NULL,
  `advance_in_favour_of` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `required_advance_date` date NOT NULL,
  `advance_settle_date` date NOT NULL,
  `budget_head` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `provision_amount` float NOT NULL,
  `available_budget` float NOT NULL,
  `adjusted_budget_if_not` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `current_assisgned_id` tinyint(5) NOT NULL,
  `purchase_status` tinyint(5) NOT NULL,
  `bill_status` tinyint(1) NOT NULL,
  `stock_status` tinyint(4) NOT NULL,
  `remarks` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

--
-- Dumping data for table `purchasing`
--

INSERT INTO `purchasing` (`id`, `ds_id`, `purchase_category`, `item_category`, `item_name`, `specification`, `justification`, `purchase_type`, `total_quantity`, `unit_price`, `estimated_cost`, `quotation_details_id`, `purchase_purpose`, `created_date`, `created_by`, `prev_item_storing_place`, `certified_by`, `total_existing_functional_quantity`, `total_existing_nonFunctional_quantity`, `last_purchase_date`, `last_purchase_quantity`, `last_purchase_unit_rate`, `last_purchase_total_amount`, `inspection_report_id`, `payment_mode`, `advance_amount`, `advance_in_favour_of`, `required_advance_date`, `advance_settle_date`, `budget_head`, `provision_amount`, `available_budget`, `adjusted_budget_if_not`, `current_assisgned_id`, `purchase_status`, `bill_status`, `stock_status`, `remarks`) VALUES
(1, 1, 0, 0, '', 'aaa', 'aaa', 0, 0, 0, 0, 0, '', '2015-01-30 12:00:00', 0, '', 0, 0, 0, '0000-00-00', 0, 0, 0, 0, 'cheque', 111, 'aaa', '2015-01-31', '2015-01-31', '111', 111, 0, 'aaa', 0, 0, 0, 0, ''),
(2, 1, 0, 0, '', 'dfsdfs sfsd', 'ssdfsa', 0, 0, 0, 0, 0, '', '2015-02-02 11:38:11', 0, '', 0, 0, 0, '0000-00-00', 0, 0, 0, 0, 'cheque', 1111, 'aa', '2015-02-11', '2015-02-12', '53534', 5453, 0, 'sfsdf', 0, 2, 0, 0, ''),
(3, 1, 0, 0, '', 'fdsfsdf', 'fsdfsd', 0, 0, 0, 0, 0, '', '2015-03-24 13:03:30', 0, '', 0, 0, 0, '0000-00-00', 0, 0, 0, 0, 'cheque', 111, 'fsfsd', '2015-02-25', '2015-02-28', '111', 0, 0, 'dfsdf', 0, 3, 0, 0, ''),
(4, 1, 0, 0, '', 'fdsfsd', 'aaa', 0, 0, 0, 0, 0, '', '2015-03-24 13:03:30', 0, '', 0, 0, 0, '0000-00-00', 0, 0, 0, 0, 'cheque', 1111, 'aaa', '2015-02-24', '2015-02-12', '111', 111, 0, 'sfsf', 0, 3, 0, 0, ''),
(5, 1, 0, 0, '', 'aaa', 'aaa', 0, 0, 0, 0, 0, '', '2015-03-24 13:03:30', 0, '', 0, 0, 0, '0000-00-00', 0, 0, 0, 0, 'cheque', 111, 'aaa', '2015-02-04', '2015-02-13', '111', 111, 0, 'aaa', 0, 3, 0, 0, ''),
(6, 1, 0, 0, '', 'aaa', 'aaa', 0, 0, 0, 0, 0, '', '2015-04-15 06:11:18', 5, '', 0, 0, 0, '0000-00-00', 0, 0, 0, 0, 'cheque', 111, 'aaa', '2015-02-07', '2015-02-14', '111', 111, 0, 'aaa', 0, 9, 0, 16, ''),
(7, 1, 0, 0, '', 'dfdsfs', 'aaaa', 0, 0, 0, 0, 0, '', '2015-03-31 05:50:14', 5, '', 0, 0, 0, '0000-00-00', 0, 0, 0, 0, 'cheque', 111, 'aaa', '2015-03-11', '2015-03-28', '111', 111, 0, 'aaa', 0, 9, 14, 16, ''),
(8, 1, 0, 0, '', 'xqsdxqwsdw', 'fwdfw', 0, 0, 0, 0, 0, '', '2015-04-01 07:27:15', 5, '', 0, 0, 0, '0000-00-00', 0, 0, 0, 0, 'cheque', 111, 'fwfw', '2015-04-01', '2015-04-23', '111', 111, 0, 'fwdfw', 0, 9, 0, 16, ''),
(9, 1, 1, 0, '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 0, 0, 0, 0, 0, '', '2015-04-22 06:30:37', 5, '', 0, 0, 0, '0000-00-00', 0, 0, 0, 0, 'cheque', 122, 'lorem ipsum', '2015-04-09', '2015-04-09', 'Lorem ipsum', 12312, 0, 'Lorem ipsum', 0, 9, 0, 16, ''),
(10, 1, 0, 0, '', 'dsfa', 'fasfa', 0, 0, 0, 0, 0, '', '2015-05-16 18:00:00', 1, '', 0, 0, 0, '0000-00-00', 0, 0, 0, 0, '0', 111, 'fsdfa', '2015-05-19', '2015-05-20', '989', 8989, 0, 'dfsdf', 0, 0, 0, 0, ''),
(11, 1, 0, 0, '', 'dfsd', 'dsfsldjf', 0, 0, 0, 0, 0, '', '2015-05-16 18:00:00', 1, '', 0, 0, 0, '0000-00-00', 0, 0, 0, 0, '0', 111, 'sdfjsl', '2015-05-21', '2015-05-21', '999', 999, 0, 'fdsfs', 0, 0, 0, 0, ''),
(12, 1, 1, 0, '', 'dfsd', 'dfsdf', 0, 0, 0, 0, 0, '', '2015-05-16 18:00:00', 1, '', 0, 0, 0, '0000-00-00', 0, 0, 0, 0, '0', 111, '333', '2015-05-19', '2015-05-21', '888', 888, 0, 'fsdfs', 0, 0, 0, 0, ''),
(13, 1, 2, 0, '', '0', 'fdfas', 0, 0, 0, 0, 0, '', '2015-05-16 18:00:00', 1, '', 0, 0, 0, '0000-00-00', 0, 0, 0, 0, '0', 999, 'sdfasf', '2015-05-17', '2015-05-16', '999', 99, 0, 'fdsfs', 0, 0, 0, 0, '0'),
(14, 1, 2, 0, '', '0', 'fdfas', 0, 0, 0, 0, 0, '', '2015-05-16 18:00:00', 1, '', 0, 0, 0, '0000-00-00', 0, 0, 0, 0, '0', 999, 'sdfasf', '2015-05-17', '2015-05-16', '999', 99, 0, 'fdsfs', 0, 0, 0, 0, '0'),
(15, 1, 2, 0, '', '0', 'fdfas', 0, 0, 0, 0, 0, '', '2015-05-16 18:00:00', 1, '', 0, 0, 0, '0000-00-00', 0, 0, 0, 0, '0', 999, 'sdfasf', '2015-05-17', '2015-05-16', '999', 99, 0, 'fdsfs', 0, 0, 0, 0, '0'),
(16, 1, 4, 0, '', 'sfsaf', 'dfsd', 0, 0, 0, 0, 0, '', '2015-05-16 18:00:00', 1, '', 0, 0, 0, '0000-00-00', 0, 0, 0, 0, '0', 0, '0', '1970-01-01', '1970-01-01', '9999', 99, 0, 'fdsfsd', 0, 0, 0, 0, '0'),
(17, 1, 1, 0, '', 'dsfkksdl;k', 'sdfas', 0, 0, 0, 0, 0, '', '2015-05-18 15:54:04', 5, '', 0, 0, 0, '0000-00-00', 0, 0, 0, 0, '0', 888, '888', '2015-05-18', '2015-05-18', '888', 888, 0, 'dsfs', 0, 9, 0, 0, '0'),
(18, 1, 1, 0, '', 'dfsdf', 'sdfsdf', 0, 0, 0, 0, 0, '', '2015-05-19 07:13:17', 5, '', 0, 0, 0, '0000-00-00', 0, 0, 0, 0, '0', 2222, 'fds', '2015-05-20', '2015-05-28', '8888', 888, 0, 'fsdfsd', 0, 3, 0, 0, '0'),
(19, 1, 4, 0, '', 'fdsklfjs ', 'dfdsf', 0, 0, 0, 0, 0, '', '2015-05-18 18:00:00', 5, '', 0, 0, 0, '0000-00-00', 0, 0, 0, 0, '0', 0, '0', '1970-01-01', '1970-01-01', '1000', 1000, 0, 'fsdfsd', 0, 0, 0, 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `quotation_detail`
--

CREATE TABLE IF NOT EXISTS `quotation_detail` (
  `id` tinyint(5) NOT NULL AUTO_INCREMENT,
  `is_initial_attachment` tinyint(1) NOT NULL,
  `file_name` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `no_of_quotation` tinyint(10) NOT NULL,
  `comperetive_statement` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `quotation_justification` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `recommended_supplier` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `recommendation_committee`
--

CREATE TABLE IF NOT EXISTS `recommendation_committee` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `head` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `recommendation_committee`
--

INSERT INTO `recommendation_committee` (`id`, `name`, `head`) VALUES
(1, 'Architecture', 0),
(2, 'BBA', 0),
(3, 'Cse', 0),
(4, 'Pharmacy', 0);

-- --------------------------------------------------------

--
-- Table structure for table `recommendation_maintenance`
--

CREATE TABLE IF NOT EXISTS `recommendation_maintenance` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `recommendation_maintenance`
--

INSERT INTO `recommendation_maintenance` (`id`, `status`, `description`) VALUES
(1, 'Service', ''),
(2, 'Repair', ''),
(3, 'replace', '');

-- --------------------------------------------------------

--
-- Table structure for table `registration_request`
--

CREATE TABLE IF NOT EXISTS `registration_request` (
  `id` tinyint(5) NOT NULL AUTO_INCREMENT,
  `mail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` int(5) NOT NULL,
  `string` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `last_date` int(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_req` (`role`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

--
-- Dumping data for table `registration_request`
--

INSERT INTO `registration_request` (`id`, `mail`, `role`, `string`, `last_date`) VALUES
(25, 'test@abc.org', 1, '5v5svYjBCE', 1395415092),
(24, 'test@abc.org', 1, 'Zh60hRGuJb', 1395414844),
(23, 'orarish@gmail.com', 8, 'VMg9P1WAXC', 1391415854),
(22, 'najmus.sadat@uap-bd.edu', 1, 'yB7UDFkgrH', 1388470923),
(21, 'mybizz50@gmail.com', 1, 'TMJiit51gk', 1388313951),
(20, 'mybizz50@gmail.com', 2, 'l3PJTx8jm3', 1388269795);

-- --------------------------------------------------------

--
-- Table structure for table `replacement_committee`
--

CREATE TABLE IF NOT EXISTS `replacement_committee` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `head` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `replacement_committee`
--

INSERT INTO `replacement_committee` (`id`, `name`, `head`) VALUES
(1, 'Architecture', 0),
(2, 'BBA', 0),
(3, 'Cse', 0),
(4, 'Pharmacy', 0);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `role_for` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'department',
  `section_id` int(11) NOT NULL,
  `rank` int(11) NOT NULL DEFAULT '0',
  `user_mod_access` tinyint(1) NOT NULL DEFAULT '1',
  `purchase_mod_access` tinyint(1) NOT NULL DEFAULT '0',
  `stock_mod_access` tinyint(1) NOT NULL DEFAULT '0',
  `admin_mod_access` tinyint(1) NOT NULL DEFAULT '0',
  `read_only` tinyint(1) NOT NULL DEFAULT '0',
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `role_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=47 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`, `description`, `role_for`, `section_id`, `rank`, `user_mod_access`, `purchase_mod_access`, `stock_mod_access`, `admin_mod_access`, `read_only`, `modify_date`, `create_date`, `role_status`) VALUES
(1, 'Admin', 'Admin role', 'site', 0, 0, 1, 1, 1, 1, 0, '2014-06-10 10:22:37', '2013-12-18 17:00:38', 1),
(2, 'Master Admin', 'Master Admin. Not editable or deletalbe', 'site', 0, 0, 1, 1, 1, 1, 1, '2014-06-10 10:22:37', '2013-12-18 17:07:47', 1),
(27, 'Head in charge', 'Head of library', 'section', 10, 1, 1, 1, 1, 0, 0, '2014-06-07 11:26:29', '2014-06-07 05:26:29', 1),
(26, 'TREASURER', 'TREASURER', 'section', 9, 1, 1, 1, 1, 0, 0, '2014-06-07 11:25:22', '2014-06-07 05:25:22', 1),
(25, 'Director of Finance', 'Director of Finance', 'section', 9, 2, 1, 1, 1, 0, 0, '2014-06-07 11:24:41', '2014-06-07 05:24:23', 1),
(24, 'Sr. Finance & Accoun', 'Sr. Finance & Account Assitant', 'section', 9, 3, 1, 1, 1, 0, 0, '2014-06-07 11:23:33', '2014-06-07 05:23:33', 1),
(23, 'Finance & Account As', 'Finance & Account Assitant', 'section', 9, 4, 1, 1, 1, 0, 0, '2014-06-07 11:23:14', '2014-06-07 05:23:14', 1),
(22, 'DAO', 'Department Account Officer', 'department', 0, 2, 1, 1, 1, 0, 0, '2014-06-07 11:21:40', '2014-06-07 05:21:40', 1),
(21, 'Head', 'Head of department', 'department', 0, 1, 1, 1, 1, 0, 0, '2014-06-07 11:21:12', '2014-06-07 05:21:12', 1),
(28, 'Admission Officer', 'Head of admission section', 'section', 11, 1, 1, 1, 1, 0, 0, '2014-06-07 11:27:20', '2014-06-07 05:27:20', 1),
(29, 'Admin officer', 'Admin officer', 'section', 12, 3, 1, 1, 1, 0, 0, '2014-06-07 11:28:40', '2014-06-07 05:28:40', 1),
(30, 'Assistant Register', 'Assistant Register', 'section', 12, 2, 1, 1, 1, 0, 0, '2014-06-07 11:29:06', '2014-06-07 05:29:06', 1),
(31, 'Register', 'Register', 'section', 12, 1, 1, 1, 1, 0, 0, '2014-06-07 11:29:27', '2014-06-07 05:29:27', 1),
(32, 'Project Director', 'Project Director', 'section', 13, 1, 1, 1, 1, 0, 0, '2014-06-07 11:30:47', '2014-06-07 05:30:47', 1),
(33, 'Office assistant', 'Office assistant', 'section', 13, 2, 1, 1, 1, 0, 0, '2014-06-07 11:31:24', '2014-06-07 05:31:24', 1),
(34, 'Computer operator', 'Computer operator at controller of examination', 'section', 14, 3, 1, 1, 1, 0, 0, '2014-06-07 11:36:02', '2014-06-07 05:36:02', 1),
(35, 'Sr. Asst. Officer', 'Sr. Asst. Officer at controller of examination', 'section', 14, 2, 1, 1, 1, 0, 0, '2014-06-07 11:37:39', '2014-06-07 05:36:35', 1),
(36, 'Deputy Diector', 'Deputy Diector at controller of examination', 'section', 14, 1, 1, 1, 1, 0, 0, '2014-06-07 11:37:11', '2014-06-07 05:37:11', 1),
(37, 'Asst. Purchase Officer 1', 'Asst. Purchase Officer 1', 'section', 8, 1, 1, 1, 1, 0, 0, '2015-01-31 13:01:29', '2014-06-07 05:39:27', 1),
(38, 'Asst. Purchase Officer 2', 'Asst. Purchase Officer 2', 'section', 8, 2, 1, 1, 1, 0, 0, '2015-01-31 13:01:52', '2014-06-07 05:39:55', 1),
(39, 'Pro-vc', 'Pro vc', 'section', 16, 1, 1, 1, 1, 0, 0, '2014-06-07 11:42:00', '2014-06-07 05:42:00', 1),
(40, 'VC', 'VC', 'section', 17, 1, 1, 1, 1, 0, 0, '2014-06-07 11:42:28', '2014-06-07 05:42:28', 1),
(41, 'Head of replacement ', 'Head of replacement commitee', 'rec_com', 22, 1, 1, 1, 0, 0, 0, '2015-01-31 12:51:47', '2014-06-10 14:02:18', 1),
(42, 'Head of recommendation ', 'Head of recommendation commitee', 'rec_com', 23, 1, 1, 1, 0, 0, 0, '2015-01-31 12:52:19', '2015-01-30 18:06:08', 1),
(43, 'PS&C', 'PS&C', 'section', 8, 3, 1, 1, 1, 0, 0, '2015-01-31 00:17:36', '2015-01-30 18:17:36', 1),
(44, 'Head of PPC', 'Head of PPC', 'section', 19, 1, 1, 1, 1, 0, 0, '2015-01-31 00:21:27', '2015-01-30 18:21:27', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE IF NOT EXISTS `stock` (
  `id` tinyint(5) NOT NULL AUTO_INCREMENT,
  `purchase_id` tinyint(4) NOT NULL DEFAULT '0',
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `purchase_id`, `entry_date`) VALUES
(12, 9, '2015-04-22 06:30:37'),
(11, 6, '2015-04-15 06:11:18'),
(10, 8, '2015-04-15 06:04:47'),
(9, 8, '2015-04-01 07:27:15'),
(8, 7, '2015-03-31 05:22:13');

-- --------------------------------------------------------

--
-- Table structure for table `stock_category`
--

CREATE TABLE IF NOT EXISTS `stock_category` (
  `id` tinyint(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `stock_category_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `stock_category`
--

INSERT INTO `stock_category` (`id`, `name`, `description`, `stock_category_status`) VALUES
(1, 'AC', 'Air conditions for all departments', 1),
(2, 'CPU', 'CPU for PCs', 0),
(3, 'Test Cat', 'This is a test category', 1),
(4, 'stock cat', 'test', 1),
(5, 'test cats', 'this is a test cat', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stock_distribution`
--

CREATE TABLE IF NOT EXISTS `stock_distribution` (
  `id` tinyint(5) NOT NULL AUTO_INCREMENT,
  `stock_id` tinyint(5) NOT NULL,
  `purchase_id` tinyint(5) NOT NULL,
  `distributed_to` tinyint(5) NOT NULL,
  `distributed_quantity` tinyint(5) NOT NULL,
  `date_distributed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `auctionable_items` int(11) NOT NULL,
  `wasted_items` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `id` tinyint(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `address` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `supplier_status` tinyint(5) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `name`, `description`, `create_date`, `address`, `supplier_status`) VALUES
(1, 'Supplier_1', 'AC supplier', '2013-12-23 01:36:19', '4/A, Dhanmondi, Dhaka', 0),
(2, 'test supplier', 'test', '2014-05-03 01:16:20', 'tests', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL,
  `actual_role_id` int(11) NOT NULL,
  `account_status` int(11) NOT NULL,
  `registration_completed` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_role` (`role_id`),
  KEY `fk_actual_role` (`actual_role_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=35 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `password`, `role_id`, `actual_role_id`, `account_status`, `registration_completed`) VALUES
(1, 'user_1', '3f49044c1469c6990a665f46ec6c0a41', 1, 1, 1, 1),
(3, 'user_3', 'a6f601b7c855d45c6b5b182ab32a67c0', 2, 2, 0, 1),
(5, 'dao_cse', 'e10adc3949ba59abbe56e057f20f883e', 22, 22, 1, 1),
(6, 'hod_cse', 'e10adc3949ba59abbe56e057f20f883e', 21, 21, 1, 1),
(7, 'reg_1', 'e10adc3949ba59abbe56e057f20f883e', 26, 26, 1, 1),
(8, 'pvc_1', 'e10adc3949ba59abbe56e057f20f883e', 39, 39, 1, 1),
(9, 'vc_1', 'e10adc3949ba59abbe56e057f20f883e', 40, 40, 1, 1),
(10, 'tre_1', 'e10adc3949ba59abbe56e057f20f883e', 16, 16, 1, 1),
(11, 'dao_bba', '053057e56efb36f48ccae6ec11d9a6ad', 41, 22, 1, 1),
(12, 'hod_bba', 'd06b40d04f945d495bf312bfe78794d1', 7, 7, 1, 1),
(13, ' ', '123456', 4, 4, 1, 0),
(14, ' ', '123456', 4, 4, 1, 0),
(15, ' ', '123456', 1, 1, 1, 0),
(16, 'hello', '7d793037a0760186574b0282f2f435e7', 1, 1, 1, 1),
(17, ' ', '93279e3308bdbbeed946fc965017f67a', 1, 1, 1, 0),
(18, ' ', '93279e3308bdbbeed946fc965017f67a', 1, 1, 1, 0),
(19, ' ', '93279e3308bdbbeed946fc965017f67a', 1, 1, 1, 0),
(20, ' ', '93279e3308bdbbeed946fc965017f67a', 1, 1, 1, 0),
(21, ' ', '7c8445abd218772d53a48dae51de1940', 1, 1, 1, 0),
(22, 'user_2', '15e1576abc700ddfd9438e6ad1c86100', 42, 42, 1, 1),
(23, 'aaaa', '74b87337454200d4d33f80c4663dc5e5', 41, 41, 1, 1),
(24, 'aabb', '5e394281dfac81c1e7dddcaf4d35d1f6', 43, 43, 1, 1),
(25, 'aaaccc', '4b2332c3d211823914c3abf82c5e5087', 44, 44, 1, 1),
(26, ' ', '0285052f5d1f63bae70956abc86ed32e', 16, 16, 1, 0),
(27, 'test', '098f6bcd4621d373cade4e832627b4f6', 27, 27, 1, 1),
(28, 'dof', '53ba48f431fe964bb656a05ed16d8e87', 25, 25, 1, 1),
(29, 'sfa', 'dea3cdbe10c327ec87c6058f8b48cc7b', 24, 24, 1, 1),
(30, 'faa', 'ddbceb90786c0766eb638ec7d4376cf2', 23, 23, 1, 1),
(31, ' ', 'e8a45724913c074a90363a3b38c74824', 23, 23, 1, 0),
(33, 'apo1', 'e10adc3949ba59abbe56e057f20f883e', 37, 37, 1, 1),
(34, 'apo2', 'c7e39027aafac6d1e951f6411416931b', 38, 38, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE IF NOT EXISTS `user_profile` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `designation` int(11) NOT NULL DEFAULT '0',
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_password_change_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `email_address` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `contact_number` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `department` int(11) NOT NULL,
  `user_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=34 ;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `user_id`, `first_name`, `last_name`, `designation`, `modify_date`, `create_date`, `last_password_change_date`, `email_address`, `contact_number`, `department`, `user_deleted`) VALUES
(1, 1, 'Obaidur', 'Rahman', 1, '2013-12-22 05:38:48', '2013-12-19 15:39:43', '0000-00-00 00:00:00', 'mybizz50@gmail.com', '01686333153', 1, 0),
(6, 6, 'Alok', 'Kumar', 0, '2014-03-25 01:22:17', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'test@gmail.com', '2242221412', 1, 0),
(3, 3, 'Jhon', 'Smith', 1, '2013-12-22 05:58:41', '2013-12-22 11:58:41', '2013-12-22 11:58:41', 'jhon.smith@gmail.com', '21212121', 2, 0),
(5, 5, 'Faruk', 'Ahmed', 0, '2014-03-25 01:21:49', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'test@abc.com', '21212121', 1, 0),
(7, 7, 'Abdul ', 'Mazid ', 0, '2014-03-25 01:26:53', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'test@abc.com', '21212121', 0, 0),
(8, 8, 'M. R.', 'Kabir', 0, '2014-03-25 01:27:39', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'test@abcd.com', '2242221412', 0, 0),
(9, 9, 'Jamilur', 'Reza', 0, '2014-03-25 01:28:14', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'test@abc.com', '21212121', 0, 0),
(10, 10, 'fname', 'lname', 0, '2014-03-17 11:04:30', '2014-03-16 23:00:00', '2014-03-16 23:00:00', 'tre@uap-bd.com', '123123', 0, 0),
(11, 11, 'DAO', 'BBA', 0, '2014-03-25 01:21:49', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'test@abc.com', '21212121', 3, 0),
(12, 12, 'Head', 'BBA', 0, '2014-04-29 07:56:45', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'test@gmail.com', '2242221412', 3, 0),
(13, 14, ' ', ' ', 0, '2014-05-02 11:35:23', '2014-05-02 05:35:23', '2014-05-02 05:35:23', '', ' ', 0, 0),
(14, 15, ' ', ' ', 0, '2014-05-02 14:15:13', '2014-05-02 08:15:13', '2014-05-02 08:15:13', '', ' ', 0, 0),
(15, 16, 'Test', 'Test', 0, '2014-05-02 14:50:06', '2014-05-02 08:19:10', '2014-05-02 08:50:06', 'test@aebcd.com', '123123', 2, 0),
(16, 17, ' ', ' ', 0, '2014-05-02 23:50:24', '2014-05-02 17:50:24', '2014-05-02 17:50:24', 'hello@world.com', ' ', 0, 0),
(17, 18, ' ', ' ', 0, '2014-05-02 23:56:16', '2014-05-02 17:56:16', '2014-05-02 17:56:16', 'test@testest.com', ' ', 0, 0),
(18, 19, ' ', ' ', 0, '2014-05-02 23:56:44', '2014-05-02 17:56:44', '2014-05-02 17:56:44', 'test@testes.com', ' ', 0, 0),
(19, 20, ' ', ' ', 0, '2014-05-03 01:45:44', '2014-05-02 19:45:44', '2014-05-02 19:45:44', 'test@user.com', ' ', 0, 0),
(20, 21, ' ', ' ', 0, '2014-05-03 09:05:06', '2014-05-03 03:05:06', '2014-05-03 03:05:06', 'mymy@mymy.com', ' ', 0, 0),
(21, 22, 'Obaidur', 'Rahman', 0, '2015-01-31 12:59:54', '2014-05-03 03:05:34', '2014-05-03 03:06:26', 'mm@mmm.com', '8989898', 23, 0),
(22, 23, 'aaa', 'bbb', 0, '2015-01-31 12:57:59', '2014-05-03 09:37:58', '2014-05-03 09:38:59', 'aaa@aaa.com', '111222', 22, 0),
(23, 24, 'aa', 'bb', 0, '2015-01-31 12:55:43', '2014-05-03 17:26:14', '2014-05-03 17:27:45', 'aa@aa.com', '1111', 8, 0),
(24, 25, 'Obaidur', 'Rahman', 0, '2015-01-31 13:37:25', '2014-05-03 20:36:33', '2014-05-03 20:38:45', 'aaa@ccc.com', '123123', 19, 0),
(25, 26, ' ', ' ', 0, '2014-06-01 00:14:05', '2014-05-31 18:14:05', '2014-05-31 18:14:05', 'test@abcde.com', ' ', 0, 0),
(26, 27, 'a', 'b', 0, '2014-06-10 20:49:30', '2014-06-10 14:48:12', '2014-06-10 14:49:30', 'test1@abc.com', '123123', 10, 0),
(27, 28, 'a', 'b', 0, '2014-06-10 20:51:36', '2014-06-10 14:50:27', '2014-06-10 14:51:36', 'test2@abc.com', '123123', 2, 0),
(28, 29, 'a', 'b', 0, '2014-06-10 20:54:02', '2014-06-10 14:52:36', '2014-06-10 14:54:02', 'test3@abc.com', '123123', 9, 0),
(29, 30, 'a', 'b', 0, '2014-06-10 20:55:15', '2014-06-10 14:54:29', '2014-06-10 14:55:15', 'test4@abc.com', '123123', 9, 0),
(30, 31, ' ', ' ', 0, '2014-06-10 20:55:40', '2014-06-10 14:55:40', '2014-06-10 14:55:40', 'test5@abc.com', ' ', 0, 0),
(31, 32, ' ', ' ', 0, '2014-06-10 20:57:00', '2014-06-10 14:57:00', '2014-06-10 14:57:00', 'test6@abc.com', ' ', 0, 0),
(32, 33, 'Riazul', 'Hoque', 0, '2015-04-22 03:58:52', '2014-06-10 14:57:55', '2014-06-10 15:00:04', 'test7@abc.com', '1212', 8, 0),
(33, 34, 'a', 'b', 0, '2014-06-10 21:01:59', '2014-06-10 15:01:10', '2014-06-10 15:01:59', 'test8@abc.com', '123123', 8, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
