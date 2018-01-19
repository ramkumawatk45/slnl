-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Jan 18, 2018 at 05:32 PM
-- Server version: 5.6.34
-- PHP Version: 5.6.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shrilife_loansoft`
--

-- --------------------------------------------------------

--
-- Table structure for table `loanrequests`
--

CREATE TABLE `loanrequests` (
  `id` int(10) NOT NULL,
  `branchCode` varchar(20) NOT NULL,
  `memberId` varchar(15) NOT NULL,
  `createDate` date NOT NULL,
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
  `loanPurpose` varchar(200) NOT NULL,
  `memberPhoto` varchar(100) NOT NULL,
  `memeberDocument` varchar(100) NOT NULL,
  `memberMobile` varchar(15) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `requestStatus` varchar(50) NOT NULL DEFAULT 'Pending',
  `requestReason` varchar(200) NOT NULL,
  `approveAmount` int(10) NOT NULL,
  `approveDate` date NOT NULL,
  `deleted` int(2) NOT NULL DEFAULT '0',
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `loanrequests`
--
ALTER TABLE `loanrequests`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `loanrequests`
--
ALTER TABLE `loanrequests`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
