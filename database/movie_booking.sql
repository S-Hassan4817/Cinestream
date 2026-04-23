-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2026 at 02:40 PM
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
-- Database: `movie_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `seat_class` enum('Gold','Platinum','Box') NOT NULL,
  `total_seats` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `booking_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `movie_id`, `customer_name`, `seat_class`, `total_seats`, `total_price`, `booking_date`) VALUES
(1, 3, 'Kianat Zehra ', 'Platinum', 1, 1800.00, '2026-04-13 12:49:39'),
(2, 2, 'Syed Ali', 'Platinum', 3, 6000.00, '2026-04-13 12:53:53'),
(3, 3, 'Hassan Memom', 'Platinum', 4, 6300.00, '2026-04-17 12:04:49'),
(4, 4, 'shahmeer', 'Gold', 4, 3600.00, '2026-04-17 12:23:05'),
(5, 3, 'Syed Shah', 'Gold', 2, 2100.00, '2026-04-17 12:32:36'),
(6, 8, 'Zara Khan', 'Platinum', 2, 4000.00, '2026-04-19 15:43:24');

-- --------------------------------------------------------

--
-- Table structure for table `cinemas`
--

CREATE TABLE `cinemas` (
  `id` int(11) NOT NULL,
  `hall_name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `total_capacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cinemas`
--

INSERT INTO `cinemas` (`id`, `hall_name`, `location`, `total_capacity`) VALUES
(1, 'Cinema 1', 'Askari IV', 140),
(2, 'Cinema 2', 'DHA Phase 8', 200),
(3, 'Cinema 4', 'Gulshan e Iqbal', 180);

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `theater_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `trailer_url` varchar(2083) DEFAULT NULL,
  `rate_gold` decimal(10,2) DEFAULT NULL,
  `rate_platinum` decimal(10,2) DEFAULT NULL,
  `rate_box` decimal(10,2) DEFAULT NULL,
  `show_timings` varchar(255) DEFAULT NULL,
  `poster_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `theater_id`, `title`, `trailer_url`, `rate_gold`, `rate_platinum`, `rate_box`, `show_timings`, `poster_path`) VALUES
(2, 1, 'Aag lagi basti main', 'https://www.youtube.com/watch?v=Y5Q8z66aV9U', 1000.00, 2000.00, 5000.00, '11:30 PM', 'uploads/1775509439_Poster1.jpg'),
(3, 1, 'The Dark Knight', 'https://www.youtube.com/watch?v=EXeTwQWrcwY', 1200.00, 1800.00, 3000.00, '05:30 PM', 'uploads/1776249297_The_dark_knight.jpg'),
(4, 1, 'Interstellar', 'https://www.youtube.com/watch?v=zSWdZVtXT7E', 1200.00, 1800.00, 3000.00, '10:00 PM', 'uploads/1776082981_interstellar.jpg'),
(5, 1, 'Tamasha', 'https://www.youtube.com/watch?v=o-e5eWVCzx8', 1400.00, 2000.00, 4500.00, '08:00 PM', 'uploads/1776626013_tamasha.jpg'),
(8, 2, 'Yeh Jawani hai Deewani', 'https://www.youtube.com/watch?v=Rbp2XUSeUNE', 1200.00, 2000.00, 3499.00, '10:00 PM', 'uploads/1776462882_yjhd-poster.jpg'),
(9, 1, 'Laila Majnu ', 'https://www.youtube.com/watch?v=Cv-6cAHanZ8', 1500.00, 2300.00, 3500.00, '12:00 AM', 'uploads/1776521288_laila_majnu.jpg'),
(10, 1, 'Bang Bang', 'https://www.youtube.com/watch?v=NhIFVlsHzwQ', 1500.00, 1800.00, 2999.00, '8:00 PM', 'uploads/1776624208_Bang-bang.jpg'),
(11, 2, 'Rockstar', 'https://www.youtube.com/watch?v=bD5FShPZdpw', 1000.00, 1800.00, 2799.00, '01:00 AM', 'uploads/1776625963_rocktar-movie.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `rating` int(11) NOT NULL,
  `review_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `movie_id`, `user_name`, `rating`, `review_text`, `created_at`) VALUES
(1, 2, 'Hassan Ali', 4, 'Great Movie and Good Cast', '2026-04-13 12:43:13'),
(2, 9, 'Syed Hassan', 5, 'Must watch', '2026-04-20 11:55:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'Ayan Ahmed', 'ayan@gmail.com', '123', 'user'),
(5, 'admin', 'admin@gmail.com', 'admin123', 'admin'),
(6, 'user', 'user@gmail.com', 'user123', 'user'),
(7, 'Aymen', 'aymen@gmail.com', '12345', 'user'),
(8, 'shahmeer', 'shahmeer@gmail.com', 'shah123', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- Indexes for table `cinemas`
--
ALTER TABLE `cinemas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cinemas`
--
ALTER TABLE `cinemas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
