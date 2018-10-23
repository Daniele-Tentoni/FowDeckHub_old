create table if not exists card_sets (
	'Code' varchar(10) collate utf8_bin unique not null primary key,
	'Name' varchar(30) collate utf8_bin unique not null,
	'NumCards' int(11) not null default 110
	) engine=InnoDB default charset=utf8 collate=utf8_bin auto_increment=1;
	
create table if not exists formats (
	'Code' varchar(10) collate utf8_bin unique not null primary key,
	'Name' varchar(30) collate utf8_bin unique not null,
	'Tournament' int(1) default 0
) engine=InnoDB default charset=utf8 collate=utf8_bin auto_increment=1;

create table if not exists sets_legality (
	'Set' varchar(10) collate utf8_bin unique not null,
	'Format' varchar(10) collate utf8_bin unique not null,
	primary key ('Set', 'Format')
) engine=InnoDB default charset=utf8 collate=utf8_bin auto_increment=1;

alter table `sets_legality`
add constraint `sets_legality_sets_fk` foreign key (`Set`) references card_sets ('Code'),
add constraint `sets_legality_formats_fk` foreign key (`Format`) references formats ('Code');

create table if not exists site_params (
	'Id' int auto_increment unique not null primary key,
	'Codice' varchar(30) collate utf8_bin not null, 
	'Valore' varchar(30) collate utf8_bin not null,
	'DesVal' varchar(100) collate utf8_bin not null, 
	'Note' varchar(100) collate utf8_bin not null
	) engine=InnoDB default charset=utf8 collate=utf8_bin auto_increment=1;

alter table `cards`
add constraint `card_set_fk` foreign key (`Set`) references card_set ('Code');

insert into site_params('Codice', 'Valore', 'DesVal', 'Note') values ('active_nf', '')