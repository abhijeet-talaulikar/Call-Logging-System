-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2016 at 05:13 AM
-- Server version: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siemens_cls`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `firstname`, `lastname`, `email`, `username`, `password`) VALUES
(1, 'anthony', 'fernandes', 'anthony.fernandes@siemens.com', 'in002in138114', 'a722c63db8ec8625af6cf71cb8c2d939'),
(2, 'vasant', 'pednekar', 'vasant.pednekar@siemens.com', 'in002in215499', 'c1572d05424d0ecb2a65ec6a82aeacbf'),
(3, 'kishore', 'naik', 'kishore.naik@siemens.com', 'in002in216166', '3afc79b597f88a72528e864cf81856d2');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(11) DEFAULT NULL,
  `network_login` varchar(20) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `department` varchar(40) DEFAULT NULL,
  `department_text` varchar(50) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `issues`
--

DROP TABLE IF EXISTS `issues`;
CREATE TABLE IF NOT EXISTS `issues` (
  `ticket` int(11) DEFAULT NULL,
  `network_login` varchar(20) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `department` varchar(40) DEFAULT NULL,
  `department_text` varchar(50) DEFAULT NULL,
  `date` varchar(30) DEFAULT NULL,
  `time` varchar(20) DEFAULT NULL,
  `related_to` varchar(30) DEFAULT NULL,
  `location` text,
  `description` text,
  `resolved_date` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `new_issues`
--

DROP TABLE IF EXISTS `new_issues`;
CREATE TABLE IF NOT EXISTS `new_issues` (
  `ticket` int(11) NOT NULL AUTO_INCREMENT,
  `network_login` varchar(20) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `department` varchar(40) DEFAULT NULL,
  `department_text` varchar(50) DEFAULT NULL,
  `date` varchar(30) DEFAULT NULL,
  `time` varchar(20) DEFAULT NULL,
  `related_to` varchar(30) DEFAULT NULL,
  `location` text,
  `description` text,
  UNIQUE KEY `ticket` (`ticket`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `resolved_issues`
--

DROP TABLE IF EXISTS `resolved_issues`;
CREATE TABLE IF NOT EXISTS `resolved_issues` (
  `ticket` int(11) DEFAULT NULL,
  `network_login` varchar(20) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `department` varchar(40) DEFAULT NULL,
  `department_text` varchar(50) DEFAULT NULL,
  `date` varchar(30) DEFAULT NULL,
  `time` varchar(20) DEFAULT NULL,
  `related_to` varchar(30) DEFAULT NULL,
  `location` text,
  `description` text,
  `resolved_date` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `ticket` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
