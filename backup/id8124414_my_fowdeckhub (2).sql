-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Dic 05, 2018 alle 16:30
-- Versione del server: 10.1.31-MariaDB
-- Versione PHP: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id8124414_my_fowdeckhub`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `attributes`
--

DROP TABLE IF EXISTS `attributes`;
CREATE TABLE IF NOT EXISTS `attributes` (
  `Id` int(11) NOT NULL,
  `Name` varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `attributes`
--

INSERT INTO `attributes` (`Id`, `Name`) VALUES
(1, 'Light'),
(2, 'Fire'),
(3, 'Water'),
(4, 'Wind'),
(5, 'Darkness'),
(6, 'Void');

-- --------------------------------------------------------

--
-- Struttura della tabella `bug_reports`
--

DROP TABLE IF EXISTS `bug_reports`;
CREATE TABLE IF NOT EXISTS `bug_reports` (
  `Id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Bug` varchar(5000) NOT NULL,
  `BugState` int(11) NOT NULL DEFAULT '1',
  `CreationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `LastOperation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `bug_reports`
--

INSERT INTO `bug_reports` (`Id`, `Name`, `Email`, `Bug`, `BugState`, `CreationDate`, `LastOperation`) VALUES
(1, 'Daniele Tentoni', 'd.tentoni@wedoit.io', 'Questo bug deve essere New', 3, '2018-12-04 18:20:22', '2018-12-05 16:03:32'),
(2, 'Daniele Tentoni', 'd.tentoni@wedoit.io', 'Questo bug deve essere Open', 1, '2018-12-04 18:20:22', '2018-12-05 15:50:38'),
(3, 'Daniele Tentoni', 'd.tentoni@wedoit.io', 'Questo bug deve essere Assigned', 1, '2018-12-04 18:20:22', '2018-12-05 15:50:40'),
(4, 'Daniele Tentoni', 'd.tentoni@wedoit.io', 'Questo bug deve essere Resolved', 1, '2018-12-04 18:20:22', '2018-12-05 15:50:41'),
(8, 'Sara Tentoni', 'saratentoni98@gmail.com', '1234', 1, '2018-12-05 14:58:53', '2018-12-05 15:56:53'),
(9, 'Sara Tentoni', 'saratentoni98@gmail.com', '1234', 1, '2018-12-05 15:02:35', '2018-12-05 15:58:05'),
(10, 'Sara Tentoni', 'saratentoni98@gmail.com', '1234', 1, '2018-12-05 15:06:21', '2018-12-05 15:06:21'),
(11, 'undefined', 'undefined', 'undefined', 3, '2018-12-05 15:09:14', '2018-12-05 15:21:31'),
(12, 'undefined', 'undefined', 'undefined', 3, '2018-12-05 15:09:17', '2018-12-05 15:21:32'),
(13, '1234', 'saratentoni98@gmail.com', '1234', 3, '2018-12-05 15:09:43', '2018-12-05 15:21:33'),
(14, 'undefined', 'undefined', 'undefined', 1, '2018-12-05 15:09:48', '2018-12-05 15:09:48'),
(15, 'Sara Tentoni', 'saratentoni98@gmail.com', '1234', 1, '2018-12-05 15:12:18', '2018-12-05 15:12:18'),
(16, 'Sara Tentoni', 'saratentoni98@gmail.com', '1234', 1, '2018-12-05 15:19:09', '2018-12-05 15:19:09'),
(17, 'Sara Tentoni', 'daniele.tentoni.1996@gmail.com', '1234', 1, '2018-12-05 16:03:42', '2018-12-05 16:03:42'),
(18, '1234', 'daniele.tentoni.1996@gmail.com', '1234', 1, '2018-12-05 16:06:04', '2018-12-05 16:06:04'),
(19, '1234', 'daniele.tentoni.1996@gmail.com', '1234', 1, '2018-12-05 16:09:00', '2018-12-05 16:09:00');

-- --------------------------------------------------------

--
-- Struttura della tabella `bug_report_states`
--

DROP TABLE IF EXISTS `bug_report_states`;
CREATE TABLE IF NOT EXISTS `bug_report_states` (
  `Id` int(11) NOT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `Ordine` int(5) DEFAULT NULL,
  `Color` varchar(15) DEFAULT NULL,
  `Icon` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `bug_report_states`
--

INSERT INTO `bug_report_states` (`Id`, `Name`, `Ordine`, `Color`, `Icon`) VALUES
(1, 'New', 1, 'lb_green', 'phone'),
(2, 'Open', 2, 'lb_yellow', 'question'),
(3, 'Assigned', 3, 'lb_orange', 'wrench'),
(4, 'Resolved', 4, 'lb_red', 'check');

-- --------------------------------------------------------

--
-- Struttura della tabella `cards`
--

DROP TABLE IF EXISTS `cards`;
CREATE TABLE IF NOT EXISTS `cards` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(70) COLLATE utf8_bin NOT NULL,
  `Set` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `Number` int(11) NOT NULL,
  `Cost` varchar(10) COLLATE utf8_bin NOT NULL,
  `Visibility` int(1) NOT NULL DEFAULT '0',
  `Rarity` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Id` (`Id`),
  UNIQUE KEY `Name` (`Name`)
) ENGINE=InnoDB AUTO_INCREMENT=3450 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `cards`
--

