-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2018 alle 13:28
-- Versione del server: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `my_fowdeckhub`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `attributes`
--

CREATE TABLE IF NOT EXISTS `attributes` (
  `Id` int(11) NOT NULL,
  `Name` varchar(30) COLLATE utf8_bin NOT NULL
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
-- Struttura della tabella `cards`
--

CREATE TABLE IF NOT EXISTS `cards` (
`Id` int(11) NOT NULL,
  `Name` varchar(50) COLLATE utf8_bin NOT NULL,
  `Set` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `Number` int(11) NOT NULL,
  `Cost` varchar(10) COLLATE utf8_bin NOT NULL,
  `Visibility` int(1) NOT NULL DEFAULT '0',
  `Rarity` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3450 ;

--
-- Dump dei dati per la tabella `cards`
--

INSERT INTO `cards` (`Id`, `Name`, `Set`, `Number`, `Cost`, `Visibility`, `Rarity`) VALUES
(3325, 'Drone Ciambella', 'SDV3', 7, 'U', 1, 1),
(3326, 'Galvano, il Cavaliere Rapido', 'SDV3', 4, 'UU', 1, 2),
(3333, 'Alfiere Meccanico', 'SDV3', 14, '1U', 1, 1),
(3334, 'Soldato Meccanico', 'SDV3', 15, 'U', 1, 1),
(3351, 'Hanzo', 'SDV3', 8, '1GG', 1, 3),
(3379, 'Lucifero / Lucifero, l\\''Angelo Caduto del Cordogli', 'SDR5', 11, '3BB', 1, 3),
(3393, 'Aratron, Angel of Knowledge', 'NDR', 1, 'W', 1, 2),
(3394, 'Ayu, the Mysterious Wanderer', 'NDR', 2, 'WW', 1, 3),
(3433, 'Arondight, la Lama d\\''Azoto', 'NDR', 41, 'U', 1, 3),
(3439, 'JÃ¶rmungandr, Piccolo Divoratore di Mondi', 'NDR', 47, 'U', 1, 4),
(3443, 'Cavaliere Meccanizzato', 'NDR', 51, 'U', 1, 1),
(3444, 'Merlino, UnitÃ  di Controllo della Rotonda Celeste', 'NDR', 52, '2BB', 1, 3),
(3448, 'Tecnico della Rotonda del Cielo', 'SDV3', 56, '1B', 1, 1),
(3449, 'Rotonda del Cielo, il Castello dei Cavalieri nel C', 'NDR', 57, '1BB', 1, 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `card_attributes`
--

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

CREATE TABLE IF NOT EXISTS `card_sets` (
  `Code` varchar(10) COLLATE utf8_bin NOT NULL,
  `Name` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `NumCards` int(11) NOT NULL DEFAULT '110',
  `Year` int(11) NOT NULL DEFAULT '2018'
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
(3351, 6),
(3379, 6);

-- --------------------------------------------------------

--
-- Struttura della tabella `composta`
--

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=11 ;

--
-- Dump dei dati per la tabella `decklists`
--

INSERT INTO `decklists` (`Id`, `Name`, `Ruler`, `Player`, `Event`, `Type`, `Visibility`, `GachaCode`, `Position`) VALUES
(5, '1234', 3351, 'Javier Herreras', 1, 1, 1, '14971324', 1),
(6, 'Hanzo Machine Green Splash', 3351, 'Jordan Tan Xuan You', 1, 1, 1, '50970387', 2),
(7, 'Lucifer Control By Federico Zoppini', 3379, 'Federico Zoppini', 1, 2, 1, '27986330', 4),
(8, 'Lucifer Control By Federico ZoppiniCharlie DeMeull', 3379, 'Charlie DeMeulle', 1, 2, 1, '70977462', 5),
(9, 'Lucifer Control By Kevin Carrara', 3379, 'Kevin Carrara', 1, 2, 1, '70986333', 6),
(10, 'Lucifer Control By Philip Chybiorz', 3379, 'Philip Chybiorz', 1, 2, 1, '17980335', 8);

-- --------------------------------------------------------

--
-- Struttura della tabella `decktypes`
--

CREATE TABLE IF NOT EXISTS `decktypes` (
`Id` int(11) NOT NULL,
  `Name` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `Style` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

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

CREATE TABLE IF NOT EXISTS `deck_types` (
  `Id` int(11) NOT NULL,
  `Name` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `events`
--

CREATE TABLE IF NOT EXISTS `events` (
`Id` int(11) NOT NULL,
  `Name` varchar(50) COLLATE utf8_bin NOT NULL,
  `Location` int(11) NOT NULL,
  `Nation` int(11) NOT NULL,
  `Year` int(11) NOT NULL,
  `Attendance` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Dump dei dati per la tabella `events`
--

INSERT INTO `events` (`Id`, `Name`, `Location`, `Nation`, `Year`, `Attendance`) VALUES
(1, 'WGP - World Gran Prix Tokyo Japan', 1, 1, 2018, 112),
(2, 'WGPQ - Minnesota', 2, 2, 2019, 159);

-- --------------------------------------------------------

--
-- Struttura della tabella `formats`
--

CREATE TABLE IF NOT EXISTS `formats` (
  `Code` varchar(10) COLLATE utf8_bin NOT NULL,
  `Name` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `Tournament` int(1) DEFAULT '0',
  `Visibility` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `formats`
--

INSERT INTO `formats` (`Code`, `Name`, `Tournament`, `Visibility`) VALUES
('NV1', 'New Valhalla Block NV0 - NV1', 1, 1),
('R/NV1', 'New Frontier - Reiya / New Valhalla R0 - NV1', 1, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `format_params`
--

CREATE TABLE IF NOT EXISTS `format_params` (
`Id` int(11) NOT NULL,
  `Code` varchar(30) COLLATE utf8_bin NOT NULL,
  `Value` varchar(30) COLLATE utf8_bin NOT NULL,
  `Des` varchar(100) COLLATE utf8_bin NOT NULL,
  `DesVal` varchar(100) COLLATE utf8_bin NOT NULL,
  `Card` int(11) DEFAULT NULL,
  `Format` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `UserId` int(11) DEFAULT NULL,
  `DataAccesso` varchar(10) COLLATE utf8_bin DEFAULT NULL,
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
(3, NULL, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `playstyles`
--

CREATE TABLE IF NOT EXISTS `playstyles` (
`Id` int(11) NOT NULL,
  `Name` varchar(30) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

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

CREATE TABLE IF NOT EXISTS `rarity` (
  `Id` int(11) NOT NULL,
  `Name` varchar(30) COLLATE utf8_bin NOT NULL,
  `Symbol` varchar(10) COLLATE utf8_bin NOT NULL
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

CREATE TABLE IF NOT EXISTS `roles` (
`Id` int(11) NOT NULL,
  `Name` varchar(50) COLLATE utf8_bin NOT NULL,
  `UserPower` int(1) NOT NULL DEFAULT '0',
  `CardPower` int(1) NOT NULL DEFAULT '0',
  `DecklistPower` int(1) NOT NULL DEFAULT '0',
  `EventsPower` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Dump dei dati per la tabella `roles`
--

INSERT INTO `roles` (`Id`, `Name`, `UserPower`, `CardPower`, `DecklistPower`, `EventsPower`) VALUES
(1, 'Superuser', 1, 1, 1, 1),
(2, 'User', 0, 0, 0, 0),
(3, 'Administrator', 0, 1, 1, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `sets_legality`
--

CREATE TABLE IF NOT EXISTS `sets_legality` (
  `CardSet` varchar(10) COLLATE utf8_bin NOT NULL,
  `Format` varchar(10) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `site_params`
--

CREATE TABLE IF NOT EXISTS `site_params` (
`Id` int(11) NOT NULL,
  `Codice` varchar(30) COLLATE utf8_bin NOT NULL,
  `Valore` varchar(30) COLLATE utf8_bin NOT NULL,
  `DesVal` varchar(100) COLLATE utf8_bin NOT NULL,
  `Note` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `types`
--

CREATE TABLE IF NOT EXISTS `types` (
  `Id` int(11) NOT NULL,
  `Name` varchar(30) COLLATE utf8_bin NOT NULL
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

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `username` varchar(30) COLLATE utf8_bin NOT NULL,
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` char(128) COLLATE utf8_bin NOT NULL,
  `salt` char(128) COLLATE utf8_bin NOT NULL,
  `registerdate` date NOT NULL,
  `role` int(11) NOT NULL DEFAULT '2'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `salt`, `registerdate`, `role`) VALUES
(1, 'AntonioParolisi', 'daniele.tentoni.1996@gmail.com', '00807432eae173f652f2064bdca1b61b290b52d40e429a7d295d76a71084aa96c0233b82f1feac45529e0726559645acaed6f3ae58a286b9f075916ebf66cacc', 'f9aab579fc1b41ed0c44fe4ecdbfcdb4cb99b9023abb241a6db833288f4eea3c02f76e0d35204a8695077dcf81932aa59006423976224be0390395bae152d4ef', '2018-09-19', 3),
(2, 'testAccount', 'daniele.tentoni.1996@gmail.com', 'd78ff18851707a36a94adc43be550f4c0ea82a9ede3c359f07b29b3041ddd268e1239bd48348ad66efd129f0266932149e6981d4ca4786df21b159ea060af1c3', '48acc7a4a82c1248d0c60470eea07ce47f3e826d68bf8070f26ff76e7df6067bb1b8ad97bbfc4040805913048fc9dc2304322d52d79e8740f3321526a21ae229', '0000-00-00', 2),
(3, 'adminAccount', 'a@a.com', 'fffd14cbbb979f806e65f41f6eef6ad3d13c13d62a9b76b8fdb45c938bda250533198de209c0419a03009f916b3b246a493c4304e8338758b320f8b8a8ed4b9d', '8c2779e246843f6951e01672a57c062e88d8e6cf423c7163a62f57071a13bd04104e44099b3f52ae1f0e32c000d683663ec1fdfd85e0413ce78b1710ba627c71', '0000-00-00', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
 ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
 ADD PRIMARY KEY (`Id`), ADD UNIQUE KEY `Id` (`Id`), ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `card_attributes`
--
ALTER TABLE `card_attributes`
 ADD PRIMARY KEY (`Card`,`Attribute`), ADD KEY `Attribute` (`Attribute`);

--
-- Indexes for table `card_quantities`
--
ALTER TABLE `card_quantities`
 ADD PRIMARY KEY (`Decklist`,`Card`,`Decktype`), ADD KEY `Card` (`Card`), ADD KEY `Decktype` (`Decktype`);

--
-- Indexes for table `card_rarity`
--
ALTER TABLE `card_rarity`
 ADD PRIMARY KEY (`Card`,`Rarity`), ADD KEY `Rarity` (`Rarity`);

--
-- Indexes for table `card_sets`
--
ALTER TABLE `card_sets`
 ADD PRIMARY KEY (`Code`);

--
-- Indexes for table `card_types`
--
ALTER TABLE `card_types`
 ADD PRIMARY KEY (`Card`,`Type`), ADD KEY `Type` (`Type`);

--
-- Indexes for table `composta`
--
ALTER TABLE `composta`
 ADD PRIMARY KEY (`Card`,`Decklist`,`Deck`), ADD KEY `Decklist` (`Decklist`);

--
-- Indexes for table `decklists`
--
ALTER TABLE `decklists`
 ADD PRIMARY KEY (`Id`), ADD UNIQUE KEY `Id` (`Id`), ADD UNIQUE KEY `Name` (`Name`), ADD KEY `Ruler` (`Ruler`), ADD KEY `Event` (`Event`), ADD KEY `decklists_style` (`Type`);

--
-- Indexes for table `decktypes`
--
ALTER TABLE `decktypes`
 ADD PRIMARY KEY (`Id`), ADD KEY `Style` (`Style`);

--
-- Indexes for table `deck_types`
--
ALTER TABLE `deck_types`
 ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
 ADD PRIMARY KEY (`Id`), ADD UNIQUE KEY `Id` (`Id`), ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `formats`
--
ALTER TABLE `formats`
 ADD PRIMARY KEY (`Code`), ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `format_params`
--
ALTER TABLE `format_params`
 ADD PRIMARY KEY (`Id`), ADD UNIQUE KEY `Code` (`Code`);

--
-- Indexes for table `playstyles`
--
ALTER TABLE `playstyles`
 ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `rarity`
--
ALTER TABLE `rarity`
 ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
 ADD PRIMARY KEY (`Id`), ADD UNIQUE KEY `Id` (`Id`);

--
-- Indexes for table `sets_legality`
--
ALTER TABLE `sets_legality`
 ADD PRIMARY KEY (`CardSet`,`Format`), ADD KEY `sets_legality_formats_fk` (`Format`);

--
-- Indexes for table `site_params`
--
ALTER TABLE `site_params`
 ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
 ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3450;
--
-- AUTO_INCREMENT for table `decklists`
--
ALTER TABLE `decklists`
MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `decktypes`
--
ALTER TABLE `decktypes`
MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `format_params`
--
ALTER TABLE `format_params`
MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `playstyles`
--
ALTER TABLE `playstyles`
MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `site_params`
--
ALTER TABLE `site_params`
MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `card_attributes`
--
ALTER TABLE `card_attributes`
ADD CONSTRAINT `card_attributes_ibfk_1` FOREIGN KEY (`Card`) REFERENCES `cards` (`Id`),
ADD CONSTRAINT `card_attributes_ibfk_2` FOREIGN KEY (`Attribute`) REFERENCES `attributes` (`Id`);

--
-- Limiti per la tabella `card_quantities`
--
ALTER TABLE `card_quantities`
ADD CONSTRAINT `card_quantities_ibfk_1` FOREIGN KEY (`Decklist`) REFERENCES `decklists` (`Id`),
ADD CONSTRAINT `card_quantities_ibfk_2` FOREIGN KEY (`Card`) REFERENCES `cards` (`Id`),
ADD CONSTRAINT `card_quantities_ibfk_3` FOREIGN KEY (`Decktype`) REFERENCES `deck_types` (`Id`);

--
-- Limiti per la tabella `card_rarity`
--
ALTER TABLE `card_rarity`
ADD CONSTRAINT `card_rarity_ibfk_1` FOREIGN KEY (`Card`) REFERENCES `cards` (`Id`),
ADD CONSTRAINT `card_rarity_ibfk_2` FOREIGN KEY (`Rarity`) REFERENCES `rarity` (`Id`);

--
-- Limiti per la tabella `card_types`
--
ALTER TABLE `card_types`
ADD CONSTRAINT `card_types_ibfk_1` FOREIGN KEY (`Card`) REFERENCES `cards` (`Id`),
ADD CONSTRAINT `card_types_ibfk_2` FOREIGN KEY (`Type`) REFERENCES `types` (`Id`);

--
-- Limiti per la tabella `composta`
--
ALTER TABLE `composta`
ADD CONSTRAINT `composta_ibfk_1` FOREIGN KEY (`Card`) REFERENCES `cards` (`Id`),
ADD CONSTRAINT `composta_ibfk_2` FOREIGN KEY (`Decklist`) REFERENCES `decklists` (`Id`);

--
-- Limiti per la tabella `decklists`
--
ALTER TABLE `decklists`
ADD CONSTRAINT `decklists_ibfk_1` FOREIGN KEY (`Ruler`) REFERENCES `cards` (`Id`),
ADD CONSTRAINT `decklists_ibfk_2` FOREIGN KEY (`Event`) REFERENCES `events` (`Id`),
ADD CONSTRAINT `decklists_style` FOREIGN KEY (`Type`) REFERENCES `decktypes` (`Id`);

--
-- Limiti per la tabella `decktypes`
--
ALTER TABLE `decktypes`
ADD CONSTRAINT `decktypes_ibfk_1` FOREIGN KEY (`Style`) REFERENCES `playstyles` (`Id`);

--
-- Limiti per la tabella `sets_legality`
--
ALTER TABLE `sets_legality`
ADD CONSTRAINT `cardsets_legality_sets_fk` FOREIGN KEY (`CardSet`) REFERENCES `card_sets` (`Code`),
ADD CONSTRAINT `sets_legality_formats_fk` FOREIGN KEY (`Format`) REFERENCES `formats` (`Code`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
