-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2024 at 03:52 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `erp_new`
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
  `is_admin` int(22) DEFAULT 0,
  `time` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id`, `date`, `title`, `user_id`, `goal_id`, `competencies_id`, `responsibilities_id`, `developments_id`, `is_admin`, `time`, `created_at`, `updated_at`) VALUES
(1, '2024-08-08', 'created this entry', 4, 1, NULL, NULL, NULL, 0, NULL, '2024-08-08 10:55:14', '2024-08-08 10:55:14'),
(2, '2024-08-08', 'update this entry', 4, 1, NULL, NULL, NULL, 0, '1723114478', '2024-08-08 10:56:47', '2024-08-08 10:56:50'),
(3, '2024-08-08', 'created this entry', 4, NULL, 1, NULL, NULL, 0, NULL, '2024-08-08 10:59:56', '2024-08-08 10:59:56'),
(4, '2024-08-08', 'update this entry', 16, NULL, NULL, 1, NULL, 0, '1723114897', '2024-08-08 11:04:03', '2024-08-08 11:04:24'),
(5, '2024-08-08', 'update this entry', 16, NULL, NULL, NULL, NULL, 0, NULL, '2024-08-08 11:04:20', '2024-08-08 11:04:20'),
(6, '2024-08-08', 'created this entry', 16, NULL, NULL, 1, NULL, 0, NULL, '2024-08-08 11:04:24', '2024-08-08 11:04:24'),
(7, '2024-08-08', 'created this entry', 4, NULL, NULL, NULL, 1, 0, NULL, '2024-08-08 11:05:08', '2024-08-08 11:05:08'),
(8, '2024-08-11', 'update this entry', 16, 2, NULL, NULL, NULL, 0, '1723358435', '2024-08-11 06:41:59', '2024-08-11 06:42:03'),
(9, '2024-08-11', 'created this entry', 16, 2, NULL, NULL, NULL, 0, NULL, '2024-08-11 06:42:03', '2024-08-11 06:42:03'),
(10, '2024-08-11', 'update this entry', 16, 3, NULL, NULL, NULL, 0, '1723358528', '2024-08-11 06:45:45', '2024-08-11 06:46:20'),
(11, '2024-08-11', 'update this entry', 16, 3, NULL, NULL, NULL, 0, '1723358528', '2024-08-11 06:46:17', '2024-08-11 06:46:20'),
(12, '2024-08-11', 'created this entry', 16, 3, NULL, NULL, NULL, 0, NULL, '2024-08-11 06:46:20', '2024-08-11 06:46:20'),
(13, '2024-08-11', 'update this entry', 16, 3, NULL, NULL, NULL, 0, NULL, '2024-08-11 06:46:40', '2024-08-11 06:46:40'),
(14, '2024-08-11', 'update this entry', 16, 3, NULL, NULL, NULL, 0, NULL, '2024-08-11 06:46:50', '2024-08-11 06:46:50'),
(15, '2024-08-11', 'update this entry', 16, 3, NULL, NULL, NULL, 0, NULL, '2024-08-11 06:47:02', '2024-08-11 06:47:02'),
(16, '2024-08-21', 'update this entry', 19, 4, NULL, NULL, NULL, 0, '1724231354', '2024-08-21 09:11:21', '2024-08-21 09:11:24'),
(17, '2024-08-21', 'created this entry', 19, 4, NULL, NULL, NULL, 0, NULL, '2024-08-21 09:11:24', '2024-08-21 09:11:24'),
(18, '2024-08-21', 'update this entry', 19, 5, NULL, NULL, NULL, 0, '1724231488', '2024-08-21 09:13:02', '2024-08-21 09:13:21'),
(19, '2024-08-21', 'created this entry', 19, 5, NULL, NULL, NULL, 0, NULL, '2024-08-21 09:13:21', '2024-08-21 09:13:21'),
(20, '2024-08-21', 'update this entry', 19, 6, NULL, NULL, NULL, 0, '1724231606', '2024-08-21 09:14:28', '2024-08-21 09:14:30'),
(21, '2024-08-21', 'created this entry', 19, 6, NULL, NULL, NULL, 0, NULL, '2024-08-21 09:14:30', '2024-08-21 09:14:30'),
(22, '2024-08-23', 'created this entry', 1, 7, NULL, NULL, NULL, 1, NULL, '2024-08-23 05:16:57', '2024-08-23 05:16:57'),
(23, '2024-08-23', 'update this entry', 1, 7, NULL, NULL, NULL, 1, '1724390190', '2024-08-23 05:18:01', '2024-08-23 05:18:04'),
(24, '2024-08-23', 'update this entry', 1, 8, NULL, NULL, NULL, 0, '1724390729', '2024-08-23 05:25:53', '2024-08-23 05:25:55'),
(25, '2024-08-23', 'created this entry', 1, 8, NULL, NULL, NULL, 0, NULL, '2024-08-23 05:25:55', '2024-08-23 05:25:55'),
(26, '2024-08-23', 'update this entry', 1, NULL, 2, NULL, NULL, 1, '1724395818', '2024-08-23 06:50:52', '2024-08-23 06:50:54'),
(27, '2024-08-23', 'created this entry', 1, NULL, 2, NULL, NULL, 1, NULL, '2024-08-23 06:50:54', '2024-08-23 06:50:54'),
(28, '2024-08-23', 'update this entry', 1, 9, NULL, NULL, NULL, 1, '1724416263', '2024-08-23 12:31:42', '2024-08-23 12:31:45'),
(29, '2024-08-23', 'created this entry', 1, 9, NULL, NULL, NULL, 1, NULL, '2024-08-23 12:31:45', '2024-08-23 12:31:45'),
(30, '2024-08-24', 'update this entry', 1, 10, NULL, NULL, NULL, 1, '1724477227', '2024-08-24 05:27:48', '2024-08-24 05:28:22'),
(31, '2024-08-24', 'created this entry', 1, 10, NULL, NULL, NULL, 1, NULL, '2024-08-24 05:28:22', '2024-08-24 05:28:22'),
(32, '2024-08-24', 'update this entry', 1, 11, NULL, NULL, NULL, 1, '1724481020', '2024-08-24 06:31:03', '2024-08-24 06:31:06'),
(33, '2024-08-24', 'created this entry', 1, 11, NULL, NULL, NULL, 1, NULL, '2024-08-24 06:31:06', '2024-08-24 06:31:06'),
(34, '2024-08-24', 'update this entry', 1, 12, NULL, NULL, NULL, 1, '1724502077', '2024-08-24 12:21:57', '2024-08-24 12:21:59'),
(35, '2024-08-24', 'created this entry', 1, 12, NULL, NULL, NULL, 1, NULL, '2024-08-24 12:21:59', '2024-08-24 12:21:59'),
(36, '2024-08-29', 'update this entry', 1, 13, NULL, NULL, NULL, 1, '1724909954', '2024-08-29 05:39:49', '2024-08-29 05:39:52'),
(37, '2024-08-29', 'created this entry', 1, 13, NULL, NULL, NULL, 1, NULL, '2024-08-29 05:39:52', '2024-08-29 05:39:52'),
(38, '2024-08-29', 'update this entry', 1, 14, NULL, NULL, NULL, 1, '1724909996', '2024-08-29 05:40:44', '2024-08-29 05:40:47'),
(39, '2024-08-29', 'created this entry', 1, 14, NULL, NULL, NULL, 1, NULL, '2024-08-29 05:40:47', '2024-08-29 05:40:47'),
(40, '2024-08-31', 'update this entry', 1, NULL, 3, NULL, NULL, 1, '1725099374', '2024-08-31 10:16:57', '2024-08-31 10:17:00'),
(41, '2024-08-31', 'created this entry', 1, NULL, 3, NULL, NULL, 1, NULL, '2024-08-31 10:17:00', '2024-08-31 10:17:00'),
(42, '2024-08-31', 'update this entry', 1, NULL, NULL, 2, NULL, 1, '1725106020', '2024-08-31 12:08:25', '2024-08-31 12:08:28'),
(43, '2024-08-31', 'created this entry', 1, NULL, NULL, 2, NULL, 1, NULL, '2024-08-31 12:08:28', '2024-08-31 12:08:28'),
(44, '2024-08-31', 'update this entry', 1, NULL, NULL, 3, NULL, 1, '1725106122', '2024-08-31 12:09:14', '2024-08-31 12:09:18'),
(45, '2024-08-31', 'created this entry', 1, NULL, NULL, 3, NULL, 1, NULL, '2024-08-31 12:09:18', '2024-08-31 12:09:18'),
(46, '2024-08-31', 'update this entry', 1, NULL, 4, NULL, NULL, 1, '1725106241', '2024-08-31 12:11:13', '2024-08-31 12:11:16'),
(47, '2024-08-31', 'created this entry', 1, NULL, 4, NULL, NULL, 1, NULL, '2024-08-31 12:11:16', '2024-08-31 12:11:16'),
(48, '2024-09-02', 'update this entry', 1, NULL, NULL, NULL, 2, 1, '1725256880', '2024-09-02 06:04:38', '2024-09-02 06:04:42'),
(49, '2024-09-02', 'created this entry', 1, NULL, NULL, NULL, 2, 1, NULL, '2024-09-02 06:04:41', '2024-09-02 06:04:41'),
(50, '2024-09-02', 'update this entry', 1, NULL, NULL, NULL, 3, 1, '1725257090', '2024-09-02 06:05:19', '2024-09-02 06:05:43'),
(51, '2024-09-02', 'update this entry', 1, NULL, NULL, NULL, NULL, 1, NULL, '2024-09-02 06:05:39', '2024-09-02 06:05:39'),
(52, '2024-09-02', 'created this entry', 1, NULL, NULL, NULL, 3, 1, NULL, '2024-09-02 06:05:43', '2024-09-02 06:05:43');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `data_key`, `data_value`, `old_vaue`, `activiy_id`, `created_at`, `updated_at`) VALUES
(1, 'Owner', 'Kishor Kumar', NULL, 1, '2024-08-08 10:55:14', '2024-08-08 10:55:14'),
(2, 'Title', 'test', NULL, 1, '2024-08-08 10:55:14', '2024-08-08 10:55:14'),
(3, 'Goal Category', 'Mid Year review 2024', NULL, 1, '2024-08-08 10:55:14', '2024-08-08 10:55:14'),
(4, 'Status', 'In Progress', NULL, 1, '2024-08-08 10:55:14', '2024-08-08 10:55:14'),
(5, 'Category', 'Customer experience', NULL, 1, '2024-08-08 10:55:14', '2024-08-08 10:55:14'),
(6, 'Key Result', 'test', NULL, 2, '2024-08-08 10:56:47', '2024-08-08 10:56:47'),
(7, 'Tracking', 'Quantifiable traget', NULL, 2, '2024-08-08 10:56:47', '2024-08-08 10:56:47'),
(8, 'Start', '0', NULL, 2, '2024-08-08 10:56:47', '2024-08-08 10:56:47'),
(9, 'Target', '100', NULL, 2, '2024-08-08 10:56:47', '2024-08-08 10:56:47'),
(10, 'Current', '25', NULL, 2, '2024-08-08 10:56:47', '2024-08-08 10:56:47'),
(11, 'Owner', 'Kishor Kumar', NULL, 3, '2024-08-08 10:59:56', '2024-08-08 10:59:56'),
(12, 'Title', 'test', NULL, 3, '2024-08-08 10:59:56', '2024-08-08 10:59:56'),
(13, 'Status', 'Active', NULL, 3, '2024-08-08 10:59:56', '2024-08-08 10:59:56'),
(14, 'Key Result', 'test', NULL, 4, '2024-08-08 11:04:03', '2024-08-08 11:04:03'),
(15, 'Tracking', 'Quantifiable traget', NULL, 4, '2024-08-08 11:04:03', '2024-08-08 11:04:03'),
(16, 'Start', '0', NULL, 4, '2024-08-08 11:04:03', '2024-08-08 11:04:03'),
(17, 'Target', '10', NULL, 4, '2024-08-08 11:04:03', '2024-08-08 11:04:03'),
(18, 'Current', '200', NULL, 4, '2024-08-08 11:04:03', '2024-08-08 11:04:03'),
(19, 'Key result', 'test', '10', 5, '2024-08-08 11:04:20', '2024-08-08 11:04:20'),
(20, 'Target', '100', '10', 5, '2024-08-08 11:04:20', '2024-08-08 11:04:20'),
(21, 'Key result', 'test', '200', 5, '2024-08-08 11:04:20', '2024-08-08 11:04:20'),
(22, 'Current', '20', '200', 5, '2024-08-08 11:04:20', '2024-08-08 11:04:20'),
(23, 'Owner', 'Elton', NULL, 6, '2024-08-08 11:04:24', '2024-08-08 11:04:24'),
(24, 'Title', 'WORK', NULL, 6, '2024-08-08 11:04:24', '2024-08-08 11:04:24'),
(25, 'Status', 'Active', NULL, 6, '2024-08-08 11:04:24', '2024-08-08 11:04:24'),
(26, 'Owner', 'Kishor Kumar', NULL, 7, '2024-08-08 11:05:08', '2024-08-08 11:05:08'),
(27, 'Title', 'ds', NULL, 7, '2024-08-08 11:05:08', '2024-08-08 11:05:08'),
(28, 'Status', 'Archived', NULL, 7, '2024-08-08 11:05:08', '2024-08-08 11:05:08'),
(29, 'Key Result', 'finish all 6 reports', NULL, 8, '2024-08-11 06:41:59', '2024-08-11 06:41:59'),
(30, 'Tracking', 'Quantifiable traget', NULL, 8, '2024-08-11 06:41:59', '2024-08-11 06:41:59'),
(31, 'Start', '0', NULL, 8, '2024-08-11 06:41:59', '2024-08-11 06:41:59'),
(32, 'Target', '6', NULL, 8, '2024-08-11 06:41:59', '2024-08-11 06:41:59'),
(33, 'Current', '4', NULL, 8, '2024-08-11 06:41:59', '2024-08-11 06:41:59'),
(34, 'Owner', 'Elton', NULL, 9, '2024-08-11 06:42:03', '2024-08-11 06:42:03'),
(35, 'Title', 'Finish All reports', NULL, 9, '2024-08-11 06:42:03', '2024-08-11 06:42:03'),
(36, 'Goal Category', 'Mid Year review 2024', NULL, 9, '2024-08-11 06:42:03', '2024-08-11 06:42:03'),
(37, 'Status', 'In Progress', NULL, 9, '2024-08-11 06:42:03', '2024-08-11 06:42:03'),
(38, 'Category', 'Operational excellence', NULL, 9, '2024-08-11 06:42:03', '2024-08-11 06:42:03'),
(39, 'Key Result', 'do safety online training', NULL, 10, '2024-08-11 06:45:45', '2024-08-11 06:45:45'),
(40, 'Tracking', 'Milestone', NULL, 10, '2024-08-11 06:45:45', '2024-08-11 06:45:45'),
(41, 'Traking', 'Pending', NULL, 10, '2024-08-11 06:45:45', '2024-08-11 06:45:45'),
(42, 'Key Result', 'do email safety training', NULL, 11, '2024-08-11 06:46:17', '2024-08-11 06:46:17'),
(43, 'Tracking', 'Milestone', NULL, 11, '2024-08-11 06:46:17', '2024-08-11 06:46:17'),
(44, 'Traking', 'Pending', NULL, 11, '2024-08-11 06:46:17', '2024-08-11 06:46:17'),
(45, 'Owner', 'Elton', NULL, 12, '2024-08-11 06:46:20', '2024-08-11 06:46:20'),
(46, 'Title', 'Do Security Training', NULL, 12, '2024-08-11 06:46:20', '2024-08-11 06:46:20'),
(47, 'Goal Category', 'Mid Year review 2024', NULL, 12, '2024-08-11 06:46:20', '2024-08-11 06:46:20'),
(48, 'Status', 'In Progress', NULL, 12, '2024-08-11 06:46:20', '2024-08-11 06:46:20'),
(49, 'Category', 'Leadership development', NULL, 12, '2024-08-11 06:46:20', '2024-08-11 06:46:20'),
(50, 'Status', 'Partially Achieved', 'In Progress', 13, '2024-08-11 06:46:40', '2024-08-11 06:46:40'),
(51, 'Status', 'Partially Achieved', 'In Progress', 14, '2024-08-11 06:46:50', '2024-08-11 06:46:50'),
(52, 'Status', 'New', 'In Progress', 15, '2024-08-11 06:47:02', '2024-08-11 06:47:02'),
(53, 'Key Result', 'Analyze business requirements and customer needs for Q3', NULL, 16, '2024-08-21 09:11:21', '2024-08-21 09:11:21'),
(54, 'Tracking', 'Milestone', NULL, 16, '2024-08-21 09:11:21', '2024-08-21 09:11:21'),
(55, 'Traking', 'Pending', NULL, 16, '2024-08-21 09:11:21', '2024-08-21 09:11:21'),
(56, 'Owner', 'Maria', NULL, 17, '2024-08-21 09:11:24', '2024-08-21 09:11:24'),
(57, 'Title', 'Analyze business requirements and customer needs for Q3', NULL, 17, '2024-08-21 09:11:24', '2024-08-21 09:11:24'),
(58, 'Goal Category', 'End Of Year Review 2024', NULL, 17, '2024-08-21 09:11:24', '2024-08-21 09:11:24'),
(59, 'Status', 'Partially Achieved', NULL, 17, '2024-08-21 09:11:24', '2024-08-21 09:11:24'),
(60, 'Category', 'Operational excellence', NULL, 17, '2024-08-21 09:11:24', '2024-08-21 09:11:24'),
(61, 'Key Result', 'update all manuals', NULL, 18, '2024-08-21 09:13:02', '2024-08-21 09:13:02'),
(62, 'Tracking', 'Quantifiable traget', NULL, 18, '2024-08-21 09:13:02', '2024-08-21 09:13:02'),
(63, 'Start', '0', NULL, 18, '2024-08-21 09:13:02', '2024-08-21 09:13:02'),
(64, 'Target', '10', NULL, 18, '2024-08-21 09:13:02', '2024-08-21 09:13:02'),
(65, 'Current', '5', NULL, 18, '2024-08-21 09:13:02', '2024-08-21 09:13:02'),
(66, 'Owner', 'Maria', NULL, 19, '2024-08-21 09:13:21', '2024-08-21 09:13:21'),
(67, 'Title', 'Update cargo handling operations maunal', NULL, 19, '2024-08-21 09:13:21', '2024-08-21 09:13:21'),
(68, 'Goal Category', 'End Of Year Review 2024', NULL, 19, '2024-08-21 09:13:21', '2024-08-21 09:13:21'),
(69, 'Status', 'In Progress', NULL, 19, '2024-08-21 09:13:21', '2024-08-21 09:13:21'),
(70, 'Category', 'Employee engagement', NULL, 19, '2024-08-21 09:13:21', '2024-08-21 09:13:21'),
(71, 'Key Result', 'Prepare and submit operational reports', NULL, 20, '2024-08-21 09:14:28', '2024-08-21 09:14:28'),
(72, 'Tracking', 'Quantifiable traget', NULL, 20, '2024-08-21 09:14:28', '2024-08-21 09:14:28'),
(73, 'Start', '0', NULL, 20, '2024-08-21 09:14:28', '2024-08-21 09:14:28'),
(74, 'Target', '6', NULL, 20, '2024-08-21 09:14:28', '2024-08-21 09:14:28'),
(75, 'Current', '4', NULL, 20, '2024-08-21 09:14:28', '2024-08-21 09:14:28'),
(76, 'Owner', 'Maria', NULL, 21, '2024-08-21 09:14:30', '2024-08-21 09:14:30'),
(77, 'Title', 'Prepare and submit operational reports', NULL, 21, '2024-08-21 09:14:30', '2024-08-21 09:14:30'),
(78, 'Goal Category', 'End Of Year Review 2024', NULL, 21, '2024-08-21 09:14:30', '2024-08-21 09:14:30'),
(79, 'Status', 'Partially Achieved', NULL, 21, '2024-08-21 09:14:30', '2024-08-21 09:14:30'),
(80, 'Category', 'Personal development', NULL, 21, '2024-08-21 09:14:30', '2024-08-21 09:14:30'),
(81, 'Owner', 'Vishal Mukati', NULL, 22, '2024-08-23 05:16:57', '2024-08-23 05:16:57'),
(82, 'Title', 'test', NULL, 22, '2024-08-23 05:16:57', '2024-08-23 05:16:57'),
(83, 'Goal Category', 'Mid Year review 2024', NULL, 22, '2024-08-23 05:16:57', '2024-08-23 05:16:57'),
(84, 'Status', 'In Progress', NULL, 22, '2024-08-23 05:16:57', '2024-08-23 05:16:57'),
(85, 'Category', 'Leadership development', NULL, 22, '2024-08-23 05:16:57', '2024-08-23 05:16:57'),
(86, 'Key Result', 'test', NULL, 23, '2024-08-23 05:18:01', '2024-08-23 05:18:01'),
(87, 'Tracking', 'Quantiflable traget', NULL, 23, '2024-08-23 05:18:01', '2024-08-23 05:18:01'),
(88, 'Start', '1', NULL, 23, '2024-08-23 05:18:01', '2024-08-23 05:18:01'),
(89, 'Target', '100', NULL, 23, '2024-08-23 05:18:01', '2024-08-23 05:18:01'),
(90, 'Current', '40', NULL, 23, '2024-08-23 05:18:01', '2024-08-23 05:18:01'),
(91, 'Key Result', 'test', NULL, 24, '2024-08-23 05:25:53', '2024-08-23 05:25:53'),
(92, 'Tracking', 'Quantifiable traget', NULL, 24, '2024-08-23 05:25:53', '2024-08-23 05:25:53'),
(93, 'Start', '1', NULL, 24, '2024-08-23 05:25:53', '2024-08-23 05:25:53'),
(94, 'Target', '100', NULL, 24, '2024-08-23 05:25:53', '2024-08-23 05:25:53'),
(95, 'Current', '40', NULL, 24, '2024-08-23 05:25:53', '2024-08-23 05:25:53'),
(96, 'Owner', 'Chetan Bairag', NULL, 25, '2024-08-23 05:25:55', '2024-08-23 05:25:55'),
(97, 'Title', 'test', NULL, 25, '2024-08-23 05:25:55', '2024-08-23 05:25:55'),
(98, 'Goal Category', 'Mid Year review 2024', NULL, 25, '2024-08-23 05:25:55', '2024-08-23 05:25:55'),
(99, 'Status', 'Differed', NULL, 25, '2024-08-23 05:25:55', '2024-08-23 05:25:55'),
(100, 'Category', 'Employee engagement', NULL, 25, '2024-08-23 05:25:55', '2024-08-23 05:25:55'),
(101, 'Key Result', 'test', NULL, 26, '2024-08-23 06:50:52', '2024-08-23 06:50:52'),
(102, 'Tracking', 'Quantiflable traget', NULL, 26, '2024-08-23 06:50:52', '2024-08-23 06:50:52'),
(103, 'Start', '0', NULL, 26, '2024-08-23 06:50:52', '2024-08-23 06:50:52'),
(104, 'Target', '100', NULL, 26, '2024-08-23 06:50:52', '2024-08-23 06:50:52'),
(105, 'Current', '20', NULL, 26, '2024-08-23 06:50:52', '2024-08-23 06:50:52'),
(106, 'Owner', 'Kishor Kumar', NULL, 27, '2024-08-23 06:50:54', '2024-08-23 06:50:54'),
(107, 'Title', 'test', NULL, 27, '2024-08-23 06:50:54', '2024-08-23 06:50:54'),
(108, 'Status', 'Active', NULL, 27, '2024-08-23 06:50:54', '2024-08-23 06:50:54'),
(109, 'Key Result', 'tets', NULL, 28, '2024-08-23 12:31:42', '2024-08-23 12:31:42'),
(110, 'Tracking', 'Quantiflable traget', NULL, 28, '2024-08-23 12:31:42', '2024-08-23 12:31:42'),
(111, 'Start', '1', NULL, 28, '2024-08-23 12:31:42', '2024-08-23 12:31:42'),
(112, 'Target', '100', NULL, 28, '2024-08-23 12:31:42', '2024-08-23 12:31:42'),
(113, 'Current', '77', NULL, 28, '2024-08-23 12:31:42', '2024-08-23 12:31:42'),
(114, 'Owner', 'Chetan Bairag', NULL, 29, '2024-08-23 12:31:45', '2024-08-23 12:31:45'),
(115, 'Title', 'test', NULL, 29, '2024-08-23 12:31:45', '2024-08-23 12:31:45'),
(116, 'Goal Category', 'Mid Year review 2024', NULL, 29, '2024-08-23 12:31:45', '2024-08-23 12:31:45'),
(117, 'Status', 'New', NULL, 29, '2024-08-23 12:31:45', '2024-08-23 12:31:45'),
(118, 'Category', 'Personal development', NULL, 29, '2024-08-23 12:31:45', '2024-08-23 12:31:45'),
(119, 'Key Result', 'tt', NULL, 30, '2024-08-24 05:27:48', '2024-08-24 05:27:48'),
(120, 'Tracking', 'Quantiflable traget', NULL, 30, '2024-08-24 05:27:48', '2024-08-24 05:27:48'),
(121, 'Start', '1', NULL, 30, '2024-08-24 05:27:48', '2024-08-24 05:27:48'),
(122, 'Target', '100', NULL, 30, '2024-08-24 05:27:48', '2024-08-24 05:27:48'),
(123, 'Current', '20', NULL, 30, '2024-08-24 05:27:48', '2024-08-24 05:27:48'),
(124, 'Owner', 'Chetan Bairag', NULL, 31, '2024-08-24 05:28:22', '2024-08-24 05:28:22'),
(125, 'Title', 'test', NULL, 31, '2024-08-24 05:28:22', '2024-08-24 05:28:22'),
(126, 'Goal Category', 'Mid Year review 2024', NULL, 31, '2024-08-24 05:28:22', '2024-08-24 05:28:22'),
(127, 'Status', 'In Progress', NULL, 31, '2024-08-24 05:28:22', '2024-08-24 05:28:22'),
(128, 'Category', 'Employee engagement', NULL, 31, '2024-08-24 05:28:22', '2024-08-24 05:28:22'),
(129, 'Key Result', '1', NULL, 32, '2024-08-24 06:31:03', '2024-08-24 06:31:03'),
(130, 'Tracking', 'Quantiflable traget', NULL, 32, '2024-08-24 06:31:03', '2024-08-24 06:31:03'),
(131, 'Start', '1', NULL, 32, '2024-08-24 06:31:03', '2024-08-24 06:31:03'),
(132, 'Target', '200', NULL, 32, '2024-08-24 06:31:03', '2024-08-24 06:31:03'),
(133, 'Current', '80', NULL, 32, '2024-08-24 06:31:03', '2024-08-24 06:31:03'),
(134, 'Owner', 'Chetan Bairag', NULL, 33, '2024-08-24 06:31:06', '2024-08-24 06:31:06'),
(135, 'Title', 'test 2', NULL, 33, '2024-08-24 06:31:06', '2024-08-24 06:31:06'),
(136, 'Goal Category', 'Mid Year review 2024', NULL, 33, '2024-08-24 06:31:06', '2024-08-24 06:31:06'),
(137, 'Status', 'In Progress', NULL, 33, '2024-08-24 06:31:06', '2024-08-24 06:31:06'),
(138, 'Category', 'Leadership development', NULL, 33, '2024-08-24 06:31:06', '2024-08-24 06:31:06'),
(139, 'Key Result', 'test', NULL, 34, '2024-08-24 12:21:57', '2024-08-24 12:21:57'),
(140, 'Tracking', 'Quantiflable traget', NULL, 34, '2024-08-24 12:21:57', '2024-08-24 12:21:57'),
(141, 'Start', '1', NULL, 34, '2024-08-24 12:21:57', '2024-08-24 12:21:57'),
(142, 'Target', '100', NULL, 34, '2024-08-24 12:21:57', '2024-08-24 12:21:57'),
(143, 'Current', '55', NULL, 34, '2024-08-24 12:21:57', '2024-08-24 12:21:57'),
(144, 'Owner', 'Chetan Bairag', NULL, 35, '2024-08-24 12:21:59', '2024-08-24 12:21:59'),
(145, 'Title', 'test hello', NULL, 35, '2024-08-24 12:21:59', '2024-08-24 12:21:59'),
(146, 'Goal Category', 'End Of Year Review 2024', NULL, 35, '2024-08-24 12:21:59', '2024-08-24 12:21:59'),
(147, 'Status', 'In Progress', NULL, 35, '2024-08-24 12:21:59', '2024-08-24 12:21:59'),
(148, 'Category', 'Customer experience', NULL, 35, '2024-08-24 12:21:59', '2024-08-24 12:21:59'),
(149, 'Key Result', 'yr', NULL, 36, '2024-08-29 05:39:49', '2024-08-29 05:39:49'),
(150, 'Tracking', 'Quantiflable traget', NULL, 36, '2024-08-29 05:39:49', '2024-08-29 05:39:49'),
(151, 'Start', '1', NULL, 36, '2024-08-29 05:39:49', '2024-08-29 05:39:49'),
(152, 'Target', '100', NULL, 36, '2024-08-29 05:39:49', '2024-08-29 05:39:49'),
(153, 'Current', '20', NULL, 36, '2024-08-29 05:39:49', '2024-08-29 05:39:49'),
(154, 'Owner', 'Rahul Parmar', NULL, 37, '2024-08-29 05:39:52', '2024-08-29 05:39:52'),
(155, 'Title', 'etest 3', NULL, 37, '2024-08-29 05:39:52', '2024-08-29 05:39:52'),
(156, 'Goal Category', 'Mid Year review 2024', NULL, 37, '2024-08-29 05:39:52', '2024-08-29 05:39:52'),
(157, 'Status', 'In Progress', NULL, 37, '2024-08-29 05:39:52', '2024-08-29 05:39:52'),
(158, 'Category', 'Employee engagement', NULL, 37, '2024-08-29 05:39:52', '2024-08-29 05:39:52'),
(159, 'Key Result', 'r', NULL, 38, '2024-08-29 05:40:44', '2024-08-29 05:40:44'),
(160, 'Tracking', 'Quantiflable traget', NULL, 38, '2024-08-29 05:40:44', '2024-08-29 05:40:44'),
(161, 'Start', '1', NULL, 38, '2024-08-29 05:40:44', '2024-08-29 05:40:44'),
(162, 'Target', '200', NULL, 38, '2024-08-29 05:40:44', '2024-08-29 05:40:44'),
(163, 'Current', '57', NULL, 38, '2024-08-29 05:40:44', '2024-08-29 05:40:44'),
(164, 'Owner', 'Rahul Parmar', NULL, 39, '2024-08-29 05:40:47', '2024-08-29 05:40:47'),
(165, 'Title', 'r goals', NULL, 39, '2024-08-29 05:40:47', '2024-08-29 05:40:47'),
(166, 'Goal Category', 'Mid Year review 2024', NULL, 39, '2024-08-29 05:40:47', '2024-08-29 05:40:47'),
(167, 'Status', 'In Progress', NULL, 39, '2024-08-29 05:40:47', '2024-08-29 05:40:47'),
(168, 'Category', 'Customer experience', NULL, 39, '2024-08-29 05:40:47', '2024-08-29 05:40:47'),
(169, 'Key Result', 'test', NULL, 40, '2024-08-31 10:16:57', '2024-08-31 10:16:57'),
(170, 'Tracking', 'Quantiflable traget', NULL, 40, '2024-08-31 10:16:57', '2024-08-31 10:16:57'),
(171, 'Start', '1', NULL, 40, '2024-08-31 10:16:57', '2024-08-31 10:16:57'),
(172, 'Target', '100', NULL, 40, '2024-08-31 10:16:57', '2024-08-31 10:16:57'),
(173, 'Current', '20', NULL, 40, '2024-08-31 10:16:57', '2024-08-31 10:16:57'),
(174, 'Owner', 'Chetan Bairag', NULL, 41, '2024-08-31 10:17:00', '2024-08-31 10:17:00'),
(175, 'Title', 'test', NULL, 41, '2024-08-31 10:17:00', '2024-08-31 10:17:00'),
(176, 'Status', 'Active', NULL, 41, '2024-08-31 10:17:00', '2024-08-31 10:17:00'),
(177, 'Key Result', 'test', NULL, 42, '2024-08-31 12:08:25', '2024-08-31 12:08:25'),
(178, 'Tracking', 'Quantiflable traget', NULL, 42, '2024-08-31 12:08:25', '2024-08-31 12:08:25'),
(179, 'Start', '1', NULL, 42, '2024-08-31 12:08:25', '2024-08-31 12:08:25'),
(180, 'Target', '100', NULL, 42, '2024-08-31 12:08:25', '2024-08-31 12:08:25'),
(181, 'Current', '37', NULL, 42, '2024-08-31 12:08:25', '2024-08-31 12:08:25'),
(182, 'Owner', 'Chetan Bairag', NULL, 43, '2024-08-31 12:08:28', '2024-08-31 12:08:28'),
(183, 'Title', 'Responsibility', NULL, 43, '2024-08-31 12:08:28', '2024-08-31 12:08:28'),
(184, 'Status', 'Active', NULL, 43, '2024-08-31 12:08:28', '2024-08-31 12:08:28'),
(185, 'Key Result', 'test', NULL, 44, '2024-08-31 12:09:14', '2024-08-31 12:09:14'),
(186, 'Tracking', 'Quantiflable traget', NULL, 44, '2024-08-31 12:09:14', '2024-08-31 12:09:14'),
(187, 'Start', '1', NULL, 44, '2024-08-31 12:09:14', '2024-08-31 12:09:14'),
(188, 'Target', '200', NULL, 44, '2024-08-31 12:09:14', '2024-08-31 12:09:14'),
(189, 'Current', '57', NULL, 44, '2024-08-31 12:09:14', '2024-08-31 12:09:14'),
(190, 'Owner', 'Chetan Bairag', NULL, 45, '2024-08-31 12:09:18', '2024-08-31 12:09:18'),
(191, 'Title', 'res 2', NULL, 45, '2024-08-31 12:09:18', '2024-08-31 12:09:18'),
(192, 'Status', 'Active', NULL, 45, '2024-08-31 12:09:18', '2024-08-31 12:09:18'),
(193, 'Key Result', 'test 2', NULL, 46, '2024-08-31 12:11:13', '2024-08-31 12:11:13'),
(194, 'Tracking', 'Quantiflable traget', NULL, 46, '2024-08-31 12:11:13', '2024-08-31 12:11:13'),
(195, 'Start', '1', NULL, 46, '2024-08-31 12:11:13', '2024-08-31 12:11:13'),
(196, 'Target', '500', NULL, 46, '2024-08-31 12:11:13', '2024-08-31 12:11:13'),
(197, 'Current', '244', NULL, 46, '2024-08-31 12:11:13', '2024-08-31 12:11:13'),
(198, 'Owner', 'Chetan Bairag', NULL, 47, '2024-08-31 12:11:16', '2024-08-31 12:11:16'),
(199, 'Title', 'test', NULL, 47, '2024-08-31 12:11:16', '2024-08-31 12:11:16'),
(200, 'Status', 'Active', NULL, 47, '2024-08-31 12:11:16', '2024-08-31 12:11:16'),
(201, 'Key Result', 'test', NULL, 48, '2024-09-02 06:04:38', '2024-09-02 06:04:38'),
(202, 'Tracking', 'Quantiflable traget', NULL, 48, '2024-09-02 06:04:38', '2024-09-02 06:04:38'),
(203, 'Start', '1', NULL, 48, '2024-09-02 06:04:38', '2024-09-02 06:04:38'),
(204, 'Target', '100', NULL, 48, '2024-09-02 06:04:38', '2024-09-02 06:04:38'),
(205, 'Current', '20', NULL, 48, '2024-09-02 06:04:38', '2024-09-02 06:04:38'),
(206, 'Owner', 'Chetan Bairag', NULL, 49, '2024-09-02 06:04:42', '2024-09-02 06:04:42'),
(207, 'Title', 'test 2', NULL, 49, '2024-09-02 06:04:42', '2024-09-02 06:04:42'),
(208, 'Status', 'Active', NULL, 49, '2024-09-02 06:04:42', '2024-09-02 06:04:42'),
(209, 'Key Result', 'he', NULL, 50, '2024-09-02 06:05:19', '2024-09-02 06:05:19'),
(210, 'Tracking', 'Quantiflable traget', NULL, 50, '2024-09-02 06:05:19', '2024-09-02 06:05:19'),
(211, 'Start', '1', NULL, 50, '2024-09-02 06:05:19', '2024-09-02 06:05:19'),
(212, 'Target', '58', NULL, 50, '2024-09-02 06:05:19', '2024-09-02 06:05:19'),
(213, 'Current', '200', NULL, 50, '2024-09-02 06:05:19', '2024-09-02 06:05:19'),
(214, 'Key result', 'he', '58', 51, '2024-09-02 06:05:39', '2024-09-02 06:05:39'),
(215, 'Target', '200', '58', 51, '2024-09-02 06:05:39', '2024-09-02 06:05:39'),
(216, 'Key result', 'he', '200', 51, '2024-09-02 06:05:39', '2024-09-02 06:05:39'),
(217, 'Current', '89', '200', 51, '2024-09-02 06:05:39', '2024-09-02 06:05:39'),
(218, 'Owner', 'Chetan Bairag', NULL, 52, '2024-09-02 06:05:43', '2024-09-02 06:05:43'),
(219, 'Title', 'test 2', NULL, 52, '2024-09-02 06:05:43', '2024-09-02 06:05:43'),
(220, 'Status', 'Active', NULL, 52, '2024-09-02 06:05:43', '2024-09-02 06:05:43');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `employment_start` varchar(50) DEFAULT NULL,
  `employment_end` varchar(50) DEFAULT NULL,
  `d_o_b` varchar(50) NOT NULL,
  `employee_code` varchar(255) NOT NULL,
  `is_login` int(11) NOT NULL DEFAULT 0 COMMENT 'admin=0,user=1',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `profile_image`, `logo`, `department_id`, `employment_start`, `employment_end`, `d_o_b`, `employee_code`, `is_login`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '27', '25', NULL, NULL, NULL, '', '', 0, NULL, '$2y$10$I663JuUbKheBkoG/pyGIoOFeVvQ7eJa0oosC3Gv6BMDXd5VK6yl2.', '7qa0r8jQBs9SjkeJQtS4ziUZIai1LywRl7MBb6ApSMGPTuQmbZ9A8rVeKwTI', '2023-10-25 04:46:00', '2024-08-08 04:06:40');

-- --------------------------------------------------------

--
-- Table structure for table `appraisals`
--

CREATE TABLE `appraisals` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `self_review` int(11) DEFAULT 0,
  `self_review_deadline` varchar(255) DEFAULT NULL,
  `manager_id` int(11) DEFAULT NULL,
  `manager_review` int(11) DEFAULT 0,
  `manager_review_deadlin` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `review_cycle` varchar(255) DEFAULT NULL,
  `results_shared` int(11) DEFAULT 0,
  `questionnaire` varchar(255) DEFAULT NULL,
  `self_popup` int(22) DEFAULT 0,
  `manager_popup` int(22) DEFAULT 0,
  `self_popup_date` varchar(255) DEFAULT NULL,
  `manager_popup_date` varchar(255) DEFAULT NULL,
  `self_review_submited` varchar(100) DEFAULT NULL,
  `manager_review_submited` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appraisals`
