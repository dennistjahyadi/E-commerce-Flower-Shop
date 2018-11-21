-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2018 at 06:40 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fleurelline`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `country` varchar(150) DEFAULT NULL,
  `province` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Bouquet');

-- --------------------------------------------------------

--
-- Table structure for table `method`
--

CREATE TABLE `method` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `order_id` varchar(30) DEFAULT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `size` varchar(50) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `quantity` smallint(6) DEFAULT NULL,
  `image_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `product_name`, `size`, `price`, `quantity`, `image_name`) VALUES
(3, '1533281506', 'Cone Bouquet', 'big size', 285000, 1, '4.jpg'),
(4, '1533281506', 'Rose Bouquet', 'jumbo size', 550000, 2, '1.jpg'),
(5, '1533805939', 'Fleur de Box', 'big size', 300000, 1, '3.jpg'),
(6, '1534433419', 'Fleur de Box', 'big size', 300000, 1, '3.jpg'),
(7, '1534433419', 'Mix Flower Bouquet', 'jumbo size', 450000, 1, '2.jpg'),
(8, '1534433419', 'Cone Bouquet', 'regular size', 150000, 1, '4.jpg'),
(9, '1534433419', 'Rose Bouquet', 'regular size', 250000, 1, '1.jpg'),
(10, 'pdnpni', 'Cone Bouquet', 'regular size', 150000, 1, '4.jpg'),
(11, 'pe06m8', 'Mix Flower Bouquet', 'regular size', 185000, 2, '2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `stock` int(11) DEFAULT '0',
  `image_name` varchar(100) DEFAULT NULL,
  `new` tinyint(4) NOT NULL DEFAULT '1',
  `active` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `category_id`, `name`, `description`, `stock`, `image_name`, `new`, `active`) VALUES
(1, 1, 'Rose Bouquet', 'test', 0, '1.jpg', 1, 1),
(2, 1, 'Mix Flower Bouquet', 'test', 0, '2.jpg', 1, 1),
(3, 1, 'Fleur de Box', 'test', 0, '3.jpg', 1, 0),
(4, 1, 'Cone Bouquet', 'test', 0, '4.jpg', 0, 1),
(5, 1, 'a', 'asdf', 0, '5b7814dcd3846.jpg', 1, 1),
(6, 1, 'a (blue)', 'asdf blue', 0, '5b7815d458b93.jpg', 1, 0),
(7, 1, 'a', 'sdaffds', 0, '5b80f47569c07.jpg', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`id`, `product_id`, `name`) VALUES
(1, 1, '1.jpg'),
(2, 2, '2.jpg'),
(3, 3, '3.jpg'),
(4, 4, '4.jpg'),
(5, 1, '5.jpg'),
(6, 6, '5b65fd809c424.jpg'),
(10, 8, '5b6607dee71d7.jpg'),
(23, 9, '5b75aee476920.jpg'),
(24, 10, '5b75bc978ab41.png'),
(25, 5, '5b7814dcd3846.jpg'),
(26, 5, '5b78157d34d14.jpg'),
(27, 5, '5b781584675ca.jpg'),
(28, 6, '5b7815d458b93.jpg'),
(29, 7, '5b80f47569c07.jpg'),
(30, 7, '5b80f4df2419f.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_size`
--

CREATE TABLE `product_size` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `size_id` int(11) DEFAULT NULL,
  `dimension` varchar(50) NOT NULL,
  `flower_amount` varchar(50) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_size`
--

INSERT INTO `product_size` (`id`, `product_id`, `size_id`, `dimension`, `flower_amount`, `price`) VALUES
(1, 1, 1, '25 cm', '30 roses', 250000),
(2, 1, 2, '30 cm', '50 roses', 350000),
(3, 1, 3, '35 cm', '75 roses', 550000),
(4, 1, 4, '40 cm', '100 roses', 750000),
(5, 2, 1, '25 cm', '20 flowers', 185000),
(6, 2, 2, '30 cm', '40 flowers', 285000),
(7, 2, 3, '35 cm', '60 flowers', 450000),
(8, 2, 4, '40 cm', '80 flowers', 550000),
(9, 3, 2, '30 - 35 cm', 'fit', 300000),
(10, 4, 1, '18 - 20 cm', '15 flowers', 150000),
(11, 4, 2, '25 - 30 cm', '40 flowers', 285000),
(14, 6, 1, '10 cm', '10 roses', 85000),
(15, 5, 1, '20 cm', '30 roses', 130000),
(16, 7, 1, '25 cm', '30 roses', 200000);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `rate` tinyint(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `role_group`
--

CREATE TABLE `role_group` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role_group`
--

INSERT INTO `role_group` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'customer');

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `id` int(11) NOT NULL,
  `name` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`id`, `name`) VALUES
