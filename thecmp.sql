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
create table transit_hubs(
	th_id int unsigned not null auto_increment,
	name varchar(250) default'unset',
	street varchar(250) default 'unset',
	stnum int unsigned not null,
	city varchar(250) default 'unset',
	tk int unsigned not null,
	gpsc varchar(250) default 'unset',
	primary key(th_id)
	)Engine=InnoDB;
create table local_stores(
	ls_id int unsigned not null auto_increment,
	name varchar(250) default'unset',
	street varchar(250) default 'unset',
	stnum int unsigned not null,
	city varchar(250) default 'unset',
	tk int unsigned not null,
	gpsc varchar(250) default 'unset',
	th_id int unsigned,
	primary key(ls_id),
	foreign key (th_id) references transit_hubs(th_id)
	on update cascade on delete cascade
		)Engine=InnoDB;
create table th_employees(
	th_emp_id int unsigned not null,
	#username varchar(250) default'unset',
	#pass varchar(250) default 'unset',
	th_id int unsigned,
	primary key(th_emp_id),
	#unique(username),
	foreign key (th_emp_id) references employees(id)
	on update cascade on delete cascade,
	foreign key (th_id) references transit_hubs(th_id)
	on update cascade on delete cascade
	)Engine=InnoDB;
create table ls_employees(
	id int unsigned not null,
	#username varchar(250) default'unset',
	#pass varchar(250) default 'unset',
	ls_id int unsigned,
	primary key(id),
	#unique(username),
	foreign key (id) references employees(id)
	on update cascade on delete cascade,
	foreign key (ls_id) references local_stores(ls_id)
	on update cascade on delete cascade
	)Engine=InnoDB;

-- create table client_info(
-- 	cl_id int unsigned not null auto_increment,
-- 	name varchar(250) default'unknown',
-- 	surname varchar(250) default'unknown',
-- 	afm char(11) default '0',
-- 	phone int unsigned default '0',
-- 	primary key(cl_id)
-- 	)Engine=InnoDB;

create table shipment(
	tracknumber varchar(7) not null,
	from_cl_id int unsigned not null,
	to_cl_id int unsigned not null,
	from_store int unsigned not null,
	to_store int unsigned not null,
	cretor_lse int unsigned not null,
	express bit not null,
	est_cost int unsigned not null,
	eta int unsigned not null,
	delivered bit,
	primary key(tracknumber),
	-- foreign key(from_cl_id) references client_info(cl_id)
	-- on update cascade on delete no action,
	-- foreign key(to_cl_id) references client_info(cl_id)
	-- on update cascade on delete no action,
	foreign key(from_store) references local_stores(ls_id)
	on update cascade on delete no action,
	foreign key(to_store) references local_stores(ls_id)
	on update cascade on delete no action,
	foreign key(cretor_lse) references ls_employees(id)
	on update cascade on delete no action 
	)Engine=InnoDB;
create table trackhistory(
	tracknumber varchar(7) not null,
	th_emp_id int unsigned,
	tstamp timestamp,
	transitnode int unsigned not null,
	past_through bit,
	primary key(tracknumber,transitnode),
	foreign key(tracknumber) references shipment(tracknumber)
	on update cascade on delete no action,
	foreign key(th_emp_id) references th_employees(th_emp_id)
	on update cascade on delete no action,
	foreign key(transitnode) references transit_hubs(th_id)
	on update cascade on delete no action 
	)Engine=InnoDB;