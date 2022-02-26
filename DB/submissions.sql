-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2022 at 11:57 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE `submissions` (
  `id` int(20) NOT NULL,
  `amount` int(10) NOT NULL,
  `buyer` varchar(255) NOT NULL,
  `receipt_id` varchar(20) NOT NULL,
  `items` varchar(255) NOT NULL,
  `buyer_email` varchar(50) NOT NULL,
  `buyer_ip` varchar(20) NOT NULL,
  `note` text NOT NULL,
  `city` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `hash_key` varchar(255) NOT NULL,
  `entry_at` date NOT NULL,
  `entry_by` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`id`, `amount`, `buyer`, `receipt_id`, `items`, `buyer_email`, `buyer_ip`, `note`, `city`, `phone`, `hash_key`, `entry_at`, `entry_by`) VALUES
(1, 1000, 'Mike', 'MIO', 'Shirt, Pent etc', 'mike@test.com', '::1', 'This is product is good', 'Dhaka', '8801623477299', '564556ffb9c3998382228f2a64f2d136455cf77dcd4b65aa58a287c964def362100504e8ad99b65ebfc658e2f0d6b71136ae15609cff4be5a1e9631409e6ecfb', '2022-02-25', 10),
(2, 2000, 'Luce`', 'GHI', 'Panjabi, Pens', 'luce@luce.com', '::1', 'High quality product', 'Dhaka', '880162347790', '0910ad5d9c27b5677f4c97432791206e3863d01d9b18e1478cb39e5fea993d16bdacbe61ddd3ad5e0712ec4c988f6fca368763cf72076a57b1d15bd9639ace3a', '2022-02-25', 20),
(3, 3000, 'Rahim', 'MKL', 'Pens, Copy etc', 'rahim@test.com', '::1', 'Good products', 'Dhaka', '8801715025159', 'd16432e34abda802626cdc0142deddfe78fd48160c6a6e1558a98d276db4130f5481ba9b8b066ebe88ca564618aafa9c85b6cf5cb761e4d37993665d9c2c7c20', '2022-02-25', 30),
(9, 6000, 'Tiger', 'SDB', 'Bike, Car', 'tiger@test.com', '::1', 'High quality', 'Dhaka', '8801815025157', 'f4cfcbe53c792e70d3de4473b1d3a7558aa22c87bc9eebe6b881d34db7cdb2f383a8483a50cf1678e01b7828bfc64a95534263f4591e72eaf5b9792d04c9e52f', '2022-02-25', 30),
(10, 1000, 'Karim', 'MMD', 'Pens, Pencil', 'karim@test.com', '::1', 'Nice product', 'Dhaka', '8801623477990', '41c0eec1bf90a5b8e1083683a5341ebe5e9327a3399ac48e9c9f1543fb9344a8b3fb1c4525d91099c8961a392ace58ab26ac8c8065e009d20c168b08ebc0b91b', '2022-02-26', 25);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `submissions`
--
ALTER TABLE `submissions`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
