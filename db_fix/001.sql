ALTER TABLE `events` CHANGE `CommunityReports` `CommunityReports` VARCHAR(5000) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT 'There is no community reports. Contact the admin if you have one!', CHANGE `OtherLinks` `OtherLinks` VARCHAR(5000) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT 'There is no other links. Contact the admin if you have one!';

-- 17-12-2018
ALTER TABLE `event_rulers_breakdown` CHANGE `Quantity` `Quantity` INT(11) NULL;

-- 19-12-2018
ALTER TABLE `decklists` 
CHANGE `GachaCode` `GachaCode` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT '0', 
CHANGE `Position` `Position` INT(11) NULL DEFAULT '0',
CHANGE `Player` `Player` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'Not set',
CHANGE `Ruler` `Ruler` INT(11) NULL DEFAULT NULL, 
CHANGE `Event` `Event` INT(11) NULL DEFAULT NULL, 
CHANGE `Type` `Type` INT(11) NULL DEFAULT NULL;

-- 20-12-2018
ALTER TABLE `types` 
ADD UNIQUE(`Name`);

INSERT INTO `cards` (`Id`, `Name`, `Set`, `Number`, `Cost`, `Visibility`, `Rarity`) VALUES 
('-3274', 'Brunhild, Caller of Spirits', 'SDV1', '005', '2WW', '1', '3'), 
('3271', 'Bethor, the Angel of Treasure', 'SDV1', '003', '1W', '1', '1'), 
('3385', 'Skeleton Horde', 'SDV5', '016', 'B', '1', '1'), 
('3381', 'Patchwork Frankenstein', 'SDV5', '012', 'BB', '1', '1'), 
('3278', 'Eir, Valkyrie of Mercy', 'SDV1', '009', '1WW', '1', '2'), 
('3368', 'Armaros, the Fallen Angel of Nullification', 'SDV5', '001', '1BB', '1', '2'), 
('3384', 'Shemhaza, the Fallen Angel of Sadism', 'SDV5', '015', '2BB', '1', '4'), 
('3474', 'Azazel, the Fallen Angel of Gloom', 'NDR', '082', '2BB', '1', '3'), 
('3475', 'Belial, the Evil from the Scriptures', 'NDR', '083', '3BBB', '1', '4'), 
('3489', 'Rain of Tears', 'NDR', '097', 'B', '1', '1'), 
('3485', 'Look of Corruption', 'NDR', '093', 'B', '1', '3'), 
('3410', 'Spear of the Valkyries', 'NDR', '018', '1W', '1', '2'), 
('3484', 'Life Severing Blade', 'NDR', '092', '2B', '1', '3'), 
('3488', 'Oborozuki', 'NDR', '096', 'BB', '1', '4'), 
('3374', 'Immortal Commander', 'SDV5', '007', '1BB', '1', '2'), 
('3481', 'Disgraced Knight', 'NDR', '089', 'BBB', '1', '3'), 
('3390', 'Vlad, the Insatiable', 'SDV5', '021', '2BB', '1', '4'), 
('3479', 'Craving', 'NDR', '087', '3BB', '1', '2'), 
('3490', 'Ruins of Neverending Rain, Rainruins', 'NDR', '098', '2BB', '1', '2'), 
('3276', 'Dispel', 'SDV1', '007', 'W', '1', '1'), 
('3275', "Brunhild's Wrath", 'SDV1', '006', '1W', '1', '1'), 
('3279', 'Karmic Reversal', 'SDV1', '010', '1W', '1', '1'), 
('3412', 'Whispers of an Angel', 'NDR', '020', '2W', '1', '2'), 
('3281', "Odin's Judgment", 'SDV1', '012', '1WW', '1', '3');