DROP TABLE IF EXISTS "user","Evenements","Musique","Type","Groupe";

/*Utilisateurs*/
CREATE TABLE "user" (
    id SERIAL PRIMARY KEY ,
    firstname VARCHAR ,
    lastname VARCHAR ,
    birthday date ,
    nickname VARCHAR NOT NULL ,
    domicile VARCHAR ,
    mdp VARCHAR ,
    id_groupe INT NOT NULL
    );

INSERT INTO "user"(firstname, lastname, birthday,nickname,domicile,mdp,id_groupe) VALUES ('Jo', 'Doe', '1967-11-22','Johnny','Grigny-La-Grande-Borne','ab4f63f9ac65152575886860dde480a1',1);
INSERT INTO "user"(firstname, lastname, birthday,nickname,domicile,mdp,id_groupe) VALUES ('Yvette', 'Angel', '1932-01-24','Yvi','Aulnay-Sous-Bois','ab4f63f9ac65152575886860dde480a1',1);
INSERT INTO "user"(firstname, lastname, birthday,nickname,domicile,mdp,id_groupe) VALUES ('Amelia', 'Waters', '1981-12-01','Meli','Sevran',NULL,1);
INSERT INTO "user"(firstname, lastname, birthday,nickname,domicile,mdp,id_groupe) VALUES ('Manuel', 'Holloway', '1979-07-25','Manu','Corbeil-Essonne',NULL,1);
INSERT INTO "user"(firstname, lastname, birthday,nickname,domicile,mdp,id_groupe) VALUES ('Alonzo', 'Erickson', '1947-11-13','Pataya','Marseille',NULL,1);
INSERT INTO "user"(firstname, lastname, birthday,nickname,domicile,mdp,id_groupe) VALUES ('Otis', 'Roberson', '1995-01-09','Oto','Paris7',NULL,1);
INSERT INTO "user"(firstname, lastname, birthday,nickname,domicile,mdp,id_groupe) VALUES ('Jaime', 'King', '1924-05-30','Jam','Sarcelles',NULL,1);
INSERT INTO "user"(firstname, lastname, birthday,nickname,domicile,mdp,id_groupe) VALUES ('Vicky', 'Pearson', '1982-12-12','Vic','Sevrac',NULL,1);
INSERT INTO "user"(firstname, lastname, birthday,nickname,domicile,mdp,id_groupe) VALUES ('Silvia', 'Mcguire', '1971-03-02','Sil','Evry',NULL,1);
INSERT INTO "user"(firstname, lastname, birthday,nickname,domicile,mdp,id_groupe) VALUES ('Brendan', 'Pena', '1950-02-17','Bren','Evry',NULL,1);
INSERT INTO "user"(firstname, lastname, birthday,nickname,domicile,mdp,id_groupe) VALUES ('Jackie', 'Cohen', '1967-01-27','Jack','Orangis',NULL,1);
INSERT INTO "user"(firstname, lastname, birthday,nickname,domicile,mdp,id_groupe) VALUES ('Delores', 'Williamson', '1961-07-19','Delo','Creteil',NULL,1);
INSERT INTO "user"(firstname,lastname,birthday,nickname,domicile,mdp,id_groupe) VALUES ('Martin','Dufour','1997-08-27','Feuj','Strasbourg',NULL,2);
INSERT INTO "user"(firstname,lastname,birthday,nickname,domicile,mdp,id_groupe) VALUES ('Hugues','Genin','1998-02-14','Barnum','Jenlain',NULL,2);
INSERT INTO "user"(firstname,lastname,birthday,nickname,domicile,mdp,id_groupe) VALUES ('Quentin','Pichollet','1997-08-19','Pichet','Orléans','2f3497b77103fbaa8794550ed1c2c75b',2);
INSERT INTO "user"(firstname,lastname,birthday,nickname,domicile,mdp,id_groupe) VALUES ('Christian','Morello','1997-11-01','Leji','Besançon',NULL,2);
/*Evenements*/
CREATE TABLE "Evenements" (
       id SERIAL PRIMARY KEY ,
       nom VARCHAR NOT NULL ,
       lieu VARCHAR NOT NULL ,
       dates date,
       bifore VARCHAR ,
       prix INT NOT NULL 
);

INSERT INTO "Evenements"(nom,lieu,dates,bifore,prix) VALUES ('SoiréeOr','ENSIIE','2018-04-26','Grotte',0);
INSERT INTO "Evenements"(nom,lieu,dates,bifore,prix) VALUES ('CannabisCup','LeQuai(C)','2018-04-26',NULL,20);
INSERT INTO "Evenements"(nom,lieu,dates,bifore,prix) VALUES ('TournéeDesBars','Paris','2018-04-30','Gynécoloc',12);

/*Style de musique pour les evenements*/
CREATE TABLE "Musique" (
       id SERIAL PRIMARY KEY ,
       styles VARCHAR NOT NULL 
);
INSERT INTO "Musique"(styles) VALUES ('Hip-Hop');
INSERT INTO "Musique"(styles) VALUES ('Rap');
INSERT INTO "Musique"(styles) VALUES ('RnB');
INSERT INTO "Musique"(styles) VALUES ('Pop');
INSERT INTO "Musique"(styles) VALUES ('Soul');
INSERT INTO "Musique"(styles) VALUES ('Jazz');
INSERT INTO "Musique"(styles) VALUES ('Blues');
INSERT INTO "Musique"(styles) VALUES ('Rock');
INSERT INTO "Musique"(styles) VALUES ('Metal');
INSERT INTO "Musique"(styles) VALUES ('Electro');
INSERT INTO "Musique"(styles) VALUES ('House');
INSERT INTO "Musique"(styles) VALUES ('Hardtek');

/* Type de soirée*/
CREATE TABLE "Type" (
       id SERIAL PRIMARY KEY ,
       genre VARCHAR NOT NULL );
INSERT INTO "Type"(genre) VALUES ('Aperal');
INSERT INTO "Type"(genre) VALUES ('Discothèque');
INSERT INTO "Type"(genre) VALUES ('Ecole');
INSERT INTO "Type"(genre) VALUES ('Bar');

/*Membre ou admin?*/
CREATE TABLE "Groupe" (
       id SERIAL PRIMARY KEY ,
       statut VARCHAR NOT NULL
);

INSERT INTO "Groupe"(statut) VALUES ('Membre');
INSERT INTO "Groupe"(statut) VALUES ('Administrateur');
 

       
       
     
