-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Ott 03, 2018 alle 16:50
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
-- Struttura della tabella `cards`
--

CREATE TABLE IF NOT EXISTS `cards` (
`Id` int(11) NOT NULL,
  `Name` varchar(50) COLLATE utf8_bin NOT NULL,
  `Set` int(11) NOT NULL,
  `Number` int(11) NOT NULL,
  `Type` int(11) NOT NULL,
  `Cost` int(11) NOT NULL,
  `Attribute` int(11) NOT NULL,
  `Rarity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

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
  `Style` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
    `userid` int(11) NOT NULL,
    `dataaccesso` varchar(30) COLLATE utf8_bin NOT NULL
    `risultato` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
-- Struttura della tabella `users`
--

CREATE TABLE IF NOT EXISTS `users` (
    `id` int(11) NOT NULL,
    `username` varchar(30) COLLATE utf8_bin NOT NULL,
    `nome` varchar(30) COLLATE utf8_bin NOT NULL,
    `cognome` varchar(30) COLLATE utf8_bin NOT NULL,
    `email` varchar(50) COLLATE utf8_bin NOT NULL,
    `password` char(128) COLLATE utf8_bin NOT NULL,
    `salt` char(128) COLLATE utf8_bin NOT NULL,
    `registerdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `role` int(11) NOT NULL DEFAULT '2'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=29 ;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `salt`, `registerdate`, `role`) VALUES
(1, 'AntonioParolisi', 'daniele.tentoni.1996@gmail.com', '00807432eae173f652f2064bdca1b61b290b52d40e429a7d295d76a71084aa96c0233b82f1feac45529e0726559645acaed6f3ae58a286b9f075916ebf66cacc', 'f9aab579fc1b41ed0c44fe4ecdbfcdb4cb99b9023abb241a6db833288f4eea3c02f76e0d35204a8695077dcf81932aa59006423976224be0390395bae152d4ef', '2018-09-18 22:00:00', 1),
(27, 'asdf', 'asdf@asdf.com', '2531d17bfcb51a6d4c60018b770f69cd5a7a4b74148838062fa864cac5859c6b40a088c70cff18aaf3a299f7a39194a3ab08a48e923e81a0cddd0c7fef676eaa', '9cc89dbac2573db1b4f0a20752f3a35f3a58e4a892617c42afce49fa5977094703bf3e47ad9234507f60dc5a948393bf6418bf9324c498fbbdd14638800c85f0', '2018-09-22 16:05:21', 2),
(28, 'admin', 'a@a.com', '2ac5b943f3638def755a28ef29a0d5f27943bc245282495e2a45cf120e695f568914a66e914df967220d04690231dc86b64957d27f0fcb28d212e3bfb45dac27', '45eb63ac8b93112901ad086b5318c52aada566d0ea7d4df5717b639c5ef890d7c2f30ec431f614536bf8cb6eb02e39692c62fbb370f73310dbd682cdf75707df', '2018-09-22 16:33:12', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
 ADD PRIMARY KEY (`Id`), ADD UNIQUE KEY `Id` (`Id`), ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `composta`
--
ALTER TABLE `composta`
 ADD PRIMARY KEY (`Card`,`Decklist`,`Deck`), ADD KEY `Decklist` (`Decklist`);

--
-- Indexes for table `decklists`
--
ALTER TABLE `decklists`
 ADD PRIMARY KEY (`Id`), ADD UNIQUE KEY `Id` (`Id`), ADD UNIQUE KEY `Name` (`Name`), ADD KEY `Ruler` (`Ruler`), ADD KEY `Event` (`Event`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
 ADD PRIMARY KEY (`Id`), ADD UNIQUE KEY `Id` (`Id`), ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
 ADD PRIMARY KEY (`Id`), ADD UNIQUE KEY `Id` (`Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`), ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `decklists`
--
ALTER TABLE `decklists`
MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- Limiti per le tabelle scaricate
--

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
ADD CONSTRAINT `decklists_ibfk_2` FOREIGN KEY (`Event`) REFERENCES `events` (`Id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
