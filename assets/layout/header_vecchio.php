create table `Users`(
    `Id` int AUTO_INCREMENT unique not null,
    `Username` varchar(20) unique not null,
    `Email` varchar(50) unique not null,
    `Passwd` varchar(50) unique not null,
    `FirstName` varchar(50) unique not null,
    `LastName` varchar(50) unique not null,
    `RegisterDate` varchar(50) unique not null,
    primary key (Id));
    
create table `Events`(
    `Id` int AUTO_INCREMENT unique not null,
    `Name` varchar(50) unique not null,
    `Location` int not null,
    `Nation` int not null,
    `Year` int not null,
    `Attendance` int  not null,
    primary key (Id));
    
create table `Cards`(
    `Id` int AUTO_INCREMENT unique not null,
    `Name` varchar(50) unique not null,
    `Set` int not null,
    `Number` int not null,
    `Type` int not null,
    `Cost` int  not null,
    `Attribute` int not null,
    `Rarity` int  not null,
    primary key (Id));
    
create table `Decklists`(
    `Id` int AUTO_INCREMENT unique not null,
    `Name` varchar(50) unique not null,
    `Ruler` int not null,
    `Player` varchar(50) not null,
    `Event` int not null,
    `Type` int  not null,
    `Style` int not null,
    primary key (Id),
	FOREIGN KEY (`Ruler`) REFERENCES `Cards`(`Id`),
	FOREIGN KEY (`Event`) REFERENCES `Events`(`Id`));
    
create table `Composta`(
    `Card` int not null,
    `Decklist` int not null,
    `Deck` int not null,
    `Quantity` int not null,
	PRIMARY KEY (`Card`, `Decklist`, `Deck`),
	FOREIGN KEY (`Card`) REFERENCES `Cards`(`Id`),
	FOREIGN KEY (`Decklist`) REFERENCES `Decklists`(`Id`));
