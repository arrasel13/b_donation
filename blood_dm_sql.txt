-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Aug 19, 2022 at 03:45 PM
-- Server version: 5.7.34
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blood_dm`
--

-- --------------------------------------------------------

--
-- Table structure for table `blood_group`
--

CREATE TABLE `blood_group` (
  `id` int(2) NOT NULL,
  `b_group_name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blood_group`
--

INSERT INTO `blood_group` (`id`, `b_group_name`, `status`) VALUES
(1, 'A(+)', 1),
(2, 'A(-)', 1),
(3, 'B(+)', 1),
(4, 'B(-)', 1),
(5, 'O(+)', 1),
(6, 'O(-)', 1),
(7, 'AB(+)', 1),
(8, 'AB(-)', 1);

-- --------------------------------------------------------

--
-- Table structure for table `b_d_history`
--

CREATE TABLE `b_d_history` (
  `id` int(3) NOT NULL,
  `u_id` int(3) NOT NULL,
  `u_name` varchar(255) NOT NULL,
  `donate_date` varchar(255) NOT NULL,
  `t_year` int(3) NOT NULL,
  `t_months` int(3) NOT NULL,
  `t_days` int(3) NOT NULL,
  `d_available` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `b_d_history`
--

INSERT INTO `b_d_history` (`id`, `u_id`, `u_name`, `donate_date`, `t_year`, `t_months`, `t_days`, `d_available`) VALUES
(1, 1, 'AR Rasel', '01-01-2022', 0, 7, 19, 1),
(2, 1, 'AR Rasel', '01-04-2022', 0, 4, 19, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(3) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_role` int(1) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `display_name`, `user_image`, `email`, `password`, `user_role`) VALUES
(1, 'AR Rasel', 'assets/img/doners/ar.png', 'admin@admin.com', 'c20ad4d76fe97759aa27a0c99bff6710', 1),
(2, 'Minhaz Faisal', 'assets/img/doners/default.png', 'minhazfaisal@test.com', '7998730c62c4a8d0bb98f1bfb41ab56f', 2),
(3, 'Tanzir Rifat', 'assets/img/doners/default.png', 'trifat@test.com', 'c4ca4238a0b923820dcc509a6f75849b', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users_info`
--

CREATE TABLE `users_info` (
  `id` int(3) NOT NULL,
  `u_id` int(3) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `age` int(2) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `b_group_id` int(2) NOT NULL,
  `contact_address` text NOT NULL,
  `additional_info` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_info`
--

INSERT INTO `users_info` (`id`, `u_id`, `fname`, `lname`, `contact_number`, `dob`, `age`, `gender`, `b_group_id`, `contact_address`, `additional_info`, `created_at`, `status`) VALUES
(1, 1, 'AR', 'Rasel', '01234567891', '26-10-1990', 32, 0, 6, 'House: 201, Road 9/A (new)\r\nWest Dhanmondi, Dhaka', 'No Complication', '2022-08-18 04:23:46', 1),
(2, 2, 'Minhaz', 'Faisal', '01231231231', '01-01-1989', 33, 0, 1, 'Banani, Dhaka', 'Will Add Later', '2022-08-18 04:42:29', 1),
(3, 3, 'Tanzir', 'Rifat', '01231231232', '01-01-2005', 17, 0, 2, 'Mirpur - 10, Dhaka', 'No Additional Data Added', '2022-08-18 04:48:29', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blood_group`
--
ALTER TABLE `blood_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `b_d_history`
--
ALTER TABLE `b_d_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_info`
--
ALTER TABLE `users_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blood_group`
--
ALTER TABLE `blood_group`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `b_d_history`
--
ALTER TABLE `b_d_history`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users_info`
--
ALTER TABLE `users_info`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
