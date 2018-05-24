/*CREATE TABLE "user" (
    id SERIAL PRIMARY KEY ,
    firstname VARCHAR NOT NULL ,
    lastname VARCHAR NOT NULL ,
    birthday date
);

INSERT INTO "user"(firstname, lastname, birthday) VALUES ('John', 'Doe', '1967-11-22');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Yvette', 'Angel', '1932-01-24');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Amelia', 'Waters', '1981-12-01');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Manuel', 'Holloway', '1979-07-25');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Alonzo', 'Erickson', '1947-11-13');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Otis', 'Roberson', '1995-01-09');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Jaime', 'King', '1924-05-30');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Vicky', 'Pearson', '1982-12-12)');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Silvia', 'Mcguire', '1971-03-02');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Brendan', 'Pena', '1950-02-17');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Jackie', 'Cohen', '1967-01-27');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Delores', 'Williamson', '1961-07-19');
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema projet_bda
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema projet_bda
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS "projet_bda" DEFAULT CHARACTER SET utf8 ;
USE "projet_bda" ;

-- -----------------------------------------------------
-- Table "projet_bda"."Lieux"
-- -----------------------------------------------------
DROP TABLE IF EXISTS "projet_bda"."Lieux" ;

CREATE TABLE IF NOT EXISTS "projet_bda"."Lieux" (
    "localisation" VARCHAR(50) NOT NULL,
    "nom" VARCHAR(45) NULL,
    "description" TEXT NULL,
PRIMARY KEY ("localisation"))
    ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table "projet_bda"."Oeuvre"
-- -----------------------------------------------------
DROP TABLE IF EXISTS "projet_bda"."Oeuvre" ;

CREATE TABLE IF NOT EXISTS "projet_bda"."Oeuvre" (
    "id_oeuvre" INT NOT NULL AUTO_INCREMENT,
    "titre" TEXT NULL,
    "date" DATE NULL,
    "createur" VARCHAR(45) NULL,
    "type" VARCHAR(45) NULL,
    "Oeuvre_id_oeuvre" INT NOT NULL,
PRIMARY KEY ("id_oeuvre", "Oeuvre_id_oeuvre"))
    ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table "projet_bda"."Idees"
-- -----------------------------------------------------
DROP TABLE IF EXISTS "projet_bda"."Idees" ;

CREATE TABLE IF NOT EXISTS "projet_bda"."Idees" (
    "id_idee" INT NOT NULL,
PRIMARY KEY ("id_idee"))
    ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table "projet_bda"."Sortie"
-- -----------------------------------------------------
DROP TABLE IF EXISTS "projet_bda"."Sortie" ;

CREATE TABLE IF NOT EXISTS "projet_bda"."Sortie" (
    "id_sortie" INT NOT NULL AUTO_INCREMENT,
    "date" DATE NULL,
    "titre" TEXT NULL,
    "description" TEXT NULL,
    "Idees_id_idee" INT NULL,
    "Lieux_localisation" VARCHAR(50) NULL,
PRIMARY KEY ("id_sortie"),
INDEX "fk_Sortie_Idees1_idx" ("Idees_id_idee" ASC),
INDEX "fk_Sortie_Lieux1_idx" ("Lieux_localisation" ASC))
    ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table "projet_bda"."Spectacle"
-- -----------------------------------------------------
DROP TABLE IF EXISTS "projet_bda"."Spectacle" ;

CREATE TABLE IF NOT EXISTS "projet_bda"."Spectacle" (
    "id_spectacle" INT NOT NULL AUTO_INCREMENT,
    "date" DATE NOT NULL,
    "description" TEXT NULL,
    "Lieux_localisation" VARCHAR(50) NOT NULL,
    "Oeuvre_id_oeuvre" INT NOT NULL,
    "Sortie_id_sortie" INT NULL,
PRIMARY KEY ("id_spectacle"),
INDEX "fk_Spectacle_Lieux1_idx" ("Lieux_localisation" ASC),
INDEX "fk_Spectacle_Oeuvre1_idx" ("Oeuvre_id_oeuvre" ASC),
INDEX "fk_Spectacle_Sortie1_idx" ("Sortie_id_sortie" ASC))
    ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table "projet_bda"."Associations"
-- -----------------------------------------------------
DROP TABLE IF EXISTS "projet_bda"."Associations" ;

CREATE TABLE IF NOT EXISTS "projet_bda"."Associations" (
    "nom" VARCHAR(50) NOT NULL,
    "lien" VARCHAR(255) NULL,
    "icone" LONGBLOB NULL,
    "description" TEXT NULL,
PRIMARY KEY ("nom"))
    ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table "projet_bda"."Personne"
-- -----------------------------------------------------
DROP TABLE IF EXISTS "projet_bda"."Personne" ;

CREATE TABLE IF NOT EXISTS "projet_bda"."Personne" (
    "identifiant" INT NOT NULL AUTO_INCREMENT,
    "nom" VARCHAR(45) NULL,
    "prenom" VARCHAR(45) NULL,
PRIMARY KEY ("identifiant"))
    ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table "projet_bda"."Eleve"
-- -----------------------------------------------------
DROP TABLE IF EXISTS "projet_bda"."Eleve" ;

CREATE TABLE IF NOT EXISTS "projet_bda"."Eleve" (
    "id_eleve" INT NOT NULL AUTO_INCREMENT,
    "pseudo" VARCHAR(45) NULL,
    "mdp" VARCHAR(255) NULL,
    "droits" TEXT NULL,
    "Personne_identifiant" INT NOT NULL,
PRIMARY KEY ("id_eleve", "Personne_identifiant"),
INDEX "fk_Eleve_Personne1_idx" ("Personne_identifiant" ASC))
    ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table "projet_bda"."Newsletter"
-- -----------------------------------------------------
DROP TABLE IF EXISTS "projet_bda"."Newsletter" ;

CREATE TABLE IF NOT EXISTS "projet_bda"."Newsletter" (
    "date" DATE NOT NULL,
    "doc" TEXT NULL,
PRIMARY KEY ("date"))
    ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table "projet_bda"."Artiste"
-- -----------------------------------------------------
DROP TABLE IF EXISTS "projet_bda"."Artiste" ;

CREATE TABLE IF NOT EXISTS "projet_bda"."Artiste" (
    "nom_artiste" INT NOT NULL AUTO_INCREMENT,
    "Personne_identifiant" INT NOT NULL,
PRIMARY KEY ("nom_artiste", "Personne_identifiant"),
INDEX "fk_Artiste_Personne1_idx" ("Personne_identifiant" ASC))
    ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table "projet_bda"."Newsletter_informe_Sortie"
-- -----------------------------------------------------
DROP TABLE IF EXISTS "projet_bda"."Newsletter_informe_Sortie" ;

CREATE TABLE IF NOT EXISTS "projet_bda"."Newsletter_informe_Sortie" (
    "Newsletter_date" DATE NOT NULL,
    "Sortie_id_sortie" INT NOT NULL,
PRIMARY KEY ("Newsletter_date", "Sortie_id_sortie"),
INDEX "fk_Newsletter_has_Sortie_Sortie1_idx" ("Sortie_id_sortie" ASC),
INDEX "fk_Newsletter_has_Sortie_Newsletter_idx" ("Newsletter_date" ASC))
    ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table "projet_bda"."Artiste_represente_Oeuvre"
-- -----------------------------------------------------
DROP TABLE IF EXISTS "projet_bda"."Artiste_represente_Oeuvre" ;

CREATE TABLE IF NOT EXISTS "projet_bda"."Artiste_represente_Oeuvre" (
    "Artiste_nom_artiste" INT NOT NULL,
    "Oeuvre_id_oeuvre" INT NOT NULL,
PRIMARY KEY ("Artiste_nom_artiste", "Oeuvre_id_oeuvre"),
INDEX "fk_Artiste_has_Oeuvre_Oeuvre1_idx" ("Oeuvre_id_oeuvre" ASC),
INDEX "fk_Artiste_has_Oeuvre_Artiste1_idx" ("Artiste_nom_artiste" ASC))
    ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table "projet_bda"."Artiste_participe_Oeuvre"
-- -----------------------------------------------------
DROP TABLE IF EXISTS "projet_bda"."Artiste_participe_Oeuvre" ;

CREATE TABLE IF NOT EXISTS "projet_bda"."Artiste_participe_Oeuvre" (
    "Artiste_nom_artiste" INT NOT NULL,
    "Oeuvre_id_oeuvre" INT NOT NULL,
PRIMARY KEY ("Artiste_nom_artiste", "Oeuvre_id_oeuvre"),
INDEX "fk_Artiste_has_Oeuvre_Oeuvre2_idx" ("Oeuvre_id_oeuvre" ASC),
INDEX "fk_Artiste_has_Oeuvre_Artiste2_idx" ("Artiste_nom_artiste" ASC))
    ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table "projet_bda"."Artiste_cree_Oeuvre"
-- -----------------------------------------------------
DROP TABLE IF EXISTS "projet_bda"."Artiste_cree_Oeuvre" ;

CREATE TABLE IF NOT EXISTS "projet_bda"."Artiste_cree_Oeuvre" (
    "Oeuvre_id_oeuvre" INT NOT NULL,
    "Artiste_nom_artiste" INT NOT NULL,
PRIMARY KEY ("Oeuvre_id_oeuvre", "Artiste_nom_artiste"),
INDEX "fk_Oeuvre_has_Artiste_Artiste1_idx" ("Artiste_nom_artiste" ASC),
INDEX "fk_Oeuvre_has_Artiste_Oeuvre1_idx" ("Oeuvre_id_oeuvre" ASC))
    ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table "projet_bda"."Newsletter_informe_Oeuvre"
-- -----------------------------------------------------
DROP TABLE IF EXISTS "projet_bda"."Newsletter_informe_Oeuvre" ;

CREATE TABLE IF NOT EXISTS "projet_bda"."Newsletter_informe_Oeuvre" (
    "Oeuvre_id_oeuvre" INT NOT NULL,
    "Newsletter_date" DATE NOT NULL,
PRIMARY KEY ("Oeuvre_id_oeuvre", "Newsletter_date"),
INDEX "fk_Oeuvre_has_Newsletter_Newsletter1_idx" ("Newsletter_date" ASC),
INDEX "fk_Oeuvre_has_Newsletter_Oeuvre1_idx" ("Oeuvre_id_oeuvre" ASC))
    ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table "projet_bda"."Eleve_participe_Sortie"
-- -----------------------------------------------------
DROP TABLE IF EXISTS "projet_bda"."Eleve_participe_Sortie" ;

CREATE TABLE IF NOT EXISTS "projet_bda"."Eleve_participe_Sortie" (
    "Eleve_id_eleve" INT NOT NULL,
    "Sortie_id_sortie" INT NOT NULL,
PRIMARY KEY ("Eleve_id_eleve", "Sortie_id_sortie"),
INDEX "fk_Eleve_has_Sortie_Sortie1_idx" ("Sortie_id_sortie" ASC),
INDEX "fk_Eleve_has_Sortie_Eleve1_idx" ("Eleve_id_eleve" ASC))
    ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table "projet_bda"."concert_de"
-- -----------------------------------------------------
DROP TABLE IF EXISTS "projet_bda"."concert_de" ;

CREATE TABLE IF NOT EXISTS "projet_bda"."concert_de" (
    "Oeuvre_id_oeuvre" INT NOT NULL,
    "Oeuvre_Oeuvre_id_oeuvre" INT NOT NULL,
    "Oeuvre_id_oeuvre1" INT NOT NULL,
    "Oeuvre_Oeuvre_id_oeuvre1" INT NOT NULL,
PRIMARY KEY ("Oeuvre_id_oeuvre", "Oeuvre_Oeuvre_id_oeuvre", "Oeuvre_id_oeuvre1", "Oeuvre_Oeuvre_id_oeuvre1"),
INDEX "fk_Oeuvre_has_Oeuvre_Oeuvre2_idx" ("Oeuvre_id_oeuvre1" ASC, "Oeuvre_Oeuvre_id_oeuvre1" ASC),
INDEX "fk_Oeuvre_has_Oeuvre_Oeuvre1_idx" ("Oeuvre_id_oeuvre" ASC, "Oeuvre_Oeuvre_id_oeuvre" ASC))
    ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table "projet_bda"."contenu_dans"
-- -----------------------------------------------------
DROP TABLE IF EXISTS "projet_bda"."contenu_dans" ;

CREATE TABLE IF NOT EXISTS "projet_bda"."contenu_dans" (
    "Oeuvre_id_oeuvre" INT NOT NULL,
    "Oeuvre_Oeuvre_id_oeuvre" INT NOT NULL,
    "Oeuvre_id_oeuvre1" INT NOT NULL,
    "Oeuvre_Oeuvre_id_oeuvre1" INT NOT NULL,
PRIMARY KEY ("Oeuvre_id_oeuvre", "Oeuvre_Oeuvre_id_oeuvre", "Oeuvre_id_oeuvre1", "Oeuvre_Oeuvre_id_oeuvre1"),
INDEX "fk_Oeuvre_has_Oeuvre_Oeuvre4_idx" ("Oeuvre_id_oeuvre1" ASC, "Oeuvre_Oeuvre_id_oeuvre1" ASC),
INDEX "fk_Oeuvre_has_Oeuvre_Oeuvre3_idx" ("Oeuvre_id_oeuvre" ASC, "Oeuvre_Oeuvre_id_oeuvre" ASC))
    ENGINE = MyISAM;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS; */

