CREATE TABLE "user" (
  surname VARCHAR(20) NOT NULL PRIMARY KEY ,
  firstname VARCHAR(20) NOT NULL ,
  lastname VARCHAR(20) NOT NULL ,
  id INTEGER CHECK (id between 1 and 3) ,
  pwd VARCHAR(200) NOT NULL 
);

CREATE TABLE "Ingredients" (
  nom_ing  VARCHAR NOT NULL PRIMARY KEY ,
  prix DOUBLE PRECISION  /*prix pour 100g */
);

CREATE TABLE "Recettes" (
  nom_rec VARCHAR NOT NULL PRIMARY KEY ,
  temps INTEGER ,  /* en minutes */
  prix DOUBLE PRECISION  /* prix pour 10 assiettes */
);

CREATE TABLE "Ingredients_Recettes" (
  nom_recette VARCHAR NOT NULL ,
  nom_ingredient VARCHAR NOT NULL ,
  CONSTRAINT pk_IR PRIMARY KEY (nom_recette, nom_ingredient),
  FOREIGN KEY (nom_recette) REFERENCES "Recettes"(nom_rec),
  FOREIGN KEY (nom_ingredient) REFERENCES "Ingredients"(nom_ing)
);

CREATE TABLE "Statistiques" (
  soiree VARCHAR NOT NULL PRIMARY KEY,
  nb_assiettes_prepares INTEGER ,
  nb_assiettes_vendues INTEGER ,
  prix_achat DOUBLE PRECISION ,
  prix_vente DOUBLE PRECISION ,
  benefice DOUBLE PRECISION 
);

CREATE TABLE "Soirees" (
  id_recette INTEGER NOT NULL PRIMARY KEY ,
  nom_soiree VARCHAR NOT NULL ,
  recette_propose VARCHAR NOT NULL ,
  FOREIGN KEY (recette_propose) REFERENCES "Recettes"(nom_rec) ,
  FOREIGN KEY (nom_soiree) REFERENCES "Statistiques"(soiree)
);

INSERT INTO "user"(surname, firstname, lastname, id, pwd) VALUES ('Source','Corentin','Leloup',1,'2fbb9a3365cb1d4f024d189ff33e1b62');
INSERT INTO "user"(surname, firstname, lastname, id, pwd) VALUES ('Patou','Clément','Gavoille',1,'2fbb9a3365cb1d4f024d189ff33e1b62');
INSERT INTO "user"(surname, firstname, lastname, id, pwd) VALUES ('Felps','Arnaud','Kopp',1,'2fbb9a3365cb1d4f024d189ff33e1b62');
INSERT INTO "user"(surname, firstname, lastname, id, pwd) VALUES ('Pruneau','Valentin','Bruneau',1,'2fbb9a3365cb1d4f024d189ff33e1b62');
INSERT INTO "user"(surname, firstname, lastname, id, pwd) VALUES ('Pichet','Quentin','Pichollet',2,'2fbb9a3365cb1d4f024d189ff33e1b62');
INSERT INTO "user"(surname, firstname, lastname, id, pwd) VALUES ('Derien','Dorian','Laugier',2,'2fbb9a3365cb1d4f024d189ff33e1b62');


INSERT INTO "Ingredients"(nom_ing, prix) VALUES ('Chips',0.62);
INSERT INTO "Ingredients"(nom_ing, prix) VALUES ('Saucisson',1.22);
INSERT INTO "Ingredients"(nom_ing, prix) VALUES ('Saucisse_cocktail',0.64);
INSERT INTO "Ingredients"(nom_ing, prix) VALUES ('Pâte_feuilletee',0.25);
INSERT INTO "Ingredients"(nom_ing, prix) VALUES ('Pâte_pizza',0.43);
INSERT INTO "Ingredients"(nom_ing, prix) VALUES ('Sauce_tomate',0.23);
INSERT INTO "Ingredients"(nom_ing, prix) VALUES ('Gruyere',0.70);
INSERT INTO "Ingredients"(nom_ing, prix) VALUES ('St-Moret',1.02);
INSERT INTO "Ingredients"(nom_ing, prix) VALUES ('Thon',1.22);
INSERT INTO "Ingredients"(nom_ing, prix) VALUES ('Pain',1.10);
INSERT INTO "Ingredients"(nom_ing, prix) VALUES ('Citron',0.33);
INSERT INTO "Ingredients"(nom_ing, prix) VALUES ('Jambon',1.62);
INSERT INTO "Ingredients"(nom_ing, prix) VALUES ('Sirop_grenadine',2);
INSERT INTO "Ingredients"(nom_ing, prix) VALUES ('Limonade',0.5);
INSERT INTO "Ingredients"(nom_ing, prix) VALUES ('Vin_Blanc',2);
INSERT INTO "Ingredients"(nom_ing, prix) VALUES ('Moutarde',0.73);
INSERT INTO "Ingredients"(nom_ing, prix) VALUES ('Concombre',0.015);
INSERT INTO "Ingredients"(nom_ing, prix) VALUES ('Carotte',0.017);
INSERT INTO "Ingredients"(nom_ing, prix) VALUES ('Nem',1.06);
INSERT INTO "Ingredients"(nom_ing, prix) VALUES ('Chips_crevette',1.32);

