-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2020 at 11:53 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webapi`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_coupon`
--

CREATE TABLE `tb_coupon` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `discount` bigint(20) NOT NULL,
  `start_time` int(11) NOT NULL,
  `end_time` int(11) NOT NULL,
  `type` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'percent'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tb_coupon`
--

INSERT INTO `tb_coupon` (`id`, `name`, `discount`, `start_time`, `end_time`, `type`) VALUES
(1, 'voucher 50%', 50, 1594708773, 1596047973, 'percent'),
(2, 'voucher 1000000', 1000000, 1594708773, 1597343973, 'vnd'),
(3, 'voucher 20%', 20, 1594708773, 1597343973, 'percent'),
(4, 'voucher 2tr', 2000000, 1602527973, 1597343973, 'vnd');

-- --------------------------------------------------------

--
-- Table structure for table `tb_customer`
--

CREATE TABLE `tb_customer` (
  `id` bigint(20) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `referral` bigint(20) DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tb_customer`
--

INSERT INTO `tb_customer` (`id`, `email`, `password`, `phone`, `name`, `referral`, `is_admin`, `status`) VALUES
(1, 'hoatv@ninjateam.vn', '$2y$10$hEqb2MJCSG2HqvXf.19EPei.aEBbrg38.7B/FrYm8GXbivkdZkzKO', '0979090897', 'Trần Văn Hòa', 0, 1, 'unlock'),
(2, 'ducthuanx12@gmail.com', '$2y$10$hEqb2MJCSG2HqvXf.19EPei.aEBbrg38.7B/FrYm8GXbivkdZkzKO', '0123456789', 'Nguyễn Đức Thuận', 1, 0, 'unlock'),
(3, 'havantam.it@gmail.com', '$2y$10$hEqb2MJCSG2HqvXf.19EPei.aEBbrg38.7B/FrYm8GXbivkdZkzKO', '9876543210', 'Hà Văn Tâm', 1, 0, 'unlock'),
(4, 'lethehung@gmail.com', '$2y$10$93qpTOte.EQrWArxaKQmp.4lcXg4SuIG2Gksih/5KEb7SimVo8wwa', '1236549870', 'capon', 2, 0, 'lock');

-- --------------------------------------------------------

--
-- Table structure for table `tb_facebook`
--

CREATE TABLE `tb_facebook` (
  `id` bigint(20) NOT NULL,
  `uid` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` text CHARACTER SET utf8mb4 NOT NULL,
  `customer_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tb_facebook`
--

INSERT INTO `tb_facebook` (`id`, `uid`, `name`, `token`, `customer_id`) VALUES
(3, '100048131084317', 'Nguyễn Đức Thuận', 'EAAAAUaZA8jlABAEQTBuXRGoC5lZAmUKwD7onThuUfHSUq37HKo0ZByVgxZBfvNI05QtcSHy5iTdPqtB7hd3XHK6TRltnWCroNZAe9dnSg4rrHpvM4xK8M9OrRZBkOP2qkmFqGsHKxbMGqOsKIZCDhEBEzsLA1FkyZBE1S7f9VFoVxSIZBXqWPztEK', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_package`
--

CREATE TABLE `tb_package` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` bigint(20) NOT NULL,
  `time` int(11) NOT NULL,
  `number_account` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tb_package`
--

INSERT INTO `tb_package` (`id`, `name`, `price`, `time`, `number_account`) VALUES
(1, 'gói 30 ngày', 2000000, 30, 10),
(2, 'Gói 60 ngày', 6000000, 60, 15);

-- --------------------------------------------------------

--
-- Table structure for table `tb_sale`
--

CREATE TABLE `tb_sale` (
  `id` bigint(20) NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `package_id` int(11) NOT NULL,
  `start_time` int(11) NOT NULL DEFAULT 1,
  `end_time` int(11) NOT NULL DEFAULT 0,
  `price` bigint(20) NOT NULL,
  `coupon_id` int(11) DEFAULT NULL,
  `total_money` bigint(20) NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unlock',
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tb_sale`
--

INSERT INTO `tb_sale` (`id`, `customer_id`, `package_id`, `start_time`, `end_time`, `price`, `coupon_id`, `total_money`, `status`, `note`) VALUES
(1, 1, 2, 1594708773, 1599892773, 6000000, 4, 4000000, 'unlock', 'use voucher 2tr'),
(2, 2, 1, 1594776296, 1597368296, 2000000, 1, 1000000, 'unlock', 'use voucher 50%'),
(3, 2, 1, 1597368296, 1599960296, 2000000, NULL, 2000000, 'unlock', 'not use voucher 50%'),
(4, 1, 1, 1594786599, 1597378599, 2000000, 3, 1600000, 'lock', 'use voucher 20%'),
(6, 1, 2, 1602527973, 1607711973, 6000000, 1, 3000000, 'unlock', 'use voucher 50%');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_coupon`
--
ALTER TABLE `tb_coupon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_customer`
--
ALTER TABLE `tb_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_facebook`
--
ALTER TABLE `tb_facebook`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_package`
--
ALTER TABLE `tb_package`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_sale`
--
ALTER TABLE `tb_sale`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_coupon`
--
ALTER TABLE `tb_coupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_customer`
--
ALTER TABLE `tb_customer`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_facebook`
--
ALTER TABLE `tb_facebook`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_package`
--
ALTER TABLE `tb_package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_sale`
--
ALTER TABLE `tb_sale`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
