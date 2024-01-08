-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2024 at 06:54 PM
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
-- Database: `readerszone`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `Id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Address` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`Id`, `Name`, `Address`) VALUES
(1, 'Richard Thomson', 'United Kingdom');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `Id` int(11) NOT NULL,
  `Name` varchar(500) NOT NULL,
  `Code` varchar(50) NOT NULL,
  `ISBN` varchar(50) NOT NULL,
  `Description` varchar(1000) NOT NULL,
  `Pages` int(11) NOT NULL,
  `ImageLoc` varchar(100) NOT NULL,
  `PdfLoc` varchar(100) NOT NULL,
  `CategoryId` int(11) NOT NULL,
  `PublisherId` int(11) NOT NULL,
  `AuthorId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`Id`, `Name`, `Code`, `ISBN`, `Description`, `Pages`, `ImageLoc`, `PdfLoc`, `CategoryId`, `PublisherId`, `AuthorId`) VALUES 
(1, 'Desa Kincaid, Bounty Hunter', 'DKBH', '134543215641231561', 'This book is a work of fiction. Names, characters, places, and incidents are the product of the author\'s imagination or are used fictitiously. Any resemblance to actual events, locales, or persons, living or dead, is purely coincidental', 284, 'Desa_Kincaid_Bounty_Hunter.jpeg', 'Desa_Kincaid_Bounty_Hunter.pdf', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `Id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`Id`, `Name`) VALUES
(1, 'Fictional');

-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

CREATE TABLE `publishers` (
  `Id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Country` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `publishers`
--

INSERT INTO `publishers` (`Id`, `Name`, `Country`) VALUES
(1, 'Students Publishing Point', 'UK');

-- --------------------------------------------------------

--
-- Table structure for table `shelf`
--

CREATE TABLE `shelf` (
  `Id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `bookId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shelf`
--

INSERT INTO `shelf` (`Id`, `userId`, `bookId`) VALUES
(1, 1, 0),
(6, 1, 1),
(7, 1, 9),
(9, 1, 4),
(10, 1, 6),
(11, 1, 3),
(12, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `UserName`, `Email`, `Password`) VALUES
(1, 'fahad', 'fahadnaeem424@gmail.com', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `PublisherId` (`PublisherId`),
  ADD KEY `AuthorId` (`AuthorId`),
  ADD KEY `CategoryId` (`CategoryId`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `publishers`
--
ALTER TABLE `publishers`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `shelf`
--
ALTER TABLE `shelf`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `userId` (`userId`),
  ADD KEY `bookId` (`bookId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `publishers`
--
ALTER TABLE `publishers`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shelf`
--
ALTER TABLE `shelf`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`PublisherId`) REFERENCES `publishers` (`Id`),
  ADD CONSTRAINT `books_ibfk_2` FOREIGN KEY (`AuthorId`) REFERENCES `authors` (`Id`),
  ADD CONSTRAINT `books_ibfk_3` FOREIGN KEY (`CategoryId`) REFERENCES `categories` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
