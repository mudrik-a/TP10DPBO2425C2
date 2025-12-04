-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2025 at 07:58 AM
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
-- Database: `db_motogp`
--

-- --------------------------------------------------------

--
-- Table structure for table `motors`
--

CREATE TABLE `motors` (
  `id_motor` int(11) NOT NULL,
  `id_rider` int(11) DEFAULT NULL,
  `merk_mesin` varchar(100) DEFAULT NULL,
  `kapasitas_cc` int(11) DEFAULT NULL,
  `top_speed_kmh` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `motors`
--

INSERT INTO `motors` (`id_motor`, `id_rider`, `merk_mesin`, `kapasitas_cc`, `top_speed_kmh`) VALUES
(1, 1, 'Ducati Desmosedici GP25', 1000, 365),
(2, 2, 'Ducati Desmosedici GP25', 1000, 365),
(3, 3, 'Yamaha YZR-M1 2025', 1000, 355),
(4, 5, 'Aprilia RS-GP 25', 1000, 360),
(5, 7, 'KTM RC16 2025', 1000, 362),
(6, 8, 'KTM RC16 2025', 1000, 362),
(7, 17, 'Ducati Desmosedici GP24', 1000, 360),
(8, 15, 'Ducati Desmosedici GP25', 1000, 365);

-- --------------------------------------------------------

--
-- Table structure for table `riders`
--

CREATE TABLE `riders` (
  `id_rider` int(11) NOT NULL,
  `id_team` int(11) DEFAULT NULL,
  `nama_rider` varchar(100) NOT NULL,
  `nomor_start` int(11) DEFAULT NULL,
  `negara_asal` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `riders`
--

INSERT INTO `riders` (`id_rider`, `id_team`, `nama_rider`, `nomor_start`, `negara_asal`) VALUES
(1, 1, 'Francesco Bagnaia', 63, 'Italia'),
(2, 1, 'Marc Marquez', 93, 'Spanyol'),
(3, 2, 'Fabio Quartararo', 20, 'Prancis'),
(4, 2, 'Alex Rins', 42, 'Spanyol'),
(5, 3, 'Jorge Martin', 89, 'Spanyol'),
(6, 3, 'Marco Bezzecchi', 72, 'Italia'),
(7, 4, 'Brad Binder', 33, 'Afrika Selatan'),
(8, 4, 'Pedro Acosta', 37, 'Spanyol'),
(9, 5, 'Luca Marini', 10, 'Italia'),
(10, 5, 'Joan Mir', 36, 'Spanyol'),
(11, 6, 'Jack Miller', 43, 'Australia'),
(12, 6, 'Miguel Oliveira', 88, 'Portugal'),
(13, 7, 'Alex Marquez', 73, 'Spanyol'),
(14, 7, 'Fermin Aldeguer', 54, 'Spanyol'),
(15, 8, 'Fabio Di Giannantonio', 49, 'Italia'),
(16, 8, 'Franco Morbidelli', 21, 'Italia'),
(17, 9, 'Enea Bastianini', 23, 'Italia'),
(18, 9, 'Maverick Vinales', 12, 'Spanyol'),
(19, 10, 'Raul Fernandez', 25, 'Spanyol'),
(20, 10, 'Ai Ogura', 79, 'Jepang'),
(21, 11, 'Johann Zarco', 5, 'Prancis'),
(22, 11, 'Somkiat Chantra', 35, 'Thailand');

-- --------------------------------------------------------

--
-- Table structure for table `sponsors`
--

CREATE TABLE `sponsors` (
  `id_sponsor` int(11) NOT NULL,
  `id_team` int(11) DEFAULT NULL,
  `nama_sponsor` varchar(100) NOT NULL,
  `jenis_bidang` varchar(100) DEFAULT NULL,
  `nilai_kontrak` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sponsors`
--

INSERT INTO `sponsors` (`id_sponsor`, `id_team`, `nama_sponsor`, `jenis_bidang`, `nilai_kontrak`) VALUES
(1, 1, 'Lenovo', 'Teknologi', 15000000),
(2, 1, 'Givi', 'Aksesoris Motor', 2000000),
(3, 2, 'Monster Energy', 'Minuman Energi', 12000000),
(4, 2, 'Eneos', 'Oli & Pelumas', 4000000),
(5, 3, 'Castrol', 'Oli & Pelumas', 3500000),
(6, 4, 'Red Bull', 'Minuman Energi', 20000000),
(7, 5, 'Repsol', 'Minyak & Gas', 10000000),
(8, 6, 'Prima Assicurazioni', 'Asuransi', 5000000),
(9, 7, 'Federal Oil', 'Oli & Pelumas', 3000000),
(10, 7, 'Aspira', 'Suku Cadang', 1500000),
(11, 8, 'Pertamina Enduro', 'Oli & Pelumas', 8000000),
(12, 11, 'Idemitsu', 'Oli & Pelumas', 2000000);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id_team` int(11) NOT NULL,
  `nama_team` varchar(100) NOT NULL,
  `manager` varchar(100) DEFAULT NULL,
  `markas` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id_team`, `nama_team`, `manager`, `markas`) VALUES
(1, 'Ducati Lenovo Team', 'Davide Tardozzi', 'Italia'),
(2, 'Monster Energy Yamaha', 'Max Bartolini', 'Jepang'),
(3, 'Aprilia Racing', 'Massimo Rivola', 'Italia'),
(4, 'Red Bull KTM Factory Racing', 'Francesco Guidotti', 'Austria'),
(5, 'Repsol Honda Team', 'Alberto Puig', 'Jepang'),
(6, 'Prima Pramac Yamaha', 'Paolo Campinoti', 'Italia'),
(7, 'Gresini Racing MotoGP', 'Nadia Padovani', 'Italia'),
(8, 'Pertamina Enduro VR46', 'Uccio Salucci', 'Italia'),
(9, 'Red Bull KTM Tech3', 'Herve Poncharal', 'Prancis'),
(10, 'Trackhouse Racing', 'Davide Brivio', 'Amerika Serikat'),
(11, 'LCR Honda Castrol/Idemitsu', 'Lucio Cecchinello', 'Monako');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `motors`
--
ALTER TABLE `motors`
  ADD PRIMARY KEY (`id_motor`),
  ADD KEY `id_rider` (`id_rider`);

--
-- Indexes for table `riders`
--
ALTER TABLE `riders`
  ADD PRIMARY KEY (`id_rider`),
  ADD KEY `id_team` (`id_team`);

--
-- Indexes for table `sponsors`
--
ALTER TABLE `sponsors`
  ADD PRIMARY KEY (`id_sponsor`),
  ADD KEY `id_team` (`id_team`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id_team`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `motors`
--
ALTER TABLE `motors`
  MODIFY `id_motor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `riders`
--
ALTER TABLE `riders`
  MODIFY `id_rider` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `sponsors`
--
ALTER TABLE `sponsors`
  MODIFY `id_sponsor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id_team` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `motors`
--
ALTER TABLE `motors`
  ADD CONSTRAINT `motors_ibfk_1` FOREIGN KEY (`id_rider`) REFERENCES `riders` (`id_rider`) ON DELETE CASCADE;

--
-- Constraints for table `riders`
--
ALTER TABLE `riders`
  ADD CONSTRAINT `riders_ibfk_1` FOREIGN KEY (`id_team`) REFERENCES `teams` (`id_team`) ON DELETE CASCADE;

--
-- Constraints for table `sponsors`
--
ALTER TABLE `sponsors`
  ADD CONSTRAINT `sponsors_ibfk_1` FOREIGN KEY (`id_team`) REFERENCES `teams` (`id_team`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
