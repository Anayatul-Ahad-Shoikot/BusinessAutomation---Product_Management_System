-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2024 at 04:48 PM
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
-- Database: `product_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) NOT NULL,
  `product_code` int(20) NOT NULL,
  `warehouse_code` int(20) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_type` varchar(255) NOT NULL,
  `product_ammount` int(10) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_availability` int(2) NOT NULL DEFAULT 1,
  `product_created` varchar(100) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_code`, `warehouse_code`, `product_name`, `product_price`, `product_type`, `product_ammount`, `product_image`, `product_availability`, `product_created`) VALUES
(1, 7081, 199747, 'Detos', 15.00, 'food', 25, 'detos.jpg', 1, '2024-09-02 10:28:44'),
(2, 1234, 926329, 'Rice', 50.00, 'Grain', 10, 'rice.jpg', 1, '2024-09-02 10:57:51'),
(3, 5678, 199747, 'Sugar', 40.00, 'Sweetener', 6, 'sugar.jpg', 1, '2024-09-02 10:57:51'),
(7, 1881, 926329, 'BBQ Chanachur', 27.00, 'food', 35, 'project_ababil.jpg', 1, '2024-09-02 11:31:00'),
(8, 3052, 122747, 'soap', 15.00, 'grosary', 10, 'wp9324262-4k-neon-sign-wallpapers.jpg', 1, '2024-09-02 20:15:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(10) NOT NULL,
  `user_code` int(20) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `password` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `user_code`, `fname`, `lname`, `email`, `phone`, `password`) VALUES
(1, 30355895, 'Anayatul Ahad', 'Shoikot', 'ahad@gmail.com', '01973336001', '$2y$10$V/Gm6z7Jl5tCtZyk1IWWzOa3d24LoxP1zRgvTHbc1casFuofBraAa'),
(6, 17089035, 'tt', 't', 't@gmail.com', '01312404674', '$2y$10$DMlLMSaT4mmIMEtyurzQ7ewDn8iXZZ6w8NpH4uSwEHNJsj345jvi2'),
(7, 73376316, 'sayma', 'shetu', 'S@gmail.com', '01333600231', '$2y$10$TyugSENEQGJ94bEkbsSLkuMjXgWQSZIl69HOXGXWgDi07QLfo8kSS');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE `warehouse` (
  `w_id` int(10) NOT NULL,
  `warehouse_code` int(20) NOT NULL,
  `user_code` int(20) NOT NULL,
  `warehouse_name` varchar(255) NOT NULL,
  `warehouse_image` varchar(255) NOT NULL,
  `warehouse_status` text NOT NULL DEFAULT 'Good',
  `warehouse_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `warehouse`
--

INSERT INTO `warehouse` (`w_id`, `warehouse_code`, `user_code`, `warehouse_name`, `warehouse_image`, `warehouse_status`, `warehouse_created`) VALUES
(1, 199747, 30355895, 'Ahad\'s Store', 'python.jpg', 'Good', '2024-09-02'),
(6, 122747, 17089035, 'tttt', 'project_ababil.jpg', 'Good', '2024-09-02'),
(7, 926329, 73376316, 'setu\'s store', 'user.png', 'Good', '2024-09-02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`w_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `w_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