-- -----------------------------------------------------
-- Schema projet_bda
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS "projet_bda"  ;

-- -----------------------------------------------------
-- Table "projet_bda"."Lieux"
-- -----------------------------------------------------
DROP TABLE IF EXISTS "projet_bda"."Lieux" CASCADE;

CREATE TABLE IF NOT EXISTS "projet_bda"."Lieux" (
  "localisation" VARCHAR(50) NOT NULL,
  "nom" VARCHAR(45) NULL,
  "description" TEXT NULL,
PRIMARY KEY ("localisation"));
INSERT INTO "projet_bda"."Lieux" (localisation,nom,description) VALUES ('Bastille','Opera Bastille','Opera place Bastille');

-- -----------------------------------------------------
-- Table "projet_bda"."Oeuvre"
-- -----------------------------------------------------
DROP TABLE IF EXISTS "projet_bda"."Oeuvre" CASCADE;

CREATE TABLE IF NOT EXISTS "projet_bda"."Oeuvre" (
  "id_oeuvre" SERIAL ,
  "titre" TEXT NULL,
  "date" DATE NULL,
  "createur" VARCHAR(45) NULL,
  "type" VARCHAR(45) NULL,
PRIMARY KEY ("id_oeuvre"));



-- -----------------------------------------------------
-- Table "projet_bda"."Idees"
-- -----------------------------------------------------
DROP TABLE IF EXISTS "projet_bda"."Idees" CASCADE;

