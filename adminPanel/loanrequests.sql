-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2018 at 04:45 AM
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
-- Table structure for table `loanrequests`
--

CREATE TABLE IF NOT EXISTS `loanrequests` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `branchCode` varchar(20) NOT NULL,
  `memberId` varchar(15) NOT NULL,
  `createDate` date NOT NULL,
  `approvalDate` date NOT NULL,
  `applicantName` varchar(100) NOT NULL,
  `gurdianName` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(200) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `maritalStatus` varchar(15) NOT NULL,
  `gMemberNo` varchar(15) NOT NULL,
  `gName` varchar(100) NOT NULL,
  `gMobile` varchar(13) NOT NULL,
  `loanPlanId` int(4) NOT NULL,
  `planTypeId` int(3) NOT NULL,
  `loanAmount` int(10) NOT NULL,
  `rateOfInterest` int(10) NOT NULL,
  `emi` int(10) NOT NULL,
  `pMode` varchar(20) NOT NULL,
  `chequeNo` varchar(20) NOT NULL,
  `chequeDate` varchar(20) NOT NULL,
  `bankAC` varchar(50) NOT NULL,
  `bankName` varchar(50) NOT NULL,
  `loanPurpose` varchar(200) NOT NULL,
  `memberPhoto` varchar(100) NOT NULL,
  `memberDocument` varchar(100) NOT NULL,
  `memberMobile` varchar(15) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `requestStatus` varchar(50) NOT NULL DEFAULT 'Pending',
  `requestReason` varchar(200) NOT NULL,
  `approveAmount` int(10) NOT NULL,
  `approveDate` date NOT NULL,
  `deleted` int(2) NOT NULL DEFAULT '0',
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `loanrequests`
--

INSERT INTO `loanrequests` (`id`, `branchCode`, `memberId`, `createDate`, `approvalDate`, `applicantName`, `gurdianName`, `dob`, `address`, `sex`, `maritalStatus`, `gMemberNo`, `gName`, `gMobile`, `loanPlanId`, `planTypeId`, `loanAmount`, `rateOfInterest`, `emi`, `pMode`, `chequeNo`, `chequeDate`, `bankAC`, `bankName`, `loanPurpose`, `memberPhoto`, `memberDocument`, `memberMobile`, `status`, `requestStatus`, `requestReason`, `approveAmount`, `approveDate`, `deleted`, `datetime`) VALUES
(1, '1', '7575', '2018-01-03', '2018-01-03', 'Ramniwas kumawat', 'Lalchand kumawat', '0000-00-00', 'Mandha Bhim Singh', 'male', 'single', '784', 'Dinesh kumawat', '9166782146', 1, 1, 10000, 11, 3021, '', '', '', '', '', 'For Vehicle', 'uploads/loanrequest/images/163892passwordhistory.png', 'uploads/loanrequest/idendity/41364uploaded data confirm.png', '9166782146', 0, 'Pending', '', 0, '0000-00-00', 0, '2018-01-28 08:42:51'),
(2, '1', '323232', '2018-01-05', '2018-01-05', 'Ramniwas kumawat', 'Lalchand kumawat', '0000-00-00', 'Jhotwara', 'male', 'married', '23232323', 'Dinesh kumawat', '2354325245252', 2, 1, 10000, 11, 218, 'cheque', '1111111111', '29/01/2018', '10843211027256', 'UCO Bank', 'For Vehicle', 'uploads/loanrequest/images/', 'uploads/loanrequest/idendity/', '9166782146', 0, 'Pending', '', 0, '0000-00-00', 0, '2018-01-28 09:06:05'),
(3, '1', '323242', '2018-01-01', '2018-01-29', 'Saroj kumawat', 'Lalchand kumawat', '1970-01-01', 'Jhotwara', '', '', '784', 'Ramniwas', '9166782146', 1, 1, 50000, 13, 5000, 'cash', '', '', '', '', 'My testy', 'uploads/loanrequest/images/', 'uploads/loanrequest/idendity/', '9166782146', 0, 'Pending', '', 0, '0000-00-00', 0, '2018-01-28 10:56:08'),
(4, '1', '532', '2018-01-24', '2018-01-23', 'Kittu', 'Lalchand kumawat', '2018-01-02', 'Mandha Bhim Singh', '', '', '784', 'Ramniwas', '9166782146', 1, 1, 80006, 15, 400, 'cash', '', '', '', '', 'My testy', 'uploads/loanrequest/images/', 'uploads/loanrequest/idendity/', '9166782146', 0, 'Pending', '', 0, '0000-00-00', 0, '2018-01-28 10:59:32'),
(5, '1', '123', '2018-01-13', '2018-01-28', 'Gayatri', 'Lalchand kumawat', '2018-01-02', 'Mandha Bhim Singh', '', '', '7654', 'dfgdfgfdg', '9166782146', 1, 1, 30000, 12, 432, 'cheque', '1111111111', '30/01/2018', '23543543543', 'UCO Bank', 'For Vehicle', 'uploads/loanrequest/images/448215profile_reminders_8_211117.jpg', 'uploads/loanrequest/idendity/94717action plan_oct 3, 2017 1-49 pm.pdf', '9166782146', 0, 'Pending', '', 0, '0000-00-00', 0, '2018-01-28 11:24:13');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
