-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 26, 2024 at 07:02 PM
-- Server version: 5.7.44-cll-lve
-- PHP Version: 8.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codelive_kerp`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `id` int(22) NOT NULL,
  `date` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `user_id` int(22) DEFAULT NULL,
  `goal_id` int(22) DEFAULT NULL,
  `competencies_id` int(22) DEFAULT NULL,
  `responsibilities_id` int(22) DEFAULT NULL,
  `developments_id` int(22) DEFAULT NULL,
  `is_admin` int(22) DEFAULT '0',
  `time` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id`, `date`, `title`, `user_id`, `goal_id`, `competencies_id`, `responsibilities_id`, `developments_id`, `is_admin`, `time`, `created_at`, `updated_at`) VALUES
(1, '2024-06-27', 'update this entry', 1, NULL, NULL, 8, NULL, 0, '1719492480', '2024-06-27 12:52:27', '2024-06-27 12:53:35'),
(2, '2024-06-27', 'update this entry', 1, NULL, NULL, 8, NULL, 0, NULL, '2024-06-27 12:53:53', '2024-06-27 12:53:53'),
(3, '2024-06-27', 'update this entry', 1, NULL, NULL, 8, NULL, 0, NULL, '2024-06-27 12:54:10', '2024-06-27 12:54:10'),
(4, '2024-06-27', 'update this entry', 1, NULL, NULL, 8, NULL, 0, '1719492480', '2024-06-27 12:55:57', '2024-06-27 12:56:00'),
(5, '2024-06-27', 'update this entry', 1, NULL, NULL, 8, NULL, 0, NULL, '2024-06-27 12:57:26', '2024-06-27 12:57:26'),
(6, '2024-06-27', 'created this entry', 1, NULL, NULL, NULL, 10, 0, NULL, '2024-06-27 13:17:29', '2024-06-27 13:17:29'),
(7, '2024-06-27', 'update this entry', 1, NULL, NULL, NULL, 10, 0, '1719494238', '2024-06-27 13:18:41', '2024-06-27 13:18:44'),
(8, '2024-06-27', 'update this entry', 1, NULL, NULL, 7, NULL, 1, NULL, '2024-06-27 13:45:00', '2024-06-27 13:45:00'),
(9, '2024-06-27', 'update this entry', 1, NULL, 2, NULL, NULL, 1, NULL, '2024-06-27 13:45:24', '2024-06-27 13:45:24'),
(10, '2024-06-27', 'created this entry', 18, NULL, 3, NULL, NULL, 0, NULL, '2024-06-27 13:46:47', '2024-06-27 13:46:47'),
(11, '2024-06-27', 'update this entry', 18, NULL, 3, NULL, NULL, 0, '1719496000', '2024-06-27 13:47:03', '2024-06-27 13:47:04'),
(12, '2024-07-05', 'update this entry', 16, NULL, NULL, NULL, NULL, 0, '1720163021', '2024-07-05 07:05:30', '2024-07-05 07:05:30'),
(13, '2024-07-05', 'update this entry', 16, NULL, NULL, NULL, NULL, 0, '1720163021', '2024-07-05 07:06:04', '2024-07-05 07:06:04'),
(14, '2024-07-05', 'update this entry', 16, NULL, NULL, NULL, NULL, 0, NULL, '2024-07-05 07:06:15', '2024-07-05 07:06:15'),
(15, '2024-07-05', 'update this entry', 16, NULL, NULL, NULL, NULL, 0, '1720163238', '2024-07-05 07:09:00', '2024-07-05 07:09:00'),
(16, '2024-07-05', 'update this entry', 16, NULL, NULL, NULL, NULL, 0, '1720163238', '2024-07-05 07:09:20', '2024-07-05 07:09:20'),
(17, '2024-07-05', 'update this entry', 16, NULL, NULL, NULL, NULL, 0, '1720163238', '2024-07-05 07:09:46', '2024-07-05 07:09:46'),
(18, '2024-07-05', 'update this entry', 16, NULL, NULL, NULL, NULL, 0, NULL, '2024-07-05 07:10:10', '2024-07-05 07:10:10'),
(19, '2024-07-05', 'created this entry', 16, NULL, 4, NULL, NULL, 0, NULL, '2024-07-05 09:38:25', '2024-07-05 09:38:25'),
(20, '2024-07-05', 'update this entry', 16, NULL, 4, NULL, NULL, 0, '1720172300', '2024-07-05 09:38:40', '2024-07-05 09:38:42'),
(21, '2024-07-05', 'update this entry', 16, 1, NULL, NULL, NULL, 0, '1720172576', '2024-07-05 09:43:15', '2024-07-05 10:15:16'),
(22, '2024-07-05', 'created this entry', 16, 1, NULL, NULL, NULL, 0, NULL, '2024-07-05 10:15:16', '2024-07-05 10:15:16'),
(23, '2024-07-10', 'update this entry', 16, 2, NULL, NULL, NULL, 0, '1720629996', '2024-07-10 16:49:50', '2024-07-10 16:54:07'),
(24, '2024-07-10', 'update this entry', 16, 2, NULL, NULL, NULL, 0, '1720629996', '2024-07-10 16:50:40', '2024-07-10 16:54:07'),
(25, '2024-07-10', 'update this entry', 16, 2, NULL, NULL, NULL, 0, '1720629996', '2024-07-10 16:51:59', '2024-07-10 16:54:07'),
(26, '2024-07-10', 'update this entry', 16, NULL, NULL, NULL, NULL, 0, NULL, '2024-07-10 16:52:53', '2024-07-10 16:52:53'),
(27, '2024-07-10', 'update this entry', 16, NULL, NULL, NULL, NULL, 0, NULL, '2024-07-10 16:53:20', '2024-07-10 16:53:20'),
(28, '2024-07-10', 'created this entry', 16, 2, NULL, NULL, NULL, 0, NULL, '2024-07-10 16:54:06', '2024-07-10 16:54:06'),
(29, '2024-07-22', 'update this entry', 3, 3, NULL, NULL, NULL, 0, '1721629870', '2024-07-22 06:31:37', '2024-07-22 06:32:00'),
(30, '2024-07-22', 'update this entry', 3, 3, NULL, NULL, NULL, 0, '1721629870', '2024-07-22 06:31:57', '2024-07-22 06:32:00'),
(31, '2024-07-22', 'created this entry', 3, 3, NULL, NULL, NULL, 0, NULL, '2024-07-22 06:32:00', '2024-07-22 06:32:00'),
(32, '2024-07-22', 'update this entry', 3, NULL, 5, NULL, NULL, 0, '1721629928', '2024-07-22 06:32:21', '2024-07-22 06:32:28'),
(33, '2024-07-22', 'update this entry', 3, NULL, NULL, NULL, NULL, 0, NULL, '2024-07-22 06:32:26', '2024-07-22 06:32:26'),
(34, '2024-07-22', 'created this entry', 3, NULL, 5, NULL, NULL, 0, NULL, '2024-07-22 06:32:28', '2024-07-22 06:32:28'),
(35, '2024-07-26', 'update this entry', 16, 2, NULL, NULL, NULL, 0, NULL, '2024-07-26 11:15:46', '2024-07-26 11:15:46'),
(36, '2024-07-26', 'update this entry', 16, 2, NULL, NULL, NULL, 0, NULL, '2024-07-26 11:16:07', '2024-07-26 11:16:07'),
(37, '2024-07-26', 'update this entry', 16, 2, NULL, NULL, NULL, 0, NULL, '2024-07-26 11:16:26', '2024-07-26 11:16:26'),
(38, '2024-07-26', 'update this entry', 16, 2, NULL, NULL, NULL, 0, NULL, '2024-07-26 11:16:34', '2024-07-26 11:16:34'),
(39, '2024-07-26', 'update this entry', 16, 4, NULL, NULL, NULL, 0, '1721992605', '2024-07-26 11:17:15', '2024-07-26 11:17:17'),
(40, '2024-07-26', 'created this entry', 16, 4, NULL, NULL, NULL, 0, NULL, '2024-07-26 11:17:17', '2024-07-26 11:17:17'),
(41, '2024-07-26', 'update this entry', 16, 2, NULL, NULL, NULL, 0, '1720629996', '2024-07-26 11:18:15', '2024-07-26 11:18:17'),
(42, '2024-07-26', 'update this entry', 16, 2, NULL, NULL, NULL, 0, '1720629996', '2024-07-26 11:19:12', '2024-07-26 11:19:14'),
(43, '2024-07-26', 'update this entry', 16, 5, NULL, NULL, NULL, 0, '1721992759', '2024-07-26 11:19:37', '2024-07-26 11:19:48'),
(44, '2024-07-26', 'update this entry', 16, 5, NULL, NULL, NULL, 0, '1721992759', '2024-07-26 11:19:47', '2024-07-26 11:19:48'),
(45, '2024-07-26', 'created this entry', 16, 5, NULL, NULL, NULL, 0, NULL, '2024-07-26 11:19:48', '2024-07-26 11:19:48'),
(46, '2024-07-26', 'update this entry', 1, 6, NULL, NULL, NULL, 0, '1721998653', '2024-07-26 12:58:09', '2024-07-26 12:58:13'),
(47, '2024-07-26', 'created this entry', 1, 6, NULL, NULL, NULL, 0, NULL, '2024-07-26 12:58:13', '2024-07-26 12:58:13'),
(48, '2024-07-26', 'created this entry', 1, 7, NULL, NULL, NULL, 0, NULL, '2024-07-26 13:00:09', '2024-07-26 13:00:09'),
(49, '2024-07-26', 'update this entry', 1, 7, NULL, NULL, NULL, 0, '1721998790', '2024-07-26 13:00:40', '2024-07-26 13:00:44'),
(50, '2024-07-26', 'update this entry', 1, 8, NULL, NULL, NULL, 0, '1721998873', '2024-07-26 13:02:03', '2024-07-26 13:02:06'),
(51, '2024-07-26', 'created this entry', 1, 8, NULL, NULL, NULL, 0, NULL, '2024-07-26 13:02:06', '2024-07-26 13:02:06');

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` int(22) NOT NULL,
  `data_key` varchar(255) DEFAULT NULL,
  `data_value` varchar(255) DEFAULT NULL,
  `old_vaue` varchar(255) DEFAULT NULL,
  `activiy_id` int(22) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `data_key`, `data_value`, `old_vaue`, `activiy_id`, `created_at`, `updated_at`) VALUES
(1, 'Key Result', 'test', NULL, 1, '2024-06-27 12:52:27', '2024-06-27 12:52:27'),
(2, 'Tracking', 'Milestone', NULL, 1, '2024-06-27 12:52:27', '2024-06-27 12:52:27'),
(3, 'Traking', 'Pending', NULL, 1, '2024-06-27 12:52:27', '2024-06-27 12:52:27'),
(4, 'Key result', 'test', 'Pending', 2, '2024-06-27 12:53:53', '2024-06-27 12:53:53'),
(5, 'Traking', 'Completed', 'Pending', 2, '2024-06-27 12:53:53', '2024-06-27 12:53:53'),
(6, 'Title', 'test-rest', 'test', 3, '2024-06-27 12:54:10', '2024-06-27 12:54:10'),
(7, 'Key Result', 'test', NULL, 4, '2024-06-27 12:55:57', '2024-06-27 12:55:57'),
(8, 'Tracking', 'Quantiflable traget', NULL, 4, '2024-06-27 12:55:57', '2024-06-27 12:55:57'),
(9, 'Start', '0', NULL, 4, '2024-06-27 12:55:57', '2024-06-27 12:55:57'),
(10, 'Target', '20', NULL, 4, '2024-06-27 12:55:57', '2024-06-27 12:55:57'),
(11, 'Current', '1', NULL, 4, '2024-06-27 12:55:57', '2024-06-27 12:55:57'),
(12, 'Status', 'Archived', 'Active', 5, '2024-06-27 12:57:26', '2024-06-27 12:57:26'),
(13, 'Owner', 'Chetan Bairagi', NULL, 6, '2024-06-27 13:17:29', '2024-06-27 13:17:29'),
(14, 'Title', 'test-user', NULL, 6, '2024-06-27 13:17:30', '2024-06-27 13:17:30'),
(15, 'Status', 'Active', NULL, 6, '2024-06-27 13:17:30', '2024-06-27 13:17:30'),
(16, 'Key Result', 'test-user', NULL, 7, '2024-06-27 13:18:41', '2024-06-27 13:18:41'),
(17, 'Tracking', 'Milestone', NULL, 7, '2024-06-27 13:18:41', '2024-06-27 13:18:41'),
(18, 'Traking', 'Pending', NULL, 7, '2024-06-27 13:18:41', '2024-06-27 13:18:41'),
(19, 'Title', 'test', 'asdf', 8, '2024-06-27 13:45:00', '2024-06-27 13:45:00'),
(20, 'Key result', '258', '20', 9, '2024-06-27 13:45:24', '2024-06-27 13:45:24'),
(21, 'Current', '90', '20', 9, '2024-06-27 13:45:24', '2024-06-27 13:45:24'),
(22, 'Owner', 'test3105', NULL, 10, '2024-06-27 13:46:47', '2024-06-27 13:46:47'),
(23, 'Title', 'test', NULL, 10, '2024-06-27 13:46:47', '2024-06-27 13:46:47'),
(24, 'Status', 'Active', NULL, 10, '2024-06-27 13:46:47', '2024-06-27 13:46:47'),
(25, 'Key Result', 'test', NULL, 11, '2024-06-27 13:47:03', '2024-06-27 13:47:03'),
(26, 'Tracking', 'Milestone', NULL, 11, '2024-06-27 13:47:03', '2024-06-27 13:47:03'),
(27, 'Traking', 'Pending', NULL, 11, '2024-06-27 13:47:03', '2024-06-27 13:47:03'),
(28, 'Key Result', 'sell 3 books', NULL, 12, '2024-07-05 07:05:30', '2024-07-05 07:05:30'),
(29, 'Tracking', 'Milestone', NULL, 12, '2024-07-05 07:05:30', '2024-07-05 07:05:30'),
(30, 'Traking', 'Pending', NULL, 12, '2024-07-05 07:05:30', '2024-07-05 07:05:30'),
(31, 'Key Result', 'sell 5 books', NULL, 13, '2024-07-05 07:06:04', '2024-07-05 07:06:04'),
(32, 'Tracking', 'Milestone', NULL, 13, '2024-07-05 07:06:04', '2024-07-05 07:06:04'),
(33, 'Traking', 'Pending', NULL, 13, '2024-07-05 07:06:04', '2024-07-05 07:06:04'),
(34, 'Key result', 'sell 3 books', 'Pending', 14, '2024-07-05 07:06:15', '2024-07-05 07:06:15'),
(35, 'Traking', 'Completed', 'Pending', 14, '2024-07-05 07:06:15', '2024-07-05 07:06:15'),
(36, 'Key Result', 'sell 20 book in july', NULL, 15, '2024-07-05 07:09:00', '2024-07-05 07:09:00'),
(37, 'Tracking', 'Milestone', NULL, 15, '2024-07-05 07:09:00', '2024-07-05 07:09:00'),
(38, 'Traking', 'Pending', NULL, 15, '2024-07-05 07:09:00', '2024-07-05 07:09:00'),
(39, 'Key Result', 'sell 20 books in august', NULL, 16, '2024-07-05 07:09:20', '2024-07-05 07:09:20'),
(40, 'Tracking', 'Milestone', NULL, 16, '2024-07-05 07:09:20', '2024-07-05 07:09:20'),
(41, 'Traking', 'Pending', NULL, 16, '2024-07-05 07:09:20', '2024-07-05 07:09:20'),
(42, 'Key Result', 'sell 10 books in september', NULL, 17, '2024-07-05 07:09:46', '2024-07-05 07:09:46'),
(43, 'Tracking', 'Milestone', NULL, 17, '2024-07-05 07:09:46', '2024-07-05 07:09:46'),
(44, 'Traking', 'Pending', NULL, 17, '2024-07-05 07:09:46', '2024-07-05 07:09:46'),
(45, 'Key result', 'sell 20 book in july', 'Pending', 18, '2024-07-05 07:10:10', '2024-07-05 07:10:10'),
(46, 'Traking', 'Completed', 'Pending', 18, '2024-07-05 07:10:10', '2024-07-05 07:10:10'),
(47, 'Owner', 'Elton', NULL, 19, '2024-07-05 09:38:25', '2024-07-05 09:38:25'),
(48, 'Title', 'test', NULL, 19, '2024-07-05 09:38:25', '2024-07-05 09:38:25'),
(49, 'Status', 'Active', NULL, 19, '2024-07-05 09:38:25', '2024-07-05 09:38:25'),
(50, 'Key Result', 'test', NULL, 20, '2024-07-05 09:38:40', '2024-07-05 09:38:40'),
(51, 'Tracking', 'Milestone', NULL, 20, '2024-07-05 09:38:40', '2024-07-05 09:38:40'),
(52, 'Traking', 'Pending', NULL, 20, '2024-07-05 09:38:40', '2024-07-05 09:38:40'),
(53, 'Key Result', 'test', NULL, 21, '2024-07-05 09:43:15', '2024-07-05 09:43:15'),
(54, 'Tracking', 'Milestone', NULL, 21, '2024-07-05 09:43:15', '2024-07-05 09:43:15'),
(55, 'Traking', 'Pending', NULL, 21, '2024-07-05 09:43:15', '2024-07-05 09:43:15'),
(56, 'Owner', 'Elton', NULL, 22, '2024-07-05 10:15:16', '2024-07-05 10:15:16'),
(57, 'Title', 'test', NULL, 22, '2024-07-05 10:15:16', '2024-07-05 10:15:16'),
(58, 'Goal Category', 'test2', NULL, 22, '2024-07-05 10:15:16', '2024-07-05 10:15:16'),
(59, 'Status', 'test', NULL, 22, '2024-07-05 10:15:16', '2024-07-05 10:15:16'),
(60, 'Category', 'category', NULL, 22, '2024-07-05 10:15:16', '2024-07-05 10:15:16'),
(61, 'Key Result', 'sell 10 books in july', NULL, 23, '2024-07-10 16:49:50', '2024-07-10 16:49:50'),
(62, 'Tracking', 'Quantiflable traget', NULL, 23, '2024-07-10 16:49:50', '2024-07-10 16:49:50'),
(63, 'Start', '0', NULL, 23, '2024-07-10 16:49:50', '2024-07-10 16:49:50'),
(64, 'Target', '10', NULL, 23, '2024-07-10 16:49:50', '2024-07-10 16:49:50'),
(65, 'Current', '5', NULL, 23, '2024-07-10 16:49:50', '2024-07-10 16:49:50'),
(66, 'Key Result', 'sell 10 books august', NULL, 24, '2024-07-10 16:50:40', '2024-07-10 16:50:40'),
(67, 'Tracking', 'Quantiflable traget', NULL, 24, '2024-07-10 16:50:40', '2024-07-10 16:50:40'),
(68, 'Start', '0', NULL, 24, '2024-07-10 16:50:40', '2024-07-10 16:50:40'),
(69, 'Target', '10', NULL, 24, '2024-07-10 16:50:40', '2024-07-10 16:50:40'),
(70, 'Current', '3', NULL, 24, '2024-07-10 16:50:40', '2024-07-10 16:50:40'),
(71, 'Key Result', 'sell 10 book in sep', NULL, 25, '2024-07-10 16:51:59', '2024-07-10 16:51:59'),
(72, 'Tracking', 'Quantiflable traget', NULL, 25, '2024-07-10 16:51:59', '2024-07-10 16:51:59'),
(73, 'Start', '0', NULL, 25, '2024-07-10 16:51:59', '2024-07-10 16:51:59'),
(74, 'Target', '10', NULL, 25, '2024-07-10 16:51:59', '2024-07-10 16:51:59'),
(75, 'Current', '6', NULL, 25, '2024-07-10 16:51:59', '2024-07-10 16:51:59'),
(76, 'Key result', 'sell 10 books august', '10', 26, '2024-07-10 16:52:53', '2024-07-10 16:52:53'),
(77, 'Target', '20', '10', 26, '2024-07-10 16:52:53', '2024-07-10 16:52:53'),
(78, 'Key result', 'sell 10 book in sep', '10', 27, '2024-07-10 16:53:20', '2024-07-10 16:53:20'),
(79, 'Target', '5', '10', 27, '2024-07-10 16:53:20', '2024-07-10 16:53:20'),
(80, 'Key result', 'sell 10 book in sep', '6', 27, '2024-07-10 16:53:20', '2024-07-10 16:53:20'),
(81, 'Current', '2', '6', 27, '2024-07-10 16:53:20', '2024-07-10 16:53:20'),
(82, 'Owner', 'Elton', NULL, 28, '2024-07-10 16:54:06', '2024-07-10 16:54:06'),
(83, 'Title', 'sell 30 book by september', NULL, 28, '2024-07-10 16:54:06', '2024-07-10 16:54:06'),
(84, 'Goal Category', '3rd quarter 2024', NULL, 28, '2024-07-10 16:54:06', '2024-07-10 16:54:06'),
(85, 'Status', 'test', NULL, 28, '2024-07-10 16:54:06', '2024-07-10 16:54:06'),
(86, 'Category', 'category', NULL, 28, '2024-07-10 16:54:06', '2024-07-10 16:54:06'),
(87, 'Key Result', 'test', NULL, 29, '2024-07-22 06:31:37', '2024-07-22 06:31:37'),
(88, 'Tracking', 'Milestone', NULL, 29, '2024-07-22 06:31:37', '2024-07-22 06:31:37'),
(89, 'Traking', 'Pending', NULL, 29, '2024-07-22 06:31:37', '2024-07-22 06:31:37'),
(90, 'Key Result', 'test2', NULL, 30, '2024-07-22 06:31:57', '2024-07-22 06:31:57'),
(91, 'Tracking', 'Quantiflable traget', NULL, 30, '2024-07-22 06:31:57', '2024-07-22 06:31:57'),
(92, 'Start', '0', NULL, 30, '2024-07-22 06:31:57', '2024-07-22 06:31:57'),
(93, 'Target', '100', NULL, 30, '2024-07-22 06:31:57', '2024-07-22 06:31:57'),
(94, 'Current', '20', NULL, 30, '2024-07-22 06:31:57', '2024-07-22 06:31:57'),
(95, 'Owner', 'Rahul Parmar', NULL, 31, '2024-07-22 06:32:00', '2024-07-22 06:32:00'),
(96, 'Title', 'test', NULL, 31, '2024-07-22 06:32:00', '2024-07-22 06:32:00'),
(97, 'Goal Category', 'test2', NULL, 31, '2024-07-22 06:32:00', '2024-07-22 06:32:00'),
(98, 'Status', 'test', NULL, 31, '2024-07-22 06:32:00', '2024-07-22 06:32:00'),
(99, 'Category', 'category', NULL, 31, '2024-07-22 06:32:00', '2024-07-22 06:32:00'),
(100, 'Key Result', 'test', NULL, 32, '2024-07-22 06:32:21', '2024-07-22 06:32:21'),
(101, 'Tracking', 'Milestone', NULL, 32, '2024-07-22 06:32:21', '2024-07-22 06:32:21'),
(102, 'Traking', 'Pending', NULL, 32, '2024-07-22 06:32:21', '2024-07-22 06:32:21'),
(103, 'Key result', 'test', 'Pending', 33, '2024-07-22 06:32:26', '2024-07-22 06:32:26'),
(104, 'Traking', 'Completed', 'Pending', 33, '2024-07-22 06:32:26', '2024-07-22 06:32:26'),
(105, 'Owner', 'Rahul Parmar', NULL, 34, '2024-07-22 06:32:28', '2024-07-22 06:32:28'),
(106, 'Title', 'test', NULL, 34, '2024-07-22 06:32:28', '2024-07-22 06:32:28'),
(107, 'Status', 'Active', NULL, 34, '2024-07-22 06:32:28', '2024-07-22 06:32:28'),
(108, 'Key Result', 'sell 10 books in july', NULL, 35, '2024-07-26 11:15:46', '2024-07-26 11:15:46'),
(109, 'Tracking', 'Quantifiable traget', NULL, 35, '2024-07-26 11:15:46', '2024-07-26 11:15:46'),
(110, 'Start', '0', NULL, 35, '2024-07-26 11:15:46', '2024-07-26 11:15:46'),
(111, 'Target', '200', NULL, 35, '2024-07-26 11:15:46', '2024-07-26 11:15:46'),
(112, 'Current', '150', NULL, 35, '2024-07-26 11:15:46', '2024-07-26 11:15:46'),
(113, 'Key Result', 'sell 10 books august', NULL, 36, '2024-07-26 11:16:07', '2024-07-26 11:16:07'),
(114, 'Tracking', 'Quantifiable traget', NULL, 36, '2024-07-26 11:16:07', '2024-07-26 11:16:07'),
(115, 'Start', '0', NULL, 36, '2024-07-26 11:16:07', '2024-07-26 11:16:07'),
(116, 'Target', '60', NULL, 36, '2024-07-26 11:16:07', '2024-07-26 11:16:07'),
(117, 'Current', '30', NULL, 36, '2024-07-26 11:16:07', '2024-07-26 11:16:07'),
(118, 'Key Result', 'sell 10 book in sep', NULL, 37, '2024-07-26 11:16:26', '2024-07-26 11:16:26'),
(119, 'Tracking', 'Quantifiable traget', NULL, 37, '2024-07-26 11:16:26', '2024-07-26 11:16:26'),
(120, 'Start', '1', NULL, 37, '2024-07-26 11:16:26', '2024-07-26 11:16:26'),
(121, 'Target', '10', NULL, 37, '2024-07-26 11:16:26', '2024-07-26 11:16:26'),
(122, 'Current', '9', NULL, 37, '2024-07-26 11:16:26', '2024-07-26 11:16:26'),
(123, 'Key result', 'sell 10 book in sep', '1', 38, '2024-07-26 11:16:34', '2024-07-26 11:16:34'),
(124, 'Current', '9', '1', 38, '2024-07-26 11:16:34', '2024-07-26 11:16:34'),
(125, 'Key Result', 'test', NULL, 39, '2024-07-26 11:17:15', '2024-07-26 11:17:15'),
(126, 'Tracking', 'Quantifiable traget', NULL, 39, '2024-07-26 11:17:15', '2024-07-26 11:17:15'),
(127, 'Start', '0', NULL, 39, '2024-07-26 11:17:15', '2024-07-26 11:17:15'),
(128, 'Target', '500', NULL, 39, '2024-07-26 11:17:15', '2024-07-26 11:17:15'),
(129, 'Current', '250', NULL, 39, '2024-07-26 11:17:15', '2024-07-26 11:17:15'),
(130, 'Owner', 'Elton', NULL, 40, '2024-07-26 11:17:17', '2024-07-26 11:17:17'),
(131, 'Title', 'test', NULL, 40, '2024-07-26 11:17:17', '2024-07-26 11:17:17'),
(132, 'Goal Category', 'test2', NULL, 40, '2024-07-26 11:17:17', '2024-07-26 11:17:17'),
(133, 'Status', 'tyeat', NULL, 40, '2024-07-26 11:17:17', '2024-07-26 11:17:17'),
(134, 'Category', 'category', NULL, 40, '2024-07-26 11:17:17', '2024-07-26 11:17:17'),
(135, 'Key Result', 'test', NULL, 41, '2024-07-26 11:18:15', '2024-07-26 11:18:15'),
(136, 'Tracking', 'Milestone', NULL, 41, '2024-07-26 11:18:15', '2024-07-26 11:18:15'),
(137, 'Traking', 'Pending', NULL, 41, '2024-07-26 11:18:15', '2024-07-26 11:18:15'),
(138, 'Key Result', 'test', NULL, 42, '2024-07-26 11:19:12', '2024-07-26 11:19:12'),
(139, 'Tracking', 'Quantifiable traget', NULL, 42, '2024-07-26 11:19:12', '2024-07-26 11:19:12'),
(140, 'Start', '0', NULL, 42, '2024-07-26 11:19:12', '2024-07-26 11:19:12'),
(141, 'Target', '50', NULL, 42, '2024-07-26 11:19:12', '2024-07-26 11:19:12'),
(142, 'Current', '20', NULL, 42, '2024-07-26 11:19:12', '2024-07-26 11:19:12'),
(143, 'Key Result', 'test', NULL, 43, '2024-07-26 11:19:37', '2024-07-26 11:19:37'),
(144, 'Tracking', 'Milestone', NULL, 43, '2024-07-26 11:19:37', '2024-07-26 11:19:37'),
(145, 'Traking', 'Pending', NULL, 43, '2024-07-26 11:19:37', '2024-07-26 11:19:37'),
(146, 'Key Result', 'test2', NULL, 44, '2024-07-26 11:19:47', '2024-07-26 11:19:47'),
(147, 'Tracking', 'Quantifiable traget', NULL, 44, '2024-07-26 11:19:47', '2024-07-26 11:19:47'),
(148, 'Start', '0', NULL, 44, '2024-07-26 11:19:47', '2024-07-26 11:19:47'),
(149, 'Target', '100', NULL, 44, '2024-07-26 11:19:47', '2024-07-26 11:19:47'),
(150, 'Current', '50', NULL, 44, '2024-07-26 11:19:47', '2024-07-26 11:19:47'),
(151, 'Owner', 'Elton', NULL, 45, '2024-07-26 11:19:48', '2024-07-26 11:19:48'),
(152, 'Title', 'test', NULL, 45, '2024-07-26 11:19:48', '2024-07-26 11:19:48'),
(153, 'Goal Category', 'test2', NULL, 45, '2024-07-26 11:19:48', '2024-07-26 11:19:48'),
(154, 'Status', 'test', NULL, 45, '2024-07-26 11:19:48', '2024-07-26 11:19:48'),
(155, 'Category', 'category', NULL, 45, '2024-07-26 11:19:48', '2024-07-26 11:19:48'),
(156, 'Key Result', 'test', NULL, 46, '2024-07-26 12:58:09', '2024-07-26 12:58:09'),
(157, 'Tracking', 'Quantifiable traget', NULL, 46, '2024-07-26 12:58:09', '2024-07-26 12:58:09'),
(158, 'Start', '0', NULL, 46, '2024-07-26 12:58:09', '2024-07-26 12:58:09'),
(159, 'Target', '200', NULL, 46, '2024-07-26 12:58:09', '2024-07-26 12:58:09'),
(160, 'Current', '38', NULL, 46, '2024-07-26 12:58:09', '2024-07-26 12:58:09'),
(161, 'Owner', 'Chetan Bairag', NULL, 47, '2024-07-26 12:58:13', '2024-07-26 12:58:13'),
(162, 'Title', 'tdt', NULL, 47, '2024-07-26 12:58:13', '2024-07-26 12:58:13'),
(163, 'Goal Category', '3rd quarter 2024', NULL, 47, '2024-07-26 12:58:13', '2024-07-26 12:58:13'),
(164, 'Status', 'test', NULL, 47, '2024-07-26 12:58:13', '2024-07-26 12:58:13'),
(165, 'Category', 'category', NULL, 47, '2024-07-26 12:58:13', '2024-07-26 12:58:13'),
(166, 'Owner', 'Chetan Bairag', NULL, 48, '2024-07-26 13:00:10', '2024-07-26 13:00:10'),
(167, 'Title', 'hg', NULL, 48, '2024-07-26 13:00:10', '2024-07-26 13:00:10'),
(168, 'Goal Category', '3rd quarter 2024', NULL, 48, '2024-07-26 13:00:10', '2024-07-26 13:00:10'),
(169, 'Status', 'tyeat', NULL, 48, '2024-07-26 13:00:10', '2024-07-26 13:00:10'),
(170, 'Category', 'category', NULL, 48, '2024-07-26 13:00:10', '2024-07-26 13:00:10'),
(171, 'Key Result', 'test 2', NULL, 49, '2024-07-26 13:00:40', '2024-07-26 13:00:40'),
(172, 'Tracking', 'Quantifiable traget', NULL, 49, '2024-07-26 13:00:40', '2024-07-26 13:00:40'),
(173, 'Start', '0', NULL, 49, '2024-07-26 13:00:40', '2024-07-26 13:00:40'),
(174, 'Target', '500', NULL, 49, '2024-07-26 13:00:40', '2024-07-26 13:00:40'),
(175, 'Current', '200', NULL, 49, '2024-07-26 13:00:40', '2024-07-26 13:00:40'),
(176, 'Key Result', 'testing', NULL, 50, '2024-07-26 13:02:03', '2024-07-26 13:02:03'),
(177, 'Tracking', 'Quantifiable traget', NULL, 50, '2024-07-26 13:02:03', '2024-07-26 13:02:03'),
(178, 'Start', '1', NULL, 50, '2024-07-26 13:02:03', '2024-07-26 13:02:03'),
(179, 'Target', '100', NULL, 50, '2024-07-26 13:02:03', '2024-07-26 13:02:03'),
(180, 'Current', '22', NULL, 50, '2024-07-26 13:02:03', '2024-07-26 13:02:03'),
(181, 'Owner', 'Chetan Bairag', NULL, 51, '2024-07-26 13:02:06', '2024-07-26 13:02:06'),
(182, 'Title', 'testing', NULL, 51, '2024-07-26 13:02:06', '2024-07-26 13:02:06'),
(183, 'Goal Category', '3rd quarter 2024', NULL, 51, '2024-07-26 13:02:06', '2024-07-26 13:02:06'),
(184, 'Status', 'tyeat', NULL, 51, '2024-07-26 13:02:06', '2024-07-26 13:02:06'),
(185, 'Category', 'category', NULL, 51, '2024-07-26 13:02:06', '2024-07-26 13:02:06');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `employment_start` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employment_end` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `d_o_b` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_login` int(11) NOT NULL DEFAULT '0' COMMENT 'admin=0,user=1',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `profile_image`, `logo`, `department_id`, `employment_start`, `employment_end`, `d_o_b`, `employee_code`, `is_login`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '14', '18', NULL, NULL, NULL, '', '', 0, NULL, '$2y$10$I663JuUbKheBkoG/pyGIoOFeVvQ7eJa0oosC3Gv6BMDXd5VK6yl2.', 'GhrgLUvJ5JREm7levgSQwmoSp3TdJ9CEaO6Vgy462a5riS4iSTn6zLRkcxuj', '2023-10-25 04:46:00', '2024-07-26 05:54:46');

-- --------------------------------------------------------

--
-- Table structure for table `appraisals`
--

CREATE TABLE `appraisals` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `self_review` int(11) DEFAULT '0',
  `self_review_deadline` varchar(255) DEFAULT NULL,
  `manager_id` int(11) DEFAULT NULL,
  `manager_review` int(11) DEFAULT '0',
  `manager_review_deadlin` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `review_cycle` varchar(255) DEFAULT NULL,
  `results_shared` int(11) DEFAULT '0',
  `questionnaire` varchar(255) DEFAULT NULL,
  `self_popup` int(22) DEFAULT '0',
  `manager_popup` int(22) DEFAULT '0',
  `self_popup_date` varchar(255) DEFAULT NULL,
  `manager_popup_date` varchar(255) DEFAULT NULL,
  `self_review_submited` varchar(100) DEFAULT NULL,
  `manager_review_submited` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appraisals`