INSERT INTO `cards` (`Id`, `Name`, `Set`, `Number`, `Cost`, `Visibility`, `Rarity`) VALUES
(3269, 'Atom Seikhart / Atom Seikhart, the Shimmering Rabbit', 'SDV1', 2, '1WW', 1, 3),
(3273, 'Brunhild /  Brunhild, Caller of Spirits', 'SDV1', 5, '2WW', 1, 3),
(3304, 'Isis / Isis, the Hundred Weapon Master', 'SDV2', 11, '2RR', 1, 3),
(3319, 'Arthur / Arthur, King of Machines', 'SDV3', 2, 'UUU', 1, 3),
(3325, 'Drone Ciambella', 'SDV3', 7, 'U', 1, 1),
(3326, 'Galvano, il Cavaliere Rapido', 'SDV3', 4, 'UU', 1, 2),
(3329, 'Loki/ Loki, the Witch of Chaos', 'SDV3', 11, '1UU', 1, 3),
(3333, 'Alfiere Meccanico', 'SDV3', 14, '1U', 1, 1),
(3334, 'Soldato Meccanico', 'SDV3', 15, 'U', 1, 1),
(3343, 'Chamimi / Chamimi, Guardian of the Sacred Bow', 'SDV4', 1, '3GG', 1, 3),
(3351, 'Hanzo / Hanzo, Chief of the Kouga', 'SDV3', 8, '1GG', 1, 3),
(3379, 'Lucifer / Lucifer, Fallen Angel of Sorrow', 'SDV5', 11, '3BB', 1, 3),
(3393, 'Aratron, Angel of Knowledge', 'NDR', 1, 'W', 1, 2),
(3394, 'Ayu, the Mysterious Wanderer', 'NDR', 2, 'WW', 1, 3),
(3433, 'Arondight, la Lama d\\\'Azoto', 'NDR', 41, 'U', 1, 3),
(3439, 'JÃ¶rmungandr, Piccolo Divoratore di Mondi', 'NDR', 47, 'U', 1, 4),
(3443, 'Cavaliere Meccanizzato', 'NDR', 51, 'U', 1, 1),
(3444, 'Merlino, UnitÃ  di Controllo della Rotonda Celeste', 'NDR', 52, '2BB', 1, 3),
(3448, 'Tecnico della Rotonda del Cielo', 'SDV3', 56, '1B', 1, 1),
(3449, 'Rotonda del Cielo, il Castello dei Cavalieri nel Cielo', 'NDR', 57, '1BB', 1, 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `card_attributes`
--

DROP TABLE IF EXISTS `card_attributes`;
CREATE TABLE IF NOT EXISTS `card_attributes` (
  `Card` int(11) NOT NULL,
  `Attribute` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `card_attributes`
--

INSERT INTO `card_attributes` (`Card`, `Attribute`) VALUES
(3393, 1),
(3394, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `card_quantities`
--

DROP TABLE IF EXISTS `card_quantities`;
CREATE TABLE IF NOT EXISTS `card_quantities` (
  `Decklist` int(11) NOT NULL,
  `Card` int(11) NOT NULL,
  `Decktype` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `card_rarity`
--

DROP TABLE IF EXISTS `card_rarity`;
CREATE TABLE IF NOT EXISTS `card_rarity` (
  `Card` int(11) NOT NULL,
  `Rarity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `card_rarity`
--

INSERT INTO `card_rarity` (`Card`, `Rarity`) VALUES
(3393, 1),
(3394, 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `card_sets`
--

DROP TABLE IF EXISTS `card_sets`;
CREATE TABLE IF NOT EXISTS `card_sets` (
  `Code` varchar(10) COLLATE utf8_bin NOT NULL,
  `Name` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `NumCards` int(11) NOT NULL DEFAULT '110',
  `Year` int(11) NOT NULL DEFAULT '2018',
  PRIMARY KEY (`Code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `card_sets`
--

INSERT INTO `card_sets` (`Code`, `Name`, `NumCards`, `Year`) VALUES
('NDR', 'New Dawn Rises', 126, 2018),
('SDR1', 'Starter Deck Reiya - Light', 11, 2017),
('SDR2', 'Starter Deck Reiya - Fire', 11, 2017),
('SDR3', 'Starter Deck Reiya - Water', 11, 2017),
('SDR4', 'Starter Deck Reiya - Wind', 11, 2017),
('SDR5', 'Starter Deck Reiya - Darkness', 11, 2017),
('SDV1', 'Starter Deck New Valhalla - Light', 23, 2018),
('SDV2', 'Starter Deck New Valhalla - Fire', 23, 2018),
('SDV3', 'Starter Deck New Valhalla - Water', 23, 2018),
('SDV4', 'Starter Deck New Valhalla - Wind', 23, 2018),
('SDV5', 'Starter Deck New Valhalla - Darkness', 23, 2018);

-- --------------------------------------------------------

--
-- Struttura della tabella `card_types`
--

DROP TABLE IF EXISTS `card_types`;
CREATE TABLE IF NOT EXISTS `card_types` (
  `Card` int(11) NOT NULL,
  `Type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `card_types`
--

INSERT INTO `card_types` (`Card`, `Type`) VALUES
(3449, 1),
(3393, 5),
(3394, 5),
(3269, 6),
(3273, 6),
(3304, 6),
(3319, 6),
(3329, 6),
(3343, 6),
(3351, 6),
(3379, 6);

-- --------------------------------------------------------

--
-- Struttura della tabella `composta`
--

DROP TABLE IF EXISTS `composta`;
CREATE TABLE IF NOT EXISTS `composta` (
  `Card` int(11) NOT NULL,
  `Decklist` int(11) NOT NULL,
  `Deck` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `decklists`
--

DROP TABLE IF EXISTS `decklists`;
CREATE TABLE IF NOT EXISTS `decklists` (
  `Id` int(11) NOT NULL,
  `Name` varchar(50) COLLATE utf8_bin NOT NULL,
  `Ruler` int(11) NOT NULL,
  `Player` varchar(50) COLLATE utf8_bin NOT NULL,
  `Event` int(11) NOT NULL,
  `Type` int(11) NOT NULL,
  `Visibility` int(1) NOT NULL DEFAULT '0',
  `GachaCode` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `Position` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `decklists`
--

INSERT INTO `decklists` (`Id`, `Name`, `Ruler`, `Player`, `Event`, `Type`, `Visibility`, `GachaCode`, `Position`) VALUES
(5, 'Hanzo Machines Mono Blue', 3351, 'Javier Herreras', 1, 1, 1, '14971324', 1),
(6, 'Hanzo Machines Green Splash', 3351, 'Jordan Tan Xuan You', 1, 1, 1, '50970387', 2),
(7, 'Lucifer Control By Federico Zoppini', 3379, 'Federico Zoppini', 1, 2, 1, '27986330', 4),
(8, 'Lucifer Control By Federico ZoppiniCharlie DeMeull', 3379, 'Charlie DeMeulle', 1, 2, 1, '70977462', 5),
(9, 'Lucifer Control By Kevin Carrara', 3379, 'Kevin Carrara', 1, 2, 1, '70986333', 6),
(10, 'Lucifer Control By Philip Chybiorz', 3379, 'Philip Chybiorz', 1, 2, 1, '17980335', 8);

-- --------------------------------------------------------

--
-- Struttura della tabella `decktypes`
--

DROP TABLE IF EXISTS `decktypes`;
CREATE TABLE IF NOT EXISTS `decktypes` (
  `Id` int(11) NOT NULL,
  `Name` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `Style` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `decktypes`
--

INSERT INTO `decktypes` (`Id`, `Name`, `Style`) VALUES
(1, 'Hanzo Machines', 2),
(2, 'Lucifer Control', 3),
(3, 'Brunild Control', 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `deck_types`
--

DROP TABLE IF EXISTS `deck_types`;
CREATE TABLE IF NOT EXISTS `deck_types` (
  `Id` int(11) NOT NULL,
  `Name` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) COLLATE utf8_bin NOT NULL,
  `Location` int(11) NOT NULL,
  `Nation` int(11) NOT NULL,
  `Year` int(11) NOT NULL,
  `Attendance` int(11) NOT NULL,
  `Date` datetime DEFAULT NULL,
  `CommunityReports` varchar(5000) COLLATE utf8_bin DEFAULT NULL,
  `OtherLinks` varchar(5000) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Id` (`Id`),
  UNIQUE KEY `Name` (`Name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `events`
--

INSERT INTO `events` (`Id`, `Name`, `Location`, `Nation`, `Year`, `Attendance`, `Date`, `CommunityReports`, `OtherLinks`) VALUES
(1, 'WGP - World Gran Prix Tokyo Japan', 1, 1, 2018, 112, '2018-09-22 00:00:00', 'No community reports. Contact the admin if you have one!', 'There is no other links for this event.'),
(2, 'WGPQ - Minnesota', 2, 2, 2018, 159, '2018-10-20 00:00:00', 'No community reports. Contact the admin if you have one!', 'There is no other links for this event.'),
(3, 'WGP - Side Event Tokyo Japan', 0, 1, 2018, 10, '2018-09-23 00:00:00', 'No community reports. Contact the admin if you have one!', 'There is no other links for this event.');

-- --------------------------------------------------------

--
-- Struttura della tabella `event_rulers_breakdown`
--

DROP TABLE IF EXISTS `event_rulers_breakdown`;
CREATE TABLE IF NOT EXISTS `event_rulers_breakdown` (
  `Event` int(11) NOT NULL,
  `Ruler` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `formats`
--

DROP TABLE IF EXISTS `formats`;
CREATE TABLE IF NOT EXISTS `formats` (
  `Code` varchar(10) COLLATE utf8_bin NOT NULL,
  `Name` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `Tournament` int(1) DEFAULT '0',
  `Visibility` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Code`),
  UNIQUE KEY `Name` (`Name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `formats`
--

INSERT INTO `formats` (`Code`, `Name`, `Tournament`, `Visibility`) VALUES
('NV1', 'New Valhalla Block NV0 - NV1', 1, 1),
('R/NV1', 'New Frontier - Reiya / New Valhalla R0 - NV1', 1, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `login_attempts`
--

DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE IF NOT EXISTS `login_attempts` (
  `UserId` int(11) DEFAULT NULL,
  `DataAccesso` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Risultato` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `login_attempts`
--

INSERT INTO `login_attempts` (`UserId`, `DataAccesso`, `Risultato`) VALUES
(3, NULL, 1),
(3, NULL, 1),
(3, NULL, 1),
(3, NULL, 1),
(3, NULL, 1),
(3, NULL, 1),
(3, NULL, 1),
(3, NULL, 1),
(3, NULL, 1),
(3, NULL, 1),
(3, NULL, 1),
(3, NULL, 1),
(3, NULL, 1),
(3, NULL, 1),
(3, NULL, 1),
(3, NULL, 1),
(3, NULL, 1),
(3, NULL, 1),
(3, NULL, 1),
(3, NULL, 1),
(3, NULL, 1),
(3, NULL, 1),
(3, NULL, 1),
(3, NULL, 1),
(3, NULL, 1),
(3, NULL, 1),
(3, NULL, 1),
(3, NULL, 1),
(3, NULL, 1),
(3, NULL, 1),
(3, NULL, 1),
(3, NULL, 1),
(3, NULL, 1),
(3, NULL, 1),
(3, NULL, 1),
(3, '2018-11-02 16:33:47', 1),
(3, '2018-11-14 14:39:21', 1),
(3, '2018-11-14 17:04:39', 1),
(3, '2018-11-14 17:06:13', 1),
(3, '2018-11-14 17:07:03', 1),
(3, '2018-11-14 17:07:56', 1),
(3, '2018-11-14 17:08:38', 1),
(3, '2018-11-14 17:09:12', 1),
(3, '2018-11-14 18:19:24', 1),
(3, '2018-11-14 21:03:18', 1),
(3, '2018-11-14 21:04:34', 1),
(3, '2018-11-14 21:08:32', 1),
(3, '2018-11-30 21:23:40', 1),
(3, '2018-12-01 18:32:26', 1),
(3, '2018-12-01 18:42:29', 1),
(3, '2018-12-04 18:01:05', 1),
(3, '2018-12-04 19:12:55', 1),
(3, '2018-12-04 22:18:26', 1),
(3, '2018-12-05 16:12:23', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `nations`
--

DROP TABLE IF EXISTS `nations`;
CREATE TABLE IF NOT EXISTS `nations` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `nations`
--

INSERT INTO `nations` (`Id`, `Name`) VALUES
(1, 'Japan'),
(2, 'Usa'),
(3, 'Italy');

-- --------------------------------------------------------

--
-- Struttura della tabella `playstyles`
--

DROP TABLE IF EXISTS `playstyles`;
CREATE TABLE IF NOT EXISTS `playstyles` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `playstyles`
--

INSERT INTO `playstyles` (`Id`, `Name`) VALUES
(1, 'Aggro'),
(2, 'Midrange'),
(3, 'Control'),
(4, 'Combo'),
(5, 'Other');

-- --------------------------------------------------------

--
-- Struttura della tabella `rarity`
--

DROP TABLE IF EXISTS `rarity`;
CREATE TABLE IF NOT EXISTS `rarity` (
  `Id` int(11) NOT NULL,
  `Name` varchar(30) COLLATE utf8_bin NOT NULL,
  `Symbol` varchar(10) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `rarity`
--

INSERT INTO `rarity` (`Id`, `Name`, `Symbol`) VALUES
(1, 'Common', 'C'),
(2, 'Uncommon', 'U'),
(3, 'Rare', 'R'),
(4, 'Superare', 'SR');

-- --------------------------------------------------------

--
-- Struttura della tabella `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) COLLATE utf8_bin NOT NULL,
  `UserPower` int(1) NOT NULL DEFAULT '0',
  `CardPower` int(1) NOT NULL DEFAULT '0',
  `DecklistPower` int(1) NOT NULL DEFAULT '0',
  `EventsPower` int(1) NOT NULL DEFAULT '0',
  `CanEditEvents` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Id` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `roles`
--

INSERT INTO `roles` (`Id`, `Name`, `UserPower`, `CardPower`, `DecklistPower`, `EventsPower`, `CanEditEvents`) VALUES
(1, 'Superuser', 1, 1, 1, 1, 1),
(2, 'User', 0, 0, 0, 0, 0),
(3, 'Administrator', 0, 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `sets_legality`
--

DROP TABLE IF EXISTS `sets_legality`;
CREATE TABLE IF NOT EXISTS `sets_legality` (
  `CardSet` varchar(10) COLLATE utf8_bin NOT NULL,
  `Format` varchar(10) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`CardSet`,`Format`),
  KEY `sets_legality_formats_fk` (`Format`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `site_params`
--

DROP TABLE IF EXISTS `site_params`;
CREATE TABLE IF NOT EXISTS `site_params` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Codice` varchar(30) COLLATE utf8_bin NOT NULL,
  `Valore` varchar(30) COLLATE utf8_bin NOT NULL,
  `DesVal` varchar(100) COLLATE utf8_bin NOT NULL,
  `Note` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `types`
--

DROP TABLE IF EXISTS `types`;
CREATE TABLE IF NOT EXISTS `types` (
  `Id` int(11) NOT NULL,
  `Name` varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `types`
--

INSERT INTO `types` (`Id`, `Name`) VALUES
(0, 'Ruler / J-Ruler'),
(1, 'Addizione'),
(2, 'Canto'),
(3, 'Emblema'),
(4, 'Pietra Magica'),
(5, 'Risonatore'),
(6, 'Ruler / J-Ruler');

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) COLLATE utf8_bin NOT NULL,
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` char(128) COLLATE utf8_bin NOT NULL,
  `salt` char(128) COLLATE utf8_bin NOT NULL,
  `registerdate` date NOT NULL,
  `role` int(11) NOT NULL DEFAULT '2',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `salt`, `registerdate`, `role`) VALUES
(1, 'AntonioParolisi', 'daniele.tentoni.1996@gmail.com', '00807432eae173f652f2064bdca1b61b290b52d40e429a7d295d76a71084aa96c0233b82f1feac45529e0726559645acaed6f3ae58a286b9f075916ebf66cacc', 'f9aab579fc1b41ed0c44fe4ecdbfcdb4cb99b9023abb241a6db833288f4eea3c02f76e0d35204a8695077dcf81932aa59006423976224be0390395bae152d4ef', '2018-09-19', 3),
(2, 'testAccount', 'daniele.tentoni.1996@gmail.com', 'd78ff18851707a36a94adc43be550f4c0ea82a9ede3c359f07b29b3041ddd268e1239bd48348ad66efd129f0266932149e6981d4ca4786df21b159ea060af1c3', '48acc7a4a82c1248d0c60470eea07ce47f3e826d68bf8070f26ff76e7df6067bb1b8ad97bbfc4040805913048fc9dc2304322d52d79e8740f3321526a21ae229', '0000-00-00', 2),
(3, 'adminAccount', 'a@a.com', 'fffd14cbbb979f806e65f41f6eef6ad3d13c13d62a9b76b8fdb45c938bda250533198de209c0419a03009f916b3b246a493c4304e8338758b320f8b8a8ed4b9d', '8c2779e246843f6951e01672a57c062e88d8e6cf423c7163a62f57071a13bd04104e44099b3f52ae1f0e32c000d683663ec1fdfd85e0413ce78b1710ba627c71', '0000-00-00', 1);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `sets_legality`
--
ALTER TABLE `sets_legality`
  ADD CONSTRAINT `cardsets_legality_sets_fk` FOREIGN KEY (`CardSet`) REFERENCES `card_sets` (`Code`),
  ADD CONSTRAINT `sets_legality_formats_fk` FOREIGN KEY (`Format`) REFERENCES `formats` (`Code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
