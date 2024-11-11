-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2024 at 02:59 PM
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
-- Database: `smallbrain`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `usertype` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL,
  `review` varchar(255) NOT NULL,
  `agent_name` varchar(255) NOT NULL,
  `agent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `usertype`, `rating`, `review`, `agent_name`, `agent_id`) VALUES
(1, 'buyer', 4, 'good', 'Liam Collins', 2),
(2, 'seller', 5, 'excellent', 'Liam Collins', 2),
(3, 'buyer', 2, 'bad', 'Liam Collins', 2),
(4, 'seller', 3, 'average', 'Liam Collins', 2),
(5, 'seller', 4, 'good', 'Isabella White', 7),
(6, 'buyer', 3, 'average', 'Isabella White', 7),
(7, 'seller', 5, 'excellent', 'Isabella White', 7),
(8, 'buyer', 1, 'bad', 'Isabella White', 7),
(9, 'buyer', 5, 'excellent', 'Ava Thompson', 11),
(10, 'seller', 2, 'bad', 'Ava Thompson', 11),
(11, 'buyer', 3, 'average', 'Ava Thompson', 11),
(12, 'seller', 4, 'good', 'Ava Thompson', 11),
(13, 'seller', 1, 'bad', 'Emma Clark', 15),
(14, 'buyer', 4, 'good', 'Emma Clark', 15),
(15, 'seller', 3, 'average', 'Emma Clark', 15),
(16, 'buyer', 5, 'excellent', 'Emma Clark', 15),
(17, 'buyer', 3, 'average', 'Charlotte Carter', 19),
(18, 'seller', 4, 'good', 'Charlotte Carter', 19),
(19, 'buyer', 5, 'excellent', 'Charlotte Carter', 19),
(20, 'seller', 2, 'bad', 'Charlotte Carter', 19),
(21, 'seller', 5, 'excellent', 'Ryan Allen', 35),
(22, 'buyer', 3, 'average', 'Ryan Allen', 35),
(23, 'seller', 4, 'good', 'Ryan Allen', 35),
(24, 'buyer', 2, 'bad', 'Ryan Allen', 35),
(25, 'buyer', 4, 'good', 'Alice Lopez', 39),
(26, 'seller', 5, 'excellent', 'Alice Lopez', 39),
(27, 'buyer', 3, 'average', 'Alice Lopez', 39),
(28, 'seller', 1, 'bad', 'Alice Lopez', 39),
(29, 'seller', 3, 'average', 'Victoria Allen', 59),
(30, 'buyer', 5, 'excellent', 'Victoria Allen', 59),
(31, 'seller', 2, 'bad', 'Victoria Allen', 59),
(32, 'buyer', 4, 'good', 'Victoria Allen', 59),
(33, 'buyer', 5, 'excellent', 'James Adams', 51),
(34, 'seller', 3, 'average', 'James Adams', 51),
(35, 'buyer', 2, 'bad', 'James Adams', 51),
(36, 'seller', 4, 'good', 'James Adams', 51),
(37, 'seller', 5, 'excellent', 'Elijah Gonzalez', 71),
(38, 'buyer', 4, 'good', 'Elijah Gonzalez', 71),
(39, 'seller', 3, 'average', 'Elijah Gonzalez', 71),
(40, 'buyer', 1, 'bad', 'Elijah Gonzalez', 71),
(41, 'buyer', 4, 'good', 'Sophia Evans', 55),
(42, 'seller', 5, 'excellent', 'Sophia Evans', 55),
(43, 'buyer', 2, 'bad', 'Sophia Evans', 55),
(44, 'seller', 3, 'average', 'Sophia Evans', 55),
(45, 'seller', 4, 'good', 'William Hill', 21),
(46, 'buyer', 3, 'average', 'William Hill', 21),
(47, 'seller', 5, 'excellent', 'William Hill', 21),
(48, 'buyer', 1, 'bad', 'William Hill', 21),
(49, 'buyer', 5, 'excellent', 'Chloe Rivera', 37),
(50, 'seller', 2, 'bad', 'Chloe Rivera', 37),
(51, 'buyer', 4, 'good', 'Chloe Rivera', 37),
(52, 'seller', 3, 'average', 'Chloe Rivera', 37),
(53, 'seller', 5, 'excellent', 'Henry Roberts', 57),
(54, 'buyer', 3, 'average', 'Henry Roberts', 57),
(55, 'seller', 4, 'good', 'Henry Roberts', 57),
(56, 'buyer', 2, 'bad', 'Henry Roberts', 57),
(57, 'buyer', 3, 'average', 'Alice Johnson', 31),
(58, 'seller', 5, 'excellent', 'Alice Johnson', 31),
(59, 'buyer', 1, 'bad', 'Alice Johnson', 31),
(60, 'seller', 4, 'good', 'Alice Johnson', 31),
(61, 'seller', 3, 'average', 'Jack Harris', 61),
(62, 'buyer', 5, 'excellent', 'Jack Harris', 61),
(63, 'seller', 2, 'bad', 'Jack Harris', 61),
(64, 'buyer', 4, 'good', 'Jack Harris', 61),
(65, 'buyer', 4, 'good', 'Amelia Nelson', 29),
(66, 'seller', 5, 'excellent', 'Amelia Nelson', 29),
(67, 'buyer', 2, 'bad', 'Amelia Nelson', 29),
(68, 'seller', 3, 'average', 'Amelia Nelson', 29),
(69, 'seller', 4, 'good', 'David Clark', 49),
(70, 'buyer', 3, 'average', 'David Clark', 49),
(71, 'seller', 5, 'excellent', 'David Clark', 49),
(72, 'buyer', 1, 'bad', 'David Clark', 49),
(73, 'buyer', 5, 'excellent', 'Lily Wright', 41),
(74, 'seller', 3, 'average', 'Lily Wright', 41),
(75, 'buyer', 4, 'good', 'Lily Wright', 41),
(76, 'seller', 2, 'bad', 'Lily Wright', 41),
(77, 'seller', 4, 'good', 'Ethan Martinez', 67),
(78, 'buyer', 3, 'average', 'Ethan Martinez', 67),
(79, 'seller', 5, 'excellent', 'Ethan Martinez', 67),
(80, 'buyer', 1, 'bad', 'Ethan Martinez', 67),
(81, 'buyer', 3, 'average', 'Sophia Lee', 83),
(82, 'seller', 5, 'excellent', 'Sophia Lee', 83),
(83, 'buyer', 1, 'bad', 'Sophia Lee', 83),
(84, 'seller', 4, 'good', 'Sophia Lee', 83),
(85, 'seller', 2, 'bad', 'Michael Perez', 99),
(86, 'buyer', 5, 'excellent', 'Michael Perez', 99),
(87, 'seller', 4, 'good', 'Michael Perez', 99),
(88, 'buyer', 3, 'average', 'Michael Perez', 99),
(89, 'buyer', 5, 'excellent', 'Benjamin Hernandez', 95),
(90, 'seller', 2, 'bad', 'Benjamin Hernandez', 95),
(91, 'buyer', 4, 'good', 'Benjamin Hernandez', 95),
(92, 'seller', 3, 'average', 'Benjamin Hernandez', 95),
(93, 'seller', 4, 'good', 'Hannah Lee', 73),
(94, 'buyer', 3, 'average', 'Hannah Lee', 73),
(95, 'seller', 5, 'excellent', 'Hannah Lee', 73),
(96, 'buyer', 1, 'bad', 'Hannah Lee', 73),
(97, 'buyer', 5, 'excellent', 'Lucas Mitchell', 77),
(98, 'seller', 3, 'average', 'Lucas Mitchell', 77),
(99, 'buyer', 4, 'good', 'Lucas Mitchell', 77),
(100, 'seller', 2, 'bad', 'Lucas Mitchell', 77);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
