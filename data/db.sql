DROP TABLE Termine ;
DROP TABLE Vendre;
DROP TABLE  Trouve ;
DROP TABLE Tag ;
DROP TABLE Objet ;
DROP TABLE Eleve ;

CREATE TABLE Eleve (
    mail VARCHAR PRIMARY KEY ,
    nom VARCHAR NOT NULL ,
    prenom VARCHAR NOT NULL ,
    mdp VARCHAR NOT NULL , 
	pseudo VARCHAR NOT NULL ,
	promo INT ,
	telephone VARCHAR,
	admin BOOLEAN
);

/*DELETE FROM Eleve WHERE mail='kalo.rakotondrazokiny@ensiie.fr';*/

INSERT INTO eleve (mail, nom, prenom, mdp, pseudo,promo,telephone,admin)
VALUES ('kalo.rakotondrazokiny@ensiie.fr', 'RAKOTONDRAZOKINY', 'Kalo', 'motdepasse', 'Kalou', 2020 ,'07 89 27 89 25', 'true');
INSERT INTO eleve (mail, nom, prenom, mdp, pseudo,promo,telephone, admin)
VALUES ('marine.pallotta@ensiie.fr', 'PALLOTTA', 'Marine', 'motdepasse', 'Rin', 2020 ,'', 'true');
INSERT INTO eleve (mail, nom, prenom, mdp, pseudo,promo,telephone,admin)
VALUES ('leo.vezinet@ensiie.fr', 'VEZINET', 'Leo', 'motdepasse', 'Eo', 2020 ,'', 'true');
INSERT INTO eleve (mail, nom, prenom, mdp, pseudo,promo,telephone,admin)
VALUES ('gabrielle.guillaume@ensiie.fr', 'GUILLAUME', 'Gabrielle', 'motdepasse', 'Gabb', 2020 ,'', 'true');

INSERT INTO eleve (mail, nom, prenom, mdp, pseudo,promo,telephone,admin)
VALUES ('tsiky.raj@ensiie.fr', 'RAJ', 'Tsiky', 'motdepasse', 'Tsss', 2000 ,'07 89 27 89 30', 'false');
INSERT INTO eleve (mail, nom, prenom, mdp, pseudo,promo,telephone, admin)
VALUES ('Evy.bopp@ensiie.fr', 'BOPP', 'Evy', 'motdepasse', 'Vivi', 1999 ,'', 'false');


CREATE TABLE Objet (
	id SERIAL PRIMARY KEY ,
	titre VARCHAR NOT NULL ,
	description TEXT ,
	date DATE ,
	image VARCHAR ,
	mail VARCHAR NOT NULL REFERENCES Eleve (mail)
);


INSERT INTO Objet (id, titre, description, date, mail)
VALUES (1, 'mon t shirt', 'Il est bleu et blanc', '2018-05-03', 'kalo.rakotondrazokiny@ensiie.fr');

INSERT INTO Objet (id, titre, description, date, mail)
VALUES (2, 'Ma calculatrice', 'Elle est de marque Casio ', '2018-05-03', 'Evy.bopp@ensiie.fr');

INSERT INTO Objet (id, titre, description, date, mail)
VALUES (3 , 'Cours de ILO' , 'Il y a écrit mon prénom et nom desus .', '2018-03-03', 'kalo.rakotondrazokiny@ensiie.fr');

INSERT INTO Objet (id,titre, description, date, mail)
VALUES (4,'Paris Evry' , 'Allons en cours ensemble!', '2018-03-03', 'tsiky.raj@ensiie.fr');

CREATE TABLE Tag (
	nom VARCHAR PRIMARY KEY ,
	id_objet SERIAL NOT NULL REFERENCES Objet (id)
);


CREATE TYPE categorie_trouve AS ENUM ('vetement' , 'electronique' , 'sac', 'cours', 'clés',
'portefeuille' , 'bijoux' , 'lunettes' , 'autre');


CREATE TYPE categorie_vendre AS ENUM ('logement', 'location','covoiturage', 'massage','objet', 'autre');



CREATE TABLE Trouve (
  id SERIAL PRIMARY KEY REFERENCES Objet (id),
	categorie_T categorie_trouve NOT NULL,
	endroit VARCHAR 
) ;

INSERT INTO Trouve (id, categorie_T, endroit)
VALUES (1, 'vetement', 'chez moi');
INSERT INTO Trouve (id, categorie_T, endroit)
VALUES (3, 'cours', 'chez moi');



CREATE TABLE Vendre (
  id SERIAL PRIMARY KEY REFERENCES Objet (id),
  categorie_V categorie_vendre NOT NULL,
	prix INT 
)  ;


INSERT INTO Vendre (id, categorie_V, prix)
VALUES (2,'logement',20 );
INSERT INTO Vendre (id, categorie_V, prix)
VALUES (4,'covoiturage',20 );


CREATE TABLE Termine (
  id SERIAL PRIMARY KEY REFERENCES Objet (id),
	fin_date DATE ,
	mail_client VARCHAR NOT NULL REFERENCES Eleve (mail) 
)  ;


