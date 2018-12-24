SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `my_fowdeckhub` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `my_fowdeckhub`;

DROP TABLE IF EXISTS `attributes`;
CREATE TABLE IF NOT EXISTS `attributes` (
  `Id` int(11) NOT NULL,
  `Name` varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `attributes` (`Id`, `Name`) VALUES
(1, 'Light'),
(2, 'Fire'),
(3, 'Water'),
(4, 'Wind'),
(5, 'Darkness'),
(6, 'Void');

DROP TABLE IF EXISTS `bug_reports`;
CREATE TABLE IF NOT EXISTS `bug_reports` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Bug` varchar(5000) NOT NULL,
  `BugState` int(11) NOT NULL DEFAULT '1',
  `CreationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `LastOperation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Id` (`Id`),
  KEY `BugState` (`BugState`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=27 ;

--
-- Dump dei dati per la tabella `bug_reports`
--

INSERT INTO `bug_reports` (`Id`, `Name`, `Email`, `Bug`, `BugState`, `CreationDate`, `LastOperation`) VALUES
(1, 'Daniele Tentoni', 'd.tentoni@wedoit.io', 'Questo bug deve essere New', 1, '2018-12-04 18:20:22', '2018-12-10 21:30:36'),
(2, 'Daniele Tentoni', 'd.tentoni@wedoit.io', 'Questo bug deve essere Open', 2, '2018-12-04 18:20:22', '2018-12-10 21:30:40'),
(3, 'Daniele Tentoni', 'd.tentoni@wedoit.io', 'Questo bug deve essere Assigned', 3, '2018-12-04 18:20:22', '2018-12-10 21:30:40'),
(4, 'Daniele Tentoni', 'd.tentoni@wedoit.io', 'Questo bug deve essere Resolved', 4, '2018-12-04 18:20:22', '2018-12-10 13:56:59');

DROP TABLE IF EXISTS `bug_report_states`;
CREATE TABLE IF NOT EXISTS `bug_report_states` (
  `Id` int(11) NOT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `Ordine` int(5) DEFAULT NULL,
  `Color` varchar(15) DEFAULT NULL,
  `Icon` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Id` (`Id`),
  UNIQUE KEY `Ordine` (`Ordine`),
  UNIQUE KEY `Color` (`Color`),
  UNIQUE KEY `Icon` (`Icon`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `bug_report_states` (`Id`, `Name`, `Ordine`, `Color`, `Icon`) VALUES
(1, 'New', 1, 'lb_green', 'phone'),
(2, 'Open', 2, 'lb_yellow', 'question'),
(3, 'Assigned', 3, 'lb_orange', 'wrench'),
(4, 'Resolved', 4, 'lb_red', 'check');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3491 ;

INSERT INTO `cards` (`Id`, `Name`, `Set`, `Number`, `Cost`, `Visibility`, `Rarity`) VALUES
(3269, 'Atom Seikhart', 'SDV1', 2, '1WW', 1, 3),
(3273, 'Brunhild', 'SDV1', 5, '2WW', 1, 3),
(3304, 'Isis', 'SDV2', 11, '2RR', 1, 3),
(3319, 'Arthur', 'SDV3', 2, 'UUU', 1, 3),
(3325, 'Drone Ciambella', 'SDV3', 7, 'U', 1, 1),
(3326, 'Galvano, il Cavaliere Rapido', 'SDV3', 4, 'UU', 1, 2),
(3329, 'Loki', 'SDV3', 11, '1UU', 1, 3),
(3333, 'Alfiere Meccanico', 'SDV3', 14, '1U', 1, 1),
(3334, 'Soldato Meccanico', 'SDV3', 15, 'U', 1, 1),
(3343, 'Chamimi', 'SDV4', 1, '3GG', 1, 3),
(3351, 'Hanzo', 'SDV3', 8, '1GG', 1, 3),
(3379, 'Lucifer', 'SDV5', 11, '3BB', 1, 3),
(3393, 'Aratron, Angel of Knowledge', 'NDR', 1, 'W', 1, 2),
(3394, 'Ayu, the Mysterious Wanderer', 'NDR', 2, 'WW', 1, 3),
(3433, 'Arondight, la Lama d\\''Azoto', 'NDR', 41, 'U', 1, 3),
(3439, 'JÃ¶rmungandr, Piccolo Divoratore di Mondi', 'NDR', 47, 'U', 1, 4),
(3443, 'Cavaliere Meccanizzato', 'NDR', 51, 'U', 1, 1),
(3444, 'Merlino, UnitÃ  di Controllo della Rotonda Celeste', 'NDR', 52, '2BB', 1, 3),
(3448, 'Tecnico della Rotonda del Cielo', 'SDV3', 56, '1B', 1, 1),
(3449, 'Rotonda del Cielo, il Castello dei Cavalieri nel Cielo', 'NDR', 57, '1BB', 1, 2),
(3274, 'Brunhild, Caller of Spirits', 'SDV1', 5, '2WW', 1, 3),
(3271, 'Bethor, the Angel of Treasure', 'SDV1', 3, '1W', 1, 1),
(3385, 'Skeleton Horde', 'SDV5', 16, 'B', 1, 1),
(3381, 'Patchwork Frankenstein', 'SDV5', 12, 'BB', 1, 1),
(3278, 'Eir, Valkyrie of Mercy', 'SDV1', 9, '1WW', 1, 2),
(3368, 'Armaros, the Fallen Angel of Nullification', 'SDV5', 1, '1BB', 1, 2),
(3384, 'Shemhaza, the Fallen Angel of Sadism', 'SDV5', 15, '2BB', 1, 4),
(3474, 'Azazel, the Fallen Angel of Gloom', 'NDR', 82, '2BB', 1, 3),
(3475, 'Belial, the Evil from the Scriptures', 'NDR', 83, '3BBB', 1, 4),
(3489, 'Rain of Tears', 'NDR', 97, 'B', 1, 1),
(3485, 'Look of Corruption', 'NDR', 93, 'B', 1, 3),
(3410, 'Spear of the Valkyries', 'NDR', 18, '1W', 1, 2),
(3484, 'Life Severing Blade', 'NDR', 92, '2B', 1, 3),
(3488, 'Oborozuki', 'NDR', 96, 'BB', 1, 4),
(3374, 'Immortal Commander', 'SDV5', 7, '1BB', 1, 2),
(3481, 'Disgraced Knight', 'NDR', 89, 'BBB', 1, 3),
(3390, 'Vlad, the Insatiable', 'SDV5', 21, '2BB', 1, 4),
(3479, 'Craving', 'NDR', 87, '3BB', 1, 2),
(3490, 'Ruins of Neverending Rain, Rainruins', 'NDR', 98, '2BB', 1, 2),
(3276, 'Dispel', 'SDV1', 7, 'W', 1, 1),
(3275, 'Brunhild''s Wrath', 'SDV1', 6, '1W', 1, 1),
(3279, 'Karmic Reversal', 'SDV1', 10, '1W', 1, 1),
(3412, 'Whispers of an Angel', 'NDR', 20, '2W', 1, 2),
(3281, 'Odin''s Judgment', 'SDV1', 12, '1WW', 1, 3),
(3376, 'Lich', 'SDV5', 9, '1BB', 1, 3),
(3377, 'Lich, the Saint of Death', 'SDV5', 9, '1BB', 1, 3),
(3301, 'Fu Xi', 'SDV2', 9, '3RR', 1, 3),
(3302, 'Fu Xi, King of Kunlun', 'SDV2', 9, '3RR', 1, 3);

DROP TABLE IF EXISTS `card_attributes`;
CREATE TABLE IF NOT EXISTS `card_attributes` (
  `Card` int(11) NOT NULL,
  `Attribute` int(11) NOT NULL,
  PRIMARY KEY (`Card`,`Attribute`),
  KEY `Attribute` (`Attribute`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `card_attributes` (`Card`, `Attribute`) VALUES
(3393, 1),
(3394, 1);

DROP TABLE IF EXISTS `card_quantities`;
CREATE TABLE IF NOT EXISTS `card_quantities` (
  `Decklist` int(11) NOT NULL,
  `Card` int(11) NOT NULL,
  `Decktype` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  PRIMARY KEY (`Decklist`,`Card`,`Decktype`),
  KEY `Card` (`Card`),
  KEY `Decktype` (`Decktype`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `card_quantities` (`Decklist`, `Card`, `Decktype`, `Quantity`) VALUES
(12, 3276, 1, 1),
(12, 3274, 0, 1),
(12, 3273, 0, 1),
(11, 3276, 1, 1),
(11, 3274, 0, 1),
(11, 3273, 0, 1);

DROP TABLE IF EXISTS `card_rarity`;
CREATE TABLE IF NOT EXISTS `card_rarity` (
  `Card` int(11) NOT NULL,
  `Rarity` int(11) NOT NULL,
  PRIMARY KEY (`Card`,`Rarity`),
  KEY `Rarity` (`Rarity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `card_rarity` (`Card`, `Rarity`) VALUES
(3393, 1),
(3394, 3);

DROP TABLE IF EXISTS `card_sets`;
CREATE TABLE IF NOT EXISTS `card_sets` (
  `Code` varchar(10) COLLATE utf8_bin NOT NULL,
  `Name` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `NumCards` int(11) NOT NULL DEFAULT '110',
  `Year` int(11) NOT NULL DEFAULT '2018',
  PRIMARY KEY (`Code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `card_sets` (`Code`, `Name`, `NumCards`, `Year`) VALUES
('SDR1', 'Starter Deck Reiya - Light', 11, 2017),
('SDR2', 'Starter Deck Reiya - Fire', 11, 2017),
('SDR3', 'Starter Deck Reiya - Water', 11, 2017),
('SDR4', 'Starter Deck Reiya - Wind', 11, 2017),
('SDR5', 'Starter Deck Reiya - Darkness', 11, 2017),
('SDV1', 'Starter Deck New Valhalla - Light', 23, 2018),
('SDV2', 'Starter Deck New Valhalla - Fire', 23, 2018),
('SDV3', 'Starter Deck New Valhalla - Water', 23, 2018),
('SDV4', 'Starter Deck New Valhalla - Wind', 23, 2018),
('SDV5', 'Starter Deck New Valhalla - Darkness', 23, 2018),
('NDR', 'New Dawn Rises', 126, 2018);

DROP TABLE IF EXISTS `card_types`;
CREATE TABLE IF NOT EXISTS `card_types` (
  `Card` int(11) NOT NULL,
  `Type` int(11) NOT NULL,
  PRIMARY KEY (`Card`,`Type`),
  KEY `Type` (`Type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `card_types` (`Card`, `Type`) VALUES
(3269, 6),
(3273, 6),
(3301, 6),
(3304, 6),
(3319, 6),
(3329, 6),
(3343, 6),
(3351, 6),
(3376, 6),
(3379, 6),
(3393, 5),
(3394, 5),
(3449, 1);

DROP TABLE IF EXISTS `composta`;
CREATE TABLE IF NOT EXISTS `composta` (
  `Card` int(11) NOT NULL,
  `Decklist` int(11) NOT NULL,
  `Deck` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  PRIMARY KEY (`Card`,`Decklist`,`Deck`),
  KEY `Decklist` (`Decklist`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

DROP TABLE IF EXISTS `decklists`;
CREATE TABLE IF NOT EXISTS `decklists` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(80) COLLATE utf8_bin NOT NULL,
  `Ruler` int(11) DEFAULT NULL,
  `Player` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '"Not set"',
  `Event` int(11) DEFAULT NULL,
  `Type` int(11) DEFAULT NULL,
  `Visibility` int(1) NOT NULL DEFAULT '0',
  `GachaCode` varchar(30) COLLATE utf8_bin DEFAULT '0',
  `Position` int(11) DEFAULT '0',
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Id` (`Id`),
  UNIQUE KEY `Name` (`Name`),
  KEY `Ruler` (`Ruler`),
  KEY `Event` (`Event`),
  KEY `decklists_style` (`Type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=21 ;

INSERT INTO `decklists` (`Id`, `Name`, `Ruler`, `Player`, `Event`, `Type`, `Visibility`, `GachaCode`, `Position`) VALUES
(5, 'Hanzo Machines Mono Blue by Javier Herreras', 3351, 'Javier Herreras', 1, 1, 1, '14971324', 1),
(6, 'Hanzo Machines Green Splash by Jordan Tan Xuan You', 3351, 'Jordan Tan Xuan You', 1, 1, 1, '50970387', 2),
(7, 'Lucifer Control By Federico Zoppini', 3379, 'Federico Zoppini', 1, 2, 1, '27986330', 4),
(8, 'Lucifer Control By Charlie DeMeull', 3379, 'Charlie DeMeulle', 1, 2, 1, '70977462', 5),
(9, 'Lucifer Control By Kevin Carrara', 3379, 'Kevin Carrara', 1, 2, 1, '70986333', 6),
(10, 'Lucifer Control By Philip Chybiorz', 3379, 'Philip Chybiorz', 1, 2, 1, '17980335', 8),
(11, 'Brunhild Resurrect Control by Naoyuki Yada', 3273, 'Naoyuki Yada', 1, 3, 1, '14971368', 3),
(12, 'Brunhild Resurrection Control by Souichi Itou', 3273, 'Souichi Itou', 1, 3, 1, '25988324', 7),
(13, 'Hanzo Machines Green Splash by Kevin Carrara', 3379, 'Kevin Carrara', 4, 1, 1, '0', 1),
(14, 'Hanzo Machines Green Splash by Isaac Rancic', 3351, 'Isaac Rancic', 4, 1, 1, '0', 2),
(15, 'Hanzo Machines Mono Blue by Tomas Colletti', 3351, 'Tomas Colletti', 4, 1, 1, '0', 3),
(16, 'Hanzo Machines Mono Blue by Lorenzo Brambilla Pisoni', 3351, 'Lorenzo Brambilla Pisoni', 4, 1, 1, '0', 4),
(17, 'Lucifer Control By Stefano Barbieri', 3379, 'Stefano Barbieri', 4, 2, 1, '0', 5),
(18, 'Atom Angels Midrange by Simone Ledda', 3269, 'Simone Ledda', 4, 4, 1, '0', 6),
(19, 'Hanzo Machines Mono Blue by Alessandro Muscela', 3351, 'Alessandro Muscela', 4, 1, 1, '0', 7),
(20, 'Loki Machines Mono Blue by Davide Quattrone', 3329, 'Davide Quattrone', 4, 5, 1, '0', 8);

DROP TABLE IF EXISTS `decktypes`;
CREATE TABLE IF NOT EXISTS `decktypes` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `Style` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Style` (`Style`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

INSERT INTO `decktypes` (`Id`, `Name`, `Style`) VALUES
(1, 'Hanzo Machines', 2),
(2, 'Lucifer Control', 3),
(3, 'Brunild Control', 3),
(4, 'Atom Midrange', 2),
(5, 'Loki Aggro', 1);

DROP TABLE IF EXISTS `deck_types`;
CREATE TABLE IF NOT EXISTS `deck_types` (
  `Id` int(11) NOT NULL,
  `Name` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

DROP TABLE IF EXISTS `EasyTGBot`;
CREATE TABLE IF NOT EXISTS `EasyTGBot` (
  `chat_id` bigint(11) NOT NULL,
  `first_name` tinytext,
  `last_name` tinytext,
  `username` tinytext,
  `action` tinytext NOT NULL,
  `title` tinytext,
  `type` tinytext,
  `to_update` tinytext
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `EasyTGBot` (`chat_id`, `first_name`, `last_name`, `username`, `action`, `title`, `type`, `to_update`) VALUES
(138856314, 'Daniele', 'Tentoni', 'AntonioParolisi', 'post.text_b', NULL, 'private', ''),
(-377391891, NULL, NULL, NULL, 'none', 'Prova del gruppo con fowdeckhub', 'group', '1');

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(70) COLLATE utf8_bin DEFAULT NULL,
  `Format` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `Nation` int(11) DEFAULT NULL,
  `Year` int(11) DEFAULT NULL,
  `Attendance` int(11) DEFAULT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CommunityReports` varchar(5000) COLLATE utf8_bin NOT NULL DEFAULT 'No community reports. Contact the admin if you have one!',
  `OtherLinks` varchar(5000) COLLATE utf8_bin NOT NULL DEFAULT 'No other links. Contact the admin if you have one!',
  `Visibility` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Id` (`Id`),
  UNIQUE KEY `Name` (`Name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

INSERT INTO `events` (`Id`, `Name`, `Location`, `Nation`, `Year`, `Attendance`, `Date`, `CommunityReports`, `OtherLinks`, `Visibility`) VALUES
(1, 'WGP - World Gran Prix Tokyo Japan', 1, 1, 2018, 121, '2018-09-21 22:00:00', 'No community reports. Contact the admin if you have one!', 'Here there\\\\\\''s a report made by the Italian Force of Will Official Site https://www.fowtcg.it/articoli/922/World-Grand-Prix-2018.', 1),
(4, 'Win a Box - Magic Akiba', NULL, 3, 2018, 37, '2018-10-20 22:00:00', 'No community reports. Contact the admin if you have one!', 'Here there is a report from the official italian site! Don\\\\\\''t miss that: https://www.fowtcg.it/articoli/934/Italian8-14-21-Ottobre-2018', 1);

DROP TABLE IF EXISTS `event_rulers_breakdown`;
CREATE TABLE IF NOT EXISTS `event_rulers_breakdown` (
  `Event` int(11) NOT NULL,
  `Ruler` int(11) NOT NULL,
  `Quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`Event`,`Ruler`),
  KEY `Ruler` (`Ruler`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `event_rulers_breakdown` (`Event`, `Ruler`, `Quantity`) VALUES
(1, 3269, 3),
(1, 3273, 9),
(1, 3304, 6),
(1, 3319, 23),
(1, 3329, 24),
(1, 3379, 22),
(1, 3351, 33),
(4, 3269, 4),
(4, 3273, 4),
(4, 3304, 3),
(4, 3319, 1),
(4, 3329, 2),
(4, 3343, 1),
(4, 3351, 14),
(4, 3379, 8);

DROP TABLE IF EXISTS `formats`;
CREATE TABLE IF NOT EXISTS `formats` (
  `Code` varchar(10) COLLATE utf8_bin NOT NULL,
  `Name` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `Tournament` int(1) DEFAULT '0',
  `Visibility` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Code`),
  UNIQUE KEY `Name` (`Name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `formats` (`Code`, `Name`, `Tournament`, `Visibility`) VALUES
('NV1', 'New Valhalla Block NV0 - NV1', 1, 1),
('NV2', 'New Valhalla Block NV0 - NV2', 1, 1),
('R/NV1', 'New Frontier - Reiya / New Valhalla R0 - NV1', 1, 1),
('R/NV2', 'New Frontier - Reiya / New Valhalla R0 - NV2', 1, 1);

DROP TABLE IF EXISTS `format_params`;
CREATE TABLE IF NOT EXISTS `format_params` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Code` varchar(30) COLLATE utf8_bin NOT NULL,
  `Value` varchar(30) COLLATE utf8_bin NOT NULL,
  `Des` varchar(100) COLLATE utf8_bin NOT NULL,
  `DesVal` varchar(100) COLLATE utf8_bin NOT NULL,
  `Card` int(11) DEFAULT NULL,
  `Format` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Code` (`Code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE IF NOT EXISTS `login_attempts` (
    `Id` int(21) AUTO_INCREMENT NOT NULL,
  `UserId` int(11) DEFAULT NULL,
  `DataAccesso` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Risultato` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT = 0;

DROP TABLE IF EXISTS `nations`;
CREATE TABLE IF NOT EXISTS `nations` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `WorldMapSign` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `WorldMapSign` (`WorldMapSign`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

INSERT INTO `nations` (`Id`, `Name`, `WorldMapSign`) VALUES
(1, 'Japan', 'JP'),
(2, 'Usa', 'US'),
(3, 'Italy', 'IT'),
(3, 'France', 'FR'),
(3, 'Germany', 'DE'),
(3, 'United Kingdom', 'UK'),
(3, 'Spain', 'ES');

DROP TABLE IF EXISTS `playstyles`;
CREATE TABLE IF NOT EXISTS `playstyles` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

INSERT INTO `playstyles` (`Id`, `Name`) VALUES
(1, 'Aggro'),
(2, 'Midrange'),
(3, 'Control'),
(4, 'Combo'),
(5, 'Other');

DROP TABLE IF EXISTS `rarity`;
CREATE TABLE IF NOT EXISTS `rarity` (
  `Id` int(11) NOT NULL,
  `Name` varchar(30) COLLATE utf8_bin NOT NULL,
  `Symbol` varchar(10) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `rarity` (`Id`, `Name`, `Symbol`) VALUES
(1, 'Common', 'C'),
(2, 'Uncommon', 'U'),
(3, 'Rare', 'R'),
(4, 'Superare', 'SR');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=11 ;

INSERT INTO `roles` (`Id`, `Name`, `UserPower`, `CardPower`, `DecklistPower`, `EventsPower`, `CanEditEvents`) VALUES
(1, 'Superuser', 1, 1, 1, 1, 1),
(2, 'Administrator', 0, 1, 1, 1, 0),
(10, 'User', 0, 0, 0, 0, 0);

DROP TABLE IF EXISTS `security_requests`;
CREATE TABLE IF NOT EXISTS `security_requests` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` int(11) DEFAULT NULL,
  `RequestDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ExitCode` int(111) NOT NULL,
  `PageRequired` varchar(100) DEFAULT NULL,
  `Note` varchar(5000) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `UserId` (`UserId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `sets_legality`;
CREATE TABLE IF NOT EXISTS `sets_legality` (
  `CardSet` varchar(10) COLLATE utf8_bin NOT NULL,
  `Format` varchar(10) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`CardSet`,`Format`),
  KEY `sets_legality_formats_fk` (`Format`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

DROP TABLE IF EXISTS `site_params`;
CREATE TABLE IF NOT EXISTS `site_params` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Codice` varchar(30) COLLATE utf8_bin NOT NULL,
  `Valore` varchar(30) COLLATE utf8_bin NOT NULL,
  `DesVal` varchar(100) COLLATE utf8_bin NOT NULL,
  `Note` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `types`;
CREATE TABLE IF NOT EXISTS `types` (
  `Id` int(11) NOT NULL,
  `Name` varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Name` (`Name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `types` (`Id`, `Name`) VALUES
(0, 'J-Ruler'),
(1, 'Addiction'),
(2, 'Chant'),
(3, 'Regalia'),
(4, 'Magic Stone'),
(5, 'Resonator'),
(6, 'Ruler');

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) COLLATE utf8_bin NOT NULL,
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` char(128) COLLATE utf8_bin NOT NULL,
  `salt` char(128) COLLATE utf8_bin NOT NULL,
  `registerdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` int(11) NOT NULL DEFAULT '10',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=10 ;

INSERT INTO `users` (`id`, `username`, `email`, `password`, `salt`, `registerdate`, `role`) VALUES
(1, 'AntonioParolisi', 'test@gmail.com', '00807432eae173f652f2064bdca1b61b290b52d40e429a7d295d76a71084aa96c0233b82f1feac45529e0726559645acaed6f3ae58a286b9f075916ebf66cacc', 'f9aab579fc1b41ed0c44fe4ecdbfcdb4cb99b9023abb241a6db833288f4eea3c02f76e0d35204a8695077dcf81932aa59006423976224be0390395bae152d4ef', '2018-09-18 22:00:00', 3),
(2, 'testAccount', 'daniele.tentoni.1996@gmail.com', 'd78ff18851707a36a94adc43be550f4c0ea82a9ede3c359f07b29b3041ddd268e1239bd48348ad66efd129f0266932149e6981d4ca4786df21b159ea060af1c3', '48acc7a4a82c1248d0c60470eea07ce47f3e826d68bf8070f26ff76e7df6067bb1b8ad97bbfc4040805913048fc9dc2304322d52d79e8740f3321526a21ae229', '0000-00-00 00:00:00', 2),
(3, 'adminAccount', 'a@a.com', 'fffd14cbbb979f806e65f41f6eef6ad3d13c13d62a9b76b8fdb45c938bda250533198de209c0419a03009f916b3b246a493c4304e8338758b320f8b8a8ed4b9d', '8c2779e246843f6951e01672a57c062e88d8e6cf423c7163a62f57071a13bd04104e44099b3f52ae1f0e32c000d683663ec1fdfd85e0413ce78b1710ba627c71', '0000-00-00 00:00:00', 1),
(4, 'test001', 'o2734064@nwytg.net', '57e1fb012f04db9b51ba413f17c9fd79dcd449fd70b72cfdbc9196e6648940bb7c7a4d8e90170814d87e7df89dd943898737f2714499efef422e73a81c8019e8', 'ec4eda7aa9d988bc8d0302d8ea01b5ec0fafb118c837ced636d8beda5d0f3205aa2faa32e18a9d690a87a452b2d14c90b00c3c457536ec3aa284df9f34286bea', '2018-12-10 13:25:48', 10),
(5, 'test002', 'o2735232@nwytg.net', '55110920da3259765fb4cba9b1c7e37c60a5f48539b4d896a757f71c56ee4eddc81182d885df53f7f868e64b3dee83726d781c4b90cab5389832aa06262d7f30', 'f95baeeefaf546e9b36c86ef68722546423d157c078dabdf3c611d2d6338acb9b50551dad2587972995c8a7bdff6279c9a04ac5ea3f089bab65f8b3cae7e8e7c', '2018-12-10 13:41:35', 10),
(6, 'test003', 'greenly.marni@cowaway.com', '8d1b35504641b585e983856b7450c8ac3060b5ec4523a13bcb4ca81dcaa056d4e60e3e107385ef6cef1bb4a2db8176e10d954c7eae81b9565c4e4d9af1ff94f2', '5b97f5dfc7de398464921ce94c99ea4b54fa2524937ad650e89b2c88edfc67b463bda4602ca29032d72283db4080187a8e64b70dffd8b1b2ec25f5f0f2dea902', '2018-12-10 13:47:59', 10),
(7, 'test004', 'phelan.najm@cowaway.com', '769594151d9e3d554ec21eca1cab5e491f5e3c66cd9918301e5edfe54d0129b50c3202ed41c3164e3c1a9cbddd60b2e1f9db46e8d7eea3fbdbb2e614975d37af', 'dc4cfd90d9b8492c073d6978424c1301b81e59580c713ad9b6d5346e1f968911f20eeaa70c615176d96dca5bdbc72b8b2e7e9c17e58f2912a432c5726b608e3f', '2018-12-10 13:50:01', 10),
(8, 'test005', 'o2745534@nwytg.net', 'a4dc9bee8a00a7be0fd487433d079b62767c936484338ceccd3bc40d347fda7bc15afb585bae6717cebb71c157c94be654a06e9f8b15112d4104b8ab2cea394f', 'e2b3bcd061ad6e4de42975c52f29a3992e3efa397ef50136126cecec8a220f9aa2a189caa2832b03854a3a223d51f48f5bf205327f88b5702a576514d86c16ba', '2018-12-10 15:04:21', 10),
(9, 'prodAdmin', 'd.tentoni@wedoit.io', 'e9e42af60672de9b1afd2c9659fda853b01d5876175e25ade0f07519d60681f40317eb71845047414c9c869d1bf9cbc4395c505d46da904a7daa8c42817020c5', '983c7a297002045d822bb347e00ef73af1f7f73c2fcc81a1d7f6fdb49bc4e1c5593e94e3474b39a7f02064758cdcb715df0f7eb399bb010320cf3af35d3bfaba', '2018-12-10 15:33:43', 1);
