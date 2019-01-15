CREATE DATABASE my_fowdeckhub CHARACTER SET utf8 COLLATE utf8_bin;
USE my_fowdeckhub;

-- Formati, nazioni ed eventi.
CREATE TABLE formats (
  Code varchar(10) NOT NULL,
  Name varchar(50) NOT NULL UNIQUE,
  PRIMARY KEY (Code)
);

CREATE TABLE nations (
  Id int(11) NOT NULL AUTO_INCREMENT,
  Name varchar(50) NOT NULL UNIQUE,
  PRIMARY KEY (Id)
);

CREATE TABLE events (
  Id int(11) NOT NULL AUTO_INCREMENT,
  Name varchar(70) UNIQUE NULL,
  `Format` varchar(10) DEFAULT NULL,
  Nation int(11) DEFAULT NULL,
  `Year` int(11) DEFAULT NULL,
  Attendance int(11) DEFAULT NULL,
  Date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  Visibility int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (Id),
  FOREIGN KEY (`Format`) REFERENCES formats(Code),
  FOREIGN KEY (Nation) REFERENCES nations(Id)
);

-- Set di carte.
CREATE TABLE card_sets (
  Code varchar(10) COLLATE utf8_bin NOT NULL,
  Name varchar(50) COLLATE utf8_bin DEFAULT NULL,
  NumCards int(11) NOT NULL DEFAULT '110',
  Year int(11) NOT NULL DEFAULT '2018',
  PRIMARY KEY (Code)
);

-- Rarità delle carte.
CREATE TABLE rarity (
  Id int(11) NOT NULL,
  Name varchar(30) COLLATE utf8_bin NOT NULL,
  Symbol varchar(10) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (Id)
);

-- Creazione delle carte.
CREATE TABLE cards (
  Id int(11) NOT NULL AUTO_INCREMENT,
  Name varchar(70) COLLATE utf8_bin NOT NULL UNIQUE,
  Set varchar(10) COLLATE utf8_bin DEFAULT NULL,
  Number int(11) NOT NULL,
  Cost varchar(10) COLLATE utf8_bin NOT NULL,
  Visibility int(1) NOT NULL DEFAULT '0',
  Rarity int(11) DEFAULT NULL,
  PRIMARY KEY (Id),
  FOREIGN KEY (Set) REFERENCES card_sets(Code)
);

-- Attributi e tabella relazione.
CREATE TABLE attributes (
  Id int(11) NOT NULL,
  Name varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (Id)
);

CREATE TABLE card_attributes (
  Card int(11) NOT NULL,
  Attribute int(11) NOT NULL,
  PRIMARY KEY (Card, Attribute),
  FOREIGN KEY (Card) REFERENCES cards(Id),
  FOREIGN KEY Attribute REFERENCES attributes(Id)
);

-- Tipi di carte e tabella relazione.
CREATE TABLE types (
  Id int(11) NOT NULL,
  Name varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (Id),
  UNIQUE KEY Name (Name)
);

CREATE TABLE card_types (
  Card int(11) NOT NULL,
  Type int(11) NOT NULL,
  PRIMARY KEY (Card, Type),
  FOREIGN KEY (Type) REFERENCES types(Id),
  FOREIGN KEY (Card) REFERENCES cards(Id)
);

-- Tipi di Deck (Ruler, Main, Stone, Side, Rune)
CREATE TABLE deck_types (
  Id int(11) NOT NULL,
  Name varchar(50) COLLATE utf8_bin NOT NULL,
  Label varchar(15) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (Id)
);

-- Tipi di Deck (I vari tipi di deck che i giocatori si inventono).
CREATE TABLE decktypes (
  Id int(11) NOT NULL AUTO_INCREMENT,
  Name varchar(30) COLLATE utf8_bin DEFAULT NULL,
  Style int(11) NOT NULL,
  PRIMARY KEY (Id),
  KEY Style (Style)
);

-- Deck list.
CREATE TABLE decklists (
  Id int(11) NOT NULL AUTO_INCREMENT,
  Name varchar(80) COLLATE utf8_bin NOT NULL UNIQUE,
  Player varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '"Not set"',
  Event int(11) DEFAULT NULL,
  Type int(11) DEFAULT NULL,
  Visibility int(1) NOT NULL DEFAULT '0',
  GachaCode varchar(30) COLLATE utf8_bin DEFAULT '0',
  Position int(11) DEFAULT '0',
  PRIMARY KEY (Id),
  FOREIGN KEY (Event) REFERENCES events(Id),
  FOREIGN KEY (Type) REFERENCES deck_type(Id)
);

-- composta.
CREATE TABLE composta (
  Decklist int(11) NOT NULL,
  Card int(11) NOT NULL,
  Decktype int(11) NOT NULL,
  Quantity int(11) NOT NULL,
  PRIMARY KEY (Decklist,Card,Decktype),
  FOREIGN KEY (Card) REFERENCES cards(Id),
  FOREIGN KEY (Decktype) REFERENCES deck_types(Id)
);

-- Breakdown.
CREATE TABLE IF NOT EXISTS event_rulers_breakdown (
  Event int(11) NOT NULL,
  Ruler int(11) NOT NULL,
  Quantity int(11) DEFAULT NULL,
  PRIMARY KEY (Event, Ruler),
  FOREIGN KEY (Ruler) REFERENCES cards(Id),
  FOREIGN KEY (Event) REFERENCES events(Id)
);