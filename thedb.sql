drop database if exists the_company_db;
create database the_company_db;
use the_company_db;
create table employees(
	id int unsigned not null auto_increment,
	afm char(11) default '0',
	phone int unsigned default '0',
	name varchar(250) default'unknown',
	surname varchar(250) default'unknown',
	primary key(id)
	)Engine=InnoDB;
create table login(
	id int unsigned not null,
	username varchar(250) default'unset',
	pass varchar(250) default 'unset',
	ptype enum('1','2','3'),
	primary key(id),
	unique(username),
	foreign key (id) references employees(id)
	on update cascade on delete cascade
	)Engine=InnoDB;
create table TransitHubs(
	TH_id int unsigned not null auto_increment,
	name varchar(250) default'unset',
	street varchar(250) default 'unset',
	stnum int unsigned not null,
	city varchar(250) default 'unset',
	TK int unsigned not null,
	gpsc varchar(250) default 'unset',
	primary key(TH_id)
	)Engine=InnoDB;
create table LocalStores(
	LS_id int unsigned not null auto_increment,
	name varchar(250) default'unset',
	street varchar(250) default 'unset',
	stnum int unsigned not null,
	city varchar(250) default 'unset',
	TK int unsigned not null,
		#gpsc ?? 
		gpsc varchar(250) default 'unset',
		ServTH_id int unsigned,
		primary key(LS_id),
		foreign key (ServTH_id) references TransitHubs(TH_id)
		on update cascade on delete cascade
		)Engine=InnoDB;
create table THemps(
	THemp_id int unsigned not null,
	#username varchar(250) default'unset',
	#pass varchar(250) default 'unset',
	Thub int unsigned,
	primary key(THemp_id),
	#unique(username),
	foreign key (THemp_id) references employees(id)
	on update cascade on delete cascade,
	foreign key (Thub) references TransitHubs(TH_id)
	on update cascade on delete cascade
	)Engine=InnoDB;
create table LSemps(
	LSemp_id int unsigned not null,
	#username varchar(250) default'unset',
	#pass varchar(250) default 'unset',
	LStore int unsigned,
	primary key(LSemp_id),
	#unique(username),
	foreign key (LSemp_id) references employees(id)
	on update cascade on delete cascade,
	foreign key (LStore) references LocalStores(LS_id)
	on update cascade on delete cascade
	)Engine=InnoDB;
create table client_info(
	cl_id int unsigned not null auto_increment,
	name varchar(250) default'unknown',
	surname varchar(250) default'unknown',
	afm char(11) default '0',
	phone int unsigned default '0',
	primary key(cl_id)
	)Engine=InnoDB;
create table Shipment(
	tracknumber varchar(7) not null,
	from_cl_id int unsigned not null,
	to_client_id int unsigned not null,
	from_store int unsigned not null,
	to_store int unsigned not null,
	cretor_lse int unsigned not null,
	express bit not null,
	est_cost int unsigned not null,
	eta int unsigned not null,
	primary key(tracknumber),
	foreign key(from_cl_id) references client_info(cl_id)
	on update cascade on delete no action,
	foreign key(to_client_id) references client_info(cl_id)
	on update cascade on delete no action,
	foreign key(from_store) references LocalStores(LS_id)
	on update cascade on delete no action,
	foreign key(to_store) references LocalStores(LS_id)
	on update cascade on delete no action,
	foreign key(cretor_lse) references LSemps(LSemp_id)
	on update cascade on delete no action 
	)Engine=InnoDB;
create table TrackHistory(
	tracknumber varchar(7) not null,
	the_scanner int unsigned,
	tstamp timestamp,
	transitnode int unsigned not null,
	past_through bit,
	primary key(tracknumber,transitnode),
	foreign key(tracknumber) references Shipment(tracknumber)
	on update cascade on delete no action,
	foreign key(the_scanner) references THemps(THemp_id)
	on update cascade on delete no action,
	foreign key(transitnode) references TransitHubs(TH_id)
	on update cascade on delete no action 
	)Engine=InnoDB;