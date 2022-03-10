-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2022 at 08:00 PM
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
-- Database: `project_jayveer`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `stetus` tinyint(1) NOT NULL DEFAULT 1,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `firstName`, `lastName`, `email`, `password`, `stetus`, `createdDate`, `updatedDate`) VALUES
(22, 'Admin', 'Admin', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 1, '2022-03-10 15:03:49', '0000-00-00 00:00:00');

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
  `base` int(11) DEFAULT NULL,
  `thumb` int(11) DEFAULT NULL,
  `small` int(11) DEFAULT NULL,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `parent_id`, `c_name`, `c_stetus`, `path`, `base`, `thumb`, `small`, `createdDate`, `updatedDate`) VALUES
(252, NULL, 'aaa', 1, '252', NULL, NULL, NULL, '2022-03-09 03:03:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category_media`
--

CREATE TABLE `category_media` (
  `imageId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `imageName` varchar(100) NOT NULL,
  `gallery` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category_product`
--

CREATE TABLE `category_product` (
  `entity_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(200) NOT NULL,
  `value` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `name`, `code`, `value`, `status`, `createdDate`, `updatedDate`) VALUES
(6, 'w', 'w', 'w', 1, '2022-03-10 11:03:30', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `salesmen_id` int(11) DEFAULT NULL,
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

INSERT INTO `customer` (`id`, `salesmen_id`, `firstName`, `lastName`, `email`, `mobile`, `stetus`, `createdDate`, `updatedDate`) VALUES
(108, 12, 'a', 'a', 'a@g.coma', 123456, 1, '2022-03-09 02:03:17', '2022-03-10 12:13:10');

-- --------------------------------------------------------

--
-- Table structure for table `customer_address`
--

CREATE TABLE `customer_address` (
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

--
-- Dumping data for table `customer_address`
--

INSERT INTO `customer_address` (`address_id`, `customer_id`, `address`, `postal_code`, `city`, `state`, `country`, `billing`, `shipping`) VALUES
(24, 108, 'fddd', NULL, NULL, NULL, NULL, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `customer_price`
--

CREATE TABLE `customer_price` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `discount` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_price`
--

INSERT INTO `customer_price` (`id`, `customer_id`, `product_id`, `discount`) VALUES
(153, 108, 134, 4750),
(154, 108, 135, 190);

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `status` tinyint(1) DEFAULT 1,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `name`, `code`, `content`, `status`, `createdDate`, `updatedDate`) VALUES
(4, 'Page1', 'Code1', 'Value1', 1, '2022-03-10 22:03:44', '0000-00-00 00:00:00'),
(5, 'Page2', 'Code2', 'Value2', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Page3', 'Code3', 'Value3', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Page4', 'Code4', 'Value4', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Page5', 'Code5', 'Value5', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'Page6', 'Code6', 'Value6', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'Page7', 'Code7', 'Value7', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'Page8', 'Code8', 'Value8', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'Page9', 'Code9', 'Value9', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'Page10', 'Code10', 'Value10', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'Page11', 'Code11', 'Value11', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'Page12', 'Code12', 'Value12', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'Page13', 'Code13', 'Value13', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'Page14', 'Code14', 'Value14', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 'Page15', 'Code15', 'Value15', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 'Page16', 'Code16', 'Value16', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 'Page17', 'Code17', 'Value17', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 'Page18', 'Code18', 'Value18', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 'Page19', 'Code19', 'Value19', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 'Page20', 'Code20', 'Value20', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 'Page21', 'Code21', 'Value21', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 'Page22', 'Code22', 'Value22', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 'Page23', 'Code23', 'Value23', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 'Page24', 'Code24', 'Value24', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 'Page25', 'Code25', 'Value25', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 'Page26', 'Code26', 'Value26', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 'Page27', 'Code27', 'Value27', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 'Page28', 'Code28', 'Value28', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 'Page29', 'Code29', 'Value29', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 'Page30', 'Code30', 'Value30', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 'Page31', 'Code31', 'Value31', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 'Page32', 'Code32', 'Value32', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 'Page33', 'Code33', 'Value33', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 'Page34', 'Code34', 'Value34', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 'Page35', 'Code35', 'Value35', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 'Page36', 'Code36', 'Value36', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 'Page37', 'Code37', 'Value37', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 'Page38', 'Code38', 'Value38', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 'Page39', 'Code39', 'Value39', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 'Page40', 'Code40', 'Value40', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 'Page41', 'Code41', 'Value41', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 'Page42', 'Code42', 'Value42', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 'Page43', 'Code43', 'Value43', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 'Page44', 'Code44', 'Value44', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 'Page45', 'Code45', 'Value45', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 'Page46', 'Code46', 'Value46', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 'Page47', 'Code47', 'Value47', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 'Page48', 'Code48', 'Value48', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 'Page49', 'Code49', 'Value49', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 'Page50', 'Code50', 'Value50', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 'Page51', 'Code51', 'Value51', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, 'Page52', 'Code52', 'Value52', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, 'Page53', 'Code53', 'Value53', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 'Page54', 'Code54', 'Value54', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 'Page55', 'Code55', 'Value55', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 'Page56', 'Code56', 'Value56', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(60, 'Page57', 'Code57', 'Value57', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(61, 'Page58', 'Code58', 'Value58', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 'Page59', 'Code59', 'Value59', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 'Page60', 'Code60', 'Value60', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, 'Page61', 'Code61', 'Value61', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(65, 'Page62', 'Code62', 'Value62', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(66, 'Page63', 'Code63', 'Value63', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(67, 'Page64', 'Code64', 'Value64', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(68, 'Page65', 'Code65', 'Value65', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(69, 'Page66', 'Code66', 'Value66', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(70, 'Page67', 'Code67', 'Value67', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(71, 'Page68', 'Code68', 'Value68', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(72, 'Page69', 'Code69', 'Value69', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(73, 'Page70', 'Code70', 'Value70', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(74, 'Page71', 'Code71', 'Value71', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(75, 'Page72', 'Code72', 'Value72', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(76, 'Page73', 'Code73', 'Value73', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(77, 'Page74', 'Code74', 'Value74', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(78, 'Page75', 'Code75', 'Value75', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(79, 'Page76', 'Code76', 'Value76', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(80, 'Page77', 'Code77', 'Value77', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(81, 'Page78', 'Code78', 'Value78', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(82, 'Page79', 'Code79', 'Value79', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(83, 'Page80', 'Code80', 'Value80', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(84, 'Page81', 'Code81', 'Value81', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(85, 'Page82', 'Code82', 'Value82', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(86, 'Page83', 'Code83', 'Value83', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(87, 'Page84', 'Code84', 'Value84', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(88, 'Page85', 'Code85', 'Value85', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(89, 'Page86', 'Code86', 'Value86', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(90, 'Page87', 'Code87', 'Value87', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(91, 'Page88', 'Code88', 'Value88', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(92, 'Page89', 'Code89', 'Value89', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(93, 'Page90', 'Code90', 'Value90', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(94, 'Page91', 'Code91', 'Value91', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(95, 'Page92', 'Code92', 'Value92', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(96, 'Page93', 'Code93', 'Value93', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(97, 'Page94', 'Code94', 'Value94', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(98, 'Page95', 'Code95', 'Value95', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(99, 'Page96', 'Code96', 'Value96', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(100, 'Page97', 'Code97', 'Value97', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `p_name` varchar(100) NOT NULL,
  `p_price` float NOT NULL,
  `msp` float NOT NULL,
  `cost_price` float NOT NULL,
  `sku` varchar(10) NOT NULL,
  `p_qun` int(10) NOT NULL,
  `p_stetus` int(11) NOT NULL DEFAULT 1,
  `base` int(11) DEFAULT NULL,
  `small` int(11) DEFAULT NULL,
  `thumb` int(11) DEFAULT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `p_name`, `p_price`, `msp`, `cost_price`, `sku`, `p_qun`, `p_stetus`, `base`, `small`, `thumb`, `createdDate`, `updatedDate`) VALUES
(134, 'AAA', 5000, 4500, 300, 'AB001', 5, 1, NULL, NULL, NULL, '2022-03-09 23:03:32', NULL),
(135, 'QQQ', 200, 150, 100, 'SS002', 8, 1, NULL, NULL, NULL, '2022-03-09 23:03:19', NULL),
(136, 'd', 800, 500, 100, '20SS0', 50, 1, NULL, NULL, NULL, '2022-03-09 23:03:54', NULL);

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

-- --------------------------------------------------------

--
-- Table structure for table `salesmen`
--

CREATE TABLE `salesmen` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `margin` float(4,2) NOT NULL,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salesmen`
--

INSERT INTO `salesmen` (`id`, `firstName`, `lastName`, `email`, `mobile`, `status`, `margin`, `createdDate`, `updatedDate`) VALUES
(12, 'a', 'a', 'a@g.com', 123456789, 1, 5.00, '2022-03-09 14:03:36', '2022-03-09 22:03:02');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `id` int(11) NOT NULL,
  `firstName` varchar(1000) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_address`
--

CREATE TABLE `vendor_address` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `address` varchar(500) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `state` varchar(10) DEFAULT NULL,
  `country` varchar(20) DEFAULT NULL,
  `billing` tinyint(1) NOT NULL DEFAULT 0,
  `shipping` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

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
  ADD KEY `category_ibfk_1` (`parent_id`),
  ADD KEY `c_bese` (`base`),
  ADD KEY `c_thumb` (`thumb`),
  ADD KEY `c_small` (`small`);

--
-- Indexes for table `category_media`
--
ALTER TABLE `category_media`
  ADD PRIMARY KEY (`imageId`),
  ADD KEY `categoryId` (`categoryId`);

--
-- Indexes for table `category_product`
--
ALTER TABLE `category_product`
  ADD PRIMARY KEY (`entity_id`),
  ADD KEY `fk_product_id` (`product_id`),
  ADD KEY `fk_category_id` (`category_id`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_salesmen_id` (`salesmen_id`);

--
-- Indexes for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `address_ibfk_1` (`customer_id`);

--
-- Indexes for table `customer_price`
--
ALTER TABLE `customer_price`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
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
-- Indexes for table `salesmen`
--
ALTER TABLE `salesmen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor_address`
--
ALTER TABLE `vendor_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=255;

--
-- AUTO_INCREMENT for table `category_media`
--
ALTER TABLE `category_media`
  MODIFY `imageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `category_product`
--
ALTER TABLE `category_product`
  MODIFY `entity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT for table `customer_address`
--
ALTER TABLE `customer_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `customer_price`
--
ALTER TABLE `customer_price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT for table `product_media`
--
ALTER TABLE `product_media`
  MODIFY `imageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `salesmen`
--
ALTER TABLE `salesmen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `vendor_address`
--
ALTER TABLE `vendor_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `category_ibfk_2` FOREIGN KEY (`base`) REFERENCES `category_media` (`imageId`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `category_ibfk_3` FOREIGN KEY (`thumb`) REFERENCES `category_media` (`imageId`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `category_ibfk_4` FOREIGN KEY (`small`) REFERENCES `category_media` (`imageId`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `category_media`
--
ALTER TABLE `category_media`
  ADD CONSTRAINT `category_media_ibfk_1` FOREIGN KEY (`categoryId`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category_product`
--
ALTER TABLE `category_product`
  ADD CONSTRAINT `fk_category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `fk_salesmen_id` FOREIGN KEY (`salesmen_id`) REFERENCES `salesmen` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD CONSTRAINT `customer_address_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_price`
--
ALTER TABLE `customer_price`
  ADD CONSTRAINT `customer_price_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_price_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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

--
-- Constraints for table `vendor_address`
--
ALTER TABLE `vendor_address`
  ADD CONSTRAINT `vendor_address_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
