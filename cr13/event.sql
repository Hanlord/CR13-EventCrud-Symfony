-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2022 at 06:37 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `root:@127.0.0.1:3306/events`
--

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `name`, `date`, `description`, `picture`, `capacity`, `contact`, `phone`, `location`, `url`, `type`) VALUES
(7, 'Michael Jackson', '2022-12-24 00:02:00', 'Reborn from King of Pop', 'michael-jackson-62ee471a58918.webp', 1000000000, 'mj@mail.com', 1234567890, 'Heaven', 'michaelreturn.com', 'Concert'),
(8, 'Superman', '2024-08-31 12:00:00', 'Saves the World from Aliens', 'superman-62ee46f075e07.webp', 2147483647, 'hero@mail.com', 77777777, 'Earth', 'saveUs.com', 'Film'),
(9, 'World Peace', '2027-12-31 00:00:00', 'Humanity\'s World Peace!!!', 'peace-62ee4733541b5.webp', 2147483647, 'peace@mail.com', 2147483647, 'Earth', 'peace.com', 'Concert'),
(10, 'Don\'t look up', '2022-08-09 09:00:00', 'Netflix highlight', 'dontlookup-62ee47448ac73.jpg', 250, 'netflix@mail.com', 437895123, 'Vienna', 'dontlookup.com', 'Film'),
(11, 'Soccer World Championship', '2026-08-26 21:00:00', 'Finals', 'soccer-62ee4635a102d.jpg', 100000, 'soccer@mail.com', 654654654, 'Earth', 'soccer.com', 'Sport'),
(12, 'Elon on Mars', '2027-11-11 04:00:00', 'Elon arrives on Mars', 'mars-62ee4752df3f5.webp', 1, 'elon@mail.com', 9999, 'Mars', 'mars.com', 'Sport');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
