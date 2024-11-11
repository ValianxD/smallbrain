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
-- Table structure for table `favourites`
--

CREATE TABLE `favourites` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `model` varchar(255) NOT NULL,
  `make` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `car_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favourites`
--

INSERT INTO `favourites` (`id`, `user_id`, `car_id`, `model`, `make`, `price`, `car_image`) VALUES
(1, 1, 1, 'Model S', 'Tesla', 80000, 'uploads/bluecar.jpg'),
(2, 1, 2, 'Corolla', 'Toyota', 20000, 'uploads/greencar.jpg'),
(3, 1, 3, 'Civic', 'Honda', 22000, 'uploads/redcar.jpg'),
(4, 1, 4, 'Mustang', 'Ford', 35000, 'uploads/yellowcar.jpg'),
(5, 1, 5, 'Accord', 'Honda', 25000, 'uploads/bluecar.jpg'),
(6, 2, 6, 'Camry', 'Toyota', 27000, 'uploads/greencar.jpg'),
(7, 2, 7, 'Charger', 'Dodge', 30000, 'uploads/redcar.jpg'),
(8, 2, 8, 'Explorer', 'Ford', 40000, 'uploads/yellowcar.jpg'),
(9, 2, 9, 'Model X', 'Tesla', 90000, 'uploads/bluecar.jpg'),
(10, 2, 10, 'Altima', 'Nissan', 24000, 'uploads/greencar.jpg'),
(11, 3, 11, 'Mazda3', 'Mazda', 21000, 'uploads/redcar.jpg'),
(12, 3, 12, 'Impala', 'Chevrolet', 29000, 'uploads/yellowcar.jpg'),
(13, 3, 13, '3 Series', 'BMW', 45000, 'uploads/bluecar.jpg'),
(14, 3, 14, 'C-Class', 'Mercedes', 55000, 'uploads/greencar.jpg'),
(15, 3, 15, 'A4', 'Audi', 48000, 'uploads/redcar.jpg'),
(16, 4, 16, 'Optima', 'Kia', 23000, 'uploads/yellowcar.jpg'),
(17, 4, 17, 'Elantra', 'Hyundai', 21000, 'uploads/bluecar.jpg'),
(18, 4, 18, 'Jetta', 'Volkswagen', 22000, 'uploads/greencar.jpg'),
(19, 4, 19, 'Impreza', 'Subaru', 25000, 'uploads/redcar.jpg'),
(20, 4, 20, 'Fusion', 'Ford', 27000, 'uploads/yellowcar.jpg'),
(21, 5, 21, 'Model 3', 'Tesla', 60000, 'uploads/bluecar.jpg'),
(22, 5, 22, 'Prius', 'Toyota', 24000, 'uploads/greencar.jpg'),
(23, 5, 23, 'Insight', 'Honda', 23000, 'uploads/redcar.jpg'),
(24, 5, 24, 'Escape', 'Ford', 32000, 'uploads/yellowcar.jpg'),
(25, 5, 25, 'Fit', 'Honda', 20000, 'uploads/bluecar.jpg'),
(26, 6, 26, 'Yaris', 'Toyota', 19000, 'uploads/greencar.jpg'),
(27, 6, 27, 'Durango', 'Dodge', 42000, 'uploads/redcar.jpg'),
(28, 6, 28, 'Edge', 'Ford', 38000, 'uploads/yellowcar.jpg'),
(29, 6, 29, 'Model Y', 'Tesla', 70000, 'uploads/bluecar.jpg'),
(30, 6, 30, 'Versa', 'Nissan', 18000, 'uploads/greencar.jpg'),
(31, 7, 31, 'CX-5', 'Mazda', 31000, 'uploads/redcar.jpg'),
(32, 7, 32, 'Malibu', 'Chevrolet', 26000, 'uploads/yellowcar.jpg'),
(33, 7, 33, 'X3', 'BMW', 54000, 'uploads/bluecar.jpg'),
(34, 7, 34, 'GLA', 'Mercedes', 60000, 'uploads/greencar.jpg'),
(35, 7, 35, 'Q5', 'Audi', 65000, 'uploads/redcar.jpg'),
(36, 8, 36, 'Seltos', 'Kia', 22000, 'uploads/yellowcar.jpg'),
(37, 8, 37, 'Tucson', 'Hyundai', 28000, 'uploads/bluecar.jpg'),
(38, 8, 38, 'Passat', 'Volkswagen', 27000, 'uploads/greencar.jpg'),
(39, 8, 39, 'Outback', 'Subaru', 32000, 'uploads/redcar.jpg'),
(40, 8, 40, 'Ranger', 'Ford', 37000, 'uploads/yellowcar.jpg'),
(41, 9, 41, 'Cybertruck', 'Tesla', 75000, 'uploads/bluecar.jpg'),
(42, 9, 42, 'Highlander', 'Toyota', 45000, 'uploads/greencar.jpg'),
(43, 9, 43, 'Pilot', 'Honda', 43000, 'uploads/redcar.jpg'),
(44, 9, 44, 'Bronco', 'Ford', 48000, 'uploads/yellowcar.jpg'),
(45, 9, 45, 'Ridgeline', 'Honda', 40000, 'uploads/bluecar.jpg'),
(46, 10, 46, 'Tacoma', 'Toyota', 38000, 'uploads/greencar.jpg'),
(47, 10, 47, 'Ram', 'Dodge', 60000, 'uploads/redcar.jpg'),
(48, 10, 48, 'F-150', 'Ford', 55000, 'uploads/yellowcar.jpg'),
(49, 10, 49, 'Roadster', 'Tesla', 120000, 'uploads/bluecar.jpg'),
(50, 10, 50, 'Titan', 'Nissan', 49000, 'uploads/greencar.jpg'),
(51, 11, 31, 'CX-5', 'Mazda', 31000, 'uploads/redcar.jpg'),
(52, 11, 32, 'Malibu', 'Chevrolet', 26000, 'uploads/yellowcar.jpg'),
(53, 11, 33, 'X3', 'BMW', 54000, 'uploads/bluecar.jpg'),
(54, 11, 34, 'GLA', 'Mercedes', 60000, 'uploads/greencar.jpg'),
(55, 11, 35, 'Q5', 'Audi', 65000, 'uploads/redcar.jpg'),
(56, 12, 36, 'Seltos', 'Kia', 22000, 'uploads/yellowcar.jpg'),
(57, 12, 37, 'Tucson', 'Hyundai', 28000, 'uploads/bluecar.jpg'),
(58, 12, 38, 'Passat', 'Volkswagen', 27000, 'uploads/greencar.jpg'),
(59, 12, 39, 'Outback', 'Subaru', 32000, 'uploads/redcar.jpg'),
(60, 12, 40, 'Ranger', 'Ford', 37000, 'uploads/yellowcar.jpg'),
(61, 13, 41, 'Cybertruck', 'Tesla', 75000, 'uploads/bluecar.jpg'),
(62, 13, 42, 'Highlander', 'Toyota', 45000, 'uploads/greencar.jpg'),
(63, 13, 43, 'Pilot', 'Honda', 43000, 'uploads/redcar.jpg'),
(64, 13, 44, 'Bronco', 'Ford', 48000, 'uploads/yellowcar.jpg'),
(65, 13, 45, 'Ridgeline', 'Honda', 40000, 'uploads/bluecar.jpg'),
(66, 14, 46, 'Tacoma', 'Toyota', 38000, 'uploads/greencar.jpg'),
(67, 14, 47, 'Ram', 'Dodge', 60000, 'uploads/redcar.jpg'),
(68, 14, 48, 'F-150', 'Ford', 55000, 'uploads/yellowcar.jpg'),
(69, 14, 49, 'Roadster', 'Tesla', 120000, 'uploads/bluecar.jpg'),
(70, 14, 50, 'Titan', 'Nissan', 49000, 'uploads/greencar.jpg'),
(71, 15, 51, 'Mazda6', 'Mazda', 26000, 'uploads/redcar.jpg'),
(72, 15, 52, 'Colorado', 'Chevrolet', 35000, 'uploads/yellowcar.jpg'),
(73, 15, 53, '5 Series', 'BMW', 70000, 'uploads/bluecar.jpg'),
(74, 15, 54, 'E-Class', 'Mercedes', 75000, 'uploads/greencar.jpg'),
(75, 15, 55, 'A6', 'Audi', 72000, 'uploads/redcar.jpg'),
(76, 16, 56, 'Sorento', 'Kia', 33000, 'uploads/yellowcar.jpg'),
(77, 16, 57, 'Santa Fe', 'Hyundai', 34000, 'uploads/bluecar.jpg'),
(78, 16, 58, 'Atlas', 'Volkswagen', 37000, 'uploads/greencar.jpg'),
(79, 16, 59, 'Ascent', 'Subaru', 40000, 'uploads/redcar.jpg'),
(80, 16, 60, 'Expedition', 'Ford', 80000, 'uploads/yellowcar.jpg'),
(81, 17, 61, 'Semi', 'Tesla', 150000, 'uploads/bluecar.jpg'),
(82, 17, 62, 'Sequoia', 'Toyota', 65000, 'uploads/greencar.jpg'),
(83, 17, 63, 'Passport', 'Honda', 45000, 'uploads/redcar.jpg'),
(84, 17, 64, 'Transit', 'Ford', 50000, 'uploads/yellowcar.jpg'),
(85, 17, 65, 'CR-V', 'Honda', 30000, 'uploads/bluecar.jpg'),
(86, 18, 66, 'RAV4', 'Toyota', 32000, 'uploads/greencar.jpg'),
(87, 18, 67, 'Journey', 'Dodge', 29000, 'uploads/redcar.jpg'),
(88, 18, 68, 'EcoSport', 'Ford', 25000, 'uploads/yellowcar.jpg'),
(89, 18, 69, 'Model Y', 'Tesla', 69000, 'uploads/bluecar.jpg'),
(90, 18, 70, 'Kicks', 'Nissan', 23000, 'uploads/greencar.jpg'),
(91, 19, 71, 'CX-30', 'Mazda', 27000, 'uploads/redcar.jpg'),
(92, 19, 72, 'Traverse', 'Chevrolet', 36000, 'uploads/yellowcar.jpg'),
(93, 19, 73, 'X5', 'BMW', 82000, 'uploads/bluecar.jpg'),
(94, 19, 74, 'GLE', 'Mercedes', 85000, 'uploads/greencar.jpg'),
(95, 19, 75, 'Q7', 'Audi', 83000, 'uploads/redcar.jpg'),
(96, 20, 76, 'Telluride', 'Kia', 45000, 'uploads/yellowcar.jpg'),
(97, 20, 77, 'Venue', 'Hyundai', 19000, 'uploads/bluecar.jpg'),
(98, 20, 78, 'Tiguan', 'Volkswagen', 33000, 'uploads/greencar.jpg'),
(99, 20, 79, 'Forester', 'Subaru', 31000, 'uploads/redcar.jpg'),
(100, 20, 80, 'Flex', 'Ford', 34000, 'uploads/yellowcar.jpg'),
(101, 21, 81, 'Model X', 'Tesla', 95000, 'uploads/bluecar.jpg'),
(102, 21, 82, '4Runner', 'Toyota', 42000, 'uploads/greencar.jpg'),
(103, 21, 83, 'Element', 'Honda', 25000, 'uploads/redcar.jpg'),
(104, 21, 84, 'Maverick', 'Ford', 28000, 'uploads/yellowcar.jpg'),
(105, 21, 85, 'HR-V', 'Honda', 22000, 'uploads/bluecar.jpg'),
(106, 22, 86, 'Land Cruiser', 'Toyota', 85000, 'uploads/greencar.jpg'),
(107, 22, 87, 'Challenger', 'Dodge', 35000, 'uploads/redcar.jpg'),
(108, 22, 88, 'Taurus', 'Ford', 33000, 'uploads/yellowcar.jpg'),
(109, 22, 89, 'Model 3', 'Tesla', 50000, 'uploads/bluecar.jpg'),
(110, 22, 90, 'Pathfinder', 'Nissan', 40000, 'uploads/greencar.jpg'),
(111, 23, 91, 'Mazda6', 'Mazda', 26000, 'uploads/redcar.jpg'),
(112, 23, 92, 'Blazer', 'Chevrolet', 38000, 'uploads/yellowcar.jpg'),
(113, 23, 93, 'X7', 'BMW', 93000, 'uploads/bluecar.jpg'),
(114, 23, 94, 'S-Class', 'Mercedes', 110000, 'uploads/greencar.jpg'),
(115, 23, 95, 'A8', 'Audi', 105000, 'uploads/redcar.jpg'),
(116, 24, 96, 'Stinger', 'Kia', 45000, 'uploads/yellowcar.jpg'),
(117, 24, 97, 'Palisade', 'Hyundai', 46000, 'uploads/bluecar.jpg'),
(118, 24, 98, 'Golf', 'Volkswagen', 25000, 'uploads/greencar.jpg'),
(119, 24, 99, 'Legacy', 'Subaru', 27000, 'uploads/redcar.jpg'),
(120, 24, 100, 'Mustang Mach-E', 'Ford', 53000, 'uploads/yellowcar.jpg'),
(121, 25, 1, 'Model S', 'Tesla', 80000, 'uploads/bluecar.jpg'),
(122, 25, 2, 'Corolla', 'Toyota', 20000, 'uploads/greencar.jpg'),
(123, 25, 3, 'Civic', 'Honda', 22000, 'uploads/redcar.jpg'),
(124, 25, 4, 'Mustang', 'Ford', 35000, 'uploads/yellowcar.jpg'),
(125, 25, 5, 'Accord', 'Honda', 25000, 'uploads/bluecar.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `favourites`
--
ALTER TABLE `favourites`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `favourites`
--
ALTER TABLE `favourites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
