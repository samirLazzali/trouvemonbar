/*
CREATE TABLE 'user' (
    id SERIAL PRIMARY KEY ,
    firstname VARCHAR NOT NULL ,
    lastname VARCHAR NOT NULL ,
    birthday date
);

INSERT INTO 'user'(firstname, lastname, birthday) VALUES ('John', 'Doe', '1967-11-22');
INSERT INTO 'user'(firstname, lastname, birthday) VALUES ('Yvette', 'Angel', '1932-01-24');
INSERT INTO 'user'(firstname, lastname, birthday) VALUES ('Amelia', 'Waters', '1981-12-01');
INSERT INTO 'user'(firstname, lastname, birthday) VALUES ('Manuel', 'Holloway', '1979-07-25');
INSERT INTO 'user'(firstname, lastname, birthday) VALUES ('Alonzo', 'Erickson', '1947-11-13');
INSERT INTO 'user'(firstname, lastname, birthday) VALUES ('Otis', 'Roberson', '1995-01-09');
INSERT INTO 'user'(firstname, lastname, birthday) VALUES ('Jaime', 'King', '1924-05-30');
INSERT INTO 'user'(firstname, lastname, birthday) VALUES ('Vicky', 'Pearson', '1982-12-12)');
INSERT INTO 'user'(firstname, lastname, birthday) VALUES ('Silvia', 'Mcguire', '1971-03-02');
INSERT INTO 'user'(firstname, lastname, birthday) VALUES ('Brendan', 'Pena', '1950-02-17');
INSERT INTO 'user'(firstname, lastname, birthday) VALUES ('Jackie', 'Cohen', '1967-01-27');
INSERT INTO 'user'(firstname, lastname, birthday) VALUES ('Delores', 'Williamson', '1961-07-19');

*/
Create Table "media" (
	mediaID INTEGER PRIMARY KEY,
	code VARCHAR(6),
	titre VARCHAR(100),
	serie VARCHAR(100),
	type VARCHAR(20),
	dispoOuiNon VARCHAR(30),
	etat VARCHAR(50),
	dernEmprunteur INTEGER	


);

Create Table "membre_emprunt" (
	id INTEGER PRIMARY KEY,
	prenom VARCHAR(50),
	nom VARCHAR(100),
	pseudo VARCHAR(100),
	promotion INTEGER,
	adherent VARCHAR(30),
	caution VARCHAR(50),
	emprunts_max INTEGER,
	password VARCHAR(100)


);

Create Table "bakabar_logins" (
	id INTEGER PRIMARY KEY,
	login VARCHAR(50),
	password VARCHAR(100)


);



INSERT INTO "media"(mediaID,code,titre,serie,type,dispoOuiNon,etat,dernEmprunteur) VALUES(1,'bel1','Beelzebub 1','Beelzebub','manga','oui','Neuf',null);

INSERT INTO "media"(mediaID,code,titre,serie,type,dispoOuiNon,etat,dernEmprunteur) VALUES(2,'bel2','Beelzebub 2','Beelzebub','manga','oui','Neuf',null);


INSERT INTO "media"(mediaID,code,titre,serie,type,dispoOuiNon,etat,dernEmprunteur) VALUES(3,'bel3','Beelzebub 3','Beelzebub','manga','oui','Neuf',null);

INSERT INTO "media"(mediaID,code,titre,serie,type,dispoOuiNon,etat,dernEmprunteur) VALUES(4,'bel4','Beelzebub 4','Beelzebub','manga','oui','Neuf',null);

INSERT INTO "media"(mediaID,code,titre,serie,type,dispoOuiNon,etat,dernEmprunteur) VALUES(5,'bel5','Beelzebub 5','Beelzebub','manga','oui','Neuf',null);

INSERT INTO "media"(mediaID,code,titre,serie,type,dispoOuiNon,etat,dernEmprunteur) VALUES(6,'bel6','Beelzebub 6','Beelzebub','manga','oui','Neuf',null);


INSERT INTO "media"(mediaID,code,titre,serie,type,dispoOuiNon,etat,dernEmprunteur) VALUES(7,'zet1','Zetman 1','Zetman','manga','oui','Neuf',null);


INSERT INTO "media"(mediaID,code,titre,serie,type,dispoOuiNon,etat,dernEmprunteur) VALUES(8,'zet2','Zetman 2','Zetman','manga','oui','Neuf',null);

INSERT INTO "media"(mediaID,code,titre,serie,type,dispoOuiNon,etat,dernEmprunteur) VALUES(9,'zet3','Zetman 3','Zetman','manga','oui','Neuf',null);

INSERT INTO "media"(mediaID,code,titre,serie,type,dispoOuiNon,etat,dernEmprunteur) VALUES(10,'zet4','Zetman 4','Zetman','manga','oui','Neuf',null);

INSERT INTO "media"(mediaID,code,titre,serie,type,dispoOuiNon,etat,dernEmprunteur) VALUES(11,'zet5','Zetman 5','Zetman','manga','oui','Neuf',null);

INSERT INTO "media"(mediaID,code,titre,serie,type,dispoOuiNon,etat,dernEmprunteur) VALUES(12,'gsk1','Genshiken 1','Genshiken','manga','oui','Neuf',null);

INSERT INTO "media"(mediaID,code,titre,serie,type,dispoOuiNon,etat,dernEmprunteur) VALUES(13,'gsk2','Genshiken 2','Genshiken','manga','oui','Neuf',null);

INSERT INTO "media"(mediaID,code,titre,serie,type,dispoOuiNon,etat,dernEmprunteur) VALUES(14,'gsk3','Genshiken 3','Genshiken','manga','oui','Neuf',null);



INSERT INTO "membre_emprunt"(id,prenom,nom,pseudo,promotion,adherent,caution,emprunts_max,password) VALUES (1,'Eric','COLONIA-TARAZONA','Miryuni',2020,'oui','oui',10, '640ab2bae07bedc4c163f679a746f7ab7fb5d1fa');

INSERT INTO "bakabar_logins"(id,login,password) VALUES (1,'Miryuni','640ab2bae07bedc4c163f679a746f7ab7fb5d1fa');







