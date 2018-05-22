
CREATE TABLE Media (
  id_media VARCHAR NOT NULL,
  titre VARCHAR NOT NULL,
  auteur VARCHAR NOT NULL,
  type VARCHAR NOT NULL,
  valide VARCHAR ,
  PRIMARY KEY (id_media),
  FOREIGN KEY (auteur) REFERENCES Users
);

CREATE TABLE Users (
  pseudo VARCHAR NOT NULL,
  mail VARCHAR NOT NULL,
  mdp VARCHAR NOT NULL,
  avatar VARCHAR ,
  date_naissance DATE NOT NULL,
  nom VARCHAR NOT NULL,
  prenom VARCHAR NOT NULL,
  rang VARCHAR ,
  PRIMARY KEY (pseudo)
);

INSERT INTO Users(pseudo, mail, mdp, avatar, date_naissance, nom, prenom, rang) VALUES ('Alias','www.blabla.net','0000','\image','1997-05-29','Guyonneau','Valentin','user');

CREATE TABLE Tags (
  id_tags SMALLINT NOT NULL ,
  nom VARCHAR NOT NULL,
  PRIMARY KEY (id_tags)
);

INSERT INTO Tags (id_tags, nom) VALUES (1,'animaux');
INSERT INTO Tags (id_tags, nom) VALUES (2,'mélancolique');
INSERT INTO Tags (id_tags, nom) VALUES (3,'drôle');
INSERT INTO Tags (id_tags, nom) VALUES (4,'paysages');
INSERT INTO Tags (id_tags, nom) VALUES (5,'cuisine');
INSERT INTO Tags (id_tags, nom) VALUES (6,'peinture');
INSERT INTO Tags (id_tags, nom) VALUES (7,'sculpture');
INSERT INTO Tags (id_tags, nom) VALUES (8,'code');
INSERT INTO Tags (id_tags, nom) VALUES (9,'troll');
INSERT INTO Tags (id_tags, nom) VALUES (10,'wtf');

CREATE TABLE TagContenu (
  tag SMALLINT NOT NULL,
  id_media VARCHAR NOT NUll,
  FOREIGN KEY (tag) REFERENCES Tags,
  FOREIGN KEY (id_media) REFERENCES Media
)

