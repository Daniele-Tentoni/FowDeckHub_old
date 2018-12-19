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