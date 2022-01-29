-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 28, 2022 at 04:01 PM
-- Server version: 10.5.12-MariaDB
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id18354860_hjdb`
--
CREATE DATABASE IF NOT EXISTS `id18354860_hjdb` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `id18354860_hjdb`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_artist`
--

CREATE TABLE `tbl_artist` (
  `artist_id` int(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(20) NOT NULL,
  `email` varchar(70) NOT NULL,
  `password` varchar(300) NOT NULL,
  `profile_img` varchar(100) DEFAULT NULL,
  `cover_img` varchar(100) DEFAULT NULL,
  `ID_prefix` varchar(10) NOT NULL,
  `commission_status` int(11) NOT NULL,
  `profile_img_state` int(11) NOT NULL,
  `cover_img_state` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_artist`
--

INSERT INTO `tbl_artist` (`artist_id`, `first_name`, `last_name`, `user_name`, `dob`, `gender`, `email`, `password`, `profile_img`, `cover_img`, `ID_prefix`, `commission_status`, `profile_img_state`, `cover_img_state`) VALUES
(1, 'Jack ', 'Kang', 'Hydraulic Jack', '0000-00-00', 'male', 'user2140@hotmail.com', '$2y$10$qeGYUoflBUhhOUB8gcVDKeX3zMmDaXzBqp1PU5UM5W.t3VDrKaLG.', '/assets/img/default_account.png', '/assets/img/default_bg.png', 'RTST', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_artist_phone_no`
--

CREATE TABLE `tbl_artist_phone_no` (
  `phone_no` int(11) NOT NULL,
  `artist_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_artist_rating`
--

CREATE TABLE `tbl_artist_rating` (
  `rating` int(11) NOT NULL,
  `artist_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_art_product`
--

CREATE TABLE `tbl_art_product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_descript` varchar(300) NOT NULL,
  `stock_amount` int(11) NOT NULL,
  `product_status` varchar(20) NOT NULL,
  `ID_prefix` varchar(10) NOT NULL,
  `amount_sold` int(11) NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `artist_id` int(11) NOT NULL,
  `date_added` date NOT NULL,
  `total_revenue` decimal(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_art_product`
--

INSERT INTO `tbl_art_product` (`product_id`, `product_name`, `product_descript`, `stock_amount`, `product_status`, `ID_prefix`, `amount_sold`, `price`, `artist_id`, `date_added`, `total_revenue`) VALUES
(1, '2 Soldiers Digital Remastered Illustration ver 2', '2 Soldiers Digital Remaster DESCRIPTION', 90, 'show', 'ILLUS', 13, 39.99, 1, '2021-04-14', 519.87),
(2, ' Reality Disco Style Jack Face', 'Reality Disco Style Jack Face DESCRIPTION', 90, 'show', 'ILLUS', 20, 50.99, 1, '2021-04-12', 1019.80),
(3, '[VA-11 Hall-A] Julianne Stingray Room Illustration', '[VA-11 Hall-A] Julianne Stingray Room Illustration DESCRIPTION', 93, 'show', 'ILLUS', 8, 520.00, 1, '2021-04-13', 3692.00),
(4, '[The Crew 2] Fanart Illustration Car', '[The Crew 2] Fanart Illustration DESCRIPTION', 100, 'show', 'ILLUS', 27, 60.00, 1, '2021-04-15', 1593.00),
(5, 'The Corridor Illustration', 'The Corridor Illustration DESCRIPTION', 96, 'show', 'ILLUS', 7, 30.00, 1, '2021-04-14', 120.00),
(34, 'No smoking Illust', 'No Smoking', 17, 'show', 'ILLUS', 3, 30.00, 1, '2022-01-27', 90.00),
(35, 'Rubik\'s Cube Illust', 'Rubik Cube Illust Description\r\n\r\n\"person’s face (the Rubik\'s cube) and society (the hands) changes the face cuz it’s not good enough for them\"', 20, 'show', 'ILLUS', 0, 50.00, 1, '2022-01-28', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_art_product_img`
--

CREATE TABLE `tbl_art_product_img` (
  `product_img` varchar(200) NOT NULL,
  `product_id` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_art_product_img`
--

INSERT INTO `tbl_art_product_img` (`product_img`, `product_id`, `id`) VALUES
('assets/img/ready_artworks/2 soldiers digital remaster.jpg', 1, 1),
('assets/img/ready_artworks/jill_s room.jpg', 3, 3),
('assets/img/ready_artworks/The Crew 2 fanart.jpg', 4, 4),
('assets/img/ready_artworks/Corridor.jpg', 5, 5),
('assets/img/ready_artworks/73685ce117db7f5bc906fbcf3ce06c95.jpg', 31, 34),
('assets/img/ready_artworks/5c77ac95c7593c867cb3e59bae2bf8d6.jpg', 32, 35),
('assets/img/ready_artworks/7561f371058fed4721204b6eec6fbb2e.jpg', 34, 37),
('assets/img/ready_artworks/da0b1843269da78462e425627877dcdb.jpg', 35, 38);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_art_product_rating`
--

CREATE TABLE `tbl_art_product_rating` (
  `id` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_art_product_rating`
--

INSERT INTO `tbl_art_product_rating` (`id`, `rating`, `product_id`, `client_id`) VALUES
(65, 5, 3, 13),
(66, 4, 34, 13);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cart_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `ID_prefix` varchar(10) NOT NULL,
  `client_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`cart_id`, `quantity`, `ID_prefix`, `client_id`, `product_id`) VALUES
(224, 1, 'CRT', 14, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client`
--

CREATE TABLE `tbl_client` (
  `client_id` int(11) NOT NULL,
  `dob` date NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `password` varchar(300) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `profile_img` varchar(200) DEFAULT NULL,
  `ID_prefix` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `profile_img_state` int(11) NOT NULL,
  `bg_img` varchar(300) DEFAULT NULL,
  `bg_img_state` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_client`
--

INSERT INTO `tbl_client` (`client_id`, `dob`, `first_name`, `last_name`, `password`, `gender`, `profile_img`, `ID_prefix`, `email`, `username`, `profile_img_state`, `bg_img`, `bg_img_state`) VALUES
(13, '2002-09-13', 'Han Zhe', 'Khaw', '$2y$10$8HBNJ9daObpUnmtc4ThE4.S.scfvOkzAjD/UQeaKMFK7SiP73adNe', 'male', '7f6ad180232d3e0c86a32b7c0a9ce12e.jpg', 'CNT', 'hanz@gmail.com', 'HanZ_02', 1, '9f2d9669bc74c796d0479109dfadc706.jpg', 1),
(14, '2022-01-18', 'Nimama', 'De pussy', '$2y$10$Fy68JEPYEqXgIR3bA.lbdu7rTByK1EURikOWflVG6v3kLWEqv8QaW', 'female', '/assets/img/default_account.png', 'CNT', 'henhaochi@yahoo.com.my', 'Nig', 0, '/assets/img/default_bg.jpg', 0),
(15, '2000-08-29', 'Claye', 'Lupescar', '$2y$10$qDjzdhVgvOA9vlRqZu4K5./kgo3dRKQs.DNQzzdX6/r.CZuuEc3kO', 'male', '/assets/img/default_account.png', 'CNT', 'clayelupescar@gmail.com', 'Lupescar', 0, '/assets/img/default_bg.jpg', 0),
(16, '2022-01-03', 'Something', 'Wong', '$2y$10$bwuVnfxpvrs/VT2qIk8BdO.ujVjzmCLqzC6zcJWElJ7wj8qAVGxoq', 'male', '/assets/img/default_account.png', 'CNT', 'sw@gmail.com', 'sw_99', 0, '/assets/img/default_bg.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client_phone_no`
--

CREATE TABLE `tbl_client_phone_no` (
  `phone_no` int(11) NOT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_commission`
--

CREATE TABLE `tbl_commission` (
  `commission_id` int(11) NOT NULL,
  `commission_date` date NOT NULL,
  `commission_type` varchar(20) NOT NULL,
  `commission_descript` varchar(500) NOT NULL,
  `commission_price` int(11) NOT NULL,
  `ID_prefix` varchar(10) NOT NULL,
  `client_id` int(11) NOT NULL,
  `artist_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_commission_msg`
--

CREATE TABLE `tbl_commission_msg` (
  `commission_msg` int(11) NOT NULL,
  `commission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_commission_ref_link`
--

CREATE TABLE `tbl_commission_ref_link` (
  `ref_link` varchar(300) NOT NULL,
  `commission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_commission_ref_uploads`
--

CREATE TABLE `tbl_commission_ref_uploads` (
  `ref_uploads` int(11) NOT NULL,
  `commission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `payment_id` int(11) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_amount` decimal(9,2) NOT NULL,
  `transaction_type` varchar(20) NOT NULL,
  `ID_prefix` varchar(10) NOT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_payment`
--

INSERT INTO `tbl_payment` (`payment_id`, `payment_date`, `payment_amount`, `transaction_type`, `ID_prefix`, `client_id`) VALUES
(155, '2022-01-27', 520.00, 'online_banking', 'PYMT', 13),
(156, '2022-01-27', 520.00, 'online_banking', 'PYMT', 13),
(157, '2022-01-27', 90.00, 'online_banking', 'PYMT', 13);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment_art`
--

CREATE TABLE `tbl_payment_art` (
  `payment_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_payment_art`
--

INSERT INTO `tbl_payment_art` (`payment_id`, `product_id`, `quantity`, `total`) VALUES
(155, 3, 1, 520.00),
(156, 3, 1, 520.00),
(157, 34, 3, 90.00);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment_commisions`
--

CREATE TABLE `tbl_payment_commisions` (
  `payment_id` int(11) NOT NULL,
  `commission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_artist`
--
ALTER TABLE `tbl_artist`
  ADD PRIMARY KEY (`artist_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tbl_artist_phone_no`
--
ALTER TABLE `tbl_artist_phone_no`
  ADD KEY `artist_id` (`artist_id`);

--
-- Indexes for table `tbl_artist_rating`
--
ALTER TABLE `tbl_artist_rating`
  ADD KEY `artist_id` (`artist_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `tbl_art_product`
--
ALTER TABLE `tbl_art_product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `artist_id` (`artist_id`);

--
-- Indexes for table `tbl_art_product_img`
--
ALTER TABLE `tbl_art_product_img`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `tbl_art_product_rating`
--
ALTER TABLE `tbl_art_product_rating`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cart_id`,`client_id`,`product_id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `tbl_client`
--
ALTER TABLE `tbl_client`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `tbl_client_phone_no`
--
ALTER TABLE `tbl_client_phone_no`
  ADD PRIMARY KEY (`phone_no`,`client_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `tbl_commission`
--
ALTER TABLE `tbl_commission`
  ADD PRIMARY KEY (`commission_id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `artist_id` (`artist_id`);

--
-- Indexes for table `tbl_commission_msg`
--
ALTER TABLE `tbl_commission_msg`
  ADD PRIMARY KEY (`commission_msg`,`commission_id`),
  ADD KEY `commission_id` (`commission_id`);

--
-- Indexes for table `tbl_commission_ref_link`
--
ALTER TABLE `tbl_commission_ref_link`
  ADD PRIMARY KEY (`ref_link`,`commission_id`),
  ADD KEY `commission_id` (`commission_id`);

--
-- Indexes for table `tbl_commission_ref_uploads`
--
ALTER TABLE `tbl_commission_ref_uploads`
  ADD PRIMARY KEY (`ref_uploads`,`commission_id`),
  ADD KEY `commission_id` (`commission_id`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `tbl_payment_art`
--
ALTER TABLE `tbl_payment_art`
  ADD PRIMARY KEY (`payment_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `tbl_payment_commisions`
--
ALTER TABLE `tbl_payment_commisions`
  ADD PRIMARY KEY (`payment_id`,`commission_id`),
  ADD KEY `commission_id` (`commission_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_artist`
--
ALTER TABLE `tbl_artist`
  MODIFY `artist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_art_product`
--
ALTER TABLE `tbl_art_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tbl_art_product_img`
--
ALTER TABLE `tbl_art_product_img`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tbl_art_product_rating`
--
ALTER TABLE `tbl_art_product_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=225;

--
-- AUTO_INCREMENT for table `tbl_client`
--
ALTER TABLE `tbl_client`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_commission`
--
ALTER TABLE `tbl_commission`
  MODIFY `commission_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_artist_phone_no`
--
ALTER TABLE `tbl_artist_phone_no`
  ADD CONSTRAINT `tbl_artist_phone_no_ibfk_1` FOREIGN KEY (`artist_id`) REFERENCES `tbl_artist` (`artist_id`);

--
-- Constraints for table `tbl_artist_rating`
--
ALTER TABLE `tbl_artist_rating`
  ADD CONSTRAINT `tbl_artist_rating_ibfk_1` FOREIGN KEY (`artist_id`) REFERENCES `tbl_artist` (`artist_id`),
  ADD CONSTRAINT `tbl_artist_rating_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `tbl_client` (`client_id`);

--
-- Constraints for table `tbl_art_product`
--
ALTER TABLE `tbl_art_product`
  ADD CONSTRAINT `tbl_art_product_ibfk_1` FOREIGN KEY (`artist_id`) REFERENCES `tbl_artist` (`artist_id`);

--
-- Constraints for table `tbl_art_product_img`
--
ALTER TABLE `tbl_art_product_img`
  ADD CONSTRAINT `tbl_art_product_img_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `tbl_art_product` (`product_id`) ON DELETE NO ACTION;

--
-- Constraints for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD CONSTRAINT `tbl_cart_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `tbl_client` (`client_id`),
  ADD CONSTRAINT `tbl_cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `tbl_art_product` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
