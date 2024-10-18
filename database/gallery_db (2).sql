-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2024 at 02:12 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gallery_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `u_id` int(100) NOT NULL,
  `u_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `u_type` varchar(50) NOT NULL,
  `u_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`u_id`, `u_name`, `email`, `username`, `password`, `u_type`, `u_status`) VALUES
(21, 'Angel Canete', 'caneteangel@yahoo.com', 'angel', '$2y$10$c.RdRNG2vVsD9hCnXpb.XusGk2FLGhiELrbo5kIXtcnIb2eNzWGLC', 'Admin', ''),
(33, 'Jerald Aliano', 'jeraldalibiano@gmail.com', 'jera', '$2y$10$TD7s9eS3XOjk2AiFPX10qu2YO.ss5KeyuSUXAf2k/nXSZ53hOPtXe', 'User', 'Pending'),
(34, 'Jamaica Anuba', 'jamaicaanuba@gmail.com', 'jai', '$2y$10$vJy2d/KRsOsKtatklH8BiurcHmeiZkkx3L7mHdKvTyWFa7SqitxD2', 'User', 'Pending'),
(46, 'Kyle Canete', 'kylecanete@gmail.om', 'kyle', '$2y$10$rkqPdWXLeRfy6auQl2O5xeP9jACp.ZFSTGQubBZWUAPuybfRT7Ky.', 'User', 'Pending'),
(47, 'Jamaica Anuba', 'asdad@adasd.com', 'asd', '$2y$10$HrAZ9g3fp54H1JjzHivkluAnAJ2R8fvYtnUB3TVlFcUoArrCkft9u', 'User', 'Pending'),
(48, 'asd', 'asd@gmail.com', 'asd', '$2y$10$ei6PvvP1rDEjqqk9eC8i0uSOFZ1YXMWrAkxwyQXw8DP1Y8cP4RCRe', 'User', 'Pending'),
(49, 'Jeralyn Peritos', 'caneteangel187@gmail.com', 'jeralyn', '$2y$10$AOdoUamw2L7ygZcdNdFnVujm9oIPpxZLckLwwCH1BxvZLVJpGnmkG', 'User', 'Pending'),
(50, 'Jamaica Anuba', 'caneteangel@yahoo.com', 'maica', '$2y$10$/Tt5gpos2P8FAKeeKmph.eE.6GhAeT1.coVPK1i6bebJwytK8NONC', 'User', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `artwork_exhibit`
--

CREATE TABLE `artwork_exhibit` (
  `art_exhibit_id` int(11) NOT NULL,
  `exbt_id` int(11) NOT NULL,
  `a_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `art_info`
--

CREATE TABLE `art_info` (
  `a_id` int(100) NOT NULL,
  `u_id` int(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(50) NOT NULL,
  `file` varchar(50) NOT NULL,
  `a_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `art_info`
--

INSERT INTO `art_info` (`a_id`, `u_id`, `title`, `description`, `category`, `file`, `a_status`) VALUES
(34, 34, 'The Girl', 'The girl in red.', 'Sketches', 'files/m6NhzyDM/girl.jpg', 'Pending'),
(35, 34, 'Human Body and It\'s Glory', 'This is the beauty of a human body', 'Painting', 'files/X9HpSdLo/body.jpg', 'Pending'),
(36, 34, 'The Eyes', 'The eyes don\'t lie.', 'Expressionism', 'files/jWQIN8A0/eyes.jpg', 'Pending'),
(37, 33, 'The Carress', 'Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.', 'Painting', 'files/BDoMqkoF/hands.jpg', 'Pending'),
(38, 33, 'Intrusive', 'Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.', 'Painting', 'files/6oNhyCmj/skel.jpg', 'Pending'),
(39, 33, 'Anxiety', 'Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.', 'Expressionism', 'files/R10K2B5t/lips.jpg', 'Pending'),
(40, 50, 'Red', 'This is red artwork', 'Sculpture', 'files/MKhZiocU/wallpsper.jpg', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `exhibit_tbl`
--

CREATE TABLE `exhibit_tbl` (
  `exbt_id` int(100) NOT NULL,
  `u_id` int(100) NOT NULL,
  `exbt_title` varchar(100) NOT NULL,
  `exbt_descrip` text NOT NULL,
  `exbt_date` date NOT NULL,
  `exbt_type` varchar(20) NOT NULL,
  `exbt_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favorite`
--

CREATE TABLE `favorite` (
  `fav_id` int(100) NOT NULL,
  `u_id` int(100) NOT NULL,
  `a_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `like_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `a_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `saved`
--

CREATE TABLE `saved` (
  `save_id` int(100) NOT NULL,
  `u_id` int(100) NOT NULL,
  `a_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `artwork_exhibit`
--
ALTER TABLE `artwork_exhibit`
  ADD KEY `a_id` (`a_id`),
  ADD KEY `exbt_id` (`exbt_id`);

--
-- Indexes for table `art_info`
--
ALTER TABLE `art_info`
  ADD PRIMARY KEY (`a_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `exhibit_tbl`
--
ALTER TABLE `exhibit_tbl`
  ADD PRIMARY KEY (`exbt_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`fav_id`),
  ADD KEY `u_id` (`u_id`),
  ADD KEY `a_id` (`a_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`like_id`),
  ADD KEY `u_id` (`u_id`),
  ADD KEY `a_id` (`a_id`);

--
-- Indexes for table `saved`
--
ALTER TABLE `saved`
  ADD KEY `u_id` (`u_id`),
  ADD KEY `a_id` (`a_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `u_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `art_info`
--
ALTER TABLE `art_info`
  MODIFY `a_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `exhibit_tbl`
--
ALTER TABLE `exhibit_tbl`
  MODIFY `exbt_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `favorite`
--
ALTER TABLE `favorite`
  MODIFY `fav_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `artwork_exhibit`
--
ALTER TABLE `artwork_exhibit`
  ADD CONSTRAINT `artwork_exhibit_ibfk_1` FOREIGN KEY (`a_id`) REFERENCES `art_info` (`a_id`),
  ADD CONSTRAINT `artwork_exhibit_ibfk_2` FOREIGN KEY (`exbt_id`) REFERENCES `exhibit_tbl` (`exbt_id`);

--
-- Constraints for table `art_info`
--
ALTER TABLE `art_info`
  ADD CONSTRAINT `art_info_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `accounts` (`u_id`);

--
-- Constraints for table `exhibit_tbl`
--
ALTER TABLE `exhibit_tbl`
  ADD CONSTRAINT `exhibit_tbl_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `accounts` (`u_id`);

--
-- Constraints for table `favorite`
--
ALTER TABLE `favorite`
  ADD CONSTRAINT `favorite_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `accounts` (`u_id`),
  ADD CONSTRAINT `favorite_ibfk_2` FOREIGN KEY (`a_id`) REFERENCES `art_info` (`a_id`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `accounts` (`u_id`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`a_id`) REFERENCES `art_info` (`a_id`);

--
-- Constraints for table `saved`
--
ALTER TABLE `saved`
  ADD CONSTRAINT `saved_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `accounts` (`u_id`),
  ADD CONSTRAINT `saved_ibfk_2` FOREIGN KEY (`a_id`) REFERENCES `art_info` (`a_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
