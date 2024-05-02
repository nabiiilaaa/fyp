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

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `chat_message`
--
ALTER TABLE `chat_message`
  ADD PRIMARY KEY (`chat_message_id`);

--
-- Indexes for table `favcategories`
--
ALTER TABLE `favcategories`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `login_details`
--
ALTER TABLE `login_details`
  ADD PRIMARY KEY (`login_details_id`);

--
-- Indexes for table `market`
--
ALTER TABLE `market`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `publishers`
--
ALTER TABLE `publishers`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `shelf`
--
ALTER TABLE `shelf`
  ADD PRIMARY KEY (`Id`);

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
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=583;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11128;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `chat_message`
--
ALTER TABLE `chat_message`
  MODIFY `chat_message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `favcategories`
--
ALTER TABLE `favcategories`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `login_details`
--
ALTER TABLE `login_details`
  MODIFY `login_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `market`
--
ALTER TABLE `market`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `publishers`
--
ALTER TABLE `publishers`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=614;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;

--
-- AUTO_INCREMENT for table `shelf`
--
ALTER TABLE `shelf`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


COMMIT;