-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 21. Sep 2021 um 21:20
-- Server-Version: 10.4.11-MariaDB
-- PHP-Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `danielfischer_tracerun`
--
CREATE DATABASE IF NOT EXISTS `danielfischer_tracerun` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `danielfischer_tracerun`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `interval`
--

CREATE TABLE `interval` (
  `id` int(11) NOT NULL,
  `fk_trackrun` int(11) NOT NULL,
  `avg_heart_rate` int(11) NOT NULL,
  `cadence` int(11) NOT NULL,
  `distance` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `interval`
--

INSERT INTO `interval` (`id`, `fk_trackrun`, `avg_heart_rate`, `cadence`, `distance`) VALUES
(4, 108, 1, 1, 1),
(5, 108, 1, 1, 1),
(6, 109, 12312, 123, 2312),
(7, 109, 123, 123, 123);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `trackrun`
--

CREATE TABLE `trackrun` (
  `id` int(11) NOT NULL,
  `fk_user` int(11) NOT NULL,
  `running_date` date NOT NULL,
  `total_time` time DEFAULT NULL,
  `distance` float NOT NULL,
  `active_calories` int(11) NOT NULL DEFAULT 0,
  `avg_heart_rate` int(11) NOT NULL,
  `max_heart_rate` int(11) NOT NULL DEFAULT 0,
  `cadence` int(11) NOT NULL DEFAULT 0,
  `vertical_meters` int(15) NOT NULL DEFAULT 0,
  `type` varchar(1) COLLATE utf8_bin NOT NULL,
  `comment` varchar(200) COLLATE utf8_bin NOT NULL,
  `int_active` int(11) NOT NULL,
  `int_pause` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `trackrun`
--

INSERT INTO `trackrun` (`id`, `fk_user`, `running_date`, `total_time`, `distance`, `active_calories`, `avg_heart_rate`, `max_heart_rate`, `cadence`, `vertical_meters`, `type`, `comment`, `int_active`, `int_pause`) VALUES
(108, 19, '2021-09-21', '00:03:05', 123, 123, 123, 0, 0, 0, 'I', '', 120, 60),
(109, 19, '2021-09-21', '00:03:05', 12321, 12312, 123, 0, 0, 0, 'I', '', 120, 60);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_bin NOT NULL,
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(200) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`) VALUES
(19, 'Daniel', 'daniel.fischer281@gmail.com', '$2y$10$QwqyUhetwV2x9vxJ6ybMuuRlkl10SCLbo8ZQPox8SEdUctFhenQLO');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `interval`
--
ALTER TABLE `interval`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_trackrun` (`fk_trackrun`);

--
-- Indizes für die Tabelle `trackrun`
--
ALTER TABLE `trackrun`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk` (`fk_user`) USING BTREE;

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `interval`
--
ALTER TABLE `interval`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT für Tabelle `trackrun`
--
ALTER TABLE `trackrun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `interval`
--
ALTER TABLE `interval`
  ADD CONSTRAINT `interval_ibfk_1` FOREIGN KEY (`fk_trackrun`) REFERENCES `trackrun` (`id`);

--
-- Constraints der Tabelle `trackrun`
--
ALTER TABLE `trackrun`
  ADD CONSTRAINT `trackrun_ibfk_1` FOREIGN KEY (`fk_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
