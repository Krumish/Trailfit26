-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2024 at 07:13 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(20, 18, 'Kish Leyble', '1234', 'kevin@gmail.com', 'cash on delivery', 'flat no. rome street, santa cruz, Antipolo City, philippines - 1870', 'Sabre Bib Pant Men\'s (5)', 20000, '25-Nov-2024', 'pending'),
(21, 18, 'Kish Leyble', '1234', 'kevin@gmail.com', 'cash on delivery', 'flat no. rome street, santa cruz, Antipolo City, philippines - 1870', 'Bird Head Toque (5)', 7500, '25-Nov-2024', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `details`, `price`, `image`, `category`, `stock`) VALUES
(31, 'Bird Head Toque', 'Warm, comfortable toque made from a blend of wool and recycled polyester.', 1500, 'arc3-2.png', 'bonnet', 5),
(32, 'Venta Glove', ' Lightweight, windproof, breathable, weather-resistant GORE-TEX INFINIUM™ gloves. \r\n', 2200, 'arc4-1.png', 'gloves', 10),
(33, 'Sabre Bib Pant Men\'s', 'Durable, versatile GORE-TEX ePE freeride ski and snowboard bib with progressive design.', 4000, 'arc5-1.png', 'pants', 5),
(34, 'Sabre Pant Men\'s', 'Durable, versatile GORE-TEX ePE freeride ski and snowboard pant with progressive design.', 3500, 'arc6-2.png', 'pants', 8),
(35, 'Rho Lightweight Wool Balaclava', 'Versatile Merino wool balaclava providing warmth with multiple wear options.', 2000, 'arc7-2.png', 'balaclava', 20),
(36, 'Micon 32 Backpack', 'Warm, comfortable toque made from a blend of wool and recycled polyester.', 6500, 'arc8-3.png', 'backpack', 10),
(37, 'Grotto Toque', 'Warm, versatile 100% recycled polyester toque performs on and off the mountain.', 550, 'arc9-1.png', 'bonnet', 10),
(38, 'Bird Word Toque', 'Warm, versatile 100% recycled polyester toque performs on and off the mountain.', 550, 'arc10-1.png', 'bonnet', 2),
(39, 'Kragg Insulated Shoe Women\'s', 'Warm, supportive mid-height shoe for quick approaches and recovery after the climb.', 3550, 'arc11-1.png', 'shoes', 3),
(40, 'Beta Down Mitten', 'Down\'s warmth with water-repellent protection – a go-to for wet winter cold.', 1250, 'arc12-1.png', 'gloves', 4),
(41, 'Micon LiTRIC™ 32 Avalanche Air backpack', 'Fully featured 32L backcountry avalanche air backpack capable of multiple deployments.', 7450, 'arc13-1.png', 'backpack', 2),
(42, 'Sentinel Jacket Women\'s', 'Warm, versatile 100% recycled polyester toque performs on and off the mountain.', 3450, 'arc14-1.png', 'jacket', 1),
(43, 'Sentinel Pant Women\'s', 'Our iconic GORE-TEX ePE pant for the backcountry and resort.', 2250, 'arc15-1.png', 'pants', 2),
(44, 'Allium Insulated Jacket Women\'s', 'Insulated, breathable jacket that wears as a midlayer or standalone, on or off the snow.', 4150, 'arc16-1.png', 'pants', 3),
(45, 'Merino Wool Low Cut Sock', 'Versatile Merino-blend sock delivering comfort and technical performance.', 450, 'arc17-1.png', 'socks', 3),
(46, 'Acrux AR GTX Boot', 'A pinnacle of design for mountaineering, ice and mixed climbing, the Acrux AR is the lightest, most durable, and lowest profile insulated double boot available. AR: All-Round.', 4450, 'arc18-1.png', 'shoes', 0),
(47, 'Acrux Women’s Boot', 'Warm, supportive mid-height shoe for quick approaches and recovery after the climb.', 2450, 'arc19-1.png', 'shoes', 0),
(48, 'Kopec Mid GTX Boot Men\'s', 'Waterproof mid-height hiking shoe for fast and light travel on shifting terrain.', 3450, 'arc20-1.png', 'shoes', 4),
(49, 'Ionia Merino Wool Logo Shirt SS Men\'s', 'Versatile, comfortable wool-blend logo tee for a wide range of mountain activities.', 880, 'arc21-1.png', 'tshirt', 2),
(50, 'Norvan Balaclava', 'Mountain runner’s merino-blend balaclava with multiple wear options.', 450, 'arc22-1.png', 'balaclava', 3),
(51, 'Sabre Jacket Print Men\'s', 'GORE-TEX jacket for the backcountry and resort.', 3500, 'arc2-3.png', 'jacket', 4),
(52, 'Macai Jacket Men\'s', 'Warm, down-insulated GORE-TEX jacket for on-piste skiing and snowboarding.', 5500, 'arc1-2.png', 'jacket', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(10, 'admin A', 'admin01@gmail.com', '698d51a19d8a121ce581499d7b701668', 'admin'),
(14, 'user A', 'user01@gmail.com', '698d51a19d8a121ce581499d7b701668', 'user'),
(15, 'user B', 'user02@gmail.com', '698d51a19d8a121ce581499d7b701668', 'user'),
(16, 'moses', 'moses@email.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'admin'),
(18, 'kevin', 'kevin@gmail.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
