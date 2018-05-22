CREATE TABLE "utilisateur" (
       nom VARCHAR(16) PRIMARY KEY,
       mdp VARCHAR(16) NOT NULL,
       e_fav VARCHAR(20),
       score INT,
       description VARCHAR(200),
       administrateur BOOLEAN);

CREATE TABLE "groupe" (
       id_grp INT NOT NULL,
       utilisateur_n VARCHAR(16) REFERENCES utilisateur(nom) NOT NULL,
       solde INT,
       balance INT,
       PRIMARY KEY (id_grp, utilisateur_n));

CREATE TABLE "matchs" (
       nom_match VARCHAR(43) PRIMARY KEY,
       date_m DATE NOT NULL,
       resultat VARCHAR(1),
       cote_1 INT,
       cote_N INT,
       cote_2 INT);

CREATE TABLE "pronostics" (
       utilisateur_n VARCHAR(16) REFERENCES utilisateur(nom) NOT NULL,
       id_grp INT  NOT NULL,
       match_n VARCHAR(43) REFERENCES matchs(nom_match) NOT NULL,
       mise INT,
       pron VARCHAR(1),
       FOREIGN KEY (id_grp,utilisateur_n) REFERENCES groupe(id_grp,utilisateur_n),
       PRIMARY KEY (utilisateur_n,id_grp,match_n));

CREATE TABLE "equipe" (
       nom VARCHAR(20) PRIMARY KEY,
       lien_ecusson VARCHAR(200));

INSERT INTO "utilisateur"(nom, mdp, administrateur) VALUES ('Admin', 'Admin', TRUE);


INSERT INTO "equipe"(nom,lien_ecusson) VALUES ('Paris SG','paris.svg');
INSERT INTO "equipe"(nom,lien_ecusson) VALUES ('AS Saint-Etienne','asse.png');
INSERT INTO "equipe"(nom,lien_ecusson) VALUES ('AS Monaco','monaco.png');
INSERT INTO "equipe"(nom,lien_ecusson) VALUES ('O Lyon','lyon.jpg');
INSERT INTO "equipe"(nom,lien_ecusson) VALUES ('O Marseille','marseille.jpg');
INSERT INTO "equipe"(nom,lien_ecusson) VALUES ('OGC Nice','nice.jpg');
INSERT INTO "equipe"(nom,lien_ecusson) VALUES ('Gd Bordeaux','bordeaux.png');
INSERT INTO "equipe"(nom,lien_ecusson) VALUES ('S Rennes','rennes.png');
INSERT INTO "equipe"(nom,lien_ecusson) VALUES ('EA Guingamp','guingamp.jpeg');
INSERT INTO "equipe"(nom,lien_ecusson) VALUES ('RC Strasbourg','strasbourg.svg');
INSERT INTO "equipe"(nom,lien_ecusson) VALUES ('AS Amiens','amiens.svg');
INSERT INTO "equipe"(nom,lien_ecusson) VALUES ('Lille OSC','lille.png');
INSERT INTO "equipe"(nom,lien_ecusson) VALUES ('SCO Angers','anger.png');
INSERT INTO "equipe"(nom,lien_ecusson) VALUES ('ESTAC Troyes','troyes.png');
INSERT INTO "equipe"(nom,lien_ecusson) VALUES ('FC Nantes','nantes.png');
INSERT INTO "equipe"(nom,lien_ecusson) VALUES ('Dijon FCO','dijon.jpg');
INSERT INTO "equipe"(nom,lien_ecusson) VALUES ('Toulouse FC','toulouse.png');
INSERT INTO "equipe"(nom,lien_ecusson) VALUES ('SM Caen','caen.svg');
INSERT INTO "equipe"(nom,lien_ecusson) VALUES ('Montpellier HSC','montpellier.svg');
INSERT INTO "equipe"(nom,lien_ecusson) VALUES ('FC Metz','metz.png');

       
