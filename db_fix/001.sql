-- 24-12-2018
INSERT INTO `my_fowdeckhub`.`cards` (`Id`, `Name`, `Set`, `Number`, `Cost`, `Visibility`, `Rarity`) VALUES 
('3426', 'Sandstorm', 'NDR', '34', 'R', '1', '2'), 
('3303', 'Giant Sandstorm', 'SDV2', '10', 'RRRR', '1', '2'),
('3450', 'Thick Fog', 'NDR', '58', '2U', '1', '1'), 
('3451', 'Torrent of Energy', 'NDR', '059', '2U', '1', '1'),
('3446', 'Scrap and Build', 'NDR', '54', '2U', '1', '2'), 
('3447', 'Sky Round Guardian', 'NDR', '055', '3U', '1', '1'),
('3437', 'Invitation', 'NDR', '045', '1UU', '1', '2'), 
('3438', 'Iron Cauldron Witch', 'NDR', '46', '4UU', '1', '1'),
('3360', 'Sealing Scroll', 'SDV4', '16', '0', '1', '3'), 
('3361', 'Shadow Step', 'SDV4', '17', '1G', '1', '1');

-- 26-12-2028
INSERT INTO `my_fowdeckhub`.`site_params` (`Id`, `Codice`, `Valore`, `DesVal`, `Note`) VALUES 
(NULL, 'MIN_MAIN_DECK', '40', 'Minimo di carte di cui deve essere composto il deck del main.', ''), 
(NULL, 'MAX_MAIN_DECK', '60', 'Massimo di carte di cui deve essere composto il deck del main.', ''), 
(NULL, 'MIN_RULER_DECK', '1', 'Minimo di carte di cui deve essere composto il deck del ruler.', ''), 
(NULL, 'MAX_RULER_DECK', '3', 'Massimo di carte di cui deve essere composto il deck del Ruler.', ''), 
(NULL, 'MIN_SIDE_DECK', '0', 'Minimo di carte di cui deve essere composto il deck del Side.', ''), 
(NULL, 'MAX_SIDE_DECK', '15', 'Massimo di carte di cui deve essere composto il deck del Side.', ''), 
(NULL, 'MIN_STONE_DECK', '10', 'Minimo di carte di cui deve essere composto il deck delle Stone.', ''), 
(NULL, 'MAX_STONE_DECK', '20', 'Massimo di carte di cui deve essere composto il deck delle Stone.', ''), 
(NULL, 'MIN_RUNE_DECK', '0', 'Minimo di carte di cui deve essere composto il deck delle Rune.', ''), 
(NULL, 'MAX_RUNE_DECK', '5', 'Massimo di carte di cui deve essere composto il deck delle Rune.', '');

-- 28-12-2018
ALTER TABLE `deck_types` ADD `Label` VARCHAR(15) NULL DEFAULT NULL ;