-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2024 at 11:24 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `courier`
--

CREATE TABLE `courier` (
  `id` int(11) NOT NULL,
  `reference_id` bigint(20) DEFAULT NULL,
  `sender_name` varchar(255) NOT NULL,
  `sender_address` varchar(255) NOT NULL,
  `sender_contact` int(255) NOT NULL,
  `recipient_name` varchar(255) NOT NULL,
  `recipient_address` varchar(255) NOT NULL,
  `recipient_contact` int(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `from_branch` int(255) NOT NULL,
  `to_branch` int(255) NOT NULL,
  `placed_by` int(11) NOT NULL,
  `weight` decimal(65,0) NOT NULL,
  `height` decimal(65,0) NOT NULL,
  `width` decimal(65,0) NOT NULL,
  `length` decimal(65,0) NOT NULL,
  `price` int(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courier`
--

INSERT INTO `courier` (`id`, `reference_id`, `sender_name`, `sender_address`, `sender_contact`, `recipient_name`, `recipient_address`, `recipient_contact`, `type`, `from_branch`, `to_branch`, `placed_by`, `weight`, `height`, `width`, `length`, `price`, `status`, `date_created`) VALUES
(7, 665706030642, 'Zohaib', 'gulshan-e-shamim', 2147483647, 'Zohaib', 'nazimabad No. 2', 2147483647, 'pickup', 3, 1, 13, 20, 20, 14, 14, 100, 'pending', '2024-06-04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(255) NOT NULL,
  `branch_id` int(255) DEFAULT NULL,
  `data_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `password`, `status`, `branch_id`, `data_created`) VALUES
(10, 'Admin', 'Zohaib@Ismail.com', 'Admin', 'mein-nahi-bataonga', 1, 0, '2024-05-29'),
(13, 'Asad', 'asad@gmail.com', 'agent', '123456', 0, 1, '2024-05-30'),
(14, 'Zohaib', 'Killerzobi893@gmail.com', 'agent', '123456', 1, 2, '2024-05-30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courier`
--
ALTER TABLE `courier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reference_id` (`reference_id`),
  ADD KEY `placed_by` (`placed_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courier`
--
ALTER TABLE `courier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courier`
--
ALTER TABLE `courier`
  ADD CONSTRAINT `courier_ibfk_1` FOREIGN KEY (`placed_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
