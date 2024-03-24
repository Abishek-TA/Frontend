-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2024 at 05:40 PM
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
-- Database: `arrowgrub`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(11) NOT NULL DEFAULT 0,
  `Username` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `base_price` decimal(10,2) NOT NULL,
  `peak_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `Username`, `Email`, `Password`, `base_price`, `peak_price`) VALUES
(0, '', '', '', 220.00, 0.00),
(5, 'admin', 'admin@gmail.com', '1234', 120.00, 30.00);

-- --------------------------------------------------------

--
-- Table structure for table `customer_reviews`
--

CREATE TABLE `customer_reviews` (
  `review_id` int(11) NOT NULL,
  `review_text` text DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `item_name` varchar(100) DEFAULT NULL,
  `item_quantity` int(11) DEFAULT NULL,
  `item_price` decimal(10,2) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'upcoming',
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `username`, `item_name`, `item_quantity`, `item_price`, `total_price`, `status`, `order_date`) VALUES
(76, 'Abishek', 'Vegroll', 1, 150.00, 150.00, 'upcoming', '2024-03-15 04:38:54'),
(77, 'Abishek', 'Veg Sandwich', 1, 150.00, 150.00, 'upcoming', '2024-03-15 04:38:54'),
(78, 'Abishek', 'Mushroom Pizza', 1, 100.00, 100.00, 'upcoming', '2024-03-21 15:59:46'),
(79, 'Abishek', 'jtx', 1, 150.00, 150.00, 'upcoming', '2024-03-22 10:42:21'),
(80, 'Abishek', 'Vegroll', 1, 150.00, 150.00, 'upcoming', '2024-03-23 05:57:44');

-- --------------------------------------------------------

--
-- Table structure for table `reserved`
--

CREATE TABLE `reserved` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `date` date DEFAULT NULL,
  `times` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `tickets` varchar(255) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reserved`
--

INSERT INTO `reserved` (`id`, `username`, `date`, `times`, `created_at`, `tickets`, `amount`) VALUES
(144, 'Abishek', '2024-03-20', '17:00 PM', '2024-03-15 04:10:36', 't1s1, t1s2', 0),
(145, 'Abishek', '2024-03-16', '18:00 PM', '2024-03-15 04:35:35', 't1s3, t1s4, t2s2, t2s3', 0),
(146, 'Abishek', '2024-03-23', '17:00 PM', '2024-03-16 16:24:16', 't1s1, t1s2', 0),
(147, 'Abishek', '2024-03-23', '17:00 PM', '2024-03-16 18:25:57', 't1s2', 0),
(148, 'Abishek', '2024-03-23', '18:00 PM', '2024-03-21 15:10:45', 't1s2', 0),
(149, '', '2024-03-22', '17:00 PM', '2024-03-21 15:12:09', 't1s2, t3s2', 0),
(150, 'Abishek', '2024-03-23', '17:00 PM', '2024-03-21 15:59:33', 't3s4', 0),
(151, 'Abishek', '2024-03-23', '19:00 PM', '2024-03-21 16:10:43', 't1s2', 240),
(152, 'Abishek', '2024-03-23', '18:00 PM', '2024-03-22 10:41:51', 't3s2', 0),
(153, 'Abishek', '2024-03-23', '18:00 PM', '2024-03-23 05:57:25', 't2s3', 0),
(154, 'Abishek', '2024-03-30', '18:00 PM', '2024-03-23 06:57:13', 't1s1, t1s2', 0),
(155, 'Abishek', '2024-03-30', '18:00 PM', '2024-03-23 06:58:26', 't2s1, t2s2', 480),
(156, 'Abishek', '2024-03-30', '19:00 PM', '2024-03-23 07:01:20', 't1s2', 240),
(157, 'Abishek', '2024-03-30', '19:00 PM', '2024-03-23 07:02:27', 't3s4', 240),
(158, 'Abishek', '2024-03-30', '19:00 PM', '2024-03-24 15:52:09', 't1s3', 240);

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `ID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`ID`, `Username`, `Email`, `Password`) VALUES
(5, 'bhadri', 'bhadri@gmail.com', '123'),
(6, 'Abishek', 'abi@gmail.com', '123'),
(7, 'sajan', 'sajan@gmail.com', '123'),
(9, 'ram', 'ram@gmail.com', 'ram');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` double(10,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `name`, `image`, `price`) VALUES
(11, 'Chicken Burger', 'chickburger.jpg', 150.00),
(10, 'Mushroom Pizza', 'mushroom_pizza.png', 100.00),
(12, 'Chicken Gravy', 'chicken_gravy.png', 150.00),
(13, 'Chicken Pizza', 'chicken_pizza.png', 150.00),
(14, 'Chili Pizza', 'chili_pizza.png', 150.00),
(15, 'Chocolate Icecream Medium', 'chocolateice.png', 150.00),
(18, 'Falooda', 'falooda.png', 150.00),
(17, 'Crab Lollipop', 'crab-lollipop.png', 150.00),
(19, 'French Fries', 'french_fries.png', 150.00),
(20, 'Paneer Butter Masala', 'Paneer_Butter_Masala.png', 150.00),
(21, 'Shawarma', 'shawarma.png', 150.00),
(22, 'Veg Burger', 'veg_burger.png', 150.00),
(23, 'Veg Pizza', 'veg_pizza.png', 150.00),
(24, 'Veg Sandwich', 'veg_sandwich.png', 150.00),
(25, 'Vegroll', 'vegroll.png', 150.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `customer_reviews`
--
ALTER TABLE `customer_reviews`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `reserved`
--
ALTER TABLE `reserved`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer_reviews`
--
ALTER TABLE `customer_reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `reserved`
--
ALTER TABLE `reserved`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `signup`
--
ALTER TABLE `signup`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
