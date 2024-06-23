-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2024 at 04:37 PM
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
  `sender_contact` bigint(255) NOT NULL,
  `recipient_name` varchar(255) NOT NULL,
  `recipient_address` varchar(255) NOT NULL,
  `recipient_contact` bigint(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `from_branch` int(255) NOT NULL,
  `to_branch` int(255) NOT NULL,
  `placed_by` int(11) NOT NULL,
  `weight` decimal(65,0) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `price` int(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courier`
--

INSERT INTO `courier` (`id`, `reference_id`, `sender_name`, `sender_address`, `sender_contact`, `recipient_name`, `recipient_address`, `recipient_contact`, `type`, `from_branch`, `to_branch`, `placed_by`, `weight`, `payment_method`, `price`, `status`, `date_created`) VALUES
(7, 665706030642, 'Zohaib', 'gulshan-e-shamim', 923481809798, 'Zohaib', 'nazimabad', 2147483647, 'pickup', 3, 1, 13, 20, '', 100, 'delivered', '2024-06-04'),
(8, 744781791240, 'Asad', 'Nazimabad II', 2147483647, 'Zohaib', 'Gulshan-e-shamim', 2147483647, 'pickup', 2, 3, 13, 20, 'online', 40, 'pending', '2024-05-08'),
(10, 690539718549, 'Zohaib', 'gulshan-e-shamim', 923481809798, 'Asad', 'Gulshan-e-shamim', 2147483647, 'pickup', 1, 2, 14, 50, 'online', 130, 'delivered', '2024-06-17'),
(11, 461075136625, 'Ali', 'karachi', 2147483647, 'Asad', 'lahore', 980980909, 'pickup', 2, 4, 13, 50, 'online', 130, 'pending', '2024-06-19'),
(12, 475082676540, 'Zohaib', 'gulshan-e-shamim', 923481809798, 'Zohaib', 'Gulshan-e-shamim', 2147483647, 'deliver', 2, 3, 14, 50, 'online', 130, 'delivered', '2024-06-18'),
(13, 340701289866, 'Zohaib', 'Nazimabad II', 923481809798, 'Zohaib', 'nazimabad No. 2', 980980909, 'deliver', 1, 3, 13, 100, 'cash', 240, 'pending', '2024-06-21'),
(18, 613649653848, 'Ali', 'gulshan-e-shamim', 2147483647, 'Asad', 'nazimabad No. 2', 2147483647, 'deliver', 1, 2, 13, 100, 'online', 240, 'pending', '2024-06-20');

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
  `contact` bigint(255) DEFAULT NULL,
  `data_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `password`, `status`, `branch_id`, `contact`, `data_created`) VALUES
(10, 'Admin', 'Zohaib@Ismail.com', 'Admin', 'mein-nahi-bataonga', 1, 0, NULL, '2024-05-29'),
(13, 'Asad', 'asad@gmail.com', 'agent', '123456', 1, 3, NULL, '2024-05-30'),
(14, 'Zohaib', 'Killerzobi893@gmail.com', 'agent', '123456', 1, 3, NULL, '2024-05-30'),
(18, 'Hassan', 'hassan@gmail.com', 'user', '123456', 0, NULL, 924635791864, '2024-06-22'),
(20, 'Zobi', 'zohaib@gmail.com', 'user', '123456', 0, NULL, 923481809798, '2024-06-23'),
(21, 'Ismail', 'ismail@gmail.com', 'user', '123456', 0, NULL, 923567832765, '2024-06-23');

-- --------------------------------------------------------

--
-- Table structure for table `yearly_profit`
--

CREATE TABLE `yearly_profit` (
  `id` int(255) NOT NULL,
  `year` int(255) NOT NULL,
  `profit` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `yearly_profit`
--

INSERT INTO `yearly_profit` (`id`, `year`, `profit`) VALUES
(3, 2023, 700),
(4, 2021, 600),
(5, 2022, 500),
(11, 2024, 770);

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
-- Indexes for table `yearly_profit`
--
ALTER TABLE `yearly_profit`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courier`
--
ALTER TABLE `courier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `yearly_profit`
--
ALTER TABLE `yearly_profit`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
