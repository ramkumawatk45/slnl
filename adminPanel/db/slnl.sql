-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2017 at 02:30 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `slnl`
--

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE IF NOT EXISTS `areas` (
  `areaId` int(2) NOT NULL AUTO_INCREMENT,
  `districtId` int(2) NOT NULL,
  `areaName` varchar(200) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `deleted` int(2) NOT NULL DEFAULT '0',
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`areaId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `branchs`
--

CREATE TABLE IF NOT EXISTS `branchs` (
  `branchId` int(2) NOT NULL AUTO_INCREMENT,
  `branchName` varchar(100) NOT NULL,
  `branchCode` varchar(100) NOT NULL,
  `branchAddress` varchar(100) NOT NULL,
  `areacode` varchar(100) NOT NULL,
  `zipCode` varchar(6) NOT NULL,
  `phoneNo` varchar(13) NOT NULL,
  `stateId` int(3) NOT NULL,
  `districtId` int(3) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `deleted` int(2) NOT NULL DEFAULT '0',
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`branchId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `heading` varchar(100) NOT NULL,
  `officeAddress` varchar(5000) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `scontact` varchar(100) NOT NULL,
  `facebookUrl` varchar(500) NOT NULL,
  `youtubeUrl` varchar(500) NOT NULL,
  `googleUrl` varchar(500) NOT NULL,
  `twitterUrl` varchar(500) NOT NULL,
  `mailId` varchar(200) NOT NULL,
  `smailId` varchar(100) NOT NULL,
  `deleted` int(2) NOT NULL DEFAULT '0',
  `status` int(2) NOT NULL DEFAULT '0',
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `defaults`
--

CREATE TABLE IF NOT EXISTS `defaults` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  `defaultVal` varchar(50) NOT NULL,
  `deleted` int(2) NOT NULL DEFAULT '0',
  `status` int(2) NOT NULL DEFAULT '0',
  `accesstime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE IF NOT EXISTS `districts` (
  `districtId` int(2) NOT NULL AUTO_INCREMENT,
  `stateId` int(2) NOT NULL,
  `districtName` varchar(200) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `deleted` int(2) NOT NULL DEFAULT '0',
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`districtId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `downloads`
--

CREATE TABLE IF NOT EXISTS `downloads` (
  `downloadId` int(3) NOT NULL AUTO_INCREMENT,
  `downloadTitle` varchar(100) NOT NULL,
  `location` varchar(200) NOT NULL,
  `fileName` varchar(200) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `deleted` int(2) NOT NULL DEFAULT '0',
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`downloadId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `galleryId` int(2) NOT NULL AUTO_INCREMENT,
  `pageId` int(2) NOT NULL,
  `galleryName` varchar(200) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `deleted` int(2) NOT NULL DEFAULT '0',
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`galleryId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `galleryimages`
--

CREATE TABLE IF NOT EXISTS `galleryimages` (
  `imgId` int(3) NOT NULL AUTO_INCREMENT,
  `galleryId` int(2) NOT NULL,
  `imgTitle` varchar(100) NOT NULL,
  `location` varchar(200) NOT NULL,
  `imgname` varchar(200) NOT NULL,
  `imgDescription` varchar(500) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `deleted` int(2) NOT NULL DEFAULT '0',
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`imgId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `learningcourses`
--

CREATE TABLE IF NOT EXISTS `learningcourses` (
  `courseId` int(3) NOT NULL AUTO_INCREMENT,
  `programId` int(2) NOT NULL,
  `courseName` varchar(100) NOT NULL,
  `location` varchar(200) NOT NULL,
  `imgname` varchar(200) NOT NULL,
  `courseDescription` varchar(2000) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `deleted` int(2) NOT NULL DEFAULT '0',
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`courseId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `learningprograms`
--

CREATE TABLE IF NOT EXISTS `learningprograms` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `programName` varchar(100) NOT NULL,
  `deleted` int(2) NOT NULL DEFAULT '0',
  `status` int(2) NOT NULL DEFAULT '0',
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `loanemi`
--

CREATE TABLE IF NOT EXISTS `loanemi` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `loanId` bigint(15) NOT NULL,
  `branchCode` int(10) NOT NULL,
  `emiNo` int(4) NOT NULL,
  `lateFee` int(4) NOT NULL,
  `serviceCharge` int(4) NOT NULL,
  `transId` varchar(50) NOT NULL,
  `advanceAmount` int(5) NOT NULL,
  `emiAmount` int(10) NOT NULL,
  `dueDate` varchar(50) NOT NULL,
  `newDueDate` date NOT NULL,
  `newPaymentDate` date NOT NULL,
  `ndd` date NOT NULL,
  `paymentDate` varchar(50) NOT NULL,
  `paymentMode` varchar(50) NOT NULL,
  `chequeNo` varchar(50) NOT NULL,
  `chequeDate` varchar(50) NOT NULL,
  `bankName` varchar(100) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `deleted` int(2) NOT NULL DEFAULT '0',
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1699 ;

-- --------------------------------------------------------

--
-- Table structure for table `loanplan`
--

CREATE TABLE IF NOT EXISTS `loanplan` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `planName` varchar(20) NOT NULL,
  `planType` varchar(50) NOT NULL,
  `rateOfInterest` int(5) NOT NULL,
  `planDuration` int(3) NOT NULL,
  `installmentType` varchar(50) NOT NULL,
  `penaltyInterest` int(10) NOT NULL,
  `processingFee` int(10) NOT NULL,
  `taxRate` int(10) NOT NULL,
  `planDescription` varchar(200) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `deleted` int(2) NOT NULL DEFAULT '0',
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE IF NOT EXISTS `loans` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `loanId` bigint(20) NOT NULL,
  `branchCode` bigint(20) NOT NULL,
  `formId` varchar(15) NOT NULL,
  `memberId` varchar(15) NOT NULL,
  `cDate` varchar(50) NOT NULL,
  `createDate` date NOT NULL,
  `applicantName` varchar(100) NOT NULL,
  `gurdianName` varchar(100) NOT NULL,
  `dob` varchar(50) NOT NULL,
  `age` int(3) NOT NULL,
  `address` varchar(200) NOT NULL,
  `stateId` int(4) NOT NULL,
  `districtId` int(4) NOT NULL,
  `areaId` int(4) NOT NULL,
  `zipCode` varchar(8) NOT NULL,
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
  `chequeDate` varchar(50) NOT NULL,
  `bankAC` varchar(20) NOT NULL,
  `bankName` varchar(50) NOT NULL,
  `loanPurpose` varchar(200) NOT NULL,
  `memberPhoto` varchar(100) NOT NULL,
  `memberMobile` varchar(15) NOT NULL,
  `memberEmail` varchar(50) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `deleted` int(2) NOT NULL DEFAULT '0',
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=288 ;

-- --------------------------------------------------------

--
-- Table structure for table `logo`
--

CREATE TABLE IF NOT EXISTS `logo` (
  `id` int(2) NOT NULL,
  `logo_Location` varchar(200) NOT NULL,
  `logo_Title` varchar(200) NOT NULL,
  `site_Title` varchar(40) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `main_menu`
--

CREATE TABLE IF NOT EXISTS `main_menu` (
  `m_menu_id` int(2) NOT NULL AUTO_INCREMENT,
  `m_menu_name` varchar(50) NOT NULL,
  `m_menu_link` varchar(50) NOT NULL,
  `metaTitle` varchar(5000) NOT NULL,
  `metaDescription` varchar(20000) NOT NULL,
  `metaKeywords` varchar(10000) NOT NULL,
  `m_menu_deleted` int(2) NOT NULL DEFAULT '0',
  `m_menu_status` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`m_menu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `pageId` int(3) NOT NULL AUTO_INCREMENT,
  `pageTitle` varchar(200) NOT NULL,
  `pageSubTitle` varchar(2000) NOT NULL,
  `pageDescription` varchar(50000) NOT NULL,
  `s_menu_id` int(2) NOT NULL,
  `m_menu_Id` int(2) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `deleted` int(2) NOT NULL DEFAULT '0',
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`pageId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `plantypes`
--

CREATE TABLE IF NOT EXISTS `plantypes` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `planType` varchar(50) NOT NULL,
  `planName` varchar(50) NOT NULL,
  `deleted` int(2) NOT NULL DEFAULT '0',
  `status` int(2) NOT NULL DEFAULT '0',
  `accesstime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE IF NOT EXISTS `slider` (
  `imgId` int(3) NOT NULL AUTO_INCREMENT,
  `imgTitle` varchar(100) NOT NULL,
  `location` varchar(200) NOT NULL,
  `imgname` varchar(200) NOT NULL,
  `headingText` varchar(100) NOT NULL,
  `ptext` varchar(100) NOT NULL,
  `button1` varchar(50) NOT NULL,
  `button2` varchar(50) NOT NULL,
  `link1` varchar(100) NOT NULL,
  `link2` varchar(100) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `deleted` int(2) NOT NULL DEFAULT '0',
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`imgId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE IF NOT EXISTS `states` (
  `stateId` int(2) NOT NULL AUTO_INCREMENT,
  `stateName` varchar(200) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `deleted` int(2) NOT NULL DEFAULT '0',
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`stateId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `branchCode` int(10) NOT NULL,
  `usertype` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(500) NOT NULL,
  `deleted` int(2) NOT NULL DEFAULT '0',
  `status` int(2) NOT NULL DEFAULT '0',
  `accesstime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
