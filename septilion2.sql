-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2018 at 11:47 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `septilion2`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `ID_Category` int(11) NOT NULL,
  `Name_Category` varchar(20) DEFAULT NULL,
  `Description` varchar(20) DEFAULT NULL,
  `Icon_Category` varchar(20) DEFAULT NULL,
  `Created_By_IDEmp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `ID_CLIENT` int(11) NOT NULL,
  `Mail` varchar(20) DEFAULT NULL,
  `Password` varchar(20) DEFAULT NULL,
  `First_name` varchar(20) DEFAULT NULL,
  `Last_name` varchar(20) DEFAULT NULL,
  `Adress` varchar(20) DEFAULT NULL,
  `Phone_Number` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `ID_Employee` int(11) NOT NULL,
  `Mail` varchar(20) DEFAULT NULL,
  `Password` varchar(20) DEFAULT NULL,
  `First_name` varchar(20) DEFAULT NULL,
  `Last_name` varchar(20) DEFAULT NULL,
  `Adress` varchar(20) DEFAULT NULL,
  `Phone_Number` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `ID_Product` int(11) NOT NULL,
  `ID_CLIENT` int(11) NOT NULL,
  `Review` int(11) DEFAULT NULL,
  `Comment` varchar(500) DEFAULT NULL,
  `Date_feedBack` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `is_ordred`
--

CREATE TABLE `is_ordred` (
  `ID_ORDER` int(11) NOT NULL,
  `ID_Product` int(11) NOT NULL,
  `Quantity_ORDRED` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `ID_Message` int(11) NOT NULL,
  `Message_Object` varchar(20) DEFAULT NULL,
  `Message_Body` varchar(20) DEFAULT NULL,
  `ID_Emp_Sender` int(11) DEFAULT NULL,
  `ID_Emp_Reciever` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_client`
--

CREATE TABLE `order_client` (
  `ID_ORDER` int(11) NOT NULL,
  `Date_Order` date DEFAULT NULL,
  `Description` varchar(1000) DEFAULT NULL,
  `Price` float DEFAULT NULL,
  `ID_client` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ID_PRODUCT` int(11) NOT NULL,
  `Name_PRODUCT` varchar(20) DEFAULT NULL,
  `STOCK_Quantity` int(11) DEFAULT NULL,
  `Description` varchar(20) DEFAULT NULL,
  `Price` decimal(10,0) DEFAULT NULL,
  `Image` varchar(20) DEFAULT NULL,
  `Created_By_IDEmp` int(11) DEFAULT NULL,
  `Last_update_By_IDEmp` int(11) DEFAULT NULL,
  `ID_Category` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`ID_Category`),
  ADD KEY `par_ind` (`Created_By_IDEmp`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`ID_CLIENT`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`ID_Employee`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`ID_Product`,`ID_CLIENT`),
  ADD KEY `par_cli` (`ID_Product`,`ID_CLIENT`),
  ADD KEY `ID_CLIENT` (`ID_CLIENT`);

--
-- Indexes for table `is_ordred`
--
ALTER TABLE `is_ordred`
  ADD PRIMARY KEY (`ID_ORDER`,`ID_Product`),
  ADD KEY `par_order` (`ID_ORDER`,`ID_Product`),
  ADD KEY `ID_Product` (`ID_Product`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`ID_Message`),
  ADD KEY `parS_ind` (`ID_Emp_Sender`),
  ADD KEY `parR_ind` (`ID_Emp_Reciever`);

--
-- Indexes for table `order_client`
--
ALTER TABLE `order_client`
  ADD PRIMARY KEY (`ID_ORDER`),
  ADD KEY `par_client` (`ID_client`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ID_PRODUCT`),
  ADD KEY `par_created` (`Created_By_IDEmp`),
  ADD KEY `par_update` (`Last_update_By_IDEmp`),
  ADD KEY `par_category` (`ID_Category`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `ID_Category` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `ID_CLIENT` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `ID_Employee` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `ID_Message` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_client`
--
ALTER TABLE `order_client`
  MODIFY `ID_ORDER` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ID_PRODUCT` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`Created_By_IDEmp`) REFERENCES `employee` (`ID_Employee`) ON DELETE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`ID_CLIENT`) REFERENCES `client` (`ID_CLIENT`) ON DELETE CASCADE,
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`ID_Product`) REFERENCES `product` (`ID_PRODUCT`) ON DELETE CASCADE;

--
-- Constraints for table `is_ordred`
--
ALTER TABLE `is_ordred`
  ADD CONSTRAINT `is_ordred_ibfk_1` FOREIGN KEY (`ID_ORDER`) REFERENCES `order_client` (`ID_ORDER`) ON DELETE CASCADE,
  ADD CONSTRAINT `is_ordred_ibfk_2` FOREIGN KEY (`ID_Product`) REFERENCES `product` (`ID_PRODUCT`) ON DELETE CASCADE;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`ID_Emp_Sender`) REFERENCES `employee` (`ID_Employee`) ON DELETE CASCADE,
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`ID_Emp_Reciever`) REFERENCES `employee` (`ID_Employee`) ON DELETE CASCADE;

--
-- Constraints for table `order_client`
--
ALTER TABLE `order_client`
  ADD CONSTRAINT `order_client_ibfk_1` FOREIGN KEY (`ID_client`) REFERENCES `client` (`ID_CLIENT`) ON DELETE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`Created_By_IDEmp`) REFERENCES `employee` (`ID_Employee`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`Last_update_By_IDEmp`) REFERENCES `employee` (`ID_Employee`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_ibfk_3` FOREIGN KEY (`ID_Category`) REFERENCES `category` (`ID_Category`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
