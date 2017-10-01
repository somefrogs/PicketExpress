drop database if exists the_company_db;
create database the_company_db;
use the_company_db;


create table employees(
	id int unsigned not null auto_increment,
	afm char(11) default '666',
	phone int unsigned default '666',
	name varchar(250) default 'Petrakos',
	surname varchar(250) default 'Kaimenos',
	primary key(id)
	)Engine=InnoDB;
create table login(
	id int unsigned not null,
	username varchar(250) not null default 'weird username',
	pass varchar(250) default 'secret',
	ptype enum('1','2','3'),
	-- primary key(id),
	primary key(username),

	foreign key (id) references employees(id)
	on update cascade on delete cascade
	)Engine=InnoDB;
create table transit_hubs(
	th_id int unsigned not null auto_increment,
	name varchar(250) default 'unset',
	street varchar(250) default 'unset',
	stnum int unsigned default 0,
	city varchar(250) default 'unset',
	tk int unsigned default 0,
	gpsc varchar(250) default 'unset',
	primary key(th_id)
	)Engine=InnoDB;
create table local_stores(
	ls_id int unsigned not null auto_increment,
	name varchar(250) default 'unset',
	street varchar(250) default 'unset',
	stnum int unsigned default 0,
	city varchar(250) default 'unset',
	tk int unsigned default 0,
	gpsc varchar(250) default 'unset',
	th_id int unsigned not null,
	primary key(ls_id),

	foreign key (th_id) references transit_hubs(th_id)
	on update cascade on delete cascade
		)Engine=InnoDB;
create table th_employees(
	th_emp_id int unsigned not null,
	th_id int unsigned,
	primary key(th_emp_id,th_id),

	foreign key (th_emp_id) references employees(id)
	on update cascade on delete cascade,
	foreign key (th_id) references transit_hubs(th_id)
	on update cascade on delete cascade
	)Engine=InnoDB;
create table ls_employees(
	id int unsigned not null,
	ls_id int unsigned,
	primary key(id,ls_id),

	foreign key (id) references employees(id)
	on update cascade on delete cascade,
	foreign key (ls_id) references local_stores(ls_id)
	on update cascade on delete cascade
	)Engine=InnoDB;

create table shipment(
	tracknumber varchar(7) not null,
	from_cl_id varchar(30) not null default 'A Kaimenos',
	to_cl_id varchar(30) not null default 'B Dusmoiros',
	from_store int unsigned not null,
	to_store int unsigned not null,
	-- cretor_lse int unsigned not null,
	express bit not null default 0,
	est_cost int unsigned not null default 0,
	eta int unsigned not null default 0,
	delivered bit default 0,

	primary key(tracknumber),
	foreign key(from_store) references local_stores(ls_id)
	on update cascade on delete no action,
	foreign key(to_store) references local_stores(ls_id)
	on update cascade on delete no action
	-- ,
	-- foreign key(cretor_lse) references ls_employees(id)
	-- on update cascade on delete no action 
	)Engine=InnoDB;
create table trackhistory(
	tracknumber varchar(7) not null,
	transitnode int unsigned not null,
	past_through bit default 0,

	primary key(tracknumber,transitnode),
	foreign key(tracknumber) references shipment(tracknumber)
	on update cascade on delete no action,
	-- foreign key(th_emp_id) references th_employees(th_emp_id)
	-- on update cascade on delete no action,
	foreign key(transitnode) references transit_hubs(th_id)
	on update cascade on delete no action 
	)Engine=InnoDB;


# tha to evaza sto telos tou create script gia na diagrafei ta proigoumena kathe fora pou to trexeis yo.
#ola ta auto increment ksekinane apo to den ginetai alliws yo
#insert into employees values ('','','','','');

insert into employees values 
	(NULL,NULL,NULL,'Pantelis','Kakomoiris'),
	(NULL,NULL,NULL,'Maria','Tsoupwti'),
	(NULL,NULL,NULL,'Antwnis','Fligkifakos'),
	(NULL,NULL,NULL,'Mpitsimplikis','Pfffatos'),
	(NULL,NULL,NULL,'Fripifroupis','Fonias'),
	(NULL,NULL,NULL,'Vigkos','Karavigkos');
#admin -> 1
# lse  -> 2
# the  -> 3
#ta parakatw accounts se pliri isodunamia me ti seira apo panw
insert into login values 
	(1,'admin','admin','1'),
	(2,'lse1','lse1','2'),#douleuei stin athina(aspropyrgos)
	(3,'lse2','lse2','2'),#douleuei sti salonika
	(4,'the1','the1','3'),#douleuei stin athina(aspropyrgos)
	(5,'the2','the2','3'),#douleuei sti larissa
	(6,'the3','the3','3');#douleuei sti mana sou astamatita kathe  mera(thesalonik)

#Beware for the ids(an ta allakseis prepei na allakseis kai sto local stores apo katw to teleutaio argument)
#paliopapara den anevases ta arxeia sto github, pa-pa-ra
insert into transit_hubs(name)values 
	('Alexandroupoli'),
	('Heraklion'),
	('Aspropyrgos'),
	('Patra'),
	('Ioannina'),
	('Thessaloniki'),
	('Larisa'),
	('Kalamata'),
	('Mytilini');
-- (,'Alexandroupoli'),
-- 	('1','Heraklion'),
-- 	('2','Aspropyrgos'),
-- 	('3','Patra'),
-- 	('4','Ioannina'),
-- 	('5','Thessaloniki'),
-- 	('6','Larisa'),
-- 	('7','Kalamata'),
-- 	('8','Mytilini');

-- NULL,
-- NULL,
-- NULL,
-- NULL,
-- NULL,
-- NULL,
-- NULL,
-- NULL,
-- NULL,

insert into local_stores(ls_id, name, th_id) values 
	(NULL,'Bleyk-Fleyk','6'),#sti thesaloniki
	(NULL,'Make-Make','3');#stin athina(aspropyrgos)

insert into th_employees values 
	('3','3'),#poios empl se poio th 
	('4','7'),
	('5','6');


insert into ls_employees values 
	('1','2'),#poios empl se poio ls(o 1 sto ls 1 to opoio eksupureteitai apo to th 2(athina))
	('2','1');


# ta upoloipa einai i mama sou sta tessera