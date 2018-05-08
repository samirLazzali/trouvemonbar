CREATE TABLE "user" (
  surname VARCHAR NOT NULL PRIMARY KEY ,
  firstname VARCHAR NOT NULL ,
  lastname VARCHAR NOT NULL ,
  id INTEGER(1) (CHECK id between 1 and 3) ,
);

CREATE TABLE "Ingredients" (
  nom_ing  VARCHAR NOT NULL PRIMARY KEY ,
  prix DOUBLE
);

CREATE TABLE "Recettes" (
  nom_rec VARCHAR NOT NULL PRIMARY KEY ,
  temps INTEGER ,
  prix DOUBLE
);

CREATE TABLE "Ingredients_Recettes" (
  nom_recette VARCHAR NOT NULL ,
  nom_ingredient VARCHAR NOT NULL ,
  CONSTRAINT pk_IR PRIMARY KEY (nom_recette, nom_ingredient),
  FOREIGN KEY (nom_recette) REFERENCES Recettes(nom_rec),
  FOREIGN KEY (nom_ingredient) REFERENCES Ingredients(nom_ing)
);


CREATE TABLE "Soirees" (
  nom_soiree VARCHAR NOT NULL PRIMARY KEY ,
  recette_propose VARCHAR NOT NULL ,
  FOREIGN KEY (recette_propose) REFERENCES Recettes(nom_rec),
);


CREATE TABLE "Statistiques" (
  soiree VARCHAR NOT NULL PRIMARY KEY,
  nb_assiettes_prepares INTEGER ,
  nb_assiettes_vendues INTEGER ,
  prix_achat DOUBLE ,
  prix_vente DOUBLE ,
  benefice DOUBLE ,
  FOREIGN KEY (soiree) REFERENCES Soirees(nom_soiree)
);

INSERT INTO user(surname, firstname, lastname, id) VALUES (Source,Corentin,Leloup,1);
INSERT INTO user(surname, firstname, lastname, id) VALUES (Patou,Clément,Gavoille,1);
INSERT INTO user(surname, firstname, lastname, id) VALUES (Felps,Arnaud,Kopp,1);
INSERT INTO user(surname, firstname, lastname, id) VALUES (Pruneau,Valentin,Bruneau,1);
INSERT INTO user(surname, firstname, lastname, id) VALUES (Pichet,Quentin,Pichollet,2);
INSERT INTO user(surname, firstname, lastname, id) VALUES (Derien,Dorian,Laugier,2);

INSERT INTO Ingredients(nom_ing, prix) VALUES (Saucisson,1.73);
INSERT INTO Ingredients(nom_ing, prix) VALUES (Saucisse,1);
INSERT INTO Ingredients(nom_ing, prix) VALUES (Pâte,0.37);

INSERT INTO Ingredients_Recettes(nom_recette, nom_ingredient) VALUES (feuillete_saucisse,Pâte);
INSERT INTO Ingredients_Recettes(nom_recette, nom_ingredient) VALUES (feuillete_saucisse,Saucisse);

INSERT INTO Recettes(nom_rec, temps) VALUES (feuillete_saucisse,10);

INSERT INTO Soirees(nom_soiree, recette_propose) VALUES (BTP,feuillete_saucisse);
