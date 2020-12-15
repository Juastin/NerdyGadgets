-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2020 at 03:15 PM
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
-- Database: `nerdygadgets_simple`
--

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `orderId` bigint(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `postalcode` varchar(10) NOT NULL,
  `email` int(100) NOT NULL,
  `totalprice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_line`
--

CREATE TABLE `order_line` (
  `orderlineId` int(11) NOT NULL,
  `orderId` bigint(20) NOT NULL,
  `stocktemId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `reviewId` int(11) NOT NULL,
  `reviewer` int(11) NOT NULL,
  `review` varchar(1000) NOT NULL,
  `stockitem` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`reviewId`, `reviewer`, `review`, `stockitem`, `date`) VALUES
(1, 8, 'Leuk man', 17, '2020-12-09 15:52:55'),
(2, 8, 'wakwkaka', 17, '2020-12-09 17:12:55'),
(3, 8, 'allemachtig wat gooeeed', 17, '2020-12-09 17:13:01');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `firstName` varchar(45) NOT NULL,
  `middleName` varchar(45) DEFAULT NULL,
  `lastName` varchar(45) NOT NULL,
  `password` varchar(100) NOT NULL,
  `postalCode` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `city` varchar(45) NOT NULL,
  `address` varchar(100) NOT NULL,
  `houseNumber` varchar(45) NOT NULL,
  `tel` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `firstName`, `middleName`, `lastName`, `password`, `postalCode`, `email`, `city`, `address`, `houseNumber`, `tel`) VALUES
(1, 'Jan', '', 'Klomp', '$2y$10$LfiQTqAAudXZkew1CGuAYu4GkTG0RJbqdVNgVzKBcvY2Op5uKImNW', '9292GG', 'Hoi@live.nl', 'Almere', 'Tokkiebuurt ', '666', '06882772'),
(7, 'Kaas', '', 'Koek', '$2y$10$d4aL8xj3qXIG8AEtIlj3se0IMVbxLC7GLMai8gkCDFPO6X.ZS6kHm', '8203KA', 'Kaaskoekjes@gmail.com', 'Kaasland', 'Kaashoek', '42', '061223345'),
(8, 'Justin', '', 'Kaas', '$2y$10$FU.vg5A.Vk.bg8uooPuRwufd5t.3jokYjnmDQ3c6A5BOTnMiDb4CC', '4242', 'Kaas@live.nl', 'Kaas', 'Kaas', '42', '4242'),
(10, 'Justin', '', 'Passchier', '$2y$10$y69wH3BHBOxoOdyWi0iGGueDYhFWYI9PTqGkcsg3kWF.Ts38Uwh/i', '8282AZ', 'Kaasman@live.nl', 'Kaasland', 'Kaasstraat', '382', '33232');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`orderId`);

--
-- Indexes for table `order_line`
--
ALTER TABLE `order_line`
  ADD PRIMARY KEY (`orderlineId`),
  ADD KEY `orderId` (`orderId`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`reviewId`),
  ADD KEY `reviewer` (`reviewer`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `userId` (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `orderId` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_line`
--
ALTER TABLE `order_line`
  MODIFY `orderlineId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `reviewId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_line`
--
ALTER TABLE `order_line`
  ADD CONSTRAINT `orderId` FOREIGN KEY (`orderId`) REFERENCES `order` (`orderId`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`reviewer`) REFERENCES `user` (`userId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
