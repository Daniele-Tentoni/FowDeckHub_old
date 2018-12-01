alter table roles add column CanEditEvents int(1) not null default 0;

update roles set CanEditEvents = 1 where Name = "Superuser";