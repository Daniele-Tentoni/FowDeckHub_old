create table if not exists security_requests( Id int(11) auto_increment not null primary key, UserId int(11) not null, RequestDate datetime not null, ExitCode int(111) not null, PageRequired varchar(100), Note varchar(5000) null, foreign key (UserId) references users(id) );

ALTER TABLE `nations` ADD `WorldMapSign` VARCHAR(15) NULL , ADD UNIQUE (`WorldMapSign`) ;

UPDATE `my_fowdeckhub`.`nations` SET `WorldMapSign` = 'JP' WHERE `nations`.`Id` = 1;
UPDATE `my_fowdeckhub`.`nations` SET `WorldMapSign` = 'US' WHERE `nations`.`Id` = 2;
UPDATE `my_fowdeckhub`.`nations` SET `WorldMapSign` = 'IT' WHERE `nations`.`Id` = 3;