-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Vært: localhost
-- Genereringstid: 28. 08 2018 kl. 09:05:11
-- Serverversion: 10.1.32-MariaDB
-- PHP-version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Gemme2`
--

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `Class`
--

CREATE TABLE `Class` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `Class`
--

INSERT INTO `Class` (`ID`, `Name`, `Created`, `Modified`) VALUES
(2, 'Danish', '2018-08-27 21:57:34', '2018-08-27 21:57:34'),
(3, 'Math', '2018-08-27 21:57:43', '2018-08-27 21:57:43'),
(4, 'History', '2018-08-27 21:57:43', '2018-08-27 21:57:43'),
(6, 'English', '2018-08-28 04:36:34', '2018-08-28 04:36:34');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `Location`
--

CREATE TABLE `Location` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Class` int(255) DEFAULT NULL,
  `Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `Location`
--

INSERT INTO `Location` (`ID`, `Name`, `Class`, `Created`, `Modified`) VALUES
(7, 'A22', 2, '2018-08-28 05:23:36', '2018-08-28 05:23:36'),
(9, 'A12', 3, '2018-08-28 06:32:42', '2018-08-28 06:32:42'),
(10, 'A18', 4, '2018-08-28 06:57:10', '2018-08-28 06:57:10');

-- --------------------------------------------------------

--
-- Stand-in-struktur for visning `LocationClass`
-- (Se nedenfor for det aktuelle view)
--
CREATE TABLE `LocationClass` (
`ID` int(11)
,`Name` varchar(255)
,`Class` varchar(255)
);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `Students`
--

CREATE TABLE `Students` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `Students`
--

INSERT INTO `Students` (`ID`, `Name`, `Created`, `Modified`) VALUES
(1, 'Malde Larsen', '2018-08-27 21:54:17', '2018-08-28 02:06:44'),
(2, 'Mathilde Skovgaard', '2018-08-27 21:54:17', '2018-08-28 01:07:21'),
(3, 'Peter Hansen', '2018-08-27 21:55:08', '2018-08-27 21:55:08'),
(10, 'Felix Skovgaard', '2018-08-28 02:06:51', '2018-08-28 02:22:28'),
(15, 'Felix Skovgaard', '2018-08-28 04:56:40', '2018-08-28 04:56:46'),
(16, 'Gemme Hansen', '2018-08-28 06:07:33', '2018-08-28 06:07:33');

-- --------------------------------------------------------

--
-- Stand-in-struktur for visning `StudentTeacherLocation`
-- (Se nedenfor for det aktuelle view)
--
CREATE TABLE `StudentTeacherLocation` (
`ID` int(11)
,`Student` varchar(255)
,`Teacher` varchar(255)
,`Location` varchar(255)
);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `StudentTeacherRelation`
--

CREATE TABLE `StudentTeacherRelation` (
  `ID` int(11) NOT NULL,
  `Student` int(255) NOT NULL,
  `Teacher` int(255) NOT NULL,
  `Location` int(255) NOT NULL,
  `Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `StudentTeacherRelation`
--

INSERT INTO `StudentTeacherRelation` (`ID`, `Student`, `Teacher`, `Location`, `Created`, `Modified`) VALUES
(6, 10, 1, 7, '2018-08-28 05:35:40', '2018-08-28 06:31:01'),
(9, 1, 4, 7, '2018-08-28 06:14:45', '2018-08-28 06:14:45'),
(14, 16, 3, 10, '2018-08-28 06:57:21', '2018-08-28 06:57:21');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `Teachers`
--

CREATE TABLE `Teachers` (
  `ID` int(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `Teachers`
--

INSERT INTO `Teachers` (`ID`, `Name`, `Created`, `Modified`) VALUES
(1, 'Mads Book', '2018-08-27 21:55:53', '2018-08-27 21:55:53'),
(2, 'Lars Skovgaard', '2018-08-27 21:55:53', '2018-08-27 21:55:53'),
(3, 'Kasper Kristensen', '2018-08-27 21:56:29', '2018-08-27 21:56:29'),
(4, 'Lykke Mercedes Munk', '2018-08-27 21:56:29', '2018-08-27 21:56:29');

-- --------------------------------------------------------

--
-- Struktur for visning `LocationClass`
--
DROP TABLE IF EXISTS `LocationClass`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `LocationClass`  AS  select `Location`.`ID` AS `ID`,`Location`.`Name` AS `Name`,`Class`.`Name` AS `Class` from (`Location` join `Class` on((`Location`.`Class` = `Class`.`ID`))) ;

-- --------------------------------------------------------

--
-- Struktur for visning `StudentTeacherLocation`
--
DROP TABLE IF EXISTS `StudentTeacherLocation`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `StudentTeacherLocation`  AS  select `StudentTeacherRelation`.`ID` AS `ID`,`Students`.`Name` AS `Student`,`Teachers`.`Name` AS `Teacher`,`Location`.`Name` AS `Location` from (((`StudentTeacherRelation` join `Students` on((`StudentTeacherRelation`.`Student` = `Students`.`ID`))) join `Teachers` on((`StudentTeacherRelation`.`Teacher` = `Teachers`.`ID`))) join `Location` on((`StudentTeacherRelation`.`Location` = `Location`.`ID`))) ;

--
-- Begrænsninger for dumpede tabeller
--

--
-- Indeks for tabel `Class`
--
ALTER TABLE `Class`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks for tabel `Location`
--
ALTER TABLE `Location`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Location2Class` (`Class`);

--
-- Indeks for tabel `Students`
--
ALTER TABLE `Students`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks for tabel `StudentTeacherRelation`
--
ALTER TABLE `StudentTeacherRelation`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `relation2Students` (`Student`),
  ADD KEY `relation2Teacher` (`Teacher`),
  ADD KEY `relation2Location` (`Location`);

--
-- Indeks for tabel `Teachers`
--
ALTER TABLE `Teachers`
  ADD PRIMARY KEY (`ID`);

--
-- Brug ikke AUTO_INCREMENT for slettede tabeller
--

--
-- Tilføj AUTO_INCREMENT i tabel `Class`
--
ALTER TABLE `Class`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tilføj AUTO_INCREMENT i tabel `Location`
--
ALTER TABLE `Location`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Tilføj AUTO_INCREMENT i tabel `Students`
--
ALTER TABLE `Students`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Tilføj AUTO_INCREMENT i tabel `StudentTeacherRelation`
--
ALTER TABLE `StudentTeacherRelation`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Tilføj AUTO_INCREMENT i tabel `Teachers`
--
ALTER TABLE `Teachers`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Begrænsninger for dumpede tabeller
--

--
-- Begrænsninger for tabel `Location`
--
ALTER TABLE `Location`
  ADD CONSTRAINT `Location2Class` FOREIGN KEY (`Class`) REFERENCES `Class` (`ID`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Begrænsninger for tabel `StudentTeacherRelation`
--
ALTER TABLE `StudentTeacherRelation`
  ADD CONSTRAINT `relation2Location` FOREIGN KEY (`Location`) REFERENCES `Location` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `relation2Students` FOREIGN KEY (`Student`) REFERENCES `Students` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `relation2Teacher` FOREIGN KEY (`Teacher`) REFERENCES `Teachers` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
