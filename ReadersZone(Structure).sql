SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `authors` (
  `Id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Address` varchar(500) NOT NULL
);

CREATE TABLE `books` (
  `Id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
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
);

CREATE TABLE `categories` (
  `Id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL
);

CREATE TABLE `chat_message` (
  `chat_message_id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `to_user_id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `chat_message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL
);

CREATE TABLE `market` (
  `Id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `bookId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `Contact` varchar(100) NOT NULL,
  `Address` varchar(5000) NOT NULL,
  `Price` int(11) NOT NULL,
  `Remarks` varchar(5000) NOT NULL
);

CREATE TABLE `publishers` (
  `Id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Country` varchar(100) NOT NULL
);

CREATE TABLE `reviews` (
  `Id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `bookId` int(11) NOT NULL,
  `Review` varchar(5000) NOT NULL,
  `Rating` int(11) NOT NULL
);

CREATE TABLE `shelf` (
  `Id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `bookId` int(11) NOT NULL
);

CREATE TABLE `users` (
  `Id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `UserName` varchar(100) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `userType` varchar(10) NOT NULL,
  `Bio` varchar(5000) NOT NULL,
  `FavouriteQuote` varchar(1000) NOT NULL
);

CREATE TABLE `login_details` (
  `login_details_id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `UserId` int(11) NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_type` enum('no','yes') NOT NULL
);

CREATE TABLE `favcategories` (
  `Id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL
);

COMMIT;