--

INSERT INTO `appraisals` (`id`, `user_id`, `self_review`, `self_review_deadline`, `manager_id`, `manager_review`, `manager_review_deadlin`, `status`, `review_cycle`, `results_shared`, `questionnaire`, `self_popup`, `manager_popup`, `self_popup_date`, `manager_popup_date`, `self_review_submited`, `manager_review_submited`, `created_at`, `updated_at`) VALUES
(1, 18, 0, '2024-06-20', 4, 0, '2024-06-30', 0, '2', 0, '1', 0, 0, '2024/07/05', NULL, NULL, NULL, '2024-06-19 09:15:33', '2024-07-05 03:55:21'),
(2, 16, 0, '2024-06-28', 4, 0, '2024-07-31', 0, '2', 0, '7', 0, 0, '2024/07/26', NULL, NULL, NULL, '2024-06-28 08:31:59', '2024-07-26 05:37:47'),
(3, 1, 1, '2024-07-25', 4, 0, '2024-07-31', 0, '2', 1, '9', 0, 0, '2024/07/25', '2024/07/26', '2024-07-25 06:01:09 AM', NULL, '2024-07-25 00:29:46', '2024-07-26 06:02:33'),
(4, 1, 1, '2024-07-27', 4, 1, '2024-08-1', 1, '3', 1, '9', 0, 0, '2024/07/26', '2024/07/26', '2024-07-26 11:32:03 AM', '2024-07-26 12:06:13 PM', '2024-07-26 06:01:13', '2024-07-26 06:36:13'),
(5, 1, 1, '2024-08-03', 4, 0, '2024-08-05', 0, '3', 0, '9', 0, 0, '2024/07/26', '2024/07/26', '2024-07-26 11:50:59 AM', NULL, '2024-07-26 06:20:39', '2024-07-26 06:21:10'),
(6, 1, 1, '2024-08-07', 4, 0, '2024-08-09', 0, '2', 0, '9', 0, 0, '2024/07/26', '2024/07/26', '2024-07-26 12:03:27 PM', NULL, '2024-07-26 06:33:03', '2024-07-26 06:33:41'),
(7, 1, 1, '2024-08-14', 4, 0, '2024-08-15', 0, '2', 0, '9', 0, 0, '2024/07/26', '2024/07/26', '2024-07-26 12:08:30 PM', NULL, '2024-07-26 06:37:04', '2024-07-26 06:38:36');

