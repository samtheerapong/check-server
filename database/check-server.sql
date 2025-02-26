-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 26, 2025 at 08:16 AM
-- Server version: 8.0.30
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `it-server`
--

-- --------------------------------------------------------

--
-- Table structure for table `server_status`
--

CREATE TABLE `server_status` (
  `id` int NOT NULL,
  `server_name` varchar(100) DEFAULT NULL,
  `ip_address` varchar(15) DEFAULT NULL,
  `port` int DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `last_checked` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `server_status`
--

INSERT INTO `server_status` (`id`, `server_name`, `ip_address`, `port`, `status`, `last_checked`) VALUES
(1, 'Firewall', '192.168.2.1', 80, 'Online', '2025-02-26 08:16:07'),
(2, 'NFC-FACTORY', '192.168.2.4', 80, 'Online', '2025-02-26 08:16:07'),
(3, 'NFC-CLOUD', '192.168.2.10', 80, 'Online', '2025-02-26 08:16:07'),
(4, 'DATA-CENTER', '192.168.2.12', 80, 'Online', '2025-02-26 08:16:07'),
(5, 'NFC-SERVER', '192.168.2.200', 80, 'Online', '2025-02-26 08:16:07'),
(6, 'KYOCERA', '192.168.2.230', 80, 'Online', '2025-02-26 08:16:07'),
(7, 'CCTV EN', '192.168.2.246', 80, 'Online', '2025-02-26 08:16:07'),
(8, 'CCTV B2', '192.168.2.247', 80, 'Online', '2025-02-26 08:16:07'),
(9, 'CCTV B4', '192.168.2.248', 80, 'Online', '2025-02-26 08:16:07'),
(10, 'CCTV B5', '192.168.2.249', 80, 'Online', '2025-02-26 08:16:07'),
(11, 'CCTV PD', '192.168.2.250', 80, 'Online', '2025-02-26 08:16:07'),
(12, 'CCTV B1', '192.168.2.252', 80, 'Online', '2025-02-26 08:16:07'),
(13, 'CCTV WH', '192.168.2.253', 80, 'Online', '2025-02-26 08:16:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `server_status`
--
ALTER TABLE `server_status`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `server_status`
--
ALTER TABLE `server_status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
