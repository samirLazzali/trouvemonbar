CREATE TABLE "candidat" (
    id_candidat SERIAL PRIMARY KEY ,
    prenom_c VARCHAR NOT NULL ,
    nom_c VARCHAR NOT NULL ,
    pseudo_c VARCHAR NOT NULL ,
    mdp_c VARCHAR NOT NULL ,
    description TEXT DEFAULT 'Pas de description renseignée' ,
    photo VARCHAR DEFAULT ' ' 
);
CREATE TABLE "jury" (
	id_jury SERIAL PRIMARY KEY ,
	prenom_j VARCHAR NOT NULL ,
    nom_j VARCHAR NOT NULL ,
    pseudo_j VARCHAR NOT NULL ,
    mdp_j VARCHAR NOT NULL
);

CREATE TABLE "admin" (
	id_admin SERIAL PRIMARY KEY ,
	prenom_a VARCHAR NOT NULL ,
    nom_a VARCHAR NOT NULL ,
    pseudo_a VARCHAR NOT NULL ,
    mdp_a VARCHAR NOT NULL
);


CREATE TABLE "epreuve" (
	id_epreuve SERIAL PRIMARY KEY ,
	nom_e VARCHAR NOT NULL ,
	date_e DATE ,
	description_e TEXT DEFAULT 'Pas de description renseignée'

);

CREATE TABLE "candidat_epreuve" (
	id_epreuve SERIAL REFERENCES epreuve ON UPDATE CASCADE,
	id_candidat SERIAL REFERENCES candidat ON UPDATE CASCADE,
	id_jury SERIAL REFERENCES jury ON UPDATE CASCADE,
	CONSTRAINT id_jec PRIMARY KEY (id_jury,id_candidat,id_epreuve) ,
	note NUMERIC DEFAULT 0
);



INSERT INTO "candidat"(id_candidat,prenom_c,nom_c,pseudo_c,mdp_c) VALUES('1','Sujivan', 'Nithiyarajan','Suji','kumar');
INSERT INTO "candidat"(id_candidat,prenom_c,nom_c,pseudo_c,mdp_c) VALUES('2','Donovan', 'Thym','Dono','sujiv');
INSERT INTO "jury"(id_jury,prenom_j,nom_j,pseudo_j,mdp_j) VALUES('1','Afizullah','Rahmany','Prophète','prophete');
INSERT INTO "epreuve"(id_epreuve,nom_e,date_e) VALUES(1,'Poteaux','2018-06-15');
INSERT INTO "epreuve"(id_epreuve,nom_e,date_e) VALUES(2,'Apnée','2018-06-10');
INSERT INTO "admin"(id_admin,prenom_a,nom_a,pseudo_a,mdp_a) VALUES('1','Nithar','Kumar','KUMAR','sujivan');