--

INSERT INTO `appraisals` (`id`, `user_id`, `self_review`, `self_review_deadline`, `manager_id`, `manager_review`, `manager_review_deadlin`, `status`, `review_cycle`, `results_shared`, `questionnaire`, `self_popup`, `manager_popup`, `self_popup_date`, `manager_popup_date`, `self_review_submited`, `manager_review_submited`, `created_at`, `updated_at`) VALUES
(12, 1, 1, '2024-08-26', 4, 0, '2024-08-29', 0, '7', 0, '23', 0, 0, '2024/08/26', '2024/09/06', '2024-08-26 12:25:51 PM', NULL, '2024-08-26 06:55:31', '2024-09-06 03:11:30');

-- --------------------------------------------------------

--
-- Table structure for table `assess_potentials`
--

CREATE TABLE `assess_potentials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `potential` varchar(255) DEFAULT NULL,
  `retention` varchar(255) DEFAULT NULL,
  `achievable_level` varchar(255) DEFAULT NULL,
  `loss_impact` varchar(255) DEFAULT NULL,
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
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  `color_name` varchar(225) DEFAULT NULL,
  `color_code` varchar(255) DEFAULT NULL,
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
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `background_color_id` varchar(255) DEFAULT NULL,
  `text_color_id` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company_announcements`
