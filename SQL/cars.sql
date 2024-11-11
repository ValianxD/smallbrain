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
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `make` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `make`, `model`, `price`, `image`) VALUES
(1, 'Tesla', 'Model S', 80000, 'uploads/bluecar.jpg'),
(2, 'Toyota', 'Corolla', 20000, 'uploads/greencar.jpg'),
(3, 'Honda', 'Civic', 22000, 'uploads/redcar.jpg'),
(4, 'Ford', 'Mustang', 35000, 'uploads/yellowcar.jpg'),
(5, 'Honda', 'Accord', 25000, 'uploads/bluecar.jpg'),
(6, 'Toyota', 'Camry', 27000, 'uploads/greencar.jpg'),
(7, 'Dodge', 'Charger', 30000, 'uploads/redcar.jpg'),
(8, 'Ford', 'Explorer', 40000, 'uploads/yellowcar.jpg'),
(9, 'Tesla', 'Model X', 90000, 'uploads/bluecar.jpg'),
(10, 'Nissan', 'Altima', 24000, 'uploads/greencar.jpg'),
(11, 'Mazda', 'Mazda3', 21000, 'uploads/redcar.jpg'),
(12, 'Chevrolet', 'Impala', 29000, 'uploads/yellowcar.jpg'),
(13, 'BMW', '3 Series', 45000, 'uploads/bluecar.jpg'),
(14, 'Mercedes', 'C-Class', 55000, 'uploads/greencar.jpg'),
(15, 'Audi', 'A4', 48000, 'uploads/redcar.jpg'),
(16, 'Kia', 'Optima', 23000, 'uploads/yellowcar.jpg'),
(17, 'Hyundai', 'Elantra', 21000, 'uploads/bluecar.jpg'),
(18, 'Volkswagen', 'Jetta', 22000, 'uploads/greencar.jpg'),
(19, 'Subaru', 'Impreza', 25000, 'uploads/redcar.jpg'),
(20, 'Ford', 'Fusion', 27000, 'uploads/yellowcar.jpg'),
(21, 'Tesla', 'Model 3', 60000, 'uploads/bluecar.jpg'),
(22, 'Toyota', 'Prius', 24000, 'uploads/greencar.jpg'),
(23, 'Honda', 'Insight', 23000, 'uploads/redcar.jpg'),
(24, 'Ford', 'Escape', 32000, 'uploads/yellowcar.jpg'),
(25, 'Honda', 'Fit', 20000, 'uploads/bluecar.jpg'),
(26, 'Toyota', 'Yaris', 19000, 'uploads/greencar.jpg'),
(27, 'Dodge', 'Durango', 42000, 'uploads/redcar.jpg'),
(28, 'Ford', 'Edge', 38000, 'uploads/yellowcar.jpg'),
(29, 'Tesla', 'Model Y', 70000, 'uploads/bluecar.jpg'),
(30, 'Nissan', 'Versa', 18000, 'uploads/greencar.jpg'),
(31, 'Mazda', 'CX-5', 31000, 'uploads/redcar.jpg'),
(32, 'Chevrolet', 'Malibu', 26000, 'uploads/yellowcar.jpg'),
(33, 'BMW', 'X3', 54000, 'uploads/bluecar.jpg'),
(34, 'Mercedes', 'GLA', 60000, 'uploads/greencar.jpg'),
(35, 'Audi', 'Q5', 65000, 'uploads/redcar.jpg'),
(36, 'Kia', 'Seltos', 22000, 'uploads/yellowcar.jpg'),
(37, 'Hyundai', 'Tucson', 28000, 'uploads/bluecar.jpg'),
(38, 'Volkswagen', 'Passat', 27000, 'uploads/greencar.jpg'),
(39, 'Subaru', 'Outback', 32000, 'uploads/redcar.jpg'),
(40, 'Ford', 'Ranger', 37000, 'uploads/yellowcar.jpg'),
(41, 'Tesla', 'Cybertruck', 75000, 'uploads/bluecar.jpg'),
(42, 'Toyota', 'Highlander', 45000, 'uploads/greencar.jpg'),
(43, 'Honda', 'Pilot', 43000, 'uploads/redcar.jpg'),
(44, 'Ford', 'Bronco', 48000, 'uploads/yellowcar.jpg'),
(45, 'Honda', 'Ridgeline', 40000, 'uploads/bluecar.jpg'),
(46, 'Toyota', 'Tacoma', 38000, 'uploads/greencar.jpg'),
(47, 'Dodge', 'Ram', 60000, 'uploads/redcar.jpg'),
(48, 'Ford', 'F-150', 55000, 'uploads/yellowcar.jpg'),
(49, 'Tesla', 'Roadster', 120000, 'uploads/bluecar.jpg'),
(50, 'Nissan', 'Titan', 49000, 'uploads/greencar.jpg'),
(51, 'Mazda', 'MX-5', 30000, 'uploads/redcar.jpg'),
(52, 'Chevrolet', 'Colorado', 35000, 'uploads/yellowcar.jpg'),
(53, 'BMW', '5 Series', 70000, 'uploads/bluecar.jpg'),
(54, 'Mercedes', 'E-Class', 75000, 'uploads/greencar.jpg'),
(55, 'Audi', 'A6', 72000, 'uploads/redcar.jpg'),
(56, 'Kia', 'Sorento', 33000, 'uploads/yellowcar.jpg'),
(57, 'Hyundai', 'Santa Fe', 34000, 'uploads/bluecar.jpg'),
(58, 'Volkswagen', 'Atlas', 37000, 'uploads/greencar.jpg'),
(59, 'Subaru', 'Ascent', 40000, 'uploads/redcar.jpg'),
(60, 'Ford', 'Expedition', 80000, 'uploads/yellowcar.jpg'),
(61, 'Tesla', 'Semi', 150000, 'uploads/bluecar.jpg'),
(62, 'Toyota', 'Sequoia', 65000, 'uploads/greencar.jpg'),
(63, 'Honda', 'Passport', 45000, 'uploads/redcar.jpg'),
(64, 'Ford', 'Transit', 50000, 'uploads/yellowcar.jpg'),
(65, 'Honda', 'CR-V', 30000, 'uploads/bluecar.jpg'),
(66, 'Toyota', 'RAV4', 32000, 'uploads/greencar.jpg'),
(67, 'Dodge', 'Journey', 29000, 'uploads/redcar.jpg'),
(68, 'Ford', 'EcoSport', 25000, 'uploads/yellowcar.jpg'),
(69, 'Tesla', 'Model Y', 69000, 'uploads/bluecar.jpg'),
(70, 'Nissan', 'Kicks', 23000, 'uploads/greencar.jpg'),
(71, 'Mazda', 'CX-30', 27000, 'uploads/redcar.jpg'),
(72, 'Chevrolet', 'Traverse', 36000, 'uploads/yellowcar.jpg'),
(73, 'BMW', 'X5', 82000, 'uploads/bluecar.jpg'),
(74, 'Mercedes', 'GLE', 85000, 'uploads/greencar.jpg'),
(75, 'Audi', 'Q7', 83000, 'uploads/redcar.jpg'),
(76, 'Kia', 'Telluride', 45000, 'uploads/yellowcar.jpg'),
(77, 'Hyundai', 'Venue', 19000, 'uploads/bluecar.jpg'),
(78, 'Volkswagen', 'Tiguan', 33000, 'uploads/greencar.jpg'),
(79, 'Subaru', 'Forester', 31000, 'uploads/redcar.jpg'),
(80, 'Ford', 'Flex', 34000, 'uploads/yellowcar.jpg'),
(81, 'Tesla', 'Model X', 95000, 'uploads/bluecar.jpg'),
(82, 'Toyota', '4Runner', 42000, 'uploads/greencar.jpg'),
(83, 'Honda', 'Element', 25000, 'uploads/redcar.jpg'),
(84, 'Ford', 'Maverick', 28000, 'uploads/yellowcar.jpg'),
(85, 'Honda', 'HR-V', 22000, 'uploads/bluecar.jpg'),
(86, 'Toyota', 'Land Cruiser', 85000, 'uploads/greencar.jpg'),
(87, 'Dodge', 'Challenger', 35000, 'uploads/redcar.jpg'),
(88, 'Ford', 'Taurus', 33000, 'uploads/yellowcar.jpg'),
(89, 'Tesla', 'Model 3', 50000, 'uploads/bluecar.jpg'),
(90, 'Nissan', 'Pathfinder', 40000, 'uploads/greencar.jpg'),
(91, 'Mazda', 'Mazda6', 26000, 'uploads/redcar.jpg'),
(92, 'Chevrolet', 'Blazer', 38000, 'uploads/yellowcar.jpg'),
(93, 'BMW', 'X7', 93000, 'uploads/bluecar.jpg'),
(94, 'Mercedes', 'S-Class', 110000, 'uploads/greencar.jpg'),
(95, 'Audi', 'A8', 105000, 'uploads/redcar.jpg'),
(96, 'Kia', 'Stinger', 45000, 'uploads/yellowcar.jpg'),
(97, 'Hyundai', 'Palisade', 46000, 'uploads/bluecar.jpg'),
(98, 'Volkswagen', 'Golf', 25000, 'uploads/greencar.jpg'),
(99, 'Subaru', 'Legacy', 27000, 'uploads/redcar.jpg'),
(100, 'Ford', 'Mustang Mach-E', 53000, 'uploads/yellowcar.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