CREATE TABLE IF NOT EXISTS "projet_bda"."Idees" (
  "id_idee" INT NOT NULL,
PRIMARY KEY ("id_idee"));



-- -----------------------------------------------------
-- Table "projet_bda"."Sortie"
-- -----------------------------------------------------
DROP TABLE IF EXISTS "projet_bda"."Sortie" CASCADE;

CREATE TABLE IF NOT EXISTS "projet_bda"."Sortie" (
  "id_sortie" SERIAL ,
  "date" DATE NULL,
  "titre" TEXT NULL,
  "description" TEXT NULL,
  "Idees_id_idee" INT REFERENCES "projet_bda"."Idees" ON DELETE CASCADE,
  "Lieux_localisation" VARCHAR(50) REFERENCES "projet_bda"."Lieux" ON DELETE CASCADE,
PRIMARY KEY ("id_sortie"));
/*INDEX "fk_Sortie_Idees1_idx" ("Idees_id_idee" ASC),
INDEX "fk_Sortie_Lieux1_idx" ("Lieux_localisation" ASC));
*/

INSERT INTO "projet_bda"."Sortie" (date,titre,description,"Lieux_localisation") VALUES ('2018-05-20','Parsifal','Operas de Richard Wagner','Bastille');
INSERT INTO "projet_bda"."Sortie" (date,titre,description,"Lieux_localisation") VALUES ('2019-06-20','Casse-noisette','Operas de Tcheïkovski','Bastille');
-- -----------------------------------------------------
-- Table "projet_bda"."Spectacle"
-- -----------------------------------------------------
DROP TABLE IF EXISTS "projet_bda"."Spectacle" CASCADE;

