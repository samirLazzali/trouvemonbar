CREATE TABLE "users" (
    pseudo VARCHAR(20) PRIMARY KEY,
    mdp    VARCHAR       NOT NULL ,
    birthday date,
	  admin boolean NOT NULL
);
INSERT INTO "users"(pseudo, mdp, admin) VALUES ('Skoli', 'Skoli', 'TRUE');
INSERT INTO "users"(pseudo, mdp, admin) VALUES ('Kouri', 'Kouri', 'TRUE');
INSERT INTO "users"(pseudo, mdp, admin) VALUES ('16', '16', 'TRUE');
INSERT INTO "users"(pseudo, mdp, admin) VALUES ('Yuze', 'Yuze', 'TRUE');
INSERT INTO "users"(pseudo, mdp, admin) VALUES ('visiteur', 'visiteur', 'FALSE');
INSERT INTO "users"(pseudo, mdp, admin) VALUES ('visiteur1', 'visiteur', 'FALSE');
INSERT INTO "users"(pseudo, mdp, admin) VALUES ('visiteur2', 'visiteur', 'FALSE');

CREATE TYPE statutdumanga AS ENUM('coming soon','en cours','terminé');
CREATE TYPE genredumanga AS ENUM('shonen','seinen','shojo');

CREATE TABLE "manga" (
       nom    VARCHAR	PRIMARY KEY,
       auteur VARCHAR 	NOT NULL,
       genre  genredumanga,
       statut statutdumanga NOT NULL,
       note     INT,
       nb_notes INT,
       nb_chap  INT,
       debut DATE,
       fin   DATE,
       description VARCHAR(2000)
);

       
CREATE TABLE "chapitre" (
       nom VARCHAR,
       num INT,
       nb_pages INT,
       nom_manga VARCHAR,
       date_pub TIMESTAMP,

       CONSTRAINT fk_chap_manga FOREIGN KEY (nom_manga)
       REFERENCES manga(nom)
);


CREATE TABLE "biblio"(
       id SERIAL PRIMARY KEY,
       pseudo VARCHAR(20) NOT NULL,
       manga   VARCHAR	NOT NULL,
       stat_lect VARCHAR,
       note INT,
       comm VARCHAR,

       CONSTRAINT fk_biblio_users FOREIGN KEY (pseudo)
	REFERENCES users(pseudo),
       CONSTRAINT fk_biblio_manga FOREIGN KEY (manga)
        REFERENCES manga(nom)
);



