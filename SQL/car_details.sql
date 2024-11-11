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
-- Table structure for table `car_details`
--

CREATE TABLE `car_details` (
  `id` int(11) NOT NULL,
  `make` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `mileage` int(11) NOT NULL,
  `manufactured` date NOT NULL,
  `engine_cap` int(11) NOT NULL,
  `transmission` varchar(255) NOT NULL,
  `coe` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `agent_name` varchar(255) NOT NULL,
  `seller_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `img1` varchar(255) NOT NULL,
  `img2` varchar(255) NOT NULL,
  `img3` varchar(255) NOT NULL,
  `img4` varchar(255) NOT NULL,
  `img5` varchar(255) NOT NULL,
  `car_id` int(11) NOT NULL,
  `views` int(11) DEFAULT 0,
  `favourites_count` int(11) DEFAULT 0,
  `seller_id` int(11) DEFAULT NULL,
  `agent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car_details`
--

INSERT INTO `car_details` (`id`, `make`, `model`, `price`, `mileage`, `manufactured`, `engine_cap`, `transmission`, `coe`, `type`, `agent_name`, `seller_name`, `description`, `img1`, `img2`, `img3`, `img4`, `img5`, `car_id`, `views`, `favourites_count`, `seller_id`, `agent_id`) VALUES
(1, 'Tesla', 'Model S', 87496, 9899, '2022-11-24', 39, 'Manual', 4424, 'Sedan', 'Liam Collins', 'Olivia Rivera', 'Luxury electric car', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 1, 5, 3, 3, 2),
(2, 'Toyota', 'Corolla', 84620, 5046, '2023-04-30', 66, 'Manual', 4253, 'SUV', 'Isabella White', 'James Baker', 'Reliable and efficient', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 2, 7, 4, 6, 4),
(3, 'Honda', 'Civic', 38851, 17225, '2023-04-16', 64, 'Manual', 4568, 'Coupe', 'Ava Thompson', 'Alexander Young', 'Sporty compact car', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 3, 4, 5, 10, 6),
(4, 'Ford', 'Mustang', 52516, 5432, '2022-09-23', 67, 'Automatic', 4513, 'Electric', 'Emma Clark', 'Michael Perez', 'American muscle car', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 4, 7, 2, 14, 8),
(5, 'Honda', 'Accord', 21242, 24237, '2023-10-20', 45, 'Automatic', 3596, 'Hatchback', 'Charlotte Carter', 'Elijah Green', 'Comfortable family sedan', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 5, 10, 3, 18, 10),
(6, 'Toyota', 'Camry', 72253, 18877, '2022-10-06', 32, 'Manual', 1369, 'Sedan', 'Ryan Allen', 'Avery Walker', 'Smooth and stylish', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 6, 6, 4, 22, 12),
(7, 'Dodge', 'Charger', 29056, 28241, '2023-08-15', 33, 'Automatic', 2299, 'SUV', 'Alice Lopez', 'Grace Scott', 'Powerful sedan', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 7, 10, 0, 26, 14),
(8, 'Ford', 'Explorer', 83001, 22690, '2023-06-08', 57, 'Automatic', 2570, 'Coupe', 'Victoria Allen', 'Jack Harris', 'Family SUV', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 8, 10, 1, 30, 16),
(9, 'Tesla', 'Model X', 44580, 8215, '2023-11-05', 66, 'Manual', 1863, 'Electric', 'James Adams', 'Lillian Lewis', 'High-end electric SUV', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 9, 9, 3, 34, 18),
(10, 'Nissan', 'Altima', 37076, 15349, '2021-02-26', 65, 'Manual', 3346, 'Hatchback', 'Elijah Gonzalez', 'David Clark', 'Affordable sedan', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 10, 3, 0, 38, 20),
(11, 'Mazda', 'Mazda3', 39446, 17224, '2020-04-25', 33, 'Manual', 4781, 'Sedan', 'Liam Collins', 'Zoey Mitchell', 'Compact hatchback', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 11, 7, 2, 42, 2),
(12, 'Chevrolet', 'Impala', 24616, 28456, '2022-03-23', 61, 'Automatic', 2341, 'SUV', 'Isabella White', 'Lily Wright', 'Full-size sedan', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 12, 7, 3, 46, 4),
(13, 'BMW', '3 Series', 25459, 5485, '2022-10-17', 67, 'Manual', 1008, 'Coupe', 'Ava Thompson', 'Isabella Scott', 'Luxury compact sedan', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 13, 1, 0, 50, 6),
(14, 'Mercedes', 'C-Class', 54941, 20947, '2022-05-02', 42, 'Manual', 3587, 'Electric', 'Emma Clark', 'John Gonzalez', 'Elegant and refined', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 14, 3, 3, 54, 8),
(15, 'Audi', 'A4', 60752, 27637, '2023-01-26', 71, 'Automatic', 3770, 'Hatchback', 'Charlotte Carter', 'Ella Smith', 'Sophisticated sedan', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 15, 3, 4, 58, 10),
(16, 'Kia', 'Seltos', 84788, 10543, '2020-04-11', 56, 'Automatic', 1195, 'Sedan', 'Ryan Allen', 'Jack Harris', 'Smooth and stylish', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 16, 7, 5, 62, 12),
(17, 'Hyundai', 'Elantra', 35542, 6292, '2022-02-10', 34, 'Manual', 2058, 'SUV', 'Alice Lopez', 'Harper Hill', 'Economical sedan', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 17, 10, 2, 66, 14),
(18, 'Volkswagen', 'Jetta', 30118, 6513, '2019-09-06', 48, 'Manual', 2261, 'Coupe', 'Victoria Allen', 'Ava Collins', 'European design', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 18, 1, 0, 70, 16),
(19, 'Subaru', 'Impreza', 91576, 24098, '2023-06-01', 66, 'Automatic', 1205, 'Electric', 'James Adams', 'Zoey Allen', 'High-end electric', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 19, 6, 5, 74, 18),
(20, 'Ford', 'Fusion', 44137, 27574, '2023-05-30', 36, 'Manual', 1963, 'Hatchback', 'Elijah Gonzalez', 'Sophia Clark', 'Affordable choice', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 20, 4, 5, 78, 20),
(21, 'Tesla', 'Model S', 50804, 8229, '2022-12-11', 70, 'Automatic', 3875, 'Sedan', 'Liam Collins', 'Olivia Rivera', 'Luxury electric car', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 21, 5, 3, 3, 2),
(22, 'Toyota', 'Corolla', 90401, 23688, '2020-11-12', 31, 'Automatic', 2654, 'SUV', 'Isabella White', 'James Baker', 'Reliable and efficient', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 22, 5, 1, 6, 4),
(23, 'Honda', 'Civic', 97868, 27479, '2019-09-11', 41, 'Manual', 3038, 'Coupe', 'Ava Thompson', 'Alexander Young', 'Sporty compact car', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 23, 0, 4, 10, 6),
(24, 'Ford', 'Mustang', 55080, 12261, '2021-01-05', 34, 'Automatic', 4990, 'Electric', 'Emma Clark', 'Michael Perez', 'American muscle car', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 24, 8, 5, 14, 8),
(25, 'Honda', 'Accord', 76145, 28294, '2019-10-05', 78, 'Automatic', 2028, 'Hatchback', 'Charlotte Carter', 'Elijah Green', 'Comfortable family sedan', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 25, 1, 2, 18, 10),
(26, 'Toyota', 'Camry', 94496, 23797, '2023-03-04', 38, 'Manual', 3490, 'Sedan', 'Ryan Allen', 'Avery Walker', 'Smooth and stylish', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 26, 8, 3, 22, 12),
(27, 'Dodge', 'Charger', 59303, 8699, '2021-10-06', 31, 'Manual', 3236, 'SUV', 'Alice Lopez', 'Grace Scott', 'Powerful sedan', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 27, 5, 0, 26, 14),
(28, 'Ford', 'Explorer', 90475, 26393, '2020-02-20', 52, 'Manual', 4729, 'Coupe', 'Victoria Allen', 'Jack Harris', 'Family SUV', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 28, 3, 2, 30, 16),
(29, 'Tesla', 'Model X', 72220, 17882, '2022-06-06', 57, 'Manual', 3583, 'Electric', 'James Adams', 'Lillian Lewis', 'High-end electric SUV', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 29, 7, 0, 34, 18),
(30, 'Nissan', 'Altima', 49351, 21532, '2021-12-19', 72, 'Automatic', 2326, 'Hatchback', 'Elijah Gonzalez', 'David Clark', 'Affordable sedan', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 30, 10, 0, 38, 20),
(31, 'Mazda', 'Mazda3', 67953, 21810, '2022-11-30', 46, 'Automatic', 2146, 'Sedan', 'Liam Collins', 'Zoey Mitchell', 'Luxury electric car', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 31, 4, 5, 42, 2),
(32, 'Chevrolet', 'Impala', 64941, 18692, '2022-04-21', 41, 'Automatic', 1059, 'SUV', 'Isabella White', 'Lily Wright', 'Reliable and efficient', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 32, 0, 2, 46, 4),
(33, 'BMW', '3 Series', 50089, 18046, '2023-08-16', 63, 'Manual', 2297, 'Coupe', 'Ava Thompson', 'Isabella Scott', 'Sporty compact car', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 33, 4, 5, 50, 6),
(34, 'Mercedes', 'C-Class', 43400, 27865, '2023-07-21', 31, 'Manual', 2981, 'Electric', 'Emma Clark', 'John Gonzalez', 'American muscle car', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 34, 9, 5, 54, 8),
(35, 'Audi', 'A4', 66535, 20822, '2022-08-14', 38, 'Automatic', 2984, 'Hatchback', 'Charlotte Carter', 'Ella Smith', 'Comfortable family sedan', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 35, 3, 1, 58, 10),
(36, 'Kia', 'Seltos', 97134, 27343, '2021-01-23', 73, 'Manual', 4061, 'Sedan', 'Ryan Allen', 'Jack Harris', 'Smooth and stylish', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 36, 0, 4, 62, 12),
(37, 'Hyundai', 'Elantra', 75805, 7483, '2019-07-12', 56, 'Automatic', 4937, 'SUV', 'Alice Lopez', 'Harper Hill', 'Powerful sedan', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 37, 2, 5, 66, 14),
(38, 'Volkswagen', 'Jetta', 25685, 18860, '2020-05-17', 48, 'Manual', 1760, 'Coupe', 'Victoria Allen', 'Ava Collins', 'Family SUV', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 38, 4, 4, 70, 16),
(39, 'Subaru', 'Impreza', 88873, 29370, '2021-08-08', 48, 'Automatic', 3544, 'Electric', 'James Adams', 'Zoey Allen', 'High-end electric SUV', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 39, 10, 2, 74, 18),
(40, 'Ford', 'Fusion', 65112, 23728, '2022-03-14', 34, 'Automatic', 2864, 'Hatchback', 'Elijah Gonzalez', 'Sophia Clark', 'Affordable sedan', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 40, 1, 5, 78, 20),
(41, 'Toyota', 'Camry', 51357, 26582, '2021-12-08', 59, 'Automatic', 3685, 'Sedan', 'Alice Lopez', 'Grace Scott', 'Smooth and stylish', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 41, 4, 2, 26, 14),
(42, 'Dodge', 'Charger', 72410, 21840, '2023-04-19', 33, 'Manual', 2674, 'SUV', 'Liam Collins', 'Olivia Rivera', 'Powerful sedan', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 42, 7, 0, 3, 2),
(43, 'Tesla', 'Model 3', 65082, 18394, '2022-05-22', 71, 'Automatic', 1499, 'Electric', 'Emma Clark', 'John Gonzalez', 'Electric car', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 43, 6, 3, 54, 8),
(44, 'Honda', 'Civic', 41053, 14783, '2021-03-15', 52, 'Manual', 2125, 'Coupe', 'Charlotte Carter', 'Elijah Green', 'Sporty compact car', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 44, 8, 1, 18, 10),
(45, 'Ford', 'Fusion', 23596, 20790, '2022-08-05', 43, 'Automatic', 3703, 'Hatchback', 'Ryan Allen', 'Ava Collins', 'Comfortable sedan', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 45, 5, 4, 70, 12),
(46, 'Chevrolet', 'Impala', 89214, 11829, '2023-09-12', 54, 'Automatic', 1937, 'SUV', 'Ava Thompson', 'Jack Harris', 'Spacious sedan', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 46, 3, 5, 30, 6),
(47, 'Mazda', 'Mazda6', 34108, 14938, '2021-11-19', 77, 'Manual', 2839, 'Sedan', 'Isabella White', 'Lily Wright', 'Efficient sedan', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 47, 6, 0, 46, 4),
(48, 'Toyota', 'Corolla', 58751, 23104, '2020-02-21', 66, 'Automatic', 1983, 'SUV', 'Victoria Allen', 'Ella Smith', 'Compact SUV', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 48, 7, 2, 58, 16),
(49, 'Honda', 'Accord', 40710, 21306, '2021-06-27', 34, 'Manual', 2345, 'Hatchback', 'Elijah Gonzalez', 'Jack Harris', 'Reliable sedan', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 49, 1, 5, 62, 20),
(50, 'Ford', 'Explorer', 73214, 19593, '2019-11-04', 45, 'Automatic', 2481, 'SUV', 'James Adams', 'David Clark', 'Family SUV', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 50, 9, 0, 38, 18),
(51, 'Nissan', 'Altima', 98232, 13856, '2022-01-30', 60, 'Automatic', 3756, 'Sedan', 'Alice Lopez', 'Grace Scott', 'Affordable sedan', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 51, 3, 1, 26, 14),
(52, 'Hyundai', 'Elantra', 75398, 15204, '2021-07-09', 52, 'Manual', 1764, 'Coupe', 'Ryan Allen', 'Zoey Allen', 'Economical coupe', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 52, 7, 3, 74, 12),
(53, 'Volkswagen', 'Jetta', 50298, 12957, '2022-10-27', 49, 'Automatic', 3371, 'Electric', 'Charlotte Carter', 'Lillian Lewis', 'High-end sedan', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 53, 0, 4, 34, 10),
(54, 'Subaru', 'Impreza', 38427, 23470, '2023-04-03', 78, 'Manual', 4895, 'SUV', 'Victoria Allen', 'Isabella Scott', 'Rugged SUV', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 54, 9, 2, 50, 16),
(55, 'Toyota', 'Camry', 89123, 17325, '2022-07-07', 38, 'Automatic', 2305, 'Hatchback', 'Emma Clark', 'Sophia Clark', 'Family hatchback', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 55, 1, 0, 78, 8),
(56, 'Mazda', 'CX-5', 94234, 20283, '2020-04-22', 62, 'Manual', 2075, 'SUV', 'Ava Thompson', 'David Clark', 'Compact SUV', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 56, 3, 4, 38, 6),
(57, 'Ford', 'Mustang', 50835, 29843, '2021-02-10', 53, 'Automatic', 3601, 'Electric', 'Liam Collins', 'Ella Smith', 'Electric sports car', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 57, 4, 2, 58, 2),
(58, 'Dodge', 'Charger', 67239, 29104, '2023-08-08', 69, 'Manual', 2883, 'Sedan', 'Elijah Gonzalez', 'Olivia Rivera', 'Stylish sedan', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 58, 6, 0, 3, 20),
(59, 'Tesla', 'Model X', 82934, 12682, '2021-06-23', 42, 'Automatic', 1927, 'SUV', 'James Adams', 'Harper Hill', 'Luxury SUV', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 59, 10, 1, 66, 18),
(60, 'Honda', 'Civic', 42986, 17749, '2020-08-19', 44, 'Manual', 2234, 'Coupe', 'Isabella White', 'Isabella Scott', 'Compact coupe', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 60, 1, 3, 50, 4),
(61, 'Toyota', 'Corolla', 34123, 29847, '2022-05-21', 57, 'Automatic', 2973, 'Hatchback', 'Alice Lopez', 'Jack Harris', 'Reliable car', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 61, 2, 4, 62, 14),
(62, 'Ford', 'Explorer', 57829, 15204, '2023-03-15', 68, 'Manual', 4275, 'SUV', 'Charlotte Carter', 'Sophia Clark', 'Spacious and powerful', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 62, 5, 3, 78, 10),
(63, 'Hyundai', 'Sonata', 78615, 18094, '2021-07-27', 79, 'Automatic', 3295, 'Sedan', 'Victoria Allen', 'Avery Walker', 'Affordable and reliable', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 63, 8, 1, 22, 16),
(64, 'Mazda', 'CX-3', 34257, 29843, '2020-11-01', 31, 'Manual', 1538, 'SUV', 'Ryan Allen', 'Ella Smith', 'Compact family SUV', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 64, 6, 4, 58, 12),
(65, 'Chevrolet', 'Malibu', 88953, 12470, '2021-02-05', 43, 'Automatic', 2149, 'Sedan', 'Elijah Gonzalez', 'Grace Scott', 'Stylish and affordable', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 65, 7, 5, 26, 20),
(66, 'Tesla', 'Model 3', 65485, 11236, '2023-02-27', 56, 'Automatic', 2849, 'Electric', 'James Adams', 'David Clark', 'Luxury electric sedan', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 66, 2, 0, 38, 18),
(67, 'Audi', 'A3', 43214, 29750, '2021-05-22', 68, 'Manual', 1652, 'Hatchback', 'Alice Lopez', 'Zoey Mitchell', 'Elegant and efficient', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 67, 3, 1, 42, 14),
(68, 'Ford', 'Fusion', 74929, 20374, '2021-10-31', 72, 'Automatic', 3172, 'Sedan', 'Liam Collins', 'Lily Wright', 'Family sedan', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 68, 6, 2, 46, 2),
(69, 'Nissan', 'Rogue', 78452, 13470, '2019-09-07', 34, 'Automatic', 2234, 'SUV', 'Ryan Allen', 'Alexander Young', 'Reliable SUV', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 69, 3, 5, 10, 12),
(70, 'Toyota', 'RAV4', 85043, 11389, '2020-10-13', 55, 'Manual', 2698, 'SUV', 'Emma Clark', 'Ava Collins', 'Compact SUV', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 70, 7, 2, 70, 8),
(71, 'Honda', 'CR-V', 23587, 27647, '2023-01-21', 47, 'Automatic', 1628, 'SUV', 'Victoria Allen', 'Harper Hill', 'Family-friendly', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 71, 4, 1, 66, 16),
(72, 'Mazda', 'CX-5', 67103, 15849, '2022-04-09', 60, 'Automatic', 2358, 'SUV', 'Ava Thompson', 'Sophia Clark', 'Spacious and comfortable', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 72, 1, 5, 78, 6),
(73, 'Chevrolet', 'Equinox', 85234, 28967, '2023-05-19', 39, 'Manual', 2974, 'SUV', 'Elijah Gonzalez', 'Isabella Scott', 'Versatile SUV', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 73, 2, 4, 50, 20),
(74, 'Hyundai', 'Santa Fe', 48392, 21970, '2022-09-13', 42, 'Manual', 1685, 'SUV', 'James Adams', 'John Gonzalez', 'Comfortable family SUV', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 74, 8, 0, 54, 18),
(75, 'Toyota', 'Highlander', 39285, 27834, '2020-11-20', 38, 'Automatic', 2345, 'SUV', 'Isabella White', 'Ella Smith', 'Spacious SUV', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 75, 9, 2, 58, 4),
(76, 'Ford', 'Bronco', 75503, 26485, '2023-02-12', 71, 'Manual', 3761, 'SUV', 'Alice Lopez', 'James Baker', 'Off-road SUV', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 76, 3, 4, 6, 14),
(77, 'Tesla', 'Model Y', 99245, 15439, '2020-03-23', 40, 'Automatic', 2193, 'Electric', 'Charlotte Carter', 'Avery Walker', 'Electric crossover', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 77, 6, 3, 22, 10),
(78, 'Mazda', 'CX-9', 41750, 15785, '2022-12-30', 55, 'Manual', 3051, 'SUV', 'Victoria Allen', 'Olivia Rivera', 'Three-row SUV', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 78, 7, 1, 3, 16),
(79, 'Chevrolet', 'Traverse', 71204, 22347, '2023-06-01', 65, 'Automatic', 1582, 'SUV', 'Liam Collins', 'Grace Scott', 'Full-size SUV', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 79, 2, 0, 26, 2),
(80, 'Toyota', 'Sienna', 47823, 13528, '2022-10-19', 37, 'Automatic', 1238, 'Van', 'Emma Clark', 'Harper Hill', 'Family van', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 80, 8, 5, 66, 8),
(81, 'Ford', 'Edge', 60975, 14569, '2021-12-11', 30, 'Manual', 2230, 'SUV', 'Ava Thompson', 'Isabella Scott', 'Stylish SUV', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 81, 4, 2, 50, 6),
(82, 'Honda', 'Pilot', 71832, 19732, '2019-10-01', 42, 'Automatic', 2714, 'SUV', 'Isabella White', 'Lily Wright', 'Large family SUV', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 82, 9, 5, 46, 4),
(83, 'Mazda', 'CX-30', 35945, 27684, '2021-05-23', 76, 'Manual', 3502, 'SUV', 'Elijah Gonzalez', 'Ava Collins', 'Compact crossover', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 83, 5, 3, 70, 20),
(84, 'Hyundai', 'Tucson', 50126, 26748, '2023-07-17', 38, 'Automatic', 2048, 'SUV', 'Victoria Allen', 'Ella Smith', 'Comfortable SUV', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 84, 0, 4, 58, 16),
(85, 'Chevrolet', 'Blazer', 62753, 13294, '2021-08-02', 41, 'Manual', 3830, 'SUV', 'Charlotte Carter', 'Sophia Clark', 'Stylish SUV', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 85, 1, 2, 78, 10),
(86, 'Ford', 'Expedition', 58237, 18765, '2022-02-15', 48, 'Automatic', 2754, 'SUV', 'Ryan Allen', 'James Baker', 'Large and powerful', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 86, 6, 0, 6, 12),
(87, 'Dodge', 'Durango', 49827, 19347, '2021-06-11', 33, 'Manual', 1675, 'SUV', 'James Adams', 'Lillian Lewis', 'Rugged SUV', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 87, 7, 1, 34, 18),
(88, 'Honda', 'Passport', 92564, 21493, '2022-12-13', 73, 'Automatic', 1372, 'SUV', 'Alice Lopez', 'David Clark', 'Reliable SUV', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 88, 8, 4, 38, 14),
(89, 'Toyota', 'Sequoia', 54938, 12567, '2023-06-06', 40, 'Manual', 2806, 'SUV', 'Victoria Allen', 'Grace Scott', 'Large SUV', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 89, 2, 5, 26, 16),
(90, 'Chevrolet', 'Suburban', 48729, 13248, '2021-09-12', 63, 'Automatic', 2931, 'SUV', 'Elijah Gonzalez', 'Avery Walker', 'Large and versatile', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 90, 4, 1, 22, 20),
(91, 'Mazda', 'CX-50', 64129, 11459, '2020-11-19', 51, 'Manual', 2639, 'SUV', 'Liam Collins', 'Ella Smith', 'Compact and capable', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 91, 5, 0, 58, 2),
(92, 'Hyundai', 'Venue', 78253, 29873, '2021-01-22', 38, 'Automatic', 2871, 'SUV', 'Ava Thompson', 'Isabella Scott', 'Small crossover', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 92, 9, 3, 50, 6),
(93, 'Toyota', 'Land Cruiser', 92385, 12349, '2023-05-07', 67, 'Manual', 3001, 'SUV', 'Emma Clark', 'Harper Hill', 'Off-road SUV', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 93, 7, 4, 66, 8),
(94, 'Ford', 'Ranger', 84256, 28564, '2022-03-26', 74, 'Automatic', 2108, 'Truck', 'James Adams', 'Jack Harris', 'Powerful truck', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 94, 8, 2, 30, 18),
(95, 'Chevrolet', 'Silverado', 45382, 21845, '2023-07-19', 65, 'Manual', 3759, 'Truck', 'Victoria Allen', 'David Clark', 'Rugged truck', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 95, 1, 5, 38, 16),
(96, 'Hyundai', 'Santa Cruz', 27485, 12758, '2020-09-18', 39, 'Automatic', 2023, 'Truck', 'Elijah Gonzalez', 'Zoey Mitchell', 'Compact truck', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 96, 7, 4, 42, 20),
(97, 'Toyota', 'Tacoma', 68953, 21394, '2022-11-02', 53, 'Manual', 2618, 'Truck', 'Alice Lopez', 'Lillian Lewis', 'Midsize truck', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 'uploads/bluecar.jpg', 97, 9, 2, 34, 14),
(98, 'Ford', 'Maverick', 35462, 15627, '2023-03-11', 48, 'Automatic', 1887, 'Truck', 'Ryan Allen', 'Sophia Clark', 'Compact and efficient', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 'uploads/greencar.jpg', 98, 5, 3, 78, 12),
(99, 'Chevrolet', 'Colorado', 68237, 28465, '2021-01-09', 70, 'Manual', 3245, 'Truck', 'Ava Thompson', 'James Baker', 'Versatile midsize truck', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 'uploads/redcar.jpg', 99, 4, 1, 6, 6),
(100, 'Mazda', 'BT-50', 45583, 19046, '2020-05-21', 67, 'Automatic', 2773, 'Truck', 'Victoria Allen', 'Grace Scott', 'Rugged and reliable', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 'uploads/yellowcar.jpg', 100, 2, 0, 26, 16);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `car_details`
--
ALTER TABLE `car_details`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
