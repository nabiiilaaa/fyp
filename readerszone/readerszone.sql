-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2024 at 12:34 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

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
(1, 'Richard Thomson', 'United Kingdom'),
(2, 'J.K. Rowling', 'UK'),
(3, 'Colleen Hoover', 'US'),
(5, 'Douglas Adams', 'Cambridge, England'),
(6, 'Bill Bryson', 'US');

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
(1, 'Desa Kincaid, Bounty Hunter', 'DKBH', '134543215641231561', 'This book is a work of fiction. Names, characters, places, and incidents are the product of the author\'s imagination or are used fictitiously. Any resemblance to actual events, locales, or persons, living or dead, is purely coincidental', 284, 'Desa_Kincaid_Bounty_Hunter.jpeg', 'Desa_Kincaid_Bounty_Hunter.pdf', 1, 1, 1),
(16, 'Harry Potter and the Chamber of Secrets #2', 'HP', '\'0439554896', '', 352, 'HP B2 Chamber of secrets.jpeg', 'Harry Potter and The Chamber of Secrets.pdf', 2, 2, 2),
(17, 'Harry Potter and the Prisoner of Azkaban #3', 'HP', '043965548X', '', 435, 'HP B3 Prisoner of Azkaban.jpeg', 'HARRY POTTER AND THE PRISONER OF AZKABAN.pdf', 2, 2, 2),
(18, 'It ends with us', 'IEWU', '978-1-5011-1036-8 ', '', 376, 'It_Ends_with_Us_(Colleen_Hoover).png', '', 3, 3, 3),
(19, 'It Starts with Us', 'ISWU', '		978-1-66800-122-6 ', '', 336, 'It_Starts_with_Us_(Colleen_Hoover).png', '', 3, 3, 3),
(20, 'November 9', 'N9', '9781432897291', 'You’ll never be able to find yourself if you’re lost in someone else.\r\n\r\nFallon meets Ben, an aspiring novelist, the day before her scheduled cross-country move. Their untimely attraction leads them to spend Fallon’s last day in L.A. together, and her eventful life becomes the creative inspiration Ben has always sought for his novel. Over time and amidst the various relationships and tribulations of their own separate lives, they continue to meet on the same date every year. Until one day Fallon becomes unsure if Ben has been telling her the truth or fabricating a perfect reality for the sake of the ultimate plot twist.\r\n\r\nCan Ben’s relationship with Fallon – and simultaneously his novel – be considered a love story if it ends in heartbreak', 307, 'November9.jpeg', '', 3, 3, 3),
(21, 'Verity', 'V', '9781791392796', 'Lowen Ashleigh is a struggling writer on the brink of financial ruin when she accepts the job offer of a lifetime. Jeremy Crawford, husband of bestselling author Verity Crawford, has hired Lowen to complete the remaining books in a successful series his injured wife is unable to finish.\r\n\r\nLowen arrives at the Crawford home, ready to sort through years of Verity\'s notes and outlines, hoping to find enough material to get her started. What Lowen doesn\'t expect to uncover in the chaotic office is an unfinished autobiography Verity never intended for anyone to read. Page after page of bone-chilling admissions, including Verity\'s recollection of the night their family was forever altered.\r\n\r\nLowen decides to keep the manuscript hidden from Jeremy, knowing its contents would devastate the already-grieving father. But as Lowen\'s feelings for Jeremy begin to intensify, she recognizes all the ways she could benefit if he were to read his wife\'s words. After all, no matter how devoted Jeremy is', 336, 'Verity_cover.png', '', 5, 5, 3),
(25, 'A Short History of \r\nNearly Everything', 'ASHONE', '0-7679-0817-1', 'Bryson describes graphically and in layperson\'s terms the size of the universe and that of atoms and subatomic particles. He then explores the history of geology and biology and traces life from its first appearance to today\'s modern humans, emphasizing the development of the modern Homo sapiens. Furthermore, he discusses the possibility of the Earth being struck by a meteorite and reflects on human capabilities of spotting a meteor before it impacts the Earth, and the extensive damage that such an event would cause. He also describes some of the most recent destructive disasters of volcanic origin in the history of our planet, including Krakatoa and Yellowstone National Park.\r\n\r\nA large part of the book is devoted to relating humorous stories about the scientists behind the research and discoveries and their sometimes eccentric behaviours. Bryson also speaks about modern scientific views on human effects on the Earth\'s climate and livelihood of other species, and the magnitude of natu', 0, 'short history of nearly everything.jpeg', '', 7, 7, 6),
(26, 'Brysons dictionary of troublesome words', 'BDOTW', '0-7679-1043-5', '', 0, 'Brysons dictinary of troublesome words.jpg', '', 7, 7, 6);

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
(1, 'Fictional'),
(2, 'Stories'),
(3, 'Romance'),
(5, 'Thriller'),
(7, 'Non-fictional');

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
(1, 'Students Publishing Point', 'UK'),
(2, 'Scholastic Inc.', 'UK'),
(3, 'Atria Books', 'US'),
(5, 'Little, Brown Book Group', 'US'),
(7, 'Broadway Books', '');

-- --------------------------------------------------------

-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `Id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `bookId` int(11) NOT NULL,
  `Review` varchar(5000) NOT NULL,
  `Rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(16, 1, 1),
(18, 2, 18),
(20, 2, 20),
(21, 2, 21),
(22, 2, 25),
(23, 3, 1),
(24, 2, 1);

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
(2, 'nabila', 'nabila123@gmail.com', '123'),
(3, 'sadia', 'sadia0000@gmail.com', '0000');

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
-- Indexes for table `reviews`

--
ALTER TABLE `reviews`
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
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `publishers`
--
ALTER TABLE `publishers`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shelf`
--
ALTER TABLE `shelf`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