/*Compléter les prix*/
INSERT INTO "Ingredients"(nom_ing, prix) VALUES ('Pâte',0.00);
INSERT INTO "Ingredients"(nom_ing, prix) VALUES ('Saucisse',0.00);

INSERT INTO "Recettes"(nom_rec, temps, prix) VALUES ('feuillete_saucisse',10 ,1.03);
INSERT INTO "Recettes"(nom_rec, temps, prix) VALUES ('Tartines_thon_StMoret',10 ,2.30);
INSERT INTO "Recettes"(nom_rec, temps, prix) VALUES ('Roules_jambon_StMoret',10 ,2.22);
INSERT INTO "Recettes"(nom_rec, temps, prix) VALUES ('Jacqueline',5,3.32);
INSERT INTO "Recettes"(nom_rec, temps, prix) VALUES ('Chips',0,1.24);
INSERT INTO "Recettes"(nom_rec, temps, prix) VALUES ('Saucisson',5,2.03);
INSERT INTO "Recettes"(nom_rec, temps, prix) VALUES ('Concombres',5 ,0.7);
INSERT INTO "Recettes"(nom_rec, temps, prix) VALUES ('Carottes',5,0.7);
INSERT INTO "Recettes"(nom_rec, temps, prix) VALUES ('Nems',0,3.18);
INSERT INTO "Recettes"(nom_rec, temps, prix) VALUES ('Chips_crevettes',0,2.50);
INSERT INTO "Recettes"(nom_rec, temps, prix) VALUES ('Pizza',15,3.2);



INSERT INTO "Ingredients_Recettes"(nom_recette, nom_ingredient) VALUES ('feuillete_saucisse','Pâte');
INSERT INTO "Ingredients_Recettes"(nom_recette, nom_ingredient) VALUES ('feuillete_saucisse','Saucisse');
INSERT INTO "Ingredients_Recettes"(nom_recette, nom_ingredient) VALUES ('feuillete_saucisse','Moutarde');
INSERT INTO "Ingredients_Recettes"(nom_recette, nom_ingredient) VALUES ('Tartines_thon_StMoret','Pain');
INSERT INTO "Ingredients_Recettes"(nom_recette, nom_ingredient) VALUES ('Tartines_thon_StMoret','Thon');
INSERT INTO "Ingredients_Recettes"(nom_recette, nom_ingredient) VALUES ('Tartines_thon_StMoret','St-Moret');
INSERT INTO "Ingredients_Recettes"(nom_recette, nom_ingredient) VALUES ('Tartines_thon_StMoret','Citron');
INSERT INTO "Ingredients_Recettes"(nom_recette, nom_ingredient) VALUES ('Roules_jambon_StMoret','Jambon');
INSERT INTO "Ingredients_Recettes"(nom_recette, nom_ingredient) VALUES ('Roules_jambon_StMoret','St-Moret');
INSERT INTO "Ingredients_Recettes"(nom_recette, nom_ingredient) VALUES ('Jacqueline','Vin_Blanc');
INSERT INTO "Ingredients_Recettes"(nom_recette, nom_ingredient) VALUES ('Jacqueline','Limonade');
INSERT INTO "Ingredients_Recettes"(nom_recette, nom_ingredient) VALUES ('Jacqueline','Sirop_grenadine');
INSERT INTO "Ingredients_Recettes"(nom_recette, nom_ingredient) VALUES ('Chips','Chips');
INSERT INTO "Ingredients_Recettes"(nom_recette, nom_ingredient) VALUES ('Saucisson','Saucisson');
INSERT INTO "Ingredients_Recettes"(nom_recette, nom_ingredient) VALUES ('Concombres','Concombre');
INSERT INTO "Ingredients_Recettes"(nom_recette, nom_ingredient) VALUES ('Legumes','Carotte');
INSERT INTO "Ingredients_Recettes"(nom_recette, nom_ingredient) VALUES ('Nems','Nem');
INSERT INTO "Ingredients_Recettes"(nom_recette, nom_ingredient) VALUES ('Chips_crevette','Chips_crevette');
INSERT INTO "Ingredients_Recettes"(nom_recette, nom_ingredient) VALUES ('Pizza','Pâte_pizza');
INSERT INTO "Ingredients_Recettes"(nom_recette, nom_ingredient) VALUES ('Pizza','Jambon');
INSERT INTO "Ingredients_Recettes"(nom_recette, nom_ingredient) VALUES ('Pizza','Sauce_tomate');
INSERT INTO "Ingredients_Recettes"(nom_recette, nom_ingredient) VALUES ('Pizza','Gruyere');

