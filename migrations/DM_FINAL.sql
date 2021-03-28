-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 28, 2021 at 09:18 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `DM_PROJECT`
--

-- --------------------------------------------------------

--
-- Table structure for table `auction`
--

CREATE TABLE `auction` (
  `auction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `valid_date` date NOT NULL,
  `description` varchar(200) NOT NULL,
  `auction_cap` int(11) NOT NULL,
  `auction_city` varchar(50) NOT NULL,
  `auction_country` varchar(50) NOT NULL,
  `auction_title` varchar(150) NOT NULL,
  `start_date` date NOT NULL,
  `reach` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auction`
--

INSERT INTO `auction` (`auction_id`, `user_id`, `valid_date`, `description`, `auction_cap`, `auction_city`, `auction_country`, `auction_title`, `start_date`, `reach`) VALUES
(40, 7, '2021-04-11', 'DAIICT is user friendly website', 0, 'Ahmedabad', 'India', 'DAIICT auction', '2021-03-17', 'world'),
(41, 8, '2021-04-23', 'test desc', 0, 'Ahmedabad', 'India', 'test auction', '2021-04-03', 'country');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `auction_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_details` varchar(200) NOT NULL,
  `base_bid` int(11) NOT NULL,
  `current_bid` int(11) NOT NULL,
  `max_bid` int(11) NOT NULL DEFAULT -1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `auction_id`, `product_name`, `product_details`, `base_bid`, `current_bid`, `max_bid`) VALUES
(11, 40, 'Testing', 'Testing', 12000, 12000, 7),
(12, 41, 'test product', 'Test desc', 12345, 20164, 7);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `t_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `money` int(11) NOT NULL,
  `auction_id` int(11) DEFAULT NULL,
  `credit_debit_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`t_id`, `user_id`, `money`, `auction_id`, `credit_debit_status`) VALUES
(54, 7, 55000, 1, 1),
(55, 7, 1000, 1, 0),
(56, 7, 15000, 1, 0),
(57, 7, 500, -1, 1),
(58, 8, 5000, 1, 0),
(59, 8, 500, -1, 1),
(60, 8, 2500000, 1, 0),
(61, 7, 50000, 1, 0),
(62, 7, 80000, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `money` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `email`, `city`, `country`, `money`) VALUES
(7, 'jenil', 'c213dde86be2b819ddb0af0d6a2ca0c9', 'jenil@jenil.com', 'Ahmedabad', 'India', 103000),
(8, 'keval', '73b6cf25fc26988d03914072cab9a6ff', 'keval@k.com', 'Ahmedabad', 'India', 2503000),
(9, 'testdummy', '6afaef1f754d434e713f89fb58a3d718', 'jenil@j.com', 'Ahmedabad', 'India', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auction`
--
ALTER TABLE `auction`
  ADD PRIMARY KEY (`auction_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auction`
--
ALTER TABLE `auction`
  MODIFY `auction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
