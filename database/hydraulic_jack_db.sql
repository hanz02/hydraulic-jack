-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2022 at 04:21 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hydraulic_jack_db`
--

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
(1, 'Jack ', 'Kang', 'Hydraulic Jack', '0000-00-00', 'male', 'admin@hydraulicjack.com', '$2y$10$qeGYUoflBUhhOUB8gcVDKeX3zMmDaXzBqp1PU5UM5W.t3VDrKaLG.', '/assets/img/default_account.png', '/assets/img/default_bg.png', 'RTST', 1, 0, 0);

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

-- --------------------------------------------------------

--
-- Table structure for table `tbl_art_product_img`
--

CREATE TABLE `tbl_art_product_img` (
  `product_img` varchar(200) NOT NULL,
  `product_id` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment_art`
--

CREATE TABLE `tbl_payment_art` (
  `payment_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` decimal(6,2) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_payment_art`
--

INSERT INTO `tbl_payment_art` (`payment_id`, `product_id`, `quantity`, `total`, `id`) VALUES
(217, 53, 1, '12.00', 27),
(218, 48, 1, '30.00', 28),
(219, 49, 1, '20.00', 29);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_id` (`payment_id`),
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
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `tbl_art_product_img`
--
ALTER TABLE `tbl_art_product_img`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `tbl_art_product_rating`
--
ALTER TABLE `tbl_art_product_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=335;

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
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=220;

--
-- AUTO_INCREMENT for table `tbl_payment_art`
--
ALTER TABLE `tbl_payment_art`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

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
-- Constraints for table `tbl_art_product_rating`
--
ALTER TABLE `tbl_art_product_rating`
  ADD CONSTRAINT `tbl_art_product_rating_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `tbl_art_product` (`product_id`),
  ADD CONSTRAINT `tbl_art_product_rating_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `tbl_client` (`client_id`);

--
-- Constraints for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD CONSTRAINT `tbl_cart_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `tbl_client` (`client_id`),
  ADD CONSTRAINT `tbl_cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `tbl_art_product` (`product_id`);

--
-- Constraints for table `tbl_client_phone_no`
--
ALTER TABLE `tbl_client_phone_no`
  ADD CONSTRAINT `tbl_client_phone_no_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `tbl_client` (`client_id`);

--
-- Constraints for table `tbl_commission`
--
ALTER TABLE `tbl_commission`
  ADD CONSTRAINT `tbl_commission_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `tbl_client` (`client_id`),
  ADD CONSTRAINT `tbl_commission_ibfk_2` FOREIGN KEY (`artist_id`) REFERENCES `tbl_artist` (`artist_id`);

--
-- Constraints for table `tbl_commission_msg`
--
ALTER TABLE `tbl_commission_msg`
  ADD CONSTRAINT `tbl_commission_msg_ibfk_1` FOREIGN KEY (`commission_id`) REFERENCES `tbl_commission` (`commission_id`);

--
-- Constraints for table `tbl_commission_ref_link`
--
ALTER TABLE `tbl_commission_ref_link`
  ADD CONSTRAINT `tbl_commission_ref_link_ibfk_1` FOREIGN KEY (`commission_id`) REFERENCES `tbl_commission` (`commission_id`);

--
-- Constraints for table `tbl_commission_ref_uploads`
--
ALTER TABLE `tbl_commission_ref_uploads`
  ADD CONSTRAINT `tbl_commission_ref_uploads_ibfk_1` FOREIGN KEY (`commission_id`) REFERENCES `tbl_commission` (`commission_id`);

--
-- Constraints for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD CONSTRAINT `tbl_payment_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `tbl_client` (`client_id`);

--
-- Constraints for table `tbl_payment_art`
--
ALTER TABLE `tbl_payment_art`
  ADD CONSTRAINT `tbl_payment_art_ibfk_1` FOREIGN KEY (`payment_id`) REFERENCES `tbl_payment` (`payment_id`),
  ADD CONSTRAINT `tbl_payment_art_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `tbl_art_product` (`product_id`);

--
-- Constraints for table `tbl_payment_commisions`
--
ALTER TABLE `tbl_payment_commisions`
  ADD CONSTRAINT `tbl_payment_commisions_ibfk_1` FOREIGN KEY (`payment_id`) REFERENCES `tbl_payment` (`payment_id`),
  ADD CONSTRAINT `tbl_payment_commisions_ibfk_2` FOREIGN KEY (`commission_id`) REFERENCES `tbl_commission` (`commission_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
