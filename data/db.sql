-- ###################################################################
-- # Application : SQL script
-- # File        : create_bdd_projet_web.sql
-- # Revision    : 18 mai 2018
-- # Author      : Urbain de l'Eprevier
-- # Function    : structure et alimentation de la base de donnees
-- ###################################################################

-- *********************
-- * Creation du schema
-- *********************

-- suppression des tables si besoin
DROP TABLE IF EXISTS Compte;
DROP TABLE IF EXISTS Utilisateur;
DROP TABLE IF EXISTS Administrateur;
DROP TABLE IF EXISTS Gestion;
DROP TABLE IF EXISTS Entreprise;
DROP TABLE IF EXISTS Restaurant;
DROP TABLE IF EXISTS Activite_culturelle;
DROP TABLE IF EXISTS Activite_sportive;



CREATE TABLE Compte
(
	pseudo VARCHAR(50),
	mdp VARCHAR(73) NOT NULL,
	prenom VARCHAR(50) NOT NULL,
	nom VARCHAR(50) NOT NULL,
	telephone VARCHAR(11),
	mail VARCHAR(50) NOT NULL,
	CONSTRAINT pk_Com PRIMARY KEY (pseudo)
);

CREATE TABLE Utilisateur
(
	id_user INTEGER,
	pseudo VARCHAR(50),
	CONSTRAINT pk_Uti PRIMARY KEY (id_user),
	CONSTRAINT fk_Uti FOREIGN KEY (pseudo) REFERENCES Compte (pseudo)
);


CREATE TABLE Administrateur
(
	id_admin INTEGER,
	pseudo VARCHAR(50),
	CONSTRAINT pk_Adm PRIMARY KEY (id_admin),
	CONSTRAINT fk_Adm FOREIGN KEY (pseudo) REFERENCES Compte (pseudo)
);


CREATE TABLE Entreprise
(
	id_ent INTEGER,
	adresse VARCHAR(200),
	ville VARCHAR(30),
	url VARCHAR(100),
	tel VARCHAR(11),
	reservation BOOLEAN,
	prix_moyen INTEGER,
	urli VARCHAR(100),
	CONSTRAINT pk_Ent PRIMARY KEY (id_ent)
);

CREATE TABLE Gestion
(
	id_admin INTEGER,
	id_ent INTEGER,
	poste VARCHAR(50),
	CONSTRAINT fk_Ges FOREIGN KEY (id_admin) REFERENCES Administrateur (id_admin),
	CONSTRAINT fk_Ges FOREIGN KEY (id_ent) REFERENCES Entreprise (id_ent)
);


CREATE TABLE Restaurant
(
	id_ent INTEGER,
	nom VARCHAR(50),
	description VARCHAR(500),
	CONSTRAINT pk_Res PRIMARY KEY (nom),
	CONSTRAINT fk_Res FOREIGN KEY (id_ent) REFERENCES Entreprise (id_ent)
);


CREATE TABLE Activite_culturelle
(
	id_ent INTEGER,
	nom VARCHAR(50),
	description VARCHAR(500),
	duree INTEGER,
	plage_horaire VARCHAR(25),
	nb_personne_min INTEGER,
	nb_personne_max INTEGER,
	CONSTRAINT pk_Cul PRIMARY KEY (nom),
	CONSTRAINT fk_Cul FOREIGN KEY (id_ent) REFERENCES Entreprise (id_ent)
);


CREATE TABLE Activite_sportive
(
	id_ent INTEGER,
	nom VARCHAR(50),
	description VARCHAR(500),
	plage_horaire VARCHAR(25),
	nb_personne_min INTEGER,
	nb_personne_max INTEGER,
	CONSTRAINT pk_Spo PRIMARY KEY (nom),
	CONSTRAINT fk_Spo FOREIGN KEY (id_ent) REFERENCES Entreprise (id_ent)
);



-- **************************
-- * Alimentation de la base
-- **************************

DELETE FROM Compte;
DELETE FROM Utilisateur;
DELETE FROM Administrateur;
DELETE FROM Entreprise;
DELETE FROM Gestion;
DELETE FROM Restaurant;
DELETE FROM Activite_culturelle;
DELETE FROM Activite_sportive;


--> table Compte
INSERT INTO Compte VALUES ('jean21', 'hjdfs65', 'Jean', 'LANTY', 0653986743, 'jean.lanty@gmail.com');
INSERT INTO Compte VALUES ('admin', '$2y$10$Uj54C66InETncJvKSUi0HOrv20GPgZO6wkDIQwOHCdPAoWGsxc2oq', 'admin', 'admin', 0673984672, 'admin@admin.ad');


--> table Utilisateur
INSERT INTO Utilisateur VALUES (1, 'jean21');

--> table Administrateur
INSERT INTO Administrateur VALUES (1, 'admin');


--> table Entreprise
INSERT INTO Entreprise VALUES (1, '12 cours Mgr Roméo', 'Evry','chemindehimalaya.fr' , '0160778745',true, '30','http://www.chemindehimalaya.fr/images/indexb1.jpg');
INSERT INTO Entreprise VALUES (2, 'centre commercial Evry2', 'Evry','evry2.wafflefactory.com' , '0964115593',false, '10','https://belgeat.files.wordpress.com/2013/09/twf-04.jpg?w=610&h=455');
INSERT INTO Entreprise VALUES (3, 'centre commercial Evry2', 'Evry','evry2.com' , '0169363109',false, '20','https://s3-media2.fl.yelpcdn.com/bphoto/aQYBUXtX40G5wMrkpI7lKg/l.jpg');
INSERT INTO Entreprise VALUES (4, 'clos de la cathédrale', 'Evry','museepauldelouvrier.fr' , '0160750271',false, '10','http://www.leparisien.fr/images/2016/02/25/cda3eb5c-dbec-11e5-83a5-001517810e22_1.jpg');
INSERT INTO Entreprise VALUES (5, '8 rue francois mauriac', 'Evry','khanhanh.fr' , '0164935556',false, '0','https://hoavouu.com/images/file/3NtYfWIx0QgBAPRx/chua-khanh-anh-26.jpg');
INSERT INTO Entreprise VALUES (6, '20 rue du cantal', 'Evry','blockout.fr' , '0160862689',false, '20','http://www.grimper.com/media/guide_salles/img_salles/block_starsbourg3.jpg');

--> table Gestion
INSERT INTO Gestion VALUES (1, 1, 'Gérant');


--> table Restaurant
INSERT INTO Restaurant VALUES (1, 'Le chemin dHymalaya', 'plats indo-népalais');
INSERT INTO Restaurant VALUES (2, 'the waffle factory', 'restauration sur place ou à emporter');
INSERT INTO Restaurant VALUES (3, 'Okinawa Sushi Bar', 'restauration de sushi');

--> table Activite_culturelle
INSERT INTO Activite_culturelle VALUES (4, 'Musée Paul Delouvrier', 'musée consacré a Paul Delouvrier, père des villes nouvelle de region parisienne"','1' ,'journee', 1, 100);
INSERT INTO Activite_culturelle VALUES (6, 'Pagode Chua khanh anh', 'pagode boudiste',1, 'journee', 1, 100);

--> table Activite_sportive
INSERT INTO Activite_sportive VALUES (1, 'block Out', 'escalade en salle', 'journee',1, 20);
