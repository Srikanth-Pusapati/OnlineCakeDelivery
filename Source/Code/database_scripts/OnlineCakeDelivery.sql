-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2018 at 10:28 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
  `cake_details` varchar(40) DEFAULT NULL,
  `cake_ingredients` varchar(40) DEFAULT NULL,
  `cost_item` double NOT NULL,
  `cake_image_path` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ascii;

--
-- Dumping data for table `cake_details`
--

INSERT INTO `cake_details` (`cakeid`, `cake_name`, `cake_details`, `cake_ingredients`, `cost_item`, `cake_image_path`) VALUES
(1, 'Chocolate Cake', 'Cool fantastic cake', 'chocolate, strawberries', 32.56, '6.png'),
(2, 'Pineapple Cool Cake', 'Pineapple Cake', 'Pineapple, eggs', 23.2, '22.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `cakeid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '0',
  `totalprice` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

-- INSERT INTO `cart` (`cartid`, `userid`, `cakeid`, `quantity`, `totalprice`) VALUES
-- (4, 3, 1, 1, 32.56),
-- (5, 3, 2, 1, 23.2);

-- --------------------------------------------------------

--
-- Table structure for table `customer_order`
--

CREATE TABLE `customer_order` (
  `orderid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `cakeid` int(11) NOT NULL,
  `deliverer_id` int(11) DEFAULT NULL,
  `paymentid` int(11) DEFAULT NULL,
  `date_of_delivery` date NOT NULL,
  `time_of_delivery` time NOT NULL,
  `order_status` varchar(20) NOT NULL,
  `order_mailing_address` varchar(40) NOT NULL,
  `city` varchar(20) NOT NULL,
  `zip` varchar(5) NOT NULL,
  `phone_no` varchar(10) NOT NULL,
  `payment_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ascii;

--
-- Dumping data for table `customer_order`
--

-- INSERT INTO `customer_order` (`orderid`, `userid`, `cakeid`, `deliverer_id`, `paymentid`, `date_of_delivery`, `time_of_delivery`, `order_status`, `order_mailing_address`, `city`, `zip`, `phone_no`, `payment_status`) VALUES
-- (2, 3, 1, NULL, NULL, '2018-05-02', '02:02:00', 'pending', '2417 Charlotte St\r\nApt 111', 'Denton', '76201', '9407459409', 'NOT YET PAID'),
-- (3, 4, 1, NULL, NULL, '2019-02-02', '14:01:00', 'pending', '2', 'denton', '76201', '9988776655', 'NOT YET PAID'),
-- (4, 4, 2, NULL, NULL, '2018-05-03', '02:22:00', 'pending', '2417 Charlotte St\r\nApt 111', 'Denton', '76201', '9407459409', 'NOT YET PAID'),
-- (5, 4, 2, NULL, NULL, '2018-05-03', '11:11:00', 'pending', '2417 Charlotte St\r\nApt 111', 'Denton', '76201', '9407459409', 'NOT YET PAID');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `UI_rating` varchar(10) NOT NULL,
  `cake_available` varchar(10) NOT NULL,
  `suggest` varchar(10) NOT NULL,
  `worth` varchar(10) NOT NULL,
  `comment` varchar(50) NOT NULL,
  `feedbackId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ascii;

-- --------------------------------------------------------

--
-- Table structure for table `login_admin`
--

-- CREATE TABLE `login_admin` (
  -- `userid` int(11) NOT NULL,
  -- `password` varchar(40) NOT NULL,
  -- `email` varchar(40) NOT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=ascii;

-- --
-- -- Dumping data for table `login_admin`
-- --

-- INSERT INTO `login_admin` (`userid`, `password`, `email`) VALUES
-- (1, SHA1('Admin@123'), 'admin@test.com');

-- --------------------------------------------------------

--
-- Table structure for table `login_customer`
--

-- CREATE TABLE `login_customer` (
  -- `userid` int(11) NOT NULL,
  -- `password` varchar(40) NOT NULL,
  -- `email` varchar(40) NOT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=ascii;

--
-- Dumping data for table `login_customer`
-- 

-- INSERT INTO `login_customer` (`userid`, `password`, `email`) VALUES
-- (4, '099daadf53884064111c9277b4385b7f3ab4e2e7', 'gam@gmail.com'),
-- (3, '28f4a5ccfd14e62ae994676bcae0cf4f89555205', 'sri@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `login_deliverer`
--

-- CREATE TABLE `login_deliverer` (
  -- `userid` int(11) NOT NULL,
  -- `password` varchar(40) NOT NULL,
  -- `email` varchar(40) NOT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=ascii;

--
-- Dumping data for table `login_deliverer`
--
-- INSERT INTO `login_deliverer` (`userid`, `password`, `email`) VALUES
-- (2, SHA1('Sri_1993'), 'sri@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `payment_details`
--

CREATE TABLE `payment_details` (
  `paymentid` int(11) NOT NULL,
  `in_no` int(11) NOT NULL,
  `cakeid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `payment_amount` double NOT NULL DEFAULT '0',
  `payment_status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `userid` int(11) NOT NULL,
  `user_name` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `address` varchar(30) NOT NULL,
  `mobile_number` varchar(10) NOT NULL,
  `user_type` varchar(15) NOT NULL DEFAULT 'customer',
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=ascii;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`userid`, `user_name`, `password`, `email`, `address`, `mobile_number`, `user_type`) VALUES
(1, 'Admin', SHA1('Admin@123'), 'admin@test.com', '2417 Charlotte St #111, Denton', '9407459409', 'admin'),
(2, 'srikanth', SHA1('Sri_1993'), 'sri@gmail.com', '2417 Charlotte St,#111, Denton', '9407459409', 'deliverer');

--
-- Triggers `registration`
--
-- DELIMITER $$
-- CREATE TRIGGER `login_trigger` AFTER INSERT ON `registration` FOR EACH ROW BEGIN
  -- IF NEW.user_type = 'customer' THEN
  -- INSERT INTO login_customer(`userid`, `password`, `email`)
  -- VALUES(NEW.userid, NEW.password, NEW.email) ;
  -- ELSEIF NEW.user_type = 'admin' THEN
  -- INSERT INTO login_admin(`userid`, `password`, `email`)
  -- VALUES(NEW.userid, NEW.password, NEW.email) ;
  -- ELSEIF NEW.user_type = 'deliverer' THEN
  -- INSERT INTO login_deliverer(`userid`, `password`, `email`)
  -- VALUES(NEW.userid, NEW.password, NEW.email) ; 
-- END IF;
-- END
-- $$
-- DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cake_details`
--
ALTER TABLE `cake_details`
  ADD PRIMARY KEY (`cakeid`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartid`),
  ADD KEY `cakeid_foreignKey` (`cakeid`),
  ADD KEY `userid_foreignkey` (`userid`);

--
-- Indexes for table `customer_order`
--
ALTER TABLE `customer_order`
  ADD PRIMARY KEY (`orderid`),
  ADD KEY `order_ibfk_1` (`userid`),
  ADD KEY `order_ibfk_2` (`cakeid`),
  ADD KEY `customer_order_ibfk_3` (`deliverer_id`),
  ADD KEY `paymentid` (`paymentid`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedbackId`);

--
-- Indexes for table `login_admin`
--
-- ALTER TABLE `login_admin`
  -- ADD UNIQUE KEY `email` (`email`),
  -- ADD KEY `login_ibfk_1` (`userid`);

-- --
-- -- Indexes for table `login_customer`
-- --
-- ALTER TABLE `login_customer`
  -- ADD UNIQUE KEY `email` (`email`),
  -- ADD KEY `login_customer_ibfk_1` (`userid`);

-- --
-- -- Indexes for table `login_deliverer`
-- --
-- ALTER TABLE `login_deliverer`
  -- ADD UNIQUE KEY `email` (`email`),
  -- ADD KEY `login_deliverer_ibfk_1` (`userid`);

--
-- Indexes for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD PRIMARY KEY (`paymentid`);

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
  MODIFY `cakeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `customer_order`
--
ALTER TABLE `customer_order`
  MODIFY `orderid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedbackId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `paymentid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cakeid_foreignKey` FOREIGN KEY (`cakeid`) REFERENCES `cake_details` (`cakeid`),
  ADD CONSTRAINT `userid_foreignkey` FOREIGN KEY (`userid`) REFERENCES `registration` (`userid`);

--
-- Constraints for table `customer_order`
--
ALTER TABLE `customer_order`
  ADD CONSTRAINT `customer_order_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `registration` (`userid`),
  ADD CONSTRAINT `customer_order_ibfk_2` FOREIGN KEY (`cakeid`) REFERENCES `cake_details` (`cakeid`),
  ADD CONSTRAINT `paymentid_fk` FOREIGN KEY (`paymentid`) REFERENCES `payment_details` (`paymentid`);

--
-- Constraints for table `login_admin`
--
-- ALTER TABLE `login_admin`
  -- ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `registration` (`userid`);

-- --
-- -- Constraints for table `login_customer`
-- --
-- ALTER TABLE `login_customer`
  -- ADD CONSTRAINT `login_customer_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `registration` (`userid`);

-- --
-- -- Constraints for table `login_deliverer`
-- --
-- ALTER TABLE `login_deliverer`
  -- ADD CONSTRAINT `login_deliverer_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `registration` (`userid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