-- --------------------------------------------------------

--
-- Table structure for table `assess_potentials`
--

CREATE TABLE `assess_potentials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `potential` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `retention` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `achievable_level` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loss_impact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `performance_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assess_potentials`
--

INSERT INTO `assess_potentials` (`id`, `potential`, `retention`, `achievable_level`, `loss_impact`, `status`, `performance_id`, `created_at`, `updated_at`) VALUES
(1, '1', '1', '1', '1', 1, 1, '2024-05-27 01:35:09', '2024-05-27 01:35:09');

-- --------------------------------------------------------

--
-- Table structure for table `certificate`
--

CREATE TABLE `certificate` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `certificate`
--

INSERT INTO `certificate` (`id`, `user_id`, `file`, `created_at`, `updated_at`) VALUES
(17, 16, '1719585363.png', '2024-06-28 09:06:03', '2024-06-28 09:06:03'),
(16, 16, '1719585349.jpg', '2024-06-28 09:05:49', '2024-06-28 09:05:49'),
(15, 16, '1719585335.jpg', '2024-06-28 09:05:35', '2024-06-28 09:05:35'),
(14, 1, '1718113836.pdf', '2024-06-11 08:20:36', '2024-06-11 08:20:36');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `color_name` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `color_name`, `color_code`, `created_at`, `updated_at`) VALUES
(7, 'Red', '#FF0000', NULL, NULL),
(8, 'Cyan', '#00FFFF', NULL, NULL),
(9, 'Blue', '#0000FF', NULL, NULL),
(10, 'DarkBlue', '#00008B', NULL, NULL),
(11, 'LightBlue', '#ADD8E6', NULL, NULL),
(12, 'Purple', '#800080', NULL, NULL),
(13, 'Yellow', '#FFFF00', NULL, NULL),
(14, 'Lime', '#00FF00', NULL, NULL),
(15, 'Magenta', '#FF00FF', NULL, NULL),
(16, 'Pink', '#FFC0CB', NULL, NULL),
(17, 'White', '#FFFFFF', NULL, NULL),
(18, 'Silver', '#C0C0C0', NULL, NULL),
(19, 'Gray or Grey', '#808080', NULL, NULL),
(20, 'Black', '#000000', NULL, NULL),
(21, 'Orange', '#FFA500', NULL, NULL),
(22, 'Brown', '#A52A2A', NULL, NULL),
(23, 'Maroon', '#800000', NULL, NULL),
(24, 'Green', '#008000', NULL, NULL),
(25, 'Olive', '#808000', NULL, NULL),
(26, 'Aquamarine', '#7FFFD4', NULL, NULL),
(27, 'Black (W3C)', '#000000', NULL, NULL),
(28, 'Black Blue', '#040720', NULL, NULL),
(29, 'Night', '#0C090A', NULL, NULL),
(30, 'Charcoal', '#34282C', NULL, NULL),
(31, 'Oil', '#3B3131', NULL, NULL),
(32, 'Stormy Gray', '#3A3B3C', NULL, NULL),
(33, 'Light Black', '#454545', NULL, NULL),
(34, 'Dark Steampunk', '#4D4D4F', NULL, NULL),
(35, 'Black Cat', '#413839', NULL, NULL),
(36, 'Iridium', '#3D3C3A', NULL, NULL),
(37, 'Black Eel', '#463E3F', NULL, NULL),
(38, 'Black Cow', '#4C4646', NULL, NULL),
(39, 'Gray Wolf', '#504A4B', NULL, NULL),
(40, 'Vampire Gray', '#565051', NULL, NULL),
(41, 'Iron Gray', '#52595D', NULL, NULL),
(42, 'Gray Dolphin', '#5C5858', NULL, NULL),
(43, 'Carbon Gray', '#625D5D', NULL, NULL),
(44, 'Ash Gray', '#666362', NULL, NULL),
(45, 'DimGray or DimGrey (W3C)', '#696969', NULL, NULL),
(46, 'Nardo Gray', '#686A6C', NULL, NULL),
(47, 'Cloudy Gray', '#6D6968', NULL, NULL),
(48, 'Smokey Gray', '#726E6D', NULL, NULL),
(49, 'Alien Gray', '#736F6E', NULL, NULL),
(50, 'Sonic Silver', '#757575', NULL, NULL),
(51, 'Platinum Gray', '#797979', NULL, NULL),
(52, 'Granite', '#837E7C', NULL, NULL),
(53, 'Gray or Grey (W3C)', '#808080', NULL, NULL),
(54, 'Battleship Gray', '#848482', NULL, NULL),
(55, 'Sheet Metal', '#888B90', NULL, NULL),
(56, 'Dark Gainsboro', '#8C8C8C', NULL, NULL),
(57, 'Gunmetal Gray', '#8D918D', NULL, NULL),
(58, 'Cold Metal', '#9B9A96', NULL, NULL),
(59, 'Stainless Steel Gray', '#99A3A3', NULL, NULL),
(60, 'DarkGray or DarkGrey (W3C)', '#A9A9A9', NULL, NULL),
(61, 'Chrome Aluminum', '#A8A9AD', NULL, NULL),
(62, 'Gray Cloud', '#B6B6B4', NULL, NULL),
(63, 'Metal', '#B6B6B6', NULL, NULL),
(64, 'Silver (W3C)', '#C0C0C0', NULL, NULL),
(65, 'Steampunk', '#C9C1C1', NULL, NULL),
(66, 'Pale Silver', '#C9C0BB', NULL, NULL),
(67, 'Gear Steel Gray', '#C0C6C7', NULL, NULL),
(68, 'Gray Goose', '#D1D0CE', NULL, NULL),
(69, 'Platinum Silver', '#CECECE', NULL, NULL),
(70, 'LightGray or LightGrey (W3C)', '#D3D3D3', NULL, NULL),
(71, 'Silver White', '#DADBDD', NULL, NULL),
(72, 'Gainsboro (W3C)', '#DCDCDC', NULL, NULL),
(73, 'Light Steel Gray', '#E0E5E5', NULL, NULL),
(74, 'WhiteSmoke (W3C)', '#F5F5F5', NULL, NULL),
(75, 'White Gray', '#EEEEEE', NULL, NULL),
(76, 'Platinum', '#E5E4E2', NULL, NULL),
(77, 'Metallic Silver', '#BCC6CC', NULL, NULL),
(78, 'Blue Gray', '#98AFC7', NULL, NULL),
(79, 'Roman Silver', '#838996', NULL, NULL),
(80, 'LightSlateGray or LightSlateGrey (W3C)', '#778899', NULL, NULL),
(81, 'SlateGray or SlateGrey (W3C)', '#708090', NULL, NULL),
(82, 'Rat Gray', '#6D7B8D', NULL, NULL),
(83, 'Slate Granite Gray', '#657383', NULL, NULL),
(84, 'Jet Gray', '#616D7E', NULL, NULL),
(85, 'Mist Blue', '#646D7E', NULL, NULL),
(86, 'Steel Gray', '#71797E', NULL, NULL),
(87, 'Marble Blue', '#566D7E', NULL, NULL),
(88, 'Slate Blue Gray', '#737CA1', NULL, NULL),
(89, 'Light Purple Blue', '#728FCE', NULL, NULL),
(90, 'Azure Blue', '#4863A0', NULL, NULL),
(91, 'Estoril Blue', '#2F539B', NULL, NULL),
(92, 'Blue Jay', '#2B547E', NULL, NULL),
(93, 'Charcoal Blue', '#36454F', NULL, NULL),
(94, 'Dark Blue Gray', '#29465B', NULL, NULL),
(95, 'Dark Slate', '#2B3856', NULL, NULL),
(96, 'Deep Sea Blue', '#123456', NULL, NULL),
(97, 'Night Blue', '#151B54', NULL, NULL),
(98, 'MidnightBlue (W3C)', '#191970', NULL, NULL),
(99, 'Navy (W3C)', '#000080', NULL, NULL),
(100, 'Denim Dark Blue', '#151B8D', NULL, NULL),
(101, 'DarkBlue (W3C)', '#00008B', NULL, NULL),
(102, 'Lapis Blue', '#15317E', NULL, NULL),
(103, 'New Midnight Blue', '#0000A0', NULL, NULL),
(104, 'Earth Blue', '#0000A5', NULL, NULL),
(105, 'Cobalt Blue', '#0020C2', NULL, NULL),
(106, 'MediumBlue (W3C)', '#0000CD', NULL, NULL),
(107, 'Blueberry Blue', '#0041C2', NULL, NULL),
(108, 'Canary Blue', '#2916F5', NULL, NULL),
(109, 'Blue (W3C)', '#0000FF', NULL, NULL),
(110, 'Samco Blue', '#0002FF', NULL, NULL),
(111, 'Bright Blue', '#0909FF', NULL, NULL),
(112, 'Blue Orchid', '#1F45FC', NULL, NULL),
(113, 'Sapphire Blue', '#2554C7', NULL, NULL),
(114, 'Blue Eyes', '#1569C7', NULL, NULL),
(116, 'Bright Orange', '#FF5F1F', '2024-05-09 23:46:08', '2024-05-09 23:50:14');

-- --------------------------------------------------------

--
-- Table structure for table `company_announcements`
--

CREATE TABLE `company_announcements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `background_color_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text_color_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company_announcements`
--