CREATE TABLE IF NOT EXISTS "projet_bda"."Spectacle" (
  "id_spectacle" SERIAL  ,
  "date" DATE NOT NULL,
  "description" TEXT NULL,
  "Lieux_localisation" VARCHAR(50) NOT NULL REFERENCES "projet_bda"."Lieux" ON DELETE CASCADE,
  "Oeuvre_id_oeuvre" INT NOT NULL REFERENCES "projet_bda"."Oeuvre" ON DELETE CASCADE,
  "Sortie_id_sortie" INT NULL REFERENCES "projet_bda"."Sortie" ON DELETE CASCADE,
PRIMARY KEY ("id_spectacle"));
/*INDEX "fk_Spectacle_Lieux1_idx" ("Lieux_localisation" ASC),
INDEX "fk_Spectacle_Oeuvre1_idx" ("Oeuvre_id_oeuvre" ASC),
INDEX "fk_Spectacle_Sortie1_idx" ("Sortie_id_sortie" ASC));*/



-- -----------------------------------------------------
-- Table "projet_bda"."Associations"
-- -----------------------------------------------------
DROP TABLE IF EXISTS "projet_bda"."Associations" CASCADE;

CREATE TABLE IF NOT EXISTS "projet_bda"."Associations" (
  "nom" VARCHAR(50) NOT NULL,
  "lien" VARCHAR(255) NULL,
  "icone" BYTEA NULL,
  "description" TEXT NULL,
PRIMARY KEY ("nom"));



