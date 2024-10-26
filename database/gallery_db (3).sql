-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2024 at 09:43 AM
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
  `profile` varchar(100) NOT NULL,
  `u_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`u_id`, `u_name`, `email`, `username`, `password`, `u_type`, `profile`, `u_status`) VALUES
(52, 'Jamaica Anuba', 'jamaicaanuba@gmail.com', 'jai', '$2y$10$3oRJLtcy.Wflaqh3F38YyOGrTgXu6p1My5woq9AavVRyoBk62kqDW', 'User', '', 'Pending'),
(53, 'Jerald Aliviano', 'jeralynpreitos@gmail.com', 'jera', '$2y$10$HdMI22ej8.JBDrkhleMMTOaXIl7BdQZgORhTT8fsabzXS/pIPwgXm', 'User', '', 'Pending'),
(54, 'Jeralyn Peritos', 'caneteangel187@gmail.com', 'jeralyn', '$2y$10$mw.CkM3vjotN.AsLsegvD.HsgjGbn484F7d2S1ED0vum5uUZjLeOO', 'User', '', 'Pending');

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
(42, 52, 'Judge From Hell', 'This is my first artwork', 'Sketches', 'files/ytmQDekj/wallpsper.jpg', 'Pending'),
(43, 52, 'Anxiety', 'This is my second upload', 'Expressionism', 'files/M2pU4Clg/lips.jpg', 'Pending'),
(44, 53, 'Intrusive', 'This is my first upload', 'Expressionism', 'files/b5YNMS9z/skel.jpg', 'Pending'),
(45, 52, 'Girl', 'This is an arwrotk', 'Sketches', 'files/r2jj4fIn/girl.jpg', 'Pending'),
(46, 52, 'Touch', 'This is the touch', 'Painting', 'files/bIW5pUIY/hands.jpg', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `collab_exhibit`
--

CREATE TABLE `collab_exhibit` (
  `collab_id` int(100) NOT NULL,
  `exbt_id` int(100) NOT NULL,
  `u_id` int(100) NOT NULL,
  `a_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exhibit_tbl`
--

CREATE TABLE `exhibit_tbl` (
  `exbt_id` int(100) NOT NULL,
  `u_id` int(100) NOT NULL,
  `a_id` int(100) NOT NULL,
  `exbt_title` varchar(100) NOT NULL,
  `exbt_descrip` text NOT NULL,
  `exbt_date` date NOT NULL,
  `exbt_type` varchar(20) NOT NULL,
  `exbt_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exhibit_tbl`
--

INSERT INTO `exhibit_tbl` (`exbt_id`, `u_id`, `a_id`, `exbt_title`, `exbt_descrip`, `exbt_date`, `exbt_type`, `exbt_status`) VALUES
(27, 52, 42, 'Jai\'s Exhbit', 'This is my first exhibit', '2024-10-24', 'Solo', 'Accepted'),
(28, 52, 43, 'Jai\'s Exhbit', 'This is my first exhibit', '2024-10-24', 'Solo', 'Accepted'),
(29, 52, 45, 'Jai\'s Exhbit', 'This is my first exhibit', '2024-10-24', 'Solo', 'Accepted'),
(30, 52, 46, 'Jai\'s Exhbit', 'This is my first exhibit', '2024-10-24', 'Solo', 'Accepted');

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
-- Indexes for table `art_info`
--
ALTER TABLE `art_info`
  ADD PRIMARY KEY (`a_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `collab_exhibit`
--
ALTER TABLE `collab_exhibit`
  ADD PRIMARY KEY (`collab_id`),
  ADD KEY `exbt_id` (`exbt_id`),
  ADD KEY `u_id` (`u_id`),
  ADD KEY `a_id` (`a_id`);

--
-- Indexes for table `exhibit_tbl`
--
ALTER TABLE `exhibit_tbl`
  ADD PRIMARY KEY (`exbt_id`),
  ADD KEY `u_id` (`u_id`),
  ADD KEY `a_id` (`a_id`);

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
  MODIFY `u_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `art_info`
--
ALTER TABLE `art_info`
  MODIFY `a_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `collab_exhibit`
--
ALTER TABLE `collab_exhibit`
  MODIFY `collab_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exhibit_tbl`
--
ALTER TABLE `exhibit_tbl`
  MODIFY `exbt_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

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
-- Constraints for table `art_info`
--
ALTER TABLE `art_info`
  ADD CONSTRAINT `art_info_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `accounts` (`u_id`);

--
-- Constraints for table `collab_exhibit`
--
ALTER TABLE `collab_exhibit`
  ADD CONSTRAINT `collab_exhibit_ibfk_1` FOREIGN KEY (`exbt_id`) REFERENCES `exhibit_tbl` (`exbt_id`),
  ADD CONSTRAINT `collab_exhibit_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `accounts` (`u_id`),
  ADD CONSTRAINT `collab_exhibit_ibfk_3` FOREIGN KEY (`a_id`) REFERENCES `art_info` (`a_id`);

--
-- Constraints for table `exhibit_tbl`
--
ALTER TABLE `exhibit_tbl`
  ADD CONSTRAINT `exhibit_tbl_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `accounts` (`u_id`),
  ADD CONSTRAINT `exhibit_tbl_ibfk_2` FOREIGN KEY (`a_id`) REFERENCES `art_info` (`a_id`);

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
