# tha to evaza sto telos tou create script gia na diagrafei ta proigoumena kathe fora pou to trexeis yo.
#ola ta auto increment ksekinane apo to miden
#insert into employees values ('','','','','');



insert into employees values 
	(0,NULL,NULL,'Pantelis','Kakomoiris'),
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
	(0,'admin','admin','1'),
	(1,'lse1','lse1','2'),#douleuei stin athina(aspropyrgos)
	(2,'lse2','lse2','2'),#douleuei sti salonika
	(3,'the1','the1','3'),#douleuei stin athina(aspropyrgos)
	(4,'the1','the1','3'),#douleuei sti larissa
	(5,'the2','the2','3');#douleuei sti mana sou astamatita kathe  mera(thesalonik)

#Beware for the ids(an ta allakseis prepei na allakseis kai sto local stores apo katw to teleutaio argument)
#paliopapara den anevases ta arxeia sto github, pa-pa-ra
insert into transit_hubs(th_id, name)values 
	('0','Alexandroupoli'),
	('1','Heraklion'),
	('2','Aspropyrgos'),
	('3','Patra'),
	('4','Ioannina'),
	('5','Thessaloniki'),
	('6','Larisa'),
	('7','Kalamata'),
	('8','Mytilini');

insert into local_stores(ls_id, name, th_id) values 
	(0,'Bleyk-Fleyk','5'),#sti thesaloniki
	(NULL,'Make-Make','2');#stin athina(aspropyrgos)

insert into th_employees values 
	('3','2'),#poios empl se poio th 
	('4','6'),
	('5','5');


insert into ls_employees values 
	('1','1'),#poios empl se poio ls(o 1 sto ls 1 to opoio eksupureteitai apo to th 2(athina))
	('2','0');


# ta upoloipa einai i mama sou sta tessera