-- -----------------------------------------------------
-- Table "projet_bda"."Personne"
-- -----------------------------------------------------
DROP TABLE IF EXISTS "projet_bda"."Personne" CASCADE;

CREATE TABLE IF NOT EXISTS "projet_bda"."Personne" (
  "identifiant" INT,
  "nom" VARCHAR(45) NULL,
  "prenom" VARCHAR(45) NULL,
PRIMARY KEY ("identifiant"));
INSERT INTO "projet_bda"."Personne" (nom,prenom,identifiant) VALUES ('Ferreri','Mickael',0);
INSERT INTO "projet_bda"."Personne" (nom,prenom,identifiant) VALUES ('Ravel','Charles',1);
INSERT INTO "projet_bda"."Personne" (nom,prenom,identifiant) VALUES ('Wagner','Richard',2);
INSERT INTO "projet_bda"."Personne" (nom,prenom,identifiant) VALUES ('Fort','Emilie',3);


-- -----------------------------------------------------
-- Table "projet_bda"."Eleve"
-- -----------------------------------------------------
DROP TABLE IF EXISTS "projet_bda"."Eleve" CASCADE;

CREATE TABLE IF NOT EXISTS "projet_bda"."Eleve" (
  "id_eleve" VARCHAR(45) ,
  "pseudo" VARCHAR(45) NULL,
  "mdp" VARCHAR(255) NULL,
  "droits" TEXT NULL,
  "Personne_identifiant" INT NOT NULL REFERENCES "projet_bda"."Personne" ON DELETE CASCADE,
PRIMARY KEY ("id_eleve"));

INSERT INTO "projet_bda"."Eleve" (id_eleve,pseudo, mdp, droits, "Personne_identifiant") VALUES ('Rainman','Rainman','1f71e0f4ac9b47cd93bf269e4017abaab9d3bd63',2,0);
INSERT INTO "projet_bda"."Eleve" (id_eleve,pseudo, mdp, droits, "Personne_identifiant") VALUES ('Xorl','Xorl','1f71e0f4ac9b47cd93bf269e4017abaab9d3bd63',1,1);
/*INDEX "fk_Eleve_Personne1_idx" ("Personne_identifiant" ASC));*/



-- -----------------------------------------------------
-- Table "projet_bda"."Newsletter"
-- -----------------------------------------------------
DROP TABLE IF EXISTS "projet_bda"."Newsletter" CASCADE;

CREATE TABLE IF NOT EXISTS "projet_bda"."Newsletter" (
  "date" DATE NOT NULL,
  "doc" TEXT NULL,
PRIMARY KEY ("date"));
INSERT INTO "projet_bda"."Newsletter" (date,doc) VALUES ('2018-05-20','Ceci est un texte de newsletter');


-- -----------------------------------------------------
-- Table "projet_bda"."Artiste"
-- -----------------------------------------------------
DROP TABLE IF EXISTS "projet_bda"."Artiste" CASCADE;

CREATE TABLE IF NOT EXISTS "projet_bda"."Artiste" (
  "nom_artiste" VARCHAR(45),
  "Personne_identifiant" INT NOT NULL REFERENCES "projet_bda"."Personne" ,
PRIMARY KEY ("Personne_identifiant"));
/*INDEX "fk_Artiste_Personne1_idx" ("Personne_identifiant" ASC));*/



