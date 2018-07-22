-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2018 at 11:27 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pizza`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `address` text,
  `status` int(11) DEFAULT NULL COMMENT '0 = read; 1 = new;',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `address`, `status`, `updated_at`, `created_at`) VALUES
(1, 123, 'Western Bicutan', 1, '2018-01-26 22:22:25', '2018-01-26 22:22:25'),
(2, 124, 'Taguig City', 1, '2018-01-26 22:22:44', '2018-01-26 22:22:44'),
(3, 125, 'Taguig City', 1, '2018-01-26 22:23:00', '2018-01-26 22:23:00');

-- --------------------------------------------------------

--
-- Table structure for table `pizza_order`
--

CREATE TABLE `pizza_order` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `size` text,
  `crust` text,
  `type` text,
  `whole` int(11) DEFAULT NULL,
  `first` int(11) DEFAULT NULL,
  `second` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pizza_order`
--

INSERT INTO `pizza_order` (`id`, `order_id`, `size`, `crust`, `type`, `whole`, `first`, `second`) VALUES
(1, 123, '\r\nlarge', '\r\nhand-tossed', 'custom', 2, 1, 1),
(2, 123, '\r\nmedium', '\r\ndeep-dish', '\r\npepperonifeast', 0, 0, 0),
(3, 124, '\r\nlarge', '\r\nhand-tossed', 'custom', 2, 0, 0),
(4, 125, '\r\nlarge', '\r\nhand-tossed', 'custom', 2, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pizza_toppings`
--

CREATE TABLE `pizza_toppings` (
  `id` int(11) NOT NULL,
  `pizza_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `area` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pizza_toppings`
--

INSERT INTO `pizza_toppings` (`id`, `pizza_id`, `name`, `area`) VALUES
(1, 1, 'Pepperoni', 0),
(2, 1, 'Extracheese', 0),
(3, 1, 'Sausage', 1),
(4, 1, 'Mushroom', 2),
(5, 3, 'Pepperoni', 0),
(6, 3, 'Extracheese', 0),
(7, 4, 'Pepperoni', 0),
(8, 4, 'Extracheese', 0),
(9, 4, 'Pepperoni', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pizza_order`
--
ALTER TABLE `pizza_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pizza_toppings`
--
ALTER TABLE `pizza_toppings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pizza_order`
--
ALTER TABLE `pizza_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `pizza_toppings`
--
ALTER TABLE `pizza_toppings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
