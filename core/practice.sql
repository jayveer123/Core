-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2022 at 06:09 AM
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
  `address` text DEFAULT NULL,
  `postal_code` int(11) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `state` varchar(10) DEFAULT NULL,
  `country` varchar(20) DEFAULT NULL,
  `billing` tinyint(1) NOT NULL DEFAULT 0,
  `shipping` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(12, 'JJ', 'DD', 'jay@g.com', '123', 1, '2022-02-25 18:02:35', '2022-02-25 19:02:21');

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
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `parent_id`, `c_name`, `c_stetus`, `path`, `createdDate`, `updatedDate`) VALUES
(179, NULL, 'bedroom', 1, '179', '2022-02-22 02:02:06', NULL),
(200, NULL, 'Kitchen', 1, '200', '2022-02-27 11:02:10', NULL),
(201, 200, 'Gas', 1, '200/201', '2022-02-27 01:02:08', NULL),
(202, 179, 'Bed', 1, '179/202', '2022-02-27 01:02:19', NULL),
(203, 202, 'King', 1, '179/202/203', '2022-02-27 01:02:27', NULL),
(204, NULL, 'Living Room', 1, '204', '2022-02-27 02:02:52', NULL),
(209, NULL, 'TV', 1, '209', '2022-02-27 03:02:41', '2022-02-27 03:02:26'),
(210, 209, 'Samsung', 1, '209/210', '2022-02-27 03:02:47', '2022-02-27 03:02:48');

-- --------------------------------------------------------

--
-- Table structure for table `category_media`
--

CREATE TABLE `category_media` (
  `imageId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `imageName` varchar(100) NOT NULL,
  `base` tinyint(1) NOT NULL DEFAULT 0,
  `thumb` tinyint(1) NOT NULL DEFAULT 0,
  `small` tinyint(1) NOT NULL DEFAULT 0,
  `gallary` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_media`
--

INSERT INTO `category_media` (`imageId`, `categoryId`, `imageName`, `base`, `thumb`, `small`, `gallary`) VALUES
(1, 179, 'demo.jpg', 0, 0, 0, 0),
(2, 179, '5.jpg', 0, 0, 0, 0),
(3, 179, '5.jpg', 0, 0, 0, 0),
(4, 179, '5.jpg', 1, 0, 0, 0),
(5, 179, '5.jpg', 0, 0, 0, 0),
(6, 179, '5.jpg', 0, 0, 0, 0),
(7, 179, '5.jpg', 0, 0, 0, 0);

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
  `base` int(11) DEFAULT 0,
  `small` int(11) DEFAULT 0,
  `thumb` int(11) DEFAULT 0,
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `p_name`, `p_price`, `p_qun`, `p_stetus`, `base`, `small`, `thumb`, `createdDate`, `updatedDate`) VALUES
(95, 'Laptop', 6000, 10, 1, 24, 26, 25, '2022-02-27 20:02:44', '2022-02-27 22:02:31');

-- --------------------------------------------------------

--
-- Table structure for table `product_media`
--

CREATE TABLE `product_media` (
  `imageId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `imageName` varchar(100) NOT NULL,
  `gallery` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_media`
--

INSERT INTO `product_media` (`imageId`, `productId`, `imageName`, `gallery`) VALUES
(24, 95, 'Screenshot_(4)20220228055329.png', 0),
(25, 95, 'Screenshot_(13)20220228060734.png', 0),
(26, 95, 'Screenshot_(12)20220228060836.png', 0);

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
-- Indexes for table `category_media`
--
ALTER TABLE `category_media`
  ADD PRIMARY KEY (`imageId`),
  ADD KEY `categoryId` (`categoryId`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_base` (`base`),
  ADD KEY `fk_small` (`small`),
  ADD KEY `fk_thumb` (`thumb`);

--
-- Indexes for table `product_media`
--
ALTER TABLE `product_media`
  ADD PRIMARY KEY (`imageId`),
  ADD KEY `fk_product_media` (`productId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;

--
-- AUTO_INCREMENT for table `category_media`
--
ALTER TABLE `category_media`
  MODIFY `imageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `product_media`
--
ALTER TABLE `product_media`
  MODIFY `imageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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

--
-- Constraints for table `category_media`
--
ALTER TABLE `category_media`
  ADD CONSTRAINT `category_media_ibfk_1` FOREIGN KEY (`categoryId`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_base` FOREIGN KEY (`base`) REFERENCES `product_media` (`imageId`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_small` FOREIGN KEY (`small`) REFERENCES `product_media` (`imageId`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_thumb` FOREIGN KEY (`thumb`) REFERENCES `product_media` (`imageId`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `product_media`
--
ALTER TABLE `product_media`
  ADD CONSTRAINT `fk_product_media` FOREIGN KEY (`productId`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
