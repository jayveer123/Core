-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2022 at 06:37 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `practice`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `postal_code` int(11) NOT NULL,
  `city` varchar(20) NOT NULL,
  `state` varchar(10) NOT NULL,
  `country` varchar(20) NOT NULL,
  `billing` tinyint(1) NOT NULL DEFAULT 0,
  `shipping` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `customer_id`, `address`, `postal_code`, `city`, `state`, `country`, `billing`, `shipping`) VALUES
(10, 56, 'DDD', 789456, 'Demo', 'Demo', 'Demo', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL,
  `stetus` tinyint(1) NOT NULL DEFAULT 1,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `firstName`, `lastName`, `email`, `password`, `stetus`, `createdDate`, `updatedDate`) VALUES
(3, 'demo', 'demo', 'jay', 'demo', 1, '2022-02-10 14:38:20', '2022-02-10 14:46:00'),
(4, 'Jayveer', 'sinh', 'jay@g.com', '456', 1, '2022-02-10 14:40:34', '2022-02-14 14:44:31'),
(11, 'veer', 'Raj', 'edgs@g.com', '963', 1, '2022-02-21 11:02:31', '2022-02-21 22:02:17');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `c_name` varchar(50) NOT NULL,
  `c_stetus` int(11) NOT NULL DEFAULT 1,
  `path` varchar(500) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `parent_id`, `c_name`, `c_stetus`, `path`, `created_date`, `updated_date`) VALUES
(179, NULL, 'bedroom', 1, '179', '2022-02-22 02:02:06', NULL),
(180, NULL, 'LivingRoom', 1, '180', '2022-02-22 02:02:19', NULL),
(181, NULL, 'Kitchen', 1, '181', '2022-02-22 02:02:27', NULL),
(193, NULL, 'bed', 1, '193', '2022-02-22 10:02:56', NULL),
(194, 179, 'king', 1, '193/194', '2022-02-22 10:02:04', NULL),
(195, 180, 'sofa', 1, '180/195', '2022-02-22 10:02:18', NULL),
(196, 180, 'table', 1, '180/196', '2022-02-22 10:02:28', NULL),
(197, 181, 'gas', 1, '181/197', '2022-02-22 10:02:35', NULL),
(198, 181, 'drower', 1, '181/198', '2022-02-22 10:02:47', NULL),
(199, 194, 'red', 1, '193/194/199', '2022-02-22 11:02:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` bigint(10) DEFAULT NULL,
  `stetus` tinyint(1) NOT NULL,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `firstName`, `lastName`, `email`, `mobile`, `stetus`, `createdDate`, `updatedDate`) VALUES
(56, 'Raj', 'Jadeja', 'jay@g.com', 123456789, 2, '2022-02-21 11:02:57', '2022-02-22 12:02:34');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `p_name` varchar(100) NOT NULL,
  `p_price` float NOT NULL,
  `p_qun` int(10) NOT NULL,
  `p_stetus` int(11) NOT NULL DEFAULT 1,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `p_name`, `p_price`, `p_qun`, `p_stetus`, `created_date`, `updated_date`) VALUES
(82, 'Demo', 5000, 10, 1, '2022-02-20 18:02:44', NULL),
(83, 'DD', 5000, 20, 2, '2022-02-20 18:02:43', NULL),
(84, 'Jay', 100, 10, 1, '2022-02-20 22:02:52', '2022-02-20 18:02:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `address_ibfk_1` (`customer_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_ibfk_1` (`parent_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `category` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
