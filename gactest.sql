-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2018 at 11:38 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gactest`
--
CREATE DATABASE IF NOT EXISTS `gactest` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `gactest`;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_appel`
--

CREATE TABLE `ticket_appel` (
  `Compte_facture` int(11) NOT NULL,
  `No_facture` int(11) NOT NULL,
  `No_abonne` int(11) NOT NULL,
  `Date_facturation` date NOT NULL,
  `Heure_facturation` time NOT NULL,
  `Duree_volume_reel` varchar(15) NOT NULL,
  `Duree_volume_facturee` varchar(15) NOT NULL,
  `Type_facturation` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
