--SQL Dump of the whole database
-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2021 at 03:39 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `interior_design`
--
CREATE DATABASE IF NOT EXISTS `interior_design` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `interior_design`;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `AdminID` int(15) NOT NULL,
  `Email` varchar(128) NOT NULL,
  `Password` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`AdminID`, `Email`, `Password`) VALUES
(38383838, 'admin@starlight.com', '@uon2023'); 

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `AssignmentID` int(11) NOT NULL,
  `DesignerID` int(11) NOT NULL,
  `ClientID` int(11) NOT NULL,
  `AssignmentDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `ClientID` int(15) NOT NULL,
  `FirstName` varchar(128) NOT NULL,
  `SecondName` varchar(128) NOT NULL,
  `Email` varchar(128) NOT NULL,
  `PhoneNumber` int(15) NOT NULL,
  `Location` varchar(128) NOT NULL,
  `Password` varchar(128) NOT NULL,
  `RegistrationDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `designers`
--

CREATE TABLE `designers` (
  `DesignerID` int(15) NOT NULL,
  `FirstName` varchar(128) NOT NULL,
  `SecondName` varchar(128) NOT NULL,
  `Email` varchar(128) NOT NULL,
  `PhoneNumber` int(15) NOT NULL,
  `Location` varchar(128) NOT NULL,
  `Password` varchar(128) NOT NULL,
  `RegistrationDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `drawings`
--

CREATE TABLE `drawings` (
  `DrawingID` int(20) NOT NULL,
  `DesignerID` int(20) NOT NULL,
  `DrawingPic` varchar(128) NOT NULL,
  `DrawingDescription` varchar(255) NOT NULL,
  `SubmissionDate` datetime NOT NULL,
  `DrawingStatus` varchar(128) NOT NULL DEFAULT 'unapproved',
  `ClientID` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `NotificationID` int(15) NOT NULL,
  `ReceiverID` int(15) NOT NULL,
  `Message` varchar(255) NOT NULL,
  `NotificationTag` varchar(128) NOT NULL,
  `CreationDate` datetime NOT NULL,
  `Status` varchar(128) NOT NULL DEFAULT 'unread'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `PaymentID` int(11) NOT NULL,
  `ClientID` int(20) NOT NULL,
  `AmountPaid` int(20) NOT NULL,
  `PaymentPlatform` varchar(128) NOT NULL,
  `PaymentPurpose` varchar(128) NOT NULL,
  `SubmissionDate` datetime NOT NULL,
  `PaymentStatus` varchar(128) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `requirements`
--

CREATE TABLE `requirements` (
  `RequirementsID` int(25) NOT NULL,
  `ClientID` int(15) NOT NULL,
  `RoomType` varchar(128) NOT NULL,
  `RoomPicture` varchar(128) NOT NULL,
  `RoomSize` varchar(128) NOT NULL,
  `FavColors` varchar(128) NOT NULL,
  `DisColors` varchar(128) NOT NULL,
  `FloorType` varchar(128) NOT NULL,
  `WallType` varchar(128) NOT NULL,
  `InspoPic` varchar(128) NOT NULL,
  `SpecialNeeds` varchar(128) NOT NULL,
  `Budget` int(15) NOT NULL,
  `AnyOtherInfo` varchar(128) NOT NULL,
  `SubmissionDate` datetime NOT NULL,
  `ReqStatus` varchar(128) NOT NULL DEFAULT 'unassigned',
  `AssignedDesigner` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `TaskID` int(20) NOT NULL,
  `DesignerID` int(20) NOT NULL,
  `TaskMessage` varchar(255) NOT NULL,
  `CreationDate` datetime NOT NULL,
  `TaskStatus` varchar(128) NOT NULL DEFAULT 'undone'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`AdminID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`AssignmentID`),
  ADD KEY `DesignerID` (`DesignerID`),
  ADD KEY `ClientID` (`ClientID`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`ClientID`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `PhoneNumber` (`PhoneNumber`),

--
-- Indexes for table `designers`
--
ALTER TABLE `designers`
  ADD PRIMARY KEY (`DesignerID`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `PhoneNumber` (`PhoneNumber`);

--
-- Indexes for table `drawings`
--
ALTER TABLE `drawings`
  ADD PRIMARY KEY (`DrawingID`),
  ADD KEY `DesignerID` (`DesignerID`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`NotificationID`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`PaymentID`),
  ADD KEY `ClientID` (`ClientID`);

--
-- Indexes for table `requirements`
--
ALTER TABLE `requirements`
  ADD PRIMARY KEY (`RequirementsID`),
  ADD KEY `ClientID` (`ClientID`),
  ADD KEY `AssignedDesigner` (`AssignedDesigner`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`TaskID`),
  ADD KEY `DesignerID` (`DesignerID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `AssignmentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `drawings`
--
ALTER TABLE `drawings`
  MODIFY `DrawingID` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `NotificationID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `requirements`
--
ALTER TABLE `requirements`
  MODIFY `RequirementsID` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `TaskID` int(20) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignments`
--
ALTER TABLE `assignments`
  ADD CONSTRAINT `assignments_ibfk_1` FOREIGN KEY (`DesignerID`) REFERENCES `designers` (`DesignerID`),
  ADD CONSTRAINT `assignments_ibfk_2` FOREIGN KEY (`ClientID`) REFERENCES `clients` (`ClientID`);

--
-- Constraints for table `drawings`
--
ALTER TABLE `drawings`
  ADD CONSTRAINT `drawings_ibfk_1` FOREIGN KEY (`DesignerID`) REFERENCES `designers` (`DesignerID`),
  ADD CONSTRAINT `drawings_ibfk_2` FOREIGN KEY (`DesignerID`) REFERENCES `designers` (`DesignerID`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`ClientID`) REFERENCES `clients` (`ClientID`);

--
-- Constraints for table `requirements`
--
ALTER TABLE `requirements`
  ADD CONSTRAINT `ClientID` FOREIGN KEY (`ClientID`) REFERENCES `clients` (`ClientID`),
  ADD CONSTRAINT `requirements_ibfk_1` FOREIGN KEY (`ClientID`) REFERENCES `clients` (`ClientID`),
  ADD CONSTRAINT `requirements_ibfk_2` FOREIGN KEY (`AssignedDesigner`) REFERENCES `designers` (`DesignerID`);

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`DesignerID`) REFERENCES `designers` (`DesignerID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;