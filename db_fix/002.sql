create table if not exists bug_report_states(
	Id int(11) unique not null primary key,
	Name varchar(50)
);

create table if not exists bug_reports(
	Id int(11) unique not null primary key,
	Name varchar(100) not null,
	Email varchar(100) not null,
	Bug varchar(5000) not null,
	BugState int(11) not null,
	CreationDate date not null default now(),
	LastOperation date not null default now(),
	foreign key BugState references bug_report_states(Id)
);

insert into bug_report_states(Id, Name) values (
1, "New",
2, "Open",
3, "Assigned",
4, "Resolved");

insert into bug_reports(Name, Email, Bug, BugState) values (
"Daniele Tentoni", "d.tentoni@wedoit.io", "Questo bug deve essere New", 1,
"Daniele Tentoni", "d.tentoni@wedoit.io", "Questo bug deve essere Open", 2,
"Daniele Tentoni", "d.tentoni@wedoit.io", "Questo bug deve essere Assigned", 3,
"Daniele Tentoni", "d.tentoni@wedoit.io", "Questo bug deve essere Resolved", 4)