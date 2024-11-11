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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `usertype` varchar(255) NOT NULL,
  `status` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `username`, `email`, `password`, `usertype`, `status`) VALUES
(1, 'Sophia Evan', 'sophia_ev', 'sophia@gmail.com', 'password1', 'buyer', 1),
(2, 'Liam Collins', 'liam_co', 'liam@gmail.com', 'password2', 'agent', 1),
(3, 'Olivia Rivera', 'olivia_ri', 'olivia@gmail.com', 'password3', 'seller', 1),
(4, 'Noah Scott', 'noah_sc', 'noah@gmail.com', 'password4', 'admin', 1),
(5, 'Emma Gray', 'emma_gr', 'emma@gmail.com', 'password5', 'buyer', 1),
(6, 'James Baker', 'james_ba', 'james@gmail.com', 'password6', 'seller', 1),
(7, 'Isabella White', 'isabella_wh', 'isabella@gmail.com', 'password7', 'agent', 1),
(8, 'Ethan Martinez', 'ethan_ma', 'ethan@gmail.com', 'password8', 'admin', 1),
(9, 'Mia Adams', 'mia_ad', 'mia@gmail.com', 'password9', 'buyer', 1),
(10, 'Alexander Young', 'alexander_yo', 'alexander@gmail.com', 'password10', 'seller', 1),
(11, 'Ava Thompson', 'ava_th', 'ava@gmail.com', 'password11', 'agent', 1),
(12, 'William Hill', 'william_hi', 'william@gmail.com', 'password12', 'admin', 1),
(13, 'Sophia Lee', 'sophia_le', 'sophia@gmail.com', 'password13', 'buyer', 1),
(14, 'Michael Perez', 'michael_pe', 'michael@gmail.com', 'password14', 'seller', 1),
(15, 'Emma Clark', 'emma_cl', 'emma@gmail.com', 'password15', 'agent', 1),
(16, 'Benjamin Hernandez', 'benjamin_he', 'benjamin@gmail.com', 'password16', 'admin', 1),
(17, 'Amelia Nelson', 'amelia_ne', 'amelia@gmail.com', 'password17', 'buyer', 1),
(18, 'Elijah Green', 'elijah_gr', 'elijah@gmail.com', 'password18', 'seller', 1),
(19, 'Charlotte Carter', 'charlotte_ca', 'charlotte@gmail.com', 'password19', 'agent', 1),
(20, 'Lucas Mitchell', 'lucas_mi', 'lucas@gmail.com', 'password20', 'admin', 1),
(21, 'Mason Lopez', 'mason_lo', 'mason@gmail.com', 'password21', 'buyer', 1),
(22, 'Avery Walker', 'avery_wa', 'avery@gmail.com', 'password22', 'seller', 1),
(23, 'Harper Allen', 'harper_al', 'harper@gmail.com', 'password23', 'agent', 1),
(24, 'Ella King', 'ella_ki', 'ella@gmail.com', 'password24', 'admin', 1),
(25, 'Lily Wright', 'lily_wr', 'lily@gmail.com', 'password25', 'buyer', 1),
(26, 'Grace Scott', 'grace_sc', 'grace@gmail.com', 'password26', 'seller', 1),
(27, 'Chloe Rivera', 'chloe_ri', 'chloe@gmail.com', 'password27', 'agent', 1),
(28, 'Henry Roberts', 'henry_ro', 'henry@gmail.com', 'password28', 'admin', 1),
(29, 'Ella Baker', 'ella_ba', 'ella@gmail.com', 'password29', 'buyer', 1),
(30, 'Jack Harris', 'jack_ha', 'jack@gmail.com', 'password30', 'seller', 1),
(31, 'Nora White', 'nora_wh', 'nora@gmail.com', 'password31', 'agent', 1),
(32, 'Owen Martinez', 'owen_ma', 'owen@gmail.com', 'password32', 'admin', 1),
(33, 'Layla Gonzalez', 'layla_go', 'layla@gmail.com', 'password33', 'buyer', 1),
(34, 'Lillian Lewis', 'lillian_le', 'lillian@gmail.com', 'password34', 'seller', 1),
(35, 'Ryan Allen', 'ryan_al', 'ryan@gmail.com', 'password35', 'agent', 1),
(36, 'Victoria Walker', 'victoria_wa', 'victoria@gmail.com', 'password36', 'admin', 1),
(37, 'Zoey Collins', 'zoey_co', 'zoey@gmail.com', 'password37', 'buyer', 1),
(38, 'David Clark', 'david_cl', 'david@gmail.com', 'password38', 'seller', 1),
(39, 'Alice Lopez', 'alice_lo', 'alice@gmail.com', 'password39', 'agent', 1),
(40, 'Mia Green', 'mia_gr', 'mia@gmail.com', 'password40', 'admin', 1),
(41, 'Levi Hill', 'levi_hi', 'levi@gmail.com', 'password41', 'buyer', 1),
(42, 'Zoey Mitchell', 'zoey_mi', 'zoey@gmail.com', 'password42', 'seller', 1),
(43, 'Madison Nelson', 'madison_ne', 'madison@gmail.com', 'password43', 'agent', 1),
(44, 'Ella Young', 'ella_yo', 'ella@gmail.com', 'password44', 'admin', 1),
(45, 'Ethan White', 'ethan_wh', 'ethan@gmail.com', 'password45', 'buyer', 1),
(46, 'Lily Wright', 'lily_wr', 'lily@gmail.com', 'password46', 'seller', 1),
(47, 'Ava King', 'ava_ki', 'ava@gmail.com', 'password47', 'agent', 1),
(48, 'Elijah Carter', 'elijah_ca', 'elijah@gmail.com', 'password48', 'admin', 1),
(49, 'Daniel Thompson', 'daniel_th', 'daniel@gmail.com', 'password49', 'buyer', 1),
(50, 'Isabella Scott', 'isabella_sc', 'isabella@gmail.com', 'password50', 'seller', 1),
(51, 'James Adams', 'james_ad', 'james@gmail.com', 'password51', 'agent', 1),
(52, 'Lucas Rivera', 'lucas_ri', 'lucas@gmail.com', 'password52', 'admin', 1),
(53, 'Evelyn Martinez', 'evelyn_ma', 'evelyn@gmail.com', 'password53', 'buyer', 1),
(54, 'John Gonzalez', 'john_go', 'john@gmail.com', 'password54', 'seller', 1),
(55, 'Avery Hernandez', 'avery_he', 'avery@gmail.com', 'password55', 'agent', 1),
(56, 'Emma Brown', 'emma_br', 'emma@gmail.com', 'password56', 'admin', 1),
(57, 'Mason Lee', 'mason_le', 'mason@gmail.com', 'password57', 'buyer', 1),
(58, 'Ella Smith', 'ella_sm', 'ella@gmail.com', 'password58', 'seller', 1),
(59, 'Victoria Allen', 'victoria_al', 'victoria@gmail.com', 'password59', 'agent', 1),
(60, 'Samuel Carter', 'samuel_ca', 'samuel@gmail.com', 'password60', 'admin', 1),
(61, 'Hannah Wright', 'hannah_wr', 'hannah@gmail.com', 'password61', 'buyer', 1),
(62, 'Jack Harris', 'jack_ha', 'jack@gmail.com', 'password62', 'seller', 1),
(63, 'Evelyn Lewis', 'evelyn_le', 'evelyn@gmail.com', 'password63', 'agent', 1),
(64, 'Henry Walker', 'henry_wa', 'henry@gmail.com', 'password64', 'admin', 1),
(65, 'Aiden Young', 'aiden_yo', 'aiden@gmail.com', 'password65', 'buyer', 1),
(66, 'Harper Hill', 'harper_hi', 'harper@gmail.com', 'password66', 'seller', 1),
(67, 'Victoria Roberts', 'victoria_ro', 'victoria@gmail.com', 'password67', 'agent', 1),
(68, 'Ella Martinez', 'ella_ma', 'ella@gmail.com', 'password68', 'admin', 1),
(69, 'Grace Hernandez', 'grace_he', 'grace@gmail.com', 'password69', 'buyer', 1),
(70, 'Ava Collins', 'ava_co', 'ava@gmail.com', 'password70', 'seller', 1),
(71, 'Elijah Gonzalez', 'elijah_go', 'elijah@gmail.com', 'password71', 'agent', 1),
(72, 'Madison Scott', 'madison_sc', 'madison@gmail.com', 'password72', 'admin', 1),
(73, 'Daniel Lopez', 'daniel_lo', 'daniel@gmail.com', 'password73', 'buyer', 1),
(74, 'Zoey Allen', 'zoey_al', 'zoey@gmail.com', 'password74', 'seller', 1),
(75, 'Nora Thompson', 'nora_th', 'nora@gmail.com', 'password75', 'agent', 1),
(76, 'Levi White', 'levi_wh', 'levi@gmail.com', 'password76', 'admin', 1),
(77, 'Mia Rivera', 'mia_ri', 'mia@gmail.com', 'password77', 'buyer', 1),
(78, 'Sophia Clark', 'sophia_cl', 'sophia@gmail.com', 'password78', 'seller', 1),
(79, 'Isabella Adams', 'isabella_ad', 'isabella@gmail.com', 'password79', 'agent', 1),
(80, 'Benjamin Harris', 'benjamin_ha', 'benjamin@gmail.com', 'password80', 'admin', 1),
(81, 'Avery Gonzalez', 'avery_go', 'avery@gmail.com', 'password81', 'buyer', 1),
(82, 'Lucas Green', 'lucas_gr', 'lucas@gmail.com', 'password82', 'seller', 1),
(83, 'Sophia Lee', 'sophia_le', 'sophia@gmail.com', 'password83', 'agent', 1),
(84, 'David Brown', 'david_br', 'david@gmail.com', 'password84', 'admin', 1),
(85, 'Amelia Scott', 'amelia_sc', 'amelia@gmail.com', 'password85', 'buyer', 1),
(86, 'Liam Smith', 'liam_sm', 'liam@gmail.com', 'password86', 'seller', 1),
(87, 'Ella Nelson', 'ella_ne', 'ella@gmail.com', 'password87', 'agent', 1),
(88, 'Owen Thompson', 'owen_th', 'owen@gmail.com', 'password88', 'admin', 1),
(89, 'Zoey Walker', 'zoey_wa', 'zoey@gmail.com', 'password89', 'buyer', 1),
(90, 'Charlotte Roberts', 'charlotte_ro', 'charlotte@gmail.com', 'password90', 'seller', 1),
(91, 'Henry Hill', 'henry_hi', 'henry@gmail.com', 'password91', 'agent', 1),
(92, 'Elijah Gonzalez', 'elijah_go', 'elijah@gmail.com', 'password92', 'admin', 1),
(93, 'Mason Young', 'mason_yo', 'mason@gmail.com', 'password93', 'buyer', 1),
(94, 'Chloe White', 'chloe_wh', 'chloe@gmail.com', 'password94', 'seller', 1),
(95, 'David Wright', 'david_wr', 'david@gmail.com', 'password95', 'agent', 1),
(96, 'Layla Lopez', 'layla_lo', 'layla@gmail.com', 'password96', 'admin', 1),
(97, 'Charlotte Lewis', 'charlotte_le', 'charlotte@gmail.com', 'password97', 'buyer', 1),
(98, 'Grace Allen', 'grace_al', 'grace@gmail.com', 'password98', 'seller', 1),
(99, 'Jack Adams', 'jack_ad', 'jack@gmail.com', 'password99', 'agent', 1),
(100, 'William King', 'william_ki', 'william@gmail.com', 'password100', 'admin', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
