ALTER TABLE `events` CHANGE `CommunityReports` `CommunityReports` VARCHAR(5000) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT 'There is no community reports. Contact the admin if you have one!', CHANGE `OtherLinks` `OtherLinks` VARCHAR(5000) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT 'There is no other links. Contact the admin if you have one!';

-- 17-12-2018
ALTER TABLE `event_rulers_breakdown` CHANGE `Quantity` `Quantity` INT(11) NULL;
