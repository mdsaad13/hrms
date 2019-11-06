-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 06, 2019 at 01:24 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hrms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(1, 'Syed Mushtaq', 'admin@mail.com', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `awards`
--

DROP TABLE IF EXISTS `awards`;
CREATE TABLE IF NOT EXISTS `awards` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `amount` varchar(256) NOT NULL,
  `description` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `awards`
--

INSERT INTO `awards` (`id`, `title`, `amount`, `description`) VALUES
(1, 'Emp of the year', '5000', 'for best employees'),
(2, 'Best performance', '100', 'Description'),
(3, 'Best seller', '500', 'Who sells more'),
(4, 'Test Title', '50', 'Test Description');

-- --------------------------------------------------------

--
-- Table structure for table `awardsgiven`
--

DROP TABLE IF EXISTS `awardsgiven`;
CREATE TABLE IF NOT EXISTS `awardsgiven` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `award_id` int(255) NOT NULL,
  `emp_id` int(255) NOT NULL,
  `comments` varchar(256) DEFAULT NULL,
  `date` datetime NOT NULL,
  `amount` varchar(256) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `award_id` (`award_id`),
  KEY `emp_id` (`emp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `awardsgiven`
--

INSERT INTO `awardsgiven` (`id`, `award_id`, `emp_id`, `comments`, `date`, `amount`) VALUES
(1, 1, 1, 'sasas', '2019-10-26 11:02:13', '5000'),
(2, 1, 3, 'ghareeb ku paise', '2019-10-26 11:18:20', '5000'),
(3, 2, 2, 'test2', '2019-10-26 11:21:13', '100'),
(6, 3, 5, '', '2019-10-27 00:37:49', '400'),
(7, 2, 5, '', '2019-10-27 00:38:05', '100'),
(8, 3, 5, '', '2019-10-27 00:38:11', '400'),
(9, 4, 1, '', '2019-10-27 15:06:11', '50');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `dep_id` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL,
  `designation` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `dep_id`, `name`, `designation`) VALUES
(1, 'DEPT12778', 'HR', 'HR Manag'),
(2, 'DEPT75904', 'Accounts', 'CA'),
(3, 'DEPT38815', 'Driver', 'car'),
(4, 'DEPT44292', 'computer science', 'teacher');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `emp_id` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `qualification` varchar(256) NOT NULL,
  `joining_sal` varchar(256) NOT NULL,
  `country` varchar(256) NOT NULL,
  `state` varchar(256) NOT NULL,
  `city` varchar(256) NOT NULL,
  `pincode` varchar(256) NOT NULL,
  `address` varchar(256) NOT NULL,
  `dob` varchar(256) NOT NULL,
  `mobile` bigint(255) NOT NULL,
  `gender` varchar(256) NOT NULL,
  `dept_id` int(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `emp_id` (`emp_id`),
  KEY `dept_id` (`dept_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `emp_id`, `name`, `email`, `qualification`, `joining_sal`, `country`, `state`, `city`, `pincode`, `address`, `dob`, `mobile`, `gender`, `dept_id`) VALUES
(1, 'EMP66692', 'Saad Khan', 'saad@gmail.com', 'sasasasasa', '10000', 'India', 'Karnataka', 'Bengaluru', '987456', 'BTM layout, EWS colony', '2019-10-04', 8310682693, 'Male', 1),
(2, 'EMP77446', 'Nilesh', 'nileshcjain30@gmail.com', 'cbgfrdhdn', '89000', 'India', 'Karnataka', 'bangalore', '11', '#23 lic cdv', '1995-09-08', 2234556, 'Male', 2),
(3, 'EMP32509', 'Ateef', 'ateef@mail.com', 'asasasasas', '50', 'India', 'Karnataka', 'bangalore', '11', 'Tank garden', '2019-10-01', 2234556, 'Female', 3),
(4, 'EMP58872', 'Saqib', 'saqib@mail.com', '123123sadf', '50', 'India', 'Karnataka', 'bangalore', '545421', 'iufibcuwwe', '2019-10-06', 987876675, 'Male', 3),
(5, 'EMP49661', 'mahendra', 'saad.13.personal@gmail.com', 'syedjhgfybugyg', '100000', 'India', 'Karnataka', 'Bengaluru', '987456123', 'BTM layout, EWS colony', '2019-10-17', 8884291607, 'Male', 4);

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
CREATE TABLE IF NOT EXISTS `expenses` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `description` varchar(256) DEFAULT NULL,
  `amount` varchar(256) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `title`, `description`, `amount`, `date`) VALUES
(1, 'Chai', 'Refreshment', '10', '2019-10-26 11:03:08'),
(2, 'Coffee', 'Refreshment', '20', '2019-10-26 11:03:54'),
(3, 'Coke', 'for employees', '200', '2019-10-27 05:17:20');

-- --------------------------------------------------------

--
-- Table structure for table `payslips`
--

DROP TABLE IF EXISTS `payslips`;
CREATE TABLE IF NOT EXISTS `payslips` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `slip_id` varchar(256) NOT NULL,
  `emp_id` int(255) NOT NULL,
  `date` varchar(256) NOT NULL,
  `amount` varchar(256) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slip_id` (`slip_id`),
  KEY `emp_id` (`emp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payslips`
--

INSERT INTO `payslips` (`id`, `slip_id`, `emp_id`, `date`, `amount`) VALUES
(1, '902070', 1, '2019-10-27 04:39:00', '100'),
(2, '557218', 4, '2019-10-27 05:08:00', '50'),
(3, '563432', 5, '2019-10-27 05:11:16', '1000'),
(4, '548089', 1, '2019-10-27 15:07:12', '1000'),
(5, '678797', 2, '2019-10-27 17:09:03', '200');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `awardsgiven`
--
ALTER TABLE `awardsgiven`
  ADD CONSTRAINT `awardsgiven_ibfk_1` FOREIGN KEY (`award_id`) REFERENCES `awards` (`id`),
  ADD CONSTRAINT `awardsgiven_ibfk_2` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`id`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`dept_id`) REFERENCES `department` (`id`);

--
-- Constraints for table `payslips`
--
ALTER TABLE `payslips`
  ADD CONSTRAINT `payslips_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