INSERT INTO "Statistiques"(soiree,nb_assiettes_prepares,nb_assiettes_vendues,prix_achat,prix_vente,benefice) VALUES('A3A',50,32,45.10,48,2.90);
INSERT INTO "Statistiques"(soiree,nb_assiettes_prepares,nb_assiettes_vendues,prix_achat,prix_vente,benefice) VALUES('Nouvel_An_Chinois',50,43,68,64.50,-3.50);
INSERT INTO "Statistiques"(soiree,nb_assiettes_prepares,nb_assiettes_vendues,prix_achat,prix_vente,benefice) VALUES('BDS',50,30,54.10,45,-9.10);
INSERT INTO "Statistiques"(soiree,nb_assiettes_prepares,nb_assiettes_vendues,prix_achat,prix_vente,benefice) VALUES('Soiree_d_or',50,37,51.45,55.50,4.05);
INSERT INTO "Statistiques"(soiree,nb_assiettes_prepares,nb_assiettes_vendues,prix_achat,prix_vente,benefice) VALUES('Harry_Potter',50,41,62.55,61.50,-1.05);

INSERT INTO "Soirees"(id_recette, nom_soiree, recette_propose) VALUES (0,'A3A','feuillete_saucisse');
INSERT INTO "Soirees"(id_recette, nom_soiree, recette_propose) VALUES (1,'A3A','Jacqueline');
INSERT INTO "Soirees"(id_recette, nom_soiree, recette_propose) VALUES (2,'A3A','Chips');
INSERT INTO "Soirees"(id_recette, nom_soiree, recette_propose) VALUES (3,'A3A','Saucisson');
INSERT INTO "Soirees"(id_recette, nom_soiree, recette_propose) VALUES (4,'A3A','Concombres');
INSERT INTO "Soirees"(id_recette, nom_soiree, recette_propose) VALUES (5,'A3A','Carottes');

INSERT INTO "Soirees"(id_recette, nom_soiree, recette_propose) VALUES (6,'Nouvel_An_Chinois','Jacqueline');
INSERT INTO "Soirees"(id_recette, nom_soiree, recette_propose) VALUES (7,'Nouvel_An_Chinois','Nems');
INSERT INTO "Soirees"(id_recette, nom_soiree, recette_propose) VALUES (8,'Nouvel_An_Chinois','Chips_crevette');
INSERT INTO "Soirees"(id_recette, nom_soiree, recette_propose) VALUES (9,'Nouvel_An_Chinois','Carottes');
INSERT INTO "Soirees"(id_recette, nom_soiree, recette_propose) VALUES (10,'Nouvel_An_Chinois','Concombres');
INSERT INTO "Soirees"(id_recette, nom_soiree, recette_propose) VALUES (11,'Nouvel_An_Chinois','Pizza');


INSERT INTO "Soirees"(id_recette, nom_soiree, recette_propose) VALUES (12,'BDS','Jacqueline');
INSERT INTO "Soirees"(id_recette, nom_soiree, recette_propose) VALUES (13,'BDS','feuillete_saucisse');
INSERT INTO "Soirees"(id_recette, nom_soiree, recette_propose) VALUES (14,'BDS','Pizza');
INSERT INTO "Soirees"(id_recette, nom_soiree, recette_propose) VALUES (15,'BDS','Saucisson');
INSERT INTO "Soirees"(id_recette, nom_soiree, recette_propose) VALUES (16,'BDS','Chips');

INSERT INTO "Soirees"(id_recette, nom_soiree, recette_propose) VALUES (17,'Soiree_d_or','Jacqueline');
INSERT INTO "Soirees"(id_recette, nom_soiree, recette_propose) VALUES (18,'Soiree_d_or','Tartines_thon_StMoret');
INSERT INTO "Soirees"(id_recette, nom_soiree, recette_propose) VALUES (19,'Soiree_d_or','Chips');
INSERT INTO "Soirees"(id_recette, nom_soiree, recette_propose) VALUES (20,'Soiree_d_or','Saucisson');
INSERT INTO "Soirees"(id_recette, nom_soiree, recette_propose) VALUES (21,'Soiree_d_or','Concombres');
INSERT INTO "Soirees"(id_recette, nom_soiree, recette_propose) VALUES (22,'Soiree_d_or','Carottes');

INSERT INTO "Soirees"(id_recette, nom_soiree, recette_propose) VALUES (23,'Harry_Potter','Jacqueline');
INSERT INTO "Soirees"(id_recette, nom_soiree, recette_propose) VALUES (24,'Harry_Potter','Tartines_thon_StMoret');
INSERT INTO "Soirees"(id_recette, nom_soiree, recette_propose) VALUES (25,'Harry_Potter','Roules_jambon_StMoret');
INSERT INTO "Soirees"(id_recette, nom_soiree, recette_propose) VALUES (26,'Harry_Potter','Chips');
INSERT INTO "Soirees"(id_recette, nom_soiree, recette_propose) VALUES (27,'Harry_Potter','Saucisson');
INSERT INTO "Soirees"(id_recette, nom_soiree, recette_propose) VALUES (28,'Harry_Potter','Concombres');
INSERT INTO "Soirees"(id_recette, nom_soiree, recette_propose) VALUES (29,'Harry_Potter','Carottes');