(1, 'regular size'),
(2, 'big size'),
(3, 'jumbo size'),
(4, 'giant size');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(1, 'new'),
(2, 'payment verification'),
(3, 'progress'),
(4, 'complete'),
(11, 'canceled');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nickname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_group_id` int(2) NOT NULL DEFAULT '2',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `nickname`, `address`, `role_group_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'test', 'test@test.com', '$2y$10$CXQqTIYNyKGj5fjx6vzJrODXH.5QNuyljY6AXOF2aRuVkA2XnB42K', 'test1', NULL, 2, 'i8SKrSOShxzhVJpMeNzfRtuKWnavUVt0twljPYgCicRKwr9m8CuE3cM1fyjw', '2018-06-15 01:17:28', '2018-06-15 01:17:28'),
(2, 'haha', 'haha@haha.com', '$2y$10$zjkMGiHXVeFe39uAecE2Q.1soFy9mH/df8xaz2U4fM3MyAdW2jTXC', 'haha', NULL, 2, 'bUYODChogViTmJUMkYpgOSmq56tAndgGONEWZG8RONmM2rYFPwFPCCyax3WU', '2018-07-17 00:59:35', '2018-07-17 00:59:35'),
(3, 'admin', 'admin@fleurelline.com', '$2y$10$cl1KtgZ2W1YUTt.g3y1nQOoq5ykt2YR9NQvblWR.dYqS09dPdjMF2', 'admin', NULL, 1, 'i9ImYjpUkp1ufQLjTdSLBLSk39kkF2fQss8O10u2mPUs5RW7pbcavICqb9n4', '2018-07-24 11:48:14', '2018-07-24 11:48:14');

-- --------------------------------------------------------

--
-- Table structure for table `user_orders`
--

CREATE TABLE `user_orders` (
  `id` varchar(50) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address` text,
  `transfered_to` varchar(50) DEFAULT NULL,
  `customer_bank_account_number` varchar(100) DEFAULT NULL,
  `customer_bank_account_name` varchar(255) DEFAULT NULL,
  `customer_payment_amount` int(11) NOT NULL DEFAULT '0',
  `customer_transfer_date` datetime DEFAULT NULL,
  `status_id` smallint(6) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `finished_at` timestamp NULL DEFAULT NULL,
  `no_resi` varchar(255) DEFAULT NULL,
  `courir` varchar(50) DEFAULT NULL,
  `method_id` smallint(6) DEFAULT NULL,
  `description` text,
  `promo_code` varchar(50) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `province` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `proof_image` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_orders`
--

INSERT INTO `user_orders` (`id`, `email`, `fullname`, `phone_number`, `address`, `transfered_to`, `customer_bank_account_number`, `customer_bank_account_name`, `customer_payment_amount`, `customer_transfer_date`, `status_id`, `created_at`, `finished_at`, `no_resi`, `courir`, `method_id`, `description`, `promo_code`, `country`, `province`, `city`, `postal_code`, `proof_image`) VALUES
('1533281506', NULL, 'Muliyadi', '081215485552', 'Jl apel mangga manis no 23', '(BCA) Momo 2548545852', 'sdf', 'Muliyadi', 30000, '2017-10-18 00:00:00', 4, '2018-08-04 06:33:15', '2018-03-31 17:00:00', '214', 'jne', 1, NULL, NULL, 'Indonesia', 'Jawa Timur', 'Surabaya', '60245', '1533281506.png'),
('1533805939', NULL, 'Jeff', '081254562358', 'Jl apel mangga manis no 23', '(BCA) Momo 2548545852', '0856993458', 'Jeff Rey', 300000, '2018-08-09 00:00:00', 4, '2018-08-09 02:12:19', '2018-08-11 17:00:00', '1548548+15647651454', 'jne', 1, NULL, NULL, 'Indonesia', 'Jawa Timur', 'Surabaya', '60245', '1533805939.png'),
('pdnpni', NULL, 'Kiki Jaya', '081215458555', 'jl apel manis no 12', '(BCA) Momo 2548545852', '123123', 'Kiki Jaya', 1150000, '2018-10-10 00:00:00', 4, '2018-08-18 05:35:42', '2018-08-20 17:00:00', '124', 'jne', 1, NULL, NULL, 'Indonesia', 'Jawa Timur', 'Surabaya', '60022', 'pdnpni.png'),
('pe06m8', NULL, 'Kiki Jaya', '081215458555', 'jl apel manis no 12', NULL, NULL, NULL, 0, NULL, 4, '2018-08-24 23:13:20', '2018-04-07 17:00:00', '123', 'jne', 1, NULL, NULL, 'Indonesia', 'Jawa Timur', 'Surabaya', '60022', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `method`
--
ALTER TABLE `method`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_size`
--
ALTER TABLE `product_size`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_group`
--
ALTER TABLE `role_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_orders`
--
ALTER TABLE `user_orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `method`
--
ALTER TABLE `method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `product_size`
--
ALTER TABLE `product_size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `role_group`
--
ALTER TABLE `role_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
