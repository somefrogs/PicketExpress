# tha to evaza sto telos tou create script gia na diagrafei ta proigoumena kathe fora pou to trexeis yo.
#ola ta auto increment ksekinane apo to den ginetai alliws yo
#insert into employees values ('','','','','');

insert into employees values 
	(NULL,NULL,NULL,'Pantelis','Kakomoiris'),
	(NULL,NULL,NULL,'Marina','Mpliampla'),
	(NULL,NULL,NULL,'Antwnis','Fligkiflogkis'),
	(NULL,NULL,NULL,'Mpitsimplikis','Pfffatos'),
	(NULL,NULL,NULL,'Fripifroupis','Fonias'),
	(NULL,NULL,NULL,'Vigkos','Karavigkos');
#admin -> 1
# the  -> 2
# lse  -> 3
#ta parakatw accounts se pliri isodunamia me ti seira apo panw
insert into login values 
	(1,'admin','admin','1'),
	(2,'lse1','lse1','3'),#douleuei stin athina(aspropyrgos)
	(3,'lse2','lse2','3'),#douleuei sti salonika
	(4,'the1','the1','2'),#douleuei stin athina(aspropyrgos)
	(5,'the2','the2','2'),#douleuei sti larissa
	(6,'the3','the3','2');#douleuei sti mana sou astamatita kathe  mera(thesalonik)

#Beware for the ids(an ta allakseis prepei na allakseis kai sto local stores apo katw to teleutaio argument)
#paliopapara den anevases ta arxeia sto github, pa-pa-ra
insert into transit_hubs(th_id,name)values 
	(0,'Ioannina'),
	(1,'Thessaloniki'),
	(2,'Alexandroupoli'),
	(3,'Larisa'),
	(4,'Mytilini'),
	(5,'Patra'),
	(6,'Aspropyrgos'),
	(7,'Kalamata'),
	(9,'Heraklion');


-- 	('Alexandroupoli'),
-- 	('Heraklion'),
-- 	('Aspropyrgos'),
-- 	('Patra'),
-- 	('Ioannina'),
-- 	('Thessaloniki'),
-- 	('Larisa'),
-- 	('Kalamata'),
-- 	('Mytilini');
-- 	/* graph contents are
-- 0: iwannina 
-- 1: thessaloniki
-- 2: aleksandroupoli
-- 3: larissa
-- 4: lesvos
-- 5: patras
-- 6: athina
-- 7: kalamata
-- 8: iraklion
-- */

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