INSERT INTO `company_announcements` (`id`, `title`, `description`, `employee_id`, `background_color_id`, `text_color_id`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Where does it come from?', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur,', NULL, '#000000', '#ffffff', 1, '2024-06-11 07:42:51', '2024-06-11 07:44:33'),
(3, 'Office Closure on 14 July 2024', 'Please be informed that the office will close at 12 noon on 14 July 2024 for maintenance purposes.\r\n\r\nAppreciate if all employees can leave the premises by the stated time to allow for the necessary work to take place.\r\n\r\nManagement Team', NULL, '#ffffff', '#000000', NULL, '2024-06-12 12:19:17', '2024-06-12 12:19:17');

-- --------------------------------------------------------

--
-- Table structure for table `competencies`
--

CREATE TABLE `competencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discription` text COLLATE utf8mb4_unicode_ci,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_progress` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(22) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `competencies`
--

INSERT INTO `competencies` (`id`, `title`, `status`, `discription`, `time`, `total_progress`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'test-rtt', 'Archived', 'test', '1719470911', '6.666666666666667', 1, '2024-06-27 01:18:57', '2024-06-27 06:24:13'),
(2, 'test-user', 'Active', 'test', '1719489273', '90', 1, '2024-06-27 06:25:01', '2024-06-27 08:15:25'),
(3, 'test', 'Active', 'test', '1719496000', '0', 18, '2024-06-27 08:16:47', '2024-06-27 08:17:04'),
(4, 'test', 'Active', 'test', '1720172300', '100', 16, '2024-07-05 04:08:25', '2024-07-05 04:08:42'),
(5, 'test', 'Active', 'test', '1721629928', '100', 3, '2024-07-22 01:02:28', '2024-07-22 01:02:28');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `sortname` varchar(3) NOT NULL,
  `name` varchar(150) NOT NULL,
  `phonecode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `sortname`, `name`, `phonecode`) VALUES
(1, 'AF', 'Afghanistan', 93),
(2, 'AL', 'Albania', 355),
(3, 'DZ', 'Algeria', 213),
(4, 'AS', 'American Samoa', 1684),
(5, 'AD', 'Andorra', 376),
(6, 'AO', 'Angola', 244),
(7, 'AI', 'Anguilla', 1264),
(8, 'AQ', 'Antarctica', 0),
(9, 'AG', 'Antigua And Barbuda', 1268),
(10, 'AR', 'Argentina', 54),
(11, 'AM', 'Armenia', 374),
(12, 'AW', 'Aruba', 297),
(13, 'AU', 'Australia', 61),
(14, 'AT', 'Austria', 43),
(15, 'AZ', 'Azerbaijan', 994),
(16, 'BS', 'Bahamas The', 1242),
(17, 'BH', 'Bahrain', 973),
(18, 'BD', 'Bangladesh', 880),
(19, 'BB', 'Barbados', 1246),
(20, 'BY', 'Belarus', 375),
(21, 'BE', 'Belgium', 32),
(22, 'BZ', 'Belize', 501),
(23, 'BJ', 'Benin', 229),
(24, 'BM', 'Bermuda', 1441),
(25, 'BT', 'Bhutan', 975),
(26, 'BO', 'Bolivia', 591),
(27, 'BA', 'Bosnia and Herzegovina', 387),
(28, 'BW', 'Botswana', 267),
(29, 'BV', 'Bouvet Island', 0),
(30, 'BR', 'Brazil', 55),
(31, 'IO', 'British Indian Ocean Territory', 246),
(32, 'BN', 'Brunei', 673),
(33, 'BG', 'Bulgaria', 359),
(34, 'BF', 'Burkina Faso', 226),
(35, 'BI', 'Burundi', 257),
(36, 'KH', 'Cambodia', 855),
(37, 'CM', 'Cameroon', 237),
(38, 'CA', 'Canada', 1),
(39, 'CV', 'Cape Verde', 238),
(40, 'KY', 'Cayman Islands', 1345),
(41, 'CF', 'Central African Republic', 236),
(42, 'TD', 'Chad', 235),
(43, 'CL', 'Chile', 56),
(44, 'CN', 'China', 86),
(45, 'CX', 'Christmas Island', 61),
(46, 'CC', 'Cocos (Keeling) Islands', 672),
(47, 'CO', 'Colombia', 57),
(48, 'KM', 'Comoros', 269),
(49, 'CG', 'Republic Of The Congo', 242),
(50, 'CD', 'Democratic Republic Of The Congo', 242),
(51, 'CK', 'Cook Islands', 682),
(52, 'CR', 'Costa Rica', 506),
(53, 'CI', 'Cote D\'Ivoire (Ivory Coast)', 225),
(54, 'HR', 'Croatia (Hrvatska)', 385),
(55, 'CU', 'Cuba', 53),
(56, 'CY', 'Cyprus', 357),
(57, 'CZ', 'Czech Republic', 420),
(58, 'DK', 'Denmark', 45),
(59, 'DJ', 'Djibouti', 253),
(60, 'DM', 'Dominica', 1767),
(61, 'DO', 'Dominican Republic', 1809),
(62, 'TP', 'East Timor', 670),
(63, 'EC', 'Ecuador', 593),
(64, 'EG', 'Egypt', 20),
(65, 'SV', 'El Salvador', 503),
(66, 'GQ', 'Equatorial Guinea', 240),
(67, 'ER', 'Eritrea', 291),
(68, 'EE', 'Estonia', 372),
(69, 'ET', 'Ethiopia', 251),
(70, 'XA', 'External Territories of Australia', 61),
(71, 'FK', 'Falkland Islands', 500),
(72, 'FO', 'Faroe Islands', 298),
(73, 'FJ', 'Fiji Islands', 679),
(74, 'FI', 'Finland', 358),
(75, 'FR', 'France', 33),
(76, 'GF', 'French Guiana', 594),
(77, 'PF', 'French Polynesia', 689),
(78, 'TF', 'French Southern Territories', 0),
(79, 'GA', 'Gabon', 241),
(80, 'GM', 'Gambia The', 220),
(81, 'GE', 'Georgia', 995),
(82, 'DE', 'Germany', 49),
(83, 'GH', 'Ghana', 233),
(84, 'GI', 'Gibraltar', 350),
(85, 'GR', 'Greece', 30),
(86, 'GL', 'Greenland', 299),
(87, 'GD', 'Grenada', 1473),
(88, 'GP', 'Guadeloupe', 590),
(89, 'GU', 'Guam', 1671),
(90, 'GT', 'Guatemala', 502),
(91, 'XU', 'Guernsey and Alderney', 44),
(92, 'GN', 'Guinea', 224),
(93, 'GW', 'Guinea-Bissau', 245),
(94, 'GY', 'Guyana', 592),
(95, 'HT', 'Haiti', 509),
(96, 'HM', 'Heard and McDonald Islands', 0),
(97, 'HN', 'Honduras', 504),
(98, 'HK', 'Hong Kong S.A.R.', 852),
(99, 'HU', 'Hungary', 36),
(100, 'IS', 'Iceland', 354),
(101, 'IN', 'India', 91),
(102, 'ID', 'Indonesia', 62),
(103, 'IR', 'Iran', 98),
(104, 'IQ', 'Iraq', 964),
(105, 'IE', 'Ireland', 353),
(106, 'IL', 'Israel', 972),
(107, 'IT', 'Italy', 39),
(108, 'JM', 'Jamaica', 1876),
(109, 'JP', 'Japan', 81),
(110, 'XJ', 'Jersey', 44),
(111, 'JO', 'Jordan', 962),
(112, 'KZ', 'Kazakhstan', 7),
(113, 'KE', 'Kenya', 254),
(114, 'KI', 'Kiribati', 686),
(115, 'KP', 'Korea North', 850),
(116, 'KR', 'Korea South', 82),
(117, 'KW', 'Kuwait', 965),
(118, 'KG', 'Kyrgyzstan', 996),
(119, 'LA', 'Laos', 856),
(120, 'LV', 'Latvia', 371),
(121, 'LB', 'Lebanon', 961),
(122, 'LS', 'Lesotho', 266),
(123, 'LR', 'Liberia', 231),
(124, 'LY', 'Libya', 218),
(125, 'LI', 'Liechtenstein', 423),
(126, 'LT', 'Lithuania', 370),
(127, 'LU', 'Luxembourg', 352),
(128, 'MO', 'Macau S.A.R.', 853),
(129, 'MK', 'Macedonia', 389),
(130, 'MG', 'Madagascar', 261),
(131, 'MW', 'Malawi', 265),
(132, 'MY', 'Malaysia', 60),
(133, 'MV', 'Maldives', 960),
(134, 'ML', 'Mali', 223),
(135, 'MT', 'Malta', 356),
(136, 'XM', 'Man (Isle of)', 44),
(137, 'MH', 'Marshall Islands', 692),
(138, 'MQ', 'Martinique', 596),
(139, 'MR', 'Mauritania', 222),
(140, 'MU', 'Mauritius', 230),
(141, 'YT', 'Mayotte', 269),
(142, 'MX', 'Mexico', 52),
(143, 'FM', 'Micronesia', 691),
(144, 'MD', 'Moldova', 373),
(145, 'MC', 'Monaco', 377),
(146, 'MN', 'Mongolia', 976),
(147, 'MS', 'Montserrat', 1664),
(148, 'MA', 'Morocco', 212),
(149, 'MZ', 'Mozambique', 258),
(150, 'MM', 'Myanmar', 95),
(151, 'NA', 'Namibia', 264),
(152, 'NR', 'Nauru', 674),
(153, 'NP', 'Nepal', 977),
(154, 'AN', 'Netherlands Antilles', 599),
(155, 'NL', 'Netherlands The', 31),
(156, 'NC', 'New Caledonia', 687),
(157, 'NZ', 'New Zealand', 64),
(158, 'NI', 'Nicaragua', 505),
(159, 'NE', 'Niger', 227),
(160, 'NG', 'Nigeria', 234),
(161, 'NU', 'Niue', 683),
(162, 'NF', 'Norfolk Island', 672),
(163, 'MP', 'Northern Mariana Islands', 1670),
(164, 'NO', 'Norway', 47),
(165, 'OM', 'Oman', 968),
(166, 'PK', 'Pakistan', 92),
(167, 'PW', 'Palau', 680),
(168, 'PS', 'Palestinian Territory Occupied', 970),
(169, 'PA', 'Panama', 507),
(170, 'PG', 'Papua new Guinea', 675),
(171, 'PY', 'Paraguay', 595),
(172, 'PE', 'Peru', 51),
(173, 'PH', 'Philippines', 63),
(174, 'PN', 'Pitcairn Island', 0),
(175, 'PL', 'Poland', 48),
(176, 'PT', 'Portugal', 351),
(177, 'PR', 'Puerto Rico', 1787),
(178, 'QA', 'Qatar', 974),
(179, 'RE', 'Reunion', 262),
(180, 'RO', 'Romania', 40),
(181, 'RU', 'Russia', 70),
(182, 'RW', 'Rwanda', 250),
(183, 'SH', 'Saint Helena', 290),
(184, 'KN', 'Saint Kitts And Nevis', 1869),
(185, 'LC', 'Saint Lucia', 1758),
(186, 'PM', 'Saint Pierre and Miquelon', 508),
(187, 'VC', 'Saint Vincent And The Grenadines', 1784),
(188, 'WS', 'Samoa', 684),
(189, 'SM', 'San Marino', 378),
(190, 'ST', 'Sao Tome and Principe', 239),
(191, 'SA', 'Saudi Arabia', 966),
(192, 'SN', 'Senegal', 221),
(193, 'RS', 'Serbia', 381),
(194, 'SC', 'Seychelles', 248),
(195, 'SL', 'Sierra Leone', 232),
(196, 'SG', 'Singapore', 65),
(197, 'SK', 'Slovakia', 421),
(198, 'SI', 'Slovenia', 386),
(199, 'XG', 'Smaller Territories of the UK', 44),
(200, 'SB', 'Solomon Islands', 677),
(201, 'SO', 'Somalia', 252),
(202, 'ZA', 'South Africa', 27),
(203, 'GS', 'South Georgia', 0),
(204, 'SS', 'South Sudan', 211),
(205, 'ES', 'Spain', 34),
(206, 'LK', 'Sri Lanka', 94),
(207, 'SD', 'Sudan', 249),
(208, 'SR', 'Suriname', 597),
(209, 'SJ', 'Svalbard And Jan Mayen Islands', 47),
(210, 'SZ', 'Swaziland', 268),
(211, 'SE', 'Sweden', 46),
(212, 'CH', 'Switzerland', 41),
(213, 'SY', 'Syria', 963),
(214, 'TW', 'Taiwan', 886),
(215, 'TJ', 'Tajikistan', 992),
(216, 'TZ', 'Tanzania', 255),
(217, 'TH', 'Thailand', 66),
(218, 'TG', 'Togo', 228),
(219, 'TK', 'Tokelau', 690),
(220, 'TO', 'Tonga', 676),
(221, 'TT', 'Trinidad And Tobago', 1868),
(222, 'TN', 'Tunisia', 216),
(223, 'TR', 'Turkey', 90),
(224, 'TM', 'Turkmenistan', 7370),
(225, 'TC', 'Turks And Caicos Islands', 1649),
(226, 'TV', 'Tuvalu', 688),
(227, 'UG', 'Uganda', 256),
(228, 'UA', 'Ukraine', 380),
(229, 'AE', 'United Arab Emirates', 971),
(230, 'GB', 'United Kingdom', 44),
(231, 'US', 'United States', 1),
(232, 'UM', 'United States Minor Outlying Islands', 1),
(233, 'UY', 'Uruguay', 598),
(234, 'UZ', 'Uzbekistan', 998),
(235, 'VU', 'Vanuatu', 678),
(236, 'VA', 'Vatican City State (Holy See)', 39),
(237, 'VE', 'Venezuela', 58),
(238, 'VN', 'Vietnam', 84),
(239, 'VG', 'Virgin Islands (British)', 1284),
(240, 'VI', 'Virgin Islands (US)', 1340),
(241, 'WF', 'Wallis And Futuna Islands', 681),
(242, 'EH', 'Western Sahara', 212),
(243, 'YE', 'Yemen', 967),
(244, 'YU', 'Yugoslavia', 38),
(245, 'ZM', 'Zambia', 260),
(246, 'ZW', 'Zimbabwe', 263);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'PHP', 1, '2023-10-26 05:56:43', '2023-10-27 05:49:47'),
(2, 'HR', 0, '2023-10-31 06:30:53', '2024-06-02 04:01:52'),
(3, 'Mobile Developer', 1, '2023-10-31 06:31:36', '2023-10-31 06:31:36'),
(4, 'Operations', 0, '2024-06-02 04:01:30', '2024-06-02 04:01:58'),
(5, 'Accounts', 0, '2024-06-02 04:01:42', '2024-06-02 04:01:47'),
(6, 'Sales', 0, '2024-06-02 04:02:27', '2024-06-02 04:02:31');