-- -----------------------------------------------------
-- Table "projet_bda"."Newsletter_informe_Sortie"
-- -----------------------------------------------------
DROP TABLE IF EXISTS "projet_bda"."Newsletter_informe_Sortie" CASCADE;

CREATE TABLE IF NOT EXISTS "projet_bda"."Newsletter_informe_Sortie" (
  "Newsletter_date" DATE NOT NULL REFERENCES "projet_bda"."Newsletter" ON DELETE CASCADE,
  "Sortie_id_sortie" INT NOT NULL REFERENCES "projet_bda"."Sortie" ON DELETE CASCADE,
PRIMARY KEY ("Newsletter_date", "Sortie_id_sortie"));
/*INDEX "fk_Newsletter_has_Sortie_Sortie1_idx" ("Sortie_id_sortie" ASC),
INDEX "fk_Newsletter_has_Sortie_Newsletter_idx" ("Newsletter_date" ASC))
  ENGINE = MyISAM;*/


-- -----------------------------------------------------
-- Table "projet_bda"."Artiste_represente_Oeuvre"
-- -----------------------------------------------------
DROP TABLE IF EXISTS "projet_bda"."Artiste_represente_Oeuvre" CASCADE;

CREATE TABLE IF NOT EXISTS "projet_bda"."Artiste_represente_Oeuvre" (
  "Artiste_nom_artiste" INT NOT NULL REFERENCES "projet_bda"."Artiste" ON DELETE CASCADE,
  "Oeuvre_id_oeuvre" INT NOT NULL REFERENCES "projet_bda"."Oeuvre" ON DELETE CASCADE,
PRIMARY KEY ("Artiste_nom_artiste", "Oeuvre_id_oeuvre"));/*
INDEX "fk_Artiste_has_Oeuvre_Oeuvre1_idx" ("Oeuvre_id_oeuvre" ASC),
INDEX "fk_Artiste_has_Oeuvre_Artiste1_idx" ("Artiste_nom_artiste" ASC))
  ENGINE = MyISAM;*/


-- -----------------------------------------------------
-- Table "projet_bda"."Artiste_participe_Oeuvre"
-- -----------------------------------------------------
DROP TABLE IF EXISTS "projet_bda"."Artiste_participe_Oeuvre" CASCADE;

CREATE TABLE IF NOT EXISTS "projet_bda"."Artiste_participe_Oeuvre" (
  "Artiste_nom_artiste" INT NOT NULL REFERENCES "projet_bda"."Oeuvre" ON DELETE CASCADE,
  "Oeuvre_id_oeuvre" INT NOT NULL REFERENCES "projet_bda"."Artiste" ON DELETE CASCADE,
PRIMARY KEY ("Artiste_nom_artiste", "Oeuvre_id_oeuvre"));/*
INDEX "fk_Artiste_has_Oeuvre_Oeuvre2_idx" ("Oeuvre_id_oeuvre" ASC),
INDEX "fk_Artiste_has_Oeuvre_Artiste2_idx" ("Artiste_nom_artiste" ASC))
  ENGINE = MyISAM;*/


-- -----------------------------------------------------
-- Table "projet_bda"."Artiste_cree_Oeuvre"
-- -----------------------------------------------------
DROP TABLE IF EXISTS "projet_bda"."Artiste_cree_Oeuvre" CASCADE;

CREATE TABLE IF NOT EXISTS "projet_bda"."Artiste_cree_Oeuvre" (
  "Oeuvre_id_oeuvre" INT NOT NULL REFERENCES "projet_bda"."Artiste" ON DELETE CASCADE,
  "Artiste_nom_artiste" INT NOT NULL REFERENCES "projet_bda"."Oeuvre" ON DELETE CASCADE,
PRIMARY KEY ("Oeuvre_id_oeuvre", "Artiste_nom_artiste"));/*
INDEX "fk_Oeuvre_has_Artiste_Artiste1_idx" ("Artiste_nom_artiste" ASC),
INDEX "fk_Oeuvre_has_Artiste_Oeuvre1_idx" ("Oeuvre_id_oeuvre" ASC))
  ENGINE = MyISAM;*/


-- -----------------------------------------------------
-- Table "projet_bda"."Newsletter_informe_Oeuvre"
-- -----------------------------------------------------
DROP TABLE IF EXISTS "projet_bda"."Newsletter_informe_Oeuvre" CASCADE;

