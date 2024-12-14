-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2023 at 06:12 AM
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
-- Database: `matatu_sacco`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `pickup_datetime` datetime NOT NULL,
  `dropoff_location` varchar(255) NOT NULL,
  `route_id` int(11) NOT NULL,
  `start_location` varchar(100) NOT NULL,
  `end_location` varchar(100) NOT NULL,
  `distance` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `pickup_datetime`, `dropoff_location`, `route_id`, `start_location`, `end_location`, `distance`, `price`) VALUES
(1, '2023-08-09 06:43:00', 'Juja Stage', 1, 'CBD', 'Juja', '10.5', '100'),
(2, '2023-08-09 06:50:00', 'Yaya center', 2, 'CBD', 'Westlands Yaya', '8.2', '80'),
(3, '2023-08-09 06:50:00', 'Yaya center', 2, 'CBD', 'Westlands Yaya', '8.2', '80'),
(4, '2023-08-09 06:50:00', 'Yaya center', 2, 'CBD', 'Westlands Yaya', '8.2', '80'),
(5, '2023-08-09 06:50:00', 'Yaya center', 2, 'CBD', 'Westlands Yaya', '8.2', '80'),
(6, '2023-08-09 06:50:00', 'Yaya center', 2, 'CBD', 'Westlands Yaya', '8.2', '80'),
(7, '2023-08-09 06:50:00', 'Yaya center', 2, 'CBD', 'Westlands Yaya', '8.2', '80');

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `phonenumber` varchar(255) DEFAULT NULL,
  `licensenumber` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`id`, `fullname`, `phonenumber`, `licensenumber`) VALUES
(1, 'Jane Doe', '00809809809', '978979');

-- --------------------------------------------------------

--
-- Table structure for table `matatus`
--

CREATE TABLE `matatus` (
  `matatunumber` varchar(255) NOT NULL,
  `owner` varchar(255) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matatus`
--

INSERT INTO `matatus` (`matatunumber`, `owner`, `route`) VALUES
('23423423', 'Lilian Kamene', 'karen');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `memberid` int(11) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `phonenumber` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `dateofjoining` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`memberid`, `fullname`, `phonenumber`, `email`, `dateofjoining`) VALUES
(1, 'John Doe', '1234567890', 'john@example.com', '2023-08-10'),
(2, 'Jane Smith', '9876543210', 'jane@example.com', '2023-08-11'),
(3, 'Michael Johnson', '5554443333', 'michael@example.com', '2023-08-12'),
(4, 'Emily Brown', '1112223333', 'emily@example.com', '2023-08-13'),
(5, 'William Davis', '4445556666', 'william@example.com', '2023-08-14');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `payment_date` datetime NOT NULL,
  `passenger` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `booking_id`, `amount`, `payment_method`, `payment_date`, `passenger`) VALUES
(1, 2, 80.00, 'cash', '2023-08-09 05:50:40', 'Japheth Buroti'),
(2, 4, 80.00, 'cash', '2023-08-09 05:52:53', 'Japheth Buroti'),
(3, 6, 80.00, 'cash', '2023-08-09 05:52:56', 'Japheth Buroti'),
(4, 8, 80.00, 'cash', '2023-08-09 05:57:15', 'Japheth Buroti');

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `route_id` int(11) NOT NULL,
  `route_name` varchar(255) NOT NULL,
  `start_location` varchar(255) NOT NULL,
  `end_location` varchar(255) NOT NULL,
  `distance` float NOT NULL,
  `price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`route_id`, `route_name`, `start_location`, `end_location`, `distance`, `price`) VALUES
(1, 'Route A', 'CBD', 'Juja', 10.5, '100'),
(2, 'Route B', 'CBD', 'Westlands Yaya', 8.2, '80'),
(3, 'Route C', 'CBD ', 'Karen Bogani', 15.7, '120'),
(4, 'Route D', 'Start Location D', 'End Location D', 5.3, '50'),
(5, 'Route E', 'Start Location E', 'End Location E', 12, '150');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `email`, `password`, `phone`, `address`, `created_at`, `role`) VALUES
(1, 'Makena', 'makena@example.com', '123', '978979897', 'Karen', NULL, 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `matatus`
--
ALTER TABLE `matatus`
  ADD PRIMARY KEY (`matatunumber`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`memberid`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`route_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `memberid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