-- --------------------------------------------------------

--
-- Table structure for table `developments`
--

CREATE TABLE `developments` (
  `id` int(22) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `discription` text,
  `time` varchar(255) DEFAULT NULL,
  `total_progress` varchar(255) DEFAULT NULL,
  `user_id` int(22) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `developments`
--

INSERT INTO `developments` (`id`, `title`, `status`, `discription`, `time`, `total_progress`, `user_id`, `created_at`, `updated_at`) VALUES
(10, 'test-user', 'Active', 'test', '1719494238', '0', 1, '2024-06-27 13:17:29', '2024-06-27 13:18:44');

-- --------------------------------------------------------

--
-- Table structure for table `disciplinary_letters`
--

CREATE TABLE `disciplinary_letters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `doc_name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `updated_at` varchar(255) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `document_categories`
--

CREATE TABLE `document_categories` (
  `id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` datetime(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `updated_at` datetime(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `document_categories`
--

INSERT INTO `document_categories` (`id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(1, 'test', '1', '2024-06-11 13:48:01.000000', '2024-06-11 13:48:01.000000');

-- --------------------------------------------------------

--
-- Table structure for table `educations`
--

CREATE TABLE `educations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `qualification` varchar(255) DEFAULT NULL,
  `percentage` int(11) DEFAULT NULL,
  `passing_year` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `educations`
--

INSERT INTO `educations` (`id`, `employee_id`, `qualification`, `percentage`, `passing_year`, `created_at`, `updated_at`) VALUES
(6, 1, '10th', 85, 2022, '2024-06-11 08:18:53', '2024-06-11 08:18:53');

-- --------------------------------------------------------

--
-- Table structure for table `emergency_contacts`
--

CREATE TABLE `emergency_contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `relation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `emergency_contacts`
--

INSERT INTO `emergency_contacts` (`id`, `name`, `number`, `relation`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Amitabh Patel', '23459708', 'Parent', 10, '2024-06-28 08:50:50', '2024-06-28 08:50:50'),
(2, 'test', '7987562569', 'Spouse', 16, '2024-07-05 04:02:53', '2024-07-05 04:02:53');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `goals`
--

CREATE TABLE `goals` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `description` text,
  `deadline` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `review_cycle` varchar(255) DEFAULT NULL,
  `tracking` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `totalprogressbar` varchar(255) DEFAULT NULL,
  `user_id` int(22) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `goals`
--

INSERT INTO `goals` (`id`, `title`, `status`, `role_id`, `description`, `deadline`, `category`, `review_cycle`, `tracking`, `time`, `totalprogressbar`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 'sell 30 book by september', 2, NULL, 'sell 30 books by september  10 books a month', '2024-09-30', '2', '3', NULL, '1720629996', '71', 16, '2024-07-10 16:54:06', '2024-07-26 11:19:14'),
(3, 'test', 2, NULL, 'test', '2024-07-24', '2', '2', NULL, '1721629870', '10', 3, '2024-07-22 06:32:00', '2024-07-22 06:32:00'),
(4, 'test', 3, NULL, 'test', '2024-08-10', '2', '2', NULL, '1721992605', '50', 16, '2024-07-26 11:17:17', '2024-07-26 11:17:17'),
(5, 'test', 2, NULL, 'test', '2024-08-09', '2', '2', NULL, '1721992759', '75', 16, '2024-07-26 11:19:48', '2024-07-26 11:19:48'),
(6, 'tdt', 2, NULL, 'trt', '2024-07-29', '2', '3', NULL, '1721998653', '19', 1, '2024-07-26 12:58:13', '2024-07-26 12:58:13'),
(7, 'hg', 3, NULL, 'hgfhf', '2024-08-08', '2', '3', NULL, '1721998790', '40', 1, '2024-07-26 13:00:09', '2024-07-26 13:00:44'),
(8, 'testing', 3, NULL, 'tyu', '2024-08-09', '2', '3', NULL, '1721998873', '21.212121212121', 1, '2024-07-26 13:02:06', '2024-07-26 13:02:06');

-- --------------------------------------------------------

--
-- Table structure for table `goal_categories`
--

CREATE TABLE `goal_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `goal_categories`
--

INSERT INTO `goal_categories` (`id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(2, 'category', 1, '2024-06-20 06:46:39', '2024-06-20 06:46:39'),
(3, 'test', 1, '2024-06-27 00:40:12', '2024-06-27 00:40:12');

-- --------------------------------------------------------

--
-- Table structure for table `goal_statuses`
--

CREATE TABLE `goal_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `background_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `label_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `goal_statuses`
--

INSERT INTO `goal_statuses` (`id`, `title`, `status`, `background_color`, `label_color`, `created_at`, `updated_at`) VALUES
(2, 'test', 1, '#7034df', '#ffffff', '2024-06-20 05:53:53', '2024-06-20 06:41:09'),
(3, 'tyeat', 1, '#f89b9b', '#050505', '2024-06-22 06:00:43', '2024-06-22 06:00:43');

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `country` int(22) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `holidays`
--

INSERT INTO `holidays` (`id`, `title`, `date`, `status`, `country`, `color`, `created_at`, `updated_at`) VALUES
(1, 'Good Friday', '2024-06-12', 1, 101, '#e43a3a', '2023-11-03 09:35:24', '2024-06-11 13:45:05'),
(2, 'Holi', '2023-11-14', 1, NULL, '#e43a3a', '2023-11-03 13:26:31', '2024-06-11 13:45:05'),
(3, 'Independence Day', '2024-08-15', 1, NULL, '#e43a3a', '2024-05-04 10:51:06', '2024-06-11 13:45:05'),
(4, 'test', '2024-05-11', 1, NULL, '#e43a3a', '2024-05-04 11:01:06', '2024-06-11 13:45:05'),
(5, 'Holi', '2024-05-03', 1, NULL, '#e43a3a', '2024-05-04 11:35:02', '2024-06-11 13:45:05');

-- --------------------------------------------------------

--
-- Table structure for table `input_types`
--

CREATE TABLE `input_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `input_types`
--

INSERT INTO `input_types` (`id`, `title`, `slug`, `name`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Input Text', 'input_text', 'input', 'text', '2024-04-26 08:17:02', '2024-04-26 08:17:02'),
(3, 'Input Number', 'input_number', 'input', 'number', '2024-04-26 03:16:55', '2024-04-26 03:16:55'),
(4, 'Input Email', 'input_email', 'input', 'email', '2024-04-26 03:16:55', '2024-04-26 03:16:55'),
(5, 'Textarea ', 'textarea', 'textarea', 'textarea', '2024-04-26 03:16:55', '2024-04-26 03:16:55'),
(6, 'Radio', 'radio', 'radio', 'radio', '2024-04-26 03:16:55', '2024-04-26 03:16:55'),
(7, 'Checkbox', 'checkbox', 'checkbox', 'checkbox', '2024-04-26 03:16:55', '2024-04-26 03:16:55'),
(8, 'Dropdown', 'dropdown', 'select', 'select', '2024-05-03 07:25:52', '2024-05-03 07:25:52'),
(9, 'Rating', 'rating', 'rating', 'radio', '2024-05-09 05:44:02', '2024-05-09 05:44:02'),
(10, 'Competency', 'competency', 'competency', 'competency', '2024-07-26 11:11:00', '2024-07-26 11:11:00'),
(11, 'Goal', 'goal', 'goal', 'goal', '2024-07-26 11:11:00', '2024-07-26 11:11:00'),
(12, 'Responsibility', 'responsibility', 'responsibility', 'responsibility', '2024-07-26 11:12:03', '2024-07-26 11:12:03'),
(13, 'Development', 'development', 'development', 'development', '2024-07-26 11:12:03', '2024-07-26 11:12:03');

-- --------------------------------------------------------

--
-- Table structure for table `key_results`
--

CREATE TABLE `key_results` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `traking` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `traking_status` tinyint(4) DEFAULT NULL,
  `target` int(11) DEFAULT NULL,
  `start` int(11) DEFAULT NULL,
  `goal_id` tinyint(4) DEFAULT NULL,
  `current` int(11) DEFAULT NULL,
  `total_progress` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `competencies_id` int(22) DEFAULT NULL,
  `responsibilities_id` int(22) DEFAULT NULL,
  `developments_id` int(22) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `key_results`
--

INSERT INTO `key_results` (`id`, `title`, `traking`, `traking_status`, `target`, `start`, `goal_id`, `current`, `total_progress`, `time`, `competencies_id`, `responsibilities_id`, `developments_id`, `created_at`, `updated_at`) VALUES
(13, 'test', 'Milestone', NULL, 100, 0, NULL, 0, '0', '1719469564', 16, NULL, NULL, '2024-06-27 01:13:32', '2024-06-27 01:16:11'),
(14, 'test', 'Milestone', NULL, 100, 0, NULL, 0, '0', '1719470911', 1, NULL, NULL, '2024-06-27 01:18:42', '2024-06-27 06:24:10'),
(15, 'test-test', 'Quantiflable traget', NULL, 100, 0, NULL, 20, '20', '1719470911', 1, NULL, NULL, '2024-06-27 01:18:54', '2024-06-27 01:56:44'),
(16, 'test', 'Milestone', 1, 100, 0, NULL, 100, '100', '1719478671', NULL, 6, 6, '2024-06-27 03:28:17', '2024-06-27 03:40:44'),
(17, 'test', 'Quantiflable traget', NULL, 100, 0, NULL, 50, '50', '1719478671', NULL, 6, 6, '2024-06-27 03:28:26', '2024-06-27 07:16:22'),
(18, 'test', 'Milestone', NULL, 100, 0, NULL, 0, '0', '1719480010', NULL, NULL, 5, '2024-06-27 03:50:24', '2024-06-27 03:50:26'),
(19, 'test-adminn', 'Milestone', NULL, 100, 0, NULL, 0, '0', '1719480426', NULL, NULL, 6, '2024-06-27 03:57:25', '2024-06-27 03:57:28'),
(21, 'test', 'Milestone', NULL, 100, 0, NULL, 0, '0', '1719480523', NULL, NULL, 8, '2024-06-27 04:00:42', '2024-06-27 04:13:37'),
(22, 'test', 'Quantiflable traget', NULL, 100, 0, NULL, 0, '0', '1719480523', NULL, NULL, 8, '2024-06-27 04:02:56', '2024-06-27 04:02:58'),
(23, 'test-key', 'Milestone', 1, 100, 0, NULL, 100, '100', '1719481469', NULL, NULL, 9, '2024-06-27 04:14:46', '2024-06-27 04:16:26'),
(24, 'test', 'Milestone', NULL, 100, 0, NULL, 0, '0', '1719481630', NULL, 7, 7, '2024-06-27 04:17:32', '2024-06-27 08:15:00'),
(26, 'ates', 'Milestone', NULL, 100, 0, NULL, 0, '0', '1719481469', NULL, NULL, 9, '2024-06-27 04:38:15', '2024-06-27 04:42:48'),
(27, 'test', 'Milestone', NULL, 100, 0, NULL, 0, '0', '1719470911', 1, NULL, NULL, '2024-06-27 04:54:38', '2024-06-27 04:54:43'),
(29, 'test-user', 'Milestone', 1, 100, 0, 9, 100, '100', '1719487102', NULL, NULL, NULL, '2024-06-27 05:48:41', '2024-06-27 06:08:38'),
(30, 'tr', 'Quantiflable traget', NULL, 100, 0, 9, 10, '10', '1719487102', NULL, NULL, NULL, '2024-06-27 06:06:26', '2024-06-27 06:06:29'),
(31, 'test', 'Milestone', NULL, 100, 0, 9, 0, '0', '1719487102', NULL, NULL, NULL, '2024-06-27 06:08:56', '2024-06-27 06:08:59'),
(32, '258', 'Quantiflable traget', NULL, 100, 0, NULL, 90, '90', '1719489273', 2, NULL, NULL, '2024-06-27 06:24:52', '2024-06-27 08:15:24'),
(33, 'test', 'Milestone', NULL, 100, 0, NULL, 0, '0', '1719478671', NULL, NULL, 6, '2024-06-27 07:17:09', '2024-06-27 07:17:12'),
(34, 'test', 'Milestone', NULL, 100, 0, NULL, 0, '0', '1719492497', NULL, 9, 9, '2024-06-27 07:18:25', '2024-06-27 07:19:10'),
(35, 'test-66', 'Quantiflable traget', NULL, 100, 0, NULL, 0, '0', '1719492497', NULL, NULL, 9, '2024-06-27 07:19:07', '2024-06-27 07:19:10'),
(36, 'test', 'Milestone', 1, 100, 0, NULL, 100, '100', '1719492480', NULL, 8, NULL, '2024-06-27 07:22:27', '2024-06-27 07:23:53'),
(37, 'test', 'Quantiflable traget', NULL, 20, 0, NULL, 1, '5', '1719492480', NULL, 8, NULL, '2024-06-27 07:25:57', '2024-06-27 07:26:00'),
(38, 'test-user', 'Milestone', NULL, 100, 0, NULL, 0, '0', '1719494238', NULL, NULL, 10, '2024-06-27 07:48:40', '2024-06-27 07:48:44'),
(39, 'test', 'Milestone', NULL, 100, 0, NULL, 0, '0', '1719496000', 3, NULL, NULL, '2024-06-27 08:17:03', '2024-06-27 08:17:04'),
(40, 'sell 3 books', 'Milestone', 1, 100, 0, NULL, 100, '100', '1720163021', NULL, NULL, NULL, '2024-07-05 01:35:30', '2024-07-05 01:36:15'),
(41, 'sell 5 books', 'Milestone', NULL, 100, 0, NULL, 0, '0', '1720163021', NULL, NULL, NULL, '2024-07-05 01:36:04', '2024-07-05 01:36:04'),
(42, 'sell 20 book in july', 'Milestone', 1, 100, 0, NULL, 100, '100', '1720163238', NULL, NULL, NULL, '2024-07-05 01:39:00', '2024-07-05 01:40:10'),
(43, 'sell 20 books in august', 'Milestone', NULL, 100, 0, NULL, 0, '0', '1720163238', NULL, NULL, NULL, '2024-07-05 01:39:20', '2024-07-05 01:39:20'),
(44, 'sell 10 books in september', 'Milestone', NULL, 100, 0, NULL, 0, '0', '1720163238', NULL, NULL, NULL, '2024-07-05 01:39:46', '2024-07-05 01:39:46'),
(45, 'test', 'Milestone', 1, 100, 0, NULL, 100, '100', '1720172300', 4, NULL, NULL, '2024-07-05 04:08:40', '2024-07-05 04:08:42'),
(47, 'sell 10 books in july', 'Quantifiable traget', NULL, 200, 0, 2, 150, '75', '1720629996', NULL, NULL, NULL, '2024-07-10 11:19:50', '2024-07-26 05:45:46'),
(48, 'sell 10 books august', 'Quantifiable traget', NULL, 60, 0, 2, 30, '50', '1720629996', NULL, NULL, NULL, '2024-07-10 11:20:40', '2024-07-26 05:46:07'),
(49, 'sell 10 book in sep', 'Quantifiable traget', NULL, 10, 0, 2, 9, '90', '1720629996', NULL, NULL, NULL, '2024-07-10 11:21:59', '2024-07-26 05:46:34'),
(50, 'test', 'Milestone', NULL, 100, 0, 3, 0, '0', '1721629870', NULL, NULL, NULL, '2024-07-22 01:01:37', '2024-07-22 01:02:00'),
(51, 'test2', 'Quantiflable traget', NULL, 100, 0, 3, 20, '20', '1721629870', NULL, NULL, NULL, '2024-07-22 01:01:57', '2024-07-22 01:02:00'),
(52, 'test', 'Milestone', 1, 100, 0, NULL, 100, '100', '1721629928', 5, NULL, NULL, '2024-07-22 01:02:21', '2024-07-22 01:02:28'),
(53, 'test', 'Quantifiable traget', NULL, 500, 0, 4, 250, '50', '1721992605', NULL, NULL, NULL, '2024-07-26 05:47:15', '2024-07-26 05:47:17'),
(54, 'test', 'Milestone', 1, 100, 0, 2, 100, '100', '1720629996', NULL, NULL, NULL, '2024-07-26 05:48:15', '2024-07-26 05:48:17'),
(55, 'test', 'Quantifiable traget', NULL, 50, 0, 2, 20, '40', '1720629996', NULL, NULL, NULL, '2024-07-26 05:49:12', '2024-07-26 05:49:14'),
(56, 'test', 'Milestone', 1, 100, 0, 5, 100, '100', '1721992759', NULL, NULL, NULL, '2024-07-26 05:49:37', '2024-07-26 05:49:48'),
(57, 'test2', 'Quantifiable traget', NULL, 100, 0, 5, 50, '50', '1721992759', NULL, NULL, NULL, '2024-07-26 05:49:47', '2024-07-26 05:49:48'),
(58, 'test', 'Quantifiable traget', NULL, 200, 0, 6, 38, '19', '1721998653', NULL, NULL, NULL, '2024-07-26 07:28:09', '2024-07-26 07:28:13'),
(59, 'test 2', 'Quantifiable traget', NULL, 500, 0, 7, 200, '40', '1721998790', NULL, NULL, NULL, '2024-07-26 07:30:40', '2024-07-26 07:30:44'),
(60, 'testing', 'Quantifiable traget', NULL, 100, 1, 8, 22, '21.212121212121', '1721998873', NULL, NULL, NULL, '2024-07-26 07:32:03', '2024-07-26 07:32:06');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'Hindi', '2024-05-04 05:10:47', '2024-05-04 05:10:47'),
(3, 'English', '2024-05-04 05:11:03', '2024-05-04 05:11:03');

-- --------------------------------------------------------

--
-- Table structure for table `leave_requests`
--

CREATE TABLE `leave_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `leave_type` bigint(20) DEFAULT NULL,
  `employee_id` bigint(20) DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `start_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_leave` int(11) NOT NULL DEFAULT '0' COMMENT '0-none,1-approve,2-declined',
  `comment` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leave_requests`
--

INSERT INTO `leave_requests` (`id`, `leave_type`, `employee_id`, `description`, `start_date`, `end_date`, `file_id`, `is_leave`, `comment`, `created_at`, `updated_at`) VALUES
(4, 2, 1, 'test', '2024-06-12', '2024-06-19', NULL, 1, NULL, '2024-06-11 08:13:20', '2024-06-11 08:13:49'),
(5, 1, 1, 'test', '2024-06-26', '2024-06-28', NULL, 1, NULL, '2024-06-11 08:34:36', '2024-06-11 08:35:24');

-- --------------------------------------------------------

--
-- Table structure for table `leave_schedules`
--

CREATE TABLE `leave_schedules` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `leave_request_id` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT 'all=1,half day morning=2,half day \r\nevening=3,other=4',
  `start_time` varchar(50) DEFAULT NULL,
  `end_time` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leave_schedules`
--

INSERT INTO `leave_schedules` (`id`, `employee_id`, `date`, `leave_request_id`, `type`, `start_time`, `end_time`, `created_at`, `updated_at`) VALUES
(9, 1, '2024-06-12', 4, 1, NULL, NULL, '2024-06-11 08:13:20', '2024-06-11 08:13:20'),
(10, 1, '2024-06-13', 4, 1, NULL, NULL, '2024-06-11 08:13:20', '2024-06-11 08:13:20'),
(11, 1, '2024-06-14', 4, 1, NULL, NULL, '2024-06-11 08:13:20', '2024-06-11 08:13:20'),
(12, 1, '2024-06-15', 4, 0, NULL, NULL, '2024-06-11 08:13:20', '2024-06-11 08:13:20'),
(13, 1, '2024-06-16', 4, 0, NULL, NULL, '2024-06-11 08:13:20', '2024-06-11 08:13:20'),
(14, 1, '2024-06-17', 4, 1, NULL, NULL, '2024-06-11 08:13:20', '2024-06-11 08:13:20'),
(15, 1, '2024-06-18', 4, 1, NULL, NULL, '2024-06-11 08:13:20', '2024-06-11 08:13:20'),
(16, 1, '2024-06-19', 4, 1, NULL, NULL, '2024-06-11 08:13:20', '2024-06-11 08:13:20'),
(17, 1, '2024-06-26', 5, 2, '08:00 AM', '12:00 PM', '2024-06-11 08:34:36', '2024-06-11 08:34:36'),
(18, 1, '2024-06-27', 5, 3, '12:00 PM', '04:00 PM', '2024-06-11 08:34:36', '2024-06-11 08:34:36'),
(19, 1, '2024-06-28', 5, 1, NULL, NULL, '2024-06-11 08:34:36', '2024-06-11 08:34:36');

-- --------------------------------------------------------

--
-- Table structure for table `leave_types`
--

CREATE TABLE `leave_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `color_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `leave_days` int(22) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leave_types`
--

INSERT INTO `leave_types` (`id`, `type`, `status`, `color_code`, `leave_days`, `created_at`, `updated_at`) VALUES
(1, 'Annual Leave', 1, '#54bce8', 5, '2023-10-19 11:13:53', '2024-06-02 04:02:55'),
(2, 'Public Holiday', 1, '#25251d', 1, '2023-10-19 11:13:53', '2024-06-11 08:14:11'),
(3, 'Purchased Leave', 1, '#38ff7e', 3, '2023-10-19 11:13:53', '2024-05-27 00:57:43'),
(4, 'Sick Leave', 1, '#878eb0', 2, '2023-10-19 11:13:53', '2024-05-27 01:03:05'),
(5, 'Study Leave/Training', 1, '#ff9999', 3, '2023-10-19 11:13:53', '2024-05-27 00:58:10'),
(6, 'Unpaid Leave', 0, '#0071c7', 5, '2023-10-19 11:13:53', '2024-06-02 04:04:04'),
(7, 'Test1', 0, '#ede612', 2, '2023-11-01 04:15:17', '2024-05-27 00:58:38'),
(8, 'Test', 1, '#d4fa6b', 6, '2023-11-01 04:17:02', '2024-05-27 00:58:25'),
(9, 'Casual leave', 0, '#c7c9ff', 3, '2024-05-04 05:16:32', '2024-05-27 00:57:22');

-- --------------------------------------------------------

--
-- Table structure for table `masters`
--

CREATE TABLE `masters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `masters`
--

INSERT INTO `masters` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'test', 'test@gmail.com', NULL, '$2y$10$iLNOIhEotGQz5G0jJNAMSeJC4rr2eDvFzm2YdLWvX7CF/03GQgMbu', NULL, '2024-03-09 07:14:44', '2024-03-09 07:14:44');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_10_05_174148_create_admins_table', 1),
(6, '2023_10_05_175014_create_masters_table', 1),
(7, '2023_10_07_132645_create_leave_requests_table', 1),
(8, '2023_10_07_140039_create_leave_types_table', 1),
(9, '2023_10_07_140245_create_upload_files_table', 1),
(10, '2023_10_25_054302_create_permission_tables', 2),
(11, '2023_10_26_054453_create_department_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(3, 'App\\Models\\User', 2),
(1, 'App\\Models\\User', 3),
(2, 'App\\Models\\User', 4),
(1, 'App\\Models\\User', 7),
(1, 'App\\Models\\User', 10),
(3, 'App\\Models\\User', 14),
(1, 'App\\Models\\User', 16),
(3, 'App\\Models\\User', 17),
(1, 'App\\Models\\User', 18);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pdf_uploads`
--

CREATE TABLE `pdf_uploads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `performances`
--

CREATE TABLE `performances` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `review_temp` text,
  `goal_id` int(11) DEFAULT NULL,
  `start_date` varchar(11) DEFAULT NULL,
  `end_date` varchar(11) DEFAULT NULL,
  `due_date` varchar(11) DEFAULT NULL,
  `status` int(11) DEFAULT '0' COMMENT '0-pending, 1-employee-accept, 2- manager-accept',
  `assign_manager_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `performance_goals`
--

CREATE TABLE `performance_goals` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `manager_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `description` text,
  `due_date` varchar(255) DEFAULT NULL,
  `performance_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'role', 'web', NULL, NULL),
(2, 'employee', 'web', NULL, NULL),
(3, 'leave', 'web', NULL, NULL),
(4, 'department', 'web', NULL, NULL),
(5, 'employee-leave', 'web', NULL, NULL),
(6, 'leave-type', 'web', NULL, NULL),
(7, 'calendar', 'web', NULL, NULL),
(8, 'goal', 'web', NULL, NULL),
(9, 'performance', 'web', NULL, NULL),
(10, 'work-force-overview', 'web', NULL, NULL),
(11, 'appraisal', 'web', NULL, NULL),
(12, 'training', 'web', '2024-05-04 09:30:12', '2024-05-04 09:30:12'),
(13, 'creat-appraisal', 'web', NULL, NULL),
(14, 'respond-on-appraisal', 'web', NULL, NULL),
(15, 'edit-appraisal', 'web', NULL, NULL),
(16, 'task', 'web', NULL, NULL),
(17, 'creat-training', 'web', '2024-05-15 06:39:33', '2024-05-15 06:39:33'),
(18, 'create-disciplinary', 'web', '2024-05-15 06:39:33', '2024-05-15 06:39:33'),
(19, 'my-resources', 'web', '2024-05-28 08:10:10', '2024-05-28 08:10:10'),
(20, 'add-delete-my-resources', 'web', '2024-06-10 10:47:45', '2024-06-10 10:47:45'),
(21, 'view-team-leave', 'web', '2024-06-10 10:47:45', '2024-06-10 10:47:45'),
(22, 'wages-and-benefits', 'web', '2024-06-10 10:48:26', '2024-06-10 10:48:26');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questionnaires`
--

CREATE TABLE `questionnaires` (
  `id` int(11) NOT NULL,
  `appraisal_id` int(11) DEFAULT NULL,
  `que_key` bigint(22) DEFAULT NULL,
  `que_employ_value` longtext,
  `que_manager_value` longtext,
  `employ_id` int(11) DEFAULT NULL,
  `manager_id` bigint(22) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `que_self_rating` int(11) DEFAULT NULL,
  `que_manager_rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questionnaires`
--

INSERT INTO `questionnaires` (`id`, `appraisal_id`, `que_key`, `que_employ_value`, `que_manager_value`, `employ_id`, `manager_id`, `created_at`, `updated_at`, `que_self_rating`, `que_manager_rating`) VALUES
(1, 3, 20, 'Below Expectations', NULL, 1, NULL, '2024-07-25 00:31:09', '2024-07-25 00:31:09', 2, NULL),
(2, 4, 20, 'Exceeds Expectations', 'Meets Expectations', 1, 4, '2024-07-26 06:02:03', '2024-07-26 06:36:13', 4, 3),
(3, 5, 20, 'Below Expectations', NULL, 1, NULL, '2024-07-26 06:20:59', '2024-07-26 06:20:59', 2, NULL),
(4, 6, 20, 'Meets Expectations', NULL, 1, NULL, '2024-07-26 06:33:27', '2024-07-26 06:33:27', 3, NULL),
(5, 7, 20, 'Exceeds Expectations', NULL, 1, NULL, '2024-07-26 06:38:30', '2024-07-26 06:38:30', 4, NULL),
(6, 7, 24, 'test', NULL, 1, NULL, '2024-07-26 06:38:30', '2024-07-26 06:38:30', 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `que_forms`
--

CREATE TABLE `que_forms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `que_forms`
--

INSERT INTO `que_forms` (`id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(9, 'test 2', 1, '2024-07-25 00:28:41', '2024-07-26 06:32:42'),
(10, 'test', 0, '2024-07-26 05:43:35', '2024-07-26 05:43:35'),
(11, 'gdf', 1, '2024-07-26 06:31:09', '2024-07-26 06:32:39');

-- --------------------------------------------------------

--
-- Table structure for table `que_form_inputs`
--

CREATE TABLE `que_form_inputs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `que_form_id` bigint(20) UNSIGNED DEFAULT NULL,
  `que_form_section_id` bigint(20) UNSIGNED DEFAULT NULL,
  `label` text COLLATE utf8mb4_unicode_ci,
  `placeholder` text COLLATE utf8mb4_unicode_ci,
  `input_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `input_name` text COLLATE utf8mb4_unicode_ci,
  `rating_id` bigint(22) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `que_form_inputs`
--

INSERT INTO `que_form_inputs` (`id`, `que_form_id`, `que_form_section_id`, `label`, `placeholder`, `input_type_id`, `input_name`, `rating_id`, `created_at`, `updated_at`) VALUES
(20, 9, 13, 'eq', NULL, 9, 'test-rating-1721887118', 2, '2024-07-25 00:28:41', '2024-07-25 00:28:41'),
(21, 10, 14, 'test', NULL, 11, 'test-goal-1721992411', 1, '2024-07-26 05:43:35', '2024-07-26 05:43:35'),
(22, 11, 15, 'gdg', 'df', 3, 'gdf-input-number-1721995254', NULL, '2024-07-26 06:31:09', '2024-07-26 06:31:09'),
(23, 11, 16, 'gdgd', 'gdfg', 1, 'gdf-input-text-1721995266', NULL, '2024-07-26 06:31:09', '2024-07-26 06:31:09'),
(24, 9, 13, 'test', NULL, 11, NULL, 3, '2024-07-26 06:37:31', '2024-07-26 06:37:38');

-- --------------------------------------------------------

--
-- Table structure for table `que_form_multiple_inputs`
--

CREATE TABLE `que_form_multiple_inputs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `que_form_id` bigint(20) DEFAULT NULL,
  `label` text COLLATE utf8mb4_unicode_ci,
  `type` text COLLATE utf8mb4_unicode_ci,
  `temp_input_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `que_form_sections`
--

CREATE TABLE `que_form_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `que_form_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sec_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `que_form_sections`
--

INSERT INTO `que_form_sections` (`id`, `que_form_id`, `title`, `sec_id`, `status`, `created_at`, `updated_at`) VALUES
(13, 9, 'test', 'sec1721887092', 0, '2024-07-25 00:28:41', '2024-07-25 00:28:41'),
(14, 10, 'test', 'sec1721992150', 0, '2024-07-26 05:43:35', '2024-07-26 05:43:35'),
(15, 11, 'dgdf', 'sec1721995243', 0, '2024-07-26 06:31:09', '2024-07-26 06:31:09'),
(16, 11, 'dfgdgd', 'sec1721995256', 0, '2024-07-26 06:31:09', '2024-07-26 06:31:09');

-- --------------------------------------------------------

--
-- Table structure for table `rating_scales`
--

CREATE TABLE `rating_scales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(255) NOT NULL,
  `is_include_na` tinyint(1) NOT NULL DEFAULT '0',
  `display_type` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating_scales`
--

INSERT INTO `rating_scales` (`id`, `label`, `is_include_na`, `display_type`, `created_at`, `updated_at`) VALUES
(1, 'Communicates effectively with supervisor, peers, and customers.', 0, 0, '2024-05-04 05:09:16', '2024-05-09 00:21:35'),
(2, 'Possesses skills and knowledge to perform the job competently.', 0, 0, '2024-05-04 06:56:52', '2024-05-09 00:20:56'),
(3, 'test', 1, 0, '2024-05-15 03:54:19', '2024-05-15 03:54:35'),
(4, 'Possesses skills and knowledge to perform the job competently.', 0, 1, '2024-06-11 08:12:33', '2024-06-11 08:12:33');

-- --------------------------------------------------------

--
-- Table structure for table `rating_scale_options`
--

CREATE TABLE `rating_scale_options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rating_scale_id` bigint(20) UNSIGNED NOT NULL,
  `option_label` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating_scale_options`
--

INSERT INTO `rating_scale_options` (`id`, `rating_scale_id`, `option_label`, `created_at`, `updated_at`) VALUES
(13, 1, 'Below Expectations', '2024-05-09 00:21:35', '2024-05-09 00:21:35'),
(12, 1, 'Needs Improvement', '2024-05-09 00:21:35', '2024-05-09 00:21:35'),
(7, 2, 'Needs Improvement', '2024-05-09 00:20:56', '2024-05-09 00:20:56'),
(8, 2, 'Below Expectations', '2024-05-09 00:20:56', '2024-05-09 00:20:56'),
(9, 2, 'Meets Expectations', '2024-05-09 00:20:56', '2024-05-09 00:20:56'),
(10, 2, 'Exceeds Expectations', '2024-05-09 00:20:56', '2024-05-09 00:20:56'),
(11, 2, 'Exceptional', '2024-05-09 00:20:56', '2024-05-09 00:20:56'),
(14, 1, 'Meets Expectations', '2024-05-09 00:21:35', '2024-05-09 00:21:35'),
(15, 1, 'Exceeds Expectations', '2024-05-09 00:21:35', '2024-05-09 00:21:35'),
(16, 1, 'Exceptional', '2024-05-09 00:21:35', '2024-05-09 00:21:35'),
(20, 3, 'test2', '2024-05-15 03:54:35', '2024-05-15 03:54:35'),
(19, 3, 'test', '2024-05-15 03:54:35', '2024-05-15 03:54:35'),
(21, 4, 'Below Expectations', '2024-06-11 08:12:33', '2024-06-11 08:12:33'),
(22, 4, 'Needs Improvement', '2024-06-11 08:12:33', '2024-06-11 08:12:33'),
(23, 4, 'Meets Expectations', '2024-06-11 08:12:33', '2024-06-11 08:12:33'),
(24, 4, 'Exceeds Expectations', '2024-06-11 08:12:33', '2024-06-11 08:12:33');

-- --------------------------------------------------------

--
-- Table structure for table `reportees`
--

CREATE TABLE `reportees` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `reportee_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reportees`
--

INSERT INTO `reportees` (`id`, `employee_id`, `reportee_id`, `created_at`, `updated_at`) VALUES
(14, 11, 3, '2024-05-04 10:37:54', '2024-05-04 10:37:54'),
(15, 12, 3, '2024-05-04 10:38:14', '2024-05-04 10:38:14'),
(16, 13, 3, '2024-05-04 10:38:49', '2024-05-04 10:38:49'),
(17, 14, 1, '2024-05-04 10:55:20', '2024-05-04 10:55:20'),
(19, 4, 1, '2024-05-16 14:47:06', '2024-05-16 14:47:06'),
(20, 4, 3, '2024-05-16 14:47:06', '2024-05-16 14:47:06'),
(21, 4, 7, '2024-05-16 14:47:07', '2024-05-16 14:47:07'),
(22, 4, 10, '2024-05-16 14:47:07', '2024-05-16 14:47:07'),
(23, 17, 16, '2024-05-29 16:10:31', '2024-05-29 16:10:31'),
(24, 18, 1, '2024-05-31 10:10:41', '2024-05-31 10:10:41'),
(25, 10, 7, '2024-06-28 14:20:50', '2024-06-28 14:20:50');

-- --------------------------------------------------------

--
-- Table structure for table `responsibilities`
--

CREATE TABLE `responsibilities` (
  `id` int(22) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `discription` text,
  `time` varchar(255) DEFAULT NULL,
  `total_progress` varchar(255) DEFAULT NULL,
  `user_id` int(22) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `responsibilities`
--

INSERT INTO `responsibilities` (`id`, `title`, `status`, `discription`, `time`, `total_progress`, `user_id`, `created_at`, `updated_at`) VALUES
(7, 'test', 'Active', 'asdf', '1719481630', 'NaN', 2, '2024-06-27 09:47:18', '2024-06-27 13:45:00'),
(8, 'test-rest', 'Archived', 'test', '1719492480', '52.5', 1, '2024-06-27 12:48:05', '2024-06-27 12:57:26');

-- --------------------------------------------------------

--
-- Table structure for table `review_cycles`
--

CREATE TABLE `review_cycles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `review_cycles`
--

INSERT INTO `review_cycles` (`id`, `title`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`) VALUES
(2, 'test2', '2024-06-19', '2024-06-28', 1, '2024-06-19 05:49:36', '2024-06-19 09:14:06'),
(3, '3rd quarter 2024', '2024-07-01', '2024-09-30', 1, '2024-06-28 08:22:45', '2024-06-28 08:22:45');

-- --------------------------------------------------------

--
-- Table structure for table `review_templates`
--

CREATE TABLE `review_templates` (
  `id` int(11) NOT NULL,
  `temp_name` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `review_templates`
--

INSERT INTO `review_templates` (`id`, `temp_name`, `created_at`, `updated_at`) VALUES
(1, 'review 2014', '2023-12-04 09:39:36', '2023-12-04 09:39:36'),
(2, 'review 2015', '2023-12-04 09:39:42', '2023-12-04 09:39:42'),
(3, 'review 2016', '2023-12-04 09:39:42', '2023-12-04 09:39:42');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Employee', 'web', '2023-10-31 02:18:18', '2023-11-10 00:24:27'),
(2, 'Manager', 'web', '2023-10-31 03:31:56', '2023-11-01 01:40:03'),
(3, 'HR', 'web', '2023-11-01 01:54:22', '2023-11-01 01:54:22');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(8, 1),
(9, 1),
(12, 1),
(17, 1),
(19, 1),
(3, 2),
(5, 2),
(7, 2),
(8, 2),
(9, 2),
(11, 2),
(12, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(21, 2),
(1, 3),
(2, 3),
(3, 3),
(4, 3),
(5, 3),
(6, 3),
(7, 3),
(8, 3),
(9, 3),
(10, 3),
(11, 3),
(12, 3),
(13, 3),
(15, 3),
(16, 3),
(17, 3),
(18, 3),
(19, 3),
(20, 3),
(21, 3),
(22, 3);

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `skills` text,
  `experience` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `employee_id`, `skills`, `experience`, `created_at`, `updated_at`) VALUES
(10, 16, 'Public Speaking', '4', '2024-06-28 09:07:34', '2024-06-28 09:07:34'),
(9, 1, 'computer', '6 month', '2024-06-11 08:19:20', '2024-06-11 08:19:20');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `start_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `temp_input_types`
--

CREATE TABLE `temp_input_types` (
  `id` int(22) NOT NULL,
  `label` varchar(255) DEFAULT NULL,
  `input_type_id` int(22) DEFAULT NULL,
  `placeholder` varchar(255) DEFAULT NULL,
  `input_name` text,
  `rating_id` bigint(22) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `temp_input_types`
--

INSERT INTO `temp_input_types` (`id`, `label`, `input_type_id`, `placeholder`, `input_name`, `rating_id`, `created_at`, `updated_at`) VALUES
(1, 'Current position description; if applicable, make note of any significant changes since last year’s performance review.', 5, 'Current position description', 'self-review-textarea-1715233360', NULL, '2024-05-09 00:12:40', '2024-05-09 00:12:40'),
(2, 'If performance goals were set at the last performance review, add here a copy of those goals and comment on the progress.', 5, 'performance goals', 'self-review-textarea-1715233378', NULL, '2024-05-09 00:12:58', '2024-05-09 00:12:58'),
(15, 'how you find the work so far', 1, 'Description', 'mid-year-review-input-text-1715751007', NULL, '2024-05-15 00:00:07', '2024-05-15 00:00:07'),
(16, 'what do you love about the job', 1, 'Description', 'mid-year-review-input-text-1715751035', NULL, '2024-05-15 00:00:35', '2024-05-15 00:00:35'),
(17, 'rate the work', 9, NULL, 'mid-year-review-rating-1715751059', 1, '2024-05-15 00:00:59', '2024-05-15 00:00:59'),
(22, 'name', 1, 'name', 'test2-input-text-1715753611', NULL, '2024-05-15 00:43:31', '2024-05-15 00:43:31'),
(23, 'number', 3, 'Number', 'test2-input-number-1715753642', NULL, '2024-05-15 00:44:02', '2024-05-15 00:44:02'),
(29, 'jm', 9, NULL, 'jk-rating-1715765095', 3, '2024-05-15 03:54:55', '2024-05-15 03:54:55'),
(30, 'how do you find the job assigned', 8, NULL, 'mid-year-review-dropdown-1716697528', NULL, '2024-05-25 22:55:28', '2024-05-25 22:55:28'),
(31, 'Ability to wok independently', 8, 'Insert response here', 'mid-year-review-dropdown-1716698307', NULL, '2024-05-25 23:08:27', '2024-05-25 23:08:27'),
(32, 'Onboarding of New Clients', 8, NULL, 'full-year-review-dropdown-1716701787', NULL, '2024-05-26 00:06:27', '2024-05-26 00:06:27');

-- --------------------------------------------------------

--
-- Table structure for table `temp_multiple_input_options`
--

CREATE TABLE `temp_multiple_input_options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `temp_input_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `temp_multiple_input_options`
--

INSERT INTO `temp_multiple_input_options` (`id`, `label`, `type`, `temp_input_id`, `created_at`, `updated_at`) VALUES
(1, 'ok', 'select', 30, '2024-05-25 22:55:28', '2024-05-25 22:55:28'),
(2, 'difficult', 'select', 30, '2024-05-25 22:55:28', '2024-05-25 22:55:28'),
(3, 'Works independently with no supervision', 'select', 31, '2024-05-25 23:08:27', '2024-05-25 23:08:27'),
(4, 'Can work independently with little supervision', 'select', 31, '2024-05-25 23:08:27', '2024-05-25 23:08:27'),
(5, 'Requires constant supervision', 'select', 31, '2024-05-25 23:08:27', '2024-05-25 23:08:27'),
(6, 'Cannot work independently', 'select', 31, '2024-05-25 23:08:27', '2024-05-25 23:08:27'),
(7, 'Excellent Knowledge', 'select', 32, '2024-05-26 00:06:27', '2024-05-26 00:06:27'),
(8, 'Good Knowledge', 'select', 32, '2024-05-26 00:06:27', '2024-05-26 00:06:27'),
(9, 'Basic Knowledge', 'select', 32, '2024-05-26 00:06:27', '2024-05-26 00:06:27'),
(10, 'Poor Knowledge', 'select', 32, '2024-05-26 00:06:27', '2024-05-26 00:06:27');

-- --------------------------------------------------------

--
-- Table structure for table `trainings`
--

CREATE TABLE `trainings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `start_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certificate` int(11) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `institution_or_training_provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `completion_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certificate_award` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trainings`
--

INSERT INTO `trainings` (`id`, `title`, `status`, `description`, `start_time`, `end_time`, `certificate`, `user_id`, `institution_or_training_provider`, `start_date`, `completion_date`, `certificate_award`, `created_at`, `updated_at`) VALUES
(10, 'testing', 1, 'test', NULL, NULL, 1, 3, 'test', '2024-06-12', '2024-06-14', NULL, '2024-06-11 08:21:16', '2024-06-11 08:22:03'),
(11, 'testing', 1, 'test', NULL, NULL, 1, 4, 'test', '2024-06-19', '2024-06-12', NULL, '2024-06-11 08:40:37', '2024-06-11 08:40:58');

-- --------------------------------------------------------

--
-- Table structure for table `upload_files`
--

CREATE TABLE `upload_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_uid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `upload_files`
--

INSERT INTO `upload_files` (`id`, `file`, `file_uid`, `created_at`, `updated_at`) VALUES
(10, '1718114119.jpg', NULL, '2024-06-11 08:25:19', '2024-06-11 08:25:19'),
(11, '1718114121.jpg', NULL, '2024-06-11 08:25:21', '2024-06-11 08:25:21'),
(12, '1721992501.png', NULL, '2024-07-26 05:45:01', '2024-07-26 05:45:01'),
(13, '1721992936.jpg', NULL, '2024-07-26 05:52:16', '2024-07-26 05:52:16'),
(14, '1721993000.jpg', NULL, '2024-07-26 05:53:20', '2024-07-26 05:53:20'),
(15, '1721993036.png', NULL, '2024-07-26 05:53:56', '2024-07-26 05:53:56'),
(16, '1721993045.png', NULL, '2024-07-26 05:54:05', '2024-07-26 05:54:05'),
(17, '1721993059.png', NULL, '2024-07-26 05:54:19', '2024-07-26 05:54:19'),
(18, '1721993085.png', NULL, '2024-07-26 05:54:45', '2024-07-26 05:54:45');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `employment_start` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employment_end` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reporting_to` int(11) DEFAULT NULL,
  `manager_id` int(11) DEFAULT NULL,
  `d_o_b` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employee_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_login` int(11) NOT NULL DEFAULT '0' COMMENT 'admin=0,user=1',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `national_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` bigint(20) UNSIGNED DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nationality` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marital_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emergency_contact` bigint(20) UNSIGNED DEFAULT NULL,
  `language_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_id` bigint(20) UNSIGNED DEFAULT NULL,
  `residention_address` longtext COLLATE utf8mb4_unicode_ci,
  `job_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `department_id`, `employment_start`, `employment_end`, `reporting_to`, `manager_id`, `d_o_b`, `employee_code`, `is_login`, `email_verified_at`, `password`, `remember_token`, `national_id`, `phone_number`, `gender`, `nationality`, `marital_status`, `emergency_contact`, `language_id`, `file_id`, `residention_address`, `job_title`, `created_at`, `updated_at`) VALUES
(1, 'Chetan Bairag', 'chetan@gmail.com', 1, '2023-10-25', NULL, 4, 4, '2023-10-04', 'CHETAN1989', 0, NULL, '$2y$10$VlZhAqtBpCA0375u6JKxRe6p9nVLh0rlk8uRRr0L0sey3Pdd.DiQS', 'qpm7Okx2lvmoD3jvxnE8FtQd7hS1uFZM2dZN6kfblIAfqAIRistT8qSL0sbU', '658-87-45', 987654321, 'male', '2', 'single', NULL, '2,3', NULL, 'test', NULL, '2023-10-31 05:11:58', '2024-05-16 09:15:05'),
(2, 'HR', 'hr@gmail.com', 2, '2023-10-26', NULL, 4, 4, '2023-10-12', 'RAHUL1989', 0, NULL, '$2y$10$rj4ksNIEClukFhu0/XtxjuiX83l5J4rRzv.rSycrTNG1IbQn6NWTm', 'yLLeItrtAElNh9NS3ftNF4Yhr3c5A1lyVMEHZLIvbAeNMPWDiB9ZPv2ohyOv', '658-87-45', 987654321, 'male', '1', 'single', NULL, '2', NULL, 'test', NULL, '2023-10-31 05:19:04', '2024-05-29 10:32:33'),
(3, 'Rahul Parmar', 'rahul@gmail.com', 3, '2023-11-15', NULL, 4, 4, '2023-11-15', 'RAHUL1989', 0, NULL, '$2y$10$I663JuUbKheBkoG/pyGIoOFeVvQ7eJa0oosC3Gv6BMDXd5VK6yl2.', 'H42SlpuhgGn7jR130w0gHcgyN0hMYdZLp2TDXbIEIUpfmrrNPYiqVwjBaF5h', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-01 01:38:18', '2024-05-04 06:27:20'),
(4, 'Kishor Kumar', 'kishor@gmail.com', 1, '2023-11-08', NULL, 2, 4, '2023-11-15', 'KISHOR1989', 0, NULL, '$2y$10$I663JuUbKheBkoG/pyGIoOFeVvQ7eJa0oosC3Gv6BMDXd5VK6yl2.', 'ivSwkvMRwx6ZyXoZvSTW0WMsahU2ZxxKfa7Wo39BG5PixR7KEaXExkuZD6Lx', '658-87-45', 987654321, 'male', '101', 'single', NULL, '2,3', 11, 'test', NULL, '2023-11-01 01:41:33', '2024-06-11 08:25:21'),
(7, 'Vishal Mukati', 'vishal@gmail.com', 1, '2023-11-07', NULL, 1, 4, '2023-11-22', 'VISHAL1989', 0, NULL, '$2y$10$I663JuUbKheBkoG/pyGIoOFeVvQ7eJa0oosC3Gv6BMDXd5VK6yl2.', 'niswFcwGhb8YCutGWEd7Ul4PVfs7H7y93DkXd1imRhEMsBNUgItKcB0nkgFN', '658-87-45', 987654321, 'male', '82', 'married', NULL, '2,3', NULL, 'test', NULL, '2023-11-01 02:04:03', '2024-05-16 09:18:00'),
(10, 'Abhishek Patel1', 'abhishek@gmail.com', 1, '2023-11-15', NULL, 1, 3, '2023-11-21', 'ABHISHEK1989', 0, NULL, '$2y$10$I663JuUbKheBkoG/pyGIoOFeVvQ7eJa0oosC3Gv6BMDXd5VK6yl2.', 'o0OVtu5uXmYaXeqjj4JzVnfWFpBKDxL91uYz1yPIZrER5kqTMjzq8ssjfOhH', '658-87-45', 987654321, 'male', '3', 'single', NULL, '3', NULL, 'Glacis, Mahe, Seychelles', 'Programmer', '2023-11-01 03:48:56', '2024-06-28 08:50:50'),
(14, 'atul', 'atul@gmail.com', 3, '2024-05-09', NULL, 4, 3, '2024-05-08', 'test@12', 0, NULL, '$2y$10$U5SCUuCpAy9rf8QpiWzHk.Mn5Fn0aJZvVJRf7PqezCy3CMAbrWsMq', NULL, '658-87-45', 987654321, 'male', 'Indian', 'single', 987654321, '2,3', NULL, NULL, NULL, '2024-05-04 05:25:20', '2024-05-04 05:25:20'),
(16, 'Elton', 'elton@gmail.com', 3, '2024-05-05', NULL, 2, 4, '2012-05-03', '001', 0, NULL, '$2y$10$cG2RLlKuPRwD8zALlJ4NUumNlU4EN8goTCDHeGmq.Mc8gICkF0ivC', 'AZKVG1BkZ4h6enK5sC4GWUP79ZD9FmvMpD1Eg2uceIyRMgbkFbMTagkotz9z', '6388895993000230', 2589117, 'male', '194', 'married', NULL, '3', 12, 'Mahe', 'test', '2024-05-05 01:39:36', '2024-07-26 05:45:01'),
(17, 'Cosette', 'cosette@gmail.com', 2, '2024-05-29', NULL, 2, 4, '2024-05-13', '01', 0, NULL, '$2y$10$hSKrWBYIM7cfk4yhQJCiieGb7s0QikGjpIfJCs4nZ/Kmykn/slBHa', NULL, '4445789088', 2589117, 'female', '194', 'married', NULL, '3', NULL, 'Mahe', NULL, '2024-05-29 10:40:31', '2024-05-29 10:40:31'),
(18, 'test3105', 'test-3105@yopmail.com', 1, '2024-05-31', NULL, 1, 4, '2024-05-01', '9630258', 0, NULL, '$2y$10$UvtFNjxZrQmY98GGPYtfwu3bsDtT/Mxl3H3pTBBDwUBRdUNQyMzwK', 'zmqHL5kIj3cGcvCYqXFyio5aRPUKyfdcO42JEaT3UOTrkrwor1rXbQBl87MT', '546654645565', 7896585214, 'male', '101', 'married', NULL, '2,3', NULL, 'test', NULL, '2024-05-31 04:40:41', '2024-05-31 04:40:41');

-- --------------------------------------------------------

--
-- Table structure for table `wages_and_benefits`
--

CREATE TABLE `wages_and_benefits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `items` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wages_and_benefits`
--

INSERT INTO `wages_and_benefits` (`id`, `user_id`, `items`, `currency`, `amount`, `created_at`, `updated_at`) VALUES
(1, 1, 'Gross Basic Salary', 'SRC', '220', '2024-06-07 10:54:03', '2024-06-07 10:54:03'),
(2, 1, 'On call allowance ', 'SCR', '1200', '2024-06-07 12:00:22', '2024-06-07 12:00:22'),
(3, 1, 'Housing Allowance', 'SCR', '3500', '2024-06-07 12:00:22', '2024-06-07 12:00:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `appraisals`
--
ALTER TABLE `appraisals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assess_potentials`
--
ALTER TABLE `assess_potentials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `certificate`
--
ALTER TABLE `certificate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_announcements`
--
ALTER TABLE `company_announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `competencies`
--
ALTER TABLE `competencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `developments`
--
ALTER TABLE `developments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `disciplinary_letters`
--
ALTER TABLE `disciplinary_letters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document_categories`
--
ALTER TABLE `document_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `educations`
--
ALTER TABLE `educations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emergency_contacts`
--
ALTER TABLE `emergency_contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `goals`
--
ALTER TABLE `goals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `goal_categories`
--
ALTER TABLE `goal_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `goal_statuses`
--
ALTER TABLE `goal_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `input_types`
--
ALTER TABLE `input_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `key_results`
--
ALTER TABLE `key_results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_schedules`
--
ALTER TABLE `leave_schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_types`
--
ALTER TABLE `leave_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `masters`
--
ALTER TABLE `masters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `masters_email_unique` (`email`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pdf_uploads`
--
ALTER TABLE `pdf_uploads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `performances`
--
ALTER TABLE `performances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `performance_goals`
--
ALTER TABLE `performance_goals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `questionnaires`
--
ALTER TABLE `questionnaires`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `que_forms`
--
ALTER TABLE `que_forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `que_form_inputs`
--
ALTER TABLE `que_form_inputs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `que_form_multiple_inputs`
--
ALTER TABLE `que_form_multiple_inputs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `que_form_sections`
--
ALTER TABLE `que_form_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating_scales`
--
ALTER TABLE `rating_scales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating_scale_options`
--
ALTER TABLE `rating_scale_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rating_scale_id` (`rating_scale_id`);

--
-- Indexes for table `reportees`
--
ALTER TABLE `reportees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `responsibilities`
--
ALTER TABLE `responsibilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review_cycles`
--
ALTER TABLE `review_cycles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review_templates`
--
ALTER TABLE `review_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_input_types`
--
ALTER TABLE `temp_input_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_multiple_input_options`
--
ALTER TABLE `temp_multiple_input_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trainings`
--
ALTER TABLE `trainings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trainings_user_id_foreign` (`user_id`);

--
-- Indexes for table `upload_files`
--
ALTER TABLE `upload_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `wages_and_benefits`
--
ALTER TABLE `wages_and_benefits`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appraisals`
--
ALTER TABLE `appraisals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `assess_potentials`
--
ALTER TABLE `assess_potentials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `certificate`
--
ALTER TABLE `certificate`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `company_announcements`
--
ALTER TABLE `company_announcements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `competencies`
--
ALTER TABLE `competencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `developments`
--
ALTER TABLE `developments`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `disciplinary_letters`
--
ALTER TABLE `disciplinary_letters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `document_categories`
--
ALTER TABLE `document_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `educations`
--
ALTER TABLE `educations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `emergency_contacts`
--
ALTER TABLE `emergency_contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `goals`
--
ALTER TABLE `goals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `goal_categories`
--
ALTER TABLE `goal_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `goal_statuses`
--
ALTER TABLE `goal_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `input_types`
--
ALTER TABLE `input_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `key_results`
--
ALTER TABLE `key_results`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `leave_requests`
--
ALTER TABLE `leave_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `leave_schedules`
--
ALTER TABLE `leave_schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `leave_types`
--
ALTER TABLE `leave_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `masters`
--
ALTER TABLE `masters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pdf_uploads`
--
ALTER TABLE `pdf_uploads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `performances`
--
ALTER TABLE `performances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `performance_goals`
--
ALTER TABLE `performance_goals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questionnaires`
--
ALTER TABLE `questionnaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `que_forms`
--
ALTER TABLE `que_forms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `que_form_inputs`
--
ALTER TABLE `que_form_inputs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `que_form_multiple_inputs`
--
ALTER TABLE `que_form_multiple_inputs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `que_form_sections`
--
ALTER TABLE `que_form_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `rating_scales`
--
ALTER TABLE `rating_scales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rating_scale_options`
--
ALTER TABLE `rating_scale_options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `reportees`
--
ALTER TABLE `reportees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `responsibilities`
--
ALTER TABLE `responsibilities`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `review_cycles`
--
ALTER TABLE `review_cycles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `review_templates`
--
ALTER TABLE `review_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temp_input_types`
--
ALTER TABLE `temp_input_types`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `temp_multiple_input_options`
--
ALTER TABLE `temp_multiple_input_options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `trainings`
--
ALTER TABLE `trainings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `upload_files`
--
ALTER TABLE `upload_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `wages_and_benefits`
--
ALTER TABLE `wages_and_benefits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `trainings`
--
ALTER TABLE `trainings`
  ADD CONSTRAINT `trainings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
