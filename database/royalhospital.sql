-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2022 at 09:46 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `royalhospital`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointmentID` int(10) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `venue` varchar(50) NOT NULL,
  `doctorID` varchar(10) NOT NULL,
  `receptionistID` varchar(10) NOT NULL,
  `patientID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `billID` varchar(10) NOT NULL,
  `patientID` varchar(10) NOT NULL,
  `receptionistID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `daily_report`
--

CREATE TABLE `daily_report` (
  `reportID` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `pulse` int(8) NOT NULL,
  `temperature` int(5) NOT NULL,
  `nurseID` varchar(10) NOT NULL,
  `patientID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `doctorID` varchar(10) NOT NULL,
  `department` varchar(50) NOT NULL,
  `nic` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `inpatient`
--

CREATE TABLE `inpatient` (
  `patientID` varchar(10) NOT NULL,
  `nic` varchar(12) NOT NULL,
  `admit_time` time(6) NOT NULL,
  `admit_duration` time(6) NOT NULL,
  `admit_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `itemID` varchar(10) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `unit_price` int(20) NOT NULL,
  `stock_on_hand` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `nurse`
--

CREATE TABLE `nurse` (
  `NurseID` varchar(10) NOT NULL,
  `nic` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `patientID` varchar(10) NOT NULL,
  `nic` varchar(12) NOT NULL,
  `weight` int(3) NOT NULL,
  `receptionistID` varchar(10) NOT NULL,
  `patient_type` enum('inpatient','outpatient') NOT NULL,
  `height` int(11) NOT NULL,
  `illness` varchar(100) NOT NULL,
  `drug_allergies` varchar(100) NOT NULL,
  `medical_history_comments` varchar(100) NOT NULL,
  `currently_using_medicine` varchar(100) NOT NULL,
  `emergency_contact` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `prescribed_drugs`
--

CREATE TABLE `prescribed_drugs` (
  `prescriptionID` varchar(10) NOT NULL,
  `drug_name` varchar(50) NOT NULL,
  `days` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `frequency` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `prescribed_tests`
--

CREATE TABLE `prescribed_tests` (
  `prescriptionID` varchar(10) NOT NULL,
  `test_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `prescriptionID` varchar(10) NOT NULL,
  `test_flag` enum('1','0') NOT NULL,
  `drug_flag` enum('1','0') NOT NULL,
  `date` date NOT NULL,
  `gender` enum('m','f') NOT NULL,
  `age` int(11) NOT NULL,
  `patientID` varchar(20) NOT NULL,
  `doctorID` varchar(20) NOT NULL,
  `investigation` varchar(40) NOT NULL,
  `Impression` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `receptionist`
--

CREATE TABLE `receptionist` (
  `receptionistID` varchar(10) NOT NULL,
  `nic` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_no` int(3) NOT NULL,
  `room_availability` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `room_assign`
--

CREATE TABLE `room_assign` (
  `room_no` int(3) NOT NULL,
  `alotment_date` date NOT NULL,
  `admit_period` time NOT NULL,
  `patientID` varchar(10) NOT NULL,
  `nurseID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `storekeeper`
--

CREATE TABLE `storekeeper` (
  `storekeeperID` varchar(10) NOT NULL,
  `nic` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `storekeeper_handles_inventory`
--

CREATE TABLE `storekeeper_handles_inventory` (
  `storekeeperID` varchar(10) NOT NULL,
  `itemID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `nic` varchar(12) NOT NULL,
  `name` text NOT NULL,
  `address` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact_num` int(10) NOT NULL,
  `gender` enum('m','f') NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_role` enum('Admin','Doctor','Nurse','Receptionist','Patient','Storekeeper') NOT NULL,
  `profile_image` text NOT NULL,
  `DOB` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`nic`, `name`, `address`, `email`, `contact_num`, `gender`, `password`, `user_role`, `profile_image`, `DOB`) VALUES
('1237123576', 'Dhatchaya', 'Nawala', 'dhatchaya2000@gmail.com', 79238467, 'f', '$2y$10$fp57SiIQjXJwEkbMLINVCeHBzmwgv2rpfrWieM.l5Vq4CF5/qszsq', 'Doctor', 'IMG-6397500255a430.15571096.jpeg', NULL),
('200101503536', 'Nareash', 'Negombo', 'nareash20010150@gmail.com', 778489936, 'm', '$2y$10$KtqGeMTh8dTjBmUDgs/eGellv.IN3guV2m7bCsNlfp.UWZSkjPbmS', 'Patient', 'IMG-63771ce04a18b0.29589090.jpg', NULL),
('324234', 'Tom', 'dfjskldflk', 'dsfksd@gmail.com', 1231233, 'm', '$2y$10$xtvLJ4wTQ0ww5nrSIzKkeuwZ/NKOpS2xyHpLqUweuRZHzmHH33lqC', 'Doctor', 'IMG-6397a04bbf67f9.55245285.jpg', NULL),
('4567788', '12345', 'Kandy', 'Harry@gmail.com', 765433, 'm', '$2y$10$KfHFgzXPBSZ.ZanaUZ.3gOghPnF52qhtziNaA.Ppg8HlltyLJr0Tm', 'Patient', 'IMG-6398422c64ad81.29055983.png', NULL),
('56748392', 'Rion', 'Lanka', 'hunt123@gmail.com', 88239, 'm', '$2y$10$3BRh0eBfeDmntGQ9alNh4.hLLkStLpKtBdM0vfXhjZxJFek2lWxPi', 'Admin', 'IMG-6374822fa2a3d9.52923471.jpg', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointmentID`);

--
-- Indexes for table `daily_report`
--
ALTER TABLE `daily_report`
  ADD PRIMARY KEY (`reportID`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doctorID`),
  ADD UNIQUE KEY `nic` (`nic`);

--
-- Indexes for table `inpatient`
--
ALTER TABLE `inpatient`
  ADD PRIMARY KEY (`patientID`),
  ADD UNIQUE KEY `nic` (`nic`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`itemID`);

--
-- Indexes for table `nurse`
--
ALTER TABLE `nurse`
  ADD PRIMARY KEY (`NurseID`),
  ADD UNIQUE KEY `nic` (`nic`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patientID`),
  ADD UNIQUE KEY `nic` (`nic`);

--
-- Indexes for table `prescribed_drugs`
--
ALTER TABLE `prescribed_drugs`
  ADD PRIMARY KEY (`prescriptionID`,`drug_name`);

--
-- Indexes for table `prescribed_tests`
--
ALTER TABLE `prescribed_tests`
  ADD PRIMARY KEY (`prescriptionID`,`test_name`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`prescriptionID`),
  ADD KEY `patientID` (`patientID`),
  ADD KEY `doctorID` (`doctorID`);

--
-- Indexes for table `receptionist`
--
ALTER TABLE `receptionist`
  ADD PRIMARY KEY (`receptionistID`),
  ADD UNIQUE KEY `nic` (`nic`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_no`);

--
-- Indexes for table `room_assign`
--
ALTER TABLE `room_assign`
  ADD PRIMARY KEY (`room_no`,`alotment_date`);

--
-- Indexes for table `storekeeper`
--
ALTER TABLE `storekeeper`
  ADD PRIMARY KEY (`storekeeperID`),
  ADD UNIQUE KEY `nic` (`nic`);

--
-- Indexes for table `storekeeper_handles_inventory`
--
ALTER TABLE `storekeeper_handles_inventory`
  ADD PRIMARY KEY (`itemID`,`storekeeperID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`nic`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password` (`password`),
  ADD UNIQUE KEY `email_2` (`email`,`password`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
