-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 12, 2021 at 10:16 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Orphanage`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_types`
--

CREATE TABLE `account_types` (
  `type_id` int(11) NOT NULL,
  `account_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account_types`
--

INSERT INTO `account_types` (`type_id`, `account_type`) VALUES
(1, 'Admin'),
(2, 'Supervisor');

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `id` int(11) NOT NULL,
  `d_name` varchar(255) NOT NULL,
  `d_gender` varchar(255) NOT NULL,
  `d_address` varchar(255) NOT NULL,
  `d_phone` varchar(11) NOT NULL,
  `d_identification` varchar(14) NOT NULL,
  `d_amount` varchar(11) NOT NULL,
  `d_method` int(11) DEFAULT NULL,
  `d_time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`id`, `d_name`, `d_gender`, `d_address`, `d_phone`, `d_identification`, `d_amount`, `d_method`, `d_time`) VALUES
(10, 'Islam', 'Male', 'Giza', '01126683396', '35729379223897', '1800', 1, '2021-01-04 15:34:55'),
(11, 'Salma', 'Female', 'Maadi', '01126683344', '22729379223333', '2500', 1, '2021-01-01 16:29:57'),
(14, 'Nour', 'Female', 'Alexandria', '01172284463', '22647688127440', '4000', 1, '2021-01-01 17:08:14'),
(15, 'Amr', 'Male', 'Helwan', '01763984688', '22647688127440', '200', 2, '2021-01-01 17:13:36'),
(16, 'Habiba', 'Female', 'Madinet Nasr', '01162783604', '26738645372654', '2000', 2, '2021-01-04 15:37:35'),
(17, 'Ayman', 'Male', 'Maadi', '01157756684', '22637876352635', '100', 1, '2021-01-05 09:17:44');

-- --------------------------------------------------------

--
-- Table structure for table `donations2`
--

CREATE TABLE `donations2` (
  `id` int(11) NOT NULL,
  `d_name` varchar(255) NOT NULL,
  `d_gender` varchar(255) NOT NULL,
  `d_address` varchar(255) NOT NULL,
  `d_phone` varchar(11) NOT NULL,
  `d_identification` varchar(14) NOT NULL,
  `d_amount` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donations2`
--

INSERT INTO `donations2` (`id`, `d_name`, `d_gender`, `d_address`, `d_phone`, `d_identification`, `d_amount`) VALUES
(1, 'Islam', 'Male', 'Giza', '01198876638', '25636363678892', '500');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `salary` int(10) NOT NULL,
  `rank` varchar(255) NOT NULL,
  `PhoneNumber` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `address`, `salary`, `rank`, `PhoneNumber`) VALUES
(1, 'Ahmad', 'Maadi', 3000, 'SuperVisor', '01158856604'),
(4, 'Ali', 'Zayed', 1500, 'Teacher', '01287368142'),
(6, 'Ammar', 'Zahraa Maadi', 1200, 'Teacher', '01158856602'),
(10, 'Gohary', 'Zayed', 1800, 'Teacher', '01158856604'),
(12, 'Omar', 'New Cairo', 1000, 'Cheif', '01187793304'),
(13, 'Mohammed', 'Alexandria', 2000, 'Driver', '01157748829'),
(14, 'Kareem', 'Maadi', 2400, 'Teacher', '01178833672');

-- --------------------------------------------------------

--
-- Table structure for table `orphans`
--

CREATE TABLE `orphans` (
  `id` int(11) NOT NULL,
  `o_name` varchar(255) NOT NULL,
  `o_birthdate` date NOT NULL,
  `o_gender` varchar(255) NOT NULL,
  `o_nationality` varchar(255) NOT NULL,
  `o_height` int(11) NOT NULL,
  `o_weight` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orphans`
--

INSERT INTO `orphans` (`id`, `o_name`, `o_birthdate`, `o_gender`, `o_nationality`, `o_height`, `o_weight`) VALUES
(1, 'Omar', '2018-05-16', 'Male', 'Egyptian', 30, 45),
(2, 'Salma', '2000-04-21', 'Female', 'Egyptian', 167, 67),
(5, 'Kareem', '2000-02-01', 'Male', 'Egyptian', 167, 70);

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `payment_ID` int(11) NOT NULL,
  `payment_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`payment_ID`, `payment_name`) VALUES
(1, 'Cash'),
(2, 'Credit Card');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `d_name` varchar(255) NOT NULL,
  `d_address` varchar(255) NOT NULL,
  `d_phone` varchar(11) NOT NULL,
  `d_identification` varchar(14) NOT NULL,
  `d_category` varchar(255) NOT NULL,
  `d_pname` varchar(255) NOT NULL,
  `d_quantity` varchar(255) NOT NULL,
  `d_time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `d_name`, `d_address`, `d_phone`, `d_identification`, `d_category`, `d_pname`, `d_quantity`, `d_time`) VALUES
(23, 'Hazem', 'New Cairo', '01167735522', '22635489762367', 'Games', 'Uno', '10', '2021-01-11 19:55:29'),
(24, 'Mazen', 'October', '01162273362', '22647688127432', 'Clothes', 'Black Jacket', '1', '2021-01-11 19:28:04');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `status_ID` int(11) NOT NULL,
  `status_Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_ID`, `status_Name`) VALUES
(1, 'Active'),
(2, 'Disabled');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(16) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  `create_time` timestamp NULL DEFAULT current_timestamp(),
  `ID` int(11) NOT NULL,
  `statusID` int(11) DEFAULT NULL,
  `accountType` int(11) DEFAULT NULL,
  `Phone Number` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `email`, `password`, `create_time`, `ID`, `statusID`, `accountType`, `Phone Number`) VALUES
('aeid4', 'aeid4@gmail.com', '12345678', '2020-11-06 15:17:58', 1, 1, 1, '01009450710'),
('AKHALED', 'hjgsdfhj', '123456789', '2020-11-06 16:53:54', 2, 1, 2, '01237893305'),
('admin', 'admin@gmail.com', 'admin', '2020-11-11 09:35:09', 3, 1, 1, '01158856604');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_types`
--
ALTER TABLE `account_types`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `method` (`d_method`);

--
-- Indexes for table `donations2`
--
ALTER TABLE `donations2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orphans`
--
ALTER TABLE `orphans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`payment_ID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_Type` (`accountType`),
  ADD KEY `user_Status` (`statusID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_types`
--
ALTER TABLE `account_types`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `donations2`
--
ALTER TABLE `donations2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orphans`
--
ALTER TABLE `orphans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `payment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `status_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `donations`
--
ALTER TABLE `donations`
  ADD CONSTRAINT `method` FOREIGN KEY (`d_method`) REFERENCES `payment_method` (`payment_ID`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `user_Status` FOREIGN KEY (`statusID`) REFERENCES `status` (`status_ID`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_Type` FOREIGN KEY (`accountType`) REFERENCES `account_types` (`type_id`) ON DELETE SET NULL ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
