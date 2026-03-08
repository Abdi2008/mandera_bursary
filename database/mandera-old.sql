-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 30, 2023 at 08:59 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mandera`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `email` varchar(120) NOT NULL,
  `username` varchar(120) NOT NULL,
  `password` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `email`, `username`, `password`) VALUES
(1, 'mandera@gmail.com', 'admin', 'cGFzc3dvcmQ=');

-- --------------------------------------------------------

--
-- Table structure for table `bursary_activity`
--

CREATE TABLE `bursary_activity` (
  `bursary_id` int(11) NOT NULL,
  `period_name` varchar(120) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `p_year` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bursary_activity`
--

INSERT INTO `bursary_activity` (`bursary_id`, `period_name`, `amount`, `p_year`) VALUES
(3, 'Jan to April', '20000.00', '2023');

-- --------------------------------------------------------

--
-- Table structure for table `bursary_application`
--

CREATE TABLE `bursary_application` (
  `application_id` int(11) NOT NULL,
  `gender` varchar(80) NOT NULL,
  `reg_num` varchar(120) NOT NULL,
  `phone` int(30) NOT NULL,
  `guardian` varchar(120) NOT NULL,
  `residence` varchar(120) NOT NULL,
  `r_location` varchar(120) NOT NULL,
  `sub_location` varchar(120) NOT NULL,
  `village` varchar(120) NOT NULL,
  `account` varchar(120) NOT NULL,
  `bank` varchar(120) NOT NULL,
  `tel_num` int(20) NOT NULL,
  `town` varchar(120) NOT NULL,
  `address` varchar(120) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `student_id` int(11) NOT NULL,
  `bursary_id` int(11) NOT NULL,
  `a_status` varchar(120) NOT NULL DEFAULT 'Pending',
  `given_amount` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `fullname` varchar(80) NOT NULL,
  `email` varchar(120) NOT NULL,
  `school` varchar(120) NOT NULL,
  `location` varchar(80) NOT NULL,
  `password` varchar(120) NOT NULL,
  `del` int(13) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `fullname`, `email`, `school`, `location`, `password`, `del`) VALUES
(2, 'paul kamau ', 'k@gmail.com', 'MKU', 'Kivaa', 'MTIz', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `bursary_activity`
--
ALTER TABLE `bursary_activity`
  ADD PRIMARY KEY (`bursary_id`);

--
-- Indexes for table `bursary_application`
--
ALTER TABLE `bursary_application`
  ADD PRIMARY KEY (`application_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `bursary_id` (`bursary_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bursary_activity`
--
ALTER TABLE `bursary_activity`
  MODIFY `bursary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bursary_application`
--
ALTER TABLE `bursary_application`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bursary_application`
--
ALTER TABLE `bursary_application`
  ADD CONSTRAINT `bursary_application_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`),
  ADD CONSTRAINT `bursary_application_ibfk_2` FOREIGN KEY (`bursary_id`) REFERENCES `bursary_activity` (`bursary_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
