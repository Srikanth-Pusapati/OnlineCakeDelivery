-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2016 at 06:16 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlinecakedelivery`
--

-- --------------------------------------------------------

--
-- Table structure for table `cake_details`
--

CREATE TABLE `cake_details` (
  `cakeid` int(11) NOT NULL,
  `cake_name` varchar(20) NOT NULL,
  `cake_details` varchar(20) NOT NULL,
  `cake_ingrediants` varchar(20) NOT NULL,
  `cost_item` double NOT NULL,
  `cake_image_path` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cake_details`
--

/*INSERT INTO `cake_details` (`cakeid`, `cake_name`, `cake_details`, `cake_ingrediants`, `cost_item`, `cake_image_path`) VALUES
(1, 'Butterscotch', '1kg', 'kaaju', 15, '');*/

-- --------------------------------------------------------

--
-- Table structure for table `customer_order`
--

CREATE TABLE `customer_order` (
  `orderid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `cakeid` int(11) NOT NULL,
  `deliverer_id` int(11),
  `date_of_delivery` date NOT NULL,
  `time_of_delivery` time NOT NULL,
  `order_status` varchar(20) NOT NULL,
  `order_mailing_address` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `zip` varchar(5) NOT NULL,
  `phone_no` varchar(10) NOT NULL,
  `payment_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_order`
--

/* INSERT INTO `customer_order` (`orderid`, `userid`, `cakeid`, `deliverer_id`, `date_of_delivery`, `time_of_delivery`, `order_status`, `order_mailing_address`, `city`, `zip`, `phone_no`, `payment_status`) VALUES 
(2, 1, 1, 2, '2016-11-14', '02:10:10', 'confirmed', '911 bernard', 'Denton', '76201', '1234560789', 'pending'); */

-- --------------------------------------------------------

--
-- Table structure for table `login_admin`
--

CREATE TABLE `login_admin` (
  `userid` int(11) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login_customer`
--

CREATE TABLE `login_customer` (
  `userid` int(11) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_customer`
--

/*INSERT INTO `login_customer` (`userid`, `password`, `email`) VALUES
(1, '1234', 'dhoni@gmail.com');*/

-- --------------------------------------------------------

--
-- Table structure for table `login_deliverer`
--

CREATE TABLE `login_deliverer` (
  `userid` int(11) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_deliverer`
--

/*INSERT INTO `login_deliverer` (`userid`, `password`, `email`) VALUES
(2, '1234', 'raina@gmail.com');*/

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `userid` int(20) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `address` varchar(30) NOT NULL,
  `mobile_number` int(10) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'customer'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registration`
--

/*INSERT INTO `registration` (`userid`, `user_name`, `password`, `email`, `address`, `mobile_number`, `user_type`) VALUES
(1, 'Dhoni', '1234', 'dhoni@gmail.com', '911 bernard', 1234567898, 'customer'),
(2, 'Raina', '1234', 'raina@gmail.com', 'stella st', 1324567898, 'deliverer');*/

--
-- Triggers `registration`
--
DELIMITER $$
CREATE TRIGGER `login_trigger` AFTER INSERT ON `registration` FOR EACH ROW BEGIN
  IF NEW.user_type = 'customer' THEN
  INSERT INTO login_customer(`userid`, `password`, `email`)
  VALUES(NEW.userid, NEW.password, NEW.email) ;
  ELSEIF NEW.user_type = 'admin' THEN
  INSERT INTO login_admin(`userid`, `password`, `email`)
  VALUES(NEW.userid, NEW.password, NEW.email) ;
  ELSEIF NEW.user_type = 'deliverer' THEN
  INSERT INTO login_deliverer(`userid`, `password`, `email`)
  VALUES(NEW.userid, NEW.password, NEW.email) ; 
END IF;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cake_details`
--
ALTER TABLE `cake_details`
  ADD PRIMARY KEY (`cakeid`);

--
-- Indexes for table `customer_order`
--
ALTER TABLE `customer_order`
  ADD PRIMARY KEY (`orderid`),
  ADD KEY `order_ibfk_1` (`userid`),
  ADD KEY `order_ibfk_2` (`cakeid`);

--
-- Indexes for table `login_admin`
--
ALTER TABLE `login_admin`
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `login_ibfk_1` (`userid`);

--
-- Indexes for table `login_customer`
--
ALTER TABLE `login_customer`
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `login_customer_ibfk_1` (`userid`);

--
-- Indexes for table `login_deliverer`
--
ALTER TABLE `login_deliverer`
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `login_deliverer_ibfk_1` (`userid`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cake_details`
--
ALTER TABLE `cake_details`
  MODIFY `cakeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `customer_order`
--
ALTER TABLE `customer_order`
  MODIFY `orderid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `userid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_order`
--
ALTER TABLE `customer_order`
  ADD CONSTRAINT `customer_order_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `registration` (`userid`),
  ADD CONSTRAINT `customer_order_ibfk_2` FOREIGN KEY (`cakeid`) REFERENCES `cake_details` (`cakeid`);

--
-- Constraints for table `login_admin`
--
ALTER TABLE `login_admin`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `registration` (`userid`);

--
-- Constraints for table `login_customer`
--
ALTER TABLE `login_customer`
  ADD CONSTRAINT `login_customer_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `registration` (`userid`);

--
-- Constraints for table `login_deliverer`
--
ALTER TABLE `login_deliverer`
  ADD CONSTRAINT `login_deliverer_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `registration` (`userid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
