create table if not exists security_requests( Id int(11) auto_increment not null primary key, UserId int(11) not null, RequestDate datetime not null, ExitCode int(111) not null, PageRequired varchar(100), Note varchar(5000) null, foreign key (UserId) references users(id) );

ALTER TABLE `nations` ADD `WorldMapSign` VARCHAR(15) NULL , ADD UNIQUE (`WorldMapSign`) ;

UPDATE `my_fowdeckhub`.`nations` SET `WorldMapSign` = 'JP' WHERE `nations`.`Id` = 1;
UPDATE `my_fowdeckhub`.`nations` SET `WorldMapSign` = 'US' WHERE `nations`.`Id` = 2;
UPDATE `my_fowdeckhub`.`nations` SET `WorldMapSign` = 'IT' WHERE `nations`.`Id` = 3;

ALTER TABLE `nations` ADD `CoordX` DOUBLE NULL , ADD `CoordY` DOUBLE NULL ;

UPDATE `my_fowdeckhub`.`nations` SET `CoordX` = '7.35' WHERE `nations`.`Id` = 1;
UPDATE `my_fowdeckhub`.`nations` SET `CoordX` = '17.11' WHERE `nations`.`Id` = 2;
UPDATE `my_fowdeckhub`.`nations` SET `CoordX` = '41.9' WHERE `nations`.`Id` = 3;
UPDATE `my_fowdeckhub`.`nations` SET `CoordY` = '136.46' WHERE `nations`.`Id` = 1;
UPDATE `my_fowdeckhub`.`nations` SET `CoordY` = '-61.85' WHERE `nations`.`Id` = 2;
UPDATE `my_fowdeckhub`.`nations` SET `CoordY` = '12.45' WHERE `nations`.`Id` = 3;