-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 25. Okt 2021 um 15:16
-- Server-Version: 10.4.21-MariaDB
-- PHP-Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `danielfischer_tracerun`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `interval`
--

DROP TABLE IF EXISTS `interval`;
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
(8, 112, 149, 160, 0),
(9, 112, 184, 168, 0),
(10, 112, 187, 170, 0),
(11, 112, 186, 168, 0),
(12, 112, 186, 170, 0),
(13, 112, 181, 162, 0),
(14, 121, 163, 160, 0),
(15, 121, 183, 168, 0),
(16, 121, 185, 168, 0),
(17, 121, 184, 164, 0),
(18, 121, 187, 162, 0),
(19, 124, 171, 164, 0),
(20, 124, 184, 166, 0),
(21, 124, 186, 166, 0),
(22, 124, 186, 168, 0),
(23, 124, 187, 166, 0),
(24, 127, 112, 158, 0),
(25, 127, 179, 166, 0),
(26, 127, 179, 164, 0),
(27, 127, 183, 164, 0),
(28, 127, 183, 164, 0),
(29, 127, 184, 164, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `trackrun`
--

DROP TABLE IF EXISTS `trackrun`;
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
(111, 19, '2021-09-21', '00:30:55', 4.17, 338, 147, 163, 144, 25, 'E', '', 0, 0),
(112, 19, '2021-09-12', '00:23:03', 4.24, 392, 180, 200, 152, 6, 'I', '', 160, 80),
(113, 19, '2021-09-10', '00:45:00', 6.07, 465, 147, 160, 141, 44, 'E', '', 0, 0),
(114, 19, '2021-09-07', '00:45:02', 5.91, 448, 146, 157, 142, 38, 'E', '', 0, 0),
(115, 19, '2021-09-03', '00:45:00', 5.84, 408, 144, 155, 143, 48, 'E', '', 0, 0),
(116, 19, '2021-08-31', '00:30:01', 3.7, 254, 141, 153, 142, 29, 'E', '', 0, 0),
(117, 19, '2021-08-22', '00:12:02', 2.75, 180, 192, 202, 162, 2, 'P', '', 0, 0),
(118, 19, '2021-08-20', '00:44:00', 5.7, 422, 145, 156, 142, 23, 'E', '', 0, 0),
(119, 19, '2021-08-17', '00:14:38', 1.98, 138, 144, 151, 142, 16, 'E', '', 0, 0),
(120, 19, '2021-08-10', '00:30:02', 3.94, 298, 145, 158, 141, 25, 'E', '', 0, 0),
(121, 19, '2021-08-08', '00:21:11', 4.16, 366, 181, 198, 152, 0, 'I', '', 180, 90),
(122, 19, '2021-08-06', '00:45:15', 5.76, 429, 146, 158, 140, 41, 'E', '', 0, 0),
(123, 19, '2021-08-03', '00:45:01', 5.91, 457, 146, 160, 139, 48, 'E', '', 0, 0),
(124, 19, '2021-08-01', '00:22:18', 4.1, 362, 180, 197, 152, 2, 'I', '', 180, 90),
(125, 19, '2021-07-30', '00:45:02', 5.55, 420, 146, 158, 134, 48, 'E', '', 0, 0),
(126, 19, '2021-07-29', '00:45:02', 5.51, 403, 145, 155, 138, 34, 'E', '', 0, 0),
(127, 19, '2021-07-25', '00:22:58', 4.4, 387, 178, 198, 148, 3, 'I', '', 160, 80),
(128, 19, '2021-07-20', '01:00:04', 7.48, 521, 144, 158, 134, 45, 'E', '', 0, 0),
(129, 19, '2021-07-18', '00:13:22', 3.01, 187, 196, 203, 160, 3, 'P', '', 0, 0),
(130, 19, '2021-07-16', '00:50:54', 6, 425, 146, 162, 132, 28, 'E', '', 0, 0),
(131, 19, '2021-07-13', '00:33:24', 4.3, 289, 143, 152, 134, 28, 'E', '', 0, 0),
(132, 19, '2021-07-11', '00:29:30', 3.41, 247, 145, 152, 129, 25, 'E', '', 0, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

DROP TABLE IF EXISTS `user`;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT für Tabelle `trackrun`
--
ALTER TABLE `trackrun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

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
  ADD CONSTRAINT `interval_ibfk_1` FOREIGN KEY (`fk_trackrun`) REFERENCES `trackrun` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `trackrun`
--
ALTER TABLE `trackrun`
  ADD CONSTRAINT `trackrun_ibfk_1` FOREIGN KEY (`fk_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
