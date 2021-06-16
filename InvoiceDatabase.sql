-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2021 at 03:26 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `purchase_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`purchase_id`, `item_id`, `invoice_id`, `quantity`, `price`) VALUES
(61, 99, 45, 1, 25000),
(62, 99, 46, 1, 25000),
(67, 99, 51, 1, 25000),
(74, 94, 58, 1, 6000);

-- --------------------------------------------------------

--
-- Table structure for table `clientinvoice`
--

CREATE TABLE `clientinvoice` (
  `invoice_id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `paid` int(11) NOT NULL,
  `due_pay` int(11) NOT NULL,
  `client_Id` int(11) NOT NULL,
  `created_By` varchar(50) DEFAULT NULL,
  `created_Date` date DEFAULT NULL,
  `clientName` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clientinvoice`
--

INSERT INTO `clientinvoice` (`invoice_id`, `total`, `paid`, `due_pay`, `client_Id`, `created_By`, `created_Date`, `clientName`, `phone`, `email`, `address`) VALUES
(46, 25000, 4500, 20500, 110, 'Rahul', '2021-06-07', 'saurabh', '8441212121', 'saurabh@gmail.com', 'ghaza'),
(51, 25000, 4500, 20500, 130, 'Rahul', '2021-06-07', 'Rohit', '9759045632', 'rohit@gmail.com', 'ajmer');

-- --------------------------------------------------------

--
-- Table structure for table `clientmaster`
--

CREATE TABLE `clientmaster` (
  `ClientID` int(11) NOT NULL,
  `clientName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(50) NOT NULL,
  `created_Date` date DEFAULT NULL,
  `created_By` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clientmaster`
--

INSERT INTO `clientmaster` (`ClientID`, `clientName`, `email`, `phone`, `address`, `created_Date`, `created_By`) VALUES
(107, 'Kp', 'kp@gmail.com', '8441212121', 'Kanpur', '2021-05-28', 'Rahul'),
(110, 'saurabh', 'saurabh@gmail.com', '8441212121', 'ghaziabad', '2021-05-28', 'Rahul'),
(130, 'Rohit', 'rohit@gmail.com', '9759045632', 'ajmer', '2021-06-01', 'Rahul');

-- --------------------------------------------------------

--
-- Table structure for table `itemmaster`
--

CREATE TABLE `itemmaster` (
  `itemId` int(11) NOT NULL,
  `itemName` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `img` blob DEFAULT NULL,
  `link` varchar(100) DEFAULT 'https://www.youtube.com/embed/07d2dXHYb94',
  `created_By` varchar(50) DEFAULT NULL,
  `created_Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `itemmaster`
--

INSERT INTO `itemmaster` (`itemId`, `itemName`, `price`, `img`, `link`, `created_By`, `created_Date`) VALUES
(94, 'Mobile1', 6000, 0x6970686f6e65322e6a7067, 'https://www.youtube.com/embed/0LpybH5AXyA', 'Rahul', '2021-06-07'),
(99, 'Laptop', 25000, 0x6c6170746f7031312e6a7067, '', 'Rahul', '2021-06-07'),
(100, 'tablet', 8000, 0x7461626c657432312e6a7067, 'https://www.youtube.com/embed/0LpybH5AXyA', 'Rahul', '2021-06-07'),
(117, 'mobile', 11000, 0x6970686f6e6533312e6a7067, '', 'Rahul Sharma', '2021-06-09');

-- --------------------------------------------------------

--
-- Table structure for table `usermaster`
--

CREATE TABLE `usermaster` (
  `USERID` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `created_Date` date DEFAULT NULL,
  `created_By` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usermaster`
--

INSERT INTO `usermaster` (`USERID`, `userName`, `email`, `phone`, `pass`, `created_Date`, `created_By`) VALUES
(15, 'Rahul Sharma', 'rahul@gmail.com', '9856790432', 'admin', '2021-05-22', 'admin'),
(58, 'kishan', 'kishan@gmail.com', '9759045632', 'admin', '2021-06-01', 'Rahul'),
(59, 'sunny', 'sunny@gmail.com', '9759045632', 'admin', '2021-06-01', 'Rahul'),
(60, 'saurabh Sharma', 'saurabh@gmail.com', '9759045632', 'admin', '2021-06-01', 'Rahul');

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `id` int(11) NOT NULL,
  `path` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`id`, `path`) VALUES
(1, 0x687474703a2f2f6c6f63616c686f73743a38312f666f726d312f75706c6f61642f41616d5f476861725f6b615f6c61646b612e6d7034),
(2, 0x687474703a2f2f6c6f63616c686f73743a38312f666f726d312f75706c6f61642f3130305f4b695f63686170616c2e6d7034),
(3, 0x687474703a2f2f6c6f63616c686f73743a38312f666f726d312f75706c6f61642f4261646c695f4261646c695f4c6167652e6d7034),
(4, 0x687474703a2f2f6c6f63616c686f73743a38312f666f726d312f75706c6f61642f3130305f4b695f63686170616c312e6d7034);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`purchase_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `clientinvoice`
--
ALTER TABLE `clientinvoice`
  ADD PRIMARY KEY (`invoice_id`),
  ADD KEY `client_Id` (`client_Id`);

--
-- Indexes for table `clientmaster`
--
ALTER TABLE `clientmaster`
  ADD PRIMARY KEY (`ClientID`);

--
-- Indexes for table `itemmaster`
--
ALTER TABLE `itemmaster`
  ADD PRIMARY KEY (`itemId`),
  ADD UNIQUE KEY `itemName` (`itemName`);

--
-- Indexes for table `usermaster`
--
ALTER TABLE `usermaster`
  ADD PRIMARY KEY (`USERID`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `clientinvoice`
--
ALTER TABLE `clientinvoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `clientmaster`
--
ALTER TABLE `clientmaster`
  MODIFY `ClientID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `itemmaster`
--
ALTER TABLE `itemmaster`
  MODIFY `itemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `usermaster`
--
ALTER TABLE `usermaster`
  MODIFY `USERID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `billing`
--
ALTER TABLE `billing`
  ADD CONSTRAINT `billing_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `itemmaster` (`itemId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `clientinvoice`
--
ALTER TABLE `clientinvoice`
  ADD CONSTRAINT `clientinvoice_ibfk_1` FOREIGN KEY (`client_Id`) REFERENCES `clientmaster` (`ClientID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
