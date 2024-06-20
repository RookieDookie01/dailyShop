-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2024 at 04:43 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dailyshop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `credits`
--

CREATE TABLE `credits` (
  `credit_id` int(11) NOT NULL,
  `credit_num` varchar(16) NOT NULL,
  `credit_name` varchar(255) NOT NULL,
  `credit_month` varchar(255) NOT NULL,
  `credit_year` varchar(255) NOT NULL,
  `credit_cvc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `credits`
--

INSERT INTO `credits` (`credit_id`, `credit_num`, `credit_name`, `credit_month`, `credit_year`, `credit_cvc`) VALUES
(1, '1001200230034004', 'Ashraf Wajdi', '10', '01', '110');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_tracking` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_name` varchar(255) NOT NULL,
  `order_email` varchar(255) NOT NULL,
  `order_phone` varchar(255) NOT NULL,
  `order_address` varchar(255) NOT NULL,
  `order_total` decimal(10,2) NOT NULL,
  `order_cnum` varchar(255) NOT NULL,
  `order_ccvc` varchar(255) NOT NULL,
  `order_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_tracking`, `user_id`, `order_name`, `order_email`, `order_phone`, `order_address`, `order_total`, `order_cnum`, `order_ccvc`, `order_time`) VALUES
(1, 'mmuOutlet958637815280', 1, 'Ashraf Wajdi', 'ashrfwjdii@gmail.com', '0137815280', '12C Jalan Permatang 6/1', 149.90, '1001200230034004', '110', '2024-06-19 14:05:00');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_items_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` double NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_items_id`, `order_id`, `product_id`, `price`, `create_at`) VALUES
(1, 1, 4, 59.9, '2024-06-19 14:05:00'),
(2, 1, 5, 129.9, '2024-06-19 14:05:00'),
(3, 1, 8, 99.9, '2024-06-19 14:05:00'),
(4, 1, 3, 129.9, '2024-06-19 14:05:00'),
(5, 1, 2, 149.9, '2024-06-19 14:05:00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_type` varchar(255) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_type`, `product_price`, `product_image`) VALUES
(1, 'Hype Anniversary', 'Men T-shirt', 99.90, 'men (2).png'),
(2, 'Hype Long Sleeve', 'Men Casual', 149.90, 'men (4).png'),
(3, 'Straight Cut Jean', 'Men Trousers', 129.90, 'men jean.png'),
(4, 'Simpson Shirt', 'Kids T-shirt', 59.90, 'kids (5).png'),
(5, 'Harry Pootah', 'Kids Casual', 129.90, 'kid.png'),
(6, 'Kids Pants', 'Kids Trousers', 49.90, 'kids (8).png'),
(7, 'Black Crop Top', 'Women Casual', 49.90, 'women (4).png'),
(8, 'Nice Blouse ', 'Women Formal', 99.90, 'women (6).png'),
(9, 'Black Palazo', 'Women Trousers', 89.90, 'women (7).png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_fullname` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `user_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_email`, `user_fullname`, `user_password`, `user_address`, `user_phone`, `user_role`) VALUES
(1, 'ashrfwjdii@gmail.com', 'Ashraf Wajdi', 'Aaaaa111=', '12C Jalan Permatang 6/1', '0137815280', 0),
(2, 'admin@gmail.com', 'Admin', 'Aaaaa111=', '', '', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `credits`
--
ALTER TABLE `credits`
  ADD PRIMARY KEY (`credit_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_items_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `credits`
--
ALTER TABLE `credits`
  MODIFY `credit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_items_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