--

INSERT INTO `company_announcements` (`id`, `title`, `description`, `employee_id`, `background_color_id`, `text_color_id`, `status`, `created_at`, `updated_at`) VALUES
(4, 'Welcome to workmate', 'Welcome to workmate performance management system click here to for a quick tour of the system and discover all the different features available', NULL, '#fdf97c', '#454545', 1, '2024-08-21 03:33:55', '2024-09-05 00:12:05'),
(5, 'Update your profile', 'The first step you get you all setup and benefit all the features workmate has to offer is to complete your profile .', NULL, '#100f0f', '#ffffff', 1, '2024-08-21 04:17:10', '2024-09-05 00:11:30');

-- --------------------------------------------------------

--
-- Table structure for table `competencies`
--

CREATE TABLE `competencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `discription` text DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `total_progress` varchar(255) DEFAULT NULL,
  `user_id` int(22) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `competencies`
--

INSERT INTO `competencies` (`id`, `title`, `status`, `discription`, `time`, `total_progress`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'test', 'Active', 'fs', '1723114781', 'NaN', 4, '2024-08-08 05:29:56', '2024-08-08 05:29:56'),
(2, 'tests', 'Active', 'test', '1724395818', '20', 4, '2024-08-23 01:20:54', '2024-08-23 01:20:54'),
(3, 'test', 'Active', 'hello', '1725099374', '19.191919191919', 1, '2024-08-31 04:47:00', '2024-08-31 04:47:00'),
(4, 'test', 'Active', 'test', '1725106241', '48.697394789579', 1, '2024-08-31 06:41:16', '2024-08-31 06:41:16');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `sortname` varchar(3) NOT NULL,
  `name` varchar(150) NOT NULL,
  `phonecode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
  `name` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'PHP', 1, '2023-10-26 05:56:43', '2023-10-27 05:49:47'),
