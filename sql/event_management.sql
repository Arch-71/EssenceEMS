-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 04, 2025 at 12:40 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `total_time` int NOT NULL,
  `date` date NOT NULL,
  `audience_number` int NOT NULL,
  `category` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `email`, `phone`, `total_time`, `date`, `audience_number`, `category`, `created_at`) VALUES
(2, 'Archana ', 'archana@gmail.com', '8073973975', 24, '2025-03-05', 150, 'wedding', '2025-03-02 06:33:57');

-- --------------------------------------------------------

--
-- Table structure for table `event_halls`
--

DROP TABLE IF EXISTS `event_halls`;
CREATE TABLE IF NOT EXISTS `event_halls` (
  `id` int NOT NULL AUTO_INCREMENT,
  `hall_name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `size` int NOT NULL,
  `price_per_hour` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `event_halls`
--

INSERT INTO `event_halls` (`id`, `hall_name`, `image`, `address`, `description`, `size`, `price_per_hour`, `created_at`) VALUES
(2, 'Pai Vista Convention Hall', 'images/pai.jpg', ' #3/1,27th Cross End of K.R Road,2nd Stage Canara Bank , Banashankari, Bangalore, 560070', 'Pai Vista Convention Hall is located in Banashankari, Bangalore.Pai Vista Convention Hall has 3 beautiful banquet halls of capacity upto 800 people can manage in floating. All venues are centralised ac, attached dress changing rooms and separate dining area.Pai Vista Convention Hall has spacious car parking which can park upto 40 vehicles.', 800, 1500.00, '2025-03-02 10:31:45'),
(3, 'The Krishna Grand', 'images/krish.jpg', '#1,Monotype 27th Cross,2nd Stage Sevakshetra Hospital , Banashankari, Bangalore, 560070', 'The Krishna Grand is located in Banashankari, Bangalore.The Krishna Grand has 2 beautiful banquet halls of capacity upto 700 people can manage in floating. All venues are centralised ac, attached dress changing rooms and separate dining area.The Krishna Grand has spacious car parking which can park upto 30 vehicles.', 700, 2000.00, '2025-03-02 11:00:03'),
(4, 'Golden Palace', 'images/gold.jpeg', '47, 2nd Cross Rd, JHBCS Layout,Padmanabha Nagar, Banashankari, Bangalore, 560078', 'Golden Palace is located in Banashankari, Bangalore.It has one beautiful banquet hall of capacity upto 350 people can manage in floating. All venues are centralised ac, attached dress changing rooms and separate dining area.Golden Palace has spacious car parking which can park upto 100 vehicles. People who are looking to get own food, this place is perfect for any event.', 350, 1000.00, '2025-03-02 12:17:43');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
