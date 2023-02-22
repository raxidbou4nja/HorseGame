-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2023 at 08:24 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mvc`
--

-- --------------------------------------------------------

--
-- Table structure for table `comptes`
--

CREATE TABLE `comptes` (
  `id` int(11) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `prenom` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `mot_de_passe` varchar(45) NOT NULL,
  `tel` varchar(45) DEFAULT NULL,
  `etat` varchar(45) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comptes`
--

INSERT INTO `comptes` (`id`, `nom`, `prenom`, `email`, `mot_de_passe`, `tel`, `etat`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 'edward', 'said', 'test@gmail.com', '123456', '0675406152', '1', '2023-02-17 17:44:05', '2023-02-17 18:58:04', NULL),
(7, 'sami', 'mohamed', 'test2@gmail.com', '123456', '0675406152', '1', '2023-02-17 17:45:23', '2023-02-17 19:18:06', '2023-02-17 20:17:35'),
(8, 'youssif', 'mohamed', 'test3@gmail.com', 'ffffffffff', '0675406152', '1', '2023-02-17 19:33:18', NULL, NULL),
(9, 'mostapha', 'said', 'test4@gmail.com', '0666666666', '0666666666', '', '2023-02-17 20:16:00', '2023-02-17 20:17:25', NULL),
(10, 'kamal', 'hassan', 'test5@gmail.com', '0666666666', '0666666666', '', '2023-02-17 20:16:15', '2023-02-17 20:17:28', NULL),
(11, 'hassan', 'mohamed', 'test6@gmail.com', '07777777777', '07777777777', '1', '2023-02-17 20:16:46', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comptes`
--
ALTER TABLE `comptes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comptes`
--
ALTER TABLE `comptes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;