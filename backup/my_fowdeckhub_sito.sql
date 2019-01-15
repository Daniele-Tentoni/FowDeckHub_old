-- phpMyAdmin SQL Dump
-- version 4.1.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Gen 07, 2019 alle 23:06
-- Versione del server: 5.6.33-log
-- PHP Version: 5.3.10

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
  `Name` varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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

CREATE TABLE IF NOT EXISTS `bug_reports` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) COLLATE utf8_bin NOT NULL,
  `Email` varchar(100) COLLATE utf8_bin NOT NULL,
  `Bug` varchar(5000) COLLATE utf8_bin NOT NULL,
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
(1, 'Daniele Tentoni', 'd.tentoni@wedoit.io', 'Questo bug deve essere New', 1, '2018-12-04 17:20:22', '2018-12-10 20:30:36'),
(2, 'Daniele Tentoni', 'd.tentoni@wedoit.io', 'Questo bug deve essere Open', 2, '2018-12-04 17:20:22', '2018-12-10 20:30:40'),
(3, 'Daniele Tentoni', 'd.tentoni@wedoit.io', 'Questo bug deve essere Assigned', 3, '2018-12-04 17:20:22', '2018-12-10 20:30:40'),
(4, 'Daniele Tentoni', 'd.tentoni@wedoit.io', 'Questo bug deve essere Resolved', 4, '2018-12-04 17:20:22', '2018-12-10 12:56:59');

-- --------------------------------------------------------

--
-- Struttura della tabella `bug_report_states`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3503 ;

--
-- Dump dei dati per la tabella `cards`
--

