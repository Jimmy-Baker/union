-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 03, 2022 at 12:24 PM
-- Server version: 10.5.12-MariaDB-cll-lve
-- PHP Version: 7.2.34

-- User: u308745100_bakerdtk --
-- Password: S#Da5;1x

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u308745100_union`
--
CREATE DATABASE IF NOT EXISTS `u308745100_union` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `u308745100_union`;

-- --------------------------------------------------------

--
-- Table structure for table `access_types`
--

DROP TABLE IF EXISTS `access_types`;
CREATE TABLE `access_types` (
  `abv` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `access_types`
--

INSERT INTO `access_types` (`abv`, `description`) VALUES
('AA', 'Administrator'),
('GM', 'Gym Manager'),
('GS', 'Gym Staff'),
('MM', 'Member');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `user_id` int(8) NOT NULL,
  `location_id` smallint(4) NOT NULL,
  `time_in` datetime DEFAULT current_timestamp(),
  `time_out` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `user_id`, `location_id`, `time_in`, `time_out`) VALUES
(20, 80, 37, '2022-05-03 09:51:56', '2022-05-03 10:05:33'),
(21, 83, 37, '2022-05-03 09:53:55', NULL),
(22, 86, 37, '2022-05-03 09:55:32', NULL),
(23, 85, 37, '2022-05-03 09:56:00', NULL),
(24, 82, 37, '2022-05-03 10:00:40', '2022-05-03 10:05:25');

-- --------------------------------------------------------

--
-- Table structure for table `audits`
--

DROP TABLE IF EXISTS `audits`;
CREATE TABLE `audits` (
  `pk` int(11) NOT NULL,
  `type` enum('I','U','D') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `table_name` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `record_id` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `old_values` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`old_values`)),
  `new_values` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`new_values`)),
  `applied_by` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `applied_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audits`
--

INSERT INTO `audits` (`pk`, `type`, `table_name`, `record_id`, `old_values`, `new_values`, `applied_by`, `applied_on`) VALUES
(1, 'I', 'gyms', '13', NULL, '{\"id\": 13, \"gym_name\": \"Rock City\", \"website\": \"https://www.rockcity.com\", \"avatar_url\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 02:04:41'),
(2, 'I', 'gyms', '14', NULL, '{\"id\": 14, \"gym_name\": \"The Summit\", \"website\": \"https://www.summitgym.com\", \"avatar_url\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 02:04:41'),
(3, 'I', 'gyms', '15', NULL, '{\"id\": 15, \"gym_name\": \"Iron Mountain\", \"website\": \"https://www.iron-mountain.com\", \"avatar_url\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 02:04:41'),
(4, 'I', 'gyms', '16', NULL, '{\"id\": 16, \"gym_name\": \"ClimbWorks\", \"website\": \"https://www.climbworks.com\", \"avatar_url\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 02:04:41'),
(5, 'I', 'gyms', '17', NULL, '{\"id\": 17, \"gym_name\": \"Xperia\", \"website\": \"https://www.xperia.com\", \"avatar_url\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 02:04:41'),
(6, 'I', 'gyms', '18', NULL, '{\"id\": 18, \"gym_name\": \"Area 42\", \"website\": \"https://www.area42.com\", \"avatar_url\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 02:04:41'),
(7, 'I', 'gyms', '19', NULL, '{\"id\": 19, \"gym_name\": \"The Hangar\", \"website\": \"https://www.hangarclimbing.com\", \"avatar_url\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 02:04:41'),
(8, 'I', 'gyms', '20', NULL, '{\"id\": 20, \"gym_name\": \"Keystone\", \"website\": \"https://www.keystonegym.com\", \"avatar_url\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 02:04:41'),
(9, 'I', 'gyms', '21', NULL, '{\"id\": 21, \"gym_name\": \"Ascension\", \"website\": \"https://www.ascension.com\", \"avatar_url\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 02:04:41'),
(10, 'I', 'gyms', '22', NULL, '{\"id\": 22, \"gym_name\": \"IBEX\", \"website\": \"https://www.ibexwa.com\", \"avatar_url\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 02:04:41'),
(11, 'U', 'gyms', '13', '{\"id\": 13, \"gym_name\": \"Rock City\", \"website\": \"https://www.rockcity.com\", \"avatar_url\": \"\"}', '{\"id\": 13, \"gym_name\": \"Rock City\", \"website\": \"https://www.rockcity.com\", \"avatar_url\": \"\\\"/public/upload/gym/default.png\\\"\"}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 02:06:25'),
(12, 'U', 'gyms', '14', '{\"id\": 14, \"gym_name\": \"The Summit\", \"website\": \"https://www.summitgym.com\", \"avatar_url\": \"\"}', '{\"id\": 14, \"gym_name\": \"The Summit\", \"website\": \"https://www.summitgym.com\", \"avatar_url\": \"\\\"/public/upload/gym/default.png\\\"\"}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 02:06:27'),
(13, 'U', 'gyms', '15', '{\"id\": 15, \"gym_name\": \"Iron Mountain\", \"website\": \"https://www.iron-mountain.com\", \"avatar_url\": \"\"}', '{\"id\": 15, \"gym_name\": \"Iron Mountain\", \"website\": \"https://www.iron-mountain.com\", \"avatar_url\": \"\\\"/public/upload/gym/default.png\\\"\"}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 02:06:30'),
(14, 'U', 'gyms', '16', '{\"id\": 16, \"gym_name\": \"ClimbWorks\", \"website\": \"https://www.climbworks.com\", \"avatar_url\": \"\"}', '{\"id\": 16, \"gym_name\": \"ClimbWorks\", \"website\": \"https://www.climbworks.com\", \"avatar_url\": \"\\\"/public/upload/gym/default.png\\\"\"}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 02:06:32'),
(15, 'U', 'gyms', '17', '{\"id\": 17, \"gym_name\": \"Xperia\", \"website\": \"https://www.xperia.com\", \"avatar_url\": \"\"}', '{\"id\": 17, \"gym_name\": \"Xperia\", \"website\": \"https://www.xperia.com\", \"avatar_url\": \"\\\"/public/upload/gym/default.png\\\"\"}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 02:06:34'),
(16, 'U', 'gyms', '18', '{\"id\": 18, \"gym_name\": \"Area 42\", \"website\": \"https://www.area42.com\", \"avatar_url\": \"\"}', '{\"id\": 18, \"gym_name\": \"Area 42\", \"website\": \"https://www.area42.com\", \"avatar_url\": \"\\\"/public/upload/gym/default.png\\\"\"}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 02:06:36'),
(17, 'U', 'gyms', '19', '{\"id\": 19, \"gym_name\": \"The Hangar\", \"website\": \"https://www.hangarclimbing.com\", \"avatar_url\": \"\"}', '{\"id\": 19, \"gym_name\": \"The Hangar\", \"website\": \"https://www.hangarclimbing.com\", \"avatar_url\": \"\\\"/public/upload/gym/default.png\\\"\"}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 02:06:37'),
(18, 'U', 'gyms', '20', '{\"id\": 20, \"gym_name\": \"Keystone\", \"website\": \"https://www.keystonegym.com\", \"avatar_url\": \"\"}', '{\"id\": 20, \"gym_name\": \"Keystone\", \"website\": \"https://www.keystonegym.com\", \"avatar_url\": \"\\\"/public/upload/gym/default.png\\\"\"}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 02:06:39'),
(19, 'U', 'gyms', '21', '{\"id\": 21, \"gym_name\": \"Ascension\", \"website\": \"https://www.ascension.com\", \"avatar_url\": \"\"}', '{\"id\": 21, \"gym_name\": \"Ascension\", \"website\": \"https://www.ascension.com\", \"avatar_url\": \"\\\"/public/upload/gym/default.png\\\"\"}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 02:06:41'),
(20, 'U', 'gyms', '22', '{\"id\": 22, \"gym_name\": \"IBEX\", \"website\": \"https://www.ibexwa.com\", \"avatar_url\": \"\"}', '{\"id\": 22, \"gym_name\": \"IBEX\", \"website\": \"https://www.ibexwa.com\", \"avatar_url\": \"\\\"/public/upload/gym/default.png\\\"\"}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 02:07:49'),
(21, 'I', 'users', '47', NULL, '{\"id\": 47, \"first_name\": \"James\", \"last_name\": \"Baker\", \"middle_name\": \"Robert\", \"preferred_name\": \"Jimmy\", \"birth_date\": \"0000-00-00 00:00:00\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"PO Box 2012\", \"city\": \"Enka\", \"zip\": 28728, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"baker.jimmy@gmail.com\", \"phone_primary\": \"2526465221\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Caet\", \"last_name_emergency\": \"Cash\", \"phone_emergency\": \"8284507973\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"AA\", \"created_at\": \"2022-05-01 02:25:04\", \"primary_location\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 02:25:04'),
(22, 'I', 'users', '48', NULL, '{\"id\": 48, \"first_name\": \"Caitlin\", \"last_name\": \"Cash\", \"middle_name\": \"Presti\", \"preferred_name\": \"Caet\", \"birth_date\": \"0000-00-00 00:00:00\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"PO Box 2012\", \"city\": \"Enka\", \"zip\": 28728, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"caet@test.com\", \"phone_primary\": \"8284507973\", \"phone_p_country\": 1, \"phone_secondary\": \"phone_second\", \"phone_s_country\": 0, \"first_name_emergency\": \"Jimmy\", \"last_name_emergency\": \"Baker\", \"phone_emergency\": \"2526465221\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"AA\", \"created_at\": \"2022-05-01 02:25:04\", \"primary_location\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 02:25:04'),
(23, 'I', 'users', '49', NULL, '{\"id\": 49, \"first_name\": \"Erin\", \"last_name\": \"Li\", \"middle_name\": null, \"preferred_name\": null, \"birth_date\": \"0000-00-00 00:00:00\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"115 Hyacinth Avenue\", \"city\": \"Boulder\", \"zip\": 80302, \"state_abv\": \"CO\", \"country_abv\": \"US\", \"email\": \"erin2@test.com\", \"phone_primary\": \"4645153212\", \"phone_p_country\": 1, \"phone_secondary\": \"phone_second\", \"phone_s_country\": 0, \"first_name_emergency\": \"Carl\", \"last_name_emergency\": \"Weathers\", \"phone_emergency\": \"4645218705\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"AA\", \"created_at\": \"2022-05-01 02:25:04\", \"primary_location\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 02:25:04'),
(24, 'U', 'users', '47', '{\"id\": 47, \"first_name\": \"James\", \"last_name\": \"Baker\", \"middle_name\": \"Robert\", \"preferred_name\": \"Jimmy\", \"birth_date\": \"0000-00-00\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"PO Box 2012\", \"city\": \"Enka\", \"zip\": 28728, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"baker.jimmy@gmail.com\", \"phone_primary\": \"2526465221\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Caet\", \"last_name_emergency\": \"Cash\", \"phone_emergency\": \"8284507973\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"AA\", \"created_at\": \"2022-05-01 02:25:04\", \"primary_location\": 0}', '{\"id\": 47, \"first_name\": \"James\", \"last_name\": \"Baker\", \"middle_name\": \"Robert\", \"preferred_name\": \"Jimmy\", \"birth_date\": \"1991-02-12\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"PO Box 2012\", \"city\": \"Enka\", \"zip\": 28728, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"baker.jimmy@gmail.com\", \"phone_primary\": \"2526465221\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Caet\", \"last_name_emergency\": \"Cash\", \"phone_emergency\": \"8284507973\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"AA\", \"created_at\": \"2022-05-01 02:27:17\", \"primary_location\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 02:27:17'),
(25, 'U', 'users', '48', '{\"id\": 48, \"first_name\": \"Caitlin\", \"last_name\": \"Cash\", \"middle_name\": \"Presti\", \"preferred_name\": \"Caet\", \"birth_date\": \"0000-00-00\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"PO Box 2012\", \"city\": \"Enka\", \"zip\": 28728, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"caet@test.com\", \"phone_primary\": \"8284507973\", \"phone_p_country\": 1, \"phone_secondary\": \"phone_second\", \"phone_s_country\": 0, \"first_name_emergency\": \"Jimmy\", \"last_name_emergency\": \"Baker\", \"phone_emergency\": \"2526465221\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"AA\", \"created_at\": \"2022-05-01 02:25:04\", \"primary_location\": 0}', '{\"id\": 48, \"first_name\": \"Caitlin\", \"last_name\": \"Cash\", \"middle_name\": \"Presti\", \"preferred_name\": \"Caet\", \"birth_date\": \"1990-03-02\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"PO Box 2012\", \"city\": \"Enka\", \"zip\": 28728, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"caet@test.com\", \"phone_primary\": \"8284507973\", \"phone_p_country\": 1, \"phone_secondary\": \"phone_second\", \"phone_s_country\": 0, \"first_name_emergency\": \"Jimmy\", \"last_name_emergency\": \"Baker\", \"phone_emergency\": \"2526465221\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"AA\", \"created_at\": \"2022-05-01 02:27:25\", \"primary_location\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 02:27:25'),
(26, 'D', 'users', '47', '{\"id\": 47, \"first_name\": \"James\", \"last_name\": \"Baker\", \"middle_name\": \"Robert\", \"preferred_name\": \"Jimmy\", \"birth_date\": \"1991-02-12\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"PO Box 2012\", \"city\": \"Enka\", \"zip\": 28728, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"baker.jimmy@gmail.com\", \"phone_primary\": \"2526465221\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Caet\", \"last_name_emergency\": \"Cash\", \"phone_emergency\": \"8284507973\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"AA\", \"created_at\": \"2022-05-01 02:27:17\", \"primary_location\": 0}', NULL, 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 02:30:43'),
(27, 'D', 'users', '48', '{\"id\": 48, \"first_name\": \"Caitlin\", \"last_name\": \"Cash\", \"middle_name\": \"Presti\", \"preferred_name\": \"Caet\", \"birth_date\": \"1990-03-02\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"PO Box 2012\", \"city\": \"Enka\", \"zip\": 28728, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"caet@test.com\", \"phone_primary\": \"8284507973\", \"phone_p_country\": 1, \"phone_secondary\": \"phone_second\", \"phone_s_country\": 0, \"first_name_emergency\": \"Jimmy\", \"last_name_emergency\": \"Baker\", \"phone_emergency\": \"2526465221\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"AA\", \"created_at\": \"2022-05-01 02:27:25\", \"primary_location\": 0}', NULL, 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 02:30:43'),
(28, 'D', 'users', '49', '{\"id\": 49, \"first_name\": \"Erin\", \"last_name\": \"Li\", \"middle_name\": null, \"preferred_name\": null, \"birth_date\": \"0000-00-00\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"115 Hyacinth Avenue\", \"city\": \"Boulder\", \"zip\": 80302, \"state_abv\": \"CO\", \"country_abv\": \"US\", \"email\": \"erin2@test.com\", \"phone_primary\": \"4645153212\", \"phone_p_country\": 1, \"phone_secondary\": \"phone_second\", \"phone_s_country\": 0, \"first_name_emergency\": \"Carl\", \"last_name_emergency\": \"Weathers\", \"phone_emergency\": \"4645218705\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"AA\", \"created_at\": \"2022-05-01 02:25:04\", \"primary_location\": 0}', NULL, 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 02:30:43'),
(29, 'I', 'users', '50', NULL, '{\"id\": 50, \"first_name\": \"James\", \"last_name\": \"Baker\", \"middle_name\": \"Robert\", \"preferred_name\": \"Jimmy\", \"birth_date\": \"1991-02-12\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"PO Box 2012\", \"city\": \"Enka\", \"zip\": 28728, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"baker.jimmy@gmail.com\", \"phone_primary\": \"2526465221\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Caet\", \"last_name_emergency\": \"Cash\", \"phone_emergency\": \"8284507973\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"AA\", \"created_at\": \"2022-05-01 02:31:04\", \"primary_location\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 02:31:04'),
(30, 'I', 'users', '51', NULL, '{\"id\": 51, \"first_name\": \"Caitlin\", \"last_name\": \"Cash\", \"middle_name\": \"Presti\", \"preferred_name\": \"Caet\", \"birth_date\": \"1991-03-02\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"PO Box 2012\", \"city\": \"Enka\", \"zip\": 28728, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"caet@test.com\", \"phone_primary\": \"8284507973\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Jimmy\", \"last_name_emergency\": \"Baker\", \"phone_emergency\": \"2526465221\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"AA\", \"created_at\": \"2022-05-01 02:31:04\", \"primary_location\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 02:31:04'),
(31, 'I', 'users', '52', NULL, '{\"id\": 52, \"first_name\": \"Erin\", \"last_name\": \"Li\", \"middle_name\": null, \"preferred_name\": null, \"birth_date\": \"1987-10-20\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"115 Hyacinth Avenue\", \"city\": \"Boulder\", \"zip\": 80302, \"state_abv\": \"CO\", \"country_abv\": \"US\", \"email\": \"erin2@test.com\", \"phone_primary\": \"4645153212\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Carl\", \"last_name_emergency\": \"Weathers\", \"phone_emergency\": \"4645218705\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"AA\", \"created_at\": \"2022-05-01 02:31:04\", \"primary_location\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 02:31:04'),
(32, 'I', 'users', '53', NULL, '{\"id\": 53, \"first_name\": \"Aaron\", \"last_name\": \"Novicek\", \"middle_name\": null, \"preferred_name\": null, \"birth_date\": \"1989-10-03\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"930 Greenlee Way\", \"city\": \"Asheville\", \"zip\": 28806, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"aaron@test.com\", \"phone_primary\": \"3236985530\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Alec\", \"last_name_emergency\": \"Novicek\", \"phone_emergency\": \"2026462252\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GM\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 04:43:33'),
(33, 'I', 'users', '54', NULL, '{\"id\": 54, \"first_name\": \"Kevin\", \"last_name\": \"Roadbletter\", \"middle_name\": \"William\", \"preferred_name\": null, \"birth_date\": \"1993-07-11\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"6005 Park Terrace\", \"city\": \"Raleigh\", \"zip\": 27601, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"kevin@test.com\", \"phone_primary\": \"8875652140\", \"phone_p_country\": 1, \"phone_secondary\": \"5465235541\", \"phone_s_country\": 1, \"first_name_emergency\": \"Gideon\", \"last_name_emergency\": \"Roadbletter\", \"phone_emergency\": \"8465213320\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GM\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 04:43:33'),
(34, 'I', 'users', '55', NULL, '{\"id\": 55, \"first_name\": \"Sydney\", \"last_name\": \"Steeple\", \"middle_name\": \"Erin\", \"preferred_name\": null, \"birth_date\": \"1995-01-06\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"14 Mulberry Creek Road\", \"city\": \"Golden\", \"zip\": 80402, \"state_abv\": \"CO\", \"country_abv\": \"US\", \"email\": \"sydney@test.com\", \"phone_primary\": \"46589952033\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Susie\", \"last_name_emergency\": \"Steeple\", \"phone_emergency\": \"8486239951\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GM\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 04:43:33'),
(35, 'I', 'users', '56', NULL, '{\"id\": 56, \"first_name\": \"Danielle\", \"last_name\": \"Johnson\", \"middle_name\": null, \"preferred_name\": \"DJ\", \"birth_date\": \"0000-00-00\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"106 Blackbird Drive\", \"city\": \"Ft. Collins\", \"zip\": 80522, \"state_abv\": \"CO\", \"country_abv\": \"US\", \"email\": \"dj@test.com\", \"phone_primary\": \"6165230065\", \"phone_p_country\": 1, \"phone_secondary\": \"8652446592\", \"phone_s_country\": 1, \"first_name_emergency\": \"Victor\", \"last_name_emergency\": \"Johnson\", \"phone_emergency\": \"8185253464\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GM\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 04:43:33'),
(36, 'I', 'users', '57', NULL, '{\"id\": 57, \"first_name\": \"William\", \"last_name\": \"Flintlock\", \"middle_name\": null, \"preferred_name\": \"Will\", \"birth_date\": \"1999-07-12\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"38002 5th Place\", \"city\": \"Brooklyn\", \"zip\": 11216, \"state_abv\": \"NY\", \"country_abv\": \"US\", \"email\": \"will@test.com\", \"phone_primary\": \"2026585541\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Clarice\", \"last_name_emergency\": \"Flintlock\", \"phone_emergency\": \"8985305122\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GM\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 04:43:33'),
(37, 'I', 'users', '58', NULL, '{\"id\": 58, \"first_name\": \"Catalina\", \"last_name\": \"Vespera\", \"middle_name\": \"Elizabeth\", \"preferred_name\": \"Cat\", \"birth_date\": \"1988-05-08\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"9302 Richmond Boulevard\", \"city\": \"Los Angeles\", \"zip\": 90004, \"state_abv\": \"CA\", \"country_abv\": \"US\", \"email\": \"cat@test.com\", \"phone_primary\": \"4652399820\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Harlen\", \"last_name_emergency\": \"Vespera\", \"phone_emergency\": \"5053136625\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GM\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 04:43:33'),
(38, 'I', 'users', '59', NULL, '{\"id\": 59, \"first_name\": \"Sarah\", \"last_name\": \"Shirley\", \"middle_name\": \"Elizabeth\", \"preferred_name\": \"Liz\", \"birth_date\": \"1994-09-30\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"829 Birch Street\", \"city\": \"Asheville\", \"zip\": 28803, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"liz@test.com\", \"phone_primary\": \"6865209847\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Chase\", \"last_name_emergency\": \"Stokes\", \"phone_emergency\": \"6496626527\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GM\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 04:43:33'),
(39, 'I', 'users', '60', NULL, '{\"id\": 60, \"first_name\": \"Justin\", \"last_name\": \"Scott\", \"middle_name\": \"Robert\", \"preferred_name\": null, \"birth_date\": \"2003-11-07\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"2009 Weebly Drive\", \"city\": \"Cary\", \"zip\": 28601, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"justin@test.com\", \"phone_primary\": \"6165326840\", \"phone_p_country\": 1, \"phone_secondary\": \"6465225649\", \"phone_s_country\": 1, \"first_name_emergency\": \"LLoyd\", \"last_name_emergency\": \"Scott\", \"phone_emergency\": \"8486469952\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GM\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 04:43:33'),
(40, 'I', 'users', '61', NULL, '{\"id\": 61, \"first_name\": \"Francis\", \"last_name\": \"Baker\", \"middle_name\": null, \"preferred_name\": \"Frank\", \"birth_date\": \"1986-01-26\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"20993 Graham Street\", \"city\": \"Staten Island\", \"zip\": 11239, \"state_abv\": \"NY\", \"country_abv\": \"US\", \"email\": \"frank@test.com\", \"phone_primary\": \"9808987460\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Henry\", \"last_name_emergency\": \"Baker\", \"phone_emergency\": \"8189463225\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GM\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 04:43:33'),
(41, 'I', 'users', '62', NULL, '{\"id\": 62, \"first_name\": \"Sarah\", \"last_name\": \"Nguyen\", \"middle_name\": \"Austin\", \"preferred_name\": null, \"birth_date\": \"1988-11-14\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"382 Jake Street #405\", \"city\": \"Inglewood\", \"zip\": 90001, \"state_abv\": \"CA\", \"country_abv\": \"US\", \"email\": \"sarah@test.com\", \"phone_primary\": \"5410625421\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Channing\", \"last_name_emergency\": \"Taft\", \"phone_emergency\": \"5656585223\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GM\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 04:43:33'),
(42, 'I', 'users', '63', NULL, '{\"id\": 63, \"first_name\": \"Erin\", \"last_name\": \"Sanders\", \"middle_name\": \"Ashley\", \"preferred_name\": null, \"birth_date\": \"1998-08-02\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"90 Barnaby Street\", \"city\": \"Asheville\", \"zip\": 28803, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"erin@test.com\", \"phone_primary\": \"6165235405\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Mitchel\", \"last_name_emergency\": \"Berry\", \"phone_emergency\": \"8286465199\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 04:43:33'),
(43, 'I', 'users', '64', NULL, '{\"id\": 64, \"first_name\": \"Sarah\", \"last_name\": \"Peterson\", \"middle_name\": \"Anne\", \"preferred_name\": null, \"birth_date\": \"2000-11-20\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"9209 Billows Circle\", \"city\": \"Raleigh\", \"zip\": 27545, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"sarah2@test.com\", \"phone_primary\": \"6135694860\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Abigail\", \"last_name_emergency\": \"Chan\", \"phone_emergency\": \"8085236661\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 04:43:33'),
(44, 'I', 'users', '65', NULL, '{\"id\": 65, \"first_name\": \"Jerrod\", \"last_name\": \"Brown\", \"middle_name\": \"Michael\", \"preferred_name\": null, \"birth_date\": \"1990-02-08\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"9209 Zenith Drive\", \"city\": \"Denver\", \"zip\": 80019, \"state_abv\": \"CO\", \"country_abv\": \"US\", \"email\": \"jerrod@test.com\", \"phone_primary\": \"9184635035\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Georgia\", \"last_name_emergency\": \"Brown\", \"phone_emergency\": \"8826516523\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 04:43:33'),
(45, 'I', 'users', '66', NULL, '{\"id\": 66, \"first_name\": \"Violet\", \"last_name\": \"Fillipecci\", \"middle_name\": \"Christine\", \"preferred_name\": null, \"birth_date\": \"1982-07-24\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"156 Green Street #901\", \"city\": \"Denver\", \"zip\": 80110, \"state_abv\": \"CO\", \"country_abv\": \"US\", \"email\": \"violet@test.com\", \"phone_primary\": \"6134657208\", \"phone_p_country\": 1, \"phone_secondary\": \"5616543252\", \"phone_s_country\": 1, \"first_name_emergency\": \"Francis\", \"last_name_emergency\": \"Wu\", \"phone_emergency\": \"6413665202\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 04:43:33'),
(46, 'I', 'users', '67', NULL, '{\"id\": 67, \"first_name\": \"April\", \"last_name\": \"Cintera\", \"middle_name\": null, \"preferred_name\": null, \"birth_date\": \"1995-12-05\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"1500 Burns Place #90\", \"city\": \"Brooklyn\", \"zip\": 11238, \"state_abv\": \"NY\", \"country_abv\": \"US\", \"email\": \"april@test.com\", \"phone_primary\": \"6134698502\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Nieve\", \"last_name_emergency\": \"Burris\", \"phone_emergency\": \"5587500251\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 04:43:33'),
(47, 'I', 'users', '68', NULL, '{\"id\": 68, \"first_name\": \"Michael\", \"last_name\": \"Stebbing\", \"middle_name\": \"Todd\", \"preferred_name\": \"Mike\", \"birth_date\": \"1985-01-31\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"68 Vermont Avenue\", \"city\": \"Culver City\", \"zip\": 90004, \"state_abv\": \"CA\", \"country_abv\": \"US\", \"email\": \"mike@test.com\", \"phone_primary\": \"6163430950\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Coleen\", \"last_name_emergency\": \"Stebbing\", \"phone_emergency\": \"4465889530\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 04:43:33'),
(48, 'I', 'users', '69', NULL, '{\"id\": 69, \"first_name\": \"William\", \"last_name\": \"Grant\", \"middle_name\": \"Lane\", \"preferred_name\": \"Bill\", \"birth_date\": \"1986-08-06\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"20 Tomahawk Lake Drive\", \"city\": \"Black Mountain\", \"zip\": 28774, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"bill@test.com\", \"phone_primary\": \"6164365987\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Patricia\", \"last_name_emergency\": \"Russo\", \"phone_emergency\": \"6615205584\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 04:43:33'),
(49, 'I', 'users', '70', NULL, '{\"id\": 70, \"first_name\": \"River\", \"last_name\": \"Monday\", \"middle_name\": \"Stuart\", \"preferred_name\": null, \"birth_date\": \"1999-04-09\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"14 West Burns Avenue\", \"city\": \"Raleigh\", \"zip\": 27513, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"river@test.com\", \"phone_primary\": \"3164265025\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Mallory\", \"last_name_emergency\": \"Brien\", \"phone_emergency\": \"2256399980\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 04:43:33'),
(50, 'I', 'users', '71', NULL, '{\"id\": 71, \"first_name\": \"Karen\", \"last_name\": \"Truman\", \"middle_name\": \"Anne\", \"preferred_name\": null, \"birth_date\": \"1984-01-30\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"1655 14th Street #2\", \"city\": \"Boulder\", \"zip\": 80501, \"state_abv\": \"CO\", \"country_abv\": \"US\", \"email\": \"karen@test.com\", \"phone_primary\": \"6784119320\", \"phone_p_country\": 1, \"phone_secondary\": \"3166554320\", \"phone_s_country\": 1, \"first_name_emergency\": \"Lavina\", \"last_name_emergency\": \"Truman\", \"phone_emergency\": \"4456329987\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 04:43:33'),
(51, 'I', 'users', '72', NULL, '{\"id\": 72, \"first_name\": \"Sanni\", \"last_name\": \"Larsen\", \"middle_name\": \"Cassy\", \"preferred_name\": null, \"birth_date\": \"1994-03-19\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"20 Surgeon Court \", \"city\": \"Ft. Collins\", \"zip\": 80522, \"state_abv\": \"CO\", \"country_abv\": \"US\", \"email\": \"sanni@test.com\", \"phone_primary\": \"6431598550\", \"phone_p_country\": 1, \"phone_secondary\": \"6165235134\", \"phone_s_country\": 1, \"first_name_emergency\": \"Mai\", \"last_name_emergency\": \"Henry\", \"phone_emergency\": \"6365202251\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 04:43:33'),
(52, 'I', 'users', '73', NULL, '{\"id\": 73, \"first_name\": \"Neil\", \"last_name\": \"Francis\", \"middle_name\": \"Winston\", \"preferred_name\": null, \"birth_date\": \"1998-04-07\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"2093 Hill Street #902\", \"city\": \"Brooklyn\", \"zip\": 11201, \"state_abv\": \"NY\", \"country_abv\": \"US\", \"email\": \"neil@test.com\", \"phone_primary\": \"9496538024\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Isma\", \"last_name_emergency\": \"Neil\", \"phone_emergency\": \"9836621036\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 04:43:33'),
(53, 'I', 'users', '74', NULL, '{\"id\": 74, \"first_name\": \"Francisco\", \"last_name\": \"Sanchez\", \"middle_name\": \"Javier\", \"preferred_name\": \"Frank\", \"birth_date\": \"1986-06-17\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"2908 Ocean Park Drive\", \"city\": \"Los Angeles\", \"zip\": 90002, \"state_abv\": \"CA\", \"country_abv\": \"US\", \"email\": \"frank2@test.com\", \"phone_primary\": \"6420319854\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Fern\", \"last_name_emergency\": \"Hudson\", \"phone_emergency\": \"5515542399\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 04:43:33'),
(54, 'I', 'users', '75', NULL, '{\"id\": 75, \"first_name\": \"David\", \"last_name\": \"Elliot\", \"middle_name\": \"Ilkin\", \"preferred_name\": \"Dave\", \"birth_date\": \"1989-03-03\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"38 Granite Street\", \"city\": \"Asheville\", \"zip\": 28801, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"dave@test.com\", \"phone_primary\": \"5240316587\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Alister\", \"last_name_emergency\": \"Ramos\", \"phone_emergency\": \"6063236685\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 04:43:33'),
(55, 'I', 'users', '76', NULL, '{\"id\": 76, \"first_name\": \"Kylee\", \"last_name\": \"Hyde\", \"middle_name\": \"Rachel\", \"preferred_name\": null, \"birth_date\": \"1981-09-30\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"1400 Fern Lake Circle\", \"city\": \"Durham\", \"zip\": 27661, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"kylee@test.com\", \"phone_primary\": \"6498863027\", \"phone_p_country\": 1, \"phone_secondary\": \"6463215646\", \"phone_s_country\": 1, \"first_name_emergency\": \"Laylah\", \"last_name_emergency\": \"McDermott\", \"phone_emergency\": \"5548756990\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 04:43:33'),
(56, 'I', 'users', '77', NULL, '{\"id\": 77, \"first_name\": \"Amina\", \"last_name\": \"Minett\", \"middle_name\": \"Maxima\", \"preferred_name\": \"Amie\", \"birth_date\": \"1989-02-17\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"2893 Lavendar Avenue\", \"city\": \"Boulder\", \"zip\": 80412, \"state_abv\": \"CO\", \"country_abv\": \"US\", \"email\": \"amie@test.com\", \"phone_primary\": \"8496350256\", \"phone_p_country\": 1, \"phone_secondary\": \"5406516185\", \"phone_s_country\": 1, \"first_name_emergency\": \"Buddy\", \"last_name_emergency\": \"Paine\", \"phone_emergency\": \"8286353612\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 04:43:33'),
(57, 'I', 'users', '78', NULL, '{\"id\": 78, \"first_name\": \"Erin\", \"last_name\": \"Salomon\", \"middle_name\": \"Madeleine\", \"preferred_name\": null, \"birth_date\": \"1981-04-25\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"290 New Holland Drive\", \"city\": \"Asheville\", \"zip\": 28806, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"erin3@test.com\", \"phone_primary\": \"8084623521\", \"phone_p_country\": 1, \"phone_secondary\": \"5654325512\", \"phone_s_country\": 1, \"first_name_emergency\": \"first_name_emergency\", \"last_name_emergency\": \"last_name_emergency\", \"phone_emergency\": \"3250426615\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"MM\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 04:43:33'),
(58, 'I', 'users', '79', NULL, '{\"id\": 79, \"first_name\": \"Caitlin\", \"last_name\": \"McGuiness\", \"middle_name\": \"Josette\", \"preferred_name\": \"Cai\", \"birth_date\": \"1971-09-01\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"930 Filbert Street\", \"city\": \"Raleigh\", \"zip\": 27606, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"cai@test.com\", \"phone_primary\": \"8879463250\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"first_name_emergency\", \"last_name_emergency\": \"last_name_emergency\", \"phone_emergency\": \"3033559980\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"MM\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 04:43:33'),
(59, 'I', 'users', '80', NULL, '{\"id\": 80, \"first_name\": \"Evan\", \"last_name\": \"Nevin\", \"middle_name\": \"Sudar\", \"preferred_name\": null, \"birth_date\": \"1974-01-02\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"2093 Snowden Road\", \"city\": \"Denver\", \"zip\": 80014, \"state_abv\": \"CO\", \"country_abv\": \"US\", \"email\": \"evan@test.com\", \"phone_primary\": \"6163250843\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Gene\", \"last_name_emergency\": \"Nevin\", \"phone_emergency\": \"5521305531\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"MM\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 04:43:33'),
(60, 'I', 'users', '81', NULL, '{\"id\": 81, \"first_name\": \"Skylar\", \"last_name\": \"Langley\", \"middle_name\": \"Barnabas\", \"preferred_name\": null, \"birth_date\": \"1996-02-04\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"109 Gateway Drive\", \"city\": \"Denver\", \"zip\": 80019, \"state_abv\": \"CO\", \"country_abv\": \"US\", \"email\": \"skylar@test.com\", \"phone_primary\": \"8084621865\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Geoffrey\", \"last_name_emergency\": \"Langley\", \"phone_emergency\": \"4133502807\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"MM\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 04:43:33'),
(61, 'I', 'users', '82', NULL, '{\"id\": 82, \"first_name\": \"Idir\", \"last_name\": \"Ma\", \"middle_name\": \"Tro\", \"preferred_name\": \"Idy\", \"birth_date\": \"1989-11-29\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"29 6th Avenue #502\", \"city\": \"Brooklyn\", \"zip\": 11202, \"state_abv\": \"NY\", \"country_abv\": \"US\", \"email\": \"idy@test.com\", \"phone_primary\": \"8548946320\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Saxon\", \"last_name_emergency\": \"Haigh\", \"phone_emergency\": \"9093652154\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"MM\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 04:43:33'),
(62, 'I', 'users', '83', NULL, '{\"id\": 83, \"first_name\": \"Katarin\", \"last_name\": \"Gutierrez\", \"middle_name\": \"Sondra\", \"preferred_name\": \"Kate\", \"birth_date\": \"1992-03-19\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"293 New Glen Road\", \"city\": \"Glendale\", \"zip\": 90001, \"state_abv\": \"CA\", \"country_abv\": \"US\", \"email\": \"kate@test.com\", \"phone_primary\": \"6049810651\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Demi\", \"last_name_emergency\": \"Patel\", \"phone_emergency\": \"4230541325\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"MM\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 04:43:33'),
(63, 'I', 'users', '84', NULL, '{\"id\": 84, \"first_name\": \"Tracie\", \"last_name\": \"Connor\", \"middle_name\": \"Robby\", \"preferred_name\": null, \"birth_date\": \"1986-08-12\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"2839 Granby Avenue\", \"city\": \"Weaverville\", \"zip\": 28778, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"tracie@test.com\", \"phone_primary\": \"3031613498\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Kenzie\", \"last_name_emergency\": \"Holding\", \"phone_emergency\": \"8438543216\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"MM\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 04:43:33'),
(64, 'I', 'users', '85', NULL, '{\"id\": 85, \"first_name\": \"Delilah\", \"last_name\": \"Drake\", \"middle_name\": \"Belle\", \"preferred_name\": null, \"birth_date\": \"1961-06-06\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"953 Van Dyke Street\", \"city\": \"Raleigh\", \"zip\": 27606, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"delilah@test.com\", \"phone_primary\": \"6402186624\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Hayden\", \"last_name_emergency\": \"Drake\", \"phone_emergency\": \"9315163501\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"MM\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 04:43:33'),
(65, 'I', 'users', '86', NULL, '{\"id\": 86, \"first_name\": \"Lukas\", \"last_name\": \"Araujo\", \"middle_name\": null, \"preferred_name\": \"Luke\", \"birth_date\": \"1987-07-31\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"555 West Sherwood Street\", \"city\": \"Boulder\", \"zip\": 80504, \"state_abv\": \"CO\", \"country_abv\": \"US\", \"email\": \"luke@test.com\", \"phone_primary\": \"6436561970\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Dahlia\", \"last_name_emergency\": \"Frank\", \"phone_emergency\": \"7065216542\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"MM\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 04:43:33'),
(66, 'I', 'users', '87', NULL, '{\"id\": 87, \"first_name\": \"Donald\", \"last_name\": \"Archer\", \"middle_name\": \"Celine\", \"preferred_name\": \"Donny\", \"birth_date\": \"1983-11-19\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"187 Penn Lane #5\", \"city\": \"Staten Island\", \"zip\": 11201, \"state_abv\": \"NY\", \"country_abv\": \"US\", \"email\": \"donny@test.com\", \"phone_primary\": \"8285212262\", \"phone_p_country\": 1, \"phone_secondary\": \"9846502215\", \"phone_s_country\": 1, \"first_name_emergency\": \"Ewan\", \"last_name_emergency\": \"Archer\", \"phone_emergency\": \"4652151380\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"MM\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 04:43:33'),
(67, 'I', 'users', '88', NULL, '{\"id\": 88, \"first_name\": \"Bine\", \"last_name\": \"Bartram\", \"middle_name\": \"Kamon\", \"preferred_name\": null, \"birth_date\": \"2004-01-24\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"82 SE Eagle Street\", \"city\": \"Asheville\", \"zip\": 28806, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"bine@test.com\", \"phone_primary\": \"6137984650\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Romany\", \"last_name_emergency\": \"Bartram\", \"phone_emergency\": \"3315245520\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 04:43:33');
INSERT INTO `audits` (`pk`, `type`, `table_name`, `record_id`, `old_values`, `new_values`, `applied_by`, `applied_on`) VALUES
(68, 'I', 'users', '89', NULL, '{\"id\": 89, \"first_name\": \"Sabine\", \"last_name\": \"Mills\", \"middle_name\": null, \"preferred_name\": null, \"birth_date\": \"1987-01-29\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"9199 S Hawthorne Ave\", \"city\": \"Raleigh\", \"zip\": 27606, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"sabine@test.com\", \"phone_primary\": \"7986521084\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Aariz\", \"last_name_emergency\": \"Tillman\", \"phone_emergency\": \"9985324200\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 04:43:33'),
(69, 'I', 'users', '90', NULL, '{\"id\": 90, \"first_name\": \"Alexander\", \"last_name\": \"Herriot\", \"middle_name\": \"Hesham\", \"preferred_name\": \"Alex\", \"birth_date\": \"1975-09-09\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"71 Marconi Drive\", \"city\": \"Denver\", \"zip\": 80014, \"state_abv\": \"CO\", \"country_abv\": \"US\", \"email\": \"alex@test.com\", \"phone_primary\": \"6133212150\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Nikolas\", \"last_name_emergency\": \"Herriot\", \"phone_emergency\": \"5054239875\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 04:43:33'),
(70, 'I', 'users', '91', NULL, '{\"id\": 91, \"first_name\": \"Isa\", \"last_name\": \"Holmstrom\", \"middle_name\": \"Kelly\", \"preferred_name\": null, \"birth_date\": \"1992-03-03\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"9936 Fairway Street\", \"city\": \"Ft. Collins\", \"zip\": 80521, \"state_abv\": \"CO\", \"country_abv\": \"US\", \"email\": \"isa@test.com\", \"phone_primary\": \"6413252504\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Freya\", \"last_name_emergency\": \"Carlson\", \"phone_emergency\": \"3032126528\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 04:43:33'),
(71, 'I', 'users', '92', NULL, '{\"id\": 92, \"first_name\": \"Phillip\", \"last_name\": \"Emerson\", \"middle_name\": null, \"preferred_name\": \"Phil\", \"birth_date\": \"1988-04-13\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"362 Logan Avenue #30\", \"city\": \"Brooklyn\", \"zip\": 11201, \"state_abv\": \"NY\", \"country_abv\": \"US\", \"email\": \"phil2@test.com\", \"phone_primary\": \"4652381601\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Sarah\", \"last_name_emergency\": \"Emerson\", \"phone_emergency\": \"9026332581\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 04:43:33'),
(72, 'U', 'users', '56', '{\"id\": 56, \"first_name\": \"Danielle\", \"last_name\": \"Johnson\", \"middle_name\": null, \"preferred_name\": \"DJ\", \"birth_date\": \"0000-00-00\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"106 Blackbird Drive\", \"city\": \"Ft. Collins\", \"zip\": 80522, \"state_abv\": \"CO\", \"country_abv\": \"US\", \"email\": \"dj@test.com\", \"phone_primary\": \"6165230065\", \"phone_p_country\": 1, \"phone_secondary\": \"8652446592\", \"phone_s_country\": 1, \"first_name_emergency\": \"Victor\", \"last_name_emergency\": \"Johnson\", \"phone_emergency\": \"8185253464\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GM\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', '{\"id\": 56, \"first_name\": \"Danielle\", \"last_name\": \"Johnson\", \"middle_name\": null, \"preferred_name\": \"DJ\", \"birth_date\": \"1994-08-24\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"106 Blackbird Drive\", \"city\": \"Ft. Collins\", \"zip\": 80522, \"state_abv\": \"CO\", \"country_abv\": \"US\", \"email\": \"dj@test.com\", \"phone_primary\": \"6165230065\", \"phone_p_country\": 1, \"phone_secondary\": \"8652446592\", \"phone_s_country\": 1, \"first_name_emergency\": \"Victor\", \"last_name_emergency\": \"Johnson\", \"phone_emergency\": \"8185253464\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GM\", \"created_at\": \"2022-05-01 04:44:17\", \"primary_location\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 04:44:17'),
(73, 'I', 'locations', '32', NULL, '{\"id\": 32, \"gym_id\": 18, \"location_name\": null, \"street_address\": null, \"city\": null, \"zip\": null, \"state_abv\": \"AK\", \"country_abv\": \"US\", \"phone_p_country\": null, \"phone_primary\": \"\", \"photo_data\": null, \"capacity\": 0, \"employee_group\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 04:48:14'),
(74, 'D', 'locations', '32', '{\"id\": 32, \"gym_id\": 18, \"location_name\": null, \"street_address\": null, \"city\": null, \"zip\": null, \"state_abv\": \"AK\", \"country_abv\": \"US\", \"phone_p_country\": null, \"phone_primary\": \"\", \"photo_data\": null, \"capacity\": 0, \"employee_group\": null}', NULL, 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 04:48:45'),
(75, 'I', 'locations', '33', NULL, '{\"id\": 33, \"gym_id\": 13, \"location_name\": \"Asheville\", \"street_address\": \"64 Amboy Road\", \"city\": \"Asheville\", \"zip\": 28806, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"phone_p_country\": 1, \"phone_primary\": \"8286465645\", \"photo_data\": null, \"capacity\": 120, \"employee_group\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 05:11:23'),
(76, 'I', 'locations', '34', NULL, '{\"id\": 34, \"gym_id\": 13, \"location_name\": \"Raleigh\", \"street_address\": \"163 Granite Way\", \"city\": \"Raleigh\", \"zip\": 28706, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"phone_p_country\": 1, \"phone_primary\": \"9106153255\", \"photo_data\": null, \"capacity\": 150, \"employee_group\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 05:11:23'),
(77, 'I', 'locations', '35', NULL, '{\"id\": 35, \"gym_id\": 14, \"location_name\": \"Boulder\", \"street_address\": \"13 Gravity Park\", \"city\": \"Boulder\", \"zip\": 80302, \"state_abv\": \"CO\", \"country_abv\": \"US\", \"phone_p_country\": 1, \"phone_primary\": \"4665215486\", \"photo_data\": null, \"capacity\": 120, \"employee_group\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 05:11:23'),
(78, 'I', 'locations', '36', NULL, '{\"id\": 36, \"gym_id\": 14, \"location_name\": \"Fort Collins\", \"street_address\": \"1009 Cliff Court\", \"city\": \"Fort Collins\", \"zip\": 80522, \"state_abv\": \"CO\", \"country_abv\": \"US\", \"phone_p_country\": 1, \"phone_primary\": \"6468552136\", \"photo_data\": null, \"capacity\": 120, \"employee_group\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 05:11:23'),
(79, 'I', 'locations', '37', NULL, '{\"id\": 37, \"gym_id\": 15, \"location_name\": \"New York\", \"street_address\": \"166 Market Street #30\", \"city\": \"Brooklyn\", \"zip\": 11238, \"state_abv\": \"NY\", \"country_abv\": \"US\", \"phone_p_country\": 1, \"phone_primary\": \"8965546215\", \"photo_data\": null, \"capacity\": 120, \"employee_group\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 05:11:23'),
(80, 'I', 'locations', '38', NULL, '{\"id\": 38, \"gym_id\": 17, \"location_name\": \"Los Angeles\", \"street_address\": \"6446 Crest Boulevard\", \"city\": \"Los Angeles\", \"zip\": 90003, \"state_abv\": \"CA\", \"country_abv\": \"US\", \"phone_p_country\": 1, \"phone_primary\": \"6165432215\", \"photo_data\": null, \"capacity\": 120, \"employee_group\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 05:11:23'),
(81, 'I', 'locations', '39', NULL, '{\"id\": 39, \"gym_id\": 16, \"location_name\": \"Memphis\", \"street_address\": \"14 New State Highway\", \"city\": \"Memphis\", \"zip\": 37544, \"state_abv\": \"TN\", \"country_abv\": \"US\", \"phone_p_country\": 1, \"phone_primary\": \"6165432235\", \"photo_data\": null, \"capacity\": 120, \"employee_group\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 05:43:37'),
(82, 'I', 'locations', '40', NULL, '{\"id\": 40, \"gym_id\": 16, \"location_name\": \"Nashville\", \"street_address\": \"651 Cherry Lane\", \"city\": \"Nashville\", \"zip\": 37201, \"state_abv\": \"TN\", \"country_abv\": \"US\", \"phone_p_country\": 1, \"phone_primary\": \"9496552215\", \"photo_data\": null, \"capacity\": 120, \"employee_group\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 05:43:37'),
(83, 'I', 'locations', '41', NULL, '{\"id\": 41, \"gym_id\": 16, \"location_name\": \"Johnson City\", \"street_address\": \"444 Crescent Street\", \"city\": \"Johnson City\", \"zip\": 37604, \"state_abv\": \"TN\", \"country_abv\": \"US\", \"phone_p_country\": 1, \"phone_primary\": \"8486552231\", \"photo_data\": null, \"capacity\": 120, \"employee_group\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 05:43:37'),
(84, 'I', 'locations', '42', NULL, '{\"id\": 42, \"gym_id\": 16, \"location_name\": \"Lexington\", \"street_address\": \"16 Locust Lane\", \"city\": \"Lexington\", \"zip\": 40502, \"state_abv\": \"KY\", \"country_abv\": \"US\", \"phone_p_country\": 1, \"phone_primary\": \"4668529901\", \"photo_data\": null, \"capacity\": 120, \"employee_group\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 05:43:37'),
(85, 'I', 'locations', '43', NULL, '{\"id\": 43, \"gym_id\": 16, \"location_name\": \"Bowling Green\", \"street_address\": \"90 Boulder Row\", \"city\": \"Bowling Green\", \"zip\": 42102, \"state_abv\": \"KY\", \"country_abv\": \"US\", \"phone_p_country\": 1, \"phone_primary\": \"4053325075\", \"photo_data\": null, \"capacity\": 120, \"employee_group\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 05:43:37'),
(86, 'I', 'locations', '44', NULL, '{\"id\": 44, \"gym_id\": 18, \"location_name\": \"Columbia City\", \"street_address\": \"1996 Crystal Avenue\", \"city\": \"Seattle\", \"zip\": 98118, \"state_abv\": \"WA\", \"country_abv\": \"US\", \"phone_p_country\": 1, \"phone_primary\": \"6052219853\", \"photo_data\": null, \"capacity\": 120, \"employee_group\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 05:43:37'),
(87, 'I', 'locations', '45', NULL, '{\"id\": 45, \"gym_id\": 18, \"location_name\": \"Greenwood\", \"street_address\": \"633 Congress Lane\", \"city\": \"Seattle\", \"zip\": 98103, \"state_abv\": \"WA\", \"country_abv\": \"US\", \"phone_p_country\": 1, \"phone_primary\": \"4620159943\", \"photo_data\": null, \"capacity\": 120, \"employee_group\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 05:43:37'),
(88, 'I', 'locations', '46', NULL, '{\"id\": 46, \"gym_id\": 18, \"location_name\": \"Eastlake\", \"street_address\": \"18820 Central Avenue\", \"city\": \"Seattle\", \"zip\": 98102, \"state_abv\": \"WA\", \"country_abv\": \"US\", \"phone_p_country\": 1, \"phone_primary\": \"6165231154\", \"photo_data\": null, \"capacity\": 120, \"employee_group\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 05:43:37'),
(89, 'I', 'locations', '47', NULL, '{\"id\": 47, \"gym_id\": 19, \"location_name\": \"Reston\", \"street_address\": \"1563 Earl Row\", \"city\": \"Reston\", \"zip\": 20190, \"state_abv\": \"VA\", \"country_abv\": \"US\", \"phone_p_country\": 1, \"phone_primary\": \"5054432168\", \"photo_data\": null, \"capacity\": 120, \"employee_group\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 05:43:37'),
(90, 'I', 'locations', '48', NULL, '{\"id\": 48, \"gym_id\": 19, \"location_name\": \"Georgetown\", \"street_address\": \"323 SE 14th Avenue\", \"city\": \"Georgetown\", \"zip\": 20007, \"state_abv\": \"DC\", \"country_abv\": \"US\", \"phone_p_country\": 1, \"phone_primary\": \"9463201549\", \"photo_data\": null, \"capacity\": 120, \"employee_group\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 05:43:37'),
(91, 'I', 'locations', '49', NULL, '{\"id\": 49, \"gym_id\": 19, \"location_name\": \"South Kensington\", \"street_address\": \"3899 Nova Boulevard\", \"city\": \"South Kensington\", \"zip\": 20895, \"state_abv\": \"MD\", \"country_abv\": \"US\", \"phone_p_country\": 1, \"phone_primary\": \"3135264980\", \"photo_data\": null, \"capacity\": 120, \"employee_group\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 05:43:37'),
(92, 'I', 'locations', '50', NULL, '{\"id\": 50, \"gym_id\": 19, \"location_name\": \"Arlington\", \"street_address\": \"18001 Bell Lane\", \"city\": \"Arlington\", \"zip\": 22202, \"state_abv\": \"VA\", \"country_abv\": \"US\", \"phone_p_country\": 1, \"phone_primary\": \"8086469853\", \"photo_data\": null, \"capacity\": 120, \"employee_group\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 05:43:37'),
(93, 'I', 'locations', '51', NULL, '{\"id\": 51, \"gym_id\": 20, \"location_name\": \"Five Points\", \"street_address\": \"10 Peachtree Street\", \"city\": \"Atlanta\", \"zip\": 30303, \"state_abv\": \"GA\", \"country_abv\": \"US\", \"phone_p_country\": 1, \"phone_primary\": \"5054326980\", \"photo_data\": null, \"capacity\": 120, \"employee_group\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 05:43:37'),
(94, 'I', 'locations', '52', NULL, '{\"id\": 52, \"gym_id\": 20, \"location_name\": \"Stone Mountain\", \"street_address\": \"20 Fletcher Route\", \"city\": \"Stone Mountain\", \"zip\": 30083, \"state_abv\": \"GA\", \"country_abv\": \"US\", \"phone_p_country\": 1, \"phone_primary\": \"6165043215\", \"photo_data\": null, \"capacity\": 120, \"employee_group\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 05:43:37'),
(95, 'I', 'locations', '53', NULL, '{\"id\": 53, \"gym_id\": 21, \"location_name\": \"Sugar House\", \"street_address\": \"640 West Boulevard\", \"city\": \"Salt Lake City\", \"zip\": 84106, \"state_abv\": \"UT\", \"country_abv\": \"US\", \"phone_p_country\": 1, \"phone_primary\": \"6198463204\", \"photo_data\": null, \"capacity\": 120, \"employee_group\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 05:43:37'),
(96, 'I', 'locations', '54', NULL, '{\"id\": 54, \"gym_id\": 21, \"location_name\": \"West Jordan\", \"street_address\": \"8490 West 9000 South\", \"city\": \"West Jordan\", \"zip\": 84088, \"state_abv\": \"UT\", \"country_abv\": \"US\", \"phone_p_country\": 1, \"phone_primary\": \"6489437752\", \"photo_data\": null, \"capacity\": 120, \"employee_group\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 05:43:37'),
(97, 'I', 'locations', '55', NULL, '{\"id\": 55, \"gym_id\": 22, \"location_name\": \"Eugene\", \"street_address\": \"1605 East 19th Avenue\", \"city\": \"Eugene\", \"zip\": 97403, \"state_abv\": \"OR\", \"country_abv\": \"US\", \"phone_p_country\": 1, \"phone_primary\": \"9893154405\", \"photo_data\": null, \"capacity\": 120, \"employee_group\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 05:43:37'),
(98, 'I', 'locations', '56', NULL, '{\"id\": 56, \"gym_id\": 22, \"location_name\": \"Portland\", \"street_address\": \"450 Rose Avenue\", \"city\": \"Beaverton\", \"zip\": 97005, \"state_abv\": \"OR\", \"country_abv\": \"US\", \"phone_p_country\": 1, \"phone_primary\": \"7832155520\", \"photo_data\": null, \"capacity\": 120, \"employee_group\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 05:43:37'),
(99, 'U', 'users', '50', '{\"id\": 50, \"first_name\": \"James\", \"last_name\": \"Baker\", \"middle_name\": \"Robert\", \"preferred_name\": \"Jimmy\", \"birth_date\": \"1991-02-12\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"PO Box 2012\", \"city\": \"Enka\", \"zip\": 28728, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"baker.jimmy@gmail.com\", \"phone_primary\": \"2526465221\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Caet\", \"last_name_emergency\": \"Cash\", \"phone_emergency\": \"8284507973\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"AA\", \"created_at\": \"2022-05-01 02:31:04\", \"primary_location\": null}', '{\"id\": 50, \"first_name\": \"James\", \"last_name\": \"Baker\", \"middle_name\": \"Robert\", \"preferred_name\": \"Jimmy\", \"birth_date\": \"1991-02-12\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"PO Box 2012\", \"city\": \"Enka\", \"zip\": 28728, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"baker.jimmy@gmail.com\", \"phone_primary\": \"2526465221\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Caet\", \"last_name_emergency\": \"Cash\", \"phone_emergency\": \"8284507973\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"AA\", \"created_at\": \"2022-05-01 06:26:54\", \"primary_location\": 33}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 06:26:54'),
(100, 'U', 'users', '51', '{\"id\": 51, \"first_name\": \"Caitlin\", \"last_name\": \"Cash\", \"middle_name\": \"Presti\", \"preferred_name\": \"Caet\", \"birth_date\": \"1991-03-02\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"PO Box 2012\", \"city\": \"Enka\", \"zip\": 28728, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"caet@test.com\", \"phone_primary\": \"8284507973\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Jimmy\", \"last_name_emergency\": \"Baker\", \"phone_emergency\": \"2526465221\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"AA\", \"created_at\": \"2022-05-01 02:31:04\", \"primary_location\": null}', '{\"id\": 51, \"first_name\": \"Caitlin\", \"last_name\": \"Cash\", \"middle_name\": \"Presti\", \"preferred_name\": \"Caet\", \"birth_date\": \"1991-03-02\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"PO Box 2012\", \"city\": \"Enka\", \"zip\": 28728, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"caet@test.com\", \"phone_primary\": \"8284507973\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Jimmy\", \"last_name_emergency\": \"Baker\", \"phone_emergency\": \"2526465221\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"AA\", \"created_at\": \"2022-05-01 06:27:01\", \"primary_location\": 34}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 06:27:01'),
(101, 'U', 'users', '52', '{\"id\": 52, \"first_name\": \"Erin\", \"last_name\": \"Li\", \"middle_name\": null, \"preferred_name\": null, \"birth_date\": \"1987-10-20\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"115 Hyacinth Avenue\", \"city\": \"Boulder\", \"zip\": 80302, \"state_abv\": \"CO\", \"country_abv\": \"US\", \"email\": \"erin2@test.com\", \"phone_primary\": \"4645153212\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Carl\", \"last_name_emergency\": \"Weathers\", \"phone_emergency\": \"4645218705\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"AA\", \"created_at\": \"2022-05-01 02:31:04\", \"primary_location\": null}', '{\"id\": 52, \"first_name\": \"Erin\", \"last_name\": \"Li\", \"middle_name\": null, \"preferred_name\": null, \"birth_date\": \"1987-10-20\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"115 Hyacinth Avenue\", \"city\": \"Boulder\", \"zip\": 80302, \"state_abv\": \"CO\", \"country_abv\": \"US\", \"email\": \"erin2@test.com\", \"phone_primary\": \"4645153212\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Carl\", \"last_name_emergency\": \"Weathers\", \"phone_emergency\": \"4645218705\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"AA\", \"created_at\": \"2022-05-01 06:27:07\", \"primary_location\": 35}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 06:27:07'),
(102, 'U', 'users', '53', '{\"id\": 53, \"first_name\": \"Aaron\", \"last_name\": \"Novicek\", \"middle_name\": null, \"preferred_name\": null, \"birth_date\": \"1989-10-03\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"930 Greenlee Way\", \"city\": \"Asheville\", \"zip\": 28806, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"aaron@test.com\", \"phone_primary\": \"3236985530\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Alec\", \"last_name_emergency\": \"Novicek\", \"phone_emergency\": \"2026462252\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GM\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', '{\"id\": 53, \"first_name\": \"Aaron\", \"last_name\": \"Novicek\", \"middle_name\": null, \"preferred_name\": null, \"birth_date\": \"1989-10-03\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"930 Greenlee Way\", \"city\": \"Asheville\", \"zip\": 28806, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"aaron@test.com\", \"phone_primary\": \"3236985530\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Alec\", \"last_name_emergency\": \"Novicek\", \"phone_emergency\": \"2026462252\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GM\", \"created_at\": \"2022-05-01 06:27:12\", \"primary_location\": 33}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 06:27:12'),
(103, 'U', 'users', '54', '{\"id\": 54, \"first_name\": \"Kevin\", \"last_name\": \"Roadbletter\", \"middle_name\": \"William\", \"preferred_name\": null, \"birth_date\": \"1993-07-11\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"6005 Park Terrace\", \"city\": \"Raleigh\", \"zip\": 27601, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"kevin@test.com\", \"phone_primary\": \"8875652140\", \"phone_p_country\": 1, \"phone_secondary\": \"5465235541\", \"phone_s_country\": 1, \"first_name_emergency\": \"Gideon\", \"last_name_emergency\": \"Roadbletter\", \"phone_emergency\": \"8465213320\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GM\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', '{\"id\": 54, \"first_name\": \"Kevin\", \"last_name\": \"Roadbletter\", \"middle_name\": \"William\", \"preferred_name\": null, \"birth_date\": \"1993-07-11\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"6005 Park Terrace\", \"city\": \"Raleigh\", \"zip\": 27601, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"kevin@test.com\", \"phone_primary\": \"8875652140\", \"phone_p_country\": 1, \"phone_secondary\": \"5465235541\", \"phone_s_country\": 1, \"first_name_emergency\": \"Gideon\", \"last_name_emergency\": \"Roadbletter\", \"phone_emergency\": \"8465213320\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GM\", \"created_at\": \"2022-05-01 06:27:15\", \"primary_location\": 34}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 06:27:15'),
(104, 'U', 'users', '55', '{\"id\": 55, \"first_name\": \"Sydney\", \"last_name\": \"Steeple\", \"middle_name\": \"Erin\", \"preferred_name\": null, \"birth_date\": \"1995-01-06\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"14 Mulberry Creek Road\", \"city\": \"Golden\", \"zip\": 80402, \"state_abv\": \"CO\", \"country_abv\": \"US\", \"email\": \"sydney@test.com\", \"phone_primary\": \"46589952033\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Susie\", \"last_name_emergency\": \"Steeple\", \"phone_emergency\": \"8486239951\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GM\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', '{\"id\": 55, \"first_name\": \"Sydney\", \"last_name\": \"Steeple\", \"middle_name\": \"Erin\", \"preferred_name\": null, \"birth_date\": \"1995-01-06\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"14 Mulberry Creek Road\", \"city\": \"Golden\", \"zip\": 80402, \"state_abv\": \"CO\", \"country_abv\": \"US\", \"email\": \"sydney@test.com\", \"phone_primary\": \"46589952033\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Susie\", \"last_name_emergency\": \"Steeple\", \"phone_emergency\": \"8486239951\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GM\", \"created_at\": \"2022-05-01 06:27:21\", \"primary_location\": 35}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 06:27:21'),
(105, 'U', 'users', '56', '{\"id\": 56, \"first_name\": \"Danielle\", \"last_name\": \"Johnson\", \"middle_name\": null, \"preferred_name\": \"DJ\", \"birth_date\": \"1994-08-24\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"106 Blackbird Drive\", \"city\": \"Ft. Collins\", \"zip\": 80522, \"state_abv\": \"CO\", \"country_abv\": \"US\", \"email\": \"dj@test.com\", \"phone_primary\": \"6165230065\", \"phone_p_country\": 1, \"phone_secondary\": \"8652446592\", \"phone_s_country\": 1, \"first_name_emergency\": \"Victor\", \"last_name_emergency\": \"Johnson\", \"phone_emergency\": \"8185253464\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GM\", \"created_at\": \"2022-05-01 04:44:17\", \"primary_location\": null}', '{\"id\": 56, \"first_name\": \"Danielle\", \"last_name\": \"Johnson\", \"middle_name\": null, \"preferred_name\": \"DJ\", \"birth_date\": \"1994-08-24\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"106 Blackbird Drive\", \"city\": \"Ft. Collins\", \"zip\": 80522, \"state_abv\": \"CO\", \"country_abv\": \"US\", \"email\": \"dj@test.com\", \"phone_primary\": \"6165230065\", \"phone_p_country\": 1, \"phone_secondary\": \"8652446592\", \"phone_s_country\": 1, \"first_name_emergency\": \"Victor\", \"last_name_emergency\": \"Johnson\", \"phone_emergency\": \"8185253464\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GM\", \"created_at\": \"2022-05-01 06:27:27\", \"primary_location\": 36}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 06:27:27'),
(106, 'U', 'users', '57', '{\"id\": 57, \"first_name\": \"William\", \"last_name\": \"Flintlock\", \"middle_name\": null, \"preferred_name\": \"Will\", \"birth_date\": \"1999-07-12\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"38002 5th Place\", \"city\": \"Brooklyn\", \"zip\": 11216, \"state_abv\": \"NY\", \"country_abv\": \"US\", \"email\": \"will@test.com\", \"phone_primary\": \"2026585541\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Clarice\", \"last_name_emergency\": \"Flintlock\", \"phone_emergency\": \"8985305122\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GM\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', '{\"id\": 57, \"first_name\": \"William\", \"last_name\": \"Flintlock\", \"middle_name\": null, \"preferred_name\": \"Will\", \"birth_date\": \"1999-07-12\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"38002 5th Place\", \"city\": \"Brooklyn\", \"zip\": 11216, \"state_abv\": \"NY\", \"country_abv\": \"US\", \"email\": \"will@test.com\", \"phone_primary\": \"2026585541\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Clarice\", \"last_name_emergency\": \"Flintlock\", \"phone_emergency\": \"8985305122\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GM\", \"created_at\": \"2022-05-01 06:27:30\", \"primary_location\": 37}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 06:27:30'),
(107, 'U', 'users', '58', '{\"id\": 58, \"first_name\": \"Catalina\", \"last_name\": \"Vespera\", \"middle_name\": \"Elizabeth\", \"preferred_name\": \"Cat\", \"birth_date\": \"1988-05-08\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"9302 Richmond Boulevard\", \"city\": \"Los Angeles\", \"zip\": 90004, \"state_abv\": \"CA\", \"country_abv\": \"US\", \"email\": \"cat@test.com\", \"phone_primary\": \"4652399820\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Harlen\", \"last_name_emergency\": \"Vespera\", \"phone_emergency\": \"5053136625\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GM\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', '{\"id\": 58, \"first_name\": \"Catalina\", \"last_name\": \"Vespera\", \"middle_name\": \"Elizabeth\", \"preferred_name\": \"Cat\", \"birth_date\": \"1988-05-08\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"9302 Richmond Boulevard\", \"city\": \"Los Angeles\", \"zip\": 90004, \"state_abv\": \"CA\", \"country_abv\": \"US\", \"email\": \"cat@test.com\", \"phone_primary\": \"4652399820\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Harlen\", \"last_name_emergency\": \"Vespera\", \"phone_emergency\": \"5053136625\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GM\", \"created_at\": \"2022-05-01 06:27:34\", \"primary_location\": 38}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 06:27:34'),
(108, 'U', 'users', '59', '{\"id\": 59, \"first_name\": \"Sarah\", \"last_name\": \"Shirley\", \"middle_name\": \"Elizabeth\", \"preferred_name\": \"Liz\", \"birth_date\": \"1994-09-30\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"829 Birch Street\", \"city\": \"Asheville\", \"zip\": 28803, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"liz@test.com\", \"phone_primary\": \"6865209847\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Chase\", \"last_name_emergency\": \"Stokes\", \"phone_emergency\": \"6496626527\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GM\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', '{\"id\": 59, \"first_name\": \"Sarah\", \"last_name\": \"Shirley\", \"middle_name\": \"Elizabeth\", \"preferred_name\": \"Liz\", \"birth_date\": \"1994-09-30\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"829 Birch Street\", \"city\": \"Asheville\", \"zip\": 28803, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"liz@test.com\", \"phone_primary\": \"6865209847\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Chase\", \"last_name_emergency\": \"Stokes\", \"phone_emergency\": \"6496626527\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GM\", \"created_at\": \"2022-05-01 06:27:41\", \"primary_location\": 33}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 06:27:41'),
(109, 'U', 'users', '60', '{\"id\": 60, \"first_name\": \"Justin\", \"last_name\": \"Scott\", \"middle_name\": \"Robert\", \"preferred_name\": null, \"birth_date\": \"2003-11-07\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"2009 Weebly Drive\", \"city\": \"Cary\", \"zip\": 28601, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"justin@test.com\", \"phone_primary\": \"6165326840\", \"phone_p_country\": 1, \"phone_secondary\": \"6465225649\", \"phone_s_country\": 1, \"first_name_emergency\": \"LLoyd\", \"last_name_emergency\": \"Scott\", \"phone_emergency\": \"8486469952\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GM\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', '{\"id\": 60, \"first_name\": \"Justin\", \"last_name\": \"Scott\", \"middle_name\": \"Robert\", \"preferred_name\": null, \"birth_date\": \"2003-11-07\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"2009 Weebly Drive\", \"city\": \"Cary\", \"zip\": 28601, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"justin@test.com\", \"phone_primary\": \"6165326840\", \"phone_p_country\": 1, \"phone_secondary\": \"6465225649\", \"phone_s_country\": 1, \"first_name_emergency\": \"LLoyd\", \"last_name_emergency\": \"Scott\", \"phone_emergency\": \"8486469952\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GM\", \"created_at\": \"2022-05-01 06:27:45\", \"primary_location\": 34}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 06:27:45'),
(110, 'U', 'users', '61', '{\"id\": 61, \"first_name\": \"Francis\", \"last_name\": \"Baker\", \"middle_name\": null, \"preferred_name\": \"Frank\", \"birth_date\": \"1986-01-26\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"20993 Graham Street\", \"city\": \"Staten Island\", \"zip\": 11239, \"state_abv\": \"NY\", \"country_abv\": \"US\", \"email\": \"frank@test.com\", \"phone_primary\": \"9808987460\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Henry\", \"last_name_emergency\": \"Baker\", \"phone_emergency\": \"8189463225\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GM\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', '{\"id\": 61, \"first_name\": \"Francis\", \"last_name\": \"Baker\", \"middle_name\": null, \"preferred_name\": \"Frank\", \"birth_date\": \"1986-01-26\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"20993 Graham Street\", \"city\": \"Staten Island\", \"zip\": 11239, \"state_abv\": \"NY\", \"country_abv\": \"US\", \"email\": \"frank@test.com\", \"phone_primary\": \"9808987460\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Henry\", \"last_name_emergency\": \"Baker\", \"phone_emergency\": \"8189463225\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GM\", \"created_at\": \"2022-05-01 06:27:53\", \"primary_location\": 37}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 06:27:53'),
(111, 'U', 'users', '62', '{\"id\": 62, \"first_name\": \"Sarah\", \"last_name\": \"Nguyen\", \"middle_name\": \"Austin\", \"preferred_name\": null, \"birth_date\": \"1988-11-14\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"382 Jake Street #405\", \"city\": \"Inglewood\", \"zip\": 90001, \"state_abv\": \"CA\", \"country_abv\": \"US\", \"email\": \"sarah@test.com\", \"phone_primary\": \"5410625421\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Channing\", \"last_name_emergency\": \"Taft\", \"phone_emergency\": \"5656585223\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GM\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', '{\"id\": 62, \"first_name\": \"Sarah\", \"last_name\": \"Nguyen\", \"middle_name\": \"Austin\", \"preferred_name\": null, \"birth_date\": \"1988-11-14\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"382 Jake Street #405\", \"city\": \"Inglewood\", \"zip\": 90001, \"state_abv\": \"CA\", \"country_abv\": \"US\", \"email\": \"sarah@test.com\", \"phone_primary\": \"5410625421\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Channing\", \"last_name_emergency\": \"Taft\", \"phone_emergency\": \"5656585223\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GM\", \"created_at\": \"2022-05-01 06:27:58\", \"primary_location\": 38}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 06:27:58'),
(112, 'U', 'users', '63', '{\"id\": 63, \"first_name\": \"Erin\", \"last_name\": \"Sanders\", \"middle_name\": \"Ashley\", \"preferred_name\": null, \"birth_date\": \"1998-08-02\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"90 Barnaby Street\", \"city\": \"Asheville\", \"zip\": 28803, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"erin@test.com\", \"phone_primary\": \"6165235405\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Mitchel\", \"last_name_emergency\": \"Berry\", \"phone_emergency\": \"8286465199\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', '{\"id\": 63, \"first_name\": \"Erin\", \"last_name\": \"Sanders\", \"middle_name\": \"Ashley\", \"preferred_name\": null, \"birth_date\": \"1998-08-02\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"90 Barnaby Street\", \"city\": \"Asheville\", \"zip\": 28803, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"erin@test.com\", \"phone_primary\": \"6165235405\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Mitchel\", \"last_name_emergency\": \"Berry\", \"phone_emergency\": \"8286465199\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 06:28:06\", \"primary_location\": 33}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 06:28:06'),
(113, 'U', 'users', '64', '{\"id\": 64, \"first_name\": \"Sarah\", \"last_name\": \"Peterson\", \"middle_name\": \"Anne\", \"preferred_name\": null, \"birth_date\": \"2000-11-20\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"9209 Billows Circle\", \"city\": \"Raleigh\", \"zip\": 27545, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"sarah2@test.com\", \"phone_primary\": \"6135694860\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Abigail\", \"last_name_emergency\": \"Chan\", \"phone_emergency\": \"8085236661\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', '{\"id\": 64, \"first_name\": \"Sarah\", \"last_name\": \"Peterson\", \"middle_name\": \"Anne\", \"preferred_name\": null, \"birth_date\": \"2000-11-20\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"9209 Billows Circle\", \"city\": \"Raleigh\", \"zip\": 27545, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"sarah2@test.com\", \"phone_primary\": \"6135694860\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Abigail\", \"last_name_emergency\": \"Chan\", \"phone_emergency\": \"8085236661\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 06:28:10\", \"primary_location\": 34}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 06:28:10'),
(114, 'U', 'users', '65', '{\"id\": 65, \"first_name\": \"Jerrod\", \"last_name\": \"Brown\", \"middle_name\": \"Michael\", \"preferred_name\": null, \"birth_date\": \"1990-02-08\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"9209 Zenith Drive\", \"city\": \"Denver\", \"zip\": 80019, \"state_abv\": \"CO\", \"country_abv\": \"US\", \"email\": \"jerrod@test.com\", \"phone_primary\": \"9184635035\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Georgia\", \"last_name_emergency\": \"Brown\", \"phone_emergency\": \"8826516523\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', '{\"id\": 65, \"first_name\": \"Jerrod\", \"last_name\": \"Brown\", \"middle_name\": \"Michael\", \"preferred_name\": null, \"birth_date\": \"1990-02-08\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"9209 Zenith Drive\", \"city\": \"Denver\", \"zip\": 80019, \"state_abv\": \"CO\", \"country_abv\": \"US\", \"email\": \"jerrod@test.com\", \"phone_primary\": \"9184635035\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Georgia\", \"last_name_emergency\": \"Brown\", \"phone_emergency\": \"8826516523\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 06:28:14\", \"primary_location\": 35}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 06:28:14'),
(115, 'U', 'users', '66', '{\"id\": 66, \"first_name\": \"Violet\", \"last_name\": \"Fillipecci\", \"middle_name\": \"Christine\", \"preferred_name\": null, \"birth_date\": \"1982-07-24\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"156 Green Street #901\", \"city\": \"Denver\", \"zip\": 80110, \"state_abv\": \"CO\", \"country_abv\": \"US\", \"email\": \"violet@test.com\", \"phone_primary\": \"6134657208\", \"phone_p_country\": 1, \"phone_secondary\": \"5616543252\", \"phone_s_country\": 1, \"first_name_emergency\": \"Francis\", \"last_name_emergency\": \"Wu\", \"phone_emergency\": \"6413665202\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', '{\"id\": 66, \"first_name\": \"Violet\", \"last_name\": \"Fillipecci\", \"middle_name\": \"Christine\", \"preferred_name\": null, \"birth_date\": \"1982-07-24\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"156 Green Street #901\", \"city\": \"Denver\", \"zip\": 80110, \"state_abv\": \"CO\", \"country_abv\": \"US\", \"email\": \"violet@test.com\", \"phone_primary\": \"6134657208\", \"phone_p_country\": 1, \"phone_secondary\": \"5616543252\", \"phone_s_country\": 1, \"first_name_emergency\": \"Francis\", \"last_name_emergency\": \"Wu\", \"phone_emergency\": \"6413665202\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 06:28:17\", \"primary_location\": 36}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 06:28:17'),
(116, 'U', 'users', '67', '{\"id\": 67, \"first_name\": \"April\", \"last_name\": \"Cintera\", \"middle_name\": null, \"preferred_name\": null, \"birth_date\": \"1995-12-05\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"1500 Burns Place #90\", \"city\": \"Brooklyn\", \"zip\": 11238, \"state_abv\": \"NY\", \"country_abv\": \"US\", \"email\": \"april@test.com\", \"phone_primary\": \"6134698502\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Nieve\", \"last_name_emergency\": \"Burris\", \"phone_emergency\": \"5587500251\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', '{\"id\": 67, \"first_name\": \"April\", \"last_name\": \"Cintera\", \"middle_name\": null, \"preferred_name\": null, \"birth_date\": \"1995-12-05\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"1500 Burns Place #90\", \"city\": \"Brooklyn\", \"zip\": 11238, \"state_abv\": \"NY\", \"country_abv\": \"US\", \"email\": \"april@test.com\", \"phone_primary\": \"6134698502\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Nieve\", \"last_name_emergency\": \"Burris\", \"phone_emergency\": \"5587500251\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 06:28:21\", \"primary_location\": 37}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 06:28:21'),
(117, 'U', 'users', '68', '{\"id\": 68, \"first_name\": \"Michael\", \"last_name\": \"Stebbing\", \"middle_name\": \"Todd\", \"preferred_name\": \"Mike\", \"birth_date\": \"1985-01-31\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"68 Vermont Avenue\", \"city\": \"Culver City\", \"zip\": 90004, \"state_abv\": \"CA\", \"country_abv\": \"US\", \"email\": \"mike@test.com\", \"phone_primary\": \"6163430950\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Coleen\", \"last_name_emergency\": \"Stebbing\", \"phone_emergency\": \"4465889530\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', '{\"id\": 68, \"first_name\": \"Michael\", \"last_name\": \"Stebbing\", \"middle_name\": \"Todd\", \"preferred_name\": \"Mike\", \"birth_date\": \"1985-01-31\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"68 Vermont Avenue\", \"city\": \"Culver City\", \"zip\": 90004, \"state_abv\": \"CA\", \"country_abv\": \"US\", \"email\": \"mike@test.com\", \"phone_primary\": \"6163430950\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Coleen\", \"last_name_emergency\": \"Stebbing\", \"phone_emergency\": \"4465889530\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 06:28:24\", \"primary_location\": 38}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 06:28:24');
INSERT INTO `audits` (`pk`, `type`, `table_name`, `record_id`, `old_values`, `new_values`, `applied_by`, `applied_on`) VALUES
(118, 'U', 'users', '69', '{\"id\": 69, \"first_name\": \"William\", \"last_name\": \"Grant\", \"middle_name\": \"Lane\", \"preferred_name\": \"Bill\", \"birth_date\": \"1986-08-06\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"20 Tomahawk Lake Drive\", \"city\": \"Black Mountain\", \"zip\": 28774, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"bill@test.com\", \"phone_primary\": \"6164365987\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Patricia\", \"last_name_emergency\": \"Russo\", \"phone_emergency\": \"6615205584\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', '{\"id\": 69, \"first_name\": \"William\", \"last_name\": \"Grant\", \"middle_name\": \"Lane\", \"preferred_name\": \"Bill\", \"birth_date\": \"1986-08-06\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"20 Tomahawk Lake Drive\", \"city\": \"Black Mountain\", \"zip\": 28774, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"bill@test.com\", \"phone_primary\": \"6164365987\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Patricia\", \"last_name_emergency\": \"Russo\", \"phone_emergency\": \"6615205584\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 06:28:33\", \"primary_location\": 33}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 06:28:33'),
(119, 'U', 'users', '70', '{\"id\": 70, \"first_name\": \"River\", \"last_name\": \"Monday\", \"middle_name\": \"Stuart\", \"preferred_name\": null, \"birth_date\": \"1999-04-09\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"14 West Burns Avenue\", \"city\": \"Raleigh\", \"zip\": 27513, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"river@test.com\", \"phone_primary\": \"3164265025\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Mallory\", \"last_name_emergency\": \"Brien\", \"phone_emergency\": \"2256399980\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', '{\"id\": 70, \"first_name\": \"River\", \"last_name\": \"Monday\", \"middle_name\": \"Stuart\", \"preferred_name\": null, \"birth_date\": \"1999-04-09\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"14 West Burns Avenue\", \"city\": \"Raleigh\", \"zip\": 27513, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"river@test.com\", \"phone_primary\": \"3164265025\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Mallory\", \"last_name_emergency\": \"Brien\", \"phone_emergency\": \"2256399980\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 06:28:36\", \"primary_location\": 34}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 06:28:36'),
(120, 'U', 'users', '71', '{\"id\": 71, \"first_name\": \"Karen\", \"last_name\": \"Truman\", \"middle_name\": \"Anne\", \"preferred_name\": null, \"birth_date\": \"1984-01-30\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"1655 14th Street #2\", \"city\": \"Boulder\", \"zip\": 80501, \"state_abv\": \"CO\", \"country_abv\": \"US\", \"email\": \"karen@test.com\", \"phone_primary\": \"6784119320\", \"phone_p_country\": 1, \"phone_secondary\": \"3166554320\", \"phone_s_country\": 1, \"first_name_emergency\": \"Lavina\", \"last_name_emergency\": \"Truman\", \"phone_emergency\": \"4456329987\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', '{\"id\": 71, \"first_name\": \"Karen\", \"last_name\": \"Truman\", \"middle_name\": \"Anne\", \"preferred_name\": null, \"birth_date\": \"1984-01-30\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"1655 14th Street #2\", \"city\": \"Boulder\", \"zip\": 80501, \"state_abv\": \"CO\", \"country_abv\": \"US\", \"email\": \"karen@test.com\", \"phone_primary\": \"6784119320\", \"phone_p_country\": 1, \"phone_secondary\": \"3166554320\", \"phone_s_country\": 1, \"first_name_emergency\": \"Lavina\", \"last_name_emergency\": \"Truman\", \"phone_emergency\": \"4456329987\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 06:28:41\", \"primary_location\": 35}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 06:28:41'),
(121, 'U', 'users', '72', '{\"id\": 72, \"first_name\": \"Sanni\", \"last_name\": \"Larsen\", \"middle_name\": \"Cassy\", \"preferred_name\": null, \"birth_date\": \"1994-03-19\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"20 Surgeon Court \", \"city\": \"Ft. Collins\", \"zip\": 80522, \"state_abv\": \"CO\", \"country_abv\": \"US\", \"email\": \"sanni@test.com\", \"phone_primary\": \"6431598550\", \"phone_p_country\": 1, \"phone_secondary\": \"6165235134\", \"phone_s_country\": 1, \"first_name_emergency\": \"Mai\", \"last_name_emergency\": \"Henry\", \"phone_emergency\": \"6365202251\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', '{\"id\": 72, \"first_name\": \"Sanni\", \"last_name\": \"Larsen\", \"middle_name\": \"Cassy\", \"preferred_name\": null, \"birth_date\": \"1994-03-19\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"20 Surgeon Court \", \"city\": \"Ft. Collins\", \"zip\": 80522, \"state_abv\": \"CO\", \"country_abv\": \"US\", \"email\": \"sanni@test.com\", \"phone_primary\": \"6431598550\", \"phone_p_country\": 1, \"phone_secondary\": \"6165235134\", \"phone_s_country\": 1, \"first_name_emergency\": \"Mai\", \"last_name_emergency\": \"Henry\", \"phone_emergency\": \"6365202251\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 06:28:46\", \"primary_location\": 36}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 06:28:46'),
(122, 'U', 'users', '73', '{\"id\": 73, \"first_name\": \"Neil\", \"last_name\": \"Francis\", \"middle_name\": \"Winston\", \"preferred_name\": null, \"birth_date\": \"1998-04-07\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"2093 Hill Street #902\", \"city\": \"Brooklyn\", \"zip\": 11201, \"state_abv\": \"NY\", \"country_abv\": \"US\", \"email\": \"neil@test.com\", \"phone_primary\": \"9496538024\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Isma\", \"last_name_emergency\": \"Neil\", \"phone_emergency\": \"9836621036\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', '{\"id\": 73, \"first_name\": \"Neil\", \"last_name\": \"Francis\", \"middle_name\": \"Winston\", \"preferred_name\": null, \"birth_date\": \"1998-04-07\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"2093 Hill Street #902\", \"city\": \"Brooklyn\", \"zip\": 11201, \"state_abv\": \"NY\", \"country_abv\": \"US\", \"email\": \"neil@test.com\", \"phone_primary\": \"9496538024\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Isma\", \"last_name_emergency\": \"Neil\", \"phone_emergency\": \"9836621036\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 06:28:50\", \"primary_location\": 37}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 06:28:50'),
(123, 'U', 'users', '74', '{\"id\": 74, \"first_name\": \"Francisco\", \"last_name\": \"Sanchez\", \"middle_name\": \"Javier\", \"preferred_name\": \"Frank\", \"birth_date\": \"1986-06-17\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"2908 Ocean Park Drive\", \"city\": \"Los Angeles\", \"zip\": 90002, \"state_abv\": \"CA\", \"country_abv\": \"US\", \"email\": \"frank2@test.com\", \"phone_primary\": \"6420319854\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Fern\", \"last_name_emergency\": \"Hudson\", \"phone_emergency\": \"5515542399\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', '{\"id\": 74, \"first_name\": \"Francisco\", \"last_name\": \"Sanchez\", \"middle_name\": \"Javier\", \"preferred_name\": \"Frank\", \"birth_date\": \"1986-06-17\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"2908 Ocean Park Drive\", \"city\": \"Los Angeles\", \"zip\": 90002, \"state_abv\": \"CA\", \"country_abv\": \"US\", \"email\": \"frank2@test.com\", \"phone_primary\": \"6420319854\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Fern\", \"last_name_emergency\": \"Hudson\", \"phone_emergency\": \"5515542399\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 06:28:58\", \"primary_location\": 38}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 06:28:58'),
(124, 'U', 'users', '75', '{\"id\": 75, \"first_name\": \"David\", \"last_name\": \"Elliot\", \"middle_name\": \"Ilkin\", \"preferred_name\": \"Dave\", \"birth_date\": \"1989-03-03\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"38 Granite Street\", \"city\": \"Asheville\", \"zip\": 28801, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"dave@test.com\", \"phone_primary\": \"5240316587\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Alister\", \"last_name_emergency\": \"Ramos\", \"phone_emergency\": \"6063236685\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', '{\"id\": 75, \"first_name\": \"David\", \"last_name\": \"Elliot\", \"middle_name\": \"Ilkin\", \"preferred_name\": \"Dave\", \"birth_date\": \"1989-03-03\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"38 Granite Street\", \"city\": \"Asheville\", \"zip\": 28801, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"dave@test.com\", \"phone_primary\": \"5240316587\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Alister\", \"last_name_emergency\": \"Ramos\", \"phone_emergency\": \"6063236685\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 06:29:32\", \"primary_location\": 33}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 06:29:32'),
(125, 'U', 'users', '76', '{\"id\": 76, \"first_name\": \"Kylee\", \"last_name\": \"Hyde\", \"middle_name\": \"Rachel\", \"preferred_name\": null, \"birth_date\": \"1981-09-30\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"1400 Fern Lake Circle\", \"city\": \"Durham\", \"zip\": 27661, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"kylee@test.com\", \"phone_primary\": \"6498863027\", \"phone_p_country\": 1, \"phone_secondary\": \"6463215646\", \"phone_s_country\": 1, \"first_name_emergency\": \"Laylah\", \"last_name_emergency\": \"McDermott\", \"phone_emergency\": \"5548756990\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', '{\"id\": 76, \"first_name\": \"Kylee\", \"last_name\": \"Hyde\", \"middle_name\": \"Rachel\", \"preferred_name\": null, \"birth_date\": \"1981-09-30\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"1400 Fern Lake Circle\", \"city\": \"Durham\", \"zip\": 27661, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"kylee@test.com\", \"phone_primary\": \"6498863027\", \"phone_p_country\": 1, \"phone_secondary\": \"6463215646\", \"phone_s_country\": 1, \"first_name_emergency\": \"Laylah\", \"last_name_emergency\": \"McDermott\", \"phone_emergency\": \"5548756990\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 06:29:41\", \"primary_location\": 34}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 06:29:41'),
(126, 'U', 'users', '77', '{\"id\": 77, \"first_name\": \"Amina\", \"last_name\": \"Minett\", \"middle_name\": \"Maxima\", \"preferred_name\": \"Amie\", \"birth_date\": \"1989-02-17\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"2893 Lavendar Avenue\", \"city\": \"Boulder\", \"zip\": 80412, \"state_abv\": \"CO\", \"country_abv\": \"US\", \"email\": \"amie@test.com\", \"phone_primary\": \"8496350256\", \"phone_p_country\": 1, \"phone_secondary\": \"5406516185\", \"phone_s_country\": 1, \"first_name_emergency\": \"Buddy\", \"last_name_emergency\": \"Paine\", \"phone_emergency\": \"8286353612\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', '{\"id\": 77, \"first_name\": \"Amina\", \"last_name\": \"Minett\", \"middle_name\": \"Maxima\", \"preferred_name\": \"Amie\", \"birth_date\": \"1989-02-17\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"2893 Lavendar Avenue\", \"city\": \"Boulder\", \"zip\": 80412, \"state_abv\": \"CO\", \"country_abv\": \"US\", \"email\": \"amie@test.com\", \"phone_primary\": \"8496350256\", \"phone_p_country\": 1, \"phone_secondary\": \"5406516185\", \"phone_s_country\": 1, \"first_name_emergency\": \"Buddy\", \"last_name_emergency\": \"Paine\", \"phone_emergency\": \"8286353612\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 06:29:45\", \"primary_location\": 35}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 06:29:45'),
(127, 'U', 'users', '78', '{\"id\": 78, \"first_name\": \"Erin\", \"last_name\": \"Salomon\", \"middle_name\": \"Madeleine\", \"preferred_name\": null, \"birth_date\": \"1981-04-25\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"290 New Holland Drive\", \"city\": \"Asheville\", \"zip\": 28806, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"erin3@test.com\", \"phone_primary\": \"8084623521\", \"phone_p_country\": 1, \"phone_secondary\": \"5654325512\", \"phone_s_country\": 1, \"first_name_emergency\": \"first_name_emergency\", \"last_name_emergency\": \"last_name_emergency\", \"phone_emergency\": \"3250426615\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"MM\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', '{\"id\": 78, \"first_name\": \"Erin\", \"last_name\": \"Salomon\", \"middle_name\": \"Madeleine\", \"preferred_name\": null, \"birth_date\": \"1981-04-25\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"290 New Holland Drive\", \"city\": \"Asheville\", \"zip\": 28806, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"erin3@test.com\", \"phone_primary\": \"8084623521\", \"phone_p_country\": 1, \"phone_secondary\": \"5654325512\", \"phone_s_country\": 1, \"first_name_emergency\": \"first_name_emergency\", \"last_name_emergency\": \"last_name_emergency\", \"phone_emergency\": \"3250426615\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"MM\", \"created_at\": \"2022-05-01 06:29:53\", \"primary_location\": 33}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 06:29:53'),
(128, 'U', 'users', '79', '{\"id\": 79, \"first_name\": \"Caitlin\", \"last_name\": \"McGuiness\", \"middle_name\": \"Josette\", \"preferred_name\": \"Cai\", \"birth_date\": \"1971-09-01\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"930 Filbert Street\", \"city\": \"Raleigh\", \"zip\": 27606, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"cai@test.com\", \"phone_primary\": \"8879463250\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"first_name_emergency\", \"last_name_emergency\": \"last_name_emergency\", \"phone_emergency\": \"3033559980\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"MM\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', '{\"id\": 79, \"first_name\": \"Caitlin\", \"last_name\": \"McGuiness\", \"middle_name\": \"Josette\", \"preferred_name\": \"Cai\", \"birth_date\": \"1971-09-01\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"930 Filbert Street\", \"city\": \"Raleigh\", \"zip\": 27606, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"cai@test.com\", \"phone_primary\": \"8879463250\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"first_name_emergency\", \"last_name_emergency\": \"last_name_emergency\", \"phone_emergency\": \"3033559980\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"MM\", \"created_at\": \"2022-05-01 06:29:56\", \"primary_location\": 34}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 06:29:56'),
(129, 'U', 'users', '80', '{\"id\": 80, \"first_name\": \"Evan\", \"last_name\": \"Nevin\", \"middle_name\": \"Sudar\", \"preferred_name\": null, \"birth_date\": \"1974-01-02\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"2093 Snowden Road\", \"city\": \"Denver\", \"zip\": 80014, \"state_abv\": \"CO\", \"country_abv\": \"US\", \"email\": \"evan@test.com\", \"phone_primary\": \"6163250843\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Gene\", \"last_name_emergency\": \"Nevin\", \"phone_emergency\": \"5521305531\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"MM\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', '{\"id\": 80, \"first_name\": \"Evan\", \"last_name\": \"Nevin\", \"middle_name\": \"Sudar\", \"preferred_name\": null, \"birth_date\": \"1974-01-02\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"2093 Snowden Road\", \"city\": \"Denver\", \"zip\": 80014, \"state_abv\": \"CO\", \"country_abv\": \"US\", \"email\": \"evan@test.com\", \"phone_primary\": \"6163250843\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Gene\", \"last_name_emergency\": \"Nevin\", \"phone_emergency\": \"5521305531\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"MM\", \"created_at\": \"2022-05-01 06:29:58\", \"primary_location\": 35}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 06:29:58'),
(130, 'U', 'users', '81', '{\"id\": 81, \"first_name\": \"Skylar\", \"last_name\": \"Langley\", \"middle_name\": \"Barnabas\", \"preferred_name\": null, \"birth_date\": \"1996-02-04\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"109 Gateway Drive\", \"city\": \"Denver\", \"zip\": 80019, \"state_abv\": \"CO\", \"country_abv\": \"US\", \"email\": \"skylar@test.com\", \"phone_primary\": \"8084621865\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Geoffrey\", \"last_name_emergency\": \"Langley\", \"phone_emergency\": \"4133502807\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"MM\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', '{\"id\": 81, \"first_name\": \"Skylar\", \"last_name\": \"Langley\", \"middle_name\": \"Barnabas\", \"preferred_name\": null, \"birth_date\": \"1996-02-04\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"109 Gateway Drive\", \"city\": \"Denver\", \"zip\": 80019, \"state_abv\": \"CO\", \"country_abv\": \"US\", \"email\": \"skylar@test.com\", \"phone_primary\": \"8084621865\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Geoffrey\", \"last_name_emergency\": \"Langley\", \"phone_emergency\": \"4133502807\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"MM\", \"created_at\": \"2022-05-01 06:30:01\", \"primary_location\": 36}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 06:30:01'),
(131, 'U', 'users', '82', '{\"id\": 82, \"first_name\": \"Idir\", \"last_name\": \"Ma\", \"middle_name\": \"Tro\", \"preferred_name\": \"Idy\", \"birth_date\": \"1989-11-29\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"29 6th Avenue #502\", \"city\": \"Brooklyn\", \"zip\": 11202, \"state_abv\": \"NY\", \"country_abv\": \"US\", \"email\": \"idy@test.com\", \"phone_primary\": \"8548946320\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Saxon\", \"last_name_emergency\": \"Haigh\", \"phone_emergency\": \"9093652154\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"MM\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', '{\"id\": 82, \"first_name\": \"Idir\", \"last_name\": \"Ma\", \"middle_name\": \"Tro\", \"preferred_name\": \"Idy\", \"birth_date\": \"1989-11-29\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"29 6th Avenue #502\", \"city\": \"Brooklyn\", \"zip\": 11202, \"state_abv\": \"NY\", \"country_abv\": \"US\", \"email\": \"idy@test.com\", \"phone_primary\": \"8548946320\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Saxon\", \"last_name_emergency\": \"Haigh\", \"phone_emergency\": \"9093652154\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"MM\", \"created_at\": \"2022-05-01 06:30:05\", \"primary_location\": 37}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 06:30:05'),
(132, 'U', 'users', '83', '{\"id\": 83, \"first_name\": \"Katarin\", \"last_name\": \"Gutierrez\", \"middle_name\": \"Sondra\", \"preferred_name\": \"Kate\", \"birth_date\": \"1992-03-19\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"293 New Glen Road\", \"city\": \"Glendale\", \"zip\": 90001, \"state_abv\": \"CA\", \"country_abv\": \"US\", \"email\": \"kate@test.com\", \"phone_primary\": \"6049810651\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Demi\", \"last_name_emergency\": \"Patel\", \"phone_emergency\": \"4230541325\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"MM\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', '{\"id\": 83, \"first_name\": \"Katarin\", \"last_name\": \"Gutierrez\", \"middle_name\": \"Sondra\", \"preferred_name\": \"Kate\", \"birth_date\": \"1992-03-19\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"293 New Glen Road\", \"city\": \"Glendale\", \"zip\": 90001, \"state_abv\": \"CA\", \"country_abv\": \"US\", \"email\": \"kate@test.com\", \"phone_primary\": \"6049810651\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Demi\", \"last_name_emergency\": \"Patel\", \"phone_emergency\": \"4230541325\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"MM\", \"created_at\": \"2022-05-01 06:30:09\", \"primary_location\": 38}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 06:30:09'),
(133, 'U', 'users', '84', '{\"id\": 84, \"first_name\": \"Tracie\", \"last_name\": \"Connor\", \"middle_name\": \"Robby\", \"preferred_name\": null, \"birth_date\": \"1986-08-12\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"2839 Granby Avenue\", \"city\": \"Weaverville\", \"zip\": 28778, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"tracie@test.com\", \"phone_primary\": \"3031613498\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Kenzie\", \"last_name_emergency\": \"Holding\", \"phone_emergency\": \"8438543216\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"MM\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', '{\"id\": 84, \"first_name\": \"Tracie\", \"last_name\": \"Connor\", \"middle_name\": \"Robby\", \"preferred_name\": null, \"birth_date\": \"1986-08-12\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"2839 Granby Avenue\", \"city\": \"Weaverville\", \"zip\": 28778, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"tracie@test.com\", \"phone_primary\": \"3031613498\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Kenzie\", \"last_name_emergency\": \"Holding\", \"phone_emergency\": \"8438543216\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"MM\", \"created_at\": \"2022-05-01 06:30:14\", \"primary_location\": 33}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 06:30:14'),
(134, 'U', 'users', '85', '{\"id\": 85, \"first_name\": \"Delilah\", \"last_name\": \"Drake\", \"middle_name\": \"Belle\", \"preferred_name\": null, \"birth_date\": \"1961-06-06\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"953 Van Dyke Street\", \"city\": \"Raleigh\", \"zip\": 27606, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"delilah@test.com\", \"phone_primary\": \"6402186624\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Hayden\", \"last_name_emergency\": \"Drake\", \"phone_emergency\": \"9315163501\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"MM\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', '{\"id\": 85, \"first_name\": \"Delilah\", \"last_name\": \"Drake\", \"middle_name\": \"Belle\", \"preferred_name\": null, \"birth_date\": \"1961-06-06\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"953 Van Dyke Street\", \"city\": \"Raleigh\", \"zip\": 27606, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"delilah@test.com\", \"phone_primary\": \"6402186624\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Hayden\", \"last_name_emergency\": \"Drake\", \"phone_emergency\": \"9315163501\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"MM\", \"created_at\": \"2022-05-01 06:30:18\", \"primary_location\": 34}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 06:30:18'),
(135, 'U', 'users', '86', '{\"id\": 86, \"first_name\": \"Lukas\", \"last_name\": \"Araujo\", \"middle_name\": null, \"preferred_name\": \"Luke\", \"birth_date\": \"1987-07-31\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"555 West Sherwood Street\", \"city\": \"Boulder\", \"zip\": 80504, \"state_abv\": \"CO\", \"country_abv\": \"US\", \"email\": \"luke@test.com\", \"phone_primary\": \"6436561970\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Dahlia\", \"last_name_emergency\": \"Frank\", \"phone_emergency\": \"7065216542\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"MM\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', '{\"id\": 86, \"first_name\": \"Lukas\", \"last_name\": \"Araujo\", \"middle_name\": null, \"preferred_name\": \"Luke\", \"birth_date\": \"1987-07-31\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"555 West Sherwood Street\", \"city\": \"Boulder\", \"zip\": 80504, \"state_abv\": \"CO\", \"country_abv\": \"US\", \"email\": \"luke@test.com\", \"phone_primary\": \"6436561970\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Dahlia\", \"last_name_emergency\": \"Frank\", \"phone_emergency\": \"7065216542\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"MM\", \"created_at\": \"2022-05-01 06:30:26\", \"primary_location\": 35}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 06:30:26'),
(136, 'U', 'users', '87', '{\"id\": 87, \"first_name\": \"Donald\", \"last_name\": \"Archer\", \"middle_name\": \"Celine\", \"preferred_name\": \"Donny\", \"birth_date\": \"1983-11-19\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"187 Penn Lane #5\", \"city\": \"Staten Island\", \"zip\": 11201, \"state_abv\": \"NY\", \"country_abv\": \"US\", \"email\": \"donny@test.com\", \"phone_primary\": \"8285212262\", \"phone_p_country\": 1, \"phone_secondary\": \"9846502215\", \"phone_s_country\": 1, \"first_name_emergency\": \"Ewan\", \"last_name_emergency\": \"Archer\", \"phone_emergency\": \"4652151380\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"MM\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', '{\"id\": 87, \"first_name\": \"Donald\", \"last_name\": \"Archer\", \"middle_name\": \"Celine\", \"preferred_name\": \"Donny\", \"birth_date\": \"1983-11-19\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"187 Penn Lane #5\", \"city\": \"Staten Island\", \"zip\": 11201, \"state_abv\": \"NY\", \"country_abv\": \"US\", \"email\": \"donny@test.com\", \"phone_primary\": \"8285212262\", \"phone_p_country\": 1, \"phone_secondary\": \"9846502215\", \"phone_s_country\": 1, \"first_name_emergency\": \"Ewan\", \"last_name_emergency\": \"Archer\", \"phone_emergency\": \"4652151380\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"MM\", \"created_at\": \"2022-05-01 06:30:33\", \"primary_location\": 37}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 06:30:33'),
(137, 'U', 'users', '88', '{\"id\": 88, \"first_name\": \"Bine\", \"last_name\": \"Bartram\", \"middle_name\": \"Kamon\", \"preferred_name\": null, \"birth_date\": \"2004-01-24\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"82 SE Eagle Street\", \"city\": \"Asheville\", \"zip\": 28806, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"bine@test.com\", \"phone_primary\": \"6137984650\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Romany\", \"last_name_emergency\": \"Bartram\", \"phone_emergency\": \"3315245520\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', '{\"id\": 88, \"first_name\": \"Bine\", \"last_name\": \"Bartram\", \"middle_name\": \"Kamon\", \"preferred_name\": null, \"birth_date\": \"2004-01-24\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"82 SE Eagle Street\", \"city\": \"Asheville\", \"zip\": 28806, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"bine@test.com\", \"phone_primary\": \"6137984650\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Romany\", \"last_name_emergency\": \"Bartram\", \"phone_emergency\": \"3315245520\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 06:30:42\", \"primary_location\": 33}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 06:30:42'),
(138, 'U', 'users', '89', '{\"id\": 89, \"first_name\": \"Sabine\", \"last_name\": \"Mills\", \"middle_name\": null, \"preferred_name\": null, \"birth_date\": \"1987-01-29\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"9199 S Hawthorne Ave\", \"city\": \"Raleigh\", \"zip\": 27606, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"sabine@test.com\", \"phone_primary\": \"7986521084\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Aariz\", \"last_name_emergency\": \"Tillman\", \"phone_emergency\": \"9985324200\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', '{\"id\": 89, \"first_name\": \"Sabine\", \"last_name\": \"Mills\", \"middle_name\": null, \"preferred_name\": null, \"birth_date\": \"1987-01-29\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"9199 S Hawthorne Ave\", \"city\": \"Raleigh\", \"zip\": 27606, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"sabine@test.com\", \"phone_primary\": \"7986521084\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Aariz\", \"last_name_emergency\": \"Tillman\", \"phone_emergency\": \"9985324200\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 06:30:45\", \"primary_location\": 34}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 06:30:45'),
(139, 'U', 'users', '90', '{\"id\": 90, \"first_name\": \"Alexander\", \"last_name\": \"Herriot\", \"middle_name\": \"Hesham\", \"preferred_name\": \"Alex\", \"birth_date\": \"1975-09-09\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"71 Marconi Drive\", \"city\": \"Denver\", \"zip\": 80014, \"state_abv\": \"CO\", \"country_abv\": \"US\", \"email\": \"alex@test.com\", \"phone_primary\": \"6133212150\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Nikolas\", \"last_name_emergency\": \"Herriot\", \"phone_emergency\": \"5054239875\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', '{\"id\": 90, \"first_name\": \"Alexander\", \"last_name\": \"Herriot\", \"middle_name\": \"Hesham\", \"preferred_name\": \"Alex\", \"birth_date\": \"1975-09-09\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"71 Marconi Drive\", \"city\": \"Denver\", \"zip\": 80014, \"state_abv\": \"CO\", \"country_abv\": \"US\", \"email\": \"alex@test.com\", \"phone_primary\": \"6133212150\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Nikolas\", \"last_name_emergency\": \"Herriot\", \"phone_emergency\": \"5054239875\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 06:30:57\", \"primary_location\": 35}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 06:30:57'),
(140, 'U', 'users', '91', '{\"id\": 91, \"first_name\": \"Isa\", \"last_name\": \"Holmstrom\", \"middle_name\": \"Kelly\", \"preferred_name\": null, \"birth_date\": \"1992-03-03\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"9936 Fairway Street\", \"city\": \"Ft. Collins\", \"zip\": 80521, \"state_abv\": \"CO\", \"country_abv\": \"US\", \"email\": \"isa@test.com\", \"phone_primary\": \"6413252504\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Freya\", \"last_name_emergency\": \"Carlson\", \"phone_emergency\": \"3032126528\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', '{\"id\": 91, \"first_name\": \"Isa\", \"last_name\": \"Holmstrom\", \"middle_name\": \"Kelly\", \"preferred_name\": null, \"birth_date\": \"1992-03-03\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"9936 Fairway Street\", \"city\": \"Ft. Collins\", \"zip\": 80521, \"state_abv\": \"CO\", \"country_abv\": \"US\", \"email\": \"isa@test.com\", \"phone_primary\": \"6413252504\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Freya\", \"last_name_emergency\": \"Carlson\", \"phone_emergency\": \"3032126528\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 06:31:02\", \"primary_location\": 36}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 06:31:02'),
(141, 'U', 'users', '92', '{\"id\": 92, \"first_name\": \"Phillip\", \"last_name\": \"Emerson\", \"middle_name\": null, \"preferred_name\": \"Phil\", \"birth_date\": \"1988-04-13\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"362 Logan Avenue #30\", \"city\": \"Brooklyn\", \"zip\": 11201, \"state_abv\": \"NY\", \"country_abv\": \"US\", \"email\": \"phil2@test.com\", \"phone_primary\": \"4652381601\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Sarah\", \"last_name_emergency\": \"Emerson\", \"phone_emergency\": \"9026332581\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 04:43:33\", \"primary_location\": null}', '{\"id\": 92, \"first_name\": \"Phillip\", \"last_name\": \"Emerson\", \"middle_name\": null, \"preferred_name\": \"Phil\", \"birth_date\": \"1988-04-13\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"362 Logan Avenue #30\", \"city\": \"Brooklyn\", \"zip\": 11201, \"state_abv\": \"NY\", \"country_abv\": \"US\", \"email\": \"phil2@test.com\", \"phone_primary\": \"4652381601\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Sarah\", \"last_name_emergency\": \"Emerson\", \"phone_emergency\": \"9026332581\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 06:31:05\", \"primary_location\": 37}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-01 06:31:05'),
(142, 'I', 'users', '93', NULL, '{\"id\": 93, \"first_name\": \"Jimmy\", \"last_name\": \"Baker\", \"middle_name\": \"R\", \"preferred_name\": null, \"birth_date\": \"2022-05-01\", \"avatar_url\": \"/public/upload/profile/default.png\", \"street_address\": \"PO Box 2012\", \"city\": \"Enka\", \"zip\": 28728, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"jamesbaker@students.abtech.edu\", \"phone_primary\": \"2526465221\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Kristen\", \"last_name_emergency\": \"Baker\", \"phone_emergency\": \"6507232091\", \"phone_e_country\": 1, \"password_hash\": \"$2y$10$jI/Z7FZex1XrgK64x/M3mO/an450O2/Azyugim89TG8VNKylDS/aq\", \"access_abv\": \"MM\", \"created_at\": \"2022-05-03 06:32:00\", \"primary_location\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 06:32:00'),
(143, 'U', 'users', '93', '{\"id\": 93, \"first_name\": \"Jimmy\", \"last_name\": \"Baker\", \"middle_name\": \"R\", \"preferred_name\": null, \"birth_date\": \"2022-05-01\", \"avatar_url\": \"/public/upload/profile/default.png\", \"street_address\": \"PO Box 2012\", \"city\": \"Enka\", \"zip\": 28728, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"jamesbaker@students.abtech.edu\", \"phone_primary\": \"2526465221\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Kristen\", \"last_name_emergency\": \"Baker\", \"phone_emergency\": \"6507232091\", \"phone_e_country\": 1, \"password_hash\": \"$2y$10$jI/Z7FZex1XrgK64x/M3mO/an450O2/Azyugim89TG8VNKylDS/aq\", \"access_abv\": \"MM\", \"created_at\": \"2022-05-03 06:32:00\", \"primary_location\": null}', '{\"id\": 93, \"first_name\": \"Jimmy\", \"last_name\": \"Baker\", \"middle_name\": \"R\", \"preferred_name\": null, \"birth_date\": \"2022-05-01\", \"avatar_url\": \"/public/upload/profile/default.png\", \"street_address\": \"PO Box 2012\", \"city\": \"Enka\", \"zip\": 28728, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"jamesbaker@students.abtech.edu\", \"phone_primary\": \"2526465221\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Kristen\", \"last_name_emergency\": \"Baker\", \"phone_emergency\": \"6507232091\", \"phone_e_country\": 1, \"password_hash\": \"$2y$10$jI/Z7FZex1XrgK64x/M3mO/an450O2/Azyugim89TG8VNKylDS/aq\", \"access_abv\": \"MM\", \"created_at\": \"2022-05-03 07:03:18\", \"primary_location\": 6}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 07:03:18'),
(144, 'U', 'users', '93', '{\"id\": 93, \"first_name\": \"Jimmy\", \"last_name\": \"Baker\", \"middle_name\": \"R\", \"preferred_name\": null, \"birth_date\": \"2022-05-01\", \"avatar_url\": \"/public/upload/profile/default.png\", \"street_address\": \"PO Box 2012\", \"city\": \"Enka\", \"zip\": 28728, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"jamesbaker@students.abtech.edu\", \"phone_primary\": \"2526465221\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Kristen\", \"last_name_emergency\": \"Baker\", \"phone_emergency\": \"6507232091\", \"phone_e_country\": 1, \"password_hash\": \"$2y$10$jI/Z7FZex1XrgK64x/M3mO/an450O2/Azyugim89TG8VNKylDS/aq\", \"access_abv\": \"MM\", \"created_at\": \"2022-05-03 07:03:18\", \"primary_location\": 6}', '{\"id\": 93, \"first_name\": \"Jimmy\", \"last_name\": \"Baker\", \"middle_name\": null, \"preferred_name\": null, \"birth_date\": \"2022-05-01\", \"avatar_url\": \"/public/upload/profile/default.png\", \"street_address\": \"PO Box 2012\", \"city\": \"Enka\", \"zip\": 28728, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"jamesbaker@students.abtech.edu\", \"phone_primary\": \"2526465221\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Kristen\", \"last_name_emergency\": \"Baker\", \"phone_emergency\": \"6507232091\", \"phone_e_country\": 1, \"password_hash\": \"$2y$10$jI/Z7FZex1XrgK64x/M3mO/an450O2/Azyugim89TG8VNKylDS/aq\", \"access_abv\": \"MM\", \"created_at\": \"2022-05-03 07:03:18\", \"primary_location\": 33}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 07:19:48'),
(145, 'D', 'users', '93', '{\"id\": 93, \"first_name\": \"Jimmy\", \"last_name\": \"Baker\", \"middle_name\": null, \"preferred_name\": null, \"birth_date\": \"2022-05-01\", \"avatar_url\": \"/public/upload/profile/default.png\", \"street_address\": \"PO Box 2012\", \"city\": \"Enka\", \"zip\": 28728, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"jamesbaker@students.abtech.edu\", \"phone_primary\": \"2526465221\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Kristen\", \"last_name_emergency\": \"Baker\", \"phone_emergency\": \"6507232091\", \"phone_e_country\": 1, \"password_hash\": \"$2y$10$jI/Z7FZex1XrgK64x/M3mO/an450O2/Azyugim89TG8VNKylDS/aq\", \"access_abv\": \"MM\", \"created_at\": \"2022-05-03 07:03:18\", \"primary_location\": 33}', NULL, 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 07:22:01'),
(146, 'U', 'users', '50', '{\"id\": 50, \"first_name\": \"James\", \"last_name\": \"Baker\", \"middle_name\": \"Robert\", \"preferred_name\": \"Jimmy\", \"birth_date\": \"1991-02-12\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"PO Box 2012\", \"city\": \"Enka\", \"zip\": 28728, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"baker.jimmy@gmail.com\", \"phone_primary\": \"2526465221\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Caet\", \"last_name_emergency\": \"Cash\", \"phone_emergency\": \"8284507973\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"AA\", \"created_at\": \"2022-05-01 06:26:54\", \"primary_location\": 33}', '{\"id\": 50, \"first_name\": \"James\", \"last_name\": \"Baker\", \"middle_name\": \"Robert\", \"preferred_name\": \"Jimmy\", \"birth_date\": \"1991-02-12\", \"avatar_url\": \"/public/upload/profile/default.png\", \"street_address\": \"PO Box 2012\", \"city\": \"Enka\", \"zip\": 28728, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"baker.jimmy@gmail.com\", \"phone_primary\": \"2526465221\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Caet\", \"last_name_emergency\": \"Cash\", \"phone_emergency\": \"8284507973\", \"phone_e_country\": 1, \"password_hash\": \"$2y$10$I/73J1RXodbvqQr7EcQfKeDUc3ORZz2TC5fQJtvqd5vhmgIuqp4Bu\", \"access_abv\": \"AA\", \"created_at\": \"2022-05-01 06:26:54\", \"primary_location\": 33}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 08:00:33'),
(147, 'U', 'users', '78', '{\"id\": 78, \"first_name\": \"Erin\", \"last_name\": \"Salomon\", \"middle_name\": \"Madeleine\", \"preferred_name\": null, \"birth_date\": \"1981-04-25\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"290 New Holland Drive\", \"city\": \"Asheville\", \"zip\": 28806, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"erin3@test.com\", \"phone_primary\": \"8084623521\", \"phone_p_country\": 1, \"phone_secondary\": \"5654325512\", \"phone_s_country\": 1, \"first_name_emergency\": \"first_name_emergency\", \"last_name_emergency\": \"last_name_emergency\", \"phone_emergency\": \"3250426615\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"MM\", \"created_at\": \"2022-05-01 06:29:53\", \"primary_location\": 33}', '{\"id\": 78, \"first_name\": \"Erin\", \"last_name\": \"Salomon\", \"middle_name\": \"Madeleine\", \"preferred_name\": null, \"birth_date\": \"1981-04-25\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"290 New Holland Drive\", \"city\": \"Asheville\", \"zip\": 28806, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"erin4@test.com\", \"phone_primary\": \"8084623521\", \"phone_p_country\": 1, \"phone_secondary\": \"5654325512\", \"phone_s_country\": 1, \"first_name_emergency\": \"first_name_emergency\", \"last_name_emergency\": \"last_name_emergency\", \"phone_emergency\": \"3250426615\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"MM\", \"created_at\": \"2022-05-03 08:30:25\", \"primary_location\": 33}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 08:30:25');
INSERT INTO `audits` (`pk`, `type`, `table_name`, `record_id`, `old_values`, `new_values`, `applied_by`, `applied_on`) VALUES
(148, 'U', 'users', '63', '{\"id\": 63, \"first_name\": \"Erin\", \"last_name\": \"Sanders\", \"middle_name\": \"Ashley\", \"preferred_name\": null, \"birth_date\": \"1998-08-02\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"90 Barnaby Street\", \"city\": \"Asheville\", \"zip\": 28803, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"erin@test.com\", \"phone_primary\": \"6165235405\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Mitchel\", \"last_name_emergency\": \"Berry\", \"phone_emergency\": \"8286465199\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 06:28:06\", \"primary_location\": 33}', '{\"id\": 63, \"first_name\": \"Erin\", \"last_name\": \"Sanders\", \"middle_name\": \"Ashley\", \"preferred_name\": null, \"birth_date\": \"1998-08-02\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"90 Barnaby Street\", \"city\": \"Asheville\", \"zip\": 28803, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"erin3@test.com\", \"phone_primary\": \"6165235405\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Mitchel\", \"last_name_emergency\": \"Berry\", \"phone_emergency\": \"8286465199\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-03 08:31:00\", \"primary_location\": 33}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 08:31:00'),
(149, 'U', 'users', '78', '{\"id\": 78, \"first_name\": \"Erin\", \"last_name\": \"Salomon\", \"middle_name\": \"Madeleine\", \"preferred_name\": null, \"birth_date\": \"1981-04-25\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"290 New Holland Drive\", \"city\": \"Asheville\", \"zip\": 28806, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"erin4@test.com\", \"phone_primary\": \"8084623521\", \"phone_p_country\": 1, \"phone_secondary\": \"5654325512\", \"phone_s_country\": 1, \"first_name_emergency\": \"first_name_emergency\", \"last_name_emergency\": \"last_name_emergency\", \"phone_emergency\": \"3250426615\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"MM\", \"created_at\": \"2022-05-03 08:30:25\", \"primary_location\": 33}', '{\"id\": 78, \"first_name\": \"Erin\", \"last_name\": \"Salomon\", \"middle_name\": \"Madeleine\", \"preferred_name\": null, \"birth_date\": \"1981-04-25\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"290 New Holland Drive\", \"city\": \"Asheville\", \"zip\": 28806, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"erin@test.com\", \"phone_primary\": \"8084623521\", \"phone_p_country\": 1, \"phone_secondary\": \"5654325512\", \"phone_s_country\": 1, \"first_name_emergency\": \"first_name_emergency\", \"last_name_emergency\": \"last_name_emergency\", \"phone_emergency\": \"3250426615\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"MM\", \"created_at\": \"2022-05-03 08:31:07\", \"primary_location\": 33}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 08:31:07'),
(150, 'U', 'users', '78', '{\"id\": 78, \"first_name\": \"Erin\", \"last_name\": \"Salomon\", \"middle_name\": \"Madeleine\", \"preferred_name\": null, \"birth_date\": \"1981-04-25\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"290 New Holland Drive\", \"city\": \"Asheville\", \"zip\": 28806, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"erin@test.com\", \"phone_primary\": \"8084623521\", \"phone_p_country\": 1, \"phone_secondary\": \"5654325512\", \"phone_s_country\": 1, \"first_name_emergency\": \"first_name_emergency\", \"last_name_emergency\": \"last_name_emergency\", \"phone_emergency\": \"3250426615\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"MM\", \"created_at\": \"2022-05-03 08:31:07\", \"primary_location\": 33}', '{\"id\": 78, \"first_name\": \"Erin\", \"last_name\": \"Salomon\", \"middle_name\": null, \"preferred_name\": null, \"birth_date\": \"1981-04-25\", \"avatar_url\": \"/public/upload/profile/default.png\", \"street_address\": \"290 New Holland Drive\", \"city\": \"Asheville\", \"zip\": 28806, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"erin@test.com\", \"phone_primary\": \"8084623521\", \"phone_p_country\": 1, \"phone_secondary\": \"5654325512\", \"phone_s_country\": 1, \"first_name_emergency\": \"Bill\", \"last_name_emergency\": \"Jerry\", \"phone_emergency\": \"3250426615\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"MM\", \"created_at\": \"2022-05-03 08:31:07\", \"primary_location\": 33}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 08:38:34'),
(151, 'U', 'users', '78', '{\"id\": 78, \"first_name\": \"Erin\", \"last_name\": \"Salomon\", \"middle_name\": null, \"preferred_name\": null, \"birth_date\": \"1981-04-25\", \"avatar_url\": \"/public/upload/profile/default.png\", \"street_address\": \"290 New Holland Drive\", \"city\": \"Asheville\", \"zip\": 28806, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"erin@test.com\", \"phone_primary\": \"8084623521\", \"phone_p_country\": 1, \"phone_secondary\": \"5654325512\", \"phone_s_country\": 1, \"first_name_emergency\": \"Bill\", \"last_name_emergency\": \"Jerry\", \"phone_emergency\": \"3250426615\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"MM\", \"created_at\": \"2022-05-03 08:31:07\", \"primary_location\": 33}', '{\"id\": 78, \"first_name\": \"Erin\", \"last_name\": \"Salomon\", \"middle_name\": null, \"preferred_name\": null, \"birth_date\": \"1981-04-25\", \"avatar_url\": \"/public/upload/profile/78-profile.jpeg\", \"street_address\": \"290 New Holland Drive\", \"city\": \"Asheville\", \"zip\": 28806, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"erin@test.com\", \"phone_primary\": \"8084623521\", \"phone_p_country\": 1, \"phone_secondary\": \"5654325512\", \"phone_s_country\": 1, \"first_name_emergency\": \"Bill\", \"last_name_emergency\": \"Jerry\", \"phone_emergency\": \"3250426615\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"MM\", \"created_at\": \"2022-05-03 08:31:07\", \"primary_location\": 33}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 08:40:36'),
(152, 'U', 'users', '67', '{\"id\": 67, \"first_name\": \"April\", \"last_name\": \"Cintera\", \"middle_name\": null, \"preferred_name\": null, \"birth_date\": \"1995-12-05\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"1500 Burns Place #90\", \"city\": \"Brooklyn\", \"zip\": 11238, \"state_abv\": \"NY\", \"country_abv\": \"US\", \"email\": \"april@test.com\", \"phone_primary\": \"6134698502\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Nieve\", \"last_name_emergency\": \"Burris\", \"phone_emergency\": \"5587500251\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-01 06:28:21\", \"primary_location\": 37}', '{\"id\": 67, \"first_name\": \"Ethan\", \"last_name\": \"Cintera\", \"middle_name\": null, \"preferred_name\": null, \"birth_date\": \"1995-12-05\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"1500 Burns Place #90\", \"city\": \"Brooklyn\", \"zip\": 11238, \"state_abv\": \"NY\", \"country_abv\": \"US\", \"email\": \"april@test.com\", \"phone_primary\": \"6134698502\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Nieve\", \"last_name_emergency\": \"Burris\", \"phone_emergency\": \"5587500251\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-03 08:51:28\", \"primary_location\": 37}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 08:51:28'),
(153, 'U', 'users', '67', '{\"id\": 67, \"first_name\": \"Ethan\", \"last_name\": \"Cintera\", \"middle_name\": null, \"preferred_name\": null, \"birth_date\": \"1995-12-05\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"1500 Burns Place #90\", \"city\": \"Brooklyn\", \"zip\": 11238, \"state_abv\": \"NY\", \"country_abv\": \"US\", \"email\": \"april@test.com\", \"phone_primary\": \"6134698502\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Nieve\", \"last_name_emergency\": \"Burris\", \"phone_emergency\": \"5587500251\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-03 08:51:28\", \"primary_location\": 37}', '{\"id\": 67, \"first_name\": \"Ethan\", \"last_name\": \"Cintera\", \"middle_name\": null, \"preferred_name\": null, \"birth_date\": \"1995-12-05\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"1500 Burns Place #90\", \"city\": \"Brooklyn\", \"zip\": 11238, \"state_abv\": \"NY\", \"country_abv\": \"US\", \"email\": \"ethan@test.com\", \"phone_primary\": \"6134698502\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Nieve\", \"last_name_emergency\": \"Burris\", \"phone_emergency\": \"5587500251\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-03 08:51:39\", \"primary_location\": 37}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 08:51:39'),
(154, 'U', 'users', '67', '{\"id\": 67, \"first_name\": \"Ethan\", \"last_name\": \"Cintera\", \"middle_name\": null, \"preferred_name\": null, \"birth_date\": \"1995-12-05\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"1500 Burns Place #90\", \"city\": \"Brooklyn\", \"zip\": 11238, \"state_abv\": \"NY\", \"country_abv\": \"US\", \"email\": \"ethan@test.com\", \"phone_primary\": \"6134698502\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Nieve\", \"last_name_emergency\": \"Burris\", \"phone_emergency\": \"5587500251\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-03 08:51:39\", \"primary_location\": 37}', '{\"id\": 67, \"first_name\": \"Ethan\", \"last_name\": \"Cintera\", \"middle_name\": null, \"preferred_name\": null, \"birth_date\": \"1995-12-05\", \"avatar_url\": \"/public/upload/profile/67-profile.jpeg\", \"street_address\": \"1500 Burns Place #90\", \"city\": \"Brooklyn\", \"zip\": 11238, \"state_abv\": \"NY\", \"country_abv\": \"US\", \"email\": \"ethan@test.com\", \"phone_primary\": \"6134698502\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Nieve\", \"last_name_emergency\": \"Burris\", \"phone_emergency\": \"5587500251\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-03 08:51:39\", \"primary_location\": 37}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 08:57:18'),
(155, 'U', 'users', '67', '{\"id\": 67, \"first_name\": \"Ethan\", \"last_name\": \"Cintera\", \"middle_name\": null, \"preferred_name\": null, \"birth_date\": \"1995-12-05\", \"avatar_url\": \"/public/upload/profile/67-profile.jpeg\", \"street_address\": \"1500 Burns Place #90\", \"city\": \"Brooklyn\", \"zip\": 11238, \"state_abv\": \"NY\", \"country_abv\": \"US\", \"email\": \"ethan@test.com\", \"phone_primary\": \"6134698502\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Nieve\", \"last_name_emergency\": \"Burris\", \"phone_emergency\": \"5587500251\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-03 08:51:39\", \"primary_location\": 37}', '{\"id\": 67, \"first_name\": \"Ethan\", \"last_name\": \"Cintera\", \"middle_name\": null, \"preferred_name\": null, \"birth_date\": \"1995-12-05\", \"avatar_url\": \"/public/upload/profile/67-profile.jpeg\", \"street_address\": \"1500 Burns Place #90\", \"city\": \"Brooklyn\", \"zip\": 11238, \"state_abv\": \"NY\", \"country_abv\": \"US\", \"email\": \"ethan@test.com\", \"phone_primary\": \"6134698502\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Nieve\", \"last_name_emergency\": \"Burris\", \"phone_emergency\": \"5587500251\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-03 08:51:39\", \"primary_location\": 37}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:02:41'),
(156, 'U', 'users', '67', '{\"id\": 67, \"first_name\": \"Ethan\", \"last_name\": \"Cintera\", \"middle_name\": null, \"preferred_name\": null, \"birth_date\": \"1995-12-05\", \"avatar_url\": \"/public/upload/profile/67-profile.jpeg\", \"street_address\": \"1500 Burns Place #90\", \"city\": \"Brooklyn\", \"zip\": 11238, \"state_abv\": \"NY\", \"country_abv\": \"US\", \"email\": \"ethan@test.com\", \"phone_primary\": \"6134698502\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Nieve\", \"last_name_emergency\": \"Burris\", \"phone_emergency\": \"5587500251\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-03 08:51:39\", \"primary_location\": 37}', '{\"id\": 67, \"first_name\": \"Ethan\", \"last_name\": \"Cintera\", \"middle_name\": null, \"preferred_name\": null, \"birth_date\": \"1995-12-05\", \"avatar_url\": \"/public/upload/profile/67-profile.jpeg\", \"street_address\": \"1500 Burns Place #90\", \"city\": \"Brooklyn\", \"zip\": 11238, \"state_abv\": \"NY\", \"country_abv\": \"US\", \"email\": \"ethan@test.com\", \"phone_primary\": \"6134698502\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Nieve\", \"last_name_emergency\": \"Burris\", \"phone_emergency\": \"5587500251\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-03 08:51:39\", \"primary_location\": 37}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:05:11'),
(157, 'U', 'users', '67', '{\"id\": 67, \"first_name\": \"Ethan\", \"last_name\": \"Cintera\", \"middle_name\": null, \"preferred_name\": null, \"birth_date\": \"1995-12-05\", \"avatar_url\": \"/public/upload/profile/67-profile.jpeg\", \"street_address\": \"1500 Burns Place #90\", \"city\": \"Brooklyn\", \"zip\": 11238, \"state_abv\": \"NY\", \"country_abv\": \"US\", \"email\": \"ethan@test.com\", \"phone_primary\": \"6134698502\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Nieve\", \"last_name_emergency\": \"Burris\", \"phone_emergency\": \"5587500251\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-03 08:51:39\", \"primary_location\": 37}', '{\"id\": 67, \"first_name\": \"Ethan\", \"last_name\": \"Cintera\", \"middle_name\": null, \"preferred_name\": null, \"birth_date\": \"1995-12-05\", \"avatar_url\": \"/public/upload/profile/67-profile.jpeg\", \"street_address\": \"1500 Burns Place #90\", \"city\": \"Brooklyn\", \"zip\": 11238, \"state_abv\": \"NY\", \"country_abv\": \"US\", \"email\": \"ethan@test.com\", \"phone_primary\": \"6134698502\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Nieve\", \"last_name_emergency\": \"Burris\", \"phone_emergency\": \"5587500251\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-03 08:51:39\", \"primary_location\": 37}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:05:48'),
(158, 'U', 'users', '67', '{\"id\": 67, \"first_name\": \"Ethan\", \"last_name\": \"Cintera\", \"middle_name\": null, \"preferred_name\": null, \"birth_date\": \"1995-12-05\", \"avatar_url\": \"/public/upload/profile/67-profile.jpeg\", \"street_address\": \"1500 Burns Place #90\", \"city\": \"Brooklyn\", \"zip\": 11238, \"state_abv\": \"NY\", \"country_abv\": \"US\", \"email\": \"ethan@test.com\", \"phone_primary\": \"6134698502\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Nieve\", \"last_name_emergency\": \"Burris\", \"phone_emergency\": \"5587500251\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-03 08:51:39\", \"primary_location\": 37}', '{\"id\": 67, \"first_name\": \"Ethan\", \"last_name\": \"Cintera\", \"middle_name\": null, \"preferred_name\": null, \"birth_date\": \"1995-12-05\", \"avatar_url\": \"/public/upload/profile/67-profile.jpeg\", \"street_address\": \"1500 Burns Place #90\", \"city\": \"Brooklyn\", \"zip\": 11238, \"state_abv\": \"NY\", \"country_abv\": \"US\", \"email\": \"ethan@test.com\", \"phone_primary\": \"6134698502\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Nieve\", \"last_name_emergency\": \"Burris\", \"phone_emergency\": \"5587500251\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-03 08:51:39\", \"primary_location\": 37}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:06:30'),
(159, 'U', 'users', '67', '{\"id\": 67, \"first_name\": \"Ethan\", \"last_name\": \"Cintera\", \"middle_name\": null, \"preferred_name\": null, \"birth_date\": \"1995-12-05\", \"avatar_url\": \"/public/upload/profile/67-profile.jpeg\", \"street_address\": \"1500 Burns Place #90\", \"city\": \"Brooklyn\", \"zip\": 11238, \"state_abv\": \"NY\", \"country_abv\": \"US\", \"email\": \"ethan@test.com\", \"phone_primary\": \"6134698502\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Nieve\", \"last_name_emergency\": \"Burris\", \"phone_emergency\": \"5587500251\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-03 08:51:39\", \"primary_location\": 37}', '{\"id\": 67, \"first_name\": \"Ethan\", \"last_name\": \"Cintera\", \"middle_name\": null, \"preferred_name\": null, \"birth_date\": \"1995-12-05\", \"avatar_url\": \"/public/upload/profile/67-profile.jpeg\", \"street_address\": \"1500 Burns Place #90\", \"city\": \"Brooklyn\", \"zip\": 11238, \"state_abv\": \"NY\", \"country_abv\": \"US\", \"email\": \"ethan@test.com\", \"phone_primary\": \"6134698502\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Nieve\", \"last_name_emergency\": \"Burris\", \"phone_emergency\": \"5587500251\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-03 08:51:39\", \"primary_location\": 37}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:08:14'),
(160, 'U', 'users', '67', '{\"id\": 67, \"first_name\": \"Ethan\", \"last_name\": \"Cintera\", \"middle_name\": null, \"preferred_name\": null, \"birth_date\": \"1995-12-05\", \"avatar_url\": \"/public/upload/profile/67-profile.jpeg\", \"street_address\": \"1500 Burns Place #90\", \"city\": \"Brooklyn\", \"zip\": 11238, \"state_abv\": \"NY\", \"country_abv\": \"US\", \"email\": \"ethan@test.com\", \"phone_primary\": \"6134698502\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Nieve\", \"last_name_emergency\": \"Burris\", \"phone_emergency\": \"5587500251\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-03 08:51:39\", \"primary_location\": 37}', '{\"id\": 67, \"first_name\": \"Ethan\", \"last_name\": \"Cintera\", \"middle_name\": null, \"preferred_name\": null, \"birth_date\": \"1995-12-05\", \"avatar_url\": \"/public/upload/profile/67-profile.jpeg\", \"street_address\": \"1500 Burns Place #90\", \"city\": \"Brooklyn\", \"zip\": 11238, \"state_abv\": \"NY\", \"country_abv\": \"US\", \"email\": \"ethan@test.com\", \"phone_primary\": \"6134698502\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Nieve\", \"last_name_emergency\": \"Burris\", \"phone_emergency\": \"5587500251\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-03 08:51:39\", \"primary_location\": 37}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:08:35'),
(161, 'I', 'passes', '23', NULL, '{\"id\": 23, \"user_id\": 78, \"is_active\": 0, \"pass_type\": \"E\", \"created_at\": \"2022-05-03 09:36:21\", \"active_on\": null, \"expires_on\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:36:21'),
(162, 'I', 'pass_line_items', '23-13', NULL, '{\"pass_id\": 23, \"gym_id\": 13, \"assigned\": 3, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:36:21'),
(163, 'I', 'pass_line_items', '23-14', NULL, '{\"pass_id\": 23, \"gym_id\": 14, \"assigned\": 3, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:36:21'),
(164, 'I', 'pass_line_items', '23-15', NULL, '{\"pass_id\": 23, \"gym_id\": 15, \"assigned\": 3, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:36:21'),
(165, 'I', 'pass_line_items', '23-16', NULL, '{\"pass_id\": 23, \"gym_id\": 16, \"assigned\": 3, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:36:21'),
(166, 'I', 'pass_line_items', '23-17', NULL, '{\"pass_id\": 23, \"gym_id\": 17, \"assigned\": 3, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:36:21'),
(167, 'I', 'pass_line_items', '23-18', NULL, '{\"pass_id\": 23, \"gym_id\": 18, \"assigned\": 3, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:36:21'),
(168, 'I', 'pass_line_items', '23-19', NULL, '{\"pass_id\": 23, \"gym_id\": 19, \"assigned\": 3, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:36:21'),
(169, 'I', 'pass_line_items', '23-20', NULL, '{\"pass_id\": 23, \"gym_id\": 20, \"assigned\": 3, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:36:21'),
(170, 'I', 'pass_line_items', '23-21', NULL, '{\"pass_id\": 23, \"gym_id\": 21, \"assigned\": 3, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:36:21'),
(171, 'I', 'pass_line_items', '23-22', NULL, '{\"pass_id\": 23, \"gym_id\": 22, \"assigned\": 3, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:36:21'),
(172, 'U', 'passes', '23', '{\"id\": 23, \"user_id\": 78, \"is_active\": 0, \"pass_type\": \"E\", \"created_at\": \"2022-05-03 09:36:21\", \"active_on\": null, \"expires_on\": null}', '{\"id\": 23, \"user_id\": 78, \"is_active\": 1, \"pass_type\": \"E\", \"created_at\": \"2022-05-03 09:36:21\", \"active_on\": \"2022-05-03\", \"expires_on\": \"2022-06-03\"}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:36:21'),
(173, 'I', 'passes', '24', NULL, '{\"id\": 24, \"user_id\": 79, \"is_active\": 0, \"pass_type\": \"D\", \"created_at\": \"2022-05-03 09:39:40\", \"active_on\": null, \"expires_on\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:39:40'),
(174, 'I', 'pass_line_items', '24-13', NULL, '{\"pass_id\": 24, \"gym_id\": 13, \"assigned\": 1, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:39:40'),
(175, 'I', 'pass_line_items', '24-14', NULL, '{\"pass_id\": 24, \"gym_id\": 14, \"assigned\": 1, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:39:40'),
(176, 'I', 'pass_line_items', '24-15', NULL, '{\"pass_id\": 24, \"gym_id\": 15, \"assigned\": 1, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:39:40'),
(177, 'I', 'pass_line_items', '24-16', NULL, '{\"pass_id\": 24, \"gym_id\": 16, \"assigned\": 1, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:39:40'),
(178, 'I', 'pass_line_items', '24-17', NULL, '{\"pass_id\": 24, \"gym_id\": 17, \"assigned\": 1, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:39:40'),
(179, 'I', 'pass_line_items', '24-18', NULL, '{\"pass_id\": 24, \"gym_id\": 18, \"assigned\": 1, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:39:40'),
(180, 'I', 'pass_line_items', '24-19', NULL, '{\"pass_id\": 24, \"gym_id\": 19, \"assigned\": 1, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:39:40'),
(181, 'I', 'pass_line_items', '24-20', NULL, '{\"pass_id\": 24, \"gym_id\": 20, \"assigned\": 1, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:39:40'),
(182, 'I', 'pass_line_items', '24-21', NULL, '{\"pass_id\": 24, \"gym_id\": 21, \"assigned\": 1, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:39:40'),
(183, 'I', 'pass_line_items', '24-22', NULL, '{\"pass_id\": 24, \"gym_id\": 22, \"assigned\": 1, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:39:40'),
(184, 'U', 'passes', '24', '{\"id\": 24, \"user_id\": 79, \"is_active\": 0, \"pass_type\": \"D\", \"created_at\": \"2022-05-03 09:39:40\", \"active_on\": null, \"expires_on\": null}', '{\"id\": 24, \"user_id\": 79, \"is_active\": 1, \"pass_type\": \"D\", \"created_at\": \"2022-05-03 09:39:40\", \"active_on\": \"2022-05-03\", \"expires_on\": \"2022-06-03\"}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:39:40'),
(185, 'I', 'passes', '25', NULL, '{\"id\": 25, \"user_id\": 80, \"is_active\": 0, \"pass_type\": \"D\", \"created_at\": \"2022-05-03 09:45:09\", \"active_on\": null, \"expires_on\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:45:09'),
(186, 'I', 'pass_line_items', '25-13', NULL, '{\"pass_id\": 25, \"gym_id\": 13, \"assigned\": 1, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:45:09'),
(187, 'I', 'pass_line_items', '25-14', NULL, '{\"pass_id\": 25, \"gym_id\": 14, \"assigned\": 1, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:45:09'),
(188, 'I', 'pass_line_items', '25-15', NULL, '{\"pass_id\": 25, \"gym_id\": 15, \"assigned\": 1, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:45:09'),
(189, 'I', 'pass_line_items', '25-16', NULL, '{\"pass_id\": 25, \"gym_id\": 16, \"assigned\": 1, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:45:09'),
(190, 'I', 'pass_line_items', '25-17', NULL, '{\"pass_id\": 25, \"gym_id\": 17, \"assigned\": 1, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:45:09'),
(191, 'I', 'pass_line_items', '25-18', NULL, '{\"pass_id\": 25, \"gym_id\": 18, \"assigned\": 1, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:45:09'),
(192, 'I', 'pass_line_items', '25-19', NULL, '{\"pass_id\": 25, \"gym_id\": 19, \"assigned\": 1, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:45:09'),
(193, 'I', 'pass_line_items', '25-20', NULL, '{\"pass_id\": 25, \"gym_id\": 20, \"assigned\": 1, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:45:09'),
(194, 'I', 'pass_line_items', '25-21', NULL, '{\"pass_id\": 25, \"gym_id\": 21, \"assigned\": 1, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:45:09'),
(195, 'I', 'pass_line_items', '25-22', NULL, '{\"pass_id\": 25, \"gym_id\": 22, \"assigned\": 1, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:45:09'),
(196, 'U', 'passes', '25', '{\"id\": 25, \"user_id\": 80, \"is_active\": 0, \"pass_type\": \"D\", \"created_at\": \"2022-05-03 09:45:09\", \"active_on\": null, \"expires_on\": null}', '{\"id\": 25, \"user_id\": 80, \"is_active\": 1, \"pass_type\": \"D\", \"created_at\": \"2022-05-03 09:45:09\", \"active_on\": \"2022-05-03\", \"expires_on\": \"2022-06-03\"}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:45:09'),
(197, 'I', 'passes', '26', NULL, '{\"id\": 26, \"user_id\": 82, \"is_active\": 0, \"pass_type\": \"E\", \"created_at\": \"2022-05-03 09:45:27\", \"active_on\": null, \"expires_on\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:45:27'),
(198, 'I', 'pass_line_items', '26-13', NULL, '{\"pass_id\": 26, \"gym_id\": 13, \"assigned\": 3, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:45:27'),
(199, 'I', 'pass_line_items', '26-14', NULL, '{\"pass_id\": 26, \"gym_id\": 14, \"assigned\": 3, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:45:27'),
(200, 'I', 'pass_line_items', '26-15', NULL, '{\"pass_id\": 26, \"gym_id\": 15, \"assigned\": 3, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:45:27'),
(201, 'I', 'pass_line_items', '26-16', NULL, '{\"pass_id\": 26, \"gym_id\": 16, \"assigned\": 3, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:45:27'),
(202, 'I', 'pass_line_items', '26-17', NULL, '{\"pass_id\": 26, \"gym_id\": 17, \"assigned\": 3, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:45:27'),
(203, 'I', 'pass_line_items', '26-18', NULL, '{\"pass_id\": 26, \"gym_id\": 18, \"assigned\": 3, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:45:27'),
(204, 'I', 'pass_line_items', '26-19', NULL, '{\"pass_id\": 26, \"gym_id\": 19, \"assigned\": 3, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:45:27'),
(205, 'I', 'pass_line_items', '26-20', NULL, '{\"pass_id\": 26, \"gym_id\": 20, \"assigned\": 3, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:45:27'),
(206, 'I', 'pass_line_items', '26-21', NULL, '{\"pass_id\": 26, \"gym_id\": 21, \"assigned\": 3, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:45:27'),
(207, 'I', 'pass_line_items', '26-22', NULL, '{\"pass_id\": 26, \"gym_id\": 22, \"assigned\": 3, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:45:27'),
(208, 'U', 'passes', '26', '{\"id\": 26, \"user_id\": 82, \"is_active\": 0, \"pass_type\": \"E\", \"created_at\": \"2022-05-03 09:45:27\", \"active_on\": null, \"expires_on\": null}', '{\"id\": 26, \"user_id\": 82, \"is_active\": 1, \"pass_type\": \"E\", \"created_at\": \"2022-05-03 09:45:27\", \"active_on\": \"2022-05-03\", \"expires_on\": \"2022-06-03\"}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:45:27'),
(209, 'I', 'passes', '27', NULL, '{\"id\": 27, \"user_id\": 83, \"is_active\": 0, \"pass_type\": \"E\", \"created_at\": \"2022-05-03 09:45:37\", \"active_on\": null, \"expires_on\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:45:37'),
(210, 'I', 'pass_line_items', '27-13', NULL, '{\"pass_id\": 27, \"gym_id\": 13, \"assigned\": 3, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:45:37'),
(211, 'I', 'pass_line_items', '27-14', NULL, '{\"pass_id\": 27, \"gym_id\": 14, \"assigned\": 3, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:45:37'),
(212, 'I', 'pass_line_items', '27-15', NULL, '{\"pass_id\": 27, \"gym_id\": 15, \"assigned\": 3, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:45:37'),
(213, 'I', 'pass_line_items', '27-16', NULL, '{\"pass_id\": 27, \"gym_id\": 16, \"assigned\": 3, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:45:37'),
(214, 'I', 'pass_line_items', '27-17', NULL, '{\"pass_id\": 27, \"gym_id\": 17, \"assigned\": 3, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:45:37'),
(215, 'I', 'pass_line_items', '27-18', NULL, '{\"pass_id\": 27, \"gym_id\": 18, \"assigned\": 3, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:45:37'),
(216, 'I', 'pass_line_items', '27-19', NULL, '{\"pass_id\": 27, \"gym_id\": 19, \"assigned\": 3, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:45:37'),
(217, 'I', 'pass_line_items', '27-20', NULL, '{\"pass_id\": 27, \"gym_id\": 20, \"assigned\": 3, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:45:37'),
(218, 'I', 'pass_line_items', '27-21', NULL, '{\"pass_id\": 27, \"gym_id\": 21, \"assigned\": 3, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:45:37'),
(219, 'I', 'pass_line_items', '27-22', NULL, '{\"pass_id\": 27, \"gym_id\": 22, \"assigned\": 3, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:45:37'),
(220, 'U', 'passes', '27', '{\"id\": 27, \"user_id\": 83, \"is_active\": 0, \"pass_type\": \"E\", \"created_at\": \"2022-05-03 09:45:37\", \"active_on\": null, \"expires_on\": null}', '{\"id\": 27, \"user_id\": 83, \"is_active\": 1, \"pass_type\": \"E\", \"created_at\": \"2022-05-03 09:45:37\", \"active_on\": \"2022-05-03\", \"expires_on\": \"2022-06-03\"}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:45:37'),
(221, 'I', 'passes', '28', NULL, '{\"id\": 28, \"user_id\": 85, \"is_active\": 0, \"pass_type\": \"F\", \"created_at\": \"2022-05-03 09:45:51\", \"active_on\": null, \"expires_on\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:45:51'),
(222, 'I', 'pass_line_items', '28-13', NULL, '{\"pass_id\": 28, \"gym_id\": 13, \"assigned\": 5, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:45:51'),
(223, 'I', 'pass_line_items', '28-14', NULL, '{\"pass_id\": 28, \"gym_id\": 14, \"assigned\": 5, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:45:51'),
(224, 'I', 'pass_line_items', '28-15', NULL, '{\"pass_id\": 28, \"gym_id\": 15, \"assigned\": 5, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:45:51'),
(225, 'I', 'pass_line_items', '28-16', NULL, '{\"pass_id\": 28, \"gym_id\": 16, \"assigned\": 5, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:45:51'),
(226, 'I', 'pass_line_items', '28-17', NULL, '{\"pass_id\": 28, \"gym_id\": 17, \"assigned\": 5, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:45:51'),
(227, 'I', 'pass_line_items', '28-18', NULL, '{\"pass_id\": 28, \"gym_id\": 18, \"assigned\": 5, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:45:51'),
(228, 'I', 'pass_line_items', '28-19', NULL, '{\"pass_id\": 28, \"gym_id\": 19, \"assigned\": 5, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:45:51'),
(229, 'I', 'pass_line_items', '28-20', NULL, '{\"pass_id\": 28, \"gym_id\": 20, \"assigned\": 5, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:45:51'),
(230, 'I', 'pass_line_items', '28-21', NULL, '{\"pass_id\": 28, \"gym_id\": 21, \"assigned\": 5, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:45:51'),
(231, 'I', 'pass_line_items', '28-22', NULL, '{\"pass_id\": 28, \"gym_id\": 22, \"assigned\": 5, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:45:51'),
(232, 'U', 'passes', '28', '{\"id\": 28, \"user_id\": 85, \"is_active\": 0, \"pass_type\": \"F\", \"created_at\": \"2022-05-03 09:45:51\", \"active_on\": null, \"expires_on\": null}', '{\"id\": 28, \"user_id\": 85, \"is_active\": 1, \"pass_type\": \"F\", \"created_at\": \"2022-05-03 09:45:51\", \"active_on\": \"2022-05-03\", \"expires_on\": \"2022-08-03\"}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:45:51'),
(233, 'I', 'passes', '29', NULL, '{\"id\": 29, \"user_id\": 86, \"is_active\": 0, \"pass_type\": \"F\", \"created_at\": \"2022-05-03 09:46:02\", \"active_on\": null, \"expires_on\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:46:02'),
(234, 'I', 'pass_line_items', '29-13', NULL, '{\"pass_id\": 29, \"gym_id\": 13, \"assigned\": 5, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:46:02'),
(235, 'I', 'pass_line_items', '29-14', NULL, '{\"pass_id\": 29, \"gym_id\": 14, \"assigned\": 5, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:46:02'),
(236, 'I', 'pass_line_items', '29-15', NULL, '{\"pass_id\": 29, \"gym_id\": 15, \"assigned\": 5, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:46:02'),
(237, 'I', 'pass_line_items', '29-16', NULL, '{\"pass_id\": 29, \"gym_id\": 16, \"assigned\": 5, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:46:02'),
(238, 'I', 'pass_line_items', '29-17', NULL, '{\"pass_id\": 29, \"gym_id\": 17, \"assigned\": 5, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:46:02'),
(239, 'I', 'pass_line_items', '29-18', NULL, '{\"pass_id\": 29, \"gym_id\": 18, \"assigned\": 5, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:46:02'),
(240, 'I', 'pass_line_items', '29-19', NULL, '{\"pass_id\": 29, \"gym_id\": 19, \"assigned\": 5, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:46:02'),
(241, 'I', 'pass_line_items', '29-20', NULL, '{\"pass_id\": 29, \"gym_id\": 20, \"assigned\": 5, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:46:02'),
(242, 'I', 'pass_line_items', '29-21', NULL, '{\"pass_id\": 29, \"gym_id\": 21, \"assigned\": 5, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:46:02'),
(243, 'I', 'pass_line_items', '29-22', NULL, '{\"pass_id\": 29, \"gym_id\": 22, \"assigned\": 5, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:46:02'),
(244, 'U', 'passes', '29', '{\"id\": 29, \"user_id\": 86, \"is_active\": 0, \"pass_type\": \"F\", \"created_at\": \"2022-05-03 09:46:02\", \"active_on\": null, \"expires_on\": null}', '{\"id\": 29, \"user_id\": 86, \"is_active\": 1, \"pass_type\": \"F\", \"created_at\": \"2022-05-03 09:46:02\", \"active_on\": \"2022-05-03\", \"expires_on\": \"2022-08-03\"}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:46:02'),
(245, 'U', 'pass_line_items', '24-13', '{\"pass_id\": 24, \"gym_id\": 13, \"assigned\": 1, \"used\": 0}', '{\"pass_id\": 24, \"gym_id\": 13, \"assigned\": 1, \"used\": 1}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:49:10'),
(246, 'U', 'pass_line_items', '24-14', '{\"pass_id\": 24, \"gym_id\": 14, \"assigned\": 1, \"used\": 0}', '{\"pass_id\": 24, \"gym_id\": 14, \"assigned\": 1, \"used\": 1}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:50:25'),
(247, 'U', 'pass_line_items', '24-14', '{\"pass_id\": 24, \"gym_id\": 14, \"assigned\": 1, \"used\": 1}', '{\"pass_id\": 24, \"gym_id\": 14, \"assigned\": 1, \"used\": 0}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:51:31'),
(248, 'U', 'pass_line_items', '25-15', '{\"pass_id\": 25, \"gym_id\": 15, \"assigned\": 1, \"used\": 0}', '{\"pass_id\": 25, \"gym_id\": 15, \"assigned\": 1, \"used\": 1}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:51:56'),
(249, 'U', 'pass_line_items', '27-15', '{\"pass_id\": 27, \"gym_id\": 15, \"assigned\": 3, \"used\": 0}', '{\"pass_id\": 27, \"gym_id\": 15, \"assigned\": 3, \"used\": 1}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:53:55'),
(250, 'U', 'pass_line_items', '29-15', '{\"pass_id\": 29, \"gym_id\": 15, \"assigned\": 5, \"used\": 0}', '{\"pass_id\": 29, \"gym_id\": 15, \"assigned\": 5, \"used\": 1}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:55:32'),
(251, 'U', 'pass_line_items', '28-15', '{\"pass_id\": 28, \"gym_id\": 15, \"assigned\": 5, \"used\": 0}', '{\"pass_id\": 28, \"gym_id\": 15, \"assigned\": 5, \"used\": 1}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 09:56:00'),
(252, 'U', 'pass_line_items', '26-15', '{\"pass_id\": 26, \"gym_id\": 15, \"assigned\": 3, \"used\": 0}', '{\"pass_id\": 26, \"gym_id\": 15, \"assigned\": 3, \"used\": 1}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 10:00:40'),
(253, 'U', 'locations', '33', '{\"id\": 33, \"gym_id\": 13, \"location_name\": \"Asheville\", \"street_address\": \"64 Amboy Road\", \"city\": \"Asheville\", \"zip\": 28806, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"phone_p_country\": 1, \"phone_primary\": \"8286465645\", \"photo_data\": null, \"capacity\": 120, \"employee_group\": null}', '{\"id\": 33, \"gym_id\": 13, \"location_name\": \"Asheville\", \"street_address\": \"64 Amboy Road\", \"city\": \"Asheville\", \"zip\": 28806, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"phone_p_country\": 1, \"phone_primary\": \"8286465645\", \"photo_data\": null, \"capacity\": 120, \"employee_group\": 60}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 10:11:35'),
(254, 'U', 'locations', '34', '{\"id\": 34, \"gym_id\": 13, \"location_name\": \"Raleigh\", \"street_address\": \"163 Granite Way\", \"city\": \"Raleigh\", \"zip\": 28706, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"phone_p_country\": 1, \"phone_primary\": \"9106153255\", \"photo_data\": null, \"capacity\": 150, \"employee_group\": null}', '{\"id\": 34, \"gym_id\": 13, \"location_name\": \"Raleigh\", \"street_address\": \"163 Granite Way\", \"city\": \"Raleigh\", \"zip\": 28706, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"phone_p_country\": 1, \"phone_primary\": \"9106153255\", \"photo_data\": null, \"capacity\": 150, \"employee_group\": 61}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 10:11:39'),
(255, 'U', 'locations', '35', '{\"id\": 35, \"gym_id\": 14, \"location_name\": \"Boulder\", \"street_address\": \"13 Gravity Park\", \"city\": \"Boulder\", \"zip\": 80302, \"state_abv\": \"CO\", \"country_abv\": \"US\", \"phone_p_country\": 1, \"phone_primary\": \"4665215486\", \"photo_data\": null, \"capacity\": 120, \"employee_group\": null}', '{\"id\": 35, \"gym_id\": 14, \"location_name\": \"Boulder\", \"street_address\": \"13 Gravity Park\", \"city\": \"Boulder\", \"zip\": 80302, \"state_abv\": \"CO\", \"country_abv\": \"US\", \"phone_p_country\": 1, \"phone_primary\": \"4665215486\", \"photo_data\": null, \"capacity\": 120, \"employee_group\": 62}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 10:11:43'),
(256, 'U', 'locations', '36', '{\"id\": 36, \"gym_id\": 14, \"location_name\": \"Fort Collins\", \"street_address\": \"1009 Cliff Court\", \"city\": \"Fort Collins\", \"zip\": 80522, \"state_abv\": \"CO\", \"country_abv\": \"US\", \"phone_p_country\": 1, \"phone_primary\": \"6468552136\", \"photo_data\": null, \"capacity\": 120, \"employee_group\": null}', '{\"id\": 36, \"gym_id\": 14, \"location_name\": \"Fort Collins\", \"street_address\": \"1009 Cliff Court\", \"city\": \"Fort Collins\", \"zip\": 80522, \"state_abv\": \"CO\", \"country_abv\": \"US\", \"phone_p_country\": 1, \"phone_primary\": \"6468552136\", \"photo_data\": null, \"capacity\": 120, \"employee_group\": 63}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 10:11:47'),
(257, 'U', 'locations', '37', '{\"id\": 37, \"gym_id\": 15, \"location_name\": \"New York\", \"street_address\": \"166 Market Street #30\", \"city\": \"Brooklyn\", \"zip\": 11238, \"state_abv\": \"NY\", \"country_abv\": \"US\", \"phone_p_country\": 1, \"phone_primary\": \"8965546215\", \"photo_data\": null, \"capacity\": 120, \"employee_group\": null}', '{\"id\": 37, \"gym_id\": 15, \"location_name\": \"New York\", \"street_address\": \"166 Market Street #30\", \"city\": \"Brooklyn\", \"zip\": 11238, \"state_abv\": \"NY\", \"country_abv\": \"US\", \"phone_p_country\": 1, \"phone_primary\": \"8965546215\", \"photo_data\": null, \"capacity\": 120, \"employee_group\": 64}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 10:11:56'),
(258, 'U', 'locations', '38', '{\"id\": 38, \"gym_id\": 17, \"location_name\": \"Los Angeles\", \"street_address\": \"6446 Crest Boulevard\", \"city\": \"Los Angeles\", \"zip\": 90003, \"state_abv\": \"CA\", \"country_abv\": \"US\", \"phone_p_country\": 1, \"phone_primary\": \"6165432215\", \"photo_data\": null, \"capacity\": 120, \"employee_group\": null}', '{\"id\": 38, \"gym_id\": 17, \"location_name\": \"Los Angeles\", \"street_address\": \"6446 Crest Boulevard\", \"city\": \"Los Angeles\", \"zip\": 90003, \"state_abv\": \"CA\", \"country_abv\": \"US\", \"phone_p_country\": 1, \"phone_primary\": \"6165432215\", \"photo_data\": null, \"capacity\": 120, \"employee_group\": 65}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 10:11:59'),
(259, 'U', 'users', '53', '{\"id\": 53, \"first_name\": \"Aaron\", \"last_name\": \"Novicek\", \"middle_name\": null, \"preferred_name\": null, \"birth_date\": \"1989-10-03\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"930 Greenlee Way\", \"city\": \"Asheville\", \"zip\": 28806, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"aaron@test.com\", \"phone_primary\": \"3236985530\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Alec\", \"last_name_emergency\": \"Novicek\", \"phone_emergency\": \"2026462252\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GM\", \"created_at\": \"2022-05-01 06:27:12\", \"primary_location\": 33}', '{\"id\": 53, \"first_name\": \"Aaron\", \"last_name\": \"Novicek\", \"middle_name\": null, \"preferred_name\": null, \"birth_date\": \"1989-10-03\", \"avatar_url\": \"/public/upload/profile/default.png\", \"street_address\": \"930 Greenlee Way\", \"city\": \"Asheville\", \"zip\": 28806, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"aaron@test.com\", \"phone_primary\": \"3236985530\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Alec\", \"last_name_emergency\": \"Novicek\", \"phone_emergency\": \"2026462252\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GM\", \"created_at\": \"2022-05-01 06:27:12\", \"primary_location\": 33}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 10:15:54'),
(260, 'U', 'users', '53', '{\"id\": 53, \"first_name\": \"Aaron\", \"last_name\": \"Novicek\", \"middle_name\": null, \"preferred_name\": null, \"birth_date\": \"1989-10-03\", \"avatar_url\": \"/public/upload/profile/default.png\", \"street_address\": \"930 Greenlee Way\", \"city\": \"Asheville\", \"zip\": 28806, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"aaron@test.com\", \"phone_primary\": \"3236985530\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Alec\", \"last_name_emergency\": \"Novicek\", \"phone_emergency\": \"2026462252\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GM\", \"created_at\": \"2022-05-01 06:27:12\", \"primary_location\": 33}', '{\"id\": 53, \"first_name\": \"Aaron\", \"last_name\": \"Novicek\", \"middle_name\": null, \"preferred_name\": null, \"birth_date\": \"1989-10-03\", \"avatar_url\": \"/public/upload/profile/default.png\", \"street_address\": \"930 Greenlee Way\", \"city\": \"Asheville\", \"zip\": 28806, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"aaron@test.com\", \"phone_primary\": \"3236985530\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Alec\", \"last_name_emergency\": \"Novicek\", \"phone_emergency\": \"2026462252\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GM\", \"created_at\": \"2022-05-01 06:27:12\", \"primary_location\": 33}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 10:17:43'),
(261, 'U', 'users', '53', '{\"id\": 53, \"first_name\": \"Aaron\", \"last_name\": \"Novicek\", \"middle_name\": null, \"preferred_name\": null, \"birth_date\": \"1989-10-03\", \"avatar_url\": \"/public/upload/profile/default.png\", \"street_address\": \"930 Greenlee Way\", \"city\": \"Asheville\", \"zip\": 28806, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"aaron@test.com\", \"phone_primary\": \"3236985530\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Alec\", \"last_name_emergency\": \"Novicek\", \"phone_emergency\": \"2026462252\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GM\", \"created_at\": \"2022-05-01 06:27:12\", \"primary_location\": 33}', '{\"id\": 53, \"first_name\": \"Aaron\", \"last_name\": \"Novicek\", \"middle_name\": null, \"preferred_name\": null, \"birth_date\": \"1989-10-03\", \"avatar_url\": \"/public/upload/profile/default.png\", \"street_address\": \"930 Greenlee Way\", \"city\": \"Asheville\", \"zip\": 28806, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"aaron@test.com\", \"phone_primary\": \"3236985530\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Alec\", \"last_name_emergency\": \"Novicek\", \"phone_emergency\": \"2026462252\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GM\", \"created_at\": \"2022-05-01 06:27:12\", \"primary_location\": 33}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 10:20:22');
INSERT INTO `audits` (`pk`, `type`, `table_name`, `record_id`, `old_values`, `new_values`, `applied_by`, `applied_on`) VALUES
(262, 'U', 'users', '53', '{\"id\": 53, \"first_name\": \"Aaron\", \"last_name\": \"Novicek\", \"middle_name\": null, \"preferred_name\": null, \"birth_date\": \"1989-10-03\", \"avatar_url\": \"/public/upload/profile/default.png\", \"street_address\": \"930 Greenlee Way\", \"city\": \"Asheville\", \"zip\": 28806, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"aaron@test.com\", \"phone_primary\": \"3236985530\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Alec\", \"last_name_emergency\": \"Novicek\", \"phone_emergency\": \"2026462252\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GM\", \"created_at\": \"2022-05-01 06:27:12\", \"primary_location\": 33}', '{\"id\": 53, \"first_name\": \"Aaron\", \"last_name\": \"Novicek\", \"middle_name\": null, \"preferred_name\": null, \"birth_date\": \"1989-10-03\", \"avatar_url\": \"/public/upload/profile/53-profile.jpeg\", \"street_address\": \"930 Greenlee Way\", \"city\": \"Asheville\", \"zip\": 28806, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"aaron@test.com\", \"phone_primary\": \"3236985530\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Alec\", \"last_name_emergency\": \"Novicek\", \"phone_emergency\": \"2026462252\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GM\", \"created_at\": \"2022-05-01 06:27:12\", \"primary_location\": 33}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 10:26:12'),
(263, 'U', 'users', '67', '{\"id\": 67, \"first_name\": \"Ethan\", \"last_name\": \"Cintera\", \"middle_name\": null, \"preferred_name\": null, \"birth_date\": \"1995-12-05\", \"avatar_url\": \"/public/upload/profile/67-profile.jpeg\", \"street_address\": \"1500 Burns Place #90\", \"city\": \"Brooklyn\", \"zip\": 11238, \"state_abv\": \"NY\", \"country_abv\": \"US\", \"email\": \"ethan@test.com\", \"phone_primary\": \"6134698502\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Nieve\", \"last_name_emergency\": \"Burris\", \"phone_emergency\": \"5587500251\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-03 08:51:39\", \"primary_location\": 37}', '{\"id\": 67, \"first_name\": \"Ethan\", \"last_name\": \"Cintera\", \"middle_name\": null, \"preferred_name\": null, \"birth_date\": \"1995-12-05\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\", \"street_address\": \"1500 Burns Place #90\", \"city\": \"Brooklyn\", \"zip\": 11238, \"state_abv\": \"NY\", \"country_abv\": \"US\", \"email\": \"ethan@test.com\", \"phone_primary\": \"6134698502\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Nieve\", \"last_name_emergency\": \"Burris\", \"phone_emergency\": \"5587500251\", \"phone_e_country\": 1, \"password_hash\": \"$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi\", \"access_abv\": \"GS\", \"created_at\": \"2022-05-03 10:26:53\", \"primary_location\": 37}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 10:26:53'),
(264, 'U', 'gyms', '15', '{\"id\": 15, \"gym_name\": \"Iron Mountain\", \"website\": \"https://www.iron-mountain.com\", \"avatar_url\": \"\\\"/public/upload/gym/default.png\\\"\"}', '{\"id\": 15, \"gym_name\": \"Iron Mountain\", \"website\": \"https://www.iron-mountain.com\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\"}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 10:39:37'),
(265, 'U', 'gyms', '15', '{\"id\": 15, \"gym_name\": \"Iron Mountain\", \"website\": \"https://www.iron-mountain.com\", \"avatar_url\": \"\\\"/public/upload/profile/default.png\\\"\"}', '{\"id\": 15, \"gym_name\": \"Iron Mountain\", \"website\": \"https://www.iron-mountain.com\", \"avatar_url\": \"\\\"/public/upload/gym/default.png\\\"\"}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 10:39:47'),
(266, 'U', 'users', '50', '{\"id\": 50, \"first_name\": \"James\", \"last_name\": \"Baker\", \"middle_name\": \"Robert\", \"preferred_name\": \"Jimmy\", \"birth_date\": \"1991-02-12\", \"avatar_url\": \"/public/upload/profile/default.png\", \"street_address\": \"PO Box 2012\", \"city\": \"Enka\", \"zip\": 28728, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"baker.jimmy@gmail.com\", \"phone_primary\": \"2526465221\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Caet\", \"last_name_emergency\": \"Cash\", \"phone_emergency\": \"8284507973\", \"phone_e_country\": 1, \"password_hash\": \"$2y$10$I/73J1RXodbvqQr7EcQfKeDUc3ORZz2TC5fQJtvqd5vhmgIuqp4Bu\", \"access_abv\": \"AA\", \"created_at\": \"2022-05-01 06:26:54\", \"primary_location\": 33}', '{\"id\": 50, \"first_name\": \"James\", \"last_name\": \"Baker\", \"middle_name\": null, \"preferred_name\": \"Jimmy\", \"birth_date\": \"1991-02-12\", \"avatar_url\": \"/public/upload/profile/50-profile.png\", \"street_address\": \"PO Box 2012\", \"city\": \"Enka\", \"zip\": 28728, \"state_abv\": \"NC\", \"country_abv\": \"US\", \"email\": \"baker.jimmy@gmail.com\", \"phone_primary\": \"2526465221\", \"phone_p_country\": 1, \"phone_secondary\": null, \"phone_s_country\": null, \"first_name_emergency\": \"Caet\", \"last_name_emergency\": \"Cash\", \"phone_emergency\": \"8284507973\", \"phone_e_country\": 1, \"password_hash\": \"$2y$10$I/73J1RXodbvqQr7EcQfKeDUc3ORZz2TC5fQJtvqd5vhmgIuqp4Bu\", \"access_abv\": \"AA\", \"created_at\": \"2022-05-01 06:26:54\", \"primary_location\": 33}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 10:54:39'),
(267, 'I', 'events', '12', NULL, '{\"id\": 12, \"start_date\": \"2022-05-05\", \"end_date\": \"2022-05-05\", \"location_id\": 33, \"event_name\": \"Cinco De Mayo\", \"participants\": 0, \"cost\": 0.00, \"url\": \"https://www.facebook.com\", \"photo_data\": \"\\\"/public/upload/event/default.png\\\"\", \"description\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 10:56:29'),
(268, 'U', 'events', '12', '{\"id\": 12, \"start_date\": \"2022-05-05\", \"end_date\": \"2022-05-05\", \"location_id\": 33, \"event_name\": \"Cinco De Mayo\", \"participants\": 0, \"cost\": 0.00, \"url\": \"https://www.facebook.com\", \"photo_data\": \"\\\"/public/upload/event/default.png\\\"\", \"description\": null}', '{\"id\": 12, \"start_date\": \"2022-05-05\", \"end_date\": \"2022-05-05\", \"location_id\": 33, \"event_name\": \"Cinco De Mayo\", \"participants\": 0, \"cost\": 0.00, \"url\": \"https://www.facebook.com\", \"photo_data\": \"/public/upload/event/default.png\", \"description\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 11:30:48'),
(269, 'I', 'events', '13', NULL, '{\"id\": 13, \"start_date\": \"2022-05-14\", \"end_date\": \"2022-05-15\", \"location_id\": 34, \"event_name\": \"Rock the Block\", \"participants\": 150, \"cost\": 25.00, \"url\": \"https://www.facebook.com\", \"photo_data\": \"\\\"/public/upload/event/default.png\\\"\", \"description\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 11:34:44'),
(270, 'I', 'events', '14', NULL, '{\"id\": 14, \"start_date\": \"2022-05-27\", \"end_date\": \"2022-05-27\", \"location_id\": 37, \"event_name\": \"Friday Night Flash Fest\", \"participants\": 200, \"cost\": 60.00, \"url\": \"https://www.facebook.com\", \"photo_data\": \"\\\"/public/upload/event/default.png\\\"\", \"description\": null}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 11:36:29'),
(271, 'U', 'events', '12', '{\"id\": 12, \"start_date\": \"2022-05-05\", \"end_date\": \"2022-05-05\", \"location_id\": 33, \"event_name\": \"Cinco De Mayo\", \"participants\": 0, \"cost\": 0.00, \"url\": \"https://www.facebook.com\", \"photo_data\": \"/public/upload/event/default.png\", \"description\": null}', '{\"id\": 12, \"start_date\": \"2022-05-05\", \"end_date\": \"2022-05-05\", \"location_id\": 33, \"event_name\": \"Cinco De Mayo\", \"participants\": 0, \"cost\": 0.00, \"url\": \"https://www.facebook.com\", \"photo_data\": \"/public/upload/event/default.png\", \"description\": \"Join us for the festivities this Cinco de Mayo. Juanita\'s Taco Truck will be here all afternoon serving up refreshments.\"}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 11:42:08'),
(272, 'U', 'events', '13', '{\"id\": 13, \"start_date\": \"2022-05-14\", \"end_date\": \"2022-05-15\", \"location_id\": 34, \"event_name\": \"Rock the Block\", \"participants\": 150, \"cost\": 25.00, \"url\": \"https://www.facebook.com\", \"photo_data\": \"\\\"/public/upload/event/default.png\\\"\", \"description\": null}', '{\"id\": 13, \"start_date\": \"2022-05-14\", \"end_date\": \"2022-05-15\", \"location_id\": 34, \"event_name\": \"Rock the Block\", \"participants\": 150, \"cost\": 25.00, \"url\": \"https://www.facebook.com\", \"photo_data\": \"/public/upload/event/default.png\", \"description\": \"This 2 day climbing festival is a USAAC-qualifying event. The finale on Saturday takes place on our outdoor bouldering wall and features live music and a block party!\"}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 11:44:13'),
(273, 'U', 'events', '14', '{\"id\": 14, \"start_date\": \"2022-05-27\", \"end_date\": \"2022-05-27\", \"location_id\": 37, \"event_name\": \"Friday Night Flash Fest\", \"participants\": 200, \"cost\": 60.00, \"url\": \"https://www.facebook.com\", \"photo_data\": \"\\\"/public/upload/event/default.png\\\"\", \"description\": null}', '{\"id\": 14, \"start_date\": \"2022-05-27\", \"end_date\": \"2022-05-27\", \"location_id\": 37, \"event_name\": \"Friday Night Flash Fest\", \"participants\": 200, \"cost\": 60.00, \"url\": \"https://www.facebook.com\", \"photo_data\": \"/public/upload/event/default.png\", \"description\": \"This 24-hour climbing competition is all about who can cover the most group. Grab a partner and some coffee and go for the gold!\"}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 11:49:02'),
(274, 'I', 'events', '15', NULL, '{\"id\": 15, \"start_date\": \"2022-06-10\", \"end_date\": \"2022-06-10\", \"location_id\": 38, \"event_name\": \"Tenth Anniversary Celebration\", \"participants\": 999, \"cost\": 0.00, \"url\": \"https://www.facebook.com\", \"photo_data\": \"\\\"/public/upload/event/default.png\\\"\", \"description\": \"Join Xperia as we celebrate our 10th anniversary! We\'ll be hosting a raffle to benefit the SoCal Climbers Coalition, with tons of prizes from 5.10.\"}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 11:54:19'),
(275, 'I', 'events', '16', NULL, '{\"id\": 16, \"start_date\": \"2022-06-19\", \"end_date\": \"2022-06-25\", \"location_id\": 33, \"event_name\": \"Outdoor Service Week\", \"participants\": 999, \"cost\": 0.00, \"url\": \"https://www.facebook.com\", \"photo_data\": \"\\\"/public/upload/event/default.png\\\"\", \"description\": \"Help Rock City give back! We\'ve got a ton of trail days in partnership with the Access Fund as well as a Carrier Park cleanup with GreenWorks. Free climbing for all volunteers!!\"}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 11:56:16'),
(276, 'U', 'gyms', '13', '{\"id\": 13, \"gym_name\": \"Rock City\", \"website\": \"https://www.rockcity.com\", \"avatar_url\": \"\\\"/public/upload/gym/default.png\\\"\"}', '{\"id\": 13, \"gym_name\": \"Rock City\", \"website\": \"https://www.rockcity.com\", \"avatar_url\": \"/public/upload/gym/default.png\"}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 12:02:10'),
(277, 'U', 'gyms', '14', '{\"id\": 14, \"gym_name\": \"The Summit\", \"website\": \"https://www.summitgym.com\", \"avatar_url\": \"\\\"/public/upload/gym/default.png\\\"\"}', '{\"id\": 14, \"gym_name\": \"The Summit\", \"website\": \"https://www.summitgym.com\", \"avatar_url\": \"/public/upload/gym/default.png\"}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 12:02:14'),
(278, 'U', 'gyms', '15', '{\"id\": 15, \"gym_name\": \"Iron Mountain\", \"website\": \"https://www.iron-mountain.com\", \"avatar_url\": \"\\\"/public/upload/gym/default.png\\\"\"}', '{\"id\": 15, \"gym_name\": \"Iron Mountain\", \"website\": \"https://www.iron-mountain.com\", \"avatar_url\": \"/public/upload/gym/default.png\"}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 12:02:16'),
(279, 'U', 'gyms', '16', '{\"id\": 16, \"gym_name\": \"ClimbWorks\", \"website\": \"https://www.climbworks.com\", \"avatar_url\": \"\\\"/public/upload/gym/default.png\\\"\"}', '{\"id\": 16, \"gym_name\": \"ClimbWorks\", \"website\": \"https://www.climbworks.com\", \"avatar_url\": \"/public/upload/gym/default.png\"}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 12:02:24'),
(280, 'U', 'gyms', '17', '{\"id\": 17, \"gym_name\": \"Xperia\", \"website\": \"https://www.xperia.com\", \"avatar_url\": \"\\\"/public/upload/gym/default.png\\\"\"}', '{\"id\": 17, \"gym_name\": \"Xperia\", \"website\": \"https://www.xperia.com\", \"avatar_url\": \"/public/upload/gym/default.png\"}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 12:02:27'),
(281, 'U', 'gyms', '18', '{\"id\": 18, \"gym_name\": \"Area 42\", \"website\": \"https://www.area42.com\", \"avatar_url\": \"\\\"/public/upload/gym/default.png\\\"\"}', '{\"id\": 18, \"gym_name\": \"Area 42\", \"website\": \"https://www.area42.com\", \"avatar_url\": \"/public/upload/gym/default.png\"}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 12:02:36'),
(282, 'U', 'gyms', '19', '{\"id\": 19, \"gym_name\": \"The Hangar\", \"website\": \"https://www.hangarclimbing.com\", \"avatar_url\": \"\\\"/public/upload/gym/default.png\\\"\"}', '{\"id\": 19, \"gym_name\": \"The Hangar\", \"website\": \"https://www.hangarclimbing.com\", \"avatar_url\": \"/public/upload/gym/default.png\"}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 12:02:41'),
(283, 'U', 'gyms', '20', '{\"id\": 20, \"gym_name\": \"Keystone\", \"website\": \"https://www.keystonegym.com\", \"avatar_url\": \"\\\"/public/upload/gym/default.png\\\"\"}', '{\"id\": 20, \"gym_name\": \"Keystone\", \"website\": \"https://www.keystonegym.com\", \"avatar_url\": \"/public/upload/gym/default.png\"}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 12:02:45'),
(284, 'U', 'gyms', '21', '{\"id\": 21, \"gym_name\": \"Ascension\", \"website\": \"https://www.ascension.com\", \"avatar_url\": \"\\\"/public/upload/gym/default.png\\\"\"}', '{\"id\": 21, \"gym_name\": \"Ascension\", \"website\": \"https://www.ascension.com\", \"avatar_url\": \"/public/upload/gym/default.png\"}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 12:02:48'),
(285, 'U', 'gyms', '22', '{\"id\": 22, \"gym_name\": \"IBEX\", \"website\": \"https://www.ibexwa.com\", \"avatar_url\": \"\\\"/public/upload/gym/default.png\\\"\"}', '{\"id\": 22, \"gym_name\": \"IBEX\", \"website\": \"https://www.ibexwa.com\", \"avatar_url\": \"/public/upload/gym/default.png\"}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 12:02:50'),
(286, 'U', 'gyms', '13', '{\"id\": 13, \"gym_name\": \"Rock City\", \"website\": \"https://www.rockcity.com\", \"avatar_url\": \"/public/upload/gym/default.png\"}', '{\"id\": 13, \"gym_name\": \"Rock City\", \"website\": \"https://www.rockcity.com\", \"avatar_url\": \"/public/upload/gym/default.png\"}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 12:03:54'),
(287, 'U', 'gyms', '13', '{\"id\": 13, \"gym_name\": \"Rock City\", \"website\": \"https://www.rockcity.com\", \"avatar_url\": \"/public/upload/gym/default.png\"}', '{\"id\": 13, \"gym_name\": \"Rock City\", \"website\": \"https://www.rockcity.com\", \"avatar_url\": \"/public/upload/gym/13-gym.png\"}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 12:17:55'),
(288, 'U', 'gyms', '14', '{\"id\": 14, \"gym_name\": \"The Summit\", \"website\": \"https://www.summitgym.com\", \"avatar_url\": \"/public/upload/gym/default.png\"}', '{\"id\": 14, \"gym_name\": \"The Summit\", \"website\": \"https://www.summitgym.com\", \"avatar_url\": \"/public/upload/gym/14-gym.png\"}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 12:18:12'),
(289, 'U', 'gyms', '16', '{\"id\": 16, \"gym_name\": \"ClimbWorks\", \"website\": \"https://www.climbworks.com\", \"avatar_url\": \"/public/upload/gym/default.png\"}', '{\"id\": 16, \"gym_name\": \"ClimbWorks\", \"website\": \"https://www.climbworks.com\", \"avatar_url\": \"/public/upload/gym/16-gym.png\"}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 12:18:33'),
(290, 'U', 'gyms', '17', '{\"id\": 17, \"gym_name\": \"Xperia\", \"website\": \"https://www.xperia.com\", \"avatar_url\": \"/public/upload/gym/default.png\"}', '{\"id\": 17, \"gym_name\": \"Xperia\", \"website\": \"https://www.xperia.com\", \"avatar_url\": \"/public/upload/gym/17-gym.png\"}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 12:18:58'),
(291, 'U', 'gyms', '18', '{\"id\": 18, \"gym_name\": \"Area 42\", \"website\": \"https://www.area42.com\", \"avatar_url\": \"/public/upload/gym/default.png\"}', '{\"id\": 18, \"gym_name\": \"Area 42\", \"website\": \"https://www.area42.com\", \"avatar_url\": \"/public/upload/gym/default.png\"}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 12:20:29'),
(292, 'U', 'gyms', '18', '{\"id\": 18, \"gym_name\": \"Area 42\", \"website\": \"https://www.area42.com\", \"avatar_url\": \"/public/upload/gym/default.png\"}', '{\"id\": 18, \"gym_name\": \"Area 42\", \"website\": \"https://www.area42.com\", \"avatar_url\": \"/public/upload/gym/18-gym.png\"}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 12:20:41'),
(293, 'U', 'gyms', '19', '{\"id\": 19, \"gym_name\": \"The Hangar\", \"website\": \"https://www.hangarclimbing.com\", \"avatar_url\": \"/public/upload/gym/default.png\"}', '{\"id\": 19, \"gym_name\": \"The Hangar\", \"website\": \"https://www.hangarclimbing.com\", \"avatar_url\": \"/public/upload/gym/19-gym.png\"}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 12:20:59'),
(294, 'U', 'gyms', '20', '{\"id\": 20, \"gym_name\": \"Keystone\", \"website\": \"https://www.keystonegym.com\", \"avatar_url\": \"/public/upload/gym/default.png\"}', '{\"id\": 20, \"gym_name\": \"Keystone\", \"website\": \"https://www.keystonegym.com\", \"avatar_url\": \"/public/upload/gym/20-gym.png\"}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 12:21:20'),
(295, 'U', 'gyms', '21', '{\"id\": 21, \"gym_name\": \"Ascension\", \"website\": \"https://www.ascension.com\", \"avatar_url\": \"/public/upload/gym/default.png\"}', '{\"id\": 21, \"gym_name\": \"Ascension\", \"website\": \"https://www.ascension.com\", \"avatar_url\": \"/public/upload/gym/21-gym.png\"}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 12:21:40'),
(296, 'U', 'gyms', '22', '{\"id\": 22, \"gym_name\": \"IBEX\", \"website\": \"https://www.ibexwa.com\", \"avatar_url\": \"/public/upload/gym/default.png\"}', '{\"id\": 22, \"gym_name\": \"IBEX\", \"website\": \"https://www.ibexwa.com\", \"avatar_url\": \"/public/upload/gym/22-gym.png\"}', 'u308745100_bakerdtk@127.0.0.1', '2022-05-03 12:21:59');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries` (
  `abv` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_prefix` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`abv`, `country_name`, `country_prefix`) VALUES
('AD', 'Andorra', '+376'),
('AE', 'United Arab Emirates', '+971'),
('AF', 'Afghanistan', '+93'),
('AG', 'Antigua and Barbuda', '+1'),
('AI', 'Anguilla', '+1'),
('AL', 'Albania', '+355'),
('AM', 'Armenia', '+374'),
('AO', 'Angola', '+244'),
('AQ', 'Antarctica', '+672'),
('AR', 'Argentina', '+54'),
('AS', 'American Samoa', '+1'),
('AT', 'Austria', '+43'),
('AU', 'Australia', '+61'),
('AW', 'Aruba', '+297'),
('AZ', 'Azerbaijan', '+994'),
('BA', 'Bosnia and Herzegovina', '+387'),
('BB', 'Barbados', '+246'),
('BD', 'Bangladesh', '+880'),
('BE', 'Belgium', '+32'),
('BF', 'Burkina Faso', '+226'),
('BG', 'Bulgaria', '+359'),
('BH', 'Bahrain', '+973'),
('BI', 'Burundi', '+257'),
('BJ', 'Benin', '+229'),
('BL', 'Saint Barthelemy', '+590'),
('BM', 'Bermuda', '+1'),
('BN', 'Brunei Darussalam', '+673'),
('BO', 'Bolivia', '+591'),
('BR', 'Brazil', '+55'),
('BS', 'Bahamas', '+1'),
('BT', 'Bhutan', '+975'),
('BW', 'Botswana', '+267'),
('BY', 'Belarus', '+375'),
('BZ', 'Belize', '+501'),
('CA', 'Canada', '+1'),
('CC', 'Cocos Islands', '+61'),
('CD', 'Congo, Democratic Republic of the', '+243'),
('CF', 'Central African Republic', '+236'),
('CG', 'Congo', '+242'),
('CH', 'Switzerland', '+41'),
('CI', 'Ivory Coast', '+225'),
('CK', 'Cook Islands', '+682'),
('CL', 'Chile', '+56'),
('CM', 'Cameroon', '+237'),
('CN', 'China', '+86'),
('CO', 'Colombia', '+57'),
('CR', 'Costa Rica', '+506'),
('CU', 'Cuba', '+53'),
('CV', 'Cabo Verde', '+238'),
('CW', 'Curacao', '+599'),
('CX', 'Christmas Island', '+61'),
('CY', 'Cyprus', '+357'),
('CZ', 'Czechia', '+470'),
('DE', 'Germany', '+49'),
('DJ', 'Djibouti', '+253'),
('DK', 'Denmark', '+45'),
('DO', 'Dominican Republic', '+1'),
('DZ', 'Algeria', '+213'),
('EC', 'Ecuador', '+593'),
('EE', 'Estonia', '+372'),
('EG', 'Egypt', '+20'),
('EH', 'Western Sahara', '+212'),
('ER', 'Eritrea', '+291'),
('ES', 'Spain', '+34'),
('ET', 'Ethiopia', '+251'),
('FI', 'Finland', '+358'),
('FJ', 'Fiji', '+679'),
('FK', 'Falkland Islands', '+500'),
('FM', 'Micronesia', '+691'),
('FO', 'Faroe Islands', '+298'),
('FR', 'France', '+33'),
('GB', 'Great Britain', '+44'),
('GD', 'Grenada', '+1'),
('GE', 'Georgia', '+995'),
('GG', 'Guernsey', '+44'),
('GH', 'Ghana', '+233'),
('GI', 'Gibraltar', '+350'),
('GL', 'Greenland', '+299'),
('GM', 'Gambia', '+220'),
('GN', 'Guinea', '+224'),
('GQ', 'Equatorial Guinea', '+240'),
('GR', 'Greece', '+30'),
('GT', 'Guatemala', '+502'),
('GU', 'Guam', '+1'),
('GW', 'Guinea-Bissau', '+245'),
('GY', 'Guyana', '+592'),
('HK', 'Hong Kong', '+852'),
('HN', 'Honduras', '+504'),
('HR', 'Croatia', '+385'),
('HT', 'Haiti', '+509'),
('HU', 'Hungary', '+36'),
('ID', 'Indonesia', '+62'),
('IE', 'Ireland', '+353'),
('IL', 'Israel', '+972'),
('IM', 'Isle of Man', '+44'),
('IN', 'India', '+91'),
('IO', 'British Indian Ocean Territory', '+246'),
('IQ', 'Iraq', '+964'),
('IR', 'Iran', '+98'),
('IS', 'Iceland', '+354'),
('IT', 'Italy', '+39'),
('JE', 'Jersey', '+44'),
('JM', 'Jamaica', '+1'),
('JO', 'Jordan', '+962'),
('JP', 'Japan', '+81'),
('KE', 'Kenya', '+254'),
('KG', 'Kyrgyzstan', '+996'),
('KH', 'Cambodia', '+855'),
('KI', 'Kiribati', '+686'),
('KM', 'Comoros', '+269'),
('KN', 'Saint Kitts and Nevis', '+1'),
('KP', 'Korea (Democratic Peoples Republic of)', '+850'),
('KR', 'Korea, Republic of', '+82'),
('KW', 'Kuwait', '+965'),
('KY', 'Cayman Islands', '+1'),
('KZ', 'Kazakhstan', '+7'),
('LA', 'Lao Peoples Democratic Republic', '+856'),
('LB', 'Lebanon', '+961'),
('LC', 'Saint Lucia', '+1'),
('LI', 'Liechtenstein', '+423'),
('LK', 'Sri Lanka', '+94'),
('LR', 'Liberia', '+231'),
('LS', 'Lesotho', '+266'),
('LT', 'Lithuania', '+370'),
('LU', 'Luxembourg', '+352'),
('LV', 'Latvia', '+371'),
('LY', 'Libya', '+218'),
('MA', 'Morocco', '+212'),
('MC', 'Monaco', '+377'),
('MD', 'Moldova, Republic of', '+373'),
('ME', 'Montenegro', '+382'),
('MF', 'Saint Martin', '+590'),
('MG', 'Madagascar', '+261'),
('MH', 'Marshall Islands', '+692'),
('MK', 'North Macedonia', '+389'),
('ML', 'Mali', '+223'),
('MM', 'Myanmar', '+95'),
('MN', 'Mongolia', '+976'),
('MO', 'Macao', '+853'),
('MP', 'Northern Mariana Islands', '+1'),
('MQ', 'Martinique', '+1'),
('MR', 'Mauritania', '+222'),
('MS', 'Montserrat', '+1'),
('MT', 'Malta', '+356'),
('MU', 'Mauritius', '+230'),
('MV', 'Maldives', '+960'),
('MW', 'Malawi', '+265'),
('MX', 'Mexico', '+52'),
('MY', 'Malaysia', '+60'),
('MZ', 'Mozambique', '+258'),
('NA', 'Namibia', '+264'),
('NC', 'New Caledonia', '+687'),
('NE', 'Niger', '+227'),
('NG', 'Nigeria', '+234'),
('NI', 'Nicaragua', '+505'),
('NL', 'Netherlands', '+31'),
('NO', 'Norway', '+47'),
('NP', 'Nepal', '+977'),
('NR', 'Nauru', '+674'),
('NU', 'Niue', '+683'),
('NZ', 'New Zealand', '+64'),
('OM', 'Oman', '+968'),
('PA', 'Panama', '+507'),
('PE', 'Peru', '+51'),
('PF', 'French Polynesia', '+689'),
('PG', 'Papa New Guinea', '+675'),
('PH', 'Philippines', '+63'),
('PK', 'Pakistan', '+92'),
('PL', 'Poland', '+48'),
('PM', 'Saint Pierre and Miquelon', '+508'),
('PN', 'Pitcairn', '+64'),
('PR', 'Puerto Rico', '+1'),
('PS', 'Palestine, State of', '+970'),
('PT', 'Portugal', '+351'),
('PW', 'Palau', '+680'),
('PY', 'Paraguay', '+595'),
('QA', 'Qatar', '+974'),
('RE', 'Reunion', '+262'),
('RO', 'Romania', '+40'),
('RS', 'Serbia', '+381'),
('RU', 'Russian Federation', '+7'),
('RW', 'Rwanda', '+250'),
('SA', 'Saudi Arabia', '+966'),
('SB', 'Solomon Islands', '+677'),
('SC', 'Seychelles', '+248'),
('SD', 'Sudan', '+249'),
('SE', 'Sweden', '+46'),
('SG', 'Singapore', '+65'),
('SH', 'Saint Helenda, Ascension and Tristan da Cunha', '+290'),
('SI', 'Slovenia', '+386'),
('SJ', 'Svalbard and Jan Mayen', '+47'),
('SK', 'Slovakia', '+421'),
('SL', 'Sierra Leone', '+232'),
('SM', 'San Marino', '+378'),
('SN', 'Senegal', '+221'),
('SO', 'Somalia', '+252'),
('SR', 'Suriname', '+597'),
('SS', 'South Sudan', '+211'),
('ST', 'Sao Tome and Principe', '+239'),
('SV', 'El Salvador', '+503'),
('SX', 'Sint Maarten', '+1'),
('SY', 'Syrian Arab Republic', '+963'),
('SZ', 'Eswatini', '+268'),
('TC', 'Turks and Caicos Islands', '+1'),
('TD', 'Chad', '+235'),
('TG', 'Togo', '+228'),
('TH', 'Thailand', '+66'),
('TJ', 'Tajikistan', '+992'),
('TK', 'Tokelau', '+690'),
('TL', 'Timor-Leste', '+670'),
('TM', 'Turkmenistan', '+993'),
('TN', 'Tunisia', '+216'),
('TO', 'Tonga', '+676'),
('TR', 'Turkey', '+90'),
('TT', 'Trinidad and Tobago', '+1'),
('TV', 'Tuvalu', '+688'),
('TW', 'Taiwan', '+886'),
('TZ', 'Tanzania, United Republic of', '+255'),
('UA', 'Ukraine', '+380'),
('UG', 'Uganda', '+356'),
('UM', 'United States Minor Outlying Islands', '+1'),
('US', 'United States', '+1'),
('UY', 'Uruguay', '+598'),
('UZ', 'Uzbekistan', '+998'),
('VA', 'Holy See', '+379'),
('VC', 'Saint Vincent and the Grenadines', '+1'),
('VE', 'Venezuela', '+58'),
('VG', 'Virgin Islands (British)', '+1'),
('VI', 'Virgin Islands (U.S.))', '+1'),
('VN', 'Viet Nam', '+84'),
('VU', 'Vanuatu', '+678'),
('WF', 'Wallis and Futuna', '+681'),
('WS', 'Samoa', '+685'),
('YE', 'Yemen', '+967'),
('YT', 'Mayotte', '+262'),
('ZA', 'South Africa', '+27'),
('ZM', 'Zambia', '+260'),
('ZW', 'Zimbabwe', '+263');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `location_id` smallint(4) DEFAULT NULL,
  `event_name` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `participants` smallint(3) NOT NULL DEFAULT 999,
  `cost` decimal(5,2) NOT NULL DEFAULT 0.00,
  `url` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '"/public/upload/event/default.png"',
  `description` tinytext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `start_date`, `end_date`, `location_id`, `event_name`, `participants`, `cost`, `url`, `photo_data`, `description`) VALUES
(12, '2022-05-05', '2022-05-05', 33, 'Cinco De Mayo', 0, '0.00', 'https://www.facebook.com', '/public/upload/event/default.png', 'Join us for the festivities this Cinco de Mayo. Juanita\'s Taco Truck will be here all afternoon serving up refreshments.'),
(13, '2022-05-14', '2022-05-15', 34, 'Rock the Block', 150, '25.00', 'https://www.facebook.com', '/public/upload/event/default.png', 'This 2 day climbing festival is a USAAC-qualifying event. The finale on Saturday takes place on our outdoor bouldering wall and features live music and a block party!'),
(14, '2022-05-27', '2022-05-27', 37, 'Friday Night Flash Fest', 200, '60.00', 'https://www.facebook.com', '/public/upload/event/default.png', 'This 24-hour climbing competition is all about who can cover the most group. Grab a partner and some coffee and go for the gold!'),
(15, '2022-06-10', '2022-06-10', 38, 'Tenth Anniversary Celebration', 999, '0.00', 'https://www.facebook.com', '\"/public/upload/event/default.png\"', 'Join Xperia as we celebrate our 10th anniversary! We\'ll be hosting a raffle to benefit the SoCal Climbers Coalition, with tons of prizes from 5.10.'),
(16, '2022-06-19', '2022-06-25', 33, 'Outdoor Service Week', 999, '0.00', 'https://www.facebook.com', '\"/public/upload/event/default.png\"', 'Help Rock City give back! We\'ve got a ton of trail days in partnership with the Access Fund as well as a Carrier Park cleanup with GreenWorks. Free climbing for all volunteers!!');

--
-- Triggers `events`
--
DROP TRIGGER IF EXISTS `tr_delete_events_audits`;
DELIMITER $$
CREATE TRIGGER `tr_delete_events_audits` AFTER DELETE ON `events` FOR EACH ROW INSERT INTO `audits` (
		type,
		table_name,
		record_id,
		old_values,
		new_values,
		applied_by,
		applied_on
	)
	VALUES(
		'D',
		'events',
		OLD.id,
		JSON_OBJECT(
			"id", OLD.id,
			"start_date", OLD.start_date,
			"end_date", OLD.end_date,
			"location_id", OLD.location_id,
			"event_name", OLD.event_name,
			"participants", OLD.participants,
			"cost", OLD.cost,
			"url", OLD.url,
			"photo_data", OLD.photo_data,
            "description", OLD.description
		),
		NULL,
		CURRENT_USER,
		CURRENT_TIMESTAMP
	)
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `tr_insert_events_audits`;
DELIMITER $$
CREATE TRIGGER `tr_insert_events_audits` AFTER INSERT ON `events` FOR EACH ROW INSERT INTO `audits` (
		type,
		table_name,
		record_id,
		old_values,
		new_values,
		applied_by,
		applied_on
	)
	VALUES(
		'I',
		'events',
		NEW.id,
		NULL,
		JSON_OBJECT(
			"id", NEW.id,
			"start_date", NEW.start_date,
			"end_date", NEW.end_date,
			"location_id", NEW.location_id,
			"event_name", NEW.event_name,
			"participants", NEW.participants,
			"cost", NEW.cost,
			"url", NEW.url,
			"photo_data", NEW.photo_data,
            "description", NEW.description
		),
		CURRENT_USER,
		CURRENT_TIMESTAMP
	)
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `tr_update_events_audits`;
DELIMITER $$
CREATE TRIGGER `tr_update_events_audits` AFTER UPDATE ON `events` FOR EACH ROW INSERT INTO `audits` (
		type,
		table_name,
		record_id,
		old_values,
		new_values,
		applied_by,
		applied_on
	)
	VALUES(
		'U',
		'events',
		NEW.id,
		JSON_OBJECT(
			"id", OLD.id,
			"start_date", OLD.start_date,
			"end_date", OLD.end_date,
			"location_id", OLD.location_id,
			"event_name", OLD.event_name,
			"participants", OLD.participants,
			"cost", OLD.cost,
			"url", OLD.url,
			"photo_data", OLD.photo_data,
            "description", OLD.description
		),
		JSON_OBJECT(
			"id", NEW.id,
			"start_date", NEW.start_date,
			"end_date", NEW.end_date,
			"location_id", NEW.location_id,
			"event_name", NEW.event_name,
			"participants", NEW.participants,
			"cost", NEW.cost,
			"url", NEW.url,
			"photo_data", NEW.photo_data,
            "description", NEW.description
		),
		CURRENT_USER,
		CURRENT_TIMESTAMP
	)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` mediumint(6) NOT NULL,
  `owner_id` int(8) NOT NULL,
  `type_abv` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `owner_id`, `type_abv`, `name`) VALUES
