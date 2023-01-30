-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2022 at 03:34 AM
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
  `doctorID` int(11) DEFAULT NULL,
  `receptionistID` int(11) DEFAULT NULL,
  `patientID` int(11) DEFAULT NULL,
  `message` varchar(255) NOT NULL,
  `status` enum('Pending','Confirmed') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `billID` int(11) NOT NULL,
  `patientID` int(11) DEFAULT NULL,
  `receptionistID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `daily_report`
--

CREATE TABLE `daily_report` (
  `reportID` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `pulse` int(8) NOT NULL,
  `temperature` int(5) NOT NULL,
  `nurseID` int(11) DEFAULT NULL,
  `patientID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `doctorID` int(11) NOT NULL,
  `department` varchar(50) NOT NULL,
  `nic` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `inpatient`
--

CREATE TABLE `inpatient` (
  `patientID` int(11) NOT NULL,
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
  `itemID` int(11) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `unit_price` int(20) NOT NULL,
  `stock_on_hand` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `nurse`
--

CREATE TABLE `nurse` (
  `NurseID` int(11) NOT NULL,
  `nic` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `patientID` int(11) NOT NULL,
  `nic` varchar(12) NOT NULL,
  `weight` int(3) NOT NULL,
  `receptionistID` int(11) DEFAULT NULL,
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
  `prescriptionID` int(11) NOT NULL,
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
  `prescriptionID` int(11) NOT NULL,
  `test_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `prescriptionID` int(11) NOT NULL,
  `test_flag` enum('1','0') NOT NULL,
  `drug_flag` enum('1','0') NOT NULL,
  `date` date NOT NULL,
  `gender` enum('m','f') NOT NULL,
  `age` int(11) NOT NULL,
  `patientID` int(11) DEFAULT NULL,
  `doctorID` int(11) DEFAULT NULL,
  `investigation` varchar(40) NOT NULL,
  `Impression` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `receptionist`
--

CREATE TABLE `receptionist` (
  `receptionistID` int(11) NOT NULL,
  `nic` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_no` int(11) NOT NULL,
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
  `storekeeperID` int(11) NOT NULL,
  `nic` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `storekeeper_handles_inventory`
--

CREATE TABLE `storekeeper_handles_inventory` (
  `storekeeperID` varchar(10) NOT NULL,
  `itemID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `nic` varchar(12) NOT NULL,
  `name` varchar(255) NOT NULL,
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
('123456123456', 'Dhatchu', 'Nawala, Nugegoda, Colombo.', 'dhatchaya2000@gmail.com', 778489936, 'f', '$2y$10$qwsRzAJLjkIa4cmhduStnuP97LrNQdgT7MuOnK7VwLpiuaWH0ncym', 'Patient', 'IMG-63aaf5cb0d75d4.32332399.jpeg', NULL),
('235689135682', 'Nareash', 'Canal road, Surya road, Negombo.', 'nareash20010150@gmail.com', 778489936, 'm', '$2y$10$l1EWj3VwJwuFm1c6wyJ/VuGcbT0YERa3JQhUWPm6RU1i8wwvR0tq6', 'Doctor', 'IMG-63aaf618f1ab59.70572174.jpg', NULL),
('235689147034', 'Keshik', 'Hatton, Quatar, Dubai.', 'keshik123@gmail.com', 998473682, 'm', '$2y$10$woIvnhViE0S.yFsgNvbcLObZYl6oZH1kEQaVfwxYWauV6nr3eDh32', 'Patient', 'IMG-63aaed1c8b1dc2.11751364.jpg', NULL),
('23568914734', 'Transform', 'thyr,gyhfr,skds.', 'gthdye@gmail.com', 976946732, 'm', '$2y$10$z1MQVo86SPmdMck1WM5n3epvgOBLHGCWslBdZNOPg1rRbzDdeK5Sy', 'Receptionist', 'IMG-63aac756ef6734.26859484.png', NULL),
('453627819283', 'Rimaz', 'rtye, fght, fhur.', 'rimaz123@gmail.com', 887966474, 'm', '$2y$10$6H5W91gkDeKkcbUQa679PeBoqNgEbrpJAGz1GmnwPBTDp9UPOmKsG', 'Doctor', 'IMG-63ab239005a782.91122936.jpg', NULL),
('56748392', 'Rion', 'Lanka', 'hunt123@gmail.com', 88239, 'm', '$2y$10$3BRh0eBfeDmntGQ9alNh4.hLLkStLpKtBdM0vfXhjZxJFek2lWxPi', 'Admin', 'IMG-6374822fa2a3d9.52923471.jpg', NULL),
('657494623923', 'Tom', 'Canal road, Rosary road, Negombo.', 'yanushretf@gmail.com', 778489936, 'm', '$2y$10$bE0/fKQC3kW33ZpdpRlGaOuNShy4twa2JdupFqMuxFP6Sspa3NJyq', 'Doctor', 'IMG-63aab51ceb1030.21499977.jpg', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointmentID`),
  ADD KEY `receptionistID` (`receptionistID`),
  ADD KEY `patientID` (`patientID`),
  ADD KEY `doctorID` (`doctorID`);

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`billID`),
  ADD KEY `patientID` (`patientID`),
  ADD KEY `receptionistID` (`receptionistID`);

--
-- Indexes for table `daily_report`
--
ALTER TABLE `daily_report`
  ADD PRIMARY KEY (`reportID`),
  ADD KEY `nurseID` (`nurseID`),
  ADD KEY `patientID` (`patientID`);

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
  ADD UNIQUE KEY `nic` (`nic`),
  ADD KEY `receptionistID` (`receptionistID`);

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
  ADD PRIMARY KEY (`room_no`,`alotment_date`),
  ADD KEY `patientID` (`patientID`),
  ADD KEY `nurseID` (`nurseID`);

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
  ADD PRIMARY KEY (`itemID`,`storekeeperID`),
  ADD KEY `storekeeperID` (`storekeeperID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`nic`,`name`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password` (`password`),
  ADD UNIQUE KEY `email_2` (`email`,`password`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointmentID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `billID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `daily_report`
--
ALTER TABLE `daily_report`
  MODIFY `reportID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `doctorID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `itemID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nurse`
--
ALTER TABLE `nurse`
  MODIFY `NurseID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `patientID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `prescriptionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `receptionist`
--
ALTER TABLE `receptionist`
  MODIFY `receptionistID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `storekeeper`
--
ALTER TABLE `storekeeper`
  MODIFY `storekeeperID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `storekeeper_handles_inventory`
--
ALTER TABLE `storekeeper_handles_inventory`
  MODIFY `itemID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`receptionistID`) REFERENCES `receptionist` (`receptionistID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`patientID`) REFERENCES `patient` (`patientID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointment_ibfk_3` FOREIGN KEY (`doctorID`) REFERENCES `doctor` (`doctorID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`patientID`) REFERENCES `patient` (`patientID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_ibfk_2` FOREIGN KEY (`receptionistID`) REFERENCES `receptionist` (`receptionistID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `daily_report`
--
ALTER TABLE `daily_report`
  ADD CONSTRAINT `daily_report_ibfk_1` FOREIGN KEY (`nurseID`) REFERENCES `nurse` (`NurseID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT `doctor_ibfk_1` FOREIGN KEY (`nic`) REFERENCES `user` (`nic`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inpatient`
--
ALTER TABLE `inpatient`
  ADD CONSTRAINT `inpatient_ibfk_1` FOREIGN KEY (`nic`) REFERENCES `user` (`nic`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inpatient_ibfk_2` FOREIGN KEY (`patientID`) REFERENCES `patient` (`patientID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nurse`
--
ALTER TABLE `nurse`
  ADD CONSTRAINT `nurse_ibfk_1` FOREIGN KEY (`nic`) REFERENCES `user` (`nic`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `patient_ibfk_1` FOREIGN KEY (`nic`) REFERENCES `user` (`nic`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `patient_ibfk_2` FOREIGN KEY (`receptionistID`) REFERENCES `receptionist` (`receptionistID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `patient_ibfk_3` FOREIGN KEY (`patientID`) REFERENCES `daily_report` (`patientID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prescribed_drugs`
--
ALTER TABLE `prescribed_drugs`
  ADD CONSTRAINT `prescribed_drugs_ibfk_1` FOREIGN KEY (`prescriptionID`) REFERENCES `prescription` (`prescriptionID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prescribed_tests`
--
ALTER TABLE `prescribed_tests`
  ADD CONSTRAINT `prescribed_tests_ibfk_1` FOREIGN KEY (`prescriptionID`) REFERENCES `prescription` (`prescriptionID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prescription`
--
ALTER TABLE `prescription`
  ADD CONSTRAINT `prescription_ibfk_1` FOREIGN KEY (`patientID`) REFERENCES `patient` (`patientID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prescription_ibfk_2` FOREIGN KEY (`doctorID`) REFERENCES `doctor` (`doctorID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `receptionist`
--
ALTER TABLE `receptionist`
  ADD CONSTRAINT `receptionist_ibfk_1` FOREIGN KEY (`nic`) REFERENCES `user` (`nic`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `room_assign`
--
ALTER TABLE `room_assign`
  ADD CONSTRAINT `room_assign_ibfk_1` FOREIGN KEY (`room_no`) REFERENCES `room` (`room_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `room_assign_ibfk_2` FOREIGN KEY (`patientID`) REFERENCES `patient` (`patientID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `room_assign_ibfk_3` FOREIGN KEY (`nurseID`) REFERENCES `nurse` (`NurseID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `storekeeper`
--
ALTER TABLE `storekeeper`
  ADD CONSTRAINT `storekeeper_ibfk_1` FOREIGN KEY (`nic`) REFERENCES `user` (`nic`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `storekeeper_handles_inventory`
--
ALTER TABLE `storekeeper_handles_inventory`
  ADD CONSTRAINT `storekeeper_handles_inventory_ibfk_1` FOREIGN KEY (`itemID`) REFERENCES `inventory` (`itemID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `storekeeper_handles_inventory_ibfk_2` FOREIGN KEY (`storekeeperID`) REFERENCES `storekeeper` (`storekeeperID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
