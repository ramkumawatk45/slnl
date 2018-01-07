-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2018 at 01:14 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shrilife_loansoft`
--

-- --------------------------------------------------------

--
-- Table structure for table `accountings`
--

CREATE TABLE IF NOT EXISTS `accountings` (
  `accountingId` bigint(10) NOT NULL AUTO_INCREMENT,
  `branchId` int(8) NOT NULL,
  `createDate` date NOT NULL,
  `shriLife` float NOT NULL,
  `loan` float NOT NULL,
  `MF` float NOT NULL,
  `totalPayment` float NOT NULL,
  `receivePayment` float NOT NULL,
  `pendingCollection` float NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `deleted` int(2) NOT NULL DEFAULT '0',
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`accountingId`),
  UNIQUE KEY `accountingId` (`accountingId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `accountings`
--

INSERT INTO `accountings` (`accountingId`, `branchId`, `createDate`, `shriLife`, `loan`, `MF`, `totalPayment`, `receivePayment`, `pendingCollection`, `status`, `deleted`, `datetime`) VALUES
(1, 1, '2018-01-01', 10000, 10000, 4000, 24000, 14000, 10000, 0, 0, '2018-01-07 16:13:43'),
(2, 1, '2018-01-02', 5000, 5000, 3200, 24000, 14000, 10000, 0, 0, '2018-01-07 16:28:13'),
(3, 2, '2018-01-03', 200, 300, 400, 900, 800, 100, 0, 0, '2018-01-07 17:09:00'),
(4, 3, '2018-01-07', 500, 700, 300, 1500, 1000, 500, 0, 0, '2018-01-07 17:12:54');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
