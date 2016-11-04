-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2016 at 02:28 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `onlinecakedelivery`
--

-- --------------------------------------------------------

--
-- Table structure for table `cake_details`
--

CREATE TABLE IF NOT EXISTS `cake_details` (
`cid` int(11) NOT NULL,
  `cake_type` varchar(20) NOT NULL,
  `cost` double NOT NULL,
  `duration` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login_admin`
--

CREATE TABLE IF NOT EXISTS `login_admin` (
  `uid` int(11) NOT NULL,
  `pwd` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login_customer`
--

CREATE TABLE IF NOT EXISTS `login_customer` (
  `uid` int(11) NOT NULL,
  `pwd` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login_deliverer`
--

CREATE TABLE IF NOT EXISTS `login_deliverer` (
  `uid` int(11) NOT NULL,
  `pwd` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
`oid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `date_of_delivery` date NOT NULL,
  `time_of_delivery` time NOT NULL,
  `status` varchar(20) NOT NULL,
  `mailing_address` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `zip` varchar(5) NOT NULL,
  `ph_no` varchar(10) NOT NULL,
  `payment_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE IF NOT EXISTS `registration` (
`uid` int(20) NOT NULL,
  `uname` varchar(20) NOT NULL,
  `pwd` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `address` varchar(30) NOT NULL,
  `mobile` int(15) NOT NULL,
  `u_type` varchar(20) NOT NULL DEFAULT 'customer'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cake_details`
--
ALTER TABLE `cake_details`
 ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `login_admin`
--
ALTER TABLE `login_admin`
 ADD UNIQUE KEY `email` (`email`), ADD KEY `login_ibfk_1` (`uid`);

--
-- Indexes for table `login_customer`
--
ALTER TABLE `login_customer`
 ADD UNIQUE KEY `email` (`email`), ADD KEY `login_customer_ibfk_1` (`uid`);

--
-- Indexes for table `login_deliverer`
--
ALTER TABLE `login_deliverer`
 ADD UNIQUE KEY `email` (`email`), ADD KEY `login_deliverer_ibfk_1` (`uid`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
 ADD PRIMARY KEY (`oid`), ADD KEY `order_ibfk_1` (`uid`), ADD KEY `order_ibfk_2` (`cid`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
 ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cake_details`
--
ALTER TABLE `cake_details`
MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
MODIFY `uid` int(20) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `login_admin`
--
ALTER TABLE `login_admin`
ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `registration` (`uid`);

--
-- Constraints for table `login_customer`
--
ALTER TABLE `login_customer`
ADD CONSTRAINT `login_customer_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `registration` (`uid`);

--
-- Constraints for table `login_deliverer`
--
ALTER TABLE `login_deliverer`
ADD CONSTRAINT `login_deliverer_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `registration` (`uid`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `registration` (`uid`),
ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`cid`) REFERENCES `cake_details` (`cid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
