CREATE TABLE "user" (
  surname VARCHAR NOT NULL PRIMARY KEY ,
  firstname VARCHAR NOT NULL ,
  lastname VARCHAR NOT NULL ,
  id INTEGER(1) (CHECK id between 1 and 3) ,
);

CREATE TABLE "Ingredients" (
  nom_ing  VARCHAR NOT NULL PRIMARY KEY ,
  prix DOUBLE  /*prix pour 100g */
);

CREATE TABLE "Recettes" (
  nom_rec VARCHAR NOT NULL PRIMARY KEY ,
  temps INTEGER ,  /* en minutes */
  prix DOUBLE  /* prix pour 10 assiettes */
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


INSERT INTO Ingredients(nom_ing, prix) VALUES (Chips,0.62);
INSERT INTO Ingredients(nom_ing, prix) VALUES (Saucisson,1.22);
INSERT INTO Ingredients(nom_ing, prix) VALUES (Saucisse_cocktail,0.64);
INSERT INTO Ingredients(nom_ing, prix) VALUES (Pâte_feuilletee,0.25);
INSERT INTO Ingredients(nom_ing, prix) VALUES (Pâte_pizza,0.43);
INSERT INTO Ingredients(nom_ing, prix) VALUES (Sauce_tomate,0.23);
INSERT INTO Ingredients(nom_ing, prix) VALUES (Gruyere,0.70);
INSERT INTO Ingredients(nom_ing, prix) VALUES (St-Moret,1.02);
INSERT INTO Ingredients(nom_ing, prix) VALUES (Thon,1.22);
INSERT INTO Ingredients(nom_ing, prix) VALUES (Pain,1.10);
INSERT INTO Ingredients(nom_ing, prix) VALUES (Citron,0.33);
INSERT INTO Ingredients(nom_ing, prix) VALUES (Jambon,1.62);
INSERT INTO Ingredients(nom_ing, prix) VALUES (Sirop_grenadine,2);
INSERT INTO Ingredients(nom_ing, prix) VALUES (Limonade,0.5);
INSERT INTO Ingredients(nom_ing, prix) VALUES (Vin_Blanc,2);
INSERT INTO Ingredients(nom_ing, prix) VALUES (Moutarde,0.73);
INSERT INTO Ingredients(nom_ing, prix) VALUES (Concombre,0.015);
INSERT INTO Ingredients(nom_ing, prix) VALUES (Carotte,0.017);
INSERT INTO Ingredients(nom_ing, prix) VALUES (Nem,1.06);
INSERT INTO Ingredients(nom_ing, prix) VALUES (Chips_crevette,1.32);


INSERT INTO Ingredients_Recettes(nom_recette, nom_ingredient) VALUES (feuillete_saucisse,Pâte);
INSERT INTO Ingredients_Recettes(nom_recette, nom_ingredient) VALUES (feuillete_saucisse,Saucisse);
INSERT INTO Ingredients_Recettes(nom_recette, nom_ingredient) VALUES (feuillete_saucisse,Moutarde);
INSERT INTO Ingredients_Recettes(nom_recette, nom_ingredient) VALUES (Tartines_thon_StMoret,Pain);
INSERT INTO Ingredients_Recettes(nom_recette, nom_ingredient) VALUES (Tartines_thon_StMoret,Thon);
INSERT INTO Ingredients_Recettes(nom_recette, nom_ingredient) VALUES (Tartines_thon_StMoret,St-Moret);
INSERT INTO Ingredients_Recettes(nom_recette, nom_ingredient) VALUES (Tartines_thon_StMoret,Citron);
INSERT INTO Ingredients_Recettes(nom_recette, nom_ingredient) VALUES (Roules_jambon_StMoret,Jambon);
INSERT INTO Ingredients_Recettes(nom_recette, nom_ingredient) VALUES (Roules_jambon_StMoret,St-Moret);
INSERT INTO Ingredients_Recettes(nom_recette, nom_ingredient) VALUES (Jacqueline,Vin_Blanc);
INSERT INTO Ingredients_Recettes(nom_recette, nom_ingredient) VALUES (Jacqueline,Limonade);
INSERT INTO Ingredients_Recettes(nom_recette, nom_ingredient) VALUES (Jacqueline,Sirop_grenadine);
INSERT INTO Ingredients_Recettes(nom_recette, nom_ingredient) VALUES (Chips,Chips);
INSERT INTO Ingredients_Recettes(nom_recette, nom_ingredient) VALUES (Saucisson,Saucisson);
INSERT INTO Ingredients_Recettes(nom_recette, nom_ingredient) VALUES (Concombres,Concombre);
INSERT INTO Ingredients_Recettes(nom_recette, nom_ingredient) VALUES (Legumes,Carotte);
INSERT INTO Ingredients_Recettes(nom_recette, nom_ingredient) VALUES (Nems,Nem);
INSERT INTO Ingredients_Recettes(nom_recette, nom_ingredient) VALUES (Chips_crevette,Chips_crevette);
INSERT INTO Ingredients_Recettes(nom_recette, nom_ingredient) VALUES (Pizza,Pâte_pizza);
INSERT INTO Ingredients_Recettes(nom_recette, nom_ingredient) VALUES (Pizza,jambon);
INSERT INTO Ingredients_Recettes(nom_recette, nom_ingredient) VALUES (Pizza,Sauce_tomate);
INSERT INTO Ingredients_Recettes(nom_recette, nom_ingredient) VALUES (Pizza,Gruyere);


INSERT INTO Recettes(nom_rec, temps, prix) VALUES (feuillete_saucisse,10 ,1.03);
INSERT INTO Recettes(nom_rec, temps, prix) VALUES (Tartines_thon_StMoret,10 ,2.30);
INSERT INTO Recettes(nom_rec, temps, prix) VALUES (Roules_jambon_StMoret,10 ,2.22);
INSERT INTO Recettes(nom_rec, temps, prix) VALUES (Jacqueline,5,3.32);
INSERT INTO Recettes(nom_rec, temps, prix) VALUES (Chips,0,1.24);
INSERT INTO Recettes(nom_rec, temps, prix) VALUES (Saucisson,5,2.03);
INSERT INTO Recettes(nom_rec, temps, prix) VALUES (Concombres,5 ,0.7);
INSERT INTO Recettes(nom_rec, temps, prix) VALUES (Carottes,5,0.7);
INSERT INTO Recettes(nom_rec, temps, prix) VALUES (Nems,0,3.18);
INSERT INTO Recettes(nom_rec, temps, prix) VALUES (Chips_crevettes,0,2.50);
INSERT INTO Recettes(nom_rec, temps, prix) VALUES (Pizza,15,3.2);


INSERT INTO Soirees(nom_soiree, recette_propose) VALUES (A3A,feuillete_saucisse);
INSERT INTO Soirees(nom_soiree, recette_propose) VALUES (A3A,Jacqueline);
INSERT INTO Soirees(nom_soiree, recette_propose) VALUES (A3A,Chips);
INSERT INTO Soirees(nom_soiree, recette_propose) VALUES (A3A,Saucisson);
INSERT INTO Soirees(nom_soiree, recette_propose) VALUES (A3A,Concombres);
INSERT INTO Soirees(nom_soiree, recette_propose) VALUES (A3A,Carottes;

INSERT INTO Soirees(nom_soiree, recette_propose) VALUES (Nouvel_An_Chinois,Jacqueline);
INSERT INTO Soirees(nom_soiree, recette_propose) VALUES (Nouvel_An_Chinois,nems);
INSERT INTO Soirees(nom_soiree, recette_propose) VALUES (Nouvel_An_Chinois,Chips_crevette);
INSERT INTO Soirees(nom_soiree, recette_propose) VALUES (Nouvel_An_Chinois,carotte);
INSERT INTO Soirees(nom_soiree, recette_propose) VALUES (Nouvel_An_Chinois,concombres);
INSERT INTO Soirees(nom_soiree, recette_propose) VALUES (Nouvel_An_Chinois,Pizza);


INSERT INTO Soirees(nom_soiree, recette_propose) VALUES (BDS,Jacqueline);
INSERT INTO Soirees(nom_soiree, recette_propose) VALUES (BDS,feuillete_saucisse);
INSERT INTO Soirees(nom_soiree, recette_propose) VALUES (BDS,Pizza);
INSERT INTO Soirees(nom_soiree, recette_propose) VALUES (BDS,Saucisson);
INSERT INTO Soirees(nom_soiree, recette_propose) VALUES (BDS,Chips);

INSERT INTO Soirees(nom_soiree, recette_propose) VALUES (Soiree_d_or,Jacqueline);
INSERT INTO Soirees(nom_soiree, recette_propose) VALUES (Soiree_d_or,Tartines_thon_StMoret);
INSERT INTO Soirees(nom_soiree, recette_propose) VALUES (Soiree_d_or,Chips);
INSERT INTO Soirees(nom_soiree, recette_propose) VALUES (Soiree_d_or,Saucisson);
INSERT INTO Soirees(nom_soiree, recette_propose) VALUES (Soiree_d_or,Concombres);
INSERT INTO Soirees(nom_soiree, recette_propose) VALUES (Soiree_d_or,Carottes);

INSERT INTO Soirees(nom_soiree, recette_propose) VALUES (Harry_Potter,Jacqueline);
INSERT INTO Soirees(nom_soiree, recette_propose) VALUES (Harry_Potter,Tartines_thon_StMoret);
INSERT INTO Soirees(nom_soiree, recette_propose) VALUES (Harry_Potter,Roules_jambon_StMoret);
INSERT INTO Soirees(nom_soiree, recette_propose) VALUES (Harry_Potter,Chips);
INSERT INTO Soirees(nom_soiree, recette_propose) VALUES (Harry_Potter,Saucisson);
INSERT INTO Soirees(nom_soiree, recette_propose) VALUES (Harry_Potter,Concombres);
INSERT INTO Soirees(nom_soiree, recette_propose) VALUES (Harry_Potter,Carottes);


INSERT INTO Statistiques(soiree,nb_assiettes_prepares,nb_assiettes_vendues,prix_achat,prix_vente,benefice) VALUES(A3A,50,32,45.10,48,2.90)
INSERT INTO Statistiques(soiree,nb_assiettes_prepares,nb_assiettes_vendues,prix_achat,prix_vente,benefice) VALUES(Nouvel_An_Chinois,50,43,68,64.50,-3.50)
INSERT INTO Statistiques(soiree,nb_assiettes_prepares,nb_assiettes_vendues,prix_achat,prix_vente,benefice) VALUES(BDS,50,30,54.10,45,-9.10)
INSERT INTO Statistiques(soiree,nb_assiettes_prepares,nb_assiettes_vendues,prix_achat,prix_vente,benefice) VALUES(Soiree_d_or,50,37,51.45,55.50,4.05)
INSERT INTO Statistiques(soiree,nb_assiettes_prepares,nb_assiettes_vendues,prix_achat,prix_vente,benefice) VALUES(Harry_Potter,50,41,62.55,61.50,-1.05)