(53, 50, 'AG', 'Super Administrators'),
(54, 53, 'MG', 'Rock City Asheville Managers'),
(55, 54, 'MG', 'Rock City Raleigh Managers'),
(56, 55, 'MG', 'Summit Boulder Managers'),
(57, 56, 'MG', 'Summit Fort Collins Managers'),
(58, 57, 'MG', 'Iron Mountain NY Managers'),
(59, 58, 'MG', 'Xperia LA Managers'),
(60, 53, 'GG', 'Rock City Asheville Staff'),
(61, 54, 'GG', 'Rock City Raleigh Staff'),
(62, 55, 'GG', 'Summit Denver Staff'),
(63, 56, 'GG', 'Summit Fort Collins Staff'),
(64, 57, 'GG', 'Iron Mountain NY Staff'),
(65, 58, 'GG', 'Xperia LA Staff');

-- --------------------------------------------------------

--
-- Table structure for table `group_permissions`
--

DROP TABLE IF EXISTS `group_permissions`;
CREATE TABLE `group_permissions` (
  `group_id` mediumint(6) NOT NULL,
  `location_id` smallint(4) NOT NULL,
  `permission_abv` char(2) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `group_permissions`
--

INSERT INTO `group_permissions` (`group_id`, `location_id`, `permission_abv`) VALUES
(53, 33, 'XC'),
(53, 34, 'XC'),
(53, 35, 'XC'),
(53, 36, 'XC'),
(53, 37, 'XC'),
(53, 38, 'XC'),
(53, 39, 'XC'),
(53, 40, 'XC'),
(53, 41, 'XC'),
(53, 42, 'XC'),
(53, 43, 'XC'),
(53, 44, 'XC'),
(53, 45, 'XC'),
(53, 46, 'XC'),
(53, 47, 'XC'),
(53, 48, 'XC'),
(53, 49, 'XC'),
(53, 50, 'XC'),
(53, 51, 'XC'),
(53, 52, 'XC'),
(53, 53, 'XC'),
(53, 54, 'XC'),
(53, 55, 'XC'),
(53, 56, 'XC'),
(54, 33, 'XA'),
(54, 33, 'XE'),
(54, 33, 'XI'),
(55, 34, 'XA'),
(55, 34, 'XE'),
(55, 34, 'XI'),
(56, 35, 'XA'),
(56, 35, 'XE'),
(56, 35, 'XI'),
(57, 36, 'XA'),
(57, 36, 'XE'),
(57, 36, 'XI'),
(58, 37, 'XA'),
(58, 37, 'XE'),
(58, 37, 'XI'),
(59, 38, 'XA'),
(59, 38, 'XE'),
(59, 38, 'XI'),
(60, 33, 'XC'),
(61, 34, 'XC'),
(62, 35, 'XC'),
(63, 36, 'XC'),
(64, 37, 'XC'),
(65, 38, 'XC');

-- --------------------------------------------------------

--
-- Table structure for table `group_types`
--

DROP TABLE IF EXISTS `group_types`;
CREATE TABLE `group_types` (
  `abv` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `group_types`
--

INSERT INTO `group_types` (`abv`, `description`) VALUES
('AG', 'Administrators'),
('CC', 'Corporate'),
('FF', 'Family'),
('GG', 'Gym Employees'),
('II', 'Institution'),
('MG', 'Gym Managers'),
('PP', 'Private Group'),
('SS', 'School');

-- --------------------------------------------------------

--
-- Table structure for table `group_users`
--

DROP TABLE IF EXISTS `group_users`;
CREATE TABLE `group_users` (
  `group_id` mediumint(6) NOT NULL,
  `user_id` int(8) NOT NULL,
  `role_abv` char(2) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `group_users`
--

INSERT INTO `group_users` (`group_id`, `user_id`, `role_abv`) VALUES
(53, 51, 'GC'),
(53, 52, 'GC'),
(54, 53, 'GA'),
(54, 59, 'GC'),
(55, 54, 'GA'),
(55, 60, 'GC'),
(56, 55, 'GA'),
(57, 56, 'GA'),
(58, 57, 'GA'),
(58, 61, 'GC'),
(59, 58, 'GA'),
(59, 62, 'GC'),
(60, 53, 'GA'),
(60, 59, 'GA'),
(60, 63, 'GC'),
(60, 69, 'GC'),
(60, 75, 'GC'),
(60, 88, 'GC'),
(61, 54, 'GA'),
(61, 60, 'GA'),
(61, 64, 'GC'),
(61, 70, 'GC'),
(61, 76, 'GC'),
(61, 89, 'GC'),
(62, 55, 'GA'),
(62, 65, 'GC'),
(62, 71, 'GC'),
(62, 77, 'GC'),
(62, 90, 'GC'),
(63, 56, 'GA'),
(63, 66, 'GC'),
(63, 72, 'GC'),
(63, 91, 'GC'),
(64, 57, 'GA'),
(64, 61, 'GA'),
(64, 67, 'GC'),
(64, 73, 'GC'),
(64, 92, 'GC'),
(65, 58, 'GA'),
(65, 62, 'GA'),
(65, 68, 'GC'),
(65, 74, 'GC');

-- --------------------------------------------------------

--
-- Table structure for table `gyms`
--

DROP TABLE IF EXISTS `gyms`;
CREATE TABLE `gyms` (
  `id` smallint(4) NOT NULL,
  `gym_name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '/public/upload/gym/default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gyms`
--

INSERT INTO `gyms` (`id`, `gym_name`, `website`, `avatar_url`) VALUES
(13, 'Rock City', 'https://www.rockcity.com', '/public/upload/gym/13-gym.png'),
(14, 'The Summit', 'https://www.summitgym.com', '/public/upload/gym/14-gym.png'),
(15, 'Iron Mountain', 'https://www.iron-mountain.com', '/public/upload/gym/default.png'),
(16, 'ClimbWorks', 'https://www.climbworks.com', '/public/upload/gym/16-gym.png'),
(17, 'Xperia', 'https://www.xperia.com', '/public/upload/gym/17-gym.png'),
(18, 'Area 42', 'https://www.area42.com', '/public/upload/gym/18-gym.png'),
(19, 'The Hangar', 'https://www.hangarclimbing.com', '/public/upload/gym/19-gym.png'),
(20, 'Keystone', 'https://www.keystonegym.com', '/public/upload/gym/20-gym.png'),
(21, 'Ascension', 'https://www.ascension.com', '/public/upload/gym/21-gym.png'),
(22, 'IBEX', 'https://www.ibexwa.com', '/public/upload/gym/22-gym.png');

--
-- Triggers `gyms`
--
DROP TRIGGER IF EXISTS `tr_delete_gyms_audits`;
DELIMITER $$
CREATE TRIGGER `tr_delete_gyms_audits` AFTER DELETE ON `gyms` FOR EACH ROW INSERT INTO `audits` (
		type,
		table_name,
		record_id,
		old_values,
		new_values,
		applied_by,
		applied_on
	)
	VALUES(
		'D',
		'gyms',
		OLD.id,
		JSON_OBJECT(
			"id", OLD.id,
			"gym_name", OLD.gym_name,
			"website", OLD.website,
			"avatar_url", OLD.avatar_url
		),
		NULL,
		CURRENT_USER,
		CURRENT_TIMESTAMP
	)
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `tr_insert_gyms_audits`;
DELIMITER $$
CREATE TRIGGER `tr_insert_gyms_audits` AFTER INSERT ON `gyms` FOR EACH ROW INSERT INTO `audits` (
		type,
		table_name,
		record_id,
		old_values,
		new_values,
		applied_by,
		applied_on
	)
	VALUES(
		'I',
		'gyms',
		NEW.id,
		NULL,
		JSON_OBJECT(
			"id", NEW.id,
			"gym_name", NEW.gym_name,
			"website", NEW.website,
			"avatar_url", NEW.avatar_url
		),
		CURRENT_USER,
		CURRENT_TIMESTAMP
	)
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `tr_update_gyms_audits`;
DELIMITER $$
CREATE TRIGGER `tr_update_gyms_audits` AFTER UPDATE ON `gyms` FOR EACH ROW INSERT INTO `audits` (
		type,
		table_name,
		record_id,
		old_values,
		new_values,
		applied_by,
		applied_on
	)
	VALUES(
		'U',
		'gyms',
		NEW.id,
		JSON_OBJECT(
			"id", OLD.id,
			"gym_name", OLD.gym_name,
			"website", OLD.website,
			"avatar_url", OLD.avatar_url
		),
		JSON_OBJECT(
			"id", NEW.id,
			"gym_name", NEW.gym_name,
			"website", NEW.website,
			"avatar_url", NEW.avatar_url
		),
		CURRENT_USER,
		CURRENT_TIMESTAMP
	)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
CREATE TABLE `locations` (
  `id` smallint(4) NOT NULL,
  `gym_id` smallint(4) NOT NULL,
  `location_name` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_address` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` mediumint(5) DEFAULT NULL,
  `state_abv` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_abv` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_p_country` tinyint(3) DEFAULT NULL,
  `phone_primary` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `capacity` smallint(6) NOT NULL DEFAULT 0,
  `employee_group` mediumint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `gym_id`, `location_name`, `street_address`, `city`, `zip`, `state_abv`, `country_abv`, `phone_p_country`, `phone_primary`, `photo_data`, `capacity`, `employee_group`) VALUES
(33, 13, 'Asheville', '64 Amboy Road', 'Asheville', 28806, 'NC', 'US', 1, '8286465645', NULL, 120, 60),
(34, 13, 'Raleigh', '163 Granite Way', 'Raleigh', 28706, 'NC', 'US', 1, '9106153255', NULL, 150, 61),
(35, 14, 'Boulder', '13 Gravity Park', 'Boulder', 80302, 'CO', 'US', 1, '4665215486', NULL, 120, 62),
(36, 14, 'Fort Collins', '1009 Cliff Court', 'Fort Collins', 80522, 'CO', 'US', 1, '6468552136', NULL, 120, 63),
(37, 15, 'New York', '166 Market Street #30', 'Brooklyn', 11238, 'NY', 'US', 1, '8965546215', NULL, 120, 64),
(38, 17, 'Los Angeles', '6446 Crest Boulevard', 'Los Angeles', 90003, 'CA', 'US', 1, '6165432215', NULL, 120, 65),
(39, 16, 'Memphis', '14 New State Highway', 'Memphis', 37544, 'TN', 'US', 1, '6165432235', NULL, 120, NULL),
(40, 16, 'Nashville', '651 Cherry Lane', 'Nashville', 37201, 'TN', 'US', 1, '9496552215', NULL, 120, NULL),
(41, 16, 'Johnson City', '444 Crescent Street', 'Johnson City', 37604, 'TN', 'US', 1, '8486552231', NULL, 120, NULL),
(42, 16, 'Lexington', '16 Locust Lane', 'Lexington', 40502, 'KY', 'US', 1, '4668529901', NULL, 120, NULL),
(43, 16, 'Bowling Green', '90 Boulder Row', 'Bowling Green', 42102, 'KY', 'US', 1, '4053325075', NULL, 120, NULL),
(44, 18, 'Columbia City', '1996 Crystal Avenue', 'Seattle', 98118, 'WA', 'US', 1, '6052219853', NULL, 120, NULL),
(45, 18, 'Greenwood', '633 Congress Lane', 'Seattle', 98103, 'WA', 'US', 1, '4620159943', NULL, 120, NULL),
(46, 18, 'Eastlake', '18820 Central Avenue', 'Seattle', 98102, 'WA', 'US', 1, '6165231154', NULL, 120, NULL),
(47, 19, 'Reston', '1563 Earl Row', 'Reston', 20190, 'VA', 'US', 1, '5054432168', NULL, 120, NULL),
(48, 19, 'Georgetown', '323 SE 14th Avenue', 'Georgetown', 20007, 'DC', 'US', 1, '9463201549', NULL, 120, NULL),
(49, 19, 'South Kensington', '3899 Nova Boulevard', 'South Kensington', 20895, 'MD', 'US', 1, '3135264980', NULL, 120, NULL),
(50, 19, 'Arlington', '18001 Bell Lane', 'Arlington', 22202, 'VA', 'US', 1, '8086469853', NULL, 120, NULL),
(51, 20, 'Five Points', '10 Peachtree Street', 'Atlanta', 30303, 'GA', 'US', 1, '5054326980', NULL, 120, NULL),
(52, 20, 'Stone Mountain', '20 Fletcher Route', 'Stone Mountain', 30083, 'GA', 'US', 1, '6165043215', NULL, 120, NULL),
(53, 21, 'Sugar House', '640 West Boulevard', 'Salt Lake City', 84106, 'UT', 'US', 1, '6198463204', NULL, 120, NULL),
(54, 21, 'West Jordan', '8490 West 9000 South', 'West Jordan', 84088, 'UT', 'US', 1, '6489437752', NULL, 120, NULL),
(55, 22, 'Eugene', '1605 East 19th Avenue', 'Eugene', 97403, 'OR', 'US', 1, '9893154405', NULL, 120, NULL),
(56, 22, 'Portland', '450 Rose Avenue', 'Beaverton', 97005, 'OR', 'US', 1, '7832155520', NULL, 120, NULL);

--
-- Triggers `locations`
--
DROP TRIGGER IF EXISTS `tr_delete_locations_audits`;
DELIMITER $$
CREATE TRIGGER `tr_delete_locations_audits` AFTER DELETE ON `locations` FOR EACH ROW INSERT INTO `audits` (
		type,
		table_name,
		record_id,
		old_values,
		new_values,
		applied_by,
		applied_on
	)
	VALUES(
		'D',
		'locations',
		OLD.id,
		JSON_OBJECT(
			"id", OLD.id,
			"gym_id", OLD.gym_id,
			"location_name", OLD.location_name,
			"street_address", OLD.street_address,
			"city", OLD.city,
			"zip", OLD.zip,
			"state_abv", OLD.state_abv,
			"country_abv", OLD.country_abv,
            "phone_p_country", OLD.phone_p_country,
            "phone_primary", OLD.phone_primary,
			"photo_data", OLD.photo_data,
            "capacity", OLD.capacity,
            "employee_group", OLD.employee_group
		),
		NULL,
		CURRENT_USER,
		CURRENT_TIMESTAMP
	)
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `tr_insert_locations_audits`;
DELIMITER $$
CREATE TRIGGER `tr_insert_locations_audits` AFTER INSERT ON `locations` FOR EACH ROW INSERT INTO `audits` (
		type,
		table_name,
		record_id,
		old_values,
		new_values,
		applied_by,
		applied_on
	)
	VALUES(
		'I',
		'locations',
		NEW.id,
		NULL,
		JSON_OBJECT(
			"id", NEW.id,
			"gym_id", NEW.gym_id,
			"location_name", NEW.location_name,
			"street_address", NEW.street_address,
			"city", NEW.city,
			"zip", NEW.zip,
			"state_abv", NEW.state_abv,
			"country_abv", NEW.country_abv,
            "phone_p_country", NEW.phone_p_country,
            "phone_primary", NEW.phone_primary,
			"photo_data", NEW.photo_data,
            "capacity", NEW.capacity,
            "employee_group", NEW.employee_group
		),
		CURRENT_USER,
		CURRENT_TIMESTAMP
	)
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `tr_update_locations_audits`;
DELIMITER $$
CREATE TRIGGER `tr_update_locations_audits` AFTER UPDATE ON `locations` FOR EACH ROW INSERT INTO `audits` (
		type,
		table_name,
		record_id,
		old_values,
		new_values,
		applied_by,
		applied_on
	)
	VALUES(
		'U',
		'locations',
		NEW.id,
		JSON_OBJECT(
			"id", OLD.id,
			"gym_id", OLD.gym_id,
			"location_name", OLD.location_name,
			"street_address", OLD.street_address,
			"city", OLD.city,
			"zip", OLD.zip,
			"state_abv", OLD.state_abv,
			"country_abv", OLD.country_abv,
            "phone_p_country", OLD.phone_p_country,
            "phone_primary", OLD.phone_primary,
			"photo_data", OLD.photo_data,
            "capacity", OLD.capacity,
            "employee_group", OLD.employee_group
		),
		JSON_OBJECT(
			"id", NEW.id,
			"gym_id", NEW.gym_id,
			"location_name", NEW.location_name,
			"street_address", NEW.street_address,
			"city", NEW.city,
			"zip", NEW.zip,
			"state_abv", NEW.state_abv,
			"country_abv", NEW.country_abv,
            "phone_p_country", NEW.phone_p_country,
            "phone_primary", NEW.phone_primary,
			"photo_data", NEW.photo_data,
            "capacity", NEW.capacity,
            "employee_group", NEW.employee_group
		),
		CURRENT_USER,
		CURRENT_TIMESTAMP
	)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `passes`
--

DROP TABLE IF EXISTS `passes`;
CREATE TABLE `passes` (
  `id` int(10) NOT NULL,
  `user_id` int(8) NOT NULL,
  `is_active` tinyint(1) DEFAULT 0,
  `pass_type` enum('A','B','C','D','E','F') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `active_on` date DEFAULT NULL,
  `expires_on` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `passes`
--

INSERT INTO `passes` (`id`, `user_id`, `is_active`, `pass_type`, `created_at`, `active_on`, `expires_on`) VALUES
(23, 78, 1, 'E', '2022-05-03 09:36:21', '2022-05-03', '2022-06-03'),
(24, 79, 1, 'D', '2022-05-03 09:39:40', '2022-05-03', '2022-06-03'),
(25, 80, 1, 'D', '2022-05-03 09:45:09', '2022-05-03', '2022-06-03'),
(26, 82, 1, 'E', '2022-05-03 09:45:27', '2022-05-03', '2022-06-03'),
(27, 83, 1, 'E', '2022-05-03 09:45:37', '2022-05-03', '2022-06-03'),
(28, 85, 1, 'F', '2022-05-03 09:45:51', '2022-05-03', '2022-08-03'),
(29, 86, 1, 'F', '2022-05-03 09:46:02', '2022-05-03', '2022-08-03');

--
-- Triggers `passes`
--
DROP TRIGGER IF EXISTS `tr_delete_passes_audits`;
DELIMITER $$
CREATE TRIGGER `tr_delete_passes_audits` AFTER DELETE ON `passes` FOR EACH ROW INSERT INTO `audits` (
		type,
		table_name,
		record_id,
		old_values,
		new_values,
		applied_by,
		applied_on
	)
	VALUES(
		'D',
		'passes',
		OLD.id,
		JSON_OBJECT(
			"id", OLD.id,
            "user_id", OLD.user_id,
			"is_active", OLD.is_active,
			"pass_type", OLD.pass_type,
            "created_at", OLD.created_at,
			"active_on", OLD.active_on,
            "expires_on", OLD.expires_on
		),
		NULL,
		CURRENT_USER,
		CURRENT_TIMESTAMP
	)
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `tr_insert_passes_audits`;
DELIMITER $$
CREATE TRIGGER `tr_insert_passes_audits` AFTER INSERT ON `passes` FOR EACH ROW INSERT INTO `audits` (
		type,
		table_name,
		record_id,
		old_values,
		new_values,
		applied_by,
		applied_on
	)
	VALUES(
		'I',
		'passes',
		NEW.id,
		NULL,
		JSON_OBJECT(
			"id", NEW.id,
            "user_id", NEW.user_id,
			"is_active", NEW.is_active,
			"pass_type", NEW.pass_type,
            "created_at", NEW.created_at,
			"active_on", NEW.active_on,
            "expires_on", NEW.expires_on
		),
		CURRENT_USER,
		CURRENT_TIMESTAMP
	)
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `tr_update_passes_audits`;
DELIMITER $$
CREATE TRIGGER `tr_update_passes_audits` AFTER UPDATE ON `passes` FOR EACH ROW INSERT INTO `audits` (
		type,
		table_name,
		record_id,
		old_values,
		new_values,
		applied_by,
		applied_on
	)
	VALUES(
		'U',
		'passes',
		NEW.id,
		JSON_OBJECT(
			"id", OLD.id,
            "user_id", OLD.user_id,
			"is_active", OLD.is_active,
			"pass_type", OLD.pass_type,
            "created_at", OLD.created_at,
			"active_on", OLD.active_on,
            "expires_on", OLD.expires_on
		),
		JSON_OBJECT(
			"id", NEW.id,
            "user_id", NEW.user_id,
			"is_active", NEW.is_active,
			"pass_type", NEW.pass_type,
            "created_at", NEW.created_at,
			"active_on", NEW.active_on,
            "expires_on", NEW.expires_on
		),
		CURRENT_USER,
		CURRENT_TIMESTAMP
	)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

DROP TABLE IF EXISTS `password_reset`;
CREATE TABLE `password_reset` (
  `id` int(11) NOT NULL,
  `user_id` int(8) NOT NULL,
  `password_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requested` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pass_line_items`
--

DROP TABLE IF EXISTS `pass_line_items`;
CREATE TABLE `pass_line_items` (
  `pass_id` int(10) NOT NULL,
  `gym_id` smallint(4) NOT NULL,
  `assigned` tinyint(3) NOT NULL DEFAULT 0,
  `used` tinyint(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pass_line_items`
--

INSERT INTO `pass_line_items` (`pass_id`, `gym_id`, `assigned`, `used`) VALUES
(23, 13, 3, 0),
(23, 14, 3, 0),
(23, 15, 3, 0),
(23, 16, 3, 0),
(23, 17, 3, 0),
(23, 18, 3, 0),
(23, 19, 3, 0),
(23, 20, 3, 0),
(23, 21, 3, 0),
(23, 22, 3, 0),
(24, 13, 1, 1),
(24, 14, 1, 0),
(24, 15, 1, 0),
(24, 16, 1, 0),
(24, 17, 1, 0),
(24, 18, 1, 0),
(24, 19, 1, 0),
(24, 20, 1, 0),
(24, 21, 1, 0),
(24, 22, 1, 0),
(25, 13, 1, 0),
(25, 14, 1, 0),
(25, 15, 1, 1),
(25, 16, 1, 0),
(25, 17, 1, 0),
(25, 18, 1, 0),
(25, 19, 1, 0),
(25, 20, 1, 0),
(25, 21, 1, 0),
(25, 22, 1, 0),
(26, 13, 3, 0),
(26, 14, 3, 0),
(26, 15, 3, 1),
(26, 16, 3, 0),
(26, 17, 3, 0),
(26, 18, 3, 0),
(26, 19, 3, 0),
(26, 20, 3, 0),
(26, 21, 3, 0),
(26, 22, 3, 0),
(27, 13, 3, 0),
(27, 14, 3, 0),
(27, 15, 3, 1),
(27, 16, 3, 0),
(27, 17, 3, 0),
(27, 18, 3, 0),
(27, 19, 3, 0),
(27, 20, 3, 0),
(27, 21, 3, 0),
(27, 22, 3, 0),
(28, 13, 5, 0),
(28, 14, 5, 0),
(28, 15, 5, 1),
(28, 16, 5, 0),
(28, 17, 5, 0),
(28, 18, 5, 0),
(28, 19, 5, 0),
(28, 20, 5, 0),
(28, 21, 5, 0),
(28, 22, 5, 0),
(29, 13, 5, 0),
(29, 14, 5, 0),
(29, 15, 5, 1),
(29, 16, 5, 0),
(29, 17, 5, 0),
(29, 18, 5, 0),
(29, 19, 5, 0),
(29, 20, 5, 0),
(29, 21, 5, 0),
(29, 22, 5, 0);

--
-- Triggers `pass_line_items`
--
DROP TRIGGER IF EXISTS `tr_delete_pass_line_items_audits`;
DELIMITER $$
CREATE TRIGGER `tr_delete_pass_line_items_audits` AFTER DELETE ON `pass_line_items` FOR EACH ROW INSERT INTO `audits` (
		type,
		table_name,
		record_id,
		old_values,
		new_values,
		applied_by,
		applied_on
	)
	VALUES(
		'D',
		'pass_line_items',
		CONCAT(OLD.pass_id, "-", OLD.gym_id),
		JSON_OBJECT(
			"pass_id", OLD.pass_id,
			"gym_id", OLD.gym_id,
			"assigned", OLD.assigned,
			"used", OLD.used
		),
		NULL,
		CURRENT_USER,
		CURRENT_TIMESTAMP
	)
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `tr_insert_pass_line_items_audits`;
DELIMITER $$
CREATE TRIGGER `tr_insert_pass_line_items_audits` AFTER INSERT ON `pass_line_items` FOR EACH ROW INSERT INTO `audits` (
		type,
		table_name,
		record_id,
		old_values,
		new_values,
		applied_by,
		applied_on
	)
	VALUES(
		'I',
		'pass_line_items',
		CONCAT(NEW.pass_id, "-", NEW.gym_id),
		NULL,
		JSON_OBJECT(
			"pass_id", NEW.pass_id,
			"gym_id", NEW.gym_id,
			"assigned", NEW.assigned,
			"used", NEW.used
		),
		CURRENT_USER,
		CURRENT_TIMESTAMP
	)
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `tr_update_pass_line_items_audits`;
DELIMITER $$
CREATE TRIGGER `tr_update_pass_line_items_audits` AFTER UPDATE ON `pass_line_items` FOR EACH ROW INSERT INTO `audits` (
		type,
		table_name,
		record_id,
		old_values,
		new_values,
		applied_by,
		applied_on
	)
	VALUES(
		'U',
		'pass_line_items',
		CONCAT(NEW.pass_id, "-", NEW.gym_id),
		JSON_OBJECT(
			"pass_id", OLD.pass_id,
			"gym_id", OLD.gym_id,
			"assigned", OLD.assigned,
			"used", OLD.used
		),
		JSON_OBJECT(
			"pass_id", NEW.pass_id,
			"gym_id", NEW.gym_id,
			"assigned", NEW.assigned,
			"used", NEW.used
		),
		CURRENT_USER,
		CURRENT_TIMESTAMP
	)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `abv` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` tinytext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`abv`, `description`) VALUES
('XA', 'User can create new users directly into this location employee group'),
('XC', 'User can change their session to this location'),
('XE', 'User can manage events at this location'),
('XI', 'User can edit this locations information');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
CREATE TABLE `states` (
  `abv` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state_name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `region` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`abv`, `state_name`, `region`) VALUES
('AK', 'Alaska', 'Beyond'),
('AL', 'Alabama', 'Southeast'),
('AR', 'Arkansas', 'Southeast'),
('AS', 'American Samoa', 'Beyond'),
('AZ', 'Arizona', 'Mountain'),
('CA', 'California', 'Pacific'),
('CM', 'Northern Mariana Islands', 'Beyond'),
('CO', 'Colorado', 'Mountain'),
('CT', 'Connecticut', 'Northeast'),
('DC', 'District of Columbia', 'Northeast'),
('DE', 'Delaware', 'Northeast'),
('FL', 'Florida', 'Southeast'),
('GA', 'Georgia', 'Southeast'),
('GU', 'Guam', 'Beyond'),
('HI', 'Hawaii', 'Beyond'),
('IA', 'Iowa', 'Central'),
('ID', 'Idaho', 'Pacific'),
('IL', 'Illinois', 'Central'),
('IN', 'Indiana', 'Central'),
('KS', 'Kansas', 'Central'),
('KY', 'Kentucky', 'Southeast'),
('LA', 'Louisiana', 'Southeast'),
('MA', 'Massachusetts', 'Northeast'),
('MD', 'Maryland', 'Northeast'),
('ME', 'Maine', 'Northeast'),
('MI', 'Michigan', 'Central'),
('MN', 'Minnesota', 'Central'),
('MO', 'Missouri', 'Central'),
('MS', 'Mississippi', 'Southeast'),
('MT', 'Montana', 'Mountain'),
('NA', '', 'Beyond'),
('NC', 'North Carolina', 'Southeast'),
('ND', 'North Dakota', 'Central'),
('NE', 'Nebraska', 'Central'),
('NH', 'New Hampshire', 'Northeast'),
('NJ', 'New Jersey', 'Northeast'),
('NM', 'New Mexico', 'Mountain'),
('NV', 'Nevada', 'Pacific'),
('NY', 'New York', 'Northeast'),
('OH', 'Ohio', 'Central'),
('OK', 'Oklahoma', 'Mountain'),
('OR', 'Oregon', 'Pacific'),
('PA', 'Pennsylvania', 'Northeast'),
('PR', 'Puerto Rico', 'Beyond'),
('RI', 'Rhode Island', 'Northeast'),
('SC', 'South Carolina', 'Southeast'),
('SD', 'South Dakota', 'Central'),
('TN', 'Tennessee', 'Southeast'),
('TT', 'Trust Territories', 'Beyond'),
('TX', 'Texas', 'Mountain'),
('UT', 'Utah', 'Mountain'),
('VA', 'Virginia', 'Northeast'),
('VI', 'Virgin Islands', 'Beyond'),
('VT', 'Vermont', 'Northeast'),
('WA', 'Washington', 'Pacific'),
('WI', 'Wisconsin', 'Central'),
('WV', 'West Virginia', 'Northeast'),
('WY', 'Wyoming', 'Mountain');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(8) NOT NULL,
  `first_name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preferred_name` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `avatar_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '/public/upload/profile/default.png',
  `street_address` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` mediumint(5) UNSIGNED ZEROFILL DEFAULT NULL,
  `state_abv` char(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_abv` char(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_primary` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_p_country` tinyint(3) DEFAULT NULL,
  `phone_secondary` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_s_country` tinyint(3) DEFAULT NULL,
  `first_name_emergency` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name_emergency` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_emergency` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_e_country` tinyint(3) DEFAULT NULL,
  `password_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_abv` char(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `primary_location` smallint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `middle_name`, `preferred_name`, `birth_date`, `avatar_url`, `street_address`, `city`, `zip`, `state_abv`, `country_abv`, `email`, `phone_primary`, `phone_p_country`, `phone_secondary`, `phone_s_country`, `first_name_emergency`, `last_name_emergency`, `phone_emergency`, `phone_e_country`, `password_hash`, `access_abv`, `created_at`, `primary_location`) VALUES
(50, 'James', 'Baker', NULL, 'Jimmy', '1991-02-12', '/public/upload/profile/50-profile.png', 'PO Box 2012', 'Enka', 28728, 'NC', 'US', 'baker.jimmy@gmail.com', '2526465221', 1, NULL, NULL, 'Caet', 'Cash', '8284507973', 1, '$2y$10$I/73J1RXodbvqQr7EcQfKeDUc3ORZz2TC5fQJtvqd5vhmgIuqp4Bu', 'AA', '2022-05-01 06:26:54', 33),
(51, 'Caitlin', 'Cash', 'Presti', 'Caet', '1991-03-02', '\"/public/upload/profile/default.png\"', 'PO Box 2012', 'Enka', 28728, 'NC', 'US', 'caet@test.com', '8284507973', 1, NULL, NULL, 'Jimmy', 'Baker', '2526465221', 1, '$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi', 'AA', '2022-05-01 06:27:01', 34),
(52, 'Erin', 'Li', NULL, NULL, '1987-10-20', '\"/public/upload/profile/default.png\"', '115 Hyacinth Avenue', 'Boulder', 80302, 'CO', 'US', 'erin2@test.com', '4645153212', 1, NULL, NULL, 'Carl', 'Weathers', '4645218705', 1, '$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi', 'AA', '2022-05-01 06:27:07', 35),
(53, 'Aaron', 'Novicek', NULL, NULL, '1989-10-03', '/public/upload/profile/53-profile.jpeg', '930 Greenlee Way', 'Asheville', 28806, 'NC', 'US', 'aaron@test.com', '3236985530', 1, NULL, NULL, 'Alec', 'Novicek', '2026462252', 1, '$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi', 'GM', '2022-05-01 06:27:12', 33),
(54, 'Kevin', 'Roadbletter', 'William', NULL, '1993-07-11', '\"/public/upload/profile/default.png\"', '6005 Park Terrace', 'Raleigh', 27601, 'NC', 'US', 'kevin@test.com', '8875652140', 1, '5465235541', 1, 'Gideon', 'Roadbletter', '8465213320', 1, '$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi', 'GM', '2022-05-01 06:27:15', 34),
(55, 'Sydney', 'Steeple', 'Erin', NULL, '1995-01-06', '\"/public/upload/profile/default.png\"', '14 Mulberry Creek Road', 'Golden', 80402, 'CO', 'US', 'sydney@test.com', '46589952033', 1, NULL, NULL, 'Susie', 'Steeple', '8486239951', 1, '$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi', 'GM', '2022-05-01 06:27:21', 35),
(56, 'Danielle', 'Johnson', NULL, 'DJ', '1994-08-24', '\"/public/upload/profile/default.png\"', '106 Blackbird Drive', 'Ft. Collins', 80522, 'CO', 'US', 'dj@test.com', '6165230065', 1, '8652446592', 1, 'Victor', 'Johnson', '8185253464', 1, '$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi', 'GM', '2022-05-01 06:27:27', 36),
(57, 'William', 'Flintlock', NULL, 'Will', '1999-07-12', '\"/public/upload/profile/default.png\"', '38002 5th Place', 'Brooklyn', 11216, 'NY', 'US', 'will@test.com', '2026585541', 1, NULL, NULL, 'Clarice', 'Flintlock', '8985305122', 1, '$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi', 'GM', '2022-05-01 06:27:30', 37),
(58, 'Catalina', 'Vespera', 'Elizabeth', 'Cat', '1988-05-08', '\"/public/upload/profile/default.png\"', '9302 Richmond Boulevard', 'Los Angeles', 90004, 'CA', 'US', 'cat@test.com', '4652399820', 1, NULL, NULL, 'Harlen', 'Vespera', '5053136625', 1, '$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi', 'GM', '2022-05-01 06:27:34', 38),
(59, 'Sarah', 'Shirley', 'Elizabeth', 'Liz', '1994-09-30', '\"/public/upload/profile/default.png\"', '829 Birch Street', 'Asheville', 28803, 'NC', 'US', 'liz@test.com', '6865209847', 1, NULL, NULL, 'Chase', 'Stokes', '6496626527', 1, '$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi', 'GM', '2022-05-01 06:27:41', 33),
(60, 'Justin', 'Scott', 'Robert', NULL, '2003-11-07', '\"/public/upload/profile/default.png\"', '2009 Weebly Drive', 'Cary', 28601, 'NC', 'US', 'justin@test.com', '6165326840', 1, '6465225649', 1, 'LLoyd', 'Scott', '8486469952', 1, '$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi', 'GM', '2022-05-01 06:27:45', 34),
(61, 'Francis', 'Baker', NULL, 'Frank', '1986-01-26', '\"/public/upload/profile/default.png\"', '20993 Graham Street', 'Staten Island', 11239, 'NY', 'US', 'frank@test.com', '9808987460', 1, NULL, NULL, 'Henry', 'Baker', '8189463225', 1, '$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi', 'GM', '2022-05-01 06:27:53', 37),
(62, 'Sarah', 'Nguyen', 'Austin', NULL, '1988-11-14', '\"/public/upload/profile/default.png\"', '382 Jake Street #405', 'Inglewood', 90001, 'CA', 'US', 'sarah@test.com', '5410625421', 1, NULL, NULL, 'Channing', 'Taft', '5656585223', 1, '$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi', 'GM', '2022-05-01 06:27:58', 38),
(63, 'Erin', 'Sanders', 'Ashley', NULL, '1998-08-02', '\"/public/upload/profile/default.png\"', '90 Barnaby Street', 'Asheville', 28803, 'NC', 'US', 'erin3@test.com', '6165235405', 1, NULL, NULL, 'Mitchel', 'Berry', '8286465199', 1, '$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi', 'GS', '2022-05-03 08:31:00', 33),
(64, 'Sarah', 'Peterson', 'Anne', NULL, '2000-11-20', '\"/public/upload/profile/default.png\"', '9209 Billows Circle', 'Raleigh', 27545, 'NC', 'US', 'sarah2@test.com', '6135694860', 1, NULL, NULL, 'Abigail', 'Chan', '8085236661', 1, '$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi', 'GS', '2022-05-01 06:28:10', 34),
(65, 'Jerrod', 'Brown', 'Michael', NULL, '1990-02-08', '\"/public/upload/profile/default.png\"', '9209 Zenith Drive', 'Denver', 80019, 'CO', 'US', 'jerrod@test.com', '9184635035', 1, NULL, NULL, 'Georgia', 'Brown', '8826516523', 1, '$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi', 'GS', '2022-05-01 06:28:14', 35),
(66, 'Violet', 'Fillipecci', 'Christine', NULL, '1982-07-24', '\"/public/upload/profile/default.png\"', '156 Green Street #901', 'Denver', 80110, 'CO', 'US', 'violet@test.com', '6134657208', 1, '5616543252', 1, 'Francis', 'Wu', '6413665202', 1, '$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi', 'GS', '2022-05-01 06:28:17', 36),
(67, 'Ethan', 'Cintera', NULL, NULL, '1995-12-05', '\"/public/upload/profile/default.png\"', '1500 Burns Place #90', 'Brooklyn', 11238, 'NY', 'US', 'ethan@test.com', '6134698502', 1, NULL, NULL, 'Nieve', 'Burris', '5587500251', 1, '$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi', 'GS', '2022-05-03 10:26:53', 37),
(68, 'Michael', 'Stebbing', 'Todd', 'Mike', '1985-01-31', '\"/public/upload/profile/default.png\"', '68 Vermont Avenue', 'Culver City', 90004, 'CA', 'US', 'mike@test.com', '6163430950', 1, NULL, NULL, 'Coleen', 'Stebbing', '4465889530', 1, '$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi', 'GS', '2022-05-01 06:28:24', 38),
(69, 'William', 'Grant', 'Lane', 'Bill', '1986-08-06', '\"/public/upload/profile/default.png\"', '20 Tomahawk Lake Drive', 'Black Mountain', 28774, 'NC', 'US', 'bill@test.com', '6164365987', 1, NULL, NULL, 'Patricia', 'Russo', '6615205584', 1, '$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi', 'GS', '2022-05-01 06:28:33', 33),
(70, 'River', 'Monday', 'Stuart', NULL, '1999-04-09', '\"/public/upload/profile/default.png\"', '14 West Burns Avenue', 'Raleigh', 27513, 'NC', 'US', 'river@test.com', '3164265025', 1, NULL, NULL, 'Mallory', 'Brien', '2256399980', 1, '$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi', 'GS', '2022-05-01 06:28:36', 34),
(71, 'Karen', 'Truman', 'Anne', NULL, '1984-01-30', '\"/public/upload/profile/default.png\"', '1655 14th Street #2', 'Boulder', 80501, 'CO', 'US', 'karen@test.com', '6784119320', 1, '3166554320', 1, 'Lavina', 'Truman', '4456329987', 1, '$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi', 'GS', '2022-05-01 06:28:41', 35),
(72, 'Sanni', 'Larsen', 'Cassy', NULL, '1994-03-19', '\"/public/upload/profile/default.png\"', '20 Surgeon Court ', 'Ft. Collins', 80522, 'CO', 'US', 'sanni@test.com', '6431598550', 1, '6165235134', 1, 'Mai', 'Henry', '6365202251', 1, '$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi', 'GS', '2022-05-01 06:28:46', 36),
(73, 'Neil', 'Francis', 'Winston', NULL, '1998-04-07', '\"/public/upload/profile/default.png\"', '2093 Hill Street #902', 'Brooklyn', 11201, 'NY', 'US', 'neil@test.com', '9496538024', 1, NULL, NULL, 'Isma', 'Neil', '9836621036', 1, '$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi', 'GS', '2022-05-01 06:28:50', 37),
(74, 'Francisco', 'Sanchez', 'Javier', 'Frank', '1986-06-17', '\"/public/upload/profile/default.png\"', '2908 Ocean Park Drive', 'Los Angeles', 90002, 'CA', 'US', 'frank2@test.com', '6420319854', 1, NULL, NULL, 'Fern', 'Hudson', '5515542399', 1, '$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi', 'GS', '2022-05-01 06:28:58', 38),
(75, 'David', 'Elliot', 'Ilkin', 'Dave', '1989-03-03', '\"/public/upload/profile/default.png\"', '38 Granite Street', 'Asheville', 28801, 'NC', 'US', 'dave@test.com', '5240316587', 1, NULL, NULL, 'Alister', 'Ramos', '6063236685', 1, '$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi', 'GS', '2022-05-01 06:29:32', 33),
(76, 'Kylee', 'Hyde', 'Rachel', NULL, '1981-09-30', '\"/public/upload/profile/default.png\"', '1400 Fern Lake Circle', 'Durham', 27661, 'NC', 'US', 'kylee@test.com', '6498863027', 1, '6463215646', 1, 'Laylah', 'McDermott', '5548756990', 1, '$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi', 'GS', '2022-05-01 06:29:41', 34),
(77, 'Amina', 'Minett', 'Maxima', 'Amie', '1989-02-17', '\"/public/upload/profile/default.png\"', '2893 Lavendar Avenue', 'Boulder', 80412, 'CO', 'US', 'amie@test.com', '8496350256', 1, '5406516185', 1, 'Buddy', 'Paine', '8286353612', 1, '$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi', 'GS', '2022-05-01 06:29:45', 35),
(78, 'Erin', 'Salomon', NULL, NULL, '1981-04-25', '/public/upload/profile/78-profile.jpeg', '290 New Holland Drive', 'Asheville', 28806, 'NC', 'US', 'erin@test.com', '8084623521', 1, '5654325512', 1, 'Bill', 'Jerry', '3250426615', 1, '$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi', 'MM', '2022-05-03 08:31:07', 33),
(79, 'Caitlin', 'McGuiness', 'Josette', 'Cai', '1971-09-01', '\"/public/upload/profile/default.png\"', '930 Filbert Street', 'Raleigh', 27606, 'NC', 'US', 'cai@test.com', '8879463250', 1, NULL, NULL, 'first_name_emergency', 'last_name_emergency', '3033559980', 1, '$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi', 'MM', '2022-05-01 06:29:56', 34),
(80, 'Evan', 'Nevin', 'Sudar', NULL, '1974-01-02', '\"/public/upload/profile/default.png\"', '2093 Snowden Road', 'Denver', 80014, 'CO', 'US', 'evan@test.com', '6163250843', 1, NULL, NULL, 'Gene', 'Nevin', '5521305531', 1, '$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi', 'MM', '2022-05-01 06:29:58', 35),
(81, 'Skylar', 'Langley', 'Barnabas', NULL, '1996-02-04', '\"/public/upload/profile/default.png\"', '109 Gateway Drive', 'Denver', 80019, 'CO', 'US', 'skylar@test.com', '8084621865', 1, NULL, NULL, 'Geoffrey', 'Langley', '4133502807', 1, '$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi', 'MM', '2022-05-01 06:30:01', 36),
(82, 'Idir', 'Ma', 'Tro', 'Idy', '1989-11-29', '\"/public/upload/profile/default.png\"', '29 6th Avenue #502', 'Brooklyn', 11202, 'NY', 'US', 'idy@test.com', '8548946320', 1, NULL, NULL, 'Saxon', 'Haigh', '9093652154', 1, '$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi', 'MM', '2022-05-01 06:30:05', 37),
(83, 'Katarin', 'Gutierrez', 'Sondra', 'Kate', '1992-03-19', '\"/public/upload/profile/default.png\"', '293 New Glen Road', 'Glendale', 90001, 'CA', 'US', 'kate@test.com', '6049810651', 1, NULL, NULL, 'Demi', 'Patel', '4230541325', 1, '$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi', 'MM', '2022-05-01 06:30:09', 38),
(84, 'Tracie', 'Connor', 'Robby', NULL, '1986-08-12', '\"/public/upload/profile/default.png\"', '2839 Granby Avenue', 'Weaverville', 28778, 'NC', 'US', 'tracie@test.com', '3031613498', 1, NULL, NULL, 'Kenzie', 'Holding', '8438543216', 1, '$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi', 'MM', '2022-05-01 06:30:14', 33),
(85, 'Delilah', 'Drake', 'Belle', NULL, '1961-06-06', '\"/public/upload/profile/default.png\"', '953 Van Dyke Street', 'Raleigh', 27606, 'NC', 'US', 'delilah@test.com', '6402186624', 1, NULL, NULL, 'Hayden', 'Drake', '9315163501', 1, '$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi', 'MM', '2022-05-01 06:30:18', 34),
(86, 'Lukas', 'Araujo', NULL, 'Luke', '1987-07-31', '\"/public/upload/profile/default.png\"', '555 West Sherwood Street', 'Boulder', 80504, 'CO', 'US', 'luke@test.com', '6436561970', 1, NULL, NULL, 'Dahlia', 'Frank', '7065216542', 1, '$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi', 'MM', '2022-05-01 06:30:26', 35),
(87, 'Donald', 'Archer', 'Celine', 'Donny', '1983-11-19', '\"/public/upload/profile/default.png\"', '187 Penn Lane #5', 'Staten Island', 11201, 'NY', 'US', 'donny@test.com', '8285212262', 1, '9846502215', 1, 'Ewan', 'Archer', '4652151380', 1, '$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi', 'MM', '2022-05-01 06:30:33', 37),
(88, 'Bine', 'Bartram', 'Kamon', NULL, '2004-01-24', '\"/public/upload/profile/default.png\"', '82 SE Eagle Street', 'Asheville', 28806, 'NC', 'US', 'bine@test.com', '6137984650', 1, NULL, NULL, 'Romany', 'Bartram', '3315245520', 1, '$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi', 'GS', '2022-05-01 06:30:42', 33),
(89, 'Sabine', 'Mills', NULL, NULL, '1987-01-29', '\"/public/upload/profile/default.png\"', '9199 S Hawthorne Ave', 'Raleigh', 27606, 'NC', 'US', 'sabine@test.com', '7986521084', 1, NULL, NULL, 'Aariz', 'Tillman', '9985324200', 1, '$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi', 'GS', '2022-05-01 06:30:45', 34),
(90, 'Alexander', 'Herriot', 'Hesham', 'Alex', '1975-09-09', '\"/public/upload/profile/default.png\"', '71 Marconi Drive', 'Denver', 80014, 'CO', 'US', 'alex@test.com', '6133212150', 1, NULL, NULL, 'Nikolas', 'Herriot', '5054239875', 1, '$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi', 'GS', '2022-05-01 06:30:57', 35),
(91, 'Isa', 'Holmstrom', 'Kelly', NULL, '1992-03-03', '\"/public/upload/profile/default.png\"', '9936 Fairway Street', 'Ft. Collins', 80521, 'CO', 'US', 'isa@test.com', '6413252504', 1, NULL, NULL, 'Freya', 'Carlson', '3032126528', 1, '$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi', 'GS', '2022-05-01 06:31:02', 36),
(92, 'Phillip', 'Emerson', NULL, 'Phil', '1988-04-13', '\"/public/upload/profile/default.png\"', '362 Logan Avenue #30', 'Brooklyn', 11201, 'NY', 'US', 'phil2@test.com', '4652381601', 1, NULL, NULL, 'Sarah', 'Emerson', '9026332581', 1, '$2a$12$5Hy6vGkHUc0Xgdg8qQg9jeZc5maUuuWxUpnXv323hXDmU6QR5qcQi', 'GS', '2022-05-01 06:31:05', 37);

--
-- Triggers `users`
--
DROP TRIGGER IF EXISTS `tr_delete_users_audits`;
DELIMITER $$
CREATE TRIGGER `tr_delete_users_audits` AFTER DELETE ON `users` FOR EACH ROW INSERT INTO `audits` (
		type,
		table_name,
		record_id,
		old_values,
		new_values,
		applied_by,
		applied_on
	)
	VALUES(
		'D',
		'users',
		OLD.id,
		JSON_OBJECT(
			"id", OLD.id,
			"first_name", OLD.first_name,
			"last_name", OLD.last_name,
			"middle_name", OLD.middle_name,
			"preferred_name", OLD.preferred_name,
			"birth_date", OLD.birth_date,
			"avatar_url", OLD.avatar_url,
			"street_address", OLD.street_address,
			"city", OLD.city,
			"zip", OLD.zip,
			"state_abv", OLD.state_abv,
			"country_abv", OLD.country_abv,
			"email", OLD.email,
			"phone_primary", OLD.phone_primary,
			"phone_p_country", OLD.phone_p_country,
			"phone_secondary", OLD.phone_secondary,
			"phone_s_country", OLD.phone_s_country,
			"first_name_emergency", OLD.first_name_emergency,
			"last_name_emergency", OLD.last_name_emergency,
			"phone_emergency", OLD.phone_emergency,
			"phone_e_country", OLD.phone_e_country,
			"password_hash", OLD.password_hash,
			"access_abv", OLD.access_abv,
			"created_at", OLD.created_at,
            "primary_location", OLD.primary_location
		),
		NULL,
		CURRENT_USER,
		CURRENT_TIMESTAMP
	)
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `tr_insert_users_audits`;
DELIMITER $$
CREATE TRIGGER `tr_insert_users_audits` AFTER INSERT ON `users` FOR EACH ROW INSERT INTO `audits` (
		type,
		table_name,
		record_id,
		old_values,
		new_values,
		applied_by,
		applied_on
	)
	VALUES(
		'I',
		'users',
		NEW.id,
		NULL,
		JSON_OBJECT(
			"id", NEW.id,
			"first_name", NEW.first_name,
			"last_name", NEW.last_name,
			"middle_name", NEW.middle_name,
			"preferred_name", NEW.preferred_name,
			"birth_date", NEW.birth_date,
			"avatar_url", NEW.avatar_url,
			"street_address", NEW.street_address,
			"city", NEW.city,
			"zip", NEW.zip,
			"state_abv", NEW.state_abv,
			"country_abv", NEW.country_abv,
			"email", NEW.email,
			"phone_primary", NEW.phone_primary,
			"phone_p_country", NEW.phone_p_country,
			"phone_secondary", NEW.phone_secondary,
			"phone_s_country", NEW.phone_s_country,
			"first_name_emergency", NEW.first_name_emergency,
			"last_name_emergency", NEW.last_name_emergency,
			"phone_emergency", NEW.phone_emergency,
			"phone_e_country", NEW.phone_e_country,
			"password_hash", NEW.password_hash,
			"access_abv", NEW.access_abv,
			"created_at", NEW.created_at,
            "primary_location", NEW.primary_location
		),
		CURRENT_USER,
		CURRENT_TIMESTAMP
	)
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `tr_update_users_audits`;
DELIMITER $$
CREATE TRIGGER `tr_update_users_audits` AFTER UPDATE ON `users` FOR EACH ROW INSERT INTO `audits` (
		type,
		table_name,
		record_id,
		old_values,
		new_values,
		applied_by,
		applied_on
	)
	VALUES(
		'U',
		'users',
		NEW.id,
		JSON_OBJECT(
			"id", OLD.id,
			"first_name", OLD.first_name,
			"last_name", OLD.last_name,
			"middle_name", OLD.middle_name,
			"preferred_name", OLD.preferred_name,
			"birth_date", OLD.birth_date,
			"avatar_url", OLD.avatar_url,
			"street_address", OLD.street_address,
			"city", OLD.city,
			"zip", OLD.zip,
			"state_abv", OLD.state_abv,
			"country_abv", OLD.country_abv,
			"email", OLD.email,
			"phone_primary", OLD.phone_primary,
			"phone_p_country", OLD.phone_p_country,
			"phone_secondary", OLD.phone_secondary,
			"phone_s_country", OLD.phone_s_country,
			"first_name_emergency", OLD.first_name_emergency,
			"last_name_emergency", OLD.last_name_emergency,
			"phone_emergency", OLD.phone_emergency,
			"phone_e_country", OLD.phone_e_country,
			"password_hash", OLD.password_hash,
			"access_abv", OLD.access_abv,
			"created_at", OLD.created_at,
            "primary_location", OLD.primary_location
		),
		JSON_OBJECT(
			"id", NEW.id,
			"first_name", NEW.first_name,
			"last_name", NEW.last_name,
			"middle_name", NEW.middle_name,
			"preferred_name", NEW.preferred_name,
			"birth_date", NEW.birth_date,
			"avatar_url", NEW.avatar_url,
			"street_address", NEW.street_address,
			"city", NEW.city,
			"zip", NEW.zip,
			"state_abv", NEW.state_abv,
			"country_abv", NEW.country_abv,
			"email", NEW.email,
			"phone_primary", NEW.phone_primary,
			"phone_p_country", NEW.phone_p_country,
			"phone_secondary", NEW.phone_secondary,
			"phone_s_country", NEW.phone_s_country,
			"first_name_emergency", NEW.first_name_emergency,
			"last_name_emergency", NEW.last_name_emergency,
			"phone_emergency", NEW.phone_emergency,
			"phone_e_country", NEW.phone_e_country,
			"password_hash", NEW.password_hash,
			"access_abv", NEW.access_abv,
			"created_at", NEW.created_at,
            "primary_location", NEW.primary_location
		),
		CURRENT_USER,
		CURRENT_TIMESTAMP
	)
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_types`
--
ALTER TABLE `access_types`
  ADD PRIMARY KEY (`abv`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `location_id` (`location_id`);

--
-- Indexes for table `audits`
--
ALTER TABLE `audits`
  ADD PRIMARY KEY (`pk`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`abv`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `location_id` (`location_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leader_id` (`owner_id`),
  ADD KEY `type_abv` (`type_abv`);

--
-- Indexes for table `group_permissions`
--
ALTER TABLE `group_permissions`
  ADD PRIMARY KEY (`group_id`,`location_id`,`permission_abv`),
  ADD KEY `location_id` (`location_id`),
  ADD KEY `permission_abv` (`permission_abv`);

--
-- Indexes for table `group_types`
--
ALTER TABLE `group_types`
  ADD PRIMARY KEY (`abv`);

--
-- Indexes for table `group_users`
--
ALTER TABLE `group_users`
  ADD PRIMARY KEY (`group_id`,`user_id`) USING BTREE,
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `gyms`
--
ALTER TABLE `gyms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `country_abv` (`country_abv`),
  ADD KEY `state_abv` (`state_abv`),
  ADD KEY `gym_id` (`gym_id`),
  ADD KEY `employee_group` (`employee_group`);

--
-- Indexes for table `passes`
--
ALTER TABLE `passes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `pass_line_items`
--
ALTER TABLE `pass_line_items`
  ADD PRIMARY KEY (`pass_id`,`gym_id`),
  ADD KEY `gym_id` (`gym_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`abv`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`abv`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_unique` (`email`),
  ADD KEY `country_abv` (`country_abv`),
  ADD KEY `state_abv` (`state_abv`),
  ADD KEY `access_abv` (`access_abv`),
  ADD KEY `primary_location` (`primary_location`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `audits`
--
ALTER TABLE `audits`
  MODIFY `pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=297;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `gyms`
--
ALTER TABLE `gyms`
  MODIFY `id` smallint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` smallint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `passes`
--
ALTER TABLE `passes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `fk_attendance_locations_location_id` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`),
  ADD CONSTRAINT `fk_attendance_users_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `fk_events_locations_location_id` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`);

--
-- Constraints for table `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `fk_groups_group_types_type_abv` FOREIGN KEY (`type_abv`) REFERENCES `group_types` (`abv`),
  ADD CONSTRAINT `fk_groups_users_owner_id` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `group_permissions`
--
ALTER TABLE `group_permissions`
  ADD CONSTRAINT `fk_group_permissions_groups_group_id` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`),
  ADD CONSTRAINT `fk_group_permissions_locations_location_id` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`),
  ADD CONSTRAINT `fk_group_permissions_permissions_permission_abv` FOREIGN KEY (`permission_abv`) REFERENCES `permissions` (`abv`);

--
-- Constraints for table `group_users`
--
ALTER TABLE `group_users`
  ADD CONSTRAINT `fk_group_users_groups_group_id` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`),
  ADD CONSTRAINT `fk_group_users_users_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `locations`
--
ALTER TABLE `locations`
  ADD CONSTRAINT `fk_locations_countries_country_abv` FOREIGN KEY (`country_abv`) REFERENCES `countries` (`abv`),
  ADD CONSTRAINT `fk_locations_gyms_gym_id` FOREIGN KEY (`gym_id`) REFERENCES `gyms` (`id`),
  ADD CONSTRAINT `fk_locations_states_state_abv` FOREIGN KEY (`state_abv`) REFERENCES `states` (`abv`),
  ADD CONSTRAINT `locations_ibfk_21` FOREIGN KEY (`employee_group`) REFERENCES `groups` (`id`);

--
-- Constraints for table `passes`
--
ALTER TABLE `passes`
  ADD CONSTRAINT `fk_passes_users_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD CONSTRAINT `fk_password_reset_users_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `pass_line_items`
--
ALTER TABLE `pass_line_items`
  ADD CONSTRAINT `fk_pass_line_items_gyms_gym_id` FOREIGN KEY (`gym_id`) REFERENCES `gyms` (`id`),
  ADD CONSTRAINT `fk_pass_line_items_passes_pass_id` FOREIGN KEY (`pass_id`) REFERENCES `passes` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_countries_country_abv` FOREIGN KEY (`country_abv`) REFERENCES `countries` (`abv`),
  ADD CONSTRAINT `fk_users_states_state_abv` FOREIGN KEY (`state_abv`) REFERENCES `states` (`abv`);

DELIMITER $$
--
-- Events
--
DROP EVENT IF EXISTS `delete_14`$$
CREATE DEFINER=`u308745100_bakerdtk`@`127.0.0.1` EVENT `delete_14` ON SCHEDULE AT '2022-05-03 07:45:49' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM password_reset WHERE password_reset.id = '14'$$

DROP EVENT IF EXISTS `delete_15`$$
CREATE DEFINER=`u308745100_bakerdtk`@`127.0.0.1` EVENT `delete_15` ON SCHEDULE AT '2022-05-03 07:47:14' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM password_reset WHERE password_reset.id = '15'$$

DROP EVENT IF EXISTS `delete_16`$$
CREATE DEFINER=`u308745100_bakerdtk`@`127.0.0.1` EVENT `delete_16` ON SCHEDULE AT '2022-05-03 07:51:05' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM password_reset WHERE password_reset.id = '16'$$

DROP EVENT IF EXISTS `delete_17`$$
CREATE DEFINER=`u308745100_bakerdtk`@`127.0.0.1` EVENT `delete_17` ON SCHEDULE AT '2022-05-03 07:52:57' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM password_reset WHERE password_reset.id = '17'$$

DROP EVENT IF EXISTS `delete_18`$$
CREATE DEFINER=`u308745100_bakerdtk`@`127.0.0.1` EVENT `delete_18` ON SCHEDULE AT '2022-05-03 08:03:21' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM password_reset WHERE password_reset.id = '18'$$

DELIMITER ;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
