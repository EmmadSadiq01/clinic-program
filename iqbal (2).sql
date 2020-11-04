-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2020 at 05:50 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iqbal`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_paitents`
--

CREATE TABLE `add_paitents` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `city` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `age` int(3) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `current_paitents`
--

CREATE TABLE `current_paitents` (
  `id` int(11) NOT NULL,
  `paitent_id` varchar(20) NOT NULL,
  `paitent_name` varchar(30) NOT NULL,
  `meds` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `last visit`
--

CREATE TABLE `last visit` (
  `paitent_id` int(11) NOT NULL,
  `paitent_name` varchar(30) NOT NULL,
  `symtoms` text NOT NULL,
  `meds` text NOT NULL,
  `id` int(11) NOT NULL,
  `date` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `paitents_opd`
--

CREATE TABLE `paitents_opd` (
  `id` int(11) NOT NULL,
  `paitent_id` varchar(11) NOT NULL,
  `paitent_name` varchar(50) NOT NULL,
  `diabetics` varchar(10) DEFAULT 'no',
  `fever` varchar(10) NOT NULL DEFAULT 'no',
  `blood_presure` varchar(10) NOT NULL DEFAULT 'no',
  `HBa1c` varchar(100) DEFAULT NULL,
  `FBS` varchar(50) DEFAULT NULL,
  `RBS` varchar(50) DEFAULT 'Null',
  `Chol` varchar(50) NOT NULL DEFAULT 'Null',
  `Urea` varchar(50) NOT NULL DEFAULT 'Null',
  `Creatinine` varchar(50) NOT NULL DEFAULT 'Null',
  `Tryglaceride` varchar(50) NOT NULL DEFAULT 'Null',
  `weight` varchar(5) NOT NULL,
  `height` varchar(7) NOT NULL,
  `cough` varchar(10) NOT NULL DEFAULT 'no',
  `sugar` varchar(10) NOT NULL DEFAULT 'no',
  `diagnostics` text NOT NULL,
  `meds` text NOT NULL,
  `datetime` date NOT NULL DEFAULT current_timestamp(),
  `deliver` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(15) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `date`) VALUES
(1, 'dr.Iqbal', '$2y$10$GqSCRwIej3uGjfR4xNTqyeT9JoaczVDVEJruSKhdSjplJ8fdf0GeG', 'Admin', '2020-10-08 16:29:25'),
(2, 'compounder', '$2y$10$ayLuYo.PIE9wQKigCqCbpO8u/FVXd/WmfVhXZ4P3PYJeG1NhPoYAC', 'Compounder', '2020-10-08 16:30:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_paitents`
--
ALTER TABLE `add_paitents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `current_paitents`
--
ALTER TABLE `current_paitents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `last visit`
--
ALTER TABLE `last visit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paitents_opd`
--
ALTER TABLE `paitents_opd`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_paitents`
--
ALTER TABLE `add_paitents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `current_paitents`
--
ALTER TABLE `current_paitents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `last visit`
--
ALTER TABLE `last visit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paitents_opd`
--
ALTER TABLE `paitents_opd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