CREATE TABLE IF NOT EXISTS "projet_bda"."Newsletter_informe_Oeuvre" (
  "Oeuvre_id_oeuvre" INT NOT NULL   REFERENCES "projet_bda"."Oeuvre" ON DELETE CASCADE,
  "Newsletter_date" DATE NOT NULL REFERENCES "projet_bda"."Newsletter" ON DELETE CASCADE,
PRIMARY KEY ("Oeuvre_id_oeuvre", "Newsletter_date"));/*
INDEX "fk_Oeuvre_has_Newsletter_Newsletter1_idx" ("Newsletter_date" ASC),
INDEX "fk_Oeuvre_has_Newsletter_Oeuvre1_idx" ("Oeuvre_id_oeuvre" ASC))
  ENGINE = MyISAM;*/


-- -----------------------------------------------------
-- Table "projet_bda"."Eleve_participe_Sortie"
-- -----------------------------------------------------
DROP TABLE IF EXISTS "projet_bda"."Eleve_participe_Sortie" CASCADE;

CREATE TABLE IF NOT EXISTS "projet_bda"."Eleve_participe_Sortie" (
  "Eleve_id_eleve" VARCHAR(45) NOT NULL REFERENCES "projet_bda"."Eleve" ON DELETE CASCADE,
  "Sortie_id_sortie" INT NOT NULL REFERENCES "projet_bda"."Sortie" ON DELETE CASCADE,
PRIMARY KEY ("Eleve_id_eleve", "Sortie_id_sortie"));/*
INDEX "fk_Eleve_has_Sortie_Sortie1_idx" ("Sortie_id_sortie" ASC),
INDEX "fk_Eleve_has_Sortie_Eleve1_idx" ("Eleve_id_eleve" ASC))
  ENGINE = MyISAM;*/


-- -----------------------------------------------------
-- Table "projet_bda"."concert_de"
-- -----------------------------------------------------
DROP TABLE IF EXISTS "projet_bda"."concert_de" CASCADE;

CREATE TABLE IF NOT EXISTS "projet_bda"."concert_de" (
  "Oeuvre_id_oeuvre" INT NOT NULL,
  "Oeuvre_Oeuvre_id_oeuvre" INT NOT NULL,
  "Oeuvre_id_oeuvre1" INT NOT NULL,
  "Oeuvre_Oeuvre_id_oeuvre1" INT NOT NULL,
PRIMARY KEY ("Oeuvre_id_oeuvre", "Oeuvre_Oeuvre_id_oeuvre", "Oeuvre_id_oeuvre1", "Oeuvre_Oeuvre_id_oeuvre1"));/*
INDEX "fk_Oeuvre_has_Oeuvre_Oeuvre2_idx" ("Oeuvre_id_oeuvre1" ASC, "Oeuvre_Oeuvre_id_oeuvre1" ASC),
INDEX "fk_Oeuvre_has_Oeuvre_Oeuvre1_idx" ("Oeuvre_id_oeuvre" ASC, "Oeuvre_Oeuvre_id_oeuvre" ASC))
  ENGINE = MyISAM;*/


-- -----------------------------------------------------
-- Table "projet_bda"."contenu_dans"
-- -----------------------------------------------------
DROP TABLE IF EXISTS "projet_bda"."contenu_dans" CASCADE;

CREATE TABLE IF NOT EXISTS "projet_bda"."contenu_dans" (
  "Oeuvre_id_oeuvre" INT NOT NULL,
  "Oeuvre_Oeuvre_id_oeuvre" INT NOT NULL,
  "Oeuvre_id_oeuvre1" INT NOT NULL,
  "Oeuvre_Oeuvre_id_oeuvre1" INT NOT NULL,
PRIMARY KEY ("Oeuvre_id_oeuvre", "Oeuvre_Oeuvre_id_oeuvre", "Oeuvre_id_oeuvre1", "Oeuvre_Oeuvre_id_oeuvre1"));

/*INDEX "fk_Oeuvre_has_Oeuvre_Oeuvre4_idx" ("Oeuvre_id_oeuvre1" ASC, "Oeuvre_Oeuvre_id_oeuvre1" ASC),
INDEX "fk_Oeuvre_has_Oeuvre_Oeuvre3_idx" ("Oeuvre_id_oeuvre" ASC, "Oeuvre_Oeuvre_id_oeuvre" ASC))
  ENGINE = MyISAM;*/

/*
SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
*/