INSERT INTO `cards` (`Id`, `Name`, `Set`, `Number`, `Cost`, `Visibility`, `Rarity`) VALUES
(3269, 'Atom Seikhart', 'SDV1', 2, '1WW', 1, 3),
(3273, 'Brunhild', 'SDV1', 5, '2WW', 1, 3),
(3304, 'Isis', 'SDV2', 11, '2RR', 1, 3),
(3319, 'Arthur', 'SDV3', 2, 'UUU', 1, 3),
(3325, 'Donut Drone', 'SDV3', 7, 'U', 1, 1),
(3326, 'Gawain, the Swift Knight', 'SDV3', 4, 'UU', 1, 2),
(3329, 'Loki', 'SDV3', 11, '1UU', 1, 3),
(3333, 'Mechanical Bishop', 'SDV3', 14, '1U', 1, 1),
(3334, 'Mechanical Soldier', 'SDV3', 15, 'U', 1, 1),
(3343, 'Chamimi', 'SDV4', 1, '3GG', 1, 3),
(3351, 'Hanzo', 'SDV3', 8, '1GG', 1, 3),
(3379, 'Lucifer', 'SDV5', 11, '3BB', 1, 3),
(3393, 'Aratron, Angel of Knowledge', 'NDR', 1, 'W', 1, 2),
(3394, 'Ayu, the Mysterious Wanderer', 'NDR', 2, 'WW', 1, 3),
(3433, 'Arondight, the Nitrogen Blade', 'NDR', 41, 'U', 1, 3),
(3439, 'Jormungandr, Little Eater of Worlds', 'NDR', 47, 'U', 1, 4),
(3443, 'Mechanized Knight', 'NDR', 51, 'U', 1, 1),
(3444, 'Merlin, the Control Unit of Sky Round', 'NDR', 52, '2BB', 1, 3),
(3448, 'Sky Round Technician', 'SDV3', 56, '1B', 1, 1),
(3449, 'The Knights'' Castle in the Sky, Sky Round', 'NDR', 70, '1U', 1, 2),
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
(3302, 'Fu Xi, King of Kunlun', 'SDV2', 9, '3RR', 1, 3),
(3352, 'Hanzo, Chief of the Kouga', 'SDV4', 9, '2GG', 1, 3),
(3426, 'Sandstorm', 'NDR', 34, 'R', 1, 2),
(3303, 'Giant Sandstorm', 'SDV2', 10, 'RRRR', 1, 2),
(3450, 'Thick Fog', 'NDR', 58, '2U', 1, 1),
(3451, 'Torrent of Energy', 'NDR', 59, '2U', 1, NULL),
(3446, 'Scrap and Build', 'NDR', 54, '2U', 1, 2),
(3447, 'Sky Round Guardian', 'NDR', 55, '3U', 1, 1),
(3437, 'Invitation', 'NDR', 45, '1UU', 1, 2),
(3438, 'Iron Cauldron Witch', 'NDR', 46, '4UU', 1, 1),
(3360, 'Sealing Scroll', 'SDV4', 16, '0', 1, 3),
(3361, 'Shadow Step', 'SDV4', 17, '1G', 1, 1),
(3452, 'Viviane, the Mechanical Fairy', 'NDF', 60, 'U', 1, 2),
(3453, 'Atlantis, the Wielder of Knowledge', 'NDR', 61, '1GG', 1, 3),
(3440, 'Lancelot, the Glass Knight', 'NDR', 48, '2U', 1, 4),
(3441, 'Mad Hatter of Misty Woods', 'NDR', 49, '3UU', 1, 2),
(3337, 'Perceval, the Shining Knight', 'SDV3', 18, '2UU', 1, 4),
(3338, 'Petrification', 'SDV3', 19, 'UU', 1, 1),
(3493, 'Magic Stone of Adventure', 'NDR', 101, '0', 1, 2),
(3494, 'Magic Stone of Chaos', 'NDR', 102, '0', 1, 3),
(3495, 'Magic Stone of Corruption', 'NDR', 103, '0', 1, 2),
(3496, 'Magic Stone of Dramaturgy', 'NDR', 104, '0', 1, 2),
(3497, 'Magic Stone of Dueling', 'NDR', 105, '0', 1, 3),
(3499, 'Magic Stone of Omniscience', 'NDR', 107, '0', 1, 2),
(3501, 'Magic Stone of the Undead', 'NDR', 109, '0', 1, 3),
(3502, 'Magic Stone of Tranquility', 'NDR', 110, '0', 1, 3),
(3500, 'Magic Stone of the Hermit', 'NDR', 108, '0', 1, 2),
(3292, 'Light Magic Stone', 'SDV1', 23, '', 1, 1),
(3317, 'Fire Magic Stone', 'SDV2', 23, '', 1, 1),
(3342, 'Water Magic Stone', 'SDV3', 23, '', 1, 1),
(3367, 'Wind Magic Stone', 'SDV4', 23, '', 1, 1),
(3392, 'Darkness Magic Stone', 'SDV5', 23, '0', 1, 1),
(3388, 'Tears of the Fallen', 'SDV5', 19, '0', 1, 1),
(3375, 'Jet-Black Wings', 'SDV5', 8, '1BB', 1, 2),
(3371, 'Demon Division', 'SDV5', 4, 'BB', 1, 1),
(3358, 'Rapid Fire Mi-!!', 'SDV4', 14, 'G', 1, 1),
(3349, 'Fuhma Shuriken', 'SDV4', 6, 'G', 1, 1),
(3348, 'Forest Meditation', 'SDV4', 5, '1G', 1, 1),
(3336, 'Overflowing Knowledge', 'SDV3', 17, 'UU', 1, 1),
(3332, 'Maintenance', 'SDV3', 13, '0', 1, 1),
(3295, 'Dragon Dance', 'SDV2', 3, 'R', 1, 1),
(3382, 'Putrefy', 'SDV5', 13, 'B', 1, 1),
(3467, 'Song of the Fairies', 'NDR', 75, '1GG', 1, 1),
(3468, 'Squall of the Tengu', 'NDR', 76, '1GG', 1, 3),
(3331, 'Loki''s Watchdog, Fenrir', 'SDV3', 12, '2UU', 1, 4),
(3460, 'Jubei, the One-Eyed Swordsmaster', 'NDR', 68, '3GG', 1, 3),
(3461, 'Karura, the Crow Tengu', 'NDR', 69, '3GG', 1, 4),
(3380, 'Lucifer, the Fallen Angel of Sorrow', 'SDV5', 11, '3BB', 1, 3),
(3369, 'Black Rosario', 'SDV5', 2, 'BB', 1, 3),
(3478, 'Corpse Sorcerer', 'NDR', 86, '1BB', 1, 2),
(3480, 'Diseased Rat', 'NDR', 88, '1B', 1, 1),
(3487, 'Minister of Grief', 'NDR', 95, '2BB', 1, 2),
(3270, 'Atom Seikhart, the Shimmering Rabbit', 'SDV1', 2, '1WW', 1, 3),
(3280, 'Mini Meteor', 'SDV1', 11, '1WW', 1, 2),
(3268, 'Acolyte of the Sun', 'SDV1', 1, 'W', 1, 1),
(3272, 'Bewilder', 'SDV1', 4, 'W', 1, 1),
(3277, 'Einherjar''s Summons', 'SDV1', 8, '0', 1, 2),
(3282, 'Phaleg, the Angel of War', 'SDV1', 13, 'WWW', 1, 2),
(3283, 'Phul, the Administrator of the Moon', 'SDV1', 14, '2WW', 1, 4),
(3284, 'Ring of Legend', 'SDV1', 15, 'W', 1, 1),
(3285, 'Sigrun, Valkyrie of Victory', 'SDV1', 16, '2WW', 1, 4),
(3286, 'Sorceress of the Moon', 'SDV1', 17, 'W', 1, 1),
(3287, 'The Valkyrie''s Chosen', 'SDV1', 18, '1W', 1, 1),
(3288, 'Turn Tail', 'SDV1', 19, 'W', 1, 1),
(3289, 'Warrior of the Sun', 'SDV1', 20, 'W', 1, 1),
(3290, 'Wererabbit Warrior', 'SDV1', 21, 'W', 1, 1),
(3291, 'Zeus'' Grand Lightning', 'SDV1', 22, 'WW', 1, 3),
(3395, 'Balmung', 'NDR', 3, '2WW', 1, 3),
(3403, 'Moonlit Paradise, Lunar Heaven', 'NDR', 11, '1W', 1, 2),
(3406, 'Ophiel, Angel of Guidance', 'NDR', 14, '3WW', 1, 4),
(3407, 'Protection of the Angels', 'NDR', 15, '1W', 1, 3),
(3408, 'Siegfried, the Hundred Years Hero', 'NDR', 16, '1WW', 1, 4),
(3409, 'Skuld, Valkyrie of the Future', 'NDR', 17, 'WW', 1, 3),
(3427, 'Scalding Breath', 'NDR', 35, '1R', 1, 1),
(3498, 'Magic Stone of Faith', 'NDR', 106, '0', 1, 3),
(3330, 'Loki, the Witch of Chaos', 'SDV3', 11, '1UU', 1, 3),
(3324, 'Consume', 'SDV3', 6, '1UU', 1, 3),
(3335, 'Monstrosify', 'SDV3', 16, 'U', 1, 2),
(3391, 'Wanderer of the Abyss', 'SDV5', 22, 'B', 1, 1),
(3492, 'Whispers of the Devil', 'NDR', 100, '1B', 1, 2),
(3416, 'Burial Rites', 'NDR', 24, 'R', 1, 3),
(3383, 'Scythe of the Reaper', 'SDV5', 14, '1B', 1, 1),
(3486, 'Miasma of the Abyss', 'NDR', 94, '2BB', 1, 1),
(3372, ' Fanatic of Grief', 'SDV5', 5, 'B', 1, 1),
(3483, 'Gatherer of Despair', 'NDR', 91, '1B', 1, 1),
(3305, 'Isis, the Hundred Weapon Master', 'SDV2', 11, '3RR', 1, 3),
(3297, 'Dragon''s Flight', 'SDV2', 5, 'R', 1, 2),
(3298, 'Explosion', 'SDV2', 6, 'R', 1, 1),
(3316, 'Whirlwind Conflagration', 'SDV2', 22, '3RR', 1, 3),
(3423, 'Heaven Thundering Strike', 'NDR', 31, '1R', 1, 3),
(3306, 'Magician of Molding', 'SDV2', 12, '1R', 1, 2),
(3310, 'Sand Dragon', 'SDV2', 16, '1RR', 1, 2),
(3413, 'Anubis, Administrator of the Hounds', 'NDR', 21, '3RRRRR', 1, 4),
(3425, 'Osiris, Lord of the Afterlife', 'NDR', 33, '1RR', 1, 3),
(3429, 'Shen Gongbao, Taoist of Kunlun', 'NDR', 37, 'RR', 1, 4),
(3431, 'Venomous Scorpion', 'NDR', 39, 'R', 1, 1),
(3313, 'Set, the Commander of Destruction', 'SDV2', 19, 'RRRR', 1, 4),
(3434, 'Forest of the Lost, Misty Woods', 'NDR', 42, 'U', 1, 2),
(3436, 'Hamelin, the Sound of Temptation', 'NDR', 44, '2UUU', 1, 3),
(3471, 'The Village of the Spirited Away, Kouga', 'NDR', 79, 'G', 1, 2),
(3470, 'The Mimi Tribe''s Cook', 'NDR', 78, '2G', 1, 1),
(3442, 'Massive Growth', 'NDR', 50, 'U', 1, 3),
(3401, 'Haggith, Angel of Alchemy', 'NDR', 9, '2WW', 1, 1),
(3428, 'Scorching Winds', 'NDR', 36, 'R', 1, 1),
(3415, 'Black Spot Tiger', 'NDR', 23, 'R', 1, 3),
(3419, 'Chain Bind', 'NDR', 27, '2R', 1, 2),
(3307, 'Pang Tong', 'SDV2', 13, '1RR', 1, 2),
(3424, 'Land of Fiery Ambition, Kunlun', 'NDR', 32, 'RRR', 1, 2),
(3389, 'Undeath', 'SDV5', 20, 'B', 1, 1),
(3387, 'Sword of Lament', 'SDV5', 18, '1BB', 1, 1),
(3386, ' Specter Rush', 'SDV5', 17, 'BB', 1, 2),
(3378, ' Lower Fallen Angel', 'SDV5', 10, 'B', 1, 1),
(3373, ' Fleurety', 'SDV5', 6, 'BB', 1, 1),
(3370, ' Cycle of Death', 'SDV5', 3, 'BB', 1, 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `card_attributes`
--

CREATE TABLE IF NOT EXISTS `card_attributes` (
  `Card` int(11) NOT NULL,
  `Attribute` int(11) NOT NULL,
  PRIMARY KEY (`Card`,`Attribute`),
  KEY `Attribute` (`Attribute`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
  `Quantity` int(11) NOT NULL,
  PRIMARY KEY (`Decklist`,`Card`,`Decktype`),
  KEY `Card` (`Card`),
  KEY `Decktype` (`Decktype`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `card_quantities`
--

INSERT INTO `card_quantities` (`Decklist`, `Card`, `Decktype`, `Quantity`) VALUES
(12, 3276, 1, 1),
(12, 3274, 0, 1),
(12, 3273, 0, 1),
(11, 3273, 0, 1),
(11, 3274, 0, 1),
(11, 3276, 1, 1),
(5, 3342, 4, 2),
(5, 3496, 4, 4),
(5, 3494, 4, 4),
(5, 3449, 3, 1),
(5, 3446, 3, 3),
(5, 3433, 3, 1),
(5, 3337, 3, 4),
(5, 3444, 3, 2),
(5, 3439, 3, 4),
(5, 3449, 2, 3),
(5, 3433, 2, 3),
(5, 3326, 2, 4),
(5, 3444, 2, 2),
(5, 3440, 2, 4),
(5, 3333, 2, 4),
(5, 3448, 2, 4),
(5, 3325, 2, 4),
(5, 3452, 2, 4),
(5, 3443, 2, 4),
(5, 3334, 2, 4),
(5, 3360, 1, 1),
(5, 3437, 1, 1),
(5, 3446, 1, 1),
(5, 3450, 1, 1),
(5, 3426, 1, 1),
(5, 3352, 0, 1),
(5, 3351, 0, 1),
(6, 3331, 3, 2),
(6, 3439, 3, 2),
(6, 3449, 2, 4),
(6, 3467, 2, 2),
(6, 3451, 2, 4),
(6, 3433, 2, 3),
(6, 3337, 2, 2),
(6, 3444, 2, 4),
(6, 3326, 2, 3),
(6, 3440, 2, 4),
(6, 3448, 2, 2),
(6, 3452, 2, 4),
(6, 3325, 2, 4),
(6, 3443, 2, 4),
(6, 3360, 1, 1),
(6, 3467, 1, 1),
(6, 3348, 1, 1),
(6, 3446, 1, 1),
(6, 3450, 1, 1),
(6, 3352, 0, 1),
(6, 3351, 0, 1),
(6, 3460, 3, 2),
(6, 3433, 3, 1),
(6, 3468, 3, 3),
(6, 3467, 3, 1),
(6, 3342, 3, 4),
(6, 3494, 4, 4),
(6, 3496, 4, 4),
(6, 3502, 4, 1),
(6, 3367, 4, 2),
(13, 3437, 1, 1),
(13, 3433, 2, 3),
(13, 3467, 2, 2),
(13, 3436, 3, 3),
(13, 3434, 3, 2),
(13, 3449, 2, 4),
(13, 3443, 2, 4),
(13, 3326, 2, 2),
(13, 3349, 1, 1),
(13, 3444, 2, 4),
(13, 3325, 2, 4),
(13, 3360, 1, 1),
(13, 3467, 3, 1),
(13, 3446, 1, 1),
(13, 3448, 2, 2),
(13, 3351, 0, 1),
(13, 3460, 3, 3),
(13, 3452, 2, 4),
(13, 3467, 1, 1),
(13, 3440, 2, 4),
(13, 3451, 2, 4),
(13, 3471, 3, 3),
(14, 3325, 2, 4),
(14, 3467, 2, 2),
(14, 3449, 2, 4),
(14, 3440, 2, 4),
(14, 3446, 1, 1),
(14, 3326, 2, 2),
(14, 3452, 2, 4),
(14, 3451, 2, 4),
(14, 3448, 2, 2),
(14, 3444, 2, 4),
(14, 3443, 2, 4),
(14, 3433, 2, 3),
(14, 3360, 1, 1),
(14, 3349, 1, 1),
(14, 3467, 1, 1),
(14, 3437, 1, 1),
(14, 3467, 3, 1),
(14, 3460, 3, 3),
(14, 3439, 3, 2),
(14, 3352, 0, 1),
(14, 3351, 0, 1),
(14, 3337, 2, 3),
(15, 3326, 2, 4),
(15, 3325, 2, 4),
(15, 3444, 2, 2),
(15, 3360, 1, 1),
(15, 3446, 1, 1),
(15, 3449, 2, 2),
(15, 3452, 2, 4),
(15, 3448, 2, 4),
(15, 3443, 2, 4),
(15, 3440, 2, 4),
(15, 3433, 2, 4),
(15, 3426, 1, 1),
(15, 3450, 1, 1),
(15, 3437, 1, 1),
(15, 3449, 3, 2),
(15, 3444, 3, 2),
(15, 3439, 3, 4),
(15, 3334, 2, 4),
(15, 3351, 0, 1),
(15, 3352, 0, 1),
(15, 3333, 2, 4),
(16, 3325, 2, 4),
(16, 3467, 2, 2),
(16, 3449, 2, 4),
(16, 3440, 2, 4),
(16, 3446, 1, 1),
(16, 3452, 2, 4),
(16, 3326, 2, 2),
(16, 3451, 2, 4),
(16, 3448, 2, 2),
(16, 3444, 2, 4),
(16, 3443, 2, 4),
(16, 3433, 2, 3),
(16, 3349, 1, 1),
(16, 3360, 1, 1),
(16, 3467, 1, 1),
(16, 3437, 1, 1),
(16, 3460, 3, 3),
(16, 3467, 3, 1),
(16, 3439, 3, 3),
(16, 3352, 0, 1),
(16, 3351, 0, 1),
(16, 3337, 2, 3),
(17, 3375, 1, 1),
(17, 3481, 2, 2),
(17, 3388, 1, 1),
(17, 3480, 2, 3),
(17, 3474, 2, 4),
(17, 3488, 3, 1),
(17, 3478, 2, 3),
(17, 3479, 3, 1),
(17, 3487, 2, 4),
(17, 3475, 2, 4),
(17, 3492, 3, 3),
(17, 3484, 2, 4),
(17, 3384, 2, 2),
(17, 3490, 2, 4),
(17, 3371, 1, 1),
(17, 3369, 1, 1),
(17, 3381, 2, 3),
(17, 3489, 2, 4),
(17, 3426, 1, 1),
(17, 3379, 0, 1),
(17, 3380, 0, 1),
(17, 3485, 2, 4),
(18, 3409, 2, 4),
(18, 3410, 2, 4),
(18, 3427, 2, 4),
(18, 3271, 2, 4),
(18, 3403, 2, 2),
(18, 3395, 2, 2),
(18, 3291, 1, 1),
(18, 3276, 1, 1),
(18, 3282, 2, 4),
(18, 3270, 0, 1),
(18, 3406, 3, 1),
(18, 3269, 0, 1),
(18, 3407, 2, 3),
(18, 3279, 1, 1),
(18, 3401, 3, 1),
(18, 3408, 3, 1),
(18, 3408, 2, 2),
(18, 3489, 2, 2),
(18, 3393, 2, 4),
(18, 3284, 1, 1),
(18, 3406, 2, 2),
(18, 3395, 3, 1),
(18, 3268, 2, 4),
(19, 3440, 2, 4),
(19, 3348, 1, 1),
(19, 3352, 0, 1),
(19, 3334, 2, 4),
(19, 3444, 2, 2),
(19, 3325, 2, 4),
(19, 3437, 1, 1),
(19, 3333, 2, 4),
(19, 3349, 1, 1),
(19, 3426, 1, 1),
(19, 3351, 0, 1),
(19, 3433, 3, 1),
(19, 3452, 2, 4),
(19, 3360, 1, 1),
(19, 3446, 3, 1),
(19, 3442, 3, 1),
(19, 3433, 2, 3),
(19, 3326, 2, 4),
(19, 3448, 2, 4),
(19, 3449, 2, 3),
(19, 3443, 2, 4),
(20, 3446, 1, 1),
(20, 3437, 1, 1),
(20, 3440, 2, 4),
(20, 3335, 1, 1),
(20, 3450, 3, 2),
(20, 3433, 2, 2),
(20, 3332, 1, 1),
(20, 3439, 2, 4),
(20, 3444, 2, 2),
(20, 3326, 2, 4),
(20, 3448, 2, 4),
(20, 3331, 3, 1),
(20, 3337, 2, 1),
(20, 3334, 2, 4),
(20, 3443, 2, 4),
(20, 3433, 3, 1),
(20, 3324, 1, 1),
(20, 3331, 2, 1),
(20, 3325, 2, 3),
(20, 3449, 2, 4),
(20, 3452, 2, 4),
(20, 3330, 0, 1),
(20, 3329, 0, 1),
(7, 3380, 0, 1),
(7, 3485, 2, 4),
(7, 3488, 2, 1),
(7, 3489, 2, 4),
(7, 3375, 1, 1),
(7, 3391, 2, 1),
(7, 3385, 2, 4),
(7, 3474, 2, 4),
(7, 3481, 2, 4),
(7, 3492, 2, 1),
(7, 3390, 2, 2),
(7, 3384, 3, 2),
(7, 3381, 2, 1),
(7, 3388, 1, 1),
(7, 3371, 1, 1),
(7, 3390, 3, 2),
(7, 3488, 3, 3),
(7, 3484, 2, 4),
(7, 3384, 2, 2),
(7, 3379, 0, 1),
(7, 3369, 1, 1),
(7, 3426, 1, 1),
(7, 3475, 2, 4),
(7, 3487, 2, 4),
(7, 3416, 3, 2),
(7, 3492, 3, 3),
(7, 3479, 3, 2),
(7, 3317, 3, 1),
(7, 3501, 4, 4),
(7, 3495, 4, 4),
(7, 3392, 4, 2),
(8, 3382, 1, 1),
(8, 3388, 1, 1),
(8, 3379, 0, 1),
(8, 3380, 0, 1),
(8, 3383, 1, 1),
(8, 3375, 1, 1),
(8, 3369, 1, 1),
(8, 3385, 2, 4),
(8, 3480, 2, 3),
(8, 3381, 2, 3),
(8, 3488, 2, 2),
(8, 3481, 2, 4),
(8, 3478, 2, 4),
(8, 3474, 2, 4),
(8, 3384, 2, 3),
(8, 3475, 2, 2),
(8, 3485, 2, 4),
(8, 3489, 2, 3),
(8, 3484, 2, 4),
(8, 3488, 3, 1),
(8, 3384, 3, 1),
(8, 3390, 3, 4),
(8, 3475, 3, 1),
(8, 3492, 3, 4),
(8, 3490, 3, 4),
(8, 3495, 4, 4),
(8, 3501, 4, 4),
(8, 3392, 4, 2),
(9, 3484, 2, 4),
(9, 3492, 2, 2),
(9, 3374, 2, 3),
(9, 3485, 2, 4),
(9, 3368, 3, 4),
(9, 3480, 3, 1),
(9, 3390, 3, 3),
(9, 3474, 2, 4),
(9, 3480, 2, 3),
(9, 3388, 1, 1),
(9, 3489, 2, 4),
(9, 3391, 2, 1),
(9, 3369, 1, 1),
(9, 3481, 3, 1),
(9, 3381, 2, 4),
(9, 3475, 2, 4),
(9, 3488, 2, 1),
(9, 3383, 1, 1),
(9, 3380, 0, 1),
(9, 3379, 0, 1),
(9, 3371, 1, 1),
(9, 3385, 2, 4),
(9, 3375, 1, 1),
(9, 3384, 3, 2),
(9, 3481, 2, 1),
(9, 3384, 2, 2),
(9, 3486, 3, 2),
(9, 3479, 3, 2),
(9, 3501, 4, 2),
(9, 3495, 4, 4),
(9, 3392, 4, 4),
(10, 3379, 0, 1),
(10, 3369, 1, 1),
(10, 3474, 2, 4),
(10, 3371, 1, 1),
(10, 3375, 1, 1),
(10, 3426, 1, 1),
(10, 3388, 1, 1),
(10, 3390, 2, 2),
(10, 3385, 2, 4),
(10, 3475, 2, 4),
(10, 3484, 2, 4),
(10, 3488, 2, 1),
(10, 3380, 0, 1),
(10, 3384, 2, 3),
(10, 3372, 3, 3),
(10, 3489, 2, 4),
(10, 3381, 2, 4),
(10, 3485, 2, 4),
(10, 3481, 2, 4),
(10, 3479, 2, 2),
(10, 3483, 3, 4),
(10, 3374, 3, 3),
(10, 3492, 3, 3),
(10, 3479, 3, 2),
(10, 3495, 4, 4),
(10, 3501, 4, 4),
(10, 3392, 4, 2),
(21, 3413, 3, 1),
(21, 3416, 2, 2),
(21, 3429, 2, 4),
(21, 3306, 2, 4),
(21, 3426, 1, 1),
(21, 3305, 0, 1),
(21, 3427, 2, 4),
(21, 3303, 1, 1),
(21, 3313, 2, 4),
(21, 3316, 1, 1),
(21, 3423, 2, 4),
(21, 3413, 2, 3),
(21, 3426, 2, 3),
(21, 3304, 0, 1),
(21, 3419, 3, 1),
(21, 3425, 2, 4),
(21, 3310, 2, 4),
(21, 3431, 2, 4),
(21, 3298, 1, 1),
(21, 3307, 3, 4),
(21, 3415, 3, 4),
(13, 3337, 2, 4),
(13, 3352, 0, 1),
(13, 3470, 3, 3),
(13, 3502, 4, 3),
(13, 3496, 4, 4),
(13, 3494, 4, 3),
(20, 3337, 3, 1),
(20, 3342, 4, 2),
(20, 3494, 4, 4),
(20, 3496, 4, 4),
(19, 3439, 3, 3),
(19, 3449, 3, 1),
(19, 3444, 3, 1),
(19, 3467, 3, 1),
(19, 3337, 3, 2),
(19, 3342, 3, 3),
(19, 3450, 3, 1),
(19, 3496, 4, 4),
(19, 3502, 4, 3),
(19, 3494, 4, 3),
(18, 3280, 1, 1),
(18, 3428, 3, 2),
(18, 3394, 3, 3),
(18, 3489, 3, 1),
(18, 3278, 3, 2),
(18, 3285, 3, 3),
(18, 3499, 4, 4),
(18, 3498, 4, 1),
(18, 3292, 4, 5),
(17, 3481, 3, 1),
(17, 3368, 3, 3),
(17, 3374, 3, 3),
(17, 3390, 3, 2),
(17, 3391, 3, 1),
(17, 3501, 4, 4),
(17, 3495, 4, 4),
(17, 3392, 4, 2),
(16, 3471, 3, 3),
(16, 3470, 3, 4),
(16, 3326, 3, 1),
(16, 3496, 4, 4),
(16, 3502, 4, 3),
(16, 3342, 4, 4),
(15, 3446, 3, 2),
(15, 3337, 3, 4),
(15, 3496, 4, 4),
(15, 3494, 4, 4),
(15, 3342, 4, 2),
(14, 3470, 3, 4),
(14, 3471, 3, 3),
(14, 3326, 3, 1),
(14, 3337, 3, 1),
(14, 3496, 4, 4),
(14, 3502, 4, 3),
(14, 3342, 4, 3),
(21, 3416, 3, 1),
(21, 3297, 1, 1),
(21, 3424, 3, 4),
(21, 3497, 4, 4),
(21, 3500, 4, 4),
(21, 3317, 4, 2),
(22, 3495, 4, 3),
(22, 3501, 4, 4),
(22, 3487, 2, 1),
(22, 3485, 2, 4),
(22, 3390, 3, 2),
(22, 3278, 3, 3),
(22, 3487, 3, 1),
(22, 3489, 2, 4),
(22, 3484, 2, 4),
(22, 3475, 2, 4),
(22, 3410, 2, 4),
(22, 3281, 1, 1),
(22, 3279, 1, 1),
(22, 3426, 1, 1),
(22, 3498, 4, 3),
(22, 3385, 2, 4),
(22, 3384, 2, 4),
(22, 3381, 2, 3),
(22, 3474, 2, 4),
(22, 3276, 1, 1),
(22, 3368, 3, 4),
(22, 3481, 3, 4),
(22, 3271, 2, 4),
(22, 3273, 0, 1),
(22, 3412, 1, 1),
(22, 3274, 0, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `card_sets`
--

CREATE TABLE IF NOT EXISTS `card_sets` (
  `Code` varchar(10) COLLATE utf8_bin NOT NULL,
  `Name` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `NumCards` int(11) NOT NULL DEFAULT '110',
  `Year` int(11) NOT NULL DEFAULT '2018',
  PRIMARY KEY (`Code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `card_sets`
--

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
('NDR', 'New Dawn Rises', 126, 2018),
('SNV', 'Strangers of New Valhalla', 100, 2018);

-- --------------------------------------------------------

--
-- Struttura della tabella `card_types`
--

CREATE TABLE IF NOT EXISTS `card_types` (
  `Card` int(11) NOT NULL,
  `Type` int(11) NOT NULL,
  PRIMARY KEY (`Card`,`Type`),
  KEY `Type` (`Type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `card_types`
--

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

-- --------------------------------------------------------

--
-- Struttura della tabella `composta`
--

CREATE TABLE IF NOT EXISTS `composta` (
  `Card` int(11) NOT NULL,
  `Decklist` int(11) NOT NULL,
  `Deck` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  PRIMARY KEY (`Card`,`Decklist`,`Deck`),
  KEY `Decklist` (`Decklist`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `decklists`
--

CREATE TABLE IF NOT EXISTS `decklists` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(80) COLLATE utf8_bin NOT NULL,
  `Player` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '"Not set"',
  `Event` int(11) DEFAULT NULL,
  `Type` int(11) DEFAULT NULL,
  `Visibility` int(1) NOT NULL DEFAULT '0',
  `GachaCode` varchar(30) COLLATE utf8_bin DEFAULT '0',
  `Position` int(11) DEFAULT '0',
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Id` (`Id`),
  UNIQUE KEY `Name` (`Name`),
  KEY `Event` (`Event`),
  KEY `decklists_style` (`Type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=24 ;

--
-- Dump dei dati per la tabella `decklists`
--

INSERT INTO `decklists` (`Id`, `Name`, `Player`, `Event`, `Type`, `Visibility`, `GachaCode`, `Position`) VALUES
(5, 'Hanzo Machines Mono Blue by Javier Herreras', 'Javier Herreras', 1, 1, 1, '14971324', 1),
(6, 'Hanzo Machines Green Splash by Jordan Tan Xuan You', 'Jordan Tan Xuan You', 1, 1, 1, '50970387', 2),
(7, 'Lucifer Control By Federico Zoppini', 'Federico Zoppini', 1, 2, 1, '27986330', 4),
(8, 'Lucifer Control By Charlie DeMeull', 'Charlie DeMeulle', 1, 2, 1, '70977462', 5),
(9, 'Lucifer Control By Kevin Carrara', 'Kevin Carrara', 1, 2, 1, '70986333', 6),
(10, 'Lucifer Control By Philip Chybiorz', 'Philip Chybiorz', 1, 2, 1, '17980335', 8),
(11, 'Brunhild Resurrect Control by Naoyuki Yada', 'Naoyuki Yada', 1, 3, 1, '14971368', 3),
(12, 'Brunhild Resurrection Control by Souichi Itou', 'Souichi Itou', 1, 3, 1, '25988324', 7),
(13, 'Hanzo Machines Green Splash by Kevin Carrara', 'Kevin Carrara', 4, 1, 1, '51017832', 1),
(14, 'Hanzo Machines Green Splash by Isaac Rancic', 'Isaac Rancic', 4, 1, 1, '67087856', 2),
(15, 'Hanzo Machines Mono Blue by Tomas Colletti', 'Tomas Colletti', 4, 1, 1, '41087848', 3),
(16, 'Hanzo Machines Mono Blue by Lorenzo Brambilla Pisoni', 'Lorenzo Brambilla Pisoni', 4, 1, 1, '15095870', 4),
(17, 'Lucifer Control By Stefano Barbieri', 'Stefano Barbieri', 4, 2, 1, '16097875', 5),
(18, 'Atom Angels Midrange by Simone Ledda', 'Simone Ledda', 4, 4, 1, '87006971', 6),
(19, 'Hanzo Machines Mono Blue by Alessandro Muscela', 'Alessandro Muscela', 4, 1, 1, '64008979', 7),
(20, 'Loki Machines Mono Blue by Davide Quattrone', 'Davide Quattrone', 4, 5, 1, '84019900', 8),
(21, 'Isis Control Gaetano Pippa', 'Gaetano Pippa', 7, 6, 1, '20011954', 4),
(22, 'Brunhild Resurrect by Andrea Barin', 'Andrea Barin', 7, 3, 1, '66431316', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `decktypes`
--

CREATE TABLE IF NOT EXISTS `decktypes` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `Style` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Style` (`Style`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=7 ;

--
-- Dump dei dati per la tabella `decktypes`
--

INSERT INTO `decktypes` (`Id`, `Name`, `Style`) VALUES
(1, 'Hanzo Machines', 2),
(2, 'Lucifer Control', 3),
(3, 'Brunild Control', 3),
(4, 'Atom Midrange', 2),
(5, 'Loki Aggro', 1),
(6, 'Isis Control', 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `deck_types`
--

CREATE TABLE IF NOT EXISTS `deck_types` (
  `Id` int(11) NOT NULL,
  `Name` varchar(50) COLLATE utf8_bin NOT NULL,
  `Label` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `MinCards` int(11) NOT NULL DEFAULT '0' COMMENT 'Minimum cards number in the deck.',
  `MaxCards` int(11) NOT NULL DEFAULT '60' COMMENT 'Maximum cards number in the deck.',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `deck_types`
--

INSERT INTO `deck_types` (`Id`, `Name`, `Label`, `MinCards`, `MaxCards`) VALUES
(0, 'Ruler Deck', 'label-warning', 1, 3),
(1, 'Rune Deck', 'label-danger', 0, 5),
(2, 'Main Deck', 'label-info', 40, 60),
(4, 'Stone Deck', 'label-success', 10, 20),
(3, 'Side Deck', 'label-primary', 0, 15);

-- --------------------------------------------------------

--
-- Struttura della tabella `EasyTGBot`
--

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

--
-- Dump dei dati per la tabella `EasyTGBot`
--

INSERT INTO `EasyTGBot` (`chat_id`, `first_name`, `last_name`, `username`, `action`, `title`, `type`, `to_update`) VALUES
(138856314, 'Daniele', 'Tentoni', 'AntonioParolisi', 'none', NULL, 'private', '1');

-- --------------------------------------------------------

--
-- Struttura della tabella `easytgbot`
--

CREATE TABLE IF NOT EXISTS `easytgbot` (
  `chat_id` bigint(11) NOT NULL,
  `first_name` tinytext COLLATE utf8_bin,
  `last_name` tinytext COLLATE utf8_bin,
  `username` tinytext COLLATE utf8_bin,
  `action` tinytext COLLATE utf8_bin NOT NULL,
  `title` tinytext COLLATE utf8_bin,
  `type` tinytext COLLATE utf8_bin,
  `to_update` tinytext COLLATE utf8_bin
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `easytgbot`
--

INSERT INTO `easytgbot` (`chat_id`, `first_name`, `last_name`, `username`, `action`, `title`, `type`, `to_update`) VALUES
(138856314, 'Daniele', 'Tentoni', 'AntonioParolisi', 'post.text_b', NULL, 'private', ''),
(-377391891, NULL, NULL, NULL, 'none', 'Prova del gruppo con fowdeckhub', 'group', '1');

-- --------------------------------------------------------

--
-- Struttura della tabella `events`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=8 ;

--
-- Dump dei dati per la tabella `events`
--

INSERT INTO `events` (`Id`, `Name`, `Format`, `Nation`, `Year`, `Attendance`, `Date`, `CommunityReports`, `OtherLinks`, `Visibility`) VALUES
(1, 'WGP - World Gran Prix Tokyo Japan', 'NV1', 1, 2018, 121, '2018-09-21 20:00:00', 'No community reports. Contact the admin if you have one!', 'Here there\\\\\\''s a report made by the Italian Force of Will Official Site https://www.fowtcg.it/articoli/922/World-Grand-Prix-2018.', 1),
(4, 'Win a Box - Magic Akiba', 'NV1', 3, 2018, 37, '2018-10-20 20:00:00', 'No community reports. Contact the admin if you have one!', 'Here there is a report from the official italian site! Don\\\\\\''t miss that: https://www.fowtcg.it/articoli/934/Italian8-14-21-Ottobre-2018', 1),
(7, 'Super Master Qualifier Trento', 'NV1', 3, 2018, 34, '2018-12-29 23:00:00', 'Kitsune Gaming will release a report on their team facebook page. Stay tuned.', 'No other links. Contact the admin if you have one!', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `event_rulers_breakdown`
--

CREATE TABLE IF NOT EXISTS `event_rulers_breakdown` (
  `Event` int(11) NOT NULL,
  `Ruler` int(11) NOT NULL,
  `Quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`Event`,`Ruler`),
  KEY `Ruler` (`Ruler`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `event_rulers_breakdown`
--

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
(4, 3379, 8),
(0, 3269, 1),
(0, 3273, 6),
(0, 3301, 0),
(0, 3304, 6),
(0, 3319, 1),
(0, 3329, 1),
(0, 3343, 0),
(0, 3351, 12),
(0, 3376, 0),
(0, 3379, 7),
(7, 3269, 1),
(7, 3273, 6),
(7, 3301, 0),
(7, 3304, 6),
(7, 3319, 1),
(7, 3329, 1),
(7, 3343, 0),
(7, 3351, 12),
(7, 3376, 0),
(7, 3379, 7);

-- --------------------------------------------------------

--
-- Struttura della tabella `formats`
--

CREATE TABLE IF NOT EXISTS `formats` (
  `Code` varchar(10) COLLATE utf8_bin NOT NULL,
  `Name` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `Tournament` int(1) DEFAULT '0',
  `Visibility` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Code`),
  UNIQUE KEY `Name` (`Name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `formats`
--

INSERT INTO `formats` (`Code`, `Name`, `Tournament`, `Visibility`) VALUES
('NV1', 'New Valhalla Block NV0 - NV1', 1, 1),
('NV2', 'New Valhalla Block NV0 - NV2', 1, 1),
('R/NV1', 'New Frontier - Reiya / New Valhalla R0 - NV1', 1, 1),
('R/NV2', 'New Frontier - Reiya / New Valhalla R0 - NV2', 1, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `format_params`
--

CREATE TABLE IF NOT EXISTS `format_params` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Code` varchar(30) COLLATE utf8_bin NOT NULL,
  `Value` varchar(30) COLLATE utf8_bin NOT NULL,
  `Des` varchar(100) COLLATE utf8_bin NOT NULL,
  `DesVal` varchar(100) COLLATE utf8_bin NOT NULL,
  `Card` int(11) DEFAULT NULL,
  `Deck` int(11) DEFAULT NULL,
  `Format` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Code` (`Code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `Id` int(21) NOT NULL AUTO_INCREMENT,
  `UserId` int(11) DEFAULT NULL,
  `DataAccesso` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Risultato` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=13 ;

--
-- Dump dei dati per la tabella `login_attempts`
--

INSERT INTO `login_attempts` (`Id`, `UserId`, `DataAccesso`, `Risultato`) VALUES
(1, 9, '2018-12-26 12:35:36', 1),
(2, 9, '2018-12-30 16:28:59', 1),
(3, 9, '2019-01-01 15:36:41', 1),
(4, 9, '2019-01-02 13:54:42', 1),
(5, 9, '2019-01-02 22:28:34', 1),
(6, 9, '2019-01-03 10:03:37', 1),
(7, 9, '2019-01-03 17:06:43', 1),
(8, 9, '2019-01-05 19:47:41', 1),
(9, 9, '2019-01-05 21:46:24', 1),
(10, 9, '2019-01-06 15:49:11', 1),
(11, 9, '2019-01-06 17:24:01', 1),
(12, 9, '2019-01-07 08:15:16', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `nations`
--

CREATE TABLE IF NOT EXISTS `nations` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `WorldMapSign` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `WorldMapSign` (`WorldMapSign`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dump dei dati per la tabella `nations`
--

INSERT INTO `nations` (`Id`, `Name`, `WorldMapSign`) VALUES
(1, 'Japan', 'JP'),
(2, 'Usa', 'US'),
(3, 'Italy', 'IT'),
(4, 'France', 'FR'),
(5, 'Germany', 'DE'),
(6, 'United Kingdom', 'UK'),
(7, 'Spain', 'ES');

-- --------------------------------------------------------

--
-- Struttura della tabella `playstyles`
--

CREATE TABLE IF NOT EXISTS `playstyles` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

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
  `Symbol` varchar(10) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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

--
-- Dump dei dati per la tabella `roles`
--

INSERT INTO `roles` (`Id`, `Name`, `UserPower`, `CardPower`, `DecklistPower`, `EventsPower`, `CanEditEvents`) VALUES
(1, 'Superuser', 1, 1, 1, 1, 1),
(2, 'Administrator', 0, 1, 1, 1, 0),
(10, 'User', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `security_requests`
--

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

-- --------------------------------------------------------

--
-- Struttura della tabella `sets_legality`
--

CREATE TABLE IF NOT EXISTS `sets_legality` (
  `CardSet` varchar(10) COLLATE utf8_bin NOT NULL,
  `Format` varchar(10) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`CardSet`,`Format`),
  KEY `sets_legality_formats_fk` (`Format`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `site_params`
--

CREATE TABLE IF NOT EXISTS `site_params` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Codice` varchar(30) COLLATE utf8_bin NOT NULL,
  `Valore` varchar(30) COLLATE utf8_bin NOT NULL,
  `DesVal` varchar(100) COLLATE utf8_bin NOT NULL,
  `Note` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `types`
--

CREATE TABLE IF NOT EXISTS `types` (
  `Id` int(11) NOT NULL,
  `Name` varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Name` (`Name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `types`
--

INSERT INTO `types` (`Id`, `Name`) VALUES
(0, 'J-Ruler'),
(1, 'Addiction'),
(2, 'Chant'),
(3, 'Regalia'),
(4, 'Magic Stone'),
(5, 'Resonator'),
(6, 'Ruler'),
(7, 'Rune');

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

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

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `salt`, `registerdate`, `role`) VALUES
(1, 'AntonioParolisi', 'test@gmail.com', '00807432eae173f652f2064bdca1b61b290b52d40e429a7d295d76a71084aa96c0233b82f1feac45529e0726559645acaed6f3ae58a286b9f075916ebf66cacc', 'f9aab579fc1b41ed0c44fe4ecdbfcdb4cb99b9023abb241a6db833288f4eea3c02f76e0d35204a8695077dcf81932aa59006423976224be0390395bae152d4ef', '2018-09-18 20:00:00', 3),
(2, 'testAccount', 'daniele.tentoni.1996@gmail.com', 'd78ff18851707a36a94adc43be550f4c0ea82a9ede3c359f07b29b3041ddd268e1239bd48348ad66efd129f0266932149e6981d4ca4786df21b159ea060af1c3', '48acc7a4a82c1248d0c60470eea07ce47f3e826d68bf8070f26ff76e7df6067bb1b8ad97bbfc4040805913048fc9dc2304322d52d79e8740f3321526a21ae229', '0000-00-00 00:00:00', 2),
(3, 'adminAccount', 'a@a.com', 'fffd14cbbb979f806e65f41f6eef6ad3d13c13d62a9b76b8fdb45c938bda250533198de209c0419a03009f916b3b246a493c4304e8338758b320f8b8a8ed4b9d', '8c2779e246843f6951e01672a57c062e88d8e6cf423c7163a62f57071a13bd04104e44099b3f52ae1f0e32c000d683663ec1fdfd85e0413ce78b1710ba627c71', '0000-00-00 00:00:00', 1),
(4, 'test001', 'o2734064@nwytg.net', '57e1fb012f04db9b51ba413f17c9fd79dcd449fd70b72cfdbc9196e6648940bb7c7a4d8e90170814d87e7df89dd943898737f2714499efef422e73a81c8019e8', 'ec4eda7aa9d988bc8d0302d8ea01b5ec0fafb118c837ced636d8beda5d0f3205aa2faa32e18a9d690a87a452b2d14c90b00c3c457536ec3aa284df9f34286bea', '2018-12-10 12:25:48', 10),
(5, 'test002', 'o2735232@nwytg.net', '55110920da3259765fb4cba9b1c7e37c60a5f48539b4d896a757f71c56ee4eddc81182d885df53f7f868e64b3dee83726d781c4b90cab5389832aa06262d7f30', 'f95baeeefaf546e9b36c86ef68722546423d157c078dabdf3c611d2d6338acb9b50551dad2587972995c8a7bdff6279c9a04ac5ea3f089bab65f8b3cae7e8e7c', '2018-12-10 12:41:35', 10),
(6, 'test003', 'greenly.marni@cowaway.com', '8d1b35504641b585e983856b7450c8ac3060b5ec4523a13bcb4ca81dcaa056d4e60e3e107385ef6cef1bb4a2db8176e10d954c7eae81b9565c4e4d9af1ff94f2', '5b97f5dfc7de398464921ce94c99ea4b54fa2524937ad650e89b2c88edfc67b463bda4602ca29032d72283db4080187a8e64b70dffd8b1b2ec25f5f0f2dea902', '2018-12-10 12:47:59', 10),
(7, 'test004', 'phelan.najm@cowaway.com', '769594151d9e3d554ec21eca1cab5e491f5e3c66cd9918301e5edfe54d0129b50c3202ed41c3164e3c1a9cbddd60b2e1f9db46e8d7eea3fbdbb2e614975d37af', 'dc4cfd90d9b8492c073d6978424c1301b81e59580c713ad9b6d5346e1f968911f20eeaa70c615176d96dca5bdbc72b8b2e7e9c17e58f2912a432c5726b608e3f', '2018-12-10 12:50:01', 10),
(8, 'test005', 'o2745534@nwytg.net', 'a4dc9bee8a00a7be0fd487433d079b62767c936484338ceccd3bc40d347fda7bc15afb585bae6717cebb71c157c94be654a06e9f8b15112d4104b8ab2cea394f', 'e2b3bcd061ad6e4de42975c52f29a3992e3efa397ef50136126cecec8a220f9aa2a189caa2832b03854a3a223d51f48f5bf205327f88b5702a576514d86c16ba', '2018-12-10 14:04:21', 10),
(9, 'prodAdmin', 'd.tentoni@wedoit.io', 'e9e42af60672de9b1afd2c9659fda853b01d5876175e25ade0f07519d60681f40317eb71845047414c9c869d1bf9cbc4395c505d46da904a7daa8c42817020c5', '983c7a297002045d822bb347e00ef73af1f7f73c2fcc81a1d7f6fdb49bc4e1c5593e94e3474b39a7f02064758cdcb715df0f7eb399bb010320cf3af35d3bfaba', '2018-12-10 14:33:43', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