(2, 'HR', 1, '2023-10-31 06:30:53', '2024-08-08 07:10:16'),
(3, 'Mobile Developer', 1, '2023-10-31 06:31:36', '2023-10-31 06:31:36'),
(4, 'Operations', 0, '2024-06-02 04:01:30', '2024-06-02 04:01:58'),
(5, 'Accounts', 0, '2024-06-02 04:01:42', '2024-08-08 07:10:14'),
(6, 'Sales', 0, '2024-06-02 04:02:27', '2024-06-02 04:02:31');

-- --------------------------------------------------------

--
-- Table structure for table `developments`
--

CREATE TABLE `developments` (
  `id` int(22) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `discription` text DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `total_progress` varchar(255) DEFAULT NULL,
  `user_id` int(22) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `developments`
--

INSERT INTO `developments` (`id`, `title`, `status`, `discription`, `time`, `total_progress`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'ds', 'Archived', 'f', '1723115095', 'NaN', 4, '2024-08-08 11:05:08', '2024-08-08 11:05:08'),
(2, 'test 2', 'Active', 'twst', '1725256880', '19.191919191919', 1, '2024-09-02 06:04:41', '2024-09-02 06:04:41'),
(3, 'test 2', 'Active', 'test', '1725257090', '44.221105527638', 1, '2024-09-02 06:05:43', '2024-09-02 06:05:43');

-- --------------------------------------------------------

--
-- Table structure for table `disciplinary_letters`
--

CREATE TABLE `disciplinary_letters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `file` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `disciplinary_letters`
--

INSERT INTO `disciplinary_letters` (`id`, `title`, `file`, `created_at`, `updated_at`) VALUES
(1, 'test disciplainary', '1723114546.pdf', '2024-08-08 05:25:46', '2024-08-08 05:25:46');

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
  `created_at` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `updated_at` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `doc_name`, `category_id`, `file`, `status`, `created_at`, `updated_at`) VALUES
(1, 'testing', 1, '1723115318_1719585335.jpg', '1', '2024-08-08 11:08:39', '2024-08-08 11:08:39');

-- --------------------------------------------------------

--
-- Table structure for table `document_categories`
--

CREATE TABLE `document_categories` (
  `id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `updated_at` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `document_categories`
--

INSERT INTO `document_categories` (`id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(1, 'test', '1', '2024-08-08 11:01:39.000000', '2024-08-08 11:01:39.000000');

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
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emergency_contacts`
--

CREATE TABLE `emergency_contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `number` varchar(255) DEFAULT NULL,
  `relation` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `emergency_contacts`
--

INSERT INTO `emergency_contacts` (`id`, `name`, `number`, `relation`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'test2', '7985625896', 'Partner', 3, '2024-08-08 07:58:56', '2024-08-08 07:58:56'),
(2, 'test2', '7985625896', 'Spouse', 2, '2024-08-08 23:34:15', '2024-08-08 23:34:15'),
(3, '64758589', 'peter', 'Spouse', 19, '2024-08-21 03:30:56', '2024-08-21 03:30:56'),
(4, '669', 'Occaecat alias deser', 'Parent', 20, '2024-09-05 02:01:21', '2024-09-05 02:01:21'),
(5, '25', 'Dolores est incidid', 'Friend', 21, '2024-09-05 02:04:03', '2024-09-05 02:04:03'),
(6, '337', 'Et ullamco eum aut q', 'Partner', 22, '2024-09-05 02:12:11', '2024-09-05 02:12:11'),
(7, '809', 'Nisi non sint facer', 'Other', 23, '2024-09-05 02:13:06', '2024-09-05 02:13:06');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
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
  `description` text DEFAULT NULL,
  `deadline` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `review_cycle` varchar(255) DEFAULT NULL,
  `tracking` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `totalprogressbar` varchar(255) DEFAULT NULL,
  `user_id` int(22) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `manager_id` int(22) DEFAULT NULL,
  `goal_rating_id` int(22) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `goals`
--

INSERT INTO `goals` (`id`, `title`, `status`, `role_id`, `description`, `deadline`, `category`, `review_cycle`, `tracking`, `time`, `totalprogressbar`, `user_id`, `type`, `manager_id`, `goal_rating_id`, `created_at`, `updated_at`) VALUES
(10, 'test', 5, NULL, 'fds', '2024-08-24', '5', '7', NULL, '1724477227', '19.191919191919', 1, NULL, NULL, NULL, '2024-08-24 05:28:22', '2024-08-24 05:28:22'),
(11, 'test 2', 5, NULL, 'tets', '2024-08-31', '6', '7', NULL, '1724481020', '39.698492462312', 1, NULL, NULL, NULL, '2024-08-24 06:31:06', '2024-08-24 06:31:06'),
(12, 'test hello', 5, NULL, 'test', '2024-08-15', '4', '8', NULL, '1724502077', '54.545454545455', 1, NULL, NULL, NULL, '2024-08-24 12:21:59', '2024-08-24 12:21:59'),
(13, 'etest 3', 5, NULL, 'trt', '2024-08-29', '5', '7', NULL, '1724909954', '19.191919191919', 3, NULL, NULL, NULL, '2024-08-29 05:39:52', '2024-08-29 05:39:52'),
(14, 'r goals', 5, NULL, 'ytryr', '2024-08-29', '4', '7', NULL, '1724909996', '28.140703517587998', 3, NULL, NULL, NULL, '2024-08-29 05:40:47', '2024-08-29 05:40:47');

-- --------------------------------------------------------

--
-- Table structure for table `goal_categories`
--

CREATE TABLE `goal_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `goal_categories`
--

INSERT INTO `goal_categories` (`id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(4, 'Customer experience', 1, '2024-08-04 04:03:38', '2024-08-04 04:03:38'),
(5, 'Employee engagement', 1, '2024-08-04 04:03:49', '2024-08-04 04:03:49'),
(6, 'Leadership development', 1, '2024-08-04 04:04:00', '2024-08-04 04:04:00'),
(7, 'Operational excellence', 1, '2024-08-04 04:04:12', '2024-08-04 04:04:12'),
(8, 'Personal development', 1, '2024-08-04 04:04:25', '2024-08-04 04:04:25');

-- --------------------------------------------------------

--
-- Table structure for table `goal_reviews`
--

CREATE TABLE `goal_reviews` (
  `id` int(11) NOT NULL,
  `employee_id` int(22) DEFAULT NULL,
  `self_review` int(11) DEFAULT 0,
  `manager_review` int(22) DEFAULT 0,
  `review_cycle_id` int(22) DEFAULT NULL,
  `input_type_id` int(22) DEFAULT NULL,
  `input_type_name` varchar(255) DEFAULT NULL,
  `rating_id` int(22) DEFAULT NULL,
  `manager_id` int(255) DEFAULT NULL,
  `self_review_submitted` varchar(255) DEFAULT NULL,
  `manager_review_submitted` varchar(255) DEFAULT NULL,
  `goalcomment_id` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `goal_reviews`
--

INSERT INTO `goal_reviews` (`id`, `employee_id`, `self_review`, `manager_review`, `review_cycle_id`, `input_type_id`, `input_type_name`, `rating_id`, `manager_id`, `self_review_submitted`, `manager_review_submitted`, `goalcomment_id`, `created_at`, `updated_at`) VALUES
(2, 1, 1, 1, 7, 11, 'goal', 1, 4, '2024-09-02 06:52:06 AM', '2024-09-02 07:43:00 AM', 1, '2024-09-02 07:43:00', '2024-09-02 02:13:00'),
(3, 1, 1, 1, 7, 10, 'competency', 1, 4, '2024-09-02 07:46:30 AM', '2024-09-02 07:58:44 AM', 1, '2024-09-02 07:58:44', '2024-09-02 02:28:44'),
(4, 1, 1, 1, 8, 12, 'responsibility', 1, 4, '2024-09-02 09:08:11 AM', '2024-09-03 05:46:17 AM', 0, '2024-09-03 05:46:17', '2024-09-03 00:16:17'),
(5, 1, 1, 1, 7, 13, 'development', 2, 4, '2024-09-02 09:30:44 AM', '2024-09-02 11:39:41 AM', 1, '2024-09-02 12:49:37', '2024-09-02 07:19:37'),
(6, 1, 1, 1, 7, 11, 'goal', 1, 4, '2024-09-02 02:02:34 PM', '2024-09-02 02:06:47 PM', 1, '2024-09-02 14:06:47', '2024-09-02 08:36:47'),
(7, 1, 0, 0, 7, 12, NULL, 2, NULL, NULL, NULL, 1, '2024-09-02 13:24:44', '2024-09-02 07:54:44'),
(9, 3, 1, 1, 7, 11, 'goal', 2, 4, '2024-09-03 05:28:45 AM', '2024-09-03 05:43:27 AM', 1, '2024-09-03 05:43:27', '2024-09-03 00:13:27');

-- --------------------------------------------------------

--
-- Table structure for table `goal_review_stores`
--

CREATE TABLE `goal_review_stores` (
  `id` int(11) NOT NULL,
  `goal_review_id` int(22) DEFAULT NULL,
  `que_employ_value` varchar(255) DEFAULT NULL,
  `que_manager_value` varchar(255) DEFAULT NULL,
  `employ_id` int(11) DEFAULT NULL,
  `manager_id` int(11) DEFAULT NULL,
  `que_self_rating` int(22) DEFAULT NULL,
  `que_manager_rating` int(22) DEFAULT NULL,
  `goal_id` int(11) DEFAULT NULL,
  `goal_comments` varchar(255) DEFAULT NULL,
  `manager_comment` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `goal_review_stores`
--

INSERT INTO `goal_review_stores` (`id`, `goal_review_id`, `que_employ_value`, `que_manager_value`, `employ_id`, `manager_id`, `que_self_rating`, `que_manager_rating`, `goal_id`, `goal_comments`, `manager_comment`, `created_at`, `updated_at`) VALUES
(1, 2, 'Needs Improvement', 'Meets Expectations', 1, 4, 1, NULL, 10, 'goal 1', 'goal manager 1', '2024-09-02 01:22:06', '2024-09-02 02:13:00'),
(2, 2, 'Meets Expectations', 'Exceeds Expectations', 1, 4, 1, NULL, 11, 'goal 2', 'goal manager 2', '2024-09-02 01:22:06', '2024-09-02 02:13:00'),
(3, 2, 'Exceeds Expectations', 'Exceptional', 1, 4, 1, NULL, 12, 'goal 3', 'goal manager 3', '2024-09-02 01:22:06', '2024-09-02 02:13:00'),
(4, 3, 'Needs Improvement', 'Meets Expectations', 1, 4, 1, 1, 3, 'Competency', 'competency manager 1', '2024-09-02 02:16:30', '2024-09-02 02:28:44'),
(5, 3, 'Below Expectations', 'Needs Improvement', 1, 4, 1, 1, 4, 'competency 2', 'competency manager 2', '2024-09-02 02:16:30', '2024-09-02 02:28:44'),
(6, 4, 'Below Expectations', 'Exceeds Expectations', 1, 4, 1, 1, 2, NULL, NULL, '2024-09-02 03:38:11', '2024-09-03 00:16:17'),
(7, 4, 'Exceptional', 'Needs Improvement', 1, 4, 1, 1, 3, NULL, NULL, '2024-09-02 03:38:11', '2024-09-03 00:16:17'),
(8, 5, 'Below Expectations', 'Exceeds Expectations', 1, 4, 2, 2, 2, 'development', 'development', '2024-09-02 04:00:44', '2024-09-02 06:09:41'),
(9, 5, 'Meets Expectations', 'Exceptional', 1, 4, 2, 2, 3, 'development 2', 'development 22', '2024-09-02 04:00:44', '2024-09-02 06:09:41'),
(10, 6, 'Meets Expectations', 'Below Expectations', 1, 4, 1, NULL, 10, 'goal 1', 'sa', '2024-09-02 08:32:34', '2024-09-02 08:36:47'),
(11, 6, 'Needs Improvement', 'Meets Expectations', 1, 4, 1, NULL, 11, 'error', 'asd', '2024-09-02 08:32:34', '2024-09-02 08:36:47'),
(12, 6, 'Below Expectations', 'Exceeds Expectations', 1, 4, 1, NULL, 12, 'error d', 'asdada', '2024-09-02 08:32:34', '2024-09-02 08:36:47'),
(13, 9, 'Needs Improvement', 'Below Expectations', 3, 4, 2, NULL, 13, 'goal 1', 'test', '2024-09-02 23:58:45', '2024-09-03 00:13:27'),
(14, 9, 'Below Expectations', 'Exceeds Expectations', 3, 4, 2, NULL, 14, 'goal 2', 'goals 22', '2024-09-02 23:58:45', '2024-09-03 00:13:27');

-- --------------------------------------------------------

--
-- Table structure for table `goal_statuses`
--

CREATE TABLE `goal_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `background_color` varchar(255) DEFAULT NULL,
  `label_color` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `goal_statuses`
--

INSERT INTO `goal_statuses` (`id`, `title`, `status`, `background_color`, `label_color`, `created_at`, `updated_at`) VALUES
(4, 'New', 1, '#2a2727', '#fff', '2024-08-04 03:59:27', '2024-08-04 04:00:06'),
(5, 'In Progress', 1, '#5367ca', '#ffffff', '2024-08-04 04:00:48', '2024-08-04 04:00:48'),
(6, 'Partially Achieved', 1, '#ffa629', '#ffffff', '2024-08-04 04:01:32', '2024-08-04 04:01:32'),
(7, 'Not Achieved', 1, '#f33535', '#ffffff', '2024-08-04 04:02:08', '2024-08-04 04:02:08'),
(8, 'Differed', 1, '#a8a4a4', '#ffffff', '2024-08-04 04:02:34', '2024-08-04 04:02:34'),
(9, 'Achieved', 1, '#60f093', '#ffffff', '2024-08-04 04:02:57', '2024-08-04 04:02:57');

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `country` int(22) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `holidays`
--

INSERT INTO `holidays` (`id`, `title`, `date`, `status`, `country`, `color`, `created_at`, `updated_at`) VALUES
(1, 'Christmas', '2024-12-31', 1, 101, '#c7fbff', '2024-08-08 10:58:22', '2024-08-08 10:58:36'),
(2, '15 August', '2024-08-15', 1, 194, '#c7fbff', '2024-08-11 07:01:58', '2024-08-11 07:01:58');

-- --------------------------------------------------------

--
-- Table structure for table `input_types`
--

CREATE TABLE `input_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `name` text DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
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
  `title` varchar(255) DEFAULT NULL,
  `traking` varchar(255) DEFAULT NULL,
  `traking_status` tinyint(4) DEFAULT NULL,
  `target` int(11) DEFAULT NULL,
  `start` int(11) DEFAULT NULL,
  `goal_id` tinyint(4) DEFAULT NULL,
  `current` int(11) DEFAULT NULL,
  `total_progress` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
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
(13, 'tt', 'Quantiflable traget', NULL, 100, 1, 10, 20, '19.191919191919', '1724477227', NULL, NULL, NULL, '2024-08-23 23:57:48', '2024-08-23 23:58:22'),
(14, '1', 'Quantiflable traget', NULL, 200, 1, 11, 80, '39.698492462312', '1724481020', NULL, NULL, NULL, '2024-08-24 01:01:03', '2024-08-24 01:01:06'),
(15, 'test', 'Quantiflable traget', NULL, 100, 1, 12, 55, '54.545454545455', '1724502077', NULL, NULL, NULL, '2024-08-24 06:51:57', '2024-08-24 06:51:59'),
(16, 'yr', 'Quantiflable traget', NULL, 100, 1, 13, 20, '19.191919191919', '1724909954', NULL, NULL, NULL, '2024-08-29 00:09:49', '2024-08-29 00:09:52'),
(17, 'r', 'Quantiflable traget', NULL, 200, 1, 14, 57, '28.140703517588', '1724909996', NULL, NULL, NULL, '2024-08-29 00:10:44', '2024-08-29 00:10:47'),
(18, 'test', 'Quantiflable traget', NULL, 100, 1, NULL, 20, '19.191919191919', '1725099374', 3, NULL, NULL, '2024-08-31 04:46:57', '2024-08-31 04:47:00'),
(19, 'test', 'Quantiflable traget', NULL, 100, 1, NULL, 37, '36.363636363636', '1725106020', NULL, 2, NULL, '2024-08-31 06:38:25', '2024-08-31 06:38:28'),
(20, 'test', 'Quantiflable traget', NULL, 200, 1, NULL, 57, '28.140703517588', '1725106122', NULL, 3, NULL, '2024-08-31 06:39:14', '2024-08-31 06:39:18'),
(21, 'test 2', 'Quantiflable traget', NULL, 500, 1, NULL, 244, '48.697394789579', '1725106241', 4, NULL, NULL, '2024-08-31 06:41:13', '2024-08-31 06:41:16'),
(22, 'test', 'Quantiflable traget', NULL, 100, 1, NULL, 20, '19.191919191919', '1725256880', NULL, NULL, 2, '2024-09-02 00:34:38', '2024-09-02 00:34:42'),
(23, 'he', 'Quantiflable traget', NULL, 200, 1, NULL, 89, '44.221105527638', '1725257090', NULL, NULL, 3, '2024-09-02 00:35:19', '2024-09-02 00:35:43');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  `description` text DEFAULT NULL,
  `start_date` varchar(255) DEFAULT NULL,
  `end_date` varchar(255) DEFAULT NULL,
  `file_id` varchar(255) DEFAULT NULL,
  `is_leave` int(11) NOT NULL DEFAULT 0 COMMENT '0-none,1-approve,2-declined',
  `comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leave_requests`
--

INSERT INTO `leave_requests` (`id`, `leave_type`, `employee_id`, `description`, `start_date`, `end_date`, `file_id`, `is_leave`, `comment`, `created_at`, `updated_at`) VALUES
(1, 1, 16, NULL, '2024-08-09', '2024-08-13', NULL, 0, NULL, '2024-08-08 23:27:49', '2024-08-11 02:26:22'),
(2, 1, 16, 'going overseas trip', '2024-09-03', '2024-09-20', NULL, 1, NULL, '2024-08-11 01:25:19', '2024-08-11 01:27:21');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leave_schedules`
--

INSERT INTO `leave_schedules` (`id`, `employee_id`, `date`, `leave_request_id`, `type`, `start_time`, `end_time`, `created_at`, `updated_at`) VALUES
(3, 16, '2024-09-03', 2, 1, NULL, NULL, '2024-08-11 01:25:19', '2024-08-11 01:25:19'),
(4, 16, '2024-09-04', 2, 1, NULL, NULL, '2024-08-11 01:25:19', '2024-08-11 01:25:19'),
(5, 16, '2024-09-05', 2, 1, NULL, NULL, '2024-08-11 01:25:19', '2024-08-11 01:25:19'),
(6, 16, '2024-09-06', 2, 1, NULL, NULL, '2024-08-11 01:25:19', '2024-08-11 01:25:19'),
(7, 16, '2024-09-09', 2, 1, NULL, NULL, '2024-08-11 01:25:19', '2024-08-11 01:25:19'),
(8, 16, '2024-09-10', 2, 1, NULL, NULL, '2024-08-11 01:25:19', '2024-08-11 01:25:19'),
(9, 16, '2024-09-11', 2, 1, NULL, NULL, '2024-08-11 01:25:19', '2024-08-11 01:25:19'),
(10, 16, '2024-09-12', 2, 1, NULL, NULL, '2024-08-11 01:25:19', '2024-08-11 01:25:19'),
(11, 16, '2024-09-13', 2, 1, NULL, NULL, '2024-08-11 01:25:19', '2024-08-11 01:25:19'),
(12, 16, '2024-09-16', 2, 1, NULL, NULL, '2024-08-11 01:25:19', '2024-08-11 01:25:19'),
(13, 16, '2024-09-17', 2, 1, NULL, NULL, '2024-08-11 01:25:19', '2024-08-11 01:25:19'),
(14, 16, '2024-09-18', 2, 1, NULL, NULL, '2024-08-11 01:25:19', '2024-08-11 01:25:19'),
(15, 16, '2024-09-19', 2, 1, NULL, NULL, '2024-08-11 01:25:19', '2024-08-11 01:25:19'),
(16, 16, '2024-09-20', 2, 1, NULL, NULL, '2024-08-11 01:25:19', '2024-08-11 01:25:19'),
(17, 16, '2024-08-09', 1, 1, NULL, NULL, '2024-08-11 02:26:22', '2024-08-11 02:26:22'),
(18, 16, '2024-08-12', 1, 1, NULL, NULL, '2024-08-11 02:26:22', '2024-08-11 02:26:22'),
(19, 16, '2024-08-13', 1, 1, NULL, NULL, '2024-08-11 02:26:22', '2024-08-11 02:26:22');

-- --------------------------------------------------------

--
-- Table structure for table `leave_types`
--

CREATE TABLE `leave_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `color_code` varchar(255) DEFAULT NULL,
  `leave_days` int(22) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leave_types`
--

INSERT INTO `leave_types` (`id`, `type`, `status`, `color_code`, `leave_days`, `created_at`, `updated_at`) VALUES
(1, 'Annual Leave', 1, '#54bce8', 21, '2023-10-19 11:13:53', '2024-07-30 12:33:39'),
(2, 'Public Holiday', 1, '#f9c50b', 1, '2023-10-19 11:13:53', '2024-08-11 01:29:42'),
(3, 'Purchased Leave', 1, '#38ff7e', 3, '2023-10-19 11:13:53', '2024-05-27 00:57:43'),
(4, 'Sick Leave', 1, '#878eb0', 21, '2023-10-19 11:13:53', '2024-07-30 12:33:49'),
(5, 'Study Leave/Training', 1, '#ff9999', 3, '2023-10-19 11:13:53', '2024-05-27 00:58:10'),
(6, 'Unpaid Leave', 0, '#0071c7', 5, '2023-10-19 11:13:53', '2024-06-02 04:04:04'),
(9, 'Casual leave', 0, '#c7c9ff', 3, '2024-05-04 05:16:32', '2024-05-27 00:57:22');

-- --------------------------------------------------------

--
-- Table structure for table `masters`
--

CREATE TABLE `masters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
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
  `migration` varchar(255) NOT NULL,
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
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 3),
(1, 'App\\Models\\User', 7),
(1, 'App\\Models\\User', 10),
(1, 'App\\Models\\User', 16),
(1, 'App\\Models\\User', 19),
(2, 'App\\Models\\User', 4),
(3, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 14),
(3, 'App\\Models\\User', 17);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pdf_uploads`
--

CREATE TABLE `pdf_uploads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `user_id` text NOT NULL,
  `department_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pdf_uploads`
--

INSERT INTO `pdf_uploads` (`id`, `file_name`, `category`, `file_path`, `user_id`, `department_id`, `created_at`, `updated_at`) VALUES
(1, 'test', 'test', 'uploads/test.pdf', '1', '1', '2024-08-08 05:32:02', '2024-08-08 05:32:02');

-- --------------------------------------------------------

--
-- Table structure for table `performances`
--

CREATE TABLE `performances` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `review_temp` text DEFAULT NULL,
  `goal_id` int(11) DEFAULT NULL,
  `start_date` varchar(11) DEFAULT NULL,
  `end_date` varchar(11) DEFAULT NULL,
  `due_date` varchar(11) DEFAULT NULL,
  `status` int(11) DEFAULT 0 COMMENT '0-pending, 1-employee-accept, 2- manager-accept',
  `assign_manager_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `status` int(11) NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `due_date` varchar(255) DEFAULT NULL,
  `performance_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
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
(7, 'leave-calendar', 'web', NULL, NULL),
(8, 'goal', 'web', NULL, NULL),
(9, 'performance', 'web', NULL, NULL),
(11, 'team-performance', 'web', NULL, NULL),
(12, 'training', 'web', '2024-05-04 09:30:12', '2024-05-04 09:30:12'),
(13, 'creat-appraisal', 'web', NULL, NULL),
(14, 'respond-on-appraisal', 'web', NULL, NULL),
(15, 'edit-appraisal', 'web', NULL, NULL),
(17, 'creat-training', 'web', '2024-05-15 06:39:33', '2024-05-15 06:39:33'),
(18, 'create-disciplinary', 'web', '2024-05-15 06:39:33', '2024-05-15 06:39:33'),
(19, 'my-resources', 'web', '2024-05-28 08:10:10', '2024-05-28 08:10:10'),
(20, 'add-delete-my-resources', 'web', '2024-06-10 10:47:45', '2024-06-10 10:47:45'),
(21, 'view-team-leave', 'web', '2024-06-10 10:47:45', '2024-06-10 10:47:45'),
(22, 'wages-and-benefits', 'web', '2024-06-10 10:48:26', '2024-06-10 10:48:26'),
(23, 'team-leave-calendar', 'web', '2024-08-08 09:07:36', '2024-08-08 09:07:36'),
(24, 'team-goal-review', 'web', '2024-08-30 12:39:59', '2024-08-30 12:39:59'),
(25, 'hr-goal-review', 'web', '2024-09-02 11:42:22', '2024-09-02 11:42:22'),
(26, 'add-goal-review', 'web', '2024-09-02 11:44:02', '2024-09-02 11:44:02'),
(27, 'view-team-profile', 'web', '2024-09-05 06:19:26', '2024-09-05 06:19:26');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
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
  `que_employ_value` longtext DEFAULT NULL,
  `que_manager_value` longtext DEFAULT NULL,
  `employ_id` int(11) DEFAULT NULL,
  `manager_id` bigint(22) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `que_self_rating` int(11) DEFAULT NULL,
  `que_manager_rating` int(11) DEFAULT NULL,
  `goal_id` int(22) DEFAULT NULL,
  `goal_rating` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questionnaires`
--

INSERT INTO `questionnaires` (`id`, `appraisal_id`, `que_key`, `que_employ_value`, `que_manager_value`, `employ_id`, `manager_id`, `created_at`, `updated_at`, `que_self_rating`, `que_manager_rating`, `goal_id`, `goal_rating`) VALUES
(14, 11, 47, 'option 1', NULL, 1, NULL, '2024-08-26 06:52:13', '2024-08-26 06:52:13', NULL, NULL, 12, NULL),
(15, 12, 47, 'option 1', NULL, 1, NULL, '2024-08-26 06:55:51', '2024-08-26 06:55:51', NULL, NULL, 12, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `que_forms`
--

CREATE TABLE `que_forms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `que_forms`
--

INSERT INTO `que_forms` (`id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(23, 'test 1', 1, '2024-08-23 23:42:34', '2024-08-24 00:09:25'),
(24, 'ads', 0, '2024-08-24 00:22:03', '2024-08-24 00:22:03'),
(25, 'Hello', 1, '2024-08-24 06:50:22', '2024-08-24 06:50:59');

-- --------------------------------------------------------

--
-- Table structure for table `que_form_inputs`
--

CREATE TABLE `que_form_inputs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `que_form_id` bigint(20) UNSIGNED DEFAULT NULL,
  `que_form_section_id` bigint(20) UNSIGNED DEFAULT NULL,
  `label` text DEFAULT NULL,
  `placeholder` text DEFAULT NULL,
  `input_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `input_name` text DEFAULT NULL,
  `rating_id` bigint(22) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `que_form_inputs`
--

INSERT INTO `que_form_inputs` (`id`, `que_form_id`, `que_form_section_id`, `label`, `placeholder`, `input_type_id`, `input_name`, `rating_id`, `created_at`, `updated_at`) VALUES
(31, 17, 23, 'test', 'input', 1, 'test-one-input-text-1723112153', NULL, '2024-08-08 04:46:25', '2024-08-08 04:46:25'),
(32, 17, 23, 'radio', 'test', 8, 'test-one-radio-1723112179', NULL, '2024-08-08 04:46:25', '2024-08-08 04:49:01'),
(33, 18, 24, 'test', 'input', 1, 'test-one-input-text-1723112153', NULL, '2024-08-08 04:49:20', '2024-08-08 04:49:20'),
(34, 18, 24, 'radio', 'test', 6, 'test-one-radio-1723112179', NULL, '2024-08-08 04:49:20', '2024-08-08 04:49:36'),
(35, 19, 25, 'how do you find the job assigned', NULL, 11, 'mid-year-review-goal-1723359135', 1, '2024-08-11 01:22:19', '2024-08-11 01:22:19'),
(36, 20, 26, 'how do you find the job assigned', NULL, 11, 'mid-year-review-goal-1723719408', 2, '2024-08-15 05:26:54', '2024-08-15 05:26:54'),
(37, 21, 27, 'test', NULL, 11, 'test-goal-1724390070', 1, '2024-08-22 23:45:40', '2024-08-22 23:45:40'),
(38, 21, 27, 'test 2', NULL, 13, 'test-development-1724390086', 4, '2024-08-22 23:45:40', '2024-08-22 23:45:40'),
(39, 21, 27, 'test', 'test', 7, 'test-checkbox-1724390134', NULL, '2024-08-22 23:45:40', '2024-08-22 23:45:40'),
(40, 21, 27, 'resposibility', NULL, 12, NULL, 2, '2024-08-23 00:56:38', '2024-08-23 00:56:59'),
(41, 21, 27, 'hl', 'name', 6, NULL, NULL, '2024-08-23 00:58:19', '2024-08-23 00:58:19'),
(42, 22, 28, 'test', 'option', 7, 'hello-checkbox-1724395166', NULL, '2024-08-23 01:10:49', '2024-08-23 01:10:49'),
(43, 22, 28, 'test', NULL, 10, 'hello-competency-1724395189', 1, '2024-08-23 01:10:49', '2024-08-23 01:10:49'),
(44, 22, 29, 'test 2', NULL, 12, 'hello-responsibility-1724395226', 1, '2024-08-23 01:10:49', '2024-08-23 01:10:49'),
(45, 22, 29, 'test', NULL, 13, 'hello-development-1724395247', 4, '2024-08-23 01:10:49', '2024-08-23 01:10:49'),
(46, 23, 30, 'test', NULL, 11, 'test-1-goal-1724476328', 1, '2024-08-23 23:42:34', '2024-08-23 23:42:34'),
(47, 23, 30, 'resposibility', 'PlaceHolder', 6, 'test-1-radio-1724476350', NULL, '2024-08-23 23:42:34', '2024-08-23 23:42:34'),
(48, 24, 31, 'adsf', NULL, 11, 'ads-goal-1724478721', 1, '2024-08-24 00:22:03', '2024-08-24 00:22:03'),
(49, 25, 32, 'test', NULL, 11, 'hello-goal-1724502005', 1, '2024-08-24 06:50:22', '2024-08-24 06:50:22'),
(50, 25, 32, 'test', NULL, 11, 'hello-goal-1724502020', 4, '2024-08-24 06:50:22', '2024-08-24 06:50:22');

-- --------------------------------------------------------

--
-- Table structure for table `que_form_multiple_inputs`
--

CREATE TABLE `que_form_multiple_inputs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `que_form_id` bigint(20) DEFAULT NULL,
  `label` text DEFAULT NULL,
  `type` text DEFAULT NULL,
  `temp_input_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `que_form_multiple_inputs`
--

INSERT INTO `que_form_multiple_inputs` (`id`, `que_form_id`, `label`, `type`, `temp_input_id`, `created_at`, `updated_at`) VALUES
(4, 17, 'test1', 'radio', 32, '2024-08-08 04:49:01', '2024-08-08 04:49:01'),
(5, 17, 'radio2', 'radio', 32, '2024-08-08 04:49:01', '2024-08-08 04:49:01'),
(6, 17, 'radio3', 'radio', 32, '2024-08-08 04:49:01', '2024-08-08 04:49:01'),
(10, 18, 'test1', 'radio', 34, '2024-08-08 04:49:36', '2024-08-08 04:49:36'),
(11, 18, 'radio2', 'radio', 34, '2024-08-08 04:49:36', '2024-08-08 04:49:36'),
(12, 18, 'radio3', 'radio', 34, '2024-08-08 04:49:36', '2024-08-08 04:49:36'),
(13, 21, 'option 1', 'checkbox', 39, '2024-08-22 23:45:40', '2024-08-22 23:45:40'),
(14, 21, 'option 2', 'checkbox', 39, '2024-08-22 23:45:40', '2024-08-22 23:45:40'),
(15, 21, 'Option', 'hl', 41, '2024-08-23 00:58:19', '2024-08-23 00:58:19'),
(16, 22, 'option 1', 'checkbox', 42, '2024-08-23 01:10:49', '2024-08-23 01:10:49'),
(17, 22, 'option 2', 'checkbox', 42, '2024-08-23 01:10:49', '2024-08-23 01:10:49'),
(18, 23, 'option 1', 'radio', 47, '2024-08-23 23:42:34', '2024-08-23 23:42:34'),
(19, 23, 'option 2', 'radio', 47, '2024-08-23 23:42:34', '2024-08-23 23:42:34');

-- --------------------------------------------------------

--
-- Table structure for table `que_form_sections`
--

CREATE TABLE `que_form_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `que_form_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `sec_id` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `que_form_sections`
--

INSERT INTO `que_form_sections` (`id`, `que_form_id`, `title`, `sec_id`, `status`, `created_at`, `updated_at`) VALUES
(30, 23, 'test', 'sec1724476301', 0, '2024-08-23 23:42:34', '2024-08-23 23:42:34'),
(31, 24, 'asd', 'sec1724478710', 0, '2024-08-24 00:22:03', '2024-08-24 00:22:03'),
(32, 25, 'tests  22', 'sec1724501956', 0, '2024-08-24 06:50:22', '2024-08-24 06:50:49');

-- --------------------------------------------------------

--
-- Table structure for table `rating_scales`
--

CREATE TABLE `rating_scales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(255) NOT NULL,
  `is_include_na` tinyint(1) NOT NULL DEFAULT 0,
  `display_type` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `rating_scales`
--

INSERT INTO `rating_scales` (`id`, `label`, `is_include_na`, `display_type`, `created_at`, `updated_at`) VALUES
(1, 'Communicates effectively with supervisor, peers, and customers.', 0, 0, '2024-05-04 05:09:16', '2024-05-09 00:21:35'),
(2, 'Possesses skills and knowledge to perform the job competently.', 0, 0, '2024-05-04 06:56:52', '2024-05-09 00:20:56'),
(4, 'Possesses skills and knowledge to perform the job competently.', 0, 1, '2024-06-11 08:12:33', '2024-06-11 08:12:33');

-- --------------------------------------------------------

--
-- Table structure for table `rating_scale_options`
--

CREATE TABLE `rating_scale_options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rating_scale_id` bigint(20) UNSIGNED NOT NULL,
  `option_label` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
(24, 4, 'Exceeds Expectations', '2024-06-11 08:12:33', '2024-06-11 08:12:33'),
(25, 5, 'test', '2024-08-08 04:50:38', '2024-08-08 04:50:38'),
(26, 5, 'test2', '2024-08-08 04:50:38', '2024-08-08 04:50:38');

-- --------------------------------------------------------

--
-- Table structure for table `reportees`
--

CREATE TABLE `reportees` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `reportee_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(25, 10, 7, '2024-06-28 14:20:50', '2024-06-28 14:20:50'),
(26, 3, 4, '2024-08-08 13:28:56', '2024-08-08 13:28:56'),
(27, 2, 2, '2024-08-09 05:04:15', '2024-08-09 05:04:15'),
(30, 23, 22, '2024-09-05 07:43:06', '2024-09-05 07:43:06');

-- --------------------------------------------------------

--
-- Table structure for table `responsibilities`
--

CREATE TABLE `responsibilities` (
  `id` int(22) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `discription` text DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `total_progress` varchar(255) DEFAULT NULL,
  `user_id` int(22) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `responsibilities`
--

INSERT INTO `responsibilities` (`id`, `title`, `status`, `discription`, `time`, `total_progress`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'WORK', 'Active', 'TEST', '1723114897', '20', 16, '2024-08-08 11:04:24', '2024-08-08 11:04:24'),
(2, 'Responsibility', 'Active', 'test', '1725106020', '36.363636363636', 1, '2024-08-31 12:08:28', '2024-08-31 12:08:28'),
(3, 'res 2', 'Active', 'test', '1725106122', '28.140703517587998', 1, '2024-08-31 12:09:18', '2024-08-31 12:09:18');

-- --------------------------------------------------------

--
-- Table structure for table `review_cycles`
--

CREATE TABLE `review_cycles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `start_date` varchar(255) DEFAULT NULL,
  `end_date` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `review_cycles`
--

INSERT INTO `review_cycles` (`id`, `title`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`) VALUES
(7, 'Mid Year review 2024', '2024-01-01', '2024-06-30', 1, '2024-08-04 03:53:15', '2024-08-04 03:53:15'),
(8, 'End Of Year Review 2024', '2024-07-01', '2024-12-31', 1, '2024-08-04 03:54:44', '2024-08-04 03:54:44');

-- --------------------------------------------------------

--
-- Table structure for table `review_templates`
--

CREATE TABLE `review_templates` (
  `id` int(11) NOT NULL,
  `temp_name` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
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
(1, 3),
(2, 3),
(3, 2),
(3, 3),
(4, 3),
(8, 1),
(8, 2),
(8, 3),
(9, 1),
(9, 2),
(9, 3),
(11, 2),
(11, 3),
(12, 1),
(12, 2),
(12, 3),
(13, 2),
(13, 3),
(14, 2),
(15, 2),
(15, 3),
(17, 1),
(17, 2),
(17, 3),
(18, 1),
(18, 3),
(19, 1),
(19, 3),
(20, 1),
(20, 3),
(21, 2),
(21, 3),
(22, 3),
(23, 2),
(23, 3),
(24, 1),
(24, 2),
(27, 2);

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `skills` text DEFAULT NULL,
  `experience` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `employee_id`, `skills`, `experience`, `created_at`, `updated_at`) VALUES
(2, 4, 'tests', NULL, '2024-08-08 05:13:38', '2024-08-08 05:13:38'),
(3, 4, 'test', NULL, '2024-08-10 05:48:24', '2024-08-10 05:48:24');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `start_date` varchar(255) DEFAULT NULL,
  `end_date` varchar(255) DEFAULT NULL,
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
  `input_name` text DEFAULT NULL,
  `rating_id` bigint(22) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `temp_input_types`
--

INSERT INTO `temp_input_types` (`id`, `label`, `input_type_id`, `placeholder`, `input_name`, `rating_id`, `created_at`, `updated_at`) VALUES
(4, 'test', 12, NULL, 'test-responsibility-1724390390', 2, '2024-08-22 23:49:50', '2024-08-22 23:49:50');

-- --------------------------------------------------------

--
-- Table structure for table `temp_multiple_input_options`
--

CREATE TABLE `temp_multiple_input_options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `temp_input_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trainings`
--

CREATE TABLE `trainings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `start_time` varchar(255) DEFAULT NULL,
  `end_time` varchar(255) DEFAULT NULL,
  `certificate` int(11) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `institution_or_training_provider` varchar(255) DEFAULT NULL,
  `start_date` varchar(255) DEFAULT NULL,
  `completion_date` varchar(255) DEFAULT NULL,
  `certificate_award` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trainings`
--

INSERT INTO `trainings` (`id`, `title`, `status`, `description`, `start_time`, `end_time`, `certificate`, `user_id`, `institution_or_training_provider`, `start_date`, `completion_date`, `certificate_award`, `created_at`, `updated_at`) VALUES
(1, 'test', 2, 'test', '2024-08-08 11:06:14', '2024-08-08', NULL, 16, 'AIMS', '2024-08-08', '2024-08-08', 1, '2024-08-08 05:36:14', '2024-08-08 05:37:12'),
(2, 'test', 0, 'test', NULL, '2024-08-08', NULL, 16, 'PIMD', '2024-08-08', '2024-08-08', 1, '2024-08-08 05:39:22', '2024-08-08 05:39:59'),
(3, 'test', 0, 'ss', NULL, NULL, NULL, 16, 'test', '2024-08-08', NULL, 0, '2024-08-08 05:41:36', '2024-08-08 05:41:36');

-- --------------------------------------------------------

--
-- Table structure for table `upload_files`
--

CREATE TABLE `upload_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `file_uid` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `upload_files`
--

INSERT INTO `upload_files` (`id`, `file`, `file_uid`, `created_at`, `updated_at`) VALUES
(10, '1718114119.jpg', NULL, '2024-06-11 08:25:19', '2024-06-11 08:25:19'),
(12, '1721992501.png', NULL, '2024-07-26 05:45:01', '2024-07-26 05:45:01'),
(15, '1721993036.png', NULL, '2024-07-26 05:53:56', '2024-07-26 05:53:56'),
(17, '1721993059.png', NULL, '2024-07-26 05:54:19', '2024-07-26 05:54:19'),
(18, '1721993085.png', NULL, '2024-07-26 05:54:45', '2024-07-26 05:54:45'),
(19, '1722412586.jpg', NULL, '2024-07-31 02:26:27', '2024-07-31 02:26:27'),
(20, '1722412608.png', NULL, '2024-07-31 02:26:48', '2024-07-31 02:26:48'),
(21, '1722412664.jpg', NULL, '2024-07-31 02:27:44', '2024-07-31 02:27:44'),
(22, '1722413593.jpg', NULL, '2024-07-31 02:43:13', '2024-07-31 02:43:13'),
(23, '1722413625.jpg', NULL, '2024-07-31 02:43:45', '2024-07-31 02:43:45'),
(24, '1722413646.png', NULL, '2024-07-31 02:44:06', '2024-07-31 02:44:06'),
(25, '1723107786.png', NULL, '2024-08-08 03:33:06', '2024-08-08 03:33:06'),
(26, '1723109600.png', NULL, '2024-08-08 04:03:20', '2024-08-08 04:03:20'),
(27, '1723109797.jpg', NULL, '2024-08-08 04:06:37', '2024-08-08 04:06:37'),
(28, '1723119570.png', NULL, '2024-08-08 06:49:30', '2024-08-08 06:49:30'),
(29, '1723119600.jpg', NULL, '2024-08-08 06:50:00', '2024-08-08 06:50:00'),
(30, '1723288077.png', NULL, '2024-08-10 05:37:57', '2024-08-10 05:37:57'),
(31, '1724231258.jpg', NULL, '2024-08-21 03:37:38', '2024-08-21 03:37:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `employment_start` varchar(50) DEFAULT NULL,
  `employment_end` varchar(50) DEFAULT NULL,
  `reporting_to` int(11) DEFAULT NULL,
  `manager_id` int(11) DEFAULT NULL,
  `d_o_b` varchar(50) DEFAULT NULL,
  `employee_code` varchar(255) DEFAULT NULL,
  `is_login` int(11) NOT NULL DEFAULT 0 COMMENT 'admin=0,user=1',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `national_id` varchar(255) DEFAULT NULL,
  `phone_number` bigint(20) UNSIGNED DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `marital_status` varchar(255) DEFAULT NULL,
  `emergency_contact` bigint(20) UNSIGNED DEFAULT NULL,
  `language_id` varchar(255) DEFAULT NULL,
  `file_id` bigint(20) UNSIGNED DEFAULT NULL,
  `residention_address` longtext DEFAULT NULL,
  `job_title` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `department_id`, `employment_start`, `employment_end`, `reporting_to`, `manager_id`, `d_o_b`, `employee_code`, `is_login`, `email_verified_at`, `password`, `remember_token`, `national_id`, `phone_number`, `gender`, `nationality`, `marital_status`, `emergency_contact`, `language_id`, `file_id`, `residention_address`, `job_title`, `created_at`, `updated_at`) VALUES
(1, 'Chetan Bairag', 'chetan@gmail.com', 1, '2023-10-25', NULL, 4, 4, '2023-10-04', 'CHETAN1989', 0, NULL, '$2y$10$VlZhAqtBpCA0375u6JKxRe6p9nVLh0rlk8uRRr0L0sey3Pdd.DiQS', 'jqV14hucJYlM9UYGznP4qroywTjXgwAhhD5x8apTJ7J7dc4t87PcRaqQPZVk', '658-87-45', 987654321, 'male', '2', 'single', NULL, '2,3', NULL, 'test', NULL, '2023-10-31 05:11:58', '2024-05-16 09:15:05'),
(2, 'HR', 'hr@gmail.com', 2, '2023-10-26', NULL, 4, 4, '2023-10-12', 'RAHUL1989', 0, NULL, '$2y$10$V/uX/ew/fnPicJYXtrKTV.DEbvXFdcy1lUIm.QG4SjHbnYIvkEef.', 'HMAFIso0aKzkM5wH7HzMQgVwDn5oResZFdQucvnzoUFFOHAhOqsp1FrAPEqn', '658-87-45', 987654321, 'male', '1', 'single', NULL, '2', NULL, 'test', 'HR', '2023-10-31 05:19:04', '2024-08-08 23:34:15'),
(3, 'Rahul Parmar', 'rahul@gmail.com', 3, '2023-11-15', NULL, 4, 4, '2023-11-15', 'RAHUL1989', 0, NULL, '$2y$10$I663JuUbKheBkoG/pyGIoOFeVvQ7eJa0oosC3Gv6BMDXd5VK6yl2.', 'FSnAXWLRFu2uUZ1mnq7OVruPFq6rj65CJ3dj0BT982rZPaXmbSg7zl6LwZmy', '993623656', 7896585214, 'male', '101', 'married', NULL, '2,3', NULL, 'test', 'test', '2023-11-01 01:38:18', '2024-08-08 07:58:56'),
(4, 'Kishor Kumar', 'kishor@gmail.com', 1, '2023-11-08', NULL, 2, 4, '2023-11-15', 'KISHOR1989', 0, NULL, '$2y$10$I663JuUbKheBkoG/pyGIoOFeVvQ7eJa0oosC3Gv6BMDXd5VK6yl2.', 'b8bZRMxo9DEQCnxNraz6OzmoVWRUUbPori1tiArBQQFLj4aC8NkWGNWc8Rl1', '658-87-45', 987654321, 'male', '101', 'single', NULL, '2,3', 30, 'test', NULL, '2023-11-01 01:41:33', '2024-08-10 05:37:57'),
(7, 'Vishal Mukati', 'vishal@gmail.com', 1, '2023-11-07', NULL, 1, 4, '2023-11-22', 'VISHAL1989', 0, NULL, '$2y$10$I663JuUbKheBkoG/pyGIoOFeVvQ7eJa0oosC3Gv6BMDXd5VK6yl2.', 'niswFcwGhb8YCutGWEd7Ul4PVfs7H7y93DkXd1imRhEMsBNUgItKcB0nkgFN', '658-87-45', 987654321, 'male', '82', 'married', NULL, '2,3', NULL, 'test', NULL, '2023-11-01 02:04:03', '2024-05-16 09:18:00'),
(10, 'Abhishek Patel1', 'abhishek@gmail.com', 1, '2023-11-15', NULL, 1, 3, '2023-11-21', 'ABHISHEK1989', 0, NULL, '$2y$10$I663JuUbKheBkoG/pyGIoOFeVvQ7eJa0oosC3Gv6BMDXd5VK6yl2.', 'o0OVtu5uXmYaXeqjj4JzVnfWFpBKDxL91uYz1yPIZrER5kqTMjzq8ssjfOhH', '658-87-45', 987654321, 'male', '3', 'single', NULL, '3', NULL, 'Glacis, Mahe, Seychelles', 'Programmer', '2023-11-01 03:48:56', '2024-06-28 08:50:50'),
(14, 'atul', 'atul@gmail.com', 3, '2024-05-09', NULL, 4, 3, '2024-05-08', 'test@12', 0, NULL, '$2y$10$U5SCUuCpAy9rf8QpiWzHk.Mn5Fn0aJZvVJRf7PqezCy3CMAbrWsMq', NULL, '658-87-45', 987654321, 'male', 'Indian', 'single', 987654321, '2,3', NULL, NULL, NULL, '2024-05-04 05:25:20', '2024-05-04 05:25:20'),
(16, 'Elton', 'elton@gmail.com', 3, '2024-05-05', NULL, 2, 4, '2012-05-03', '001', 0, NULL, '$2y$10$4kR.kT.G1o8NUb6wUsAcbOBcSphKV405xLPgDA5x06MqSzFi4TBde', '5LhjxvCdjynKbq65daVyqnogTXql6j5gUv04JgkDyVyAvE8yZ4RA8MGNLAQz', '6388895993000230', 2589117, 'male', '194', 'married', NULL, '3', 24, 'Mahe', 'test', '2024-05-05 01:39:36', '2024-07-31 04:59:27'),
(17, 'Cosette', 'cosette@gmail.com', 2, '2024-05-29', NULL, 2, 4, '2024-05-13', '01', 0, NULL, '$2y$10$hSKrWBYIM7cfk4yhQJCiieGb7s0QikGjpIfJCs4nZ/Kmykn/slBHa', NULL, '4445789088', 2589117, 'female', '194', 'married', NULL, '3', NULL, 'Mahe', NULL, '2024-05-29 10:40:31', '2024-05-29 10:40:31'),
(19, 'Maria', 'maria@gmail.com', 4, '2014-06-03', NULL, 17, 17, '1987-08-06', '002', 0, NULL, '$2y$10$2X/thb9npEeJfL.jsFU/Xu8bNrvmi7XfOGjEZvoi3edNnNNf3kh3y', 'IYR787tdNXXEe10wVi806XOJyp8w0957d74FisdTJzsMMKaQkNBxlLzO4fJp', '88499403087837', 235567889, 'female', '194', 'married', NULL, '3', 31, 'victoria', 'Senior warehouse supervisor', '2024-08-21 03:30:56', '2024-08-21 03:37:38');

-- --------------------------------------------------------

--
-- Table structure for table `wages_and_benefits`
--

CREATE TABLE `wages_and_benefits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `items` varchar(255) DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
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
-- Indexes for table `goal_reviews`
--
ALTER TABLE `goal_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `goal_review_stores`
--
ALTER TABLE `goal_review_stores`
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
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appraisals`
--
ALTER TABLE `appraisals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `assess_potentials`
--
ALTER TABLE `assess_potentials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `certificate`
--
ALTER TABLE `certificate`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `company_announcements`
--
ALTER TABLE `company_announcements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `competencies`
--
ALTER TABLE `competencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `developments`
--
ALTER TABLE `developments`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `disciplinary_letters`
--
ALTER TABLE `disciplinary_letters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `document_categories`
--
ALTER TABLE `document_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `educations`
--
ALTER TABLE `educations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `emergency_contacts`
--
ALTER TABLE `emergency_contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `goals`
--
ALTER TABLE `goals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `goal_categories`
--
ALTER TABLE `goal_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `goal_reviews`
--
ALTER TABLE `goal_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `goal_review_stores`
--
ALTER TABLE `goal_review_stores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `goal_statuses`
--
ALTER TABLE `goal_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `input_types`
--
ALTER TABLE `input_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `key_results`
--
ALTER TABLE `key_results`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `leave_requests`
--
ALTER TABLE `leave_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questionnaires`
--
ALTER TABLE `questionnaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `que_forms`
--
ALTER TABLE `que_forms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `que_form_inputs`
--
ALTER TABLE `que_form_inputs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `que_form_multiple_inputs`
--
ALTER TABLE `que_form_multiple_inputs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `que_form_sections`
--
ALTER TABLE `que_form_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `rating_scales`
--
ALTER TABLE `rating_scales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rating_scale_options`
--
ALTER TABLE `rating_scale_options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `reportees`
--
ALTER TABLE `reportees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `responsibilities`
--
ALTER TABLE `responsibilities`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `review_cycles`
--
ALTER TABLE `review_cycles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temp_input_types`
--
ALTER TABLE `temp_input_types`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `temp_multiple_input_options`
--
ALTER TABLE `temp_multiple_input_options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `trainings`
--
ALTER TABLE `trainings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `upload_files`
--
ALTER TABLE `upload_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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
